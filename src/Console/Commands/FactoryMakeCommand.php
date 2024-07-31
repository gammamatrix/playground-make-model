<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Console\Commands;

use Illuminate\Support\Str;
use Playground\Make\Configuration\Contracts\PrimaryConfiguration as PrimaryConfigurationContract;
use Playground\Make\Console\Commands\GeneratorCommand;
use Playground\Make\Model\Configuration\Factory as Configuration;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputOption;

/**
 * \Playground\Make\Model\Console\Commands\FactoryMakeCommand
 */
#[AsCommand(name: 'playground:make:factory')]
class FactoryMakeCommand extends GeneratorCommand
{
    /**
     * @var class-string<Configuration>
     */
    public const CONF = Configuration::class;

    /**
     * @var PrimaryConfigurationContract&Configuration
     */
    protected PrimaryConfigurationContract $c;

    const SEARCH = [
        'class' => '',
        'module' => '',
        'module_slug' => '',
        'namespace' => 'App',
        'extends' => '',
        'implements' => '',
        'organization' => '',
        'model_fqdn' => '',
        'columns' => '',
        'use' => '',
        // 'use_class' => '    use HasFactory;',
        'use_class' => '',
        // 'table' => '',
        // 'property_table' => '',
        // 'perPage' => PHP_EOL.PHP_EOL.'    protected $perPage = 25;',
        // 'attributes' => '',
        // 'casts' => '',
        // 'fillable' => '',
        // 'perPage' => '',
        // 'HasMany' => '',
        // 'HasOne' => '',
        // 'scopes' => '',
        // 'filters' => '',
    ];

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'playground:make:factory';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new model factory';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Factory';

    protected string $path_destination_folder = 'database/factories';

    protected function getConfigurationFilename(): string
    {
        return sprintf(
            '%1$s/%2$s.json',
            Str::of($this->c->name())->before('Factory')->kebab(),
            Str::of($this->getType())->kebab(),
        );
    }

    /**
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        $template = 'model/factory.stub';

        return $this->resolveStubPath($template);
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        // dd([
        //     '__METHOD__' => __METHOD__,
        //     '$this->configuration' => $this->configuration,
        //     '$this->options()' => $this->options(),
        //     // '$this->searches' => $this->searches,
        //     '$this->qualifiedName' => $this->qualifiedName,
        //     // '$table' => $table,
        //     '$rootNamespace' => $rootNamespace,
        //     'test' => $this->parseClassInput($rootNamespace),
        // ]);
        return sprintf('\\Database\\Factories\\%1$s', trim($this->parseClassInput($rootNamespace), '\\'));
        // return $rootNamespace.'\\Models';
        // return is_dir(app_path('Models')) ? $rootNamespace.'\\Models' : $rootNamespace;
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     */
    protected function buildClass($name): string
    {
        $model_fqdn = $this->model?->fqdn();

        if (! $model_fqdn) {
            $model_fqdn = sprintf(
                '%1$s\\%2$s',
                $this->rootNamespace(),
                Str::of($name)->studly()
            );
        }

        $this->c->setOptions([
            'model_fqdn' => $model_fqdn,
        ]);

        $this->applyConfigurationToSearch();

        // dd([
        //     '__METHOD__' => __METHOD__,
        //     '$this->c' => $this->c,
        //     '$this->options()' => $this->options(),
        //     '$this->searches' => $this->searches,
        //     '$this->qualifiedName' => $this->qualifiedName,
        // ]);
        return parent::buildClass($name);

        // $factory = class_basename(Str::ucfirst(str_replace('Factory', '', $name)));

        // $namespaceModel = $this->option('model')
        //                 ? $this->qualifyModel($this->option('model'))
        //                 : $this->qualifyModel($this->guessModelName($name));

        // $model = class_basename($namespaceModel);

        // $namespace = $this->getNamespace(
        //     Str::replaceFirst($this->rootNamespace(), 'Database\\Factories\\', $this->qualifyClass($this->getNameInput()))
        // );

        // $replace = [
        //     '{{ factoryNamespace }}' => $namespace,
        //     'NamespacedDummyModel' => $namespaceModel,
        //     '{{ namespacedModel }}' => $namespaceModel,
        //     '{{namespacedModel}}' => $namespaceModel,
        //     'DummyModel' => $model,
        //     '{{ model }}' => $model,
        //     '{{model}}' => $model,
        //     '{{ factory }}' => $factory,
        //     '{{factory}}' => $factory,
        // ];

        // return str_replace(
        //     array_keys($replace),
        //     array_values($replace),
        //     parent::buildClass($name)
        // );
    }

    // /**
    //  * Get the destination class path.
    //  *
    //  * @param  string  $name
    //  */
    // protected function getPath($name): string
    // {
    //     $path = sprintf(
    //         '%1$s/%2$s.php',
    //         $this->folder(),
    //         $this->c->class()
    //     );

    //     return $this->laravel->storagePath().$path;
    // }

    // /**
    //  * Guess the model name from the Factory name or return a default model name.
    //  *
    //  * @param  string  $name
    //  */
    // protected function guessModelName($name): string
    // {
    //     if (str_ends_with($name, 'Factory')) {
    //         $name = substr($name, 0, -7);
    //     }

    //     $modelName = $this->qualifyModel(Str::after($name, $this->rootNamespace()));

    //     if (class_exists($modelName)) {
    //         return $modelName;
    //     }

    //     if (is_dir(app_path('Models/'))) {
    //         return $this->rootNamespace().'Models\Model';
    //     }

    //     return $this->rootNamespace().'Model';
    // }

    // /**
    //  * Get the console command options.
    //  *
    //  * @return array
    //  */
    // protected function getOptions()
    // {
    //     return [
    //         ['model', 'm', InputOption::VALUE_OPTIONAL, 'The name of the model'],
    //     ];
    // }
}
