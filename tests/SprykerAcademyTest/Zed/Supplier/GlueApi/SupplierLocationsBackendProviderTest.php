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
use Generated\Api\Backend\SupplierLocationsBackendResource;
use Generated\Shared\Transfer\SupplierLocationCollectionTransfer;
use Generated\Shared\Transfer\SupplierLocationCriteriaTransfer;
use Generated\Shared\Transfer\SupplierLocationTransfer;
use SprykerAcademy\Glue\Supplier\Api\Backend\Provider\SupplierLocationsBackendProvider;
use SprykerAcademy\Zed\Supplier\Business\SupplierFacadeInterface;

/**
 * Exercise 12: the provider behind GET /suppliers/{idSupplier}/supplier-locations and behind the
 * `supplier-locations` include. For the include the relationship resolver calls it once per supplier,
 * with that supplier's id in the URI variables.
 */
class SupplierLocationsBackendProviderTest extends Unit
{
    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();

        if (!class_exists(SupplierLocationsBackendResource::class)) {
            $this->markTestSkipped('Generated\Api\Backend\SupplierLocationsBackendResource is missing - run: docker/sdk cli GLUE_APPLICATION=GLUE_BACKEND glue api:generate backend');
        }
    }

    public function testCollectionReturnsTheLocationsOfTheSupplier(): void
    {
        $supplierFacade = $this->createMock(SupplierFacadeInterface::class);
        $supplierFacade->expects($this->once())
            ->method('getSupplierLocationCollection')
            ->with($this->callback(function (SupplierLocationCriteriaTransfer $supplierLocationCriteriaTransfer): bool {
                return $supplierLocationCriteriaTransfer->getFkSupplier() === 7;
            }))
            ->willReturn(
                (new SupplierLocationCollectionTransfer())
                    ->addSupplierLocation($this->createSupplierLocationTransfer(21, 7, 'Berlin'))
                    ->addSupplierLocation($this->createSupplierLocationTransfer(22, 7, 'Munich')),
            );

        $resources = (new SupplierLocationsBackendProvider($supplierFacade))->provide(new GetCollection(), ['idSupplier' => '7']);

        $this->assertIsArray($resources);
        $this->assertCount(2, $resources);
        $this->assertInstanceOf(SupplierLocationsBackendResource::class, $resources[0]);
        $this->assertSame(21, $resources[0]->getIdSupplierLocation());
        $this->assertSame(7, $resources[0]->getIdSupplier(), 'Map SupplierLocationTransfer.fkSupplier to the resource property idSupplier.');
        $this->assertSame('Berlin', $resources[0]->getCity());
    }

    public function testCollectionIsEmptyWithoutASupplier(): void
    {
        $supplierFacade = $this->createMock(SupplierFacadeInterface::class);
        $supplierFacade->expects($this->never())->method('getSupplierLocationCollection');

        $resources = (new SupplierLocationsBackendProvider($supplierFacade))->provide(new GetCollection());

        $this->assertSame([], $resources, 'Without an idSupplier there is nothing to filter by: return no locations instead of all of them.');
    }

    public function testItemReturnsTheLocationOfTheId(): void
    {
        $supplierFacade = $this->createMock(SupplierFacadeInterface::class);
        $supplierFacade->expects($this->once())
            ->method('getSupplierLocationCollection')
            ->with($this->callback(function (SupplierLocationCriteriaTransfer $supplierLocationCriteriaTransfer): bool {
                return $supplierLocationCriteriaTransfer->getIdSupplierLocation() === 21;
            }))
            ->willReturn(
                (new SupplierLocationCollectionTransfer())
                    ->addSupplierLocation($this->createSupplierLocationTransfer(21, 7, 'Berlin')),
            );

        $resource = (new SupplierLocationsBackendProvider($supplierFacade))->provide(new Get(), ['idSupplierLocation' => '21']);

        $this->assertInstanceOf(SupplierLocationsBackendResource::class, $resource);
        $this->assertSame(21, $resource->getIdSupplierLocation());
    }

    public function testItemIsNullWhenTheLocationDoesNotExist(): void
    {
        $supplierFacade = $this->createMock(SupplierFacadeInterface::class);
        $supplierFacade->method('getSupplierLocationCollection')->willReturn(new SupplierLocationCollectionTransfer());

        $resource = (new SupplierLocationsBackendProvider($supplierFacade))->provide(new Get(), ['idSupplierLocation' => '999999']);

        $this->assertNull($resource, 'Return null for an unknown id; API Platform turns it into a 404.');
    }

    protected function createSupplierLocationTransfer(int $idSupplierLocation, int $fkSupplier, string $city): SupplierLocationTransfer
    {
        return (new SupplierLocationTransfer())
            ->setIdSupplierLocation($idSupplierLocation)
            ->setFkSupplier($fkSupplier)
            ->setCity($city)
            ->setCountry('Germany')
            ->setAddress('Alexanderplatz 1')
            ->setZipCode('10178')
            ->setIsDefault(true);
    }
}
