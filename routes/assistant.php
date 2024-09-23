<?php

use App\Http\Controllers\AppointmentAssistantController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AssistantHolidayController;
use App\Http\Controllers\AssistantsSessionController;
use App\Http\Controllers\GoogleCalendarController;
use App\Http\Controllers\AssistantHolidayContoller;
use App\Http\Controllers\LiveConsultationController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmartPatientCardsController;
use App\Http\Controllers\GeneratePatientSmartCardsController;
use App\Http\Controllers\PatientQrCodeController;
use App\Http\Controllers\DataVisiteurController;
use App\Http\Controllers\PatientAssistanceController;
use App\Http\Controllers\PortezAssistanceController;

Route::prefix('assistants')->name('assistants.')->middleware('auth', 'xss', 'checkUserStatus', 'role:assistant')->group(function () {

    Route::get('/patients-detail/{patient}', [PatientController::class, 'show'])->name('patient.detail');

    //assistant dashboard route
    Route::get('/dashboard', [DashboardController::class, 'assistantDashboard'])->name('dashboard');
    // Route::get('/assistant-dashboard', [DashboardController::class, 'getAssistantAppointment'])->name('appointment.dashboard');

    //Assistance route
    Route::resource('assistances', PortezAssistanceController::class);

    Route::resource('doctor-visits', VisitController::class);
    // Doctor Session Routes
    // Route::resource('assistant-appointments', AppointmentAssistantController::class)->except(['index', 'edit', 'update']);

    // Assistant Session Routes
    Route::resource('asstts-apptmt', AppointmentAssistantController::class)
        ->except(['index', 'edit', 'update']);
    Route::get(
        'assistant-session-time',
        [AssistantsSessionController::class, 'getAssistantSession']
    )->name('assistant-session-time');
    Route::resource('assistant-sessions', AssistantsSessionController::class);
    Route::get('get-assistant-slot-by-gap', [AssistantsSessionController::class, 'getSlotByGap'])->name('get.assistant.slot.by.gap');
    Route::get('schedule-assistant-edit', [AssistantsSessionController::class, 'assistantScheduleEdit'])->name('schedule.assistant.edit');


    //Assistant Appointment route  RDV
    Route::get('asstts-apptmt', [AppointmentAssistantController::class, 'assistantAppointment'])->name('asstts-apptmt'); //vue
    Route::get(
        'appointments-assistant-calendar',
        [AppointmentAssistantController::class, 'assistantAppointmentCalendar']
    )->name('appointments-assistant.calendar');
    Route::get(
        'appointments-assistant/{appointment}',
        [AppointmentAssistantController::class, 'appointmentDetail']
    )->name('appointment-assistant.detail');
    Route::get(
        'appointment-assistant-pdf/{id}',
        [AppointmentAssistantController::class, 'appointmentPdf']
    )->name('appointmentPdf-assistant');

        // rendez-vous routes
        Route::post('appointments-assistant/{appointment}',
        [AppointmentAssistantController::class, 'changeStatus'])->name('change-status-assistant');
    Route::post('appointments-payment-assistant/{id}',
        [AppointmentAssistantController::class, 'changePaymentStatus'])->name('change-payment-status-assistant');
    Route::get('patient-appointments-assistant',
        [PatientController::class, 'patientAppointment'])->name('patients.appointment-assistant');
    Route::get('appointments-assistant/{appointment}',
        [AppointmentAssistantController::class, 'show'])->name('appointment-assistant.detail');
    // Route::get('assistants/{doctor}', [UserController::class, 'show'])->name('assistants.detail');
    // Route::get('assistants-appointment',
    //     [UserController::class, 'doctorAppointment'])->name('assistants.appointment');


        // Google calandar

        Route::get('connect-google-calendar',
        [GoogleCalendarController::class, 'googleCalendar'])->name('googleCalendar.index');
    Route::get('disconnect-google-calendar',
        [GoogleCalendarController::class, 'disconnectGoogleCalendar'])->name('disconnectCalendar.destroy');
    Route::post('appointment-google-calendar', [
        GoogleCalendarController::class, 'appointmentGoogleCalendarStore',
    ])->name('appointmentGoogleCalendar.store');

    //Assistant Holiday Route

    Route::get('asstt-holidy', [AssistantHolidayController::class, 'holiday'])->name('holiday-assistant');
    Route::get('asstt-holidy/create', [AssistantHolidayController::class, 'assistantCreate'])->name('holiday-assistant-create');
    Route::post('asstt-holidy/create', [AssistantHolidayController::class, 'assistantStore'])->name('holiday-assistant-store');
    Route::delete('asstt-holidy/delete/{holiday}', [AssistantHolidayController::class, 'assistantDestroy'])->name('holiday-assistant-destroy');
});
