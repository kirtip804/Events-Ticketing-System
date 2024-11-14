<?php

namespace App\Http\Controllers\Attendee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\TicketBooking;

class TicketBookingController extends Controller
{

	public function showbookingform($ticket_id) {
        
        $data = [];

        $data['pagetitle'] = 'Events | Booking';

        $data['menu_events'] = true;

		$ticket = Ticket::find($ticket_id);

		if($ticket) {

			$availableTickets = $ticket->quantity - $ticket->sold;

			$data['availableTickets'] = $availableTickets;

			$data['ticket'] = $ticket;

			$data['event'] = Event::where('event_id', $ticket->event_id)->first();

			return view_attendees('booking', $data);
		}
		else {
			abort(404);
		}
	}

	public function booking(Request $request) {

		if($request->ajax()) {

           $data = [];

           $validator = Validator::make($request->all(), [
           		'quantity' => 'required|numeric|min:1',
           		'card_number' => 'required|numeric'
           ]);

           if($validator->fails()) {
           		$errors         = $validator->errors()->all();
	            $data['type']   = 'error';
	            $data['caption']= 'One or more invalid input found.';
	            $data['errorfields'] = $validator->errors()->keys();
	            $data['errors'] = $errors;
           }
           else {

           		$quantity  	= $request->quantity;
           		$event_id 	= $request->event_id;
           		$ticket_id 	= $request->ticket_id;
           		$user_id    = Auth::user()->user_id;

           		$ticket     = Ticket::find($ticket_id);
 				
 				$availableTickets = $ticket->quantity - $ticket->sold;

 				if ($availableTickets <= 0) {
 					$data['type'] = 'error';
 					$data['caption'] = 'No tickets available.';
 				}
 				else {
 					if ($quantity > $availableTickets) {	
 						$data['type'] = 'error';
 						$data['caption'] = 'Not enough tickets available.';
 					}
 					else {
        				$totalPrice = $ticket->price * $quantity;

        				$ticket->sold += $quantity;
            			$ticket->save();

            			$booking = new TicketBooking;
            			$booking->user_id     = $user_id;
            			$booking->event_id    = $event_id;
            			$booking->ticket_id   = $ticket_id;
            			$booking->quantity    = $quantity;
            			$booking->total_price = $totalPrice;
            			$booking->status      = 2;

            			if($booking->save()) {

            				$booking->sendConfirmEmail(Auth::user(), $ticket, $booking);

                            $data['type'] = 'success';
                            $data['caption'] = 'Booking completed successfully.';
                            $data['redirectUrl'] = route('attendee.events');
            			}
            			else {
                            $data['type'] = 'success';
                            $data['caption'] = 'Unable to proceed with the booking. Please try again later.';
            			}
 					}
 				}
           }
           return response()->json($data);
		}
		else {
			return "No direct access allowed";
		}
	}

  public function bookinglist() {

    $data = [];

    $user_id = Auth::user()->user_id;

    $bookings = TicketBooking::where('user_id', $user_id)->paginate();

    $data['bookings'] = $bookings;

    return view_attendees('bookinglist', $data);

  }
}  