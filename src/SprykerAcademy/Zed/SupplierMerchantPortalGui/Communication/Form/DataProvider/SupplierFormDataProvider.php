<?php

declare(strict_types=1);

namespace SprykerAcademy\Zed\SupplierMerchantPortalGui\Communication\Form\DataProvider;

use Generated\Shared\Transfer\SupplierTransfer;
use SprykerAcademy\Zed\Supplier\Business\SupplierFacadeInterface;

class SupplierFormDataProvider
{
    public function __construct(
        protected SupplierFacadeInterface $supplierFacade,
    ) {
    }

    /**
     * @param int|null $idSupplier
     *
     * @return \Generated\Shared\Transfer\SupplierTransfer
     */
    public function getData(?int $idSupplier = null): SupplierTransfer
    {
        if ($idSupplier === null) {
            return (new SupplierTransfer())->setStatus(1);
        }

        $supplierTransfer = $this->supplierFacade->findSupplierById($idSupplier);

        return $supplierTransfer ?? (new SupplierTransfer())->setStatus(1);
    }

    /**
     * @return array<string, mixed>
     */
    public function getOptions(): array
    {
        return [];
    }
}
