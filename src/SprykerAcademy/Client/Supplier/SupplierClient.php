<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerAcademy\Client\Supplier;

use Generated\Shared\Transfer\SupplierCollectionTransfer;
use Generated\Shared\Transfer\SupplierCriteriaTransfer;
use Generated\Shared\Transfer\SupplierTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \SprykerAcademy\Client\Supplier\SupplierFactory getFactory()
 */
class SupplierClient extends AbstractClient implements SupplierClientInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<string, mixed> $requestParameters
     *
     * @return \Generated\Shared\Transfer\SupplierCollectionTransfer
     */
    public function getSuppliers(array $requestParameters = []): SupplierCollectionTransfer
    {
        // TODO-1: Get suppliers from Elasticsearch via SupplierSearchClient.
        // Hint-1: Use $this->getFactory()->getSupplierSearchClient()->searchSuppliers($requestParameters)
        // Hint-2: This is used for the collection endpoint (GET /suppliers)

        return new SupplierCollectionTransfer();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idSupplier
     *
     * @return \Generated\Shared\Transfer\SupplierTransfer
     */
    public function findSupplierById(int $idSupplier): SupplierTransfer
    {
        // TODO-2: Find a supplier by ID via ZedRequest RPC.
        // Hint-1: Create a new SupplierCriteriaTransfer and set the ID using setIdSupplier($idSupplier)
        // Hint-2: Call $this->getFactory()->createSupplierStub()->findSupplierById($criteriaTransfer)
        // Hint-3: This is used for the single item endpoint (GET /suppliers/{id})

        return new SupplierTransfer();
    }
}
