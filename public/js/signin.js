$(document).ready(function(){
	 // Validations
    $("#signinForm").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
            },
        },
        messages: {
            email: {
                required: "Please enter the e-mail.",
                email: 'Please enter a valid e-mail address.',
            },
            password: {
                required: 'Please enter your password',
            },
        },
        submitHandler: submitHandlerSigninForm
    });
});

function submitHandlerSigninForm(form) {
    disableFormButton(form);
    showLoader();
    //console.log("here");
    $(form).ajaxSubmit({
        dataType: 'json',
        success: formResponseSigninForm,
        error: formResponseError
    });
}

function formResponseSigninForm(responseText, statusText) {
    var form = $('#signinForm');
    enableFormButton(form);
    hideLoader();

    if(statusText == 'success') {
        if(responseText.type == 'success') {
            showSuccess(responseText.caption, null, function() {
                window.location.href = responseText.redirectUrl;
            });
        }
        else {
            showError(responseText.caption, responseText.errormessage);
            if(responseText.errorfields !== undefined) {
                highlightInvalidFields(form, responseText.errorfields, responseText.errors);
            }
        }
    }
    else {
        showError('Unable to communicate with server.');
    }
}
