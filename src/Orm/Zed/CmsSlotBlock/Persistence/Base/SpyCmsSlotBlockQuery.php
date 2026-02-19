<?php

namespace Orm\Zed\CmsSlotBlock\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\CmsBlock\Persistence\SpyCmsBlock;
use Orm\Zed\CmsSlotBlock\Persistence\SpyCmsSlotBlock as ChildSpyCmsSlotBlock;
use Orm\Zed\CmsSlotBlock\Persistence\SpyCmsSlotBlockQuery as ChildSpyCmsSlotBlockQuery;
use Orm\Zed\CmsSlotBlock\Persistence\Map\SpyCmsSlotBlockTableMap;
use Orm\Zed\CmsSlot\Persistence\SpyCmsSlot;
use Orm\Zed\CmsSlot\Persistence\SpyCmsSlotTemplate;
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
 * Base class that represents a query for the `spy_cms_slot_block` table.
 *
 * @method     ChildSpyCmsSlotBlockQuery orderByIdCmsSlotBlock($order = Criteria::ASC) Order by the id_cms_slot_block column
 * @method     ChildSpyCmsSlotBlockQuery orderByFkCmsBlock($order = Criteria::ASC) Order by the fk_cms_block column
 * @method     ChildSpyCmsSlotBlockQuery orderByFkCmsSlot($order = Criteria::ASC) Order by the fk_cms_slot column
 * @method     ChildSpyCmsSlotBlockQuery orderByFkCmsSlotTemplate($order = Criteria::ASC) Order by the fk_cms_slot_template column
 * @method     ChildSpyCmsSlotBlockQuery orderByConditions($order = Criteria::ASC) Order by the conditions column
 * @method     ChildSpyCmsSlotBlockQuery orderByPosition($order = Criteria::ASC) Order by the position column
 *
 * @method     ChildSpyCmsSlotBlockQuery groupByIdCmsSlotBlock() Group by the id_cms_slot_block column
 * @method     ChildSpyCmsSlotBlockQuery groupByFkCmsBlock() Group by the fk_cms_block column
 * @method     ChildSpyCmsSlotBlockQuery groupByFkCmsSlot() Group by the fk_cms_slot column
 * @method     ChildSpyCmsSlotBlockQuery groupByFkCmsSlotTemplate() Group by the fk_cms_slot_template column
 * @method     ChildSpyCmsSlotBlockQuery groupByConditions() Group by the conditions column
 * @method     ChildSpyCmsSlotBlockQuery groupByPosition() Group by the position column
 *
 * @method     ChildSpyCmsSlotBlockQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyCmsSlotBlockQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyCmsSlotBlockQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyCmsSlotBlockQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyCmsSlotBlockQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyCmsSlotBlockQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyCmsSlotBlockQuery leftJoinCmsSlotTemplate($relationAlias = null) Adds a LEFT JOIN clause to the query using the CmsSlotTemplate relation
 * @method     ChildSpyCmsSlotBlockQuery rightJoinCmsSlotTemplate($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CmsSlotTemplate relation
 * @method     ChildSpyCmsSlotBlockQuery innerJoinCmsSlotTemplate($relationAlias = null) Adds a INNER JOIN clause to the query using the CmsSlotTemplate relation
 *
 * @method     ChildSpyCmsSlotBlockQuery joinWithCmsSlotTemplate($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CmsSlotTemplate relation
 *
 * @method     ChildSpyCmsSlotBlockQuery leftJoinWithCmsSlotTemplate() Adds a LEFT JOIN clause and with to the query using the CmsSlotTemplate relation
 * @method     ChildSpyCmsSlotBlockQuery rightJoinWithCmsSlotTemplate() Adds a RIGHT JOIN clause and with to the query using the CmsSlotTemplate relation
 * @method     ChildSpyCmsSlotBlockQuery innerJoinWithCmsSlotTemplate() Adds a INNER JOIN clause and with to the query using the CmsSlotTemplate relation
 *
 * @method     ChildSpyCmsSlotBlockQuery leftJoinCmsSlot($relationAlias = null) Adds a LEFT JOIN clause to the query using the CmsSlot relation
 * @method     ChildSpyCmsSlotBlockQuery rightJoinCmsSlot($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CmsSlot relation
 * @method     ChildSpyCmsSlotBlockQuery innerJoinCmsSlot($relationAlias = null) Adds a INNER JOIN clause to the query using the CmsSlot relation
 *
 * @method     ChildSpyCmsSlotBlockQuery joinWithCmsSlot($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CmsSlot relation
 *
 * @method     ChildSpyCmsSlotBlockQuery leftJoinWithCmsSlot() Adds a LEFT JOIN clause and with to the query using the CmsSlot relation
 * @method     ChildSpyCmsSlotBlockQuery rightJoinWithCmsSlot() Adds a RIGHT JOIN clause and with to the query using the CmsSlot relation
 * @method     ChildSpyCmsSlotBlockQuery innerJoinWithCmsSlot() Adds a INNER JOIN clause and with to the query using the CmsSlot relation
 *
 * @method     ChildSpyCmsSlotBlockQuery leftJoinCmsBlock($relationAlias = null) Adds a LEFT JOIN clause to the query using the CmsBlock relation
 * @method     ChildSpyCmsSlotBlockQuery rightJoinCmsBlock($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CmsBlock relation
 * @method     ChildSpyCmsSlotBlockQuery innerJoinCmsBlock($relationAlias = null) Adds a INNER JOIN clause to the query using the CmsBlock relation
 *
 * @method     ChildSpyCmsSlotBlockQuery joinWithCmsBlock($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CmsBlock relation
 *
 * @method     ChildSpyCmsSlotBlockQuery leftJoinWithCmsBlock() Adds a LEFT JOIN clause and with to the query using the CmsBlock relation
 * @method     ChildSpyCmsSlotBlockQuery rightJoinWithCmsBlock() Adds a RIGHT JOIN clause and with to the query using the CmsBlock relation
 * @method     ChildSpyCmsSlotBlockQuery innerJoinWithCmsBlock() Adds a INNER JOIN clause and with to the query using the CmsBlock relation
 *
 * @method     \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotTemplateQuery|\Orm\Zed\CmsSlot\Persistence\SpyCmsSlotQuery|\Orm\Zed\CmsBlock\Persistence\SpyCmsBlockQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyCmsSlotBlock|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyCmsSlotBlock matching the query
 * @method     ChildSpyCmsSlotBlock findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyCmsSlotBlock matching the query, or a new ChildSpyCmsSlotBlock object populated from the query conditions when no match is found
 *
 * @method     ChildSpyCmsSlotBlock|null findOneByIdCmsSlotBlock(string $id_cms_slot_block) Return the first ChildSpyCmsSlotBlock filtered by the id_cms_slot_block column
 * @method     ChildSpyCmsSlotBlock|null findOneByFkCmsBlock(int $fk_cms_block) Return the first ChildSpyCmsSlotBlock filtered by the fk_cms_block column
 * @method     ChildSpyCmsSlotBlock|null findOneByFkCmsSlot(int $fk_cms_slot) Return the first ChildSpyCmsSlotBlock filtered by the fk_cms_slot column
 * @method     ChildSpyCmsSlotBlock|null findOneByFkCmsSlotTemplate(int $fk_cms_slot_template) Return the first ChildSpyCmsSlotBlock filtered by the fk_cms_slot_template column
 * @method     ChildSpyCmsSlotBlock|null findOneByConditions(string $conditions) Return the first ChildSpyCmsSlotBlock filtered by the conditions column
 * @method     ChildSpyCmsSlotBlock|null findOneByPosition(int $position) Return the first ChildSpyCmsSlotBlock filtered by the position column
 *
 * @method     ChildSpyCmsSlotBlock requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyCmsSlotBlock by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCmsSlotBlock requireOne(?ConnectionInterface $con = null) Return the first ChildSpyCmsSlotBlock matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyCmsSlotBlock requireOneByIdCmsSlotBlock(string $id_cms_slot_block) Return the first ChildSpyCmsSlotBlock filtered by the id_cms_slot_block column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCmsSlotBlock requireOneByFkCmsBlock(int $fk_cms_block) Return the first ChildSpyCmsSlotBlock filtered by the fk_cms_block column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCmsSlotBlock requireOneByFkCmsSlot(int $fk_cms_slot) Return the first ChildSpyCmsSlotBlock filtered by the fk_cms_slot column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCmsSlotBlock requireOneByFkCmsSlotTemplate(int $fk_cms_slot_template) Return the first ChildSpyCmsSlotBlock filtered by the fk_cms_slot_template column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCmsSlotBlock requireOneByConditions(string $conditions) Return the first ChildSpyCmsSlotBlock filtered by the conditions column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCmsSlotBlock requireOneByPosition(int $position) Return the first ChildSpyCmsSlotBlock filtered by the position column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyCmsSlotBlock[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyCmsSlotBlock objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyCmsSlotBlock> find(?ConnectionInterface $con = null) Return ChildSpyCmsSlotBlock objects based on current ModelCriteria
 *
 * @method     ChildSpyCmsSlotBlock[]|Collection findByIdCmsSlotBlock(string|array<string> $id_cms_slot_block) Return ChildSpyCmsSlotBlock objects filtered by the id_cms_slot_block column
 * @psalm-method Collection&\Traversable<ChildSpyCmsSlotBlock> findByIdCmsSlotBlock(string|array<string> $id_cms_slot_block) Return ChildSpyCmsSlotBlock objects filtered by the id_cms_slot_block column
 * @method     ChildSpyCmsSlotBlock[]|Collection findByFkCmsBlock(int|array<int> $fk_cms_block) Return ChildSpyCmsSlotBlock objects filtered by the fk_cms_block column
 * @psalm-method Collection&\Traversable<ChildSpyCmsSlotBlock> findByFkCmsBlock(int|array<int> $fk_cms_block) Return ChildSpyCmsSlotBlock objects filtered by the fk_cms_block column
 * @method     ChildSpyCmsSlotBlock[]|Collection findByFkCmsSlot(int|array<int> $fk_cms_slot) Return ChildSpyCmsSlotBlock objects filtered by the fk_cms_slot column
 * @psalm-method Collection&\Traversable<ChildSpyCmsSlotBlock> findByFkCmsSlot(int|array<int> $fk_cms_slot) Return ChildSpyCmsSlotBlock objects filtered by the fk_cms_slot column
 * @method     ChildSpyCmsSlotBlock[]|Collection findByFkCmsSlotTemplate(int|array<int> $fk_cms_slot_template) Return ChildSpyCmsSlotBlock objects filtered by the fk_cms_slot_template column
 * @psalm-method Collection&\Traversable<ChildSpyCmsSlotBlock> findByFkCmsSlotTemplate(int|array<int> $fk_cms_slot_template) Return ChildSpyCmsSlotBlock objects filtered by the fk_cms_slot_template column
 * @method     ChildSpyCmsSlotBlock[]|Collection findByConditions(string|array<string> $conditions) Return ChildSpyCmsSlotBlock objects filtered by the conditions column
 * @psalm-method Collection&\Traversable<ChildSpyCmsSlotBlock> findByConditions(string|array<string> $conditions) Return ChildSpyCmsSlotBlock objects filtered by the conditions column
 * @method     ChildSpyCmsSlotBlock[]|Collection findByPosition(int|array<int> $position) Return ChildSpyCmsSlotBlock objects filtered by the position column
 * @psalm-method Collection&\Traversable<ChildSpyCmsSlotBlock> findByPosition(int|array<int> $position) Return ChildSpyCmsSlotBlock objects filtered by the position column
 *
 * @method     ChildSpyCmsSlotBlock[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyCmsSlotBlock> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyCmsSlotBlockQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\CmsSlotBlock\Persistence\Base\SpyCmsSlotBlockQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\CmsSlotBlock\\Persistence\\SpyCmsSlotBlock', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyCmsSlotBlockQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyCmsSlotBlockQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyCmsSlotBlockQuery) {
            return $criteria;
        }
        $query = new ChildSpyCmsSlotBlockQuery();
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
     * @return ChildSpyCmsSlotBlock|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyCmsSlotBlockTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyCmsSlotBlock A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_cms_slot_block, fk_cms_block, fk_cms_slot, fk_cms_slot_template, conditions, position FROM spy_cms_slot_block WHERE id_cms_slot_block = :p0';
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
            /** @var ChildSpyCmsSlotBlock $obj */
            $obj = new ChildSpyCmsSlotBlock();
            $obj->hydrate($row);
            SpyCmsSlotBlockTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyCmsSlotBlock|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyCmsSlotBlockTableMap::COL_ID_CMS_SLOT_BLOCK, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyCmsSlotBlockTableMap::COL_ID_CMS_SLOT_BLOCK, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idCmsSlotBlock Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdCmsSlotBlock_Between(array $idCmsSlotBlock)
    {
        return $this->filterByIdCmsSlotBlock($idCmsSlotBlock, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idCmsSlotBlocks Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdCmsSlotBlock_In(array $idCmsSlotBlocks)
    {
        return $this->filterByIdCmsSlotBlock($idCmsSlotBlocks, Criteria::IN);
    }

    /**
     * Filter the query on the id_cms_slot_block column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCmsSlotBlock(1234); // WHERE id_cms_slot_block = 1234
     * $query->filterByIdCmsSlotBlock(array(12, 34), Criteria::IN); // WHERE id_cms_slot_block IN (12, 34)
     * $query->filterByIdCmsSlotBlock(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_cms_slot_block > 12
     * </code>
     *
     * @param     mixed $idCmsSlotBlock The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdCmsSlotBlock($idCmsSlotBlock = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idCmsSlotBlock)) {
            $useMinMax = false;
            if (isset($idCmsSlotBlock['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCmsSlotBlockTableMap::COL_ID_CMS_SLOT_BLOCK, $idCmsSlotBlock['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCmsSlotBlock['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCmsSlotBlockTableMap::COL_ID_CMS_SLOT_BLOCK, $idCmsSlotBlock['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idCmsSlotBlock of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCmsSlotBlockTableMap::COL_ID_CMS_SLOT_BLOCK, $idCmsSlotBlock, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkCmsBlock Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCmsBlock_Between(array $fkCmsBlock)
    {
        return $this->filterByFkCmsBlock($fkCmsBlock, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkCmsBlocks Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCmsBlock_In(array $fkCmsBlocks)
    {
        return $this->filterByFkCmsBlock($fkCmsBlocks, Criteria::IN);
    }

    /**
     * Filter the query on the fk_cms_block column
     *
     * Example usage:
     * <code>
     * $query->filterByFkCmsBlock(1234); // WHERE fk_cms_block = 1234
     * $query->filterByFkCmsBlock(array(12, 34), Criteria::IN); // WHERE fk_cms_block IN (12, 34)
     * $query->filterByFkCmsBlock(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_cms_block > 12
     * </code>
     *
     * @see       filterByCmsBlock()
     *
     * @param     mixed $fkCmsBlock The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkCmsBlock($fkCmsBlock = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkCmsBlock)) {
            $useMinMax = false;
            if (isset($fkCmsBlock['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCmsSlotBlockTableMap::COL_FK_CMS_BLOCK, $fkCmsBlock['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkCmsBlock['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCmsSlotBlockTableMap::COL_FK_CMS_BLOCK, $fkCmsBlock['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkCmsBlock of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCmsSlotBlockTableMap::COL_FK_CMS_BLOCK, $fkCmsBlock, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkCmsSlot Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCmsSlot_Between(array $fkCmsSlot)
    {
        return $this->filterByFkCmsSlot($fkCmsSlot, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkCmsSlots Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCmsSlot_In(array $fkCmsSlots)
    {
        return $this->filterByFkCmsSlot($fkCmsSlots, Criteria::IN);
    }

    /**
     * Filter the query on the fk_cms_slot column
     *
     * Example usage:
     * <code>
     * $query->filterByFkCmsSlot(1234); // WHERE fk_cms_slot = 1234
     * $query->filterByFkCmsSlot(array(12, 34), Criteria::IN); // WHERE fk_cms_slot IN (12, 34)
     * $query->filterByFkCmsSlot(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_cms_slot > 12
     * </code>
     *
     * @see       filterByCmsSlot()
     *
     * @param     mixed $fkCmsSlot The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkCmsSlot($fkCmsSlot = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkCmsSlot)) {
            $useMinMax = false;
            if (isset($fkCmsSlot['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCmsSlotBlockTableMap::COL_FK_CMS_SLOT, $fkCmsSlot['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkCmsSlot['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCmsSlotBlockTableMap::COL_FK_CMS_SLOT, $fkCmsSlot['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkCmsSlot of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCmsSlotBlockTableMap::COL_FK_CMS_SLOT, $fkCmsSlot, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkCmsSlotTemplate Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCmsSlotTemplate_Between(array $fkCmsSlotTemplate)
    {
        return $this->filterByFkCmsSlotTemplate($fkCmsSlotTemplate, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkCmsSlotTemplates Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCmsSlotTemplate_In(array $fkCmsSlotTemplates)
    {
        return $this->filterByFkCmsSlotTemplate($fkCmsSlotTemplates, Criteria::IN);
    }

    /**
     * Filter the query on the fk_cms_slot_template column
     *
     * Example usage:
     * <code>
     * $query->filterByFkCmsSlotTemplate(1234); // WHERE fk_cms_slot_template = 1234
     * $query->filterByFkCmsSlotTemplate(array(12, 34), Criteria::IN); // WHERE fk_cms_slot_template IN (12, 34)
     * $query->filterByFkCmsSlotTemplate(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_cms_slot_template > 12
     * </code>
     *
     * @see       filterByCmsSlotTemplate()
     *
     * @param     mixed $fkCmsSlotTemplate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkCmsSlotTemplate($fkCmsSlotTemplate = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkCmsSlotTemplate)) {
            $useMinMax = false;
            if (isset($fkCmsSlotTemplate['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCmsSlotBlockTableMap::COL_FK_CMS_SLOT_TEMPLATE, $fkCmsSlotTemplate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkCmsSlotTemplate['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCmsSlotBlockTableMap::COL_FK_CMS_SLOT_TEMPLATE, $fkCmsSlotTemplate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkCmsSlotTemplate of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCmsSlotBlockTableMap::COL_FK_CMS_SLOT_TEMPLATE, $fkCmsSlotTemplate, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $conditionss Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByConditions_In(array $conditionss)
    {
        return $this->filterByConditions($conditionss, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $conditions Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByConditions_Like($conditions)
    {
        return $this->filterByConditions($conditions, Criteria::LIKE);
    }

    /**
     * Filter the query on the conditions column
     *
     * Example usage:
     * <code>
     * $query->filterByConditions('fooValue');   // WHERE conditions = 'fooValue'
     * $query->filterByConditions('%fooValue%', Criteria::LIKE); // WHERE conditions LIKE '%fooValue%'
     * $query->filterByConditions([1, 'foo'], Criteria::IN); // WHERE conditions IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $conditions The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByConditions($conditions = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $conditions = str_replace('*', '%', $conditions);
        }

        if (is_array($conditions) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$conditions of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCmsSlotBlockTableMap::COL_CONDITIONS, $conditions, $comparison);

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
                $this->addUsingAlias(SpyCmsSlotBlockTableMap::COL_POSITION, $position['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($position['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCmsSlotBlockTableMap::COL_POSITION, $position['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$position of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCmsSlotBlockTableMap::COL_POSITION, $position, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotTemplate object
     *
     * @param \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotTemplate|ObjectCollection $spyCmsSlotTemplate The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCmsSlotTemplate($spyCmsSlotTemplate, ?string $comparison = null)
    {
        if ($spyCmsSlotTemplate instanceof \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotTemplate) {
            return $this
                ->addUsingAlias(SpyCmsSlotBlockTableMap::COL_FK_CMS_SLOT_TEMPLATE, $spyCmsSlotTemplate->getIdCmsSlotTemplate(), $comparison);
        } elseif ($spyCmsSlotTemplate instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyCmsSlotBlockTableMap::COL_FK_CMS_SLOT_TEMPLATE, $spyCmsSlotTemplate->toKeyValue('PrimaryKey', 'IdCmsSlotTemplate'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCmsSlotTemplate() only accepts arguments of type \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotTemplate or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CmsSlotTemplate relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCmsSlotTemplate(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CmsSlotTemplate');

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
            $this->addJoinObject($join, 'CmsSlotTemplate');
        }

        return $this;
    }

    /**
     * Use the CmsSlotTemplate relation SpyCmsSlotTemplate object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotTemplateQuery A secondary query class using the current class as primary query
     */
    public function useCmsSlotTemplateQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCmsSlotTemplate($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CmsSlotTemplate', '\Orm\Zed\CmsSlot\Persistence\SpyCmsSlotTemplateQuery');
    }

    /**
     * Use the CmsSlotTemplate relation SpyCmsSlotTemplate object
     *
     * @param callable(\Orm\Zed\CmsSlot\Persistence\SpyCmsSlotTemplateQuery):\Orm\Zed\CmsSlot\Persistence\SpyCmsSlotTemplateQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCmsSlotTemplateQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCmsSlotTemplateQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the CmsSlotTemplate relation to the SpyCmsSlotTemplate table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotTemplateQuery The inner query object of the EXISTS statement
     */
    public function useCmsSlotTemplateExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotTemplateQuery */
        $q = $this->useExistsQuery('CmsSlotTemplate', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the CmsSlotTemplate relation to the SpyCmsSlotTemplate table for a NOT EXISTS query.
     *
     * @see useCmsSlotTemplateExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotTemplateQuery The inner query object of the NOT EXISTS statement
     */
    public function useCmsSlotTemplateNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotTemplateQuery */
        $q = $this->useExistsQuery('CmsSlotTemplate', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the CmsSlotTemplate relation to the SpyCmsSlotTemplate table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotTemplateQuery The inner query object of the IN statement
     */
    public function useInCmsSlotTemplateQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotTemplateQuery */
        $q = $this->useInQuery('CmsSlotTemplate', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the CmsSlotTemplate relation to the SpyCmsSlotTemplate table for a NOT IN query.
     *
     * @see useCmsSlotTemplateInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotTemplateQuery The inner query object of the NOT IN statement
     */
    public function useNotInCmsSlotTemplateQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotTemplateQuery */
        $q = $this->useInQuery('CmsSlotTemplate', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\CmsSlot\Persistence\SpyCmsSlot object
     *
     * @param \Orm\Zed\CmsSlot\Persistence\SpyCmsSlot|ObjectCollection $spyCmsSlot The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCmsSlot($spyCmsSlot, ?string $comparison = null)
    {
        if ($spyCmsSlot instanceof \Orm\Zed\CmsSlot\Persistence\SpyCmsSlot) {
            return $this
                ->addUsingAlias(SpyCmsSlotBlockTableMap::COL_FK_CMS_SLOT, $spyCmsSlot->getIdCmsSlot(), $comparison);
        } elseif ($spyCmsSlot instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyCmsSlotBlockTableMap::COL_FK_CMS_SLOT, $spyCmsSlot->toKeyValue('PrimaryKey', 'IdCmsSlot'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCmsSlot() only accepts arguments of type \Orm\Zed\CmsSlot\Persistence\SpyCmsSlot or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CmsSlot relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCmsSlot(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CmsSlot');

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
            $this->addJoinObject($join, 'CmsSlot');
        }

        return $this;
    }

    /**
     * Use the CmsSlot relation SpyCmsSlot object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotQuery A secondary query class using the current class as primary query
     */
    public function useCmsSlotQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCmsSlot($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CmsSlot', '\Orm\Zed\CmsSlot\Persistence\SpyCmsSlotQuery');
    }

    /**
     * Use the CmsSlot relation SpyCmsSlot object
     *
     * @param callable(\Orm\Zed\CmsSlot\Persistence\SpyCmsSlotQuery):\Orm\Zed\CmsSlot\Persistence\SpyCmsSlotQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCmsSlotQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCmsSlotQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the CmsSlot relation to the SpyCmsSlot table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotQuery The inner query object of the EXISTS statement
     */
    public function useCmsSlotExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotQuery */
        $q = $this->useExistsQuery('CmsSlot', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the CmsSlot relation to the SpyCmsSlot table for a NOT EXISTS query.
     *
     * @see useCmsSlotExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotQuery The inner query object of the NOT EXISTS statement
     */
    public function useCmsSlotNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotQuery */
        $q = $this->useExistsQuery('CmsSlot', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the CmsSlot relation to the SpyCmsSlot table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotQuery The inner query object of the IN statement
     */
    public function useInCmsSlotQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotQuery */
        $q = $this->useInQuery('CmsSlot', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the CmsSlot relation to the SpyCmsSlot table for a NOT IN query.
     *
     * @see useCmsSlotInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotQuery The inner query object of the NOT IN statement
     */
    public function useNotInCmsSlotQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotQuery */
        $q = $this->useInQuery('CmsSlot', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\CmsBlock\Persistence\SpyCmsBlock object
     *
     * @param \Orm\Zed\CmsBlock\Persistence\SpyCmsBlock|ObjectCollection $spyCmsBlock The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCmsBlock($spyCmsBlock, ?string $comparison = null)
    {
        if ($spyCmsBlock instanceof \Orm\Zed\CmsBlock\Persistence\SpyCmsBlock) {
            return $this
                ->addUsingAlias(SpyCmsSlotBlockTableMap::COL_FK_CMS_BLOCK, $spyCmsBlock->getIdCmsBlock(), $comparison);
        } elseif ($spyCmsBlock instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyCmsSlotBlockTableMap::COL_FK_CMS_BLOCK, $spyCmsBlock->toKeyValue('PrimaryKey', 'IdCmsBlock'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCmsBlock() only accepts arguments of type \Orm\Zed\CmsBlock\Persistence\SpyCmsBlock or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CmsBlock relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCmsBlock(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CmsBlock');

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
            $this->addJoinObject($join, 'CmsBlock');
        }

        return $this;
    }

    /**
     * Use the CmsBlock relation SpyCmsBlock object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockQuery A secondary query class using the current class as primary query
     */
    public function useCmsBlockQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCmsBlock($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CmsBlock', '\Orm\Zed\CmsBlock\Persistence\SpyCmsBlockQuery');
    }

    /**
     * Use the CmsBlock relation SpyCmsBlock object
     *
     * @param callable(\Orm\Zed\CmsBlock\Persistence\SpyCmsBlockQuery):\Orm\Zed\CmsBlock\Persistence\SpyCmsBlockQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCmsBlockQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCmsBlockQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the CmsBlock relation to the SpyCmsBlock table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockQuery The inner query object of the EXISTS statement
     */
    public function useCmsBlockExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockQuery */
        $q = $this->useExistsQuery('CmsBlock', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the CmsBlock relation to the SpyCmsBlock table for a NOT EXISTS query.
     *
     * @see useCmsBlockExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockQuery The inner query object of the NOT EXISTS statement
     */
    public function useCmsBlockNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockQuery */
        $q = $this->useExistsQuery('CmsBlock', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the CmsBlock relation to the SpyCmsBlock table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockQuery The inner query object of the IN statement
     */
    public function useInCmsBlockQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockQuery */
        $q = $this->useInQuery('CmsBlock', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the CmsBlock relation to the SpyCmsBlock table for a NOT IN query.
     *
     * @see useCmsBlockInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockQuery The inner query object of the NOT IN statement
     */
    public function useNotInCmsBlockQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockQuery */
        $q = $this->useInQuery('CmsBlock', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyCmsSlotBlock $spyCmsSlotBlock Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyCmsSlotBlock = null)
    {
        if ($spyCmsSlotBlock) {
            $this->addUsingAlias(SpyCmsSlotBlockTableMap::COL_ID_CMS_SLOT_BLOCK, $spyCmsSlotBlock->getIdCmsSlotBlock(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_cms_slot_block table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsSlotBlockTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyCmsSlotBlockTableMap::clearInstancePool();
            SpyCmsSlotBlockTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsSlotBlockTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyCmsSlotBlockTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyCmsSlotBlockTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyCmsSlotBlockTableMap::clearRelatedInstancePool();

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
