<?php

namespace Orm\Zed\Payment\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\Payment\Persistence\SpyPaymentProvider as ChildSpyPaymentProvider;
use Orm\Zed\Payment\Persistence\SpyPaymentProviderQuery as ChildSpyPaymentProviderQuery;
use Orm\Zed\Payment\Persistence\Map\SpyPaymentProviderTableMap;
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
 * Base class that represents a query for the `spy_payment_provider` table.
 *
 * @method     ChildSpyPaymentProviderQuery orderByIdPaymentProvider($order = Criteria::ASC) Order by the id_payment_provider column
 * @method     ChildSpyPaymentProviderQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildSpyPaymentProviderQuery orderByPaymentProviderKey($order = Criteria::ASC) Order by the payment_provider_key column
 *
 * @method     ChildSpyPaymentProviderQuery groupByIdPaymentProvider() Group by the id_payment_provider column
 * @method     ChildSpyPaymentProviderQuery groupByName() Group by the name column
 * @method     ChildSpyPaymentProviderQuery groupByPaymentProviderKey() Group by the payment_provider_key column
 *
 * @method     ChildSpyPaymentProviderQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyPaymentProviderQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyPaymentProviderQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyPaymentProviderQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyPaymentProviderQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyPaymentProviderQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyPaymentProviderQuery leftJoinSpyPaymentMethod($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyPaymentMethod relation
 * @method     ChildSpyPaymentProviderQuery rightJoinSpyPaymentMethod($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyPaymentMethod relation
 * @method     ChildSpyPaymentProviderQuery innerJoinSpyPaymentMethod($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyPaymentMethod relation
 *
 * @method     ChildSpyPaymentProviderQuery joinWithSpyPaymentMethod($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyPaymentMethod relation
 *
 * @method     ChildSpyPaymentProviderQuery leftJoinWithSpyPaymentMethod() Adds a LEFT JOIN clause and with to the query using the SpyPaymentMethod relation
 * @method     ChildSpyPaymentProviderQuery rightJoinWithSpyPaymentMethod() Adds a RIGHT JOIN clause and with to the query using the SpyPaymentMethod relation
 * @method     ChildSpyPaymentProviderQuery innerJoinWithSpyPaymentMethod() Adds a INNER JOIN clause and with to the query using the SpyPaymentMethod relation
 *
 * @method     \Orm\Zed\Payment\Persistence\SpyPaymentMethodQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyPaymentProvider|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyPaymentProvider matching the query
 * @method     ChildSpyPaymentProvider findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyPaymentProvider matching the query, or a new ChildSpyPaymentProvider object populated from the query conditions when no match is found
 *
 * @method     ChildSpyPaymentProvider|null findOneByIdPaymentProvider(int $id_payment_provider) Return the first ChildSpyPaymentProvider filtered by the id_payment_provider column
 * @method     ChildSpyPaymentProvider|null findOneByName(string $name) Return the first ChildSpyPaymentProvider filtered by the name column
 * @method     ChildSpyPaymentProvider|null findOneByPaymentProviderKey(string $payment_provider_key) Return the first ChildSpyPaymentProvider filtered by the payment_provider_key column
 *
 * @method     ChildSpyPaymentProvider requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyPaymentProvider by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyPaymentProvider requireOne(?ConnectionInterface $con = null) Return the first ChildSpyPaymentProvider matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyPaymentProvider requireOneByIdPaymentProvider(int $id_payment_provider) Return the first ChildSpyPaymentProvider filtered by the id_payment_provider column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyPaymentProvider requireOneByName(string $name) Return the first ChildSpyPaymentProvider filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyPaymentProvider requireOneByPaymentProviderKey(string $payment_provider_key) Return the first ChildSpyPaymentProvider filtered by the payment_provider_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyPaymentProvider[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyPaymentProvider objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyPaymentProvider> find(?ConnectionInterface $con = null) Return ChildSpyPaymentProvider objects based on current ModelCriteria
 *
 * @method     ChildSpyPaymentProvider[]|Collection findByIdPaymentProvider(int|array<int> $id_payment_provider) Return ChildSpyPaymentProvider objects filtered by the id_payment_provider column
 * @psalm-method Collection&\Traversable<ChildSpyPaymentProvider> findByIdPaymentProvider(int|array<int> $id_payment_provider) Return ChildSpyPaymentProvider objects filtered by the id_payment_provider column
 * @method     ChildSpyPaymentProvider[]|Collection findByName(string|array<string> $name) Return ChildSpyPaymentProvider objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildSpyPaymentProvider> findByName(string|array<string> $name) Return ChildSpyPaymentProvider objects filtered by the name column
 * @method     ChildSpyPaymentProvider[]|Collection findByPaymentProviderKey(string|array<string> $payment_provider_key) Return ChildSpyPaymentProvider objects filtered by the payment_provider_key column
 * @psalm-method Collection&\Traversable<ChildSpyPaymentProvider> findByPaymentProviderKey(string|array<string> $payment_provider_key) Return ChildSpyPaymentProvider objects filtered by the payment_provider_key column
 *
 * @method     ChildSpyPaymentProvider[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyPaymentProvider> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyPaymentProviderQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\Payment\Persistence\Base\SpyPaymentProviderQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\Payment\\Persistence\\SpyPaymentProvider', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyPaymentProviderQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyPaymentProviderQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyPaymentProviderQuery) {
            return $criteria;
        }
        $query = new ChildSpyPaymentProviderQuery();
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
     * @return ChildSpyPaymentProvider|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyPaymentProviderTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyPaymentProvider A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id_payment_provider`, `name`, `payment_provider_key` FROM `spy_payment_provider` WHERE `id_payment_provider` = :p0';
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
            /** @var ChildSpyPaymentProvider $obj */
            $obj = new ChildSpyPaymentProvider();
            $obj->hydrate($row);
            SpyPaymentProviderTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyPaymentProvider|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyPaymentProviderTableMap::COL_ID_PAYMENT_PROVIDER, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyPaymentProviderTableMap::COL_ID_PAYMENT_PROVIDER, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idPaymentProvider Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdPaymentProvider_Between(array $idPaymentProvider)
    {
        return $this->filterByIdPaymentProvider($idPaymentProvider, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idPaymentProviders Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdPaymentProvider_In(array $idPaymentProviders)
    {
        return $this->filterByIdPaymentProvider($idPaymentProviders, Criteria::IN);
    }

    /**
     * Filter the query on the id_payment_provider column
     *
     * Example usage:
     * <code>
     * $query->filterByIdPaymentProvider(1234); // WHERE id_payment_provider = 1234
     * $query->filterByIdPaymentProvider(array(12, 34), Criteria::IN); // WHERE id_payment_provider IN (12, 34)
     * $query->filterByIdPaymentProvider(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_payment_provider > 12
     * </code>
     *
     * @param     mixed $idPaymentProvider The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdPaymentProvider($idPaymentProvider = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idPaymentProvider)) {
            $useMinMax = false;
            if (isset($idPaymentProvider['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyPaymentProviderTableMap::COL_ID_PAYMENT_PROVIDER, $idPaymentProvider['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idPaymentProvider['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyPaymentProviderTableMap::COL_ID_PAYMENT_PROVIDER, $idPaymentProvider['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idPaymentProvider of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyPaymentProviderTableMap::COL_ID_PAYMENT_PROVIDER, $idPaymentProvider, $comparison);

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

        $query = $this->addUsingAlias(SpyPaymentProviderTableMap::COL_NAME, $name, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $paymentProviderKeys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPaymentProviderKey_In(array $paymentProviderKeys)
    {
        return $this->filterByPaymentProviderKey($paymentProviderKeys, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $paymentProviderKey Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPaymentProviderKey_Like($paymentProviderKey)
    {
        return $this->filterByPaymentProviderKey($paymentProviderKey, Criteria::LIKE);
    }

    /**
     * Filter the query on the payment_provider_key column
     *
     * Example usage:
     * <code>
     * $query->filterByPaymentProviderKey('fooValue');   // WHERE payment_provider_key = 'fooValue'
     * $query->filterByPaymentProviderKey('%fooValue%', Criteria::LIKE); // WHERE payment_provider_key LIKE '%fooValue%'
     * $query->filterByPaymentProviderKey([1, 'foo'], Criteria::IN); // WHERE payment_provider_key IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $paymentProviderKey The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByPaymentProviderKey($paymentProviderKey = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $paymentProviderKey = str_replace('*', '%', $paymentProviderKey);
        }

        if (is_array($paymentProviderKey) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$paymentProviderKey of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyPaymentProviderTableMap::COL_PAYMENT_PROVIDER_KEY, $paymentProviderKey, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Payment\Persistence\SpyPaymentMethod object
     *
     * @param \Orm\Zed\Payment\Persistence\SpyPaymentMethod|ObjectCollection $spyPaymentMethod the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyPaymentMethod($spyPaymentMethod, ?string $comparison = null)
    {
        if ($spyPaymentMethod instanceof \Orm\Zed\Payment\Persistence\SpyPaymentMethod) {
            $this
                ->addUsingAlias(SpyPaymentProviderTableMap::COL_ID_PAYMENT_PROVIDER, $spyPaymentMethod->getFkPaymentProvider(), $comparison);

            return $this;
        } elseif ($spyPaymentMethod instanceof ObjectCollection) {
            $this
                ->useSpyPaymentMethodQuery()
                ->filterByPrimaryKeys($spyPaymentMethod->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyPaymentMethod() only accepts arguments of type \Orm\Zed\Payment\Persistence\SpyPaymentMethod or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyPaymentMethod relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyPaymentMethod(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyPaymentMethod');

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
            $this->addJoinObject($join, 'SpyPaymentMethod');
        }

        return $this;
    }

    /**
     * Use the SpyPaymentMethod relation SpyPaymentMethod object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Payment\Persistence\SpyPaymentMethodQuery A secondary query class using the current class as primary query
     */
    public function useSpyPaymentMethodQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyPaymentMethod($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyPaymentMethod', '\Orm\Zed\Payment\Persistence\SpyPaymentMethodQuery');
    }

    /**
     * Use the SpyPaymentMethod relation SpyPaymentMethod object
     *
     * @param callable(\Orm\Zed\Payment\Persistence\SpyPaymentMethodQuery):\Orm\Zed\Payment\Persistence\SpyPaymentMethodQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyPaymentMethodQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyPaymentMethodQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyPaymentMethod table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Payment\Persistence\SpyPaymentMethodQuery The inner query object of the EXISTS statement
     */
    public function useSpyPaymentMethodExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Payment\Persistence\SpyPaymentMethodQuery */
        $q = $this->useExistsQuery('SpyPaymentMethod', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyPaymentMethod table for a NOT EXISTS query.
     *
     * @see useSpyPaymentMethodExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Payment\Persistence\SpyPaymentMethodQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyPaymentMethodNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Payment\Persistence\SpyPaymentMethodQuery */
        $q = $this->useExistsQuery('SpyPaymentMethod', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyPaymentMethod table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Payment\Persistence\SpyPaymentMethodQuery The inner query object of the IN statement
     */
    public function useInSpyPaymentMethodQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Payment\Persistence\SpyPaymentMethodQuery */
        $q = $this->useInQuery('SpyPaymentMethod', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyPaymentMethod table for a NOT IN query.
     *
     * @see useSpyPaymentMethodInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Payment\Persistence\SpyPaymentMethodQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyPaymentMethodQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Payment\Persistence\SpyPaymentMethodQuery */
        $q = $this->useInQuery('SpyPaymentMethod', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyPaymentProvider $spyPaymentProvider Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyPaymentProvider = null)
    {
        if ($spyPaymentProvider) {
            $this->addUsingAlias(SpyPaymentProviderTableMap::COL_ID_PAYMENT_PROVIDER, $spyPaymentProvider->getIdPaymentProvider(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_payment_provider table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPaymentProviderTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyPaymentProviderTableMap::clearInstancePool();
            SpyPaymentProviderTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPaymentProviderTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyPaymentProviderTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyPaymentProviderTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyPaymentProviderTableMap::clearRelatedInstancePool();

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
