@extends('attendees.layouts.templet')

@section('content')
<div class="container mt-5">
    <h4 class="mb-4">Booking Ticket for Event: {{ $event->title }}</h4>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="event-details">
                    <h1>{{ $event->title }}</h1>
                    <p><strong>Date:</strong> {{\Carbon\Carbon::parse($event->event_date)->format(config('constants.dateformat_readable')) }}</p>
                    <p><strong>Location:</strong> {{ $event->location }}</p>
                    <p><strong>Description:</strong> {{ $event->description }}</p>
                </div>
            </div>

            <div class="col-md-6 pb-5">
                <div class="ticket-booking">
                    <h3>Booking {{ config('constants.tickettype')[$ticket->type] }} Ticket</h3>
                    <p><strong>Price:</strong> ${{ number_format($ticket->price, 2) }}</p>
                    <p><strong>Available Tickets:</strong> {{ $availableTickets }} left</p>

                    <!-- Booking Form -->
                    <form id="bookingForm" class="form-block" action="{{ route('attendee.events.booking') }}" method="POST">
                        <input type="hidden" name="event_id" value="{{ $event->event_id }}">
                        <input type="hidden" name="ticket_id" value="{{ $ticket->ticket_id }}">
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1" max="{{ $availableTickets }}" required>
                        </div>

                        <div class="form-group">
                            <label for="card_number">Card Number</label>
                            <input type="text" name="card_number" id="card_number" class="form-control" placeholder="Enter fake card number" required>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Confirm Booking</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-script')
<script src="{{ asset_attendees('js/booking.js?cache=1.0.0') }}"></script>
@endsection