<?php

namespace unit\Rules;

use Exception;
use JC\Validator\Validator;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Templates\Person;
use Tests\Unit\Templates\PersonFactory;

class DatetimeTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testShouldPassIfBasicIso8601DatetimeIsValid()
    {
        $person = self::buildPerson();
        $person->bornAt = '2020-01-01T00:00:00.000Z';

        $validator = new Validator(
            errorType: Validator::ERROR_TYPE_AGGREGATABLE
        );

        $obj = $validator->validate($person);
        $this->assertFalse($obj->hasErrors());
    }

    /**
     * @throws Exception
     */
    public function testShouldNotPassIfBasicIso8601DatetimeIsInvalid()
    {
        $person = self::buildPerson();
        $person->bornAt = '1900-01-01';

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
