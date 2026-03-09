<?php

declare(strict_types=1);

namespace SprykerAcademy\Yves\SupplierPage\Plugin\Router;

use Spryker\Yves\Router\Plugin\RouteProvider\AbstractRouteProviderPlugin;
use Spryker\Yves\Router\Route\RouteCollection;

class SupplierPageRouteProviderPlugin extends AbstractRouteProviderPlugin
{
    /**
     * @var string
     */
    public const ROUTE_SUPPLIER_LIST = 'supplier-list';

    /**
     * @var string
     */
    public const ROUTE_SUPPLIER_DETAIL = 'supplier-detail';

    public function addRoutes(RouteCollection $routeCollection): RouteCollection
    {
        $routeCollection = $this->addSupplierListRoute($routeCollection);
        $routeCollection = $this->addSupplierDetailRoute($routeCollection);

        return $routeCollection;
    }

    protected function addSupplierListRoute(RouteCollection $routeCollection): RouteCollection
    {
        $route = $this->buildRoute('/suppliers', 'SupplierPage', 'Index', 'listAction');
        $route = $route->setMethods(['GET']);
        $routeCollection->add(static::ROUTE_SUPPLIER_LIST, $route);

        return $routeCollection;
    }

    protected function addSupplierDetailRoute(RouteCollection $routeCollection): RouteCollection
    {
        $route = $this->buildRoute('/suppliers/{idSupplier}', 'SupplierPage', 'Index', 'detailAction');
        $route = $route->setMethods(['GET']);
        $route = $route->setRequirement('idSupplier', '\d+');
        $routeCollection->add(static::ROUTE_SUPPLIER_DETAIL, $route);

        return $routeCollection;
    }
}
