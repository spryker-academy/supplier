<?php

namespace SprykerAcademy\Client\SupplierSearch\Plugin\Elasticsearch\ResultFormatter;

use Elastica\ResultSet;
use Generated\Shared\Transfer\SupplierTransfer;
use Spryker\Client\SearchElasticsearch\Plugin\ResultFormatter\AbstractElasticsearchResultFormatterPlugin;

class SupplierSearchResultFormatterPlugin extends AbstractElasticsearchResultFormatterPlugin
{
    public const NAME = 'supplier';

    public function getName(): string
    {
        return static::NAME;
    }

    protected function formatSearchResult(ResultSet $searchResult, array $requestParameters): ?SupplierTransfer
    {
        // TODO: Return the first result as a SupplierTransfer
        // Hint: Iterate $searchResult->getResults(), get the source with $document->getSource(),
        //       and use (new SupplierTransfer())->fromArray($source) to create the transfer
        // Hint: Return null if no results

        return null;
    }
}
