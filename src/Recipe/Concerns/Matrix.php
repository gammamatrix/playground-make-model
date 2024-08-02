<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Recipe\Concerns;

/**
 * \Playground\Make\Model\Recipe\Concerns\Matrix
 */
trait Matrix
{
    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $matrix = [
        'matrix' => [
            'column' => 'matrix',
            'label' => '',
            'description' => '',
            'icon' => '',
            'default' => '{}',
            'index' => false,
            'nullable' => true,
            'readOnly' => false,
            'type' => 'JSON_OBJECT',
        ],
        'x' => [
            'column' => 'x',
            'label' => '',
            'description' => '',
            'icon' => '',
            'default' => null,
            'index' => false,
            'nullable' => true,
            'readOnly' => false,
            'type' => 'bigInteger',
            'unsigned' => false,
        ],
        'y' => [
            'column' => 'y',
            'label' => '',
            'description' => '',
            'icon' => '',
            'default' => null,
            'index' => false,
            'nullable' => true,
            'readOnly' => false,
            'type' => 'bigInteger',
            'unsigned' => false,
        ],
        'z' => [
            'column' => 'z',
            'label' => '',
            'description' => '',
            'icon' => '',
            'default' => null,
            'index' => false,
            'nullable' => true,
            'readOnly' => false,
            'type' => 'bigInteger',
            'unsigned' => false,
        ],
        'r' => [
            'column' => 'r',
            'label' => '',
            'description' => '',
            'icon' => '',
            'default' => null,
            'index' => false,
            'nullable' => true,
            'readOnly' => false,
            'type' => 'decimal',
            'precision' => 65,
            'scale' => 10,
        ],
        'theta' => [
            'column' => 'theta',
            'label' => '',
            'description' => '',
            'icon' => '',
            'default' => null,
            'index' => false,
            'nullable' => true,
            'readOnly' => false,
            'type' => 'decimal',
            'precision' => 10,
            'scale' => 6,
        ],
        'rho' => [
            'column' => 'rho',
            'label' => '',
            'description' => '',
            'icon' => '',
            'default' => null,
            'index' => false,
            'nullable' => true,
            'readOnly' => false,
            'type' => 'decimal',
            'precision' => 10,
            'scale' => 6,
        ],
        'phi' => [
            'column' => 'phi',
            'label' => '',
            'description' => '',
            'icon' => '',
            'default' => null,
            'index' => false,
            'nullable' => true,
            'readOnly' => false,
            'type' => 'decimal',
            'precision' => 10,
            'scale' => 6,
        ],
        'elevation' => [
            'column' => 'elevation',
            'label' => '',
            'description' => '',
            'icon' => '',
            'default' => null,
            'index' => false,
            'nullable' => true,
            'readOnly' => false,
            'type' => 'decimal',
            'precision' => 65,
            'scale' => 10,
        ],
        'latitude' => [
            'column' => 'latitude',
            'label' => '',
            'description' => '',
            'icon' => '',
            'default' => null,
            'index' => false,
            'nullable' => true,
            'readOnly' => false,
            'type' => 'decimal',
            'precision' => 8,
            'scale' => 6,
        ],
        'longitude' => [
            'column' => 'longitude',
            'label' => '',
            'description' => '',
            'icon' => '',
            'default' => null,
            'index' => false,
            'nullable' => true,
            'readOnly' => false,
            'type' => 'decimal',
            'precision' => 9,
            'scale' => 6,
        ],
    ];

    /**
     * @return array<string, array<string, mixed>>
     */
    public function matrix(): array
    {
        return $this->matrix;
    }
}
