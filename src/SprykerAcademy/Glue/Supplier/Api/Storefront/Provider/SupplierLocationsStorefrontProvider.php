<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Glue\Supplier\Api\Storefront\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use SprykerAcademy\Client\SupplierSearch\SupplierSearchClientInterface;
use SprykerAcademy\Glue\Supplier\Processor\Mapper\SupplierMapper;

/**
 * Serves the published locations of one supplier:
 * - GET /suppliers/{idSupplier}/supplier-locations
 * - GET /suppliers/{idSupplier}/supplier-locations/{idSupplierLocation}
 * - GET /suppliers?include=supplier-locations: for every supplier of the response the relationship
 *   resolver calls this provider with the supplier's id in $uriVariables, as the `uriVariableMappings`
 *   of suppliers.resource.yml tell it to.
 *
 * Publish & Synchronize writes the locations into the supplier's search document, so the provider
 * reads the supplier and takes the locations from it. The Storefront API does not query the database.
 */
class SupplierLocationsStorefrontProvider implements ProviderInterface
{
    public function __construct(protected SupplierSearchClientInterface $supplierSearchClient)
    {
    }

    /**
     * @param \ApiPlatform\Metadata\Operation $operation
     * @param array<string, mixed> $uriVariables
     * @param array<string, mixed> $context
     *
     * @return array<\Generated\Api\Storefront\SupplierLocationsStorefrontResource>|\Generated\Api\Storefront\SupplierLocationsStorefrontResource|null
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        // TODO-1: Without `idSupplier` in $uriVariables there is no document to read: return an empty array.
        // TODO-2: Load the supplier: $this->supplierSearchClient->findSupplierById((int)$uriVariables['idSupplier']).
        //         Its locations are in $supplierTransfer->getSupplierLocations().
        // TODO-3: Map every SupplierLocationTransfer to a resource with
        //         SupplierMapper::mapSupplierLocationTransferToSupplierLocationsStorefrontResource().
        // TODO-4: GET /suppliers/{idSupplier}/supplier-locations/{idSupplierLocation}: when $uriVariables has
        //         `idSupplierLocation`, return the resource with that id, or null when the supplier
        //         does not have it (404).
        // TODO-5: Otherwise return the array of resources.

        return [];
    }
}
