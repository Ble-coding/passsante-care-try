
// gestion d'image de profil en fonciton du genre selectionner 

listenChange('input[type=radio][name=genre]', function () {
    let file = $('#profilePicture').val()
    if (isEmpty(file)) {
        if (this.value == 1) {
            $('.image-input-wrapper').
                attr('style', 'background-image:url(' + manAvatar + ')')
        } else if (this.value == 2) {
            $('.image-input-wrapper').
                attr('style', 'background-image:url(' + womanAvatar + ')')
        }
    }
})


// creation de la visite
// listenSubmit('#createVisiteForm', function () {
//     if ($('#error-msg').text() !== '') {
//         $('#phoneNumber').focus()
//         displayErrorMessage(Lang.get('js.contact_number') + $('#error-msg').text())
//         return false
//     }
// })


// Modification des informations de la visite du visiteur 
listenSubmit('#editVisitorForm', function () {
    if ($('#error-msg').text() !== '') {
        $('#phoneNumber').focus()
        displayErrorMessage(Lang.get('js.contact_number') + $('#error-msg').text())
        return false
    }
})


// le changement d'image de fond 
listenClick('.removeAvatarIcon', function () {
    $('#bgImage').css('background-image', '')
    $('#bgImage').css('background-image', 'url(' + backgroundImg + ')')
    $('#removeAvatar').addClass('hide')
    $('#tooltip287851').addClass('hide')
})


