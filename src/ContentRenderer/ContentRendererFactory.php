<?php

declare(strict_types=1);

namespace ElementGenerator\ContentRenderer;

/**
 * Class ContentRendererFactory
 * @package ElementGenerator\ContentRenderer
 */
class ContentRendererFactory
{
    public const TYPE_JSON = 'json';

    /**
     * @var string[]
     */
    protected static $map = [
        self::TYPE_JSON => JsonContentRenderer::class,
    ];

    /**
     * @param string $type
     * @param string $outputFile
     * @return ContentRendererInterface
     */
    public static function getRenderer(string $type, string $outputFile): ContentRendererInterface
    {
        return new self::$map[$type]($outputFile);
    }
}
