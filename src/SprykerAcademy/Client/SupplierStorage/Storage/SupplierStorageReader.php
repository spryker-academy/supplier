<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerAcademy\Client\SupplierStorage\Storage;

use Generated\Shared\Transfer\SynchronizationDataTransfer;
use Spryker\Client\Storage\StorageClientInterface;
use Spryker\Service\Synchronization\Dependency\Plugin\SynchronizationKeyGeneratorPluginInterface;
use Spryker\Service\Synchronization\SynchronizationServiceInterface;

class SupplierStorageReader
{
    /**
     * @var string
     */
    protected const RESOURCE_NAME = 'supplier';

    /**
     * Cached storage key builder for performance optimization.
     * Following Spryker best practice: cache expensive service lookups in static properties.
     *
     * @var \Spryker\Service\Synchronization\Dependency\Plugin\SynchronizationKeyGeneratorPluginInterface|null
     */
    protected static ?SynchronizationKeyGeneratorPluginInterface $storageKeyBuilder = null;

    /**
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
     * Best practices applied:
     * - Uses SynchronizationDataTransfer for key generation (instead of manual string building)
     * - Caches key builder in static property for performance
     * - Returns decoded array directly (no need for intermediate objects)
     *
     * @param int $idSupplier
     *
     * @return array<string, mixed>|null
     */
    public function findSupplierStorageData(int $idSupplier): ?array
    {
        $key = $this->generateStorageKey($idSupplier);

        $supplierStorageData = $this->storageClient->get($key);

        if (!$supplierStorageData) {
            return null;
        }

        return json_decode($supplierStorageData, true);
    }

    /**
     * Gets all suppliers from Redis storage.
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
        $pattern = $this->generateStorageKeyPattern();

        $keys = $this->storageClient->getKeys($pattern);

        return array_filter(
            array_map(
                fn (string $key): ?array => $this->getDataByKey($key),
                $keys,
            ),
        );
    }

    /**
     * Generates Redis storage key for a specific supplier.
     *
     * Best practice: Use SynchronizationDataTransfer instead of manual key building.
     * This ensures consistency across the application and handles store-specific keys.
     *
     * @param int $idSupplier
     *
     * @return string
     */
    protected function generateStorageKey(int $idSupplier): string
    {
        $synchronizationDataTransfer = (new SynchronizationDataTransfer())
            ->setReference((string)$idSupplier);

        return $this->getStorageKeyBuilder()->generateKey($synchronizationDataTransfer);
    }

    /**
     * Generates Redis key pattern for finding all suppliers.
     *
     * Returns pattern like: "supplier:*"
     *
     * @return string
     */
    protected function generateStorageKeyPattern(): string
    {
        $synchronizationDataTransfer = (new SynchronizationDataTransfer())
            ->setReference('*');

        return $this->getStorageKeyBuilder()->generateKey($synchronizationDataTransfer);
    }

    /**
     * Gets and caches the storage key builder.
     *
     * Best practice: Cache expensive service lookups in static properties.
     * This prevents repeated service resolution on every key generation.
     *
     * @return \Spryker\Service\Synchronization\Dependency\Plugin\SynchronizationKeyGeneratorPluginInterface
     */
    protected function getStorageKeyBuilder(): SynchronizationKeyGeneratorPluginInterface
    {
        if (static::$storageKeyBuilder === null) {
            static::$storageKeyBuilder = $this->synchronizationService
                ->getStorageKeyBuilder(static::RESOURCE_NAME);
        }

        return static::$storageKeyBuilder;
    }

    /**
     * Gets and decodes data from Redis by key.
     *
     * @param string $key
     *
     * @return array<string, mixed>|null
     */
    protected function getDataByKey(string $key): ?array
    {
        $data = $this->storageClient->get($key);

        if (!$data) {
            return null;
        }

        return json_decode($data, true);
    }
}
