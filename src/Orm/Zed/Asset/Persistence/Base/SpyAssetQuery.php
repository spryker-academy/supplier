<?php

namespace Orm\Zed\Asset\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\Asset\Persistence\SpyAsset as ChildSpyAsset;
use Orm\Zed\Asset\Persistence\SpyAssetQuery as ChildSpyAssetQuery;
use Orm\Zed\Asset\Persistence\Map\SpyAssetTableMap;
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
 * Base class that represents a query for the `spy_asset` table.
 *
 * @method     ChildSpyAssetQuery orderByIdAsset($order = Criteria::ASC) Order by the id_asset column
 * @method     ChildSpyAssetQuery orderByAssetSlot($order = Criteria::ASC) Order by the asset_slot column
 * @method     ChildSpyAssetQuery orderByAssetUuid($order = Criteria::ASC) Order by the asset_uuid column
 * @method     ChildSpyAssetQuery orderByAssetName($order = Criteria::ASC) Order by the asset_name column
 * @method     ChildSpyAssetQuery orderByAssetContent($order = Criteria::ASC) Order by the asset_content column
 * @method     ChildSpyAssetQuery orderByIsActive($order = Criteria::ASC) Order by the is_active column
 * @method     ChildSpyAssetQuery orderByLastMessageTimestamp($order = Criteria::ASC) Order by the last_message_timestamp column
 *
 * @method     ChildSpyAssetQuery groupByIdAsset() Group by the id_asset column
 * @method     ChildSpyAssetQuery groupByAssetSlot() Group by the asset_slot column
 * @method     ChildSpyAssetQuery groupByAssetUuid() Group by the asset_uuid column
 * @method     ChildSpyAssetQuery groupByAssetName() Group by the asset_name column
 * @method     ChildSpyAssetQuery groupByAssetContent() Group by the asset_content column
 * @method     ChildSpyAssetQuery groupByIsActive() Group by the is_active column
 * @method     ChildSpyAssetQuery groupByLastMessageTimestamp() Group by the last_message_timestamp column
 *
 * @method     ChildSpyAssetQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyAssetQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyAssetQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyAssetQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyAssetQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyAssetQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyAssetQuery leftJoinSpyAssetStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyAssetStore relation
 * @method     ChildSpyAssetQuery rightJoinSpyAssetStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyAssetStore relation
 * @method     ChildSpyAssetQuery innerJoinSpyAssetStore($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyAssetStore relation
 *
 * @method     ChildSpyAssetQuery joinWithSpyAssetStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyAssetStore relation
 *
 * @method     ChildSpyAssetQuery leftJoinWithSpyAssetStore() Adds a LEFT JOIN clause and with to the query using the SpyAssetStore relation
 * @method     ChildSpyAssetQuery rightJoinWithSpyAssetStore() Adds a RIGHT JOIN clause and with to the query using the SpyAssetStore relation
 * @method     ChildSpyAssetQuery innerJoinWithSpyAssetStore() Adds a INNER JOIN clause and with to the query using the SpyAssetStore relation
 *
 * @method     \Orm\Zed\Asset\Persistence\SpyAssetStoreQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyAsset|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyAsset matching the query
 * @method     ChildSpyAsset findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyAsset matching the query, or a new ChildSpyAsset object populated from the query conditions when no match is found
 *
 * @method     ChildSpyAsset|null findOneByIdAsset(int $id_asset) Return the first ChildSpyAsset filtered by the id_asset column
 * @method     ChildSpyAsset|null findOneByAssetSlot(string $asset_slot) Return the first ChildSpyAsset filtered by the asset_slot column
 * @method     ChildSpyAsset|null findOneByAssetUuid(string $asset_uuid) Return the first ChildSpyAsset filtered by the asset_uuid column
 * @method     ChildSpyAsset|null findOneByAssetName(string $asset_name) Return the first ChildSpyAsset filtered by the asset_name column
 * @method     ChildSpyAsset|null findOneByAssetContent(string $asset_content) Return the first ChildSpyAsset filtered by the asset_content column
 * @method     ChildSpyAsset|null findOneByIsActive(boolean $is_active) Return the first ChildSpyAsset filtered by the is_active column
 * @method     ChildSpyAsset|null findOneByLastMessageTimestamp(string $last_message_timestamp) Return the first ChildSpyAsset filtered by the last_message_timestamp column
 *
 * @method     ChildSpyAsset requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyAsset by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyAsset requireOne(?ConnectionInterface $con = null) Return the first ChildSpyAsset matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyAsset requireOneByIdAsset(int $id_asset) Return the first ChildSpyAsset filtered by the id_asset column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyAsset requireOneByAssetSlot(string $asset_slot) Return the first ChildSpyAsset filtered by the asset_slot column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyAsset requireOneByAssetUuid(string $asset_uuid) Return the first ChildSpyAsset filtered by the asset_uuid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyAsset requireOneByAssetName(string $asset_name) Return the first ChildSpyAsset filtered by the asset_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyAsset requireOneByAssetContent(string $asset_content) Return the first ChildSpyAsset filtered by the asset_content column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyAsset requireOneByIsActive(boolean $is_active) Return the first ChildSpyAsset filtered by the is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyAsset requireOneByLastMessageTimestamp(string $last_message_timestamp) Return the first ChildSpyAsset filtered by the last_message_timestamp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyAsset[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyAsset objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyAsset> find(?ConnectionInterface $con = null) Return ChildSpyAsset objects based on current ModelCriteria
 *
 * @method     ChildSpyAsset[]|Collection findByIdAsset(int|array<int> $id_asset) Return ChildSpyAsset objects filtered by the id_asset column
 * @psalm-method Collection&\Traversable<ChildSpyAsset> findByIdAsset(int|array<int> $id_asset) Return ChildSpyAsset objects filtered by the id_asset column
 * @method     ChildSpyAsset[]|Collection findByAssetSlot(string|array<string> $asset_slot) Return ChildSpyAsset objects filtered by the asset_slot column
 * @psalm-method Collection&\Traversable<ChildSpyAsset> findByAssetSlot(string|array<string> $asset_slot) Return ChildSpyAsset objects filtered by the asset_slot column
 * @method     ChildSpyAsset[]|Collection findByAssetUuid(string|array<string> $asset_uuid) Return ChildSpyAsset objects filtered by the asset_uuid column
 * @psalm-method Collection&\Traversable<ChildSpyAsset> findByAssetUuid(string|array<string> $asset_uuid) Return ChildSpyAsset objects filtered by the asset_uuid column
 * @method     ChildSpyAsset[]|Collection findByAssetName(string|array<string> $asset_name) Return ChildSpyAsset objects filtered by the asset_name column
 * @psalm-method Collection&\Traversable<ChildSpyAsset> findByAssetName(string|array<string> $asset_name) Return ChildSpyAsset objects filtered by the asset_name column
 * @method     ChildSpyAsset[]|Collection findByAssetContent(string|array<string> $asset_content) Return ChildSpyAsset objects filtered by the asset_content column
 * @psalm-method Collection&\Traversable<ChildSpyAsset> findByAssetContent(string|array<string> $asset_content) Return ChildSpyAsset objects filtered by the asset_content column
 * @method     ChildSpyAsset[]|Collection findByIsActive(boolean|array<boolean> $is_active) Return ChildSpyAsset objects filtered by the is_active column
 * @psalm-method Collection&\Traversable<ChildSpyAsset> findByIsActive(boolean|array<boolean> $is_active) Return ChildSpyAsset objects filtered by the is_active column
 * @method     ChildSpyAsset[]|Collection findByLastMessageTimestamp(string|array<string> $last_message_timestamp) Return ChildSpyAsset objects filtered by the last_message_timestamp column
 * @psalm-method Collection&\Traversable<ChildSpyAsset> findByLastMessageTimestamp(string|array<string> $last_message_timestamp) Return ChildSpyAsset objects filtered by the last_message_timestamp column
 *
 * @method     ChildSpyAsset[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyAsset> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyAssetQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\Asset\Persistence\Base\SpyAssetQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\Asset\\Persistence\\SpyAsset', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyAssetQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyAssetQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyAssetQuery) {
            return $criteria;
        }
        $query = new ChildSpyAssetQuery();
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
     * @return ChildSpyAsset|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyAssetTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyAsset A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id_asset`, `asset_slot`, `asset_uuid`, `asset_name`, `asset_content`, `is_active`, `last_message_timestamp` FROM `spy_asset` WHERE `id_asset` = :p0';
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
            /** @var ChildSpyAsset $obj */
            $obj = new ChildSpyAsset();
            $obj->hydrate($row);
            SpyAssetTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyAsset|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyAssetTableMap::COL_ID_ASSET, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyAssetTableMap::COL_ID_ASSET, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idAsset Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdAsset_Between(array $idAsset)
    {
        return $this->filterByIdAsset($idAsset, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idAssets Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdAsset_In(array $idAssets)
    {
        return $this->filterByIdAsset($idAssets, Criteria::IN);
    }

    /**
     * Filter the query on the id_asset column
     *
     * Example usage:
     * <code>
     * $query->filterByIdAsset(1234); // WHERE id_asset = 1234
     * $query->filterByIdAsset(array(12, 34), Criteria::IN); // WHERE id_asset IN (12, 34)
     * $query->filterByIdAsset(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_asset > 12
     * </code>
     *
     * @param     mixed $idAsset The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdAsset($idAsset = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idAsset)) {
            $useMinMax = false;
            if (isset($idAsset['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyAssetTableMap::COL_ID_ASSET, $idAsset['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idAsset['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyAssetTableMap::COL_ID_ASSET, $idAsset['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idAsset of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyAssetTableMap::COL_ID_ASSET, $idAsset, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $assetSlots Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAssetSlot_In(array $assetSlots)
    {
        return $this->filterByAssetSlot($assetSlots, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $assetSlot Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAssetSlot_Like($assetSlot)
    {
        return $this->filterByAssetSlot($assetSlot, Criteria::LIKE);
    }

    /**
     * Filter the query on the asset_slot column
     *
     * Example usage:
     * <code>
     * $query->filterByAssetSlot('fooValue');   // WHERE asset_slot = 'fooValue'
     * $query->filterByAssetSlot('%fooValue%', Criteria::LIKE); // WHERE asset_slot LIKE '%fooValue%'
     * $query->filterByAssetSlot([1, 'foo'], Criteria::IN); // WHERE asset_slot IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $assetSlot The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAssetSlot($assetSlot = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $assetSlot = str_replace('*', '%', $assetSlot);
        }

        if (is_array($assetSlot) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$assetSlot of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyAssetTableMap::COL_ASSET_SLOT, $assetSlot, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $assetUuids Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAssetUuid_In(array $assetUuids)
    {
        return $this->filterByAssetUuid($assetUuids, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $assetUuid Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAssetUuid_Like($assetUuid)
    {
        return $this->filterByAssetUuid($assetUuid, Criteria::LIKE);
    }

    /**
     * Filter the query on the asset_uuid column
     *
     * Example usage:
     * <code>
     * $query->filterByAssetUuid('fooValue');   // WHERE asset_uuid = 'fooValue'
     * $query->filterByAssetUuid('%fooValue%', Criteria::LIKE); // WHERE asset_uuid LIKE '%fooValue%'
     * $query->filterByAssetUuid([1, 'foo'], Criteria::IN); // WHERE asset_uuid IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $assetUuid The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAssetUuid($assetUuid = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $assetUuid = str_replace('*', '%', $assetUuid);
        }

        if (is_array($assetUuid) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$assetUuid of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyAssetTableMap::COL_ASSET_UUID, $assetUuid, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $assetNames Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAssetName_In(array $assetNames)
    {
        return $this->filterByAssetName($assetNames, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $assetName Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAssetName_Like($assetName)
    {
        return $this->filterByAssetName($assetName, Criteria::LIKE);
    }

    /**
     * Filter the query on the asset_name column
     *
     * Example usage:
     * <code>
     * $query->filterByAssetName('fooValue');   // WHERE asset_name = 'fooValue'
     * $query->filterByAssetName('%fooValue%', Criteria::LIKE); // WHERE asset_name LIKE '%fooValue%'
     * $query->filterByAssetName([1, 'foo'], Criteria::IN); // WHERE asset_name IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $assetName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAssetName($assetName = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $assetName = str_replace('*', '%', $assetName);
        }

        if (is_array($assetName) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$assetName of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyAssetTableMap::COL_ASSET_NAME, $assetName, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $assetContents Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAssetContent_In(array $assetContents)
    {
        return $this->filterByAssetContent($assetContents, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $assetContent Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAssetContent_Like($assetContent)
    {
        return $this->filterByAssetContent($assetContent, Criteria::LIKE);
    }

    /**
     * Filter the query on the asset_content column
     *
     * Example usage:
     * <code>
     * $query->filterByAssetContent('fooValue');   // WHERE asset_content = 'fooValue'
     * $query->filterByAssetContent('%fooValue%', Criteria::LIKE); // WHERE asset_content LIKE '%fooValue%'
     * $query->filterByAssetContent([1, 'foo'], Criteria::IN); // WHERE asset_content IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $assetContent The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAssetContent($assetContent = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $assetContent = str_replace('*', '%', $assetContent);
        }

        if (is_array($assetContent) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$assetContent of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyAssetTableMap::COL_ASSET_CONTENT, $assetContent, $comparison);

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

        $query = $this->addUsingAlias(SpyAssetTableMap::COL_IS_ACTIVE, $isActive, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $lastMessageTimestamp Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLastMessageTimestamp_Between(array $lastMessageTimestamp)
    {
        return $this->filterByLastMessageTimestamp($lastMessageTimestamp, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $lastMessageTimestamps Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLastMessageTimestamp_In(array $lastMessageTimestamps)
    {
        return $this->filterByLastMessageTimestamp($lastMessageTimestamps, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $lastMessageTimestamp Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLastMessageTimestamp_Like($lastMessageTimestamp)
    {
        return $this->filterByLastMessageTimestamp($lastMessageTimestamp, Criteria::LIKE);
    }

    /**
     * Filter the query on the last_message_timestamp column
     *
     * Example usage:
     * <code>
     * $query->filterByLastMessageTimestamp('2011-03-14'); // WHERE last_message_timestamp = '2011-03-14'
     * $query->filterByLastMessageTimestamp('now'); // WHERE last_message_timestamp = '2011-03-14'
     * $query->filterByLastMessageTimestamp(array('max' => 'yesterday'), SprykerCriteria::BETWEEN); // WHERE last_message_timestamp > '2011-03-13'
     * </code>
     *
     * @param     mixed $lastMessageTimestamp The value to use as filter.
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
    public function filterByLastMessageTimestamp($lastMessageTimestamp = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($lastMessageTimestamp)) {
            $useMinMax = false;
            if (isset($lastMessageTimestamp['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyAssetTableMap::COL_LAST_MESSAGE_TIMESTAMP, $lastMessageTimestamp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastMessageTimestamp['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyAssetTableMap::COL_LAST_MESSAGE_TIMESTAMP, $lastMessageTimestamp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$lastMessageTimestamp of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyAssetTableMap::COL_LAST_MESSAGE_TIMESTAMP, $lastMessageTimestamp, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Asset\Persistence\SpyAssetStore object
     *
     * @param \Orm\Zed\Asset\Persistence\SpyAssetStore|ObjectCollection $spyAssetStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyAssetStore($spyAssetStore, ?string $comparison = null)
    {
        if ($spyAssetStore instanceof \Orm\Zed\Asset\Persistence\SpyAssetStore) {
            $this
                ->addUsingAlias(SpyAssetTableMap::COL_ID_ASSET, $spyAssetStore->getFkAsset(), $comparison);

            return $this;
        } elseif ($spyAssetStore instanceof ObjectCollection) {
            $this
                ->useSpyAssetStoreQuery()
                ->filterByPrimaryKeys($spyAssetStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyAssetStore() only accepts arguments of type \Orm\Zed\Asset\Persistence\SpyAssetStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyAssetStore relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyAssetStore(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyAssetStore');

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
            $this->addJoinObject($join, 'SpyAssetStore');
        }

        return $this;
    }

    /**
     * Use the SpyAssetStore relation SpyAssetStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Asset\Persistence\SpyAssetStoreQuery A secondary query class using the current class as primary query
     */
    public function useSpyAssetStoreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyAssetStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyAssetStore', '\Orm\Zed\Asset\Persistence\SpyAssetStoreQuery');
    }

    /**
     * Use the SpyAssetStore relation SpyAssetStore object
     *
     * @param callable(\Orm\Zed\Asset\Persistence\SpyAssetStoreQuery):\Orm\Zed\Asset\Persistence\SpyAssetStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyAssetStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyAssetStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyAssetStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Asset\Persistence\SpyAssetStoreQuery The inner query object of the EXISTS statement
     */
    public function useSpyAssetStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Asset\Persistence\SpyAssetStoreQuery */
        $q = $this->useExistsQuery('SpyAssetStore', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyAssetStore table for a NOT EXISTS query.
     *
     * @see useSpyAssetStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Asset\Persistence\SpyAssetStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyAssetStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Asset\Persistence\SpyAssetStoreQuery */
        $q = $this->useExistsQuery('SpyAssetStore', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyAssetStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Asset\Persistence\SpyAssetStoreQuery The inner query object of the IN statement
     */
    public function useInSpyAssetStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Asset\Persistence\SpyAssetStoreQuery */
        $q = $this->useInQuery('SpyAssetStore', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyAssetStore table for a NOT IN query.
     *
     * @see useSpyAssetStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Asset\Persistence\SpyAssetStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyAssetStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Asset\Persistence\SpyAssetStoreQuery */
        $q = $this->useInQuery('SpyAssetStore', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyAsset $spyAsset Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyAsset = null)
    {
        if ($spyAsset) {
            $this->addUsingAlias(SpyAssetTableMap::COL_ID_ASSET, $spyAsset->getIdAsset(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_asset table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyAssetTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyAssetTableMap::clearInstancePool();
            SpyAssetTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyAssetTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyAssetTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyAssetTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyAssetTableMap::clearRelatedInstancePool();

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
