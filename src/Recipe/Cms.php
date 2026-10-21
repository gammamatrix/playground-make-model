<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Model\Recipe;

/**
 * \Playground\Make\Model\Recipe\Cms
 */
class Cms extends Playground
{
    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $allIds = [
        'parent_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => null,
            ],
            'index' => true,
            'nullable' => true,
            'trait' => 'WithParent',
            'type' => 'uuid',
        ],
        'matrix_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_matrices',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'page_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'cms_pages',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'snippet_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'cms_snippets',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $factoryStates = [
        'locked' => [
            'type' => 'flag',
            'value' => true,
        ],
        'published' => [
            'type' => 'flag',
            'value' => true,
        ],
    ];

    protected array $hasMany = [
        'revisions' => [
            'comment' => 'The revisions of the model.',
            'accessor' => 'revisions',
            'related' => '',
            'foreignKey' => '',
            'localKey' => 'id',
        ],
    ];

    protected array $hasOne = [
        'page' => [
            'comment' => 'The page of the revision.',
            'accessor' => 'page',
            'related' => 'Page',
            'foreignKey' => 'id',
            'localKey' => 'page_id',
        ],
        'snippet' => [
            'comment' => 'The snippet of the revision.',
            'accessor' => 'snippet',
            'related' => 'Snippet',
            'foreignKey' => 'id',
            'localKey' => 'snippet_id',
        ],
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $hasManyThrough = [
        'tags' => [
            'comment' => 'The tags of the %1$s.',
            'accessor' => 'tags',
            'related' => 'Tag',
            'through' => 'Tagged',
            'firstKey' => 'task_id',
            'secondKey' => 'id',
            'localKey' => 'id',
            'secondLocalKey' => 'tag_id',
        ],
    ];

    protected string $tableTags = 'cms_tags';

    public function addDates(): void
    {
        $this->dates['fixed_at'] = [
            'label' => 'Fixed at',
            'nullable' => true,
        ];

        ksort($this->dates);
    }

    public function init(): void
    {
        $this->addDates();
        $this->handleHasOne();
        $this->withRevisions();
        $this->withRouting();
    }

    //    public function init(): void
    //    {
    //        if ($this->type === 'playground-model-tagged') {
    //            $this->circletHasOne['page']['comment'] = 'The tagged page.';
    //            $this->circletHasOne['snippet']['comment'] = 'The tagged snippet.';
    //            $this->allIds = Arr::except($this->allIds, ['parent_id', 'matrix_id']);
    //            $this->handleTagged();
    //            $this->handleCircletHasOne();
    //        }
    //
    //        if ($this->name === 'Tag') {
    //            $this->allIds = Arr::only($this->allIds, ['parent_id', 'matrix_id']);
    //            $this->circletHasOne = [];
    //            $this->circletHasMany = [];
    //            $this->hasManyThrough = [];
    //        } else {
    //            $this->addColumns();
    //            $this->addDates();
    //            $this->addFlags();
    //            $this->addJson();
    //        }
    //
    //        $this->handleCircletHasOne();
    //        $this->handleCircletHasMany();
    //        $this->handleHasManyThrough();
    //        // dd($this);
    //        // dump([
    //        //    '__METHOD__' => __METHOD__,
    //        //    '$this->hasManyThrough' => $this->hasManyThrough,
    //        // ]);
    //    }

    public function withRevisions(): void
    {
        $this->status['revision'] = [
            'type' => 'bigInteger',
            'default' => false,
            'unsigned' => true,
            'readOnly' => true,
            'icon' => '',
        ];

        if (! in_array($this->name(), [
            'Page',
            'Snippet',
        ])) {
            unset($this->hasMany['revisions']);
        }

        if (in_array($this->name(), [
            'Page',
        ])) {
            $this->hasMany['revisions']['comment'] = 'The revisions of the page.';
            $this->hasMany['revisions']['related'] = 'PageRevision';
            $this->hasMany['revisions']['foreignKey'] = 'page_id';
        }

        if (! in_array($this->name(), [
            'PageRevision',
        ])) {
            unset($this->ids['page_id']);
            unset($this->hasOne['page']);
        }

        if (in_array($this->name(), [
            'Snippet',
        ])) {
            $this->hasMany['revisions']['comment'] = 'The revisions of the snippet.';
            $this->hasMany['revisions']['related'] = 'SnippetRevision';
            $this->hasMany['revisions']['foreignKey'] = 'snippet_id';
        }

        if (! in_array($this->name(), [
            'SnippetRevision',
        ])) {
            unset($this->ids['snippet_id']);
            unset($this->hasOne['snippet']);
        }
    }

    public function withRouting(): void
    {
        if (in_array($this->name(), [
            'Page',
            'PageRevision',
        ])) {
            $this->flags['is_external'] = [
                'type' => 'boolean',
                'default' => false,
                'icon' => 'fa-solid fa-close',
            ];
            $this->flags['is_redirect'] = [
                'type' => 'boolean',
                'default' => false,
                'icon' => 'fa-solid fa-close',
            ];
            $this->flags['sitemap'] = [
                'type' => 'boolean',
                'default' => false,
                'icon' => 'fa-solid fa-sitemap text-success',
            ];
            /**
             * Routing
             *
             * redirect_delay   in seconds
             * status_code      200 - 500
             * route            home, playground.cms.api.pages.create, ...
             * params
             */
            $this->status['redirect_delay'] = [
                'type' => 'integer',
                'default' => false,
                'unsigned' => true,
                'icon' => '',
            ];
            $this->status['status_code'] = [
                'type' => 'integer',
                'default' => false,
                'unsigned' => true,
                'icon' => '',
            ];
            $this->status['route'] = [
                'type' => 'string',
                'nullable' => true,
                'size' => 255,
                'icon' => '',
            ];
            $this->json['params'] = [
                'default' => null,
                'nullable' => true,
                'type' => 'JSON_OBJECT',
            ];
        }
    }
}
