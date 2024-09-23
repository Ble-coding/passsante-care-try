@extends('layouts.app')
@section('title')
    {{__('messages.holiday.holiday')}}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column justify-content-center"> 
            <livewire:holiday-assistant-table/>
        </div>
    </div>
@endsection
