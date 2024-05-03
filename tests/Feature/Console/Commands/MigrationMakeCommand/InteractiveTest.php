<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Tests\Feature\Playground\Make\Model\Console\Commands\MigrationMakeCommand;

use Playground\Make\Model\Console\Commands\Concerns\InteractiveCommands;
use Tests\Feature\Playground\Make\Model\TestCase;

/**
 * \Tests\Feature\Playground\Make\Model\Console\Commands\MigrationMakeCommand\InteractiveTest
 */
class InteractiveTest extends TestCase
{
    /**
     * @see InteractiveCommands::interactivePromptForName()
     * @see InteractiveCommands::interactivePromptForNamespace()
     * @see InteractiveCommands::interactivePromptForOrganization()
     * @see InteractiveCommands::interactivePromptForPackage()
     */
    public function test_command_with_interactive_option(): void
    {
        /**
         * @var \Illuminate\Testing\PendingCommand $result
         */
        $result = $this->artisan('playground:make:migration --force --interactive');
        $result->expectsQuestion('What should the migration be named?', 'testing')
            ->expectsQuestion('What namespace should be used?', 'Acme/Testing')
            ->expectsQuestion('What organization should be used?', 'Acme')
            ->expectsQuestion('What package should be used?', 'acme-testing');
        $result->assertExitCode(0);
    }

    /**
     * @see InteractiveCommands::interactivePromptForName()
     */
    public function test_command_with_interactive_option_and_cancel(): void
    {
        /**
         * @var \Illuminate\Testing\PendingCommand $result
         */
        $result = $this->artisan('playground:make:migration --interactive');
        $result->expectsQuestion('What should the migration be named?', false);
        $result->assertExitCode(1);
    }
}
