<?php

namespace JC\Validator\Error\Adapters;

use Exception;

class AggregatableAdapter extends ErrorBase
{
    /**
     * @return void
     * @throws Exception
     */
    public function run(): void
    {
        $property = $this->getRuleResult()->getPropertyName();
        $message = $this->getRuleResult()->getErrorMessage();

        $this->getValidator()->addError($property, $message);
    }
}
