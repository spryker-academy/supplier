<?php

declare(strict_types=1);

namespace SprykerAcademy\Glue\Supplier\Api\Storefront\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use Generated\Api\Storefront\SuppliersstorageStorefrontResource;
use SprykerAcademy\Client\SupplierStorage\SupplierStorageClientInterface;

/**
 * Provides supplier data from Redis storage for both single items and collections.
 *
 * @implements \ApiPlatform\State\ProviderInterface<\Generated\Api\Storefront\SuppliersstorageStorefrontResource>
 */
class SuppliersStorageStorefrontProvider implements ProviderInterface
{
    public function __construct(
        protected SupplierStorageClientInterface $supplierStorageClient,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $idSupplier = $uriVariables['idSupplier'] ?? null;

        if ($idSupplier === null) {
            return $this->provideCollection();
        }

        if (!is_numeric($idSupplier)) {
            return null;
        }

        return $this->provideItem((int)$idSupplier);
    }

    /**
     * Get a single supplier from Redis by ID.
     */
    protected function provideItem(int $idSupplier): ?SuppliersstorageStorefrontResource
    {
        $supplierData = $this->supplierStorageClient->findSupplierStorageData($idSupplier);

        if ($supplierData === null) {
            return null;
        }

        return $this->mapStorageDataToResource($supplierData);
    }

    /**
     * @return array<\Generated\Api\Storefront\SuppliersstorageStorefrontResource>
     */
    protected function provideCollection(): array
    {
        $resources = [];
        foreach ($this->supplierStorageClient->getAllSuppliers() as $supplierData) {
            $resources[] = $this->mapStorageDataToResource($supplierData);
        }

        return $resources;
    }

    /**
     * Map Redis storage data to API resource.
     *
     * @param array<string, mixed> $data
     */
    protected function mapStorageDataToResource(array $data): SuppliersstorageStorefrontResource
    {
        $resource = new SuppliersstorageStorefrontResource();
        $resource->idSupplier = $data['id_supplier'] ?? null;
        $resource->name = $data['name'] ?? null;
        $resource->description = $data['description'] ?? null;
        $resource->status = $data['status'] ?? null;
        $resource->email = $data['email'] ?? null;
        $resource->phone = $data['phone'] ?? null;

        return $resource;
    }
}
