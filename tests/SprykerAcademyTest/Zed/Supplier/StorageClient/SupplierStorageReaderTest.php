<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademyTest\Zed\Supplier\StorageClient;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\SynchronizationDataTransfer;
use ReflectionProperty;
use Spryker\Client\Storage\StorageClientInterface;
use Spryker\Service\Synchronization\Dependency\Plugin\SynchronizationKeyGeneratorPluginInterface;
use Spryker\Service\Synchronization\SynchronizationServiceInterface;
use SprykerAcademy\Client\SupplierStorage\Storage\SupplierStorageReader;

/**
 * Exercise 14: the reader builds the "supplier:{id}" keys with the synchronization key builder and
 * reads the documents from the storage client.
 */
class SupplierStorageReaderTest extends Unit
{
    protected const array SUPPLIER_DATA = [
        'id_supplier' => 7,
        'name' => 'Acme Supplies',
        'status' => 1,
    ];

    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();

        if (!property_exists(SupplierStorageReader::class, 'storageKeyBuilder')) {
            $this->fail('SupplierStorageReader needs the static property $storageKeyBuilder that caches the key builder (guide part 2.2).');
        }

        // the reader caches the key builder in a static property; every test brings its own
        (new ReflectionProperty(SupplierStorageReader::class, 'storageKeyBuilder'))->setValue(null, null);
    }

    public function testFindReadsTheSupplierKeyOfTheId(): void
    {
        $storageClient = $this->createMock(StorageClientInterface::class);
        $storageClient->expects($this->once())
            ->method('get')
            ->with('supplier:7')
            ->willReturn(static::SUPPLIER_DATA);

        $reader = new SupplierStorageReader($storageClient, $this->createSynchronizationService());

        $this->assertSame(static::SUPPLIER_DATA, $reader->findSupplierStorageData(7));
    }

    public function testFindReturnsNullForAMissingKey(): void
    {
        $storageClient = $this->createMock(StorageClientInterface::class);
        $storageClient->method('get')->willReturn(null);

        $reader = new SupplierStorageReader($storageClient, $this->createSynchronizationService());

        $this->assertNull($reader->findSupplierStorageData(999999));
    }

    public function testGetAllReadsEveryKeyOfThePattern(): void
    {
        $storageClient = $this->createMock(StorageClientInterface::class);
        $storageClient->expects($this->once())
            ->method('getKeys')
            ->with('supplier:*')
            ->willReturn(['kv:supplier:7', 'kv:supplier:8']);
        $storageClient->method('get')->willReturnMap([
            ['supplier:7', static::SUPPLIER_DATA],
            ['supplier:8', null],
        ]);

        $reader = new SupplierStorageReader($storageClient, $this->createSynchronizationService());

        $this->assertSame([static::SUPPLIER_DATA], $reader->getAllSuppliers());
    }

    protected function createSynchronizationService(): SynchronizationServiceInterface
    {
        $keyBuilder = $this->createMock(SynchronizationKeyGeneratorPluginInterface::class);
        $keyBuilder->method('generateKey')->willReturnCallback(
            fn (SynchronizationDataTransfer $synchronizationDataTransfer): string => 'supplier:' . $synchronizationDataTransfer->getReference(),
        );

        $synchronizationService = $this->createMock(SynchronizationServiceInterface::class);
        $synchronizationService->method('getStorageKeyBuilder')->with('supplier')->willReturn($keyBuilder);

        return $synchronizationService;
    }
}
