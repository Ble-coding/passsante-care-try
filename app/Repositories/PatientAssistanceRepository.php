<?php

namespace App\Repositories;

use App\Models\Visit;
use App\Models\Assistance;
use App\Models\PortezAssistance;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


/**
 * Class EncounterRepository
 *
 * @version September 3, 2021, 7:09 am UTC
 */
class PatientAssistanceRepository extends BaseRepository
{
    /** 
     * @var array
     */
    protected $fieldSearchable = [
        'assistance_date',
        'assistant',
    ];

    /**
     * Return searchable fields
     */
    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PortezAssistance::class;
    }

    /**
     * @return Builder|Builder[]|Collection|Model|null
     */

    public function getShowData($id)
    {
        return PortezAssistance::with(['assistanceAssistant.user'])->findOrFail($id);
    }

    public function getData(): array
    {
        $data['assistances'] = $this->getAssistances(); // Ajoutez cette ligne pour récupérer les assistances

        return $data;
    }

    public function getAssistances()
    {
        return PortezAssistance::all(); // Récupérer toutes les assistances de la table portez_assistances
    }

    // function recupererEtatEnquete()
    // {
    //     $etatsEnquete['etatsEnquete'] = PortezAssistance::pluck('etat_enquete');
    //     return $etatsEnquete;
    // }

    // function calculerDifferenceHeure()
    // {
    //     $assistances = PortezAssistance::select('heure_debut', 'heure_fin')->get();
    //     $differencesHeure = [];
    //     foreach ($assistances as $assistance) {
    //         $heureDebut = Carbon::parse($assistance->heure_debut);
    //         $heureFin = Carbon::parse($assistance->heure_fin);
    //         $difference = $heureDebut->diff($heureFin);
    //         $differencesHeure[] = $difference;
    //     }
    //     return $differencesHeure;
    // }



    // public function getShowData($id) 
    // {
    //     return PortezAssistance::with([   'assistanceAssistant.user',
    //          'problems', 'observations', 'notes', 'prescriptions',
    //     ])->findOrFail($id);
    // }
}
