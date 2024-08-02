<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Building\Skeleton;

use Illuminate\Support\Str;
use Playground\Make\Configuration\Model\Create;

/**
 * \Playground\Make\Model\Building\Skeleton\MakeUi
 */
trait MakeUi
{
    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $filters_ui = [];

    protected function buildClass_skeleton_ui(Create $create): void
    {
        $ui = $create->ui();

        $this->components->info(sprintf('Skeleton ui for [%s]', $this->c->name()));

        // dump([
        //     '__METHOD__' => __METHOD__,
        //     '$ui' => $ui,
        // ]);

        foreach ($this->recipe->ui() as $column => $meta) {

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

            if (! in_array($column, $this->analyze_filters['ui'])) {
                $this->filters_ui[$column] = [
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

            $create->addUi($column, $meta);
        }

        $this->c->addFilter([
            'ui' => array_values($this->filters_ui),
        ], true);
    }
}
