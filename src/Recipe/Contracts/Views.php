<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Recipe\Contracts;

use Playground\Make\Model\Recipe\Views\Index;

/**
 * \Playground\Make\Model\Recipe\Contracts\Views
 */
interface Views
{
    public function index(): Index;
}
