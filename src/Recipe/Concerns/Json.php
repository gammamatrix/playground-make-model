<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Recipe\Concerns;

/**
 * \Playground\Make\Model\Recipe\Concerns\Json
 */
trait Json
{
    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $json = [
        'assets' => [
            'default' => '{}',
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
        'meta' => [
            'default' => '{}',
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
        'notes' => [
            'default' => '[]',
            'readOnly' => true,
            'nullable' => true,
            'type' => 'JSON_ARRAY',
            'comment' => 'Array of note objects',
        ],
        'options' => [
            'default' => '{}',
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
        'sources' => [
            'default' => '{}',
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
    ];

    /**
     * @return array<string, array<string, mixed>>
     */
    public function json(): array
    {
        ksort($this->json);

        return $this->json;
    }
}
