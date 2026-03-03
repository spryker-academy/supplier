<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Yves\CustomerPage;

use Spryker\Yves\Kernel\Container;
use SprykerShop\Yves\CustomerPage\CustomerPageDependencyProvider as SprykerShopCustomerPageDependencyProvider;

/**
 * Note: In the project, this class already exists and extends SprykerShopCustomerPageDependencyProvider.
 * Merge the changes below into the existing class.
 */
class CustomerPageDependencyProvider extends SprykerShopCustomerPageDependencyProvider
{
    public const CLIENT_HELLO_WORLD = 'CLIENT_HELLO_WORLD';

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);
        $container = $this->addHelloWorldClient($container);

        return $container;
    }

    protected function addHelloWorldClient(Container $container): Container
    {
        $container->set(static::CLIENT_HELLO_WORLD, function (Container $container) {
            return $container->getLocator()->helloWorld()->client();
        });

        return $container;
    }
}
