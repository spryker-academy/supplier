<?php

declare(strict_types=1);

namespace SprykerAcademy\Client\SupplierSearch\Plugin\Elasticsearch\ResultFormatter;

use Elastica\ResultSet;
use Generated\Shared\Transfer\SupplierCollectionTransfer;
use Generated\Shared\Transfer\SupplierTransfer;
use Spryker\Client\SearchElasticsearch\Plugin\ResultFormatter\AbstractElasticsearchResultFormatterPlugin;
use SprykerAcademy\Shared\SupplierSearch\SupplierSearchConfig;

class SupplierSearchResultFormatterPlugin extends AbstractElasticsearchResultFormatterPlugin
{
    protected const string NAME = 'SupplierSearchCollection';

    /**
     * @return string
     */
    public function getName(): string
    {
        return static::NAME;
    }

    /**
     * @param \Elastica\ResultSet $searchResult
     * @param array<string, mixed> $requestParameters
     *
     * @return \Generated\Shared\Transfer\SupplierCollectionTransfer
     */
    protected function formatSearchResult(ResultSet $searchResult, array $requestParameters): SupplierCollectionTransfer
    {
        $supplierCollectionTransfer = new SupplierCollectionTransfer();

        foreach ($searchResult->getResults() as $document) {
            $source = $document->getSource();

            // TODO-1: Extract the search result data from the document source.
            // Hint-1: Use SupplierSearchConfig::KEY_SEARCH_RESULT_DATA as the array key
            // Hint-2: Provide an empty array as fallback if key doesn't exist
            // Hint-3: $data = $source[SupplierSearchConfig::KEY_SEARCH_RESULT_DATA] ?? [];
            $data = [];

            // TODO-2: Convert the data array to a SupplierTransfer.
            // Hint-1: Use (new SupplierTransfer())->fromArray($data, true)
            // Hint-2: The second parameter 'true' means ignore missing keys
            $supplierTransfer = new SupplierTransfer();

            $supplierCollectionTransfer->addSupplier($supplierTransfer);
        }

        return $supplierCollectionTransfer;
    }
}
