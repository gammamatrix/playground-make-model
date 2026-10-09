<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Model\Console\Commands;

use Illuminate\Support\Str;
use Playground\Make\Configuration\Contracts\PrimaryConfiguration as PrimaryConfigurationContract;
use Playground\Make\Console\Commands\GeneratorCommand;
use Playground\Make\Model\Building\Seeder\BuildSeeders;
use Playground\Make\Model\Configuration\Seeders as Configuration;
use Playground\Make\Model\Console\Commands\Concerns\Recipes as ConcernsRecipes;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputOption;

/**
 * \Playground\Make\Model\Console\Commands\SeederMakeCommand
 */
#[AsCommand(name: 'playground:make:seeder')]
class SeederMakeCommand extends GeneratorCommand
{
    use BuildSeeders;
    use ConcernsRecipes;

    /**
     * @var class-string<Configuration>
     */
    public const CONF = Configuration::class;

    /**
     * @var PrimaryConfigurationContract&Configuration
     */
    protected PrimaryConfigurationContract $c;

    /**
     * NOTE: copied from Model
     */
    const SEARCH = [
        'class' => '',
        'module' => '',
        'module_slug' => '',
        'module_slugs' => '',
        'namespace' => 'App\\',
        'extends' => 'BaseSeeder',
        'implements' => '',
        'organization' => '',
        // 'namespacedModel' => '',
        // 'NamespacedDummyUserModel' => '',
        // 'namespacedUserModel' => '',
        // 'use' => PHP_EOL.'use Illuminate\Database\Eloquent\Factories\HasFactory;'.PHP_EOL.'use Illuminate\Database\Eloquent\Model;'.PHP_EOL,
        // 'use' => PHP_EOL.'use Illuminate\Database\Eloquent\Model;'.PHP_EOL,
        'use' => '',
        // 'use_class' => '    use HasFactory;',
        //        'use_class' => '',
        //        'use_factory' => '',
        //        'migration_prefix' => '',
        //        'table' => '',
        //        'property_table' => '',
        // 'perPage' => PHP_EOL.PHP_EOL.'    protected $perPage = 25;',
        //        'attributes' => '',
        //        'casts' => '',
        //        'docblock' => '',
        //        'fillable' => '',
        //        'perPage' => '',
        'model_camel' => '',
        'model_camels' => '',
        'model_label' => '',
        'model_labels' => '',
        'model_lower' => '',
        'model_lowers' => '',
        'model_kebab' => '',
        'model_kebabs' => '',
        'model_route_param' => '',
        'model_slug' => '',
        'model_slugs' => '',
        'model_snake' => '',
        'model_snakes' => '',
        'model_studly' => '',
        'model_studlies' => '',
        'model_variable' => '',
        'model_variables' => '',
        //        'HasMany' => '',
        //        'HasManyThrough' => '',
        //        'HasOne' => '',
        //        'scopes' => '',
        //        'filters' => '',
        'model_tag_fqdn' => '',
        'model_tagged_fqdn' => '',
        'seeders_doublet' => '',
        'seeders_tag' => '',
        'seeders_triplet' => '',
        'seeder_run_primary' => '',
        'seeder_run_secondary' => '',
        'seeder_run_tertiary' => '',
    ];

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
        $type = $this->c->type();

        $stub = 'seeder/seeder.stub';
        if ($type === 'abstract-tag') {
            $stub = 'seeder/abstract.tag.stub';
        } elseif ($type === 'primary-tag') {
            $stub = 'seeder/primary.tag.stub';
        } elseif ($type === 'secondary-tag') {
            $stub = 'seeder/secondary.tag.stub';
        } elseif ($type === 'abstract-doublet') {
            $stub = 'seeder/abstract.doublet.stub';
        } elseif ($type === 'primary-doublet') {
            $stub = 'seeder/primary.doublet.stub';
        } elseif ($type === 'secondary-doublet') {
            $stub = 'seeder/secondary.doublet.stub';
        } elseif ($type === 'abstract-triplet') {
            $stub = 'seeder/abstract.triplet.stub';
        } elseif ($type === 'primary-triplet') {
            $stub = 'seeder/primary.triplet.stub';
        } elseif ($type === 'secondary-triplet') {
            $stub = 'seeder/secondary.triplet.stub';
        } elseif ($type === 'tertiary-triplet') {
            $stub = 'seeder/tertiary.triplet.stub';
        }

        return $this->resolveStubPath($stub);
    }

    protected function getConfigurationFilename(): string
    {
        $file = sprintf(
            'seeders/%1$s.json',
            Str::of($this->c->name())->kebab(),
        );

        return $file;
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
                ->append('\\Models')
                ->toString();
        }

        return $namespace;

    }

    public function prepareOptions(): void
    {
        $options = [];

        $type = $this->c->type();

        $this->handleRecipe(
            Str::of($this->c->name())->before('Factory')->toString(),
            $type
        );

        // Check options

        if ($this->hasOption('model') && $this->option('model')) {
            $options['model'] = $this->parseClassConfig($this->option('model'));
            $this->searches['model_fqdn'] = $this->parseClassInput($options['model']);
            $this->searches['model'] = class_basename($this->searches['model_fqdn']);
        }

        if ($this->hasOption('model-tag') && $this->option('model-tag')) {
            $options['model-tag'] = $this->parseClassConfig($this->option('model-tag'));
            $this->searches['model_tag_fqdn'] = $this->parseClassInput($options['model-tag']);
            $this->searches['model_tag'] = class_basename($this->searches['model_tag_fqdn']);
        }

        if ($this->hasOption('model') && $this->option('model-tagged')) {
            $options['model-tagged'] = $this->parseClassConfig($this->option('model-tagged'));
            $this->searches['model_tagged_fqdn'] = $this->parseClassInput($options['model-tagged']);
            $this->searches['model_tagged'] = class_basename($this->searches['model_tagged_fqdn']);
        }

        if ($this->hasOption('package') && $this->option('package') && is_string($this->option('package'))) {
            $this->searches['model_package'] = $this->option('package');
        }

        if ($this->hasOption('namespace') && $this->option('namespace')) {
            $namespace = Str::of(
                $this->parseClassInput($this->option('namespace'))
            )->prepend('Database\Seeders\\')->finish('\Models')->toString();
            $options['namespace'] = $this->parseClassConfig($namespace);

            $this->searches['namespace'] = $namespace;
        }

        if (in_array($type, [
            'abstract-tag',
            'abstract-doublet',
            'abstract-triplet',
        ])) {
            $options['extends'] = 'Illuminate/Database/Seeder as BaseSeeder';
        } elseif (in_array($type, [
            'primary-tag',
            'secondary-tag',
        ])) {
            $options['extends'] = 'TagSeeder';
        } elseif (in_array($type, [
            'primary-doublet',
            'primary-triplet',
            'secondary-doublet',
            'secondary-triplet',
            'tertiary-triplet',
        ])) {
            if (! empty($this->searches['model'])) {
                $options['extends'] = Str::of($this->searches['model'])->finish('Seeder')->toString();
            } else {
                $options['extends'] = 'Illuminate/Database/Seeder as BaseSeeder';
            }
        } else {
            $options['extends'] = 'Illuminate/Database/Seeder as BaseSeeder';
        }

        $this->c->setOptions($options);

        $this->buildClass_seeders();
        // dd([
        //    '__METHOD__' => __METHOD__,
        //    // '$this->c' => $this->c,
        //    '$options' => $options,
        //    '$this->options()' => $this->options(),
        //    '$this->c' => $this->c->toArray(),
        //    '$this->searches' => $this->searches,
        // ]);
    }

    /**
     * Get the console command options.
     *
     * NOTE: copied from model
     *
     * @return array<int, mixed>
     */
    protected function getOptions(): array
    {
        return [
            ['all',             'a',  InputOption::VALUE_NONE, 'Generate a migration, seeder, factory, policy, resource controller, and form request classes for the model'],
            //            ['controller',      'c',  InputOption::VALUE_NONE, 'Create a new controller for the model'],
            //            ['factory',         'f',  InputOption::VALUE_NONE, 'Create a new factory for the model'],
            //            ['dump',            null, InputOption::VALUE_NONE, 'Dump a table into a model configuration'],
            //            ['list',            null, InputOption::VALUE_NONE, 'List the tables in the database'],
            ['playground',      null, InputOption::VALUE_NONE, 'Create a Playground model'],
            ['force',           null, InputOption::VALUE_NONE, 'Create the class even if the model already exists'],
            ['interactive',     'i',  InputOption::VALUE_NONE, 'Use interactive mode to create the class even for the '.strtolower($this->type)],
            ['skeleton',        null, InputOption::VALUE_NONE, 'Create the skeleton for the model'],
            //            ['revision',        null, InputOption::VALUE_NONE, 'The model is a revision of another model.'],
            //            ['replace',         null, InputOption::VALUE_NONE, 'Replace the attributes, casts, fillable options when using skeleton for the model'],
            ['test',            null, InputOption::VALUE_NONE, 'Create the unit and feature tests for the model'],
            //            ['migration',       'm',  InputOption::VALUE_NONE, 'Create a new migration file for the model'],
            //            ['migration-date',  null,  InputOption::VALUE_REQUIRED, 'Specify the date prefix for the migration file name for the model'],
            //            ['migration-order', null,  InputOption::VALUE_REQUIRED, 'Specify the order prefix for the migration file name for the model'],
            //            ['morph-pivot',     null, InputOption::VALUE_NONE, 'Indicates if the generated model should be a custom polymorphic intermediate table model'],
            //            ['policy',          null, InputOption::VALUE_NONE, 'Create a new policy for the model'],
            //            ['seed',            's',  InputOption::VALUE_NONE, 'Create a new seeder for the model'],
            //            ['pivot',           'p',  InputOption::VALUE_NONE, 'Indicates if the generated model should be a custom intermediate table model'],
            //            ['resource',        'r',  InputOption::VALUE_NONE, 'Indicates if the generated controller should be a resource controller'],
            //            ['api',             null, InputOption::VALUE_NONE, 'Indicates if the generated controller should be an API resource controller'],
            //            ['requests',        'R',  InputOption::VALUE_NONE, 'Create new form request classes and use them in the resource controller'],
            ['module',          null, InputOption::VALUE_OPTIONAL, 'The module that the '.strtolower($this->type).' belongs to'],
            ['namespace',       null, InputOption::VALUE_OPTIONAL, 'The namespace of the '.strtolower($this->type)],
            ['recipe',          null, InputOption::VALUE_REQUIRED, 'The configuration recipe of the '.strtolower($this->type)],
            ['type',            null, InputOption::VALUE_OPTIONAL, 'The configuration type of the '.strtolower($this->type)],
            ['organization',    null, InputOption::VALUE_OPTIONAL, 'The organization of the '.strtolower($this->type)],
            ['package',         null, InputOption::VALUE_OPTIONAL, 'The package of the '.strtolower($this->type)],
            ['class',           null, InputOption::VALUE_OPTIONAL, 'The class name of the '.strtolower($this->type)],
            ['file',            null, InputOption::VALUE_OPTIONAL, 'The configuration file of the '.strtolower($this->type)],
            ['table',           null, InputOption::VALUE_OPTIONAL, 'The schema table name of the '.strtolower($this->type)],
            ['model',           null, InputOption::VALUE_REQUIRED, 'The model for the '.strtolower($this->type)],
            ['model-tag',       null, InputOption::VALUE_REQUIRED, 'The tag model for the '.strtolower($this->type)],
            ['model-tagged',    null, InputOption::VALUE_REQUIRED, 'The tagged model for the '.strtolower($this->type)],
            ['seeders',         null, InputOption::VALUE_IS_ARRAY | InputOption::VALUE_REQUIRED, 'The tagged model for the '.strtolower($this->type)],
        ];
    }
}
