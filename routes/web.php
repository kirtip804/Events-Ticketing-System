<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Organizer\OrganizerController;
use App\Http\Controllers\Organizer\EventController;
use App\Http\Controllers\Organizer\TicketController;
use App\Http\Controllers\Attendee\AttendeeController;
use App\Http\Controllers\Attendee\TicketBookingController;

 


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'home']);
Route::get('/sign-up', [AuthController::class, 'signup'])->name('sign-up');
Route::post('/sign-up', [AuthController::class, 'signupsubmit'])->name('sign-up.submit');
Route::get('verify/{token}', [AuthController::class, 'verifyEmail'])->name('verify.email');
Route::get('/sign-in', [AuthController::class, 'signin'])->name('sign-in');
Route::post('/sign-in', [AuthController::class, 'signinsubmit'])->name('sign-in.submit');

Route::middleware('auth')->group(function () {
    // Organiser Routes (with 'organiser' prefix and role check)
    Route::prefix('organizer')->middleware('role:'.config('constants.is_organizer'))->group(function () {
    	Route::get('/logout', [OrganizerController::class, 'logout'])->name('organizer.logout');
        Route::get('/dashboard', [OrganizerController::class, 'index'])->name('organizer.dashboard');

        Route::get('/events', [EventController::class, 'index'])->name('organizer.events');
        Route::post('/events/load', [EventController::class, 'load'])->name('organizer.events.load');
        Route::get('/events/add', [EventController::class, 'add'])->name('organizer.events.add');
        Route::get('/events/edit/{id}', [EventController::class, 'edit'])->name('organizer.events.edit');
        Route::post('/events/save', [EventController::class, 'save'])->name('organizer.events.save');
        Route::post('/events/destroy', [EventController::class, 'destroy'])->name('organizer.events.destroy');
         Route::get('/events/attendees/{event_id}', [EventController::class, 'attendees'])->name('organizer.events.attendees');

        Route::get('/tickets', [TicketController::class, 'index'])->name('organizer.tickets');
        Route::post('/tickets/load', [TicketController::class, 'load'])->name('organizer.tickets.load');
        Route::get('/tickets/add', [TicketController::class, 'add'])->name('organizer.tickets.add');
        Route::post('/tickets/save', [TicketController::class, 'save'])->name('organizer.tickets.save');
        Route::get('/tickets/edit/{id}', [TicketController::class, 'edit'])->name('organizer.tickets.edit');
        Route::post('/tickets/destroy', [TicketController::class, 'destroy'])->name('organizer.tickets.destroy');
    });

    // Attendee Routes (with 'attendee' prefix and role check)
    Route::prefix('attendee')->middleware('role:'.config('constants.is_attendees'))->group(function () {
        Route::get('/dashboard', [AttendeeController::class, 'index'])->name('attendee.dashboard');
        Route::get('/logout', [AttendeeController::class, 'logout'])->name('attendee.logout');
        Route::get('/events', [AttendeeController::class, 'events'])->name('attendee.events');
        Route::get('/events/details/{id}', [AttendeeController::class, 'eventdetails'])->name('attendee.events.edit');

        Route::get('/event/book/{ticket_id}', [TicketBookingController::class, 'showbookingform'])->name('attendee.events.book');
        Route::post('/event/booking', [TicketBookingController::class, 'booking'])->name('attendee.events.booking');
        Route::get('/event/booking/list', [TicketBookingController::class, 'bookinglist'])->name('attendee.events.bookinglist');

    });
});