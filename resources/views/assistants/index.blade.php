@extends('layouts.app')
@section('title')
    {{__('messages.assistants')}}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
            <livewire:assistant-table/>
        </div>
        @include('assistants.qualification-modal')
    </div>
@endsection
 