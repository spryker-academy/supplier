<?php

namespace Orm\Zed\Newsletter\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\Newsletter\Persistence\SpyNewsletterSubscription as ChildSpyNewsletterSubscription;
use Orm\Zed\Newsletter\Persistence\SpyNewsletterSubscriptionQuery as ChildSpyNewsletterSubscriptionQuery;
use Orm\Zed\Newsletter\Persistence\Map\SpyNewsletterSubscriptionTableMap;
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
 * Base class that represents a query for the `spy_newsletter_subscription` table.
 *
 * @method     ChildSpyNewsletterSubscriptionQuery orderByFkNewsletterSubscriber($order = Criteria::ASC) Order by the fk_newsletter_subscriber column
 * @method     ChildSpyNewsletterSubscriptionQuery orderByFkNewsletterType($order = Criteria::ASC) Order by the fk_newsletter_type column
 * @method     ChildSpyNewsletterSubscriptionQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpyNewsletterSubscriptionQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpyNewsletterSubscriptionQuery groupByFkNewsletterSubscriber() Group by the fk_newsletter_subscriber column
 * @method     ChildSpyNewsletterSubscriptionQuery groupByFkNewsletterType() Group by the fk_newsletter_type column
 * @method     ChildSpyNewsletterSubscriptionQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpyNewsletterSubscriptionQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpyNewsletterSubscriptionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyNewsletterSubscriptionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyNewsletterSubscriptionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyNewsletterSubscriptionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyNewsletterSubscriptionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyNewsletterSubscriptionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyNewsletterSubscriptionQuery leftJoinSpyNewsletterSubscriber($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyNewsletterSubscriber relation
 * @method     ChildSpyNewsletterSubscriptionQuery rightJoinSpyNewsletterSubscriber($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyNewsletterSubscriber relation
 * @method     ChildSpyNewsletterSubscriptionQuery innerJoinSpyNewsletterSubscriber($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyNewsletterSubscriber relation
 *
 * @method     ChildSpyNewsletterSubscriptionQuery joinWithSpyNewsletterSubscriber($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyNewsletterSubscriber relation
 *
 * @method     ChildSpyNewsletterSubscriptionQuery leftJoinWithSpyNewsletterSubscriber() Adds a LEFT JOIN clause and with to the query using the SpyNewsletterSubscriber relation
 * @method     ChildSpyNewsletterSubscriptionQuery rightJoinWithSpyNewsletterSubscriber() Adds a RIGHT JOIN clause and with to the query using the SpyNewsletterSubscriber relation
 * @method     ChildSpyNewsletterSubscriptionQuery innerJoinWithSpyNewsletterSubscriber() Adds a INNER JOIN clause and with to the query using the SpyNewsletterSubscriber relation
 *
 * @method     ChildSpyNewsletterSubscriptionQuery leftJoinSpyNewsletterType($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyNewsletterType relation
 * @method     ChildSpyNewsletterSubscriptionQuery rightJoinSpyNewsletterType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyNewsletterType relation
 * @method     ChildSpyNewsletterSubscriptionQuery innerJoinSpyNewsletterType($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyNewsletterType relation
 *
 * @method     ChildSpyNewsletterSubscriptionQuery joinWithSpyNewsletterType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyNewsletterType relation
 *
 * @method     ChildSpyNewsletterSubscriptionQuery leftJoinWithSpyNewsletterType() Adds a LEFT JOIN clause and with to the query using the SpyNewsletterType relation
 * @method     ChildSpyNewsletterSubscriptionQuery rightJoinWithSpyNewsletterType() Adds a RIGHT JOIN clause and with to the query using the SpyNewsletterType relation
 * @method     ChildSpyNewsletterSubscriptionQuery innerJoinWithSpyNewsletterType() Adds a INNER JOIN clause and with to the query using the SpyNewsletterType relation
 *
 * @method     \Orm\Zed\Newsletter\Persistence\SpyNewsletterSubscriberQuery|\Orm\Zed\Newsletter\Persistence\SpyNewsletterTypeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyNewsletterSubscription|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyNewsletterSubscription matching the query
 * @method     ChildSpyNewsletterSubscription findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyNewsletterSubscription matching the query, or a new ChildSpyNewsletterSubscription object populated from the query conditions when no match is found
 *
 * @method     ChildSpyNewsletterSubscription|null findOneByFkNewsletterSubscriber(int $fk_newsletter_subscriber) Return the first ChildSpyNewsletterSubscription filtered by the fk_newsletter_subscriber column
 * @method     ChildSpyNewsletterSubscription|null findOneByFkNewsletterType(int $fk_newsletter_type) Return the first ChildSpyNewsletterSubscription filtered by the fk_newsletter_type column
 * @method     ChildSpyNewsletterSubscription|null findOneByCreatedAt(string $created_at) Return the first ChildSpyNewsletterSubscription filtered by the created_at column
 * @method     ChildSpyNewsletterSubscription|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpyNewsletterSubscription filtered by the updated_at column
 *
 * @method     ChildSpyNewsletterSubscription requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyNewsletterSubscription by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyNewsletterSubscription requireOne(?ConnectionInterface $con = null) Return the first ChildSpyNewsletterSubscription matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyNewsletterSubscription requireOneByFkNewsletterSubscriber(int $fk_newsletter_subscriber) Return the first ChildSpyNewsletterSubscription filtered by the fk_newsletter_subscriber column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyNewsletterSubscription requireOneByFkNewsletterType(int $fk_newsletter_type) Return the first ChildSpyNewsletterSubscription filtered by the fk_newsletter_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyNewsletterSubscription requireOneByCreatedAt(string $created_at) Return the first ChildSpyNewsletterSubscription filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyNewsletterSubscription requireOneByUpdatedAt(string $updated_at) Return the first ChildSpyNewsletterSubscription filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyNewsletterSubscription[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyNewsletterSubscription objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyNewsletterSubscription> find(?ConnectionInterface $con = null) Return ChildSpyNewsletterSubscription objects based on current ModelCriteria
 *
 * @method     ChildSpyNewsletterSubscription[]|Collection findByFkNewsletterSubscriber(int|array<int> $fk_newsletter_subscriber) Return ChildSpyNewsletterSubscription objects filtered by the fk_newsletter_subscriber column
 * @psalm-method Collection&\Traversable<ChildSpyNewsletterSubscription> findByFkNewsletterSubscriber(int|array<int> $fk_newsletter_subscriber) Return ChildSpyNewsletterSubscription objects filtered by the fk_newsletter_subscriber column
 * @method     ChildSpyNewsletterSubscription[]|Collection findByFkNewsletterType(int|array<int> $fk_newsletter_type) Return ChildSpyNewsletterSubscription objects filtered by the fk_newsletter_type column
 * @psalm-method Collection&\Traversable<ChildSpyNewsletterSubscription> findByFkNewsletterType(int|array<int> $fk_newsletter_type) Return ChildSpyNewsletterSubscription objects filtered by the fk_newsletter_type column
 * @method     ChildSpyNewsletterSubscription[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpyNewsletterSubscription objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpyNewsletterSubscription> findByCreatedAt(string|array<string> $created_at) Return ChildSpyNewsletterSubscription objects filtered by the created_at column
 * @method     ChildSpyNewsletterSubscription[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyNewsletterSubscription objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpyNewsletterSubscription> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyNewsletterSubscription objects filtered by the updated_at column
 *
 * @method     ChildSpyNewsletterSubscription[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyNewsletterSubscription> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyNewsletterSubscriptionQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\Newsletter\Persistence\Base\SpyNewsletterSubscriptionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\Newsletter\\Persistence\\SpyNewsletterSubscription', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyNewsletterSubscriptionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyNewsletterSubscriptionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyNewsletterSubscriptionQuery) {
            return $criteria;
        }
        $query = new ChildSpyNewsletterSubscriptionQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$fk_newsletter_subscriber, $fk_newsletter_type] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildSpyNewsletterSubscription|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyNewsletterSubscriptionTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildSpyNewsletterSubscription A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `fk_newsletter_subscriber`, `fk_newsletter_type`, `created_at`, `updated_at` FROM `spy_newsletter_subscription` WHERE `fk_newsletter_subscriber` = :p0 AND `fk_newsletter_type` = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildSpyNewsletterSubscription $obj */
            $obj = new ChildSpyNewsletterSubscription();
            $obj->hydrate($row);
            SpyNewsletterSubscriptionTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildSpyNewsletterSubscription|array|mixed the result, formatted by the current formatter
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
        $this->addUsingAlias(SpyNewsletterSubscriptionTableMap::COL_FK_NEWSLETTER_SUBSCRIBER, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(SpyNewsletterSubscriptionTableMap::COL_FK_NEWSLETTER_TYPE, $key[1], Criteria::EQUAL);

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
            $cton0 = $this->getNewCriterion(SpyNewsletterSubscriptionTableMap::COL_FK_NEWSLETTER_SUBSCRIBER, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(SpyNewsletterSubscriptionTableMap::COL_FK_NEWSLETTER_TYPE, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkNewsletterSubscriber Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkNewsletterSubscriber_Between(array $fkNewsletterSubscriber)
    {
        return $this->filterByFkNewsletterSubscriber($fkNewsletterSubscriber, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkNewsletterSubscribers Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkNewsletterSubscriber_In(array $fkNewsletterSubscribers)
    {
        return $this->filterByFkNewsletterSubscriber($fkNewsletterSubscribers, Criteria::IN);
    }

    /**
     * Filter the query on the fk_newsletter_subscriber column
     *
     * Example usage:
     * <code>
     * $query->filterByFkNewsletterSubscriber(1234); // WHERE fk_newsletter_subscriber = 1234
     * $query->filterByFkNewsletterSubscriber(array(12, 34), Criteria::IN); // WHERE fk_newsletter_subscriber IN (12, 34)
     * $query->filterByFkNewsletterSubscriber(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_newsletter_subscriber > 12
     * </code>
     *
     * @see       filterBySpyNewsletterSubscriber()
     *
     * @param     mixed $fkNewsletterSubscriber The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkNewsletterSubscriber($fkNewsletterSubscriber = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkNewsletterSubscriber)) {
            $useMinMax = false;
            if (isset($fkNewsletterSubscriber['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyNewsletterSubscriptionTableMap::COL_FK_NEWSLETTER_SUBSCRIBER, $fkNewsletterSubscriber['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkNewsletterSubscriber['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyNewsletterSubscriptionTableMap::COL_FK_NEWSLETTER_SUBSCRIBER, $fkNewsletterSubscriber['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkNewsletterSubscriber of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyNewsletterSubscriptionTableMap::COL_FK_NEWSLETTER_SUBSCRIBER, $fkNewsletterSubscriber, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkNewsletterType Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkNewsletterType_Between(array $fkNewsletterType)
    {
        return $this->filterByFkNewsletterType($fkNewsletterType, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkNewsletterTypes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkNewsletterType_In(array $fkNewsletterTypes)
    {
        return $this->filterByFkNewsletterType($fkNewsletterTypes, Criteria::IN);
    }

    /**
     * Filter the query on the fk_newsletter_type column
     *
     * Example usage:
     * <code>
     * $query->filterByFkNewsletterType(1234); // WHERE fk_newsletter_type = 1234
     * $query->filterByFkNewsletterType(array(12, 34), Criteria::IN); // WHERE fk_newsletter_type IN (12, 34)
     * $query->filterByFkNewsletterType(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_newsletter_type > 12
     * </code>
     *
     * @see       filterBySpyNewsletterType()
     *
     * @param     mixed $fkNewsletterType The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkNewsletterType($fkNewsletterType = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkNewsletterType)) {
            $useMinMax = false;
            if (isset($fkNewsletterType['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyNewsletterSubscriptionTableMap::COL_FK_NEWSLETTER_TYPE, $fkNewsletterType['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkNewsletterType['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyNewsletterSubscriptionTableMap::COL_FK_NEWSLETTER_TYPE, $fkNewsletterType['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkNewsletterType of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyNewsletterSubscriptionTableMap::COL_FK_NEWSLETTER_TYPE, $fkNewsletterType, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $createdAt Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCreatedAt_Between(array $createdAt)
    {
        return $this->filterByCreatedAt($createdAt, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $createdAts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCreatedAt_In(array $createdAts)
    {
        return $this->filterByCreatedAt($createdAts, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $createdAt Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCreatedAt_Like($createdAt)
    {
        return $this->filterByCreatedAt($createdAt, Criteria::LIKE);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday'), SprykerCriteria::BETWEEN); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByCreatedAt($createdAt = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyNewsletterSubscriptionTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyNewsletterSubscriptionTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyNewsletterSubscriptionTableMap::COL_CREATED_AT, $createdAt, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $updatedAt Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUpdatedAt_Between(array $updatedAt)
    {
        return $this->filterByUpdatedAt($updatedAt, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $updatedAts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUpdatedAt_In(array $updatedAts)
    {
        return $this->filterByUpdatedAt($updatedAts, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $updatedAt Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUpdatedAt_Like($updatedAt)
    {
        return $this->filterByUpdatedAt($updatedAt, Criteria::LIKE);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday'), SprykerCriteria::BETWEEN); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyNewsletterSubscriptionTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyNewsletterSubscriptionTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyNewsletterSubscriptionTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Newsletter\Persistence\SpyNewsletterSubscriber object
     *
     * @param \Orm\Zed\Newsletter\Persistence\SpyNewsletterSubscriber|ObjectCollection $spyNewsletterSubscriber The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyNewsletterSubscriber($spyNewsletterSubscriber, ?string $comparison = null)
    {
        if ($spyNewsletterSubscriber instanceof \Orm\Zed\Newsletter\Persistence\SpyNewsletterSubscriber) {
            return $this
                ->addUsingAlias(SpyNewsletterSubscriptionTableMap::COL_FK_NEWSLETTER_SUBSCRIBER, $spyNewsletterSubscriber->getIdNewsletterSubscriber(), $comparison);
        } elseif ($spyNewsletterSubscriber instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyNewsletterSubscriptionTableMap::COL_FK_NEWSLETTER_SUBSCRIBER, $spyNewsletterSubscriber->toKeyValue('PrimaryKey', 'IdNewsletterSubscriber'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyNewsletterSubscriber() only accepts arguments of type \Orm\Zed\Newsletter\Persistence\SpyNewsletterSubscriber or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyNewsletterSubscriber relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyNewsletterSubscriber(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyNewsletterSubscriber');

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
            $this->addJoinObject($join, 'SpyNewsletterSubscriber');
        }

        return $this;
    }

    /**
     * Use the SpyNewsletterSubscriber relation SpyNewsletterSubscriber object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Newsletter\Persistence\SpyNewsletterSubscriberQuery A secondary query class using the current class as primary query
     */
    public function useSpyNewsletterSubscriberQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyNewsletterSubscriber($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyNewsletterSubscriber', '\Orm\Zed\Newsletter\Persistence\SpyNewsletterSubscriberQuery');
    }

    /**
     * Use the SpyNewsletterSubscriber relation SpyNewsletterSubscriber object
     *
     * @param callable(\Orm\Zed\Newsletter\Persistence\SpyNewsletterSubscriberQuery):\Orm\Zed\Newsletter\Persistence\SpyNewsletterSubscriberQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyNewsletterSubscriberQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyNewsletterSubscriberQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyNewsletterSubscriber table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Newsletter\Persistence\SpyNewsletterSubscriberQuery The inner query object of the EXISTS statement
     */
    public function useSpyNewsletterSubscriberExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Newsletter\Persistence\SpyNewsletterSubscriberQuery */
        $q = $this->useExistsQuery('SpyNewsletterSubscriber', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyNewsletterSubscriber table for a NOT EXISTS query.
     *
     * @see useSpyNewsletterSubscriberExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Newsletter\Persistence\SpyNewsletterSubscriberQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyNewsletterSubscriberNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Newsletter\Persistence\SpyNewsletterSubscriberQuery */
        $q = $this->useExistsQuery('SpyNewsletterSubscriber', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyNewsletterSubscriber table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Newsletter\Persistence\SpyNewsletterSubscriberQuery The inner query object of the IN statement
     */
    public function useInSpyNewsletterSubscriberQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Newsletter\Persistence\SpyNewsletterSubscriberQuery */
        $q = $this->useInQuery('SpyNewsletterSubscriber', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyNewsletterSubscriber table for a NOT IN query.
     *
     * @see useSpyNewsletterSubscriberInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Newsletter\Persistence\SpyNewsletterSubscriberQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyNewsletterSubscriberQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Newsletter\Persistence\SpyNewsletterSubscriberQuery */
        $q = $this->useInQuery('SpyNewsletterSubscriber', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Newsletter\Persistence\SpyNewsletterType object
     *
     * @param \Orm\Zed\Newsletter\Persistence\SpyNewsletterType|ObjectCollection $spyNewsletterType The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyNewsletterType($spyNewsletterType, ?string $comparison = null)
    {
        if ($spyNewsletterType instanceof \Orm\Zed\Newsletter\Persistence\SpyNewsletterType) {
            return $this
                ->addUsingAlias(SpyNewsletterSubscriptionTableMap::COL_FK_NEWSLETTER_TYPE, $spyNewsletterType->getIdNewsletterType(), $comparison);
        } elseif ($spyNewsletterType instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyNewsletterSubscriptionTableMap::COL_FK_NEWSLETTER_TYPE, $spyNewsletterType->toKeyValue('PrimaryKey', 'IdNewsletterType'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyNewsletterType() only accepts arguments of type \Orm\Zed\Newsletter\Persistence\SpyNewsletterType or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyNewsletterType relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyNewsletterType(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyNewsletterType');

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
            $this->addJoinObject($join, 'SpyNewsletterType');
        }

        return $this;
    }

    /**
     * Use the SpyNewsletterType relation SpyNewsletterType object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Newsletter\Persistence\SpyNewsletterTypeQuery A secondary query class using the current class as primary query
     */
    public function useSpyNewsletterTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyNewsletterType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyNewsletterType', '\Orm\Zed\Newsletter\Persistence\SpyNewsletterTypeQuery');
    }

    /**
     * Use the SpyNewsletterType relation SpyNewsletterType object
     *
     * @param callable(\Orm\Zed\Newsletter\Persistence\SpyNewsletterTypeQuery):\Orm\Zed\Newsletter\Persistence\SpyNewsletterTypeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyNewsletterTypeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyNewsletterTypeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyNewsletterType table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Newsletter\Persistence\SpyNewsletterTypeQuery The inner query object of the EXISTS statement
     */
    public function useSpyNewsletterTypeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Newsletter\Persistence\SpyNewsletterTypeQuery */
        $q = $this->useExistsQuery('SpyNewsletterType', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyNewsletterType table for a NOT EXISTS query.
     *
     * @see useSpyNewsletterTypeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Newsletter\Persistence\SpyNewsletterTypeQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyNewsletterTypeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Newsletter\Persistence\SpyNewsletterTypeQuery */
        $q = $this->useExistsQuery('SpyNewsletterType', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyNewsletterType table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Newsletter\Persistence\SpyNewsletterTypeQuery The inner query object of the IN statement
     */
    public function useInSpyNewsletterTypeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Newsletter\Persistence\SpyNewsletterTypeQuery */
        $q = $this->useInQuery('SpyNewsletterType', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyNewsletterType table for a NOT IN query.
     *
     * @see useSpyNewsletterTypeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Newsletter\Persistence\SpyNewsletterTypeQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyNewsletterTypeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Newsletter\Persistence\SpyNewsletterTypeQuery */
        $q = $this->useInQuery('SpyNewsletterType', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyNewsletterSubscription $spyNewsletterSubscription Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyNewsletterSubscription = null)
    {
        if ($spyNewsletterSubscription) {
            $this->addCond('pruneCond0', $this->getAliasedColName(SpyNewsletterSubscriptionTableMap::COL_FK_NEWSLETTER_SUBSCRIBER), $spyNewsletterSubscription->getFkNewsletterSubscriber(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(SpyNewsletterSubscriptionTableMap::COL_FK_NEWSLETTER_TYPE), $spyNewsletterSubscription->getFkNewsletterType(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
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
     * Deletes all rows from the spy_newsletter_subscription table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyNewsletterSubscriptionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyNewsletterSubscriptionTableMap::clearInstancePool();
            SpyNewsletterSubscriptionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyNewsletterSubscriptionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyNewsletterSubscriptionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyNewsletterSubscriptionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyNewsletterSubscriptionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param int $nbDays Maximum age of the latest update in days
     *
     * @return $this The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        $this->addUsingAlias(SpyNewsletterSubscriptionTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyNewsletterSubscriptionTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyNewsletterSubscriptionTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyNewsletterSubscriptionTableMap::COL_CREATED_AT);

        return $this;
    }

    /**
     * Filter by the latest created
     *
     * @param int $nbDays Maximum age of in days
     *
     * @return $this The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        $this->addUsingAlias(SpyNewsletterSubscriptionTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyNewsletterSubscriptionTableMap::COL_CREATED_AT);

        return $this;
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
