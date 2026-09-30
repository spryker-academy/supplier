<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Client\SupplierStorage;

use Generated\Shared\Transfer\SupplierCollectionTransfer;
use Generated\Shared\Transfer\SupplierTransfer;

interface SupplierStorageClientInterface
{
    /**
     * Specification:
     * - Reads the supplier from the key-value storage (Redis), key "supplier:{idSupplier}".
     * - Returns null when the supplier is not in the storage.
     *
     * @api
     */
    public function findSupplierById(int $idSupplier): ?SupplierTransfer;

    /**
     * Specification:
     * - Reads every supplier from the key-value storage (Redis).
     *
     * @api
     */
    public function getAllSuppliers(): SupplierCollectionTransfer;
}
