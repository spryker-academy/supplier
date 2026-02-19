<?php

namespace Orm\Zed\Navigation\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\Locale\Persistence\SpyLocale;
use Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributes as ChildSpyNavigationNodeLocalizedAttributes;
use Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery as ChildSpyNavigationNodeLocalizedAttributesQuery;
use Orm\Zed\Navigation\Persistence\Map\SpyNavigationNodeLocalizedAttributesTableMap;
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
 * Base class that represents a query for the `spy_navigation_node_localized_attributes` table.
 *
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery orderByIdNavigationNodeLocalizedAttributes($order = Criteria::ASC) Order by the id_navigation_node_localized_attributes column
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery orderByFkLocale($order = Criteria::ASC) Order by the fk_locale column
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery orderByFkNavigationNode($order = Criteria::ASC) Order by the fk_navigation_node column
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery orderByFkUrl($order = Criteria::ASC) Order by the fk_url column
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery orderByCssClass($order = Criteria::ASC) Order by the css_class column
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery orderByExternalUrl($order = Criteria::ASC) Order by the external_url column
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery orderByLink($order = Criteria::ASC) Order by the link column
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery groupByIdNavigationNodeLocalizedAttributes() Group by the id_navigation_node_localized_attributes column
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery groupByFkLocale() Group by the fk_locale column
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery groupByFkNavigationNode() Group by the fk_navigation_node column
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery groupByFkUrl() Group by the fk_url column
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery groupByCssClass() Group by the css_class column
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery groupByExternalUrl() Group by the external_url column
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery groupByLink() Group by the link column
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery groupByTitle() Group by the title column
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery leftJoinSpyNavigationNode($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyNavigationNode relation
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery rightJoinSpyNavigationNode($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyNavigationNode relation
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery innerJoinSpyNavigationNode($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyNavigationNode relation
 *
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery joinWithSpyNavigationNode($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyNavigationNode relation
 *
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery leftJoinWithSpyNavigationNode() Adds a LEFT JOIN clause and with to the query using the SpyNavigationNode relation
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery rightJoinWithSpyNavigationNode() Adds a RIGHT JOIN clause and with to the query using the SpyNavigationNode relation
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery innerJoinWithSpyNavigationNode() Adds a INNER JOIN clause and with to the query using the SpyNavigationNode relation
 *
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery leftJoinSpyLocale($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyLocale relation
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery rightJoinSpyLocale($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyLocale relation
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery innerJoinSpyLocale($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyLocale relation
 *
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery joinWithSpyLocale($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyLocale relation
 *
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery leftJoinWithSpyLocale() Adds a LEFT JOIN clause and with to the query using the SpyLocale relation
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery rightJoinWithSpyLocale() Adds a RIGHT JOIN clause and with to the query using the SpyLocale relation
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery innerJoinWithSpyLocale() Adds a INNER JOIN clause and with to the query using the SpyLocale relation
 *
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery leftJoinSpyUrl($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyUrl relation
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery rightJoinSpyUrl($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyUrl relation
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery innerJoinSpyUrl($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyUrl relation
 *
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery joinWithSpyUrl($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyUrl relation
 *
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery leftJoinWithSpyUrl() Adds a LEFT JOIN clause and with to the query using the SpyUrl relation
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery rightJoinWithSpyUrl() Adds a RIGHT JOIN clause and with to the query using the SpyUrl relation
 * @method     ChildSpyNavigationNodeLocalizedAttributesQuery innerJoinWithSpyUrl() Adds a INNER JOIN clause and with to the query using the SpyUrl relation
 *
 * @method     \Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery|\Orm\Zed\Locale\Persistence\SpyLocaleQuery|\Orm\Zed\Url\Persistence\SpyUrlQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyNavigationNodeLocalizedAttributes|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyNavigationNodeLocalizedAttributes matching the query
 * @method     ChildSpyNavigationNodeLocalizedAttributes findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyNavigationNodeLocalizedAttributes matching the query, or a new ChildSpyNavigationNodeLocalizedAttributes object populated from the query conditions when no match is found
 *
 * @method     ChildSpyNavigationNodeLocalizedAttributes|null findOneByIdNavigationNodeLocalizedAttributes(int $id_navigation_node_localized_attributes) Return the first ChildSpyNavigationNodeLocalizedAttributes filtered by the id_navigation_node_localized_attributes column
 * @method     ChildSpyNavigationNodeLocalizedAttributes|null findOneByFkLocale(int $fk_locale) Return the first ChildSpyNavigationNodeLocalizedAttributes filtered by the fk_locale column
 * @method     ChildSpyNavigationNodeLocalizedAttributes|null findOneByFkNavigationNode(int $fk_navigation_node) Return the first ChildSpyNavigationNodeLocalizedAttributes filtered by the fk_navigation_node column
 * @method     ChildSpyNavigationNodeLocalizedAttributes|null findOneByFkUrl(int $fk_url) Return the first ChildSpyNavigationNodeLocalizedAttributes filtered by the fk_url column
 * @method     ChildSpyNavigationNodeLocalizedAttributes|null findOneByCssClass(string $css_class) Return the first ChildSpyNavigationNodeLocalizedAttributes filtered by the css_class column
 * @method     ChildSpyNavigationNodeLocalizedAttributes|null findOneByExternalUrl(string $external_url) Return the first ChildSpyNavigationNodeLocalizedAttributes filtered by the external_url column
 * @method     ChildSpyNavigationNodeLocalizedAttributes|null findOneByLink(string $link) Return the first ChildSpyNavigationNodeLocalizedAttributes filtered by the link column
 * @method     ChildSpyNavigationNodeLocalizedAttributes|null findOneByTitle(string $title) Return the first ChildSpyNavigationNodeLocalizedAttributes filtered by the title column
 * @method     ChildSpyNavigationNodeLocalizedAttributes|null findOneByCreatedAt(string $created_at) Return the first ChildSpyNavigationNodeLocalizedAttributes filtered by the created_at column
 * @method     ChildSpyNavigationNodeLocalizedAttributes|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpyNavigationNodeLocalizedAttributes filtered by the updated_at column
 *
 * @method     ChildSpyNavigationNodeLocalizedAttributes requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyNavigationNodeLocalizedAttributes by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyNavigationNodeLocalizedAttributes requireOne(?ConnectionInterface $con = null) Return the first ChildSpyNavigationNodeLocalizedAttributes matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyNavigationNodeLocalizedAttributes requireOneByIdNavigationNodeLocalizedAttributes(int $id_navigation_node_localized_attributes) Return the first ChildSpyNavigationNodeLocalizedAttributes filtered by the id_navigation_node_localized_attributes column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyNavigationNodeLocalizedAttributes requireOneByFkLocale(int $fk_locale) Return the first ChildSpyNavigationNodeLocalizedAttributes filtered by the fk_locale column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyNavigationNodeLocalizedAttributes requireOneByFkNavigationNode(int $fk_navigation_node) Return the first ChildSpyNavigationNodeLocalizedAttributes filtered by the fk_navigation_node column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyNavigationNodeLocalizedAttributes requireOneByFkUrl(int $fk_url) Return the first ChildSpyNavigationNodeLocalizedAttributes filtered by the fk_url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyNavigationNodeLocalizedAttributes requireOneByCssClass(string $css_class) Return the first ChildSpyNavigationNodeLocalizedAttributes filtered by the css_class column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyNavigationNodeLocalizedAttributes requireOneByExternalUrl(string $external_url) Return the first ChildSpyNavigationNodeLocalizedAttributes filtered by the external_url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyNavigationNodeLocalizedAttributes requireOneByLink(string $link) Return the first ChildSpyNavigationNodeLocalizedAttributes filtered by the link column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyNavigationNodeLocalizedAttributes requireOneByTitle(string $title) Return the first ChildSpyNavigationNodeLocalizedAttributes filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyNavigationNodeLocalizedAttributes requireOneByCreatedAt(string $created_at) Return the first ChildSpyNavigationNodeLocalizedAttributes filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyNavigationNodeLocalizedAttributes requireOneByUpdatedAt(string $updated_at) Return the first ChildSpyNavigationNodeLocalizedAttributes filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyNavigationNodeLocalizedAttributes[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyNavigationNodeLocalizedAttributes objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyNavigationNodeLocalizedAttributes> find(?ConnectionInterface $con = null) Return ChildSpyNavigationNodeLocalizedAttributes objects based on current ModelCriteria
 *
 * @method     ChildSpyNavigationNodeLocalizedAttributes[]|Collection findByIdNavigationNodeLocalizedAttributes(int|array<int> $id_navigation_node_localized_attributes) Return ChildSpyNavigationNodeLocalizedAttributes objects filtered by the id_navigation_node_localized_attributes column
 * @psalm-method Collection&\Traversable<ChildSpyNavigationNodeLocalizedAttributes> findByIdNavigationNodeLocalizedAttributes(int|array<int> $id_navigation_node_localized_attributes) Return ChildSpyNavigationNodeLocalizedAttributes objects filtered by the id_navigation_node_localized_attributes column
 * @method     ChildSpyNavigationNodeLocalizedAttributes[]|Collection findByFkLocale(int|array<int> $fk_locale) Return ChildSpyNavigationNodeLocalizedAttributes objects filtered by the fk_locale column
 * @psalm-method Collection&\Traversable<ChildSpyNavigationNodeLocalizedAttributes> findByFkLocale(int|array<int> $fk_locale) Return ChildSpyNavigationNodeLocalizedAttributes objects filtered by the fk_locale column
 * @method     ChildSpyNavigationNodeLocalizedAttributes[]|Collection findByFkNavigationNode(int|array<int> $fk_navigation_node) Return ChildSpyNavigationNodeLocalizedAttributes objects filtered by the fk_navigation_node column
 * @psalm-method Collection&\Traversable<ChildSpyNavigationNodeLocalizedAttributes> findByFkNavigationNode(int|array<int> $fk_navigation_node) Return ChildSpyNavigationNodeLocalizedAttributes objects filtered by the fk_navigation_node column
 * @method     ChildSpyNavigationNodeLocalizedAttributes[]|Collection findByFkUrl(int|array<int> $fk_url) Return ChildSpyNavigationNodeLocalizedAttributes objects filtered by the fk_url column
 * @psalm-method Collection&\Traversable<ChildSpyNavigationNodeLocalizedAttributes> findByFkUrl(int|array<int> $fk_url) Return ChildSpyNavigationNodeLocalizedAttributes objects filtered by the fk_url column
 * @method     ChildSpyNavigationNodeLocalizedAttributes[]|Collection findByCssClass(string|array<string> $css_class) Return ChildSpyNavigationNodeLocalizedAttributes objects filtered by the css_class column
 * @psalm-method Collection&\Traversable<ChildSpyNavigationNodeLocalizedAttributes> findByCssClass(string|array<string> $css_class) Return ChildSpyNavigationNodeLocalizedAttributes objects filtered by the css_class column
 * @method     ChildSpyNavigationNodeLocalizedAttributes[]|Collection findByExternalUrl(string|array<string> $external_url) Return ChildSpyNavigationNodeLocalizedAttributes objects filtered by the external_url column
 * @psalm-method Collection&\Traversable<ChildSpyNavigationNodeLocalizedAttributes> findByExternalUrl(string|array<string> $external_url) Return ChildSpyNavigationNodeLocalizedAttributes objects filtered by the external_url column
 * @method     ChildSpyNavigationNodeLocalizedAttributes[]|Collection findByLink(string|array<string> $link) Return ChildSpyNavigationNodeLocalizedAttributes objects filtered by the link column
 * @psalm-method Collection&\Traversable<ChildSpyNavigationNodeLocalizedAttributes> findByLink(string|array<string> $link) Return ChildSpyNavigationNodeLocalizedAttributes objects filtered by the link column
 * @method     ChildSpyNavigationNodeLocalizedAttributes[]|Collection findByTitle(string|array<string> $title) Return ChildSpyNavigationNodeLocalizedAttributes objects filtered by the title column
 * @psalm-method Collection&\Traversable<ChildSpyNavigationNodeLocalizedAttributes> findByTitle(string|array<string> $title) Return ChildSpyNavigationNodeLocalizedAttributes objects filtered by the title column
 * @method     ChildSpyNavigationNodeLocalizedAttributes[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpyNavigationNodeLocalizedAttributes objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpyNavigationNodeLocalizedAttributes> findByCreatedAt(string|array<string> $created_at) Return ChildSpyNavigationNodeLocalizedAttributes objects filtered by the created_at column
 * @method     ChildSpyNavigationNodeLocalizedAttributes[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyNavigationNodeLocalizedAttributes objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpyNavigationNodeLocalizedAttributes> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyNavigationNodeLocalizedAttributes objects filtered by the updated_at column
 *
 * @method     ChildSpyNavigationNodeLocalizedAttributes[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyNavigationNodeLocalizedAttributes> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyNavigationNodeLocalizedAttributesQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\Navigation\Persistence\Base\SpyNavigationNodeLocalizedAttributesQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\Navigation\\Persistence\\SpyNavigationNodeLocalizedAttributes', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyNavigationNodeLocalizedAttributesQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyNavigationNodeLocalizedAttributesQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyNavigationNodeLocalizedAttributesQuery) {
            return $criteria;
        }
        $query = new ChildSpyNavigationNodeLocalizedAttributesQuery();
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
     * @return ChildSpyNavigationNodeLocalizedAttributes|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyNavigationNodeLocalizedAttributesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyNavigationNodeLocalizedAttributes A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_navigation_node_localized_attributes, fk_locale, fk_navigation_node, fk_url, css_class, external_url, link, title, created_at, updated_at FROM spy_navigation_node_localized_attributes WHERE id_navigation_node_localized_attributes = :p0';
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
            /** @var ChildSpyNavigationNodeLocalizedAttributes $obj */
            $obj = new ChildSpyNavigationNodeLocalizedAttributes();
            $obj->hydrate($row);
            SpyNavigationNodeLocalizedAttributesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyNavigationNodeLocalizedAttributes|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyNavigationNodeLocalizedAttributesTableMap::COL_ID_NAVIGATION_NODE_LOCALIZED_ATTRIBUTES, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyNavigationNodeLocalizedAttributesTableMap::COL_ID_NAVIGATION_NODE_LOCALIZED_ATTRIBUTES, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idNavigationNodeLocalizedAttributes Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdNavigationNodeLocalizedAttributes_Between(array $idNavigationNodeLocalizedAttributes)
    {
        return $this->filterByIdNavigationNodeLocalizedAttributes($idNavigationNodeLocalizedAttributes, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idNavigationNodeLocalizedAttributess Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdNavigationNodeLocalizedAttributes_In(array $idNavigationNodeLocalizedAttributess)
    {
        return $this->filterByIdNavigationNodeLocalizedAttributes($idNavigationNodeLocalizedAttributess, Criteria::IN);
    }

    /**
     * Filter the query on the id_navigation_node_localized_attributes column
     *
     * Example usage:
     * <code>
     * $query->filterByIdNavigationNodeLocalizedAttributes(1234); // WHERE id_navigation_node_localized_attributes = 1234
     * $query->filterByIdNavigationNodeLocalizedAttributes(array(12, 34), Criteria::IN); // WHERE id_navigation_node_localized_attributes IN (12, 34)
     * $query->filterByIdNavigationNodeLocalizedAttributes(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_navigation_node_localized_attributes > 12
     * </code>
     *
     * @param     mixed $idNavigationNodeLocalizedAttributes The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdNavigationNodeLocalizedAttributes($idNavigationNodeLocalizedAttributes = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idNavigationNodeLocalizedAttributes)) {
            $useMinMax = false;
            if (isset($idNavigationNodeLocalizedAttributes['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyNavigationNodeLocalizedAttributesTableMap::COL_ID_NAVIGATION_NODE_LOCALIZED_ATTRIBUTES, $idNavigationNodeLocalizedAttributes['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idNavigationNodeLocalizedAttributes['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyNavigationNodeLocalizedAttributesTableMap::COL_ID_NAVIGATION_NODE_LOCALIZED_ATTRIBUTES, $idNavigationNodeLocalizedAttributes['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idNavigationNodeLocalizedAttributes of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyNavigationNodeLocalizedAttributesTableMap::COL_ID_NAVIGATION_NODE_LOCALIZED_ATTRIBUTES, $idNavigationNodeLocalizedAttributes, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkLocale Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkLocale_Between(array $fkLocale)
    {
        return $this->filterByFkLocale($fkLocale, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkLocales Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkLocale_In(array $fkLocales)
    {
        return $this->filterByFkLocale($fkLocales, Criteria::IN);
    }

    /**
     * Filter the query on the fk_locale column
     *
     * Example usage:
     * <code>
     * $query->filterByFkLocale(1234); // WHERE fk_locale = 1234
     * $query->filterByFkLocale(array(12, 34), Criteria::IN); // WHERE fk_locale IN (12, 34)
     * $query->filterByFkLocale(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_locale > 12
     * </code>
     *
     * @see       filterBySpyLocale()
     *
     * @param     mixed $fkLocale The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkLocale($fkLocale = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkLocale)) {
            $useMinMax = false;
            if (isset($fkLocale['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyNavigationNodeLocalizedAttributesTableMap::COL_FK_LOCALE, $fkLocale['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkLocale['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyNavigationNodeLocalizedAttributesTableMap::COL_FK_LOCALE, $fkLocale['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkLocale of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyNavigationNodeLocalizedAttributesTableMap::COL_FK_LOCALE, $fkLocale, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkNavigationNode Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkNavigationNode_Between(array $fkNavigationNode)
    {
        return $this->filterByFkNavigationNode($fkNavigationNode, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkNavigationNodes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkNavigationNode_In(array $fkNavigationNodes)
    {
        return $this->filterByFkNavigationNode($fkNavigationNodes, Criteria::IN);
    }

    /**
     * Filter the query on the fk_navigation_node column
     *
     * Example usage:
     * <code>
     * $query->filterByFkNavigationNode(1234); // WHERE fk_navigation_node = 1234
     * $query->filterByFkNavigationNode(array(12, 34), Criteria::IN); // WHERE fk_navigation_node IN (12, 34)
     * $query->filterByFkNavigationNode(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_navigation_node > 12
     * </code>
     *
     * @see       filterBySpyNavigationNode()
     *
     * @param     mixed $fkNavigationNode The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkNavigationNode($fkNavigationNode = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkNavigationNode)) {
            $useMinMax = false;
            if (isset($fkNavigationNode['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyNavigationNodeLocalizedAttributesTableMap::COL_FK_NAVIGATION_NODE, $fkNavigationNode['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkNavigationNode['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyNavigationNodeLocalizedAttributesTableMap::COL_FK_NAVIGATION_NODE, $fkNavigationNode['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkNavigationNode of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyNavigationNodeLocalizedAttributesTableMap::COL_FK_NAVIGATION_NODE, $fkNavigationNode, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkUrl Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkUrl_Between(array $fkUrl)
    {
        return $this->filterByFkUrl($fkUrl, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkUrls Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkUrl_In(array $fkUrls)
    {
        return $this->filterByFkUrl($fkUrls, Criteria::IN);
    }

    /**
     * Filter the query on the fk_url column
     *
     * Example usage:
     * <code>
     * $query->filterByFkUrl(1234); // WHERE fk_url = 1234
     * $query->filterByFkUrl(array(12, 34), Criteria::IN); // WHERE fk_url IN (12, 34)
     * $query->filterByFkUrl(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_url > 12
     * </code>
     *
     * @see       filterBySpyUrl()
     *
     * @param     mixed $fkUrl The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkUrl($fkUrl = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkUrl)) {
            $useMinMax = false;
            if (isset($fkUrl['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyNavigationNodeLocalizedAttributesTableMap::COL_FK_URL, $fkUrl['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkUrl['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyNavigationNodeLocalizedAttributesTableMap::COL_FK_URL, $fkUrl['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkUrl of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyNavigationNodeLocalizedAttributesTableMap::COL_FK_URL, $fkUrl, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $cssClasss Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCssClass_In(array $cssClasss)
    {
        return $this->filterByCssClass($cssClasss, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $cssClass Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCssClass_Like($cssClass)
    {
        return $this->filterByCssClass($cssClass, Criteria::LIKE);
    }

    /**
     * Filter the query on the css_class column
     *
     * Example usage:
     * <code>
     * $query->filterByCssClass('fooValue');   // WHERE css_class = 'fooValue'
     * $query->filterByCssClass('%fooValue%', Criteria::LIKE); // WHERE css_class LIKE '%fooValue%'
     * $query->filterByCssClass([1, 'foo'], Criteria::IN); // WHERE css_class IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $cssClass The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByCssClass($cssClass = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $cssClass = str_replace('*', '%', $cssClass);
        }

        if (is_array($cssClass) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$cssClass of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyNavigationNodeLocalizedAttributesTableMap::COL_CSS_CLASS, $cssClass, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $externalUrls Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExternalUrl_In(array $externalUrls)
    {
        return $this->filterByExternalUrl($externalUrls, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $externalUrl Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExternalUrl_Like($externalUrl)
    {
        return $this->filterByExternalUrl($externalUrl, Criteria::LIKE);
    }

    /**
     * Filter the query on the external_url column
     *
     * Example usage:
     * <code>
     * $query->filterByExternalUrl('fooValue');   // WHERE external_url = 'fooValue'
     * $query->filterByExternalUrl('%fooValue%', Criteria::LIKE); // WHERE external_url LIKE '%fooValue%'
     * $query->filterByExternalUrl([1, 'foo'], Criteria::IN); // WHERE external_url IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $externalUrl The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByExternalUrl($externalUrl = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $externalUrl = str_replace('*', '%', $externalUrl);
        }

        if (is_array($externalUrl) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$externalUrl of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyNavigationNodeLocalizedAttributesTableMap::COL_EXTERNAL_URL, $externalUrl, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $links Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLink_In(array $links)
    {
        return $this->filterByLink($links, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $link Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLink_Like($link)
    {
        return $this->filterByLink($link, Criteria::LIKE);
    }

    /**
     * Filter the query on the link column
     *
     * Example usage:
     * <code>
     * $query->filterByLink('fooValue');   // WHERE link = 'fooValue'
     * $query->filterByLink('%fooValue%', Criteria::LIKE); // WHERE link LIKE '%fooValue%'
     * $query->filterByLink([1, 'foo'], Criteria::IN); // WHERE link IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $link The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByLink($link = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $link = str_replace('*', '%', $link);
        }

        if (is_array($link) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$link of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyNavigationNodeLocalizedAttributesTableMap::COL_LINK, $link, $comparison);

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

        $query = $this->addUsingAlias(SpyNavigationNodeLocalizedAttributesTableMap::COL_TITLE, $title, $comparison);

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
                $this->addUsingAlias(SpyNavigationNodeLocalizedAttributesTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyNavigationNodeLocalizedAttributesTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyNavigationNodeLocalizedAttributesTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SpyNavigationNodeLocalizedAttributesTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyNavigationNodeLocalizedAttributesTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyNavigationNodeLocalizedAttributesTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
    public function filterBySpyNavigationNode($spyNavigationNode, ?string $comparison = null)
    {
        if ($spyNavigationNode instanceof \Orm\Zed\Navigation\Persistence\SpyNavigationNode) {
            return $this
                ->addUsingAlias(SpyNavigationNodeLocalizedAttributesTableMap::COL_FK_NAVIGATION_NODE, $spyNavigationNode->getIdNavigationNode(), $comparison);
        } elseif ($spyNavigationNode instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyNavigationNodeLocalizedAttributesTableMap::COL_FK_NAVIGATION_NODE, $spyNavigationNode->toKeyValue('PrimaryKey', 'IdNavigationNode'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyNavigationNode() only accepts arguments of type \Orm\Zed\Navigation\Persistence\SpyNavigationNode or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyNavigationNode relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyNavigationNode(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyNavigationNode');

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
            $this->addJoinObject($join, 'SpyNavigationNode');
        }

        return $this;
    }

    /**
     * Use the SpyNavigationNode relation SpyNavigationNode object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery A secondary query class using the current class as primary query
     */
    public function useSpyNavigationNodeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyNavigationNode($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyNavigationNode', '\Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery');
    }

    /**
     * Use the SpyNavigationNode relation SpyNavigationNode object
     *
     * @param callable(\Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery):\Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyNavigationNodeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyNavigationNodeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyNavigationNode table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery The inner query object of the EXISTS statement
     */
    public function useSpyNavigationNodeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery */
        $q = $this->useExistsQuery('SpyNavigationNode', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyNavigationNode table for a NOT EXISTS query.
     *
     * @see useSpyNavigationNodeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyNavigationNodeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery */
        $q = $this->useExistsQuery('SpyNavigationNode', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyNavigationNode table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery The inner query object of the IN statement
     */
    public function useInSpyNavigationNodeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery */
        $q = $this->useInQuery('SpyNavigationNode', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyNavigationNode table for a NOT IN query.
     *
     * @see useSpyNavigationNodeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyNavigationNodeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery */
        $q = $this->useInQuery('SpyNavigationNode', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Locale\Persistence\SpyLocale object
     *
     * @param \Orm\Zed\Locale\Persistence\SpyLocale|ObjectCollection $spyLocale The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyLocale($spyLocale, ?string $comparison = null)
    {
        if ($spyLocale instanceof \Orm\Zed\Locale\Persistence\SpyLocale) {
            return $this
                ->addUsingAlias(SpyNavigationNodeLocalizedAttributesTableMap::COL_FK_LOCALE, $spyLocale->getIdLocale(), $comparison);
        } elseif ($spyLocale instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyNavigationNodeLocalizedAttributesTableMap::COL_FK_LOCALE, $spyLocale->toKeyValue('PrimaryKey', 'IdLocale'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyLocale() only accepts arguments of type \Orm\Zed\Locale\Persistence\SpyLocale or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyLocale relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyLocale(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyLocale');

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
            $this->addJoinObject($join, 'SpyLocale');
        }

        return $this;
    }

    /**
     * Use the SpyLocale relation SpyLocale object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleQuery A secondary query class using the current class as primary query
     */
    public function useSpyLocaleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyLocale($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyLocale', '\Orm\Zed\Locale\Persistence\SpyLocaleQuery');
    }

    /**
     * Use the SpyLocale relation SpyLocale object
     *
     * @param callable(\Orm\Zed\Locale\Persistence\SpyLocaleQuery):\Orm\Zed\Locale\Persistence\SpyLocaleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyLocaleQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyLocaleQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyLocale table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleQuery The inner query object of the EXISTS statement
     */
    public function useSpyLocaleExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Locale\Persistence\SpyLocaleQuery */
        $q = $this->useExistsQuery('SpyLocale', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyLocale table for a NOT EXISTS query.
     *
     * @see useSpyLocaleExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyLocaleNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Locale\Persistence\SpyLocaleQuery */
        $q = $this->useExistsQuery('SpyLocale', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyLocale table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleQuery The inner query object of the IN statement
     */
    public function useInSpyLocaleQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Locale\Persistence\SpyLocaleQuery */
        $q = $this->useInQuery('SpyLocale', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyLocale table for a NOT IN query.
     *
     * @see useSpyLocaleInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyLocaleQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Locale\Persistence\SpyLocaleQuery */
        $q = $this->useInQuery('SpyLocale', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Url\Persistence\SpyUrl object
     *
     * @param \Orm\Zed\Url\Persistence\SpyUrl|ObjectCollection $spyUrl The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyUrl($spyUrl, ?string $comparison = null)
    {
        if ($spyUrl instanceof \Orm\Zed\Url\Persistence\SpyUrl) {
            return $this
                ->addUsingAlias(SpyNavigationNodeLocalizedAttributesTableMap::COL_FK_URL, $spyUrl->getIdUrl(), $comparison);
        } elseif ($spyUrl instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyNavigationNodeLocalizedAttributesTableMap::COL_FK_URL, $spyUrl->toKeyValue('PrimaryKey', 'IdUrl'), $comparison);

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
     * @param ChildSpyNavigationNodeLocalizedAttributes $spyNavigationNodeLocalizedAttributes Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyNavigationNodeLocalizedAttributes = null)
    {
        if ($spyNavigationNodeLocalizedAttributes) {
            $this->addUsingAlias(SpyNavigationNodeLocalizedAttributesTableMap::COL_ID_NAVIGATION_NODE_LOCALIZED_ATTRIBUTES, $spyNavigationNodeLocalizedAttributes->getIdNavigationNodeLocalizedAttributes(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_navigation_node_localized_attributes table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyNavigationNodeLocalizedAttributesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyNavigationNodeLocalizedAttributesTableMap::clearInstancePool();
            SpyNavigationNodeLocalizedAttributesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyNavigationNodeLocalizedAttributesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyNavigationNodeLocalizedAttributesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyNavigationNodeLocalizedAttributesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyNavigationNodeLocalizedAttributesTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(SpyNavigationNodeLocalizedAttributesTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyNavigationNodeLocalizedAttributesTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyNavigationNodeLocalizedAttributesTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyNavigationNodeLocalizedAttributesTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpyNavigationNodeLocalizedAttributesTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyNavigationNodeLocalizedAttributesTableMap::COL_CREATED_AT);

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
