<?php

namespace Orm\Zed\QuoteRequest\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUser;
use Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequest as ChildSpyQuoteRequest;
use Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestQuery as ChildSpyQuoteRequestQuery;
use Orm\Zed\QuoteRequest\Persistence\Map\SpyQuoteRequestTableMap;
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
 * Base class that represents a query for the `spy_quote_request` table.
 *
 * @method     ChildSpyQuoteRequestQuery orderByIdQuoteRequest($order = Criteria::ASC) Order by the id_quote_request column
 * @method     ChildSpyQuoteRequestQuery orderByFkCompanyUser($order = Criteria::ASC) Order by the fk_company_user column
 * @method     ChildSpyQuoteRequestQuery orderByQuoteRequestReference($order = Criteria::ASC) Order by the quote_request_reference column
 * @method     ChildSpyQuoteRequestQuery orderByValidUntil($order = Criteria::ASC) Order by the valid_until column
 * @method     ChildSpyQuoteRequestQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildSpyQuoteRequestQuery orderByIsLatestVersionVisible($order = Criteria::ASC) Order by the is_latest_version_visible column
 * @method     ChildSpyQuoteRequestQuery orderByUuid($order = Criteria::ASC) Order by the uuid column
 * @method     ChildSpyQuoteRequestQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpyQuoteRequestQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpyQuoteRequestQuery groupByIdQuoteRequest() Group by the id_quote_request column
 * @method     ChildSpyQuoteRequestQuery groupByFkCompanyUser() Group by the fk_company_user column
 * @method     ChildSpyQuoteRequestQuery groupByQuoteRequestReference() Group by the quote_request_reference column
 * @method     ChildSpyQuoteRequestQuery groupByValidUntil() Group by the valid_until column
 * @method     ChildSpyQuoteRequestQuery groupByStatus() Group by the status column
 * @method     ChildSpyQuoteRequestQuery groupByIsLatestVersionVisible() Group by the is_latest_version_visible column
 * @method     ChildSpyQuoteRequestQuery groupByUuid() Group by the uuid column
 * @method     ChildSpyQuoteRequestQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpyQuoteRequestQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpyQuoteRequestQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyQuoteRequestQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyQuoteRequestQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyQuoteRequestQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyQuoteRequestQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyQuoteRequestQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyQuoteRequestQuery leftJoinCompanyUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the CompanyUser relation
 * @method     ChildSpyQuoteRequestQuery rightJoinCompanyUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CompanyUser relation
 * @method     ChildSpyQuoteRequestQuery innerJoinCompanyUser($relationAlias = null) Adds a INNER JOIN clause to the query using the CompanyUser relation
 *
 * @method     ChildSpyQuoteRequestQuery joinWithCompanyUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CompanyUser relation
 *
 * @method     ChildSpyQuoteRequestQuery leftJoinWithCompanyUser() Adds a LEFT JOIN clause and with to the query using the CompanyUser relation
 * @method     ChildSpyQuoteRequestQuery rightJoinWithCompanyUser() Adds a RIGHT JOIN clause and with to the query using the CompanyUser relation
 * @method     ChildSpyQuoteRequestQuery innerJoinWithCompanyUser() Adds a INNER JOIN clause and with to the query using the CompanyUser relation
 *
 * @method     ChildSpyQuoteRequestQuery leftJoinSpyQuoteRequestVersion($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyQuoteRequestVersion relation
 * @method     ChildSpyQuoteRequestQuery rightJoinSpyQuoteRequestVersion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyQuoteRequestVersion relation
 * @method     ChildSpyQuoteRequestQuery innerJoinSpyQuoteRequestVersion($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyQuoteRequestVersion relation
 *
 * @method     ChildSpyQuoteRequestQuery joinWithSpyQuoteRequestVersion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyQuoteRequestVersion relation
 *
 * @method     ChildSpyQuoteRequestQuery leftJoinWithSpyQuoteRequestVersion() Adds a LEFT JOIN clause and with to the query using the SpyQuoteRequestVersion relation
 * @method     ChildSpyQuoteRequestQuery rightJoinWithSpyQuoteRequestVersion() Adds a RIGHT JOIN clause and with to the query using the SpyQuoteRequestVersion relation
 * @method     ChildSpyQuoteRequestQuery innerJoinWithSpyQuoteRequestVersion() Adds a INNER JOIN clause and with to the query using the SpyQuoteRequestVersion relation
 *
 * @method     \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery|\Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestVersionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyQuoteRequest|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyQuoteRequest matching the query
 * @method     ChildSpyQuoteRequest findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyQuoteRequest matching the query, or a new ChildSpyQuoteRequest object populated from the query conditions when no match is found
 *
 * @method     ChildSpyQuoteRequest|null findOneByIdQuoteRequest(int $id_quote_request) Return the first ChildSpyQuoteRequest filtered by the id_quote_request column
 * @method     ChildSpyQuoteRequest|null findOneByFkCompanyUser(int $fk_company_user) Return the first ChildSpyQuoteRequest filtered by the fk_company_user column
 * @method     ChildSpyQuoteRequest|null findOneByQuoteRequestReference(string $quote_request_reference) Return the first ChildSpyQuoteRequest filtered by the quote_request_reference column
 * @method     ChildSpyQuoteRequest|null findOneByValidUntil(string $valid_until) Return the first ChildSpyQuoteRequest filtered by the valid_until column
 * @method     ChildSpyQuoteRequest|null findOneByStatus(string $status) Return the first ChildSpyQuoteRequest filtered by the status column
 * @method     ChildSpyQuoteRequest|null findOneByIsLatestVersionVisible(boolean $is_latest_version_visible) Return the first ChildSpyQuoteRequest filtered by the is_latest_version_visible column
 * @method     ChildSpyQuoteRequest|null findOneByUuid(string $uuid) Return the first ChildSpyQuoteRequest filtered by the uuid column
 * @method     ChildSpyQuoteRequest|null findOneByCreatedAt(string $created_at) Return the first ChildSpyQuoteRequest filtered by the created_at column
 * @method     ChildSpyQuoteRequest|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpyQuoteRequest filtered by the updated_at column
 *
 * @method     ChildSpyQuoteRequest requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyQuoteRequest by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyQuoteRequest requireOne(?ConnectionInterface $con = null) Return the first ChildSpyQuoteRequest matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyQuoteRequest requireOneByIdQuoteRequest(int $id_quote_request) Return the first ChildSpyQuoteRequest filtered by the id_quote_request column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyQuoteRequest requireOneByFkCompanyUser(int $fk_company_user) Return the first ChildSpyQuoteRequest filtered by the fk_company_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyQuoteRequest requireOneByQuoteRequestReference(string $quote_request_reference) Return the first ChildSpyQuoteRequest filtered by the quote_request_reference column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyQuoteRequest requireOneByValidUntil(string $valid_until) Return the first ChildSpyQuoteRequest filtered by the valid_until column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyQuoteRequest requireOneByStatus(string $status) Return the first ChildSpyQuoteRequest filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyQuoteRequest requireOneByIsLatestVersionVisible(boolean $is_latest_version_visible) Return the first ChildSpyQuoteRequest filtered by the is_latest_version_visible column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyQuoteRequest requireOneByUuid(string $uuid) Return the first ChildSpyQuoteRequest filtered by the uuid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyQuoteRequest requireOneByCreatedAt(string $created_at) Return the first ChildSpyQuoteRequest filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyQuoteRequest requireOneByUpdatedAt(string $updated_at) Return the first ChildSpyQuoteRequest filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyQuoteRequest[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyQuoteRequest objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyQuoteRequest> find(?ConnectionInterface $con = null) Return ChildSpyQuoteRequest objects based on current ModelCriteria
 *
 * @method     ChildSpyQuoteRequest[]|Collection findByIdQuoteRequest(int|array<int> $id_quote_request) Return ChildSpyQuoteRequest objects filtered by the id_quote_request column
 * @psalm-method Collection&\Traversable<ChildSpyQuoteRequest> findByIdQuoteRequest(int|array<int> $id_quote_request) Return ChildSpyQuoteRequest objects filtered by the id_quote_request column
 * @method     ChildSpyQuoteRequest[]|Collection findByFkCompanyUser(int|array<int> $fk_company_user) Return ChildSpyQuoteRequest objects filtered by the fk_company_user column
 * @psalm-method Collection&\Traversable<ChildSpyQuoteRequest> findByFkCompanyUser(int|array<int> $fk_company_user) Return ChildSpyQuoteRequest objects filtered by the fk_company_user column
 * @method     ChildSpyQuoteRequest[]|Collection findByQuoteRequestReference(string|array<string> $quote_request_reference) Return ChildSpyQuoteRequest objects filtered by the quote_request_reference column
 * @psalm-method Collection&\Traversable<ChildSpyQuoteRequest> findByQuoteRequestReference(string|array<string> $quote_request_reference) Return ChildSpyQuoteRequest objects filtered by the quote_request_reference column
 * @method     ChildSpyQuoteRequest[]|Collection findByValidUntil(string|array<string> $valid_until) Return ChildSpyQuoteRequest objects filtered by the valid_until column
 * @psalm-method Collection&\Traversable<ChildSpyQuoteRequest> findByValidUntil(string|array<string> $valid_until) Return ChildSpyQuoteRequest objects filtered by the valid_until column
 * @method     ChildSpyQuoteRequest[]|Collection findByStatus(string|array<string> $status) Return ChildSpyQuoteRequest objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildSpyQuoteRequest> findByStatus(string|array<string> $status) Return ChildSpyQuoteRequest objects filtered by the status column
 * @method     ChildSpyQuoteRequest[]|Collection findByIsLatestVersionVisible(boolean|array<boolean> $is_latest_version_visible) Return ChildSpyQuoteRequest objects filtered by the is_latest_version_visible column
 * @psalm-method Collection&\Traversable<ChildSpyQuoteRequest> findByIsLatestVersionVisible(boolean|array<boolean> $is_latest_version_visible) Return ChildSpyQuoteRequest objects filtered by the is_latest_version_visible column
 * @method     ChildSpyQuoteRequest[]|Collection findByUuid(string|array<string> $uuid) Return ChildSpyQuoteRequest objects filtered by the uuid column
 * @psalm-method Collection&\Traversable<ChildSpyQuoteRequest> findByUuid(string|array<string> $uuid) Return ChildSpyQuoteRequest objects filtered by the uuid column
 * @method     ChildSpyQuoteRequest[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpyQuoteRequest objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpyQuoteRequest> findByCreatedAt(string|array<string> $created_at) Return ChildSpyQuoteRequest objects filtered by the created_at column
 * @method     ChildSpyQuoteRequest[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyQuoteRequest objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpyQuoteRequest> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyQuoteRequest objects filtered by the updated_at column
 *
 * @method     ChildSpyQuoteRequest[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyQuoteRequest> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyQuoteRequestQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\QuoteRequest\Persistence\Base\SpyQuoteRequestQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\QuoteRequest\\Persistence\\SpyQuoteRequest', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyQuoteRequestQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyQuoteRequestQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyQuoteRequestQuery) {
            return $criteria;
        }
        $query = new ChildSpyQuoteRequestQuery();
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
     * @return ChildSpyQuoteRequest|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyQuoteRequestTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyQuoteRequest A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_quote_request, fk_company_user, quote_request_reference, valid_until, status, is_latest_version_visible, uuid, created_at, updated_at FROM spy_quote_request WHERE id_quote_request = :p0';
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
            /** @var ChildSpyQuoteRequest $obj */
            $obj = new ChildSpyQuoteRequest();
            $obj->hydrate($row);
            SpyQuoteRequestTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyQuoteRequest|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyQuoteRequestTableMap::COL_ID_QUOTE_REQUEST, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyQuoteRequestTableMap::COL_ID_QUOTE_REQUEST, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idQuoteRequest Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdQuoteRequest_Between(array $idQuoteRequest)
    {
        return $this->filterByIdQuoteRequest($idQuoteRequest, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idQuoteRequests Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdQuoteRequest_In(array $idQuoteRequests)
    {
        return $this->filterByIdQuoteRequest($idQuoteRequests, Criteria::IN);
    }

    /**
     * Filter the query on the id_quote_request column
     *
     * Example usage:
     * <code>
     * $query->filterByIdQuoteRequest(1234); // WHERE id_quote_request = 1234
     * $query->filterByIdQuoteRequest(array(12, 34), Criteria::IN); // WHERE id_quote_request IN (12, 34)
     * $query->filterByIdQuoteRequest(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_quote_request > 12
     * </code>
     *
     * @param     mixed $idQuoteRequest The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdQuoteRequest($idQuoteRequest = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idQuoteRequest)) {
            $useMinMax = false;
            if (isset($idQuoteRequest['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyQuoteRequestTableMap::COL_ID_QUOTE_REQUEST, $idQuoteRequest['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idQuoteRequest['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyQuoteRequestTableMap::COL_ID_QUOTE_REQUEST, $idQuoteRequest['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idQuoteRequest of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyQuoteRequestTableMap::COL_ID_QUOTE_REQUEST, $idQuoteRequest, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkCompanyUser Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCompanyUser_Between(array $fkCompanyUser)
    {
        return $this->filterByFkCompanyUser($fkCompanyUser, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkCompanyUsers Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCompanyUser_In(array $fkCompanyUsers)
    {
        return $this->filterByFkCompanyUser($fkCompanyUsers, Criteria::IN);
    }

    /**
     * Filter the query on the fk_company_user column
     *
     * Example usage:
     * <code>
     * $query->filterByFkCompanyUser(1234); // WHERE fk_company_user = 1234
     * $query->filterByFkCompanyUser(array(12, 34), Criteria::IN); // WHERE fk_company_user IN (12, 34)
     * $query->filterByFkCompanyUser(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_company_user > 12
     * </code>
     *
     * @see       filterByCompanyUser()
     *
     * @param     mixed $fkCompanyUser The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkCompanyUser($fkCompanyUser = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkCompanyUser)) {
            $useMinMax = false;
            if (isset($fkCompanyUser['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyQuoteRequestTableMap::COL_FK_COMPANY_USER, $fkCompanyUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkCompanyUser['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyQuoteRequestTableMap::COL_FK_COMPANY_USER, $fkCompanyUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkCompanyUser of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyQuoteRequestTableMap::COL_FK_COMPANY_USER, $fkCompanyUser, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $quoteRequestReferences Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByQuoteRequestReference_In(array $quoteRequestReferences)
    {
        return $this->filterByQuoteRequestReference($quoteRequestReferences, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $quoteRequestReference Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByQuoteRequestReference_Like($quoteRequestReference)
    {
        return $this->filterByQuoteRequestReference($quoteRequestReference, Criteria::LIKE);
    }

    /**
     * Filter the query on the quote_request_reference column
     *
     * Example usage:
     * <code>
     * $query->filterByQuoteRequestReference('fooValue');   // WHERE quote_request_reference = 'fooValue'
     * $query->filterByQuoteRequestReference('%fooValue%', Criteria::LIKE); // WHERE quote_request_reference LIKE '%fooValue%'
     * $query->filterByQuoteRequestReference([1, 'foo'], Criteria::IN); // WHERE quote_request_reference IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $quoteRequestReference The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByQuoteRequestReference($quoteRequestReference = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $quoteRequestReference = str_replace('*', '%', $quoteRequestReference);
        }

        if (is_array($quoteRequestReference) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$quoteRequestReference of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyQuoteRequestTableMap::COL_QUOTE_REQUEST_REFERENCE, $quoteRequestReference, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $validUntil Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByValidUntil_Between(array $validUntil)
    {
        return $this->filterByValidUntil($validUntil, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $validUntils Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByValidUntil_In(array $validUntils)
    {
        return $this->filterByValidUntil($validUntils, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $validUntil Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByValidUntil_Like($validUntil)
    {
        return $this->filterByValidUntil($validUntil, Criteria::LIKE);
    }

    /**
     * Filter the query on the valid_until column
     *
     * Example usage:
     * <code>
     * $query->filterByValidUntil('2011-03-14'); // WHERE valid_until = '2011-03-14'
     * $query->filterByValidUntil('now'); // WHERE valid_until = '2011-03-14'
     * $query->filterByValidUntil(array('max' => 'yesterday'), SprykerCriteria::BETWEEN); // WHERE valid_until > '2011-03-13'
     * </code>
     *
     * @param     mixed $validUntil The value to use as filter.
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
    public function filterByValidUntil($validUntil = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($validUntil)) {
            $useMinMax = false;
            if (isset($validUntil['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyQuoteRequestTableMap::COL_VALID_UNTIL, $validUntil['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($validUntil['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyQuoteRequestTableMap::COL_VALID_UNTIL, $validUntil['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$validUntil of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyQuoteRequestTableMap::COL_VALID_UNTIL, $validUntil, $comparison);

        return $query;
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
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $status Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStatus_Like($status)
    {
        return $this->filterByStatus($status, Criteria::LIKE);
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE status = 'fooValue'
     * $query->filterByStatus('%fooValue%', Criteria::LIKE); // WHERE status LIKE '%fooValue%'
     * $query->filterByStatus([1, 'foo'], Criteria::IN); // WHERE status IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $status The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByStatus($status = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $status = str_replace('*', '%', $status);
        }

        if (is_array($status) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$status of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyQuoteRequestTableMap::COL_STATUS, $status, $comparison);

        return $query;
    }

    /**
     * Filter the query on the is_latest_version_visible column
     *
     * Example usage:
     * <code>
     * $query->filterByIsLatestVersionVisible(true); // WHERE is_latest_version_visible = true
     * $query->filterByIsLatestVersionVisible('yes'); // WHERE is_latest_version_visible = true
     * </code>
     *
     * @param     bool|string $isLatestVersionVisible The value to use as filter.
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
    public function filterByIsLatestVersionVisible($isLatestVersionVisible = null, $comparison = Criteria::EQUAL)
    {
        if (is_string($isLatestVersionVisible)) {
            $isLatestVersionVisible = in_array(strtolower($isLatestVersionVisible), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $query = $this->addUsingAlias(SpyQuoteRequestTableMap::COL_IS_LATEST_VERSION_VISIBLE, $isLatestVersionVisible, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $uuids Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUuid_In(array $uuids)
    {
        return $this->filterByUuid($uuids, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $uuid Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUuid_Like($uuid)
    {
        return $this->filterByUuid($uuid, Criteria::LIKE);
    }

    /**
     * Filter the query on the uuid column
     *
     * Example usage:
     * <code>
     * $query->filterByUuid('fooValue');   // WHERE uuid = 'fooValue'
     * $query->filterByUuid('%fooValue%', Criteria::LIKE); // WHERE uuid LIKE '%fooValue%'
     * $query->filterByUuid([1, 'foo'], Criteria::IN); // WHERE uuid IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $uuid The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByUuid($uuid = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $uuid = str_replace('*', '%', $uuid);
        }

        if (is_array($uuid) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$uuid of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyQuoteRequestTableMap::COL_UUID, $uuid, $comparison);

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
                $this->addUsingAlias(SpyQuoteRequestTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyQuoteRequestTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyQuoteRequestTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SpyQuoteRequestTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyQuoteRequestTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyQuoteRequestTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\CompanyUser\Persistence\SpyCompanyUser object
     *
     * @param \Orm\Zed\CompanyUser\Persistence\SpyCompanyUser|ObjectCollection $spyCompanyUser The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompanyUser($spyCompanyUser, ?string $comparison = null)
    {
        if ($spyCompanyUser instanceof \Orm\Zed\CompanyUser\Persistence\SpyCompanyUser) {
            return $this
                ->addUsingAlias(SpyQuoteRequestTableMap::COL_FK_COMPANY_USER, $spyCompanyUser->getIdCompanyUser(), $comparison);
        } elseif ($spyCompanyUser instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyQuoteRequestTableMap::COL_FK_COMPANY_USER, $spyCompanyUser->toKeyValue('PrimaryKey', 'IdCompanyUser'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCompanyUser() only accepts arguments of type \Orm\Zed\CompanyUser\Persistence\SpyCompanyUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CompanyUser relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCompanyUser(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CompanyUser');

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
            $this->addJoinObject($join, 'CompanyUser');
        }

        return $this;
    }

    /**
     * Use the CompanyUser relation SpyCompanyUser object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery A secondary query class using the current class as primary query
     */
    public function useCompanyUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCompanyUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CompanyUser', '\Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery');
    }

    /**
     * Use the CompanyUser relation SpyCompanyUser object
     *
     * @param callable(\Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery):\Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCompanyUserQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCompanyUserQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the CompanyUser relation to the SpyCompanyUser table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery The inner query object of the EXISTS statement
     */
    public function useCompanyUserExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery */
        $q = $this->useExistsQuery('CompanyUser', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the CompanyUser relation to the SpyCompanyUser table for a NOT EXISTS query.
     *
     * @see useCompanyUserExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery The inner query object of the NOT EXISTS statement
     */
    public function useCompanyUserNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery */
        $q = $this->useExistsQuery('CompanyUser', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the CompanyUser relation to the SpyCompanyUser table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery The inner query object of the IN statement
     */
    public function useInCompanyUserQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery */
        $q = $this->useInQuery('CompanyUser', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the CompanyUser relation to the SpyCompanyUser table for a NOT IN query.
     *
     * @see useCompanyUserInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery The inner query object of the NOT IN statement
     */
    public function useNotInCompanyUserQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery */
        $q = $this->useInQuery('CompanyUser', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestVersion object
     *
     * @param \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestVersion|ObjectCollection $spyQuoteRequestVersion the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyQuoteRequestVersion($spyQuoteRequestVersion, ?string $comparison = null)
    {
        if ($spyQuoteRequestVersion instanceof \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestVersion) {
            $this
                ->addUsingAlias(SpyQuoteRequestTableMap::COL_ID_QUOTE_REQUEST, $spyQuoteRequestVersion->getFkQuoteRequest(), $comparison);

            return $this;
        } elseif ($spyQuoteRequestVersion instanceof ObjectCollection) {
            $this
                ->useSpyQuoteRequestVersionQuery()
                ->filterByPrimaryKeys($spyQuoteRequestVersion->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyQuoteRequestVersion() only accepts arguments of type \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestVersion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyQuoteRequestVersion relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyQuoteRequestVersion(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyQuoteRequestVersion');

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
            $this->addJoinObject($join, 'SpyQuoteRequestVersion');
        }

        return $this;
    }

    /**
     * Use the SpyQuoteRequestVersion relation SpyQuoteRequestVersion object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestVersionQuery A secondary query class using the current class as primary query
     */
    public function useSpyQuoteRequestVersionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyQuoteRequestVersion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyQuoteRequestVersion', '\Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestVersionQuery');
    }

    /**
     * Use the SpyQuoteRequestVersion relation SpyQuoteRequestVersion object
     *
     * @param callable(\Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestVersionQuery):\Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestVersionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyQuoteRequestVersionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyQuoteRequestVersionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyQuoteRequestVersion table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestVersionQuery The inner query object of the EXISTS statement
     */
    public function useSpyQuoteRequestVersionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestVersionQuery */
        $q = $this->useExistsQuery('SpyQuoteRequestVersion', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyQuoteRequestVersion table for a NOT EXISTS query.
     *
     * @see useSpyQuoteRequestVersionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestVersionQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyQuoteRequestVersionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestVersionQuery */
        $q = $this->useExistsQuery('SpyQuoteRequestVersion', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyQuoteRequestVersion table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestVersionQuery The inner query object of the IN statement
     */
    public function useInSpyQuoteRequestVersionQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestVersionQuery */
        $q = $this->useInQuery('SpyQuoteRequestVersion', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyQuoteRequestVersion table for a NOT IN query.
     *
     * @see useSpyQuoteRequestVersionInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestVersionQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyQuoteRequestVersionQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestVersionQuery */
        $q = $this->useInQuery('SpyQuoteRequestVersion', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyQuoteRequest $spyQuoteRequest Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyQuoteRequest = null)
    {
        if ($spyQuoteRequest) {
            $this->addUsingAlias(SpyQuoteRequestTableMap::COL_ID_QUOTE_REQUEST, $spyQuoteRequest->getIdQuoteRequest(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_quote_request table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyQuoteRequestTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyQuoteRequestTableMap::clearInstancePool();
            SpyQuoteRequestTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyQuoteRequestTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyQuoteRequestTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyQuoteRequestTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyQuoteRequestTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(SpyQuoteRequestTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyQuoteRequestTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyQuoteRequestTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyQuoteRequestTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpyQuoteRequestTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyQuoteRequestTableMap::COL_CREATED_AT);

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
