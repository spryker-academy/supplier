<?php

declare(strict_types=1);

namespace SprykerAcademy\Zed\SupplierMerchantPortalGui\Communication\Controller;

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
        // TODO: Implement create supplier form handling
        // 1. Get SupplierFormDataProvider from factory, call getData() for empty transfer
        // 2. Create form via factory: $this->getFactory()->createSupplierForm($supplierTransfer, $options)
        // 3. Handle request: $supplierForm->handleRequest($request)
        // 4. If submitted and valid:
        //    - Create supplier via facade
        //    - Link supplier to current merchant (PyzMerchantToSupplier)
        //    - Return JsonResponse with ZedUI actions: addSuccessNotification, addActionCloseDrawer, addActionRefreshTable
        // 5. Otherwise: render the form template

        $supplierFormDataProvider = $this->getFactory()->createSupplierFormDataProvider();
        $supplierForm = $this->getFactory()->createSupplierForm(
            $supplierFormDataProvider->getData(),
            $supplierFormDataProvider->getOptions(),
        );

        return new JsonResponse(
            $this->renderView('@SupplierMerchantPortalGui/Partials/_supplier_form.twig', [
                'form' => $supplierForm->createView(),
            ])->getContent(),
        );
    }
}
