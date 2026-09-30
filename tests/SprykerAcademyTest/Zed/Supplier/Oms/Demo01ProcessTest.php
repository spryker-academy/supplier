<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademyTest\Zed\Supplier\Oms;

use Codeception\Test\Unit;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use SimpleXMLElement;
use Spryker\Shared\DummyMarketplacePayment\DummyMarketplacePaymentConfig;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;
use Spryker\Zed\Oms\Communication\Plugin\Oms\Command\CommandCollection;
use Spryker\Zed\Oms\Communication\Plugin\Oms\Condition\ConditionCollection;
use Spryker\Zed\Oms\OmsDependencyProvider as SprykerOmsDependencyProvider;
use SprykerAcademy\Zed\Oms\Communication\Plugin\Oms\Command\PayCommandPlugin;
use SprykerAcademy\Zed\Oms\Communication\Plugin\Oms\Condition\IsAuthorizedConditionPlugin;
use SprykerAcademy\Zed\Oms\OmsConfig;
use SprykerAcademy\Zed\Oms\OmsDependencyProvider;
use SprykerAcademy\Zed\Sales\SalesConfig;

/**
 * Exercise 13: the Demo01 state machine, its command and condition, and the configuration that
 * activates it for invoice orders.
 */
class Demo01ProcessTest extends Unit
{
    protected const string PROCESS_FILE = 'config/Zed/oms/Demo01.xml';

    public function testProcessDefinesTheSixStates(): void
    {
        $states = [];
        foreach ($this->loadProcess()->xpath('//oms:state') as $state) {
            $states[] = (string)$state['name'];
        }

        sort($states);
        $this->assertSame(
            ['closed', 'invalid', 'new', 'paid', 'payment authorized', 'payment pending'],
            $states,
        );
    }

    public function testHappyPathLeadsFromNewToClosed(): void
    {
        $happyPath = [];
        foreach ($this->loadProcess()->xpath('//oms:transition[@happy="true"]') as $transition) {
            $transition->registerXPathNamespace('oms', 'spryker:oms-01');
            $happyPath[(string)$transition->source] = (string)$transition->target;
        }

        $state = 'new';
        $visited = [$state];
        while (isset($happyPath[$state]) && count($visited) < 10) {
            $state = $happyPath[$state];
            $visited[] = $state;
        }

        $this->assertSame(['new', 'payment pending', 'payment authorized', 'paid', 'closed'], $visited);
    }

    public function testAuthorizeIsRoutedByTheIsAuthorizedCondition(): void
    {
        $process = $this->loadProcess();

        $this->assertNotEmpty(
            $process->xpath('//oms:transition[@condition="Demo/IsAuthorized"][oms:source="new"][oms:target="payment pending"]'),
            'new -> payment pending needs condition="Demo/IsAuthorized".',
        );
        $this->assertNotEmpty(
            $process->xpath('//oms:event[@name="authorize"][@command="Demo/Pay"]'),
            'The authorize event needs command="Demo/Pay".',
        );
    }

    public function testCommandAndConditionAreRegisteredUnderTheirXmlNames(): void
    {
        $container = (new OmsDependencyProvider())->provideBusinessLayerDependencies(new Container());

        /** @var \Spryker\Zed\Oms\Communication\Plugin\Oms\Command\CommandCollection $commands */
        $commands = $container->get(SprykerOmsDependencyProvider::COMMAND_PLUGINS);
        /** @var \Spryker\Zed\Oms\Communication\Plugin\Oms\Condition\ConditionCollection $conditions */
        $conditions = $container->get(SprykerOmsDependencyProvider::CONDITION_PLUGINS);

        $this->assertInstanceOf(CommandCollection::class, $commands);
        $this->assertInstanceOf(PayCommandPlugin::class, $commands->get('Demo/Pay'));
        $this->assertInstanceOf(ConditionCollection::class, $conditions);
        $this->assertInstanceOf(IsAuthorizedConditionPlugin::class, $conditions->get('Demo/IsAuthorized'));
    }

    public function testCommandAndConditionLetTheOrderPass(): void
    {
        $this->assertSame([], (new PayCommandPlugin())->run([], new SpySalesOrder(), new ReadOnlyArrayObject()));
        $this->assertTrue((new IsAuthorizedConditionPlugin())->check(new SpySalesOrderItem()));
    }

    public function testDemo01IsActiveAndInvoiceOrdersUseIt(): void
    {
        $this->assertContains(OmsConfig::PROCESS_DEMO01, (new OmsConfig())->getActiveProcesses());
        $this->assertSame(
            OmsConfig::PROCESS_DEMO01,
            (new SalesConfig())->getPaymentMethodStatemachineMapping()[DummyMarketplacePaymentConfig::PAYMENT_METHOD_DUMMY_MARKETPLACE_PAYMENT_INVOICE] ?? null,
        );
    }

    protected function loadProcess(): SimpleXMLElement
    {
        $path = getcwd() . '/' . static::PROCESS_FILE;
        $this->assertFileExists($path, static::PROCESS_FILE . ' is loaded with the exercise.');

        $xml = simplexml_load_file($path);
        $this->assertNotFalse($xml, static::PROCESS_FILE . ' must be valid XML.');
        $xml->registerXPathNamespace('oms', 'spryker:oms-01');

        return $xml;
    }
}
