<?php

namespace Orm\Zed\StateMachine\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\StateMachine\Persistence\SpyStateMachineEventTimeout as ChildSpyStateMachineEventTimeout;
use Orm\Zed\StateMachine\Persistence\SpyStateMachineEventTimeoutQuery as ChildSpyStateMachineEventTimeoutQuery;
use Orm\Zed\StateMachine\Persistence\Map\SpyStateMachineEventTimeoutTableMap;
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
 * Base class that represents a query for the `spy_state_machine_event_timeout` table.
 *
 * @method     ChildSpyStateMachineEventTimeoutQuery orderByIdStateMachineEventTimeout($order = Criteria::ASC) Order by the id_state_machine_event_timeout column
 * @method     ChildSpyStateMachineEventTimeoutQuery orderByFkStateMachineItemState($order = Criteria::ASC) Order by the fk_state_machine_item_state column
 * @method     ChildSpyStateMachineEventTimeoutQuery orderByFkStateMachineProcess($order = Criteria::ASC) Order by the fk_state_machine_process column
 * @method     ChildSpyStateMachineEventTimeoutQuery orderByEvent($order = Criteria::ASC) Order by the event column
 * @method     ChildSpyStateMachineEventTimeoutQuery orderByIdentifier($order = Criteria::ASC) Order by the identifier column
 * @method     ChildSpyStateMachineEventTimeoutQuery orderByTimeout($order = Criteria::ASC) Order by the timeout column
 * @method     ChildSpyStateMachineEventTimeoutQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpyStateMachineEventTimeoutQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpyStateMachineEventTimeoutQuery groupByIdStateMachineEventTimeout() Group by the id_state_machine_event_timeout column
 * @method     ChildSpyStateMachineEventTimeoutQuery groupByFkStateMachineItemState() Group by the fk_state_machine_item_state column
 * @method     ChildSpyStateMachineEventTimeoutQuery groupByFkStateMachineProcess() Group by the fk_state_machine_process column
 * @method     ChildSpyStateMachineEventTimeoutQuery groupByEvent() Group by the event column
 * @method     ChildSpyStateMachineEventTimeoutQuery groupByIdentifier() Group by the identifier column
 * @method     ChildSpyStateMachineEventTimeoutQuery groupByTimeout() Group by the timeout column
 * @method     ChildSpyStateMachineEventTimeoutQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpyStateMachineEventTimeoutQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpyStateMachineEventTimeoutQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyStateMachineEventTimeoutQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyStateMachineEventTimeoutQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyStateMachineEventTimeoutQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyStateMachineEventTimeoutQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyStateMachineEventTimeoutQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyStateMachineEventTimeoutQuery leftJoinState($relationAlias = null) Adds a LEFT JOIN clause to the query using the State relation
 * @method     ChildSpyStateMachineEventTimeoutQuery rightJoinState($relationAlias = null) Adds a RIGHT JOIN clause to the query using the State relation
 * @method     ChildSpyStateMachineEventTimeoutQuery innerJoinState($relationAlias = null) Adds a INNER JOIN clause to the query using the State relation
 *
 * @method     ChildSpyStateMachineEventTimeoutQuery joinWithState($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the State relation
 *
 * @method     ChildSpyStateMachineEventTimeoutQuery leftJoinWithState() Adds a LEFT JOIN clause and with to the query using the State relation
 * @method     ChildSpyStateMachineEventTimeoutQuery rightJoinWithState() Adds a RIGHT JOIN clause and with to the query using the State relation
 * @method     ChildSpyStateMachineEventTimeoutQuery innerJoinWithState() Adds a INNER JOIN clause and with to the query using the State relation
 *
 * @method     ChildSpyStateMachineEventTimeoutQuery leftJoinProcess($relationAlias = null) Adds a LEFT JOIN clause to the query using the Process relation
 * @method     ChildSpyStateMachineEventTimeoutQuery rightJoinProcess($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Process relation
 * @method     ChildSpyStateMachineEventTimeoutQuery innerJoinProcess($relationAlias = null) Adds a INNER JOIN clause to the query using the Process relation
 *
 * @method     ChildSpyStateMachineEventTimeoutQuery joinWithProcess($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Process relation
 *
 * @method     ChildSpyStateMachineEventTimeoutQuery leftJoinWithProcess() Adds a LEFT JOIN clause and with to the query using the Process relation
 * @method     ChildSpyStateMachineEventTimeoutQuery rightJoinWithProcess() Adds a RIGHT JOIN clause and with to the query using the Process relation
 * @method     ChildSpyStateMachineEventTimeoutQuery innerJoinWithProcess() Adds a INNER JOIN clause and with to the query using the Process relation
 *
 * @method     \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery|\Orm\Zed\StateMachine\Persistence\SpyStateMachineProcessQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyStateMachineEventTimeout|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyStateMachineEventTimeout matching the query
 * @method     ChildSpyStateMachineEventTimeout findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyStateMachineEventTimeout matching the query, or a new ChildSpyStateMachineEventTimeout object populated from the query conditions when no match is found
 *
 * @method     ChildSpyStateMachineEventTimeout|null findOneByIdStateMachineEventTimeout(int $id_state_machine_event_timeout) Return the first ChildSpyStateMachineEventTimeout filtered by the id_state_machine_event_timeout column
 * @method     ChildSpyStateMachineEventTimeout|null findOneByFkStateMachineItemState(int $fk_state_machine_item_state) Return the first ChildSpyStateMachineEventTimeout filtered by the fk_state_machine_item_state column
 * @method     ChildSpyStateMachineEventTimeout|null findOneByFkStateMachineProcess(int $fk_state_machine_process) Return the first ChildSpyStateMachineEventTimeout filtered by the fk_state_machine_process column
 * @method     ChildSpyStateMachineEventTimeout|null findOneByEvent(string $event) Return the first ChildSpyStateMachineEventTimeout filtered by the event column
 * @method     ChildSpyStateMachineEventTimeout|null findOneByIdentifier(int $identifier) Return the first ChildSpyStateMachineEventTimeout filtered by the identifier column
 * @method     ChildSpyStateMachineEventTimeout|null findOneByTimeout(string $timeout) Return the first ChildSpyStateMachineEventTimeout filtered by the timeout column
 * @method     ChildSpyStateMachineEventTimeout|null findOneByCreatedAt(string $created_at) Return the first ChildSpyStateMachineEventTimeout filtered by the created_at column
 * @method     ChildSpyStateMachineEventTimeout|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpyStateMachineEventTimeout filtered by the updated_at column
 *
 * @method     ChildSpyStateMachineEventTimeout requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyStateMachineEventTimeout by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyStateMachineEventTimeout requireOne(?ConnectionInterface $con = null) Return the first ChildSpyStateMachineEventTimeout matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyStateMachineEventTimeout requireOneByIdStateMachineEventTimeout(int $id_state_machine_event_timeout) Return the first ChildSpyStateMachineEventTimeout filtered by the id_state_machine_event_timeout column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyStateMachineEventTimeout requireOneByFkStateMachineItemState(int $fk_state_machine_item_state) Return the first ChildSpyStateMachineEventTimeout filtered by the fk_state_machine_item_state column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyStateMachineEventTimeout requireOneByFkStateMachineProcess(int $fk_state_machine_process) Return the first ChildSpyStateMachineEventTimeout filtered by the fk_state_machine_process column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyStateMachineEventTimeout requireOneByEvent(string $event) Return the first ChildSpyStateMachineEventTimeout filtered by the event column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyStateMachineEventTimeout requireOneByIdentifier(int $identifier) Return the first ChildSpyStateMachineEventTimeout filtered by the identifier column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyStateMachineEventTimeout requireOneByTimeout(string $timeout) Return the first ChildSpyStateMachineEventTimeout filtered by the timeout column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyStateMachineEventTimeout requireOneByCreatedAt(string $created_at) Return the first ChildSpyStateMachineEventTimeout filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyStateMachineEventTimeout requireOneByUpdatedAt(string $updated_at) Return the first ChildSpyStateMachineEventTimeout filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyStateMachineEventTimeout[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyStateMachineEventTimeout objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyStateMachineEventTimeout> find(?ConnectionInterface $con = null) Return ChildSpyStateMachineEventTimeout objects based on current ModelCriteria
 *
 * @method     ChildSpyStateMachineEventTimeout[]|Collection findByIdStateMachineEventTimeout(int|array<int> $id_state_machine_event_timeout) Return ChildSpyStateMachineEventTimeout objects filtered by the id_state_machine_event_timeout column
 * @psalm-method Collection&\Traversable<ChildSpyStateMachineEventTimeout> findByIdStateMachineEventTimeout(int|array<int> $id_state_machine_event_timeout) Return ChildSpyStateMachineEventTimeout objects filtered by the id_state_machine_event_timeout column
 * @method     ChildSpyStateMachineEventTimeout[]|Collection findByFkStateMachineItemState(int|array<int> $fk_state_machine_item_state) Return ChildSpyStateMachineEventTimeout objects filtered by the fk_state_machine_item_state column
 * @psalm-method Collection&\Traversable<ChildSpyStateMachineEventTimeout> findByFkStateMachineItemState(int|array<int> $fk_state_machine_item_state) Return ChildSpyStateMachineEventTimeout objects filtered by the fk_state_machine_item_state column
 * @method     ChildSpyStateMachineEventTimeout[]|Collection findByFkStateMachineProcess(int|array<int> $fk_state_machine_process) Return ChildSpyStateMachineEventTimeout objects filtered by the fk_state_machine_process column
 * @psalm-method Collection&\Traversable<ChildSpyStateMachineEventTimeout> findByFkStateMachineProcess(int|array<int> $fk_state_machine_process) Return ChildSpyStateMachineEventTimeout objects filtered by the fk_state_machine_process column
 * @method     ChildSpyStateMachineEventTimeout[]|Collection findByEvent(string|array<string> $event) Return ChildSpyStateMachineEventTimeout objects filtered by the event column
 * @psalm-method Collection&\Traversable<ChildSpyStateMachineEventTimeout> findByEvent(string|array<string> $event) Return ChildSpyStateMachineEventTimeout objects filtered by the event column
 * @method     ChildSpyStateMachineEventTimeout[]|Collection findByIdentifier(int|array<int> $identifier) Return ChildSpyStateMachineEventTimeout objects filtered by the identifier column
 * @psalm-method Collection&\Traversable<ChildSpyStateMachineEventTimeout> findByIdentifier(int|array<int> $identifier) Return ChildSpyStateMachineEventTimeout objects filtered by the identifier column
 * @method     ChildSpyStateMachineEventTimeout[]|Collection findByTimeout(string|array<string> $timeout) Return ChildSpyStateMachineEventTimeout objects filtered by the timeout column
 * @psalm-method Collection&\Traversable<ChildSpyStateMachineEventTimeout> findByTimeout(string|array<string> $timeout) Return ChildSpyStateMachineEventTimeout objects filtered by the timeout column
 * @method     ChildSpyStateMachineEventTimeout[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpyStateMachineEventTimeout objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpyStateMachineEventTimeout> findByCreatedAt(string|array<string> $created_at) Return ChildSpyStateMachineEventTimeout objects filtered by the created_at column
 * @method     ChildSpyStateMachineEventTimeout[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyStateMachineEventTimeout objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpyStateMachineEventTimeout> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyStateMachineEventTimeout objects filtered by the updated_at column
 *
 * @method     ChildSpyStateMachineEventTimeout[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyStateMachineEventTimeout> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyStateMachineEventTimeoutQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\StateMachine\Persistence\Base\SpyStateMachineEventTimeoutQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\StateMachine\\Persistence\\SpyStateMachineEventTimeout', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyStateMachineEventTimeoutQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyStateMachineEventTimeoutQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyStateMachineEventTimeoutQuery) {
            return $criteria;
        }
        $query = new ChildSpyStateMachineEventTimeoutQuery();
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
     * @return ChildSpyStateMachineEventTimeout|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyStateMachineEventTimeoutTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyStateMachineEventTimeout A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id_state_machine_event_timeout`, `fk_state_machine_item_state`, `fk_state_machine_process`, `event`, `identifier`, `timeout`, `created_at`, `updated_at` FROM `spy_state_machine_event_timeout` WHERE `id_state_machine_event_timeout` = :p0';
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
            /** @var ChildSpyStateMachineEventTimeout $obj */
            $obj = new ChildSpyStateMachineEventTimeout();
            $obj->hydrate($row);
            SpyStateMachineEventTimeoutTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyStateMachineEventTimeout|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyStateMachineEventTimeoutTableMap::COL_ID_STATE_MACHINE_EVENT_TIMEOUT, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyStateMachineEventTimeoutTableMap::COL_ID_STATE_MACHINE_EVENT_TIMEOUT, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idStateMachineEventTimeout Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdStateMachineEventTimeout_Between(array $idStateMachineEventTimeout)
    {
        return $this->filterByIdStateMachineEventTimeout($idStateMachineEventTimeout, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idStateMachineEventTimeouts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdStateMachineEventTimeout_In(array $idStateMachineEventTimeouts)
    {
        return $this->filterByIdStateMachineEventTimeout($idStateMachineEventTimeouts, Criteria::IN);
    }

    /**
     * Filter the query on the id_state_machine_event_timeout column
     *
     * Example usage:
     * <code>
     * $query->filterByIdStateMachineEventTimeout(1234); // WHERE id_state_machine_event_timeout = 1234
     * $query->filterByIdStateMachineEventTimeout(array(12, 34), Criteria::IN); // WHERE id_state_machine_event_timeout IN (12, 34)
     * $query->filterByIdStateMachineEventTimeout(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_state_machine_event_timeout > 12
     * </code>
     *
     * @param     mixed $idStateMachineEventTimeout The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdStateMachineEventTimeout($idStateMachineEventTimeout = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idStateMachineEventTimeout)) {
            $useMinMax = false;
            if (isset($idStateMachineEventTimeout['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyStateMachineEventTimeoutTableMap::COL_ID_STATE_MACHINE_EVENT_TIMEOUT, $idStateMachineEventTimeout['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idStateMachineEventTimeout['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyStateMachineEventTimeoutTableMap::COL_ID_STATE_MACHINE_EVENT_TIMEOUT, $idStateMachineEventTimeout['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idStateMachineEventTimeout of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyStateMachineEventTimeoutTableMap::COL_ID_STATE_MACHINE_EVENT_TIMEOUT, $idStateMachineEventTimeout, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkStateMachineItemState Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkStateMachineItemState_Between(array $fkStateMachineItemState)
    {
        return $this->filterByFkStateMachineItemState($fkStateMachineItemState, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkStateMachineItemStates Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkStateMachineItemState_In(array $fkStateMachineItemStates)
    {
        return $this->filterByFkStateMachineItemState($fkStateMachineItemStates, Criteria::IN);
    }

    /**
     * Filter the query on the fk_state_machine_item_state column
     *
     * Example usage:
     * <code>
     * $query->filterByFkStateMachineItemState(1234); // WHERE fk_state_machine_item_state = 1234
     * $query->filterByFkStateMachineItemState(array(12, 34), Criteria::IN); // WHERE fk_state_machine_item_state IN (12, 34)
     * $query->filterByFkStateMachineItemState(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_state_machine_item_state > 12
     * </code>
     *
     * @see       filterByState()
     *
     * @param     mixed $fkStateMachineItemState The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkStateMachineItemState($fkStateMachineItemState = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkStateMachineItemState)) {
            $useMinMax = false;
            if (isset($fkStateMachineItemState['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyStateMachineEventTimeoutTableMap::COL_FK_STATE_MACHINE_ITEM_STATE, $fkStateMachineItemState['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkStateMachineItemState['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyStateMachineEventTimeoutTableMap::COL_FK_STATE_MACHINE_ITEM_STATE, $fkStateMachineItemState['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkStateMachineItemState of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyStateMachineEventTimeoutTableMap::COL_FK_STATE_MACHINE_ITEM_STATE, $fkStateMachineItemState, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkStateMachineProcess Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkStateMachineProcess_Between(array $fkStateMachineProcess)
    {
        return $this->filterByFkStateMachineProcess($fkStateMachineProcess, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkStateMachineProcesss Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkStateMachineProcess_In(array $fkStateMachineProcesss)
    {
        return $this->filterByFkStateMachineProcess($fkStateMachineProcesss, Criteria::IN);
    }

    /**
     * Filter the query on the fk_state_machine_process column
     *
     * Example usage:
     * <code>
     * $query->filterByFkStateMachineProcess(1234); // WHERE fk_state_machine_process = 1234
     * $query->filterByFkStateMachineProcess(array(12, 34), Criteria::IN); // WHERE fk_state_machine_process IN (12, 34)
     * $query->filterByFkStateMachineProcess(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_state_machine_process > 12
     * </code>
     *
     * @see       filterByProcess()
     *
     * @param     mixed $fkStateMachineProcess The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkStateMachineProcess($fkStateMachineProcess = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkStateMachineProcess)) {
            $useMinMax = false;
            if (isset($fkStateMachineProcess['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyStateMachineEventTimeoutTableMap::COL_FK_STATE_MACHINE_PROCESS, $fkStateMachineProcess['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkStateMachineProcess['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyStateMachineEventTimeoutTableMap::COL_FK_STATE_MACHINE_PROCESS, $fkStateMachineProcess['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkStateMachineProcess of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyStateMachineEventTimeoutTableMap::COL_FK_STATE_MACHINE_PROCESS, $fkStateMachineProcess, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $events Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEvent_In(array $events)
    {
        return $this->filterByEvent($events, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $event Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEvent_Like($event)
    {
        return $this->filterByEvent($event, Criteria::LIKE);
    }

    /**
     * Filter the query on the event column
     *
     * Example usage:
     * <code>
     * $query->filterByEvent('fooValue');   // WHERE event = 'fooValue'
     * $query->filterByEvent('%fooValue%', Criteria::LIKE); // WHERE event LIKE '%fooValue%'
     * $query->filterByEvent([1, 'foo'], Criteria::IN); // WHERE event IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $event The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByEvent($event = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $event = str_replace('*', '%', $event);
        }

        if (is_array($event) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$event of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyStateMachineEventTimeoutTableMap::COL_EVENT, $event, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $identifier Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdentifier_Between(array $identifier)
    {
        return $this->filterByIdentifier($identifier, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $identifiers Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdentifier_In(array $identifiers)
    {
        return $this->filterByIdentifier($identifiers, Criteria::IN);
    }

    /**
     * Filter the query on the identifier column
     *
     * Example usage:
     * <code>
     * $query->filterByIdentifier(1234); // WHERE identifier = 1234
     * $query->filterByIdentifier(array(12, 34), Criteria::IN); // WHERE identifier IN (12, 34)
     * $query->filterByIdentifier(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE identifier > 12
     * </code>
     *
     * @param     mixed $identifier The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdentifier($identifier = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($identifier)) {
            $useMinMax = false;
            if (isset($identifier['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyStateMachineEventTimeoutTableMap::COL_IDENTIFIER, $identifier['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($identifier['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyStateMachineEventTimeoutTableMap::COL_IDENTIFIER, $identifier['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$identifier of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyStateMachineEventTimeoutTableMap::COL_IDENTIFIER, $identifier, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $timeout Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTimeout_Between(array $timeout)
    {
        return $this->filterByTimeout($timeout, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $timeouts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTimeout_In(array $timeouts)
    {
        return $this->filterByTimeout($timeouts, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $timeout Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTimeout_Like($timeout)
    {
        return $this->filterByTimeout($timeout, Criteria::LIKE);
    }

    /**
     * Filter the query on the timeout column
     *
     * Example usage:
     * <code>
     * $query->filterByTimeout('2011-03-14'); // WHERE timeout = '2011-03-14'
     * $query->filterByTimeout('now'); // WHERE timeout = '2011-03-14'
     * $query->filterByTimeout(array('max' => 'yesterday'), SprykerCriteria::BETWEEN); // WHERE timeout > '2011-03-13'
     * </code>
     *
     * @param     mixed $timeout The value to use as filter.
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
    public function filterByTimeout($timeout = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($timeout)) {
            $useMinMax = false;
            if (isset($timeout['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyStateMachineEventTimeoutTableMap::COL_TIMEOUT, $timeout['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($timeout['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyStateMachineEventTimeoutTableMap::COL_TIMEOUT, $timeout['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$timeout of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyStateMachineEventTimeoutTableMap::COL_TIMEOUT, $timeout, $comparison);

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
                $this->addUsingAlias(SpyStateMachineEventTimeoutTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyStateMachineEventTimeoutTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyStateMachineEventTimeoutTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SpyStateMachineEventTimeoutTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyStateMachineEventTimeoutTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyStateMachineEventTimeoutTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemState object
     *
     * @param \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemState|ObjectCollection $spyStateMachineItemState The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByState($spyStateMachineItemState, ?string $comparison = null)
    {
        if ($spyStateMachineItemState instanceof \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemState) {
            return $this
                ->addUsingAlias(SpyStateMachineEventTimeoutTableMap::COL_FK_STATE_MACHINE_ITEM_STATE, $spyStateMachineItemState->getIdStateMachineItemState(), $comparison);
        } elseif ($spyStateMachineItemState instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyStateMachineEventTimeoutTableMap::COL_FK_STATE_MACHINE_ITEM_STATE, $spyStateMachineItemState->toKeyValue('PrimaryKey', 'IdStateMachineItemState'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByState() only accepts arguments of type \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemState or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the State relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinState(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('State');

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
            $this->addJoinObject($join, 'State');
        }

        return $this;
    }

    /**
     * Use the State relation SpyStateMachineItemState object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery A secondary query class using the current class as primary query
     */
    public function useStateQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinState($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'State', '\Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery');
    }

    /**
     * Use the State relation SpyStateMachineItemState object
     *
     * @param callable(\Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery):\Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withStateQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useStateQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the State relation to the SpyStateMachineItemState table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery The inner query object of the EXISTS statement
     */
    public function useStateExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery */
        $q = $this->useExistsQuery('State', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the State relation to the SpyStateMachineItemState table for a NOT EXISTS query.
     *
     * @see useStateExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery The inner query object of the NOT EXISTS statement
     */
    public function useStateNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery */
        $q = $this->useExistsQuery('State', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the State relation to the SpyStateMachineItemState table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery The inner query object of the IN statement
     */
    public function useInStateQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery */
        $q = $this->useInQuery('State', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the State relation to the SpyStateMachineItemState table for a NOT IN query.
     *
     * @see useStateInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery The inner query object of the NOT IN statement
     */
    public function useNotInStateQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery */
        $q = $this->useInQuery('State', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\StateMachine\Persistence\SpyStateMachineProcess object
     *
     * @param \Orm\Zed\StateMachine\Persistence\SpyStateMachineProcess|ObjectCollection $spyStateMachineProcess The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProcess($spyStateMachineProcess, ?string $comparison = null)
    {
        if ($spyStateMachineProcess instanceof \Orm\Zed\StateMachine\Persistence\SpyStateMachineProcess) {
            return $this
                ->addUsingAlias(SpyStateMachineEventTimeoutTableMap::COL_FK_STATE_MACHINE_PROCESS, $spyStateMachineProcess->getIdStateMachineProcess(), $comparison);
        } elseif ($spyStateMachineProcess instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyStateMachineEventTimeoutTableMap::COL_FK_STATE_MACHINE_PROCESS, $spyStateMachineProcess->toKeyValue('PrimaryKey', 'IdStateMachineProcess'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByProcess() only accepts arguments of type \Orm\Zed\StateMachine\Persistence\SpyStateMachineProcess or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Process relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProcess(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Process');

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
            $this->addJoinObject($join, 'Process');
        }

        return $this;
    }

    /**
     * Use the Process relation SpyStateMachineProcess object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\StateMachine\Persistence\SpyStateMachineProcessQuery A secondary query class using the current class as primary query
     */
    public function useProcessQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProcess($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Process', '\Orm\Zed\StateMachine\Persistence\SpyStateMachineProcessQuery');
    }

    /**
     * Use the Process relation SpyStateMachineProcess object
     *
     * @param callable(\Orm\Zed\StateMachine\Persistence\SpyStateMachineProcessQuery):\Orm\Zed\StateMachine\Persistence\SpyStateMachineProcessQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProcessQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProcessQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the Process relation to the SpyStateMachineProcess table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\StateMachine\Persistence\SpyStateMachineProcessQuery The inner query object of the EXISTS statement
     */
    public function useProcessExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\StateMachine\Persistence\SpyStateMachineProcessQuery */
        $q = $this->useExistsQuery('Process', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the Process relation to the SpyStateMachineProcess table for a NOT EXISTS query.
     *
     * @see useProcessExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\StateMachine\Persistence\SpyStateMachineProcessQuery The inner query object of the NOT EXISTS statement
     */
    public function useProcessNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\StateMachine\Persistence\SpyStateMachineProcessQuery */
        $q = $this->useExistsQuery('Process', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the Process relation to the SpyStateMachineProcess table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\StateMachine\Persistence\SpyStateMachineProcessQuery The inner query object of the IN statement
     */
    public function useInProcessQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\StateMachine\Persistence\SpyStateMachineProcessQuery */
        $q = $this->useInQuery('Process', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the Process relation to the SpyStateMachineProcess table for a NOT IN query.
     *
     * @see useProcessInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\StateMachine\Persistence\SpyStateMachineProcessQuery The inner query object of the NOT IN statement
     */
    public function useNotInProcessQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\StateMachine\Persistence\SpyStateMachineProcessQuery */
        $q = $this->useInQuery('Process', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyStateMachineEventTimeout $spyStateMachineEventTimeout Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyStateMachineEventTimeout = null)
    {
        if ($spyStateMachineEventTimeout) {
            $this->addUsingAlias(SpyStateMachineEventTimeoutTableMap::COL_ID_STATE_MACHINE_EVENT_TIMEOUT, $spyStateMachineEventTimeout->getIdStateMachineEventTimeout(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_state_machine_event_timeout table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyStateMachineEventTimeoutTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyStateMachineEventTimeoutTableMap::clearInstancePool();
            SpyStateMachineEventTimeoutTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyStateMachineEventTimeoutTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyStateMachineEventTimeoutTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyStateMachineEventTimeoutTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyStateMachineEventTimeoutTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(SpyStateMachineEventTimeoutTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyStateMachineEventTimeoutTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyStateMachineEventTimeoutTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyStateMachineEventTimeoutTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpyStateMachineEventTimeoutTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyStateMachineEventTimeoutTableMap::COL_CREATED_AT);

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
