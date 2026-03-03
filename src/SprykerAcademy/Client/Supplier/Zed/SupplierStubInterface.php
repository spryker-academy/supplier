<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerAcademy\Client\Supplier\Zed;

use Generated\Shared\Transfer\SupplierCriteriaTransfer;
use Generated\Shared\Transfer\SupplierTransfer;

interface SupplierStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\SupplierCriteriaTransfer $supplierCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\SupplierTransfer
     */
    public function findSupplierById(SupplierCriteriaTransfer $supplierCriteriaTransfer): SupplierTransfer;
}
