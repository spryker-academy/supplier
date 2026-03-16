<?php

declare(strict_types=1);

namespace SprykerAcademy\Zed\SupplierMerchantPortalGui\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function indexAction(Request $request): JsonResponse
    {
        // TODO: Implement update supplier form handling
        // 1. Get id-supplier from request
        // 2. Get SupplierFormDataProvider, call getData($idSupplier) for existing transfer
        // 3. Validate supplier exists (throw NotFoundHttpException if not)
        // 4. Create form, handle request
        // 5. If submitted and valid:
        //    - Update supplier via facade
        //    - Return JsonResponse with ZedUI actions
        // 6. Otherwise: render the form template

        $idSupplier = $this->castId($request->get(static::PARAM_ID_SUPPLIER));
        $supplierFormDataProvider = $this->getFactory()->createSupplierFormDataProvider();
        $supplierForm = $this->getFactory()->createSupplierForm(
            $supplierFormDataProvider->getData($idSupplier),
            $supplierFormDataProvider->getOptions(),
        );

        return new JsonResponse(
            $this->renderView('@SupplierMerchantPortalGui/Partials/_supplier_form.twig', [
                'form' => $supplierForm->createView(),
            ])->getContent(),
        );
    }
}
