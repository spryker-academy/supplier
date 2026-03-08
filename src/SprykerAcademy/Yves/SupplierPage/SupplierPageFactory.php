<?php

namespace SprykerAcademy\Yves\SupplierPage;

use SprykerAcademy\Client\SupplierSearch\SupplierSearchClientInterface;
use Spryker\Yves\Kernel\AbstractFactory;

/**
 * TODO: Exercise - Factory
 *
 * The factory provides access to the SupplierSearchClient.
 * You need to implement getSupplierSearchClient() that retrieves
 * the client from the DependencyProvider.
 */
class SupplierPageFactory extends AbstractFactory
{
    /**
     * TODO: Implement this method
     * Return the SupplierSearchClient using getProvidedDependency()
     * Use the constant from SupplierPageDependencyProvider::CLIENT_SUPPLIER_SEARCH
     *
     * @return \SprykerAcademy\Client\SupplierSearch\SupplierSearchClientInterface
     */
    public function getSupplierSearchClient(): SupplierSearchClientInterface
    {
        // TODO: Return the client from provided dependencies
        // return $this->getProvidedDependency(SupplierPageDependencyProvider::CLIENT_SUPPLIER_SEARCH);
    }
}
