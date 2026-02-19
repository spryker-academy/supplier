<?php

namespace Orm\Zed\OauthClient\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\OauthClient\Persistence\SpyOauthClientAccessTokenCache as ChildSpyOauthClientAccessTokenCache;
use Orm\Zed\OauthClient\Persistence\SpyOauthClientAccessTokenCacheQuery as ChildSpyOauthClientAccessTokenCacheQuery;
use Orm\Zed\OauthClient\Persistence\Map\SpyOauthClientAccessTokenCacheTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Spryker\Zed\PropelOrm\Business\Model\Formatter\TypeAwareSimpleArrayFormatter;
use Spryker\Zed\PropelOrm\Business\Runtime\ActiveQuery\Criteria as SprykerCriteria;
use Spryker\Zed\PropelReplicationCache\Business\PropelReplicationCacheFacade;
use Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException;

/**
 * Base class that represents a query for the `spy_oauth_client_access_token_cache` table.
 *
 * @method     ChildSpyOauthClientAccessTokenCacheQuery orderByIdSpyOauthClientAccessTokenCache($order = Criteria::ASC) Order by the id_spy_oauth_client_access_token_cache column
 * @method     ChildSpyOauthClientAccessTokenCacheQuery orderByCacheKey($order = Criteria::ASC) Order by the cache_key column
 * @method     ChildSpyOauthClientAccessTokenCacheQuery orderByAccessToken($order = Criteria::ASC) Order by the access_token column
 * @method     ChildSpyOauthClientAccessTokenCacheQuery orderByExpiresAt($order = Criteria::ASC) Order by the expires_at column
 * @method     ChildSpyOauthClientAccessTokenCacheQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 *
 * @method     ChildSpyOauthClientAccessTokenCacheQuery groupByIdSpyOauthClientAccessTokenCache() Group by the id_spy_oauth_client_access_token_cache column
 * @method     ChildSpyOauthClientAccessTokenCacheQuery groupByCacheKey() Group by the cache_key column
 * @method     ChildSpyOauthClientAccessTokenCacheQuery groupByAccessToken() Group by the access_token column
 * @method     ChildSpyOauthClientAccessTokenCacheQuery groupByExpiresAt() Group by the expires_at column
 * @method     ChildSpyOauthClientAccessTokenCacheQuery groupByCreatedAt() Group by the created_at column
 *
 * @method     ChildSpyOauthClientAccessTokenCacheQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyOauthClientAccessTokenCacheQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyOauthClientAccessTokenCacheQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyOauthClientAccessTokenCacheQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyOauthClientAccessTokenCacheQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyOauthClientAccessTokenCacheQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyOauthClientAccessTokenCache|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyOauthClientAccessTokenCache matching the query
 * @method     ChildSpyOauthClientAccessTokenCache findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyOauthClientAccessTokenCache matching the query, or a new ChildSpyOauthClientAccessTokenCache object populated from the query conditions when no match is found
 *
 * @method     ChildSpyOauthClientAccessTokenCache|null findOneByIdSpyOauthClientAccessTokenCache(int $id_spy_oauth_client_access_token_cache) Return the first ChildSpyOauthClientAccessTokenCache filtered by the id_spy_oauth_client_access_token_cache column
 * @method     ChildSpyOauthClientAccessTokenCache|null findOneByCacheKey(string $cache_key) Return the first ChildSpyOauthClientAccessTokenCache filtered by the cache_key column
 * @method     ChildSpyOauthClientAccessTokenCache|null findOneByAccessToken(string $access_token) Return the first ChildSpyOauthClientAccessTokenCache filtered by the access_token column
 * @method     ChildSpyOauthClientAccessTokenCache|null findOneByExpiresAt(string $expires_at) Return the first ChildSpyOauthClientAccessTokenCache filtered by the expires_at column
 * @method     ChildSpyOauthClientAccessTokenCache|null findOneByCreatedAt(string $created_at) Return the first ChildSpyOauthClientAccessTokenCache filtered by the created_at column
 *
 * @method     ChildSpyOauthClientAccessTokenCache requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyOauthClientAccessTokenCache by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyOauthClientAccessTokenCache requireOne(?ConnectionInterface $con = null) Return the first ChildSpyOauthClientAccessTokenCache matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyOauthClientAccessTokenCache requireOneByIdSpyOauthClientAccessTokenCache(int $id_spy_oauth_client_access_token_cache) Return the first ChildSpyOauthClientAccessTokenCache filtered by the id_spy_oauth_client_access_token_cache column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyOauthClientAccessTokenCache requireOneByCacheKey(string $cache_key) Return the first ChildSpyOauthClientAccessTokenCache filtered by the cache_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyOauthClientAccessTokenCache requireOneByAccessToken(string $access_token) Return the first ChildSpyOauthClientAccessTokenCache filtered by the access_token column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyOauthClientAccessTokenCache requireOneByExpiresAt(string $expires_at) Return the first ChildSpyOauthClientAccessTokenCache filtered by the expires_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyOauthClientAccessTokenCache requireOneByCreatedAt(string $created_at) Return the first ChildSpyOauthClientAccessTokenCache filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyOauthClientAccessTokenCache[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyOauthClientAccessTokenCache objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyOauthClientAccessTokenCache> find(?ConnectionInterface $con = null) Return ChildSpyOauthClientAccessTokenCache objects based on current ModelCriteria
 *
 * @method     ChildSpyOauthClientAccessTokenCache[]|Collection findByIdSpyOauthClientAccessTokenCache(int|array<int> $id_spy_oauth_client_access_token_cache) Return ChildSpyOauthClientAccessTokenCache objects filtered by the id_spy_oauth_client_access_token_cache column
 * @psalm-method Collection&\Traversable<ChildSpyOauthClientAccessTokenCache> findByIdSpyOauthClientAccessTokenCache(int|array<int> $id_spy_oauth_client_access_token_cache) Return ChildSpyOauthClientAccessTokenCache objects filtered by the id_spy_oauth_client_access_token_cache column
 * @method     ChildSpyOauthClientAccessTokenCache[]|Collection findByCacheKey(string|array<string> $cache_key) Return ChildSpyOauthClientAccessTokenCache objects filtered by the cache_key column
 * @psalm-method Collection&\Traversable<ChildSpyOauthClientAccessTokenCache> findByCacheKey(string|array<string> $cache_key) Return ChildSpyOauthClientAccessTokenCache objects filtered by the cache_key column
 * @method     ChildSpyOauthClientAccessTokenCache[]|Collection findByAccessToken(string|array<string> $access_token) Return ChildSpyOauthClientAccessTokenCache objects filtered by the access_token column
 * @psalm-method Collection&\Traversable<ChildSpyOauthClientAccessTokenCache> findByAccessToken(string|array<string> $access_token) Return ChildSpyOauthClientAccessTokenCache objects filtered by the access_token column
 * @method     ChildSpyOauthClientAccessTokenCache[]|Collection findByExpiresAt(string|array<string> $expires_at) Return ChildSpyOauthClientAccessTokenCache objects filtered by the expires_at column
 * @psalm-method Collection&\Traversable<ChildSpyOauthClientAccessTokenCache> findByExpiresAt(string|array<string> $expires_at) Return ChildSpyOauthClientAccessTokenCache objects filtered by the expires_at column
 * @method     ChildSpyOauthClientAccessTokenCache[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpyOauthClientAccessTokenCache objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpyOauthClientAccessTokenCache> findByCreatedAt(string|array<string> $created_at) Return ChildSpyOauthClientAccessTokenCache objects filtered by the created_at column
 *
 * @method     ChildSpyOauthClientAccessTokenCache[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyOauthClientAccessTokenCache> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyOauthClientAccessTokenCacheQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\OauthClient\Persistence\Base\SpyOauthClientAccessTokenCacheQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\OauthClient\\Persistence\\SpyOauthClientAccessTokenCache', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyOauthClientAccessTokenCacheQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyOauthClientAccessTokenCacheQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyOauthClientAccessTokenCacheQuery) {
            return $criteria;
        }
        $query = new ChildSpyOauthClientAccessTokenCacheQuery();
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
     * @return ChildSpyOauthClientAccessTokenCache|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyOauthClientAccessTokenCacheTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyOauthClientAccessTokenCache A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id_spy_oauth_client_access_token_cache`, `cache_key`, `access_token`, `expires_at`, `created_at` FROM `spy_oauth_client_access_token_cache` WHERE `id_spy_oauth_client_access_token_cache` = :p0';
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
            /** @var ChildSpyOauthClientAccessTokenCache $obj */
            $obj = new ChildSpyOauthClientAccessTokenCache();
            $obj->hydrate($row);
            SpyOauthClientAccessTokenCacheTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyOauthClientAccessTokenCache|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyOauthClientAccessTokenCacheTableMap::COL_ID_SPY_OAUTH_CLIENT_ACCESS_TOKEN_CACHE, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyOauthClientAccessTokenCacheTableMap::COL_ID_SPY_OAUTH_CLIENT_ACCESS_TOKEN_CACHE, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idSpyOauthClientAccessTokenCache Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdSpyOauthClientAccessTokenCache_Between(array $idSpyOauthClientAccessTokenCache)
    {
        return $this->filterByIdSpyOauthClientAccessTokenCache($idSpyOauthClientAccessTokenCache, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idSpyOauthClientAccessTokenCaches Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdSpyOauthClientAccessTokenCache_In(array $idSpyOauthClientAccessTokenCaches)
    {
        return $this->filterByIdSpyOauthClientAccessTokenCache($idSpyOauthClientAccessTokenCaches, Criteria::IN);
    }

    /**
     * Filter the query on the id_spy_oauth_client_access_token_cache column
     *
     * Example usage:
     * <code>
     * $query->filterByIdSpyOauthClientAccessTokenCache(1234); // WHERE id_spy_oauth_client_access_token_cache = 1234
     * $query->filterByIdSpyOauthClientAccessTokenCache(array(12, 34), Criteria::IN); // WHERE id_spy_oauth_client_access_token_cache IN (12, 34)
     * $query->filterByIdSpyOauthClientAccessTokenCache(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_spy_oauth_client_access_token_cache > 12
     * </code>
     *
     * @param     mixed $idSpyOauthClientAccessTokenCache The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdSpyOauthClientAccessTokenCache($idSpyOauthClientAccessTokenCache = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idSpyOauthClientAccessTokenCache)) {
            $useMinMax = false;
            if (isset($idSpyOauthClientAccessTokenCache['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyOauthClientAccessTokenCacheTableMap::COL_ID_SPY_OAUTH_CLIENT_ACCESS_TOKEN_CACHE, $idSpyOauthClientAccessTokenCache['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idSpyOauthClientAccessTokenCache['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyOauthClientAccessTokenCacheTableMap::COL_ID_SPY_OAUTH_CLIENT_ACCESS_TOKEN_CACHE, $idSpyOauthClientAccessTokenCache['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idSpyOauthClientAccessTokenCache of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyOauthClientAccessTokenCacheTableMap::COL_ID_SPY_OAUTH_CLIENT_ACCESS_TOKEN_CACHE, $idSpyOauthClientAccessTokenCache, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $cacheKeys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCacheKey_In(array $cacheKeys)
    {
        return $this->filterByCacheKey($cacheKeys, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $cacheKey Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCacheKey_Like($cacheKey)
    {
        return $this->filterByCacheKey($cacheKey, Criteria::LIKE);
    }

    /**
     * Filter the query on the cache_key column
     *
     * Example usage:
     * <code>
     * $query->filterByCacheKey('fooValue');   // WHERE cache_key = 'fooValue'
     * $query->filterByCacheKey('%fooValue%', Criteria::LIKE); // WHERE cache_key LIKE '%fooValue%'
     * $query->filterByCacheKey([1, 'foo'], Criteria::IN); // WHERE cache_key IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $cacheKey The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByCacheKey($cacheKey = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $cacheKey = str_replace('*', '%', $cacheKey);
        }

        if (is_array($cacheKey) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$cacheKey of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyOauthClientAccessTokenCacheTableMap::COL_CACHE_KEY, $cacheKey, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $accessTokens Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAccessToken_In(array $accessTokens)
    {
        return $this->filterByAccessToken($accessTokens, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $accessToken Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAccessToken_Like($accessToken)
    {
        return $this->filterByAccessToken($accessToken, Criteria::LIKE);
    }

    /**
     * Filter the query on the access_token column
     *
     * Example usage:
     * <code>
     * $query->filterByAccessToken('fooValue');   // WHERE access_token = 'fooValue'
     * $query->filterByAccessToken('%fooValue%', Criteria::LIKE); // WHERE access_token LIKE '%fooValue%'
     * $query->filterByAccessToken([1, 'foo'], Criteria::IN); // WHERE access_token IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $accessToken The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAccessToken($accessToken = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $accessToken = str_replace('*', '%', $accessToken);
        }

        if (is_array($accessToken) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$accessToken of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyOauthClientAccessTokenCacheTableMap::COL_ACCESS_TOKEN, $accessToken, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $expiresAt Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpiresAt_Between(array $expiresAt)
    {
        return $this->filterByExpiresAt($expiresAt, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $expiresAts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpiresAt_In(array $expiresAts)
    {
        return $this->filterByExpiresAt($expiresAts, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $expiresAt Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpiresAt_Like($expiresAt)
    {
        return $this->filterByExpiresAt($expiresAt, Criteria::LIKE);
    }

    /**
     * Filter the query on the expires_at column
     *
     * Example usage:
     * <code>
     * $query->filterByExpiresAt('2011-03-14'); // WHERE expires_at = '2011-03-14'
     * $query->filterByExpiresAt('now'); // WHERE expires_at = '2011-03-14'
     * $query->filterByExpiresAt(array('max' => 'yesterday'), SprykerCriteria::BETWEEN); // WHERE expires_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $expiresAt The value to use as filter.
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
    public function filterByExpiresAt($expiresAt = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($expiresAt)) {
            $useMinMax = false;
            if (isset($expiresAt['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyOauthClientAccessTokenCacheTableMap::COL_EXPIRES_AT, $expiresAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expiresAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyOauthClientAccessTokenCacheTableMap::COL_EXPIRES_AT, $expiresAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$expiresAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyOauthClientAccessTokenCacheTableMap::COL_EXPIRES_AT, $expiresAt, $comparison);

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
                $this->addUsingAlias(SpyOauthClientAccessTokenCacheTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyOauthClientAccessTokenCacheTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyOauthClientAccessTokenCacheTableMap::COL_CREATED_AT, $createdAt, $comparison);

        return $query;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyOauthClientAccessTokenCache $spyOauthClientAccessTokenCache Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyOauthClientAccessTokenCache = null)
    {
        if ($spyOauthClientAccessTokenCache) {
            $this->addUsingAlias(SpyOauthClientAccessTokenCacheTableMap::COL_ID_SPY_OAUTH_CLIENT_ACCESS_TOKEN_CACHE, $spyOauthClientAccessTokenCache->getIdSpyOauthClientAccessTokenCache(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_oauth_client_access_token_cache table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyOauthClientAccessTokenCacheTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyOauthClientAccessTokenCacheTableMap::clearInstancePool();
            SpyOauthClientAccessTokenCacheTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyOauthClientAccessTokenCacheTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyOauthClientAccessTokenCacheTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyOauthClientAccessTokenCacheTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyOauthClientAccessTokenCacheTableMap::clearRelatedInstancePool();

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
        $this->addDescendingOrderByColumn(SpyOauthClientAccessTokenCacheTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpyOauthClientAccessTokenCacheTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyOauthClientAccessTokenCacheTableMap::COL_CREATED_AT);

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
