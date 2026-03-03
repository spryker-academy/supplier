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
        // TODO-1: Create the search query through the factory
        // Hint: $this->getFactory()->createSupplierQueryPlugin($name)

        // TODO-2: Get the result formatters through the factory
        // Hint: $this->getFactory()->getSearchQueryFormatters()

        // TODO-3: Use the SearchClient to perform the search
        // Hint: $this->getFactory()->getSearchClient()->search($searchQuery, $resultFormatters)

        // TODO-4: Return the supplier from the search results
        // Hint: $searchResults[SupplierSearchResultFormatterPlugin::NAME]

        return null;
    }
}
