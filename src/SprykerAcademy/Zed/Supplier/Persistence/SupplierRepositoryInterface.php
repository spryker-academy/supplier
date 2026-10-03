<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Zed\Supplier\Persistence;

use Generated\Shared\Transfer\SupplierCollectionTransfer;
use Generated\Shared\Transfer\SupplierCriteriaTransfer;
use Generated\Shared\Transfer\SupplierLocationCollectionTransfer;
use Generated\Shared\Transfer\SupplierLocationCriteriaTransfer;
use Generated\Shared\Transfer\SupplierTransfer;

interface SupplierRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\SupplierCriteriaTransfer $supplierCriteriaTransfer
     */
    public function getSuppliers(SupplierCriteriaTransfer $supplierCriteriaTransfer): array;

    /**
     * @param int $idSupplier
     */
    public function findSupplierById(int $idSupplier): ?SupplierTransfer;

    /**
     * Returns one page of suppliers (criteria.pagination.offset/limit) and the total in pagination.nbResults.
     *
     * @param \Generated\Shared\Transfer\SupplierCriteriaTransfer $supplierCriteriaTransfer
     */
    public function getPaginatedSupplierCollection(SupplierCriteriaTransfer $supplierCriteriaTransfer): SupplierCollectionTransfer;

    /**
     * @param \Generated\Shared\Transfer\SupplierLocationCriteriaTransfer $supplierLocationCriteriaTransfer
     */
    public function getSupplierLocationCollection(
        SupplierLocationCriteriaTransfer $supplierLocationCriteriaTransfer,
    ): SupplierLocationCollectionTransfer;
}
