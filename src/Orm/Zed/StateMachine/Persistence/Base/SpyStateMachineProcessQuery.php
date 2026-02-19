<?php

namespace Orm\Zed\StateMachine\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\Merchant\Persistence\SpyMerchant;
use Orm\Zed\StateMachine\Persistence\SpyStateMachineProcess as ChildSpyStateMachineProcess;
use Orm\Zed\StateMachine\Persistence\SpyStateMachineProcessQuery as ChildSpyStateMachineProcessQuery;
use Orm\Zed\StateMachine\Persistence\Map\SpyStateMachineProcessTableMap;
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
 * Base class that represents a query for the `spy_state_machine_process` table.
 *
 * @method     ChildSpyStateMachineProcessQuery orderByIdStateMachineProcess($order = Criteria::ASC) Order by the id_state_machine_process column
 * @method     ChildSpyStateMachineProcessQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildSpyStateMachineProcessQuery orderByStateMachineName($order = Criteria::ASC) Order by the state_machine_name column
 * @method     ChildSpyStateMachineProcessQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpyStateMachineProcessQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpyStateMachineProcessQuery groupByIdStateMachineProcess() Group by the id_state_machine_process column
 * @method     ChildSpyStateMachineProcessQuery groupByName() Group by the name column
 * @method     ChildSpyStateMachineProcessQuery groupByStateMachineName() Group by the state_machine_name column
 * @method     ChildSpyStateMachineProcessQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpyStateMachineProcessQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpyStateMachineProcessQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyStateMachineProcessQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyStateMachineProcessQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyStateMachineProcessQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyStateMachineProcessQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyStateMachineProcessQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyStateMachineProcessQuery leftJoinSpyMerchant($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchant relation
 * @method     ChildSpyStateMachineProcessQuery rightJoinSpyMerchant($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchant relation
 * @method     ChildSpyStateMachineProcessQuery innerJoinSpyMerchant($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchant relation
 *
 * @method     ChildSpyStateMachineProcessQuery joinWithSpyMerchant($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchant relation
 *
 * @method     ChildSpyStateMachineProcessQuery leftJoinWithSpyMerchant() Adds a LEFT JOIN clause and with to the query using the SpyMerchant relation
 * @method     ChildSpyStateMachineProcessQuery rightJoinWithSpyMerchant() Adds a RIGHT JOIN clause and with to the query using the SpyMerchant relation
 * @method     ChildSpyStateMachineProcessQuery innerJoinWithSpyMerchant() Adds a INNER JOIN clause and with to the query using the SpyMerchant relation
 *
 * @method     ChildSpyStateMachineProcessQuery leftJoinTransitionLog($relationAlias = null) Adds a LEFT JOIN clause to the query using the TransitionLog relation
 * @method     ChildSpyStateMachineProcessQuery rightJoinTransitionLog($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TransitionLog relation
 * @method     ChildSpyStateMachineProcessQuery innerJoinTransitionLog($relationAlias = null) Adds a INNER JOIN clause to the query using the TransitionLog relation
 *
 * @method     ChildSpyStateMachineProcessQuery joinWithTransitionLog($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TransitionLog relation
 *
 * @method     ChildSpyStateMachineProcessQuery leftJoinWithTransitionLog() Adds a LEFT JOIN clause and with to the query using the TransitionLog relation
 * @method     ChildSpyStateMachineProcessQuery rightJoinWithTransitionLog() Adds a RIGHT JOIN clause and with to the query using the TransitionLog relation
 * @method     ChildSpyStateMachineProcessQuery innerJoinWithTransitionLog() Adds a INNER JOIN clause and with to the query using the TransitionLog relation
 *
 * @method     ChildSpyStateMachineProcessQuery leftJoinStateMachineProcess($relationAlias = null) Adds a LEFT JOIN clause to the query using the StateMachineProcess relation
 * @method     ChildSpyStateMachineProcessQuery rightJoinStateMachineProcess($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StateMachineProcess relation
 * @method     ChildSpyStateMachineProcessQuery innerJoinStateMachineProcess($relationAlias = null) Adds a INNER JOIN clause to the query using the StateMachineProcess relation
 *
 * @method     ChildSpyStateMachineProcessQuery joinWithStateMachineProcess($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StateMachineProcess relation
 *
 * @method     ChildSpyStateMachineProcessQuery leftJoinWithStateMachineProcess() Adds a LEFT JOIN clause and with to the query using the StateMachineProcess relation
 * @method     ChildSpyStateMachineProcessQuery rightJoinWithStateMachineProcess() Adds a RIGHT JOIN clause and with to the query using the StateMachineProcess relation
 * @method     ChildSpyStateMachineProcessQuery innerJoinWithStateMachineProcess() Adds a INNER JOIN clause and with to the query using the StateMachineProcess relation
 *
 * @method     ChildSpyStateMachineProcessQuery leftJoinStateMachineProcessTimeout($relationAlias = null) Adds a LEFT JOIN clause to the query using the StateMachineProcessTimeout relation
 * @method     ChildSpyStateMachineProcessQuery rightJoinStateMachineProcessTimeout($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StateMachineProcessTimeout relation
 * @method     ChildSpyStateMachineProcessQuery innerJoinStateMachineProcessTimeout($relationAlias = null) Adds a INNER JOIN clause to the query using the StateMachineProcessTimeout relation
 *
 * @method     ChildSpyStateMachineProcessQuery joinWithStateMachineProcessTimeout($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StateMachineProcessTimeout relation
 *
 * @method     ChildSpyStateMachineProcessQuery leftJoinWithStateMachineProcessTimeout() Adds a LEFT JOIN clause and with to the query using the StateMachineProcessTimeout relation
 * @method     ChildSpyStateMachineProcessQuery rightJoinWithStateMachineProcessTimeout() Adds a RIGHT JOIN clause and with to the query using the StateMachineProcessTimeout relation
 * @method     ChildSpyStateMachineProcessQuery innerJoinWithStateMachineProcessTimeout() Adds a INNER JOIN clause and with to the query using the StateMachineProcessTimeout relation
 *
 * @method     \Orm\Zed\Merchant\Persistence\SpyMerchantQuery|\Orm\Zed\StateMachine\Persistence\SpyStateMachineTransitionLogQuery|\Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery|\Orm\Zed\StateMachine\Persistence\SpyStateMachineEventTimeoutQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyStateMachineProcess|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyStateMachineProcess matching the query
 * @method     ChildSpyStateMachineProcess findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyStateMachineProcess matching the query, or a new ChildSpyStateMachineProcess object populated from the query conditions when no match is found
 *
 * @method     ChildSpyStateMachineProcess|null findOneByIdStateMachineProcess(int $id_state_machine_process) Return the first ChildSpyStateMachineProcess filtered by the id_state_machine_process column
 * @method     ChildSpyStateMachineProcess|null findOneByName(string $name) Return the first ChildSpyStateMachineProcess filtered by the name column
 * @method     ChildSpyStateMachineProcess|null findOneByStateMachineName(string $state_machine_name) Return the first ChildSpyStateMachineProcess filtered by the state_machine_name column
 * @method     ChildSpyStateMachineProcess|null findOneByCreatedAt(string $created_at) Return the first ChildSpyStateMachineProcess filtered by the created_at column
 * @method     ChildSpyStateMachineProcess|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpyStateMachineProcess filtered by the updated_at column
 *
 * @method     ChildSpyStateMachineProcess requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyStateMachineProcess by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyStateMachineProcess requireOne(?ConnectionInterface $con = null) Return the first ChildSpyStateMachineProcess matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyStateMachineProcess requireOneByIdStateMachineProcess(int $id_state_machine_process) Return the first ChildSpyStateMachineProcess filtered by the id_state_machine_process column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyStateMachineProcess requireOneByName(string $name) Return the first ChildSpyStateMachineProcess filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyStateMachineProcess requireOneByStateMachineName(string $state_machine_name) Return the first ChildSpyStateMachineProcess filtered by the state_machine_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyStateMachineProcess requireOneByCreatedAt(string $created_at) Return the first ChildSpyStateMachineProcess filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyStateMachineProcess requireOneByUpdatedAt(string $updated_at) Return the first ChildSpyStateMachineProcess filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyStateMachineProcess[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyStateMachineProcess objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyStateMachineProcess> find(?ConnectionInterface $con = null) Return ChildSpyStateMachineProcess objects based on current ModelCriteria
 *
 * @method     ChildSpyStateMachineProcess[]|Collection findByIdStateMachineProcess(int|array<int> $id_state_machine_process) Return ChildSpyStateMachineProcess objects filtered by the id_state_machine_process column
 * @psalm-method Collection&\Traversable<ChildSpyStateMachineProcess> findByIdStateMachineProcess(int|array<int> $id_state_machine_process) Return ChildSpyStateMachineProcess objects filtered by the id_state_machine_process column
 * @method     ChildSpyStateMachineProcess[]|Collection findByName(string|array<string> $name) Return ChildSpyStateMachineProcess objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildSpyStateMachineProcess> findByName(string|array<string> $name) Return ChildSpyStateMachineProcess objects filtered by the name column
 * @method     ChildSpyStateMachineProcess[]|Collection findByStateMachineName(string|array<string> $state_machine_name) Return ChildSpyStateMachineProcess objects filtered by the state_machine_name column
 * @psalm-method Collection&\Traversable<ChildSpyStateMachineProcess> findByStateMachineName(string|array<string> $state_machine_name) Return ChildSpyStateMachineProcess objects filtered by the state_machine_name column
 * @method     ChildSpyStateMachineProcess[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpyStateMachineProcess objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpyStateMachineProcess> findByCreatedAt(string|array<string> $created_at) Return ChildSpyStateMachineProcess objects filtered by the created_at column
 * @method     ChildSpyStateMachineProcess[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyStateMachineProcess objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpyStateMachineProcess> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyStateMachineProcess objects filtered by the updated_at column
 *
 * @method     ChildSpyStateMachineProcess[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyStateMachineProcess> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyStateMachineProcessQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\StateMachine\Persistence\Base\SpyStateMachineProcessQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\StateMachine\\Persistence\\SpyStateMachineProcess', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyStateMachineProcessQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyStateMachineProcessQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyStateMachineProcessQuery) {
            return $criteria;
        }
        $query = new ChildSpyStateMachineProcessQuery();
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
     * @return ChildSpyStateMachineProcess|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyStateMachineProcessTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyStateMachineProcess A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id_state_machine_process`, `name`, `state_machine_name`, `created_at`, `updated_at` FROM `spy_state_machine_process` WHERE `id_state_machine_process` = :p0';
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
            /** @var ChildSpyStateMachineProcess $obj */
            $obj = new ChildSpyStateMachineProcess();
            $obj->hydrate($row);
            SpyStateMachineProcessTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyStateMachineProcess|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyStateMachineProcessTableMap::COL_ID_STATE_MACHINE_PROCESS, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyStateMachineProcessTableMap::COL_ID_STATE_MACHINE_PROCESS, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idStateMachineProcess Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdStateMachineProcess_Between(array $idStateMachineProcess)
    {
        return $this->filterByIdStateMachineProcess($idStateMachineProcess, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idStateMachineProcesss Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdStateMachineProcess_In(array $idStateMachineProcesss)
    {
        return $this->filterByIdStateMachineProcess($idStateMachineProcesss, Criteria::IN);
    }

    /**
     * Filter the query on the id_state_machine_process column
     *
     * Example usage:
     * <code>
     * $query->filterByIdStateMachineProcess(1234); // WHERE id_state_machine_process = 1234
     * $query->filterByIdStateMachineProcess(array(12, 34), Criteria::IN); // WHERE id_state_machine_process IN (12, 34)
     * $query->filterByIdStateMachineProcess(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_state_machine_process > 12
     * </code>
     *
     * @param     mixed $idStateMachineProcess The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdStateMachineProcess($idStateMachineProcess = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idStateMachineProcess)) {
            $useMinMax = false;
            if (isset($idStateMachineProcess['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyStateMachineProcessTableMap::COL_ID_STATE_MACHINE_PROCESS, $idStateMachineProcess['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idStateMachineProcess['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyStateMachineProcessTableMap::COL_ID_STATE_MACHINE_PROCESS, $idStateMachineProcess['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idStateMachineProcess of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyStateMachineProcessTableMap::COL_ID_STATE_MACHINE_PROCESS, $idStateMachineProcess, $comparison);

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

        $query = $this->addUsingAlias(SpyStateMachineProcessTableMap::COL_NAME, $name, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $stateMachineNames Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStateMachineName_In(array $stateMachineNames)
    {
        return $this->filterByStateMachineName($stateMachineNames, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $stateMachineName Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStateMachineName_Like($stateMachineName)
    {
        return $this->filterByStateMachineName($stateMachineName, Criteria::LIKE);
    }

    /**
     * Filter the query on the state_machine_name column
     *
     * Example usage:
     * <code>
     * $query->filterByStateMachineName('fooValue');   // WHERE state_machine_name = 'fooValue'
     * $query->filterByStateMachineName('%fooValue%', Criteria::LIKE); // WHERE state_machine_name LIKE '%fooValue%'
     * $query->filterByStateMachineName([1, 'foo'], Criteria::IN); // WHERE state_machine_name IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $stateMachineName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByStateMachineName($stateMachineName = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $stateMachineName = str_replace('*', '%', $stateMachineName);
        }

        if (is_array($stateMachineName) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$stateMachineName of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyStateMachineProcessTableMap::COL_STATE_MACHINE_NAME, $stateMachineName, $comparison);

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
                $this->addUsingAlias(SpyStateMachineProcessTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyStateMachineProcessTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyStateMachineProcessTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SpyStateMachineProcessTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyStateMachineProcessTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyStateMachineProcessTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Merchant\Persistence\SpyMerchant object
     *
     * @param \Orm\Zed\Merchant\Persistence\SpyMerchant|ObjectCollection $spyMerchant the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyMerchant($spyMerchant, ?string $comparison = null)
    {
        if ($spyMerchant instanceof \Orm\Zed\Merchant\Persistence\SpyMerchant) {
            $this
                ->addUsingAlias(SpyStateMachineProcessTableMap::COL_ID_STATE_MACHINE_PROCESS, $spyMerchant->getFkStateMachineProcess(), $comparison);

            return $this;
        } elseif ($spyMerchant instanceof ObjectCollection) {
            $this
                ->useSpyMerchantQuery()
                ->filterByPrimaryKeys($spyMerchant->getPrimaryKeys())
                ->endUse();

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
    public function joinSpyMerchant(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useSpyMerchantQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
     * Filter the query by a related \Orm\Zed\StateMachine\Persistence\SpyStateMachineTransitionLog object
     *
     * @param \Orm\Zed\StateMachine\Persistence\SpyStateMachineTransitionLog|ObjectCollection $spyStateMachineTransitionLog the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTransitionLog($spyStateMachineTransitionLog, ?string $comparison = null)
    {
        if ($spyStateMachineTransitionLog instanceof \Orm\Zed\StateMachine\Persistence\SpyStateMachineTransitionLog) {
            $this
                ->addUsingAlias(SpyStateMachineProcessTableMap::COL_ID_STATE_MACHINE_PROCESS, $spyStateMachineTransitionLog->getFkStateMachineProcess(), $comparison);

            return $this;
        } elseif ($spyStateMachineTransitionLog instanceof ObjectCollection) {
            $this
                ->useTransitionLogQuery()
                ->filterByPrimaryKeys($spyStateMachineTransitionLog->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByTransitionLog() only accepts arguments of type \Orm\Zed\StateMachine\Persistence\SpyStateMachineTransitionLog or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TransitionLog relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinTransitionLog(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TransitionLog');

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
            $this->addJoinObject($join, 'TransitionLog');
        }

        return $this;
    }

    /**
     * Use the TransitionLog relation SpyStateMachineTransitionLog object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\StateMachine\Persistence\SpyStateMachineTransitionLogQuery A secondary query class using the current class as primary query
     */
    public function useTransitionLogQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTransitionLog($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TransitionLog', '\Orm\Zed\StateMachine\Persistence\SpyStateMachineTransitionLogQuery');
    }

    /**
     * Use the TransitionLog relation SpyStateMachineTransitionLog object
     *
     * @param callable(\Orm\Zed\StateMachine\Persistence\SpyStateMachineTransitionLogQuery):\Orm\Zed\StateMachine\Persistence\SpyStateMachineTransitionLogQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTransitionLogQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useTransitionLogQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the TransitionLog relation to the SpyStateMachineTransitionLog table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\StateMachine\Persistence\SpyStateMachineTransitionLogQuery The inner query object of the EXISTS statement
     */
    public function useTransitionLogExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\StateMachine\Persistence\SpyStateMachineTransitionLogQuery */
        $q = $this->useExistsQuery('TransitionLog', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the TransitionLog relation to the SpyStateMachineTransitionLog table for a NOT EXISTS query.
     *
     * @see useTransitionLogExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\StateMachine\Persistence\SpyStateMachineTransitionLogQuery The inner query object of the NOT EXISTS statement
     */
    public function useTransitionLogNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\StateMachine\Persistence\SpyStateMachineTransitionLogQuery */
        $q = $this->useExistsQuery('TransitionLog', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the TransitionLog relation to the SpyStateMachineTransitionLog table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\StateMachine\Persistence\SpyStateMachineTransitionLogQuery The inner query object of the IN statement
     */
    public function useInTransitionLogQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\StateMachine\Persistence\SpyStateMachineTransitionLogQuery */
        $q = $this->useInQuery('TransitionLog', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the TransitionLog relation to the SpyStateMachineTransitionLog table for a NOT IN query.
     *
     * @see useTransitionLogInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\StateMachine\Persistence\SpyStateMachineTransitionLogQuery The inner query object of the NOT IN statement
     */
    public function useNotInTransitionLogQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\StateMachine\Persistence\SpyStateMachineTransitionLogQuery */
        $q = $this->useInQuery('TransitionLog', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemState object
     *
     * @param \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemState|ObjectCollection $spyStateMachineItemState the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStateMachineProcess($spyStateMachineItemState, ?string $comparison = null)
    {
        if ($spyStateMachineItemState instanceof \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemState) {
            $this
                ->addUsingAlias(SpyStateMachineProcessTableMap::COL_ID_STATE_MACHINE_PROCESS, $spyStateMachineItemState->getFkStateMachineProcess(), $comparison);

            return $this;
        } elseif ($spyStateMachineItemState instanceof ObjectCollection) {
            $this
                ->useStateMachineProcessQuery()
                ->filterByPrimaryKeys($spyStateMachineItemState->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByStateMachineProcess() only accepts arguments of type \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemState or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the StateMachineProcess relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinStateMachineProcess(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('StateMachineProcess');

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
            $this->addJoinObject($join, 'StateMachineProcess');
        }

        return $this;
    }

    /**
     * Use the StateMachineProcess relation SpyStateMachineItemState object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery A secondary query class using the current class as primary query
     */
    public function useStateMachineProcessQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStateMachineProcess($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'StateMachineProcess', '\Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery');
    }

    /**
     * Use the StateMachineProcess relation SpyStateMachineItemState object
     *
     * @param callable(\Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery):\Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withStateMachineProcessQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useStateMachineProcessQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the StateMachineProcess relation to the SpyStateMachineItemState table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery The inner query object of the EXISTS statement
     */
    public function useStateMachineProcessExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery */
        $q = $this->useExistsQuery('StateMachineProcess', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the StateMachineProcess relation to the SpyStateMachineItemState table for a NOT EXISTS query.
     *
     * @see useStateMachineProcessExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery The inner query object of the NOT EXISTS statement
     */
    public function useStateMachineProcessNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery */
        $q = $this->useExistsQuery('StateMachineProcess', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the StateMachineProcess relation to the SpyStateMachineItemState table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery The inner query object of the IN statement
     */
    public function useInStateMachineProcessQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery */
        $q = $this->useInQuery('StateMachineProcess', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the StateMachineProcess relation to the SpyStateMachineItemState table for a NOT IN query.
     *
     * @see useStateMachineProcessInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery The inner query object of the NOT IN statement
     */
    public function useNotInStateMachineProcessQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery */
        $q = $this->useInQuery('StateMachineProcess', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\StateMachine\Persistence\SpyStateMachineEventTimeout object
     *
     * @param \Orm\Zed\StateMachine\Persistence\SpyStateMachineEventTimeout|ObjectCollection $spyStateMachineEventTimeout the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStateMachineProcessTimeout($spyStateMachineEventTimeout, ?string $comparison = null)
    {
        if ($spyStateMachineEventTimeout instanceof \Orm\Zed\StateMachine\Persistence\SpyStateMachineEventTimeout) {
            $this
                ->addUsingAlias(SpyStateMachineProcessTableMap::COL_ID_STATE_MACHINE_PROCESS, $spyStateMachineEventTimeout->getFkStateMachineProcess(), $comparison);

            return $this;
        } elseif ($spyStateMachineEventTimeout instanceof ObjectCollection) {
            $this
                ->useStateMachineProcessTimeoutQuery()
                ->filterByPrimaryKeys($spyStateMachineEventTimeout->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByStateMachineProcessTimeout() only accepts arguments of type \Orm\Zed\StateMachine\Persistence\SpyStateMachineEventTimeout or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the StateMachineProcessTimeout relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinStateMachineProcessTimeout(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('StateMachineProcessTimeout');

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
            $this->addJoinObject($join, 'StateMachineProcessTimeout');
        }

        return $this;
    }

    /**
     * Use the StateMachineProcessTimeout relation SpyStateMachineEventTimeout object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\StateMachine\Persistence\SpyStateMachineEventTimeoutQuery A secondary query class using the current class as primary query
     */
    public function useStateMachineProcessTimeoutQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStateMachineProcessTimeout($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'StateMachineProcessTimeout', '\Orm\Zed\StateMachine\Persistence\SpyStateMachineEventTimeoutQuery');
    }

    /**
     * Use the StateMachineProcessTimeout relation SpyStateMachineEventTimeout object
     *
     * @param callable(\Orm\Zed\StateMachine\Persistence\SpyStateMachineEventTimeoutQuery):\Orm\Zed\StateMachine\Persistence\SpyStateMachineEventTimeoutQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withStateMachineProcessTimeoutQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useStateMachineProcessTimeoutQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the StateMachineProcessTimeout relation to the SpyStateMachineEventTimeout table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\StateMachine\Persistence\SpyStateMachineEventTimeoutQuery The inner query object of the EXISTS statement
     */
    public function useStateMachineProcessTimeoutExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\StateMachine\Persistence\SpyStateMachineEventTimeoutQuery */
        $q = $this->useExistsQuery('StateMachineProcessTimeout', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the StateMachineProcessTimeout relation to the SpyStateMachineEventTimeout table for a NOT EXISTS query.
     *
     * @see useStateMachineProcessTimeoutExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\StateMachine\Persistence\SpyStateMachineEventTimeoutQuery The inner query object of the NOT EXISTS statement
     */
    public function useStateMachineProcessTimeoutNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\StateMachine\Persistence\SpyStateMachineEventTimeoutQuery */
        $q = $this->useExistsQuery('StateMachineProcessTimeout', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the StateMachineProcessTimeout relation to the SpyStateMachineEventTimeout table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\StateMachine\Persistence\SpyStateMachineEventTimeoutQuery The inner query object of the IN statement
     */
    public function useInStateMachineProcessTimeoutQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\StateMachine\Persistence\SpyStateMachineEventTimeoutQuery */
        $q = $this->useInQuery('StateMachineProcessTimeout', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the StateMachineProcessTimeout relation to the SpyStateMachineEventTimeout table for a NOT IN query.
     *
     * @see useStateMachineProcessTimeoutInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\StateMachine\Persistence\SpyStateMachineEventTimeoutQuery The inner query object of the NOT IN statement
     */
    public function useNotInStateMachineProcessTimeoutQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\StateMachine\Persistence\SpyStateMachineEventTimeoutQuery */
        $q = $this->useInQuery('StateMachineProcessTimeout', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyStateMachineProcess $spyStateMachineProcess Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyStateMachineProcess = null)
    {
        if ($spyStateMachineProcess) {
            $this->addUsingAlias(SpyStateMachineProcessTableMap::COL_ID_STATE_MACHINE_PROCESS, $spyStateMachineProcess->getIdStateMachineProcess(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_state_machine_process table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyStateMachineProcessTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyStateMachineProcessTableMap::clearInstancePool();
            SpyStateMachineProcessTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyStateMachineProcessTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyStateMachineProcessTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyStateMachineProcessTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyStateMachineProcessTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(SpyStateMachineProcessTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyStateMachineProcessTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyStateMachineProcessTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyStateMachineProcessTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpyStateMachineProcessTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyStateMachineProcessTableMap::COL_CREATED_AT);

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
