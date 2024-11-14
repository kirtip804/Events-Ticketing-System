@extends('attendees.layouts.templet')

@section('content')
<div class="container mt-5">
    <h4 class="mb-4">Events</h4>
    <section class="events py-5">
    <div class="container">
      <div class="row">
        @if(isset($events) && count($events) > 0)
          @foreach($events as $key => $event)
          <div class="col-md-4 mb-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">{{ $event->title }}</h5>
                <p class="card-text">{!! $event->description !!}</p>
                <p class="text-muted">Date: {{ \Carbon\Carbon::parse($event->event_date)->format(config('constants.dateformat_readable')) }}</p>
            	<a href="{{ url_attendees('events/details/'.$event->event_id) }}" class="btn btn-primary">View Details</a>
              </div>
            </div>
          </div>
          @endforeach
        @else
        <div class="col-md-12">
            <div class="text-center pt-5">
               <h5>No events found!</h5>
            </div>
        </div>
        @endif
      </div>
    </div>
  </section>
</div>
@endsection