<?php

namespace Tests\Unit\Rules;

use Exception;
use Tests\Unit\Templates\Person;
use Tests\Unit\Templates\PersonFactory;
use JC\Validator\Validator;
use PHPUnit\Framework\TestCase;

class LengthTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testShouldPassIfLengthIsEqualMin()
    {
        $person = self::buildPerson();
        $person->lastname = 'sm';

        $validator = new Validator(
            errorType: Validator::ERROR_TYPE_AGGREGATABLE
        );

        $obj = $validator->validate($person);
        $this->assertEquals(false, $obj->hasErrors());
    }

    /**
     * @throws Exception
     */
    public function testShouldPassIfLengthIsEqualMax()
    {
        $person = self::buildPerson();
        $person->lastname = 'smith12345';

        $validator = new Validator(
            errorType: Validator::ERROR_TYPE_AGGREGATABLE
        );

        $obj = $validator->validate($person);
        $this->assertEquals(false, $obj->hasErrors());
    }

    /**
     * @throws Exception
     */
    public function testShouldPassIfLengthIsBetweenMinAndMax()
    {
        $person = self::buildPerson();
        $person->lastname = 'smith';

        $validator = new Validator(
            errorType: Validator::ERROR_TYPE_AGGREGATABLE
        );

        $obj = $validator->validate($person);
        $this->assertEquals(false, $obj->hasErrors());
    }

    /**
     * @throws Exception
     */
    public function testShouldNotPassIfLengthIsHigherThanMax()
    {
        $person = self::buildPerson();
        $person->lastname = "smith123451jahkajhdggdfgdfgdserwerw";

        $validator = new Validator(
            errorType: Validator::ERROR_TYPE_AGGREGATABLE
        );

        $obj = $validator->validate($person);
        $this->assertEquals(true, $obj->hasErrors());
    }

    /**
     * @throws Exception
     */
    public function testShouldNotPassIfLengthIsLowerThanMin()
    {
        $person = self::buildPerson();
        $person->lastname = "s";

        $validator = new Validator(
            errorType: Validator::ERROR_TYPE_AGGREGATABLE
        );

        $obj = $validator->validate($person);
        $this->assertEquals(true, $obj->hasErrors());
    }

    public static function buildPerson(): Person
    {
        return PersonFactory::build();
    }
}
