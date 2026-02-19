<?php

namespace Orm\Zed\CustomerAccess\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\CustomerAccess\Persistence\SpyUnauthenticatedCustomerAccess as ChildSpyUnauthenticatedCustomerAccess;
use Orm\Zed\CustomerAccess\Persistence\SpyUnauthenticatedCustomerAccessQuery as ChildSpyUnauthenticatedCustomerAccessQuery;
use Orm\Zed\CustomerAccess\Persistence\Map\SpyUnauthenticatedCustomerAccessTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Spryker\Zed\PropelOrm\Business\Model\Formatter\TypeAwareSimpleArrayFormatter;
use Spryker\Zed\PropelOrm\Business\Runtime\ActiveQuery\Criteria as SprykerCriteria;
use Spryker\Zed\PropelReplicationCache\Business\PropelReplicationCacheFacade;
use Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException;

/**
 * Base class that represents a query for the `spy_unauthenticated_customer_access` table.
 *
 * @method     ChildSpyUnauthenticatedCustomerAccessQuery orderByIdUnauthenticatedCustomerAccess($order = Criteria::ASC) Order by the id_unauthenticated_customer_access column
 * @method     ChildSpyUnauthenticatedCustomerAccessQuery orderByContentType($order = Criteria::ASC) Order by the content_type column
 * @method     ChildSpyUnauthenticatedCustomerAccessQuery orderByIsRestricted($order = Criteria::ASC) Order by the is_restricted column
 *
 * @method     ChildSpyUnauthenticatedCustomerAccessQuery groupByIdUnauthenticatedCustomerAccess() Group by the id_unauthenticated_customer_access column
 * @method     ChildSpyUnauthenticatedCustomerAccessQuery groupByContentType() Group by the content_type column
 * @method     ChildSpyUnauthenticatedCustomerAccessQuery groupByIsRestricted() Group by the is_restricted column
 *
 * @method     ChildSpyUnauthenticatedCustomerAccessQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyUnauthenticatedCustomerAccessQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyUnauthenticatedCustomerAccessQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyUnauthenticatedCustomerAccessQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyUnauthenticatedCustomerAccessQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyUnauthenticatedCustomerAccessQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyUnauthenticatedCustomerAccess|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyUnauthenticatedCustomerAccess matching the query
 * @method     ChildSpyUnauthenticatedCustomerAccess findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyUnauthenticatedCustomerAccess matching the query, or a new ChildSpyUnauthenticatedCustomerAccess object populated from the query conditions when no match is found
 *
 * @method     ChildSpyUnauthenticatedCustomerAccess|null findOneByIdUnauthenticatedCustomerAccess(int $id_unauthenticated_customer_access) Return the first ChildSpyUnauthenticatedCustomerAccess filtered by the id_unauthenticated_customer_access column
 * @method     ChildSpyUnauthenticatedCustomerAccess|null findOneByContentType(string $content_type) Return the first ChildSpyUnauthenticatedCustomerAccess filtered by the content_type column
 * @method     ChildSpyUnauthenticatedCustomerAccess|null findOneByIsRestricted(boolean $is_restricted) Return the first ChildSpyUnauthenticatedCustomerAccess filtered by the is_restricted column
 *
 * @method     ChildSpyUnauthenticatedCustomerAccess requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyUnauthenticatedCustomerAccess by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyUnauthenticatedCustomerAccess requireOne(?ConnectionInterface $con = null) Return the first ChildSpyUnauthenticatedCustomerAccess matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyUnauthenticatedCustomerAccess requireOneByIdUnauthenticatedCustomerAccess(int $id_unauthenticated_customer_access) Return the first ChildSpyUnauthenticatedCustomerAccess filtered by the id_unauthenticated_customer_access column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyUnauthenticatedCustomerAccess requireOneByContentType(string $content_type) Return the first ChildSpyUnauthenticatedCustomerAccess filtered by the content_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyUnauthenticatedCustomerAccess requireOneByIsRestricted(boolean $is_restricted) Return the first ChildSpyUnauthenticatedCustomerAccess filtered by the is_restricted column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyUnauthenticatedCustomerAccess[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyUnauthenticatedCustomerAccess objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyUnauthenticatedCustomerAccess> find(?ConnectionInterface $con = null) Return ChildSpyUnauthenticatedCustomerAccess objects based on current ModelCriteria
 *
 * @method     ChildSpyUnauthenticatedCustomerAccess[]|Collection findByIdUnauthenticatedCustomerAccess(int|array<int> $id_unauthenticated_customer_access) Return ChildSpyUnauthenticatedCustomerAccess objects filtered by the id_unauthenticated_customer_access column
 * @psalm-method Collection&\Traversable<ChildSpyUnauthenticatedCustomerAccess> findByIdUnauthenticatedCustomerAccess(int|array<int> $id_unauthenticated_customer_access) Return ChildSpyUnauthenticatedCustomerAccess objects filtered by the id_unauthenticated_customer_access column
 * @method     ChildSpyUnauthenticatedCustomerAccess[]|Collection findByContentType(string|array<string> $content_type) Return ChildSpyUnauthenticatedCustomerAccess objects filtered by the content_type column
 * @psalm-method Collection&\Traversable<ChildSpyUnauthenticatedCustomerAccess> findByContentType(string|array<string> $content_type) Return ChildSpyUnauthenticatedCustomerAccess objects filtered by the content_type column
 * @method     ChildSpyUnauthenticatedCustomerAccess[]|Collection findByIsRestricted(boolean|array<boolean> $is_restricted) Return ChildSpyUnauthenticatedCustomerAccess objects filtered by the is_restricted column
 * @psalm-method Collection&\Traversable<ChildSpyUnauthenticatedCustomerAccess> findByIsRestricted(boolean|array<boolean> $is_restricted) Return ChildSpyUnauthenticatedCustomerAccess objects filtered by the is_restricted column
 *
 * @method     ChildSpyUnauthenticatedCustomerAccess[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyUnauthenticatedCustomerAccess> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyUnauthenticatedCustomerAccessQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\CustomerAccess\Persistence\Base\SpyUnauthenticatedCustomerAccessQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\CustomerAccess\\Persistence\\SpyUnauthenticatedCustomerAccess', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyUnauthenticatedCustomerAccessQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyUnauthenticatedCustomerAccessQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyUnauthenticatedCustomerAccessQuery) {
            return $criteria;
        }
        $query = new ChildSpyUnauthenticatedCustomerAccessQuery();
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
     * @return ChildSpyUnauthenticatedCustomerAccess|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyUnauthenticatedCustomerAccessTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyUnauthenticatedCustomerAccess A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id_unauthenticated_customer_access`, `content_type`, `is_restricted` FROM `spy_unauthenticated_customer_access` WHERE `id_unauthenticated_customer_access` = :p0';
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
            /** @var ChildSpyUnauthenticatedCustomerAccess $obj */
            $obj = new ChildSpyUnauthenticatedCustomerAccess();
            $obj->hydrate($row);
            SpyUnauthenticatedCustomerAccessTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyUnauthenticatedCustomerAccess|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyUnauthenticatedCustomerAccessTableMap::COL_ID_UNAUTHENTICATED_CUSTOMER_ACCESS, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyUnauthenticatedCustomerAccessTableMap::COL_ID_UNAUTHENTICATED_CUSTOMER_ACCESS, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idUnauthenticatedCustomerAccess Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdUnauthenticatedCustomerAccess_Between(array $idUnauthenticatedCustomerAccess)
    {
        return $this->filterByIdUnauthenticatedCustomerAccess($idUnauthenticatedCustomerAccess, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idUnauthenticatedCustomerAccesss Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdUnauthenticatedCustomerAccess_In(array $idUnauthenticatedCustomerAccesss)
    {
        return $this->filterByIdUnauthenticatedCustomerAccess($idUnauthenticatedCustomerAccesss, Criteria::IN);
    }

    /**
     * Filter the query on the id_unauthenticated_customer_access column
     *
     * Example usage:
     * <code>
     * $query->filterByIdUnauthenticatedCustomerAccess(1234); // WHERE id_unauthenticated_customer_access = 1234
     * $query->filterByIdUnauthenticatedCustomerAccess(array(12, 34), Criteria::IN); // WHERE id_unauthenticated_customer_access IN (12, 34)
     * $query->filterByIdUnauthenticatedCustomerAccess(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_unauthenticated_customer_access > 12
     * </code>
     *
     * @param     mixed $idUnauthenticatedCustomerAccess The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdUnauthenticatedCustomerAccess($idUnauthenticatedCustomerAccess = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idUnauthenticatedCustomerAccess)) {
            $useMinMax = false;
            if (isset($idUnauthenticatedCustomerAccess['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyUnauthenticatedCustomerAccessTableMap::COL_ID_UNAUTHENTICATED_CUSTOMER_ACCESS, $idUnauthenticatedCustomerAccess['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUnauthenticatedCustomerAccess['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyUnauthenticatedCustomerAccessTableMap::COL_ID_UNAUTHENTICATED_CUSTOMER_ACCESS, $idUnauthenticatedCustomerAccess['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idUnauthenticatedCustomerAccess of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyUnauthenticatedCustomerAccessTableMap::COL_ID_UNAUTHENTICATED_CUSTOMER_ACCESS, $idUnauthenticatedCustomerAccess, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $contentTypes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByContentType_In(array $contentTypes)
    {
        return $this->filterByContentType($contentTypes, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $contentType Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByContentType_Like($contentType)
    {
        return $this->filterByContentType($contentType, Criteria::LIKE);
    }

    /**
     * Filter the query on the content_type column
     *
     * Example usage:
     * <code>
     * $query->filterByContentType('fooValue');   // WHERE content_type = 'fooValue'
     * $query->filterByContentType('%fooValue%', Criteria::LIKE); // WHERE content_type LIKE '%fooValue%'
     * $query->filterByContentType([1, 'foo'], Criteria::IN); // WHERE content_type IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $contentType The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByContentType($contentType = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $contentType = str_replace('*', '%', $contentType);
        }

        if (is_array($contentType) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$contentType of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyUnauthenticatedCustomerAccessTableMap::COL_CONTENT_TYPE, $contentType, $comparison);

        return $query;
    }

    /**
     * Filter the query on the is_restricted column
     *
     * Example usage:
     * <code>
     * $query->filterByIsRestricted(true); // WHERE is_restricted = true
     * $query->filterByIsRestricted('yes'); // WHERE is_restricted = true
     * </code>
     *
     * @param     bool|string $isRestricted The value to use as filter.
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
    public function filterByIsRestricted($isRestricted = null, $comparison = Criteria::EQUAL)
    {
        if (is_string($isRestricted)) {
            $isRestricted = in_array(strtolower($isRestricted), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $query = $this->addUsingAlias(SpyUnauthenticatedCustomerAccessTableMap::COL_IS_RESTRICTED, $isRestricted, $comparison);

        return $query;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyUnauthenticatedCustomerAccess $spyUnauthenticatedCustomerAccess Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyUnauthenticatedCustomerAccess = null)
    {
        if ($spyUnauthenticatedCustomerAccess) {
            $this->addUsingAlias(SpyUnauthenticatedCustomerAccessTableMap::COL_ID_UNAUTHENTICATED_CUSTOMER_ACCESS, $spyUnauthenticatedCustomerAccess->getIdUnauthenticatedCustomerAccess(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_unauthenticated_customer_access table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyUnauthenticatedCustomerAccessTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyUnauthenticatedCustomerAccessTableMap::clearInstancePool();
            SpyUnauthenticatedCustomerAccessTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyUnauthenticatedCustomerAccessTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyUnauthenticatedCustomerAccessTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyUnauthenticatedCustomerAccessTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyUnauthenticatedCustomerAccessTableMap::clearRelatedInstancePool();

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
