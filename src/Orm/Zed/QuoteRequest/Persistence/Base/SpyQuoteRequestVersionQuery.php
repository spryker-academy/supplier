<?php

namespace Orm\Zed\QuoteRequest\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestVersion as ChildSpyQuoteRequestVersion;
use Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestVersionQuery as ChildSpyQuoteRequestVersionQuery;
use Orm\Zed\QuoteRequest\Persistence\Map\SpyQuoteRequestVersionTableMap;
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
 * Base class that represents a query for the `spy_quote_request_version` table.
 *
 * @method     ChildSpyQuoteRequestVersionQuery orderByIdQuoteRequestVersion($order = Criteria::ASC) Order by the id_quote_request_version column
 * @method     ChildSpyQuoteRequestVersionQuery orderByFkQuoteRequest($order = Criteria::ASC) Order by the fk_quote_request column
 * @method     ChildSpyQuoteRequestVersionQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildSpyQuoteRequestVersionQuery orderByVersionReference($order = Criteria::ASC) Order by the version_reference column
 * @method     ChildSpyQuoteRequestVersionQuery orderByMetadata($order = Criteria::ASC) Order by the metadata column
 * @method     ChildSpyQuoteRequestVersionQuery orderByQuote($order = Criteria::ASC) Order by the quote column
 * @method     ChildSpyQuoteRequestVersionQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpyQuoteRequestVersionQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpyQuoteRequestVersionQuery groupByIdQuoteRequestVersion() Group by the id_quote_request_version column
 * @method     ChildSpyQuoteRequestVersionQuery groupByFkQuoteRequest() Group by the fk_quote_request column
 * @method     ChildSpyQuoteRequestVersionQuery groupByVersion() Group by the version column
 * @method     ChildSpyQuoteRequestVersionQuery groupByVersionReference() Group by the version_reference column
 * @method     ChildSpyQuoteRequestVersionQuery groupByMetadata() Group by the metadata column
 * @method     ChildSpyQuoteRequestVersionQuery groupByQuote() Group by the quote column
 * @method     ChildSpyQuoteRequestVersionQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpyQuoteRequestVersionQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpyQuoteRequestVersionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyQuoteRequestVersionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyQuoteRequestVersionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyQuoteRequestVersionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyQuoteRequestVersionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyQuoteRequestVersionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyQuoteRequestVersionQuery leftJoinSpyQuoteRequest($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyQuoteRequest relation
 * @method     ChildSpyQuoteRequestVersionQuery rightJoinSpyQuoteRequest($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyQuoteRequest relation
 * @method     ChildSpyQuoteRequestVersionQuery innerJoinSpyQuoteRequest($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyQuoteRequest relation
 *
 * @method     ChildSpyQuoteRequestVersionQuery joinWithSpyQuoteRequest($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyQuoteRequest relation
 *
 * @method     ChildSpyQuoteRequestVersionQuery leftJoinWithSpyQuoteRequest() Adds a LEFT JOIN clause and with to the query using the SpyQuoteRequest relation
 * @method     ChildSpyQuoteRequestVersionQuery rightJoinWithSpyQuoteRequest() Adds a RIGHT JOIN clause and with to the query using the SpyQuoteRequest relation
 * @method     ChildSpyQuoteRequestVersionQuery innerJoinWithSpyQuoteRequest() Adds a INNER JOIN clause and with to the query using the SpyQuoteRequest relation
 *
 * @method     \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyQuoteRequestVersion|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyQuoteRequestVersion matching the query
 * @method     ChildSpyQuoteRequestVersion findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyQuoteRequestVersion matching the query, or a new ChildSpyQuoteRequestVersion object populated from the query conditions when no match is found
 *
 * @method     ChildSpyQuoteRequestVersion|null findOneByIdQuoteRequestVersion(int $id_quote_request_version) Return the first ChildSpyQuoteRequestVersion filtered by the id_quote_request_version column
 * @method     ChildSpyQuoteRequestVersion|null findOneByFkQuoteRequest(int $fk_quote_request) Return the first ChildSpyQuoteRequestVersion filtered by the fk_quote_request column
 * @method     ChildSpyQuoteRequestVersion|null findOneByVersion(int $version) Return the first ChildSpyQuoteRequestVersion filtered by the version column
 * @method     ChildSpyQuoteRequestVersion|null findOneByVersionReference(string $version_reference) Return the first ChildSpyQuoteRequestVersion filtered by the version_reference column
 * @method     ChildSpyQuoteRequestVersion|null findOneByMetadata(string $metadata) Return the first ChildSpyQuoteRequestVersion filtered by the metadata column
 * @method     ChildSpyQuoteRequestVersion|null findOneByQuote(string $quote) Return the first ChildSpyQuoteRequestVersion filtered by the quote column
 * @method     ChildSpyQuoteRequestVersion|null findOneByCreatedAt(string $created_at) Return the first ChildSpyQuoteRequestVersion filtered by the created_at column
 * @method     ChildSpyQuoteRequestVersion|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpyQuoteRequestVersion filtered by the updated_at column
 *
 * @method     ChildSpyQuoteRequestVersion requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyQuoteRequestVersion by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyQuoteRequestVersion requireOne(?ConnectionInterface $con = null) Return the first ChildSpyQuoteRequestVersion matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyQuoteRequestVersion requireOneByIdQuoteRequestVersion(int $id_quote_request_version) Return the first ChildSpyQuoteRequestVersion filtered by the id_quote_request_version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyQuoteRequestVersion requireOneByFkQuoteRequest(int $fk_quote_request) Return the first ChildSpyQuoteRequestVersion filtered by the fk_quote_request column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyQuoteRequestVersion requireOneByVersion(int $version) Return the first ChildSpyQuoteRequestVersion filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyQuoteRequestVersion requireOneByVersionReference(string $version_reference) Return the first ChildSpyQuoteRequestVersion filtered by the version_reference column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyQuoteRequestVersion requireOneByMetadata(string $metadata) Return the first ChildSpyQuoteRequestVersion filtered by the metadata column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyQuoteRequestVersion requireOneByQuote(string $quote) Return the first ChildSpyQuoteRequestVersion filtered by the quote column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyQuoteRequestVersion requireOneByCreatedAt(string $created_at) Return the first ChildSpyQuoteRequestVersion filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyQuoteRequestVersion requireOneByUpdatedAt(string $updated_at) Return the first ChildSpyQuoteRequestVersion filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyQuoteRequestVersion[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyQuoteRequestVersion objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyQuoteRequestVersion> find(?ConnectionInterface $con = null) Return ChildSpyQuoteRequestVersion objects based on current ModelCriteria
 *
 * @method     ChildSpyQuoteRequestVersion[]|Collection findByIdQuoteRequestVersion(int|array<int> $id_quote_request_version) Return ChildSpyQuoteRequestVersion objects filtered by the id_quote_request_version column
 * @psalm-method Collection&\Traversable<ChildSpyQuoteRequestVersion> findByIdQuoteRequestVersion(int|array<int> $id_quote_request_version) Return ChildSpyQuoteRequestVersion objects filtered by the id_quote_request_version column
 * @method     ChildSpyQuoteRequestVersion[]|Collection findByFkQuoteRequest(int|array<int> $fk_quote_request) Return ChildSpyQuoteRequestVersion objects filtered by the fk_quote_request column
 * @psalm-method Collection&\Traversable<ChildSpyQuoteRequestVersion> findByFkQuoteRequest(int|array<int> $fk_quote_request) Return ChildSpyQuoteRequestVersion objects filtered by the fk_quote_request column
 * @method     ChildSpyQuoteRequestVersion[]|Collection findByVersion(int|array<int> $version) Return ChildSpyQuoteRequestVersion objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildSpyQuoteRequestVersion> findByVersion(int|array<int> $version) Return ChildSpyQuoteRequestVersion objects filtered by the version column
 * @method     ChildSpyQuoteRequestVersion[]|Collection findByVersionReference(string|array<string> $version_reference) Return ChildSpyQuoteRequestVersion objects filtered by the version_reference column
 * @psalm-method Collection&\Traversable<ChildSpyQuoteRequestVersion> findByVersionReference(string|array<string> $version_reference) Return ChildSpyQuoteRequestVersion objects filtered by the version_reference column
 * @method     ChildSpyQuoteRequestVersion[]|Collection findByMetadata(string|array<string> $metadata) Return ChildSpyQuoteRequestVersion objects filtered by the metadata column
 * @psalm-method Collection&\Traversable<ChildSpyQuoteRequestVersion> findByMetadata(string|array<string> $metadata) Return ChildSpyQuoteRequestVersion objects filtered by the metadata column
 * @method     ChildSpyQuoteRequestVersion[]|Collection findByQuote(string|array<string> $quote) Return ChildSpyQuoteRequestVersion objects filtered by the quote column
 * @psalm-method Collection&\Traversable<ChildSpyQuoteRequestVersion> findByQuote(string|array<string> $quote) Return ChildSpyQuoteRequestVersion objects filtered by the quote column
 * @method     ChildSpyQuoteRequestVersion[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpyQuoteRequestVersion objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpyQuoteRequestVersion> findByCreatedAt(string|array<string> $created_at) Return ChildSpyQuoteRequestVersion objects filtered by the created_at column
 * @method     ChildSpyQuoteRequestVersion[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyQuoteRequestVersion objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpyQuoteRequestVersion> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyQuoteRequestVersion objects filtered by the updated_at column
 *
 * @method     ChildSpyQuoteRequestVersion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyQuoteRequestVersion> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyQuoteRequestVersionQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\QuoteRequest\Persistence\Base\SpyQuoteRequestVersionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\QuoteRequest\\Persistence\\SpyQuoteRequestVersion', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyQuoteRequestVersionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyQuoteRequestVersionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyQuoteRequestVersionQuery) {
            return $criteria;
        }
        $query = new ChildSpyQuoteRequestVersionQuery();
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
     * @return ChildSpyQuoteRequestVersion|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyQuoteRequestVersionTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyQuoteRequestVersion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_quote_request_version, fk_quote_request, version, version_reference, metadata, quote, created_at, updated_at FROM spy_quote_request_version WHERE id_quote_request_version = :p0';
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
            /** @var ChildSpyQuoteRequestVersion $obj */
            $obj = new ChildSpyQuoteRequestVersion();
            $obj->hydrate($row);
            SpyQuoteRequestVersionTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyQuoteRequestVersion|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyQuoteRequestVersionTableMap::COL_ID_QUOTE_REQUEST_VERSION, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyQuoteRequestVersionTableMap::COL_ID_QUOTE_REQUEST_VERSION, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idQuoteRequestVersion Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdQuoteRequestVersion_Between(array $idQuoteRequestVersion)
    {
        return $this->filterByIdQuoteRequestVersion($idQuoteRequestVersion, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idQuoteRequestVersions Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdQuoteRequestVersion_In(array $idQuoteRequestVersions)
    {
        return $this->filterByIdQuoteRequestVersion($idQuoteRequestVersions, Criteria::IN);
    }

    /**
     * Filter the query on the id_quote_request_version column
     *
     * Example usage:
     * <code>
     * $query->filterByIdQuoteRequestVersion(1234); // WHERE id_quote_request_version = 1234
     * $query->filterByIdQuoteRequestVersion(array(12, 34), Criteria::IN); // WHERE id_quote_request_version IN (12, 34)
     * $query->filterByIdQuoteRequestVersion(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_quote_request_version > 12
     * </code>
     *
     * @param     mixed $idQuoteRequestVersion The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdQuoteRequestVersion($idQuoteRequestVersion = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idQuoteRequestVersion)) {
            $useMinMax = false;
            if (isset($idQuoteRequestVersion['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyQuoteRequestVersionTableMap::COL_ID_QUOTE_REQUEST_VERSION, $idQuoteRequestVersion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idQuoteRequestVersion['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyQuoteRequestVersionTableMap::COL_ID_QUOTE_REQUEST_VERSION, $idQuoteRequestVersion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idQuoteRequestVersion of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyQuoteRequestVersionTableMap::COL_ID_QUOTE_REQUEST_VERSION, $idQuoteRequestVersion, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkQuoteRequest Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkQuoteRequest_Between(array $fkQuoteRequest)
    {
        return $this->filterByFkQuoteRequest($fkQuoteRequest, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkQuoteRequests Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkQuoteRequest_In(array $fkQuoteRequests)
    {
        return $this->filterByFkQuoteRequest($fkQuoteRequests, Criteria::IN);
    }

    /**
     * Filter the query on the fk_quote_request column
     *
     * Example usage:
     * <code>
     * $query->filterByFkQuoteRequest(1234); // WHERE fk_quote_request = 1234
     * $query->filterByFkQuoteRequest(array(12, 34), Criteria::IN); // WHERE fk_quote_request IN (12, 34)
     * $query->filterByFkQuoteRequest(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_quote_request > 12
     * </code>
     *
     * @see       filterBySpyQuoteRequest()
     *
     * @param     mixed $fkQuoteRequest The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkQuoteRequest($fkQuoteRequest = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkQuoteRequest)) {
            $useMinMax = false;
            if (isset($fkQuoteRequest['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyQuoteRequestVersionTableMap::COL_FK_QUOTE_REQUEST, $fkQuoteRequest['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkQuoteRequest['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyQuoteRequestVersionTableMap::COL_FK_QUOTE_REQUEST, $fkQuoteRequest['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkQuoteRequest of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyQuoteRequestVersionTableMap::COL_FK_QUOTE_REQUEST, $fkQuoteRequest, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $version Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVersion_Between(array $version)
    {
        return $this->filterByVersion($version, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $versions Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVersion_In(array $versions)
    {
        return $this->filterByVersion($versions, Criteria::IN);
    }

    /**
     * Filter the query on the version column
     *
     * Example usage:
     * <code>
     * $query->filterByVersion(1234); // WHERE version = 1234
     * $query->filterByVersion(array(12, 34), Criteria::IN); // WHERE version IN (12, 34)
     * $query->filterByVersion(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE version > 12
     * </code>
     *
     * @param     mixed $version The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByVersion($version = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($version)) {
            $useMinMax = false;
            if (isset($version['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyQuoteRequestVersionTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyQuoteRequestVersionTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$version of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyQuoteRequestVersionTableMap::COL_VERSION, $version, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $versionReferences Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVersionReference_In(array $versionReferences)
    {
        return $this->filterByVersionReference($versionReferences, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $versionReference Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVersionReference_Like($versionReference)
    {
        return $this->filterByVersionReference($versionReference, Criteria::LIKE);
    }

    /**
     * Filter the query on the version_reference column
     *
     * Example usage:
     * <code>
     * $query->filterByVersionReference('fooValue');   // WHERE version_reference = 'fooValue'
     * $query->filterByVersionReference('%fooValue%', Criteria::LIKE); // WHERE version_reference LIKE '%fooValue%'
     * $query->filterByVersionReference([1, 'foo'], Criteria::IN); // WHERE version_reference IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $versionReference The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByVersionReference($versionReference = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $versionReference = str_replace('*', '%', $versionReference);
        }

        if (is_array($versionReference) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$versionReference of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyQuoteRequestVersionTableMap::COL_VERSION_REFERENCE, $versionReference, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $metadatas Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMetadata_In(array $metadatas)
    {
        return $this->filterByMetadata($metadatas, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $metadata Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMetadata_Like($metadata)
    {
        return $this->filterByMetadata($metadata, Criteria::LIKE);
    }

    /**
     * Filter the query on the metadata column
     *
     * Example usage:
     * <code>
     * $query->filterByMetadata('fooValue');   // WHERE metadata = 'fooValue'
     * $query->filterByMetadata('%fooValue%', Criteria::LIKE); // WHERE metadata LIKE '%fooValue%'
     * $query->filterByMetadata([1, 'foo'], Criteria::IN); // WHERE metadata IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $metadata The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByMetadata($metadata = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $metadata = str_replace('*', '%', $metadata);
        }

        if (is_array($metadata) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$metadata of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyQuoteRequestVersionTableMap::COL_METADATA, $metadata, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $quotes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByQuote_In(array $quotes)
    {
        return $this->filterByQuote($quotes, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $quote Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByQuote_Like($quote)
    {
        return $this->filterByQuote($quote, Criteria::LIKE);
    }

    /**
     * Filter the query on the quote column
     *
     * Example usage:
     * <code>
     * $query->filterByQuote('fooValue');   // WHERE quote = 'fooValue'
     * $query->filterByQuote('%fooValue%', Criteria::LIKE); // WHERE quote LIKE '%fooValue%'
     * $query->filterByQuote([1, 'foo'], Criteria::IN); // WHERE quote IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $quote The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByQuote($quote = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $quote = str_replace('*', '%', $quote);
        }

        if (is_array($quote) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$quote of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyQuoteRequestVersionTableMap::COL_QUOTE, $quote, $comparison);

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
                $this->addUsingAlias(SpyQuoteRequestVersionTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyQuoteRequestVersionTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyQuoteRequestVersionTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SpyQuoteRequestVersionTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyQuoteRequestVersionTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyQuoteRequestVersionTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequest object
     *
     * @param \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequest|ObjectCollection $spyQuoteRequest The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyQuoteRequest($spyQuoteRequest, ?string $comparison = null)
    {
        if ($spyQuoteRequest instanceof \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequest) {
            return $this
                ->addUsingAlias(SpyQuoteRequestVersionTableMap::COL_FK_QUOTE_REQUEST, $spyQuoteRequest->getIdQuoteRequest(), $comparison);
        } elseif ($spyQuoteRequest instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyQuoteRequestVersionTableMap::COL_FK_QUOTE_REQUEST, $spyQuoteRequest->toKeyValue('PrimaryKey', 'IdQuoteRequest'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyQuoteRequest() only accepts arguments of type \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequest or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyQuoteRequest relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyQuoteRequest(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyQuoteRequest');

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
            $this->addJoinObject($join, 'SpyQuoteRequest');
        }

        return $this;
    }

    /**
     * Use the SpyQuoteRequest relation SpyQuoteRequest object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestQuery A secondary query class using the current class as primary query
     */
    public function useSpyQuoteRequestQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyQuoteRequest($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyQuoteRequest', '\Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestQuery');
    }

    /**
     * Use the SpyQuoteRequest relation SpyQuoteRequest object
     *
     * @param callable(\Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestQuery):\Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyQuoteRequestQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyQuoteRequestQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyQuoteRequest table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestQuery The inner query object of the EXISTS statement
     */
    public function useSpyQuoteRequestExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestQuery */
        $q = $this->useExistsQuery('SpyQuoteRequest', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyQuoteRequest table for a NOT EXISTS query.
     *
     * @see useSpyQuoteRequestExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyQuoteRequestNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestQuery */
        $q = $this->useExistsQuery('SpyQuoteRequest', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyQuoteRequest table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestQuery The inner query object of the IN statement
     */
    public function useInSpyQuoteRequestQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestQuery */
        $q = $this->useInQuery('SpyQuoteRequest', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyQuoteRequest table for a NOT IN query.
     *
     * @see useSpyQuoteRequestInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyQuoteRequestQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestQuery */
        $q = $this->useInQuery('SpyQuoteRequest', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyQuoteRequestVersion $spyQuoteRequestVersion Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyQuoteRequestVersion = null)
    {
        if ($spyQuoteRequestVersion) {
            $this->addUsingAlias(SpyQuoteRequestVersionTableMap::COL_ID_QUOTE_REQUEST_VERSION, $spyQuoteRequestVersion->getIdQuoteRequestVersion(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_quote_request_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyQuoteRequestVersionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyQuoteRequestVersionTableMap::clearInstancePool();
            SpyQuoteRequestVersionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyQuoteRequestVersionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyQuoteRequestVersionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyQuoteRequestVersionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyQuoteRequestVersionTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(SpyQuoteRequestVersionTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyQuoteRequestVersionTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyQuoteRequestVersionTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyQuoteRequestVersionTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpyQuoteRequestVersionTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyQuoteRequestVersionTableMap::COL_CREATED_AT);

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
