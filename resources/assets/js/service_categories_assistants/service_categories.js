
listenClick('#createServiceCategory', function () {
    $('#createServiceCategoryAssistantPageModal').modal('show').appendTo('body')
})

listen('hidden.bs.modal', '#createServiceCategoryAssistantPageModal', function () {
    resetModalForm('#createServiceCategoryAssistantForm',
        '#createServiceCategoryValidationErrorsBox')
})

listen('hidden.bs.modal', '#editServiceCategoryAssistantModal', function () {
    resetModalForm('#editServiceCategoryAssistantForm',
        '#editServiceCategoryValidationErrorsBox')
})

listenClick('.service-assistant-category-edit-btn', function (event) {
    let editServiceCategoryId = $(event.currentTarget).attr('data-id')
    renderData(editServiceCategoryId)
})

function renderData (id) {
    $.ajax({
        url: route('service-assistant-categories.edit', id),
        type: 'GET',
        success: function (result) {
            $('#serviceCategoryID').val(result.data.id)
            $('#editServiceCategoryName').val(result.data.name)
            $('#editServiceCategoryAssistantModal').modal('show')
        },
    })
}

listenSubmit('#createServiceCategoryAssistantForm', function (e) {
    e.preventDefault()
    $.ajax({
        url: route('service-assistant-categories.store'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                livewire.emit('refresh')
                $('#createServiceCategoryPageModal').modal('hide')
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listenSubmit('#editServiceCategoryAssistantForm', function (e) {
    e.preventDefault()
    let updateServiceCategoryId = $('#serviceCategoryID').val()
    $.ajax({
        url: route('service-assistant-categories.update', updateServiceCategoryId),
        type: 'PUT',
        data: $(this).serialize(),
        success: function (result) {
            $('#editServiceCategoryAssistantModal').modal('hide')
            displaySuccessMessage(result.message)
            livewire.emit('refresh')
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listenClick('.service-category-assistant-delete-btn', function (event) {
    let serviceCategoryRecordId = $(event.currentTarget).attr('data-id')
    deleteItem(route('service-assistant-categories.destroy', serviceCategoryRecordId),
        Lang.get('js.service_category'))
})
