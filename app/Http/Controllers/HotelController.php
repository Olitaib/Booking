<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\Hotel;
use Illuminate\View\View;

class HotelController extends Controller
{
    public function index(Request $request): View
    {
        $hotels = Hotel::all();

        if ($request['sort']) {
            $hotels = $this->filterHotels($request['sort'], $request['filters']);
        }

        $facilities = Facility::query()->whereHas('hotels')->get();

        return view('hotels.index', ['hotels' => $hotels, 'facilities' => $facilities]);
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

    public function filterHotels(string $sort, ?array $filters)
    {
        $hotels = Hotel::query()
            ->select('h.*', Room::raw('MAX(r.price) as maxPrice'), Room::raw('MIN(r.price) as minPrice'))
            ->from('hotels as h')
            ->join('rooms as r', 'r.hotel_id', '=', 'h.id')
            ->groupBy('h.id');

        if ($filters) {
            $count = count($filters);
            $hotels
                ->join('facility_hotels as fh', 'fh.hotel_id', '=', 'h.id')
                ->join('facilities as f', 'f.id', '=', 'fh.facility_id')
                ->whereIn('f.id', $filters)
                ->groupBy('h.id')
                ->havingRaw("COUNT(DISTINCT f.id) = $count");
        }

        $sort = explode('_', $sort);

        return $hotels
            ->distinct()
            ->orderBy($sort['0'], $sort['1'])
            ->get();

    }

}
