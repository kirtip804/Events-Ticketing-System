@extends('organizer.layouts.templet')

@section('page-css')
<link href="{{ asset('plugins/date-timepicker/bootstrap-datetime-picker.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="container mt-5">
    @if($ticket->ticket_id)
    <h4 class="text-center mb-4">Edit Ticket</h4>
    @else
    <h4 class="text-center mb-4">Add New Ticket</h4>
    @endif
    <form id="addTicketForm" class="form-block" method="POST" action="{{ route('organizer.tickets.save') }}">
    	<input type="hidden" name="ticket_id" value="{{ $ticket->ticket_id }}">
        <div class="row">
        	<div class="col-lg-6">
        		 <div class="mb-3">
		            <label for="event_id" class="form-label">Event</label>
		            <select class="form-control" id="event_id" name="event_id">
                        <option value="">Select</option>
                        @foreach($events as $key => $event)
                        <?php $checked = ($key == $ticket->event_id) ?'selected="selected"':''; ?>
                        <option value="{{ $key }}" {{$checked}}>{{ $event }}</option>
                        @endforeach
                    </select>
		        </div>
        	</div>
        	<div class="col-lg-6">
		        <div class="mb-3">
		            <label for="type" class="form-label">Ticket Type</label>
		            <select class="form-control" id="type" name="type">
                        <option value="">Select</option>
                        @foreach($tickettype as $key => $type)
                        <?php $checked = ($key == $ticket->type) ?'selected="selected"':''; ?>
                        <option value="{{ $key }}" {{$checked}}>{{ $type }}</option>
                        @endforeach
                    </select>
		        </div>
        	</div>
        </div>
        <div class="row">
        	<div class="col-lg-6">
		        <div class="mb-3">
		            <label for="price" class="form-label">Price</label>
		            <input type="text" class="form-control" id="price" name="price" value="{{ $ticket->price }}">
		        </div>
        	</div>
        	<div class="col-lg-6">
        		<div class="mb-3">
		            <label for="quantity" class="form-label">Quantity</label>
		            <input type="text" class="form-control" id="quantity" name="quantity" value="{{ $ticket->quantity }}">
		        </div>
        	</div>
        </div>
        <div class="float-end pb-3">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection

@section('page-script')
<script src="{{ asset_organizer('js/tickets/ticket.js?cache=1.0.0') }}"></script>
@endsection
