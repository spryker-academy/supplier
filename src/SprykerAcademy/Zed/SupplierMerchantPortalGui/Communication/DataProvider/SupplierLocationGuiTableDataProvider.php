<?php

declare(strict_types=1);

namespace SprykerAcademy\Zed\SupplierMerchantPortalGui\Communication\DataProvider;

use Generated\Shared\Transfer\GuiTableDataResponseTransfer;
use Generated\Shared\Transfer\GuiTableRowDataResponseTransfer;
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
        // TODO: Load the locations of the supplier and return them as table rows:
        //       1. PyzSupplierLocationQuery::create()->filterByFkSupplier($idSupplier)->find()
        //       2. For every entity add a GuiTableRowDataResponseTransfer whose response data has the keys
        //          idSupplierLocation, city, country, address, zipCode and isDefault
        //       3. Set total, page (1) and page size on the GuiTableDataResponseTransfer

        return new GuiTableDataResponseTransfer();
    }
}
