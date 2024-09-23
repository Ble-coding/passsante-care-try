@extends('layouts.app')
@section('title')
    {{__('messages.appointment.appointments')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{Form::hidden('patient_appointment',getLogInUser()->hasRole('patient'),['id' => 'userRole'])}}
            <livewire:patient-appointment-assistant-table/>
        </div>
    </div>
    @include('appointments_assistants.models.patient-payment-model')
@endsection
