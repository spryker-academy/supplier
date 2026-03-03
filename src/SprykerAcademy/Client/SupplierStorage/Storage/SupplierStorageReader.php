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

class SupplierStorageReader
{
    // TODO: Add RESOURCE_NAME constant for 'supplier'
    // Best practice: Use constants for resource identifiers to avoid typos and enable easy refactoring

    // TODO: Add static cached storage key builder property
    // Best practice: Cache expensive service lookups in static properties for performance
    // Hint: protected static ?SynchronizationKeyGeneratorPluginInterface $storageKeyBuilder = null;

    /**
     * TODO: Use PHP 8.4 constructor property promotion
     * Best practice: Declare properties directly in constructor parameters using 'protected'
     * Hint: public function __construct(protected StorageClientInterface $storageClient, ...)
     *
     * @param \Spryker\Client\Storage\StorageClientInterface $storageClient
     * @param \Spryker\Service\Synchronization\SynchronizationServiceInterface $synchronizationService
     */
    public function __construct(
        protected StorageClientInterface $storageClient,
        protected SynchronizationServiceInterface $synchronizationService,
    ) {
    }

    /**
     * Finds supplier data from Redis storage by ID.
     *
     * TODO: Refactor to use best practices
     * - Extract key generation to generateStorageKey() method
     * - Use SynchronizationDataTransfer instead of buildKey()
     * - Cache the key builder in a static property
     *
     * Best practice example:
     * $synchronizationDataTransfer = (new SynchronizationDataTransfer())
     *     ->setReference((string)$idSupplier);
     * $key = $this->getStorageKeyBuilder()->generateKey($synchronizationDataTransfer);
     *
     * @param int $idSupplier
     *
     * @return array<string, mixed>|null
     */
    public function findSupplierStorageData(int $idSupplier): ?array
    {
        $key = $this->synchronizationService
            ->getStorageKeyBuilder('supplier')
            ->buildKey((string)$idSupplier);

        $supplierStorageData = $this->storageClient->get($key);

        if (!$supplierStorageData) {
            return null;
        }

        // Note: StorageClient->get() already json_decodes automatically (see StorageRedisWrapper::get())
        return $supplierStorageData;
    }

    /**
     * Gets all suppliers from Redis storage.
     *
     * TODO: Refactor to use best practices
     * - Extract pattern generation to generateStorageKeyPattern() method
     * - Use array_map() and array_filter() instead of foreach loop
     * - Extract data retrieval to getDataByKey() method
     *
     * Best practice example:
     * $pattern = $this->generateStorageKeyPattern();
     * $keys = $this->storageClient->getKeys($pattern);
     * return array_filter(
     *     array_map(
     *         fn (string $key): ?array => $this->getDataByKey($key),
     *         $keys,
     *     ),
     * );
     *
     * Note: This method scans Redis keys with pattern matching.
     * For production with large datasets, consider:
     * - Implementing pagination
     * - Using Redis SCAN instead of KEYS
     * - Caching the collection
     *
     * @return array<array<string, mixed>>
     */
    public function getAllSuppliers(): array
    {
        $pattern = $this->synchronizationService
            ->getStorageKeyBuilder('supplier')
            ->buildKey('*');

        $keys = $this->storageClient->getKeys($pattern);

        $suppliers = [];
        foreach ($keys as $key) {
            $data = $this->storageClient->get($key);

            if ($data) {
                // Note: StorageClient->get() already json_decodes automatically
                $suppliers[] = $data;
            }
        }

        return $suppliers;
    }

    // TODO: Add helper methods for best practices implementation:
    //
    // protected function generateStorageKey(int $idSupplier): string
    // {
    //     $synchronizationDataTransfer = (new SynchronizationDataTransfer())
    //         ->setReference((string)$idSupplier);
    //
    //     return $this->getStorageKeyBuilder()->generateKey($synchronizationDataTransfer);
    // }
    //
    // protected function generateStorageKeyPattern(): string
    // {
    //     $synchronizationDataTransfer = (new SynchronizationDataTransfer())
    //         ->setReference('*');
    //
    //     return $this->getStorageKeyBuilder()->generateKey($synchronizationDataTransfer);
    // }
    //
    // protected function getStorageKeyBuilder(): SynchronizationKeyGeneratorPluginInterface
    // {
    //     if (static::$storageKeyBuilder === null) {
    //         static::$storageKeyBuilder = $this->synchronizationService
    //             ->getStorageKeyBuilder(static::RESOURCE_NAME);
    //     }
    //
    //     return static::$storageKeyBuilder;
    // }
    //
    // protected function getDataByKey(string $key): ?array
    // {
    //     $data = $this->storageClient->get($key);
    //
    //     if (!$data) {
    //         return null;
    //     }
    //
    //     // Note: StorageClient->get() already json_decodes automatically
    //     return $data;
    // }
}
