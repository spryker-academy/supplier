<?php

namespace Orm\Zed\ProductOption\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\MerchantProductOption\Persistence\SpyMerchantProductOptionGroup;
use Orm\Zed\ProductOption\Persistence\SpyProductOptionGroup as ChildSpyProductOptionGroup;
use Orm\Zed\ProductOption\Persistence\SpyProductOptionGroupQuery as ChildSpyProductOptionGroupQuery;
use Orm\Zed\ProductOption\Persistence\Map\SpyProductOptionGroupTableMap;
use Orm\Zed\Tax\Persistence\SpyTaxSet;
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
 * Base class that represents a query for the `spy_product_option_group` table.
 *
 * @method     ChildSpyProductOptionGroupQuery orderByIdProductOptionGroup($order = Criteria::ASC) Order by the id_product_option_group column
 * @method     ChildSpyProductOptionGroupQuery orderByFkTaxSet($order = Criteria::ASC) Order by the fk_tax_set column
 * @method     ChildSpyProductOptionGroupQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method     ChildSpyProductOptionGroupQuery orderByKey($order = Criteria::ASC) Order by the key column
 * @method     ChildSpyProductOptionGroupQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildSpyProductOptionGroupQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpyProductOptionGroupQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpyProductOptionGroupQuery groupByIdProductOptionGroup() Group by the id_product_option_group column
 * @method     ChildSpyProductOptionGroupQuery groupByFkTaxSet() Group by the fk_tax_set column
 * @method     ChildSpyProductOptionGroupQuery groupByActive() Group by the active column
 * @method     ChildSpyProductOptionGroupQuery groupByKey() Group by the key column
 * @method     ChildSpyProductOptionGroupQuery groupByName() Group by the name column
 * @method     ChildSpyProductOptionGroupQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpyProductOptionGroupQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpyProductOptionGroupQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyProductOptionGroupQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyProductOptionGroupQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyProductOptionGroupQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyProductOptionGroupQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyProductOptionGroupQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyProductOptionGroupQuery leftJoinSpyTaxSet($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyTaxSet relation
 * @method     ChildSpyProductOptionGroupQuery rightJoinSpyTaxSet($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyTaxSet relation
 * @method     ChildSpyProductOptionGroupQuery innerJoinSpyTaxSet($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyTaxSet relation
 *
 * @method     ChildSpyProductOptionGroupQuery joinWithSpyTaxSet($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyTaxSet relation
 *
 * @method     ChildSpyProductOptionGroupQuery leftJoinWithSpyTaxSet() Adds a LEFT JOIN clause and with to the query using the SpyTaxSet relation
 * @method     ChildSpyProductOptionGroupQuery rightJoinWithSpyTaxSet() Adds a RIGHT JOIN clause and with to the query using the SpyTaxSet relation
 * @method     ChildSpyProductOptionGroupQuery innerJoinWithSpyTaxSet() Adds a INNER JOIN clause and with to the query using the SpyTaxSet relation
 *
 * @method     ChildSpyProductOptionGroupQuery leftJoinSpyMerchantProductOptionGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchantProductOptionGroup relation
 * @method     ChildSpyProductOptionGroupQuery rightJoinSpyMerchantProductOptionGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchantProductOptionGroup relation
 * @method     ChildSpyProductOptionGroupQuery innerJoinSpyMerchantProductOptionGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchantProductOptionGroup relation
 *
 * @method     ChildSpyProductOptionGroupQuery joinWithSpyMerchantProductOptionGroup($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchantProductOptionGroup relation
 *
 * @method     ChildSpyProductOptionGroupQuery leftJoinWithSpyMerchantProductOptionGroup() Adds a LEFT JOIN clause and with to the query using the SpyMerchantProductOptionGroup relation
 * @method     ChildSpyProductOptionGroupQuery rightJoinWithSpyMerchantProductOptionGroup() Adds a RIGHT JOIN clause and with to the query using the SpyMerchantProductOptionGroup relation
 * @method     ChildSpyProductOptionGroupQuery innerJoinWithSpyMerchantProductOptionGroup() Adds a INNER JOIN clause and with to the query using the SpyMerchantProductOptionGroup relation
 *
 * @method     ChildSpyProductOptionGroupQuery leftJoinSpyProductAbstractProductOptionGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductAbstractProductOptionGroup relation
 * @method     ChildSpyProductOptionGroupQuery rightJoinSpyProductAbstractProductOptionGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductAbstractProductOptionGroup relation
 * @method     ChildSpyProductOptionGroupQuery innerJoinSpyProductAbstractProductOptionGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductAbstractProductOptionGroup relation
 *
 * @method     ChildSpyProductOptionGroupQuery joinWithSpyProductAbstractProductOptionGroup($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductAbstractProductOptionGroup relation
 *
 * @method     ChildSpyProductOptionGroupQuery leftJoinWithSpyProductAbstractProductOptionGroup() Adds a LEFT JOIN clause and with to the query using the SpyProductAbstractProductOptionGroup relation
 * @method     ChildSpyProductOptionGroupQuery rightJoinWithSpyProductAbstractProductOptionGroup() Adds a RIGHT JOIN clause and with to the query using the SpyProductAbstractProductOptionGroup relation
 * @method     ChildSpyProductOptionGroupQuery innerJoinWithSpyProductAbstractProductOptionGroup() Adds a INNER JOIN clause and with to the query using the SpyProductAbstractProductOptionGroup relation
 *
 * @method     ChildSpyProductOptionGroupQuery leftJoinSpyProductOptionValue($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductOptionValue relation
 * @method     ChildSpyProductOptionGroupQuery rightJoinSpyProductOptionValue($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductOptionValue relation
 * @method     ChildSpyProductOptionGroupQuery innerJoinSpyProductOptionValue($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductOptionValue relation
 *
 * @method     ChildSpyProductOptionGroupQuery joinWithSpyProductOptionValue($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductOptionValue relation
 *
 * @method     ChildSpyProductOptionGroupQuery leftJoinWithSpyProductOptionValue() Adds a LEFT JOIN clause and with to the query using the SpyProductOptionValue relation
 * @method     ChildSpyProductOptionGroupQuery rightJoinWithSpyProductOptionValue() Adds a RIGHT JOIN clause and with to the query using the SpyProductOptionValue relation
 * @method     ChildSpyProductOptionGroupQuery innerJoinWithSpyProductOptionValue() Adds a INNER JOIN clause and with to the query using the SpyProductOptionValue relation
 *
 * @method     \Orm\Zed\Tax\Persistence\SpyTaxSetQuery|\Orm\Zed\MerchantProductOption\Persistence\SpyMerchantProductOptionGroupQuery|\Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroupQuery|\Orm\Zed\ProductOption\Persistence\SpyProductOptionValueQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyProductOptionGroup|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyProductOptionGroup matching the query
 * @method     ChildSpyProductOptionGroup findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyProductOptionGroup matching the query, or a new ChildSpyProductOptionGroup object populated from the query conditions when no match is found
 *
 * @method     ChildSpyProductOptionGroup|null findOneByIdProductOptionGroup(int $id_product_option_group) Return the first ChildSpyProductOptionGroup filtered by the id_product_option_group column
 * @method     ChildSpyProductOptionGroup|null findOneByFkTaxSet(int $fk_tax_set) Return the first ChildSpyProductOptionGroup filtered by the fk_tax_set column
 * @method     ChildSpyProductOptionGroup|null findOneByActive(boolean $active) Return the first ChildSpyProductOptionGroup filtered by the active column
 * @method     ChildSpyProductOptionGroup|null findOneByKey(string $key) Return the first ChildSpyProductOptionGroup filtered by the key column
 * @method     ChildSpyProductOptionGroup|null findOneByName(string $name) Return the first ChildSpyProductOptionGroup filtered by the name column
 * @method     ChildSpyProductOptionGroup|null findOneByCreatedAt(string $created_at) Return the first ChildSpyProductOptionGroup filtered by the created_at column
 * @method     ChildSpyProductOptionGroup|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpyProductOptionGroup filtered by the updated_at column
 *
 * @method     ChildSpyProductOptionGroup requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyProductOptionGroup by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductOptionGroup requireOne(?ConnectionInterface $con = null) Return the first ChildSpyProductOptionGroup matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyProductOptionGroup requireOneByIdProductOptionGroup(int $id_product_option_group) Return the first ChildSpyProductOptionGroup filtered by the id_product_option_group column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductOptionGroup requireOneByFkTaxSet(int $fk_tax_set) Return the first ChildSpyProductOptionGroup filtered by the fk_tax_set column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductOptionGroup requireOneByActive(boolean $active) Return the first ChildSpyProductOptionGroup filtered by the active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductOptionGroup requireOneByKey(string $key) Return the first ChildSpyProductOptionGroup filtered by the key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductOptionGroup requireOneByName(string $name) Return the first ChildSpyProductOptionGroup filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductOptionGroup requireOneByCreatedAt(string $created_at) Return the first ChildSpyProductOptionGroup filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductOptionGroup requireOneByUpdatedAt(string $updated_at) Return the first ChildSpyProductOptionGroup filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyProductOptionGroup[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyProductOptionGroup objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyProductOptionGroup> find(?ConnectionInterface $con = null) Return ChildSpyProductOptionGroup objects based on current ModelCriteria
 *
 * @method     ChildSpyProductOptionGroup[]|Collection findByIdProductOptionGroup(int|array<int> $id_product_option_group) Return ChildSpyProductOptionGroup objects filtered by the id_product_option_group column
 * @psalm-method Collection&\Traversable<ChildSpyProductOptionGroup> findByIdProductOptionGroup(int|array<int> $id_product_option_group) Return ChildSpyProductOptionGroup objects filtered by the id_product_option_group column
 * @method     ChildSpyProductOptionGroup[]|Collection findByFkTaxSet(int|array<int> $fk_tax_set) Return ChildSpyProductOptionGroup objects filtered by the fk_tax_set column
 * @psalm-method Collection&\Traversable<ChildSpyProductOptionGroup> findByFkTaxSet(int|array<int> $fk_tax_set) Return ChildSpyProductOptionGroup objects filtered by the fk_tax_set column
 * @method     ChildSpyProductOptionGroup[]|Collection findByActive(boolean|array<boolean> $active) Return ChildSpyProductOptionGroup objects filtered by the active column
 * @psalm-method Collection&\Traversable<ChildSpyProductOptionGroup> findByActive(boolean|array<boolean> $active) Return ChildSpyProductOptionGroup objects filtered by the active column
 * @method     ChildSpyProductOptionGroup[]|Collection findByKey(string|array<string> $key) Return ChildSpyProductOptionGroup objects filtered by the key column
 * @psalm-method Collection&\Traversable<ChildSpyProductOptionGroup> findByKey(string|array<string> $key) Return ChildSpyProductOptionGroup objects filtered by the key column
 * @method     ChildSpyProductOptionGroup[]|Collection findByName(string|array<string> $name) Return ChildSpyProductOptionGroup objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildSpyProductOptionGroup> findByName(string|array<string> $name) Return ChildSpyProductOptionGroup objects filtered by the name column
 * @method     ChildSpyProductOptionGroup[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpyProductOptionGroup objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpyProductOptionGroup> findByCreatedAt(string|array<string> $created_at) Return ChildSpyProductOptionGroup objects filtered by the created_at column
 * @method     ChildSpyProductOptionGroup[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyProductOptionGroup objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpyProductOptionGroup> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyProductOptionGroup objects filtered by the updated_at column
 *
 * @method     ChildSpyProductOptionGroup[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyProductOptionGroup> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyProductOptionGroupQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\ProductOption\Persistence\Base\SpyProductOptionGroupQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\ProductOption\\Persistence\\SpyProductOptionGroup', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyProductOptionGroupQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyProductOptionGroupQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyProductOptionGroupQuery) {
            return $criteria;
        }
        $query = new ChildSpyProductOptionGroupQuery();
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
     * @return ChildSpyProductOptionGroup|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyProductOptionGroupTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyProductOptionGroup A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id_product_option_group`, `fk_tax_set`, `active`, `key`, `name`, `created_at`, `updated_at` FROM `spy_product_option_group` WHERE `id_product_option_group` = :p0';
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
            /** @var ChildSpyProductOptionGroup $obj */
            $obj = new ChildSpyProductOptionGroup();
            $obj->hydrate($row);
            SpyProductOptionGroupTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyProductOptionGroup|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyProductOptionGroupTableMap::COL_ID_PRODUCT_OPTION_GROUP, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyProductOptionGroupTableMap::COL_ID_PRODUCT_OPTION_GROUP, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idProductOptionGroup Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdProductOptionGroup_Between(array $idProductOptionGroup)
    {
        return $this->filterByIdProductOptionGroup($idProductOptionGroup, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idProductOptionGroups Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdProductOptionGroup_In(array $idProductOptionGroups)
    {
        return $this->filterByIdProductOptionGroup($idProductOptionGroups, Criteria::IN);
    }

    /**
     * Filter the query on the id_product_option_group column
     *
     * Example usage:
     * <code>
     * $query->filterByIdProductOptionGroup(1234); // WHERE id_product_option_group = 1234
     * $query->filterByIdProductOptionGroup(array(12, 34), Criteria::IN); // WHERE id_product_option_group IN (12, 34)
     * $query->filterByIdProductOptionGroup(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_product_option_group > 12
     * </code>
     *
     * @param     mixed $idProductOptionGroup The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdProductOptionGroup($idProductOptionGroup = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idProductOptionGroup)) {
            $useMinMax = false;
            if (isset($idProductOptionGroup['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductOptionGroupTableMap::COL_ID_PRODUCT_OPTION_GROUP, $idProductOptionGroup['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idProductOptionGroup['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductOptionGroupTableMap::COL_ID_PRODUCT_OPTION_GROUP, $idProductOptionGroup['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idProductOptionGroup of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductOptionGroupTableMap::COL_ID_PRODUCT_OPTION_GROUP, $idProductOptionGroup, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkTaxSet Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkTaxSet_Between(array $fkTaxSet)
    {
        return $this->filterByFkTaxSet($fkTaxSet, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkTaxSets Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkTaxSet_In(array $fkTaxSets)
    {
        return $this->filterByFkTaxSet($fkTaxSets, Criteria::IN);
    }

    /**
     * Filter the query on the fk_tax_set column
     *
     * Example usage:
     * <code>
     * $query->filterByFkTaxSet(1234); // WHERE fk_tax_set = 1234
     * $query->filterByFkTaxSet(array(12, 34), Criteria::IN); // WHERE fk_tax_set IN (12, 34)
     * $query->filterByFkTaxSet(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_tax_set > 12
     * </code>
     *
     * @see       filterBySpyTaxSet()
     *
     * @param     mixed $fkTaxSet The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkTaxSet($fkTaxSet = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkTaxSet)) {
            $useMinMax = false;
            if (isset($fkTaxSet['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductOptionGroupTableMap::COL_FK_TAX_SET, $fkTaxSet['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkTaxSet['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductOptionGroupTableMap::COL_FK_TAX_SET, $fkTaxSet['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkTaxSet of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductOptionGroupTableMap::COL_FK_TAX_SET, $fkTaxSet, $comparison);

        return $query;
    }

    /**
     * Filter the query on the active column
     *
     * Example usage:
     * <code>
     * $query->filterByActive(true); // WHERE active = true
     * $query->filterByActive('yes'); // WHERE active = true
     * </code>
     *
     * @param     bool|string $active The value to use as filter.
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
    public function filterByActive($active = null, $comparison = Criteria::EQUAL)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $query = $this->addUsingAlias(SpyProductOptionGroupTableMap::COL_ACTIVE, $active, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $keys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByKey_In(array $keys)
    {
        return $this->filterByKey($keys, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $key Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByKey_Like($key)
    {
        return $this->filterByKey($key, Criteria::LIKE);
    }

    /**
     * Filter the query on the key column
     *
     * Example usage:
     * <code>
     * $query->filterByKey('fooValue');   // WHERE key = 'fooValue'
     * $query->filterByKey('%fooValue%', Criteria::LIKE); // WHERE key LIKE '%fooValue%'
     * $query->filterByKey([1, 'foo'], Criteria::IN); // WHERE key IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $key The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByKey($key = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $key = str_replace('*', '%', $key);
        }

        if (is_array($key) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$key of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyProductOptionGroupTableMap::COL_KEY, $key, $comparison);

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

        $query = $this->addUsingAlias(SpyProductOptionGroupTableMap::COL_NAME, $name, $comparison);

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
                $this->addUsingAlias(SpyProductOptionGroupTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductOptionGroupTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductOptionGroupTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SpyProductOptionGroupTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductOptionGroupTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductOptionGroupTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Tax\Persistence\SpyTaxSet object
     *
     * @param \Orm\Zed\Tax\Persistence\SpyTaxSet|ObjectCollection $spyTaxSet The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyTaxSet($spyTaxSet, ?string $comparison = null)
    {
        if ($spyTaxSet instanceof \Orm\Zed\Tax\Persistence\SpyTaxSet) {
            return $this
                ->addUsingAlias(SpyProductOptionGroupTableMap::COL_FK_TAX_SET, $spyTaxSet->getIdTaxSet(), $comparison);
        } elseif ($spyTaxSet instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyProductOptionGroupTableMap::COL_FK_TAX_SET, $spyTaxSet->toKeyValue('PrimaryKey', 'IdTaxSet'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyTaxSet() only accepts arguments of type \Orm\Zed\Tax\Persistence\SpyTaxSet or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyTaxSet relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyTaxSet(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyTaxSet');

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
            $this->addJoinObject($join, 'SpyTaxSet');
        }

        return $this;
    }

    /**
     * Use the SpyTaxSet relation SpyTaxSet object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Tax\Persistence\SpyTaxSetQuery A secondary query class using the current class as primary query
     */
    public function useSpyTaxSetQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpyTaxSet($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyTaxSet', '\Orm\Zed\Tax\Persistence\SpyTaxSetQuery');
    }

    /**
     * Use the SpyTaxSet relation SpyTaxSet object
     *
     * @param callable(\Orm\Zed\Tax\Persistence\SpyTaxSetQuery):\Orm\Zed\Tax\Persistence\SpyTaxSetQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyTaxSetQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpyTaxSetQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyTaxSet table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Tax\Persistence\SpyTaxSetQuery The inner query object of the EXISTS statement
     */
    public function useSpyTaxSetExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Tax\Persistence\SpyTaxSetQuery */
        $q = $this->useExistsQuery('SpyTaxSet', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyTaxSet table for a NOT EXISTS query.
     *
     * @see useSpyTaxSetExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Tax\Persistence\SpyTaxSetQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyTaxSetNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Tax\Persistence\SpyTaxSetQuery */
        $q = $this->useExistsQuery('SpyTaxSet', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyTaxSet table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Tax\Persistence\SpyTaxSetQuery The inner query object of the IN statement
     */
    public function useInSpyTaxSetQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Tax\Persistence\SpyTaxSetQuery */
        $q = $this->useInQuery('SpyTaxSet', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyTaxSet table for a NOT IN query.
     *
     * @see useSpyTaxSetInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Tax\Persistence\SpyTaxSetQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyTaxSetQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Tax\Persistence\SpyTaxSetQuery */
        $q = $this->useInQuery('SpyTaxSet', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\MerchantProductOption\Persistence\SpyMerchantProductOptionGroup object
     *
     * @param \Orm\Zed\MerchantProductOption\Persistence\SpyMerchantProductOptionGroup|ObjectCollection $spyMerchantProductOptionGroup the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyMerchantProductOptionGroup($spyMerchantProductOptionGroup, ?string $comparison = null)
    {
        if ($spyMerchantProductOptionGroup instanceof \Orm\Zed\MerchantProductOption\Persistence\SpyMerchantProductOptionGroup) {
            $this
                ->addUsingAlias(SpyProductOptionGroupTableMap::COL_ID_PRODUCT_OPTION_GROUP, $spyMerchantProductOptionGroup->getFkProductOptionGroup(), $comparison);

            return $this;
        } elseif ($spyMerchantProductOptionGroup instanceof ObjectCollection) {
            $this
                ->useSpyMerchantProductOptionGroupQuery()
                ->filterByPrimaryKeys($spyMerchantProductOptionGroup->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyMerchantProductOptionGroup() only accepts arguments of type \Orm\Zed\MerchantProductOption\Persistence\SpyMerchantProductOptionGroup or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyMerchantProductOptionGroup relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyMerchantProductOptionGroup(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyMerchantProductOptionGroup');

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
            $this->addJoinObject($join, 'SpyMerchantProductOptionGroup');
        }

        return $this;
    }

    /**
     * Use the SpyMerchantProductOptionGroup relation SpyMerchantProductOptionGroup object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MerchantProductOption\Persistence\SpyMerchantProductOptionGroupQuery A secondary query class using the current class as primary query
     */
    public function useSpyMerchantProductOptionGroupQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyMerchantProductOptionGroup($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyMerchantProductOptionGroup', '\Orm\Zed\MerchantProductOption\Persistence\SpyMerchantProductOptionGroupQuery');
    }

    /**
     * Use the SpyMerchantProductOptionGroup relation SpyMerchantProductOptionGroup object
     *
     * @param callable(\Orm\Zed\MerchantProductOption\Persistence\SpyMerchantProductOptionGroupQuery):\Orm\Zed\MerchantProductOption\Persistence\SpyMerchantProductOptionGroupQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyMerchantProductOptionGroupQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyMerchantProductOptionGroupQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyMerchantProductOptionGroup table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MerchantProductOption\Persistence\SpyMerchantProductOptionGroupQuery The inner query object of the EXISTS statement
     */
    public function useSpyMerchantProductOptionGroupExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MerchantProductOption\Persistence\SpyMerchantProductOptionGroupQuery */
        $q = $this->useExistsQuery('SpyMerchantProductOptionGroup', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantProductOptionGroup table for a NOT EXISTS query.
     *
     * @see useSpyMerchantProductOptionGroupExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantProductOption\Persistence\SpyMerchantProductOptionGroupQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyMerchantProductOptionGroupNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantProductOption\Persistence\SpyMerchantProductOptionGroupQuery */
        $q = $this->useExistsQuery('SpyMerchantProductOptionGroup', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyMerchantProductOptionGroup table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MerchantProductOption\Persistence\SpyMerchantProductOptionGroupQuery The inner query object of the IN statement
     */
    public function useInSpyMerchantProductOptionGroupQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MerchantProductOption\Persistence\SpyMerchantProductOptionGroupQuery */
        $q = $this->useInQuery('SpyMerchantProductOptionGroup', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantProductOptionGroup table for a NOT IN query.
     *
     * @see useSpyMerchantProductOptionGroupInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantProductOption\Persistence\SpyMerchantProductOptionGroupQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyMerchantProductOptionGroupQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantProductOption\Persistence\SpyMerchantProductOptionGroupQuery */
        $q = $this->useInQuery('SpyMerchantProductOptionGroup', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroup object
     *
     * @param \Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroup|ObjectCollection $spyProductAbstractProductOptionGroup the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductAbstractProductOptionGroup($spyProductAbstractProductOptionGroup, ?string $comparison = null)
    {
        if ($spyProductAbstractProductOptionGroup instanceof \Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroup) {
            $this
                ->addUsingAlias(SpyProductOptionGroupTableMap::COL_ID_PRODUCT_OPTION_GROUP, $spyProductAbstractProductOptionGroup->getFkProductOptionGroup(), $comparison);

            return $this;
        } elseif ($spyProductAbstractProductOptionGroup instanceof ObjectCollection) {
            $this
                ->useSpyProductAbstractProductOptionGroupQuery()
                ->filterByPrimaryKeys($spyProductAbstractProductOptionGroup->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductAbstractProductOptionGroup() only accepts arguments of type \Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroup or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductAbstractProductOptionGroup relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductAbstractProductOptionGroup(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductAbstractProductOptionGroup');

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
            $this->addJoinObject($join, 'SpyProductAbstractProductOptionGroup');
        }

        return $this;
    }

    /**
     * Use the SpyProductAbstractProductOptionGroup relation SpyProductAbstractProductOptionGroup object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroupQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductAbstractProductOptionGroupQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductAbstractProductOptionGroup($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductAbstractProductOptionGroup', '\Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroupQuery');
    }

    /**
     * Use the SpyProductAbstractProductOptionGroup relation SpyProductAbstractProductOptionGroup object
     *
     * @param callable(\Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroupQuery):\Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroupQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductAbstractProductOptionGroupQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductAbstractProductOptionGroupQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductAbstractProductOptionGroup table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroupQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductAbstractProductOptionGroupExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroupQuery */
        $q = $this->useExistsQuery('SpyProductAbstractProductOptionGroup', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductAbstractProductOptionGroup table for a NOT EXISTS query.
     *
     * @see useSpyProductAbstractProductOptionGroupExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroupQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductAbstractProductOptionGroupNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroupQuery */
        $q = $this->useExistsQuery('SpyProductAbstractProductOptionGroup', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductAbstractProductOptionGroup table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroupQuery The inner query object of the IN statement
     */
    public function useInSpyProductAbstractProductOptionGroupQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroupQuery */
        $q = $this->useInQuery('SpyProductAbstractProductOptionGroup', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductAbstractProductOptionGroup table for a NOT IN query.
     *
     * @see useSpyProductAbstractProductOptionGroupInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroupQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductAbstractProductOptionGroupQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroupQuery */
        $q = $this->useInQuery('SpyProductAbstractProductOptionGroup', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductOption\Persistence\SpyProductOptionValue object
     *
     * @param \Orm\Zed\ProductOption\Persistence\SpyProductOptionValue|ObjectCollection $spyProductOptionValue the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductOptionValue($spyProductOptionValue, ?string $comparison = null)
    {
        if ($spyProductOptionValue instanceof \Orm\Zed\ProductOption\Persistence\SpyProductOptionValue) {
            $this
                ->addUsingAlias(SpyProductOptionGroupTableMap::COL_ID_PRODUCT_OPTION_GROUP, $spyProductOptionValue->getFkProductOptionGroup(), $comparison);

            return $this;
        } elseif ($spyProductOptionValue instanceof ObjectCollection) {
            $this
                ->useSpyProductOptionValueQuery()
                ->filterByPrimaryKeys($spyProductOptionValue->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductOptionValue() only accepts arguments of type \Orm\Zed\ProductOption\Persistence\SpyProductOptionValue or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductOptionValue relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductOptionValue(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductOptionValue');

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
            $this->addJoinObject($join, 'SpyProductOptionValue');
        }

        return $this;
    }

    /**
     * Use the SpyProductOptionValue relation SpyProductOptionValue object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductOption\Persistence\SpyProductOptionValueQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductOptionValueQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductOptionValue($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductOptionValue', '\Orm\Zed\ProductOption\Persistence\SpyProductOptionValueQuery');
    }

    /**
     * Use the SpyProductOptionValue relation SpyProductOptionValue object
     *
     * @param callable(\Orm\Zed\ProductOption\Persistence\SpyProductOptionValueQuery):\Orm\Zed\ProductOption\Persistence\SpyProductOptionValueQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductOptionValueQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductOptionValueQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductOptionValue table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductOption\Persistence\SpyProductOptionValueQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductOptionValueExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductOption\Persistence\SpyProductOptionValueQuery */
        $q = $this->useExistsQuery('SpyProductOptionValue', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductOptionValue table for a NOT EXISTS query.
     *
     * @see useSpyProductOptionValueExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductOption\Persistence\SpyProductOptionValueQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductOptionValueNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductOption\Persistence\SpyProductOptionValueQuery */
        $q = $this->useExistsQuery('SpyProductOptionValue', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductOptionValue table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductOption\Persistence\SpyProductOptionValueQuery The inner query object of the IN statement
     */
    public function useInSpyProductOptionValueQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductOption\Persistence\SpyProductOptionValueQuery */
        $q = $this->useInQuery('SpyProductOptionValue', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductOptionValue table for a NOT IN query.
     *
     * @see useSpyProductOptionValueInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductOption\Persistence\SpyProductOptionValueQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductOptionValueQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductOption\Persistence\SpyProductOptionValueQuery */
        $q = $this->useInQuery('SpyProductOptionValue', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related SpyProductAbstract object
     * using the spy_product_abstract_product_option_group table as cross reference
     *
     * @param SpyProductAbstract $spyProductAbstract the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL and Criteria::IN for queries
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductAbstract($spyProductAbstract, string $comparison = null)
    {
        $this
            ->useSpyProductAbstractProductOptionGroupQuery()
            ->filterBySpyProductAbstract($spyProductAbstract, $comparison)
            ->endUse();

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyProductOptionGroup $spyProductOptionGroup Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyProductOptionGroup = null)
    {
        if ($spyProductOptionGroup) {
            $this->addUsingAlias(SpyProductOptionGroupTableMap::COL_ID_PRODUCT_OPTION_GROUP, $spyProductOptionGroup->getIdProductOptionGroup(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_product_option_group table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductOptionGroupTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyProductOptionGroupTableMap::clearInstancePool();
            SpyProductOptionGroupTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductOptionGroupTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyProductOptionGroupTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyProductOptionGroupTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyProductOptionGroupTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(SpyProductOptionGroupTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyProductOptionGroupTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyProductOptionGroupTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyProductOptionGroupTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpyProductOptionGroupTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyProductOptionGroupTableMap::COL_CREATED_AT);

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
