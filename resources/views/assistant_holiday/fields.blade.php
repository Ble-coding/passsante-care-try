<div>
    <div class="row">
        <div class="col-sm-12 col-lg-6 mb-5">
            {{ Form::label('Assistant',__('messages.assistant.assistant').':' ,['class' => 'form-label required']) }}
            {{ Form::select('assistant_id', $assistant, null,['class' => 'io-select2 form-select', 'id' => 'adminAppointmentAssistantId', 'data-control'=>"select2", 'required','placeholder' => __('messages.assistant.assistant')]) }}
        </div>
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
        <a href="{{  route('asstt-holidy.index') }}"
           type="reset"
           class="btn btn-secondary">{{ __('messages.common.discard') }}</a>
    </div>
</div>


