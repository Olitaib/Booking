<?php

namespace App\Validator\Rules;

use App\Models\Booking;
use Respect\Validation\Rules\AbstractRule;

class BookingIsSet extends AbstractRule
{

    public function validate($input): bool
    {
        if (Booking::where('id', $input)->first()) {
            return true;
        }

        return false;
    }

}
