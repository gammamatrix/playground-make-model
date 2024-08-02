<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Building\Skeleton;

use Illuminate\Support\Str;
use Playground\Make\Configuration\Model\Create;

/**
 * \Playground\Make\Model\Building\Skeleton\MakeDates
 */
trait MakeDates
{
    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $filters_dates = [];

    protected function buildClass_skeleton_date(Create $create): void
    {
        $this->buildClass_skeleton_timestamps($create);
        $this->buildClass_skeleton_softDeletes($create);
        $this->buildClass_skeleton_dates($create);
        // dd([
        //     '__METHOD__' => __METHOD__,
        //     '$this->filters_dates' => $this->filters_dates,
        // ]);

        $this->c->addFilter([
            'dates' => array_values($this->filters_dates),
        ], true);
    }

    protected function buildClass_skeleton_timestamps(Create $create): void
    {
        if (! $create->timestamps()) {
            return;
        }

        $this->components->info(sprintf('Adding timestamps to [%s]', $this->c->name()));

        $this->c->addAttribute('created_at', null);
        $this->c->addCast('created_at', 'datetime');

        if (! in_array('created_at', $this->analyze['sortable'])) {
            $this->c->addSortable([
                'type' => 'string',
                'column' => 'created_at',
                'label' => 'Created At',
            ]);
        }

        if (! in_array('created_at', $this->analyze_filters['dates'])) {
            $this->filters_dates['created_at'] = [
                'label' => 'Created at',
                'column' => 'created_at',
                'type' => 'datetime',
                'nullable' => true,
            ];
        }

        $this->c->addAttribute('updated_at', null);
        $this->c->addCast('updated_at', 'datetime');

        if (! in_array('updated_at', $this->analyze['sortable'])) {
            $this->c->addSortable([
                'type' => 'string',
                'column' => 'updated_at',
                'label' => 'Updated At',
            ]);
        }

        if (! in_array('updated_at', $this->analyze_filters['dates'])) {
            $this->filters_dates['updated_at'] = [
                'label' => 'Updated at',
                'column' => 'updated_at',
                'type' => 'datetime',
                'nullable' => true,
            ];
        }

        // dd([
        //     '__METHOD__' => __METHOD__,
        //     '$this->c->filters()' => $this->c->filters(),
        // ]);
    }

    protected function buildClass_skeleton_softDeletes(Create $create): void
    {
        if (! $create->softDeletes()) {
            return;
        }

        $this->components->info(sprintf('Adding soft deletes to [%s]', $this->c->name()));

        $this->c->addAttribute('deleted_at', null);
        $this->c->addCast('deleted_at', 'datetime');

        if (! in_array('deleted_at', $this->analyze_filters['dates'])) {
            $this->filters_dates['deleted_at'] = [
                'label' => 'Deleted at',
                'column' => 'deleted_at',
                'type' => 'datetime',
                'nullable' => true,
            ];
        }

        if (! in_array('deleted_at', $this->analyze['sortable'])) {
            $this->c->addSortable([
                'type' => 'string',
                'column' => 'deleted_at',
                'label' => 'Deleted At',
            ]);
        }
    }

    protected function buildClass_skeleton_dates(Create $create): void
    {
        $dates = $create->dates();

        $this->components->info(sprintf('Skeleton dates for [%s]', $this->c->name()));

        foreach ($this->recipe->dates() as $column => $meta) {

            $label = ! empty($meta['label'])
                ? empty($meta['label'])
                : Str::of($column)->replace('_', ' ')->ucfirst()->toString();
            // dd([
            //     '__METHOD__' => __METHOD__,
            //     '$column' => $column,
            //     '$label' => $label,
            // ]);

            $this->c->addAttribute($column, null);
            $this->c->addCast($column, 'datetime');

            if (empty($meta['readOnly'])) {
                $this->c->addFillable($column);
            }

            if (! in_array($column, $this->analyze_filters['dates'])) {
                $this->filters_dates[$column] = [
                    'column' => $column,
                    'label' => $label,
                    'type' => 'datetime',
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

            $meta['label'] = $label;

            $create->addDate($column, $meta);
        }
    }
}
