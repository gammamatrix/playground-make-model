<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Building\Skeleton;

use Illuminate\Support\Str;
use Playground\Make\Configuration\Model\Create;

/**
 * \Playground\Make\Model\Building\Skeleton\MakeJson
 */
trait MakeJson
{
    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $filters_json = [];

    protected function buildClass_skeleton_json(Create $create): void
    {
        $json = $create->json();

        $this->components->info(sprintf('Skeleton json for [%s]', $this->c->name()));

        // dump([
        //     '__METHOD__' => __METHOD__,
        //     '$json' => $json,
        // ]);

        foreach ($this->recipe->json() as $column => $meta) {

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

            if (! in_array($column, $this->analyze_filters['json'])) {
                $this->filters_json[$column] = [
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

            $create->addJson($column, $meta);
        }

        $this->c->addFilter([
            'json' => array_values($this->filters_json),
        ], true);
    }
}
