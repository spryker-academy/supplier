<?php

declare(strict_types=1);

namespace SprykerAcademy\Zed\SupplierMerchantPortalGui\Communication\DataProvider;

use Generated\Shared\Transfer\GuiTableDataRequestTransfer;
use Generated\Shared\Transfer\GuiTableDataResponseTransfer;
use Generated\Shared\Transfer\SupplierMerchantPortalTableCriteriaTransfer;
use Spryker\Shared\GuiTable\DataProvider\AbstractGuiTableDataProvider;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Zed\MerchantUser\Business\MerchantUserFacadeInterface;
use SprykerAcademy\Zed\SupplierMerchantPortalGui\Persistence\SupplierMerchantPortalGuiRepositoryInterface;

class SupplierGuiTableDataProvider extends AbstractGuiTableDataProvider
{
    public function __construct(
        protected MerchantUserFacadeInterface $merchantUserFacade,
        protected SupplierMerchantPortalGuiRepositoryInterface $repository,
    ) {
    }

    /**
     * @param \Generated\Shared\Transfer\GuiTableDataRequestTransfer $guiTableDataRequestTransfer
     *
     * @return \Spryker\Shared\Kernel\Transfer\AbstractTransfer
     */
    protected function createCriteria(GuiTableDataRequestTransfer $guiTableDataRequestTransfer): AbstractTransfer
    {
        // TODO: Create SupplierMerchantPortalTableCriteriaTransfer with merchantReference
        // Hint: Get the current merchant reference from:
        //   $this->merchantUserFacade->getCurrentMerchantUser()->getMerchantOrFail()->getMerchantReference()

        return new SupplierMerchantPortalTableCriteriaTransfer();
    }

    /**
     * @param \Generated\Shared\Transfer\SupplierMerchantPortalTableCriteriaTransfer $criteriaTransfer
     *
     * @return \Generated\Shared\Transfer\GuiTableDataResponseTransfer
     */
    protected function fetchData(AbstractTransfer $criteriaTransfer): GuiTableDataResponseTransfer
    {
        // TODO: Delegate to repository to fetch supplier table data
        // Hint: return $this->repository->getSupplierTableData($criteriaTransfer);

        return new GuiTableDataResponseTransfer();
    }
}
