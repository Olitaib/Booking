<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelController extends Controller
{

    public function index()
    {
        $hotels = Hotel::all();

        return response()->json($hotels);
    }

    public function show(Request $request)
    {
        $hotel = Hotel::find($request['id']);

        return response()->json($hotel);
    }

}
