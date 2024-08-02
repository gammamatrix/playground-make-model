<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Recipe\Concerns;

/**
 * \Playground\Make\Model\Recipe\Concerns\Status
 */
trait Status
{
    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $status = [
        'status' => [
            'type' => 'bigInteger',
            'default' => 0,
            'unsigned' => true,
            'icon' => '',
        ],
        'rank' => [
            'type' => 'bigInteger',
            'default' => 0,
            'unsigned' => false,
            'icon' => '',
        ],
        'size' => [
            'type' => 'bigInteger',
            'default' => 0,
            'unsigned' => false,
            'icon' => '',
        ],
    ];

    /**
     * @return array<string, array<string, mixed>>
     */
    public function status(): array
    {
        return $this->status;
    }
}
