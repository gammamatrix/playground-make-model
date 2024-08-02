<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Building\Skeleton;

use Playground\Make\Configuration\Model\Create;

/**
 * \Playground\Make\Model\Building\Skeleton\MakeRelationships
 */
trait MakeRelationships
{
    protected function buildClass_skeleton_relationships(Create $create): void
    {
        $this->components->info(sprintf('Skeleton relationships for [%s]', $this->c->name()));

        if ($this->recipe->hasMany()) {
            $this->buildClass_skeleton_relationships_hasMany($create);
        }

        if ($this->recipe->hasOne()) {
            $this->buildClass_skeleton_relationships_hasOne($create);
        }
    }

    protected function buildClass_skeleton_relationships_hasMany(Create $create): void
    {
        $this->components->info(sprintf('Skeleton relationships [hasMany] for [%s]', $this->c->name()));

        foreach ($this->recipe->hasMany() as $accessor => $meta) {
            // dump([
            //     '__METHOD__' => __METHOD__,
            //     '$accessor' => $accessor,
            //     '$meta' => $meta,
            //     '$this->recipe->name()' => $this->recipe->name(),
            // ]);
            $this->c->addHasMany($accessor, $meta);
        }
    }

    protected function buildClass_skeleton_relationships_hasOne(Create $create): void
    {
        $this->components->info(sprintf('Skeleton relationships [hasOne] for [%s]', $this->c->name()));

        foreach ($this->recipe->hasOne() as $accessor => $meta) {
            $this->c->addHasOne($accessor, $meta);
            // dump([
            //     '__METHOD__' => __METHOD__,
            //     '$accessor' => $accessor,
            //     '$meta' => $meta,
            //     '$this->recipe->name()' => $this->recipe->name(),
            // ]);
        }
    }
}
