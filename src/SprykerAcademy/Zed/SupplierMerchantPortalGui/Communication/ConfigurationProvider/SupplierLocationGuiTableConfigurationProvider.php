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

        // TODO: Add editable columns using $guiTableConfigurationBuilder->addEditableColumnInput()
        // Hint: COL_KEY_CITY => 'City', type 'text'
        // Hint: COL_KEY_COUNTRY => 'Country', type 'text'
        // Hint: COL_KEY_ADDRESS => 'Address', type 'text'
        // Hint: COL_KEY_ZIP_CODE => 'Zip Code', type 'text'
        // Hint: COL_KEY_IS_DEFAULT => 'Default', type 'checkbox'

        // TODO: Enable adding new rows using $guiTableConfigurationBuilder->enableAddingNewRows()
        // Hint: Pass FORM_INPUT_NAME, $initialData, and button configs for Add/Cancel

        return $guiTableConfigurationBuilder->createConfiguration();
    }
}
