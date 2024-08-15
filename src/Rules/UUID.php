<?php

namespace JC\Validator\Rules;

use Attribute;
use JC\Validator\RuleResult;

#[Attribute]
final class UUID implements RuleInterface
{
    const errorMessage = 'Invalid uuid format.';

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
        if (!$this->value) {
            return false;
        }
        
        $regex = '/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i';
        return preg_match($regex, $this->value) === 1;
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
