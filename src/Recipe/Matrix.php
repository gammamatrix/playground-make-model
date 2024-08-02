<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Recipe;

/**
 * \Playground\Make\Model\Recipe\Matrix
 */
class Matrix extends Playground
{
    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $json = [
        'assets' => [
            'default' => '{}',
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
        'backlog' => [
            'default' => '{}',
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
        'board' => [
            'default' => '{}',
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
        'flow' => [
            'default' => '{}',
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
        'history' => [
            'default' => '{}',
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
        'meta' => [
            'default' => '{}',
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
        'notes' => [
            'default' => '[]',
            'readOnly' => true,
            'nullable' => true,
            'type' => 'JSON_ARRAY',
            'comment' => 'Array of note objects',
        ],
        'options' => [
            'default' => '{}',
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
        'roadmap' => [
            'default' => '{}',
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
        'sources' => [
            'default' => '{}',
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
    ];
}
