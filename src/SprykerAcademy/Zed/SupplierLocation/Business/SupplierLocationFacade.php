<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Zed\SupplierLocation\Business;

use Generated\Shared\Transfer\SupplierLocationTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerAcademy\Zed\SupplierLocation\Persistence\SupplierLocationEntityManagerInterface getEntityManager()
 */
class SupplierLocationFacade extends AbstractFacade implements SupplierLocationFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     */
    public function createSupplierLocation(SupplierLocationTransfer $supplierLocationTransfer): SupplierLocationTransfer
    {
        return $this->getEntityManager()->createSupplierLocation($supplierLocationTransfer);
    }
}
