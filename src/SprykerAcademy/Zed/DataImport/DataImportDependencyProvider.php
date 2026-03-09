<?php

declare(strict_types=1);

namespace SprykerAcademy\Zed\DataImport;

use Pyz\Zed\DataImport\DataImportDependencyProvider as PyzDataImportDependencyProvider;
use SprykerAcademy\Zed\SupplierDataImport\Communication\Plugin\DataImport\SupplierDataImportPlugin;
use SprykerAcademy\Zed\SupplierDataImport\Communication\Plugin\DataImport\SupplierLocationDataImportPlugin;

class DataImportDependencyProvider extends PyzDataImportDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\DataImport\Dependency\Plugin\DataImportPluginInterface>
     */
    protected function getDataImporterPlugins(): array
    {
        $plugins = parent::getDataImporterPlugins();

        $plugins[] = new SupplierDataImportPlugin();
        $plugins[] = new SupplierLocationDataImportPlugin();

        return $plugins;
    }
}

