<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Zed\SupplierGui\Communication\Controller;

use Generated\Shared\Transfer\SupplierTransfer;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \SprykerAcademy\Zed\SupplierGui\Communication\SupplierGuiCommunicationFactory getFactory()
 */
class CreateController extends AbstractController
{
    protected const string URL_SUPPLIER_OVERVIEW = '/supplier-gui';

    protected const string MESSAGE_SUPPLIER_CREATED_SUCCESS = 'Supplier was successfully created.';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|array
     */
    public function indexAction(Request $request): RedirectResponse|array
    {
        // TODO-1: Get a SupplierCreateForm instance through the factory
        // Hint: Use getFactory()->createSupplierCreateForm() and pass a new SupplierTransfer
        $supplierCreateForm = null;

        $supplierCreateForm->handleRequest($request);

        if ($supplierCreateForm->isSubmitted() && $supplierCreateForm->isValid()) {
            return $this->createSupplier($supplierCreateForm);
        }

        return $this->viewResponse([
            'supplierCreateForm' => '', // TODO-2: Pass the form view using $supplierCreateForm->createView()
            'backUrl' => $this->getSupplierOverviewUrl(),
        ]);
    }

    /**
     * @param \Symfony\Component\Form\FormInterface $supplierCreateForm
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function createSupplier(FormInterface $supplierCreateForm): RedirectResponse
    {
        /** @var \Generated\Shared\Transfer\SupplierTransfer|null $supplierTransfer */
        // TODO-3: Get the supplier data from the form using getData()
        $supplierTransfer = null;

        // TODO-4: Persist the supplier using getFactory()->getSupplierFacade()->createSupplier()
        $supplierTransfer = null;

        $this->addSuccessMessage(static::MESSAGE_SUPPLIER_CREATED_SUCCESS);

        // TODO-5: Return a redirect response to the supplier overview
        // Hint: Use $this->redirectResponse($this->getSupplierOverviewUrl())
    }

    /**
     * @return string
     */
    protected function getSupplierOverviewUrl(): string
    {
        return (string)Url::generate(static::URL_SUPPLIER_OVERVIEW);
    }
}
