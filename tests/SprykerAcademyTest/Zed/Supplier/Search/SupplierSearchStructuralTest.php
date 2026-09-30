<?php

declare(strict_types=1);

namespace SprykerAcademyTest\Zed\Supplier\Search;

use Codeception\Test\Unit;
use ReflectionClass;
use SprykerAcademy\Client\SupplierSearch\Plugin\Elasticsearch\Query\SupplierSearchQueryPlugin;
use SprykerAcademy\Client\SupplierSearch\Plugin\Elasticsearch\ResultFormatter\SupplierSearchResultFormatterPlugin;
use SprykerAcademy\Client\SupplierSearch\SupplierSearchClient;
use SprykerAcademy\Client\SupplierSearch\SupplierSearchClientInterface;
use SprykerAcademy\Client\SupplierSearch\SupplierSearchDependencyProvider;
use SprykerAcademy\Client\SupplierSearch\SupplierSearchFactory;
use SprykerAcademy\Shared\SupplierSearch\SupplierSearchConfig;

/**
 * Structural tests for the SupplierSearch client module (Exercise: Search).
 * No Elasticsearch connection is needed.
 *
 * Run: vendor/bin/codecept run -c tests/SprykerAcademyTest/Zed/Supplier/ Search
 */
class SupplierSearchStructuralTest extends Unit
{
    // --- Query plugin ---

    public function testQueryPluginImplementsRequiredInterfaces(): void
    {
        $this->assertTrue(class_exists(SupplierSearchQueryPlugin::class), 'SupplierSearchQueryPlugin must exist.');
        $interfaces = class_implements(SupplierSearchQueryPlugin::class);

        $this->assertContains('Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface', $interfaces, 'The query plugin must implement QueryInterface.');
        $this->assertContains('Spryker\Client\SearchExtension\Dependency\Plugin\SearchContextAwareQueryInterface', $interfaces, 'The query plugin must implement SearchContextAwareQueryInterface.');
    }

    public function testQueryPluginUsesTheSupplierSourceIdentifier(): void
    {
        $plugin = new SupplierSearchQueryPlugin();

        $this->assertSame(
            SupplierSearchConfig::SUPPLIER_SOURCE_IDENTIFIER,
            $plugin->getSearchContext()->getSourceIdentifier(),
            'getSearchContext() must set the source identifier to SupplierSearchConfig::SUPPLIER_SOURCE_IDENTIFIER, so the query hits the supplier index.',
        );
    }

    public function testQueryPluginReturnsElasticaQuery(): void
    {
        $query = (new SupplierSearchQueryPlugin())->getSearchQuery();

        $this->assertInstanceOf('Elastica\Query', $query, 'getSearchQuery() must return an Elastica\Query.');
    }

    // --- Result formatter ---

    public function testResultFormatterPluginExtendsTheElasticsearchFormatter(): void
    {
        $this->assertTrue(class_exists(SupplierSearchResultFormatterPlugin::class), 'SupplierSearchResultFormatterPlugin must exist.');
        $this->assertTrue(
            is_subclass_of(SupplierSearchResultFormatterPlugin::class, 'Spryker\Client\SearchElasticsearch\Plugin\ResultFormatter\AbstractElasticsearchResultFormatterPlugin'),
            'The result formatter must extend AbstractElasticsearchResultFormatterPlugin.',
        );
    }

    public function testResultFormatterPluginHasName(): void
    {
        $this->assertNotEmpty((new SupplierSearchResultFormatterPlugin())->getName(), 'getName() must return the key under which the formatted result is returned.');
    }

    // --- Client, factory, dependency provider ---

    public function testClientImplementsInterface(): void
    {
        $this->assertTrue(interface_exists(SupplierSearchClientInterface::class), 'SupplierSearchClientInterface must exist.');
        $this->assertContains(SupplierSearchClientInterface::class, class_implements(SupplierSearchClient::class), 'SupplierSearchClient must implement SupplierSearchClientInterface.');
        $this->assertTrue(method_exists(SupplierSearchClientInterface::class, 'searchSuppliers'), 'The client interface must declare searchSuppliers().');
    }

    public function testClientDelegatesToTheReader(): void
    {
        $source = php_strip_whitespace((new ReflectionClass(SupplierSearchClient::class))->getFileName()); // comments (hints) removed

        $this->assertStringContainsString(
            'createSupplierSearchReader()',
            $source,
            'searchSuppliers() must delegate to the reader created by the factory ($this->getFactory()->createSupplierSearchReader()).',
        );
    }

    public function testFactoryCreatesTheReaderWithAllDependencies(): void
    {
        $this->assertTrue(method_exists(SupplierSearchFactory::class, 'createSupplierSearchReader'), 'The factory must have createSupplierSearchReader().');
        $source = php_strip_whitespace((new ReflectionClass(SupplierSearchFactory::class))->getFileName()); // comments (hints) removed

        foreach (['getSearchClient()', 'getSupplierSearchQueryPlugin()', 'getSupplierSearchQueryExpanderPlugins()', 'getSupplierSearchResultFormatterPlugins()'] as $call) {
            $this->assertStringContainsString($call, $source, sprintf('createSupplierSearchReader() must pass %s to the reader.', $call));
        }
    }

    public function testDependencyProviderProvidesSearchClientAndPlugins(): void
    {
        $container = new \Spryker\Client\Kernel\Container();
        $container = (new SupplierSearchDependencyProvider())->provideServiceLayerDependencies($container);

        foreach ([
            SupplierSearchDependencyProvider::CLIENT_SEARCH => 'the Search client',
            SupplierSearchDependencyProvider::PLUGIN_SUPPLIER_SEARCH_QUERY => 'the SupplierSearchQueryPlugin',
            SupplierSearchDependencyProvider::PLUGINS_SUPPLIER_SEARCH_RESULT_FORMATTER => 'the result formatter plugins',
            SupplierSearchDependencyProvider::PLUGINS_SUPPLIER_SEARCH_QUERY_EXPANDER => 'the query expander plugins',
        ] as $key => $label) {
            $this->assertTrue($container->has($key), sprintf('The dependency provider must provide %s under %s.', $label, $key));
        }

        $this->assertInstanceOf(SupplierSearchQueryPlugin::class, $container->get(SupplierSearchDependencyProvider::PLUGIN_SUPPLIER_SEARCH_QUERY));
        $formatters = $container->get(SupplierSearchDependencyProvider::PLUGINS_SUPPLIER_SEARCH_RESULT_FORMATTER);
        $this->assertNotEmpty($formatters, 'The result formatter plugins must contain the SupplierSearchResultFormatterPlugin.');
        $this->assertInstanceOf(SupplierSearchResultFormatterPlugin::class, $formatters[0]);
    }

    // --- Elasticsearch schema ---

    public function testElasticsearchSchemaExists(): void
    {
        $schemaFile = dirname((new ReflectionClass(SupplierSearchConfig::class))->getFileName()) . '/Schema/supplier.json';

        $this->assertFileExists($schemaFile, 'Shared/SupplierSearch/Schema/supplier.json must exist.');
        $json = json_decode((string)file_get_contents($schemaFile), true);
        $this->assertIsArray($json, 'supplier.json must be valid JSON.');
        $this->assertArrayHasKey('settings', $json, 'The schema must define settings.');
        $this->assertArrayHasKey('mappings', $json, 'The schema must define mappings.');
    }
}
