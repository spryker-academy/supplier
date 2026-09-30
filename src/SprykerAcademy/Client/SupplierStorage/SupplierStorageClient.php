<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Client\SupplierStorage;

use ArrayObject;
use Generated\Shared\Transfer\SupplierCollectionTransfer;
use Generated\Shared\Transfer\SupplierTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \SprykerAcademy\Client\SupplierStorage\SupplierStorageFactory getFactory()
 */
class SupplierStorageClient extends AbstractClient implements SupplierStorageClientInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     */
    public function findSupplierById(int $idSupplier): ?SupplierTransfer
    {
        $supplierData = $this->getFactory()
            ->createSupplierStorageReader()
            ->findSupplierStorageData($idSupplier);

        if ($supplierData === null) {
            return null;
        }

        return (new SupplierTransfer())->fromArray($supplierData, true);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     */
    public function getAllSuppliers(): SupplierCollectionTransfer
    {
        $supplierTransfers = new ArrayObject();

        foreach ($this->getFactory()->createSupplierStorageReader()->getAllSuppliers() as $supplierData) {
            $supplierTransfers->append((new SupplierTransfer())->fromArray($supplierData, true));
        }

        return (new SupplierCollectionTransfer())->setSuppliers($supplierTransfers);
    }
}
