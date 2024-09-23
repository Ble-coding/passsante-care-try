<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\AppBaseController;
use App\Models\Assistant;
use App\Models\AssistantSession;
use App\Models\ClinicScheduleAssistant;
use App\Models\ServiceAssistantCategory;
// use App\Models\Doctor;
// use App\Models\DoctorSession;
use App\Models\Faq;
use App\Models\FrontPatientTestimonial;
use App\Models\Patient;
use App\Models\Service;
use App\Models\ServiceAssistant;
use App\Models\ServiceCategory;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FrontAssistantController extends AppBaseController
{
    /**
     * @return Application|Factory|View
     */
    public function medical(): \Illuminate\View\View
    {
        $doctors = Assistant::with('user', 'specializations')->whereHas('user', function (Builder $query) {
            $query->where('status', User::ACTIVE);
        })->latest()->take(10)->get()->pluck('user.full_name', 'id');
        $sliders = Slider::with('media')->first();
        $frontMedicalServicesArray = ServiceAssistant::with('media')->whereStatus(ServiceAssistant::ACTIVE)->latest()->get()->toArray();
        $frontMedicalServices = array_chunk($frontMedicalServicesArray, 2);
        $frontPatientTestimonials = FrontPatientTestimonial::with('media')->latest()->take(6)->get();
        $aboutExperience = Setting::where('key', 'about_experience')->first();

        return view('fronts_assistant.medicals.index',
            compact('doctors', 'sliders', 'frontMedicalServices', 'frontPatientTestimonials',
                'aboutExperience'));
    }

    /**
     * @return Application|Factory|View
     */
    public function medicalAboutUs(): \Illuminate\View\View
    {
        $data = [];
        $data['doctorsCount'] = Assistant::with('user')->get()->where('user.status', true)->count();
        $data['patientsCount'] = Patient::get()->count();
        $data['servicesCount'] = ServiceAssistant::whereStatus(true)->get()->count();
        $data['specializationsCount'] = Specialization::get()->count();
        $clinicSchedules = ClinicScheduleAssistant::all();
        $setting = Setting::where('key', 'about_us_image')->first();
        $frontPatientTestimonials = FrontPatientTestimonial::with('media')->latest()->take(6)->get();
        $doctors = Assistant::with('user', 'appointment_assistants', 'specializations')->whereHas('user', function (Builder $query) {
            $query->where('status', User::ACTIVE);
        })->withCount('appointment_assistants')->orderBy('appointments_count', 'desc')->take(3)->get();

        return view('fronts_assistant.medical_about_us',
            compact('doctors', 'data', 'setting', 'clinicSchedules', 'frontPatientTestimonials'));
    }

    /**
     * @return Application|Factory|View
     */
    public function medicalServices(): \Illuminate\View\View
    {
        $data = [];
        $serviceCategories = ServiceAssistantCategory::with('activatedServices')->withCount('services')->get();
        $setting = Setting::pluck('value', 'key')->toArray();
        $services = ServiceAssistant::with('media')->whereStatus(ServiceAssistant::ACTIVE)->latest()->get();
        $data['doctorsCount'] = Assistant::with('user')->get()->where('user.status', true)->count();
        $data['patientsCount'] = Patient::get()->count();
        $data['servicesCount'] = ServiceAssistant::whereStatus(true)->get()->count();
        $data['specializationsCount'] = Specialization::get()->count();

        return view('fronts_assistant.medical_services', compact('serviceCategories', 'setting', 'services', 'data'));
    }

    /**
     * @return Application|Factory|View
     */
    public function medicalAppointment(): \Illuminate\View\View
    {
        $faqs = Faq::latest()->get();

        $appointmentDoctors = Assistant::with('user')->whereIn('id',
            AssistantSession::pluck('assistant_id')->toArray())->get()->where('user.status',
                User::ACTIVE)->pluck('user.full_name', 'id');

        return view('fronts.medical_appointment', compact('faqs', 'appointmentDoctors'));
    }

    /**
     * @return Application|Factory|View
     */
    public function medicalAppointmentAssistant(): \Illuminate\View\View
    {
        $faqs = Faq::latest()->get();

        $appointmentDoctors = Assistant::with('user')->whereIn('id',
            AssistantSession::pluck('assistant_id')->toArray())->get()->where('user.status',
                User::ACTIVE)->pluck('user.full_name', 'id');

        return view('fronts_assistant.medical_appointment', compact('faqs', 'appointmentDoctors'));
    }

    /**
     * @return Application|Factory|View
     */
    public function medicalAssistants(): \Illuminate\View\View
    {
        $doctors = Assistant::with('specializations', 'user')->whereHas('user', function (Builder $query) {
            $query->where('status', User::ACTIVE);
        })->latest()->take(9)->get();

        return view('fronts_assistant.medical_doctors', compact('doctors'));
    }

    /**
     * @return Application|Factory|View
     */
    public function medicalContact(): \Illuminate\View\View
    {
        $clinicSchedules = ClinicScheduleAssistant::all();

        return view('fronts_assistant.medical_contact', compact('clinicSchedules'));
    }

    /**
     * @return Application|Factory|View
     */
    public function termsCondition(): \Illuminate\View\View
    {
        $termConditions = Setting::pluck('value', 'key')->toArray();

        return view('fronts_assistant.terms_conditions', compact('termConditions'));
    }

    /**
     * @return Application|Factory|View
     */
    public function privacyPolicy(): \Illuminate\View\View
    {
        $privacyPolicy = Setting::pluck('value', 'key')->toArray();

        return view('fronts_assistant.privacy_policy', compact('privacyPolicy'));
    }

    /**
     * @return Application|Factory|View
     */
    public function faq(): \Illuminate\View\View
    {
        $faqs = Faq::latest()->get();

        return view('fronts_assistant.faq', compact('faqs'));
    }

    /**
     * @return mixed
     */
    public function changeLanguage(Request $request)
    {
        Session::put('languageName', $request->input('languageName'));

        return $this->sendSuccess(__('messages.flash.language_change'));
    }
}
