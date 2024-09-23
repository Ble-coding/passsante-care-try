<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\WeekDay_assistant
 *
 * @property int $id
 * @property int $assistant_id
 * @property int $assistant_session_id
 * @property string $day_of_week
 * @property string $start_time
 * @property string $end_time
 * @property string $start_time_type
 * @property string $end_time_type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay_assistant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay_assistant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay_assistant query()
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay_assistant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay_assistant whereDayOfWeek($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay_assistant whereAssistantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay_assistant whereAssistantSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay_assistant whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay_assistant whereEndTimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay_assistant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay_assistant whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay_assistant whereStartTimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeekDay_assistant whereUpdatedAt($value)
 *
 * @mixin Eloquent
 *
 * @property-read mixed $full_end_time
 * @property-read mixed $full_start_time
 * @property-read \App\Models\AssistantSession $assistantSession
 */
class WeekDay_assistant extends Model
{
    use HasFactory;

    public $table = 'session_week_days_assistant';

    public $fillable = [
        'assistant_id',
        'assistant_session_id',
        'day_of_week',
        'start_time',
        'end_time',
        'start_time_type',
        'end_time_type',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'assistant_session_id' => 'integer',
        'day' => 'string',
        'assistant_id' => 'integer',
        'day_of_week' => 'string',
        'start_time' => 'string',
        'end_time' => 'string',
        'start_time_type' => 'string',
        'end_time_type' => 'string',
    ];

    public function getFullStartTimeAttribute()
    {
        return $this->start_time.' '.$this->start_time_type;
    }

    public function getFullEndTimeAttribute()
    {
        return $this->end_time.' '.$this->end_time_type;
    }

    public function assistantSession()
    {
        return $this->belongsTo(AssistantSession::class);
    }
}
