<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Recipe\Concerns;

/**
 * \Playground\Make\Model\Recipe\Concerns\Dates
 */
trait Dates
{
    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $dates = [
        'start_at' => [
            'nullable' => true,
            'index' => true,
        ],
        'planned_start_at' => [
            'nullable' => true,
            'index' => false,
        ],
        'end_at' => [
            'nullable' => true,
            'index' => true,
        ],
        'planned_end_at' => [
            'nullable' => true,
            'index' => false,
        ],
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
    ];

    /**
     * @return array<string, array<string, mixed>>
     */
    public function dates(): array
    {
        return $this->dates;
    }
}
