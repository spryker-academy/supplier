<?php

namespace Orm\Zed\Payment\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\Payment\Persistence\SpyPaymentMethod as ChildSpyPaymentMethod;
use Orm\Zed\Payment\Persistence\SpyPaymentMethodQuery as ChildSpyPaymentMethodQuery;
use Orm\Zed\Payment\Persistence\Map\SpyPaymentMethodTableMap;
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
 * Base class that represents a query for the `spy_payment_method` table.
 *
 * @method     ChildSpyPaymentMethodQuery orderByIdPaymentMethod($order = Criteria::ASC) Order by the id_payment_method column
 * @method     ChildSpyPaymentMethodQuery orderByFkPaymentProvider($order = Criteria::ASC) Order by the fk_payment_provider column
 * @method     ChildSpyPaymentMethodQuery orderByGroupName($order = Criteria::ASC) Order by the group_name column
 * @method     ChildSpyPaymentMethodQuery orderByIsActive($order = Criteria::ASC) Order by the is_active column
 * @method     ChildSpyPaymentMethodQuery orderByIsForeign($order = Criteria::ASC) Order by the is_foreign column
 * @method     ChildSpyPaymentMethodQuery orderByIsHidden($order = Criteria::ASC) Order by the is_hidden column
 * @method     ChildSpyPaymentMethodQuery orderByLabelName($order = Criteria::ASC) Order by the label_name column
 * @method     ChildSpyPaymentMethodQuery orderByLastMessageTimestamp($order = Criteria::ASC) Order by the last_message_timestamp column
 * @method     ChildSpyPaymentMethodQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildSpyPaymentMethodQuery orderByPaymentAuthorizationEndpoint($order = Criteria::ASC) Order by the payment_authorization_endpoint column
 * @method     ChildSpyPaymentMethodQuery orderByPaymentMethodAppConfiguration($order = Criteria::ASC) Order by the payment_method_app_configuration column
 * @method     ChildSpyPaymentMethodQuery orderByPaymentMethodKey($order = Criteria::ASC) Order by the payment_method_key column
 *
 * @method     ChildSpyPaymentMethodQuery groupByIdPaymentMethod() Group by the id_payment_method column
 * @method     ChildSpyPaymentMethodQuery groupByFkPaymentProvider() Group by the fk_payment_provider column
 * @method     ChildSpyPaymentMethodQuery groupByGroupName() Group by the group_name column
 * @method     ChildSpyPaymentMethodQuery groupByIsActive() Group by the is_active column
 * @method     ChildSpyPaymentMethodQuery groupByIsForeign() Group by the is_foreign column
 * @method     ChildSpyPaymentMethodQuery groupByIsHidden() Group by the is_hidden column
 * @method     ChildSpyPaymentMethodQuery groupByLabelName() Group by the label_name column
 * @method     ChildSpyPaymentMethodQuery groupByLastMessageTimestamp() Group by the last_message_timestamp column
 * @method     ChildSpyPaymentMethodQuery groupByName() Group by the name column
 * @method     ChildSpyPaymentMethodQuery groupByPaymentAuthorizationEndpoint() Group by the payment_authorization_endpoint column
 * @method     ChildSpyPaymentMethodQuery groupByPaymentMethodAppConfiguration() Group by the payment_method_app_configuration column
 * @method     ChildSpyPaymentMethodQuery groupByPaymentMethodKey() Group by the payment_method_key column
 *
 * @method     ChildSpyPaymentMethodQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyPaymentMethodQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyPaymentMethodQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyPaymentMethodQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyPaymentMethodQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyPaymentMethodQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyPaymentMethodQuery leftJoinSpyPaymentProvider($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyPaymentProvider relation
 * @method     ChildSpyPaymentMethodQuery rightJoinSpyPaymentProvider($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyPaymentProvider relation
 * @method     ChildSpyPaymentMethodQuery innerJoinSpyPaymentProvider($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyPaymentProvider relation
 *
 * @method     ChildSpyPaymentMethodQuery joinWithSpyPaymentProvider($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyPaymentProvider relation
 *
 * @method     ChildSpyPaymentMethodQuery leftJoinWithSpyPaymentProvider() Adds a LEFT JOIN clause and with to the query using the SpyPaymentProvider relation
 * @method     ChildSpyPaymentMethodQuery rightJoinWithSpyPaymentProvider() Adds a RIGHT JOIN clause and with to the query using the SpyPaymentProvider relation
 * @method     ChildSpyPaymentMethodQuery innerJoinWithSpyPaymentProvider() Adds a INNER JOIN clause and with to the query using the SpyPaymentProvider relation
 *
 * @method     ChildSpyPaymentMethodQuery leftJoinSpyPaymentMethodStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyPaymentMethodStore relation
 * @method     ChildSpyPaymentMethodQuery rightJoinSpyPaymentMethodStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyPaymentMethodStore relation
 * @method     ChildSpyPaymentMethodQuery innerJoinSpyPaymentMethodStore($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyPaymentMethodStore relation
 *
 * @method     ChildSpyPaymentMethodQuery joinWithSpyPaymentMethodStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyPaymentMethodStore relation
 *
 * @method     ChildSpyPaymentMethodQuery leftJoinWithSpyPaymentMethodStore() Adds a LEFT JOIN clause and with to the query using the SpyPaymentMethodStore relation
 * @method     ChildSpyPaymentMethodQuery rightJoinWithSpyPaymentMethodStore() Adds a RIGHT JOIN clause and with to the query using the SpyPaymentMethodStore relation
 * @method     ChildSpyPaymentMethodQuery innerJoinWithSpyPaymentMethodStore() Adds a INNER JOIN clause and with to the query using the SpyPaymentMethodStore relation
 *
 * @method     \Orm\Zed\Payment\Persistence\SpyPaymentProviderQuery|\Orm\Zed\Payment\Persistence\SpyPaymentMethodStoreQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyPaymentMethod|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyPaymentMethod matching the query
 * @method     ChildSpyPaymentMethod findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyPaymentMethod matching the query, or a new ChildSpyPaymentMethod object populated from the query conditions when no match is found
 *
 * @method     ChildSpyPaymentMethod|null findOneByIdPaymentMethod(int $id_payment_method) Return the first ChildSpyPaymentMethod filtered by the id_payment_method column
 * @method     ChildSpyPaymentMethod|null findOneByFkPaymentProvider(int $fk_payment_provider) Return the first ChildSpyPaymentMethod filtered by the fk_payment_provider column
 * @method     ChildSpyPaymentMethod|null findOneByGroupName(string $group_name) Return the first ChildSpyPaymentMethod filtered by the group_name column
 * @method     ChildSpyPaymentMethod|null findOneByIsActive(boolean $is_active) Return the first ChildSpyPaymentMethod filtered by the is_active column
 * @method     ChildSpyPaymentMethod|null findOneByIsForeign(boolean $is_foreign) Return the first ChildSpyPaymentMethod filtered by the is_foreign column
 * @method     ChildSpyPaymentMethod|null findOneByIsHidden(boolean $is_hidden) Return the first ChildSpyPaymentMethod filtered by the is_hidden column
 * @method     ChildSpyPaymentMethod|null findOneByLabelName(string $label_name) Return the first ChildSpyPaymentMethod filtered by the label_name column
 * @method     ChildSpyPaymentMethod|null findOneByLastMessageTimestamp(string $last_message_timestamp) Return the first ChildSpyPaymentMethod filtered by the last_message_timestamp column
 * @method     ChildSpyPaymentMethod|null findOneByName(string $name) Return the first ChildSpyPaymentMethod filtered by the name column
 * @method     ChildSpyPaymentMethod|null findOneByPaymentAuthorizationEndpoint(string $payment_authorization_endpoint) Return the first ChildSpyPaymentMethod filtered by the payment_authorization_endpoint column
 * @method     ChildSpyPaymentMethod|null findOneByPaymentMethodAppConfiguration(string $payment_method_app_configuration) Return the first ChildSpyPaymentMethod filtered by the payment_method_app_configuration column
 * @method     ChildSpyPaymentMethod|null findOneByPaymentMethodKey(string $payment_method_key) Return the first ChildSpyPaymentMethod filtered by the payment_method_key column
 *
 * @method     ChildSpyPaymentMethod requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyPaymentMethod by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyPaymentMethod requireOne(?ConnectionInterface $con = null) Return the first ChildSpyPaymentMethod matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyPaymentMethod requireOneByIdPaymentMethod(int $id_payment_method) Return the first ChildSpyPaymentMethod filtered by the id_payment_method column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyPaymentMethod requireOneByFkPaymentProvider(int $fk_payment_provider) Return the first ChildSpyPaymentMethod filtered by the fk_payment_provider column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyPaymentMethod requireOneByGroupName(string $group_name) Return the first ChildSpyPaymentMethod filtered by the group_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyPaymentMethod requireOneByIsActive(boolean $is_active) Return the first ChildSpyPaymentMethod filtered by the is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyPaymentMethod requireOneByIsForeign(boolean $is_foreign) Return the first ChildSpyPaymentMethod filtered by the is_foreign column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyPaymentMethod requireOneByIsHidden(boolean $is_hidden) Return the first ChildSpyPaymentMethod filtered by the is_hidden column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyPaymentMethod requireOneByLabelName(string $label_name) Return the first ChildSpyPaymentMethod filtered by the label_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyPaymentMethod requireOneByLastMessageTimestamp(string $last_message_timestamp) Return the first ChildSpyPaymentMethod filtered by the last_message_timestamp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyPaymentMethod requireOneByName(string $name) Return the first ChildSpyPaymentMethod filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyPaymentMethod requireOneByPaymentAuthorizationEndpoint(string $payment_authorization_endpoint) Return the first ChildSpyPaymentMethod filtered by the payment_authorization_endpoint column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyPaymentMethod requireOneByPaymentMethodAppConfiguration(string $payment_method_app_configuration) Return the first ChildSpyPaymentMethod filtered by the payment_method_app_configuration column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyPaymentMethod requireOneByPaymentMethodKey(string $payment_method_key) Return the first ChildSpyPaymentMethod filtered by the payment_method_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyPaymentMethod[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyPaymentMethod objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyPaymentMethod> find(?ConnectionInterface $con = null) Return ChildSpyPaymentMethod objects based on current ModelCriteria
 *
 * @method     ChildSpyPaymentMethod[]|Collection findByIdPaymentMethod(int|array<int> $id_payment_method) Return ChildSpyPaymentMethod objects filtered by the id_payment_method column
 * @psalm-method Collection&\Traversable<ChildSpyPaymentMethod> findByIdPaymentMethod(int|array<int> $id_payment_method) Return ChildSpyPaymentMethod objects filtered by the id_payment_method column
 * @method     ChildSpyPaymentMethod[]|Collection findByFkPaymentProvider(int|array<int> $fk_payment_provider) Return ChildSpyPaymentMethod objects filtered by the fk_payment_provider column
 * @psalm-method Collection&\Traversable<ChildSpyPaymentMethod> findByFkPaymentProvider(int|array<int> $fk_payment_provider) Return ChildSpyPaymentMethod objects filtered by the fk_payment_provider column
 * @method     ChildSpyPaymentMethod[]|Collection findByGroupName(string|array<string> $group_name) Return ChildSpyPaymentMethod objects filtered by the group_name column
 * @psalm-method Collection&\Traversable<ChildSpyPaymentMethod> findByGroupName(string|array<string> $group_name) Return ChildSpyPaymentMethod objects filtered by the group_name column
 * @method     ChildSpyPaymentMethod[]|Collection findByIsActive(boolean|array<boolean> $is_active) Return ChildSpyPaymentMethod objects filtered by the is_active column
 * @psalm-method Collection&\Traversable<ChildSpyPaymentMethod> findByIsActive(boolean|array<boolean> $is_active) Return ChildSpyPaymentMethod objects filtered by the is_active column
 * @method     ChildSpyPaymentMethod[]|Collection findByIsForeign(boolean|array<boolean> $is_foreign) Return ChildSpyPaymentMethod objects filtered by the is_foreign column
 * @psalm-method Collection&\Traversable<ChildSpyPaymentMethod> findByIsForeign(boolean|array<boolean> $is_foreign) Return ChildSpyPaymentMethod objects filtered by the is_foreign column
 * @method     ChildSpyPaymentMethod[]|Collection findByIsHidden(boolean|array<boolean> $is_hidden) Return ChildSpyPaymentMethod objects filtered by the is_hidden column
 * @psalm-method Collection&\Traversable<ChildSpyPaymentMethod> findByIsHidden(boolean|array<boolean> $is_hidden) Return ChildSpyPaymentMethod objects filtered by the is_hidden column
 * @method     ChildSpyPaymentMethod[]|Collection findByLabelName(string|array<string> $label_name) Return ChildSpyPaymentMethod objects filtered by the label_name column
 * @psalm-method Collection&\Traversable<ChildSpyPaymentMethod> findByLabelName(string|array<string> $label_name) Return ChildSpyPaymentMethod objects filtered by the label_name column
 * @method     ChildSpyPaymentMethod[]|Collection findByLastMessageTimestamp(string|array<string> $last_message_timestamp) Return ChildSpyPaymentMethod objects filtered by the last_message_timestamp column
 * @psalm-method Collection&\Traversable<ChildSpyPaymentMethod> findByLastMessageTimestamp(string|array<string> $last_message_timestamp) Return ChildSpyPaymentMethod objects filtered by the last_message_timestamp column
 * @method     ChildSpyPaymentMethod[]|Collection findByName(string|array<string> $name) Return ChildSpyPaymentMethod objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildSpyPaymentMethod> findByName(string|array<string> $name) Return ChildSpyPaymentMethod objects filtered by the name column
 * @method     ChildSpyPaymentMethod[]|Collection findByPaymentAuthorizationEndpoint(string|array<string> $payment_authorization_endpoint) Return ChildSpyPaymentMethod objects filtered by the payment_authorization_endpoint column
 * @psalm-method Collection&\Traversable<ChildSpyPaymentMethod> findByPaymentAuthorizationEndpoint(string|array<string> $payment_authorization_endpoint) Return ChildSpyPaymentMethod objects filtered by the payment_authorization_endpoint column
 * @method     ChildSpyPaymentMethod[]|Collection findByPaymentMethodAppConfiguration(string|array<string> $payment_method_app_configuration) Return ChildSpyPaymentMethod objects filtered by the payment_method_app_configuration column
 * @psalm-method Collection&\Traversable<ChildSpyPaymentMethod> findByPaymentMethodAppConfiguration(string|array<string> $payment_method_app_configuration) Return ChildSpyPaymentMethod objects filtered by the payment_method_app_configuration column
 * @method     ChildSpyPaymentMethod[]|Collection findByPaymentMethodKey(string|array<string> $payment_method_key) Return ChildSpyPaymentMethod objects filtered by the payment_method_key column
 * @psalm-method Collection&\Traversable<ChildSpyPaymentMethod> findByPaymentMethodKey(string|array<string> $payment_method_key) Return ChildSpyPaymentMethod objects filtered by the payment_method_key column
 *
 * @method     ChildSpyPaymentMethod[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyPaymentMethod> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyPaymentMethodQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\Payment\Persistence\Base\SpyPaymentMethodQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\Payment\\Persistence\\SpyPaymentMethod', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyPaymentMethodQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyPaymentMethodQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyPaymentMethodQuery) {
            return $criteria;
        }
        $query = new ChildSpyPaymentMethodQuery();
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
     * @return ChildSpyPaymentMethod|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyPaymentMethodTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyPaymentMethod A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id_payment_method`, `fk_payment_provider`, `group_name`, `is_active`, `is_foreign`, `is_hidden`, `label_name`, `last_message_timestamp`, `name`, `payment_authorization_endpoint`, `payment_method_app_configuration`, `payment_method_key` FROM `spy_payment_method` WHERE `id_payment_method` = :p0';
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
            /** @var ChildSpyPaymentMethod $obj */
            $obj = new ChildSpyPaymentMethod();
            $obj->hydrate($row);
            SpyPaymentMethodTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyPaymentMethod|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyPaymentMethodTableMap::COL_ID_PAYMENT_METHOD, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyPaymentMethodTableMap::COL_ID_PAYMENT_METHOD, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idPaymentMethod Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdPaymentMethod_Between(array $idPaymentMethod)
    {
        return $this->filterByIdPaymentMethod($idPaymentMethod, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idPaymentMethods Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdPaymentMethod_In(array $idPaymentMethods)
    {
        return $this->filterByIdPaymentMethod($idPaymentMethods, Criteria::IN);
    }

    /**
     * Filter the query on the id_payment_method column
     *
     * Example usage:
     * <code>
     * $query->filterByIdPaymentMethod(1234); // WHERE id_payment_method = 1234
     * $query->filterByIdPaymentMethod(array(12, 34), Criteria::IN); // WHERE id_payment_method IN (12, 34)
     * $query->filterByIdPaymentMethod(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_payment_method > 12
     * </code>
     *
     * @param     mixed $idPaymentMethod The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdPaymentMethod($idPaymentMethod = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idPaymentMethod)) {
            $useMinMax = false;
            if (isset($idPaymentMethod['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyPaymentMethodTableMap::COL_ID_PAYMENT_METHOD, $idPaymentMethod['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idPaymentMethod['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyPaymentMethodTableMap::COL_ID_PAYMENT_METHOD, $idPaymentMethod['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idPaymentMethod of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyPaymentMethodTableMap::COL_ID_PAYMENT_METHOD, $idPaymentMethod, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkPaymentProvider Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkPaymentProvider_Between(array $fkPaymentProvider)
    {
        return $this->filterByFkPaymentProvider($fkPaymentProvider, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkPaymentProviders Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkPaymentProvider_In(array $fkPaymentProviders)
    {
        return $this->filterByFkPaymentProvider($fkPaymentProviders, Criteria::IN);
    }

    /**
     * Filter the query on the fk_payment_provider column
     *
     * Example usage:
     * <code>
     * $query->filterByFkPaymentProvider(1234); // WHERE fk_payment_provider = 1234
     * $query->filterByFkPaymentProvider(array(12, 34), Criteria::IN); // WHERE fk_payment_provider IN (12, 34)
     * $query->filterByFkPaymentProvider(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_payment_provider > 12
     * </code>
     *
     * @see       filterBySpyPaymentProvider()
     *
     * @param     mixed $fkPaymentProvider The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkPaymentProvider($fkPaymentProvider = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkPaymentProvider)) {
            $useMinMax = false;
            if (isset($fkPaymentProvider['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyPaymentMethodTableMap::COL_FK_PAYMENT_PROVIDER, $fkPaymentProvider['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkPaymentProvider['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyPaymentMethodTableMap::COL_FK_PAYMENT_PROVIDER, $fkPaymentProvider['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkPaymentProvider of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyPaymentMethodTableMap::COL_FK_PAYMENT_PROVIDER, $fkPaymentProvider, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $groupNames Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGroupName_In(array $groupNames)
    {
        return $this->filterByGroupName($groupNames, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $groupName Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGroupName_Like($groupName)
    {
        return $this->filterByGroupName($groupName, Criteria::LIKE);
    }

    /**
     * Filter the query on the group_name column
     *
     * Example usage:
     * <code>
     * $query->filterByGroupName('fooValue');   // WHERE group_name = 'fooValue'
     * $query->filterByGroupName('%fooValue%', Criteria::LIKE); // WHERE group_name LIKE '%fooValue%'
     * $query->filterByGroupName([1, 'foo'], Criteria::IN); // WHERE group_name IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $groupName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByGroupName($groupName = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $groupName = str_replace('*', '%', $groupName);
        }

        if (is_array($groupName) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$groupName of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyPaymentMethodTableMap::COL_GROUP_NAME, $groupName, $comparison);

        return $query;
    }

    /**
     * Filter the query on the is_active column
     *
     * Example usage:
     * <code>
     * $query->filterByIsActive(true); // WHERE is_active = true
     * $query->filterByIsActive('yes'); // WHERE is_active = true
     * </code>
     *
     * @param     bool|string $isActive The value to use as filter.
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
    public function filterByIsActive($isActive = null, $comparison = Criteria::EQUAL)
    {
        if (is_string($isActive)) {
            $isActive = in_array(strtolower($isActive), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $query = $this->addUsingAlias(SpyPaymentMethodTableMap::COL_IS_ACTIVE, $isActive, $comparison);

        return $query;
    }

    /**
     * Filter the query on the is_foreign column
     *
     * Example usage:
     * <code>
     * $query->filterByIsForeign(true); // WHERE is_foreign = true
     * $query->filterByIsForeign('yes'); // WHERE is_foreign = true
     * </code>
     *
     * @param     bool|string $isForeign The value to use as filter.
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
    public function filterByIsForeign($isForeign = null, $comparison = Criteria::EQUAL)
    {
        if (is_string($isForeign)) {
            $isForeign = in_array(strtolower($isForeign), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $query = $this->addUsingAlias(SpyPaymentMethodTableMap::COL_IS_FOREIGN, $isForeign, $comparison);

        return $query;
    }

    /**
     * Filter the query on the is_hidden column
     *
     * Example usage:
     * <code>
     * $query->filterByIsHidden(true); // WHERE is_hidden = true
     * $query->filterByIsHidden('yes'); // WHERE is_hidden = true
     * </code>
     *
     * @param     bool|string $isHidden The value to use as filter.
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
    public function filterByIsHidden($isHidden = null, $comparison = Criteria::EQUAL)
    {
        if (is_string($isHidden)) {
            $isHidden = in_array(strtolower($isHidden), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $query = $this->addUsingAlias(SpyPaymentMethodTableMap::COL_IS_HIDDEN, $isHidden, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $labelNames Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLabelName_In(array $labelNames)
    {
        return $this->filterByLabelName($labelNames, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $labelName Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLabelName_Like($labelName)
    {
        return $this->filterByLabelName($labelName, Criteria::LIKE);
    }

    /**
     * Filter the query on the label_name column
     *
     * Example usage:
     * <code>
     * $query->filterByLabelName('fooValue');   // WHERE label_name = 'fooValue'
     * $query->filterByLabelName('%fooValue%', Criteria::LIKE); // WHERE label_name LIKE '%fooValue%'
     * $query->filterByLabelName([1, 'foo'], Criteria::IN); // WHERE label_name IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $labelName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByLabelName($labelName = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $labelName = str_replace('*', '%', $labelName);
        }

        if (is_array($labelName) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$labelName of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyPaymentMethodTableMap::COL_LABEL_NAME, $labelName, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $lastMessageTimestamp Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLastMessageTimestamp_Between(array $lastMessageTimestamp)
    {
        return $this->filterByLastMessageTimestamp($lastMessageTimestamp, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $lastMessageTimestamps Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLastMessageTimestamp_In(array $lastMessageTimestamps)
    {
        return $this->filterByLastMessageTimestamp($lastMessageTimestamps, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $lastMessageTimestamp Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLastMessageTimestamp_Like($lastMessageTimestamp)
    {
        return $this->filterByLastMessageTimestamp($lastMessageTimestamp, Criteria::LIKE);
    }

    /**
     * Filter the query on the last_message_timestamp column
     *
     * Example usage:
     * <code>
     * $query->filterByLastMessageTimestamp('2011-03-14'); // WHERE last_message_timestamp = '2011-03-14'
     * $query->filterByLastMessageTimestamp('now'); // WHERE last_message_timestamp = '2011-03-14'
     * $query->filterByLastMessageTimestamp(array('max' => 'yesterday'), SprykerCriteria::BETWEEN); // WHERE last_message_timestamp > '2011-03-13'
     * </code>
     *
     * @param     mixed $lastMessageTimestamp The value to use as filter.
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
    public function filterByLastMessageTimestamp($lastMessageTimestamp = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($lastMessageTimestamp)) {
            $useMinMax = false;
            if (isset($lastMessageTimestamp['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyPaymentMethodTableMap::COL_LAST_MESSAGE_TIMESTAMP, $lastMessageTimestamp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastMessageTimestamp['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyPaymentMethodTableMap::COL_LAST_MESSAGE_TIMESTAMP, $lastMessageTimestamp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$lastMessageTimestamp of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyPaymentMethodTableMap::COL_LAST_MESSAGE_TIMESTAMP, $lastMessageTimestamp, $comparison);

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

        $query = $this->addUsingAlias(SpyPaymentMethodTableMap::COL_NAME, $name, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $paymentAuthorizationEndpoints Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPaymentAuthorizationEndpoint_In(array $paymentAuthorizationEndpoints)
    {
        return $this->filterByPaymentAuthorizationEndpoint($paymentAuthorizationEndpoints, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $paymentAuthorizationEndpoint Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPaymentAuthorizationEndpoint_Like($paymentAuthorizationEndpoint)
    {
        return $this->filterByPaymentAuthorizationEndpoint($paymentAuthorizationEndpoint, Criteria::LIKE);
    }

    /**
     * Filter the query on the payment_authorization_endpoint column
     *
     * Example usage:
     * <code>
     * $query->filterByPaymentAuthorizationEndpoint('fooValue');   // WHERE payment_authorization_endpoint = 'fooValue'
     * $query->filterByPaymentAuthorizationEndpoint('%fooValue%', Criteria::LIKE); // WHERE payment_authorization_endpoint LIKE '%fooValue%'
     * $query->filterByPaymentAuthorizationEndpoint([1, 'foo'], Criteria::IN); // WHERE payment_authorization_endpoint IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $paymentAuthorizationEndpoint The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByPaymentAuthorizationEndpoint($paymentAuthorizationEndpoint = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $paymentAuthorizationEndpoint = str_replace('*', '%', $paymentAuthorizationEndpoint);
        }

        if (is_array($paymentAuthorizationEndpoint) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$paymentAuthorizationEndpoint of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyPaymentMethodTableMap::COL_PAYMENT_AUTHORIZATION_ENDPOINT, $paymentAuthorizationEndpoint, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $paymentMethodAppConfigurations Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPaymentMethodAppConfiguration_In(array $paymentMethodAppConfigurations)
    {
        return $this->filterByPaymentMethodAppConfiguration($paymentMethodAppConfigurations, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $paymentMethodAppConfiguration Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPaymentMethodAppConfiguration_Like($paymentMethodAppConfiguration)
    {
        return $this->filterByPaymentMethodAppConfiguration($paymentMethodAppConfiguration, Criteria::LIKE);
    }

    /**
     * Filter the query on the payment_method_app_configuration column
     *
     * Example usage:
     * <code>
     * $query->filterByPaymentMethodAppConfiguration('fooValue');   // WHERE payment_method_app_configuration = 'fooValue'
     * $query->filterByPaymentMethodAppConfiguration('%fooValue%', Criteria::LIKE); // WHERE payment_method_app_configuration LIKE '%fooValue%'
     * $query->filterByPaymentMethodAppConfiguration([1, 'foo'], Criteria::IN); // WHERE payment_method_app_configuration IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $paymentMethodAppConfiguration The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByPaymentMethodAppConfiguration($paymentMethodAppConfiguration = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $paymentMethodAppConfiguration = str_replace('*', '%', $paymentMethodAppConfiguration);
        }

        if (is_array($paymentMethodAppConfiguration) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$paymentMethodAppConfiguration of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyPaymentMethodTableMap::COL_PAYMENT_METHOD_APP_CONFIGURATION, $paymentMethodAppConfiguration, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $paymentMethodKeys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPaymentMethodKey_In(array $paymentMethodKeys)
    {
        return $this->filterByPaymentMethodKey($paymentMethodKeys, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $paymentMethodKey Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPaymentMethodKey_Like($paymentMethodKey)
    {
        return $this->filterByPaymentMethodKey($paymentMethodKey, Criteria::LIKE);
    }

    /**
     * Filter the query on the payment_method_key column
     *
     * Example usage:
     * <code>
     * $query->filterByPaymentMethodKey('fooValue');   // WHERE payment_method_key = 'fooValue'
     * $query->filterByPaymentMethodKey('%fooValue%', Criteria::LIKE); // WHERE payment_method_key LIKE '%fooValue%'
     * $query->filterByPaymentMethodKey([1, 'foo'], Criteria::IN); // WHERE payment_method_key IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $paymentMethodKey The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByPaymentMethodKey($paymentMethodKey = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $paymentMethodKey = str_replace('*', '%', $paymentMethodKey);
        }

        if (is_array($paymentMethodKey) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$paymentMethodKey of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyPaymentMethodTableMap::COL_PAYMENT_METHOD_KEY, $paymentMethodKey, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Payment\Persistence\SpyPaymentProvider object
     *
     * @param \Orm\Zed\Payment\Persistence\SpyPaymentProvider|ObjectCollection $spyPaymentProvider The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyPaymentProvider($spyPaymentProvider, ?string $comparison = null)
    {
        if ($spyPaymentProvider instanceof \Orm\Zed\Payment\Persistence\SpyPaymentProvider) {
            return $this
                ->addUsingAlias(SpyPaymentMethodTableMap::COL_FK_PAYMENT_PROVIDER, $spyPaymentProvider->getIdPaymentProvider(), $comparison);
        } elseif ($spyPaymentProvider instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyPaymentMethodTableMap::COL_FK_PAYMENT_PROVIDER, $spyPaymentProvider->toKeyValue('PrimaryKey', 'IdPaymentProvider'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyPaymentProvider() only accepts arguments of type \Orm\Zed\Payment\Persistence\SpyPaymentProvider or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyPaymentProvider relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyPaymentProvider(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyPaymentProvider');

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
            $this->addJoinObject($join, 'SpyPaymentProvider');
        }

        return $this;
    }

    /**
     * Use the SpyPaymentProvider relation SpyPaymentProvider object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Payment\Persistence\SpyPaymentProviderQuery A secondary query class using the current class as primary query
     */
    public function useSpyPaymentProviderQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyPaymentProvider($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyPaymentProvider', '\Orm\Zed\Payment\Persistence\SpyPaymentProviderQuery');
    }

    /**
     * Use the SpyPaymentProvider relation SpyPaymentProvider object
     *
     * @param callable(\Orm\Zed\Payment\Persistence\SpyPaymentProviderQuery):\Orm\Zed\Payment\Persistence\SpyPaymentProviderQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyPaymentProviderQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyPaymentProviderQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyPaymentProvider table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Payment\Persistence\SpyPaymentProviderQuery The inner query object of the EXISTS statement
     */
    public function useSpyPaymentProviderExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Payment\Persistence\SpyPaymentProviderQuery */
        $q = $this->useExistsQuery('SpyPaymentProvider', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyPaymentProvider table for a NOT EXISTS query.
     *
     * @see useSpyPaymentProviderExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Payment\Persistence\SpyPaymentProviderQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyPaymentProviderNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Payment\Persistence\SpyPaymentProviderQuery */
        $q = $this->useExistsQuery('SpyPaymentProvider', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyPaymentProvider table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Payment\Persistence\SpyPaymentProviderQuery The inner query object of the IN statement
     */
    public function useInSpyPaymentProviderQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Payment\Persistence\SpyPaymentProviderQuery */
        $q = $this->useInQuery('SpyPaymentProvider', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyPaymentProvider table for a NOT IN query.
     *
     * @see useSpyPaymentProviderInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Payment\Persistence\SpyPaymentProviderQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyPaymentProviderQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Payment\Persistence\SpyPaymentProviderQuery */
        $q = $this->useInQuery('SpyPaymentProvider', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Payment\Persistence\SpyPaymentMethodStore object
     *
     * @param \Orm\Zed\Payment\Persistence\SpyPaymentMethodStore|ObjectCollection $spyPaymentMethodStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyPaymentMethodStore($spyPaymentMethodStore, ?string $comparison = null)
    {
        if ($spyPaymentMethodStore instanceof \Orm\Zed\Payment\Persistence\SpyPaymentMethodStore) {
            $this
                ->addUsingAlias(SpyPaymentMethodTableMap::COL_ID_PAYMENT_METHOD, $spyPaymentMethodStore->getFkPaymentMethod(), $comparison);

            return $this;
        } elseif ($spyPaymentMethodStore instanceof ObjectCollection) {
            $this
                ->useSpyPaymentMethodStoreQuery()
                ->filterByPrimaryKeys($spyPaymentMethodStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyPaymentMethodStore() only accepts arguments of type \Orm\Zed\Payment\Persistence\SpyPaymentMethodStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyPaymentMethodStore relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyPaymentMethodStore(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyPaymentMethodStore');

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
            $this->addJoinObject($join, 'SpyPaymentMethodStore');
        }

        return $this;
    }

    /**
     * Use the SpyPaymentMethodStore relation SpyPaymentMethodStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Payment\Persistence\SpyPaymentMethodStoreQuery A secondary query class using the current class as primary query
     */
    public function useSpyPaymentMethodStoreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyPaymentMethodStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyPaymentMethodStore', '\Orm\Zed\Payment\Persistence\SpyPaymentMethodStoreQuery');
    }

    /**
     * Use the SpyPaymentMethodStore relation SpyPaymentMethodStore object
     *
     * @param callable(\Orm\Zed\Payment\Persistence\SpyPaymentMethodStoreQuery):\Orm\Zed\Payment\Persistence\SpyPaymentMethodStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyPaymentMethodStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyPaymentMethodStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyPaymentMethodStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Payment\Persistence\SpyPaymentMethodStoreQuery The inner query object of the EXISTS statement
     */
    public function useSpyPaymentMethodStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Payment\Persistence\SpyPaymentMethodStoreQuery */
        $q = $this->useExistsQuery('SpyPaymentMethodStore', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyPaymentMethodStore table for a NOT EXISTS query.
     *
     * @see useSpyPaymentMethodStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Payment\Persistence\SpyPaymentMethodStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyPaymentMethodStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Payment\Persistence\SpyPaymentMethodStoreQuery */
        $q = $this->useExistsQuery('SpyPaymentMethodStore', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyPaymentMethodStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Payment\Persistence\SpyPaymentMethodStoreQuery The inner query object of the IN statement
     */
    public function useInSpyPaymentMethodStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Payment\Persistence\SpyPaymentMethodStoreQuery */
        $q = $this->useInQuery('SpyPaymentMethodStore', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyPaymentMethodStore table for a NOT IN query.
     *
     * @see useSpyPaymentMethodStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Payment\Persistence\SpyPaymentMethodStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyPaymentMethodStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Payment\Persistence\SpyPaymentMethodStoreQuery */
        $q = $this->useInQuery('SpyPaymentMethodStore', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyPaymentMethod $spyPaymentMethod Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyPaymentMethod = null)
    {
        if ($spyPaymentMethod) {
            $this->addUsingAlias(SpyPaymentMethodTableMap::COL_ID_PAYMENT_METHOD, $spyPaymentMethod->getIdPaymentMethod(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_payment_method table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPaymentMethodTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyPaymentMethodTableMap::clearInstancePool();
            SpyPaymentMethodTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPaymentMethodTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyPaymentMethodTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyPaymentMethodTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyPaymentMethodTableMap::clearRelatedInstancePool();

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
