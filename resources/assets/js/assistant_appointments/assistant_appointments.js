document.addEventListener('turbo:load', loadAssistantAppointmentFilterDate)

let assistantAppointmentFilterDate = '#assistantPanelAppointmentDate';

function loadAssistantAppointmentFilterDate () {
    if (!$(assistantAppointmentFilterDate).length) {
        return
    }
    let timeRange = $('#assistantPanelAppointmentDate');
    let assistantAppointmentStart = moment().startOf('week')
    let assistantAppointmentEnd = moment().endOf('week')

    function cb(assistantAppointmentStart, assistantAppointmentEnd) {
        $('#assistantPanelAppointmentDate').val(
            assistantAppointmentStart.format('MM/DD/YYYY') + ' - ' + assistantAppointmentEnd.format('MM/DD/YYYY'))
    }

    timeRange.daterangepicker({
        startDate: assistantAppointmentStart,
        endDate: assistantAppointmentEnd,
        opens: 'left',
        showDropdowns: true,
        locale: {
            customRangeLabel: Lang.get('js.custom'),
            applyLabel:Lang.get('js.apply'),
            cancelLabel: Lang.get('js.cancel'),
            fromLabel:Lang.get('js.from'),
            toLabel: Lang.get('js.to'),
            monthNames: [
                Lang.get('js.jan'),
                Lang.get('js.feb'),
                Lang.get('js.mar'),
                Lang.get('js.apr'),
                Lang.get('js.may'),
                Lang.get('js.jun'),
                Lang.get('js.jul'),
                Lang.get('js.aug'),
                Lang.get('js.sep'),
                Lang.get('js.oct'),
                Lang.get('js.nov'),
                Lang.get('js.dec')
            ],

            daysOfWeek: [
                Lang.get('js.sun'),
                Lang.get('js.mon'),
                Lang.get('js.tue'),
                Lang.get('js.wed'),
                Lang.get('js.thu'),
                Lang.get('js.fri'),
                Lang.get('js.sat')],
        },
        ranges: {
            [Lang.get('js.today')]: [moment(), moment()],
            [Lang.get('js.yesterday')]: [
                moment().subtract(1, 'days'),
                moment().subtract(1, 'days')],
            [Lang.get('js.this_week')]: [moment().startOf('week'), moment().endOf('week')],
            [Lang.get('js.last_30_days')]: [moment().subtract(29, 'days'), moment()],
            [Lang.get('js.this_month')]: [moment().startOf('month'), moment().endOf('month')],
            [Lang.get('js.last_month')]: [
                moment().subtract(1, 'month').startOf('month'),
                moment().subtract(1, 'month').endOf('month')],
        },
    }, cb);

    cb(assistantAppointmentStart, assistantAppointmentEnd)

    timeRange.on("apply.daterangepicker", function (ev, picker) {
        window.livewire.emit('changeDateFilter', $(this).val())
    });
}

listenChange('.assistant-appointment-status-change', function () {
    let assistantAppointmentStatus = $(this).val()
    let assistantAppointmentId = $(this).attr('data-id')
    let assistantAppointmentCurrentData = $(this)

    $.ajax({
        url: route('assistants.change-status', assistantAppointmentId),
        type: 'POST',
        data: {
            appointmentId: assistantAppointmentId,
            appointmentStatus: assistantAppointmentStatus,
        },
        success: function (result) {
            $(assistantAppointmentCurrentData).
                children('option.booked').
                addClass('hide')
            livewire.emit('refresh')
            displaySuccessMessage(result.message)
        },
    })
})

listenChange('.assistant-apptment-change-payment-status', function () {
    let assistantApptmentPaymentStatus = $(this).val()
    let assistantApptmentAppointmentId = $(this).attr('data-id')

    $('#assistantAppointmentPaymentStatusModal').modal('show').appendTo('body')

    $('#assistantAppointmentPaymentStatus').val(assistantApptmentPaymentStatus)
    $('#assistantAppointmentId').val(assistantApptmentAppointmentId)
})

listenSubmit('#assistantAppointmentPaymentStatusForm', function (event) {
    event.preventDefault()
    let paymentStatus = $('#assistantAppointmentPaymentStatus').val()
    let appointmentId = $('#assistantAppointmentId').val()
    let paymentMethod = $('#assistantPaymentType').val()

    $.ajax({
        url: route('assistants.change-payment-status', appointmentId),
        type: 'POST',
        data: {
            appointmentId: appointmentId,
            paymentStatus: paymentStatus,
            paymentMethod: paymentMethod,
            loginUserId: currentLoginUserId,
        },
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#assistantAppointmentPaymentStatusModal').modal('hide')
                location.reload()
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})


listenChange('#assistantPanelPaymentType', function () {
    window.livewire.emit('changeDateFilter',
        $('#assistantPanelAppointmentDate').val())
    window.livewire.emit('changePaymentTypeFilter', $(this).val())
})

listenChange('#assistantPanelAppointmentStatus', function () {
    window.livewire.emit('changeDateFilter', $('#assistantPanelAppointmentDate').val())
    window.livewire.emit('changeStatusFilter', $(this).val())
})

listenClick('#assistantPanelApptmentResetFilter', function () {
    $('#assistantPanelPaymentType').val(0).trigger('change')
    $('#assistantPanelAppointmentStatus').val(1).trigger('change')
    assistantAppointmentFilterDate.data('daterangepicker').
        setStartDate(moment().startOf('week').format('MM/DD/YYYY'))
        assistantAppointmentFilterDate.data('daterangepicker').
        setEndDate(moment().endOf('week').format('MM/DD/YYYY'))
    hideDropdownManually($('#assistantPanelApptFilterBtn'), $('.dropdown-menu'));
})

listenClick('#assistantPanelApptResetFilter', function () {
    $('#assistantPanelPaymentType').val(0).trigger('change')
    $('#assistantPanelAppointmentStatus').val(1).trigger('change')
    $('#assistantPanelAppointmentDate').data('daterangepicker').
        setStartDate(moment().startOf('week').format('MM/DD/YYYY'))
    $('#assistantPanelAppointmentDate').data('daterangepicker').
        setEndDate(moment().endOf('week').format('MM/DD/YYYY'))
    hideDropdownManually($('#assistantPanelApptFilterBtn'), $('.dropdown-menu'));
})

document.addEventListener('livewire:load', function () {
    window.livewire.hook('message.processed', () => {
        if ($('#assistantPanelPaymentType').length) {
            $('#assistantPanelPaymentType').select2()
        }
        if ($('#assistantPanelAppointmentStatus').length) {
            $('#assistantPanelAppointmentStatus').select2()
        }
        if ($('.appointment-status').length) {
            $('.appointment-status').select2()
        }
        if ($('.payment-status').length) {
            $('.payment-status').select2()
        }
    })
})
