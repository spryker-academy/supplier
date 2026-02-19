<?php

namespace Orm\Zed\AclEntity\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\AclEntity\Persistence\SpyAclEntitySegment as ChildSpyAclEntitySegment;
use Orm\Zed\AclEntity\Persistence\SpyAclEntitySegmentQuery as ChildSpyAclEntitySegmentQuery;
use Orm\Zed\AclEntity\Persistence\Map\SpyAclEntitySegmentTableMap;
use Orm\Zed\MerchantUser\Persistence\SpyAclEntitySegmentMerchantUser;
use Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchant;
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
 * Base class that represents a query for the `spy_acl_entity_segment` table.
 *
 * @method     ChildSpyAclEntitySegmentQuery orderByIdAclEntitySegment($order = Criteria::ASC) Order by the id_acl_entity_segment column
 * @method     ChildSpyAclEntitySegmentQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildSpyAclEntitySegmentQuery orderByReference($order = Criteria::ASC) Order by the reference column
 *
 * @method     ChildSpyAclEntitySegmentQuery groupByIdAclEntitySegment() Group by the id_acl_entity_segment column
 * @method     ChildSpyAclEntitySegmentQuery groupByName() Group by the name column
 * @method     ChildSpyAclEntitySegmentQuery groupByReference() Group by the reference column
 *
 * @method     ChildSpyAclEntitySegmentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyAclEntitySegmentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyAclEntitySegmentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyAclEntitySegmentQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyAclEntitySegmentQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyAclEntitySegmentQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyAclEntitySegmentQuery leftJoinSpyAclEntityRule($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyAclEntityRule relation
 * @method     ChildSpyAclEntitySegmentQuery rightJoinSpyAclEntityRule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyAclEntityRule relation
 * @method     ChildSpyAclEntitySegmentQuery innerJoinSpyAclEntityRule($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyAclEntityRule relation
 *
 * @method     ChildSpyAclEntitySegmentQuery joinWithSpyAclEntityRule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyAclEntityRule relation
 *
 * @method     ChildSpyAclEntitySegmentQuery leftJoinWithSpyAclEntityRule() Adds a LEFT JOIN clause and with to the query using the SpyAclEntityRule relation
 * @method     ChildSpyAclEntitySegmentQuery rightJoinWithSpyAclEntityRule() Adds a RIGHT JOIN clause and with to the query using the SpyAclEntityRule relation
 * @method     ChildSpyAclEntitySegmentQuery innerJoinWithSpyAclEntityRule() Adds a INNER JOIN clause and with to the query using the SpyAclEntityRule relation
 *
 * @method     ChildSpyAclEntitySegmentQuery leftJoinSpyAclEntitySegmentMerchant($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyAclEntitySegmentMerchant relation
 * @method     ChildSpyAclEntitySegmentQuery rightJoinSpyAclEntitySegmentMerchant($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyAclEntitySegmentMerchant relation
 * @method     ChildSpyAclEntitySegmentQuery innerJoinSpyAclEntitySegmentMerchant($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyAclEntitySegmentMerchant relation
 *
 * @method     ChildSpyAclEntitySegmentQuery joinWithSpyAclEntitySegmentMerchant($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyAclEntitySegmentMerchant relation
 *
 * @method     ChildSpyAclEntitySegmentQuery leftJoinWithSpyAclEntitySegmentMerchant() Adds a LEFT JOIN clause and with to the query using the SpyAclEntitySegmentMerchant relation
 * @method     ChildSpyAclEntitySegmentQuery rightJoinWithSpyAclEntitySegmentMerchant() Adds a RIGHT JOIN clause and with to the query using the SpyAclEntitySegmentMerchant relation
 * @method     ChildSpyAclEntitySegmentQuery innerJoinWithSpyAclEntitySegmentMerchant() Adds a INNER JOIN clause and with to the query using the SpyAclEntitySegmentMerchant relation
 *
 * @method     ChildSpyAclEntitySegmentQuery leftJoinSpyAclEntitySegmentMerchantUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyAclEntitySegmentMerchantUser relation
 * @method     ChildSpyAclEntitySegmentQuery rightJoinSpyAclEntitySegmentMerchantUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyAclEntitySegmentMerchantUser relation
 * @method     ChildSpyAclEntitySegmentQuery innerJoinSpyAclEntitySegmentMerchantUser($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyAclEntitySegmentMerchantUser relation
 *
 * @method     ChildSpyAclEntitySegmentQuery joinWithSpyAclEntitySegmentMerchantUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyAclEntitySegmentMerchantUser relation
 *
 * @method     ChildSpyAclEntitySegmentQuery leftJoinWithSpyAclEntitySegmentMerchantUser() Adds a LEFT JOIN clause and with to the query using the SpyAclEntitySegmentMerchantUser relation
 * @method     ChildSpyAclEntitySegmentQuery rightJoinWithSpyAclEntitySegmentMerchantUser() Adds a RIGHT JOIN clause and with to the query using the SpyAclEntitySegmentMerchantUser relation
 * @method     ChildSpyAclEntitySegmentQuery innerJoinWithSpyAclEntitySegmentMerchantUser() Adds a INNER JOIN clause and with to the query using the SpyAclEntitySegmentMerchantUser relation
 *
 * @method     \Orm\Zed\AclEntity\Persistence\SpyAclEntityRuleQuery|\Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchantQuery|\Orm\Zed\MerchantUser\Persistence\SpyAclEntitySegmentMerchantUserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyAclEntitySegment|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyAclEntitySegment matching the query
 * @method     ChildSpyAclEntitySegment findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyAclEntitySegment matching the query, or a new ChildSpyAclEntitySegment object populated from the query conditions when no match is found
 *
 * @method     ChildSpyAclEntitySegment|null findOneByIdAclEntitySegment(int $id_acl_entity_segment) Return the first ChildSpyAclEntitySegment filtered by the id_acl_entity_segment column
 * @method     ChildSpyAclEntitySegment|null findOneByName(string $name) Return the first ChildSpyAclEntitySegment filtered by the name column
 * @method     ChildSpyAclEntitySegment|null findOneByReference(string $reference) Return the first ChildSpyAclEntitySegment filtered by the reference column
 *
 * @method     ChildSpyAclEntitySegment requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyAclEntitySegment by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyAclEntitySegment requireOne(?ConnectionInterface $con = null) Return the first ChildSpyAclEntitySegment matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyAclEntitySegment requireOneByIdAclEntitySegment(int $id_acl_entity_segment) Return the first ChildSpyAclEntitySegment filtered by the id_acl_entity_segment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyAclEntitySegment requireOneByName(string $name) Return the first ChildSpyAclEntitySegment filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyAclEntitySegment requireOneByReference(string $reference) Return the first ChildSpyAclEntitySegment filtered by the reference column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyAclEntitySegment[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyAclEntitySegment objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyAclEntitySegment> find(?ConnectionInterface $con = null) Return ChildSpyAclEntitySegment objects based on current ModelCriteria
 *
 * @method     ChildSpyAclEntitySegment[]|Collection findByIdAclEntitySegment(int|array<int> $id_acl_entity_segment) Return ChildSpyAclEntitySegment objects filtered by the id_acl_entity_segment column
 * @psalm-method Collection&\Traversable<ChildSpyAclEntitySegment> findByIdAclEntitySegment(int|array<int> $id_acl_entity_segment) Return ChildSpyAclEntitySegment objects filtered by the id_acl_entity_segment column
 * @method     ChildSpyAclEntitySegment[]|Collection findByName(string|array<string> $name) Return ChildSpyAclEntitySegment objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildSpyAclEntitySegment> findByName(string|array<string> $name) Return ChildSpyAclEntitySegment objects filtered by the name column
 * @method     ChildSpyAclEntitySegment[]|Collection findByReference(string|array<string> $reference) Return ChildSpyAclEntitySegment objects filtered by the reference column
 * @psalm-method Collection&\Traversable<ChildSpyAclEntitySegment> findByReference(string|array<string> $reference) Return ChildSpyAclEntitySegment objects filtered by the reference column
 *
 * @method     ChildSpyAclEntitySegment[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyAclEntitySegment> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyAclEntitySegmentQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\AclEntity\Persistence\Base\SpyAclEntitySegmentQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\AclEntity\\Persistence\\SpyAclEntitySegment', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyAclEntitySegmentQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyAclEntitySegmentQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyAclEntitySegmentQuery) {
            return $criteria;
        }
        $query = new ChildSpyAclEntitySegmentQuery();
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
     * @return ChildSpyAclEntitySegment|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyAclEntitySegmentTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyAclEntitySegment A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_acl_entity_segment, name, reference FROM spy_acl_entity_segment WHERE id_acl_entity_segment = :p0';
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
            /** @var ChildSpyAclEntitySegment $obj */
            $obj = new ChildSpyAclEntitySegment();
            $obj->hydrate($row);
            SpyAclEntitySegmentTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyAclEntitySegment|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyAclEntitySegmentTableMap::COL_ID_ACL_ENTITY_SEGMENT, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyAclEntitySegmentTableMap::COL_ID_ACL_ENTITY_SEGMENT, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idAclEntitySegment Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdAclEntitySegment_Between(array $idAclEntitySegment)
    {
        return $this->filterByIdAclEntitySegment($idAclEntitySegment, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idAclEntitySegments Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdAclEntitySegment_In(array $idAclEntitySegments)
    {
        return $this->filterByIdAclEntitySegment($idAclEntitySegments, Criteria::IN);
    }

    /**
     * Filter the query on the id_acl_entity_segment column
     *
     * Example usage:
     * <code>
     * $query->filterByIdAclEntitySegment(1234); // WHERE id_acl_entity_segment = 1234
     * $query->filterByIdAclEntitySegment(array(12, 34), Criteria::IN); // WHERE id_acl_entity_segment IN (12, 34)
     * $query->filterByIdAclEntitySegment(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_acl_entity_segment > 12
     * </code>
     *
     * @param     mixed $idAclEntitySegment The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdAclEntitySegment($idAclEntitySegment = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idAclEntitySegment)) {
            $useMinMax = false;
            if (isset($idAclEntitySegment['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyAclEntitySegmentTableMap::COL_ID_ACL_ENTITY_SEGMENT, $idAclEntitySegment['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idAclEntitySegment['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyAclEntitySegmentTableMap::COL_ID_ACL_ENTITY_SEGMENT, $idAclEntitySegment['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idAclEntitySegment of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyAclEntitySegmentTableMap::COL_ID_ACL_ENTITY_SEGMENT, $idAclEntitySegment, $comparison);

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

        $query = $this->addUsingAlias(SpyAclEntitySegmentTableMap::COL_NAME, $name, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $references Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByReference_In(array $references)
    {
        return $this->filterByReference($references, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $reference Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByReference_Like($reference)
    {
        return $this->filterByReference($reference, Criteria::LIKE);
    }

    /**
     * Filter the query on the reference column
     *
     * Example usage:
     * <code>
     * $query->filterByReference('fooValue');   // WHERE reference = 'fooValue'
     * $query->filterByReference('%fooValue%', Criteria::LIKE); // WHERE reference LIKE '%fooValue%'
     * $query->filterByReference([1, 'foo'], Criteria::IN); // WHERE reference IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $reference The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByReference($reference = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $reference = str_replace('*', '%', $reference);
        }

        if (is_array($reference) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$reference of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyAclEntitySegmentTableMap::COL_REFERENCE, $reference, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\AclEntity\Persistence\SpyAclEntityRule object
     *
     * @param \Orm\Zed\AclEntity\Persistence\SpyAclEntityRule|ObjectCollection $spyAclEntityRule the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyAclEntityRule($spyAclEntityRule, ?string $comparison = null)
    {
        if ($spyAclEntityRule instanceof \Orm\Zed\AclEntity\Persistence\SpyAclEntityRule) {
            $this
                ->addUsingAlias(SpyAclEntitySegmentTableMap::COL_ID_ACL_ENTITY_SEGMENT, $spyAclEntityRule->getFkAclEntitySegment(), $comparison);

            return $this;
        } elseif ($spyAclEntityRule instanceof ObjectCollection) {
            $this
                ->useSpyAclEntityRuleQuery()
                ->filterByPrimaryKeys($spyAclEntityRule->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyAclEntityRule() only accepts arguments of type \Orm\Zed\AclEntity\Persistence\SpyAclEntityRule or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyAclEntityRule relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyAclEntityRule(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyAclEntityRule');

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
            $this->addJoinObject($join, 'SpyAclEntityRule');
        }

        return $this;
    }

    /**
     * Use the SpyAclEntityRule relation SpyAclEntityRule object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\AclEntity\Persistence\SpyAclEntityRuleQuery A secondary query class using the current class as primary query
     */
    public function useSpyAclEntityRuleQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpyAclEntityRule($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyAclEntityRule', '\Orm\Zed\AclEntity\Persistence\SpyAclEntityRuleQuery');
    }

    /**
     * Use the SpyAclEntityRule relation SpyAclEntityRule object
     *
     * @param callable(\Orm\Zed\AclEntity\Persistence\SpyAclEntityRuleQuery):\Orm\Zed\AclEntity\Persistence\SpyAclEntityRuleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyAclEntityRuleQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpyAclEntityRuleQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyAclEntityRule table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\AclEntity\Persistence\SpyAclEntityRuleQuery The inner query object of the EXISTS statement
     */
    public function useSpyAclEntityRuleExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\AclEntity\Persistence\SpyAclEntityRuleQuery */
        $q = $this->useExistsQuery('SpyAclEntityRule', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyAclEntityRule table for a NOT EXISTS query.
     *
     * @see useSpyAclEntityRuleExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\AclEntity\Persistence\SpyAclEntityRuleQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyAclEntityRuleNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\AclEntity\Persistence\SpyAclEntityRuleQuery */
        $q = $this->useExistsQuery('SpyAclEntityRule', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyAclEntityRule table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\AclEntity\Persistence\SpyAclEntityRuleQuery The inner query object of the IN statement
     */
    public function useInSpyAclEntityRuleQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\AclEntity\Persistence\SpyAclEntityRuleQuery */
        $q = $this->useInQuery('SpyAclEntityRule', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyAclEntityRule table for a NOT IN query.
     *
     * @see useSpyAclEntityRuleInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\AclEntity\Persistence\SpyAclEntityRuleQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyAclEntityRuleQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\AclEntity\Persistence\SpyAclEntityRuleQuery */
        $q = $this->useInQuery('SpyAclEntityRule', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchant object
     *
     * @param \Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchant|ObjectCollection $spyAclEntitySegmentMerchant the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyAclEntitySegmentMerchant($spyAclEntitySegmentMerchant, ?string $comparison = null)
    {
        if ($spyAclEntitySegmentMerchant instanceof \Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchant) {
            $this
                ->addUsingAlias(SpyAclEntitySegmentTableMap::COL_ID_ACL_ENTITY_SEGMENT, $spyAclEntitySegmentMerchant->getFkAclEntitySegment(), $comparison);

            return $this;
        } elseif ($spyAclEntitySegmentMerchant instanceof ObjectCollection) {
            $this
                ->useSpyAclEntitySegmentMerchantQuery()
                ->filterByPrimaryKeys($spyAclEntitySegmentMerchant->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyAclEntitySegmentMerchant() only accepts arguments of type \Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchant or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyAclEntitySegmentMerchant relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyAclEntitySegmentMerchant(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyAclEntitySegmentMerchant');

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
            $this->addJoinObject($join, 'SpyAclEntitySegmentMerchant');
        }

        return $this;
    }

    /**
     * Use the SpyAclEntitySegmentMerchant relation SpyAclEntitySegmentMerchant object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchantQuery A secondary query class using the current class as primary query
     */
    public function useSpyAclEntitySegmentMerchantQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyAclEntitySegmentMerchant($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyAclEntitySegmentMerchant', '\Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchantQuery');
    }

    /**
     * Use the SpyAclEntitySegmentMerchant relation SpyAclEntitySegmentMerchant object
     *
     * @param callable(\Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchantQuery):\Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchantQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyAclEntitySegmentMerchantQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyAclEntitySegmentMerchantQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyAclEntitySegmentMerchant table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchantQuery The inner query object of the EXISTS statement
     */
    public function useSpyAclEntitySegmentMerchantExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchantQuery */
        $q = $this->useExistsQuery('SpyAclEntitySegmentMerchant', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyAclEntitySegmentMerchant table for a NOT EXISTS query.
     *
     * @see useSpyAclEntitySegmentMerchantExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchantQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyAclEntitySegmentMerchantNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchantQuery */
        $q = $this->useExistsQuery('SpyAclEntitySegmentMerchant', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyAclEntitySegmentMerchant table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchantQuery The inner query object of the IN statement
     */
    public function useInSpyAclEntitySegmentMerchantQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchantQuery */
        $q = $this->useInQuery('SpyAclEntitySegmentMerchant', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyAclEntitySegmentMerchant table for a NOT IN query.
     *
     * @see useSpyAclEntitySegmentMerchantInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchantQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyAclEntitySegmentMerchantQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchantQuery */
        $q = $this->useInQuery('SpyAclEntitySegmentMerchant', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\MerchantUser\Persistence\SpyAclEntitySegmentMerchantUser object
     *
     * @param \Orm\Zed\MerchantUser\Persistence\SpyAclEntitySegmentMerchantUser|ObjectCollection $spyAclEntitySegmentMerchantUser the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyAclEntitySegmentMerchantUser($spyAclEntitySegmentMerchantUser, ?string $comparison = null)
    {
        if ($spyAclEntitySegmentMerchantUser instanceof \Orm\Zed\MerchantUser\Persistence\SpyAclEntitySegmentMerchantUser) {
            $this
                ->addUsingAlias(SpyAclEntitySegmentTableMap::COL_ID_ACL_ENTITY_SEGMENT, $spyAclEntitySegmentMerchantUser->getFkAclEntitySegment(), $comparison);

            return $this;
        } elseif ($spyAclEntitySegmentMerchantUser instanceof ObjectCollection) {
            $this
                ->useSpyAclEntitySegmentMerchantUserQuery()
                ->filterByPrimaryKeys($spyAclEntitySegmentMerchantUser->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyAclEntitySegmentMerchantUser() only accepts arguments of type \Orm\Zed\MerchantUser\Persistence\SpyAclEntitySegmentMerchantUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyAclEntitySegmentMerchantUser relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyAclEntitySegmentMerchantUser(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyAclEntitySegmentMerchantUser');

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
            $this->addJoinObject($join, 'SpyAclEntitySegmentMerchantUser');
        }

        return $this;
    }

    /**
     * Use the SpyAclEntitySegmentMerchantUser relation SpyAclEntitySegmentMerchantUser object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MerchantUser\Persistence\SpyAclEntitySegmentMerchantUserQuery A secondary query class using the current class as primary query
     */
    public function useSpyAclEntitySegmentMerchantUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyAclEntitySegmentMerchantUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyAclEntitySegmentMerchantUser', '\Orm\Zed\MerchantUser\Persistence\SpyAclEntitySegmentMerchantUserQuery');
    }

    /**
     * Use the SpyAclEntitySegmentMerchantUser relation SpyAclEntitySegmentMerchantUser object
     *
     * @param callable(\Orm\Zed\MerchantUser\Persistence\SpyAclEntitySegmentMerchantUserQuery):\Orm\Zed\MerchantUser\Persistence\SpyAclEntitySegmentMerchantUserQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyAclEntitySegmentMerchantUserQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyAclEntitySegmentMerchantUserQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyAclEntitySegmentMerchantUser table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MerchantUser\Persistence\SpyAclEntitySegmentMerchantUserQuery The inner query object of the EXISTS statement
     */
    public function useSpyAclEntitySegmentMerchantUserExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MerchantUser\Persistence\SpyAclEntitySegmentMerchantUserQuery */
        $q = $this->useExistsQuery('SpyAclEntitySegmentMerchantUser', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyAclEntitySegmentMerchantUser table for a NOT EXISTS query.
     *
     * @see useSpyAclEntitySegmentMerchantUserExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantUser\Persistence\SpyAclEntitySegmentMerchantUserQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyAclEntitySegmentMerchantUserNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantUser\Persistence\SpyAclEntitySegmentMerchantUserQuery */
        $q = $this->useExistsQuery('SpyAclEntitySegmentMerchantUser', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyAclEntitySegmentMerchantUser table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MerchantUser\Persistence\SpyAclEntitySegmentMerchantUserQuery The inner query object of the IN statement
     */
    public function useInSpyAclEntitySegmentMerchantUserQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MerchantUser\Persistence\SpyAclEntitySegmentMerchantUserQuery */
        $q = $this->useInQuery('SpyAclEntitySegmentMerchantUser', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyAclEntitySegmentMerchantUser table for a NOT IN query.
     *
     * @see useSpyAclEntitySegmentMerchantUserInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantUser\Persistence\SpyAclEntitySegmentMerchantUserQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyAclEntitySegmentMerchantUserQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantUser\Persistence\SpyAclEntitySegmentMerchantUserQuery */
        $q = $this->useInQuery('SpyAclEntitySegmentMerchantUser', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyAclEntitySegment $spyAclEntitySegment Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyAclEntitySegment = null)
    {
        if ($spyAclEntitySegment) {
            $this->addUsingAlias(SpyAclEntitySegmentTableMap::COL_ID_ACL_ENTITY_SEGMENT, $spyAclEntitySegment->getIdAclEntitySegment(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_acl_entity_segment table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyAclEntitySegmentTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyAclEntitySegmentTableMap::clearInstancePool();
            SpyAclEntitySegmentTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyAclEntitySegmentTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyAclEntitySegmentTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyAclEntitySegmentTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyAclEntitySegmentTableMap::clearRelatedInstancePool();

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
