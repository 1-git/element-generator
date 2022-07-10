<?php

declare(strict_types=1);

namespace ElementGenerator\InputLoader;

use Generator;
use ElementGenerator\Generator\Transfers\ElementNode;

/**
 * Class CsvInputLoader
 * @package ElementGenerator\InputLoader
 */
class CsvInputLoader implements InputLoaderInterface
{
    /**
     * @var string
     */
    protected $inputFile;

    /**
     * @param string $inputFile
     */
    public function __construct(string $inputFile)
    {
        $this->inputFile = $inputFile;
    }

    /**
     * @inheritDoc
     */
    public function getElementNodes(): Generator
    {
        if (($handle = fopen($this->inputFile, "r")) !== false) {
            $isTitle = true;
            while (($data = fgetcsv($handle, 1000, ";")) !== false) {
                if ($isTitle === true) {
                    $isTitle = false;
                    continue;
                }
                yield new ElementNode($data);
            }
            fclose($handle);
        }
    }
}
