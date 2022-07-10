<?php

declare(strict_types=1);

namespace ElementGenerator\DataSaver;

/**
 * Class FileDataSaver
 * @package ElementGenerator\DataSaver
 */
class FileDataSaver implements DataSaverInterface
{
    /**
     * @var string
     */
    protected $outputFile;

    /**
     * @param string $outputFile
     */
    public function __construct(string $outputFile)
    {
        $this->outputFile = $outputFile;
    }

    /**
     * @inheritDoc
     */
    public function save(string $content): void
    {
        file_put_contents($this->outputFile, $content);
    }
}
