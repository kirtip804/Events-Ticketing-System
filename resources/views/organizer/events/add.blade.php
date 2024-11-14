@extends('organizer.layouts.templet')

@section('page-css')
<link href="{{ asset('plugins/date-timepicker/bootstrap-datetime-picker.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="container mt-5">
    @if($event->event_id)
    <h4 class="text-center mb-4">Edit Event</h4>
    @else
    <h4 class="text-center mb-4">Add New Event</h4>
    @endif
    <form id="addEventForm" class="form-block" method="POST" action="{{ route('organizer.events.save') }}">
    	<input type="hidden" name="event_id" value="{{ $event->event_id }}">
        <div class="row">
        	<div class="col-lg-6">
        		 <div class="mb-3">
		            <label for="title" class="form-label">Event Title</label>
		            <input type="text" class="form-control" id="title" name="title" value="{{ $event->title }}">
		        </div>
        	</div>
        	<div class="col-lg-6">
		        <div class="mb-3">
		            <label for="location" class="form-label">Event Location</label>
		            <input type="text" class="form-control" id="location" name="location" value="{{ $event->location }}">
		        </div>
        	</div>
        </div>
        <div class="row">
        	<div class="col-lg-6">
		        <div class="mb-3">
		            <label for="event_date" class="form-label">Event Date</label>
		            <input type="text" class="form-control" id="event_date" name="event_date" value="{{ $event->event_date }}" readonly="readonly">
		        </div>
        	</div>
        	<div class="col-lg-6">
        		<div class="mb-3">
		            <label for="ticket_availability" class="form-label">Tickets Availability</label>
		            <input type="text" class="form-control" id="ticket_availability" name="ticket_availability" value="{{ $event->ticket_availability }}">
		        </div>
        	</div>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Event Description</label>
            <textarea class="form-control" id="description" name="description" rows="4">{!! $event->description  !!}</textarea>
        </div>
        <div class="float-end pb-3">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection

@section('page-script')
<script src="{{ asset('plugins/date-timepicker/js/bootstrap-datetime-picker.js') }}"></script>
<script src="{{ asset_organizer('js/events/event.js?cache=1.0.0') }}"></script>
@endsection
