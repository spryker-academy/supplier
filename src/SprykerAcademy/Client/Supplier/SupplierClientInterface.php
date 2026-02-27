<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerAcademy\Client\Supplier;

use Generated\Shared\Transfer\SupplierCollectionTransfer;
use Generated\Shared\Transfer\SupplierTransfer;

interface SupplierClientInterface
{
    /**
     * Specification:
     * - Retrieves suppliers from Elasticsearch.
     * - Returns a collection of suppliers.
     *
     * @api
     *
     * @param array<string, mixed> $requestParameters
     *
     * @return \Generated\Shared\Transfer\SupplierCollectionTransfer
     */
    public function getSuppliers(array $requestParameters = []): SupplierCollectionTransfer;

    /**
     * Specification:
     * - Finds a supplier by ID via ZedRequest RPC.
     * - Returns the supplier transfer if found.
     * - Returns an empty transfer if not found.
     *
     * @api
     *
     * @param int $idSupplier
     *
     * @return \Generated\Shared\Transfer\SupplierTransfer
     */
    public function findSupplierById(int $idSupplier): SupplierTransfer;
}
