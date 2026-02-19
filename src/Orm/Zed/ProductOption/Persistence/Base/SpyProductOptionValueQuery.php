<?php

namespace Orm\Zed\ProductOption\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\ProductOption\Persistence\SpyProductOptionValue as ChildSpyProductOptionValue;
use Orm\Zed\ProductOption\Persistence\SpyProductOptionValueQuery as ChildSpyProductOptionValueQuery;
use Orm\Zed\ProductOption\Persistence\Map\SpyProductOptionValueTableMap;
use Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOption;
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
 * Base class that represents a query for the `spy_product_option_value` table.
 *
 * @method     ChildSpyProductOptionValueQuery orderByIdProductOptionValue($order = Criteria::ASC) Order by the id_product_option_value column
 * @method     ChildSpyProductOptionValueQuery orderByFkProductOptionGroup($order = Criteria::ASC) Order by the fk_product_option_group column
 * @method     ChildSpyProductOptionValueQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     ChildSpyProductOptionValueQuery orderBySku($order = Criteria::ASC) Order by the sku column
 * @method     ChildSpyProductOptionValueQuery orderByValue($order = Criteria::ASC) Order by the value column
 * @method     ChildSpyProductOptionValueQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpyProductOptionValueQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpyProductOptionValueQuery groupByIdProductOptionValue() Group by the id_product_option_value column
 * @method     ChildSpyProductOptionValueQuery groupByFkProductOptionGroup() Group by the fk_product_option_group column
 * @method     ChildSpyProductOptionValueQuery groupByPrice() Group by the price column
 * @method     ChildSpyProductOptionValueQuery groupBySku() Group by the sku column
 * @method     ChildSpyProductOptionValueQuery groupByValue() Group by the value column
 * @method     ChildSpyProductOptionValueQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpyProductOptionValueQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpyProductOptionValueQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyProductOptionValueQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyProductOptionValueQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyProductOptionValueQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyProductOptionValueQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyProductOptionValueQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyProductOptionValueQuery leftJoinSpyProductOptionGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductOptionGroup relation
 * @method     ChildSpyProductOptionValueQuery rightJoinSpyProductOptionGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductOptionGroup relation
 * @method     ChildSpyProductOptionValueQuery innerJoinSpyProductOptionGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductOptionGroup relation
 *
 * @method     ChildSpyProductOptionValueQuery joinWithSpyProductOptionGroup($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductOptionGroup relation
 *
 * @method     ChildSpyProductOptionValueQuery leftJoinWithSpyProductOptionGroup() Adds a LEFT JOIN clause and with to the query using the SpyProductOptionGroup relation
 * @method     ChildSpyProductOptionValueQuery rightJoinWithSpyProductOptionGroup() Adds a RIGHT JOIN clause and with to the query using the SpyProductOptionGroup relation
 * @method     ChildSpyProductOptionValueQuery innerJoinWithSpyProductOptionGroup() Adds a INNER JOIN clause and with to the query using the SpyProductOptionGroup relation
 *
 * @method     ChildSpyProductOptionValueQuery leftJoinProductOptionValuePrice($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductOptionValuePrice relation
 * @method     ChildSpyProductOptionValueQuery rightJoinProductOptionValuePrice($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductOptionValuePrice relation
 * @method     ChildSpyProductOptionValueQuery innerJoinProductOptionValuePrice($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductOptionValuePrice relation
 *
 * @method     ChildSpyProductOptionValueQuery joinWithProductOptionValuePrice($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductOptionValuePrice relation
 *
 * @method     ChildSpyProductOptionValueQuery leftJoinWithProductOptionValuePrice() Adds a LEFT JOIN clause and with to the query using the ProductOptionValuePrice relation
 * @method     ChildSpyProductOptionValueQuery rightJoinWithProductOptionValuePrice() Adds a RIGHT JOIN clause and with to the query using the ProductOptionValuePrice relation
 * @method     ChildSpyProductOptionValueQuery innerJoinWithProductOptionValuePrice() Adds a INNER JOIN clause and with to the query using the ProductOptionValuePrice relation
 *
 * @method     ChildSpyProductOptionValueQuery leftJoinSpyShoppingListProductOption($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyShoppingListProductOption relation
 * @method     ChildSpyProductOptionValueQuery rightJoinSpyShoppingListProductOption($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyShoppingListProductOption relation
 * @method     ChildSpyProductOptionValueQuery innerJoinSpyShoppingListProductOption($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyShoppingListProductOption relation
 *
 * @method     ChildSpyProductOptionValueQuery joinWithSpyShoppingListProductOption($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyShoppingListProductOption relation
 *
 * @method     ChildSpyProductOptionValueQuery leftJoinWithSpyShoppingListProductOption() Adds a LEFT JOIN clause and with to the query using the SpyShoppingListProductOption relation
 * @method     ChildSpyProductOptionValueQuery rightJoinWithSpyShoppingListProductOption() Adds a RIGHT JOIN clause and with to the query using the SpyShoppingListProductOption relation
 * @method     ChildSpyProductOptionValueQuery innerJoinWithSpyShoppingListProductOption() Adds a INNER JOIN clause and with to the query using the SpyShoppingListProductOption relation
 *
 * @method     \Orm\Zed\ProductOption\Persistence\SpyProductOptionGroupQuery|\Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePriceQuery|\Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOptionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyProductOptionValue|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyProductOptionValue matching the query
 * @method     ChildSpyProductOptionValue findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyProductOptionValue matching the query, or a new ChildSpyProductOptionValue object populated from the query conditions when no match is found
 *
 * @method     ChildSpyProductOptionValue|null findOneByIdProductOptionValue(int $id_product_option_value) Return the first ChildSpyProductOptionValue filtered by the id_product_option_value column
 * @method     ChildSpyProductOptionValue|null findOneByFkProductOptionGroup(int $fk_product_option_group) Return the first ChildSpyProductOptionValue filtered by the fk_product_option_group column
 * @method     ChildSpyProductOptionValue|null findOneByPrice(int $price) Return the first ChildSpyProductOptionValue filtered by the price column
 * @method     ChildSpyProductOptionValue|null findOneBySku(string $sku) Return the first ChildSpyProductOptionValue filtered by the sku column
 * @method     ChildSpyProductOptionValue|null findOneByValue(string $value) Return the first ChildSpyProductOptionValue filtered by the value column
 * @method     ChildSpyProductOptionValue|null findOneByCreatedAt(string $created_at) Return the first ChildSpyProductOptionValue filtered by the created_at column
 * @method     ChildSpyProductOptionValue|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpyProductOptionValue filtered by the updated_at column
 *
 * @method     ChildSpyProductOptionValue requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyProductOptionValue by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductOptionValue requireOne(?ConnectionInterface $con = null) Return the first ChildSpyProductOptionValue matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyProductOptionValue requireOneByIdProductOptionValue(int $id_product_option_value) Return the first ChildSpyProductOptionValue filtered by the id_product_option_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductOptionValue requireOneByFkProductOptionGroup(int $fk_product_option_group) Return the first ChildSpyProductOptionValue filtered by the fk_product_option_group column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductOptionValue requireOneByPrice(int $price) Return the first ChildSpyProductOptionValue filtered by the price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductOptionValue requireOneBySku(string $sku) Return the first ChildSpyProductOptionValue filtered by the sku column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductOptionValue requireOneByValue(string $value) Return the first ChildSpyProductOptionValue filtered by the value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductOptionValue requireOneByCreatedAt(string $created_at) Return the first ChildSpyProductOptionValue filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductOptionValue requireOneByUpdatedAt(string $updated_at) Return the first ChildSpyProductOptionValue filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyProductOptionValue[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyProductOptionValue objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyProductOptionValue> find(?ConnectionInterface $con = null) Return ChildSpyProductOptionValue objects based on current ModelCriteria
 *
 * @method     ChildSpyProductOptionValue[]|Collection findByIdProductOptionValue(int|array<int> $id_product_option_value) Return ChildSpyProductOptionValue objects filtered by the id_product_option_value column
 * @psalm-method Collection&\Traversable<ChildSpyProductOptionValue> findByIdProductOptionValue(int|array<int> $id_product_option_value) Return ChildSpyProductOptionValue objects filtered by the id_product_option_value column
 * @method     ChildSpyProductOptionValue[]|Collection findByFkProductOptionGroup(int|array<int> $fk_product_option_group) Return ChildSpyProductOptionValue objects filtered by the fk_product_option_group column
 * @psalm-method Collection&\Traversable<ChildSpyProductOptionValue> findByFkProductOptionGroup(int|array<int> $fk_product_option_group) Return ChildSpyProductOptionValue objects filtered by the fk_product_option_group column
 * @method     ChildSpyProductOptionValue[]|Collection findByPrice(int|array<int> $price) Return ChildSpyProductOptionValue objects filtered by the price column
 * @psalm-method Collection&\Traversable<ChildSpyProductOptionValue> findByPrice(int|array<int> $price) Return ChildSpyProductOptionValue objects filtered by the price column
 * @method     ChildSpyProductOptionValue[]|Collection findBySku(string|array<string> $sku) Return ChildSpyProductOptionValue objects filtered by the sku column
 * @psalm-method Collection&\Traversable<ChildSpyProductOptionValue> findBySku(string|array<string> $sku) Return ChildSpyProductOptionValue objects filtered by the sku column
 * @method     ChildSpyProductOptionValue[]|Collection findByValue(string|array<string> $value) Return ChildSpyProductOptionValue objects filtered by the value column
 * @psalm-method Collection&\Traversable<ChildSpyProductOptionValue> findByValue(string|array<string> $value) Return ChildSpyProductOptionValue objects filtered by the value column
 * @method     ChildSpyProductOptionValue[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpyProductOptionValue objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpyProductOptionValue> findByCreatedAt(string|array<string> $created_at) Return ChildSpyProductOptionValue objects filtered by the created_at column
 * @method     ChildSpyProductOptionValue[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyProductOptionValue objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpyProductOptionValue> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyProductOptionValue objects filtered by the updated_at column
 *
 * @method     ChildSpyProductOptionValue[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyProductOptionValue> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyProductOptionValueQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\ProductOption\Persistence\Base\SpyProductOptionValueQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\ProductOption\\Persistence\\SpyProductOptionValue', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyProductOptionValueQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyProductOptionValueQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyProductOptionValueQuery) {
            return $criteria;
        }
        $query = new ChildSpyProductOptionValueQuery();
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
     * @return ChildSpyProductOptionValue|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyProductOptionValueTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyProductOptionValue A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_product_option_value, fk_product_option_group, price, sku, value, created_at, updated_at FROM spy_product_option_value WHERE id_product_option_value = :p0';
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
            /** @var ChildSpyProductOptionValue $obj */
            $obj = new ChildSpyProductOptionValue();
            $obj->hydrate($row);
            SpyProductOptionValueTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyProductOptionValue|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyProductOptionValueTableMap::COL_ID_PRODUCT_OPTION_VALUE, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyProductOptionValueTableMap::COL_ID_PRODUCT_OPTION_VALUE, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idProductOptionValue Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdProductOptionValue_Between(array $idProductOptionValue)
    {
        return $this->filterByIdProductOptionValue($idProductOptionValue, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idProductOptionValues Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdProductOptionValue_In(array $idProductOptionValues)
    {
        return $this->filterByIdProductOptionValue($idProductOptionValues, Criteria::IN);
    }

    /**
     * Filter the query on the id_product_option_value column
     *
     * Example usage:
     * <code>
     * $query->filterByIdProductOptionValue(1234); // WHERE id_product_option_value = 1234
     * $query->filterByIdProductOptionValue(array(12, 34), Criteria::IN); // WHERE id_product_option_value IN (12, 34)
     * $query->filterByIdProductOptionValue(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_product_option_value > 12
     * </code>
     *
     * @param     mixed $idProductOptionValue The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdProductOptionValue($idProductOptionValue = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idProductOptionValue)) {
            $useMinMax = false;
            if (isset($idProductOptionValue['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductOptionValueTableMap::COL_ID_PRODUCT_OPTION_VALUE, $idProductOptionValue['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idProductOptionValue['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductOptionValueTableMap::COL_ID_PRODUCT_OPTION_VALUE, $idProductOptionValue['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idProductOptionValue of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductOptionValueTableMap::COL_ID_PRODUCT_OPTION_VALUE, $idProductOptionValue, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkProductOptionGroup Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkProductOptionGroup_Between(array $fkProductOptionGroup)
    {
        return $this->filterByFkProductOptionGroup($fkProductOptionGroup, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkProductOptionGroups Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkProductOptionGroup_In(array $fkProductOptionGroups)
    {
        return $this->filterByFkProductOptionGroup($fkProductOptionGroups, Criteria::IN);
    }

    /**
     * Filter the query on the fk_product_option_group column
     *
     * Example usage:
     * <code>
     * $query->filterByFkProductOptionGroup(1234); // WHERE fk_product_option_group = 1234
     * $query->filterByFkProductOptionGroup(array(12, 34), Criteria::IN); // WHERE fk_product_option_group IN (12, 34)
     * $query->filterByFkProductOptionGroup(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_product_option_group > 12
     * </code>
     *
     * @see       filterBySpyProductOptionGroup()
     *
     * @param     mixed $fkProductOptionGroup The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkProductOptionGroup($fkProductOptionGroup = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkProductOptionGroup)) {
            $useMinMax = false;
            if (isset($fkProductOptionGroup['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductOptionValueTableMap::COL_FK_PRODUCT_OPTION_GROUP, $fkProductOptionGroup['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkProductOptionGroup['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductOptionValueTableMap::COL_FK_PRODUCT_OPTION_GROUP, $fkProductOptionGroup['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkProductOptionGroup of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductOptionValueTableMap::COL_FK_PRODUCT_OPTION_GROUP, $fkProductOptionGroup, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $price Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrice_Between(array $price)
    {
        return $this->filterByPrice($price, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $prices Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrice_In(array $prices)
    {
        return $this->filterByPrice($prices, Criteria::IN);
    }

    /**
     * Filter the query on the price column
     *
     * Example usage:
     * <code>
     * $query->filterByPrice(1234); // WHERE price = 1234
     * $query->filterByPrice(array(12, 34), Criteria::IN); // WHERE price IN (12, 34)
     * $query->filterByPrice(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE price > 12
     * </code>
     *
     * @param     mixed $price The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByPrice($price = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($price)) {
            $useMinMax = false;
            if (isset($price['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductOptionValueTableMap::COL_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductOptionValueTableMap::COL_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$price of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductOptionValueTableMap::COL_PRICE, $price, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $skus Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySku_In(array $skus)
    {
        return $this->filterBySku($skus, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $sku Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySku_Like($sku)
    {
        return $this->filterBySku($sku, Criteria::LIKE);
    }

    /**
     * Filter the query on the sku column
     *
     * Example usage:
     * <code>
     * $query->filterBySku('fooValue');   // WHERE sku = 'fooValue'
     * $query->filterBySku('%fooValue%', Criteria::LIKE); // WHERE sku LIKE '%fooValue%'
     * $query->filterBySku([1, 'foo'], Criteria::IN); // WHERE sku IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $sku The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterBySku($sku = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $sku = str_replace('*', '%', $sku);
        }

        if (is_array($sku) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$sku of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyProductOptionValueTableMap::COL_SKU, $sku, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $values Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByValue_In(array $values)
    {
        return $this->filterByValue($values, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $value Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByValue_Like($value)
    {
        return $this->filterByValue($value, Criteria::LIKE);
    }

    /**
     * Filter the query on the value column
     *
     * Example usage:
     * <code>
     * $query->filterByValue('fooValue');   // WHERE value = 'fooValue'
     * $query->filterByValue('%fooValue%', Criteria::LIKE); // WHERE value LIKE '%fooValue%'
     * $query->filterByValue([1, 'foo'], Criteria::IN); // WHERE value IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $value The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByValue($value = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $value = str_replace('*', '%', $value);
        }

        if (is_array($value) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$value of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyProductOptionValueTableMap::COL_VALUE, $value, $comparison);

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
                $this->addUsingAlias(SpyProductOptionValueTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductOptionValueTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductOptionValueTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SpyProductOptionValueTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductOptionValueTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductOptionValueTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductOption\Persistence\SpyProductOptionGroup object
     *
     * @param \Orm\Zed\ProductOption\Persistence\SpyProductOptionGroup|ObjectCollection $spyProductOptionGroup The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductOptionGroup($spyProductOptionGroup, ?string $comparison = null)
    {
        if ($spyProductOptionGroup instanceof \Orm\Zed\ProductOption\Persistence\SpyProductOptionGroup) {
            return $this
                ->addUsingAlias(SpyProductOptionValueTableMap::COL_FK_PRODUCT_OPTION_GROUP, $spyProductOptionGroup->getIdProductOptionGroup(), $comparison);
        } elseif ($spyProductOptionGroup instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyProductOptionValueTableMap::COL_FK_PRODUCT_OPTION_GROUP, $spyProductOptionGroup->toKeyValue('PrimaryKey', 'IdProductOptionGroup'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyProductOptionGroup() only accepts arguments of type \Orm\Zed\ProductOption\Persistence\SpyProductOptionGroup or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductOptionGroup relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductOptionGroup(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductOptionGroup');

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
            $this->addJoinObject($join, 'SpyProductOptionGroup');
        }

        return $this;
    }

    /**
     * Use the SpyProductOptionGroup relation SpyProductOptionGroup object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductOption\Persistence\SpyProductOptionGroupQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductOptionGroupQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductOptionGroup($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductOptionGroup', '\Orm\Zed\ProductOption\Persistence\SpyProductOptionGroupQuery');
    }

    /**
     * Use the SpyProductOptionGroup relation SpyProductOptionGroup object
     *
     * @param callable(\Orm\Zed\ProductOption\Persistence\SpyProductOptionGroupQuery):\Orm\Zed\ProductOption\Persistence\SpyProductOptionGroupQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductOptionGroupQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductOptionGroupQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductOptionGroup table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductOption\Persistence\SpyProductOptionGroupQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductOptionGroupExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductOption\Persistence\SpyProductOptionGroupQuery */
        $q = $this->useExistsQuery('SpyProductOptionGroup', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductOptionGroup table for a NOT EXISTS query.
     *
     * @see useSpyProductOptionGroupExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductOption\Persistence\SpyProductOptionGroupQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductOptionGroupNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductOption\Persistence\SpyProductOptionGroupQuery */
        $q = $this->useExistsQuery('SpyProductOptionGroup', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductOptionGroup table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductOption\Persistence\SpyProductOptionGroupQuery The inner query object of the IN statement
     */
    public function useInSpyProductOptionGroupQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductOption\Persistence\SpyProductOptionGroupQuery */
        $q = $this->useInQuery('SpyProductOptionGroup', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductOptionGroup table for a NOT IN query.
     *
     * @see useSpyProductOptionGroupInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductOption\Persistence\SpyProductOptionGroupQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductOptionGroupQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductOption\Persistence\SpyProductOptionGroupQuery */
        $q = $this->useInQuery('SpyProductOptionGroup', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePrice object
     *
     * @param \Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePrice|ObjectCollection $spyProductOptionValuePrice the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductOptionValuePrice($spyProductOptionValuePrice, ?string $comparison = null)
    {
        if ($spyProductOptionValuePrice instanceof \Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePrice) {
            $this
                ->addUsingAlias(SpyProductOptionValueTableMap::COL_ID_PRODUCT_OPTION_VALUE, $spyProductOptionValuePrice->getFkProductOptionValue(), $comparison);

            return $this;
        } elseif ($spyProductOptionValuePrice instanceof ObjectCollection) {
            $this
                ->useProductOptionValuePriceQuery()
                ->filterByPrimaryKeys($spyProductOptionValuePrice->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByProductOptionValuePrice() only accepts arguments of type \Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePrice or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductOptionValuePrice relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProductOptionValuePrice(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductOptionValuePrice');

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
            $this->addJoinObject($join, 'ProductOptionValuePrice');
        }

        return $this;
    }

    /**
     * Use the ProductOptionValuePrice relation SpyProductOptionValuePrice object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePriceQuery A secondary query class using the current class as primary query
     */
    public function useProductOptionValuePriceQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductOptionValuePrice($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductOptionValuePrice', '\Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePriceQuery');
    }

    /**
     * Use the ProductOptionValuePrice relation SpyProductOptionValuePrice object
     *
     * @param callable(\Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePriceQuery):\Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePriceQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProductOptionValuePriceQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProductOptionValuePriceQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ProductOptionValuePrice relation to the SpyProductOptionValuePrice table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePriceQuery The inner query object of the EXISTS statement
     */
    public function useProductOptionValuePriceExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePriceQuery */
        $q = $this->useExistsQuery('ProductOptionValuePrice', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ProductOptionValuePrice relation to the SpyProductOptionValuePrice table for a NOT EXISTS query.
     *
     * @see useProductOptionValuePriceExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePriceQuery The inner query object of the NOT EXISTS statement
     */
    public function useProductOptionValuePriceNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePriceQuery */
        $q = $this->useExistsQuery('ProductOptionValuePrice', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ProductOptionValuePrice relation to the SpyProductOptionValuePrice table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePriceQuery The inner query object of the IN statement
     */
    public function useInProductOptionValuePriceQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePriceQuery */
        $q = $this->useInQuery('ProductOptionValuePrice', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ProductOptionValuePrice relation to the SpyProductOptionValuePrice table for a NOT IN query.
     *
     * @see useProductOptionValuePriceInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePriceQuery The inner query object of the NOT IN statement
     */
    public function useNotInProductOptionValuePriceQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePriceQuery */
        $q = $this->useInQuery('ProductOptionValuePrice', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOption object
     *
     * @param \Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOption|ObjectCollection $spyShoppingListProductOption the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyShoppingListProductOption($spyShoppingListProductOption, ?string $comparison = null)
    {
        if ($spyShoppingListProductOption instanceof \Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOption) {
            $this
                ->addUsingAlias(SpyProductOptionValueTableMap::COL_ID_PRODUCT_OPTION_VALUE, $spyShoppingListProductOption->getFkProductOptionValue(), $comparison);

            return $this;
        } elseif ($spyShoppingListProductOption instanceof ObjectCollection) {
            $this
                ->useSpyShoppingListProductOptionQuery()
                ->filterByPrimaryKeys($spyShoppingListProductOption->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyShoppingListProductOption() only accepts arguments of type \Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOption or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyShoppingListProductOption relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyShoppingListProductOption(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyShoppingListProductOption');

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
            $this->addJoinObject($join, 'SpyShoppingListProductOption');
        }

        return $this;
    }

    /**
     * Use the SpyShoppingListProductOption relation SpyShoppingListProductOption object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOptionQuery A secondary query class using the current class as primary query
     */
    public function useSpyShoppingListProductOptionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyShoppingListProductOption($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyShoppingListProductOption', '\Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOptionQuery');
    }

    /**
     * Use the SpyShoppingListProductOption relation SpyShoppingListProductOption object
     *
     * @param callable(\Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOptionQuery):\Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOptionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyShoppingListProductOptionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyShoppingListProductOptionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyShoppingListProductOption table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOptionQuery The inner query object of the EXISTS statement
     */
    public function useSpyShoppingListProductOptionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOptionQuery */
        $q = $this->useExistsQuery('SpyShoppingListProductOption', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyShoppingListProductOption table for a NOT EXISTS query.
     *
     * @see useSpyShoppingListProductOptionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOptionQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyShoppingListProductOptionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOptionQuery */
        $q = $this->useExistsQuery('SpyShoppingListProductOption', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyShoppingListProductOption table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOptionQuery The inner query object of the IN statement
     */
    public function useInSpyShoppingListProductOptionQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOptionQuery */
        $q = $this->useInQuery('SpyShoppingListProductOption', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyShoppingListProductOption table for a NOT IN query.
     *
     * @see useSpyShoppingListProductOptionInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOptionQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyShoppingListProductOptionQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOptionQuery */
        $q = $this->useInQuery('SpyShoppingListProductOption', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyProductOptionValue $spyProductOptionValue Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyProductOptionValue = null)
    {
        if ($spyProductOptionValue) {
            $this->addUsingAlias(SpyProductOptionValueTableMap::COL_ID_PRODUCT_OPTION_VALUE, $spyProductOptionValue->getIdProductOptionValue(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_product_option_value table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductOptionValueTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyProductOptionValueTableMap::clearInstancePool();
            SpyProductOptionValueTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductOptionValueTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyProductOptionValueTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyProductOptionValueTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyProductOptionValueTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(SpyProductOptionValueTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyProductOptionValueTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyProductOptionValueTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyProductOptionValueTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpyProductOptionValueTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyProductOptionValueTableMap::COL_CREATED_AT);

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
