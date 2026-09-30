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
        // TODO-3: Create the SupplierStorageReader with the Storage client and the Synchronization service.
    }

    public function getStorageClient(): StorageClientInterface
    {
        // TODO-1: Return the Storage client from the provided dependencies (CLIENT_STORAGE).
    }

    public function getSynchronizationService(): SynchronizationServiceInterface
    {
        // TODO-2: Return the Synchronization service from the provided dependencies (SERVICE_SYNCHRONIZATION).
    }
}
