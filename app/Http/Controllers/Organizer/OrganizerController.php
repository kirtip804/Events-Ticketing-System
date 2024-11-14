<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use Carbon\Carbon;

class OrganizerController extends Controller
{
    public function index() {
        
        $data = [];

        $data['pagetitle'] = 'Organizer | Dashboard';

        $data['menu_dashboard']  	   = 'dashboard';

        $currentDate = Carbon::now();

        $upcomingEvents = Event::where('event_date', '>', $currentDate)
                            ->orderBy('event_date', 'asc')
                            ->take(5)
                            ->get();

        $data['upcomingEvents'] = $upcomingEvents;

        return view_organizer('dashboard', $data);

	}

	public function logout() {
		Auth::logout();
		return redirect()->route('sign-in');
	}
}
