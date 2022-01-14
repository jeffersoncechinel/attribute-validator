<?php

namespace JC\Validator\Rules;

use Attribute;
use JC\Validator\RuleResult;

#[Attribute]
final class Email implements RuleInterface
{
    const errorMessage = 'Invalid email address.';

    public function __construct(
        public string|null $propertyName = null,
        public string|null $label = null,
        public string|null $errorMessage = null,
        public string|null $value = null,
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
        return filter_var($this->value, FILTER_VALIDATE_EMAIL);
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
