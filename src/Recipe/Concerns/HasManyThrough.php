<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Model\Recipe\Concerns;

/**
 * \Playground\Make\Model\Recipe\Concerns\HasManyThrough
 */
trait HasManyThrough
{
    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $hasManyThrough = [];

    /**
     * @return array<string, array<string, mixed>>
     */
    public function hasManyThrough(): array
    {
        return $this->hasManyThrough;
    }

    public function handleHasManyThrough(): void
    {
        foreach ($this->hasManyThrough as $accessor => $meta) {
            $this->hasManyThrough[$accessor]['firstKey'] = $this->table_id;
            if (! empty($meta['comment']) && is_string($meta['comment'])) {
                $this->hasManyThrough[$accessor]['comment'] = sprintf(
                    $meta['comment'],
                    $this->name_lower
                );
            }
        }
    }
}
