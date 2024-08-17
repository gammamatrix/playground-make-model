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
        'cms' => Recipe\Cms::class,
        'crm' => Recipe\Crm::class,
        'directory' => Recipe\Directory::class,
        'laravel' => Recipe\Laravel::class,
        'lead' => Recipe\Lead::class,
        'matrix' => Recipe\Matrix::class,
        'playground' => Recipe\Playground::class,
    ];

    public function handleRecipe(string $name, string $type): void
    {
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

        // dd([
        //     '__METHOD__' => __METHOD__,
        //     '$name' => $name,
        //     '$type' => $type,
        //     '$recipe' => $recipe,
        //     '$class' => $class,
        //     '$this->recipe' => $this->recipe,
        // ]);
    }
}
