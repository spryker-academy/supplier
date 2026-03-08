<?php

namespace SprykerAcademy\Yves\SupplierPage\Controller;

use Spryker\Yves\Kernel\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * TODO: Exercise - Yves Storefront Supplier Page
 *
 * This controller handles the Yves (storefront) display of suppliers.
 * You need to implement two actions:
 * 1. indexAction - Shows a table of all suppliers
 * 2. detailAction - Shows details of a single supplier by ID
 */
class IndexController extends AbstractController
{
    /**
     * Displays a list of all suppliers in a table.
     *
     * TODO: Implement this action
     * 1. Get the SupplierSearchClient from the factory using getFactory()->getSupplierSearchClient()
     * 2. Call searchSuppliers([]) to get all suppliers (pass empty array for no filters)
     * 3. Return an array with 'suppliers' key containing the supplier collection
     *
     * The template will iterate over this list and display a table.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function indexAction(Request $request): array
    {
        // TODO: Get supplier search client and fetch all suppliers

        return [
            'suppliers' => [], // TODO: Replace with actual suppliers from search result
        ];
    }

    /**
     * Displays details of a single supplier by ID.
     *
     * TODO: Implement this action
     * 1. Get the 'id' query parameter from the request using $request->query->getInt('id')
     * 2. If no ID is provided, add an error message using $this->addErrorMessage() and redirect to index
     * 3. Use the SupplierSearchClient to call findSupplierById($idSupplier)
     * 4. If supplier not found, add error message and redirect to index
     * 5. Return an array with 'supplier' key containing the supplier transfer
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array|\Symfony\Component\HttpFoundation\Response
     */
    public function detailAction(Request $request)
    {
        // TODO: Get supplier ID from query parameter

        // TODO: Validate ID exists, if not show error and redirect

        // TODO: Fetch supplier by ID using the client

        // TODO: If not found, show error and redirect

        return [
            'supplier' => null, // TODO: Replace with actual supplier transfer
        ];
    }
}
