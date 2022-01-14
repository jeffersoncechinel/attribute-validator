<?php

namespace JC\Validator\Error;

use Exception;

class Error
{
    /**
     * @param string $name
     * @param array $config
     * @return mixed
     * @throws Exception
     */
    public static function create(string $name, array $config = []): mixed
    {
        $name = ucfirst($name);

        if (!file_exists(self::adaptersPath() . '/' . $name . 'Adapter.php')) {
            throw new Exception("Requested adapter '$name' does not exist.");
        }

        $class = 'JC\\Validator\\Error\\Adapters\\' . $name . 'Adapter';
        $instance = new $class();
        $instance->init($config);

        return $instance;
    }

    public static function exists($name): bool
    {
        $name = ucfirst($name);
        return file_exists(self::adaptersPath() . '/' . $name . 'Adapter.php');
    }

    protected static function adaptersPath(): string
    {
        return dirname(__FILE__) . '/adapters';
    }
}
