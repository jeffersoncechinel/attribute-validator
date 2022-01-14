<?php

namespace JC\Validator;

class Rules
{
    private static function classMap(): array
    {
        return [
            'JC\Validator\Rules\NotNull' => 'NotNull',
            'JC\Validator\Rules\Number' => 'Number',
            'JC\Validator\Rules\Email' => 'Email',
            'JC\Validator\Rules\Length' => 'Length',
            'JC\Validator\Rules\Range' => 'Range'
        ];
    }

    public static function canInstantiate($ruleClass): bool
    {
        $rules = self::classMap();
        
        if (isset($rules[$ruleClass])) {
            return true;
        }

        return false;
    }
}
