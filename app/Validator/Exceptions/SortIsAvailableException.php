<?php

namespace App\Validator\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

final class SortIsAvailableException extends ValidationException
{

    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Can not sort by this. ',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => 'Invalid value. ',
        ],
    ];

}
