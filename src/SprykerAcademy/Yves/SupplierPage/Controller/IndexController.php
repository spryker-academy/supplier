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
        $name = $request->get('name');

        $supplier = $this->getFactory()
            ->getSupplierSearchClient()
            ->getSupplierByName($name);

        return [
            'supplier' => $supplier,
            'name' => $name,
        ];
    }
}
