<?php

namespace App\Validator;

use Respect\Validation\Factory;
use Respect\Validation\Validator as V;
use Respect\Validation\Exceptions\NestedValidationException;

class Validator
{

    public array $errors;

    public function __construct()
    {
        Factory::setDefaultInstance(
            (new Factory())
                ->withRuleNamespace('App\Validator\Rules')
                ->withExceptionNamespace('App\Validator\Exceptions')
        );
    }

    public function hotel(array $hotelsData): bool
    {
        $validation = v::key('sort', v::stringType())
            ->key('filters',
                v::optional(v::call('array_values', v::each(v::intVal()->facilityIsSet()))
                    ->call('array_keys', v::each(v::intType())))
            )
            ->key('start_date', v::date('Y-m-d'), false)
            ->key('end_date', v::date('Y-m-d'), false);
        try {
            $validation->assert($hotelsData);
        } catch (NestedValidationException $exception) {
            $this->errors = $exception->getMessages();
            return true;
        }

        return false;
    }

    public function booking(array $bookingsData): bool
    {
        $validation = v::key('id', v::intVal()->bookingIsSet(), false)
            ->key('room_id', v::intVal()->roomIsSet(), false)
            ->key('start_date', v::date('Y-m-d'), false)
            ->key('end_date', v::date('Y-m-d'), false);
        try {
            $validation->assert($bookingsData);
        } catch (NestedValidationException $exception) {
            $this->errors = $exception->getMessages();
            return true;
        }

        return false;
    }

}
