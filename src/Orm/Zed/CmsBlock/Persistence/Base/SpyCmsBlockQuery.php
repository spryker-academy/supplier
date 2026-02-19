<?php

namespace Orm\Zed\CmsBlock\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnector;
use Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnector;
use Orm\Zed\CmsBlock\Persistence\SpyCmsBlock as ChildSpyCmsBlock;
use Orm\Zed\CmsBlock\Persistence\SpyCmsBlockQuery as ChildSpyCmsBlockQuery;
use Orm\Zed\CmsBlock\Persistence\Map\SpyCmsBlockTableMap;
use Orm\Zed\CmsSlotBlock\Persistence\SpyCmsSlotBlock;
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
 * Base class that represents a query for the `spy_cms_block` table.
 *
 * @method     ChildSpyCmsBlockQuery orderByIdCmsBlock($order = Criteria::ASC) Order by the id_cms_block column
 * @method     ChildSpyCmsBlockQuery orderByFkTemplate($order = Criteria::ASC) Order by the fk_template column
 * @method     ChildSpyCmsBlockQuery orderByIsActive($order = Criteria::ASC) Order by the is_active column
 * @method     ChildSpyCmsBlockQuery orderByKey($order = Criteria::ASC) Order by the key column
 * @method     ChildSpyCmsBlockQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildSpyCmsBlockQuery orderByValidFrom($order = Criteria::ASC) Order by the valid_from column
 * @method     ChildSpyCmsBlockQuery orderByValidTo($order = Criteria::ASC) Order by the valid_to column
 *
 * @method     ChildSpyCmsBlockQuery groupByIdCmsBlock() Group by the id_cms_block column
 * @method     ChildSpyCmsBlockQuery groupByFkTemplate() Group by the fk_template column
 * @method     ChildSpyCmsBlockQuery groupByIsActive() Group by the is_active column
 * @method     ChildSpyCmsBlockQuery groupByKey() Group by the key column
 * @method     ChildSpyCmsBlockQuery groupByName() Group by the name column
 * @method     ChildSpyCmsBlockQuery groupByValidFrom() Group by the valid_from column
 * @method     ChildSpyCmsBlockQuery groupByValidTo() Group by the valid_to column
 *
 * @method     ChildSpyCmsBlockQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyCmsBlockQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyCmsBlockQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyCmsBlockQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyCmsBlockQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyCmsBlockQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyCmsBlockQuery leftJoinCmsBlockTemplate($relationAlias = null) Adds a LEFT JOIN clause to the query using the CmsBlockTemplate relation
 * @method     ChildSpyCmsBlockQuery rightJoinCmsBlockTemplate($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CmsBlockTemplate relation
 * @method     ChildSpyCmsBlockQuery innerJoinCmsBlockTemplate($relationAlias = null) Adds a INNER JOIN clause to the query using the CmsBlockTemplate relation
 *
 * @method     ChildSpyCmsBlockQuery joinWithCmsBlockTemplate($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CmsBlockTemplate relation
 *
 * @method     ChildSpyCmsBlockQuery leftJoinWithCmsBlockTemplate() Adds a LEFT JOIN clause and with to the query using the CmsBlockTemplate relation
 * @method     ChildSpyCmsBlockQuery rightJoinWithCmsBlockTemplate() Adds a RIGHT JOIN clause and with to the query using the CmsBlockTemplate relation
 * @method     ChildSpyCmsBlockQuery innerJoinWithCmsBlockTemplate() Adds a INNER JOIN clause and with to the query using the CmsBlockTemplate relation
 *
 * @method     ChildSpyCmsBlockQuery leftJoinSpyCmsBlockGlossaryKeyMapping($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCmsBlockGlossaryKeyMapping relation
 * @method     ChildSpyCmsBlockQuery rightJoinSpyCmsBlockGlossaryKeyMapping($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCmsBlockGlossaryKeyMapping relation
 * @method     ChildSpyCmsBlockQuery innerJoinSpyCmsBlockGlossaryKeyMapping($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCmsBlockGlossaryKeyMapping relation
 *
 * @method     ChildSpyCmsBlockQuery joinWithSpyCmsBlockGlossaryKeyMapping($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCmsBlockGlossaryKeyMapping relation
 *
 * @method     ChildSpyCmsBlockQuery leftJoinWithSpyCmsBlockGlossaryKeyMapping() Adds a LEFT JOIN clause and with to the query using the SpyCmsBlockGlossaryKeyMapping relation
 * @method     ChildSpyCmsBlockQuery rightJoinWithSpyCmsBlockGlossaryKeyMapping() Adds a RIGHT JOIN clause and with to the query using the SpyCmsBlockGlossaryKeyMapping relation
 * @method     ChildSpyCmsBlockQuery innerJoinWithSpyCmsBlockGlossaryKeyMapping() Adds a INNER JOIN clause and with to the query using the SpyCmsBlockGlossaryKeyMapping relation
 *
 * @method     ChildSpyCmsBlockQuery leftJoinSpyCmsBlockStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCmsBlockStore relation
 * @method     ChildSpyCmsBlockQuery rightJoinSpyCmsBlockStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCmsBlockStore relation
 * @method     ChildSpyCmsBlockQuery innerJoinSpyCmsBlockStore($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCmsBlockStore relation
 *
 * @method     ChildSpyCmsBlockQuery joinWithSpyCmsBlockStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCmsBlockStore relation
 *
 * @method     ChildSpyCmsBlockQuery leftJoinWithSpyCmsBlockStore() Adds a LEFT JOIN clause and with to the query using the SpyCmsBlockStore relation
 * @method     ChildSpyCmsBlockQuery rightJoinWithSpyCmsBlockStore() Adds a RIGHT JOIN clause and with to the query using the SpyCmsBlockStore relation
 * @method     ChildSpyCmsBlockQuery innerJoinWithSpyCmsBlockStore() Adds a INNER JOIN clause and with to the query using the SpyCmsBlockStore relation
 *
 * @method     ChildSpyCmsBlockQuery leftJoinSpyCmsBlockCategoryConnector($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCmsBlockCategoryConnector relation
 * @method     ChildSpyCmsBlockQuery rightJoinSpyCmsBlockCategoryConnector($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCmsBlockCategoryConnector relation
 * @method     ChildSpyCmsBlockQuery innerJoinSpyCmsBlockCategoryConnector($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCmsBlockCategoryConnector relation
 *
 * @method     ChildSpyCmsBlockQuery joinWithSpyCmsBlockCategoryConnector($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCmsBlockCategoryConnector relation
 *
 * @method     ChildSpyCmsBlockQuery leftJoinWithSpyCmsBlockCategoryConnector() Adds a LEFT JOIN clause and with to the query using the SpyCmsBlockCategoryConnector relation
 * @method     ChildSpyCmsBlockQuery rightJoinWithSpyCmsBlockCategoryConnector() Adds a RIGHT JOIN clause and with to the query using the SpyCmsBlockCategoryConnector relation
 * @method     ChildSpyCmsBlockQuery innerJoinWithSpyCmsBlockCategoryConnector() Adds a INNER JOIN clause and with to the query using the SpyCmsBlockCategoryConnector relation
 *
 * @method     ChildSpyCmsBlockQuery leftJoinSpyCmsBlockProductConnector($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCmsBlockProductConnector relation
 * @method     ChildSpyCmsBlockQuery rightJoinSpyCmsBlockProductConnector($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCmsBlockProductConnector relation
 * @method     ChildSpyCmsBlockQuery innerJoinSpyCmsBlockProductConnector($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCmsBlockProductConnector relation
 *
 * @method     ChildSpyCmsBlockQuery joinWithSpyCmsBlockProductConnector($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCmsBlockProductConnector relation
 *
 * @method     ChildSpyCmsBlockQuery leftJoinWithSpyCmsBlockProductConnector() Adds a LEFT JOIN clause and with to the query using the SpyCmsBlockProductConnector relation
 * @method     ChildSpyCmsBlockQuery rightJoinWithSpyCmsBlockProductConnector() Adds a RIGHT JOIN clause and with to the query using the SpyCmsBlockProductConnector relation
 * @method     ChildSpyCmsBlockQuery innerJoinWithSpyCmsBlockProductConnector() Adds a INNER JOIN clause and with to the query using the SpyCmsBlockProductConnector relation
 *
 * @method     ChildSpyCmsBlockQuery leftJoinSpyCmsSlotBlock($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCmsSlotBlock relation
 * @method     ChildSpyCmsBlockQuery rightJoinSpyCmsSlotBlock($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCmsSlotBlock relation
 * @method     ChildSpyCmsBlockQuery innerJoinSpyCmsSlotBlock($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCmsSlotBlock relation
 *
 * @method     ChildSpyCmsBlockQuery joinWithSpyCmsSlotBlock($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCmsSlotBlock relation
 *
 * @method     ChildSpyCmsBlockQuery leftJoinWithSpyCmsSlotBlock() Adds a LEFT JOIN clause and with to the query using the SpyCmsSlotBlock relation
 * @method     ChildSpyCmsBlockQuery rightJoinWithSpyCmsSlotBlock() Adds a RIGHT JOIN clause and with to the query using the SpyCmsSlotBlock relation
 * @method     ChildSpyCmsBlockQuery innerJoinWithSpyCmsSlotBlock() Adds a INNER JOIN clause and with to the query using the SpyCmsSlotBlock relation
 *
 * @method     \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockTemplateQuery|\Orm\Zed\CmsBlock\Persistence\SpyCmsBlockGlossaryKeyMappingQuery|\Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStoreQuery|\Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnectorQuery|\Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnectorQuery|\Orm\Zed\CmsSlotBlock\Persistence\SpyCmsSlotBlockQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyCmsBlock|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyCmsBlock matching the query
 * @method     ChildSpyCmsBlock findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyCmsBlock matching the query, or a new ChildSpyCmsBlock object populated from the query conditions when no match is found
 *
 * @method     ChildSpyCmsBlock|null findOneByIdCmsBlock(int $id_cms_block) Return the first ChildSpyCmsBlock filtered by the id_cms_block column
 * @method     ChildSpyCmsBlock|null findOneByFkTemplate(int $fk_template) Return the first ChildSpyCmsBlock filtered by the fk_template column
 * @method     ChildSpyCmsBlock|null findOneByIsActive(boolean $is_active) Return the first ChildSpyCmsBlock filtered by the is_active column
 * @method     ChildSpyCmsBlock|null findOneByKey(string $key) Return the first ChildSpyCmsBlock filtered by the key column
 * @method     ChildSpyCmsBlock|null findOneByName(string $name) Return the first ChildSpyCmsBlock filtered by the name column
 * @method     ChildSpyCmsBlock|null findOneByValidFrom(string $valid_from) Return the first ChildSpyCmsBlock filtered by the valid_from column
 * @method     ChildSpyCmsBlock|null findOneByValidTo(string $valid_to) Return the first ChildSpyCmsBlock filtered by the valid_to column
 *
 * @method     ChildSpyCmsBlock requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyCmsBlock by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCmsBlock requireOne(?ConnectionInterface $con = null) Return the first ChildSpyCmsBlock matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyCmsBlock requireOneByIdCmsBlock(int $id_cms_block) Return the first ChildSpyCmsBlock filtered by the id_cms_block column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCmsBlock requireOneByFkTemplate(int $fk_template) Return the first ChildSpyCmsBlock filtered by the fk_template column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCmsBlock requireOneByIsActive(boolean $is_active) Return the first ChildSpyCmsBlock filtered by the is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCmsBlock requireOneByKey(string $key) Return the first ChildSpyCmsBlock filtered by the key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCmsBlock requireOneByName(string $name) Return the first ChildSpyCmsBlock filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCmsBlock requireOneByValidFrom(string $valid_from) Return the first ChildSpyCmsBlock filtered by the valid_from column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCmsBlock requireOneByValidTo(string $valid_to) Return the first ChildSpyCmsBlock filtered by the valid_to column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyCmsBlock[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyCmsBlock objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyCmsBlock> find(?ConnectionInterface $con = null) Return ChildSpyCmsBlock objects based on current ModelCriteria
 *
 * @method     ChildSpyCmsBlock[]|Collection findByIdCmsBlock(int|array<int> $id_cms_block) Return ChildSpyCmsBlock objects filtered by the id_cms_block column
 * @psalm-method Collection&\Traversable<ChildSpyCmsBlock> findByIdCmsBlock(int|array<int> $id_cms_block) Return ChildSpyCmsBlock objects filtered by the id_cms_block column
 * @method     ChildSpyCmsBlock[]|Collection findByFkTemplate(int|array<int> $fk_template) Return ChildSpyCmsBlock objects filtered by the fk_template column
 * @psalm-method Collection&\Traversable<ChildSpyCmsBlock> findByFkTemplate(int|array<int> $fk_template) Return ChildSpyCmsBlock objects filtered by the fk_template column
 * @method     ChildSpyCmsBlock[]|Collection findByIsActive(boolean|array<boolean> $is_active) Return ChildSpyCmsBlock objects filtered by the is_active column
 * @psalm-method Collection&\Traversable<ChildSpyCmsBlock> findByIsActive(boolean|array<boolean> $is_active) Return ChildSpyCmsBlock objects filtered by the is_active column
 * @method     ChildSpyCmsBlock[]|Collection findByKey(string|array<string> $key) Return ChildSpyCmsBlock objects filtered by the key column
 * @psalm-method Collection&\Traversable<ChildSpyCmsBlock> findByKey(string|array<string> $key) Return ChildSpyCmsBlock objects filtered by the key column
 * @method     ChildSpyCmsBlock[]|Collection findByName(string|array<string> $name) Return ChildSpyCmsBlock objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildSpyCmsBlock> findByName(string|array<string> $name) Return ChildSpyCmsBlock objects filtered by the name column
 * @method     ChildSpyCmsBlock[]|Collection findByValidFrom(string|array<string> $valid_from) Return ChildSpyCmsBlock objects filtered by the valid_from column
 * @psalm-method Collection&\Traversable<ChildSpyCmsBlock> findByValidFrom(string|array<string> $valid_from) Return ChildSpyCmsBlock objects filtered by the valid_from column
 * @method     ChildSpyCmsBlock[]|Collection findByValidTo(string|array<string> $valid_to) Return ChildSpyCmsBlock objects filtered by the valid_to column
 * @psalm-method Collection&\Traversable<ChildSpyCmsBlock> findByValidTo(string|array<string> $valid_to) Return ChildSpyCmsBlock objects filtered by the valid_to column
 *
 * @method     ChildSpyCmsBlock[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyCmsBlock> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyCmsBlockQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\CmsBlock\Persistence\Base\SpyCmsBlockQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\CmsBlock\\Persistence\\SpyCmsBlock', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyCmsBlockQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyCmsBlockQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyCmsBlockQuery) {
            return $criteria;
        }
        $query = new ChildSpyCmsBlockQuery();
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
     * @return ChildSpyCmsBlock|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyCmsBlockTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyCmsBlock A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id_cms_block`, `fk_template`, `is_active`, `key`, `name`, `valid_from`, `valid_to` FROM `spy_cms_block` WHERE `id_cms_block` = :p0';
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
            /** @var ChildSpyCmsBlock $obj */
            $obj = new ChildSpyCmsBlock();
            $obj->hydrate($row);
            SpyCmsBlockTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyCmsBlock|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyCmsBlockTableMap::COL_ID_CMS_BLOCK, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyCmsBlockTableMap::COL_ID_CMS_BLOCK, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idCmsBlock Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdCmsBlock_Between(array $idCmsBlock)
    {
        return $this->filterByIdCmsBlock($idCmsBlock, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idCmsBlocks Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdCmsBlock_In(array $idCmsBlocks)
    {
        return $this->filterByIdCmsBlock($idCmsBlocks, Criteria::IN);
    }

    /**
     * Filter the query on the id_cms_block column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCmsBlock(1234); // WHERE id_cms_block = 1234
     * $query->filterByIdCmsBlock(array(12, 34), Criteria::IN); // WHERE id_cms_block IN (12, 34)
     * $query->filterByIdCmsBlock(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_cms_block > 12
     * </code>
     *
     * @param     mixed $idCmsBlock The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdCmsBlock($idCmsBlock = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idCmsBlock)) {
            $useMinMax = false;
            if (isset($idCmsBlock['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCmsBlockTableMap::COL_ID_CMS_BLOCK, $idCmsBlock['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCmsBlock['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCmsBlockTableMap::COL_ID_CMS_BLOCK, $idCmsBlock['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idCmsBlock of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCmsBlockTableMap::COL_ID_CMS_BLOCK, $idCmsBlock, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkTemplate Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkTemplate_Between(array $fkTemplate)
    {
        return $this->filterByFkTemplate($fkTemplate, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkTemplates Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkTemplate_In(array $fkTemplates)
    {
        return $this->filterByFkTemplate($fkTemplates, Criteria::IN);
    }

    /**
     * Filter the query on the fk_template column
     *
     * Example usage:
     * <code>
     * $query->filterByFkTemplate(1234); // WHERE fk_template = 1234
     * $query->filterByFkTemplate(array(12, 34), Criteria::IN); // WHERE fk_template IN (12, 34)
     * $query->filterByFkTemplate(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_template > 12
     * </code>
     *
     * @see       filterByCmsBlockTemplate()
     *
     * @param     mixed $fkTemplate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkTemplate($fkTemplate = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkTemplate)) {
            $useMinMax = false;
            if (isset($fkTemplate['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCmsBlockTableMap::COL_FK_TEMPLATE, $fkTemplate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkTemplate['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCmsBlockTableMap::COL_FK_TEMPLATE, $fkTemplate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkTemplate of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCmsBlockTableMap::COL_FK_TEMPLATE, $fkTemplate, $comparison);

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

        $query = $this->addUsingAlias(SpyCmsBlockTableMap::COL_IS_ACTIVE, $isActive, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $keys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByKey_In(array $keys)
    {
        return $this->filterByKey($keys, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $key Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByKey_Like($key)
    {
        return $this->filterByKey($key, Criteria::LIKE);
    }

    /**
     * Filter the query on the key column
     *
     * Example usage:
     * <code>
     * $query->filterByKey('fooValue');   // WHERE key = 'fooValue'
     * $query->filterByKey('%fooValue%', Criteria::LIKE); // WHERE key LIKE '%fooValue%'
     * $query->filterByKey([1, 'foo'], Criteria::IN); // WHERE key IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $key The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByKey($key = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $key = str_replace('*', '%', $key);
        }

        if (is_array($key) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$key of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCmsBlockTableMap::COL_KEY, $key, $comparison);

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

        $query = $this->addUsingAlias(SpyCmsBlockTableMap::COL_NAME, $name, $comparison);

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
                $this->addUsingAlias(SpyCmsBlockTableMap::COL_VALID_FROM, $validFrom['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($validFrom['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCmsBlockTableMap::COL_VALID_FROM, $validFrom['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$validFrom of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCmsBlockTableMap::COL_VALID_FROM, $validFrom, $comparison);

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
                $this->addUsingAlias(SpyCmsBlockTableMap::COL_VALID_TO, $validTo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($validTo['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCmsBlockTableMap::COL_VALID_TO, $validTo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$validTo of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCmsBlockTableMap::COL_VALID_TO, $validTo, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockTemplate object
     *
     * @param \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockTemplate|ObjectCollection $spyCmsBlockTemplate The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCmsBlockTemplate($spyCmsBlockTemplate, ?string $comparison = null)
    {
        if ($spyCmsBlockTemplate instanceof \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockTemplate) {
            return $this
                ->addUsingAlias(SpyCmsBlockTableMap::COL_FK_TEMPLATE, $spyCmsBlockTemplate->getIdCmsBlockTemplate(), $comparison);
        } elseif ($spyCmsBlockTemplate instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyCmsBlockTableMap::COL_FK_TEMPLATE, $spyCmsBlockTemplate->toKeyValue('PrimaryKey', 'IdCmsBlockTemplate'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCmsBlockTemplate() only accepts arguments of type \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockTemplate or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CmsBlockTemplate relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCmsBlockTemplate(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CmsBlockTemplate');

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
            $this->addJoinObject($join, 'CmsBlockTemplate');
        }

        return $this;
    }

    /**
     * Use the CmsBlockTemplate relation SpyCmsBlockTemplate object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockTemplateQuery A secondary query class using the current class as primary query
     */
    public function useCmsBlockTemplateQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCmsBlockTemplate($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CmsBlockTemplate', '\Orm\Zed\CmsBlock\Persistence\SpyCmsBlockTemplateQuery');
    }

    /**
     * Use the CmsBlockTemplate relation SpyCmsBlockTemplate object
     *
     * @param callable(\Orm\Zed\CmsBlock\Persistence\SpyCmsBlockTemplateQuery):\Orm\Zed\CmsBlock\Persistence\SpyCmsBlockTemplateQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCmsBlockTemplateQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useCmsBlockTemplateQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the CmsBlockTemplate relation to the SpyCmsBlockTemplate table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockTemplateQuery The inner query object of the EXISTS statement
     */
    public function useCmsBlockTemplateExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockTemplateQuery */
        $q = $this->useExistsQuery('CmsBlockTemplate', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the CmsBlockTemplate relation to the SpyCmsBlockTemplate table for a NOT EXISTS query.
     *
     * @see useCmsBlockTemplateExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockTemplateQuery The inner query object of the NOT EXISTS statement
     */
    public function useCmsBlockTemplateNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockTemplateQuery */
        $q = $this->useExistsQuery('CmsBlockTemplate', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the CmsBlockTemplate relation to the SpyCmsBlockTemplate table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockTemplateQuery The inner query object of the IN statement
     */
    public function useInCmsBlockTemplateQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockTemplateQuery */
        $q = $this->useInQuery('CmsBlockTemplate', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the CmsBlockTemplate relation to the SpyCmsBlockTemplate table for a NOT IN query.
     *
     * @see useCmsBlockTemplateInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockTemplateQuery The inner query object of the NOT IN statement
     */
    public function useNotInCmsBlockTemplateQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockTemplateQuery */
        $q = $this->useInQuery('CmsBlockTemplate', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockGlossaryKeyMapping object
     *
     * @param \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockGlossaryKeyMapping|ObjectCollection $spyCmsBlockGlossaryKeyMapping the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCmsBlockGlossaryKeyMapping($spyCmsBlockGlossaryKeyMapping, ?string $comparison = null)
    {
        if ($spyCmsBlockGlossaryKeyMapping instanceof \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockGlossaryKeyMapping) {
            $this
                ->addUsingAlias(SpyCmsBlockTableMap::COL_ID_CMS_BLOCK, $spyCmsBlockGlossaryKeyMapping->getFkCmsBlock(), $comparison);

            return $this;
        } elseif ($spyCmsBlockGlossaryKeyMapping instanceof ObjectCollection) {
            $this
                ->useSpyCmsBlockGlossaryKeyMappingQuery()
                ->filterByPrimaryKeys($spyCmsBlockGlossaryKeyMapping->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyCmsBlockGlossaryKeyMapping() only accepts arguments of type \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockGlossaryKeyMapping or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCmsBlockGlossaryKeyMapping relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCmsBlockGlossaryKeyMapping(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCmsBlockGlossaryKeyMapping');

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
            $this->addJoinObject($join, 'SpyCmsBlockGlossaryKeyMapping');
        }

        return $this;
    }

    /**
     * Use the SpyCmsBlockGlossaryKeyMapping relation SpyCmsBlockGlossaryKeyMapping object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockGlossaryKeyMappingQuery A secondary query class using the current class as primary query
     */
    public function useSpyCmsBlockGlossaryKeyMappingQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyCmsBlockGlossaryKeyMapping($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCmsBlockGlossaryKeyMapping', '\Orm\Zed\CmsBlock\Persistence\SpyCmsBlockGlossaryKeyMappingQuery');
    }

    /**
     * Use the SpyCmsBlockGlossaryKeyMapping relation SpyCmsBlockGlossaryKeyMapping object
     *
     * @param callable(\Orm\Zed\CmsBlock\Persistence\SpyCmsBlockGlossaryKeyMappingQuery):\Orm\Zed\CmsBlock\Persistence\SpyCmsBlockGlossaryKeyMappingQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCmsBlockGlossaryKeyMappingQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyCmsBlockGlossaryKeyMappingQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyCmsBlockGlossaryKeyMapping table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockGlossaryKeyMappingQuery The inner query object of the EXISTS statement
     */
    public function useSpyCmsBlockGlossaryKeyMappingExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockGlossaryKeyMappingQuery */
        $q = $this->useExistsQuery('SpyCmsBlockGlossaryKeyMapping', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyCmsBlockGlossaryKeyMapping table for a NOT EXISTS query.
     *
     * @see useSpyCmsBlockGlossaryKeyMappingExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockGlossaryKeyMappingQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCmsBlockGlossaryKeyMappingNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockGlossaryKeyMappingQuery */
        $q = $this->useExistsQuery('SpyCmsBlockGlossaryKeyMapping', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyCmsBlockGlossaryKeyMapping table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockGlossaryKeyMappingQuery The inner query object of the IN statement
     */
    public function useInSpyCmsBlockGlossaryKeyMappingQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockGlossaryKeyMappingQuery */
        $q = $this->useInQuery('SpyCmsBlockGlossaryKeyMapping', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyCmsBlockGlossaryKeyMapping table for a NOT IN query.
     *
     * @see useSpyCmsBlockGlossaryKeyMappingInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockGlossaryKeyMappingQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyCmsBlockGlossaryKeyMappingQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockGlossaryKeyMappingQuery */
        $q = $this->useInQuery('SpyCmsBlockGlossaryKeyMapping', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStore object
     *
     * @param \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStore|ObjectCollection $spyCmsBlockStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCmsBlockStore($spyCmsBlockStore, ?string $comparison = null)
    {
        if ($spyCmsBlockStore instanceof \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStore) {
            $this
                ->addUsingAlias(SpyCmsBlockTableMap::COL_ID_CMS_BLOCK, $spyCmsBlockStore->getFkCmsBlock(), $comparison);

            return $this;
        } elseif ($spyCmsBlockStore instanceof ObjectCollection) {
            $this
                ->useSpyCmsBlockStoreQuery()
                ->filterByPrimaryKeys($spyCmsBlockStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyCmsBlockStore() only accepts arguments of type \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCmsBlockStore relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCmsBlockStore(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCmsBlockStore');

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
            $this->addJoinObject($join, 'SpyCmsBlockStore');
        }

        return $this;
    }

    /**
     * Use the SpyCmsBlockStore relation SpyCmsBlockStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStoreQuery A secondary query class using the current class as primary query
     */
    public function useSpyCmsBlockStoreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyCmsBlockStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCmsBlockStore', '\Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStoreQuery');
    }

    /**
     * Use the SpyCmsBlockStore relation SpyCmsBlockStore object
     *
     * @param callable(\Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStoreQuery):\Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCmsBlockStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyCmsBlockStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyCmsBlockStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStoreQuery The inner query object of the EXISTS statement
     */
    public function useSpyCmsBlockStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStoreQuery */
        $q = $this->useExistsQuery('SpyCmsBlockStore', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyCmsBlockStore table for a NOT EXISTS query.
     *
     * @see useSpyCmsBlockStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCmsBlockStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStoreQuery */
        $q = $this->useExistsQuery('SpyCmsBlockStore', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyCmsBlockStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStoreQuery The inner query object of the IN statement
     */
    public function useInSpyCmsBlockStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStoreQuery */
        $q = $this->useInQuery('SpyCmsBlockStore', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyCmsBlockStore table for a NOT IN query.
     *
     * @see useSpyCmsBlockStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyCmsBlockStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStoreQuery */
        $q = $this->useInQuery('SpyCmsBlockStore', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnector object
     *
     * @param \Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnector|ObjectCollection $spyCmsBlockCategoryConnector the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCmsBlockCategoryConnector($spyCmsBlockCategoryConnector, ?string $comparison = null)
    {
        if ($spyCmsBlockCategoryConnector instanceof \Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnector) {
            $this
                ->addUsingAlias(SpyCmsBlockTableMap::COL_ID_CMS_BLOCK, $spyCmsBlockCategoryConnector->getFkCmsBlock(), $comparison);

            return $this;
        } elseif ($spyCmsBlockCategoryConnector instanceof ObjectCollection) {
            $this
                ->useSpyCmsBlockCategoryConnectorQuery()
                ->filterByPrimaryKeys($spyCmsBlockCategoryConnector->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyCmsBlockCategoryConnector() only accepts arguments of type \Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnector or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCmsBlockCategoryConnector relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCmsBlockCategoryConnector(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCmsBlockCategoryConnector');

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
            $this->addJoinObject($join, 'SpyCmsBlockCategoryConnector');
        }

        return $this;
    }

    /**
     * Use the SpyCmsBlockCategoryConnector relation SpyCmsBlockCategoryConnector object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnectorQuery A secondary query class using the current class as primary query
     */
    public function useSpyCmsBlockCategoryConnectorQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyCmsBlockCategoryConnector($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCmsBlockCategoryConnector', '\Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnectorQuery');
    }

    /**
     * Use the SpyCmsBlockCategoryConnector relation SpyCmsBlockCategoryConnector object
     *
     * @param callable(\Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnectorQuery):\Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnectorQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCmsBlockCategoryConnectorQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyCmsBlockCategoryConnectorQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyCmsBlockCategoryConnector table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnectorQuery The inner query object of the EXISTS statement
     */
    public function useSpyCmsBlockCategoryConnectorExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnectorQuery */
        $q = $this->useExistsQuery('SpyCmsBlockCategoryConnector', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyCmsBlockCategoryConnector table for a NOT EXISTS query.
     *
     * @see useSpyCmsBlockCategoryConnectorExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnectorQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCmsBlockCategoryConnectorNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnectorQuery */
        $q = $this->useExistsQuery('SpyCmsBlockCategoryConnector', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyCmsBlockCategoryConnector table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnectorQuery The inner query object of the IN statement
     */
    public function useInSpyCmsBlockCategoryConnectorQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnectorQuery */
        $q = $this->useInQuery('SpyCmsBlockCategoryConnector', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyCmsBlockCategoryConnector table for a NOT IN query.
     *
     * @see useSpyCmsBlockCategoryConnectorInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnectorQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyCmsBlockCategoryConnectorQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnectorQuery */
        $q = $this->useInQuery('SpyCmsBlockCategoryConnector', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnector object
     *
     * @param \Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnector|ObjectCollection $spyCmsBlockProductConnector the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCmsBlockProductConnector($spyCmsBlockProductConnector, ?string $comparison = null)
    {
        if ($spyCmsBlockProductConnector instanceof \Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnector) {
            $this
                ->addUsingAlias(SpyCmsBlockTableMap::COL_ID_CMS_BLOCK, $spyCmsBlockProductConnector->getFkCmsBlock(), $comparison);

            return $this;
        } elseif ($spyCmsBlockProductConnector instanceof ObjectCollection) {
            $this
                ->useSpyCmsBlockProductConnectorQuery()
                ->filterByPrimaryKeys($spyCmsBlockProductConnector->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyCmsBlockProductConnector() only accepts arguments of type \Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnector or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCmsBlockProductConnector relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCmsBlockProductConnector(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCmsBlockProductConnector');

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
            $this->addJoinObject($join, 'SpyCmsBlockProductConnector');
        }

        return $this;
    }

    /**
     * Use the SpyCmsBlockProductConnector relation SpyCmsBlockProductConnector object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnectorQuery A secondary query class using the current class as primary query
     */
    public function useSpyCmsBlockProductConnectorQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyCmsBlockProductConnector($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCmsBlockProductConnector', '\Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnectorQuery');
    }

    /**
     * Use the SpyCmsBlockProductConnector relation SpyCmsBlockProductConnector object
     *
     * @param callable(\Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnectorQuery):\Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnectorQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCmsBlockProductConnectorQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyCmsBlockProductConnectorQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyCmsBlockProductConnector table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnectorQuery The inner query object of the EXISTS statement
     */
    public function useSpyCmsBlockProductConnectorExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnectorQuery */
        $q = $this->useExistsQuery('SpyCmsBlockProductConnector', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyCmsBlockProductConnector table for a NOT EXISTS query.
     *
     * @see useSpyCmsBlockProductConnectorExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnectorQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCmsBlockProductConnectorNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnectorQuery */
        $q = $this->useExistsQuery('SpyCmsBlockProductConnector', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyCmsBlockProductConnector table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnectorQuery The inner query object of the IN statement
     */
    public function useInSpyCmsBlockProductConnectorQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnectorQuery */
        $q = $this->useInQuery('SpyCmsBlockProductConnector', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyCmsBlockProductConnector table for a NOT IN query.
     *
     * @see useSpyCmsBlockProductConnectorInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnectorQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyCmsBlockProductConnectorQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnectorQuery */
        $q = $this->useInQuery('SpyCmsBlockProductConnector', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(SpyCmsBlockTableMap::COL_ID_CMS_BLOCK, $spyCmsSlotBlock->getFkCmsBlock(), $comparison);

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
     * @param ChildSpyCmsBlock $spyCmsBlock Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyCmsBlock = null)
    {
        if ($spyCmsBlock) {
            $this->addUsingAlias(SpyCmsBlockTableMap::COL_ID_CMS_BLOCK, $spyCmsBlock->getIdCmsBlock(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_cms_block table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsBlockTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyCmsBlockTableMap::clearInstancePool();
            SpyCmsBlockTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsBlockTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyCmsBlockTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyCmsBlockTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyCmsBlockTableMap::clearRelatedInstancePool();

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
