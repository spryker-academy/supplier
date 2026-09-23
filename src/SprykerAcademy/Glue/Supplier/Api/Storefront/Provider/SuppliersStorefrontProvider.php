<?php

declare(strict_types=1);

namespace SprykerAcademy\Glue\Supplier\Api\Storefront\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use Generated\Api\Storefront\SuppliersStorefrontResource;
use Generated\Shared\Transfer\SupplierTransfer;
use SprykerAcademy\Client\SupplierSearch\SupplierSearchClientInterface;
use SprykerAcademy\Glue\Supplier\Processor\Mapper\SupplierMapper;

/**
 * @implements \ApiPlatform\State\ProviderInterface<\Generated\Api\Storefront\SuppliersStorefrontResource>
 */
class SuppliersStorefrontProvider implements ProviderInterface
{
    public function __construct(
        protected SupplierSearchClientInterface $supplierSearchClient,

    ) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $idSupplier = $uriVariables['idSupplier'] ?? null;

        if ($idSupplier === null) {
            return $this->provideCollection();
        }

        if (!is_numeric($idSupplier)) {
            return null;
        }

        $supplierTransfer = $this->supplierSearchClient->findSupplierById((int)$idSupplier);

        if ($supplierTransfer->getIdSupplier() === null) {
            return null;
        }

        return $this->mapTransferToResource($supplierTransfer);
    }

    /**
     * @return array<\Generated\Api\Storefront\SuppliersStorefrontResource>
     */
    protected function provideCollection(): array
    {
        $supplierCollectionTransfer = $this->supplierSearchClient->searchSuppliers();
        $resources = [];
        $supplierMapper = new SupplierMapper();
        foreach ($supplierCollectionTransfer->getSuppliers() as $supplierTransfer) {
            $resources[] = $supplierMapper->mapSupplierTransferToSuppliersStorefrontResource($supplierTransfer);
        }

        return $resources;
    }

    protected function mapTransferToResource(SupplierTransfer $supplierTransfer): SuppliersStorefrontResource
    {
        return (new SupplierMapper())->mapSupplierTransferToSuppliersStorefrontResource($supplierTransfer);
    }
}
