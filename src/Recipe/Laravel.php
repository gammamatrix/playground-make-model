<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Recipe;

/**
 * \Playground\Make\Model\Recipe\Laravel
 */
class Laravel extends Model
{
    protected string $primary = 'increments';

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $columns = [
        'title' => [
            'type' => 'string',
            'default' => '',
            'size' => 255,
        ],
        'description' => [
            'type' => 'string',
            'default' => '',
            'size' => 512,
        ],
        'content' => [
            'type' => 'mediumText',
            'nullable' => true,
            'html' => true,
        ],
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $dates = [];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $flags = [
        'active' => [
            'type' => 'boolean',
            'default' => true,
            'index' => true,
            'icon' => 'fa-solid fa-person-running',
        ],
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $ids = [];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $json = [];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $userIds = [];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $matrix = [];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $permissions = [];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $status = [];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $ui = [];

    /**
     * @var array<string, array<int, string>>
     */
    protected array $unique = [];
}
