<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Recipe\Concerns;

/**
 * \Playground\Make\Model\Recipe\Concerns\FactoryStates
 */
trait FactoryStates
{
    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $factoryStates = [
    ];

    /**
     * @return array<string, array<string, mixed>>
     */
    public function factoryStates(): array
    {
        return $this->factoryStates;
    }
}
