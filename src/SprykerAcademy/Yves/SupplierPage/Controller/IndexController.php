<?php

declare(strict_types=1);

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
     * @return array<string, mixed>
     */
    public function listAction(Request $request): array
    {
        $supplierCollection = $this->getFactory()
            ->getSupplierSearchClient()
            ->searchSuppliers($request->query->all());

        return [
            'suppliers' => $supplierCollection->getSuppliers(),
        ];
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array<string, mixed>
     */
    public function detailAction(Request $request): array
    {
        $idSupplier = (int)$request->get('idSupplier');

        $supplier = $this->getFactory()
            ->getSupplierSearchClient()
            ->findSupplierById($idSupplier);

        return [
            'supplier' => $supplier,
        ];
    }
}
