<?php

declare(strict_types=1);

namespace Codin\Config\Loaders;

use Codin\Config\ConfigException;

class JsonFileLoader extends AbstractFileLoader
{
    /**
     * @var string
     */
    protected $extension = '.json';

    /**
     * {@inherit}
     */
    protected function load(string $file): ?array
    {
        $path = $this->filepath($file);

        if (null === $path) {
            return null;
        }

        $jsonStr = \file_get_contents($path);

        if (false === $jsonStr) {
            throw new ConfigException(
                'Failed to read file: '.$path
            );
        }

        $data = \json_decode($jsonStr, true);

        if (null === $data) {
            throw new ConfigException(
                'json_decode error in '.$path.': ' . \json_last_error_msg()
            );
        }

        return $data;
    }
}
