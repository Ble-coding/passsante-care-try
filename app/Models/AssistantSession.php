<?php

namespace App\Models;

use Database\Factories\AssistantSessionFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\AssistantSession
 *
 * @property int $id
 * @property int $assistant_id
 * @property string $session_meeting_time
 * @property string $session_gap
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Assistant $assistant
 * @property-read Collection|WeekDay_assistant[] $sessionWeekDays
 * @property-read int|null $session_week_days_assistant_count
 *
 * @method static AssistantSessionFactory factory(...$parameters)
 * @method static Builder|AssistantSession newModelQuery()
 * @method static Builder|AssistantSession newQuery()
 * @method static Builder|AssistantSession query()
 * @method static Builder|AssistantSession whereCreatedAt($value)
 * @method static Builder|AssistantSession whereAssistantId($value)
 * @method static Builder|AssistantSession whereId($value)
 * @method static Builder|AssistantSession whereSessionGap($value)
 * @method static Builder|AssistantSession whereSessionMeetingTime($value)
 * @method static Builder|AssistantSession whereUpdatedAt($value)
 */
class AssistantSession extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'assistant_sessions';

    /**
     * @var string[]
     */
    protected $fillable = [
        'assistant_id',
        'session_meeting_time',
        'session_gap',
    ];

    protected $casts = [
        'assistant_id' => 'integer',
        'session_meeting_time' => 'integer',
        'session_gap' => 'string',
    ];

    const MALE = 1;

    const FEMALE = 2;

    const GENDER = [
        self::MALE => 'Male',
        self::FEMALE => 'Female',
    ];

    const GAPS = [
        '5' => '5 minutes',
        '10' => '10 minutes',
        '15' => '15 minutes',
        '20' => '20 minutes',
        '25' => '25 minutes',
        '30' => '30 minutes',
        '45' => '45 minutes',
        '60' => '1 hour',
    ];

    const SESSION_MEETING_TIME = [
        '5' => '5 minutes',
        '10' => '10 minutes',
        '15' => '15 minutes',
        '30' => '30 minutes',
        '45' => '45 minutes',
        '60' => '1 hour',
        '90' => '1.5 hour',
        '120' => '2 hour',
    ];

    /** 
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'assistant_id' => 'required',
        'session_meeting_time' => 'required',
        'session_gap' => 'required',
    ];

    public function sessionWeekDays(): HasMany
    {
        return $this->hasMany(WeekDay_assistant::class);
    }

    public function assistant(): BelongsTo
    {
        return $this->belongsTo(Assistant::class);
    }
}
