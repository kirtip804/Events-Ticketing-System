<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\Event;
use App\Models\TicketBooking;

class EventController extends Controller
{
	public function index() {

		$data 					= [];
 
        $data['pagetitle']  	=  'Events';
 
        $data['menu_events'] 	= true;

		return view_organizer('events.listing', $data);
	}

	public function load(Request $request) {

		if($request->ajax()) {
 		
 			$events           	= Event::search($request->search)->paginate(config('constants.perpage'));

			$data['events']   	= $events;
            
    		return view_organizer('events.ajax.listing', $data);
		}
		else {
			return "No direct access allowed";
		}
	}

	public function add() {

		$data 					= [];
 
        $data['pagetitle']  	=  'Events | Add';
 
        $data['menu_events'] 	= true;

        $data['event']          = new Event;

        return view_organizer('events.add', $data);
	}

	public function edit($id) {
        
        $event = Event::find($id);

        if($event) {

        	$data 					= [];
 
	        $data['pagetitle']  	=  'Events | Edit';
	 
	        $data['menu_events'] 	= true;

	        $data['event']          = $event;

	        return view_organizer('events.add', $data);
        }
        else {
        	abort(404);
        }

	}

	public function save(Request $request) {
     	
     	if($request->ajax()) {
     		
     		$validator = Validator::make($request->all(), [
     			'title' => 'required|max:50',
     			'location' => 'required',
     			'event_date' => 'required',
     			'ticket_availability' => 'required',
     			'description' => 'required',
     		]);

     		if($validator->fails()) {
     			$errors         = $validator->errors()->all();
	            $data['type']   = 'error';
	            $data['caption']= 'One or more invalid input found.';
	            $data['errorfields'] = $validator->errors()->keys();
	            $data['errors'] = $errors;
     		}
     		else {

     			$event_id                   = $request->event_id;

     			if($event_id) {
     				$event 						= Event::find($event_id);
     			}
     			else {
     				$event 						= new Event;	
     			}
     				
     			$event->user_id             = Auth::user()->user_id;
     			$event->title 				= $request->title;
     			$event->location 			= $request->location;
     			$event->event_date 			= $request->event_date;
     			$event->ticket_availability = $request->ticket_availability	;
     			$event->description 		= $request->description;

     			if($event->save()) {
                      
                    $data['type'] 			= 'success';
                    $data['caption']		= 'Event saved successfully.';
                    $data['redirectUrl'] 	= route('organizer.events');
     			}
     			else {
                   
                    $data['type']           = 'error';
                    $data['caption']        = 'Unable to save event. Pleae try agin letter.';
     			}
     		}

     		return response()->json($data);
     	}
     	else {
     		return "No direct access allowed";
     	}
	}

    public function destroy(Request $request) {
       
       if($request->ajax()) {

            $data           = [];

            $event    = Event::find($request->event_id);

            if($event) {

                if($event->delete()) {

                    $data['type']       = 'success';
                    $data['caption']    = 'Event deleted successfully.';
                }
                else {
            
                    $data['type']       = 'error';
                    $data['caption']    = 'Unable to delete event.';
                }

            }
            else {
                $data['type']        = 'error';
                $data['caption']     = 'Invalid events.';
            }

            return response()->json($data);
       }
       else {
            return "No direct access allowed";
       }
    }

    public function attendees($event_id) {

        $data = [];

        $bookings = TicketBooking::where('event_id', $event_id)->paginate();

        $data['bookings'] = $bookings;

        return view_organizer('attendeeslist', $data);
    }
}
