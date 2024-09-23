document.addEventListener('turbo:load', loadServiceData)

function loadServiceData () {

    if (!$('.price-input').length) {
        return
    }
    let price = $('.price-input').val()
    if (price === '') {
        $('.price-input').val('')
    } else {
        if (/[0-9]+(,[0-9]+)*$/.test(price)) {
            $('.price-input').val(getFormattedPrice(price))
            return true
        } else {
            $('.price-input').val(price.replace(/[^0-9 \,]/, ''))
        }
    }

}

listenClick('#createServiceAssistantCategory', function () {
    $('#serviceCreateServiceCategoryAssistantModal').modal('show').appendTo('body')
})

listenSubmit('#serviceCreateServiceCategoryAssistantForm', function (e) {
    e.preventDefault()
    $.ajax({
        url: route('service-assistant-categories.store'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#serviceCreateServiceCategoryAssistantModal').modal('hide')
                let data = {
                    id: result.data.id,
                    name: result.data.name,
                }

                let newOption = new Option(data.name, data.id, false, true)
                $('#serviceCategory').append(newOption).trigger('change')
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
        complete: function () {
            processingBtn('#serviceCreateServiceCategoryAssistantForm', '#btnSave')
        },
    })
})

listen('hidden.bs.modal', '#serviceCreateServiceCategoryAssistantModal', function () {
    resetModalForm('#serviceCreateServiceCategoryAssistantForm',
        '#createServiceCategoryAssistantValidationErrorsBox')
})
