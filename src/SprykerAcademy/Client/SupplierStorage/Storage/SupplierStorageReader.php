<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Client\SupplierStorage\Storage;

use Generated\Shared\Transfer\SynchronizationDataTransfer;
use Spryker\Client\Storage\StorageClientInterface;
use Spryker\Service\Synchronization\Dependency\Plugin\SynchronizationKeyGeneratorPluginInterface;
use Spryker\Service\Synchronization\SynchronizationServiceInterface;

/**
 * Reads the supplier documents that Publish & Synchronize wrote to Redis ("supplier:{idSupplier}").
 */
class SupplierStorageReader
{
    // TODO-1: Add the resource name constant: protected const string RESOURCE_NAME = 'supplier';
    //         It is the `resource` parameter of the synchronization behavior in pyz_supplier_storage.schema.xml.

    // TODO-2: Add a static property that caches the key builder:
    //         protected static ?SynchronizationKeyGeneratorPluginInterface $storageKeyBuilder = null;

    public function __construct(
        protected StorageClientInterface $storageClient,
        protected SynchronizationServiceInterface $synchronizationService,
    ) {
    }

    /**
     * @return array<string, mixed>|null
     */
    public function findSupplierStorageData(int $idSupplier): ?array
    {
        // TODO-3: Build the key with generateStorageKey() and return getDataByKey() for it.

        return null;
    }

    /**
     * @return list<array<string, mixed>>
     */
    public function getAllSuppliers(): array
    {
        // TODO-4: Get every key of the pattern generateStorageKeyPattern() with $this->storageClient->getKeys().
        //         getKeys() returns the keys with the storage prefix ("kv:supplier:1"), strip "kv:" before you read them.
        //         Read every key with getDataByKey() and leave out the ones that return null.

        return [];
    }

    // TODO-5: Add the helper methods:
    //         - generateStorageKey(int $idSupplier): string - a SynchronizationDataTransfer with the id as reference,
    //           turned into a key by getStorageKeyBuilder()->generateKey()
    //         - generateStorageKeyPattern(): string - the same with '*' as reference
    //         - getStorageKeyBuilder(): SynchronizationKeyGeneratorPluginInterface - creates the builder with
    //           $this->synchronizationService->getStorageKeyBuilder(static::RESOURCE_NAME) once and caches it
    //         - getDataByKey(string $key): ?array - $this->storageClient->get($key) returns the decoded
    //           document; return it when it is an array, null otherwise
}
