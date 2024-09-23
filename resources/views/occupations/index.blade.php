@extends('layouts.app')
@section('title')
    {{__('messages.occupation')}}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
            <livewire:specialization-table/>
        </div>
    </div>
    @include('occupations.create-modal') 
    @include('occupations.edit-modal')
@endsection
