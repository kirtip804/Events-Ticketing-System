$(document).ready(function(){
	 // Validations
    $("#bookingForm").validate({
        rules: {
            quantity: {
                required: true,
                number: true,            
                min: 1  
            },
            card_number: {
                required: true,
                digits: true 
            },
        },
        messages: {
            quantity: {
                required: "Please enter a quantity.", 
                number: "Please enter a valid quantity.", 
                min: "Quantity must be at least 1." 
            },
            card_number: {
                required: 'Please enter your card number',
                digits: "Your card number can only contain digits."
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
    var form = $('#bookingForm');
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
