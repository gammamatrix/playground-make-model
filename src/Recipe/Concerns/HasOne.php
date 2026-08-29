<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Model\Recipe\Concerns;

/**
 * \Playground\Make\Model\Recipe\Concerns\HasOne
 */
trait HasOne
{
    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $circletHasOne = [];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $hasOne = [];

    /**
     * @return array<string, array<string, mixed>>
     */
    public function hasOne(): array
    {
        return $this->hasOne;
    }

    public function handleCircletHasOne(): void
    {
        if (! in_array($this->name, [
            'Tagged',
        ]) && empty($this->circletHasOne[$this->name])
        ) {
            return;
        }
        $has_one_accessor = $this->name_camel;
        // dd([
        //    '__METHOD__' => __METHOD__,
        //    '$this' => $this,
        //    '$has_one_accessor' => $has_one_accessor,
        //    '$this->table_id' => $this->table_id,
        //    '$this->name' => $this->name,
        //    '$this->name_lower' => $this->name_lower,
        //    '$this->name_snake' => $this->name_snake,
        //    '$this->name_camel' => $this->name_camel,
        //    '$this->type' => $this->type,
        //    '$this->ids' => $this->ids,
        //    '$this->circletHasOne' => $this->circletHasOne,
        //    '$this->hasOne' => $this->hasOne,
        //    '$this->allIds' => $this->allIds,
        // ]);
        $this->hasOne = $this->circletHasOne;
        unset($this->hasOne[$has_one_accessor]);
        $this->ids = $this->allIds;
        unset($this->ids[$this->table_id]);
        foreach ($this->hasOne as $accessor => $meta) {
            if (! empty($meta['comment']) && is_string($meta['comment'])) {
                $this->hasOne[$accessor]['comment'] = sprintf(
                    $meta['comment'],
                    $this->name_lower
                );
            }
        }
    }
}
