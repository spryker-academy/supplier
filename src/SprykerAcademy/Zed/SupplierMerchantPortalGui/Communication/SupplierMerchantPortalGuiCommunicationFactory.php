<?php

declare(strict_types=1);

namespace SprykerAcademy\Zed\SupplierMerchantPortalGui\Communication;

use Spryker\Shared\GuiTable\GuiTableFactoryInterface;
use Spryker\Shared\GuiTable\Http\GuiTableDataRequestExecutorInterface;
use Spryker\Shared\ZedUi\ZedUiFactoryInterface;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Spryker\Zed\MerchantUser\Business\MerchantUserFacadeInterface;
use SprykerAcademy\Zed\Supplier\Business\SupplierFacadeInterface;
use SprykerAcademy\Zed\SupplierMerchantPortalGui\Communication\ConfigurationProvider\SupplierGuiTableConfigurationProvider;
use SprykerAcademy\Zed\SupplierMerchantPortalGui\Communication\DataProvider\SupplierGuiTableDataProvider;
use SprykerAcademy\Zed\SupplierMerchantPortalGui\SupplierMerchantPortalGuiDependencyProvider;

/**
 * @method \SprykerAcademy\Zed\SupplierMerchantPortalGui\Persistence\SupplierMerchantPortalGuiRepositoryInterface getRepository()
 * @method \SprykerAcademy\Zed\SupplierMerchantPortalGui\SupplierMerchantPortalGuiDependencyProvider getConfig()
 */
class SupplierMerchantPortalGuiCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \SprykerAcademy\Zed\SupplierMerchantPortalGui\Communication\ConfigurationProvider\SupplierGuiTableConfigurationProvider
     */
    public function createSupplierGuiTableConfigurationProvider(): SupplierGuiTableConfigurationProvider
    {
        return new SupplierGuiTableConfigurationProvider(
            $this->getGuiTableFactory(),
        );
    }

    /**
     * @return \SprykerAcademy\Zed\SupplierMerchantPortalGui\Communication\DataProvider\SupplierGuiTableDataProvider
     */
    public function createSupplierGuiTableDataProvider(): SupplierGuiTableDataProvider
    {
        return new SupplierGuiTableDataProvider(
            $this->getMerchantUserFacade(),
            $this->getRepository(),
        );
    }

    /**
     * @return \Spryker\Shared\GuiTable\Http\GuiTableDataRequestExecutorInterface
     */
    public function getGuiTableHttpDataRequestExecutor(): GuiTableDataRequestExecutorInterface
    {
        return $this->getProvidedDependency(SupplierMerchantPortalGuiDependencyProvider::SERVICE_GUI_TABLE_HTTP_DATA_REQUEST_EXECUTOR);
    }

    /**
     * @return \Spryker\Shared\GuiTable\GuiTableFactoryInterface
     */
    public function getGuiTableFactory(): GuiTableFactoryInterface
    {
        return $this->getProvidedDependency(SupplierMerchantPortalGuiDependencyProvider::SERVICE_GUI_TABLE_FACTORY);
    }

    /**
     * @return \Spryker\Shared\ZedUi\ZedUiFactoryInterface
     */
    public function getZedUiFactory(): ZedUiFactoryInterface
    {
        return $this->getProvidedDependency(SupplierMerchantPortalGuiDependencyProvider::SERVICE_ZED_UI_FACTORY);
    }

    /**
     * @return \Spryker\Zed\MerchantUser\Business\MerchantUserFacadeInterface
     */
    public function getMerchantUserFacade(): MerchantUserFacadeInterface
    {
        return $this->getProvidedDependency(SupplierMerchantPortalGuiDependencyProvider::FACADE_MERCHANT_USER);
    }

    /**
     * @return \SprykerAcademy\Zed\Supplier\Business\SupplierFacadeInterface
     */
    public function getSupplierFacade(): SupplierFacadeInterface
    {
        return $this->getProvidedDependency(SupplierMerchantPortalGuiDependencyProvider::FACADE_SUPPLIER);
    }
}
