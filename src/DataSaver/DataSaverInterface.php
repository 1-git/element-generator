<?php

declare(strict_types=1);

namespace ElementGenerator\DataSaver;

/**
 * Interface DataSaverInterface
 * @package ElementGenerator\DataSaver
 */
interface DataSaverInterface
{
    /**
     * @param string $content
     */
    public function save(string $content): void;
}
