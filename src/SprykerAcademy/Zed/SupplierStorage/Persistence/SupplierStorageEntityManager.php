<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Zed\SupplierStorage\Persistence;

use Generated\Shared\Transfer\SupplierStorageTransfer;
use Orm\Zed\SupplierStorage\Persistence\PyzSupplierStorage;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;
use SprykerAcademy\Zed\SupplierStorage\Persistence\Exception\SupplierStorageNotFoundException;

/**
 * @method \SprykerAcademy\Zed\SupplierStorage\Persistence\SupplierStoragePersistenceFactory getFactory()
 */
class SupplierStorageEntityManager extends AbstractEntityManager implements SupplierStorageEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\SupplierStorageTransfer $supplierStorageTransfer
     *
     * @return \Generated\Shared\Transfer\SupplierStorageTransfer
     */
    public function createSupplierStorage(SupplierStorageTransfer $supplierStorageTransfer): SupplierStorageTransfer
    {
        $supplierStorageEntity = new PyzSupplierStorage();

        $supplierStorageEntity = $this->getFactory()
            ->createSupplierStorageMapper()
            ->mapSupplierStorageTransferToSupplierStorageEntity(
                $supplierStorageTransfer,
                $supplierStorageEntity,
            );

        $supplierStorageEntity->save();

        return $this->getFactory()
            ->createSupplierStorageMapper()
            ->mapSupplierStorageEntityToSupplierStorageTransfer(
                $supplierStorageEntity,
                $supplierStorageTransfer,
            );
    }

    /**
     * @param \Generated\Shared\Transfer\SupplierStorageTransfer $supplierStorageTransfer
     *
     * @throws \SprykerAcademy\Zed\SupplierStorage\Persistence\Exception\SupplierStorageNotFoundException
     *
     * @return \Generated\Shared\Transfer\SupplierStorageTransfer
     */
    public function updateSupplierStorage(SupplierStorageTransfer $supplierStorageTransfer): SupplierStorageTransfer
    {
        $supplierStorageEntity = $this->getFactory()
            ->createSupplierStorageQuery()
            ->filterByIdSupplierStorage($supplierStorageTransfer->getIdSupplierStorage())
            ->findOne();

        if ($supplierStorageEntity === null) {
            throw new SupplierStorageNotFoundException(
                sprintf(
                    'SupplierStorage entity with id "%s" not found.',
                    $supplierStorageTransfer->getIdSupplierStorage(),
                ),
            );
        }

        $supplierStorageEntity = $this->getFactory()
            ->createSupplierStorageMapper()
            ->mapSupplierStorageTransferToSupplierStorageEntity(
                $supplierStorageTransfer,
                $supplierStorageEntity,
            );

        $supplierStorageEntity->save();

        return $this->getFactory()
            ->createSupplierStorageMapper()
            ->mapSupplierStorageEntityToSupplierStorageTransfer(
                $supplierStorageEntity,
                $supplierStorageTransfer,
            );
    }

    /**
     * @param array<int> $supplierIds
     */
    #[\Override]
    public function deleteSupplierStoragesBySupplierIds(array $supplierIds): void
    {
        // Not ->delete() on the query: a bulk delete skips the Propel behaviors, and the synchronization
        // behavior is what removes the entry from Redis.
        $storageEntities = $this->getFactory()
            ->createSupplierStorageQuery()
            ->filterByFkSupplier_In($supplierIds)
            ->find();

        foreach ($storageEntities as $storageEntity) {
            $storageEntity->delete();
        }
    }
}
