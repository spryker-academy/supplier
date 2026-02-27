<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerAcademy\Client\Supplier;

use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

class SupplierDependencyProvider extends AbstractDependencyProvider
{
    public const CLIENT_ZED_REQUEST = 'CLIENT_ZED_REQUEST';
    public const CLIENT_SUPPLIER_SEARCH = 'CLIENT_SUPPLIER_SEARCH';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = parent::provideServiceLayerDependencies($container);

        // TODO-1: Provide the ZedRequest client for RPC calls.
        // Hint-1: Use $container->set() with CLIENT_ZED_REQUEST as key
        // Hint-2: Return a closure that gets the client: fn(Container $c) => $c->getLocator()->zedRequest()->client()

        // TODO-2: Provide the SupplierSearch client for Elasticsearch queries.
        // Hint-1: Use $container->set() with CLIENT_SUPPLIER_SEARCH as key
        // Hint-2: Return a closure that gets the client: fn(Container $c) => $c->getLocator()->supplierSearch()->client()

        return $container;
    }
}
