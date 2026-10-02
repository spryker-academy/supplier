<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Zed\Supplier\Business\Writer;

use Generated\Shared\Transfer\SupplierTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;
use SprykerAcademy\Zed\Supplier\Persistence\SupplierEntityManagerInterface;

readonly class SupplierWriter
{
    use TransactionTrait;

    /**
     * @param \SprykerAcademy\Zed\Supplier\Persistence\SupplierEntityManagerInterface $supplierEntityManager
     */
    public function __construct(protected SupplierEntityManagerInterface $supplierEntityManager)
    {
    }

    /**
     * @param \Generated\Shared\Transfer\SupplierTransfer $supplierTransfer
     */
    public function create(SupplierTransfer $supplierTransfer): SupplierTransfer
    {
        return $this->supplierEntityManager->createSupplier($supplierTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\SupplierTransfer $supplierTransfer
     */
    public function update(SupplierTransfer $supplierTransfer): SupplierTransfer
    {
        return $this->supplierEntityManager->updateSupplier($supplierTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\SupplierTransfer $supplierTransfer
     */
    public function delete(SupplierTransfer $supplierTransfer): void
    {
        $idSupplier = $supplierTransfer->getIdSupplier();

        if ($idSupplier === null) {
            return;
        }

        // pyz_supplier_location and pyz_merchant_to_supplier reference the supplier with a foreign key, so their
        // rows go first. One transaction: either the supplier and everything that belongs to it is gone, or nothing.
        $this->getTransactionHandler()->handleTransaction(function () use ($supplierTransfer, $idSupplier): void {
            $this->supplierEntityManager->deleteSupplierLocations($idSupplier);
            $this->supplierEntityManager->deleteSupplierMerchantRelations($idSupplier);
            $this->supplierEntityManager->deleteSupplier($supplierTransfer);
        });
    }
}
