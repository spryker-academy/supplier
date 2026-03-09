<?php

declare(strict_types=1);

namespace SprykerAcademy\Client\SupplierSearch\Plugin\Elasticsearch\Query;

use Elastica\Query;
use Elastica\Query\Term;
use Generated\Shared\Transfer\SearchContextTransfer;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\SearchContextAwareQueryInterface;
use SprykerAcademy\Shared\SupplierSearch\SupplierSearchConfig;

class SupplierByIdSearchQueryPlugin implements QueryInterface, SearchContextAwareQueryInterface
{
    protected SearchContextTransfer $searchContextTransfer;

    protected Query $query;

    protected int $idSupplier;

    /**
     * @param int $idSupplier
     *
     * @return static
     */
    public function setIdSupplier(int $idSupplier): static
    {
        $this->idSupplier = $idSupplier;
        unset($this->query);

        return $this;
    }

    protected function createSearchQuery(): Query
    {
        $query = new Query();
        $query->setQuery(new Term([SupplierSearchConfig::KEY_ID_SUPPLIER => $this->idSupplier]));
        $query->setSize(1);

        return $query;
    }

    public function getSearchQuery(): Query
    {
        if (!isset($this->query)) {
            $this->query = $this->createSearchQuery();
        }

        return $this->query;
    }

    public function getSearchContext(): SearchContextTransfer
    {
        if (!isset($this->searchContextTransfer)) {
            $this->searchContextTransfer = (new SearchContextTransfer())
                ->setSourceIdentifier(SupplierSearchConfig::SUPPLIER_SOURCE_IDENTIFIER);
        }

        return $this->searchContextTransfer;
    }

    public function setSearchContext(SearchContextTransfer $searchContextTransfer): void
    {
        $this->searchContextTransfer = $searchContextTransfer;
    }
}
