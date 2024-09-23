<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AssistantHoliday
 *
 * @property int $id
 * @property string|null $name
 * @property int $assistant_id
 * @property string $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Assistant $assistant
 *
 * @method static \Illuminate\Database\Eloquent\Builder|AssistantHoliday newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AssistantHoliday newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AssistantHoliday query()
 * @method static \Illuminate\Database\Eloquent\Builder|AssistantHoliday whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssistantHoliday whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssistantHoliday whereassistantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssistantHoliday whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssistantHoliday whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssistantHoliday whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class AssistantHoliday extends Model
{
    use HasFactory;

    public $table = 'assistant_holidays';

    public $fillable = [
        'assistant_id',
        'date',
        'name',
    ];

    public static $rules = [
        'assistant_id' => 'required',
        'date' => 'required',
    ];

    const ALL = 0;

    const UPCOMING_HOLIDAY = 1;

    const PAST_HOLIDAY = 2;

    const TODAY = 3;

    const ALL_STATUS = [
        self::ALL => 'All',
        self::TODAY => 'Today',
        self::UPCOMING_HOLIDAY => 'Upcoming Holidays',
        self::PAST_HOLIDAY => 'Past Holidays',
    ];

    public function assistant()
    {
        return $this->belongsTo(Assistant::class, 'assistant_id');
    }
}
