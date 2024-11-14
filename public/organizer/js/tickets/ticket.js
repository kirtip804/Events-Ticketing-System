$(document).ready(function() {
    $("#addTicketForm").validate({
        rules: {
            event_id: {
                required: true
            },
            type: {
                required: true,
            },
            price: {
                required: true,
            },
            quantity: {
                required: true,
            }
        },
        messages: {
            event_id: {
                required: "Please select the event.",
            },
            type: {
                required: "Please select the ticket type.",
            },
            price: {
                required: "Please enter the price.",
            },
            quantity: {
                required: "Please enter the quantity",
            }
        },
        submitHandler: submitHandlerTicketForm
    });
});


function submitHandlerTicketForm(form) {
    disableFormButton(form);
    showLoader();
    //console.log("here");
    $(form).ajaxSubmit({
        dataType: 'json',
        success: formResponseTicketForm,
        error: formResponseError
    });
}

function formResponseTicketForm(responseText, statusText) {
    var form = $('#addTicketForm');
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