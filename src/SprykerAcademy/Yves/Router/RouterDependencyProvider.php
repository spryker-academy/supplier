<?php

declare(strict_types=1);

namespace SprykerAcademy\Yves\Router;

use Pyz\Yves\Router\RouterDependencyProvider as PyzRouterDependencyProvider;
use SprykerAcademy\Yves\SupplierPage\Plugin\Router\SupplierPageRouteProviderPlugin;

class RouterDependencyProvider extends PyzRouterDependencyProvider
{
    /**
     * @return array<\Spryker\Yves\RouterExtension\Dependency\Plugin\RouteProviderPluginInterface>
     */
    protected function getRouteProvider(): array
    {
        return array_merge(parent::getRouteProvider(), [
            new SupplierPageRouteProviderPlugin(),
        ]);
    }
}
