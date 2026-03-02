<?php

declare(strict_types=1);

namespace SprykerAcademyTest\Zed\Supplier\DataImport;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReportTransfer;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSet;
use Spryker\Zed\DataImport\Dependency\Plugin\DataImportPluginInterface;
use SprykerAcademy\Zed\SupplierDataImport\Business\DataImportStep\DescriptionToLowercaseStep;
use SprykerAcademy\Zed\SupplierDataImport\Business\DataImportStep\SupplierWriterStep;
use SprykerAcademy\Zed\SupplierDataImport\Business\DataSet\SupplierDataSetInterface;
use SprykerAcademy\Zed\SupplierDataImport\Business\DataSet\SupplierLocationDataSetInterface;
use SprykerAcademy\Zed\SupplierDataImport\Business\SupplierDataImportBusinessFactory;
use SprykerAcademy\Zed\SupplierDataImport\Business\SupplierDataImportFacade;
use SprykerAcademy\Zed\SupplierDataImport\Business\SupplierDataImportFacadeInterface;
use SprykerAcademy\Zed\SupplierDataImport\Communication\Plugin\DataImport\SupplierDataImportPlugin;
use SprykerAcademy\Zed\SupplierDataImport\Communication\Plugin\DataImport\SupplierLocationDataImportPlugin;
use SprykerAcademy\Zed\SupplierDataImport\SupplierDataImportConfig;

/**
 * Structural and unit tests for the SupplierDataImport module.
 * No Spryker kernel or database required.
 *
 * Run: vendor/bin/codecept run -c tests/SprykerAcademyTest/Zed/Supplier/ DataImport
 */
class SupplierDataImportStructuralTest extends Unit
{
    // --- DataSet Constants ---

    public function testSupplierDataSetInterfaceHasRequiredConstants(): void
    {
        $this->assertTrue(defined(SupplierDataSetInterface::class . '::COLUMN_NAME'));
        $this->assertTrue(defined(SupplierDataSetInterface::class . '::COLUMN_DESCRIPTION'));
        $this->assertTrue(defined(SupplierDataSetInterface::class . '::COLUMN_STATUS'));
        $this->assertTrue(defined(SupplierDataSetInterface::class . '::COLUMN_EMAIL'));
        $this->assertTrue(defined(SupplierDataSetInterface::class . '::COLUMN_PHONE'));
    }

    public function testSupplierColumnNameMatchesCsvHeader(): void
    {
        $this->assertSame(
            'name',
            SupplierDataSetInterface::COLUMN_NAME,
            'COLUMN_NAME must match the CSV header "name".',
        );
    }

    public function testSupplierLocationDataSetInterfaceHasRequiredConstants(): void
    {
        $this->assertTrue(defined(SupplierLocationDataSetInterface::class . '::COLUMN_SUPPLIER_NAME'));
        $this->assertTrue(defined(SupplierLocationDataSetInterface::class . '::COLUMN_CITY'));
        $this->assertTrue(defined(SupplierLocationDataSetInterface::class . '::COLUMN_COUNTRY'));
        $this->assertTrue(defined(SupplierLocationDataSetInterface::class . '::COLUMN_ADDRESS'));
        $this->assertTrue(defined(SupplierLocationDataSetInterface::class . '::COLUMN_ZIP_CODE'));
        $this->assertTrue(defined(SupplierLocationDataSetInterface::class . '::COLUMN_IS_DEFAULT'));
    }

    // --- Config ---

    public function testImportTypeConstantsExist(): void
    {
        $this->assertSame('supplier', SupplierDataImportConfig::IMPORT_TYPE_SUPPLIER);
        $this->assertSame('supplier-location', SupplierDataImportConfig::IMPORT_TYPE_SUPPLIER_LOCATION);
    }

    // --- Step Classes ---

    public function testDescriptionToLowercaseStepImplementsInterface(): void
    {
        $step = new DescriptionToLowercaseStep();

        $this->assertInstanceOf(DataImportStepInterface::class, $step);
    }

    public function testDescriptionToLowercaseStepTransformsData(): void
    {
        $step = new DescriptionToLowercaseStep();
        $dataSet = new DataSet([
            SupplierDataSetInterface::COLUMN_DESCRIPTION => 'UPPERCASE DESCRIPTION',
        ]);

        $step->execute($dataSet);

        $this->assertSame(
            'uppercase description',
            $dataSet[SupplierDataSetInterface::COLUMN_DESCRIPTION],
            'DescriptionToLowercaseStep must lowercase the description value.',
        );
    }

    public function testSupplierWriterStepImplementsInterface(): void
    {
        $this->assertTrue(
            class_exists(SupplierWriterStep::class),
            'SupplierWriterStep class must exist.',
        );
        $this->assertTrue(
            method_exists(SupplierWriterStep::class, 'execute'),
            'SupplierWriterStep must have an execute() method.',
        );

        $interfaces = class_implements(SupplierWriterStep::class);
        $this->assertContains(
            DataImportStepInterface::class,
            $interfaces,
            'SupplierWriterStep must implement DataImportStepInterface.',
        );
    }

    // --- Factory ---

    public function testBusinessFactoryHasSupplierDataImportMethod(): void
    {
        $this->assertTrue(
            method_exists(SupplierDataImportBusinessFactory::class, 'getSupplierDataImport'),
            'BusinessFactory must have getSupplierDataImport() method.',
        );
    }

    public function testBusinessFactoryHasSupplierLocationDataImportMethod(): void
    {
        $this->assertTrue(
            method_exists(SupplierDataImportBusinessFactory::class, 'getSupplierLocationDataImport'),
            'BusinessFactory must have getSupplierLocationDataImport() method.',
        );
    }

    public function testBusinessFactoryHasStepCreatorMethods(): void
    {
        $this->assertTrue(
            method_exists(SupplierDataImportBusinessFactory::class, 'createDescriptionToLowercaseStep'),
            'BusinessFactory must have createDescriptionToLowercaseStep().',
        );
        $this->assertTrue(
            method_exists(SupplierDataImportBusinessFactory::class, 'createSupplierWriterStep'),
            'BusinessFactory must have createSupplierWriterStep().',
        );
    }

    // --- Facade ---

    public function testFacadeImplementsInterface(): void
    {
        $this->assertTrue(
            is_subclass_of(SupplierDataImportFacade::class, \Spryker\Zed\Kernel\Business\AbstractFacade::class),
            'Facade must extend AbstractFacade.',
        );

        $interfaces = class_implements(SupplierDataImportFacade::class);
        $this->assertContains(
            SupplierDataImportFacadeInterface::class,
            $interfaces,
            'Facade must implement SupplierDataImportFacadeInterface.',
        );
    }

    public function testFacadeHasImportMethods(): void
    {
        $this->assertTrue(
            method_exists(SupplierDataImportFacade::class, 'importSupplier'),
            'Facade must have importSupplier() method.',
        );
        $this->assertTrue(
            method_exists(SupplierDataImportFacade::class, 'importSupplierLocation'),
            'Facade must have importSupplierLocation() method.',
        );
    }

    public function testFacadeImportSupplierReturnsReportTransfer(): void
    {
        $reflection = new \ReflectionMethod(SupplierDataImportFacade::class, 'importSupplier');
        $returnType = $reflection->getReturnType();

        $this->assertNotNull($returnType, 'importSupplier() must have a return type.');
        $this->assertSame(
            DataImporterReportTransfer::class,
            $returnType->getName(),
            'importSupplier() must return DataImporterReportTransfer.',
        );
    }

    // --- Plugins ---

    public function testSupplierDataImportPluginImplementsInterface(): void
    {
        $interfaces = class_implements(SupplierDataImportPlugin::class);
        $this->assertContains(
            DataImportPluginInterface::class,
            $interfaces,
            'SupplierDataImportPlugin must implement DataImportPluginInterface.',
        );
    }

    public function testSupplierDataImportPluginReturnsCorrectImportType(): void
    {
        $plugin = new SupplierDataImportPlugin();

        $this->assertSame(
            SupplierDataImportConfig::IMPORT_TYPE_SUPPLIER,
            $plugin->getImportType(),
            'Plugin must return the correct import type.',
        );
    }

    public function testSupplierLocationDataImportPluginImplementsInterface(): void
    {
        $interfaces = class_implements(SupplierLocationDataImportPlugin::class);
        $this->assertContains(
            DataImportPluginInterface::class,
            $interfaces,
            'SupplierLocationDataImportPlugin must implement DataImportPluginInterface.',
        );
    }

    public function testSupplierLocationDataImportPluginReturnsCorrectImportType(): void
    {
        $plugin = new SupplierLocationDataImportPlugin();

        $this->assertSame(
            SupplierDataImportConfig::IMPORT_TYPE_SUPPLIER_LOCATION,
            $plugin->getImportType(),
            'Plugin must return the correct import type for supplier-location.',
        );
    }

    // --- CSV Files ---

    public function testSupplierCsvFileExists(): void
    {
        $csvPath = $this->findCsvPath('supplier.csv');
        $this->assertNotNull($csvPath, 'data/import/supplier.csv must exist.');
    }

    public function testSupplierCsvHasCorrectHeaders(): void
    {
        $csvPath = $this->findCsvPath('supplier.csv');
        $this->assertNotNull($csvPath);

        $handle = fopen($csvPath, 'r');
        $headers = fgetcsv($handle);
        fclose($handle);

        $this->assertContains('name', $headers, 'CSV must have a "name" column.');
        $this->assertContains('description', $headers, 'CSV must have a "description" column.');
        $this->assertContains('status', $headers, 'CSV must have a "status" column.');
    }

    public function testSupplierLocationCsvHasCorrectHeaders(): void
    {
        $csvPath = $this->findCsvPath('supplier_location.csv');
        $this->assertNotNull($csvPath, 'data/import/supplier_location.csv must exist.');

        $handle = fopen($csvPath, 'r');
        $headers = fgetcsv($handle);
        fclose($handle);

        $this->assertContains('supplier_name', $headers, 'Location CSV must have a "supplier_name" column.');
        $this->assertContains('city', $headers, 'Location CSV must have a "city" column.');
        $this->assertContains('country', $headers, 'Location CSV must have a "country" column.');
    }

    // --- Helpers ---

    private function findCsvPath(string $filename): ?string
    {
        $paths = [
            __DIR__ . '/../../../../../data/import/' . $filename,
            getcwd() . '/data/import/' . $filename,
        ];

        foreach ($paths as $path) {
            if (file_exists($path)) {
                return $path;
            }
        }

        return null;
    }
}
