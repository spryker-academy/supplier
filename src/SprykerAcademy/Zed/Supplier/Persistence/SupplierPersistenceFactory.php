<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Zed\Supplier\Persistence;

use Orm\Zed\Supplier\Persistence\PyzMerchantToSupplierQuery;
use Orm\Zed\Supplier\Persistence\PyzSupplierQuery;
use Orm\Zed\SupplierLocation\Persistence\PyzSupplierLocationQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;
use SprykerAcademy\Zed\Supplier\Persistence\Propel\Mapper\SupplierMapper;

class SupplierPersistenceFactory extends AbstractPersistenceFactory
{
    public function createSupplierQuery(): PyzSupplierQuery
    {
        return PyzSupplierQuery::create();
    }

    public function createSupplierMapper(): SupplierMapper
    {
        return new SupplierMapper();
    }

    public function createSupplierLocationQuery(): PyzSupplierLocationQuery
    {
        return PyzSupplierLocationQuery::create();
    }

    public function createMerchantToSupplierQuery(): PyzMerchantToSupplierQuery
    {
        return PyzMerchantToSupplierQuery::create();
    }
}
