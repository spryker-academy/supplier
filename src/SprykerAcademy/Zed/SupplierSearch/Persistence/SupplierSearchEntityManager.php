<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Zed\SupplierSearch\Persistence;

use Generated\Shared\Transfer\SupplierSearchTransfer;
use Orm\Zed\SupplierSearch\Persistence\PyzSupplierSearch;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;
use SprykerAcademy\Zed\SupplierSearch\Persistence\Exception\SupplierSearchNotFoundException;

/**
 * @method \SprykerAcademy\Zed\SupplierSearch\Persistence\SupplierSearchPersistenceFactory getFactory()
 */
class SupplierSearchEntityManager extends AbstractEntityManager implements SupplierSearchEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\SupplierSearchTransfer $supplierSearchTransfer
     */
    public function createSupplierSearch(
        SupplierSearchTransfer $supplierSearchTransfer,
    ): SupplierSearchTransfer {
        $supplierSearchEntity = $this->getFactory()
            ->createSupplierSearchMapper()
            ->mapSupplierSearchTransferToSupplierSearchEntity(
                $supplierSearchTransfer,
                new PyzSupplierSearch(),
            );

        $supplierSearchEntity->save();

        return $this->getFactory()
            ->createSupplierSearchMapper()
            ->mapSupplierSearchEntityToSupplierSearchTransfer($supplierSearchEntity, $supplierSearchTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\SupplierSearchTransfer $supplierSearchTransfer
     *
     * @throws \SprykerAcademy\Zed\SupplierSearch\Persistence\Exception\SupplierSearchNotFoundException
     */
    public function updateSupplierSearch(
        SupplierSearchTransfer $supplierSearchTransfer,
    ): SupplierSearchTransfer {
        $supplierSearchEntity = $this->getFactory()
            ->createSupplierSearchQuery()
            ->filterByIdSupplierSearch($supplierSearchTransfer->getIdSupplierSearch())
            ->findOne();

        if ($supplierSearchEntity === null) {
            throw new SupplierSearchNotFoundException(
                sprintf(
                    'SupplierSearch was not found by given id %s',
                    $supplierSearchTransfer->getIdSupplierSearch(),
                ),
            );
        }

        $supplierSearchEntity = $this->getFactory()
            ->createSupplierSearchMapper()
            ->mapSupplierSearchTransferToSupplierSearchEntity(
                $supplierSearchTransfer,
                $supplierSearchEntity,
            );

        $supplierSearchEntity->save();

        return $this->getFactory()
            ->createSupplierSearchMapper()
            ->mapSupplierSearchEntityToSupplierSearchTransfer($supplierSearchEntity, $supplierSearchTransfer);
    }

    /**
     * @param array<int> $supplierIds
     */
    #[\Override]
    public function deleteSupplierSearchsBySupplierIds(array $supplierIds): void
    {
        // Not ->delete() on the query: a bulk delete skips the Propel behaviors, and the synchronization
        // behavior is what removes the entry from Elasticsearch.
        $searchEntities = $this->getFactory()
            ->createSupplierSearchQuery()
            ->filterByFkSupplier_In($supplierIds)
            ->find();

        foreach ($searchEntities as $searchEntity) {
            $searchEntity->delete();
        }
    }
}
