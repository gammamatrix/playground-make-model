<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Recipe\Concerns;

/**
 * \Playground\Make\Model\Recipe\Concerns\Ids
 */
trait Ids
{
    protected string $primary = '';

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $ids = [
        'parent_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => null,
            ],
            'trait' => 'WithParent',
        ],
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $userIds = [
        'created_by_id' => [
            'type' => 'uuid',
            'readOnly' => true,
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'users',
            ],
            'trait' => 'WithCreator',
        ],
        'modified_by_id' => [
            'type' => 'uuid',
            'readOnly' => true,
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'users',
            ],
            'trait' => 'WithModifier',
        ],
        'owned_by_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'users',
            ],
            'trait' => 'WithOwner',
        ],
    ];

    /**
     * @return array<string, array<string, mixed>>
     */
    public function ids(): array
    {
        return $this->ids;
    }

    public function primary(): string
    {
        return $this->primary;
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function userIds(): array
    {
        return $this->userIds;
    }
}
