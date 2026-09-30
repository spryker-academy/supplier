<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Zed\Sales;

use Pyz\Zed\Sales\SalesConfig as PyzSalesConfig;
use Spryker\Shared\DummyMarketplacePayment\DummyMarketplacePaymentConfig;
use SprykerAcademy\Zed\Oms\OmsConfig;

/**
 * Exercise 13: orders paid by invoice run through the Demo01 process.
 *
 * Projects usually map payment methods to processes in config/Shared/config_default.php
 * (SalesConstants::PAYMENT_METHOD_STATEMACHINE_MAPPING). This config class extends the project's
 * one and is resolved before it, so the exercise ships the mapping with its own code.
 */
class SalesConfig extends PyzSalesConfig
{
    /**
     * @return array<string, string>
     */
    public function getPaymentMethodStatemachineMapping(): array
    {
        return array_merge(parent::getPaymentMethodStatemachineMapping(), [
            DummyMarketplacePaymentConfig::PAYMENT_METHOD_DUMMY_MARKETPLACE_PAYMENT_INVOICE => OmsConfig::PROCESS_DEMO01,
        ]);
    }
}
