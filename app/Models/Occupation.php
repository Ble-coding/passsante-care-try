<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * Class Specialization
 *
 * @version August 2, 2021, 10:19 am UTC
 *
 * @property string $name
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static \Database\Factories\OccupationFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|occupation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|occupation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|occupation query()
 * @method static \Illuminate\Database\Eloquent\Builder|occupation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|occupation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|occupation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|occupation whereUpdatedAt($value)
 *
 * @mixin Model
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Doctor[] $doctors
 * @property-read int|null $doctors_count
 */
class Occupation extends Model
{
    use HasFactory;

    protected $table = 'occupations';

    public $fillable = [
        'name',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|unique:occupations,name',
    ];

    public function assistants(): BelongsToMany
    {
        return $this->belongsToMany(Assistant::class);
    }
}
