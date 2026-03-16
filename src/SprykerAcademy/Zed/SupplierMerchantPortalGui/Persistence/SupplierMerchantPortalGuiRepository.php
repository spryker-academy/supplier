<?php

declare(strict_types=1);

namespace SprykerAcademy\Zed\SupplierMerchantPortalGui\Persistence;

use Generated\Shared\Transfer\GuiTableDataResponseTransfer;
use Generated\Shared\Transfer\SupplierMerchantPortalTableCriteriaTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \SprykerAcademy\Zed\SupplierMerchantPortalGui\Persistence\SupplierMerchantPortalGuiPersistenceFactory getFactory()
 */
class SupplierMerchantPortalGuiRepository extends AbstractRepository implements SupplierMerchantPortalGuiRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\SupplierMerchantPortalTableCriteriaTransfer $criteriaTransfer
     *
     * @return \Generated\Shared\Transfer\GuiTableDataResponseTransfer
     */
    public function getSupplierTableData(
        SupplierMerchantPortalTableCriteriaTransfer $criteriaTransfer,
    ): GuiTableDataResponseTransfer {
        // TODO: Build a Propel query that:
        // 1. Gets PyzSupplierQuery from the factory
        // 2. Joins with PyzMerchantToSupplier and filters by merchant reference
        // 3. Applies search term filter on name/description/email
        // 4. Applies status filter if set
        // 5. Counts total before pagination
        // 6. Applies sorting and pagination
        // 7. Maps results to GuiTableDataResponseTransfer with GuiTableRowDataResponseTransfer rows
        //
        // Hint: Use usePyzMerchantToSupplierQuery()->useSpyMerchantQuery()->filterByMerchantReference()->endUse()->endUse()
        // Hint: Each row needs: idSupplier, name, description, status, email, phone

        return new GuiTableDataResponseTransfer();
    }
}
