<?php

namespace App\Repositories;

use App\Models\Assistant;
use App\Models\AssistantSession;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class AssistantSessionRepository 
 *
 * @version July 31, 2021, 6:04 am UTC
 */
class AssistantSessionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'session_time',
    ];

    /**
     * Return searchable fields
     */
    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return AssistantSession::class;
    }

    public function getSyncList(): Collection
    {
        if (getLogInUser()->hasRole('assistant')) {
            return Assistant::toBase()->where('user_id', getLogInUserId())->get()->pluck('user.full_name', 'id');
        }

        return Assistant::with('user')->whereNotIn('id',
            AssistantSession::pluck('assistant_id')->toArray())->get()->where('user.status',
                User::ACTIVE)->pluck('user.full_name', 'id');
    }

    /**
     * @return array|bool[]|false
     */
    public function store($input)
    {
        try {
            DB::beginTransaction();
            /** @var AssistantSession $assistantSession */
            $assistantSession = AssistantSession::create(Arr::only($input, app(AssistantSession::class)->getFillable()));
            $result['success'] = true;
            if (! empty($input['checked_week_days']) && count($input['checked_week_days']) > 0) {
                foreach ($input['checked_week_days'] as $day) { 
                    $exists = DB::table('session_week_days_assistant')
                        ->where('assistant_id', $input['assistant_id'])
                        ->where('day_of_week', $day)
                        ->exists();

                    if ($exists) {
                        return false;
                    }
                    $result = $this->validateSlotTiming($input, $day);
                    if (! $result['success']) { 
                        return $result;
                    }
                    $this->saveSlots($input, $day, $assistantSession);
                }
            }

            DB::commit();

            return $result;
        } catch (\Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @return array|bool[]
     */
    public function updateAssistantSession(array $input, AssistantSession $assistantSession)
    {
        try {
            DB::beginTransaction();
            $assistantId = $assistantSession->assistant_id;
            $assistantSession->update($input);
            $result['success'] = true;

            $assistantSession->sessionWeekDays()->delete();
            if (! empty($input['checked_week_days'])) {
                foreach ($input['checked_week_days'] as $day) {
                    $result = $this->validateSlotTiming($input, $day);
                    if (! $result['success']) {
                        return $result;
                    }
                    $this->saveSlots($input, $day, $assistantSession);
                }
            }

            DB::commit();

            return $result;
        } catch (\Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function saveSlots($input, $day, $assistantSession): bool
    {
        /** @var AssistantSession $assistantSession */
        $startTimeArr = $input['startTimes'][$day] ?? [];
        $endTimeArr = $input['endTimes'][$day] ?? [];
        if (count($startTimeArr) != 0 && count($endTimeArr) != 0) {
            foreach ($startTimeArr as $key => $startTime) {
                $startTimeData = explode(' ', $startTime);
                $endTimeData = explode(' ', $endTimeArr[$key]);
                $assistantSession->sessionWeekDays()->create([
                    'assistant_id' => $assistantSession->assistant_id,
                    'assistant_session_id' => $assistantSession->id,
                    'day_of_week' => $day,
                    'start_time' => $startTimeData[0],
                    'start_time_type' => $startTimeData[1],
                    'end_time' => $endTimeData[0],
                    'end_time_type' => $endTimeData[1],
                ]);
            }
        }

        return true;
    }

    public function validateSlotTiming($input, $day)
    {
        $startTimeArr = $input['startTimes'][$day] ?? [];
        $endTimeArr = $input['endTimes'][$day] ?? [];
        foreach ($startTimeArr as $key => $startTime) {
            $slotStartTime = Carbon::instance(DateTime::createFromFormat('h:i A', $startTime));
            $tempArr = Arr::except($startTimeArr, [$key]);
            foreach ($tempArr as $tempKey => $tempStartTime) {
                $start = Carbon::instance(DateTime::createFromFormat('h:i A', $tempStartTime));
                $end = Carbon::instance(DateTime::createFromFormat('h:i A', $endTimeArr[$tempKey]));
                if ($slotStartTime->isBetween($start, $end)) {
                    return ['day' => $day, 'startTime' => $startTime, 'success' => false, 'key' => $key];
                }
            }
        }

        return ['success' => true];
    }
}
