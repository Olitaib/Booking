<?php

namespace App\Http\Controllers;

use App\Service\HotelService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HotelController extends Controller
{

    public function __construct(private HotelService $hotelService)
    {

    }

    public function index(Request $request)
    {
        $hotelsData = [
            'filters' => $request['filters'],
            'sort' => $request['sort'] ?? 'title_asc'
        ];

        return $this->hotelService->index($hotelsData);
    }

    public function show(Request $request): View
    {
        $hotelsData = [
            'id' => $request['id'],
            'filters' => $request['filters'],
            'sort' => $request['sort'] ?? 'title_asc',
            'start_date' => $request['start_date'] ?? Carbon::now()->format('Y-m-d'),
            'end_date' => $request['end_date'] ?? Carbon::now()->addDay()->format('Y-m-d')
        ];

        return $this->hotelService->show($hotelsData);
    }

}
