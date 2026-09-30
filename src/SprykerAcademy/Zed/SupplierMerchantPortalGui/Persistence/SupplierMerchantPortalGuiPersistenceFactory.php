<?php

declare(strict_types=1);

namespace SprykerAcademy\Zed\SupplierMerchantPortalGui\Persistence;

use Orm\Zed\Supplier\Persistence\PyzMerchantToSupplierQuery;
use Orm\Zed\Supplier\Persistence\PyzSupplierQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;
use SprykerAcademy\Zed\SupplierMerchantPortalGui\SupplierMerchantPortalGuiDependencyProvider;

/**
 * @method \SprykerAcademy\Zed\SupplierMerchantPortalGui\Persistence\SupplierMerchantPortalGuiRepositoryInterface getRepository()
 */
class SupplierMerchantPortalGuiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Supplier\Persistence\PyzSupplierQuery
     */
    public function getSupplierPropelQuery(): PyzSupplierQuery
    {
        return $this->getProvidedDependency(SupplierMerchantPortalGuiDependencyProvider::PROPEL_QUERY_SUPPLIER);
    }

    /**
     * @return \Orm\Zed\Supplier\Persistence\PyzMerchantToSupplierQuery
     */
    public function getMerchantToSupplierPropelQuery(): PyzMerchantToSupplierQuery
    {
        return $this->getProvidedDependency(SupplierMerchantPortalGuiDependencyProvider::PROPEL_QUERY_MERCHANT_TO_SUPPLIER);
    }
}
