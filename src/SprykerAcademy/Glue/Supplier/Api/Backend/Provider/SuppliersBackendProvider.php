<?php

declare(strict_types = 1);

namespace SprykerAcademy\Glue\Supplier\Api\Backend\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use Generated\Shared\Transfer\SupplierTransfer;
use SprykerAcademy\Glue\Supplier\Processor\Mapper\SupplierMapper;
use SprykerAcademy\Zed\Supplier\Business\SupplierFacadeInterface;

/**
 * @implements \ApiPlatform\State\ProviderInterface<object>
 */
class SuppliersBackendProvider implements ProviderInterface
{
    // TODO-1: Inject the SupplierFacadeInterface via constructor.
    // Hint-1: The Backend API runs on Zed, so it uses the Facade directly (not the Client).
    // Hint-2: API Platform auto-wires constructor dependencies.
    public function __construct()
    {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        // TODO-2: Read the supplier identifier from uri variables.
        $idSupplier = $uriVariables['idSupplier'] ?? null;

        if ($idSupplier === null) {
            // TODO-3: Return a supplier collection.
            // Hint-1: Use $this->supplierFacade->getSuppliers() to load all suppliers.
            // Hint-2: Loop through the collection and map each SupplierTransfer to a resource using SupplierMapper.
            return [];
        }

        if (!is_numeric($idSupplier)) {
            return null;
        }

        // TODO-4: Load the supplier by identifier.
        // Hint-1: Use $this->supplierFacade->findSupplierById((int)$idSupplier).
        $supplierTransfer = null;

        if (!$supplierTransfer instanceof SupplierTransfer || $supplierTransfer->getIdSupplier() === null) {
            return null;
        }

        // TODO-5: Return a mapped API Platform resource.
        // Hint-1: Use (new SupplierMapper())->mapSupplierTransferToSuppliersBackendResource($supplierTransfer).
        return null;
    }
}
