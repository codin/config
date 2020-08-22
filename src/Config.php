<?php

declare(strict_types=1);

namespace Codin\Config;

class Config implements ConfigAccessInterface
{
    /**
     * @var ConfigAccessInterface
     */
    protected $loader;

    final public function __construct(ConfigAccessInterface $loader)
    {
        $this->loader = $loader;
    }

    public static function create(string $path): ConfigAccessInterface
    {
        return new static(new Loaders\ChainedLoader([
            new Loaders\JsonFileLoader($path),
            new Loaders\PhpFileLoader($path),
        ]));
    }

    public function has(string $key): bool
    {
        return $this->loader->has($key);
    }

    public function get(string $key, $default = null)
    {
        return $this->loader->get($key, $default);
    }
}
