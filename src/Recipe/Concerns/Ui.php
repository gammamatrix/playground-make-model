<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Recipe\Concerns;

/**
 * \Playground\Make\Model\Recipe\Concerns\Ui
 */
trait Ui
{
    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $ui = [
        'icon' => [
            'type' => 'string',
            'size' => 128,
            'default' => '',
        ],
        'image' => [
            'type' => 'string',
            'default' => '',
            'size' => 512,
        ],
        'avatar' => [
            'type' => 'string',
            'default' => '',
            'size' => 512,
        ],
        'ui' => [
            'default' => '{}',
            'type' => 'JSON_OBJECT',
            'nullable' => true,
        ],
    ];

    /**
     * @return array<string, array<string, mixed>>
     */
    public function ui(): array
    {
        return $this->ui;
    }
}
