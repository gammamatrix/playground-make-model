<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Recipe;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * \Playground\Make\Model\Recipe\Lead
 */
class Lead extends Playground
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
        'campaign_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'lead_campaigns',
            ],
        ],
        'goal_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'lead_goals',
            ],
        ],
        'lead_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'lead_leads',
            ],
        ],
        'opportunity_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'lead_opportunities',
            ],
        ],
        'plan_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'lead_plans',
            ],
        ],
        'region_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'lead_regions',
            ],
        ],
        'report_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'lead_reports',
            ],
        ],
        'source_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'lead_sources',
            ],
        ],
        'task_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'lead_tasks',
            ],
        ],
        'team_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'lead_teams',
            ],
        ],
        'teammate_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'lead_teammates',
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
        'campaign' => [
            'comment' => 'The campaign of the model.',
            'accessor' => 'campaign',
            'related' => 'Campaign',
            'foreignKey' => 'id',
            'localKey' => 'campaign_id',
        ],
        'goal' => [
            'comment' => 'The goal of the model.',
            'accessor' => 'goal',
            'related' => 'Goal',
            'foreignKey' => 'id',
            'localKey' => 'goal_id',
        ],
        'lead' => [
            'comment' => 'The lead of the model.',
            'accessor' => 'lead',
            'related' => 'Lead',
            'foreignKey' => 'id',
            'localKey' => 'lead_id',
        ],
        'opportunity' => [
            'comment' => 'The opportunity of the model.',
            'accessor' => 'opportunity',
            'related' => 'Opportunity',
            'foreignKey' => 'id',
            'localKey' => 'opportunity_id',
        ],
        'plan' => [
            'comment' => 'The plan of the model.',
            'accessor' => 'plan',
            'related' => 'Plan',
            'foreignKey' => 'id',
            'localKey' => 'plan_id',
        ],
        'region' => [
            'comment' => 'The region of the model.',
            'accessor' => 'region',
            'related' => 'Region',
            'foreignKey' => 'id',
            'localKey' => 'region_id',
        ],
        'report' => [
            'comment' => 'The report of the model.',
            'accessor' => 'report',
            'related' => 'Report',
            'foreignKey' => 'id',
            'localKey' => 'report_id',
        ],
        'source' => [
            'comment' => 'The source of the model.',
            'accessor' => 'source',
            'related' => 'Source',
            'foreignKey' => 'id',
            'localKey' => 'source_id',
        ],
        'task' => [
            'comment' => 'The task of the model.',
            'accessor' => 'task',
            'related' => 'Task',
            'foreignKey' => 'id',
            'localKey' => 'task_id',
        ],
        'team' => [
            'comment' => 'The team of the model.',
            'accessor' => 'team',
            'related' => 'Team',
            'foreignKey' => 'id',
            'localKey' => 'team_id',
        ],
        'teammate' => [
            'comment' => 'The teammate of the model.',
            'accessor' => 'teammate',
            'related' => 'Teammate',
            'foreignKey' => 'id',
            'localKey' => 'teammate_id',
        ],
    ];

    public function init(): void
    {
        $has_one_accessor = Str::of($this->name())->snake()->toString();
        $table_id = Str::of($has_one_accessor)->finish('_id')->toString();

        $this->hasOne = Arr::except($this->hasOne_all, $has_one_accessor);
        $this->ids = Arr::except($this->ids_all, $table_id);

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
        $this->flags['sms'] = [
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-comment-sms',
        ];
        $this->flags['special'] = [
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-star text-success',
        ];

        $this->columns['email'] = [
            'type' => 'string',
            'nullable' => true,
        ];

        $this->columns['phone'] = [
            'type' => 'string',
            'nullable' => true,
        ];

        $this->columns['team_role'] = [
            'type' => 'string',
            'nullable' => true,
        ];

        // Finances

        $this->columns['currency'] = [
            'type' => 'string',
            'nullable' => true,
        ];

        $this->columns['amount'] = [
            'type' => 'decimal',
            'nullable' => true,
            'precision' => 19,
            'scale' => 4,
        ];

        $this->columns['bonus'] = [
            'type' => 'decimal',
            'nullable' => true,
            'precision' => 19,
            'scale' => 4,
        ];

        $this->columns['bonus_rate'] = [
            'type' => 'decimal',
            'nullable' => true,
            'precision' => 8,
            'scale' => 4,
        ];

        $this->columns['commission'] = [
            'type' => 'decimal',
            'nullable' => true,
            'precision' => 19,
            'scale' => 4,
        ];

        $this->columns['commission_rate'] = [
            'type' => 'decimal',
            'nullable' => true,
            'precision' => 8,
            'scale' => 4,
        ];

        $this->columns['estimate'] = [
            'type' => 'decimal',
            'nullable' => true,
            'precision' => 19,
            'scale' => 4,
        ];

        $this->columns['fees'] = [
            'type' => 'decimal',
            'nullable' => true,
            'precision' => 19,
            'scale' => 4,
        ];

        $this->columns['materials'] = [
            'type' => 'decimal',
            'nullable' => true,
            'precision' => 19,
            'scale' => 4,
        ];

        $this->columns['services'] = [
            'type' => 'decimal',
            'nullable' => true,
            'precision' => 19,
            'scale' => 4,
        ];

        $this->columns['shipping'] = [
            'type' => 'decimal',
            'nullable' => true,
            'precision' => 19,
            'scale' => 4,
        ];

        $this->columns['subtotal'] = [
            'type' => 'decimal',
            'nullable' => true,
            'precision' => 19,
            'scale' => 4,
        ];

        $this->columns['taxable'] = [
            'type' => 'decimal',
            'nullable' => true,
            'precision' => 19,
            'scale' => 4,
        ];

        $this->columns['tax_rate'] = [
            'type' => 'decimal',
            'nullable' => true,
            'precision' => 8,
            'scale' => 4,
        ];

        $this->columns['taxes'] = [
            'type' => 'decimal',
            'nullable' => true,
            'precision' => 19,
            'scale' => 4,
        ];

        $this->columns['total'] = [
            'type' => 'decimal',
            'nullable' => true,
            'precision' => 19,
            'scale' => 4,
        ];

        // dd([
        //     '__METHOD__' => __METHOD__,
        //     '$this' => $this,
        // ]);
    }
}
