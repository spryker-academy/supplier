<?php

declare(strict_types=1);

namespace SprykerAcademy\Glue\Supplier\Api\Storefront\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use Generated\Api\Storefront\SuppliersStorefrontResource;
use SprykerAcademy\Client\SupplierStorage\SupplierStorageClientInterface;

/**
 * Provides supplier data from Redis storage instead of directly from database.
 * This demonstrates the read path using the Storage layer (Redis).
 *
 * @implements \ApiPlatform\State\ProviderInterface<\Generated\Api\Storefront\SuppliersStorefrontResource>
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
     *
     * TODO: Implement this method to read from Redis using SupplierStorageClient
     * Hint: Use $this->supplierStorageClient->findSupplierStorageData($idSupplier)
     * Hint: Return null if supplier not found in Redis
     * Hint: Use mapStorageDataToResource() to convert data to API resource
     */
    protected function provideItem(int $idSupplier): ?SuppliersStorefrontResource
    {
        // TODO: Get supplier data from Redis
        // TODO: Return null if not found
        // TODO: Map data to resource and return

        return null;
    }

    /**
     * Get all suppliers from Redis.
     *
     * TODO: Implement this method to read all suppliers from Redis
     * Hint: Use $this->supplierStorageClient->getAllSuppliers()
     * Hint: Map each supplier data to a resource
     *
     * @return array<\Generated\Api\Storefront\SuppliersStorefrontResource>
     */
    protected function provideCollection(): array
    {
        // TODO: Get all suppliers from Redis
        // TODO: Map each to a resource
        // TODO: Return array of resources

        return [];
    }

    /**
     * Map Redis storage data to API resource.
     *
     * TODO: Implement this method to map storage data to API resource
     * Hint: Create new SuppliersStorefrontResource()
     * Hint: Set properties from $data array (id_supplier, name, description, etc.)
     *
     * @param array<string, mixed> $data
     */
    protected function mapStorageDataToResource(array $data): SuppliersStorefrontResource
    {
        // TODO: Create resource object
        // TODO: Map data fields to resource properties
        // TODO: Return resource

        return new SuppliersStorefrontResource();
    }
}
