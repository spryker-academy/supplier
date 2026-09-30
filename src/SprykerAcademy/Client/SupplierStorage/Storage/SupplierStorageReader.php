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
    /**
     * The `resource` parameter of the synchronization behavior in pyz_supplier_storage.schema.xml.
     */
    protected const string RESOURCE_NAME = 'supplier';

    protected static ?SynchronizationKeyGeneratorPluginInterface $storageKeyBuilder = null;

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
        return $this->getDataByKey($this->generateStorageKey($idSupplier));
    }

    /**
     * @return list<array<string, mixed>>
     */
    public function getAllSuppliers(): array
    {
        $suppliers = [];

        foreach ($this->storageClient->getKeys($this->generateStorageKeyPattern()) as $key) {
            // getKeys() returns the keys with the storage prefix ("kv:supplier:1"), get() adds it itself
            $supplierData = $this->getDataByKey((string)preg_replace('/^kv:/', '', $key));

            if ($supplierData !== null) {
                $suppliers[] = $supplierData;
            }
        }

        return $suppliers;
    }

    protected function generateStorageKey(int $idSupplier): string
    {
        $synchronizationDataTransfer = (new SynchronizationDataTransfer())
            ->setReference((string)$idSupplier);

        return $this->getStorageKeyBuilder()->generateKey($synchronizationDataTransfer);
    }

    protected function generateStorageKeyPattern(): string
    {
        $synchronizationDataTransfer = (new SynchronizationDataTransfer())
            ->setReference('*');

        return $this->getStorageKeyBuilder()->generateKey($synchronizationDataTransfer);
    }

    protected function getStorageKeyBuilder(): SynchronizationKeyGeneratorPluginInterface
    {
        if (static::$storageKeyBuilder === null) {
            static::$storageKeyBuilder = $this->synchronizationService->getStorageKeyBuilder(static::RESOURCE_NAME);
        }

        return static::$storageKeyBuilder;
    }

    /**
     * StorageClient::get() decodes the JSON document already.
     *
     * @return array<string, mixed>|null
     */
    protected function getDataByKey(string $key): ?array
    {
        $supplierData = $this->storageClient->get($key);

        return is_array($supplierData) ? $supplierData : null;
    }
}
