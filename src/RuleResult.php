<?php

namespace JC\Validator;

class RuleResult
{
    public function __construct(
        private bool $success,
        private string|null $errorMessage,
        private string|null $propertyName,
    ) {
    }

    /**
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getPropertyName(): ?string
    {
        return $this->propertyName;
    }
}
