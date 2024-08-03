<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Configuration;

use Playground\Make\Configuration\PrimaryConfiguration;

/**
 * \Playground\Make\Model\Configuration\Factory
 */
class Factory extends PrimaryConfiguration
{
    protected string $model = '';

    protected string $model_fqdn = '';

    protected string $recipe = '';

    /**
     * @var array<string, string>
     */
    protected array $models = [];

    /**
     * @var array<string, mixed>
     */
    protected $properties = [
        'class' => '',
        'config' => '',
        'fqdn' => '',
        'module' => '',
        'module_slug' => '',
        'name' => '',
        'namespace' => '',
        'organization' => '',
        'package' => '',
        // properties
        'model' => '',
        'model_fqdn' => '',
        'recipe' => '',
        'type' => '',
        'models' => [],
    ];

    /**
     * @param array<string, mixed> $options
     */
    public function setOptions(array $options = []): self
    {
        parent::setOptions($options);

        if (! empty($options['model_fqdn'])
            && is_string($options['model_fqdn'])
        ) {
            $this->model_fqdn = $options['model_fqdn'];
        }

        if (! empty($options['recipe'])
            && is_string($options['recipe'])
        ) {
            $this->recipe = $options['recipe'];
        }

        $this->addModels($options);

        return $this;
    }

    /**
     * @param array<string, mixed> $options
     */
    public function addModels(array $options): self
    {
        if (! empty($options['models'])
            && is_array($options['models'])
        ) {
            foreach ($options['models'] as $key => $file) {
                $this->addMappedClassTo('models', $key, $file);
            }
        }

        return $this;
    }

    public function model(): string
    {
        return $this->model;
    }

    public function model_fqdn(): string
    {
        return $this->model_fqdn;
    }

    /**
     * @return array<string, string>
     */
    public function models(): array
    {
        return $this->models;
    }

    public function recipe(): string
    {
        return $this->recipe;
    }
}
