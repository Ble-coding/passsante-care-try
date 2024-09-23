@extends('layouts.app')
@section('title')
    {{__('messages.services')}}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
            <livewire:service-assistant-table/>
            {{ Form::hidden('is_edit', \App\Models\ServiceAssistant::ALL,['id' => 'allServices']) }}
        </div>
    </div>
@endsection
