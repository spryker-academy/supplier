<?php

declare(strict_types=1);

namespace SprykerAcademy\Client\SupplierSearch\Reader;

use Generated\Shared\Transfer\SupplierCollectionTransfer;
use Spryker\Client\Search\SearchClientInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;

class SupplierSearchReader implements SupplierSearchReaderInterface
{
    /**
     * @param \Spryker\Client\Search\SearchClientInterface $searchClient
     * @param \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface $supplierSearchQueryPlugin
     * @param array<\Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface> $queryExpanderPlugins
     * @param array<\Spryker\Client\SearchExtension\Dependency\Plugin\ResultFormatterPluginInterface> $resultFormatterPlugins
     */
    public function __construct(
        protected SearchClientInterface $searchClient,
        protected QueryInterface $supplierSearchQueryPlugin,
        protected array $queryExpanderPlugins,
        protected array $resultFormatterPlugins,
    ) {
    }

    /**
     * @param array<string, mixed> $requestParameters
     *
     * @return \Generated\Shared\Transfer\SupplierCollectionTransfer
     */
    public function searchSuppliers(array $requestParameters = []): SupplierCollectionTransfer
    {
        // TODO-1: Expand the search query with query expander plugins.
        // Hint-1: Use $this->searchClient->expandQuery() with three parameters:
        //         - $this->supplierSearchQueryPlugin
        //         - $this->queryExpanderPlugins
        //         - $requestParameters
        $searchQuery = $this->supplierSearchQueryPlugin;

        // TODO-2: Execute the search and format the results.
        // Hint-1: Use $this->searchClient->search() with three parameters:
        //         - $searchQuery (from TODO-1)
        //         - $this->resultFormatterPlugins
        //         - $requestParameters
        $result = [];

        // TODO-3: Return the formatted result.
        // Hint-1: If $result is already a SupplierCollectionTransfer, return it
        // Hint-2: If $result is an array, extract using the formatter name: $result['SupplierSearchCollection'] ?? new SupplierCollectionTransfer()
        if ($result instanceof SupplierCollectionTransfer) {
            return $result;
        }

        return new SupplierCollectionTransfer();
    }
}
