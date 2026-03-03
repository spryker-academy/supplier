<?php

namespace SprykerAcademy\Client\SupplierSearch;

use SprykerAcademy\Client\SupplierSearch\Plugin\Elasticsearch\Query\SupplierSearchQueryPlugin;
use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\Search\SearchClientInterface;

class SupplierSearchFactory extends AbstractFactory
{
    public function createSupplierQueryPlugin(string $name): SupplierSearchQueryPlugin
    {
        // TODO-1: Instantiate and return a SupplierSearchQueryPlugin with the name parameter

        return new SupplierSearchQueryPlugin($name);
    }

    public function getSearchQueryFormatters(): array
    {
        // TODO-2: Return the result formatter plugins from the DependencyProvider
        // Hint: Use getProvidedDependency() with the SUPPLIER_SEARCH_RESULT_FORMATTER_PLUGINS constant

        return [];
    }

    public function getSearchClient(): SearchClientInterface
    {
        // TODO-3: Return the SearchClient from the DependencyProvider
        // Hint: Use getProvidedDependency() with the CLIENT_SEARCH constant
    }
}
