<?php

declare(strict_types=1);

namespace SprykerAcademyTest\Zed\Supplier\GlueApi;

use Codeception\Test\Unit;

/**
 * Structural tests for the Glue Storefront API exercise.
 * Verifies Provider, Mapper, Config, and resource YAML.
 *
 * Run: vendor/bin/codecept run -c tests/SprykerAcademyTest/Zed/Supplier/ GlueApi
 */
class GlueApiStructuralTest extends Unit
{
    // --- Provider ---

    public function testSuppliersProviderExists(): void
    {
        $class = 'SprykerAcademy\Glue\Supplier\Api\Storefront\Provider\SuppliersStorefrontProvider';
        $this->assertTrue(class_exists($class), 'SuppliersStorefrontProvider must exist.');
    }

    public function testSuppliersProviderImplementsProviderInterface(): void
    {
        $class = 'SprykerAcademy\Glue\Supplier\Api\Storefront\Provider\SuppliersStorefrontProvider';
        $interface = 'ApiPlatform\State\ProviderInterface';

        if (!interface_exists($interface)) {
            $this->markTestSkipped('ApiPlatform\State\ProviderInterface not available.');
        }

        $interfaces = class_implements($class);
        $this->assertContains(
            $interface,
            $interfaces,
            'Provider must implement ApiPlatform\State\ProviderInterface.',
        );
    }

    public function testSuppliersProviderHasProvideMethod(): void
    {
        $class = 'SprykerAcademy\Glue\Supplier\Api\Storefront\Provider\SuppliersStorefrontProvider';
        $this->assertTrue(
            method_exists($class, 'provide'),
            'Provider must have a provide() method.',
        );
    }

    // --- Mapper ---

    public function testSupplierMapperExists(): void
    {
        $class = 'SprykerAcademy\Glue\Supplier\Processor\Mapper\SupplierMapper';
        $this->assertTrue(class_exists($class), 'SupplierMapper must exist.');
    }

    public function testSupplierMapperHasMappingMethod(): void
    {
        $class = 'SprykerAcademy\Glue\Supplier\Processor\Mapper\SupplierMapper';
        $this->assertTrue(
            method_exists($class, 'mapSupplierTransferToSuppliersStorefrontResource'),
            'Mapper must have mapSupplierTransferToSuppliersStorefrontResource() method.',
        );
    }

    // --- Config ---

    public function testSuppliersApiConfigExists(): void
    {
        $class = 'SprykerAcademy\Glue\Supplier\SuppliersApiConfig';
        $this->assertTrue(class_exists($class), 'SuppliersApiConfig must exist.');
        $this->assertTrue(
            defined("$class::RESOURCE_SUPPLIERS"),
            'Config must have RESOURCE_SUPPLIERS constant.',
        );
        $this->assertSame(
            'suppliers',
            constant("$class::RESOURCE_SUPPLIERS"),
            'Resource name must be "suppliers".',
        );
    }

    // --- Resource YAML ---

    public function testSuppliersResourceYamlExists(): void
    {
        $paths = [
            __DIR__ . '/../../../../../src/SprykerAcademy/Glue/Supplier/resources/api/storefront/suppliers.resource.yml',
            getcwd() . '/src/SprykerAcademy/Glue/Supplier/resources/api/storefront/suppliers.resource.yml',
        ];

        $found = false;
        foreach ($paths as $path) {
            if (file_exists($path)) {
                $found = true;
                break;
            }
        }

        $this->assertTrue($found, 'suppliers.resource.yml must exist.');
    }

    public function testSuppliersResourceYamlHasProvider(): void
    {
        $path = $this->findResourceYaml('suppliers.resource.yml');
        $this->assertNotNull($path);

        $content = file_get_contents($path);
        $this->assertStringContainsString(
            'provider:',
            $content,
            'Resource YAML must define a provider.',
        );
        $this->assertStringContainsString(
            'SuppliersStorefrontProvider',
            $content,
            'Provider must reference SuppliersStorefrontProvider.',
        );
    }

    public function testSuppliersResourceYamlHasOperations(): void
    {
        $path = $this->findResourceYaml('suppliers.resource.yml');
        $this->assertNotNull($path);

        $content = file_get_contents($path);
        $this->assertStringContainsString('type: Get', $content, 'Must have Get operation.');
        $this->assertStringContainsString('type: GetCollection', $content, 'Must have GetCollection operation.');
    }

    public function testSuppliersResourceYamlHasProperties(): void
    {
        $path = $this->findResourceYaml('suppliers.resource.yml');
        $this->assertNotNull($path);

        $content = file_get_contents($path);
        $this->assertStringContainsString('idSupplier:', $content, 'Must have idSupplier property.');
        $this->assertStringContainsString('name:', $content, 'Must have name property.');
        $this->assertStringContainsString('identifier: true', $content, 'idSupplier must be marked as identifier.');
    }

    // --- Helpers ---

    private function findResourceYaml(string $filename): ?string
    {
        $patterns = [
            __DIR__ . '/../../../../../src/SprykerAcademy/Glue/*/resources/api/storefront/' . $filename,
            getcwd() . '/src/SprykerAcademy/Glue/*/resources/api/storefront/' . $filename,
        ];

        foreach ($patterns as $pattern) {
            $matches = glob($pattern);
            if ($matches) {
                return $matches[0];
            }
        }

        return null;
    }
}
