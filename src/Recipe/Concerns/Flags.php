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
        'active' => [
            'type' => 'boolean',
            'default' => true,
            'index' => true,
            'icon' => 'fa-solid fa-person-running',
        ],
        'canceled' => [
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-ban text-warning',
        ],
        'closed' => [
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-xmark',
        ],
        'completed' => [
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-check',
        ],
        'cron' => [
            'type' => 'boolean',
            'default' => false,
            'index' => true,
            'icon' => 'fa-regular fa-clock',
        ],
        'duplicate' => [
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-clone',
        ],
        'fixed' => [
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-wrench',
        ],
        'flagged' => [
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-flag',
        ],
        'internal' => [
            'type' => 'boolean',
            'readOnly' => false,
            'default' => false,
            'icon' => 'fa-solid fa-server',
        ],
        'locked' => [
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-lock text-warning',
        ],
        'pending' => [
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-circle-pause text-warning',
        ],
        'planned' => [
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-circle-pause text-success',
        ],
        'prioritized' => [
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-triangle-exclamation text-success',
        ],
        'problem' => [
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-triangle-exclamation text-danger',
        ],
        'published' => [
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-book',
        ],
        'released' => [
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-dove',
        ],
        'retired' => [
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-chair text-success',
        ],
        'resolved' => [
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-check-double text-success',
        ],
        'suspended' => [
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-hand text-danger',
        ],
        'unknown' => [
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
        return $this->flags;
    }
}
