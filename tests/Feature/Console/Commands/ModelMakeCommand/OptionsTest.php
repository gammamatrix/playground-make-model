<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Tests\Feature\Playground\Make\Model\Console\Commands\ModelMakeCommand;

use Illuminate\Testing\PendingCommand;
use PHPUnit\Framework\Attributes\CoversClass;
use Playground\Make\Model\Console\Commands\ModelMakeCommand;
use Tests\Feature\Playground\Make\Model\TestCase;

/**
 * \Tests\Feature\Playground\Make\Model\Console\Commands\ModelMakeCommand\OptionsTest
 */
#[CoversClass(ModelMakeCommand::class)]
class OptionsTest extends TestCase
{
    public function test_command_make_model_with_all_of_the_option_flags_except_test(): void
    {
        // $command = 'playground:make:model testing --force --controller --factory --migration --policy --requests --seed --test';
        $command = 'playground:make:model testing --force --controller --factory --migration --policy --requests --seed --package acme';

        /**
         * @var PendingCommand $result
         */
        $result = $this->artisan($command);
        $result->assertExitCode(0);
    }

    public function test_command_make_model_with_pivot_type(): void
    {
        $command = 'playground:make:model testing --force --type pivot --package acme';

        /**
         * @var PendingCommand $result
         */
        $result = $this->artisan($command);
        $result->assertExitCode(0);
    }

    public function test_command_make_model_with_pivot_option(): void
    {
        $command = 'playground:make:model testing --force --pivot --package acme';

        /**
         * @var PendingCommand $result
         */
        $result = $this->artisan($command);
        $result->assertExitCode(0);
    }

    public function test_command_make_model_with_morph_pivot_type(): void
    {
        $command = 'playground:make:model testing --force --type morph-pivot --package acme';

        /**
         * @var PendingCommand $result
         */
        $result = $this->artisan($command);
        $result->assertExitCode(0);
    }

    public function test_command_make_model_with_morph_pivot_option(): void
    {
        $command = 'playground:make:model testing --force --morph-pivot --package acme';

        /**
         * @var PendingCommand $result
         */
        $result = $this->artisan($command);
        $result->assertExitCode(0);
    }

    public function test_command_make_model_with_api_type(): void
    {
        $command = 'playground:make:model testing --force --type api --package acme';

        /**
         * @var PendingCommand $result
         */
        $result = $this->artisan($command);
        $result->assertExitCode(0);
    }

    public function test_command_make_model_with_abstract_type(): void
    {
        $command = 'playground:make:model testing --force --type abstract --package acme';

        /**
         * @var PendingCommand $result
         */
        $result = $this->artisan($command);
        $result->assertExitCode(0);
    }

    public function test_command_make_model_with_model_type(): void
    {
        $command = 'playground:make:model testing --force --type model --package acme';

        /**
         * @var PendingCommand $result
         */
        $result = $this->artisan($command);
        $result->assertExitCode(0);
    }

    public function test_command_make_model_with_api_controller_option(): void
    {
        $command = 'playground:make:model testing --force --api --controller --package acme';

        /**
         * @var PendingCommand $result
         */
        $result = $this->artisan($command);
        $result->assertExitCode(0);
    }

    public function test_command_make_model_with_resource_controller_option(): void
    {
        $command = 'playground:make:model testing --force --resource --controller --package acme';

        /**
         * @var PendingCommand $result
         */
        $result = $this->artisan($command);
        $result->assertExitCode(0);
    }
}
