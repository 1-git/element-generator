<?php

declare(strict_types=1);

namespace ElementGenerator\ContentRenderer;

use ElementGenerator\Generator\Transfers\ElementNode;

/**
 * Class JsonRenderer
 * @package ElementGenerator\ContentRenderer
 */
class JsonContentRenderer implements ContentRendererInterface
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
    public function prepareContent(array $elementNodes): string
    {
        $items = $this->renderNodes($elementNodes);

        return json_encode($items, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param ElementNode[] $elementNodes
     * @return array
     */
    protected function renderNodes(array $elementNodes): array
    {
        return array_map(function (ElementNode $element) {
            return [
                'itemName' => $element->getItemName(),
                'parent' => $element->getParent(),
                'children' => $this->renderNodes($element->getChildren()),
            ];
        }, $elementNodes);
    }
}
