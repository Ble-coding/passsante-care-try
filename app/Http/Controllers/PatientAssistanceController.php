<?php

namespace App\Http\Controllers;

use App\Models\Assistance;
use App\Models\PortezAssistance;
use App\Repositories\PatientAssistanceRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;


class PatientAssistanceController extends Controller
{
    //

    /** @var PatientAssistanceRepository */
    private $patientAssistanceRepository;

    public function __construct(PatientAssistanceRepository $patientAssistanceRepository)
    {
        $this->patientAssistanceRepository = $patientAssistanceRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index(): \Illuminate\View\View
    {
        return view('patient_assistances.index');
    }

    /**
     * @return Application|Factory|View|RedirectResponse
     */
    public function show($id)
    {
        if (getLogInUser()->hasRole('patient')) {
            $patient = PortezAssistance::whereId($id)->wherePatientId(getLogInUser()->patient->id);
            if (!$patient->exists()) {
                return redirect()->back();
            }
        }

        $assistance = $this->patientAssistanceRepository->getShowData($id);
        $data = $this->patientAssistanceRepository->getData();
        // $heure = $this->patientAssistanceRepository->calculerDifferenceHeure();
// dd($heure);
// dd($data);
// dd($etatsEnquete); 
        return view('patient_assistances.show', compact('assistance', 'data'));
    }
}
