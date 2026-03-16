<?php

declare(strict_types=1);

namespace SprykerAcademy\Zed\SupplierMerchantPortalGui\Persistence;

use Generated\Shared\Transfer\GuiTableDataResponseTransfer;
use Generated\Shared\Transfer\GuiTableRowDataResponseTransfer;
use Generated\Shared\Transfer\SupplierMerchantPortalTableCriteriaTransfer;
use Orm\Zed\Supplier\Persistence\PyzSupplierQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \SprykerAcademy\Zed\SupplierMerchantPortalGui\Persistence\SupplierMerchantPortalGuiPersistenceFactory getFactory()
 */
class SupplierMerchantPortalGuiRepository extends AbstractRepository implements SupplierMerchantPortalGuiRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\SupplierMerchantPortalTableCriteriaTransfer $criteriaTransfer
     *
     * @return \Generated\Shared\Transfer\GuiTableDataResponseTransfer
     */
    public function getSupplierTableData(
        SupplierMerchantPortalTableCriteriaTransfer $criteriaTransfer,
    ): GuiTableDataResponseTransfer {
        $supplierQuery = $this->getFactory()->getSupplierPropelQuery();

        $supplierQuery = $this->applyMerchantFilter($supplierQuery, $criteriaTransfer);
        $supplierQuery = $this->applySearchFilter($supplierQuery, $criteriaTransfer);
        $supplierQuery = $this->applyStatusFilter($supplierQuery, $criteriaTransfer);

        $total = $supplierQuery->count();

        $supplierQuery = $this->applySorting($supplierQuery, $criteriaTransfer);
        $supplierQuery = $this->applyPagination($supplierQuery, $criteriaTransfer);

        $guiTableDataResponseTransfer = new GuiTableDataResponseTransfer();
        $guiTableDataResponseTransfer->setTotal($total);
        $guiTableDataResponseTransfer->setPage($criteriaTransfer->getPage() ?? 1);
        $guiTableDataResponseTransfer->setPageSize($criteriaTransfer->getPageSize() ?? 25);

        foreach ($supplierQuery->find() as $supplierEntity) {
            $rowData = [
                'idSupplier' => $supplierEntity->getIdSupplier(),
                'name' => $supplierEntity->getName(),
                'description' => $supplierEntity->getDescription(),
                'status' => $supplierEntity->getStatus(),
                'email' => $supplierEntity->getEmail(),
                'phone' => $supplierEntity->getPhone(),
            ];

            $guiTableDataResponseTransfer->addRow(
                (new GuiTableRowDataResponseTransfer())->setResponseData($rowData),
            );
        }

        return $guiTableDataResponseTransfer;
    }

    /**
     * @param \Orm\Zed\Supplier\Persistence\PyzSupplierQuery $supplierQuery
     * @param \Generated\Shared\Transfer\SupplierMerchantPortalTableCriteriaTransfer $criteriaTransfer
     *
     * @return \Orm\Zed\Supplier\Persistence\PyzSupplierQuery
     */
    protected function applyMerchantFilter(
        PyzSupplierQuery $supplierQuery,
        SupplierMerchantPortalTableCriteriaTransfer $criteriaTransfer,
    ): PyzSupplierQuery {
        $merchantReference = $criteriaTransfer->getMerchantReference();

        if ($merchantReference === null) {
            return $supplierQuery;
        }

        $supplierQuery
            ->usePyzMerchantToSupplierQuery()
                ->useSpyMerchantQuery()
                    ->filterByMerchantReference($merchantReference)
                ->endUse()
            ->endUse();

        return $supplierQuery;
    }

    /**
     * @param \Orm\Zed\Supplier\Persistence\PyzSupplierQuery $supplierQuery
     * @param \Generated\Shared\Transfer\SupplierMerchantPortalTableCriteriaTransfer $criteriaTransfer
     *
     * @return \Orm\Zed\Supplier\Persistence\PyzSupplierQuery
     */
    protected function applySearchFilter(
        PyzSupplierQuery $supplierQuery,
        SupplierMerchantPortalTableCriteriaTransfer $criteriaTransfer,
    ): PyzSupplierQuery {
        $searchTerm = $criteriaTransfer->getSearchTerm();

        if ($searchTerm === null || $searchTerm === '') {
            return $supplierQuery;
        }

        $term = '%' . $searchTerm . '%';
        $supplierQuery->where(
            '(pyz_supplier.name LIKE ? OR pyz_supplier.description LIKE ? OR pyz_supplier.email LIKE ?)',
            [$term, $term, $term],
        );

        return $supplierQuery;
    }

    /**
     * @param \Orm\Zed\Supplier\Persistence\PyzSupplierQuery $supplierQuery
     * @param \Generated\Shared\Transfer\SupplierMerchantPortalTableCriteriaTransfer $criteriaTransfer
     *
     * @return \Orm\Zed\Supplier\Persistence\PyzSupplierQuery
     */
    protected function applyStatusFilter(
        PyzSupplierQuery $supplierQuery,
        SupplierMerchantPortalTableCriteriaTransfer $criteriaTransfer,
    ): PyzSupplierQuery {
        $filterStatus = $criteriaTransfer->getFilterStatus();

        if ($filterStatus === null) {
            return $supplierQuery;
        }

        $supplierQuery->filterByStatus($filterStatus);

        return $supplierQuery;
    }

    /**
     * @param \Orm\Zed\Supplier\Persistence\PyzSupplierQuery $supplierQuery
     * @param \Generated\Shared\Transfer\SupplierMerchantPortalTableCriteriaTransfer $criteriaTransfer
     *
     * @return \Orm\Zed\Supplier\Persistence\PyzSupplierQuery
     */
    protected function applySorting(
        PyzSupplierQuery $supplierQuery,
        SupplierMerchantPortalTableCriteriaTransfer $criteriaTransfer,
    ): PyzSupplierQuery {
        $orderBy = $criteriaTransfer->getOrderBy();
        $orderDirection = $criteriaTransfer->getOrderDirection();

        if ($orderBy === null) {
            $supplierQuery->orderByIdSupplier(Criteria::DESC);

            return $supplierQuery;
        }

        $columnMap = [
            'name' => 'Name',
            'description' => 'Description',
            'status' => 'Status',
            'email' => 'Email',
            'phone' => 'Phone',
        ];

        $column = $columnMap[$orderBy] ?? 'IdSupplier';
        $direction = $orderDirection === 'asc' ? Criteria::ASC : Criteria::DESC;

        $supplierQuery->orderBy($column, $direction);

        return $supplierQuery;
    }

    /**
     * @param \Orm\Zed\Supplier\Persistence\PyzSupplierQuery $supplierQuery
     * @param \Generated\Shared\Transfer\SupplierMerchantPortalTableCriteriaTransfer $criteriaTransfer
     *
     * @return \Orm\Zed\Supplier\Persistence\PyzSupplierQuery
     */
    protected function applyPagination(
        PyzSupplierQuery $supplierQuery,
        SupplierMerchantPortalTableCriteriaTransfer $criteriaTransfer,
    ): PyzSupplierQuery {
        $page = $criteriaTransfer->getPage() ?? 1;
        $pageSize = $criteriaTransfer->getPageSize() ?? 25;

        $supplierQuery->setOffset(($page - 1) * $pageSize);
        $supplierQuery->setLimit($pageSize);

        return $supplierQuery;
    }
}
