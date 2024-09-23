<?php

namespace App\Http\Controllers;

use App\Models\AppointmentAssistant;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;

class PatientAppointmentAssistantController extends Controller
{
    //
     /**
     * @return Application|Factory|View
     */
    public function index(): \Illuminate\View\View
    {
        $allPaymentStatus = getAllPaymentStatusAssistant();
        $paymentStatus = Arr::except($allPaymentStatus, [AppointmentAssistant::MANUALLY]);
        $paymentGateway = getPaymentGatewayAssistant();

        return view('patients.appointments_assistants.index', compact('paymentStatus', 'paymentGateway'));
    }
}
