listenClick('.doctor-visit-delete-btn', function (event) {
    let visitDoctorRecordId = $(event.currentTarget).attr('data-id')
    deleteItem(route('doctors.visits.destroy', visitDoctorRecordId), Lang.get('js.visits'))
})

listenClick('.assistant-assistance-delete-btn', function (event) {
    let assistanceAssistantrRecordId = $(event.currentTarget).attr('data-id')
    deleteItem(route('assistants.assistances.destroy', assistanceAssistantrRecordId), Lang.get('Assistance'))
})
 

