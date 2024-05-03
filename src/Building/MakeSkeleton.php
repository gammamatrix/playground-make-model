<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Building;

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

        $this->buildClass_skeleton_ids($create);

        $this->buildClass_skeleton_uniques($create);

        $this->buildClass_skeleton_timestamps($create);

        $this->buildClass_skeleton_softDeletes($create);

        $this->buildClass_skeleton_dates($create);

        $this->buildClass_skeleton_permissions($create);

        $this->buildClass_skeleton_status($create);

        $this->buildClass_skeleton_matrix($create);

        $this->buildClass_skeleton_flags($create);

        $this->buildClass_skeleton_columns($create);

        $this->buildClass_skeleton_defined_columns($create);

        $this->buildClass_skeleton_ui($create);

        $this->buildClass_skeleton_json($create);
    }
}
