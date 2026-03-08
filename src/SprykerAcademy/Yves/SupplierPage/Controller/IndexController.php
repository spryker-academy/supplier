<?php

namespace SprykerAcademy\Yves\SupplierPage\Controller;

use Spryker\Yves\Kernel\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends AbstractController
{
    /**
     * Displays a list of all suppliers in a table.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function indexAction(Request $request): array
    {
        $supplierCollection = $this->getFactory()
            ->getSupplierSearchClient()
            ->searchSuppliers([]);

        return [
            'suppliers' => $supplierCollection->getSuppliers(),
        ];
    }

    /**
     * Displays details of a single supplier by ID.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array|\Symfony\Component\HttpFoundation\Response
     */
    public function detailAction(Request $request)
    {
        $idSupplier = $request->query->getInt('id');

        if (!$idSupplier) {
            $this->addErrorMessage('Supplier ID is required.');

            return $this->redirectResponse('/supplier');
        }

        $supplier = $this->getFactory()
            ->getSupplierSearchClient()
            ->findSupplierById($idSupplier);

        if (!$supplier) {
            $this->addErrorMessage('Supplier not found.');

            return $this->redirectResponse('/supplier');
        }

        return [
            'supplier' => $supplier,
        ];
    }
}
