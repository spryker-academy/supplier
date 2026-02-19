<?php

namespace Orm\Zed\ProductMeasurementUnit\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnit as ChildSpyProductMeasurementBaseUnit;
use Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnitQuery as ChildSpyProductMeasurementBaseUnitQuery;
use Orm\Zed\ProductMeasurementUnit\Persistence\Map\SpyProductMeasurementBaseUnitTableMap;
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
 * Base class that represents a query for the `spy_product_measurement_base_unit` table.
 *
 * @method     ChildSpyProductMeasurementBaseUnitQuery orderByIdProductMeasurementBaseUnit($order = Criteria::ASC) Order by the id_product_measurement_base_unit column
 * @method     ChildSpyProductMeasurementBaseUnitQuery orderByFkProductAbstract($order = Criteria::ASC) Order by the fk_product_abstract column
 * @method     ChildSpyProductMeasurementBaseUnitQuery orderByFkProductMeasurementUnit($order = Criteria::ASC) Order by the fk_product_measurement_unit column
 * @method     ChildSpyProductMeasurementBaseUnitQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpyProductMeasurementBaseUnitQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpyProductMeasurementBaseUnitQuery groupByIdProductMeasurementBaseUnit() Group by the id_product_measurement_base_unit column
 * @method     ChildSpyProductMeasurementBaseUnitQuery groupByFkProductAbstract() Group by the fk_product_abstract column
 * @method     ChildSpyProductMeasurementBaseUnitQuery groupByFkProductMeasurementUnit() Group by the fk_product_measurement_unit column
 * @method     ChildSpyProductMeasurementBaseUnitQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpyProductMeasurementBaseUnitQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpyProductMeasurementBaseUnitQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyProductMeasurementBaseUnitQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyProductMeasurementBaseUnitQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyProductMeasurementBaseUnitQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyProductMeasurementBaseUnitQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyProductMeasurementBaseUnitQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyProductMeasurementBaseUnitQuery leftJoinProductAbstract($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductAbstract relation
 * @method     ChildSpyProductMeasurementBaseUnitQuery rightJoinProductAbstract($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductAbstract relation
 * @method     ChildSpyProductMeasurementBaseUnitQuery innerJoinProductAbstract($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductAbstract relation
 *
 * @method     ChildSpyProductMeasurementBaseUnitQuery joinWithProductAbstract($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductAbstract relation
 *
 * @method     ChildSpyProductMeasurementBaseUnitQuery leftJoinWithProductAbstract() Adds a LEFT JOIN clause and with to the query using the ProductAbstract relation
 * @method     ChildSpyProductMeasurementBaseUnitQuery rightJoinWithProductAbstract() Adds a RIGHT JOIN clause and with to the query using the ProductAbstract relation
 * @method     ChildSpyProductMeasurementBaseUnitQuery innerJoinWithProductAbstract() Adds a INNER JOIN clause and with to the query using the ProductAbstract relation
 *
 * @method     ChildSpyProductMeasurementBaseUnitQuery leftJoinProductMeasurementUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductMeasurementUnit relation
 * @method     ChildSpyProductMeasurementBaseUnitQuery rightJoinProductMeasurementUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductMeasurementUnit relation
 * @method     ChildSpyProductMeasurementBaseUnitQuery innerJoinProductMeasurementUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductMeasurementUnit relation
 *
 * @method     ChildSpyProductMeasurementBaseUnitQuery joinWithProductMeasurementUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductMeasurementUnit relation
 *
 * @method     ChildSpyProductMeasurementBaseUnitQuery leftJoinWithProductMeasurementUnit() Adds a LEFT JOIN clause and with to the query using the ProductMeasurementUnit relation
 * @method     ChildSpyProductMeasurementBaseUnitQuery rightJoinWithProductMeasurementUnit() Adds a RIGHT JOIN clause and with to the query using the ProductMeasurementUnit relation
 * @method     ChildSpyProductMeasurementBaseUnitQuery innerJoinWithProductMeasurementUnit() Adds a INNER JOIN clause and with to the query using the ProductMeasurementUnit relation
 *
 * @method     ChildSpyProductMeasurementBaseUnitQuery leftJoinSpyProductMeasurementSalesUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductMeasurementSalesUnit relation
 * @method     ChildSpyProductMeasurementBaseUnitQuery rightJoinSpyProductMeasurementSalesUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductMeasurementSalesUnit relation
 * @method     ChildSpyProductMeasurementBaseUnitQuery innerJoinSpyProductMeasurementSalesUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductMeasurementSalesUnit relation
 *
 * @method     ChildSpyProductMeasurementBaseUnitQuery joinWithSpyProductMeasurementSalesUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductMeasurementSalesUnit relation
 *
 * @method     ChildSpyProductMeasurementBaseUnitQuery leftJoinWithSpyProductMeasurementSalesUnit() Adds a LEFT JOIN clause and with to the query using the SpyProductMeasurementSalesUnit relation
 * @method     ChildSpyProductMeasurementBaseUnitQuery rightJoinWithSpyProductMeasurementSalesUnit() Adds a RIGHT JOIN clause and with to the query using the SpyProductMeasurementSalesUnit relation
 * @method     ChildSpyProductMeasurementBaseUnitQuery innerJoinWithSpyProductMeasurementSalesUnit() Adds a INNER JOIN clause and with to the query using the SpyProductMeasurementSalesUnit relation
 *
 * @method     \Orm\Zed\Product\Persistence\SpyProductAbstractQuery|\Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementUnitQuery|\Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyProductMeasurementBaseUnit|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyProductMeasurementBaseUnit matching the query
 * @method     ChildSpyProductMeasurementBaseUnit findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyProductMeasurementBaseUnit matching the query, or a new ChildSpyProductMeasurementBaseUnit object populated from the query conditions when no match is found
 *
 * @method     ChildSpyProductMeasurementBaseUnit|null findOneByIdProductMeasurementBaseUnit(int $id_product_measurement_base_unit) Return the first ChildSpyProductMeasurementBaseUnit filtered by the id_product_measurement_base_unit column
 * @method     ChildSpyProductMeasurementBaseUnit|null findOneByFkProductAbstract(int $fk_product_abstract) Return the first ChildSpyProductMeasurementBaseUnit filtered by the fk_product_abstract column
 * @method     ChildSpyProductMeasurementBaseUnit|null findOneByFkProductMeasurementUnit(int $fk_product_measurement_unit) Return the first ChildSpyProductMeasurementBaseUnit filtered by the fk_product_measurement_unit column
 * @method     ChildSpyProductMeasurementBaseUnit|null findOneByCreatedAt(string $created_at) Return the first ChildSpyProductMeasurementBaseUnit filtered by the created_at column
 * @method     ChildSpyProductMeasurementBaseUnit|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpyProductMeasurementBaseUnit filtered by the updated_at column
 *
 * @method     ChildSpyProductMeasurementBaseUnit requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyProductMeasurementBaseUnit by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductMeasurementBaseUnit requireOne(?ConnectionInterface $con = null) Return the first ChildSpyProductMeasurementBaseUnit matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyProductMeasurementBaseUnit requireOneByIdProductMeasurementBaseUnit(int $id_product_measurement_base_unit) Return the first ChildSpyProductMeasurementBaseUnit filtered by the id_product_measurement_base_unit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductMeasurementBaseUnit requireOneByFkProductAbstract(int $fk_product_abstract) Return the first ChildSpyProductMeasurementBaseUnit filtered by the fk_product_abstract column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductMeasurementBaseUnit requireOneByFkProductMeasurementUnit(int $fk_product_measurement_unit) Return the first ChildSpyProductMeasurementBaseUnit filtered by the fk_product_measurement_unit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductMeasurementBaseUnit requireOneByCreatedAt(string $created_at) Return the first ChildSpyProductMeasurementBaseUnit filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductMeasurementBaseUnit requireOneByUpdatedAt(string $updated_at) Return the first ChildSpyProductMeasurementBaseUnit filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyProductMeasurementBaseUnit[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyProductMeasurementBaseUnit objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyProductMeasurementBaseUnit> find(?ConnectionInterface $con = null) Return ChildSpyProductMeasurementBaseUnit objects based on current ModelCriteria
 *
 * @method     ChildSpyProductMeasurementBaseUnit[]|Collection findByIdProductMeasurementBaseUnit(int|array<int> $id_product_measurement_base_unit) Return ChildSpyProductMeasurementBaseUnit objects filtered by the id_product_measurement_base_unit column
 * @psalm-method Collection&\Traversable<ChildSpyProductMeasurementBaseUnit> findByIdProductMeasurementBaseUnit(int|array<int> $id_product_measurement_base_unit) Return ChildSpyProductMeasurementBaseUnit objects filtered by the id_product_measurement_base_unit column
 * @method     ChildSpyProductMeasurementBaseUnit[]|Collection findByFkProductAbstract(int|array<int> $fk_product_abstract) Return ChildSpyProductMeasurementBaseUnit objects filtered by the fk_product_abstract column
 * @psalm-method Collection&\Traversable<ChildSpyProductMeasurementBaseUnit> findByFkProductAbstract(int|array<int> $fk_product_abstract) Return ChildSpyProductMeasurementBaseUnit objects filtered by the fk_product_abstract column
 * @method     ChildSpyProductMeasurementBaseUnit[]|Collection findByFkProductMeasurementUnit(int|array<int> $fk_product_measurement_unit) Return ChildSpyProductMeasurementBaseUnit objects filtered by the fk_product_measurement_unit column
 * @psalm-method Collection&\Traversable<ChildSpyProductMeasurementBaseUnit> findByFkProductMeasurementUnit(int|array<int> $fk_product_measurement_unit) Return ChildSpyProductMeasurementBaseUnit objects filtered by the fk_product_measurement_unit column
 * @method     ChildSpyProductMeasurementBaseUnit[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpyProductMeasurementBaseUnit objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpyProductMeasurementBaseUnit> findByCreatedAt(string|array<string> $created_at) Return ChildSpyProductMeasurementBaseUnit objects filtered by the created_at column
 * @method     ChildSpyProductMeasurementBaseUnit[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyProductMeasurementBaseUnit objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpyProductMeasurementBaseUnit> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyProductMeasurementBaseUnit objects filtered by the updated_at column
 *
 * @method     ChildSpyProductMeasurementBaseUnit[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyProductMeasurementBaseUnit> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyProductMeasurementBaseUnitQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\ProductMeasurementUnit\Persistence\Base\SpyProductMeasurementBaseUnitQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\ProductMeasurementUnit\\Persistence\\SpyProductMeasurementBaseUnit', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyProductMeasurementBaseUnitQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyProductMeasurementBaseUnitQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyProductMeasurementBaseUnitQuery) {
            return $criteria;
        }
        $query = new ChildSpyProductMeasurementBaseUnitQuery();
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
     * @return ChildSpyProductMeasurementBaseUnit|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyProductMeasurementBaseUnitTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyProductMeasurementBaseUnit A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_product_measurement_base_unit, fk_product_abstract, fk_product_measurement_unit, created_at, updated_at FROM spy_product_measurement_base_unit WHERE id_product_measurement_base_unit = :p0';
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
            /** @var ChildSpyProductMeasurementBaseUnit $obj */
            $obj = new ChildSpyProductMeasurementBaseUnit();
            $obj->hydrate($row);
            SpyProductMeasurementBaseUnitTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyProductMeasurementBaseUnit|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyProductMeasurementBaseUnitTableMap::COL_ID_PRODUCT_MEASUREMENT_BASE_UNIT, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyProductMeasurementBaseUnitTableMap::COL_ID_PRODUCT_MEASUREMENT_BASE_UNIT, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idProductMeasurementBaseUnit Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdProductMeasurementBaseUnit_Between(array $idProductMeasurementBaseUnit)
    {
        return $this->filterByIdProductMeasurementBaseUnit($idProductMeasurementBaseUnit, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idProductMeasurementBaseUnits Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdProductMeasurementBaseUnit_In(array $idProductMeasurementBaseUnits)
    {
        return $this->filterByIdProductMeasurementBaseUnit($idProductMeasurementBaseUnits, Criteria::IN);
    }

    /**
     * Filter the query on the id_product_measurement_base_unit column
     *
     * Example usage:
     * <code>
     * $query->filterByIdProductMeasurementBaseUnit(1234); // WHERE id_product_measurement_base_unit = 1234
     * $query->filterByIdProductMeasurementBaseUnit(array(12, 34), Criteria::IN); // WHERE id_product_measurement_base_unit IN (12, 34)
     * $query->filterByIdProductMeasurementBaseUnit(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_product_measurement_base_unit > 12
     * </code>
     *
     * @param     mixed $idProductMeasurementBaseUnit The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdProductMeasurementBaseUnit($idProductMeasurementBaseUnit = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idProductMeasurementBaseUnit)) {
            $useMinMax = false;
            if (isset($idProductMeasurementBaseUnit['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductMeasurementBaseUnitTableMap::COL_ID_PRODUCT_MEASUREMENT_BASE_UNIT, $idProductMeasurementBaseUnit['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idProductMeasurementBaseUnit['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductMeasurementBaseUnitTableMap::COL_ID_PRODUCT_MEASUREMENT_BASE_UNIT, $idProductMeasurementBaseUnit['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idProductMeasurementBaseUnit of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductMeasurementBaseUnitTableMap::COL_ID_PRODUCT_MEASUREMENT_BASE_UNIT, $idProductMeasurementBaseUnit, $comparison);

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
     * @see       filterByProductAbstract()
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
                $this->addUsingAlias(SpyProductMeasurementBaseUnitTableMap::COL_FK_PRODUCT_ABSTRACT, $fkProductAbstract['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkProductAbstract['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductMeasurementBaseUnitTableMap::COL_FK_PRODUCT_ABSTRACT, $fkProductAbstract['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkProductAbstract of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductMeasurementBaseUnitTableMap::COL_FK_PRODUCT_ABSTRACT, $fkProductAbstract, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkProductMeasurementUnit Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkProductMeasurementUnit_Between(array $fkProductMeasurementUnit)
    {
        return $this->filterByFkProductMeasurementUnit($fkProductMeasurementUnit, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkProductMeasurementUnits Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkProductMeasurementUnit_In(array $fkProductMeasurementUnits)
    {
        return $this->filterByFkProductMeasurementUnit($fkProductMeasurementUnits, Criteria::IN);
    }

    /**
     * Filter the query on the fk_product_measurement_unit column
     *
     * Example usage:
     * <code>
     * $query->filterByFkProductMeasurementUnit(1234); // WHERE fk_product_measurement_unit = 1234
     * $query->filterByFkProductMeasurementUnit(array(12, 34), Criteria::IN); // WHERE fk_product_measurement_unit IN (12, 34)
     * $query->filterByFkProductMeasurementUnit(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_product_measurement_unit > 12
     * </code>
     *
     * @see       filterByProductMeasurementUnit()
     *
     * @param     mixed $fkProductMeasurementUnit The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkProductMeasurementUnit($fkProductMeasurementUnit = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkProductMeasurementUnit)) {
            $useMinMax = false;
            if (isset($fkProductMeasurementUnit['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductMeasurementBaseUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_UNIT, $fkProductMeasurementUnit['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkProductMeasurementUnit['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductMeasurementBaseUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_UNIT, $fkProductMeasurementUnit['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkProductMeasurementUnit of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductMeasurementBaseUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_UNIT, $fkProductMeasurementUnit, $comparison);

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
                $this->addUsingAlias(SpyProductMeasurementBaseUnitTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductMeasurementBaseUnitTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductMeasurementBaseUnitTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SpyProductMeasurementBaseUnitTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductMeasurementBaseUnitTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductMeasurementBaseUnitTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
    public function filterByProductAbstract($spyProductAbstract, ?string $comparison = null)
    {
        if ($spyProductAbstract instanceof \Orm\Zed\Product\Persistence\SpyProductAbstract) {
            return $this
                ->addUsingAlias(SpyProductMeasurementBaseUnitTableMap::COL_FK_PRODUCT_ABSTRACT, $spyProductAbstract->getIdProductAbstract(), $comparison);
        } elseif ($spyProductAbstract instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyProductMeasurementBaseUnitTableMap::COL_FK_PRODUCT_ABSTRACT, $spyProductAbstract->toKeyValue('PrimaryKey', 'IdProductAbstract'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByProductAbstract() only accepts arguments of type \Orm\Zed\Product\Persistence\SpyProductAbstract or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductAbstract relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProductAbstract(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductAbstract');

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
            $this->addJoinObject($join, 'ProductAbstract');
        }

        return $this;
    }

    /**
     * Use the ProductAbstract relation SpyProductAbstract object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery A secondary query class using the current class as primary query
     */
    public function useProductAbstractQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductAbstract($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductAbstract', '\Orm\Zed\Product\Persistence\SpyProductAbstractQuery');
    }

    /**
     * Use the ProductAbstract relation SpyProductAbstract object
     *
     * @param callable(\Orm\Zed\Product\Persistence\SpyProductAbstractQuery):\Orm\Zed\Product\Persistence\SpyProductAbstractQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProductAbstractQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProductAbstractQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ProductAbstract relation to the SpyProductAbstract table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery The inner query object of the EXISTS statement
     */
    public function useProductAbstractExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductAbstractQuery */
        $q = $this->useExistsQuery('ProductAbstract', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ProductAbstract relation to the SpyProductAbstract table for a NOT EXISTS query.
     *
     * @see useProductAbstractExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery The inner query object of the NOT EXISTS statement
     */
    public function useProductAbstractNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductAbstractQuery */
        $q = $this->useExistsQuery('ProductAbstract', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ProductAbstract relation to the SpyProductAbstract table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery The inner query object of the IN statement
     */
    public function useInProductAbstractQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductAbstractQuery */
        $q = $this->useInQuery('ProductAbstract', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ProductAbstract relation to the SpyProductAbstract table for a NOT IN query.
     *
     * @see useProductAbstractInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery The inner query object of the NOT IN statement
     */
    public function useNotInProductAbstractQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductAbstractQuery */
        $q = $this->useInQuery('ProductAbstract', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementUnit object
     *
     * @param \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementUnit|ObjectCollection $spyProductMeasurementUnit The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductMeasurementUnit($spyProductMeasurementUnit, ?string $comparison = null)
    {
        if ($spyProductMeasurementUnit instanceof \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementUnit) {
            return $this
                ->addUsingAlias(SpyProductMeasurementBaseUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_UNIT, $spyProductMeasurementUnit->getIdProductMeasurementUnit(), $comparison);
        } elseif ($spyProductMeasurementUnit instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyProductMeasurementBaseUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_UNIT, $spyProductMeasurementUnit->toKeyValue('PrimaryKey', 'IdProductMeasurementUnit'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByProductMeasurementUnit() only accepts arguments of type \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementUnit or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductMeasurementUnit relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProductMeasurementUnit(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductMeasurementUnit');

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
            $this->addJoinObject($join, 'ProductMeasurementUnit');
        }

        return $this;
    }

    /**
     * Use the ProductMeasurementUnit relation SpyProductMeasurementUnit object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementUnitQuery A secondary query class using the current class as primary query
     */
    public function useProductMeasurementUnitQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductMeasurementUnit($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductMeasurementUnit', '\Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementUnitQuery');
    }

    /**
     * Use the ProductMeasurementUnit relation SpyProductMeasurementUnit object
     *
     * @param callable(\Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementUnitQuery):\Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementUnitQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProductMeasurementUnitQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProductMeasurementUnitQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ProductMeasurementUnit relation to the SpyProductMeasurementUnit table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementUnitQuery The inner query object of the EXISTS statement
     */
    public function useProductMeasurementUnitExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementUnitQuery */
        $q = $this->useExistsQuery('ProductMeasurementUnit', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ProductMeasurementUnit relation to the SpyProductMeasurementUnit table for a NOT EXISTS query.
     *
     * @see useProductMeasurementUnitExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementUnitQuery The inner query object of the NOT EXISTS statement
     */
    public function useProductMeasurementUnitNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementUnitQuery */
        $q = $this->useExistsQuery('ProductMeasurementUnit', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ProductMeasurementUnit relation to the SpyProductMeasurementUnit table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementUnitQuery The inner query object of the IN statement
     */
    public function useInProductMeasurementUnitQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementUnitQuery */
        $q = $this->useInQuery('ProductMeasurementUnit', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ProductMeasurementUnit relation to the SpyProductMeasurementUnit table for a NOT IN query.
     *
     * @see useProductMeasurementUnitInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementUnitQuery The inner query object of the NOT IN statement
     */
    public function useNotInProductMeasurementUnitQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementUnitQuery */
        $q = $this->useInQuery('ProductMeasurementUnit', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnit object
     *
     * @param \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnit|ObjectCollection $spyProductMeasurementSalesUnit the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductMeasurementSalesUnit($spyProductMeasurementSalesUnit, ?string $comparison = null)
    {
        if ($spyProductMeasurementSalesUnit instanceof \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnit) {
            $this
                ->addUsingAlias(SpyProductMeasurementBaseUnitTableMap::COL_ID_PRODUCT_MEASUREMENT_BASE_UNIT, $spyProductMeasurementSalesUnit->getFkProductMeasurementBaseUnit(), $comparison);

            return $this;
        } elseif ($spyProductMeasurementSalesUnit instanceof ObjectCollection) {
            $this
                ->useSpyProductMeasurementSalesUnitQuery()
                ->filterByPrimaryKeys($spyProductMeasurementSalesUnit->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductMeasurementSalesUnit() only accepts arguments of type \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnit or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductMeasurementSalesUnit relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductMeasurementSalesUnit(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductMeasurementSalesUnit');

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
            $this->addJoinObject($join, 'SpyProductMeasurementSalesUnit');
        }

        return $this;
    }

    /**
     * Use the SpyProductMeasurementSalesUnit relation SpyProductMeasurementSalesUnit object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductMeasurementSalesUnitQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductMeasurementSalesUnit($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductMeasurementSalesUnit', '\Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitQuery');
    }

    /**
     * Use the SpyProductMeasurementSalesUnit relation SpyProductMeasurementSalesUnit object
     *
     * @param callable(\Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitQuery):\Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductMeasurementSalesUnitQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductMeasurementSalesUnitQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductMeasurementSalesUnit table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductMeasurementSalesUnitExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitQuery */
        $q = $this->useExistsQuery('SpyProductMeasurementSalesUnit', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductMeasurementSalesUnit table for a NOT EXISTS query.
     *
     * @see useSpyProductMeasurementSalesUnitExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductMeasurementSalesUnitNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitQuery */
        $q = $this->useExistsQuery('SpyProductMeasurementSalesUnit', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductMeasurementSalesUnit table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitQuery The inner query object of the IN statement
     */
    public function useInSpyProductMeasurementSalesUnitQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitQuery */
        $q = $this->useInQuery('SpyProductMeasurementSalesUnit', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductMeasurementSalesUnit table for a NOT IN query.
     *
     * @see useSpyProductMeasurementSalesUnitInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductMeasurementSalesUnitQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitQuery */
        $q = $this->useInQuery('SpyProductMeasurementSalesUnit', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyProductMeasurementBaseUnit $spyProductMeasurementBaseUnit Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyProductMeasurementBaseUnit = null)
    {
        if ($spyProductMeasurementBaseUnit) {
            $this->addUsingAlias(SpyProductMeasurementBaseUnitTableMap::COL_ID_PRODUCT_MEASUREMENT_BASE_UNIT, $spyProductMeasurementBaseUnit->getIdProductMeasurementBaseUnit(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_product_measurement_base_unit table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductMeasurementBaseUnitTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyProductMeasurementBaseUnitTableMap::clearInstancePool();
            SpyProductMeasurementBaseUnitTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductMeasurementBaseUnitTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyProductMeasurementBaseUnitTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyProductMeasurementBaseUnitTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyProductMeasurementBaseUnitTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(SpyProductMeasurementBaseUnitTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyProductMeasurementBaseUnitTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyProductMeasurementBaseUnitTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyProductMeasurementBaseUnitTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpyProductMeasurementBaseUnitTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyProductMeasurementBaseUnitTableMap::COL_CREATED_AT);

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
