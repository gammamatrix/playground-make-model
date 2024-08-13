<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Recipe\Views;

/**
 * \Playground\Make\Model\Recipe\Views\Index
 */
class Index
{
    protected bool $addMatrix = false;

    protected bool $addModelType = true;

    /**
     * @var array<int, string>
     */
    protected array $columnsMobile = [
        'title',
        'slug',
        'description',
        'published',
    ];

    /**
     * @var array<int, string>
     */
    protected array $columnsStandard = [
        'title',
        'slug',
        'label',
        'description',
        'published',
        'revision',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array<int, string>
     */
    protected array $columnsViewable = [
        // All columns except big or complex values, such as JSON, HTML,...
    ];

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(array $options = [])
    {
        $this->addMatrix = ! empty($options['addMatrix']);

        if (array_key_exists('addModelType', $options)) {
            // addModelType is enabled by default.
            $this->addModelType = ! empty($options['addModelType']);
        }

        if (! empty($options['columnsMobile'])
            && is_array($options['columnsMobile'])
        ) {
            $this->columnsMobile = [];
            foreach ($options['columnsMobile'] as $column) {
                if ($column
                    && is_string($column)
                    && ! in_array($column, $this->columnsMobile)
                ) {
                    $this->columnsMobile[] = $column;
                }
            }
        }

        if (! empty($options['columnsStandard'])
            && is_array($options['columnsStandard'])
        ) {
            $this->columnsStandard = [];
            foreach ($options['columnsStandard'] as $column) {
                if ($column
                    && is_string($column)
                    && ! in_array($column, $this->columnsStandard)
                ) {
                    $this->columnsStandard[] = $column;
                }
            }
        }

        if (! empty($options['columnsViewable'])
            && is_array($options['columnsViewable'])
        ) {
            $this->columnsViewable = [];
            foreach ($options['columnsViewable'] as $column) {
                if ($column
                    && is_string($column)
                    && ! in_array($column, $this->columnsViewable)
                ) {
                    $this->columnsViewable[] = $column;
                }
            }
        }
    }

    /**
     * @return array<int, string>
     */
    public function columnsMobile(): array
    {
        return $this->columnsMobile;
    }

    /**
     * @return array<int, string>
     */
    public function columnsStandard(): array
    {
        return $this->columnsStandard;
    }

    /**
     * @return array<int, string>
     */
    public function columnsViewable(): array
    {
        return $this->columnsViewable;
    }

    public function addModelType(): bool
    {
        return $this->addModelType;
    }

    public function addMatrix(): bool
    {
        return $this->addMatrix;
    }
}
