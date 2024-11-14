$(document).ready(function() {
	$('#event_date').datepicker({
        format: 'yyyy-mm-dd',  // Date format: Year-Month-Day
        startDate: 'today',    // Prevent selecting past dates
        autoclose: true        // Close the calendar when a date is selected
    });

    $("#addEventForm").validate({
        rules: {
            title: {
                required: true
            },
            location: {
                required: true,
            },
            event_date: {
                required: true,
            },
            ticket_availability: {
                required: true,
            },
            description: {
                required: true,
            }
        },
        messages: {
            title: {
                required: "Please enter the title.",
            },
            location: {
                required: "Please enter the location.",
            },
            event_date: {
                required: "Please selected the event date.",
            },
            ticket_availability: {
                required: "Please enter the tickets availability.",
            },
            description: {
                required: "Please enter the description."
            }
        },
        submitHandler: submitHandlerEventForm
    });
});


function submitHandlerEventForm(form) {
    disableFormButton(form);
    showLoader();
    //console.log("here");
    $(form).ajaxSubmit({
        dataType: 'json',
        success: formResponseEventForm,
        error: formResponseError
    });
}

function formResponseEventForm(responseText, statusText) {
    var form = $('#addEventForm');
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