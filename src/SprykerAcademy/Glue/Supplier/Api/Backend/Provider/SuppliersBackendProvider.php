<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Glue\Supplier\Api\Backend\Provider;

use Spryker\ApiPlatform\State\Provider\AbstractBackendProvider;
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
        // TODO-1: Read the supplier id from $this->getUriVariables().
        // TODO-2: Load the supplier with $this->supplierFacade->findSupplierById((int)$idSupplier).
        //         The facade returns null for an unknown id - return null then (404).
        // TODO-3: Map the SupplierTransfer to a SuppliersBackendResource with the provided SupplierBackendMapper.

        return null;
    }

    /**
     * GET /suppliers?page[offset]=2&page[limit]=2
     *
     * @return array<\Generated\Api\Backend\SuppliersBackendResource>
     */
    protected function provideCollection(): array
    {
        // TODO-4: Read the requested page with the provided getPageParameter():
        //         - the limit, default: $this->getOperation()->getPaginationItemsPerPage() ?? static::DEFAULT_LIMIT
        //         - the offset, default: 0
        // TODO-5: Load that page from the database: $this->supplierFacade->getPaginatedSupplierCollection()
        //         with a SupplierCriteriaTransfer whose PaginationTransfer has the offset and the limit.
        // TODO-6: Map every SupplierTransfer of getSuppliers() to a resource with the SupplierBackendMapper.
        // TODO-7: Set the pagination on the FIRST resource (if there is one).
        // Hint-1: $resources[0]->pagination = SuppliersPaginationBackendObject::fromArray([...])
        //         (Generated\Api\Backend\Suppliers\SuppliersPaginationBackendObject)
        // Hint-2: The keys: 'numFound' (getPagination()->getNbResults() of the collection transfer),
        //         'currentPage' (intdiv($offset, $limit) + 1), 'maxPage' ((int)ceil($numFound / $limit)),
        //         'currentItemsPerPage' ($limit).
        // Return a plain array: the include of the supplier locations only works on an array.

        return [];
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
