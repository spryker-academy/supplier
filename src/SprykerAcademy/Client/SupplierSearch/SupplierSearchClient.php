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
     *
     * @param string $name
     *
     * @return \Generated\Shared\Transfer\SupplierTransfer|null
     */
    public function getSupplierByName(string $name): ?SupplierTransfer
    {
        $searchQuery = $this->getFactory()
            ->createSupplierQueryPlugin($name);

        $resultFormatters = $this->getFactory()
            ->getSearchQueryFormatters();

        $searchResults = $this->getFactory()
            ->getSearchClient()
            ->search(
                $searchQuery,
                $resultFormatters,
            );

        return $searchResults[SupplierSearchResultFormatterPlugin::NAME];
    }
}
