<?php

namespace Orm\Zed\SalesPaymentMerchant\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\Merchant\Persistence\SpyMerchant;
use Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayout as ChildSpySalesPaymentMerchantPayout;
use Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutQuery as ChildSpySalesPaymentMerchantPayoutQuery;
use Orm\Zed\SalesPaymentMerchant\Persistence\Map\SpySalesPaymentMerchantPayoutTableMap;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
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
 * Base class that represents a query for the `spy_sales_payment_merchant_payout` table.
 *
 * @method     ChildSpySalesPaymentMerchantPayoutQuery orderByIdSalesPaymentMerchantPayout($order = Criteria::ASC) Order by the id_sales_payment_merchant_payout column
 * @method     ChildSpySalesPaymentMerchantPayoutQuery orderByTransferId($order = Criteria::ASC) Order by the transfer_id column
 * @method     ChildSpySalesPaymentMerchantPayoutQuery orderByMerchantReference($order = Criteria::ASC) Order by the merchant_reference column
 * @method     ChildSpySalesPaymentMerchantPayoutQuery orderByOrderReference($order = Criteria::ASC) Order by the order_reference column
 * @method     ChildSpySalesPaymentMerchantPayoutQuery orderByItemReferences($order = Criteria::ASC) Order by the item_references column
 * @method     ChildSpySalesPaymentMerchantPayoutQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     ChildSpySalesPaymentMerchantPayoutQuery orderByIsSuccessful($order = Criteria::ASC) Order by the is_successful column
 * @method     ChildSpySalesPaymentMerchantPayoutQuery orderByFailureMessage($order = Criteria::ASC) Order by the failure_message column
 * @method     ChildSpySalesPaymentMerchantPayoutQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpySalesPaymentMerchantPayoutQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpySalesPaymentMerchantPayoutQuery groupByIdSalesPaymentMerchantPayout() Group by the id_sales_payment_merchant_payout column
 * @method     ChildSpySalesPaymentMerchantPayoutQuery groupByTransferId() Group by the transfer_id column
 * @method     ChildSpySalesPaymentMerchantPayoutQuery groupByMerchantReference() Group by the merchant_reference column
 * @method     ChildSpySalesPaymentMerchantPayoutQuery groupByOrderReference() Group by the order_reference column
 * @method     ChildSpySalesPaymentMerchantPayoutQuery groupByItemReferences() Group by the item_references column
 * @method     ChildSpySalesPaymentMerchantPayoutQuery groupByAmount() Group by the amount column
 * @method     ChildSpySalesPaymentMerchantPayoutQuery groupByIsSuccessful() Group by the is_successful column
 * @method     ChildSpySalesPaymentMerchantPayoutQuery groupByFailureMessage() Group by the failure_message column
 * @method     ChildSpySalesPaymentMerchantPayoutQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpySalesPaymentMerchantPayoutQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpySalesPaymentMerchantPayoutQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpySalesPaymentMerchantPayoutQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpySalesPaymentMerchantPayoutQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpySalesPaymentMerchantPayoutQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpySalesPaymentMerchantPayoutQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpySalesPaymentMerchantPayoutQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpySalesPaymentMerchantPayoutQuery leftJoinSpyMerchant($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchant relation
 * @method     ChildSpySalesPaymentMerchantPayoutQuery rightJoinSpyMerchant($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchant relation
 * @method     ChildSpySalesPaymentMerchantPayoutQuery innerJoinSpyMerchant($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchant relation
 *
 * @method     ChildSpySalesPaymentMerchantPayoutQuery joinWithSpyMerchant($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchant relation
 *
 * @method     ChildSpySalesPaymentMerchantPayoutQuery leftJoinWithSpyMerchant() Adds a LEFT JOIN clause and with to the query using the SpyMerchant relation
 * @method     ChildSpySalesPaymentMerchantPayoutQuery rightJoinWithSpyMerchant() Adds a RIGHT JOIN clause and with to the query using the SpyMerchant relation
 * @method     ChildSpySalesPaymentMerchantPayoutQuery innerJoinWithSpyMerchant() Adds a INNER JOIN clause and with to the query using the SpyMerchant relation
 *
 * @method     ChildSpySalesPaymentMerchantPayoutQuery leftJoinSpySalesOrder($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpySalesOrder relation
 * @method     ChildSpySalesPaymentMerchantPayoutQuery rightJoinSpySalesOrder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpySalesOrder relation
 * @method     ChildSpySalesPaymentMerchantPayoutQuery innerJoinSpySalesOrder($relationAlias = null) Adds a INNER JOIN clause to the query using the SpySalesOrder relation
 *
 * @method     ChildSpySalesPaymentMerchantPayoutQuery joinWithSpySalesOrder($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpySalesOrder relation
 *
 * @method     ChildSpySalesPaymentMerchantPayoutQuery leftJoinWithSpySalesOrder() Adds a LEFT JOIN clause and with to the query using the SpySalesOrder relation
 * @method     ChildSpySalesPaymentMerchantPayoutQuery rightJoinWithSpySalesOrder() Adds a RIGHT JOIN clause and with to the query using the SpySalesOrder relation
 * @method     ChildSpySalesPaymentMerchantPayoutQuery innerJoinWithSpySalesOrder() Adds a INNER JOIN clause and with to the query using the SpySalesOrder relation
 *
 * @method     \Orm\Zed\Merchant\Persistence\SpyMerchantQuery|\Orm\Zed\Sales\Persistence\SpySalesOrderQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpySalesPaymentMerchantPayout|null findOne(?ConnectionInterface $con = null) Return the first ChildSpySalesPaymentMerchantPayout matching the query
 * @method     ChildSpySalesPaymentMerchantPayout findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpySalesPaymentMerchantPayout matching the query, or a new ChildSpySalesPaymentMerchantPayout object populated from the query conditions when no match is found
 *
 * @method     ChildSpySalesPaymentMerchantPayout|null findOneByIdSalesPaymentMerchantPayout(int $id_sales_payment_merchant_payout) Return the first ChildSpySalesPaymentMerchantPayout filtered by the id_sales_payment_merchant_payout column
 * @method     ChildSpySalesPaymentMerchantPayout|null findOneByTransferId(string $transfer_id) Return the first ChildSpySalesPaymentMerchantPayout filtered by the transfer_id column
 * @method     ChildSpySalesPaymentMerchantPayout|null findOneByMerchantReference(string $merchant_reference) Return the first ChildSpySalesPaymentMerchantPayout filtered by the merchant_reference column
 * @method     ChildSpySalesPaymentMerchantPayout|null findOneByOrderReference(string $order_reference) Return the first ChildSpySalesPaymentMerchantPayout filtered by the order_reference column
 * @method     ChildSpySalesPaymentMerchantPayout|null findOneByItemReferences(string $item_references) Return the first ChildSpySalesPaymentMerchantPayout filtered by the item_references column
 * @method     ChildSpySalesPaymentMerchantPayout|null findOneByAmount(string $amount) Return the first ChildSpySalesPaymentMerchantPayout filtered by the amount column
 * @method     ChildSpySalesPaymentMerchantPayout|null findOneByIsSuccessful(boolean $is_successful) Return the first ChildSpySalesPaymentMerchantPayout filtered by the is_successful column
 * @method     ChildSpySalesPaymentMerchantPayout|null findOneByFailureMessage(string $failure_message) Return the first ChildSpySalesPaymentMerchantPayout filtered by the failure_message column
 * @method     ChildSpySalesPaymentMerchantPayout|null findOneByCreatedAt(string $created_at) Return the first ChildSpySalesPaymentMerchantPayout filtered by the created_at column
 * @method     ChildSpySalesPaymentMerchantPayout|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpySalesPaymentMerchantPayout filtered by the updated_at column
 *
 * @method     ChildSpySalesPaymentMerchantPayout requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpySalesPaymentMerchantPayout by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesPaymentMerchantPayout requireOne(?ConnectionInterface $con = null) Return the first ChildSpySalesPaymentMerchantPayout matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpySalesPaymentMerchantPayout requireOneByIdSalesPaymentMerchantPayout(int $id_sales_payment_merchant_payout) Return the first ChildSpySalesPaymentMerchantPayout filtered by the id_sales_payment_merchant_payout column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesPaymentMerchantPayout requireOneByTransferId(string $transfer_id) Return the first ChildSpySalesPaymentMerchantPayout filtered by the transfer_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesPaymentMerchantPayout requireOneByMerchantReference(string $merchant_reference) Return the first ChildSpySalesPaymentMerchantPayout filtered by the merchant_reference column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesPaymentMerchantPayout requireOneByOrderReference(string $order_reference) Return the first ChildSpySalesPaymentMerchantPayout filtered by the order_reference column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesPaymentMerchantPayout requireOneByItemReferences(string $item_references) Return the first ChildSpySalesPaymentMerchantPayout filtered by the item_references column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesPaymentMerchantPayout requireOneByAmount(string $amount) Return the first ChildSpySalesPaymentMerchantPayout filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesPaymentMerchantPayout requireOneByIsSuccessful(boolean $is_successful) Return the first ChildSpySalesPaymentMerchantPayout filtered by the is_successful column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesPaymentMerchantPayout requireOneByFailureMessage(string $failure_message) Return the first ChildSpySalesPaymentMerchantPayout filtered by the failure_message column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesPaymentMerchantPayout requireOneByCreatedAt(string $created_at) Return the first ChildSpySalesPaymentMerchantPayout filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesPaymentMerchantPayout requireOneByUpdatedAt(string $updated_at) Return the first ChildSpySalesPaymentMerchantPayout filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpySalesPaymentMerchantPayout[]|Collection find(?ConnectionInterface $con = null) Return ChildSpySalesPaymentMerchantPayout objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpySalesPaymentMerchantPayout> find(?ConnectionInterface $con = null) Return ChildSpySalesPaymentMerchantPayout objects based on current ModelCriteria
 *
 * @method     ChildSpySalesPaymentMerchantPayout[]|Collection findByIdSalesPaymentMerchantPayout(int|array<int> $id_sales_payment_merchant_payout) Return ChildSpySalesPaymentMerchantPayout objects filtered by the id_sales_payment_merchant_payout column
 * @psalm-method Collection&\Traversable<ChildSpySalesPaymentMerchantPayout> findByIdSalesPaymentMerchantPayout(int|array<int> $id_sales_payment_merchant_payout) Return ChildSpySalesPaymentMerchantPayout objects filtered by the id_sales_payment_merchant_payout column
 * @method     ChildSpySalesPaymentMerchantPayout[]|Collection findByTransferId(string|array<string> $transfer_id) Return ChildSpySalesPaymentMerchantPayout objects filtered by the transfer_id column
 * @psalm-method Collection&\Traversable<ChildSpySalesPaymentMerchantPayout> findByTransferId(string|array<string> $transfer_id) Return ChildSpySalesPaymentMerchantPayout objects filtered by the transfer_id column
 * @method     ChildSpySalesPaymentMerchantPayout[]|Collection findByMerchantReference(string|array<string> $merchant_reference) Return ChildSpySalesPaymentMerchantPayout objects filtered by the merchant_reference column
 * @psalm-method Collection&\Traversable<ChildSpySalesPaymentMerchantPayout> findByMerchantReference(string|array<string> $merchant_reference) Return ChildSpySalesPaymentMerchantPayout objects filtered by the merchant_reference column
 * @method     ChildSpySalesPaymentMerchantPayout[]|Collection findByOrderReference(string|array<string> $order_reference) Return ChildSpySalesPaymentMerchantPayout objects filtered by the order_reference column
 * @psalm-method Collection&\Traversable<ChildSpySalesPaymentMerchantPayout> findByOrderReference(string|array<string> $order_reference) Return ChildSpySalesPaymentMerchantPayout objects filtered by the order_reference column
 * @method     ChildSpySalesPaymentMerchantPayout[]|Collection findByItemReferences(string|array<string> $item_references) Return ChildSpySalesPaymentMerchantPayout objects filtered by the item_references column
 * @psalm-method Collection&\Traversable<ChildSpySalesPaymentMerchantPayout> findByItemReferences(string|array<string> $item_references) Return ChildSpySalesPaymentMerchantPayout objects filtered by the item_references column
 * @method     ChildSpySalesPaymentMerchantPayout[]|Collection findByAmount(string|array<string> $amount) Return ChildSpySalesPaymentMerchantPayout objects filtered by the amount column
 * @psalm-method Collection&\Traversable<ChildSpySalesPaymentMerchantPayout> findByAmount(string|array<string> $amount) Return ChildSpySalesPaymentMerchantPayout objects filtered by the amount column
 * @method     ChildSpySalesPaymentMerchantPayout[]|Collection findByIsSuccessful(boolean|array<boolean> $is_successful) Return ChildSpySalesPaymentMerchantPayout objects filtered by the is_successful column
 * @psalm-method Collection&\Traversable<ChildSpySalesPaymentMerchantPayout> findByIsSuccessful(boolean|array<boolean> $is_successful) Return ChildSpySalesPaymentMerchantPayout objects filtered by the is_successful column
 * @method     ChildSpySalesPaymentMerchantPayout[]|Collection findByFailureMessage(string|array<string> $failure_message) Return ChildSpySalesPaymentMerchantPayout objects filtered by the failure_message column
 * @psalm-method Collection&\Traversable<ChildSpySalesPaymentMerchantPayout> findByFailureMessage(string|array<string> $failure_message) Return ChildSpySalesPaymentMerchantPayout objects filtered by the failure_message column
 * @method     ChildSpySalesPaymentMerchantPayout[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpySalesPaymentMerchantPayout objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpySalesPaymentMerchantPayout> findByCreatedAt(string|array<string> $created_at) Return ChildSpySalesPaymentMerchantPayout objects filtered by the created_at column
 * @method     ChildSpySalesPaymentMerchantPayout[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpySalesPaymentMerchantPayout objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpySalesPaymentMerchantPayout> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpySalesPaymentMerchantPayout objects filtered by the updated_at column
 *
 * @method     ChildSpySalesPaymentMerchantPayout[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpySalesPaymentMerchantPayout> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpySalesPaymentMerchantPayoutQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\SalesPaymentMerchant\Persistence\Base\SpySalesPaymentMerchantPayoutQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\SalesPaymentMerchant\\Persistence\\SpySalesPaymentMerchantPayout', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpySalesPaymentMerchantPayoutQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpySalesPaymentMerchantPayoutQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpySalesPaymentMerchantPayoutQuery) {
            return $criteria;
        }
        $query = new ChildSpySalesPaymentMerchantPayoutQuery();
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
     * @return ChildSpySalesPaymentMerchantPayout|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpySalesPaymentMerchantPayoutTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpySalesPaymentMerchantPayout A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_sales_payment_merchant_payout, transfer_id, merchant_reference, order_reference, item_references, amount, is_successful, failure_message, created_at, updated_at FROM spy_sales_payment_merchant_payout WHERE id_sales_payment_merchant_payout = :p0';
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
            /** @var ChildSpySalesPaymentMerchantPayout $obj */
            $obj = new ChildSpySalesPaymentMerchantPayout();
            $obj->hydrate($row);
            SpySalesPaymentMerchantPayoutTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpySalesPaymentMerchantPayout|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpySalesPaymentMerchantPayoutTableMap::COL_ID_SALES_PAYMENT_MERCHANT_PAYOUT, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpySalesPaymentMerchantPayoutTableMap::COL_ID_SALES_PAYMENT_MERCHANT_PAYOUT, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idSalesPaymentMerchantPayout Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdSalesPaymentMerchantPayout_Between(array $idSalesPaymentMerchantPayout)
    {
        return $this->filterByIdSalesPaymentMerchantPayout($idSalesPaymentMerchantPayout, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idSalesPaymentMerchantPayouts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdSalesPaymentMerchantPayout_In(array $idSalesPaymentMerchantPayouts)
    {
        return $this->filterByIdSalesPaymentMerchantPayout($idSalesPaymentMerchantPayouts, Criteria::IN);
    }

    /**
     * Filter the query on the id_sales_payment_merchant_payout column
     *
     * Example usage:
     * <code>
     * $query->filterByIdSalesPaymentMerchantPayout(1234); // WHERE id_sales_payment_merchant_payout = 1234
     * $query->filterByIdSalesPaymentMerchantPayout(array(12, 34), Criteria::IN); // WHERE id_sales_payment_merchant_payout IN (12, 34)
     * $query->filterByIdSalesPaymentMerchantPayout(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_sales_payment_merchant_payout > 12
     * </code>
     *
     * @param     mixed $idSalesPaymentMerchantPayout The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdSalesPaymentMerchantPayout($idSalesPaymentMerchantPayout = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idSalesPaymentMerchantPayout)) {
            $useMinMax = false;
            if (isset($idSalesPaymentMerchantPayout['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesPaymentMerchantPayoutTableMap::COL_ID_SALES_PAYMENT_MERCHANT_PAYOUT, $idSalesPaymentMerchantPayout['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idSalesPaymentMerchantPayout['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesPaymentMerchantPayoutTableMap::COL_ID_SALES_PAYMENT_MERCHANT_PAYOUT, $idSalesPaymentMerchantPayout['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idSalesPaymentMerchantPayout of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesPaymentMerchantPayoutTableMap::COL_ID_SALES_PAYMENT_MERCHANT_PAYOUT, $idSalesPaymentMerchantPayout, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $transferIds Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTransferId_In(array $transferIds)
    {
        return $this->filterByTransferId($transferIds, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $transferId Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTransferId_Like($transferId)
    {
        return $this->filterByTransferId($transferId, Criteria::LIKE);
    }

    /**
     * Filter the query on the transfer_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTransferId('fooValue');   // WHERE transfer_id = 'fooValue'
     * $query->filterByTransferId('%fooValue%', Criteria::LIKE); // WHERE transfer_id LIKE '%fooValue%'
     * $query->filterByTransferId([1, 'foo'], Criteria::IN); // WHERE transfer_id IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $transferId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByTransferId($transferId = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $transferId = str_replace('*', '%', $transferId);
        }

        if (is_array($transferId) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$transferId of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesPaymentMerchantPayoutTableMap::COL_TRANSFER_ID, $transferId, $comparison);

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

        $query = $this->addUsingAlias(SpySalesPaymentMerchantPayoutTableMap::COL_MERCHANT_REFERENCE, $merchantReference, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $orderReferences Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderReference_In(array $orderReferences)
    {
        return $this->filterByOrderReference($orderReferences, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $orderReference Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderReference_Like($orderReference)
    {
        return $this->filterByOrderReference($orderReference, Criteria::LIKE);
    }

    /**
     * Filter the query on the order_reference column
     *
     * Example usage:
     * <code>
     * $query->filterByOrderReference('fooValue');   // WHERE order_reference = 'fooValue'
     * $query->filterByOrderReference('%fooValue%', Criteria::LIKE); // WHERE order_reference LIKE '%fooValue%'
     * $query->filterByOrderReference([1, 'foo'], Criteria::IN); // WHERE order_reference IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $orderReference The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByOrderReference($orderReference = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $orderReference = str_replace('*', '%', $orderReference);
        }

        if (is_array($orderReference) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$orderReference of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesPaymentMerchantPayoutTableMap::COL_ORDER_REFERENCE, $orderReference, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $itemReferencess Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByItemReferences_In(array $itemReferencess)
    {
        return $this->filterByItemReferences($itemReferencess, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $itemReferences Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByItemReferences_Like($itemReferences)
    {
        return $this->filterByItemReferences($itemReferences, Criteria::LIKE);
    }

    /**
     * Filter the query on the item_references column
     *
     * Example usage:
     * <code>
     * $query->filterByItemReferences('fooValue');   // WHERE item_references = 'fooValue'
     * $query->filterByItemReferences('%fooValue%', Criteria::LIKE); // WHERE item_references LIKE '%fooValue%'
     * $query->filterByItemReferences([1, 'foo'], Criteria::IN); // WHERE item_references IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $itemReferences The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByItemReferences($itemReferences = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $itemReferences = str_replace('*', '%', $itemReferences);
        }

        if (is_array($itemReferences) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$itemReferences of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesPaymentMerchantPayoutTableMap::COL_ITEM_REFERENCES, $itemReferences, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $amounts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmount_In(array $amounts)
    {
        return $this->filterByAmount($amounts, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $amount Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmount_Like($amount)
    {
        return $this->filterByAmount($amount, Criteria::LIKE);
    }

    /**
     * Filter the query on the amount column
     *
     * Example usage:
     * <code>
     * $query->filterByAmount('fooValue');   // WHERE amount = 'fooValue'
     * $query->filterByAmount('%fooValue%', Criteria::LIKE); // WHERE amount LIKE '%fooValue%'
     * $query->filterByAmount([1, 'foo'], Criteria::IN); // WHERE amount IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $amount The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAmount($amount = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $amount = str_replace('*', '%', $amount);
        }

        if (is_array($amount) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$amount of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesPaymentMerchantPayoutTableMap::COL_AMOUNT, $amount, $comparison);

        return $query;
    }

    /**
     * Filter the query on the is_successful column
     *
     * Example usage:
     * <code>
     * $query->filterByIsSuccessful(true); // WHERE is_successful = true
     * $query->filterByIsSuccessful('yes'); // WHERE is_successful = true
     * </code>
     *
     * @param     bool|string $isSuccessful The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIsSuccessful($isSuccessful = null, $comparison = Criteria::EQUAL)
    {
        if (is_string($isSuccessful)) {
            $isSuccessful = in_array(strtolower($isSuccessful), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $query = $this->addUsingAlias(SpySalesPaymentMerchantPayoutTableMap::COL_IS_SUCCESSFUL, $isSuccessful, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $failureMessages Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFailureMessage_In(array $failureMessages)
    {
        return $this->filterByFailureMessage($failureMessages, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $failureMessage Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFailureMessage_Like($failureMessage)
    {
        return $this->filterByFailureMessage($failureMessage, Criteria::LIKE);
    }

    /**
     * Filter the query on the failure_message column
     *
     * Example usage:
     * <code>
     * $query->filterByFailureMessage('fooValue');   // WHERE failure_message = 'fooValue'
     * $query->filterByFailureMessage('%fooValue%', Criteria::LIKE); // WHERE failure_message LIKE '%fooValue%'
     * $query->filterByFailureMessage([1, 'foo'], Criteria::IN); // WHERE failure_message IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $failureMessage The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFailureMessage($failureMessage = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $failureMessage = str_replace('*', '%', $failureMessage);
        }

        if (is_array($failureMessage) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$failureMessage of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesPaymentMerchantPayoutTableMap::COL_FAILURE_MESSAGE, $failureMessage, $comparison);

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
                $this->addUsingAlias(SpySalesPaymentMerchantPayoutTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesPaymentMerchantPayoutTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesPaymentMerchantPayoutTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SpySalesPaymentMerchantPayoutTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesPaymentMerchantPayoutTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesPaymentMerchantPayoutTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Merchant\Persistence\SpyMerchant object
     *
     * @param \Orm\Zed\Merchant\Persistence\SpyMerchant|ObjectCollection $spyMerchant The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyMerchant($spyMerchant, ?string $comparison = null)
    {
        if ($spyMerchant instanceof \Orm\Zed\Merchant\Persistence\SpyMerchant) {
            return $this
                ->addUsingAlias(SpySalesPaymentMerchantPayoutTableMap::COL_MERCHANT_REFERENCE, $spyMerchant->getMerchantReference(), $comparison);
        } elseif ($spyMerchant instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpySalesPaymentMerchantPayoutTableMap::COL_MERCHANT_REFERENCE, $spyMerchant->toKeyValue('PrimaryKey', 'MerchantReference'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyMerchant() only accepts arguments of type \Orm\Zed\Merchant\Persistence\SpyMerchant or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyMerchant relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyMerchant(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyMerchant');

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
            $this->addJoinObject($join, 'SpyMerchant');
        }

        return $this;
    }

    /**
     * Use the SpyMerchant relation SpyMerchant object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchantQuery A secondary query class using the current class as primary query
     */
    public function useSpyMerchantQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpyMerchant($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyMerchant', '\Orm\Zed\Merchant\Persistence\SpyMerchantQuery');
    }

    /**
     * Use the SpyMerchant relation SpyMerchant object
     *
     * @param callable(\Orm\Zed\Merchant\Persistence\SpyMerchantQuery):\Orm\Zed\Merchant\Persistence\SpyMerchantQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyMerchantQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpyMerchantQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyMerchant table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchantQuery The inner query object of the EXISTS statement
     */
    public function useSpyMerchantExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Merchant\Persistence\SpyMerchantQuery */
        $q = $this->useExistsQuery('SpyMerchant', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyMerchant table for a NOT EXISTS query.
     *
     * @see useSpyMerchantExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchantQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyMerchantNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Merchant\Persistence\SpyMerchantQuery */
        $q = $this->useExistsQuery('SpyMerchant', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyMerchant table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchantQuery The inner query object of the IN statement
     */
    public function useInSpyMerchantQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Merchant\Persistence\SpyMerchantQuery */
        $q = $this->useInQuery('SpyMerchant', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyMerchant table for a NOT IN query.
     *
     * @see useSpyMerchantInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchantQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyMerchantQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Merchant\Persistence\SpyMerchantQuery */
        $q = $this->useInQuery('SpyMerchant', $modelAlias, $queryClass, 'NOT IN');
        return $q;
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
    public function filterBySpySalesOrder($spySalesOrder, ?string $comparison = null)
    {
        if ($spySalesOrder instanceof \Orm\Zed\Sales\Persistence\SpySalesOrder) {
            return $this
                ->addUsingAlias(SpySalesPaymentMerchantPayoutTableMap::COL_ORDER_REFERENCE, $spySalesOrder->getOrderReference(), $comparison);
        } elseif ($spySalesOrder instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpySalesPaymentMerchantPayoutTableMap::COL_ORDER_REFERENCE, $spySalesOrder->toKeyValue('PrimaryKey', 'OrderReference'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpySalesOrder() only accepts arguments of type \Orm\Zed\Sales\Persistence\SpySalesOrder or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpySalesOrder relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpySalesOrder(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpySalesOrder');

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
            $this->addJoinObject($join, 'SpySalesOrder');
        }

        return $this;
    }

    /**
     * Use the SpySalesOrder relation SpySalesOrder object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderQuery A secondary query class using the current class as primary query
     */
    public function useSpySalesOrderQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpySalesOrder($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpySalesOrder', '\Orm\Zed\Sales\Persistence\SpySalesOrderQuery');
    }

    /**
     * Use the SpySalesOrder relation SpySalesOrder object
     *
     * @param callable(\Orm\Zed\Sales\Persistence\SpySalesOrderQuery):\Orm\Zed\Sales\Persistence\SpySalesOrderQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpySalesOrderQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpySalesOrderQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpySalesOrder table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderQuery The inner query object of the EXISTS statement
     */
    public function useSpySalesOrderExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderQuery */
        $q = $this->useExistsQuery('SpySalesOrder', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpySalesOrder table for a NOT EXISTS query.
     *
     * @see useSpySalesOrderExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpySalesOrderNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderQuery */
        $q = $this->useExistsQuery('SpySalesOrder', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpySalesOrder table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderQuery The inner query object of the IN statement
     */
    public function useInSpySalesOrderQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderQuery */
        $q = $this->useInQuery('SpySalesOrder', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpySalesOrder table for a NOT IN query.
     *
     * @see useSpySalesOrderInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpySalesOrderQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderQuery */
        $q = $this->useInQuery('SpySalesOrder', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpySalesPaymentMerchantPayout $spySalesPaymentMerchantPayout Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spySalesPaymentMerchantPayout = null)
    {
        if ($spySalesPaymentMerchantPayout) {
            $this->addUsingAlias(SpySalesPaymentMerchantPayoutTableMap::COL_ID_SALES_PAYMENT_MERCHANT_PAYOUT, $spySalesPaymentMerchantPayout->getIdSalesPaymentMerchantPayout(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_sales_payment_merchant_payout table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesPaymentMerchantPayoutTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpySalesPaymentMerchantPayoutTableMap::clearInstancePool();
            SpySalesPaymentMerchantPayoutTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesPaymentMerchantPayoutTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpySalesPaymentMerchantPayoutTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpySalesPaymentMerchantPayoutTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpySalesPaymentMerchantPayoutTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(SpySalesPaymentMerchantPayoutTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpySalesPaymentMerchantPayoutTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpySalesPaymentMerchantPayoutTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpySalesPaymentMerchantPayoutTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpySalesPaymentMerchantPayoutTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpySalesPaymentMerchantPayoutTableMap::COL_CREATED_AT);

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
