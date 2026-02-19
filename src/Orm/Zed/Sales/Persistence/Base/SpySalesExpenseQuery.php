<?php

namespace Orm\Zed\Sales\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\Sales\Persistence\SpySalesExpense as ChildSpySalesExpense;
use Orm\Zed\Sales\Persistence\SpySalesExpenseQuery as ChildSpySalesExpenseQuery;
use Orm\Zed\Sales\Persistence\Map\SpySalesExpenseTableMap;
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
 * Base class that represents a query for the `spy_sales_expense` table.
 *
 * @method     ChildSpySalesExpenseQuery orderByIdSalesExpense($order = Criteria::ASC) Order by the id_sales_expense column
 * @method     ChildSpySalesExpenseQuery orderByFkSalesOrder($order = Criteria::ASC) Order by the fk_sales_order column
 * @method     ChildSpySalesExpenseQuery orderByCanceledAmount($order = Criteria::ASC) Order by the canceled_amount column
 * @method     ChildSpySalesExpenseQuery orderByDiscountAmountAggregation($order = Criteria::ASC) Order by the discount_amount_aggregation column
 * @method     ChildSpySalesExpenseQuery orderByGrossPrice($order = Criteria::ASC) Order by the gross_price column
 * @method     ChildSpySalesExpenseQuery orderByMerchantReference($order = Criteria::ASC) Order by the merchant_reference column
 * @method     ChildSpySalesExpenseQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildSpySalesExpenseQuery orderByNetPrice($order = Criteria::ASC) Order by the net_price column
 * @method     ChildSpySalesExpenseQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     ChildSpySalesExpenseQuery orderByPriceToPayAggregation($order = Criteria::ASC) Order by the price_to_pay_aggregation column
 * @method     ChildSpySalesExpenseQuery orderByRefundableAmount($order = Criteria::ASC) Order by the refundable_amount column
 * @method     ChildSpySalesExpenseQuery orderByTaxAmount($order = Criteria::ASC) Order by the tax_amount column
 * @method     ChildSpySalesExpenseQuery orderByTaxAmountAfterCancellation($order = Criteria::ASC) Order by the tax_amount_after_cancellation column
 * @method     ChildSpySalesExpenseQuery orderByTaxRate($order = Criteria::ASC) Order by the tax_rate column
 * @method     ChildSpySalesExpenseQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method     ChildSpySalesExpenseQuery orderByUuid($order = Criteria::ASC) Order by the uuid column
 * @method     ChildSpySalesExpenseQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpySalesExpenseQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpySalesExpenseQuery groupByIdSalesExpense() Group by the id_sales_expense column
 * @method     ChildSpySalesExpenseQuery groupByFkSalesOrder() Group by the fk_sales_order column
 * @method     ChildSpySalesExpenseQuery groupByCanceledAmount() Group by the canceled_amount column
 * @method     ChildSpySalesExpenseQuery groupByDiscountAmountAggregation() Group by the discount_amount_aggregation column
 * @method     ChildSpySalesExpenseQuery groupByGrossPrice() Group by the gross_price column
 * @method     ChildSpySalesExpenseQuery groupByMerchantReference() Group by the merchant_reference column
 * @method     ChildSpySalesExpenseQuery groupByName() Group by the name column
 * @method     ChildSpySalesExpenseQuery groupByNetPrice() Group by the net_price column
 * @method     ChildSpySalesExpenseQuery groupByPrice() Group by the price column
 * @method     ChildSpySalesExpenseQuery groupByPriceToPayAggregation() Group by the price_to_pay_aggregation column
 * @method     ChildSpySalesExpenseQuery groupByRefundableAmount() Group by the refundable_amount column
 * @method     ChildSpySalesExpenseQuery groupByTaxAmount() Group by the tax_amount column
 * @method     ChildSpySalesExpenseQuery groupByTaxAmountAfterCancellation() Group by the tax_amount_after_cancellation column
 * @method     ChildSpySalesExpenseQuery groupByTaxRate() Group by the tax_rate column
 * @method     ChildSpySalesExpenseQuery groupByType() Group by the type column
 * @method     ChildSpySalesExpenseQuery groupByUuid() Group by the uuid column
 * @method     ChildSpySalesExpenseQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpySalesExpenseQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpySalesExpenseQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpySalesExpenseQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpySalesExpenseQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpySalesExpenseQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpySalesExpenseQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpySalesExpenseQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpySalesExpenseQuery leftJoinOrder($relationAlias = null) Adds a LEFT JOIN clause to the query using the Order relation
 * @method     ChildSpySalesExpenseQuery rightJoinOrder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Order relation
 * @method     ChildSpySalesExpenseQuery innerJoinOrder($relationAlias = null) Adds a INNER JOIN clause to the query using the Order relation
 *
 * @method     ChildSpySalesExpenseQuery joinWithOrder($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Order relation
 *
 * @method     ChildSpySalesExpenseQuery leftJoinWithOrder() Adds a LEFT JOIN clause and with to the query using the Order relation
 * @method     ChildSpySalesExpenseQuery rightJoinWithOrder() Adds a RIGHT JOIN clause and with to the query using the Order relation
 * @method     ChildSpySalesExpenseQuery innerJoinWithOrder() Adds a INNER JOIN clause and with to the query using the Order relation
 *
 * @method     ChildSpySalesExpenseQuery leftJoinDiscount($relationAlias = null) Adds a LEFT JOIN clause to the query using the Discount relation
 * @method     ChildSpySalesExpenseQuery rightJoinDiscount($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Discount relation
 * @method     ChildSpySalesExpenseQuery innerJoinDiscount($relationAlias = null) Adds a INNER JOIN clause to the query using the Discount relation
 *
 * @method     ChildSpySalesExpenseQuery joinWithDiscount($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Discount relation
 *
 * @method     ChildSpySalesExpenseQuery leftJoinWithDiscount() Adds a LEFT JOIN clause and with to the query using the Discount relation
 * @method     ChildSpySalesExpenseQuery rightJoinWithDiscount() Adds a RIGHT JOIN clause and with to the query using the Discount relation
 * @method     ChildSpySalesExpenseQuery innerJoinWithDiscount() Adds a INNER JOIN clause and with to the query using the Discount relation
 *
 * @method     ChildSpySalesExpenseQuery leftJoinSpySalesShipment($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpySalesShipment relation
 * @method     ChildSpySalesExpenseQuery rightJoinSpySalesShipment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpySalesShipment relation
 * @method     ChildSpySalesExpenseQuery innerJoinSpySalesShipment($relationAlias = null) Adds a INNER JOIN clause to the query using the SpySalesShipment relation
 *
 * @method     ChildSpySalesExpenseQuery joinWithSpySalesShipment($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpySalesShipment relation
 *
 * @method     ChildSpySalesExpenseQuery leftJoinWithSpySalesShipment() Adds a LEFT JOIN clause and with to the query using the SpySalesShipment relation
 * @method     ChildSpySalesExpenseQuery rightJoinWithSpySalesShipment() Adds a RIGHT JOIN clause and with to the query using the SpySalesShipment relation
 * @method     ChildSpySalesExpenseQuery innerJoinWithSpySalesShipment() Adds a INNER JOIN clause and with to the query using the SpySalesShipment relation
 *
 * @method     \Orm\Zed\Sales\Persistence\SpySalesOrderQuery|\Orm\Zed\Sales\Persistence\SpySalesDiscountQuery|\Orm\Zed\Sales\Persistence\SpySalesShipmentQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpySalesExpense|null findOne(?ConnectionInterface $con = null) Return the first ChildSpySalesExpense matching the query
 * @method     ChildSpySalesExpense findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpySalesExpense matching the query, or a new ChildSpySalesExpense object populated from the query conditions when no match is found
 *
 * @method     ChildSpySalesExpense|null findOneByIdSalesExpense(int $id_sales_expense) Return the first ChildSpySalesExpense filtered by the id_sales_expense column
 * @method     ChildSpySalesExpense|null findOneByFkSalesOrder(int $fk_sales_order) Return the first ChildSpySalesExpense filtered by the fk_sales_order column
 * @method     ChildSpySalesExpense|null findOneByCanceledAmount(int $canceled_amount) Return the first ChildSpySalesExpense filtered by the canceled_amount column
 * @method     ChildSpySalesExpense|null findOneByDiscountAmountAggregation(int $discount_amount_aggregation) Return the first ChildSpySalesExpense filtered by the discount_amount_aggregation column
 * @method     ChildSpySalesExpense|null findOneByGrossPrice(int $gross_price) Return the first ChildSpySalesExpense filtered by the gross_price column
 * @method     ChildSpySalesExpense|null findOneByMerchantReference(string $merchant_reference) Return the first ChildSpySalesExpense filtered by the merchant_reference column
 * @method     ChildSpySalesExpense|null findOneByName(string $name) Return the first ChildSpySalesExpense filtered by the name column
 * @method     ChildSpySalesExpense|null findOneByNetPrice(int $net_price) Return the first ChildSpySalesExpense filtered by the net_price column
 * @method     ChildSpySalesExpense|null findOneByPrice(int $price) Return the first ChildSpySalesExpense filtered by the price column
 * @method     ChildSpySalesExpense|null findOneByPriceToPayAggregation(int $price_to_pay_aggregation) Return the first ChildSpySalesExpense filtered by the price_to_pay_aggregation column
 * @method     ChildSpySalesExpense|null findOneByRefundableAmount(int $refundable_amount) Return the first ChildSpySalesExpense filtered by the refundable_amount column
 * @method     ChildSpySalesExpense|null findOneByTaxAmount(int $tax_amount) Return the first ChildSpySalesExpense filtered by the tax_amount column
 * @method     ChildSpySalesExpense|null findOneByTaxAmountAfterCancellation(int $tax_amount_after_cancellation) Return the first ChildSpySalesExpense filtered by the tax_amount_after_cancellation column
 * @method     ChildSpySalesExpense|null findOneByTaxRate(string $tax_rate) Return the first ChildSpySalesExpense filtered by the tax_rate column
 * @method     ChildSpySalesExpense|null findOneByType(string $type) Return the first ChildSpySalesExpense filtered by the type column
 * @method     ChildSpySalesExpense|null findOneByUuid(string $uuid) Return the first ChildSpySalesExpense filtered by the uuid column
 * @method     ChildSpySalesExpense|null findOneByCreatedAt(string $created_at) Return the first ChildSpySalesExpense filtered by the created_at column
 * @method     ChildSpySalesExpense|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpySalesExpense filtered by the updated_at column
 *
 * @method     ChildSpySalesExpense requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpySalesExpense by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesExpense requireOne(?ConnectionInterface $con = null) Return the first ChildSpySalesExpense matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpySalesExpense requireOneByIdSalesExpense(int $id_sales_expense) Return the first ChildSpySalesExpense filtered by the id_sales_expense column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesExpense requireOneByFkSalesOrder(int $fk_sales_order) Return the first ChildSpySalesExpense filtered by the fk_sales_order column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesExpense requireOneByCanceledAmount(int $canceled_amount) Return the first ChildSpySalesExpense filtered by the canceled_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesExpense requireOneByDiscountAmountAggregation(int $discount_amount_aggregation) Return the first ChildSpySalesExpense filtered by the discount_amount_aggregation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesExpense requireOneByGrossPrice(int $gross_price) Return the first ChildSpySalesExpense filtered by the gross_price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesExpense requireOneByMerchantReference(string $merchant_reference) Return the first ChildSpySalesExpense filtered by the merchant_reference column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesExpense requireOneByName(string $name) Return the first ChildSpySalesExpense filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesExpense requireOneByNetPrice(int $net_price) Return the first ChildSpySalesExpense filtered by the net_price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesExpense requireOneByPrice(int $price) Return the first ChildSpySalesExpense filtered by the price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesExpense requireOneByPriceToPayAggregation(int $price_to_pay_aggregation) Return the first ChildSpySalesExpense filtered by the price_to_pay_aggregation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesExpense requireOneByRefundableAmount(int $refundable_amount) Return the first ChildSpySalesExpense filtered by the refundable_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesExpense requireOneByTaxAmount(int $tax_amount) Return the first ChildSpySalesExpense filtered by the tax_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesExpense requireOneByTaxAmountAfterCancellation(int $tax_amount_after_cancellation) Return the first ChildSpySalesExpense filtered by the tax_amount_after_cancellation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesExpense requireOneByTaxRate(string $tax_rate) Return the first ChildSpySalesExpense filtered by the tax_rate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesExpense requireOneByType(string $type) Return the first ChildSpySalesExpense filtered by the type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesExpense requireOneByUuid(string $uuid) Return the first ChildSpySalesExpense filtered by the uuid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesExpense requireOneByCreatedAt(string $created_at) Return the first ChildSpySalesExpense filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesExpense requireOneByUpdatedAt(string $updated_at) Return the first ChildSpySalesExpense filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpySalesExpense[]|Collection find(?ConnectionInterface $con = null) Return ChildSpySalesExpense objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpySalesExpense> find(?ConnectionInterface $con = null) Return ChildSpySalesExpense objects based on current ModelCriteria
 *
 * @method     ChildSpySalesExpense[]|Collection findByIdSalesExpense(int|array<int> $id_sales_expense) Return ChildSpySalesExpense objects filtered by the id_sales_expense column
 * @psalm-method Collection&\Traversable<ChildSpySalesExpense> findByIdSalesExpense(int|array<int> $id_sales_expense) Return ChildSpySalesExpense objects filtered by the id_sales_expense column
 * @method     ChildSpySalesExpense[]|Collection findByFkSalesOrder(int|array<int> $fk_sales_order) Return ChildSpySalesExpense objects filtered by the fk_sales_order column
 * @psalm-method Collection&\Traversable<ChildSpySalesExpense> findByFkSalesOrder(int|array<int> $fk_sales_order) Return ChildSpySalesExpense objects filtered by the fk_sales_order column
 * @method     ChildSpySalesExpense[]|Collection findByCanceledAmount(int|array<int> $canceled_amount) Return ChildSpySalesExpense objects filtered by the canceled_amount column
 * @psalm-method Collection&\Traversable<ChildSpySalesExpense> findByCanceledAmount(int|array<int> $canceled_amount) Return ChildSpySalesExpense objects filtered by the canceled_amount column
 * @method     ChildSpySalesExpense[]|Collection findByDiscountAmountAggregation(int|array<int> $discount_amount_aggregation) Return ChildSpySalesExpense objects filtered by the discount_amount_aggregation column
 * @psalm-method Collection&\Traversable<ChildSpySalesExpense> findByDiscountAmountAggregation(int|array<int> $discount_amount_aggregation) Return ChildSpySalesExpense objects filtered by the discount_amount_aggregation column
 * @method     ChildSpySalesExpense[]|Collection findByGrossPrice(int|array<int> $gross_price) Return ChildSpySalesExpense objects filtered by the gross_price column
 * @psalm-method Collection&\Traversable<ChildSpySalesExpense> findByGrossPrice(int|array<int> $gross_price) Return ChildSpySalesExpense objects filtered by the gross_price column
 * @method     ChildSpySalesExpense[]|Collection findByMerchantReference(string|array<string> $merchant_reference) Return ChildSpySalesExpense objects filtered by the merchant_reference column
 * @psalm-method Collection&\Traversable<ChildSpySalesExpense> findByMerchantReference(string|array<string> $merchant_reference) Return ChildSpySalesExpense objects filtered by the merchant_reference column
 * @method     ChildSpySalesExpense[]|Collection findByName(string|array<string> $name) Return ChildSpySalesExpense objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildSpySalesExpense> findByName(string|array<string> $name) Return ChildSpySalesExpense objects filtered by the name column
 * @method     ChildSpySalesExpense[]|Collection findByNetPrice(int|array<int> $net_price) Return ChildSpySalesExpense objects filtered by the net_price column
 * @psalm-method Collection&\Traversable<ChildSpySalesExpense> findByNetPrice(int|array<int> $net_price) Return ChildSpySalesExpense objects filtered by the net_price column
 * @method     ChildSpySalesExpense[]|Collection findByPrice(int|array<int> $price) Return ChildSpySalesExpense objects filtered by the price column
 * @psalm-method Collection&\Traversable<ChildSpySalesExpense> findByPrice(int|array<int> $price) Return ChildSpySalesExpense objects filtered by the price column
 * @method     ChildSpySalesExpense[]|Collection findByPriceToPayAggregation(int|array<int> $price_to_pay_aggregation) Return ChildSpySalesExpense objects filtered by the price_to_pay_aggregation column
 * @psalm-method Collection&\Traversable<ChildSpySalesExpense> findByPriceToPayAggregation(int|array<int> $price_to_pay_aggregation) Return ChildSpySalesExpense objects filtered by the price_to_pay_aggregation column
 * @method     ChildSpySalesExpense[]|Collection findByRefundableAmount(int|array<int> $refundable_amount) Return ChildSpySalesExpense objects filtered by the refundable_amount column
 * @psalm-method Collection&\Traversable<ChildSpySalesExpense> findByRefundableAmount(int|array<int> $refundable_amount) Return ChildSpySalesExpense objects filtered by the refundable_amount column
 * @method     ChildSpySalesExpense[]|Collection findByTaxAmount(int|array<int> $tax_amount) Return ChildSpySalesExpense objects filtered by the tax_amount column
 * @psalm-method Collection&\Traversable<ChildSpySalesExpense> findByTaxAmount(int|array<int> $tax_amount) Return ChildSpySalesExpense objects filtered by the tax_amount column
 * @method     ChildSpySalesExpense[]|Collection findByTaxAmountAfterCancellation(int|array<int> $tax_amount_after_cancellation) Return ChildSpySalesExpense objects filtered by the tax_amount_after_cancellation column
 * @psalm-method Collection&\Traversable<ChildSpySalesExpense> findByTaxAmountAfterCancellation(int|array<int> $tax_amount_after_cancellation) Return ChildSpySalesExpense objects filtered by the tax_amount_after_cancellation column
 * @method     ChildSpySalesExpense[]|Collection findByTaxRate(string|array<string> $tax_rate) Return ChildSpySalesExpense objects filtered by the tax_rate column
 * @psalm-method Collection&\Traversable<ChildSpySalesExpense> findByTaxRate(string|array<string> $tax_rate) Return ChildSpySalesExpense objects filtered by the tax_rate column
 * @method     ChildSpySalesExpense[]|Collection findByType(string|array<string> $type) Return ChildSpySalesExpense objects filtered by the type column
 * @psalm-method Collection&\Traversable<ChildSpySalesExpense> findByType(string|array<string> $type) Return ChildSpySalesExpense objects filtered by the type column
 * @method     ChildSpySalesExpense[]|Collection findByUuid(string|array<string> $uuid) Return ChildSpySalesExpense objects filtered by the uuid column
 * @psalm-method Collection&\Traversable<ChildSpySalesExpense> findByUuid(string|array<string> $uuid) Return ChildSpySalesExpense objects filtered by the uuid column
 * @method     ChildSpySalesExpense[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpySalesExpense objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpySalesExpense> findByCreatedAt(string|array<string> $created_at) Return ChildSpySalesExpense objects filtered by the created_at column
 * @method     ChildSpySalesExpense[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpySalesExpense objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpySalesExpense> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpySalesExpense objects filtered by the updated_at column
 *
 * @method     ChildSpySalesExpense[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpySalesExpense> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpySalesExpenseQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\Sales\Persistence\Base\SpySalesExpenseQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\Sales\\Persistence\\SpySalesExpense', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpySalesExpenseQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpySalesExpenseQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpySalesExpenseQuery) {
            return $criteria;
        }
        $query = new ChildSpySalesExpenseQuery();
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
     * @return ChildSpySalesExpense|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpySalesExpenseTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpySalesExpense A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_sales_expense, fk_sales_order, canceled_amount, discount_amount_aggregation, gross_price, merchant_reference, name, net_price, price, price_to_pay_aggregation, refundable_amount, tax_amount, tax_amount_after_cancellation, tax_rate, type, uuid, created_at, updated_at FROM spy_sales_expense WHERE id_sales_expense = :p0';
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
            /** @var ChildSpySalesExpense $obj */
            $obj = new ChildSpySalesExpense();
            $obj->hydrate($row);
            SpySalesExpenseTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpySalesExpense|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpySalesExpenseTableMap::COL_ID_SALES_EXPENSE, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpySalesExpenseTableMap::COL_ID_SALES_EXPENSE, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idSalesExpense Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdSalesExpense_Between(array $idSalesExpense)
    {
        return $this->filterByIdSalesExpense($idSalesExpense, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idSalesExpenses Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdSalesExpense_In(array $idSalesExpenses)
    {
        return $this->filterByIdSalesExpense($idSalesExpenses, Criteria::IN);
    }

    /**
     * Filter the query on the id_sales_expense column
     *
     * Example usage:
     * <code>
     * $query->filterByIdSalesExpense(1234); // WHERE id_sales_expense = 1234
     * $query->filterByIdSalesExpense(array(12, 34), Criteria::IN); // WHERE id_sales_expense IN (12, 34)
     * $query->filterByIdSalesExpense(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_sales_expense > 12
     * </code>
     *
     * @param     mixed $idSalesExpense The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdSalesExpense($idSalesExpense = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idSalesExpense)) {
            $useMinMax = false;
            if (isset($idSalesExpense['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesExpenseTableMap::COL_ID_SALES_EXPENSE, $idSalesExpense['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idSalesExpense['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesExpenseTableMap::COL_ID_SALES_EXPENSE, $idSalesExpense['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idSalesExpense of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesExpenseTableMap::COL_ID_SALES_EXPENSE, $idSalesExpense, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkSalesOrder Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkSalesOrder_Between(array $fkSalesOrder)
    {
        return $this->filterByFkSalesOrder($fkSalesOrder, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkSalesOrders Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkSalesOrder_In(array $fkSalesOrders)
    {
        return $this->filterByFkSalesOrder($fkSalesOrders, Criteria::IN);
    }

    /**
     * Filter the query on the fk_sales_order column
     *
     * Example usage:
     * <code>
     * $query->filterByFkSalesOrder(1234); // WHERE fk_sales_order = 1234
     * $query->filterByFkSalesOrder(array(12, 34), Criteria::IN); // WHERE fk_sales_order IN (12, 34)
     * $query->filterByFkSalesOrder(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_sales_order > 12
     * </code>
     *
     * @see       filterByOrder()
     *
     * @param     mixed $fkSalesOrder The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkSalesOrder($fkSalesOrder = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkSalesOrder)) {
            $useMinMax = false;
            if (isset($fkSalesOrder['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesExpenseTableMap::COL_FK_SALES_ORDER, $fkSalesOrder['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkSalesOrder['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesExpenseTableMap::COL_FK_SALES_ORDER, $fkSalesOrder['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkSalesOrder of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesExpenseTableMap::COL_FK_SALES_ORDER, $fkSalesOrder, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $canceledAmount Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCanceledAmount_Between(array $canceledAmount)
    {
        return $this->filterByCanceledAmount($canceledAmount, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $canceledAmounts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCanceledAmount_In(array $canceledAmounts)
    {
        return $this->filterByCanceledAmount($canceledAmounts, Criteria::IN);
    }

    /**
     * Filter the query on the canceled_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByCanceledAmount(1234); // WHERE canceled_amount = 1234
     * $query->filterByCanceledAmount(array(12, 34), Criteria::IN); // WHERE canceled_amount IN (12, 34)
     * $query->filterByCanceledAmount(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE canceled_amount > 12
     * </code>
     *
     * @param     mixed $canceledAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByCanceledAmount($canceledAmount = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($canceledAmount)) {
            $useMinMax = false;
            if (isset($canceledAmount['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesExpenseTableMap::COL_CANCELED_AMOUNT, $canceledAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($canceledAmount['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesExpenseTableMap::COL_CANCELED_AMOUNT, $canceledAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$canceledAmount of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesExpenseTableMap::COL_CANCELED_AMOUNT, $canceledAmount, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $discountAmountAggregation Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDiscountAmountAggregation_Between(array $discountAmountAggregation)
    {
        return $this->filterByDiscountAmountAggregation($discountAmountAggregation, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $discountAmountAggregations Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDiscountAmountAggregation_In(array $discountAmountAggregations)
    {
        return $this->filterByDiscountAmountAggregation($discountAmountAggregations, Criteria::IN);
    }

    /**
     * Filter the query on the discount_amount_aggregation column
     *
     * Example usage:
     * <code>
     * $query->filterByDiscountAmountAggregation(1234); // WHERE discount_amount_aggregation = 1234
     * $query->filterByDiscountAmountAggregation(array(12, 34), Criteria::IN); // WHERE discount_amount_aggregation IN (12, 34)
     * $query->filterByDiscountAmountAggregation(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE discount_amount_aggregation > 12
     * </code>
     *
     * @param     mixed $discountAmountAggregation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByDiscountAmountAggregation($discountAmountAggregation = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($discountAmountAggregation)) {
            $useMinMax = false;
            if (isset($discountAmountAggregation['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesExpenseTableMap::COL_DISCOUNT_AMOUNT_AGGREGATION, $discountAmountAggregation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($discountAmountAggregation['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesExpenseTableMap::COL_DISCOUNT_AMOUNT_AGGREGATION, $discountAmountAggregation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$discountAmountAggregation of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesExpenseTableMap::COL_DISCOUNT_AMOUNT_AGGREGATION, $discountAmountAggregation, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $grossPrice Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGrossPrice_Between(array $grossPrice)
    {
        return $this->filterByGrossPrice($grossPrice, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $grossPrices Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGrossPrice_In(array $grossPrices)
    {
        return $this->filterByGrossPrice($grossPrices, Criteria::IN);
    }

    /**
     * Filter the query on the gross_price column
     *
     * Example usage:
     * <code>
     * $query->filterByGrossPrice(1234); // WHERE gross_price = 1234
     * $query->filterByGrossPrice(array(12, 34), Criteria::IN); // WHERE gross_price IN (12, 34)
     * $query->filterByGrossPrice(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE gross_price > 12
     * </code>
     *
     * @param     mixed $grossPrice The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByGrossPrice($grossPrice = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($grossPrice)) {
            $useMinMax = false;
            if (isset($grossPrice['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesExpenseTableMap::COL_GROSS_PRICE, $grossPrice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($grossPrice['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesExpenseTableMap::COL_GROSS_PRICE, $grossPrice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$grossPrice of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesExpenseTableMap::COL_GROSS_PRICE, $grossPrice, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $merchantReferences Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMerchantReference_In(array $merchantReferences)
    {
        return $this->filterByMerchantReference($merchantReferences, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $merchantReference Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMerchantReference_Like($merchantReference)
    {
        return $this->filterByMerchantReference($merchantReference, Criteria::LIKE);
    }

    /**
     * Filter the query on the merchant_reference column
     *
     * Example usage:
     * <code>
     * $query->filterByMerchantReference('fooValue');   // WHERE merchant_reference = 'fooValue'
     * $query->filterByMerchantReference('%fooValue%', Criteria::LIKE); // WHERE merchant_reference LIKE '%fooValue%'
     * $query->filterByMerchantReference([1, 'foo'], Criteria::IN); // WHERE merchant_reference IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $merchantReference The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByMerchantReference($merchantReference = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $merchantReference = str_replace('*', '%', $merchantReference);
        }

        if (is_array($merchantReference) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$merchantReference of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesExpenseTableMap::COL_MERCHANT_REFERENCE, $merchantReference, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $names Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByName_In(array $names)
    {
        return $this->filterByName($names, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $name Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByName_Like($name)
    {
        return $this->filterByName($name, Criteria::LIKE);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * $query->filterByName([1, 'foo'], Criteria::IN); // WHERE name IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByName($name = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $name = str_replace('*', '%', $name);
        }

        if (is_array($name) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$name of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesExpenseTableMap::COL_NAME, $name, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $netPrice Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNetPrice_Between(array $netPrice)
    {
        return $this->filterByNetPrice($netPrice, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $netPrices Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNetPrice_In(array $netPrices)
    {
        return $this->filterByNetPrice($netPrices, Criteria::IN);
    }

    /**
     * Filter the query on the net_price column
     *
     * Example usage:
     * <code>
     * $query->filterByNetPrice(1234); // WHERE net_price = 1234
     * $query->filterByNetPrice(array(12, 34), Criteria::IN); // WHERE net_price IN (12, 34)
     * $query->filterByNetPrice(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE net_price > 12
     * </code>
     *
     * @param     mixed $netPrice The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByNetPrice($netPrice = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($netPrice)) {
            $useMinMax = false;
            if (isset($netPrice['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesExpenseTableMap::COL_NET_PRICE, $netPrice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($netPrice['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesExpenseTableMap::COL_NET_PRICE, $netPrice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$netPrice of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesExpenseTableMap::COL_NET_PRICE, $netPrice, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $price Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrice_Between(array $price)
    {
        return $this->filterByPrice($price, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $prices Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrice_In(array $prices)
    {
        return $this->filterByPrice($prices, Criteria::IN);
    }

    /**
     * Filter the query on the price column
     *
     * Example usage:
     * <code>
     * $query->filterByPrice(1234); // WHERE price = 1234
     * $query->filterByPrice(array(12, 34), Criteria::IN); // WHERE price IN (12, 34)
     * $query->filterByPrice(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE price > 12
     * </code>
     *
     * @param     mixed $price The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByPrice($price = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($price)) {
            $useMinMax = false;
            if (isset($price['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesExpenseTableMap::COL_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesExpenseTableMap::COL_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$price of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesExpenseTableMap::COL_PRICE, $price, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $priceToPayAggregation Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPriceToPayAggregation_Between(array $priceToPayAggregation)
    {
        return $this->filterByPriceToPayAggregation($priceToPayAggregation, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $priceToPayAggregations Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPriceToPayAggregation_In(array $priceToPayAggregations)
    {
        return $this->filterByPriceToPayAggregation($priceToPayAggregations, Criteria::IN);
    }

    /**
     * Filter the query on the price_to_pay_aggregation column
     *
     * Example usage:
     * <code>
     * $query->filterByPriceToPayAggregation(1234); // WHERE price_to_pay_aggregation = 1234
     * $query->filterByPriceToPayAggregation(array(12, 34), Criteria::IN); // WHERE price_to_pay_aggregation IN (12, 34)
     * $query->filterByPriceToPayAggregation(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE price_to_pay_aggregation > 12
     * </code>
     *
     * @param     mixed $priceToPayAggregation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByPriceToPayAggregation($priceToPayAggregation = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($priceToPayAggregation)) {
            $useMinMax = false;
            if (isset($priceToPayAggregation['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesExpenseTableMap::COL_PRICE_TO_PAY_AGGREGATION, $priceToPayAggregation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($priceToPayAggregation['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesExpenseTableMap::COL_PRICE_TO_PAY_AGGREGATION, $priceToPayAggregation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$priceToPayAggregation of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesExpenseTableMap::COL_PRICE_TO_PAY_AGGREGATION, $priceToPayAggregation, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $refundableAmount Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRefundableAmount_Between(array $refundableAmount)
    {
        return $this->filterByRefundableAmount($refundableAmount, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $refundableAmounts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRefundableAmount_In(array $refundableAmounts)
    {
        return $this->filterByRefundableAmount($refundableAmounts, Criteria::IN);
    }

    /**
     * Filter the query on the refundable_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByRefundableAmount(1234); // WHERE refundable_amount = 1234
     * $query->filterByRefundableAmount(array(12, 34), Criteria::IN); // WHERE refundable_amount IN (12, 34)
     * $query->filterByRefundableAmount(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE refundable_amount > 12
     * </code>
     *
     * @param     mixed $refundableAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByRefundableAmount($refundableAmount = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($refundableAmount)) {
            $useMinMax = false;
            if (isset($refundableAmount['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesExpenseTableMap::COL_REFUNDABLE_AMOUNT, $refundableAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($refundableAmount['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesExpenseTableMap::COL_REFUNDABLE_AMOUNT, $refundableAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$refundableAmount of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesExpenseTableMap::COL_REFUNDABLE_AMOUNT, $refundableAmount, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $taxAmount Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTaxAmount_Between(array $taxAmount)
    {
        return $this->filterByTaxAmount($taxAmount, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $taxAmounts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTaxAmount_In(array $taxAmounts)
    {
        return $this->filterByTaxAmount($taxAmounts, Criteria::IN);
    }

    /**
     * Filter the query on the tax_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByTaxAmount(1234); // WHERE tax_amount = 1234
     * $query->filterByTaxAmount(array(12, 34), Criteria::IN); // WHERE tax_amount IN (12, 34)
     * $query->filterByTaxAmount(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE tax_amount > 12
     * </code>
     *
     * @param     mixed $taxAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByTaxAmount($taxAmount = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($taxAmount)) {
            $useMinMax = false;
            if (isset($taxAmount['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesExpenseTableMap::COL_TAX_AMOUNT, $taxAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($taxAmount['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesExpenseTableMap::COL_TAX_AMOUNT, $taxAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$taxAmount of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesExpenseTableMap::COL_TAX_AMOUNT, $taxAmount, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $taxAmountAfterCancellation Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTaxAmountAfterCancellation_Between(array $taxAmountAfterCancellation)
    {
        return $this->filterByTaxAmountAfterCancellation($taxAmountAfterCancellation, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $taxAmountAfterCancellations Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTaxAmountAfterCancellation_In(array $taxAmountAfterCancellations)
    {
        return $this->filterByTaxAmountAfterCancellation($taxAmountAfterCancellations, Criteria::IN);
    }

    /**
     * Filter the query on the tax_amount_after_cancellation column
     *
     * Example usage:
     * <code>
     * $query->filterByTaxAmountAfterCancellation(1234); // WHERE tax_amount_after_cancellation = 1234
     * $query->filterByTaxAmountAfterCancellation(array(12, 34), Criteria::IN); // WHERE tax_amount_after_cancellation IN (12, 34)
     * $query->filterByTaxAmountAfterCancellation(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE tax_amount_after_cancellation > 12
     * </code>
     *
     * @param     mixed $taxAmountAfterCancellation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByTaxAmountAfterCancellation($taxAmountAfterCancellation = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($taxAmountAfterCancellation)) {
            $useMinMax = false;
            if (isset($taxAmountAfterCancellation['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesExpenseTableMap::COL_TAX_AMOUNT_AFTER_CANCELLATION, $taxAmountAfterCancellation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($taxAmountAfterCancellation['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesExpenseTableMap::COL_TAX_AMOUNT_AFTER_CANCELLATION, $taxAmountAfterCancellation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$taxAmountAfterCancellation of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesExpenseTableMap::COL_TAX_AMOUNT_AFTER_CANCELLATION, $taxAmountAfterCancellation, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $taxRate Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTaxRate_Between(array $taxRate)
    {
        return $this->filterByTaxRate($taxRate, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $taxRates Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTaxRate_In(array $taxRates)
    {
        return $this->filterByTaxRate($taxRates, Criteria::IN);
    }

    /**
     * Filter the query on the tax_rate column
     *
     * Example usage:
     * <code>
     * $query->filterByTaxRate(1234); // WHERE tax_rate = 1234
     * $query->filterByTaxRate(array(12, 34), Criteria::IN); // WHERE tax_rate IN (12, 34)
     * $query->filterByTaxRate(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE tax_rate > 12
     * </code>
     *
     * @param     mixed $taxRate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByTaxRate($taxRate = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($taxRate)) {
            $useMinMax = false;
            if (isset($taxRate['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesExpenseTableMap::COL_TAX_RATE, $taxRate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($taxRate['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesExpenseTableMap::COL_TAX_RATE, $taxRate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$taxRate of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesExpenseTableMap::COL_TAX_RATE, $taxRate, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $types Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByType_In(array $types)
    {
        return $this->filterByType($types, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $type Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByType_Like($type)
    {
        return $this->filterByType($type, Criteria::LIKE);
    }

    /**
     * Filter the query on the type column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE type = 'fooValue'
     * $query->filterByType('%fooValue%', Criteria::LIKE); // WHERE type LIKE '%fooValue%'
     * $query->filterByType([1, 'foo'], Criteria::IN); // WHERE type IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $type The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByType($type = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $type = str_replace('*', '%', $type);
        }

        if (is_array($type) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$type of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesExpenseTableMap::COL_TYPE, $type, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $uuids Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUuid_In(array $uuids)
    {
        return $this->filterByUuid($uuids, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $uuid Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUuid_Like($uuid)
    {
        return $this->filterByUuid($uuid, Criteria::LIKE);
    }

    /**
     * Filter the query on the uuid column
     *
     * Example usage:
     * <code>
     * $query->filterByUuid('fooValue');   // WHERE uuid = 'fooValue'
     * $query->filterByUuid('%fooValue%', Criteria::LIKE); // WHERE uuid LIKE '%fooValue%'
     * $query->filterByUuid([1, 'foo'], Criteria::IN); // WHERE uuid IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $uuid The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByUuid($uuid = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $uuid = str_replace('*', '%', $uuid);
        }

        if (is_array($uuid) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$uuid of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesExpenseTableMap::COL_UUID, $uuid, $comparison);

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
                $this->addUsingAlias(SpySalesExpenseTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesExpenseTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesExpenseTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SpySalesExpenseTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesExpenseTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesExpenseTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Sales\Persistence\SpySalesOrder object
     *
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder|ObjectCollection $spySalesOrder The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrder($spySalesOrder, ?string $comparison = null)
    {
        if ($spySalesOrder instanceof \Orm\Zed\Sales\Persistence\SpySalesOrder) {
            return $this
                ->addUsingAlias(SpySalesExpenseTableMap::COL_FK_SALES_ORDER, $spySalesOrder->getIdSalesOrder(), $comparison);
        } elseif ($spySalesOrder instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpySalesExpenseTableMap::COL_FK_SALES_ORDER, $spySalesOrder->toKeyValue('PrimaryKey', 'IdSalesOrder'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByOrder() only accepts arguments of type \Orm\Zed\Sales\Persistence\SpySalesOrder or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Order relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOrder(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Order');

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
            $this->addJoinObject($join, 'Order');
        }

        return $this;
    }

    /**
     * Use the Order relation SpySalesOrder object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderQuery A secondary query class using the current class as primary query
     */
    public function useOrderQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOrder($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Order', '\Orm\Zed\Sales\Persistence\SpySalesOrderQuery');
    }

    /**
     * Use the Order relation SpySalesOrder object
     *
     * @param callable(\Orm\Zed\Sales\Persistence\SpySalesOrderQuery):\Orm\Zed\Sales\Persistence\SpySalesOrderQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrderQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOrderQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the Order relation to the SpySalesOrder table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderQuery The inner query object of the EXISTS statement
     */
    public function useOrderExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderQuery */
        $q = $this->useExistsQuery('Order', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the Order relation to the SpySalesOrder table for a NOT EXISTS query.
     *
     * @see useOrderExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrderNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderQuery */
        $q = $this->useExistsQuery('Order', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the Order relation to the SpySalesOrder table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderQuery The inner query object of the IN statement
     */
    public function useInOrderQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderQuery */
        $q = $this->useInQuery('Order', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the Order relation to the SpySalesOrder table for a NOT IN query.
     *
     * @see useOrderInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderQuery The inner query object of the NOT IN statement
     */
    public function useNotInOrderQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderQuery */
        $q = $this->useInQuery('Order', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Sales\Persistence\SpySalesDiscount object
     *
     * @param \Orm\Zed\Sales\Persistence\SpySalesDiscount|ObjectCollection $spySalesDiscount the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDiscount($spySalesDiscount, ?string $comparison = null)
    {
        if ($spySalesDiscount instanceof \Orm\Zed\Sales\Persistence\SpySalesDiscount) {
            $this
                ->addUsingAlias(SpySalesExpenseTableMap::COL_ID_SALES_EXPENSE, $spySalesDiscount->getFkSalesExpense(), $comparison);

            return $this;
        } elseif ($spySalesDiscount instanceof ObjectCollection) {
            $this
                ->useDiscountQuery()
                ->filterByPrimaryKeys($spySalesDiscount->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByDiscount() only accepts arguments of type \Orm\Zed\Sales\Persistence\SpySalesDiscount or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Discount relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinDiscount(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Discount');

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
            $this->addJoinObject($join, 'Discount');
        }

        return $this;
    }

    /**
     * Use the Discount relation SpySalesDiscount object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesDiscountQuery A secondary query class using the current class as primary query
     */
    public function useDiscountQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinDiscount($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Discount', '\Orm\Zed\Sales\Persistence\SpySalesDiscountQuery');
    }

    /**
     * Use the Discount relation SpySalesDiscount object
     *
     * @param callable(\Orm\Zed\Sales\Persistence\SpySalesDiscountQuery):\Orm\Zed\Sales\Persistence\SpySalesDiscountQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDiscountQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useDiscountQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the Discount relation to the SpySalesDiscount table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesDiscountQuery The inner query object of the EXISTS statement
     */
    public function useDiscountExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesDiscountQuery */
        $q = $this->useExistsQuery('Discount', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the Discount relation to the SpySalesDiscount table for a NOT EXISTS query.
     *
     * @see useDiscountExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesDiscountQuery The inner query object of the NOT EXISTS statement
     */
    public function useDiscountNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesDiscountQuery */
        $q = $this->useExistsQuery('Discount', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the Discount relation to the SpySalesDiscount table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesDiscountQuery The inner query object of the IN statement
     */
    public function useInDiscountQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesDiscountQuery */
        $q = $this->useInQuery('Discount', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the Discount relation to the SpySalesDiscount table for a NOT IN query.
     *
     * @see useDiscountInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesDiscountQuery The inner query object of the NOT IN statement
     */
    public function useNotInDiscountQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesDiscountQuery */
        $q = $this->useInQuery('Discount', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Sales\Persistence\SpySalesShipment object
     *
     * @param \Orm\Zed\Sales\Persistence\SpySalesShipment|ObjectCollection $spySalesShipment the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpySalesShipment($spySalesShipment, ?string $comparison = null)
    {
        if ($spySalesShipment instanceof \Orm\Zed\Sales\Persistence\SpySalesShipment) {
            $this
                ->addUsingAlias(SpySalesExpenseTableMap::COL_ID_SALES_EXPENSE, $spySalesShipment->getFkSalesExpense(), $comparison);

            return $this;
        } elseif ($spySalesShipment instanceof ObjectCollection) {
            $this
                ->useSpySalesShipmentQuery()
                ->filterByPrimaryKeys($spySalesShipment->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpySalesShipment() only accepts arguments of type \Orm\Zed\Sales\Persistence\SpySalesShipment or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpySalesShipment relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpySalesShipment(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpySalesShipment');

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
            $this->addJoinObject($join, 'SpySalesShipment');
        }

        return $this;
    }

    /**
     * Use the SpySalesShipment relation SpySalesShipment object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesShipmentQuery A secondary query class using the current class as primary query
     */
    public function useSpySalesShipmentQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpySalesShipment($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpySalesShipment', '\Orm\Zed\Sales\Persistence\SpySalesShipmentQuery');
    }

    /**
     * Use the SpySalesShipment relation SpySalesShipment object
     *
     * @param callable(\Orm\Zed\Sales\Persistence\SpySalesShipmentQuery):\Orm\Zed\Sales\Persistence\SpySalesShipmentQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpySalesShipmentQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpySalesShipmentQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpySalesShipment table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesShipmentQuery The inner query object of the EXISTS statement
     */
    public function useSpySalesShipmentExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesShipmentQuery */
        $q = $this->useExistsQuery('SpySalesShipment', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpySalesShipment table for a NOT EXISTS query.
     *
     * @see useSpySalesShipmentExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesShipmentQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpySalesShipmentNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesShipmentQuery */
        $q = $this->useExistsQuery('SpySalesShipment', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpySalesShipment table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesShipmentQuery The inner query object of the IN statement
     */
    public function useInSpySalesShipmentQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesShipmentQuery */
        $q = $this->useInQuery('SpySalesShipment', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpySalesShipment table for a NOT IN query.
     *
     * @see useSpySalesShipmentInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesShipmentQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpySalesShipmentQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesShipmentQuery */
        $q = $this->useInQuery('SpySalesShipment', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpySalesExpense $spySalesExpense Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spySalesExpense = null)
    {
        if ($spySalesExpense) {
            $this->addUsingAlias(SpySalesExpenseTableMap::COL_ID_SALES_EXPENSE, $spySalesExpense->getIdSalesExpense(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_sales_expense table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesExpenseTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpySalesExpenseTableMap::clearInstancePool();
            SpySalesExpenseTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesExpenseTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpySalesExpenseTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpySalesExpenseTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpySalesExpenseTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(SpySalesExpenseTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpySalesExpenseTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpySalesExpenseTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpySalesExpenseTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpySalesExpenseTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpySalesExpenseTableMap::COL_CREATED_AT);

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
