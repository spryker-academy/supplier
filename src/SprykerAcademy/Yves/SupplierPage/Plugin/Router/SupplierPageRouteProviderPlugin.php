<?php

namespace SprykerAcademy\Yves\SupplierPage\Plugin\Router;

use Spryker\Yves\Router\Plugin\RouteProvider\AbstractRouteProviderPlugin;
use Spryker\Yves\Router\Route\RouteCollection;

/**
 * TODO: Exercise - Route Provider
 *
 * This plugin registers routes for the SupplierPage module.
 * You need to add two routes:
 * 1. supplier-index: Lists all suppliers (path: /supplier)
 * 2. supplier-detail: Shows a single supplier (path: /supplier/detail)
 */
class SupplierPageRouteProviderPlugin extends AbstractRouteProviderPlugin
{
    // TODO: Add route name constants
    // const ROUTE_NAME_SUPPLIER_INDEX = 'supplier-index';
    // const ROUTE_NAME_SUPPLIER_DETAIL = 'supplier-detail';

    /**
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    public function addRoutes(RouteCollection $routeCollection): RouteCollection
    {
        // TODO: Add both routes to the collection
        // $routeCollection = $this->addSupplierIndexRoute($routeCollection);
        // $routeCollection = $this->addSupplierDetailRoute($routeCollection);

        return $routeCollection;
    }

    /**
     * TODO: Add route for supplier list
     * Use $this->buildRoute('/supplier', 'SupplierPage', 'Index', 'indexAction')
     * Set method to GET
     * Add to routeCollection with the route name constant
     */
    // private function addSupplierIndexRoute(RouteCollection $routeCollection): RouteCollection
    // {
    //     // ...
    // }

    /**
     * TODO: Add route for supplier detail
     * Use $this->buildRoute('/supplier/detail', 'SupplierPage', 'Index', 'detailAction')
     * Set method to GET
     * Add to routeCollection with the route name constant
     */
    // private function addSupplierDetailRoute(RouteCollection $routeCollection): RouteCollection
    // {
    //     // ...
    // }
}
