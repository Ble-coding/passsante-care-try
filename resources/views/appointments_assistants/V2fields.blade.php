<div class="row">

    <div class="col-sm-12 col-lg-6 mb-5">
        <div class="col-12 mb-5">
            {{ Form::label('date', __('messages.appointment.date') . ':', ['class' => 'form-label required']) }}
            {{ Form::date('date', null, ['class' => 'form-control', 'id' => 'appointmentDatetime', 'placeholder' => __('messages.appointment.date'), 'required']) }}
        </div>
    </div>
    <div class="col-sm-12 col-lg-6 mb-5">
        <div class="col-12 mb-5">
            {{ Form::label('heure', __('messages.appointment.time') . ':', ['class' => 'form-label required']) }}
            {{ Form::time('time', null, ['class' => 'form-control', 'id' => 'appointmentTime', 'placeholder' => __('messages.appointment.time'), 'required']) }}
        </div>
    </div>
    
    {{-- stocke un booléen indiquant si l'utilisateur connecté a le rôle de "doctor" --}}
    @role('doctor')
        {{ Form::hidden('doctorRole', getLogInUser()->hasRole('doctor'), ['id' => 'doctorRole']) }}
        {{ Form::hidden('doctor_id', getLogInUser()->doctor->id, ['id' => 'adminAppointmentDoctorId']) }}
        {{-- stocke l'identifiant du médecin associé à l'utilisateur connecté --}}
        {{ Form::hidden('status', \App\Models\Appointment::BOOKED) }}
    @else
        <div class="col-sm-12 col-lg-6 mb-5">
            {{ Form::label('Doctor', __('messages.doctor.doctor') . ':', ['class' => 'form-label required']) }}
            {{ Form::select('doctor_id', $data['doctors'], null, ['class' => 'io-select2 form-select', 'id' => 'adminAppointmentDoctorId', 'data-control' => 'select2', 'required', 'placeholder' => __('messages.doctor.doctor')]) }}
        </div>
    @endrole

    @php
        $styleCss = 'style';
    @endphp


    <div class="col-12 mb-5 ">
        {{ Form::label('Description', __('messages.appointment.description') . ':', ['class' => 'form-label']) }}
        {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => 10, 'placeholder' => __('messages.appointment.description')]) }}
    </div>
  




    <div class="col-lg-6 col-sm-12 mb-5">
        {{ Form::label('Payment Type', __('messages.appointment.payment_method') . ':', ['class' => 'form-label']) }}
        {{ Form::select('payment_type', getAllPaymentStatus(), null, ['class' => 'io-select2 form-select', 'data-control' => 'select2', 'placeholder' => __('messages.appointment.payment_method')]) }}
    </div>


    <div class="col-lg-6 col-sm-12 mb-5">
        {{ Form::label('Charge', __('messages.appointment.charge') . ':', ['class' => 'form-label']) }}
        <div class="input-group">
            {{ Form::text('charge', null, ['class' => 'form-control', 'placeholder' => 'Select Date', 'id' => 'chargeId', 'required', 'placeholder' => __('messages.appointment.charge'), 'readonly']) }}
            <div class="input-group-text">
                <a class="fw-bolder text-gray-500 text-decoration-none">{{ getCurrencyIcon() }}</a>
            </div>
        </div>
    </div>






    @if (!getLogInUser()->hasRole('patient'))
        <div class="col-lg-6 col-sm-12 mb-5">
            {{ Form::label('Add Fees', __('messages.appointment.extra_fees') . ':', ['class' => 'form-label']) }}
            <div class="input-group">
                {{ Form::text('add_fees', null, [
                    'class' => 'form-control',
                    'id' => 'addFees',
                    'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")',
                    'placeholder' => __('messages.appointment.extra_fees'),
                    'step' => 'any',
                ]) }}
                <div class="input-group-text">
                    <a class="fw-bolder text-gray-500 text-decoration-none">{{ getCurrencyIcon() }}</a>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-sm-12 mb-5">
            {{ Form::label('Total Payable Amount', __('messages.appointment.total_payable_amount') . ':', ['class' => 'form-label']) }}
            <div class="input-group">
                {{ Form::text('payable_amount', null, ['class' => 'form-control', 'placeholder' => 'Total Payable Amount', 'id' => 'payableAmount', 'placeholder' => __('messages.appointment.total_payable_amount'), 'readonly']) }}
                <div class="input-group-text">
                    <a class="fw-bolder text-gray-500 text-decoration-none">{{ getCurrencyIcon() }}</a>
                </div>
            </div>
        </div>
    @endif

    @if (getLogInUser()->hasRole('patient'))
        <div class="col-lg-6 col-sm-12 mb-5">
            {{ Form::label('Total Payable Amount', __('messages.appointment.total_payable_amount') . ':', ['class' => 'form-label']) }}
            <div class="input-group">
                {{ Form::text('payable_amount', null, ['class' => 'form-control', 'placeholder' => 'Total Payable Amount', 'id' => 'payableAmount', 'placeholder' => __('messages.appointment.total_payable_amount'), 'readonly']) }}
                <div class="input-group-text">
                    <a class="fw-bolder text-gray-500 text-decoration-none">{{ getCurrencyIcon() }}</a>
                </div>
            </div>
        </div>
    @endif


    <div class="d-flex">
        {{ Form::button(__('messages.common.save'), ['type' => 'submit', 'class' => 'btn btn-primary me-2 submitAppointmentBtn']) }}
        &nbsp;
        <a href="{{ url()->previous() }}" type="reset"
            class="btn btn-secondary">{{ __('messages.common.discard') }}</a>
    </div>
</div>
