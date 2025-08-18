<?php

/**
 * Playground
 */

declare(strict_types=1);

use Playground\Make\Model\Recipe;

/**
 * Playground Make Configuration and Environment Variables
 *
 * @return array{
 *        about: bool,
 *        locale: ?string,
 *        load: array{commands: bool, translations: bool},
 *        recipes: array{
 *            cms: Recipe\Model,
 *            crm: Recipe\Model,
 *            directory: Recipe\Model,
 *            dump: Recipe\Model,
 *            lead: Recipe\Model,
 *            matrix: Recipe\Model,
 *            playground: Recipe\Model
 *        }
 *    }
 */
return [

    /*
    |--------------------------------------------------------------------------
    | About Information
    |--------------------------------------------------------------------------
    |
    | By default, information will be displayed about this package when using:
    |
    | `artisan about`
    |
    */

    'about' => (bool) env('PLAYGROUND_MAKE_MODEL_ABOUT', true),

    /*
    |--------------------------------------------------------------------------
    | Loading
    |--------------------------------------------------------------------------
    |
    | By default, commands and translations are loaded.
    |
    */

    'load' => [
        'commands' => (bool) env('PLAYGROUND_MAKE_MODEL_LOAD_COMMANDS', true),
        'translations' => (bool) env('PLAYGROUND_MAKE_MODEL_LOAD_TRANSLATIONS', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Recipes
    |--------------------------------------------------------------------------
    |
    | The recipes must extend: Playground\Make\Model\Recipe\Model
    */

    'recipes' => [
        // 'acme' => App\Make\Recipes\Acme\Acme::class,
        // 'acme-widget' => App\Make\Recipes\Acme\AcmeWidget::class,
        'cms' => Recipe\Cms::class,
        'crm' => Recipe\Crm::class,
        'directory' => Recipe\Directory::class,
        'dump' => Recipe\Dump::class,
        'lead' => Recipe\Lead::class,
        'matrix' => Recipe\Matrix::class,
        'playground' => Recipe\Playground::class,
    ],
];
