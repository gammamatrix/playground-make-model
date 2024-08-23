<?php
/**
 * Playground
 */

declare(strict_types=1);

/**
 * Playground Make Configuration and Environment Variables
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
        'cms' => Playground\Make\Model\Recipe\Cms::class,
        'crm' => Playground\Make\Model\Recipe\Crm::class,
        'directory' => Playground\Make\Model\Recipe\Directory::class,
        'dump' => Playground\Make\Model\Recipe\Dump::class,
        'lead' => Playground\Make\Model\Recipe\Lead::class,
        'matrix' => Playground\Make\Model\Recipe\Matrix::class,
        'playground' => Playground\Make\Model\Recipe\Playground::class,
    ],
];
