<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Tests\Unit\Playground\Make\Model\Configuration\Seeder;

use PHPUnit\Framework\Attributes\CoversClass;
use Playground\Make\Model\Configuration\Seeder;
use Tests\Unit\Playground\Make\Model\TestCase;

/**
 * \Tests\Unit\Playground\Make\Model\Configuration\Seeder\InstanceTest
 */
#[CoversClass(Seeder::class)]
class InstanceTest extends TestCase
{
    public function test_instance(): void
    {
        $instance = new Seeder;

        /** @phpstan-ignore method.alreadyNarrowedType */
        $this->assertInstanceOf(Seeder::class, $instance);
    }

    /**
     * @var array<string, mixed>
     */
    protected array $expected_properties = [
        'type' => '',
        'model' => '',
        'model_tag' => '',
        'model_tagged' => '',
    ];

    public function test_instance_apply_without_options(): void
    {
        $instance = new Seeder;

        $properties = $instance->apply()->properties();

        $this->assertIsArray($properties);

        $this->assertSame($this->expected_properties, $properties);

        $jsonSerialize = $instance->jsonSerialize();

        $this->assertIsArray($jsonSerialize);

        $this->assertSame($properties, $jsonSerialize);
    }
}
