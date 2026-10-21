<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Model\Recipe\Concerns;

use Illuminate\Support\Arr;
use Playground\Make\Model\Recipe\Model;

/**
 * \Playground\Make\Model\Recipe\Concerns\Status
 *
 * @mixin Model
 */
trait Tags
{
    protected string $tableTags = '';

    public function handleTagged(): void
    {
        if ($this->type !== 'playground-model-tagged') {
            return;
        }
        /**
         * @var array<string, array<string, mixed>> $columns
         */
        $columns = Arr::only($this->columns, ['created_at']);
        $this->columns = $columns;
        /**
         * @var array<string, array<string, mixed>> $dates
         */
        $dates = Arr::only($this->dates, ['created_at']);
        $this->dates = $dates;
        /**
         * @var array<string, array<string, mixed>> $userIds
         */
        $userIds = Arr::only($this->userIds, ['created_by_id']);
        $this->userIds = $userIds;
        $this->allIds = [
            'tag_id' => [
                'description' => '',
                'foreign' => [
                    'references' => 'id',
                    'on' => $this->tableTags,
                ],
                'index' => true,
                'nullable' => true,
                'type' => 'uuid',
            ],
            ...$this->allIds,
        ];
        $this->ids = [
            'tag_id' => [
                'description' => '',
                'foreign' => [
                    'references' => 'id',
                    'on' => $this->tableTags,
                ],
                'index' => true,
                'nullable' => true,
                'type' => 'uuid',
            ],
        ];
        $this->json = [];
        $this->circletHasOne = [
            'creator' => [
                'comment' => 'The creator.',
                'accessor' => 'creator',
                'related' => 'User',
                'foreignKey' => 'id',
                'localKey' => 'created_by_id',
            ],
            'tag' => [
                'comment' => 'The tag.',
                'accessor' => 'tag',
                'related' => 'Tag',
                'foreignKey' => 'id',
                'localKey' => 'tag_id',
            ],
            ...$this->circletHasOne,
        ];
        // Set these in the parent class
        // $this->circletHasOne['task']['comment'] = 'The tagged task.';
        // $this->circletHasOne['taskList']['comment'] = 'The tagged task list.';
        // $this->circletHasOne['taskLog']['comment'] = 'The tagged task log.';
        $this->circletHasMany = [];
        $this->hasManyThrough = [];
        // $this->allIds = Arr::except($this->allIds, $this->allIdTaggedExcluded);
        $this->matrix = [];
        $this->flags = [];
        $this->permissions = [];
        $this->status = [];
        $this->ui = [];
        $this->unique = [];
        $this->timestamp_deleted = '';
        $this->timestamp_updated = '';
    }
}
