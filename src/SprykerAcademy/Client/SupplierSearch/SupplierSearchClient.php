<?php

declare(strict_types=1);

namespace SprykerAcademy\Client\SupplierSearch;

use Generated\Shared\Transfer\SupplierCollectionTransfer;
use Generated\Shared\Transfer\SupplierTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \SprykerAcademy\Client\SupplierSearch\SupplierSearchFactory getFactory()
 */
class SupplierSearchClient extends AbstractClient implements SupplierSearchClientInterface
{
    public function searchSuppliers(array $requestParameters = []): SupplierCollectionTransfer
    {
        // TODO: Delegate to the reader: create it with the factory and call its searchSuppliers() with $requestParameters.

        return new SupplierCollectionTransfer();
    }

    public function findSupplierById(int $idSupplier): SupplierTransfer
    {
        return $this->getFactory()
            ->createSupplierSearchReader()
            ->findSupplierById($idSupplier);
    }
}
