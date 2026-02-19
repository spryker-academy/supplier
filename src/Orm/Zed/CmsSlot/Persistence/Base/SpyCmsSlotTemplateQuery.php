<?php

namespace Orm\Zed\CmsSlot\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\CmsSlotBlock\Persistence\SpyCmsSlotBlock;
use Orm\Zed\CmsSlot\Persistence\SpyCmsSlotTemplate as ChildSpyCmsSlotTemplate;
use Orm\Zed\CmsSlot\Persistence\SpyCmsSlotTemplateQuery as ChildSpyCmsSlotTemplateQuery;
use Orm\Zed\CmsSlot\Persistence\Map\SpyCmsSlotTemplateTableMap;
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
 * Base class that represents a query for the `spy_cms_slot_template` table.
 *
 * @method     ChildSpyCmsSlotTemplateQuery orderByIdCmsSlotTemplate($order = Criteria::ASC) Order by the id_cms_slot_template column
 * @method     ChildSpyCmsSlotTemplateQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildSpyCmsSlotTemplateQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildSpyCmsSlotTemplateQuery orderByPath($order = Criteria::ASC) Order by the path column
 * @method     ChildSpyCmsSlotTemplateQuery orderByPathHash($order = Criteria::ASC) Order by the path_hash column
 *
 * @method     ChildSpyCmsSlotTemplateQuery groupByIdCmsSlotTemplate() Group by the id_cms_slot_template column
 * @method     ChildSpyCmsSlotTemplateQuery groupByDescription() Group by the description column
 * @method     ChildSpyCmsSlotTemplateQuery groupByName() Group by the name column
 * @method     ChildSpyCmsSlotTemplateQuery groupByPath() Group by the path column
 * @method     ChildSpyCmsSlotTemplateQuery groupByPathHash() Group by the path_hash column
 *
 * @method     ChildSpyCmsSlotTemplateQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyCmsSlotTemplateQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyCmsSlotTemplateQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyCmsSlotTemplateQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyCmsSlotTemplateQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyCmsSlotTemplateQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyCmsSlotTemplateQuery leftJoinSpyCmsSlotToCmsSlotTemplate($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCmsSlotToCmsSlotTemplate relation
 * @method     ChildSpyCmsSlotTemplateQuery rightJoinSpyCmsSlotToCmsSlotTemplate($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCmsSlotToCmsSlotTemplate relation
 * @method     ChildSpyCmsSlotTemplateQuery innerJoinSpyCmsSlotToCmsSlotTemplate($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCmsSlotToCmsSlotTemplate relation
 *
 * @method     ChildSpyCmsSlotTemplateQuery joinWithSpyCmsSlotToCmsSlotTemplate($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCmsSlotToCmsSlotTemplate relation
 *
 * @method     ChildSpyCmsSlotTemplateQuery leftJoinWithSpyCmsSlotToCmsSlotTemplate() Adds a LEFT JOIN clause and with to the query using the SpyCmsSlotToCmsSlotTemplate relation
 * @method     ChildSpyCmsSlotTemplateQuery rightJoinWithSpyCmsSlotToCmsSlotTemplate() Adds a RIGHT JOIN clause and with to the query using the SpyCmsSlotToCmsSlotTemplate relation
 * @method     ChildSpyCmsSlotTemplateQuery innerJoinWithSpyCmsSlotToCmsSlotTemplate() Adds a INNER JOIN clause and with to the query using the SpyCmsSlotToCmsSlotTemplate relation
 *
 * @method     ChildSpyCmsSlotTemplateQuery leftJoinSpyCmsSlotBlock($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCmsSlotBlock relation
 * @method     ChildSpyCmsSlotTemplateQuery rightJoinSpyCmsSlotBlock($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCmsSlotBlock relation
 * @method     ChildSpyCmsSlotTemplateQuery innerJoinSpyCmsSlotBlock($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCmsSlotBlock relation
 *
 * @method     ChildSpyCmsSlotTemplateQuery joinWithSpyCmsSlotBlock($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCmsSlotBlock relation
 *
 * @method     ChildSpyCmsSlotTemplateQuery leftJoinWithSpyCmsSlotBlock() Adds a LEFT JOIN clause and with to the query using the SpyCmsSlotBlock relation
 * @method     ChildSpyCmsSlotTemplateQuery rightJoinWithSpyCmsSlotBlock() Adds a RIGHT JOIN clause and with to the query using the SpyCmsSlotBlock relation
 * @method     ChildSpyCmsSlotTemplateQuery innerJoinWithSpyCmsSlotBlock() Adds a INNER JOIN clause and with to the query using the SpyCmsSlotBlock relation
 *
 * @method     \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotToCmsSlotTemplateQuery|\Orm\Zed\CmsSlotBlock\Persistence\SpyCmsSlotBlockQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyCmsSlotTemplate|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyCmsSlotTemplate matching the query
 * @method     ChildSpyCmsSlotTemplate findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyCmsSlotTemplate matching the query, or a new ChildSpyCmsSlotTemplate object populated from the query conditions when no match is found
 *
 * @method     ChildSpyCmsSlotTemplate|null findOneByIdCmsSlotTemplate(int $id_cms_slot_template) Return the first ChildSpyCmsSlotTemplate filtered by the id_cms_slot_template column
 * @method     ChildSpyCmsSlotTemplate|null findOneByDescription(string $description) Return the first ChildSpyCmsSlotTemplate filtered by the description column
 * @method     ChildSpyCmsSlotTemplate|null findOneByName(string $name) Return the first ChildSpyCmsSlotTemplate filtered by the name column
 * @method     ChildSpyCmsSlotTemplate|null findOneByPath(string $path) Return the first ChildSpyCmsSlotTemplate filtered by the path column
 * @method     ChildSpyCmsSlotTemplate|null findOneByPathHash(string $path_hash) Return the first ChildSpyCmsSlotTemplate filtered by the path_hash column
 *
 * @method     ChildSpyCmsSlotTemplate requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyCmsSlotTemplate by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCmsSlotTemplate requireOne(?ConnectionInterface $con = null) Return the first ChildSpyCmsSlotTemplate matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyCmsSlotTemplate requireOneByIdCmsSlotTemplate(int $id_cms_slot_template) Return the first ChildSpyCmsSlotTemplate filtered by the id_cms_slot_template column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCmsSlotTemplate requireOneByDescription(string $description) Return the first ChildSpyCmsSlotTemplate filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCmsSlotTemplate requireOneByName(string $name) Return the first ChildSpyCmsSlotTemplate filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCmsSlotTemplate requireOneByPath(string $path) Return the first ChildSpyCmsSlotTemplate filtered by the path column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCmsSlotTemplate requireOneByPathHash(string $path_hash) Return the first ChildSpyCmsSlotTemplate filtered by the path_hash column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyCmsSlotTemplate[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyCmsSlotTemplate objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyCmsSlotTemplate> find(?ConnectionInterface $con = null) Return ChildSpyCmsSlotTemplate objects based on current ModelCriteria
 *
 * @method     ChildSpyCmsSlotTemplate[]|Collection findByIdCmsSlotTemplate(int|array<int> $id_cms_slot_template) Return ChildSpyCmsSlotTemplate objects filtered by the id_cms_slot_template column
 * @psalm-method Collection&\Traversable<ChildSpyCmsSlotTemplate> findByIdCmsSlotTemplate(int|array<int> $id_cms_slot_template) Return ChildSpyCmsSlotTemplate objects filtered by the id_cms_slot_template column
 * @method     ChildSpyCmsSlotTemplate[]|Collection findByDescription(string|array<string> $description) Return ChildSpyCmsSlotTemplate objects filtered by the description column
 * @psalm-method Collection&\Traversable<ChildSpyCmsSlotTemplate> findByDescription(string|array<string> $description) Return ChildSpyCmsSlotTemplate objects filtered by the description column
 * @method     ChildSpyCmsSlotTemplate[]|Collection findByName(string|array<string> $name) Return ChildSpyCmsSlotTemplate objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildSpyCmsSlotTemplate> findByName(string|array<string> $name) Return ChildSpyCmsSlotTemplate objects filtered by the name column
 * @method     ChildSpyCmsSlotTemplate[]|Collection findByPath(string|array<string> $path) Return ChildSpyCmsSlotTemplate objects filtered by the path column
 * @psalm-method Collection&\Traversable<ChildSpyCmsSlotTemplate> findByPath(string|array<string> $path) Return ChildSpyCmsSlotTemplate objects filtered by the path column
 * @method     ChildSpyCmsSlotTemplate[]|Collection findByPathHash(string|array<string> $path_hash) Return ChildSpyCmsSlotTemplate objects filtered by the path_hash column
 * @psalm-method Collection&\Traversable<ChildSpyCmsSlotTemplate> findByPathHash(string|array<string> $path_hash) Return ChildSpyCmsSlotTemplate objects filtered by the path_hash column
 *
 * @method     ChildSpyCmsSlotTemplate[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyCmsSlotTemplate> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyCmsSlotTemplateQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\CmsSlot\Persistence\Base\SpyCmsSlotTemplateQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\CmsSlot\\Persistence\\SpyCmsSlotTemplate', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyCmsSlotTemplateQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyCmsSlotTemplateQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyCmsSlotTemplateQuery) {
            return $criteria;
        }
        $query = new ChildSpyCmsSlotTemplateQuery();
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
     * @return ChildSpyCmsSlotTemplate|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyCmsSlotTemplateTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyCmsSlotTemplate A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id_cms_slot_template`, `description`, `name`, `path`, `path_hash` FROM `spy_cms_slot_template` WHERE `id_cms_slot_template` = :p0';
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
            /** @var ChildSpyCmsSlotTemplate $obj */
            $obj = new ChildSpyCmsSlotTemplate();
            $obj->hydrate($row);
            SpyCmsSlotTemplateTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyCmsSlotTemplate|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyCmsSlotTemplateTableMap::COL_ID_CMS_SLOT_TEMPLATE, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyCmsSlotTemplateTableMap::COL_ID_CMS_SLOT_TEMPLATE, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idCmsSlotTemplate Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdCmsSlotTemplate_Between(array $idCmsSlotTemplate)
    {
        return $this->filterByIdCmsSlotTemplate($idCmsSlotTemplate, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idCmsSlotTemplates Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdCmsSlotTemplate_In(array $idCmsSlotTemplates)
    {
        return $this->filterByIdCmsSlotTemplate($idCmsSlotTemplates, Criteria::IN);
    }

    /**
     * Filter the query on the id_cms_slot_template column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCmsSlotTemplate(1234); // WHERE id_cms_slot_template = 1234
     * $query->filterByIdCmsSlotTemplate(array(12, 34), Criteria::IN); // WHERE id_cms_slot_template IN (12, 34)
     * $query->filterByIdCmsSlotTemplate(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_cms_slot_template > 12
     * </code>
     *
     * @param     mixed $idCmsSlotTemplate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdCmsSlotTemplate($idCmsSlotTemplate = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idCmsSlotTemplate)) {
            $useMinMax = false;
            if (isset($idCmsSlotTemplate['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCmsSlotTemplateTableMap::COL_ID_CMS_SLOT_TEMPLATE, $idCmsSlotTemplate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCmsSlotTemplate['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCmsSlotTemplateTableMap::COL_ID_CMS_SLOT_TEMPLATE, $idCmsSlotTemplate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idCmsSlotTemplate of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCmsSlotTemplateTableMap::COL_ID_CMS_SLOT_TEMPLATE, $idCmsSlotTemplate, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $descriptions Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDescription_In(array $descriptions)
    {
        return $this->filterByDescription($descriptions, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $description Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDescription_Like($description)
    {
        return $this->filterByDescription($description, Criteria::LIKE);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE description LIKE '%fooValue%'
     * $query->filterByDescription([1, 'foo'], Criteria::IN); // WHERE description IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByDescription($description = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $description = str_replace('*', '%', $description);
        }

        if (is_array($description) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$description of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCmsSlotTemplateTableMap::COL_DESCRIPTION, $description, $comparison);

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

        $query = $this->addUsingAlias(SpyCmsSlotTemplateTableMap::COL_NAME, $name, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $paths Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPath_In(array $paths)
    {
        return $this->filterByPath($paths, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $path Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPath_Like($path)
    {
        return $this->filterByPath($path, Criteria::LIKE);
    }

    /**
     * Filter the query on the path column
     *
     * Example usage:
     * <code>
     * $query->filterByPath('fooValue');   // WHERE path = 'fooValue'
     * $query->filterByPath('%fooValue%', Criteria::LIKE); // WHERE path LIKE '%fooValue%'
     * $query->filterByPath([1, 'foo'], Criteria::IN); // WHERE path IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $path The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByPath($path = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $path = str_replace('*', '%', $path);
        }

        if (is_array($path) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$path of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCmsSlotTemplateTableMap::COL_PATH, $path, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $pathHashs Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPathHash_In(array $pathHashs)
    {
        return $this->filterByPathHash($pathHashs, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $pathHash Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPathHash_Like($pathHash)
    {
        return $this->filterByPathHash($pathHash, Criteria::LIKE);
    }

    /**
     * Filter the query on the path_hash column
     *
     * Example usage:
     * <code>
     * $query->filterByPathHash('fooValue');   // WHERE path_hash = 'fooValue'
     * $query->filterByPathHash('%fooValue%', Criteria::LIKE); // WHERE path_hash LIKE '%fooValue%'
     * $query->filterByPathHash([1, 'foo'], Criteria::IN); // WHERE path_hash IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $pathHash The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByPathHash($pathHash = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $pathHash = str_replace('*', '%', $pathHash);
        }

        if (is_array($pathHash) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$pathHash of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCmsSlotTemplateTableMap::COL_PATH_HASH, $pathHash, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotToCmsSlotTemplate object
     *
     * @param \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotToCmsSlotTemplate|ObjectCollection $spyCmsSlotToCmsSlotTemplate the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCmsSlotToCmsSlotTemplate($spyCmsSlotToCmsSlotTemplate, ?string $comparison = null)
    {
        if ($spyCmsSlotToCmsSlotTemplate instanceof \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotToCmsSlotTemplate) {
            $this
                ->addUsingAlias(SpyCmsSlotTemplateTableMap::COL_ID_CMS_SLOT_TEMPLATE, $spyCmsSlotToCmsSlotTemplate->getFkCmsSlotTemplate(), $comparison);

            return $this;
        } elseif ($spyCmsSlotToCmsSlotTemplate instanceof ObjectCollection) {
            $this
                ->useSpyCmsSlotToCmsSlotTemplateQuery()
                ->filterByPrimaryKeys($spyCmsSlotToCmsSlotTemplate->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyCmsSlotToCmsSlotTemplate() only accepts arguments of type \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotToCmsSlotTemplate or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCmsSlotToCmsSlotTemplate relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCmsSlotToCmsSlotTemplate(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCmsSlotToCmsSlotTemplate');

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
            $this->addJoinObject($join, 'SpyCmsSlotToCmsSlotTemplate');
        }

        return $this;
    }

    /**
     * Use the SpyCmsSlotToCmsSlotTemplate relation SpyCmsSlotToCmsSlotTemplate object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotToCmsSlotTemplateQuery A secondary query class using the current class as primary query
     */
    public function useSpyCmsSlotToCmsSlotTemplateQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyCmsSlotToCmsSlotTemplate($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCmsSlotToCmsSlotTemplate', '\Orm\Zed\CmsSlot\Persistence\SpyCmsSlotToCmsSlotTemplateQuery');
    }

    /**
     * Use the SpyCmsSlotToCmsSlotTemplate relation SpyCmsSlotToCmsSlotTemplate object
     *
     * @param callable(\Orm\Zed\CmsSlot\Persistence\SpyCmsSlotToCmsSlotTemplateQuery):\Orm\Zed\CmsSlot\Persistence\SpyCmsSlotToCmsSlotTemplateQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCmsSlotToCmsSlotTemplateQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyCmsSlotToCmsSlotTemplateQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyCmsSlotToCmsSlotTemplate table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotToCmsSlotTemplateQuery The inner query object of the EXISTS statement
     */
    public function useSpyCmsSlotToCmsSlotTemplateExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotToCmsSlotTemplateQuery */
        $q = $this->useExistsQuery('SpyCmsSlotToCmsSlotTemplate', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyCmsSlotToCmsSlotTemplate table for a NOT EXISTS query.
     *
     * @see useSpyCmsSlotToCmsSlotTemplateExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotToCmsSlotTemplateQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCmsSlotToCmsSlotTemplateNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotToCmsSlotTemplateQuery */
        $q = $this->useExistsQuery('SpyCmsSlotToCmsSlotTemplate', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyCmsSlotToCmsSlotTemplate table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotToCmsSlotTemplateQuery The inner query object of the IN statement
     */
    public function useInSpyCmsSlotToCmsSlotTemplateQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotToCmsSlotTemplateQuery */
        $q = $this->useInQuery('SpyCmsSlotToCmsSlotTemplate', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyCmsSlotToCmsSlotTemplate table for a NOT IN query.
     *
     * @see useSpyCmsSlotToCmsSlotTemplateInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotToCmsSlotTemplateQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyCmsSlotToCmsSlotTemplateQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotToCmsSlotTemplateQuery */
        $q = $this->useInQuery('SpyCmsSlotToCmsSlotTemplate', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\CmsSlotBlock\Persistence\SpyCmsSlotBlock object
     *
     * @param \Orm\Zed\CmsSlotBlock\Persistence\SpyCmsSlotBlock|ObjectCollection $spyCmsSlotBlock the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCmsSlotBlock($spyCmsSlotBlock, ?string $comparison = null)
    {
        if ($spyCmsSlotBlock instanceof \Orm\Zed\CmsSlotBlock\Persistence\SpyCmsSlotBlock) {
            $this
                ->addUsingAlias(SpyCmsSlotTemplateTableMap::COL_ID_CMS_SLOT_TEMPLATE, $spyCmsSlotBlock->getFkCmsSlotTemplate(), $comparison);

            return $this;
        } elseif ($spyCmsSlotBlock instanceof ObjectCollection) {
            $this
                ->useSpyCmsSlotBlockQuery()
                ->filterByPrimaryKeys($spyCmsSlotBlock->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyCmsSlotBlock() only accepts arguments of type \Orm\Zed\CmsSlotBlock\Persistence\SpyCmsSlotBlock or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCmsSlotBlock relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCmsSlotBlock(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCmsSlotBlock');

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
            $this->addJoinObject($join, 'SpyCmsSlotBlock');
        }

        return $this;
    }

    /**
     * Use the SpyCmsSlotBlock relation SpyCmsSlotBlock object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\CmsSlotBlock\Persistence\SpyCmsSlotBlockQuery A secondary query class using the current class as primary query
     */
    public function useSpyCmsSlotBlockQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyCmsSlotBlock($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCmsSlotBlock', '\Orm\Zed\CmsSlotBlock\Persistence\SpyCmsSlotBlockQuery');
    }

    /**
     * Use the SpyCmsSlotBlock relation SpyCmsSlotBlock object
     *
     * @param callable(\Orm\Zed\CmsSlotBlock\Persistence\SpyCmsSlotBlockQuery):\Orm\Zed\CmsSlotBlock\Persistence\SpyCmsSlotBlockQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCmsSlotBlockQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyCmsSlotBlockQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyCmsSlotBlock table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\CmsSlotBlock\Persistence\SpyCmsSlotBlockQuery The inner query object of the EXISTS statement
     */
    public function useSpyCmsSlotBlockExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\CmsSlotBlock\Persistence\SpyCmsSlotBlockQuery */
        $q = $this->useExistsQuery('SpyCmsSlotBlock', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyCmsSlotBlock table for a NOT EXISTS query.
     *
     * @see useSpyCmsSlotBlockExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CmsSlotBlock\Persistence\SpyCmsSlotBlockQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCmsSlotBlockNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CmsSlotBlock\Persistence\SpyCmsSlotBlockQuery */
        $q = $this->useExistsQuery('SpyCmsSlotBlock', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyCmsSlotBlock table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\CmsSlotBlock\Persistence\SpyCmsSlotBlockQuery The inner query object of the IN statement
     */
    public function useInSpyCmsSlotBlockQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\CmsSlotBlock\Persistence\SpyCmsSlotBlockQuery */
        $q = $this->useInQuery('SpyCmsSlotBlock', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyCmsSlotBlock table for a NOT IN query.
     *
     * @see useSpyCmsSlotBlockInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CmsSlotBlock\Persistence\SpyCmsSlotBlockQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyCmsSlotBlockQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CmsSlotBlock\Persistence\SpyCmsSlotBlockQuery */
        $q = $this->useInQuery('SpyCmsSlotBlock', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyCmsSlotTemplate $spyCmsSlotTemplate Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyCmsSlotTemplate = null)
    {
        if ($spyCmsSlotTemplate) {
            $this->addUsingAlias(SpyCmsSlotTemplateTableMap::COL_ID_CMS_SLOT_TEMPLATE, $spyCmsSlotTemplate->getIdCmsSlotTemplate(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_cms_slot_template table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsSlotTemplateTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyCmsSlotTemplateTableMap::clearInstancePool();
            SpyCmsSlotTemplateTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsSlotTemplateTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyCmsSlotTemplateTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyCmsSlotTemplateTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyCmsSlotTemplateTableMap::clearRelatedInstancePool();

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
