<div>
    <div class="row">
        {{Form::hidden('assistant_id',$assistantId,['class'=>'adminAppointmentAssistantId'])}}
        <div class="mb-5 col-6">
            {{ Form::label('date',__('messages.appointment.date').':' ,['class' => 'form-label required']) }}
            {{ Form::text('date', null,['class' => 'form-control','placeholder' => __('messages.appointment.date') ,'id' =>'assistantHolidayDate']) }}
        </div>
        <div class="mb-5 col-6">
            {{ Form::label('name',__('messages.web.reason').':' ,['class' => 'form-label']) }}
            {{ Form::text('name', null,['class' => 'form-control','placeholder' => __('messages.web.reason')]) }}
        </div>
    </div>
    <div class="d-flex">
        <button type="submit" class="btn btn-primary" id="btnSubmit">{{ __('messages.common.save') }}</button>&nbsp;&nbsp;&nbsp;
        @role('assistant')
        <a href="{{  route('assistants.holiday-assistant') }}" type="reset"
           class="btn btn-secondary">{{ __('messages.common.discard') }}</a>
        @else
            <a href="{{  route('asstt-holidy.index') }}" type="reset"
               class="btn btn-secondary">{{ __('messages.common.discard') }}</a>
            @endrole
    </div>
</div>


