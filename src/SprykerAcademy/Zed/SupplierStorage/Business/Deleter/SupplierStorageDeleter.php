<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Zed\SupplierStorage\Business\Deleter;

use SprykerAcademy\Zed\SupplierStorage\Persistence\SupplierStorageEntityManagerInterface;

readonly class SupplierStorageDeleter
{
    public function __construct(protected SupplierStorageEntityManagerInterface $supplierStorageEntityManager)
    {
    }

    /**
     * The event of a deleted pyz_supplier row carries the id of the row that is gone; the supplier itself
     * can no longer be read, so the storage rows are deleted by that id.
     *
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventEntityTransfers
     */
    public function deleteCollectionBySupplierEvents(array $eventEntityTransfers): void
    {
        $supplierIds = [];
        foreach ($eventEntityTransfers as $eventEntityTransfer) {
            if ($eventEntityTransfer->getId() !== null) {
                $supplierIds[] = (int)$eventEntityTransfer->getId();
            }
        }

        if ($supplierIds === []) {
            return;
        }

        $this->supplierStorageEntityManager->deleteSupplierStoragesBySupplierIds(array_values(array_unique($supplierIds)));
    }
}
