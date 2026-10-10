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

    /**
     * @var array<mixed, mixed>
     */
    protected array $data = [];

    protected function buildClass_seeder_configs(): void
    {
        $model = '';
        if ($this->hasOption('model') && ! empty($this->option('model'))) {
            $model = $this->option('model');
        }
        if ($this->hasOption('seeder') && ! empty($this->option('seeder'))) {
            $this->searches['seeder'] = $this->parseClassInput($this->option('seeder'));
        } elseif (is_string($model)) {
            $this->searches['seeder'] = sprintf(
                '\Database\Seeders\Playground\Task\Models\%1$sSeeder',
                $model
            );
        }

        if ($this->c->type() === 'data-model-tertiary') {
            $modelSnake = Str::of($this->c->name())->after('seeder-')->before('-')->toString();
            $primary = Str::of($this->c->name())->after(
                'seeder-'.$modelSnake.'-'
            )->before('-')->kebab()->toString();
            $secondary = Str::of($this->c->name())->after(
                'seeder-'.$modelSnake.'-'.$primary.'-'
            )->kebab()->toString();
            $this->searches['seeder_primary'] = $primary;
            $this->searches['seeder_secondary'] = $secondary;
        } elseif (in_array($this->c->type(), [
            'data-tag-secondary',
        ])) {
            $modelSnake = Str::of($this->c->name())->after('seeder-')->before('-')->toString();
            $primary = Str::of($this->c->name())->after(
                'seeder-'.$modelSnake.'-'
            )->before('-')->kebab()->toString();
            $this->searches['seeder_primary'] = $primary;
            $this->searches['seeder_secondary'] = '';
        } else {
            $this->searches['seeder_primary'] = '';
            $this->searches['seeder_secondary'] = '';
        }

        if (! $this->hasOption('data') || empty($this->option('data')) || ! is_string($this->option('data'))) {
            return;
        }

        $this->data = $this->readJsonFileAsArray($this->option('data'));

        $this->searches['seeder_data'] = '';

        $i = 0;
        $lastPrimary = '';
        $setPrimary = false;
        foreach ($this->data as $slug => $meta) {
            if (! is_array($meta)) {
                $meta = [];
            }
            $primary = ! empty($meta['primary']) && is_string($meta['primary']) ? $meta['primary'] : '';
            if ($i == 0) {
                $setPrimary = ! empty($primary);
                $lastPrimary = $primary;
            } else {
                $setPrimary = false;
                if (! empty($primary) && $lastPrimary !== $primary) {
                    $setPrimary = true;
                    $lastPrimary = $primary;
                }
            }

            if ($setPrimary) {
                $this->searches['seeder_data'] .= sprintf('%1$s%2$s// %3$s%1$s', PHP_EOL, str_repeat(' ', 4), $primary);
            }
            $this->searches['seeder_data'] .= $this->buildClass_seeder_configs_print_attributes($slug, $meta);
            $i++;

        }
    }

    /**
     * @param  array<mixed>  $meta
     */
    protected function buildClass_seeder_configs_print_attributes(
        string $slug,
        array $meta,
        int $indent = 8,
    ): string {
        $output = '';

        foreach ($meta as $key => $value) {
            if (! empty($key) && is_string($key)) {
                if (is_string($value)) {
                    $value = sprintf('\'%1$s\'', $value);
                } elseif (is_bool($value)) {
                    $value = $value ? 'true' : 'false';
                } elseif (is_null($value)) {
                    $value = 'null';
                } elseif (is_array($value)) {
                    $subComment = '';
                    $subOutput = 'null';
                    $value = $subOutput;
                } elseif (! is_scalar($value)) {
                    dd([
                        '__METHOD__' => __METHOD__,
                        'message' => 'unhandled value',
                        '$value' => $value,
                    ]);
                }

                $comment = '';

                if (in_array($key, [
                    'duration',
                ])) {
                    if (is_numeric($value)) {
                        $comment = sprintf('// %1$s', $this->print_comment_duration(intval($value)));
                    }
                }

                $output .= sprintf(
                    '%1$s%2$s\'%3$s\' => %4$s,%5$s',
                    PHP_EOL,
                    str_repeat(' ', $indent),
                    $key,
                    $value,
                    $comment
                );
            }
        }

        return <<<PHP_CODE

    '$slug' => [$output
    ],

PHP_CODE;
    }

    protected function print_comment_duration(int $duration): string
    {
        $days = (int) floor($duration / 86400);
        $hours = (int) floor($duration / 3600);
        $minutes = (int) floor(($duration % 3600) / 60);
        $seconds = $duration % 60;

        $daysLabel = $days === 1 ? 'day' : 'days';
        $hoursLabel = $hours === 1 ? 'hour' : 'hours';
        $minutesLabel = $minutes === 1 ? 'minute' : 'minutes';
        $secondsLabel = $seconds === 1 ? 'second' : 'seconds';

        if (! empty($days)) {
            return sprintf(
                '%1$d %5$s, %2$d %6$s, %3$d %7$s and %4$d %8$s',
                $days,
                $hours,
                $minutes,
                $seconds,
                $daysLabel,
                $hoursLabel,
                $minutesLabel,
                $secondsLabel,
            );
        }
        if (! empty($hours)) {
            if (empty($minutes) && empty($seconds)) {
                return sprintf(
                    '%1$d %2$s',
                    $hours,
                    $hoursLabel,
                );
            } elseif (empty($seconds)) {
                return sprintf('%1$d %3$s and %2$d %4$s', $hours, $minutes, $hoursLabel, $minutesLabel);
            }

            return sprintf('%1$d %4$s, %2$d %5$s, and %3$d %6$s', $hours, $minutes, $seconds, $hoursLabel, $minutesLabel, $secondsLabel);
        }
        if (! empty($minutes)) {
            if (empty($seconds)) {
                return sprintf('%1$d %2$s', $minutes, $minutesLabel);
            }

            return sprintf('%1$d %3$s and %2$d %4$s', $minutes, $seconds, $minutesLabel, $secondsLabel);
        }

        return sprintf('%d %2$s', $seconds, $secondsLabel);
    }
}
