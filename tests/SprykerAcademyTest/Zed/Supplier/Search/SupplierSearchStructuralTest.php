<?php

declare(strict_types=1);

namespace SprykerAcademyTest\Zed\Supplier\Search;

use Codeception\Test\Unit;

/**
 * Structural tests for the SupplierSearch Client module.
 * No Spryker kernel or Elasticsearch required.
 *
 * Run: vendor/bin/codecept run -c tests/SprykerAcademyTest/Zed/Supplier/ Search
 */
class SupplierSearchStructuralTest extends Unit
{
    // --- Query Plugin ---

    public function testQueryPluginExists(): void
    {
        $class = 'SprykerAcademy\Client\SupplierSearch\Plugin\Elasticsearch\Query\SupplierSearchQueryPlugin';
        $this->assertTrue(class_exists($class), 'SupplierSearchQueryPlugin must exist.');
    }

    public function testQueryPluginImplementsRequiredInterfaces(): void
    {
        $class = 'SprykerAcademy\Client\SupplierSearch\Plugin\Elasticsearch\Query\SupplierSearchQueryPlugin';
        $interfaces = class_implements($class);

        $this->assertContains(
            'Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface',
            $interfaces,
            'Must implement QueryInterface.',
        );
        $this->assertContains(
            'Spryker\Client\SearchExtension\Dependency\Plugin\SearchContextAwareQueryInterface',
            $interfaces,
            'Must implement SearchContextAwareQueryInterface.',
        );
    }

    public function testQueryPluginHasSourceIdentifier(): void
    {
        $class = 'SprykerAcademy\Client\SupplierSearch\Plugin\Elasticsearch\Query\SupplierSearchQueryPlugin';
        $reflection = new \ReflectionClass($class);
        $constant = $reflection->getConstant('SOURCE_IDENTIFIER');

        $this->assertNotEmpty($constant, 'SOURCE_IDENTIFIER must be set (not empty).');
        $this->assertSame('supplier', $constant, 'SOURCE_IDENTIFIER must be "supplier".');
    }

    public function testQueryPluginReturnsElasticaQuery(): void
    {
        $class = 'SprykerAcademy\Client\SupplierSearch\Plugin\Elasticsearch\Query\SupplierSearchQueryPlugin';
        $plugin = new $class('test');

        $query = $plugin->getSearchQuery();

        $this->assertInstanceOf(
            'Elastica\Query',
            $query,
            'getSearchQuery() must return an Elastica Query.',
        );
    }

    // --- Result Formatter Plugin ---

    public function testResultFormatterPluginExists(): void
    {
        $class = 'SprykerAcademy\Client\SupplierSearch\Plugin\Elasticsearch\ResultFormatter\SupplierSearchResultFormatterPlugin';
        $this->assertTrue(class_exists($class), 'SupplierSearchResultFormatterPlugin must exist.');
    }

    public function testResultFormatterPluginHasName(): void
    {
        $class = 'SprykerAcademy\Client\SupplierSearch\Plugin\Elasticsearch\ResultFormatter\SupplierSearchResultFormatterPlugin';
        $plugin = new $class();

        $this->assertSame('supplier', $plugin->getName(), 'Formatter NAME must be "supplier".');
    }

    // --- Client ---

    public function testSupplierSearchClientExists(): void
    {
        $class = 'SprykerAcademy\Client\SupplierSearch\SupplierSearchClient';
        $this->assertTrue(class_exists($class), 'SupplierSearchClient must exist.');
        $this->assertTrue(
            method_exists($class, 'getSupplierByName'),
            'Client must have getSupplierByName() method.',
        );
    }

    public function testSupplierSearchClientImplementsInterface(): void
    {
        $class = 'SprykerAcademy\Client\SupplierSearch\SupplierSearchClient';
        $interface = 'SprykerAcademy\Client\SupplierSearch\SupplierSearchClientInterface';

        $this->assertTrue(interface_exists($interface), 'SupplierSearchClientInterface must exist.');
        $this->assertTrue(
            is_subclass_of($class, $interface) || in_array($interface, class_implements($class)),
            'Client must implement SupplierSearchClientInterface.',
        );
    }

    // --- Factory ---

    public function testFactoryExists(): void
    {
        $class = 'SprykerAcademy\Client\SupplierSearch\SupplierSearchFactory';
        $this->assertTrue(class_exists($class), 'SupplierSearchFactory must exist.');
        $this->assertTrue(
            method_exists($class, 'createSupplierQueryPlugin'),
            'Factory must have createSupplierQueryPlugin() method.',
        );
        $this->assertTrue(
            method_exists($class, 'getSearchQueryFormatters'),
            'Factory must have getSearchQueryFormatters() method.',
        );
        $this->assertTrue(
            method_exists($class, 'getSearchClient'),
            'Factory must have getSearchClient() method.',
        );
    }

    // --- DependencyProvider ---

    public function testDependencyProviderExists(): void
    {
        $class = 'SprykerAcademy\Client\SupplierSearch\SupplierSearchDependencyProvider';
        $this->assertTrue(class_exists($class), 'SupplierSearchDependencyProvider must exist.');
        $this->assertTrue(
            defined("$class::CLIENT_SEARCH"),
            'Must have CLIENT_SEARCH constant.',
        );
        $this->assertTrue(
            defined("$class::SUPPLIER_SEARCH_RESULT_FORMATTER_PLUGINS"),
            'Must have SUPPLIER_SEARCH_RESULT_FORMATTER_PLUGINS constant.',
        );
    }

    // --- Elasticsearch Schema ---

    public function testElasticsearchSchemaExists(): void
    {
        $paths = [
            __DIR__ . '/../../../../../src/SprykerAcademy/Shared/SupplierSearch/Schema/supplier.json',
            getcwd() . '/src/SprykerAcademy/Shared/SupplierSearch/Schema/supplier.json',
        ];

        $found = false;
        foreach ($paths as $path) {
            if (file_exists($path)) {
                $found = true;
                $json = json_decode(file_get_contents($path), true);
                $this->assertNotNull($json, 'supplier.json must be valid JSON.');
                $this->assertArrayHasKey('settings', $json, 'Schema must have settings.');
                $this->assertArrayHasKey('mappings', $json, 'Schema must have mappings.');
                break;
            }
        }

        $this->assertTrue($found, 'Shared/SupplierSearch/Schema/supplier.json must exist.');
    }

    // --- Yves SupplierPage ---

    public function testSupplierPageRouteProviderExists(): void
    {
        $class = 'SprykerAcademy\Yves\SupplierPage\Plugin\Router\SupplierPageRouteProviderPlugin';
        $this->assertTrue(class_exists($class), 'SupplierPageRouteProviderPlugin must exist.');
        $this->assertTrue(
            method_exists($class, 'addRoutes'),
            'Must have addRoutes() method.',
        );
    }

    public function testSupplierPageFactoryExists(): void
    {
        $class = 'SprykerAcademy\Yves\SupplierPage\SupplierPageFactory';
        $this->assertTrue(class_exists($class), 'SupplierPageFactory must exist.');
    }
}
