<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Recipe\Concerns;

/**
 * \Playground\Make\Model\Recipe\Concerns\Columns
 */
trait Columns
{
    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $columns = [
        'label' => [
            'type' => 'string',
            'default' => '',
            'size' => 128,
        ],
        'title' => [
            'type' => 'string',
            'default' => '',
            'size' => 255,
        ],
        'byline' => [
            'type' => 'string',
            'default' => '',
            'size' => 255,
        ],
        'slug' => [
            'type' => 'string',
            'default' => null,
            'size' => 128,
            'index' => true,
            'nullable' => true,
            'slug' => true,
        ],
        'url' => [
            'type' => 'string',
            'default' => '',
            'size' => 512,
        ],
        'description' => [
            'type' => 'string',
            'default' => '',
            'size' => 512,
        ],
        'introduction' => [
            'type' => 'string',
            'default' => '',
            'size' => 512,
        ],
        'content' => [
            'type' => 'mediumText',
            'nullable' => true,
            'html' => true,
        ],
        'summary' => [
            'type' => 'mediumText',
            'nullable' => true,
            'html' => true,
        ],
    ];

    /**
     * @return array<string, array<string, mixed>>
     */
    public function columns(): array
    {
        return $this->columns;
    }
}
