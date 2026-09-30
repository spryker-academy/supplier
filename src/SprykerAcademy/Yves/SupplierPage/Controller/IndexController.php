<?php

declare(strict_types=1);

namespace SprykerAcademy\Yves\SupplierPage\Controller;

use Spryker\Yves\Kernel\View\View;
use SprykerShop\Yves\ShopApplication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \SprykerAcademy\Yves\SupplierPage\SupplierPageFactory getFactory()
 */
class IndexController extends AbstractController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Spryker\Yves\Kernel\View\View
     */
    public function listAction(Request $request): View
    {
        $supplierCollection = $this->getFactory()
            ->getSupplierSearchClient()
            ->searchSuppliers($request->query->all());

        return $this->view(
            ['suppliers' => $supplierCollection->getSuppliers()],
            [],
            '@SupplierPage/views/list/list.twig',
        );
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Spryker\Yves\Kernel\View\View
     */
    public function detailAction(Request $request): View
    {
        $idSupplier = (int)$request->get('idSupplier');

        $supplier = $this->getFactory()
            ->getSupplierSearchClient()
            ->findSupplierById($idSupplier);

        return $this->view(
            ['supplier' => $supplier],
            [],
            '@SupplierPage/views/detail/detail.twig',
        );
    }
}
