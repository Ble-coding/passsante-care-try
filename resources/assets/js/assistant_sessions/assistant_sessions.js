


listenClick('.assistant-session-delete-btn', function (event) {
    let assistantSessionRecordId = $(event.currentTarget).attr('data-id')
    let assistantSessionUrl = $('#assistantSessionUrl').val();
    deleteItem((assistantSessionUrl + '/' + assistantSessionRecordId), Lang.get('js.assistant_session'))
})

