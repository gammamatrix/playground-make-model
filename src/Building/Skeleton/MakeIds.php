<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Building\Skeleton;

use Illuminate\Support\Str;
use Playground\Make\Configuration\Model\Create;

/**
 * \Playground\Make\Model\Building\Skeleton\MakeIds
 */
trait MakeIds
{
    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $skeleton_ids_package = [
        // 'backlog_id' => [
        //     'type' => 'uuid',
        //     'nullable' => true,
        //     'index' => true,
        //     'foreign' => [
        //         'references' => 'id',
        //         'on' => 'matrix_backlogs',
        //     ],
        // ],
        // 'board_id' => [
        //     'type' => 'uuid',
        //     'nullable' => true,
        //     'index' => true,
        //     'foreign' => [
        //         'references' => 'id',
        //         'on' => 'matrix_boards',
        //     ],
        // ],
        // 'completed_by_id' => [
        //     'type' => 'uuid',
        //     'nullable' => true,
        //     'index' => true,
        //     'foreign' => [
        //         'references' => 'id',
        //         'on' => 'users',
        //     ],
        // ],
        // 'duplicate_id' => [
        //     'type' => 'uuid',
        //     'nullable' => true,
        //     'index' => true,
        //     'foreign' => [
        //         'references' => 'id',
        //         'on' => 'matrix_tickets',
        //     ],
        // ],
        // 'epic_id' => [
        //     'type' => 'uuid',
        //     'nullable' => true,
        //     'index' => true,
        //     'foreign' => [
        //         'references' => 'id',
        //         'on' => 'matrix_epics',
        //     ],
        // ],
        // 'fixed_by_id' => [
        //     'type' => 'uuid',
        //     'nullable' => true,
        //     'index' => true,
        //     'foreign' => [
        //         'references' => 'id',
        //         'on' => 'users',
        //     ],
        // ],
        // 'flow_id' => [
        //     'type' => 'uuid',
        //     'nullable' => true,
        //     'index' => true,
        //     'foreign' => [
        //         'references' => 'id',
        //         'on' => 'matrix_flows',
        //     ],
        // ],
        'matrix_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_matrices',
            ],
        ],
        // 'milestone_id' => [
        //     'type' => 'uuid',
        //     'nullable' => true,
        //     'index' => true,
        //     'foreign' => [
        //         'references' => 'id',
        //         'on' => 'matrix_milestones',
        //     ],
        // ],
        // 'note_id' => [
        //     'type' => 'uuid',
        //     'nullable' => true,
        //     'index' => true,
        //     'foreign' => [
        //         'references' => 'id',
        //         'on' => 'matrix_notes',
        //     ],
        // ],
        // 'project_id' => [
        //     'type' => 'uuid',
        //     'nullable' => true,
        //     'index' => true,
        //     'foreign' => [
        //         'references' => 'id',
        //         'on' => 'matrix_projects',
        //     ],
        // ],
        // 'release_id' => [
        //     'type' => 'uuid',
        //     'nullable' => true,
        //     'index' => true,
        //     'foreign' => [
        //         'references' => 'id',
        //         'on' => 'matrix_releases',
        //     ],
        // ],
        // 'reported_by_id' => [
        //     'type' => 'uuid',
        //     'nullable' => true,
        //     'index' => true,
        //     'foreign' => [
        //         'references' => 'id',
        //         'on' => 'users',
        //     ],
        // ],
        // 'roadmap_id' => [
        //     'type' => 'uuid',
        //     'nullable' => true,
        //     'index' => true,
        //     'foreign' => [
        //         'references' => 'id',
        //         'on' => 'matrix_roadmaps',
        //     ],
        // ],
        // 'source_id' => [
        //     'type' => 'uuid',
        //     'nullable' => true,
        //     'index' => true,
        //     'foreign' => [
        //         'references' => 'id',
        //         'on' => 'matrix_sources',
        //     ],
        // ],
        // 'sprint_id' => [
        //     'type' => 'uuid',
        //     'nullable' => true,
        //     'index' => true,
        //     'foreign' => [
        //         'references' => 'id',
        //         'on' => 'matrix_sprints',
        //     ],
        // ],
        // 'tag_id' => [
        //     'type' => 'uuid',
        //     'nullable' => true,
        //     'index' => true,
        //     'foreign' => [
        //         'references' => 'id',
        //         'on' => 'matrix_tags',
        //     ],
        // ],
        // 'team_id' => [
        //     'type' => 'uuid',
        //     'nullable' => true,
        //     'index' => true,
        //     'foreign' => [
        //         'references' => 'id',
        //         'on' => 'matrix_teams',
        //     ],
        // ],
        // 'ticket_id' => [
        //     'type' => 'uuid',
        //     'nullable' => true,
        //     'index' => true,
        //     'foreign' => [
        //         'references' => 'id',
        //         'on' => 'matrix_tickets',
        //     ],
        // ],
        // 'version_fixed_id' => [
        //     'type' => 'uuid',
        //     'nullable' => true,
        //     'index' => true,
        //     'foreign' => [
        //         'references' => 'id',
        //         'on' => 'matrix_versions',
        //     ],
        // ],
        // 'version_id' => [
        //     'type' => 'uuid',
        //     'nullable' => true,
        //     'index' => true,
        //     'foreign' => [
        //         'references' => 'id',
        //         'on' => 'matrix_versions',
        //     ],
        // ],
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $skeleton_ids = [
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $filters_ids = [];

    protected function buildClass_skeleton_ids(Create $create): void
    {
        $this->buildClass_skeleton_ids_primary($create);
        $this->buildClass_skeleton_ids_type($create);
        $this->buildClass_skeleton_ids_users($create);
        $this->buildClass_skeleton_ids_model($create);
        $this->buildClass_skeleton_ids_package($create);

        $this->c->addFilter([
            'ids' => array_values($this->filters_ids),
        ], true);
    }

    protected function buildClass_skeleton_ids_primary(Create $create): void
    {
        // dd([
        //     '__METHOD__' => __METHOD__,
        //     '__CLASS__' => __CLASS__,
        //     'static::class' => static::class,
        //     '$this' => $this,
        // ]);
        $primary = $create->primary() ?: $this->recipe->primary();

        if ($primary) {
            $create->setOptions([
                'primary' => $primary,
            ]);

            $label = 'ID';
            $column = 'id';
            $type = in_array($primary, ['increments']) ? 'integer' : 'string';

            $this->c->addSortable([
                'label' => $label,
                'type' => $type,
                'column' => $column,
            ]);

            $this->filters_ids[$column] = [
                'label' => $label,
                'column' => $column,
                'type' => $type,
                'nullable' => true,
            ];
        }

        // dump([
        //     '__METHOD__' => __METHOD__,
        //     '$this->c->filters' => $this->c->filters(),
        //     // '$this->c' => $this->c->toArray(),
        //     '$primary' => $primary,
        //     // '$this->recipe->primary()' => $this->recipe->primary(),
        //     // '$create->primary()' => $create->primary(),
        // ]);
    }

    protected function buildClass_skeleton_ids_users(Create $create): void
    {
        $ids = $create->ids();

        $this->components->info(sprintf('Skeleton ids for [%s]', $this->c->name()));

        // dump([
        //     '__METHOD__' => __METHOD__,
        //     '$ids' => $ids,
        // ]);

        foreach ($this->recipe->userIds() as $column => $meta) {

            $label = ! empty($meta['label'])
                ? empty($meta['label'])
                : Str::of($column)->replace('_', ' ')->ucfirst()->toString();
            // dump([
            //     '__METHOD__' => __METHOD__,
            //     '$column' => $column,
            //     '$label' => $label,
            // ]);

            $type = '';
            if (! empty($meta['type']) && is_string($meta['type'])) {
                $type = $meta['type'];
            }

            $default = null;
            if (array_key_exists('default', $meta)) {
                $default = $meta['default'];
            }

            $this->c->addAttribute($column, $default);

            // TODO Should we add a custom scalar type?
            // $type = 'scalar';
            // @see $primitiveCastTypes in vendor/laravel/framework/src/Illuminate/Database/Eloquent/Concerns/HasAttributes.php

            if (! in_array($type, [
                'uuid',
            ])) {
                $this->c->addCast($column, $type);
            }

            if (empty($meta['readOnly'])) {
                $this->c->addFillable($column);
            }

            if (! in_array($column, $this->analyze_filters['ids'])) {
                $this->filters_ids[$column] = [
                    'label' => $label,
                    'column' => $column,
                    'type' => $type,
                    'nullable' => true,
                ];
            }

            if (! in_array($column, $this->analyze['sortable'])) {
                $this->c->addSortable([
                    'label' => $label,
                    'type' => $type,
                    'column' => $column,
                ]);
            }

            $meta['label'] = $label;

            $create->addId($column, $meta);
            // dump([
            //     '__METHOD__' => __METHOD__,
            //     '$column' => $column,
            //     '$this->c->filters()' => $this->c->filters(),
            //     // '$this->c' => $this->c->toArray(),
            // ]);

            // dd([
            //     '__METHOD__' => __METHOD__,
            //     '$column' => $column,
            //     '$this->c->filters()' => $this->c->filters(),
            //     // '$this->c' => $this->c->toArray(),
            // ]);

            // $foreign = ! empty($meta['foreign']) && is_array($meta['foreign']) ? $meta['foreign'] : [];

            // if ($this->no_user_hasOne || empty($foreign)) {
            //     continue;
            // }

            // $accessor = Str::of($column)->before('_id')->studly()->lcfirst()->toString();

            // $related = Str::of($column)->before('_id')->studly()->toString();

            // $foreignKey = $foreign['references'] ?? 'id';

            // $addOne = [
            //     // 'comment' => '',
            //     // 'accessor' => '',
            //     'related' => $related,
            //     'foreignKey' => $foreignKey,
            //     'localKey' => $column,
            // ];

            // $this->c->addHasOne($accessor, $addOne);
        }
    }

    // protected bool $no_user_hasOne = true;

    protected function buildClass_skeleton_ids_type(Create $create): void
    {
        if (! in_array($this->c->type(), [
            'playground-model',
        ])) {
            return;
        }

        $this->components->info(sprintf('Skeleton model type for [%s]', $this->c->name()));

        if ($this->c->revision()) {
            $column = Str::of($this->c->name())->before('Revision')->snake()->finish('_type')->toString();
            $label = Str::of($this->c->model_singular())->before('Revision')->finish(' Type')->toString();
        } else {
            $column = Str::of($this->c->name())->snake()->finish('_type')->toString();
            $label = Str::of($this->c->model_singular())->finish(' Type')->toString();
        }

        $meta = [
            'type' => 'string',
            'column' => $column,
            'label' => $label,
            'nullable' => true,
            'index' => true,
        ];
        // dump([
        //     '__METHOD__' => __METHOD__,
        //     '$column' => $column,
        //     '$label' => $label,
        //     '$meta' => $meta,
        // ]);

        $create->addId($column, $meta);

        $this->c->addAttribute($column, null);
        $this->c->addCast($column, 'string');
        $this->c->addFillable($column);

        if (! in_array($column, $this->analyze_filters['ids'])) {
            $this->filters_ids[$column] = [
                'column' => $column,
                'label' => $label,
                'type' => 'string',
                'nullable' => true,
            ];
        }

        if (! in_array($column, $this->analyze['sortable'])) {
            $this->c->addSortable([
                'type' => 'string',
                'column' => $column,
                'label' => $label,
            ]);
        }
    }

    protected function buildClass_skeleton_ids_model(Create $create): void
    {
        $ids = $create->ids();

        $this->components->info(sprintf('Skeleton ids for [%s]', $this->c->name()));

        // dump([
        //     '__METHOD__' => __METHOD__,
        //     '$ids' => $ids,
        // ]);

        foreach ($this->recipe->ids() as $column => $meta) {

            $label = Str::of($column)->replace('_', ' ')->ucfirst()->toString();
            // dump([
            //     '__METHOD__' => __METHOD__,
            //     '$column' => $column,
            //     '$label' => $label,
            // ]);

            $type = '';
            if (! empty($meta['type']) && is_string($meta['type'])) {
                $type = $meta['type'];
            }

            $default = null;
            if (array_key_exists('default', $meta)) {
                $default = $meta['default'];
            }

            $this->c->addAttribute($column, $default);

            if (! in_array($type, [
                'uuid',
            ])) {
                $this->c->addCast($column, $type);
            }

            if (empty($meta['readOnly'])) {
                $this->c->addFillable($column);
            }

            if (! in_array($column, $this->analyze_filters['ids'])) {
                $this->filters_ids[$column] = [
                    'label' => $label,
                    'column' => $column,
                    'type' => $type,
                    'nullable' => true,
                ];
            }

            if (! in_array($column, $this->analyze['sortable'])) {
                $this->c->addSortable([
                    'label' => $label,
                    'type' => $type,
                    'column' => $column,
                ]);
            }

            $meta['label'] = $label;

            $create->addId($column, $meta);
        }
    }

    protected bool $buildClass_skeleton_ids_package_allow_self = false;

    protected function buildClass_skeleton_ids_package(Create $create): void
    {
        $ids = $create->ids();

        $this->components->info(sprintf('Skeleton ids for [%s]', $this->c->name()));

        // dump([
        //     '__METHOD__' => __METHOD__,
        //     '$ids' => $ids,
        // ]);

        foreach ($this->skeleton_ids_package as $column => $meta) {

            $label = Str::of($column)->replace('_', ' ')->ucfirst()->toString();
            // dump([
            //     '__METHOD__' => __METHOD__,
            //     '$column' => $column,
            //     '$label' => $label,
            // ]);

            $type = '';
            if (! empty($meta['type']) && is_string($meta['type'])) {
                $type = $meta['type'];
            }

            $default = null;
            if (array_key_exists('default', $meta)) {
                $default = $meta['default'];
            }

            $this->c->addAttribute($column, $default);

            if (! in_array($type, [
                'uuid',
            ])) {
                $this->c->addCast($column, $type);
            }

            if (empty($meta['readOnly'])) {
                $this->c->addFillable($column);
            }

            if (! in_array($column, $this->analyze_filters['ids'])) {
                $this->filters_ids[$column] = [
                    'label' => $label,
                    'column' => $column,
                    'type' => $type,
                    'nullable' => true,
                ];
            }

            if (! in_array($column, $this->analyze['sortable'])) {
                $this->c->addSortable([
                    'label' => $label,
                    'type' => $type,
                    'column' => $column,
                ]);
            }

            $meta['label'] = $label;

            $create->addId($column, $meta);
        }
    }
}
