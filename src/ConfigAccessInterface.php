<?php

declare(strict_types=1);

namespace Codin\Config;

interface ConfigAccessInterface
{
    /**
     * Key exists in config file
     */
    public function has(string $key): bool;

    /**
     * Find key from config file
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get(string $key, $default = null);
}
