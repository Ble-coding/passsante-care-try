<?php

namespace App\Models;

use Database\Factories\ServiceAssistantCategoryFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class ServiceAssistantCategory
 *
 * @version August 2, 2021, 7:11 am UTC
 *
 * @property string $name
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static ServiceAssistantCategoryFactory factory(...$parameters)
 * @method static Builder|ServiceAssistantCategory newModelQuery()
 * @method static Builder|ServiceAssistantCategory newQuery()
 * @method static Builder|ServiceAssistantCategory query()
 * @method static Builder|ServiceAssistantCategory whereCreatedAt($value)
 * @method static Builder|ServiceAssistantCategory whereId($value)
 * @method static Builder|ServiceAssistantCategory whereName($value)
 * @method static Builder|ServiceAssistantCategory whereUpdatedAt($value)
 *
 * @mixin Model
 */
class ServiceAssistantCategory extends Model
{
    use HasFactory;

    protected $table = 'service_assistant_categories';

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
        'name' => 'required|unique:service_categories,name',
    ];

    public function services(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ServiceAssistant::class, 'category_id');
    }

    public function activatedServices(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ServiceAssistant::class, 'category_id')->where('status', ServiceAssistant::ACTIVE);
    }
}
