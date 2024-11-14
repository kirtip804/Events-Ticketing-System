@extends('organizer.layouts.templet')

@section('content')
<div class="container mt-5">
    <h3 class="text-left mb-4">Tickets Listing</h3>
    <div class="d-flex justify-content-between mb-4">
        <a class="btn btn-primary" href="{{ route('organizer.tickets.add') }}">Add Ticket</a>
    </div>

    <table class="table table-bordered table-striped" id="events-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Event Name</th>
                <th class="text-center">Tickets Type</th>
                <th class="text-center">Price</th>
                <th class="text-center">Quantity</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody id="tabledata">
        </tbody>
    </table>
</div>
@endsection
@section('page-script')
<script src="{{ asset_organizer('js/tickets/tickets.js?cache=1.0.0') }}"></script>
@endsection