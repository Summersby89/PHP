<?php

namespace App;

final class Config
{
    /** @var array $configs */
    public $configs;

    protected static $instance;

    private function __construct()
    {
        $this->configs = require_once 'src/configs/db.php';
    }

    public static function getInstance(): Config
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function get(string $config, $default = null)
    {
        return arrayGet($this->configs, $config, $default);
    }
}
