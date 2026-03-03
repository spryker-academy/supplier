<?php

namespace SprykerAcademy\Client\SupplierSearch\Plugin\Elasticsearch\Query;

use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\Exists;
use Elastica\Query\MatchQuery;
use Generated\Shared\Transfer\SearchContextTransfer;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\SearchContextAwareQueryInterface;

class SupplierSearchQueryPlugin implements QueryInterface, SearchContextAwareQueryInterface
{
    protected string $name;

    // TODO-1: Set the SOURCE_IDENTIFIER constant value
    // Hint: Must match the "type" param from the synchronization behavior in pyz_supplier_search.schema.xml
    protected const SOURCE_IDENTIFIER = '';

    protected SearchContextTransfer $searchContextTransfer;

    public function __construct(string $name)
    {
        $this->setupDefaultSearchContext();
        $this->name = $name;
    }

    public function getSearchQuery(): Query
    {
        $boolQuery = new BoolQuery();

        // TODO-2: Build the search query
        // Hint: Use $boolQuery->addMust() twice:
        //   1. An Exists filter on 'id_supplier' field (ensures we only get supplier documents)
        //   2. A MatchQuery on 'name' field with $this->name (the search term)

        return (new Query())->setQuery($boolQuery);
    }

    public function getSearchContext(): SearchContextTransfer
    {
        if (!$this->hasSearchContext()) {
            $this->setupDefaultSearchContext();
        }

        return $this->searchContextTransfer;
    }

    public function setSearchContext(SearchContextTransfer $searchContextTransfer): void
    {
        $this->searchContextTransfer = $searchContextTransfer;
    }

    protected function setupDefaultSearchContext(): void
    {
        $searchContextTransfer = new SearchContextTransfer();
        $searchContextTransfer->setSourceIdentifier(static::SOURCE_IDENTIFIER);
        $this->searchContextTransfer = $searchContextTransfer;
    }

    protected function hasSearchContext(): bool
    {
        return (bool)$this->searchContextTransfer;
    }
}
