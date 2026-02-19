<?php

namespace Orm\Zed\MerchantCommission\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\Currency\Persistence\SpyCurrency;
use Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionAmount as ChildSpyMerchantCommissionAmount;
use Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionAmountQuery as ChildSpyMerchantCommissionAmountQuery;
use Orm\Zed\MerchantCommission\Persistence\Map\SpyMerchantCommissionAmountTableMap;
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
 * Base class that represents a query for the `spy_merchant_commission_amount` table.
 *
 * @method     ChildSpyMerchantCommissionAmountQuery orderByIdMerchantCommissionAmount($order = Criteria::ASC) Order by the id_merchant_commission_amount column
 * @method     ChildSpyMerchantCommissionAmountQuery orderByFkCurrency($order = Criteria::ASC) Order by the fk_currency column
 * @method     ChildSpyMerchantCommissionAmountQuery orderByFkMerchantCommission($order = Criteria::ASC) Order by the fk_merchant_commission column
 * @method     ChildSpyMerchantCommissionAmountQuery orderByGrossAmount($order = Criteria::ASC) Order by the gross_amount column
 * @method     ChildSpyMerchantCommissionAmountQuery orderByNetAmount($order = Criteria::ASC) Order by the net_amount column
 * @method     ChildSpyMerchantCommissionAmountQuery orderByUuid($order = Criteria::ASC) Order by the uuid column
 *
 * @method     ChildSpyMerchantCommissionAmountQuery groupByIdMerchantCommissionAmount() Group by the id_merchant_commission_amount column
 * @method     ChildSpyMerchantCommissionAmountQuery groupByFkCurrency() Group by the fk_currency column
 * @method     ChildSpyMerchantCommissionAmountQuery groupByFkMerchantCommission() Group by the fk_merchant_commission column
 * @method     ChildSpyMerchantCommissionAmountQuery groupByGrossAmount() Group by the gross_amount column
 * @method     ChildSpyMerchantCommissionAmountQuery groupByNetAmount() Group by the net_amount column
 * @method     ChildSpyMerchantCommissionAmountQuery groupByUuid() Group by the uuid column
 *
 * @method     ChildSpyMerchantCommissionAmountQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyMerchantCommissionAmountQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyMerchantCommissionAmountQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyMerchantCommissionAmountQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyMerchantCommissionAmountQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyMerchantCommissionAmountQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyMerchantCommissionAmountQuery leftJoinCurrency($relationAlias = null) Adds a LEFT JOIN clause to the query using the Currency relation
 * @method     ChildSpyMerchantCommissionAmountQuery rightJoinCurrency($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Currency relation
 * @method     ChildSpyMerchantCommissionAmountQuery innerJoinCurrency($relationAlias = null) Adds a INNER JOIN clause to the query using the Currency relation
 *
 * @method     ChildSpyMerchantCommissionAmountQuery joinWithCurrency($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Currency relation
 *
 * @method     ChildSpyMerchantCommissionAmountQuery leftJoinWithCurrency() Adds a LEFT JOIN clause and with to the query using the Currency relation
 * @method     ChildSpyMerchantCommissionAmountQuery rightJoinWithCurrency() Adds a RIGHT JOIN clause and with to the query using the Currency relation
 * @method     ChildSpyMerchantCommissionAmountQuery innerJoinWithCurrency() Adds a INNER JOIN clause and with to the query using the Currency relation
 *
 * @method     ChildSpyMerchantCommissionAmountQuery leftJoinMerchantCommission($relationAlias = null) Adds a LEFT JOIN clause to the query using the MerchantCommission relation
 * @method     ChildSpyMerchantCommissionAmountQuery rightJoinMerchantCommission($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MerchantCommission relation
 * @method     ChildSpyMerchantCommissionAmountQuery innerJoinMerchantCommission($relationAlias = null) Adds a INNER JOIN clause to the query using the MerchantCommission relation
 *
 * @method     ChildSpyMerchantCommissionAmountQuery joinWithMerchantCommission($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the MerchantCommission relation
 *
 * @method     ChildSpyMerchantCommissionAmountQuery leftJoinWithMerchantCommission() Adds a LEFT JOIN clause and with to the query using the MerchantCommission relation
 * @method     ChildSpyMerchantCommissionAmountQuery rightJoinWithMerchantCommission() Adds a RIGHT JOIN clause and with to the query using the MerchantCommission relation
 * @method     ChildSpyMerchantCommissionAmountQuery innerJoinWithMerchantCommission() Adds a INNER JOIN clause and with to the query using the MerchantCommission relation
 *
 * @method     \Orm\Zed\Currency\Persistence\SpyCurrencyQuery|\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyMerchantCommissionAmount|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyMerchantCommissionAmount matching the query
 * @method     ChildSpyMerchantCommissionAmount findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyMerchantCommissionAmount matching the query, or a new ChildSpyMerchantCommissionAmount object populated from the query conditions when no match is found
 *
 * @method     ChildSpyMerchantCommissionAmount|null findOneByIdMerchantCommissionAmount(int $id_merchant_commission_amount) Return the first ChildSpyMerchantCommissionAmount filtered by the id_merchant_commission_amount column
 * @method     ChildSpyMerchantCommissionAmount|null findOneByFkCurrency(int $fk_currency) Return the first ChildSpyMerchantCommissionAmount filtered by the fk_currency column
 * @method     ChildSpyMerchantCommissionAmount|null findOneByFkMerchantCommission(int $fk_merchant_commission) Return the first ChildSpyMerchantCommissionAmount filtered by the fk_merchant_commission column
 * @method     ChildSpyMerchantCommissionAmount|null findOneByGrossAmount(int $gross_amount) Return the first ChildSpyMerchantCommissionAmount filtered by the gross_amount column
 * @method     ChildSpyMerchantCommissionAmount|null findOneByNetAmount(int $net_amount) Return the first ChildSpyMerchantCommissionAmount filtered by the net_amount column
 * @method     ChildSpyMerchantCommissionAmount|null findOneByUuid(string $uuid) Return the first ChildSpyMerchantCommissionAmount filtered by the uuid column
 *
 * @method     ChildSpyMerchantCommissionAmount requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyMerchantCommissionAmount by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantCommissionAmount requireOne(?ConnectionInterface $con = null) Return the first ChildSpyMerchantCommissionAmount matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyMerchantCommissionAmount requireOneByIdMerchantCommissionAmount(int $id_merchant_commission_amount) Return the first ChildSpyMerchantCommissionAmount filtered by the id_merchant_commission_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantCommissionAmount requireOneByFkCurrency(int $fk_currency) Return the first ChildSpyMerchantCommissionAmount filtered by the fk_currency column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantCommissionAmount requireOneByFkMerchantCommission(int $fk_merchant_commission) Return the first ChildSpyMerchantCommissionAmount filtered by the fk_merchant_commission column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantCommissionAmount requireOneByGrossAmount(int $gross_amount) Return the first ChildSpyMerchantCommissionAmount filtered by the gross_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantCommissionAmount requireOneByNetAmount(int $net_amount) Return the first ChildSpyMerchantCommissionAmount filtered by the net_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantCommissionAmount requireOneByUuid(string $uuid) Return the first ChildSpyMerchantCommissionAmount filtered by the uuid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyMerchantCommissionAmount[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyMerchantCommissionAmount objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyMerchantCommissionAmount> find(?ConnectionInterface $con = null) Return ChildSpyMerchantCommissionAmount objects based on current ModelCriteria
 *
 * @method     ChildSpyMerchantCommissionAmount[]|Collection findByIdMerchantCommissionAmount(int|array<int> $id_merchant_commission_amount) Return ChildSpyMerchantCommissionAmount objects filtered by the id_merchant_commission_amount column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantCommissionAmount> findByIdMerchantCommissionAmount(int|array<int> $id_merchant_commission_amount) Return ChildSpyMerchantCommissionAmount objects filtered by the id_merchant_commission_amount column
 * @method     ChildSpyMerchantCommissionAmount[]|Collection findByFkCurrency(int|array<int> $fk_currency) Return ChildSpyMerchantCommissionAmount objects filtered by the fk_currency column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantCommissionAmount> findByFkCurrency(int|array<int> $fk_currency) Return ChildSpyMerchantCommissionAmount objects filtered by the fk_currency column
 * @method     ChildSpyMerchantCommissionAmount[]|Collection findByFkMerchantCommission(int|array<int> $fk_merchant_commission) Return ChildSpyMerchantCommissionAmount objects filtered by the fk_merchant_commission column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantCommissionAmount> findByFkMerchantCommission(int|array<int> $fk_merchant_commission) Return ChildSpyMerchantCommissionAmount objects filtered by the fk_merchant_commission column
 * @method     ChildSpyMerchantCommissionAmount[]|Collection findByGrossAmount(int|array<int> $gross_amount) Return ChildSpyMerchantCommissionAmount objects filtered by the gross_amount column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantCommissionAmount> findByGrossAmount(int|array<int> $gross_amount) Return ChildSpyMerchantCommissionAmount objects filtered by the gross_amount column
 * @method     ChildSpyMerchantCommissionAmount[]|Collection findByNetAmount(int|array<int> $net_amount) Return ChildSpyMerchantCommissionAmount objects filtered by the net_amount column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantCommissionAmount> findByNetAmount(int|array<int> $net_amount) Return ChildSpyMerchantCommissionAmount objects filtered by the net_amount column
 * @method     ChildSpyMerchantCommissionAmount[]|Collection findByUuid(string|array<string> $uuid) Return ChildSpyMerchantCommissionAmount objects filtered by the uuid column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantCommissionAmount> findByUuid(string|array<string> $uuid) Return ChildSpyMerchantCommissionAmount objects filtered by the uuid column
 *
 * @method     ChildSpyMerchantCommissionAmount[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyMerchantCommissionAmount> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyMerchantCommissionAmountQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\MerchantCommission\Persistence\Base\SpyMerchantCommissionAmountQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\MerchantCommission\\Persistence\\SpyMerchantCommissionAmount', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyMerchantCommissionAmountQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyMerchantCommissionAmountQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyMerchantCommissionAmountQuery) {
            return $criteria;
        }
        $query = new ChildSpyMerchantCommissionAmountQuery();
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
     * @return ChildSpyMerchantCommissionAmount|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyMerchantCommissionAmountTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyMerchantCommissionAmount A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_merchant_commission_amount, fk_currency, fk_merchant_commission, gross_amount, net_amount, uuid FROM spy_merchant_commission_amount WHERE id_merchant_commission_amount = :p0';
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
            /** @var ChildSpyMerchantCommissionAmount $obj */
            $obj = new ChildSpyMerchantCommissionAmount();
            $obj->hydrate($row);
            SpyMerchantCommissionAmountTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyMerchantCommissionAmount|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyMerchantCommissionAmountTableMap::COL_ID_MERCHANT_COMMISSION_AMOUNT, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyMerchantCommissionAmountTableMap::COL_ID_MERCHANT_COMMISSION_AMOUNT, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idMerchantCommissionAmount Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdMerchantCommissionAmount_Between(array $idMerchantCommissionAmount)
    {
        return $this->filterByIdMerchantCommissionAmount($idMerchantCommissionAmount, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idMerchantCommissionAmounts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdMerchantCommissionAmount_In(array $idMerchantCommissionAmounts)
    {
        return $this->filterByIdMerchantCommissionAmount($idMerchantCommissionAmounts, Criteria::IN);
    }

    /**
     * Filter the query on the id_merchant_commission_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByIdMerchantCommissionAmount(1234); // WHERE id_merchant_commission_amount = 1234
     * $query->filterByIdMerchantCommissionAmount(array(12, 34), Criteria::IN); // WHERE id_merchant_commission_amount IN (12, 34)
     * $query->filterByIdMerchantCommissionAmount(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_merchant_commission_amount > 12
     * </code>
     *
     * @param     mixed $idMerchantCommissionAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdMerchantCommissionAmount($idMerchantCommissionAmount = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idMerchantCommissionAmount)) {
            $useMinMax = false;
            if (isset($idMerchantCommissionAmount['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantCommissionAmountTableMap::COL_ID_MERCHANT_COMMISSION_AMOUNT, $idMerchantCommissionAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idMerchantCommissionAmount['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantCommissionAmountTableMap::COL_ID_MERCHANT_COMMISSION_AMOUNT, $idMerchantCommissionAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idMerchantCommissionAmount of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantCommissionAmountTableMap::COL_ID_MERCHANT_COMMISSION_AMOUNT, $idMerchantCommissionAmount, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkCurrency Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCurrency_Between(array $fkCurrency)
    {
        return $this->filterByFkCurrency($fkCurrency, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkCurrencys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCurrency_In(array $fkCurrencys)
    {
        return $this->filterByFkCurrency($fkCurrencys, Criteria::IN);
    }

    /**
     * Filter the query on the fk_currency column
     *
     * Example usage:
     * <code>
     * $query->filterByFkCurrency(1234); // WHERE fk_currency = 1234
     * $query->filterByFkCurrency(array(12, 34), Criteria::IN); // WHERE fk_currency IN (12, 34)
     * $query->filterByFkCurrency(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_currency > 12
     * </code>
     *
     * @see       filterByCurrency()
     *
     * @param     mixed $fkCurrency The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkCurrency($fkCurrency = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkCurrency)) {
            $useMinMax = false;
            if (isset($fkCurrency['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantCommissionAmountTableMap::COL_FK_CURRENCY, $fkCurrency['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkCurrency['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantCommissionAmountTableMap::COL_FK_CURRENCY, $fkCurrency['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkCurrency of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantCommissionAmountTableMap::COL_FK_CURRENCY, $fkCurrency, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkMerchantCommission Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkMerchantCommission_Between(array $fkMerchantCommission)
    {
        return $this->filterByFkMerchantCommission($fkMerchantCommission, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkMerchantCommissions Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkMerchantCommission_In(array $fkMerchantCommissions)
    {
        return $this->filterByFkMerchantCommission($fkMerchantCommissions, Criteria::IN);
    }

    /**
     * Filter the query on the fk_merchant_commission column
     *
     * Example usage:
     * <code>
     * $query->filterByFkMerchantCommission(1234); // WHERE fk_merchant_commission = 1234
     * $query->filterByFkMerchantCommission(array(12, 34), Criteria::IN); // WHERE fk_merchant_commission IN (12, 34)
     * $query->filterByFkMerchantCommission(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_merchant_commission > 12
     * </code>
     *
     * @see       filterByMerchantCommission()
     *
     * @param     mixed $fkMerchantCommission The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkMerchantCommission($fkMerchantCommission = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkMerchantCommission)) {
            $useMinMax = false;
            if (isset($fkMerchantCommission['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantCommissionAmountTableMap::COL_FK_MERCHANT_COMMISSION, $fkMerchantCommission['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkMerchantCommission['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantCommissionAmountTableMap::COL_FK_MERCHANT_COMMISSION, $fkMerchantCommission['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkMerchantCommission of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantCommissionAmountTableMap::COL_FK_MERCHANT_COMMISSION, $fkMerchantCommission, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $grossAmount Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGrossAmount_Between(array $grossAmount)
    {
        return $this->filterByGrossAmount($grossAmount, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $grossAmounts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGrossAmount_In(array $grossAmounts)
    {
        return $this->filterByGrossAmount($grossAmounts, Criteria::IN);
    }

    /**
     * Filter the query on the gross_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByGrossAmount(1234); // WHERE gross_amount = 1234
     * $query->filterByGrossAmount(array(12, 34), Criteria::IN); // WHERE gross_amount IN (12, 34)
     * $query->filterByGrossAmount(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE gross_amount > 12
     * </code>
     *
     * @param     mixed $grossAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByGrossAmount($grossAmount = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($grossAmount)) {
            $useMinMax = false;
            if (isset($grossAmount['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantCommissionAmountTableMap::COL_GROSS_AMOUNT, $grossAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($grossAmount['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantCommissionAmountTableMap::COL_GROSS_AMOUNT, $grossAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$grossAmount of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantCommissionAmountTableMap::COL_GROSS_AMOUNT, $grossAmount, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $netAmount Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNetAmount_Between(array $netAmount)
    {
        return $this->filterByNetAmount($netAmount, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $netAmounts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNetAmount_In(array $netAmounts)
    {
        return $this->filterByNetAmount($netAmounts, Criteria::IN);
    }

    /**
     * Filter the query on the net_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByNetAmount(1234); // WHERE net_amount = 1234
     * $query->filterByNetAmount(array(12, 34), Criteria::IN); // WHERE net_amount IN (12, 34)
     * $query->filterByNetAmount(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE net_amount > 12
     * </code>
     *
     * @param     mixed $netAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByNetAmount($netAmount = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($netAmount)) {
            $useMinMax = false;
            if (isset($netAmount['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantCommissionAmountTableMap::COL_NET_AMOUNT, $netAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($netAmount['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantCommissionAmountTableMap::COL_NET_AMOUNT, $netAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$netAmount of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantCommissionAmountTableMap::COL_NET_AMOUNT, $netAmount, $comparison);

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

        $query = $this->addUsingAlias(SpyMerchantCommissionAmountTableMap::COL_UUID, $uuid, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Currency\Persistence\SpyCurrency object
     *
     * @param \Orm\Zed\Currency\Persistence\SpyCurrency|ObjectCollection $spyCurrency The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCurrency($spyCurrency, ?string $comparison = null)
    {
        if ($spyCurrency instanceof \Orm\Zed\Currency\Persistence\SpyCurrency) {
            return $this
                ->addUsingAlias(SpyMerchantCommissionAmountTableMap::COL_FK_CURRENCY, $spyCurrency->getIdCurrency(), $comparison);
        } elseif ($spyCurrency instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyMerchantCommissionAmountTableMap::COL_FK_CURRENCY, $spyCurrency->toKeyValue('PrimaryKey', 'IdCurrency'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCurrency() only accepts arguments of type \Orm\Zed\Currency\Persistence\SpyCurrency or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Currency relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCurrency(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Currency');

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
            $this->addJoinObject($join, 'Currency');
        }

        return $this;
    }

    /**
     * Use the Currency relation SpyCurrency object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Currency\Persistence\SpyCurrencyQuery A secondary query class using the current class as primary query
     */
    public function useCurrencyQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCurrency($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Currency', '\Orm\Zed\Currency\Persistence\SpyCurrencyQuery');
    }

    /**
     * Use the Currency relation SpyCurrency object
     *
     * @param callable(\Orm\Zed\Currency\Persistence\SpyCurrencyQuery):\Orm\Zed\Currency\Persistence\SpyCurrencyQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCurrencyQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCurrencyQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the Currency relation to the SpyCurrency table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Currency\Persistence\SpyCurrencyQuery The inner query object of the EXISTS statement
     */
    public function useCurrencyExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Currency\Persistence\SpyCurrencyQuery */
        $q = $this->useExistsQuery('Currency', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the Currency relation to the SpyCurrency table for a NOT EXISTS query.
     *
     * @see useCurrencyExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Currency\Persistence\SpyCurrencyQuery The inner query object of the NOT EXISTS statement
     */
    public function useCurrencyNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Currency\Persistence\SpyCurrencyQuery */
        $q = $this->useExistsQuery('Currency', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the Currency relation to the SpyCurrency table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Currency\Persistence\SpyCurrencyQuery The inner query object of the IN statement
     */
    public function useInCurrencyQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Currency\Persistence\SpyCurrencyQuery */
        $q = $this->useInQuery('Currency', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the Currency relation to the SpyCurrency table for a NOT IN query.
     *
     * @see useCurrencyInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Currency\Persistence\SpyCurrencyQuery The inner query object of the NOT IN statement
     */
    public function useNotInCurrencyQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Currency\Persistence\SpyCurrencyQuery */
        $q = $this->useInQuery('Currency', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommission object
     *
     * @param \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommission|ObjectCollection $spyMerchantCommission The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMerchantCommission($spyMerchantCommission, ?string $comparison = null)
    {
        if ($spyMerchantCommission instanceof \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommission) {
            return $this
                ->addUsingAlias(SpyMerchantCommissionAmountTableMap::COL_FK_MERCHANT_COMMISSION, $spyMerchantCommission->getIdMerchantCommission(), $comparison);
        } elseif ($spyMerchantCommission instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyMerchantCommissionAmountTableMap::COL_FK_MERCHANT_COMMISSION, $spyMerchantCommission->toKeyValue('PrimaryKey', 'IdMerchantCommission'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByMerchantCommission() only accepts arguments of type \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommission or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MerchantCommission relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinMerchantCommission(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MerchantCommission');

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
            $this->addJoinObject($join, 'MerchantCommission');
        }

        return $this;
    }

    /**
     * Use the MerchantCommission relation SpyMerchantCommission object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionQuery A secondary query class using the current class as primary query
     */
    public function useMerchantCommissionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMerchantCommission($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MerchantCommission', '\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionQuery');
    }

    /**
     * Use the MerchantCommission relation SpyMerchantCommission object
     *
     * @param callable(\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionQuery):\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withMerchantCommissionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useMerchantCommissionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the MerchantCommission relation to the SpyMerchantCommission table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionQuery The inner query object of the EXISTS statement
     */
    public function useMerchantCommissionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionQuery */
        $q = $this->useExistsQuery('MerchantCommission', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the MerchantCommission relation to the SpyMerchantCommission table for a NOT EXISTS query.
     *
     * @see useMerchantCommissionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionQuery The inner query object of the NOT EXISTS statement
     */
    public function useMerchantCommissionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionQuery */
        $q = $this->useExistsQuery('MerchantCommission', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the MerchantCommission relation to the SpyMerchantCommission table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionQuery The inner query object of the IN statement
     */
    public function useInMerchantCommissionQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionQuery */
        $q = $this->useInQuery('MerchantCommission', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the MerchantCommission relation to the SpyMerchantCommission table for a NOT IN query.
     *
     * @see useMerchantCommissionInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionQuery The inner query object of the NOT IN statement
     */
    public function useNotInMerchantCommissionQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionQuery */
        $q = $this->useInQuery('MerchantCommission', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyMerchantCommissionAmount $spyMerchantCommissionAmount Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyMerchantCommissionAmount = null)
    {
        if ($spyMerchantCommissionAmount) {
            $this->addUsingAlias(SpyMerchantCommissionAmountTableMap::COL_ID_MERCHANT_COMMISSION_AMOUNT, $spyMerchantCommissionAmount->getIdMerchantCommissionAmount(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_merchant_commission_amount table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantCommissionAmountTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyMerchantCommissionAmountTableMap::clearInstancePool();
            SpyMerchantCommissionAmountTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantCommissionAmountTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyMerchantCommissionAmountTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyMerchantCommissionAmountTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyMerchantCommissionAmountTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
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
