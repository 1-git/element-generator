<?php

declare(strict_types=1);

namespace ElementGenerator\Generator;

use ElementGenerator\ContentRenderer\ContentRendererInterface;
use ElementGenerator\DataSaver\DataSaverInterface;
use ElementGenerator\Generator\Transfers\ElementNode;
use ElementGenerator\InputLoader\InputLoaderInterface;
use Generator;

/**
 * Class ElementsGenerator
 * @package ElementGenerator\Generator
 */
class ElementsGenerator implements ElementsGeneratorInterface
{
    /**
     * @var InputLoaderInterface
     */
    protected $inputLoader;

    /**
     * @var TreeBuilderInterface
     */
    protected $treeBuilder;

    /**
     * @var ContentRendererInterface
     */
    protected $contentRenderer;

    /**
     * @var DataSaverInterface
     */
    protected $dataSaver;

    /**
     * ElementsGenerator constructor.
     * @param InputLoaderInterface $inputLoader
     * @param TreeBuilderInterface $treeBuilder
     * @param ContentRendererInterface $contentRenderer
     * @param DataSaverInterface $dataSaver
     */
    public function __construct(
        InputLoaderInterface $inputLoader,
        TreeBuilderInterface $treeBuilder,
        ContentRendererInterface $contentRenderer,
        DataSaverInterface $dataSaver
    )
    {
        $this->inputLoader = $inputLoader;
        $this->treeBuilder = $treeBuilder;
        $this->contentRenderer = $contentRenderer;
        $this->dataSaver = $dataSaver;
    }

    /**
     * @inheritDoc
     */
    public function generate(): void
    {
        $elementNodes = $this->getElementNodes();
        $rootElements = $this->buildTree($elementNodes);
        $content = $this->getContent($rootElements);
        $this->saveContent($content);
    }

    /**
     * @return Generator|ElementNode[]
     */
    protected function getElementNodes(): Generator
    {
        return $this->inputLoader->getElementNodes();
    }

    /**
     * @param Generator|ElementNode[] $elementNodes
     * @return ElementNode[]
     */
    protected function buildTree(Generator $elementNodes): array
    {
        return $this->treeBuilder->build($elementNodes);
    }

    /**
     * @param ElementNode[] $rootElements
     * @return string
     */
    protected function getContent(array $rootElements): string
    {
        return $this->contentRenderer->prepareContent($rootElements);
    }

    /**
     * @param string $content
     */
    protected function saveContent(string $content): void
    {
        $this->dataSaver->save($content);
    }
}
