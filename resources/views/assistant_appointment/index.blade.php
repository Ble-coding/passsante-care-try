@extends('layouts.app')
@section('title')
    {{ __('messages.appointments') }}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
            <livewire:assistant-panel-appointment-table/>
        </div>
    </div>
    @include('assistant_appointment.models.assistant-payment-status-model')
@endsection
