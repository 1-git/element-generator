<?php

declare(strict_types=1);

namespace Application;

use ElementGenerator\Generator\Transfers\ElementNode;
use ElementGenerator\Generator\TreeBuilder;
use Generator;
use PHPUnit\Framework\TestCase;

/**
 * Class TreeBuilderTest
 * @package Application
 */
final class TreeBuilderTest extends TestCase
{
    public function testParentOneNode(): void
    {
        $nodes = [
            new ElementNode(['Total', 'Изделия и компоненты', '', '']),
        ];
        $rootElements = (new TreeBuilder())->build($this->getGenerator($nodes));

        $this->assertCount(1, $rootElements);
        $this->assertSame('Total', $rootElements[0]->getItemName());
        $this->assertCount(0, $rootElements[0]->getChildren());
    }

    public function testNodeWithParent(): void
    {
        $nodes = [
            new ElementNode(['Total', 'Изделия и компоненты', '', '']),
            new ElementNode(['ПВЛ соч', 'Изделия и компоненты', 'Total', '']),
        ];
        $rootElements = (new TreeBuilder())->build($this->getGenerator($nodes));

        $this->assertCount(1, $rootElements[0]->getChildren());
        $this->assertSame('ПВЛ соч', $rootElements[0]->getChildren()[0]->getItemName());
    }

    public function testNodeWithRelated(): void
    {
        $nodes = [
            new ElementNode(['Total', 'Изделия и компоненты', '', '']),
            new ElementNode(['ПВЛ соч', 'Тележка Б25.#205', 'Total', 'Тележка Б25']),
            new ElementNode(['Тележка Б25', 'Изделия и компоненты', 'Total', '']),
            new ElementNode(['Стандарт.#5', 'Прямые компоненты', 'Тележка Б25', '']),
        ];
        $rootElements = (new TreeBuilder())->build($this->getGenerator($nodes));

        $this->assertCount(2, $rootElements[0]->getChildren());
        $this->assertCount(1, $rootElements[0]->getChildren()[0]->getChildren());
        $this->assertSame('Стандарт.#5', $rootElements[0]->getChildren()[0]->getChildren()[0]->getItemName());
        $this->assertCount(1, $rootElements[0]->getChildren()[1]->getChildren());
        $this->assertSame('Стандарт.#5', $rootElements[0]->getChildren()[1]->getChildren()[0]->getItemName());
    }

    /**
     * @param ElementNode[] $nodes
     * @return Generator
     */
    protected function getGenerator(array $nodes): Generator
    {
        foreach ($nodes as $node) {
            yield $node;
        }
    }
}
