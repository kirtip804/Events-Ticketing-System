$(document).ready(function(){
	 // Validations
    $("#signupForm").validate({
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            mobile: {
                required: true,
                number: true
            },
            password: {
                required: true,
            },
            role: {
                required: true
            },
           
        },
        messages: {
            name: {
                required: "Please enter name.",
            },
            email: {
                required: "Please enter the e-mail.",
                email: 'Please enter a valid e-mail address.',
            },
            mobile: {
                required: 'Please enter the mobile number',
                number: 'Please enter the valid mobile number'
            },
            password: {
                required: 'Please enter your password',
            },
            role: {
                required: "Please select the role.",
            }
        },
        submitHandler: submitHandlerSignupForm
    });
});

function submitHandlerSignupForm(form) {
    disableFormButton(form);
    showLoader();
    //console.log("here");
    $(form).ajaxSubmit({
        dataType: 'json',
        success: formResponseSignupForm,
        error: formResponseError
    });
}

function formResponseSignupForm(responseText, statusText) {
    var form = $('#signupForm');
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
