<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Glue\Supplier\Api\Storefront\Provider;

use Generated\Api\Storefront\Suppliers\SuppliersPaginationStorefrontObject;
use Spryker\ApiPlatform\State\Provider\AbstractStorefrontProvider;
use SprykerAcademy\Client\SupplierSearch\SupplierSearchClientInterface;
use SprykerAcademy\Glue\Supplier\Processor\Mapper\SupplierMapper;
use SprykerAcademy\Shared\SupplierSearch\SupplierSearchConfig;

/**
 * Serves GET /suppliers and GET /suppliers/{idSupplier} from Elasticsearch, through the
 * SupplierSearch client of exercise 11. API Platform builds the provider with Symfony's
 * dependency injection, so the client arrives through the constructor.
 *
 * AbstractStorefrontProvider implements provide(): it calls provideCollection() for a
 * GetCollection operation and provideItem() for a Get, and has the pagination helpers.
 */
class SuppliersStorefrontProvider extends AbstractStorefrontProvider
{
    public function __construct(protected SupplierSearchClientInterface $supplierSearchClient)
    {
    }

    /**
     * GET /suppliers/{idSupplier}
     */
    protected function provideItem(): ?object
    {
        $idSupplier = $this->getUriVariables()['idSupplier'] ?? null;

        if ($idSupplier === null) {
            return null;
        }

        $supplierTransfer = $this->supplierSearchClient->findSupplierById((int)$idSupplier);

        // Not found: API Platform answers with 404
        if ($supplierTransfer->getIdSupplier() === null) {
            return null;
        }

        return (new SupplierMapper())->mapSupplierTransferToSuppliersStorefrontResource($supplierTransfer);
    }

    /**
     * GET /suppliers?page[offset]=2&page[limit]=2
     *
     * @return array<\Generated\Api\Storefront\SuppliersStorefrontResource>
     */
    protected function provideCollection(): array
    {
        // page[limit] falls back to the resource's paginationItemsPerPage, page[offset] to 0
        $limit = $this->getPaginationLimit();
        $offset = $this->getPaginationOffset();

        // Elasticsearch cuts the page out: only the suppliers of this page travel
        $supplierCollectionTransfer = $this->supplierSearchClient->searchSuppliers([
            SupplierSearchConfig::PARAMETER_OFFSET => $offset,
            SupplierSearchConfig::PARAMETER_LIMIT => $limit,
        ]);

        $supplierMapper = new SupplierMapper();
        $resources = [];

        foreach ($supplierCollectionTransfer->getSuppliers() as $supplierTransfer) {
            $resources[] = $supplierMapper->mapSupplierTransferToSuppliersStorefrontResource($supplierTransfer);
        }

        // The first item carries the pagination of the whole collection. Glue reads it there and
        // adds the first/prev/next/last links to the JSON:API response.
        if ($resources !== []) {
            $resources[0]->pagination = SuppliersPaginationStorefrontObject::fromArray($this->calculatePagination(
                $offset,
                $limit,
                $supplierCollectionTransfer->getPagination()?->getNbResults() ?? count($resources),
            ));
        }

        return $resources;
    }
}
