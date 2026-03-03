<?php

namespace SprykerAcademy\Zed\SupplierSearch\Business;

use SprykerAcademy\Zed\Supplier\Business\SupplierFacadeInterface;
use SprykerAcademy\Zed\SupplierSearch\SupplierSearchDependencyProvider;
use SprykerAcademy\Zed\SupplierSearch\Business\Writer\SupplierSearchWriter;
use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \SprykerAcademy\Zed\SupplierSearch\Persistence\SupplierSearchRepositoryInterface getRepository()
 * @method \SprykerAcademy\Zed\SupplierSearch\Persistence\SupplierSearchEntityManagerInterface getEntityManager()
 */
class SupplierSearchBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \SprykerAcademy\Zed\SupplierSearch\Business\Writer\SupplierSearchWriter
     */
    public function createSupplierSearchWriter(): SupplierSearchWriter
    {
        return new SupplierSearchWriter(
            $this->getEventBehaviorFacade(),
            $this->getSupplierFacade(),
            $this->getRepository(),
            $this->getEntityManager(),
        );
    }

    /**
     * @return \Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface
     */
    public function getEventBehaviorFacade(): EventBehaviorFacadeInterface
    {
        return $this->getProvidedDependency(SupplierSearchDependencyProvider::FACADE_EVENT_BEHAVIOR);
    }

    /**
     * @return \SprykerAcademy\Zed\Supplier\Business\SupplierFacadeInterface
     */
    public function getSupplierFacade(): SupplierFacadeInterface
    {
        return $this->getProvidedDependency(SupplierSearchDependencyProvider::FACADE_ANTELOPE);
    }
}
