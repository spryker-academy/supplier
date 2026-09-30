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
        $idSupplier = $this->castId($request->get(static::PARAM_ID_SUPPLIER));

        $supplierFormDataProvider = $this->getFactory()->createSupplierFormDataProvider();
        $supplierTransfer = $supplierFormDataProvider->getData($idSupplier);

        if ($supplierTransfer->getIdSupplier() === null) {
            throw new NotFoundHttpException(sprintf('Supplier not found for id %d.', $idSupplier));
        }

        $supplierForm = $this->getFactory()->createSupplierForm($supplierTransfer, $supplierFormDataProvider->getOptions());
        $supplierForm->handleRequest($request);

        if ($supplierForm->isSubmitted() && $supplierForm->isValid()) {
            $this->getFactory()
                ->getSupplierFacade()
                ->updateSupplier($supplierForm->getData());

            $zedUiFormResponseTransfer = $this->getFactory()
                ->getZedUiFactory()
                ->createZedUiFormResponseBuilder()
                ->addSuccessNotification(static::MESSAGE_SUPPLIER_UPDATED)
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
}
