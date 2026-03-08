<?php

namespace SprykerAcademy\Yves\SupplierPage\Plugin\Router;

use Spryker\Yves\Router\Plugin\RouteProvider\AbstractRouteProviderPlugin;
use Spryker\Yves\Router\Route\RouteCollection;

class SupplierPageRouteProviderPlugin extends AbstractRouteProviderPlugin
{
    public const ROUTE_NAME_SUPPLIER_INDEX = 'supplier-index';
    public const ROUTE_NAME_SUPPLIER_DETAIL = 'supplier-detail';

    /**
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    public function addRoutes(RouteCollection $routeCollection): RouteCollection
    {
        $routeCollection = $this->addSupplierIndexRoute($routeCollection);
        $routeCollection = $this->addSupplierDetailRoute($routeCollection);

        return $routeCollection;
    }

    /**
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    private function addSupplierIndexRoute(RouteCollection $routeCollection): RouteCollection
    {
        $route = $this->buildRoute('/supplier', 'SupplierPage', 'Index', 'indexAction');
        $route = $route->setMethods(['GET']);
        $routeCollection->add(static::ROUTE_NAME_SUPPLIER_INDEX, $route);

        return $routeCollection;
    }

    /**
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    private function addSupplierDetailRoute(RouteCollection $routeCollection): RouteCollection
    {
        $route = $this->buildRoute('/supplier/detail', 'SupplierPage', 'Index', 'detailAction');
        $route = $route->setMethods(['GET']);
        $routeCollection->add(static::ROUTE_NAME_SUPPLIER_DETAIL, $route);

        return $routeCollection;
    }
}
