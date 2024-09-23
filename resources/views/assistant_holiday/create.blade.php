@extends('layouts.app')
@section('title')
    {{__('messages.holiday.add_holiday')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <h1>@yield('title')</h1>
                <a href="{{ route('asstt-holidy.index') }}"
                   class="btn btn-outline-primary float-end">{{ __('messages.common.back') }}</a>
        </div>
        <div class="col-12">
            @include('layouts.errors')
            @include('flash::message')
        </div>
        <div class="card">
            <div class="card-body">
                    {{ Form::open(['route' => 'asstt-holidy.store','id' => 'saveForm']) }}
                <div class="card-body p-0">
                    @include('assistant_holiday.fields')
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
