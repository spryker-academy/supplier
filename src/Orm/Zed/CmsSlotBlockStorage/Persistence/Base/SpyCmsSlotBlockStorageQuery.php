<?php

namespace Orm\Zed\CmsSlotBlockStorage\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\CmsSlotBlockStorage\Persistence\SpyCmsSlotBlockStorage as ChildSpyCmsSlotBlockStorage;
use Orm\Zed\CmsSlotBlockStorage\Persistence\SpyCmsSlotBlockStorageQuery as ChildSpyCmsSlotBlockStorageQuery;
use Orm\Zed\CmsSlotBlockStorage\Persistence\Map\SpyCmsSlotBlockStorageTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Spryker\Zed\PropelOrm\Business\Model\Formatter\TypeAwareSimpleArrayFormatter;
use Spryker\Zed\PropelOrm\Business\Runtime\ActiveQuery\Criteria as SprykerCriteria;
use Spryker\Zed\PropelReplicationCache\Business\PropelReplicationCacheFacade;
use Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException;

/**
 * Base class that represents a query for the `spy_cms_slot_block_storage` table.
 *
 * @method     ChildSpyCmsSlotBlockStorageQuery orderByIdCmsSlotBlockStorage($order = Criteria::ASC) Order by the id_cms_slot_block_storage column
 * @method     ChildSpyCmsSlotBlockStorageQuery orderByFkCmsSlot($order = Criteria::ASC) Order by the fk_cms_slot column
 * @method     ChildSpyCmsSlotBlockStorageQuery orderByFkCmsSlotTemplate($order = Criteria::ASC) Order by the fk_cms_slot_template column
 * @method     ChildSpyCmsSlotBlockStorageQuery orderByData($order = Criteria::ASC) Order by the data column
 * @method     ChildSpyCmsSlotBlockStorageQuery orderByKey($order = Criteria::ASC) Order by the key column
 * @method     ChildSpyCmsSlotBlockStorageQuery orderBySlotTemplateKey($order = Criteria::ASC) Order by the slot_template_key column
 * @method     ChildSpyCmsSlotBlockStorageQuery orderByAliasKeys($order = Criteria::ASC) Order by the alias_keys column
 * @method     ChildSpyCmsSlotBlockStorageQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpyCmsSlotBlockStorageQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpyCmsSlotBlockStorageQuery groupByIdCmsSlotBlockStorage() Group by the id_cms_slot_block_storage column
 * @method     ChildSpyCmsSlotBlockStorageQuery groupByFkCmsSlot() Group by the fk_cms_slot column
 * @method     ChildSpyCmsSlotBlockStorageQuery groupByFkCmsSlotTemplate() Group by the fk_cms_slot_template column
 * @method     ChildSpyCmsSlotBlockStorageQuery groupByData() Group by the data column
 * @method     ChildSpyCmsSlotBlockStorageQuery groupByKey() Group by the key column
 * @method     ChildSpyCmsSlotBlockStorageQuery groupBySlotTemplateKey() Group by the slot_template_key column
 * @method     ChildSpyCmsSlotBlockStorageQuery groupByAliasKeys() Group by the alias_keys column
 * @method     ChildSpyCmsSlotBlockStorageQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpyCmsSlotBlockStorageQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpyCmsSlotBlockStorageQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyCmsSlotBlockStorageQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyCmsSlotBlockStorageQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyCmsSlotBlockStorageQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyCmsSlotBlockStorageQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyCmsSlotBlockStorageQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyCmsSlotBlockStorage|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyCmsSlotBlockStorage matching the query
 * @method     ChildSpyCmsSlotBlockStorage findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyCmsSlotBlockStorage matching the query, or a new ChildSpyCmsSlotBlockStorage object populated from the query conditions when no match is found
 *
 * @method     ChildSpyCmsSlotBlockStorage|null findOneByIdCmsSlotBlockStorage(int $id_cms_slot_block_storage) Return the first ChildSpyCmsSlotBlockStorage filtered by the id_cms_slot_block_storage column
 * @method     ChildSpyCmsSlotBlockStorage|null findOneByFkCmsSlot(int $fk_cms_slot) Return the first ChildSpyCmsSlotBlockStorage filtered by the fk_cms_slot column
 * @method     ChildSpyCmsSlotBlockStorage|null findOneByFkCmsSlotTemplate(int $fk_cms_slot_template) Return the first ChildSpyCmsSlotBlockStorage filtered by the fk_cms_slot_template column
 * @method     ChildSpyCmsSlotBlockStorage|null findOneByData(string $data) Return the first ChildSpyCmsSlotBlockStorage filtered by the data column
 * @method     ChildSpyCmsSlotBlockStorage|null findOneByKey(string $key) Return the first ChildSpyCmsSlotBlockStorage filtered by the key column
 * @method     ChildSpyCmsSlotBlockStorage|null findOneBySlotTemplateKey(string $slot_template_key) Return the first ChildSpyCmsSlotBlockStorage filtered by the slot_template_key column
 * @method     ChildSpyCmsSlotBlockStorage|null findOneByAliasKeys(string $alias_keys) Return the first ChildSpyCmsSlotBlockStorage filtered by the alias_keys column
 * @method     ChildSpyCmsSlotBlockStorage|null findOneByCreatedAt(string $created_at) Return the first ChildSpyCmsSlotBlockStorage filtered by the created_at column
 * @method     ChildSpyCmsSlotBlockStorage|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpyCmsSlotBlockStorage filtered by the updated_at column
 *
 * @method     ChildSpyCmsSlotBlockStorage requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyCmsSlotBlockStorage by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCmsSlotBlockStorage requireOne(?ConnectionInterface $con = null) Return the first ChildSpyCmsSlotBlockStorage matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyCmsSlotBlockStorage requireOneByIdCmsSlotBlockStorage(int $id_cms_slot_block_storage) Return the first ChildSpyCmsSlotBlockStorage filtered by the id_cms_slot_block_storage column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCmsSlotBlockStorage requireOneByFkCmsSlot(int $fk_cms_slot) Return the first ChildSpyCmsSlotBlockStorage filtered by the fk_cms_slot column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCmsSlotBlockStorage requireOneByFkCmsSlotTemplate(int $fk_cms_slot_template) Return the first ChildSpyCmsSlotBlockStorage filtered by the fk_cms_slot_template column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCmsSlotBlockStorage requireOneByData(string $data) Return the first ChildSpyCmsSlotBlockStorage filtered by the data column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCmsSlotBlockStorage requireOneByKey(string $key) Return the first ChildSpyCmsSlotBlockStorage filtered by the key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCmsSlotBlockStorage requireOneBySlotTemplateKey(string $slot_template_key) Return the first ChildSpyCmsSlotBlockStorage filtered by the slot_template_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCmsSlotBlockStorage requireOneByAliasKeys(string $alias_keys) Return the first ChildSpyCmsSlotBlockStorage filtered by the alias_keys column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCmsSlotBlockStorage requireOneByCreatedAt(string $created_at) Return the first ChildSpyCmsSlotBlockStorage filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCmsSlotBlockStorage requireOneByUpdatedAt(string $updated_at) Return the first ChildSpyCmsSlotBlockStorage filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyCmsSlotBlockStorage[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyCmsSlotBlockStorage objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyCmsSlotBlockStorage> find(?ConnectionInterface $con = null) Return ChildSpyCmsSlotBlockStorage objects based on current ModelCriteria
 *
 * @method     ChildSpyCmsSlotBlockStorage[]|Collection findByIdCmsSlotBlockStorage(int|array<int> $id_cms_slot_block_storage) Return ChildSpyCmsSlotBlockStorage objects filtered by the id_cms_slot_block_storage column
 * @psalm-method Collection&\Traversable<ChildSpyCmsSlotBlockStorage> findByIdCmsSlotBlockStorage(int|array<int> $id_cms_slot_block_storage) Return ChildSpyCmsSlotBlockStorage objects filtered by the id_cms_slot_block_storage column
 * @method     ChildSpyCmsSlotBlockStorage[]|Collection findByFkCmsSlot(int|array<int> $fk_cms_slot) Return ChildSpyCmsSlotBlockStorage objects filtered by the fk_cms_slot column
 * @psalm-method Collection&\Traversable<ChildSpyCmsSlotBlockStorage> findByFkCmsSlot(int|array<int> $fk_cms_slot) Return ChildSpyCmsSlotBlockStorage objects filtered by the fk_cms_slot column
 * @method     ChildSpyCmsSlotBlockStorage[]|Collection findByFkCmsSlotTemplate(int|array<int> $fk_cms_slot_template) Return ChildSpyCmsSlotBlockStorage objects filtered by the fk_cms_slot_template column
 * @psalm-method Collection&\Traversable<ChildSpyCmsSlotBlockStorage> findByFkCmsSlotTemplate(int|array<int> $fk_cms_slot_template) Return ChildSpyCmsSlotBlockStorage objects filtered by the fk_cms_slot_template column
 * @method     ChildSpyCmsSlotBlockStorage[]|Collection findByData(string|array<string> $data) Return ChildSpyCmsSlotBlockStorage objects filtered by the data column
 * @psalm-method Collection&\Traversable<ChildSpyCmsSlotBlockStorage> findByData(string|array<string> $data) Return ChildSpyCmsSlotBlockStorage objects filtered by the data column
 * @method     ChildSpyCmsSlotBlockStorage[]|Collection findByKey(string|array<string> $key) Return ChildSpyCmsSlotBlockStorage objects filtered by the key column
 * @psalm-method Collection&\Traversable<ChildSpyCmsSlotBlockStorage> findByKey(string|array<string> $key) Return ChildSpyCmsSlotBlockStorage objects filtered by the key column
 * @method     ChildSpyCmsSlotBlockStorage[]|Collection findBySlotTemplateKey(string|array<string> $slot_template_key) Return ChildSpyCmsSlotBlockStorage objects filtered by the slot_template_key column
 * @psalm-method Collection&\Traversable<ChildSpyCmsSlotBlockStorage> findBySlotTemplateKey(string|array<string> $slot_template_key) Return ChildSpyCmsSlotBlockStorage objects filtered by the slot_template_key column
 * @method     ChildSpyCmsSlotBlockStorage[]|Collection findByAliasKeys(string|array<string> $alias_keys) Return ChildSpyCmsSlotBlockStorage objects filtered by the alias_keys column
 * @psalm-method Collection&\Traversable<ChildSpyCmsSlotBlockStorage> findByAliasKeys(string|array<string> $alias_keys) Return ChildSpyCmsSlotBlockStorage objects filtered by the alias_keys column
 * @method     ChildSpyCmsSlotBlockStorage[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpyCmsSlotBlockStorage objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpyCmsSlotBlockStorage> findByCreatedAt(string|array<string> $created_at) Return ChildSpyCmsSlotBlockStorage objects filtered by the created_at column
 * @method     ChildSpyCmsSlotBlockStorage[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyCmsSlotBlockStorage objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpyCmsSlotBlockStorage> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyCmsSlotBlockStorage objects filtered by the updated_at column
 *
 * @method     ChildSpyCmsSlotBlockStorage[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyCmsSlotBlockStorage> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyCmsSlotBlockStorageQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\CmsSlotBlockStorage\Persistence\Base\SpyCmsSlotBlockStorageQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\CmsSlotBlockStorage\\Persistence\\SpyCmsSlotBlockStorage', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyCmsSlotBlockStorageQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyCmsSlotBlockStorageQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyCmsSlotBlockStorageQuery) {
            return $criteria;
        }
        $query = new ChildSpyCmsSlotBlockStorageQuery();
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
     * @return ChildSpyCmsSlotBlockStorage|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyCmsSlotBlockStorageTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyCmsSlotBlockStorage A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id_cms_slot_block_storage`, `fk_cms_slot`, `fk_cms_slot_template`, `data`, `key`, `slot_template_key`, `alias_keys`, `created_at`, `updated_at` FROM `spy_cms_slot_block_storage` WHERE `id_cms_slot_block_storage` = :p0';
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
            /** @var ChildSpyCmsSlotBlockStorage $obj */
            $obj = new ChildSpyCmsSlotBlockStorage();
            $obj->hydrate($row);
            SpyCmsSlotBlockStorageTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyCmsSlotBlockStorage|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyCmsSlotBlockStorageTableMap::COL_ID_CMS_SLOT_BLOCK_STORAGE, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyCmsSlotBlockStorageTableMap::COL_ID_CMS_SLOT_BLOCK_STORAGE, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idCmsSlotBlockStorage Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdCmsSlotBlockStorage_Between(array $idCmsSlotBlockStorage)
    {
        return $this->filterByIdCmsSlotBlockStorage($idCmsSlotBlockStorage, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idCmsSlotBlockStorages Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdCmsSlotBlockStorage_In(array $idCmsSlotBlockStorages)
    {
        return $this->filterByIdCmsSlotBlockStorage($idCmsSlotBlockStorages, Criteria::IN);
    }

    /**
     * Filter the query on the id_cms_slot_block_storage column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCmsSlotBlockStorage(1234); // WHERE id_cms_slot_block_storage = 1234
     * $query->filterByIdCmsSlotBlockStorage(array(12, 34), Criteria::IN); // WHERE id_cms_slot_block_storage IN (12, 34)
     * $query->filterByIdCmsSlotBlockStorage(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_cms_slot_block_storage > 12
     * </code>
     *
     * @param     mixed $idCmsSlotBlockStorage The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdCmsSlotBlockStorage($idCmsSlotBlockStorage = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idCmsSlotBlockStorage)) {
            $useMinMax = false;
            if (isset($idCmsSlotBlockStorage['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCmsSlotBlockStorageTableMap::COL_ID_CMS_SLOT_BLOCK_STORAGE, $idCmsSlotBlockStorage['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCmsSlotBlockStorage['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCmsSlotBlockStorageTableMap::COL_ID_CMS_SLOT_BLOCK_STORAGE, $idCmsSlotBlockStorage['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idCmsSlotBlockStorage of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCmsSlotBlockStorageTableMap::COL_ID_CMS_SLOT_BLOCK_STORAGE, $idCmsSlotBlockStorage, $comparison);

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
                $this->addUsingAlias(SpyCmsSlotBlockStorageTableMap::COL_FK_CMS_SLOT, $fkCmsSlot['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkCmsSlot['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCmsSlotBlockStorageTableMap::COL_FK_CMS_SLOT, $fkCmsSlot['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkCmsSlot of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCmsSlotBlockStorageTableMap::COL_FK_CMS_SLOT, $fkCmsSlot, $comparison);

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
                $this->addUsingAlias(SpyCmsSlotBlockStorageTableMap::COL_FK_CMS_SLOT_TEMPLATE, $fkCmsSlotTemplate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkCmsSlotTemplate['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCmsSlotBlockStorageTableMap::COL_FK_CMS_SLOT_TEMPLATE, $fkCmsSlotTemplate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkCmsSlotTemplate of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCmsSlotBlockStorageTableMap::COL_FK_CMS_SLOT_TEMPLATE, $fkCmsSlotTemplate, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $datas Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByData_In(array $datas)
    {
        return $this->filterByData($datas, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $data Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByData_Like($data)
    {
        return $this->filterByData($data, Criteria::LIKE);
    }

    /**
     * Filter the query on the data column
     *
     * Example usage:
     * <code>
     * $query->filterByData('fooValue');   // WHERE data = 'fooValue'
     * $query->filterByData('%fooValue%', Criteria::LIKE); // WHERE data LIKE '%fooValue%'
     * $query->filterByData([1, 'foo'], Criteria::IN); // WHERE data IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $data The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByData($data = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $data = str_replace('*', '%', $data);
        }

        if (is_array($data) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$data of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCmsSlotBlockStorageTableMap::COL_DATA, $data, $comparison);

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

        $query = $this->addUsingAlias(SpyCmsSlotBlockStorageTableMap::COL_KEY, $key, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $slotTemplateKeys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySlotTemplateKey_In(array $slotTemplateKeys)
    {
        return $this->filterBySlotTemplateKey($slotTemplateKeys, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $slotTemplateKey Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySlotTemplateKey_Like($slotTemplateKey)
    {
        return $this->filterBySlotTemplateKey($slotTemplateKey, Criteria::LIKE);
    }

    /**
     * Filter the query on the slot_template_key column
     *
     * Example usage:
     * <code>
     * $query->filterBySlotTemplateKey('fooValue');   // WHERE slot_template_key = 'fooValue'
     * $query->filterBySlotTemplateKey('%fooValue%', Criteria::LIKE); // WHERE slot_template_key LIKE '%fooValue%'
     * $query->filterBySlotTemplateKey([1, 'foo'], Criteria::IN); // WHERE slot_template_key IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $slotTemplateKey The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterBySlotTemplateKey($slotTemplateKey = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $slotTemplateKey = str_replace('*', '%', $slotTemplateKey);
        }

        if (is_array($slotTemplateKey) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$slotTemplateKey of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCmsSlotBlockStorageTableMap::COL_SLOT_TEMPLATE_KEY, $slotTemplateKey, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $aliasKeyss Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAliasKeys_In(array $aliasKeyss)
    {
        return $this->filterByAliasKeys($aliasKeyss, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $aliasKeys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAliasKeys_Like($aliasKeys)
    {
        return $this->filterByAliasKeys($aliasKeys, Criteria::LIKE);
    }

    /**
     * Filter the query on the alias_keys column
     *
     * Example usage:
     * <code>
     * $query->filterByAliasKeys('fooValue');   // WHERE alias_keys = 'fooValue'
     * $query->filterByAliasKeys('%fooValue%', Criteria::LIKE); // WHERE alias_keys LIKE '%fooValue%'
     * $query->filterByAliasKeys([1, 'foo'], Criteria::IN); // WHERE alias_keys IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $aliasKeys The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAliasKeys($aliasKeys = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $aliasKeys = str_replace('*', '%', $aliasKeys);
        }

        if (is_array($aliasKeys) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$aliasKeys of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCmsSlotBlockStorageTableMap::COL_ALIAS_KEYS, $aliasKeys, $comparison);

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
                $this->addUsingAlias(SpyCmsSlotBlockStorageTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCmsSlotBlockStorageTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCmsSlotBlockStorageTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SpyCmsSlotBlockStorageTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCmsSlotBlockStorageTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCmsSlotBlockStorageTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $query;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyCmsSlotBlockStorage $spyCmsSlotBlockStorage Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyCmsSlotBlockStorage = null)
    {
        if ($spyCmsSlotBlockStorage) {
            $this->addUsingAlias(SpyCmsSlotBlockStorageTableMap::COL_ID_CMS_SLOT_BLOCK_STORAGE, $spyCmsSlotBlockStorage->getIdCmsSlotBlockStorage(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_cms_slot_block_storage table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsSlotBlockStorageTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyCmsSlotBlockStorageTableMap::clearInstancePool();
            SpyCmsSlotBlockStorageTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsSlotBlockStorageTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyCmsSlotBlockStorageTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyCmsSlotBlockStorageTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyCmsSlotBlockStorageTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(SpyCmsSlotBlockStorageTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyCmsSlotBlockStorageTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyCmsSlotBlockStorageTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyCmsSlotBlockStorageTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpyCmsSlotBlockStorageTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyCmsSlotBlockStorageTableMap::COL_CREATED_AT);

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
