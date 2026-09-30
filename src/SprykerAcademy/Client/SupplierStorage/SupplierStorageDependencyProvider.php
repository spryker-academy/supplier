<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Client\SupplierStorage;

use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

class SupplierStorageDependencyProvider extends AbstractDependencyProvider
{
    public const string CLIENT_STORAGE = 'CLIENT_STORAGE';

    public const string SERVICE_SYNCHRONIZATION = 'SERVICE_SYNCHRONIZATION';

    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = parent::provideServiceLayerDependencies($container);
        $container = $this->addStorageClient($container);
        $container = $this->addSynchronizationService($container);

        return $container;
    }

    protected function addStorageClient(Container $container): Container
    {
        $container->set(static::CLIENT_STORAGE, fn (Container $container) => $container->getLocator()->storage()->client());

        return $container;
    }

    protected function addSynchronizationService(Container $container): Container
    {
        $container->set(static::SERVICE_SYNCHRONIZATION, fn (Container $container) => $container->getLocator()->synchronization()->service());

        return $container;
    }
}
