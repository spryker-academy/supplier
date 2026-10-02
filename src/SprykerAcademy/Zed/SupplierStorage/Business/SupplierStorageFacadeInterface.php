<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Zed\SupplierStorage\Business;

interface SupplierStorageFacadeInterface
{
    /**
     * Specification:
     * - Extracts supplier IDs from event transfers.
     * - Writes supplier data to storage.
     *
     * @api
     *
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventTransfers
     *
     * @return void
     */
    public function writeCollectionBySupplierEvents(array $eventTransfers): void;

    /**
     * Specification:
     * - Deletes the storage entries of the suppliers whose pyz_supplier rows were deleted.
     *
     * @api
     *
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventEntityTransfers
     */
    public function deleteCollectionBySupplierEvents(array $eventEntityTransfers): void;
}
