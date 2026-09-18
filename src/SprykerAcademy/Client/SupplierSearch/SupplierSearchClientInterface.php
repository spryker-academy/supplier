<?php

declare(strict_types=1);

namespace SprykerAcademy\Client\SupplierSearch;

use Generated\Shared\Transfer\SupplierCollectionTransfer;

interface SupplierSearchClientInterface
{
    /**
     * Specification:
     * - Searches for suppliers in Elasticsearch.
     * - Returns a collection of supplier transfers.
     *
     * @api
     *
     * @param array<string, mixed> $requestParameters
     *
     * @return \Generated\Shared\Transfer\SupplierCollectionTransfer
     */
    public function searchSuppliers(array $requestParameters = []): SupplierCollectionTransfer;
}
