<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Model\Recipe\Concerns;

/**
 * \Playground\Make\Model\Recipe\Concerns\HasMany
 */
trait HasMany
{
    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $circletHasMany = [];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $hasMany = [];

    /**
     * @return array<string, array<string, mixed>>
     */
    public function hasMany(): array
    {
        return $this->hasMany;
    }

    public function handleCircletHasMany(): void
    {
        $has_many_accessor = $this->name_camels;
        // dd([
        //    '__METHOD__' => __METHOD__,
        //    //'$this' => $this,
        //    '$has_many_accessor' => $has_many_accessor,
        //    '$this->table_id' => $this->table_id,
        //    '$this->name' => $this->name,
        //    '$this->name_lower' => $this->name_lower,
        //     '$this->name_snake' => $this->name_snake,
        //     '$this->name_snakes' => $this->name_snakes,
        //     '$this->name_camel' => $this->name_camel,
        //     '$this->name_camels' => $this->name_camels,
        //    '$this->type' => $this->type,
        //    '$this->ids' => $this->ids,
        //    '$this->circletHasMany' => $this->circletHasMany,
        //    '$this->hasMany' => $this->hasMany,
        //    '$this->allIds' => $this->allIds,
        // ]);
        $this->hasMany = $this->circletHasMany;
        unset($this->hasMany[$has_many_accessor]);
        foreach ($this->hasMany as $accessor => $meta) {
            $this->hasMany[$accessor]['foreignKey'] = $this->table_id;
            if (! empty($meta['comment']) && is_string($meta['comment'])) {
                $this->hasMany[$accessor]['comment'] = sprintf(
                    $meta['comment'],
                    $this->name_lower
                );
            }
        }
    }
}
