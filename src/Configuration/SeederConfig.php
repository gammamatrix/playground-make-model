<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Model\Configuration;

use Playground\Make\Configuration\Configuration;

/**
 * \Playground\Make\Model\Configuration\SeederConfig
 */
class SeederConfig extends Configuration
{
    protected string $file = '';

    protected string $type = '';

    protected string $seeder = '';

    protected string $data = '';

    /**
     * @var array<string, mixed>
     */
    protected $properties = [
        'type' => '',
        'seeder' => '',
        'data' => '',
    ];

    /**
     * @param  array<string, mixed>  $options
     */
    public function setOptions(array $options = []): self
    {
        if (! empty($options['type'])
            && is_string($options['type'])
        ) {
            $this->type = $options['type'];
        }

        if (! empty($options['seeder'])
            && is_string($options['seeder'])
        ) {
            $this->seeder = $options['seeder'];
        }
        if (! empty($options['data'])
            && is_string($options['data'])
        ) {
            $this->data = $options['data'];
        }

        return $this;
    }

    public function file(): string
    {
        return $this->file;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function seeder(): string
    {
        return $this->seeder;
    }

    public function data(): string
    {
        return $this->data;
    }
}
