<?php

declare(strict_types=1);

namespace SprykerAcademy\Zed\SupplierMerchantPortalGui\Communication\Controller;

use Generated\Shared\Transfer\SupplierTransfer;
use Orm\Zed\Supplier\Persistence\PyzMerchantToSupplier;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \SprykerAcademy\Zed\SupplierMerchantPortalGui\Communication\SupplierMerchantPortalGuiCommunicationFactory getFactory()
 */
class CreateSupplierController extends AbstractController
{
    /**
     * @var string
     */
    protected const MESSAGE_SUPPLIER_CREATED = 'Supplier created successfully.';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function indexAction(Request $request): JsonResponse
    {
        $supplierFormDataProvider = $this->getFactory()->createSupplierFormDataProvider();
        $supplierTransfer = $supplierFormDataProvider->getData();

        $supplierForm = $this->getFactory()->createSupplierForm($supplierTransfer, $supplierFormDataProvider->getOptions());
        $supplierForm->handleRequest($request);

        if ($supplierForm->isSubmitted() && $supplierForm->isValid()) {
            /** @var \Generated\Shared\Transfer\SupplierTransfer $supplierTransfer */
            $supplierTransfer = $supplierForm->getData();

            $supplierTransfer = $this->getFactory()
                ->getSupplierFacade()
                ->createSupplier($supplierTransfer);

            $this->linkSupplierToCurrentMerchant($supplierTransfer);

            $zedUiFormResponseTransfer = $this->getFactory()
                ->getZedUiFactory()
                ->createZedUiFormResponseBuilder()
                ->addSuccessNotification(static::MESSAGE_SUPPLIER_CREATED)
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

    /**
     * @param \Generated\Shared\Transfer\SupplierTransfer $supplierTransfer
     *
     * @return void
     */
    protected function linkSupplierToCurrentMerchant(SupplierTransfer $supplierTransfer): void
    {
        $merchantTransfer = $this->getFactory()
            ->getMerchantUserFacade()
            ->getCurrentMerchantUser()
            ->getMerchantOrFail();

        $merchantToSupplier = new PyzMerchantToSupplier();
        $merchantToSupplier->setFkMerchant($merchantTransfer->getIdMerchantOrFail());
        $merchantToSupplier->setFkSupplier($supplierTransfer->getIdSupplierOrFail());
        $merchantToSupplier->save();
    }
}
