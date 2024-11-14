<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Symfony\Component\Mime\Part\HtmlPart;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class SendVerificationEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        // Get the user from the event
        $user = $event->user;

        // Generate a verification URL with the token
        $verificationUrl = route('verify.email', $user->token);

        try {

            // Send the email directly using the Mail facade
            Mail::send([], [], function ($message) use ($user, $verificationUrl) {
                $message->to($user->email)
                        ->subject('Email Verification')
                        ->html(
                            'Thank you for registering! Please click the link below to verify your email address.<br><br>
                            <a href="' . $verificationUrl . '">Verify Email</a>',
                            'text/html'
                        );
            });

        }
        catch(\Exception $e) {
            loginfo('Failed to send verification email:' . $e->getMessage());
        }
    }
}
