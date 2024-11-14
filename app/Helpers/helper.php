<?php

/*=================== ORGANIZER RELATED FUNCTIONS ===================*/
if(!function_exists('url_organizer')) {
	function url_organizer($path) {
	    return url('organizer/'.ltrim($path, '/'));
	}
}

if(!function_exists('asset_organizer')) {
	function asset_organizer($path) {
	    return asset('/organizer/'.ltrim($path, '/'));
	}
}

if(!function_exists('view_organizer')) {
	function view_organizer($view, $data=[]) {
		return view('organizer.'.$view, $data);
	}
}


/*=================== ADMIN RELATED FUNCTIONS ===================*/

if(!function_exists('url_attendees')) {
	function url_attendees($path) {
	    return url('attendee/'.ltrim($path, '/'));
	}
}

if(!function_exists('asset_attendees')) {
	function asset_attendees($path) {
	    return asset('/attendees/'.ltrim($path, '/'));
	}
}

if(!function_exists('view_attendees')) {
	function view_attendees($view, $data=[]) {
		return view('attendees.'.$view, $data);
	}
}

/* =================== PRICE FORMATING FUNCTIONS ===================*/
if(!function_exists('formatPrice')) {
	function formatPrice($price, $decimalpoints = 2) {
		return (number_format((float)$price, $decimalpoints, '.', ','));
	}
}

if(!function_exists('formatPriceInteger')) {
    function formatPriceInteger($price) {
        return number_format((float)$price, 2, '.', '');
    }
}

if(!function_exists('encode')) {
	function encode($value) {
		return base64_encode($value);
	}
}

if(!function_exists('decode')) {
	function decode($value) {
		return base64_decode($value);
	}
}

if ( ! function_exists('loginfo') )
{
	function loginfo($content) {
		\Illuminate\Support\Facades\Log::info($content);
	}
}
