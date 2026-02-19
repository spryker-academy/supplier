<?php

namespace Orm\Zed\Discount\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\Discount\Persistence\SpyDiscountVoucher as ChildSpyDiscountVoucher;
use Orm\Zed\Discount\Persistence\SpyDiscountVoucherQuery as ChildSpyDiscountVoucherQuery;
use Orm\Zed\Discount\Persistence\Map\SpyDiscountVoucherTableMap;
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
 * Base class that represents a query for the `spy_discount_voucher` table.
 *
 * @method     ChildSpyDiscountVoucherQuery orderByIdDiscountVoucher($order = Criteria::ASC) Order by the id_discount_voucher column
 * @method     ChildSpyDiscountVoucherQuery orderByFkDiscountVoucherPool($order = Criteria::ASC) Order by the fk_discount_voucher_pool column
 * @method     ChildSpyDiscountVoucherQuery orderByCode($order = Criteria::ASC) Order by the code column
 * @method     ChildSpyDiscountVoucherQuery orderByIsActive($order = Criteria::ASC) Order by the is_active column
 * @method     ChildSpyDiscountVoucherQuery orderByMaxNumberOfUses($order = Criteria::ASC) Order by the max_number_of_uses column
 * @method     ChildSpyDiscountVoucherQuery orderByNumberOfUses($order = Criteria::ASC) Order by the number_of_uses column
 * @method     ChildSpyDiscountVoucherQuery orderByVoucherBatch($order = Criteria::ASC) Order by the voucher_batch column
 * @method     ChildSpyDiscountVoucherQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpyDiscountVoucherQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpyDiscountVoucherQuery groupByIdDiscountVoucher() Group by the id_discount_voucher column
 * @method     ChildSpyDiscountVoucherQuery groupByFkDiscountVoucherPool() Group by the fk_discount_voucher_pool column
 * @method     ChildSpyDiscountVoucherQuery groupByCode() Group by the code column
 * @method     ChildSpyDiscountVoucherQuery groupByIsActive() Group by the is_active column
 * @method     ChildSpyDiscountVoucherQuery groupByMaxNumberOfUses() Group by the max_number_of_uses column
 * @method     ChildSpyDiscountVoucherQuery groupByNumberOfUses() Group by the number_of_uses column
 * @method     ChildSpyDiscountVoucherQuery groupByVoucherBatch() Group by the voucher_batch column
 * @method     ChildSpyDiscountVoucherQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpyDiscountVoucherQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpyDiscountVoucherQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyDiscountVoucherQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyDiscountVoucherQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyDiscountVoucherQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyDiscountVoucherQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyDiscountVoucherQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyDiscountVoucherQuery leftJoinVoucherPool($relationAlias = null) Adds a LEFT JOIN clause to the query using the VoucherPool relation
 * @method     ChildSpyDiscountVoucherQuery rightJoinVoucherPool($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VoucherPool relation
 * @method     ChildSpyDiscountVoucherQuery innerJoinVoucherPool($relationAlias = null) Adds a INNER JOIN clause to the query using the VoucherPool relation
 *
 * @method     ChildSpyDiscountVoucherQuery joinWithVoucherPool($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VoucherPool relation
 *
 * @method     ChildSpyDiscountVoucherQuery leftJoinWithVoucherPool() Adds a LEFT JOIN clause and with to the query using the VoucherPool relation
 * @method     ChildSpyDiscountVoucherQuery rightJoinWithVoucherPool() Adds a RIGHT JOIN clause and with to the query using the VoucherPool relation
 * @method     ChildSpyDiscountVoucherQuery innerJoinWithVoucherPool() Adds a INNER JOIN clause and with to the query using the VoucherPool relation
 *
 * @method     \Orm\Zed\Discount\Persistence\SpyDiscountVoucherPoolQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyDiscountVoucher|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyDiscountVoucher matching the query
 * @method     ChildSpyDiscountVoucher findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyDiscountVoucher matching the query, or a new ChildSpyDiscountVoucher object populated from the query conditions when no match is found
 *
 * @method     ChildSpyDiscountVoucher|null findOneByIdDiscountVoucher(int $id_discount_voucher) Return the first ChildSpyDiscountVoucher filtered by the id_discount_voucher column
 * @method     ChildSpyDiscountVoucher|null findOneByFkDiscountVoucherPool(int $fk_discount_voucher_pool) Return the first ChildSpyDiscountVoucher filtered by the fk_discount_voucher_pool column
 * @method     ChildSpyDiscountVoucher|null findOneByCode(string $code) Return the first ChildSpyDiscountVoucher filtered by the code column
 * @method     ChildSpyDiscountVoucher|null findOneByIsActive(boolean $is_active) Return the first ChildSpyDiscountVoucher filtered by the is_active column
 * @method     ChildSpyDiscountVoucher|null findOneByMaxNumberOfUses(int $max_number_of_uses) Return the first ChildSpyDiscountVoucher filtered by the max_number_of_uses column
 * @method     ChildSpyDiscountVoucher|null findOneByNumberOfUses(int $number_of_uses) Return the first ChildSpyDiscountVoucher filtered by the number_of_uses column
 * @method     ChildSpyDiscountVoucher|null findOneByVoucherBatch(int $voucher_batch) Return the first ChildSpyDiscountVoucher filtered by the voucher_batch column
 * @method     ChildSpyDiscountVoucher|null findOneByCreatedAt(string $created_at) Return the first ChildSpyDiscountVoucher filtered by the created_at column
 * @method     ChildSpyDiscountVoucher|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpyDiscountVoucher filtered by the updated_at column
 *
 * @method     ChildSpyDiscountVoucher requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyDiscountVoucher by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDiscountVoucher requireOne(?ConnectionInterface $con = null) Return the first ChildSpyDiscountVoucher matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyDiscountVoucher requireOneByIdDiscountVoucher(int $id_discount_voucher) Return the first ChildSpyDiscountVoucher filtered by the id_discount_voucher column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDiscountVoucher requireOneByFkDiscountVoucherPool(int $fk_discount_voucher_pool) Return the first ChildSpyDiscountVoucher filtered by the fk_discount_voucher_pool column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDiscountVoucher requireOneByCode(string $code) Return the first ChildSpyDiscountVoucher filtered by the code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDiscountVoucher requireOneByIsActive(boolean $is_active) Return the first ChildSpyDiscountVoucher filtered by the is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDiscountVoucher requireOneByMaxNumberOfUses(int $max_number_of_uses) Return the first ChildSpyDiscountVoucher filtered by the max_number_of_uses column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDiscountVoucher requireOneByNumberOfUses(int $number_of_uses) Return the first ChildSpyDiscountVoucher filtered by the number_of_uses column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDiscountVoucher requireOneByVoucherBatch(int $voucher_batch) Return the first ChildSpyDiscountVoucher filtered by the voucher_batch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDiscountVoucher requireOneByCreatedAt(string $created_at) Return the first ChildSpyDiscountVoucher filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDiscountVoucher requireOneByUpdatedAt(string $updated_at) Return the first ChildSpyDiscountVoucher filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyDiscountVoucher[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyDiscountVoucher objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyDiscountVoucher> find(?ConnectionInterface $con = null) Return ChildSpyDiscountVoucher objects based on current ModelCriteria
 *
 * @method     ChildSpyDiscountVoucher[]|Collection findByIdDiscountVoucher(int|array<int> $id_discount_voucher) Return ChildSpyDiscountVoucher objects filtered by the id_discount_voucher column
 * @psalm-method Collection&\Traversable<ChildSpyDiscountVoucher> findByIdDiscountVoucher(int|array<int> $id_discount_voucher) Return ChildSpyDiscountVoucher objects filtered by the id_discount_voucher column
 * @method     ChildSpyDiscountVoucher[]|Collection findByFkDiscountVoucherPool(int|array<int> $fk_discount_voucher_pool) Return ChildSpyDiscountVoucher objects filtered by the fk_discount_voucher_pool column
 * @psalm-method Collection&\Traversable<ChildSpyDiscountVoucher> findByFkDiscountVoucherPool(int|array<int> $fk_discount_voucher_pool) Return ChildSpyDiscountVoucher objects filtered by the fk_discount_voucher_pool column
 * @method     ChildSpyDiscountVoucher[]|Collection findByCode(string|array<string> $code) Return ChildSpyDiscountVoucher objects filtered by the code column
 * @psalm-method Collection&\Traversable<ChildSpyDiscountVoucher> findByCode(string|array<string> $code) Return ChildSpyDiscountVoucher objects filtered by the code column
 * @method     ChildSpyDiscountVoucher[]|Collection findByIsActive(boolean|array<boolean> $is_active) Return ChildSpyDiscountVoucher objects filtered by the is_active column
 * @psalm-method Collection&\Traversable<ChildSpyDiscountVoucher> findByIsActive(boolean|array<boolean> $is_active) Return ChildSpyDiscountVoucher objects filtered by the is_active column
 * @method     ChildSpyDiscountVoucher[]|Collection findByMaxNumberOfUses(int|array<int> $max_number_of_uses) Return ChildSpyDiscountVoucher objects filtered by the max_number_of_uses column
 * @psalm-method Collection&\Traversable<ChildSpyDiscountVoucher> findByMaxNumberOfUses(int|array<int> $max_number_of_uses) Return ChildSpyDiscountVoucher objects filtered by the max_number_of_uses column
 * @method     ChildSpyDiscountVoucher[]|Collection findByNumberOfUses(int|array<int> $number_of_uses) Return ChildSpyDiscountVoucher objects filtered by the number_of_uses column
 * @psalm-method Collection&\Traversable<ChildSpyDiscountVoucher> findByNumberOfUses(int|array<int> $number_of_uses) Return ChildSpyDiscountVoucher objects filtered by the number_of_uses column
 * @method     ChildSpyDiscountVoucher[]|Collection findByVoucherBatch(int|array<int> $voucher_batch) Return ChildSpyDiscountVoucher objects filtered by the voucher_batch column
 * @psalm-method Collection&\Traversable<ChildSpyDiscountVoucher> findByVoucherBatch(int|array<int> $voucher_batch) Return ChildSpyDiscountVoucher objects filtered by the voucher_batch column
 * @method     ChildSpyDiscountVoucher[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpyDiscountVoucher objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpyDiscountVoucher> findByCreatedAt(string|array<string> $created_at) Return ChildSpyDiscountVoucher objects filtered by the created_at column
 * @method     ChildSpyDiscountVoucher[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyDiscountVoucher objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpyDiscountVoucher> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyDiscountVoucher objects filtered by the updated_at column
 *
 * @method     ChildSpyDiscountVoucher[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyDiscountVoucher> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyDiscountVoucherQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\Discount\Persistence\Base\SpyDiscountVoucherQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\Discount\\Persistence\\SpyDiscountVoucher', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyDiscountVoucherQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyDiscountVoucherQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyDiscountVoucherQuery) {
            return $criteria;
        }
        $query = new ChildSpyDiscountVoucherQuery();
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
     * @return ChildSpyDiscountVoucher|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyDiscountVoucherTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyDiscountVoucher A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_discount_voucher, fk_discount_voucher_pool, code, is_active, max_number_of_uses, number_of_uses, voucher_batch, created_at, updated_at FROM spy_discount_voucher WHERE id_discount_voucher = :p0';
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
            /** @var ChildSpyDiscountVoucher $obj */
            $obj = new ChildSpyDiscountVoucher();
            $obj->hydrate($row);
            SpyDiscountVoucherTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyDiscountVoucher|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyDiscountVoucherTableMap::COL_ID_DISCOUNT_VOUCHER, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyDiscountVoucherTableMap::COL_ID_DISCOUNT_VOUCHER, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idDiscountVoucher Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdDiscountVoucher_Between(array $idDiscountVoucher)
    {
        return $this->filterByIdDiscountVoucher($idDiscountVoucher, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idDiscountVouchers Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdDiscountVoucher_In(array $idDiscountVouchers)
    {
        return $this->filterByIdDiscountVoucher($idDiscountVouchers, Criteria::IN);
    }

    /**
     * Filter the query on the id_discount_voucher column
     *
     * Example usage:
     * <code>
     * $query->filterByIdDiscountVoucher(1234); // WHERE id_discount_voucher = 1234
     * $query->filterByIdDiscountVoucher(array(12, 34), Criteria::IN); // WHERE id_discount_voucher IN (12, 34)
     * $query->filterByIdDiscountVoucher(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_discount_voucher > 12
     * </code>
     *
     * @param     mixed $idDiscountVoucher The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdDiscountVoucher($idDiscountVoucher = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idDiscountVoucher)) {
            $useMinMax = false;
            if (isset($idDiscountVoucher['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDiscountVoucherTableMap::COL_ID_DISCOUNT_VOUCHER, $idDiscountVoucher['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idDiscountVoucher['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDiscountVoucherTableMap::COL_ID_DISCOUNT_VOUCHER, $idDiscountVoucher['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idDiscountVoucher of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyDiscountVoucherTableMap::COL_ID_DISCOUNT_VOUCHER, $idDiscountVoucher, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkDiscountVoucherPool Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkDiscountVoucherPool_Between(array $fkDiscountVoucherPool)
    {
        return $this->filterByFkDiscountVoucherPool($fkDiscountVoucherPool, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkDiscountVoucherPools Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkDiscountVoucherPool_In(array $fkDiscountVoucherPools)
    {
        return $this->filterByFkDiscountVoucherPool($fkDiscountVoucherPools, Criteria::IN);
    }

    /**
     * Filter the query on the fk_discount_voucher_pool column
     *
     * Example usage:
     * <code>
     * $query->filterByFkDiscountVoucherPool(1234); // WHERE fk_discount_voucher_pool = 1234
     * $query->filterByFkDiscountVoucherPool(array(12, 34), Criteria::IN); // WHERE fk_discount_voucher_pool IN (12, 34)
     * $query->filterByFkDiscountVoucherPool(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_discount_voucher_pool > 12
     * </code>
     *
     * @see       filterByVoucherPool()
     *
     * @param     mixed $fkDiscountVoucherPool The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkDiscountVoucherPool($fkDiscountVoucherPool = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkDiscountVoucherPool)) {
            $useMinMax = false;
            if (isset($fkDiscountVoucherPool['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDiscountVoucherTableMap::COL_FK_DISCOUNT_VOUCHER_POOL, $fkDiscountVoucherPool['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkDiscountVoucherPool['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDiscountVoucherTableMap::COL_FK_DISCOUNT_VOUCHER_POOL, $fkDiscountVoucherPool['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkDiscountVoucherPool of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyDiscountVoucherTableMap::COL_FK_DISCOUNT_VOUCHER_POOL, $fkDiscountVoucherPool, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $codes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCode_In(array $codes)
    {
        return $this->filterByCode($codes, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $code Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCode_Like($code)
    {
        return $this->filterByCode($code, Criteria::LIKE);
    }

    /**
     * Filter the query on the code column
     *
     * Example usage:
     * <code>
     * $query->filterByCode('fooValue');   // WHERE code = 'fooValue'
     * $query->filterByCode('%fooValue%', Criteria::LIKE); // WHERE code LIKE '%fooValue%'
     * $query->filterByCode([1, 'foo'], Criteria::IN); // WHERE code IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $code The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByCode($code = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $code = str_replace('*', '%', $code);
        }

        if (is_array($code) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$code of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyDiscountVoucherTableMap::COL_CODE, $code, $comparison);

        return $query;
    }

    /**
     * Filter the query on the is_active column
     *
     * Example usage:
     * <code>
     * $query->filterByIsActive(true); // WHERE is_active = true
     * $query->filterByIsActive('yes'); // WHERE is_active = true
     * </code>
     *
     * @param     bool|string $isActive The value to use as filter.
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
    public function filterByIsActive($isActive = null, $comparison = Criteria::EQUAL)
    {
        if (is_string($isActive)) {
            $isActive = in_array(strtolower($isActive), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $query = $this->addUsingAlias(SpyDiscountVoucherTableMap::COL_IS_ACTIVE, $isActive, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $maxNumberOfUses Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMaxNumberOfUses_Between(array $maxNumberOfUses)
    {
        return $this->filterByMaxNumberOfUses($maxNumberOfUses, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $maxNumberOfUsess Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMaxNumberOfUses_In(array $maxNumberOfUsess)
    {
        return $this->filterByMaxNumberOfUses($maxNumberOfUsess, Criteria::IN);
    }

    /**
     * Filter the query on the max_number_of_uses column
     *
     * Example usage:
     * <code>
     * $query->filterByMaxNumberOfUses(1234); // WHERE max_number_of_uses = 1234
     * $query->filterByMaxNumberOfUses(array(12, 34), Criteria::IN); // WHERE max_number_of_uses IN (12, 34)
     * $query->filterByMaxNumberOfUses(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE max_number_of_uses > 12
     * </code>
     *
     * @param     mixed $maxNumberOfUses The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByMaxNumberOfUses($maxNumberOfUses = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($maxNumberOfUses)) {
            $useMinMax = false;
            if (isset($maxNumberOfUses['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDiscountVoucherTableMap::COL_MAX_NUMBER_OF_USES, $maxNumberOfUses['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($maxNumberOfUses['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDiscountVoucherTableMap::COL_MAX_NUMBER_OF_USES, $maxNumberOfUses['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$maxNumberOfUses of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyDiscountVoucherTableMap::COL_MAX_NUMBER_OF_USES, $maxNumberOfUses, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $numberOfUses Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNumberOfUses_Between(array $numberOfUses)
    {
        return $this->filterByNumberOfUses($numberOfUses, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $numberOfUsess Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNumberOfUses_In(array $numberOfUsess)
    {
        return $this->filterByNumberOfUses($numberOfUsess, Criteria::IN);
    }

    /**
     * Filter the query on the number_of_uses column
     *
     * Example usage:
     * <code>
     * $query->filterByNumberOfUses(1234); // WHERE number_of_uses = 1234
     * $query->filterByNumberOfUses(array(12, 34), Criteria::IN); // WHERE number_of_uses IN (12, 34)
     * $query->filterByNumberOfUses(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE number_of_uses > 12
     * </code>
     *
     * @param     mixed $numberOfUses The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByNumberOfUses($numberOfUses = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($numberOfUses)) {
            $useMinMax = false;
            if (isset($numberOfUses['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDiscountVoucherTableMap::COL_NUMBER_OF_USES, $numberOfUses['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($numberOfUses['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDiscountVoucherTableMap::COL_NUMBER_OF_USES, $numberOfUses['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$numberOfUses of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyDiscountVoucherTableMap::COL_NUMBER_OF_USES, $numberOfUses, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $voucherBatch Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVoucherBatch_Between(array $voucherBatch)
    {
        return $this->filterByVoucherBatch($voucherBatch, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $voucherBatchs Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVoucherBatch_In(array $voucherBatchs)
    {
        return $this->filterByVoucherBatch($voucherBatchs, Criteria::IN);
    }

    /**
     * Filter the query on the voucher_batch column
     *
     * Example usage:
     * <code>
     * $query->filterByVoucherBatch(1234); // WHERE voucher_batch = 1234
     * $query->filterByVoucherBatch(array(12, 34), Criteria::IN); // WHERE voucher_batch IN (12, 34)
     * $query->filterByVoucherBatch(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE voucher_batch > 12
     * </code>
     *
     * @param     mixed $voucherBatch The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByVoucherBatch($voucherBatch = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($voucherBatch)) {
            $useMinMax = false;
            if (isset($voucherBatch['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDiscountVoucherTableMap::COL_VOUCHER_BATCH, $voucherBatch['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($voucherBatch['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDiscountVoucherTableMap::COL_VOUCHER_BATCH, $voucherBatch['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$voucherBatch of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyDiscountVoucherTableMap::COL_VOUCHER_BATCH, $voucherBatch, $comparison);

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
                $this->addUsingAlias(SpyDiscountVoucherTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDiscountVoucherTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyDiscountVoucherTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SpyDiscountVoucherTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDiscountVoucherTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyDiscountVoucherTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Discount\Persistence\SpyDiscountVoucherPool object
     *
     * @param \Orm\Zed\Discount\Persistence\SpyDiscountVoucherPool|ObjectCollection $spyDiscountVoucherPool The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVoucherPool($spyDiscountVoucherPool, ?string $comparison = null)
    {
        if ($spyDiscountVoucherPool instanceof \Orm\Zed\Discount\Persistence\SpyDiscountVoucherPool) {
            return $this
                ->addUsingAlias(SpyDiscountVoucherTableMap::COL_FK_DISCOUNT_VOUCHER_POOL, $spyDiscountVoucherPool->getIdDiscountVoucherPool(), $comparison);
        } elseif ($spyDiscountVoucherPool instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyDiscountVoucherTableMap::COL_FK_DISCOUNT_VOUCHER_POOL, $spyDiscountVoucherPool->toKeyValue('PrimaryKey', 'IdDiscountVoucherPool'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByVoucherPool() only accepts arguments of type \Orm\Zed\Discount\Persistence\SpyDiscountVoucherPool or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VoucherPool relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinVoucherPool(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VoucherPool');

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
            $this->addJoinObject($join, 'VoucherPool');
        }

        return $this;
    }

    /**
     * Use the VoucherPool relation SpyDiscountVoucherPool object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Discount\Persistence\SpyDiscountVoucherPoolQuery A secondary query class using the current class as primary query
     */
    public function useVoucherPoolQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinVoucherPool($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VoucherPool', '\Orm\Zed\Discount\Persistence\SpyDiscountVoucherPoolQuery');
    }

    /**
     * Use the VoucherPool relation SpyDiscountVoucherPool object
     *
     * @param callable(\Orm\Zed\Discount\Persistence\SpyDiscountVoucherPoolQuery):\Orm\Zed\Discount\Persistence\SpyDiscountVoucherPoolQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withVoucherPoolQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useVoucherPoolQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the VoucherPool relation to the SpyDiscountVoucherPool table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Discount\Persistence\SpyDiscountVoucherPoolQuery The inner query object of the EXISTS statement
     */
    public function useVoucherPoolExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Discount\Persistence\SpyDiscountVoucherPoolQuery */
        $q = $this->useExistsQuery('VoucherPool', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the VoucherPool relation to the SpyDiscountVoucherPool table for a NOT EXISTS query.
     *
     * @see useVoucherPoolExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Discount\Persistence\SpyDiscountVoucherPoolQuery The inner query object of the NOT EXISTS statement
     */
    public function useVoucherPoolNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Discount\Persistence\SpyDiscountVoucherPoolQuery */
        $q = $this->useExistsQuery('VoucherPool', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the VoucherPool relation to the SpyDiscountVoucherPool table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Discount\Persistence\SpyDiscountVoucherPoolQuery The inner query object of the IN statement
     */
    public function useInVoucherPoolQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Discount\Persistence\SpyDiscountVoucherPoolQuery */
        $q = $this->useInQuery('VoucherPool', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the VoucherPool relation to the SpyDiscountVoucherPool table for a NOT IN query.
     *
     * @see useVoucherPoolInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Discount\Persistence\SpyDiscountVoucherPoolQuery The inner query object of the NOT IN statement
     */
    public function useNotInVoucherPoolQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Discount\Persistence\SpyDiscountVoucherPoolQuery */
        $q = $this->useInQuery('VoucherPool', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyDiscountVoucher $spyDiscountVoucher Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyDiscountVoucher = null)
    {
        if ($spyDiscountVoucher) {
            $this->addUsingAlias(SpyDiscountVoucherTableMap::COL_ID_DISCOUNT_VOUCHER, $spyDiscountVoucher->getIdDiscountVoucher(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_discount_voucher table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyDiscountVoucherTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyDiscountVoucherTableMap::clearInstancePool();
            SpyDiscountVoucherTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyDiscountVoucherTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyDiscountVoucherTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyDiscountVoucherTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyDiscountVoucherTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(SpyDiscountVoucherTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyDiscountVoucherTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyDiscountVoucherTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyDiscountVoucherTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpyDiscountVoucherTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyDiscountVoucherTableMap::COL_CREATED_AT);

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
