<?php

namespace Orm\Zed\AclEntity\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\AclEntity\Persistence\SpyAclEntityRule as ChildSpyAclEntityRule;
use Orm\Zed\AclEntity\Persistence\SpyAclEntityRuleQuery as ChildSpyAclEntityRuleQuery;
use Orm\Zed\AclEntity\Persistence\Map\SpyAclEntityRuleTableMap;
use Orm\Zed\Acl\Persistence\SpyAclRole;
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
 * Base class that represents a query for the `spy_acl_entity_rule` table.
 *
 * @method     ChildSpyAclEntityRuleQuery orderByIdAclEntityRule($order = Criteria::ASC) Order by the id_acl_entity_rule column
 * @method     ChildSpyAclEntityRuleQuery orderByFkAclEntitySegment($order = Criteria::ASC) Order by the fk_acl_entity_segment column
 * @method     ChildSpyAclEntityRuleQuery orderByFkAclRole($order = Criteria::ASC) Order by the fk_acl_role column
 * @method     ChildSpyAclEntityRuleQuery orderByEntity($order = Criteria::ASC) Order by the entity column
 * @method     ChildSpyAclEntityRuleQuery orderByPermissionMask($order = Criteria::ASC) Order by the permission_mask column
 * @method     ChildSpyAclEntityRuleQuery orderByScope($order = Criteria::ASC) Order by the scope column
 *
 * @method     ChildSpyAclEntityRuleQuery groupByIdAclEntityRule() Group by the id_acl_entity_rule column
 * @method     ChildSpyAclEntityRuleQuery groupByFkAclEntitySegment() Group by the fk_acl_entity_segment column
 * @method     ChildSpyAclEntityRuleQuery groupByFkAclRole() Group by the fk_acl_role column
 * @method     ChildSpyAclEntityRuleQuery groupByEntity() Group by the entity column
 * @method     ChildSpyAclEntityRuleQuery groupByPermissionMask() Group by the permission_mask column
 * @method     ChildSpyAclEntityRuleQuery groupByScope() Group by the scope column
 *
 * @method     ChildSpyAclEntityRuleQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyAclEntityRuleQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyAclEntityRuleQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyAclEntityRuleQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyAclEntityRuleQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyAclEntityRuleQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyAclEntityRuleQuery leftJoinSpyAclRole($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyAclRole relation
 * @method     ChildSpyAclEntityRuleQuery rightJoinSpyAclRole($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyAclRole relation
 * @method     ChildSpyAclEntityRuleQuery innerJoinSpyAclRole($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyAclRole relation
 *
 * @method     ChildSpyAclEntityRuleQuery joinWithSpyAclRole($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyAclRole relation
 *
 * @method     ChildSpyAclEntityRuleQuery leftJoinWithSpyAclRole() Adds a LEFT JOIN clause and with to the query using the SpyAclRole relation
 * @method     ChildSpyAclEntityRuleQuery rightJoinWithSpyAclRole() Adds a RIGHT JOIN clause and with to the query using the SpyAclRole relation
 * @method     ChildSpyAclEntityRuleQuery innerJoinWithSpyAclRole() Adds a INNER JOIN clause and with to the query using the SpyAclRole relation
 *
 * @method     ChildSpyAclEntityRuleQuery leftJoinSpyAclEntitySegment($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyAclEntitySegment relation
 * @method     ChildSpyAclEntityRuleQuery rightJoinSpyAclEntitySegment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyAclEntitySegment relation
 * @method     ChildSpyAclEntityRuleQuery innerJoinSpyAclEntitySegment($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyAclEntitySegment relation
 *
 * @method     ChildSpyAclEntityRuleQuery joinWithSpyAclEntitySegment($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyAclEntitySegment relation
 *
 * @method     ChildSpyAclEntityRuleQuery leftJoinWithSpyAclEntitySegment() Adds a LEFT JOIN clause and with to the query using the SpyAclEntitySegment relation
 * @method     ChildSpyAclEntityRuleQuery rightJoinWithSpyAclEntitySegment() Adds a RIGHT JOIN clause and with to the query using the SpyAclEntitySegment relation
 * @method     ChildSpyAclEntityRuleQuery innerJoinWithSpyAclEntitySegment() Adds a INNER JOIN clause and with to the query using the SpyAclEntitySegment relation
 *
 * @method     \Orm\Zed\Acl\Persistence\SpyAclRoleQuery|\Orm\Zed\AclEntity\Persistence\SpyAclEntitySegmentQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyAclEntityRule|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyAclEntityRule matching the query
 * @method     ChildSpyAclEntityRule findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyAclEntityRule matching the query, or a new ChildSpyAclEntityRule object populated from the query conditions when no match is found
 *
 * @method     ChildSpyAclEntityRule|null findOneByIdAclEntityRule(int $id_acl_entity_rule) Return the first ChildSpyAclEntityRule filtered by the id_acl_entity_rule column
 * @method     ChildSpyAclEntityRule|null findOneByFkAclEntitySegment(int $fk_acl_entity_segment) Return the first ChildSpyAclEntityRule filtered by the fk_acl_entity_segment column
 * @method     ChildSpyAclEntityRule|null findOneByFkAclRole(int $fk_acl_role) Return the first ChildSpyAclEntityRule filtered by the fk_acl_role column
 * @method     ChildSpyAclEntityRule|null findOneByEntity(string $entity) Return the first ChildSpyAclEntityRule filtered by the entity column
 * @method     ChildSpyAclEntityRule|null findOneByPermissionMask(int $permission_mask) Return the first ChildSpyAclEntityRule filtered by the permission_mask column
 * @method     ChildSpyAclEntityRule|null findOneByScope(int $scope) Return the first ChildSpyAclEntityRule filtered by the scope column
 *
 * @method     ChildSpyAclEntityRule requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyAclEntityRule by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyAclEntityRule requireOne(?ConnectionInterface $con = null) Return the first ChildSpyAclEntityRule matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyAclEntityRule requireOneByIdAclEntityRule(int $id_acl_entity_rule) Return the first ChildSpyAclEntityRule filtered by the id_acl_entity_rule column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyAclEntityRule requireOneByFkAclEntitySegment(int $fk_acl_entity_segment) Return the first ChildSpyAclEntityRule filtered by the fk_acl_entity_segment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyAclEntityRule requireOneByFkAclRole(int $fk_acl_role) Return the first ChildSpyAclEntityRule filtered by the fk_acl_role column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyAclEntityRule requireOneByEntity(string $entity) Return the first ChildSpyAclEntityRule filtered by the entity column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyAclEntityRule requireOneByPermissionMask(int $permission_mask) Return the first ChildSpyAclEntityRule filtered by the permission_mask column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyAclEntityRule requireOneByScope(int $scope) Return the first ChildSpyAclEntityRule filtered by the scope column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyAclEntityRule[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyAclEntityRule objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyAclEntityRule> find(?ConnectionInterface $con = null) Return ChildSpyAclEntityRule objects based on current ModelCriteria
 *
 * @method     ChildSpyAclEntityRule[]|Collection findByIdAclEntityRule(int|array<int> $id_acl_entity_rule) Return ChildSpyAclEntityRule objects filtered by the id_acl_entity_rule column
 * @psalm-method Collection&\Traversable<ChildSpyAclEntityRule> findByIdAclEntityRule(int|array<int> $id_acl_entity_rule) Return ChildSpyAclEntityRule objects filtered by the id_acl_entity_rule column
 * @method     ChildSpyAclEntityRule[]|Collection findByFkAclEntitySegment(int|array<int> $fk_acl_entity_segment) Return ChildSpyAclEntityRule objects filtered by the fk_acl_entity_segment column
 * @psalm-method Collection&\Traversable<ChildSpyAclEntityRule> findByFkAclEntitySegment(int|array<int> $fk_acl_entity_segment) Return ChildSpyAclEntityRule objects filtered by the fk_acl_entity_segment column
 * @method     ChildSpyAclEntityRule[]|Collection findByFkAclRole(int|array<int> $fk_acl_role) Return ChildSpyAclEntityRule objects filtered by the fk_acl_role column
 * @psalm-method Collection&\Traversable<ChildSpyAclEntityRule> findByFkAclRole(int|array<int> $fk_acl_role) Return ChildSpyAclEntityRule objects filtered by the fk_acl_role column
 * @method     ChildSpyAclEntityRule[]|Collection findByEntity(string|array<string> $entity) Return ChildSpyAclEntityRule objects filtered by the entity column
 * @psalm-method Collection&\Traversable<ChildSpyAclEntityRule> findByEntity(string|array<string> $entity) Return ChildSpyAclEntityRule objects filtered by the entity column
 * @method     ChildSpyAclEntityRule[]|Collection findByPermissionMask(int|array<int> $permission_mask) Return ChildSpyAclEntityRule objects filtered by the permission_mask column
 * @psalm-method Collection&\Traversable<ChildSpyAclEntityRule> findByPermissionMask(int|array<int> $permission_mask) Return ChildSpyAclEntityRule objects filtered by the permission_mask column
 * @method     ChildSpyAclEntityRule[]|Collection findByScope(int|array<int> $scope) Return ChildSpyAclEntityRule objects filtered by the scope column
 * @psalm-method Collection&\Traversable<ChildSpyAclEntityRule> findByScope(int|array<int> $scope) Return ChildSpyAclEntityRule objects filtered by the scope column
 *
 * @method     ChildSpyAclEntityRule[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyAclEntityRule> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyAclEntityRuleQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\AclEntity\Persistence\Base\SpyAclEntityRuleQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\AclEntity\\Persistence\\SpyAclEntityRule', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyAclEntityRuleQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyAclEntityRuleQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyAclEntityRuleQuery) {
            return $criteria;
        }
        $query = new ChildSpyAclEntityRuleQuery();
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
     * @return ChildSpyAclEntityRule|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyAclEntityRuleTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyAclEntityRule A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_acl_entity_rule, fk_acl_entity_segment, fk_acl_role, entity, permission_mask, scope FROM spy_acl_entity_rule WHERE id_acl_entity_rule = :p0';
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
            /** @var ChildSpyAclEntityRule $obj */
            $obj = new ChildSpyAclEntityRule();
            $obj->hydrate($row);
            SpyAclEntityRuleTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyAclEntityRule|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyAclEntityRuleTableMap::COL_ID_ACL_ENTITY_RULE, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyAclEntityRuleTableMap::COL_ID_ACL_ENTITY_RULE, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idAclEntityRule Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdAclEntityRule_Between(array $idAclEntityRule)
    {
        return $this->filterByIdAclEntityRule($idAclEntityRule, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idAclEntityRules Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdAclEntityRule_In(array $idAclEntityRules)
    {
        return $this->filterByIdAclEntityRule($idAclEntityRules, Criteria::IN);
    }

    /**
     * Filter the query on the id_acl_entity_rule column
     *
     * Example usage:
     * <code>
     * $query->filterByIdAclEntityRule(1234); // WHERE id_acl_entity_rule = 1234
     * $query->filterByIdAclEntityRule(array(12, 34), Criteria::IN); // WHERE id_acl_entity_rule IN (12, 34)
     * $query->filterByIdAclEntityRule(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_acl_entity_rule > 12
     * </code>
     *
     * @param     mixed $idAclEntityRule The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdAclEntityRule($idAclEntityRule = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idAclEntityRule)) {
            $useMinMax = false;
            if (isset($idAclEntityRule['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyAclEntityRuleTableMap::COL_ID_ACL_ENTITY_RULE, $idAclEntityRule['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idAclEntityRule['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyAclEntityRuleTableMap::COL_ID_ACL_ENTITY_RULE, $idAclEntityRule['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idAclEntityRule of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyAclEntityRuleTableMap::COL_ID_ACL_ENTITY_RULE, $idAclEntityRule, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkAclEntitySegment Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkAclEntitySegment_Between(array $fkAclEntitySegment)
    {
        return $this->filterByFkAclEntitySegment($fkAclEntitySegment, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkAclEntitySegments Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkAclEntitySegment_In(array $fkAclEntitySegments)
    {
        return $this->filterByFkAclEntitySegment($fkAclEntitySegments, Criteria::IN);
    }

    /**
     * Filter the query on the fk_acl_entity_segment column
     *
     * Example usage:
     * <code>
     * $query->filterByFkAclEntitySegment(1234); // WHERE fk_acl_entity_segment = 1234
     * $query->filterByFkAclEntitySegment(array(12, 34), Criteria::IN); // WHERE fk_acl_entity_segment IN (12, 34)
     * $query->filterByFkAclEntitySegment(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_acl_entity_segment > 12
     * </code>
     *
     * @see       filterBySpyAclEntitySegment()
     *
     * @param     mixed $fkAclEntitySegment The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkAclEntitySegment($fkAclEntitySegment = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkAclEntitySegment)) {
            $useMinMax = false;
            if (isset($fkAclEntitySegment['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyAclEntityRuleTableMap::COL_FK_ACL_ENTITY_SEGMENT, $fkAclEntitySegment['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkAclEntitySegment['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyAclEntityRuleTableMap::COL_FK_ACL_ENTITY_SEGMENT, $fkAclEntitySegment['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkAclEntitySegment of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyAclEntityRuleTableMap::COL_FK_ACL_ENTITY_SEGMENT, $fkAclEntitySegment, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkAclRole Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkAclRole_Between(array $fkAclRole)
    {
        return $this->filterByFkAclRole($fkAclRole, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkAclRoles Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkAclRole_In(array $fkAclRoles)
    {
        return $this->filterByFkAclRole($fkAclRoles, Criteria::IN);
    }

    /**
     * Filter the query on the fk_acl_role column
     *
     * Example usage:
     * <code>
     * $query->filterByFkAclRole(1234); // WHERE fk_acl_role = 1234
     * $query->filterByFkAclRole(array(12, 34), Criteria::IN); // WHERE fk_acl_role IN (12, 34)
     * $query->filterByFkAclRole(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_acl_role > 12
     * </code>
     *
     * @see       filterBySpyAclRole()
     *
     * @param     mixed $fkAclRole The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkAclRole($fkAclRole = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkAclRole)) {
            $useMinMax = false;
            if (isset($fkAclRole['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyAclEntityRuleTableMap::COL_FK_ACL_ROLE, $fkAclRole['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkAclRole['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyAclEntityRuleTableMap::COL_FK_ACL_ROLE, $fkAclRole['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkAclRole of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyAclEntityRuleTableMap::COL_FK_ACL_ROLE, $fkAclRole, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $entitys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEntity_In(array $entitys)
    {
        return $this->filterByEntity($entitys, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $entity Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEntity_Like($entity)
    {
        return $this->filterByEntity($entity, Criteria::LIKE);
    }

    /**
     * Filter the query on the entity column
     *
     * Example usage:
     * <code>
     * $query->filterByEntity('fooValue');   // WHERE entity = 'fooValue'
     * $query->filterByEntity('%fooValue%', Criteria::LIKE); // WHERE entity LIKE '%fooValue%'
     * $query->filterByEntity([1, 'foo'], Criteria::IN); // WHERE entity IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $entity The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByEntity($entity = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $entity = str_replace('*', '%', $entity);
        }

        if (is_array($entity) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$entity of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyAclEntityRuleTableMap::COL_ENTITY, $entity, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $permissionMask Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPermissionMask_Between(array $permissionMask)
    {
        return $this->filterByPermissionMask($permissionMask, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $permissionMasks Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPermissionMask_In(array $permissionMasks)
    {
        return $this->filterByPermissionMask($permissionMasks, Criteria::IN);
    }

    /**
     * Filter the query on the permission_mask column
     *
     * Example usage:
     * <code>
     * $query->filterByPermissionMask(1234); // WHERE permission_mask = 1234
     * $query->filterByPermissionMask(array(12, 34), Criteria::IN); // WHERE permission_mask IN (12, 34)
     * $query->filterByPermissionMask(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE permission_mask > 12
     * </code>
     *
     * @param     mixed $permissionMask The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByPermissionMask($permissionMask = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($permissionMask)) {
            $useMinMax = false;
            if (isset($permissionMask['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyAclEntityRuleTableMap::COL_PERMISSION_MASK, $permissionMask['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($permissionMask['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyAclEntityRuleTableMap::COL_PERMISSION_MASK, $permissionMask['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$permissionMask of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyAclEntityRuleTableMap::COL_PERMISSION_MASK, $permissionMask, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $scopes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByScope_In(array $scopes)
    {
        return $this->filterByScope($scopes, Criteria::IN);
    }

    /**
     * Filter the query on the scope column
     *
     * @param     mixed $scope The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByScope($scope = null, $comparison = Criteria::EQUAL)
    {
        $valueSet = SpyAclEntityRuleTableMap::getValueSet(SpyAclEntityRuleTableMap::COL_SCOPE);
        if (is_scalar($scope)) {
            if (!in_array($scope, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $scope));
            }
            $scope = array_search($scope, $valueSet);
        } elseif (is_array($scope)) {
            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
            $convertedValues = array();
            foreach ($scope as $value) {
                if (!in_array($value, $valueSet)) {
                    throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $value));
                }
                $convertedValues []= array_search($value, $valueSet);
            }
            $scope = $convertedValues;
        }

        $query = $this->addUsingAlias(SpyAclEntityRuleTableMap::COL_SCOPE, $scope, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Acl\Persistence\SpyAclRole object
     *
     * @param \Orm\Zed\Acl\Persistence\SpyAclRole|ObjectCollection $spyAclRole The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyAclRole($spyAclRole, ?string $comparison = null)
    {
        if ($spyAclRole instanceof \Orm\Zed\Acl\Persistence\SpyAclRole) {
            return $this
                ->addUsingAlias(SpyAclEntityRuleTableMap::COL_FK_ACL_ROLE, $spyAclRole->getIdAclRole(), $comparison);
        } elseif ($spyAclRole instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyAclEntityRuleTableMap::COL_FK_ACL_ROLE, $spyAclRole->toKeyValue('PrimaryKey', 'IdAclRole'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyAclRole() only accepts arguments of type \Orm\Zed\Acl\Persistence\SpyAclRole or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyAclRole relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyAclRole(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyAclRole');

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
            $this->addJoinObject($join, 'SpyAclRole');
        }

        return $this;
    }

    /**
     * Use the SpyAclRole relation SpyAclRole object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Acl\Persistence\SpyAclRoleQuery A secondary query class using the current class as primary query
     */
    public function useSpyAclRoleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyAclRole($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyAclRole', '\Orm\Zed\Acl\Persistence\SpyAclRoleQuery');
    }

    /**
     * Use the SpyAclRole relation SpyAclRole object
     *
     * @param callable(\Orm\Zed\Acl\Persistence\SpyAclRoleQuery):\Orm\Zed\Acl\Persistence\SpyAclRoleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyAclRoleQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyAclRoleQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyAclRole table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Acl\Persistence\SpyAclRoleQuery The inner query object of the EXISTS statement
     */
    public function useSpyAclRoleExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Acl\Persistence\SpyAclRoleQuery */
        $q = $this->useExistsQuery('SpyAclRole', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyAclRole table for a NOT EXISTS query.
     *
     * @see useSpyAclRoleExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Acl\Persistence\SpyAclRoleQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyAclRoleNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Acl\Persistence\SpyAclRoleQuery */
        $q = $this->useExistsQuery('SpyAclRole', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyAclRole table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Acl\Persistence\SpyAclRoleQuery The inner query object of the IN statement
     */
    public function useInSpyAclRoleQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Acl\Persistence\SpyAclRoleQuery */
        $q = $this->useInQuery('SpyAclRole', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyAclRole table for a NOT IN query.
     *
     * @see useSpyAclRoleInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Acl\Persistence\SpyAclRoleQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyAclRoleQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Acl\Persistence\SpyAclRoleQuery */
        $q = $this->useInQuery('SpyAclRole', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\AclEntity\Persistence\SpyAclEntitySegment object
     *
     * @param \Orm\Zed\AclEntity\Persistence\SpyAclEntitySegment|ObjectCollection $spyAclEntitySegment The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyAclEntitySegment($spyAclEntitySegment, ?string $comparison = null)
    {
        if ($spyAclEntitySegment instanceof \Orm\Zed\AclEntity\Persistence\SpyAclEntitySegment) {
            return $this
                ->addUsingAlias(SpyAclEntityRuleTableMap::COL_FK_ACL_ENTITY_SEGMENT, $spyAclEntitySegment->getIdAclEntitySegment(), $comparison);
        } elseif ($spyAclEntitySegment instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyAclEntityRuleTableMap::COL_FK_ACL_ENTITY_SEGMENT, $spyAclEntitySegment->toKeyValue('PrimaryKey', 'IdAclEntitySegment'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyAclEntitySegment() only accepts arguments of type \Orm\Zed\AclEntity\Persistence\SpyAclEntitySegment or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyAclEntitySegment relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyAclEntitySegment(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyAclEntitySegment');

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
            $this->addJoinObject($join, 'SpyAclEntitySegment');
        }

        return $this;
    }

    /**
     * Use the SpyAclEntitySegment relation SpyAclEntitySegment object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\AclEntity\Persistence\SpyAclEntitySegmentQuery A secondary query class using the current class as primary query
     */
    public function useSpyAclEntitySegmentQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpyAclEntitySegment($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyAclEntitySegment', '\Orm\Zed\AclEntity\Persistence\SpyAclEntitySegmentQuery');
    }

    /**
     * Use the SpyAclEntitySegment relation SpyAclEntitySegment object
     *
     * @param callable(\Orm\Zed\AclEntity\Persistence\SpyAclEntitySegmentQuery):\Orm\Zed\AclEntity\Persistence\SpyAclEntitySegmentQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyAclEntitySegmentQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpyAclEntitySegmentQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyAclEntitySegment table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\AclEntity\Persistence\SpyAclEntitySegmentQuery The inner query object of the EXISTS statement
     */
    public function useSpyAclEntitySegmentExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\AclEntity\Persistence\SpyAclEntitySegmentQuery */
        $q = $this->useExistsQuery('SpyAclEntitySegment', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyAclEntitySegment table for a NOT EXISTS query.
     *
     * @see useSpyAclEntitySegmentExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\AclEntity\Persistence\SpyAclEntitySegmentQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyAclEntitySegmentNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\AclEntity\Persistence\SpyAclEntitySegmentQuery */
        $q = $this->useExistsQuery('SpyAclEntitySegment', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyAclEntitySegment table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\AclEntity\Persistence\SpyAclEntitySegmentQuery The inner query object of the IN statement
     */
    public function useInSpyAclEntitySegmentQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\AclEntity\Persistence\SpyAclEntitySegmentQuery */
        $q = $this->useInQuery('SpyAclEntitySegment', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyAclEntitySegment table for a NOT IN query.
     *
     * @see useSpyAclEntitySegmentInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\AclEntity\Persistence\SpyAclEntitySegmentQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyAclEntitySegmentQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\AclEntity\Persistence\SpyAclEntitySegmentQuery */
        $q = $this->useInQuery('SpyAclEntitySegment', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyAclEntityRule $spyAclEntityRule Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyAclEntityRule = null)
    {
        if ($spyAclEntityRule) {
            $this->addUsingAlias(SpyAclEntityRuleTableMap::COL_ID_ACL_ENTITY_RULE, $spyAclEntityRule->getIdAclEntityRule(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_acl_entity_rule table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyAclEntityRuleTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyAclEntityRuleTableMap::clearInstancePool();
            SpyAclEntityRuleTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyAclEntityRuleTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyAclEntityRuleTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyAclEntityRuleTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyAclEntityRuleTableMap::clearRelatedInstancePool();

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
