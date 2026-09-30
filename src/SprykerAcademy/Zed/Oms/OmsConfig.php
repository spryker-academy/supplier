<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Zed\Oms;

use Pyz\Zed\Oms\OmsConfig as PyzOmsConfig;

/**
 * Exercise 13: activates the Demo01 process of config/Zed/oms/Demo01.xml.
 *
 * Projects usually list their processes in config/Shared/config_default.php
 * (OmsConstants::ACTIVE_PROCESSES). This config class extends the project's one and is resolved
 * before it, so the exercise ships the setting with its own code.
 */
class OmsConfig extends PyzOmsConfig
{
    public const string PROCESS_DEMO01 = 'Demo01';

    /**
     * @return array<string>
     */
    public function getActiveProcesses(): array
    {
        // TODO: Add the Demo01 process to the project's active processes.
        // Hint: array_merge(parent::getActiveProcesses(), [static::PROCESS_DEMO01])

        return parent::getActiveProcesses();
    }
}
