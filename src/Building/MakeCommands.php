<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Building;

use Illuminate\Support\Str;

/**
 * \Playground\Make\Model\Building\MakeCommands
 */
trait MakeCommands
{
    /**
     * Create a factory file for the model.
     *
     * @see \Playground\Make\Console\Commands\FactoryMakeCommand
     */
    protected function createFactory(): void
    {
        $force = $this->hasOption('force') && $this->option('force');
        $file = $this->option('file') ?: $this->path_to_configuration;

        $namespace = sprintf(
            'Database/Factories/%1$s/Models',
            $this->c->namespace()
        );

        $options = [
            'name' => Str::of(class_basename($this->qualifiedName))
                ->studly()->finish('Factory')->toString(),
            '--namespace' => $namespace,
            '--force' => $force,
            '--package' => $this->c->package(),
            '--organization' => $this->c->organization(),
            '--model' => $this->c->model(),
            '--module' => $this->c->module(),
            '--type' => $this->c->type(),
        ];

        if (! empty($file) && is_string($file)) {
            $options['--model-file'] = $file;
        }

        if ($this->c->recipe()) {
            $options['--recipe'] = $this->c->recipe();
        }

        if (! $this->hasOption('skeleton') && $this->option('skeleton')) {
            $options['--skeleton'] = true;
        }

        $this->call('playground:make:factory', $options);
    }

    /**
     * Create a migration file for the model.
     *
     * @see MigrationMakeCommand
     */
    protected function createMigration(): void
    {
        $force = $this->hasOption('force') && $this->option('force');
        $file = $this->option('file') ?: $this->path_to_configuration;

        $options = [
            'name' => $this->c->name(),
            '--namespace' => $this->c->namespace(),
            '--force' => $force,
            '--package' => $this->c->package(),
            '--organization' => $this->c->organization(),
            '--model' => $this->c->model(),
            '--module' => $this->c->module(),
            '--model-file' => $file,
            '--type' => $this->c->type(),
            '--create' => true,
        ];

        if (! empty($file) && is_string($file)) {
            $options['--model-file'] = $file;
        }

        $this->call('playground:make:migration', $options);
    }

    /**
     * Create a controller for the model.
     *
     * @see PolicyMakeCommand
     * @see SeederMakeCommand
     * @see TestMakeCommand
     */
    protected function createController(): void
    {
        $resource = $this->hasOption('resource') && $this->option('resource');
        $force = $this->hasOption('force') && $this->option('force');
        $file = $this->option('file') ?: $this->path_to_configuration;

        $namespace = $this->c->namespace();
        if ($namespace) {
            $namespace = $this->parseClassConfig($namespace);
            if ($this->isApi) {
                $namespace = Str::of($namespace)->finish('/Api')->studly()->toString();
            } elseif ($this->isResource) {
                $namespace = Str::of($namespace)->finish('/Resource')->studly()->toString();
            }
        }
        $package = $this->c->package();
        if ($package && $this->c->playground()) {
            if ($this->isApi) {
                $package = Str::of($package)->finish('-api')->toString();
            } elseif ($this->isResource) {
                $package = Str::of($package)->finish('-resource')->toString();
            }
        }

        $options = [
            'name' => Str::of(class_basename($this->qualifiedName))
                ->studly()->finish('Controller')->toString(),
            '--namespace' => $namespace,
            '--force' => $force,
            '--package' => $package,
            '--organization' => $this->c->organization(),
            '--model' => $this->c->model(),
            '--module' => $this->c->module(),
            // '--module-slug' => $this->c->module_slug(),
            // '--type' => $this->c->type(),
        ];

        if ($this->isApi) {
            $options['--api'] = true;
        } elseif ($this->isResource) {
            $options['--resource'] = true;
        } else {

        }

        if ($this->c->playground()) {
            $options['--playground'] = true;
        }

        if (! empty($file) && is_string($file)) {
            $options['--model-file'] = $file;
        }

        if ($this->c->skeleton()) {
            $options['--skeleton'] = true;
        } else {
            // if ($this->c->requests()) {
            //     $options['--requests'] = true;
            // }
        }

        // dump([
        //     '__METHOD__' => __METHOD__,
        //     '$options' => $options,
        // ]);
        $this->call('playground:make:controller', $options);
    }

    /**
     * Create a policy file for the model.
     *
     * @see PolicyMakeCommand
     */
    protected function createPolicy(): void
    {
        $force = $this->hasOption('force') && $this->option('force');
        $file = $this->option('file') ?: $this->path_to_configuration;

        $options = [
            'name' => Str::of(class_basename($this->qualifiedName))
                ->studly()->finish('Policy')->toString(),
            '--namespace' => $this->c->namespace(),
            '--force' => $force,
            '--package' => $this->c->package(),
            '--organization' => $this->c->organization(),
            '--model' => $this->c->model(),
            '--module' => $this->c->module(),
            '--type' => $this->c->type(),
        ];

        if (! empty($file) && is_string($file)) {
            $options['--model-file'] = $file;
        }

        $this->call('playground:make:policy', $options);
    }

    /**
     * Create a seeder file for the model.
     *
     * @see SeederMakeCommand
     */
    protected function createSeeder(): void
    {
        $force = $this->hasOption('force') && $this->option('force');
        $file = $this->option('file') ?: $this->path_to_configuration;

        $options = [
            'name' => Str::of(class_basename($this->qualifiedName))
                ->studly()->finish('Seeder')->toString(),
            '--namespace' => $this->c->namespace(),
            '--force' => $force,
            '--package' => $this->c->package(),
            '--organization' => $this->c->organization(),
            '--model' => $this->c->model(),
            '--module' => $this->c->module(),
            '--type' => $this->c->type(),
        ];

        if (! empty($file) && is_string($file)) {
            $options['--model-file'] = $file;
        }

        $this->call('playground:make:seeder', $options);
    }

    // protected bool $createTest = false;

    protected bool $createTest_appendTest = false;

    protected bool $createTest_studly = true;

    /**
     * Create a test file for the model.
     *
     * @return void
     */
    protected function createTest()
    {
        // if ($this->createTest) {
        //     // Test already created.
        //     return;
        // }

        $force = $this->hasOption('force') && $this->option('force');
        $file = $this->option('file') ?: $this->path_to_configuration;

        $name = Str::of(class_basename($this->qualifiedName));

        if ($this->createTest_studly) {
            $name->studly();
        }

        if ($this->createTest_appendTest) {
            $name->finish('Test');
        }

        // $this->c->type()
        $type = 'model';

        $options = [
            'name' => $name->toString(),
            '--namespace' => $this->c->namespace(),
            '--force' => $force,
            '--package' => $this->c->package(),
            '--organization' => $this->c->organization(),
            '--model' => $this->c->model(),
            '--module' => $this->c->module(),
            '--type' => $type,
        ];

        if ($this->c->playground()) {
            $options['--playground'] = true;
        }

        if ($file) {
            $options['--model-file'] = $file;
        }
        // dump([
        //     '__METHOD__' => __METHOD__,
        //     '$options' => $options,
        // ]);

        $options['--suite'] = 'unit';

        $options['--namespace'] = sprintf(
            'Tests/%1$s/%2$s/Models/%3$s',
            'Unit',
            $this->c->namespace(),
            $name,
        );

        $this->call('playground:make:test', $options);

        $options['--suite'] = 'feature';

        $options['--namespace'] = sprintf(
            'Tests/%1$s/%2$s/Models/%3$s',
            'Feature',
            $this->c->namespace(),
            $name,
        );

        $this->call('playground:make:test', $options);

        // $this->createTest = true;
    }
}
