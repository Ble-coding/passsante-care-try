<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\AppointmentAssistant;
use Carbon\Carbon;
use Flash;
use App\Repositories\PatientAssistantRepository;
use Symfony\Contracts\Service\Attribute\Required;
use App\Models\PortezAssistance;

class PatientQrCodeAssistantController extends AppBaseController
{
    private $patientRepository;

    public function __construct(PatientAssistantRepository $patientRepo)
    {
        $this->patientRepository = $patientRepo;
    }

    public function show($id)
    {
        $patient = Patient::with(['user.address', 'appointments', 'address'])->where('patient_unique_id',$id)->first();

        if (empty($id)) {
            Flash::error(__('messages.flash.patient_not_found'));

            return redirect(route('patients.index'));
        }

        $appointmentStatus = AppointmentAssistant::ALL_STATUS;
        $appointment = AppointmentAssistant::with('assistant')->where('patient_id', '=', $patient->id)->get();
        $visit = PortezAssistance::with(['assistant.user', 'patient.user'])->where('patient_id', '=', $patient->id)->get();
        $todayDate = Carbon::now()->format('Y-m-d');
        $data['todayAppointmentCount'] = AppointmentAssistant::wherePatientId($patient['id'])->where('date', '=',
            $todayDate)->count();
        $data['upcomingAppointmentCount'] = AppointmentAssistant::wherePatientId($patient['id'])->where('date', '>',
            $todayDate)->count();
        $data['completedAppointmentCount'] = AppointmentAssistant::wherePatientId($patient['id'])->where('date', '<',
            $todayDate)->count();

        return view('fronts_assistant.patient_qr_code.show', compact('patient','appointment','appointmentStatus', 'data','visit'))->with([
            'book' => AppointmentAssistant::BOOKED,
            'checkIn' => AppointmentAssistant::CHECK_IN,
            'checkOut' => AppointmentAssistant::CHECK_OUT,
            'cancel' => AppointmentAssistant::CANCELLED,
        ]);
    }
}
