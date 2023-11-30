<?php

namespace App\Http\Controllers;

use App\DataStore\HotelDataStore;
use App\DTO\Hotel\HotelDataStoreRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HotelController extends Controller
{

    public function __construct(protected HotelDataStore $hotelDS)
    {
    }

    public function index(Request $request): View
    {
        return view('hotels.index', $this->hotelDS->index(new HotelDataStoreRequest(
            filters: $request['filters'],
            sort: $request['sort']
        )));
    }

    public function show(Request $request): View
    {
        return view('hotels.show', $this->hotelDS->show(new HotelDataStoreRequest(
            id: $request['id'],
            filters: $request['filters'],
            sort: $request['sort'],
            start_date: $request['start_date'],
            end_date: $request['end_date']
        )));
    }

}
