<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Model\Configuration;

use Playground\Make\Configuration\Configuration;

/**
 * \Playground\Make\Model\Configuration\Seeder
 */
class Seeder extends Configuration
{
    // protected string $namespace = 'Database\Seeders';

    protected string $model = '';

    protected string $model_fqdn = '';

    protected string $model_tag = '';

    protected string $model_tagged = '';

    /**
     * @var array<string, mixed>
     */
    protected $properties = [
        'type' => '',
        'model' => '',
        'model_tag' => '',
        'model_tagged' => '',
    ];

    public function apply(): Configuration
    {
        $type = $this->type();

        if ($type === 'abstract-tag') {
            unset($this->properties['model_tag']);
            unset($this->properties['model_tagged']);
        } elseif ($type === 'primary-tag') {
            unset($this->properties['model_tag']);
            unset($this->properties['model_tagged']);
        } elseif ($type === 'secondary-tag') {
            unset($this->properties['model_tag']);
            unset($this->properties['model_tagged']);
        } elseif ($type === 'abstract-doublet') {
            unset($this->properties['model_tag']);
            unset($this->properties['model_tagged']);
        } elseif ($type === 'primary-doublet') {
            unset($this->properties['model_tag']);
            unset($this->properties['model_tagged']);
        } elseif ($type === 'secondary-doublet') {
            unset($this->properties['model_tag']);
            unset($this->properties['model_tagged']);
        } elseif ($type === 'abstract-triplet') {
        } elseif ($type === 'primary-triplet') {
            unset($this->properties['model_tag']);
            unset($this->properties['model_tagged']);
        } elseif ($type === 'secondary-triplet') {
            unset($this->properties['model_tag']);
            unset($this->properties['model_tagged']);
        } elseif ($type === 'tertiary-triplet') {
            unset($this->properties['model_tag']);
            unset($this->properties['model_tagged']);
        }

        return parent::apply();
    }

    /**
     * @param  array<string, mixed>  $options
     */
    public function setOptions(array $options = []): self
    {
        parent::setOptions($options);

        if (! empty($options['model'])
            && is_string($options['model'])
        ) {
            $this->model = $options['model'];
        }

        if (! empty($options['model_fqdn'])
            && is_string($options['model_fqdn'])
        ) {
            $this->model_fqdn = $options['model_fqdn'];
        }

        if (! empty($options['model_tag'])
            && is_string($options['model_tag'])
        ) {
            $this->model_tag = $options['model_tag'];
        }

        if (! empty($options['model_tagged'])
            && is_string($options['model_tagged'])
        ) {
            $this->model_tagged = $options['model_tagged'];
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

    public function model_tag(): string
    {
        return $this->model_tag;
    }

    public function model_tagged(): string
    {
        return $this->model_tagged;
    }
}
