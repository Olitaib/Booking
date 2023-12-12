<?php

namespace App\Validator\Exceptions;

use Respect\Validation\Exceptions\ValidationException;


final class RoomExistException extends ValidationException
{

    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Room is not found. ',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => 'Room can not be found. ',
        ],
    ];

}
