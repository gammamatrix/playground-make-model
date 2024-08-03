<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Recipe;

/**
 * \Playground\Make\Model\Recipe\Directory
 */
class Directory extends Playground
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
}
