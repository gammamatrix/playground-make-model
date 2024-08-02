<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Building\Skeleton;

use Illuminate\Support\Str;
use Playground\Make\Configuration\Model\Create;

/**
 * \Playground\Make\Model\Building\Skeleton\MakeColumns
 */
trait MakeColumns
{
    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $filters_columns = [];

    protected function buildClass_skeleton_columns(Create $create): void
    {
        $columns = $create->columns();

        $this->components->info(sprintf('Skeleton columns for [%s]', $this->c->name()));

        // dump([
        //     '__METHOD__' => __METHOD__,
        //     '$columns' => $columns,
        // ]);

        foreach ($this->recipe->columns() as $column => $meta) {

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
            $this->c->addCast($column, $type);

            if (empty($meta['readOnly'])) {
                $this->c->addFillable($column);
            }

            if (! in_array($column, $this->analyze_filters['columns'])) {
                $this->filters_columns[$column] = [
                    'label' => $label,
                    'column' => $column,
                    'type' => $type,
                    'icon' => $meta['icon'] ?? '',
                    'nullable' => true,
                ];
            }

            if (! in_array($column, $this->analyze['sortable'])) {
                $this->c->addSortable([
                    'type' => $type,
                    'column' => $column,
                    'icon' => $meta['icon'] ?? '',
                    'label' => $label,
                ]);
            }

            $meta['label'] = $label;

            $create->addColumn($column, $meta);
        }

        $this->c->addFilter([
            'columns' => array_values($this->filters_columns),
        ], true);
    }

    // protected function buildClass_skeleton_defined_columns(Create $create): void
    // {
    //     $columns = $create->columns();

    //     $this->components->info(sprintf('Skeleton defined columns for [%s]', $this->c->name()));

    //     // dump([
    //     //     '__METHOD__' => __METHOD__,
    //     //     '$columns' => $columns,
    //     // ]);

    //     /**
    //      * @var array<string, array<int, mixed>>
    //      */
    //     $addFilters = [
    //         'columns' => [],
    //     ];

    //     $name = $this->c->name();

    //     foreach ($columns as $column => $createColumn) {

    //         $label = Str::of($column)->replace('_', ' ')->ucfirst()->toString();
    //         // dd([
    //         //     '__METHOD__' => __METHOD__,
    //         //     '$column' => $column,
    //         //     '$createColumn' => $createColumn,
    //         // ]);

    //         $default = null;
    //         if ($createColumn->hasDefault()) {
    //             $default = $createColumn->default();
    //         }

    //         $this->c->addAttribute($column, $default);
    //         $this->c->addCast($column, $createColumn->type());

    //         if (! $createColumn->readOnly()) {
    //             $this->c->addFillable($column);
    //         }

    //         if (! in_array($column, $this->analyze_filters['columns'])) {
    //             $addFilters['columns'][] = [
    //                 'label' => $label,
    //                 'column' => $column,
    //                 'type' => $createColumn->type(),
    //                 'nullable' => true,
    //             ];
    //         }

    //         if (! in_array($column, $this->analyze['sortable'])) {
    //             $this->c->addSortable([
    //                 'type' => $createColumn->type(),
    //                 'column' => $column,
    //                 'label' => $label,
    //             ]);
    //         }

    //         // $meta = [];
    //         // if (is_array($this->skeleton_columns[$column])) {
    //         //     $meta = $this->skeleton_columns[$column];
    //         // }

    //         // $meta['label'] = $label;

    //         // $create->addColumn($column, $meta);

    //         if ($addFilters) {
    //             $this->c->addFilter($addFilters);
    //         }
    //         // dd([
    //         //     '__METHOD__' => __METHOD__,
    //         //     // '$this->c' => $this->c,
    //         //     '$this->c->filters()' => $this->c->filters()->toArray(),
    //         //     '$addFilters' => $addFilters,
    //         // ]);
    //         // dump([
    //         //     '__METHOD__' => __METHOD__,
    //         //     '$this->analyze_filters' => $this->analyze_filters,
    //         // ]);
    //     }
    // }
}
