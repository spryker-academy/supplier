<?php

declare(strict_types=1);

namespace SprykerAcademyTest\Zed\Supplier\GlueApi;

use Codeception\Test\Unit;

/**
 * Structural tests for the Glue Storefront and Backend API exercise.
 * Verifies the providers, mappers, config and resource YAML files.
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

    public function testSuppliersResourceYamlHasThePaginationProperty(): void
    {
        $path = $this->findResourceYaml('suppliers.resource.yml');
        $this->assertNotNull($path);

        $content = file_get_contents($path);
        $this->assertStringContainsString('pagination:', $content, 'The resource needs the `pagination` property the provider sets on the first item.');
        $this->assertStringContainsString('numFound:', $content, 'The pagination object must have numFound.');
    }

    public function testSuppliersResourceYamlIncludesTheSupplierLocations(): void
    {
        $path = $this->findResourceYaml('suppliers.resource.yml');
        $this->assertNotNull($path);

        $content = file_get_contents($path);
        $this->assertMatchesRegularExpression('/^\s*includes:/m', $content, 'The Storefront suppliers resource needs an `includes` list.');
        $this->assertMatchesRegularExpression(
            '/^\s*-\s*relationshipName:\s*supplier-locations\s*$/m',
            $content,
            'The relationship must be named supplier-locations: that is the value of ?include=.',
        );
        $this->assertMatchesRegularExpression(
            '/^\s*targetResource:\s*SupplierLocations\s*$/m',
            $content,
            'targetResource is the `name` of the supplier-locations resource: SupplierLocations.',
        );
        $this->assertMatchesRegularExpression(
            '/^\s*uriVariableMappings:\s*\n\s*idSupplier:\s*idSupplier\s*$/m',
            $content,
            'uriVariableMappings must pass the supplier\'s idSupplier to the idSupplier URI variable of the locations provider.',
        );
    }

    public function testSupplierLocationsStorefrontProviderExists(): void
    {
        $class = 'SprykerAcademy\Glue\Supplier\Api\Storefront\Provider\SupplierLocationsStorefrontProvider';
        $this->assertTrue(class_exists($class), 'SupplierLocationsStorefrontProvider must exist.');
        $this->assertContains('ApiPlatform\State\ProviderInterface', class_implements($class));
    }

    // --- Backend API ---

    public function testSuppliersBackendProviderExists(): void
    {
        $class = 'SprykerAcademy\Glue\Supplier\Api\Backend\Provider\SuppliersBackendProvider';
        $this->assertTrue(class_exists($class), 'SuppliersBackendProvider must exist.');
        $this->assertContains(
            'ApiPlatform\State\ProviderInterface',
            class_implements($class),
            'The Backend provider must implement ApiPlatform\State\ProviderInterface (AbstractBackendProvider does).',
        );
    }

    public function testSupplierLocationsBackendProviderExists(): void
    {
        $class = 'SprykerAcademy\Glue\Supplier\Api\Backend\Provider\SupplierLocationsBackendProvider';
        $this->assertTrue(class_exists($class), 'SupplierLocationsBackendProvider must exist.');
        $this->assertContains('ApiPlatform\State\ProviderInterface', class_implements($class));
    }

    public function testSuppliersBackendResourceYamlHasProvider(): void
    {
        $path = $this->findResourceYaml('suppliers.resource.yml', 'backend');
        $this->assertNotNull($path, 'resources/api/backend/suppliers.resource.yml must exist.');

        $this->assertMatchesRegularExpression(
            '/^\s*provider:\s*.*SuppliersBackendProvider\s*$/m',
            file_get_contents($path),
            'The Backend resource must name SuppliersBackendProvider as its provider.',
        );
    }

    public function testSuppliersBackendResourceYamlIncludesTheSupplierLocations(): void
    {
        $path = $this->findResourceYaml('suppliers.resource.yml', 'backend');
        $this->assertNotNull($path);

        $content = file_get_contents($path);
        $this->assertMatchesRegularExpression('/^\s*includes:/m', $content, 'The Backend suppliers resource needs an `includes` list.');
        $this->assertMatchesRegularExpression(
            '/^\s*-\s*relationshipName:\s*supplier-locations\s*$/m',
            $content,
            'The relationship must be named supplier-locations: that is the value of ?include=.',
        );
        $this->assertMatchesRegularExpression(
            '/^\s*targetResource:\s*SupplierLocations\s*$/m',
            $content,
            'targetResource is the `name` of the supplier-locations resource: SupplierLocations.',
        );
        $this->assertMatchesRegularExpression(
            '/^\s*uriVariableMappings:\s*\n\s*idSupplier:\s*idSupplier\s*$/m',
            $content,
            'uriVariableMappings must pass the supplier\'s idSupplier to the idSupplier URI variable of the locations provider.',
        );
    }

    public function testSupplierLocationsBackendResourceYamlHasProviderAndOperations(): void
    {
        $path = $this->findResourceYaml('supplier-locations.resource.yml', 'backend');
        $this->assertNotNull($path, 'resources/api/backend/supplier-locations.resource.yml must exist.');

        $content = file_get_contents($path);
        $this->assertMatchesRegularExpression(
            '/^\s*provider:\s*.*SupplierLocationsBackendProvider\s*$/m',
            $content,
            'The resource must name SupplierLocationsBackendProvider as its provider.',
        );
        $this->assertStringContainsString('/suppliers/{idSupplier}/supplier-locations', $content, 'The collection lives under its supplier.');
    }

    // --- Helpers ---

    private function findResourceYaml(string $filename, string $apiType = 'storefront'): ?string
    {
        $patterns = [
            __DIR__ . '/../../../../../src/SprykerAcademy/Glue/*/resources/api/' . $apiType . '/' . $filename,
            getcwd() . '/src/SprykerAcademy/Glue/*/resources/api/' . $apiType . '/' . $filename,
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
