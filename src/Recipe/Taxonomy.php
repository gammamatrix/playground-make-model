<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Model\Recipe;

use Illuminate\Support\Str;

/**
 * \Playground\Make\Model\Recipe\Taxonomy
 */
class Taxonomy extends Playground
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
        'resolved_at' => [
            'nullable' => true,
            'index' => true,
        ],
        'resumed_at' => [
            'nullable' => true,
            'index' => false,
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
    protected array $factoryStates = [
        'locked' => [
            'type' => 'flag',
            // 'flag' => 'locked',
            'value' => true,
        ],
        'featured' => [
            'type' => 'flag',
            'value' => true,
        ],
        'special' => [
            'type' => 'flag',
            'value' => true,
        ],
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $json = [
        'address' => [
            'default' => null,
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
        'assets' => [
            'default' => null,
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
        'meta' => [
            'default' => null,
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
            'default' => null,
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
        'sources' => [
            'default' => null,
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $ids = [];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $ids_all = [
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
        'life_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'taxonomy_lives',
            ],
        ],
        'domain_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'taxonomy_domains',
            ],
        ],
        'kingdom_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'taxonomy_kingdoms',
            ],
        ],
        'taxonomy_class_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'taxonomy_classes',
            ],
        ],
        'taxonomy_order_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'taxonomy_orders',
            ],
        ],
        'family_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'taxonomy_families',
            ],
        ],
        'genus_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'taxonomy_genuses',
            ],
        ],
        'species_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'taxonomy_species',
            ],
        ],
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $hasOne = [];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $hasOne_all = [
        'life' => [
            'comment' => 'The life of the %1$s.',
            'accessor' => 'life',
            'related' => 'Life',
            'foreignKey' => 'id',
            'localKey' => 'life_id',
        ],
        'domain' => [
            'comment' => 'The domain of the %1$s.',
            'accessor' => 'domain',
            'related' => 'Domain',
            'foreignKey' => 'id',
            'localKey' => 'domain_id',
        ],
        'kingdom' => [
            'comment' => 'The kingdom of the %1$s.',
            'accessor' => 'kingdom',
            'related' => 'Kingdom',
            'foreignKey' => 'id',
            'localKey' => 'kingdom_id',
        ],
        'taxonomyClass' => [
            'comment' => 'The class of the %1$s.',
            'accessor' => 'class',
            'related' => 'Class',
            'foreignKey' => 'id',
            'localKey' => 'class_id',
        ],
        'taxonomyOrder' => [
            'comment' => 'The order of the %1$s.',
            'accessor' => 'order',
            'related' => 'Order',
            'foreignKey' => 'id',
            'localKey' => 'order_id',
        ],
        'family' => [
            'comment' => 'The family of the %1$s.',
            'accessor' => 'family',
            'related' => 'Family',
            'foreignKey' => 'id',
            'localKey' => 'family_id',
        ],
        'genus' => [
            'comment' => 'The genus of the %1$s.',
            'accessor' => 'genus',
            'related' => 'Genus',
            'foreignKey' => 'id',
            'localKey' => 'genus_id',
        ],
        'species' => [
            'comment' => 'The species of the %1$s.',
            'accessor' => 'species',
            'related' => 'Species',
            'foreignKey' => 'id',
            'localKey' => 'species_id',
        ],
    ];

    public function init(): void
    {
        $name_lower = Str::of($this->name())->kebab()->replace('-', ' ')->lower()->toString();
        // $has_many_accessor = Str::of($this->name())->plural()->camel()->toString();
        $has_one_accessor = Str::of($this->name())->camel()->toString();
        $table_id = Str::of($has_one_accessor)->finish('_id')->toString();

        $this->hasOne = $this->hasOne_all;
        unset($this->hasOne[$has_one_accessor]);
        $this->ids = $this->ids_all;
        unset($this->ids[$table_id]);

        // dd([
        //     '__METHOD__' => __METHOD__,
        //     '$this' => $this,
        //     '$this->name()' => $this->name(),
        //     '$model_id' => $model_id,
        //     '$this->ids' => $this->ids,
        // ]);
        $this->flags['featured'] = [
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-star text-warning',
        ];
        $this->flags['special'] = [
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-star text-success',
        ];

        foreach ($this->hasOne as $accessor => $meta) {
            if (! empty($meta['comment']) && is_string($meta['comment'])) {
                $this->hasOne[$accessor]['comment'] = sprintf(
                    $meta['comment'],
                    $name_lower
                );
            }
        }

        ksort($this->dates);
        ksort($this->flags);

        // dd([
        //     '__METHOD__' => __METHOD__,
        //     '$this' => $this,
        // ]);
    }
}
