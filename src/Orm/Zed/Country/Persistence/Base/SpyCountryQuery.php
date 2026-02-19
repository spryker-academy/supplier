<?php

namespace Orm\Zed\Country\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress;
use Orm\Zed\Country\Persistence\SpyCountry as ChildSpyCountry;
use Orm\Zed\Country\Persistence\SpyCountryQuery as ChildSpyCountryQuery;
use Orm\Zed\Country\Persistence\Map\SpyCountryTableMap;
use Orm\Zed\Customer\Persistence\SpyCustomerAddress;
use Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddress;
use Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequest;
use Orm\Zed\Sales\Persistence\SpySalesOrderAddress;
use Orm\Zed\Sales\Persistence\SpySalesOrderAddressHistory;
use Orm\Zed\ServicePoint\Persistence\SpyServicePointAddress;
use Orm\Zed\StockAddress\Persistence\SpyStockAddress;
use Orm\Zed\Tax\Persistence\SpyTaxRate;
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
 * Base class that represents a query for the `spy_country` table.
 *
 * @method     ChildSpyCountryQuery orderByIdCountry($order = Criteria::ASC) Order by the id_country column
 * @method     ChildSpyCountryQuery orderByIso2Code($order = Criteria::ASC) Order by the iso2_code column
 * @method     ChildSpyCountryQuery orderByIso3Code($order = Criteria::ASC) Order by the iso3_code column
 * @method     ChildSpyCountryQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildSpyCountryQuery orderByPostalCodeMandatory($order = Criteria::ASC) Order by the postal_code_mandatory column
 * @method     ChildSpyCountryQuery orderByPostalCodeRegex($order = Criteria::ASC) Order by the postal_code_regex column
 *
 * @method     ChildSpyCountryQuery groupByIdCountry() Group by the id_country column
 * @method     ChildSpyCountryQuery groupByIso2Code() Group by the iso2_code column
 * @method     ChildSpyCountryQuery groupByIso3Code() Group by the iso3_code column
 * @method     ChildSpyCountryQuery groupByName() Group by the name column
 * @method     ChildSpyCountryQuery groupByPostalCodeMandatory() Group by the postal_code_mandatory column
 * @method     ChildSpyCountryQuery groupByPostalCodeRegex() Group by the postal_code_regex column
 *
 * @method     ChildSpyCountryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyCountryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyCountryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyCountryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyCountryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyCountryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyCountryQuery leftJoinCompanyUnitAddress($relationAlias = null) Adds a LEFT JOIN clause to the query using the CompanyUnitAddress relation
 * @method     ChildSpyCountryQuery rightJoinCompanyUnitAddress($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CompanyUnitAddress relation
 * @method     ChildSpyCountryQuery innerJoinCompanyUnitAddress($relationAlias = null) Adds a INNER JOIN clause to the query using the CompanyUnitAddress relation
 *
 * @method     ChildSpyCountryQuery joinWithCompanyUnitAddress($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CompanyUnitAddress relation
 *
 * @method     ChildSpyCountryQuery leftJoinWithCompanyUnitAddress() Adds a LEFT JOIN clause and with to the query using the CompanyUnitAddress relation
 * @method     ChildSpyCountryQuery rightJoinWithCompanyUnitAddress() Adds a RIGHT JOIN clause and with to the query using the CompanyUnitAddress relation
 * @method     ChildSpyCountryQuery innerJoinWithCompanyUnitAddress() Adds a INNER JOIN clause and with to the query using the CompanyUnitAddress relation
 *
 * @method     ChildSpyCountryQuery leftJoinSpyRegion($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyRegion relation
 * @method     ChildSpyCountryQuery rightJoinSpyRegion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyRegion relation
 * @method     ChildSpyCountryQuery innerJoinSpyRegion($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyRegion relation
 *
 * @method     ChildSpyCountryQuery joinWithSpyRegion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyRegion relation
 *
 * @method     ChildSpyCountryQuery leftJoinWithSpyRegion() Adds a LEFT JOIN clause and with to the query using the SpyRegion relation
 * @method     ChildSpyCountryQuery rightJoinWithSpyRegion() Adds a RIGHT JOIN clause and with to the query using the SpyRegion relation
 * @method     ChildSpyCountryQuery innerJoinWithSpyRegion() Adds a INNER JOIN clause and with to the query using the SpyRegion relation
 *
 * @method     ChildSpyCountryQuery leftJoinCountryStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the CountryStore relation
 * @method     ChildSpyCountryQuery rightJoinCountryStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CountryStore relation
 * @method     ChildSpyCountryQuery innerJoinCountryStore($relationAlias = null) Adds a INNER JOIN clause to the query using the CountryStore relation
 *
 * @method     ChildSpyCountryQuery joinWithCountryStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CountryStore relation
 *
 * @method     ChildSpyCountryQuery leftJoinWithCountryStore() Adds a LEFT JOIN clause and with to the query using the CountryStore relation
 * @method     ChildSpyCountryQuery rightJoinWithCountryStore() Adds a RIGHT JOIN clause and with to the query using the CountryStore relation
 * @method     ChildSpyCountryQuery innerJoinWithCountryStore() Adds a INNER JOIN clause and with to the query using the CountryStore relation
 *
 * @method     ChildSpyCountryQuery leftJoinCustomerAddress($relationAlias = null) Adds a LEFT JOIN clause to the query using the CustomerAddress relation
 * @method     ChildSpyCountryQuery rightJoinCustomerAddress($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CustomerAddress relation
 * @method     ChildSpyCountryQuery innerJoinCustomerAddress($relationAlias = null) Adds a INNER JOIN clause to the query using the CustomerAddress relation
 *
 * @method     ChildSpyCountryQuery joinWithCustomerAddress($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CustomerAddress relation
 *
 * @method     ChildSpyCountryQuery leftJoinWithCustomerAddress() Adds a LEFT JOIN clause and with to the query using the CustomerAddress relation
 * @method     ChildSpyCountryQuery rightJoinWithCustomerAddress() Adds a RIGHT JOIN clause and with to the query using the CustomerAddress relation
 * @method     ChildSpyCountryQuery innerJoinWithCustomerAddress() Adds a INNER JOIN clause and with to the query using the CustomerAddress relation
 *
 * @method     ChildSpyCountryQuery leftJoinSpyMerchantProfileAddress($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchantProfileAddress relation
 * @method     ChildSpyCountryQuery rightJoinSpyMerchantProfileAddress($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchantProfileAddress relation
 * @method     ChildSpyCountryQuery innerJoinSpyMerchantProfileAddress($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchantProfileAddress relation
 *
 * @method     ChildSpyCountryQuery joinWithSpyMerchantProfileAddress($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchantProfileAddress relation
 *
 * @method     ChildSpyCountryQuery leftJoinWithSpyMerchantProfileAddress() Adds a LEFT JOIN clause and with to the query using the SpyMerchantProfileAddress relation
 * @method     ChildSpyCountryQuery rightJoinWithSpyMerchantProfileAddress() Adds a RIGHT JOIN clause and with to the query using the SpyMerchantProfileAddress relation
 * @method     ChildSpyCountryQuery innerJoinWithSpyMerchantProfileAddress() Adds a INNER JOIN clause and with to the query using the SpyMerchantProfileAddress relation
 *
 * @method     ChildSpyCountryQuery leftJoinSpyMerchantRegistrationRequest($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchantRegistrationRequest relation
 * @method     ChildSpyCountryQuery rightJoinSpyMerchantRegistrationRequest($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchantRegistrationRequest relation
 * @method     ChildSpyCountryQuery innerJoinSpyMerchantRegistrationRequest($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchantRegistrationRequest relation
 *
 * @method     ChildSpyCountryQuery joinWithSpyMerchantRegistrationRequest($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchantRegistrationRequest relation
 *
 * @method     ChildSpyCountryQuery leftJoinWithSpyMerchantRegistrationRequest() Adds a LEFT JOIN clause and with to the query using the SpyMerchantRegistrationRequest relation
 * @method     ChildSpyCountryQuery rightJoinWithSpyMerchantRegistrationRequest() Adds a RIGHT JOIN clause and with to the query using the SpyMerchantRegistrationRequest relation
 * @method     ChildSpyCountryQuery innerJoinWithSpyMerchantRegistrationRequest() Adds a INNER JOIN clause and with to the query using the SpyMerchantRegistrationRequest relation
 *
 * @method     ChildSpyCountryQuery leftJoinSalesOrderAddress($relationAlias = null) Adds a LEFT JOIN clause to the query using the SalesOrderAddress relation
 * @method     ChildSpyCountryQuery rightJoinSalesOrderAddress($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SalesOrderAddress relation
 * @method     ChildSpyCountryQuery innerJoinSalesOrderAddress($relationAlias = null) Adds a INNER JOIN clause to the query using the SalesOrderAddress relation
 *
 * @method     ChildSpyCountryQuery joinWithSalesOrderAddress($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SalesOrderAddress relation
 *
 * @method     ChildSpyCountryQuery leftJoinWithSalesOrderAddress() Adds a LEFT JOIN clause and with to the query using the SalesOrderAddress relation
 * @method     ChildSpyCountryQuery rightJoinWithSalesOrderAddress() Adds a RIGHT JOIN clause and with to the query using the SalesOrderAddress relation
 * @method     ChildSpyCountryQuery innerJoinWithSalesOrderAddress() Adds a INNER JOIN clause and with to the query using the SalesOrderAddress relation
 *
 * @method     ChildSpyCountryQuery leftJoinSalesOrderAddressHistory($relationAlias = null) Adds a LEFT JOIN clause to the query using the SalesOrderAddressHistory relation
 * @method     ChildSpyCountryQuery rightJoinSalesOrderAddressHistory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SalesOrderAddressHistory relation
 * @method     ChildSpyCountryQuery innerJoinSalesOrderAddressHistory($relationAlias = null) Adds a INNER JOIN clause to the query using the SalesOrderAddressHistory relation
 *
 * @method     ChildSpyCountryQuery joinWithSalesOrderAddressHistory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SalesOrderAddressHistory relation
 *
 * @method     ChildSpyCountryQuery leftJoinWithSalesOrderAddressHistory() Adds a LEFT JOIN clause and with to the query using the SalesOrderAddressHistory relation
 * @method     ChildSpyCountryQuery rightJoinWithSalesOrderAddressHistory() Adds a RIGHT JOIN clause and with to the query using the SalesOrderAddressHistory relation
 * @method     ChildSpyCountryQuery innerJoinWithSalesOrderAddressHistory() Adds a INNER JOIN clause and with to the query using the SalesOrderAddressHistory relation
 *
 * @method     ChildSpyCountryQuery leftJoinServicePointAddress($relationAlias = null) Adds a LEFT JOIN clause to the query using the ServicePointAddress relation
 * @method     ChildSpyCountryQuery rightJoinServicePointAddress($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ServicePointAddress relation
 * @method     ChildSpyCountryQuery innerJoinServicePointAddress($relationAlias = null) Adds a INNER JOIN clause to the query using the ServicePointAddress relation
 *
 * @method     ChildSpyCountryQuery joinWithServicePointAddress($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ServicePointAddress relation
 *
 * @method     ChildSpyCountryQuery leftJoinWithServicePointAddress() Adds a LEFT JOIN clause and with to the query using the ServicePointAddress relation
 * @method     ChildSpyCountryQuery rightJoinWithServicePointAddress() Adds a RIGHT JOIN clause and with to the query using the ServicePointAddress relation
 * @method     ChildSpyCountryQuery innerJoinWithServicePointAddress() Adds a INNER JOIN clause and with to the query using the ServicePointAddress relation
 *
 * @method     ChildSpyCountryQuery leftJoinStockAddress($relationAlias = null) Adds a LEFT JOIN clause to the query using the StockAddress relation
 * @method     ChildSpyCountryQuery rightJoinStockAddress($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StockAddress relation
 * @method     ChildSpyCountryQuery innerJoinStockAddress($relationAlias = null) Adds a INNER JOIN clause to the query using the StockAddress relation
 *
 * @method     ChildSpyCountryQuery joinWithStockAddress($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StockAddress relation
 *
 * @method     ChildSpyCountryQuery leftJoinWithStockAddress() Adds a LEFT JOIN clause and with to the query using the StockAddress relation
 * @method     ChildSpyCountryQuery rightJoinWithStockAddress() Adds a RIGHT JOIN clause and with to the query using the StockAddress relation
 * @method     ChildSpyCountryQuery innerJoinWithStockAddress() Adds a INNER JOIN clause and with to the query using the StockAddress relation
 *
 * @method     ChildSpyCountryQuery leftJoinSpyTaxRate($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyTaxRate relation
 * @method     ChildSpyCountryQuery rightJoinSpyTaxRate($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyTaxRate relation
 * @method     ChildSpyCountryQuery innerJoinSpyTaxRate($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyTaxRate relation
 *
 * @method     ChildSpyCountryQuery joinWithSpyTaxRate($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyTaxRate relation
 *
 * @method     ChildSpyCountryQuery leftJoinWithSpyTaxRate() Adds a LEFT JOIN clause and with to the query using the SpyTaxRate relation
 * @method     ChildSpyCountryQuery rightJoinWithSpyTaxRate() Adds a RIGHT JOIN clause and with to the query using the SpyTaxRate relation
 * @method     ChildSpyCountryQuery innerJoinWithSpyTaxRate() Adds a INNER JOIN clause and with to the query using the SpyTaxRate relation
 *
 * @method     \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery|\Orm\Zed\Country\Persistence\SpyRegionQuery|\Orm\Zed\Country\Persistence\SpyCountryStoreQuery|\Orm\Zed\Customer\Persistence\SpyCustomerAddressQuery|\Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddressQuery|\Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequestQuery|\Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery|\Orm\Zed\Sales\Persistence\SpySalesOrderAddressHistoryQuery|\Orm\Zed\ServicePoint\Persistence\SpyServicePointAddressQuery|\Orm\Zed\StockAddress\Persistence\SpyStockAddressQuery|\Orm\Zed\Tax\Persistence\SpyTaxRateQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyCountry|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyCountry matching the query
 * @method     ChildSpyCountry findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyCountry matching the query, or a new ChildSpyCountry object populated from the query conditions when no match is found
 *
 * @method     ChildSpyCountry|null findOneByIdCountry(int $id_country) Return the first ChildSpyCountry filtered by the id_country column
 * @method     ChildSpyCountry|null findOneByIso2Code(string $iso2_code) Return the first ChildSpyCountry filtered by the iso2_code column
 * @method     ChildSpyCountry|null findOneByIso3Code(string $iso3_code) Return the first ChildSpyCountry filtered by the iso3_code column
 * @method     ChildSpyCountry|null findOneByName(string $name) Return the first ChildSpyCountry filtered by the name column
 * @method     ChildSpyCountry|null findOneByPostalCodeMandatory(boolean $postal_code_mandatory) Return the first ChildSpyCountry filtered by the postal_code_mandatory column
 * @method     ChildSpyCountry|null findOneByPostalCodeRegex(string $postal_code_regex) Return the first ChildSpyCountry filtered by the postal_code_regex column
 *
 * @method     ChildSpyCountry requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyCountry by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCountry requireOne(?ConnectionInterface $con = null) Return the first ChildSpyCountry matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyCountry requireOneByIdCountry(int $id_country) Return the first ChildSpyCountry filtered by the id_country column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCountry requireOneByIso2Code(string $iso2_code) Return the first ChildSpyCountry filtered by the iso2_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCountry requireOneByIso3Code(string $iso3_code) Return the first ChildSpyCountry filtered by the iso3_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCountry requireOneByName(string $name) Return the first ChildSpyCountry filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCountry requireOneByPostalCodeMandatory(boolean $postal_code_mandatory) Return the first ChildSpyCountry filtered by the postal_code_mandatory column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCountry requireOneByPostalCodeRegex(string $postal_code_regex) Return the first ChildSpyCountry filtered by the postal_code_regex column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyCountry[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyCountry objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyCountry> find(?ConnectionInterface $con = null) Return ChildSpyCountry objects based on current ModelCriteria
 *
 * @method     ChildSpyCountry[]|Collection findByIdCountry(int|array<int> $id_country) Return ChildSpyCountry objects filtered by the id_country column
 * @psalm-method Collection&\Traversable<ChildSpyCountry> findByIdCountry(int|array<int> $id_country) Return ChildSpyCountry objects filtered by the id_country column
 * @method     ChildSpyCountry[]|Collection findByIso2Code(string|array<string> $iso2_code) Return ChildSpyCountry objects filtered by the iso2_code column
 * @psalm-method Collection&\Traversable<ChildSpyCountry> findByIso2Code(string|array<string> $iso2_code) Return ChildSpyCountry objects filtered by the iso2_code column
 * @method     ChildSpyCountry[]|Collection findByIso3Code(string|array<string> $iso3_code) Return ChildSpyCountry objects filtered by the iso3_code column
 * @psalm-method Collection&\Traversable<ChildSpyCountry> findByIso3Code(string|array<string> $iso3_code) Return ChildSpyCountry objects filtered by the iso3_code column
 * @method     ChildSpyCountry[]|Collection findByName(string|array<string> $name) Return ChildSpyCountry objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildSpyCountry> findByName(string|array<string> $name) Return ChildSpyCountry objects filtered by the name column
 * @method     ChildSpyCountry[]|Collection findByPostalCodeMandatory(boolean|array<boolean> $postal_code_mandatory) Return ChildSpyCountry objects filtered by the postal_code_mandatory column
 * @psalm-method Collection&\Traversable<ChildSpyCountry> findByPostalCodeMandatory(boolean|array<boolean> $postal_code_mandatory) Return ChildSpyCountry objects filtered by the postal_code_mandatory column
 * @method     ChildSpyCountry[]|Collection findByPostalCodeRegex(string|array<string> $postal_code_regex) Return ChildSpyCountry objects filtered by the postal_code_regex column
 * @psalm-method Collection&\Traversable<ChildSpyCountry> findByPostalCodeRegex(string|array<string> $postal_code_regex) Return ChildSpyCountry objects filtered by the postal_code_regex column
 *
 * @method     ChildSpyCountry[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyCountry> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyCountryQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\Country\Persistence\Base\SpyCountryQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\Country\\Persistence\\SpyCountry', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyCountryQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyCountryQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyCountryQuery) {
            return $criteria;
        }
        $query = new ChildSpyCountryQuery();
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
     * @return ChildSpyCountry|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyCountryTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyCountry A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_country, iso2_code, iso3_code, name, postal_code_mandatory, postal_code_regex FROM spy_country WHERE id_country = :p0';
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
            /** @var ChildSpyCountry $obj */
            $obj = new ChildSpyCountry();
            $obj->hydrate($row);
            SpyCountryTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyCountry|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyCountryTableMap::COL_ID_COUNTRY, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyCountryTableMap::COL_ID_COUNTRY, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idCountry Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdCountry_Between(array $idCountry)
    {
        return $this->filterByIdCountry($idCountry, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idCountrys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdCountry_In(array $idCountrys)
    {
        return $this->filterByIdCountry($idCountrys, Criteria::IN);
    }

    /**
     * Filter the query on the id_country column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCountry(1234); // WHERE id_country = 1234
     * $query->filterByIdCountry(array(12, 34), Criteria::IN); // WHERE id_country IN (12, 34)
     * $query->filterByIdCountry(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_country > 12
     * </code>
     *
     * @param     mixed $idCountry The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdCountry($idCountry = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idCountry)) {
            $useMinMax = false;
            if (isset($idCountry['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCountryTableMap::COL_ID_COUNTRY, $idCountry['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCountry['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCountryTableMap::COL_ID_COUNTRY, $idCountry['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idCountry of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCountryTableMap::COL_ID_COUNTRY, $idCountry, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $iso2Codes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIso2Code_In(array $iso2Codes)
    {
        return $this->filterByIso2Code($iso2Codes, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $iso2Code Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIso2Code_Like($iso2Code)
    {
        return $this->filterByIso2Code($iso2Code, Criteria::LIKE);
    }

    /**
     * Filter the query on the iso2_code column
     *
     * Example usage:
     * <code>
     * $query->filterByIso2Code('fooValue');   // WHERE iso2_code = 'fooValue'
     * $query->filterByIso2Code('%fooValue%', Criteria::LIKE); // WHERE iso2_code LIKE '%fooValue%'
     * $query->filterByIso2Code([1, 'foo'], Criteria::IN); // WHERE iso2_code IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $iso2Code The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIso2Code($iso2Code = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $iso2Code = str_replace('*', '%', $iso2Code);
        }

        if (is_array($iso2Code) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$iso2Code of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCountryTableMap::COL_ISO2_CODE, $iso2Code, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $iso3Codes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIso3Code_In(array $iso3Codes)
    {
        return $this->filterByIso3Code($iso3Codes, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $iso3Code Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIso3Code_Like($iso3Code)
    {
        return $this->filterByIso3Code($iso3Code, Criteria::LIKE);
    }

    /**
     * Filter the query on the iso3_code column
     *
     * Example usage:
     * <code>
     * $query->filterByIso3Code('fooValue');   // WHERE iso3_code = 'fooValue'
     * $query->filterByIso3Code('%fooValue%', Criteria::LIKE); // WHERE iso3_code LIKE '%fooValue%'
     * $query->filterByIso3Code([1, 'foo'], Criteria::IN); // WHERE iso3_code IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $iso3Code The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIso3Code($iso3Code = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $iso3Code = str_replace('*', '%', $iso3Code);
        }

        if (is_array($iso3Code) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$iso3Code of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCountryTableMap::COL_ISO3_CODE, $iso3Code, $comparison);

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

        $query = $this->addUsingAlias(SpyCountryTableMap::COL_NAME, $name, $comparison);

        return $query;
    }

    /**
     * Filter the query on the postal_code_mandatory column
     *
     * Example usage:
     * <code>
     * $query->filterByPostalCodeMandatory(true); // WHERE postal_code_mandatory = true
     * $query->filterByPostalCodeMandatory('yes'); // WHERE postal_code_mandatory = true
     * </code>
     *
     * @param     bool|string $postalCodeMandatory The value to use as filter.
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
    public function filterByPostalCodeMandatory($postalCodeMandatory = null, $comparison = Criteria::EQUAL)
    {
        if (is_string($postalCodeMandatory)) {
            $postalCodeMandatory = in_array(strtolower($postalCodeMandatory), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $query = $this->addUsingAlias(SpyCountryTableMap::COL_POSTAL_CODE_MANDATORY, $postalCodeMandatory, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $postalCodeRegexs Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPostalCodeRegex_In(array $postalCodeRegexs)
    {
        return $this->filterByPostalCodeRegex($postalCodeRegexs, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $postalCodeRegex Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPostalCodeRegex_Like($postalCodeRegex)
    {
        return $this->filterByPostalCodeRegex($postalCodeRegex, Criteria::LIKE);
    }

    /**
     * Filter the query on the postal_code_regex column
     *
     * Example usage:
     * <code>
     * $query->filterByPostalCodeRegex('fooValue');   // WHERE postal_code_regex = 'fooValue'
     * $query->filterByPostalCodeRegex('%fooValue%', Criteria::LIKE); // WHERE postal_code_regex LIKE '%fooValue%'
     * $query->filterByPostalCodeRegex([1, 'foo'], Criteria::IN); // WHERE postal_code_regex IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $postalCodeRegex The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByPostalCodeRegex($postalCodeRegex = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $postalCodeRegex = str_replace('*', '%', $postalCodeRegex);
        }

        if (is_array($postalCodeRegex) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$postalCodeRegex of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCountryTableMap::COL_POSTAL_CODE_REGEX, $postalCodeRegex, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress object
     *
     * @param \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress|ObjectCollection $spyCompanyUnitAddress the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompanyUnitAddress($spyCompanyUnitAddress, ?string $comparison = null)
    {
        if ($spyCompanyUnitAddress instanceof \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress) {
            $this
                ->addUsingAlias(SpyCountryTableMap::COL_ID_COUNTRY, $spyCompanyUnitAddress->getFkCountry(), $comparison);

            return $this;
        } elseif ($spyCompanyUnitAddress instanceof ObjectCollection) {
            $this
                ->useCompanyUnitAddressQuery()
                ->filterByPrimaryKeys($spyCompanyUnitAddress->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByCompanyUnitAddress() only accepts arguments of type \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CompanyUnitAddress relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCompanyUnitAddress(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CompanyUnitAddress');

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
            $this->addJoinObject($join, 'CompanyUnitAddress');
        }

        return $this;
    }

    /**
     * Use the CompanyUnitAddress relation SpyCompanyUnitAddress object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery A secondary query class using the current class as primary query
     */
    public function useCompanyUnitAddressQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCompanyUnitAddress($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CompanyUnitAddress', '\Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery');
    }

    /**
     * Use the CompanyUnitAddress relation SpyCompanyUnitAddress object
     *
     * @param callable(\Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery):\Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCompanyUnitAddressQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCompanyUnitAddressQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the CompanyUnitAddress relation to the SpyCompanyUnitAddress table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery The inner query object of the EXISTS statement
     */
    public function useCompanyUnitAddressExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery */
        $q = $this->useExistsQuery('CompanyUnitAddress', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the CompanyUnitAddress relation to the SpyCompanyUnitAddress table for a NOT EXISTS query.
     *
     * @see useCompanyUnitAddressExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery The inner query object of the NOT EXISTS statement
     */
    public function useCompanyUnitAddressNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery */
        $q = $this->useExistsQuery('CompanyUnitAddress', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the CompanyUnitAddress relation to the SpyCompanyUnitAddress table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery The inner query object of the IN statement
     */
    public function useInCompanyUnitAddressQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery */
        $q = $this->useInQuery('CompanyUnitAddress', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the CompanyUnitAddress relation to the SpyCompanyUnitAddress table for a NOT IN query.
     *
     * @see useCompanyUnitAddressInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery The inner query object of the NOT IN statement
     */
    public function useNotInCompanyUnitAddressQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery */
        $q = $this->useInQuery('CompanyUnitAddress', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Country\Persistence\SpyRegion object
     *
     * @param \Orm\Zed\Country\Persistence\SpyRegion|ObjectCollection $spyRegion the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyRegion($spyRegion, ?string $comparison = null)
    {
        if ($spyRegion instanceof \Orm\Zed\Country\Persistence\SpyRegion) {
            $this
                ->addUsingAlias(SpyCountryTableMap::COL_ID_COUNTRY, $spyRegion->getFkCountry(), $comparison);

            return $this;
        } elseif ($spyRegion instanceof ObjectCollection) {
            $this
                ->useSpyRegionQuery()
                ->filterByPrimaryKeys($spyRegion->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyRegion() only accepts arguments of type \Orm\Zed\Country\Persistence\SpyRegion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyRegion relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyRegion(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyRegion');

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
            $this->addJoinObject($join, 'SpyRegion');
        }

        return $this;
    }

    /**
     * Use the SpyRegion relation SpyRegion object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Country\Persistence\SpyRegionQuery A secondary query class using the current class as primary query
     */
    public function useSpyRegionQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpyRegion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyRegion', '\Orm\Zed\Country\Persistence\SpyRegionQuery');
    }

    /**
     * Use the SpyRegion relation SpyRegion object
     *
     * @param callable(\Orm\Zed\Country\Persistence\SpyRegionQuery):\Orm\Zed\Country\Persistence\SpyRegionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyRegionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpyRegionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyRegion table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Country\Persistence\SpyRegionQuery The inner query object of the EXISTS statement
     */
    public function useSpyRegionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Country\Persistence\SpyRegionQuery */
        $q = $this->useExistsQuery('SpyRegion', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyRegion table for a NOT EXISTS query.
     *
     * @see useSpyRegionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Country\Persistence\SpyRegionQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyRegionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Country\Persistence\SpyRegionQuery */
        $q = $this->useExistsQuery('SpyRegion', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyRegion table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Country\Persistence\SpyRegionQuery The inner query object of the IN statement
     */
    public function useInSpyRegionQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Country\Persistence\SpyRegionQuery */
        $q = $this->useInQuery('SpyRegion', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyRegion table for a NOT IN query.
     *
     * @see useSpyRegionInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Country\Persistence\SpyRegionQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyRegionQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Country\Persistence\SpyRegionQuery */
        $q = $this->useInQuery('SpyRegion', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Country\Persistence\SpyCountryStore object
     *
     * @param \Orm\Zed\Country\Persistence\SpyCountryStore|ObjectCollection $spyCountryStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCountryStore($spyCountryStore, ?string $comparison = null)
    {
        if ($spyCountryStore instanceof \Orm\Zed\Country\Persistence\SpyCountryStore) {
            $this
                ->addUsingAlias(SpyCountryTableMap::COL_ID_COUNTRY, $spyCountryStore->getFkCountry(), $comparison);

            return $this;
        } elseif ($spyCountryStore instanceof ObjectCollection) {
            $this
                ->useCountryStoreQuery()
                ->filterByPrimaryKeys($spyCountryStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByCountryStore() only accepts arguments of type \Orm\Zed\Country\Persistence\SpyCountryStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CountryStore relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCountryStore(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CountryStore');

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
            $this->addJoinObject($join, 'CountryStore');
        }

        return $this;
    }

    /**
     * Use the CountryStore relation SpyCountryStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Country\Persistence\SpyCountryStoreQuery A secondary query class using the current class as primary query
     */
    public function useCountryStoreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCountryStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CountryStore', '\Orm\Zed\Country\Persistence\SpyCountryStoreQuery');
    }

    /**
     * Use the CountryStore relation SpyCountryStore object
     *
     * @param callable(\Orm\Zed\Country\Persistence\SpyCountryStoreQuery):\Orm\Zed\Country\Persistence\SpyCountryStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCountryStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCountryStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the CountryStore relation to the SpyCountryStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Country\Persistence\SpyCountryStoreQuery The inner query object of the EXISTS statement
     */
    public function useCountryStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Country\Persistence\SpyCountryStoreQuery */
        $q = $this->useExistsQuery('CountryStore', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the CountryStore relation to the SpyCountryStore table for a NOT EXISTS query.
     *
     * @see useCountryStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Country\Persistence\SpyCountryStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useCountryStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Country\Persistence\SpyCountryStoreQuery */
        $q = $this->useExistsQuery('CountryStore', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the CountryStore relation to the SpyCountryStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Country\Persistence\SpyCountryStoreQuery The inner query object of the IN statement
     */
    public function useInCountryStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Country\Persistence\SpyCountryStoreQuery */
        $q = $this->useInQuery('CountryStore', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the CountryStore relation to the SpyCountryStore table for a NOT IN query.
     *
     * @see useCountryStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Country\Persistence\SpyCountryStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInCountryStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Country\Persistence\SpyCountryStoreQuery */
        $q = $this->useInQuery('CountryStore', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Customer\Persistence\SpyCustomerAddress object
     *
     * @param \Orm\Zed\Customer\Persistence\SpyCustomerAddress|ObjectCollection $spyCustomerAddress the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCustomerAddress($spyCustomerAddress, ?string $comparison = null)
    {
        if ($spyCustomerAddress instanceof \Orm\Zed\Customer\Persistence\SpyCustomerAddress) {
            $this
                ->addUsingAlias(SpyCountryTableMap::COL_ID_COUNTRY, $spyCustomerAddress->getFkCountry(), $comparison);

            return $this;
        } elseif ($spyCustomerAddress instanceof ObjectCollection) {
            $this
                ->useCustomerAddressQuery()
                ->filterByPrimaryKeys($spyCustomerAddress->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByCustomerAddress() only accepts arguments of type \Orm\Zed\Customer\Persistence\SpyCustomerAddress or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CustomerAddress relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCustomerAddress(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CustomerAddress');

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
            $this->addJoinObject($join, 'CustomerAddress');
        }

        return $this;
    }

    /**
     * Use the CustomerAddress relation SpyCustomerAddress object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerAddressQuery A secondary query class using the current class as primary query
     */
    public function useCustomerAddressQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCustomerAddress($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CustomerAddress', '\Orm\Zed\Customer\Persistence\SpyCustomerAddressQuery');
    }

    /**
     * Use the CustomerAddress relation SpyCustomerAddress object
     *
     * @param callable(\Orm\Zed\Customer\Persistence\SpyCustomerAddressQuery):\Orm\Zed\Customer\Persistence\SpyCustomerAddressQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCustomerAddressQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCustomerAddressQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the CustomerAddress relation to the SpyCustomerAddress table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerAddressQuery The inner query object of the EXISTS statement
     */
    public function useCustomerAddressExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Customer\Persistence\SpyCustomerAddressQuery */
        $q = $this->useExistsQuery('CustomerAddress', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the CustomerAddress relation to the SpyCustomerAddress table for a NOT EXISTS query.
     *
     * @see useCustomerAddressExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerAddressQuery The inner query object of the NOT EXISTS statement
     */
    public function useCustomerAddressNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Customer\Persistence\SpyCustomerAddressQuery */
        $q = $this->useExistsQuery('CustomerAddress', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the CustomerAddress relation to the SpyCustomerAddress table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerAddressQuery The inner query object of the IN statement
     */
    public function useInCustomerAddressQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Customer\Persistence\SpyCustomerAddressQuery */
        $q = $this->useInQuery('CustomerAddress', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the CustomerAddress relation to the SpyCustomerAddress table for a NOT IN query.
     *
     * @see useCustomerAddressInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerAddressQuery The inner query object of the NOT IN statement
     */
    public function useNotInCustomerAddressQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Customer\Persistence\SpyCustomerAddressQuery */
        $q = $this->useInQuery('CustomerAddress', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddress object
     *
     * @param \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddress|ObjectCollection $spyMerchantProfileAddress the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyMerchantProfileAddress($spyMerchantProfileAddress, ?string $comparison = null)
    {
        if ($spyMerchantProfileAddress instanceof \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddress) {
            $this
                ->addUsingAlias(SpyCountryTableMap::COL_ID_COUNTRY, $spyMerchantProfileAddress->getFkCountry(), $comparison);

            return $this;
        } elseif ($spyMerchantProfileAddress instanceof ObjectCollection) {
            $this
                ->useSpyMerchantProfileAddressQuery()
                ->filterByPrimaryKeys($spyMerchantProfileAddress->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyMerchantProfileAddress() only accepts arguments of type \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddress or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyMerchantProfileAddress relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyMerchantProfileAddress(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyMerchantProfileAddress');

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
            $this->addJoinObject($join, 'SpyMerchantProfileAddress');
        }

        return $this;
    }

    /**
     * Use the SpyMerchantProfileAddress relation SpyMerchantProfileAddress object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddressQuery A secondary query class using the current class as primary query
     */
    public function useSpyMerchantProfileAddressQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpyMerchantProfileAddress($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyMerchantProfileAddress', '\Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddressQuery');
    }

    /**
     * Use the SpyMerchantProfileAddress relation SpyMerchantProfileAddress object
     *
     * @param callable(\Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddressQuery):\Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddressQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyMerchantProfileAddressQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpyMerchantProfileAddressQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyMerchantProfileAddress table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddressQuery The inner query object of the EXISTS statement
     */
    public function useSpyMerchantProfileAddressExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddressQuery */
        $q = $this->useExistsQuery('SpyMerchantProfileAddress', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantProfileAddress table for a NOT EXISTS query.
     *
     * @see useSpyMerchantProfileAddressExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddressQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyMerchantProfileAddressNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddressQuery */
        $q = $this->useExistsQuery('SpyMerchantProfileAddress', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyMerchantProfileAddress table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddressQuery The inner query object of the IN statement
     */
    public function useInSpyMerchantProfileAddressQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddressQuery */
        $q = $this->useInQuery('SpyMerchantProfileAddress', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantProfileAddress table for a NOT IN query.
     *
     * @see useSpyMerchantProfileAddressInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddressQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyMerchantProfileAddressQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddressQuery */
        $q = $this->useInQuery('SpyMerchantProfileAddress', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequest object
     *
     * @param \Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequest|ObjectCollection $spyMerchantRegistrationRequest the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyMerchantRegistrationRequest($spyMerchantRegistrationRequest, ?string $comparison = null)
    {
        if ($spyMerchantRegistrationRequest instanceof \Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequest) {
            $this
                ->addUsingAlias(SpyCountryTableMap::COL_ID_COUNTRY, $spyMerchantRegistrationRequest->getFkCountry(), $comparison);

            return $this;
        } elseif ($spyMerchantRegistrationRequest instanceof ObjectCollection) {
            $this
                ->useSpyMerchantRegistrationRequestQuery()
                ->filterByPrimaryKeys($spyMerchantRegistrationRequest->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyMerchantRegistrationRequest() only accepts arguments of type \Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequest or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyMerchantRegistrationRequest relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyMerchantRegistrationRequest(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyMerchantRegistrationRequest');

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
            $this->addJoinObject($join, 'SpyMerchantRegistrationRequest');
        }

        return $this;
    }

    /**
     * Use the SpyMerchantRegistrationRequest relation SpyMerchantRegistrationRequest object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequestQuery A secondary query class using the current class as primary query
     */
    public function useSpyMerchantRegistrationRequestQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyMerchantRegistrationRequest($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyMerchantRegistrationRequest', '\Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequestQuery');
    }

    /**
     * Use the SpyMerchantRegistrationRequest relation SpyMerchantRegistrationRequest object
     *
     * @param callable(\Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequestQuery):\Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequestQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyMerchantRegistrationRequestQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyMerchantRegistrationRequestQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyMerchantRegistrationRequest table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequestQuery The inner query object of the EXISTS statement
     */
    public function useSpyMerchantRegistrationRequestExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequestQuery */
        $q = $this->useExistsQuery('SpyMerchantRegistrationRequest', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantRegistrationRequest table for a NOT EXISTS query.
     *
     * @see useSpyMerchantRegistrationRequestExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequestQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyMerchantRegistrationRequestNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequestQuery */
        $q = $this->useExistsQuery('SpyMerchantRegistrationRequest', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyMerchantRegistrationRequest table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequestQuery The inner query object of the IN statement
     */
    public function useInSpyMerchantRegistrationRequestQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequestQuery */
        $q = $this->useInQuery('SpyMerchantRegistrationRequest', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantRegistrationRequest table for a NOT IN query.
     *
     * @see useSpyMerchantRegistrationRequestInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequestQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyMerchantRegistrationRequestQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequestQuery */
        $q = $this->useInQuery('SpyMerchantRegistrationRequest', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Sales\Persistence\SpySalesOrderAddress object
     *
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderAddress|ObjectCollection $spySalesOrderAddress the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySalesOrderAddress($spySalesOrderAddress, ?string $comparison = null)
    {
        if ($spySalesOrderAddress instanceof \Orm\Zed\Sales\Persistence\SpySalesOrderAddress) {
            $this
                ->addUsingAlias(SpyCountryTableMap::COL_ID_COUNTRY, $spySalesOrderAddress->getFkCountry(), $comparison);

            return $this;
        } elseif ($spySalesOrderAddress instanceof ObjectCollection) {
            $this
                ->useSalesOrderAddressQuery()
                ->filterByPrimaryKeys($spySalesOrderAddress->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySalesOrderAddress() only accepts arguments of type \Orm\Zed\Sales\Persistence\SpySalesOrderAddress or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SalesOrderAddress relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSalesOrderAddress(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SalesOrderAddress');

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
            $this->addJoinObject($join, 'SalesOrderAddress');
        }

        return $this;
    }

    /**
     * Use the SalesOrderAddress relation SpySalesOrderAddress object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery A secondary query class using the current class as primary query
     */
    public function useSalesOrderAddressQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSalesOrderAddress($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SalesOrderAddress', '\Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery');
    }

    /**
     * Use the SalesOrderAddress relation SpySalesOrderAddress object
     *
     * @param callable(\Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery):\Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSalesOrderAddressQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSalesOrderAddressQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the SalesOrderAddress relation to the SpySalesOrderAddress table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery The inner query object of the EXISTS statement
     */
    public function useSalesOrderAddressExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery */
        $q = $this->useExistsQuery('SalesOrderAddress', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the SalesOrderAddress relation to the SpySalesOrderAddress table for a NOT EXISTS query.
     *
     * @see useSalesOrderAddressExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery The inner query object of the NOT EXISTS statement
     */
    public function useSalesOrderAddressNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery */
        $q = $this->useExistsQuery('SalesOrderAddress', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the SalesOrderAddress relation to the SpySalesOrderAddress table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery The inner query object of the IN statement
     */
    public function useInSalesOrderAddressQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery */
        $q = $this->useInQuery('SalesOrderAddress', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the SalesOrderAddress relation to the SpySalesOrderAddress table for a NOT IN query.
     *
     * @see useSalesOrderAddressInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery The inner query object of the NOT IN statement
     */
    public function useNotInSalesOrderAddressQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery */
        $q = $this->useInQuery('SalesOrderAddress', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Sales\Persistence\SpySalesOrderAddressHistory object
     *
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderAddressHistory|ObjectCollection $spySalesOrderAddressHistory the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySalesOrderAddressHistory($spySalesOrderAddressHistory, ?string $comparison = null)
    {
        if ($spySalesOrderAddressHistory instanceof \Orm\Zed\Sales\Persistence\SpySalesOrderAddressHistory) {
            $this
                ->addUsingAlias(SpyCountryTableMap::COL_ID_COUNTRY, $spySalesOrderAddressHistory->getFkCountry(), $comparison);

            return $this;
        } elseif ($spySalesOrderAddressHistory instanceof ObjectCollection) {
            $this
                ->useSalesOrderAddressHistoryQuery()
                ->filterByPrimaryKeys($spySalesOrderAddressHistory->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySalesOrderAddressHistory() only accepts arguments of type \Orm\Zed\Sales\Persistence\SpySalesOrderAddressHistory or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SalesOrderAddressHistory relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSalesOrderAddressHistory(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SalesOrderAddressHistory');

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
            $this->addJoinObject($join, 'SalesOrderAddressHistory');
        }

        return $this;
    }

    /**
     * Use the SalesOrderAddressHistory relation SpySalesOrderAddressHistory object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderAddressHistoryQuery A secondary query class using the current class as primary query
     */
    public function useSalesOrderAddressHistoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSalesOrderAddressHistory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SalesOrderAddressHistory', '\Orm\Zed\Sales\Persistence\SpySalesOrderAddressHistoryQuery');
    }

    /**
     * Use the SalesOrderAddressHistory relation SpySalesOrderAddressHistory object
     *
     * @param callable(\Orm\Zed\Sales\Persistence\SpySalesOrderAddressHistoryQuery):\Orm\Zed\Sales\Persistence\SpySalesOrderAddressHistoryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSalesOrderAddressHistoryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSalesOrderAddressHistoryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the SalesOrderAddressHistory relation to the SpySalesOrderAddressHistory table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderAddressHistoryQuery The inner query object of the EXISTS statement
     */
    public function useSalesOrderAddressHistoryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderAddressHistoryQuery */
        $q = $this->useExistsQuery('SalesOrderAddressHistory', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the SalesOrderAddressHistory relation to the SpySalesOrderAddressHistory table for a NOT EXISTS query.
     *
     * @see useSalesOrderAddressHistoryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderAddressHistoryQuery The inner query object of the NOT EXISTS statement
     */
    public function useSalesOrderAddressHistoryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderAddressHistoryQuery */
        $q = $this->useExistsQuery('SalesOrderAddressHistory', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the SalesOrderAddressHistory relation to the SpySalesOrderAddressHistory table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderAddressHistoryQuery The inner query object of the IN statement
     */
    public function useInSalesOrderAddressHistoryQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderAddressHistoryQuery */
        $q = $this->useInQuery('SalesOrderAddressHistory', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the SalesOrderAddressHistory relation to the SpySalesOrderAddressHistory table for a NOT IN query.
     *
     * @see useSalesOrderAddressHistoryInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderAddressHistoryQuery The inner query object of the NOT IN statement
     */
    public function useNotInSalesOrderAddressHistoryQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderAddressHistoryQuery */
        $q = $this->useInQuery('SalesOrderAddressHistory', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ServicePoint\Persistence\SpyServicePointAddress object
     *
     * @param \Orm\Zed\ServicePoint\Persistence\SpyServicePointAddress|ObjectCollection $spyServicePointAddress the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByServicePointAddress($spyServicePointAddress, ?string $comparison = null)
    {
        if ($spyServicePointAddress instanceof \Orm\Zed\ServicePoint\Persistence\SpyServicePointAddress) {
            $this
                ->addUsingAlias(SpyCountryTableMap::COL_ID_COUNTRY, $spyServicePointAddress->getFkCountry(), $comparison);

            return $this;
        } elseif ($spyServicePointAddress instanceof ObjectCollection) {
            $this
                ->useServicePointAddressQuery()
                ->filterByPrimaryKeys($spyServicePointAddress->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByServicePointAddress() only accepts arguments of type \Orm\Zed\ServicePoint\Persistence\SpyServicePointAddress or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ServicePointAddress relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinServicePointAddress(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ServicePointAddress');

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
            $this->addJoinObject($join, 'ServicePointAddress');
        }

        return $this;
    }

    /**
     * Use the ServicePointAddress relation SpyServicePointAddress object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ServicePoint\Persistence\SpyServicePointAddressQuery A secondary query class using the current class as primary query
     */
    public function useServicePointAddressQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinServicePointAddress($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ServicePointAddress', '\Orm\Zed\ServicePoint\Persistence\SpyServicePointAddressQuery');
    }

    /**
     * Use the ServicePointAddress relation SpyServicePointAddress object
     *
     * @param callable(\Orm\Zed\ServicePoint\Persistence\SpyServicePointAddressQuery):\Orm\Zed\ServicePoint\Persistence\SpyServicePointAddressQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withServicePointAddressQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useServicePointAddressQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ServicePointAddress relation to the SpyServicePointAddress table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ServicePoint\Persistence\SpyServicePointAddressQuery The inner query object of the EXISTS statement
     */
    public function useServicePointAddressExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ServicePoint\Persistence\SpyServicePointAddressQuery */
        $q = $this->useExistsQuery('ServicePointAddress', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ServicePointAddress relation to the SpyServicePointAddress table for a NOT EXISTS query.
     *
     * @see useServicePointAddressExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ServicePoint\Persistence\SpyServicePointAddressQuery The inner query object of the NOT EXISTS statement
     */
    public function useServicePointAddressNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ServicePoint\Persistence\SpyServicePointAddressQuery */
        $q = $this->useExistsQuery('ServicePointAddress', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ServicePointAddress relation to the SpyServicePointAddress table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ServicePoint\Persistence\SpyServicePointAddressQuery The inner query object of the IN statement
     */
    public function useInServicePointAddressQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ServicePoint\Persistence\SpyServicePointAddressQuery */
        $q = $this->useInQuery('ServicePointAddress', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ServicePointAddress relation to the SpyServicePointAddress table for a NOT IN query.
     *
     * @see useServicePointAddressInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ServicePoint\Persistence\SpyServicePointAddressQuery The inner query object of the NOT IN statement
     */
    public function useNotInServicePointAddressQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ServicePoint\Persistence\SpyServicePointAddressQuery */
        $q = $this->useInQuery('ServicePointAddress', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\StockAddress\Persistence\SpyStockAddress object
     *
     * @param \Orm\Zed\StockAddress\Persistence\SpyStockAddress|ObjectCollection $spyStockAddress the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStockAddress($spyStockAddress, ?string $comparison = null)
    {
        if ($spyStockAddress instanceof \Orm\Zed\StockAddress\Persistence\SpyStockAddress) {
            $this
                ->addUsingAlias(SpyCountryTableMap::COL_ID_COUNTRY, $spyStockAddress->getFkCountry(), $comparison);

            return $this;
        } elseif ($spyStockAddress instanceof ObjectCollection) {
            $this
                ->useStockAddressQuery()
                ->filterByPrimaryKeys($spyStockAddress->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByStockAddress() only accepts arguments of type \Orm\Zed\StockAddress\Persistence\SpyStockAddress or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the StockAddress relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinStockAddress(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('StockAddress');

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
            $this->addJoinObject($join, 'StockAddress');
        }

        return $this;
    }

    /**
     * Use the StockAddress relation SpyStockAddress object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\StockAddress\Persistence\SpyStockAddressQuery A secondary query class using the current class as primary query
     */
    public function useStockAddressQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStockAddress($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'StockAddress', '\Orm\Zed\StockAddress\Persistence\SpyStockAddressQuery');
    }

    /**
     * Use the StockAddress relation SpyStockAddress object
     *
     * @param callable(\Orm\Zed\StockAddress\Persistence\SpyStockAddressQuery):\Orm\Zed\StockAddress\Persistence\SpyStockAddressQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withStockAddressQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useStockAddressQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the StockAddress relation to the SpyStockAddress table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\StockAddress\Persistence\SpyStockAddressQuery The inner query object of the EXISTS statement
     */
    public function useStockAddressExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\StockAddress\Persistence\SpyStockAddressQuery */
        $q = $this->useExistsQuery('StockAddress', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the StockAddress relation to the SpyStockAddress table for a NOT EXISTS query.
     *
     * @see useStockAddressExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\StockAddress\Persistence\SpyStockAddressQuery The inner query object of the NOT EXISTS statement
     */
    public function useStockAddressNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\StockAddress\Persistence\SpyStockAddressQuery */
        $q = $this->useExistsQuery('StockAddress', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the StockAddress relation to the SpyStockAddress table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\StockAddress\Persistence\SpyStockAddressQuery The inner query object of the IN statement
     */
    public function useInStockAddressQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\StockAddress\Persistence\SpyStockAddressQuery */
        $q = $this->useInQuery('StockAddress', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the StockAddress relation to the SpyStockAddress table for a NOT IN query.
     *
     * @see useStockAddressInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\StockAddress\Persistence\SpyStockAddressQuery The inner query object of the NOT IN statement
     */
    public function useNotInStockAddressQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\StockAddress\Persistence\SpyStockAddressQuery */
        $q = $this->useInQuery('StockAddress', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Tax\Persistence\SpyTaxRate object
     *
     * @param \Orm\Zed\Tax\Persistence\SpyTaxRate|ObjectCollection $spyTaxRate the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyTaxRate($spyTaxRate, ?string $comparison = null)
    {
        if ($spyTaxRate instanceof \Orm\Zed\Tax\Persistence\SpyTaxRate) {
            $this
                ->addUsingAlias(SpyCountryTableMap::COL_ID_COUNTRY, $spyTaxRate->getFkCountry(), $comparison);

            return $this;
        } elseif ($spyTaxRate instanceof ObjectCollection) {
            $this
                ->useSpyTaxRateQuery()
                ->filterByPrimaryKeys($spyTaxRate->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyTaxRate() only accepts arguments of type \Orm\Zed\Tax\Persistence\SpyTaxRate or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyTaxRate relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyTaxRate(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyTaxRate');

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
            $this->addJoinObject($join, 'SpyTaxRate');
        }

        return $this;
    }

    /**
     * Use the SpyTaxRate relation SpyTaxRate object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Tax\Persistence\SpyTaxRateQuery A secondary query class using the current class as primary query
     */
    public function useSpyTaxRateQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpyTaxRate($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyTaxRate', '\Orm\Zed\Tax\Persistence\SpyTaxRateQuery');
    }

    /**
     * Use the SpyTaxRate relation SpyTaxRate object
     *
     * @param callable(\Orm\Zed\Tax\Persistence\SpyTaxRateQuery):\Orm\Zed\Tax\Persistence\SpyTaxRateQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyTaxRateQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpyTaxRateQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyTaxRate table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Tax\Persistence\SpyTaxRateQuery The inner query object of the EXISTS statement
     */
    public function useSpyTaxRateExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Tax\Persistence\SpyTaxRateQuery */
        $q = $this->useExistsQuery('SpyTaxRate', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyTaxRate table for a NOT EXISTS query.
     *
     * @see useSpyTaxRateExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Tax\Persistence\SpyTaxRateQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyTaxRateNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Tax\Persistence\SpyTaxRateQuery */
        $q = $this->useExistsQuery('SpyTaxRate', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyTaxRate table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Tax\Persistence\SpyTaxRateQuery The inner query object of the IN statement
     */
    public function useInSpyTaxRateQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Tax\Persistence\SpyTaxRateQuery */
        $q = $this->useInQuery('SpyTaxRate', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyTaxRate table for a NOT IN query.
     *
     * @see useSpyTaxRateInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Tax\Persistence\SpyTaxRateQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyTaxRateQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Tax\Persistence\SpyTaxRateQuery */
        $q = $this->useInQuery('SpyTaxRate', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyCountry $spyCountry Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyCountry = null)
    {
        if ($spyCountry) {
            $this->addUsingAlias(SpyCountryTableMap::COL_ID_COUNTRY, $spyCountry->getIdCountry(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_country table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCountryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyCountryTableMap::clearInstancePool();
            SpyCountryTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCountryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyCountryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyCountryTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyCountryTableMap::clearRelatedInstancePool();

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
