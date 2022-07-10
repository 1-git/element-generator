<?php

declare(strict_types=1);

namespace ElementGenerator\InputLoader;

use Generator;
use ElementGenerator\Generator\Transfers\ElementNode;

/**
 * Interface InputLoaderInterface
 * @package ElementGenerator\InputLoader
 */
interface InputLoaderInterface
{
    /**
     * @return Generator|ElementNode[]
     */
    public function getElementNodes(): Generator;
}
