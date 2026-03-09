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
    /**
     * @var string
     */
    protected const string NAME = 'SupplierSearchCollection';

    public function getName(): string
    {
        return static::NAME;
    }

    protected function formatSearchResult(ResultSet $searchResult, array $requestParameters): SupplierCollectionTransfer
    {
        $supplierCollectionTransfer = new SupplierCollectionTransfer();

        foreach ($searchResult->getResults() as $document) {
            $source = $document->getSource();
            $data = $source[SupplierSearchConfig::KEY_SEARCH_RESULT_DATA] ?? [];

            $supplierTransfer = (new SupplierTransfer())->fromArray($data, true);

            if ($supplierTransfer->getIdSupplier() === null && isset($source[SupplierSearchConfig::KEY_ID_SUPPLIER])) {
                $supplierTransfer->setIdSupplier($source[SupplierSearchConfig::KEY_ID_SUPPLIER]);
            }

            $supplierCollectionTransfer->addSupplier($supplierTransfer);
        }

        return $supplierCollectionTransfer;
    }
}
