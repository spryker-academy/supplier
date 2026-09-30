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
        // TODO-1: Read the supplier data with the reader's findSupplierStorageData().
        //         Return null when there is none, a SupplierTransfer filled with fromArray($data, true) otherwise.

        return null;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     */
    public function getAllSuppliers(): SupplierCollectionTransfer
    {
        // TODO-2: Map every array of the reader's getAllSuppliers() to a SupplierTransfer (fromArray($data, true))
        //         and return them in a SupplierCollectionTransfer (setSuppliers() takes an ArrayObject).

        return new SupplierCollectionTransfer();
    }
}
