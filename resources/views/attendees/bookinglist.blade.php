@extends('attendees.layouts.templet')

@section('content')
<div class="container mt-5">
    <h3 class="text-left mb-4">My Bookigs</h3>
    <table class="table table-bordered table-striped" id="events-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Event Name</th>
                <th class="text-center">Date</th>
                <th class="text-center">Ticket Type</th>
                <th class="text-center">Total Tickets</th>
                <th class="text-center">Total Price</th>
            </tr>
        </thead>
        <tbody id="tabledata">
           @if(isset($bookings) && count($bookings) > 0)
				@foreach($bookings as $index => $booking)
					<tr>
			            <td class="text-center">{{ ( ($bookings->currentPage() - 1 ) * $bookings->perPage() ) + $index + 1 }}</td>
			            <td>{!! $booking->event->title !!}</td>
			            <td class="text-center">{{ \Carbon\Carbon::parse($booking->event->event_date)->format(config('constants.dateformat_readable')) }}</td>
			            <td class="text-center">{{ config('constants.tickettype')[$booking->ticket->type] }}</td>
			            <td class="text-center">{{ $booking->quantity }}</td>
			            <td class="text-center">{{ $booking->total_price }}</td>
			        </tr>
				@endforeach
			@else
			<tr>
				<td colspan="6" class="text-center">
					<div>
						<h6 class="m0">No Bookings found!</h6>
					</div>
				</td>
			</tr>
			@endif 
        </tbody>
    </table>
</div>
@endsection