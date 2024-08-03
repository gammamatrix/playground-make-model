<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Recipe\Contracts;

/**
 * \Playground\Make\Model\Recipe\Contracts\Models
 */
interface Models
{
    /**
     * @return array<string, array<string, mixed>>
     */
    public function columns(): array;

    /**
     * @return array<string, array<string, mixed>>
     */
    public function dates(): array;

    /**
     * @return array<string, array<string, mixed>>
     */
    public function factoryStates(): array;

    /**
     * @return array<string, array<string, mixed>>
     */
    public function flags(): array;

    /**
     * @return array<string, array<string, mixed>>
     */
    public function hasMany(): array;

    /**
     * @return array<string, array<string, mixed>>
     */
    public function hasOne(): array;

    /**
     * @return array<string, array<string, mixed>>
     */
    public function ids(): array;

    /**
     * @return array<string, array<string, mixed>>
     */
    public function json(): array;

    /**
     * @return array<string, array<string, mixed>>
     */
    public function userIds(): array;

    /**
     * @return array<string, array<string, mixed>>
     */
    public function matrix(): array;

    /**
     * @return array<string, array<string, mixed>>
     */
    public function permissions(): array;

    /**
     * @return array<string, array<string, mixed>>
     */
    public function status(): array;

    /**
     * @return array<string, array<string, mixed>>
     */
    public function ui(): array;

    /**
     * @return array<string, array<int, string>>
     */
    public function unique(): array;
}
