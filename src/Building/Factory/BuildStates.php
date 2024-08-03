<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Building\Factory;

/**
 * \Playground\Make\Model\Building\Factory\BuildStates
 */
trait BuildStates
{
    protected function buildClass_states(): void
    {
        $states = $this->recipe->factoryStates();
        if (! $states) {
            return;
        }

        $this->searches['states'] = PHP_EOL.PHP_EOL;

        $this->searches['states'] .= sprintf(
            '%1$s// States: flags',
            str_repeat(' ', 4)
        );

        $this->searches['states'] .= PHP_EOL;

        $i = 0;
        foreach ($states as $method => $meta) {
            $i++;
            $this->searches['states'] .= $this->buildClass_states_print_flag($method, $meta);
            if ($i < count($states)) {
                $this->searches['states'] .= PHP_EOL;
            }
        }
        // dump([
        //     '__METHOD__' => __METHOD__,
        //     '$this->c->name()' => $this->c->name(),
        //     '$this->c' => $this->c,
        //     '$this->options()' => $this->options(),
        //     '$this->searches' => $this->searches,
        //     // '$this->recipe' => $this->recipe,
        //     '$this->recipe->factoryStates()' => $this->recipe->factoryStates(),
        // ]);
    }

    /**
     * @param array<string, mixed> $meta
     */
    protected function buildClass_states_print_flag(string $method, array $meta): string
    {
        $model = $this->c->model();
        $flag = ! empty($meta['flag']) && is_string($meta['flag']) ? $meta['flag'] : $method;
        $value = ! empty($meta['value']) ? 'true' : 'false';

        return <<<PHP_CODE

    /**
     * @return Factory<$model>
     */
    public function $method(): Factory
    {
        return \$this->state(fn (array \$attributes) => [
            '$flag' => $value,
        ]);
    }
PHP_CODE;
    }
}
