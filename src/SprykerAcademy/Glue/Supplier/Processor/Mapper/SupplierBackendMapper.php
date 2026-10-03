<?php

declare(strict_types=1);

namespace SprykerAcademy\Glue\Supplier\Processor\Mapper;

use Generated\Api\Backend\SupplierLocationsBackendResource;
use Generated\Api\Backend\SuppliersBackendResource;
use Generated\Shared\Transfer\SupplierLocationTransfer;
use Generated\Shared\Transfer\SupplierTransfer;

class SupplierBackendMapper
{
    public function mapSupplierTransferToSuppliersBackendResource(
        SupplierTransfer $supplierTransfer,
    ): SuppliersBackendResource {
        return SuppliersBackendResource::fromArray($supplierTransfer->toArray(false, true));
    }

    public function mapSupplierLocationTransferToSupplierLocationsBackendResource(
        SupplierLocationTransfer $supplierLocationTransfer,
    ): SupplierLocationsBackendResource {
        $supplierLocationsBackendResource = SupplierLocationsBackendResource::fromArray(
            $supplierLocationTransfer->toArray(false, true),
        );

        // The API names the supplier `idSupplier`, as the suppliers resource does; the table column is fk_supplier
        $supplierLocationsBackendResource->idSupplier = $supplierLocationTransfer->getFkSupplier();

        return $supplierLocationsBackendResource;
    }
}
