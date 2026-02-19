<?php

namespace Orm\Zed\ProductPackagingUnit\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnit as ChildSpyProductPackagingUnit;
use Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitQuery as ChildSpyProductPackagingUnitQuery;
use Orm\Zed\ProductPackagingUnit\Persistence\Map\SpyProductPackagingUnitTableMap;
use Orm\Zed\Product\Persistence\SpyProduct;
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
 * Base class that represents a query for the `spy_product_packaging_unit` table.
 *
 * @method     ChildSpyProductPackagingUnitQuery orderByIdProductPackagingUnit($order = Criteria::ASC) Order by the id_product_packaging_unit column
 * @method     ChildSpyProductPackagingUnitQuery orderByFkLeadProduct($order = Criteria::ASC) Order by the fk_lead_product column
 * @method     ChildSpyProductPackagingUnitQuery orderByFkProduct($order = Criteria::ASC) Order by the fk_product column
 * @method     ChildSpyProductPackagingUnitQuery orderByFkProductPackagingUnitType($order = Criteria::ASC) Order by the fk_product_packaging_unit_type column
 * @method     ChildSpyProductPackagingUnitQuery orderByAmountInterval($order = Criteria::ASC) Order by the amount_interval column
 * @method     ChildSpyProductPackagingUnitQuery orderByAmountMax($order = Criteria::ASC) Order by the amount_max column
 * @method     ChildSpyProductPackagingUnitQuery orderByAmountMin($order = Criteria::ASC) Order by the amount_min column
 * @method     ChildSpyProductPackagingUnitQuery orderByDefaultAmount($order = Criteria::ASC) Order by the default_amount column
 * @method     ChildSpyProductPackagingUnitQuery orderByIsAmountVariable($order = Criteria::ASC) Order by the is_amount_variable column
 * @method     ChildSpyProductPackagingUnitQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpyProductPackagingUnitQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpyProductPackagingUnitQuery groupByIdProductPackagingUnit() Group by the id_product_packaging_unit column
 * @method     ChildSpyProductPackagingUnitQuery groupByFkLeadProduct() Group by the fk_lead_product column
 * @method     ChildSpyProductPackagingUnitQuery groupByFkProduct() Group by the fk_product column
 * @method     ChildSpyProductPackagingUnitQuery groupByFkProductPackagingUnitType() Group by the fk_product_packaging_unit_type column
 * @method     ChildSpyProductPackagingUnitQuery groupByAmountInterval() Group by the amount_interval column
 * @method     ChildSpyProductPackagingUnitQuery groupByAmountMax() Group by the amount_max column
 * @method     ChildSpyProductPackagingUnitQuery groupByAmountMin() Group by the amount_min column
 * @method     ChildSpyProductPackagingUnitQuery groupByDefaultAmount() Group by the default_amount column
 * @method     ChildSpyProductPackagingUnitQuery groupByIsAmountVariable() Group by the is_amount_variable column
 * @method     ChildSpyProductPackagingUnitQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpyProductPackagingUnitQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpyProductPackagingUnitQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyProductPackagingUnitQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyProductPackagingUnitQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyProductPackagingUnitQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyProductPackagingUnitQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyProductPackagingUnitQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyProductPackagingUnitQuery leftJoinProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the Product relation
 * @method     ChildSpyProductPackagingUnitQuery rightJoinProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Product relation
 * @method     ChildSpyProductPackagingUnitQuery innerJoinProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the Product relation
 *
 * @method     ChildSpyProductPackagingUnitQuery joinWithProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Product relation
 *
 * @method     ChildSpyProductPackagingUnitQuery leftJoinWithProduct() Adds a LEFT JOIN clause and with to the query using the Product relation
 * @method     ChildSpyProductPackagingUnitQuery rightJoinWithProduct() Adds a RIGHT JOIN clause and with to the query using the Product relation
 * @method     ChildSpyProductPackagingUnitQuery innerJoinWithProduct() Adds a INNER JOIN clause and with to the query using the Product relation
 *
 * @method     ChildSpyProductPackagingUnitQuery leftJoinLeadProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeadProduct relation
 * @method     ChildSpyProductPackagingUnitQuery rightJoinLeadProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeadProduct relation
 * @method     ChildSpyProductPackagingUnitQuery innerJoinLeadProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the LeadProduct relation
 *
 * @method     ChildSpyProductPackagingUnitQuery joinWithLeadProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the LeadProduct relation
 *
 * @method     ChildSpyProductPackagingUnitQuery leftJoinWithLeadProduct() Adds a LEFT JOIN clause and with to the query using the LeadProduct relation
 * @method     ChildSpyProductPackagingUnitQuery rightJoinWithLeadProduct() Adds a RIGHT JOIN clause and with to the query using the LeadProduct relation
 * @method     ChildSpyProductPackagingUnitQuery innerJoinWithLeadProduct() Adds a INNER JOIN clause and with to the query using the LeadProduct relation
 *
 * @method     ChildSpyProductPackagingUnitQuery leftJoinProductPackagingUnitType($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductPackagingUnitType relation
 * @method     ChildSpyProductPackagingUnitQuery rightJoinProductPackagingUnitType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductPackagingUnitType relation
 * @method     ChildSpyProductPackagingUnitQuery innerJoinProductPackagingUnitType($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductPackagingUnitType relation
 *
 * @method     ChildSpyProductPackagingUnitQuery joinWithProductPackagingUnitType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductPackagingUnitType relation
 *
 * @method     ChildSpyProductPackagingUnitQuery leftJoinWithProductPackagingUnitType() Adds a LEFT JOIN clause and with to the query using the ProductPackagingUnitType relation
 * @method     ChildSpyProductPackagingUnitQuery rightJoinWithProductPackagingUnitType() Adds a RIGHT JOIN clause and with to the query using the ProductPackagingUnitType relation
 * @method     ChildSpyProductPackagingUnitQuery innerJoinWithProductPackagingUnitType() Adds a INNER JOIN clause and with to the query using the ProductPackagingUnitType relation
 *
 * @method     \Orm\Zed\Product\Persistence\SpyProductQuery|\Orm\Zed\Product\Persistence\SpyProductQuery|\Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitTypeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyProductPackagingUnit|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyProductPackagingUnit matching the query
 * @method     ChildSpyProductPackagingUnit findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyProductPackagingUnit matching the query, or a new ChildSpyProductPackagingUnit object populated from the query conditions when no match is found
 *
 * @method     ChildSpyProductPackagingUnit|null findOneByIdProductPackagingUnit(int $id_product_packaging_unit) Return the first ChildSpyProductPackagingUnit filtered by the id_product_packaging_unit column
 * @method     ChildSpyProductPackagingUnit|null findOneByFkLeadProduct(int $fk_lead_product) Return the first ChildSpyProductPackagingUnit filtered by the fk_lead_product column
 * @method     ChildSpyProductPackagingUnit|null findOneByFkProduct(int $fk_product) Return the first ChildSpyProductPackagingUnit filtered by the fk_product column
 * @method     ChildSpyProductPackagingUnit|null findOneByFkProductPackagingUnitType(int $fk_product_packaging_unit_type) Return the first ChildSpyProductPackagingUnit filtered by the fk_product_packaging_unit_type column
 * @method     ChildSpyProductPackagingUnit|null findOneByAmountInterval(string $amount_interval) Return the first ChildSpyProductPackagingUnit filtered by the amount_interval column
 * @method     ChildSpyProductPackagingUnit|null findOneByAmountMax(string $amount_max) Return the first ChildSpyProductPackagingUnit filtered by the amount_max column
 * @method     ChildSpyProductPackagingUnit|null findOneByAmountMin(string $amount_min) Return the first ChildSpyProductPackagingUnit filtered by the amount_min column
 * @method     ChildSpyProductPackagingUnit|null findOneByDefaultAmount(string $default_amount) Return the first ChildSpyProductPackagingUnit filtered by the default_amount column
 * @method     ChildSpyProductPackagingUnit|null findOneByIsAmountVariable(boolean $is_amount_variable) Return the first ChildSpyProductPackagingUnit filtered by the is_amount_variable column
 * @method     ChildSpyProductPackagingUnit|null findOneByCreatedAt(string $created_at) Return the first ChildSpyProductPackagingUnit filtered by the created_at column
 * @method     ChildSpyProductPackagingUnit|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpyProductPackagingUnit filtered by the updated_at column
 *
 * @method     ChildSpyProductPackagingUnit requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyProductPackagingUnit by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductPackagingUnit requireOne(?ConnectionInterface $con = null) Return the first ChildSpyProductPackagingUnit matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyProductPackagingUnit requireOneByIdProductPackagingUnit(int $id_product_packaging_unit) Return the first ChildSpyProductPackagingUnit filtered by the id_product_packaging_unit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductPackagingUnit requireOneByFkLeadProduct(int $fk_lead_product) Return the first ChildSpyProductPackagingUnit filtered by the fk_lead_product column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductPackagingUnit requireOneByFkProduct(int $fk_product) Return the first ChildSpyProductPackagingUnit filtered by the fk_product column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductPackagingUnit requireOneByFkProductPackagingUnitType(int $fk_product_packaging_unit_type) Return the first ChildSpyProductPackagingUnit filtered by the fk_product_packaging_unit_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductPackagingUnit requireOneByAmountInterval(string $amount_interval) Return the first ChildSpyProductPackagingUnit filtered by the amount_interval column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductPackagingUnit requireOneByAmountMax(string $amount_max) Return the first ChildSpyProductPackagingUnit filtered by the amount_max column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductPackagingUnit requireOneByAmountMin(string $amount_min) Return the first ChildSpyProductPackagingUnit filtered by the amount_min column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductPackagingUnit requireOneByDefaultAmount(string $default_amount) Return the first ChildSpyProductPackagingUnit filtered by the default_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductPackagingUnit requireOneByIsAmountVariable(boolean $is_amount_variable) Return the first ChildSpyProductPackagingUnit filtered by the is_amount_variable column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductPackagingUnit requireOneByCreatedAt(string $created_at) Return the first ChildSpyProductPackagingUnit filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductPackagingUnit requireOneByUpdatedAt(string $updated_at) Return the first ChildSpyProductPackagingUnit filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyProductPackagingUnit[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyProductPackagingUnit objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyProductPackagingUnit> find(?ConnectionInterface $con = null) Return ChildSpyProductPackagingUnit objects based on current ModelCriteria
 *
 * @method     ChildSpyProductPackagingUnit[]|Collection findByIdProductPackagingUnit(int|array<int> $id_product_packaging_unit) Return ChildSpyProductPackagingUnit objects filtered by the id_product_packaging_unit column
 * @psalm-method Collection&\Traversable<ChildSpyProductPackagingUnit> findByIdProductPackagingUnit(int|array<int> $id_product_packaging_unit) Return ChildSpyProductPackagingUnit objects filtered by the id_product_packaging_unit column
 * @method     ChildSpyProductPackagingUnit[]|Collection findByFkLeadProduct(int|array<int> $fk_lead_product) Return ChildSpyProductPackagingUnit objects filtered by the fk_lead_product column
 * @psalm-method Collection&\Traversable<ChildSpyProductPackagingUnit> findByFkLeadProduct(int|array<int> $fk_lead_product) Return ChildSpyProductPackagingUnit objects filtered by the fk_lead_product column
 * @method     ChildSpyProductPackagingUnit[]|Collection findByFkProduct(int|array<int> $fk_product) Return ChildSpyProductPackagingUnit objects filtered by the fk_product column
 * @psalm-method Collection&\Traversable<ChildSpyProductPackagingUnit> findByFkProduct(int|array<int> $fk_product) Return ChildSpyProductPackagingUnit objects filtered by the fk_product column
 * @method     ChildSpyProductPackagingUnit[]|Collection findByFkProductPackagingUnitType(int|array<int> $fk_product_packaging_unit_type) Return ChildSpyProductPackagingUnit objects filtered by the fk_product_packaging_unit_type column
 * @psalm-method Collection&\Traversable<ChildSpyProductPackagingUnit> findByFkProductPackagingUnitType(int|array<int> $fk_product_packaging_unit_type) Return ChildSpyProductPackagingUnit objects filtered by the fk_product_packaging_unit_type column
 * @method     ChildSpyProductPackagingUnit[]|Collection findByAmountInterval(string|array<string> $amount_interval) Return ChildSpyProductPackagingUnit objects filtered by the amount_interval column
 * @psalm-method Collection&\Traversable<ChildSpyProductPackagingUnit> findByAmountInterval(string|array<string> $amount_interval) Return ChildSpyProductPackagingUnit objects filtered by the amount_interval column
 * @method     ChildSpyProductPackagingUnit[]|Collection findByAmountMax(string|array<string> $amount_max) Return ChildSpyProductPackagingUnit objects filtered by the amount_max column
 * @psalm-method Collection&\Traversable<ChildSpyProductPackagingUnit> findByAmountMax(string|array<string> $amount_max) Return ChildSpyProductPackagingUnit objects filtered by the amount_max column
 * @method     ChildSpyProductPackagingUnit[]|Collection findByAmountMin(string|array<string> $amount_min) Return ChildSpyProductPackagingUnit objects filtered by the amount_min column
 * @psalm-method Collection&\Traversable<ChildSpyProductPackagingUnit> findByAmountMin(string|array<string> $amount_min) Return ChildSpyProductPackagingUnit objects filtered by the amount_min column
 * @method     ChildSpyProductPackagingUnit[]|Collection findByDefaultAmount(string|array<string> $default_amount) Return ChildSpyProductPackagingUnit objects filtered by the default_amount column
 * @psalm-method Collection&\Traversable<ChildSpyProductPackagingUnit> findByDefaultAmount(string|array<string> $default_amount) Return ChildSpyProductPackagingUnit objects filtered by the default_amount column
 * @method     ChildSpyProductPackagingUnit[]|Collection findByIsAmountVariable(boolean|array<boolean> $is_amount_variable) Return ChildSpyProductPackagingUnit objects filtered by the is_amount_variable column
 * @psalm-method Collection&\Traversable<ChildSpyProductPackagingUnit> findByIsAmountVariable(boolean|array<boolean> $is_amount_variable) Return ChildSpyProductPackagingUnit objects filtered by the is_amount_variable column
 * @method     ChildSpyProductPackagingUnit[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpyProductPackagingUnit objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpyProductPackagingUnit> findByCreatedAt(string|array<string> $created_at) Return ChildSpyProductPackagingUnit objects filtered by the created_at column
 * @method     ChildSpyProductPackagingUnit[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyProductPackagingUnit objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpyProductPackagingUnit> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyProductPackagingUnit objects filtered by the updated_at column
 *
 * @method     ChildSpyProductPackagingUnit[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyProductPackagingUnit> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyProductPackagingUnitQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\ProductPackagingUnit\Persistence\Base\SpyProductPackagingUnitQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\ProductPackagingUnit\\Persistence\\SpyProductPackagingUnit', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyProductPackagingUnitQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyProductPackagingUnitQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyProductPackagingUnitQuery) {
            return $criteria;
        }
        $query = new ChildSpyProductPackagingUnitQuery();
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
     * @return ChildSpyProductPackagingUnit|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyProductPackagingUnitTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyProductPackagingUnit A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_product_packaging_unit, fk_lead_product, fk_product, fk_product_packaging_unit_type, amount_interval, amount_max, amount_min, default_amount, is_amount_variable, created_at, updated_at FROM spy_product_packaging_unit WHERE id_product_packaging_unit = :p0';
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
            /** @var ChildSpyProductPackagingUnit $obj */
            $obj = new ChildSpyProductPackagingUnit();
            $obj->hydrate($row);
            SpyProductPackagingUnitTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyProductPackagingUnit|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyProductPackagingUnitTableMap::COL_ID_PRODUCT_PACKAGING_UNIT, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyProductPackagingUnitTableMap::COL_ID_PRODUCT_PACKAGING_UNIT, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idProductPackagingUnit Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdProductPackagingUnit_Between(array $idProductPackagingUnit)
    {
        return $this->filterByIdProductPackagingUnit($idProductPackagingUnit, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idProductPackagingUnits Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdProductPackagingUnit_In(array $idProductPackagingUnits)
    {
        return $this->filterByIdProductPackagingUnit($idProductPackagingUnits, Criteria::IN);
    }

    /**
     * Filter the query on the id_product_packaging_unit column
     *
     * Example usage:
     * <code>
     * $query->filterByIdProductPackagingUnit(1234); // WHERE id_product_packaging_unit = 1234
     * $query->filterByIdProductPackagingUnit(array(12, 34), Criteria::IN); // WHERE id_product_packaging_unit IN (12, 34)
     * $query->filterByIdProductPackagingUnit(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_product_packaging_unit > 12
     * </code>
     *
     * @param     mixed $idProductPackagingUnit The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdProductPackagingUnit($idProductPackagingUnit = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idProductPackagingUnit)) {
            $useMinMax = false;
            if (isset($idProductPackagingUnit['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductPackagingUnitTableMap::COL_ID_PRODUCT_PACKAGING_UNIT, $idProductPackagingUnit['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idProductPackagingUnit['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductPackagingUnitTableMap::COL_ID_PRODUCT_PACKAGING_UNIT, $idProductPackagingUnit['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idProductPackagingUnit of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductPackagingUnitTableMap::COL_ID_PRODUCT_PACKAGING_UNIT, $idProductPackagingUnit, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkLeadProduct Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkLeadProduct_Between(array $fkLeadProduct)
    {
        return $this->filterByFkLeadProduct($fkLeadProduct, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkLeadProducts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkLeadProduct_In(array $fkLeadProducts)
    {
        return $this->filterByFkLeadProduct($fkLeadProducts, Criteria::IN);
    }

    /**
     * Filter the query on the fk_lead_product column
     *
     * Example usage:
     * <code>
     * $query->filterByFkLeadProduct(1234); // WHERE fk_lead_product = 1234
     * $query->filterByFkLeadProduct(array(12, 34), Criteria::IN); // WHERE fk_lead_product IN (12, 34)
     * $query->filterByFkLeadProduct(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_lead_product > 12
     * </code>
     *
     * @see       filterByLeadProduct()
     *
     * @param     mixed $fkLeadProduct The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkLeadProduct($fkLeadProduct = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkLeadProduct)) {
            $useMinMax = false;
            if (isset($fkLeadProduct['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductPackagingUnitTableMap::COL_FK_LEAD_PRODUCT, $fkLeadProduct['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkLeadProduct['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductPackagingUnitTableMap::COL_FK_LEAD_PRODUCT, $fkLeadProduct['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkLeadProduct of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductPackagingUnitTableMap::COL_FK_LEAD_PRODUCT, $fkLeadProduct, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkProduct Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkProduct_Between(array $fkProduct)
    {
        return $this->filterByFkProduct($fkProduct, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkProducts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkProduct_In(array $fkProducts)
    {
        return $this->filterByFkProduct($fkProducts, Criteria::IN);
    }

    /**
     * Filter the query on the fk_product column
     *
     * Example usage:
     * <code>
     * $query->filterByFkProduct(1234); // WHERE fk_product = 1234
     * $query->filterByFkProduct(array(12, 34), Criteria::IN); // WHERE fk_product IN (12, 34)
     * $query->filterByFkProduct(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_product > 12
     * </code>
     *
     * @see       filterByProduct()
     *
     * @param     mixed $fkProduct The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkProduct($fkProduct = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkProduct)) {
            $useMinMax = false;
            if (isset($fkProduct['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductPackagingUnitTableMap::COL_FK_PRODUCT, $fkProduct['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkProduct['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductPackagingUnitTableMap::COL_FK_PRODUCT, $fkProduct['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkProduct of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductPackagingUnitTableMap::COL_FK_PRODUCT, $fkProduct, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkProductPackagingUnitType Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkProductPackagingUnitType_Between(array $fkProductPackagingUnitType)
    {
        return $this->filterByFkProductPackagingUnitType($fkProductPackagingUnitType, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkProductPackagingUnitTypes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkProductPackagingUnitType_In(array $fkProductPackagingUnitTypes)
    {
        return $this->filterByFkProductPackagingUnitType($fkProductPackagingUnitTypes, Criteria::IN);
    }

    /**
     * Filter the query on the fk_product_packaging_unit_type column
     *
     * Example usage:
     * <code>
     * $query->filterByFkProductPackagingUnitType(1234); // WHERE fk_product_packaging_unit_type = 1234
     * $query->filterByFkProductPackagingUnitType(array(12, 34), Criteria::IN); // WHERE fk_product_packaging_unit_type IN (12, 34)
     * $query->filterByFkProductPackagingUnitType(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_product_packaging_unit_type > 12
     * </code>
     *
     * @see       filterByProductPackagingUnitType()
     *
     * @param     mixed $fkProductPackagingUnitType The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkProductPackagingUnitType($fkProductPackagingUnitType = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkProductPackagingUnitType)) {
            $useMinMax = false;
            if (isset($fkProductPackagingUnitType['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductPackagingUnitTableMap::COL_FK_PRODUCT_PACKAGING_UNIT_TYPE, $fkProductPackagingUnitType['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkProductPackagingUnitType['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductPackagingUnitTableMap::COL_FK_PRODUCT_PACKAGING_UNIT_TYPE, $fkProductPackagingUnitType['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkProductPackagingUnitType of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductPackagingUnitTableMap::COL_FK_PRODUCT_PACKAGING_UNIT_TYPE, $fkProductPackagingUnitType, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $amountInterval Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmountInterval_Between(array $amountInterval)
    {
        return $this->filterByAmountInterval($amountInterval, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $amountIntervals Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmountInterval_In(array $amountIntervals)
    {
        return $this->filterByAmountInterval($amountIntervals, Criteria::IN);
    }

    /**
     * Filter the query on the amount_interval column
     *
     * Example usage:
     * <code>
     * $query->filterByAmountInterval(1234); // WHERE amount_interval = 1234
     * $query->filterByAmountInterval(array(12, 34), Criteria::IN); // WHERE amount_interval IN (12, 34)
     * $query->filterByAmountInterval(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE amount_interval > 12
     * </code>
     *
     * @param     mixed $amountInterval The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAmountInterval($amountInterval = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($amountInterval)) {
            $useMinMax = false;
            if (isset($amountInterval['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductPackagingUnitTableMap::COL_AMOUNT_INTERVAL, $amountInterval['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amountInterval['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductPackagingUnitTableMap::COL_AMOUNT_INTERVAL, $amountInterval['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$amountInterval of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductPackagingUnitTableMap::COL_AMOUNT_INTERVAL, $amountInterval, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $amountMax Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmountMax_Between(array $amountMax)
    {
        return $this->filterByAmountMax($amountMax, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $amountMaxs Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmountMax_In(array $amountMaxs)
    {
        return $this->filterByAmountMax($amountMaxs, Criteria::IN);
    }

    /**
     * Filter the query on the amount_max column
     *
     * Example usage:
     * <code>
     * $query->filterByAmountMax(1234); // WHERE amount_max = 1234
     * $query->filterByAmountMax(array(12, 34), Criteria::IN); // WHERE amount_max IN (12, 34)
     * $query->filterByAmountMax(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE amount_max > 12
     * </code>
     *
     * @param     mixed $amountMax The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAmountMax($amountMax = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($amountMax)) {
            $useMinMax = false;
            if (isset($amountMax['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductPackagingUnitTableMap::COL_AMOUNT_MAX, $amountMax['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amountMax['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductPackagingUnitTableMap::COL_AMOUNT_MAX, $amountMax['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$amountMax of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductPackagingUnitTableMap::COL_AMOUNT_MAX, $amountMax, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $amountMin Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmountMin_Between(array $amountMin)
    {
        return $this->filterByAmountMin($amountMin, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $amountMins Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmountMin_In(array $amountMins)
    {
        return $this->filterByAmountMin($amountMins, Criteria::IN);
    }

    /**
     * Filter the query on the amount_min column
     *
     * Example usage:
     * <code>
     * $query->filterByAmountMin(1234); // WHERE amount_min = 1234
     * $query->filterByAmountMin(array(12, 34), Criteria::IN); // WHERE amount_min IN (12, 34)
     * $query->filterByAmountMin(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE amount_min > 12
     * </code>
     *
     * @param     mixed $amountMin The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAmountMin($amountMin = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($amountMin)) {
            $useMinMax = false;
            if (isset($amountMin['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductPackagingUnitTableMap::COL_AMOUNT_MIN, $amountMin['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amountMin['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductPackagingUnitTableMap::COL_AMOUNT_MIN, $amountMin['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$amountMin of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductPackagingUnitTableMap::COL_AMOUNT_MIN, $amountMin, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $defaultAmount Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDefaultAmount_Between(array $defaultAmount)
    {
        return $this->filterByDefaultAmount($defaultAmount, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $defaultAmounts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDefaultAmount_In(array $defaultAmounts)
    {
        return $this->filterByDefaultAmount($defaultAmounts, Criteria::IN);
    }

    /**
     * Filter the query on the default_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByDefaultAmount(1234); // WHERE default_amount = 1234
     * $query->filterByDefaultAmount(array(12, 34), Criteria::IN); // WHERE default_amount IN (12, 34)
     * $query->filterByDefaultAmount(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE default_amount > 12
     * </code>
     *
     * @param     mixed $defaultAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByDefaultAmount($defaultAmount = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($defaultAmount)) {
            $useMinMax = false;
            if (isset($defaultAmount['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductPackagingUnitTableMap::COL_DEFAULT_AMOUNT, $defaultAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($defaultAmount['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductPackagingUnitTableMap::COL_DEFAULT_AMOUNT, $defaultAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$defaultAmount of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductPackagingUnitTableMap::COL_DEFAULT_AMOUNT, $defaultAmount, $comparison);

        return $query;
    }

    /**
     * Filter the query on the is_amount_variable column
     *
     * Example usage:
     * <code>
     * $query->filterByIsAmountVariable(true); // WHERE is_amount_variable = true
     * $query->filterByIsAmountVariable('yes'); // WHERE is_amount_variable = true
     * </code>
     *
     * @param     bool|string $isAmountVariable The value to use as filter.
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
    public function filterByIsAmountVariable($isAmountVariable = null, $comparison = Criteria::EQUAL)
    {
        if (is_string($isAmountVariable)) {
            $isAmountVariable = in_array(strtolower($isAmountVariable), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $query = $this->addUsingAlias(SpyProductPackagingUnitTableMap::COL_IS_AMOUNT_VARIABLE, $isAmountVariable, $comparison);

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
                $this->addUsingAlias(SpyProductPackagingUnitTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductPackagingUnitTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductPackagingUnitTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SpyProductPackagingUnitTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductPackagingUnitTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductPackagingUnitTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Product\Persistence\SpyProduct object
     *
     * @param \Orm\Zed\Product\Persistence\SpyProduct|ObjectCollection $spyProduct The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProduct($spyProduct, ?string $comparison = null)
    {
        if ($spyProduct instanceof \Orm\Zed\Product\Persistence\SpyProduct) {
            return $this
                ->addUsingAlias(SpyProductPackagingUnitTableMap::COL_FK_PRODUCT, $spyProduct->getIdProduct(), $comparison);
        } elseif ($spyProduct instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyProductPackagingUnitTableMap::COL_FK_PRODUCT, $spyProduct->toKeyValue('PrimaryKey', 'IdProduct'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByProduct() only accepts arguments of type \Orm\Zed\Product\Persistence\SpyProduct or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Product relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProduct(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Product');

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
            $this->addJoinObject($join, 'Product');
        }

        return $this;
    }

    /**
     * Use the Product relation SpyProduct object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductQuery A secondary query class using the current class as primary query
     */
    public function useProductQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProduct($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Product', '\Orm\Zed\Product\Persistence\SpyProductQuery');
    }

    /**
     * Use the Product relation SpyProduct object
     *
     * @param callable(\Orm\Zed\Product\Persistence\SpyProductQuery):\Orm\Zed\Product\Persistence\SpyProductQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProductQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProductQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the Product relation to the SpyProduct table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductQuery The inner query object of the EXISTS statement
     */
    public function useProductExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductQuery */
        $q = $this->useExistsQuery('Product', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the Product relation to the SpyProduct table for a NOT EXISTS query.
     *
     * @see useProductExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductQuery The inner query object of the NOT EXISTS statement
     */
    public function useProductNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductQuery */
        $q = $this->useExistsQuery('Product', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the Product relation to the SpyProduct table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductQuery The inner query object of the IN statement
     */
    public function useInProductQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductQuery */
        $q = $this->useInQuery('Product', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the Product relation to the SpyProduct table for a NOT IN query.
     *
     * @see useProductInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductQuery The inner query object of the NOT IN statement
     */
    public function useNotInProductQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductQuery */
        $q = $this->useInQuery('Product', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Product\Persistence\SpyProduct object
     *
     * @param \Orm\Zed\Product\Persistence\SpyProduct|ObjectCollection $spyProduct The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLeadProduct($spyProduct, ?string $comparison = null)
    {
        if ($spyProduct instanceof \Orm\Zed\Product\Persistence\SpyProduct) {
            return $this
                ->addUsingAlias(SpyProductPackagingUnitTableMap::COL_FK_LEAD_PRODUCT, $spyProduct->getIdProduct(), $comparison);
        } elseif ($spyProduct instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyProductPackagingUnitTableMap::COL_FK_LEAD_PRODUCT, $spyProduct->toKeyValue('PrimaryKey', 'IdProduct'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByLeadProduct() only accepts arguments of type \Orm\Zed\Product\Persistence\SpyProduct or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeadProduct relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinLeadProduct(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeadProduct');

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
            $this->addJoinObject($join, 'LeadProduct');
        }

        return $this;
    }

    /**
     * Use the LeadProduct relation SpyProduct object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductQuery A secondary query class using the current class as primary query
     */
    public function useLeadProductQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLeadProduct($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeadProduct', '\Orm\Zed\Product\Persistence\SpyProductQuery');
    }

    /**
     * Use the LeadProduct relation SpyProduct object
     *
     * @param callable(\Orm\Zed\Product\Persistence\SpyProductQuery):\Orm\Zed\Product\Persistence\SpyProductQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withLeadProductQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useLeadProductQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the LeadProduct relation to the SpyProduct table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductQuery The inner query object of the EXISTS statement
     */
    public function useLeadProductExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductQuery */
        $q = $this->useExistsQuery('LeadProduct', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the LeadProduct relation to the SpyProduct table for a NOT EXISTS query.
     *
     * @see useLeadProductExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductQuery The inner query object of the NOT EXISTS statement
     */
    public function useLeadProductNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductQuery */
        $q = $this->useExistsQuery('LeadProduct', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the LeadProduct relation to the SpyProduct table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductQuery The inner query object of the IN statement
     */
    public function useInLeadProductQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductQuery */
        $q = $this->useInQuery('LeadProduct', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the LeadProduct relation to the SpyProduct table for a NOT IN query.
     *
     * @see useLeadProductInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductQuery The inner query object of the NOT IN statement
     */
    public function useNotInLeadProductQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductQuery */
        $q = $this->useInQuery('LeadProduct', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitType object
     *
     * @param \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitType|ObjectCollection $spyProductPackagingUnitType The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductPackagingUnitType($spyProductPackagingUnitType, ?string $comparison = null)
    {
        if ($spyProductPackagingUnitType instanceof \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitType) {
            return $this
                ->addUsingAlias(SpyProductPackagingUnitTableMap::COL_FK_PRODUCT_PACKAGING_UNIT_TYPE, $spyProductPackagingUnitType->getIdProductPackagingUnitType(), $comparison);
        } elseif ($spyProductPackagingUnitType instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyProductPackagingUnitTableMap::COL_FK_PRODUCT_PACKAGING_UNIT_TYPE, $spyProductPackagingUnitType->toKeyValue('PrimaryKey', 'IdProductPackagingUnitType'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByProductPackagingUnitType() only accepts arguments of type \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitType or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductPackagingUnitType relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProductPackagingUnitType(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductPackagingUnitType');

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
            $this->addJoinObject($join, 'ProductPackagingUnitType');
        }

        return $this;
    }

    /**
     * Use the ProductPackagingUnitType relation SpyProductPackagingUnitType object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitTypeQuery A secondary query class using the current class as primary query
     */
    public function useProductPackagingUnitTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductPackagingUnitType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductPackagingUnitType', '\Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitTypeQuery');
    }

    /**
     * Use the ProductPackagingUnitType relation SpyProductPackagingUnitType object
     *
     * @param callable(\Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitTypeQuery):\Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitTypeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProductPackagingUnitTypeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProductPackagingUnitTypeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ProductPackagingUnitType relation to the SpyProductPackagingUnitType table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitTypeQuery The inner query object of the EXISTS statement
     */
    public function useProductPackagingUnitTypeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitTypeQuery */
        $q = $this->useExistsQuery('ProductPackagingUnitType', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ProductPackagingUnitType relation to the SpyProductPackagingUnitType table for a NOT EXISTS query.
     *
     * @see useProductPackagingUnitTypeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitTypeQuery The inner query object of the NOT EXISTS statement
     */
    public function useProductPackagingUnitTypeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitTypeQuery */
        $q = $this->useExistsQuery('ProductPackagingUnitType', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ProductPackagingUnitType relation to the SpyProductPackagingUnitType table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitTypeQuery The inner query object of the IN statement
     */
    public function useInProductPackagingUnitTypeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitTypeQuery */
        $q = $this->useInQuery('ProductPackagingUnitType', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ProductPackagingUnitType relation to the SpyProductPackagingUnitType table for a NOT IN query.
     *
     * @see useProductPackagingUnitTypeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitTypeQuery The inner query object of the NOT IN statement
     */
    public function useNotInProductPackagingUnitTypeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitTypeQuery */
        $q = $this->useInQuery('ProductPackagingUnitType', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyProductPackagingUnit $spyProductPackagingUnit Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyProductPackagingUnit = null)
    {
        if ($spyProductPackagingUnit) {
            $this->addUsingAlias(SpyProductPackagingUnitTableMap::COL_ID_PRODUCT_PACKAGING_UNIT, $spyProductPackagingUnit->getIdProductPackagingUnit(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_product_packaging_unit table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductPackagingUnitTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyProductPackagingUnitTableMap::clearInstancePool();
            SpyProductPackagingUnitTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductPackagingUnitTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyProductPackagingUnitTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyProductPackagingUnitTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyProductPackagingUnitTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(SpyProductPackagingUnitTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyProductPackagingUnitTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyProductPackagingUnitTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyProductPackagingUnitTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpyProductPackagingUnitTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyProductPackagingUnitTableMap::COL_CREATED_AT);

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
