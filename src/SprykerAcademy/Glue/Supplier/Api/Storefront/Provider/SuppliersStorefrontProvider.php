<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Glue\Supplier\Api\Storefront\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use Generated\Api\Storefront\SuppliersStorefrontResource;
use SprykerAcademy\Client\SupplierSearch\SupplierSearchClientInterface;
use SprykerAcademy\Glue\Supplier\Processor\Mapper\SupplierMapper;

/**
 * Serves GET /suppliers and GET /suppliers/{idSupplier} from Elasticsearch, through the
 * SupplierSearch client of exercise 11. API Platform builds the provider with Symfony's
 * dependency injection, so the client arrives through the constructor.
 */
class SuppliersStorefrontProvider implements ProviderInterface
{
    public function __construct(protected SupplierSearchClientInterface $supplierSearchClient)
    {
    }

    /**
     * @param \ApiPlatform\Metadata\Operation $operation
     * @param array<string, mixed> $uriVariables
     * @param array<string, mixed> $context
     *
     * @return array<\Generated\Api\Storefront\SuppliersStorefrontResource>|\Generated\Api\Storefront\SuppliersStorefrontResource|null
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $idSupplier = $uriVariables['idSupplier'] ?? null;

        if ($idSupplier === null) {
            return $this->provideCollection();
        }

        $supplierTransfer = $this->supplierSearchClient->findSupplierById((int)$idSupplier);

        // Not found: API Platform answers with 404
        if ($supplierTransfer->getIdSupplier() === null) {
            return null;
        }

        return (new SupplierMapper())->mapSupplierTransferToSuppliersStorefrontResource($supplierTransfer);
    }

    /**
     * @return array<\Generated\Api\Storefront\SuppliersStorefrontResource>
     */
    protected function provideCollection(): array
    {
        $supplierMapper = new SupplierMapper();
        $resources = [];

        foreach ($this->supplierSearchClient->searchSuppliers()->getSuppliers() as $supplierTransfer) {
            $resources[] = $supplierMapper->mapSupplierTransferToSuppliersStorefrontResource($supplierTransfer);
        }

        return $resources;
    }
}
