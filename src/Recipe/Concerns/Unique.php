<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Recipe\Concerns;

/**
 * \Playground\Make\Model\Recipe\Concerns\Unique
 */
trait Unique
{
    /**
     * @var array<string, array<int, string>>
     */
    protected array $unique = [
        'keys' => [
            'slug',
            'parent_id',
        ],
    ];

    /**
     * @return array<string, array<int, string>>
     */
    public function unique(): array
    {
        return $this->unique;
    }
}
