<?php

namespace JC\Validator\Rules;

use JC\Validator\RuleResult;

interface RuleInterface
{
    public function run(): RuleResult;
}
