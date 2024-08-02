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
    protected array $hasMany = [];

    /**
     * @return array<string, array<string, mixed>>
     */
    public function hasMany(): array
    {
        return $this->hasMany;
    }
}
