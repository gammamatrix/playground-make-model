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
        'canceled_at' => [ // $withLifecycle
            'nullable' => true,
            'index' => false,
        ],
        'closed_at' => [ // $withLifecycle
            'nullable' => true,
            'index' => true,
        ],
        'embargo_at' => [ // $withPublishing
            'nullable' => true,
            'index' => false,
        ],
        'planned_end_at' => [ // $withPlanning
            'nullable' => true,
            'index' => false,
        ],
        'planned_start_at' => [ // $withPlanning
            'nullable' => true,
            'index' => false,
        ],
        'postponed_at' => [ // $withPlanning
            'nullable' => true,
            'index' => false,
        ],
        'published_at' => [ // $withPublishing
            'nullable' => true,
            'index' => false,
        ],
        'released_at' => [ // $withLifecycle
            'nullable' => true,
            'index' => true,
        ],
        'resolved_at' => [ // $withLifecycle
            'nullable' => true,
            'index' => true,
        ],
        'resumed_at' => [ // $withLifecycle
            'nullable' => true,
            'index' => false,
        ],
        'suspended_at' => [ // $withLifecycle
            'nullable' => true,
            'index' => false,
        ],
        'timer_end_at' => [ // $withPlanning
            'nullable' => true,
            'index' => true,
        ],
        'timer_start_at' => [ // $withPlanning
            'nullable' => true,
            'index' => true,
        ],
    ];

    /**
     * @return array<string, array<string, mixed>>
     */
    public function dates(): array
    {
        ksort($this->json);

        return $this->dates;
    }
}
