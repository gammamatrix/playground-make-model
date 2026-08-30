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
        $has_one_accessor = $this->name_camel;
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
