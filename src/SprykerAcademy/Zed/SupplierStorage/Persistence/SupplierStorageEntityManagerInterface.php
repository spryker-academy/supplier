<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Zed\SupplierStorage\Persistence;

use Generated\Shared\Transfer\SupplierStorageTransfer;

interface SupplierStorageEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\SupplierStorageTransfer $supplierStorageTransfer
     *
     * @return \Generated\Shared\Transfer\SupplierStorageTransfer
     */
    public function createSupplierStorage(SupplierStorageTransfer $supplierStorageTransfer): SupplierStorageTransfer;

    /**
     * @param \Generated\Shared\Transfer\SupplierStorageTransfer $supplierStorageTransfer
     *
     * @return \Generated\Shared\Transfer\SupplierStorageTransfer
     */
    public function updateSupplierStorage(SupplierStorageTransfer $supplierStorageTransfer): SupplierStorageTransfer;

    /**
     * Deletes the pyz_supplier_storage rows of the given suppliers, one entity at a time so that the synchronization
     * behavior sends the delete to Redis.
     *
     * @param array<int> $supplierIds
     */
    public function deleteSupplierStoragesBySupplierIds(array $supplierIds): void;
}
