<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAssistantHolidayRequest;
use App\Models\Assistant;
use App\Models\AssistantHoliday;
use App\Models\User;
use App\Repositories\AssistantHolidayRepository;
use Flash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Appointment;
use App\Models\AppointmentAssistant;

class AssistantHolidayController extends AppBaseController
{
    /** @var AssistantholidayRepository */
    private $assistantholidayRepository;

    public function __construct(AssistantHolidayRepository $assistantholidayRepo)
    {
        $this->assistantholidayRepository = $assistantholidayRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('assistant_holiday.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $assistant = Assistant::with('user')->get()->where('user.status', User::ACTIVE)->pluck('user.full_name',
            'id');

        return view('assistant_holiday.create', compact('assistant'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector.
     */
    public function store(CreateAssistantHolidayRequest $request): RedirectResponse
    {
        $input = $request->all();
        $isnot = 0;
        $appointmentdate = AppointmentAssistant::whereAssistantId($input['assistant_id'])->pluck('date','id');
        foreach ($appointmentdate as $key => $value) {
            if ($value == $input['date']) {
                Flash::error(__('messages.flash.appointment_book'));
                return back();
            }
            else{
                $isnot = 1;
            }
        }

        if($isnot == 1){
            $holiday = $this->assistantholidayRepository->store($input);
        }

        $holiday = $this->assistantholidayRepository->store($input) ?  1:  0; //cette ligne était absente

        if ($holiday) {
            Flash::success(__('messages.flash.assistant_holiday'));

            return redirect(route('asstt-holidy.index'));
        } else {
            Flash::error(__('messages.flash.holiday_already_is_exist'));

            return redirect(route('asstt-holidy.create'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $checkRecord = AssistantHoliday::destroy($id);

        return $this->sendSuccess(__('messages.flash.city_delete'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function holiday(): View
    {
        return view('holiday_assistant.index');
    }

    public function assistantCreate(): View
    {
        $assistant = Assistant::whereUserId(getLogInUserId())->first('id');
        $assistantId = $assistant['id'];

        return view('holiday_assistant.create', compact('assistantId'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector.
     */
    public function assistantStore(CreateAssistantHolidayRequest $request): RedirectResponse
    {
        $input = $request->all();
        $loginAssistant = User::with('assistant')->whereId(getLogInUserId())->first();
        $appointment = AppointmentAssistant::whereAssistantId($loginAssistant->assistant->id)->where('date',$input['date'])->exists();
        if($appointment){
            Flash::error(__('messages.flash.appointment_book'));

            return redirect(route('assistants.holiday-assistant-create'));
        }
        $holiday = $this->assistantholidayRepository->store($input);

        if ($holiday) {
            Flash::success(__('messages.flash.assistant_holiday'));

            return redirect(route('assistants.holiday-assistant'));
        } else {
            Flash::error(__('messages.flash.holiday_already_is_exist'));

            return redirect(route('assistants.holiday-assistant-create'));
        }
    }

    public function assistantDestroy($id): mixed
    {
        $assistantHoliday = AssistantHoliday::whereId($id)->firstOrFail();
        if ($assistantHoliday->assistant_id !== getLogInUser()->assistant->id) {
            return $this->sendError(__('messages.common.not_allow__assess_record'));
        }
        $assistantHoliday->destroy($id);

        return $this->sendSuccess(__('messages.flash.city_delete'));
    }
}
