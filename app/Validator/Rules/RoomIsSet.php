<?php

namespace App\Validator\Rules;

use App\Models\Room;
use Respect\Validation\Rules\AbstractRule;

class RoomIsSet extends AbstractRule
{

    public function validate($input): bool
    {
        if (Room::where('id', $input)->first()) {
            return true;
        }

        return false;
    }

}
