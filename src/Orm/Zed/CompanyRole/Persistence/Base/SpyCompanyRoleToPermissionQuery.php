<?php

namespace Orm\Zed\CompanyRole\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermission as ChildSpyCompanyRoleToPermission;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermissionQuery as ChildSpyCompanyRoleToPermissionQuery;
use Orm\Zed\CompanyRole\Persistence\Map\SpyCompanyRoleToPermissionTableMap;
use Orm\Zed\Permission\Persistence\SpyPermission;
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
 * Base class that represents a query for the `spy_company_role_to_permission` table.
 *
 * @method     ChildSpyCompanyRoleToPermissionQuery orderByIdCompanyRoleToPermission($order = Criteria::ASC) Order by the id_company_role_to_permission column
 * @method     ChildSpyCompanyRoleToPermissionQuery orderByFkCompanyRole($order = Criteria::ASC) Order by the fk_company_role column
 * @method     ChildSpyCompanyRoleToPermissionQuery orderByFkPermission($order = Criteria::ASC) Order by the fk_permission column
 * @method     ChildSpyCompanyRoleToPermissionQuery orderByConfiguration($order = Criteria::ASC) Order by the configuration column
 *
 * @method     ChildSpyCompanyRoleToPermissionQuery groupByIdCompanyRoleToPermission() Group by the id_company_role_to_permission column
 * @method     ChildSpyCompanyRoleToPermissionQuery groupByFkCompanyRole() Group by the fk_company_role column
 * @method     ChildSpyCompanyRoleToPermissionQuery groupByFkPermission() Group by the fk_permission column
 * @method     ChildSpyCompanyRoleToPermissionQuery groupByConfiguration() Group by the configuration column
 *
 * @method     ChildSpyCompanyRoleToPermissionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyCompanyRoleToPermissionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyCompanyRoleToPermissionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyCompanyRoleToPermissionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyCompanyRoleToPermissionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyCompanyRoleToPermissionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyCompanyRoleToPermissionQuery leftJoinPermission($relationAlias = null) Adds a LEFT JOIN clause to the query using the Permission relation
 * @method     ChildSpyCompanyRoleToPermissionQuery rightJoinPermission($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Permission relation
 * @method     ChildSpyCompanyRoleToPermissionQuery innerJoinPermission($relationAlias = null) Adds a INNER JOIN clause to the query using the Permission relation
 *
 * @method     ChildSpyCompanyRoleToPermissionQuery joinWithPermission($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Permission relation
 *
 * @method     ChildSpyCompanyRoleToPermissionQuery leftJoinWithPermission() Adds a LEFT JOIN clause and with to the query using the Permission relation
 * @method     ChildSpyCompanyRoleToPermissionQuery rightJoinWithPermission() Adds a RIGHT JOIN clause and with to the query using the Permission relation
 * @method     ChildSpyCompanyRoleToPermissionQuery innerJoinWithPermission() Adds a INNER JOIN clause and with to the query using the Permission relation
 *
 * @method     ChildSpyCompanyRoleToPermissionQuery leftJoinCompanyRole($relationAlias = null) Adds a LEFT JOIN clause to the query using the CompanyRole relation
 * @method     ChildSpyCompanyRoleToPermissionQuery rightJoinCompanyRole($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CompanyRole relation
 * @method     ChildSpyCompanyRoleToPermissionQuery innerJoinCompanyRole($relationAlias = null) Adds a INNER JOIN clause to the query using the CompanyRole relation
 *
 * @method     ChildSpyCompanyRoleToPermissionQuery joinWithCompanyRole($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CompanyRole relation
 *
 * @method     ChildSpyCompanyRoleToPermissionQuery leftJoinWithCompanyRole() Adds a LEFT JOIN clause and with to the query using the CompanyRole relation
 * @method     ChildSpyCompanyRoleToPermissionQuery rightJoinWithCompanyRole() Adds a RIGHT JOIN clause and with to the query using the CompanyRole relation
 * @method     ChildSpyCompanyRoleToPermissionQuery innerJoinWithCompanyRole() Adds a INNER JOIN clause and with to the query using the CompanyRole relation
 *
 * @method     \Orm\Zed\Permission\Persistence\SpyPermissionQuery|\Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyCompanyRoleToPermission|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyCompanyRoleToPermission matching the query
 * @method     ChildSpyCompanyRoleToPermission findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyCompanyRoleToPermission matching the query, or a new ChildSpyCompanyRoleToPermission object populated from the query conditions when no match is found
 *
 * @method     ChildSpyCompanyRoleToPermission|null findOneByIdCompanyRoleToPermission(int $id_company_role_to_permission) Return the first ChildSpyCompanyRoleToPermission filtered by the id_company_role_to_permission column
 * @method     ChildSpyCompanyRoleToPermission|null findOneByFkCompanyRole(int $fk_company_role) Return the first ChildSpyCompanyRoleToPermission filtered by the fk_company_role column
 * @method     ChildSpyCompanyRoleToPermission|null findOneByFkPermission(int $fk_permission) Return the first ChildSpyCompanyRoleToPermission filtered by the fk_permission column
 * @method     ChildSpyCompanyRoleToPermission|null findOneByConfiguration(string $configuration) Return the first ChildSpyCompanyRoleToPermission filtered by the configuration column
 *
 * @method     ChildSpyCompanyRoleToPermission requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyCompanyRoleToPermission by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyRoleToPermission requireOne(?ConnectionInterface $con = null) Return the first ChildSpyCompanyRoleToPermission matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyCompanyRoleToPermission requireOneByIdCompanyRoleToPermission(int $id_company_role_to_permission) Return the first ChildSpyCompanyRoleToPermission filtered by the id_company_role_to_permission column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyRoleToPermission requireOneByFkCompanyRole(int $fk_company_role) Return the first ChildSpyCompanyRoleToPermission filtered by the fk_company_role column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyRoleToPermission requireOneByFkPermission(int $fk_permission) Return the first ChildSpyCompanyRoleToPermission filtered by the fk_permission column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyRoleToPermission requireOneByConfiguration(string $configuration) Return the first ChildSpyCompanyRoleToPermission filtered by the configuration column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyCompanyRoleToPermission[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyCompanyRoleToPermission objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyCompanyRoleToPermission> find(?ConnectionInterface $con = null) Return ChildSpyCompanyRoleToPermission objects based on current ModelCriteria
 *
 * @method     ChildSpyCompanyRoleToPermission[]|Collection findByIdCompanyRoleToPermission(int|array<int> $id_company_role_to_permission) Return ChildSpyCompanyRoleToPermission objects filtered by the id_company_role_to_permission column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyRoleToPermission> findByIdCompanyRoleToPermission(int|array<int> $id_company_role_to_permission) Return ChildSpyCompanyRoleToPermission objects filtered by the id_company_role_to_permission column
 * @method     ChildSpyCompanyRoleToPermission[]|Collection findByFkCompanyRole(int|array<int> $fk_company_role) Return ChildSpyCompanyRoleToPermission objects filtered by the fk_company_role column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyRoleToPermission> findByFkCompanyRole(int|array<int> $fk_company_role) Return ChildSpyCompanyRoleToPermission objects filtered by the fk_company_role column
 * @method     ChildSpyCompanyRoleToPermission[]|Collection findByFkPermission(int|array<int> $fk_permission) Return ChildSpyCompanyRoleToPermission objects filtered by the fk_permission column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyRoleToPermission> findByFkPermission(int|array<int> $fk_permission) Return ChildSpyCompanyRoleToPermission objects filtered by the fk_permission column
 * @method     ChildSpyCompanyRoleToPermission[]|Collection findByConfiguration(string|array<string> $configuration) Return ChildSpyCompanyRoleToPermission objects filtered by the configuration column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyRoleToPermission> findByConfiguration(string|array<string> $configuration) Return ChildSpyCompanyRoleToPermission objects filtered by the configuration column
 *
 * @method     ChildSpyCompanyRoleToPermission[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyCompanyRoleToPermission> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyCompanyRoleToPermissionQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\CompanyRole\Persistence\Base\SpyCompanyRoleToPermissionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\CompanyRole\\Persistence\\SpyCompanyRoleToPermission', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyCompanyRoleToPermissionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyCompanyRoleToPermissionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyCompanyRoleToPermissionQuery) {
            return $criteria;
        }
        $query = new ChildSpyCompanyRoleToPermissionQuery();
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
     * $obj = $c->findPk(array(12, 34, 56), $con);
     * </code>
     *
     * @param array[$id_company_role_to_permission, $fk_company_role, $fk_permission] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildSpyCompanyRoleToPermission|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyCompanyRoleToPermissionTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1]), (null === $key[2] || is_scalar($key[2]) || is_callable([$key[2], '__toString']) ? (string) $key[2] : $key[2])]))))) {
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
     * @return ChildSpyCompanyRoleToPermission A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_company_role_to_permission, fk_company_role, fk_permission, configuration FROM spy_company_role_to_permission WHERE id_company_role_to_permission = :p0 AND fk_company_role = :p1 AND fk_permission = :p2';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->bindValue(':p2', $key[2], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildSpyCompanyRoleToPermission $obj */
            $obj = new ChildSpyCompanyRoleToPermission();
            $obj->hydrate($row);
            SpyCompanyRoleToPermissionTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1]), (null === $key[2] || is_scalar($key[2]) || is_callable([$key[2], '__toString']) ? (string) $key[2] : $key[2])]));
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
     * @return ChildSpyCompanyRoleToPermission|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
        $this->addUsingAlias(SpyCompanyRoleToPermissionTableMap::COL_ID_COMPANY_ROLE_TO_PERMISSION, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(SpyCompanyRoleToPermissionTableMap::COL_FK_COMPANY_ROLE, $key[1], Criteria::EQUAL);
        $this->addUsingAlias(SpyCompanyRoleToPermissionTableMap::COL_FK_PERMISSION, $key[2], Criteria::EQUAL);

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
        if (empty($keys)) {
            $this->add(null, '1<>1', Criteria::CUSTOM);

            return $this;
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(SpyCompanyRoleToPermissionTableMap::COL_ID_COMPANY_ROLE_TO_PERMISSION, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(SpyCompanyRoleToPermissionTableMap::COL_FK_COMPANY_ROLE, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $cton2 = $this->getNewCriterion(SpyCompanyRoleToPermissionTableMap::COL_FK_PERMISSION, $key[2], Criteria::EQUAL);
            $cton0->addAnd($cton2);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idCompanyRoleToPermission Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdCompanyRoleToPermission_Between(array $idCompanyRoleToPermission)
    {
        return $this->filterByIdCompanyRoleToPermission($idCompanyRoleToPermission, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idCompanyRoleToPermissions Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdCompanyRoleToPermission_In(array $idCompanyRoleToPermissions)
    {
        return $this->filterByIdCompanyRoleToPermission($idCompanyRoleToPermissions, Criteria::IN);
    }

    /**
     * Filter the query on the id_company_role_to_permission column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCompanyRoleToPermission(1234); // WHERE id_company_role_to_permission = 1234
     * $query->filterByIdCompanyRoleToPermission(array(12, 34), Criteria::IN); // WHERE id_company_role_to_permission IN (12, 34)
     * $query->filterByIdCompanyRoleToPermission(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_company_role_to_permission > 12
     * </code>
     *
     * @param     mixed $idCompanyRoleToPermission The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdCompanyRoleToPermission($idCompanyRoleToPermission = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idCompanyRoleToPermission)) {
            $useMinMax = false;
            if (isset($idCompanyRoleToPermission['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCompanyRoleToPermissionTableMap::COL_ID_COMPANY_ROLE_TO_PERMISSION, $idCompanyRoleToPermission['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCompanyRoleToPermission['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCompanyRoleToPermissionTableMap::COL_ID_COMPANY_ROLE_TO_PERMISSION, $idCompanyRoleToPermission['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idCompanyRoleToPermission of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCompanyRoleToPermissionTableMap::COL_ID_COMPANY_ROLE_TO_PERMISSION, $idCompanyRoleToPermission, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkCompanyRole Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCompanyRole_Between(array $fkCompanyRole)
    {
        return $this->filterByFkCompanyRole($fkCompanyRole, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkCompanyRoles Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCompanyRole_In(array $fkCompanyRoles)
    {
        return $this->filterByFkCompanyRole($fkCompanyRoles, Criteria::IN);
    }

    /**
     * Filter the query on the fk_company_role column
     *
     * Example usage:
     * <code>
     * $query->filterByFkCompanyRole(1234); // WHERE fk_company_role = 1234
     * $query->filterByFkCompanyRole(array(12, 34), Criteria::IN); // WHERE fk_company_role IN (12, 34)
     * $query->filterByFkCompanyRole(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_company_role > 12
     * </code>
     *
     * @see       filterByCompanyRole()
     *
     * @param     mixed $fkCompanyRole The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkCompanyRole($fkCompanyRole = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkCompanyRole)) {
            $useMinMax = false;
            if (isset($fkCompanyRole['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCompanyRoleToPermissionTableMap::COL_FK_COMPANY_ROLE, $fkCompanyRole['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkCompanyRole['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCompanyRoleToPermissionTableMap::COL_FK_COMPANY_ROLE, $fkCompanyRole['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkCompanyRole of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCompanyRoleToPermissionTableMap::COL_FK_COMPANY_ROLE, $fkCompanyRole, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkPermission Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkPermission_Between(array $fkPermission)
    {
        return $this->filterByFkPermission($fkPermission, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkPermissions Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkPermission_In(array $fkPermissions)
    {
        return $this->filterByFkPermission($fkPermissions, Criteria::IN);
    }

    /**
     * Filter the query on the fk_permission column
     *
     * Example usage:
     * <code>
     * $query->filterByFkPermission(1234); // WHERE fk_permission = 1234
     * $query->filterByFkPermission(array(12, 34), Criteria::IN); // WHERE fk_permission IN (12, 34)
     * $query->filterByFkPermission(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_permission > 12
     * </code>
     *
     * @see       filterByPermission()
     *
     * @param     mixed $fkPermission The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkPermission($fkPermission = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkPermission)) {
            $useMinMax = false;
            if (isset($fkPermission['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCompanyRoleToPermissionTableMap::COL_FK_PERMISSION, $fkPermission['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkPermission['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCompanyRoleToPermissionTableMap::COL_FK_PERMISSION, $fkPermission['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkPermission of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCompanyRoleToPermissionTableMap::COL_FK_PERMISSION, $fkPermission, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $configurations Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByConfiguration_In(array $configurations)
    {
        return $this->filterByConfiguration($configurations, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $configuration Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByConfiguration_Like($configuration)
    {
        return $this->filterByConfiguration($configuration, Criteria::LIKE);
    }

    /**
     * Filter the query on the configuration column
     *
     * Example usage:
     * <code>
     * $query->filterByConfiguration('fooValue');   // WHERE configuration = 'fooValue'
     * $query->filterByConfiguration('%fooValue%', Criteria::LIKE); // WHERE configuration LIKE '%fooValue%'
     * $query->filterByConfiguration([1, 'foo'], Criteria::IN); // WHERE configuration IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $configuration The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByConfiguration($configuration = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $configuration = str_replace('*', '%', $configuration);
        }

        if (is_array($configuration) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$configuration of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCompanyRoleToPermissionTableMap::COL_CONFIGURATION, $configuration, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Permission\Persistence\SpyPermission object
     *
     * @param \Orm\Zed\Permission\Persistence\SpyPermission|ObjectCollection $spyPermission The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPermission($spyPermission, ?string $comparison = null)
    {
        if ($spyPermission instanceof \Orm\Zed\Permission\Persistence\SpyPermission) {
            return $this
                ->addUsingAlias(SpyCompanyRoleToPermissionTableMap::COL_FK_PERMISSION, $spyPermission->getIdPermission(), $comparison);
        } elseif ($spyPermission instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyCompanyRoleToPermissionTableMap::COL_FK_PERMISSION, $spyPermission->toKeyValue('PrimaryKey', 'IdPermission'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByPermission() only accepts arguments of type \Orm\Zed\Permission\Persistence\SpyPermission or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Permission relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPermission(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Permission');

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
            $this->addJoinObject($join, 'Permission');
        }

        return $this;
    }

    /**
     * Use the Permission relation SpyPermission object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Permission\Persistence\SpyPermissionQuery A secondary query class using the current class as primary query
     */
    public function usePermissionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPermission($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Permission', '\Orm\Zed\Permission\Persistence\SpyPermissionQuery');
    }

    /**
     * Use the Permission relation SpyPermission object
     *
     * @param callable(\Orm\Zed\Permission\Persistence\SpyPermissionQuery):\Orm\Zed\Permission\Persistence\SpyPermissionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPermissionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->usePermissionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the Permission relation to the SpyPermission table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Permission\Persistence\SpyPermissionQuery The inner query object of the EXISTS statement
     */
    public function usePermissionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Permission\Persistence\SpyPermissionQuery */
        $q = $this->useExistsQuery('Permission', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the Permission relation to the SpyPermission table for a NOT EXISTS query.
     *
     * @see usePermissionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Permission\Persistence\SpyPermissionQuery The inner query object of the NOT EXISTS statement
     */
    public function usePermissionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Permission\Persistence\SpyPermissionQuery */
        $q = $this->useExistsQuery('Permission', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the Permission relation to the SpyPermission table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Permission\Persistence\SpyPermissionQuery The inner query object of the IN statement
     */
    public function useInPermissionQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Permission\Persistence\SpyPermissionQuery */
        $q = $this->useInQuery('Permission', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the Permission relation to the SpyPermission table for a NOT IN query.
     *
     * @see usePermissionInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Permission\Persistence\SpyPermissionQuery The inner query object of the NOT IN statement
     */
    public function useNotInPermissionQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Permission\Persistence\SpyPermissionQuery */
        $q = $this->useInQuery('Permission', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\CompanyRole\Persistence\SpyCompanyRole object
     *
     * @param \Orm\Zed\CompanyRole\Persistence\SpyCompanyRole|ObjectCollection $spyCompanyRole The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompanyRole($spyCompanyRole, ?string $comparison = null)
    {
        if ($spyCompanyRole instanceof \Orm\Zed\CompanyRole\Persistence\SpyCompanyRole) {
            return $this
                ->addUsingAlias(SpyCompanyRoleToPermissionTableMap::COL_FK_COMPANY_ROLE, $spyCompanyRole->getIdCompanyRole(), $comparison);
        } elseif ($spyCompanyRole instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyCompanyRoleToPermissionTableMap::COL_FK_COMPANY_ROLE, $spyCompanyRole->toKeyValue('PrimaryKey', 'IdCompanyRole'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCompanyRole() only accepts arguments of type \Orm\Zed\CompanyRole\Persistence\SpyCompanyRole or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CompanyRole relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCompanyRole(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CompanyRole');

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
            $this->addJoinObject($join, 'CompanyRole');
        }

        return $this;
    }

    /**
     * Use the CompanyRole relation SpyCompanyRole object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery A secondary query class using the current class as primary query
     */
    public function useCompanyRoleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCompanyRole($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CompanyRole', '\Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery');
    }

    /**
     * Use the CompanyRole relation SpyCompanyRole object
     *
     * @param callable(\Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery):\Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCompanyRoleQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCompanyRoleQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the CompanyRole relation to the SpyCompanyRole table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery The inner query object of the EXISTS statement
     */
    public function useCompanyRoleExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery */
        $q = $this->useExistsQuery('CompanyRole', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the CompanyRole relation to the SpyCompanyRole table for a NOT EXISTS query.
     *
     * @see useCompanyRoleExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery The inner query object of the NOT EXISTS statement
     */
    public function useCompanyRoleNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery */
        $q = $this->useExistsQuery('CompanyRole', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the CompanyRole relation to the SpyCompanyRole table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery The inner query object of the IN statement
     */
    public function useInCompanyRoleQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery */
        $q = $this->useInQuery('CompanyRole', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the CompanyRole relation to the SpyCompanyRole table for a NOT IN query.
     *
     * @see useCompanyRoleInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery The inner query object of the NOT IN statement
     */
    public function useNotInCompanyRoleQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery */
        $q = $this->useInQuery('CompanyRole', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyCompanyRoleToPermission $spyCompanyRoleToPermission Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyCompanyRoleToPermission = null)
    {
        if ($spyCompanyRoleToPermission) {
            $this->addCond('pruneCond0', $this->getAliasedColName(SpyCompanyRoleToPermissionTableMap::COL_ID_COMPANY_ROLE_TO_PERMISSION), $spyCompanyRoleToPermission->getIdCompanyRoleToPermission(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(SpyCompanyRoleToPermissionTableMap::COL_FK_COMPANY_ROLE), $spyCompanyRoleToPermission->getFkCompanyRole(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond2', $this->getAliasedColName(SpyCompanyRoleToPermissionTableMap::COL_FK_PERMISSION), $spyCompanyRoleToPermission->getFkPermission(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1', 'pruneCond2'), Criteria::LOGICAL_OR);
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
     * Deletes all rows from the spy_company_role_to_permission table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCompanyRoleToPermissionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyCompanyRoleToPermissionTableMap::clearInstancePool();
            SpyCompanyRoleToPermissionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCompanyRoleToPermissionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyCompanyRoleToPermissionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyCompanyRoleToPermissionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyCompanyRoleToPermissionTableMap::clearRelatedInstancePool();

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
