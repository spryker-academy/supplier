<?php

namespace SprykerAcademy\Zed\Supplier\Business;

use SprykerAcademy\Zed\Supplier\Business\Reader\SupplierReader;
use SprykerAcademy\Zed\Supplier\Business\Writer\SupplierWriter;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \SprykerAcademy\Zed\Supplier\Persistence\SupplierEntityManagerInterface getEntityManager()
 * @method \SprykerAcademy\Zed\Supplier\Persistence\SupplierRepositoryInterface getRepository()
 */
class SupplierBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \SprykerAcademy\Zed\Supplier\Business\Writer\SupplierWriter
     */
    public function createSupplierWriter(): SupplierWriter
    {
        return new SupplierWriter(
            $this->getEntityManager(),
        );
    }

    /**
     * @return \SprykerAcademy\Zed\Supplier\Business\Reader\SupplierReader
     */
    public function createSupplierReader(): SupplierReader
    {
        return new SupplierReader(
            $this->getRepository(),
        );
    }
}
