<?php

declare(strict_types=1);

namespace Codin\Config\Loaders;

use Codin\Config\ConfigAccessInterface;

class ChainedLoader implements ConfigAccessInterface
{
    /**
     * @var array<ConfigAccessInterface>
     */
    protected $loaders;

    public function __construct(array $loaders)
    {
        $this->loaders = $loaders;
    }

    /**
     * {@inherit}
     */
    public function has(string $key): bool
    {
        $reduce = static function (bool $carry, ConfigAccessInterface $loader) use ($key) {
            return $loader->has($key) ? true : $carry;
        };
        return \array_reduce($this->loaders, $reduce, false);
    }

    /**
     * {@inherit}
     */
    public function get(string $key, $default = null)
    {
        $reduce = static function ($carry, ConfigAccessInterface $loader) use ($key) {
            return $loader->has($key) ? $loader->get($key) : $carry;
        };
        return \array_reduce($this->loaders, $reduce, $default);
    }
}
