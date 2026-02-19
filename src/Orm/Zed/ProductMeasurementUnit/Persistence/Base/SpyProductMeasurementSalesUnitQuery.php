<?php

namespace Orm\Zed\ProductMeasurementUnit\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnit as ChildSpyProductMeasurementSalesUnit;
use Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitQuery as ChildSpyProductMeasurementSalesUnitQuery;
use Orm\Zed\ProductMeasurementUnit\Persistence\Map\SpyProductMeasurementSalesUnitTableMap;
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
 * Base class that represents a query for the `spy_product_measurement_sales_unit` table.
 *
 * @method     ChildSpyProductMeasurementSalesUnitQuery orderByIdProductMeasurementSalesUnit($order = Criteria::ASC) Order by the id_product_measurement_sales_unit column
 * @method     ChildSpyProductMeasurementSalesUnitQuery orderByFkProduct($order = Criteria::ASC) Order by the fk_product column
 * @method     ChildSpyProductMeasurementSalesUnitQuery orderByFkProductMeasurementBaseUnit($order = Criteria::ASC) Order by the fk_product_measurement_base_unit column
 * @method     ChildSpyProductMeasurementSalesUnitQuery orderByFkProductMeasurementUnit($order = Criteria::ASC) Order by the fk_product_measurement_unit column
 * @method     ChildSpyProductMeasurementSalesUnitQuery orderByConversion($order = Criteria::ASC) Order by the conversion column
 * @method     ChildSpyProductMeasurementSalesUnitQuery orderByIsDefault($order = Criteria::ASC) Order by the is_default column
 * @method     ChildSpyProductMeasurementSalesUnitQuery orderByIsDisplayed($order = Criteria::ASC) Order by the is_displayed column
 * @method     ChildSpyProductMeasurementSalesUnitQuery orderByKey($order = Criteria::ASC) Order by the key column
 * @method     ChildSpyProductMeasurementSalesUnitQuery orderByPrecision($order = Criteria::ASC) Order by the precision column
 * @method     ChildSpyProductMeasurementSalesUnitQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpyProductMeasurementSalesUnitQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpyProductMeasurementSalesUnitQuery groupByIdProductMeasurementSalesUnit() Group by the id_product_measurement_sales_unit column
 * @method     ChildSpyProductMeasurementSalesUnitQuery groupByFkProduct() Group by the fk_product column
 * @method     ChildSpyProductMeasurementSalesUnitQuery groupByFkProductMeasurementBaseUnit() Group by the fk_product_measurement_base_unit column
 * @method     ChildSpyProductMeasurementSalesUnitQuery groupByFkProductMeasurementUnit() Group by the fk_product_measurement_unit column
 * @method     ChildSpyProductMeasurementSalesUnitQuery groupByConversion() Group by the conversion column
 * @method     ChildSpyProductMeasurementSalesUnitQuery groupByIsDefault() Group by the is_default column
 * @method     ChildSpyProductMeasurementSalesUnitQuery groupByIsDisplayed() Group by the is_displayed column
 * @method     ChildSpyProductMeasurementSalesUnitQuery groupByKey() Group by the key column
 * @method     ChildSpyProductMeasurementSalesUnitQuery groupByPrecision() Group by the precision column
 * @method     ChildSpyProductMeasurementSalesUnitQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpyProductMeasurementSalesUnitQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpyProductMeasurementSalesUnitQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyProductMeasurementSalesUnitQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyProductMeasurementSalesUnitQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyProductMeasurementSalesUnitQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyProductMeasurementSalesUnitQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyProductMeasurementSalesUnitQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyProductMeasurementSalesUnitQuery leftJoinProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the Product relation
 * @method     ChildSpyProductMeasurementSalesUnitQuery rightJoinProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Product relation
 * @method     ChildSpyProductMeasurementSalesUnitQuery innerJoinProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the Product relation
 *
 * @method     ChildSpyProductMeasurementSalesUnitQuery joinWithProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Product relation
 *
 * @method     ChildSpyProductMeasurementSalesUnitQuery leftJoinWithProduct() Adds a LEFT JOIN clause and with to the query using the Product relation
 * @method     ChildSpyProductMeasurementSalesUnitQuery rightJoinWithProduct() Adds a RIGHT JOIN clause and with to the query using the Product relation
 * @method     ChildSpyProductMeasurementSalesUnitQuery innerJoinWithProduct() Adds a INNER JOIN clause and with to the query using the Product relation
 *
 * @method     ChildSpyProductMeasurementSalesUnitQuery leftJoinProductMeasurementUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductMeasurementUnit relation
 * @method     ChildSpyProductMeasurementSalesUnitQuery rightJoinProductMeasurementUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductMeasurementUnit relation
 * @method     ChildSpyProductMeasurementSalesUnitQuery innerJoinProductMeasurementUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductMeasurementUnit relation
 *
 * @method     ChildSpyProductMeasurementSalesUnitQuery joinWithProductMeasurementUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductMeasurementUnit relation
 *
 * @method     ChildSpyProductMeasurementSalesUnitQuery leftJoinWithProductMeasurementUnit() Adds a LEFT JOIN clause and with to the query using the ProductMeasurementUnit relation
 * @method     ChildSpyProductMeasurementSalesUnitQuery rightJoinWithProductMeasurementUnit() Adds a RIGHT JOIN clause and with to the query using the ProductMeasurementUnit relation
 * @method     ChildSpyProductMeasurementSalesUnitQuery innerJoinWithProductMeasurementUnit() Adds a INNER JOIN clause and with to the query using the ProductMeasurementUnit relation
 *
 * @method     ChildSpyProductMeasurementSalesUnitQuery leftJoinProductMeasurementBaseUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductMeasurementBaseUnit relation
 * @method     ChildSpyProductMeasurementSalesUnitQuery rightJoinProductMeasurementBaseUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductMeasurementBaseUnit relation
 * @method     ChildSpyProductMeasurementSalesUnitQuery innerJoinProductMeasurementBaseUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductMeasurementBaseUnit relation
 *
 * @method     ChildSpyProductMeasurementSalesUnitQuery joinWithProductMeasurementBaseUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductMeasurementBaseUnit relation
 *
 * @method     ChildSpyProductMeasurementSalesUnitQuery leftJoinWithProductMeasurementBaseUnit() Adds a LEFT JOIN clause and with to the query using the ProductMeasurementBaseUnit relation
 * @method     ChildSpyProductMeasurementSalesUnitQuery rightJoinWithProductMeasurementBaseUnit() Adds a RIGHT JOIN clause and with to the query using the ProductMeasurementBaseUnit relation
 * @method     ChildSpyProductMeasurementSalesUnitQuery innerJoinWithProductMeasurementBaseUnit() Adds a INNER JOIN clause and with to the query using the ProductMeasurementBaseUnit relation
 *
 * @method     ChildSpyProductMeasurementSalesUnitQuery leftJoinSpyProductMeasurementSalesUnitStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductMeasurementSalesUnitStore relation
 * @method     ChildSpyProductMeasurementSalesUnitQuery rightJoinSpyProductMeasurementSalesUnitStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductMeasurementSalesUnitStore relation
 * @method     ChildSpyProductMeasurementSalesUnitQuery innerJoinSpyProductMeasurementSalesUnitStore($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductMeasurementSalesUnitStore relation
 *
 * @method     ChildSpyProductMeasurementSalesUnitQuery joinWithSpyProductMeasurementSalesUnitStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductMeasurementSalesUnitStore relation
 *
 * @method     ChildSpyProductMeasurementSalesUnitQuery leftJoinWithSpyProductMeasurementSalesUnitStore() Adds a LEFT JOIN clause and with to the query using the SpyProductMeasurementSalesUnitStore relation
 * @method     ChildSpyProductMeasurementSalesUnitQuery rightJoinWithSpyProductMeasurementSalesUnitStore() Adds a RIGHT JOIN clause and with to the query using the SpyProductMeasurementSalesUnitStore relation
 * @method     ChildSpyProductMeasurementSalesUnitQuery innerJoinWithSpyProductMeasurementSalesUnitStore() Adds a INNER JOIN clause and with to the query using the SpyProductMeasurementSalesUnitStore relation
 *
 * @method     \Orm\Zed\Product\Persistence\SpyProductQuery|\Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementUnitQuery|\Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnitQuery|\Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStoreQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyProductMeasurementSalesUnit|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyProductMeasurementSalesUnit matching the query
 * @method     ChildSpyProductMeasurementSalesUnit findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyProductMeasurementSalesUnit matching the query, or a new ChildSpyProductMeasurementSalesUnit object populated from the query conditions when no match is found
 *
 * @method     ChildSpyProductMeasurementSalesUnit|null findOneByIdProductMeasurementSalesUnit(int $id_product_measurement_sales_unit) Return the first ChildSpyProductMeasurementSalesUnit filtered by the id_product_measurement_sales_unit column
 * @method     ChildSpyProductMeasurementSalesUnit|null findOneByFkProduct(int $fk_product) Return the first ChildSpyProductMeasurementSalesUnit filtered by the fk_product column
 * @method     ChildSpyProductMeasurementSalesUnit|null findOneByFkProductMeasurementBaseUnit(int $fk_product_measurement_base_unit) Return the first ChildSpyProductMeasurementSalesUnit filtered by the fk_product_measurement_base_unit column
 * @method     ChildSpyProductMeasurementSalesUnit|null findOneByFkProductMeasurementUnit(int $fk_product_measurement_unit) Return the first ChildSpyProductMeasurementSalesUnit filtered by the fk_product_measurement_unit column
 * @method     ChildSpyProductMeasurementSalesUnit|null findOneByConversion(double $conversion) Return the first ChildSpyProductMeasurementSalesUnit filtered by the conversion column
 * @method     ChildSpyProductMeasurementSalesUnit|null findOneByIsDefault(boolean $is_default) Return the first ChildSpyProductMeasurementSalesUnit filtered by the is_default column
 * @method     ChildSpyProductMeasurementSalesUnit|null findOneByIsDisplayed(boolean $is_displayed) Return the first ChildSpyProductMeasurementSalesUnit filtered by the is_displayed column
 * @method     ChildSpyProductMeasurementSalesUnit|null findOneByKey(string $key) Return the first ChildSpyProductMeasurementSalesUnit filtered by the key column
 * @method     ChildSpyProductMeasurementSalesUnit|null findOneByPrecision(int $precision) Return the first ChildSpyProductMeasurementSalesUnit filtered by the precision column
 * @method     ChildSpyProductMeasurementSalesUnit|null findOneByCreatedAt(string $created_at) Return the first ChildSpyProductMeasurementSalesUnit filtered by the created_at column
 * @method     ChildSpyProductMeasurementSalesUnit|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpyProductMeasurementSalesUnit filtered by the updated_at column
 *
 * @method     ChildSpyProductMeasurementSalesUnit requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyProductMeasurementSalesUnit by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductMeasurementSalesUnit requireOne(?ConnectionInterface $con = null) Return the first ChildSpyProductMeasurementSalesUnit matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyProductMeasurementSalesUnit requireOneByIdProductMeasurementSalesUnit(int $id_product_measurement_sales_unit) Return the first ChildSpyProductMeasurementSalesUnit filtered by the id_product_measurement_sales_unit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductMeasurementSalesUnit requireOneByFkProduct(int $fk_product) Return the first ChildSpyProductMeasurementSalesUnit filtered by the fk_product column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductMeasurementSalesUnit requireOneByFkProductMeasurementBaseUnit(int $fk_product_measurement_base_unit) Return the first ChildSpyProductMeasurementSalesUnit filtered by the fk_product_measurement_base_unit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductMeasurementSalesUnit requireOneByFkProductMeasurementUnit(int $fk_product_measurement_unit) Return the first ChildSpyProductMeasurementSalesUnit filtered by the fk_product_measurement_unit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductMeasurementSalesUnit requireOneByConversion(double $conversion) Return the first ChildSpyProductMeasurementSalesUnit filtered by the conversion column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductMeasurementSalesUnit requireOneByIsDefault(boolean $is_default) Return the first ChildSpyProductMeasurementSalesUnit filtered by the is_default column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductMeasurementSalesUnit requireOneByIsDisplayed(boolean $is_displayed) Return the first ChildSpyProductMeasurementSalesUnit filtered by the is_displayed column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductMeasurementSalesUnit requireOneByKey(string $key) Return the first ChildSpyProductMeasurementSalesUnit filtered by the key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductMeasurementSalesUnit requireOneByPrecision(int $precision) Return the first ChildSpyProductMeasurementSalesUnit filtered by the precision column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductMeasurementSalesUnit requireOneByCreatedAt(string $created_at) Return the first ChildSpyProductMeasurementSalesUnit filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductMeasurementSalesUnit requireOneByUpdatedAt(string $updated_at) Return the first ChildSpyProductMeasurementSalesUnit filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyProductMeasurementSalesUnit[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyProductMeasurementSalesUnit objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyProductMeasurementSalesUnit> find(?ConnectionInterface $con = null) Return ChildSpyProductMeasurementSalesUnit objects based on current ModelCriteria
 *
 * @method     ChildSpyProductMeasurementSalesUnit[]|Collection findByIdProductMeasurementSalesUnit(int|array<int> $id_product_measurement_sales_unit) Return ChildSpyProductMeasurementSalesUnit objects filtered by the id_product_measurement_sales_unit column
 * @psalm-method Collection&\Traversable<ChildSpyProductMeasurementSalesUnit> findByIdProductMeasurementSalesUnit(int|array<int> $id_product_measurement_sales_unit) Return ChildSpyProductMeasurementSalesUnit objects filtered by the id_product_measurement_sales_unit column
 * @method     ChildSpyProductMeasurementSalesUnit[]|Collection findByFkProduct(int|array<int> $fk_product) Return ChildSpyProductMeasurementSalesUnit objects filtered by the fk_product column
 * @psalm-method Collection&\Traversable<ChildSpyProductMeasurementSalesUnit> findByFkProduct(int|array<int> $fk_product) Return ChildSpyProductMeasurementSalesUnit objects filtered by the fk_product column
 * @method     ChildSpyProductMeasurementSalesUnit[]|Collection findByFkProductMeasurementBaseUnit(int|array<int> $fk_product_measurement_base_unit) Return ChildSpyProductMeasurementSalesUnit objects filtered by the fk_product_measurement_base_unit column
 * @psalm-method Collection&\Traversable<ChildSpyProductMeasurementSalesUnit> findByFkProductMeasurementBaseUnit(int|array<int> $fk_product_measurement_base_unit) Return ChildSpyProductMeasurementSalesUnit objects filtered by the fk_product_measurement_base_unit column
 * @method     ChildSpyProductMeasurementSalesUnit[]|Collection findByFkProductMeasurementUnit(int|array<int> $fk_product_measurement_unit) Return ChildSpyProductMeasurementSalesUnit objects filtered by the fk_product_measurement_unit column
 * @psalm-method Collection&\Traversable<ChildSpyProductMeasurementSalesUnit> findByFkProductMeasurementUnit(int|array<int> $fk_product_measurement_unit) Return ChildSpyProductMeasurementSalesUnit objects filtered by the fk_product_measurement_unit column
 * @method     ChildSpyProductMeasurementSalesUnit[]|Collection findByConversion(double|array<double> $conversion) Return ChildSpyProductMeasurementSalesUnit objects filtered by the conversion column
 * @psalm-method Collection&\Traversable<ChildSpyProductMeasurementSalesUnit> findByConversion(double|array<double> $conversion) Return ChildSpyProductMeasurementSalesUnit objects filtered by the conversion column
 * @method     ChildSpyProductMeasurementSalesUnit[]|Collection findByIsDefault(boolean|array<boolean> $is_default) Return ChildSpyProductMeasurementSalesUnit objects filtered by the is_default column
 * @psalm-method Collection&\Traversable<ChildSpyProductMeasurementSalesUnit> findByIsDefault(boolean|array<boolean> $is_default) Return ChildSpyProductMeasurementSalesUnit objects filtered by the is_default column
 * @method     ChildSpyProductMeasurementSalesUnit[]|Collection findByIsDisplayed(boolean|array<boolean> $is_displayed) Return ChildSpyProductMeasurementSalesUnit objects filtered by the is_displayed column
 * @psalm-method Collection&\Traversable<ChildSpyProductMeasurementSalesUnit> findByIsDisplayed(boolean|array<boolean> $is_displayed) Return ChildSpyProductMeasurementSalesUnit objects filtered by the is_displayed column
 * @method     ChildSpyProductMeasurementSalesUnit[]|Collection findByKey(string|array<string> $key) Return ChildSpyProductMeasurementSalesUnit objects filtered by the key column
 * @psalm-method Collection&\Traversable<ChildSpyProductMeasurementSalesUnit> findByKey(string|array<string> $key) Return ChildSpyProductMeasurementSalesUnit objects filtered by the key column
 * @method     ChildSpyProductMeasurementSalesUnit[]|Collection findByPrecision(int|array<int> $precision) Return ChildSpyProductMeasurementSalesUnit objects filtered by the precision column
 * @psalm-method Collection&\Traversable<ChildSpyProductMeasurementSalesUnit> findByPrecision(int|array<int> $precision) Return ChildSpyProductMeasurementSalesUnit objects filtered by the precision column
 * @method     ChildSpyProductMeasurementSalesUnit[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpyProductMeasurementSalesUnit objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpyProductMeasurementSalesUnit> findByCreatedAt(string|array<string> $created_at) Return ChildSpyProductMeasurementSalesUnit objects filtered by the created_at column
 * @method     ChildSpyProductMeasurementSalesUnit[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyProductMeasurementSalesUnit objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpyProductMeasurementSalesUnit> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyProductMeasurementSalesUnit objects filtered by the updated_at column
 *
 * @method     ChildSpyProductMeasurementSalesUnit[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyProductMeasurementSalesUnit> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyProductMeasurementSalesUnitQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\ProductMeasurementUnit\Persistence\Base\SpyProductMeasurementSalesUnitQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\ProductMeasurementUnit\\Persistence\\SpyProductMeasurementSalesUnit', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyProductMeasurementSalesUnitQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyProductMeasurementSalesUnitQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyProductMeasurementSalesUnitQuery) {
            return $criteria;
        }
        $query = new ChildSpyProductMeasurementSalesUnitQuery();
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
     * @return ChildSpyProductMeasurementSalesUnit|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyProductMeasurementSalesUnitTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyProductMeasurementSalesUnit A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id_product_measurement_sales_unit`, `fk_product`, `fk_product_measurement_base_unit`, `fk_product_measurement_unit`, `conversion`, `is_default`, `is_displayed`, `key`, `precision`, `created_at`, `updated_at` FROM `spy_product_measurement_sales_unit` WHERE `id_product_measurement_sales_unit` = :p0';
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
            /** @var ChildSpyProductMeasurementSalesUnit $obj */
            $obj = new ChildSpyProductMeasurementSalesUnit();
            $obj->hydrate($row);
            SpyProductMeasurementSalesUnitTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyProductMeasurementSalesUnit|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_ID_PRODUCT_MEASUREMENT_SALES_UNIT, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_ID_PRODUCT_MEASUREMENT_SALES_UNIT, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idProductMeasurementSalesUnit Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdProductMeasurementSalesUnit_Between(array $idProductMeasurementSalesUnit)
    {
        return $this->filterByIdProductMeasurementSalesUnit($idProductMeasurementSalesUnit, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idProductMeasurementSalesUnits Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdProductMeasurementSalesUnit_In(array $idProductMeasurementSalesUnits)
    {
        return $this->filterByIdProductMeasurementSalesUnit($idProductMeasurementSalesUnits, Criteria::IN);
    }

    /**
     * Filter the query on the id_product_measurement_sales_unit column
     *
     * Example usage:
     * <code>
     * $query->filterByIdProductMeasurementSalesUnit(1234); // WHERE id_product_measurement_sales_unit = 1234
     * $query->filterByIdProductMeasurementSalesUnit(array(12, 34), Criteria::IN); // WHERE id_product_measurement_sales_unit IN (12, 34)
     * $query->filterByIdProductMeasurementSalesUnit(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_product_measurement_sales_unit > 12
     * </code>
     *
     * @param     mixed $idProductMeasurementSalesUnit The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdProductMeasurementSalesUnit($idProductMeasurementSalesUnit = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idProductMeasurementSalesUnit)) {
            $useMinMax = false;
            if (isset($idProductMeasurementSalesUnit['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_ID_PRODUCT_MEASUREMENT_SALES_UNIT, $idProductMeasurementSalesUnit['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idProductMeasurementSalesUnit['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_ID_PRODUCT_MEASUREMENT_SALES_UNIT, $idProductMeasurementSalesUnit['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idProductMeasurementSalesUnit of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_ID_PRODUCT_MEASUREMENT_SALES_UNIT, $idProductMeasurementSalesUnit, $comparison);

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
                $this->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT, $fkProduct['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkProduct['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT, $fkProduct['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkProduct of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT, $fkProduct, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkProductMeasurementBaseUnit Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkProductMeasurementBaseUnit_Between(array $fkProductMeasurementBaseUnit)
    {
        return $this->filterByFkProductMeasurementBaseUnit($fkProductMeasurementBaseUnit, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkProductMeasurementBaseUnits Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkProductMeasurementBaseUnit_In(array $fkProductMeasurementBaseUnits)
    {
        return $this->filterByFkProductMeasurementBaseUnit($fkProductMeasurementBaseUnits, Criteria::IN);
    }

    /**
     * Filter the query on the fk_product_measurement_base_unit column
     *
     * Example usage:
     * <code>
     * $query->filterByFkProductMeasurementBaseUnit(1234); // WHERE fk_product_measurement_base_unit = 1234
     * $query->filterByFkProductMeasurementBaseUnit(array(12, 34), Criteria::IN); // WHERE fk_product_measurement_base_unit IN (12, 34)
     * $query->filterByFkProductMeasurementBaseUnit(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_product_measurement_base_unit > 12
     * </code>
     *
     * @see       filterByProductMeasurementBaseUnit()
     *
     * @param     mixed $fkProductMeasurementBaseUnit The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkProductMeasurementBaseUnit($fkProductMeasurementBaseUnit = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkProductMeasurementBaseUnit)) {
            $useMinMax = false;
            if (isset($fkProductMeasurementBaseUnit['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_BASE_UNIT, $fkProductMeasurementBaseUnit['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkProductMeasurementBaseUnit['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_BASE_UNIT, $fkProductMeasurementBaseUnit['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkProductMeasurementBaseUnit of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_BASE_UNIT, $fkProductMeasurementBaseUnit, $comparison);

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
                $this->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_UNIT, $fkProductMeasurementUnit['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkProductMeasurementUnit['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_UNIT, $fkProductMeasurementUnit['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkProductMeasurementUnit of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_UNIT, $fkProductMeasurementUnit, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $conversion Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByConversion_Between(array $conversion)
    {
        return $this->filterByConversion($conversion, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $conversions Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByConversion_In(array $conversions)
    {
        return $this->filterByConversion($conversions, Criteria::IN);
    }

    /**
     * Filter the query on the conversion column
     *
     * Example usage:
     * <code>
     * $query->filterByConversion(1234); // WHERE conversion = 1234
     * $query->filterByConversion(array(12, 34), Criteria::IN); // WHERE conversion IN (12, 34)
     * $query->filterByConversion(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE conversion > 12
     * </code>
     *
     * @param     mixed $conversion The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByConversion($conversion = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($conversion)) {
            $useMinMax = false;
            if (isset($conversion['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_CONVERSION, $conversion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($conversion['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_CONVERSION, $conversion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$conversion of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_CONVERSION, $conversion, $comparison);

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

        $query = $this->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_IS_DEFAULT, $isDefault, $comparison);

        return $query;
    }

    /**
     * Filter the query on the is_displayed column
     *
     * Example usage:
     * <code>
     * $query->filterByIsDisplayed(true); // WHERE is_displayed = true
     * $query->filterByIsDisplayed('yes'); // WHERE is_displayed = true
     * </code>
     *
     * @param     bool|string $isDisplayed The value to use as filter.
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
    public function filterByIsDisplayed($isDisplayed = null, $comparison = Criteria::EQUAL)
    {
        if (is_string($isDisplayed)) {
            $isDisplayed = in_array(strtolower($isDisplayed), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $query = $this->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_IS_DISPLAYED, $isDisplayed, $comparison);

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

        $query = $this->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_KEY, $key, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $precision Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrecision_Between(array $precision)
    {
        return $this->filterByPrecision($precision, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $precisions Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrecision_In(array $precisions)
    {
        return $this->filterByPrecision($precisions, Criteria::IN);
    }

    /**
     * Filter the query on the precision column
     *
     * Example usage:
     * <code>
     * $query->filterByPrecision(1234); // WHERE precision = 1234
     * $query->filterByPrecision(array(12, 34), Criteria::IN); // WHERE precision IN (12, 34)
     * $query->filterByPrecision(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE precision > 12
     * </code>
     *
     * @param     mixed $precision The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByPrecision($precision = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($precision)) {
            $useMinMax = false;
            if (isset($precision['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_PRECISION, $precision['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($precision['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_PRECISION, $precision['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$precision of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_PRECISION, $precision, $comparison);

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
                $this->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
                ->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT, $spyProduct->getIdProduct(), $comparison);
        } elseif ($spyProduct instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT, $spyProduct->toKeyValue('PrimaryKey', 'IdProduct'), $comparison);

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
                ->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_UNIT, $spyProductMeasurementUnit->getIdProductMeasurementUnit(), $comparison);
        } elseif ($spyProductMeasurementUnit instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_UNIT, $spyProductMeasurementUnit->toKeyValue('PrimaryKey', 'IdProductMeasurementUnit'), $comparison);

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
     * Filter the query by a related \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnit object
     *
     * @param \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnit|ObjectCollection $spyProductMeasurementBaseUnit The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductMeasurementBaseUnit($spyProductMeasurementBaseUnit, ?string $comparison = null)
    {
        if ($spyProductMeasurementBaseUnit instanceof \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnit) {
            return $this
                ->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_BASE_UNIT, $spyProductMeasurementBaseUnit->getIdProductMeasurementBaseUnit(), $comparison);
        } elseif ($spyProductMeasurementBaseUnit instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_BASE_UNIT, $spyProductMeasurementBaseUnit->toKeyValue('PrimaryKey', 'IdProductMeasurementBaseUnit'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByProductMeasurementBaseUnit() only accepts arguments of type \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnit or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductMeasurementBaseUnit relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProductMeasurementBaseUnit(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductMeasurementBaseUnit');

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
            $this->addJoinObject($join, 'ProductMeasurementBaseUnit');
        }

        return $this;
    }

    /**
     * Use the ProductMeasurementBaseUnit relation SpyProductMeasurementBaseUnit object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnitQuery A secondary query class using the current class as primary query
     */
    public function useProductMeasurementBaseUnitQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductMeasurementBaseUnit($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductMeasurementBaseUnit', '\Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnitQuery');
    }

    /**
     * Use the ProductMeasurementBaseUnit relation SpyProductMeasurementBaseUnit object
     *
     * @param callable(\Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnitQuery):\Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnitQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProductMeasurementBaseUnitQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProductMeasurementBaseUnitQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ProductMeasurementBaseUnit relation to the SpyProductMeasurementBaseUnit table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnitQuery The inner query object of the EXISTS statement
     */
    public function useProductMeasurementBaseUnitExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnitQuery */
        $q = $this->useExistsQuery('ProductMeasurementBaseUnit', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ProductMeasurementBaseUnit relation to the SpyProductMeasurementBaseUnit table for a NOT EXISTS query.
     *
     * @see useProductMeasurementBaseUnitExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnitQuery The inner query object of the NOT EXISTS statement
     */
    public function useProductMeasurementBaseUnitNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnitQuery */
        $q = $this->useExistsQuery('ProductMeasurementBaseUnit', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ProductMeasurementBaseUnit relation to the SpyProductMeasurementBaseUnit table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnitQuery The inner query object of the IN statement
     */
    public function useInProductMeasurementBaseUnitQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnitQuery */
        $q = $this->useInQuery('ProductMeasurementBaseUnit', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ProductMeasurementBaseUnit relation to the SpyProductMeasurementBaseUnit table for a NOT IN query.
     *
     * @see useProductMeasurementBaseUnitInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnitQuery The inner query object of the NOT IN statement
     */
    public function useNotInProductMeasurementBaseUnitQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnitQuery */
        $q = $this->useInQuery('ProductMeasurementBaseUnit', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStore object
     *
     * @param \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStore|ObjectCollection $spyProductMeasurementSalesUnitStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductMeasurementSalesUnitStore($spyProductMeasurementSalesUnitStore, ?string $comparison = null)
    {
        if ($spyProductMeasurementSalesUnitStore instanceof \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStore) {
            $this
                ->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_ID_PRODUCT_MEASUREMENT_SALES_UNIT, $spyProductMeasurementSalesUnitStore->getFkProductMeasurementSalesUnit(), $comparison);

            return $this;
        } elseif ($spyProductMeasurementSalesUnitStore instanceof ObjectCollection) {
            $this
                ->useSpyProductMeasurementSalesUnitStoreQuery()
                ->filterByPrimaryKeys($spyProductMeasurementSalesUnitStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductMeasurementSalesUnitStore() only accepts arguments of type \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductMeasurementSalesUnitStore relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductMeasurementSalesUnitStore(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductMeasurementSalesUnitStore');

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
            $this->addJoinObject($join, 'SpyProductMeasurementSalesUnitStore');
        }

        return $this;
    }

    /**
     * Use the SpyProductMeasurementSalesUnitStore relation SpyProductMeasurementSalesUnitStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStoreQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductMeasurementSalesUnitStoreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductMeasurementSalesUnitStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductMeasurementSalesUnitStore', '\Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStoreQuery');
    }

    /**
     * Use the SpyProductMeasurementSalesUnitStore relation SpyProductMeasurementSalesUnitStore object
     *
     * @param callable(\Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStoreQuery):\Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductMeasurementSalesUnitStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductMeasurementSalesUnitStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductMeasurementSalesUnitStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStoreQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductMeasurementSalesUnitStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStoreQuery */
        $q = $this->useExistsQuery('SpyProductMeasurementSalesUnitStore', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductMeasurementSalesUnitStore table for a NOT EXISTS query.
     *
     * @see useSpyProductMeasurementSalesUnitStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductMeasurementSalesUnitStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStoreQuery */
        $q = $this->useExistsQuery('SpyProductMeasurementSalesUnitStore', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductMeasurementSalesUnitStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStoreQuery The inner query object of the IN statement
     */
    public function useInSpyProductMeasurementSalesUnitStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStoreQuery */
        $q = $this->useInQuery('SpyProductMeasurementSalesUnitStore', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductMeasurementSalesUnitStore table for a NOT IN query.
     *
     * @see useSpyProductMeasurementSalesUnitStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductMeasurementSalesUnitStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStoreQuery */
        $q = $this->useInQuery('SpyProductMeasurementSalesUnitStore', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyProductMeasurementSalesUnit $spyProductMeasurementSalesUnit Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyProductMeasurementSalesUnit = null)
    {
        if ($spyProductMeasurementSalesUnit) {
            $this->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_ID_PRODUCT_MEASUREMENT_SALES_UNIT, $spyProductMeasurementSalesUnit->getIdProductMeasurementSalesUnit(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_product_measurement_sales_unit table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductMeasurementSalesUnitTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyProductMeasurementSalesUnitTableMap::clearInstancePool();
            SpyProductMeasurementSalesUnitTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductMeasurementSalesUnitTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyProductMeasurementSalesUnitTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyProductMeasurementSalesUnitTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyProductMeasurementSalesUnitTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyProductMeasurementSalesUnitTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyProductMeasurementSalesUnitTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyProductMeasurementSalesUnitTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpyProductMeasurementSalesUnitTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyProductMeasurementSalesUnitTableMap::COL_CREATED_AT);

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
