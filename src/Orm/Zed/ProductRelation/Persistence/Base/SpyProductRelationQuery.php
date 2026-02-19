<?php

namespace Orm\Zed\ProductRelation\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\ProductRelation\Persistence\SpyProductRelation as ChildSpyProductRelation;
use Orm\Zed\ProductRelation\Persistence\SpyProductRelationQuery as ChildSpyProductRelationQuery;
use Orm\Zed\ProductRelation\Persistence\Map\SpyProductRelationTableMap;
use Orm\Zed\Product\Persistence\SpyProductAbstract;
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
 * Base class that represents a query for the `spy_product_relation` table.
 *
 * @method     ChildSpyProductRelationQuery orderByIdProductRelation($order = Criteria::ASC) Order by the id_product_relation column
 * @method     ChildSpyProductRelationQuery orderByFkProductAbstract($order = Criteria::ASC) Order by the fk_product_abstract column
 * @method     ChildSpyProductRelationQuery orderByFkProductRelationType($order = Criteria::ASC) Order by the fk_product_relation_type column
 * @method     ChildSpyProductRelationQuery orderByIsActive($order = Criteria::ASC) Order by the is_active column
 * @method     ChildSpyProductRelationQuery orderByIsRebuildScheduled($order = Criteria::ASC) Order by the is_rebuild_scheduled column
 * @method     ChildSpyProductRelationQuery orderByProductRelationKey($order = Criteria::ASC) Order by the product_relation_key column
 * @method     ChildSpyProductRelationQuery orderByQuerySetData($order = Criteria::ASC) Order by the query_set_data column
 * @method     ChildSpyProductRelationQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpyProductRelationQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpyProductRelationQuery groupByIdProductRelation() Group by the id_product_relation column
 * @method     ChildSpyProductRelationQuery groupByFkProductAbstract() Group by the fk_product_abstract column
 * @method     ChildSpyProductRelationQuery groupByFkProductRelationType() Group by the fk_product_relation_type column
 * @method     ChildSpyProductRelationQuery groupByIsActive() Group by the is_active column
 * @method     ChildSpyProductRelationQuery groupByIsRebuildScheduled() Group by the is_rebuild_scheduled column
 * @method     ChildSpyProductRelationQuery groupByProductRelationKey() Group by the product_relation_key column
 * @method     ChildSpyProductRelationQuery groupByQuerySetData() Group by the query_set_data column
 * @method     ChildSpyProductRelationQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpyProductRelationQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpyProductRelationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyProductRelationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyProductRelationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyProductRelationQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyProductRelationQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyProductRelationQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyProductRelationQuery leftJoinSpyProductAbstract($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductAbstract relation
 * @method     ChildSpyProductRelationQuery rightJoinSpyProductAbstract($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductAbstract relation
 * @method     ChildSpyProductRelationQuery innerJoinSpyProductAbstract($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductAbstract relation
 *
 * @method     ChildSpyProductRelationQuery joinWithSpyProductAbstract($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductAbstract relation
 *
 * @method     ChildSpyProductRelationQuery leftJoinWithSpyProductAbstract() Adds a LEFT JOIN clause and with to the query using the SpyProductAbstract relation
 * @method     ChildSpyProductRelationQuery rightJoinWithSpyProductAbstract() Adds a RIGHT JOIN clause and with to the query using the SpyProductAbstract relation
 * @method     ChildSpyProductRelationQuery innerJoinWithSpyProductAbstract() Adds a INNER JOIN clause and with to the query using the SpyProductAbstract relation
 *
 * @method     ChildSpyProductRelationQuery leftJoinSpyProductRelationType($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductRelationType relation
 * @method     ChildSpyProductRelationQuery rightJoinSpyProductRelationType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductRelationType relation
 * @method     ChildSpyProductRelationQuery innerJoinSpyProductRelationType($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductRelationType relation
 *
 * @method     ChildSpyProductRelationQuery joinWithSpyProductRelationType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductRelationType relation
 *
 * @method     ChildSpyProductRelationQuery leftJoinWithSpyProductRelationType() Adds a LEFT JOIN clause and with to the query using the SpyProductRelationType relation
 * @method     ChildSpyProductRelationQuery rightJoinWithSpyProductRelationType() Adds a RIGHT JOIN clause and with to the query using the SpyProductRelationType relation
 * @method     ChildSpyProductRelationQuery innerJoinWithSpyProductRelationType() Adds a INNER JOIN clause and with to the query using the SpyProductRelationType relation
 *
 * @method     ChildSpyProductRelationQuery leftJoinSpyProductRelationProductAbstract($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductRelationProductAbstract relation
 * @method     ChildSpyProductRelationQuery rightJoinSpyProductRelationProductAbstract($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductRelationProductAbstract relation
 * @method     ChildSpyProductRelationQuery innerJoinSpyProductRelationProductAbstract($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductRelationProductAbstract relation
 *
 * @method     ChildSpyProductRelationQuery joinWithSpyProductRelationProductAbstract($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductRelationProductAbstract relation
 *
 * @method     ChildSpyProductRelationQuery leftJoinWithSpyProductRelationProductAbstract() Adds a LEFT JOIN clause and with to the query using the SpyProductRelationProductAbstract relation
 * @method     ChildSpyProductRelationQuery rightJoinWithSpyProductRelationProductAbstract() Adds a RIGHT JOIN clause and with to the query using the SpyProductRelationProductAbstract relation
 * @method     ChildSpyProductRelationQuery innerJoinWithSpyProductRelationProductAbstract() Adds a INNER JOIN clause and with to the query using the SpyProductRelationProductAbstract relation
 *
 * @method     ChildSpyProductRelationQuery leftJoinProductRelationStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductRelationStore relation
 * @method     ChildSpyProductRelationQuery rightJoinProductRelationStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductRelationStore relation
 * @method     ChildSpyProductRelationQuery innerJoinProductRelationStore($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductRelationStore relation
 *
 * @method     ChildSpyProductRelationQuery joinWithProductRelationStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductRelationStore relation
 *
 * @method     ChildSpyProductRelationQuery leftJoinWithProductRelationStore() Adds a LEFT JOIN clause and with to the query using the ProductRelationStore relation
 * @method     ChildSpyProductRelationQuery rightJoinWithProductRelationStore() Adds a RIGHT JOIN clause and with to the query using the ProductRelationStore relation
 * @method     ChildSpyProductRelationQuery innerJoinWithProductRelationStore() Adds a INNER JOIN clause and with to the query using the ProductRelationStore relation
 *
 * @method     \Orm\Zed\Product\Persistence\SpyProductAbstractQuery|\Orm\Zed\ProductRelation\Persistence\SpyProductRelationTypeQuery|\Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstractQuery|\Orm\Zed\ProductRelation\Persistence\SpyProductRelationStoreQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyProductRelation|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyProductRelation matching the query
 * @method     ChildSpyProductRelation findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyProductRelation matching the query, or a new ChildSpyProductRelation object populated from the query conditions when no match is found
 *
 * @method     ChildSpyProductRelation|null findOneByIdProductRelation(int $id_product_relation) Return the first ChildSpyProductRelation filtered by the id_product_relation column
 * @method     ChildSpyProductRelation|null findOneByFkProductAbstract(int $fk_product_abstract) Return the first ChildSpyProductRelation filtered by the fk_product_abstract column
 * @method     ChildSpyProductRelation|null findOneByFkProductRelationType(int $fk_product_relation_type) Return the first ChildSpyProductRelation filtered by the fk_product_relation_type column
 * @method     ChildSpyProductRelation|null findOneByIsActive(boolean $is_active) Return the first ChildSpyProductRelation filtered by the is_active column
 * @method     ChildSpyProductRelation|null findOneByIsRebuildScheduled(boolean $is_rebuild_scheduled) Return the first ChildSpyProductRelation filtered by the is_rebuild_scheduled column
 * @method     ChildSpyProductRelation|null findOneByProductRelationKey(string $product_relation_key) Return the first ChildSpyProductRelation filtered by the product_relation_key column
 * @method     ChildSpyProductRelation|null findOneByQuerySetData(string $query_set_data) Return the first ChildSpyProductRelation filtered by the query_set_data column
 * @method     ChildSpyProductRelation|null findOneByCreatedAt(string $created_at) Return the first ChildSpyProductRelation filtered by the created_at column
 * @method     ChildSpyProductRelation|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpyProductRelation filtered by the updated_at column
 *
 * @method     ChildSpyProductRelation requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyProductRelation by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductRelation requireOne(?ConnectionInterface $con = null) Return the first ChildSpyProductRelation matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyProductRelation requireOneByIdProductRelation(int $id_product_relation) Return the first ChildSpyProductRelation filtered by the id_product_relation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductRelation requireOneByFkProductAbstract(int $fk_product_abstract) Return the first ChildSpyProductRelation filtered by the fk_product_abstract column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductRelation requireOneByFkProductRelationType(int $fk_product_relation_type) Return the first ChildSpyProductRelation filtered by the fk_product_relation_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductRelation requireOneByIsActive(boolean $is_active) Return the first ChildSpyProductRelation filtered by the is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductRelation requireOneByIsRebuildScheduled(boolean $is_rebuild_scheduled) Return the first ChildSpyProductRelation filtered by the is_rebuild_scheduled column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductRelation requireOneByProductRelationKey(string $product_relation_key) Return the first ChildSpyProductRelation filtered by the product_relation_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductRelation requireOneByQuerySetData(string $query_set_data) Return the first ChildSpyProductRelation filtered by the query_set_data column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductRelation requireOneByCreatedAt(string $created_at) Return the first ChildSpyProductRelation filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductRelation requireOneByUpdatedAt(string $updated_at) Return the first ChildSpyProductRelation filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyProductRelation[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyProductRelation objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyProductRelation> find(?ConnectionInterface $con = null) Return ChildSpyProductRelation objects based on current ModelCriteria
 *
 * @method     ChildSpyProductRelation[]|Collection findByIdProductRelation(int|array<int> $id_product_relation) Return ChildSpyProductRelation objects filtered by the id_product_relation column
 * @psalm-method Collection&\Traversable<ChildSpyProductRelation> findByIdProductRelation(int|array<int> $id_product_relation) Return ChildSpyProductRelation objects filtered by the id_product_relation column
 * @method     ChildSpyProductRelation[]|Collection findByFkProductAbstract(int|array<int> $fk_product_abstract) Return ChildSpyProductRelation objects filtered by the fk_product_abstract column
 * @psalm-method Collection&\Traversable<ChildSpyProductRelation> findByFkProductAbstract(int|array<int> $fk_product_abstract) Return ChildSpyProductRelation objects filtered by the fk_product_abstract column
 * @method     ChildSpyProductRelation[]|Collection findByFkProductRelationType(int|array<int> $fk_product_relation_type) Return ChildSpyProductRelation objects filtered by the fk_product_relation_type column
 * @psalm-method Collection&\Traversable<ChildSpyProductRelation> findByFkProductRelationType(int|array<int> $fk_product_relation_type) Return ChildSpyProductRelation objects filtered by the fk_product_relation_type column
 * @method     ChildSpyProductRelation[]|Collection findByIsActive(boolean|array<boolean> $is_active) Return ChildSpyProductRelation objects filtered by the is_active column
 * @psalm-method Collection&\Traversable<ChildSpyProductRelation> findByIsActive(boolean|array<boolean> $is_active) Return ChildSpyProductRelation objects filtered by the is_active column
 * @method     ChildSpyProductRelation[]|Collection findByIsRebuildScheduled(boolean|array<boolean> $is_rebuild_scheduled) Return ChildSpyProductRelation objects filtered by the is_rebuild_scheduled column
 * @psalm-method Collection&\Traversable<ChildSpyProductRelation> findByIsRebuildScheduled(boolean|array<boolean> $is_rebuild_scheduled) Return ChildSpyProductRelation objects filtered by the is_rebuild_scheduled column
 * @method     ChildSpyProductRelation[]|Collection findByProductRelationKey(string|array<string> $product_relation_key) Return ChildSpyProductRelation objects filtered by the product_relation_key column
 * @psalm-method Collection&\Traversable<ChildSpyProductRelation> findByProductRelationKey(string|array<string> $product_relation_key) Return ChildSpyProductRelation objects filtered by the product_relation_key column
 * @method     ChildSpyProductRelation[]|Collection findByQuerySetData(string|array<string> $query_set_data) Return ChildSpyProductRelation objects filtered by the query_set_data column
 * @psalm-method Collection&\Traversable<ChildSpyProductRelation> findByQuerySetData(string|array<string> $query_set_data) Return ChildSpyProductRelation objects filtered by the query_set_data column
 * @method     ChildSpyProductRelation[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpyProductRelation objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpyProductRelation> findByCreatedAt(string|array<string> $created_at) Return ChildSpyProductRelation objects filtered by the created_at column
 * @method     ChildSpyProductRelation[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyProductRelation objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpyProductRelation> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyProductRelation objects filtered by the updated_at column
 *
 * @method     ChildSpyProductRelation[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyProductRelation> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyProductRelationQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\ProductRelation\Persistence\Base\SpyProductRelationQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\ProductRelation\\Persistence\\SpyProductRelation', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyProductRelationQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyProductRelationQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyProductRelationQuery) {
            return $criteria;
        }
        $query = new ChildSpyProductRelationQuery();
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
     * @return ChildSpyProductRelation|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyProductRelationTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyProductRelation A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id_product_relation`, `fk_product_abstract`, `fk_product_relation_type`, `is_active`, `is_rebuild_scheduled`, `product_relation_key`, `query_set_data`, `created_at`, `updated_at` FROM `spy_product_relation` WHERE `id_product_relation` = :p0';
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
            /** @var ChildSpyProductRelation $obj */
            $obj = new ChildSpyProductRelation();
            $obj->hydrate($row);
            SpyProductRelationTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyProductRelation|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyProductRelationTableMap::COL_ID_PRODUCT_RELATION, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyProductRelationTableMap::COL_ID_PRODUCT_RELATION, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idProductRelation Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdProductRelation_Between(array $idProductRelation)
    {
        return $this->filterByIdProductRelation($idProductRelation, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idProductRelations Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdProductRelation_In(array $idProductRelations)
    {
        return $this->filterByIdProductRelation($idProductRelations, Criteria::IN);
    }

    /**
     * Filter the query on the id_product_relation column
     *
     * Example usage:
     * <code>
     * $query->filterByIdProductRelation(1234); // WHERE id_product_relation = 1234
     * $query->filterByIdProductRelation(array(12, 34), Criteria::IN); // WHERE id_product_relation IN (12, 34)
     * $query->filterByIdProductRelation(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_product_relation > 12
     * </code>
     *
     * @param     mixed $idProductRelation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdProductRelation($idProductRelation = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idProductRelation)) {
            $useMinMax = false;
            if (isset($idProductRelation['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductRelationTableMap::COL_ID_PRODUCT_RELATION, $idProductRelation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idProductRelation['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductRelationTableMap::COL_ID_PRODUCT_RELATION, $idProductRelation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idProductRelation of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductRelationTableMap::COL_ID_PRODUCT_RELATION, $idProductRelation, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkProductAbstract Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkProductAbstract_Between(array $fkProductAbstract)
    {
        return $this->filterByFkProductAbstract($fkProductAbstract, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkProductAbstracts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkProductAbstract_In(array $fkProductAbstracts)
    {
        return $this->filterByFkProductAbstract($fkProductAbstracts, Criteria::IN);
    }

    /**
     * Filter the query on the fk_product_abstract column
     *
     * Example usage:
     * <code>
     * $query->filterByFkProductAbstract(1234); // WHERE fk_product_abstract = 1234
     * $query->filterByFkProductAbstract(array(12, 34), Criteria::IN); // WHERE fk_product_abstract IN (12, 34)
     * $query->filterByFkProductAbstract(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_product_abstract > 12
     * </code>
     *
     * @see       filterBySpyProductAbstract()
     *
     * @param     mixed $fkProductAbstract The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkProductAbstract($fkProductAbstract = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkProductAbstract)) {
            $useMinMax = false;
            if (isset($fkProductAbstract['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductRelationTableMap::COL_FK_PRODUCT_ABSTRACT, $fkProductAbstract['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkProductAbstract['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductRelationTableMap::COL_FK_PRODUCT_ABSTRACT, $fkProductAbstract['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkProductAbstract of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductRelationTableMap::COL_FK_PRODUCT_ABSTRACT, $fkProductAbstract, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkProductRelationType Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkProductRelationType_Between(array $fkProductRelationType)
    {
        return $this->filterByFkProductRelationType($fkProductRelationType, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkProductRelationTypes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkProductRelationType_In(array $fkProductRelationTypes)
    {
        return $this->filterByFkProductRelationType($fkProductRelationTypes, Criteria::IN);
    }

    /**
     * Filter the query on the fk_product_relation_type column
     *
     * Example usage:
     * <code>
     * $query->filterByFkProductRelationType(1234); // WHERE fk_product_relation_type = 1234
     * $query->filterByFkProductRelationType(array(12, 34), Criteria::IN); // WHERE fk_product_relation_type IN (12, 34)
     * $query->filterByFkProductRelationType(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_product_relation_type > 12
     * </code>
     *
     * @see       filterBySpyProductRelationType()
     *
     * @param     mixed $fkProductRelationType The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkProductRelationType($fkProductRelationType = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkProductRelationType)) {
            $useMinMax = false;
            if (isset($fkProductRelationType['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductRelationTableMap::COL_FK_PRODUCT_RELATION_TYPE, $fkProductRelationType['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkProductRelationType['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductRelationTableMap::COL_FK_PRODUCT_RELATION_TYPE, $fkProductRelationType['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkProductRelationType of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductRelationTableMap::COL_FK_PRODUCT_RELATION_TYPE, $fkProductRelationType, $comparison);

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

        $query = $this->addUsingAlias(SpyProductRelationTableMap::COL_IS_ACTIVE, $isActive, $comparison);

        return $query;
    }

    /**
     * Filter the query on the is_rebuild_scheduled column
     *
     * Example usage:
     * <code>
     * $query->filterByIsRebuildScheduled(true); // WHERE is_rebuild_scheduled = true
     * $query->filterByIsRebuildScheduled('yes'); // WHERE is_rebuild_scheduled = true
     * </code>
     *
     * @param     bool|string $isRebuildScheduled The value to use as filter.
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
    public function filterByIsRebuildScheduled($isRebuildScheduled = null, $comparison = Criteria::EQUAL)
    {
        if (is_string($isRebuildScheduled)) {
            $isRebuildScheduled = in_array(strtolower($isRebuildScheduled), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $query = $this->addUsingAlias(SpyProductRelationTableMap::COL_IS_REBUILD_SCHEDULED, $isRebuildScheduled, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $productRelationKeys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductRelationKey_In(array $productRelationKeys)
    {
        return $this->filterByProductRelationKey($productRelationKeys, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $productRelationKey Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductRelationKey_Like($productRelationKey)
    {
        return $this->filterByProductRelationKey($productRelationKey, Criteria::LIKE);
    }

    /**
     * Filter the query on the product_relation_key column
     *
     * Example usage:
     * <code>
     * $query->filterByProductRelationKey('fooValue');   // WHERE product_relation_key = 'fooValue'
     * $query->filterByProductRelationKey('%fooValue%', Criteria::LIKE); // WHERE product_relation_key LIKE '%fooValue%'
     * $query->filterByProductRelationKey([1, 'foo'], Criteria::IN); // WHERE product_relation_key IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $productRelationKey The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByProductRelationKey($productRelationKey = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $productRelationKey = str_replace('*', '%', $productRelationKey);
        }

        if (is_array($productRelationKey) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$productRelationKey of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyProductRelationTableMap::COL_PRODUCT_RELATION_KEY, $productRelationKey, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $querySetDatas Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByQuerySetData_In(array $querySetDatas)
    {
        return $this->filterByQuerySetData($querySetDatas, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $querySetData Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByQuerySetData_Like($querySetData)
    {
        return $this->filterByQuerySetData($querySetData, Criteria::LIKE);
    }

    /**
     * Filter the query on the query_set_data column
     *
     * Example usage:
     * <code>
     * $query->filterByQuerySetData('fooValue');   // WHERE query_set_data = 'fooValue'
     * $query->filterByQuerySetData('%fooValue%', Criteria::LIKE); // WHERE query_set_data LIKE '%fooValue%'
     * $query->filterByQuerySetData([1, 'foo'], Criteria::IN); // WHERE query_set_data IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $querySetData The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByQuerySetData($querySetData = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $querySetData = str_replace('*', '%', $querySetData);
        }

        if (is_array($querySetData) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$querySetData of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyProductRelationTableMap::COL_QUERY_SET_DATA, $querySetData, $comparison);

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
                $this->addUsingAlias(SpyProductRelationTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductRelationTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductRelationTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SpyProductRelationTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductRelationTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductRelationTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Product\Persistence\SpyProductAbstract object
     *
     * @param \Orm\Zed\Product\Persistence\SpyProductAbstract|ObjectCollection $spyProductAbstract The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductAbstract($spyProductAbstract, ?string $comparison = null)
    {
        if ($spyProductAbstract instanceof \Orm\Zed\Product\Persistence\SpyProductAbstract) {
            return $this
                ->addUsingAlias(SpyProductRelationTableMap::COL_FK_PRODUCT_ABSTRACT, $spyProductAbstract->getIdProductAbstract(), $comparison);
        } elseif ($spyProductAbstract instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyProductRelationTableMap::COL_FK_PRODUCT_ABSTRACT, $spyProductAbstract->toKeyValue('PrimaryKey', 'IdProductAbstract'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyProductAbstract() only accepts arguments of type \Orm\Zed\Product\Persistence\SpyProductAbstract or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductAbstract relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductAbstract(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductAbstract');

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
            $this->addJoinObject($join, 'SpyProductAbstract');
        }

        return $this;
    }

    /**
     * Use the SpyProductAbstract relation SpyProductAbstract object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductAbstractQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductAbstract($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductAbstract', '\Orm\Zed\Product\Persistence\SpyProductAbstractQuery');
    }

    /**
     * Use the SpyProductAbstract relation SpyProductAbstract object
     *
     * @param callable(\Orm\Zed\Product\Persistence\SpyProductAbstractQuery):\Orm\Zed\Product\Persistence\SpyProductAbstractQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductAbstractQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductAbstractQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductAbstract table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductAbstractExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductAbstractQuery */
        $q = $this->useExistsQuery('SpyProductAbstract', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductAbstract table for a NOT EXISTS query.
     *
     * @see useSpyProductAbstractExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductAbstractNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductAbstractQuery */
        $q = $this->useExistsQuery('SpyProductAbstract', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductAbstract table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery The inner query object of the IN statement
     */
    public function useInSpyProductAbstractQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductAbstractQuery */
        $q = $this->useInQuery('SpyProductAbstract', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductAbstract table for a NOT IN query.
     *
     * @see useSpyProductAbstractInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductAbstractQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductAbstractQuery */
        $q = $this->useInQuery('SpyProductAbstract', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductRelation\Persistence\SpyProductRelationType object
     *
     * @param \Orm\Zed\ProductRelation\Persistence\SpyProductRelationType|ObjectCollection $spyProductRelationType The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductRelationType($spyProductRelationType, ?string $comparison = null)
    {
        if ($spyProductRelationType instanceof \Orm\Zed\ProductRelation\Persistence\SpyProductRelationType) {
            return $this
                ->addUsingAlias(SpyProductRelationTableMap::COL_FK_PRODUCT_RELATION_TYPE, $spyProductRelationType->getIdProductRelationType(), $comparison);
        } elseif ($spyProductRelationType instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyProductRelationTableMap::COL_FK_PRODUCT_RELATION_TYPE, $spyProductRelationType->toKeyValue('PrimaryKey', 'IdProductRelationType'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyProductRelationType() only accepts arguments of type \Orm\Zed\ProductRelation\Persistence\SpyProductRelationType or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductRelationType relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductRelationType(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductRelationType');

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
            $this->addJoinObject($join, 'SpyProductRelationType');
        }

        return $this;
    }

    /**
     * Use the SpyProductRelationType relation SpyProductRelationType object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductRelation\Persistence\SpyProductRelationTypeQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductRelationTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductRelationType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductRelationType', '\Orm\Zed\ProductRelation\Persistence\SpyProductRelationTypeQuery');
    }

    /**
     * Use the SpyProductRelationType relation SpyProductRelationType object
     *
     * @param callable(\Orm\Zed\ProductRelation\Persistence\SpyProductRelationTypeQuery):\Orm\Zed\ProductRelation\Persistence\SpyProductRelationTypeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductRelationTypeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductRelationTypeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductRelationType table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductRelation\Persistence\SpyProductRelationTypeQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductRelationTypeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductRelation\Persistence\SpyProductRelationTypeQuery */
        $q = $this->useExistsQuery('SpyProductRelationType', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductRelationType table for a NOT EXISTS query.
     *
     * @see useSpyProductRelationTypeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductRelation\Persistence\SpyProductRelationTypeQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductRelationTypeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductRelation\Persistence\SpyProductRelationTypeQuery */
        $q = $this->useExistsQuery('SpyProductRelationType', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductRelationType table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductRelation\Persistence\SpyProductRelationTypeQuery The inner query object of the IN statement
     */
    public function useInSpyProductRelationTypeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductRelation\Persistence\SpyProductRelationTypeQuery */
        $q = $this->useInQuery('SpyProductRelationType', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductRelationType table for a NOT IN query.
     *
     * @see useSpyProductRelationTypeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductRelation\Persistence\SpyProductRelationTypeQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductRelationTypeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductRelation\Persistence\SpyProductRelationTypeQuery */
        $q = $this->useInQuery('SpyProductRelationType', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstract object
     *
     * @param \Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstract|ObjectCollection $spyProductRelationProductAbstract the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductRelationProductAbstract($spyProductRelationProductAbstract, ?string $comparison = null)
    {
        if ($spyProductRelationProductAbstract instanceof \Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstract) {
            $this
                ->addUsingAlias(SpyProductRelationTableMap::COL_ID_PRODUCT_RELATION, $spyProductRelationProductAbstract->getFkProductRelation(), $comparison);

            return $this;
        } elseif ($spyProductRelationProductAbstract instanceof ObjectCollection) {
            $this
                ->useSpyProductRelationProductAbstractQuery()
                ->filterByPrimaryKeys($spyProductRelationProductAbstract->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductRelationProductAbstract() only accepts arguments of type \Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstract or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductRelationProductAbstract relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductRelationProductAbstract(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductRelationProductAbstract');

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
            $this->addJoinObject($join, 'SpyProductRelationProductAbstract');
        }

        return $this;
    }

    /**
     * Use the SpyProductRelationProductAbstract relation SpyProductRelationProductAbstract object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstractQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductRelationProductAbstractQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductRelationProductAbstract($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductRelationProductAbstract', '\Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstractQuery');
    }

    /**
     * Use the SpyProductRelationProductAbstract relation SpyProductRelationProductAbstract object
     *
     * @param callable(\Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstractQuery):\Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstractQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductRelationProductAbstractQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductRelationProductAbstractQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductRelationProductAbstract table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstractQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductRelationProductAbstractExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstractQuery */
        $q = $this->useExistsQuery('SpyProductRelationProductAbstract', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductRelationProductAbstract table for a NOT EXISTS query.
     *
     * @see useSpyProductRelationProductAbstractExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstractQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductRelationProductAbstractNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstractQuery */
        $q = $this->useExistsQuery('SpyProductRelationProductAbstract', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductRelationProductAbstract table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstractQuery The inner query object of the IN statement
     */
    public function useInSpyProductRelationProductAbstractQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstractQuery */
        $q = $this->useInQuery('SpyProductRelationProductAbstract', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductRelationProductAbstract table for a NOT IN query.
     *
     * @see useSpyProductRelationProductAbstractInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstractQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductRelationProductAbstractQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstractQuery */
        $q = $this->useInQuery('SpyProductRelationProductAbstract', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductRelation\Persistence\SpyProductRelationStore object
     *
     * @param \Orm\Zed\ProductRelation\Persistence\SpyProductRelationStore|ObjectCollection $spyProductRelationStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductRelationStore($spyProductRelationStore, ?string $comparison = null)
    {
        if ($spyProductRelationStore instanceof \Orm\Zed\ProductRelation\Persistence\SpyProductRelationStore) {
            $this
                ->addUsingAlias(SpyProductRelationTableMap::COL_ID_PRODUCT_RELATION, $spyProductRelationStore->getFkProductRelation(), $comparison);

            return $this;
        } elseif ($spyProductRelationStore instanceof ObjectCollection) {
            $this
                ->useProductRelationStoreQuery()
                ->filterByPrimaryKeys($spyProductRelationStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByProductRelationStore() only accepts arguments of type \Orm\Zed\ProductRelation\Persistence\SpyProductRelationStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductRelationStore relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProductRelationStore(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductRelationStore');

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
            $this->addJoinObject($join, 'ProductRelationStore');
        }

        return $this;
    }

    /**
     * Use the ProductRelationStore relation SpyProductRelationStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductRelation\Persistence\SpyProductRelationStoreQuery A secondary query class using the current class as primary query
     */
    public function useProductRelationStoreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductRelationStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductRelationStore', '\Orm\Zed\ProductRelation\Persistence\SpyProductRelationStoreQuery');
    }

    /**
     * Use the ProductRelationStore relation SpyProductRelationStore object
     *
     * @param callable(\Orm\Zed\ProductRelation\Persistence\SpyProductRelationStoreQuery):\Orm\Zed\ProductRelation\Persistence\SpyProductRelationStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProductRelationStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProductRelationStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ProductRelationStore relation to the SpyProductRelationStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductRelation\Persistence\SpyProductRelationStoreQuery The inner query object of the EXISTS statement
     */
    public function useProductRelationStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductRelation\Persistence\SpyProductRelationStoreQuery */
        $q = $this->useExistsQuery('ProductRelationStore', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ProductRelationStore relation to the SpyProductRelationStore table for a NOT EXISTS query.
     *
     * @see useProductRelationStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductRelation\Persistence\SpyProductRelationStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useProductRelationStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductRelation\Persistence\SpyProductRelationStoreQuery */
        $q = $this->useExistsQuery('ProductRelationStore', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ProductRelationStore relation to the SpyProductRelationStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductRelation\Persistence\SpyProductRelationStoreQuery The inner query object of the IN statement
     */
    public function useInProductRelationStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductRelation\Persistence\SpyProductRelationStoreQuery */
        $q = $this->useInQuery('ProductRelationStore', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ProductRelationStore relation to the SpyProductRelationStore table for a NOT IN query.
     *
     * @see useProductRelationStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductRelation\Persistence\SpyProductRelationStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInProductRelationStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductRelation\Persistence\SpyProductRelationStoreQuery */
        $q = $this->useInQuery('ProductRelationStore', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyProductRelation $spyProductRelation Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyProductRelation = null)
    {
        if ($spyProductRelation) {
            $this->addUsingAlias(SpyProductRelationTableMap::COL_ID_PRODUCT_RELATION, $spyProductRelation->getIdProductRelation(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_product_relation table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductRelationTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyProductRelationTableMap::clearInstancePool();
            SpyProductRelationTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductRelationTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyProductRelationTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyProductRelationTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyProductRelationTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(SpyProductRelationTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyProductRelationTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyProductRelationTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyProductRelationTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpyProductRelationTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyProductRelationTableMap::COL_CREATED_AT);

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
