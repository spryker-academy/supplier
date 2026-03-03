<?php

namespace SprykerAcademy\Zed\SupplierSearch\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerAcademy\Zed\SupplierSearch\Business\SupplierSearchBusinessFactory getFactory()
 * @method \SprykerAcademy\Zed\SupplierSearch\Persistence\SupplierSearchRepositoryInterface getRepository()
 * @method \SprykerAcademy\Zed\SupplierSearch\Persistence\SupplierSearchEntityManagerInterface getEntityManager()
 */
class SupplierSearchFacade extends AbstractFacade implements SupplierSearchFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventTransfers
     *
     * @return void
     */
    public function writeCollectionBySupplierEvents(array $eventTransfers): void
    {
        $this->getFactory()->createSupplierSearchWriter()
            ->writeCollectionBySupplierEvents($eventTransfers);    }
}
