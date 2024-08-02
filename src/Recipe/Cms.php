<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Recipe;

/**
 * \Playground\Make\Model\Recipe\Cms
 */
class Cms extends Playground
{
    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $dates = [
        'canceled_at' => [
            'nullable' => true,
            'index' => false,
        ],
        'closed_at' => [
            'nullable' => true,
            'index' => true,
        ],
        'embargo_at' => [
            'nullable' => true,
            'index' => false,
        ],
        'fixed_at' => [
            'nullable' => true,
            'index' => false,
        ],
        'planned_end_at' => [
            'nullable' => true,
            'index' => false,
        ],
        'planned_start_at' => [
            'nullable' => true,
            'index' => false,
        ],
        'postponed_at' => [
            'nullable' => true,
            'index' => false,
        ],
        'published_at' => [
            'nullable' => true,
            'index' => false,
        ],
        'released_at' => [
            'nullable' => true,
            'index' => false,
        ],
        'resumed_at' => [
            'nullable' => true,
            'index' => false,
        ],
        'resolved_at' => [
            'nullable' => true,
            'index' => true,
        ],
        'suspended_at' => [
            'nullable' => true,
            'index' => false,
        ],
        'timer_end_at' => [
            'nullable' => true,
            'index' => true,
        ],
        'timer_start_at' => [
            'nullable' => true,
            'index' => true,
        ],
    ];
}
