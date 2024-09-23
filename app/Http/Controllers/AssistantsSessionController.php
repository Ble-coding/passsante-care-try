<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAssistantSessionRequest;
use App\Http\Requests\UpdateAssistantSessionRequest;
use App\Models\Appointment;
use App\Models\AppointmentAssistant;
use App\Models\ClinicSchedule;
use App\Models\AssistantHoliday;
use App\Models\AssistantSession;
use App\Models\ClinicScheduleAssistant;
use App\Models\WeekDay_assistant;
use App\Repositories\AssistantSessionRepository;
use Carbon\Carbon; 
use DateTime;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App; 
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class AssistantsSessionController extends AppBaseController
{
    /** @var AssistantSessionRepository */  
    private $assistantSessionRepository;  

    public function __construct(AssistantSessionRepository $assistantSessionRepo)
    {
        $this->assistantSessionRepository = $assistantSessionRepo;
    }

    /**
     * Display a listing of the AssistantSession.
     *
     * @return Application|Factory|View
     */
    public function index(): \Illuminate\View\View
    {
        return view('assistants_sessions.index');
    }

    /**
     * Show the form for creating a new AssistantSession.
     *
     * @return Application|Factory|View
     */
    public function create(): \Illuminate\View\View
    {
        $doctorsList = $this->assistantSessionRepository->getSyncList();

        return view('assistants_sessions.create', compact('doctorsList'));
    }

    /**
     * Store a newly created AssistantSession in storage.
     */
    public function store(CreateAssistantSessionRequest $request)
    {
        $input = $request->all();

        $result = $this->assistantSessionRepository->store($input);

        if (! $result['success']) {
            return $this->sendError($result);
        }

        return $this->sendSuccess(__('messages.flash.schedule_crete'));
    }

    /**
     * Display the specified AssistantSession.
     *
     * @return Application|Factory|View
     */
    public function show(AssistantSession $doctorSession)
    {
        if (empty($doctorSession)) {
            Flash::error(__('messages.flash.assistant_session_not_found'));

            return redirect(getAssistantSessionURL());
        }

        return view('assistants_sessions.show', compact('doctorSession'));
    }

    /**
     * Show the form for editing the specified AssistantSession.
     *
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        if (getLogInUser()->hasRole('assistant')) {
            $doctorSession = AssistantSession::with('assistant.user')->whereAssistantId(getLogInUser()->assistant->id)->first();
        } else {
            $doctorSession = AssistantSession::with('assistant.user')->findOrFail($id);
        }
        $doctorsList = $this->assistantSessionRepository->getSyncList();

        if (empty($doctorSession)) {
            Flash::error(__('messages.flash.schedule_not_found'));

            return redirect(route('assistant-sessions.index'));
        }

        $sessionWeekDays = $doctorSession->sessionWeekDays;

        return view('assistants_sessions.edit', compact('doctorSession', 'doctorsList', 'sessionWeekDays'));
    }

    /**
     * Update the specified AssistantSession in storage.
     */
    public function update(UpdateAssistantSessionRequest $request, AssistantSession $doctorSession): JsonResponse
    {
        if (empty($doctorSession)) {
            return $this->sendError(__('messages.flash.assistant_session_not_found'));
        }

        $result = $this->assistantSessionRepository->updateAssistantSession($request->all(), $doctorSession);

        if (! $result['success']) {
            return $this->sendError($result);
        }

        return $this->sendSuccess(__('messages.flash.schedule_update'));
    }

    /**
     * Remove the specified AssistantSession from storage.
     */
    public function destroy(AssistantSession $doctorSession): JsonResponse
    {
        try {
            DB::beginTransaction();

            $doctorSession->delete();

            $doctorSession->sessionWeekDays()->delete();

            DB::commit();

            return $this->sendSuccess(__('messages.flash.schedule_delete'));
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function getAssistantSession(Request $request): JsonResponse
    {

     
        $holidaydate = $request->get('date');
       
        $assistantId = $request->get('adminAppointmentAssistantId');
        $timezone_offset_minutes = $request->get('timezone_offset_minutes');

        $assistant_holiday = AssistantHoliday::where('assistant_id', $assistantId)->where('date', $holidaydate)->get();
        if (! $assistant_holiday->count() == 0) {
            return $this->sendError(__('messages.flash.assistant_not_available'));
        }
        // Convert minutes to seconds
        $timezone_name = timezone_name_from_abbr('', $timezone_offset_minutes * 60, false);
        $date = Carbon::createFromFormat('Y-m-d', $request->date);
        $doctorWeekDaySessions = WeekDay_assistant::whereDayOfWeek($date->dayOfWeek)->whereAssistantId($assistantId)->with('assistantSession')->get();
        if ($doctorWeekDaySessions->count() == 0) {
            if (! empty(getLogInUser()->language)) {
                App::setLocale(getLogInUser()->language);

            } else {
                App::setLocale($request->session()->get('languageName'));
            }

            return $this->sendError(__('messages.flash.no_available_slots'));
        }

        $appointments = AppointmentAssistant::whereAssistantId($assistantId)->whereIn('status',
            [AppointmentAssistant::BOOKED, AppointmentAssistant::CHECK_IN, AppointmentAssistant::CHECK_OUT])->get();
        $bookedSlot = [];
        $bookingSlot = [];
        foreach ($appointments as $appointment) {
            if ($appointment->date == $request->date) {
                $bookedSlot[] = $appointment->from_time.' '.$appointment->from_time_type.' - '.$appointment->to_time.' '.$appointment->to_time_type;
            }
        }

        foreach ($doctorWeekDaySessions as $index => $doctorWeekDaySession) {
            date_default_timezone_set($timezone_name);

            $doctorSession = $doctorWeekDaySession->assistantSession;
            // convert 12 hours to 24 hours
            $startTime = date('H:i', strtotime($doctorWeekDaySession->full_start_time));
            $endTime = date('H:i', strtotime($doctorWeekDaySession->full_end_time));
            $slots = $this->getTimeSlot($doctorSession->session_meeting_time, $startTime, $endTime);
            $gap = $doctorSession->session_gap;
            $isSameWeekDay = (Carbon::now()->dayOfWeek == $date->dayOfWeek) && (Carbon::now()->isSameDay($date));
            foreach ($slots as $key => $slot) {
                $key--;
                if ($key != 0) {
                    $slotStartTime = date('h:i A',
                        strtotime('+'.$gap * $key.' minutes', strtotime($slot[0])));
                    $slotEndTime = date('h:i A',
                        strtotime('+'.$gap * $key.' minutes', strtotime($slot[1])));
                    if (strtotime($doctorWeekDaySession->full_end_time) < strtotime($slotEndTime)) {
                        break;
                    }
                    if (strtotime($slotStartTime) < strtotime($slotEndTime)) {
                        if (($isSameWeekDay && strtotime($slotStartTime) > strtotime(date('h:i A'))) || ! $isSameWeekDay) {
                            $startTimeOrg = Carbon::parse(date('h:i A', strtotime($slotStartTime)));
                            $slotStartTimeCarbon = Carbon::parse(date('h:i A', strtotime($startTime)));
                            $slotEndTimeCarbon = Carbon::parse(date('h:i A', strtotime($endTime)));
                            if (! $startTimeOrg->between($slotStartTimeCarbon, $slotEndTimeCarbon)) {
                                break;
                            }

                            if (in_array(($slotStartTime.' - '.$slotEndTime), $bookingSlot)) {
                                break;
                            }
                            $bookingSlot[] = $slotStartTime.' - '.$slotEndTime;
                        }
                    }
                } else {
                    if (($isSameWeekDay && strtotime($slot[0]) > strtotime(date('h:i A'))) || ! $isSameWeekDay) {
                        if (in_array((date('h:i A', strtotime($slot[0])).' - '.date('h:i A', strtotime($slot[1]))),
                            $bookingSlot)) {
                            break;
                        }
                        $bookingSlot[] = date('h:i A', strtotime($slot[0])).' - '.date('h:i A', strtotime($slot[1]));
                    }
                }
            }
        }

        $slots = [
            'bookedSlot' => ! empty($bookedSlot) ? $bookedSlot : null,
            'slots' => $bookingSlot,
        ];

        return $this->sendResponse($slots, __('messages.flash.retrieve'));
    }

    /**
     * @throws Exception
     */
    public function getTimeSlot($interval, $start_time, $end_time)
    {
        $start = new DateTime($start_time);
        $end = new DateTime($end_time);
        $carbonStart = Carbon::createFromFormat('H:i', $start_time);
        $carbonEnd = Carbon::createFromFormat('H:i', $end_time);
        $startTime = $start->format('H:i');
        $endTime = $originalEndTime = $end->format('H:i');
        $i = 0;
        $time = [];
        while (strtotime($startTime) <= strtotime($endTime)) {
            $start = $startTime;
            $end = date('H:i', strtotime('+'.$interval.' minutes', strtotime($startTime)));
            $startTime = date('H:i', strtotime('+'.$interval.' minutes', strtotime($startTime)));
            if (! Carbon::createFromFormat('H:i', $start)->isBetween($carbonStart,
                $carbonEnd) || ! Carbon::createFromFormat('H:i', $end)->isBetween($carbonStart, $carbonEnd)) {
                break;
            }
            $i++;
            if (strtotime($startTime) <= strtotime($endTime)) {
                $time[$i][] = $start;
                $time[$i][] = $end;
            }
            if (strtotime($startTime) >= strtotime($originalEndTime)) {
                break;
            }
            if (strtotime($start) >= strtotime($end)) {
                break;
            }
        }

        return $time;
    }

    /**
     * @return mixed
     */
    public function getSlotByGap(Request $request)
    {
        $gap = $request->get('gap');
        $day = $request->get('day');
        $clinicSchedule = ClinicScheduleAssistant::whereDayOfWeek($day)->first();
        $slots = getSlotByGap($clinicSchedule->start_time, $clinicSchedule->end_time);
        $html = view('assistants_sessions.slot', ['slots' => $slots, 'day' => $day])->render();

        return $this->sendResponse($html, __('messages.flash.retrieve'));
    }

    /**
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function assistantScheduleEdit()
    {
        $doctorSession = AssistantSession::whereAssistantId(getLogInUser()->assistant->id)->first();
        if (empty($doctorSession)) {
            Flash::error(__('messages.flash.schedule_not_found'));  

            return redirect(route('assistant-sessions.index'));
        }

        $doctorsList = $this->assistantSessionRepository->getSyncList();

        $sessionWeekDays = $doctorSession->sessionWeekDays;

        return view('assistants_sessions.edit', compact('doctorSession', 'doctorsList', 'sessionWeekDays'));
    }
}
