<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Console\Commands;

use Illuminate\Support\Str;
use Playground\Make\Configuration\Contracts\PrimaryConfiguration as PrimaryConfigurationContract;
use Playground\Make\Console\Commands\GeneratorCommand;
use Playground\Make\Model\Building;
use Playground\Make\Model\Configuration\Factory as Configuration;
use Playground\Make\Model\Console\Commands\Concerns\Recipes as ConcernsRecipes;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputOption;

/**
 * \Playground\Make\Model\Console\Commands\FactoryMakeCommand
 */
#[AsCommand(name: 'playground:make:factory')]
class FactoryMakeCommand extends GeneratorCommand
{
    use Building\Factory\BuildStates;
    use ConcernsRecipes;

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
        'states' => '',
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
        return sprintf('\\Database\\Factories\\%1$s', trim($this->parseClassInput($rootNamespace), '\\'));
    }

    public function prepareOptions(): void
    {
        $options = $this->options();

        $type = $this->getConfigurationType();
        if (! $type) {
            $this->c->setOptions([
                'type' => 'model',
            ]);
        }

        $this->handleRecipe($this->c->name(), $type);
        // dd([
        //     '__METHOD__' => __METHOD__,
        //     '$type' => $type,
        //     '$this->c->name()' => $this->c->name(),
        //     '$this->c' => $this->c,
        //     '$this->options()' => $this->options(),
        //     '$this->searches' => $this->searches,
        // ]);
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

        $this->buildClass_states();

        $this->applyConfigurationToSearch();

        // dd([
        //     '__METHOD__' => __METHOD__,
        //     '$this->c' => $this->c,
        //     '$this->options()' => $this->options(),
        //     '$this->searches' => $this->searches,
        //     '$this->qualifiedName' => $this->qualifiedName,
        // ]);
        return parent::buildClass($name);
    }

    /**
     * Get the console command arguments.
     *
     * @return array<int, mixed>
     */
    protected function getOptions(): array
    {
        $options = parent::getOptions();

        $options[] = ['recipe', null, InputOption::VALUE_OPTIONAL, 'The configuration recipe of the '.strtolower($this->type)];

        return $options;
    }
}
