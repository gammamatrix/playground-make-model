<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Building\Skeleton;

use Illuminate\Support\Str;
use Playground\Make\Configuration\Model\Create;

/**
 * \Playground\Make\Model\Building\Skeleton\MakeFlags
 */
trait MakeFlags
{
    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $filters_flags = [];

    protected function buildClass_skeleton_flags(Create $create): void
    {
        $flags = $create->flags();

        $this->components->info(sprintf('Skeleton flags for [%s]', $this->c->name()));

        // dump([
        //     '__METHOD__' => __METHOD__,
        //     '$flags' => $flags,
        // ]);

        foreach ($this->recipe->flags() as $column => $meta) {

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

            $default = false;
            if (array_key_exists('default', $meta)) {
                $default = $meta['default'];
            }

            $this->c->addAttribute($column, $default);
            $this->c->addCast($column, $type);

            if (empty($meta['readOnly'])) {
                $this->c->addFillable($column);
            }

            if (! in_array($column, $this->analyze_filters['flags'])) {
                $this->filters_flags[$column] = [
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

            $create->addFlag($column, $meta);

        }

        $this->c->addFilter([
            'flags' => array_values($this->filters_flags),
        ], true);
    }
}
