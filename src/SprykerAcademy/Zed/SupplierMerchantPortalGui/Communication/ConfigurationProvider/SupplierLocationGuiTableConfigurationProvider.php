<?php

declare(strict_types=1);

namespace SprykerAcademy\Zed\SupplierMerchantPortalGui\Communication\ConfigurationProvider;

use Generated\Shared\Transfer\GuiTableConfigurationTransfer;
use Generated\Shared\Transfer\GuiTableDataResponseTransfer;
use Generated\Shared\Transfer\GuiTableEditableButtonTransfer;
use Spryker\Shared\GuiTable\GuiTableFactoryInterface;

class SupplierLocationGuiTableConfigurationProvider
{
    /**
     * @var string
     */
    public const string COL_KEY_CITY = 'city';

    /**
     * @var string
     */
    public const string COL_KEY_COUNTRY = 'country';

    /**
     * @var string
     */
    public const string COL_KEY_ADDRESS = 'address';

    /**
     * @var string
     */
    public const string COL_KEY_ZIP_CODE = 'zipCode';

    /**
     * @var string
     */
    public const string COL_KEY_IS_DEFAULT = 'isDefault';

    /**
     * @var string
     */
    protected const string FORM_INPUT_NAME = 'supplierForm[locations]';

    public function __construct(
        protected GuiTableFactoryInterface $guiTableFactory,
    ) {
    }

    /**
     * @param \Generated\Shared\Transfer\GuiTableDataResponseTransfer $existingLocations The supplier's saved locations, listed read-only.
     * @param list<array<string, mixed>> $initialData New rows a failed submit sends back, so they are not lost.
     */
    public function getConfiguration(GuiTableDataResponseTransfer $existingLocations, array $initialData = []): GuiTableConfigurationTransfer
    {
        $guiTableConfigurationBuilder = $this->guiTableFactory->createConfigurationBuilder();

        $existingRows = [];
        foreach ($existingLocations->getRows() as $guiTableRowDataResponseTransfer) {
            $existingRows[] = $guiTableRowDataResponseTransfer->getResponseData();
        }
        $guiTableConfigurationBuilder->setDataSourceInlineData($existingRows);

        // A GuiTable needs at least one regular column. The editable inputs below are rendered on top of these columns.
        $guiTableConfigurationBuilder
            ->addColumnText(static::COL_KEY_CITY, 'City', false, false)
            ->addColumnText(static::COL_KEY_COUNTRY, 'Country', false, false)
            ->addColumnText(static::COL_KEY_ADDRESS, 'Address', false, false)
            ->addColumnText(static::COL_KEY_ZIP_CODE, 'Zip Code', false, false)
            ->addColumnText(static::COL_KEY_IS_DEFAULT, 'Default', false, false);

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
