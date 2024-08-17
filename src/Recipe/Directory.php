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
        // 'revisions' => [
        //     // 'comment' => 'The revisions of the location.',
        //     // 'comment' => 'The revisions of the sublocation.',
        //     'comment' => 'The revisions of the model.',
        //     'accessor' => 'revisions',
        //     // 'related' => 'LocationRevision',
        //     // 'related' => 'SublocationRevision',
        //     'related' => '',
        //     // 'foreignKey' => 'location_id',
        //     // 'foreignKey' => 'sublocation_id',
        //     'foreignKey' => '',
        //     'localKey' => 'id',
        // ],
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $hasOne = [
        // 'location' => [
        //     'comment' => 'The location of the sublocation',
        //     'comment' => 'The location of the revision.',
        //     'accessor' => 'location',
        //     'related' => 'Location',
        //     'foreignKey' => 'id',
        //     'localKey' => 'location_id',
        // ],
        // 'sublocation' => [
        //     'comment' => 'The sublocation of the revision.',
        //     'accessor' => 'sublocation',
        //     'related' => 'Sublocation',
        //     'foreignKey' => 'id',
        //     'localKey' => 'sublocation_id',
        // ],
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
            // 'trait' => 'WithParent',
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

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $factoryStates = [
        'locked' => [
            'type' => 'flag',
            // 'flag' => 'locked',
            'value' => true,
        ],
        'published' => [
            'type' => 'flag',
            'value' => true,
        ],
    ];

    public function reset(): void
    {
        $this->flags['sitemap'] = [
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-sitemap text-success',
        ];

        $this->status['revision'] = [
            'type' => 'bigInteger',
            'default' => false,
            'unsigned' => true,
            'readOnly' => true,
            'icon' => '',
        ];

        $this->ids = [
            'parent_id' => [
                'type' => 'uuid',
                'nullable' => true,
                'index' => true,
                'foreign' => [
                    'references' => 'id',
                    'on' => null,
                ],
                // 'trait' => 'WithParent',
            ],
        ];

        $this->columns['email'] = [
            'type' => 'string',
            'nullable' => true,
        ];

        $this->columns['phone'] = [
            'type' => 'string',
            'nullable' => true,
        ];

        $this->hasMany = [];
        $this->hasOne = [];

        // unset($this->hasMany['sublocations']);
        // unset($this->hasMany['revisions']);

        // unset($this->ids['location_id']);
        // unset($this->hasOne['location']);

        // unset($this->ids['sublocation_id']);
        // unset($this->hasOne['sublocation']);

    }

    public function init(): void
    {
        $this->reset();

        if (in_array($this->name(), [
            'Location',
        ])) {
            $this->init_Location();
        } elseif (in_array($this->name(), [
            'LocationRevision',
        ])) {
            $this->init_LocationRevision();
        } elseif (in_array($this->name(), [
            'Sublocation',
        ])) {
            $this->init_Sublocation();
        } elseif (in_array($this->name(), [
            'SublocationRevision',
        ])) {
            $this->init_SublocationRevision();
        }
    }

    public function init_Location(): void
    {
        $this->ids['parent_id']['trait'] = 'WithParent';

        $this->hasMany['revisions'] = [
            'comment' => 'The revisions of the location.',
            'accessor' => 'revisions',
            'related' => 'LocationRevision',
            'foreignKey' => 'location_id',
            'localKey' => 'id',
        ];

        $this->hasMany['sublocations'] = [
            'comment' => 'The sublocations of the location.',
            'accessor' => 'sublocations',
            'related' => 'Sublocation',
            'foreignKey' => 'location_id',
            'localKey' => 'id',
        ];

    }

    public function init_LocationRevision(): void
    {
        $this->hasOne['location'] = [
            'comment' => 'The location of the revision.',
            'accessor' => 'location',
            'related' => 'Location',
            'foreignKey' => 'id',
            'localKey' => 'location_id',
        ];

        $this->ids['location_id'] = [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'directory_locations',
            ],
        ];
    }

    public function init_Sublocation(): void
    {
        $this->ids['parent_id']['trait'] = 'WithParent';

        $this->hasMany['revisions'] = [
            'comment' => 'The revisions of the sublocation.',
            'accessor' => 'revisions',
            'related' => 'SublocationRevision',
            'foreignKey' => 'sublocation_id',
            'localKey' => 'id',
        ];

        $this->hasOne['location'] = [
            'comment' => 'The location of the sublocation',
            'accessor' => 'location',
            'related' => 'Location',
            'foreignKey' => 'id',
            'localKey' => 'location_id',
        ];

        $this->ids['location_id'] = [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'directory_locations',
            ],
        ];
    }

    public function init_SublocationRevision(): void
    {
        $this->hasOne['sublocation'] = [
            'comment' => 'The sublocation of the revision.',
            'accessor' => 'sublocation',
            'related' => 'Sublocation',
            'foreignKey' => 'id',
            'localKey' => 'sublocation_id',
        ];

        $this->ids['sublocation_id'] = [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'directory_sublocations',
            ],
        ];

        $this->hasOne['location'] = [
            'comment' => 'The location of the sublocation revision',
            'accessor' => 'location',
            'related' => 'Location',
            'foreignKey' => 'id',
            'localKey' => 'location_id',
        ];

        $this->ids['location_id'] = [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'directory_locations',
            ],
        ];
    }
}
