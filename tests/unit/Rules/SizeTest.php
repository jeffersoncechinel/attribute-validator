<?php

namespace Tests\Unit\Rules;

use Exception;
use Tests\Unit\Templates\Person;
use Tests\Unit\Templates\PersonFactory;
use JC\Validator\Validator;
use PHPUnit\Framework\TestCase;

class SizeTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testShouldPassIfValueIsEqualMin()
    {
        $person = self::buildPerson();
        $person->age = 10;

        $validator = new Validator(
            errorType: Validator::ERROR_TYPE_AGGREGATABLE
        );

        $obj = $validator->validate($person);
        $this->assertEquals(false, $obj->hasErrors());
    }

    /**
     * @throws Exception
     */
    public function testShouldPassIfValueIsEqualMax()
    {
        $person = self::buildPerson();
        $person->age = 20;

        $validator = new Validator(
            errorType: Validator::ERROR_TYPE_AGGREGATABLE
        );

        $obj = $validator->validate($person);
        $this->assertEquals(false, $obj->hasErrors());
    }

    /**
     * @throws Exception
     */
    public function testShouldNotPassIfValueIsLessThanMin()
    {
        $person = self::buildPerson();
        $person->age = 9;

        $validator = new Validator(
            errorType: Validator::ERROR_TYPE_AGGREGATABLE
        );

        $obj = $validator->validate($person);
        $this->assertEquals(true, $obj->hasErrors());
    }

    /**
     * @throws Exception
     */
    public function testShouldNotPassIfValueIsHigherThanMax()
    {
        $person = self::buildPerson();
        $person->age = 21;

        $validator = new Validator(
            errorType: Validator::ERROR_TYPE_AGGREGATABLE
        );

        $obj = $validator->validate($person);
        $this->assertEquals(true, $obj->hasErrors());
    }

    /**
     * @throws Exception
     */
    public function testShouldPassIfValueIsAStringNumber()
    {
        $person = self::buildPerson();
        $person->age = "20";

        $validator = new Validator(
            errorType: Validator::ERROR_TYPE_AGGREGATABLE
        );

        $obj = $validator->validate($person);
        $this->assertEquals(false, $obj->hasErrors());
    }

    public static function buildPerson(): Person
    {
       return PersonFactory::build();
    }
}
