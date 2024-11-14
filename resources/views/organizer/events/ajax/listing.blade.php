@if(isset($events) && count($events) > 0)
	@foreach($events as $index => $event)
		<tr>
            <td class="text-center">{{ ( ($events->currentPage() - 1 ) * $events->perPage() ) + $index + 1 }}</td>
            <td>{!! $event->title !!}</td>
            <td class="text-center">{{ \Carbon\Carbon::parse($event->event_date)->format(config('constants.dateformat_readable')) }}</td>
            <td class="text-center">{{ $event->location }}</td>
            <td class="text-center">
            	<a href="{{ url_organizer('events/edit/'.$event->event_id) }}" class="edit-btn">Edit</a>
            	<a href="javascript:void(0);" onclick="deleteEntity({{ $event->event_id }});" class="dlt-btn">Delete</a>
                <a href="{{ url_organizer('events/attendees/'.$event->event_id) }}" class="edit-btn">Attendees</a>
            </td>
        </tr>
	@endforeach
@else
<tr>
	<td colspan="5" class="text-center">
		<div>
			<h6 class="m0">No Events found!</h6>
		</div>
	</td>
</tr>
@endif