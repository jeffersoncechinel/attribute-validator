<?php

namespace JC\Validator\Rules;

use Attribute;
use JC\Validator\RuleResult;

#[Attribute]
final class Number implements RuleInterface
{
    const errorMessage = 'Invalid number.';

    public function __construct(
        public string|null $propertyName = null,
        public string|null $label = null,
        public string|null $errorMessage = null,
        public mixed $value = null,
        public string|null $positiveOnly = null,
        public string|null $negativeOnly = null,
    ) {
    }

    public function run(): RuleResult
    {
        $status = $this->validate();

        return new RuleResult(
            success: $status,
            errorMessage: $this->formattedMessage(),
            propertyName: $this->propertyName
        );
    }

    private function validate(): bool
    {
        if (!$this->negativeOnly && !$this->positiveOnly) {
            return is_numeric($this->value);
        }
        
        if ($this->negativeOnly) {
            $this->errorMessage = 'Invalid negative number.';
            return is_numeric($this->value) && $this->value < 0;
        }
        
        if ($this->positiveOnly) {
            $this->errorMessage = 'Invalid positive number.';
            return is_numeric($this->value) && $this->value > 0;
        }
        
        return is_numeric($this->value);
    }

    private function formattedMessage(): string|null
    {
        if ($this->errorMessage) {
            $message = $this->errorMessage;
        } else {
            $message = self::errorMessage;
        }

        return trim(strtr($message, ['{label}' => $this->label]));
    }
}
