listenClick('.visit-delete-btn', function (event) {
    let visitRecordId = $(event.currentTarget).attr('data-id')
    deleteItem(route('visits.destroy', visitRecordId), Lang.get('js.visits'))
})


listenClick('.assistance-delete-btn', function (event) {
    let visitRecordId = $(event.currentTarget).attr('data-id')
    deleteItem(route('assistances.destroy', visitRecordId), Lang.get('Assistance'))
})


 