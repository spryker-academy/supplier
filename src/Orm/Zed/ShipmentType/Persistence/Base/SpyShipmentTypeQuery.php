<?php

namespace Orm\Zed\ShipmentType\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentType;
use Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentType;
use Orm\Zed\ShipmentTypeServicePoint\Persistence\SpyShipmentTypeServiceType;
use Orm\Zed\ShipmentType\Persistence\SpyShipmentType as ChildSpyShipmentType;
use Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeQuery as ChildSpyShipmentTypeQuery;
use Orm\Zed\ShipmentType\Persistence\Map\SpyShipmentTypeTableMap;
use Orm\Zed\Shipment\Persistence\SpyShipmentMethod;
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
 * Base class that represents a query for the `spy_shipment_type` table.
 *
 * @method     ChildSpyShipmentTypeQuery orderByIdShipmentType($order = Criteria::ASC) Order by the id_shipment_type column
 * @method     ChildSpyShipmentTypeQuery orderByIsActive($order = Criteria::ASC) Order by the is_active column
 * @method     ChildSpyShipmentTypeQuery orderByKey($order = Criteria::ASC) Order by the key column
 * @method     ChildSpyShipmentTypeQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildSpyShipmentTypeQuery orderByUuid($order = Criteria::ASC) Order by the uuid column
 *
 * @method     ChildSpyShipmentTypeQuery groupByIdShipmentType() Group by the id_shipment_type column
 * @method     ChildSpyShipmentTypeQuery groupByIsActive() Group by the is_active column
 * @method     ChildSpyShipmentTypeQuery groupByKey() Group by the key column
 * @method     ChildSpyShipmentTypeQuery groupByName() Group by the name column
 * @method     ChildSpyShipmentTypeQuery groupByUuid() Group by the uuid column
 *
 * @method     ChildSpyShipmentTypeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyShipmentTypeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyShipmentTypeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyShipmentTypeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyShipmentTypeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyShipmentTypeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyShipmentTypeQuery leftJoinProductOfferShipmentType($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductOfferShipmentType relation
 * @method     ChildSpyShipmentTypeQuery rightJoinProductOfferShipmentType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductOfferShipmentType relation
 * @method     ChildSpyShipmentTypeQuery innerJoinProductOfferShipmentType($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductOfferShipmentType relation
 *
 * @method     ChildSpyShipmentTypeQuery joinWithProductOfferShipmentType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductOfferShipmentType relation
 *
 * @method     ChildSpyShipmentTypeQuery leftJoinWithProductOfferShipmentType() Adds a LEFT JOIN clause and with to the query using the ProductOfferShipmentType relation
 * @method     ChildSpyShipmentTypeQuery rightJoinWithProductOfferShipmentType() Adds a RIGHT JOIN clause and with to the query using the ProductOfferShipmentType relation
 * @method     ChildSpyShipmentTypeQuery innerJoinWithProductOfferShipmentType() Adds a INNER JOIN clause and with to the query using the ProductOfferShipmentType relation
 *
 * @method     ChildSpyShipmentTypeQuery leftJoinSpyProductShipmentType($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductShipmentType relation
 * @method     ChildSpyShipmentTypeQuery rightJoinSpyProductShipmentType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductShipmentType relation
 * @method     ChildSpyShipmentTypeQuery innerJoinSpyProductShipmentType($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductShipmentType relation
 *
 * @method     ChildSpyShipmentTypeQuery joinWithSpyProductShipmentType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductShipmentType relation
 *
 * @method     ChildSpyShipmentTypeQuery leftJoinWithSpyProductShipmentType() Adds a LEFT JOIN clause and with to the query using the SpyProductShipmentType relation
 * @method     ChildSpyShipmentTypeQuery rightJoinWithSpyProductShipmentType() Adds a RIGHT JOIN clause and with to the query using the SpyProductShipmentType relation
 * @method     ChildSpyShipmentTypeQuery innerJoinWithSpyProductShipmentType() Adds a INNER JOIN clause and with to the query using the SpyProductShipmentType relation
 *
 * @method     ChildSpyShipmentTypeQuery leftJoinShipmentMethod($relationAlias = null) Adds a LEFT JOIN clause to the query using the ShipmentMethod relation
 * @method     ChildSpyShipmentTypeQuery rightJoinShipmentMethod($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ShipmentMethod relation
 * @method     ChildSpyShipmentTypeQuery innerJoinShipmentMethod($relationAlias = null) Adds a INNER JOIN clause to the query using the ShipmentMethod relation
 *
 * @method     ChildSpyShipmentTypeQuery joinWithShipmentMethod($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ShipmentMethod relation
 *
 * @method     ChildSpyShipmentTypeQuery leftJoinWithShipmentMethod() Adds a LEFT JOIN clause and with to the query using the ShipmentMethod relation
 * @method     ChildSpyShipmentTypeQuery rightJoinWithShipmentMethod() Adds a RIGHT JOIN clause and with to the query using the ShipmentMethod relation
 * @method     ChildSpyShipmentTypeQuery innerJoinWithShipmentMethod() Adds a INNER JOIN clause and with to the query using the ShipmentMethod relation
 *
 * @method     ChildSpyShipmentTypeQuery leftJoinShipmentTypeStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the ShipmentTypeStore relation
 * @method     ChildSpyShipmentTypeQuery rightJoinShipmentTypeStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ShipmentTypeStore relation
 * @method     ChildSpyShipmentTypeQuery innerJoinShipmentTypeStore($relationAlias = null) Adds a INNER JOIN clause to the query using the ShipmentTypeStore relation
 *
 * @method     ChildSpyShipmentTypeQuery joinWithShipmentTypeStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ShipmentTypeStore relation
 *
 * @method     ChildSpyShipmentTypeQuery leftJoinWithShipmentTypeStore() Adds a LEFT JOIN clause and with to the query using the ShipmentTypeStore relation
 * @method     ChildSpyShipmentTypeQuery rightJoinWithShipmentTypeStore() Adds a RIGHT JOIN clause and with to the query using the ShipmentTypeStore relation
 * @method     ChildSpyShipmentTypeQuery innerJoinWithShipmentTypeStore() Adds a INNER JOIN clause and with to the query using the ShipmentTypeStore relation
 *
 * @method     ChildSpyShipmentTypeQuery leftJoinSpyShipmentTypeServiceType($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyShipmentTypeServiceType relation
 * @method     ChildSpyShipmentTypeQuery rightJoinSpyShipmentTypeServiceType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyShipmentTypeServiceType relation
 * @method     ChildSpyShipmentTypeQuery innerJoinSpyShipmentTypeServiceType($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyShipmentTypeServiceType relation
 *
 * @method     ChildSpyShipmentTypeQuery joinWithSpyShipmentTypeServiceType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyShipmentTypeServiceType relation
 *
 * @method     ChildSpyShipmentTypeQuery leftJoinWithSpyShipmentTypeServiceType() Adds a LEFT JOIN clause and with to the query using the SpyShipmentTypeServiceType relation
 * @method     ChildSpyShipmentTypeQuery rightJoinWithSpyShipmentTypeServiceType() Adds a RIGHT JOIN clause and with to the query using the SpyShipmentTypeServiceType relation
 * @method     ChildSpyShipmentTypeQuery innerJoinWithSpyShipmentTypeServiceType() Adds a INNER JOIN clause and with to the query using the SpyShipmentTypeServiceType relation
 *
 * @method     \Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentTypeQuery|\Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentTypeQuery|\Orm\Zed\Shipment\Persistence\SpyShipmentMethodQuery|\Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStoreQuery|\Orm\Zed\ShipmentTypeServicePoint\Persistence\SpyShipmentTypeServiceTypeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyShipmentType|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyShipmentType matching the query
 * @method     ChildSpyShipmentType findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyShipmentType matching the query, or a new ChildSpyShipmentType object populated from the query conditions when no match is found
 *
 * @method     ChildSpyShipmentType|null findOneByIdShipmentType(int $id_shipment_type) Return the first ChildSpyShipmentType filtered by the id_shipment_type column
 * @method     ChildSpyShipmentType|null findOneByIsActive(boolean $is_active) Return the first ChildSpyShipmentType filtered by the is_active column
 * @method     ChildSpyShipmentType|null findOneByKey(string $key) Return the first ChildSpyShipmentType filtered by the key column
 * @method     ChildSpyShipmentType|null findOneByName(string $name) Return the first ChildSpyShipmentType filtered by the name column
 * @method     ChildSpyShipmentType|null findOneByUuid(string $uuid) Return the first ChildSpyShipmentType filtered by the uuid column
 *
 * @method     ChildSpyShipmentType requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyShipmentType by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyShipmentType requireOne(?ConnectionInterface $con = null) Return the first ChildSpyShipmentType matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyShipmentType requireOneByIdShipmentType(int $id_shipment_type) Return the first ChildSpyShipmentType filtered by the id_shipment_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyShipmentType requireOneByIsActive(boolean $is_active) Return the first ChildSpyShipmentType filtered by the is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyShipmentType requireOneByKey(string $key) Return the first ChildSpyShipmentType filtered by the key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyShipmentType requireOneByName(string $name) Return the first ChildSpyShipmentType filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyShipmentType requireOneByUuid(string $uuid) Return the first ChildSpyShipmentType filtered by the uuid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyShipmentType[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyShipmentType objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyShipmentType> find(?ConnectionInterface $con = null) Return ChildSpyShipmentType objects based on current ModelCriteria
 *
 * @method     ChildSpyShipmentType[]|Collection findByIdShipmentType(int|array<int> $id_shipment_type) Return ChildSpyShipmentType objects filtered by the id_shipment_type column
 * @psalm-method Collection&\Traversable<ChildSpyShipmentType> findByIdShipmentType(int|array<int> $id_shipment_type) Return ChildSpyShipmentType objects filtered by the id_shipment_type column
 * @method     ChildSpyShipmentType[]|Collection findByIsActive(boolean|array<boolean> $is_active) Return ChildSpyShipmentType objects filtered by the is_active column
 * @psalm-method Collection&\Traversable<ChildSpyShipmentType> findByIsActive(boolean|array<boolean> $is_active) Return ChildSpyShipmentType objects filtered by the is_active column
 * @method     ChildSpyShipmentType[]|Collection findByKey(string|array<string> $key) Return ChildSpyShipmentType objects filtered by the key column
 * @psalm-method Collection&\Traversable<ChildSpyShipmentType> findByKey(string|array<string> $key) Return ChildSpyShipmentType objects filtered by the key column
 * @method     ChildSpyShipmentType[]|Collection findByName(string|array<string> $name) Return ChildSpyShipmentType objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildSpyShipmentType> findByName(string|array<string> $name) Return ChildSpyShipmentType objects filtered by the name column
 * @method     ChildSpyShipmentType[]|Collection findByUuid(string|array<string> $uuid) Return ChildSpyShipmentType objects filtered by the uuid column
 * @psalm-method Collection&\Traversable<ChildSpyShipmentType> findByUuid(string|array<string> $uuid) Return ChildSpyShipmentType objects filtered by the uuid column
 *
 * @method     ChildSpyShipmentType[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyShipmentType> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyShipmentTypeQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\ShipmentType\Persistence\Base\SpyShipmentTypeQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\ShipmentType\\Persistence\\SpyShipmentType', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyShipmentTypeQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyShipmentTypeQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyShipmentTypeQuery) {
            return $criteria;
        }
        $query = new ChildSpyShipmentTypeQuery();
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
     * @return ChildSpyShipmentType|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyShipmentTypeTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyShipmentType A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id_shipment_type`, `is_active`, `key`, `name`, `uuid` FROM `spy_shipment_type` WHERE `id_shipment_type` = :p0';
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
            /** @var ChildSpyShipmentType $obj */
            $obj = new ChildSpyShipmentType();
            $obj->hydrate($row);
            SpyShipmentTypeTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyShipmentType|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyShipmentTypeTableMap::COL_ID_SHIPMENT_TYPE, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyShipmentTypeTableMap::COL_ID_SHIPMENT_TYPE, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idShipmentType Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdShipmentType_Between(array $idShipmentType)
    {
        return $this->filterByIdShipmentType($idShipmentType, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idShipmentTypes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdShipmentType_In(array $idShipmentTypes)
    {
        return $this->filterByIdShipmentType($idShipmentTypes, Criteria::IN);
    }

    /**
     * Filter the query on the id_shipment_type column
     *
     * Example usage:
     * <code>
     * $query->filterByIdShipmentType(1234); // WHERE id_shipment_type = 1234
     * $query->filterByIdShipmentType(array(12, 34), Criteria::IN); // WHERE id_shipment_type IN (12, 34)
     * $query->filterByIdShipmentType(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_shipment_type > 12
     * </code>
     *
     * @param     mixed $idShipmentType The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdShipmentType($idShipmentType = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idShipmentType)) {
            $useMinMax = false;
            if (isset($idShipmentType['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyShipmentTypeTableMap::COL_ID_SHIPMENT_TYPE, $idShipmentType['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idShipmentType['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyShipmentTypeTableMap::COL_ID_SHIPMENT_TYPE, $idShipmentType['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idShipmentType of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyShipmentTypeTableMap::COL_ID_SHIPMENT_TYPE, $idShipmentType, $comparison);

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

        $query = $this->addUsingAlias(SpyShipmentTypeTableMap::COL_IS_ACTIVE, $isActive, $comparison);

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

        $query = $this->addUsingAlias(SpyShipmentTypeTableMap::COL_KEY, $key, $comparison);

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

        $query = $this->addUsingAlias(SpyShipmentTypeTableMap::COL_NAME, $name, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $uuids Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUuid_In(array $uuids)
    {
        return $this->filterByUuid($uuids, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $uuid Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUuid_Like($uuid)
    {
        return $this->filterByUuid($uuid, Criteria::LIKE);
    }

    /**
     * Filter the query on the uuid column
     *
     * Example usage:
     * <code>
     * $query->filterByUuid('fooValue');   // WHERE uuid = 'fooValue'
     * $query->filterByUuid('%fooValue%', Criteria::LIKE); // WHERE uuid LIKE '%fooValue%'
     * $query->filterByUuid([1, 'foo'], Criteria::IN); // WHERE uuid IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $uuid The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByUuid($uuid = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $uuid = str_replace('*', '%', $uuid);
        }

        if (is_array($uuid) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$uuid of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyShipmentTypeTableMap::COL_UUID, $uuid, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentType object
     *
     * @param \Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentType|ObjectCollection $spyProductOfferShipmentType the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductOfferShipmentType($spyProductOfferShipmentType, ?string $comparison = null)
    {
        if ($spyProductOfferShipmentType instanceof \Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentType) {
            $this
                ->addUsingAlias(SpyShipmentTypeTableMap::COL_ID_SHIPMENT_TYPE, $spyProductOfferShipmentType->getFkShipmentType(), $comparison);

            return $this;
        } elseif ($spyProductOfferShipmentType instanceof ObjectCollection) {
            $this
                ->useProductOfferShipmentTypeQuery()
                ->filterByPrimaryKeys($spyProductOfferShipmentType->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByProductOfferShipmentType() only accepts arguments of type \Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentType or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductOfferShipmentType relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProductOfferShipmentType(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductOfferShipmentType');

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
            $this->addJoinObject($join, 'ProductOfferShipmentType');
        }

        return $this;
    }

    /**
     * Use the ProductOfferShipmentType relation SpyProductOfferShipmentType object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentTypeQuery A secondary query class using the current class as primary query
     */
    public function useProductOfferShipmentTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductOfferShipmentType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductOfferShipmentType', '\Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentTypeQuery');
    }

    /**
     * Use the ProductOfferShipmentType relation SpyProductOfferShipmentType object
     *
     * @param callable(\Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentTypeQuery):\Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentTypeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProductOfferShipmentTypeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProductOfferShipmentTypeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ProductOfferShipmentType relation to the SpyProductOfferShipmentType table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentTypeQuery The inner query object of the EXISTS statement
     */
    public function useProductOfferShipmentTypeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentTypeQuery */
        $q = $this->useExistsQuery('ProductOfferShipmentType', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ProductOfferShipmentType relation to the SpyProductOfferShipmentType table for a NOT EXISTS query.
     *
     * @see useProductOfferShipmentTypeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentTypeQuery The inner query object of the NOT EXISTS statement
     */
    public function useProductOfferShipmentTypeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentTypeQuery */
        $q = $this->useExistsQuery('ProductOfferShipmentType', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ProductOfferShipmentType relation to the SpyProductOfferShipmentType table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentTypeQuery The inner query object of the IN statement
     */
    public function useInProductOfferShipmentTypeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentTypeQuery */
        $q = $this->useInQuery('ProductOfferShipmentType', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ProductOfferShipmentType relation to the SpyProductOfferShipmentType table for a NOT IN query.
     *
     * @see useProductOfferShipmentTypeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentTypeQuery The inner query object of the NOT IN statement
     */
    public function useNotInProductOfferShipmentTypeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentTypeQuery */
        $q = $this->useInQuery('ProductOfferShipmentType', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentType object
     *
     * @param \Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentType|ObjectCollection $spyProductShipmentType the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductShipmentType($spyProductShipmentType, ?string $comparison = null)
    {
        if ($spyProductShipmentType instanceof \Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentType) {
            $this
                ->addUsingAlias(SpyShipmentTypeTableMap::COL_ID_SHIPMENT_TYPE, $spyProductShipmentType->getFkShipmentType(), $comparison);

            return $this;
        } elseif ($spyProductShipmentType instanceof ObjectCollection) {
            $this
                ->useSpyProductShipmentTypeQuery()
                ->filterByPrimaryKeys($spyProductShipmentType->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductShipmentType() only accepts arguments of type \Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentType or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductShipmentType relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductShipmentType(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductShipmentType');

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
            $this->addJoinObject($join, 'SpyProductShipmentType');
        }

        return $this;
    }

    /**
     * Use the SpyProductShipmentType relation SpyProductShipmentType object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentTypeQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductShipmentTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductShipmentType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductShipmentType', '\Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentTypeQuery');
    }

    /**
     * Use the SpyProductShipmentType relation SpyProductShipmentType object
     *
     * @param callable(\Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentTypeQuery):\Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentTypeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductShipmentTypeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductShipmentTypeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductShipmentType table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentTypeQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductShipmentTypeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentTypeQuery */
        $q = $this->useExistsQuery('SpyProductShipmentType', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductShipmentType table for a NOT EXISTS query.
     *
     * @see useSpyProductShipmentTypeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentTypeQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductShipmentTypeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentTypeQuery */
        $q = $this->useExistsQuery('SpyProductShipmentType', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductShipmentType table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentTypeQuery The inner query object of the IN statement
     */
    public function useInSpyProductShipmentTypeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentTypeQuery */
        $q = $this->useInQuery('SpyProductShipmentType', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductShipmentType table for a NOT IN query.
     *
     * @see useSpyProductShipmentTypeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentTypeQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductShipmentTypeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentTypeQuery */
        $q = $this->useInQuery('SpyProductShipmentType', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Shipment\Persistence\SpyShipmentMethod object
     *
     * @param \Orm\Zed\Shipment\Persistence\SpyShipmentMethod|ObjectCollection $spyShipmentMethod the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByShipmentMethod($spyShipmentMethod, ?string $comparison = null)
    {
        if ($spyShipmentMethod instanceof \Orm\Zed\Shipment\Persistence\SpyShipmentMethod) {
            $this
                ->addUsingAlias(SpyShipmentTypeTableMap::COL_ID_SHIPMENT_TYPE, $spyShipmentMethod->getFkShipmentType(), $comparison);

            return $this;
        } elseif ($spyShipmentMethod instanceof ObjectCollection) {
            $this
                ->useShipmentMethodQuery()
                ->filterByPrimaryKeys($spyShipmentMethod->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByShipmentMethod() only accepts arguments of type \Orm\Zed\Shipment\Persistence\SpyShipmentMethod or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ShipmentMethod relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinShipmentMethod(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ShipmentMethod');

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
            $this->addJoinObject($join, 'ShipmentMethod');
        }

        return $this;
    }

    /**
     * Use the ShipmentMethod relation SpyShipmentMethod object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Shipment\Persistence\SpyShipmentMethodQuery A secondary query class using the current class as primary query
     */
    public function useShipmentMethodQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinShipmentMethod($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ShipmentMethod', '\Orm\Zed\Shipment\Persistence\SpyShipmentMethodQuery');
    }

    /**
     * Use the ShipmentMethod relation SpyShipmentMethod object
     *
     * @param callable(\Orm\Zed\Shipment\Persistence\SpyShipmentMethodQuery):\Orm\Zed\Shipment\Persistence\SpyShipmentMethodQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withShipmentMethodQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useShipmentMethodQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ShipmentMethod relation to the SpyShipmentMethod table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Shipment\Persistence\SpyShipmentMethodQuery The inner query object of the EXISTS statement
     */
    public function useShipmentMethodExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Shipment\Persistence\SpyShipmentMethodQuery */
        $q = $this->useExistsQuery('ShipmentMethod', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ShipmentMethod relation to the SpyShipmentMethod table for a NOT EXISTS query.
     *
     * @see useShipmentMethodExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Shipment\Persistence\SpyShipmentMethodQuery The inner query object of the NOT EXISTS statement
     */
    public function useShipmentMethodNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Shipment\Persistence\SpyShipmentMethodQuery */
        $q = $this->useExistsQuery('ShipmentMethod', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ShipmentMethod relation to the SpyShipmentMethod table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Shipment\Persistence\SpyShipmentMethodQuery The inner query object of the IN statement
     */
    public function useInShipmentMethodQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Shipment\Persistence\SpyShipmentMethodQuery */
        $q = $this->useInQuery('ShipmentMethod', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ShipmentMethod relation to the SpyShipmentMethod table for a NOT IN query.
     *
     * @see useShipmentMethodInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Shipment\Persistence\SpyShipmentMethodQuery The inner query object of the NOT IN statement
     */
    public function useNotInShipmentMethodQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Shipment\Persistence\SpyShipmentMethodQuery */
        $q = $this->useInQuery('ShipmentMethod', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStore object
     *
     * @param \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStore|ObjectCollection $spyShipmentTypeStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByShipmentTypeStore($spyShipmentTypeStore, ?string $comparison = null)
    {
        if ($spyShipmentTypeStore instanceof \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStore) {
            $this
                ->addUsingAlias(SpyShipmentTypeTableMap::COL_ID_SHIPMENT_TYPE, $spyShipmentTypeStore->getFkShipmentType(), $comparison);

            return $this;
        } elseif ($spyShipmentTypeStore instanceof ObjectCollection) {
            $this
                ->useShipmentTypeStoreQuery()
                ->filterByPrimaryKeys($spyShipmentTypeStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByShipmentTypeStore() only accepts arguments of type \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ShipmentTypeStore relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinShipmentTypeStore(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ShipmentTypeStore');

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
            $this->addJoinObject($join, 'ShipmentTypeStore');
        }

        return $this;
    }

    /**
     * Use the ShipmentTypeStore relation SpyShipmentTypeStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStoreQuery A secondary query class using the current class as primary query
     */
    public function useShipmentTypeStoreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinShipmentTypeStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ShipmentTypeStore', '\Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStoreQuery');
    }

    /**
     * Use the ShipmentTypeStore relation SpyShipmentTypeStore object
     *
     * @param callable(\Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStoreQuery):\Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withShipmentTypeStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useShipmentTypeStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ShipmentTypeStore relation to the SpyShipmentTypeStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStoreQuery The inner query object of the EXISTS statement
     */
    public function useShipmentTypeStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStoreQuery */
        $q = $this->useExistsQuery('ShipmentTypeStore', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ShipmentTypeStore relation to the SpyShipmentTypeStore table for a NOT EXISTS query.
     *
     * @see useShipmentTypeStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useShipmentTypeStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStoreQuery */
        $q = $this->useExistsQuery('ShipmentTypeStore', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ShipmentTypeStore relation to the SpyShipmentTypeStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStoreQuery The inner query object of the IN statement
     */
    public function useInShipmentTypeStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStoreQuery */
        $q = $this->useInQuery('ShipmentTypeStore', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ShipmentTypeStore relation to the SpyShipmentTypeStore table for a NOT IN query.
     *
     * @see useShipmentTypeStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInShipmentTypeStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStoreQuery */
        $q = $this->useInQuery('ShipmentTypeStore', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ShipmentTypeServicePoint\Persistence\SpyShipmentTypeServiceType object
     *
     * @param \Orm\Zed\ShipmentTypeServicePoint\Persistence\SpyShipmentTypeServiceType|ObjectCollection $spyShipmentTypeServiceType the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyShipmentTypeServiceType($spyShipmentTypeServiceType, ?string $comparison = null)
    {
        if ($spyShipmentTypeServiceType instanceof \Orm\Zed\ShipmentTypeServicePoint\Persistence\SpyShipmentTypeServiceType) {
            $this
                ->addUsingAlias(SpyShipmentTypeTableMap::COL_ID_SHIPMENT_TYPE, $spyShipmentTypeServiceType->getFkShipmentType(), $comparison);

            return $this;
        } elseif ($spyShipmentTypeServiceType instanceof ObjectCollection) {
            $this
                ->useSpyShipmentTypeServiceTypeQuery()
                ->filterByPrimaryKeys($spyShipmentTypeServiceType->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyShipmentTypeServiceType() only accepts arguments of type \Orm\Zed\ShipmentTypeServicePoint\Persistence\SpyShipmentTypeServiceType or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyShipmentTypeServiceType relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyShipmentTypeServiceType(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyShipmentTypeServiceType');

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
            $this->addJoinObject($join, 'SpyShipmentTypeServiceType');
        }

        return $this;
    }

    /**
     * Use the SpyShipmentTypeServiceType relation SpyShipmentTypeServiceType object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ShipmentTypeServicePoint\Persistence\SpyShipmentTypeServiceTypeQuery A secondary query class using the current class as primary query
     */
    public function useSpyShipmentTypeServiceTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyShipmentTypeServiceType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyShipmentTypeServiceType', '\Orm\Zed\ShipmentTypeServicePoint\Persistence\SpyShipmentTypeServiceTypeQuery');
    }

    /**
     * Use the SpyShipmentTypeServiceType relation SpyShipmentTypeServiceType object
     *
     * @param callable(\Orm\Zed\ShipmentTypeServicePoint\Persistence\SpyShipmentTypeServiceTypeQuery):\Orm\Zed\ShipmentTypeServicePoint\Persistence\SpyShipmentTypeServiceTypeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyShipmentTypeServiceTypeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyShipmentTypeServiceTypeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyShipmentTypeServiceType table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ShipmentTypeServicePoint\Persistence\SpyShipmentTypeServiceTypeQuery The inner query object of the EXISTS statement
     */
    public function useSpyShipmentTypeServiceTypeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ShipmentTypeServicePoint\Persistence\SpyShipmentTypeServiceTypeQuery */
        $q = $this->useExistsQuery('SpyShipmentTypeServiceType', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyShipmentTypeServiceType table for a NOT EXISTS query.
     *
     * @see useSpyShipmentTypeServiceTypeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ShipmentTypeServicePoint\Persistence\SpyShipmentTypeServiceTypeQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyShipmentTypeServiceTypeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ShipmentTypeServicePoint\Persistence\SpyShipmentTypeServiceTypeQuery */
        $q = $this->useExistsQuery('SpyShipmentTypeServiceType', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyShipmentTypeServiceType table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ShipmentTypeServicePoint\Persistence\SpyShipmentTypeServiceTypeQuery The inner query object of the IN statement
     */
    public function useInSpyShipmentTypeServiceTypeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ShipmentTypeServicePoint\Persistence\SpyShipmentTypeServiceTypeQuery */
        $q = $this->useInQuery('SpyShipmentTypeServiceType', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyShipmentTypeServiceType table for a NOT IN query.
     *
     * @see useSpyShipmentTypeServiceTypeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ShipmentTypeServicePoint\Persistence\SpyShipmentTypeServiceTypeQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyShipmentTypeServiceTypeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ShipmentTypeServicePoint\Persistence\SpyShipmentTypeServiceTypeQuery */
        $q = $this->useInQuery('SpyShipmentTypeServiceType', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related SpyProduct object
     * using the spy_product_shipment_type table as cross reference
     *
     * @param SpyProduct $spyProduct the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL and Criteria::IN for queries
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProduct($spyProduct, string $comparison = null)
    {
        $this
            ->useSpyProductShipmentTypeQuery()
            ->filterBySpyProduct($spyProduct, $comparison)
            ->endUse();

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyShipmentType $spyShipmentType Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyShipmentType = null)
    {
        if ($spyShipmentType) {
            $this->addUsingAlias(SpyShipmentTypeTableMap::COL_ID_SHIPMENT_TYPE, $spyShipmentType->getIdShipmentType(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_shipment_type table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyShipmentTypeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyShipmentTypeTableMap::clearInstancePool();
            SpyShipmentTypeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyShipmentTypeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyShipmentTypeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyShipmentTypeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyShipmentTypeTableMap::clearRelatedInstancePool();

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
