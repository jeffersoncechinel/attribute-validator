<?php

namespace JC\Validator\Rules;

use Attribute;
use JC\Validator\RuleResult;

#[Attribute]
final class Length implements RuleInterface
{
    const errorMessage = 'Value length cannot be lower than {min} or higher than {max} characters.';

    public function __construct(
        public int|null $min,
        public int|null $max,
        public string|null $label = null,
        public string|null $errorMessage = null,
        public string|null $value = null,
        public string|null $propertyName = null,
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
        if (mb_strlen($this->value) < $this->min) {
            return false;
        }

        if (mb_strlen($this->value) > $this->max) {
            return false;
        }

        return true;
    }

    private function formattedMessage(): string|null
    {
        if ($this->errorMessage) {
            $message = $this->errorMessage;
        } else {
            $message = self::errorMessage;
        }

        return strtr($message, [
            '{label}' => $this->label,
            '{min}' => $this->min,
            '{max}' => $this->max,
        ]);
    }
}
