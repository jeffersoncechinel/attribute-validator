<?php

namespace JC\Validator\Rules;

use Attribute;
use JC\Validator\RuleResult;

#[Attribute]
final class Size implements RuleInterface
{
    const errorMessage = 'Value cannot be less than {min} or higher than {max}.';

    public function __construct(
        public int|null $min,
        public int|null $max,
        public string|null $label = null,
        public string|null $errorMessage = null,
        public int|string|null $value = null,
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
        if ((int) $this->value < $this->min) {
            return false;
        }

        if ((int)$this->value > $this->max) {
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
