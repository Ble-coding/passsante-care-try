<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\AppointmentAssistant;
use App\Models\Notification;
use App\Models\NotificationAssistant;
use App\Models\Patient;
use App\Models\Transaction;
use App\Models\TransactionAssistant;
use App\Repositories\TransactionAssistantRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TransactionAssistantController extends AppBaseController
{
    /** @var TransactionAssistantRepository */
    private $transactionRepository;

    public function __construct(TransactionAssistantRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index(): \Illuminate\View\View
    {
        if (getLogInUser()->hasRole('patient')) {
            return view('transactions_assistants.patient_transaction');
        }

        if (getLogInUser()->hasRole('assistant')) {
            return view('transactions_assistants.doctors_transaction');
        }

        return view('transactions_assistants.index');
    }

    public function show($id): View|Factory|RedirectResponse|Application
    {
        if (getLogInUser()->hasRole('patient')) {
            $transaction = TransactionAssistant::findOrFail($id);
            if ($transaction->user_id !== getLogInUserId()) {
                return redirect()->back();
            }
        }
        if (getLogInUser()->hasRole('assistant')) {
            $transaction = TransactionAssistant::with('assistantappointment')->findOrFail($id);
            if (! $transaction->assistantappointment) {
                return redirect()->back();
            }
        }
        $transaction = $this->transactionRepository->show($id);

        return view('transactions_assistants.show', compact('transaction'));
    }

    public function changeTransactionStatus(Request $request): JsonResponse
    {
        $input = $request->all();

        $transaction = TransactionAssistant::findOrFail($input['id']);
        $appointment = AppointmentAssistant::where('appointment_unique_id', $transaction->appointment_id)->first();

        if (getLogInUser()->hasrole('assistant')) {
            $doctor = AppointmentAssistant::where('appointment_unique_id', $transaction->appointment_id)->whereAssistantId(getLogInUser()->assistant->id);
            if (! $doctor->exists()) {
                return $this->sendError(__('messages.common.not_allow__assess_record'));
            }
        }

        $appointment->update([
            'payment_method' => AppointmentAssistant::MANUALLY,
            'payment_type' => AppointmentAssistant::PAID,
        ]);

        $transaction->update([
            'status' => ! $transaction->status,
            'accepted_by' => $input['acceptPaymentUserId'],
        ]);

        $appointmentNotification = TransactionAssistant::with('acceptedPaymentUser')->whereAppointmentId($appointment['appointment_unique_id'])->first();

        $fullTime = $appointment->from_time.''.$appointment->from_time_type.' - '.$appointment->to_time.''.$appointment->to_time_type.' '.' '.Carbon::parse($appointment->date)->format('jS M, Y');
        $patient = Patient::whereId($appointment->patient_id)->with('user')->first();
        NotificationAssistant::create([
            'title' => $appointmentNotification->acceptedPaymentUser->full_name.' changed the payment status '.AppointmentAssistant::PAYMENT_TYPE[AppointmentAssistant::PENDING].' to '.AppointmentAssistant::PAYMENT_TYPE[$appointment->payment_type].' for appointment '.$fullTime,
            'type' => NotificationAssistant::PAYMENT_DONE,
            'user_id' => $patient->user_id,
        ]);

        return $this->sendSuccess(__("messages.flash.status_update"));
    }
}
