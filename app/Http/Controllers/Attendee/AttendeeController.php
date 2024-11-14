<?php

namespace App\Http\Controllers\Attendee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
class AttendeeController extends Controller
{
    public function index() {
        
        $data = [];

        $data['pagetitle'] 	= 'Attendees | Dashboard';

        $data['menu_dashboard']  = true;

        return view_attendees('dashboard', $data);

	}

	public function logout() {
		Auth::logout();
		return redirect()->route('sign-in');
	}

	public function events() {
       
		$data = [];

		$data['pagetitle'] = 'Attendees | Events';

		$data['menu_events'] = true;

		$data['events'] = Event::all();

		return view_attendees('events', $data);

	}

	public function eventdetails($id) {

		$data = [];

		$data['pagetitle'] = 'Attendees | Events Details';

		$data['menu_events'] = true;

		$event = Event::find($id);
        
        if($event) {
            
            $data['event'] = $event;

            return view_attendees('eventdetails', $data);
        }
        else {
        	abort(404);
        }

	}
}