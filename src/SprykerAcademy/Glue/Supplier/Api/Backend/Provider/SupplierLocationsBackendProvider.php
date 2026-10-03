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
        $supplierLocationCriteriaTransfer = new SupplierLocationCriteriaTransfer();

        // GET /supplier-locations/{idSupplierLocation}
        if (isset($uriVariables['idSupplierLocation'])) {
            $supplierLocationCriteriaTransfer->setIdSupplierLocation((int)$uriVariables['idSupplierLocation']);
            $resources = $this->getSupplierLocationResources($supplierLocationCriteriaTransfer);

            // Not found: API Platform answers with 404
            return $resources[0] ?? null;
        }

        // GET /suppliers/{idSupplier}/supplier-locations, and the `supplier-locations` include
        if (!isset($uriVariables['idSupplier'])) {
            return [];
        }

        $supplierLocationCriteriaTransfer->setFkSupplier((int)$uriVariables['idSupplier']);

        return $this->getSupplierLocationResources($supplierLocationCriteriaTransfer);
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
