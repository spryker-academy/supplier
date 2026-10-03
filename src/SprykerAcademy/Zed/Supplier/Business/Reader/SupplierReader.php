<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Zed\Supplier\Business\Reader;

use Generated\Shared\Transfer\SupplierCriteriaTransfer;
use Generated\Shared\Transfer\SupplierLocationCollectionTransfer;
use Generated\Shared\Transfer\SupplierLocationCriteriaTransfer;
use Generated\Shared\Transfer\SupplierTransfer;
use SprykerAcademy\Zed\Supplier\Persistence\SupplierRepositoryInterface;

readonly class SupplierReader
{
    /**
     * @param \SprykerAcademy\Zed\Supplier\Persistence\SupplierRepositoryInterface $supplierRepository
     */
    public function __construct(protected SupplierRepositoryInterface $supplierRepository)
    {
    }

    /**
     * @param \Generated\Shared\Transfer\SupplierCriteriaTransfer $supplierCriteriaTransfer
     */
    public function getSuppliers(SupplierCriteriaTransfer $supplierCriteriaTransfer): array
    {
        $supplierTransfers = $this->supplierRepository
            ->getSuppliers($supplierCriteriaTransfer);

        if ($supplierCriteriaTransfer->getWithSupplierLocations()) {
            $this->expandSuppliersWithSupplierLocations($supplierTransfers);
        }

        return $supplierTransfers;
    }

    /**
     * @param \Generated\Shared\Transfer\SupplierLocationCriteriaTransfer $supplierLocationCriteriaTransfer
     */
    public function getSupplierLocationCollection(
        SupplierLocationCriteriaTransfer $supplierLocationCriteriaTransfer,
    ): SupplierLocationCollectionTransfer {
        return $this->supplierRepository->getSupplierLocationCollection($supplierLocationCriteriaTransfer);
    }

    /**
     * One query for the locations of all suppliers, not one per supplier.
     *
     * @param array<\Generated\Shared\Transfer\SupplierTransfer> $supplierTransfers
     */
    protected function expandSuppliersWithSupplierLocations(array $supplierTransfers): void
    {
        $supplierTransfersIndexed = [];

        foreach ($supplierTransfers as $supplierTransfer) {
            $supplierTransfersIndexed[$supplierTransfer->getIdSupplier()] = $supplierTransfer;
        }

        if ($supplierTransfersIndexed === []) {
            return;
        }

        $supplierLocationCollectionTransfer = $this->supplierRepository->getSupplierLocationCollection(
            (new SupplierLocationCriteriaTransfer())->setFksSupplier(array_keys($supplierTransfersIndexed)),
        );

        foreach ($supplierLocationCollectionTransfer->getSupplierLocations() as $supplierLocationTransfer) {
            $supplierTransfersIndexed[$supplierLocationTransfer->getFkSupplier()]
                ->addSupplierLocation($supplierLocationTransfer);
        }
    }

    /**
     * @param int $idSupplier
     */
    public function findSupplierById(int $idSupplier): ?SupplierTransfer
    {
        return $this->supplierRepository->findSupplierById($idSupplier);
    }
}
