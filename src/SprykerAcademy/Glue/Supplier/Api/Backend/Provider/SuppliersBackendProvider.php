<?php

declare(strict_types=1);

namespace SprykerAcademy\Glue\Supplier\Api\Backend\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use Generated\Shared\Transfer\SupplierCriteriaTransfer;
use Generated\Shared\Transfer\SupplierTransfer;
use SprykerAcademy\Glue\Supplier\Processor\Mapper\SupplierMapper;
use SprykerAcademy\Zed\Supplier\Business\SupplierFacadeInterface;

/**
 * @implements \ApiPlatform\State\ProviderInterface<object>
 */
class SuppliersBackendProvider implements ProviderInterface
{
    public function __construct(
        protected SupplierFacadeInterface $supplierFacade,
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

        $supplierTransfer = $this->supplierFacade->findSupplierById((int)$idSupplier);

        if (!$supplierTransfer instanceof SupplierTransfer || $supplierTransfer->getIdSupplier() === null) {
            return null;
        }

        return (new SupplierMapper())->mapSupplierTransferToSuppliersBackendResource($supplierTransfer);
    }

    /**
     * @return array<object>
     */
    protected function provideCollection(): array
    {
        $supplierTransfers = $this->supplierFacade->getSuppliers(new SupplierCriteriaTransfer());
        $supplierMapper = new SupplierMapper();
        $resources = [];

        foreach ($supplierTransfers as $supplierTransfer) {
            $resources[] = $supplierMapper->mapSupplierTransferToSuppliersBackendResource($supplierTransfer);
        }

        return $resources;
    }
}
