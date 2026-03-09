<?php

declare(strict_types=1);

namespace SprykerAcademy\Client\SupplierSearch\Reader;

use Generated\Shared\Transfer\SupplierCollectionTransfer;
use Generated\Shared\Transfer\SupplierTransfer;
use Spryker\Client\Search\SearchClientInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;
use Symfony\Component\DependencyInjection\Attribute\Exclude;
use SprykerAcademy\Client\SupplierSearch\Plugin\Elasticsearch\Query\SupplierByIdSearchQueryPlugin;

#[Exclude]
class SupplierSearchReader implements SupplierSearchReaderInterface
{
    /**
     * Spryker Factory Pattern: Instantiated by SupplierSearchFactory with dependencies.
     * Default values prevent Symfony autowiring errors (Reader shouldn't be a service).
     *
     * @param \Spryker\Client\Search\SearchClientInterface|null $searchClient
     * @param \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface|null $supplierSearchQueryPlugin
     * @param array<\Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface> $queryExpanderPlugins
     * @param array<\Spryker\Client\SearchExtension\Dependency\Plugin\ResultFormatterPluginInterface> $resultFormatterPlugins
     */
    public function __construct(
        protected ?SearchClientInterface $searchClient = null,
        protected ?QueryInterface $supplierSearchQueryPlugin = null,
        protected array $queryExpanderPlugins = [],
        protected array $resultFormatterPlugins = [],
    ) {
    }

    public function searchSuppliers(array $requestParameters = []): SupplierCollectionTransfer
    {
        $searchQuery = $this->searchClient->expandQuery(
            $this->supplierSearchQueryPlugin,
            $this->queryExpanderPlugins,
            $requestParameters,
        );

        $result = $this->searchClient->search(
            $searchQuery,
            $this->resultFormatterPlugins,
            $requestParameters,
        );

        if ($result instanceof SupplierCollectionTransfer) {
            return $result;
        }

        // When result formatters return keyed array
        return $result['SupplierSearchCollection'] ?? new SupplierCollectionTransfer();
    }

    public function findSupplierById(int $idSupplier): SupplierTransfer
    {
        $queryPlugin = (new SupplierByIdSearchQueryPlugin())->setIdSupplier($idSupplier);

        $result = $this->searchClient->search(
            $queryPlugin,
            $this->resultFormatterPlugins,
        );

        if ($result instanceof SupplierCollectionTransfer) {
            $suppliers = $result->getSuppliers();

            return $suppliers->count() > 0 ? $suppliers->offsetGet(0) : new SupplierTransfer();
        }

        $collection = $result['SupplierSearchCollection'] ?? new SupplierCollectionTransfer();
        $suppliers = $collection->getSuppliers();

        return $suppliers->count() > 0 ? $suppliers->offsetGet(0) : new SupplierTransfer();
    }
}
