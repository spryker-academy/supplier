<?php

declare(strict_types=1);

namespace SprykerAcademy\Zed\SupplierMerchantPortalGui\Persistence;

use Generated\Shared\Transfer\GuiTableDataResponseTransfer;
use Generated\Shared\Transfer\SupplierMerchantPortalTableCriteriaTransfer;

interface SupplierMerchantPortalGuiRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\SupplierMerchantPortalTableCriteriaTransfer $criteriaTransfer
     *
     * @return \Generated\Shared\Transfer\GuiTableDataResponseTransfer
     */
    public function getSupplierTableData(
        SupplierMerchantPortalTableCriteriaTransfer $criteriaTransfer,
    ): GuiTableDataResponseTransfer;
}
