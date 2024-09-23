<?php

namespace App\Models;

use Database\Factories\ServicesFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * Class ServiceAssistants
 *
 * @version August 2, 2021, 12:09 pm UTC
 *
 * @property string $category
 * @property string $name
 * @property string $charges
 * @property string $assistants
 * @property sting $status
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static ServiceAssistantsFactory factory(...$parameters)
 * @method static Builder|ServiceAssistant newModelQuery()
 * @method static Builder|ServiceAssistant newQuery()
 * @method static Builder|ServiceAssistant query()
 * @method static Builder|ServiceAssistant whereCategory($value)
 * @method static Builder|ServiceAssistant whereCharges($value)
 * @method static Builder|ServiceAssistant whereCreatedAt($value)
 * @method static Builder|ServiceAssistant whereAssistants($value)
 * @method static Builder|ServiceAssistant whereId($value)
 * @method static Builder|ServiceAssistant whereName($value)
 * @method static Builder|ServiceAssistant whereStatus($value)
 * @method static Builder|ServiceAssistant whereUpdatedAt($value)
 *
 * @mixin Model
 *
 * @property string $category_id
 * @property-read ServiceCategory $serviceCategory
 * @property-read Collection|\App\Models\Assistant[] $serviceAssistants
 * @property-read int|null $service_assistants_count
 *
 * @method static Builder|ServiceAssistant whereCategoryId($value)
 */
class ServiceAssistant extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'services_assistants'; 

    public $fillable = [
        'category_id',
        'name',
        'charges',
        'status',
        'short_description',
    ];

    const ALL = 2;

    const ACTIVE = 1;

    const DEACTIVE = 0;

    const STATUS = [
        self::ALL => 'All',
        self::ACTIVE => 'Active',
        self::DEACTIVE => 'Deactive',
    ];

    const ICON = 'icon';

    protected $appends = ['icon'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'category_id' => 'integer',
        'name' => 'string',
        'charges' => 'string',
        'status' => 'boolean',
        'short_description' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    // public static $rules = [
    //     'name' => 'required|unique:services_assistants,name',
    //     'category_id' => 'required',
    //     'charges' => 'required|min:0|not_in:0',
    //     'assistants' => 'required',
    //     'short_description' => 'required|max:60',
    //     'icon' => 'required|mimes:svg,jpeg,png,jpg',
    // ];
    public static $rules = [
        'name' => 'required|unique:services_assistants,name',
        'category_id' => 'required',
        'charges' => 'required|min:0|not_in:0',
        'assistants' => 'required',
        'short_description' => 'required|max:60',
        'icon' => 'required|mimes:svg,jpeg,png,jpg',
    ];

    public function serviceAssistants(): BelongsToMany
    {
        return $this->belongsToMany(Assistant::class, 'service_assistant', 'service_id', 'assistant_id');
    }



    public function serviceCategory(): BelongsTo
    {
        return $this->belongsTo(ServiceAssistantCategory::class, 'category_id', 'id');
    }

    public function getIconAttribute(): string
    {
        /** @var Media $media */
        $media = $this->getMedia(self::ICON)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return asset('web/media/avatars/male.png');
    }
}
