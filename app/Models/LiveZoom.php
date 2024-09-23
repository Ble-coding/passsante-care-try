<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveZoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'consultation_title',
        'consultation_date',
        'duration_in_minute',
        'meeting_id',
        'description',
        'host_video',
        'participant_video',
        'user_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($liveZoom) {
            $liveZoom->user_id = Auth::id();
        });
    }


    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}
