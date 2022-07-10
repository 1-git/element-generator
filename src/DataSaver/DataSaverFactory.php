<?php

declare(strict_types=1);

namespace ElementGenerator\DataSaver;

/**
 * Class DataSaverFactory
 * @package ElementGenerator\DataSaver
 */
class DataSaverFactory
{
    public const TYPE_FILE = 'file';

    /**
     * @var string[]
     */
    protected static $map = [
        self::TYPE_FILE => FileDataSaver::class,
    ];

    /**
     * @param string $type
     * @param string $outputFile
     * @return DataSaverInterface
     */
    public static function getSaver(string $type, string $outputFile): DataSaverInterface
    {
        return new self::$map[$type]($outputFile);
    }
}
