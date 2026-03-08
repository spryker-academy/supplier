<?php

namespace SprykerAcademy\Yves\SupplierPage;

use SprykerAcademy\Client\SupplierSearch\SupplierSearchClientInterface;
use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;

/**
 * TODO: Exercise - Dependency Provider
 *
 * The DependencyProvider wires external dependencies into this module.
 * You need to:
 * 1. Add a constant for the client name (CLIENT_SUPPLIER_SEARCH)
 * 2. Implement addSupplierSearchClient() to provide the client
 * 3. Call addSupplierSearchClient() in provideDependencies()
 */
class SupplierPageDependencyProvider extends AbstractBundleDependencyProvider
{
    // TODO: Add constant for the client dependency name
    // public const CLIENT_SUPPLIER_SEARCH = 'CLIENT_SUPPLIER_SEARCH';

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);

        // TODO: Call the method to add the supplier search client
        // $container = $this->addSupplierSearchClient($container);

        return $container;
    }

    /**
     * TODO: Implement this method
     * Add the SupplierSearchClient to the container using $container->set()
     * Use the constant as the key
     * Return the client using: $container->getLocator()->supplierSearch()->client()
     *
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    // protected function addSupplierSearchClient(Container $container): Container
    // {
    //     // TODO: Implement client provision
    // }
}
