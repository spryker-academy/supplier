<?php

declare(strict_types=1);

namespace SprykerAcademy\Zed\DataImport;

use Pyz\Zed\DataImport\DataImportDependencyProvider as PyzDataImportDependencyProvider;

class DataImportDependencyProvider extends PyzDataImportDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\DataImport\Dependency\Plugin\DataImportPluginInterface>
     */
    protected function getDataImporterPlugins(): array
    {
        $plugins = parent::getDataImporterPlugins();

        // TODO: Register SupplierDataImportPlugin and SupplierLocationDataImportPlugin

        return $plugins;
    }
}
