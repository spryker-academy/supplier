<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Glue\Supplier\Api\Backend\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use Generated\Shared\Transfer\SupplierLocationCriteriaTransfer;
use SprykerAcademy\Glue\Supplier\Processor\Mapper\SupplierBackendMapper;
use SprykerAcademy\Zed\Supplier\Business\SupplierFacadeInterface;

/**
 * Serves the locations of one supplier:
 * - GET /suppliers/{idSupplier}/supplier-locations
 * - GET /supplier-locations/{idSupplierLocation}
 * - GET /suppliers?include=supplier-locations: for every supplier of the response the relationship
 *   resolver calls this provider with the supplier's id in $uriVariables, as the `uriVariableMappings`
 *   of suppliers.resource.yml tell it to.
 */
class SupplierLocationsBackendProvider implements ProviderInterface
{
    public function __construct(protected SupplierFacadeInterface $supplierFacade)
    {
    }

    /**
     * @param \ApiPlatform\Metadata\Operation $operation
     * @param array<string, mixed> $uriVariables
     * @param array<string, mixed> $context
     *
     * @return array<\Generated\Api\Backend\SupplierLocationsBackendResource>|\Generated\Api\Backend\SupplierLocationsBackendResource|null
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        // TODO-1: GET /supplier-locations/{idSupplierLocation}: when $uriVariables has `idSupplierLocation`,
        //         load that location with getSupplierLocationResources() and a SupplierLocationCriteriaTransfer
        //         (setIdSupplierLocation). Return the first resource, or null when there is none (404).
        // TODO-2: Without `idSupplier` in $uriVariables there is nothing to filter by: return an empty array.
        // TODO-3: GET /suppliers/{idSupplier}/supplier-locations and the include: return
        //         getSupplierLocationResources() for a criteria with setFkSupplier((int)$uriVariables['idSupplier']).

        return [];
    }

    /**
     * @param \Generated\Shared\Transfer\SupplierLocationCriteriaTransfer $supplierLocationCriteriaTransfer
     *
     * @return array<\Generated\Api\Backend\SupplierLocationsBackendResource>
     */
    protected function getSupplierLocationResources(SupplierLocationCriteriaTransfer $supplierLocationCriteriaTransfer): array
    {
        $supplierLocationTransfers = $this->supplierFacade
            ->getSupplierLocationCollection($supplierLocationCriteriaTransfer)
            ->getSupplierLocations();

        $supplierBackendMapper = new SupplierBackendMapper();
        $resources = [];

        foreach ($supplierLocationTransfers as $supplierLocationTransfer) {
            $resources[] = $supplierBackendMapper
                ->mapSupplierLocationTransferToSupplierLocationsBackendResource($supplierLocationTransfer);
        }

        return $resources;
    }
}
