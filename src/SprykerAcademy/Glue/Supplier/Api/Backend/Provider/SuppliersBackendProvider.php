<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Glue\Supplier\Api\Backend\Provider;

use Generated\Api\Backend\Suppliers\SuppliersPaginationBackendObject;
use Generated\Shared\Transfer\PaginationTransfer;
use Generated\Shared\Transfer\SupplierCriteriaTransfer;
use Spryker\ApiPlatform\State\Provider\AbstractBackendProvider;
use SprykerAcademy\Glue\Supplier\Processor\Mapper\SupplierBackendMapper;
use SprykerAcademy\Zed\Supplier\Business\SupplierFacadeInterface;

/**
 * Serves GET /suppliers and GET /suppliers/{idSupplier} of the Backend API. The Backend API runs
 * next to Zed, so it reads the database through the Supplier facade - not the published copy in
 * Elasticsearch that the Storefront API uses.
 */
class SuppliersBackendProvider extends AbstractBackendProvider
{
    protected const string QUERY_PARAMETER_PAGE = 'page';

    protected const string QUERY_PARAMETER_OFFSET = 'offset';

    protected const string QUERY_PARAMETER_LIMIT = 'limit';

    protected const int DEFAULT_LIMIT = 10;

    public function __construct(protected SupplierFacadeInterface $supplierFacade)
    {
    }

    /**
     * GET /suppliers/{idSupplier}
     */
    protected function provideItem(): ?object
    {
        $idSupplier = $this->getUriVariables()['idSupplier'] ?? null;

        if ($idSupplier === null) {
            return null;
        }

        $supplierTransfer = $this->supplierFacade->findSupplierById((int)$idSupplier);

        // Not found: API Platform answers with 404
        if ($supplierTransfer === null) {
            return null;
        }

        return (new SupplierBackendMapper())->mapSupplierTransferToSuppliersBackendResource($supplierTransfer);
    }

    /**
     * GET /suppliers?page[offset]=2&page[limit]=2
     *
     * @return array<\Generated\Api\Backend\SuppliersBackendResource>
     */
    protected function provideCollection(): array
    {
        $limit = $this->getPageParameter(
            static::QUERY_PARAMETER_LIMIT,
            $this->getOperation()->getPaginationItemsPerPage() ?? static::DEFAULT_LIMIT,
        );
        $offset = $this->getPageParameter(static::QUERY_PARAMETER_OFFSET, 0);

        // The database cuts the page out (LIMIT/OFFSET) and counts the total
        $supplierCriteriaTransfer = (new SupplierCriteriaTransfer())
            ->setPagination((new PaginationTransfer())->setOffset($offset)->setLimit($limit));

        $supplierCollectionTransfer = $this->supplierFacade->getPaginatedSupplierCollection($supplierCriteriaTransfer);

        $supplierBackendMapper = new SupplierBackendMapper();
        $resources = [];

        foreach ($supplierCollectionTransfer->getSuppliers() as $supplierTransfer) {
            $resources[] = $supplierBackendMapper->mapSupplierTransferToSuppliersBackendResource($supplierTransfer);
        }

        // The first item carries the pagination of the whole collection. Glue reads it there and
        // adds the first/prev/next/last links to the JSON:API response.
        if ($resources !== []) {
            $numFound = $supplierCollectionTransfer->getPagination()?->getNbResults() ?? count($resources);

            $resources[0]->pagination = SuppliersPaginationBackendObject::fromArray([
                'numFound' => $numFound,
                'currentPage' => intdiv($offset, $limit) + 1,
                'maxPage' => (int)ceil($numFound / $limit),
                'currentItemsPerPage' => $limit,
            ]);
        }

        return $resources;
    }

    /**
     * Reads ?page[offset]= or ?page[limit]=. AbstractStorefrontProvider has helpers for this,
     * AbstractBackendProvider does not, so the Backend provider reads the query itself.
     */
    protected function getPageParameter(string $name, int $default): int
    {
        if (!$this->hasRequest()) {
            return $default;
        }

        $page = $this->getRequest()->query->all()[static::QUERY_PARAMETER_PAGE] ?? [];

        if (!is_array($page) || !isset($page[$name])) {
            return $default;
        }

        // A limit of 0 or less would divide by zero; an offset below 0 is not a page
        return max((int)$page[$name], $name === static::QUERY_PARAMETER_LIMIT ? 1 : 0);
    }
}
