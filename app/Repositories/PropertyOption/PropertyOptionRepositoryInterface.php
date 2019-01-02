<?php namespace App\Repositories\PropertyOption;


interface PropertyOptionRepositoryInterface
{
    public function CommCareAndPropertyIs($commCareId, $propertyId);
}