<?php

namespace App;

use App\Traits\TSingleton;

class Config
{
    use TSingleton;

    private $configs = [];

    private function __construct()
    {
        foreach (scandir(CONFIG_DIR) as $file) {
            if (is_dir(CONFIG_DIR . DIRECTORY_SEPARATOR . $file)) {
                continue;
            }
            $this->configs[substr($file, 0, -4)] = require_once CONFIG_DIR . DIRECTORY_SEPARATOR . $file;
        }
    }

    public function get($config, $default = null)
    {
        return arrayGet($this->configs, $config, $default);
    }
}
