<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Zed\SupplierGui;

use Orm\Zed\Supplier\Persistence\PyzSupplierQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class SupplierGuiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const string FACADE_SUPPLIER = 'FACADE_SUPPLIER';

    public const string PROPEL_QUERY_SUPPLIER = 'PROPEL_QUERY_SUPPLIER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     */
    #[\Override]
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);

        // TODO: Call addSupplierPropelQuery() and addSupplierFacade() here

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     */
    protected function addSupplierPropelQuery(Container $container): Container
    {
        // TODO: Use $container->set() with PROPEL_QUERY_SUPPLIER to provide a PyzSupplierQuery
        // Hint: Use $container->factory() to ensure a fresh query instance each time

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     */
    protected function addSupplierFacade(Container $container): Container
    {
        // TODO: Use $container->set() with FACADE_SUPPLIER to provide the Supplier facade
        // Hint: Use the locator: $container->getLocator()->supplier()->facade()

        return $container;
    }
}
