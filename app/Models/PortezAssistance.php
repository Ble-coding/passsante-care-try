<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * Class Encounter
 *
 * @version September 3, 2021, 7:09 am UTC
 *
 * @property string $assistant
 * @property string $patient
 * @property string $description
 * @property int $id
 * @property int $assistant_id
 * @property int $patient_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static \Database\Factories\EncounterFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance query()
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance whereAssistantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance whereEncounterDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance whereUpdatedAt($value)
 *
 * @mixin Model
 *
 * @property string $assistance_date
 * @property-read Assistant $assistanceAssistant
 * @property-read \App\Models\Patient $assistancePatient
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PortezAssistance whereAssistanceDate($value)
 */
class PortezAssistance extends Model
{
    use HasFactory;

    public $table = 'portez_assistances';

    protected $fillable = [
        'assistance_date',
        'assistant_id',
        'patient_id',
        'heure_debut',
        'heure_fin',
        'statut',
        'vulnerabilites',
        'type',
        'motif_enquete',
        'decision',
        'etat_enquete',
        'motif_service',
        'autre_motif_service',
        'activites_menees',
        'autres_activites',
        'delai',
        'resultat_realisation',
        'devenir_du_cas',
        'observation',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'assistance_date' => 'string',
        'assistant' => 'integer',
        'patient' => 'integer', 
        // 'heure_debut' => 'time',
        // 'heure_fin' => 'time',
        'statut' => 'integer',
        'vulnerabilites' => 'json',
        'type' => 'integer',
        'motif_enquete' => 'integer',
        'decision' => 'integer',
        'etat_enquete' => 'integer',
        'motif_service' => 'json',
        'activites_menees' => 'json',
        'delai' => 'integer',
        'resultat_realisation' => 'integer',
        'devenir_du_cas' => 'json',
    ];
    

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'assistant_id' => 'required|exists:assistants,id',
        'patient_id' => 'required|exists:patients,id',
        // 'heure_debut' => 'required|date_format:H:i:s',
        'heure_debut' => 'required',
        'heure_fin' => 'required',
        'statut' => 'required|integer',
        'vulnerabilites' => 'nullable|array',
        'type' => 'nullable|integer',
        'motif_enquete' => 'nullable|integer',
        'decision' => 'nullable|integer',
        'etat_enquete' => 'nullable|integer',
        'motif_service' => 'nullable|array',
        'autre_motif_service' => 'nullable|string',
        'activites_menees' => 'nullable|array',
        'autres_activites' => 'nullable|string',
        'delai' => 'nullable|integer',
        'resultat_realisation' => 'nullable|integer',
        'devenir_du_cas' => 'nullable|array',
        'observation' => 'nullable|string',
    ];

    public function assistanceAssistant(): BelongsTo
    {
        return $this->belongsTo(Assistant::class, 'assistant_id');
    }

    public function assistant(): BelongsTo
    {
        return $this->belongsTo(Assistant::class, 'assistant_id');
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function assistancePatient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function problems(): HasMany
    {
        return $this->hasMany(VisitProblem::class, 'visit_id');
    }

    public function observations(): HasMany
    {
        return $this->hasMany(VisitObservation::class, 'visit_id');
    }

    public function notes(): HasMany 
    {
        return $this->hasMany(VisitNote::class, 'visit_id');
    }

    public function prescriptions(): HasMany
    {
        return $this->hasMany(VisitPrescription::class, 'visit_id');
    }
}
