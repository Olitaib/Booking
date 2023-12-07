<?php

namespace App\Validator\Rules;

use Respect\Validation\Rules\AbstractRule;

class SortIsAvailable extends AbstractRule
{

    private array $sort = [
        'title_asc',
        'title_desc',
        'price_asc',
        'price_desc',
        'type_asc',
        'type_desc',
        'minPrice_asc',
        'maxPrice_desc',
        null
    ];

    public function validate($input): bool
    {
        if (in_array($input, $this->sort)) {
            return true;
        }

        return false;
    }

}
