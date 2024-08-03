<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Recipe;

/**
 * \Playground\Make\Model\Recipe\Model
 */
abstract class Model implements Contracts\Models
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

    protected string $type = '';

    public function __construct(string $name, string $type)
    {
        $this->name = $name;
        $this->type = $type;

        $this->init();
    }

    public function init(): void
    {
    }

    public function name(): string
    {
        return $this->name;
    }

    public function type(): string
    {
        return $this->type;
    }
}
