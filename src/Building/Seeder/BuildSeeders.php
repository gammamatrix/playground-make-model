<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Model\Building\Seeder;

use Illuminate\Support\Str;

/**
 * \Playground\Make\Model\Building\Factory\BuildSeeders
 */
trait BuildSeeders
{
    protected function buildClass_seeders(): void
    {
        $seeders = $this->options()['seeders'];

        $this->searches['seeders'] = '';

        if (empty($seeders) || ! is_array($seeders)) {
            return;
        }

        foreach ($seeders as $slug) {
            if (empty($slug) || ! is_string($slug)) {
                continue;
            }
            $this->searches['seeders'] .= sprintf(
                '%1$s%2$s\'%3$s\',',
                PHP_EOL,
                str_repeat(' ', 8),
                $slug
            );

            if (in_array($this->c->type(), [
                'primary-tag',
                'primary-doublet',
                'primary-triplet',
            ])) {
                $this->searches['seeder_run_primary'] .= sprintf(
                    '%1$s%2$s$this->runPrimary(\'%3$s\');',
                    PHP_EOL,
                    str_repeat(' ', 8),
                    $slug
                );
            } elseif (in_array($this->c->type(), [
                'secondary-tag',
                'secondary-doublet',
                'secondary-triplet',
            ])) {
                $this->searches['seeder_run_secondary'] .= sprintf(
                    '%1$s%2$s$this->runSecondary(\'%3$s\');',
                    PHP_EOL,
                    str_repeat(' ', 8),
                    $slug
                );
            } elseif (in_array($this->c->type(), [
                'tertiary-triplet',
            ])) {
                $prefix = sprintf(
                    'seeder-%1$s-',
                    $this->c->model_snakes()
                );
                $primary = Str::of($slug)->after($prefix)->before('-')->toString();
                $secondary = Str::of($slug)->after($prefix.$primary)
                    ->after('-')
                    ->toString();
                $this->searches['seeder_run_tertiary'] .= sprintf(
                    '%1$s%2$s$this->runTertiary(\'%3$s\', \'%4$s\', \'%5$s\');',
                    PHP_EOL,
                    str_repeat(' ', 8),
                    $slug,
                    $primary,
                    $secondary,
                );
            }
        }
    }
}
