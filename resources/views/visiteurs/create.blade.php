@extends('layouts.app')
@section('title')
    {{__('messages.visitor.add_visitor')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <h1>{{ __('messages.visitor.add_visitor') }}</h1>
            <a class="btn btn-outline-primary float-end"
               href="{{ route('assistants.visiteurs.index') }}">{{ __('messages.common.back') }}</a>
        </div> 

        <div class="col-12">
            @include('layouts.errors')
        </div>
        <div class="card">
            <div class="card-body">
                {{ Form::open(['route' => ['assistants.visiteurs.store'], 'method' => 'POST','id'=> 'createVisitorfForm']) }}
                @include('visiteurs.fields')
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
