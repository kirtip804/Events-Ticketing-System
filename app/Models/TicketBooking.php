<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class TicketBooking extends Model
{
    use HasFactory;

    protected $table='ticket_bookings';
    protected $primaryKey='ticket_booking_id';


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id', 'ticket_id');
    }

    function sendConfirmEmail($user, $ticket, $booking) {

    	$subject        = "Booking Confirmation";

        $emailvar       = array();

        $emailvar['mailto']         = $user->email;
        $emailvar['mailfrom']       = env('MAIL_FROM_ADDRESS');
        $emailvar['subject']        = $subject;
        
        $mailmessage  = 'Hello, ' . "<br/><br/>";
        $mailmessage .= 'Thank you for booking with us! We are pleased to confirm your booking details as follows' . "<br/><br/> ";
        $mailmessage .= 'Name: ' .$user->name . "<br/>";
        $mailmessage .= 'Email: ' .$user->email . "<br/>";
        $mailmessage .= 'Event: ' .$ticket->event->title . "<br/>";
        $mailmessage .= 'Ticket Quantity: ' .$booking->quantity . "<br/>";
        $mailmessage .= 'Total: ' .$booking->total_price . "<br/>";
        $mailmessage .= 'Ticket Type: ' .config('constants.tickettype')[$ticket->type] . "<br/><br/>";
        $mailmessage .= 'Thank You,' . "<br/>";
 
        // SEND MAIL
        $mailSent = Mail::send([], [], function ($message) use ($emailvar, $mailmessage) {
            $message->to($emailvar['mailto'], null);
            $message->from($emailvar['mailfrom']);
            $message->subject($emailvar['subject']);
            $message->replyTo($emailvar['mailfrom']);
            $message->html($mailmessage, 'text/html');
        });

        if ($mailSent === false) {
            return false;
        } else {
            return true;
        }
    }
}
