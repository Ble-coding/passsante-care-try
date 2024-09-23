@extends('layouts.app')
@section('title')
    {{__('messages.visitor.assist_visiter')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <h1>@yield('title')</h1>
            <a class="btn btn-outline-primary float-end"
               href="{{ route('assistants.visiteurs.index') }}">{{ __('messages.common.back') }}</a>
        </div>
 
        <div class="col-12">
            @include('layouts.errors') 
        </div>  
        <div class="card">
            <div class="card-body">
                {{ Form::open(['route' => ['assistants.assistance-visiteurs.store'], 'method' => 'POST','id'=> 'createVisiteForm']) }}
                @include('visiteurs.create_visite_fields')
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
