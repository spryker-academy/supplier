<?php

declare(strict_types=1);

namespace SprykerAcademy\Zed\SupplierMerchantPortalGui\Communication\ConfigurationProvider;

use Generated\Shared\Transfer\GuiTableConfigurationTransfer;
use Spryker\Shared\GuiTable\Configuration\Builder\GuiTableConfigurationBuilderInterface;
use Spryker\Shared\GuiTable\GuiTableFactoryInterface;

class SupplierGuiTableConfigurationProvider
{
    /**
     * @var string
     */
    public const COL_KEY_ID_SUPPLIER = 'idSupplier';

    /**
     * @var string
     */
    public const COL_KEY_NAME = 'name';

    /**
     * @var string
     */
    public const COL_KEY_DESCRIPTION = 'description';

    /**
     * @var string
     */
    public const COL_KEY_STATUS = 'status';

    /**
     * @var string
     */
    public const COL_KEY_EMAIL = 'email';

    /**
     * @var string
     */
    public const COL_KEY_PHONE = 'phone';

    /**
     * @var string
     */
    protected const DATA_URL = '/supplier-merchant-portal-gui/supplier/table-data';

    /**
     * @var string
     */
    protected const ROW_ACTION_URL_UPDATE = '/supplier-merchant-portal-gui/update-supplier?id-supplier=${row.idSupplier}';

    public function __construct(
        protected GuiTableFactoryInterface $guiTableFactory,
    ) {
    }

    /**
     * @return \Generated\Shared\Transfer\GuiTableConfigurationTransfer
     */
    public function getConfiguration(): GuiTableConfigurationTransfer
    {
        $guiTableConfigurationBuilder = $this->guiTableFactory->createConfigurationBuilder();

        // TODO: Add columns using $guiTableConfigurationBuilder->addColumnText(), addColumnChip(), etc.
        // Hint: Use COL_KEY_* constants as column IDs
        // Hint: For status, use addColumnChip() with color map: 1 => green/Active, 0 => gray/Inactive

        // TODO: Add filters using $guiTableConfigurationBuilder->addFilterSelect()
        // Hint: Filter by status with options 1 => Active, 0 => Inactive

        // TODO: Add row actions using $guiTableConfigurationBuilder->addRowActionDrawerAjaxForm()
        // Hint: Use ROW_ACTION_URL_UPDATE constant

        // TODO: Set data source URL, page size, enable search
        // Hint: $guiTableConfigurationBuilder->setDataSourceUrl(static::DATA_URL)->setDefaultPageSize(25)->isSearchEnabled(true)

        return $guiTableConfigurationBuilder->createConfiguration();
    }
}
