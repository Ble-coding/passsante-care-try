@extends('layouts.app')
@section('title')
    {{ __('messages.portez_assistance.main') }}
@endsection
@section('content')
    <div class="container-fluid"> 
        @include('flash::message')
        <div class="d-flex flex-column">
            <livewire:patient-assistance-table/>
        </div>
    </div>
@endsection
