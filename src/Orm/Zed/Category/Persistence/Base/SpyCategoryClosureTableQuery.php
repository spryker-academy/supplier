<?php

namespace Orm\Zed\Category\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\Category\Persistence\SpyCategoryClosureTable as ChildSpyCategoryClosureTable;
use Orm\Zed\Category\Persistence\SpyCategoryClosureTableQuery as ChildSpyCategoryClosureTableQuery;
use Orm\Zed\Category\Persistence\Map\SpyCategoryClosureTableTableMap;
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
 * Base class that represents a query for the `spy_category_closure_table` table.
 *
 * @method     ChildSpyCategoryClosureTableQuery orderByIdCategoryClosureTable($order = Criteria::ASC) Order by the id_category_closure_table column
 * @method     ChildSpyCategoryClosureTableQuery orderByFkCategoryNode($order = Criteria::ASC) Order by the fk_category_node column
 * @method     ChildSpyCategoryClosureTableQuery orderByFkCategoryNodeDescendant($order = Criteria::ASC) Order by the fk_category_node_descendant column
 * @method     ChildSpyCategoryClosureTableQuery orderByDepth($order = Criteria::ASC) Order by the depth column
 *
 * @method     ChildSpyCategoryClosureTableQuery groupByIdCategoryClosureTable() Group by the id_category_closure_table column
 * @method     ChildSpyCategoryClosureTableQuery groupByFkCategoryNode() Group by the fk_category_node column
 * @method     ChildSpyCategoryClosureTableQuery groupByFkCategoryNodeDescendant() Group by the fk_category_node_descendant column
 * @method     ChildSpyCategoryClosureTableQuery groupByDepth() Group by the depth column
 *
 * @method     ChildSpyCategoryClosureTableQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyCategoryClosureTableQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyCategoryClosureTableQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyCategoryClosureTableQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyCategoryClosureTableQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyCategoryClosureTableQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyCategoryClosureTableQuery leftJoinNode($relationAlias = null) Adds a LEFT JOIN clause to the query using the Node relation
 * @method     ChildSpyCategoryClosureTableQuery rightJoinNode($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Node relation
 * @method     ChildSpyCategoryClosureTableQuery innerJoinNode($relationAlias = null) Adds a INNER JOIN clause to the query using the Node relation
 *
 * @method     ChildSpyCategoryClosureTableQuery joinWithNode($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Node relation
 *
 * @method     ChildSpyCategoryClosureTableQuery leftJoinWithNode() Adds a LEFT JOIN clause and with to the query using the Node relation
 * @method     ChildSpyCategoryClosureTableQuery rightJoinWithNode() Adds a RIGHT JOIN clause and with to the query using the Node relation
 * @method     ChildSpyCategoryClosureTableQuery innerJoinWithNode() Adds a INNER JOIN clause and with to the query using the Node relation
 *
 * @method     ChildSpyCategoryClosureTableQuery leftJoinDescendantNode($relationAlias = null) Adds a LEFT JOIN clause to the query using the DescendantNode relation
 * @method     ChildSpyCategoryClosureTableQuery rightJoinDescendantNode($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DescendantNode relation
 * @method     ChildSpyCategoryClosureTableQuery innerJoinDescendantNode($relationAlias = null) Adds a INNER JOIN clause to the query using the DescendantNode relation
 *
 * @method     ChildSpyCategoryClosureTableQuery joinWithDescendantNode($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the DescendantNode relation
 *
 * @method     ChildSpyCategoryClosureTableQuery leftJoinWithDescendantNode() Adds a LEFT JOIN clause and with to the query using the DescendantNode relation
 * @method     ChildSpyCategoryClosureTableQuery rightJoinWithDescendantNode() Adds a RIGHT JOIN clause and with to the query using the DescendantNode relation
 * @method     ChildSpyCategoryClosureTableQuery innerJoinWithDescendantNode() Adds a INNER JOIN clause and with to the query using the DescendantNode relation
 *
 * @method     \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery|\Orm\Zed\Category\Persistence\SpyCategoryNodeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyCategoryClosureTable|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyCategoryClosureTable matching the query
 * @method     ChildSpyCategoryClosureTable findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyCategoryClosureTable matching the query, or a new ChildSpyCategoryClosureTable object populated from the query conditions when no match is found
 *
 * @method     ChildSpyCategoryClosureTable|null findOneByIdCategoryClosureTable(int $id_category_closure_table) Return the first ChildSpyCategoryClosureTable filtered by the id_category_closure_table column
 * @method     ChildSpyCategoryClosureTable|null findOneByFkCategoryNode(int $fk_category_node) Return the first ChildSpyCategoryClosureTable filtered by the fk_category_node column
 * @method     ChildSpyCategoryClosureTable|null findOneByFkCategoryNodeDescendant(int $fk_category_node_descendant) Return the first ChildSpyCategoryClosureTable filtered by the fk_category_node_descendant column
 * @method     ChildSpyCategoryClosureTable|null findOneByDepth(int $depth) Return the first ChildSpyCategoryClosureTable filtered by the depth column
 *
 * @method     ChildSpyCategoryClosureTable requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyCategoryClosureTable by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCategoryClosureTable requireOne(?ConnectionInterface $con = null) Return the first ChildSpyCategoryClosureTable matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyCategoryClosureTable requireOneByIdCategoryClosureTable(int $id_category_closure_table) Return the first ChildSpyCategoryClosureTable filtered by the id_category_closure_table column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCategoryClosureTable requireOneByFkCategoryNode(int $fk_category_node) Return the first ChildSpyCategoryClosureTable filtered by the fk_category_node column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCategoryClosureTable requireOneByFkCategoryNodeDescendant(int $fk_category_node_descendant) Return the first ChildSpyCategoryClosureTable filtered by the fk_category_node_descendant column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCategoryClosureTable requireOneByDepth(int $depth) Return the first ChildSpyCategoryClosureTable filtered by the depth column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyCategoryClosureTable[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyCategoryClosureTable objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyCategoryClosureTable> find(?ConnectionInterface $con = null) Return ChildSpyCategoryClosureTable objects based on current ModelCriteria
 *
 * @method     ChildSpyCategoryClosureTable[]|Collection findByIdCategoryClosureTable(int|array<int> $id_category_closure_table) Return ChildSpyCategoryClosureTable objects filtered by the id_category_closure_table column
 * @psalm-method Collection&\Traversable<ChildSpyCategoryClosureTable> findByIdCategoryClosureTable(int|array<int> $id_category_closure_table) Return ChildSpyCategoryClosureTable objects filtered by the id_category_closure_table column
 * @method     ChildSpyCategoryClosureTable[]|Collection findByFkCategoryNode(int|array<int> $fk_category_node) Return ChildSpyCategoryClosureTable objects filtered by the fk_category_node column
 * @psalm-method Collection&\Traversable<ChildSpyCategoryClosureTable> findByFkCategoryNode(int|array<int> $fk_category_node) Return ChildSpyCategoryClosureTable objects filtered by the fk_category_node column
 * @method     ChildSpyCategoryClosureTable[]|Collection findByFkCategoryNodeDescendant(int|array<int> $fk_category_node_descendant) Return ChildSpyCategoryClosureTable objects filtered by the fk_category_node_descendant column
 * @psalm-method Collection&\Traversable<ChildSpyCategoryClosureTable> findByFkCategoryNodeDescendant(int|array<int> $fk_category_node_descendant) Return ChildSpyCategoryClosureTable objects filtered by the fk_category_node_descendant column
 * @method     ChildSpyCategoryClosureTable[]|Collection findByDepth(int|array<int> $depth) Return ChildSpyCategoryClosureTable objects filtered by the depth column
 * @psalm-method Collection&\Traversable<ChildSpyCategoryClosureTable> findByDepth(int|array<int> $depth) Return ChildSpyCategoryClosureTable objects filtered by the depth column
 *
 * @method     ChildSpyCategoryClosureTable[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyCategoryClosureTable> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyCategoryClosureTableQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\Category\Persistence\Base\SpyCategoryClosureTableQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\Category\\Persistence\\SpyCategoryClosureTable', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyCategoryClosureTableQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyCategoryClosureTableQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyCategoryClosureTableQuery) {
            return $criteria;
        }
        $query = new ChildSpyCategoryClosureTableQuery();
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
     * @return ChildSpyCategoryClosureTable|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyCategoryClosureTableTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyCategoryClosureTable A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_category_closure_table, fk_category_node, fk_category_node_descendant, depth FROM spy_category_closure_table WHERE id_category_closure_table = :p0';
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
            /** @var ChildSpyCategoryClosureTable $obj */
            $obj = new ChildSpyCategoryClosureTable();
            $obj->hydrate($row);
            SpyCategoryClosureTableTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyCategoryClosureTable|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyCategoryClosureTableTableMap::COL_ID_CATEGORY_CLOSURE_TABLE, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyCategoryClosureTableTableMap::COL_ID_CATEGORY_CLOSURE_TABLE, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idCategoryClosureTable Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdCategoryClosureTable_Between(array $idCategoryClosureTable)
    {
        return $this->filterByIdCategoryClosureTable($idCategoryClosureTable, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idCategoryClosureTables Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdCategoryClosureTable_In(array $idCategoryClosureTables)
    {
        return $this->filterByIdCategoryClosureTable($idCategoryClosureTables, Criteria::IN);
    }

    /**
     * Filter the query on the id_category_closure_table column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCategoryClosureTable(1234); // WHERE id_category_closure_table = 1234
     * $query->filterByIdCategoryClosureTable(array(12, 34), Criteria::IN); // WHERE id_category_closure_table IN (12, 34)
     * $query->filterByIdCategoryClosureTable(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_category_closure_table > 12
     * </code>
     *
     * @param     mixed $idCategoryClosureTable The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdCategoryClosureTable($idCategoryClosureTable = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idCategoryClosureTable)) {
            $useMinMax = false;
            if (isset($idCategoryClosureTable['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCategoryClosureTableTableMap::COL_ID_CATEGORY_CLOSURE_TABLE, $idCategoryClosureTable['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCategoryClosureTable['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCategoryClosureTableTableMap::COL_ID_CATEGORY_CLOSURE_TABLE, $idCategoryClosureTable['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idCategoryClosureTable of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCategoryClosureTableTableMap::COL_ID_CATEGORY_CLOSURE_TABLE, $idCategoryClosureTable, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkCategoryNode Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCategoryNode_Between(array $fkCategoryNode)
    {
        return $this->filterByFkCategoryNode($fkCategoryNode, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkCategoryNodes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCategoryNode_In(array $fkCategoryNodes)
    {
        return $this->filterByFkCategoryNode($fkCategoryNodes, Criteria::IN);
    }

    /**
     * Filter the query on the fk_category_node column
     *
     * Example usage:
     * <code>
     * $query->filterByFkCategoryNode(1234); // WHERE fk_category_node = 1234
     * $query->filterByFkCategoryNode(array(12, 34), Criteria::IN); // WHERE fk_category_node IN (12, 34)
     * $query->filterByFkCategoryNode(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_category_node > 12
     * </code>
     *
     * @see       filterByNode()
     *
     * @param     mixed $fkCategoryNode The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkCategoryNode($fkCategoryNode = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkCategoryNode)) {
            $useMinMax = false;
            if (isset($fkCategoryNode['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCategoryClosureTableTableMap::COL_FK_CATEGORY_NODE, $fkCategoryNode['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkCategoryNode['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCategoryClosureTableTableMap::COL_FK_CATEGORY_NODE, $fkCategoryNode['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkCategoryNode of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCategoryClosureTableTableMap::COL_FK_CATEGORY_NODE, $fkCategoryNode, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkCategoryNodeDescendant Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCategoryNodeDescendant_Between(array $fkCategoryNodeDescendant)
    {
        return $this->filterByFkCategoryNodeDescendant($fkCategoryNodeDescendant, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkCategoryNodeDescendants Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCategoryNodeDescendant_In(array $fkCategoryNodeDescendants)
    {
        return $this->filterByFkCategoryNodeDescendant($fkCategoryNodeDescendants, Criteria::IN);
    }

    /**
     * Filter the query on the fk_category_node_descendant column
     *
     * Example usage:
     * <code>
     * $query->filterByFkCategoryNodeDescendant(1234); // WHERE fk_category_node_descendant = 1234
     * $query->filterByFkCategoryNodeDescendant(array(12, 34), Criteria::IN); // WHERE fk_category_node_descendant IN (12, 34)
     * $query->filterByFkCategoryNodeDescendant(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_category_node_descendant > 12
     * </code>
     *
     * @see       filterByDescendantNode()
     *
     * @param     mixed $fkCategoryNodeDescendant The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkCategoryNodeDescendant($fkCategoryNodeDescendant = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkCategoryNodeDescendant)) {
            $useMinMax = false;
            if (isset($fkCategoryNodeDescendant['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCategoryClosureTableTableMap::COL_FK_CATEGORY_NODE_DESCENDANT, $fkCategoryNodeDescendant['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkCategoryNodeDescendant['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCategoryClosureTableTableMap::COL_FK_CATEGORY_NODE_DESCENDANT, $fkCategoryNodeDescendant['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkCategoryNodeDescendant of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCategoryClosureTableTableMap::COL_FK_CATEGORY_NODE_DESCENDANT, $fkCategoryNodeDescendant, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $depth Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDepth_Between(array $depth)
    {
        return $this->filterByDepth($depth, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $depths Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDepth_In(array $depths)
    {
        return $this->filterByDepth($depths, Criteria::IN);
    }

    /**
     * Filter the query on the depth column
     *
     * Example usage:
     * <code>
     * $query->filterByDepth(1234); // WHERE depth = 1234
     * $query->filterByDepth(array(12, 34), Criteria::IN); // WHERE depth IN (12, 34)
     * $query->filterByDepth(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE depth > 12
     * </code>
     *
     * @param     mixed $depth The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByDepth($depth = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($depth)) {
            $useMinMax = false;
            if (isset($depth['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCategoryClosureTableTableMap::COL_DEPTH, $depth['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($depth['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCategoryClosureTableTableMap::COL_DEPTH, $depth['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$depth of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCategoryClosureTableTableMap::COL_DEPTH, $depth, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Category\Persistence\SpyCategoryNode object
     *
     * @param \Orm\Zed\Category\Persistence\SpyCategoryNode|ObjectCollection $spyCategoryNode The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNode($spyCategoryNode, ?string $comparison = null)
    {
        if ($spyCategoryNode instanceof \Orm\Zed\Category\Persistence\SpyCategoryNode) {
            return $this
                ->addUsingAlias(SpyCategoryClosureTableTableMap::COL_FK_CATEGORY_NODE, $spyCategoryNode->getIdCategoryNode(), $comparison);
        } elseif ($spyCategoryNode instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyCategoryClosureTableTableMap::COL_FK_CATEGORY_NODE, $spyCategoryNode->toKeyValue('PrimaryKey', 'IdCategoryNode'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByNode() only accepts arguments of type \Orm\Zed\Category\Persistence\SpyCategoryNode or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Node relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinNode(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Node');

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
            $this->addJoinObject($join, 'Node');
        }

        return $this;
    }

    /**
     * Use the Node relation SpyCategoryNode object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery A secondary query class using the current class as primary query
     */
    public function useNodeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinNode($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Node', '\Orm\Zed\Category\Persistence\SpyCategoryNodeQuery');
    }

    /**
     * Use the Node relation SpyCategoryNode object
     *
     * @param callable(\Orm\Zed\Category\Persistence\SpyCategoryNodeQuery):\Orm\Zed\Category\Persistence\SpyCategoryNodeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withNodeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useNodeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the Node relation to the SpyCategoryNode table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery The inner query object of the EXISTS statement
     */
    public function useNodeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery */
        $q = $this->useExistsQuery('Node', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the Node relation to the SpyCategoryNode table for a NOT EXISTS query.
     *
     * @see useNodeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery The inner query object of the NOT EXISTS statement
     */
    public function useNodeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery */
        $q = $this->useExistsQuery('Node', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the Node relation to the SpyCategoryNode table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery The inner query object of the IN statement
     */
    public function useInNodeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery */
        $q = $this->useInQuery('Node', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the Node relation to the SpyCategoryNode table for a NOT IN query.
     *
     * @see useNodeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery The inner query object of the NOT IN statement
     */
    public function useNotInNodeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery */
        $q = $this->useInQuery('Node', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Category\Persistence\SpyCategoryNode object
     *
     * @param \Orm\Zed\Category\Persistence\SpyCategoryNode|ObjectCollection $spyCategoryNode The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDescendantNode($spyCategoryNode, ?string $comparison = null)
    {
        if ($spyCategoryNode instanceof \Orm\Zed\Category\Persistence\SpyCategoryNode) {
            return $this
                ->addUsingAlias(SpyCategoryClosureTableTableMap::COL_FK_CATEGORY_NODE_DESCENDANT, $spyCategoryNode->getIdCategoryNode(), $comparison);
        } elseif ($spyCategoryNode instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyCategoryClosureTableTableMap::COL_FK_CATEGORY_NODE_DESCENDANT, $spyCategoryNode->toKeyValue('PrimaryKey', 'IdCategoryNode'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByDescendantNode() only accepts arguments of type \Orm\Zed\Category\Persistence\SpyCategoryNode or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the DescendantNode relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinDescendantNode(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('DescendantNode');

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
            $this->addJoinObject($join, 'DescendantNode');
        }

        return $this;
    }

    /**
     * Use the DescendantNode relation SpyCategoryNode object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery A secondary query class using the current class as primary query
     */
    public function useDescendantNodeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDescendantNode($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DescendantNode', '\Orm\Zed\Category\Persistence\SpyCategoryNodeQuery');
    }

    /**
     * Use the DescendantNode relation SpyCategoryNode object
     *
     * @param callable(\Orm\Zed\Category\Persistence\SpyCategoryNodeQuery):\Orm\Zed\Category\Persistence\SpyCategoryNodeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDescendantNodeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useDescendantNodeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the DescendantNode relation to the SpyCategoryNode table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery The inner query object of the EXISTS statement
     */
    public function useDescendantNodeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery */
        $q = $this->useExistsQuery('DescendantNode', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the DescendantNode relation to the SpyCategoryNode table for a NOT EXISTS query.
     *
     * @see useDescendantNodeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery The inner query object of the NOT EXISTS statement
     */
    public function useDescendantNodeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery */
        $q = $this->useExistsQuery('DescendantNode', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the DescendantNode relation to the SpyCategoryNode table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery The inner query object of the IN statement
     */
    public function useInDescendantNodeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery */
        $q = $this->useInQuery('DescendantNode', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the DescendantNode relation to the SpyCategoryNode table for a NOT IN query.
     *
     * @see useDescendantNodeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery The inner query object of the NOT IN statement
     */
    public function useNotInDescendantNodeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery */
        $q = $this->useInQuery('DescendantNode', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyCategoryClosureTable $spyCategoryClosureTable Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyCategoryClosureTable = null)
    {
        if ($spyCategoryClosureTable) {
            $this->addUsingAlias(SpyCategoryClosureTableTableMap::COL_ID_CATEGORY_CLOSURE_TABLE, $spyCategoryClosureTable->getIdCategoryClosureTable(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_category_closure_table table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCategoryClosureTableTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyCategoryClosureTableTableMap::clearInstancePool();
            SpyCategoryClosureTableTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCategoryClosureTableTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyCategoryClosureTableTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyCategoryClosureTableTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyCategoryClosureTableTableMap::clearRelatedInstancePool();

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
