listenClick('#assistantResetFilter', function () {
  let  firstDate = moment(moment().startOf('week'), "MM/DD/YYYY").day(0).format("MM/DD/YYYY");
  let  lastDate =  moment(moment().endOf('week'), "MM/DD/YYYY").day(6).format("MM/DD/YYYY");

    $('#assistantPanelAppointmentDate').val(firstDate + " - " + lastDate).trigger('change')
    $('#assistantPanelPaymentType').val(0).trigger('change')
    $('#assistantPanelAppointmentStatus').val(3).trigger('change')
    $('#assistantStatus').val(2).trigger('change')
    hideDropdownManually($('#assistantFilterBtn'), $('.dropdown-menu'));
})

listenChange('#assistantStatus', function () {
    $('#assistantStatus').val($(this).val())
    window.livewire.emit('changeStatusFilter', $(this).val())
})

document.addEventListener('livewire:load', function () {
    window.livewire.hook('message.processed', () => {
        if ($('#assistantStatus').length) {
            $('#assistantStatus').select2()
        }
    })
})

listenClick('.assistant-delete-btn', function () {
    let userId = $(this).attr('data-id')
    let deleteUserUrl = route('assistants.destroy', userId)
    deleteItem(deleteUserUrl, Lang.get('js.assistant'))
})

listenClick('.add-qualification', function () {
    let userId = $(this).attr('data-id')
    $('#qualificationID').val(userId)
    $('#qualificationModal').modal('show')
})

listenSubmit('#qualificationForm', function (e) {
    e.preventDefault()
    $.ajax({
        url: route('add.qualification'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#year').val(null).trigger('change')
                $('#qualificationModal').modal('hide')
                livewire.emit('refresh')
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listen('hidden.bs.modal', '#qualificationModal', function () {
    resetModalForm('#qualificationForm')
    $('#year').val(null).trigger('change')
})

listenClick('.assistant-status', function (event) {
    let assistantRecordId = $(event.currentTarget).attr('data-id')

    $.ajax({
        type: 'PUT',
        url: route('assistant.status'),
        data: { id: assistantRecordId },
        success: function (result) {
            livewire.emit('refresh')
            displaySuccessMessage(result.message)
        },
    })
})

listenClick('.assistant-email-verification', function (event) {
    let userId = $(event.currentTarget).attr('data-id')
    $.ajax({
        type: 'POST',
        url: route('resend.email.verification', userId),
        success: function (result) {
            displaySuccessMessage(result.message)
            setTimeout(function () {
                Turbo.assistance(window.location.href);
            }, 5000);
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listenClick('#qualificationSaveBtn',function(){
    $('#qualificationForm').trigger('submit');
})

listenChange('.assistant-email-verified', function (e) {
    let recordId = $(e.currentTarget).attr('data-id')
    let value = $(this).is(':checked') ? 1 : 0
    $.ajax({
        type: 'POST',
        url: route('emailVerified'),
        data: {
            id: recordId,
            value: value,
        },
        success: function (result) {
            livewire.emit('refresh')
            displaySuccessMessage(result.message)
        },
    })
})
