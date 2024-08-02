<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Recipe\Concerns;

/**
 * \Playground\Make\Model\Recipe\Concerns\Permissions
 */
trait Permissions
{
    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $permissions = [
        'gids' => [
            'type' => 'bigInteger',
            'default' => 0,
            'unsigned' => true,
            'icon' => 'fa-solid fa-people-group',
        ],
        'po' => [
            'type' => 'tinyInteger',
            'default' => 0,
            'unsigned' => true,
            'icon' => 'fa-solid fa-house-user',
        ],
        'pg' => [
            'type' => 'tinyInteger',
            'default' => 0,
            'unsigned' => true,
            'icon' => 'fa-solid fa-people-roof',
        ],
        'pw' => [
            'type' => 'tinyInteger',
            'default' => 0,
            'unsigned' => true,
            'icon' => 'fa-solid fa-globe',
        ],
        'only_admin' => [
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-user-gear',
        ],
        'only_user' => [
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-user',
        ],
        'only_guest' => [
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-person-rays',
        ],
        'allow_public' => [
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-users-line',
        ],
    ];

    /**
     * @return array<string, array<string, mixed>>
     */
    public function permissions(): array
    {
        return $this->permissions;
    }
}
