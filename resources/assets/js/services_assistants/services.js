
listenClick('#serviceAssistantResetFilter', function () {
    $('#servicesStatus').val($('#allServices').val()).trigger('change')
})

listenChange('#servicesStatus', function () {
    window.livewire.emit('changeStatusFilter', $(this).val())
})

listenClick('.service-assistant-delete-btn', function (event) {
    let serviceRecordId = $(event.currentTarget).attr('data-id')
    deleteItem(route('services-assistant.destroy', serviceRecordId), Lang.get('js.service'))
})

listenClick('.service-statusbar', function (event) {
    let recordId = $(event.currentTarget).attr('data-id')

    $.ajax({
        type: 'PUT',
        url: route('service-assistant.status'),
        data: { id: recordId },
        success: function (result) {
            displaySuccessMessage(result.message)
        },
    })
})

