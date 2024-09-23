@extends('layouts.app')
@section('title')
    {{ __('messages.assistant_sessions') }}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message') 
        {{ Form::hidden(
            'assistant_Session',
            getLogInUser()->hasRole('assistant') ? route('assistants.assistant-sessions.index') : route('assistant-sessions.index'),
            ['id' => 'assistantSessionUrl'],
        ) }}
        <div class="d-flex flex-column">
            <livewire:assistant-schedule-table />
        </div>
    </div>
@endsection
