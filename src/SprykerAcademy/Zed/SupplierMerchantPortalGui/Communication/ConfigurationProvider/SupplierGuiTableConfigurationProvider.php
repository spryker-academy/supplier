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

        $guiTableConfigurationBuilder = $this->addColumns($guiTableConfigurationBuilder);
        $guiTableConfigurationBuilder = $this->addFilters($guiTableConfigurationBuilder);
        $guiTableConfigurationBuilder = $this->addRowActions($guiTableConfigurationBuilder);

        $guiTableConfigurationBuilder
            ->setDataSourceUrl(static::DATA_URL)
            ->setDefaultPageSize(25)
            ->isSearchEnabled(true)
            ->isColumnConfiguratorEnabled(true);

        return $guiTableConfigurationBuilder->createConfiguration();
    }

    /**
     * @param \Spryker\Shared\GuiTable\Configuration\Builder\GuiTableConfigurationBuilderInterface $guiTableConfigurationBuilder
     *
     * @return \Spryker\Shared\GuiTable\Configuration\Builder\GuiTableConfigurationBuilderInterface
     */
    protected function addColumns(
        GuiTableConfigurationBuilderInterface $guiTableConfigurationBuilder,
    ): GuiTableConfigurationBuilderInterface {
        $guiTableConfigurationBuilder
            ->addColumnText(static::COL_KEY_NAME, 'Name', true, true)
            ->addColumnText(static::COL_KEY_DESCRIPTION, 'Description', true, false)
            ->addColumnChip(static::COL_KEY_STATUS, 'Status', true, true, 'gray', [
                1 => [
                    'title' => 'Active',
                    'color' => 'green',
                ],
                0 => [
                    'title' => 'Inactive',
                    'color' => 'gray',
                ],
            ])
            ->addColumnText(static::COL_KEY_EMAIL, 'Email', true, true)
            ->addColumnText(static::COL_KEY_PHONE, 'Phone', true, false);

        return $guiTableConfigurationBuilder;
    }

    /**
     * @param \Spryker\Shared\GuiTable\Configuration\Builder\GuiTableConfigurationBuilderInterface $guiTableConfigurationBuilder
     *
     * @return \Spryker\Shared\GuiTable\Configuration\Builder\GuiTableConfigurationBuilderInterface
     */
    protected function addFilters(
        GuiTableConfigurationBuilderInterface $guiTableConfigurationBuilder,
    ): GuiTableConfigurationBuilderInterface {
        $guiTableConfigurationBuilder->addFilterSelect(
            'status',
            'Status',
            false,
            [
                1 => 'Active',
                0 => 'Inactive',
            ],
        );

        return $guiTableConfigurationBuilder;
    }

    /**
     * @param \Spryker\Shared\GuiTable\Configuration\Builder\GuiTableConfigurationBuilderInterface $guiTableConfigurationBuilder
     *
     * @return \Spryker\Shared\GuiTable\Configuration\Builder\GuiTableConfigurationBuilderInterface
     */
    protected function addRowActions(
        GuiTableConfigurationBuilderInterface $guiTableConfigurationBuilder,
    ): GuiTableConfigurationBuilderInterface {
        $guiTableConfigurationBuilder->addRowActionDrawerAjaxForm(
            'edit',
            'Edit',
            static::ROW_ACTION_URL_UPDATE,
        );

        return $guiTableConfigurationBuilder;
    }
}
