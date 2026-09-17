<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Model\Console\Commands\Concerns;

use Playground\Make\Model\Recipe;

/**
 * \Playground\Make\Model\Console\Commands\Concerns\Recipes
 */
trait Recipes
{
    protected Recipe\Model $recipe;

    /**
     * @var array<string, class-string<Recipe\Model>>
     */
    protected array $recipes = [
        // 'acme' => App\Make\Recipes\Acme\Acme::class,
        // 'acme-widget' => App\Make\Recipes\Acme\AcmeWidget::class,
        'cms' => Recipe\Cms::class,
        'crm' => Recipe\Crm::class,
        'directory' => Recipe\Directory::class,
        'dump' => Recipe\Dump::class,
        'laravel' => Recipe\Laravel::class,
        'lead' => Recipe\Lead::class,
        'matrix' => Recipe\Matrix::class,
        'playground' => Recipe\Playground::class,
    ];

    public function loadRecipes(): void
    {
        $recipes = config('playground-make-model.recipes');

        if (is_array($recipes)) {
            foreach ($recipes as $recipe => $recipeClass) {
                if (! is_string($recipe) || empty($recipe)) {
                    throw new \Exception(__('playground-make-model:recipes.recipe.key.invalid'));
                }
                if (! is_string($recipeClass)
                    || empty($recipeClass)
                    || ! class_exists($recipeClass)
                    || ! is_subclass_of($recipeClass, Recipe\Model::class)
                ) {
                    throw new \Exception(__('playground-make-model:recipes.recipe.class.invalid'));
                }
                $this->recipes[$recipe] = $recipeClass;
            }
        }
        ksort($this->recipes);
    }

    public function handleRecipe(string $name, string $type): void
    {
        $this->loadRecipes();

        $recipe = ! empty($this->recipes[$this->c->recipe()]) ? $this->c->recipe() : '';
        $class = $this->recipes['playground'];

        if ($this->hasOption('recipe')
            && $this->option('recipe')
            && is_string($this->option('recipe'))
            && ! empty($this->recipes[$this->option('recipe')])
        ) {
            $recipe = $this->option('recipe');
            $class = $this->recipes[$recipe];
        }

        if (! $recipe && $type) {
            if (in_array($type, [
                'abstract',
                'morph-pivot',
                'pivot',
            ])) {
                $recipe = 'abstract';
                $class = Recipe\AbstractModel::class;
            } elseif (in_array($type, [
                'model',
            ])) {
                $recipe = 'laravel';
                $class = Recipe\Laravel::class;
            }
        }

        if (empty($this->recipe)) {
            $this->recipe = new $class($name, $type);
        }

        if ($recipe && $this->c->recipe() !== $recipe) {
            $this->c->setOptions([
                'recipe' => $recipe,
            ]);
        }
    }

    public function applyRecipeToConfiguration(): void
    {
        $this->c->setOptions([
            'model' => $this->recipe->name(),
            'name' => $this->recipe->name(),
            'names' => $this->recipe->names(),
            'model_camel' => $this->recipe->name_camel(),
            'model_camels' => $this->recipe->name_camels(),
            'model_label' => $this->recipe->name_label(),
            'model_labels' => $this->recipe->name_labels(),
            'model_lower' => $this->recipe->name_lower(),
            'model_lowers' => $this->recipe->name_lowers(),
            'model_kebab' => $this->recipe->name_kebab(),
            'model_kebabs' => $this->recipe->name_kebabs(),
            // slugs can be kebab or snake case
            'model_slug' => $this->recipe->name_kebab(),
            'model_slugs' => $this->recipe->name_kebabs(),
            'model_snake' => $this->recipe->name_snake(),
            'model_snakes' => $this->recipe->name_snakes(),
            'model_studly' => $this->recipe->name_studly(),
            'model_studlies' => $this->recipe->name_studlies(),
            // variables can be camel or snake case
            'model_variable' => $this->recipe->name_camel(),
            'model_variables' => $this->recipe->name_camels(),
        ])->apply();
    }
}
