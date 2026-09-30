<?php

declare(strict_types=1);

namespace SprykerAcademy\Client\SupplierSearch;

use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\Search\SearchClientInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;
use SprykerAcademy\Client\SupplierSearch\Reader\SupplierSearchReader;
use SprykerAcademy\Client\SupplierSearch\Reader\SupplierSearchReaderInterface;

class SupplierSearchFactory extends AbstractFactory
{
    public function createSupplierSearchReader(): SupplierSearchReaderInterface
    {
        // TODO-1: Pass the query expander plugins and the result formatter plugins instead of the two empty arrays.
        // Hint: $this->getSupplierSearchQueryExpanderPlugins() and $this->getSupplierSearchResultFormatterPlugins()
        return new SupplierSearchReader(
            $this->getSearchClient(),
            $this->getSupplierSearchQueryPlugin(),
            [],
            [],
        );
    }

    public function getSearchClient(): SearchClientInterface
    {
        // TODO-2: Return the Search client from the provided dependencies.
        // Hint: $this->getProvidedDependency(SupplierSearchDependencyProvider::CLIENT_SEARCH)
    }

    public function getSupplierSearchQueryPlugin(): QueryInterface
    {
        // TODO-3: Return the query plugin from the provided dependencies.
        // Hint: $this->getProvidedDependency(SupplierSearchDependencyProvider::PLUGIN_SUPPLIER_SEARCH_QUERY)
    }

    /**
     * @return array<\Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface>
     */
    public function getSupplierSearchQueryExpanderPlugins(): array
    {
        // TODO-4: Return the query expander plugins from the provided dependencies.
        // Hint: $this->getProvidedDependency(SupplierSearchDependencyProvider::PLUGINS_SUPPLIER_SEARCH_QUERY_EXPANDER)
    }

    /**
     * @return array<\Spryker\Client\SearchExtension\Dependency\Plugin\ResultFormatterPluginInterface>
     */
    public function getSupplierSearchResultFormatterPlugins(): array
    {
        // TODO-5: Return the result formatter plugins from the provided dependencies.
        // Hint: $this->getProvidedDependency(SupplierSearchDependencyProvider::PLUGINS_SUPPLIER_SEARCH_RESULT_FORMATTER)
    }
}
