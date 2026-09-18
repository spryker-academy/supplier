<?php

namespace SprykerAcademy\Yves\SupplierPage;

use SprykerAcademy\Client\SupplierSearch\SupplierSearchClientInterface;
use Spryker\Yves\Kernel\AbstractFactory;

class SupplierPageFactory extends AbstractFactory
{
    /**
     * @return \SprykerAcademy\Client\SupplierSearch\SupplierSearchClientInterface
     */
    public function getSupplierSearchClient(): SupplierSearchClientInterface
    {
        return $this->getProvidedDependency(SupplierPageDependencyProvider::CLIENT_SUPPLIER_SEARCH);
    }
}
