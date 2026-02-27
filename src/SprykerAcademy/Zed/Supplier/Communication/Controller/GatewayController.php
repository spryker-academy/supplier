<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerAcademy\Zed\Supplier\Communication\Controller;

use Generated\Shared\Transfer\SupplierCriteriaTransfer;
use Generated\Shared\Transfer\SupplierTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \SprykerAcademy\Zed\Supplier\Business\SupplierFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\SupplierCriteriaTransfer $supplierCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\SupplierTransfer
     */
    public function findSupplierByIdAction(SupplierCriteriaTransfer $supplierCriteriaTransfer): SupplierTransfer
    {
        // TODO-1: Find a supplier by ID using the Facade.
        // Hint-1: Call $this->getFacade()->findSupplierById() with the ID from $supplierCriteriaTransfer->getIdSupplierOrFail()
        // Hint-2: If supplier is not found (returns null), return an empty SupplierTransfer
        // Hint-3: Gateway actions must ALWAYS return a Transfer object, never null

        return new SupplierTransfer();
    }
}
