<?php

namespace JC\Validator\Error\Adapters;

use JC\Validator\Exceptions\ValidationException;

class EventableAdapter extends ErrorBase
{
    /**
     * @throws ValidationException
     */
    public function run()
    {
       throw new ValidationException('Adapter not implemented');
    }
}
