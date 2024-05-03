<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Tests\Feature\Playground\Make\Model\Console\Commands\ModelMakeCommand;

use PHPUnit\Framework\Attributes\CoversClass;
use Playground\Make\Model\Console\Commands\ModelMakeCommand;
use Tests\Feature\Playground\Make\Model\TestCase;

/**
 * \Tests\Feature\Playground\Make\Model\Console\Commands\ModelMakeCommand\ModelTest
 */
#[CoversClass(ModelMakeCommand::class)]
class ModelTest extends TestCase
{
    public function test_command_make_model_with_force(): void
    {
        $command = sprintf(
            'playground:make:model --force --file %1$s',
            $this->getResourceFile('model')
        );

        /**
         * @var \Illuminate\Testing\PendingCommand $result
         */
        $result = $this->artisan($command);
        $result->assertExitCode(0);
    }

    public function test_command_make_playground_model_api_with_force(): void
    {
        $command = sprintf(
            'playground:make:model --force --playground --api --file %1$s',
            $this->getResourceFile('playground-model')
        );

        /**
         * @var \Illuminate\Testing\PendingCommand $result
         */
        $result = $this->artisan($command);
        $result->assertExitCode(0);
    }

    public function test_command_make_playground_model_resource_with_force(): void
    {
        $command = sprintf(
            'playground:make:model --force --playground --resource --file %1$s',
            $this->getResourceFile('playground-model')
        );

        /**
         * @var \Illuminate\Testing\PendingCommand $result
         */
        $result = $this->artisan($command);
        $result->assertExitCode(0);
    }

    public function test_command_make_all_playground_model_api_with_force(): void
    {
        $command = sprintf(
            'playground:make:model --all --playground --force --file %1$s',
            $this->getResourceFile('playground-model')
        );

        /**
         * @var \Illuminate\Testing\PendingCommand $result
         */
        $result = $this->artisan($command);
        $result->assertExitCode(0);
    }

    public function test_command_make_all_playground_model_resource_with_force(): void
    {
        $command = sprintf(
            'playground:make:model --all --force --playground --resource --file %1$s',
            $this->getResourceFile('playground-model')
        );

        /**
         * @var \Illuminate\Testing\PendingCommand $result
         */
        $result = $this->artisan($command);
        $result->assertExitCode(0);
    }
}
