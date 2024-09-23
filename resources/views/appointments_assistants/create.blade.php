@extends('layouts.app')
@section('title')
    {{__('messages.appointment.add_new_appointment')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <h1>@yield('title')</h1>
            @role('patient')
            <a href="{{ route('patients.patient-assistant-appointments-assistant-index') }}"
               class="btn btn-outline-primary float-end">{{ __('messages.common.back') }}</a>
            @else
                <a href="{{ route('asstts-apptmt.index') }}"
                   class="btn btn-outline-primary float-end">{{ __('messages.common.back') }}</a>
                @endrole
        </div>

        <div class="col-12">
            @include('layouts.errors')
        </div>
        <div class="card">
            <div class="card-body">
                {{ Form::hidden(null, false,['id' => 'appointmentIsEdit']) }}
                {{ Form::hidden(null, \App\Models\AppointmentAssistant::PAYSTACK,['id' => 'paystackMethod']) }}
                {{ Form::hidden(null, \App\Models\AppointmentAssistant::PAYTM,['id' => 'paytmMethod']) }}
                {{ Form::hidden(null, \App\Models\AppointmentAssistant::AUTHORIZE,['id' => 'authorizeMethod']) }}
                {{ Form::hidden(null, \App\Models\AppointmentAssistant::PAYPAL,['id' => 'paypalMethod']) }}
                {{ Form::hidden(null, \App\Models\AppointmentAssistant::MANUALLY,['id' => 'manuallyMethod']) }}
                {{ Form::hidden(null, \App\Models\AppointmentAssistant::STRIPE,['id' => 'stripeMethod']) }}
                {{ Form::hidden(null, \App\Models\AppointmentAssistant::RAZORPAY,['id' => 'razorpayMethodMethod']) }}

                @if(getLogInUser()->hasRole('patient') || getLogInUser()->hasRole('assistant'))
                    @if (getLogInUser()->hasRole('patient'))
                        {{ Form::open(['route' => 'patients.assistants-appointment.store','id' => 'addAppointmentAssistantForm']) }}
                    @else((getLogInUser()->hasRole('assistant')))
                        {{ Form::open(['route' => 'assistants.asstts-apptmt.store','id' => 'addAppointmentAssistantForm']) }}
                    @endif
                @else(getLogInUser()->hasRole('admin'))
                    {{ Form::open(['route' => 'asstts-apptmt.store', 'id' => 'addAppointmentAssistantForm']) }}
                @endif

                @include('appointments_assistants.fields')
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection

