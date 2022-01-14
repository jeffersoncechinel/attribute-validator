<?php

declare(strict_types=1);

namespace JC\Validator\Exceptions;

use Exception;
use Throwable;

class ValidationException extends Exception
{
    public function __construct(
        $message = 'Inválid argument',
        $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

    public static function create(array $errors): self
    {
        return new self(json_encode($errors, JSON_UNESCAPED_UNICODE));
    }

    public function toArray(): array
    {
        return json_decode($this->getMessage(), true);
    }
}
