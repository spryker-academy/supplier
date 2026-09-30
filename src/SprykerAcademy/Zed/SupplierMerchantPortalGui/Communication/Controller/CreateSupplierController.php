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
        $supplierForm->handleRequest($request);

        if ($supplierForm->isSubmitted() && $supplierForm->isValid()) {
            $supplierTransfer = $this->getFactory()
                ->getSupplierFacade()
                ->createSupplier($supplierForm->getData());

            $this->linkSupplierToCurrentMerchant($supplierTransfer);

            $zedUiFormResponseTransfer = $this->getFactory()
                ->getZedUiFactory()
                ->createZedUiFormResponseBuilder()
                ->addSuccessNotification(static::MESSAGE_SUPPLIER_CREATED)
                ->addActionCloseDrawer()
                ->addActionRefreshTable(static::ID_TABLE_SUPPLIER_LIST)
                ->createResponse();

            return new JsonResponse($zedUiFormResponseTransfer->toArray(true, true));
        }

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
        $merchantTransfer = $this->getFactory()
            ->getMerchantUserFacade()
            ->getCurrentMerchantUser()
            ->getMerchantOrFail();

        (new PyzMerchantToSupplier())
            ->setFkMerchant($merchantTransfer->getIdMerchantOrFail())
            ->setFkSupplier($supplierTransfer->getIdSupplierOrFail())
            ->save();
    }
}
