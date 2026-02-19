<?php

namespace Orm\Zed\Navigation\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\Navigation\Persistence\SpyNavigationNode as ChildSpyNavigationNode;
use Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery as ChildSpyNavigationNodeQuery;
use Orm\Zed\Navigation\Persistence\Map\SpyNavigationNodeTableMap;
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
 * Base class that represents a query for the `spy_navigation_node` table.
 *
 * @method     ChildSpyNavigationNodeQuery orderByIdNavigationNode($order = Criteria::ASC) Order by the id_navigation_node column
 * @method     ChildSpyNavigationNodeQuery orderByFkNavigation($order = Criteria::ASC) Order by the fk_navigation column
 * @method     ChildSpyNavigationNodeQuery orderByFkParentNavigationNode($order = Criteria::ASC) Order by the fk_parent_navigation_node column
 * @method     ChildSpyNavigationNodeQuery orderByIsActive($order = Criteria::ASC) Order by the is_active column
 * @method     ChildSpyNavigationNodeQuery orderByNodeKey($order = Criteria::ASC) Order by the node_key column
 * @method     ChildSpyNavigationNodeQuery orderByNodeType($order = Criteria::ASC) Order by the node_type column
 * @method     ChildSpyNavigationNodeQuery orderByPosition($order = Criteria::ASC) Order by the position column
 * @method     ChildSpyNavigationNodeQuery orderByValidFrom($order = Criteria::ASC) Order by the valid_from column
 * @method     ChildSpyNavigationNodeQuery orderByValidTo($order = Criteria::ASC) Order by the valid_to column
 *
 * @method     ChildSpyNavigationNodeQuery groupByIdNavigationNode() Group by the id_navigation_node column
 * @method     ChildSpyNavigationNodeQuery groupByFkNavigation() Group by the fk_navigation column
 * @method     ChildSpyNavigationNodeQuery groupByFkParentNavigationNode() Group by the fk_parent_navigation_node column
 * @method     ChildSpyNavigationNodeQuery groupByIsActive() Group by the is_active column
 * @method     ChildSpyNavigationNodeQuery groupByNodeKey() Group by the node_key column
 * @method     ChildSpyNavigationNodeQuery groupByNodeType() Group by the node_type column
 * @method     ChildSpyNavigationNodeQuery groupByPosition() Group by the position column
 * @method     ChildSpyNavigationNodeQuery groupByValidFrom() Group by the valid_from column
 * @method     ChildSpyNavigationNodeQuery groupByValidTo() Group by the valid_to column
 *
 * @method     ChildSpyNavigationNodeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyNavigationNodeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyNavigationNodeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyNavigationNodeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyNavigationNodeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyNavigationNodeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyNavigationNodeQuery leftJoinParentNavigationNode($relationAlias = null) Adds a LEFT JOIN clause to the query using the ParentNavigationNode relation
 * @method     ChildSpyNavigationNodeQuery rightJoinParentNavigationNode($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ParentNavigationNode relation
 * @method     ChildSpyNavigationNodeQuery innerJoinParentNavigationNode($relationAlias = null) Adds a INNER JOIN clause to the query using the ParentNavigationNode relation
 *
 * @method     ChildSpyNavigationNodeQuery joinWithParentNavigationNode($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ParentNavigationNode relation
 *
 * @method     ChildSpyNavigationNodeQuery leftJoinWithParentNavigationNode() Adds a LEFT JOIN clause and with to the query using the ParentNavigationNode relation
 * @method     ChildSpyNavigationNodeQuery rightJoinWithParentNavigationNode() Adds a RIGHT JOIN clause and with to the query using the ParentNavigationNode relation
 * @method     ChildSpyNavigationNodeQuery innerJoinWithParentNavigationNode() Adds a INNER JOIN clause and with to the query using the ParentNavigationNode relation
 *
 * @method     ChildSpyNavigationNodeQuery leftJoinSpyNavigation($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyNavigation relation
 * @method     ChildSpyNavigationNodeQuery rightJoinSpyNavigation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyNavigation relation
 * @method     ChildSpyNavigationNodeQuery innerJoinSpyNavigation($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyNavigation relation
 *
 * @method     ChildSpyNavigationNodeQuery joinWithSpyNavigation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyNavigation relation
 *
 * @method     ChildSpyNavigationNodeQuery leftJoinWithSpyNavigation() Adds a LEFT JOIN clause and with to the query using the SpyNavigation relation
 * @method     ChildSpyNavigationNodeQuery rightJoinWithSpyNavigation() Adds a RIGHT JOIN clause and with to the query using the SpyNavigation relation
 * @method     ChildSpyNavigationNodeQuery innerJoinWithSpyNavigation() Adds a INNER JOIN clause and with to the query using the SpyNavigation relation
 *
 * @method     ChildSpyNavigationNodeQuery leftJoinChildrenNavigationNode($relationAlias = null) Adds a LEFT JOIN clause to the query using the ChildrenNavigationNode relation
 * @method     ChildSpyNavigationNodeQuery rightJoinChildrenNavigationNode($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ChildrenNavigationNode relation
 * @method     ChildSpyNavigationNodeQuery innerJoinChildrenNavigationNode($relationAlias = null) Adds a INNER JOIN clause to the query using the ChildrenNavigationNode relation
 *
 * @method     ChildSpyNavigationNodeQuery joinWithChildrenNavigationNode($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ChildrenNavigationNode relation
 *
 * @method     ChildSpyNavigationNodeQuery leftJoinWithChildrenNavigationNode() Adds a LEFT JOIN clause and with to the query using the ChildrenNavigationNode relation
 * @method     ChildSpyNavigationNodeQuery rightJoinWithChildrenNavigationNode() Adds a RIGHT JOIN clause and with to the query using the ChildrenNavigationNode relation
 * @method     ChildSpyNavigationNodeQuery innerJoinWithChildrenNavigationNode() Adds a INNER JOIN clause and with to the query using the ChildrenNavigationNode relation
 *
 * @method     ChildSpyNavigationNodeQuery leftJoinSpyNavigationNodeLocalizedAttributes($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyNavigationNodeLocalizedAttributes relation
 * @method     ChildSpyNavigationNodeQuery rightJoinSpyNavigationNodeLocalizedAttributes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyNavigationNodeLocalizedAttributes relation
 * @method     ChildSpyNavigationNodeQuery innerJoinSpyNavigationNodeLocalizedAttributes($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyNavigationNodeLocalizedAttributes relation
 *
 * @method     ChildSpyNavigationNodeQuery joinWithSpyNavigationNodeLocalizedAttributes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyNavigationNodeLocalizedAttributes relation
 *
 * @method     ChildSpyNavigationNodeQuery leftJoinWithSpyNavigationNodeLocalizedAttributes() Adds a LEFT JOIN clause and with to the query using the SpyNavigationNodeLocalizedAttributes relation
 * @method     ChildSpyNavigationNodeQuery rightJoinWithSpyNavigationNodeLocalizedAttributes() Adds a RIGHT JOIN clause and with to the query using the SpyNavigationNodeLocalizedAttributes relation
 * @method     ChildSpyNavigationNodeQuery innerJoinWithSpyNavigationNodeLocalizedAttributes() Adds a INNER JOIN clause and with to the query using the SpyNavigationNodeLocalizedAttributes relation
 *
 * @method     \Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery|\Orm\Zed\Navigation\Persistence\SpyNavigationQuery|\Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery|\Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyNavigationNode|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyNavigationNode matching the query
 * @method     ChildSpyNavigationNode findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyNavigationNode matching the query, or a new ChildSpyNavigationNode object populated from the query conditions when no match is found
 *
 * @method     ChildSpyNavigationNode|null findOneByIdNavigationNode(int $id_navigation_node) Return the first ChildSpyNavigationNode filtered by the id_navigation_node column
 * @method     ChildSpyNavigationNode|null findOneByFkNavigation(int $fk_navigation) Return the first ChildSpyNavigationNode filtered by the fk_navigation column
 * @method     ChildSpyNavigationNode|null findOneByFkParentNavigationNode(int $fk_parent_navigation_node) Return the first ChildSpyNavigationNode filtered by the fk_parent_navigation_node column
 * @method     ChildSpyNavigationNode|null findOneByIsActive(boolean $is_active) Return the first ChildSpyNavigationNode filtered by the is_active column
 * @method     ChildSpyNavigationNode|null findOneByNodeKey(string $node_key) Return the first ChildSpyNavigationNode filtered by the node_key column
 * @method     ChildSpyNavigationNode|null findOneByNodeType(string $node_type) Return the first ChildSpyNavigationNode filtered by the node_type column
 * @method     ChildSpyNavigationNode|null findOneByPosition(int $position) Return the first ChildSpyNavigationNode filtered by the position column
 * @method     ChildSpyNavigationNode|null findOneByValidFrom(string $valid_from) Return the first ChildSpyNavigationNode filtered by the valid_from column
 * @method     ChildSpyNavigationNode|null findOneByValidTo(string $valid_to) Return the first ChildSpyNavigationNode filtered by the valid_to column
 *
 * @method     ChildSpyNavigationNode requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyNavigationNode by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyNavigationNode requireOne(?ConnectionInterface $con = null) Return the first ChildSpyNavigationNode matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyNavigationNode requireOneByIdNavigationNode(int $id_navigation_node) Return the first ChildSpyNavigationNode filtered by the id_navigation_node column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyNavigationNode requireOneByFkNavigation(int $fk_navigation) Return the first ChildSpyNavigationNode filtered by the fk_navigation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyNavigationNode requireOneByFkParentNavigationNode(int $fk_parent_navigation_node) Return the first ChildSpyNavigationNode filtered by the fk_parent_navigation_node column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyNavigationNode requireOneByIsActive(boolean $is_active) Return the first ChildSpyNavigationNode filtered by the is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyNavigationNode requireOneByNodeKey(string $node_key) Return the first ChildSpyNavigationNode filtered by the node_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyNavigationNode requireOneByNodeType(string $node_type) Return the first ChildSpyNavigationNode filtered by the node_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyNavigationNode requireOneByPosition(int $position) Return the first ChildSpyNavigationNode filtered by the position column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyNavigationNode requireOneByValidFrom(string $valid_from) Return the first ChildSpyNavigationNode filtered by the valid_from column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyNavigationNode requireOneByValidTo(string $valid_to) Return the first ChildSpyNavigationNode filtered by the valid_to column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyNavigationNode[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyNavigationNode objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyNavigationNode> find(?ConnectionInterface $con = null) Return ChildSpyNavigationNode objects based on current ModelCriteria
 *
 * @method     ChildSpyNavigationNode[]|Collection findByIdNavigationNode(int|array<int> $id_navigation_node) Return ChildSpyNavigationNode objects filtered by the id_navigation_node column
 * @psalm-method Collection&\Traversable<ChildSpyNavigationNode> findByIdNavigationNode(int|array<int> $id_navigation_node) Return ChildSpyNavigationNode objects filtered by the id_navigation_node column
 * @method     ChildSpyNavigationNode[]|Collection findByFkNavigation(int|array<int> $fk_navigation) Return ChildSpyNavigationNode objects filtered by the fk_navigation column
 * @psalm-method Collection&\Traversable<ChildSpyNavigationNode> findByFkNavigation(int|array<int> $fk_navigation) Return ChildSpyNavigationNode objects filtered by the fk_navigation column
 * @method     ChildSpyNavigationNode[]|Collection findByFkParentNavigationNode(int|array<int> $fk_parent_navigation_node) Return ChildSpyNavigationNode objects filtered by the fk_parent_navigation_node column
 * @psalm-method Collection&\Traversable<ChildSpyNavigationNode> findByFkParentNavigationNode(int|array<int> $fk_parent_navigation_node) Return ChildSpyNavigationNode objects filtered by the fk_parent_navigation_node column
 * @method     ChildSpyNavigationNode[]|Collection findByIsActive(boolean|array<boolean> $is_active) Return ChildSpyNavigationNode objects filtered by the is_active column
 * @psalm-method Collection&\Traversable<ChildSpyNavigationNode> findByIsActive(boolean|array<boolean> $is_active) Return ChildSpyNavigationNode objects filtered by the is_active column
 * @method     ChildSpyNavigationNode[]|Collection findByNodeKey(string|array<string> $node_key) Return ChildSpyNavigationNode objects filtered by the node_key column
 * @psalm-method Collection&\Traversable<ChildSpyNavigationNode> findByNodeKey(string|array<string> $node_key) Return ChildSpyNavigationNode objects filtered by the node_key column
 * @method     ChildSpyNavigationNode[]|Collection findByNodeType(string|array<string> $node_type) Return ChildSpyNavigationNode objects filtered by the node_type column
 * @psalm-method Collection&\Traversable<ChildSpyNavigationNode> findByNodeType(string|array<string> $node_type) Return ChildSpyNavigationNode objects filtered by the node_type column
 * @method     ChildSpyNavigationNode[]|Collection findByPosition(int|array<int> $position) Return ChildSpyNavigationNode objects filtered by the position column
 * @psalm-method Collection&\Traversable<ChildSpyNavigationNode> findByPosition(int|array<int> $position) Return ChildSpyNavigationNode objects filtered by the position column
 * @method     ChildSpyNavigationNode[]|Collection findByValidFrom(string|array<string> $valid_from) Return ChildSpyNavigationNode objects filtered by the valid_from column
 * @psalm-method Collection&\Traversable<ChildSpyNavigationNode> findByValidFrom(string|array<string> $valid_from) Return ChildSpyNavigationNode objects filtered by the valid_from column
 * @method     ChildSpyNavigationNode[]|Collection findByValidTo(string|array<string> $valid_to) Return ChildSpyNavigationNode objects filtered by the valid_to column
 * @psalm-method Collection&\Traversable<ChildSpyNavigationNode> findByValidTo(string|array<string> $valid_to) Return ChildSpyNavigationNode objects filtered by the valid_to column
 *
 * @method     ChildSpyNavigationNode[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyNavigationNode> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyNavigationNodeQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\Navigation\Persistence\Base\SpyNavigationNodeQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\Navigation\\Persistence\\SpyNavigationNode', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyNavigationNodeQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyNavigationNodeQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyNavigationNodeQuery) {
            return $criteria;
        }
        $query = new ChildSpyNavigationNodeQuery();
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
     * @return ChildSpyNavigationNode|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyNavigationNodeTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyNavigationNode A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_navigation_node, fk_navigation, fk_parent_navigation_node, is_active, node_key, node_type, position, valid_from, valid_to FROM spy_navigation_node WHERE id_navigation_node = :p0';
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
            /** @var ChildSpyNavigationNode $obj */
            $obj = new ChildSpyNavigationNode();
            $obj->hydrate($row);
            SpyNavigationNodeTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyNavigationNode|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyNavigationNodeTableMap::COL_ID_NAVIGATION_NODE, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyNavigationNodeTableMap::COL_ID_NAVIGATION_NODE, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idNavigationNode Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdNavigationNode_Between(array $idNavigationNode)
    {
        return $this->filterByIdNavigationNode($idNavigationNode, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idNavigationNodes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdNavigationNode_In(array $idNavigationNodes)
    {
        return $this->filterByIdNavigationNode($idNavigationNodes, Criteria::IN);
    }

    /**
     * Filter the query on the id_navigation_node column
     *
     * Example usage:
     * <code>
     * $query->filterByIdNavigationNode(1234); // WHERE id_navigation_node = 1234
     * $query->filterByIdNavigationNode(array(12, 34), Criteria::IN); // WHERE id_navigation_node IN (12, 34)
     * $query->filterByIdNavigationNode(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_navigation_node > 12
     * </code>
     *
     * @param     mixed $idNavigationNode The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdNavigationNode($idNavigationNode = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idNavigationNode)) {
            $useMinMax = false;
            if (isset($idNavigationNode['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyNavigationNodeTableMap::COL_ID_NAVIGATION_NODE, $idNavigationNode['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idNavigationNode['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyNavigationNodeTableMap::COL_ID_NAVIGATION_NODE, $idNavigationNode['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idNavigationNode of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyNavigationNodeTableMap::COL_ID_NAVIGATION_NODE, $idNavigationNode, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkNavigation Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkNavigation_Between(array $fkNavigation)
    {
        return $this->filterByFkNavigation($fkNavigation, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkNavigations Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkNavigation_In(array $fkNavigations)
    {
        return $this->filterByFkNavigation($fkNavigations, Criteria::IN);
    }

    /**
     * Filter the query on the fk_navigation column
     *
     * Example usage:
     * <code>
     * $query->filterByFkNavigation(1234); // WHERE fk_navigation = 1234
     * $query->filterByFkNavigation(array(12, 34), Criteria::IN); // WHERE fk_navigation IN (12, 34)
     * $query->filterByFkNavigation(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_navigation > 12
     * </code>
     *
     * @see       filterBySpyNavigation()
     *
     * @param     mixed $fkNavigation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkNavigation($fkNavigation = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkNavigation)) {
            $useMinMax = false;
            if (isset($fkNavigation['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyNavigationNodeTableMap::COL_FK_NAVIGATION, $fkNavigation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkNavigation['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyNavigationNodeTableMap::COL_FK_NAVIGATION, $fkNavigation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkNavigation of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyNavigationNodeTableMap::COL_FK_NAVIGATION, $fkNavigation, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkParentNavigationNode Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkParentNavigationNode_Between(array $fkParentNavigationNode)
    {
        return $this->filterByFkParentNavigationNode($fkParentNavigationNode, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkParentNavigationNodes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkParentNavigationNode_In(array $fkParentNavigationNodes)
    {
        return $this->filterByFkParentNavigationNode($fkParentNavigationNodes, Criteria::IN);
    }

    /**
     * Filter the query on the fk_parent_navigation_node column
     *
     * Example usage:
     * <code>
     * $query->filterByFkParentNavigationNode(1234); // WHERE fk_parent_navigation_node = 1234
     * $query->filterByFkParentNavigationNode(array(12, 34), Criteria::IN); // WHERE fk_parent_navigation_node IN (12, 34)
     * $query->filterByFkParentNavigationNode(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_parent_navigation_node > 12
     * </code>
     *
     * @see       filterByParentNavigationNode()
     *
     * @param     mixed $fkParentNavigationNode The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkParentNavigationNode($fkParentNavigationNode = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkParentNavigationNode)) {
            $useMinMax = false;
            if (isset($fkParentNavigationNode['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyNavigationNodeTableMap::COL_FK_PARENT_NAVIGATION_NODE, $fkParentNavigationNode['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkParentNavigationNode['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyNavigationNodeTableMap::COL_FK_PARENT_NAVIGATION_NODE, $fkParentNavigationNode['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkParentNavigationNode of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyNavigationNodeTableMap::COL_FK_PARENT_NAVIGATION_NODE, $fkParentNavigationNode, $comparison);

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

        $query = $this->addUsingAlias(SpyNavigationNodeTableMap::COL_IS_ACTIVE, $isActive, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $nodeKeys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNodeKey_In(array $nodeKeys)
    {
        return $this->filterByNodeKey($nodeKeys, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $nodeKey Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNodeKey_Like($nodeKey)
    {
        return $this->filterByNodeKey($nodeKey, Criteria::LIKE);
    }

    /**
     * Filter the query on the node_key column
     *
     * Example usage:
     * <code>
     * $query->filterByNodeKey('fooValue');   // WHERE node_key = 'fooValue'
     * $query->filterByNodeKey('%fooValue%', Criteria::LIKE); // WHERE node_key LIKE '%fooValue%'
     * $query->filterByNodeKey([1, 'foo'], Criteria::IN); // WHERE node_key IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $nodeKey The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByNodeKey($nodeKey = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $nodeKey = str_replace('*', '%', $nodeKey);
        }

        if (is_array($nodeKey) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$nodeKey of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyNavigationNodeTableMap::COL_NODE_KEY, $nodeKey, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $nodeTypes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNodeType_In(array $nodeTypes)
    {
        return $this->filterByNodeType($nodeTypes, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $nodeType Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNodeType_Like($nodeType)
    {
        return $this->filterByNodeType($nodeType, Criteria::LIKE);
    }

    /**
     * Filter the query on the node_type column
     *
     * Example usage:
     * <code>
     * $query->filterByNodeType('fooValue');   // WHERE node_type = 'fooValue'
     * $query->filterByNodeType('%fooValue%', Criteria::LIKE); // WHERE node_type LIKE '%fooValue%'
     * $query->filterByNodeType([1, 'foo'], Criteria::IN); // WHERE node_type IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $nodeType The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByNodeType($nodeType = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $nodeType = str_replace('*', '%', $nodeType);
        }

        if (is_array($nodeType) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$nodeType of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyNavigationNodeTableMap::COL_NODE_TYPE, $nodeType, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $position Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPosition_Between(array $position)
    {
        return $this->filterByPosition($position, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $positions Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPosition_In(array $positions)
    {
        return $this->filterByPosition($positions, Criteria::IN);
    }

    /**
     * Filter the query on the position column
     *
     * Example usage:
     * <code>
     * $query->filterByPosition(1234); // WHERE position = 1234
     * $query->filterByPosition(array(12, 34), Criteria::IN); // WHERE position IN (12, 34)
     * $query->filterByPosition(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE position > 12
     * </code>
     *
     * @param     mixed $position The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByPosition($position = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($position)) {
            $useMinMax = false;
            if (isset($position['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyNavigationNodeTableMap::COL_POSITION, $position['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($position['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyNavigationNodeTableMap::COL_POSITION, $position['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$position of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyNavigationNodeTableMap::COL_POSITION, $position, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $validFrom Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByValidFrom_Between(array $validFrom)
    {
        return $this->filterByValidFrom($validFrom, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $validFroms Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByValidFrom_In(array $validFroms)
    {
        return $this->filterByValidFrom($validFroms, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $validFrom Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByValidFrom_Like($validFrom)
    {
        return $this->filterByValidFrom($validFrom, Criteria::LIKE);
    }

    /**
     * Filter the query on the valid_from column
     *
     * Example usage:
     * <code>
     * $query->filterByValidFrom('2011-03-14'); // WHERE valid_from = '2011-03-14'
     * $query->filterByValidFrom('now'); // WHERE valid_from = '2011-03-14'
     * $query->filterByValidFrom(array('max' => 'yesterday'), SprykerCriteria::BETWEEN); // WHERE valid_from > '2011-03-13'
     * </code>
     *
     * @param     mixed $validFrom The value to use as filter.
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
    public function filterByValidFrom($validFrom = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($validFrom)) {
            $useMinMax = false;
            if (isset($validFrom['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyNavigationNodeTableMap::COL_VALID_FROM, $validFrom['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($validFrom['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyNavigationNodeTableMap::COL_VALID_FROM, $validFrom['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$validFrom of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyNavigationNodeTableMap::COL_VALID_FROM, $validFrom, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $validTo Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByValidTo_Between(array $validTo)
    {
        return $this->filterByValidTo($validTo, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $validTos Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByValidTo_In(array $validTos)
    {
        return $this->filterByValidTo($validTos, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $validTo Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByValidTo_Like($validTo)
    {
        return $this->filterByValidTo($validTo, Criteria::LIKE);
    }

    /**
     * Filter the query on the valid_to column
     *
     * Example usage:
     * <code>
     * $query->filterByValidTo('2011-03-14'); // WHERE valid_to = '2011-03-14'
     * $query->filterByValidTo('now'); // WHERE valid_to = '2011-03-14'
     * $query->filterByValidTo(array('max' => 'yesterday'), SprykerCriteria::BETWEEN); // WHERE valid_to > '2011-03-13'
     * </code>
     *
     * @param     mixed $validTo The value to use as filter.
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
    public function filterByValidTo($validTo = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($validTo)) {
            $useMinMax = false;
            if (isset($validTo['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyNavigationNodeTableMap::COL_VALID_TO, $validTo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($validTo['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyNavigationNodeTableMap::COL_VALID_TO, $validTo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$validTo of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyNavigationNodeTableMap::COL_VALID_TO, $validTo, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Navigation\Persistence\SpyNavigationNode object
     *
     * @param \Orm\Zed\Navigation\Persistence\SpyNavigationNode|ObjectCollection $spyNavigationNode The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByParentNavigationNode($spyNavigationNode, ?string $comparison = null)
    {
        if ($spyNavigationNode instanceof \Orm\Zed\Navigation\Persistence\SpyNavigationNode) {
            return $this
                ->addUsingAlias(SpyNavigationNodeTableMap::COL_FK_PARENT_NAVIGATION_NODE, $spyNavigationNode->getIdNavigationNode(), $comparison);
        } elseif ($spyNavigationNode instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyNavigationNodeTableMap::COL_FK_PARENT_NAVIGATION_NODE, $spyNavigationNode->toKeyValue('PrimaryKey', 'IdNavigationNode'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByParentNavigationNode() only accepts arguments of type \Orm\Zed\Navigation\Persistence\SpyNavigationNode or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ParentNavigationNode relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinParentNavigationNode(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ParentNavigationNode');

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
            $this->addJoinObject($join, 'ParentNavigationNode');
        }

        return $this;
    }

    /**
     * Use the ParentNavigationNode relation SpyNavigationNode object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery A secondary query class using the current class as primary query
     */
    public function useParentNavigationNodeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinParentNavigationNode($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ParentNavigationNode', '\Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery');
    }

    /**
     * Use the ParentNavigationNode relation SpyNavigationNode object
     *
     * @param callable(\Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery):\Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withParentNavigationNodeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useParentNavigationNodeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ParentNavigationNode relation to the SpyNavigationNode table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery The inner query object of the EXISTS statement
     */
    public function useParentNavigationNodeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery */
        $q = $this->useExistsQuery('ParentNavigationNode', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ParentNavigationNode relation to the SpyNavigationNode table for a NOT EXISTS query.
     *
     * @see useParentNavigationNodeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery The inner query object of the NOT EXISTS statement
     */
    public function useParentNavigationNodeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery */
        $q = $this->useExistsQuery('ParentNavigationNode', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ParentNavigationNode relation to the SpyNavigationNode table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery The inner query object of the IN statement
     */
    public function useInParentNavigationNodeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery */
        $q = $this->useInQuery('ParentNavigationNode', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ParentNavigationNode relation to the SpyNavigationNode table for a NOT IN query.
     *
     * @see useParentNavigationNodeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery The inner query object of the NOT IN statement
     */
    public function useNotInParentNavigationNodeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery */
        $q = $this->useInQuery('ParentNavigationNode', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Navigation\Persistence\SpyNavigation object
     *
     * @param \Orm\Zed\Navigation\Persistence\SpyNavigation|ObjectCollection $spyNavigation The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyNavigation($spyNavigation, ?string $comparison = null)
    {
        if ($spyNavigation instanceof \Orm\Zed\Navigation\Persistence\SpyNavigation) {
            return $this
                ->addUsingAlias(SpyNavigationNodeTableMap::COL_FK_NAVIGATION, $spyNavigation->getIdNavigation(), $comparison);
        } elseif ($spyNavigation instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyNavigationNodeTableMap::COL_FK_NAVIGATION, $spyNavigation->toKeyValue('PrimaryKey', 'IdNavigation'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyNavigation() only accepts arguments of type \Orm\Zed\Navigation\Persistence\SpyNavigation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyNavigation relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyNavigation(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyNavigation');

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
            $this->addJoinObject($join, 'SpyNavigation');
        }

        return $this;
    }

    /**
     * Use the SpyNavigation relation SpyNavigation object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationQuery A secondary query class using the current class as primary query
     */
    public function useSpyNavigationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyNavigation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyNavigation', '\Orm\Zed\Navigation\Persistence\SpyNavigationQuery');
    }

    /**
     * Use the SpyNavigation relation SpyNavigation object
     *
     * @param callable(\Orm\Zed\Navigation\Persistence\SpyNavigationQuery):\Orm\Zed\Navigation\Persistence\SpyNavigationQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyNavigationQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyNavigationQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyNavigation table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationQuery The inner query object of the EXISTS statement
     */
    public function useSpyNavigationExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Navigation\Persistence\SpyNavigationQuery */
        $q = $this->useExistsQuery('SpyNavigation', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyNavigation table for a NOT EXISTS query.
     *
     * @see useSpyNavigationExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyNavigationNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Navigation\Persistence\SpyNavigationQuery */
        $q = $this->useExistsQuery('SpyNavigation', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyNavigation table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationQuery The inner query object of the IN statement
     */
    public function useInSpyNavigationQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Navigation\Persistence\SpyNavigationQuery */
        $q = $this->useInQuery('SpyNavigation', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyNavigation table for a NOT IN query.
     *
     * @see useSpyNavigationInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyNavigationQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Navigation\Persistence\SpyNavigationQuery */
        $q = $this->useInQuery('SpyNavigation', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Navigation\Persistence\SpyNavigationNode object
     *
     * @param \Orm\Zed\Navigation\Persistence\SpyNavigationNode|ObjectCollection $spyNavigationNode the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByChildrenNavigationNode($spyNavigationNode, ?string $comparison = null)
    {
        if ($spyNavigationNode instanceof \Orm\Zed\Navigation\Persistence\SpyNavigationNode) {
            $this
                ->addUsingAlias(SpyNavigationNodeTableMap::COL_ID_NAVIGATION_NODE, $spyNavigationNode->getFkParentNavigationNode(), $comparison);

            return $this;
        } elseif ($spyNavigationNode instanceof ObjectCollection) {
            $this
                ->useChildrenNavigationNodeQuery()
                ->filterByPrimaryKeys($spyNavigationNode->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByChildrenNavigationNode() only accepts arguments of type \Orm\Zed\Navigation\Persistence\SpyNavigationNode or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ChildrenNavigationNode relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinChildrenNavigationNode(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ChildrenNavigationNode');

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
            $this->addJoinObject($join, 'ChildrenNavigationNode');
        }

        return $this;
    }

    /**
     * Use the ChildrenNavigationNode relation SpyNavigationNode object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery A secondary query class using the current class as primary query
     */
    public function useChildrenNavigationNodeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinChildrenNavigationNode($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ChildrenNavigationNode', '\Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery');
    }

    /**
     * Use the ChildrenNavigationNode relation SpyNavigationNode object
     *
     * @param callable(\Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery):\Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withChildrenNavigationNodeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useChildrenNavigationNodeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ChildrenNavigationNode relation to the SpyNavigationNode table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery The inner query object of the EXISTS statement
     */
    public function useChildrenNavigationNodeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery */
        $q = $this->useExistsQuery('ChildrenNavigationNode', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ChildrenNavigationNode relation to the SpyNavigationNode table for a NOT EXISTS query.
     *
     * @see useChildrenNavigationNodeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery The inner query object of the NOT EXISTS statement
     */
    public function useChildrenNavigationNodeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery */
        $q = $this->useExistsQuery('ChildrenNavigationNode', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ChildrenNavigationNode relation to the SpyNavigationNode table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery The inner query object of the IN statement
     */
    public function useInChildrenNavigationNodeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery */
        $q = $this->useInQuery('ChildrenNavigationNode', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ChildrenNavigationNode relation to the SpyNavigationNode table for a NOT IN query.
     *
     * @see useChildrenNavigationNodeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery The inner query object of the NOT IN statement
     */
    public function useNotInChildrenNavigationNodeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery */
        $q = $this->useInQuery('ChildrenNavigationNode', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributes object
     *
     * @param \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributes|ObjectCollection $spyNavigationNodeLocalizedAttributes the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyNavigationNodeLocalizedAttributes($spyNavigationNodeLocalizedAttributes, ?string $comparison = null)
    {
        if ($spyNavigationNodeLocalizedAttributes instanceof \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributes) {
            $this
                ->addUsingAlias(SpyNavigationNodeTableMap::COL_ID_NAVIGATION_NODE, $spyNavigationNodeLocalizedAttributes->getFkNavigationNode(), $comparison);

            return $this;
        } elseif ($spyNavigationNodeLocalizedAttributes instanceof ObjectCollection) {
            $this
                ->useSpyNavigationNodeLocalizedAttributesQuery()
                ->filterByPrimaryKeys($spyNavigationNodeLocalizedAttributes->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyNavigationNodeLocalizedAttributes() only accepts arguments of type \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributes or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyNavigationNodeLocalizedAttributes relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyNavigationNodeLocalizedAttributes(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyNavigationNodeLocalizedAttributes');

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
            $this->addJoinObject($join, 'SpyNavigationNodeLocalizedAttributes');
        }

        return $this;
    }

    /**
     * Use the SpyNavigationNodeLocalizedAttributes relation SpyNavigationNodeLocalizedAttributes object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery A secondary query class using the current class as primary query
     */
    public function useSpyNavigationNodeLocalizedAttributesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyNavigationNodeLocalizedAttributes($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyNavigationNodeLocalizedAttributes', '\Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery');
    }

    /**
     * Use the SpyNavigationNodeLocalizedAttributes relation SpyNavigationNodeLocalizedAttributes object
     *
     * @param callable(\Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery):\Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyNavigationNodeLocalizedAttributesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyNavigationNodeLocalizedAttributesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyNavigationNodeLocalizedAttributes table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery The inner query object of the EXISTS statement
     */
    public function useSpyNavigationNodeLocalizedAttributesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery */
        $q = $this->useExistsQuery('SpyNavigationNodeLocalizedAttributes', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyNavigationNodeLocalizedAttributes table for a NOT EXISTS query.
     *
     * @see useSpyNavigationNodeLocalizedAttributesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyNavigationNodeLocalizedAttributesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery */
        $q = $this->useExistsQuery('SpyNavigationNodeLocalizedAttributes', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyNavigationNodeLocalizedAttributes table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery The inner query object of the IN statement
     */
    public function useInSpyNavigationNodeLocalizedAttributesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery */
        $q = $this->useInQuery('SpyNavigationNodeLocalizedAttributes', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyNavigationNodeLocalizedAttributes table for a NOT IN query.
     *
     * @see useSpyNavigationNodeLocalizedAttributesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyNavigationNodeLocalizedAttributesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery */
        $q = $this->useInQuery('SpyNavigationNodeLocalizedAttributes', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyNavigationNode $spyNavigationNode Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyNavigationNode = null)
    {
        if ($spyNavigationNode) {
            $this->addUsingAlias(SpyNavigationNodeTableMap::COL_ID_NAVIGATION_NODE, $spyNavigationNode->getIdNavigationNode(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_navigation_node table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyNavigationNodeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyNavigationNodeTableMap::clearInstancePool();
            SpyNavigationNodeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyNavigationNodeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyNavigationNodeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyNavigationNodeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyNavigationNodeTableMap::clearRelatedInstancePool();

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
