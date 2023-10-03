<?php

namespace App\Http\Controllers;

use App\Mail\BookingCanceled;
use App\Mail\BookingCompleted;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class BookingController extends Controller
{

    public function index(): View
    {
        $bookings = Booking::whereBelongsTo(auth()->user())->get();

        return view('bookings.index', ['bookings' => $bookings]);
    }

    public function show(Request $request): View
    {
        $booking = Booking::find($request['id']);

        return view('bookings.show', ['booking' => $booking]);
    }

    public function store(Request $request)
    {
        $booking = Booking::create([
            'user_id' => auth()->id(),
            'room_id' => $request->room_id,
            'started_at' => $request->started_at,
            'finished_at' => $request->finished_at,
            'days' => $days = Carbon::createFromDate($request->finished_at)->diffInDays($request->started_at),
            'price' => $days * Room::find($request->room_id)->price,
        ]);

        Mail::to(Auth::user()->email)->send(new BookingCompleted($booking));

        return redirect('bookings');
    }

    public function remove(Request $request)
    {
        $booking = Booking::find($request->booking_id);
        $booking->delete();

        Mail::to(Auth::user()->email)->send(new BookingCanceled($booking));

        return redirect('bookings');
    }

}
