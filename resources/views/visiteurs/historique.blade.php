@extends('layouts.app')
@section('title')
    {{ __('messages.visitor.historique') }}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')

        <div class="d-flex flex-column">
            @if(getLogInUser()->hasRole('assistant'))
                <livewire:historique-table/>

            @endif
        </div>

    </div>
@endsection







 {{-- <livewire:visiteurhistorique-table/> --}}
            {{-- TotalvisiteTable
            VisiteurHistoriqueTable --}}