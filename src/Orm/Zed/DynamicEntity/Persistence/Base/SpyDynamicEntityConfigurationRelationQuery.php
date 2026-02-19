<?php

namespace Orm\Zed\DynamicEntity\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelation as ChildSpyDynamicEntityConfigurationRelation;
use Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery as ChildSpyDynamicEntityConfigurationRelationQuery;
use Orm\Zed\DynamicEntity\Persistence\Map\SpyDynamicEntityConfigurationRelationTableMap;
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
 * Base class that represents a query for the `spy_dynamic_entity_configuration_relation` table.
 *
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery orderByIdDynamicEntityConfigurationRelation($order = Criteria::ASC) Order by the id_dynamic_entity_configuration_relation column
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery orderByFkParentDynamicEntityConfiguration($order = Criteria::ASC) Order by the fk_parent_dynamic_entity_configuration column
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery orderByFkChildDynamicEntityConfiguration($order = Criteria::ASC) Order by the fk_child_dynamic_entity_configuration column
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery orderByIsEditable($order = Criteria::ASC) Order by the is_editable column
 *
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery groupByIdDynamicEntityConfigurationRelation() Group by the id_dynamic_entity_configuration_relation column
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery groupByFkParentDynamicEntityConfiguration() Group by the fk_parent_dynamic_entity_configuration column
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery groupByFkChildDynamicEntityConfiguration() Group by the fk_child_dynamic_entity_configuration column
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery groupByName() Group by the name column
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery groupByIsEditable() Group by the is_editable column
 *
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery leftJoinSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration relation
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery rightJoinSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration relation
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery innerJoinSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration relation
 *
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery joinWithSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration relation
 *
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery leftJoinWithSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration() Adds a LEFT JOIN clause and with to the query using the SpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration relation
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery rightJoinWithSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration() Adds a RIGHT JOIN clause and with to the query using the SpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration relation
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery innerJoinWithSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration() Adds a INNER JOIN clause and with to the query using the SpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration relation
 *
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery leftJoinSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration relation
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery rightJoinSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration relation
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery innerJoinSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration relation
 *
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery joinWithSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration relation
 *
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery leftJoinWithSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration() Adds a LEFT JOIN clause and with to the query using the SpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration relation
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery rightJoinWithSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration() Adds a RIGHT JOIN clause and with to the query using the SpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration relation
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery innerJoinWithSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration() Adds a INNER JOIN clause and with to the query using the SpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration relation
 *
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery leftJoinSpyDynamicEntityConfigurationRelationFieldMapping($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyDynamicEntityConfigurationRelationFieldMapping relation
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery rightJoinSpyDynamicEntityConfigurationRelationFieldMapping($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyDynamicEntityConfigurationRelationFieldMapping relation
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery innerJoinSpyDynamicEntityConfigurationRelationFieldMapping($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyDynamicEntityConfigurationRelationFieldMapping relation
 *
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery joinWithSpyDynamicEntityConfigurationRelationFieldMapping($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyDynamicEntityConfigurationRelationFieldMapping relation
 *
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery leftJoinWithSpyDynamicEntityConfigurationRelationFieldMapping() Adds a LEFT JOIN clause and with to the query using the SpyDynamicEntityConfigurationRelationFieldMapping relation
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery rightJoinWithSpyDynamicEntityConfigurationRelationFieldMapping() Adds a RIGHT JOIN clause and with to the query using the SpyDynamicEntityConfigurationRelationFieldMapping relation
 * @method     ChildSpyDynamicEntityConfigurationRelationQuery innerJoinWithSpyDynamicEntityConfigurationRelationFieldMapping() Adds a INNER JOIN clause and with to the query using the SpyDynamicEntityConfigurationRelationFieldMapping relation
 *
 * @method     \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationQuery|\Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationQuery|\Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationFieldMappingQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyDynamicEntityConfigurationRelation|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyDynamicEntityConfigurationRelation matching the query
 * @method     ChildSpyDynamicEntityConfigurationRelation findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyDynamicEntityConfigurationRelation matching the query, or a new ChildSpyDynamicEntityConfigurationRelation object populated from the query conditions when no match is found
 *
 * @method     ChildSpyDynamicEntityConfigurationRelation|null findOneByIdDynamicEntityConfigurationRelation(int $id_dynamic_entity_configuration_relation) Return the first ChildSpyDynamicEntityConfigurationRelation filtered by the id_dynamic_entity_configuration_relation column
 * @method     ChildSpyDynamicEntityConfigurationRelation|null findOneByFkParentDynamicEntityConfiguration(int $fk_parent_dynamic_entity_configuration) Return the first ChildSpyDynamicEntityConfigurationRelation filtered by the fk_parent_dynamic_entity_configuration column
 * @method     ChildSpyDynamicEntityConfigurationRelation|null findOneByFkChildDynamicEntityConfiguration(int $fk_child_dynamic_entity_configuration) Return the first ChildSpyDynamicEntityConfigurationRelation filtered by the fk_child_dynamic_entity_configuration column
 * @method     ChildSpyDynamicEntityConfigurationRelation|null findOneByName(string $name) Return the first ChildSpyDynamicEntityConfigurationRelation filtered by the name column
 * @method     ChildSpyDynamicEntityConfigurationRelation|null findOneByIsEditable(boolean $is_editable) Return the first ChildSpyDynamicEntityConfigurationRelation filtered by the is_editable column
 *
 * @method     ChildSpyDynamicEntityConfigurationRelation requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyDynamicEntityConfigurationRelation by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDynamicEntityConfigurationRelation requireOne(?ConnectionInterface $con = null) Return the first ChildSpyDynamicEntityConfigurationRelation matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyDynamicEntityConfigurationRelation requireOneByIdDynamicEntityConfigurationRelation(int $id_dynamic_entity_configuration_relation) Return the first ChildSpyDynamicEntityConfigurationRelation filtered by the id_dynamic_entity_configuration_relation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDynamicEntityConfigurationRelation requireOneByFkParentDynamicEntityConfiguration(int $fk_parent_dynamic_entity_configuration) Return the first ChildSpyDynamicEntityConfigurationRelation filtered by the fk_parent_dynamic_entity_configuration column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDynamicEntityConfigurationRelation requireOneByFkChildDynamicEntityConfiguration(int $fk_child_dynamic_entity_configuration) Return the first ChildSpyDynamicEntityConfigurationRelation filtered by the fk_child_dynamic_entity_configuration column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDynamicEntityConfigurationRelation requireOneByName(string $name) Return the first ChildSpyDynamicEntityConfigurationRelation filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDynamicEntityConfigurationRelation requireOneByIsEditable(boolean $is_editable) Return the first ChildSpyDynamicEntityConfigurationRelation filtered by the is_editable column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyDynamicEntityConfigurationRelation[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyDynamicEntityConfigurationRelation objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyDynamicEntityConfigurationRelation> find(?ConnectionInterface $con = null) Return ChildSpyDynamicEntityConfigurationRelation objects based on current ModelCriteria
 *
 * @method     ChildSpyDynamicEntityConfigurationRelation[]|Collection findByIdDynamicEntityConfigurationRelation(int|array<int> $id_dynamic_entity_configuration_relation) Return ChildSpyDynamicEntityConfigurationRelation objects filtered by the id_dynamic_entity_configuration_relation column
 * @psalm-method Collection&\Traversable<ChildSpyDynamicEntityConfigurationRelation> findByIdDynamicEntityConfigurationRelation(int|array<int> $id_dynamic_entity_configuration_relation) Return ChildSpyDynamicEntityConfigurationRelation objects filtered by the id_dynamic_entity_configuration_relation column
 * @method     ChildSpyDynamicEntityConfigurationRelation[]|Collection findByFkParentDynamicEntityConfiguration(int|array<int> $fk_parent_dynamic_entity_configuration) Return ChildSpyDynamicEntityConfigurationRelation objects filtered by the fk_parent_dynamic_entity_configuration column
 * @psalm-method Collection&\Traversable<ChildSpyDynamicEntityConfigurationRelation> findByFkParentDynamicEntityConfiguration(int|array<int> $fk_parent_dynamic_entity_configuration) Return ChildSpyDynamicEntityConfigurationRelation objects filtered by the fk_parent_dynamic_entity_configuration column
 * @method     ChildSpyDynamicEntityConfigurationRelation[]|Collection findByFkChildDynamicEntityConfiguration(int|array<int> $fk_child_dynamic_entity_configuration) Return ChildSpyDynamicEntityConfigurationRelation objects filtered by the fk_child_dynamic_entity_configuration column
 * @psalm-method Collection&\Traversable<ChildSpyDynamicEntityConfigurationRelation> findByFkChildDynamicEntityConfiguration(int|array<int> $fk_child_dynamic_entity_configuration) Return ChildSpyDynamicEntityConfigurationRelation objects filtered by the fk_child_dynamic_entity_configuration column
 * @method     ChildSpyDynamicEntityConfigurationRelation[]|Collection findByName(string|array<string> $name) Return ChildSpyDynamicEntityConfigurationRelation objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildSpyDynamicEntityConfigurationRelation> findByName(string|array<string> $name) Return ChildSpyDynamicEntityConfigurationRelation objects filtered by the name column
 * @method     ChildSpyDynamicEntityConfigurationRelation[]|Collection findByIsEditable(boolean|array<boolean> $is_editable) Return ChildSpyDynamicEntityConfigurationRelation objects filtered by the is_editable column
 * @psalm-method Collection&\Traversable<ChildSpyDynamicEntityConfigurationRelation> findByIsEditable(boolean|array<boolean> $is_editable) Return ChildSpyDynamicEntityConfigurationRelation objects filtered by the is_editable column
 *
 * @method     ChildSpyDynamicEntityConfigurationRelation[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyDynamicEntityConfigurationRelation> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyDynamicEntityConfigurationRelationQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\DynamicEntity\Persistence\Base\SpyDynamicEntityConfigurationRelationQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\DynamicEntity\\Persistence\\SpyDynamicEntityConfigurationRelation', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyDynamicEntityConfigurationRelationQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyDynamicEntityConfigurationRelationQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyDynamicEntityConfigurationRelationQuery) {
            return $criteria;
        }
        $query = new ChildSpyDynamicEntityConfigurationRelationQuery();
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
     * @return ChildSpyDynamicEntityConfigurationRelation|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyDynamicEntityConfigurationRelationTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyDynamicEntityConfigurationRelation A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_dynamic_entity_configuration_relation, fk_parent_dynamic_entity_configuration, fk_child_dynamic_entity_configuration, name, is_editable FROM spy_dynamic_entity_configuration_relation WHERE id_dynamic_entity_configuration_relation = :p0';
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
            /** @var ChildSpyDynamicEntityConfigurationRelation $obj */
            $obj = new ChildSpyDynamicEntityConfigurationRelation();
            $obj->hydrate($row);
            SpyDynamicEntityConfigurationRelationTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyDynamicEntityConfigurationRelation|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyDynamicEntityConfigurationRelationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyDynamicEntityConfigurationRelationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idDynamicEntityConfigurationRelation Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdDynamicEntityConfigurationRelation_Between(array $idDynamicEntityConfigurationRelation)
    {
        return $this->filterByIdDynamicEntityConfigurationRelation($idDynamicEntityConfigurationRelation, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idDynamicEntityConfigurationRelations Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdDynamicEntityConfigurationRelation_In(array $idDynamicEntityConfigurationRelations)
    {
        return $this->filterByIdDynamicEntityConfigurationRelation($idDynamicEntityConfigurationRelations, Criteria::IN);
    }

    /**
     * Filter the query on the id_dynamic_entity_configuration_relation column
     *
     * Example usage:
     * <code>
     * $query->filterByIdDynamicEntityConfigurationRelation(1234); // WHERE id_dynamic_entity_configuration_relation = 1234
     * $query->filterByIdDynamicEntityConfigurationRelation(array(12, 34), Criteria::IN); // WHERE id_dynamic_entity_configuration_relation IN (12, 34)
     * $query->filterByIdDynamicEntityConfigurationRelation(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_dynamic_entity_configuration_relation > 12
     * </code>
     *
     * @param     mixed $idDynamicEntityConfigurationRelation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdDynamicEntityConfigurationRelation($idDynamicEntityConfigurationRelation = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idDynamicEntityConfigurationRelation)) {
            $useMinMax = false;
            if (isset($idDynamicEntityConfigurationRelation['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDynamicEntityConfigurationRelationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION, $idDynamicEntityConfigurationRelation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idDynamicEntityConfigurationRelation['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDynamicEntityConfigurationRelationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION, $idDynamicEntityConfigurationRelation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idDynamicEntityConfigurationRelation of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyDynamicEntityConfigurationRelationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION, $idDynamicEntityConfigurationRelation, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkParentDynamicEntityConfiguration Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkParentDynamicEntityConfiguration_Between(array $fkParentDynamicEntityConfiguration)
    {
        return $this->filterByFkParentDynamicEntityConfiguration($fkParentDynamicEntityConfiguration, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkParentDynamicEntityConfigurations Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkParentDynamicEntityConfiguration_In(array $fkParentDynamicEntityConfigurations)
    {
        return $this->filterByFkParentDynamicEntityConfiguration($fkParentDynamicEntityConfigurations, Criteria::IN);
    }

    /**
     * Filter the query on the fk_parent_dynamic_entity_configuration column
     *
     * Example usage:
     * <code>
     * $query->filterByFkParentDynamicEntityConfiguration(1234); // WHERE fk_parent_dynamic_entity_configuration = 1234
     * $query->filterByFkParentDynamicEntityConfiguration(array(12, 34), Criteria::IN); // WHERE fk_parent_dynamic_entity_configuration IN (12, 34)
     * $query->filterByFkParentDynamicEntityConfiguration(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_parent_dynamic_entity_configuration > 12
     * </code>
     *
     * @see       filterBySpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration()
     *
     * @param     mixed $fkParentDynamicEntityConfiguration The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkParentDynamicEntityConfiguration($fkParentDynamicEntityConfiguration = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkParentDynamicEntityConfiguration)) {
            $useMinMax = false;
            if (isset($fkParentDynamicEntityConfiguration['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDynamicEntityConfigurationRelationTableMap::COL_FK_PARENT_DYNAMIC_ENTITY_CONFIGURATION, $fkParentDynamicEntityConfiguration['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkParentDynamicEntityConfiguration['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDynamicEntityConfigurationRelationTableMap::COL_FK_PARENT_DYNAMIC_ENTITY_CONFIGURATION, $fkParentDynamicEntityConfiguration['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkParentDynamicEntityConfiguration of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyDynamicEntityConfigurationRelationTableMap::COL_FK_PARENT_DYNAMIC_ENTITY_CONFIGURATION, $fkParentDynamicEntityConfiguration, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkChildDynamicEntityConfiguration Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkChildDynamicEntityConfiguration_Between(array $fkChildDynamicEntityConfiguration)
    {
        return $this->filterByFkChildDynamicEntityConfiguration($fkChildDynamicEntityConfiguration, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkChildDynamicEntityConfigurations Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkChildDynamicEntityConfiguration_In(array $fkChildDynamicEntityConfigurations)
    {
        return $this->filterByFkChildDynamicEntityConfiguration($fkChildDynamicEntityConfigurations, Criteria::IN);
    }

    /**
     * Filter the query on the fk_child_dynamic_entity_configuration column
     *
     * Example usage:
     * <code>
     * $query->filterByFkChildDynamicEntityConfiguration(1234); // WHERE fk_child_dynamic_entity_configuration = 1234
     * $query->filterByFkChildDynamicEntityConfiguration(array(12, 34), Criteria::IN); // WHERE fk_child_dynamic_entity_configuration IN (12, 34)
     * $query->filterByFkChildDynamicEntityConfiguration(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_child_dynamic_entity_configuration > 12
     * </code>
     *
     * @see       filterBySpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration()
     *
     * @param     mixed $fkChildDynamicEntityConfiguration The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkChildDynamicEntityConfiguration($fkChildDynamicEntityConfiguration = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkChildDynamicEntityConfiguration)) {
            $useMinMax = false;
            if (isset($fkChildDynamicEntityConfiguration['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDynamicEntityConfigurationRelationTableMap::COL_FK_CHILD_DYNAMIC_ENTITY_CONFIGURATION, $fkChildDynamicEntityConfiguration['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkChildDynamicEntityConfiguration['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDynamicEntityConfigurationRelationTableMap::COL_FK_CHILD_DYNAMIC_ENTITY_CONFIGURATION, $fkChildDynamicEntityConfiguration['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkChildDynamicEntityConfiguration of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyDynamicEntityConfigurationRelationTableMap::COL_FK_CHILD_DYNAMIC_ENTITY_CONFIGURATION, $fkChildDynamicEntityConfiguration, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $names Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByName_In(array $names)
    {
        return $this->filterByName($names, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $name Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByName_Like($name)
    {
        return $this->filterByName($name, Criteria::LIKE);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * $query->filterByName([1, 'foo'], Criteria::IN); // WHERE name IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByName($name = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $name = str_replace('*', '%', $name);
        }

        if (is_array($name) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$name of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyDynamicEntityConfigurationRelationTableMap::COL_NAME, $name, $comparison);

        return $query;
    }

    /**
     * Filter the query on the is_editable column
     *
     * Example usage:
     * <code>
     * $query->filterByIsEditable(true); // WHERE is_editable = true
     * $query->filterByIsEditable('yes'); // WHERE is_editable = true
     * </code>
     *
     * @param     bool|string $isEditable The value to use as filter.
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
    public function filterByIsEditable($isEditable = null, $comparison = Criteria::EQUAL)
    {
        if (is_string($isEditable)) {
            $isEditable = in_array(strtolower($isEditable), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $query = $this->addUsingAlias(SpyDynamicEntityConfigurationRelationTableMap::COL_IS_EDITABLE, $isEditable, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfiguration object
     *
     * @param \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfiguration|ObjectCollection $spyDynamicEntityConfiguration The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration($spyDynamicEntityConfiguration, ?string $comparison = null)
    {
        if ($spyDynamicEntityConfiguration instanceof \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfiguration) {
            return $this
                ->addUsingAlias(SpyDynamicEntityConfigurationRelationTableMap::COL_FK_PARENT_DYNAMIC_ENTITY_CONFIGURATION, $spyDynamicEntityConfiguration->getIdDynamicEntityConfiguration(), $comparison);
        } elseif ($spyDynamicEntityConfiguration instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyDynamicEntityConfigurationRelationTableMap::COL_FK_PARENT_DYNAMIC_ENTITY_CONFIGURATION, $spyDynamicEntityConfiguration->toKeyValue('PrimaryKey', 'IdDynamicEntityConfiguration'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration() only accepts arguments of type \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfiguration or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration');

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
            $this->addJoinObject($join, 'SpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration');
        }

        return $this;
    }

    /**
     * Use the SpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration relation SpyDynamicEntityConfiguration object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationQuery A secondary query class using the current class as primary query
     */
    public function useSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfigurationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration', '\Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationQuery');
    }

    /**
     * Use the SpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration relation SpyDynamicEntityConfiguration object
     *
     * @param callable(\Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationQuery):\Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfigurationQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfigurationQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the SpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration relation to the SpyDynamicEntityConfiguration table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationQuery The inner query object of the EXISTS statement
     */
    public function useSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfigurationExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationQuery */
        $q = $this->useExistsQuery('SpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the SpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration relation to the SpyDynamicEntityConfiguration table for a NOT EXISTS query.
     *
     * @see useSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfigurationExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfigurationNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationQuery */
        $q = $this->useExistsQuery('SpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the SpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration relation to the SpyDynamicEntityConfiguration table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationQuery The inner query object of the IN statement
     */
    public function useInSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfigurationQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationQuery */
        $q = $this->useInQuery('SpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the SpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration relation to the SpyDynamicEntityConfiguration table for a NOT IN query.
     *
     * @see useSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfigurationInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfigurationQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationQuery */
        $q = $this->useInQuery('SpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfiguration object
     *
     * @param \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfiguration|ObjectCollection $spyDynamicEntityConfiguration The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration($spyDynamicEntityConfiguration, ?string $comparison = null)
    {
        if ($spyDynamicEntityConfiguration instanceof \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfiguration) {
            return $this
                ->addUsingAlias(SpyDynamicEntityConfigurationRelationTableMap::COL_FK_CHILD_DYNAMIC_ENTITY_CONFIGURATION, $spyDynamicEntityConfiguration->getIdDynamicEntityConfiguration(), $comparison);
        } elseif ($spyDynamicEntityConfiguration instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyDynamicEntityConfigurationRelationTableMap::COL_FK_CHILD_DYNAMIC_ENTITY_CONFIGURATION, $spyDynamicEntityConfiguration->toKeyValue('PrimaryKey', 'IdDynamicEntityConfiguration'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration() only accepts arguments of type \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfiguration or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration');

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
            $this->addJoinObject($join, 'SpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration');
        }

        return $this;
    }

    /**
     * Use the SpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration relation SpyDynamicEntityConfiguration object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationQuery A secondary query class using the current class as primary query
     */
    public function useSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfigurationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration', '\Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationQuery');
    }

    /**
     * Use the SpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration relation SpyDynamicEntityConfiguration object
     *
     * @param callable(\Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationQuery):\Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfigurationQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfigurationQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the SpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration relation to the SpyDynamicEntityConfiguration table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationQuery The inner query object of the EXISTS statement
     */
    public function useSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfigurationExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationQuery */
        $q = $this->useExistsQuery('SpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the SpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration relation to the SpyDynamicEntityConfiguration table for a NOT EXISTS query.
     *
     * @see useSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfigurationExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfigurationNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationQuery */
        $q = $this->useExistsQuery('SpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the SpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration relation to the SpyDynamicEntityConfiguration table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationQuery The inner query object of the IN statement
     */
    public function useInSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfigurationQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationQuery */
        $q = $this->useInQuery('SpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the SpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration relation to the SpyDynamicEntityConfiguration table for a NOT IN query.
     *
     * @see useSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfigurationInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfigurationQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationQuery */
        $q = $this->useInQuery('SpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationFieldMapping object
     *
     * @param \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationFieldMapping|ObjectCollection $spyDynamicEntityConfigurationRelationFieldMapping the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyDynamicEntityConfigurationRelationFieldMapping($spyDynamicEntityConfigurationRelationFieldMapping, ?string $comparison = null)
    {
        if ($spyDynamicEntityConfigurationRelationFieldMapping instanceof \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationFieldMapping) {
            $this
                ->addUsingAlias(SpyDynamicEntityConfigurationRelationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION, $spyDynamicEntityConfigurationRelationFieldMapping->getFkDynamicEntityConfigurationRelation(), $comparison);

            return $this;
        } elseif ($spyDynamicEntityConfigurationRelationFieldMapping instanceof ObjectCollection) {
            $this
                ->useSpyDynamicEntityConfigurationRelationFieldMappingQuery()
                ->filterByPrimaryKeys($spyDynamicEntityConfigurationRelationFieldMapping->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyDynamicEntityConfigurationRelationFieldMapping() only accepts arguments of type \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationFieldMapping or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyDynamicEntityConfigurationRelationFieldMapping relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyDynamicEntityConfigurationRelationFieldMapping(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyDynamicEntityConfigurationRelationFieldMapping');

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
            $this->addJoinObject($join, 'SpyDynamicEntityConfigurationRelationFieldMapping');
        }

        return $this;
    }

    /**
     * Use the SpyDynamicEntityConfigurationRelationFieldMapping relation SpyDynamicEntityConfigurationRelationFieldMapping object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationFieldMappingQuery A secondary query class using the current class as primary query
     */
    public function useSpyDynamicEntityConfigurationRelationFieldMappingQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyDynamicEntityConfigurationRelationFieldMapping($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyDynamicEntityConfigurationRelationFieldMapping', '\Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationFieldMappingQuery');
    }

    /**
     * Use the SpyDynamicEntityConfigurationRelationFieldMapping relation SpyDynamicEntityConfigurationRelationFieldMapping object
     *
     * @param callable(\Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationFieldMappingQuery):\Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationFieldMappingQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyDynamicEntityConfigurationRelationFieldMappingQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyDynamicEntityConfigurationRelationFieldMappingQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyDynamicEntityConfigurationRelationFieldMapping table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationFieldMappingQuery The inner query object of the EXISTS statement
     */
    public function useSpyDynamicEntityConfigurationRelationFieldMappingExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationFieldMappingQuery */
        $q = $this->useExistsQuery('SpyDynamicEntityConfigurationRelationFieldMapping', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyDynamicEntityConfigurationRelationFieldMapping table for a NOT EXISTS query.
     *
     * @see useSpyDynamicEntityConfigurationRelationFieldMappingExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationFieldMappingQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyDynamicEntityConfigurationRelationFieldMappingNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationFieldMappingQuery */
        $q = $this->useExistsQuery('SpyDynamicEntityConfigurationRelationFieldMapping', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyDynamicEntityConfigurationRelationFieldMapping table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationFieldMappingQuery The inner query object of the IN statement
     */
    public function useInSpyDynamicEntityConfigurationRelationFieldMappingQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationFieldMappingQuery */
        $q = $this->useInQuery('SpyDynamicEntityConfigurationRelationFieldMapping', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyDynamicEntityConfigurationRelationFieldMapping table for a NOT IN query.
     *
     * @see useSpyDynamicEntityConfigurationRelationFieldMappingInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationFieldMappingQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyDynamicEntityConfigurationRelationFieldMappingQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationFieldMappingQuery */
        $q = $this->useInQuery('SpyDynamicEntityConfigurationRelationFieldMapping', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyDynamicEntityConfigurationRelation $spyDynamicEntityConfigurationRelation Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyDynamicEntityConfigurationRelation = null)
    {
        if ($spyDynamicEntityConfigurationRelation) {
            $this->addUsingAlias(SpyDynamicEntityConfigurationRelationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION, $spyDynamicEntityConfigurationRelation->getIdDynamicEntityConfigurationRelation(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_dynamic_entity_configuration_relation table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyDynamicEntityConfigurationRelationTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyDynamicEntityConfigurationRelationTableMap::clearInstancePool();
            SpyDynamicEntityConfigurationRelationTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyDynamicEntityConfigurationRelationTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyDynamicEntityConfigurationRelationTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyDynamicEntityConfigurationRelationTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyDynamicEntityConfigurationRelationTableMap::clearRelatedInstancePool();

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
