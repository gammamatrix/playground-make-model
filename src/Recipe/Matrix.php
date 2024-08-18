<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Recipe;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * \Playground\Make\Model\Recipe\Matrix
 */
class Matrix extends Playground
{
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
    protected array $hasMany = [];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $hasMany_all = [
        'backlogs' => [
            'comment' => 'The backlogs of the %1$s.',
            'accessor' => 'backlogs',
            'related' => 'Backlog',
            'localKey' => 'id',
        ],
        'boards' => [
            'comment' => 'The boards of the %1$s.',
            'accessor' => 'boards',
            'related' => 'Board',
            'localKey' => 'id',
        ],
        'epics' => [
            'comment' => 'The epics of the %1$s.',
            'accessor' => 'epics',
            'related' => 'Epic',
            'localKey' => 'id',
        ],
        'flows' => [
            'comment' => 'The flows of the %1$s.',
            'accessor' => 'flows',
            'related' => 'Flow',
            'localKey' => 'id',
        ],
        // 'matrices' => [
        //     'comment' => 'The matrices of the %1$s.',
        //     'accessor' => 'matrices',
        //     'related' => 'Matrix',
        //     'localKey' => 'id',
        // ],
        'milestones' => [
            'comment' => 'The milestones of the %1$s.',
            'accessor' => 'milestones',
            'related' => 'Milestone',
            'localKey' => 'id',
        ],
        'notes' => [
            'comment' => 'The notes of the %1$s.',
            'accessor' => 'notes',
            'related' => 'Note',
            'localKey' => 'id',
        ],
        'projects' => [
            'comment' => 'The projects of the %1$s.',
            'accessor' => 'projects',
            'related' => 'Project',
            'localKey' => 'id',
        ],
        'releases' => [
            'comment' => 'The releases of the %1$s.',
            'accessor' => 'releases',
            'related' => 'Release',
            'localKey' => 'id',
        ],
        'roadmaps' => [
            'comment' => 'The roadmaps of the %1$s.',
            'accessor' => 'roadmaps',
            'related' => 'Roadmap',
            'localKey' => 'id',
        ],
        'sources' => [
            'comment' => 'The sources of the %1$s.',
            'accessor' => 'sources',
            'related' => 'Source',
            'localKey' => 'id',
        ],
        'sprints' => [
            'comment' => 'The sprints of the %1$s.',
            'accessor' => 'sprints',
            'related' => 'Sprint',
            'localKey' => 'id',
        ],
        'tags' => [
            'comment' => 'The tags of the %1$s.',
            'accessor' => 'tags',
            'related' => 'Tag',
            'localKey' => 'id',
        ],
        'teams' => [
            'comment' => 'The teams of the %1$s.',
            'accessor' => 'teams',
            'related' => 'Team',
            'localKey' => 'id',
        ],
        'tickets' => [
            'comment' => 'The tickets of the %1$s.',
            'accessor' => 'tickets',
            'related' => 'Ticket',
            'localKey' => 'id',
        ],
        'versions' => [
            'comment' => 'The versions of the %1$s.',
            'accessor' => 'versions',
            'related' => 'Version',
            'localKey' => 'id',
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
        'backlog' => [
            'comment' => 'The backlog of the %1$s.',
            'accessor' => 'backlog',
            'related' => 'Backlog',
            'foreignKey' => 'id',
            'localKey' => 'backlog_id',
        ],
        'board' => [
            'comment' => 'The board of the %1$s.',
            'accessor' => 'board',
            'related' => 'Board',
            'foreignKey' => 'id',
            'localKey' => 'board_id',
        ],
        'epic' => [
            'comment' => 'The epic of the %1$s.',
            'accessor' => 'epic',
            'related' => 'Epic',
            'foreignKey' => 'id',
            'localKey' => 'epic_id',
        ],
        'flow' => [
            'comment' => 'The flow of the %1$s.',
            'accessor' => 'flow',
            'related' => 'Flow',
            'foreignKey' => 'id',
            'localKey' => 'flow_id',
        ],
        'matrix' => [
            'comment' => 'The matrix of the %1$s.',
            'accessor' => 'matrix',
            'related' => 'Matrix',
            'foreignKey' => 'id',
            'localKey' => 'matrix_id',
        ],
        'milestone' => [
            'comment' => 'The milestone of the %1$s.',
            'accessor' => 'milestone',
            'related' => 'Milestone',
            'foreignKey' => 'id',
            'localKey' => 'milestone_id',
        ],
        'note' => [
            'comment' => 'The note of the %1$s.',
            'accessor' => 'note',
            'related' => 'Note',
            'foreignKey' => 'id',
            'localKey' => 'note_id',
        ],
        'project' => [
            'comment' => 'The project of the %1$s.',
            'accessor' => 'project',
            'related' => 'Project',
            'foreignKey' => 'id',
            'localKey' => 'project_id',
        ],
        'release' => [
            'comment' => 'The release of the %1$s.',
            'accessor' => 'release',
            'related' => 'Release',
            'foreignKey' => 'id',
            'localKey' => 'release_id',
        ],
        'roadmap' => [
            'comment' => 'The roadmap of the %1$s.',
            'accessor' => 'roadmap',
            'related' => 'Roadmap',
            'foreignKey' => 'id',
            'localKey' => 'roadmap_id',
        ],
        'source' => [
            'comment' => 'The source of the %1$s.',
            'accessor' => 'source',
            'related' => 'Source',
            'foreignKey' => 'id',
            'localKey' => 'source_id',
        ],
        'sprint' => [
            'comment' => 'The sprint of the %1$s.',
            'accessor' => 'sprint',
            'related' => 'Sprint',
            'foreignKey' => 'id',
            'localKey' => 'sprint_id',
        ],
        'tag' => [
            'comment' => 'The tag of the %1$s.',
            'accessor' => 'tag',
            'related' => 'Tag',
            'foreignKey' => 'id',
            'localKey' => 'tag_id',
        ],
        'team' => [
            'comment' => 'The team of the %1$s.',
            'accessor' => 'team',
            'related' => 'Team',
            'foreignKey' => 'id',
            'localKey' => 'team_id',
        ],
        'ticket' => [
            'comment' => 'The ticket of the %1$s.',
            'accessor' => 'ticket',
            'related' => 'Ticket',
            'foreignKey' => 'id',
            'localKey' => 'ticket_id',
        ],
        'version' => [
            'comment' => 'The version of the %1$s.',
            'accessor' => 'version',
            'related' => 'Version',
            'foreignKey' => 'id',
            'localKey' => 'version_id',
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
        'backlog_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_backlogs',
            ],
        ],
        'board_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_boards',
            ],
        ],
        'epic_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_epics',
            ],
        ],
        'flow_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_flows',
            ],
        ],
        'matrix_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_matrices',
            ],
        ],
        'milestone_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_milestones',
            ],
        ],
        'note_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_notes',
            ],
        ],
        'project_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_projects',
            ],
        ],
        'release_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_releases',
            ],
        ],
        'roadmap_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_roadmaps',
            ],
        ],
        'source_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_sources',
            ],
        ],
        'sprint_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_sprints',
            ],
        ],
        'tag_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_tags',
            ],
        ],
        'team_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_teams',
            ],
        ],
        'ticket_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_tickets',
            ],
        ],
        'version_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_versions',
            ],
        ],
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $json = [
        'assets' => [
            'default' => '{}',
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
        'backlog' => [
            'default' => '{}',
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
        'board' => [
            'default' => '{}',
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
        'flow' => [
            'default' => '{}',
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
        'history' => [
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
        'roadmap' => [
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
        unset($this->hasOne_all['completedBy']);
        unset($this->hasOne_all['fixedBy']);
        unset($this->hasOne_all['reportedBy']);

        $name_lower = Str::of($this->name())->kebab()->replace('-', ' ')->lower()->toString();
        $has_many_accessor = Str::of($this->name())->plural()->camel()->toString();
        $has_one_accessor = Str::of($this->name())->camel()->toString();
        $table_id = Str::of($has_one_accessor)->finish('_id')->toString();

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

        $withHasOne = true;
        $withHasMany = true;
        $withIds = true;

        $hasOne_excludes = [
            $has_one_accessor,
        ];
        $hasMany_excludes = [
            $has_many_accessor,
        ];
        $flags_excludes = [];
        $ids_excludes = [
            $table_id,
        ];
        $json_excludes = [];

        if (in_array($this->name(), [
            'Matrix',
        ])) {
            $withHasOne = false;
            $withHasMany = false;
            $withIds = false;

            $this->ids = [
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

            $flags_excludes[] = 'duplicate';
            $flags_excludes[] = 'fixed';
            $flags_excludes[] = 'resolved';

            $json_excludes[] = 'backlog';
            $json_excludes[] = 'board';
            $json_excludes[] = 'flow';
            $json_excludes[] = 'history';
            $json_excludes[] = 'roadmap';

        } elseif (in_array($this->name(), [
            'Board',
            'Epic',
            'Milestone',
            'Release',
            'Roadmap',
            'Sprint',
            'Team',
        ])) {
            $flags_excludes[] = 'duplicate';
            $flags_excludes[] = 'fixed';
            $flags_excludes[] = 'resolved';
            $hasMany_excludes[] = 'flows';
            $hasMany_excludes[] = 'notes';
            $hasMany_excludes[] = 'sources';
            $hasMany_excludes[] = 'tags';
            $hasMany_excludes[] = 'versions';
        } elseif (in_array($this->name(), [
            'Flow',
        ])) {
            $flags_excludes[] = 'duplicate';
            $flags_excludes[] = 'fixed';
            $flags_excludes[] = 'resolved';
            $hasMany_excludes[] = 'flows';
            $hasMany_excludes[] = 'notes';
            $hasMany_excludes[] = 'sources';
            $hasMany_excludes[] = 'tags';
            $hasMany_excludes[] = 'versions';
            $ids_excludes[] = 'backlog_id';
            $ids_excludes[] = 'board_id';
            $ids_excludes[] = 'epic_id';
            $ids_excludes[] = 'milestone_id';
            $ids_excludes[] = 'project_id';
            $ids_excludes[] = 'release_id';
            $ids_excludes[] = 'roadmap_id';
            $ids_excludes[] = 'source_id';
            $ids_excludes[] = 'sprint_id';
            $ids_excludes[] = 'ticket_id';
            $ids_excludes[] = 'version_id';
            $json_excludes[] = 'backlog';
            $json_excludes[] = 'board';
            $json_excludes[] = 'flow';
            $json_excludes[] = 'history';
            $json_excludes[] = 'roadmap';

        } elseif (in_array($this->name(), [
            'Note',
        ])) {
            $flags_excludes[] = 'duplicate';
            $flags_excludes[] = 'fixed';
            $flags_excludes[] = 'resolved';
            $hasMany_excludes[] = 'flows';
            $hasMany_excludes[] = 'notes';
            $hasMany_excludes[] = 'sources';
            $hasMany_excludes[] = 'tags';
            $hasMany_excludes[] = 'versions';
            // $ids_excludes[] = 'backlog_id';
            $ids_excludes[] = 'board_id';
            $ids_excludes[] = 'flow_id';
            $ids_excludes[] = 'epic_id';
            $ids_excludes[] = 'milestone_id';
            $ids_excludes[] = 'project_id';
            $ids_excludes[] = 'release_id';
            $ids_excludes[] = 'roadmap_id';
            $ids_excludes[] = 'source_id';
            $ids_excludes[] = 'sprint_id';
            $ids_excludes[] = 'team_id';
            $ids_excludes[] = 'ticket_id';
            $ids_excludes[] = 'version_id';
            $json_excludes[] = 'backlog';
            $json_excludes[] = 'board';
            $json_excludes[] = 'flow';
            $json_excludes[] = 'history';
            $json_excludes[] = 'roadmap';

            $this->dates = [];

        } elseif (in_array($this->name(), [
            'Source',
        ])) {
            $flags_excludes[] = 'duplicate';
            $flags_excludes[] = 'fixed';
            $flags_excludes[] = 'resolved';
            $hasMany_excludes[] = 'flows';
            $hasMany_excludes[] = 'notes';
            $hasMany_excludes[] = 'sources';
            $hasMany_excludes[] = 'tags';
            $hasMany_excludes[] = 'versions';
            // $ids_excludes[] = 'backlog_id';
            $ids_excludes[] = 'board_id';
            $ids_excludes[] = 'flow_id';
            $ids_excludes[] = 'epic_id';
            $ids_excludes[] = 'milestone_id';
            $ids_excludes[] = 'project_id';
            $ids_excludes[] = 'release_id';
            $ids_excludes[] = 'roadmap_id';
            $ids_excludes[] = 'source_id';
            $ids_excludes[] = 'sprint_id';
            $ids_excludes[] = 'ticket_id';
            $ids_excludes[] = 'version_id';
            $json_excludes[] = 'backlog';
            $json_excludes[] = 'board';
            $json_excludes[] = 'flow';
            $json_excludes[] = 'history';
            $json_excludes[] = 'roadmap';

        } elseif (in_array($this->name(), [
            'Tag',
        ])) {
            $flags_excludes[] = 'canceled';
            $flags_excludes[] = 'closed';
            $flags_excludes[] = 'completed';
            $flags_excludes[] = 'duplicate';
            $flags_excludes[] = 'fixed';
            $flags_excludes[] = 'resolved';
            $flags_excludes[] = 'pending';
            $flags_excludes[] = 'planned';
            $flags_excludes[] = 'prioritized';
            $flags_excludes[] = 'problem';
            $flags_excludes[] = 'published';
            $flags_excludes[] = 'released';
            $flags_excludes[] = 'suspended';
            $hasMany_excludes[] = 'flows';
            $hasMany_excludes[] = 'notes';
            $hasMany_excludes[] = 'sources';
            $hasMany_excludes[] = 'tags';
            $hasMany_excludes[] = 'versions';
            // $ids_excludes[] = 'backlog_id';
            $ids_excludes[] = 'board_id';
            $ids_excludes[] = 'flow_id';
            $ids_excludes[] = 'epic_id';
            $ids_excludes[] = 'milestone_id';
            $ids_excludes[] = 'note_id';
            $ids_excludes[] = 'project_id';
            $ids_excludes[] = 'release_id';
            $ids_excludes[] = 'roadmap_id';
            $ids_excludes[] = 'source_id';
            $ids_excludes[] = 'sprint_id';
            $ids_excludes[] = 'team_id';
            $ids_excludes[] = 'ticket_id';
            $ids_excludes[] = 'version_id';
            $json_excludes[] = 'backlog';
            $json_excludes[] = 'board';
            $json_excludes[] = 'flow';
            $json_excludes[] = 'history';
            $json_excludes[] = 'roadmap';

            $this->dates = [];

        } elseif (in_array($this->name(), [
            'Version',
        ])) {
            $flags_excludes[] = 'duplicate';
            $hasMany_excludes[] = 'flows';
            $hasMany_excludes[] = 'notes';
            $hasMany_excludes[] = 'sources';
            $hasMany_excludes[] = 'tags';
            $hasMany_excludes[] = 'versions';
            // $ids_excludes[] = 'backlog_id';
            $ids_excludes[] = 'board_id';
            $ids_excludes[] = 'flow_id';
            $ids_excludes[] = 'epic_id';
            $ids_excludes[] = 'milestone_id';
            $ids_excludes[] = 'note_id';
            // $ids_excludes[] = 'project_id';
            $ids_excludes[] = 'release_id';
            $ids_excludes[] = 'roadmap_id';
            $ids_excludes[] = 'source_id';
            $ids_excludes[] = 'sprint_id';
            // $ids_excludes[] = 'team_id';
            // $ids_excludes[] = 'ticket_id';
            $json_excludes[] = 'backlog';
            $json_excludes[] = 'board';
            $json_excludes[] = 'flow';
            $json_excludes[] = 'history';
            $json_excludes[] = 'roadmap';

        } elseif (in_array($this->name(), [
            'Project',
        ])) {

            $this->columns['key'] = [
                'type' => 'string',
                'size' => 32,
                'nullable' => true,
                'index' => true,
            ];
            $this->columns['code_name'] = [
                'type' => 'string',
                'size' => 128,
                'nullable' => true,
                'index' => true,
            ];

            $hasMany_excludes[] = 'flows';
            $hasMany_excludes[] = 'notes';
            $hasMany_excludes[] = 'sources';
            $hasMany_excludes[] = 'tags';
            $hasMany_excludes[] = 'versions';

        } elseif (in_array($this->name(), [
            'Ticket',
        ])) {

            $hasMany_excludes[] = 'flows';
            $hasMany_excludes[] = 'notes';
            $hasMany_excludes[] = 'sources';
            $hasMany_excludes[] = 'tags';
            $hasMany_excludes[] = 'versions';

            $this->columns['handler'] = [
                'type' => 'string',
                'nullable' => true,
            ];

            $this->columns['key'] = [
                'type' => 'string',
                'size' => 32,
                'nullable' => true,
                'index' => true,
            ];

            $this->columns['code'] = [
                'type' => 'bigInteger',
                'nullable' => true,
                'unsigned' => true,
                'index' => true,
            ];

            $this->columns['key_code_hash'] = [
                'type' => 'string',
                'nullable' => true,
            ];

            $this->columns['priority'] = [
                'type' => 'string',
                'nullable' => true,
            ];

            $this->columns['severity'] = [
                'type' => 'string',
                'nullable' => true,
            ];

            $this->columns['resolution'] = [
                'type' => 'string',
                'nullable' => true,
            ];

            $this->columns['step'] = [
                'type' => 'string',
                'nullable' => true,
            ];

            $this->columns['state'] = [
                'type' => 'string',
                'nullable' => true,
            ];

            $this->columns['workflow_type'] = [
                'type' => 'string',
                'nullable' => true,
            ];

            $this->columns['points'] = [
                'type' => 'bigInteger',
                'unsigned' => true,
                'default' => 0,
            ];

            $this->columns['actual'] = [
                'type' => 'mediumText',
                'nullable' => true,
            ];

            $this->columns['expected'] = [
                'type' => 'mediumText',
                'nullable' => true,
            ];

            $this->columns['story'] = [
                'type' => 'mediumText',
                'nullable' => true,
            ];

            $this->columns['steps'] = [
                'type' => 'mediumText',
                'nullable' => true,
            ];

            $this->columns['criteria'] = [
                'type' => 'mediumText',
                'nullable' => true,
            ];

            $this->columns['reproducibility'] = [
                'type' => 'decimal',
                'nullable' => true,
                'precision' => 8,
                'scale' => 2,
            ];

            $this->dates['fixed_at'] = [
                'nullable' => true,
                'index' => false,
            ];

            $this->ids = Arr::except($this->ids_all, $ids_excludes);

            $this->ids['completed_by_id'] = [
                'type' => 'uuid',
                'nullable' => true,
                'index' => true,
                'foreign' => [
                    'references' => 'id',
                    'on' => 'users',
                ],
            ];

            $this->ids['duplicate_id'] = [
                'type' => 'uuid',
                'nullable' => true,
                'index' => true,
                'foreign' => [
                    'references' => 'id',
                    'on' => 'matrix_tickets',
                ],
            ];

            $this->ids['fixed_by_id'] = [
                'type' => 'uuid',
                'nullable' => true,
                'index' => true,
                'foreign' => [
                    'references' => 'id',
                    'on' => 'users',
                ],
            ];

            $this->ids['reported_by_id'] = [
                'type' => 'uuid',
                'nullable' => true,
                'index' => true,
                'foreign' => [
                    'references' => 'id',
                    'on' => 'users',
                ],
            ];

            $this->ids['version_fixed_id'] = [
                'type' => 'uuid',
                'nullable' => true,
                'index' => true,
                'foreign' => [
                    'references' => 'id',
                    'on' => 'matrix_versions',
                ],
            ];

            $withIds = false;

            $this->hasOne_all['completedBy'] = [
                'comment' => 'The completed by user of the %1$s.',
                'accessor' => 'completedBy',
                'related' => '\Playground\Models\User',
                // 'related' => 'User',
                'foreignKey' => 'id',
                'localKey' => 'completed_by_id',
            ];

            $this->hasOne_all['fixedBy'] = [
                'comment' => 'The fixed by user of the %1$s.',
                'accessor' => 'fixedBy',
                'related' => '\Playground\Models\User',
                // 'related' => 'User',
                'foreignKey' => 'id',
                'localKey' => 'fixed_by_id',
            ];

            $this->hasOne_all['reportedBy'] = [
                'comment' => 'The reported by user of the %1$s.',
                'accessor' => 'reportedBy',
                'related' => '\Playground\Models\User',
                // 'related' => 'User',
                'foreignKey' => 'id',
                'localKey' => 'reported_by_id',
            ];

        } else {
            $ids_excludes[] = 'version_fixed_id';
            $flags_excludes[] = 'duplicate';
            $flags_excludes[] = 'fixed';
            $flags_excludes[] = 'resolved';
        }

        if (in_array($this->name(), [
            'Backlog',
        ])) {
            $hasMany_excludes[] = 'flows';
            $hasMany_excludes[] = 'notes';
            $hasMany_excludes[] = 'sources';
            $hasMany_excludes[] = 'tags';
            $hasMany_excludes[] = 'versions';
        }

        if ($withIds) {
            $this->ids = Arr::except($this->ids_all, $ids_excludes);
        }

        // dump([
        //     '__METHOD__' => __METHOD__,
        //     // '$this->columns' => $this->columns,
        //     // '$this->dates' => $this->dates,
        //     // '$this->flags' => $this->flags,
        //     '$this->hasOne' => $this->hasOne,
        //     '$this->hasMany' => $this->hasMany,
        //     '$this->ids' => $this->ids,
        //     // '$this->json' => $this->json,
        //     '$this->name()' => $this->name(),
        //     '$ids_excludes' => $ids_excludes,
        //     '$flags_excludes' => $flags_excludes,
        //     '$json_excludes' => $json_excludes,
        //     '$hasMany_excludes' => $hasMany_excludes,
        //     '$hasOne_excludes' => $hasOne_excludes,
        // ]);

        if ($withHasOne) {
            $this->hasOne = Arr::except($this->hasOne_all, $hasOne_excludes);
            foreach (array_keys($this->hasOne) as $accessor) {

                if (empty($this->hasOne[$accessor]['localKey'])
                    || in_array($this->hasOne[$accessor]['localKey'], $ids_excludes)
                ) {
                    // Remove
                    unset($this->hasOne[$accessor]);
                }

                // dd([
                //     '__METHOD__' => __METHOD__,
                //     '$accessor' => $accessor,
                //     '$this->hasOne[$accessor]' => $this->hasOne[$accessor] ?? null,
                //     // '$this->columns' => $this->columns,
                //     // '$this->dates' => $this->dates,
                //     // '$this->flags' => $this->flags,
                //     '$this->hasOne' => $this->hasOne,
                //     // '$this->hasMany' => $this->hasMany,
                //     '$this->ids' => $this->ids,
                //     // '$this->json' => $this->json,
                //     '$this->name()' => $this->name(),
                //     '$ids_excludes' => $ids_excludes,
                // ]);

                if (! empty($this->hasOne[$accessor]['comment']) && is_string($this->hasOne[$accessor]['comment'])) {
                    $this->hasOne[$accessor]['comment'] = sprintf(
                        $this->hasOne[$accessor]['comment'],
                        $name_lower
                    );
                }
            }
        }

        if ($withHasMany) {
            $this->hasMany = Arr::except($this->hasMany_all, $hasMany_excludes);

            foreach ($this->hasMany as $accessor => $meta) {
                if (! empty($meta['comment']) && is_string($meta['comment'])) {
                    $this->hasMany[$accessor]['comment'] = sprintf(
                        $meta['comment'],
                        $name_lower
                    );
                }
                $this->hasMany[$accessor]['foreignKey'] = $table_id;
            }
        }

        $this->flags = Arr::except($this->flags, $flags_excludes);

        $this->json = Arr::except($this->json, $json_excludes);

        // backlog_id
        if (! in_array($this->name(), [
            'Board',
            'Epic',
            'Milestone',
            'Project',
            'Release',
            'Roadmap',
            'Sprint',
            'Team',
            'Ticket',
        ])) {
            unset($this->ids['backlog_id']);
            unset($this->hasOne['backlog']);
        }

        ksort($this->dates);
        ksort($this->flags);
        // dump([
        //     '__METHOD__' => __METHOD__,
        //     '$this->columns' => $this->columns,
        //     '$this->dates' => $this->dates,
        //     '$this->flags' => $this->flags,
        //     '$this->hasOne' => $this->hasOne,
        //     '$this->hasMany' => $this->hasMany,
        //     '$this->ids' => $this->ids,
        //     // '$this->json' => $this->json,
        //     '$this->name()' => $this->name(),
        //     '$ids_excludes' => $ids_excludes,
        //     '$flags_excludes' => $flags_excludes,
        //     '$json_excludes' => $json_excludes,
        //     '$hasMany_excludes' => $hasMany_excludes,
        //     '$hasOne_excludes' => $hasOne_excludes,
        // ]);
    }
}
