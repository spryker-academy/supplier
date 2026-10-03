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
use Generated\Api\Backend\SuppliersBackendResource;
use Generated\Shared\Transfer\PaginationTransfer;
use Generated\Shared\Transfer\SupplierCollectionTransfer;
use Generated\Shared\Transfer\SupplierCriteriaTransfer;
use Generated\Shared\Transfer\SupplierTransfer;
use SprykerAcademy\Glue\Supplier\Api\Backend\Provider\SuppliersBackendProvider;
use SprykerAcademy\Zed\Supplier\Business\SupplierFacadeInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Exercise 12: the Backend API provider reads the suppliers from the database, through the Supplier
 * facade. Run `glue api:generate backend` first - it creates the resource class.
 */
class SuppliersBackendProviderTest extends Unit
{
    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();

        if (!class_exists(SuppliersBackendResource::class)) {
            $this->markTestSkipped('Generated\Api\Backend\SuppliersBackendResource is missing - run: docker/sdk cli GLUE_APPLICATION=GLUE_BACKEND glue api:generate backend');
        }
    }

    public function testCollectionAsksTheFacadeForTheRequestedPage(): void
    {
        $supplierFacade = $this->createMock(SupplierFacadeInterface::class);
        $supplierFacade->expects($this->once())
            ->method('getPaginatedSupplierCollection')
            ->with($this->callback(function (SupplierCriteriaTransfer $supplierCriteriaTransfer): bool {
                return $supplierCriteriaTransfer->getPagination() !== null
                    && $supplierCriteriaTransfer->getPagination()->getOffset() === 2
                    && $supplierCriteriaTransfer->getPagination()->getLimit() === 2;
            }))
            ->willReturn(
                (new SupplierCollectionTransfer())
                    ->addSupplier($this->createSupplierTransfer(7, 'Acme Supplies'))
                    ->addSupplier($this->createSupplierTransfer(8, 'TechSource Inc'))
                    ->setPagination((new PaginationTransfer())->setNbResults(5)),
            );

        $resources = (new SuppliersBackendProvider($supplierFacade))->provide(
            new GetCollection(),
            [],
            ['request' => Request::create('/suppliers?page[offset]=2&page[limit]=2')],
        );

        $this->assertIsArray($resources, 'Return a plain array: the include of the supplier locations only works on an array.');
        $this->assertCount(2, $resources);
        $this->assertInstanceOf(SuppliersBackendResource::class, $resources[0]);
        $this->assertSame(7, $resources[0]->getIdSupplier(), 'The mapper must fill idSupplier; API Platform builds the resource link from it.');
        $this->assertNotNull($resources[0]->pagination, 'Set the pagination on the first item: Glue builds the page links from it.');
        $this->assertSame(5, $resources[0]->pagination->numFound);
        $this->assertSame(2, $resources[0]->pagination->currentPage);
        $this->assertSame(3, $resources[0]->pagination->maxPage);
        $this->assertNull($resources[1]->pagination, 'Only the first item carries the pagination.');
    }

    public function testItemReturnsTheSupplierOfTheId(): void
    {
        $supplierFacade = $this->createMock(SupplierFacadeInterface::class);
        $supplierFacade->expects($this->once())
            ->method('findSupplierById')
            ->with(7)
            ->willReturn($this->createSupplierTransfer(7, 'Acme Supplies'));

        $resource = (new SuppliersBackendProvider($supplierFacade))->provide(new Get(), ['idSupplier' => '7']);

        $this->assertInstanceOf(SuppliersBackendResource::class, $resource);
        $this->assertSame(7, $resource->getIdSupplier());
        $this->assertSame('Acme Supplies', $resource->getName());
    }

    public function testItemIsNullWhenTheSupplierDoesNotExist(): void
    {
        $supplierFacade = $this->createMock(SupplierFacadeInterface::class);
        $supplierFacade->method('findSupplierById')->willReturn(null);

        $resource = (new SuppliersBackendProvider($supplierFacade))->provide(new Get(), ['idSupplier' => '999999']);

        $this->assertNull($resource, 'Return null for an unknown id; API Platform turns it into a 404.');
    }

    protected function createSupplierTransfer(int $idSupplier, string $name): SupplierTransfer
    {
        return (new SupplierTransfer())
            ->setIdSupplier($idSupplier)
            ->setName($name)
            ->setStatus(1)
            ->setEmail('contact@acme.test');
    }
}
