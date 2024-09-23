@extends('layouts.app')
@section('title')
    {{__('messages.visit.add_assistance')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <h1>@yield('title')</h1>
            @role('assistant')
                <a href="{{ route('assistants.assistances.index') }}"
                   class="btn btn-outline-primary float-end">{{ __('messages.common.back') }}</a>
            @else
                <a href="{{ route('assistances.index') }}"
                   class="btn btn-outline-primary float-end">{{ __('messages.common.back') }}</a>
            @endrole
        </div>
 
        <div class="col-12">
            @include('layouts.errors')
        </div>
        <div class="card">
            <div class="card-body">
                @if(getLogInUser()->hasRole('assistant'))
                    {{ Form::open(['route' => 'assistants.assistances.store','id' => 'saveForm']) }}
                @else
                    {{ Form::open(['route' => 'assistances.store','id' => 'saveForm']) }}
                @endif
                <div class="card-body p-0">
                    @include('portez_assistance.fields')
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
