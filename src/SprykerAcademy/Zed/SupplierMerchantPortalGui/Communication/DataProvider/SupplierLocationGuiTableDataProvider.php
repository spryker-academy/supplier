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
        $locationEntities = PyzSupplierLocationQuery::create()
            ->filterByFkSupplier($idSupplier)
            ->find();

        $guiTableDataResponseTransfer = new GuiTableDataResponseTransfer();
        $guiTableDataResponseTransfer->setTotal($locationEntities->count());
        $guiTableDataResponseTransfer->setPage(1);
        $guiTableDataResponseTransfer->setPageSize($locationEntities->count() ?: 10);

        foreach ($locationEntities as $locationEntity) {
            $rowData = [
                'idSupplierLocation' => $locationEntity->getIdSupplierLocation(),
                'city' => $locationEntity->getCity(),
                'country' => $locationEntity->getCountry(),
                'address' => $locationEntity->getAddress(),
                'zipCode' => $locationEntity->getZipCode(),
                'isDefault' => $locationEntity->getIsDefault(),
            ];

            $guiTableDataResponseTransfer->addRow(
                (new GuiTableRowDataResponseTransfer())->setResponseData($rowData),
            );
        }

        return $guiTableDataResponseTransfer;
    }
}
