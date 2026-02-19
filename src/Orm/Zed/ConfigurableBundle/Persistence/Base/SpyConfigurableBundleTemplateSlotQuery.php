<?php

namespace Orm\Zed\ConfigurableBundle\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateSlot as ChildSpyConfigurableBundleTemplateSlot;
use Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateSlotQuery as ChildSpyConfigurableBundleTemplateSlotQuery;
use Orm\Zed\ConfigurableBundle\Persistence\Map\SpyConfigurableBundleTemplateSlotTableMap;
use Orm\Zed\ProductList\Persistence\SpyProductList;
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
 * Base class that represents a query for the `spy_configurable_bundle_template_slot` table.
 *
 * @method     ChildSpyConfigurableBundleTemplateSlotQuery orderByIdConfigurableBundleTemplateSlot($order = Criteria::ASC) Order by the id_configurable_bundle_template_slot column
 * @method     ChildSpyConfigurableBundleTemplateSlotQuery orderByFkConfigurableBundleTemplate($order = Criteria::ASC) Order by the fk_configurable_bundle_template column
 * @method     ChildSpyConfigurableBundleTemplateSlotQuery orderByFkProductList($order = Criteria::ASC) Order by the fk_product_list column
 * @method     ChildSpyConfigurableBundleTemplateSlotQuery orderByKey($order = Criteria::ASC) Order by the key column
 * @method     ChildSpyConfigurableBundleTemplateSlotQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildSpyConfigurableBundleTemplateSlotQuery orderByUuid($order = Criteria::ASC) Order by the uuid column
 * @method     ChildSpyConfigurableBundleTemplateSlotQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpyConfigurableBundleTemplateSlotQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpyConfigurableBundleTemplateSlotQuery groupByIdConfigurableBundleTemplateSlot() Group by the id_configurable_bundle_template_slot column
 * @method     ChildSpyConfigurableBundleTemplateSlotQuery groupByFkConfigurableBundleTemplate() Group by the fk_configurable_bundle_template column
 * @method     ChildSpyConfigurableBundleTemplateSlotQuery groupByFkProductList() Group by the fk_product_list column
 * @method     ChildSpyConfigurableBundleTemplateSlotQuery groupByKey() Group by the key column
 * @method     ChildSpyConfigurableBundleTemplateSlotQuery groupByName() Group by the name column
 * @method     ChildSpyConfigurableBundleTemplateSlotQuery groupByUuid() Group by the uuid column
 * @method     ChildSpyConfigurableBundleTemplateSlotQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpyConfigurableBundleTemplateSlotQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpyConfigurableBundleTemplateSlotQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyConfigurableBundleTemplateSlotQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyConfigurableBundleTemplateSlotQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyConfigurableBundleTemplateSlotQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyConfigurableBundleTemplateSlotQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyConfigurableBundleTemplateSlotQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyConfigurableBundleTemplateSlotQuery leftJoinSpyConfigurableBundleTemplate($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyConfigurableBundleTemplate relation
 * @method     ChildSpyConfigurableBundleTemplateSlotQuery rightJoinSpyConfigurableBundleTemplate($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyConfigurableBundleTemplate relation
 * @method     ChildSpyConfigurableBundleTemplateSlotQuery innerJoinSpyConfigurableBundleTemplate($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyConfigurableBundleTemplate relation
 *
 * @method     ChildSpyConfigurableBundleTemplateSlotQuery joinWithSpyConfigurableBundleTemplate($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyConfigurableBundleTemplate relation
 *
 * @method     ChildSpyConfigurableBundleTemplateSlotQuery leftJoinWithSpyConfigurableBundleTemplate() Adds a LEFT JOIN clause and with to the query using the SpyConfigurableBundleTemplate relation
 * @method     ChildSpyConfigurableBundleTemplateSlotQuery rightJoinWithSpyConfigurableBundleTemplate() Adds a RIGHT JOIN clause and with to the query using the SpyConfigurableBundleTemplate relation
 * @method     ChildSpyConfigurableBundleTemplateSlotQuery innerJoinWithSpyConfigurableBundleTemplate() Adds a INNER JOIN clause and with to the query using the SpyConfigurableBundleTemplate relation
 *
 * @method     ChildSpyConfigurableBundleTemplateSlotQuery leftJoinSpyProductList($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductList relation
 * @method     ChildSpyConfigurableBundleTemplateSlotQuery rightJoinSpyProductList($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductList relation
 * @method     ChildSpyConfigurableBundleTemplateSlotQuery innerJoinSpyProductList($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductList relation
 *
 * @method     ChildSpyConfigurableBundleTemplateSlotQuery joinWithSpyProductList($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductList relation
 *
 * @method     ChildSpyConfigurableBundleTemplateSlotQuery leftJoinWithSpyProductList() Adds a LEFT JOIN clause and with to the query using the SpyProductList relation
 * @method     ChildSpyConfigurableBundleTemplateSlotQuery rightJoinWithSpyProductList() Adds a RIGHT JOIN clause and with to the query using the SpyProductList relation
 * @method     ChildSpyConfigurableBundleTemplateSlotQuery innerJoinWithSpyProductList() Adds a INNER JOIN clause and with to the query using the SpyProductList relation
 *
 * @method     \Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateQuery|\Orm\Zed\ProductList\Persistence\SpyProductListQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyConfigurableBundleTemplateSlot|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyConfigurableBundleTemplateSlot matching the query
 * @method     ChildSpyConfigurableBundleTemplateSlot findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyConfigurableBundleTemplateSlot matching the query, or a new ChildSpyConfigurableBundleTemplateSlot object populated from the query conditions when no match is found
 *
 * @method     ChildSpyConfigurableBundleTemplateSlot|null findOneByIdConfigurableBundleTemplateSlot(int $id_configurable_bundle_template_slot) Return the first ChildSpyConfigurableBundleTemplateSlot filtered by the id_configurable_bundle_template_slot column
 * @method     ChildSpyConfigurableBundleTemplateSlot|null findOneByFkConfigurableBundleTemplate(int $fk_configurable_bundle_template) Return the first ChildSpyConfigurableBundleTemplateSlot filtered by the fk_configurable_bundle_template column
 * @method     ChildSpyConfigurableBundleTemplateSlot|null findOneByFkProductList(int $fk_product_list) Return the first ChildSpyConfigurableBundleTemplateSlot filtered by the fk_product_list column
 * @method     ChildSpyConfigurableBundleTemplateSlot|null findOneByKey(string $key) Return the first ChildSpyConfigurableBundleTemplateSlot filtered by the key column
 * @method     ChildSpyConfigurableBundleTemplateSlot|null findOneByName(string $name) Return the first ChildSpyConfigurableBundleTemplateSlot filtered by the name column
 * @method     ChildSpyConfigurableBundleTemplateSlot|null findOneByUuid(string $uuid) Return the first ChildSpyConfigurableBundleTemplateSlot filtered by the uuid column
 * @method     ChildSpyConfigurableBundleTemplateSlot|null findOneByCreatedAt(string $created_at) Return the first ChildSpyConfigurableBundleTemplateSlot filtered by the created_at column
 * @method     ChildSpyConfigurableBundleTemplateSlot|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpyConfigurableBundleTemplateSlot filtered by the updated_at column
 *
 * @method     ChildSpyConfigurableBundleTemplateSlot requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyConfigurableBundleTemplateSlot by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyConfigurableBundleTemplateSlot requireOne(?ConnectionInterface $con = null) Return the first ChildSpyConfigurableBundleTemplateSlot matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyConfigurableBundleTemplateSlot requireOneByIdConfigurableBundleTemplateSlot(int $id_configurable_bundle_template_slot) Return the first ChildSpyConfigurableBundleTemplateSlot filtered by the id_configurable_bundle_template_slot column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyConfigurableBundleTemplateSlot requireOneByFkConfigurableBundleTemplate(int $fk_configurable_bundle_template) Return the first ChildSpyConfigurableBundleTemplateSlot filtered by the fk_configurable_bundle_template column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyConfigurableBundleTemplateSlot requireOneByFkProductList(int $fk_product_list) Return the first ChildSpyConfigurableBundleTemplateSlot filtered by the fk_product_list column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyConfigurableBundleTemplateSlot requireOneByKey(string $key) Return the first ChildSpyConfigurableBundleTemplateSlot filtered by the key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyConfigurableBundleTemplateSlot requireOneByName(string $name) Return the first ChildSpyConfigurableBundleTemplateSlot filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyConfigurableBundleTemplateSlot requireOneByUuid(string $uuid) Return the first ChildSpyConfigurableBundleTemplateSlot filtered by the uuid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyConfigurableBundleTemplateSlot requireOneByCreatedAt(string $created_at) Return the first ChildSpyConfigurableBundleTemplateSlot filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyConfigurableBundleTemplateSlot requireOneByUpdatedAt(string $updated_at) Return the first ChildSpyConfigurableBundleTemplateSlot filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyConfigurableBundleTemplateSlot[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyConfigurableBundleTemplateSlot objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyConfigurableBundleTemplateSlot> find(?ConnectionInterface $con = null) Return ChildSpyConfigurableBundleTemplateSlot objects based on current ModelCriteria
 *
 * @method     ChildSpyConfigurableBundleTemplateSlot[]|Collection findByIdConfigurableBundleTemplateSlot(int|array<int> $id_configurable_bundle_template_slot) Return ChildSpyConfigurableBundleTemplateSlot objects filtered by the id_configurable_bundle_template_slot column
 * @psalm-method Collection&\Traversable<ChildSpyConfigurableBundleTemplateSlot> findByIdConfigurableBundleTemplateSlot(int|array<int> $id_configurable_bundle_template_slot) Return ChildSpyConfigurableBundleTemplateSlot objects filtered by the id_configurable_bundle_template_slot column
 * @method     ChildSpyConfigurableBundleTemplateSlot[]|Collection findByFkConfigurableBundleTemplate(int|array<int> $fk_configurable_bundle_template) Return ChildSpyConfigurableBundleTemplateSlot objects filtered by the fk_configurable_bundle_template column
 * @psalm-method Collection&\Traversable<ChildSpyConfigurableBundleTemplateSlot> findByFkConfigurableBundleTemplate(int|array<int> $fk_configurable_bundle_template) Return ChildSpyConfigurableBundleTemplateSlot objects filtered by the fk_configurable_bundle_template column
 * @method     ChildSpyConfigurableBundleTemplateSlot[]|Collection findByFkProductList(int|array<int> $fk_product_list) Return ChildSpyConfigurableBundleTemplateSlot objects filtered by the fk_product_list column
 * @psalm-method Collection&\Traversable<ChildSpyConfigurableBundleTemplateSlot> findByFkProductList(int|array<int> $fk_product_list) Return ChildSpyConfigurableBundleTemplateSlot objects filtered by the fk_product_list column
 * @method     ChildSpyConfigurableBundleTemplateSlot[]|Collection findByKey(string|array<string> $key) Return ChildSpyConfigurableBundleTemplateSlot objects filtered by the key column
 * @psalm-method Collection&\Traversable<ChildSpyConfigurableBundleTemplateSlot> findByKey(string|array<string> $key) Return ChildSpyConfigurableBundleTemplateSlot objects filtered by the key column
 * @method     ChildSpyConfigurableBundleTemplateSlot[]|Collection findByName(string|array<string> $name) Return ChildSpyConfigurableBundleTemplateSlot objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildSpyConfigurableBundleTemplateSlot> findByName(string|array<string> $name) Return ChildSpyConfigurableBundleTemplateSlot objects filtered by the name column
 * @method     ChildSpyConfigurableBundleTemplateSlot[]|Collection findByUuid(string|array<string> $uuid) Return ChildSpyConfigurableBundleTemplateSlot objects filtered by the uuid column
 * @psalm-method Collection&\Traversable<ChildSpyConfigurableBundleTemplateSlot> findByUuid(string|array<string> $uuid) Return ChildSpyConfigurableBundleTemplateSlot objects filtered by the uuid column
 * @method     ChildSpyConfigurableBundleTemplateSlot[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpyConfigurableBundleTemplateSlot objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpyConfigurableBundleTemplateSlot> findByCreatedAt(string|array<string> $created_at) Return ChildSpyConfigurableBundleTemplateSlot objects filtered by the created_at column
 * @method     ChildSpyConfigurableBundleTemplateSlot[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyConfigurableBundleTemplateSlot objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpyConfigurableBundleTemplateSlot> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyConfigurableBundleTemplateSlot objects filtered by the updated_at column
 *
 * @method     ChildSpyConfigurableBundleTemplateSlot[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyConfigurableBundleTemplateSlot> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyConfigurableBundleTemplateSlotQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\ConfigurableBundle\Persistence\Base\SpyConfigurableBundleTemplateSlotQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\ConfigurableBundle\\Persistence\\SpyConfigurableBundleTemplateSlot', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyConfigurableBundleTemplateSlotQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyConfigurableBundleTemplateSlotQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyConfigurableBundleTemplateSlotQuery) {
            return $criteria;
        }
        $query = new ChildSpyConfigurableBundleTemplateSlotQuery();
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
     * @return ChildSpyConfigurableBundleTemplateSlot|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyConfigurableBundleTemplateSlotTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyConfigurableBundleTemplateSlot A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id_configurable_bundle_template_slot`, `fk_configurable_bundle_template`, `fk_product_list`, `key`, `name`, `uuid`, `created_at`, `updated_at` FROM `spy_configurable_bundle_template_slot` WHERE `id_configurable_bundle_template_slot` = :p0';
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
            /** @var ChildSpyConfigurableBundleTemplateSlot $obj */
            $obj = new ChildSpyConfigurableBundleTemplateSlot();
            $obj->hydrate($row);
            SpyConfigurableBundleTemplateSlotTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyConfigurableBundleTemplateSlot|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyConfigurableBundleTemplateSlotTableMap::COL_ID_CONFIGURABLE_BUNDLE_TEMPLATE_SLOT, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyConfigurableBundleTemplateSlotTableMap::COL_ID_CONFIGURABLE_BUNDLE_TEMPLATE_SLOT, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idConfigurableBundleTemplateSlot Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdConfigurableBundleTemplateSlot_Between(array $idConfigurableBundleTemplateSlot)
    {
        return $this->filterByIdConfigurableBundleTemplateSlot($idConfigurableBundleTemplateSlot, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idConfigurableBundleTemplateSlots Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdConfigurableBundleTemplateSlot_In(array $idConfigurableBundleTemplateSlots)
    {
        return $this->filterByIdConfigurableBundleTemplateSlot($idConfigurableBundleTemplateSlots, Criteria::IN);
    }

    /**
     * Filter the query on the id_configurable_bundle_template_slot column
     *
     * Example usage:
     * <code>
     * $query->filterByIdConfigurableBundleTemplateSlot(1234); // WHERE id_configurable_bundle_template_slot = 1234
     * $query->filterByIdConfigurableBundleTemplateSlot(array(12, 34), Criteria::IN); // WHERE id_configurable_bundle_template_slot IN (12, 34)
     * $query->filterByIdConfigurableBundleTemplateSlot(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_configurable_bundle_template_slot > 12
     * </code>
     *
     * @param     mixed $idConfigurableBundleTemplateSlot The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdConfigurableBundleTemplateSlot($idConfigurableBundleTemplateSlot = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idConfigurableBundleTemplateSlot)) {
            $useMinMax = false;
            if (isset($idConfigurableBundleTemplateSlot['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyConfigurableBundleTemplateSlotTableMap::COL_ID_CONFIGURABLE_BUNDLE_TEMPLATE_SLOT, $idConfigurableBundleTemplateSlot['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idConfigurableBundleTemplateSlot['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyConfigurableBundleTemplateSlotTableMap::COL_ID_CONFIGURABLE_BUNDLE_TEMPLATE_SLOT, $idConfigurableBundleTemplateSlot['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idConfigurableBundleTemplateSlot of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyConfigurableBundleTemplateSlotTableMap::COL_ID_CONFIGURABLE_BUNDLE_TEMPLATE_SLOT, $idConfigurableBundleTemplateSlot, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkConfigurableBundleTemplate Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkConfigurableBundleTemplate_Between(array $fkConfigurableBundleTemplate)
    {
        return $this->filterByFkConfigurableBundleTemplate($fkConfigurableBundleTemplate, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkConfigurableBundleTemplates Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkConfigurableBundleTemplate_In(array $fkConfigurableBundleTemplates)
    {
        return $this->filterByFkConfigurableBundleTemplate($fkConfigurableBundleTemplates, Criteria::IN);
    }

    /**
     * Filter the query on the fk_configurable_bundle_template column
     *
     * Example usage:
     * <code>
     * $query->filterByFkConfigurableBundleTemplate(1234); // WHERE fk_configurable_bundle_template = 1234
     * $query->filterByFkConfigurableBundleTemplate(array(12, 34), Criteria::IN); // WHERE fk_configurable_bundle_template IN (12, 34)
     * $query->filterByFkConfigurableBundleTemplate(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_configurable_bundle_template > 12
     * </code>
     *
     * @see       filterBySpyConfigurableBundleTemplate()
     *
     * @param     mixed $fkConfigurableBundleTemplate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkConfigurableBundleTemplate($fkConfigurableBundleTemplate = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkConfigurableBundleTemplate)) {
            $useMinMax = false;
            if (isset($fkConfigurableBundleTemplate['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyConfigurableBundleTemplateSlotTableMap::COL_FK_CONFIGURABLE_BUNDLE_TEMPLATE, $fkConfigurableBundleTemplate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkConfigurableBundleTemplate['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyConfigurableBundleTemplateSlotTableMap::COL_FK_CONFIGURABLE_BUNDLE_TEMPLATE, $fkConfigurableBundleTemplate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkConfigurableBundleTemplate of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyConfigurableBundleTemplateSlotTableMap::COL_FK_CONFIGURABLE_BUNDLE_TEMPLATE, $fkConfigurableBundleTemplate, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkProductList Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkProductList_Between(array $fkProductList)
    {
        return $this->filterByFkProductList($fkProductList, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkProductLists Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkProductList_In(array $fkProductLists)
    {
        return $this->filterByFkProductList($fkProductLists, Criteria::IN);
    }

    /**
     * Filter the query on the fk_product_list column
     *
     * Example usage:
     * <code>
     * $query->filterByFkProductList(1234); // WHERE fk_product_list = 1234
     * $query->filterByFkProductList(array(12, 34), Criteria::IN); // WHERE fk_product_list IN (12, 34)
     * $query->filterByFkProductList(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_product_list > 12
     * </code>
     *
     * @see       filterBySpyProductList()
     *
     * @param     mixed $fkProductList The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkProductList($fkProductList = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkProductList)) {
            $useMinMax = false;
            if (isset($fkProductList['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyConfigurableBundleTemplateSlotTableMap::COL_FK_PRODUCT_LIST, $fkProductList['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkProductList['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyConfigurableBundleTemplateSlotTableMap::COL_FK_PRODUCT_LIST, $fkProductList['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkProductList of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyConfigurableBundleTemplateSlotTableMap::COL_FK_PRODUCT_LIST, $fkProductList, $comparison);

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

        $query = $this->addUsingAlias(SpyConfigurableBundleTemplateSlotTableMap::COL_KEY, $key, $comparison);

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

        $query = $this->addUsingAlias(SpyConfigurableBundleTemplateSlotTableMap::COL_NAME, $name, $comparison);

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

        $query = $this->addUsingAlias(SpyConfigurableBundleTemplateSlotTableMap::COL_UUID, $uuid, $comparison);

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
                $this->addUsingAlias(SpyConfigurableBundleTemplateSlotTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyConfigurableBundleTemplateSlotTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyConfigurableBundleTemplateSlotTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SpyConfigurableBundleTemplateSlotTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyConfigurableBundleTemplateSlotTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyConfigurableBundleTemplateSlotTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplate object
     *
     * @param \Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplate|ObjectCollection $spyConfigurableBundleTemplate The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyConfigurableBundleTemplate($spyConfigurableBundleTemplate, ?string $comparison = null)
    {
        if ($spyConfigurableBundleTemplate instanceof \Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplate) {
            return $this
                ->addUsingAlias(SpyConfigurableBundleTemplateSlotTableMap::COL_FK_CONFIGURABLE_BUNDLE_TEMPLATE, $spyConfigurableBundleTemplate->getIdConfigurableBundleTemplate(), $comparison);
        } elseif ($spyConfigurableBundleTemplate instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyConfigurableBundleTemplateSlotTableMap::COL_FK_CONFIGURABLE_BUNDLE_TEMPLATE, $spyConfigurableBundleTemplate->toKeyValue('PrimaryKey', 'IdConfigurableBundleTemplate'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyConfigurableBundleTemplate() only accepts arguments of type \Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplate or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyConfigurableBundleTemplate relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyConfigurableBundleTemplate(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyConfigurableBundleTemplate');

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
            $this->addJoinObject($join, 'SpyConfigurableBundleTemplate');
        }

        return $this;
    }

    /**
     * Use the SpyConfigurableBundleTemplate relation SpyConfigurableBundleTemplate object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateQuery A secondary query class using the current class as primary query
     */
    public function useSpyConfigurableBundleTemplateQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyConfigurableBundleTemplate($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyConfigurableBundleTemplate', '\Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateQuery');
    }

    /**
     * Use the SpyConfigurableBundleTemplate relation SpyConfigurableBundleTemplate object
     *
     * @param callable(\Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateQuery):\Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyConfigurableBundleTemplateQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyConfigurableBundleTemplateQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyConfigurableBundleTemplate table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateQuery The inner query object of the EXISTS statement
     */
    public function useSpyConfigurableBundleTemplateExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateQuery */
        $q = $this->useExistsQuery('SpyConfigurableBundleTemplate', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyConfigurableBundleTemplate table for a NOT EXISTS query.
     *
     * @see useSpyConfigurableBundleTemplateExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyConfigurableBundleTemplateNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateQuery */
        $q = $this->useExistsQuery('SpyConfigurableBundleTemplate', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyConfigurableBundleTemplate table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateQuery The inner query object of the IN statement
     */
    public function useInSpyConfigurableBundleTemplateQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateQuery */
        $q = $this->useInQuery('SpyConfigurableBundleTemplate', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyConfigurableBundleTemplate table for a NOT IN query.
     *
     * @see useSpyConfigurableBundleTemplateInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyConfigurableBundleTemplateQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateQuery */
        $q = $this->useInQuery('SpyConfigurableBundleTemplate', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductList\Persistence\SpyProductList object
     *
     * @param \Orm\Zed\ProductList\Persistence\SpyProductList|ObjectCollection $spyProductList The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductList($spyProductList, ?string $comparison = null)
    {
        if ($spyProductList instanceof \Orm\Zed\ProductList\Persistence\SpyProductList) {
            return $this
                ->addUsingAlias(SpyConfigurableBundleTemplateSlotTableMap::COL_FK_PRODUCT_LIST, $spyProductList->getIdProductList(), $comparison);
        } elseif ($spyProductList instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyConfigurableBundleTemplateSlotTableMap::COL_FK_PRODUCT_LIST, $spyProductList->toKeyValue('PrimaryKey', 'IdProductList'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyProductList() only accepts arguments of type \Orm\Zed\ProductList\Persistence\SpyProductList or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductList relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductList(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductList');

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
            $this->addJoinObject($join, 'SpyProductList');
        }

        return $this;
    }

    /**
     * Use the SpyProductList relation SpyProductList object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductListQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpyProductList($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductList', '\Orm\Zed\ProductList\Persistence\SpyProductListQuery');
    }

    /**
     * Use the SpyProductList relation SpyProductList object
     *
     * @param callable(\Orm\Zed\ProductList\Persistence\SpyProductListQuery):\Orm\Zed\ProductList\Persistence\SpyProductListQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductListQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpyProductListQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductList table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductListExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductList\Persistence\SpyProductListQuery */
        $q = $this->useExistsQuery('SpyProductList', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductList table for a NOT EXISTS query.
     *
     * @see useSpyProductListExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductListNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductList\Persistence\SpyProductListQuery */
        $q = $this->useExistsQuery('SpyProductList', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductList table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListQuery The inner query object of the IN statement
     */
    public function useInSpyProductListQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductList\Persistence\SpyProductListQuery */
        $q = $this->useInQuery('SpyProductList', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductList table for a NOT IN query.
     *
     * @see useSpyProductListInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductListQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductList\Persistence\SpyProductListQuery */
        $q = $this->useInQuery('SpyProductList', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyConfigurableBundleTemplateSlot $spyConfigurableBundleTemplateSlot Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyConfigurableBundleTemplateSlot = null)
    {
        if ($spyConfigurableBundleTemplateSlot) {
            $this->addUsingAlias(SpyConfigurableBundleTemplateSlotTableMap::COL_ID_CONFIGURABLE_BUNDLE_TEMPLATE_SLOT, $spyConfigurableBundleTemplateSlot->getIdConfigurableBundleTemplateSlot(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_configurable_bundle_template_slot table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyConfigurableBundleTemplateSlotTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyConfigurableBundleTemplateSlotTableMap::clearInstancePool();
            SpyConfigurableBundleTemplateSlotTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyConfigurableBundleTemplateSlotTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyConfigurableBundleTemplateSlotTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyConfigurableBundleTemplateSlotTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyConfigurableBundleTemplateSlotTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(SpyConfigurableBundleTemplateSlotTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyConfigurableBundleTemplateSlotTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyConfigurableBundleTemplateSlotTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyConfigurableBundleTemplateSlotTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpyConfigurableBundleTemplateSlotTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyConfigurableBundleTemplateSlotTableMap::COL_CREATED_AT);

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
