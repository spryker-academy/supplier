<?php

namespace SprykerAcademy\Client\SupplierSearch;

use SprykerAcademy\Client\SupplierSearch\Plugin\Elasticsearch\ResultFormatter\SupplierSearchResultFormatterPlugin;
use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;
use Spryker\Client\Search\SearchClientInterface;

class SupplierSearchDependencyProvider extends AbstractDependencyProvider
{
    public const CLIENT_SEARCH = 'CLIENT_SEARCH';

    public const SUPPLIER_SEARCH_RESULT_FORMATTER_PLUGINS = 'SUPPLIER_SEARCH_RESULT_FORMATTER_PLUGINS';

    public function provideServiceLayerDependencies(Container $container): Container
    {
        // TODO-1: Call addSearchClient() and addSupplierSearchResultFormatterPlugins()

        return $container;
    }

    protected function addSearchClient(Container $container): Container
    {
        // TODO-2: Provide the SearchClient via the locator
        // Hint: $container->getLocator()->search()->client()

        return $container;
    }

    public function addSupplierSearchResultFormatterPlugins(Container $container): Container
    {
        $container[static::SUPPLIER_SEARCH_RESULT_FORMATTER_PLUGINS] = function () {
            return $this->getSupplierSearchResultFormatterPlugins();
        };

        return $container;
    }

    /**
     * @return array<\Spryker\Client\SearchExtension\Dependency\Plugin\ResultFormatterPluginInterface>
     */
    public function getSupplierSearchResultFormatterPlugins(): array
    {
        // TODO-3: Return an array containing an instance of SupplierSearchResultFormatterPlugin

        return [];
    }
}
