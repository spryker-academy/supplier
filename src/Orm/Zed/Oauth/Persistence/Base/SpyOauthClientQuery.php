<?php

namespace Orm\Zed\Oauth\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\OauthRevoke\Persistence\SpyOauthRefreshToken;
use Orm\Zed\Oauth\Persistence\SpyOauthClient as ChildSpyOauthClient;
use Orm\Zed\Oauth\Persistence\SpyOauthClientQuery as ChildSpyOauthClientQuery;
use Orm\Zed\Oauth\Persistence\Map\SpyOauthClientTableMap;
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
 * Base class that represents a query for the `spy_oauth_client` table.
 *
 * @method     ChildSpyOauthClientQuery orderByIdOauthClient($order = Criteria::ASC) Order by the id_oauth_client column
 * @method     ChildSpyOauthClientQuery orderByIdentifier($order = Criteria::ASC) Order by the identifier column
 * @method     ChildSpyOauthClientQuery orderByIsConfidential($order = Criteria::ASC) Order by the is_confidential column
 * @method     ChildSpyOauthClientQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildSpyOauthClientQuery orderByRedirectUri($order = Criteria::ASC) Order by the redirect_uri column
 * @method     ChildSpyOauthClientQuery orderBySecret($order = Criteria::ASC) Order by the secret column
 *
 * @method     ChildSpyOauthClientQuery groupByIdOauthClient() Group by the id_oauth_client column
 * @method     ChildSpyOauthClientQuery groupByIdentifier() Group by the identifier column
 * @method     ChildSpyOauthClientQuery groupByIsConfidential() Group by the is_confidential column
 * @method     ChildSpyOauthClientQuery groupByName() Group by the name column
 * @method     ChildSpyOauthClientQuery groupByRedirectUri() Group by the redirect_uri column
 * @method     ChildSpyOauthClientQuery groupBySecret() Group by the secret column
 *
 * @method     ChildSpyOauthClientQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyOauthClientQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyOauthClientQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyOauthClientQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyOauthClientQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyOauthClientQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyOauthClientQuery leftJoinOauthAccessToken($relationAlias = null) Adds a LEFT JOIN clause to the query using the OauthAccessToken relation
 * @method     ChildSpyOauthClientQuery rightJoinOauthAccessToken($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OauthAccessToken relation
 * @method     ChildSpyOauthClientQuery innerJoinOauthAccessToken($relationAlias = null) Adds a INNER JOIN clause to the query using the OauthAccessToken relation
 *
 * @method     ChildSpyOauthClientQuery joinWithOauthAccessToken($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OauthAccessToken relation
 *
 * @method     ChildSpyOauthClientQuery leftJoinWithOauthAccessToken() Adds a LEFT JOIN clause and with to the query using the OauthAccessToken relation
 * @method     ChildSpyOauthClientQuery rightJoinWithOauthAccessToken() Adds a RIGHT JOIN clause and with to the query using the OauthAccessToken relation
 * @method     ChildSpyOauthClientQuery innerJoinWithOauthAccessToken() Adds a INNER JOIN clause and with to the query using the OauthAccessToken relation
 *
 * @method     ChildSpyOauthClientQuery leftJoinSpyOauthRefreshToken($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyOauthRefreshToken relation
 * @method     ChildSpyOauthClientQuery rightJoinSpyOauthRefreshToken($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyOauthRefreshToken relation
 * @method     ChildSpyOauthClientQuery innerJoinSpyOauthRefreshToken($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyOauthRefreshToken relation
 *
 * @method     ChildSpyOauthClientQuery joinWithSpyOauthRefreshToken($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyOauthRefreshToken relation
 *
 * @method     ChildSpyOauthClientQuery leftJoinWithSpyOauthRefreshToken() Adds a LEFT JOIN clause and with to the query using the SpyOauthRefreshToken relation
 * @method     ChildSpyOauthClientQuery rightJoinWithSpyOauthRefreshToken() Adds a RIGHT JOIN clause and with to the query using the SpyOauthRefreshToken relation
 * @method     ChildSpyOauthClientQuery innerJoinWithSpyOauthRefreshToken() Adds a INNER JOIN clause and with to the query using the SpyOauthRefreshToken relation
 *
 * @method     \Orm\Zed\Oauth\Persistence\SpyOauthAccessTokenQuery|\Orm\Zed\OauthRevoke\Persistence\SpyOauthRefreshTokenQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyOauthClient|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyOauthClient matching the query
 * @method     ChildSpyOauthClient findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyOauthClient matching the query, or a new ChildSpyOauthClient object populated from the query conditions when no match is found
 *
 * @method     ChildSpyOauthClient|null findOneByIdOauthClient(int $id_oauth_client) Return the first ChildSpyOauthClient filtered by the id_oauth_client column
 * @method     ChildSpyOauthClient|null findOneByIdentifier(string $identifier) Return the first ChildSpyOauthClient filtered by the identifier column
 * @method     ChildSpyOauthClient|null findOneByIsConfidential(boolean $is_confidential) Return the first ChildSpyOauthClient filtered by the is_confidential column
 * @method     ChildSpyOauthClient|null findOneByName(string $name) Return the first ChildSpyOauthClient filtered by the name column
 * @method     ChildSpyOauthClient|null findOneByRedirectUri(string $redirect_uri) Return the first ChildSpyOauthClient filtered by the redirect_uri column
 * @method     ChildSpyOauthClient|null findOneBySecret(string $secret) Return the first ChildSpyOauthClient filtered by the secret column
 *
 * @method     ChildSpyOauthClient requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyOauthClient by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyOauthClient requireOne(?ConnectionInterface $con = null) Return the first ChildSpyOauthClient matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyOauthClient requireOneByIdOauthClient(int $id_oauth_client) Return the first ChildSpyOauthClient filtered by the id_oauth_client column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyOauthClient requireOneByIdentifier(string $identifier) Return the first ChildSpyOauthClient filtered by the identifier column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyOauthClient requireOneByIsConfidential(boolean $is_confidential) Return the first ChildSpyOauthClient filtered by the is_confidential column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyOauthClient requireOneByName(string $name) Return the first ChildSpyOauthClient filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyOauthClient requireOneByRedirectUri(string $redirect_uri) Return the first ChildSpyOauthClient filtered by the redirect_uri column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyOauthClient requireOneBySecret(string $secret) Return the first ChildSpyOauthClient filtered by the secret column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyOauthClient[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyOauthClient objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyOauthClient> find(?ConnectionInterface $con = null) Return ChildSpyOauthClient objects based on current ModelCriteria
 *
 * @method     ChildSpyOauthClient[]|Collection findByIdOauthClient(int|array<int> $id_oauth_client) Return ChildSpyOauthClient objects filtered by the id_oauth_client column
 * @psalm-method Collection&\Traversable<ChildSpyOauthClient> findByIdOauthClient(int|array<int> $id_oauth_client) Return ChildSpyOauthClient objects filtered by the id_oauth_client column
 * @method     ChildSpyOauthClient[]|Collection findByIdentifier(string|array<string> $identifier) Return ChildSpyOauthClient objects filtered by the identifier column
 * @psalm-method Collection&\Traversable<ChildSpyOauthClient> findByIdentifier(string|array<string> $identifier) Return ChildSpyOauthClient objects filtered by the identifier column
 * @method     ChildSpyOauthClient[]|Collection findByIsConfidential(boolean|array<boolean> $is_confidential) Return ChildSpyOauthClient objects filtered by the is_confidential column
 * @psalm-method Collection&\Traversable<ChildSpyOauthClient> findByIsConfidential(boolean|array<boolean> $is_confidential) Return ChildSpyOauthClient objects filtered by the is_confidential column
 * @method     ChildSpyOauthClient[]|Collection findByName(string|array<string> $name) Return ChildSpyOauthClient objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildSpyOauthClient> findByName(string|array<string> $name) Return ChildSpyOauthClient objects filtered by the name column
 * @method     ChildSpyOauthClient[]|Collection findByRedirectUri(string|array<string> $redirect_uri) Return ChildSpyOauthClient objects filtered by the redirect_uri column
 * @psalm-method Collection&\Traversable<ChildSpyOauthClient> findByRedirectUri(string|array<string> $redirect_uri) Return ChildSpyOauthClient objects filtered by the redirect_uri column
 * @method     ChildSpyOauthClient[]|Collection findBySecret(string|array<string> $secret) Return ChildSpyOauthClient objects filtered by the secret column
 * @psalm-method Collection&\Traversable<ChildSpyOauthClient> findBySecret(string|array<string> $secret) Return ChildSpyOauthClient objects filtered by the secret column
 *
 * @method     ChildSpyOauthClient[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyOauthClient> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyOauthClientQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\Oauth\Persistence\Base\SpyOauthClientQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\Oauth\\Persistence\\SpyOauthClient', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyOauthClientQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyOauthClientQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyOauthClientQuery) {
            return $criteria;
        }
        $query = new ChildSpyOauthClientQuery();
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
     * @return ChildSpyOauthClient|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyOauthClientTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyOauthClient A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id_oauth_client`, `identifier`, `is_confidential`, `name`, `redirect_uri`, `secret` FROM `spy_oauth_client` WHERE `id_oauth_client` = :p0';
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
            /** @var ChildSpyOauthClient $obj */
            $obj = new ChildSpyOauthClient();
            $obj->hydrate($row);
            SpyOauthClientTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyOauthClient|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyOauthClientTableMap::COL_ID_OAUTH_CLIENT, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyOauthClientTableMap::COL_ID_OAUTH_CLIENT, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idOauthClient Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdOauthClient_Between(array $idOauthClient)
    {
        return $this->filterByIdOauthClient($idOauthClient, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idOauthClients Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdOauthClient_In(array $idOauthClients)
    {
        return $this->filterByIdOauthClient($idOauthClients, Criteria::IN);
    }

    /**
     * Filter the query on the id_oauth_client column
     *
     * Example usage:
     * <code>
     * $query->filterByIdOauthClient(1234); // WHERE id_oauth_client = 1234
     * $query->filterByIdOauthClient(array(12, 34), Criteria::IN); // WHERE id_oauth_client IN (12, 34)
     * $query->filterByIdOauthClient(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_oauth_client > 12
     * </code>
     *
     * @param     mixed $idOauthClient The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdOauthClient($idOauthClient = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idOauthClient)) {
            $useMinMax = false;
            if (isset($idOauthClient['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyOauthClientTableMap::COL_ID_OAUTH_CLIENT, $idOauthClient['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idOauthClient['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyOauthClientTableMap::COL_ID_OAUTH_CLIENT, $idOauthClient['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idOauthClient of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyOauthClientTableMap::COL_ID_OAUTH_CLIENT, $idOauthClient, $comparison);

        return $query;
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
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $identifier Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdentifier_Like($identifier)
    {
        return $this->filterByIdentifier($identifier, Criteria::LIKE);
    }

    /**
     * Filter the query on the identifier column
     *
     * Example usage:
     * <code>
     * $query->filterByIdentifier('fooValue');   // WHERE identifier = 'fooValue'
     * $query->filterByIdentifier('%fooValue%', Criteria::LIKE); // WHERE identifier LIKE '%fooValue%'
     * $query->filterByIdentifier([1, 'foo'], Criteria::IN); // WHERE identifier IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $identifier The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdentifier($identifier = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $identifier = str_replace('*', '%', $identifier);
        }

        if (is_array($identifier) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$identifier of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyOauthClientTableMap::COL_IDENTIFIER, $identifier, $comparison);

        return $query;
    }

    /**
     * Filter the query on the is_confidential column
     *
     * Example usage:
     * <code>
     * $query->filterByIsConfidential(true); // WHERE is_confidential = true
     * $query->filterByIsConfidential('yes'); // WHERE is_confidential = true
     * </code>
     *
     * @param     bool|string $isConfidential The value to use as filter.
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
    public function filterByIsConfidential($isConfidential = null, $comparison = Criteria::EQUAL)
    {
        if (is_string($isConfidential)) {
            $isConfidential = in_array(strtolower($isConfidential), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $query = $this->addUsingAlias(SpyOauthClientTableMap::COL_IS_CONFIDENTIAL, $isConfidential, $comparison);

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

        $query = $this->addUsingAlias(SpyOauthClientTableMap::COL_NAME, $name, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $redirectUris Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRedirectUri_In(array $redirectUris)
    {
        return $this->filterByRedirectUri($redirectUris, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $redirectUri Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRedirectUri_Like($redirectUri)
    {
        return $this->filterByRedirectUri($redirectUri, Criteria::LIKE);
    }

    /**
     * Filter the query on the redirect_uri column
     *
     * Example usage:
     * <code>
     * $query->filterByRedirectUri('fooValue');   // WHERE redirect_uri = 'fooValue'
     * $query->filterByRedirectUri('%fooValue%', Criteria::LIKE); // WHERE redirect_uri LIKE '%fooValue%'
     * $query->filterByRedirectUri([1, 'foo'], Criteria::IN); // WHERE redirect_uri IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $redirectUri The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByRedirectUri($redirectUri = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $redirectUri = str_replace('*', '%', $redirectUri);
        }

        if (is_array($redirectUri) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$redirectUri of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyOauthClientTableMap::COL_REDIRECT_URI, $redirectUri, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $secrets Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySecret_In(array $secrets)
    {
        return $this->filterBySecret($secrets, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $secret Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySecret_Like($secret)
    {
        return $this->filterBySecret($secret, Criteria::LIKE);
    }

    /**
     * Filter the query on the secret column
     *
     * Example usage:
     * <code>
     * $query->filterBySecret('fooValue');   // WHERE secret = 'fooValue'
     * $query->filterBySecret('%fooValue%', Criteria::LIKE); // WHERE secret LIKE '%fooValue%'
     * $query->filterBySecret([1, 'foo'], Criteria::IN); // WHERE secret IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $secret The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterBySecret($secret = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $secret = str_replace('*', '%', $secret);
        }

        if (is_array($secret) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$secret of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyOauthClientTableMap::COL_SECRET, $secret, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Oauth\Persistence\SpyOauthAccessToken object
     *
     * @param \Orm\Zed\Oauth\Persistence\SpyOauthAccessToken|ObjectCollection $spyOauthAccessToken the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOauthAccessToken($spyOauthAccessToken, ?string $comparison = null)
    {
        if ($spyOauthAccessToken instanceof \Orm\Zed\Oauth\Persistence\SpyOauthAccessToken) {
            $this
                ->addUsingAlias(SpyOauthClientTableMap::COL_IDENTIFIER, $spyOauthAccessToken->getFkOauthClient(), $comparison);

            return $this;
        } elseif ($spyOauthAccessToken instanceof ObjectCollection) {
            $this
                ->useOauthAccessTokenQuery()
                ->filterByPrimaryKeys($spyOauthAccessToken->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOauthAccessToken() only accepts arguments of type \Orm\Zed\Oauth\Persistence\SpyOauthAccessToken or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OauthAccessToken relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOauthAccessToken(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OauthAccessToken');

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
            $this->addJoinObject($join, 'OauthAccessToken');
        }

        return $this;
    }

    /**
     * Use the OauthAccessToken relation SpyOauthAccessToken object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Oauth\Persistence\SpyOauthAccessTokenQuery A secondary query class using the current class as primary query
     */
    public function useOauthAccessTokenQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOauthAccessToken($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OauthAccessToken', '\Orm\Zed\Oauth\Persistence\SpyOauthAccessTokenQuery');
    }

    /**
     * Use the OauthAccessToken relation SpyOauthAccessToken object
     *
     * @param callable(\Orm\Zed\Oauth\Persistence\SpyOauthAccessTokenQuery):\Orm\Zed\Oauth\Persistence\SpyOauthAccessTokenQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOauthAccessTokenQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOauthAccessTokenQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the OauthAccessToken relation to the SpyOauthAccessToken table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Oauth\Persistence\SpyOauthAccessTokenQuery The inner query object of the EXISTS statement
     */
    public function useOauthAccessTokenExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Oauth\Persistence\SpyOauthAccessTokenQuery */
        $q = $this->useExistsQuery('OauthAccessToken', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the OauthAccessToken relation to the SpyOauthAccessToken table for a NOT EXISTS query.
     *
     * @see useOauthAccessTokenExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Oauth\Persistence\SpyOauthAccessTokenQuery The inner query object of the NOT EXISTS statement
     */
    public function useOauthAccessTokenNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Oauth\Persistence\SpyOauthAccessTokenQuery */
        $q = $this->useExistsQuery('OauthAccessToken', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the OauthAccessToken relation to the SpyOauthAccessToken table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Oauth\Persistence\SpyOauthAccessTokenQuery The inner query object of the IN statement
     */
    public function useInOauthAccessTokenQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Oauth\Persistence\SpyOauthAccessTokenQuery */
        $q = $this->useInQuery('OauthAccessToken', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the OauthAccessToken relation to the SpyOauthAccessToken table for a NOT IN query.
     *
     * @see useOauthAccessTokenInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Oauth\Persistence\SpyOauthAccessTokenQuery The inner query object of the NOT IN statement
     */
    public function useNotInOauthAccessTokenQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Oauth\Persistence\SpyOauthAccessTokenQuery */
        $q = $this->useInQuery('OauthAccessToken', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\OauthRevoke\Persistence\SpyOauthRefreshToken object
     *
     * @param \Orm\Zed\OauthRevoke\Persistence\SpyOauthRefreshToken|ObjectCollection $spyOauthRefreshToken the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyOauthRefreshToken($spyOauthRefreshToken, ?string $comparison = null)
    {
        if ($spyOauthRefreshToken instanceof \Orm\Zed\OauthRevoke\Persistence\SpyOauthRefreshToken) {
            $this
                ->addUsingAlias(SpyOauthClientTableMap::COL_IDENTIFIER, $spyOauthRefreshToken->getFkOauthClient(), $comparison);

            return $this;
        } elseif ($spyOauthRefreshToken instanceof ObjectCollection) {
            $this
                ->useSpyOauthRefreshTokenQuery()
                ->filterByPrimaryKeys($spyOauthRefreshToken->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyOauthRefreshToken() only accepts arguments of type \Orm\Zed\OauthRevoke\Persistence\SpyOauthRefreshToken or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyOauthRefreshToken relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyOauthRefreshToken(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyOauthRefreshToken');

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
            $this->addJoinObject($join, 'SpyOauthRefreshToken');
        }

        return $this;
    }

    /**
     * Use the SpyOauthRefreshToken relation SpyOauthRefreshToken object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\OauthRevoke\Persistence\SpyOauthRefreshTokenQuery A secondary query class using the current class as primary query
     */
    public function useSpyOauthRefreshTokenQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyOauthRefreshToken($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyOauthRefreshToken', '\Orm\Zed\OauthRevoke\Persistence\SpyOauthRefreshTokenQuery');
    }

    /**
     * Use the SpyOauthRefreshToken relation SpyOauthRefreshToken object
     *
     * @param callable(\Orm\Zed\OauthRevoke\Persistence\SpyOauthRefreshTokenQuery):\Orm\Zed\OauthRevoke\Persistence\SpyOauthRefreshTokenQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyOauthRefreshTokenQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyOauthRefreshTokenQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyOauthRefreshToken table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\OauthRevoke\Persistence\SpyOauthRefreshTokenQuery The inner query object of the EXISTS statement
     */
    public function useSpyOauthRefreshTokenExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\OauthRevoke\Persistence\SpyOauthRefreshTokenQuery */
        $q = $this->useExistsQuery('SpyOauthRefreshToken', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyOauthRefreshToken table for a NOT EXISTS query.
     *
     * @see useSpyOauthRefreshTokenExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\OauthRevoke\Persistence\SpyOauthRefreshTokenQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyOauthRefreshTokenNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\OauthRevoke\Persistence\SpyOauthRefreshTokenQuery */
        $q = $this->useExistsQuery('SpyOauthRefreshToken', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyOauthRefreshToken table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\OauthRevoke\Persistence\SpyOauthRefreshTokenQuery The inner query object of the IN statement
     */
    public function useInSpyOauthRefreshTokenQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\OauthRevoke\Persistence\SpyOauthRefreshTokenQuery */
        $q = $this->useInQuery('SpyOauthRefreshToken', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyOauthRefreshToken table for a NOT IN query.
     *
     * @see useSpyOauthRefreshTokenInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\OauthRevoke\Persistence\SpyOauthRefreshTokenQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyOauthRefreshTokenQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\OauthRevoke\Persistence\SpyOauthRefreshTokenQuery */
        $q = $this->useInQuery('SpyOauthRefreshToken', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyOauthClient $spyOauthClient Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyOauthClient = null)
    {
        if ($spyOauthClient) {
            $this->addUsingAlias(SpyOauthClientTableMap::COL_ID_OAUTH_CLIENT, $spyOauthClient->getIdOauthClient(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_oauth_client table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyOauthClientTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyOauthClientTableMap::clearInstancePool();
            SpyOauthClientTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyOauthClientTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyOauthClientTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyOauthClientTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyOauthClientTableMap::clearRelatedInstancePool();

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
