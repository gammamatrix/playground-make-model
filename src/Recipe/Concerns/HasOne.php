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
    protected array $hasOne = [];

    /**
     * @return array<string, array<string, mixed>>
     */
    public function hasOne(): array
    {
        return $this->hasOne;
    }
}
