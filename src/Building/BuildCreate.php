<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Building;

use Playground\Make\Configuration\Model\Create;

/**
 * \Playground\Make\Model\Building\BuildModel
 */
trait BuildCreate
{
    protected function buildClass_model_create(string $name, string $type): Create
    {
        if (empty($name) || empty($type)) {
            throw new \Exception(sprintf(
                'ModelSkeletonCreateMakeTrait::buildClass_model_create(string $name {%1$s}, string $type {%2$s}) - expecting a valid name and type.',
                $name,
                $type
            ));
        }

        $create = $this->c->create() ?? $this->c->addCreate();

        return $create;
    }
}
