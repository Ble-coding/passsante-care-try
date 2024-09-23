document.addEventListener('turbo:load', loadAssistantPanelApptmentFilteDate)

let assistantPanelApptmentFilterDate = $('#assistantAppointmentDateFilter')

function loadAssistantPanelApptmentFilteDate () {
    if (!assistantPanelApptmentFilterDate.length) {
        return
    }

    let assistantPanelApptmentStart = moment().startOf('week')
    let assistantPanelApptmentEnd = moment().endOf('week')

    function cb (start, end) {
        assistantPanelApptmentFilterDate.html(
            start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'))
    }

    assistantPanelApptmentFilterDate.daterangepicker({

        startDate: assistantPanelApptmentStart,
        endDate: assistantPanelApptmentEnd,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [
                moment().subtract(1, 'days'),
                moment().subtract(1, 'days')],
            'This Week': [moment().startOf('week'), moment().endOf('week')],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [
                moment().subtract(1, 'month').startOf('month'),
                moment().subtract(1, 'month').endOf('month')],
        },
    }, cb)
    cb(assistantPanelApptmentStart, assistantPanelApptmentEnd)
}

// listenClick('.assistant-panel-delete-btn', function (event) {
//     let assistantPanelApptmentRecordId = $(event.currentTarget).attr('data-id')
//     console.log('Appointment ID:', assistantPanelApptmentRecordId)
//     let url = route('patients.assistants-appointment.destroy', assistantPanelApptmentRecordId);
//     console.log('Generated URL:', url);
//     deleteItem(
//         route('patients.assistants-appointment.destroy', assistantPanelApptmentRecordId),
//         'Appointment')
// })

listenClick('.assistant-panel-delete-btn', function (event) {
    let assistantPanelApptmentRecordId = $(event.currentTarget).attr('data-id')
    deleteItem(
        route('patients.assistants-appointment.destroy', assistantPanelApptmentRecordId),
        'AppointmentAssistant'
    )
})

listenChange('.assistant-panel-status-change', function () {
    let appointmentStatus = $(this).val()
    let appointmentId = $(this).attr('data-id')
    let currentData = $(this)

    $.ajax({
        url: route('assistants.change-status', appointmentId),
        type: 'POST',
        data: {
            appointmentId: appointmentId,
            appointmentStatus: appointmentStatus,
        },
        success: function (result) {
            $(currentData).children('option.booked').addClass('hide')
            livewire.emit('refresh')
            displaySuccessMessage(result.message)
        },
    })
})

listenClick('#assistantPanelResetFilter', function () {
    $('#appointmentStatus').val(book).trigger('change')
    $('#assistantAppointmentDateFilter').
        val(moment().format('MM/DD/YYYY') + ' - ' +
            moment().format('MM/DD/YYYY')).
        trigger('change')
})
