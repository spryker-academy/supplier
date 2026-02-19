<?php

namespace Orm\Zed\StateMachine\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\StateMachine\Persistence\SpyStateMachineTransitionLog as ChildSpyStateMachineTransitionLog;
use Orm\Zed\StateMachine\Persistence\SpyStateMachineTransitionLogQuery as ChildSpyStateMachineTransitionLogQuery;
use Orm\Zed\StateMachine\Persistence\Map\SpyStateMachineTransitionLogTableMap;
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
 * Base class that represents a query for the `spy_state_machine_transition_log` table.
 *
 * @method     ChildSpyStateMachineTransitionLogQuery orderByIdStateMachineTransitionLog($order = Criteria::ASC) Order by the id_state_machine_transition_log column
 * @method     ChildSpyStateMachineTransitionLogQuery orderByFkStateMachineProcess($order = Criteria::ASC) Order by the fk_state_machine_process column
 * @method     ChildSpyStateMachineTransitionLogQuery orderByCommand($order = Criteria::ASC) Order by the command column
 * @method     ChildSpyStateMachineTransitionLogQuery orderByCondition($order = Criteria::ASC) Order by the condition column
 * @method     ChildSpyStateMachineTransitionLogQuery orderByErrorMessage($order = Criteria::ASC) Order by the error_message column
 * @method     ChildSpyStateMachineTransitionLogQuery orderByEvent($order = Criteria::ASC) Order by the event column
 * @method     ChildSpyStateMachineTransitionLogQuery orderByHostname($order = Criteria::ASC) Order by the hostname column
 * @method     ChildSpyStateMachineTransitionLogQuery orderByIdentifier($order = Criteria::ASC) Order by the identifier column
 * @method     ChildSpyStateMachineTransitionLogQuery orderByIsError($order = Criteria::ASC) Order by the is_error column
 * @method     ChildSpyStateMachineTransitionLogQuery orderByLocked($order = Criteria::ASC) Order by the locked column
 * @method     ChildSpyStateMachineTransitionLogQuery orderByParams($order = Criteria::ASC) Order by the params column
 * @method     ChildSpyStateMachineTransitionLogQuery orderByPath($order = Criteria::ASC) Order by the path column
 * @method     ChildSpyStateMachineTransitionLogQuery orderBySourceState($order = Criteria::ASC) Order by the source_state column
 * @method     ChildSpyStateMachineTransitionLogQuery orderByTargetState($order = Criteria::ASC) Order by the target_state column
 * @method     ChildSpyStateMachineTransitionLogQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 *
 * @method     ChildSpyStateMachineTransitionLogQuery groupByIdStateMachineTransitionLog() Group by the id_state_machine_transition_log column
 * @method     ChildSpyStateMachineTransitionLogQuery groupByFkStateMachineProcess() Group by the fk_state_machine_process column
 * @method     ChildSpyStateMachineTransitionLogQuery groupByCommand() Group by the command column
 * @method     ChildSpyStateMachineTransitionLogQuery groupByCondition() Group by the condition column
 * @method     ChildSpyStateMachineTransitionLogQuery groupByErrorMessage() Group by the error_message column
 * @method     ChildSpyStateMachineTransitionLogQuery groupByEvent() Group by the event column
 * @method     ChildSpyStateMachineTransitionLogQuery groupByHostname() Group by the hostname column
 * @method     ChildSpyStateMachineTransitionLogQuery groupByIdentifier() Group by the identifier column
 * @method     ChildSpyStateMachineTransitionLogQuery groupByIsError() Group by the is_error column
 * @method     ChildSpyStateMachineTransitionLogQuery groupByLocked() Group by the locked column
 * @method     ChildSpyStateMachineTransitionLogQuery groupByParams() Group by the params column
 * @method     ChildSpyStateMachineTransitionLogQuery groupByPath() Group by the path column
 * @method     ChildSpyStateMachineTransitionLogQuery groupBySourceState() Group by the source_state column
 * @method     ChildSpyStateMachineTransitionLogQuery groupByTargetState() Group by the target_state column
 * @method     ChildSpyStateMachineTransitionLogQuery groupByCreatedAt() Group by the created_at column
 *
 * @method     ChildSpyStateMachineTransitionLogQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyStateMachineTransitionLogQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyStateMachineTransitionLogQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyStateMachineTransitionLogQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyStateMachineTransitionLogQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyStateMachineTransitionLogQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyStateMachineTransitionLogQuery leftJoinProcess($relationAlias = null) Adds a LEFT JOIN clause to the query using the Process relation
 * @method     ChildSpyStateMachineTransitionLogQuery rightJoinProcess($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Process relation
 * @method     ChildSpyStateMachineTransitionLogQuery innerJoinProcess($relationAlias = null) Adds a INNER JOIN clause to the query using the Process relation
 *
 * @method     ChildSpyStateMachineTransitionLogQuery joinWithProcess($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Process relation
 *
 * @method     ChildSpyStateMachineTransitionLogQuery leftJoinWithProcess() Adds a LEFT JOIN clause and with to the query using the Process relation
 * @method     ChildSpyStateMachineTransitionLogQuery rightJoinWithProcess() Adds a RIGHT JOIN clause and with to the query using the Process relation
 * @method     ChildSpyStateMachineTransitionLogQuery innerJoinWithProcess() Adds a INNER JOIN clause and with to the query using the Process relation
 *
 * @method     \Orm\Zed\StateMachine\Persistence\SpyStateMachineProcessQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyStateMachineTransitionLog|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyStateMachineTransitionLog matching the query
 * @method     ChildSpyStateMachineTransitionLog findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyStateMachineTransitionLog matching the query, or a new ChildSpyStateMachineTransitionLog object populated from the query conditions when no match is found
 *
 * @method     ChildSpyStateMachineTransitionLog|null findOneByIdStateMachineTransitionLog(int $id_state_machine_transition_log) Return the first ChildSpyStateMachineTransitionLog filtered by the id_state_machine_transition_log column
 * @method     ChildSpyStateMachineTransitionLog|null findOneByFkStateMachineProcess(int $fk_state_machine_process) Return the first ChildSpyStateMachineTransitionLog filtered by the fk_state_machine_process column
 * @method     ChildSpyStateMachineTransitionLog|null findOneByCommand(string $command) Return the first ChildSpyStateMachineTransitionLog filtered by the command column
 * @method     ChildSpyStateMachineTransitionLog|null findOneByCondition(string $condition) Return the first ChildSpyStateMachineTransitionLog filtered by the condition column
 * @method     ChildSpyStateMachineTransitionLog|null findOneByErrorMessage(string $error_message) Return the first ChildSpyStateMachineTransitionLog filtered by the error_message column
 * @method     ChildSpyStateMachineTransitionLog|null findOneByEvent(string $event) Return the first ChildSpyStateMachineTransitionLog filtered by the event column
 * @method     ChildSpyStateMachineTransitionLog|null findOneByHostname(string $hostname) Return the first ChildSpyStateMachineTransitionLog filtered by the hostname column
 * @method     ChildSpyStateMachineTransitionLog|null findOneByIdentifier(int $identifier) Return the first ChildSpyStateMachineTransitionLog filtered by the identifier column
 * @method     ChildSpyStateMachineTransitionLog|null findOneByIsError(boolean $is_error) Return the first ChildSpyStateMachineTransitionLog filtered by the is_error column
 * @method     ChildSpyStateMachineTransitionLog|null findOneByLocked(boolean $locked) Return the first ChildSpyStateMachineTransitionLog filtered by the locked column
 * @method     ChildSpyStateMachineTransitionLog|null findOneByParams(array $params) Return the first ChildSpyStateMachineTransitionLog filtered by the params column
 * @method     ChildSpyStateMachineTransitionLog|null findOneByPath(string $path) Return the first ChildSpyStateMachineTransitionLog filtered by the path column
 * @method     ChildSpyStateMachineTransitionLog|null findOneBySourceState(string $source_state) Return the first ChildSpyStateMachineTransitionLog filtered by the source_state column
 * @method     ChildSpyStateMachineTransitionLog|null findOneByTargetState(string $target_state) Return the first ChildSpyStateMachineTransitionLog filtered by the target_state column
 * @method     ChildSpyStateMachineTransitionLog|null findOneByCreatedAt(string $created_at) Return the first ChildSpyStateMachineTransitionLog filtered by the created_at column
 *
 * @method     ChildSpyStateMachineTransitionLog requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyStateMachineTransitionLog by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyStateMachineTransitionLog requireOne(?ConnectionInterface $con = null) Return the first ChildSpyStateMachineTransitionLog matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyStateMachineTransitionLog requireOneByIdStateMachineTransitionLog(int $id_state_machine_transition_log) Return the first ChildSpyStateMachineTransitionLog filtered by the id_state_machine_transition_log column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyStateMachineTransitionLog requireOneByFkStateMachineProcess(int $fk_state_machine_process) Return the first ChildSpyStateMachineTransitionLog filtered by the fk_state_machine_process column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyStateMachineTransitionLog requireOneByCommand(string $command) Return the first ChildSpyStateMachineTransitionLog filtered by the command column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyStateMachineTransitionLog requireOneByCondition(string $condition) Return the first ChildSpyStateMachineTransitionLog filtered by the condition column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyStateMachineTransitionLog requireOneByErrorMessage(string $error_message) Return the first ChildSpyStateMachineTransitionLog filtered by the error_message column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyStateMachineTransitionLog requireOneByEvent(string $event) Return the first ChildSpyStateMachineTransitionLog filtered by the event column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyStateMachineTransitionLog requireOneByHostname(string $hostname) Return the first ChildSpyStateMachineTransitionLog filtered by the hostname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyStateMachineTransitionLog requireOneByIdentifier(int $identifier) Return the first ChildSpyStateMachineTransitionLog filtered by the identifier column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyStateMachineTransitionLog requireOneByIsError(boolean $is_error) Return the first ChildSpyStateMachineTransitionLog filtered by the is_error column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyStateMachineTransitionLog requireOneByLocked(boolean $locked) Return the first ChildSpyStateMachineTransitionLog filtered by the locked column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyStateMachineTransitionLog requireOneByParams(array $params) Return the first ChildSpyStateMachineTransitionLog filtered by the params column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyStateMachineTransitionLog requireOneByPath(string $path) Return the first ChildSpyStateMachineTransitionLog filtered by the path column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyStateMachineTransitionLog requireOneBySourceState(string $source_state) Return the first ChildSpyStateMachineTransitionLog filtered by the source_state column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyStateMachineTransitionLog requireOneByTargetState(string $target_state) Return the first ChildSpyStateMachineTransitionLog filtered by the target_state column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyStateMachineTransitionLog requireOneByCreatedAt(string $created_at) Return the first ChildSpyStateMachineTransitionLog filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyStateMachineTransitionLog[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyStateMachineTransitionLog objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyStateMachineTransitionLog> find(?ConnectionInterface $con = null) Return ChildSpyStateMachineTransitionLog objects based on current ModelCriteria
 *
 * @method     ChildSpyStateMachineTransitionLog[]|Collection findByIdStateMachineTransitionLog(int|array<int> $id_state_machine_transition_log) Return ChildSpyStateMachineTransitionLog objects filtered by the id_state_machine_transition_log column
 * @psalm-method Collection&\Traversable<ChildSpyStateMachineTransitionLog> findByIdStateMachineTransitionLog(int|array<int> $id_state_machine_transition_log) Return ChildSpyStateMachineTransitionLog objects filtered by the id_state_machine_transition_log column
 * @method     ChildSpyStateMachineTransitionLog[]|Collection findByFkStateMachineProcess(int|array<int> $fk_state_machine_process) Return ChildSpyStateMachineTransitionLog objects filtered by the fk_state_machine_process column
 * @psalm-method Collection&\Traversable<ChildSpyStateMachineTransitionLog> findByFkStateMachineProcess(int|array<int> $fk_state_machine_process) Return ChildSpyStateMachineTransitionLog objects filtered by the fk_state_machine_process column
 * @method     ChildSpyStateMachineTransitionLog[]|Collection findByCommand(string|array<string> $command) Return ChildSpyStateMachineTransitionLog objects filtered by the command column
 * @psalm-method Collection&\Traversable<ChildSpyStateMachineTransitionLog> findByCommand(string|array<string> $command) Return ChildSpyStateMachineTransitionLog objects filtered by the command column
 * @method     ChildSpyStateMachineTransitionLog[]|Collection findByCondition(string|array<string> $condition) Return ChildSpyStateMachineTransitionLog objects filtered by the condition column
 * @psalm-method Collection&\Traversable<ChildSpyStateMachineTransitionLog> findByCondition(string|array<string> $condition) Return ChildSpyStateMachineTransitionLog objects filtered by the condition column
 * @method     ChildSpyStateMachineTransitionLog[]|Collection findByErrorMessage(string|array<string> $error_message) Return ChildSpyStateMachineTransitionLog objects filtered by the error_message column
 * @psalm-method Collection&\Traversable<ChildSpyStateMachineTransitionLog> findByErrorMessage(string|array<string> $error_message) Return ChildSpyStateMachineTransitionLog objects filtered by the error_message column
 * @method     ChildSpyStateMachineTransitionLog[]|Collection findByEvent(string|array<string> $event) Return ChildSpyStateMachineTransitionLog objects filtered by the event column
 * @psalm-method Collection&\Traversable<ChildSpyStateMachineTransitionLog> findByEvent(string|array<string> $event) Return ChildSpyStateMachineTransitionLog objects filtered by the event column
 * @method     ChildSpyStateMachineTransitionLog[]|Collection findByHostname(string|array<string> $hostname) Return ChildSpyStateMachineTransitionLog objects filtered by the hostname column
 * @psalm-method Collection&\Traversable<ChildSpyStateMachineTransitionLog> findByHostname(string|array<string> $hostname) Return ChildSpyStateMachineTransitionLog objects filtered by the hostname column
 * @method     ChildSpyStateMachineTransitionLog[]|Collection findByIdentifier(int|array<int> $identifier) Return ChildSpyStateMachineTransitionLog objects filtered by the identifier column
 * @psalm-method Collection&\Traversable<ChildSpyStateMachineTransitionLog> findByIdentifier(int|array<int> $identifier) Return ChildSpyStateMachineTransitionLog objects filtered by the identifier column
 * @method     ChildSpyStateMachineTransitionLog[]|Collection findByIsError(boolean|array<boolean> $is_error) Return ChildSpyStateMachineTransitionLog objects filtered by the is_error column
 * @psalm-method Collection&\Traversable<ChildSpyStateMachineTransitionLog> findByIsError(boolean|array<boolean> $is_error) Return ChildSpyStateMachineTransitionLog objects filtered by the is_error column
 * @method     ChildSpyStateMachineTransitionLog[]|Collection findByLocked(boolean|array<boolean> $locked) Return ChildSpyStateMachineTransitionLog objects filtered by the locked column
 * @psalm-method Collection&\Traversable<ChildSpyStateMachineTransitionLog> findByLocked(boolean|array<boolean> $locked) Return ChildSpyStateMachineTransitionLog objects filtered by the locked column
 * @method     ChildSpyStateMachineTransitionLog[]|Collection findByParams(array|array<array> $params) Return ChildSpyStateMachineTransitionLog objects filtered by the params column
 * @psalm-method Collection&\Traversable<ChildSpyStateMachineTransitionLog> findByParams(array|array<array> $params) Return ChildSpyStateMachineTransitionLog objects filtered by the params column
 * @method     ChildSpyStateMachineTransitionLog[]|Collection findByPath(string|array<string> $path) Return ChildSpyStateMachineTransitionLog objects filtered by the path column
 * @psalm-method Collection&\Traversable<ChildSpyStateMachineTransitionLog> findByPath(string|array<string> $path) Return ChildSpyStateMachineTransitionLog objects filtered by the path column
 * @method     ChildSpyStateMachineTransitionLog[]|Collection findBySourceState(string|array<string> $source_state) Return ChildSpyStateMachineTransitionLog objects filtered by the source_state column
 * @psalm-method Collection&\Traversable<ChildSpyStateMachineTransitionLog> findBySourceState(string|array<string> $source_state) Return ChildSpyStateMachineTransitionLog objects filtered by the source_state column
 * @method     ChildSpyStateMachineTransitionLog[]|Collection findByTargetState(string|array<string> $target_state) Return ChildSpyStateMachineTransitionLog objects filtered by the target_state column
 * @psalm-method Collection&\Traversable<ChildSpyStateMachineTransitionLog> findByTargetState(string|array<string> $target_state) Return ChildSpyStateMachineTransitionLog objects filtered by the target_state column
 * @method     ChildSpyStateMachineTransitionLog[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpyStateMachineTransitionLog objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpyStateMachineTransitionLog> findByCreatedAt(string|array<string> $created_at) Return ChildSpyStateMachineTransitionLog objects filtered by the created_at column
 *
 * @method     ChildSpyStateMachineTransitionLog[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyStateMachineTransitionLog> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyStateMachineTransitionLogQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\StateMachine\Persistence\Base\SpyStateMachineTransitionLogQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\StateMachine\\Persistence\\SpyStateMachineTransitionLog', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyStateMachineTransitionLogQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyStateMachineTransitionLogQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyStateMachineTransitionLogQuery) {
            return $criteria;
        }
        $query = new ChildSpyStateMachineTransitionLogQuery();
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
     * @return ChildSpyStateMachineTransitionLog|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyStateMachineTransitionLogTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyStateMachineTransitionLog A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id_state_machine_transition_log`, `fk_state_machine_process`, `command`, `condition`, `error_message`, `event`, `hostname`, `identifier`, `is_error`, `locked`, `params`, `path`, `source_state`, `target_state`, `created_at` FROM `spy_state_machine_transition_log` WHERE `id_state_machine_transition_log` = :p0';
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
            /** @var ChildSpyStateMachineTransitionLog $obj */
            $obj = new ChildSpyStateMachineTransitionLog();
            $obj->hydrate($row);
            SpyStateMachineTransitionLogTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyStateMachineTransitionLog|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyStateMachineTransitionLogTableMap::COL_ID_STATE_MACHINE_TRANSITION_LOG, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyStateMachineTransitionLogTableMap::COL_ID_STATE_MACHINE_TRANSITION_LOG, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idStateMachineTransitionLog Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdStateMachineTransitionLog_Between(array $idStateMachineTransitionLog)
    {
        return $this->filterByIdStateMachineTransitionLog($idStateMachineTransitionLog, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idStateMachineTransitionLogs Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdStateMachineTransitionLog_In(array $idStateMachineTransitionLogs)
    {
        return $this->filterByIdStateMachineTransitionLog($idStateMachineTransitionLogs, Criteria::IN);
    }

    /**
     * Filter the query on the id_state_machine_transition_log column
     *
     * Example usage:
     * <code>
     * $query->filterByIdStateMachineTransitionLog(1234); // WHERE id_state_machine_transition_log = 1234
     * $query->filterByIdStateMachineTransitionLog(array(12, 34), Criteria::IN); // WHERE id_state_machine_transition_log IN (12, 34)
     * $query->filterByIdStateMachineTransitionLog(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_state_machine_transition_log > 12
     * </code>
     *
     * @param     mixed $idStateMachineTransitionLog The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdStateMachineTransitionLog($idStateMachineTransitionLog = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idStateMachineTransitionLog)) {
            $useMinMax = false;
            if (isset($idStateMachineTransitionLog['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyStateMachineTransitionLogTableMap::COL_ID_STATE_MACHINE_TRANSITION_LOG, $idStateMachineTransitionLog['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idStateMachineTransitionLog['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyStateMachineTransitionLogTableMap::COL_ID_STATE_MACHINE_TRANSITION_LOG, $idStateMachineTransitionLog['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idStateMachineTransitionLog of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyStateMachineTransitionLogTableMap::COL_ID_STATE_MACHINE_TRANSITION_LOG, $idStateMachineTransitionLog, $comparison);

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
                $this->addUsingAlias(SpyStateMachineTransitionLogTableMap::COL_FK_STATE_MACHINE_PROCESS, $fkStateMachineProcess['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkStateMachineProcess['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyStateMachineTransitionLogTableMap::COL_FK_STATE_MACHINE_PROCESS, $fkStateMachineProcess['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkStateMachineProcess of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyStateMachineTransitionLogTableMap::COL_FK_STATE_MACHINE_PROCESS, $fkStateMachineProcess, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $commands Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCommand_In(array $commands)
    {
        return $this->filterByCommand($commands, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $command Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCommand_Like($command)
    {
        return $this->filterByCommand($command, Criteria::LIKE);
    }

    /**
     * Filter the query on the command column
     *
     * Example usage:
     * <code>
     * $query->filterByCommand('fooValue');   // WHERE command = 'fooValue'
     * $query->filterByCommand('%fooValue%', Criteria::LIKE); // WHERE command LIKE '%fooValue%'
     * $query->filterByCommand([1, 'foo'], Criteria::IN); // WHERE command IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $command The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByCommand($command = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $command = str_replace('*', '%', $command);
        }

        if (is_array($command) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$command of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyStateMachineTransitionLogTableMap::COL_COMMAND, $command, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $conditions Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCondition_In(array $conditions)
    {
        return $this->filterByCondition($conditions, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $condition Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCondition_Like($condition)
    {
        return $this->filterByCondition($condition, Criteria::LIKE);
    }

    /**
     * Filter the query on the condition column
     *
     * Example usage:
     * <code>
     * $query->filterByCondition('fooValue');   // WHERE condition = 'fooValue'
     * $query->filterByCondition('%fooValue%', Criteria::LIKE); // WHERE condition LIKE '%fooValue%'
     * $query->filterByCondition([1, 'foo'], Criteria::IN); // WHERE condition IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $condition The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByCondition($condition = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $condition = str_replace('*', '%', $condition);
        }

        if (is_array($condition) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$condition of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyStateMachineTransitionLogTableMap::COL_CONDITION, $condition, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $errorMessages Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByErrorMessage_In(array $errorMessages)
    {
        return $this->filterByErrorMessage($errorMessages, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $errorMessage Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByErrorMessage_Like($errorMessage)
    {
        return $this->filterByErrorMessage($errorMessage, Criteria::LIKE);
    }

    /**
     * Filter the query on the error_message column
     *
     * Example usage:
     * <code>
     * $query->filterByErrorMessage('fooValue');   // WHERE error_message = 'fooValue'
     * $query->filterByErrorMessage('%fooValue%', Criteria::LIKE); // WHERE error_message LIKE '%fooValue%'
     * $query->filterByErrorMessage([1, 'foo'], Criteria::IN); // WHERE error_message IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $errorMessage The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByErrorMessage($errorMessage = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $errorMessage = str_replace('*', '%', $errorMessage);
        }

        if (is_array($errorMessage) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$errorMessage of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyStateMachineTransitionLogTableMap::COL_ERROR_MESSAGE, $errorMessage, $comparison);

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

        $query = $this->addUsingAlias(SpyStateMachineTransitionLogTableMap::COL_EVENT, $event, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $hostnames Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHostname_In(array $hostnames)
    {
        return $this->filterByHostname($hostnames, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $hostname Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHostname_Like($hostname)
    {
        return $this->filterByHostname($hostname, Criteria::LIKE);
    }

    /**
     * Filter the query on the hostname column
     *
     * Example usage:
     * <code>
     * $query->filterByHostname('fooValue');   // WHERE hostname = 'fooValue'
     * $query->filterByHostname('%fooValue%', Criteria::LIKE); // WHERE hostname LIKE '%fooValue%'
     * $query->filterByHostname([1, 'foo'], Criteria::IN); // WHERE hostname IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $hostname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByHostname($hostname = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $hostname = str_replace('*', '%', $hostname);
        }

        if (is_array($hostname) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$hostname of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyStateMachineTransitionLogTableMap::COL_HOSTNAME, $hostname, $comparison);

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
                $this->addUsingAlias(SpyStateMachineTransitionLogTableMap::COL_IDENTIFIER, $identifier['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($identifier['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyStateMachineTransitionLogTableMap::COL_IDENTIFIER, $identifier['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$identifier of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyStateMachineTransitionLogTableMap::COL_IDENTIFIER, $identifier, $comparison);

        return $query;
    }

    /**
     * Filter the query on the is_error column
     *
     * Example usage:
     * <code>
     * $query->filterByIsError(true); // WHERE is_error = true
     * $query->filterByIsError('yes'); // WHERE is_error = true
     * </code>
     *
     * @param     bool|string $isError The value to use as filter.
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
    public function filterByIsError($isError = null, $comparison = Criteria::EQUAL)
    {
        if (is_string($isError)) {
            $isError = in_array(strtolower($isError), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $query = $this->addUsingAlias(SpyStateMachineTransitionLogTableMap::COL_IS_ERROR, $isError, $comparison);

        return $query;
    }

    /**
     * Filter the query on the locked column
     *
     * Example usage:
     * <code>
     * $query->filterByLocked(true); // WHERE locked = true
     * $query->filterByLocked('yes'); // WHERE locked = true
     * </code>
     *
     * @param     bool|string $locked The value to use as filter.
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
    public function filterByLocked($locked = null, $comparison = Criteria::EQUAL)
    {
        if (is_string($locked)) {
            $locked = in_array(strtolower($locked), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $query = $this->addUsingAlias(SpyStateMachineTransitionLogTableMap::COL_LOCKED, $locked, $comparison);

        return $query;
    }

    /**
     * Filter the query on the params column
     *
     * @param     array $params The values to use as filter. Use Criteria::LIKE to enable like matching of array values.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByParams($params = null, $comparison = Criteria::EQUAL)
    {
        $key = $this->getAliasedColName(SpyStateMachineTransitionLogTableMap::COL_PARAMS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($params as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($params as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($params as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::NOT_LIKE);
                } else {
                    $this->add($key, $value, Criteria::NOT_LIKE);
                }
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $query = $this->addUsingAlias(SpyStateMachineTransitionLogTableMap::COL_PARAMS, $params, $comparison);

        return $query;
    }

    /**
     * Filter the query on the params column
     * @param mixed $params The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByParam($params = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($params)) {
                $params = '%| ' . $params . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $params = '%| ' . $params . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(SpyStateMachineTransitionLogTableMap::COL_PARAMS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $params, $comparison);
            } else {
                $this->addAnd($key, $params, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(SpyStateMachineTransitionLogTableMap::COL_PARAMS, $params, $comparison);

        return $this;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $paths Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPath_In(array $paths)
    {
        return $this->filterByPath($paths, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $path Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPath_Like($path)
    {
        return $this->filterByPath($path, Criteria::LIKE);
    }

    /**
     * Filter the query on the path column
     *
     * Example usage:
     * <code>
     * $query->filterByPath('fooValue');   // WHERE path = 'fooValue'
     * $query->filterByPath('%fooValue%', Criteria::LIKE); // WHERE path LIKE '%fooValue%'
     * $query->filterByPath([1, 'foo'], Criteria::IN); // WHERE path IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $path The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByPath($path = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $path = str_replace('*', '%', $path);
        }

        if (is_array($path) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$path of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyStateMachineTransitionLogTableMap::COL_PATH, $path, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $sourceStates Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySourceState_In(array $sourceStates)
    {
        return $this->filterBySourceState($sourceStates, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $sourceState Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySourceState_Like($sourceState)
    {
        return $this->filterBySourceState($sourceState, Criteria::LIKE);
    }

    /**
     * Filter the query on the source_state column
     *
     * Example usage:
     * <code>
     * $query->filterBySourceState('fooValue');   // WHERE source_state = 'fooValue'
     * $query->filterBySourceState('%fooValue%', Criteria::LIKE); // WHERE source_state LIKE '%fooValue%'
     * $query->filterBySourceState([1, 'foo'], Criteria::IN); // WHERE source_state IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $sourceState The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterBySourceState($sourceState = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $sourceState = str_replace('*', '%', $sourceState);
        }

        if (is_array($sourceState) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$sourceState of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyStateMachineTransitionLogTableMap::COL_SOURCE_STATE, $sourceState, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $targetStates Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTargetState_In(array $targetStates)
    {
        return $this->filterByTargetState($targetStates, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $targetState Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTargetState_Like($targetState)
    {
        return $this->filterByTargetState($targetState, Criteria::LIKE);
    }

    /**
     * Filter the query on the target_state column
     *
     * Example usage:
     * <code>
     * $query->filterByTargetState('fooValue');   // WHERE target_state = 'fooValue'
     * $query->filterByTargetState('%fooValue%', Criteria::LIKE); // WHERE target_state LIKE '%fooValue%'
     * $query->filterByTargetState([1, 'foo'], Criteria::IN); // WHERE target_state IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $targetState The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByTargetState($targetState = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $targetState = str_replace('*', '%', $targetState);
        }

        if (is_array($targetState) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$targetState of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyStateMachineTransitionLogTableMap::COL_TARGET_STATE, $targetState, $comparison);

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
                $this->addUsingAlias(SpyStateMachineTransitionLogTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyStateMachineTransitionLogTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyStateMachineTransitionLogTableMap::COL_CREATED_AT, $createdAt, $comparison);

        return $query;
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
                ->addUsingAlias(SpyStateMachineTransitionLogTableMap::COL_FK_STATE_MACHINE_PROCESS, $spyStateMachineProcess->getIdStateMachineProcess(), $comparison);
        } elseif ($spyStateMachineProcess instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyStateMachineTransitionLogTableMap::COL_FK_STATE_MACHINE_PROCESS, $spyStateMachineProcess->toKeyValue('PrimaryKey', 'IdStateMachineProcess'), $comparison);

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
     * @param ChildSpyStateMachineTransitionLog $spyStateMachineTransitionLog Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyStateMachineTransitionLog = null)
    {
        if ($spyStateMachineTransitionLog) {
            $this->addUsingAlias(SpyStateMachineTransitionLogTableMap::COL_ID_STATE_MACHINE_TRANSITION_LOG, $spyStateMachineTransitionLog->getIdStateMachineTransitionLog(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_state_machine_transition_log table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyStateMachineTransitionLogTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyStateMachineTransitionLogTableMap::clearInstancePool();
            SpyStateMachineTransitionLogTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyStateMachineTransitionLogTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyStateMachineTransitionLogTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyStateMachineTransitionLogTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyStateMachineTransitionLogTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyStateMachineTransitionLogTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpyStateMachineTransitionLogTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyStateMachineTransitionLogTableMap::COL_CREATED_AT);

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
