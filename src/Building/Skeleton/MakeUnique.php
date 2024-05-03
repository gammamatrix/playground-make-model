<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Model\Building\Skeleton;

use Playground\Make\Configuration\Model\Create;

/**
 * \Playground\Make\Model\Building\Skeleton\MakeUnique
 */
trait MakeUnique
{
    protected function buildClass_skeleton_uniques(Create $create): void
    {
        $ui = $create->ui();

        $this->components->info(sprintf('Skeleton unique for [%s]', $this->c->name()));

        $keychain = [
            'keys' => [
                'slug',
                'parent_id',
            ],
        ];

        $create->addUnique(0, $keychain);
        // dd($create);
    }
}
