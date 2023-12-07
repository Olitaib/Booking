<?php

namespace App\Validator\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

final class BookingIsSetException extends ValidationException
{

    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Booking is not found. ',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => 'Booking can not be found. ',
        ],
    ];

}
