<?php

declare(strict_types=1);

namespace SprykerAcademy\Client\SupplierSearch;

use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;
use SprykerAcademy\Client\SupplierSearch\Plugin\Elasticsearch\Query\SupplierSearchQueryPlugin;
use SprykerAcademy\Client\SupplierSearch\Plugin\Elasticsearch\ResultFormatter\SupplierSearchResultFormatterPlugin;

class SupplierSearchDependencyProvider extends AbstractDependencyProvider
{
    public const string CLIENT_SEARCH = 'CLIENT_SEARCH';
    public const string PLUGIN_SUPPLIER_SEARCH_QUERY = 'PLUGIN_SUPPLIER_SEARCH_QUERY';
    public const string PLUGINS_SUPPLIER_SEARCH_RESULT_FORMATTER = 'PLUGINS_SUPPLIER_SEARCH_RESULT_FORMATTER';
    public const string PLUGINS_SUPPLIER_SEARCH_QUERY_EXPANDER = 'PLUGINS_SUPPLIER_SEARCH_QUERY_EXPANDER';

    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = parent::provideServiceLayerDependencies($container);

        // Every dependency is registered with $container->set(KEY, closure).
        // TODO-1: CLIENT_SEARCH - the core Search client.
        // Hint: $container->set(static::CLIENT_SEARCH, fn (Container $container) => $container->getLocator()->search()->client());
        // TODO-2: PLUGIN_SUPPLIER_SEARCH_QUERY - a new SupplierSearchQueryPlugin.
        // TODO-3: PLUGINS_SUPPLIER_SEARCH_RESULT_FORMATTER - an array with a new SupplierSearchResultFormatterPlugin.
        // TODO-4: PLUGINS_SUPPLIER_SEARCH_QUERY_EXPANDER - an empty array (no query expanders in this exercise).

        return $container;
    }
}
