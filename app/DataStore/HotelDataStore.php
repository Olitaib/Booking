<?php

namespace App\DataStore;

use App\DTO\Hotel\HotelDataStoreRequest;
use App\Repositories\HotelSqlRepository;

class HotelDataStore
{

    public function __construct(protected HotelSqlRepository $hotelSqlRepository)
    {

    }

    public function index(HotelDataStoreRequest $hotelDSRequest): array
    {
        return $this->hotelSqlRepository->index($hotelDSRequest);
    }

    public function show(HotelDataStoreRequest $hotelDSRequest): array
    {
        return $this->hotelSqlRepository->show($hotelDSRequest);
    }

}
