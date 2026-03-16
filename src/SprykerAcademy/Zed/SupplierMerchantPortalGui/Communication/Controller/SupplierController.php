<?php

declare(strict_types=1);

namespace SprykerAcademy\Zed\SupplierMerchantPortalGui\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method \SprykerAcademy\Zed\SupplierMerchantPortalGui\Communication\SupplierMerchantPortalGuiCommunicationFactory getFactory()
 * @method \SprykerAcademy\Zed\SupplierMerchantPortalGui\Persistence\SupplierMerchantPortalGuiRepositoryInterface getRepository()
 */
class SupplierController extends AbstractController
{
    /**
     * @return array<string, mixed>
     */
    public function indexAction(): array
    {
        // TODO: Return viewResponse with supplierTableConfiguration
        // Hint: $this->getFactory()->createSupplierGuiTableConfigurationProvider()->getConfiguration()

        return $this->viewResponse([]);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function tableDataAction(Request $request): Response
    {
        // TODO: Execute GuiTable data request
        // Hint: $this->getFactory()->getGuiTableHttpDataRequestExecutor()->execute(
        //     $request,
        //     $this->getFactory()->createSupplierGuiTableDataProvider(),
        //     $this->getFactory()->createSupplierGuiTableConfigurationProvider()->getConfiguration(),
        // )

        return new Response('', Response::HTTP_NOT_IMPLEMENTED);
    }
}
