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
        return (new SupplierMerchantPortalTableCriteriaTransfer())
            ->setMerchantReference(
                $this->merchantUserFacade
                    ->getCurrentMerchantUser()
                    ->getMerchantOrFail()
                    ->getMerchantReference(),
            );
    }

    /**
     * @param \Generated\Shared\Transfer\SupplierMerchantPortalTableCriteriaTransfer $criteriaTransfer
     *
     * @return \Generated\Shared\Transfer\GuiTableDataResponseTransfer
     */
    protected function fetchData(AbstractTransfer $criteriaTransfer): GuiTableDataResponseTransfer
    {
        /** @var \Generated\Shared\Transfer\SupplierMerchantPortalTableCriteriaTransfer $criteriaTransfer */
        return $this->repository->getSupplierTableData($criteriaTransfer);
    }
}
