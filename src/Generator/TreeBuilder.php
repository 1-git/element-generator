<?php

declare(strict_types=1);

namespace ElementGenerator\Generator;

use ElementGenerator\Generator\Transfers\ElementNode;
use Generator;

/**
 * Class TreeBuilder
 * @package ElementGenerator\Generator
 */
class TreeBuilder implements TreeBuilderInterface
{
    /**
     * @inheritDoc
     */
    public function build(Generator $elementNodes): array
    {
        $elementNodesByName = $this->getElementsIndexedByName($elementNodes);
        $rootElements = $this->buildHierarchy($elementNodesByName);
        $this->addRelationElements($elementNodesByName);

        return $rootElements;
    }

    /**
     * @param Generator|ElementNode[] $elementNodes
     * @return array
     */
    protected function getElementsIndexedByName(Generator $elementNodes): array
    {
        $elementNodesByName = [];
        foreach ($elementNodes as $elementNode) {
            $elementNodesByName[$elementNode->getItemName()] = $elementNode;
        }

        return $elementNodesByName;
    }

    /**
     * @param ElementNode[] $elementNodes
     * @return ElementNode[]
     */
    protected function buildHierarchy(array $elementNodes): array
    {
        $roots = [];
        foreach ($elementNodes as $elementNode) {
            if ($elementNode->getParent()) {
                $elementNodes[$elementNode->getParent()]->addChild($elementNode);
            } else {
                $roots[$elementNode->getItemName()] = $elementNode;
            }
        }

        return array_values($roots);
    }

    /**
     * @param ElementNode[] $elementNodes
     * @return void
     */
    protected function addRelationElements(array $elementNodes): void
    {
        foreach ($elementNodes as $elementNode) {
            if ($elementNode->getRelation()) {
                $elementNode->setChildren($elementNodes[$elementNode->getRelation()]->getChildren());
            }
        }
    }
}
