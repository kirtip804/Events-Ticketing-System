<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Events\UserRegistered;
use App\Models\User;
use App\Models\Event;
use Carbon\Carbon;

class AuthController extends Controller
{
    
    public function home() {

      $data = [];

      $currentDate = Carbon::now();

      $upcomingEvents = Event::where('event_date', '>', $currentDate)
                            ->orderBy('event_date', 'asc')
                            ->take(5)
                            ->get();
      $data['upcomingEvents'] = $upcomingEvents;

      return view('home', $data);

    }
    public function signin() {

   		$data['pagetitle'] = 'Sign In';

      $data['roles'] = config('constants.roles');

   		return view('signin', $data);
    }

    public function signup() {

   		$data = [];

   		$data['pagetitle'] = 'Sign Up';

         $data['roles'] = config('constants.roles');

   		return view('signup', $data);

   }

   public function signupsubmit(Request $request) {

      if($request->ajax()) {
            
         $validator = Validator::make($request->all(), [

            'name'      => 'required|max:50',
            'email'     => 'required|email',
            'mobile'    => 'required|max:10',
            'role'      => 'required',
            'password'  => 'required'

         ]);

         if($validator->fails()) {

            $errors         = $validator->errors()->all();
            $data['type']   = 'error';
            $data['caption']= 'One or more invalid input found.';
            $data['errorfields'] = $validator->errors()->keys();
            $data['errors'] = $errors;

         }
         else {

            $user             = new User;
            $user->name       = $request->name;
            $user->email      = $request->email;
            $user->phoneno    = $request->mobile;
            $user->role       = $request->role;
            $user->token      = Str::random(60);
            $user->password   = $request->password;
            $user->status     = 2;
            
            if($user->save()) {

                // Fire the event to send the verification email
               event(new UserRegistered($user));

               $data['type']           = "success";
               $data['caption']        = "Thank you for registering with us. Please verify your email to complete the registration.";

               $data['redirectUrl'] = route('sign-in');
            }
            else {
               $data['type']        = 'error';
               $data['caption']     = 'Unable to register. Please try again later.';
            }
            
         }

         return response()->json($data);

      }
      else {
         return "No direct access allowed";
      }
   }


   public function verifyEmail($token) {
        
        $data = [];

        $user = User::where('token', $token)->first();
            
        if(!$user) {

            $data['message'] = 'Invalid or expired token';
        }
        else {

           $user->email_verified_at = now();
           $user->status = 1;
           $user->token  = null;
           $user->save();

           $data['message'] = 'Your email has been verified!';
        }

        return view('verify', $data);

   }

   public function signinsubmit(Request $request) {

      if($request->ajax()) {

         $validator = Validator::make($request->all(), [
             
            'email'     => 'required|email',
            'password'  => 'required'

         ]);

         if($validator->fails()) {

            $errors         = $validator->errors()->all();
            $data['type']   = 'error';
            $data['caption']= 'One or more invalid input found.';
            $data['errorfields'] = $validator->errors()->keys();
            $data['errors'] = $errors;
         }
         else {

            $email         = $request->email;
            $password      = $request->password;
            
            if(Auth::attempt(['email' => $email, 'password' => $password])) {

               $user = Auth::user();

               if($user->status === 2) {

                  Auth::logout();

                  $data['type']     = 'error';
                  $data['caption']  = 'Your email is not verified. Please verify your email first.';
               }
               else {
                
                  if($user->role === config('constants.is_organizer')) {

                    $data['redirectUrl'] = route('organizer.dashboard');
                  }
                  else if($user->role === config('constants.is_attendees')) {

                    $data['redirectUrl'] = route('attendee.dashboard');
                  }

                  $data['type']     = 'success';
                  $data['caption']  = 'Login SuccessFully.';
               }
            }  
            else {

               $data['type']     = 'error';
               $data['caption']  = 'Invalid credentials, Please try agin.';

            }
         }

         return response()->json($data);
      }
      else {
         return "No direct access allowed";
      }
   }

}
