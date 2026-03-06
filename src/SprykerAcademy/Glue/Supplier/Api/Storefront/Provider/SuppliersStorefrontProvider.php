<?php

declare(strict_types = 1);

namespace SprykerAcademy\Glue\Supplier\Api\Storefront\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use Generated\Shared\Transfer\SupplierTransfer;
use SprykerAcademy\Client\Supplier\SupplierClientInterface;
use SprykerAcademy\Glue\Supplier\Processor\Mapper\SupplierMapper;

/**
 * @implements \ApiPlatform\State\ProviderInterface<object>
 */
class SuppliersStorefrontProvider implements ProviderInterface
{
    // TODO-1: Inject the SupplierClientInterface via constructor.
    // Hint-1: The Storefront API uses the Client layer to access data (not the Facade).
    // Hint-2: API Platform auto-wires constructor dependencies, so just type-hint the interface.
    public function __construct()
    {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        // TODO-2: Read the supplier identifier from uri variables.
        // Hint-1: Use the resource identifier key from `suppliers.resource.yml` (e.g., 'idSupplier').
        $idSupplier = $uriVariables['idSupplier'] ?? null;

        if ($idSupplier === null) {
            // TODO-3: Return a supplier collection.
            // Hint-1: Use $this->supplierClient->getSuppliers() to load all suppliers.
            // Hint-2: Loop through the collection and map each SupplierTransfer to a resource using SupplierMapper.
            return [];
        }

        if (!is_numeric($idSupplier)) {
            return null;
        }

        // TODO-4: Load the supplier by identifier.
        // Hint-1: Use $this->supplierClient->findSupplierById((int)$idSupplier).
        $supplierTransfer = null;

        if (!$supplierTransfer instanceof SupplierTransfer || $supplierTransfer->getIdSupplier() === null) {
            return null;
        }

        // TODO-5: Return a mapped API Platform resource.
        // Hint-1: Use (new SupplierMapper())->mapSupplierTransferToSuppliersStorefrontResource($supplierTransfer).
        return null;
    }
}
