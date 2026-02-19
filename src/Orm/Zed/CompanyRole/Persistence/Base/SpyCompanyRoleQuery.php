<?php

namespace Orm\Zed\CompanyRole\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRole as ChildSpyCompanyRole;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery as ChildSpyCompanyRoleQuery;
use Orm\Zed\CompanyRole\Persistence\Map\SpyCompanyRoleTableMap;
use Orm\Zed\Company\Persistence\SpyCompany;
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
 * Base class that represents a query for the `spy_company_role` table.
 *
 * @method     ChildSpyCompanyRoleQuery orderByIdCompanyRole($order = Criteria::ASC) Order by the id_company_role column
 * @method     ChildSpyCompanyRoleQuery orderByFkCompany($order = Criteria::ASC) Order by the fk_company column
 * @method     ChildSpyCompanyRoleQuery orderByIsDefault($order = Criteria::ASC) Order by the is_default column
 * @method     ChildSpyCompanyRoleQuery orderByKey($order = Criteria::ASC) Order by the key column
 * @method     ChildSpyCompanyRoleQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildSpyCompanyRoleQuery orderByUuid($order = Criteria::ASC) Order by the uuid column
 *
 * @method     ChildSpyCompanyRoleQuery groupByIdCompanyRole() Group by the id_company_role column
 * @method     ChildSpyCompanyRoleQuery groupByFkCompany() Group by the fk_company column
 * @method     ChildSpyCompanyRoleQuery groupByIsDefault() Group by the is_default column
 * @method     ChildSpyCompanyRoleQuery groupByKey() Group by the key column
 * @method     ChildSpyCompanyRoleQuery groupByName() Group by the name column
 * @method     ChildSpyCompanyRoleQuery groupByUuid() Group by the uuid column
 *
 * @method     ChildSpyCompanyRoleQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyCompanyRoleQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyCompanyRoleQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyCompanyRoleQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyCompanyRoleQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyCompanyRoleQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyCompanyRoleQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildSpyCompanyRoleQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildSpyCompanyRoleQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildSpyCompanyRoleQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildSpyCompanyRoleQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildSpyCompanyRoleQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildSpyCompanyRoleQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildSpyCompanyRoleQuery leftJoinSpyCompanyRoleToPermission($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCompanyRoleToPermission relation
 * @method     ChildSpyCompanyRoleQuery rightJoinSpyCompanyRoleToPermission($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCompanyRoleToPermission relation
 * @method     ChildSpyCompanyRoleQuery innerJoinSpyCompanyRoleToPermission($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCompanyRoleToPermission relation
 *
 * @method     ChildSpyCompanyRoleQuery joinWithSpyCompanyRoleToPermission($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCompanyRoleToPermission relation
 *
 * @method     ChildSpyCompanyRoleQuery leftJoinWithSpyCompanyRoleToPermission() Adds a LEFT JOIN clause and with to the query using the SpyCompanyRoleToPermission relation
 * @method     ChildSpyCompanyRoleQuery rightJoinWithSpyCompanyRoleToPermission() Adds a RIGHT JOIN clause and with to the query using the SpyCompanyRoleToPermission relation
 * @method     ChildSpyCompanyRoleQuery innerJoinWithSpyCompanyRoleToPermission() Adds a INNER JOIN clause and with to the query using the SpyCompanyRoleToPermission relation
 *
 * @method     ChildSpyCompanyRoleQuery leftJoinSpyCompanyRoleToCompanyUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCompanyRoleToCompanyUser relation
 * @method     ChildSpyCompanyRoleQuery rightJoinSpyCompanyRoleToCompanyUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCompanyRoleToCompanyUser relation
 * @method     ChildSpyCompanyRoleQuery innerJoinSpyCompanyRoleToCompanyUser($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCompanyRoleToCompanyUser relation
 *
 * @method     ChildSpyCompanyRoleQuery joinWithSpyCompanyRoleToCompanyUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCompanyRoleToCompanyUser relation
 *
 * @method     ChildSpyCompanyRoleQuery leftJoinWithSpyCompanyRoleToCompanyUser() Adds a LEFT JOIN clause and with to the query using the SpyCompanyRoleToCompanyUser relation
 * @method     ChildSpyCompanyRoleQuery rightJoinWithSpyCompanyRoleToCompanyUser() Adds a RIGHT JOIN clause and with to the query using the SpyCompanyRoleToCompanyUser relation
 * @method     ChildSpyCompanyRoleQuery innerJoinWithSpyCompanyRoleToCompanyUser() Adds a INNER JOIN clause and with to the query using the SpyCompanyRoleToCompanyUser relation
 *
 * @method     \Orm\Zed\Company\Persistence\SpyCompanyQuery|\Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermissionQuery|\Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyCompanyRole|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyCompanyRole matching the query
 * @method     ChildSpyCompanyRole findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyCompanyRole matching the query, or a new ChildSpyCompanyRole object populated from the query conditions when no match is found
 *
 * @method     ChildSpyCompanyRole|null findOneByIdCompanyRole(int $id_company_role) Return the first ChildSpyCompanyRole filtered by the id_company_role column
 * @method     ChildSpyCompanyRole|null findOneByFkCompany(int $fk_company) Return the first ChildSpyCompanyRole filtered by the fk_company column
 * @method     ChildSpyCompanyRole|null findOneByIsDefault(boolean $is_default) Return the first ChildSpyCompanyRole filtered by the is_default column
 * @method     ChildSpyCompanyRole|null findOneByKey(string $key) Return the first ChildSpyCompanyRole filtered by the key column
 * @method     ChildSpyCompanyRole|null findOneByName(string $name) Return the first ChildSpyCompanyRole filtered by the name column
 * @method     ChildSpyCompanyRole|null findOneByUuid(string $uuid) Return the first ChildSpyCompanyRole filtered by the uuid column
 *
 * @method     ChildSpyCompanyRole requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyCompanyRole by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyRole requireOne(?ConnectionInterface $con = null) Return the first ChildSpyCompanyRole matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyCompanyRole requireOneByIdCompanyRole(int $id_company_role) Return the first ChildSpyCompanyRole filtered by the id_company_role column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyRole requireOneByFkCompany(int $fk_company) Return the first ChildSpyCompanyRole filtered by the fk_company column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyRole requireOneByIsDefault(boolean $is_default) Return the first ChildSpyCompanyRole filtered by the is_default column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyRole requireOneByKey(string $key) Return the first ChildSpyCompanyRole filtered by the key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyRole requireOneByName(string $name) Return the first ChildSpyCompanyRole filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyRole requireOneByUuid(string $uuid) Return the first ChildSpyCompanyRole filtered by the uuid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyCompanyRole[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyCompanyRole objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyCompanyRole> find(?ConnectionInterface $con = null) Return ChildSpyCompanyRole objects based on current ModelCriteria
 *
 * @method     ChildSpyCompanyRole[]|Collection findByIdCompanyRole(int|array<int> $id_company_role) Return ChildSpyCompanyRole objects filtered by the id_company_role column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyRole> findByIdCompanyRole(int|array<int> $id_company_role) Return ChildSpyCompanyRole objects filtered by the id_company_role column
 * @method     ChildSpyCompanyRole[]|Collection findByFkCompany(int|array<int> $fk_company) Return ChildSpyCompanyRole objects filtered by the fk_company column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyRole> findByFkCompany(int|array<int> $fk_company) Return ChildSpyCompanyRole objects filtered by the fk_company column
 * @method     ChildSpyCompanyRole[]|Collection findByIsDefault(boolean|array<boolean> $is_default) Return ChildSpyCompanyRole objects filtered by the is_default column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyRole> findByIsDefault(boolean|array<boolean> $is_default) Return ChildSpyCompanyRole objects filtered by the is_default column
 * @method     ChildSpyCompanyRole[]|Collection findByKey(string|array<string> $key) Return ChildSpyCompanyRole objects filtered by the key column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyRole> findByKey(string|array<string> $key) Return ChildSpyCompanyRole objects filtered by the key column
 * @method     ChildSpyCompanyRole[]|Collection findByName(string|array<string> $name) Return ChildSpyCompanyRole objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyRole> findByName(string|array<string> $name) Return ChildSpyCompanyRole objects filtered by the name column
 * @method     ChildSpyCompanyRole[]|Collection findByUuid(string|array<string> $uuid) Return ChildSpyCompanyRole objects filtered by the uuid column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyRole> findByUuid(string|array<string> $uuid) Return ChildSpyCompanyRole objects filtered by the uuid column
 *
 * @method     ChildSpyCompanyRole[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyCompanyRole> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyCompanyRoleQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\CompanyRole\Persistence\Base\SpyCompanyRoleQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\CompanyRole\\Persistence\\SpyCompanyRole', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyCompanyRoleQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyCompanyRoleQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyCompanyRoleQuery) {
            return $criteria;
        }
        $query = new ChildSpyCompanyRoleQuery();
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
     * @return ChildSpyCompanyRole|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyCompanyRoleTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyCompanyRole A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id_company_role`, `fk_company`, `is_default`, `key`, `name`, `uuid` FROM `spy_company_role` WHERE `id_company_role` = :p0';
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
            /** @var ChildSpyCompanyRole $obj */
            $obj = new ChildSpyCompanyRole();
            $obj->hydrate($row);
            SpyCompanyRoleTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyCompanyRole|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyCompanyRoleTableMap::COL_ID_COMPANY_ROLE, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyCompanyRoleTableMap::COL_ID_COMPANY_ROLE, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idCompanyRole Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdCompanyRole_Between(array $idCompanyRole)
    {
        return $this->filterByIdCompanyRole($idCompanyRole, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idCompanyRoles Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdCompanyRole_In(array $idCompanyRoles)
    {
        return $this->filterByIdCompanyRole($idCompanyRoles, Criteria::IN);
    }

    /**
     * Filter the query on the id_company_role column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCompanyRole(1234); // WHERE id_company_role = 1234
     * $query->filterByIdCompanyRole(array(12, 34), Criteria::IN); // WHERE id_company_role IN (12, 34)
     * $query->filterByIdCompanyRole(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_company_role > 12
     * </code>
     *
     * @param     mixed $idCompanyRole The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdCompanyRole($idCompanyRole = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idCompanyRole)) {
            $useMinMax = false;
            if (isset($idCompanyRole['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCompanyRoleTableMap::COL_ID_COMPANY_ROLE, $idCompanyRole['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCompanyRole['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCompanyRoleTableMap::COL_ID_COMPANY_ROLE, $idCompanyRole['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idCompanyRole of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCompanyRoleTableMap::COL_ID_COMPANY_ROLE, $idCompanyRole, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkCompany Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCompany_Between(array $fkCompany)
    {
        return $this->filterByFkCompany($fkCompany, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkCompanys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCompany_In(array $fkCompanys)
    {
        return $this->filterByFkCompany($fkCompanys, Criteria::IN);
    }

    /**
     * Filter the query on the fk_company column
     *
     * Example usage:
     * <code>
     * $query->filterByFkCompany(1234); // WHERE fk_company = 1234
     * $query->filterByFkCompany(array(12, 34), Criteria::IN); // WHERE fk_company IN (12, 34)
     * $query->filterByFkCompany(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_company > 12
     * </code>
     *
     * @see       filterByCompany()
     *
     * @param     mixed $fkCompany The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkCompany($fkCompany = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkCompany)) {
            $useMinMax = false;
            if (isset($fkCompany['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCompanyRoleTableMap::COL_FK_COMPANY, $fkCompany['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkCompany['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCompanyRoleTableMap::COL_FK_COMPANY, $fkCompany['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkCompany of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCompanyRoleTableMap::COL_FK_COMPANY, $fkCompany, $comparison);

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

        $query = $this->addUsingAlias(SpyCompanyRoleTableMap::COL_IS_DEFAULT, $isDefault, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $keys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByKey_In(array $keys)
    {
        return $this->filterByKey($keys, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $key Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByKey_Like($key)
    {
        return $this->filterByKey($key, Criteria::LIKE);
    }

    /**
     * Filter the query on the key column
     *
     * Example usage:
     * <code>
     * $query->filterByKey('fooValue');   // WHERE key = 'fooValue'
     * $query->filterByKey('%fooValue%', Criteria::LIKE); // WHERE key LIKE '%fooValue%'
     * $query->filterByKey([1, 'foo'], Criteria::IN); // WHERE key IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $key The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByKey($key = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $key = str_replace('*', '%', $key);
        }

        if (is_array($key) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$key of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCompanyRoleTableMap::COL_KEY, $key, $comparison);

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

        $query = $this->addUsingAlias(SpyCompanyRoleTableMap::COL_NAME, $name, $comparison);

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

        $query = $this->addUsingAlias(SpyCompanyRoleTableMap::COL_UUID, $uuid, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Company\Persistence\SpyCompany object
     *
     * @param \Orm\Zed\Company\Persistence\SpyCompany|ObjectCollection $spyCompany The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompany($spyCompany, ?string $comparison = null)
    {
        if ($spyCompany instanceof \Orm\Zed\Company\Persistence\SpyCompany) {
            return $this
                ->addUsingAlias(SpyCompanyRoleTableMap::COL_FK_COMPANY, $spyCompany->getIdCompany(), $comparison);
        } elseif ($spyCompany instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyCompanyRoleTableMap::COL_FK_COMPANY, $spyCompany->toKeyValue('PrimaryKey', 'IdCompany'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCompany() only accepts arguments of type \Orm\Zed\Company\Persistence\SpyCompany or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Company relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCompany(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Company');

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
            $this->addJoinObject($join, 'Company');
        }

        return $this;
    }

    /**
     * Use the Company relation SpyCompany object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Company\Persistence\SpyCompanyQuery A secondary query class using the current class as primary query
     */
    public function useCompanyQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCompany($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Company', '\Orm\Zed\Company\Persistence\SpyCompanyQuery');
    }

    /**
     * Use the Company relation SpyCompany object
     *
     * @param callable(\Orm\Zed\Company\Persistence\SpyCompanyQuery):\Orm\Zed\Company\Persistence\SpyCompanyQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCompanyQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCompanyQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the Company relation to the SpyCompany table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Company\Persistence\SpyCompanyQuery The inner query object of the EXISTS statement
     */
    public function useCompanyExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Company\Persistence\SpyCompanyQuery */
        $q = $this->useExistsQuery('Company', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the Company relation to the SpyCompany table for a NOT EXISTS query.
     *
     * @see useCompanyExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Company\Persistence\SpyCompanyQuery The inner query object of the NOT EXISTS statement
     */
    public function useCompanyNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Company\Persistence\SpyCompanyQuery */
        $q = $this->useExistsQuery('Company', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the Company relation to the SpyCompany table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Company\Persistence\SpyCompanyQuery The inner query object of the IN statement
     */
    public function useInCompanyQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Company\Persistence\SpyCompanyQuery */
        $q = $this->useInQuery('Company', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the Company relation to the SpyCompany table for a NOT IN query.
     *
     * @see useCompanyInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Company\Persistence\SpyCompanyQuery The inner query object of the NOT IN statement
     */
    public function useNotInCompanyQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Company\Persistence\SpyCompanyQuery */
        $q = $this->useInQuery('Company', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermission object
     *
     * @param \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermission|ObjectCollection $spyCompanyRoleToPermission the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCompanyRoleToPermission($spyCompanyRoleToPermission, ?string $comparison = null)
    {
        if ($spyCompanyRoleToPermission instanceof \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermission) {
            $this
                ->addUsingAlias(SpyCompanyRoleTableMap::COL_ID_COMPANY_ROLE, $spyCompanyRoleToPermission->getFkCompanyRole(), $comparison);

            return $this;
        } elseif ($spyCompanyRoleToPermission instanceof ObjectCollection) {
            $this
                ->useSpyCompanyRoleToPermissionQuery()
                ->filterByPrimaryKeys($spyCompanyRoleToPermission->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyCompanyRoleToPermission() only accepts arguments of type \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermission or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCompanyRoleToPermission relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCompanyRoleToPermission(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCompanyRoleToPermission');

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
            $this->addJoinObject($join, 'SpyCompanyRoleToPermission');
        }

        return $this;
    }

    /**
     * Use the SpyCompanyRoleToPermission relation SpyCompanyRoleToPermission object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermissionQuery A secondary query class using the current class as primary query
     */
    public function useSpyCompanyRoleToPermissionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyCompanyRoleToPermission($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCompanyRoleToPermission', '\Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermissionQuery');
    }

    /**
     * Use the SpyCompanyRoleToPermission relation SpyCompanyRoleToPermission object
     *
     * @param callable(\Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermissionQuery):\Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermissionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCompanyRoleToPermissionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyCompanyRoleToPermissionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyCompanyRoleToPermission table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermissionQuery The inner query object of the EXISTS statement
     */
    public function useSpyCompanyRoleToPermissionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermissionQuery */
        $q = $this->useExistsQuery('SpyCompanyRoleToPermission', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyCompanyRoleToPermission table for a NOT EXISTS query.
     *
     * @see useSpyCompanyRoleToPermissionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermissionQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCompanyRoleToPermissionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermissionQuery */
        $q = $this->useExistsQuery('SpyCompanyRoleToPermission', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyCompanyRoleToPermission table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermissionQuery The inner query object of the IN statement
     */
    public function useInSpyCompanyRoleToPermissionQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermissionQuery */
        $q = $this->useInQuery('SpyCompanyRoleToPermission', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyCompanyRoleToPermission table for a NOT IN query.
     *
     * @see useSpyCompanyRoleToPermissionInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermissionQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyCompanyRoleToPermissionQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermissionQuery */
        $q = $this->useInQuery('SpyCompanyRoleToPermission', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUser object
     *
     * @param \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUser|ObjectCollection $spyCompanyRoleToCompanyUser the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCompanyRoleToCompanyUser($spyCompanyRoleToCompanyUser, ?string $comparison = null)
    {
        if ($spyCompanyRoleToCompanyUser instanceof \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUser) {
            $this
                ->addUsingAlias(SpyCompanyRoleTableMap::COL_ID_COMPANY_ROLE, $spyCompanyRoleToCompanyUser->getFkCompanyRole(), $comparison);

            return $this;
        } elseif ($spyCompanyRoleToCompanyUser instanceof ObjectCollection) {
            $this
                ->useSpyCompanyRoleToCompanyUserQuery()
                ->filterByPrimaryKeys($spyCompanyRoleToCompanyUser->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyCompanyRoleToCompanyUser() only accepts arguments of type \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCompanyRoleToCompanyUser relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCompanyRoleToCompanyUser(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCompanyRoleToCompanyUser');

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
            $this->addJoinObject($join, 'SpyCompanyRoleToCompanyUser');
        }

        return $this;
    }

    /**
     * Use the SpyCompanyRoleToCompanyUser relation SpyCompanyRoleToCompanyUser object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUserQuery A secondary query class using the current class as primary query
     */
    public function useSpyCompanyRoleToCompanyUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyCompanyRoleToCompanyUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCompanyRoleToCompanyUser', '\Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUserQuery');
    }

    /**
     * Use the SpyCompanyRoleToCompanyUser relation SpyCompanyRoleToCompanyUser object
     *
     * @param callable(\Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUserQuery):\Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUserQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCompanyRoleToCompanyUserQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyCompanyRoleToCompanyUserQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyCompanyRoleToCompanyUser table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUserQuery The inner query object of the EXISTS statement
     */
    public function useSpyCompanyRoleToCompanyUserExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUserQuery */
        $q = $this->useExistsQuery('SpyCompanyRoleToCompanyUser', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyCompanyRoleToCompanyUser table for a NOT EXISTS query.
     *
     * @see useSpyCompanyRoleToCompanyUserExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUserQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCompanyRoleToCompanyUserNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUserQuery */
        $q = $this->useExistsQuery('SpyCompanyRoleToCompanyUser', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyCompanyRoleToCompanyUser table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUserQuery The inner query object of the IN statement
     */
    public function useInSpyCompanyRoleToCompanyUserQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUserQuery */
        $q = $this->useInQuery('SpyCompanyRoleToCompanyUser', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyCompanyRoleToCompanyUser table for a NOT IN query.
     *
     * @see useSpyCompanyRoleToCompanyUserInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUserQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyCompanyRoleToCompanyUserQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUserQuery */
        $q = $this->useInQuery('SpyCompanyRoleToCompanyUser', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related SpyPermission object
     * using the spy_company_role_to_permission table as cross reference
     *
     * @param SpyPermission $spyPermission the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL and Criteria::IN for queries
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPermission($spyPermission, string $comparison = null)
    {
        $this
            ->useSpyCompanyRoleToPermissionQuery()
            ->filterByPermission($spyPermission, $comparison)
            ->endUse();

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyCompanyRole $spyCompanyRole Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyCompanyRole = null)
    {
        if ($spyCompanyRole) {
            $this->addUsingAlias(SpyCompanyRoleTableMap::COL_ID_COMPANY_ROLE, $spyCompanyRole->getIdCompanyRole(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_company_role table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCompanyRoleTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyCompanyRoleTableMap::clearInstancePool();
            SpyCompanyRoleTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCompanyRoleTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyCompanyRoleTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyCompanyRoleTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyCompanyRoleTableMap::clearRelatedInstancePool();

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
