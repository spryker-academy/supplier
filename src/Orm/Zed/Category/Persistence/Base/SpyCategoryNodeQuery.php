<?php

namespace Orm\Zed\Category\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\Category\Persistence\SpyCategoryNode as ChildSpyCategoryNode;
use Orm\Zed\Category\Persistence\SpyCategoryNodeQuery as ChildSpyCategoryNodeQuery;
use Orm\Zed\Category\Persistence\Map\SpyCategoryNodeTableMap;
use Orm\Zed\Url\Persistence\SpyUrl;
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
 * Base class that represents a query for the `spy_category_node` table.
 *
 * @method     ChildSpyCategoryNodeQuery orderByIdCategoryNode($order = Criteria::ASC) Order by the id_category_node column
 * @method     ChildSpyCategoryNodeQuery orderByFkCategory($order = Criteria::ASC) Order by the fk_category column
 * @method     ChildSpyCategoryNodeQuery orderByFkParentCategoryNode($order = Criteria::ASC) Order by the fk_parent_category_node column
 * @method     ChildSpyCategoryNodeQuery orderByIsMain($order = Criteria::ASC) Order by the is_main column
 * @method     ChildSpyCategoryNodeQuery orderByIsRoot($order = Criteria::ASC) Order by the is_root column
 * @method     ChildSpyCategoryNodeQuery orderByNodeOrder($order = Criteria::ASC) Order by the node_order column
 *
 * @method     ChildSpyCategoryNodeQuery groupByIdCategoryNode() Group by the id_category_node column
 * @method     ChildSpyCategoryNodeQuery groupByFkCategory() Group by the fk_category column
 * @method     ChildSpyCategoryNodeQuery groupByFkParentCategoryNode() Group by the fk_parent_category_node column
 * @method     ChildSpyCategoryNodeQuery groupByIsMain() Group by the is_main column
 * @method     ChildSpyCategoryNodeQuery groupByIsRoot() Group by the is_root column
 * @method     ChildSpyCategoryNodeQuery groupByNodeOrder() Group by the node_order column
 *
 * @method     ChildSpyCategoryNodeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyCategoryNodeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyCategoryNodeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyCategoryNodeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyCategoryNodeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyCategoryNodeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyCategoryNodeQuery leftJoinParentCategoryNode($relationAlias = null) Adds a LEFT JOIN clause to the query using the ParentCategoryNode relation
 * @method     ChildSpyCategoryNodeQuery rightJoinParentCategoryNode($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ParentCategoryNode relation
 * @method     ChildSpyCategoryNodeQuery innerJoinParentCategoryNode($relationAlias = null) Adds a INNER JOIN clause to the query using the ParentCategoryNode relation
 *
 * @method     ChildSpyCategoryNodeQuery joinWithParentCategoryNode($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ParentCategoryNode relation
 *
 * @method     ChildSpyCategoryNodeQuery leftJoinWithParentCategoryNode() Adds a LEFT JOIN clause and with to the query using the ParentCategoryNode relation
 * @method     ChildSpyCategoryNodeQuery rightJoinWithParentCategoryNode() Adds a RIGHT JOIN clause and with to the query using the ParentCategoryNode relation
 * @method     ChildSpyCategoryNodeQuery innerJoinWithParentCategoryNode() Adds a INNER JOIN clause and with to the query using the ParentCategoryNode relation
 *
 * @method     ChildSpyCategoryNodeQuery leftJoinCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the Category relation
 * @method     ChildSpyCategoryNodeQuery rightJoinCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Category relation
 * @method     ChildSpyCategoryNodeQuery innerJoinCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the Category relation
 *
 * @method     ChildSpyCategoryNodeQuery joinWithCategory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Category relation
 *
 * @method     ChildSpyCategoryNodeQuery leftJoinWithCategory() Adds a LEFT JOIN clause and with to the query using the Category relation
 * @method     ChildSpyCategoryNodeQuery rightJoinWithCategory() Adds a RIGHT JOIN clause and with to the query using the Category relation
 * @method     ChildSpyCategoryNodeQuery innerJoinWithCategory() Adds a INNER JOIN clause and with to the query using the Category relation
 *
 * @method     ChildSpyCategoryNodeQuery leftJoinNode($relationAlias = null) Adds a LEFT JOIN clause to the query using the Node relation
 * @method     ChildSpyCategoryNodeQuery rightJoinNode($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Node relation
 * @method     ChildSpyCategoryNodeQuery innerJoinNode($relationAlias = null) Adds a INNER JOIN clause to the query using the Node relation
 *
 * @method     ChildSpyCategoryNodeQuery joinWithNode($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Node relation
 *
 * @method     ChildSpyCategoryNodeQuery leftJoinWithNode() Adds a LEFT JOIN clause and with to the query using the Node relation
 * @method     ChildSpyCategoryNodeQuery rightJoinWithNode() Adds a RIGHT JOIN clause and with to the query using the Node relation
 * @method     ChildSpyCategoryNodeQuery innerJoinWithNode() Adds a INNER JOIN clause and with to the query using the Node relation
 *
 * @method     ChildSpyCategoryNodeQuery leftJoinClosureTable($relationAlias = null) Adds a LEFT JOIN clause to the query using the ClosureTable relation
 * @method     ChildSpyCategoryNodeQuery rightJoinClosureTable($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ClosureTable relation
 * @method     ChildSpyCategoryNodeQuery innerJoinClosureTable($relationAlias = null) Adds a INNER JOIN clause to the query using the ClosureTable relation
 *
 * @method     ChildSpyCategoryNodeQuery joinWithClosureTable($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ClosureTable relation
 *
 * @method     ChildSpyCategoryNodeQuery leftJoinWithClosureTable() Adds a LEFT JOIN clause and with to the query using the ClosureTable relation
 * @method     ChildSpyCategoryNodeQuery rightJoinWithClosureTable() Adds a RIGHT JOIN clause and with to the query using the ClosureTable relation
 * @method     ChildSpyCategoryNodeQuery innerJoinWithClosureTable() Adds a INNER JOIN clause and with to the query using the ClosureTable relation
 *
 * @method     ChildSpyCategoryNodeQuery leftJoinDescendant($relationAlias = null) Adds a LEFT JOIN clause to the query using the Descendant relation
 * @method     ChildSpyCategoryNodeQuery rightJoinDescendant($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Descendant relation
 * @method     ChildSpyCategoryNodeQuery innerJoinDescendant($relationAlias = null) Adds a INNER JOIN clause to the query using the Descendant relation
 *
 * @method     ChildSpyCategoryNodeQuery joinWithDescendant($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Descendant relation
 *
 * @method     ChildSpyCategoryNodeQuery leftJoinWithDescendant() Adds a LEFT JOIN clause and with to the query using the Descendant relation
 * @method     ChildSpyCategoryNodeQuery rightJoinWithDescendant() Adds a RIGHT JOIN clause and with to the query using the Descendant relation
 * @method     ChildSpyCategoryNodeQuery innerJoinWithDescendant() Adds a INNER JOIN clause and with to the query using the Descendant relation
 *
 * @method     ChildSpyCategoryNodeQuery leftJoinSpyUrl($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyUrl relation
 * @method     ChildSpyCategoryNodeQuery rightJoinSpyUrl($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyUrl relation
 * @method     ChildSpyCategoryNodeQuery innerJoinSpyUrl($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyUrl relation
 *
 * @method     ChildSpyCategoryNodeQuery joinWithSpyUrl($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyUrl relation
 *
 * @method     ChildSpyCategoryNodeQuery leftJoinWithSpyUrl() Adds a LEFT JOIN clause and with to the query using the SpyUrl relation
 * @method     ChildSpyCategoryNodeQuery rightJoinWithSpyUrl() Adds a RIGHT JOIN clause and with to the query using the SpyUrl relation
 * @method     ChildSpyCategoryNodeQuery innerJoinWithSpyUrl() Adds a INNER JOIN clause and with to the query using the SpyUrl relation
 *
 * @method     \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery|\Orm\Zed\Category\Persistence\SpyCategoryQuery|\Orm\Zed\Category\Persistence\SpyCategoryNodeQuery|\Orm\Zed\Category\Persistence\SpyCategoryClosureTableQuery|\Orm\Zed\Category\Persistence\SpyCategoryClosureTableQuery|\Orm\Zed\Url\Persistence\SpyUrlQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyCategoryNode|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyCategoryNode matching the query
 * @method     ChildSpyCategoryNode findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyCategoryNode matching the query, or a new ChildSpyCategoryNode object populated from the query conditions when no match is found
 *
 * @method     ChildSpyCategoryNode|null findOneByIdCategoryNode(int $id_category_node) Return the first ChildSpyCategoryNode filtered by the id_category_node column
 * @method     ChildSpyCategoryNode|null findOneByFkCategory(int $fk_category) Return the first ChildSpyCategoryNode filtered by the fk_category column
 * @method     ChildSpyCategoryNode|null findOneByFkParentCategoryNode(int $fk_parent_category_node) Return the first ChildSpyCategoryNode filtered by the fk_parent_category_node column
 * @method     ChildSpyCategoryNode|null findOneByIsMain(boolean $is_main) Return the first ChildSpyCategoryNode filtered by the is_main column
 * @method     ChildSpyCategoryNode|null findOneByIsRoot(boolean $is_root) Return the first ChildSpyCategoryNode filtered by the is_root column
 * @method     ChildSpyCategoryNode|null findOneByNodeOrder(int $node_order) Return the first ChildSpyCategoryNode filtered by the node_order column
 *
 * @method     ChildSpyCategoryNode requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyCategoryNode by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCategoryNode requireOne(?ConnectionInterface $con = null) Return the first ChildSpyCategoryNode matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyCategoryNode requireOneByIdCategoryNode(int $id_category_node) Return the first ChildSpyCategoryNode filtered by the id_category_node column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCategoryNode requireOneByFkCategory(int $fk_category) Return the first ChildSpyCategoryNode filtered by the fk_category column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCategoryNode requireOneByFkParentCategoryNode(int $fk_parent_category_node) Return the first ChildSpyCategoryNode filtered by the fk_parent_category_node column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCategoryNode requireOneByIsMain(boolean $is_main) Return the first ChildSpyCategoryNode filtered by the is_main column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCategoryNode requireOneByIsRoot(boolean $is_root) Return the first ChildSpyCategoryNode filtered by the is_root column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCategoryNode requireOneByNodeOrder(int $node_order) Return the first ChildSpyCategoryNode filtered by the node_order column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyCategoryNode[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyCategoryNode objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyCategoryNode> find(?ConnectionInterface $con = null) Return ChildSpyCategoryNode objects based on current ModelCriteria
 *
 * @method     ChildSpyCategoryNode[]|Collection findByIdCategoryNode(int|array<int> $id_category_node) Return ChildSpyCategoryNode objects filtered by the id_category_node column
 * @psalm-method Collection&\Traversable<ChildSpyCategoryNode> findByIdCategoryNode(int|array<int> $id_category_node) Return ChildSpyCategoryNode objects filtered by the id_category_node column
 * @method     ChildSpyCategoryNode[]|Collection findByFkCategory(int|array<int> $fk_category) Return ChildSpyCategoryNode objects filtered by the fk_category column
 * @psalm-method Collection&\Traversable<ChildSpyCategoryNode> findByFkCategory(int|array<int> $fk_category) Return ChildSpyCategoryNode objects filtered by the fk_category column
 * @method     ChildSpyCategoryNode[]|Collection findByFkParentCategoryNode(int|array<int> $fk_parent_category_node) Return ChildSpyCategoryNode objects filtered by the fk_parent_category_node column
 * @psalm-method Collection&\Traversable<ChildSpyCategoryNode> findByFkParentCategoryNode(int|array<int> $fk_parent_category_node) Return ChildSpyCategoryNode objects filtered by the fk_parent_category_node column
 * @method     ChildSpyCategoryNode[]|Collection findByIsMain(boolean|array<boolean> $is_main) Return ChildSpyCategoryNode objects filtered by the is_main column
 * @psalm-method Collection&\Traversable<ChildSpyCategoryNode> findByIsMain(boolean|array<boolean> $is_main) Return ChildSpyCategoryNode objects filtered by the is_main column
 * @method     ChildSpyCategoryNode[]|Collection findByIsRoot(boolean|array<boolean> $is_root) Return ChildSpyCategoryNode objects filtered by the is_root column
 * @psalm-method Collection&\Traversable<ChildSpyCategoryNode> findByIsRoot(boolean|array<boolean> $is_root) Return ChildSpyCategoryNode objects filtered by the is_root column
 * @method     ChildSpyCategoryNode[]|Collection findByNodeOrder(int|array<int> $node_order) Return ChildSpyCategoryNode objects filtered by the node_order column
 * @psalm-method Collection&\Traversable<ChildSpyCategoryNode> findByNodeOrder(int|array<int> $node_order) Return ChildSpyCategoryNode objects filtered by the node_order column
 *
 * @method     ChildSpyCategoryNode[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyCategoryNode> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyCategoryNodeQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\Category\Persistence\Base\SpyCategoryNodeQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\Category\\Persistence\\SpyCategoryNode', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyCategoryNodeQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyCategoryNodeQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyCategoryNodeQuery) {
            return $criteria;
        }
        $query = new ChildSpyCategoryNodeQuery();
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
     * @return ChildSpyCategoryNode|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyCategoryNodeTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyCategoryNode A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_category_node, fk_category, fk_parent_category_node, is_main, is_root, node_order FROM spy_category_node WHERE id_category_node = :p0';
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
            /** @var ChildSpyCategoryNode $obj */
            $obj = new ChildSpyCategoryNode();
            $obj->hydrate($row);
            SpyCategoryNodeTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyCategoryNode|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyCategoryNodeTableMap::COL_ID_CATEGORY_NODE, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyCategoryNodeTableMap::COL_ID_CATEGORY_NODE, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idCategoryNode Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdCategoryNode_Between(array $idCategoryNode)
    {
        return $this->filterByIdCategoryNode($idCategoryNode, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idCategoryNodes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdCategoryNode_In(array $idCategoryNodes)
    {
        return $this->filterByIdCategoryNode($idCategoryNodes, Criteria::IN);
    }

    /**
     * Filter the query on the id_category_node column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCategoryNode(1234); // WHERE id_category_node = 1234
     * $query->filterByIdCategoryNode(array(12, 34), Criteria::IN); // WHERE id_category_node IN (12, 34)
     * $query->filterByIdCategoryNode(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_category_node > 12
     * </code>
     *
     * @param     mixed $idCategoryNode The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdCategoryNode($idCategoryNode = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idCategoryNode)) {
            $useMinMax = false;
            if (isset($idCategoryNode['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCategoryNodeTableMap::COL_ID_CATEGORY_NODE, $idCategoryNode['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCategoryNode['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCategoryNodeTableMap::COL_ID_CATEGORY_NODE, $idCategoryNode['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idCategoryNode of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCategoryNodeTableMap::COL_ID_CATEGORY_NODE, $idCategoryNode, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkCategory Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCategory_Between(array $fkCategory)
    {
        return $this->filterByFkCategory($fkCategory, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkCategorys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCategory_In(array $fkCategorys)
    {
        return $this->filterByFkCategory($fkCategorys, Criteria::IN);
    }

    /**
     * Filter the query on the fk_category column
     *
     * Example usage:
     * <code>
     * $query->filterByFkCategory(1234); // WHERE fk_category = 1234
     * $query->filterByFkCategory(array(12, 34), Criteria::IN); // WHERE fk_category IN (12, 34)
     * $query->filterByFkCategory(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_category > 12
     * </code>
     *
     * @see       filterByCategory()
     *
     * @param     mixed $fkCategory The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkCategory($fkCategory = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkCategory)) {
            $useMinMax = false;
            if (isset($fkCategory['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCategoryNodeTableMap::COL_FK_CATEGORY, $fkCategory['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkCategory['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCategoryNodeTableMap::COL_FK_CATEGORY, $fkCategory['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkCategory of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCategoryNodeTableMap::COL_FK_CATEGORY, $fkCategory, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkParentCategoryNode Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkParentCategoryNode_Between(array $fkParentCategoryNode)
    {
        return $this->filterByFkParentCategoryNode($fkParentCategoryNode, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkParentCategoryNodes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkParentCategoryNode_In(array $fkParentCategoryNodes)
    {
        return $this->filterByFkParentCategoryNode($fkParentCategoryNodes, Criteria::IN);
    }

    /**
     * Filter the query on the fk_parent_category_node column
     *
     * Example usage:
     * <code>
     * $query->filterByFkParentCategoryNode(1234); // WHERE fk_parent_category_node = 1234
     * $query->filterByFkParentCategoryNode(array(12, 34), Criteria::IN); // WHERE fk_parent_category_node IN (12, 34)
     * $query->filterByFkParentCategoryNode(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_parent_category_node > 12
     * </code>
     *
     * @see       filterByParentCategoryNode()
     *
     * @param     mixed $fkParentCategoryNode The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkParentCategoryNode($fkParentCategoryNode = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkParentCategoryNode)) {
            $useMinMax = false;
            if (isset($fkParentCategoryNode['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCategoryNodeTableMap::COL_FK_PARENT_CATEGORY_NODE, $fkParentCategoryNode['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkParentCategoryNode['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCategoryNodeTableMap::COL_FK_PARENT_CATEGORY_NODE, $fkParentCategoryNode['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkParentCategoryNode of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCategoryNodeTableMap::COL_FK_PARENT_CATEGORY_NODE, $fkParentCategoryNode, $comparison);

        return $query;
    }

    /**
     * Filter the query on the is_main column
     *
     * Example usage:
     * <code>
     * $query->filterByIsMain(true); // WHERE is_main = true
     * $query->filterByIsMain('yes'); // WHERE is_main = true
     * </code>
     *
     * @param     bool|string $isMain The value to use as filter.
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
    public function filterByIsMain($isMain = null, $comparison = Criteria::EQUAL)
    {
        if (is_string($isMain)) {
            $isMain = in_array(strtolower($isMain), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $query = $this->addUsingAlias(SpyCategoryNodeTableMap::COL_IS_MAIN, $isMain, $comparison);

        return $query;
    }

    /**
     * Filter the query on the is_root column
     *
     * Example usage:
     * <code>
     * $query->filterByIsRoot(true); // WHERE is_root = true
     * $query->filterByIsRoot('yes'); // WHERE is_root = true
     * </code>
     *
     * @param     bool|string $isRoot The value to use as filter.
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
    public function filterByIsRoot($isRoot = null, $comparison = Criteria::EQUAL)
    {
        if (is_string($isRoot)) {
            $isRoot = in_array(strtolower($isRoot), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $query = $this->addUsingAlias(SpyCategoryNodeTableMap::COL_IS_ROOT, $isRoot, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $nodeOrder Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNodeOrder_Between(array $nodeOrder)
    {
        return $this->filterByNodeOrder($nodeOrder, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $nodeOrders Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNodeOrder_In(array $nodeOrders)
    {
        return $this->filterByNodeOrder($nodeOrders, Criteria::IN);
    }

    /**
     * Filter the query on the node_order column
     *
     * Example usage:
     * <code>
     * $query->filterByNodeOrder(1234); // WHERE node_order = 1234
     * $query->filterByNodeOrder(array(12, 34), Criteria::IN); // WHERE node_order IN (12, 34)
     * $query->filterByNodeOrder(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE node_order > 12
     * </code>
     *
     * @param     mixed $nodeOrder The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByNodeOrder($nodeOrder = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($nodeOrder)) {
            $useMinMax = false;
            if (isset($nodeOrder['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCategoryNodeTableMap::COL_NODE_ORDER, $nodeOrder['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nodeOrder['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCategoryNodeTableMap::COL_NODE_ORDER, $nodeOrder['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$nodeOrder of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCategoryNodeTableMap::COL_NODE_ORDER, $nodeOrder, $comparison);

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
    public function filterByParentCategoryNode($spyCategoryNode, ?string $comparison = null)
    {
        if ($spyCategoryNode instanceof \Orm\Zed\Category\Persistence\SpyCategoryNode) {
            return $this
                ->addUsingAlias(SpyCategoryNodeTableMap::COL_FK_PARENT_CATEGORY_NODE, $spyCategoryNode->getIdCategoryNode(), $comparison);
        } elseif ($spyCategoryNode instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyCategoryNodeTableMap::COL_FK_PARENT_CATEGORY_NODE, $spyCategoryNode->toKeyValue('PrimaryKey', 'IdCategoryNode'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByParentCategoryNode() only accepts arguments of type \Orm\Zed\Category\Persistence\SpyCategoryNode or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ParentCategoryNode relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinParentCategoryNode(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ParentCategoryNode');

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
            $this->addJoinObject($join, 'ParentCategoryNode');
        }

        return $this;
    }

    /**
     * Use the ParentCategoryNode relation SpyCategoryNode object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery A secondary query class using the current class as primary query
     */
    public function useParentCategoryNodeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinParentCategoryNode($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ParentCategoryNode', '\Orm\Zed\Category\Persistence\SpyCategoryNodeQuery');
    }

    /**
     * Use the ParentCategoryNode relation SpyCategoryNode object
     *
     * @param callable(\Orm\Zed\Category\Persistence\SpyCategoryNodeQuery):\Orm\Zed\Category\Persistence\SpyCategoryNodeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withParentCategoryNodeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useParentCategoryNodeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ParentCategoryNode relation to the SpyCategoryNode table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery The inner query object of the EXISTS statement
     */
    public function useParentCategoryNodeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery */
        $q = $this->useExistsQuery('ParentCategoryNode', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ParentCategoryNode relation to the SpyCategoryNode table for a NOT EXISTS query.
     *
     * @see useParentCategoryNodeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery The inner query object of the NOT EXISTS statement
     */
    public function useParentCategoryNodeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery */
        $q = $this->useExistsQuery('ParentCategoryNode', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ParentCategoryNode relation to the SpyCategoryNode table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery The inner query object of the IN statement
     */
    public function useInParentCategoryNodeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery */
        $q = $this->useInQuery('ParentCategoryNode', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ParentCategoryNode relation to the SpyCategoryNode table for a NOT IN query.
     *
     * @see useParentCategoryNodeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery The inner query object of the NOT IN statement
     */
    public function useNotInParentCategoryNodeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery */
        $q = $this->useInQuery('ParentCategoryNode', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Category\Persistence\SpyCategory object
     *
     * @param \Orm\Zed\Category\Persistence\SpyCategory|ObjectCollection $spyCategory The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCategory($spyCategory, ?string $comparison = null)
    {
        if ($spyCategory instanceof \Orm\Zed\Category\Persistence\SpyCategory) {
            return $this
                ->addUsingAlias(SpyCategoryNodeTableMap::COL_FK_CATEGORY, $spyCategory->getIdCategory(), $comparison);
        } elseif ($spyCategory instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyCategoryNodeTableMap::COL_FK_CATEGORY, $spyCategory->toKeyValue('PrimaryKey', 'IdCategory'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCategory() only accepts arguments of type \Orm\Zed\Category\Persistence\SpyCategory or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Category relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCategory(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Category');

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
            $this->addJoinObject($join, 'Category');
        }

        return $this;
    }

    /**
     * Use the Category relation SpyCategory object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryQuery A secondary query class using the current class as primary query
     */
    public function useCategoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCategory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Category', '\Orm\Zed\Category\Persistence\SpyCategoryQuery');
    }

    /**
     * Use the Category relation SpyCategory object
     *
     * @param callable(\Orm\Zed\Category\Persistence\SpyCategoryQuery):\Orm\Zed\Category\Persistence\SpyCategoryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCategoryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCategoryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the Category relation to the SpyCategory table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryQuery The inner query object of the EXISTS statement
     */
    public function useCategoryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryQuery */
        $q = $this->useExistsQuery('Category', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the Category relation to the SpyCategory table for a NOT EXISTS query.
     *
     * @see useCategoryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryQuery The inner query object of the NOT EXISTS statement
     */
    public function useCategoryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryQuery */
        $q = $this->useExistsQuery('Category', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the Category relation to the SpyCategory table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryQuery The inner query object of the IN statement
     */
    public function useInCategoryQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryQuery */
        $q = $this->useInQuery('Category', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the Category relation to the SpyCategory table for a NOT IN query.
     *
     * @see useCategoryInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryQuery The inner query object of the NOT IN statement
     */
    public function useNotInCategoryQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryQuery */
        $q = $this->useInQuery('Category', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Category\Persistence\SpyCategoryNode object
     *
     * @param \Orm\Zed\Category\Persistence\SpyCategoryNode|ObjectCollection $spyCategoryNode the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNode($spyCategoryNode, ?string $comparison = null)
    {
        if ($spyCategoryNode instanceof \Orm\Zed\Category\Persistence\SpyCategoryNode) {
            $this
                ->addUsingAlias(SpyCategoryNodeTableMap::COL_ID_CATEGORY_NODE, $spyCategoryNode->getFkParentCategoryNode(), $comparison);

            return $this;
        } elseif ($spyCategoryNode instanceof ObjectCollection) {
            $this
                ->useNodeQuery()
                ->filterByPrimaryKeys($spyCategoryNode->getPrimaryKeys())
                ->endUse();

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
    public function joinNode(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useNodeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
     * Filter the query by a related \Orm\Zed\Category\Persistence\SpyCategoryClosureTable object
     *
     * @param \Orm\Zed\Category\Persistence\SpyCategoryClosureTable|ObjectCollection $spyCategoryClosureTable the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByClosureTable($spyCategoryClosureTable, ?string $comparison = null)
    {
        if ($spyCategoryClosureTable instanceof \Orm\Zed\Category\Persistence\SpyCategoryClosureTable) {
            $this
                ->addUsingAlias(SpyCategoryNodeTableMap::COL_ID_CATEGORY_NODE, $spyCategoryClosureTable->getFkCategoryNode(), $comparison);

            return $this;
        } elseif ($spyCategoryClosureTable instanceof ObjectCollection) {
            $this
                ->useClosureTableQuery()
                ->filterByPrimaryKeys($spyCategoryClosureTable->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByClosureTable() only accepts arguments of type \Orm\Zed\Category\Persistence\SpyCategoryClosureTable or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ClosureTable relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinClosureTable(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ClosureTable');

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
            $this->addJoinObject($join, 'ClosureTable');
        }

        return $this;
    }

    /**
     * Use the ClosureTable relation SpyCategoryClosureTable object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryClosureTableQuery A secondary query class using the current class as primary query
     */
    public function useClosureTableQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinClosureTable($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ClosureTable', '\Orm\Zed\Category\Persistence\SpyCategoryClosureTableQuery');
    }

    /**
     * Use the ClosureTable relation SpyCategoryClosureTable object
     *
     * @param callable(\Orm\Zed\Category\Persistence\SpyCategoryClosureTableQuery):\Orm\Zed\Category\Persistence\SpyCategoryClosureTableQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withClosureTableQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useClosureTableQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ClosureTable relation to the SpyCategoryClosureTable table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryClosureTableQuery The inner query object of the EXISTS statement
     */
    public function useClosureTableExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryClosureTableQuery */
        $q = $this->useExistsQuery('ClosureTable', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ClosureTable relation to the SpyCategoryClosureTable table for a NOT EXISTS query.
     *
     * @see useClosureTableExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryClosureTableQuery The inner query object of the NOT EXISTS statement
     */
    public function useClosureTableNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryClosureTableQuery */
        $q = $this->useExistsQuery('ClosureTable', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ClosureTable relation to the SpyCategoryClosureTable table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryClosureTableQuery The inner query object of the IN statement
     */
    public function useInClosureTableQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryClosureTableQuery */
        $q = $this->useInQuery('ClosureTable', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ClosureTable relation to the SpyCategoryClosureTable table for a NOT IN query.
     *
     * @see useClosureTableInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryClosureTableQuery The inner query object of the NOT IN statement
     */
    public function useNotInClosureTableQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryClosureTableQuery */
        $q = $this->useInQuery('ClosureTable', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Category\Persistence\SpyCategoryClosureTable object
     *
     * @param \Orm\Zed\Category\Persistence\SpyCategoryClosureTable|ObjectCollection $spyCategoryClosureTable the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDescendant($spyCategoryClosureTable, ?string $comparison = null)
    {
        if ($spyCategoryClosureTable instanceof \Orm\Zed\Category\Persistence\SpyCategoryClosureTable) {
            $this
                ->addUsingAlias(SpyCategoryNodeTableMap::COL_ID_CATEGORY_NODE, $spyCategoryClosureTable->getFkCategoryNodeDescendant(), $comparison);

            return $this;
        } elseif ($spyCategoryClosureTable instanceof ObjectCollection) {
            $this
                ->useDescendantQuery()
                ->filterByPrimaryKeys($spyCategoryClosureTable->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByDescendant() only accepts arguments of type \Orm\Zed\Category\Persistence\SpyCategoryClosureTable or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Descendant relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinDescendant(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Descendant');

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
            $this->addJoinObject($join, 'Descendant');
        }

        return $this;
    }

    /**
     * Use the Descendant relation SpyCategoryClosureTable object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryClosureTableQuery A secondary query class using the current class as primary query
     */
    public function useDescendantQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDescendant($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Descendant', '\Orm\Zed\Category\Persistence\SpyCategoryClosureTableQuery');
    }

    /**
     * Use the Descendant relation SpyCategoryClosureTable object
     *
     * @param callable(\Orm\Zed\Category\Persistence\SpyCategoryClosureTableQuery):\Orm\Zed\Category\Persistence\SpyCategoryClosureTableQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDescendantQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useDescendantQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the Descendant relation to the SpyCategoryClosureTable table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryClosureTableQuery The inner query object of the EXISTS statement
     */
    public function useDescendantExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryClosureTableQuery */
        $q = $this->useExistsQuery('Descendant', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the Descendant relation to the SpyCategoryClosureTable table for a NOT EXISTS query.
     *
     * @see useDescendantExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryClosureTableQuery The inner query object of the NOT EXISTS statement
     */
    public function useDescendantNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryClosureTableQuery */
        $q = $this->useExistsQuery('Descendant', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the Descendant relation to the SpyCategoryClosureTable table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryClosureTableQuery The inner query object of the IN statement
     */
    public function useInDescendantQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryClosureTableQuery */
        $q = $this->useInQuery('Descendant', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the Descendant relation to the SpyCategoryClosureTable table for a NOT IN query.
     *
     * @see useDescendantInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryClosureTableQuery The inner query object of the NOT IN statement
     */
    public function useNotInDescendantQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryClosureTableQuery */
        $q = $this->useInQuery('Descendant', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Url\Persistence\SpyUrl object
     *
     * @param \Orm\Zed\Url\Persistence\SpyUrl|ObjectCollection $spyUrl the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyUrl($spyUrl, ?string $comparison = null)
    {
        if ($spyUrl instanceof \Orm\Zed\Url\Persistence\SpyUrl) {
            $this
                ->addUsingAlias(SpyCategoryNodeTableMap::COL_ID_CATEGORY_NODE, $spyUrl->getFkResourceCategorynode(), $comparison);

            return $this;
        } elseif ($spyUrl instanceof ObjectCollection) {
            $this
                ->useSpyUrlQuery()
                ->filterByPrimaryKeys($spyUrl->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyUrl() only accepts arguments of type \Orm\Zed\Url\Persistence\SpyUrl or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyUrl relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyUrl(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyUrl');

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
            $this->addJoinObject($join, 'SpyUrl');
        }

        return $this;
    }

    /**
     * Use the SpyUrl relation SpyUrl object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Url\Persistence\SpyUrlQuery A secondary query class using the current class as primary query
     */
    public function useSpyUrlQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpyUrl($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyUrl', '\Orm\Zed\Url\Persistence\SpyUrlQuery');
    }

    /**
     * Use the SpyUrl relation SpyUrl object
     *
     * @param callable(\Orm\Zed\Url\Persistence\SpyUrlQuery):\Orm\Zed\Url\Persistence\SpyUrlQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyUrlQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpyUrlQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyUrl table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Url\Persistence\SpyUrlQuery The inner query object of the EXISTS statement
     */
    public function useSpyUrlExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Url\Persistence\SpyUrlQuery */
        $q = $this->useExistsQuery('SpyUrl', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyUrl table for a NOT EXISTS query.
     *
     * @see useSpyUrlExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Url\Persistence\SpyUrlQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyUrlNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Url\Persistence\SpyUrlQuery */
        $q = $this->useExistsQuery('SpyUrl', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyUrl table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Url\Persistence\SpyUrlQuery The inner query object of the IN statement
     */
    public function useInSpyUrlQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Url\Persistence\SpyUrlQuery */
        $q = $this->useInQuery('SpyUrl', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyUrl table for a NOT IN query.
     *
     * @see useSpyUrlInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Url\Persistence\SpyUrlQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyUrlQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Url\Persistence\SpyUrlQuery */
        $q = $this->useInQuery('SpyUrl', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyCategoryNode $spyCategoryNode Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyCategoryNode = null)
    {
        if ($spyCategoryNode) {
            $this->addUsingAlias(SpyCategoryNodeTableMap::COL_ID_CATEGORY_NODE, $spyCategoryNode->getIdCategoryNode(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_category_node table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCategoryNodeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyCategoryNodeTableMap::clearInstancePool();
            SpyCategoryNodeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCategoryNodeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyCategoryNodeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyCategoryNodeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyCategoryNodeTableMap::clearRelatedInstancePool();

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
