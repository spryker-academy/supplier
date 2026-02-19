<?php

namespace Orm\Zed\MerchantProfile\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\Country\Persistence\SpyCountry;
use Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddress as ChildSpyMerchantProfileAddress;
use Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddressQuery as ChildSpyMerchantProfileAddressQuery;
use Orm\Zed\MerchantProfile\Persistence\Map\SpyMerchantProfileAddressTableMap;
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
 * Base class that represents a query for the `spy_merchant_profile_address` table.
 *
 * @method     ChildSpyMerchantProfileAddressQuery orderByIdMerchantProfileAddress($order = Criteria::ASC) Order by the id_merchant_profile_address column
 * @method     ChildSpyMerchantProfileAddressQuery orderByFkCountry($order = Criteria::ASC) Order by the fk_country column
 * @method     ChildSpyMerchantProfileAddressQuery orderByAddress1($order = Criteria::ASC) Order by the address1 column
 * @method     ChildSpyMerchantProfileAddressQuery orderByAddress2($order = Criteria::ASC) Order by the address2 column
 * @method     ChildSpyMerchantProfileAddressQuery orderByAddress3($order = Criteria::ASC) Order by the address3 column
 * @method     ChildSpyMerchantProfileAddressQuery orderByCity($order = Criteria::ASC) Order by the city column
 * @method     ChildSpyMerchantProfileAddressQuery orderByZipCode($order = Criteria::ASC) Order by the zip_code column
 * @method     ChildSpyMerchantProfileAddressQuery orderByFkMerchantProfile($order = Criteria::ASC) Order by the fk_merchant_profile column
 * @method     ChildSpyMerchantProfileAddressQuery orderByLongitude($order = Criteria::ASC) Order by the longitude column
 * @method     ChildSpyMerchantProfileAddressQuery orderByLatitude($order = Criteria::ASC) Order by the latitude column
 *
 * @method     ChildSpyMerchantProfileAddressQuery groupByIdMerchantProfileAddress() Group by the id_merchant_profile_address column
 * @method     ChildSpyMerchantProfileAddressQuery groupByFkCountry() Group by the fk_country column
 * @method     ChildSpyMerchantProfileAddressQuery groupByAddress1() Group by the address1 column
 * @method     ChildSpyMerchantProfileAddressQuery groupByAddress2() Group by the address2 column
 * @method     ChildSpyMerchantProfileAddressQuery groupByAddress3() Group by the address3 column
 * @method     ChildSpyMerchantProfileAddressQuery groupByCity() Group by the city column
 * @method     ChildSpyMerchantProfileAddressQuery groupByZipCode() Group by the zip_code column
 * @method     ChildSpyMerchantProfileAddressQuery groupByFkMerchantProfile() Group by the fk_merchant_profile column
 * @method     ChildSpyMerchantProfileAddressQuery groupByLongitude() Group by the longitude column
 * @method     ChildSpyMerchantProfileAddressQuery groupByLatitude() Group by the latitude column
 *
 * @method     ChildSpyMerchantProfileAddressQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyMerchantProfileAddressQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyMerchantProfileAddressQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyMerchantProfileAddressQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyMerchantProfileAddressQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyMerchantProfileAddressQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyMerchantProfileAddressQuery leftJoinSpyCountry($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCountry relation
 * @method     ChildSpyMerchantProfileAddressQuery rightJoinSpyCountry($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCountry relation
 * @method     ChildSpyMerchantProfileAddressQuery innerJoinSpyCountry($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCountry relation
 *
 * @method     ChildSpyMerchantProfileAddressQuery joinWithSpyCountry($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCountry relation
 *
 * @method     ChildSpyMerchantProfileAddressQuery leftJoinWithSpyCountry() Adds a LEFT JOIN clause and with to the query using the SpyCountry relation
 * @method     ChildSpyMerchantProfileAddressQuery rightJoinWithSpyCountry() Adds a RIGHT JOIN clause and with to the query using the SpyCountry relation
 * @method     ChildSpyMerchantProfileAddressQuery innerJoinWithSpyCountry() Adds a INNER JOIN clause and with to the query using the SpyCountry relation
 *
 * @method     ChildSpyMerchantProfileAddressQuery leftJoinSpyMerchantProfile($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchantProfile relation
 * @method     ChildSpyMerchantProfileAddressQuery rightJoinSpyMerchantProfile($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchantProfile relation
 * @method     ChildSpyMerchantProfileAddressQuery innerJoinSpyMerchantProfile($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchantProfile relation
 *
 * @method     ChildSpyMerchantProfileAddressQuery joinWithSpyMerchantProfile($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchantProfile relation
 *
 * @method     ChildSpyMerchantProfileAddressQuery leftJoinWithSpyMerchantProfile() Adds a LEFT JOIN clause and with to the query using the SpyMerchantProfile relation
 * @method     ChildSpyMerchantProfileAddressQuery rightJoinWithSpyMerchantProfile() Adds a RIGHT JOIN clause and with to the query using the SpyMerchantProfile relation
 * @method     ChildSpyMerchantProfileAddressQuery innerJoinWithSpyMerchantProfile() Adds a INNER JOIN clause and with to the query using the SpyMerchantProfile relation
 *
 * @method     \Orm\Zed\Country\Persistence\SpyCountryQuery|\Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyMerchantProfileAddress|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyMerchantProfileAddress matching the query
 * @method     ChildSpyMerchantProfileAddress findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyMerchantProfileAddress matching the query, or a new ChildSpyMerchantProfileAddress object populated from the query conditions when no match is found
 *
 * @method     ChildSpyMerchantProfileAddress|null findOneByIdMerchantProfileAddress(int $id_merchant_profile_address) Return the first ChildSpyMerchantProfileAddress filtered by the id_merchant_profile_address column
 * @method     ChildSpyMerchantProfileAddress|null findOneByFkCountry(int $fk_country) Return the first ChildSpyMerchantProfileAddress filtered by the fk_country column
 * @method     ChildSpyMerchantProfileAddress|null findOneByAddress1(string $address1) Return the first ChildSpyMerchantProfileAddress filtered by the address1 column
 * @method     ChildSpyMerchantProfileAddress|null findOneByAddress2(string $address2) Return the first ChildSpyMerchantProfileAddress filtered by the address2 column
 * @method     ChildSpyMerchantProfileAddress|null findOneByAddress3(string $address3) Return the first ChildSpyMerchantProfileAddress filtered by the address3 column
 * @method     ChildSpyMerchantProfileAddress|null findOneByCity(string $city) Return the first ChildSpyMerchantProfileAddress filtered by the city column
 * @method     ChildSpyMerchantProfileAddress|null findOneByZipCode(string $zip_code) Return the first ChildSpyMerchantProfileAddress filtered by the zip_code column
 * @method     ChildSpyMerchantProfileAddress|null findOneByFkMerchantProfile(int $fk_merchant_profile) Return the first ChildSpyMerchantProfileAddress filtered by the fk_merchant_profile column
 * @method     ChildSpyMerchantProfileAddress|null findOneByLongitude(string $longitude) Return the first ChildSpyMerchantProfileAddress filtered by the longitude column
 * @method     ChildSpyMerchantProfileAddress|null findOneByLatitude(string $latitude) Return the first ChildSpyMerchantProfileAddress filtered by the latitude column
 *
 * @method     ChildSpyMerchantProfileAddress requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyMerchantProfileAddress by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantProfileAddress requireOne(?ConnectionInterface $con = null) Return the first ChildSpyMerchantProfileAddress matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyMerchantProfileAddress requireOneByIdMerchantProfileAddress(int $id_merchant_profile_address) Return the first ChildSpyMerchantProfileAddress filtered by the id_merchant_profile_address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantProfileAddress requireOneByFkCountry(int $fk_country) Return the first ChildSpyMerchantProfileAddress filtered by the fk_country column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantProfileAddress requireOneByAddress1(string $address1) Return the first ChildSpyMerchantProfileAddress filtered by the address1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantProfileAddress requireOneByAddress2(string $address2) Return the first ChildSpyMerchantProfileAddress filtered by the address2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantProfileAddress requireOneByAddress3(string $address3) Return the first ChildSpyMerchantProfileAddress filtered by the address3 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantProfileAddress requireOneByCity(string $city) Return the first ChildSpyMerchantProfileAddress filtered by the city column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantProfileAddress requireOneByZipCode(string $zip_code) Return the first ChildSpyMerchantProfileAddress filtered by the zip_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantProfileAddress requireOneByFkMerchantProfile(int $fk_merchant_profile) Return the first ChildSpyMerchantProfileAddress filtered by the fk_merchant_profile column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantProfileAddress requireOneByLongitude(string $longitude) Return the first ChildSpyMerchantProfileAddress filtered by the longitude column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantProfileAddress requireOneByLatitude(string $latitude) Return the first ChildSpyMerchantProfileAddress filtered by the latitude column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyMerchantProfileAddress[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyMerchantProfileAddress objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyMerchantProfileAddress> find(?ConnectionInterface $con = null) Return ChildSpyMerchantProfileAddress objects based on current ModelCriteria
 *
 * @method     ChildSpyMerchantProfileAddress[]|Collection findByIdMerchantProfileAddress(int|array<int> $id_merchant_profile_address) Return ChildSpyMerchantProfileAddress objects filtered by the id_merchant_profile_address column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantProfileAddress> findByIdMerchantProfileAddress(int|array<int> $id_merchant_profile_address) Return ChildSpyMerchantProfileAddress objects filtered by the id_merchant_profile_address column
 * @method     ChildSpyMerchantProfileAddress[]|Collection findByFkCountry(int|array<int> $fk_country) Return ChildSpyMerchantProfileAddress objects filtered by the fk_country column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantProfileAddress> findByFkCountry(int|array<int> $fk_country) Return ChildSpyMerchantProfileAddress objects filtered by the fk_country column
 * @method     ChildSpyMerchantProfileAddress[]|Collection findByAddress1(string|array<string> $address1) Return ChildSpyMerchantProfileAddress objects filtered by the address1 column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantProfileAddress> findByAddress1(string|array<string> $address1) Return ChildSpyMerchantProfileAddress objects filtered by the address1 column
 * @method     ChildSpyMerchantProfileAddress[]|Collection findByAddress2(string|array<string> $address2) Return ChildSpyMerchantProfileAddress objects filtered by the address2 column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantProfileAddress> findByAddress2(string|array<string> $address2) Return ChildSpyMerchantProfileAddress objects filtered by the address2 column
 * @method     ChildSpyMerchantProfileAddress[]|Collection findByAddress3(string|array<string> $address3) Return ChildSpyMerchantProfileAddress objects filtered by the address3 column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantProfileAddress> findByAddress3(string|array<string> $address3) Return ChildSpyMerchantProfileAddress objects filtered by the address3 column
 * @method     ChildSpyMerchantProfileAddress[]|Collection findByCity(string|array<string> $city) Return ChildSpyMerchantProfileAddress objects filtered by the city column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantProfileAddress> findByCity(string|array<string> $city) Return ChildSpyMerchantProfileAddress objects filtered by the city column
 * @method     ChildSpyMerchantProfileAddress[]|Collection findByZipCode(string|array<string> $zip_code) Return ChildSpyMerchantProfileAddress objects filtered by the zip_code column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantProfileAddress> findByZipCode(string|array<string> $zip_code) Return ChildSpyMerchantProfileAddress objects filtered by the zip_code column
 * @method     ChildSpyMerchantProfileAddress[]|Collection findByFkMerchantProfile(int|array<int> $fk_merchant_profile) Return ChildSpyMerchantProfileAddress objects filtered by the fk_merchant_profile column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantProfileAddress> findByFkMerchantProfile(int|array<int> $fk_merchant_profile) Return ChildSpyMerchantProfileAddress objects filtered by the fk_merchant_profile column
 * @method     ChildSpyMerchantProfileAddress[]|Collection findByLongitude(string|array<string> $longitude) Return ChildSpyMerchantProfileAddress objects filtered by the longitude column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantProfileAddress> findByLongitude(string|array<string> $longitude) Return ChildSpyMerchantProfileAddress objects filtered by the longitude column
 * @method     ChildSpyMerchantProfileAddress[]|Collection findByLatitude(string|array<string> $latitude) Return ChildSpyMerchantProfileAddress objects filtered by the latitude column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantProfileAddress> findByLatitude(string|array<string> $latitude) Return ChildSpyMerchantProfileAddress objects filtered by the latitude column
 *
 * @method     ChildSpyMerchantProfileAddress[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyMerchantProfileAddress> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyMerchantProfileAddressQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\MerchantProfile\Persistence\Base\SpyMerchantProfileAddressQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\MerchantProfile\\Persistence\\SpyMerchantProfileAddress', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyMerchantProfileAddressQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyMerchantProfileAddressQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyMerchantProfileAddressQuery) {
            return $criteria;
        }
        $query = new ChildSpyMerchantProfileAddressQuery();
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
     * @return ChildSpyMerchantProfileAddress|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyMerchantProfileAddressTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyMerchantProfileAddress A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id_merchant_profile_address`, `fk_country`, `address1`, `address2`, `address3`, `city`, `zip_code`, `fk_merchant_profile`, `longitude`, `latitude` FROM `spy_merchant_profile_address` WHERE `id_merchant_profile_address` = :p0';
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
            /** @var ChildSpyMerchantProfileAddress $obj */
            $obj = new ChildSpyMerchantProfileAddress();
            $obj->hydrate($row);
            SpyMerchantProfileAddressTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyMerchantProfileAddress|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyMerchantProfileAddressTableMap::COL_ID_MERCHANT_PROFILE_ADDRESS, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyMerchantProfileAddressTableMap::COL_ID_MERCHANT_PROFILE_ADDRESS, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idMerchantProfileAddress Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdMerchantProfileAddress_Between(array $idMerchantProfileAddress)
    {
        return $this->filterByIdMerchantProfileAddress($idMerchantProfileAddress, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idMerchantProfileAddresss Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdMerchantProfileAddress_In(array $idMerchantProfileAddresss)
    {
        return $this->filterByIdMerchantProfileAddress($idMerchantProfileAddresss, Criteria::IN);
    }

    /**
     * Filter the query on the id_merchant_profile_address column
     *
     * Example usage:
     * <code>
     * $query->filterByIdMerchantProfileAddress(1234); // WHERE id_merchant_profile_address = 1234
     * $query->filterByIdMerchantProfileAddress(array(12, 34), Criteria::IN); // WHERE id_merchant_profile_address IN (12, 34)
     * $query->filterByIdMerchantProfileAddress(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_merchant_profile_address > 12
     * </code>
     *
     * @param     mixed $idMerchantProfileAddress The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdMerchantProfileAddress($idMerchantProfileAddress = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idMerchantProfileAddress)) {
            $useMinMax = false;
            if (isset($idMerchantProfileAddress['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantProfileAddressTableMap::COL_ID_MERCHANT_PROFILE_ADDRESS, $idMerchantProfileAddress['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idMerchantProfileAddress['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantProfileAddressTableMap::COL_ID_MERCHANT_PROFILE_ADDRESS, $idMerchantProfileAddress['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idMerchantProfileAddress of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantProfileAddressTableMap::COL_ID_MERCHANT_PROFILE_ADDRESS, $idMerchantProfileAddress, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkCountry Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCountry_Between(array $fkCountry)
    {
        return $this->filterByFkCountry($fkCountry, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkCountrys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCountry_In(array $fkCountrys)
    {
        return $this->filterByFkCountry($fkCountrys, Criteria::IN);
    }

    /**
     * Filter the query on the fk_country column
     *
     * Example usage:
     * <code>
     * $query->filterByFkCountry(1234); // WHERE fk_country = 1234
     * $query->filterByFkCountry(array(12, 34), Criteria::IN); // WHERE fk_country IN (12, 34)
     * $query->filterByFkCountry(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_country > 12
     * </code>
     *
     * @see       filterBySpyCountry()
     *
     * @param     mixed $fkCountry The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkCountry($fkCountry = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkCountry)) {
            $useMinMax = false;
            if (isset($fkCountry['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantProfileAddressTableMap::COL_FK_COUNTRY, $fkCountry['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkCountry['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantProfileAddressTableMap::COL_FK_COUNTRY, $fkCountry['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkCountry of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantProfileAddressTableMap::COL_FK_COUNTRY, $fkCountry, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $address1s Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddress1_In(array $address1s)
    {
        return $this->filterByAddress1($address1s, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $address1 Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddress1_Like($address1)
    {
        return $this->filterByAddress1($address1, Criteria::LIKE);
    }

    /**
     * Filter the query on the address1 column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress1('fooValue');   // WHERE address1 = 'fooValue'
     * $query->filterByAddress1('%fooValue%', Criteria::LIKE); // WHERE address1 LIKE '%fooValue%'
     * $query->filterByAddress1([1, 'foo'], Criteria::IN); // WHERE address1 IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $address1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAddress1($address1 = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $address1 = str_replace('*', '%', $address1);
        }

        if (is_array($address1) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$address1 of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantProfileAddressTableMap::COL_ADDRESS1, $address1, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $address2s Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddress2_In(array $address2s)
    {
        return $this->filterByAddress2($address2s, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $address2 Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddress2_Like($address2)
    {
        return $this->filterByAddress2($address2, Criteria::LIKE);
    }

    /**
     * Filter the query on the address2 column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress2('fooValue');   // WHERE address2 = 'fooValue'
     * $query->filterByAddress2('%fooValue%', Criteria::LIKE); // WHERE address2 LIKE '%fooValue%'
     * $query->filterByAddress2([1, 'foo'], Criteria::IN); // WHERE address2 IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $address2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAddress2($address2 = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $address2 = str_replace('*', '%', $address2);
        }

        if (is_array($address2) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$address2 of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantProfileAddressTableMap::COL_ADDRESS2, $address2, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $address3s Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddress3_In(array $address3s)
    {
        return $this->filterByAddress3($address3s, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $address3 Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddress3_Like($address3)
    {
        return $this->filterByAddress3($address3, Criteria::LIKE);
    }

    /**
     * Filter the query on the address3 column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress3('fooValue');   // WHERE address3 = 'fooValue'
     * $query->filterByAddress3('%fooValue%', Criteria::LIKE); // WHERE address3 LIKE '%fooValue%'
     * $query->filterByAddress3([1, 'foo'], Criteria::IN); // WHERE address3 IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $address3 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAddress3($address3 = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $address3 = str_replace('*', '%', $address3);
        }

        if (is_array($address3) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$address3 of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantProfileAddressTableMap::COL_ADDRESS3, $address3, $comparison);

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

        $query = $this->addUsingAlias(SpyMerchantProfileAddressTableMap::COL_CITY, $city, $comparison);

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

        $query = $this->addUsingAlias(SpyMerchantProfileAddressTableMap::COL_ZIP_CODE, $zipCode, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkMerchantProfile Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkMerchantProfile_Between(array $fkMerchantProfile)
    {
        return $this->filterByFkMerchantProfile($fkMerchantProfile, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkMerchantProfiles Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkMerchantProfile_In(array $fkMerchantProfiles)
    {
        return $this->filterByFkMerchantProfile($fkMerchantProfiles, Criteria::IN);
    }

    /**
     * Filter the query on the fk_merchant_profile column
     *
     * Example usage:
     * <code>
     * $query->filterByFkMerchantProfile(1234); // WHERE fk_merchant_profile = 1234
     * $query->filterByFkMerchantProfile(array(12, 34), Criteria::IN); // WHERE fk_merchant_profile IN (12, 34)
     * $query->filterByFkMerchantProfile(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_merchant_profile > 12
     * </code>
     *
     * @see       filterBySpyMerchantProfile()
     *
     * @param     mixed $fkMerchantProfile The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkMerchantProfile($fkMerchantProfile = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkMerchantProfile)) {
            $useMinMax = false;
            if (isset($fkMerchantProfile['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantProfileAddressTableMap::COL_FK_MERCHANT_PROFILE, $fkMerchantProfile['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkMerchantProfile['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantProfileAddressTableMap::COL_FK_MERCHANT_PROFILE, $fkMerchantProfile['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkMerchantProfile of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantProfileAddressTableMap::COL_FK_MERCHANT_PROFILE, $fkMerchantProfile, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $longitudes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLongitude_In(array $longitudes)
    {
        return $this->filterByLongitude($longitudes, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $longitude Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLongitude_Like($longitude)
    {
        return $this->filterByLongitude($longitude, Criteria::LIKE);
    }

    /**
     * Filter the query on the longitude column
     *
     * Example usage:
     * <code>
     * $query->filterByLongitude('fooValue');   // WHERE longitude = 'fooValue'
     * $query->filterByLongitude('%fooValue%', Criteria::LIKE); // WHERE longitude LIKE '%fooValue%'
     * $query->filterByLongitude([1, 'foo'], Criteria::IN); // WHERE longitude IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $longitude The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByLongitude($longitude = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $longitude = str_replace('*', '%', $longitude);
        }

        if (is_array($longitude) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$longitude of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantProfileAddressTableMap::COL_LONGITUDE, $longitude, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $latitudes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLatitude_In(array $latitudes)
    {
        return $this->filterByLatitude($latitudes, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $latitude Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLatitude_Like($latitude)
    {
        return $this->filterByLatitude($latitude, Criteria::LIKE);
    }

    /**
     * Filter the query on the latitude column
     *
     * Example usage:
     * <code>
     * $query->filterByLatitude('fooValue');   // WHERE latitude = 'fooValue'
     * $query->filterByLatitude('%fooValue%', Criteria::LIKE); // WHERE latitude LIKE '%fooValue%'
     * $query->filterByLatitude([1, 'foo'], Criteria::IN); // WHERE latitude IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $latitude The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByLatitude($latitude = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $latitude = str_replace('*', '%', $latitude);
        }

        if (is_array($latitude) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$latitude of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantProfileAddressTableMap::COL_LATITUDE, $latitude, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Country\Persistence\SpyCountry object
     *
     * @param \Orm\Zed\Country\Persistence\SpyCountry|ObjectCollection $spyCountry The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCountry($spyCountry, ?string $comparison = null)
    {
        if ($spyCountry instanceof \Orm\Zed\Country\Persistence\SpyCountry) {
            return $this
                ->addUsingAlias(SpyMerchantProfileAddressTableMap::COL_FK_COUNTRY, $spyCountry->getIdCountry(), $comparison);
        } elseif ($spyCountry instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyMerchantProfileAddressTableMap::COL_FK_COUNTRY, $spyCountry->toKeyValue('PrimaryKey', 'IdCountry'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyCountry() only accepts arguments of type \Orm\Zed\Country\Persistence\SpyCountry or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCountry relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCountry(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCountry');

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
            $this->addJoinObject($join, 'SpyCountry');
        }

        return $this;
    }

    /**
     * Use the SpyCountry relation SpyCountry object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Country\Persistence\SpyCountryQuery A secondary query class using the current class as primary query
     */
    public function useSpyCountryQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpyCountry($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCountry', '\Orm\Zed\Country\Persistence\SpyCountryQuery');
    }

    /**
     * Use the SpyCountry relation SpyCountry object
     *
     * @param callable(\Orm\Zed\Country\Persistence\SpyCountryQuery):\Orm\Zed\Country\Persistence\SpyCountryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCountryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpyCountryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyCountry table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Country\Persistence\SpyCountryQuery The inner query object of the EXISTS statement
     */
    public function useSpyCountryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Country\Persistence\SpyCountryQuery */
        $q = $this->useExistsQuery('SpyCountry', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyCountry table for a NOT EXISTS query.
     *
     * @see useSpyCountryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Country\Persistence\SpyCountryQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCountryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Country\Persistence\SpyCountryQuery */
        $q = $this->useExistsQuery('SpyCountry', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyCountry table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Country\Persistence\SpyCountryQuery The inner query object of the IN statement
     */
    public function useInSpyCountryQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Country\Persistence\SpyCountryQuery */
        $q = $this->useInQuery('SpyCountry', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyCountry table for a NOT IN query.
     *
     * @see useSpyCountryInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Country\Persistence\SpyCountryQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyCountryQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Country\Persistence\SpyCountryQuery */
        $q = $this->useInQuery('SpyCountry', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfile object
     *
     * @param \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfile|ObjectCollection $spyMerchantProfile The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyMerchantProfile($spyMerchantProfile, ?string $comparison = null)
    {
        if ($spyMerchantProfile instanceof \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfile) {
            return $this
                ->addUsingAlias(SpyMerchantProfileAddressTableMap::COL_FK_MERCHANT_PROFILE, $spyMerchantProfile->getIdMerchantProfile(), $comparison);
        } elseif ($spyMerchantProfile instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyMerchantProfileAddressTableMap::COL_FK_MERCHANT_PROFILE, $spyMerchantProfile->toKeyValue('PrimaryKey', 'IdMerchantProfile'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyMerchantProfile() only accepts arguments of type \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfile or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyMerchantProfile relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyMerchantProfile(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyMerchantProfile');

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
            $this->addJoinObject($join, 'SpyMerchantProfile');
        }

        return $this;
    }

    /**
     * Use the SpyMerchantProfile relation SpyMerchantProfile object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileQuery A secondary query class using the current class as primary query
     */
    public function useSpyMerchantProfileQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyMerchantProfile($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyMerchantProfile', '\Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileQuery');
    }

    /**
     * Use the SpyMerchantProfile relation SpyMerchantProfile object
     *
     * @param callable(\Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileQuery):\Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyMerchantProfileQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyMerchantProfileQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyMerchantProfile table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileQuery The inner query object of the EXISTS statement
     */
    public function useSpyMerchantProfileExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileQuery */
        $q = $this->useExistsQuery('SpyMerchantProfile', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantProfile table for a NOT EXISTS query.
     *
     * @see useSpyMerchantProfileExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyMerchantProfileNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileQuery */
        $q = $this->useExistsQuery('SpyMerchantProfile', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyMerchantProfile table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileQuery The inner query object of the IN statement
     */
    public function useInSpyMerchantProfileQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileQuery */
        $q = $this->useInQuery('SpyMerchantProfile', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantProfile table for a NOT IN query.
     *
     * @see useSpyMerchantProfileInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyMerchantProfileQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileQuery */
        $q = $this->useInQuery('SpyMerchantProfile', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyMerchantProfileAddress $spyMerchantProfileAddress Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyMerchantProfileAddress = null)
    {
        if ($spyMerchantProfileAddress) {
            $this->addUsingAlias(SpyMerchantProfileAddressTableMap::COL_ID_MERCHANT_PROFILE_ADDRESS, $spyMerchantProfileAddress->getIdMerchantProfileAddress(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_merchant_profile_address table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantProfileAddressTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyMerchantProfileAddressTableMap::clearInstancePool();
            SpyMerchantProfileAddressTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantProfileAddressTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyMerchantProfileAddressTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyMerchantProfileAddressTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyMerchantProfileAddressTableMap::clearRelatedInstancePool();

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
