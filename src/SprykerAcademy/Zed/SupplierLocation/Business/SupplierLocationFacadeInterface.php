<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Zed\SupplierLocation\Business;

use Generated\Shared\Transfer\SupplierLocationTransfer;

interface SupplierLocationFacadeInterface
{
    /**
     * Specification:
     * - Persists a new location of the supplier `fkSupplier`.
     * - Returns the transfer with idSupplierLocation set.
     *
     * @api
     */
    public function createSupplierLocation(SupplierLocationTransfer $supplierLocationTransfer): SupplierLocationTransfer;
}
