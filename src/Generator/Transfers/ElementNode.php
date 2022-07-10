<?php

declare(strict_types=1);

namespace ElementGenerator\Generator\Transfers;

/**
 * Class ElementNode
 * @package ElementGenerator\Generator\Structure
 */
class ElementNode
{
    /**
     * @var string
     */
    protected $itemName;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string|null
     */
    protected $parent;

    /**
     * @var string|null
     */
    protected $relation;

    /**
     * @var array
     */
    protected $children = [];

    /**
     * Node constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->itemName = $data[0];
        $this->type = $data[1];
        $this->parent = $data[2] ?: null;
        $this->relation = $data[3] ?: null;
    }

    /**
     * @return string
     */
    public function getItemName(): string
    {
        return $this->itemName;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string|null
     */
    public function getParent(): ?string
    {
        return $this->parent;
    }

    /**
     * @return string|null
     */
    public function getRelation(): ?string
    {
        return $this->relation;
    }

    /**
     * @param ElementNode[] $elementNodes
     * @return $this
     */
    public function setChildren(array $elementNodes): self
    {
        $this->children = $elementNodes;
        return $this;
    }

    /**
     * @return ElementNode[]
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * @param ElementNode $elementNode
     * @return $this
     */
    public function addChild(ElementNode $elementNode): self
    {
        $this->children[] = $elementNode;
        return $this;
    }
}
