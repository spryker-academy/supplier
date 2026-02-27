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
    /**
     * @return \SprykerAcademy\Client\SupplierSearch\Reader\SupplierSearchReaderInterface
     */
    public function createSupplierSearchReader(): SupplierSearchReaderInterface
    {
        // TODO-1: Create and return a new SupplierSearchReader.
        // Hint-1: Pass four parameters to the constructor:
        //         - $this->getSearchClient()
        //         - $this->getSupplierSearchQueryPlugin()
        //         - $this->getSupplierSearchQueryExpanderPlugins()
        //         - $this->getSupplierSearchResultFormatterPlugins()

        return new SupplierSearchReader(
            $this->getSearchClient(),
            $this->getSupplierSearchQueryPlugin(),
            [],
            []
        );
    }

    /**
     * @return \Spryker\Client\Search\SearchClientInterface
     */
    public function getSearchClient(): SearchClientInterface
    {
        // TODO-2: Get the Search client from provided dependencies.
        // Hint-1: Use $this->getProvidedDependency(SupplierSearchDependencyProvider::CLIENT_SEARCH)

        return $this->getProvidedDependency(SupplierSearchDependencyProvider::CLIENT_SEARCH);
    }

    /**
     * @return \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     */
    public function getSupplierSearchQueryPlugin(): QueryInterface
    {
        // TODO-3: Get the query plugin from provided dependencies.
        // Hint-1: Use $this->getProvidedDependency(SupplierSearchDependencyProvider::PLUGIN_SUPPLIER_SEARCH_QUERY)

        return $this->getProvidedDependency(SupplierSearchDependencyProvider::PLUGIN_SUPPLIER_SEARCH_QUERY);
    }

    /**
     * @return array<\Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface>
     */
    public function getSupplierSearchQueryExpanderPlugins(): array
    {
        // TODO-4: Get the query expander plugins from provided dependencies.
        // Hint-1: Use $this->getProvidedDependency(SupplierSearchDependencyProvider::PLUGINS_SUPPLIER_SEARCH_QUERY_EXPANDER)

        return $this->getProvidedDependency(SupplierSearchDependencyProvider::PLUGINS_SUPPLIER_SEARCH_QUERY_EXPANDER);
    }

    /**
     * @return array<\Spryker\Client\SearchExtension\Dependency\Plugin\ResultFormatterPluginInterface>
     */
    public function getSupplierSearchResultFormatterPlugins(): array
    {
        // TODO-5: Get the result formatter plugins from provided dependencies.
        // Hint-1: Use $this->getProvidedDependency(SupplierSearchDependencyProvider::PLUGINS_SUPPLIER_SEARCH_RESULT_FORMATTER)

        return $this->getProvidedDependency(SupplierSearchDependencyProvider::PLUGINS_SUPPLIER_SEARCH_RESULT_FORMATTER);
    }
}
