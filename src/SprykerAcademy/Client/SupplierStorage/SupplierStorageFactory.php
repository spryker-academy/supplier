<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Client\SupplierStorage;

use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\Storage\StorageClientInterface;
use Spryker\Service\Synchronization\SynchronizationServiceInterface;
use SprykerAcademy\Client\SupplierStorage\Storage\SupplierStorageReader;

class SupplierStorageFactory extends AbstractFactory
{
    public function createSupplierStorageReader(): SupplierStorageReader
    {
        return new SupplierStorageReader(
            $this->getStorageClient(),
            $this->getSynchronizationService(),
        );
    }

    public function getStorageClient(): StorageClientInterface
    {
        return $this->getProvidedDependency(SupplierStorageDependencyProvider::CLIENT_STORAGE);
    }

    public function getSynchronizationService(): SynchronizationServiceInterface
    {
        return $this->getProvidedDependency(SupplierStorageDependencyProvider::SERVICE_SYNCHRONIZATION);
    }
}
