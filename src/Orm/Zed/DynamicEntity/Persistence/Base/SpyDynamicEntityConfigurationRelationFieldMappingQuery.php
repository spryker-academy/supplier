<?php

namespace Orm\Zed\DynamicEntity\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationFieldMapping as ChildSpyDynamicEntityConfigurationRelationFieldMapping;
use Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationFieldMappingQuery as ChildSpyDynamicEntityConfigurationRelationFieldMappingQuery;
use Orm\Zed\DynamicEntity\Persistence\Map\SpyDynamicEntityConfigurationRelationFieldMappingTableMap;
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
 * Base class that represents a query for the `spy_dynamic_entity_configuration_relation_field_mapping` table.
 *
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMappingQuery orderByIdDynamicEntityConfigurationRelationFieldMapping($order = Criteria::ASC) Order by the id_dynamic_entity_configuration_relation_field_mapping column
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMappingQuery orderByFkDynamicEntityConfigurationRelation($order = Criteria::ASC) Order by the fk_dynamic_entity_configuration_relation column
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMappingQuery orderByChildFieldName($order = Criteria::ASC) Order by the child_field_name column
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMappingQuery orderByParentFieldName($order = Criteria::ASC) Order by the parent_field_name column
 *
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMappingQuery groupByIdDynamicEntityConfigurationRelationFieldMapping() Group by the id_dynamic_entity_configuration_relation_field_mapping column
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMappingQuery groupByFkDynamicEntityConfigurationRelation() Group by the fk_dynamic_entity_configuration_relation column
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMappingQuery groupByChildFieldName() Group by the child_field_name column
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMappingQuery groupByParentFieldName() Group by the parent_field_name column
 *
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMappingQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMappingQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMappingQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMappingQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMappingQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMappingQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMappingQuery leftJoinSpyDynamicEntityConfigurationRelation($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyDynamicEntityConfigurationRelation relation
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMappingQuery rightJoinSpyDynamicEntityConfigurationRelation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyDynamicEntityConfigurationRelation relation
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMappingQuery innerJoinSpyDynamicEntityConfigurationRelation($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyDynamicEntityConfigurationRelation relation
 *
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMappingQuery joinWithSpyDynamicEntityConfigurationRelation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyDynamicEntityConfigurationRelation relation
 *
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMappingQuery leftJoinWithSpyDynamicEntityConfigurationRelation() Adds a LEFT JOIN clause and with to the query using the SpyDynamicEntityConfigurationRelation relation
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMappingQuery rightJoinWithSpyDynamicEntityConfigurationRelation() Adds a RIGHT JOIN clause and with to the query using the SpyDynamicEntityConfigurationRelation relation
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMappingQuery innerJoinWithSpyDynamicEntityConfigurationRelation() Adds a INNER JOIN clause and with to the query using the SpyDynamicEntityConfigurationRelation relation
 *
 * @method     \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMapping|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyDynamicEntityConfigurationRelationFieldMapping matching the query
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMapping findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyDynamicEntityConfigurationRelationFieldMapping matching the query, or a new ChildSpyDynamicEntityConfigurationRelationFieldMapping object populated from the query conditions when no match is found
 *
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMapping|null findOneByIdDynamicEntityConfigurationRelationFieldMapping(int $id_dynamic_entity_configuration_relation_field_mapping) Return the first ChildSpyDynamicEntityConfigurationRelationFieldMapping filtered by the id_dynamic_entity_configuration_relation_field_mapping column
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMapping|null findOneByFkDynamicEntityConfigurationRelation(int $fk_dynamic_entity_configuration_relation) Return the first ChildSpyDynamicEntityConfigurationRelationFieldMapping filtered by the fk_dynamic_entity_configuration_relation column
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMapping|null findOneByChildFieldName(string $child_field_name) Return the first ChildSpyDynamicEntityConfigurationRelationFieldMapping filtered by the child_field_name column
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMapping|null findOneByParentFieldName(string $parent_field_name) Return the first ChildSpyDynamicEntityConfigurationRelationFieldMapping filtered by the parent_field_name column
 *
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMapping requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyDynamicEntityConfigurationRelationFieldMapping by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMapping requireOne(?ConnectionInterface $con = null) Return the first ChildSpyDynamicEntityConfigurationRelationFieldMapping matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMapping requireOneByIdDynamicEntityConfigurationRelationFieldMapping(int $id_dynamic_entity_configuration_relation_field_mapping) Return the first ChildSpyDynamicEntityConfigurationRelationFieldMapping filtered by the id_dynamic_entity_configuration_relation_field_mapping column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMapping requireOneByFkDynamicEntityConfigurationRelation(int $fk_dynamic_entity_configuration_relation) Return the first ChildSpyDynamicEntityConfigurationRelationFieldMapping filtered by the fk_dynamic_entity_configuration_relation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMapping requireOneByChildFieldName(string $child_field_name) Return the first ChildSpyDynamicEntityConfigurationRelationFieldMapping filtered by the child_field_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMapping requireOneByParentFieldName(string $parent_field_name) Return the first ChildSpyDynamicEntityConfigurationRelationFieldMapping filtered by the parent_field_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMapping[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyDynamicEntityConfigurationRelationFieldMapping objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyDynamicEntityConfigurationRelationFieldMapping> find(?ConnectionInterface $con = null) Return ChildSpyDynamicEntityConfigurationRelationFieldMapping objects based on current ModelCriteria
 *
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMapping[]|Collection findByIdDynamicEntityConfigurationRelationFieldMapping(int|array<int> $id_dynamic_entity_configuration_relation_field_mapping) Return ChildSpyDynamicEntityConfigurationRelationFieldMapping objects filtered by the id_dynamic_entity_configuration_relation_field_mapping column
 * @psalm-method Collection&\Traversable<ChildSpyDynamicEntityConfigurationRelationFieldMapping> findByIdDynamicEntityConfigurationRelationFieldMapping(int|array<int> $id_dynamic_entity_configuration_relation_field_mapping) Return ChildSpyDynamicEntityConfigurationRelationFieldMapping objects filtered by the id_dynamic_entity_configuration_relation_field_mapping column
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMapping[]|Collection findByFkDynamicEntityConfigurationRelation(int|array<int> $fk_dynamic_entity_configuration_relation) Return ChildSpyDynamicEntityConfigurationRelationFieldMapping objects filtered by the fk_dynamic_entity_configuration_relation column
 * @psalm-method Collection&\Traversable<ChildSpyDynamicEntityConfigurationRelationFieldMapping> findByFkDynamicEntityConfigurationRelation(int|array<int> $fk_dynamic_entity_configuration_relation) Return ChildSpyDynamicEntityConfigurationRelationFieldMapping objects filtered by the fk_dynamic_entity_configuration_relation column
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMapping[]|Collection findByChildFieldName(string|array<string> $child_field_name) Return ChildSpyDynamicEntityConfigurationRelationFieldMapping objects filtered by the child_field_name column
 * @psalm-method Collection&\Traversable<ChildSpyDynamicEntityConfigurationRelationFieldMapping> findByChildFieldName(string|array<string> $child_field_name) Return ChildSpyDynamicEntityConfigurationRelationFieldMapping objects filtered by the child_field_name column
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMapping[]|Collection findByParentFieldName(string|array<string> $parent_field_name) Return ChildSpyDynamicEntityConfigurationRelationFieldMapping objects filtered by the parent_field_name column
 * @psalm-method Collection&\Traversable<ChildSpyDynamicEntityConfigurationRelationFieldMapping> findByParentFieldName(string|array<string> $parent_field_name) Return ChildSpyDynamicEntityConfigurationRelationFieldMapping objects filtered by the parent_field_name column
 *
 * @method     ChildSpyDynamicEntityConfigurationRelationFieldMapping[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyDynamicEntityConfigurationRelationFieldMapping> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyDynamicEntityConfigurationRelationFieldMappingQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\DynamicEntity\Persistence\Base\SpyDynamicEntityConfigurationRelationFieldMappingQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\DynamicEntity\\Persistence\\SpyDynamicEntityConfigurationRelationFieldMapping', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyDynamicEntityConfigurationRelationFieldMappingQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyDynamicEntityConfigurationRelationFieldMappingQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyDynamicEntityConfigurationRelationFieldMappingQuery) {
            return $criteria;
        }
        $query = new ChildSpyDynamicEntityConfigurationRelationFieldMappingQuery();
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
     * @return ChildSpyDynamicEntityConfigurationRelationFieldMapping|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyDynamicEntityConfigurationRelationFieldMappingTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyDynamicEntityConfigurationRelationFieldMapping A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_dynamic_entity_configuration_relation_field_mapping, fk_dynamic_entity_configuration_relation, child_field_name, parent_field_name FROM spy_dynamic_entity_configuration_relation_field_mapping WHERE id_dynamic_entity_configuration_relation_field_mapping = :p0';
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
            /** @var ChildSpyDynamicEntityConfigurationRelationFieldMapping $obj */
            $obj = new ChildSpyDynamicEntityConfigurationRelationFieldMapping();
            $obj->hydrate($row);
            SpyDynamicEntityConfigurationRelationFieldMappingTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyDynamicEntityConfigurationRelationFieldMapping|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION_FIELD_MAPPING, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION_FIELD_MAPPING, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idDynamicEntityConfigurationRelationFieldMapping Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdDynamicEntityConfigurationRelationFieldMapping_Between(array $idDynamicEntityConfigurationRelationFieldMapping)
    {
        return $this->filterByIdDynamicEntityConfigurationRelationFieldMapping($idDynamicEntityConfigurationRelationFieldMapping, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idDynamicEntityConfigurationRelationFieldMappings Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdDynamicEntityConfigurationRelationFieldMapping_In(array $idDynamicEntityConfigurationRelationFieldMappings)
    {
        return $this->filterByIdDynamicEntityConfigurationRelationFieldMapping($idDynamicEntityConfigurationRelationFieldMappings, Criteria::IN);
    }

    /**
     * Filter the query on the id_dynamic_entity_configuration_relation_field_mapping column
     *
     * Example usage:
     * <code>
     * $query->filterByIdDynamicEntityConfigurationRelationFieldMapping(1234); // WHERE id_dynamic_entity_configuration_relation_field_mapping = 1234
     * $query->filterByIdDynamicEntityConfigurationRelationFieldMapping(array(12, 34), Criteria::IN); // WHERE id_dynamic_entity_configuration_relation_field_mapping IN (12, 34)
     * $query->filterByIdDynamicEntityConfigurationRelationFieldMapping(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_dynamic_entity_configuration_relation_field_mapping > 12
     * </code>
     *
     * @param     mixed $idDynamicEntityConfigurationRelationFieldMapping The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdDynamicEntityConfigurationRelationFieldMapping($idDynamicEntityConfigurationRelationFieldMapping = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idDynamicEntityConfigurationRelationFieldMapping)) {
            $useMinMax = false;
            if (isset($idDynamicEntityConfigurationRelationFieldMapping['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION_FIELD_MAPPING, $idDynamicEntityConfigurationRelationFieldMapping['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idDynamicEntityConfigurationRelationFieldMapping['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION_FIELD_MAPPING, $idDynamicEntityConfigurationRelationFieldMapping['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idDynamicEntityConfigurationRelationFieldMapping of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION_FIELD_MAPPING, $idDynamicEntityConfigurationRelationFieldMapping, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkDynamicEntityConfigurationRelation Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkDynamicEntityConfigurationRelation_Between(array $fkDynamicEntityConfigurationRelation)
    {
        return $this->filterByFkDynamicEntityConfigurationRelation($fkDynamicEntityConfigurationRelation, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkDynamicEntityConfigurationRelations Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkDynamicEntityConfigurationRelation_In(array $fkDynamicEntityConfigurationRelations)
    {
        return $this->filterByFkDynamicEntityConfigurationRelation($fkDynamicEntityConfigurationRelations, Criteria::IN);
    }

    /**
     * Filter the query on the fk_dynamic_entity_configuration_relation column
     *
     * Example usage:
     * <code>
     * $query->filterByFkDynamicEntityConfigurationRelation(1234); // WHERE fk_dynamic_entity_configuration_relation = 1234
     * $query->filterByFkDynamicEntityConfigurationRelation(array(12, 34), Criteria::IN); // WHERE fk_dynamic_entity_configuration_relation IN (12, 34)
     * $query->filterByFkDynamicEntityConfigurationRelation(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_dynamic_entity_configuration_relation > 12
     * </code>
     *
     * @see       filterBySpyDynamicEntityConfigurationRelation()
     *
     * @param     mixed $fkDynamicEntityConfigurationRelation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkDynamicEntityConfigurationRelation($fkDynamicEntityConfigurationRelation = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkDynamicEntityConfigurationRelation)) {
            $useMinMax = false;
            if (isset($fkDynamicEntityConfigurationRelation['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_FK_DYNAMIC_ENTITY_CONFIGURATION_RELATION, $fkDynamicEntityConfigurationRelation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkDynamicEntityConfigurationRelation['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_FK_DYNAMIC_ENTITY_CONFIGURATION_RELATION, $fkDynamicEntityConfigurationRelation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkDynamicEntityConfigurationRelation of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_FK_DYNAMIC_ENTITY_CONFIGURATION_RELATION, $fkDynamicEntityConfigurationRelation, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $childFieldNames Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByChildFieldName_In(array $childFieldNames)
    {
        return $this->filterByChildFieldName($childFieldNames, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $childFieldName Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByChildFieldName_Like($childFieldName)
    {
        return $this->filterByChildFieldName($childFieldName, Criteria::LIKE);
    }

    /**
     * Filter the query on the child_field_name column
     *
     * Example usage:
     * <code>
     * $query->filterByChildFieldName('fooValue');   // WHERE child_field_name = 'fooValue'
     * $query->filterByChildFieldName('%fooValue%', Criteria::LIKE); // WHERE child_field_name LIKE '%fooValue%'
     * $query->filterByChildFieldName([1, 'foo'], Criteria::IN); // WHERE child_field_name IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $childFieldName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByChildFieldName($childFieldName = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $childFieldName = str_replace('*', '%', $childFieldName);
        }

        if (is_array($childFieldName) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$childFieldName of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_CHILD_FIELD_NAME, $childFieldName, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $parentFieldNames Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByParentFieldName_In(array $parentFieldNames)
    {
        return $this->filterByParentFieldName($parentFieldNames, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $parentFieldName Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByParentFieldName_Like($parentFieldName)
    {
        return $this->filterByParentFieldName($parentFieldName, Criteria::LIKE);
    }

    /**
     * Filter the query on the parent_field_name column
     *
     * Example usage:
     * <code>
     * $query->filterByParentFieldName('fooValue');   // WHERE parent_field_name = 'fooValue'
     * $query->filterByParentFieldName('%fooValue%', Criteria::LIKE); // WHERE parent_field_name LIKE '%fooValue%'
     * $query->filterByParentFieldName([1, 'foo'], Criteria::IN); // WHERE parent_field_name IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $parentFieldName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByParentFieldName($parentFieldName = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $parentFieldName = str_replace('*', '%', $parentFieldName);
        }

        if (is_array($parentFieldName) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$parentFieldName of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_PARENT_FIELD_NAME, $parentFieldName, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelation object
     *
     * @param \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelation|ObjectCollection $spyDynamicEntityConfigurationRelation The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyDynamicEntityConfigurationRelation($spyDynamicEntityConfigurationRelation, ?string $comparison = null)
    {
        if ($spyDynamicEntityConfigurationRelation instanceof \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelation) {
            return $this
                ->addUsingAlias(SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_FK_DYNAMIC_ENTITY_CONFIGURATION_RELATION, $spyDynamicEntityConfigurationRelation->getIdDynamicEntityConfigurationRelation(), $comparison);
        } elseif ($spyDynamicEntityConfigurationRelation instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_FK_DYNAMIC_ENTITY_CONFIGURATION_RELATION, $spyDynamicEntityConfigurationRelation->toKeyValue('PrimaryKey', 'IdDynamicEntityConfigurationRelation'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyDynamicEntityConfigurationRelation() only accepts arguments of type \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyDynamicEntityConfigurationRelation relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyDynamicEntityConfigurationRelation(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyDynamicEntityConfigurationRelation');

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
            $this->addJoinObject($join, 'SpyDynamicEntityConfigurationRelation');
        }

        return $this;
    }

    /**
     * Use the SpyDynamicEntityConfigurationRelation relation SpyDynamicEntityConfigurationRelation object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery A secondary query class using the current class as primary query
     */
    public function useSpyDynamicEntityConfigurationRelationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyDynamicEntityConfigurationRelation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyDynamicEntityConfigurationRelation', '\Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery');
    }

    /**
     * Use the SpyDynamicEntityConfigurationRelation relation SpyDynamicEntityConfigurationRelation object
     *
     * @param callable(\Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery):\Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyDynamicEntityConfigurationRelationQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyDynamicEntityConfigurationRelationQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyDynamicEntityConfigurationRelation table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery The inner query object of the EXISTS statement
     */
    public function useSpyDynamicEntityConfigurationRelationExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery */
        $q = $this->useExistsQuery('SpyDynamicEntityConfigurationRelation', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyDynamicEntityConfigurationRelation table for a NOT EXISTS query.
     *
     * @see useSpyDynamicEntityConfigurationRelationExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyDynamicEntityConfigurationRelationNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery */
        $q = $this->useExistsQuery('SpyDynamicEntityConfigurationRelation', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyDynamicEntityConfigurationRelation table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery The inner query object of the IN statement
     */
    public function useInSpyDynamicEntityConfigurationRelationQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery */
        $q = $this->useInQuery('SpyDynamicEntityConfigurationRelation', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyDynamicEntityConfigurationRelation table for a NOT IN query.
     *
     * @see useSpyDynamicEntityConfigurationRelationInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyDynamicEntityConfigurationRelationQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery */
        $q = $this->useInQuery('SpyDynamicEntityConfigurationRelation', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyDynamicEntityConfigurationRelationFieldMapping $spyDynamicEntityConfigurationRelationFieldMapping Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyDynamicEntityConfigurationRelationFieldMapping = null)
    {
        if ($spyDynamicEntityConfigurationRelationFieldMapping) {
            $this->addUsingAlias(SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION_FIELD_MAPPING, $spyDynamicEntityConfigurationRelationFieldMapping->getIdDynamicEntityConfigurationRelationFieldMapping(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_dynamic_entity_configuration_relation_field_mapping table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyDynamicEntityConfigurationRelationFieldMappingTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyDynamicEntityConfigurationRelationFieldMappingTableMap::clearInstancePool();
            SpyDynamicEntityConfigurationRelationFieldMappingTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyDynamicEntityConfigurationRelationFieldMappingTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyDynamicEntityConfigurationRelationFieldMappingTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyDynamicEntityConfigurationRelationFieldMappingTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyDynamicEntityConfigurationRelationFieldMappingTableMap::clearRelatedInstancePool();

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
