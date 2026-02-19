<?php

namespace Orm\Zed\MerchantApp\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\KernelApp\Persistence\SpyAppConfig;
use Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboarding as ChildSpyMerchantAppOnboarding;
use Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingQuery as ChildSpyMerchantAppOnboardingQuery;
use Orm\Zed\MerchantApp\Persistence\Map\SpyMerchantAppOnboardingTableMap;
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
 * Base class that represents a query for the `spy_merchant_app_onboarding` table.
 *
 * @method     ChildSpyMerchantAppOnboardingQuery orderByIdMerchantAppOnboarding($order = Criteria::ASC) Order by the id_merchant_app_onboarding column
 * @method     ChildSpyMerchantAppOnboardingQuery orderByOnboardingUrl($order = Criteria::ASC) Order by the onboarding_url column
 * @method     ChildSpyMerchantAppOnboardingQuery orderByOnboardingStrategy($order = Criteria::ASC) Order by the onboarding_strategy column
 * @method     ChildSpyMerchantAppOnboardingQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method     ChildSpyMerchantAppOnboardingQuery orderByAppName($order = Criteria::ASC) Order by the app_name column
 * @method     ChildSpyMerchantAppOnboardingQuery orderByAppIdentifier($order = Criteria::ASC) Order by the app_identifier column
 * @method     ChildSpyMerchantAppOnboardingQuery orderByAdditionalContent($order = Criteria::ASC) Order by the additional_content column
 * @method     ChildSpyMerchantAppOnboardingQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpyMerchantAppOnboardingQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpyMerchantAppOnboardingQuery groupByIdMerchantAppOnboarding() Group by the id_merchant_app_onboarding column
 * @method     ChildSpyMerchantAppOnboardingQuery groupByOnboardingUrl() Group by the onboarding_url column
 * @method     ChildSpyMerchantAppOnboardingQuery groupByOnboardingStrategy() Group by the onboarding_strategy column
 * @method     ChildSpyMerchantAppOnboardingQuery groupByType() Group by the type column
 * @method     ChildSpyMerchantAppOnboardingQuery groupByAppName() Group by the app_name column
 * @method     ChildSpyMerchantAppOnboardingQuery groupByAppIdentifier() Group by the app_identifier column
 * @method     ChildSpyMerchantAppOnboardingQuery groupByAdditionalContent() Group by the additional_content column
 * @method     ChildSpyMerchantAppOnboardingQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpyMerchantAppOnboardingQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpyMerchantAppOnboardingQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyMerchantAppOnboardingQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyMerchantAppOnboardingQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyMerchantAppOnboardingQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyMerchantAppOnboardingQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyMerchantAppOnboardingQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyMerchantAppOnboardingQuery leftJoinSpyAppConfig($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyAppConfig relation
 * @method     ChildSpyMerchantAppOnboardingQuery rightJoinSpyAppConfig($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyAppConfig relation
 * @method     ChildSpyMerchantAppOnboardingQuery innerJoinSpyAppConfig($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyAppConfig relation
 *
 * @method     ChildSpyMerchantAppOnboardingQuery joinWithSpyAppConfig($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyAppConfig relation
 *
 * @method     ChildSpyMerchantAppOnboardingQuery leftJoinWithSpyAppConfig() Adds a LEFT JOIN clause and with to the query using the SpyAppConfig relation
 * @method     ChildSpyMerchantAppOnboardingQuery rightJoinWithSpyAppConfig() Adds a RIGHT JOIN clause and with to the query using the SpyAppConfig relation
 * @method     ChildSpyMerchantAppOnboardingQuery innerJoinWithSpyAppConfig() Adds a INNER JOIN clause and with to the query using the SpyAppConfig relation
 *
 * @method     ChildSpyMerchantAppOnboardingQuery leftJoinSpyMerchantAppOnboardingStatus($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchantAppOnboardingStatus relation
 * @method     ChildSpyMerchantAppOnboardingQuery rightJoinSpyMerchantAppOnboardingStatus($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchantAppOnboardingStatus relation
 * @method     ChildSpyMerchantAppOnboardingQuery innerJoinSpyMerchantAppOnboardingStatus($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchantAppOnboardingStatus relation
 *
 * @method     ChildSpyMerchantAppOnboardingQuery joinWithSpyMerchantAppOnboardingStatus($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchantAppOnboardingStatus relation
 *
 * @method     ChildSpyMerchantAppOnboardingQuery leftJoinWithSpyMerchantAppOnboardingStatus() Adds a LEFT JOIN clause and with to the query using the SpyMerchantAppOnboardingStatus relation
 * @method     ChildSpyMerchantAppOnboardingQuery rightJoinWithSpyMerchantAppOnboardingStatus() Adds a RIGHT JOIN clause and with to the query using the SpyMerchantAppOnboardingStatus relation
 * @method     ChildSpyMerchantAppOnboardingQuery innerJoinWithSpyMerchantAppOnboardingStatus() Adds a INNER JOIN clause and with to the query using the SpyMerchantAppOnboardingStatus relation
 *
 * @method     \Orm\Zed\KernelApp\Persistence\SpyAppConfigQuery|\Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatusQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyMerchantAppOnboarding|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyMerchantAppOnboarding matching the query
 * @method     ChildSpyMerchantAppOnboarding findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyMerchantAppOnboarding matching the query, or a new ChildSpyMerchantAppOnboarding object populated from the query conditions when no match is found
 *
 * @method     ChildSpyMerchantAppOnboarding|null findOneByIdMerchantAppOnboarding(int $id_merchant_app_onboarding) Return the first ChildSpyMerchantAppOnboarding filtered by the id_merchant_app_onboarding column
 * @method     ChildSpyMerchantAppOnboarding|null findOneByOnboardingUrl(string $onboarding_url) Return the first ChildSpyMerchantAppOnboarding filtered by the onboarding_url column
 * @method     ChildSpyMerchantAppOnboarding|null findOneByOnboardingStrategy(int $onboarding_strategy) Return the first ChildSpyMerchantAppOnboarding filtered by the onboarding_strategy column
 * @method     ChildSpyMerchantAppOnboarding|null findOneByType(string $type) Return the first ChildSpyMerchantAppOnboarding filtered by the type column
 * @method     ChildSpyMerchantAppOnboarding|null findOneByAppName(string $app_name) Return the first ChildSpyMerchantAppOnboarding filtered by the app_name column
 * @method     ChildSpyMerchantAppOnboarding|null findOneByAppIdentifier(string $app_identifier) Return the first ChildSpyMerchantAppOnboarding filtered by the app_identifier column
 * @method     ChildSpyMerchantAppOnboarding|null findOneByAdditionalContent(string $additional_content) Return the first ChildSpyMerchantAppOnboarding filtered by the additional_content column
 * @method     ChildSpyMerchantAppOnboarding|null findOneByCreatedAt(string $created_at) Return the first ChildSpyMerchantAppOnboarding filtered by the created_at column
 * @method     ChildSpyMerchantAppOnboarding|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpyMerchantAppOnboarding filtered by the updated_at column
 *
 * @method     ChildSpyMerchantAppOnboarding requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyMerchantAppOnboarding by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantAppOnboarding requireOne(?ConnectionInterface $con = null) Return the first ChildSpyMerchantAppOnboarding matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyMerchantAppOnboarding requireOneByIdMerchantAppOnboarding(int $id_merchant_app_onboarding) Return the first ChildSpyMerchantAppOnboarding filtered by the id_merchant_app_onboarding column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantAppOnboarding requireOneByOnboardingUrl(string $onboarding_url) Return the first ChildSpyMerchantAppOnboarding filtered by the onboarding_url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantAppOnboarding requireOneByOnboardingStrategy(int $onboarding_strategy) Return the first ChildSpyMerchantAppOnboarding filtered by the onboarding_strategy column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantAppOnboarding requireOneByType(string $type) Return the first ChildSpyMerchantAppOnboarding filtered by the type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantAppOnboarding requireOneByAppName(string $app_name) Return the first ChildSpyMerchantAppOnboarding filtered by the app_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantAppOnboarding requireOneByAppIdentifier(string $app_identifier) Return the first ChildSpyMerchantAppOnboarding filtered by the app_identifier column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantAppOnboarding requireOneByAdditionalContent(string $additional_content) Return the first ChildSpyMerchantAppOnboarding filtered by the additional_content column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantAppOnboarding requireOneByCreatedAt(string $created_at) Return the first ChildSpyMerchantAppOnboarding filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantAppOnboarding requireOneByUpdatedAt(string $updated_at) Return the first ChildSpyMerchantAppOnboarding filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyMerchantAppOnboarding[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyMerchantAppOnboarding objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyMerchantAppOnboarding> find(?ConnectionInterface $con = null) Return ChildSpyMerchantAppOnboarding objects based on current ModelCriteria
 *
 * @method     ChildSpyMerchantAppOnboarding[]|Collection findByIdMerchantAppOnboarding(int|array<int> $id_merchant_app_onboarding) Return ChildSpyMerchantAppOnboarding objects filtered by the id_merchant_app_onboarding column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantAppOnboarding> findByIdMerchantAppOnboarding(int|array<int> $id_merchant_app_onboarding) Return ChildSpyMerchantAppOnboarding objects filtered by the id_merchant_app_onboarding column
 * @method     ChildSpyMerchantAppOnboarding[]|Collection findByOnboardingUrl(string|array<string> $onboarding_url) Return ChildSpyMerchantAppOnboarding objects filtered by the onboarding_url column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantAppOnboarding> findByOnboardingUrl(string|array<string> $onboarding_url) Return ChildSpyMerchantAppOnboarding objects filtered by the onboarding_url column
 * @method     ChildSpyMerchantAppOnboarding[]|Collection findByOnboardingStrategy(int|array<int> $onboarding_strategy) Return ChildSpyMerchantAppOnboarding objects filtered by the onboarding_strategy column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantAppOnboarding> findByOnboardingStrategy(int|array<int> $onboarding_strategy) Return ChildSpyMerchantAppOnboarding objects filtered by the onboarding_strategy column
 * @method     ChildSpyMerchantAppOnboarding[]|Collection findByType(string|array<string> $type) Return ChildSpyMerchantAppOnboarding objects filtered by the type column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantAppOnboarding> findByType(string|array<string> $type) Return ChildSpyMerchantAppOnboarding objects filtered by the type column
 * @method     ChildSpyMerchantAppOnboarding[]|Collection findByAppName(string|array<string> $app_name) Return ChildSpyMerchantAppOnboarding objects filtered by the app_name column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantAppOnboarding> findByAppName(string|array<string> $app_name) Return ChildSpyMerchantAppOnboarding objects filtered by the app_name column
 * @method     ChildSpyMerchantAppOnboarding[]|Collection findByAppIdentifier(string|array<string> $app_identifier) Return ChildSpyMerchantAppOnboarding objects filtered by the app_identifier column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantAppOnboarding> findByAppIdentifier(string|array<string> $app_identifier) Return ChildSpyMerchantAppOnboarding objects filtered by the app_identifier column
 * @method     ChildSpyMerchantAppOnboarding[]|Collection findByAdditionalContent(string|array<string> $additional_content) Return ChildSpyMerchantAppOnboarding objects filtered by the additional_content column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantAppOnboarding> findByAdditionalContent(string|array<string> $additional_content) Return ChildSpyMerchantAppOnboarding objects filtered by the additional_content column
 * @method     ChildSpyMerchantAppOnboarding[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpyMerchantAppOnboarding objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantAppOnboarding> findByCreatedAt(string|array<string> $created_at) Return ChildSpyMerchantAppOnboarding objects filtered by the created_at column
 * @method     ChildSpyMerchantAppOnboarding[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyMerchantAppOnboarding objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantAppOnboarding> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyMerchantAppOnboarding objects filtered by the updated_at column
 *
 * @method     ChildSpyMerchantAppOnboarding[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyMerchantAppOnboarding> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyMerchantAppOnboardingQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\MerchantApp\Persistence\Base\SpyMerchantAppOnboardingQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\MerchantApp\\Persistence\\SpyMerchantAppOnboarding', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyMerchantAppOnboardingQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyMerchantAppOnboardingQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyMerchantAppOnboardingQuery) {
            return $criteria;
        }
        $query = new ChildSpyMerchantAppOnboardingQuery();
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
     * @return ChildSpyMerchantAppOnboarding|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyMerchantAppOnboardingTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyMerchantAppOnboarding A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_merchant_app_onboarding, onboarding_url, onboarding_strategy, type, app_name, app_identifier, additional_content, created_at, updated_at FROM spy_merchant_app_onboarding WHERE id_merchant_app_onboarding = :p0';
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
            /** @var ChildSpyMerchantAppOnboarding $obj */
            $obj = new ChildSpyMerchantAppOnboarding();
            $obj->hydrate($row);
            SpyMerchantAppOnboardingTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyMerchantAppOnboarding|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyMerchantAppOnboardingTableMap::COL_ID_MERCHANT_APP_ONBOARDING, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyMerchantAppOnboardingTableMap::COL_ID_MERCHANT_APP_ONBOARDING, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idMerchantAppOnboarding Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdMerchantAppOnboarding_Between(array $idMerchantAppOnboarding)
    {
        return $this->filterByIdMerchantAppOnboarding($idMerchantAppOnboarding, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idMerchantAppOnboardings Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdMerchantAppOnboarding_In(array $idMerchantAppOnboardings)
    {
        return $this->filterByIdMerchantAppOnboarding($idMerchantAppOnboardings, Criteria::IN);
    }

    /**
     * Filter the query on the id_merchant_app_onboarding column
     *
     * Example usage:
     * <code>
     * $query->filterByIdMerchantAppOnboarding(1234); // WHERE id_merchant_app_onboarding = 1234
     * $query->filterByIdMerchantAppOnboarding(array(12, 34), Criteria::IN); // WHERE id_merchant_app_onboarding IN (12, 34)
     * $query->filterByIdMerchantAppOnboarding(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_merchant_app_onboarding > 12
     * </code>
     *
     * @param     mixed $idMerchantAppOnboarding The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdMerchantAppOnboarding($idMerchantAppOnboarding = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idMerchantAppOnboarding)) {
            $useMinMax = false;
            if (isset($idMerchantAppOnboarding['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantAppOnboardingTableMap::COL_ID_MERCHANT_APP_ONBOARDING, $idMerchantAppOnboarding['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idMerchantAppOnboarding['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantAppOnboardingTableMap::COL_ID_MERCHANT_APP_ONBOARDING, $idMerchantAppOnboarding['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idMerchantAppOnboarding of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantAppOnboardingTableMap::COL_ID_MERCHANT_APP_ONBOARDING, $idMerchantAppOnboarding, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $onboardingUrls Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOnboardingUrl_In(array $onboardingUrls)
    {
        return $this->filterByOnboardingUrl($onboardingUrls, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $onboardingUrl Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOnboardingUrl_Like($onboardingUrl)
    {
        return $this->filterByOnboardingUrl($onboardingUrl, Criteria::LIKE);
    }

    /**
     * Filter the query on the onboarding_url column
     *
     * Example usage:
     * <code>
     * $query->filterByOnboardingUrl('fooValue');   // WHERE onboarding_url = 'fooValue'
     * $query->filterByOnboardingUrl('%fooValue%', Criteria::LIKE); // WHERE onboarding_url LIKE '%fooValue%'
     * $query->filterByOnboardingUrl([1, 'foo'], Criteria::IN); // WHERE onboarding_url IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $onboardingUrl The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByOnboardingUrl($onboardingUrl = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $onboardingUrl = str_replace('*', '%', $onboardingUrl);
        }

        if (is_array($onboardingUrl) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$onboardingUrl of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantAppOnboardingTableMap::COL_ONBOARDING_URL, $onboardingUrl, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $onboardingStrategys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOnboardingStrategy_In(array $onboardingStrategys)
    {
        return $this->filterByOnboardingStrategy($onboardingStrategys, Criteria::IN);
    }

    /**
     * Filter the query on the onboarding_strategy column
     *
     * @param     mixed $onboardingStrategy The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByOnboardingStrategy($onboardingStrategy = null, $comparison = Criteria::EQUAL)
    {
        $valueSet = SpyMerchantAppOnboardingTableMap::getValueSet(SpyMerchantAppOnboardingTableMap::COL_ONBOARDING_STRATEGY);
        if (is_scalar($onboardingStrategy)) {
            if (!in_array($onboardingStrategy, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $onboardingStrategy));
            }
            $onboardingStrategy = array_search($onboardingStrategy, $valueSet);
        } elseif (is_array($onboardingStrategy)) {
            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
            $convertedValues = array();
            foreach ($onboardingStrategy as $value) {
                if (!in_array($value, $valueSet)) {
                    throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $value));
                }
                $convertedValues []= array_search($value, $valueSet);
            }
            $onboardingStrategy = $convertedValues;
        }

        $query = $this->addUsingAlias(SpyMerchantAppOnboardingTableMap::COL_ONBOARDING_STRATEGY, $onboardingStrategy, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $types Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByType_In(array $types)
    {
        return $this->filterByType($types, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $type Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByType_Like($type)
    {
        return $this->filterByType($type, Criteria::LIKE);
    }

    /**
     * Filter the query on the type column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE type = 'fooValue'
     * $query->filterByType('%fooValue%', Criteria::LIKE); // WHERE type LIKE '%fooValue%'
     * $query->filterByType([1, 'foo'], Criteria::IN); // WHERE type IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $type The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByType($type = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $type = str_replace('*', '%', $type);
        }

        if (is_array($type) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$type of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantAppOnboardingTableMap::COL_TYPE, $type, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $appNames Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAppName_In(array $appNames)
    {
        return $this->filterByAppName($appNames, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $appName Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAppName_Like($appName)
    {
        return $this->filterByAppName($appName, Criteria::LIKE);
    }

    /**
     * Filter the query on the app_name column
     *
     * Example usage:
     * <code>
     * $query->filterByAppName('fooValue');   // WHERE app_name = 'fooValue'
     * $query->filterByAppName('%fooValue%', Criteria::LIKE); // WHERE app_name LIKE '%fooValue%'
     * $query->filterByAppName([1, 'foo'], Criteria::IN); // WHERE app_name IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $appName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAppName($appName = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $appName = str_replace('*', '%', $appName);
        }

        if (is_array($appName) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$appName of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantAppOnboardingTableMap::COL_APP_NAME, $appName, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $appIdentifiers Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAppIdentifier_In(array $appIdentifiers)
    {
        return $this->filterByAppIdentifier($appIdentifiers, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $appIdentifier Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAppIdentifier_Like($appIdentifier)
    {
        return $this->filterByAppIdentifier($appIdentifier, Criteria::LIKE);
    }

    /**
     * Filter the query on the app_identifier column
     *
     * Example usage:
     * <code>
     * $query->filterByAppIdentifier('fooValue');   // WHERE app_identifier = 'fooValue'
     * $query->filterByAppIdentifier('%fooValue%', Criteria::LIKE); // WHERE app_identifier LIKE '%fooValue%'
     * $query->filterByAppIdentifier([1, 'foo'], Criteria::IN); // WHERE app_identifier IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $appIdentifier The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAppIdentifier($appIdentifier = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $appIdentifier = str_replace('*', '%', $appIdentifier);
        }

        if (is_array($appIdentifier) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$appIdentifier of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantAppOnboardingTableMap::COL_APP_IDENTIFIER, $appIdentifier, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $additionalContents Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAdditionalContent_In(array $additionalContents)
    {
        return $this->filterByAdditionalContent($additionalContents, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $additionalContent Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAdditionalContent_Like($additionalContent)
    {
        return $this->filterByAdditionalContent($additionalContent, Criteria::LIKE);
    }

    /**
     * Filter the query on the additional_content column
     *
     * Example usage:
     * <code>
     * $query->filterByAdditionalContent('fooValue');   // WHERE additional_content = 'fooValue'
     * $query->filterByAdditionalContent('%fooValue%', Criteria::LIKE); // WHERE additional_content LIKE '%fooValue%'
     * $query->filterByAdditionalContent([1, 'foo'], Criteria::IN); // WHERE additional_content IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $additionalContent The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAdditionalContent($additionalContent = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $additionalContent = str_replace('*', '%', $additionalContent);
        }

        if (is_array($additionalContent) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$additionalContent of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantAppOnboardingTableMap::COL_ADDITIONAL_CONTENT, $additionalContent, $comparison);

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
                $this->addUsingAlias(SpyMerchantAppOnboardingTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantAppOnboardingTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantAppOnboardingTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SpyMerchantAppOnboardingTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantAppOnboardingTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantAppOnboardingTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\KernelApp\Persistence\SpyAppConfig object
     *
     * @param \Orm\Zed\KernelApp\Persistence\SpyAppConfig|ObjectCollection $spyAppConfig The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyAppConfig($spyAppConfig, ?string $comparison = null)
    {
        if ($spyAppConfig instanceof \Orm\Zed\KernelApp\Persistence\SpyAppConfig) {
            return $this
                ->addUsingAlias(SpyMerchantAppOnboardingTableMap::COL_APP_IDENTIFIER, $spyAppConfig->getAppIdentifier(), $comparison);
        } elseif ($spyAppConfig instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyMerchantAppOnboardingTableMap::COL_APP_IDENTIFIER, $spyAppConfig->toKeyValue('PrimaryKey', 'AppIdentifier'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyAppConfig() only accepts arguments of type \Orm\Zed\KernelApp\Persistence\SpyAppConfig or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyAppConfig relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyAppConfig(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyAppConfig');

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
            $this->addJoinObject($join, 'SpyAppConfig');
        }

        return $this;
    }

    /**
     * Use the SpyAppConfig relation SpyAppConfig object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\KernelApp\Persistence\SpyAppConfigQuery A secondary query class using the current class as primary query
     */
    public function useSpyAppConfigQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyAppConfig($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyAppConfig', '\Orm\Zed\KernelApp\Persistence\SpyAppConfigQuery');
    }

    /**
     * Use the SpyAppConfig relation SpyAppConfig object
     *
     * @param callable(\Orm\Zed\KernelApp\Persistence\SpyAppConfigQuery):\Orm\Zed\KernelApp\Persistence\SpyAppConfigQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyAppConfigQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyAppConfigQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyAppConfig table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\KernelApp\Persistence\SpyAppConfigQuery The inner query object of the EXISTS statement
     */
    public function useSpyAppConfigExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\KernelApp\Persistence\SpyAppConfigQuery */
        $q = $this->useExistsQuery('SpyAppConfig', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyAppConfig table for a NOT EXISTS query.
     *
     * @see useSpyAppConfigExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\KernelApp\Persistence\SpyAppConfigQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyAppConfigNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\KernelApp\Persistence\SpyAppConfigQuery */
        $q = $this->useExistsQuery('SpyAppConfig', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyAppConfig table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\KernelApp\Persistence\SpyAppConfigQuery The inner query object of the IN statement
     */
    public function useInSpyAppConfigQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\KernelApp\Persistence\SpyAppConfigQuery */
        $q = $this->useInQuery('SpyAppConfig', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyAppConfig table for a NOT IN query.
     *
     * @see useSpyAppConfigInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\KernelApp\Persistence\SpyAppConfigQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyAppConfigQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\KernelApp\Persistence\SpyAppConfigQuery */
        $q = $this->useInQuery('SpyAppConfig', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatus object
     *
     * @param \Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatus|ObjectCollection $spyMerchantAppOnboardingStatus the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyMerchantAppOnboardingStatus($spyMerchantAppOnboardingStatus, ?string $comparison = null)
    {
        if ($spyMerchantAppOnboardingStatus instanceof \Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatus) {
            $this
                ->addUsingAlias(SpyMerchantAppOnboardingTableMap::COL_ID_MERCHANT_APP_ONBOARDING, $spyMerchantAppOnboardingStatus->getFkMerchantAppOnboarding(), $comparison);

            return $this;
        } elseif ($spyMerchantAppOnboardingStatus instanceof ObjectCollection) {
            $this
                ->useSpyMerchantAppOnboardingStatusQuery()
                ->filterByPrimaryKeys($spyMerchantAppOnboardingStatus->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyMerchantAppOnboardingStatus() only accepts arguments of type \Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatus or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyMerchantAppOnboardingStatus relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyMerchantAppOnboardingStatus(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyMerchantAppOnboardingStatus');

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
            $this->addJoinObject($join, 'SpyMerchantAppOnboardingStatus');
        }

        return $this;
    }

    /**
     * Use the SpyMerchantAppOnboardingStatus relation SpyMerchantAppOnboardingStatus object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatusQuery A secondary query class using the current class as primary query
     */
    public function useSpyMerchantAppOnboardingStatusQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyMerchantAppOnboardingStatus($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyMerchantAppOnboardingStatus', '\Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatusQuery');
    }

    /**
     * Use the SpyMerchantAppOnboardingStatus relation SpyMerchantAppOnboardingStatus object
     *
     * @param callable(\Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatusQuery):\Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatusQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyMerchantAppOnboardingStatusQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyMerchantAppOnboardingStatusQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyMerchantAppOnboardingStatus table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatusQuery The inner query object of the EXISTS statement
     */
    public function useSpyMerchantAppOnboardingStatusExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatusQuery */
        $q = $this->useExistsQuery('SpyMerchantAppOnboardingStatus', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantAppOnboardingStatus table for a NOT EXISTS query.
     *
     * @see useSpyMerchantAppOnboardingStatusExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatusQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyMerchantAppOnboardingStatusNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatusQuery */
        $q = $this->useExistsQuery('SpyMerchantAppOnboardingStatus', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyMerchantAppOnboardingStatus table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatusQuery The inner query object of the IN statement
     */
    public function useInSpyMerchantAppOnboardingStatusQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatusQuery */
        $q = $this->useInQuery('SpyMerchantAppOnboardingStatus', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantAppOnboardingStatus table for a NOT IN query.
     *
     * @see useSpyMerchantAppOnboardingStatusInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatusQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyMerchantAppOnboardingStatusQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatusQuery */
        $q = $this->useInQuery('SpyMerchantAppOnboardingStatus', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyMerchantAppOnboarding $spyMerchantAppOnboarding Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyMerchantAppOnboarding = null)
    {
        if ($spyMerchantAppOnboarding) {
            $this->addUsingAlias(SpyMerchantAppOnboardingTableMap::COL_ID_MERCHANT_APP_ONBOARDING, $spyMerchantAppOnboarding->getIdMerchantAppOnboarding(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_merchant_app_onboarding table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantAppOnboardingTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyMerchantAppOnboardingTableMap::clearInstancePool();
            SpyMerchantAppOnboardingTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantAppOnboardingTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyMerchantAppOnboardingTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyMerchantAppOnboardingTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyMerchantAppOnboardingTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(SpyMerchantAppOnboardingTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyMerchantAppOnboardingTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyMerchantAppOnboardingTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyMerchantAppOnboardingTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpyMerchantAppOnboardingTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyMerchantAppOnboardingTableMap::COL_CREATED_AT);

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
