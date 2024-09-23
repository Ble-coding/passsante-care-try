import "flatpickr/dist/l10n";
document.addEventListener('turbo:load', loadAppointmentAssistantCreateEditData)

let appointmentAssistantDate = $('#appointmentAssistantDate')
let selectedDate
let selectedSlotTime

let timezoneOffsetMinutes = new Date().getTimezoneOffset()
timezoneOffsetMinutes = timezoneOffsetMinutes === 0
    ? 0
    : -timezoneOffsetMinutes



function loadAppointmentAssistantCreateEditData() {
    if (!$('#appointmentAssistantDate').length) {
        return
    }

    let lang = $('.currentLanguage').val()
    $('#appointmentAssistantDate').flatpickr({
        "locale": lang,
        minDate: new Date(),
        disableMobile: true,
    });
    $('.no-time-slot').removeClass('d-none');
}


// Rendez vous pour assistant et visiteur
listenChange('#appointmentAssistantDate', function () {

    selectedDate = $(this).val();
    let userRole = $('#userRole').val();
    let assistantRole = $('#assistantRole').val();
    let appointmentIsEdit = $('#appointmentIsEdit').val();
    $('.appointment-slot-data').html('');
    let url = '';

    if (!isEmpty(userRole) || !isEmpty(assistantRole)) {

        if (!isEmpty(userRole)) {
            url = route('patients.assistant-session-time');
        }
        if (!isEmpty(assistantRole)) {
            url = route('assistants.assistant-session-time');
        }
    } else {
        url = route('assistant-session-time');
    }
    // let url = !isEmpty(userRole)
    //     ? route('patients.assistant-session-time')
    //     : route('assistant-session-time');
    $.ajax({
        url: url,
        type: 'GET',
        data: {
            'adminAppointmentAssistantId': $('#adminAppointmentAssistantId').val(),
            'date': selectedDate,
            'timezone_offset_minutes': timezoneOffsetMinutes,
        },
        success: function (result) {
            if (result.success) {
                if (result.data['bookedSlot'] != null && result.data['bookedSlot'].length > 0) {
                    if (result.data['slots'].length == 0) {
                        $('.no-time-slot').addClass('d-none');
                        $('.assistant-time-over').removeClass('d-none');
                    }
                }
                $.each(result.data['slots'], function (index, value) {
                    if (appointmentIsEdit && fromTime == value) {
                        $('.no-time-slot').addClass('d-none');
                        $('.assistant-time-over').addClass('d-none');
                        $('.appointment-slot-data').append(
                            '<span class="time-slot col-lg-2  activeSlot" data-id="' +
                            value + '">' + value + '</span>');
                    } else {
                        $('.no-time-slot').addClass('d-none');
                        $('.assistant-time-over').addClass('d-none');
                        if (result.data['bookedSlot'] == null) {
                            $('.appointment-slot-data').append(
                                '<span class="time-slot col-lg-2" data-id="' +
                                value + '">' + value + '</span>');
                        } else {
                            if ($.inArray(value,
                                result.data['bookedSlot']) !== -1) {
                                $('.appointment-slot-data').
                                    append(
                                        '<span class="time-slot col-lg-2 bookedSlot " data-id="' +
                                        value + '">' + value + '</span>');
                            } else {
                                $('.appointment-slot-data').
                                    append(
                                        '<span class="time-slot col-lg-2" data-id="' +
                                        value + '">' + value + '</span>');
                            }

                        }
                    }
                });
            }
        },
        error: function (result) {
            $('.no-time-slot').removeClass('d-none');
            $('.assistant-time-over').addClass('d-none');
            displayErrorMessage(result.responseJSON.message);
        },
    });
});



listenClick('.time-slot', function () {
    if ($('.time-slot').hasClass('activeSlot')) {
        $('.time-slot').removeClass('activeSlot');
        selectedSlotTime = $(this).addClass('activeSlot');
    } else {
        selectedSlotTime = $(this).addClass('activeSlot');
    }
    let fromToTime = $(this).attr('data-id').split('-');
    let fromTime = fromToTime[0];
    let toTime = fromToTime[1];
    $('#timeSlot').val('');
    $('#toTime').val('');
    $('#timeSlot').val(fromTime);
    $('#toTime').val(toTime);
});

let charge;
let addFees = parseInt($('#addFees').val());
let totalFees;


listenChange('#adminAppointmentAssistantId', function () {
    $('#chargeId').val('');
    $('#payableAmount').val('');
    appointmentAssistantDate.val('');
    $('#addFees').val('');
    $('.appointment-slot-data').html('');
    $('.no-time-slot').removeClass('d-none');
    let url = !isEmpty(userRole) ? route('patients.get-service') : route(
        'get-service');

    $.ajax({
        url: url,
        type: 'GET',
        data: {
            'appointmentAssistantId': $(this).val(),
        },
        success: function (result) {
            if (result.success) {
                $('#appointmentAssistantDate').removeAttr('disabled');
                $('#appointmentAssistantServiceId').empty();
                $('#appointmentAssistantServiceId').append($('<option value=""></option>').text(Lang.get('js.select_service')));
                $.each(result.data, function (i, v) {
                    $('#appointmentAssistantServiceId').append($('<option></option>').attr('value', v.id).text(v.name));
                });
            }
        },
    });
});










listenChange('#appointmentAssistantServiceId', function () {
    let url = !isEmpty(userRole) ? route('patients.get-charge') : route(
        'get-charge');

    $.ajax({
        url: url,
        type: 'GET',
        data: {
            'chargeId': $(this).val(),
        },
        success: function (result) {
            if (result.success) {
                $('#chargeId').val('');
                $('#addFees').val('');
                $('#payableAmount').val('');
                if (result.data) {
                    $('#chargeId').val(result.data.charges);
                    $('#payableAmount').val(result.data.charges);
                    charge = result.data.charges;
                }
            }
        },
    });
});









listenKeyup('#addFees', function (e) {
    if (e.which != 8 && isNaN(String.fromCharCode(e.which))) {
        e.preventDefault();
    }
    totalFees = '';
    totalFees = parseFloat(charge) +
        parseFloat($(this).val() ? $(this).val() : 0);
    $('#payableAmount').val(totalFees.toFixed(2));
});




listenSubmit('#addAppointmentAssistantForm', function (e) {

    e.preventDefault();

    let data = new FormData($(this)[0]);
    $('.submitAppointmentAssistantBtn').prop(Lang.get('js.discard'), true);
    $('.submitAppointmentAssistantBtn').text(Lang.get('js.please_wait'));
    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: data,
        processData: false,
        contentType: false,
        success: function (mainResult) {
            if (mainResult.success) {

                let appID = mainResult.data.appointmentId;
                // return false

                displaySuccessMessage(mainResult.message);

                $('#addAppointmentAssistantForm')[0].reset();
                $('#addAppointmentAssistantForm').val('').trigger('change');

                if (mainResult.data.payment_type == $('#paystackMethod').val()) {

                    return location.href = mainResult.data.redirect_url;
                }

                if (mainResult.data.payment_type == $('#paytmMethod').val()) {

                    window.location.replace(route('paytm.init', { 'appointmentId': appID }));
                }

                if (mainResult.data.payment_type == $('#authorizeMethod').val()) {

                    Turbo.visit(route('authorize.init', { 'appointmentId': appID }));
                }

                if (mainResult.data.payment_type == $('#paypalMethod').val()) {
                    $.ajax({
                        type: 'GET',
                        url: route('paypal.init'),
                        data: { 'appointmentId': appID },
                        success: function (result) {
                            if (result.status == 200) {
                                // let redirectTo = '';
                                location.href = result.link
                                // $.each(result.result.links,
                                //     function (key, val) {
                                //         if (val.rel == 'approve') {
                                //             redirectTo = val.href;
                                //         }
                                //     });
                                // location.href = redirectTo;
                            }
                        },
                        error: function (result) {
                        },
                    });
                }

                if (mainResult.data.payment_type == $('#manuallyMethod').val()) {
                    window.location.replace(route('manually-assistant-payment', { 'appointmentId': appID }));
                }

                if (mainResult.data.payment_type == $('#stripeMethod').val()) {
                    let sessionId = mainResult.data[0].sessionId;
                    stripe.redirectToCheckout({
                        sessionId: sessionId,
                    }).then(function (mainResult) {
                        manageAjaxErrors(mainResult);
                    });
                }

                if (mainResult.data.payment_type == $('#razorpayMethodMethod').val()) {
                    $.ajax({
                        type: 'POST',
                        url: route('razorpay.init'),
                        data: { 'appointmentId': appID },
                        success: function (result) {
                            if (result.success) {
                                let { id, amount, name, email, contact } = result.data
                                options.amount = amount
                                options.order_id = id
                                options.prefill.name = name
                                options.prefill.email = email
                                options.prefill.contact = contact
                                options.prefill.appointmentID = appID

                                let razorPay = new Razorpay(options)
                                razorPay.open()
                                razorPay.on('payment.failed', storeFailedPayment)
                            }
                        },
                        error: function (result) {
                        },
                        complete: function () {
                        },
                    })
                }
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
            $('.submitAppointmentAssistantBtn').prop(Lang.get('js.discard'), false);
            $('.submitAppointmentAssistantBtn').text(Lang.get('js.save'));
        },
        complete: function () {

        },
    });
});






function storeFailedPayment(response) {
    $.ajax({
        type: 'POST',
        url: route('razorpay.failed'),
        data: {
            data: response,
        },
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
            }
        },
        error: function () {
        },
    });
}
