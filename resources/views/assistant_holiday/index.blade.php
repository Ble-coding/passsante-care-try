@extends('layouts.app')
@section('title')
    {{__('messages.holiday.assistant_holiday')}}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
            <livewire:assistant-holiday-table/>
        </div>
    </div>
@endsection
