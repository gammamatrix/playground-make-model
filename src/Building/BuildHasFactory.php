<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Building;

use Illuminate\Support\Str;

/**
 * \Playground\Make\Model\Building\BuildHasFactory
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

        return <<<PHP_CODE
    /** @use HasFactory<$factory> */
    use HasFactory;


PHP_CODE;
    }
}
