<?php

namespace unit\Rules;

use Exception;
use JC\Validator\Validator;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Templates\Person;
use Tests\Unit\Templates\PersonFactory;

class UUIDTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testShouldPassIfUuidIsValid()
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
    public function testShouldNotPassIfUuidIsInvalid()
    {
        $person = self::buildPerson();
        $person->uuidv4 = '123e4567-e89b-12d3-a456-42661417400P';

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
