<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

use Spryker\Service\Container\ProxyFactory;
use SprykerAcademy\Zed\Supplier\Business\SupplierFacade;
use SprykerAcademy\Zed\Supplier\Business\SupplierFacadeInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $configurator): void {
    $services = $configurator->services()
        ->defaults()
        ->autowire()
        ->public()
        ->autoconfigure();

    $services->set(ProxyFactory::class)->public();

    // Manually register Facade interfaces - Zed Facades use Spryker Factory pattern, not Symfony autowiring
    $services->set(SupplierFacadeInterface::class, SupplierFacade::class);
};
