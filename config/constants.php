<?php

return [
	'website'						=> 'EventTickets',	
	
	// date related data
	'dateformat_listing_datetime'	=> 'M d, y h:i A',
	'dateformat_listing_date'  		=> 'M d, y',
	'dateformat_datepicker'	   		=> 'Y-m-d',
	'dateformat_readable' 	   		=> 'F d, Y',
	'dateformat_datetime' 	   		=> 'd M h:i A',
	'dateformat_order'				=> 'F d, Y',
	'datetimeformat_database'		=> 'Y-m-d H:i:s',
	'dateformat_listing_time'		=> 'h:i A',

	'is_organizer'                  => 1,
	'is_attendees'                  => 2,

	'roles'                         => [
		'1' => 'Organizer',
		'2' => 'Attendees'
	],

	'tickettype'                   => [
		'1' => 'Regular',
		'2' => 'Early Bird',
		'3' => 'VIP'
	],

	'perpage'						=> 10,

];