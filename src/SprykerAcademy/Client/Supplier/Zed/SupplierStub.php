<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerAcademy\Client\Supplier\Zed;

use Generated\Shared\Transfer\SupplierCriteriaTransfer;
use Generated\Shared\Transfer\SupplierTransfer;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;

class SupplierStub implements SupplierStubInterface
{
    public function __construct(
        protected ZedRequestClientInterface $zedRequestClient,
    ) {
    }

    /**
     * @param \Generated\Shared\Transfer\SupplierCriteriaTransfer $supplierCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\SupplierTransfer
     */
    public function findSupplierById(SupplierCriteriaTransfer $supplierCriteriaTransfer): SupplierTransfer
    {
        // TODO-1: Make an RPC call to the Zed Gateway Controller.
        // Hint-1: Use $this->zedRequestClient->call() with the URL and criteria transfer
        // Hint-2: URL format: '/supplier/gateway/find-supplier-by-id' (maps to GatewayController::findSupplierByIdAction)
        // Hint-3: Pass $supplierCriteriaTransfer as the second parameter
        // Hint-4: Cast the result to SupplierTransfer

        return new SupplierTransfer();
    }
}
