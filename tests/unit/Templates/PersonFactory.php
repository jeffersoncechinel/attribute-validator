<?php

namespace Tests\Unit\Templates;

class PersonFactory
{
    public static function build(): Person
    {
        $person = new Person();
        $person->firstname = "John";
        $person->lastname = 'Smith';
        $person->age = 15;
        $person->number = "12345";
        $person->email = "john@smith.com";
        $person->bornAt = "2020-01-01T00:00:00.000Z";
        $person->createdAt = "2020-01-01";
        $person->time = "23:30";
        $person->uuidv4 = "123e4567-e89b-12d3-a456-426614174000";
        $person->positiveNumber = 10;
        $person->negativeNumber = -10;

        return $person;
    }
}
