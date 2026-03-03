<?php

declare(strict_types=1);

namespace SprykerAcademy\Client\SupplierSearch\Plugin\Elasticsearch\Query;

use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\MatchQuery;
use Generated\Shared\Transfer\SearchContextTransfer;
use Spryker\Client\Kernel\AbstractPlugin;
use SprykerAcademy\Shared\SupplierSearch\SupplierSearchConfig;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\SearchContextAwareQueryInterface;

class SupplierSearchQueryPlugin extends AbstractPlugin implements QueryInterface, SearchContextAwareQueryInterface
{
    // TODO-1: Define the SOURCE_IDENTIFIER constant.
    // Hint-1: Use SupplierSearchConfig::SUPPLIER_SOURCE_IDENTIFIER
    // Hint-2: This tells the Search Client which Elasticsearch index to query
    protected const string SOURCE_IDENTIFIER = '';

    // TODO-2: Define the RESOURCE_TYPE constant.
    // Hint-1: Use SupplierSearchConfig::SUPPLIER_RESOURCE_TYPE
    // Hint-2: This is used to filter documents by type field
    protected const string RESOURCE_TYPE = '';

    protected Query $query {
        get => $field ??= $this->createSearchQuery();
    }

    protected ?SearchContextTransfer $searchContextTransfer = null {
        get => $field ??= new SearchContextTransfer()
            ->setSourceIdentifier(static::SOURCE_IDENTIFIER);
    }

    /**
     * @return \Elastica\Query
     */
    protected function createSearchQuery(): Query
    {
        $query = new Query();
        $boolQuery = new BoolQuery();

        // TODO-3: Add a filter to match documents by type.
        // Hint-1: Use $boolQuery->addMust() with a MatchQuery
        // Hint-2: Match SupplierSearchConfig::KEY_TYPE field against static::RESOURCE_TYPE
        // Hint-3: Example: new MatchQuery(SupplierSearchConfig::KEY_TYPE, static::RESOURCE_TYPE)

        $query->setQuery($boolQuery);

        return $query;
    }

    /**
     * @return \Elastica\Query
     */
    public function getSearchQuery(): Query
    {
        return $this->query;
    }

    /**
     * @return \Generated\Shared\Transfer\SearchContextTransfer
     */
    public function getSearchContext(): SearchContextTransfer
    {
        return $this->searchContextTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\SearchContextTransfer $searchContextTransfer
     *
     * @return void
     */
    public function setSearchContext(SearchContextTransfer $searchContextTransfer): void
    {
        $this->searchContextTransfer = $searchContextTransfer;
    }
}
