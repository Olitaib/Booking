<?php

namespace App\Validator\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

final class FacilityIsSetException extends ValidationException
{

    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Facility is not found. ',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => 'Facility can not be found. ',
        ],
    ];

}
