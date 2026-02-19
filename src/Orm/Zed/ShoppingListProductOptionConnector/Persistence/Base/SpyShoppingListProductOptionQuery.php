<?php

namespace Orm\Zed\ShoppingListProductOptionConnector\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\ProductOption\Persistence\SpyProductOptionValue;
use Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOption as ChildSpyShoppingListProductOption;
use Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOptionQuery as ChildSpyShoppingListProductOptionQuery;
use Orm\Zed\ShoppingListProductOptionConnector\Persistence\Map\SpyShoppingListProductOptionTableMap;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingListItem;
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
 * Base class that represents a query for the `spy_shopping_list_product_option` table.
 *
 * @method     ChildSpyShoppingListProductOptionQuery orderByIdShoppingListItemProductOption($order = Criteria::ASC) Order by the id_shopping_list_item_product_option column
 * @method     ChildSpyShoppingListProductOptionQuery orderByFkProductOptionValue($order = Criteria::ASC) Order by the fk_product_option_value column
 * @method     ChildSpyShoppingListProductOptionQuery orderByFkShoppingListItem($order = Criteria::ASC) Order by the fk_shopping_list_item column
 *
 * @method     ChildSpyShoppingListProductOptionQuery groupByIdShoppingListItemProductOption() Group by the id_shopping_list_item_product_option column
 * @method     ChildSpyShoppingListProductOptionQuery groupByFkProductOptionValue() Group by the fk_product_option_value column
 * @method     ChildSpyShoppingListProductOptionQuery groupByFkShoppingListItem() Group by the fk_shopping_list_item column
 *
 * @method     ChildSpyShoppingListProductOptionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyShoppingListProductOptionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyShoppingListProductOptionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyShoppingListProductOptionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyShoppingListProductOptionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyShoppingListProductOptionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyShoppingListProductOptionQuery leftJoinSpyShoppingListItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyShoppingListItem relation
 * @method     ChildSpyShoppingListProductOptionQuery rightJoinSpyShoppingListItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyShoppingListItem relation
 * @method     ChildSpyShoppingListProductOptionQuery innerJoinSpyShoppingListItem($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyShoppingListItem relation
 *
 * @method     ChildSpyShoppingListProductOptionQuery joinWithSpyShoppingListItem($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyShoppingListItem relation
 *
 * @method     ChildSpyShoppingListProductOptionQuery leftJoinWithSpyShoppingListItem() Adds a LEFT JOIN clause and with to the query using the SpyShoppingListItem relation
 * @method     ChildSpyShoppingListProductOptionQuery rightJoinWithSpyShoppingListItem() Adds a RIGHT JOIN clause and with to the query using the SpyShoppingListItem relation
 * @method     ChildSpyShoppingListProductOptionQuery innerJoinWithSpyShoppingListItem() Adds a INNER JOIN clause and with to the query using the SpyShoppingListItem relation
 *
 * @method     ChildSpyShoppingListProductOptionQuery leftJoinSpyProductOptionValue($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductOptionValue relation
 * @method     ChildSpyShoppingListProductOptionQuery rightJoinSpyProductOptionValue($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductOptionValue relation
 * @method     ChildSpyShoppingListProductOptionQuery innerJoinSpyProductOptionValue($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductOptionValue relation
 *
 * @method     ChildSpyShoppingListProductOptionQuery joinWithSpyProductOptionValue($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductOptionValue relation
 *
 * @method     ChildSpyShoppingListProductOptionQuery leftJoinWithSpyProductOptionValue() Adds a LEFT JOIN clause and with to the query using the SpyProductOptionValue relation
 * @method     ChildSpyShoppingListProductOptionQuery rightJoinWithSpyProductOptionValue() Adds a RIGHT JOIN clause and with to the query using the SpyProductOptionValue relation
 * @method     ChildSpyShoppingListProductOptionQuery innerJoinWithSpyProductOptionValue() Adds a INNER JOIN clause and with to the query using the SpyProductOptionValue relation
 *
 * @method     \Orm\Zed\ShoppingList\Persistence\SpyShoppingListItemQuery|\Orm\Zed\ProductOption\Persistence\SpyProductOptionValueQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyShoppingListProductOption|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyShoppingListProductOption matching the query
 * @method     ChildSpyShoppingListProductOption findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyShoppingListProductOption matching the query, or a new ChildSpyShoppingListProductOption object populated from the query conditions when no match is found
 *
 * @method     ChildSpyShoppingListProductOption|null findOneByIdShoppingListItemProductOption(int $id_shopping_list_item_product_option) Return the first ChildSpyShoppingListProductOption filtered by the id_shopping_list_item_product_option column
 * @method     ChildSpyShoppingListProductOption|null findOneByFkProductOptionValue(int $fk_product_option_value) Return the first ChildSpyShoppingListProductOption filtered by the fk_product_option_value column
 * @method     ChildSpyShoppingListProductOption|null findOneByFkShoppingListItem(int $fk_shopping_list_item) Return the first ChildSpyShoppingListProductOption filtered by the fk_shopping_list_item column
 *
 * @method     ChildSpyShoppingListProductOption requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyShoppingListProductOption by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyShoppingListProductOption requireOne(?ConnectionInterface $con = null) Return the first ChildSpyShoppingListProductOption matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyShoppingListProductOption requireOneByIdShoppingListItemProductOption(int $id_shopping_list_item_product_option) Return the first ChildSpyShoppingListProductOption filtered by the id_shopping_list_item_product_option column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyShoppingListProductOption requireOneByFkProductOptionValue(int $fk_product_option_value) Return the first ChildSpyShoppingListProductOption filtered by the fk_product_option_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyShoppingListProductOption requireOneByFkShoppingListItem(int $fk_shopping_list_item) Return the first ChildSpyShoppingListProductOption filtered by the fk_shopping_list_item column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyShoppingListProductOption[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyShoppingListProductOption objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyShoppingListProductOption> find(?ConnectionInterface $con = null) Return ChildSpyShoppingListProductOption objects based on current ModelCriteria
 *
 * @method     ChildSpyShoppingListProductOption[]|Collection findByIdShoppingListItemProductOption(int|array<int> $id_shopping_list_item_product_option) Return ChildSpyShoppingListProductOption objects filtered by the id_shopping_list_item_product_option column
 * @psalm-method Collection&\Traversable<ChildSpyShoppingListProductOption> findByIdShoppingListItemProductOption(int|array<int> $id_shopping_list_item_product_option) Return ChildSpyShoppingListProductOption objects filtered by the id_shopping_list_item_product_option column
 * @method     ChildSpyShoppingListProductOption[]|Collection findByFkProductOptionValue(int|array<int> $fk_product_option_value) Return ChildSpyShoppingListProductOption objects filtered by the fk_product_option_value column
 * @psalm-method Collection&\Traversable<ChildSpyShoppingListProductOption> findByFkProductOptionValue(int|array<int> $fk_product_option_value) Return ChildSpyShoppingListProductOption objects filtered by the fk_product_option_value column
 * @method     ChildSpyShoppingListProductOption[]|Collection findByFkShoppingListItem(int|array<int> $fk_shopping_list_item) Return ChildSpyShoppingListProductOption objects filtered by the fk_shopping_list_item column
 * @psalm-method Collection&\Traversable<ChildSpyShoppingListProductOption> findByFkShoppingListItem(int|array<int> $fk_shopping_list_item) Return ChildSpyShoppingListProductOption objects filtered by the fk_shopping_list_item column
 *
 * @method     ChildSpyShoppingListProductOption[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyShoppingListProductOption> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyShoppingListProductOptionQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\ShoppingListProductOptionConnector\Persistence\Base\SpyShoppingListProductOptionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\ShoppingListProductOptionConnector\\Persistence\\SpyShoppingListProductOption', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyShoppingListProductOptionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyShoppingListProductOptionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyShoppingListProductOptionQuery) {
            return $criteria;
        }
        $query = new ChildSpyShoppingListProductOptionQuery();
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
     * @return ChildSpyShoppingListProductOption|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyShoppingListProductOptionTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyShoppingListProductOption A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_shopping_list_item_product_option, fk_product_option_value, fk_shopping_list_item FROM spy_shopping_list_product_option WHERE id_shopping_list_item_product_option = :p0';
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
            /** @var ChildSpyShoppingListProductOption $obj */
            $obj = new ChildSpyShoppingListProductOption();
            $obj->hydrate($row);
            SpyShoppingListProductOptionTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyShoppingListProductOption|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyShoppingListProductOptionTableMap::COL_ID_SHOPPING_LIST_ITEM_PRODUCT_OPTION, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyShoppingListProductOptionTableMap::COL_ID_SHOPPING_LIST_ITEM_PRODUCT_OPTION, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idShoppingListItemProductOption Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdShoppingListItemProductOption_Between(array $idShoppingListItemProductOption)
    {
        return $this->filterByIdShoppingListItemProductOption($idShoppingListItemProductOption, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idShoppingListItemProductOptions Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdShoppingListItemProductOption_In(array $idShoppingListItemProductOptions)
    {
        return $this->filterByIdShoppingListItemProductOption($idShoppingListItemProductOptions, Criteria::IN);
    }

    /**
     * Filter the query on the id_shopping_list_item_product_option column
     *
     * Example usage:
     * <code>
     * $query->filterByIdShoppingListItemProductOption(1234); // WHERE id_shopping_list_item_product_option = 1234
     * $query->filterByIdShoppingListItemProductOption(array(12, 34), Criteria::IN); // WHERE id_shopping_list_item_product_option IN (12, 34)
     * $query->filterByIdShoppingListItemProductOption(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_shopping_list_item_product_option > 12
     * </code>
     *
     * @param     mixed $idShoppingListItemProductOption The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdShoppingListItemProductOption($idShoppingListItemProductOption = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idShoppingListItemProductOption)) {
            $useMinMax = false;
            if (isset($idShoppingListItemProductOption['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyShoppingListProductOptionTableMap::COL_ID_SHOPPING_LIST_ITEM_PRODUCT_OPTION, $idShoppingListItemProductOption['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idShoppingListItemProductOption['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyShoppingListProductOptionTableMap::COL_ID_SHOPPING_LIST_ITEM_PRODUCT_OPTION, $idShoppingListItemProductOption['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idShoppingListItemProductOption of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyShoppingListProductOptionTableMap::COL_ID_SHOPPING_LIST_ITEM_PRODUCT_OPTION, $idShoppingListItemProductOption, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkProductOptionValue Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkProductOptionValue_Between(array $fkProductOptionValue)
    {
        return $this->filterByFkProductOptionValue($fkProductOptionValue, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkProductOptionValues Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkProductOptionValue_In(array $fkProductOptionValues)
    {
        return $this->filterByFkProductOptionValue($fkProductOptionValues, Criteria::IN);
    }

    /**
     * Filter the query on the fk_product_option_value column
     *
     * Example usage:
     * <code>
     * $query->filterByFkProductOptionValue(1234); // WHERE fk_product_option_value = 1234
     * $query->filterByFkProductOptionValue(array(12, 34), Criteria::IN); // WHERE fk_product_option_value IN (12, 34)
     * $query->filterByFkProductOptionValue(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_product_option_value > 12
     * </code>
     *
     * @see       filterBySpyProductOptionValue()
     *
     * @param     mixed $fkProductOptionValue The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkProductOptionValue($fkProductOptionValue = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkProductOptionValue)) {
            $useMinMax = false;
            if (isset($fkProductOptionValue['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyShoppingListProductOptionTableMap::COL_FK_PRODUCT_OPTION_VALUE, $fkProductOptionValue['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkProductOptionValue['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyShoppingListProductOptionTableMap::COL_FK_PRODUCT_OPTION_VALUE, $fkProductOptionValue['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkProductOptionValue of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyShoppingListProductOptionTableMap::COL_FK_PRODUCT_OPTION_VALUE, $fkProductOptionValue, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkShoppingListItem Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkShoppingListItem_Between(array $fkShoppingListItem)
    {
        return $this->filterByFkShoppingListItem($fkShoppingListItem, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkShoppingListItems Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkShoppingListItem_In(array $fkShoppingListItems)
    {
        return $this->filterByFkShoppingListItem($fkShoppingListItems, Criteria::IN);
    }

    /**
     * Filter the query on the fk_shopping_list_item column
     *
     * Example usage:
     * <code>
     * $query->filterByFkShoppingListItem(1234); // WHERE fk_shopping_list_item = 1234
     * $query->filterByFkShoppingListItem(array(12, 34), Criteria::IN); // WHERE fk_shopping_list_item IN (12, 34)
     * $query->filterByFkShoppingListItem(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_shopping_list_item > 12
     * </code>
     *
     * @see       filterBySpyShoppingListItem()
     *
     * @param     mixed $fkShoppingListItem The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkShoppingListItem($fkShoppingListItem = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkShoppingListItem)) {
            $useMinMax = false;
            if (isset($fkShoppingListItem['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyShoppingListProductOptionTableMap::COL_FK_SHOPPING_LIST_ITEM, $fkShoppingListItem['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkShoppingListItem['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyShoppingListProductOptionTableMap::COL_FK_SHOPPING_LIST_ITEM, $fkShoppingListItem['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkShoppingListItem of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyShoppingListProductOptionTableMap::COL_FK_SHOPPING_LIST_ITEM, $fkShoppingListItem, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\ShoppingList\Persistence\SpyShoppingListItem object
     *
     * @param \Orm\Zed\ShoppingList\Persistence\SpyShoppingListItem|ObjectCollection $spyShoppingListItem The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyShoppingListItem($spyShoppingListItem, ?string $comparison = null)
    {
        if ($spyShoppingListItem instanceof \Orm\Zed\ShoppingList\Persistence\SpyShoppingListItem) {
            return $this
                ->addUsingAlias(SpyShoppingListProductOptionTableMap::COL_FK_SHOPPING_LIST_ITEM, $spyShoppingListItem->getIdShoppingListItem(), $comparison);
        } elseif ($spyShoppingListItem instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyShoppingListProductOptionTableMap::COL_FK_SHOPPING_LIST_ITEM, $spyShoppingListItem->toKeyValue('PrimaryKey', 'IdShoppingListItem'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyShoppingListItem() only accepts arguments of type \Orm\Zed\ShoppingList\Persistence\SpyShoppingListItem or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyShoppingListItem relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyShoppingListItem(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyShoppingListItem');

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
            $this->addJoinObject($join, 'SpyShoppingListItem');
        }

        return $this;
    }

    /**
     * Use the SpyShoppingListItem relation SpyShoppingListItem object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ShoppingList\Persistence\SpyShoppingListItemQuery A secondary query class using the current class as primary query
     */
    public function useSpyShoppingListItemQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyShoppingListItem($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyShoppingListItem', '\Orm\Zed\ShoppingList\Persistence\SpyShoppingListItemQuery');
    }

    /**
     * Use the SpyShoppingListItem relation SpyShoppingListItem object
     *
     * @param callable(\Orm\Zed\ShoppingList\Persistence\SpyShoppingListItemQuery):\Orm\Zed\ShoppingList\Persistence\SpyShoppingListItemQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyShoppingListItemQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyShoppingListItemQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyShoppingListItem table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ShoppingList\Persistence\SpyShoppingListItemQuery The inner query object of the EXISTS statement
     */
    public function useSpyShoppingListItemExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ShoppingList\Persistence\SpyShoppingListItemQuery */
        $q = $this->useExistsQuery('SpyShoppingListItem', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyShoppingListItem table for a NOT EXISTS query.
     *
     * @see useSpyShoppingListItemExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ShoppingList\Persistence\SpyShoppingListItemQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyShoppingListItemNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ShoppingList\Persistence\SpyShoppingListItemQuery */
        $q = $this->useExistsQuery('SpyShoppingListItem', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyShoppingListItem table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ShoppingList\Persistence\SpyShoppingListItemQuery The inner query object of the IN statement
     */
    public function useInSpyShoppingListItemQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ShoppingList\Persistence\SpyShoppingListItemQuery */
        $q = $this->useInQuery('SpyShoppingListItem', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyShoppingListItem table for a NOT IN query.
     *
     * @see useSpyShoppingListItemInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ShoppingList\Persistence\SpyShoppingListItemQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyShoppingListItemQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ShoppingList\Persistence\SpyShoppingListItemQuery */
        $q = $this->useInQuery('SpyShoppingListItem', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductOption\Persistence\SpyProductOptionValue object
     *
     * @param \Orm\Zed\ProductOption\Persistence\SpyProductOptionValue|ObjectCollection $spyProductOptionValue The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductOptionValue($spyProductOptionValue, ?string $comparison = null)
    {
        if ($spyProductOptionValue instanceof \Orm\Zed\ProductOption\Persistence\SpyProductOptionValue) {
            return $this
                ->addUsingAlias(SpyShoppingListProductOptionTableMap::COL_FK_PRODUCT_OPTION_VALUE, $spyProductOptionValue->getIdProductOptionValue(), $comparison);
        } elseif ($spyProductOptionValue instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyShoppingListProductOptionTableMap::COL_FK_PRODUCT_OPTION_VALUE, $spyProductOptionValue->toKeyValue('PrimaryKey', 'IdProductOptionValue'), $comparison);

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
     * Exclude object from result
     *
     * @param ChildSpyShoppingListProductOption $spyShoppingListProductOption Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyShoppingListProductOption = null)
    {
        if ($spyShoppingListProductOption) {
            $this->addUsingAlias(SpyShoppingListProductOptionTableMap::COL_ID_SHOPPING_LIST_ITEM_PRODUCT_OPTION, $spyShoppingListProductOption->getIdShoppingListItemProductOption(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_shopping_list_product_option table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyShoppingListProductOptionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyShoppingListProductOptionTableMap::clearInstancePool();
            SpyShoppingListProductOptionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyShoppingListProductOptionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyShoppingListProductOptionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyShoppingListProductOptionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyShoppingListProductOptionTableMap::clearRelatedInstancePool();

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
