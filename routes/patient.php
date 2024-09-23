<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ReviewsAssistantController;
use App\Http\Controllers\AssistantController;
use App\Http\Controllers\TransactionAssistantController;
use App\Http\Controllers\ServiceAssistantController;
use App\Http\Controllers\PatientAppointmentAssistantController;
use App\Http\Controllers\AppointmentAssistantController;
use App\Http\Controllers\AssistantsSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorSessionController;
use App\Http\Controllers\GoogleCalendarController;
use App\Http\Controllers\LiveConsultationController;
use App\Http\Controllers\PatientAppointmentController;
use App\Http\Controllers\PatientVisitController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\PatientAssistanceController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmartPatientCardsController;
use App\Http\Controllers\GeneratePatientSmartCardsController;
use App\Http\Controllers\PatientConsultationController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PatientQrCodeController;

Route::prefix('patients')->name('patients.')->middleware('auth', 'xss', 'checkUserStatus', 'role:patient')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'patientDashboard'])->name('dashboard');
    Route::get(
        '/dashboard-patients',
        [DashboardController::class, 'getPatientList']
    )->name('patientData.dashboard');

    // rendez-vous avec le docteur
    Route::resource('appointments', AppointmentController::class)->except(['index', 'edit', 'update']);
    Route::get('appointment-pdf/{id}', [AppointmentController::class, 'appointmentPdf'])->name('appointmentPdf');
    Route::get('appointments', [PatientAppointmentController::class, 'index'])->name('patient-appointments-index');


    // rendez-vous avec le travailleur social (assistant)
    Route::resource('assistants-appointment', AppointmentAssistantController::class);
    Route::get('appointment-assistant-pdf/{id}', [AppointmentAssistantController::class, 'appointmentPdf'])->name('appointmentPdf-assistant');

    Route::get('assistants-appointment', [PatientAppointmentAssistantController::class, 'index'])
    ->name('patient-assistant-appointments-assistant-index');



// CAS DU DOCTEUR
    Route::get('doctor-session-time',[DoctorSessionController::class, 'getDoctorSession']
    )->name('doctor-session-time');
    Route::get('get-service', [ServiceController::class, 'getService'])->name('get-service');
    Route::get('get-charge', [ServiceController::class, 'getCharge'])->name('get-charge');

    //        Route::get('appointment-cancel', [AppointmentController::class, 'cancelStatus'])->name('cancel-status');

    Route::get('patient-appointments-calendar', [AppointmentController::class, 'patientAppointmentCalendar'])->name('appointments.calendar');

    Route::get('transactions', [TransactionController::class, 'index'])->name('transactions');
    Route::get('transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');
    Route::post('appointment-cancel', [AppointmentController::class, 'cancelStatus'])->name('cancel-status');
    Route::get('doctors/{doctor}', [UserController::class, 'show'])->name('doctor.detail');
    Route::get('appointments/{appointment}',[AppointmentController::class, 'show']
    )->name('appointment.detail');
    Route::post('appointment-payment',[AppointmentController::class, 'appointmentPayment']
    )->name('appointment-payment');


// CAS DU TRAVAILLEUR SOCIAL

    Route::get('assistant-session-time',[AssistantsSessionController::class, 'getDoctorSession']
    )->name('doctor-session-time-assistant');
    Route::get('get-assistant-service', [ServiceAssistantController::class, 'getService'])->name('get-assistant-service');
    Route::get('get-assistant-charge', [ServiceAssistantController::class, 'getCharge'])->name('get-assistant-charge');

    //        Route::get('appointment-assistant-cancel', [AppointmentAssistantController::class, 'cancelStatus'])->name('cancel-status');

    Route::get('patient-assistant-appointment-assistant-calendar', [AppointmentAssistantController::class, 'patientAppointmentCalendar'])->name('assistants-appointment.calendar');

    Route::get('transactions-assistant', [TransactionAssistantController::class, 'index'])->name('transactions-assistant');
    Route::get('transactions-assistant/{transaction}', [TransactionAssistantController::class, 'show'])->name('transactions-assistant.show');
    Route::post('appointment-assistant-cancel', [AppointmentAssistantController::class, 'cancelStatusAssistant'])->name('cancel-assistant-status');
    Route::get('assistants/{assistant}', [AssistantController::class, 'show'])->name('assistant.detail');
    Route::get('appointments-assistant/{appointment}',[AppointmentAssistantController::class, 'show']
    )->name('appointment.assistant.detail');
    Route::post('appointment-assistant-payment',[AppointmentAssistantController::class, 'appointmentPayment']
    )->name('appointment-assistant-payment');

    // VISITES
    Route::get('patient-visits', [PatientVisitController::class, 'index'])->name('patient.visits.index');
    Route::get('patient-visits/{patientVisit}',  [PatientVisitController::class, 'show'])->name('patient.visits.show');

    // PORTEZ ASSISTANCE
    Route::get('patient-assistances', [PatientAssistanceController::class, 'index'])->name('patient.assistances.index');
    Route::get('patient-assistances/{patientAssistance}',  [PatientAssistanceController::class, 'show'])->name('patient.assistances.show');

    // AGENDA
    Route::get('connect-google-calendar',[GoogleCalendarController::class, 'googleCalendar']
    )->name('googleCalendar.index');
    Route::get('disconnect-google-calendar',[GoogleCalendarController::class, 'disconnectGoogleCalendar']
    )->name('disconnectCalendar.destroy');


    Route::post('appointment-google-calendar', [
        GoogleCalendarController::class, 'appointmentGoogleCalendarStore',
    ])->name('appointmentGoogleCalendar.store');

    // CAS DU TRAVAILLEUR SOCIAL
    Route::post('appointment-assistant-google-calendar', [
        GoogleCalendarController::class, 'appointmentGoogleCalendarStore',
    ])->name('appointmentAssistantGoogleCalendar.store');


    Route::resource('reviews', ReviewController::class)->except(['delete', 'create']);

    Route::resource('reviews-assistant', ReviewsAssistantController::class)->except(['delete', 'create']);

    Route::resource('live-consultations', LiveConsultationController::class);
    Route::get(
        'live-consultation/{liveConsultation}/start',
        [LiveConsultationController::class, 'getLiveStatus']
    )->name('live.consultation.get.live.status');
    Route::get('user-zoom-credential/{userZoomCredential}/fetch',
    [LiveConsultationController::class, 'zoomCredential'])->name('zoom.credential.patient');
    Route::post('user-zoom-credential',
    [LiveConsultationController::class, 'zoomCredentialCreate'])->name('zoom.credential.create.patient');


    // Route for Prescription
    Route::resource('prescriptions', PrescriptionController::class)->except('create', 'edit', 'index');
    Route::get('appointments/{appointmentId}/prescription-create', [PrescriptionController::class, 'create'])->name('prescriptions.create');
    Route::get('appointments/{appointmentId}/prescription-edit/{prescription}', [PrescriptionController::class, 'edit'])->name('prescriptions.edit');
    Route::post('prescription-medicine', [PrescriptionController::class, 'prescreptionMedicineStore'])->name('prescription.medicine.store');
    Route::post('prescriptions/{prescription}/active-deactive', [PrescriptionController::class, 'activeDeactiveStatus'])->name('prescription.status');
    Route::get('prescription-medicine-show/{id}', [PrescriptionController::class, 'prescriptionMedicineShowFunction'])->name('prescription.medicine.show');
    Route::get('prescription-pdf/{id}', [PrescriptionController::class, 'convertToPDF'])->name('prescriptions.pdf');

    //smart patient cardsd
    Route::resource('smart-patient-cards', SmartPatientCardsController::class);
    Route::put('card-status/{id}', [SmartPatientCardsController::class, 'changeCardStatus'])->name('card.status');

    Route::resource('generate-patient-smart-cards', GeneratePatientSmartCardsController::class);
    Route::get('card-detail/{id}', [GeneratePatientSmartCardsController::class, 'cardDelail'])->name('card.detail');
    Route::get('card-qr-code/{id}', [GeneratePatientSmartCardsController::class, 'cardQr'])->name('card.qr');
    Route::get('smart_card-pdf/{id}', [GeneratePatientSmartCardsController::class, 'smartCardPdf'])->name('patients.smartCardPdf');

    // Personnal card
    Route::get('my-card', [PatientController::class, 'showMyCard'])->name('show_my_card');
});
