<?php

namespace SprykerAcademy\Zed\SupplierSearch\Persistence;

use Orm\Zed\SupplierSearch\Persistence\PyzSupplierSearchQuery;
use SprykerAcademy\Zed\SupplierSearch\Persistence\Propel\Mapper\SupplierSearchMapper;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \SprykerAcademy\Zed\SupplierSearch\Persistence\SupplierSearchRepositoryInterface getRepository()
 * @method \SprykerAcademy\Zed\SupplierSearch\Persistence\SupplierSearchEntityManagerInterface getEntityManager()
 */
class SupplierSearchPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\SupplierSearch\Persistence\PyzSupplierSearchQuery
     */
    public function createSupplierSearchQuery(): PyzSupplierSearchQuery
    {
        return PyzSupplierSearchQuery::create();
    }

    /**
     * @return \SprykerAcademy\Zed\SupplierSearch\Persistence\Propel\Mapper\SupplierSearchMapper
     */
    public function createSupplierSearchMapper(): SupplierSearchMapper
    {
        return new SupplierSearchMapper();
    }
}
