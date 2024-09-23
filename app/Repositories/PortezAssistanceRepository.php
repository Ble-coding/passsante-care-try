<?php

namespace App\Repositories;

use App\Models\Assistant;
use App\Models\Patient;
use App\Models\PortezAssistance;
use Exception;
// use App\Models\Visit;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Illuminate\Support\Facades\DB;


/**
 * Class EncounterRepository
 *
 * @version September 3, 2021, 7:09 am UTC
 */
class PortezAssistanceRepository extends BaseRepository
{
    /** 
     * @var array
     */
    protected $fieldSearchable = [
        // 'visit_date',
        // 'patient',
        // 'description',
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

    public function getData(): array
    {
        $data['assistants'] = Assistant::with('user')->get()->where('user.status', true)->pluck('user.full_name', 'id');
        $data['patients'] = Patient::with('user')->get()->pluck('user.full_name', 'id');

        return $data;
    }

    // store 
    
    public function store($input): bool
    {
        try {
            DB::beginTransaction();
    
            $assistance = new PortezAssistance();
            $assistance->assistance_date = $input['assistance_date'];
            $assistance->assistant_id = $input['assistant_id'];
            $assistance->patient_id = $input['patient_id'];
            $assistance->heure_debut = $input['heure_debut'];
            $assistance->heure_fin = $input['heure_fin'];
            $assistance->statut = $input['statut'];
            $assistance->vulnerabilites = $input['vulnerabilites'];
            $assistance->type = $input['type'];
            $assistance->motif_enquete = $input['motif_enquete'];
            $assistance->decision = $input['decision'];
            $assistance->etat_enquete = $input['etat_enquete'];
            $assistance->motif_service = $input['motif_service'];
            $assistance->autre_motif_service = $input['autre_motif_service'];
            $assistance->activites_menees = $input['activites_menees'];
            $assistance->autres_activites = $input['autres_activites'];
            $assistance->delai = $input['delai']; 
            $assistance->resultat_realisation = $input['resultat_realisation'];
            $assistance->devenir_du_cas = $input['devenir_du_cas'];
            $assistance->observation = $input['observation'];
    
            $assistance->save();
    
            DB::commit();
    
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
    

    public function update($input, $encounter): bool
    {
        $encounter ->update($input);

        return true;
    }

    /**
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function getShowData($id)
    {
        return PortezAssistance::with([ 'assistanceAssistant.user', 'assistancePatient.user'])->findOrFail($id);

    }

    

     // return PortezAssistance::with([
        //     'visitDoctor.user', 'visitPatient.user', 'problems', 'observations', 'notes', 'prescriptions',
        // ])->findOrFail($id);
}
 