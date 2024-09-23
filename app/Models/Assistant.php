<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use Database\Factories\PatientFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Permission\Traits\HasRoles;
use App\Models\User;
use App\Models\Visiteur;
use App\Models\DataVisiteur;
use App\Models\Department;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;



use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


/**
 * App\Models\Assistant
 *
 * @property int $id
 * @property int $user_id
 * @property float|null $experience
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Occupation[] $occupations
 * @property-read int|null $occupations_count
 * @property-read \App\Models\User $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Assistant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Assistant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Assistant query()
 * @method static \Illuminate\Database\Eloquent\Builder|Assistant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assistant whereExperience($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assistant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assistant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assistant whereUserId($value)
 *
 * @mixin \Eloquent
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Appointment[] $appointments
 * @property-read int|null $appointments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AssistantSession[] $assistantSession
 * @property-read int|null $assistant_session_count
 * @property string|null $twitter_url
 * @property string|null $linkedin_url
 * @property string|null $instagram_url
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Assistant whereInstagramUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assistant whereLinkedinUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assistant whereTwitterUrl($value)
 */

class Assistant extends Model implements HasMedia
{
    use HasFactory, Notifiable, InteractsWithMedia, HasRoles, Impersonate;


    protected $guarded = [];
    protected $table = 'assistants';

    protected $appends = ['full_name', 'profile_image', 'role_name', 'role_display_name'];
    const PROFILE = 'profile';
    

  /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'occupation',
        'experience',
        'twitter_url',
        'linkedin_url',
        'instagram_url',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'patient_unique_id' => 'string',

    ];


    const O_POSITIVE = 1;

    const A_POSITIVE = 2;

    const B_POSITIVE = 3;

    const AB_POSITIVE = 4;

    const O_NEGATIVE = 5;

    const A_NEGATIVE = 6;

    const B_NEGATIVE = 7;

    const AB_NEGATIVE = 8;

    const BLOOD_GROUP_ARRAY = [
        self::O_POSITIVE => 'O+',
        self::A_POSITIVE => 'A+',
        self::B_POSITIVE => 'B+',
        self::AB_POSITIVE => 'AB+',
        self::O_NEGATIVE => 'O-',
        self::A_NEGATIVE => 'A-',
        self::B_NEGATIVE => 'B-',
        self::AB_NEGATIVE => 'AB-',
    ];

    public static $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email|unique:users,email|regex:/(.*)@(.*)\.(.*)/',
        'contact' => 'nullable|unique:users,contact',
        'password' => 'required|same:password_confirmation|min:6',
        'dob' => 'nullable|date',
        // 'experience' => 'nullable|numeric',
        // 'specializations' => 'required',
        'gender' => 'required',
        'status' => 'nullable',
        'postal_code' => 'nullable',
        'profile' => 'nullable|mimes:jpeg,png,jpg|max:2000',
    ];
    
    const MALE = 1;

    const FEMALE = 2;

    const GENDER = [
        self::MALE => 'Male',
        self::FEMALE => 'Female',
    ];

    public function getProfileImageAttribute(): string
    {
        /** @var Media $media */
        $media = $this->getMedia(self::PROFILE)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }
        $gender = $this->gender;
        if ($gender == self::FEMALE) {
            return asset('web/media/avatars/female.png');
        }

        return asset('web/media/avatars/male.png');
    }
    
    public function getRoleNameAttribute()
    {
        $role = $this->roles->first();

        if (! empty($role)) {
            return $role->display_name;
        }
    }

    public function getRoleDisplayNameAttribute()
    {
        $role = $this->roles->first();

        if (! empty($role)) {
            return $role->name;
        }
    }

    public function getFullNameAttribute(): string
    {
        return $this->first_name.' '.$this->last_name;
    }

    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function assistantUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function testUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    } 

    public function occupations(): BelongsToMany
    {
        return $this->belongsToMany(Occupation::class, 'assistant_occupation', 'assistant_id', 'occupation_id');
    }

    public function assistantSession(): HasMany
    {
        return $this->hasMany(AssistantSession::class);
    }

    public function appointments_assistant(): HasMany
    {
        return $this->hasMany(AppointmentAssistant::class);
    }

    public function reviews_assistants(): HasMany
    {
        return $this->hasMany(Review_assistant::class);
    }

    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'owner');
    }

    public function specializations(): BelongsToMany
    {
        return $this->belongsToMany(Specialization::class, 'assistant_specialization', 'assistant_id', 'specialization_id');
    }
}
