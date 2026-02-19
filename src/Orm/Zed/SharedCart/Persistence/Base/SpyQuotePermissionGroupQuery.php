<?php

namespace Orm\Zed\SharedCart\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroup as ChildSpyQuotePermissionGroup;
use Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupQuery as ChildSpyQuotePermissionGroupQuery;
use Orm\Zed\SharedCart\Persistence\Map\SpyQuotePermissionGroupTableMap;
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
 * Base class that represents a query for the `spy_quote_permission_group` table.
 *
 * @method     ChildSpyQuotePermissionGroupQuery orderByIdQuotePermissionGroup($order = Criteria::ASC) Order by the id_quote_permission_group column
 * @method     ChildSpyQuotePermissionGroupQuery orderByIsDefault($order = Criteria::ASC) Order by the is_default column
 * @method     ChildSpyQuotePermissionGroupQuery orderByName($order = Criteria::ASC) Order by the name column
 *
 * @method     ChildSpyQuotePermissionGroupQuery groupByIdQuotePermissionGroup() Group by the id_quote_permission_group column
 * @method     ChildSpyQuotePermissionGroupQuery groupByIsDefault() Group by the is_default column
 * @method     ChildSpyQuotePermissionGroupQuery groupByName() Group by the name column
 *
 * @method     ChildSpyQuotePermissionGroupQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyQuotePermissionGroupQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyQuotePermissionGroupQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyQuotePermissionGroupQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyQuotePermissionGroupQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyQuotePermissionGroupQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyQuotePermissionGroupQuery leftJoinSpyQuoteCompanyUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyQuoteCompanyUser relation
 * @method     ChildSpyQuotePermissionGroupQuery rightJoinSpyQuoteCompanyUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyQuoteCompanyUser relation
 * @method     ChildSpyQuotePermissionGroupQuery innerJoinSpyQuoteCompanyUser($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyQuoteCompanyUser relation
 *
 * @method     ChildSpyQuotePermissionGroupQuery joinWithSpyQuoteCompanyUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyQuoteCompanyUser relation
 *
 * @method     ChildSpyQuotePermissionGroupQuery leftJoinWithSpyQuoteCompanyUser() Adds a LEFT JOIN clause and with to the query using the SpyQuoteCompanyUser relation
 * @method     ChildSpyQuotePermissionGroupQuery rightJoinWithSpyQuoteCompanyUser() Adds a RIGHT JOIN clause and with to the query using the SpyQuoteCompanyUser relation
 * @method     ChildSpyQuotePermissionGroupQuery innerJoinWithSpyQuoteCompanyUser() Adds a INNER JOIN clause and with to the query using the SpyQuoteCompanyUser relation
 *
 * @method     ChildSpyQuotePermissionGroupQuery leftJoinSpyQuotePermissionGroupToPermission($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyQuotePermissionGroupToPermission relation
 * @method     ChildSpyQuotePermissionGroupQuery rightJoinSpyQuotePermissionGroupToPermission($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyQuotePermissionGroupToPermission relation
 * @method     ChildSpyQuotePermissionGroupQuery innerJoinSpyQuotePermissionGroupToPermission($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyQuotePermissionGroupToPermission relation
 *
 * @method     ChildSpyQuotePermissionGroupQuery joinWithSpyQuotePermissionGroupToPermission($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyQuotePermissionGroupToPermission relation
 *
 * @method     ChildSpyQuotePermissionGroupQuery leftJoinWithSpyQuotePermissionGroupToPermission() Adds a LEFT JOIN clause and with to the query using the SpyQuotePermissionGroupToPermission relation
 * @method     ChildSpyQuotePermissionGroupQuery rightJoinWithSpyQuotePermissionGroupToPermission() Adds a RIGHT JOIN clause and with to the query using the SpyQuotePermissionGroupToPermission relation
 * @method     ChildSpyQuotePermissionGroupQuery innerJoinWithSpyQuotePermissionGroupToPermission() Adds a INNER JOIN clause and with to the query using the SpyQuotePermissionGroupToPermission relation
 *
 * @method     \Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUserQuery|\Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupToPermissionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyQuotePermissionGroup|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyQuotePermissionGroup matching the query
 * @method     ChildSpyQuotePermissionGroup findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyQuotePermissionGroup matching the query, or a new ChildSpyQuotePermissionGroup object populated from the query conditions when no match is found
 *
 * @method     ChildSpyQuotePermissionGroup|null findOneByIdQuotePermissionGroup(int $id_quote_permission_group) Return the first ChildSpyQuotePermissionGroup filtered by the id_quote_permission_group column
 * @method     ChildSpyQuotePermissionGroup|null findOneByIsDefault(boolean $is_default) Return the first ChildSpyQuotePermissionGroup filtered by the is_default column
 * @method     ChildSpyQuotePermissionGroup|null findOneByName(string $name) Return the first ChildSpyQuotePermissionGroup filtered by the name column
 *
 * @method     ChildSpyQuotePermissionGroup requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyQuotePermissionGroup by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyQuotePermissionGroup requireOne(?ConnectionInterface $con = null) Return the first ChildSpyQuotePermissionGroup matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyQuotePermissionGroup requireOneByIdQuotePermissionGroup(int $id_quote_permission_group) Return the first ChildSpyQuotePermissionGroup filtered by the id_quote_permission_group column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyQuotePermissionGroup requireOneByIsDefault(boolean $is_default) Return the first ChildSpyQuotePermissionGroup filtered by the is_default column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyQuotePermissionGroup requireOneByName(string $name) Return the first ChildSpyQuotePermissionGroup filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyQuotePermissionGroup[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyQuotePermissionGroup objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyQuotePermissionGroup> find(?ConnectionInterface $con = null) Return ChildSpyQuotePermissionGroup objects based on current ModelCriteria
 *
 * @method     ChildSpyQuotePermissionGroup[]|Collection findByIdQuotePermissionGroup(int|array<int> $id_quote_permission_group) Return ChildSpyQuotePermissionGroup objects filtered by the id_quote_permission_group column
 * @psalm-method Collection&\Traversable<ChildSpyQuotePermissionGroup> findByIdQuotePermissionGroup(int|array<int> $id_quote_permission_group) Return ChildSpyQuotePermissionGroup objects filtered by the id_quote_permission_group column
 * @method     ChildSpyQuotePermissionGroup[]|Collection findByIsDefault(boolean|array<boolean> $is_default) Return ChildSpyQuotePermissionGroup objects filtered by the is_default column
 * @psalm-method Collection&\Traversable<ChildSpyQuotePermissionGroup> findByIsDefault(boolean|array<boolean> $is_default) Return ChildSpyQuotePermissionGroup objects filtered by the is_default column
 * @method     ChildSpyQuotePermissionGroup[]|Collection findByName(string|array<string> $name) Return ChildSpyQuotePermissionGroup objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildSpyQuotePermissionGroup> findByName(string|array<string> $name) Return ChildSpyQuotePermissionGroup objects filtered by the name column
 *
 * @method     ChildSpyQuotePermissionGroup[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyQuotePermissionGroup> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyQuotePermissionGroupQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\SharedCart\Persistence\Base\SpyQuotePermissionGroupQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\SharedCart\\Persistence\\SpyQuotePermissionGroup', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyQuotePermissionGroupQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyQuotePermissionGroupQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyQuotePermissionGroupQuery) {
            return $criteria;
        }
        $query = new ChildSpyQuotePermissionGroupQuery();
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
     * @return ChildSpyQuotePermissionGroup|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyQuotePermissionGroupTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyQuotePermissionGroup A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_quote_permission_group, is_default, name FROM spy_quote_permission_group WHERE id_quote_permission_group = :p0';
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
            /** @var ChildSpyQuotePermissionGroup $obj */
            $obj = new ChildSpyQuotePermissionGroup();
            $obj->hydrate($row);
            SpyQuotePermissionGroupTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyQuotePermissionGroup|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyQuotePermissionGroupTableMap::COL_ID_QUOTE_PERMISSION_GROUP, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyQuotePermissionGroupTableMap::COL_ID_QUOTE_PERMISSION_GROUP, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idQuotePermissionGroup Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdQuotePermissionGroup_Between(array $idQuotePermissionGroup)
    {
        return $this->filterByIdQuotePermissionGroup($idQuotePermissionGroup, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idQuotePermissionGroups Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdQuotePermissionGroup_In(array $idQuotePermissionGroups)
    {
        return $this->filterByIdQuotePermissionGroup($idQuotePermissionGroups, Criteria::IN);
    }

    /**
     * Filter the query on the id_quote_permission_group column
     *
     * Example usage:
     * <code>
     * $query->filterByIdQuotePermissionGroup(1234); // WHERE id_quote_permission_group = 1234
     * $query->filterByIdQuotePermissionGroup(array(12, 34), Criteria::IN); // WHERE id_quote_permission_group IN (12, 34)
     * $query->filterByIdQuotePermissionGroup(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_quote_permission_group > 12
     * </code>
     *
     * @param     mixed $idQuotePermissionGroup The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdQuotePermissionGroup($idQuotePermissionGroup = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idQuotePermissionGroup)) {
            $useMinMax = false;
            if (isset($idQuotePermissionGroup['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyQuotePermissionGroupTableMap::COL_ID_QUOTE_PERMISSION_GROUP, $idQuotePermissionGroup['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idQuotePermissionGroup['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyQuotePermissionGroupTableMap::COL_ID_QUOTE_PERMISSION_GROUP, $idQuotePermissionGroup['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idQuotePermissionGroup of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyQuotePermissionGroupTableMap::COL_ID_QUOTE_PERMISSION_GROUP, $idQuotePermissionGroup, $comparison);

        return $query;
    }

    /**
     * Filter the query on the is_default column
     *
     * Example usage:
     * <code>
     * $query->filterByIsDefault(true); // WHERE is_default = true
     * $query->filterByIsDefault('yes'); // WHERE is_default = true
     * </code>
     *
     * @param     bool|string $isDefault The value to use as filter.
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
    public function filterByIsDefault($isDefault = null, $comparison = Criteria::EQUAL)
    {
        if (is_string($isDefault)) {
            $isDefault = in_array(strtolower($isDefault), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $query = $this->addUsingAlias(SpyQuotePermissionGroupTableMap::COL_IS_DEFAULT, $isDefault, $comparison);

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

        $query = $this->addUsingAlias(SpyQuotePermissionGroupTableMap::COL_NAME, $name, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUser object
     *
     * @param \Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUser|ObjectCollection $spyQuoteCompanyUser the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyQuoteCompanyUser($spyQuoteCompanyUser, ?string $comparison = null)
    {
        if ($spyQuoteCompanyUser instanceof \Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUser) {
            $this
                ->addUsingAlias(SpyQuotePermissionGroupTableMap::COL_ID_QUOTE_PERMISSION_GROUP, $spyQuoteCompanyUser->getFkQuotePermissionGroup(), $comparison);

            return $this;
        } elseif ($spyQuoteCompanyUser instanceof ObjectCollection) {
            $this
                ->useSpyQuoteCompanyUserQuery()
                ->filterByPrimaryKeys($spyQuoteCompanyUser->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyQuoteCompanyUser() only accepts arguments of type \Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyQuoteCompanyUser relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyQuoteCompanyUser(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyQuoteCompanyUser');

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
            $this->addJoinObject($join, 'SpyQuoteCompanyUser');
        }

        return $this;
    }

    /**
     * Use the SpyQuoteCompanyUser relation SpyQuoteCompanyUser object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUserQuery A secondary query class using the current class as primary query
     */
    public function useSpyQuoteCompanyUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyQuoteCompanyUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyQuoteCompanyUser', '\Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUserQuery');
    }

    /**
     * Use the SpyQuoteCompanyUser relation SpyQuoteCompanyUser object
     *
     * @param callable(\Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUserQuery):\Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUserQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyQuoteCompanyUserQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyQuoteCompanyUserQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyQuoteCompanyUser table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUserQuery The inner query object of the EXISTS statement
     */
    public function useSpyQuoteCompanyUserExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUserQuery */
        $q = $this->useExistsQuery('SpyQuoteCompanyUser', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyQuoteCompanyUser table for a NOT EXISTS query.
     *
     * @see useSpyQuoteCompanyUserExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUserQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyQuoteCompanyUserNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUserQuery */
        $q = $this->useExistsQuery('SpyQuoteCompanyUser', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyQuoteCompanyUser table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUserQuery The inner query object of the IN statement
     */
    public function useInSpyQuoteCompanyUserQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUserQuery */
        $q = $this->useInQuery('SpyQuoteCompanyUser', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyQuoteCompanyUser table for a NOT IN query.
     *
     * @see useSpyQuoteCompanyUserInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUserQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyQuoteCompanyUserQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUserQuery */
        $q = $this->useInQuery('SpyQuoteCompanyUser', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupToPermission object
     *
     * @param \Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupToPermission|ObjectCollection $spyQuotePermissionGroupToPermission the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyQuotePermissionGroupToPermission($spyQuotePermissionGroupToPermission, ?string $comparison = null)
    {
        if ($spyQuotePermissionGroupToPermission instanceof \Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupToPermission) {
            $this
                ->addUsingAlias(SpyQuotePermissionGroupTableMap::COL_ID_QUOTE_PERMISSION_GROUP, $spyQuotePermissionGroupToPermission->getFkQuotePermissionGroup(), $comparison);

            return $this;
        } elseif ($spyQuotePermissionGroupToPermission instanceof ObjectCollection) {
            $this
                ->useSpyQuotePermissionGroupToPermissionQuery()
                ->filterByPrimaryKeys($spyQuotePermissionGroupToPermission->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyQuotePermissionGroupToPermission() only accepts arguments of type \Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupToPermission or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyQuotePermissionGroupToPermission relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyQuotePermissionGroupToPermission(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyQuotePermissionGroupToPermission');

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
            $this->addJoinObject($join, 'SpyQuotePermissionGroupToPermission');
        }

        return $this;
    }

    /**
     * Use the SpyQuotePermissionGroupToPermission relation SpyQuotePermissionGroupToPermission object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupToPermissionQuery A secondary query class using the current class as primary query
     */
    public function useSpyQuotePermissionGroupToPermissionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyQuotePermissionGroupToPermission($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyQuotePermissionGroupToPermission', '\Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupToPermissionQuery');
    }

    /**
     * Use the SpyQuotePermissionGroupToPermission relation SpyQuotePermissionGroupToPermission object
     *
     * @param callable(\Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupToPermissionQuery):\Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupToPermissionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyQuotePermissionGroupToPermissionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyQuotePermissionGroupToPermissionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyQuotePermissionGroupToPermission table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupToPermissionQuery The inner query object of the EXISTS statement
     */
    public function useSpyQuotePermissionGroupToPermissionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupToPermissionQuery */
        $q = $this->useExistsQuery('SpyQuotePermissionGroupToPermission', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyQuotePermissionGroupToPermission table for a NOT EXISTS query.
     *
     * @see useSpyQuotePermissionGroupToPermissionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupToPermissionQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyQuotePermissionGroupToPermissionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupToPermissionQuery */
        $q = $this->useExistsQuery('SpyQuotePermissionGroupToPermission', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyQuotePermissionGroupToPermission table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupToPermissionQuery The inner query object of the IN statement
     */
    public function useInSpyQuotePermissionGroupToPermissionQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupToPermissionQuery */
        $q = $this->useInQuery('SpyQuotePermissionGroupToPermission', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyQuotePermissionGroupToPermission table for a NOT IN query.
     *
     * @see useSpyQuotePermissionGroupToPermissionInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupToPermissionQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyQuotePermissionGroupToPermissionQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupToPermissionQuery */
        $q = $this->useInQuery('SpyQuotePermissionGroupToPermission', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyQuotePermissionGroup $spyQuotePermissionGroup Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyQuotePermissionGroup = null)
    {
        if ($spyQuotePermissionGroup) {
            $this->addUsingAlias(SpyQuotePermissionGroupTableMap::COL_ID_QUOTE_PERMISSION_GROUP, $spyQuotePermissionGroup->getIdQuotePermissionGroup(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_quote_permission_group table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyQuotePermissionGroupTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyQuotePermissionGroupTableMap::clearInstancePool();
            SpyQuotePermissionGroupTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyQuotePermissionGroupTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyQuotePermissionGroupTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyQuotePermissionGroupTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyQuotePermissionGroupTableMap::clearRelatedInstancePool();

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
