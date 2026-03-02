<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerAcademy\Zed\SupplierDataImport\Communication\Plugin\DataImport;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReportTransfer;
use Override;
use Spryker\Zed\DataImport\Dependency\Plugin\DataImportPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use SprykerAcademy\Zed\SupplierDataImport\SupplierDataImportConfig;

/**
 * @method \SprykerAcademy\Zed\SupplierDataImport\Business\SupplierDataImportFacadeInterface getFacade()
 * @method \SprykerAcademy\Zed\SupplierDataImport\SupplierDataImportConfig getConfig()
 */
class SupplierDataImportPlugin extends AbstractPlugin implements DataImportPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\DataImporterConfigurationTransfer|null $dataImporterConfigurationTransfer
     *
     * @return \Generated\Shared\Transfer\DataImporterReportTransfer
     */
    #[Override]
    public function import(
        ?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null,
    ): DataImporterReportTransfer {
        // TODO: Use $this->getFacade() to call the import method and return its result
        // Hint: The facade has an importSupplier() method that accepts the configuration transfer

        return new DataImporterReportTransfer();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    #[Override]
    public function getImportType(): string
    {
        // TODO: Return the import type constant from SupplierDataImportConfig

        return '';
    }
}
