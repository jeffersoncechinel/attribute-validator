<?php

namespace Tests\Unit\Rules;

use Exception;
use Tests\Unit\Templates\Person;
use Tests\Unit\Templates\PersonFactory;
use JC\Validator\Validator;
use PHPUnit\Framework\TestCase;

class NotNullTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testShouldPassIfValueIsNotNull()
    {
        $person = self::buildPerson();
        $person->firstname = 'John';

        $validator = new Validator(
            errorType: Validator::ERROR_TYPE_AGGREGATABLE
        );

        $obj = $validator->validate($person);
        $this->assertFalse($obj->hasErrors());
    }

    /**
     * @throws Exception
     */
    public function testShouldPassIfValueIsInteger()
    {
        $person = self::buildPerson();
        $person->firstname = 1000;

        $validator = new Validator(
            errorType: Validator::ERROR_TYPE_AGGREGATABLE
        );

        $obj = $validator->validate($person);

        $this->assertFalse($obj->hasErrors());
    }

    /**
     * @throws Exception
     */
    public function testShouldNotPassIfValueIsNull()
    {
        $person = self::buildPerson();
        $person->firstname = null;

        $validator = new Validator(
            errorType: Validator::ERROR_TYPE_AGGREGATABLE
        );

        $obj = $validator->validate($person);

        $this->assertTrue($obj->hasErrors());
    }

    /**
     * @throws Exception
     */
    public function testShouldNotPassIfValueIsNotSet()
    {
        $person = new Person();
        $person->lastname = 'Smith';

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
