<?php

namespace Tests\Unit\Templates;

use JC\Validator\Rules\Email;
use JC\Validator\Rules\Length;
use JC\Validator\Rules\NotNull;
use JC\Validator\Rules\Number;
use JC\Validator\Rules\Range;
use JC\Validator\Rules\Datetime;

class Person
{
    #[NotNull]
    public string|int|null $firstname = null;

    #[Length(min: 2, max: 20)]
    #[NotNull(label: 'Lastname', errorMessage: '{label} cannot be null.')]
    public ?string $lastname = null;

    #[Range(
        min: 10,
        max: 20,
        label: 'Age',
        errorMessage: '{label} cannot be lower than {min} or higher than {max}.'
    )]
    public int|string $age = 0;

    #[Email]
    public ?string $email = null;
    
    #[Number]
    public ?string $number = null;
    
    #[Datetime(format: 'Y-m-d\TH:i:s.v\Z')]
    public ?string $bornAt = null;

    #[Datetime(format: 'Y-m-d')]
    public ?string $createdAt = null;

    #[Datetime(format: 'H:i')]
    public ?string $time = null;
}
