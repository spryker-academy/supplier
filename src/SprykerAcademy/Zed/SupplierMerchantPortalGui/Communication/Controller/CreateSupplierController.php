<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Zed\SupplierMerchantPortalGui\Communication\Controller;

use Generated\Shared\Transfer\SupplierTransfer;
use Orm\Zed\Supplier\Persistence\PyzMerchantToSupplier;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Serves the "Add Supplier" drawer. The drawer's ajax form expects JSON: `form` holds the rendered
 * form, and after a successful submit the ZedUi actions tell it to notify, close and refresh.
 *
 * @method \SprykerAcademy\Zed\SupplierMerchantPortalGui\Communication\SupplierMerchantPortalGuiCommunicationFactory getFactory()
 */
class CreateSupplierController extends AbstractController
{
    protected const string MESSAGE_SUPPLIER_CREATED = 'Supplier created successfully.';

    /**
     * The table-id of <web-mp-supplier-list> in Presentation/Supplier/index.twig.
     */
    protected const string ID_TABLE_SUPPLIER_LIST = 'web-mp-supplier-list';

    public function indexAction(Request $request): JsonResponse
    {
        $supplierFormDataProvider = $this->getFactory()->createSupplierFormDataProvider();
        $supplierForm = $this->getFactory()->createSupplierForm(
            $supplierFormDataProvider->getData(),
            $supplierFormDataProvider->getOptions(),
        );

        // TODO-1: Let the form handle the request: $supplierForm->handleRequest($request)
        // TODO-2: When the form is submitted and valid:
        //         - create the supplier with the facade's createSupplier($supplierForm->getData())
        //         - link it to the current merchant with $this->linkSupplierToCurrentMerchant()
        //         - return a JsonResponse with the ZedUi actions:
        //           $this->getFactory()->getZedUiFactory()->createZedUiFormResponseBuilder()
        //               ->addSuccessNotification(static::MESSAGE_SUPPLIER_CREATED)
        //               ->addActionCloseDrawer()
        //               ->addActionRefreshTable(static::ID_TABLE_SUPPLIER_LIST)
        //               ->createResponse()
        //           and new JsonResponse($zedUiFormResponseTransfer->toArray(true, true))

        // Otherwise: the drawer shows the form (again, with its validation errors after a failed submit)
        return new JsonResponse([
            'form' => $this->renderView('@SupplierMerchantPortalGui/Partials/_supplier_form.twig', [
                'form' => $supplierForm->createView(),
            ])->getContent(),
        ]);
    }

    /**
     * A supplier the merchant creates belongs to that merchant: link it through pyz_merchant_to_supplier.
     */
    protected function linkSupplierToCurrentMerchant(SupplierTransfer $supplierTransfer): void
    {
        // TODO-3: Link the supplier to the merchant of the logged-in merchant user:
        //         - $this->getFactory()->getMerchantUserFacade()->getCurrentMerchantUser()->getMerchantOrFail()
        //         - save a new PyzMerchantToSupplier with fkMerchant (the merchant's id) and fkSupplier (the supplier's id)
    }
}
