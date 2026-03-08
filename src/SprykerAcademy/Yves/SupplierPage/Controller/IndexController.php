<?php

namespace SprykerAcademy\Yves\SupplierPage\Controller;

use Spryker\Yves\Kernel\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \SprykerAcademy\Yves\SupplierPage\SupplierPageFactory getFactory()
 */
class IndexController extends AbstractController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function indexAction(Request $request): array
    {
        // TODO: Get the supplier name from the request
        $name = $request->get('name');

        // TODO: Use the SupplierSearchClient to find the supplier by name
        // Hint: $this->getFactory()->getSupplierSearchClient()->getSupplierByName($name)
        $supplier = null;

        return [
            'supplier' => $supplier,
            'name' => $name,
        ];
    }
}
