<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Zed\SupplierLocation\Persistence;

use Generated\Shared\Transfer\SupplierLocationTransfer;

interface SupplierLocationEntityManagerInterface
{
    public function createSupplierLocation(SupplierLocationTransfer $supplierLocationTransfer): SupplierLocationTransfer;
}
