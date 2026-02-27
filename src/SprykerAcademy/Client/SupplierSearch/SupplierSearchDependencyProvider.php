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
    public const CLIENT_SEARCH = 'CLIENT_SEARCH';
    public const PLUGIN_SUPPLIER_SEARCH_QUERY = 'PLUGIN_SUPPLIER_SEARCH_QUERY';
    public const PLUGINS_SUPPLIER_SEARCH_RESULT_FORMATTER = 'PLUGINS_SUPPLIER_SEARCH_RESULT_FORMATTER';
    public const PLUGINS_SUPPLIER_SEARCH_QUERY_EXPANDER = 'PLUGINS_SUPPLIER_SEARCH_QUERY_EXPANDER';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = parent::provideServiceLayerDependencies($container);

        // TODO-1: Provide the Search client.
        // Hint-1: Use $container->set() with CLIENT_SEARCH as key
        // Hint-2: Return a closure: fn(Container $c) => $c->getLocator()->search()->client()

        // TODO-2: Provide the SupplierSearchQueryPlugin.
        // Hint-1: Use $container->set() with PLUGIN_SUPPLIER_SEARCH_QUERY as key
        // Hint-2: Return a closure that creates a new SupplierSearchQueryPlugin: fn(): QueryInterface => new SupplierSearchQueryPlugin()

        // TODO-3: Provide the result formatter plugins array.
        // Hint-1: Use $container->set() with PLUGINS_SUPPLIER_SEARCH_RESULT_FORMATTER as key
        // Hint-2: Return a closure with an array containing new SupplierSearchResultFormatterPlugin()

        // TODO-4: Provide the query expander plugins array (empty for now).
        // Hint-1: Use $container->set() with PLUGINS_SUPPLIER_SEARCH_QUERY_EXPANDER as key
        // Hint-2: Return a closure with an empty array: fn(): array => []

        return $container;
    }
}
