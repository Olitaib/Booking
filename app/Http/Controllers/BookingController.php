<?php

namespace App\Http\Controllers;

use App\Service\BookingService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookingController extends Controller
{

    public function __construct(private BookingService $bookingService)
    {

    }

    public function index(): View
    {
        return $this->bookingService->index();
    }

    public function show(Request $request): View
    {
        $bookingsData = [
            'id' => $request['id']
        ];

        return $this->bookingService->show($bookingsData);
    }

    public function store(Request $request): View
    {
        $bookingsData = [
            'user_id' => auth()->id(),
            'room_id' => $request['room_id'],
            'started_at' => $request['started_at'],
            'finished_at' => $request['finished_at'],
        ];

        return $this->bookingService->store($bookingsData);
    }

    public function remove(Request $request): View
    {
        $bookingsData = [
            'id' => $request['booking_id']
        ];

        return $this->bookingService->remove($bookingsData);
    }

}
