<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Model\Recipe;

use Illuminate\Support\Str;
use Playground\Make\Model\Recipe\Views\Index;

/**
 * \Playground\Make\Model\Recipe\Model
 */
abstract class Model implements Contracts\Models, Contracts\Views
{
    use Concerns\Columns;
    use Concerns\Dates;
    use Concerns\FactoryStates;
    use Concerns\Flags;
    use Concerns\HasMany;
    use Concerns\HasManyThrough;
    use Concerns\HasOne;
    use Concerns\Ids;
    use Concerns\Json;
    use Concerns\Matrix;
    use Concerns\Permissions;
    use Concerns\Status;
    use Concerns\Ui;
    use Concerns\Unique;

    protected string $name = '';

    protected string $names = '';

    protected string $name_camel = '';

    protected string $name_camels = '';

    protected string $name_kebab = '';

    protected string $name_kebabs = '';

    protected string $name_label = '';

    protected string $name_labels = '';

    protected string $name_lower = '';

    protected string $name_lowers = '';

    protected string $name_snake = '';

    protected string $name_snakes = '';

    protected string $name_studly = '';

    protected string $name_studlies = '';

    protected string $table_id = '';

    protected string $type = '';

    protected string $timestamp_created = 'created_at';

    protected string $timestamp_deleted = 'deleted_at';

    protected string $timestamp_updated = 'updated_at';

    private Index $index;

    /**
     * @var array<string, mixed>
     */
    protected array $options_index = [];

    public function __construct(string $name, string $type)
    {
        $this->type = $type;

        $this->name = $name;
        $this->names = Str::of($name)->plural()->toString();

        $this->name_kebab = Str::of($name)->kebab()->toString();
        $this->name_kebabs = Str::of($this->names)->kebab()->toString();
        $this->name_label = Str::of($this->name_kebab)->headline()->toString();
        $this->name_labels = Str::of($this->name_label)->plural()->toString();
        $this->name_lower = Str::of($this->name_label)->lower()->toString();
        $this->name_lowers = Str::of($this->name_lower)->plural()->toString();

        /**
         * Camel, snake and studly need to end with an "s" for has one
         * and many accessors, variables and class names.
         *
         * plural() will try to properly apply the correct ending.
         */
        $this->name_camel = Str::of($name)->camel()->toString();

        $this->name_snake = Str::of($name)->snake()->toString();

        $this->name_studly = Str::of($name)->studly()->toString();

        if (in_array($type, [
            // 'playground-api-linked',
            // 'playground-resource-linked',
            'playground-model-tagged',
        ])) {
            // TODO check for words ending with "ed" instead?
            $this->name_camels = $this->name_camel;
            $this->name_kebabs = $this->name_kebab;
            $this->name_snakes = $this->name_snake;
            $this->name_studlies = $this->name_studly;
        } else {
            $this->name_kebabs = Str::of($this->names)->kebab()->finish('s')->toString();
            $this->name_camels = Str::of($this->names)->camel()->finish('s')->toString();
            $this->name_snakes = Str::of($this->names)->snake()->finish('s')->toString();
            $this->name_studlies = Str::of($this->names)->studly()->finish('s')->toString();
        }

        $this->table_id = Str::of($this->name_snake)->finish('_id')->toString();
        //        dump([
        //            '__METHOD__' => __METHOD__,
        //            '$name' => $name,
        //            '$type' => $type,
        //        ]);

        $this->init();
    }

    public function init(): void {}

    public function name(): string
    {
        return $this->name;
    }

    public function names(): string
    {
        return $this->names;
    }

    public function name_camel(): string
    {
        return $this->name_camel;
    }

    public function name_camels(): string
    {
        return $this->name_camels;
    }

    public function name_kebab(): string
    {
        return $this->name_kebab;
    }

    public function name_kebabs(): string
    {
        return $this->name_kebabs;
    }

    public function name_lower(): string
    {
        return $this->name_lower;
    }

    public function name_lowers(): string
    {
        return $this->name_lowers;
    }

    public function name_snake(): string
    {
        return $this->name_snake;
    }

    public function name_snakes(): string
    {
        return $this->name_snakes;
    }

    public function name_studly(): string
    {
        return $this->name_studly;
    }

    public function name_studlies(): string
    {
        return $this->name_studlies;
    }

    public function name_label(): string
    {
        return $this->name_label;
    }

    public function name_labels(): string
    {
        return $this->name_label;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function index(): Index
    {
        if (empty($this->index)) {
            $this->index = new Index($this->options_index);
        }

        return $this->index;
    }

    public function timestamp_created(): string
    {
        return $this->timestamp_created;
    }

    public function timestamp_deleted(): string
    {
        return $this->timestamp_deleted;
    }

    public function timestamp_updated(): string
    {
        return $this->timestamp_updated;
    }
}
