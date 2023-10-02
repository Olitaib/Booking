<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Booking;
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

        Booking::create([
            'user_id' => auth()->id(),
            'room_id' => $request->room_id,
            'started_at' => $request->started_at,
            'finished_at' => $request->finished_at,
            'days' => $days = Carbon::createFromDate($request->finished_at)->diffInDays($request->started_at),
            'price' => $days * Room::find($request->room_id)->price,
        ]);

        return redirect('bookings');
    }
}
