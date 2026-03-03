<?php

namespace SprykerAcademy\Zed\Supplier\Persistence;

use Generated\Shared\Transfer\SupplierCriteriaTransfer;
use Generated\Shared\Transfer\SupplierTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \SprykerAcademy\Zed\Supplier\Persistence\SupplierPersistenceFactory getFactory()
 */
class SupplierRepository extends AbstractRepository implements SupplierRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\SupplierCriteriaTransfer $supplierCriteriaTransfer
     *
     * @return array<\Generated\Shared\Transfer\SupplierTransfer>
     */
    public function getSuppliers(SupplierCriteriaTransfer $supplierCriteriaTransfer): array
    {
        $supplierEntities = $this->getFactory()
            ->createSupplierQuery()
            ->filterByIdSupplier_In($supplierCriteriaTransfer->getIdsSupplier())
            ->find();

        $supplierTransfers = [];
        $supplierMapper = $this->getFactory()->createSupplierMapper();

        foreach ($supplierEntities as $supplierEntity) {
            $supplierTransfers[] = $supplierMapper->mapSupplierEntityToSupplierTransfer(
                $supplierEntity,
                new SupplierTransfer(),
            );
        }

        return $supplierTransfers;
    }
}
