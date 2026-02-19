<?php

namespace Orm\Zed\Merchant\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\AclEntity\Persistence\SpyAclEntitySegment;
use Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchant as ChildSpyAclEntitySegmentMerchant;
use Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchantQuery as ChildSpyAclEntitySegmentMerchantQuery;
use Orm\Zed\Merchant\Persistence\Map\SpyAclEntitySegmentMerchantTableMap;
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
 * Base class that represents a query for the `spy_acl_entity_segment_merchant` table.
 *
 * @method     ChildSpyAclEntitySegmentMerchantQuery orderByIdAclEntitySegmentMerchant($order = Criteria::ASC) Order by the id_acl_entity_segment_merchant column
 * @method     ChildSpyAclEntitySegmentMerchantQuery orderByFkMerchant($order = Criteria::ASC) Order by the fk_merchant column
 * @method     ChildSpyAclEntitySegmentMerchantQuery orderByFkAclEntitySegment($order = Criteria::ASC) Order by the fk_acl_entity_segment column
 *
 * @method     ChildSpyAclEntitySegmentMerchantQuery groupByIdAclEntitySegmentMerchant() Group by the id_acl_entity_segment_merchant column
 * @method     ChildSpyAclEntitySegmentMerchantQuery groupByFkMerchant() Group by the fk_merchant column
 * @method     ChildSpyAclEntitySegmentMerchantQuery groupByFkAclEntitySegment() Group by the fk_acl_entity_segment column
 *
 * @method     ChildSpyAclEntitySegmentMerchantQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyAclEntitySegmentMerchantQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyAclEntitySegmentMerchantQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyAclEntitySegmentMerchantQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyAclEntitySegmentMerchantQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyAclEntitySegmentMerchantQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyAclEntitySegmentMerchantQuery leftJoinSpyMerchant($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchant relation
 * @method     ChildSpyAclEntitySegmentMerchantQuery rightJoinSpyMerchant($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchant relation
 * @method     ChildSpyAclEntitySegmentMerchantQuery innerJoinSpyMerchant($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchant relation
 *
 * @method     ChildSpyAclEntitySegmentMerchantQuery joinWithSpyMerchant($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchant relation
 *
 * @method     ChildSpyAclEntitySegmentMerchantQuery leftJoinWithSpyMerchant() Adds a LEFT JOIN clause and with to the query using the SpyMerchant relation
 * @method     ChildSpyAclEntitySegmentMerchantQuery rightJoinWithSpyMerchant() Adds a RIGHT JOIN clause and with to the query using the SpyMerchant relation
 * @method     ChildSpyAclEntitySegmentMerchantQuery innerJoinWithSpyMerchant() Adds a INNER JOIN clause and with to the query using the SpyMerchant relation
 *
 * @method     ChildSpyAclEntitySegmentMerchantQuery leftJoinSpyAclEntitySegment($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyAclEntitySegment relation
 * @method     ChildSpyAclEntitySegmentMerchantQuery rightJoinSpyAclEntitySegment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyAclEntitySegment relation
 * @method     ChildSpyAclEntitySegmentMerchantQuery innerJoinSpyAclEntitySegment($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyAclEntitySegment relation
 *
 * @method     ChildSpyAclEntitySegmentMerchantQuery joinWithSpyAclEntitySegment($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyAclEntitySegment relation
 *
 * @method     ChildSpyAclEntitySegmentMerchantQuery leftJoinWithSpyAclEntitySegment() Adds a LEFT JOIN clause and with to the query using the SpyAclEntitySegment relation
 * @method     ChildSpyAclEntitySegmentMerchantQuery rightJoinWithSpyAclEntitySegment() Adds a RIGHT JOIN clause and with to the query using the SpyAclEntitySegment relation
 * @method     ChildSpyAclEntitySegmentMerchantQuery innerJoinWithSpyAclEntitySegment() Adds a INNER JOIN clause and with to the query using the SpyAclEntitySegment relation
 *
 * @method     \Orm\Zed\Merchant\Persistence\SpyMerchantQuery|\Orm\Zed\AclEntity\Persistence\SpyAclEntitySegmentQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyAclEntitySegmentMerchant|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyAclEntitySegmentMerchant matching the query
 * @method     ChildSpyAclEntitySegmentMerchant findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyAclEntitySegmentMerchant matching the query, or a new ChildSpyAclEntitySegmentMerchant object populated from the query conditions when no match is found
 *
 * @method     ChildSpyAclEntitySegmentMerchant|null findOneByIdAclEntitySegmentMerchant(int $id_acl_entity_segment_merchant) Return the first ChildSpyAclEntitySegmentMerchant filtered by the id_acl_entity_segment_merchant column
 * @method     ChildSpyAclEntitySegmentMerchant|null findOneByFkMerchant(int $fk_merchant) Return the first ChildSpyAclEntitySegmentMerchant filtered by the fk_merchant column
 * @method     ChildSpyAclEntitySegmentMerchant|null findOneByFkAclEntitySegment(int $fk_acl_entity_segment) Return the first ChildSpyAclEntitySegmentMerchant filtered by the fk_acl_entity_segment column
 *
 * @method     ChildSpyAclEntitySegmentMerchant requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyAclEntitySegmentMerchant by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyAclEntitySegmentMerchant requireOne(?ConnectionInterface $con = null) Return the first ChildSpyAclEntitySegmentMerchant matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyAclEntitySegmentMerchant requireOneByIdAclEntitySegmentMerchant(int $id_acl_entity_segment_merchant) Return the first ChildSpyAclEntitySegmentMerchant filtered by the id_acl_entity_segment_merchant column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyAclEntitySegmentMerchant requireOneByFkMerchant(int $fk_merchant) Return the first ChildSpyAclEntitySegmentMerchant filtered by the fk_merchant column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyAclEntitySegmentMerchant requireOneByFkAclEntitySegment(int $fk_acl_entity_segment) Return the first ChildSpyAclEntitySegmentMerchant filtered by the fk_acl_entity_segment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyAclEntitySegmentMerchant[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyAclEntitySegmentMerchant objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyAclEntitySegmentMerchant> find(?ConnectionInterface $con = null) Return ChildSpyAclEntitySegmentMerchant objects based on current ModelCriteria
 *
 * @method     ChildSpyAclEntitySegmentMerchant[]|Collection findByIdAclEntitySegmentMerchant(int|array<int> $id_acl_entity_segment_merchant) Return ChildSpyAclEntitySegmentMerchant objects filtered by the id_acl_entity_segment_merchant column
 * @psalm-method Collection&\Traversable<ChildSpyAclEntitySegmentMerchant> findByIdAclEntitySegmentMerchant(int|array<int> $id_acl_entity_segment_merchant) Return ChildSpyAclEntitySegmentMerchant objects filtered by the id_acl_entity_segment_merchant column
 * @method     ChildSpyAclEntitySegmentMerchant[]|Collection findByFkMerchant(int|array<int> $fk_merchant) Return ChildSpyAclEntitySegmentMerchant objects filtered by the fk_merchant column
 * @psalm-method Collection&\Traversable<ChildSpyAclEntitySegmentMerchant> findByFkMerchant(int|array<int> $fk_merchant) Return ChildSpyAclEntitySegmentMerchant objects filtered by the fk_merchant column
 * @method     ChildSpyAclEntitySegmentMerchant[]|Collection findByFkAclEntitySegment(int|array<int> $fk_acl_entity_segment) Return ChildSpyAclEntitySegmentMerchant objects filtered by the fk_acl_entity_segment column
 * @psalm-method Collection&\Traversable<ChildSpyAclEntitySegmentMerchant> findByFkAclEntitySegment(int|array<int> $fk_acl_entity_segment) Return ChildSpyAclEntitySegmentMerchant objects filtered by the fk_acl_entity_segment column
 *
 * @method     ChildSpyAclEntitySegmentMerchant[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyAclEntitySegmentMerchant> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyAclEntitySegmentMerchantQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\Merchant\Persistence\Base\SpyAclEntitySegmentMerchantQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\Merchant\\Persistence\\SpyAclEntitySegmentMerchant', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyAclEntitySegmentMerchantQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyAclEntitySegmentMerchantQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyAclEntitySegmentMerchantQuery) {
            return $criteria;
        }
        $query = new ChildSpyAclEntitySegmentMerchantQuery();
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
     * @return ChildSpyAclEntitySegmentMerchant|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyAclEntitySegmentMerchantTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyAclEntitySegmentMerchant A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_acl_entity_segment_merchant, fk_merchant, fk_acl_entity_segment FROM spy_acl_entity_segment_merchant WHERE id_acl_entity_segment_merchant = :p0';
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
            /** @var ChildSpyAclEntitySegmentMerchant $obj */
            $obj = new ChildSpyAclEntitySegmentMerchant();
            $obj->hydrate($row);
            SpyAclEntitySegmentMerchantTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyAclEntitySegmentMerchant|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyAclEntitySegmentMerchantTableMap::COL_ID_ACL_ENTITY_SEGMENT_MERCHANT, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyAclEntitySegmentMerchantTableMap::COL_ID_ACL_ENTITY_SEGMENT_MERCHANT, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idAclEntitySegmentMerchant Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdAclEntitySegmentMerchant_Between(array $idAclEntitySegmentMerchant)
    {
        return $this->filterByIdAclEntitySegmentMerchant($idAclEntitySegmentMerchant, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idAclEntitySegmentMerchants Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdAclEntitySegmentMerchant_In(array $idAclEntitySegmentMerchants)
    {
        return $this->filterByIdAclEntitySegmentMerchant($idAclEntitySegmentMerchants, Criteria::IN);
    }

    /**
     * Filter the query on the id_acl_entity_segment_merchant column
     *
     * Example usage:
     * <code>
     * $query->filterByIdAclEntitySegmentMerchant(1234); // WHERE id_acl_entity_segment_merchant = 1234
     * $query->filterByIdAclEntitySegmentMerchant(array(12, 34), Criteria::IN); // WHERE id_acl_entity_segment_merchant IN (12, 34)
     * $query->filterByIdAclEntitySegmentMerchant(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_acl_entity_segment_merchant > 12
     * </code>
     *
     * @param     mixed $idAclEntitySegmentMerchant The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdAclEntitySegmentMerchant($idAclEntitySegmentMerchant = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idAclEntitySegmentMerchant)) {
            $useMinMax = false;
            if (isset($idAclEntitySegmentMerchant['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyAclEntitySegmentMerchantTableMap::COL_ID_ACL_ENTITY_SEGMENT_MERCHANT, $idAclEntitySegmentMerchant['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idAclEntitySegmentMerchant['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyAclEntitySegmentMerchantTableMap::COL_ID_ACL_ENTITY_SEGMENT_MERCHANT, $idAclEntitySegmentMerchant['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idAclEntitySegmentMerchant of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyAclEntitySegmentMerchantTableMap::COL_ID_ACL_ENTITY_SEGMENT_MERCHANT, $idAclEntitySegmentMerchant, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkMerchant Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkMerchant_Between(array $fkMerchant)
    {
        return $this->filterByFkMerchant($fkMerchant, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkMerchants Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkMerchant_In(array $fkMerchants)
    {
        return $this->filterByFkMerchant($fkMerchants, Criteria::IN);
    }

    /**
     * Filter the query on the fk_merchant column
     *
     * Example usage:
     * <code>
     * $query->filterByFkMerchant(1234); // WHERE fk_merchant = 1234
     * $query->filterByFkMerchant(array(12, 34), Criteria::IN); // WHERE fk_merchant IN (12, 34)
     * $query->filterByFkMerchant(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_merchant > 12
     * </code>
     *
     * @see       filterBySpyMerchant()
     *
     * @param     mixed $fkMerchant The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkMerchant($fkMerchant = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkMerchant)) {
            $useMinMax = false;
            if (isset($fkMerchant['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyAclEntitySegmentMerchantTableMap::COL_FK_MERCHANT, $fkMerchant['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkMerchant['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyAclEntitySegmentMerchantTableMap::COL_FK_MERCHANT, $fkMerchant['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkMerchant of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyAclEntitySegmentMerchantTableMap::COL_FK_MERCHANT, $fkMerchant, $comparison);

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
                $this->addUsingAlias(SpyAclEntitySegmentMerchantTableMap::COL_FK_ACL_ENTITY_SEGMENT, $fkAclEntitySegment['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkAclEntitySegment['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyAclEntitySegmentMerchantTableMap::COL_FK_ACL_ENTITY_SEGMENT, $fkAclEntitySegment['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkAclEntitySegment of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyAclEntitySegmentMerchantTableMap::COL_FK_ACL_ENTITY_SEGMENT, $fkAclEntitySegment, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Merchant\Persistence\SpyMerchant object
     *
     * @param \Orm\Zed\Merchant\Persistence\SpyMerchant|ObjectCollection $spyMerchant The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyMerchant($spyMerchant, ?string $comparison = null)
    {
        if ($spyMerchant instanceof \Orm\Zed\Merchant\Persistence\SpyMerchant) {
            return $this
                ->addUsingAlias(SpyAclEntitySegmentMerchantTableMap::COL_FK_MERCHANT, $spyMerchant->getIdMerchant(), $comparison);
        } elseif ($spyMerchant instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyAclEntitySegmentMerchantTableMap::COL_FK_MERCHANT, $spyMerchant->toKeyValue('PrimaryKey', 'IdMerchant'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyMerchant() only accepts arguments of type \Orm\Zed\Merchant\Persistence\SpyMerchant or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyMerchant relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyMerchant(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyMerchant');

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
            $this->addJoinObject($join, 'SpyMerchant');
        }

        return $this;
    }

    /**
     * Use the SpyMerchant relation SpyMerchant object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchantQuery A secondary query class using the current class as primary query
     */
    public function useSpyMerchantQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyMerchant($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyMerchant', '\Orm\Zed\Merchant\Persistence\SpyMerchantQuery');
    }

    /**
     * Use the SpyMerchant relation SpyMerchant object
     *
     * @param callable(\Orm\Zed\Merchant\Persistence\SpyMerchantQuery):\Orm\Zed\Merchant\Persistence\SpyMerchantQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyMerchantQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyMerchantQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyMerchant table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchantQuery The inner query object of the EXISTS statement
     */
    public function useSpyMerchantExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Merchant\Persistence\SpyMerchantQuery */
        $q = $this->useExistsQuery('SpyMerchant', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyMerchant table for a NOT EXISTS query.
     *
     * @see useSpyMerchantExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchantQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyMerchantNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Merchant\Persistence\SpyMerchantQuery */
        $q = $this->useExistsQuery('SpyMerchant', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyMerchant table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchantQuery The inner query object of the IN statement
     */
    public function useInSpyMerchantQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Merchant\Persistence\SpyMerchantQuery */
        $q = $this->useInQuery('SpyMerchant', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyMerchant table for a NOT IN query.
     *
     * @see useSpyMerchantInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchantQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyMerchantQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Merchant\Persistence\SpyMerchantQuery */
        $q = $this->useInQuery('SpyMerchant', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(SpyAclEntitySegmentMerchantTableMap::COL_FK_ACL_ENTITY_SEGMENT, $spyAclEntitySegment->getIdAclEntitySegment(), $comparison);
        } elseif ($spyAclEntitySegment instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyAclEntitySegmentMerchantTableMap::COL_FK_ACL_ENTITY_SEGMENT, $spyAclEntitySegment->toKeyValue('PrimaryKey', 'IdAclEntitySegment'), $comparison);

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
     * @param ChildSpyAclEntitySegmentMerchant $spyAclEntitySegmentMerchant Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyAclEntitySegmentMerchant = null)
    {
        if ($spyAclEntitySegmentMerchant) {
            $this->addUsingAlias(SpyAclEntitySegmentMerchantTableMap::COL_ID_ACL_ENTITY_SEGMENT_MERCHANT, $spyAclEntitySegmentMerchant->getIdAclEntitySegmentMerchant(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_acl_entity_segment_merchant table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyAclEntitySegmentMerchantTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyAclEntitySegmentMerchantTableMap::clearInstancePool();
            SpyAclEntitySegmentMerchantTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyAclEntitySegmentMerchantTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyAclEntitySegmentMerchantTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyAclEntitySegmentMerchantTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyAclEntitySegmentMerchantTableMap::clearRelatedInstancePool();

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
