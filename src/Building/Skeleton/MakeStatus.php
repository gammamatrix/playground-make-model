<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Building\Skeleton;

use Illuminate\Support\Str;
use Playground\Make\Configuration\Model\Create;

/**
 * \Playground\Make\Model\Building\Skeleton\MakeStatus
 */
trait MakeStatus
{
    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $filters_status = [];

    protected function buildClass_skeleton_status(Create $create): void
    {
        $status = $create->status();

        $this->components->info(sprintf('Skeleton status for [%s]', $this->c->name()));

        // dump([
        //     '__METHOD__' => __METHOD__,
        //     '$status' => $status,
        // ]);

        foreach ($this->recipe->status() as $column => $meta) {

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

            if (! in_array($column, $this->analyze_filters['status'])) {
                $this->filters_status[$column] = [
                    'label' => $label,
                    'column' => $column,
                    'type' => $type,
                    'icon' => $meta['icon'] ?? '',
                    'nullable' => true,
                ];
            }

            if (! in_array($column, $this->analyze['sortable'])) {
                $this->c->addSortable([
                    'label' => $label,
                    'type' => $type,
                    'icon' => $meta['icon'] ?? '',
                    'column' => $column,
                ]);
            }

            $meta['label'] = $label;

            $create->addStatus($column, $meta);
        }

        $this->c->addFilter([
            'status' => array_values($this->filters_status),
        ], true);
    }
}
