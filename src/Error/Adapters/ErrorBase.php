<?php

namespace JC\Validator\Error\Adapters;

use Exception;
use JC\Validator\RuleResult;
use JC\Validator\Validator;

abstract class ErrorBase implements ErrorInterface
{
    private array $config;

    public function init(array $config): void
    {
        $this->config = $config;
    }

    /**
     * @throws Exception
     */
    protected function getValidator(): Validator
    {
        if (!isset($this->config['validator'])) {
            throw new Exception('Missing validator instance');
        }

        $validator = $this->config['validator'];

        if (!$validator instanceof Validator) {
            throw new Exception('Validator is not an instance of ' . Validator::class);
        }

        return $validator;
    }

    /**
     * @throws Exception
     */
    protected function getRuleResult(): RuleResult
    {
        if (!isset($this->config['ruleResult'])) {
            throw new Exception('Missing RuleResult instance');
        }

        $ruleResult = $this->config['ruleResult'];

        if (!$ruleResult instanceof RuleResult) {
            throw new Exception('RuleResult is not an instance of ' . RuleResult::class);
        }

        return $ruleResult;
    }
}
