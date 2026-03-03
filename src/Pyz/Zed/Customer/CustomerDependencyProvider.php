<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\Customer;

use Spryker\Zed\Customer\CustomerDependencyProvider as SprykerCustomerDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * Note: In the project, this class already exists and extends SprykerCustomerDependencyProvider.
 * Merge the changes below into the existing class.
 */
class CustomerDependencyProvider extends SprykerCustomerDependencyProvider
{
    public const FACADE_HELLO_WORLD = 'FACADE_HELLO_WORLD';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);
        $container = $this->addHelloWorldFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addHelloWorldFacade(Container $container): Container
    {
        $container->set(static::FACADE_HELLO_WORLD, function (Container $container) {
            return $container->getLocator()->helloWorld()->facade();
        });

        return $container;
    }
}
