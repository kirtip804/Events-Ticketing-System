<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Event Ticketing System</title>
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
  
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">EventTickets</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('sign-up') }}">Sign Up</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('sign-in') }}">Sign In</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <section class="events py-5">
    <div class="container">
      <h2 class="text-center mb-4">Upcoming Events</h2>
      <div class="row">
        @if(isset($upcomingEvents) && count($upcomingEvents) > 0)
          @foreach($upcomingEvents as $key => $event)
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
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>
