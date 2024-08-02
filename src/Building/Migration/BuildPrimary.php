<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Building\Migration;

/**
 * \Playground\Make\Model\Building\Migration\BuildPrimary
 */
trait BuildPrimary
{
    protected function buildClass_primary(): void
    {
        $primary = $this->model?->create()?->primary();
        // dd([
        //     '__METHOD__' => __METHOD__,
        //     '$primary' => $primary,
        // ]);

        $this->searches['table_primary'] = PHP_EOL;

        $this->searches['table_primary'] .= sprintf(
            '%1$s// Primary key',
            str_repeat(' ', 12)
        );

        $this->searches['table_primary'] .= PHP_EOL.PHP_EOL;

        if ($primary === 'uuid') {
            $this->searches['table_primary'] .= sprintf(
                '%1$s$table->uuid(\'id\')->primary();',
                str_repeat(' ', 12)
            );
        } elseif ($primary === 'increments') {
            $this->searches['table_primary'] .= sprintf(
                '%1$s$table->id();',
                str_repeat(' ', 12)
            );
        } else {
            $this->searches['table_primary'] = '';
        }
    }
}
