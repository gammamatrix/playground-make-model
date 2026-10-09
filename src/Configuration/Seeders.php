<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Model\Configuration;

use Playground\Make\Configuration\PrimaryConfiguration;

/**
 * \Playground\Make\Model\Configuration\Seeder
 */
class Seeders extends PrimaryConfiguration
{
    protected string $recipe = '';

    /**
     * @var array<string, mixed>
     */
    protected $properties = [
        'class' => '',
        'config' => '',
        'fqdn' => '',
        'extends' => '',
        'module' => '',
        'module_slug' => '',
        'name' => '',
        'namespace' => '',
        'organization' => '',
        'package' => '',
        // properties
        'model' => '',
        // 'model_fqdn' => '',
        'type' => '',
    ];

    /**
     * @param  array<string, mixed>  $options
     */
    public function setOptions(array $options = []): self
    {
        parent::setOptions($options);

        if (! empty($options['recipe'])
            && is_string($options['recipe'])
        ) {
            $this->recipe = $options['recipe'];
        }

        return $this;
    }

    public function recipe(): string
    {
        return $this->recipe;
    }
}
