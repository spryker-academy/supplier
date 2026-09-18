<?php

namespace SprykerAcademy\Client\SupplierSearch;

use SprykerAcademy\Client\SupplierSearch\Plugin\Elasticsearch\Query\SupplierSearchQueryPlugin;
use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\Search\SearchClientInterface;

class SupplierSearchFactory extends AbstractFactory
{
    public function createSupplierQueryPlugin(string $name): SupplierSearchQueryPlugin
    {
        // TODO-1: Create and return the query plugin with the given name

        throw new \RuntimeException('TODO-1: return the query plugin'); // replace this line
    }

    public function getSearchQueryFormatters(): array
    {
        // TODO-2: Retrieve the result formatter plugins from the container

        return []; // TODO-2: replace with the plugins from the container
    }

    public function getSearchClient(): SearchClientInterface
    {
        // TODO-3: Retrieve the SearchClient from the container
    }
}
