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
    use Concerns\HasOne;
    use Concerns\Ids;
    use Concerns\Json;
    use Concerns\Matrix;
    use Concerns\Permissions;
    use Concerns\Status;
    use Concerns\Ui;
    use Concerns\Unique;

    protected string $name = '';

    protected string $name_camel = '';

    protected string $name_camels = '';

    protected string $name_kebab = '';

    protected string $name_lower = '';

    protected string $name_snake = '';

    protected string $name_snakes = '';

    protected string $name_title = '';

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
        $this->name = $name;
        $this->type = $type;

        $this->name_kebab = Str::of($name)->kebab()->toString();
        $this->name_title = Str::of($this->name_kebab)->headline()->toString();
        $this->name_lower = Str::of($this->name_title)->lower()->toString();

        /**
         * Snake and camel need to end with an "s" for has one and many accessors.
         *
         * plural() will try to properly apply the correct ending.
         */
        $this->name_camel = Str::of($name)->camel()->toString();

        $this->name_snake = Str::of($name)->snake()->toString();

        if (in_array($type, [
            // 'playground-api-linked',
            // 'playground-resource-linked',
            'playground-model-tagged',
        ])) {
            // TODO check for words ending with "ed" instead?
            $this->name_camels = $this->name_camel;
            $this->name_snakes = $this->name_snake;
        } else {
            $this->name_camels = Str::of($name)->plural()->camel()->finish('s')->toString();
            $this->name_snakes = Str::of($name)->plural()->snake()->finish('s')->toString();
        }

        $this->table_id = Str::of($this->name_snake)->finish('_id')->toString();
        dump([
            '__METHOD__' => __METHOD__,
            '$name' => $name,
            '$type' => $type,
        ]);

        $this->init();
    }

    public function init(): void {}

    public function name(): string
    {
        return $this->name;
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
