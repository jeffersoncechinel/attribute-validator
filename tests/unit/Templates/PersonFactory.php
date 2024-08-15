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
        //$person->bornAt = "2020-01-01T00:00:00.000Z";

        return $person;
    }
}
