<?php

namespace JC\Validator\Error\Adapters;

interface ErrorInterface
{
    public function init(array $config);
    public function run();
}
