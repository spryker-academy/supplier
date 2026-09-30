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
        // TODO-1: Read the supplier id from $uriVariables. The key is the property marked `identifier: true`
        //         in suppliers.resource.yml.
        // TODO-2: No id means a collection request (GET /suppliers): load the suppliers with
        //         $this->supplierSearchClient->searchSuppliers(), map every SupplierTransfer of
        //         getSuppliers() to a resource and return the array.
        // TODO-3: With an id (GET /suppliers/{idSupplier}): load the supplier with
        //         $this->supplierSearchClient->findSupplierById((int)$idSupplier).
        // TODO-4: The client returns an empty SupplierTransfer when the id is unknown - return null then,
        //         API Platform answers with a 404.
        // TODO-5: Map the SupplierTransfer to a SuppliersStorefrontResource with the provided SupplierMapper.

        return null;
    }
}
