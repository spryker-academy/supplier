<?php

namespace SprykerAcademy\Glue\SuppliersApi;

use SprykerAcademy\Client\SupplierSearch\SupplierSearchClientInterface;
use SprykerAcademy\Glue\SuppliersApi\Processor\Mapper\SupplierMapper;
use SprykerAcademy\Glue\SuppliersApi\Processor\Reader\SupplierReader;
use Spryker\Glue\Kernel\AbstractStorefrontApiFactory;

class SuppliersApiFactory extends AbstractStorefrontApiFactory
{
    /**
     * @return \SprykerAcademy\Glue\SuppliersApi\Processor\Mapper\SupplierMapper
     */
    public function createSupplierMapper(): SupplierMapper
    {
        return new SupplierMapper();
    }

    /**
     * @return \SprykerAcademy\Glue\SuppliersApi\Processor\Reader\SupplierReader
     */
    public function createSupplierReader(): SupplierReader
    {
        return new SupplierReader(
            $this->getSupplierSearchClient(),
            $this->createSupplierMapper(),
        );
    }

    /**
     * @return \SprykerAcademy\Client\SupplierSearch\SupplierSearchClientInterface
     */
    public function getSupplierSearchClient(): SupplierSearchClientInterface
    {
        return $this->getProvidedDependency(SuppliersApiDependencyProvider::CLIENT_SUPPLIER_SEARCH);
    }
}
