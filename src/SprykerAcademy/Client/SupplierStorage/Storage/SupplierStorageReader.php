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
use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;

class SupplierStorageReader
{
    /**
     * @var string
     */
    protected const RESOURCE_NAME = 'supplier';

    /**
     * @var \Spryker\Service\Synchronization\Dependency\Plugin\SynchronizationKeyGeneratorPluginInterface|null
     */
    protected static ?SynchronizationKeyGeneratorPluginInterface $storageKeyBuilder = null;

    /**
     * @param \Spryker\Client\Storage\StorageClientInterface $storageClient
     * @param \Spryker\Service\Synchronization\SynchronizationServiceInterface $synchronizationService
     * @param \Spryker\Service\UtilEncoding\UtilEncodingServiceInterface $utilEncodingService
     */
    public function __construct(
        protected StorageClientInterface $storageClient,
        protected SynchronizationServiceInterface $synchronizationService,
        protected UtilEncodingServiceInterface $utilEncodingService,
    ) {
    }

    /**
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

        return $supplierStorageData;
    }

    /**
     * @param int $idSupplier
     *
     * @return string
     */
    protected function generateStorageKey(int $idSupplier): string
    {
        $synchronizationDataTransfer = new SynchronizationDataTransfer()
            ->setReference((string)$idSupplier);

        return $this->getStorageKeyBuilder()->generateKey($synchronizationDataTransfer);
    }

    /**
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
     * @param array<int> $supplierIds
     *
     * @return array<array<string, mixed>>
     */
    public function getSuppliersByIds(array $supplierIds): array
    {
        if (!$supplierIds) {
            return [];
        }

        $storageKeys = array_map(
            fn(int $id): string => $this->generateStorageKey($id),
            $supplierIds,
        );

        $storageData = $this->storageClient->getMulti($storageKeys);

        $decodedData = [];
        foreach ($storageData as $storageDataItem) {
            if (!$storageDataItem) {
                continue;
            }

            $decodedItem = $this->utilEncodingService->decodeJson($storageDataItem, true);

            if (!$decodedItem) {
                continue;
            }

            $decodedData[] = $decodedItem;
        }

        return $decodedData;
    }

    /**
     * @return array<array<string, mixed>>
     */
    public function getAllSuppliers(): array
    {
        $pattern = $this->generateStorageKeyPattern();

        $keys = $this->storageClient->getKeys($pattern);

        if (!$keys) {
            return [];
        }

        $keys = array_map(static fn(string $key) => preg_replace('/^kv:/', '', $key), $keys);

        $storageData = $this->storageClient->getMulti($keys);

        $decodedData = [];
        foreach ($storageData as $storageDataItem) {
            if (!$storageDataItem) {
                continue;
            }

            $decodedItem = $this->utilEncodingService->decodeJson($storageDataItem, true);

            if (!$decodedItem) {
                continue;
            }

            $decodedData[] = $decodedItem;
        }

        return $decodedData;
    }

    /**
     * @return string
     */
    protected function generateStorageKeyPattern(): string
    {
        $synchronizationDataTransfer = new SynchronizationDataTransfer()
            ->setReference('*');

        return $this->getStorageKeyBuilder()->generateKey($synchronizationDataTransfer);
    }
}
