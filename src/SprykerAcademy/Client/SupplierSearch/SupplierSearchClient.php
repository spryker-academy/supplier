<?php

namespace SprykerAcademy\Client\SupplierSearch;

use Generated\Shared\Transfer\SupplierTransfer;
use SprykerAcademy\Client\SupplierSearch\Plugin\Elasticsearch\ResultFormatter\SupplierSearchResultFormatterPlugin;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \SprykerAcademy\Client\SupplierSearch\SupplierSearchFactory getFactory()
 */
class SupplierSearchClient extends AbstractClient implements SupplierSearchClientInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     */
    public function getSupplierByName(string $name): ?SupplierTransfer
    {
        // TODO-1: Create the search query plugin through the factory

        // TODO-2: Get the result formatter plugins from the factory

        // TODO-3: Use the SearchClient to perform the search with the query and formatters

        // TODO-4: Extract and return the supplier from the formatted search results

        return null;
    }
}
