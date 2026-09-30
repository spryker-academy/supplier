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
use Generated\Api\Storefront\SuppliersStorefrontResource;
use Generated\Shared\Transfer\SupplierCollectionTransfer;
use Generated\Shared\Transfer\SupplierTransfer;
use SprykerAcademy\Client\SupplierSearch\SupplierSearchClientInterface;
use SprykerAcademy\Glue\Supplier\Api\Storefront\Provider\SuppliersStorefrontProvider;

/**
 * Exercise 12: the provider reads the suppliers through the SupplierSearch client and maps them to
 * the generated API resource. Run `glue api:generate` first - it creates the resource class.
 */
class SuppliersStorefrontProviderTest extends Unit
{
    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();

        if (!class_exists(SuppliersStorefrontResource::class)) {
            $this->markTestSkipped('Generated\Api\Storefront\SuppliersStorefrontResource is missing - run: docker/sdk cli GLUE_APPLICATION=GLUE glue api:generate storefront');
        }
    }

    public function testCollectionMapsEverySupplierWithItsId(): void
    {
        $supplierSearchClient = $this->createMock(SupplierSearchClientInterface::class);
        $supplierSearchClient->method('searchSuppliers')->willReturn(
            (new SupplierCollectionTransfer())
                ->addSupplier($this->createSupplierTransfer(7, 'Acme Supplies'))
                ->addSupplier($this->createSupplierTransfer(8, 'TechSource Inc')),
        );

        $resources = (new SuppliersStorefrontProvider($supplierSearchClient))->provide(new GetCollection());

        $this->assertIsArray($resources);
        $this->assertCount(2, $resources);
        $this->assertInstanceOf(SuppliersStorefrontResource::class, $resources[0]);
        $this->assertSame(7, $resources[0]->getIdSupplier(), 'The mapper must fill idSupplier; API Platform builds the resource link from it.');
        $this->assertSame('Acme Supplies', $resources[0]->getName());
        $this->assertSame('contact@acme.test', $resources[0]->getEmail());
    }

    public function testItemReturnsTheSupplierOfTheId(): void
    {
        $supplierSearchClient = $this->createMock(SupplierSearchClientInterface::class);
        $supplierSearchClient->expects($this->once())
            ->method('findSupplierById')
            ->with(7)
            ->willReturn($this->createSupplierTransfer(7, 'Acme Supplies'));

        $resource = (new SuppliersStorefrontProvider($supplierSearchClient))->provide(new Get(), ['idSupplier' => '7']);

        $this->assertInstanceOf(SuppliersStorefrontResource::class, $resource);
        $this->assertSame(7, $resource->getIdSupplier());
        $this->assertSame(1, $resource->getStatus());
    }

    public function testItemIsNullWhenTheSupplierDoesNotExist(): void
    {
        $supplierSearchClient = $this->createMock(SupplierSearchClientInterface::class);
        $supplierSearchClient->method('findSupplierById')->willReturn(new SupplierTransfer());

        $resource = (new SuppliersStorefrontProvider($supplierSearchClient))->provide(new Get(), ['idSupplier' => '999999']);

        $this->assertNull($resource, 'Return null for an unknown id; API Platform turns it into a 404.');
    }

    protected function createSupplierTransfer(int $idSupplier, string $name): SupplierTransfer
    {
        return (new SupplierTransfer())
            ->setIdSupplier($idSupplier)
            ->setName($name)
            ->setDescription('supplier description')
            ->setStatus(1)
            ->setEmail('contact@acme.test')
            ->setPhone('+1-555-0000');
    }
}
