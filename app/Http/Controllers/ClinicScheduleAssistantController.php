<?php

namespace App\Http\Controllers;

use App\Models\ClinicScheduleAssistant;
use DB;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClinicScheduleAssistantController extends AppBaseController
{
    /**
     * @return Application|Factory|View
     */
    public function index(): \Illuminate\View\View
    {
        $clinicSchedules = ClinicScheduleAssistant::all();

        return view('clinic_schedule_assistant.index', compact('clinicSchedules'));
    }

    /**
     * Store a newly created ClinicScheduleAssistant in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();
        if (isset($input['checked_week_days'])) {
            $oldWeekDays = ClinicScheduleAssistant::pluck('day_of_week')->toArray();
            foreach (array_diff($oldWeekDays, $input['checked_week_days']) as $dayOfWeek) {
                ClinicScheduleAssistant::whereDayOfWeek($dayOfWeek)->delete();
                DB::table('session_week_days_assistant')->where('day_of_week', $dayOfWeek)->delete();
            }

            foreach ($input['checked_week_days'] as $day) {
                $startTime = $input['clinicStartTimes'][$day];
                $endTime = $input['clinicEndTimes'][$day];
                if (strtotime($startTime) > strtotime($endTime)) {
                    return $this->sendError(ClinicScheduleAssistant::WEEKDAY[$day].__('messages.start_time_invalid'));
                }
                ClinicScheduleAssistant::updateOrCreate(['day_of_week' => $day],
                    ['start_time' => $startTime, 'end_time' => $endTime]);
            }

            return $this->sendSuccess(__('messages.flash.clinic_save'));
        }

        ClinicScheduleAssistant::query()->delete();
        DB::table('session_week_days_assistant')->delete();

        return $this->sendSuccess(__('messages.flash.clinic_save'));
    }

    /**
     * Store a newly created ClinicScheduleAssistant in storage.
     */
    public function checkRecord(Request $request): JsonResponse
    {
        $input = $request->all();
        $message = __('messages.flash.some_assistants');
        if (isset($input['checked_week_days'])) {
            $unCheckedDay = array_diff(array_keys(ClinicScheduleAssistant::WEEKDAY), $input['checked_week_days']);
            $checkDayOfWeek = DB::table('session_week_days_assistant')->whereIn('day_of_week', $unCheckedDay)->exists();

            if ($checkDayOfWeek) {
                return $this->sendError($message);
            } else {
                return $this->sendSuccess('');
            }
        }

        $checkDayOfWeek = DB::table('session_week_days_assistant')->exists();
        if ($checkDayOfWeek) {
            return $this->sendError($message);
        }

        return $this->sendResponse('checkDayOfWeek', __('messages.flash.data_retrieve'));
    }

    /**
     * Remove the specified ClinicScheduleAssistant from storage.
     */
    public function destroy(ClinicScheduleAssistant $clinicSchedule): JsonResponse
    {
        $clinicSchedule->delete();

        return $this->sendSuccess(__('messages.flash.clinic_delete'));
    }
}
