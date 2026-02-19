<?php

namespace Orm\Zed\SupplierLocation\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\SupplierLocation\Persistence\PyzSupplierLocation as ChildPyzSupplierLocation;
use Orm\Zed\SupplierLocation\Persistence\PyzSupplierLocationQuery as ChildPyzSupplierLocationQuery;
use Orm\Zed\SupplierLocation\Persistence\Map\PyzSupplierLocationTableMap;
use Orm\Zed\Supplier\Persistence\PyzSupplier;
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
 * Base class that represents a query for the `pyz_supplier_location` table.
 *
 * @method     ChildPyzSupplierLocationQuery orderByIdSupplierLocation($order = Criteria::ASC) Order by the id_supplier_location column
 * @method     ChildPyzSupplierLocationQuery orderByFkSupplier($order = Criteria::ASC) Order by the fk_supplier column
 * @method     ChildPyzSupplierLocationQuery orderByCity($order = Criteria::ASC) Order by the city column
 * @method     ChildPyzSupplierLocationQuery orderByCountry($order = Criteria::ASC) Order by the country column
 * @method     ChildPyzSupplierLocationQuery orderByAddress($order = Criteria::ASC) Order by the address column
 * @method     ChildPyzSupplierLocationQuery orderByZipCode($order = Criteria::ASC) Order by the zip_code column
 * @method     ChildPyzSupplierLocationQuery orderByIsDefault($order = Criteria::ASC) Order by the is_default column
 *
 * @method     ChildPyzSupplierLocationQuery groupByIdSupplierLocation() Group by the id_supplier_location column
 * @method     ChildPyzSupplierLocationQuery groupByFkSupplier() Group by the fk_supplier column
 * @method     ChildPyzSupplierLocationQuery groupByCity() Group by the city column
 * @method     ChildPyzSupplierLocationQuery groupByCountry() Group by the country column
 * @method     ChildPyzSupplierLocationQuery groupByAddress() Group by the address column
 * @method     ChildPyzSupplierLocationQuery groupByZipCode() Group by the zip_code column
 * @method     ChildPyzSupplierLocationQuery groupByIsDefault() Group by the is_default column
 *
 * @method     ChildPyzSupplierLocationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPyzSupplierLocationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPyzSupplierLocationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPyzSupplierLocationQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPyzSupplierLocationQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPyzSupplierLocationQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPyzSupplierLocationQuery leftJoinPyzSupplier($relationAlias = null) Adds a LEFT JOIN clause to the query using the PyzSupplier relation
 * @method     ChildPyzSupplierLocationQuery rightJoinPyzSupplier($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PyzSupplier relation
 * @method     ChildPyzSupplierLocationQuery innerJoinPyzSupplier($relationAlias = null) Adds a INNER JOIN clause to the query using the PyzSupplier relation
 *
 * @method     ChildPyzSupplierLocationQuery joinWithPyzSupplier($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PyzSupplier relation
 *
 * @method     ChildPyzSupplierLocationQuery leftJoinWithPyzSupplier() Adds a LEFT JOIN clause and with to the query using the PyzSupplier relation
 * @method     ChildPyzSupplierLocationQuery rightJoinWithPyzSupplier() Adds a RIGHT JOIN clause and with to the query using the PyzSupplier relation
 * @method     ChildPyzSupplierLocationQuery innerJoinWithPyzSupplier() Adds a INNER JOIN clause and with to the query using the PyzSupplier relation
 *
 * @method     \Orm\Zed\Supplier\Persistence\PyzSupplierQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPyzSupplierLocation|null findOne(?ConnectionInterface $con = null) Return the first ChildPyzSupplierLocation matching the query
 * @method     ChildPyzSupplierLocation findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildPyzSupplierLocation matching the query, or a new ChildPyzSupplierLocation object populated from the query conditions when no match is found
 *
 * @method     ChildPyzSupplierLocation|null findOneByIdSupplierLocation(int $id_supplier_location) Return the first ChildPyzSupplierLocation filtered by the id_supplier_location column
 * @method     ChildPyzSupplierLocation|null findOneByFkSupplier(int $fk_supplier) Return the first ChildPyzSupplierLocation filtered by the fk_supplier column
 * @method     ChildPyzSupplierLocation|null findOneByCity(string $city) Return the first ChildPyzSupplierLocation filtered by the city column
 * @method     ChildPyzSupplierLocation|null findOneByCountry(string $country) Return the first ChildPyzSupplierLocation filtered by the country column
 * @method     ChildPyzSupplierLocation|null findOneByAddress(string $address) Return the first ChildPyzSupplierLocation filtered by the address column
 * @method     ChildPyzSupplierLocation|null findOneByZipCode(string $zip_code) Return the first ChildPyzSupplierLocation filtered by the zip_code column
 * @method     ChildPyzSupplierLocation|null findOneByIsDefault(boolean $is_default) Return the first ChildPyzSupplierLocation filtered by the is_default column
 *
 * @method     ChildPyzSupplierLocation requirePk($key, ?ConnectionInterface $con = null) Return the ChildPyzSupplierLocation by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPyzSupplierLocation requireOne(?ConnectionInterface $con = null) Return the first ChildPyzSupplierLocation matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPyzSupplierLocation requireOneByIdSupplierLocation(int $id_supplier_location) Return the first ChildPyzSupplierLocation filtered by the id_supplier_location column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPyzSupplierLocation requireOneByFkSupplier(int $fk_supplier) Return the first ChildPyzSupplierLocation filtered by the fk_supplier column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPyzSupplierLocation requireOneByCity(string $city) Return the first ChildPyzSupplierLocation filtered by the city column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPyzSupplierLocation requireOneByCountry(string $country) Return the first ChildPyzSupplierLocation filtered by the country column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPyzSupplierLocation requireOneByAddress(string $address) Return the first ChildPyzSupplierLocation filtered by the address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPyzSupplierLocation requireOneByZipCode(string $zip_code) Return the first ChildPyzSupplierLocation filtered by the zip_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPyzSupplierLocation requireOneByIsDefault(boolean $is_default) Return the first ChildPyzSupplierLocation filtered by the is_default column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPyzSupplierLocation[]|Collection find(?ConnectionInterface $con = null) Return ChildPyzSupplierLocation objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildPyzSupplierLocation> find(?ConnectionInterface $con = null) Return ChildPyzSupplierLocation objects based on current ModelCriteria
 *
 * @method     ChildPyzSupplierLocation[]|Collection findByIdSupplierLocation(int|array<int> $id_supplier_location) Return ChildPyzSupplierLocation objects filtered by the id_supplier_location column
 * @psalm-method Collection&\Traversable<ChildPyzSupplierLocation> findByIdSupplierLocation(int|array<int> $id_supplier_location) Return ChildPyzSupplierLocation objects filtered by the id_supplier_location column
 * @method     ChildPyzSupplierLocation[]|Collection findByFkSupplier(int|array<int> $fk_supplier) Return ChildPyzSupplierLocation objects filtered by the fk_supplier column
 * @psalm-method Collection&\Traversable<ChildPyzSupplierLocation> findByFkSupplier(int|array<int> $fk_supplier) Return ChildPyzSupplierLocation objects filtered by the fk_supplier column
 * @method     ChildPyzSupplierLocation[]|Collection findByCity(string|array<string> $city) Return ChildPyzSupplierLocation objects filtered by the city column
 * @psalm-method Collection&\Traversable<ChildPyzSupplierLocation> findByCity(string|array<string> $city) Return ChildPyzSupplierLocation objects filtered by the city column
 * @method     ChildPyzSupplierLocation[]|Collection findByCountry(string|array<string> $country) Return ChildPyzSupplierLocation objects filtered by the country column
 * @psalm-method Collection&\Traversable<ChildPyzSupplierLocation> findByCountry(string|array<string> $country) Return ChildPyzSupplierLocation objects filtered by the country column
 * @method     ChildPyzSupplierLocation[]|Collection findByAddress(string|array<string> $address) Return ChildPyzSupplierLocation objects filtered by the address column
 * @psalm-method Collection&\Traversable<ChildPyzSupplierLocation> findByAddress(string|array<string> $address) Return ChildPyzSupplierLocation objects filtered by the address column
 * @method     ChildPyzSupplierLocation[]|Collection findByZipCode(string|array<string> $zip_code) Return ChildPyzSupplierLocation objects filtered by the zip_code column
 * @psalm-method Collection&\Traversable<ChildPyzSupplierLocation> findByZipCode(string|array<string> $zip_code) Return ChildPyzSupplierLocation objects filtered by the zip_code column
 * @method     ChildPyzSupplierLocation[]|Collection findByIsDefault(boolean|array<boolean> $is_default) Return ChildPyzSupplierLocation objects filtered by the is_default column
 * @psalm-method Collection&\Traversable<ChildPyzSupplierLocation> findByIsDefault(boolean|array<boolean> $is_default) Return ChildPyzSupplierLocation objects filtered by the is_default column
 *
 * @method     ChildPyzSupplierLocation[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildPyzSupplierLocation> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class PyzSupplierLocationQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\SupplierLocation\Persistence\Base\PyzSupplierLocationQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\SupplierLocation\\Persistence\\PyzSupplierLocation', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPyzSupplierLocationQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPyzSupplierLocationQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildPyzSupplierLocationQuery) {
            return $criteria;
        }
        $query = new ChildPyzSupplierLocationQuery();
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
     * @return ChildPyzSupplierLocation|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = PyzSupplierLocationTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPyzSupplierLocation A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_supplier_location, fk_supplier, city, country, address, zip_code, is_default FROM pyz_supplier_location WHERE id_supplier_location = :p0';
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
            /** @var ChildPyzSupplierLocation $obj */
            $obj = new ChildPyzSupplierLocation();
            $obj->hydrate($row);
            PyzSupplierLocationTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPyzSupplierLocation|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(PyzSupplierLocationTableMap::COL_ID_SUPPLIER_LOCATION, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(PyzSupplierLocationTableMap::COL_ID_SUPPLIER_LOCATION, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idSupplierLocation Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdSupplierLocation_Between(array $idSupplierLocation)
    {
        return $this->filterByIdSupplierLocation($idSupplierLocation, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idSupplierLocations Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdSupplierLocation_In(array $idSupplierLocations)
    {
        return $this->filterByIdSupplierLocation($idSupplierLocations, Criteria::IN);
    }

    /**
     * Filter the query on the id_supplier_location column
     *
     * Example usage:
     * <code>
     * $query->filterByIdSupplierLocation(1234); // WHERE id_supplier_location = 1234
     * $query->filterByIdSupplierLocation(array(12, 34), Criteria::IN); // WHERE id_supplier_location IN (12, 34)
     * $query->filterByIdSupplierLocation(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_supplier_location > 12
     * </code>
     *
     * @param     mixed $idSupplierLocation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdSupplierLocation($idSupplierLocation = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idSupplierLocation)) {
            $useMinMax = false;
            if (isset($idSupplierLocation['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(PyzSupplierLocationTableMap::COL_ID_SUPPLIER_LOCATION, $idSupplierLocation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idSupplierLocation['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(PyzSupplierLocationTableMap::COL_ID_SUPPLIER_LOCATION, $idSupplierLocation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idSupplierLocation of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(PyzSupplierLocationTableMap::COL_ID_SUPPLIER_LOCATION, $idSupplierLocation, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkSupplier Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkSupplier_Between(array $fkSupplier)
    {
        return $this->filterByFkSupplier($fkSupplier, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkSuppliers Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkSupplier_In(array $fkSuppliers)
    {
        return $this->filterByFkSupplier($fkSuppliers, Criteria::IN);
    }

    /**
     * Filter the query on the fk_supplier column
     *
     * Example usage:
     * <code>
     * $query->filterByFkSupplier(1234); // WHERE fk_supplier = 1234
     * $query->filterByFkSupplier(array(12, 34), Criteria::IN); // WHERE fk_supplier IN (12, 34)
     * $query->filterByFkSupplier(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_supplier > 12
     * </code>
     *
     * @see       filterByPyzSupplier()
     *
     * @param     mixed $fkSupplier The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkSupplier($fkSupplier = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkSupplier)) {
            $useMinMax = false;
            if (isset($fkSupplier['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(PyzSupplierLocationTableMap::COL_FK_SUPPLIER, $fkSupplier['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkSupplier['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(PyzSupplierLocationTableMap::COL_FK_SUPPLIER, $fkSupplier['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkSupplier of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(PyzSupplierLocationTableMap::COL_FK_SUPPLIER, $fkSupplier, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $citys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCity_In(array $citys)
    {
        return $this->filterByCity($citys, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $city Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCity_Like($city)
    {
        return $this->filterByCity($city, Criteria::LIKE);
    }

    /**
     * Filter the query on the city column
     *
     * Example usage:
     * <code>
     * $query->filterByCity('fooValue');   // WHERE city = 'fooValue'
     * $query->filterByCity('%fooValue%', Criteria::LIKE); // WHERE city LIKE '%fooValue%'
     * $query->filterByCity([1, 'foo'], Criteria::IN); // WHERE city IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $city The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByCity($city = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $city = str_replace('*', '%', $city);
        }

        if (is_array($city) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$city of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(PyzSupplierLocationTableMap::COL_CITY, $city, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $countrys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCountry_In(array $countrys)
    {
        return $this->filterByCountry($countrys, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $country Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCountry_Like($country)
    {
        return $this->filterByCountry($country, Criteria::LIKE);
    }

    /**
     * Filter the query on the country column
     *
     * Example usage:
     * <code>
     * $query->filterByCountry('fooValue');   // WHERE country = 'fooValue'
     * $query->filterByCountry('%fooValue%', Criteria::LIKE); // WHERE country LIKE '%fooValue%'
     * $query->filterByCountry([1, 'foo'], Criteria::IN); // WHERE country IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $country The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByCountry($country = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $country = str_replace('*', '%', $country);
        }

        if (is_array($country) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$country of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(PyzSupplierLocationTableMap::COL_COUNTRY, $country, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $addresss Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddress_In(array $addresss)
    {
        return $this->filterByAddress($addresss, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $address Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddress_Like($address)
    {
        return $this->filterByAddress($address, Criteria::LIKE);
    }

    /**
     * Filter the query on the address column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress('fooValue');   // WHERE address = 'fooValue'
     * $query->filterByAddress('%fooValue%', Criteria::LIKE); // WHERE address LIKE '%fooValue%'
     * $query->filterByAddress([1, 'foo'], Criteria::IN); // WHERE address IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $address The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAddress($address = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $address = str_replace('*', '%', $address);
        }

        if (is_array($address) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$address of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(PyzSupplierLocationTableMap::COL_ADDRESS, $address, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $zipCodes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByZipCode_In(array $zipCodes)
    {
        return $this->filterByZipCode($zipCodes, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $zipCode Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByZipCode_Like($zipCode)
    {
        return $this->filterByZipCode($zipCode, Criteria::LIKE);
    }

    /**
     * Filter the query on the zip_code column
     *
     * Example usage:
     * <code>
     * $query->filterByZipCode('fooValue');   // WHERE zip_code = 'fooValue'
     * $query->filterByZipCode('%fooValue%', Criteria::LIKE); // WHERE zip_code LIKE '%fooValue%'
     * $query->filterByZipCode([1, 'foo'], Criteria::IN); // WHERE zip_code IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $zipCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByZipCode($zipCode = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $zipCode = str_replace('*', '%', $zipCode);
        }

        if (is_array($zipCode) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$zipCode of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(PyzSupplierLocationTableMap::COL_ZIP_CODE, $zipCode, $comparison);

        return $query;
    }

    /**
     * Filter the query on the is_default column
     *
     * Example usage:
     * <code>
     * $query->filterByIsDefault(true); // WHERE is_default = true
     * $query->filterByIsDefault('yes'); // WHERE is_default = true
     * </code>
     *
     * @param     bool|string $isDefault The value to use as filter.
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
    public function filterByIsDefault($isDefault = null, $comparison = Criteria::EQUAL)
    {
        if (is_string($isDefault)) {
            $isDefault = in_array(strtolower($isDefault), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $query = $this->addUsingAlias(PyzSupplierLocationTableMap::COL_IS_DEFAULT, $isDefault, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Supplier\Persistence\PyzSupplier object
     *
     * @param \Orm\Zed\Supplier\Persistence\PyzSupplier|ObjectCollection $pyzSupplier The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPyzSupplier($pyzSupplier, ?string $comparison = null)
    {
        if ($pyzSupplier instanceof \Orm\Zed\Supplier\Persistence\PyzSupplier) {
            return $this
                ->addUsingAlias(PyzSupplierLocationTableMap::COL_FK_SUPPLIER, $pyzSupplier->getIdSupplier(), $comparison);
        } elseif ($pyzSupplier instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(PyzSupplierLocationTableMap::COL_FK_SUPPLIER, $pyzSupplier->toKeyValue('PrimaryKey', 'IdSupplier'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByPyzSupplier() only accepts arguments of type \Orm\Zed\Supplier\Persistence\PyzSupplier or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PyzSupplier relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPyzSupplier(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PyzSupplier');

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
            $this->addJoinObject($join, 'PyzSupplier');
        }

        return $this;
    }

    /**
     * Use the PyzSupplier relation PyzSupplier object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Supplier\Persistence\PyzSupplierQuery A secondary query class using the current class as primary query
     */
    public function usePyzSupplierQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPyzSupplier($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PyzSupplier', '\Orm\Zed\Supplier\Persistence\PyzSupplierQuery');
    }

    /**
     * Use the PyzSupplier relation PyzSupplier object
     *
     * @param callable(\Orm\Zed\Supplier\Persistence\PyzSupplierQuery):\Orm\Zed\Supplier\Persistence\PyzSupplierQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPyzSupplierQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->usePyzSupplierQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to PyzSupplier table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Supplier\Persistence\PyzSupplierQuery The inner query object of the EXISTS statement
     */
    public function usePyzSupplierExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Supplier\Persistence\PyzSupplierQuery */
        $q = $this->useExistsQuery('PyzSupplier', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to PyzSupplier table for a NOT EXISTS query.
     *
     * @see usePyzSupplierExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Supplier\Persistence\PyzSupplierQuery The inner query object of the NOT EXISTS statement
     */
    public function usePyzSupplierNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Supplier\Persistence\PyzSupplierQuery */
        $q = $this->useExistsQuery('PyzSupplier', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to PyzSupplier table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Supplier\Persistence\PyzSupplierQuery The inner query object of the IN statement
     */
    public function useInPyzSupplierQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Supplier\Persistence\PyzSupplierQuery */
        $q = $this->useInQuery('PyzSupplier', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to PyzSupplier table for a NOT IN query.
     *
     * @see usePyzSupplierInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Supplier\Persistence\PyzSupplierQuery The inner query object of the NOT IN statement
     */
    public function useNotInPyzSupplierQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Supplier\Persistence\PyzSupplierQuery */
        $q = $this->useInQuery('PyzSupplier', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildPyzSupplierLocation $pyzSupplierLocation Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($pyzSupplierLocation = null)
    {
        if ($pyzSupplierLocation) {
            $this->addUsingAlias(PyzSupplierLocationTableMap::COL_ID_SUPPLIER_LOCATION, $pyzSupplierLocation->getIdSupplierLocation(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the pyz_supplier_location table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PyzSupplierLocationTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PyzSupplierLocationTableMap::clearInstancePool();
            PyzSupplierLocationTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PyzSupplierLocationTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PyzSupplierLocationTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PyzSupplierLocationTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PyzSupplierLocationTableMap::clearRelatedInstancePool();

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
