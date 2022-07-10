<?php

declare(strict_types=1);

namespace ElementGenerator\InputLoader;

/**
 * Class InputLoaderFactory
 * @package ElementGenerator\InputLoader
 */
class InputLoaderFactory
{
    public const TYPE_CSV = 'csv';

    /**
     * @var string[]
     */
    protected static $map = [
        self::TYPE_CSV => CsvInputLoader::class,
    ];

    /**
     * @param string $type
     * @param string $inputFile
     * @return InputLoaderInterface
     */
    public static function getLoader(string $type, string $inputFile): InputLoaderInterface
    {
        return new self::$map[$type]($inputFile);
    }
}
