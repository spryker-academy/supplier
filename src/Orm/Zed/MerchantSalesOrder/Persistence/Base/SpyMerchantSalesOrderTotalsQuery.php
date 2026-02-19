<?php

namespace Orm\Zed\MerchantSalesOrder\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderTotals as ChildSpyMerchantSalesOrderTotals;
use Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderTotalsQuery as ChildSpyMerchantSalesOrderTotalsQuery;
use Orm\Zed\MerchantSalesOrder\Persistence\Map\SpyMerchantSalesOrderTotalsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Spryker\Zed\PropelOrm\Business\Model\Formatter\TypeAwareSimpleArrayFormatter;
use Spryker\Zed\PropelOrm\Business\Runtime\ActiveQuery\Criteria as SprykerCriteria;
use Spryker\Zed\PropelReplicationCache\Business\PropelReplicationCacheFacade;
use Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException;

/**
 * Base class that represents a query for the `spy_merchant_sales_order_totals` table.
 *
 * @method     ChildSpyMerchantSalesOrderTotalsQuery orderByIdMerchantSalesOrderTotals($order = Criteria::ASC) Order by the id_merchant_sales_order_totals column
 * @method     ChildSpyMerchantSalesOrderTotalsQuery orderByFkMerchantSalesOrder($order = Criteria::ASC) Order by the fk_merchant_sales_order column
 * @method     ChildSpyMerchantSalesOrderTotalsQuery orderByCanceledTotal($order = Criteria::ASC) Order by the canceled_total column
 * @method     ChildSpyMerchantSalesOrderTotalsQuery orderByDiscountTotal($order = Criteria::ASC) Order by the discount_total column
 * @method     ChildSpyMerchantSalesOrderTotalsQuery orderByGrandTotal($order = Criteria::ASC) Order by the grand_total column
 * @method     ChildSpyMerchantSalesOrderTotalsQuery orderByMerchantCommissionRefundedTotal($order = Criteria::ASC) Order by the merchant_commission_refunded_total column
 * @method     ChildSpyMerchantSalesOrderTotalsQuery orderByMerchantCommissionTotal($order = Criteria::ASC) Order by the merchant_commission_total column
 * @method     ChildSpyMerchantSalesOrderTotalsQuery orderByOrderExpenseTotal($order = Criteria::ASC) Order by the order_expense_total column
 * @method     ChildSpyMerchantSalesOrderTotalsQuery orderByRefundTotal($order = Criteria::ASC) Order by the refund_total column
 * @method     ChildSpyMerchantSalesOrderTotalsQuery orderBySubtotal($order = Criteria::ASC) Order by the subtotal column
 * @method     ChildSpyMerchantSalesOrderTotalsQuery orderByTaxTotal($order = Criteria::ASC) Order by the tax_total column
 * @method     ChildSpyMerchantSalesOrderTotalsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpyMerchantSalesOrderTotalsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpyMerchantSalesOrderTotalsQuery groupByIdMerchantSalesOrderTotals() Group by the id_merchant_sales_order_totals column
 * @method     ChildSpyMerchantSalesOrderTotalsQuery groupByFkMerchantSalesOrder() Group by the fk_merchant_sales_order column
 * @method     ChildSpyMerchantSalesOrderTotalsQuery groupByCanceledTotal() Group by the canceled_total column
 * @method     ChildSpyMerchantSalesOrderTotalsQuery groupByDiscountTotal() Group by the discount_total column
 * @method     ChildSpyMerchantSalesOrderTotalsQuery groupByGrandTotal() Group by the grand_total column
 * @method     ChildSpyMerchantSalesOrderTotalsQuery groupByMerchantCommissionRefundedTotal() Group by the merchant_commission_refunded_total column
 * @method     ChildSpyMerchantSalesOrderTotalsQuery groupByMerchantCommissionTotal() Group by the merchant_commission_total column
 * @method     ChildSpyMerchantSalesOrderTotalsQuery groupByOrderExpenseTotal() Group by the order_expense_total column
 * @method     ChildSpyMerchantSalesOrderTotalsQuery groupByRefundTotal() Group by the refund_total column
 * @method     ChildSpyMerchantSalesOrderTotalsQuery groupBySubtotal() Group by the subtotal column
 * @method     ChildSpyMerchantSalesOrderTotalsQuery groupByTaxTotal() Group by the tax_total column
 * @method     ChildSpyMerchantSalesOrderTotalsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpyMerchantSalesOrderTotalsQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpyMerchantSalesOrderTotalsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyMerchantSalesOrderTotalsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyMerchantSalesOrderTotalsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyMerchantSalesOrderTotalsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyMerchantSalesOrderTotalsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyMerchantSalesOrderTotalsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyMerchantSalesOrderTotalsQuery leftJoinMerchantSalesOrder($relationAlias = null) Adds a LEFT JOIN clause to the query using the MerchantSalesOrder relation
 * @method     ChildSpyMerchantSalesOrderTotalsQuery rightJoinMerchantSalesOrder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MerchantSalesOrder relation
 * @method     ChildSpyMerchantSalesOrderTotalsQuery innerJoinMerchantSalesOrder($relationAlias = null) Adds a INNER JOIN clause to the query using the MerchantSalesOrder relation
 *
 * @method     ChildSpyMerchantSalesOrderTotalsQuery joinWithMerchantSalesOrder($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the MerchantSalesOrder relation
 *
 * @method     ChildSpyMerchantSalesOrderTotalsQuery leftJoinWithMerchantSalesOrder() Adds a LEFT JOIN clause and with to the query using the MerchantSalesOrder relation
 * @method     ChildSpyMerchantSalesOrderTotalsQuery rightJoinWithMerchantSalesOrder() Adds a RIGHT JOIN clause and with to the query using the MerchantSalesOrder relation
 * @method     ChildSpyMerchantSalesOrderTotalsQuery innerJoinWithMerchantSalesOrder() Adds a INNER JOIN clause and with to the query using the MerchantSalesOrder relation
 *
 * @method     \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyMerchantSalesOrderTotals|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyMerchantSalesOrderTotals matching the query
 * @method     ChildSpyMerchantSalesOrderTotals findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyMerchantSalesOrderTotals matching the query, or a new ChildSpyMerchantSalesOrderTotals object populated from the query conditions when no match is found
 *
 * @method     ChildSpyMerchantSalesOrderTotals|null findOneByIdMerchantSalesOrderTotals(int $id_merchant_sales_order_totals) Return the first ChildSpyMerchantSalesOrderTotals filtered by the id_merchant_sales_order_totals column
 * @method     ChildSpyMerchantSalesOrderTotals|null findOneByFkMerchantSalesOrder(int $fk_merchant_sales_order) Return the first ChildSpyMerchantSalesOrderTotals filtered by the fk_merchant_sales_order column
 * @method     ChildSpyMerchantSalesOrderTotals|null findOneByCanceledTotal(int $canceled_total) Return the first ChildSpyMerchantSalesOrderTotals filtered by the canceled_total column
 * @method     ChildSpyMerchantSalesOrderTotals|null findOneByDiscountTotal(int $discount_total) Return the first ChildSpyMerchantSalesOrderTotals filtered by the discount_total column
 * @method     ChildSpyMerchantSalesOrderTotals|null findOneByGrandTotal(int $grand_total) Return the first ChildSpyMerchantSalesOrderTotals filtered by the grand_total column
 * @method     ChildSpyMerchantSalesOrderTotals|null findOneByMerchantCommissionRefundedTotal(int $merchant_commission_refunded_total) Return the first ChildSpyMerchantSalesOrderTotals filtered by the merchant_commission_refunded_total column
 * @method     ChildSpyMerchantSalesOrderTotals|null findOneByMerchantCommissionTotal(int $merchant_commission_total) Return the first ChildSpyMerchantSalesOrderTotals filtered by the merchant_commission_total column
 * @method     ChildSpyMerchantSalesOrderTotals|null findOneByOrderExpenseTotal(int $order_expense_total) Return the first ChildSpyMerchantSalesOrderTotals filtered by the order_expense_total column
 * @method     ChildSpyMerchantSalesOrderTotals|null findOneByRefundTotal(int $refund_total) Return the first ChildSpyMerchantSalesOrderTotals filtered by the refund_total column
 * @method     ChildSpyMerchantSalesOrderTotals|null findOneBySubtotal(int $subtotal) Return the first ChildSpyMerchantSalesOrderTotals filtered by the subtotal column
 * @method     ChildSpyMerchantSalesOrderTotals|null findOneByTaxTotal(int $tax_total) Return the first ChildSpyMerchantSalesOrderTotals filtered by the tax_total column
 * @method     ChildSpyMerchantSalesOrderTotals|null findOneByCreatedAt(string $created_at) Return the first ChildSpyMerchantSalesOrderTotals filtered by the created_at column
 * @method     ChildSpyMerchantSalesOrderTotals|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpyMerchantSalesOrderTotals filtered by the updated_at column
 *
 * @method     ChildSpyMerchantSalesOrderTotals requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyMerchantSalesOrderTotals by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantSalesOrderTotals requireOne(?ConnectionInterface $con = null) Return the first ChildSpyMerchantSalesOrderTotals matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyMerchantSalesOrderTotals requireOneByIdMerchantSalesOrderTotals(int $id_merchant_sales_order_totals) Return the first ChildSpyMerchantSalesOrderTotals filtered by the id_merchant_sales_order_totals column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantSalesOrderTotals requireOneByFkMerchantSalesOrder(int $fk_merchant_sales_order) Return the first ChildSpyMerchantSalesOrderTotals filtered by the fk_merchant_sales_order column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantSalesOrderTotals requireOneByCanceledTotal(int $canceled_total) Return the first ChildSpyMerchantSalesOrderTotals filtered by the canceled_total column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantSalesOrderTotals requireOneByDiscountTotal(int $discount_total) Return the first ChildSpyMerchantSalesOrderTotals filtered by the discount_total column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantSalesOrderTotals requireOneByGrandTotal(int $grand_total) Return the first ChildSpyMerchantSalesOrderTotals filtered by the grand_total column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantSalesOrderTotals requireOneByMerchantCommissionRefundedTotal(int $merchant_commission_refunded_total) Return the first ChildSpyMerchantSalesOrderTotals filtered by the merchant_commission_refunded_total column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantSalesOrderTotals requireOneByMerchantCommissionTotal(int $merchant_commission_total) Return the first ChildSpyMerchantSalesOrderTotals filtered by the merchant_commission_total column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantSalesOrderTotals requireOneByOrderExpenseTotal(int $order_expense_total) Return the first ChildSpyMerchantSalesOrderTotals filtered by the order_expense_total column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantSalesOrderTotals requireOneByRefundTotal(int $refund_total) Return the first ChildSpyMerchantSalesOrderTotals filtered by the refund_total column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantSalesOrderTotals requireOneBySubtotal(int $subtotal) Return the first ChildSpyMerchantSalesOrderTotals filtered by the subtotal column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantSalesOrderTotals requireOneByTaxTotal(int $tax_total) Return the first ChildSpyMerchantSalesOrderTotals filtered by the tax_total column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantSalesOrderTotals requireOneByCreatedAt(string $created_at) Return the first ChildSpyMerchantSalesOrderTotals filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantSalesOrderTotals requireOneByUpdatedAt(string $updated_at) Return the first ChildSpyMerchantSalesOrderTotals filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyMerchantSalesOrderTotals[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyMerchantSalesOrderTotals objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyMerchantSalesOrderTotals> find(?ConnectionInterface $con = null) Return ChildSpyMerchantSalesOrderTotals objects based on current ModelCriteria
 *
 * @method     ChildSpyMerchantSalesOrderTotals[]|Collection findByIdMerchantSalesOrderTotals(int|array<int> $id_merchant_sales_order_totals) Return ChildSpyMerchantSalesOrderTotals objects filtered by the id_merchant_sales_order_totals column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantSalesOrderTotals> findByIdMerchantSalesOrderTotals(int|array<int> $id_merchant_sales_order_totals) Return ChildSpyMerchantSalesOrderTotals objects filtered by the id_merchant_sales_order_totals column
 * @method     ChildSpyMerchantSalesOrderTotals[]|Collection findByFkMerchantSalesOrder(int|array<int> $fk_merchant_sales_order) Return ChildSpyMerchantSalesOrderTotals objects filtered by the fk_merchant_sales_order column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantSalesOrderTotals> findByFkMerchantSalesOrder(int|array<int> $fk_merchant_sales_order) Return ChildSpyMerchantSalesOrderTotals objects filtered by the fk_merchant_sales_order column
 * @method     ChildSpyMerchantSalesOrderTotals[]|Collection findByCanceledTotal(int|array<int> $canceled_total) Return ChildSpyMerchantSalesOrderTotals objects filtered by the canceled_total column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantSalesOrderTotals> findByCanceledTotal(int|array<int> $canceled_total) Return ChildSpyMerchantSalesOrderTotals objects filtered by the canceled_total column
 * @method     ChildSpyMerchantSalesOrderTotals[]|Collection findByDiscountTotal(int|array<int> $discount_total) Return ChildSpyMerchantSalesOrderTotals objects filtered by the discount_total column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantSalesOrderTotals> findByDiscountTotal(int|array<int> $discount_total) Return ChildSpyMerchantSalesOrderTotals objects filtered by the discount_total column
 * @method     ChildSpyMerchantSalesOrderTotals[]|Collection findByGrandTotal(int|array<int> $grand_total) Return ChildSpyMerchantSalesOrderTotals objects filtered by the grand_total column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantSalesOrderTotals> findByGrandTotal(int|array<int> $grand_total) Return ChildSpyMerchantSalesOrderTotals objects filtered by the grand_total column
 * @method     ChildSpyMerchantSalesOrderTotals[]|Collection findByMerchantCommissionRefundedTotal(int|array<int> $merchant_commission_refunded_total) Return ChildSpyMerchantSalesOrderTotals objects filtered by the merchant_commission_refunded_total column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantSalesOrderTotals> findByMerchantCommissionRefundedTotal(int|array<int> $merchant_commission_refunded_total) Return ChildSpyMerchantSalesOrderTotals objects filtered by the merchant_commission_refunded_total column
 * @method     ChildSpyMerchantSalesOrderTotals[]|Collection findByMerchantCommissionTotal(int|array<int> $merchant_commission_total) Return ChildSpyMerchantSalesOrderTotals objects filtered by the merchant_commission_total column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantSalesOrderTotals> findByMerchantCommissionTotal(int|array<int> $merchant_commission_total) Return ChildSpyMerchantSalesOrderTotals objects filtered by the merchant_commission_total column
 * @method     ChildSpyMerchantSalesOrderTotals[]|Collection findByOrderExpenseTotal(int|array<int> $order_expense_total) Return ChildSpyMerchantSalesOrderTotals objects filtered by the order_expense_total column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantSalesOrderTotals> findByOrderExpenseTotal(int|array<int> $order_expense_total) Return ChildSpyMerchantSalesOrderTotals objects filtered by the order_expense_total column
 * @method     ChildSpyMerchantSalesOrderTotals[]|Collection findByRefundTotal(int|array<int> $refund_total) Return ChildSpyMerchantSalesOrderTotals objects filtered by the refund_total column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantSalesOrderTotals> findByRefundTotal(int|array<int> $refund_total) Return ChildSpyMerchantSalesOrderTotals objects filtered by the refund_total column
 * @method     ChildSpyMerchantSalesOrderTotals[]|Collection findBySubtotal(int|array<int> $subtotal) Return ChildSpyMerchantSalesOrderTotals objects filtered by the subtotal column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantSalesOrderTotals> findBySubtotal(int|array<int> $subtotal) Return ChildSpyMerchantSalesOrderTotals objects filtered by the subtotal column
 * @method     ChildSpyMerchantSalesOrderTotals[]|Collection findByTaxTotal(int|array<int> $tax_total) Return ChildSpyMerchantSalesOrderTotals objects filtered by the tax_total column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantSalesOrderTotals> findByTaxTotal(int|array<int> $tax_total) Return ChildSpyMerchantSalesOrderTotals objects filtered by the tax_total column
 * @method     ChildSpyMerchantSalesOrderTotals[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpyMerchantSalesOrderTotals objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantSalesOrderTotals> findByCreatedAt(string|array<string> $created_at) Return ChildSpyMerchantSalesOrderTotals objects filtered by the created_at column
 * @method     ChildSpyMerchantSalesOrderTotals[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyMerchantSalesOrderTotals objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantSalesOrderTotals> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyMerchantSalesOrderTotals objects filtered by the updated_at column
 *
 * @method     ChildSpyMerchantSalesOrderTotals[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyMerchantSalesOrderTotals> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyMerchantSalesOrderTotalsQuery extends ModelCriteria
{

    /**
     * @var bool
     */
    protected $isForUpdateEnabled = false;

    /**
     * @deprecated Use {@link \Propel\Runtime\ActiveQuery\Criteria::lockForUpdate()} instead.
     *
     * @param bool $isForUpdateEnabled
     *
     * @return $this The primary criteria object
     */
    public function forUpdate($isForUpdateEnabled)
    {
        $this->isForUpdateEnabled = $isForUpdateEnabled;

        return $this;
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function createSelectSql(&$params): string
    {
        $sql = parent::createSelectSql($params);
        if ($this->isForUpdateEnabled) {
            $sql .= ' FOR UPDATE';
        }

        return $sql;
    }

    /**
     * Clear the conditions to allow the reuse of the query object.
     * The ModelCriteria's Model and alias 'all the properties set by construct) will remain.
     *
     * @return $this The primary criteria object
     */
    public function clear()
    {
        parent::clear();

        $this->isSelfSelected = false;
        $this->forUpdate(false);

        return $this;
    }


    /**
     * @param int $affectedRows
     * @param \Propel\Runtime\Connection\ConnectionInterface $con
     *
     * @return int|null
     */
    protected function postUpdate(int $affectedRows, ConnectionInterface $con): ?int
    {
        $class = get_class($this);
        PropelReplicationCacheFacade::getInstance()->setKey($class);

        return null;
    }

    /**
     * @param int $affectedRows
     * @param \Propel\Runtime\Connection\ConnectionInterface $con
     *
     * @return int|null
     */
    protected function postDelete(int $affectedRows, ConnectionInterface $con): ?int
    {
        $class = get_class($this);
        PropelReplicationCacheFacade::getInstance()->setKey($class);

        return null;
    }

    /**
     * Issue a SELECT query based on the current ModelCriteria
     * and format the list of results with the current formatter
     * By default, returns an array of model objects
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con an optional connection object
     *
     * @return \Propel\Runtime\Collection\ObjectCollection|\Propel\Runtime\ActiveRecord\ActiveRecordInterface[]|mixed the list of results, formatted by the current formatter
     */
    public function find(?ConnectionInterface $con = null)
    {
        $class = get_class($this);
        $mustUseWriteContext = PropelReplicationCacheFacade::getInstance()->hasKey($class);

        if ($mustUseWriteContext) {
            $con = Propel::getWriteConnection($this->getDbName());
        } elseif ($con === null) {
            $con = Propel::getReadConnection($this->getDbName());
        }

        return parent::find($con);
    }

    /**
     * Issue a SELECT ... LIMIT 1 query based on the current ModelCriteria
     * and format the result with the current formatter
     * By default, returns a model object.
     *
     * Does not work with ->with()s containing one-to-many relations.
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con an optional connection object
     *
     * @return mixed the result, formatted by the current formatter
     */
    public function findOne(?ConnectionInterface $con = null)
    {
        $class = get_class($this);
        $mustUseWriteContext = PropelReplicationCacheFacade::getInstance()->hasKey($class);

        if ($mustUseWriteContext) {
            $con = Propel::getWriteConnection($this->getDbName());
        } elseif ($con === null) {
            $con = Propel::getReadConnection($this->getDbName());
        }

        return parent::findOne($con);
    }

    /**
     * Issue an existence check on the current ModelCriteria
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con an optional connection object
     *
     * @return bool column existence
     */
    public function exists(?ConnectionInterface $con = null): bool
    {
        $class = get_class($this);
        $mustUseWriteContext = PropelReplicationCacheFacade::getInstance()->hasKey($class);

        if ($mustUseWriteContext) {
            $con = Propel::getWriteConnection($this->getDbName());
        } elseif ($con === null) {
            $con = Propel::getReadConnection($this->getDbName());
        }

        return parent::exists($con);
    }

    /**
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return void
     */
    public function configureSelectColumns(): void
    {
        if (!$this->select) {
            return;
        }

        if ($this->formatter === null) {
            $this->setFormatter(new TypeAwareSimpleArrayFormatter());
        }

        parent::configureSelectColumns();
     }
        protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Orm\Zed\MerchantSalesOrder\Persistence\Base\SpyMerchantSalesOrderTotalsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\MerchantSalesOrder\\Persistence\\SpyMerchantSalesOrderTotals', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyMerchantSalesOrderTotalsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyMerchantSalesOrderTotalsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyMerchantSalesOrderTotalsQuery) {
            return $criteria;
        }
        $query = new ChildSpyMerchantSalesOrderTotalsQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildSpyMerchantSalesOrderTotals|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        $class = get_class($this);
        $mustUseWriteContext = PropelReplicationCacheFacade::getInstance()->hasKey($class);

        if ($mustUseWriteContext) {
            $con = Propel::getWriteConnection($this->getDbName());
        } elseif ($con === null) {
            $con = Propel::getReadConnection($this->getDbName());
        }


        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SpyMerchantSalesOrderTotalsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSpyMerchantSalesOrderTotals A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_merchant_sales_order_totals, fk_merchant_sales_order, canceled_total, discount_total, grand_total, merchant_commission_refunded_total, merchant_commission_total, order_expense_total, refund_total, subtotal, tax_total, created_at, updated_at FROM spy_merchant_sales_order_totals WHERE id_merchant_sales_order_totals = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildSpyMerchantSalesOrderTotals $obj */
            $obj = new ChildSpyMerchantSalesOrderTotals();
            $obj->hydrate($row);
            SpyMerchantSalesOrderTotalsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @return ChildSpyMerchantSalesOrderTotals|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return    Collection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        $class = get_class($this);
        $mustUseWriteContext = PropelReplicationCacheFacade::getInstance()->hasKey($class);

        if ($mustUseWriteContext) {
            $con = Propel::getWriteConnection($this->getDbName());
        } elseif ($con === null) {
            $con = Propel::getReadConnection($this->getDbName());
        }


        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }

        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param mixed $key Primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_ID_MERCHANT_SALES_ORDER_TOTALS, $key, Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param array|int $keys The list of primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_ID_MERCHANT_SALES_ORDER_TOTALS, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idMerchantSalesOrderTotals Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdMerchantSalesOrderTotals_Between(array $idMerchantSalesOrderTotals)
    {
        return $this->filterByIdMerchantSalesOrderTotals($idMerchantSalesOrderTotals, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idMerchantSalesOrderTotalss Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdMerchantSalesOrderTotals_In(array $idMerchantSalesOrderTotalss)
    {
        return $this->filterByIdMerchantSalesOrderTotals($idMerchantSalesOrderTotalss, Criteria::IN);
    }

    /**
     * Filter the query on the id_merchant_sales_order_totals column
     *
     * Example usage:
     * <code>
     * $query->filterByIdMerchantSalesOrderTotals(1234); // WHERE id_merchant_sales_order_totals = 1234
     * $query->filterByIdMerchantSalesOrderTotals(array(12, 34), Criteria::IN); // WHERE id_merchant_sales_order_totals IN (12, 34)
     * $query->filterByIdMerchantSalesOrderTotals(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_merchant_sales_order_totals > 12
     * </code>
     *
     * @param     mixed $idMerchantSalesOrderTotals The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdMerchantSalesOrderTotals($idMerchantSalesOrderTotals = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idMerchantSalesOrderTotals)) {
            $useMinMax = false;
            if (isset($idMerchantSalesOrderTotals['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_ID_MERCHANT_SALES_ORDER_TOTALS, $idMerchantSalesOrderTotals['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idMerchantSalesOrderTotals['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_ID_MERCHANT_SALES_ORDER_TOTALS, $idMerchantSalesOrderTotals['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idMerchantSalesOrderTotals of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_ID_MERCHANT_SALES_ORDER_TOTALS, $idMerchantSalesOrderTotals, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkMerchantSalesOrder Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkMerchantSalesOrder_Between(array $fkMerchantSalesOrder)
    {
        return $this->filterByFkMerchantSalesOrder($fkMerchantSalesOrder, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkMerchantSalesOrders Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkMerchantSalesOrder_In(array $fkMerchantSalesOrders)
    {
        return $this->filterByFkMerchantSalesOrder($fkMerchantSalesOrders, Criteria::IN);
    }

    /**
     * Filter the query on the fk_merchant_sales_order column
     *
     * Example usage:
     * <code>
     * $query->filterByFkMerchantSalesOrder(1234); // WHERE fk_merchant_sales_order = 1234
     * $query->filterByFkMerchantSalesOrder(array(12, 34), Criteria::IN); // WHERE fk_merchant_sales_order IN (12, 34)
     * $query->filterByFkMerchantSalesOrder(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_merchant_sales_order > 12
     * </code>
     *
     * @see       filterByMerchantSalesOrder()
     *
     * @param     mixed $fkMerchantSalesOrder The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkMerchantSalesOrder($fkMerchantSalesOrder = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkMerchantSalesOrder)) {
            $useMinMax = false;
            if (isset($fkMerchantSalesOrder['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_FK_MERCHANT_SALES_ORDER, $fkMerchantSalesOrder['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkMerchantSalesOrder['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_FK_MERCHANT_SALES_ORDER, $fkMerchantSalesOrder['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkMerchantSalesOrder of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_FK_MERCHANT_SALES_ORDER, $fkMerchantSalesOrder, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $canceledTotal Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCanceledTotal_Between(array $canceledTotal)
    {
        return $this->filterByCanceledTotal($canceledTotal, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $canceledTotals Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCanceledTotal_In(array $canceledTotals)
    {
        return $this->filterByCanceledTotal($canceledTotals, Criteria::IN);
    }

    /**
     * Filter the query on the canceled_total column
     *
     * Example usage:
     * <code>
     * $query->filterByCanceledTotal(1234); // WHERE canceled_total = 1234
     * $query->filterByCanceledTotal(array(12, 34), Criteria::IN); // WHERE canceled_total IN (12, 34)
     * $query->filterByCanceledTotal(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE canceled_total > 12
     * </code>
     *
     * @param     mixed $canceledTotal The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByCanceledTotal($canceledTotal = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($canceledTotal)) {
            $useMinMax = false;
            if (isset($canceledTotal['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_CANCELED_TOTAL, $canceledTotal['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($canceledTotal['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_CANCELED_TOTAL, $canceledTotal['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$canceledTotal of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_CANCELED_TOTAL, $canceledTotal, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $discountTotal Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDiscountTotal_Between(array $discountTotal)
    {
        return $this->filterByDiscountTotal($discountTotal, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $discountTotals Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDiscountTotal_In(array $discountTotals)
    {
        return $this->filterByDiscountTotal($discountTotals, Criteria::IN);
    }

    /**
     * Filter the query on the discount_total column
     *
     * Example usage:
     * <code>
     * $query->filterByDiscountTotal(1234); // WHERE discount_total = 1234
     * $query->filterByDiscountTotal(array(12, 34), Criteria::IN); // WHERE discount_total IN (12, 34)
     * $query->filterByDiscountTotal(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE discount_total > 12
     * </code>
     *
     * @param     mixed $discountTotal The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByDiscountTotal($discountTotal = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($discountTotal)) {
            $useMinMax = false;
            if (isset($discountTotal['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_DISCOUNT_TOTAL, $discountTotal['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($discountTotal['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_DISCOUNT_TOTAL, $discountTotal['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$discountTotal of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_DISCOUNT_TOTAL, $discountTotal, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $grandTotal Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGrandTotal_Between(array $grandTotal)
    {
        return $this->filterByGrandTotal($grandTotal, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $grandTotals Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGrandTotal_In(array $grandTotals)
    {
        return $this->filterByGrandTotal($grandTotals, Criteria::IN);
    }

    /**
     * Filter the query on the grand_total column
     *
     * Example usage:
     * <code>
     * $query->filterByGrandTotal(1234); // WHERE grand_total = 1234
     * $query->filterByGrandTotal(array(12, 34), Criteria::IN); // WHERE grand_total IN (12, 34)
     * $query->filterByGrandTotal(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE grand_total > 12
     * </code>
     *
     * @param     mixed $grandTotal The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByGrandTotal($grandTotal = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($grandTotal)) {
            $useMinMax = false;
            if (isset($grandTotal['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_GRAND_TOTAL, $grandTotal['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($grandTotal['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_GRAND_TOTAL, $grandTotal['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$grandTotal of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_GRAND_TOTAL, $grandTotal, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $merchantCommissionRefundedTotal Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMerchantCommissionRefundedTotal_Between(array $merchantCommissionRefundedTotal)
    {
        return $this->filterByMerchantCommissionRefundedTotal($merchantCommissionRefundedTotal, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $merchantCommissionRefundedTotals Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMerchantCommissionRefundedTotal_In(array $merchantCommissionRefundedTotals)
    {
        return $this->filterByMerchantCommissionRefundedTotal($merchantCommissionRefundedTotals, Criteria::IN);
    }

    /**
     * Filter the query on the merchant_commission_refunded_total column
     *
     * Example usage:
     * <code>
     * $query->filterByMerchantCommissionRefundedTotal(1234); // WHERE merchant_commission_refunded_total = 1234
     * $query->filterByMerchantCommissionRefundedTotal(array(12, 34), Criteria::IN); // WHERE merchant_commission_refunded_total IN (12, 34)
     * $query->filterByMerchantCommissionRefundedTotal(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE merchant_commission_refunded_total > 12
     * </code>
     *
     * @param     mixed $merchantCommissionRefundedTotal The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByMerchantCommissionRefundedTotal($merchantCommissionRefundedTotal = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($merchantCommissionRefundedTotal)) {
            $useMinMax = false;
            if (isset($merchantCommissionRefundedTotal['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_MERCHANT_COMMISSION_REFUNDED_TOTAL, $merchantCommissionRefundedTotal['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($merchantCommissionRefundedTotal['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_MERCHANT_COMMISSION_REFUNDED_TOTAL, $merchantCommissionRefundedTotal['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$merchantCommissionRefundedTotal of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_MERCHANT_COMMISSION_REFUNDED_TOTAL, $merchantCommissionRefundedTotal, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $merchantCommissionTotal Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMerchantCommissionTotal_Between(array $merchantCommissionTotal)
    {
        return $this->filterByMerchantCommissionTotal($merchantCommissionTotal, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $merchantCommissionTotals Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMerchantCommissionTotal_In(array $merchantCommissionTotals)
    {
        return $this->filterByMerchantCommissionTotal($merchantCommissionTotals, Criteria::IN);
    }

    /**
     * Filter the query on the merchant_commission_total column
     *
     * Example usage:
     * <code>
     * $query->filterByMerchantCommissionTotal(1234); // WHERE merchant_commission_total = 1234
     * $query->filterByMerchantCommissionTotal(array(12, 34), Criteria::IN); // WHERE merchant_commission_total IN (12, 34)
     * $query->filterByMerchantCommissionTotal(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE merchant_commission_total > 12
     * </code>
     *
     * @param     mixed $merchantCommissionTotal The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByMerchantCommissionTotal($merchantCommissionTotal = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($merchantCommissionTotal)) {
            $useMinMax = false;
            if (isset($merchantCommissionTotal['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_MERCHANT_COMMISSION_TOTAL, $merchantCommissionTotal['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($merchantCommissionTotal['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_MERCHANT_COMMISSION_TOTAL, $merchantCommissionTotal['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$merchantCommissionTotal of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_MERCHANT_COMMISSION_TOTAL, $merchantCommissionTotal, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $orderExpenseTotal Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderExpenseTotal_Between(array $orderExpenseTotal)
    {
        return $this->filterByOrderExpenseTotal($orderExpenseTotal, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $orderExpenseTotals Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderExpenseTotal_In(array $orderExpenseTotals)
    {
        return $this->filterByOrderExpenseTotal($orderExpenseTotals, Criteria::IN);
    }

    /**
     * Filter the query on the order_expense_total column
     *
     * Example usage:
     * <code>
     * $query->filterByOrderExpenseTotal(1234); // WHERE order_expense_total = 1234
     * $query->filterByOrderExpenseTotal(array(12, 34), Criteria::IN); // WHERE order_expense_total IN (12, 34)
     * $query->filterByOrderExpenseTotal(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE order_expense_total > 12
     * </code>
     *
     * @param     mixed $orderExpenseTotal The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByOrderExpenseTotal($orderExpenseTotal = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($orderExpenseTotal)) {
            $useMinMax = false;
            if (isset($orderExpenseTotal['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_ORDER_EXPENSE_TOTAL, $orderExpenseTotal['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orderExpenseTotal['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_ORDER_EXPENSE_TOTAL, $orderExpenseTotal['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$orderExpenseTotal of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_ORDER_EXPENSE_TOTAL, $orderExpenseTotal, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $refundTotal Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRefundTotal_Between(array $refundTotal)
    {
        return $this->filterByRefundTotal($refundTotal, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $refundTotals Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRefundTotal_In(array $refundTotals)
    {
        return $this->filterByRefundTotal($refundTotals, Criteria::IN);
    }

    /**
     * Filter the query on the refund_total column
     *
     * Example usage:
     * <code>
     * $query->filterByRefundTotal(1234); // WHERE refund_total = 1234
     * $query->filterByRefundTotal(array(12, 34), Criteria::IN); // WHERE refund_total IN (12, 34)
     * $query->filterByRefundTotal(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE refund_total > 12
     * </code>
     *
     * @param     mixed $refundTotal The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByRefundTotal($refundTotal = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($refundTotal)) {
            $useMinMax = false;
            if (isset($refundTotal['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_REFUND_TOTAL, $refundTotal['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($refundTotal['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_REFUND_TOTAL, $refundTotal['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$refundTotal of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_REFUND_TOTAL, $refundTotal, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $subtotal Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySubtotal_Between(array $subtotal)
    {
        return $this->filterBySubtotal($subtotal, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $subtotals Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySubtotal_In(array $subtotals)
    {
        return $this->filterBySubtotal($subtotals, Criteria::IN);
    }

    /**
     * Filter the query on the subtotal column
     *
     * Example usage:
     * <code>
     * $query->filterBySubtotal(1234); // WHERE subtotal = 1234
     * $query->filterBySubtotal(array(12, 34), Criteria::IN); // WHERE subtotal IN (12, 34)
     * $query->filterBySubtotal(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE subtotal > 12
     * </code>
     *
     * @param     mixed $subtotal The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterBySubtotal($subtotal = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($subtotal)) {
            $useMinMax = false;
            if (isset($subtotal['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_SUBTOTAL, $subtotal['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($subtotal['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_SUBTOTAL, $subtotal['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$subtotal of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_SUBTOTAL, $subtotal, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $taxTotal Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTaxTotal_Between(array $taxTotal)
    {
        return $this->filterByTaxTotal($taxTotal, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $taxTotals Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTaxTotal_In(array $taxTotals)
    {
        return $this->filterByTaxTotal($taxTotals, Criteria::IN);
    }

    /**
     * Filter the query on the tax_total column
     *
     * Example usage:
     * <code>
     * $query->filterByTaxTotal(1234); // WHERE tax_total = 1234
     * $query->filterByTaxTotal(array(12, 34), Criteria::IN); // WHERE tax_total IN (12, 34)
     * $query->filterByTaxTotal(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE tax_total > 12
     * </code>
     *
     * @param     mixed $taxTotal The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByTaxTotal($taxTotal = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($taxTotal)) {
            $useMinMax = false;
            if (isset($taxTotal['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_TAX_TOTAL, $taxTotal['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($taxTotal['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_TAX_TOTAL, $taxTotal['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$taxTotal of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_TAX_TOTAL, $taxTotal, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $createdAt Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCreatedAt_Between(array $createdAt)
    {
        return $this->filterByCreatedAt($createdAt, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $createdAts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCreatedAt_In(array $createdAts)
    {
        return $this->filterByCreatedAt($createdAts, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $createdAt Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCreatedAt_Like($createdAt)
    {
        return $this->filterByCreatedAt($createdAt, Criteria::LIKE);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday'), SprykerCriteria::BETWEEN); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByCreatedAt($createdAt = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_CREATED_AT, $createdAt, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $updatedAt Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUpdatedAt_Between(array $updatedAt)
    {
        return $this->filterByUpdatedAt($updatedAt, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $updatedAts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUpdatedAt_In(array $updatedAts)
    {
        return $this->filterByUpdatedAt($updatedAts, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $updatedAt Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUpdatedAt_Like($updatedAt)
    {
        return $this->filterByUpdatedAt($updatedAt, Criteria::LIKE);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday'), SprykerCriteria::BETWEEN); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrder object
     *
     * @param \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrder|ObjectCollection $spyMerchantSalesOrder The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMerchantSalesOrder($spyMerchantSalesOrder, ?string $comparison = null)
    {
        if ($spyMerchantSalesOrder instanceof \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrder) {
            return $this
                ->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_FK_MERCHANT_SALES_ORDER, $spyMerchantSalesOrder->getIdMerchantSalesOrder(), $comparison);
        } elseif ($spyMerchantSalesOrder instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_FK_MERCHANT_SALES_ORDER, $spyMerchantSalesOrder->toKeyValue('PrimaryKey', 'IdMerchantSalesOrder'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByMerchantSalesOrder() only accepts arguments of type \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrder or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MerchantSalesOrder relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinMerchantSalesOrder(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MerchantSalesOrder');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'MerchantSalesOrder');
        }

        return $this;
    }

    /**
     * Use the MerchantSalesOrder relation SpyMerchantSalesOrder object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderQuery A secondary query class using the current class as primary query
     */
    public function useMerchantSalesOrderQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMerchantSalesOrder($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MerchantSalesOrder', '\Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderQuery');
    }

    /**
     * Use the MerchantSalesOrder relation SpyMerchantSalesOrder object
     *
     * @param callable(\Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderQuery):\Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withMerchantSalesOrderQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useMerchantSalesOrderQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the MerchantSalesOrder relation to the SpyMerchantSalesOrder table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderQuery The inner query object of the EXISTS statement
     */
    public function useMerchantSalesOrderExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderQuery */
        $q = $this->useExistsQuery('MerchantSalesOrder', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the MerchantSalesOrder relation to the SpyMerchantSalesOrder table for a NOT EXISTS query.
     *
     * @see useMerchantSalesOrderExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderQuery The inner query object of the NOT EXISTS statement
     */
    public function useMerchantSalesOrderNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderQuery */
        $q = $this->useExistsQuery('MerchantSalesOrder', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the MerchantSalesOrder relation to the SpyMerchantSalesOrder table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderQuery The inner query object of the IN statement
     */
    public function useInMerchantSalesOrderQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderQuery */
        $q = $this->useInQuery('MerchantSalesOrder', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the MerchantSalesOrder relation to the SpyMerchantSalesOrder table for a NOT IN query.
     *
     * @see useMerchantSalesOrderInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderQuery The inner query object of the NOT IN statement
     */
    public function useNotInMerchantSalesOrderQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderQuery */
        $q = $this->useInQuery('MerchantSalesOrder', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyMerchantSalesOrderTotals $spyMerchantSalesOrderTotals Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyMerchantSalesOrderTotals = null)
    {
        if ($spyMerchantSalesOrderTotals) {
            $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_ID_MERCHANT_SALES_ORDER_TOTALS, $spyMerchantSalesOrderTotals->getIdMerchantSalesOrderTotals(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Code to execute before every SELECT statement
     *
     * @param ConnectionInterface $con The connection object used by the query
     */
    protected function basePreSelect(ConnectionInterface $con): void
    {
        // \Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior behavior
        // phpcs:ignoreFile
        /**
         * @var string|null $action
         */
        /** @var \Spryker\Zed\AclEntity\Business\AclEntityFacadeInterface $aclEntityFacade */
        $aclEntityFacade = \Spryker\Zed\Kernel\Locator::getInstance()->aclEntity()->facade();
        if ($aclEntityFacade->isActive() && !$this->isSegmentQuery()) {
            $aclEntityMetadataConfigRequestTransfer = new \Generated\Shared\Transfer\AclEntityMetadataConfigRequestTransfer();
            $aclEntityMetadataConfigRequestTransfer->setModelName($this->getModelName());
            $aclEntityConfigTransfer = $aclEntityFacade->getAclEntityMetadataConfig(true, $aclEntityMetadataConfigRequestTransfer);
            if (!in_array($this->getModelName(), $aclEntityConfigTransfer->getAclEntityAllowList())) {
                $this->getPersistenceFactory()
                    ->createAclQueryDirector($aclEntityConfigTransfer)
                    ->applyAclRuleOnSelectQuery($this);
            }
        }


        $this->preSelect($con);
    }

    /**
     * Code to execute before every DELETE statement
     *
     * @param ConnectionInterface $con The connection object used by the query
     * @return int|null
     */
    protected function basePreDelete(ConnectionInterface $con): ?int
    {
        // \Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior behavior
        // phpcs:ignoreFile
        /**
         * @var string|null $action
         */
        /** @var \Spryker\Zed\AclEntity\Business\AclEntityFacadeInterface $aclEntityFacade */
        $aclEntityFacade = \Spryker\Zed\Kernel\Locator::getInstance()->aclEntity()->facade();
        if ($aclEntityFacade->isActive() && !$this->isSegmentQuery()) {
            $aclEntityMetadataConfigRequestTransfer = new \Generated\Shared\Transfer\AclEntityMetadataConfigRequestTransfer();
            $aclEntityMetadataConfigRequestTransfer->setModelName($this->getModelName());
            $aclEntityConfigTransfer = $aclEntityFacade->getAclEntityMetadataConfig(true, $aclEntityMetadataConfigRequestTransfer);
            if (!in_array($this->getModelName(), $aclEntityConfigTransfer->getAclEntityAllowList())) {
                $this->getPersistenceFactory()
                    ->createAclQueryDirector($aclEntityConfigTransfer)
                    ->applyAclRuleOnDeleteQuery($this);
            }
        }


        return $this->preDelete($con);
    }

    /**
     * Code to execute before every UPDATE statement
     *
     * @param array $values The associative array of columns and values for the update
     * @param ConnectionInterface $con The connection object used by the query
     * @param bool $forceIndividualSaves If false (default), the resulting call is a Criteria::doUpdate(), otherwise it is a series of save() calls on all the found objects
     *
     * @return int|null
     */
    protected function basePreUpdate(&$values, ConnectionInterface $con, $forceIndividualSaves = false): ?int
    {
        // \Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior behavior
        // phpcs:ignoreFile
        /**
         * @var string|null $action
         */
        /** @var \Spryker\Zed\AclEntity\Business\AclEntityFacadeInterface $aclEntityFacade */
        $aclEntityFacade = \Spryker\Zed\Kernel\Locator::getInstance()->aclEntity()->facade();
        if ($aclEntityFacade->isActive() && !$this->isSegmentQuery()) {
            $aclEntityMetadataConfigRequestTransfer = new \Generated\Shared\Transfer\AclEntityMetadataConfigRequestTransfer();
            $aclEntityMetadataConfigRequestTransfer->setModelName($this->getModelName());
            $aclEntityConfigTransfer = $aclEntityFacade->getAclEntityMetadataConfig(true, $aclEntityMetadataConfigRequestTransfer);
            if (!in_array($this->getModelName(), $aclEntityConfigTransfer->getAclEntityAllowList())) {
                $this->getPersistenceFactory()
                    ->createAclQueryDirector($aclEntityConfigTransfer)
                    ->applyAclRuleOnUpdateQuery($this);
            }
        }


        return $this->preUpdate($values, $con, $forceIndividualSaves);
    }

    /**
     * Deletes all rows from the spy_merchant_sales_order_totals table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantSalesOrderTotalsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyMerchantSalesOrderTotalsTableMap::clearInstancePool();
            SpyMerchantSalesOrderTotalsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantSalesOrderTotalsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyMerchantSalesOrderTotalsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyMerchantSalesOrderTotalsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyMerchantSalesOrderTotalsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param int $nbDays Maximum age of the latest update in days
     *
     * @return $this The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyMerchantSalesOrderTotalsTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyMerchantSalesOrderTotalsTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyMerchantSalesOrderTotalsTableMap::COL_CREATED_AT);

        return $this;
    }

    /**
     * Filter by the latest created
     *
     * @param int $nbDays Maximum age of in days
     *
     * @return $this The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        $this->addUsingAlias(SpyMerchantSalesOrderTotalsTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyMerchantSalesOrderTotalsTableMap::COL_CREATED_AT);

        return $this;
    }

    // \Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior behavior
    // phpcs:ignoreFile
    /**
     * @return \Spryker\Zed\AclEntity\Persistence\AclEntityPersistenceFactory
     */
    protected function getPersistenceFactory(): \Spryker\Zed\AclEntity\Persistence\AclEntityPersistenceFactory
    {
        return (new \Spryker\Zed\Kernel\ClassResolver\Persistence\PersistenceFactoryResolver())
            ->resolve(\Spryker\Zed\AclEntity\Persistence\AclEntityPersistenceFactory::class);
    }
    // phpcs:ignoreFile
    /**
     * @return bool
     */
    protected function isSegmentQuery(): bool
    {
        $segmentTableTemplate = sprintf(
            \Spryker\Service\AclEntity\SegmentConnectorGenerator\SegmentConnectorGenerator::CONNECTOR_CLASS_TEMPLATE,
            \Spryker\Service\AclEntity\SegmentConnectorGenerator\SegmentConnectorGenerator::ENTITY_PREFIX_DEFAULT,
            ''
        );

        return strpos($this->getModelShortName(), $segmentTableTemplate) === 0;
    }

}
