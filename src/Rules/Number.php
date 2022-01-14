<?php

namespace JC\Validator\Rules;

use Attribute;
use JC\Validator\RuleResult;

#[Attribute]
final class Number implements RuleInterface
{
    const errorMessage = 'Value cannot be null.';

    public function __construct(
        public string|null $propertyName = null,
        public string|null $label = null,
        public string|null $errorMessage = null,
        public mixed $value = null,
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
