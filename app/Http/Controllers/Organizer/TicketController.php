<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\Event;
use App\Models\Ticket;

class TicketController extends Controller
{
	public function index() {

		$data 					= [];
 
        $data['pagetitle']  	=  'Tickets';
 
        $data['menu_tickets'] 	= true;

		return view_organizer('tickets.listing', $data);
	}

	public function load(Request $request) {

		if($request->ajax()) {
 		
 			$tickets           	= Ticket::search($request->search)->paginate(config('constants.perpage'));

			$data['tickets']   	= $tickets;
            
    		return view_organizer('tickets.ajax.listing', $data);
		}
		else {
			return "No direct access allowed";
		}
	}

	public function add() {
       
       $data = [];

       $data['pagetitle'] = 'Tickets | Add';

       $data['menu_tickets'] = true;

       $data['events'] = Event::pluck('title', 'event_id');

       $data['ticket'] = new Ticket;

       $data['tickettype']   = config('constants.tickettype');

       return view_organizer('tickets.add', $data);

	}

	public function edit($id) {

		$data = [];

		$data['pagetitle'] = 'Tickets | Edit';

       	$data['menu_tickets'] = true;

		$ticket = Ticket::find($id);

		if($ticket) {

			$data['events'] = Event::pluck('title', 'event_id');

			$data['tickettype']   = config('constants.tickettype');

			$data['ticket'] = $ticket;

			return view_organizer('tickets.add', $data);

		}
		else {
			abort(404);
		}
	}

	public function save(Request $request) {

		if($request->ajax()) {

			$validator = Validator::make($request->all(),[
				'event_id' => 'required',
				'type'     => 'required',
				'price'    => 'required',
				'quantity' => 'required'
			]);

			if($validator->fails()) {

				$errors         = $validator->errors()->all();
	            $data['type']   = 'error';
	            $data['caption']= 'One or more invalid input found.';
	            $data['errorfields'] = $validator->errors()->keys();
	            $data['errors'] = $errors;
			}
			else {

				$ticket_id = $request->ticket_id;


				$event = Event::where('event_id', $request->event_id)->first();

                $totalTicketsCreated = Ticket::where('event_id', $event->event_id)->sum('quantity');

                if($ticket_id) {

                	$ticket = Ticket::find($ticket_id);
                
            		$totalTicketsCreated -= $ticket->quantity; 
                }

                // Check if there are enough tickets available for the user to buy
        		$totalTicket = $totalTicketsCreated + intval($request->quantity);

        		
        		if ($totalTicket > $event->ticket_availability) {
		           		
		           	$data['type'] 		= 'error';
		           	$data['caption']    = 'Not enough tickets available for this event.';

		        }
		        else {

		        	if($ticket_id) {
						$ticket = Ticket::find($ticket_id);
					}
					else {
						$ticket = new Ticket;
					}

					$ticket->event_id = $request->event_id;
					$ticket->type     = $request->type;
					$ticket->price    = $request->price;
					$ticket->quantity = $request->quantity;

					if($ticket->save()) {
                        $data['type'] = 'success';
                        $data['caption'] = 'Ticket saved successfully.';
                        $data['redirectUrl'] = route('organizer.tickets');
					}
					else {
                        $data['type']    = 'error';
                        $data['caption'] = 'Unable to save ticket. Please try agin letter.';
					}
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

            $ticket    = Ticket::find($request->ticket_id);
            
            if($ticket) {

                if($ticket->delete()) {

                    $data['type']       = 'success';
                    $data['caption']    = 'Ticket deleted successfully.';
                }
                else {
            
                    $data['type']       = 'error';
                    $data['caption']    = 'Unable to delete ticket.';
                }

            }
            else {
                $data['type']        = 'error';
                $data['caption']     = 'Invalid ticket.';
            }

            return response()->json($data);
       }
       else {
            return "No direct access allowed";
       }
    }
}