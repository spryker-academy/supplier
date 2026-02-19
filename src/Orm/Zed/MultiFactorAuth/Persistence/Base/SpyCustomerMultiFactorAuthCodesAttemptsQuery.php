<?php

namespace Orm\Zed\MultiFactorAuth\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\MultiFactorAuth\Persistence\SpyCustomerMultiFactorAuthCodesAttempts as ChildSpyCustomerMultiFactorAuthCodesAttempts;
use Orm\Zed\MultiFactorAuth\Persistence\SpyCustomerMultiFactorAuthCodesAttemptsQuery as ChildSpyCustomerMultiFactorAuthCodesAttemptsQuery;
use Orm\Zed\MultiFactorAuth\Persistence\Map\SpyCustomerMultiFactorAuthCodesAttemptsTableMap;
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
 * Base class that represents a query for the `spy_customer_multi_factor_auth_codes_attempts` table.
 *
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttemptsQuery orderByIdCustomerMultiFactorAuthCodeAttempt($order = Criteria::ASC) Order by the id_customer_multi_factor_auth_code_attempt column
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttemptsQuery orderByFkCustomerMultiFactorAuthCode($order = Criteria::ASC) Order by the fk_customer_multi_factor_auth_code column
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttemptsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttemptsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttemptsQuery groupByIdCustomerMultiFactorAuthCodeAttempt() Group by the id_customer_multi_factor_auth_code_attempt column
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttemptsQuery groupByFkCustomerMultiFactorAuthCode() Group by the fk_customer_multi_factor_auth_code column
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttemptsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttemptsQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttemptsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttemptsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttemptsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttemptsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttemptsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttemptsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttemptsQuery leftJoinSpyCustomerMultiFactorAuthCodes($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCustomerMultiFactorAuthCodes relation
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttemptsQuery rightJoinSpyCustomerMultiFactorAuthCodes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCustomerMultiFactorAuthCodes relation
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttemptsQuery innerJoinSpyCustomerMultiFactorAuthCodes($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCustomerMultiFactorAuthCodes relation
 *
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttemptsQuery joinWithSpyCustomerMultiFactorAuthCodes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCustomerMultiFactorAuthCodes relation
 *
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttemptsQuery leftJoinWithSpyCustomerMultiFactorAuthCodes() Adds a LEFT JOIN clause and with to the query using the SpyCustomerMultiFactorAuthCodes relation
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttemptsQuery rightJoinWithSpyCustomerMultiFactorAuthCodes() Adds a RIGHT JOIN clause and with to the query using the SpyCustomerMultiFactorAuthCodes relation
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttemptsQuery innerJoinWithSpyCustomerMultiFactorAuthCodes() Adds a INNER JOIN clause and with to the query using the SpyCustomerMultiFactorAuthCodes relation
 *
 * @method     \Orm\Zed\MultiFactorAuth\Persistence\SpyCustomerMultiFactorAuthCodesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttempts|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyCustomerMultiFactorAuthCodesAttempts matching the query
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttempts findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyCustomerMultiFactorAuthCodesAttempts matching the query, or a new ChildSpyCustomerMultiFactorAuthCodesAttempts object populated from the query conditions when no match is found
 *
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttempts|null findOneByIdCustomerMultiFactorAuthCodeAttempt(int $id_customer_multi_factor_auth_code_attempt) Return the first ChildSpyCustomerMultiFactorAuthCodesAttempts filtered by the id_customer_multi_factor_auth_code_attempt column
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttempts|null findOneByFkCustomerMultiFactorAuthCode(int $fk_customer_multi_factor_auth_code) Return the first ChildSpyCustomerMultiFactorAuthCodesAttempts filtered by the fk_customer_multi_factor_auth_code column
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttempts|null findOneByCreatedAt(string $created_at) Return the first ChildSpyCustomerMultiFactorAuthCodesAttempts filtered by the created_at column
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttempts|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpyCustomerMultiFactorAuthCodesAttempts filtered by the updated_at column
 *
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttempts requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyCustomerMultiFactorAuthCodesAttempts by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttempts requireOne(?ConnectionInterface $con = null) Return the first ChildSpyCustomerMultiFactorAuthCodesAttempts matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttempts requireOneByIdCustomerMultiFactorAuthCodeAttempt(int $id_customer_multi_factor_auth_code_attempt) Return the first ChildSpyCustomerMultiFactorAuthCodesAttempts filtered by the id_customer_multi_factor_auth_code_attempt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttempts requireOneByFkCustomerMultiFactorAuthCode(int $fk_customer_multi_factor_auth_code) Return the first ChildSpyCustomerMultiFactorAuthCodesAttempts filtered by the fk_customer_multi_factor_auth_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttempts requireOneByCreatedAt(string $created_at) Return the first ChildSpyCustomerMultiFactorAuthCodesAttempts filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttempts requireOneByUpdatedAt(string $updated_at) Return the first ChildSpyCustomerMultiFactorAuthCodesAttempts filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttempts[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyCustomerMultiFactorAuthCodesAttempts objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyCustomerMultiFactorAuthCodesAttempts> find(?ConnectionInterface $con = null) Return ChildSpyCustomerMultiFactorAuthCodesAttempts objects based on current ModelCriteria
 *
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttempts[]|Collection findByIdCustomerMultiFactorAuthCodeAttempt(int|array<int> $id_customer_multi_factor_auth_code_attempt) Return ChildSpyCustomerMultiFactorAuthCodesAttempts objects filtered by the id_customer_multi_factor_auth_code_attempt column
 * @psalm-method Collection&\Traversable<ChildSpyCustomerMultiFactorAuthCodesAttempts> findByIdCustomerMultiFactorAuthCodeAttempt(int|array<int> $id_customer_multi_factor_auth_code_attempt) Return ChildSpyCustomerMultiFactorAuthCodesAttempts objects filtered by the id_customer_multi_factor_auth_code_attempt column
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttempts[]|Collection findByFkCustomerMultiFactorAuthCode(int|array<int> $fk_customer_multi_factor_auth_code) Return ChildSpyCustomerMultiFactorAuthCodesAttempts objects filtered by the fk_customer_multi_factor_auth_code column
 * @psalm-method Collection&\Traversable<ChildSpyCustomerMultiFactorAuthCodesAttempts> findByFkCustomerMultiFactorAuthCode(int|array<int> $fk_customer_multi_factor_auth_code) Return ChildSpyCustomerMultiFactorAuthCodesAttempts objects filtered by the fk_customer_multi_factor_auth_code column
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttempts[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpyCustomerMultiFactorAuthCodesAttempts objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpyCustomerMultiFactorAuthCodesAttempts> findByCreatedAt(string|array<string> $created_at) Return ChildSpyCustomerMultiFactorAuthCodesAttempts objects filtered by the created_at column
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttempts[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyCustomerMultiFactorAuthCodesAttempts objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpyCustomerMultiFactorAuthCodesAttempts> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyCustomerMultiFactorAuthCodesAttempts objects filtered by the updated_at column
 *
 * @method     ChildSpyCustomerMultiFactorAuthCodesAttempts[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyCustomerMultiFactorAuthCodesAttempts> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyCustomerMultiFactorAuthCodesAttemptsQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\MultiFactorAuth\Persistence\Base\SpyCustomerMultiFactorAuthCodesAttemptsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\MultiFactorAuth\\Persistence\\SpyCustomerMultiFactorAuthCodesAttempts', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyCustomerMultiFactorAuthCodesAttemptsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyCustomerMultiFactorAuthCodesAttemptsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyCustomerMultiFactorAuthCodesAttemptsQuery) {
            return $criteria;
        }
        $query = new ChildSpyCustomerMultiFactorAuthCodesAttemptsQuery();
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
     * @return ChildSpyCustomerMultiFactorAuthCodesAttempts|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyCustomerMultiFactorAuthCodesAttemptsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyCustomerMultiFactorAuthCodesAttempts A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_customer_multi_factor_auth_code_attempt, fk_customer_multi_factor_auth_code, created_at, updated_at FROM spy_customer_multi_factor_auth_codes_attempts WHERE id_customer_multi_factor_auth_code_attempt = :p0';
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
            /** @var ChildSpyCustomerMultiFactorAuthCodesAttempts $obj */
            $obj = new ChildSpyCustomerMultiFactorAuthCodesAttempts();
            $obj->hydrate($row);
            SpyCustomerMultiFactorAuthCodesAttemptsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyCustomerMultiFactorAuthCodesAttempts|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyCustomerMultiFactorAuthCodesAttemptsTableMap::COL_ID_CUSTOMER_MULTI_FACTOR_AUTH_CODE_ATTEMPT, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyCustomerMultiFactorAuthCodesAttemptsTableMap::COL_ID_CUSTOMER_MULTI_FACTOR_AUTH_CODE_ATTEMPT, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idCustomerMultiFactorAuthCodeAttempt Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdCustomerMultiFactorAuthCodeAttempt_Between(array $idCustomerMultiFactorAuthCodeAttempt)
    {
        return $this->filterByIdCustomerMultiFactorAuthCodeAttempt($idCustomerMultiFactorAuthCodeAttempt, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idCustomerMultiFactorAuthCodeAttempts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdCustomerMultiFactorAuthCodeAttempt_In(array $idCustomerMultiFactorAuthCodeAttempts)
    {
        return $this->filterByIdCustomerMultiFactorAuthCodeAttempt($idCustomerMultiFactorAuthCodeAttempts, Criteria::IN);
    }

    /**
     * Filter the query on the id_customer_multi_factor_auth_code_attempt column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCustomerMultiFactorAuthCodeAttempt(1234); // WHERE id_customer_multi_factor_auth_code_attempt = 1234
     * $query->filterByIdCustomerMultiFactorAuthCodeAttempt(array(12, 34), Criteria::IN); // WHERE id_customer_multi_factor_auth_code_attempt IN (12, 34)
     * $query->filterByIdCustomerMultiFactorAuthCodeAttempt(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_customer_multi_factor_auth_code_attempt > 12
     * </code>
     *
     * @param     mixed $idCustomerMultiFactorAuthCodeAttempt The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdCustomerMultiFactorAuthCodeAttempt($idCustomerMultiFactorAuthCodeAttempt = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idCustomerMultiFactorAuthCodeAttempt)) {
            $useMinMax = false;
            if (isset($idCustomerMultiFactorAuthCodeAttempt['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCustomerMultiFactorAuthCodesAttemptsTableMap::COL_ID_CUSTOMER_MULTI_FACTOR_AUTH_CODE_ATTEMPT, $idCustomerMultiFactorAuthCodeAttempt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCustomerMultiFactorAuthCodeAttempt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCustomerMultiFactorAuthCodesAttemptsTableMap::COL_ID_CUSTOMER_MULTI_FACTOR_AUTH_CODE_ATTEMPT, $idCustomerMultiFactorAuthCodeAttempt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idCustomerMultiFactorAuthCodeAttempt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCustomerMultiFactorAuthCodesAttemptsTableMap::COL_ID_CUSTOMER_MULTI_FACTOR_AUTH_CODE_ATTEMPT, $idCustomerMultiFactorAuthCodeAttempt, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkCustomerMultiFactorAuthCode Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCustomerMultiFactorAuthCode_Between(array $fkCustomerMultiFactorAuthCode)
    {
        return $this->filterByFkCustomerMultiFactorAuthCode($fkCustomerMultiFactorAuthCode, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkCustomerMultiFactorAuthCodes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCustomerMultiFactorAuthCode_In(array $fkCustomerMultiFactorAuthCodes)
    {
        return $this->filterByFkCustomerMultiFactorAuthCode($fkCustomerMultiFactorAuthCodes, Criteria::IN);
    }

    /**
     * Filter the query on the fk_customer_multi_factor_auth_code column
     *
     * Example usage:
     * <code>
     * $query->filterByFkCustomerMultiFactorAuthCode(1234); // WHERE fk_customer_multi_factor_auth_code = 1234
     * $query->filterByFkCustomerMultiFactorAuthCode(array(12, 34), Criteria::IN); // WHERE fk_customer_multi_factor_auth_code IN (12, 34)
     * $query->filterByFkCustomerMultiFactorAuthCode(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_customer_multi_factor_auth_code > 12
     * </code>
     *
     * @see       filterBySpyCustomerMultiFactorAuthCodes()
     *
     * @param     mixed $fkCustomerMultiFactorAuthCode The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkCustomerMultiFactorAuthCode($fkCustomerMultiFactorAuthCode = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkCustomerMultiFactorAuthCode)) {
            $useMinMax = false;
            if (isset($fkCustomerMultiFactorAuthCode['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCustomerMultiFactorAuthCodesAttemptsTableMap::COL_FK_CUSTOMER_MULTI_FACTOR_AUTH_CODE, $fkCustomerMultiFactorAuthCode['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkCustomerMultiFactorAuthCode['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCustomerMultiFactorAuthCodesAttemptsTableMap::COL_FK_CUSTOMER_MULTI_FACTOR_AUTH_CODE, $fkCustomerMultiFactorAuthCode['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkCustomerMultiFactorAuthCode of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCustomerMultiFactorAuthCodesAttemptsTableMap::COL_FK_CUSTOMER_MULTI_FACTOR_AUTH_CODE, $fkCustomerMultiFactorAuthCode, $comparison);

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
                $this->addUsingAlias(SpyCustomerMultiFactorAuthCodesAttemptsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCustomerMultiFactorAuthCodesAttemptsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCustomerMultiFactorAuthCodesAttemptsTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SpyCustomerMultiFactorAuthCodesAttemptsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCustomerMultiFactorAuthCodesAttemptsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCustomerMultiFactorAuthCodesAttemptsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\MultiFactorAuth\Persistence\SpyCustomerMultiFactorAuthCodes object
     *
     * @param \Orm\Zed\MultiFactorAuth\Persistence\SpyCustomerMultiFactorAuthCodes|ObjectCollection $spyCustomerMultiFactorAuthCodes The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCustomerMultiFactorAuthCodes($spyCustomerMultiFactorAuthCodes, ?string $comparison = null)
    {
        if ($spyCustomerMultiFactorAuthCodes instanceof \Orm\Zed\MultiFactorAuth\Persistence\SpyCustomerMultiFactorAuthCodes) {
            return $this
                ->addUsingAlias(SpyCustomerMultiFactorAuthCodesAttemptsTableMap::COL_FK_CUSTOMER_MULTI_FACTOR_AUTH_CODE, $spyCustomerMultiFactorAuthCodes->getIdCustomerMultiFactorAuthCode(), $comparison);
        } elseif ($spyCustomerMultiFactorAuthCodes instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyCustomerMultiFactorAuthCodesAttemptsTableMap::COL_FK_CUSTOMER_MULTI_FACTOR_AUTH_CODE, $spyCustomerMultiFactorAuthCodes->toKeyValue('PrimaryKey', 'IdCustomerMultiFactorAuthCode'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyCustomerMultiFactorAuthCodes() only accepts arguments of type \Orm\Zed\MultiFactorAuth\Persistence\SpyCustomerMultiFactorAuthCodes or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCustomerMultiFactorAuthCodes relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCustomerMultiFactorAuthCodes(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCustomerMultiFactorAuthCodes');

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
            $this->addJoinObject($join, 'SpyCustomerMultiFactorAuthCodes');
        }

        return $this;
    }

    /**
     * Use the SpyCustomerMultiFactorAuthCodes relation SpyCustomerMultiFactorAuthCodes object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MultiFactorAuth\Persistence\SpyCustomerMultiFactorAuthCodesQuery A secondary query class using the current class as primary query
     */
    public function useSpyCustomerMultiFactorAuthCodesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyCustomerMultiFactorAuthCodes($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCustomerMultiFactorAuthCodes', '\Orm\Zed\MultiFactorAuth\Persistence\SpyCustomerMultiFactorAuthCodesQuery');
    }

    /**
     * Use the SpyCustomerMultiFactorAuthCodes relation SpyCustomerMultiFactorAuthCodes object
     *
     * @param callable(\Orm\Zed\MultiFactorAuth\Persistence\SpyCustomerMultiFactorAuthCodesQuery):\Orm\Zed\MultiFactorAuth\Persistence\SpyCustomerMultiFactorAuthCodesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCustomerMultiFactorAuthCodesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyCustomerMultiFactorAuthCodesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyCustomerMultiFactorAuthCodes table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MultiFactorAuth\Persistence\SpyCustomerMultiFactorAuthCodesQuery The inner query object of the EXISTS statement
     */
    public function useSpyCustomerMultiFactorAuthCodesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MultiFactorAuth\Persistence\SpyCustomerMultiFactorAuthCodesQuery */
        $q = $this->useExistsQuery('SpyCustomerMultiFactorAuthCodes', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyCustomerMultiFactorAuthCodes table for a NOT EXISTS query.
     *
     * @see useSpyCustomerMultiFactorAuthCodesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MultiFactorAuth\Persistence\SpyCustomerMultiFactorAuthCodesQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCustomerMultiFactorAuthCodesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MultiFactorAuth\Persistence\SpyCustomerMultiFactorAuthCodesQuery */
        $q = $this->useExistsQuery('SpyCustomerMultiFactorAuthCodes', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyCustomerMultiFactorAuthCodes table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MultiFactorAuth\Persistence\SpyCustomerMultiFactorAuthCodesQuery The inner query object of the IN statement
     */
    public function useInSpyCustomerMultiFactorAuthCodesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MultiFactorAuth\Persistence\SpyCustomerMultiFactorAuthCodesQuery */
        $q = $this->useInQuery('SpyCustomerMultiFactorAuthCodes', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyCustomerMultiFactorAuthCodes table for a NOT IN query.
     *
     * @see useSpyCustomerMultiFactorAuthCodesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MultiFactorAuth\Persistence\SpyCustomerMultiFactorAuthCodesQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyCustomerMultiFactorAuthCodesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MultiFactorAuth\Persistence\SpyCustomerMultiFactorAuthCodesQuery */
        $q = $this->useInQuery('SpyCustomerMultiFactorAuthCodes', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyCustomerMultiFactorAuthCodesAttempts $spyCustomerMultiFactorAuthCodesAttempts Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyCustomerMultiFactorAuthCodesAttempts = null)
    {
        if ($spyCustomerMultiFactorAuthCodesAttempts) {
            $this->addUsingAlias(SpyCustomerMultiFactorAuthCodesAttemptsTableMap::COL_ID_CUSTOMER_MULTI_FACTOR_AUTH_CODE_ATTEMPT, $spyCustomerMultiFactorAuthCodesAttempts->getIdCustomerMultiFactorAuthCodeAttempt(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_customer_multi_factor_auth_codes_attempts table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCustomerMultiFactorAuthCodesAttemptsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyCustomerMultiFactorAuthCodesAttemptsTableMap::clearInstancePool();
            SpyCustomerMultiFactorAuthCodesAttemptsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCustomerMultiFactorAuthCodesAttemptsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyCustomerMultiFactorAuthCodesAttemptsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyCustomerMultiFactorAuthCodesAttemptsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyCustomerMultiFactorAuthCodesAttemptsTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(SpyCustomerMultiFactorAuthCodesAttemptsTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyCustomerMultiFactorAuthCodesAttemptsTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyCustomerMultiFactorAuthCodesAttemptsTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyCustomerMultiFactorAuthCodesAttemptsTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpyCustomerMultiFactorAuthCodesAttemptsTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyCustomerMultiFactorAuthCodesAttemptsTableMap::COL_CREATED_AT);

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
