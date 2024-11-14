@extends('organizer.layouts.templet')

@section('content')
<div class="container mt-5">
    <h3 class="text-left mb-4">Upcoming events</h3>
    <table class="table table-bordered table-striped" id="events-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Event Name</th>
                <th class="text-center">Date</th>
                <th class="text-center">Location</th>
            </tr>
        </thead>
        <tbody id="tabledata">
            @if(isset($upcomingEvents) && count($upcomingEvents) > 0)
				@foreach($upcomingEvents as $index => $event)
					<tr>
			            <td class="text-center">{{ $index + 1 }}</td>
			            <td>{!! $event->title !!}</td>
			            <td class="text-center">{{ \Carbon\Carbon::parse($event->event_date)->format(config('constants.dateformat_readable')) }}</td>
			            <td class="text-center">{{ $event->location }}</td>
			        </tr>
				@endforeach
			@else
			<tr>
				<td colspan="4" class="text-center">
					<div>
						<h6 class="m0">No upcomimg events found!</h6>
					</div>
				</td>
			</tr>
			@endif
        </tbody>
    </table>
</div>
@endsection