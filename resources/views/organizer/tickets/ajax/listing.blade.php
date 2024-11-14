@if(isset($tickets) && count($tickets) > 0)
	@foreach($tickets as $index => $ticket)
		<tr>
            <td class="text-center">{{ ( ($tickets->currentPage() - 1 ) * $tickets->perPage() ) + $index + 1 }}</td>
            <td>{!! $ticket->event->title !!}</td>
            <td class="text-center">{{ config('constants.tickettype')[$ticket->type]}}</td>
            <td class="text-center">{{ $ticket->price }}</td>
            <td class="text-center">{{ $ticket->quantity }}</td>
            <td class="text-center">
            	<a href="{{ url_organizer('tickets/edit/'.$ticket->ticket_id) }}" class="edit-btn">Edit</a>
            	<a href="javascript:void(0);" onclick="deleteEntity({{ $ticket->ticket_id }});" class="dlt-btn">Delete</a>
            </td>
        </tr>
	@endforeach
@else
<tr>
	<td colspan="6" class="text-center">
		<div>
			<h6 class="m0">No tickets found!</h6>
		</div>
	</td>
</tr>
@endif