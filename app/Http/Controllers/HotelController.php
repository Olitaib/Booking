<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\Hotel;
use Illuminate\View\View;

class HotelController extends Controller
{
    public function index(): View
    {
        $hotels = Hotel::all();

        return view('hotels.index', ['hotels' => $hotels]);
    }

    public function show(Request $request): View
    {
        $hotel = Hotel::find($request['id']);
        $rooms = [];

        if (($request['start_date'])) {
            $rooms = $hotel->filterRooms(
                from: $request['start_date'],
                to: $request['end_date'],
                sort: $request['sort'],
                filters: $request['filters']
            );
        }

        return view('hotels.show', ['hotel' => $hotel, 'rooms' => $rooms]);
    }

}
