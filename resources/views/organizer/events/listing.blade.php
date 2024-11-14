@extends('organizer.layouts.templet')

@section('content')
<div class="container mt-5">
    <h3 class="text-left mb-4">Events Listing</h3>
    <div class="d-flex justify-content-between mb-4">
        <a class="btn btn-primary" href="{{ route('organizer.events.add') }}">Add Event</a>
        <input type="text" id="searchtextbox" class="form-control w-50" placeholder="Search events..." onkeyup="searchEvents()">
    </div>

    <table class="table table-bordered table-striped" id="events-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Event Name</th>
                <th class="text-center">Date</th>
                <th class="text-center">Location</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody id="tabledata">
            <!-- Event rows will be dynamically inserted here -->
        </tbody>
    </table>
</div>
@endsection
@section('page-script')
<script src="{{ asset_organizer('js/events/events.js?cache=1.0.0') }}"></script>
@endsection