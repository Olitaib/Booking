<?php

namespace App\Service;

use App\Models\Hotel;
use App\Validator\Validator;
use Illuminate\View\View;

class HotelService
{

    public function __construct(private Validator $validator)
    {

    }

    public function index(array $hotelsData): View
    {
        if ($this->validator->hotel($hotelsData)) {
            return view('errors.validation-errors', ['errors' => $this->validator->errors]);
        }

        $facilities = Hotel::allHotelsFacilities();
        $hotels = Hotel::filterHotels(
            sort: $hotelsData['sort'],
            filters: $hotelsData['filters']
        );

        return view('hotels.index', ['hotels' => $hotels, 'facilities' => $facilities]);
    }

    public function show(array $hotelsData): View
    {
        if ($this->validator->hotel($hotelsData)) {
            return view('errors.validation-errors', ['errors' => $this->validator->errors]);
        }

        $hotel = Hotel::find($hotelsData['id']);
        $rooms = $hotel->filterRooms(
            start_date: $hotelsData['start_date'],
            end_date: $hotelsData['end_date'] ,
            sort: $hotelsData['sort'],
            filters: $hotelsData['filters']
        );

        return view('hotels.show', [
            'hotel' => $hotel,
            'rooms' => $rooms,
            'bookingDates' => [
                'start_date' => $hotelsData['start_date'],
                'end_date' => $hotelsData['end_date']
            ]
        ]);
    }

}
