<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademyTest\Zed\Supplier\GlueApi;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Codeception\Test\Unit;
use Generated\Api\Storefront\SupplierLocationsStorefrontResource;
use Generated\Shared\Transfer\SupplierLocationTransfer;
use Generated\Shared\Transfer\SupplierTransfer;
use SprykerAcademy\Client\SupplierSearch\SupplierSearchClientInterface;
use SprykerAcademy\Glue\Supplier\Api\Storefront\Provider\SupplierLocationsStorefrontProvider;

/**
 * Exercise 12: the Storefront provider behind GET /suppliers/{idSupplier}/supplier-locations and behind
 * the `supplier-locations` include. It reads the locations from the supplier's published document.
 */
class SupplierLocationsStorefrontProviderTest extends Unit
{
    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();

        if (!class_exists(SupplierLocationsStorefrontResource::class)) {
            $this->markTestSkipped('Generated\Api\Storefront\SupplierLocationsStorefrontResource is missing - run: docker/sdk cli GLUE_APPLICATION=GLUE glue api:generate storefront');
        }
    }

    public function testCollectionReturnsTheLocationsOfTheSupplierDocument(): void
    {
        $supplierSearchClient = $this->createMock(SupplierSearchClientInterface::class);
        $supplierSearchClient->expects($this->once())
            ->method('findSupplierById')
            ->with(7)
            ->willReturn($this->createSupplierTransferWithLocations());

        $resources = (new SupplierLocationsStorefrontProvider($supplierSearchClient))->provide(new GetCollection(), ['idSupplier' => '7']);

        $this->assertIsArray($resources);
        $this->assertCount(2, $resources);
        $this->assertInstanceOf(SupplierLocationsStorefrontResource::class, $resources[0]);
        $this->assertSame(21, $resources[0]->getIdSupplierLocation());
        $this->assertSame(7, $resources[0]->getIdSupplier(), 'Map SupplierLocationTransfer.fkSupplier to the resource property idSupplier.');
        $this->assertSame('Berlin', $resources[0]->getCity());
    }

    public function testCollectionIsEmptyWithoutASupplier(): void
    {
        $supplierSearchClient = $this->createMock(SupplierSearchClientInterface::class);
        $supplierSearchClient->expects($this->never())->method('findSupplierById');

        $resources = (new SupplierLocationsStorefrontProvider($supplierSearchClient))->provide(new GetCollection());

        $this->assertSame([], $resources);
    }

    public function testItemReturnsTheLocationOfTheId(): void
    {
        $supplierSearchClient = $this->createMock(SupplierSearchClientInterface::class);
        $supplierSearchClient->method('findSupplierById')->willReturn($this->createSupplierTransferWithLocations());

        $resource = (new SupplierLocationsStorefrontProvider($supplierSearchClient))->provide(
            new Get(),
            ['idSupplier' => '7', 'idSupplierLocation' => '22'],
        );

        $this->assertInstanceOf(SupplierLocationsStorefrontResource::class, $resource);
        $this->assertSame(22, $resource->getIdSupplierLocation());
        $this->assertSame('Munich', $resource->getCity());
    }

    public function testItemIsNullWhenTheSupplierDoesNotHaveTheLocation(): void
    {
        $supplierSearchClient = $this->createMock(SupplierSearchClientInterface::class);
        $supplierSearchClient->method('findSupplierById')->willReturn($this->createSupplierTransferWithLocations());

        $resource = (new SupplierLocationsStorefrontProvider($supplierSearchClient))->provide(
            new Get(),
            ['idSupplier' => '7', 'idSupplierLocation' => '999999'],
        );

        $this->assertNull($resource, 'Return null for a location the supplier does not have; API Platform turns it into a 404.');
    }

    protected function createSupplierTransferWithLocations(): SupplierTransfer
    {
        return (new SupplierTransfer())
            ->setIdSupplier(7)
            ->setName('Acme Supplies')
            ->addSupplierLocation($this->createSupplierLocationTransfer(21, 'Berlin'))
            ->addSupplierLocation($this->createSupplierLocationTransfer(22, 'Munich'));
    }

    protected function createSupplierLocationTransfer(int $idSupplierLocation, string $city): SupplierLocationTransfer
    {
        return (new SupplierLocationTransfer())
            ->setIdSupplierLocation($idSupplierLocation)
            ->setFkSupplier(7)
            ->setCity($city)
            ->setCountry('Germany')
            ->setAddress('Alexanderplatz 1')
            ->setZipCode('10178')
            ->setIsDefault(true);
    }
}
