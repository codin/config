<?php

declare(strict_types=1);

namespace Codin\Config\Loaders;

use Codin\Config\ConfigAccessInterface;
use Codin\Config\ConfigException;

abstract class AbstractFileLoader implements ConfigAccessInterface
{
    /**
     * @var string|null
     */
    protected $path;

    /**
     * @var string
     */
    protected $extension;

    public function __construct(string $path)
    {
        $this->path = \realpath($path) ?: null;

        if (null === $this->path) {
            throw new ConfigException(sprintf('config loader path not found "%s"', $path));
        }
    }

    /**
     * Get the path of a config file
     */
    protected function filepath(string $name): ?string
    {
        $filepath = $this->path . '/' . $name . $this->extension;

        if (!\is_file($filepath)) {
            return null;
        }

        return $filepath;
    }

    /**
     * Load file contents
     */
    abstract protected function load(string $file): ?array;

    /**
     * Split key into parts, the first part will always be the file name
     */
    protected function parts(string $name): array
    {
        if (\strlen($name) === 0) {
            throw new ConfigException(
                'Parameter name cannot be empty'
            );
        }

        $keys = \explode('.', $name);

        if (empty($keys)) {
            throw new ConfigException(
                'Failed to extract keys from parameter name'
            );
        }

        $file = \array_shift($keys);

        if (!$file) {
            throw new ConfigException(
                'Failed to shift first key from keys'
            );
        }

        return [$file, $keys];
    }

    /**
     * {@inherit}
     */
    public function has(string $key): bool
    {
        [$file, $keys] = $this->parts($key);

        $config = $this->load($file);

        if (null === $config) {
            return false;
        }

        foreach ($keys as $key) {
            if (!\array_key_exists($key, $config)) {
                return false;
            }
            $config = $config[$key];
        }

        return true;
    }

    /**
     * {@inherit}
     */
    public function get(string $key, $default = null)
    {
        [$file, $keys] = $this->parts($key);

        $config = $this->load($file);

        if (null === $config) {
            return $default;
        }

        foreach ($keys as $key) {
            if (!\array_key_exists($key, $config)) {
                return $default;
            }
            $config = $config[$key];
        }

        return $config;
    }
}
