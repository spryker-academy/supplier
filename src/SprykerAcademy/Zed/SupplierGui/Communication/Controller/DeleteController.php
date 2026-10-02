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
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Throwable;

/**
 * @method \SprykerAcademy\Zed\SupplierGui\Communication\SupplierGuiCommunicationFactory getFactory()
 */
class DeleteController extends AbstractController
{
    protected const string URL_SUPPLIER_OVERVIEW = '/supplier-gui';

    protected const string URL_SUPPLIER_DELETE = '/supplier-gui/delete';

    public const string REQUEST_PARAM_ID_SUPPLIER = 'id-supplier';

    protected const string MESSAGE_SUPPLIER_DELETED_SUCCESS = 'Supplier was successfully deleted.';

    protected const string MESSAGE_SUPPLIER_DELETE_FAILED = 'Supplier could not be deleted.';

    protected const string MESSAGE_SUPPLIER_NOT_FOUND = 'Supplier was not found.';

    protected const string MESSAGE_CONFIRM_DELETE = 'Confirm the deletion on the confirmation page.';

    /**
     * Confirmation page, opened by the Delete button of the table: names the supplier and warns that its
     * locations and merchant assignments are deleted too. Its form sends the DELETE request to indexAction().
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|array<string, mixed>
     */
    public function confirmAction(Request $request): RedirectResponse|array
    {
        $idSupplier = $this->castId($request->query->get(static::REQUEST_PARAM_ID_SUPPLIER));
        $supplierTransfer = $this->getFactory()->getSupplierFacade()->findSupplierById($idSupplier);

        if ($supplierTransfer === null) {
            $this->addErrorMessage(static::MESSAGE_SUPPLIER_NOT_FOUND);

            return $this->redirectResponse($this->getSupplierOverviewUrl());
        }

        $deleteUrl = (string)Url::generate(static::URL_SUPPLIER_DELETE, [static::REQUEST_PARAM_ID_SUPPLIER => $idSupplier]);

        return $this->viewResponse([
            'supplier' => $supplierTransfer,
            'deleteForm' => $this->getFactory()->createDeleteForm($deleteUrl)->createView(),
            'overviewUrl' => $this->getSupplierOverviewUrl(),
        ]);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     */
    public function indexAction(Request $request): RedirectResponse
    {
        // Deletes only what the confirmation page sent: a DELETE request with a valid CSRF token.
        $deleteForm = $this->getFactory()->createDeleteForm($request->getRequestUri())->handleRequest($request);

        if (!$deleteForm->isSubmitted() || !$deleteForm->isValid()) {
            $this->addErrorMessage(static::MESSAGE_CONFIRM_DELETE);

            return $this->redirectResponse($this->getSupplierOverviewUrl());
        }

        // TODO-1: Read the supplier id from the request query (REQUEST_PARAM_ID_SUPPLIER) with $this->castId().
        // TODO-2: Delete the supplier with the facade's deleteSupplier(), passing a SupplierTransfer with that id.
        //         Hint: $this->getFactory()->getSupplierFacade()
        //         Hint: wrap the call in try/catch (Throwable) - the facade also deletes the supplier's locations and
        //         merchant assignments, in one transaction; if anything fails, nothing is deleted. On failure add
        //         MESSAGE_SUPPLIER_DELETE_FAILED as an error message and redirect to the overview.
        // TODO-3: Add MESSAGE_SUPPLIER_DELETED_SUCCESS as a success message.

        return $this->redirectResponse($this->getSupplierOverviewUrl());
    }

    protected function getSupplierOverviewUrl(): string
    {
        return (string)Url::generate(static::URL_SUPPLIER_OVERVIEW);
    }
}
