<?php

declare(strict_types=1);

namespace ElementGenerator\ContentRenderer;

use ElementGenerator\Generator\Transfers\ElementNode;

/**
 * Interface ContentRendererInterface
 * @package ElementGenerator\ContentRenderer
 */
interface ContentRendererInterface
{
    /**
     * @param ElementNode[] $elementNodes
     * @return string
     */
    public function prepareContent(array $elementNodes): string;
}
