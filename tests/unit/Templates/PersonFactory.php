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

        return $person;
    }
}
