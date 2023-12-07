<?php

namespace App\Service;

use App\Mail\BookingCanceled;
use App\Mail\BookingCompleted;
use App\Models\Booking;
use App\Models\Room;
use App\Validator\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class BookingService
{

    public function __construct(private Validator $validator)
    {

    }

    public function index(): View
    {
        $bookings = Booking::whereBelongsTo(auth()->user())->get();

        return view('bookings.index', ['bookings' => $bookings]);
    }

    public function show(array $bookingsData): View
    {
        if ($this->validator->booking($bookingsData)) {
            return view('errors.validation-errors', ['errors' => $this->validator->errors]);
        }

        $booking = Booking::find($bookingsData['id']);

        return view('bookings.show', ['booking' => $booking]);
    }

    public function store(array $bookingsData): View
    {
        if ($this->validator->booking($bookingsData)) {
            return view('errors.validation-errors', ['errors' => $this->validator->errors]);
        }

        $booking = Booking::create([
            'user_id' => auth()->id(),
            'room_id' => $bookingsData['room_id'],
            'started_at' => $bookingsData['started_at'],
            'finished_at' => $bookingsData['finished_at'],
            'days' => $days = Carbon::createFromDate($bookingsData['finished_at'])->diffInDays($bookingsData['started_at']),
            'price' => $days * Room::find($bookingsData['room_id'])->price,
        ]);

        Mail::to(Auth::user()->email)->send(new BookingCompleted($booking));

        return $this->index();
    }

    public function remove(array $bookingsData): View
    {
        if ($this->validator->booking($bookingsData)) {
            return view('errors.validation-errors', ['errors' => $this->validator->errors]);
        }

        $booking = Booking::find($bookingsData['id']);
        $booking->delete();

        Mail::to(Auth::user()->email)->send(new BookingCanceled($booking));

        return $this->index();
    }

}
