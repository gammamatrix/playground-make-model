<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Tests\Feature\Playground\Make\Model\Console\Commands\SeederMakeCommand;

use PHPUnit\Framework\Attributes\CoversClass;
use Playground\Make\Model\Console\Commands\SeederMakeCommand;
use Tests\Feature\Playground\Make\Model\TestCase;

/**
 * \Tests\Feature\Playground\Make\Model\Console\Commands\SeederMakeCommand
 */
#[CoversClass(SeederMakeCommand::class)]
class CommandTest extends TestCase
{
    public function test_command_without_options_or_arguments(): void
    {
        /**
         * @var \Illuminate\Testing\PendingCommand $result
         */
        $result = $this->artisan('playground:make:seeder');
        $result->assertExitCode(1);
        $result->expectsOutputToContain( __('playground-make::generator.input.error'));
    }

    public function test_command_skeleton(): void
    {
        /**
         * @var \Illuminate\Testing\PendingCommand $result
         */
        $result = $this->artisan('playground:make:seeder testing --skeleton --force');
        $result->assertExitCode(0);
    }
}
