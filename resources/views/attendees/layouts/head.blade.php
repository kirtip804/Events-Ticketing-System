<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@if(isset($pagetitle)) Event Ticketing System | {{ $pagetitle }} @else Event Ticketing System @endif</title>
	<meta name="description" content="Event Ticketing System">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="base-url" content="{{ url('/') }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="{{ asset_attendees('css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{ asset('plugins/alertify/css/alertify.core.css') }}" />
	<link rel="stylesheet" href="{{ asset('plugins/alertify/css/alertify.bootstrap.css') }}" />
	<link rel="stylesheet" href="{{ asset('css/common.css?cache=1.0.0')}}">
	<link rel="stylesheet" href="{{ asset_attendees('css/style.css?cache=1.0.0')}}">
</head>