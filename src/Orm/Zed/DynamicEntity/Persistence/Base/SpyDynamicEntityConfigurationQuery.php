<?php

namespace Orm\Zed\DynamicEntity\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfiguration as ChildSpyDynamicEntityConfiguration;
use Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationQuery as ChildSpyDynamicEntityConfigurationQuery;
use Orm\Zed\DynamicEntity\Persistence\Map\SpyDynamicEntityConfigurationTableMap;
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
 * Base class that represents a query for the `spy_dynamic_entity_configuration` table.
 *
 * @method     ChildSpyDynamicEntityConfigurationQuery orderByIdDynamicEntityConfiguration($order = Criteria::ASC) Order by the id_dynamic_entity_configuration column
 * @method     ChildSpyDynamicEntityConfigurationQuery orderByTableAlias($order = Criteria::ASC) Order by the table_alias column
 * @method     ChildSpyDynamicEntityConfigurationQuery orderByTableName($order = Criteria::ASC) Order by the table_name column
 * @method     ChildSpyDynamicEntityConfigurationQuery orderByIsActive($order = Criteria::ASC) Order by the is_active column
 * @method     ChildSpyDynamicEntityConfigurationQuery orderByDefinition($order = Criteria::ASC) Order by the definition column
 * @method     ChildSpyDynamicEntityConfigurationQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method     ChildSpyDynamicEntityConfigurationQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpyDynamicEntityConfigurationQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpyDynamicEntityConfigurationQuery groupByIdDynamicEntityConfiguration() Group by the id_dynamic_entity_configuration column
 * @method     ChildSpyDynamicEntityConfigurationQuery groupByTableAlias() Group by the table_alias column
 * @method     ChildSpyDynamicEntityConfigurationQuery groupByTableName() Group by the table_name column
 * @method     ChildSpyDynamicEntityConfigurationQuery groupByIsActive() Group by the is_active column
 * @method     ChildSpyDynamicEntityConfigurationQuery groupByDefinition() Group by the definition column
 * @method     ChildSpyDynamicEntityConfigurationQuery groupByType() Group by the type column
 * @method     ChildSpyDynamicEntityConfigurationQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpyDynamicEntityConfigurationQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpyDynamicEntityConfigurationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyDynamicEntityConfigurationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyDynamicEntityConfigurationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyDynamicEntityConfigurationQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyDynamicEntityConfigurationQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyDynamicEntityConfigurationQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyDynamicEntityConfigurationQuery leftJoinSpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration relation
 * @method     ChildSpyDynamicEntityConfigurationQuery rightJoinSpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration relation
 * @method     ChildSpyDynamicEntityConfigurationQuery innerJoinSpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration relation
 *
 * @method     ChildSpyDynamicEntityConfigurationQuery joinWithSpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration relation
 *
 * @method     ChildSpyDynamicEntityConfigurationQuery leftJoinWithSpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration() Adds a LEFT JOIN clause and with to the query using the SpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration relation
 * @method     ChildSpyDynamicEntityConfigurationQuery rightJoinWithSpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration() Adds a RIGHT JOIN clause and with to the query using the SpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration relation
 * @method     ChildSpyDynamicEntityConfigurationQuery innerJoinWithSpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration() Adds a INNER JOIN clause and with to the query using the SpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration relation
 *
 * @method     ChildSpyDynamicEntityConfigurationQuery leftJoinSpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration relation
 * @method     ChildSpyDynamicEntityConfigurationQuery rightJoinSpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration relation
 * @method     ChildSpyDynamicEntityConfigurationQuery innerJoinSpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration relation
 *
 * @method     ChildSpyDynamicEntityConfigurationQuery joinWithSpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration relation
 *
 * @method     ChildSpyDynamicEntityConfigurationQuery leftJoinWithSpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration() Adds a LEFT JOIN clause and with to the query using the SpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration relation
 * @method     ChildSpyDynamicEntityConfigurationQuery rightJoinWithSpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration() Adds a RIGHT JOIN clause and with to the query using the SpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration relation
 * @method     ChildSpyDynamicEntityConfigurationQuery innerJoinWithSpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration() Adds a INNER JOIN clause and with to the query using the SpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration relation
 *
 * @method     \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery|\Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyDynamicEntityConfiguration|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyDynamicEntityConfiguration matching the query
 * @method     ChildSpyDynamicEntityConfiguration findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyDynamicEntityConfiguration matching the query, or a new ChildSpyDynamicEntityConfiguration object populated from the query conditions when no match is found
 *
 * @method     ChildSpyDynamicEntityConfiguration|null findOneByIdDynamicEntityConfiguration(int $id_dynamic_entity_configuration) Return the first ChildSpyDynamicEntityConfiguration filtered by the id_dynamic_entity_configuration column
 * @method     ChildSpyDynamicEntityConfiguration|null findOneByTableAlias(string $table_alias) Return the first ChildSpyDynamicEntityConfiguration filtered by the table_alias column
 * @method     ChildSpyDynamicEntityConfiguration|null findOneByTableName(string $table_name) Return the first ChildSpyDynamicEntityConfiguration filtered by the table_name column
 * @method     ChildSpyDynamicEntityConfiguration|null findOneByIsActive(boolean $is_active) Return the first ChildSpyDynamicEntityConfiguration filtered by the is_active column
 * @method     ChildSpyDynamicEntityConfiguration|null findOneByDefinition(string $definition) Return the first ChildSpyDynamicEntityConfiguration filtered by the definition column
 * @method     ChildSpyDynamicEntityConfiguration|null findOneByType(string $type) Return the first ChildSpyDynamicEntityConfiguration filtered by the type column
 * @method     ChildSpyDynamicEntityConfiguration|null findOneByCreatedAt(string $created_at) Return the first ChildSpyDynamicEntityConfiguration filtered by the created_at column
 * @method     ChildSpyDynamicEntityConfiguration|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpyDynamicEntityConfiguration filtered by the updated_at column
 *
 * @method     ChildSpyDynamicEntityConfiguration requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyDynamicEntityConfiguration by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDynamicEntityConfiguration requireOne(?ConnectionInterface $con = null) Return the first ChildSpyDynamicEntityConfiguration matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyDynamicEntityConfiguration requireOneByIdDynamicEntityConfiguration(int $id_dynamic_entity_configuration) Return the first ChildSpyDynamicEntityConfiguration filtered by the id_dynamic_entity_configuration column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDynamicEntityConfiguration requireOneByTableAlias(string $table_alias) Return the first ChildSpyDynamicEntityConfiguration filtered by the table_alias column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDynamicEntityConfiguration requireOneByTableName(string $table_name) Return the first ChildSpyDynamicEntityConfiguration filtered by the table_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDynamicEntityConfiguration requireOneByIsActive(boolean $is_active) Return the first ChildSpyDynamicEntityConfiguration filtered by the is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDynamicEntityConfiguration requireOneByDefinition(string $definition) Return the first ChildSpyDynamicEntityConfiguration filtered by the definition column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDynamicEntityConfiguration requireOneByType(string $type) Return the first ChildSpyDynamicEntityConfiguration filtered by the type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDynamicEntityConfiguration requireOneByCreatedAt(string $created_at) Return the first ChildSpyDynamicEntityConfiguration filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDynamicEntityConfiguration requireOneByUpdatedAt(string $updated_at) Return the first ChildSpyDynamicEntityConfiguration filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyDynamicEntityConfiguration[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyDynamicEntityConfiguration objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyDynamicEntityConfiguration> find(?ConnectionInterface $con = null) Return ChildSpyDynamicEntityConfiguration objects based on current ModelCriteria
 *
 * @method     ChildSpyDynamicEntityConfiguration[]|Collection findByIdDynamicEntityConfiguration(int|array<int> $id_dynamic_entity_configuration) Return ChildSpyDynamicEntityConfiguration objects filtered by the id_dynamic_entity_configuration column
 * @psalm-method Collection&\Traversable<ChildSpyDynamicEntityConfiguration> findByIdDynamicEntityConfiguration(int|array<int> $id_dynamic_entity_configuration) Return ChildSpyDynamicEntityConfiguration objects filtered by the id_dynamic_entity_configuration column
 * @method     ChildSpyDynamicEntityConfiguration[]|Collection findByTableAlias(string|array<string> $table_alias) Return ChildSpyDynamicEntityConfiguration objects filtered by the table_alias column
 * @psalm-method Collection&\Traversable<ChildSpyDynamicEntityConfiguration> findByTableAlias(string|array<string> $table_alias) Return ChildSpyDynamicEntityConfiguration objects filtered by the table_alias column
 * @method     ChildSpyDynamicEntityConfiguration[]|Collection findByTableName(string|array<string> $table_name) Return ChildSpyDynamicEntityConfiguration objects filtered by the table_name column
 * @psalm-method Collection&\Traversable<ChildSpyDynamicEntityConfiguration> findByTableName(string|array<string> $table_name) Return ChildSpyDynamicEntityConfiguration objects filtered by the table_name column
 * @method     ChildSpyDynamicEntityConfiguration[]|Collection findByIsActive(boolean|array<boolean> $is_active) Return ChildSpyDynamicEntityConfiguration objects filtered by the is_active column
 * @psalm-method Collection&\Traversable<ChildSpyDynamicEntityConfiguration> findByIsActive(boolean|array<boolean> $is_active) Return ChildSpyDynamicEntityConfiguration objects filtered by the is_active column
 * @method     ChildSpyDynamicEntityConfiguration[]|Collection findByDefinition(string|array<string> $definition) Return ChildSpyDynamicEntityConfiguration objects filtered by the definition column
 * @psalm-method Collection&\Traversable<ChildSpyDynamicEntityConfiguration> findByDefinition(string|array<string> $definition) Return ChildSpyDynamicEntityConfiguration objects filtered by the definition column
 * @method     ChildSpyDynamicEntityConfiguration[]|Collection findByType(string|array<string> $type) Return ChildSpyDynamicEntityConfiguration objects filtered by the type column
 * @psalm-method Collection&\Traversable<ChildSpyDynamicEntityConfiguration> findByType(string|array<string> $type) Return ChildSpyDynamicEntityConfiguration objects filtered by the type column
 * @method     ChildSpyDynamicEntityConfiguration[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpyDynamicEntityConfiguration objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpyDynamicEntityConfiguration> findByCreatedAt(string|array<string> $created_at) Return ChildSpyDynamicEntityConfiguration objects filtered by the created_at column
 * @method     ChildSpyDynamicEntityConfiguration[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyDynamicEntityConfiguration objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpyDynamicEntityConfiguration> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyDynamicEntityConfiguration objects filtered by the updated_at column
 *
 * @method     ChildSpyDynamicEntityConfiguration[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyDynamicEntityConfiguration> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyDynamicEntityConfigurationQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\DynamicEntity\Persistence\Base\SpyDynamicEntityConfigurationQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\DynamicEntity\\Persistence\\SpyDynamicEntityConfiguration', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyDynamicEntityConfigurationQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyDynamicEntityConfigurationQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyDynamicEntityConfigurationQuery) {
            return $criteria;
        }
        $query = new ChildSpyDynamicEntityConfigurationQuery();
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
     * @return ChildSpyDynamicEntityConfiguration|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyDynamicEntityConfigurationTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyDynamicEntityConfiguration A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_dynamic_entity_configuration, table_alias, table_name, is_active, definition, type, created_at, updated_at FROM spy_dynamic_entity_configuration WHERE id_dynamic_entity_configuration = :p0';
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
            /** @var ChildSpyDynamicEntityConfiguration $obj */
            $obj = new ChildSpyDynamicEntityConfiguration();
            $obj->hydrate($row);
            SpyDynamicEntityConfigurationTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyDynamicEntityConfiguration|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyDynamicEntityConfigurationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyDynamicEntityConfigurationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idDynamicEntityConfiguration Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdDynamicEntityConfiguration_Between(array $idDynamicEntityConfiguration)
    {
        return $this->filterByIdDynamicEntityConfiguration($idDynamicEntityConfiguration, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idDynamicEntityConfigurations Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdDynamicEntityConfiguration_In(array $idDynamicEntityConfigurations)
    {
        return $this->filterByIdDynamicEntityConfiguration($idDynamicEntityConfigurations, Criteria::IN);
    }

    /**
     * Filter the query on the id_dynamic_entity_configuration column
     *
     * Example usage:
     * <code>
     * $query->filterByIdDynamicEntityConfiguration(1234); // WHERE id_dynamic_entity_configuration = 1234
     * $query->filterByIdDynamicEntityConfiguration(array(12, 34), Criteria::IN); // WHERE id_dynamic_entity_configuration IN (12, 34)
     * $query->filterByIdDynamicEntityConfiguration(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_dynamic_entity_configuration > 12
     * </code>
     *
     * @param     mixed $idDynamicEntityConfiguration The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdDynamicEntityConfiguration($idDynamicEntityConfiguration = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idDynamicEntityConfiguration)) {
            $useMinMax = false;
            if (isset($idDynamicEntityConfiguration['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDynamicEntityConfigurationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION, $idDynamicEntityConfiguration['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idDynamicEntityConfiguration['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDynamicEntityConfigurationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION, $idDynamicEntityConfiguration['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idDynamicEntityConfiguration of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyDynamicEntityConfigurationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION, $idDynamicEntityConfiguration, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $tableAliass Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTableAlias_In(array $tableAliass)
    {
        return $this->filterByTableAlias($tableAliass, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $tableAlias Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTableAlias_Like($tableAlias)
    {
        return $this->filterByTableAlias($tableAlias, Criteria::LIKE);
    }

    /**
     * Filter the query on the table_alias column
     *
     * Example usage:
     * <code>
     * $query->filterByTableAlias('fooValue');   // WHERE table_alias = 'fooValue'
     * $query->filterByTableAlias('%fooValue%', Criteria::LIKE); // WHERE table_alias LIKE '%fooValue%'
     * $query->filterByTableAlias([1, 'foo'], Criteria::IN); // WHERE table_alias IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $tableAlias The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByTableAlias($tableAlias = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $tableAlias = str_replace('*', '%', $tableAlias);
        }

        if (is_array($tableAlias) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$tableAlias of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyDynamicEntityConfigurationTableMap::COL_TABLE_ALIAS, $tableAlias, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $tableNames Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTableName_In(array $tableNames)
    {
        return $this->filterByTableName($tableNames, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $tableName Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTableName_Like($tableName)
    {
        return $this->filterByTableName($tableName, Criteria::LIKE);
    }

    /**
     * Filter the query on the table_name column
     *
     * Example usage:
     * <code>
     * $query->filterByTableName('fooValue');   // WHERE table_name = 'fooValue'
     * $query->filterByTableName('%fooValue%', Criteria::LIKE); // WHERE table_name LIKE '%fooValue%'
     * $query->filterByTableName([1, 'foo'], Criteria::IN); // WHERE table_name IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $tableName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByTableName($tableName = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $tableName = str_replace('*', '%', $tableName);
        }

        if (is_array($tableName) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$tableName of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyDynamicEntityConfigurationTableMap::COL_TABLE_NAME, $tableName, $comparison);

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

        $query = $this->addUsingAlias(SpyDynamicEntityConfigurationTableMap::COL_IS_ACTIVE, $isActive, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $definitions Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDefinition_In(array $definitions)
    {
        return $this->filterByDefinition($definitions, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $definition Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDefinition_Like($definition)
    {
        return $this->filterByDefinition($definition, Criteria::LIKE);
    }

    /**
     * Filter the query on the definition column
     *
     * Example usage:
     * <code>
     * $query->filterByDefinition('fooValue');   // WHERE definition = 'fooValue'
     * $query->filterByDefinition('%fooValue%', Criteria::LIKE); // WHERE definition LIKE '%fooValue%'
     * $query->filterByDefinition([1, 'foo'], Criteria::IN); // WHERE definition IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $definition The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByDefinition($definition = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $definition = str_replace('*', '%', $definition);
        }

        if (is_array($definition) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$definition of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyDynamicEntityConfigurationTableMap::COL_DEFINITION, $definition, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $types Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByType_In(array $types)
    {
        return $this->filterByType($types, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $type Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByType_Like($type)
    {
        return $this->filterByType($type, Criteria::LIKE);
    }

    /**
     * Filter the query on the type column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE type = 'fooValue'
     * $query->filterByType('%fooValue%', Criteria::LIKE); // WHERE type LIKE '%fooValue%'
     * $query->filterByType([1, 'foo'], Criteria::IN); // WHERE type IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $type The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByType($type = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $type = str_replace('*', '%', $type);
        }

        if (is_array($type) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$type of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyDynamicEntityConfigurationTableMap::COL_TYPE, $type, $comparison);

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
                $this->addUsingAlias(SpyDynamicEntityConfigurationTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDynamicEntityConfigurationTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyDynamicEntityConfigurationTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SpyDynamicEntityConfigurationTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDynamicEntityConfigurationTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyDynamicEntityConfigurationTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelation object
     *
     * @param \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelation|ObjectCollection $spyDynamicEntityConfigurationRelation the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration($spyDynamicEntityConfigurationRelation, ?string $comparison = null)
    {
        if ($spyDynamicEntityConfigurationRelation instanceof \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelation) {
            $this
                ->addUsingAlias(SpyDynamicEntityConfigurationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION, $spyDynamicEntityConfigurationRelation->getFkParentDynamicEntityConfiguration(), $comparison);

            return $this;
        } elseif ($spyDynamicEntityConfigurationRelation instanceof ObjectCollection) {
            $this
                ->useSpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfigurationQuery()
                ->filterByPrimaryKeys($spyDynamicEntityConfigurationRelation->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration() only accepts arguments of type \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration');

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
            $this->addJoinObject($join, 'SpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration');
        }

        return $this;
    }

    /**
     * Use the SpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration relation SpyDynamicEntityConfigurationRelation object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery A secondary query class using the current class as primary query
     */
    public function useSpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfigurationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration', '\Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery');
    }

    /**
     * Use the SpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration relation SpyDynamicEntityConfigurationRelation object
     *
     * @param callable(\Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery):\Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfigurationQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfigurationQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the SpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration relation to the SpyDynamicEntityConfigurationRelation table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery The inner query object of the EXISTS statement
     */
    public function useSpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfigurationExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery */
        $q = $this->useExistsQuery('SpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the SpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration relation to the SpyDynamicEntityConfigurationRelation table for a NOT EXISTS query.
     *
     * @see useSpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfigurationExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfigurationNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery */
        $q = $this->useExistsQuery('SpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the SpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration relation to the SpyDynamicEntityConfigurationRelation table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery The inner query object of the IN statement
     */
    public function useInSpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfigurationQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery */
        $q = $this->useInQuery('SpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the SpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration relation to the SpyDynamicEntityConfigurationRelation table for a NOT IN query.
     *
     * @see useSpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfigurationInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfigurationQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery */
        $q = $this->useInQuery('SpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelation object
     *
     * @param \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelation|ObjectCollection $spyDynamicEntityConfigurationRelation the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration($spyDynamicEntityConfigurationRelation, ?string $comparison = null)
    {
        if ($spyDynamicEntityConfigurationRelation instanceof \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelation) {
            $this
                ->addUsingAlias(SpyDynamicEntityConfigurationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION, $spyDynamicEntityConfigurationRelation->getFkChildDynamicEntityConfiguration(), $comparison);

            return $this;
        } elseif ($spyDynamicEntityConfigurationRelation instanceof ObjectCollection) {
            $this
                ->useSpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfigurationQuery()
                ->filterByPrimaryKeys($spyDynamicEntityConfigurationRelation->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration() only accepts arguments of type \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration');

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
            $this->addJoinObject($join, 'SpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration');
        }

        return $this;
    }

    /**
     * Use the SpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration relation SpyDynamicEntityConfigurationRelation object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery A secondary query class using the current class as primary query
     */
    public function useSpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfigurationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration', '\Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery');
    }

    /**
     * Use the SpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration relation SpyDynamicEntityConfigurationRelation object
     *
     * @param callable(\Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery):\Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfigurationQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfigurationQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the SpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration relation to the SpyDynamicEntityConfigurationRelation table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery The inner query object of the EXISTS statement
     */
    public function useSpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfigurationExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery */
        $q = $this->useExistsQuery('SpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the SpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration relation to the SpyDynamicEntityConfigurationRelation table for a NOT EXISTS query.
     *
     * @see useSpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfigurationExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfigurationNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery */
        $q = $this->useExistsQuery('SpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the SpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration relation to the SpyDynamicEntityConfigurationRelation table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery The inner query object of the IN statement
     */
    public function useInSpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfigurationQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery */
        $q = $this->useInQuery('SpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the SpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration relation to the SpyDynamicEntityConfigurationRelation table for a NOT IN query.
     *
     * @see useSpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfigurationInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfigurationQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery */
        $q = $this->useInQuery('SpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyDynamicEntityConfiguration $spyDynamicEntityConfiguration Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyDynamicEntityConfiguration = null)
    {
        if ($spyDynamicEntityConfiguration) {
            $this->addUsingAlias(SpyDynamicEntityConfigurationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION, $spyDynamicEntityConfiguration->getIdDynamicEntityConfiguration(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_dynamic_entity_configuration table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyDynamicEntityConfigurationTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyDynamicEntityConfigurationTableMap::clearInstancePool();
            SpyDynamicEntityConfigurationTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyDynamicEntityConfigurationTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyDynamicEntityConfigurationTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyDynamicEntityConfigurationTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyDynamicEntityConfigurationTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(SpyDynamicEntityConfigurationTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyDynamicEntityConfigurationTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyDynamicEntityConfigurationTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyDynamicEntityConfigurationTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpyDynamicEntityConfigurationTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyDynamicEntityConfigurationTableMap::COL_CREATED_AT);

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
