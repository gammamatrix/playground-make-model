<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Building\Dump;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Playground\Make\Configuration\Model\Create;

/**
 * \Playground\Make\Model\Building\Dump\BuildConfiguration
 */
trait BuildConfiguration
{
    /**
     * @var array<int, array<string, mixed>>
     */
    protected $dump_all_columns = [];

    /**
     * @var bool The first column is the primary key.
     */
    protected $dump_primary_first = true;

    /**
     * @var string composite|increments|uuid
     */
    protected $dump_primary_type = null;

    /**
     * @var ?string id|uuid|...
     */
    protected $dump_primary_key = null;

    /**
     * @var array<string, mixed>
     */
    protected $dump_primary = [
        'key' => null,
        'keys' => [],
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $dump_columns = [];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $dump_dates = [];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $dump_flags = [];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $dump_ids = [];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $dump_json = [];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $dump_permissions = [];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $dump_status = [];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $dump_ui = [];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $dump_matrix = [];

    protected function buildClass_configuration(): void
    {
        $table = $this->c->table();
        if (! $table) {
            // A table is required.
            return;
        }

        $this->dump_all_columns = Schema::getColumns($table);

        $create = $this->c->create();

        $name = $this->c->name();
        $type = $this->c->type();
        // dump([
        //     '__METHOD__' => __METHOD__,
        //     '$create' => $create,
        //     '$name' => $name,
        //     '$type' => $type,
        //     '$this->c->toArray()' => $this->c->toArray(),
        // ]);

        if (! $create) {
            $create = $this->buildClass_model_create($name, $type);
        }

        $this->buildClass_configuration_identify_primary($create);

        $this->buildClass_configuration_identify_columns($create);

        $this->buildClass_configuration_create($create);

        // dump([
        //     '__METHOD__' => __METHOD__,
        //     // '$this->c' => $this->c,
        //     '$this->c->name()' => $this->c->name(),
        //     '$this->c->table()' => $this->c->table(),
        //     '$this->options()' => $this->options(),
        //     '$this->searches' => $this->searches,
        //     '$this->dump_columns' => $this->dump_columns,
        //     '$this->dump_primary_first' => $this->dump_primary_first,
        //     '$this->recipe' => $this->recipe,
        //     // '$this->recipe->factoryStates()' => $this->recipe?->factoryStates(),
        //     // '$create' => $create,
        //     // '$create' => $create->apply()->toArray(),
        // ]);
    }

    protected function buildClass_configuration_create(Create $create): void
    {
        foreach ($this->dump_columns as $column => $meta) {
            $create->addColumn($column, $meta);
        }

        foreach ($this->dump_dates as $column => $meta) {
            $create->addDate($column, $meta);
        }

        foreach ($this->dump_flags as $column => $meta) {
            $create->addFlag($column, $meta);
        }

        foreach ($this->dump_ids as $column => $meta) {
            $create->addId($column, $meta);
        }

        foreach ($this->dump_json as $column => $meta) {
            $create->addJson($column, $meta);
        }

        foreach ($this->dump_permissions as $column => $meta) {
            $create->addPermission($column, $meta);
        }

        foreach ($this->dump_status as $column => $meta) {
            $create->addStatus($column, $meta);
        }

        foreach ($this->dump_ui as $column => $meta) {
            $create->addUi($column, $meta);
        }

        foreach ($this->dump_matrix as $column => $meta) {
            $create->addMatrix($column, $meta);
        }
    }

    protected function buildClass_configuration_identify_primary(Create $create): void
    {
        $i = null;

        if ($this->dump_primary_first) {
            $i = 0;
        }

        $meta = null;

        if (is_numeric($i)) {
            $meta = $this->dump_all_columns[$i];
        }

        if (empty($meta) || ! array_key_exists('auto_increment', $meta)) {
            // Nothing to do
            return;
        }

        if (! empty($meta['auto_increment'])) {
            $create->setOptions(['primary' => 'increments']);
        } elseif (! empty($meta['type']) && $meta['type'] === 'char(36)') {
            $create->setOptions(['primary' => 'uuid']);
        }
        // "$meta" => array:9 [
        // "name" => "id"
        // "type_name" => "int"
        // "type" => "int"
        // "collation" => null
        // "nullable" => false
        // "default" => null
        // "auto_increment" => true
        // "comment" => null
        // "generation" => null
        // ]

        // "$meta" => array:9 [
        // "name" => "id"
        // "type_name" => "char"
        // "type" => "char(36)"
        // "collation" => "utf8mb4_0900_ai_ci"
        // "nullable" => false
        // "default" => null
        // "auto_increment" => false
        // "comment" => null
        // "generation" => null
        // ]

        // dd([
        //     '__METHOD__' => __METHOD__,
        //     '$i' => $i,
        //     '$meta' => $meta,
        //     '$create' => $create->apply()->toArray(),
        //     // '$this->dump_all_columns[$i]' => $this->dump_all_columns[$i],
        // ]);
    }

    protected ?string $dump_type_default = null;

    protected string $dump_type_column;

    protected ?string $dump_type_laravel = null;

    protected ?string $dump_type_sql = null;

    protected ?string $dump_type_name = null;

    protected bool $dump_type_nullable = false;

    protected ?bool $dump_type_unsigned = false;

    protected ?int $dump_type_size = null;

    protected ?int $dump_type_scale = null;

    protected ?int $dump_type_precision = null;

    protected ?string $dump_type_comment = null;

    protected bool $dump_type_is_column = false;

    protected bool $dump_type_is_flag = false;

    protected bool $dump_type_is_date = false;

    protected bool $dump_type_is_timestamp_created = false;

    protected bool $dump_type_is_timestamp_deleted = false;

    protected bool $dump_type_is_timestamp_updated = false;

    protected bool $dump_type_with_timestamps = false;

    protected bool $dump_type_with_softDeletes = false;

    protected bool $dump_type_is_id = false;

    protected bool $dump_type_is_user_id = false;

    protected bool $dump_type_is_json = false;

    protected bool $dump_type_is_matrix = false;

    protected bool $dump_type_is_permissions = false;

    protected bool $dump_type_is_status = false;

    protected bool $dump_type_is_ui = false;

    protected bool $dump_type_is_unique = false;

    /**
     * @param array<string, mixed> $meta
     */
    protected function buildClass_configuration_identify_column_type(string $column, int $i, array $meta): void
    {
        $this->dump_type_column = $column;
        $this->dump_type_name = ! empty($meta['type_name']) && is_string($meta['type_name']) ? $meta['type_name'] : null;
        $this->dump_type_comment = ! empty($meta['comment']) && is_string($meta['comment']) ? $meta['comment'] : null;
        $this->dump_type_sql = ! empty($meta['type']) && is_string($meta['type']) ? $meta['type'] : null;
        $this->dump_type_size = ! empty($meta['size']) && is_numeric($meta['size']) ? intval($meta['size']) : null;
        $this->dump_type_scale = null;
        $this->dump_type_precision = null;
        $this->dump_type_laravel = null;
        $this->dump_type_unsigned = null;
        $this->dump_type_default = null;

        $this->dump_type_nullable = ! empty($meta['nullable']);

        $this->dump_type_is_column = false;
        $this->dump_type_is_flag = false;
        $this->dump_type_is_date = false;
        $this->dump_type_is_timestamp_created = false;
        $this->dump_type_is_timestamp_deleted = false;
        $this->dump_type_is_timestamp_updated = false;
        $this->dump_type_is_id = false;
        $this->dump_type_is_user_id = false;
        $this->dump_type_is_json = false;
        $this->dump_type_is_matrix = false;
        $this->dump_type_is_permissions = false;
        $this->dump_type_is_status = false;
        $this->dump_type_is_ui = false;
        $this->dump_type_is_unique = false;

        // if ('avatar' === $this->dump_type_column) {
        //     dd([
        //         '__METHOD__' => __METHOD__,
        //         '$i' => $i,
        //         '$meta' => $meta,
        //         // '$this->dump_type_laravel' => $this->dump_type_laravel,
        //         // '$this->dump_type_name' => $this->dump_type_name,
        //         // '$this->dump_type_sql' => $this->dump_type_sql,
        //     ]);
        // }

        if (in_array($this->dump_type_name, [
            'char',
        ])) {
            if (in_array($this->dump_type_sql, [
                'char(36)',
            ])) {
                if (Str::of($this->dump_type_column)->lower()->endsWith('id')) {
                    $this->dump_type_laravel = 'uuid';
                    $this->dump_type_is_id = true;
                } else {
                    $this->dump_type_laravel = 'string';
                    if (! empty($this->recipe->permissions()[$this->dump_type_column])) {
                        $this->dump_type_is_permissions = true;
                    } elseif (! empty($this->recipe->ui()[$this->dump_type_column])) {
                        $this->dump_type_is_ui = true;
                    } elseif (! empty($this->recipe->status()[$this->dump_type_column])) {
                        $this->dump_type_is_status = true;
                    } elseif (! empty($this->recipe->matrix()[$this->dump_type_column])) {
                        $this->dump_type_is_matrix = true;
                    } else {
                        $this->dump_type_is_column = true;
                    }
                }
            } else {
                dd([
                    '__METHOD__' => __METHOD__,
                    '$i' => $i,
                    '$meta' => $meta,
                    '$this->dump_type_laravel' => $this->dump_type_laravel,
                    '$this->dump_type_name' => $this->dump_type_name,
                    '$this->dump_type_sql' => $this->dump_type_sql,
                ]);
            }
        } elseif (in_array($this->dump_type_name, [
            'varchar',
        ])) {
            if (in_array($this->dump_type_sql, [
                'varchar(255)',
            ])) {
                $this->dump_type_laravel = 'string';
                if (! empty($this->recipe->permissions()[$this->dump_type_column])) {
                    $this->dump_type_is_permissions = true;
                } elseif (! empty($this->recipe->ui()[$this->dump_type_column])) {
                    $this->dump_type_is_ui = true;
                } elseif (! empty($this->recipe->status()[$this->dump_type_column])) {
                    $this->dump_type_is_status = true;
                } elseif (! empty($this->recipe->matrix()[$this->dump_type_column])) {
                    $this->dump_type_is_matrix = true;
                } else {
                    $this->dump_type_is_column = true;
                }
            } else {
                $this->dump_type_laravel = 'string';
                $matches = [];
                $pattern = '/varchar\((?P<size>\d+)\)/';
                // $pattern = '/(.*)/';
                if ($this->dump_type_sql && preg_match($pattern, $this->dump_type_sql, $matches)) {
                    if (! empty($matches['size'])
                        && is_numeric($matches['size'])
                        && $matches['size'] > 0
                    ) {
                        $this->dump_type_size = intval($matches['size']);
                    }
                } else {
                    dd([
                        '__METHOD__' => __METHOD__,
                        '$i' => $i,
                        '$meta' => $meta,
                        '$this->dump_type_laravel' => $this->dump_type_laravel,
                        '$this->dump_type_name' => $this->dump_type_name,
                        '$this->dump_type_sql' => $this->dump_type_sql,
                    ]);
                }
                dump([
                    '__METHOD__' => __METHOD__,
                    '$i' => $i,
                    '$meta' => $meta,
                    '$matches' => $matches,
                    '$this->dump_type_laravel' => $this->dump_type_laravel,
                    '$this->dump_type_name' => $this->dump_type_name,
                    '$this->dump_type_sql' => $this->dump_type_sql,
                    '$this->dump_type_size' => $this->dump_type_size,
                ]);
            }
        } elseif (in_array($this->dump_type_name, [
            'int',
            'mediumint',
            'bigint',
            'tinyint',
        ])) {

            if (in_array($this->dump_type_name, [
                'tinyint',
            ])) {
                $this->dump_type_laravel = 'tinyInteger';
            } elseif (in_array($this->dump_type_name, [
                'mediumint',
            ])) {
                $this->dump_type_laravel = 'mediumInteger';
            } elseif (in_array($this->dump_type_name, [
                'int',
            ])) {
                $this->dump_type_laravel = 'integer';
            } elseif (in_array($this->dump_type_name, [
                'bigint',
            ])) {
                $this->dump_type_laravel = 'bigInteger';
            }

            if (! empty($this->recipe->permissions()[$this->dump_type_column])) {
                $this->dump_type_is_permissions = true;
            } elseif (! empty($this->recipe->status()[$this->dump_type_column])) {
                $this->dump_type_is_status = true;
            } elseif (! empty($this->recipe->flags()[$this->dump_type_column])) {
                $this->dump_type_is_flag = true;
                $this->dump_type_laravel = 'boolean';
            } elseif (! empty($this->recipe->matrix()[$this->dump_type_column])) {
                $this->dump_type_is_matrix = true;
            } else {
                $this->dump_type_is_column = true;
            }
        } elseif (in_array($this->dump_type_name, [
            'tinytext',
            'mediumtext',
            'text',
            'longtext',
        ])) {

            if (in_array($this->dump_type_name, [
                'tinytext',
            ])) {
                $this->dump_type_laravel = 'tinyText';
            } elseif (in_array($this->dump_type_name, [
                'mediumtext',
            ])) {
                $this->dump_type_laravel = 'mediumText';
            } elseif (in_array($this->dump_type_name, [
                'text',
            ])) {
                $this->dump_type_laravel = 'text';
            } elseif (in_array($this->dump_type_name, [
                'longtext',
            ])) {
                // Sometimes longText could be json
                $this->dump_type_laravel = 'longText';
            }

            if (! empty($this->recipe->permissions()[$this->dump_type_column])) {
                $this->dump_type_is_permissions = true;
            } elseif (! empty($this->recipe->status()[$this->dump_type_column])) {
                $this->dump_type_is_status = true;
            } elseif (! empty($this->recipe->flags()[$this->dump_type_column])) {
                $this->dump_type_is_flag = true;
            } elseif (! empty($this->recipe->matrix()[$this->dump_type_column])) {
                $this->dump_type_is_matrix = true;
            } else {
                $this->dump_type_is_column = true;
            }

        } elseif (in_array($this->dump_type_name, [
            'decimal',
        ])) {
            $decimal = [];
            $dsp = '/decimal\((?P<precision>\d+),(?P<scale>\d+)\)/';
            // $dsp = '/(.*)/';
            if ($this->dump_type_sql && preg_match($dsp, $this->dump_type_sql, $decimal)) {

                // dd([
                //     '__METHOD__' => __METHOD__,
                //     '$i' => $i,
                //     '$meta' => $meta,
                //     '$decimal' => $decimal,
                // ]);

                if (! empty($decimal['precision'])
                    && is_numeric($decimal['precision'])
                    && $decimal['precision'] > 0
                ) {
                    $this->dump_type_precision = intval($decimal['precision']);
                }
                if (! empty($decimal['scale'])
                    && is_numeric($decimal['scale'])
                    && $decimal['scale'] > 0
                ) {
                    $this->dump_type_scale = intval($decimal['scale']);
                }
            }
            $this->dump_type_laravel = 'decimal';
            if (! empty($this->recipe->permissions()[$this->dump_type_column])) {
                $this->dump_type_is_permissions = true;
            } elseif (! empty($this->recipe->status()[$this->dump_type_column])) {
                $this->dump_type_is_status = true;
            } elseif (! empty($this->recipe->matrix()[$this->dump_type_column])) {
                $this->dump_type_is_matrix = true;
            } else {
                $this->dump_type_is_column = true;
            }

            // dd([
            //     '__METHOD__' => __METHOD__,
            //     '$i' => $i,
            //     '$meta' => $meta,
            //     '$decimal' => $decimal,
            //     '$this->dump_type_laravel' => $this->dump_type_laravel,
            //     '$this->dump_type_name' => $this->dump_type_name,
            //     '$this->dump_type_sql' => $this->dump_type_sql,
            //     '$this->dump_type_precision' => $this->dump_type_precision,
            //     '$this->dump_type_scale' => $this->dump_type_scale,
            //     // '$this->recipes' => $this->recipes,
            //     // '$this->recipe' => $this->recipe,
            // ]);

        } elseif (in_array($this->dump_type_name, [
            'datetime',
        ])) {
            $this->dump_type_is_date = true;
            $this->dump_type_laravel = 'dateTime';
        } elseif (in_array($this->dump_type_name, [
            'timestamp',
        ])) {
            if ($this->dump_type_column === $this->recipe->timestamp_created()) {
                $this->dump_type_is_timestamp_created = true;
                $this->dump_type_with_timestamps = true;
            } elseif ($this->dump_type_column === $this->recipe->timestamp_deleted()) {
                $this->dump_type_is_timestamp_deleted = true;
                $this->dump_type_with_softDeletes = true;
            } elseif ($this->dump_type_column === $this->recipe->timestamp_updated()) {
                $this->dump_type_is_timestamp_updated = true;
                $this->dump_type_with_timestamps = true;
            } else {
                $this->dump_type_is_date = true;
                $this->dump_type_laravel = 'timestamp';
            }

        } elseif (in_array($this->dump_type_name, [
            'json',
        ])) {
            $this->dump_type_laravel = 'json';
            if (! empty($this->recipe->columns()[$this->dump_type_column])) {
                $this->dump_type_is_permissions = true;
            } elseif (! empty($this->recipe->permissions()[$this->dump_type_column])) {
                $this->dump_type_is_permissions = true;
            } elseif (! empty($this->recipe->status()[$this->dump_type_column])) {
                $this->dump_type_is_status = true;
            } elseif (! empty($this->recipe->ui()[$this->dump_type_column])) {
                $this->dump_type_is_ui = true;
            } else {
                $this->dump_type_is_json = true;
            }

            if (! empty($meta['default'])) {
                if ($meta['default'] === 'json_array()') {
                    $this->dump_type_laravel = 'JSON_ARRAY';
                    $this->dump_type_default = '[]';
                }
                if ($meta['default'] === 'json_object()') {
                    $this->dump_type_laravel = 'JSON_OBJECT';
                    $this->dump_type_default = '{}';
                }
            }
        } else {
            dd([
                '__METHOD__' => __METHOD__,
                '$i' => $i,
                '$meta' => $meta,
                '$this->dump_type_laravel' => $this->dump_type_laravel,
                '$this->dump_type_name' => $this->dump_type_name,
                '$this->dump_type_sql' => $this->dump_type_sql,
                '$this->recipes' => $this->recipes,
                '$this->recipe' => $this->recipe,
            ]);
        }

        // if ('active' === $this->dump_type_column) {
        //     dd([
        //         '__METHOD__' => __METHOD__,
        //         '$i' => $i,
        //         '$meta' => $meta,
        //         '$this->dump_type_column' => $this->dump_type_column,
        //         '$this->dump_type_laravel' => $this->dump_type_laravel,
        //         '$this->dump_type_name' => $this->dump_type_name,
        //         '$this->dump_type_sql' => $this->dump_type_sql,
        //         '$this->dump_type_nullable' => $this->dump_type_nullable,
        //         '$this->dump_type_size' => $this->dump_type_size,
        //         '$this->dump_type_comment' => $this->dump_type_comment,
        //         '$this->dump_type_is_column' => $this->dump_type_is_column,
        //         '$this->dump_type_is_flag' => $this->dump_type_is_flag,
        //         '$this->dump_type_is_date' => $this->dump_type_is_date,
        //         '$this->dump_type_is_id' => $this->dump_type_is_id,
        //         '$this->dump_type_is_user_id' => $this->dump_type_is_user_id,
        //         '$this->dump_type_is_json' => $this->dump_type_is_json,
        //         '$this->dump_type_is_matrix' => $this->dump_type_is_matrix,
        //         '$this->dump_type_is_permissions' => $this->dump_type_is_permissions,
        //         '$this->dump_type_is_status' => $this->dump_type_is_status,
        //         '$this->dump_type_is_ui' => $this->dump_type_is_ui,
        //         '$this->dump_type_is_unique' => $this->dump_type_is_unique,
        //     ]);
        // }

        // TODO check if column is an index or unique.

        // dd([
        //     '__METHOD__' => __METHOD__,
        //     '$i' => $i,
        //     '$meta' => $meta,
        //     '$this->dump_type_laravel' => $this->dump_type_laravel,
        //     '$this->dump_type_name' => $this->dump_type_name,
        //     '$this->dump_type_sql' => $this->dump_type_sql,
        // ]);

        // "$meta" => array:9 [
        //     "name" => "title"
        //     "type_name" => "varchar"
        //     "type" => "varchar(255)"
        //     "collation" => "utf8mb4_0900_ai_ci"
        //     "nullable" => false
        //     "default" => null
        //     "auto_increment" => false
        //     "comment" => null
        //     "generation" => null
        //   ]

    }

    protected function buildClass_configuration_identify_columns(Create $create): void
    {
        $start = $this->dump_primary_first ? 1 : 0;
        // dd([
        //     '__METHOD__' => __METHOD__,
        //     '$start' => $start,
        //     'count($this->dump_all_columns)' => count($this->dump_all_columns),
        //     '$create' => $create->apply()->toArray(),
        // ]);

        $this->dump_type_with_timestamps = false;
        $this->dump_type_with_softDeletes = false;

        for ($i = $start; $i < count($this->dump_all_columns); $i++) {

            if (empty($this->dump_all_columns[$i]['name'])
                || ! is_string($this->dump_all_columns[$i]['name'])
            ) {
                throw new \Exception(__('playground-make-model:dump.name.invalid'));
            }

            $this->buildClass_configuration_identify_column_type(
                $this->dump_all_columns[$i]['name'],
                $i,
                $this->dump_all_columns[$i]
            );

            $meta = [
                'label' => Str::of($this->dump_type_column)->replace('_', ' ')->ucfirst()->toString(),
                'name' => $this->dump_type_column,
                'nullable' => $this->dump_type_nullable,
            ];

            if (in_array($this->dump_type_laravel, [
                'decimal',
            ])) {
                if ($this->dump_type_precision) {
                    $meta['precision'] = $this->dump_type_precision;
                }
                if ($this->dump_type_scale) {
                    $meta['scale'] = $this->dump_type_scale;
                }
            }

            if (in_array($this->dump_type_laravel, [
                'string',
            ])) {
                if ($this->dump_type_size) {
                    $meta['size'] = $this->dump_type_size;
                }
            }

            if (is_scalar($this->dump_type_default)) {
                $meta['default'] = $this->dump_type_default;
            }

            if ($this->dump_type_is_column) {
                $meta['type'] = $this->dump_type_laravel;
                $this->dump_columns[$this->dump_type_column] = $meta;
            } elseif ($this->dump_type_is_flag) {
                $meta['type'] = $this->dump_type_laravel;
                $this->dump_flags[$this->dump_type_column] = $meta;
            } elseif ($this->dump_type_is_date) {
                $meta['type'] = $this->dump_type_laravel;
                $this->dump_dates[$this->dump_type_column] = $meta;
            } elseif ($this->dump_type_is_id) {
                $meta['type'] = $this->dump_type_laravel;
                $this->dump_ids[$this->dump_type_column] = $meta;
            } elseif ($this->dump_type_is_json) {
                $meta['type'] = $this->dump_type_laravel;
                $meta['comment'] = $this->dump_type_comment;
                $this->dump_json[$this->dump_type_column] = $meta;
            } elseif ($this->dump_type_is_permissions) {
                $meta['type'] = $this->dump_type_laravel;
                $this->dump_permissions[$this->dump_type_column] = $meta;
            } elseif ($this->dump_type_is_status) {
                $meta['type'] = $this->dump_type_laravel;
                $this->dump_status[$this->dump_type_column] = $meta;
            } elseif ($this->dump_type_is_ui) {
                $meta['type'] = $this->dump_type_laravel;
                $this->dump_ui[$this->dump_type_column] = $meta;
            } elseif ($this->dump_type_is_matrix) {
                $meta['type'] = $this->dump_type_laravel;
                $this->dump_matrix[$this->dump_type_column] = $meta;
            }

            // dump([
            //     '__METHOD__' => __METHOD__,
            //     '$i' => $i,
            //     '$meta' => $meta,
            //     // '$this->dump_all_columns' => $this->dump_all_columns,
            //     '$this->dump_columns' => $this->dump_columns,
            //     // '$create' => $create->apply()->toArray(),
            //     '$this->dump_all_columns[$i]' => $this->dump_all_columns[$i],
            //     '$this->dump_type_column' => $this->dump_type_column,
            //     '$this->dump_type_laravel' => $this->dump_type_laravel,
            //     '$this->dump_type_name' => $this->dump_type_name,
            //     '$this->dump_type_sql' => $this->dump_type_sql,
            //     '$this->dump_type_nullable' => $this->dump_type_nullable,
            //     '$this->dump_type_size' => $this->dump_type_size,
            //     '$this->dump_type_comment' => $this->dump_type_comment,
            //     '$this->dump_type_is_column' => $this->dump_type_is_column,
            //     '$this->dump_type_is_flag' => $this->dump_type_is_flag,
            //     '$this->dump_type_is_date' => $this->dump_type_is_date,
            //     '$this->dump_type_is_id' => $this->dump_type_is_id,
            //     '$this->dump_type_is_user_id' => $this->dump_type_is_user_id,
            //     '$this->dump_type_is_json' => $this->dump_type_is_json,
            //     '$this->dump_type_is_matrix' => $this->dump_type_is_matrix,
            //     '$this->dump_type_is_permissions' => $this->dump_type_is_permissions,
            //     '$this->dump_type_is_status' => $this->dump_type_is_status,
            //     '$this->dump_type_is_ui' => $this->dump_type_is_ui,
            //     '$this->dump_type_is_unique' => $this->dump_type_is_unique,
            // ]);
        }
    }
}
