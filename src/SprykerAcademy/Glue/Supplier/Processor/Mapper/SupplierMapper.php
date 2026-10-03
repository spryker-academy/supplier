<?php

declare(strict_types=1);

namespace SprykerAcademy\Glue\Supplier\Processor\Mapper;

use Generated\Api\Storefront\SupplierLocationsStorefrontResource;
use Generated\Api\Storefront\SuppliersStorefrontResource;
use Generated\Shared\Transfer\SupplierLocationTransfer;
use Generated\Shared\Transfer\SupplierTransfer;

class SupplierMapper
{
    public function mapSupplierTransferToSuppliersStorefrontResource(
        SupplierTransfer $supplierTransfer,
    ): SuppliersStorefrontResource {
        $supplierData = $supplierTransfer->toArray(false, true);

        // The `supplier-locations` include gives the resource a `supplierLocations` property of its own.
        // Glue fills it from the related resources when the client asks for the include - not the mapper.
        unset($supplierData[SupplierTransfer::SUPPLIER_LOCATIONS]);

        return SuppliersStorefrontResource::fromArray($supplierData);
    }

    public function mapSupplierLocationTransferToSupplierLocationsStorefrontResource(
        SupplierLocationTransfer $supplierLocationTransfer,
    ): SupplierLocationsStorefrontResource {
        $supplierLocationsStorefrontResource = SupplierLocationsStorefrontResource::fromArray(
            $supplierLocationTransfer->toArray(false, true),
        );

        // The API names the supplier `idSupplier`, as the suppliers resource does; the table column is fk_supplier
        $supplierLocationsStorefrontResource->idSupplier = $supplierLocationTransfer->getFkSupplier();

        return $supplierLocationsStorefrontResource;
    }
}
