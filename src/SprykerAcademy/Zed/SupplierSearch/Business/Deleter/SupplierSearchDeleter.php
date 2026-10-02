<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Zed\SupplierSearch\Business\Deleter;

use SprykerAcademy\Zed\SupplierSearch\Persistence\SupplierSearchEntityManagerInterface;

readonly class SupplierSearchDeleter
{
    public function __construct(protected SupplierSearchEntityManagerInterface $supplierSearchEntityManager)
    {
    }

    /**
     * The event of a deleted pyz_supplier row carries the id of the row that is gone; the supplier itself
     * can no longer be read, so the search rows are deleted by that id.
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

        $this->supplierSearchEntityManager->deleteSupplierSearchsBySupplierIds(array_values(array_unique($supplierIds)));
    }
}
