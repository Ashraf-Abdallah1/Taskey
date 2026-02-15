<?php

namespace Framework;

use Exception;

class ConfigManager
{
    /** @var array<string> */
    public array $defaultsConfig = [
        'APP_DEBUG' => 'true',
    ];

    /** @var array<string> */
    public array $config;

    /**
     * construct
     * @param array<string> $config
     */
    public function __construct(array $config)
    {
        $this->config = array_merge($this->defaultsConfig, $config);
    }

    /**
     * @throws Exception
     */
    public function get(string $key): string
    {
        if (!isset($this->config[$key])) {
            throw new Exception("Config key '{$key}' not found");
        }
        return $this->config[$key];
    }

    /**
     * @throws Exception
     */
    public function isProduction(): bool
    {
        return $this->get('APP_ENV') === 'production';
    }
}
