@extends('layouts.app')
@section('title')
    {{__('messages.holiday.add_holiday')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <h1>@yield('title')</h1>
            @role('assistant')
            <a href="{{ route('assistants.holiday-assistant') }}"
               class="btn btn-outline-primary float-end">{{ __('messages.common.back') }}</a>
            @else
                <a href="{{ route('holidays.index') }}"
                   class="btn btn-outline-primary float-end">{{ __('messages.common.back') }}</a>
                @endrole
        </div>
        <div class="col-12">
            @include('layouts.errors')
            @include('flash::message')
        </div>
        <div class="card">
            <div class="card-body">
                    {{ Form::open(['route' => 'assistants.holiday-assistant-store','id' => 'saveForm']) }}
                <div class="card-body p-0">
                    @include('holiday_assistant.fields')
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
