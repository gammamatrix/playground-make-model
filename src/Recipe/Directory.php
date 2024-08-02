<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Recipe;

/**
 * \Playground\Make\Model\Recipe\Directory
 */
class Directory extends Cms
{
    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $hasMany = [
        'sublocations' => [
            'comment' => 'The sublocations of the location.',
            'accessor' => 'sublocations',
            'related' => 'Sublocation',
            'foreignKey' => 'location_id',
            'localKey' => 'id',
        ],
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $hasOne = [
        'location' => [
            'comment' => 'The location of the sublocation',
            'accessor' => 'location',
            'related' => 'Location',
            'foreignKey' => 'id',
            'localKey' => 'location_id',
        ],
    ];

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
        'location_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'directory_locations',
            ],
        ],
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $json = [
        'address' => [
            'default' => '{}',
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
        'assets' => [
            'default' => '{}',
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
        'contact' => [
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
        'sources' => [
            'default' => '{}',
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
    ];

    public function init(): void
    {
        if (! in_array($this->name(), [
            'Sublocation',
        ])) {
            unset($this->ids['location_id']);
            unset($this->hasOne['location']);
        }

        if (! in_array($this->name(), [
            'Location',
        ])) {
            unset($this->hasMany['sublocations']);
        }
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function ids(): array
    {
        return $this->ids;
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function hasMany(): array
    {
        return $this->hasMany;
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function hasOne(): array
    {
        return $this->hasOne;
    }
}
