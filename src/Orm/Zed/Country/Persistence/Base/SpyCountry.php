<?php

namespace Orm\Zed\Country\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery;
use Orm\Zed\CompanyUnitAddress\Persistence\Base\SpyCompanyUnitAddress as BaseSpyCompanyUnitAddress;
use Orm\Zed\CompanyUnitAddress\Persistence\Map\SpyCompanyUnitAddressTableMap;
use Orm\Zed\Country\Persistence\SpyCountry as ChildSpyCountry;
use Orm\Zed\Country\Persistence\SpyCountryQuery as ChildSpyCountryQuery;
use Orm\Zed\Country\Persistence\SpyCountryStore as ChildSpyCountryStore;
use Orm\Zed\Country\Persistence\SpyCountryStoreQuery as ChildSpyCountryStoreQuery;
use Orm\Zed\Country\Persistence\SpyRegion as ChildSpyRegion;
use Orm\Zed\Country\Persistence\SpyRegionQuery as ChildSpyRegionQuery;
use Orm\Zed\Country\Persistence\Map\SpyCountryStoreTableMap;
use Orm\Zed\Country\Persistence\Map\SpyCountryTableMap;
use Orm\Zed\Country\Persistence\Map\SpyRegionTableMap;
use Orm\Zed\Customer\Persistence\SpyCustomerAddress;
use Orm\Zed\Customer\Persistence\SpyCustomerAddressQuery;
use Orm\Zed\Customer\Persistence\Base\SpyCustomerAddress as BaseSpyCustomerAddress;
use Orm\Zed\Customer\Persistence\Map\SpyCustomerAddressTableMap;
use Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddress;
use Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddressQuery;
use Orm\Zed\MerchantProfile\Persistence\Base\SpyMerchantProfileAddress as BaseSpyMerchantProfileAddress;
use Orm\Zed\MerchantProfile\Persistence\Map\SpyMerchantProfileAddressTableMap;
use Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequest;
use Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequestQuery;
use Orm\Zed\MerchantRegistrationRequest\Persistence\Base\SpyMerchantRegistrationRequest as BaseSpyMerchantRegistrationRequest;
use Orm\Zed\MerchantRegistrationRequest\Persistence\Map\SpyMerchantRegistrationRequestTableMap;
use Orm\Zed\Sales\Persistence\SpySalesOrderAddress;
use Orm\Zed\Sales\Persistence\SpySalesOrderAddressHistory;
use Orm\Zed\Sales\Persistence\SpySalesOrderAddressHistoryQuery;
use Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery;
use Orm\Zed\Sales\Persistence\Base\SpySalesOrderAddress as BaseSpySalesOrderAddress;
use Orm\Zed\Sales\Persistence\Base\SpySalesOrderAddressHistory as BaseSpySalesOrderAddressHistory;
use Orm\Zed\Sales\Persistence\Map\SpySalesOrderAddressHistoryTableMap;
use Orm\Zed\Sales\Persistence\Map\SpySalesOrderAddressTableMap;
use Orm\Zed\ServicePoint\Persistence\SpyServicePointAddress;
use Orm\Zed\ServicePoint\Persistence\SpyServicePointAddressQuery;
use Orm\Zed\ServicePoint\Persistence\Base\SpyServicePointAddress as BaseSpyServicePointAddress;
use Orm\Zed\ServicePoint\Persistence\Map\SpyServicePointAddressTableMap;
use Orm\Zed\StockAddress\Persistence\SpyStockAddress;
use Orm\Zed\StockAddress\Persistence\SpyStockAddressQuery;
use Orm\Zed\StockAddress\Persistence\Base\SpyStockAddress as BaseSpyStockAddress;
use Orm\Zed\StockAddress\Persistence\Map\SpyStockAddressTableMap;
use Orm\Zed\Tax\Persistence\SpyTaxRate;
use Orm\Zed\Tax\Persistence\SpyTaxRateQuery;
use Orm\Zed\Tax\Persistence\Base\SpyTaxRate as BaseSpyTaxRate;
use Orm\Zed\Tax\Persistence\Map\SpyTaxRateTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Spryker\Zed\PropelReplicationCache\Business\PropelReplicationCacheFacade;

/**
 * Base class that represents a row from the 'spy_country' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.Country.Persistence.Base
 */
abstract class SpyCountry implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\Country\\Persistence\\Map\\SpyCountryTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var bool
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var bool
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = [];

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = [];

    /**
     * The value for the id_country field.
     *
     * @var        int
     */
    protected $id_country;

    /**
     * The value for the iso2_code field.
     * The two-letter ISO code for a country.
     * @var        string
     */
    protected $iso2_code;

    /**
     * The value for the iso3_code field.
     * The three-letter ISO code for a country.
     * @var        string|null
     */
    protected $iso3_code;

    /**
     * The value for the name field.
     * The name of an entity (e.g., user, category, product, role).
     * @var        string|null
     */
    protected $name;

    /**
     * The value for the postal_code_mandatory field.
     * A flag indicating if a postal code is mandatory.
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $postal_code_mandatory;

    /**
     * The value for the postal_code_regex field.
     * A regular expression for validating postal codes.
     * @var        string|null
     */
    protected $postal_code_regex;

    /**
     * @var        ObjectCollection|SpyCompanyUnitAddress[] Collection to store aggregation of SpyCompanyUnitAddress objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyUnitAddress> Collection to store aggregation of SpyCompanyUnitAddress objects.
     */
    protected $collCompanyUnitAddresses;
    protected $collCompanyUnitAddressesPartial;

    /**
     * @var        ObjectCollection|ChildSpyRegion[] Collection to store aggregation of ChildSpyRegion objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyRegion> Collection to store aggregation of ChildSpyRegion objects.
     */
    protected $collSpyRegions;
    protected $collSpyRegionsPartial;

    /**
     * @var        ObjectCollection|ChildSpyCountryStore[] Collection to store aggregation of ChildSpyCountryStore objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCountryStore> Collection to store aggregation of ChildSpyCountryStore objects.
     */
    protected $collCountryStores;
    protected $collCountryStoresPartial;

    /**
     * @var        ObjectCollection|SpyCustomerAddress[] Collection to store aggregation of SpyCustomerAddress objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCustomerAddress> Collection to store aggregation of SpyCustomerAddress objects.
     */
    protected $collCustomerAddresses;
    protected $collCustomerAddressesPartial;

    /**
     * @var        ObjectCollection|SpyMerchantProfileAddress[] Collection to store aggregation of SpyMerchantProfileAddress objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantProfileAddress> Collection to store aggregation of SpyMerchantProfileAddress objects.
     */
    protected $collSpyMerchantProfileAddresses;
    protected $collSpyMerchantProfileAddressesPartial;

    /**
     * @var        ObjectCollection|SpyMerchantRegistrationRequest[] Collection to store aggregation of SpyMerchantRegistrationRequest objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantRegistrationRequest> Collection to store aggregation of SpyMerchantRegistrationRequest objects.
     */
    protected $collSpyMerchantRegistrationRequests;
    protected $collSpyMerchantRegistrationRequestsPartial;

    /**
     * @var        ObjectCollection|SpySalesOrderAddress[] Collection to store aggregation of SpySalesOrderAddress objects.
     * @phpstan-var ObjectCollection&\Traversable<SpySalesOrderAddress> Collection to store aggregation of SpySalesOrderAddress objects.
     */
    protected $collSalesOrderAddresses;
    protected $collSalesOrderAddressesPartial;

    /**
     * @var        ObjectCollection|SpySalesOrderAddressHistory[] Collection to store aggregation of SpySalesOrderAddressHistory objects.
     * @phpstan-var ObjectCollection&\Traversable<SpySalesOrderAddressHistory> Collection to store aggregation of SpySalesOrderAddressHistory objects.
     */
    protected $collSalesOrderAddressHistories;
    protected $collSalesOrderAddressHistoriesPartial;

    /**
     * @var        ObjectCollection|SpyServicePointAddress[] Collection to store aggregation of SpyServicePointAddress objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyServicePointAddress> Collection to store aggregation of SpyServicePointAddress objects.
     */
    protected $collServicePointAddresses;
    protected $collServicePointAddressesPartial;

    /**
     * @var        ObjectCollection|SpyStockAddress[] Collection to store aggregation of SpyStockAddress objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyStockAddress> Collection to store aggregation of SpyStockAddress objects.
     */
    protected $collStockAddresses;
    protected $collStockAddressesPartial;

    /**
     * @var        ObjectCollection|SpyTaxRate[] Collection to store aggregation of SpyTaxRate objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyTaxRate> Collection to store aggregation of SpyTaxRate objects.
     */
    protected $collSpyTaxRates;
    protected $collSpyTaxRatesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCompanyUnitAddress[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyUnitAddress>
     */
    protected $companyUnitAddressesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyRegion[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyRegion>
     */
    protected $spyRegionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyCountryStore[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCountryStore>
     */
    protected $countryStoresScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCustomerAddress[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCustomerAddress>
     */
    protected $customerAddressesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyMerchantProfileAddress[]
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantProfileAddress>
     */
    protected $spyMerchantProfileAddressesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyMerchantRegistrationRequest[]
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantRegistrationRequest>
     */
    protected $spyMerchantRegistrationRequestsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpySalesOrderAddress[]
     * @phpstan-var ObjectCollection&\Traversable<SpySalesOrderAddress>
     */
    protected $salesOrderAddressesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpySalesOrderAddressHistory[]
     * @phpstan-var ObjectCollection&\Traversable<SpySalesOrderAddressHistory>
     */
    protected $salesOrderAddressHistoriesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyServicePointAddress[]
     * @phpstan-var ObjectCollection&\Traversable<SpyServicePointAddress>
     */
    protected $servicePointAddressesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyStockAddress[]
     * @phpstan-var ObjectCollection&\Traversable<SpyStockAddress>
     */
    protected $stockAddressesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyTaxRate[]
     * @phpstan-var ObjectCollection&\Traversable<SpyTaxRate>
     */
    protected $spyTaxRatesScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->postal_code_mandatory = false;
    }

    /**
     * Initializes internal state of Orm\Zed\Country\Persistence\Base\SpyCountry object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return bool True if the object has been modified.
     */
    public function isModified(): bool
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param string $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return bool True if $col has been modified.
     */
    public function isColumnModified(string $col): bool
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns(): array
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return bool True, if the object has never been persisted.
     */
    public function isNew(): bool
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param bool $b the state of the object.
     */
    public function setNew(bool $b): void
    {
        $this->new = $b;
    }

    /**
     * Whether this object has been deleted.
     * @return bool The deleted state of this object.
     */
    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param bool $b The deleted state of this object.
     * @return void
     */
    public function setDeleted(bool $b): void
    {
        $this->deleted = $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified(?string $col = null): void
    {
        if (null !== $col) {
            unset($this->modifiedColumns[$col]);
        } else {
            $this->modifiedColumns = [];
        }
    }

    /**
     * Compares this with another <code>SpyCountry</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyCountry</code>, delegates to
     * <code>equals(SpyCountry)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param mixed $obj The object to compare to.
     * @return bool Whether equal to the object specified.
     */
    public function equals($obj): bool
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns(): array
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @return bool
     */
    public function hasVirtualColumn(string $name): bool
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @return mixed
     *
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getVirtualColumn(string $name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of nonexistent virtual column `%s`.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @param mixed $value The value to give to the virtual column
     *
     * @return $this The current object, for fluid interface
     */
    public function setVirtualColumn(string $name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param string $msg
     * @param int $priority One of the Propel::LOG_* logging levels
     * @return void
     */
    protected function log(string $msg, int $priority = Propel::LOG_INFO): void
    {
        Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param \Propel\Runtime\Parser\AbstractParser|string $parser An AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param bool $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @param string $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME, TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM. Defaults to TableMap::TYPE_PHPNAME.
     * @return string The exported data
     */
    public function exportTo($parser, bool $includeLazyLoadColumns = true, string $keyType = TableMap::TYPE_PHPNAME): string
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray($keyType, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     *
     * @return array<string>
     */
    public function __sleep(): array
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [id_country] column value.
     *
     * @return int
     */
    public function getIdCountry()
    {
        return $this->id_country;
    }

    /**
     * Get the [iso2_code] column value.
     * The two-letter ISO code for a country.
     * @return string
     */
    public function getIso2Code()
    {
        return $this->iso2_code;
    }

    /**
     * Get the [iso3_code] column value.
     * The three-letter ISO code for a country.
     * @return string|null
     */
    public function getIso3Code()
    {
        return $this->iso3_code;
    }

    /**
     * Get the [name] column value.
     * The name of an entity (e.g., user, category, product, role).
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [postal_code_mandatory] column value.
     * A flag indicating if a postal code is mandatory.
     * @return boolean|null
     */
    public function getPostalCodeMandatory()
    {
        return $this->postal_code_mandatory;
    }

    /**
     * Get the [postal_code_mandatory] column value.
     * A flag indicating if a postal code is mandatory.
     * @return boolean|null
     */
    public function isPostalCodeMandatory()
    {
        return $this->getPostalCodeMandatory();
    }

    /**
     * Get the [postal_code_regex] column value.
     * A regular expression for validating postal codes.
     * @return string|null
     */
    public function getPostalCodeRegex()
    {
        return $this->postal_code_regex;
    }

    /**
     * Set the value of [id_country] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdCountry($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_country !== $v) {
            $this->id_country = $v;
            $this->modifiedColumns[SpyCountryTableMap::COL_ID_COUNTRY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [iso2_code] column.
     * The two-letter ISO code for a country.
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIso2Code($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->iso2_code !== $v) {
            $this->iso2_code = $v;
            $this->modifiedColumns[SpyCountryTableMap::COL_ISO2_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [iso3_code] column.
     * The three-letter ISO code for a country.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIso3Code($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->iso3_code !== $v) {
            $this->iso3_code = $v;
            $this->modifiedColumns[SpyCountryTableMap::COL_ISO3_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [name] column.
     * The name of an entity (e.g., user, category, product, role).
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[SpyCountryTableMap::COL_NAME] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [postal_code_mandatory] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * A flag indicating if a postal code is mandatory.
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setPostalCodeMandatory($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (bool) $v;
            }
        }

        $allowNullValues = false;

        if ($v === null && !$allowNullValues) {
            return $this;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = true;

        if (($this->isNew() && $hasDefaultValue) || $this->postal_code_mandatory !== $v) {
            $this->postal_code_mandatory = $v;
            $this->modifiedColumns[SpyCountryTableMap::COL_POSTAL_CODE_MANDATORY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [postal_code_regex] column.
     * A regular expression for validating postal codes.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPostalCodeRegex($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->postal_code_regex !== $v) {
            $this->postal_code_regex = $v;
            $this->modifiedColumns[SpyCountryTableMap::COL_POSTAL_CODE_REGEX] = true;
        }

        return $this;
    }

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return bool Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues(): bool
    {
            if ($this->postal_code_mandatory !== false) {
                return false;
            }

        // otherwise, everything was equal, so return TRUE
        return true;
    }

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by DataFetcher->fetch().
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param bool $rehydrate Whether this object is being re-hydrated from the database.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int next starting column
     * @throws \Propel\Runtime\Exception\PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate(array $row, int $startcol = 0, bool $rehydrate = false, string $indexType = TableMap::TYPE_NUM): int
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyCountryTableMap::translateFieldName('IdCountry', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_country = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyCountryTableMap::translateFieldName('Iso2Code', TableMap::TYPE_PHPNAME, $indexType)];
            $this->iso2_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyCountryTableMap::translateFieldName('Iso3Code', TableMap::TYPE_PHPNAME, $indexType)];
            $this->iso3_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyCountryTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyCountryTableMap::translateFieldName('PostalCodeMandatory', TableMap::TYPE_PHPNAME, $indexType)];
            $this->postal_code_mandatory = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyCountryTableMap::translateFieldName('PostalCodeRegex', TableMap::TYPE_PHPNAME, $indexType)];
            $this->postal_code_regex = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 6; // 6 = SpyCountryTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\Country\\Persistence\\SpyCountry'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function ensureConsistency(): void
    {
    }

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param bool $deep (optional) Whether to also de-associated any related objects.
     * @param ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload(bool $deep = false, ?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SpyCountryTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyCountryQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collCompanyUnitAddresses = null;

            $this->collSpyRegions = null;

            $this->collCountryStores = null;

            $this->collCustomerAddresses = null;

            $this->collSpyMerchantProfileAddresses = null;

            $this->collSpyMerchantRegistrationRequests = null;

            $this->collSalesOrderAddresses = null;

            $this->collSalesOrderAddressHistories = null;

            $this->collServicePointAddresses = null;

            $this->collStockAddresses = null;

            $this->collSpyTaxRates = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyCountry::setDeleted()
     * @see SpyCountry::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCountryTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyCountryQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param ConnectionInterface $con
     * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws \Propel\Runtime\Exception\PropelException
     * @see doSave()
     */
    public function save(?ConnectionInterface $con = null): int
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCountryTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // \Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior behavior
                // phpcs:ignoreFile
                /**
                 * @var string|null $action
                 */
                /** @var \Spryker\Zed\AclEntity\Business\AclEntityFacadeInterface $aclEntityFacade */
                $aclEntityFacade = \Spryker\Zed\Kernel\Locator::getInstance()->aclEntity()->facade();
                if ($aclEntityFacade->isActive()) {
                    $aclEntityMetadataConfigRequestTransfer = new \Generated\Shared\Transfer\AclEntityMetadataConfigRequestTransfer();
                    $aclEntityMetadataConfigRequestTransfer->setModelName(get_class($this));
                    $aclEntityMetadataConfigTransfer = $aclEntityFacade->getAclEntityMetadataConfig(true, $aclEntityMetadataConfigRequestTransfer);
                    if (!in_array(get_class($this), $aclEntityMetadataConfigTransfer->getAclEntityAllowList())) {
                        $this->getPersistenceFactory()
                            ->createAclModelDirector($aclEntityMetadataConfigTransfer)
                            ->inspectCreate($this);
                    }
                }

            } else {
                $ret = $ret && $this->preUpdate($con);
                // \Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior behavior
                // phpcs:ignoreFile
                /**
                 * @var string|null $action
                 */
                /** @var \Spryker\Zed\AclEntity\Business\AclEntityFacadeInterface $aclEntityFacade */
                $aclEntityFacade = \Spryker\Zed\Kernel\Locator::getInstance()->aclEntity()->facade();
                if ($aclEntityFacade->isActive()) {
                    $aclEntityMetadataConfigRequestTransfer = new \Generated\Shared\Transfer\AclEntityMetadataConfigRequestTransfer();
                    $aclEntityMetadataConfigRequestTransfer->setModelName(get_class($this));
                    $aclEntityMetadataConfigTransfer = $aclEntityFacade->getAclEntityMetadataConfig(true, $aclEntityMetadataConfigRequestTransfer);
                    if (!in_array(get_class($this), $aclEntityMetadataConfigTransfer->getAclEntityAllowList())) {
                        $this->getPersistenceFactory()
                            ->createAclModelDirector($aclEntityMetadataConfigTransfer)
                            ->inspectUpdate($this);
                    }
                }

            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                SpyCountryTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Code to be run after persisting the object
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con
     *
     * @return void
     */
    public function postSave(?ConnectionInterface $con = null): void
    {
        $class = get_class($this);
        PropelReplicationCacheFacade::getInstance()->setKey($class);

    }

    /**
     * Code to be run after updating the object in database
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con
     *
     * @return void
     */
    public function postUpdate(?ConnectionInterface $con = null): void
    {
        $class = get_class($this);
        PropelReplicationCacheFacade::getInstance()->setKey($class);

    }

    /**
     * Code to be run after deleting the object in database
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con
     *
     * @return void
     */
    public function postDelete(?ConnectionInterface $con = null): void
    {
        $class = get_class($this);
        PropelReplicationCacheFacade::getInstance()->setKey($class);

    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param ConnectionInterface $con
     * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws \Propel\Runtime\Exception\PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con): int
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->companyUnitAddressesScheduledForDeletion !== null) {
                if (!$this->companyUnitAddressesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery::create()
                        ->filterByPrimaryKeys($this->companyUnitAddressesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->companyUnitAddressesScheduledForDeletion = null;
                }
            }

            if ($this->collCompanyUnitAddresses !== null) {
                foreach ($this->collCompanyUnitAddresses as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyRegionsScheduledForDeletion !== null) {
                if (!$this->spyRegionsScheduledForDeletion->isEmpty()) {
                    foreach ($this->spyRegionsScheduledForDeletion as $spyRegion) {
                        // need to save related object because we set the relation to null
                        $spyRegion->save($con);
                    }
                    $this->spyRegionsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyRegions !== null) {
                foreach ($this->collSpyRegions as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->countryStoresScheduledForDeletion !== null) {
                if (!$this->countryStoresScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Country\Persistence\SpyCountryStoreQuery::create()
                        ->filterByPrimaryKeys($this->countryStoresScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->countryStoresScheduledForDeletion = null;
                }
            }

            if ($this->collCountryStores !== null) {
                foreach ($this->collCountryStores as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->customerAddressesScheduledForDeletion !== null) {
                if (!$this->customerAddressesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Customer\Persistence\SpyCustomerAddressQuery::create()
                        ->filterByPrimaryKeys($this->customerAddressesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->customerAddressesScheduledForDeletion = null;
                }
            }

            if ($this->collCustomerAddresses !== null) {
                foreach ($this->collCustomerAddresses as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyMerchantProfileAddressesScheduledForDeletion !== null) {
                if (!$this->spyMerchantProfileAddressesScheduledForDeletion->isEmpty()) {
                    foreach ($this->spyMerchantProfileAddressesScheduledForDeletion as $spyMerchantProfileAddress) {
                        // need to save related object because we set the relation to null
                        $spyMerchantProfileAddress->save($con);
                    }
                    $this->spyMerchantProfileAddressesScheduledForDeletion = null;
                }
            }

            if ($this->collSpyMerchantProfileAddresses !== null) {
                foreach ($this->collSpyMerchantProfileAddresses as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyMerchantRegistrationRequestsScheduledForDeletion !== null) {
                if (!$this->spyMerchantRegistrationRequestsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequestQuery::create()
                        ->filterByPrimaryKeys($this->spyMerchantRegistrationRequestsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyMerchantRegistrationRequestsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyMerchantRegistrationRequests !== null) {
                foreach ($this->collSpyMerchantRegistrationRequests as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->salesOrderAddressesScheduledForDeletion !== null) {
                if (!$this->salesOrderAddressesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery::create()
                        ->filterByPrimaryKeys($this->salesOrderAddressesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->salesOrderAddressesScheduledForDeletion = null;
                }
            }

            if ($this->collSalesOrderAddresses !== null) {
                foreach ($this->collSalesOrderAddresses as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->salesOrderAddressHistoriesScheduledForDeletion !== null) {
                if (!$this->salesOrderAddressHistoriesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Sales\Persistence\SpySalesOrderAddressHistoryQuery::create()
                        ->filterByPrimaryKeys($this->salesOrderAddressHistoriesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->salesOrderAddressHistoriesScheduledForDeletion = null;
                }
            }

            if ($this->collSalesOrderAddressHistories !== null) {
                foreach ($this->collSalesOrderAddressHistories as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->servicePointAddressesScheduledForDeletion !== null) {
                if (!$this->servicePointAddressesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ServicePoint\Persistence\SpyServicePointAddressQuery::create()
                        ->filterByPrimaryKeys($this->servicePointAddressesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->servicePointAddressesScheduledForDeletion = null;
                }
            }

            if ($this->collServicePointAddresses !== null) {
                foreach ($this->collServicePointAddresses as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->stockAddressesScheduledForDeletion !== null) {
                if (!$this->stockAddressesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\StockAddress\Persistence\SpyStockAddressQuery::create()
                        ->filterByPrimaryKeys($this->stockAddressesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->stockAddressesScheduledForDeletion = null;
                }
            }

            if ($this->collStockAddresses !== null) {
                foreach ($this->collStockAddresses as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyTaxRatesScheduledForDeletion !== null) {
                if (!$this->spyTaxRatesScheduledForDeletion->isEmpty()) {
                    foreach ($this->spyTaxRatesScheduledForDeletion as $spyTaxRate) {
                        // need to save related object because we set the relation to null
                        $spyTaxRate->save($con);
                    }
                    $this->spyTaxRatesScheduledForDeletion = null;
                }
            }

            if ($this->collSpyTaxRates !== null) {
                foreach ($this->collSpyTaxRates as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    }

    /**
     * Insert the row in the database.
     *
     * @param ConnectionInterface $con
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con): void
    {
        $modifiedColumns = [];
        $index = 0;

        $this->modifiedColumns[SpyCountryTableMap::COL_ID_COUNTRY] = true;
        if (null !== $this->id_country) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyCountryTableMap::COL_ID_COUNTRY . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyCountryTableMap::COL_ID_COUNTRY)) {
            $modifiedColumns[':p' . $index++]  = 'id_country';
        }
        if ($this->isColumnModified(SpyCountryTableMap::COL_ISO2_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'iso2_code';
        }
        if ($this->isColumnModified(SpyCountryTableMap::COL_ISO3_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'iso3_code';
        }
        if ($this->isColumnModified(SpyCountryTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(SpyCountryTableMap::COL_POSTAL_CODE_MANDATORY)) {
            $modifiedColumns[':p' . $index++]  = 'postal_code_mandatory';
        }
        if ($this->isColumnModified(SpyCountryTableMap::COL_POSTAL_CODE_REGEX)) {
            $modifiedColumns[':p' . $index++]  = 'postal_code_regex';
        }

        $sql = sprintf(
            'INSERT INTO spy_country (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_country':
                        $stmt->bindValue($identifier, $this->id_country, PDO::PARAM_INT);

                        break;
                    case 'iso2_code':
                        $stmt->bindValue($identifier, $this->iso2_code, PDO::PARAM_STR);

                        break;
                    case 'iso3_code':
                        $stmt->bindValue($identifier, $this->iso3_code, PDO::PARAM_STR);

                        break;
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);

                        break;
                    case 'postal_code_mandatory':
                        $stmt->bindValue($identifier, (int) $this->postal_code_mandatory, PDO::PARAM_INT);

                        break;
                    case 'postal_code_regex':
                        $stmt->bindValue($identifier, $this->postal_code_regex, PDO::PARAM_STR);

                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId('spy_country_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdCountry($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param ConnectionInterface $con
     *
     * @return int Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con): int
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_FIELDNAME.
     * @return mixed Value of field.
     */
    public function getByName(string $name, string $type = TableMap::TYPE_FIELDNAME)
    {
        $pos = SpyCountryTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos Position in XML schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition(int $pos)
    {
        switch ($pos) {
            case 0:
                return $this->getIdCountry();

            case 1:
                return $this->getIso2Code();

            case 2:
                return $this->getIso3Code();

            case 3:
                return $this->getName();

            case 4:
                return $this->getPostalCodeMandatory();

            case 5:
                return $this->getPostalCodeRegex();

            default:
                return null;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param string $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_FIELDNAME.
     * @param bool $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param bool $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array An associative array containing the field names (as keys) and field values
     */
    public function toArray(string $keyType = TableMap::TYPE_FIELDNAME, bool $includeLazyLoadColumns = true, array $alreadyDumpedObjects = [], bool $includeForeignObjects = false): array
    {
        if (isset($alreadyDumpedObjects['SpyCountry'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyCountry'][$this->hashCode()] = true;
        $keys = SpyCountryTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdCountry(),
            $keys[1] => $this->getIso2Code(),
            $keys[2] => $this->getIso3Code(),
            $keys[3] => $this->getName(),
            $keys[4] => $this->getPostalCodeMandatory(),
            $keys[5] => $this->getPostalCodeRegex(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collCompanyUnitAddresses) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCompanyUnitAddresses';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_company_unit_addresses';
                        break;
                    default:
                        $key = 'CompanyUnitAddresses';
                }

                $result[$key] = $this->collCompanyUnitAddresses->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyRegions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyRegions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_regions';
                        break;
                    default:
                        $key = 'SpyRegions';
                }

                $result[$key] = $this->collSpyRegions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCountryStores) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCountryStores';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_country_stores';
                        break;
                    default:
                        $key = 'CountryStores';
                }

                $result[$key] = $this->collCountryStores->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCustomerAddresses) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCustomerAddresses';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_customer_addresses';
                        break;
                    default:
                        $key = 'CustomerAddresses';
                }

                $result[$key] = $this->collCustomerAddresses->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyMerchantProfileAddresses) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchantProfileAddresses';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant_profile_addresses';
                        break;
                    default:
                        $key = 'SpyMerchantProfileAddresses';
                }

                $result[$key] = $this->collSpyMerchantProfileAddresses->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyMerchantRegistrationRequests) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchantRegistrationRequests';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant_registration_requests';
                        break;
                    default:
                        $key = 'SpyMerchantRegistrationRequests';
                }

                $result[$key] = $this->collSpyMerchantRegistrationRequests->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSalesOrderAddresses) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesOrderAddresses';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_order_addresses';
                        break;
                    default:
                        $key = 'SalesOrderAddresses';
                }

                $result[$key] = $this->collSalesOrderAddresses->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSalesOrderAddressHistories) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesOrderAddressHistories';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_order_address_histories';
                        break;
                    default:
                        $key = 'SalesOrderAddressHistories';
                }

                $result[$key] = $this->collSalesOrderAddressHistories->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collServicePointAddresses) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyServicePointAddresses';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_service_point_addresses';
                        break;
                    default:
                        $key = 'ServicePointAddresses';
                }

                $result[$key] = $this->collServicePointAddresses->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collStockAddresses) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyStockAddresses';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_stock_addresses';
                        break;
                    default:
                        $key = 'StockAddresses';
                }

                $result[$key] = $this->collStockAddresses->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyTaxRates) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyTaxRates';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_tax_rates';
                        break;
                    default:
                        $key = 'SpyTaxRates';
                }

                $result[$key] = $this->collSpyTaxRates->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_FIELDNAME.
     * @return $this
     */
    public function setByName(string $name, $value, string $type = TableMap::TYPE_FIELDNAME)
    {
        $pos = SpyCountryTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        $this->setByPosition($pos, $value);

        return $this;
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return $this
     */
    public function setByPosition(int $pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setIdCountry($value);
                break;
            case 1:
                $this->setIso2Code($value);
                break;
            case 2:
                $this->setIso3Code($value);
                break;
            case 3:
                $this->setName($value);
                break;
            case 4:
                $this->setPostalCodeMandatory($value);
                break;
            case 5:
                $this->setPostalCodeRegex($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_FIELDNAME.
     *
     * @param array $arr An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return $this
     */
    public function fromArray(array $arr, string $keyType = TableMap::TYPE_FIELDNAME)
    {
        $keys = SpyCountryTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdCountry($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setIso2Code($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setIso3Code($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setName($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setPostalCodeMandatory($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setPostalCodeRegex($arr[$keys[5]]);
        }

        return $this;
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_FIELDNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this The current object, for fluid interface
     */
    public function importFrom($parser, string $data, string $keyType = TableMap::TYPE_FIELDNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria(): Criteria
    {
        $criteria = new Criteria(SpyCountryTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyCountryTableMap::COL_ID_COUNTRY)) {
            $criteria->add(SpyCountryTableMap::COL_ID_COUNTRY, $this->id_country);
        }
        if ($this->isColumnModified(SpyCountryTableMap::COL_ISO2_CODE)) {
            $criteria->add(SpyCountryTableMap::COL_ISO2_CODE, $this->iso2_code);
        }
        if ($this->isColumnModified(SpyCountryTableMap::COL_ISO3_CODE)) {
            $criteria->add(SpyCountryTableMap::COL_ISO3_CODE, $this->iso3_code);
        }
        if ($this->isColumnModified(SpyCountryTableMap::COL_NAME)) {
            $criteria->add(SpyCountryTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(SpyCountryTableMap::COL_POSTAL_CODE_MANDATORY)) {
            $criteria->add(SpyCountryTableMap::COL_POSTAL_CODE_MANDATORY, $this->postal_code_mandatory);
        }
        if ($this->isColumnModified(SpyCountryTableMap::COL_POSTAL_CODE_REGEX)) {
            $criteria->add(SpyCountryTableMap::COL_POSTAL_CODE_REGEX, $this->postal_code_regex);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria(): Criteria
    {
        $criteria = ChildSpyCountryQuery::create();
        $criteria->add(SpyCountryTableMap::COL_ID_COUNTRY, $this->id_country);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int|string Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getIdCountry();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getIdCountry();
    }

    /**
     * Generic method to set the primary key (id_country column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdCountry($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdCountry();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\Country\Persistence\SpyCountry (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setIso2Code($this->getIso2Code());
        $copyObj->setIso3Code($this->getIso3Code());
        $copyObj->setName($this->getName());
        $copyObj->setPostalCodeMandatory($this->getPostalCodeMandatory());
        $copyObj->setPostalCodeRegex($this->getPostalCodeRegex());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getCompanyUnitAddresses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCompanyUnitAddress($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyRegions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyRegion($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCountryStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCountryStore($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCustomerAddresses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCustomerAddress($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyMerchantProfileAddresses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyMerchantProfileAddress($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyMerchantRegistrationRequests() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyMerchantRegistrationRequest($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSalesOrderAddresses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSalesOrderAddress($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSalesOrderAddressHistories() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSalesOrderAddressHistory($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getServicePointAddresses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addServicePointAddress($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getStockAddresses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addStockAddress($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyTaxRates() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyTaxRate($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdCountry(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Orm\Zed\Country\Persistence\SpyCountry Clone of current object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function copy(bool $deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName): void
    {
        if ('CompanyUnitAddress' === $relationName) {
            $this->initCompanyUnitAddresses();
            return;
        }
        if ('SpyRegion' === $relationName) {
            $this->initSpyRegions();
            return;
        }
        if ('CountryStore' === $relationName) {
            $this->initCountryStores();
            return;
        }
        if ('CustomerAddress' === $relationName) {
            $this->initCustomerAddresses();
            return;
        }
        if ('SpyMerchantProfileAddress' === $relationName) {
            $this->initSpyMerchantProfileAddresses();
            return;
        }
        if ('SpyMerchantRegistrationRequest' === $relationName) {
            $this->initSpyMerchantRegistrationRequests();
            return;
        }
        if ('SalesOrderAddress' === $relationName) {
            $this->initSalesOrderAddresses();
            return;
        }
        if ('SalesOrderAddressHistory' === $relationName) {
            $this->initSalesOrderAddressHistories();
            return;
        }
        if ('ServicePointAddress' === $relationName) {
            $this->initServicePointAddresses();
            return;
        }
        if ('StockAddress' === $relationName) {
            $this->initStockAddresses();
            return;
        }
        if ('SpyTaxRate' === $relationName) {
            $this->initSpyTaxRates();
            return;
        }
    }

    /**
     * Clears out the collCompanyUnitAddresses collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addCompanyUnitAddresses()
     */
    public function clearCompanyUnitAddresses()
    {
        $this->collCompanyUnitAddresses = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collCompanyUnitAddresses collection loaded partially.
     *
     * @return void
     */
    public function resetPartialCompanyUnitAddresses($v = true): void
    {
        $this->collCompanyUnitAddressesPartial = $v;
    }

    /**
     * Initializes the collCompanyUnitAddresses collection.
     *
     * By default this just sets the collCompanyUnitAddresses collection to an empty array (like clearcollCompanyUnitAddresses());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCompanyUnitAddresses(bool $overrideExisting = true): void
    {
        if (null !== $this->collCompanyUnitAddresses && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCompanyUnitAddressTableMap::getTableMap()->getCollectionClassName();

        $this->collCompanyUnitAddresses = new $collectionClassName;
        $this->collCompanyUnitAddresses->setModel('\Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress');
    }

    /**
     * Gets an array of SpyCompanyUnitAddress objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCountry is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCompanyUnitAddress[] List of SpyCompanyUnitAddress objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyUnitAddress> List of SpyCompanyUnitAddress objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCompanyUnitAddresses(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collCompanyUnitAddressesPartial && !$this->isNew();
        if (null === $this->collCompanyUnitAddresses || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collCompanyUnitAddresses) {
                    $this->initCompanyUnitAddresses();
                } else {
                    $collectionClassName = SpyCompanyUnitAddressTableMap::getTableMap()->getCollectionClassName();

                    $collCompanyUnitAddresses = new $collectionClassName;
                    $collCompanyUnitAddresses->setModel('\Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress');

                    return $collCompanyUnitAddresses;
                }
            } else {
                $collCompanyUnitAddresses = SpyCompanyUnitAddressQuery::create(null, $criteria)
                    ->filterByCountry($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCompanyUnitAddressesPartial && count($collCompanyUnitAddresses)) {
                        $this->initCompanyUnitAddresses(false);

                        foreach ($collCompanyUnitAddresses as $obj) {
                            if (false == $this->collCompanyUnitAddresses->contains($obj)) {
                                $this->collCompanyUnitAddresses->append($obj);
                            }
                        }

                        $this->collCompanyUnitAddressesPartial = true;
                    }

                    return $collCompanyUnitAddresses;
                }

                if ($partial && $this->collCompanyUnitAddresses) {
                    foreach ($this->collCompanyUnitAddresses as $obj) {
                        if ($obj->isNew()) {
                            $collCompanyUnitAddresses[] = $obj;
                        }
                    }
                }

                $this->collCompanyUnitAddresses = $collCompanyUnitAddresses;
                $this->collCompanyUnitAddressesPartial = false;
            }
        }

        return $this->collCompanyUnitAddresses;
    }

    /**
     * Sets a collection of SpyCompanyUnitAddress objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $companyUnitAddresses A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setCompanyUnitAddresses(Collection $companyUnitAddresses, ?ConnectionInterface $con = null)
    {
        /** @var SpyCompanyUnitAddress[] $companyUnitAddressesToDelete */
        $companyUnitAddressesToDelete = $this->getCompanyUnitAddresses(new Criteria(), $con)->diff($companyUnitAddresses);


        $this->companyUnitAddressesScheduledForDeletion = $companyUnitAddressesToDelete;

        foreach ($companyUnitAddressesToDelete as $companyUnitAddressRemoved) {
            $companyUnitAddressRemoved->setCountry(null);
        }

        $this->collCompanyUnitAddresses = null;
        foreach ($companyUnitAddresses as $companyUnitAddress) {
            $this->addCompanyUnitAddress($companyUnitAddress);
        }

        $this->collCompanyUnitAddresses = $companyUnitAddresses;
        $this->collCompanyUnitAddressesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCompanyUnitAddress objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCompanyUnitAddress objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countCompanyUnitAddresses(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collCompanyUnitAddressesPartial && !$this->isNew();
        if (null === $this->collCompanyUnitAddresses || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCompanyUnitAddresses) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCompanyUnitAddresses());
            }

            $query = SpyCompanyUnitAddressQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCountry($this)
                ->count($con);
        }

        return count($this->collCompanyUnitAddresses);
    }

    /**
     * Method called to associate a SpyCompanyUnitAddress object to this object
     * through the SpyCompanyUnitAddress foreign key attribute.
     *
     * @param SpyCompanyUnitAddress $l SpyCompanyUnitAddress
     * @return $this The current object (for fluent API support)
     */
    public function addCompanyUnitAddress(SpyCompanyUnitAddress $l)
    {
        if ($this->collCompanyUnitAddresses === null) {
            $this->initCompanyUnitAddresses();
            $this->collCompanyUnitAddressesPartial = true;
        }

        if (!$this->collCompanyUnitAddresses->contains($l)) {
            $this->doAddCompanyUnitAddress($l);

            if ($this->companyUnitAddressesScheduledForDeletion and $this->companyUnitAddressesScheduledForDeletion->contains($l)) {
                $this->companyUnitAddressesScheduledForDeletion->remove($this->companyUnitAddressesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCompanyUnitAddress $companyUnitAddress The SpyCompanyUnitAddress object to add.
     */
    protected function doAddCompanyUnitAddress(SpyCompanyUnitAddress $companyUnitAddress): void
    {
        $this->collCompanyUnitAddresses[]= $companyUnitAddress;
        $companyUnitAddress->setCountry($this);
    }

    /**
     * @param SpyCompanyUnitAddress $companyUnitAddress The SpyCompanyUnitAddress object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeCompanyUnitAddress(SpyCompanyUnitAddress $companyUnitAddress)
    {
        if ($this->getCompanyUnitAddresses()->contains($companyUnitAddress)) {
            $pos = $this->collCompanyUnitAddresses->search($companyUnitAddress);
            $this->collCompanyUnitAddresses->remove($pos);
            if (null === $this->companyUnitAddressesScheduledForDeletion) {
                $this->companyUnitAddressesScheduledForDeletion = clone $this->collCompanyUnitAddresses;
                $this->companyUnitAddressesScheduledForDeletion->clear();
            }
            $this->companyUnitAddressesScheduledForDeletion[]= clone $companyUnitAddress;
            $companyUnitAddress->setCountry(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCountry is new, it will return
     * an empty collection; or if this SpyCountry has previously
     * been saved, it will retrieve related CompanyUnitAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCountry.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCompanyUnitAddress[] List of SpyCompanyUnitAddress objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyUnitAddress}> List of SpyCompanyUnitAddress objects
     */
    public function getCompanyUnitAddressesJoinRegion(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCompanyUnitAddressQuery::create(null, $criteria);
        $query->joinWith('Region', $joinBehavior);

        return $this->getCompanyUnitAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCountry is new, it will return
     * an empty collection; or if this SpyCountry has previously
     * been saved, it will retrieve related CompanyUnitAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCountry.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCompanyUnitAddress[] List of SpyCompanyUnitAddress objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyUnitAddress}> List of SpyCompanyUnitAddress objects
     */
    public function getCompanyUnitAddressesJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCompanyUnitAddressQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getCompanyUnitAddresses($query, $con);
    }

    /**
     * Clears out the collSpyRegions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyRegions()
     */
    public function clearSpyRegions()
    {
        $this->collSpyRegions = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyRegions collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyRegions($v = true): void
    {
        $this->collSpyRegionsPartial = $v;
    }

    /**
     * Initializes the collSpyRegions collection.
     *
     * By default this just sets the collSpyRegions collection to an empty array (like clearcollSpyRegions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyRegions(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyRegions && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyRegionTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyRegions = new $collectionClassName;
        $this->collSpyRegions->setModel('\Orm\Zed\Country\Persistence\SpyRegion');
    }

    /**
     * Gets an array of ChildSpyRegion objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCountry is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyRegion[] List of ChildSpyRegion objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyRegion> List of ChildSpyRegion objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyRegions(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyRegionsPartial && !$this->isNew();
        if (null === $this->collSpyRegions || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyRegions) {
                    $this->initSpyRegions();
                } else {
                    $collectionClassName = SpyRegionTableMap::getTableMap()->getCollectionClassName();

                    $collSpyRegions = new $collectionClassName;
                    $collSpyRegions->setModel('\Orm\Zed\Country\Persistence\SpyRegion');

                    return $collSpyRegions;
                }
            } else {
                $collSpyRegions = ChildSpyRegionQuery::create(null, $criteria)
                    ->filterBySpyCountry($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyRegionsPartial && count($collSpyRegions)) {
                        $this->initSpyRegions(false);

                        foreach ($collSpyRegions as $obj) {
                            if (false == $this->collSpyRegions->contains($obj)) {
                                $this->collSpyRegions->append($obj);
                            }
                        }

                        $this->collSpyRegionsPartial = true;
                    }

                    return $collSpyRegions;
                }

                if ($partial && $this->collSpyRegions) {
                    foreach ($this->collSpyRegions as $obj) {
                        if ($obj->isNew()) {
                            $collSpyRegions[] = $obj;
                        }
                    }
                }

                $this->collSpyRegions = $collSpyRegions;
                $this->collSpyRegionsPartial = false;
            }
        }

        return $this->collSpyRegions;
    }

    /**
     * Sets a collection of ChildSpyRegion objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyRegions A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyRegions(Collection $spyRegions, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyRegion[] $spyRegionsToDelete */
        $spyRegionsToDelete = $this->getSpyRegions(new Criteria(), $con)->diff($spyRegions);


        $this->spyRegionsScheduledForDeletion = $spyRegionsToDelete;

        foreach ($spyRegionsToDelete as $spyRegionRemoved) {
            $spyRegionRemoved->setSpyCountry(null);
        }

        $this->collSpyRegions = null;
        foreach ($spyRegions as $spyRegion) {
            $this->addSpyRegion($spyRegion);
        }

        $this->collSpyRegions = $spyRegions;
        $this->collSpyRegionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyRegion objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyRegion objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyRegions(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyRegionsPartial && !$this->isNew();
        if (null === $this->collSpyRegions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyRegions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyRegions());
            }

            $query = ChildSpyRegionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyCountry($this)
                ->count($con);
        }

        return count($this->collSpyRegions);
    }

    /**
     * Method called to associate a ChildSpyRegion object to this object
     * through the ChildSpyRegion foreign key attribute.
     *
     * @param ChildSpyRegion $l ChildSpyRegion
     * @return $this The current object (for fluent API support)
     */
    public function addSpyRegion(ChildSpyRegion $l)
    {
        if ($this->collSpyRegions === null) {
            $this->initSpyRegions();
            $this->collSpyRegionsPartial = true;
        }

        if (!$this->collSpyRegions->contains($l)) {
            $this->doAddSpyRegion($l);

            if ($this->spyRegionsScheduledForDeletion and $this->spyRegionsScheduledForDeletion->contains($l)) {
                $this->spyRegionsScheduledForDeletion->remove($this->spyRegionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyRegion $spyRegion The ChildSpyRegion object to add.
     */
    protected function doAddSpyRegion(ChildSpyRegion $spyRegion): void
    {
        $this->collSpyRegions[]= $spyRegion;
        $spyRegion->setSpyCountry($this);
    }

    /**
     * @param ChildSpyRegion $spyRegion The ChildSpyRegion object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyRegion(ChildSpyRegion $spyRegion)
    {
        if ($this->getSpyRegions()->contains($spyRegion)) {
            $pos = $this->collSpyRegions->search($spyRegion);
            $this->collSpyRegions->remove($pos);
            if (null === $this->spyRegionsScheduledForDeletion) {
                $this->spyRegionsScheduledForDeletion = clone $this->collSpyRegions;
                $this->spyRegionsScheduledForDeletion->clear();
            }
            $this->spyRegionsScheduledForDeletion[]= $spyRegion;
            $spyRegion->setSpyCountry(null);
        }

        return $this;
    }

    /**
     * Clears out the collCountryStores collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addCountryStores()
     */
    public function clearCountryStores()
    {
        $this->collCountryStores = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collCountryStores collection loaded partially.
     *
     * @return void
     */
    public function resetPartialCountryStores($v = true): void
    {
        $this->collCountryStoresPartial = $v;
    }

    /**
     * Initializes the collCountryStores collection.
     *
     * By default this just sets the collCountryStores collection to an empty array (like clearcollCountryStores());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCountryStores(bool $overrideExisting = true): void
    {
        if (null !== $this->collCountryStores && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCountryStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collCountryStores = new $collectionClassName;
        $this->collCountryStores->setModel('\Orm\Zed\Country\Persistence\SpyCountryStore');
    }

    /**
     * Gets an array of ChildSpyCountryStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCountry is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyCountryStore[] List of ChildSpyCountryStore objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCountryStore> List of ChildSpyCountryStore objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCountryStores(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collCountryStoresPartial && !$this->isNew();
        if (null === $this->collCountryStores || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collCountryStores) {
                    $this->initCountryStores();
                } else {
                    $collectionClassName = SpyCountryStoreTableMap::getTableMap()->getCollectionClassName();

                    $collCountryStores = new $collectionClassName;
                    $collCountryStores->setModel('\Orm\Zed\Country\Persistence\SpyCountryStore');

                    return $collCountryStores;
                }
            } else {
                $collCountryStores = ChildSpyCountryStoreQuery::create(null, $criteria)
                    ->filterByCountry($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCountryStoresPartial && count($collCountryStores)) {
                        $this->initCountryStores(false);

                        foreach ($collCountryStores as $obj) {
                            if (false == $this->collCountryStores->contains($obj)) {
                                $this->collCountryStores->append($obj);
                            }
                        }

                        $this->collCountryStoresPartial = true;
                    }

                    return $collCountryStores;
                }

                if ($partial && $this->collCountryStores) {
                    foreach ($this->collCountryStores as $obj) {
                        if ($obj->isNew()) {
                            $collCountryStores[] = $obj;
                        }
                    }
                }

                $this->collCountryStores = $collCountryStores;
                $this->collCountryStoresPartial = false;
            }
        }

        return $this->collCountryStores;
    }

    /**
     * Sets a collection of ChildSpyCountryStore objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $countryStores A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setCountryStores(Collection $countryStores, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyCountryStore[] $countryStoresToDelete */
        $countryStoresToDelete = $this->getCountryStores(new Criteria(), $con)->diff($countryStores);


        $this->countryStoresScheduledForDeletion = $countryStoresToDelete;

        foreach ($countryStoresToDelete as $countryStoreRemoved) {
            $countryStoreRemoved->setCountry(null);
        }

        $this->collCountryStores = null;
        foreach ($countryStores as $countryStore) {
            $this->addCountryStore($countryStore);
        }

        $this->collCountryStores = $countryStores;
        $this->collCountryStoresPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyCountryStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyCountryStore objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countCountryStores(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collCountryStoresPartial && !$this->isNew();
        if (null === $this->collCountryStores || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCountryStores) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCountryStores());
            }

            $query = ChildSpyCountryStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCountry($this)
                ->count($con);
        }

        return count($this->collCountryStores);
    }

    /**
     * Method called to associate a ChildSpyCountryStore object to this object
     * through the ChildSpyCountryStore foreign key attribute.
     *
     * @param ChildSpyCountryStore $l ChildSpyCountryStore
     * @return $this The current object (for fluent API support)
     */
    public function addCountryStore(ChildSpyCountryStore $l)
    {
        if ($this->collCountryStores === null) {
            $this->initCountryStores();
            $this->collCountryStoresPartial = true;
        }

        if (!$this->collCountryStores->contains($l)) {
            $this->doAddCountryStore($l);

            if ($this->countryStoresScheduledForDeletion and $this->countryStoresScheduledForDeletion->contains($l)) {
                $this->countryStoresScheduledForDeletion->remove($this->countryStoresScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyCountryStore $countryStore The ChildSpyCountryStore object to add.
     */
    protected function doAddCountryStore(ChildSpyCountryStore $countryStore): void
    {
        $this->collCountryStores[]= $countryStore;
        $countryStore->setCountry($this);
    }

    /**
     * @param ChildSpyCountryStore $countryStore The ChildSpyCountryStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeCountryStore(ChildSpyCountryStore $countryStore)
    {
        if ($this->getCountryStores()->contains($countryStore)) {
            $pos = $this->collCountryStores->search($countryStore);
            $this->collCountryStores->remove($pos);
            if (null === $this->countryStoresScheduledForDeletion) {
                $this->countryStoresScheduledForDeletion = clone $this->collCountryStores;
                $this->countryStoresScheduledForDeletion->clear();
            }
            $this->countryStoresScheduledForDeletion[]= clone $countryStore;
            $countryStore->setCountry(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCountry is new, it will return
     * an empty collection; or if this SpyCountry has previously
     * been saved, it will retrieve related CountryStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCountry.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyCountryStore[] List of ChildSpyCountryStore objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCountryStore}> List of ChildSpyCountryStore objects
     */
    public function getCountryStoresJoinStore(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyCountryStoreQuery::create(null, $criteria);
        $query->joinWith('Store', $joinBehavior);

        return $this->getCountryStores($query, $con);
    }

    /**
     * Clears out the collCustomerAddresses collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addCustomerAddresses()
     */
    public function clearCustomerAddresses()
    {
        $this->collCustomerAddresses = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collCustomerAddresses collection loaded partially.
     *
     * @return void
     */
    public function resetPartialCustomerAddresses($v = true): void
    {
        $this->collCustomerAddressesPartial = $v;
    }

    /**
     * Initializes the collCustomerAddresses collection.
     *
     * By default this just sets the collCustomerAddresses collection to an empty array (like clearcollCustomerAddresses());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCustomerAddresses(bool $overrideExisting = true): void
    {
        if (null !== $this->collCustomerAddresses && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCustomerAddressTableMap::getTableMap()->getCollectionClassName();

        $this->collCustomerAddresses = new $collectionClassName;
        $this->collCustomerAddresses->setModel('\Orm\Zed\Customer\Persistence\SpyCustomerAddress');
    }

    /**
     * Gets an array of SpyCustomerAddress objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCountry is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCustomerAddress[] List of SpyCustomerAddress objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCustomerAddress> List of SpyCustomerAddress objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCustomerAddresses(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collCustomerAddressesPartial && !$this->isNew();
        if (null === $this->collCustomerAddresses || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collCustomerAddresses) {
                    $this->initCustomerAddresses();
                } else {
                    $collectionClassName = SpyCustomerAddressTableMap::getTableMap()->getCollectionClassName();

                    $collCustomerAddresses = new $collectionClassName;
                    $collCustomerAddresses->setModel('\Orm\Zed\Customer\Persistence\SpyCustomerAddress');

                    return $collCustomerAddresses;
                }
            } else {
                $collCustomerAddresses = SpyCustomerAddressQuery::create(null, $criteria)
                    ->filterByCountry($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCustomerAddressesPartial && count($collCustomerAddresses)) {
                        $this->initCustomerAddresses(false);

                        foreach ($collCustomerAddresses as $obj) {
                            if (false == $this->collCustomerAddresses->contains($obj)) {
                                $this->collCustomerAddresses->append($obj);
                            }
                        }

                        $this->collCustomerAddressesPartial = true;
                    }

                    return $collCustomerAddresses;
                }

                if ($partial && $this->collCustomerAddresses) {
                    foreach ($this->collCustomerAddresses as $obj) {
                        if ($obj->isNew()) {
                            $collCustomerAddresses[] = $obj;
                        }
                    }
                }

                $this->collCustomerAddresses = $collCustomerAddresses;
                $this->collCustomerAddressesPartial = false;
            }
        }

        return $this->collCustomerAddresses;
    }

    /**
     * Sets a collection of SpyCustomerAddress objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $customerAddresses A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setCustomerAddresses(Collection $customerAddresses, ?ConnectionInterface $con = null)
    {
        /** @var SpyCustomerAddress[] $customerAddressesToDelete */
        $customerAddressesToDelete = $this->getCustomerAddresses(new Criteria(), $con)->diff($customerAddresses);


        $this->customerAddressesScheduledForDeletion = $customerAddressesToDelete;

        foreach ($customerAddressesToDelete as $customerAddressRemoved) {
            $customerAddressRemoved->setCountry(null);
        }

        $this->collCustomerAddresses = null;
        foreach ($customerAddresses as $customerAddress) {
            $this->addCustomerAddress($customerAddress);
        }

        $this->collCustomerAddresses = $customerAddresses;
        $this->collCustomerAddressesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCustomerAddress objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCustomerAddress objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countCustomerAddresses(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collCustomerAddressesPartial && !$this->isNew();
        if (null === $this->collCustomerAddresses || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCustomerAddresses) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCustomerAddresses());
            }

            $query = SpyCustomerAddressQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCountry($this)
                ->count($con);
        }

        return count($this->collCustomerAddresses);
    }

    /**
     * Method called to associate a SpyCustomerAddress object to this object
     * through the SpyCustomerAddress foreign key attribute.
     *
     * @param SpyCustomerAddress $l SpyCustomerAddress
     * @return $this The current object (for fluent API support)
     */
    public function addCustomerAddress(SpyCustomerAddress $l)
    {
        if ($this->collCustomerAddresses === null) {
            $this->initCustomerAddresses();
            $this->collCustomerAddressesPartial = true;
        }

        if (!$this->collCustomerAddresses->contains($l)) {
            $this->doAddCustomerAddress($l);

            if ($this->customerAddressesScheduledForDeletion and $this->customerAddressesScheduledForDeletion->contains($l)) {
                $this->customerAddressesScheduledForDeletion->remove($this->customerAddressesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCustomerAddress $customerAddress The SpyCustomerAddress object to add.
     */
    protected function doAddCustomerAddress(SpyCustomerAddress $customerAddress): void
    {
        $this->collCustomerAddresses[]= $customerAddress;
        $customerAddress->setCountry($this);
    }

    /**
     * @param SpyCustomerAddress $customerAddress The SpyCustomerAddress object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeCustomerAddress(SpyCustomerAddress $customerAddress)
    {
        if ($this->getCustomerAddresses()->contains($customerAddress)) {
            $pos = $this->collCustomerAddresses->search($customerAddress);
            $this->collCustomerAddresses->remove($pos);
            if (null === $this->customerAddressesScheduledForDeletion) {
                $this->customerAddressesScheduledForDeletion = clone $this->collCustomerAddresses;
                $this->customerAddressesScheduledForDeletion->clear();
            }
            $this->customerAddressesScheduledForDeletion[]= clone $customerAddress;
            $customerAddress->setCountry(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCountry is new, it will return
     * an empty collection; or if this SpyCountry has previously
     * been saved, it will retrieve related CustomerAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCountry.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCustomerAddress[] List of SpyCustomerAddress objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCustomerAddress}> List of SpyCustomerAddress objects
     */
    public function getCustomerAddressesJoinCustomer(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCustomerAddressQuery::create(null, $criteria);
        $query->joinWith('Customer', $joinBehavior);

        return $this->getCustomerAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCountry is new, it will return
     * an empty collection; or if this SpyCountry has previously
     * been saved, it will retrieve related CustomerAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCountry.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCustomerAddress[] List of SpyCustomerAddress objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCustomerAddress}> List of SpyCustomerAddress objects
     */
    public function getCustomerAddressesJoinRegion(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCustomerAddressQuery::create(null, $criteria);
        $query->joinWith('Region', $joinBehavior);

        return $this->getCustomerAddresses($query, $con);
    }

    /**
     * Clears out the collSpyMerchantProfileAddresses collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyMerchantProfileAddresses()
     */
    public function clearSpyMerchantProfileAddresses()
    {
        $this->collSpyMerchantProfileAddresses = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyMerchantProfileAddresses collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyMerchantProfileAddresses($v = true): void
    {
        $this->collSpyMerchantProfileAddressesPartial = $v;
    }

    /**
     * Initializes the collSpyMerchantProfileAddresses collection.
     *
     * By default this just sets the collSpyMerchantProfileAddresses collection to an empty array (like clearcollSpyMerchantProfileAddresses());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyMerchantProfileAddresses(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyMerchantProfileAddresses && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyMerchantProfileAddressTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyMerchantProfileAddresses = new $collectionClassName;
        $this->collSpyMerchantProfileAddresses->setModel('\Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddress');
    }

    /**
     * Gets an array of SpyMerchantProfileAddress objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCountry is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyMerchantProfileAddress[] List of SpyMerchantProfileAddress objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantProfileAddress> List of SpyMerchantProfileAddress objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyMerchantProfileAddresses(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyMerchantProfileAddressesPartial && !$this->isNew();
        if (null === $this->collSpyMerchantProfileAddresses || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyMerchantProfileAddresses) {
                    $this->initSpyMerchantProfileAddresses();
                } else {
                    $collectionClassName = SpyMerchantProfileAddressTableMap::getTableMap()->getCollectionClassName();

                    $collSpyMerchantProfileAddresses = new $collectionClassName;
                    $collSpyMerchantProfileAddresses->setModel('\Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddress');

                    return $collSpyMerchantProfileAddresses;
                }
            } else {
                $collSpyMerchantProfileAddresses = SpyMerchantProfileAddressQuery::create(null, $criteria)
                    ->filterBySpyCountry($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyMerchantProfileAddressesPartial && count($collSpyMerchantProfileAddresses)) {
                        $this->initSpyMerchantProfileAddresses(false);

                        foreach ($collSpyMerchantProfileAddresses as $obj) {
                            if (false == $this->collSpyMerchantProfileAddresses->contains($obj)) {
                                $this->collSpyMerchantProfileAddresses->append($obj);
                            }
                        }

                        $this->collSpyMerchantProfileAddressesPartial = true;
                    }

                    return $collSpyMerchantProfileAddresses;
                }

                if ($partial && $this->collSpyMerchantProfileAddresses) {
                    foreach ($this->collSpyMerchantProfileAddresses as $obj) {
                        if ($obj->isNew()) {
                            $collSpyMerchantProfileAddresses[] = $obj;
                        }
                    }
                }

                $this->collSpyMerchantProfileAddresses = $collSpyMerchantProfileAddresses;
                $this->collSpyMerchantProfileAddressesPartial = false;
            }
        }

        return $this->collSpyMerchantProfileAddresses;
    }

    /**
     * Sets a collection of SpyMerchantProfileAddress objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyMerchantProfileAddresses A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyMerchantProfileAddresses(Collection $spyMerchantProfileAddresses, ?ConnectionInterface $con = null)
    {
        /** @var SpyMerchantProfileAddress[] $spyMerchantProfileAddressesToDelete */
        $spyMerchantProfileAddressesToDelete = $this->getSpyMerchantProfileAddresses(new Criteria(), $con)->diff($spyMerchantProfileAddresses);


        $this->spyMerchantProfileAddressesScheduledForDeletion = $spyMerchantProfileAddressesToDelete;

        foreach ($spyMerchantProfileAddressesToDelete as $spyMerchantProfileAddressRemoved) {
            $spyMerchantProfileAddressRemoved->setSpyCountry(null);
        }

        $this->collSpyMerchantProfileAddresses = null;
        foreach ($spyMerchantProfileAddresses as $spyMerchantProfileAddress) {
            $this->addSpyMerchantProfileAddress($spyMerchantProfileAddress);
        }

        $this->collSpyMerchantProfileAddresses = $spyMerchantProfileAddresses;
        $this->collSpyMerchantProfileAddressesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyMerchantProfileAddress objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyMerchantProfileAddress objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyMerchantProfileAddresses(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyMerchantProfileAddressesPartial && !$this->isNew();
        if (null === $this->collSpyMerchantProfileAddresses || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyMerchantProfileAddresses) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyMerchantProfileAddresses());
            }

            $query = SpyMerchantProfileAddressQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyCountry($this)
                ->count($con);
        }

        return count($this->collSpyMerchantProfileAddresses);
    }

    /**
     * Method called to associate a SpyMerchantProfileAddress object to this object
     * through the SpyMerchantProfileAddress foreign key attribute.
     *
     * @param SpyMerchantProfileAddress $l SpyMerchantProfileAddress
     * @return $this The current object (for fluent API support)
     */
    public function addSpyMerchantProfileAddress(SpyMerchantProfileAddress $l)
    {
        if ($this->collSpyMerchantProfileAddresses === null) {
            $this->initSpyMerchantProfileAddresses();
            $this->collSpyMerchantProfileAddressesPartial = true;
        }

        if (!$this->collSpyMerchantProfileAddresses->contains($l)) {
            $this->doAddSpyMerchantProfileAddress($l);

            if ($this->spyMerchantProfileAddressesScheduledForDeletion and $this->spyMerchantProfileAddressesScheduledForDeletion->contains($l)) {
                $this->spyMerchantProfileAddressesScheduledForDeletion->remove($this->spyMerchantProfileAddressesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyMerchantProfileAddress $spyMerchantProfileAddress The SpyMerchantProfileAddress object to add.
     */
    protected function doAddSpyMerchantProfileAddress(SpyMerchantProfileAddress $spyMerchantProfileAddress): void
    {
        $this->collSpyMerchantProfileAddresses[]= $spyMerchantProfileAddress;
        $spyMerchantProfileAddress->setSpyCountry($this);
    }

    /**
     * @param SpyMerchantProfileAddress $spyMerchantProfileAddress The SpyMerchantProfileAddress object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyMerchantProfileAddress(SpyMerchantProfileAddress $spyMerchantProfileAddress)
    {
        if ($this->getSpyMerchantProfileAddresses()->contains($spyMerchantProfileAddress)) {
            $pos = $this->collSpyMerchantProfileAddresses->search($spyMerchantProfileAddress);
            $this->collSpyMerchantProfileAddresses->remove($pos);
            if (null === $this->spyMerchantProfileAddressesScheduledForDeletion) {
                $this->spyMerchantProfileAddressesScheduledForDeletion = clone $this->collSpyMerchantProfileAddresses;
                $this->spyMerchantProfileAddressesScheduledForDeletion->clear();
            }
            $this->spyMerchantProfileAddressesScheduledForDeletion[]= $spyMerchantProfileAddress;
            $spyMerchantProfileAddress->setSpyCountry(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCountry is new, it will return
     * an empty collection; or if this SpyCountry has previously
     * been saved, it will retrieve related SpyMerchantProfileAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCountry.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyMerchantProfileAddress[] List of SpyMerchantProfileAddress objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantProfileAddress}> List of SpyMerchantProfileAddress objects
     */
    public function getSpyMerchantProfileAddressesJoinSpyMerchantProfile(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyMerchantProfileAddressQuery::create(null, $criteria);
        $query->joinWith('SpyMerchantProfile', $joinBehavior);

        return $this->getSpyMerchantProfileAddresses($query, $con);
    }

    /**
     * Clears out the collSpyMerchantRegistrationRequests collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyMerchantRegistrationRequests()
     */
    public function clearSpyMerchantRegistrationRequests()
    {
        $this->collSpyMerchantRegistrationRequests = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyMerchantRegistrationRequests collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyMerchantRegistrationRequests($v = true): void
    {
        $this->collSpyMerchantRegistrationRequestsPartial = $v;
    }

    /**
     * Initializes the collSpyMerchantRegistrationRequests collection.
     *
     * By default this just sets the collSpyMerchantRegistrationRequests collection to an empty array (like clearcollSpyMerchantRegistrationRequests());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyMerchantRegistrationRequests(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyMerchantRegistrationRequests && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyMerchantRegistrationRequestTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyMerchantRegistrationRequests = new $collectionClassName;
        $this->collSpyMerchantRegistrationRequests->setModel('\Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequest');
    }

    /**
     * Gets an array of SpyMerchantRegistrationRequest objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCountry is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyMerchantRegistrationRequest[] List of SpyMerchantRegistrationRequest objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantRegistrationRequest> List of SpyMerchantRegistrationRequest objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyMerchantRegistrationRequests(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyMerchantRegistrationRequestsPartial && !$this->isNew();
        if (null === $this->collSpyMerchantRegistrationRequests || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyMerchantRegistrationRequests) {
                    $this->initSpyMerchantRegistrationRequests();
                } else {
                    $collectionClassName = SpyMerchantRegistrationRequestTableMap::getTableMap()->getCollectionClassName();

                    $collSpyMerchantRegistrationRequests = new $collectionClassName;
                    $collSpyMerchantRegistrationRequests->setModel('\Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequest');

                    return $collSpyMerchantRegistrationRequests;
                }
            } else {
                $collSpyMerchantRegistrationRequests = SpyMerchantRegistrationRequestQuery::create(null, $criteria)
                    ->filterByCountry($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyMerchantRegistrationRequestsPartial && count($collSpyMerchantRegistrationRequests)) {
                        $this->initSpyMerchantRegistrationRequests(false);

                        foreach ($collSpyMerchantRegistrationRequests as $obj) {
                            if (false == $this->collSpyMerchantRegistrationRequests->contains($obj)) {
                                $this->collSpyMerchantRegistrationRequests->append($obj);
                            }
                        }

                        $this->collSpyMerchantRegistrationRequestsPartial = true;
                    }

                    return $collSpyMerchantRegistrationRequests;
                }

                if ($partial && $this->collSpyMerchantRegistrationRequests) {
                    foreach ($this->collSpyMerchantRegistrationRequests as $obj) {
                        if ($obj->isNew()) {
                            $collSpyMerchantRegistrationRequests[] = $obj;
                        }
                    }
                }

                $this->collSpyMerchantRegistrationRequests = $collSpyMerchantRegistrationRequests;
                $this->collSpyMerchantRegistrationRequestsPartial = false;
            }
        }

        return $this->collSpyMerchantRegistrationRequests;
    }

    /**
     * Sets a collection of SpyMerchantRegistrationRequest objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyMerchantRegistrationRequests A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyMerchantRegistrationRequests(Collection $spyMerchantRegistrationRequests, ?ConnectionInterface $con = null)
    {
        /** @var SpyMerchantRegistrationRequest[] $spyMerchantRegistrationRequestsToDelete */
        $spyMerchantRegistrationRequestsToDelete = $this->getSpyMerchantRegistrationRequests(new Criteria(), $con)->diff($spyMerchantRegistrationRequests);


        $this->spyMerchantRegistrationRequestsScheduledForDeletion = $spyMerchantRegistrationRequestsToDelete;

        foreach ($spyMerchantRegistrationRequestsToDelete as $spyMerchantRegistrationRequestRemoved) {
            $spyMerchantRegistrationRequestRemoved->setCountry(null);
        }

        $this->collSpyMerchantRegistrationRequests = null;
        foreach ($spyMerchantRegistrationRequests as $spyMerchantRegistrationRequest) {
            $this->addSpyMerchantRegistrationRequest($spyMerchantRegistrationRequest);
        }

        $this->collSpyMerchantRegistrationRequests = $spyMerchantRegistrationRequests;
        $this->collSpyMerchantRegistrationRequestsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyMerchantRegistrationRequest objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyMerchantRegistrationRequest objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyMerchantRegistrationRequests(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyMerchantRegistrationRequestsPartial && !$this->isNew();
        if (null === $this->collSpyMerchantRegistrationRequests || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyMerchantRegistrationRequests) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyMerchantRegistrationRequests());
            }

            $query = SpyMerchantRegistrationRequestQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCountry($this)
                ->count($con);
        }

        return count($this->collSpyMerchantRegistrationRequests);
    }

    /**
     * Method called to associate a SpyMerchantRegistrationRequest object to this object
     * through the SpyMerchantRegistrationRequest foreign key attribute.
     *
     * @param SpyMerchantRegistrationRequest $l SpyMerchantRegistrationRequest
     * @return $this The current object (for fluent API support)
     */
    public function addSpyMerchantRegistrationRequest(SpyMerchantRegistrationRequest $l)
    {
        if ($this->collSpyMerchantRegistrationRequests === null) {
            $this->initSpyMerchantRegistrationRequests();
            $this->collSpyMerchantRegistrationRequestsPartial = true;
        }

        if (!$this->collSpyMerchantRegistrationRequests->contains($l)) {
            $this->doAddSpyMerchantRegistrationRequest($l);

            if ($this->spyMerchantRegistrationRequestsScheduledForDeletion and $this->spyMerchantRegistrationRequestsScheduledForDeletion->contains($l)) {
                $this->spyMerchantRegistrationRequestsScheduledForDeletion->remove($this->spyMerchantRegistrationRequestsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyMerchantRegistrationRequest $spyMerchantRegistrationRequest The SpyMerchantRegistrationRequest object to add.
     */
    protected function doAddSpyMerchantRegistrationRequest(SpyMerchantRegistrationRequest $spyMerchantRegistrationRequest): void
    {
        $this->collSpyMerchantRegistrationRequests[]= $spyMerchantRegistrationRequest;
        $spyMerchantRegistrationRequest->setCountry($this);
    }

    /**
     * @param SpyMerchantRegistrationRequest $spyMerchantRegistrationRequest The SpyMerchantRegistrationRequest object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyMerchantRegistrationRequest(SpyMerchantRegistrationRequest $spyMerchantRegistrationRequest)
    {
        if ($this->getSpyMerchantRegistrationRequests()->contains($spyMerchantRegistrationRequest)) {
            $pos = $this->collSpyMerchantRegistrationRequests->search($spyMerchantRegistrationRequest);
            $this->collSpyMerchantRegistrationRequests->remove($pos);
            if (null === $this->spyMerchantRegistrationRequestsScheduledForDeletion) {
                $this->spyMerchantRegistrationRequestsScheduledForDeletion = clone $this->collSpyMerchantRegistrationRequests;
                $this->spyMerchantRegistrationRequestsScheduledForDeletion->clear();
            }
            $this->spyMerchantRegistrationRequestsScheduledForDeletion[]= clone $spyMerchantRegistrationRequest;
            $spyMerchantRegistrationRequest->setCountry(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCountry is new, it will return
     * an empty collection; or if this SpyCountry has previously
     * been saved, it will retrieve related SpyMerchantRegistrationRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCountry.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyMerchantRegistrationRequest[] List of SpyMerchantRegistrationRequest objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantRegistrationRequest}> List of SpyMerchantRegistrationRequest objects
     */
    public function getSpyMerchantRegistrationRequestsJoinStore(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyMerchantRegistrationRequestQuery::create(null, $criteria);
        $query->joinWith('Store', $joinBehavior);

        return $this->getSpyMerchantRegistrationRequests($query, $con);
    }

    /**
     * Clears out the collSalesOrderAddresses collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSalesOrderAddresses()
     */
    public function clearSalesOrderAddresses()
    {
        $this->collSalesOrderAddresses = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSalesOrderAddresses collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSalesOrderAddresses($v = true): void
    {
        $this->collSalesOrderAddressesPartial = $v;
    }

    /**
     * Initializes the collSalesOrderAddresses collection.
     *
     * By default this just sets the collSalesOrderAddresses collection to an empty array (like clearcollSalesOrderAddresses());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSalesOrderAddresses(bool $overrideExisting = true): void
    {
        if (null !== $this->collSalesOrderAddresses && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySalesOrderAddressTableMap::getTableMap()->getCollectionClassName();

        $this->collSalesOrderAddresses = new $collectionClassName;
        $this->collSalesOrderAddresses->setModel('\Orm\Zed\Sales\Persistence\SpySalesOrderAddress');
    }

    /**
     * Gets an array of SpySalesOrderAddress objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCountry is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpySalesOrderAddress[] List of SpySalesOrderAddress objects
     * @phpstan-return ObjectCollection&\Traversable<SpySalesOrderAddress> List of SpySalesOrderAddress objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSalesOrderAddresses(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSalesOrderAddressesPartial && !$this->isNew();
        if (null === $this->collSalesOrderAddresses || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSalesOrderAddresses) {
                    $this->initSalesOrderAddresses();
                } else {
                    $collectionClassName = SpySalesOrderAddressTableMap::getTableMap()->getCollectionClassName();

                    $collSalesOrderAddresses = new $collectionClassName;
                    $collSalesOrderAddresses->setModel('\Orm\Zed\Sales\Persistence\SpySalesOrderAddress');

                    return $collSalesOrderAddresses;
                }
            } else {
                $collSalesOrderAddresses = SpySalesOrderAddressQuery::create(null, $criteria)
                    ->filterByCountry($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSalesOrderAddressesPartial && count($collSalesOrderAddresses)) {
                        $this->initSalesOrderAddresses(false);

                        foreach ($collSalesOrderAddresses as $obj) {
                            if (false == $this->collSalesOrderAddresses->contains($obj)) {
                                $this->collSalesOrderAddresses->append($obj);
                            }
                        }

                        $this->collSalesOrderAddressesPartial = true;
                    }

                    return $collSalesOrderAddresses;
                }

                if ($partial && $this->collSalesOrderAddresses) {
                    foreach ($this->collSalesOrderAddresses as $obj) {
                        if ($obj->isNew()) {
                            $collSalesOrderAddresses[] = $obj;
                        }
                    }
                }

                $this->collSalesOrderAddresses = $collSalesOrderAddresses;
                $this->collSalesOrderAddressesPartial = false;
            }
        }

        return $this->collSalesOrderAddresses;
    }

    /**
     * Sets a collection of SpySalesOrderAddress objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $salesOrderAddresses A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSalesOrderAddresses(Collection $salesOrderAddresses, ?ConnectionInterface $con = null)
    {
        /** @var SpySalesOrderAddress[] $salesOrderAddressesToDelete */
        $salesOrderAddressesToDelete = $this->getSalesOrderAddresses(new Criteria(), $con)->diff($salesOrderAddresses);


        $this->salesOrderAddressesScheduledForDeletion = $salesOrderAddressesToDelete;

        foreach ($salesOrderAddressesToDelete as $salesOrderAddressRemoved) {
            $salesOrderAddressRemoved->setCountry(null);
        }

        $this->collSalesOrderAddresses = null;
        foreach ($salesOrderAddresses as $salesOrderAddress) {
            $this->addSalesOrderAddress($salesOrderAddress);
        }

        $this->collSalesOrderAddresses = $salesOrderAddresses;
        $this->collSalesOrderAddressesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpySalesOrderAddress objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpySalesOrderAddress objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSalesOrderAddresses(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSalesOrderAddressesPartial && !$this->isNew();
        if (null === $this->collSalesOrderAddresses || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSalesOrderAddresses) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSalesOrderAddresses());
            }

            $query = SpySalesOrderAddressQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCountry($this)
                ->count($con);
        }

        return count($this->collSalesOrderAddresses);
    }

    /**
     * Method called to associate a SpySalesOrderAddress object to this object
     * through the SpySalesOrderAddress foreign key attribute.
     *
     * @param SpySalesOrderAddress $l SpySalesOrderAddress
     * @return $this The current object (for fluent API support)
     */
    public function addSalesOrderAddress(SpySalesOrderAddress $l)
    {
        if ($this->collSalesOrderAddresses === null) {
            $this->initSalesOrderAddresses();
            $this->collSalesOrderAddressesPartial = true;
        }

        if (!$this->collSalesOrderAddresses->contains($l)) {
            $this->doAddSalesOrderAddress($l);

            if ($this->salesOrderAddressesScheduledForDeletion and $this->salesOrderAddressesScheduledForDeletion->contains($l)) {
                $this->salesOrderAddressesScheduledForDeletion->remove($this->salesOrderAddressesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpySalesOrderAddress $salesOrderAddress The SpySalesOrderAddress object to add.
     */
    protected function doAddSalesOrderAddress(SpySalesOrderAddress $salesOrderAddress): void
    {
        $this->collSalesOrderAddresses[]= $salesOrderAddress;
        $salesOrderAddress->setCountry($this);
    }

    /**
     * @param SpySalesOrderAddress $salesOrderAddress The SpySalesOrderAddress object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSalesOrderAddress(SpySalesOrderAddress $salesOrderAddress)
    {
        if ($this->getSalesOrderAddresses()->contains($salesOrderAddress)) {
            $pos = $this->collSalesOrderAddresses->search($salesOrderAddress);
            $this->collSalesOrderAddresses->remove($pos);
            if (null === $this->salesOrderAddressesScheduledForDeletion) {
                $this->salesOrderAddressesScheduledForDeletion = clone $this->collSalesOrderAddresses;
                $this->salesOrderAddressesScheduledForDeletion->clear();
            }
            $this->salesOrderAddressesScheduledForDeletion[]= clone $salesOrderAddress;
            $salesOrderAddress->setCountry(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCountry is new, it will return
     * an empty collection; or if this SpyCountry has previously
     * been saved, it will retrieve related SalesOrderAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCountry.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpySalesOrderAddress[] List of SpySalesOrderAddress objects
     * @phpstan-return ObjectCollection&\Traversable<SpySalesOrderAddress}> List of SpySalesOrderAddress objects
     */
    public function getSalesOrderAddressesJoinRegion(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpySalesOrderAddressQuery::create(null, $criteria);
        $query->joinWith('Region', $joinBehavior);

        return $this->getSalesOrderAddresses($query, $con);
    }

    /**
     * Clears out the collSalesOrderAddressHistories collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSalesOrderAddressHistories()
     */
    public function clearSalesOrderAddressHistories()
    {
        $this->collSalesOrderAddressHistories = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSalesOrderAddressHistories collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSalesOrderAddressHistories($v = true): void
    {
        $this->collSalesOrderAddressHistoriesPartial = $v;
    }

    /**
     * Initializes the collSalesOrderAddressHistories collection.
     *
     * By default this just sets the collSalesOrderAddressHistories collection to an empty array (like clearcollSalesOrderAddressHistories());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSalesOrderAddressHistories(bool $overrideExisting = true): void
    {
        if (null !== $this->collSalesOrderAddressHistories && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySalesOrderAddressHistoryTableMap::getTableMap()->getCollectionClassName();

        $this->collSalesOrderAddressHistories = new $collectionClassName;
        $this->collSalesOrderAddressHistories->setModel('\Orm\Zed\Sales\Persistence\SpySalesOrderAddressHistory');
    }

    /**
     * Gets an array of SpySalesOrderAddressHistory objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCountry is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpySalesOrderAddressHistory[] List of SpySalesOrderAddressHistory objects
     * @phpstan-return ObjectCollection&\Traversable<SpySalesOrderAddressHistory> List of SpySalesOrderAddressHistory objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSalesOrderAddressHistories(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSalesOrderAddressHistoriesPartial && !$this->isNew();
        if (null === $this->collSalesOrderAddressHistories || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSalesOrderAddressHistories) {
                    $this->initSalesOrderAddressHistories();
                } else {
                    $collectionClassName = SpySalesOrderAddressHistoryTableMap::getTableMap()->getCollectionClassName();

                    $collSalesOrderAddressHistories = new $collectionClassName;
                    $collSalesOrderAddressHistories->setModel('\Orm\Zed\Sales\Persistence\SpySalesOrderAddressHistory');

                    return $collSalesOrderAddressHistories;
                }
            } else {
                $collSalesOrderAddressHistories = SpySalesOrderAddressHistoryQuery::create(null, $criteria)
                    ->filterByCountry($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSalesOrderAddressHistoriesPartial && count($collSalesOrderAddressHistories)) {
                        $this->initSalesOrderAddressHistories(false);

                        foreach ($collSalesOrderAddressHistories as $obj) {
                            if (false == $this->collSalesOrderAddressHistories->contains($obj)) {
                                $this->collSalesOrderAddressHistories->append($obj);
                            }
                        }

                        $this->collSalesOrderAddressHistoriesPartial = true;
                    }

                    return $collSalesOrderAddressHistories;
                }

                if ($partial && $this->collSalesOrderAddressHistories) {
                    foreach ($this->collSalesOrderAddressHistories as $obj) {
                        if ($obj->isNew()) {
                            $collSalesOrderAddressHistories[] = $obj;
                        }
                    }
                }

                $this->collSalesOrderAddressHistories = $collSalesOrderAddressHistories;
                $this->collSalesOrderAddressHistoriesPartial = false;
            }
        }

        return $this->collSalesOrderAddressHistories;
    }

    /**
     * Sets a collection of SpySalesOrderAddressHistory objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $salesOrderAddressHistories A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSalesOrderAddressHistories(Collection $salesOrderAddressHistories, ?ConnectionInterface $con = null)
    {
        /** @var SpySalesOrderAddressHistory[] $salesOrderAddressHistoriesToDelete */
        $salesOrderAddressHistoriesToDelete = $this->getSalesOrderAddressHistories(new Criteria(), $con)->diff($salesOrderAddressHistories);


        $this->salesOrderAddressHistoriesScheduledForDeletion = $salesOrderAddressHistoriesToDelete;

        foreach ($salesOrderAddressHistoriesToDelete as $salesOrderAddressHistoryRemoved) {
            $salesOrderAddressHistoryRemoved->setCountry(null);
        }

        $this->collSalesOrderAddressHistories = null;
        foreach ($salesOrderAddressHistories as $salesOrderAddressHistory) {
            $this->addSalesOrderAddressHistory($salesOrderAddressHistory);
        }

        $this->collSalesOrderAddressHistories = $salesOrderAddressHistories;
        $this->collSalesOrderAddressHistoriesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpySalesOrderAddressHistory objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpySalesOrderAddressHistory objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSalesOrderAddressHistories(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSalesOrderAddressHistoriesPartial && !$this->isNew();
        if (null === $this->collSalesOrderAddressHistories || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSalesOrderAddressHistories) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSalesOrderAddressHistories());
            }

            $query = SpySalesOrderAddressHistoryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCountry($this)
                ->count($con);
        }

        return count($this->collSalesOrderAddressHistories);
    }

    /**
     * Method called to associate a SpySalesOrderAddressHistory object to this object
     * through the SpySalesOrderAddressHistory foreign key attribute.
     *
     * @param SpySalesOrderAddressHistory $l SpySalesOrderAddressHistory
     * @return $this The current object (for fluent API support)
     */
    public function addSalesOrderAddressHistory(SpySalesOrderAddressHistory $l)
    {
        if ($this->collSalesOrderAddressHistories === null) {
            $this->initSalesOrderAddressHistories();
            $this->collSalesOrderAddressHistoriesPartial = true;
        }

        if (!$this->collSalesOrderAddressHistories->contains($l)) {
            $this->doAddSalesOrderAddressHistory($l);

            if ($this->salesOrderAddressHistoriesScheduledForDeletion and $this->salesOrderAddressHistoriesScheduledForDeletion->contains($l)) {
                $this->salesOrderAddressHistoriesScheduledForDeletion->remove($this->salesOrderAddressHistoriesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpySalesOrderAddressHistory $salesOrderAddressHistory The SpySalesOrderAddressHistory object to add.
     */
    protected function doAddSalesOrderAddressHistory(SpySalesOrderAddressHistory $salesOrderAddressHistory): void
    {
        $this->collSalesOrderAddressHistories[]= $salesOrderAddressHistory;
        $salesOrderAddressHistory->setCountry($this);
    }

    /**
     * @param SpySalesOrderAddressHistory $salesOrderAddressHistory The SpySalesOrderAddressHistory object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSalesOrderAddressHistory(SpySalesOrderAddressHistory $salesOrderAddressHistory)
    {
        if ($this->getSalesOrderAddressHistories()->contains($salesOrderAddressHistory)) {
            $pos = $this->collSalesOrderAddressHistories->search($salesOrderAddressHistory);
            $this->collSalesOrderAddressHistories->remove($pos);
            if (null === $this->salesOrderAddressHistoriesScheduledForDeletion) {
                $this->salesOrderAddressHistoriesScheduledForDeletion = clone $this->collSalesOrderAddressHistories;
                $this->salesOrderAddressHistoriesScheduledForDeletion->clear();
            }
            $this->salesOrderAddressHistoriesScheduledForDeletion[]= clone $salesOrderAddressHistory;
            $salesOrderAddressHistory->setCountry(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCountry is new, it will return
     * an empty collection; or if this SpyCountry has previously
     * been saved, it will retrieve related SalesOrderAddressHistories from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCountry.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpySalesOrderAddressHistory[] List of SpySalesOrderAddressHistory objects
     * @phpstan-return ObjectCollection&\Traversable<SpySalesOrderAddressHistory}> List of SpySalesOrderAddressHistory objects
     */
    public function getSalesOrderAddressHistoriesJoinSalesOrderAddress(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpySalesOrderAddressHistoryQuery::create(null, $criteria);
        $query->joinWith('SalesOrderAddress', $joinBehavior);

        return $this->getSalesOrderAddressHistories($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCountry is new, it will return
     * an empty collection; or if this SpyCountry has previously
     * been saved, it will retrieve related SalesOrderAddressHistories from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCountry.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpySalesOrderAddressHistory[] List of SpySalesOrderAddressHistory objects
     * @phpstan-return ObjectCollection&\Traversable<SpySalesOrderAddressHistory}> List of SpySalesOrderAddressHistory objects
     */
    public function getSalesOrderAddressHistoriesJoinRegion(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpySalesOrderAddressHistoryQuery::create(null, $criteria);
        $query->joinWith('Region', $joinBehavior);

        return $this->getSalesOrderAddressHistories($query, $con);
    }

    /**
     * Clears out the collServicePointAddresses collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addServicePointAddresses()
     */
    public function clearServicePointAddresses()
    {
        $this->collServicePointAddresses = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collServicePointAddresses collection loaded partially.
     *
     * @return void
     */
    public function resetPartialServicePointAddresses($v = true): void
    {
        $this->collServicePointAddressesPartial = $v;
    }

    /**
     * Initializes the collServicePointAddresses collection.
     *
     * By default this just sets the collServicePointAddresses collection to an empty array (like clearcollServicePointAddresses());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initServicePointAddresses(bool $overrideExisting = true): void
    {
        if (null !== $this->collServicePointAddresses && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyServicePointAddressTableMap::getTableMap()->getCollectionClassName();

        $this->collServicePointAddresses = new $collectionClassName;
        $this->collServicePointAddresses->setModel('\Orm\Zed\ServicePoint\Persistence\SpyServicePointAddress');
    }

    /**
     * Gets an array of SpyServicePointAddress objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCountry is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyServicePointAddress[] List of SpyServicePointAddress objects
     * @phpstan-return ObjectCollection&\Traversable<SpyServicePointAddress> List of SpyServicePointAddress objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getServicePointAddresses(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collServicePointAddressesPartial && !$this->isNew();
        if (null === $this->collServicePointAddresses || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collServicePointAddresses) {
                    $this->initServicePointAddresses();
                } else {
                    $collectionClassName = SpyServicePointAddressTableMap::getTableMap()->getCollectionClassName();

                    $collServicePointAddresses = new $collectionClassName;
                    $collServicePointAddresses->setModel('\Orm\Zed\ServicePoint\Persistence\SpyServicePointAddress');

                    return $collServicePointAddresses;
                }
            } else {
                $collServicePointAddresses = SpyServicePointAddressQuery::create(null, $criteria)
                    ->filterByCountry($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collServicePointAddressesPartial && count($collServicePointAddresses)) {
                        $this->initServicePointAddresses(false);

                        foreach ($collServicePointAddresses as $obj) {
                            if (false == $this->collServicePointAddresses->contains($obj)) {
                                $this->collServicePointAddresses->append($obj);
                            }
                        }

                        $this->collServicePointAddressesPartial = true;
                    }

                    return $collServicePointAddresses;
                }

                if ($partial && $this->collServicePointAddresses) {
                    foreach ($this->collServicePointAddresses as $obj) {
                        if ($obj->isNew()) {
                            $collServicePointAddresses[] = $obj;
                        }
                    }
                }

                $this->collServicePointAddresses = $collServicePointAddresses;
                $this->collServicePointAddressesPartial = false;
            }
        }

        return $this->collServicePointAddresses;
    }

    /**
     * Sets a collection of SpyServicePointAddress objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $servicePointAddresses A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setServicePointAddresses(Collection $servicePointAddresses, ?ConnectionInterface $con = null)
    {
        /** @var SpyServicePointAddress[] $servicePointAddressesToDelete */
        $servicePointAddressesToDelete = $this->getServicePointAddresses(new Criteria(), $con)->diff($servicePointAddresses);


        $this->servicePointAddressesScheduledForDeletion = $servicePointAddressesToDelete;

        foreach ($servicePointAddressesToDelete as $servicePointAddressRemoved) {
            $servicePointAddressRemoved->setCountry(null);
        }

        $this->collServicePointAddresses = null;
        foreach ($servicePointAddresses as $servicePointAddress) {
            $this->addServicePointAddress($servicePointAddress);
        }

        $this->collServicePointAddresses = $servicePointAddresses;
        $this->collServicePointAddressesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyServicePointAddress objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyServicePointAddress objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countServicePointAddresses(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collServicePointAddressesPartial && !$this->isNew();
        if (null === $this->collServicePointAddresses || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collServicePointAddresses) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getServicePointAddresses());
            }

            $query = SpyServicePointAddressQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCountry($this)
                ->count($con);
        }

        return count($this->collServicePointAddresses);
    }

    /**
     * Method called to associate a SpyServicePointAddress object to this object
     * through the SpyServicePointAddress foreign key attribute.
     *
     * @param SpyServicePointAddress $l SpyServicePointAddress
     * @return $this The current object (for fluent API support)
     */
    public function addServicePointAddress(SpyServicePointAddress $l)
    {
        if ($this->collServicePointAddresses === null) {
            $this->initServicePointAddresses();
            $this->collServicePointAddressesPartial = true;
        }

        if (!$this->collServicePointAddresses->contains($l)) {
            $this->doAddServicePointAddress($l);

            if ($this->servicePointAddressesScheduledForDeletion and $this->servicePointAddressesScheduledForDeletion->contains($l)) {
                $this->servicePointAddressesScheduledForDeletion->remove($this->servicePointAddressesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyServicePointAddress $servicePointAddress The SpyServicePointAddress object to add.
     */
    protected function doAddServicePointAddress(SpyServicePointAddress $servicePointAddress): void
    {
        $this->collServicePointAddresses[]= $servicePointAddress;
        $servicePointAddress->setCountry($this);
    }

    /**
     * @param SpyServicePointAddress $servicePointAddress The SpyServicePointAddress object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeServicePointAddress(SpyServicePointAddress $servicePointAddress)
    {
        if ($this->getServicePointAddresses()->contains($servicePointAddress)) {
            $pos = $this->collServicePointAddresses->search($servicePointAddress);
            $this->collServicePointAddresses->remove($pos);
            if (null === $this->servicePointAddressesScheduledForDeletion) {
                $this->servicePointAddressesScheduledForDeletion = clone $this->collServicePointAddresses;
                $this->servicePointAddressesScheduledForDeletion->clear();
            }
            $this->servicePointAddressesScheduledForDeletion[]= clone $servicePointAddress;
            $servicePointAddress->setCountry(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCountry is new, it will return
     * an empty collection; or if this SpyCountry has previously
     * been saved, it will retrieve related ServicePointAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCountry.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyServicePointAddress[] List of SpyServicePointAddress objects
     * @phpstan-return ObjectCollection&\Traversable<SpyServicePointAddress}> List of SpyServicePointAddress objects
     */
    public function getServicePointAddressesJoinServicePoint(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyServicePointAddressQuery::create(null, $criteria);
        $query->joinWith('ServicePoint', $joinBehavior);

        return $this->getServicePointAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCountry is new, it will return
     * an empty collection; or if this SpyCountry has previously
     * been saved, it will retrieve related ServicePointAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCountry.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyServicePointAddress[] List of SpyServicePointAddress objects
     * @phpstan-return ObjectCollection&\Traversable<SpyServicePointAddress}> List of SpyServicePointAddress objects
     */
    public function getServicePointAddressesJoinRegion(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyServicePointAddressQuery::create(null, $criteria);
        $query->joinWith('Region', $joinBehavior);

        return $this->getServicePointAddresses($query, $con);
    }

    /**
     * Clears out the collStockAddresses collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addStockAddresses()
     */
    public function clearStockAddresses()
    {
        $this->collStockAddresses = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collStockAddresses collection loaded partially.
     *
     * @return void
     */
    public function resetPartialStockAddresses($v = true): void
    {
        $this->collStockAddressesPartial = $v;
    }

    /**
     * Initializes the collStockAddresses collection.
     *
     * By default this just sets the collStockAddresses collection to an empty array (like clearcollStockAddresses());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initStockAddresses(bool $overrideExisting = true): void
    {
        if (null !== $this->collStockAddresses && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyStockAddressTableMap::getTableMap()->getCollectionClassName();

        $this->collStockAddresses = new $collectionClassName;
        $this->collStockAddresses->setModel('\Orm\Zed\StockAddress\Persistence\SpyStockAddress');
    }

    /**
     * Gets an array of SpyStockAddress objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCountry is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyStockAddress[] List of SpyStockAddress objects
     * @phpstan-return ObjectCollection&\Traversable<SpyStockAddress> List of SpyStockAddress objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getStockAddresses(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collStockAddressesPartial && !$this->isNew();
        if (null === $this->collStockAddresses || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collStockAddresses) {
                    $this->initStockAddresses();
                } else {
                    $collectionClassName = SpyStockAddressTableMap::getTableMap()->getCollectionClassName();

                    $collStockAddresses = new $collectionClassName;
                    $collStockAddresses->setModel('\Orm\Zed\StockAddress\Persistence\SpyStockAddress');

                    return $collStockAddresses;
                }
            } else {
                $collStockAddresses = SpyStockAddressQuery::create(null, $criteria)
                    ->filterByCountry($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collStockAddressesPartial && count($collStockAddresses)) {
                        $this->initStockAddresses(false);

                        foreach ($collStockAddresses as $obj) {
                            if (false == $this->collStockAddresses->contains($obj)) {
                                $this->collStockAddresses->append($obj);
                            }
                        }

                        $this->collStockAddressesPartial = true;
                    }

                    return $collStockAddresses;
                }

                if ($partial && $this->collStockAddresses) {
                    foreach ($this->collStockAddresses as $obj) {
                        if ($obj->isNew()) {
                            $collStockAddresses[] = $obj;
                        }
                    }
                }

                $this->collStockAddresses = $collStockAddresses;
                $this->collStockAddressesPartial = false;
            }
        }

        return $this->collStockAddresses;
    }

    /**
     * Sets a collection of SpyStockAddress objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $stockAddresses A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setStockAddresses(Collection $stockAddresses, ?ConnectionInterface $con = null)
    {
        /** @var SpyStockAddress[] $stockAddressesToDelete */
        $stockAddressesToDelete = $this->getStockAddresses(new Criteria(), $con)->diff($stockAddresses);


        $this->stockAddressesScheduledForDeletion = $stockAddressesToDelete;

        foreach ($stockAddressesToDelete as $stockAddressRemoved) {
            $stockAddressRemoved->setCountry(null);
        }

        $this->collStockAddresses = null;
        foreach ($stockAddresses as $stockAddress) {
            $this->addStockAddress($stockAddress);
        }

        $this->collStockAddresses = $stockAddresses;
        $this->collStockAddressesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyStockAddress objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyStockAddress objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countStockAddresses(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collStockAddressesPartial && !$this->isNew();
        if (null === $this->collStockAddresses || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collStockAddresses) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getStockAddresses());
            }

            $query = SpyStockAddressQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCountry($this)
                ->count($con);
        }

        return count($this->collStockAddresses);
    }

    /**
     * Method called to associate a SpyStockAddress object to this object
     * through the SpyStockAddress foreign key attribute.
     *
     * @param SpyStockAddress $l SpyStockAddress
     * @return $this The current object (for fluent API support)
     */
    public function addStockAddress(SpyStockAddress $l)
    {
        if ($this->collStockAddresses === null) {
            $this->initStockAddresses();
            $this->collStockAddressesPartial = true;
        }

        if (!$this->collStockAddresses->contains($l)) {
            $this->doAddStockAddress($l);

            if ($this->stockAddressesScheduledForDeletion and $this->stockAddressesScheduledForDeletion->contains($l)) {
                $this->stockAddressesScheduledForDeletion->remove($this->stockAddressesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyStockAddress $stockAddress The SpyStockAddress object to add.
     */
    protected function doAddStockAddress(SpyStockAddress $stockAddress): void
    {
        $this->collStockAddresses[]= $stockAddress;
        $stockAddress->setCountry($this);
    }

    /**
     * @param SpyStockAddress $stockAddress The SpyStockAddress object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeStockAddress(SpyStockAddress $stockAddress)
    {
        if ($this->getStockAddresses()->contains($stockAddress)) {
            $pos = $this->collStockAddresses->search($stockAddress);
            $this->collStockAddresses->remove($pos);
            if (null === $this->stockAddressesScheduledForDeletion) {
                $this->stockAddressesScheduledForDeletion = clone $this->collStockAddresses;
                $this->stockAddressesScheduledForDeletion->clear();
            }
            $this->stockAddressesScheduledForDeletion[]= clone $stockAddress;
            $stockAddress->setCountry(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCountry is new, it will return
     * an empty collection; or if this SpyCountry has previously
     * been saved, it will retrieve related StockAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCountry.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyStockAddress[] List of SpyStockAddress objects
     * @phpstan-return ObjectCollection&\Traversable<SpyStockAddress}> List of SpyStockAddress objects
     */
    public function getStockAddressesJoinStock(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyStockAddressQuery::create(null, $criteria);
        $query->joinWith('Stock', $joinBehavior);

        return $this->getStockAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCountry is new, it will return
     * an empty collection; or if this SpyCountry has previously
     * been saved, it will retrieve related StockAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCountry.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyStockAddress[] List of SpyStockAddress objects
     * @phpstan-return ObjectCollection&\Traversable<SpyStockAddress}> List of SpyStockAddress objects
     */
    public function getStockAddressesJoinRegion(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyStockAddressQuery::create(null, $criteria);
        $query->joinWith('Region', $joinBehavior);

        return $this->getStockAddresses($query, $con);
    }

    /**
     * Clears out the collSpyTaxRates collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyTaxRates()
     */
    public function clearSpyTaxRates()
    {
        $this->collSpyTaxRates = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyTaxRates collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyTaxRates($v = true): void
    {
        $this->collSpyTaxRatesPartial = $v;
    }

    /**
     * Initializes the collSpyTaxRates collection.
     *
     * By default this just sets the collSpyTaxRates collection to an empty array (like clearcollSpyTaxRates());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyTaxRates(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyTaxRates && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyTaxRateTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyTaxRates = new $collectionClassName;
        $this->collSpyTaxRates->setModel('\Orm\Zed\Tax\Persistence\SpyTaxRate');
    }

    /**
     * Gets an array of SpyTaxRate objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCountry is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyTaxRate[] List of SpyTaxRate objects
     * @phpstan-return ObjectCollection&\Traversable<SpyTaxRate> List of SpyTaxRate objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyTaxRates(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyTaxRatesPartial && !$this->isNew();
        if (null === $this->collSpyTaxRates || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyTaxRates) {
                    $this->initSpyTaxRates();
                } else {
                    $collectionClassName = SpyTaxRateTableMap::getTableMap()->getCollectionClassName();

                    $collSpyTaxRates = new $collectionClassName;
                    $collSpyTaxRates->setModel('\Orm\Zed\Tax\Persistence\SpyTaxRate');

                    return $collSpyTaxRates;
                }
            } else {
                $collSpyTaxRates = SpyTaxRateQuery::create(null, $criteria)
                    ->filterByCountry($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyTaxRatesPartial && count($collSpyTaxRates)) {
                        $this->initSpyTaxRates(false);

                        foreach ($collSpyTaxRates as $obj) {
                            if (false == $this->collSpyTaxRates->contains($obj)) {
                                $this->collSpyTaxRates->append($obj);
                            }
                        }

                        $this->collSpyTaxRatesPartial = true;
                    }

                    return $collSpyTaxRates;
                }

                if ($partial && $this->collSpyTaxRates) {
                    foreach ($this->collSpyTaxRates as $obj) {
                        if ($obj->isNew()) {
                            $collSpyTaxRates[] = $obj;
                        }
                    }
                }

                $this->collSpyTaxRates = $collSpyTaxRates;
                $this->collSpyTaxRatesPartial = false;
            }
        }

        return $this->collSpyTaxRates;
    }

    /**
     * Sets a collection of SpyTaxRate objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyTaxRates A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyTaxRates(Collection $spyTaxRates, ?ConnectionInterface $con = null)
    {
        /** @var SpyTaxRate[] $spyTaxRatesToDelete */
        $spyTaxRatesToDelete = $this->getSpyTaxRates(new Criteria(), $con)->diff($spyTaxRates);


        $this->spyTaxRatesScheduledForDeletion = $spyTaxRatesToDelete;

        foreach ($spyTaxRatesToDelete as $spyTaxRateRemoved) {
            $spyTaxRateRemoved->setCountry(null);
        }

        $this->collSpyTaxRates = null;
        foreach ($spyTaxRates as $spyTaxRate) {
            $this->addSpyTaxRate($spyTaxRate);
        }

        $this->collSpyTaxRates = $spyTaxRates;
        $this->collSpyTaxRatesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyTaxRate objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyTaxRate objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyTaxRates(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyTaxRatesPartial && !$this->isNew();
        if (null === $this->collSpyTaxRates || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyTaxRates) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyTaxRates());
            }

            $query = SpyTaxRateQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCountry($this)
                ->count($con);
        }

        return count($this->collSpyTaxRates);
    }

    /**
     * Method called to associate a SpyTaxRate object to this object
     * through the SpyTaxRate foreign key attribute.
     *
     * @param SpyTaxRate $l SpyTaxRate
     * @return $this The current object (for fluent API support)
     */
    public function addSpyTaxRate(SpyTaxRate $l)
    {
        if ($this->collSpyTaxRates === null) {
            $this->initSpyTaxRates();
            $this->collSpyTaxRatesPartial = true;
        }

        if (!$this->collSpyTaxRates->contains($l)) {
            $this->doAddSpyTaxRate($l);

            if ($this->spyTaxRatesScheduledForDeletion and $this->spyTaxRatesScheduledForDeletion->contains($l)) {
                $this->spyTaxRatesScheduledForDeletion->remove($this->spyTaxRatesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyTaxRate $spyTaxRate The SpyTaxRate object to add.
     */
    protected function doAddSpyTaxRate(SpyTaxRate $spyTaxRate): void
    {
        $this->collSpyTaxRates[]= $spyTaxRate;
        $spyTaxRate->setCountry($this);
    }

    /**
     * @param SpyTaxRate $spyTaxRate The SpyTaxRate object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyTaxRate(SpyTaxRate $spyTaxRate)
    {
        if ($this->getSpyTaxRates()->contains($spyTaxRate)) {
            $pos = $this->collSpyTaxRates->search($spyTaxRate);
            $this->collSpyTaxRates->remove($pos);
            if (null === $this->spyTaxRatesScheduledForDeletion) {
                $this->spyTaxRatesScheduledForDeletion = clone $this->collSpyTaxRates;
                $this->spyTaxRatesScheduledForDeletion->clear();
            }
            $this->spyTaxRatesScheduledForDeletion[]= $spyTaxRate;
            $spyTaxRate->setCountry(null);
        }

        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     *
     * @return $this
     */
    public function clear()
    {
        $this->id_country = null;
        $this->iso2_code = null;
        $this->iso3_code = null;
        $this->name = null;
        $this->postal_code_mandatory = null;
        $this->postal_code_regex = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);

        return $this;
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param bool $deep Whether to also clear the references on all referrer objects.
     * @return $this
     */
    public function clearAllReferences(bool $deep = false)
    {
        if ($deep) {
            if ($this->collCompanyUnitAddresses) {
                foreach ($this->collCompanyUnitAddresses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyRegions) {
                foreach ($this->collSpyRegions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCountryStores) {
                foreach ($this->collCountryStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCustomerAddresses) {
                foreach ($this->collCustomerAddresses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyMerchantProfileAddresses) {
                foreach ($this->collSpyMerchantProfileAddresses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyMerchantRegistrationRequests) {
                foreach ($this->collSpyMerchantRegistrationRequests as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSalesOrderAddresses) {
                foreach ($this->collSalesOrderAddresses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSalesOrderAddressHistories) {
                foreach ($this->collSalesOrderAddressHistories as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collServicePointAddresses) {
                foreach ($this->collServicePointAddresses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collStockAddresses) {
                foreach ($this->collStockAddresses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyTaxRates) {
                foreach ($this->collSpyTaxRates as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collCompanyUnitAddresses = null;
        $this->collSpyRegions = null;
        $this->collCountryStores = null;
        $this->collCustomerAddresses = null;
        $this->collSpyMerchantProfileAddresses = null;
        $this->collSpyMerchantRegistrationRequests = null;
        $this->collSalesOrderAddresses = null;
        $this->collSalesOrderAddressHistories = null;
        $this->collServicePointAddresses = null;
        $this->collStockAddresses = null;
        $this->collSpyTaxRates = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyCountryTableMap::DEFAULT_STRING_FORMAT);
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

    /**
     * Code to be run before persisting the object
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preSave(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run before inserting to database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preInsert(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postInsert(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before updating the object in database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preUpdate(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run before deleting the object in database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preDelete(?ConnectionInterface $con = null): bool
    {
                return true;
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);
            $inputData = $params[0];
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->importFrom($format, $inputData, $keyType);
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = $params[0] ?? true;
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->exportTo($format, $includeLazyLoadColumns, $keyType);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
