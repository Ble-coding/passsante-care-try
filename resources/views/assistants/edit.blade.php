@extends('layouts.app')
@section('title')
    {{__('messages.assistant.edit')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <h1>@yield('title')</h1>
            <a class="btn btn-outline-primary float-end"
               href="{{ route('assistants.index') }}">{{ __('messages.common.back') }}</a>
        </div>

        <div class="col-12"> 
            @include('layouts.errors')
        </div>
        <div class="card">
            {{Form::hidden('qualification',$qualifications,['id' => 'qualificationData'])}}
            <div class="card-body">
                {{ Form::open(['route' => ['assistants.update',$user->assistant->id], 'method' => 'Patch', 'files' => true,'id'=> 'editAssistantForm']) }}
                {{ Form::hidden('user_id', $assistant->id,['id' => 'editAssistantId']) }}
                {{ Form::hidden('is_edit', true,['id' => 'assistantIsEdit']) }}
                {{ Form::hidden('edit_country_id', isset($user->address->country_id) ? $user->address->country_id:null,['id' => 'assistantCountryId']) }}
                {{ Form::hidden('edit_state_id', isset($user->address->state_id) ? $user->address->state_id:null,['id' => 'assistantStateId']) }}
                {{ Form::hidden('edit_city_id', isset($user->address->city_id) ? $user->address->city_id:null,['id' => 'assistantCityId']) }}
                {{ Form::hidden('backgroundImg',asset('web/media/avatars/male.png'),['id' => 'doctorBackgroundImg']) }}
                @include('assistants.edit-fields')
                {{ Form::close() }}
                @include('assistants.templates.templates')
            </div>
        </div>
    </div>
@endsection
