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
        return SuppliersStorefrontResource::fromArray($supplierTransfer->toArray(false, true));
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
