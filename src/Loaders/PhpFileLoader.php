<?php

declare(strict_types=1);

namespace Codin\Config\Loaders;

class PhpFileLoader extends AbstractFileLoader
{
    /**
     * @var string
     */
    protected $extension = '.php';

    /**
     * {@inherit}
     */
    protected function load(string $file): ?array
    {
        $path = $this->filepath($file);

        if (null === $path) {
            return null;
        }

        return require $path;
    }
}
