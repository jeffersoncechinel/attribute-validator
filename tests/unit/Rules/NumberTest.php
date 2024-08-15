<?php

namespace Tests\Unit\Rules;

use Exception;
use Tests\Unit\Templates\Person;
use Tests\Unit\Templates\PersonFactory;
use JC\Validator\Validator;
use PHPUnit\Framework\TestCase;

class NumberTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testShouldPassIfValueIsANumber()
    {
        $person = self::buildPerson();
        $person->number = 1000;

        $validator = new Validator(
            errorType: Validator::ERROR_TYPE_AGGREGATABLE
        );

        $obj = $validator->validate($person);
        $this->assertFalse($obj->hasErrors());
    }

    /**
     * @throws Exception
     */
    public function testShouldNotPassIfValueIsNotANumber()
    {
        $person = self::buildPerson();
        $person->number = 'johnsmith';

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

    /**
     * @throws Exception
     */
    public function testShouldPassIfAPositiveNumberWasUsed()
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
    public function testShouldNotPassIfANegativeNumberWasUsed()
    {
        $person = self::buildPerson();
        $person->positiveNumber = -1000;

        $validator = new Validator(
            errorType: Validator::ERROR_TYPE_AGGREGATABLE
        );

        $obj = $validator->validate($person);
        $this->assertTrue($obj->hasErrors());
    }

    /**
     * @throws Exception
     */
    public function testShouldPassIfANegativeNumberWasUsed()
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
    public function testShouldNotPassIfNegativeNumberWasNotUsed()
    {
        $person = self::buildPerson();
        $person->negativeNumber = 100;

        $validator = new Validator(
            errorType: Validator::ERROR_TYPE_AGGREGATABLE
        );

        $obj = $validator->validate($person);
        $this->assertTrue($obj->hasErrors());
    }


}
