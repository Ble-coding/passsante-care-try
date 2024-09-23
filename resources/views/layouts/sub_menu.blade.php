{{-- PATIENT  --}}

@role('patient')
    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('patients/dashboard*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('patients/dashboard*') ? 'active' : '' }}"
            href="{{ route('patients.dashboard') }}">{{ __('messages.dashboard') }}</a>
    </li>


    @php
        $isAppointment = Request::is('patients/appointments*');
        $isAppointmentsShow = Request::is('patients/appointments/*');
        $isAppointmentCalendar = Request::is('patients/patient-appointments-calendar*');
        $isAssistantsAppointments = Request::is('patients/appointments-assistant/*');

        // Assurez-vous que $isAssistantsAppointment est faux
        $isActive = ($isAppointment || $isAppointmentsShow || $isAppointmentCalendar) && !$isAssistantsAppointments;
    @endphp

    {{-- pour les rdv  --}}
    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('patients/appointments*', 'patients/assistants-appointment*', 'patients/patient-appointments-calendar*', 'patients/prescription-medicine-show*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ $isActive ? 'active' : '' }}"
            href="{{ route('patients.patient-appointments-index') }}">
            {{ __('messages.doctor_appointments') }}
        </a>
    </li>

    @php
        $isAssistantsAppointment = Request::is('patients/assistants-appointment*');
        $isAppointmentsAssistantShow = Request::is('patients/appointments-assistant/*');
        $isAssistantsAppointmentCalendar = Request::is('patients/patient-assistants-appointment-assistants-calendar*');
        $isAppointments = Request::is('patients/appointments/*');

        // Assurez-vous que $isAppointments est faux
        $isActive = ($isAssistantsAppointment || $isAppointmentsAssistantShow || $isAssistantsAppointmentCalendar) && !$isAppointments;
    @endphp

    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('patients/appointments*', 'patients/assistants-appointment*', 'patients/patient-assistants-appointment-assistants-calendar*', 'patients/prescription-medicine-show*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ $isActive ? 'active' : '' }}"
            href="{{ route('patients.patient-assistant-appointments-assistant-index') }}">
            {{ __('messages.appointments_assistant') }}
        </a>
    </li>



    {{-- lien travailleur social supprimer  --}}
    {{-- <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('patients/patient-visits*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('patients/patient-visits*') ? 'active' : '' }}"
            href="{{ route('patients.patient.visits.index') }}">{{ __('messages.visits') }}</a>
    </li> --}}

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('patients/patient-visits*' ,'patients/patient-assistances*') ? 'd-none' : '' }}">
        {{-- pour le li --}}
        <a class="nav-link p-0 {{ Request::is('patients/patient-visits*') ? 'active' : '' }}"
            href="{{ route('patients.patient.visits.index') }}">{{ __('messages.visits') }}</a>
    </li>

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('patients/patient-visits*' ,'patients/patient-assistances*') ? 'd-none' : '' }}">
        {{-- pour le li --}}
        <a class="nav-link p-0 {{ Request::is('patients/patient-assistances*') ? 'active' : '' }}"
        href="{{ route('patients.patient.assistances.index') }}">{{ __('messages.assistances') }}</a>
    </li>



    {{-- <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('patients/patient-assistances*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('patients/patient-assistances*') ? 'active' : '' }}"
            href="{{ route('patients.patient.assistances.index') }}">{{ __('messages.assistances') }}</a>
    </li> --}}


    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('patients/transactions*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('patients/transactions*') ? 'active' : '' }}"
            href="{{ route('patients.transactions') }}">{{ __('messages.transactions') }}</a>
    </li>
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('patients/connect-google-calendar*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('patients/connect-google-calendar*') ? 'active' : '' }}"
            href="{{ route('patients.googleCalendar.index') }}">{{ __('messages.setting.connect_google_calendar') }}</a>
    </li>
    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('patients/reviews*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('patients/reviews*') ? 'active' : '' }}"
            href="{{ route('patients.reviews.index') }}">{{ __('messages.reviews') }}</a>
    </li>
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('patients/live-consultations*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('patients/live-consultations*') ? 'active' : '' }}"
            href="{{ route('patients.live-consultations.index') }}">{{ __('messages.live_consultations') }}</a>
    </li>
@endrole

@if (isRole('patient'))
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is('patients/smart-patient-cards*', 'patients/generate-patient-smart-cards*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('patients/generate-patient-smart-cards*') ? 'active' : '' }}"
            href="{{ route('patients.generate-patient-smart-cards.index') }}">{{ __('messages.smart_patient_card.generate_patient_smart_cards') }}</a>
    </li>
@endif



{{-- DOCTEUR  --}}


@role('doctor')
    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('doctors/dashboard*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('doctors/dashboard*') ? 'active' : '' }}"
            href="{{ route('doctors.dashboard') }}">{{ __('messages.dashboard') }}</a>
    </li>
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('doctors/appointments*', 'doctors/prescription-medicine-show*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('doctors/appointments*', 'doctors/prescription-medicine-show*') ? 'active' : '' }}"
            href="{{ route('doctors.appointments') }}">{{ __('messages.appointments') }}</a>
    </li>
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('doctors/doctor-schedule-edit*', 'doctors/doctor-sessions/create*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('doctors/doctor-schedule-edit*', 'doctors/doctor-sessions/create*') ? 'active' : '' }}"
            href="{{ getLoginDoctorSessionUrl() }}">{{ __('messages.doctor_session.my_schedule') }}</a>
    </li>
    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('doctors/visits*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('doctors/visits*') ? 'active' : '' }}"
            href="{{ route('doctors.visits.index') }}">{{ __('messages.visits') }}</a>
    </li>
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('doctors/connect-google-calendar*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('doctors/connect-google-calendar*') ? 'active' : '' }}"
            href="{{ route('doctors.googleCalendar.index') }}">{{ __('messages.setting.connect_google_calendar') }}</a>
    </li>
    {{-- <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('doctors/live-consultations*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('doctors/live-consultation*') ? 'active' : '' }}"
            href="{{ route('doctors.zoom.credential', ['userZoomCredential' => $userZoomCredential]) }}">{{ __('messages.live_credentials') }}</a>
    </li> --}}

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('doctors/live-consultations*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('doctors/live-consultation*') ? 'active' : '' }}"
            href="{{ route('doctors.live-consultations.index') }}">{{ __('messages.live_consultations') }}</a>
    </li>
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('doctors/transactions*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('doctors/transactions*') ? 'active' : '' }}"
            href="{{ route('doctors.transactions') }}">{{ __('messages.transactions') }}</a>
    </li>
    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('doctors/holidays*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('doctors/holidays*') ? 'active' : '' }}"
            href="{{ route('doctors.holiday') }}">{{ __('messages.holiday.holiday') }}</a>
    </li>
@endrole

@if (isRole('doctor'))
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is('doctors/smart-patient-cards*', 'doctors/generate-patient-smart-cards*') ? 'd-none' : '' }}">
        <a class="nav-link p-0
    {{ Request::is('doctors/smart-patient-cards*') ? 'active' : '' }}"
            href="{{ route('doctors.smart-patient-cards.index') }}">{{ __('messages.smart_patient_card.smart_patient_card_templates') }}</a>
    </li>

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is('doctors/smart-patient-cards*', 'doctors/generate-patient-smart-cards*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('doctors/generate-patient-smart-cards*') ? 'active' : '' }}"
            href="{{ route('doctors.generate-patient-smart-cards.index') }}">{{ __('messages.smart_patient_card.generate_patient_smart_cards') }}</a>
    </li>
@endif

@can('manage_medicines')
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/categories*', 'admin/brands*', 'admin/medicines*', 'admin/medicine-purchase*', 'admin/used-medicine*', 'admin/medicine-bills*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/categories*') ? 'active' : '' }}"
            href="{{ route('categories.index') }}">
            {{ __('messages.medicine_categories') }}
        </a>
    </li>
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/categories*', 'admin/brands*', 'admin/medicines*', 'admin/medicine-purchase*', 'admin/used-medicine*', 'admin/medicine-bills*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/brands*') ? 'active' : '' }}" href="{{ route('brands.index') }}">
            {{ __('messages.medicine_brands') }}
        </a>
    </li>
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/categories*', 'admin/brands*', 'admin/medicines*', 'admin/medicine-purchase*', 'admin/used-medicine*', 'admin/medicine-bills*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/medicines*') ? 'active' : '' }}"
            href="{{ route('medicines.index') }}">
            {{ __('messages.medicines') }}
        </a>
    </li>
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/categories*', 'admin/brands*', 'admin/medicines*', 'admin/medicine-purchase*', 'admin/used-medicine*', 'admin/medicine-bills*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/medicine-purchase*') ? 'active' : '' }}"
            href="{{ route('medicine-purchase.index') }}">
            {{ __('messages.purchase_medicine.purchase_medicines') }}
        </a>
    </li>
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/categories*', 'admin/brands*', 'admin/medicines*', 'admin/medicine-purchase*', 'admin/used-medicine*', 'admin/medicine-bills*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/used-medicine*') ? 'active' : '' }}"
            href="{{ route('used-medicine.index') }}">
            {{ __('messages.used_medicine.used_medicines') }}
        </a>
    </li>
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/categories*', 'admin/brands*', 'admin/medicines*', 'admin/medicine-purchase*', 'admin/used-medicine*', 'admin/medicine-bills*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/medicine-bills*') ? 'active' : '' }}"
            href="{{ route('medicine-bills.index') }}">
            {{ __('messages.medicine_bills.medicine_bills') }}
        </a>
    </li>
@endcan


{{-- TRAVAILLEUR SOCIAL  --}}
@role('assistant')
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('assistants/dashboard*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('assistants/dashboard*') ? 'active' : '' }}"
            href="{{ route('assistants.dashboard') }}">{{ __('messages.dashboard') }}</a>
    </li>


    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is(
            'assistants/asstts-apptmt*',
            // 'assistants/prescription-medicine-show*'
            ) ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('assistants/asstts-apptmt*', 'assistants/prescription-medicine-show*') ? 'active' : '' }}"
            href="{{ route('assistants.asstts-apptmt') }}">{{ __('messages.appointments_assistant') }}</a>
    </li>

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('assistants/schedule-assistant-edit*', 'assistants/assistant-sessions/create*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('assistants/schedule-assistant-edit*', 'assistants/assistant-sessions/create*') ? 'active' : '' }}"
            href="{{ getLoginAssistantSessionUrl() }}">{{ __('messages.assistant_session.my_schedule') }}</a>
    </li>


    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
         {{ !Request::is('assistants/asstt-holidy*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('assistants/asstt-holidy*') ? 'active' : '' }}"
            href="{{ route('assistants.holiday-assistant') }}">{{ __('messages.holiday.holiday') }}</a>
    </li>



    {{-- <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('assistants/doctor-visits*' ,'assistants/assistances*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('assistants/doctor-visits*') ? 'active' : '' }}"
            href="{{ route('assistants.doctor-visits.index') }}">{{ __('messages.visits') }}</a>
    </li> --}}


    <li
    class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('assistants/doctor-visits*' ,'assistants/assistances*') ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('assistants/assistances*') ? 'active' : '' }}"
            href="{{ route('assistants.assistances.index') }}">{{ __('messages.portez_assistance.main') }}</a>
    </li>

    {{-- <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('doctors/visits*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('doctors/visits*') ? 'active' : '' }}"
            href="{{ route('doctors.visits.index') }}">{{ __('messages.visits') }}</a>
    </li> --}}

    {{-- <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('doctors/connect-google-calendar*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('doctors/connect-google-calendar*') ? 'active' : '' }}"
            href="{{ route('doctors.googleCalendar.index') }}">{{ __('messages.setting.connect_google_calendar') }}</a>
    </li> --}}

    {{-- <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('doctors/live-consultations*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('doctors/live-consultation*') ? 'active' : '' }}"
            href="{{ route('doctors.live-consultations.index') }}">{{ __('messages.live_consultations') }}</a>
    </li> --}}

    {{-- <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('doctors/transactions*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('doctors/transactions*') ? 'active' : '' }}"
            href="{{ route('doctors.transactions') }}">{{ __('messages.transactions') }}</a>
    </li> --}}

@endrole



{{-- DOCTEUR ET PATIENT  --}}


{{-- ADMINISTRATEUR  --}}

@can('manage_admin_dashboard')
    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/dashboard*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/dashboard*') ? 'active' : '' }}"
            href="{{ route('admin.dashboard') }}">{{ __('messages.dashboard') }}
        </a>
    </li>
@endcan

@can('manage_staff')
    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is('admin/staffs*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/staffs*') ? 'active' : '' }}"
            href="{{ route('staffs.index') }}">{{ __('messages.staffs') }}</a>
    </li>
@endcan

@can('manage_doctors')
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is('admin/doctors*', 'admin/doctor-sessions*', 'admin/holidays*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/doctors*') ? 'active' : '' }}"
            href="{{ route('doctors.index') }}">{{ __('messages.doctors') }}</a>
    </li>
@endcan

@can('manage_assistant')
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is('admin/assistants*', 'admin/assistant-sessions*', 'admin/asstt-holidy*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/assistants*') ? 'active' : '' }}"
            href="{{ route('assistants.index') }}">{{ __('messages.assistants') }}</a>
    </li>
@endcan

@can('manage_doctor_sessions')
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is('admin/doctors*', 'admin/doctor-sessions*', 'admin/holidays*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/doctor-sessions*') ? 'active' : '' }}"
            href="{{ route('doctor-sessions.index') }}">{{ getLogInUser()->hasRole('doctor') ? __('messages.doctor_session.my_schedule') : __('messages.doctor_sessions') }}</a>
    </li>
@endcan

@can('manage_assistant_sessions')
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is('admin/assistants*', 'admin/assistant-sessions*', 'admin/asstt-holidy*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/assistant-sessions*') ? 'active' : '' }}"
            href="{{ route('assistant-sessions.index') }}">{{ getLogInUser()->hasRole('assistant') ? __('messages.assistant_session.my_schedule') : __('messages.assistant_sessions') }}</a>
    </li>
@endcan

@can('manage_patients')
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is('admin/patients*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/patients*') ? 'active' : '' }}"
            href="{{ route('patients.index') }}">{{ __('messages.patients') }}</a>
    </li>
@endcan

@if (isRole('clinic_admin'))
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is('admin/smart-patient-cards*', 'admin/generate-patient-smart-cards*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/smart-patient-cards*') ? 'active' : '' }}"
            href="{{ route('smart-patient-cards.index') }}">{{ __('messages.smart_patient_card.smart_patient_card_templates') }}</a>
    </li>

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is('admin/smart-patient-cards*', 'admin/generate-patient-smart-cards*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/generate-patient-smart-cards*') ? 'active' : '' }}"
            href="{{ route('generate-patient-smart-cards.index') }}">{{ __('messages.smart_patient_card.generate_patient_smart_cards') }}</a>
    </li>
    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/visits*', 'admin/assistances*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/visits*') ? 'active' : '' }}"
            href="{{ route('visits.index') }}">{{ __('messages.visits') }}</a>
    </li>

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/visits*', 'admin/assistances*')? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/assistances*') ? 'active' : '' }}"
        href="{{ route('assistances.index') }}">{{ __('messages.assistances') }}</a>
    </li>
@endif

@can('manage_settings')
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is('admin/settings*', 'admin/roles*', 'admin/currencies*', 'admin/clinic-schedules*', 'admin/countries*', 'admin/states*', 'admin/cities*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/settings*') ? 'active' : '' }}"
            href="{{ route('setting.index') }}">{{ __('messages.settings') }}</a>
    </li>
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is('admin/settings*', 'admin/roles*', 'admin/currencies*', 'admin/clinic-schedules*', 'admin/countries*', 'admin/states*', 'admin/cities*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/clinic-schedules*') ? 'active' : '' }}"
            href="{{ route('clinic-schedules.index') }}">{{ __('messages.clinic_schedules') }}</a>
    </li>
@endcan

@can('manage_doctors_holiday')
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is('admin/doctors*', 'admin/doctor-sessions*', 'admin/holidays*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/holidays*') ? 'active' : '' }}"
            href="{{ route('holidays.index') }}">{{ __('messages.holiday.doctor_holiday') }}</a>
    </li>
@endcan

@can('manage_assistants_holiday')
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is('admin/assistants*', 'admin/assistant-sessions*', 'admin/asstt-holidy*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/asstt-holidy*') ? 'active' : '' }}"
            href="{{ route('asstt-holidy.index') }}">{{ __('messages.holiday.assistant_holiday') }}</a>
    </li>
@endcan


@can('manage_roles')
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is('admin/settings*', 'admin/roles*', 'admin/currencies*', 'admin/clinic-schedules*', 'admin/countries*', 'admin/states*', 'admin/cities*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/roles*') ? 'active' : '' }}"
            href="{{ route('roles.index') }}">{{ __('messages.roles') }}</a>
    </li>
@endcan

@can('manage_currencies')
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is('admin/settings*', 'admin/roles*', 'admin/currencies*', 'admin/clinic-schedules*', 'admin/countries*', 'admin/states*', 'admin/cities*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/currencies*') ? 'active' : '' }}"
            href="{{ route('currencies.index') }}">{{ __('messages.currencies') }}</a>
    </li>
@endcan

@can('manage_countries')
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is('admin/settings*', 'admin/roles*', 'admin/currencies*', 'admin/clinic-schedules*', 'admin/countries*', 'admin/states*', 'admin/cities*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/countries*') ? 'active' : '' }}"
            href="{{ route('countries.index') }}">{{ __('messages.countries') }}</a>
    </li>
@endcan

@can('manage_states')
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is('admin/settings*', 'admin/roles*', 'admin/currencies*', 'admin/clinic-schedules*', 'admin/countries*', 'admin/states*', 'admin/cities*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/states*') ? 'active' : '' }}"
            href="{{ route('states.index') }}">{{ __('messages.states') }}</a>
    </li>
@endcan

@can('manage_cities')
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is('admin/settings*', 'admin/roles*', 'admin/currencies*', 'admin/clinic-schedules*', 'admin/countries*', 'admin/states*', 'admin/cities*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/cities*') ? 'active' : '' }}"
            href="{{ route('cities.index') }}">{{ __('messages.cities') }}</a>
    </li>
@endcan

@can('manage_specialities')
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/specializations*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/specializations*') ? 'active' : '' }}"
            href="{{ route('specializations.index') }}">{{ __('messages.specializations') }}</a>
    </li>
@endcan

@can('manage_services')
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/services*', 'admin/service-categories*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/services*') ? 'active' : '' }}"
            href="{{ route('services.index') }}">{{ __('messages.services') }}</a>
    </li>
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/services*', 'admin/service-categories*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/service-categories*') ? 'active' : '' }}"
            href="{{ route('service-categories.index') }}">{{ __('messages.service_categories') }}</a>
    </li>
@endcan

@php
    // Vérifiez si l'URL correspond aux différentes vues d'administration pour les rendez-vous
    $isAdminAppointment = Request::is('admin/appointments*');
    $isAdminAppointmentsShow = Request::is('admin/appointments/*');
    $isAdminAppointmentCalendar = Request::is('admin/admin-appointments-calendar*');

    // Vérifiez si l'URL correspond aux différentes vues d'administration pour les rendez-vous des assistants
    $isAdminAssistantsAppointment = Request::is('admin/asstts-apptmt*');
    $isAdminAppointmentsAssistantShow = Request::is('admin/asstts-apptmt/*');
    $isAdminAssistantsAppointmentCalendar = Request::is('admin/admin-assistant-appointments-assistant-calendar*');
@endphp
@can('manage_appointments')
    <!-- Lien pour les rendez-vous admin -->
    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/appointments*', 'admin/asstts-apptmt*', 'admin/admin-appointments-calendar*', 'admin/prescriptions*', 'admin/prescription-medicine-show*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ ($isAdminAppointment || $isAdminAppointmentsShow || $isAdminAppointmentCalendar) && !$isAdminAssistantsAppointment ? 'active' : '' }}"
        href="{{ route('appointments.index') }}">{{ __('messages.appointments_admin') }}</a>
    </li>
@endcan
@can('manage_assistant_appointments')
    <!-- Lien pour les rendez-vous des assistants -->
    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/appointments', 'admin/asstts-apptmt*', 'admin/admin-assistant-appointments-assistant-calendar*', 'admin/prescriptions*', 'admin/prescription-medicine-show*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ ($isAdminAssistantsAppointment || $isAdminAppointmentsAssistantShow || $isAdminAssistantsAppointmentCalendar) && !$isAdminAppointment ? 'active' : '' }}"
        href="{{ route('asstts-apptmt.index') }}">
        {{ __('messages.appointments_assistant') }}
        </a>
    </li>
@endcan







    {{-- @can('manage_assistant_appointments')
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is(
                'admin/asstts-apptmt*',
                'admin/admin-assistant-appointments-assistant-calendar*',

            )
                ? 'd-none'
                : '' }}">
            <a class="nav-link p-0 {{ Request::is(
                'admin/asstts-apptmt*',
                'admin/admin-assistant-appointments-assistant-calendar*',

            )
                ? 'active'
                : '' }}"
                href="{{ route('asstts-apptmt.index') }}">{{ __('messages.appointments_assistant') }}</a>
        </li>
    @endcan --}}


<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('profile/edit*') ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('profile/edit*') ? 'active' : '' }}"
        href="{{ route('profile.setting') }}">{{ __('messages.user.profile_details') }}</a>
</li>

@can('manage_front_cms')
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/front-services*', 'admin/faqs*', 'admin/front-patient-testimonials*', 'admin/cms*', 'admin/banner*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/cms*') ? 'active' : '' }}"
            href="{{ route('cms.index') }}">{{ __('messages.cms.cms') }}</a>
    </li>
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/front-services*', 'admin/faqs*', 'admin/front-patient-testimonials*', 'admin/cms*', 'admin/banner*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/banner*') ? 'active' : '' }}"
            href="{{ route('banner.index') }}">{{ __('messages.sliders') }}</a>
    </li>
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/front-services*', 'admin/faqs*', 'admin/front-patient-testimonials*', 'admin/cms*', 'admin/banner*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/faqs*') ? 'active' : '' }}"
            href="{{ route('faqs.index') }}">{{ __('messages.faqs') }}</a>
    </li>
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/front-services*', 'admin/faqs*', 'admin/front-patient-testimonials*', 'admin/cms*', 'admin/banner*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/front-patient-testimonials*') ? 'active' : '' }}"
            href="{{ route('front-patient-testimonials.index') }}">{{ __('messages.front_patient_testimonials') }}</a>
    </li>
    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/enquiries*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/enquiries*') ? 'active' : '' }}"
            href="{{ route('enquiries.index') }}">{{ __('messages.enquiries') }}</a>
    </li>

    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/subscribers*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/subscribers*') ? 'active' : '' }}"
            href="{{ route('subscribers.index') }}">{{ __('messages.subscribers') }}</a>
    </li>
@endcan
@can('manage_transactions')
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/transactions*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/transactions*') ? 'active' : '' }}"
            href="{{ route('transactions') }}">{{ __('messages.transactions') }}</a>
    </li>
@endcan
