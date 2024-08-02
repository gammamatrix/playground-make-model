<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Recipe;

/**
 * \Playground\Make\Model\Recipe\AbstractModel
 */
class AbstractModel extends Model
{
    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $columns = [];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $dates = [];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $flags = [];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $ids = [];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $json = [];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $userIds = [];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $matrix = [];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $permissions = [];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $status = [];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $ui = [];

    /**
     * @var array<string, array<int, string>>
     */
    protected array $unique = [];
}
