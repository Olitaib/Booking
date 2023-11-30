<?php

namespace App\Repositories;

use App\DTO\Hotel\HotelDataStoreRequest;
use App\DTO\Hotel\HotelDataStoreResponse;
use App\Models\Hotel;

class HotelSqlRepository
{

    public function index(HotelDataStoreRequest $hotelDSRequest): array
    {
        $facilities = Hotel::allHotelsFacilities();
        $hotels = [];

        foreach (Hotel::filterHotels(sort: $hotelDSRequest->getSort(), filters: $hotelDSRequest->getFilters()) as $hotel) {
            $hotels[] = new HotelDataStoreResponse($hotel);
        }

        return [
            'hotels' => $hotels,
            'facilities' => $facilities,
        ];
    }

    public function show(HotelDataStoreRequest $hotelDataStoreRequest): array
    {
        $hotel = Hotel::find($hotelDataStoreRequest->getId());

        return [
            'hotel' => new HotelDataStoreResponse(
                model: $hotel,
                sort: $hotelDataStoreRequest->getSort(),
                filters: $hotelDataStoreRequest->getFilters(),
                start_date: $hotelDataStoreRequest->getStart_date(),
                end_date: $hotelDataStoreRequest->getEnd_date(),
            )
        ];
    }

}
