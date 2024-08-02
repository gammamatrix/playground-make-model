<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Recipe;

/**
 * \Playground\Make\Model\Recipe\Playground
 */
class Playground extends Model
{
    protected string $primary = 'uuid';

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $dates = [
        'canceled_at' => [
            'nullable' => true,
            'index' => false,
        ],
        'closed_at' => [
            'nullable' => true,
            'index' => true,
        ],
        'suspended_at' => [
            'nullable' => true,
            'index' => false,
        ],
        'timer_end_at' => [
            'nullable' => true,
            'index' => true,
        ],
        'timer_start_at' => [
            'nullable' => true,
            'index' => true,
        ],
    ];
}
