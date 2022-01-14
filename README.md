# Attribute Validator
### Elegantly validates PHP class properties

Attribute Validator allows you to set declarative validation rules on top of PHP class properties.
It heavily relies on PHP >=8.x Reflection Api to extract the Attributes for validation.

It suits well for domain models(DDD) and DTO validations which tends to get fat and complicated over the time. To counterpart this scenario this library helps decoupling models and dtos from the validation process avoiding tons of 
manual validations in setter methods.

[![License: MIT](https://img.shields.io/badge/License-MIT-brightgreen.svg)](https://opensource.org/licenses/MIT)

Supported error types
---
- Aggregatable - Aggregates multiple error messages in one validation run.
- Throwable - Throws an exception as soon as a fail validation occurs. 

List of rules
----

- NotNull - Validate if value is not null.
- Length - Validates the range of a string value.
- Number - Validates if a value is numeric.
- Email - Validates if and email is valid.
- Range - Validates if value number is in range.
- ... more to come. Interested in contribute? :)

Requirements
----
- PHP >= 8.0

Installation
----

Use [composer](https://getcomposer.org/download/) package manager.

```bash
composer require jeffersoncechinel/attribute-validator:"dev-main"
```

Usage example
----

A simple example on validating a class properties.

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use JC\Validator\Rules\Email;
use JC\Validator\Rules\Length;
use JC\Validator\Rules\NotNull;
use JC\Validator\Rules\Number;
use JC\Validator\Rules\Size;
use JC\Validator\Validator;

class Example
{
    #[NotNull]
    public string|null $firstname = null;
    
    #[NotNull]
    #[Length(min: 0, max: 255)]
    public string|null $lastname = null;
    
    #[Email]
    public string|null $email = null;
    
    #[Size(min: 10, max: 20)]
    public string|int|float $age;
    
    #[Number(label: 'Price', errorMessage: '{label} is invalid.')]
    public mixed $price;
}

$example = new Example();
$example->firstname = null;
$example->lastname = "Smith";
$example->email = "john@invalidaemail";
$example->price = "$10.50";
$example->age = 5;

$validator = new Validator(
    errorType: 'aggregatable'
);

$result = $validator->validate($example);

if ($result->hasErrors()) {
    print_r($result->getErrors());
}

```
#### Results

```
Array
(
    [firstname] => Array
        (
            [0] => Value cannot be null.
        )

    [email] => Array
        (
            [0] => Invalid email address.
        )

    [age] => Array
        (
            [0] => Value cannot be less than 10 or higher than 20.
        )

    [price] => Array
        (
            [0] => Price is invalid.
        )

)

```



Contributing
----
Pull requests are welcome.

License
----
[MIT](LICENSE)
