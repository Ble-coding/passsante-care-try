<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AssistantController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorSessionController;
use App\Http\Controllers\GoogleCalendarController;
use App\Http\Controllers\HolidayContoller;
use App\Http\Controllers\LiveConsultationController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmartPatientCardsController; 
use App\Http\Controllers\GeneratePatientSmartCardsController;
use App\Http\Controllers\HistoriqueController;
use App\Http\Controllers\PatientQrCodeController;
use App\Http\Controllers\VisiteurController;

Route::prefix('assistants')->name('assistants.')->middleware('auth', 'xss', 'checkUserStatus', 'role:assistant')->group(function () {
  
    // Route::get('/patients-detail/{patient}', [PatientController::class, 'show'])->name('patient.detail');
 
    //Assistant dashboard route
    Route::get('/dashboard', [DashboardController::class, 'assistantDashboard'])->name('dashboard');
    Route::get('/assistant-dashboard', 
        [DashboardController::class, 'getDoctorAppointment'])->name('appointment.dashboard');

        // Les routes concernant les visiteurs 
    Route::middleware('permission:manage_profils_sociaux_usagers')->group(function () {
        // Route::resource('visiteurs', VisiteurController::class);
        // Route::delete('visiteurs/{visiteur}', [VisiteurController::class, 'destroy'])->name('visiteurs.destroy');
    });

        // Les routes concernant le traitement des cas des visiteurs 
 

    Route::middleware('permission:manage_historique')->group(function () {
        Route::resource('historiques-visites', HistoriqueController::class);
    });


});
