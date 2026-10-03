<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Glue\Supplier\Api\Storefront\Provider;

use Spryker\ApiPlatform\State\Provider\AbstractStorefrontProvider;
use SprykerAcademy\Client\SupplierSearch\SupplierSearchClientInterface;

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
        // TODO-1: Read the supplier id from $this->getUriVariables(). The key is the property marked
        //         `identifier: true` in suppliers.resource.yml.
        // TODO-2: Load the supplier with $this->supplierSearchClient->findSupplierById((int)$idSupplier).
        // TODO-3: The client returns an empty SupplierTransfer when the id is unknown - return null then,
        //         API Platform answers with a 404.
        // TODO-4: Map the SupplierTransfer to a SuppliersStorefrontResource with the provided SupplierMapper.

        return null;
    }

    /**
     * GET /suppliers?page[offset]=2&page[limit]=2
     *
     * @return array<\Generated\Api\Storefront\SuppliersStorefrontResource>
     */
    protected function provideCollection(): array
    {
        // TODO-5: Read the requested page: $this->getPaginationLimit() and $this->getPaginationOffset().
        // TODO-6: Load that page: $this->supplierSearchClient->searchSuppliers([...]) with the request
        //         parameters SupplierSearchConfig::PARAMETER_OFFSET and SupplierSearchConfig::PARAMETER_LIMIT.
        // TODO-7: Map every SupplierTransfer of getSuppliers() to a resource with the SupplierMapper.
        // TODO-8: Set the pagination on the FIRST resource (if there is one): Glue builds the
        //         first/prev/next/last links from it.
        // Hint-1: $resources[0]->pagination = SuppliersPaginationStorefrontObject::fromArray(...)
        //         (Generated\Api\Storefront\Suppliers\SuppliersPaginationStorefrontObject)
        // Hint-2: $this->calculatePagination($offset, $limit, $numberOfAllSuppliers) builds the array.
        // Hint-3: The number of all suppliers is $supplierCollectionTransfer->getPagination()->getNbResults().

        return [];
    }
}
