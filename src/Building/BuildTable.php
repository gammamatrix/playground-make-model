<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Building;

use Illuminate\Support\Str;

/**
 * \Playground\Make\Model\Building\BuildTable
 */
trait BuildTable
{
    protected function buildClass_model_table(): void
    {
        // dd([
        //     '__METHOD__' => __METHOD__,
        //     '$this->c' => $this->c,
        // ]);
        $options = [];

        $type = $this->c->type() ?: 'model';
        $name = $this->c->name() ?: '';

        if (! $this->c->model_fqdn()) {
            $this->searches['model_fqdn'] = $this->c->fqdn() ?: '';
        }

        if (! $this->c->model() && $name) {
            $options['model'] = $name;
            // $this->searches['model'] = $options['model'];
        }

        if (! $this->c->model_slug() && $name) {
            $options['model_slug'] = Str::of($name)->kebab()->slug()->toString();
            // $this->searches['model_slug'] = $options['model_slug'];
        }

        if (! $this->c->model_singular() && $name) {
            $options['model_singular'] = $name;
        }

        if (! $this->c->model_plural() && $name) {
            $options['model_plural'] = Str::of($name)->plural()->toString();
            // $this->searches['model_plural'] = $options['model_plural'];
        }

        if (! $this->c->model_slug_plural() && $name) {
            $options['model_slug_plural'] = Str::of($name)->plural()->kebab()->slug()->toString();
            // $this->searches['model_slug_plural'] = $options['model_slug_plural'];
        }
        // dump([
        //     '__METHOD__' => __METHOD__,
        //     '$options[model_slug_plural]' => $options['model_slug_plural'],
        // ]);

        if (! $this->c->extends()) {
            if (in_array($type, [
                'playground',
                'playground-abstract',
                'playground-model',
            ])) {
                $options['extends_use'] = 'Playground/Models/Model';
                $options['extends'] = 'Model';
                // $this->searches['extends'] = 'Model';
            } elseif (in_array($type, [
                'playground-resource',
                'playground-api',
            ])) {
                $options['extends_use'] = 'AbstractModel';
            } else {
                $options['extends_use'] = 'Illuminate/Database/Eloquent/Model';
                $options['extends'] = 'Model';
                // $this->searches['extends'] = 'Model';
            }
        }

        if ($options) {
            $this->c->setOptions($options);
            $this->c->apply();
        }
        // dd([
        //     '__METHOD__' => __METHOD__,
        //     '$options' => $options,
        //     '$this->c' => $this->c,
        // ]);
    }

    protected function buildClass_table_property(): void
    {
        $table = $this->c->table();

        $this->searches['property_table'] = ! empty($this->searches['use_class']) ? PHP_EOL : '';

        if (! empty($table)) {
            $this->searches['table'] = $table;

            $this->searches['property_table'] = sprintf(
                '    protected $table = \'%1$s\';',
                $table
            );
            $this->searches['property_table'] .= PHP_EOL;
        } else {
            $this->searches['property_table'] = '';
        }
    }
}
