<?php

namespace JC\Validator\Rules;

use Attribute;
use JC\Validator\RuleResult;

#[Attribute]
final class Datetime implements RuleInterface
{
    const errorMessage = 'Invalid datetime.';

    public function __construct(
        public string|null $propertyName = null,
        public string|null $label = null,
        public string|null $errorMessage = null,
        public string|null $value = null,
        public string $format = 'Y-m-d H:i:s',
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
        if ($this->value === null) {
            return true;
        }
        
        $dateTime = \DateTime::createFromFormat($this->format, $this->value);
        
        if (!$dateTime) {
            return false;
        }
        
        return $dateTime->format($this->format) === $this->value;
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
