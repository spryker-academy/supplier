<?php

declare(strict_types=1);

namespace SprykerAcademyTest\Zed\Supplier\BackOffice;

use Codeception\Test\Unit;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

/**
 * Structural tests for the SupplierGui Back Office module.
 * No Spryker kernel or database required.
 *
 * Run: vendor/bin/codecept run -c tests/SprykerAcademyTest/Zed/Supplier/ BackOffice
 */
class SupplierGuiStructuralTest extends Unit
{
    // --- Table ---

    public function testSupplierTableClassExists(): void
    {
        $class = 'SprykerAcademy\Zed\SupplierGui\Communication\Table\SupplierTable';
        $this->assertTrue(class_exists($class), 'SupplierTable class must exist.');
        $this->assertTrue(
            is_subclass_of($class, AbstractTable::class),
            'SupplierTable must extend AbstractTable.',
        );
    }

    public function testSupplierTableHasColumnConstants(): void
    {
        $class = 'SprykerAcademy\Zed\SupplierGui\Communication\Table\SupplierTable';
        $this->assertTrue(defined("$class::COL_ID_SUPPLIER"), 'SupplierTable must have COL_ID_SUPPLIER constant.');
        $this->assertTrue(defined("$class::COL_NAME"), 'SupplierTable must have COL_NAME constant.');
        $this->assertTrue(defined("$class::COL_DESCRIPTION"), 'SupplierTable must have COL_DESCRIPTION constant.');
        $this->assertTrue(defined("$class::COL_STATUS"), 'SupplierTable must have COL_STATUS constant.');
    }

    public function testSupplierTableHasConfigureAndPrepareDataMethods(): void
    {
        $class = 'SprykerAcademy\Zed\SupplierGui\Communication\Table\SupplierTable';
        $reflection = new \ReflectionClass($class);

        $this->assertTrue($reflection->hasMethod('configure'), 'SupplierTable must have configure() method.');
        $this->assertTrue($reflection->hasMethod('prepareData'), 'SupplierTable must have prepareData() method.');
    }

    // --- Controllers ---

    public function testIndexControllerExists(): void
    {
        $class = 'SprykerAcademy\Zed\SupplierGui\Communication\Controller\IndexController';
        $this->assertTrue(class_exists($class), 'IndexController must exist.');
        $this->assertTrue(method_exists($class, 'indexAction'), 'IndexController must have indexAction().');
        $this->assertTrue(method_exists($class, 'tableAction'), 'IndexController must have tableAction().');
    }

    public function testCreateControllerExists(): void
    {
        $class = 'SprykerAcademy\Zed\SupplierGui\Communication\Controller\CreateController';
        $this->assertTrue(class_exists($class), 'CreateController must exist.');
        $this->assertTrue(method_exists($class, 'indexAction'), 'CreateController must have indexAction().');
    }

    public function testEditControllerExists(): void
    {
        $class = 'SprykerAcademy\Zed\SupplierGui\Communication\Controller\EditController';
        $this->assertTrue(class_exists($class), 'EditController must exist.');
        $this->assertTrue(method_exists($class, 'indexAction'), 'EditController must have indexAction().');
    }

    public function testDeleteControllerExists(): void
    {
        $class = 'SprykerAcademy\Zed\SupplierGui\Communication\Controller\DeleteController';
        $this->assertTrue(class_exists($class), 'DeleteController must exist.');
        $this->assertTrue(method_exists($class, 'indexAction'), 'DeleteController must have indexAction().');
    }

    // --- Form ---

    public function testSupplierCreateFormExists(): void
    {
        $class = 'SprykerAcademy\Zed\SupplierGui\Communication\Form\SupplierCreateForm';
        $this->assertTrue(class_exists($class), 'SupplierCreateForm must exist.');
        $this->assertTrue(
            is_subclass_of($class, 'Symfony\Component\Form\AbstractType'),
            'SupplierCreateForm must extend AbstractType.',
        );
    }

    public function testSupplierCreateFormHasFieldConstants(): void
    {
        $class = 'SprykerAcademy\Zed\SupplierGui\Communication\Form\SupplierCreateForm';
        $this->assertTrue(defined("$class::FIELD_NAME"), 'Form must have FIELD_NAME constant.');
        $this->assertTrue(defined("$class::FIELD_DESCRIPTION"), 'Form must have FIELD_DESCRIPTION constant.');
        $this->assertTrue(defined("$class::FIELD_EMAIL"), 'Form must have FIELD_EMAIL constant.');
        $this->assertTrue(defined("$class::FIELD_PHONE"), 'Form must have FIELD_PHONE constant.');
    }

    public function testSupplierCreateFormHasBuildFormMethod(): void
    {
        $class = 'SprykerAcademy\Zed\SupplierGui\Communication\Form\SupplierCreateForm';
        $this->assertTrue(
            method_exists($class, 'buildForm'),
            'SupplierCreateForm must have buildForm() method.',
        );
    }

    // --- Factory ---

    public function testCommunicationFactoryExists(): void
    {
        $class = 'SprykerAcademy\Zed\SupplierGui\Communication\SupplierGuiCommunicationFactory';
        $this->assertTrue(class_exists($class), 'SupplierGuiCommunicationFactory must exist.');
        $this->assertTrue(
            is_subclass_of($class, AbstractCommunicationFactory::class),
            'Factory must extend AbstractCommunicationFactory.',
        );
    }

    public function testFactoryHasTableCreationMethod(): void
    {
        $class = 'SprykerAcademy\Zed\SupplierGui\Communication\SupplierGuiCommunicationFactory';
        $this->assertTrue(
            method_exists($class, 'createSupplierTable'),
            'Factory must have createSupplierTable() method.',
        );
    }

    public function testFactoryHasFacadeAccessorMethod(): void
    {
        $class = 'SprykerAcademy\Zed\SupplierGui\Communication\SupplierGuiCommunicationFactory';
        $this->assertTrue(
            method_exists($class, 'getSupplierFacade'),
            'Factory must have getSupplierFacade() method.',
        );
    }

    public function testFactoryHasQueryAccessorMethod(): void
    {
        $class = 'SprykerAcademy\Zed\SupplierGui\Communication\SupplierGuiCommunicationFactory';
        $this->assertTrue(
            method_exists($class, 'getSupplierQuery'),
            'Factory must have getSupplierQuery() method.',
        );
    }

    public function testFactoryHasFormCreationMethod(): void
    {
        $class = 'SprykerAcademy\Zed\SupplierGui\Communication\SupplierGuiCommunicationFactory';
        $this->assertTrue(
            method_exists($class, 'createSupplierCreateForm'),
            'Factory must have createSupplierCreateForm() method.',
        );
    }

    // --- DependencyProvider ---

    public function testDependencyProviderExists(): void
    {
        $class = 'SprykerAcademy\Zed\SupplierGui\SupplierGuiDependencyProvider';
        $this->assertTrue(class_exists($class), 'SupplierGuiDependencyProvider must exist.');
    }

    public function testDependencyProviderHasConstants(): void
    {
        $class = 'SprykerAcademy\Zed\SupplierGui\SupplierGuiDependencyProvider';
        $this->assertTrue(
            defined("$class::FACADE_SUPPLIER"),
            'DependencyProvider must have FACADE_SUPPLIER constant.',
        );
        $this->assertTrue(
            defined("$class::PROPEL_QUERY_SUPPLIER"),
            'DependencyProvider must have PROPEL_QUERY_SUPPLIER constant.',
        );
    }

    // --- Navigation XML ---

    public function testNavigationXmlExists(): void
    {
        $paths = [
            __DIR__ . '/../../../../../config/Zed/navigation.xml',
            getcwd() . '/config/Zed/navigation.xml',
        ];

        $found = false;
        foreach ($paths as $path) {
            if (file_exists($path)) {
                $found = true;
                $xml = simplexml_load_file($path);
                $this->assertNotFalse($xml, 'navigation.xml must be valid XML.');

                $supplierNodes = $xml->xpath("//*[contains(local-name(), 'supplier')]");
                $this->assertNotEmpty($supplierNodes, 'navigation.xml must contain supplier entries.');
                break;
            }
        }

        $this->assertTrue($found, 'config/Zed/navigation.xml must exist.');
    }

    // --- Twig Templates ---

    public function testIndexTwigTemplateExists(): void
    {
        $paths = [
            __DIR__ . '/../../../../../src/SprykerAcademy/Zed/SupplierGui/Presentation/Index/index.twig',
            getcwd() . '/src/SprykerAcademy/Zed/SupplierGui/Presentation/Index/index.twig',
        ];

        $found = false;
        foreach ($paths as $path) {
            if (file_exists($path)) {
                $found = true;
                $content = file_get_contents($path);
                $this->assertStringContainsString('supplierTable', $content, 'Index template must render the supplierTable variable.');
                $this->assertStringContainsString('raw', $content, 'Index template must use the raw filter for the table HTML.');
                break;
            }
        }

        $this->assertTrue($found, 'Presentation/Index/index.twig must exist.');
    }

    public function testCreateTwigTemplateExists(): void
    {
        $paths = [
            __DIR__ . '/../../../../../src/SprykerAcademy/Zed/SupplierGui/Presentation/Create/index.twig',
            getcwd() . '/src/SprykerAcademy/Zed/SupplierGui/Presentation/Create/index.twig',
        ];

        $found = false;
        foreach ($paths as $path) {
            if (file_exists($path)) {
                $found = true;
                $content = file_get_contents($path);
                $this->assertStringContainsString('supplierCreateForm', $content, 'Create template must render the form.');
                break;
            }
        }

        $this->assertTrue($found, 'Presentation/Create/index.twig must exist.');
    }
}
