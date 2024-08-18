<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Building;

use Illuminate\Support\Str;
use Playground\Make\Configuration\Model\Create;

/**
 * \Playground\Make\Model\Building\MakeSkeleton
 */
trait MakeSkeleton
{
    protected function buildClass_skeleton(): void
    {
        $create = $this->c->create();

        $name = $this->c->name();
        $type = $this->c->type();
        // dump([
        //     '__METHOD__' => __METHOD__,
        //     '$create' => $create,
        //     '$name' => $name,
        //     '$type' => $type,
        //     '$this->c->toArray()' => $this->c->toArray(),
        // ]);

        if (! $create) {
            $create = $this->buildClass_model_create($name, $type);
        }

        $this->analyze($create, $name);

        $this->components->info(sprintf('Building the model skeleton configuration for [%s]', $name));

        if ($this->replace) {
            $this->c->resetOption('attributes');
            $this->c->resetOption('fillable');
            $this->c->resetOption('casts');
            $this->c->resetOption('filters');
            $this->c->resetOption('sortable');
        }

        $this->buildClass_skeleton_prepare($create);

        $this->buildClass_skeleton_ids($create);

        $this->buildClass_skeleton_uniques($create);

        $this->buildClass_skeleton_date($create);

        $this->buildClass_skeleton_permissions($create);

        $this->buildClass_skeleton_status($create);

        $this->buildClass_skeleton_matrix($create);

        $this->buildClass_skeleton_flags($create);

        $this->buildClass_skeleton_columns($create);

        // $this->buildClass_skeleton_defined_columns($create);

        $this->buildClass_skeleton_ui($create);

        $this->buildClass_skeleton_json($create);

        $this->buildClass_skeleton_relationships($create);

        $this->c->apply();
        // dd([
        //     '__METHOD__' => __METHOD__,
        //     '$this->c' => $this->c,
        //     // '$this->c' => $this->c->toArray(),
        // ]);
    }

    protected function buildClass_skeleton_prepare(Create $create): void
    {
        $options = [];
        $options_create = [];
        $table = $this->c->table();

        if (in_array($this->c->type(), [
            'model',
            'playground-model',
        ])) {
            $options_create['timestamps'] = true;
            $options_create['softDeletes'] = true;

            if (! $table && $this->c->model_slug_plural()) {
                $table = sprintf(
                    '%1$s_%2$s',
                    $this->c->module_slug(),
                    Str::of($this->c->model_slug_plural())->slug('_')->toString()
                );
            }

            if (! $this->c->table() && $table) {
                $options['table'] = $table;
            }

            if (! $create->migration() && $table) {
                $date = date('Y_m_d');
                $order = '000000';
                $date = '2020_01_02';
                $order = '100001';
                $options_create['migration'] = sprintf(
                    '%1$s_%2$s_%3$s_%4$s_table',
                    $date,
                    $order,
                    'create',
                    $table
                );
            }
        }

        if (in_array($this->c->type(), [
            'playground-model',
        ])) {
            $options['model_attribute'] = 'title';
            $options['model_attribute_required'] = true;
            $options['scopes'] = [
                'sort' => [
                    'include' => 'minus',
                    // 'builder' => null,
                ],
            ];
        }

        if ($options_create) {
            $create->setOptions($options_create);
        }

        if ($options) {
            $this->c->setOptions($options);
        }

        // dd([
        //     '__METHOD__' => __METHOD__,
        //     '$options_create' => $options_create,
        //     '$options' => $options,
        //     '$this->c' => $this->c,
        // ]);
    }
}
