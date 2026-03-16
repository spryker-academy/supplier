<?php

declare(strict_types=1);

namespace SprykerAcademy\Zed\SupplierMerchantPortalGui\Communication\DataProvider;

use Generated\Shared\Transfer\GuiTableDataResponseTransfer;
use Orm\Zed\SupplierLocation\Persistence\PyzSupplierLocationQuery;

class SupplierLocationGuiTableDataProvider
{
    /**
     * @param int $idSupplier
     *
     * @return \Generated\Shared\Transfer\GuiTableDataResponseTransfer
     */
    public function getData(int $idSupplier): GuiTableDataResponseTransfer
    {
        // TODO: Query PyzSupplierLocationQuery filtered by fkSupplier
        // TODO: Map results to GuiTableDataResponseTransfer with rows containing:
        //       idSupplierLocation, city, country, address, zipCode, isDefault

        return new GuiTableDataResponseTransfer();
    }
}
