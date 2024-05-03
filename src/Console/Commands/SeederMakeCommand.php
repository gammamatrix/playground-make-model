<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Console\Commands;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Playground\Make\Configuration\Contracts\PrimaryConfiguration as PrimaryConfigurationContract;
use Playground\Make\Console\Commands\GeneratorCommand;
use Playground\Make\Model\Configuration\Seeder as Configuration;
use Symfony\Component\Console\Attribute\AsCommand;

/**
 * \Playground\Make\Model\Console\Commands\SeederMakeCommand
 */
#[AsCommand(name: 'playground:make:seeder')]
class SeederMakeCommand extends GeneratorCommand
{
    /**
     * @var class-string<Configuration>
     */
    public const CONF = Configuration::class;

    /**
     * @var PrimaryConfigurationContract&Configuration
     */
    protected PrimaryConfigurationContract $c;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'playground:make:seeder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new seeder class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Seeder';

    protected string $path_destination_folder = 'database/seeders';

    /**
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        return $this->resolveStubPath('laravel/seeder.stub');
    }

    protected function getConfigurationFilename(): string
    {
        return sprintf(
            '%1$s/%2$s.json',
            Str::of($this->c->name())->before('Seeder')->kebab(),
            Str::of($this->getType())->kebab(),
        );
    }

    // /**
    //  * Get the root namespace for the class.
    //  *
    //  * @return string
    //  */
    // protected function rootNamespace()
    // {
    //     return 'Database\Seeders\\';
    // }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        $namespace = 'Database\\Seeders';

        if ($rootNamespace && is_string($rootNamespace) && ! in_array(
            $rootNamespace, [
                'app',
                'App',
            ]
        )) {
            $namespace = Str::of($namespace)
                ->finish('\\')
                ->append($this->parseClassInput($rootNamespace))
                ->toString();
        }

        return $namespace;

    }

    /**
     * Resolve the fully-qualified path to the stub.
     *
     * @param  string  $stub
     */
    protected function resolveStubPath($stub): string
    {
        $path = '';
        $stub_path = config('playground-make.paths.stubs');
        if (! empty($stub_path)
            && is_string($stub_path)
        ) {
            if (! is_dir($stub_path)) {
                Log::error(__('playground-make::generator.path.invalid'), [
                    '$stub_path' => $stub_path,
                    '$stub' => $stub,
                ]);
            } else {
                $path = sprintf(
                    '%1$s/%2$s',
                    // Str::of($stub_path)->finish('/')->toString(),
                    Str::of($stub_path)->toString(),
                    $stub
                );
            }
        }

        if (empty($path)) {
            $path = sprintf(
                '%1$s/resources/stubs/%2$s',
                dirname(dirname(dirname(__DIR__))),
                $stub
            );
        }

        if (! file_exists($path)) {
            $this->components->error(__('playground-make::generator.stub.missing', [
                'stub_path' => is_string($stub_path) ? $stub_path : gettype($stub_path),
                'stub' => $stub,
                'path' => $path,
            ]));
        }

        return $path;
    }
}
