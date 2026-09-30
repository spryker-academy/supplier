<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Zed\SupplierMerchantPortalGui\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Serves the "Edit" drawer of a supplier table row.
 *
 * @method \SprykerAcademy\Zed\SupplierMerchantPortalGui\Communication\SupplierMerchantPortalGuiCommunicationFactory getFactory()
 */
class UpdateSupplierController extends AbstractController
{
    protected const string PARAM_ID_SUPPLIER = 'id-supplier';

    protected const string MESSAGE_SUPPLIER_UPDATED = 'Supplier updated successfully.';

    /**
     * The table-id of <web-mp-supplier-list> in Presentation/Supplier/index.twig.
     */
    protected const string ID_TABLE_SUPPLIER_LIST = 'web-mp-supplier-list';

    public function indexAction(Request $request): JsonResponse
    {
        // TODO-1: Read the supplier id from the request: $this->castId($request->get(static::PARAM_ID_SUPPLIER))
        // TODO-2: Load the supplier with the form data provider's getData($idSupplier).
        //         When its idSupplier is null, throw a NotFoundHttpException.
        // TODO-3: Create the form with the loaded supplier and let it handle the request.
        // TODO-4: When it is submitted and valid, save it with the facade's updateSupplier() and return the ZedUi
        //         actions as CreateSupplierController does (MESSAGE_SUPPLIER_UPDATED).
        // TODO-5: Otherwise return new JsonResponse(['form' => <the rendered _supplier_form.twig>]) - see CreateSupplierController.

        throw new NotFoundHttpException('TODO: implement UpdateSupplierController::indexAction()');
    }
}
