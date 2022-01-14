<?php

namespace JC\Validator\Error\Adapters;

use Exception;
use JC\Validator\Exceptions\ValidationException;

class ThrowableAdapter extends ErrorBase
{
    /**
     * @return void
     * @throws Exception
     */
    public function run(): void
    {
        throw ValidationException::create([
            'property' => $this->getRuleResult()->getPropertyName(),
            'message' => $this->getRuleResult()->getErrorMessage(),
        ]);
    }
}
