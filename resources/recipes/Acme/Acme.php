<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace App\Make\Recipes\Acme;

use Playground\Make\Model\Recipe\Dump;

/**
 * \App\Make\Recipes\Acme\Acme
 */
class Acme extends Dump
{
    // protected string $primary = 'uuid';
    protected string $primary = 'increments';

    // /**
    //  * @var array<string, array<string, mixed>>
    //  */
    // protected array $dates = [
    //     'canceled_at' => [
    //         'nullable' => true,
    //         'index' => false,
    //     ],
    //     'closed_at' => [
    //         'nullable' => true,
    //         'index' => true,
    //     ],
    //     'suspended_at' => [
    //         'nullable' => true,
    //         'index' => false,
    //     ],
    //     'timer_end_at' => [
    //         'nullable' => true,
    //         'index' => true,
    //     ],
    //     'timer_start_at' => [
    //         'nullable' => true,
    //         'index' => true,
    //     ],
    // ];
}
