<?php

declare(strict_types=1);

namespace Application;

use ElementGenerator\Generator\Transfers\ElementNode;
use PHPUnit\Framework\Error\Notice;
use PHPUnit\Framework\TestCase;

/**
 * Class TreeBuilderTest
 * @package Application
 */
final class ElementNodeTest extends TestCase
{
    public function testElementNodeFull(): void
    {
        $data = ['Item Name', 'Type', 'Parent', 'Relation'];
        $elementNode = new ElementNode($data);
        $this->assertSame($data[0], $elementNode->getItemName());
        $this->assertSame($data[1], $elementNode->getType());
        $this->assertSame($data[2], $elementNode->getParent());
        $this->assertSame($data[3], $elementNode->getRelation());
    }

    public function testElementNodeNotFull(): void
    {
        $data = ['Item Name', 'Type', '', ''];
        $elementNode = new ElementNode($data);
        $this->assertSame($data[0], $elementNode->getItemName());
        $this->assertSame($data[1], $elementNode->getType());
        $this->assertNull($elementNode->getParent());
        $this->assertNull($elementNode->getRelation());
    }

    public function testElementNodeInputNotFull(): void
    {
        $this->expectException(Notice::class);
        $data = ['Item Name', 'Type'];
        new ElementNode($data);
    }
}
