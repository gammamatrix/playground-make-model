<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Model\Recipe\Concerns;

/**
 * \Playground\Make\Model\Recipe\Concerns\Flags
 */
trait Flags
{
    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $flags = [
        'active' => [ // $withLifecycle
            'type' => 'boolean',
            'default' => true,
            'index' => true,
            'icon' => 'fa-solid fa-person-running',
        ],
        'canceled' => [ // $withLifecycle
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-ban text-warning',
        ],
        'closed' => [ // $withLifecycle
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-xmark',
        ],
        'completed' => [ // $withLifecycle
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-check',
        ],
        'cron' => [ // $withLifecycle
            'type' => 'boolean',
            'default' => false,
            'index' => true,
            'icon' => 'fa-regular fa-clock',
        ],
        'duplicate' => [ // $withLifecycle
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-clone',
        ],
        'fixed' => [ // $withLifecycle
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-wrench text-success',
        ],
        'flagged' => [ // $withLifecycle
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-flag',
        ],
        'internal' => [ // $withLifecycle
            'type' => 'boolean',
            'readOnly' => false,
            'default' => false,
            'icon' => 'fa-solid fa-server',
        ],
        'locked' => [ // $withPermissions
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-lock text-warning',
        ],
        'pending' => [ // $withLifecycle
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-circle-pause text-warning',
        ],
        'planned' => [ // $withPlanning
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-circle-pause text-success',
        ],
        'prioritized' => [ // $withPlanning
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-triangle-exclamation text-success',
        ],
        'problem' => [ // $withLifecycle
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-triangle-exclamation text-danger',
        ],
        'published' => [ // $withPublishing
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-book',
        ],
        'released' => [ // $withPublishing
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-dove',
        ],
        'retired' => [ // $withLifecycle
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-chair text-success',
        ],
        'resolved' => [ // $withLifecycle
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-check-double text-success',
        ],
        'suspended' => [ // $withLifecycle
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-hand text-danger',
        ],
        'unknown' => [ // $withLifecycle
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-question text-warning',
        ],
    ];

    /**
     * @return array<string, array<string, mixed>>
     */
    public function flags(): array
    {
        ksort($this->flags);

        return $this->flags;
    }
}
