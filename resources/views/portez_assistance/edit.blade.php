@extends('layouts.app')
@section('title')
    {{__('messages.visit.edit_visit')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <h1>@yield('title')</h1>
            @role('assistant')
            <a href="{{ route('assistants.assistances.index') }}"
               class="btn btn-outline-primary float-end">{{ __('messages.common.back') }}</a>
            @else
                <a href="{{ route('visits.index') }}"
                   class="btn btn-outline-primary float-end">{{ __('messages.common.back') }}</a>
                @endrole
        </div>

        <div class="col-12">
            @include('layouts.errors')
        </div>
        <div class="card">
            <div class="card-body">
                @if(getLogInUser()->hasRole('assistant'))
                    {{ Form::model($assistance,['route' => ['assistants.assistances.update', $assistance->id], 'method' => 'patch','id' => 'saveForm']) }}
                @else
                    {{ Form::model($assistance,['route' => ['assistances.update', $assistance->id], 'method' => 'patch','id' => 'saveForm']) }}
                @endif
                    @include('portez_assistance.fields')
                    {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
