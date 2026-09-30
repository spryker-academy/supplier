<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Zed\SupplierGui\Communication\Controller;

use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use SprykerAcademy\Zed\SupplierGui\Communication\Form\SupplierCreateForm;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Throwable;

/**
 * @method \SprykerAcademy\Zed\SupplierGui\Communication\SupplierGuiCommunicationFactory getFactory()
 */
class EditController extends AbstractController
{
    protected const string URL_SUPPLIER_OVERVIEW = '/supplier-gui';

    public const string REQUEST_PARAM_ID_SUPPLIER = 'id-supplier';

    protected const string MESSAGE_SUPPLIER_UPDATED_SUCCESS = 'Supplier was successfully updated.';

    protected const string MESSAGE_SUPPLIER_UPDATE_FAILED = 'Supplier could not be updated.';

    protected const int STATUS_ACTIVE = 1;

    protected const int STATUS_INACTIVE = 0;

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     */
    public function indexAction(Request $request): RedirectResponse|array
    {
        // TODO-1: Read the supplier id from the request query (REQUEST_PARAM_ID_SUPPLIER) with $this->castId()
        //         and load the supplier with the facade's findSupplierById().
        //         Hint: $this->getFactory()->getSupplierFacade()
        // TODO-2: When no supplier is found, add an error message and redirect to the overview.
        // TODO-3: Create the form with $this->getFactory()->createSupplierCreateForm(). Pass the supplier transfer,
        //         so the form is pre-filled, and [SupplierCreateForm::FIELD_IS_ACTIVE => true when its status is STATUS_ACTIVE]
        //         as options. Then let the form handle the request.
        // TODO-4: When the form is submitted and valid, return $this->updateSupplier($supplierCreateForm).
        // TODO-5: Otherwise return $this->viewResponse() with
        //         'supplierCreateForm' => $supplierCreateForm->createView() and 'backUrl' => $this->getSupplierOverviewUrl().

        return $this->redirectResponse($this->getSupplierOverviewUrl());
    }

    /**
     * @param \Symfony\Component\Form\FormInterface $supplierCreateForm
     */
    protected function updateSupplier(FormInterface $supplierCreateForm): RedirectResponse
    {
        // TODO-6: Get the SupplierTransfer from $supplierCreateForm->getData().
        // TODO-7: Set its status from the FIELD_IS_ACTIVE checkbox: STATUS_ACTIVE when checked, STATUS_INACTIVE otherwise.
        // TODO-8: Save it with the facade's updateSupplier().
        //         Hint: wrap the call in try/catch (Throwable); on failure add MESSAGE_SUPPLIER_UPDATE_FAILED as an
        //         error message and redirect to the overview.
        // TODO-9: Add MESSAGE_SUPPLIER_UPDATED_SUCCESS as a success message.

        return $this->redirectResponse($this->getSupplierOverviewUrl());
    }

    protected function getSupplierOverviewUrl(): string
    {
        return (string)Url::generate(static::URL_SUPPLIER_OVERVIEW);
    }
}
