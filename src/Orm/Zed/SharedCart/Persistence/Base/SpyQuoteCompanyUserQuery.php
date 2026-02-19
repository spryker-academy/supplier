<?php

namespace Orm\Zed\SharedCart\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUser;
use Orm\Zed\Quote\Persistence\SpyQuote;
use Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUser as ChildSpyQuoteCompanyUser;
use Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUserQuery as ChildSpyQuoteCompanyUserQuery;
use Orm\Zed\SharedCart\Persistence\Map\SpyQuoteCompanyUserTableMap;
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
 * Base class that represents a query for the `spy_quote_company_user` table.
 *
 * @method     ChildSpyQuoteCompanyUserQuery orderByIdQuoteCompanyUser($order = Criteria::ASC) Order by the id_quote_company_user column
 * @method     ChildSpyQuoteCompanyUserQuery orderByFkCompanyUser($order = Criteria::ASC) Order by the fk_company_user column
 * @method     ChildSpyQuoteCompanyUserQuery orderByFkQuote($order = Criteria::ASC) Order by the fk_quote column
 * @method     ChildSpyQuoteCompanyUserQuery orderByFkQuotePermissionGroup($order = Criteria::ASC) Order by the fk_quote_permission_group column
 * @method     ChildSpyQuoteCompanyUserQuery orderByIsDefault($order = Criteria::ASC) Order by the is_default column
 * @method     ChildSpyQuoteCompanyUserQuery orderByUuid($order = Criteria::ASC) Order by the uuid column
 *
 * @method     ChildSpyQuoteCompanyUserQuery groupByIdQuoteCompanyUser() Group by the id_quote_company_user column
 * @method     ChildSpyQuoteCompanyUserQuery groupByFkCompanyUser() Group by the fk_company_user column
 * @method     ChildSpyQuoteCompanyUserQuery groupByFkQuote() Group by the fk_quote column
 * @method     ChildSpyQuoteCompanyUserQuery groupByFkQuotePermissionGroup() Group by the fk_quote_permission_group column
 * @method     ChildSpyQuoteCompanyUserQuery groupByIsDefault() Group by the is_default column
 * @method     ChildSpyQuoteCompanyUserQuery groupByUuid() Group by the uuid column
 *
 * @method     ChildSpyQuoteCompanyUserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyQuoteCompanyUserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyQuoteCompanyUserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyQuoteCompanyUserQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyQuoteCompanyUserQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyQuoteCompanyUserQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyQuoteCompanyUserQuery leftJoinSpyCompanyUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCompanyUser relation
 * @method     ChildSpyQuoteCompanyUserQuery rightJoinSpyCompanyUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCompanyUser relation
 * @method     ChildSpyQuoteCompanyUserQuery innerJoinSpyCompanyUser($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCompanyUser relation
 *
 * @method     ChildSpyQuoteCompanyUserQuery joinWithSpyCompanyUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCompanyUser relation
 *
 * @method     ChildSpyQuoteCompanyUserQuery leftJoinWithSpyCompanyUser() Adds a LEFT JOIN clause and with to the query using the SpyCompanyUser relation
 * @method     ChildSpyQuoteCompanyUserQuery rightJoinWithSpyCompanyUser() Adds a RIGHT JOIN clause and with to the query using the SpyCompanyUser relation
 * @method     ChildSpyQuoteCompanyUserQuery innerJoinWithSpyCompanyUser() Adds a INNER JOIN clause and with to the query using the SpyCompanyUser relation
 *
 * @method     ChildSpyQuoteCompanyUserQuery leftJoinSpyQuote($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyQuote relation
 * @method     ChildSpyQuoteCompanyUserQuery rightJoinSpyQuote($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyQuote relation
 * @method     ChildSpyQuoteCompanyUserQuery innerJoinSpyQuote($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyQuote relation
 *
 * @method     ChildSpyQuoteCompanyUserQuery joinWithSpyQuote($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyQuote relation
 *
 * @method     ChildSpyQuoteCompanyUserQuery leftJoinWithSpyQuote() Adds a LEFT JOIN clause and with to the query using the SpyQuote relation
 * @method     ChildSpyQuoteCompanyUserQuery rightJoinWithSpyQuote() Adds a RIGHT JOIN clause and with to the query using the SpyQuote relation
 * @method     ChildSpyQuoteCompanyUserQuery innerJoinWithSpyQuote() Adds a INNER JOIN clause and with to the query using the SpyQuote relation
 *
 * @method     ChildSpyQuoteCompanyUserQuery leftJoinSpyQuotePermissionGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyQuotePermissionGroup relation
 * @method     ChildSpyQuoteCompanyUserQuery rightJoinSpyQuotePermissionGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyQuotePermissionGroup relation
 * @method     ChildSpyQuoteCompanyUserQuery innerJoinSpyQuotePermissionGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyQuotePermissionGroup relation
 *
 * @method     ChildSpyQuoteCompanyUserQuery joinWithSpyQuotePermissionGroup($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyQuotePermissionGroup relation
 *
 * @method     ChildSpyQuoteCompanyUserQuery leftJoinWithSpyQuotePermissionGroup() Adds a LEFT JOIN clause and with to the query using the SpyQuotePermissionGroup relation
 * @method     ChildSpyQuoteCompanyUserQuery rightJoinWithSpyQuotePermissionGroup() Adds a RIGHT JOIN clause and with to the query using the SpyQuotePermissionGroup relation
 * @method     ChildSpyQuoteCompanyUserQuery innerJoinWithSpyQuotePermissionGroup() Adds a INNER JOIN clause and with to the query using the SpyQuotePermissionGroup relation
 *
 * @method     \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery|\Orm\Zed\Quote\Persistence\SpyQuoteQuery|\Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyQuoteCompanyUser|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyQuoteCompanyUser matching the query
 * @method     ChildSpyQuoteCompanyUser findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyQuoteCompanyUser matching the query, or a new ChildSpyQuoteCompanyUser object populated from the query conditions when no match is found
 *
 * @method     ChildSpyQuoteCompanyUser|null findOneByIdQuoteCompanyUser(int $id_quote_company_user) Return the first ChildSpyQuoteCompanyUser filtered by the id_quote_company_user column
 * @method     ChildSpyQuoteCompanyUser|null findOneByFkCompanyUser(int $fk_company_user) Return the first ChildSpyQuoteCompanyUser filtered by the fk_company_user column
 * @method     ChildSpyQuoteCompanyUser|null findOneByFkQuote(int $fk_quote) Return the first ChildSpyQuoteCompanyUser filtered by the fk_quote column
 * @method     ChildSpyQuoteCompanyUser|null findOneByFkQuotePermissionGroup(int $fk_quote_permission_group) Return the first ChildSpyQuoteCompanyUser filtered by the fk_quote_permission_group column
 * @method     ChildSpyQuoteCompanyUser|null findOneByIsDefault(boolean $is_default) Return the first ChildSpyQuoteCompanyUser filtered by the is_default column
 * @method     ChildSpyQuoteCompanyUser|null findOneByUuid(string $uuid) Return the first ChildSpyQuoteCompanyUser filtered by the uuid column
 *
 * @method     ChildSpyQuoteCompanyUser requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyQuoteCompanyUser by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyQuoteCompanyUser requireOne(?ConnectionInterface $con = null) Return the first ChildSpyQuoteCompanyUser matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyQuoteCompanyUser requireOneByIdQuoteCompanyUser(int $id_quote_company_user) Return the first ChildSpyQuoteCompanyUser filtered by the id_quote_company_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyQuoteCompanyUser requireOneByFkCompanyUser(int $fk_company_user) Return the first ChildSpyQuoteCompanyUser filtered by the fk_company_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyQuoteCompanyUser requireOneByFkQuote(int $fk_quote) Return the first ChildSpyQuoteCompanyUser filtered by the fk_quote column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyQuoteCompanyUser requireOneByFkQuotePermissionGroup(int $fk_quote_permission_group) Return the first ChildSpyQuoteCompanyUser filtered by the fk_quote_permission_group column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyQuoteCompanyUser requireOneByIsDefault(boolean $is_default) Return the first ChildSpyQuoteCompanyUser filtered by the is_default column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyQuoteCompanyUser requireOneByUuid(string $uuid) Return the first ChildSpyQuoteCompanyUser filtered by the uuid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyQuoteCompanyUser[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyQuoteCompanyUser objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyQuoteCompanyUser> find(?ConnectionInterface $con = null) Return ChildSpyQuoteCompanyUser objects based on current ModelCriteria
 *
 * @method     ChildSpyQuoteCompanyUser[]|Collection findByIdQuoteCompanyUser(int|array<int> $id_quote_company_user) Return ChildSpyQuoteCompanyUser objects filtered by the id_quote_company_user column
 * @psalm-method Collection&\Traversable<ChildSpyQuoteCompanyUser> findByIdQuoteCompanyUser(int|array<int> $id_quote_company_user) Return ChildSpyQuoteCompanyUser objects filtered by the id_quote_company_user column
 * @method     ChildSpyQuoteCompanyUser[]|Collection findByFkCompanyUser(int|array<int> $fk_company_user) Return ChildSpyQuoteCompanyUser objects filtered by the fk_company_user column
 * @psalm-method Collection&\Traversable<ChildSpyQuoteCompanyUser> findByFkCompanyUser(int|array<int> $fk_company_user) Return ChildSpyQuoteCompanyUser objects filtered by the fk_company_user column
 * @method     ChildSpyQuoteCompanyUser[]|Collection findByFkQuote(int|array<int> $fk_quote) Return ChildSpyQuoteCompanyUser objects filtered by the fk_quote column
 * @psalm-method Collection&\Traversable<ChildSpyQuoteCompanyUser> findByFkQuote(int|array<int> $fk_quote) Return ChildSpyQuoteCompanyUser objects filtered by the fk_quote column
 * @method     ChildSpyQuoteCompanyUser[]|Collection findByFkQuotePermissionGroup(int|array<int> $fk_quote_permission_group) Return ChildSpyQuoteCompanyUser objects filtered by the fk_quote_permission_group column
 * @psalm-method Collection&\Traversable<ChildSpyQuoteCompanyUser> findByFkQuotePermissionGroup(int|array<int> $fk_quote_permission_group) Return ChildSpyQuoteCompanyUser objects filtered by the fk_quote_permission_group column
 * @method     ChildSpyQuoteCompanyUser[]|Collection findByIsDefault(boolean|array<boolean> $is_default) Return ChildSpyQuoteCompanyUser objects filtered by the is_default column
 * @psalm-method Collection&\Traversable<ChildSpyQuoteCompanyUser> findByIsDefault(boolean|array<boolean> $is_default) Return ChildSpyQuoteCompanyUser objects filtered by the is_default column
 * @method     ChildSpyQuoteCompanyUser[]|Collection findByUuid(string|array<string> $uuid) Return ChildSpyQuoteCompanyUser objects filtered by the uuid column
 * @psalm-method Collection&\Traversable<ChildSpyQuoteCompanyUser> findByUuid(string|array<string> $uuid) Return ChildSpyQuoteCompanyUser objects filtered by the uuid column
 *
 * @method     ChildSpyQuoteCompanyUser[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyQuoteCompanyUser> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyQuoteCompanyUserQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\SharedCart\Persistence\Base\SpyQuoteCompanyUserQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\SharedCart\\Persistence\\SpyQuoteCompanyUser', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyQuoteCompanyUserQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyQuoteCompanyUserQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyQuoteCompanyUserQuery) {
            return $criteria;
        }
        $query = new ChildSpyQuoteCompanyUserQuery();
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
     * @return ChildSpyQuoteCompanyUser|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyQuoteCompanyUserTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyQuoteCompanyUser A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_quote_company_user, fk_company_user, fk_quote, fk_quote_permission_group, is_default, uuid FROM spy_quote_company_user WHERE id_quote_company_user = :p0';
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
            /** @var ChildSpyQuoteCompanyUser $obj */
            $obj = new ChildSpyQuoteCompanyUser();
            $obj->hydrate($row);
            SpyQuoteCompanyUserTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyQuoteCompanyUser|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyQuoteCompanyUserTableMap::COL_ID_QUOTE_COMPANY_USER, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyQuoteCompanyUserTableMap::COL_ID_QUOTE_COMPANY_USER, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idQuoteCompanyUser Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdQuoteCompanyUser_Between(array $idQuoteCompanyUser)
    {
        return $this->filterByIdQuoteCompanyUser($idQuoteCompanyUser, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idQuoteCompanyUsers Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdQuoteCompanyUser_In(array $idQuoteCompanyUsers)
    {
        return $this->filterByIdQuoteCompanyUser($idQuoteCompanyUsers, Criteria::IN);
    }

    /**
     * Filter the query on the id_quote_company_user column
     *
     * Example usage:
     * <code>
     * $query->filterByIdQuoteCompanyUser(1234); // WHERE id_quote_company_user = 1234
     * $query->filterByIdQuoteCompanyUser(array(12, 34), Criteria::IN); // WHERE id_quote_company_user IN (12, 34)
     * $query->filterByIdQuoteCompanyUser(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_quote_company_user > 12
     * </code>
     *
     * @param     mixed $idQuoteCompanyUser The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdQuoteCompanyUser($idQuoteCompanyUser = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idQuoteCompanyUser)) {
            $useMinMax = false;
            if (isset($idQuoteCompanyUser['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyQuoteCompanyUserTableMap::COL_ID_QUOTE_COMPANY_USER, $idQuoteCompanyUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idQuoteCompanyUser['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyQuoteCompanyUserTableMap::COL_ID_QUOTE_COMPANY_USER, $idQuoteCompanyUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idQuoteCompanyUser of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyQuoteCompanyUserTableMap::COL_ID_QUOTE_COMPANY_USER, $idQuoteCompanyUser, $comparison);

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
     * @see       filterBySpyCompanyUser()
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
                $this->addUsingAlias(SpyQuoteCompanyUserTableMap::COL_FK_COMPANY_USER, $fkCompanyUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkCompanyUser['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyQuoteCompanyUserTableMap::COL_FK_COMPANY_USER, $fkCompanyUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkCompanyUser of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyQuoteCompanyUserTableMap::COL_FK_COMPANY_USER, $fkCompanyUser, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkQuote Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkQuote_Between(array $fkQuote)
    {
        return $this->filterByFkQuote($fkQuote, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkQuotes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkQuote_In(array $fkQuotes)
    {
        return $this->filterByFkQuote($fkQuotes, Criteria::IN);
    }

    /**
     * Filter the query on the fk_quote column
     *
     * Example usage:
     * <code>
     * $query->filterByFkQuote(1234); // WHERE fk_quote = 1234
     * $query->filterByFkQuote(array(12, 34), Criteria::IN); // WHERE fk_quote IN (12, 34)
     * $query->filterByFkQuote(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_quote > 12
     * </code>
     *
     * @see       filterBySpyQuote()
     *
     * @param     mixed $fkQuote The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkQuote($fkQuote = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkQuote)) {
            $useMinMax = false;
            if (isset($fkQuote['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyQuoteCompanyUserTableMap::COL_FK_QUOTE, $fkQuote['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkQuote['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyQuoteCompanyUserTableMap::COL_FK_QUOTE, $fkQuote['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkQuote of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyQuoteCompanyUserTableMap::COL_FK_QUOTE, $fkQuote, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkQuotePermissionGroup Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkQuotePermissionGroup_Between(array $fkQuotePermissionGroup)
    {
        return $this->filterByFkQuotePermissionGroup($fkQuotePermissionGroup, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkQuotePermissionGroups Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkQuotePermissionGroup_In(array $fkQuotePermissionGroups)
    {
        return $this->filterByFkQuotePermissionGroup($fkQuotePermissionGroups, Criteria::IN);
    }

    /**
     * Filter the query on the fk_quote_permission_group column
     *
     * Example usage:
     * <code>
     * $query->filterByFkQuotePermissionGroup(1234); // WHERE fk_quote_permission_group = 1234
     * $query->filterByFkQuotePermissionGroup(array(12, 34), Criteria::IN); // WHERE fk_quote_permission_group IN (12, 34)
     * $query->filterByFkQuotePermissionGroup(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_quote_permission_group > 12
     * </code>
     *
     * @see       filterBySpyQuotePermissionGroup()
     *
     * @param     mixed $fkQuotePermissionGroup The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkQuotePermissionGroup($fkQuotePermissionGroup = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkQuotePermissionGroup)) {
            $useMinMax = false;
            if (isset($fkQuotePermissionGroup['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyQuoteCompanyUserTableMap::COL_FK_QUOTE_PERMISSION_GROUP, $fkQuotePermissionGroup['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkQuotePermissionGroup['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyQuoteCompanyUserTableMap::COL_FK_QUOTE_PERMISSION_GROUP, $fkQuotePermissionGroup['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkQuotePermissionGroup of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyQuoteCompanyUserTableMap::COL_FK_QUOTE_PERMISSION_GROUP, $fkQuotePermissionGroup, $comparison);

        return $query;
    }

    /**
     * Filter the query on the is_default column
     *
     * Example usage:
     * <code>
     * $query->filterByIsDefault(true); // WHERE is_default = true
     * $query->filterByIsDefault('yes'); // WHERE is_default = true
     * </code>
     *
     * @param     bool|string $isDefault The value to use as filter.
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
    public function filterByIsDefault($isDefault = null, $comparison = Criteria::EQUAL)
    {
        if (is_string($isDefault)) {
            $isDefault = in_array(strtolower($isDefault), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $query = $this->addUsingAlias(SpyQuoteCompanyUserTableMap::COL_IS_DEFAULT, $isDefault, $comparison);

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

        $query = $this->addUsingAlias(SpyQuoteCompanyUserTableMap::COL_UUID, $uuid, $comparison);

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
    public function filterBySpyCompanyUser($spyCompanyUser, ?string $comparison = null)
    {
        if ($spyCompanyUser instanceof \Orm\Zed\CompanyUser\Persistence\SpyCompanyUser) {
            return $this
                ->addUsingAlias(SpyQuoteCompanyUserTableMap::COL_FK_COMPANY_USER, $spyCompanyUser->getIdCompanyUser(), $comparison);
        } elseif ($spyCompanyUser instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyQuoteCompanyUserTableMap::COL_FK_COMPANY_USER, $spyCompanyUser->toKeyValue('PrimaryKey', 'IdCompanyUser'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyCompanyUser() only accepts arguments of type \Orm\Zed\CompanyUser\Persistence\SpyCompanyUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCompanyUser relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCompanyUser(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCompanyUser');

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
            $this->addJoinObject($join, 'SpyCompanyUser');
        }

        return $this;
    }

    /**
     * Use the SpyCompanyUser relation SpyCompanyUser object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery A secondary query class using the current class as primary query
     */
    public function useSpyCompanyUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyCompanyUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCompanyUser', '\Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery');
    }

    /**
     * Use the SpyCompanyUser relation SpyCompanyUser object
     *
     * @param callable(\Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery):\Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCompanyUserQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyCompanyUserQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyCompanyUser table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery The inner query object of the EXISTS statement
     */
    public function useSpyCompanyUserExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery */
        $q = $this->useExistsQuery('SpyCompanyUser', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyCompanyUser table for a NOT EXISTS query.
     *
     * @see useSpyCompanyUserExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCompanyUserNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery */
        $q = $this->useExistsQuery('SpyCompanyUser', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyCompanyUser table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery The inner query object of the IN statement
     */
    public function useInSpyCompanyUserQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery */
        $q = $this->useInQuery('SpyCompanyUser', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyCompanyUser table for a NOT IN query.
     *
     * @see useSpyCompanyUserInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyCompanyUserQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery */
        $q = $this->useInQuery('SpyCompanyUser', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Quote\Persistence\SpyQuote object
     *
     * @param \Orm\Zed\Quote\Persistence\SpyQuote|ObjectCollection $spyQuote The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyQuote($spyQuote, ?string $comparison = null)
    {
        if ($spyQuote instanceof \Orm\Zed\Quote\Persistence\SpyQuote) {
            return $this
                ->addUsingAlias(SpyQuoteCompanyUserTableMap::COL_FK_QUOTE, $spyQuote->getIdQuote(), $comparison);
        } elseif ($spyQuote instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyQuoteCompanyUserTableMap::COL_FK_QUOTE, $spyQuote->toKeyValue('PrimaryKey', 'IdQuote'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyQuote() only accepts arguments of type \Orm\Zed\Quote\Persistence\SpyQuote or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyQuote relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyQuote(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyQuote');

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
            $this->addJoinObject($join, 'SpyQuote');
        }

        return $this;
    }

    /**
     * Use the SpyQuote relation SpyQuote object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Quote\Persistence\SpyQuoteQuery A secondary query class using the current class as primary query
     */
    public function useSpyQuoteQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyQuote($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyQuote', '\Orm\Zed\Quote\Persistence\SpyQuoteQuery');
    }

    /**
     * Use the SpyQuote relation SpyQuote object
     *
     * @param callable(\Orm\Zed\Quote\Persistence\SpyQuoteQuery):\Orm\Zed\Quote\Persistence\SpyQuoteQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyQuoteQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyQuoteQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyQuote table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Quote\Persistence\SpyQuoteQuery The inner query object of the EXISTS statement
     */
    public function useSpyQuoteExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Quote\Persistence\SpyQuoteQuery */
        $q = $this->useExistsQuery('SpyQuote', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyQuote table for a NOT EXISTS query.
     *
     * @see useSpyQuoteExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Quote\Persistence\SpyQuoteQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyQuoteNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Quote\Persistence\SpyQuoteQuery */
        $q = $this->useExistsQuery('SpyQuote', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyQuote table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Quote\Persistence\SpyQuoteQuery The inner query object of the IN statement
     */
    public function useInSpyQuoteQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Quote\Persistence\SpyQuoteQuery */
        $q = $this->useInQuery('SpyQuote', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyQuote table for a NOT IN query.
     *
     * @see useSpyQuoteInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Quote\Persistence\SpyQuoteQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyQuoteQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Quote\Persistence\SpyQuoteQuery */
        $q = $this->useInQuery('SpyQuote', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroup object
     *
     * @param \Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroup|ObjectCollection $spyQuotePermissionGroup The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyQuotePermissionGroup($spyQuotePermissionGroup, ?string $comparison = null)
    {
        if ($spyQuotePermissionGroup instanceof \Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroup) {
            return $this
                ->addUsingAlias(SpyQuoteCompanyUserTableMap::COL_FK_QUOTE_PERMISSION_GROUP, $spyQuotePermissionGroup->getIdQuotePermissionGroup(), $comparison);
        } elseif ($spyQuotePermissionGroup instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyQuoteCompanyUserTableMap::COL_FK_QUOTE_PERMISSION_GROUP, $spyQuotePermissionGroup->toKeyValue('PrimaryKey', 'IdQuotePermissionGroup'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyQuotePermissionGroup() only accepts arguments of type \Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroup or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyQuotePermissionGroup relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyQuotePermissionGroup(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyQuotePermissionGroup');

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
            $this->addJoinObject($join, 'SpyQuotePermissionGroup');
        }

        return $this;
    }

    /**
     * Use the SpyQuotePermissionGroup relation SpyQuotePermissionGroup object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupQuery A secondary query class using the current class as primary query
     */
    public function useSpyQuotePermissionGroupQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyQuotePermissionGroup($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyQuotePermissionGroup', '\Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupQuery');
    }

    /**
     * Use the SpyQuotePermissionGroup relation SpyQuotePermissionGroup object
     *
     * @param callable(\Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupQuery):\Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyQuotePermissionGroupQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyQuotePermissionGroupQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyQuotePermissionGroup table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupQuery The inner query object of the EXISTS statement
     */
    public function useSpyQuotePermissionGroupExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupQuery */
        $q = $this->useExistsQuery('SpyQuotePermissionGroup', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyQuotePermissionGroup table for a NOT EXISTS query.
     *
     * @see useSpyQuotePermissionGroupExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyQuotePermissionGroupNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupQuery */
        $q = $this->useExistsQuery('SpyQuotePermissionGroup', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyQuotePermissionGroup table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupQuery The inner query object of the IN statement
     */
    public function useInSpyQuotePermissionGroupQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupQuery */
        $q = $this->useInQuery('SpyQuotePermissionGroup', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyQuotePermissionGroup table for a NOT IN query.
     *
     * @see useSpyQuotePermissionGroupInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyQuotePermissionGroupQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupQuery */
        $q = $this->useInQuery('SpyQuotePermissionGroup', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyQuoteCompanyUser $spyQuoteCompanyUser Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyQuoteCompanyUser = null)
    {
        if ($spyQuoteCompanyUser) {
            $this->addUsingAlias(SpyQuoteCompanyUserTableMap::COL_ID_QUOTE_COMPANY_USER, $spyQuoteCompanyUser->getIdQuoteCompanyUser(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_quote_company_user table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyQuoteCompanyUserTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyQuoteCompanyUserTableMap::clearInstancePool();
            SpyQuoteCompanyUserTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyQuoteCompanyUserTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyQuoteCompanyUserTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyQuoteCompanyUserTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyQuoteCompanyUserTableMap::clearRelatedInstancePool();

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
