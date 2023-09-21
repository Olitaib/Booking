<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{

    public function index()
    {
        $bookings = Booking::all();

        return response()->json($bookings);
    }

    public function show(Request $request)
    {
        $booking = Booking::find($request['id']);

        return response()->json($booking);
    }

}
