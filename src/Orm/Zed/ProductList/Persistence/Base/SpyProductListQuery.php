<?php

namespace Orm\Zed\ProductList\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateSlot;
use Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationship;
use Orm\Zed\ProductList\Persistence\SpyProductList as ChildSpyProductList;
use Orm\Zed\ProductList\Persistence\SpyProductListQuery as ChildSpyProductListQuery;
use Orm\Zed\ProductList\Persistence\Map\SpyProductListTableMap;
use Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductList;
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
 * Base class that represents a query for the `spy_product_list` table.
 *
 * @method     ChildSpyProductListQuery orderByIdProductList($order = Criteria::ASC) Order by the id_product_list column
 * @method     ChildSpyProductListQuery orderByFkMerchantRelationship($order = Criteria::ASC) Order by the fk_merchant_relationship column
 * @method     ChildSpyProductListQuery orderByKey($order = Criteria::ASC) Order by the key column
 * @method     ChildSpyProductListQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildSpyProductListQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method     ChildSpyProductListQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpyProductListQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpyProductListQuery groupByIdProductList() Group by the id_product_list column
 * @method     ChildSpyProductListQuery groupByFkMerchantRelationship() Group by the fk_merchant_relationship column
 * @method     ChildSpyProductListQuery groupByKey() Group by the key column
 * @method     ChildSpyProductListQuery groupByTitle() Group by the title column
 * @method     ChildSpyProductListQuery groupByType() Group by the type column
 * @method     ChildSpyProductListQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpyProductListQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpyProductListQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyProductListQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyProductListQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyProductListQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyProductListQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyProductListQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyProductListQuery leftJoinSpyMerchantRelationship($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchantRelationship relation
 * @method     ChildSpyProductListQuery rightJoinSpyMerchantRelationship($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchantRelationship relation
 * @method     ChildSpyProductListQuery innerJoinSpyMerchantRelationship($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchantRelationship relation
 *
 * @method     ChildSpyProductListQuery joinWithSpyMerchantRelationship($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchantRelationship relation
 *
 * @method     ChildSpyProductListQuery leftJoinWithSpyMerchantRelationship() Adds a LEFT JOIN clause and with to the query using the SpyMerchantRelationship relation
 * @method     ChildSpyProductListQuery rightJoinWithSpyMerchantRelationship() Adds a RIGHT JOIN clause and with to the query using the SpyMerchantRelationship relation
 * @method     ChildSpyProductListQuery innerJoinWithSpyMerchantRelationship() Adds a INNER JOIN clause and with to the query using the SpyMerchantRelationship relation
 *
 * @method     ChildSpyProductListQuery leftJoinSpyConfigurableBundleTemplateSlot($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyConfigurableBundleTemplateSlot relation
 * @method     ChildSpyProductListQuery rightJoinSpyConfigurableBundleTemplateSlot($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyConfigurableBundleTemplateSlot relation
 * @method     ChildSpyProductListQuery innerJoinSpyConfigurableBundleTemplateSlot($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyConfigurableBundleTemplateSlot relation
 *
 * @method     ChildSpyProductListQuery joinWithSpyConfigurableBundleTemplateSlot($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyConfigurableBundleTemplateSlot relation
 *
 * @method     ChildSpyProductListQuery leftJoinWithSpyConfigurableBundleTemplateSlot() Adds a LEFT JOIN clause and with to the query using the SpyConfigurableBundleTemplateSlot relation
 * @method     ChildSpyProductListQuery rightJoinWithSpyConfigurableBundleTemplateSlot() Adds a RIGHT JOIN clause and with to the query using the SpyConfigurableBundleTemplateSlot relation
 * @method     ChildSpyProductListQuery innerJoinWithSpyConfigurableBundleTemplateSlot() Adds a INNER JOIN clause and with to the query using the SpyConfigurableBundleTemplateSlot relation
 *
 * @method     ChildSpyProductListQuery leftJoinSpyProductListProductConcrete($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductListProductConcrete relation
 * @method     ChildSpyProductListQuery rightJoinSpyProductListProductConcrete($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductListProductConcrete relation
 * @method     ChildSpyProductListQuery innerJoinSpyProductListProductConcrete($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductListProductConcrete relation
 *
 * @method     ChildSpyProductListQuery joinWithSpyProductListProductConcrete($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductListProductConcrete relation
 *
 * @method     ChildSpyProductListQuery leftJoinWithSpyProductListProductConcrete() Adds a LEFT JOIN clause and with to the query using the SpyProductListProductConcrete relation
 * @method     ChildSpyProductListQuery rightJoinWithSpyProductListProductConcrete() Adds a RIGHT JOIN clause and with to the query using the SpyProductListProductConcrete relation
 * @method     ChildSpyProductListQuery innerJoinWithSpyProductListProductConcrete() Adds a INNER JOIN clause and with to the query using the SpyProductListProductConcrete relation
 *
 * @method     ChildSpyProductListQuery leftJoinSpyProductListCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductListCategory relation
 * @method     ChildSpyProductListQuery rightJoinSpyProductListCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductListCategory relation
 * @method     ChildSpyProductListQuery innerJoinSpyProductListCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductListCategory relation
 *
 * @method     ChildSpyProductListQuery joinWithSpyProductListCategory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductListCategory relation
 *
 * @method     ChildSpyProductListQuery leftJoinWithSpyProductListCategory() Adds a LEFT JOIN clause and with to the query using the SpyProductListCategory relation
 * @method     ChildSpyProductListQuery rightJoinWithSpyProductListCategory() Adds a RIGHT JOIN clause and with to the query using the SpyProductListCategory relation
 * @method     ChildSpyProductListQuery innerJoinWithSpyProductListCategory() Adds a INNER JOIN clause and with to the query using the SpyProductListCategory relation
 *
 * @method     ChildSpyProductListQuery leftJoinSpySspModelToProductList($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpySspModelToProductList relation
 * @method     ChildSpyProductListQuery rightJoinSpySspModelToProductList($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpySspModelToProductList relation
 * @method     ChildSpyProductListQuery innerJoinSpySspModelToProductList($relationAlias = null) Adds a INNER JOIN clause to the query using the SpySspModelToProductList relation
 *
 * @method     ChildSpyProductListQuery joinWithSpySspModelToProductList($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpySspModelToProductList relation
 *
 * @method     ChildSpyProductListQuery leftJoinWithSpySspModelToProductList() Adds a LEFT JOIN clause and with to the query using the SpySspModelToProductList relation
 * @method     ChildSpyProductListQuery rightJoinWithSpySspModelToProductList() Adds a RIGHT JOIN clause and with to the query using the SpySspModelToProductList relation
 * @method     ChildSpyProductListQuery innerJoinWithSpySspModelToProductList() Adds a INNER JOIN clause and with to the query using the SpySspModelToProductList relation
 *
 * @method     \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipQuery|\Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateSlotQuery|\Orm\Zed\ProductList\Persistence\SpyProductListProductConcreteQuery|\Orm\Zed\ProductList\Persistence\SpyProductListCategoryQuery|\Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductListQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyProductList|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyProductList matching the query
 * @method     ChildSpyProductList findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyProductList matching the query, or a new ChildSpyProductList object populated from the query conditions when no match is found
 *
 * @method     ChildSpyProductList|null findOneByIdProductList(int $id_product_list) Return the first ChildSpyProductList filtered by the id_product_list column
 * @method     ChildSpyProductList|null findOneByFkMerchantRelationship(int $fk_merchant_relationship) Return the first ChildSpyProductList filtered by the fk_merchant_relationship column
 * @method     ChildSpyProductList|null findOneByKey(string $key) Return the first ChildSpyProductList filtered by the key column
 * @method     ChildSpyProductList|null findOneByTitle(string $title) Return the first ChildSpyProductList filtered by the title column
 * @method     ChildSpyProductList|null findOneByType(int $type) Return the first ChildSpyProductList filtered by the type column
 * @method     ChildSpyProductList|null findOneByCreatedAt(string $created_at) Return the first ChildSpyProductList filtered by the created_at column
 * @method     ChildSpyProductList|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpyProductList filtered by the updated_at column
 *
 * @method     ChildSpyProductList requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyProductList by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductList requireOne(?ConnectionInterface $con = null) Return the first ChildSpyProductList matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyProductList requireOneByIdProductList(int $id_product_list) Return the first ChildSpyProductList filtered by the id_product_list column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductList requireOneByFkMerchantRelationship(int $fk_merchant_relationship) Return the first ChildSpyProductList filtered by the fk_merchant_relationship column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductList requireOneByKey(string $key) Return the first ChildSpyProductList filtered by the key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductList requireOneByTitle(string $title) Return the first ChildSpyProductList filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductList requireOneByType(int $type) Return the first ChildSpyProductList filtered by the type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductList requireOneByCreatedAt(string $created_at) Return the first ChildSpyProductList filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductList requireOneByUpdatedAt(string $updated_at) Return the first ChildSpyProductList filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyProductList[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyProductList objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyProductList> find(?ConnectionInterface $con = null) Return ChildSpyProductList objects based on current ModelCriteria
 *
 * @method     ChildSpyProductList[]|Collection findByIdProductList(int|array<int> $id_product_list) Return ChildSpyProductList objects filtered by the id_product_list column
 * @psalm-method Collection&\Traversable<ChildSpyProductList> findByIdProductList(int|array<int> $id_product_list) Return ChildSpyProductList objects filtered by the id_product_list column
 * @method     ChildSpyProductList[]|Collection findByFkMerchantRelationship(int|array<int> $fk_merchant_relationship) Return ChildSpyProductList objects filtered by the fk_merchant_relationship column
 * @psalm-method Collection&\Traversable<ChildSpyProductList> findByFkMerchantRelationship(int|array<int> $fk_merchant_relationship) Return ChildSpyProductList objects filtered by the fk_merchant_relationship column
 * @method     ChildSpyProductList[]|Collection findByKey(string|array<string> $key) Return ChildSpyProductList objects filtered by the key column
 * @psalm-method Collection&\Traversable<ChildSpyProductList> findByKey(string|array<string> $key) Return ChildSpyProductList objects filtered by the key column
 * @method     ChildSpyProductList[]|Collection findByTitle(string|array<string> $title) Return ChildSpyProductList objects filtered by the title column
 * @psalm-method Collection&\Traversable<ChildSpyProductList> findByTitle(string|array<string> $title) Return ChildSpyProductList objects filtered by the title column
 * @method     ChildSpyProductList[]|Collection findByType(int|array<int> $type) Return ChildSpyProductList objects filtered by the type column
 * @psalm-method Collection&\Traversable<ChildSpyProductList> findByType(int|array<int> $type) Return ChildSpyProductList objects filtered by the type column
 * @method     ChildSpyProductList[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpyProductList objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpyProductList> findByCreatedAt(string|array<string> $created_at) Return ChildSpyProductList objects filtered by the created_at column
 * @method     ChildSpyProductList[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyProductList objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpyProductList> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyProductList objects filtered by the updated_at column
 *
 * @method     ChildSpyProductList[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyProductList> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyProductListQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\ProductList\Persistence\Base\SpyProductListQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\ProductList\\Persistence\\SpyProductList', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyProductListQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyProductListQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyProductListQuery) {
            return $criteria;
        }
        $query = new ChildSpyProductListQuery();
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
     * @return ChildSpyProductList|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyProductListTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyProductList A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id_product_list`, `fk_merchant_relationship`, `key`, `title`, `type`, `created_at`, `updated_at` FROM `spy_product_list` WHERE `id_product_list` = :p0';
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
            /** @var ChildSpyProductList $obj */
            $obj = new ChildSpyProductList();
            $obj->hydrate($row);
            SpyProductListTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyProductList|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyProductListTableMap::COL_ID_PRODUCT_LIST, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyProductListTableMap::COL_ID_PRODUCT_LIST, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idProductList Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdProductList_Between(array $idProductList)
    {
        return $this->filterByIdProductList($idProductList, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idProductLists Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdProductList_In(array $idProductLists)
    {
        return $this->filterByIdProductList($idProductLists, Criteria::IN);
    }

    /**
     * Filter the query on the id_product_list column
     *
     * Example usage:
     * <code>
     * $query->filterByIdProductList(1234); // WHERE id_product_list = 1234
     * $query->filterByIdProductList(array(12, 34), Criteria::IN); // WHERE id_product_list IN (12, 34)
     * $query->filterByIdProductList(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_product_list > 12
     * </code>
     *
     * @param     mixed $idProductList The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdProductList($idProductList = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idProductList)) {
            $useMinMax = false;
            if (isset($idProductList['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductListTableMap::COL_ID_PRODUCT_LIST, $idProductList['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idProductList['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductListTableMap::COL_ID_PRODUCT_LIST, $idProductList['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idProductList of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductListTableMap::COL_ID_PRODUCT_LIST, $idProductList, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkMerchantRelationship Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkMerchantRelationship_Between(array $fkMerchantRelationship)
    {
        return $this->filterByFkMerchantRelationship($fkMerchantRelationship, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkMerchantRelationships Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkMerchantRelationship_In(array $fkMerchantRelationships)
    {
        return $this->filterByFkMerchantRelationship($fkMerchantRelationships, Criteria::IN);
    }

    /**
     * Filter the query on the fk_merchant_relationship column
     *
     * Example usage:
     * <code>
     * $query->filterByFkMerchantRelationship(1234); // WHERE fk_merchant_relationship = 1234
     * $query->filterByFkMerchantRelationship(array(12, 34), Criteria::IN); // WHERE fk_merchant_relationship IN (12, 34)
     * $query->filterByFkMerchantRelationship(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_merchant_relationship > 12
     * </code>
     *
     * @see       filterBySpyMerchantRelationship()
     *
     * @param     mixed $fkMerchantRelationship The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkMerchantRelationship($fkMerchantRelationship = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkMerchantRelationship)) {
            $useMinMax = false;
            if (isset($fkMerchantRelationship['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductListTableMap::COL_FK_MERCHANT_RELATIONSHIP, $fkMerchantRelationship['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkMerchantRelationship['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductListTableMap::COL_FK_MERCHANT_RELATIONSHIP, $fkMerchantRelationship['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkMerchantRelationship of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductListTableMap::COL_FK_MERCHANT_RELATIONSHIP, $fkMerchantRelationship, $comparison);

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

        $query = $this->addUsingAlias(SpyProductListTableMap::COL_KEY, $key, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $titles Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTitle_In(array $titles)
    {
        return $this->filterByTitle($titles, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $title Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTitle_Like($title)
    {
        return $this->filterByTitle($title, Criteria::LIKE);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%', Criteria::LIKE); // WHERE title LIKE '%fooValue%'
     * $query->filterByTitle([1, 'foo'], Criteria::IN); // WHERE title IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $title The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByTitle($title = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $title = str_replace('*', '%', $title);
        }

        if (is_array($title) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$title of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyProductListTableMap::COL_TITLE, $title, $comparison);

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
     * Filter the query on the type column
     *
     * @param     mixed $type The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByType($type = null, $comparison = Criteria::EQUAL)
    {
        $valueSet = SpyProductListTableMap::getValueSet(SpyProductListTableMap::COL_TYPE);
        if (is_scalar($type)) {
            if (!in_array($type, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $type));
            }
            $type = array_search($type, $valueSet);
        } elseif (is_array($type)) {
            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
            $convertedValues = array();
            foreach ($type as $value) {
                if (!in_array($value, $valueSet)) {
                    throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $value));
                }
                $convertedValues []= array_search($value, $valueSet);
            }
            $type = $convertedValues;
        }

        $query = $this->addUsingAlias(SpyProductListTableMap::COL_TYPE, $type, $comparison);

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
                $this->addUsingAlias(SpyProductListTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductListTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductListTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SpyProductListTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductListTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductListTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationship object
     *
     * @param \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationship|ObjectCollection $spyMerchantRelationship The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyMerchantRelationship($spyMerchantRelationship, ?string $comparison = null)
    {
        if ($spyMerchantRelationship instanceof \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationship) {
            return $this
                ->addUsingAlias(SpyProductListTableMap::COL_FK_MERCHANT_RELATIONSHIP, $spyMerchantRelationship->getIdMerchantRelationship(), $comparison);
        } elseif ($spyMerchantRelationship instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyProductListTableMap::COL_FK_MERCHANT_RELATIONSHIP, $spyMerchantRelationship->toKeyValue('PrimaryKey', 'IdMerchantRelationship'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyMerchantRelationship() only accepts arguments of type \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationship or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyMerchantRelationship relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyMerchantRelationship(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyMerchantRelationship');

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
            $this->addJoinObject($join, 'SpyMerchantRelationship');
        }

        return $this;
    }

    /**
     * Use the SpyMerchantRelationship relation SpyMerchantRelationship object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipQuery A secondary query class using the current class as primary query
     */
    public function useSpyMerchantRelationshipQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpyMerchantRelationship($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyMerchantRelationship', '\Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipQuery');
    }

    /**
     * Use the SpyMerchantRelationship relation SpyMerchantRelationship object
     *
     * @param callable(\Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipQuery):\Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyMerchantRelationshipQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpyMerchantRelationshipQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyMerchantRelationship table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipQuery The inner query object of the EXISTS statement
     */
    public function useSpyMerchantRelationshipExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipQuery */
        $q = $this->useExistsQuery('SpyMerchantRelationship', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantRelationship table for a NOT EXISTS query.
     *
     * @see useSpyMerchantRelationshipExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyMerchantRelationshipNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipQuery */
        $q = $this->useExistsQuery('SpyMerchantRelationship', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyMerchantRelationship table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipQuery The inner query object of the IN statement
     */
    public function useInSpyMerchantRelationshipQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipQuery */
        $q = $this->useInQuery('SpyMerchantRelationship', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantRelationship table for a NOT IN query.
     *
     * @see useSpyMerchantRelationshipInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyMerchantRelationshipQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipQuery */
        $q = $this->useInQuery('SpyMerchantRelationship', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateSlot object
     *
     * @param \Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateSlot|ObjectCollection $spyConfigurableBundleTemplateSlot the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyConfigurableBundleTemplateSlot($spyConfigurableBundleTemplateSlot, ?string $comparison = null)
    {
        if ($spyConfigurableBundleTemplateSlot instanceof \Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateSlot) {
            $this
                ->addUsingAlias(SpyProductListTableMap::COL_ID_PRODUCT_LIST, $spyConfigurableBundleTemplateSlot->getFkProductList(), $comparison);

            return $this;
        } elseif ($spyConfigurableBundleTemplateSlot instanceof ObjectCollection) {
            $this
                ->useSpyConfigurableBundleTemplateSlotQuery()
                ->filterByPrimaryKeys($spyConfigurableBundleTemplateSlot->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyConfigurableBundleTemplateSlot() only accepts arguments of type \Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateSlot or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyConfigurableBundleTemplateSlot relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyConfigurableBundleTemplateSlot(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyConfigurableBundleTemplateSlot');

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
            $this->addJoinObject($join, 'SpyConfigurableBundleTemplateSlot');
        }

        return $this;
    }

    /**
     * Use the SpyConfigurableBundleTemplateSlot relation SpyConfigurableBundleTemplateSlot object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateSlotQuery A secondary query class using the current class as primary query
     */
    public function useSpyConfigurableBundleTemplateSlotQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpyConfigurableBundleTemplateSlot($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyConfigurableBundleTemplateSlot', '\Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateSlotQuery');
    }

    /**
     * Use the SpyConfigurableBundleTemplateSlot relation SpyConfigurableBundleTemplateSlot object
     *
     * @param callable(\Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateSlotQuery):\Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateSlotQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyConfigurableBundleTemplateSlotQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpyConfigurableBundleTemplateSlotQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyConfigurableBundleTemplateSlot table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateSlotQuery The inner query object of the EXISTS statement
     */
    public function useSpyConfigurableBundleTemplateSlotExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateSlotQuery */
        $q = $this->useExistsQuery('SpyConfigurableBundleTemplateSlot', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyConfigurableBundleTemplateSlot table for a NOT EXISTS query.
     *
     * @see useSpyConfigurableBundleTemplateSlotExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateSlotQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyConfigurableBundleTemplateSlotNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateSlotQuery */
        $q = $this->useExistsQuery('SpyConfigurableBundleTemplateSlot', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyConfigurableBundleTemplateSlot table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateSlotQuery The inner query object of the IN statement
     */
    public function useInSpyConfigurableBundleTemplateSlotQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateSlotQuery */
        $q = $this->useInQuery('SpyConfigurableBundleTemplateSlot', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyConfigurableBundleTemplateSlot table for a NOT IN query.
     *
     * @see useSpyConfigurableBundleTemplateSlotInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateSlotQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyConfigurableBundleTemplateSlotQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateSlotQuery */
        $q = $this->useInQuery('SpyConfigurableBundleTemplateSlot', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductList\Persistence\SpyProductListProductConcrete object
     *
     * @param \Orm\Zed\ProductList\Persistence\SpyProductListProductConcrete|ObjectCollection $spyProductListProductConcrete the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductListProductConcrete($spyProductListProductConcrete, ?string $comparison = null)
    {
        if ($spyProductListProductConcrete instanceof \Orm\Zed\ProductList\Persistence\SpyProductListProductConcrete) {
            $this
                ->addUsingAlias(SpyProductListTableMap::COL_ID_PRODUCT_LIST, $spyProductListProductConcrete->getFkProductList(), $comparison);

            return $this;
        } elseif ($spyProductListProductConcrete instanceof ObjectCollection) {
            $this
                ->useSpyProductListProductConcreteQuery()
                ->filterByPrimaryKeys($spyProductListProductConcrete->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductListProductConcrete() only accepts arguments of type \Orm\Zed\ProductList\Persistence\SpyProductListProductConcrete or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductListProductConcrete relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductListProductConcrete(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductListProductConcrete');

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
            $this->addJoinObject($join, 'SpyProductListProductConcrete');
        }

        return $this;
    }

    /**
     * Use the SpyProductListProductConcrete relation SpyProductListProductConcrete object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListProductConcreteQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductListProductConcreteQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductListProductConcrete($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductListProductConcrete', '\Orm\Zed\ProductList\Persistence\SpyProductListProductConcreteQuery');
    }

    /**
     * Use the SpyProductListProductConcrete relation SpyProductListProductConcrete object
     *
     * @param callable(\Orm\Zed\ProductList\Persistence\SpyProductListProductConcreteQuery):\Orm\Zed\ProductList\Persistence\SpyProductListProductConcreteQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductListProductConcreteQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductListProductConcreteQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductListProductConcrete table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListProductConcreteQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductListProductConcreteExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductList\Persistence\SpyProductListProductConcreteQuery */
        $q = $this->useExistsQuery('SpyProductListProductConcrete', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductListProductConcrete table for a NOT EXISTS query.
     *
     * @see useSpyProductListProductConcreteExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListProductConcreteQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductListProductConcreteNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductList\Persistence\SpyProductListProductConcreteQuery */
        $q = $this->useExistsQuery('SpyProductListProductConcrete', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductListProductConcrete table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListProductConcreteQuery The inner query object of the IN statement
     */
    public function useInSpyProductListProductConcreteQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductList\Persistence\SpyProductListProductConcreteQuery */
        $q = $this->useInQuery('SpyProductListProductConcrete', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductListProductConcrete table for a NOT IN query.
     *
     * @see useSpyProductListProductConcreteInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListProductConcreteQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductListProductConcreteQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductList\Persistence\SpyProductListProductConcreteQuery */
        $q = $this->useInQuery('SpyProductListProductConcrete', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductList\Persistence\SpyProductListCategory object
     *
     * @param \Orm\Zed\ProductList\Persistence\SpyProductListCategory|ObjectCollection $spyProductListCategory the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductListCategory($spyProductListCategory, ?string $comparison = null)
    {
        if ($spyProductListCategory instanceof \Orm\Zed\ProductList\Persistence\SpyProductListCategory) {
            $this
                ->addUsingAlias(SpyProductListTableMap::COL_ID_PRODUCT_LIST, $spyProductListCategory->getFkProductList(), $comparison);

            return $this;
        } elseif ($spyProductListCategory instanceof ObjectCollection) {
            $this
                ->useSpyProductListCategoryQuery()
                ->filterByPrimaryKeys($spyProductListCategory->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductListCategory() only accepts arguments of type \Orm\Zed\ProductList\Persistence\SpyProductListCategory or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductListCategory relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductListCategory(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductListCategory');

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
            $this->addJoinObject($join, 'SpyProductListCategory');
        }

        return $this;
    }

    /**
     * Use the SpyProductListCategory relation SpyProductListCategory object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListCategoryQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductListCategoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductListCategory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductListCategory', '\Orm\Zed\ProductList\Persistence\SpyProductListCategoryQuery');
    }

    /**
     * Use the SpyProductListCategory relation SpyProductListCategory object
     *
     * @param callable(\Orm\Zed\ProductList\Persistence\SpyProductListCategoryQuery):\Orm\Zed\ProductList\Persistence\SpyProductListCategoryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductListCategoryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductListCategoryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductListCategory table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListCategoryQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductListCategoryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductList\Persistence\SpyProductListCategoryQuery */
        $q = $this->useExistsQuery('SpyProductListCategory', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductListCategory table for a NOT EXISTS query.
     *
     * @see useSpyProductListCategoryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListCategoryQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductListCategoryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductList\Persistence\SpyProductListCategoryQuery */
        $q = $this->useExistsQuery('SpyProductListCategory', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductListCategory table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListCategoryQuery The inner query object of the IN statement
     */
    public function useInSpyProductListCategoryQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductList\Persistence\SpyProductListCategoryQuery */
        $q = $this->useInQuery('SpyProductListCategory', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductListCategory table for a NOT IN query.
     *
     * @see useSpyProductListCategoryInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListCategoryQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductListCategoryQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductList\Persistence\SpyProductListCategoryQuery */
        $q = $this->useInQuery('SpyProductListCategory', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductList object
     *
     * @param \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductList|ObjectCollection $spySspModelToProductList the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpySspModelToProductList($spySspModelToProductList, ?string $comparison = null)
    {
        if ($spySspModelToProductList instanceof \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductList) {
            $this
                ->addUsingAlias(SpyProductListTableMap::COL_ID_PRODUCT_LIST, $spySspModelToProductList->getFkProductList(), $comparison);

            return $this;
        } elseif ($spySspModelToProductList instanceof ObjectCollection) {
            $this
                ->useSpySspModelToProductListQuery()
                ->filterByPrimaryKeys($spySspModelToProductList->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpySspModelToProductList() only accepts arguments of type \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductList or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpySspModelToProductList relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpySspModelToProductList(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpySspModelToProductList');

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
            $this->addJoinObject($join, 'SpySspModelToProductList');
        }

        return $this;
    }

    /**
     * Use the SpySspModelToProductList relation SpySspModelToProductList object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductListQuery A secondary query class using the current class as primary query
     */
    public function useSpySspModelToProductListQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpySspModelToProductList($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpySspModelToProductList', '\Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductListQuery');
    }

    /**
     * Use the SpySspModelToProductList relation SpySspModelToProductList object
     *
     * @param callable(\Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductListQuery):\Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductListQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpySspModelToProductListQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpySspModelToProductListQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpySspModelToProductList table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductListQuery The inner query object of the EXISTS statement
     */
    public function useSpySspModelToProductListExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductListQuery */
        $q = $this->useExistsQuery('SpySspModelToProductList', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpySspModelToProductList table for a NOT EXISTS query.
     *
     * @see useSpySspModelToProductListExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductListQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpySspModelToProductListNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductListQuery */
        $q = $this->useExistsQuery('SpySspModelToProductList', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpySspModelToProductList table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductListQuery The inner query object of the IN statement
     */
    public function useInSpySspModelToProductListQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductListQuery */
        $q = $this->useInQuery('SpySspModelToProductList', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpySspModelToProductList table for a NOT IN query.
     *
     * @see useSpySspModelToProductListInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductListQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpySspModelToProductListQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductListQuery */
        $q = $this->useInQuery('SpySspModelToProductList', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related SpyProduct object
     * using the spy_product_list_product_concrete table as cross reference
     *
     * @param SpyProduct $spyProduct the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL and Criteria::IN for queries
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProduct($spyProduct, string $comparison = null)
    {
        $this
            ->useSpyProductListProductConcreteQuery()
            ->filterBySpyProduct($spyProduct, $comparison)
            ->endUse();

        return $this;
    }

    /**
     * Filter the query by a related SpyCategory object
     * using the spy_product_list_category table as cross reference
     *
     * @param SpyCategory $spyCategory the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL and Criteria::IN for queries
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCategory($spyCategory, string $comparison = null)
    {
        $this
            ->useSpyProductListCategoryQuery()
            ->filterBySpyCategory($spyCategory, $comparison)
            ->endUse();

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyProductList $spyProductList Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyProductList = null)
    {
        if ($spyProductList) {
            $this->addUsingAlias(SpyProductListTableMap::COL_ID_PRODUCT_LIST, $spyProductList->getIdProductList(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_product_list table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductListTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyProductListTableMap::clearInstancePool();
            SpyProductListTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductListTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyProductListTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyProductListTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyProductListTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(SpyProductListTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyProductListTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyProductListTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyProductListTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpyProductListTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyProductListTableMap::COL_CREATED_AT);

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
