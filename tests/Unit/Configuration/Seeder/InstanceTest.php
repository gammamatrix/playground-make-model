<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Tests\Unit\Playground\Make\Model\Configuration\Seeder;

use PHPUnit\Framework\Attributes\CoversClass;
use Tests\Unit\Playground\Make\Model\TestCase;
use Playground\Make\Model\Configuration\Seeder;

/**
 * \Tests\Unit\Playground\Make\Model\Configuration\Seeder\InstanceTest
 */
#[CoversClass(Seeder::class)]
class InstanceTest extends TestCase
{
    public function test_instance(): void
    {
        $instance = new Seeder;

        $this->assertInstanceOf(Seeder::class, $instance);
    }

    /**
     * @var array<string, mixed>
     */
    protected array $expected_properties = [
        'class' => '',
        'config' => '',
        'fqdn' => '',
        'module' => '',
        'module_slug' => '',
        'name' => '',
        'namespace' => '',
        'organization' => '',
        'package' => '',
        // properties
        'model' => '',
        'model_fqdn' => '',
        'type' => '',
        'models' => [],
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

    public function test_folder_is_empty_by_default(): void
    {
        $instance = new Seeder;

        $this->assertInstanceOf(Seeder::class, $instance);

        $this->assertIsString($instance->folder());
        $this->assertEmpty($instance->folder());
    }

    public function test_seeder_for_model_with_file_and_skeleton(): void
    {
        $options = $this->getResourceFileAsArray('seeder-model');
        // dd([
        //     '__METHOD__' => __METHOD__,
        //     '$options' => $options,
        // ]);

        $instance = new Seeder($options, true);

        $instance->apply();
        // dump([
        //     '__METHOD__' => __METHOD__,
        //     '$options' => $options,
        //     '$instance' => $instance,
        //     // 'json_encode($instance)' => json_encode($instance, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT),
        //     // '$options' => $options,
        // ]);
        // echo(json_encode($instance, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        $this->assertEmpty($instance->folder());
        $this->assertTrue($instance->skeleton());

        $this->assertSame('Playground', $instance->organization());
        $this->assertSame('playground-crm', $instance->package());
        $this->assertSame('Crm', $instance->module());
        $this->assertSame('crm', $instance->module_slug());
        $this->assertSame('', $instance->fqdn());
        $this->assertSame('Playground/Crm', $instance->namespace());
        $this->assertSame('Contact', $instance->name());
        $this->assertSame('', $instance->class());
        $this->assertSame('playground-model', $instance->type());
        $this->assertSame([], $instance->uses());
        $this->assertSame([
            'Contact' => 'tmp-testing-model.crm.contact.json',
        ], $instance->models());
    }
}
