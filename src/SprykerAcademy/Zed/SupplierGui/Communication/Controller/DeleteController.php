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

    public const string REQUEST_PARAM_ID_SUPPLIER = 'id-supplier';

    protected const string MESSAGE_SUPPLIER_DELETED_SUCCESS = 'Supplier was successfully deleted.';

    protected const string MESSAGE_SUPPLIER_DELETE_FAILED = 'Supplier could not be deleted.';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     */
    public function indexAction(Request $request): RedirectResponse
    {
        // TODO-1: Read the supplier id from the request query (REQUEST_PARAM_ID_SUPPLIER) with $this->castId().
        // TODO-2: Delete the supplier with the facade's deleteSupplier(), passing a SupplierTransfer with that id.
        //         Hint: $this->getFactory()->getSupplierFacade()
        //         Hint: wrap the call in try/catch (Throwable) - a foreign key can block the delete. On failure add
        //         MESSAGE_SUPPLIER_DELETE_FAILED as an error message and redirect to the overview.
        // TODO-3: Add MESSAGE_SUPPLIER_DELETED_SUCCESS as a success message.

        return $this->redirectResponse($this->getSupplierOverviewUrl());
    }

    protected function getSupplierOverviewUrl(): string
    {
        return (string)Url::generate(static::URL_SUPPLIER_OVERVIEW);
    }
}
