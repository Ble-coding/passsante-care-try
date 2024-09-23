@extends('layouts.app')
@section('title')
    {{__('messages.appointment.appointments')}}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
            {{Form::hidden('patientRole',getLogInUser()->hasRole('patient'),['id' => 'patientRole'])}}
            <livewire:appointment-assistant-table/>
            @include('appointments_assistants.models.patient-payment-model')
            @include('appointments_assistants.models.change-payment-status-model')
        </div>
    </div>
@endsection
