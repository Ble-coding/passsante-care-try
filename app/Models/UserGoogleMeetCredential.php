<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\UserGoogleMeetCredential
 *
 * @property int $id
 * @property int $user_id
 * @property string $google_meet_api_key
 * @property string $google_meet_refresh_token
 * @property string|null $google_meet_access_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoogleMeetCredential newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoogleMeetCredential newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoogleMeetCredential query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoogleMeetCredential whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoogleMeetCredential whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoogleMeetCredential whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoogleMeetCredential whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoogleMeetCredential whereGoogleMeetApiKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoogleMeetCredential whereGoogleMeetRefreshToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGoogleMeetCredential whereGoogleMeetAccessToken($value)
 *
 * @mixin \Eloquent
 */
class UserGoogleMeetCredential extends Model
{
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'google_meet_api_key' => 'required',
        'google_meet_refresh_token' => 'required',
    ];

    protected $table = 'user_google_meet_credentials';

    protected $fillable = [
        'user_id',
        'google_meet_api_key',
        'google_meet_refresh_token',
        'google_meet_access_token',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'google_meet_api_key' => 'string',
        'google_meet_refresh_token' => 'string',
        'google_meet_access_token' => 'string',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
