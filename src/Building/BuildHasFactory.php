<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Model\Building;

use Illuminate\Support\Str;
use Playground\Make\Model\Console\Commands\ModelMakeCommand;

/**
 * \Playground\Make\Model\Building\BuildHasFactory
 *
 * @mixin ModelMakeCommand
 */
trait BuildHasFactory
{
    protected function buildClass_model_has_factory(): void
    {
        $this->buildClass_uses_add('Illuminate/Database/Eloquent/Factories/HasFactory');
        $this->searches['use_factory'] = $this->buildClass_states_print_has_factory();
    }

    protected function buildClass_states_print_has_factory(): string
    {
        $fqdn = $this->parseClassInput($this->c->fqdn());

        $factory = Str::of($fqdn)->start('\\Database\\Factories\\')->finish('Factory')->toString();
        $factory_short = Str::of($this->c->model())->finish('Factory')->toString();
        $this->buildClass_uses_add($factory);

        return <<<PHP_CODE
    /** @use HasFactory<$factory_short> */
    use HasFactory;


PHP_CODE;
    }
}
