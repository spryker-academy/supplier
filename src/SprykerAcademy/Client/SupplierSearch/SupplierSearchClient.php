<?php

declare(strict_types=1);

namespace SprykerAcademy\Client\SupplierSearch;

use Generated\Shared\Transfer\SupplierCollectionTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \SprykerAcademy\Client\SupplierSearch\SupplierSearchFactory getFactory()
 */
class SupplierSearchClient extends AbstractClient implements SupplierSearchClientInterface
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
    public function searchSuppliers(array $requestParameters = []): SupplierCollectionTransfer
    {
        // TODO-1: Delegate to the SupplierSearchReader to search suppliers.
        // Hint-1: Use $this->getFactory()->createSupplierSearchReader()->searchSuppliers($requestParameters)

        return new SupplierCollectionTransfer();
    }
}
