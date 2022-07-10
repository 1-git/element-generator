<?php

declare(strict_types=1);

namespace ElementGenerator\Generator;

use ElementGenerator\Generator\Transfers\ElementNode;
use Generator;

/**
 * Interface TreeBuilderInterface
 * @package ElementGenerator\Generator
 */
interface TreeBuilderInterface
{
    /**
     * @param Generator|ElementNode[] $elementNodes
     * @return ElementNode[]
     */
    public function build(Generator $elementNodes): array;
}
