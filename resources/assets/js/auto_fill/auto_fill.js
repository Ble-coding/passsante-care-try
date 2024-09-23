'use strict';

$(document).ready(function () {
    $('.admin-login').click();
});

window.changeCredentials = function (email, password) {
    $('#email').val(email);
    $('#password').val(password);
};

$(document).on('click', '.admin-login', function () {
    changeCredentials('admin@infycare.com', '123456');
},
);

// LES DOCTEURS 

$(document).on('click', '.doctor-login', function () {
    changeCredentials('doctor@infycare.com', '123456');
},
);


// LES PATIENTS 
$(document).on('click', '.patient-login', function () {
    changeCredentials('patient@infycare.com', '123456');
},
);


// LES ASSISTANTS 
$(document).on('click', '.assistant-login', function () {
    changeCredentials('assistant@infycare.com', '123456');
},
);

