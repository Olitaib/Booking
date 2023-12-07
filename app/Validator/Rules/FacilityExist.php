<?php

namespace App\Validator\Rules;

use App\Models\Facility;
use Respect\Validation\Rules\AbstractRule;

class FacilityExist extends AbstractRule
{

    public function validate($input): bool
    {
        if (Facility::where('id', $input)->first()) {
            return true;
        }

        return false;
    }

}
