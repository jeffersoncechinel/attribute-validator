<?php

namespace JC\Validator;

use Exception;
use JC\Validator\Error\Adapters\ErrorInterface;
use JC\Validator\Error\Error;
use ReflectionAttribute;
use ReflectionObject;

class Validator
{
    /**
     * Throws exceptions on validation errors.
     */
    const ERROR_TYPE_THROWABLE = 'throwable';

    /**
     * Stores all failure messages to be retrivied
     * at the end of the execution.
     * ps: notification pattern.
     */
    const ERROR_TYPE_AGGREGATABLE = 'aggregatable';

    /**
     * Dispatch an event.
     */
    const ERROR_TYPE_EVENT = 'eventable';

    public array $errors = [];

    public function __construct(
        public string $errorType = self::ERROR_TYPE_AGGREGATABLE,

    ) {
        $this->init();
    }

    private function init()
    {
    }

    /**
     * @throws Exception
     */
    public function validate(object $object): static
    {
        $reflectedObj = new ReflectionObject($object);

        foreach ($reflectedObj->getProperties() as $property) {
            foreach ($property->getAttributes() as $attribute) {

                if (!$attribute instanceof ReflectionAttribute) {
                    continue;
                }

                // get rule class name
                $class = $attribute->getName();

                // get the filled property value from client obj
                $propertyValue = [
                    'propertyName' => $property->getName(),
                    'value' => $object->{$property->getName()},
                ];

                // instantiate rule with attribute params + client obj property value
                $params = array_merge($propertyValue, $attribute->getArguments());

                //todo verify if class really is what it says it is before instantiate

                $ruleInstance = new ($class)(...$params);

                // run validation process
                /** @var RuleResult $result */
                $result = $ruleInstance->run();

                // process the validation response
                $this->processResult($result);
            }
        }

        return $this;
    }

    /**
     * @throws Exception
     */
    private function processResult(RuleResult $ruleResult): void
    {
        if (!$ruleResult->isSuccess()) {
            /** @var ErrorInterface $adapter */
            $adapter = Error::create($this->errorType, [
                'validator' => $this,
                'ruleResult' => $ruleResult,
            ]);

            $adapter->run($ruleResult->getErrorMessage());
        }
    }

    public function addError($field, $message)
    {
        $this->errors[$field][] = $message;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }
}
