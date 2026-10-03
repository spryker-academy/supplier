<?php

declare(strict_types=1);

namespace SprykerAcademy\Client\SupplierSearch\Plugin\Elasticsearch\QueryExpander;

use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;
use SprykerAcademy\Shared\SupplierSearch\SupplierSearchConfig;

/**
 * Cuts one page out of the supplier search: the `offset` and `limit` request parameters become
 * Elasticsearch's `from` and `size`. Without them the query keeps Elasticsearch's default of 10 hits.
 */
class SupplierPaginationQueryExpanderPlugin extends AbstractPlugin implements QueryExpanderPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface $searchQuery
     * @param array<string, mixed> $requestParameters
     *
     * @return \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     */
    public function expandQuery(QueryInterface $searchQuery, array $requestParameters = [])
    {
        /** @var \Elastica\Query $query */
        $query = $searchQuery->getSearchQuery();

        // A stable order, or the pages overlap
        $query->setSort([SupplierSearchConfig::KEY_ID_SUPPLIER => 'asc']);

        if (!isset($requestParameters[SupplierSearchConfig::PARAMETER_LIMIT])) {
            return $searchQuery;
        }

        $query->setFrom((int)($requestParameters[SupplierSearchConfig::PARAMETER_OFFSET] ?? 0));
        $query->setSize((int)$requestParameters[SupplierSearchConfig::PARAMETER_LIMIT]);

        return $searchQuery;
    }
}
