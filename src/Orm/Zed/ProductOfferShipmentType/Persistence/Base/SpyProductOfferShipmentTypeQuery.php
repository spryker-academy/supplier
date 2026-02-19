<?php

namespace Orm\Zed\ProductOfferShipmentType\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentType as ChildSpyProductOfferShipmentType;
use Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentTypeQuery as ChildSpyProductOfferShipmentTypeQuery;
use Orm\Zed\ProductOfferShipmentType\Persistence\Map\SpyProductOfferShipmentTypeTableMap;
use Orm\Zed\ProductOffer\Persistence\SpyProductOffer;
use Orm\Zed\ShipmentType\Persistence\SpyShipmentType;
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
 * Base class that represents a query for the `spy_product_offer_shipment_type` table.
 *
 * @method     ChildSpyProductOfferShipmentTypeQuery orderByIdProductOfferShipmentType($order = Criteria::ASC) Order by the id_product_offer_shipment_type column
 * @method     ChildSpyProductOfferShipmentTypeQuery orderByFkProductOffer($order = Criteria::ASC) Order by the fk_product_offer column
 * @method     ChildSpyProductOfferShipmentTypeQuery orderByFkShipmentType($order = Criteria::ASC) Order by the fk_shipment_type column
 *
 * @method     ChildSpyProductOfferShipmentTypeQuery groupByIdProductOfferShipmentType() Group by the id_product_offer_shipment_type column
 * @method     ChildSpyProductOfferShipmentTypeQuery groupByFkProductOffer() Group by the fk_product_offer column
 * @method     ChildSpyProductOfferShipmentTypeQuery groupByFkShipmentType() Group by the fk_shipment_type column
 *
 * @method     ChildSpyProductOfferShipmentTypeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyProductOfferShipmentTypeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyProductOfferShipmentTypeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyProductOfferShipmentTypeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyProductOfferShipmentTypeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyProductOfferShipmentTypeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyProductOfferShipmentTypeQuery leftJoinProductOffer($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductOffer relation
 * @method     ChildSpyProductOfferShipmentTypeQuery rightJoinProductOffer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductOffer relation
 * @method     ChildSpyProductOfferShipmentTypeQuery innerJoinProductOffer($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductOffer relation
 *
 * @method     ChildSpyProductOfferShipmentTypeQuery joinWithProductOffer($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductOffer relation
 *
 * @method     ChildSpyProductOfferShipmentTypeQuery leftJoinWithProductOffer() Adds a LEFT JOIN clause and with to the query using the ProductOffer relation
 * @method     ChildSpyProductOfferShipmentTypeQuery rightJoinWithProductOffer() Adds a RIGHT JOIN clause and with to the query using the ProductOffer relation
 * @method     ChildSpyProductOfferShipmentTypeQuery innerJoinWithProductOffer() Adds a INNER JOIN clause and with to the query using the ProductOffer relation
 *
 * @method     ChildSpyProductOfferShipmentTypeQuery leftJoinShipmentType($relationAlias = null) Adds a LEFT JOIN clause to the query using the ShipmentType relation
 * @method     ChildSpyProductOfferShipmentTypeQuery rightJoinShipmentType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ShipmentType relation
 * @method     ChildSpyProductOfferShipmentTypeQuery innerJoinShipmentType($relationAlias = null) Adds a INNER JOIN clause to the query using the ShipmentType relation
 *
 * @method     ChildSpyProductOfferShipmentTypeQuery joinWithShipmentType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ShipmentType relation
 *
 * @method     ChildSpyProductOfferShipmentTypeQuery leftJoinWithShipmentType() Adds a LEFT JOIN clause and with to the query using the ShipmentType relation
 * @method     ChildSpyProductOfferShipmentTypeQuery rightJoinWithShipmentType() Adds a RIGHT JOIN clause and with to the query using the ShipmentType relation
 * @method     ChildSpyProductOfferShipmentTypeQuery innerJoinWithShipmentType() Adds a INNER JOIN clause and with to the query using the ShipmentType relation
 *
 * @method     \Orm\Zed\ProductOffer\Persistence\SpyProductOfferQuery|\Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyProductOfferShipmentType|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyProductOfferShipmentType matching the query
 * @method     ChildSpyProductOfferShipmentType findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyProductOfferShipmentType matching the query, or a new ChildSpyProductOfferShipmentType object populated from the query conditions when no match is found
 *
 * @method     ChildSpyProductOfferShipmentType|null findOneByIdProductOfferShipmentType(int $id_product_offer_shipment_type) Return the first ChildSpyProductOfferShipmentType filtered by the id_product_offer_shipment_type column
 * @method     ChildSpyProductOfferShipmentType|null findOneByFkProductOffer(int $fk_product_offer) Return the first ChildSpyProductOfferShipmentType filtered by the fk_product_offer column
 * @method     ChildSpyProductOfferShipmentType|null findOneByFkShipmentType(int $fk_shipment_type) Return the first ChildSpyProductOfferShipmentType filtered by the fk_shipment_type column
 *
 * @method     ChildSpyProductOfferShipmentType requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyProductOfferShipmentType by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductOfferShipmentType requireOne(?ConnectionInterface $con = null) Return the first ChildSpyProductOfferShipmentType matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyProductOfferShipmentType requireOneByIdProductOfferShipmentType(int $id_product_offer_shipment_type) Return the first ChildSpyProductOfferShipmentType filtered by the id_product_offer_shipment_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductOfferShipmentType requireOneByFkProductOffer(int $fk_product_offer) Return the first ChildSpyProductOfferShipmentType filtered by the fk_product_offer column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductOfferShipmentType requireOneByFkShipmentType(int $fk_shipment_type) Return the first ChildSpyProductOfferShipmentType filtered by the fk_shipment_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyProductOfferShipmentType[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyProductOfferShipmentType objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyProductOfferShipmentType> find(?ConnectionInterface $con = null) Return ChildSpyProductOfferShipmentType objects based on current ModelCriteria
 *
 * @method     ChildSpyProductOfferShipmentType[]|Collection findByIdProductOfferShipmentType(int|array<int> $id_product_offer_shipment_type) Return ChildSpyProductOfferShipmentType objects filtered by the id_product_offer_shipment_type column
 * @psalm-method Collection&\Traversable<ChildSpyProductOfferShipmentType> findByIdProductOfferShipmentType(int|array<int> $id_product_offer_shipment_type) Return ChildSpyProductOfferShipmentType objects filtered by the id_product_offer_shipment_type column
 * @method     ChildSpyProductOfferShipmentType[]|Collection findByFkProductOffer(int|array<int> $fk_product_offer) Return ChildSpyProductOfferShipmentType objects filtered by the fk_product_offer column
 * @psalm-method Collection&\Traversable<ChildSpyProductOfferShipmentType> findByFkProductOffer(int|array<int> $fk_product_offer) Return ChildSpyProductOfferShipmentType objects filtered by the fk_product_offer column
 * @method     ChildSpyProductOfferShipmentType[]|Collection findByFkShipmentType(int|array<int> $fk_shipment_type) Return ChildSpyProductOfferShipmentType objects filtered by the fk_shipment_type column
 * @psalm-method Collection&\Traversable<ChildSpyProductOfferShipmentType> findByFkShipmentType(int|array<int> $fk_shipment_type) Return ChildSpyProductOfferShipmentType objects filtered by the fk_shipment_type column
 *
 * @method     ChildSpyProductOfferShipmentType[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyProductOfferShipmentType> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyProductOfferShipmentTypeQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\ProductOfferShipmentType\Persistence\Base\SpyProductOfferShipmentTypeQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\ProductOfferShipmentType\\Persistence\\SpyProductOfferShipmentType', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyProductOfferShipmentTypeQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyProductOfferShipmentTypeQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyProductOfferShipmentTypeQuery) {
            return $criteria;
        }
        $query = new ChildSpyProductOfferShipmentTypeQuery();
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
     * @return ChildSpyProductOfferShipmentType|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyProductOfferShipmentTypeTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyProductOfferShipmentType A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_product_offer_shipment_type, fk_product_offer, fk_shipment_type FROM spy_product_offer_shipment_type WHERE id_product_offer_shipment_type = :p0';
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
            /** @var ChildSpyProductOfferShipmentType $obj */
            $obj = new ChildSpyProductOfferShipmentType();
            $obj->hydrate($row);
            SpyProductOfferShipmentTypeTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyProductOfferShipmentType|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyProductOfferShipmentTypeTableMap::COL_ID_PRODUCT_OFFER_SHIPMENT_TYPE, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyProductOfferShipmentTypeTableMap::COL_ID_PRODUCT_OFFER_SHIPMENT_TYPE, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idProductOfferShipmentType Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdProductOfferShipmentType_Between(array $idProductOfferShipmentType)
    {
        return $this->filterByIdProductOfferShipmentType($idProductOfferShipmentType, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idProductOfferShipmentTypes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdProductOfferShipmentType_In(array $idProductOfferShipmentTypes)
    {
        return $this->filterByIdProductOfferShipmentType($idProductOfferShipmentTypes, Criteria::IN);
    }

    /**
     * Filter the query on the id_product_offer_shipment_type column
     *
     * Example usage:
     * <code>
     * $query->filterByIdProductOfferShipmentType(1234); // WHERE id_product_offer_shipment_type = 1234
     * $query->filterByIdProductOfferShipmentType(array(12, 34), Criteria::IN); // WHERE id_product_offer_shipment_type IN (12, 34)
     * $query->filterByIdProductOfferShipmentType(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_product_offer_shipment_type > 12
     * </code>
     *
     * @param     mixed $idProductOfferShipmentType The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdProductOfferShipmentType($idProductOfferShipmentType = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idProductOfferShipmentType)) {
            $useMinMax = false;
            if (isset($idProductOfferShipmentType['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductOfferShipmentTypeTableMap::COL_ID_PRODUCT_OFFER_SHIPMENT_TYPE, $idProductOfferShipmentType['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idProductOfferShipmentType['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductOfferShipmentTypeTableMap::COL_ID_PRODUCT_OFFER_SHIPMENT_TYPE, $idProductOfferShipmentType['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idProductOfferShipmentType of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductOfferShipmentTypeTableMap::COL_ID_PRODUCT_OFFER_SHIPMENT_TYPE, $idProductOfferShipmentType, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkProductOffer Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkProductOffer_Between(array $fkProductOffer)
    {
        return $this->filterByFkProductOffer($fkProductOffer, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkProductOffers Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkProductOffer_In(array $fkProductOffers)
    {
        return $this->filterByFkProductOffer($fkProductOffers, Criteria::IN);
    }

    /**
     * Filter the query on the fk_product_offer column
     *
     * Example usage:
     * <code>
     * $query->filterByFkProductOffer(1234); // WHERE fk_product_offer = 1234
     * $query->filterByFkProductOffer(array(12, 34), Criteria::IN); // WHERE fk_product_offer IN (12, 34)
     * $query->filterByFkProductOffer(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_product_offer > 12
     * </code>
     *
     * @see       filterByProductOffer()
     *
     * @param     mixed $fkProductOffer The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkProductOffer($fkProductOffer = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkProductOffer)) {
            $useMinMax = false;
            if (isset($fkProductOffer['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductOfferShipmentTypeTableMap::COL_FK_PRODUCT_OFFER, $fkProductOffer['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkProductOffer['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductOfferShipmentTypeTableMap::COL_FK_PRODUCT_OFFER, $fkProductOffer['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkProductOffer of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductOfferShipmentTypeTableMap::COL_FK_PRODUCT_OFFER, $fkProductOffer, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkShipmentType Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkShipmentType_Between(array $fkShipmentType)
    {
        return $this->filterByFkShipmentType($fkShipmentType, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkShipmentTypes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkShipmentType_In(array $fkShipmentTypes)
    {
        return $this->filterByFkShipmentType($fkShipmentTypes, Criteria::IN);
    }

    /**
     * Filter the query on the fk_shipment_type column
     *
     * Example usage:
     * <code>
     * $query->filterByFkShipmentType(1234); // WHERE fk_shipment_type = 1234
     * $query->filterByFkShipmentType(array(12, 34), Criteria::IN); // WHERE fk_shipment_type IN (12, 34)
     * $query->filterByFkShipmentType(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_shipment_type > 12
     * </code>
     *
     * @see       filterByShipmentType()
     *
     * @param     mixed $fkShipmentType The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkShipmentType($fkShipmentType = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkShipmentType)) {
            $useMinMax = false;
            if (isset($fkShipmentType['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductOfferShipmentTypeTableMap::COL_FK_SHIPMENT_TYPE, $fkShipmentType['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkShipmentType['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductOfferShipmentTypeTableMap::COL_FK_SHIPMENT_TYPE, $fkShipmentType['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkShipmentType of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductOfferShipmentTypeTableMap::COL_FK_SHIPMENT_TYPE, $fkShipmentType, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductOffer\Persistence\SpyProductOffer object
     *
     * @param \Orm\Zed\ProductOffer\Persistence\SpyProductOffer|ObjectCollection $spyProductOffer The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductOffer($spyProductOffer, ?string $comparison = null)
    {
        if ($spyProductOffer instanceof \Orm\Zed\ProductOffer\Persistence\SpyProductOffer) {
            return $this
                ->addUsingAlias(SpyProductOfferShipmentTypeTableMap::COL_FK_PRODUCT_OFFER, $spyProductOffer->getIdProductOffer(), $comparison);
        } elseif ($spyProductOffer instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyProductOfferShipmentTypeTableMap::COL_FK_PRODUCT_OFFER, $spyProductOffer->toKeyValue('PrimaryKey', 'IdProductOffer'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByProductOffer() only accepts arguments of type \Orm\Zed\ProductOffer\Persistence\SpyProductOffer or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductOffer relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProductOffer(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductOffer');

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
            $this->addJoinObject($join, 'ProductOffer');
        }

        return $this;
    }

    /**
     * Use the ProductOffer relation SpyProductOffer object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductOffer\Persistence\SpyProductOfferQuery A secondary query class using the current class as primary query
     */
    public function useProductOfferQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductOffer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductOffer', '\Orm\Zed\ProductOffer\Persistence\SpyProductOfferQuery');
    }

    /**
     * Use the ProductOffer relation SpyProductOffer object
     *
     * @param callable(\Orm\Zed\ProductOffer\Persistence\SpyProductOfferQuery):\Orm\Zed\ProductOffer\Persistence\SpyProductOfferQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProductOfferQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProductOfferQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ProductOffer relation to the SpyProductOffer table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductOffer\Persistence\SpyProductOfferQuery The inner query object of the EXISTS statement
     */
    public function useProductOfferExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductOffer\Persistence\SpyProductOfferQuery */
        $q = $this->useExistsQuery('ProductOffer', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ProductOffer relation to the SpyProductOffer table for a NOT EXISTS query.
     *
     * @see useProductOfferExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductOffer\Persistence\SpyProductOfferQuery The inner query object of the NOT EXISTS statement
     */
    public function useProductOfferNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductOffer\Persistence\SpyProductOfferQuery */
        $q = $this->useExistsQuery('ProductOffer', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ProductOffer relation to the SpyProductOffer table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductOffer\Persistence\SpyProductOfferQuery The inner query object of the IN statement
     */
    public function useInProductOfferQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductOffer\Persistence\SpyProductOfferQuery */
        $q = $this->useInQuery('ProductOffer', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ProductOffer relation to the SpyProductOffer table for a NOT IN query.
     *
     * @see useProductOfferInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductOffer\Persistence\SpyProductOfferQuery The inner query object of the NOT IN statement
     */
    public function useNotInProductOfferQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductOffer\Persistence\SpyProductOfferQuery */
        $q = $this->useInQuery('ProductOffer', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ShipmentType\Persistence\SpyShipmentType object
     *
     * @param \Orm\Zed\ShipmentType\Persistence\SpyShipmentType|ObjectCollection $spyShipmentType The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByShipmentType($spyShipmentType, ?string $comparison = null)
    {
        if ($spyShipmentType instanceof \Orm\Zed\ShipmentType\Persistence\SpyShipmentType) {
            return $this
                ->addUsingAlias(SpyProductOfferShipmentTypeTableMap::COL_FK_SHIPMENT_TYPE, $spyShipmentType->getIdShipmentType(), $comparison);
        } elseif ($spyShipmentType instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyProductOfferShipmentTypeTableMap::COL_FK_SHIPMENT_TYPE, $spyShipmentType->toKeyValue('PrimaryKey', 'IdShipmentType'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByShipmentType() only accepts arguments of type \Orm\Zed\ShipmentType\Persistence\SpyShipmentType or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ShipmentType relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinShipmentType(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ShipmentType');

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
            $this->addJoinObject($join, 'ShipmentType');
        }

        return $this;
    }

    /**
     * Use the ShipmentType relation SpyShipmentType object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeQuery A secondary query class using the current class as primary query
     */
    public function useShipmentTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinShipmentType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ShipmentType', '\Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeQuery');
    }

    /**
     * Use the ShipmentType relation SpyShipmentType object
     *
     * @param callable(\Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeQuery):\Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withShipmentTypeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useShipmentTypeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ShipmentType relation to the SpyShipmentType table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeQuery The inner query object of the EXISTS statement
     */
    public function useShipmentTypeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeQuery */
        $q = $this->useExistsQuery('ShipmentType', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ShipmentType relation to the SpyShipmentType table for a NOT EXISTS query.
     *
     * @see useShipmentTypeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeQuery The inner query object of the NOT EXISTS statement
     */
    public function useShipmentTypeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeQuery */
        $q = $this->useExistsQuery('ShipmentType', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ShipmentType relation to the SpyShipmentType table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeQuery The inner query object of the IN statement
     */
    public function useInShipmentTypeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeQuery */
        $q = $this->useInQuery('ShipmentType', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ShipmentType relation to the SpyShipmentType table for a NOT IN query.
     *
     * @see useShipmentTypeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeQuery The inner query object of the NOT IN statement
     */
    public function useNotInShipmentTypeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeQuery */
        $q = $this->useInQuery('ShipmentType', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyProductOfferShipmentType $spyProductOfferShipmentType Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyProductOfferShipmentType = null)
    {
        if ($spyProductOfferShipmentType) {
            $this->addUsingAlias(SpyProductOfferShipmentTypeTableMap::COL_ID_PRODUCT_OFFER_SHIPMENT_TYPE, $spyProductOfferShipmentType->getIdProductOfferShipmentType(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_product_offer_shipment_type table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductOfferShipmentTypeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyProductOfferShipmentTypeTableMap::clearInstancePool();
            SpyProductOfferShipmentTypeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductOfferShipmentTypeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyProductOfferShipmentTypeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyProductOfferShipmentTypeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyProductOfferShipmentTypeTableMap::clearRelatedInstancePool();

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
