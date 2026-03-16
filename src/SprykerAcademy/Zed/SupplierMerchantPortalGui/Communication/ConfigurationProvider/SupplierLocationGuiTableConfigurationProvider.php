<?php

declare(strict_types=1);

namespace SprykerAcademy\Zed\SupplierMerchantPortalGui\Communication\ConfigurationProvider;

use Generated\Shared\Transfer\GuiTableConfigurationTransfer;
use Generated\Shared\Transfer\GuiTableEditableButtonTransfer;
use Spryker\Shared\GuiTable\GuiTableFactoryInterface;

class SupplierLocationGuiTableConfigurationProvider
{
    /**
     * @var string
     */
    public const COL_KEY_CITY = 'city';

    /**
     * @var string
     */
    public const COL_KEY_COUNTRY = 'country';

    /**
     * @var string
     */
    public const COL_KEY_ADDRESS = 'address';

    /**
     * @var string
     */
    public const COL_KEY_ZIP_CODE = 'zipCode';

    /**
     * @var string
     */
    public const COL_KEY_IS_DEFAULT = 'isDefault';

    /**
     * @var string
     */
    protected const FORM_INPUT_NAME = 'supplierForm[locations]';

    public function __construct(
        protected GuiTableFactoryInterface $guiTableFactory,
    ) {
    }

    /**
     * @param array<mixed> $initialData
     *
     * @return \Generated\Shared\Transfer\GuiTableConfigurationTransfer
     */
    public function getConfiguration(array $initialData = []): GuiTableConfigurationTransfer
    {
        $guiTableConfigurationBuilder = $this->guiTableFactory->createConfigurationBuilder();

        $guiTableConfigurationBuilder
            ->addEditableColumnInput(static::COL_KEY_CITY, 'City', 'text')
            ->addEditableColumnInput(static::COL_KEY_COUNTRY, 'Country', 'text')
            ->addEditableColumnInput(static::COL_KEY_ADDRESS, 'Address', 'text')
            ->addEditableColumnInput(static::COL_KEY_ZIP_CODE, 'Zip Code', 'text')
            ->addEditableColumnInput(static::COL_KEY_IS_DEFAULT, 'Default', 'checkbox');

        $guiTableConfigurationBuilder->enableAddingNewRows(
            static::FORM_INPUT_NAME,
            $initialData,
            [
                GuiTableEditableButtonTransfer::TITLE => 'Add Location',
                GuiTableEditableButtonTransfer::VARIANT => 'outline',
            ],
            [
                GuiTableEditableButtonTransfer::TITLE => 'Cancel',
                GuiTableEditableButtonTransfer::VARIANT => 'outline',
            ],
        );

        return $guiTableConfigurationBuilder->createConfiguration();
    }
}
