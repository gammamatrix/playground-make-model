<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Building\Dump;

use Illuminate\Support\Facades\Schema;

/**
 * \Playground\Make\Model\Building\Dump\ListTables
 */
trait ListTables
{
    /**
     * @var array<int, array<string, mixed>>
     */
    protected $dump_tables = [];

    /**
     * @var array<int, string>
     */
    protected $dump_tables_listing = [];

    protected function listTables(): ?bool
    {
        $this->dump_tables = Schema::getTables();
        $this->dump_tables_listing = Schema::getTableListing();
        dump([
            '__METHOD__' => __METHOD__,
            // '$this->c' => $this->c,
            '$this->options()' => $this->options(),
            '$this->dump_tables' => $this->dump_tables,
            '$this->dump_tables_listing' => $this->dump_tables_listing,
        ]);

        return null;
    }
}
