<?php

declare(strict_types=1);

namespace SprykerAcademy\Glue\Supplier\Processor\Mapper;

use Generated\Api\Backend\SuppliersBackendResource;
use Generated\Api\Storefront\SuppliersStorefrontResource;
use Generated\Shared\Transfer\SupplierTransfer;

class SupplierMapper
{
    public function mapSupplierTransferToSuppliersStorefrontResource(
        SupplierTransfer $supplierTransfer,
    ): SuppliersStorefrontResource {
        return SuppliersStorefrontResource::fromArray($supplierTransfer->toArray(false, true));
    }

    public function mapSupplierTransferToSuppliersBackendResource(
        SupplierTransfer $supplierTransfer,
    ): SuppliersBackendResource {
        return SuppliersBackendResource::fromArray($supplierTransfer->toArray(false, true));
    }
}
