<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Building\Skeleton;

use Illuminate\Support\Str;
use Playground\Make\Configuration\Model\Create;

/**
 * \Playground\Make\Model\Building\Skeleton\MakePermissions
 */
trait MakePermissions
{
    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $filters_permissions = [];

    protected function buildClass_skeleton_permissions(Create $create): void
    {
        $permissions = $create->permissions();

        $this->components->info(sprintf('Skeleton permissions for [%s]', $this->c->name()));

        // dump([
        //     '__METHOD__' => __METHOD__,
        //     '$permissions' => $permissions,
        // ]);

        foreach ($this->recipe->permissions() as $column => $meta) {

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

            if (! in_array($column, $this->analyze_filters['permissions'])) {
                $this->filters_permissions[$column] = [
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

            $create->addPermission($column, $meta);
        }

        $this->c->addFilter([
            'permissions' => array_values($this->filters_permissions),
        ], true);
    }
}
