@extends('layouts.app')
@section('title')
    {{ __('messages.visits') }}
@endsection
@section('content')
    <div class="container-fluid"> 
        @include('flash::message')
        <div class="d-flex flex-column">
            @if(getLogInUser()->hasRole('assistant'))
                <livewire:assistant-portez-assistance-table/>
            @else
                <livewire:portez-assistance-table/> 
            @endif  
        </div>
    </div>
@endsection



