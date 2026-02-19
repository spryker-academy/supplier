<?php

namespace Orm\Zed\MerchantUser\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\AclEntity\Persistence\SpyAclEntitySegment;
use Orm\Zed\MerchantUser\Persistence\SpyAclEntitySegmentMerchantUser as ChildSpyAclEntitySegmentMerchantUser;
use Orm\Zed\MerchantUser\Persistence\SpyAclEntitySegmentMerchantUserQuery as ChildSpyAclEntitySegmentMerchantUserQuery;
use Orm\Zed\MerchantUser\Persistence\Map\SpyAclEntitySegmentMerchantUserTableMap;
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
 * Base class that represents a query for the `spy_acl_entity_segment_merchant_user` table.
 *
 * @method     ChildSpyAclEntitySegmentMerchantUserQuery orderByIdAclEntitySegmentMerchantUser($order = Criteria::ASC) Order by the id_acl_entity_segment_merchant_user column
 * @method     ChildSpyAclEntitySegmentMerchantUserQuery orderByFkMerchantUser($order = Criteria::ASC) Order by the fk_merchant_user column
 * @method     ChildSpyAclEntitySegmentMerchantUserQuery orderByFkAclEntitySegment($order = Criteria::ASC) Order by the fk_acl_entity_segment column
 *
 * @method     ChildSpyAclEntitySegmentMerchantUserQuery groupByIdAclEntitySegmentMerchantUser() Group by the id_acl_entity_segment_merchant_user column
 * @method     ChildSpyAclEntitySegmentMerchantUserQuery groupByFkMerchantUser() Group by the fk_merchant_user column
 * @method     ChildSpyAclEntitySegmentMerchantUserQuery groupByFkAclEntitySegment() Group by the fk_acl_entity_segment column
 *
 * @method     ChildSpyAclEntitySegmentMerchantUserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyAclEntitySegmentMerchantUserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyAclEntitySegmentMerchantUserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyAclEntitySegmentMerchantUserQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyAclEntitySegmentMerchantUserQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyAclEntitySegmentMerchantUserQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyAclEntitySegmentMerchantUserQuery leftJoinSpyMerchantUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchantUser relation
 * @method     ChildSpyAclEntitySegmentMerchantUserQuery rightJoinSpyMerchantUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchantUser relation
 * @method     ChildSpyAclEntitySegmentMerchantUserQuery innerJoinSpyMerchantUser($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchantUser relation
 *
 * @method     ChildSpyAclEntitySegmentMerchantUserQuery joinWithSpyMerchantUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchantUser relation
 *
 * @method     ChildSpyAclEntitySegmentMerchantUserQuery leftJoinWithSpyMerchantUser() Adds a LEFT JOIN clause and with to the query using the SpyMerchantUser relation
 * @method     ChildSpyAclEntitySegmentMerchantUserQuery rightJoinWithSpyMerchantUser() Adds a RIGHT JOIN clause and with to the query using the SpyMerchantUser relation
 * @method     ChildSpyAclEntitySegmentMerchantUserQuery innerJoinWithSpyMerchantUser() Adds a INNER JOIN clause and with to the query using the SpyMerchantUser relation
 *
 * @method     ChildSpyAclEntitySegmentMerchantUserQuery leftJoinSpyAclEntitySegment($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyAclEntitySegment relation
 * @method     ChildSpyAclEntitySegmentMerchantUserQuery rightJoinSpyAclEntitySegment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyAclEntitySegment relation
 * @method     ChildSpyAclEntitySegmentMerchantUserQuery innerJoinSpyAclEntitySegment($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyAclEntitySegment relation
 *
 * @method     ChildSpyAclEntitySegmentMerchantUserQuery joinWithSpyAclEntitySegment($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyAclEntitySegment relation
 *
 * @method     ChildSpyAclEntitySegmentMerchantUserQuery leftJoinWithSpyAclEntitySegment() Adds a LEFT JOIN clause and with to the query using the SpyAclEntitySegment relation
 * @method     ChildSpyAclEntitySegmentMerchantUserQuery rightJoinWithSpyAclEntitySegment() Adds a RIGHT JOIN clause and with to the query using the SpyAclEntitySegment relation
 * @method     ChildSpyAclEntitySegmentMerchantUserQuery innerJoinWithSpyAclEntitySegment() Adds a INNER JOIN clause and with to the query using the SpyAclEntitySegment relation
 *
 * @method     \Orm\Zed\MerchantUser\Persistence\SpyMerchantUserQuery|\Orm\Zed\AclEntity\Persistence\SpyAclEntitySegmentQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyAclEntitySegmentMerchantUser|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyAclEntitySegmentMerchantUser matching the query
 * @method     ChildSpyAclEntitySegmentMerchantUser findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyAclEntitySegmentMerchantUser matching the query, or a new ChildSpyAclEntitySegmentMerchantUser object populated from the query conditions when no match is found
 *
 * @method     ChildSpyAclEntitySegmentMerchantUser|null findOneByIdAclEntitySegmentMerchantUser(int $id_acl_entity_segment_merchant_user) Return the first ChildSpyAclEntitySegmentMerchantUser filtered by the id_acl_entity_segment_merchant_user column
 * @method     ChildSpyAclEntitySegmentMerchantUser|null findOneByFkMerchantUser(int $fk_merchant_user) Return the first ChildSpyAclEntitySegmentMerchantUser filtered by the fk_merchant_user column
 * @method     ChildSpyAclEntitySegmentMerchantUser|null findOneByFkAclEntitySegment(int $fk_acl_entity_segment) Return the first ChildSpyAclEntitySegmentMerchantUser filtered by the fk_acl_entity_segment column
 *
 * @method     ChildSpyAclEntitySegmentMerchantUser requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyAclEntitySegmentMerchantUser by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyAclEntitySegmentMerchantUser requireOne(?ConnectionInterface $con = null) Return the first ChildSpyAclEntitySegmentMerchantUser matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyAclEntitySegmentMerchantUser requireOneByIdAclEntitySegmentMerchantUser(int $id_acl_entity_segment_merchant_user) Return the first ChildSpyAclEntitySegmentMerchantUser filtered by the id_acl_entity_segment_merchant_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyAclEntitySegmentMerchantUser requireOneByFkMerchantUser(int $fk_merchant_user) Return the first ChildSpyAclEntitySegmentMerchantUser filtered by the fk_merchant_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyAclEntitySegmentMerchantUser requireOneByFkAclEntitySegment(int $fk_acl_entity_segment) Return the first ChildSpyAclEntitySegmentMerchantUser filtered by the fk_acl_entity_segment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyAclEntitySegmentMerchantUser[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyAclEntitySegmentMerchantUser objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyAclEntitySegmentMerchantUser> find(?ConnectionInterface $con = null) Return ChildSpyAclEntitySegmentMerchantUser objects based on current ModelCriteria
 *
 * @method     ChildSpyAclEntitySegmentMerchantUser[]|Collection findByIdAclEntitySegmentMerchantUser(int|array<int> $id_acl_entity_segment_merchant_user) Return ChildSpyAclEntitySegmentMerchantUser objects filtered by the id_acl_entity_segment_merchant_user column
 * @psalm-method Collection&\Traversable<ChildSpyAclEntitySegmentMerchantUser> findByIdAclEntitySegmentMerchantUser(int|array<int> $id_acl_entity_segment_merchant_user) Return ChildSpyAclEntitySegmentMerchantUser objects filtered by the id_acl_entity_segment_merchant_user column
 * @method     ChildSpyAclEntitySegmentMerchantUser[]|Collection findByFkMerchantUser(int|array<int> $fk_merchant_user) Return ChildSpyAclEntitySegmentMerchantUser objects filtered by the fk_merchant_user column
 * @psalm-method Collection&\Traversable<ChildSpyAclEntitySegmentMerchantUser> findByFkMerchantUser(int|array<int> $fk_merchant_user) Return ChildSpyAclEntitySegmentMerchantUser objects filtered by the fk_merchant_user column
 * @method     ChildSpyAclEntitySegmentMerchantUser[]|Collection findByFkAclEntitySegment(int|array<int> $fk_acl_entity_segment) Return ChildSpyAclEntitySegmentMerchantUser objects filtered by the fk_acl_entity_segment column
 * @psalm-method Collection&\Traversable<ChildSpyAclEntitySegmentMerchantUser> findByFkAclEntitySegment(int|array<int> $fk_acl_entity_segment) Return ChildSpyAclEntitySegmentMerchantUser objects filtered by the fk_acl_entity_segment column
 *
 * @method     ChildSpyAclEntitySegmentMerchantUser[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyAclEntitySegmentMerchantUser> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyAclEntitySegmentMerchantUserQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\MerchantUser\Persistence\Base\SpyAclEntitySegmentMerchantUserQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\MerchantUser\\Persistence\\SpyAclEntitySegmentMerchantUser', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyAclEntitySegmentMerchantUserQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyAclEntitySegmentMerchantUserQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyAclEntitySegmentMerchantUserQuery) {
            return $criteria;
        }
        $query = new ChildSpyAclEntitySegmentMerchantUserQuery();
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
     * @return ChildSpyAclEntitySegmentMerchantUser|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyAclEntitySegmentMerchantUserTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyAclEntitySegmentMerchantUser A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_acl_entity_segment_merchant_user, fk_merchant_user, fk_acl_entity_segment FROM spy_acl_entity_segment_merchant_user WHERE id_acl_entity_segment_merchant_user = :p0';
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
            /** @var ChildSpyAclEntitySegmentMerchantUser $obj */
            $obj = new ChildSpyAclEntitySegmentMerchantUser();
            $obj->hydrate($row);
            SpyAclEntitySegmentMerchantUserTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyAclEntitySegmentMerchantUser|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyAclEntitySegmentMerchantUserTableMap::COL_ID_ACL_ENTITY_SEGMENT_MERCHANT_USER, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyAclEntitySegmentMerchantUserTableMap::COL_ID_ACL_ENTITY_SEGMENT_MERCHANT_USER, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idAclEntitySegmentMerchantUser Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdAclEntitySegmentMerchantUser_Between(array $idAclEntitySegmentMerchantUser)
    {
        return $this->filterByIdAclEntitySegmentMerchantUser($idAclEntitySegmentMerchantUser, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idAclEntitySegmentMerchantUsers Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdAclEntitySegmentMerchantUser_In(array $idAclEntitySegmentMerchantUsers)
    {
        return $this->filterByIdAclEntitySegmentMerchantUser($idAclEntitySegmentMerchantUsers, Criteria::IN);
    }

    /**
     * Filter the query on the id_acl_entity_segment_merchant_user column
     *
     * Example usage:
     * <code>
     * $query->filterByIdAclEntitySegmentMerchantUser(1234); // WHERE id_acl_entity_segment_merchant_user = 1234
     * $query->filterByIdAclEntitySegmentMerchantUser(array(12, 34), Criteria::IN); // WHERE id_acl_entity_segment_merchant_user IN (12, 34)
     * $query->filterByIdAclEntitySegmentMerchantUser(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_acl_entity_segment_merchant_user > 12
     * </code>
     *
     * @param     mixed $idAclEntitySegmentMerchantUser The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdAclEntitySegmentMerchantUser($idAclEntitySegmentMerchantUser = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idAclEntitySegmentMerchantUser)) {
            $useMinMax = false;
            if (isset($idAclEntitySegmentMerchantUser['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyAclEntitySegmentMerchantUserTableMap::COL_ID_ACL_ENTITY_SEGMENT_MERCHANT_USER, $idAclEntitySegmentMerchantUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idAclEntitySegmentMerchantUser['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyAclEntitySegmentMerchantUserTableMap::COL_ID_ACL_ENTITY_SEGMENT_MERCHANT_USER, $idAclEntitySegmentMerchantUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idAclEntitySegmentMerchantUser of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyAclEntitySegmentMerchantUserTableMap::COL_ID_ACL_ENTITY_SEGMENT_MERCHANT_USER, $idAclEntitySegmentMerchantUser, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkMerchantUser Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkMerchantUser_Between(array $fkMerchantUser)
    {
        return $this->filterByFkMerchantUser($fkMerchantUser, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkMerchantUsers Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkMerchantUser_In(array $fkMerchantUsers)
    {
        return $this->filterByFkMerchantUser($fkMerchantUsers, Criteria::IN);
    }

    /**
     * Filter the query on the fk_merchant_user column
     *
     * Example usage:
     * <code>
     * $query->filterByFkMerchantUser(1234); // WHERE fk_merchant_user = 1234
     * $query->filterByFkMerchantUser(array(12, 34), Criteria::IN); // WHERE fk_merchant_user IN (12, 34)
     * $query->filterByFkMerchantUser(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_merchant_user > 12
     * </code>
     *
     * @see       filterBySpyMerchantUser()
     *
     * @param     mixed $fkMerchantUser The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkMerchantUser($fkMerchantUser = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkMerchantUser)) {
            $useMinMax = false;
            if (isset($fkMerchantUser['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyAclEntitySegmentMerchantUserTableMap::COL_FK_MERCHANT_USER, $fkMerchantUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkMerchantUser['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyAclEntitySegmentMerchantUserTableMap::COL_FK_MERCHANT_USER, $fkMerchantUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkMerchantUser of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyAclEntitySegmentMerchantUserTableMap::COL_FK_MERCHANT_USER, $fkMerchantUser, $comparison);

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
                $this->addUsingAlias(SpyAclEntitySegmentMerchantUserTableMap::COL_FK_ACL_ENTITY_SEGMENT, $fkAclEntitySegment['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkAclEntitySegment['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyAclEntitySegmentMerchantUserTableMap::COL_FK_ACL_ENTITY_SEGMENT, $fkAclEntitySegment['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkAclEntitySegment of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyAclEntitySegmentMerchantUserTableMap::COL_FK_ACL_ENTITY_SEGMENT, $fkAclEntitySegment, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\MerchantUser\Persistence\SpyMerchantUser object
     *
     * @param \Orm\Zed\MerchantUser\Persistence\SpyMerchantUser|ObjectCollection $spyMerchantUser The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyMerchantUser($spyMerchantUser, ?string $comparison = null)
    {
        if ($spyMerchantUser instanceof \Orm\Zed\MerchantUser\Persistence\SpyMerchantUser) {
            return $this
                ->addUsingAlias(SpyAclEntitySegmentMerchantUserTableMap::COL_FK_MERCHANT_USER, $spyMerchantUser->getIdMerchantUser(), $comparison);
        } elseif ($spyMerchantUser instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyAclEntitySegmentMerchantUserTableMap::COL_FK_MERCHANT_USER, $spyMerchantUser->toKeyValue('PrimaryKey', 'IdMerchantUser'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyMerchantUser() only accepts arguments of type \Orm\Zed\MerchantUser\Persistence\SpyMerchantUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyMerchantUser relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyMerchantUser(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyMerchantUser');

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
            $this->addJoinObject($join, 'SpyMerchantUser');
        }

        return $this;
    }

    /**
     * Use the SpyMerchantUser relation SpyMerchantUser object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MerchantUser\Persistence\SpyMerchantUserQuery A secondary query class using the current class as primary query
     */
    public function useSpyMerchantUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyMerchantUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyMerchantUser', '\Orm\Zed\MerchantUser\Persistence\SpyMerchantUserQuery');
    }

    /**
     * Use the SpyMerchantUser relation SpyMerchantUser object
     *
     * @param callable(\Orm\Zed\MerchantUser\Persistence\SpyMerchantUserQuery):\Orm\Zed\MerchantUser\Persistence\SpyMerchantUserQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyMerchantUserQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyMerchantUserQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyMerchantUser table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MerchantUser\Persistence\SpyMerchantUserQuery The inner query object of the EXISTS statement
     */
    public function useSpyMerchantUserExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MerchantUser\Persistence\SpyMerchantUserQuery */
        $q = $this->useExistsQuery('SpyMerchantUser', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantUser table for a NOT EXISTS query.
     *
     * @see useSpyMerchantUserExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantUser\Persistence\SpyMerchantUserQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyMerchantUserNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantUser\Persistence\SpyMerchantUserQuery */
        $q = $this->useExistsQuery('SpyMerchantUser', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyMerchantUser table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MerchantUser\Persistence\SpyMerchantUserQuery The inner query object of the IN statement
     */
    public function useInSpyMerchantUserQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MerchantUser\Persistence\SpyMerchantUserQuery */
        $q = $this->useInQuery('SpyMerchantUser', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantUser table for a NOT IN query.
     *
     * @see useSpyMerchantUserInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantUser\Persistence\SpyMerchantUserQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyMerchantUserQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantUser\Persistence\SpyMerchantUserQuery */
        $q = $this->useInQuery('SpyMerchantUser', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(SpyAclEntitySegmentMerchantUserTableMap::COL_FK_ACL_ENTITY_SEGMENT, $spyAclEntitySegment->getIdAclEntitySegment(), $comparison);
        } elseif ($spyAclEntitySegment instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyAclEntitySegmentMerchantUserTableMap::COL_FK_ACL_ENTITY_SEGMENT, $spyAclEntitySegment->toKeyValue('PrimaryKey', 'IdAclEntitySegment'), $comparison);

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
    public function joinSpyAclEntitySegment(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function useSpyAclEntitySegmentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
     * @param ChildSpyAclEntitySegmentMerchantUser $spyAclEntitySegmentMerchantUser Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyAclEntitySegmentMerchantUser = null)
    {
        if ($spyAclEntitySegmentMerchantUser) {
            $this->addUsingAlias(SpyAclEntitySegmentMerchantUserTableMap::COL_ID_ACL_ENTITY_SEGMENT_MERCHANT_USER, $spyAclEntitySegmentMerchantUser->getIdAclEntitySegmentMerchantUser(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_acl_entity_segment_merchant_user table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyAclEntitySegmentMerchantUserTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyAclEntitySegmentMerchantUserTableMap::clearInstancePool();
            SpyAclEntitySegmentMerchantUserTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyAclEntitySegmentMerchantUserTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyAclEntitySegmentMerchantUserTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyAclEntitySegmentMerchantUserTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyAclEntitySegmentMerchantUserTableMap::clearRelatedInstancePool();

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
