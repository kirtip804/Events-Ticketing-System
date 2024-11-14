var searchVal = '';
var page = 1;
var typingTimer;                
var doneTypingInterval = 2000

$(document).ready(function() {
	loadData(page, searchVal);
	$('#searchform').validate();
});

function searchEvents() {
    searchVal = $('#searchtextbox').val();

    clearTimeout(typingTimer);

    typingTimer = setTimeout(function() {
        loadData(page, searchVal);  // Call the loadData function with the current search value
    }, doneTypingInterval); 
}

function loadData(page, search) {
    showLoader();
    ajaxFetch(baseurl() + '/organizer/events/load', { page: page, search: search }, formResponse);
}

function formResponse(responseText, statusText) {
	var form = $('#searchform');
	enableFormButton(form);
	hideLoader();
	$('#searchtextbox').val(searchVal);

	if(statusText == 'success') {
		$('#tabledata').html(responseText);

		if($('#ajaxpagingdata').length > 0 && $.trim($('#ajaxpagingdata > td').html()) != '') {

			$('#pagingdata').html($('#ajaxpagingdata > td').html()).show();
			$('#ajaxpagingdata').remove();

			$('#pagingdata a[href]').click(function(event) {
				event.preventDefault();
				var arr = $(this).attr('href').split('page=');
				page = parseInt(arr[arr.length-1]);
				if(isNaN(page)) { page = 1; }
				loadData(page, searchVal);
			});
		}
		else {
			$('#ajaxpagingdata').remove();
			$('#pagingdata').html('').hide();
		}
	}
	else {
		showError('Unable to communicate with server.');
	}
}

function deleteEntity(event_id) {
	
	// Show the confirmation dialog
    var confirmDelete = confirm('Are you sure you want to delete this item?');
    
    if (confirmDelete) {
       	ajaxUpdate(baseurl() + '/organizer/events/destroy', { event_id: event_id }, function(responseText, statusText) {
 			hideLoader();
			if(statusText == 'success') {
				if(responseText.type == 'success') {

                    showSuccess(responseText.caption);

                    loadData(1, searchVal);
			    }
			    else {
                    showError(responseText.caption);
			    }
			}
			else {
				showError('Unable to communicate with server.');
			}
		});
    } else {
      // User canceled, do nothing
      console.log('Delete action canceled');
    }
}