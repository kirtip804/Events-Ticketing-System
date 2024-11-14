@extends('attendees.layouts.templet')

@section('content')
<div class="container mt-5">
    <h4 class="mb-4">Event Details</h4>
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

            <!-- Ticket Types and Availability -->
            <div class="col-md-6">
                <div class="ticket-types">
                    <h3>Available Ticket Types</h3>

                    @foreach($event->tickets as $ticket)
                        <div class="ticket-type">
                            <h4>{{ config('constants.tickettype')[$ticket->type] }}</h4>
                            <p><strong>Price:</strong> {{ number_format($ticket->price, 2) }}</p>
                            <p><strong>Available Tickets:</strong> {{ $ticket->quantity - $ticket->sold }} available</p>

                            <!-- If tickets are available, show a button to buy -->
                            @if($ticket->quantity - $ticket->sold > 0)
                                <a href="{{ route('attendee.events.book', ['ticket_id' => $ticket->ticket_id]) }}" class="btn btn-primary">Buy Tickets</a>
                            @else
                                <button class="btn btn-secondary" disabled>Sold Out</button>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection