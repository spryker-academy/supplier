<?php

declare(strict_types=1);

namespace SprykerAcademy\Zed\SupplierMerchantPortalGui\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @method \SprykerAcademy\Zed\SupplierMerchantPortalGui\Communication\SupplierMerchantPortalGuiCommunicationFactory getFactory()
 */
class UpdateSupplierController extends AbstractController
{
    /**
     * @var string
     */
    protected const PARAM_ID_SUPPLIER = 'id-supplier';

    /**
     * @var string
     */
    protected const MESSAGE_SUPPLIER_UPDATED = 'Supplier updated successfully.';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
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
                ->addActionRefreshTable()
                ->createResponse();

            return new JsonResponse($zedUiFormResponseTransfer->toArray());
        }

        return new JsonResponse(
            $this->renderView('@SupplierMerchantPortalGui/Partials/_supplier_form.twig', [
                'form' => $supplierForm->createView(),
            ])->getContent(),
        );
    }
}
