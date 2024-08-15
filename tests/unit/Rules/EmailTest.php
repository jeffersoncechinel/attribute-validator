<?php

namespace Tests\Unit\Rules;

use Exception;
use Tests\Unit\Templates\Person;
use Tests\Unit\Templates\PersonFactory;
use JC\Validator\Validator;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testShouldPassIfEmailIsValid()
    {
        $person = self::buildPerson();

        $validator = new Validator(
            errorType: Validator::ERROR_TYPE_AGGREGATABLE
        );

        $obj = $validator->validate($person);
        $this->assertFalse($obj->hasErrors());
    }

    /**
     * @throws Exception
     */
    public function testShouldNotPassIfEmailIsInvalid()
    {
        $person = self::buildPerson();
        $person->email = 'john@smith';

        $validator = new Validator(
            errorType: Validator::ERROR_TYPE_AGGREGATABLE
        );

        $obj = $validator->validate($person);
        $this->assertTrue($obj->hasErrors());
    }

    public static function buildPerson(): Person
    {
       return PersonFactory::build();
    }
}
