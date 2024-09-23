document.addEventListener('turbo:load', loadAssistantShowApptmentFilterDate)

let assistantShowApptmentFilterDate = $('#assistantShowAppointmentDateFilter')

function loadAssistantShowApptmentFilterDate () {
    if (!$('#assistantShowAppointmentDateFilter').length) {
        return
    }

    let assistantShowApptmentStart = moment().startOf('week')
    let assistantShowApptmentEnd = moment().endOf('week')

    function cb (start, end) {
        $('#assistantShowAppointmentDateFilter').html(
            start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'))
    }

    $('#assistantShowAppointmentDateFilter').daterangepicker({
        startDate: assistantShowApptmentStart,
        endDate: assistantShowApptmentEnd,
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
    }, cb)

    cb(assistantShowApptmentStart, assistantShowApptmentEnd)
}

listenClick('.assistant-show-apptment-delete-btn', function (event) {
    let assistantShowApptmentRecordId = $(event.currentTarget).attr('data-id')
    let assistantShowApptmentUrl = !isEmpty($('#patientRoleAssistantDetail').val()) ? route(
        'patients.appointments.destroy',
        assistantShowApptmentRecordId) : route('appointments.destroy',
        assistantShowApptmentRecordId)
    deleteItem(assistantShowApptmentUrl, 'Appointment')
})

listenChange('.assistant-show-apptment-status', function () {
    let assistantShowAppointmentStatus = $(this).val()
    let assistantShowAppointmentId = $(this).attr('data-id')
    let currentData = $(this)

    $.ajax({
        url: route('change-status', assistantShowAppointmentId),
        type: 'POST',
        data: {
            appointmentId: assistantShowAppointmentId,
            appointmentStatus: assistantShowAppointmentStatus,
        },
        success: function (result) {
            $(currentData).children('option.booked').addClass('hide')
            livewire.emit('refresh')
            displaySuccessMessage(result.message)
        },
    });
});

listenChange('#assistantShowAppointmentDateFilter', function () {
    window.livewire.emit('changeDateFilter', $(this).val())
})

listenChange('#assistantShowAppointmentStatus', function () {
    window.livewire.emit('changeDateFilter', $('#assistantShowAppointmentDateFilter').val())
    window.livewire.emit('changeStatusFilter', $(this).val())
})

listenClick('#assistantShowApptmentResetFilter', function () {
    $('#assistantShowAppointmentStatus').val(1).trigger('change')
    $('#assistantShowAppointmentDateFilter').
        val(moment().startOf('week').format('MM/DD/YYYY') + ' - ' +
            moment().endOf('week').format('MM/DD/YYYY')).
        trigger('change')
    livewire.emit('refresh')
})

document.addEventListener('livewire:load', function () {
    window.livewire.hook('message.processed', () => {
        if ($('#assistantShowAppointmentStatus').length) {
            $('#assistantShowAppointmentStatus').select2()
        }
        if ($('.assistant-show-apptment-status').length) {
            $('.assistant-show-apptment-status').select2()
        }
    })
})
