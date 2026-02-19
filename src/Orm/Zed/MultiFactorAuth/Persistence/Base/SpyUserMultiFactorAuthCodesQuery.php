<?php

namespace Orm\Zed\MultiFactorAuth\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuthCodes as ChildSpyUserMultiFactorAuthCodes;
use Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuthCodesQuery as ChildSpyUserMultiFactorAuthCodesQuery;
use Orm\Zed\MultiFactorAuth\Persistence\Map\SpyUserMultiFactorAuthCodesTableMap;
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
 * Base class that represents a query for the `spy_user_multi_factor_auth_codes` table.
 *
 * @method     ChildSpyUserMultiFactorAuthCodesQuery orderByIdUserMultiFactorAuthCode($order = Criteria::ASC) Order by the id_user_multi_factor_auth_code column
 * @method     ChildSpyUserMultiFactorAuthCodesQuery orderByFkUserMultiFactorAuth($order = Criteria::ASC) Order by the fk_user_multi_factor_auth column
 * @method     ChildSpyUserMultiFactorAuthCodesQuery orderByCode($order = Criteria::ASC) Order by the code column
 * @method     ChildSpyUserMultiFactorAuthCodesQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildSpyUserMultiFactorAuthCodesQuery orderByExpirationDate($order = Criteria::ASC) Order by the expiration_date column
 * @method     ChildSpyUserMultiFactorAuthCodesQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpyUserMultiFactorAuthCodesQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpyUserMultiFactorAuthCodesQuery groupByIdUserMultiFactorAuthCode() Group by the id_user_multi_factor_auth_code column
 * @method     ChildSpyUserMultiFactorAuthCodesQuery groupByFkUserMultiFactorAuth() Group by the fk_user_multi_factor_auth column
 * @method     ChildSpyUserMultiFactorAuthCodesQuery groupByCode() Group by the code column
 * @method     ChildSpyUserMultiFactorAuthCodesQuery groupByStatus() Group by the status column
 * @method     ChildSpyUserMultiFactorAuthCodesQuery groupByExpirationDate() Group by the expiration_date column
 * @method     ChildSpyUserMultiFactorAuthCodesQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpyUserMultiFactorAuthCodesQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpyUserMultiFactorAuthCodesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyUserMultiFactorAuthCodesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyUserMultiFactorAuthCodesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyUserMultiFactorAuthCodesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyUserMultiFactorAuthCodesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyUserMultiFactorAuthCodesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyUserMultiFactorAuthCodesQuery leftJoinSpyUserMultiFactorAuth($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyUserMultiFactorAuth relation
 * @method     ChildSpyUserMultiFactorAuthCodesQuery rightJoinSpyUserMultiFactorAuth($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyUserMultiFactorAuth relation
 * @method     ChildSpyUserMultiFactorAuthCodesQuery innerJoinSpyUserMultiFactorAuth($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyUserMultiFactorAuth relation
 *
 * @method     ChildSpyUserMultiFactorAuthCodesQuery joinWithSpyUserMultiFactorAuth($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyUserMultiFactorAuth relation
 *
 * @method     ChildSpyUserMultiFactorAuthCodesQuery leftJoinWithSpyUserMultiFactorAuth() Adds a LEFT JOIN clause and with to the query using the SpyUserMultiFactorAuth relation
 * @method     ChildSpyUserMultiFactorAuthCodesQuery rightJoinWithSpyUserMultiFactorAuth() Adds a RIGHT JOIN clause and with to the query using the SpyUserMultiFactorAuth relation
 * @method     ChildSpyUserMultiFactorAuthCodesQuery innerJoinWithSpyUserMultiFactorAuth() Adds a INNER JOIN clause and with to the query using the SpyUserMultiFactorAuth relation
 *
 * @method     ChildSpyUserMultiFactorAuthCodesQuery leftJoinSpyUserMultiFactorAuthCodesAttempts($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyUserMultiFactorAuthCodesAttempts relation
 * @method     ChildSpyUserMultiFactorAuthCodesQuery rightJoinSpyUserMultiFactorAuthCodesAttempts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyUserMultiFactorAuthCodesAttempts relation
 * @method     ChildSpyUserMultiFactorAuthCodesQuery innerJoinSpyUserMultiFactorAuthCodesAttempts($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyUserMultiFactorAuthCodesAttempts relation
 *
 * @method     ChildSpyUserMultiFactorAuthCodesQuery joinWithSpyUserMultiFactorAuthCodesAttempts($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyUserMultiFactorAuthCodesAttempts relation
 *
 * @method     ChildSpyUserMultiFactorAuthCodesQuery leftJoinWithSpyUserMultiFactorAuthCodesAttempts() Adds a LEFT JOIN clause and with to the query using the SpyUserMultiFactorAuthCodesAttempts relation
 * @method     ChildSpyUserMultiFactorAuthCodesQuery rightJoinWithSpyUserMultiFactorAuthCodesAttempts() Adds a RIGHT JOIN clause and with to the query using the SpyUserMultiFactorAuthCodesAttempts relation
 * @method     ChildSpyUserMultiFactorAuthCodesQuery innerJoinWithSpyUserMultiFactorAuthCodesAttempts() Adds a INNER JOIN clause and with to the query using the SpyUserMultiFactorAuthCodesAttempts relation
 *
 * @method     \Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuthQuery|\Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuthCodesAttemptsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyUserMultiFactorAuthCodes|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyUserMultiFactorAuthCodes matching the query
 * @method     ChildSpyUserMultiFactorAuthCodes findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyUserMultiFactorAuthCodes matching the query, or a new ChildSpyUserMultiFactorAuthCodes object populated from the query conditions when no match is found
 *
 * @method     ChildSpyUserMultiFactorAuthCodes|null findOneByIdUserMultiFactorAuthCode(int $id_user_multi_factor_auth_code) Return the first ChildSpyUserMultiFactorAuthCodes filtered by the id_user_multi_factor_auth_code column
 * @method     ChildSpyUserMultiFactorAuthCodes|null findOneByFkUserMultiFactorAuth(int $fk_user_multi_factor_auth) Return the first ChildSpyUserMultiFactorAuthCodes filtered by the fk_user_multi_factor_auth column
 * @method     ChildSpyUserMultiFactorAuthCodes|null findOneByCode(string $code) Return the first ChildSpyUserMultiFactorAuthCodes filtered by the code column
 * @method     ChildSpyUserMultiFactorAuthCodes|null findOneByStatus(int $status) Return the first ChildSpyUserMultiFactorAuthCodes filtered by the status column
 * @method     ChildSpyUserMultiFactorAuthCodes|null findOneByExpirationDate(string $expiration_date) Return the first ChildSpyUserMultiFactorAuthCodes filtered by the expiration_date column
 * @method     ChildSpyUserMultiFactorAuthCodes|null findOneByCreatedAt(string $created_at) Return the first ChildSpyUserMultiFactorAuthCodes filtered by the created_at column
 * @method     ChildSpyUserMultiFactorAuthCodes|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpyUserMultiFactorAuthCodes filtered by the updated_at column
 *
 * @method     ChildSpyUserMultiFactorAuthCodes requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyUserMultiFactorAuthCodes by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyUserMultiFactorAuthCodes requireOne(?ConnectionInterface $con = null) Return the first ChildSpyUserMultiFactorAuthCodes matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyUserMultiFactorAuthCodes requireOneByIdUserMultiFactorAuthCode(int $id_user_multi_factor_auth_code) Return the first ChildSpyUserMultiFactorAuthCodes filtered by the id_user_multi_factor_auth_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyUserMultiFactorAuthCodes requireOneByFkUserMultiFactorAuth(int $fk_user_multi_factor_auth) Return the first ChildSpyUserMultiFactorAuthCodes filtered by the fk_user_multi_factor_auth column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyUserMultiFactorAuthCodes requireOneByCode(string $code) Return the first ChildSpyUserMultiFactorAuthCodes filtered by the code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyUserMultiFactorAuthCodes requireOneByStatus(int $status) Return the first ChildSpyUserMultiFactorAuthCodes filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyUserMultiFactorAuthCodes requireOneByExpirationDate(string $expiration_date) Return the first ChildSpyUserMultiFactorAuthCodes filtered by the expiration_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyUserMultiFactorAuthCodes requireOneByCreatedAt(string $created_at) Return the first ChildSpyUserMultiFactorAuthCodes filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyUserMultiFactorAuthCodes requireOneByUpdatedAt(string $updated_at) Return the first ChildSpyUserMultiFactorAuthCodes filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyUserMultiFactorAuthCodes[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyUserMultiFactorAuthCodes objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyUserMultiFactorAuthCodes> find(?ConnectionInterface $con = null) Return ChildSpyUserMultiFactorAuthCodes objects based on current ModelCriteria
 *
 * @method     ChildSpyUserMultiFactorAuthCodes[]|Collection findByIdUserMultiFactorAuthCode(int|array<int> $id_user_multi_factor_auth_code) Return ChildSpyUserMultiFactorAuthCodes objects filtered by the id_user_multi_factor_auth_code column
 * @psalm-method Collection&\Traversable<ChildSpyUserMultiFactorAuthCodes> findByIdUserMultiFactorAuthCode(int|array<int> $id_user_multi_factor_auth_code) Return ChildSpyUserMultiFactorAuthCodes objects filtered by the id_user_multi_factor_auth_code column
 * @method     ChildSpyUserMultiFactorAuthCodes[]|Collection findByFkUserMultiFactorAuth(int|array<int> $fk_user_multi_factor_auth) Return ChildSpyUserMultiFactorAuthCodes objects filtered by the fk_user_multi_factor_auth column
 * @psalm-method Collection&\Traversable<ChildSpyUserMultiFactorAuthCodes> findByFkUserMultiFactorAuth(int|array<int> $fk_user_multi_factor_auth) Return ChildSpyUserMultiFactorAuthCodes objects filtered by the fk_user_multi_factor_auth column
 * @method     ChildSpyUserMultiFactorAuthCodes[]|Collection findByCode(string|array<string> $code) Return ChildSpyUserMultiFactorAuthCodes objects filtered by the code column
 * @psalm-method Collection&\Traversable<ChildSpyUserMultiFactorAuthCodes> findByCode(string|array<string> $code) Return ChildSpyUserMultiFactorAuthCodes objects filtered by the code column
 * @method     ChildSpyUserMultiFactorAuthCodes[]|Collection findByStatus(int|array<int> $status) Return ChildSpyUserMultiFactorAuthCodes objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildSpyUserMultiFactorAuthCodes> findByStatus(int|array<int> $status) Return ChildSpyUserMultiFactorAuthCodes objects filtered by the status column
 * @method     ChildSpyUserMultiFactorAuthCodes[]|Collection findByExpirationDate(string|array<string> $expiration_date) Return ChildSpyUserMultiFactorAuthCodes objects filtered by the expiration_date column
 * @psalm-method Collection&\Traversable<ChildSpyUserMultiFactorAuthCodes> findByExpirationDate(string|array<string> $expiration_date) Return ChildSpyUserMultiFactorAuthCodes objects filtered by the expiration_date column
 * @method     ChildSpyUserMultiFactorAuthCodes[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpyUserMultiFactorAuthCodes objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpyUserMultiFactorAuthCodes> findByCreatedAt(string|array<string> $created_at) Return ChildSpyUserMultiFactorAuthCodes objects filtered by the created_at column
 * @method     ChildSpyUserMultiFactorAuthCodes[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyUserMultiFactorAuthCodes objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpyUserMultiFactorAuthCodes> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyUserMultiFactorAuthCodes objects filtered by the updated_at column
 *
 * @method     ChildSpyUserMultiFactorAuthCodes[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyUserMultiFactorAuthCodes> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyUserMultiFactorAuthCodesQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\MultiFactorAuth\Persistence\Base\SpyUserMultiFactorAuthCodesQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\MultiFactorAuth\\Persistence\\SpyUserMultiFactorAuthCodes', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyUserMultiFactorAuthCodesQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyUserMultiFactorAuthCodesQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyUserMultiFactorAuthCodesQuery) {
            return $criteria;
        }
        $query = new ChildSpyUserMultiFactorAuthCodesQuery();
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
     * @return ChildSpyUserMultiFactorAuthCodes|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyUserMultiFactorAuthCodesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyUserMultiFactorAuthCodes A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_user_multi_factor_auth_code, fk_user_multi_factor_auth, code, status, expiration_date, created_at, updated_at FROM spy_user_multi_factor_auth_codes WHERE id_user_multi_factor_auth_code = :p0';
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
            /** @var ChildSpyUserMultiFactorAuthCodes $obj */
            $obj = new ChildSpyUserMultiFactorAuthCodes();
            $obj->hydrate($row);
            SpyUserMultiFactorAuthCodesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyUserMultiFactorAuthCodes|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyUserMultiFactorAuthCodesTableMap::COL_ID_USER_MULTI_FACTOR_AUTH_CODE, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyUserMultiFactorAuthCodesTableMap::COL_ID_USER_MULTI_FACTOR_AUTH_CODE, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idUserMultiFactorAuthCode Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdUserMultiFactorAuthCode_Between(array $idUserMultiFactorAuthCode)
    {
        return $this->filterByIdUserMultiFactorAuthCode($idUserMultiFactorAuthCode, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idUserMultiFactorAuthCodes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdUserMultiFactorAuthCode_In(array $idUserMultiFactorAuthCodes)
    {
        return $this->filterByIdUserMultiFactorAuthCode($idUserMultiFactorAuthCodes, Criteria::IN);
    }

    /**
     * Filter the query on the id_user_multi_factor_auth_code column
     *
     * Example usage:
     * <code>
     * $query->filterByIdUserMultiFactorAuthCode(1234); // WHERE id_user_multi_factor_auth_code = 1234
     * $query->filterByIdUserMultiFactorAuthCode(array(12, 34), Criteria::IN); // WHERE id_user_multi_factor_auth_code IN (12, 34)
     * $query->filterByIdUserMultiFactorAuthCode(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_user_multi_factor_auth_code > 12
     * </code>
     *
     * @param     mixed $idUserMultiFactorAuthCode The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdUserMultiFactorAuthCode($idUserMultiFactorAuthCode = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idUserMultiFactorAuthCode)) {
            $useMinMax = false;
            if (isset($idUserMultiFactorAuthCode['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyUserMultiFactorAuthCodesTableMap::COL_ID_USER_MULTI_FACTOR_AUTH_CODE, $idUserMultiFactorAuthCode['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUserMultiFactorAuthCode['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyUserMultiFactorAuthCodesTableMap::COL_ID_USER_MULTI_FACTOR_AUTH_CODE, $idUserMultiFactorAuthCode['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idUserMultiFactorAuthCode of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyUserMultiFactorAuthCodesTableMap::COL_ID_USER_MULTI_FACTOR_AUTH_CODE, $idUserMultiFactorAuthCode, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkUserMultiFactorAuth Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkUserMultiFactorAuth_Between(array $fkUserMultiFactorAuth)
    {
        return $this->filterByFkUserMultiFactorAuth($fkUserMultiFactorAuth, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkUserMultiFactorAuths Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkUserMultiFactorAuth_In(array $fkUserMultiFactorAuths)
    {
        return $this->filterByFkUserMultiFactorAuth($fkUserMultiFactorAuths, Criteria::IN);
    }

    /**
     * Filter the query on the fk_user_multi_factor_auth column
     *
     * Example usage:
     * <code>
     * $query->filterByFkUserMultiFactorAuth(1234); // WHERE fk_user_multi_factor_auth = 1234
     * $query->filterByFkUserMultiFactorAuth(array(12, 34), Criteria::IN); // WHERE fk_user_multi_factor_auth IN (12, 34)
     * $query->filterByFkUserMultiFactorAuth(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_user_multi_factor_auth > 12
     * </code>
     *
     * @see       filterBySpyUserMultiFactorAuth()
     *
     * @param     mixed $fkUserMultiFactorAuth The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkUserMultiFactorAuth($fkUserMultiFactorAuth = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkUserMultiFactorAuth)) {
            $useMinMax = false;
            if (isset($fkUserMultiFactorAuth['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyUserMultiFactorAuthCodesTableMap::COL_FK_USER_MULTI_FACTOR_AUTH, $fkUserMultiFactorAuth['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkUserMultiFactorAuth['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyUserMultiFactorAuthCodesTableMap::COL_FK_USER_MULTI_FACTOR_AUTH, $fkUserMultiFactorAuth['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkUserMultiFactorAuth of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyUserMultiFactorAuthCodesTableMap::COL_FK_USER_MULTI_FACTOR_AUTH, $fkUserMultiFactorAuth, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $codes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCode_In(array $codes)
    {
        return $this->filterByCode($codes, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $code Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCode_Like($code)
    {
        return $this->filterByCode($code, Criteria::LIKE);
    }

    /**
     * Filter the query on the code column
     *
     * Example usage:
     * <code>
     * $query->filterByCode('fooValue');   // WHERE code = 'fooValue'
     * $query->filterByCode('%fooValue%', Criteria::LIKE); // WHERE code LIKE '%fooValue%'
     * $query->filterByCode([1, 'foo'], Criteria::IN); // WHERE code IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $code The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByCode($code = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $code = str_replace('*', '%', $code);
        }

        if (is_array($code) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$code of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyUserMultiFactorAuthCodesTableMap::COL_CODE, $code, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $status Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStatus_Between(array $status)
    {
        return $this->filterByStatus($status, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $statuss Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStatus_In(array $statuss)
    {
        return $this->filterByStatus($statuss, Criteria::IN);
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus(1234); // WHERE status = 1234
     * $query->filterByStatus(array(12, 34), Criteria::IN); // WHERE status IN (12, 34)
     * $query->filterByStatus(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE status > 12
     * </code>
     *
     * @param     mixed $status The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByStatus($status = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyUserMultiFactorAuthCodesTableMap::COL_STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyUserMultiFactorAuthCodesTableMap::COL_STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$status of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyUserMultiFactorAuthCodesTableMap::COL_STATUS, $status, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $expirationDate Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpirationDate_Between(array $expirationDate)
    {
        return $this->filterByExpirationDate($expirationDate, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $expirationDates Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpirationDate_In(array $expirationDates)
    {
        return $this->filterByExpirationDate($expirationDates, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $expirationDate Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpirationDate_Like($expirationDate)
    {
        return $this->filterByExpirationDate($expirationDate, Criteria::LIKE);
    }

    /**
     * Filter the query on the expiration_date column
     *
     * Example usage:
     * <code>
     * $query->filterByExpirationDate('2011-03-14'); // WHERE expiration_date = '2011-03-14'
     * $query->filterByExpirationDate('now'); // WHERE expiration_date = '2011-03-14'
     * $query->filterByExpirationDate(array('max' => 'yesterday'), SprykerCriteria::BETWEEN); // WHERE expiration_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $expirationDate The value to use as filter.
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
    public function filterByExpirationDate($expirationDate = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($expirationDate)) {
            $useMinMax = false;
            if (isset($expirationDate['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyUserMultiFactorAuthCodesTableMap::COL_EXPIRATION_DATE, $expirationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expirationDate['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyUserMultiFactorAuthCodesTableMap::COL_EXPIRATION_DATE, $expirationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$expirationDate of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyUserMultiFactorAuthCodesTableMap::COL_EXPIRATION_DATE, $expirationDate, $comparison);

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
                $this->addUsingAlias(SpyUserMultiFactorAuthCodesTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyUserMultiFactorAuthCodesTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyUserMultiFactorAuthCodesTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SpyUserMultiFactorAuthCodesTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyUserMultiFactorAuthCodesTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyUserMultiFactorAuthCodesTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuth object
     *
     * @param \Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuth|ObjectCollection $spyUserMultiFactorAuth The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyUserMultiFactorAuth($spyUserMultiFactorAuth, ?string $comparison = null)
    {
        if ($spyUserMultiFactorAuth instanceof \Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuth) {
            return $this
                ->addUsingAlias(SpyUserMultiFactorAuthCodesTableMap::COL_FK_USER_MULTI_FACTOR_AUTH, $spyUserMultiFactorAuth->getIdUserMultiFactorAuth(), $comparison);
        } elseif ($spyUserMultiFactorAuth instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyUserMultiFactorAuthCodesTableMap::COL_FK_USER_MULTI_FACTOR_AUTH, $spyUserMultiFactorAuth->toKeyValue('PrimaryKey', 'IdUserMultiFactorAuth'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyUserMultiFactorAuth() only accepts arguments of type \Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuth or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyUserMultiFactorAuth relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyUserMultiFactorAuth(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyUserMultiFactorAuth');

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
            $this->addJoinObject($join, 'SpyUserMultiFactorAuth');
        }

        return $this;
    }

    /**
     * Use the SpyUserMultiFactorAuth relation SpyUserMultiFactorAuth object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuthQuery A secondary query class using the current class as primary query
     */
    public function useSpyUserMultiFactorAuthQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyUserMultiFactorAuth($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyUserMultiFactorAuth', '\Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuthQuery');
    }

    /**
     * Use the SpyUserMultiFactorAuth relation SpyUserMultiFactorAuth object
     *
     * @param callable(\Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuthQuery):\Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuthQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyUserMultiFactorAuthQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyUserMultiFactorAuthQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyUserMultiFactorAuth table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuthQuery The inner query object of the EXISTS statement
     */
    public function useSpyUserMultiFactorAuthExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuthQuery */
        $q = $this->useExistsQuery('SpyUserMultiFactorAuth', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyUserMultiFactorAuth table for a NOT EXISTS query.
     *
     * @see useSpyUserMultiFactorAuthExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuthQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyUserMultiFactorAuthNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuthQuery */
        $q = $this->useExistsQuery('SpyUserMultiFactorAuth', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyUserMultiFactorAuth table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuthQuery The inner query object of the IN statement
     */
    public function useInSpyUserMultiFactorAuthQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuthQuery */
        $q = $this->useInQuery('SpyUserMultiFactorAuth', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyUserMultiFactorAuth table for a NOT IN query.
     *
     * @see useSpyUserMultiFactorAuthInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuthQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyUserMultiFactorAuthQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuthQuery */
        $q = $this->useInQuery('SpyUserMultiFactorAuth', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuthCodesAttempts object
     *
     * @param \Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuthCodesAttempts|ObjectCollection $spyUserMultiFactorAuthCodesAttempts the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyUserMultiFactorAuthCodesAttempts($spyUserMultiFactorAuthCodesAttempts, ?string $comparison = null)
    {
        if ($spyUserMultiFactorAuthCodesAttempts instanceof \Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuthCodesAttempts) {
            $this
                ->addUsingAlias(SpyUserMultiFactorAuthCodesTableMap::COL_ID_USER_MULTI_FACTOR_AUTH_CODE, $spyUserMultiFactorAuthCodesAttempts->getFkUserMultiFactorAuthCode(), $comparison);

            return $this;
        } elseif ($spyUserMultiFactorAuthCodesAttempts instanceof ObjectCollection) {
            $this
                ->useSpyUserMultiFactorAuthCodesAttemptsQuery()
                ->filterByPrimaryKeys($spyUserMultiFactorAuthCodesAttempts->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyUserMultiFactorAuthCodesAttempts() only accepts arguments of type \Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuthCodesAttempts or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyUserMultiFactorAuthCodesAttempts relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyUserMultiFactorAuthCodesAttempts(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyUserMultiFactorAuthCodesAttempts');

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
            $this->addJoinObject($join, 'SpyUserMultiFactorAuthCodesAttempts');
        }

        return $this;
    }

    /**
     * Use the SpyUserMultiFactorAuthCodesAttempts relation SpyUserMultiFactorAuthCodesAttempts object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuthCodesAttemptsQuery A secondary query class using the current class as primary query
     */
    public function useSpyUserMultiFactorAuthCodesAttemptsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyUserMultiFactorAuthCodesAttempts($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyUserMultiFactorAuthCodesAttempts', '\Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuthCodesAttemptsQuery');
    }

    /**
     * Use the SpyUserMultiFactorAuthCodesAttempts relation SpyUserMultiFactorAuthCodesAttempts object
     *
     * @param callable(\Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuthCodesAttemptsQuery):\Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuthCodesAttemptsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyUserMultiFactorAuthCodesAttemptsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyUserMultiFactorAuthCodesAttemptsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyUserMultiFactorAuthCodesAttempts table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuthCodesAttemptsQuery The inner query object of the EXISTS statement
     */
    public function useSpyUserMultiFactorAuthCodesAttemptsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuthCodesAttemptsQuery */
        $q = $this->useExistsQuery('SpyUserMultiFactorAuthCodesAttempts', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyUserMultiFactorAuthCodesAttempts table for a NOT EXISTS query.
     *
     * @see useSpyUserMultiFactorAuthCodesAttemptsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuthCodesAttemptsQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyUserMultiFactorAuthCodesAttemptsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuthCodesAttemptsQuery */
        $q = $this->useExistsQuery('SpyUserMultiFactorAuthCodesAttempts', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyUserMultiFactorAuthCodesAttempts table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuthCodesAttemptsQuery The inner query object of the IN statement
     */
    public function useInSpyUserMultiFactorAuthCodesAttemptsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuthCodesAttemptsQuery */
        $q = $this->useInQuery('SpyUserMultiFactorAuthCodesAttempts', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyUserMultiFactorAuthCodesAttempts table for a NOT IN query.
     *
     * @see useSpyUserMultiFactorAuthCodesAttemptsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuthCodesAttemptsQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyUserMultiFactorAuthCodesAttemptsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuthCodesAttemptsQuery */
        $q = $this->useInQuery('SpyUserMultiFactorAuthCodesAttempts', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyUserMultiFactorAuthCodes $spyUserMultiFactorAuthCodes Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyUserMultiFactorAuthCodes = null)
    {
        if ($spyUserMultiFactorAuthCodes) {
            $this->addUsingAlias(SpyUserMultiFactorAuthCodesTableMap::COL_ID_USER_MULTI_FACTOR_AUTH_CODE, $spyUserMultiFactorAuthCodes->getIdUserMultiFactorAuthCode(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_user_multi_factor_auth_codes table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyUserMultiFactorAuthCodesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyUserMultiFactorAuthCodesTableMap::clearInstancePool();
            SpyUserMultiFactorAuthCodesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyUserMultiFactorAuthCodesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyUserMultiFactorAuthCodesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyUserMultiFactorAuthCodesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyUserMultiFactorAuthCodesTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(SpyUserMultiFactorAuthCodesTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyUserMultiFactorAuthCodesTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyUserMultiFactorAuthCodesTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyUserMultiFactorAuthCodesTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpyUserMultiFactorAuthCodesTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyUserMultiFactorAuthCodesTableMap::COL_CREATED_AT);

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
