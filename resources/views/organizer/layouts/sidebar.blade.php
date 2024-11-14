<div class="bg-light border-end" id="sidebar" style="width: 250px;">
    <div class="d-flex flex-column p-3">
        <h3 class="text-center">Organizer</h3>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('organizer.dashboard') }}">
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('organizer.events') }}">
                    Events
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('organizer.tickets') }}">
                    Tickets
                </a>
            </li>
        </ul>
    </div>
</div>
