<?php

namespace Orm\Zed\Shipment\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\ShipmentType\Persistence\SpyShipmentType;
use Orm\Zed\Shipment\Persistence\SpyShipmentMethod as ChildSpyShipmentMethod;
use Orm\Zed\Shipment\Persistence\SpyShipmentMethodQuery as ChildSpyShipmentMethodQuery;
use Orm\Zed\Shipment\Persistence\Map\SpyShipmentMethodTableMap;
use Orm\Zed\Tax\Persistence\SpyTaxSet;
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
 * Base class that represents a query for the `spy_shipment_method` table.
 *
 * @method     ChildSpyShipmentMethodQuery orderByIdShipmentMethod($order = Criteria::ASC) Order by the id_shipment_method column
 * @method     ChildSpyShipmentMethodQuery orderByFkShipmentCarrier($order = Criteria::ASC) Order by the fk_shipment_carrier column
 * @method     ChildSpyShipmentMethodQuery orderByFkShipmentType($order = Criteria::ASC) Order by the fk_shipment_type column
 * @method     ChildSpyShipmentMethodQuery orderByFkTaxSet($order = Criteria::ASC) Order by the fk_tax_set column
 * @method     ChildSpyShipmentMethodQuery orderByAvailabilityPlugin($order = Criteria::ASC) Order by the availability_plugin column
 * @method     ChildSpyShipmentMethodQuery orderByDefaultPrice($order = Criteria::ASC) Order by the default_price column
 * @method     ChildSpyShipmentMethodQuery orderByDeliveryTimePlugin($order = Criteria::ASC) Order by the delivery_time_plugin column
 * @method     ChildSpyShipmentMethodQuery orderByIsActive($order = Criteria::ASC) Order by the is_active column
 * @method     ChildSpyShipmentMethodQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildSpyShipmentMethodQuery orderByPricePlugin($order = Criteria::ASC) Order by the price_plugin column
 * @method     ChildSpyShipmentMethodQuery orderByShipmentMethodKey($order = Criteria::ASC) Order by the shipment_method_key column
 *
 * @method     ChildSpyShipmentMethodQuery groupByIdShipmentMethod() Group by the id_shipment_method column
 * @method     ChildSpyShipmentMethodQuery groupByFkShipmentCarrier() Group by the fk_shipment_carrier column
 * @method     ChildSpyShipmentMethodQuery groupByFkShipmentType() Group by the fk_shipment_type column
 * @method     ChildSpyShipmentMethodQuery groupByFkTaxSet() Group by the fk_tax_set column
 * @method     ChildSpyShipmentMethodQuery groupByAvailabilityPlugin() Group by the availability_plugin column
 * @method     ChildSpyShipmentMethodQuery groupByDefaultPrice() Group by the default_price column
 * @method     ChildSpyShipmentMethodQuery groupByDeliveryTimePlugin() Group by the delivery_time_plugin column
 * @method     ChildSpyShipmentMethodQuery groupByIsActive() Group by the is_active column
 * @method     ChildSpyShipmentMethodQuery groupByName() Group by the name column
 * @method     ChildSpyShipmentMethodQuery groupByPricePlugin() Group by the price_plugin column
 * @method     ChildSpyShipmentMethodQuery groupByShipmentMethodKey() Group by the shipment_method_key column
 *
 * @method     ChildSpyShipmentMethodQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyShipmentMethodQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyShipmentMethodQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyShipmentMethodQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyShipmentMethodQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyShipmentMethodQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyShipmentMethodQuery leftJoinShipmentType($relationAlias = null) Adds a LEFT JOIN clause to the query using the ShipmentType relation
 * @method     ChildSpyShipmentMethodQuery rightJoinShipmentType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ShipmentType relation
 * @method     ChildSpyShipmentMethodQuery innerJoinShipmentType($relationAlias = null) Adds a INNER JOIN clause to the query using the ShipmentType relation
 *
 * @method     ChildSpyShipmentMethodQuery joinWithShipmentType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ShipmentType relation
 *
 * @method     ChildSpyShipmentMethodQuery leftJoinWithShipmentType() Adds a LEFT JOIN clause and with to the query using the ShipmentType relation
 * @method     ChildSpyShipmentMethodQuery rightJoinWithShipmentType() Adds a RIGHT JOIN clause and with to the query using the ShipmentType relation
 * @method     ChildSpyShipmentMethodQuery innerJoinWithShipmentType() Adds a INNER JOIN clause and with to the query using the ShipmentType relation
 *
 * @method     ChildSpyShipmentMethodQuery leftJoinShipmentCarrier($relationAlias = null) Adds a LEFT JOIN clause to the query using the ShipmentCarrier relation
 * @method     ChildSpyShipmentMethodQuery rightJoinShipmentCarrier($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ShipmentCarrier relation
 * @method     ChildSpyShipmentMethodQuery innerJoinShipmentCarrier($relationAlias = null) Adds a INNER JOIN clause to the query using the ShipmentCarrier relation
 *
 * @method     ChildSpyShipmentMethodQuery joinWithShipmentCarrier($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ShipmentCarrier relation
 *
 * @method     ChildSpyShipmentMethodQuery leftJoinWithShipmentCarrier() Adds a LEFT JOIN clause and with to the query using the ShipmentCarrier relation
 * @method     ChildSpyShipmentMethodQuery rightJoinWithShipmentCarrier() Adds a RIGHT JOIN clause and with to the query using the ShipmentCarrier relation
 * @method     ChildSpyShipmentMethodQuery innerJoinWithShipmentCarrier() Adds a INNER JOIN clause and with to the query using the ShipmentCarrier relation
 *
 * @method     ChildSpyShipmentMethodQuery leftJoinTaxSet($relationAlias = null) Adds a LEFT JOIN clause to the query using the TaxSet relation
 * @method     ChildSpyShipmentMethodQuery rightJoinTaxSet($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TaxSet relation
 * @method     ChildSpyShipmentMethodQuery innerJoinTaxSet($relationAlias = null) Adds a INNER JOIN clause to the query using the TaxSet relation
 *
 * @method     ChildSpyShipmentMethodQuery joinWithTaxSet($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TaxSet relation
 *
 * @method     ChildSpyShipmentMethodQuery leftJoinWithTaxSet() Adds a LEFT JOIN clause and with to the query using the TaxSet relation
 * @method     ChildSpyShipmentMethodQuery rightJoinWithTaxSet() Adds a RIGHT JOIN clause and with to the query using the TaxSet relation
 * @method     ChildSpyShipmentMethodQuery innerJoinWithTaxSet() Adds a INNER JOIN clause and with to the query using the TaxSet relation
 *
 * @method     ChildSpyShipmentMethodQuery leftJoinShipmentMethodPrice($relationAlias = null) Adds a LEFT JOIN clause to the query using the ShipmentMethodPrice relation
 * @method     ChildSpyShipmentMethodQuery rightJoinShipmentMethodPrice($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ShipmentMethodPrice relation
 * @method     ChildSpyShipmentMethodQuery innerJoinShipmentMethodPrice($relationAlias = null) Adds a INNER JOIN clause to the query using the ShipmentMethodPrice relation
 *
 * @method     ChildSpyShipmentMethodQuery joinWithShipmentMethodPrice($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ShipmentMethodPrice relation
 *
 * @method     ChildSpyShipmentMethodQuery leftJoinWithShipmentMethodPrice() Adds a LEFT JOIN clause and with to the query using the ShipmentMethodPrice relation
 * @method     ChildSpyShipmentMethodQuery rightJoinWithShipmentMethodPrice() Adds a RIGHT JOIN clause and with to the query using the ShipmentMethodPrice relation
 * @method     ChildSpyShipmentMethodQuery innerJoinWithShipmentMethodPrice() Adds a INNER JOIN clause and with to the query using the ShipmentMethodPrice relation
 *
 * @method     ChildSpyShipmentMethodQuery leftJoinShipmentMethodStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the ShipmentMethodStore relation
 * @method     ChildSpyShipmentMethodQuery rightJoinShipmentMethodStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ShipmentMethodStore relation
 * @method     ChildSpyShipmentMethodQuery innerJoinShipmentMethodStore($relationAlias = null) Adds a INNER JOIN clause to the query using the ShipmentMethodStore relation
 *
 * @method     ChildSpyShipmentMethodQuery joinWithShipmentMethodStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ShipmentMethodStore relation
 *
 * @method     ChildSpyShipmentMethodQuery leftJoinWithShipmentMethodStore() Adds a LEFT JOIN clause and with to the query using the ShipmentMethodStore relation
 * @method     ChildSpyShipmentMethodQuery rightJoinWithShipmentMethodStore() Adds a RIGHT JOIN clause and with to the query using the ShipmentMethodStore relation
 * @method     ChildSpyShipmentMethodQuery innerJoinWithShipmentMethodStore() Adds a INNER JOIN clause and with to the query using the ShipmentMethodStore relation
 *
 * @method     \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeQuery|\Orm\Zed\Shipment\Persistence\SpyShipmentCarrierQuery|\Orm\Zed\Tax\Persistence\SpyTaxSetQuery|\Orm\Zed\Shipment\Persistence\SpyShipmentMethodPriceQuery|\Orm\Zed\Shipment\Persistence\SpyShipmentMethodStoreQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyShipmentMethod|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyShipmentMethod matching the query
 * @method     ChildSpyShipmentMethod findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyShipmentMethod matching the query, or a new ChildSpyShipmentMethod object populated from the query conditions when no match is found
 *
 * @method     ChildSpyShipmentMethod|null findOneByIdShipmentMethod(int $id_shipment_method) Return the first ChildSpyShipmentMethod filtered by the id_shipment_method column
 * @method     ChildSpyShipmentMethod|null findOneByFkShipmentCarrier(int $fk_shipment_carrier) Return the first ChildSpyShipmentMethod filtered by the fk_shipment_carrier column
 * @method     ChildSpyShipmentMethod|null findOneByFkShipmentType(int $fk_shipment_type) Return the first ChildSpyShipmentMethod filtered by the fk_shipment_type column
 * @method     ChildSpyShipmentMethod|null findOneByFkTaxSet(int $fk_tax_set) Return the first ChildSpyShipmentMethod filtered by the fk_tax_set column
 * @method     ChildSpyShipmentMethod|null findOneByAvailabilityPlugin(string $availability_plugin) Return the first ChildSpyShipmentMethod filtered by the availability_plugin column
 * @method     ChildSpyShipmentMethod|null findOneByDefaultPrice(int $default_price) Return the first ChildSpyShipmentMethod filtered by the default_price column
 * @method     ChildSpyShipmentMethod|null findOneByDeliveryTimePlugin(string $delivery_time_plugin) Return the first ChildSpyShipmentMethod filtered by the delivery_time_plugin column
 * @method     ChildSpyShipmentMethod|null findOneByIsActive(boolean $is_active) Return the first ChildSpyShipmentMethod filtered by the is_active column
 * @method     ChildSpyShipmentMethod|null findOneByName(string $name) Return the first ChildSpyShipmentMethod filtered by the name column
 * @method     ChildSpyShipmentMethod|null findOneByPricePlugin(string $price_plugin) Return the first ChildSpyShipmentMethod filtered by the price_plugin column
 * @method     ChildSpyShipmentMethod|null findOneByShipmentMethodKey(string $shipment_method_key) Return the first ChildSpyShipmentMethod filtered by the shipment_method_key column
 *
 * @method     ChildSpyShipmentMethod requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyShipmentMethod by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyShipmentMethod requireOne(?ConnectionInterface $con = null) Return the first ChildSpyShipmentMethod matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyShipmentMethod requireOneByIdShipmentMethod(int $id_shipment_method) Return the first ChildSpyShipmentMethod filtered by the id_shipment_method column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyShipmentMethod requireOneByFkShipmentCarrier(int $fk_shipment_carrier) Return the first ChildSpyShipmentMethod filtered by the fk_shipment_carrier column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyShipmentMethod requireOneByFkShipmentType(int $fk_shipment_type) Return the first ChildSpyShipmentMethod filtered by the fk_shipment_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyShipmentMethod requireOneByFkTaxSet(int $fk_tax_set) Return the first ChildSpyShipmentMethod filtered by the fk_tax_set column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyShipmentMethod requireOneByAvailabilityPlugin(string $availability_plugin) Return the first ChildSpyShipmentMethod filtered by the availability_plugin column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyShipmentMethod requireOneByDefaultPrice(int $default_price) Return the first ChildSpyShipmentMethod filtered by the default_price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyShipmentMethod requireOneByDeliveryTimePlugin(string $delivery_time_plugin) Return the first ChildSpyShipmentMethod filtered by the delivery_time_plugin column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyShipmentMethod requireOneByIsActive(boolean $is_active) Return the first ChildSpyShipmentMethod filtered by the is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyShipmentMethod requireOneByName(string $name) Return the first ChildSpyShipmentMethod filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyShipmentMethod requireOneByPricePlugin(string $price_plugin) Return the first ChildSpyShipmentMethod filtered by the price_plugin column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyShipmentMethod requireOneByShipmentMethodKey(string $shipment_method_key) Return the first ChildSpyShipmentMethod filtered by the shipment_method_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyShipmentMethod[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyShipmentMethod objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyShipmentMethod> find(?ConnectionInterface $con = null) Return ChildSpyShipmentMethod objects based on current ModelCriteria
 *
 * @method     ChildSpyShipmentMethod[]|Collection findByIdShipmentMethod(int|array<int> $id_shipment_method) Return ChildSpyShipmentMethod objects filtered by the id_shipment_method column
 * @psalm-method Collection&\Traversable<ChildSpyShipmentMethod> findByIdShipmentMethod(int|array<int> $id_shipment_method) Return ChildSpyShipmentMethod objects filtered by the id_shipment_method column
 * @method     ChildSpyShipmentMethod[]|Collection findByFkShipmentCarrier(int|array<int> $fk_shipment_carrier) Return ChildSpyShipmentMethod objects filtered by the fk_shipment_carrier column
 * @psalm-method Collection&\Traversable<ChildSpyShipmentMethod> findByFkShipmentCarrier(int|array<int> $fk_shipment_carrier) Return ChildSpyShipmentMethod objects filtered by the fk_shipment_carrier column
 * @method     ChildSpyShipmentMethod[]|Collection findByFkShipmentType(int|array<int> $fk_shipment_type) Return ChildSpyShipmentMethod objects filtered by the fk_shipment_type column
 * @psalm-method Collection&\Traversable<ChildSpyShipmentMethod> findByFkShipmentType(int|array<int> $fk_shipment_type) Return ChildSpyShipmentMethod objects filtered by the fk_shipment_type column
 * @method     ChildSpyShipmentMethod[]|Collection findByFkTaxSet(int|array<int> $fk_tax_set) Return ChildSpyShipmentMethod objects filtered by the fk_tax_set column
 * @psalm-method Collection&\Traversable<ChildSpyShipmentMethod> findByFkTaxSet(int|array<int> $fk_tax_set) Return ChildSpyShipmentMethod objects filtered by the fk_tax_set column
 * @method     ChildSpyShipmentMethod[]|Collection findByAvailabilityPlugin(string|array<string> $availability_plugin) Return ChildSpyShipmentMethod objects filtered by the availability_plugin column
 * @psalm-method Collection&\Traversable<ChildSpyShipmentMethod> findByAvailabilityPlugin(string|array<string> $availability_plugin) Return ChildSpyShipmentMethod objects filtered by the availability_plugin column
 * @method     ChildSpyShipmentMethod[]|Collection findByDefaultPrice(int|array<int> $default_price) Return ChildSpyShipmentMethod objects filtered by the default_price column
 * @psalm-method Collection&\Traversable<ChildSpyShipmentMethod> findByDefaultPrice(int|array<int> $default_price) Return ChildSpyShipmentMethod objects filtered by the default_price column
 * @method     ChildSpyShipmentMethod[]|Collection findByDeliveryTimePlugin(string|array<string> $delivery_time_plugin) Return ChildSpyShipmentMethod objects filtered by the delivery_time_plugin column
 * @psalm-method Collection&\Traversable<ChildSpyShipmentMethod> findByDeliveryTimePlugin(string|array<string> $delivery_time_plugin) Return ChildSpyShipmentMethod objects filtered by the delivery_time_plugin column
 * @method     ChildSpyShipmentMethod[]|Collection findByIsActive(boolean|array<boolean> $is_active) Return ChildSpyShipmentMethod objects filtered by the is_active column
 * @psalm-method Collection&\Traversable<ChildSpyShipmentMethod> findByIsActive(boolean|array<boolean> $is_active) Return ChildSpyShipmentMethod objects filtered by the is_active column
 * @method     ChildSpyShipmentMethod[]|Collection findByName(string|array<string> $name) Return ChildSpyShipmentMethod objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildSpyShipmentMethod> findByName(string|array<string> $name) Return ChildSpyShipmentMethod objects filtered by the name column
 * @method     ChildSpyShipmentMethod[]|Collection findByPricePlugin(string|array<string> $price_plugin) Return ChildSpyShipmentMethod objects filtered by the price_plugin column
 * @psalm-method Collection&\Traversable<ChildSpyShipmentMethod> findByPricePlugin(string|array<string> $price_plugin) Return ChildSpyShipmentMethod objects filtered by the price_plugin column
 * @method     ChildSpyShipmentMethod[]|Collection findByShipmentMethodKey(string|array<string> $shipment_method_key) Return ChildSpyShipmentMethod objects filtered by the shipment_method_key column
 * @psalm-method Collection&\Traversable<ChildSpyShipmentMethod> findByShipmentMethodKey(string|array<string> $shipment_method_key) Return ChildSpyShipmentMethod objects filtered by the shipment_method_key column
 *
 * @method     ChildSpyShipmentMethod[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyShipmentMethod> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyShipmentMethodQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\Shipment\Persistence\Base\SpyShipmentMethodQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\Shipment\\Persistence\\SpyShipmentMethod', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyShipmentMethodQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyShipmentMethodQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyShipmentMethodQuery) {
            return $criteria;
        }
        $query = new ChildSpyShipmentMethodQuery();
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
     * @return ChildSpyShipmentMethod|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyShipmentMethodTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyShipmentMethod A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id_shipment_method`, `fk_shipment_carrier`, `fk_shipment_type`, `fk_tax_set`, `availability_plugin`, `default_price`, `delivery_time_plugin`, `is_active`, `name`, `price_plugin`, `shipment_method_key` FROM `spy_shipment_method` WHERE `id_shipment_method` = :p0';
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
            /** @var ChildSpyShipmentMethod $obj */
            $obj = new ChildSpyShipmentMethod();
            $obj->hydrate($row);
            SpyShipmentMethodTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyShipmentMethod|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyShipmentMethodTableMap::COL_ID_SHIPMENT_METHOD, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyShipmentMethodTableMap::COL_ID_SHIPMENT_METHOD, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idShipmentMethod Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdShipmentMethod_Between(array $idShipmentMethod)
    {
        return $this->filterByIdShipmentMethod($idShipmentMethod, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idShipmentMethods Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdShipmentMethod_In(array $idShipmentMethods)
    {
        return $this->filterByIdShipmentMethod($idShipmentMethods, Criteria::IN);
    }

    /**
     * Filter the query on the id_shipment_method column
     *
     * Example usage:
     * <code>
     * $query->filterByIdShipmentMethod(1234); // WHERE id_shipment_method = 1234
     * $query->filterByIdShipmentMethod(array(12, 34), Criteria::IN); // WHERE id_shipment_method IN (12, 34)
     * $query->filterByIdShipmentMethod(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_shipment_method > 12
     * </code>
     *
     * @param     mixed $idShipmentMethod The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdShipmentMethod($idShipmentMethod = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idShipmentMethod)) {
            $useMinMax = false;
            if (isset($idShipmentMethod['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyShipmentMethodTableMap::COL_ID_SHIPMENT_METHOD, $idShipmentMethod['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idShipmentMethod['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyShipmentMethodTableMap::COL_ID_SHIPMENT_METHOD, $idShipmentMethod['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idShipmentMethod of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyShipmentMethodTableMap::COL_ID_SHIPMENT_METHOD, $idShipmentMethod, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkShipmentCarrier Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkShipmentCarrier_Between(array $fkShipmentCarrier)
    {
        return $this->filterByFkShipmentCarrier($fkShipmentCarrier, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkShipmentCarriers Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkShipmentCarrier_In(array $fkShipmentCarriers)
    {
        return $this->filterByFkShipmentCarrier($fkShipmentCarriers, Criteria::IN);
    }

    /**
     * Filter the query on the fk_shipment_carrier column
     *
     * Example usage:
     * <code>
     * $query->filterByFkShipmentCarrier(1234); // WHERE fk_shipment_carrier = 1234
     * $query->filterByFkShipmentCarrier(array(12, 34), Criteria::IN); // WHERE fk_shipment_carrier IN (12, 34)
     * $query->filterByFkShipmentCarrier(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_shipment_carrier > 12
     * </code>
     *
     * @see       filterByShipmentCarrier()
     *
     * @param     mixed $fkShipmentCarrier The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkShipmentCarrier($fkShipmentCarrier = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkShipmentCarrier)) {
            $useMinMax = false;
            if (isset($fkShipmentCarrier['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyShipmentMethodTableMap::COL_FK_SHIPMENT_CARRIER, $fkShipmentCarrier['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkShipmentCarrier['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyShipmentMethodTableMap::COL_FK_SHIPMENT_CARRIER, $fkShipmentCarrier['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkShipmentCarrier of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyShipmentMethodTableMap::COL_FK_SHIPMENT_CARRIER, $fkShipmentCarrier, $comparison);

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
                $this->addUsingAlias(SpyShipmentMethodTableMap::COL_FK_SHIPMENT_TYPE, $fkShipmentType['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkShipmentType['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyShipmentMethodTableMap::COL_FK_SHIPMENT_TYPE, $fkShipmentType['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkShipmentType of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyShipmentMethodTableMap::COL_FK_SHIPMENT_TYPE, $fkShipmentType, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkTaxSet Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkTaxSet_Between(array $fkTaxSet)
    {
        return $this->filterByFkTaxSet($fkTaxSet, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkTaxSets Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkTaxSet_In(array $fkTaxSets)
    {
        return $this->filterByFkTaxSet($fkTaxSets, Criteria::IN);
    }

    /**
     * Filter the query on the fk_tax_set column
     *
     * Example usage:
     * <code>
     * $query->filterByFkTaxSet(1234); // WHERE fk_tax_set = 1234
     * $query->filterByFkTaxSet(array(12, 34), Criteria::IN); // WHERE fk_tax_set IN (12, 34)
     * $query->filterByFkTaxSet(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_tax_set > 12
     * </code>
     *
     * @see       filterByTaxSet()
     *
     * @param     mixed $fkTaxSet The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkTaxSet($fkTaxSet = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkTaxSet)) {
            $useMinMax = false;
            if (isset($fkTaxSet['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyShipmentMethodTableMap::COL_FK_TAX_SET, $fkTaxSet['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkTaxSet['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyShipmentMethodTableMap::COL_FK_TAX_SET, $fkTaxSet['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkTaxSet of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyShipmentMethodTableMap::COL_FK_TAX_SET, $fkTaxSet, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $availabilityPlugins Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAvailabilityPlugin_In(array $availabilityPlugins)
    {
        return $this->filterByAvailabilityPlugin($availabilityPlugins, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $availabilityPlugin Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAvailabilityPlugin_Like($availabilityPlugin)
    {
        return $this->filterByAvailabilityPlugin($availabilityPlugin, Criteria::LIKE);
    }

    /**
     * Filter the query on the availability_plugin column
     *
     * Example usage:
     * <code>
     * $query->filterByAvailabilityPlugin('fooValue');   // WHERE availability_plugin = 'fooValue'
     * $query->filterByAvailabilityPlugin('%fooValue%', Criteria::LIKE); // WHERE availability_plugin LIKE '%fooValue%'
     * $query->filterByAvailabilityPlugin([1, 'foo'], Criteria::IN); // WHERE availability_plugin IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $availabilityPlugin The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAvailabilityPlugin($availabilityPlugin = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $availabilityPlugin = str_replace('*', '%', $availabilityPlugin);
        }

        if (is_array($availabilityPlugin) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$availabilityPlugin of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyShipmentMethodTableMap::COL_AVAILABILITY_PLUGIN, $availabilityPlugin, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $defaultPrice Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDefaultPrice_Between(array $defaultPrice)
    {
        return $this->filterByDefaultPrice($defaultPrice, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $defaultPrices Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDefaultPrice_In(array $defaultPrices)
    {
        return $this->filterByDefaultPrice($defaultPrices, Criteria::IN);
    }

    /**
     * Filter the query on the default_price column
     *
     * Example usage:
     * <code>
     * $query->filterByDefaultPrice(1234); // WHERE default_price = 1234
     * $query->filterByDefaultPrice(array(12, 34), Criteria::IN); // WHERE default_price IN (12, 34)
     * $query->filterByDefaultPrice(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE default_price > 12
     * </code>
     *
     * @param     mixed $defaultPrice The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByDefaultPrice($defaultPrice = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($defaultPrice)) {
            $useMinMax = false;
            if (isset($defaultPrice['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyShipmentMethodTableMap::COL_DEFAULT_PRICE, $defaultPrice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($defaultPrice['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyShipmentMethodTableMap::COL_DEFAULT_PRICE, $defaultPrice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$defaultPrice of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyShipmentMethodTableMap::COL_DEFAULT_PRICE, $defaultPrice, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $deliveryTimePlugins Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDeliveryTimePlugin_In(array $deliveryTimePlugins)
    {
        return $this->filterByDeliveryTimePlugin($deliveryTimePlugins, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $deliveryTimePlugin Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDeliveryTimePlugin_Like($deliveryTimePlugin)
    {
        return $this->filterByDeliveryTimePlugin($deliveryTimePlugin, Criteria::LIKE);
    }

    /**
     * Filter the query on the delivery_time_plugin column
     *
     * Example usage:
     * <code>
     * $query->filterByDeliveryTimePlugin('fooValue');   // WHERE delivery_time_plugin = 'fooValue'
     * $query->filterByDeliveryTimePlugin('%fooValue%', Criteria::LIKE); // WHERE delivery_time_plugin LIKE '%fooValue%'
     * $query->filterByDeliveryTimePlugin([1, 'foo'], Criteria::IN); // WHERE delivery_time_plugin IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $deliveryTimePlugin The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByDeliveryTimePlugin($deliveryTimePlugin = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $deliveryTimePlugin = str_replace('*', '%', $deliveryTimePlugin);
        }

        if (is_array($deliveryTimePlugin) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$deliveryTimePlugin of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyShipmentMethodTableMap::COL_DELIVERY_TIME_PLUGIN, $deliveryTimePlugin, $comparison);

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

        $query = $this->addUsingAlias(SpyShipmentMethodTableMap::COL_IS_ACTIVE, $isActive, $comparison);

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

        $query = $this->addUsingAlias(SpyShipmentMethodTableMap::COL_NAME, $name, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $pricePlugins Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPricePlugin_In(array $pricePlugins)
    {
        return $this->filterByPricePlugin($pricePlugins, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $pricePlugin Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPricePlugin_Like($pricePlugin)
    {
        return $this->filterByPricePlugin($pricePlugin, Criteria::LIKE);
    }

    /**
     * Filter the query on the price_plugin column
     *
     * Example usage:
     * <code>
     * $query->filterByPricePlugin('fooValue');   // WHERE price_plugin = 'fooValue'
     * $query->filterByPricePlugin('%fooValue%', Criteria::LIKE); // WHERE price_plugin LIKE '%fooValue%'
     * $query->filterByPricePlugin([1, 'foo'], Criteria::IN); // WHERE price_plugin IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $pricePlugin The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByPricePlugin($pricePlugin = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $pricePlugin = str_replace('*', '%', $pricePlugin);
        }

        if (is_array($pricePlugin) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$pricePlugin of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyShipmentMethodTableMap::COL_PRICE_PLUGIN, $pricePlugin, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $shipmentMethodKeys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByShipmentMethodKey_In(array $shipmentMethodKeys)
    {
        return $this->filterByShipmentMethodKey($shipmentMethodKeys, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $shipmentMethodKey Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByShipmentMethodKey_Like($shipmentMethodKey)
    {
        return $this->filterByShipmentMethodKey($shipmentMethodKey, Criteria::LIKE);
    }

    /**
     * Filter the query on the shipment_method_key column
     *
     * Example usage:
     * <code>
     * $query->filterByShipmentMethodKey('fooValue');   // WHERE shipment_method_key = 'fooValue'
     * $query->filterByShipmentMethodKey('%fooValue%', Criteria::LIKE); // WHERE shipment_method_key LIKE '%fooValue%'
     * $query->filterByShipmentMethodKey([1, 'foo'], Criteria::IN); // WHERE shipment_method_key IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $shipmentMethodKey The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByShipmentMethodKey($shipmentMethodKey = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $shipmentMethodKey = str_replace('*', '%', $shipmentMethodKey);
        }

        if (is_array($shipmentMethodKey) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$shipmentMethodKey of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyShipmentMethodTableMap::COL_SHIPMENT_METHOD_KEY, $shipmentMethodKey, $comparison);

        return $query;
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
                ->addUsingAlias(SpyShipmentMethodTableMap::COL_FK_SHIPMENT_TYPE, $spyShipmentType->getIdShipmentType(), $comparison);
        } elseif ($spyShipmentType instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyShipmentMethodTableMap::COL_FK_SHIPMENT_TYPE, $spyShipmentType->toKeyValue('PrimaryKey', 'IdShipmentType'), $comparison);

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
    public function joinShipmentType(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useShipmentTypeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
     * Filter the query by a related \Orm\Zed\Shipment\Persistence\SpyShipmentCarrier object
     *
     * @param \Orm\Zed\Shipment\Persistence\SpyShipmentCarrier|ObjectCollection $spyShipmentCarrier The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByShipmentCarrier($spyShipmentCarrier, ?string $comparison = null)
    {
        if ($spyShipmentCarrier instanceof \Orm\Zed\Shipment\Persistence\SpyShipmentCarrier) {
            return $this
                ->addUsingAlias(SpyShipmentMethodTableMap::COL_FK_SHIPMENT_CARRIER, $spyShipmentCarrier->getIdShipmentCarrier(), $comparison);
        } elseif ($spyShipmentCarrier instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyShipmentMethodTableMap::COL_FK_SHIPMENT_CARRIER, $spyShipmentCarrier->toKeyValue('PrimaryKey', 'IdShipmentCarrier'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByShipmentCarrier() only accepts arguments of type \Orm\Zed\Shipment\Persistence\SpyShipmentCarrier or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ShipmentCarrier relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinShipmentCarrier(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ShipmentCarrier');

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
            $this->addJoinObject($join, 'ShipmentCarrier');
        }

        return $this;
    }

    /**
     * Use the ShipmentCarrier relation SpyShipmentCarrier object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Shipment\Persistence\SpyShipmentCarrierQuery A secondary query class using the current class as primary query
     */
    public function useShipmentCarrierQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinShipmentCarrier($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ShipmentCarrier', '\Orm\Zed\Shipment\Persistence\SpyShipmentCarrierQuery');
    }

    /**
     * Use the ShipmentCarrier relation SpyShipmentCarrier object
     *
     * @param callable(\Orm\Zed\Shipment\Persistence\SpyShipmentCarrierQuery):\Orm\Zed\Shipment\Persistence\SpyShipmentCarrierQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withShipmentCarrierQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useShipmentCarrierQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ShipmentCarrier relation to the SpyShipmentCarrier table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Shipment\Persistence\SpyShipmentCarrierQuery The inner query object of the EXISTS statement
     */
    public function useShipmentCarrierExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Shipment\Persistence\SpyShipmentCarrierQuery */
        $q = $this->useExistsQuery('ShipmentCarrier', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ShipmentCarrier relation to the SpyShipmentCarrier table for a NOT EXISTS query.
     *
     * @see useShipmentCarrierExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Shipment\Persistence\SpyShipmentCarrierQuery The inner query object of the NOT EXISTS statement
     */
    public function useShipmentCarrierNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Shipment\Persistence\SpyShipmentCarrierQuery */
        $q = $this->useExistsQuery('ShipmentCarrier', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ShipmentCarrier relation to the SpyShipmentCarrier table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Shipment\Persistence\SpyShipmentCarrierQuery The inner query object of the IN statement
     */
    public function useInShipmentCarrierQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Shipment\Persistence\SpyShipmentCarrierQuery */
        $q = $this->useInQuery('ShipmentCarrier', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ShipmentCarrier relation to the SpyShipmentCarrier table for a NOT IN query.
     *
     * @see useShipmentCarrierInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Shipment\Persistence\SpyShipmentCarrierQuery The inner query object of the NOT IN statement
     */
    public function useNotInShipmentCarrierQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Shipment\Persistence\SpyShipmentCarrierQuery */
        $q = $this->useInQuery('ShipmentCarrier', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Tax\Persistence\SpyTaxSet object
     *
     * @param \Orm\Zed\Tax\Persistence\SpyTaxSet|ObjectCollection $spyTaxSet The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTaxSet($spyTaxSet, ?string $comparison = null)
    {
        if ($spyTaxSet instanceof \Orm\Zed\Tax\Persistence\SpyTaxSet) {
            return $this
                ->addUsingAlias(SpyShipmentMethodTableMap::COL_FK_TAX_SET, $spyTaxSet->getIdTaxSet(), $comparison);
        } elseif ($spyTaxSet instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyShipmentMethodTableMap::COL_FK_TAX_SET, $spyTaxSet->toKeyValue('PrimaryKey', 'IdTaxSet'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByTaxSet() only accepts arguments of type \Orm\Zed\Tax\Persistence\SpyTaxSet or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TaxSet relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinTaxSet(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TaxSet');

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
            $this->addJoinObject($join, 'TaxSet');
        }

        return $this;
    }

    /**
     * Use the TaxSet relation SpyTaxSet object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Tax\Persistence\SpyTaxSetQuery A secondary query class using the current class as primary query
     */
    public function useTaxSetQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTaxSet($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TaxSet', '\Orm\Zed\Tax\Persistence\SpyTaxSetQuery');
    }

    /**
     * Use the TaxSet relation SpyTaxSet object
     *
     * @param callable(\Orm\Zed\Tax\Persistence\SpyTaxSetQuery):\Orm\Zed\Tax\Persistence\SpyTaxSetQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTaxSetQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useTaxSetQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the TaxSet relation to the SpyTaxSet table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Tax\Persistence\SpyTaxSetQuery The inner query object of the EXISTS statement
     */
    public function useTaxSetExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Tax\Persistence\SpyTaxSetQuery */
        $q = $this->useExistsQuery('TaxSet', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the TaxSet relation to the SpyTaxSet table for a NOT EXISTS query.
     *
     * @see useTaxSetExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Tax\Persistence\SpyTaxSetQuery The inner query object of the NOT EXISTS statement
     */
    public function useTaxSetNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Tax\Persistence\SpyTaxSetQuery */
        $q = $this->useExistsQuery('TaxSet', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the TaxSet relation to the SpyTaxSet table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Tax\Persistence\SpyTaxSetQuery The inner query object of the IN statement
     */
    public function useInTaxSetQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Tax\Persistence\SpyTaxSetQuery */
        $q = $this->useInQuery('TaxSet', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the TaxSet relation to the SpyTaxSet table for a NOT IN query.
     *
     * @see useTaxSetInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Tax\Persistence\SpyTaxSetQuery The inner query object of the NOT IN statement
     */
    public function useNotInTaxSetQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Tax\Persistence\SpyTaxSetQuery */
        $q = $this->useInQuery('TaxSet', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Shipment\Persistence\SpyShipmentMethodPrice object
     *
     * @param \Orm\Zed\Shipment\Persistence\SpyShipmentMethodPrice|ObjectCollection $spyShipmentMethodPrice the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByShipmentMethodPrice($spyShipmentMethodPrice, ?string $comparison = null)
    {
        if ($spyShipmentMethodPrice instanceof \Orm\Zed\Shipment\Persistence\SpyShipmentMethodPrice) {
            $this
                ->addUsingAlias(SpyShipmentMethodTableMap::COL_ID_SHIPMENT_METHOD, $spyShipmentMethodPrice->getFkShipmentMethod(), $comparison);

            return $this;
        } elseif ($spyShipmentMethodPrice instanceof ObjectCollection) {
            $this
                ->useShipmentMethodPriceQuery()
                ->filterByPrimaryKeys($spyShipmentMethodPrice->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByShipmentMethodPrice() only accepts arguments of type \Orm\Zed\Shipment\Persistence\SpyShipmentMethodPrice or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ShipmentMethodPrice relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinShipmentMethodPrice(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ShipmentMethodPrice');

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
            $this->addJoinObject($join, 'ShipmentMethodPrice');
        }

        return $this;
    }

    /**
     * Use the ShipmentMethodPrice relation SpyShipmentMethodPrice object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Shipment\Persistence\SpyShipmentMethodPriceQuery A secondary query class using the current class as primary query
     */
    public function useShipmentMethodPriceQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinShipmentMethodPrice($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ShipmentMethodPrice', '\Orm\Zed\Shipment\Persistence\SpyShipmentMethodPriceQuery');
    }

    /**
     * Use the ShipmentMethodPrice relation SpyShipmentMethodPrice object
     *
     * @param callable(\Orm\Zed\Shipment\Persistence\SpyShipmentMethodPriceQuery):\Orm\Zed\Shipment\Persistence\SpyShipmentMethodPriceQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withShipmentMethodPriceQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useShipmentMethodPriceQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ShipmentMethodPrice relation to the SpyShipmentMethodPrice table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Shipment\Persistence\SpyShipmentMethodPriceQuery The inner query object of the EXISTS statement
     */
    public function useShipmentMethodPriceExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Shipment\Persistence\SpyShipmentMethodPriceQuery */
        $q = $this->useExistsQuery('ShipmentMethodPrice', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ShipmentMethodPrice relation to the SpyShipmentMethodPrice table for a NOT EXISTS query.
     *
     * @see useShipmentMethodPriceExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Shipment\Persistence\SpyShipmentMethodPriceQuery The inner query object of the NOT EXISTS statement
     */
    public function useShipmentMethodPriceNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Shipment\Persistence\SpyShipmentMethodPriceQuery */
        $q = $this->useExistsQuery('ShipmentMethodPrice', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ShipmentMethodPrice relation to the SpyShipmentMethodPrice table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Shipment\Persistence\SpyShipmentMethodPriceQuery The inner query object of the IN statement
     */
    public function useInShipmentMethodPriceQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Shipment\Persistence\SpyShipmentMethodPriceQuery */
        $q = $this->useInQuery('ShipmentMethodPrice', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ShipmentMethodPrice relation to the SpyShipmentMethodPrice table for a NOT IN query.
     *
     * @see useShipmentMethodPriceInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Shipment\Persistence\SpyShipmentMethodPriceQuery The inner query object of the NOT IN statement
     */
    public function useNotInShipmentMethodPriceQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Shipment\Persistence\SpyShipmentMethodPriceQuery */
        $q = $this->useInQuery('ShipmentMethodPrice', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Shipment\Persistence\SpyShipmentMethodStore object
     *
     * @param \Orm\Zed\Shipment\Persistence\SpyShipmentMethodStore|ObjectCollection $spyShipmentMethodStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByShipmentMethodStore($spyShipmentMethodStore, ?string $comparison = null)
    {
        if ($spyShipmentMethodStore instanceof \Orm\Zed\Shipment\Persistence\SpyShipmentMethodStore) {
            $this
                ->addUsingAlias(SpyShipmentMethodTableMap::COL_ID_SHIPMENT_METHOD, $spyShipmentMethodStore->getFkShipmentMethod(), $comparison);

            return $this;
        } elseif ($spyShipmentMethodStore instanceof ObjectCollection) {
            $this
                ->useShipmentMethodStoreQuery()
                ->filterByPrimaryKeys($spyShipmentMethodStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByShipmentMethodStore() only accepts arguments of type \Orm\Zed\Shipment\Persistence\SpyShipmentMethodStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ShipmentMethodStore relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinShipmentMethodStore(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ShipmentMethodStore');

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
            $this->addJoinObject($join, 'ShipmentMethodStore');
        }

        return $this;
    }

    /**
     * Use the ShipmentMethodStore relation SpyShipmentMethodStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Shipment\Persistence\SpyShipmentMethodStoreQuery A secondary query class using the current class as primary query
     */
    public function useShipmentMethodStoreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinShipmentMethodStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ShipmentMethodStore', '\Orm\Zed\Shipment\Persistence\SpyShipmentMethodStoreQuery');
    }

    /**
     * Use the ShipmentMethodStore relation SpyShipmentMethodStore object
     *
     * @param callable(\Orm\Zed\Shipment\Persistence\SpyShipmentMethodStoreQuery):\Orm\Zed\Shipment\Persistence\SpyShipmentMethodStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withShipmentMethodStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useShipmentMethodStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ShipmentMethodStore relation to the SpyShipmentMethodStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Shipment\Persistence\SpyShipmentMethodStoreQuery The inner query object of the EXISTS statement
     */
    public function useShipmentMethodStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Shipment\Persistence\SpyShipmentMethodStoreQuery */
        $q = $this->useExistsQuery('ShipmentMethodStore', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ShipmentMethodStore relation to the SpyShipmentMethodStore table for a NOT EXISTS query.
     *
     * @see useShipmentMethodStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Shipment\Persistence\SpyShipmentMethodStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useShipmentMethodStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Shipment\Persistence\SpyShipmentMethodStoreQuery */
        $q = $this->useExistsQuery('ShipmentMethodStore', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ShipmentMethodStore relation to the SpyShipmentMethodStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Shipment\Persistence\SpyShipmentMethodStoreQuery The inner query object of the IN statement
     */
    public function useInShipmentMethodStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Shipment\Persistence\SpyShipmentMethodStoreQuery */
        $q = $this->useInQuery('ShipmentMethodStore', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ShipmentMethodStore relation to the SpyShipmentMethodStore table for a NOT IN query.
     *
     * @see useShipmentMethodStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Shipment\Persistence\SpyShipmentMethodStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInShipmentMethodStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Shipment\Persistence\SpyShipmentMethodStoreQuery */
        $q = $this->useInQuery('ShipmentMethodStore', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyShipmentMethod $spyShipmentMethod Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyShipmentMethod = null)
    {
        if ($spyShipmentMethod) {
            $this->addUsingAlias(SpyShipmentMethodTableMap::COL_ID_SHIPMENT_METHOD, $spyShipmentMethod->getIdShipmentMethod(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_shipment_method table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyShipmentMethodTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyShipmentMethodTableMap::clearInstancePool();
            SpyShipmentMethodTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyShipmentMethodTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyShipmentMethodTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyShipmentMethodTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyShipmentMethodTableMap::clearRelatedInstancePool();

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
