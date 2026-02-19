<?php

namespace Orm\Zed\CompanyUnitAddress\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery;
use Orm\Zed\CompanyBusinessUnit\Persistence\Base\SpyCompanyBusinessUnit as BaseSpyCompanyBusinessUnit;
use Orm\Zed\CompanyBusinessUnit\Persistence\Map\SpyCompanyBusinessUnitTableMap;
use Orm\Zed\CompanyUnitAddressLabel\Persistence\SpyCompanyUnitAddressLabelToCompanyUnitAddress;
use Orm\Zed\CompanyUnitAddressLabel\Persistence\SpyCompanyUnitAddressLabelToCompanyUnitAddressQuery;
use Orm\Zed\CompanyUnitAddressLabel\Persistence\Base\SpyCompanyUnitAddressLabelToCompanyUnitAddress as BaseSpyCompanyUnitAddressLabelToCompanyUnitAddress;
use Orm\Zed\CompanyUnitAddressLabel\Persistence\Map\SpyCompanyUnitAddressLabelToCompanyUnitAddressTableMap;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress as ChildSpyCompanyUnitAddress;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery as ChildSpyCompanyUnitAddressQuery;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressToCompanyBusinessUnit as ChildSpyCompanyUnitAddressToCompanyBusinessUnit;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressToCompanyBusinessUnitQuery as ChildSpyCompanyUnitAddressToCompanyBusinessUnitQuery;
use Orm\Zed\CompanyUnitAddress\Persistence\Map\SpyCompanyUnitAddressTableMap;
use Orm\Zed\CompanyUnitAddress\Persistence\Map\SpyCompanyUnitAddressToCompanyBusinessUnitTableMap;
use Orm\Zed\Company\Persistence\SpyCompany;
use Orm\Zed\Company\Persistence\SpyCompanyQuery;
use Orm\Zed\Country\Persistence\SpyCountry;
use Orm\Zed\Country\Persistence\SpyCountryQuery;
use Orm\Zed\Country\Persistence\SpyRegion;
use Orm\Zed\Country\Persistence\SpyRegionQuery;
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
 * Base class that represents a row from the 'spy_company_unit_address' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.CompanyUnitAddress.Persistence.Base
 */
abstract class SpyCompanyUnitAddress implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\CompanyUnitAddress\\Persistence\\Map\\SpyCompanyUnitAddressTableMap';


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
     * The value for the id_company_unit_address field.
     *
     * @var        int
     */
    protected $id_company_unit_address;

    /**
     * The value for the fk_company field.
     *
     * @var        int|null
     */
    protected $fk_company;

    /**
     * The value for the fk_country field.
     *
     * @var        int
     */
    protected $fk_country;

    /**
     * The value for the fk_region field.
     *
     * @var        int|null
     */
    protected $fk_region;

    /**
     * The value for the address1 field.
     * The first line of a street address.
     * @var        string|null
     */
    protected $address1;

    /**
     * The value for the address2 field.
     * The second line of a street address.
     * @var        string|null
     */
    protected $address2;

    /**
     * The value for the address3 field.
     * The third line of a street address.
     * @var        string|null
     */
    protected $address3;

    /**
     * The value for the city field.
     * The city part of an address.
     * @var        string|null
     */
    protected $city;

    /**
     * The value for the comment field.
     * A user-submitted comment or note.
     * @var        string|null
     */
    protected $comment;

    /**
     * The value for the key field.
     * Key is used for DataImport as identifier for existing entities. This should never be changed.
     * @var        string|null
     */
    protected $key;

    /**
     * The value for the phone field.
     * The phone number.
     * @var        string|null
     */
    protected $phone;

    /**
     * The value for the uuid field.
     * A Universally Unique Identifier for an entity.
     * @var        string|null
     */
    protected $uuid;

    /**
     * The value for the zip_code field.
     * The postal code for an address.
     * @var        string|null
     */
    protected $zip_code;

    /**
     * @var        SpyCountry
     */
    protected $aCountry;

    /**
     * @var        SpyRegion
     */
    protected $aRegion;

    /**
     * @var        SpyCompany
     */
    protected $aCompany;

    /**
     * @var        ObjectCollection|SpyCompanyBusinessUnit[] Collection to store aggregation of SpyCompanyBusinessUnit objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyBusinessUnit> Collection to store aggregation of SpyCompanyBusinessUnit objects.
     */
    protected $collSpyCompanyBusinessUnits;
    protected $collSpyCompanyBusinessUnitsPartial;

    /**
     * @var        ObjectCollection|ChildSpyCompanyUnitAddressToCompanyBusinessUnit[] Collection to store aggregation of ChildSpyCompanyUnitAddressToCompanyBusinessUnit objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCompanyUnitAddressToCompanyBusinessUnit> Collection to store aggregation of ChildSpyCompanyUnitAddressToCompanyBusinessUnit objects.
     */
    protected $collSpyCompanyUnitAddressToCompanyBusinessUnits;
    protected $collSpyCompanyUnitAddressToCompanyBusinessUnitsPartial;

    /**
     * @var        ObjectCollection|SpyCompanyUnitAddressLabelToCompanyUnitAddress[] Collection to store aggregation of SpyCompanyUnitAddressLabelToCompanyUnitAddress objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyUnitAddressLabelToCompanyUnitAddress> Collection to store aggregation of SpyCompanyUnitAddressLabelToCompanyUnitAddress objects.
     */
    protected $collSpyCompanyUnitAddressLabelToCompanyUnitAddresses;
    protected $collSpyCompanyUnitAddressLabelToCompanyUnitAddressesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    // uuid behavior
    /**
     * @var \Spryker\Service\UtilUuidGenerator\UtilUuidGeneratorServiceInterface
     */
    protected static $_uuidGeneratorService;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCompanyBusinessUnit[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyBusinessUnit>
     */
    protected $spyCompanyBusinessUnitsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyCompanyUnitAddressToCompanyBusinessUnit[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCompanyUnitAddressToCompanyBusinessUnit>
     */
    protected $spyCompanyUnitAddressToCompanyBusinessUnitsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCompanyUnitAddressLabelToCompanyUnitAddress[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyUnitAddressLabelToCompanyUnitAddress>
     */
    protected $spyCompanyUnitAddressLabelToCompanyUnitAddressesScheduledForDeletion = null;

    /**
     * Initializes internal state of Orm\Zed\CompanyUnitAddress\Persistence\Base\SpyCompanyUnitAddress object.
     */
    public function __construct()
    {
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
     * Compares this with another <code>SpyCompanyUnitAddress</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyCompanyUnitAddress</code>, delegates to
     * <code>equals(SpyCompanyUnitAddress)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_company_unit_address] column value.
     *
     * @return int
     */
    public function getIdCompanyUnitAddress()
    {
        return $this->id_company_unit_address;
    }

    /**
     * Get the [fk_company] column value.
     *
     * @return int|null
     */
    public function getFkCompany()
    {
        return $this->fk_company;
    }

    /**
     * Get the [fk_country] column value.
     *
     * @return int
     */
    public function getFkCountry()
    {
        return $this->fk_country;
    }

    /**
     * Get the [fk_region] column value.
     *
     * @return int|null
     */
    public function getFkRegion()
    {
        return $this->fk_region;
    }

    /**
     * Get the [address1] column value.
     * The first line of a street address.
     * @return string|null
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * Get the [address2] column value.
     * The second line of a street address.
     * @return string|null
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Get the [address3] column value.
     * The third line of a street address.
     * @return string|null
     */
    public function getAddress3()
    {
        return $this->address3;
    }

    /**
     * Get the [city] column value.
     * The city part of an address.
     * @return string|null
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Get the [comment] column value.
     * A user-submitted comment or note.
     * @return string|null
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Get the [key] column value.
     * Key is used for DataImport as identifier for existing entities. This should never be changed.
     * @return string|null
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Get the [phone] column value.
     * The phone number.
     * @return string|null
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Get the [uuid] column value.
     * A Universally Unique Identifier for an entity.
     * @return string|null
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Get the [zip_code] column value.
     * The postal code for an address.
     * @return string|null
     */
    public function getZipCode()
    {
        return $this->zip_code;
    }

    /**
     * Set the value of [id_company_unit_address] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdCompanyUnitAddress($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_company_unit_address !== $v) {
            $this->id_company_unit_address = $v;
            $this->modifiedColumns[SpyCompanyUnitAddressTableMap::COL_ID_COMPANY_UNIT_ADDRESS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_company] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkCompany($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_company !== $v) {
            $this->fk_company = $v;
            $this->modifiedColumns[SpyCompanyUnitAddressTableMap::COL_FK_COMPANY] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getIdCompany() !== $v) {
            $this->aCompany = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_country] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkCountry($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_country !== $v) {
            $this->fk_country = $v;
            $this->modifiedColumns[SpyCompanyUnitAddressTableMap::COL_FK_COUNTRY] = true;
        }

        if ($this->aCountry !== null && $this->aCountry->getIdCountry() !== $v) {
            $this->aCountry = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_region] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkRegion($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_region !== $v) {
            $this->fk_region = $v;
            $this->modifiedColumns[SpyCompanyUnitAddressTableMap::COL_FK_REGION] = true;
        }

        if ($this->aRegion !== null && $this->aRegion->getIdRegion() !== $v) {
            $this->aRegion = null;
        }

        return $this;
    }

    /**
     * Set the value of [address1] column.
     * The first line of a street address.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAddress1($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->address1 !== $v) {
            $this->address1 = $v;
            $this->modifiedColumns[SpyCompanyUnitAddressTableMap::COL_ADDRESS1] = true;
        }

        return $this;
    }

    /**
     * Set the value of [address2] column.
     * The second line of a street address.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAddress2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->address2 !== $v) {
            $this->address2 = $v;
            $this->modifiedColumns[SpyCompanyUnitAddressTableMap::COL_ADDRESS2] = true;
        }

        return $this;
    }

    /**
     * Set the value of [address3] column.
     * The third line of a street address.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAddress3($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->address3 !== $v) {
            $this->address3 = $v;
            $this->modifiedColumns[SpyCompanyUnitAddressTableMap::COL_ADDRESS3] = true;
        }

        return $this;
    }

    /**
     * Set the value of [city] column.
     * The city part of an address.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCity($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->city !== $v) {
            $this->city = $v;
            $this->modifiedColumns[SpyCompanyUnitAddressTableMap::COL_CITY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [comment] column.
     * A user-submitted comment or note.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setComment($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->comment !== $v) {
            $this->comment = $v;
            $this->modifiedColumns[SpyCompanyUnitAddressTableMap::COL_COMMENT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [key] column.
     * Key is used for DataImport as identifier for existing entities. This should never be changed.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setKey($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->key !== $v) {
            $this->key = $v;
            $this->modifiedColumns[SpyCompanyUnitAddressTableMap::COL_KEY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [phone] column.
     * The phone number.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPhone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->phone !== $v) {
            $this->phone = $v;
            $this->modifiedColumns[SpyCompanyUnitAddressTableMap::COL_PHONE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [uuid] column.
     * A Universally Unique Identifier for an entity.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setUuid($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->uuid !== $v) {
            $this->uuid = $v;
            $this->modifiedColumns[SpyCompanyUnitAddressTableMap::COL_UUID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [zip_code] column.
     * The postal code for an address.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setZipCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->zip_code !== $v) {
            $this->zip_code = $v;
            $this->modifiedColumns[SpyCompanyUnitAddressTableMap::COL_ZIP_CODE] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyCompanyUnitAddressTableMap::translateFieldName('IdCompanyUnitAddress', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_company_unit_address = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyCompanyUnitAddressTableMap::translateFieldName('FkCompany', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_company = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyCompanyUnitAddressTableMap::translateFieldName('FkCountry', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_country = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyCompanyUnitAddressTableMap::translateFieldName('FkRegion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_region = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyCompanyUnitAddressTableMap::translateFieldName('Address1', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address1 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyCompanyUnitAddressTableMap::translateFieldName('Address2', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address2 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpyCompanyUnitAddressTableMap::translateFieldName('Address3', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address3 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpyCompanyUnitAddressTableMap::translateFieldName('City', TableMap::TYPE_PHPNAME, $indexType)];
            $this->city = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SpyCompanyUnitAddressTableMap::translateFieldName('Comment', TableMap::TYPE_PHPNAME, $indexType)];
            $this->comment = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SpyCompanyUnitAddressTableMap::translateFieldName('Key', TableMap::TYPE_PHPNAME, $indexType)];
            $this->key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SpyCompanyUnitAddressTableMap::translateFieldName('Phone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->phone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : SpyCompanyUnitAddressTableMap::translateFieldName('Uuid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->uuid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : SpyCompanyUnitAddressTableMap::translateFieldName('ZipCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->zip_code = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 13; // 13 = SpyCompanyUnitAddressTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\CompanyUnitAddress\\Persistence\\SpyCompanyUnitAddress'), 0, $e);
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
        if ($this->aCompany !== null && $this->fk_company !== $this->aCompany->getIdCompany()) {
            $this->aCompany = null;
        }
        if ($this->aCountry !== null && $this->fk_country !== $this->aCountry->getIdCountry()) {
            $this->aCountry = null;
        }
        if ($this->aRegion !== null && $this->fk_region !== $this->aRegion->getIdRegion()) {
            $this->aRegion = null;
        }
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyCompanyUnitAddressTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyCompanyUnitAddressQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCountry = null;
            $this->aRegion = null;
            $this->aCompany = null;
            $this->collSpyCompanyBusinessUnits = null;

            $this->collSpyCompanyUnitAddressToCompanyBusinessUnits = null;

            $this->collSpyCompanyUnitAddressLabelToCompanyUnitAddresses = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyCompanyUnitAddress::setDeleted()
     * @see SpyCompanyUnitAddress::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCompanyUnitAddressTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyCompanyUnitAddressQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCompanyUnitAddressTableMap::DATABASE_NAME);
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
                // uuid behavior
                $this->updateUuidBeforeUpdate();
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
                    // uuid behavior
                    $this->updateUuidAfterInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                SpyCompanyUnitAddressTableMap::addInstanceToPool($this);
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

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aCountry !== null) {
                if ($this->aCountry->isModified() || $this->aCountry->isNew()) {
                    $affectedRows += $this->aCountry->save($con);
                }
                $this->setCountry($this->aCountry);
            }

            if ($this->aRegion !== null) {
                if ($this->aRegion->isModified() || $this->aRegion->isNew()) {
                    $affectedRows += $this->aRegion->save($con);
                }
                $this->setRegion($this->aRegion);
            }

            if ($this->aCompany !== null) {
                if ($this->aCompany->isModified() || $this->aCompany->isNew()) {
                    $affectedRows += $this->aCompany->save($con);
                }
                $this->setCompany($this->aCompany);
            }

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

            if ($this->spyCompanyBusinessUnitsScheduledForDeletion !== null) {
                if (!$this->spyCompanyBusinessUnitsScheduledForDeletion->isEmpty()) {
                    foreach ($this->spyCompanyBusinessUnitsScheduledForDeletion as $spyCompanyBusinessUnit) {
                        // need to save related object because we set the relation to null
                        $spyCompanyBusinessUnit->save($con);
                    }
                    $this->spyCompanyBusinessUnitsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCompanyBusinessUnits !== null) {
                foreach ($this->collSpyCompanyBusinessUnits as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyCompanyUnitAddressToCompanyBusinessUnitsScheduledForDeletion !== null) {
                if (!$this->spyCompanyUnitAddressToCompanyBusinessUnitsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressToCompanyBusinessUnitQuery::create()
                        ->filterByPrimaryKeys($this->spyCompanyUnitAddressToCompanyBusinessUnitsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyCompanyUnitAddressToCompanyBusinessUnitsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCompanyUnitAddressToCompanyBusinessUnits !== null) {
                foreach ($this->collSpyCompanyUnitAddressToCompanyBusinessUnits as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyCompanyUnitAddressLabelToCompanyUnitAddressesScheduledForDeletion !== null) {
                if (!$this->spyCompanyUnitAddressLabelToCompanyUnitAddressesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\CompanyUnitAddressLabel\Persistence\SpyCompanyUnitAddressLabelToCompanyUnitAddressQuery::create()
                        ->filterByPrimaryKeys($this->spyCompanyUnitAddressLabelToCompanyUnitAddressesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyCompanyUnitAddressLabelToCompanyUnitAddressesScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCompanyUnitAddressLabelToCompanyUnitAddresses !== null) {
                foreach ($this->collSpyCompanyUnitAddressLabelToCompanyUnitAddresses as $referrerFK) {
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

        $this->modifiedColumns[SpyCompanyUnitAddressTableMap::COL_ID_COMPANY_UNIT_ADDRESS] = true;
        if (null !== $this->id_company_unit_address) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyCompanyUnitAddressTableMap::COL_ID_COMPANY_UNIT_ADDRESS . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyCompanyUnitAddressTableMap::COL_ID_COMPANY_UNIT_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = '`id_company_unit_address`';
        }
        if ($this->isColumnModified(SpyCompanyUnitAddressTableMap::COL_FK_COMPANY)) {
            $modifiedColumns[':p' . $index++]  = '`fk_company`';
        }
        if ($this->isColumnModified(SpyCompanyUnitAddressTableMap::COL_FK_COUNTRY)) {
            $modifiedColumns[':p' . $index++]  = '`fk_country`';
        }
        if ($this->isColumnModified(SpyCompanyUnitAddressTableMap::COL_FK_REGION)) {
            $modifiedColumns[':p' . $index++]  = '`fk_region`';
        }
        if ($this->isColumnModified(SpyCompanyUnitAddressTableMap::COL_ADDRESS1)) {
            $modifiedColumns[':p' . $index++]  = '`address1`';
        }
        if ($this->isColumnModified(SpyCompanyUnitAddressTableMap::COL_ADDRESS2)) {
            $modifiedColumns[':p' . $index++]  = '`address2`';
        }
        if ($this->isColumnModified(SpyCompanyUnitAddressTableMap::COL_ADDRESS3)) {
            $modifiedColumns[':p' . $index++]  = '`address3`';
        }
        if ($this->isColumnModified(SpyCompanyUnitAddressTableMap::COL_CITY)) {
            $modifiedColumns[':p' . $index++]  = '`city`';
        }
        if ($this->isColumnModified(SpyCompanyUnitAddressTableMap::COL_COMMENT)) {
            $modifiedColumns[':p' . $index++]  = '`comment`';
        }
        if ($this->isColumnModified(SpyCompanyUnitAddressTableMap::COL_KEY)) {
            $modifiedColumns[':p' . $index++]  = '`key`';
        }
        if ($this->isColumnModified(SpyCompanyUnitAddressTableMap::COL_PHONE)) {
            $modifiedColumns[':p' . $index++]  = '`phone`';
        }
        if ($this->isColumnModified(SpyCompanyUnitAddressTableMap::COL_UUID)) {
            $modifiedColumns[':p' . $index++]  = '`uuid`';
        }
        if ($this->isColumnModified(SpyCompanyUnitAddressTableMap::COL_ZIP_CODE)) {
            $modifiedColumns[':p' . $index++]  = '`zip_code`';
        }

        $sql = sprintf(
            'INSERT INTO `spy_company_unit_address` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id_company_unit_address`':
                        $stmt->bindValue($identifier, $this->id_company_unit_address, PDO::PARAM_INT);

                        break;
                    case '`fk_company`':
                        $stmt->bindValue($identifier, $this->fk_company, PDO::PARAM_INT);

                        break;
                    case '`fk_country`':
                        $stmt->bindValue($identifier, $this->fk_country, PDO::PARAM_INT);

                        break;
                    case '`fk_region`':
                        $stmt->bindValue($identifier, $this->fk_region, PDO::PARAM_INT);

                        break;
                    case '`address1`':
                        $stmt->bindValue($identifier, $this->address1, PDO::PARAM_STR);

                        break;
                    case '`address2`':
                        $stmt->bindValue($identifier, $this->address2, PDO::PARAM_STR);

                        break;
                    case '`address3`':
                        $stmt->bindValue($identifier, $this->address3, PDO::PARAM_STR);

                        break;
                    case '`city`':
                        $stmt->bindValue($identifier, $this->city, PDO::PARAM_STR);

                        break;
                    case '`comment`':
                        $stmt->bindValue($identifier, $this->comment, PDO::PARAM_STR);

                        break;
                    case '`key`':
                        $stmt->bindValue($identifier, $this->key, PDO::PARAM_STR);

                        break;
                    case '`phone`':
                        $stmt->bindValue($identifier, $this->phone, PDO::PARAM_STR);

                        break;
                    case '`uuid`':
                        $stmt->bindValue($identifier, $this->uuid, PDO::PARAM_STR);

                        break;
                    case '`zip_code`':
                        $stmt->bindValue($identifier, $this->zip_code, PDO::PARAM_STR);

                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId('spy_company_unit_address_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdCompanyUnitAddress($pk);

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
        $pos = SpyCompanyUnitAddressTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdCompanyUnitAddress();

            case 1:
                return $this->getFkCompany();

            case 2:
                return $this->getFkCountry();

            case 3:
                return $this->getFkRegion();

            case 4:
                return $this->getAddress1();

            case 5:
                return $this->getAddress2();

            case 6:
                return $this->getAddress3();

            case 7:
                return $this->getCity();

            case 8:
                return $this->getComment();

            case 9:
                return $this->getKey();

            case 10:
                return $this->getPhone();

            case 11:
                return $this->getUuid();

            case 12:
                return $this->getZipCode();

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
        if (isset($alreadyDumpedObjects['SpyCompanyUnitAddress'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyCompanyUnitAddress'][$this->hashCode()] = true;
        $keys = SpyCompanyUnitAddressTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdCompanyUnitAddress(),
            $keys[1] => $this->getFkCompany(),
            $keys[2] => $this->getFkCountry(),
            $keys[3] => $this->getFkRegion(),
            $keys[4] => $this->getAddress1(),
            $keys[5] => $this->getAddress2(),
            $keys[6] => $this->getAddress3(),
            $keys[7] => $this->getCity(),
            $keys[8] => $this->getComment(),
            $keys[9] => $this->getKey(),
            $keys[10] => $this->getPhone(),
            $keys[11] => $this->getUuid(),
            $keys[12] => $this->getZipCode(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aCountry) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCountry';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_country';
                        break;
                    default:
                        $key = 'Country';
                }

                $result[$key] = $this->aCountry->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aRegion) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyRegion';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_region';
                        break;
                    default:
                        $key = 'Region';
                }

                $result[$key] = $this->aRegion->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aCompany) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCompany';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_company';
                        break;
                    default:
                        $key = 'Company';
                }

                $result[$key] = $this->aCompany->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collSpyCompanyBusinessUnits) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCompanyBusinessUnits';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_company_business_units';
                        break;
                    default:
                        $key = 'SpyCompanyBusinessUnits';
                }

                $result[$key] = $this->collSpyCompanyBusinessUnits->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyCompanyUnitAddressToCompanyBusinessUnits) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCompanyUnitAddressToCompanyBusinessUnits';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_company_unit_address_to_company_business_units';
                        break;
                    default:
                        $key = 'SpyCompanyUnitAddressToCompanyBusinessUnits';
                }

                $result[$key] = $this->collSpyCompanyUnitAddressToCompanyBusinessUnits->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyCompanyUnitAddressLabelToCompanyUnitAddresses) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCompanyUnitAddressLabelToCompanyUnitAddresses';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_company_unit_address_label_to_company_unit_addresses';
                        break;
                    default:
                        $key = 'SpyCompanyUnitAddressLabelToCompanyUnitAddresses';
                }

                $result[$key] = $this->collSpyCompanyUnitAddressLabelToCompanyUnitAddresses->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyCompanyUnitAddressTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdCompanyUnitAddress($value);
                break;
            case 1:
                $this->setFkCompany($value);
                break;
            case 2:
                $this->setFkCountry($value);
                break;
            case 3:
                $this->setFkRegion($value);
                break;
            case 4:
                $this->setAddress1($value);
                break;
            case 5:
                $this->setAddress2($value);
                break;
            case 6:
                $this->setAddress3($value);
                break;
            case 7:
                $this->setCity($value);
                break;
            case 8:
                $this->setComment($value);
                break;
            case 9:
                $this->setKey($value);
                break;
            case 10:
                $this->setPhone($value);
                break;
            case 11:
                $this->setUuid($value);
                break;
            case 12:
                $this->setZipCode($value);
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
        $keys = SpyCompanyUnitAddressTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdCompanyUnitAddress($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkCompany($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setFkCountry($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setFkRegion($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setAddress1($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setAddress2($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setAddress3($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setCity($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setComment($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setKey($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setPhone($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setUuid($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setZipCode($arr[$keys[12]]);
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
        $criteria = new Criteria(SpyCompanyUnitAddressTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyCompanyUnitAddressTableMap::COL_ID_COMPANY_UNIT_ADDRESS)) {
            $criteria->add(SpyCompanyUnitAddressTableMap::COL_ID_COMPANY_UNIT_ADDRESS, $this->id_company_unit_address);
        }
        if ($this->isColumnModified(SpyCompanyUnitAddressTableMap::COL_FK_COMPANY)) {
            $criteria->add(SpyCompanyUnitAddressTableMap::COL_FK_COMPANY, $this->fk_company);
        }
        if ($this->isColumnModified(SpyCompanyUnitAddressTableMap::COL_FK_COUNTRY)) {
            $criteria->add(SpyCompanyUnitAddressTableMap::COL_FK_COUNTRY, $this->fk_country);
        }
        if ($this->isColumnModified(SpyCompanyUnitAddressTableMap::COL_FK_REGION)) {
            $criteria->add(SpyCompanyUnitAddressTableMap::COL_FK_REGION, $this->fk_region);
        }
        if ($this->isColumnModified(SpyCompanyUnitAddressTableMap::COL_ADDRESS1)) {
            $criteria->add(SpyCompanyUnitAddressTableMap::COL_ADDRESS1, $this->address1);
        }
        if ($this->isColumnModified(SpyCompanyUnitAddressTableMap::COL_ADDRESS2)) {
            $criteria->add(SpyCompanyUnitAddressTableMap::COL_ADDRESS2, $this->address2);
        }
        if ($this->isColumnModified(SpyCompanyUnitAddressTableMap::COL_ADDRESS3)) {
            $criteria->add(SpyCompanyUnitAddressTableMap::COL_ADDRESS3, $this->address3);
        }
        if ($this->isColumnModified(SpyCompanyUnitAddressTableMap::COL_CITY)) {
            $criteria->add(SpyCompanyUnitAddressTableMap::COL_CITY, $this->city);
        }
        if ($this->isColumnModified(SpyCompanyUnitAddressTableMap::COL_COMMENT)) {
            $criteria->add(SpyCompanyUnitAddressTableMap::COL_COMMENT, $this->comment);
        }
        if ($this->isColumnModified(SpyCompanyUnitAddressTableMap::COL_KEY)) {
            $criteria->add(SpyCompanyUnitAddressTableMap::COL_KEY, $this->key);
        }
        if ($this->isColumnModified(SpyCompanyUnitAddressTableMap::COL_PHONE)) {
            $criteria->add(SpyCompanyUnitAddressTableMap::COL_PHONE, $this->phone);
        }
        if ($this->isColumnModified(SpyCompanyUnitAddressTableMap::COL_UUID)) {
            $criteria->add(SpyCompanyUnitAddressTableMap::COL_UUID, $this->uuid);
        }
        if ($this->isColumnModified(SpyCompanyUnitAddressTableMap::COL_ZIP_CODE)) {
            $criteria->add(SpyCompanyUnitAddressTableMap::COL_ZIP_CODE, $this->zip_code);
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
        $criteria = ChildSpyCompanyUnitAddressQuery::create();
        $criteria->add(SpyCompanyUnitAddressTableMap::COL_ID_COMPANY_UNIT_ADDRESS, $this->id_company_unit_address);

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
        $validPk = null !== $this->getIdCompanyUnitAddress();

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
        return $this->getIdCompanyUnitAddress();
    }

    /**
     * Generic method to set the primary key (id_company_unit_address column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdCompanyUnitAddress($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdCompanyUnitAddress();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkCompany($this->getFkCompany());
        $copyObj->setFkCountry($this->getFkCountry());
        $copyObj->setFkRegion($this->getFkRegion());
        $copyObj->setAddress1($this->getAddress1());
        $copyObj->setAddress2($this->getAddress2());
        $copyObj->setAddress3($this->getAddress3());
        $copyObj->setCity($this->getCity());
        $copyObj->setComment($this->getComment());
        $copyObj->setKey($this->getKey());
        $copyObj->setPhone($this->getPhone());
        $copyObj->setUuid($this->getUuid());
        $copyObj->setZipCode($this->getZipCode());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyCompanyBusinessUnits() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCompanyBusinessUnit($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyCompanyUnitAddressToCompanyBusinessUnits() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCompanyUnitAddressToCompanyBusinessUnit($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyCompanyUnitAddressLabelToCompanyUnitAddresses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCompanyUnitAddressLabelToCompanyUnitAddress($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdCompanyUnitAddress(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress Clone of current object.
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
     * Declares an association between this object and a SpyCountry object.
     *
     * @param SpyCountry $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setCountry(SpyCountry $v = null)
    {
        if ($v === null) {
            $this->setFkCountry(NULL);
        } else {
            $this->setFkCountry($v->getIdCountry());
        }

        $this->aCountry = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyCountry object, it will not be re-added.
        if ($v !== null) {
            $v->addCompanyUnitAddress($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyCountry object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyCountry The associated SpyCountry object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCountry(?ConnectionInterface $con = null)
    {
        if ($this->aCountry === null && ($this->fk_country != 0)) {
            $this->aCountry = SpyCountryQuery::create()->findPk($this->fk_country, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCountry->addCompanyUnitAddresses($this);
             */
        }

        return $this->aCountry;
    }

    /**
     * Declares an association between this object and a SpyRegion object.
     *
     * @param SpyRegion|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setRegion(SpyRegion $v = null)
    {
        if ($v === null) {
            $this->setFkRegion(NULL);
        } else {
            $this->setFkRegion($v->getIdRegion());
        }

        $this->aRegion = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyRegion object, it will not be re-added.
        if ($v !== null) {
            $v->addCompanyUnitAddress($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyRegion object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyRegion|null The associated SpyRegion object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getRegion(?ConnectionInterface $con = null)
    {
        if ($this->aRegion === null && ($this->fk_region != 0)) {
            $this->aRegion = SpyRegionQuery::create()->findPk($this->fk_region, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aRegion->addCompanyUnitAddresses($this);
             */
        }

        return $this->aRegion;
    }

    /**
     * Declares an association between this object and a SpyCompany object.
     *
     * @param SpyCompany|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setCompany(SpyCompany $v = null)
    {
        if ($v === null) {
            $this->setFkCompany(NULL);
        } else {
            $this->setFkCompany($v->getIdCompany());
        }

        $this->aCompany = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyCompany object, it will not be re-added.
        if ($v !== null) {
            $v->addCompanyUnitAddress($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyCompany object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyCompany|null The associated SpyCompany object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCompany(?ConnectionInterface $con = null)
    {
        if ($this->aCompany === null && ($this->fk_company != 0)) {
            $this->aCompany = SpyCompanyQuery::create()->findPk($this->fk_company, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCompany->addCompanyUnitAddresses($this);
             */
        }

        return $this->aCompany;
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
        if ('SpyCompanyBusinessUnit' === $relationName) {
            $this->initSpyCompanyBusinessUnits();
            return;
        }
        if ('SpyCompanyUnitAddressToCompanyBusinessUnit' === $relationName) {
            $this->initSpyCompanyUnitAddressToCompanyBusinessUnits();
            return;
        }
        if ('SpyCompanyUnitAddressLabelToCompanyUnitAddress' === $relationName) {
            $this->initSpyCompanyUnitAddressLabelToCompanyUnitAddresses();
            return;
        }
    }

    /**
     * Clears out the collSpyCompanyBusinessUnits collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCompanyBusinessUnits()
     */
    public function clearSpyCompanyBusinessUnits()
    {
        $this->collSpyCompanyBusinessUnits = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCompanyBusinessUnits collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCompanyBusinessUnits($v = true): void
    {
        $this->collSpyCompanyBusinessUnitsPartial = $v;
    }

    /**
     * Initializes the collSpyCompanyBusinessUnits collection.
     *
     * By default this just sets the collSpyCompanyBusinessUnits collection to an empty array (like clearcollSpyCompanyBusinessUnits());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCompanyBusinessUnits(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCompanyBusinessUnits && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCompanyBusinessUnitTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCompanyBusinessUnits = new $collectionClassName;
        $this->collSpyCompanyBusinessUnits->setModel('\Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit');
    }

    /**
     * Gets an array of SpyCompanyBusinessUnit objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCompanyUnitAddress is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCompanyBusinessUnit[] List of SpyCompanyBusinessUnit objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyBusinessUnit> List of SpyCompanyBusinessUnit objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCompanyBusinessUnits(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCompanyBusinessUnitsPartial && !$this->isNew();
        if (null === $this->collSpyCompanyBusinessUnits || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCompanyBusinessUnits) {
                    $this->initSpyCompanyBusinessUnits();
                } else {
                    $collectionClassName = SpyCompanyBusinessUnitTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCompanyBusinessUnits = new $collectionClassName;
                    $collSpyCompanyBusinessUnits->setModel('\Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit');

                    return $collSpyCompanyBusinessUnits;
                }
            } else {
                $collSpyCompanyBusinessUnits = SpyCompanyBusinessUnitQuery::create(null, $criteria)
                    ->filterByCompanyBusinessUnitDefaultBillingAddress($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCompanyBusinessUnitsPartial && count($collSpyCompanyBusinessUnits)) {
                        $this->initSpyCompanyBusinessUnits(false);

                        foreach ($collSpyCompanyBusinessUnits as $obj) {
                            if (false == $this->collSpyCompanyBusinessUnits->contains($obj)) {
                                $this->collSpyCompanyBusinessUnits->append($obj);
                            }
                        }

                        $this->collSpyCompanyBusinessUnitsPartial = true;
                    }

                    return $collSpyCompanyBusinessUnits;
                }

                if ($partial && $this->collSpyCompanyBusinessUnits) {
                    foreach ($this->collSpyCompanyBusinessUnits as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCompanyBusinessUnits[] = $obj;
                        }
                    }
                }

                $this->collSpyCompanyBusinessUnits = $collSpyCompanyBusinessUnits;
                $this->collSpyCompanyBusinessUnitsPartial = false;
            }
        }

        return $this->collSpyCompanyBusinessUnits;
    }

    /**
     * Sets a collection of SpyCompanyBusinessUnit objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCompanyBusinessUnits A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCompanyBusinessUnits(Collection $spyCompanyBusinessUnits, ?ConnectionInterface $con = null)
    {
        /** @var SpyCompanyBusinessUnit[] $spyCompanyBusinessUnitsToDelete */
        $spyCompanyBusinessUnitsToDelete = $this->getSpyCompanyBusinessUnits(new Criteria(), $con)->diff($spyCompanyBusinessUnits);


        $this->spyCompanyBusinessUnitsScheduledForDeletion = $spyCompanyBusinessUnitsToDelete;

        foreach ($spyCompanyBusinessUnitsToDelete as $spyCompanyBusinessUnitRemoved) {
            $spyCompanyBusinessUnitRemoved->setCompanyBusinessUnitDefaultBillingAddress(null);
        }

        $this->collSpyCompanyBusinessUnits = null;
        foreach ($spyCompanyBusinessUnits as $spyCompanyBusinessUnit) {
            $this->addSpyCompanyBusinessUnit($spyCompanyBusinessUnit);
        }

        $this->collSpyCompanyBusinessUnits = $spyCompanyBusinessUnits;
        $this->collSpyCompanyBusinessUnitsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCompanyBusinessUnit objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCompanyBusinessUnit objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCompanyBusinessUnits(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCompanyBusinessUnitsPartial && !$this->isNew();
        if (null === $this->collSpyCompanyBusinessUnits || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCompanyBusinessUnits) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCompanyBusinessUnits());
            }

            $query = SpyCompanyBusinessUnitQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCompanyBusinessUnitDefaultBillingAddress($this)
                ->count($con);
        }

        return count($this->collSpyCompanyBusinessUnits);
    }

    /**
     * Method called to associate a SpyCompanyBusinessUnit object to this object
     * through the SpyCompanyBusinessUnit foreign key attribute.
     *
     * @param SpyCompanyBusinessUnit $l SpyCompanyBusinessUnit
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCompanyBusinessUnit(SpyCompanyBusinessUnit $l)
    {
        if ($this->collSpyCompanyBusinessUnits === null) {
            $this->initSpyCompanyBusinessUnits();
            $this->collSpyCompanyBusinessUnitsPartial = true;
        }

        if (!$this->collSpyCompanyBusinessUnits->contains($l)) {
            $this->doAddSpyCompanyBusinessUnit($l);

            if ($this->spyCompanyBusinessUnitsScheduledForDeletion and $this->spyCompanyBusinessUnitsScheduledForDeletion->contains($l)) {
                $this->spyCompanyBusinessUnitsScheduledForDeletion->remove($this->spyCompanyBusinessUnitsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCompanyBusinessUnit $spyCompanyBusinessUnit The SpyCompanyBusinessUnit object to add.
     */
    protected function doAddSpyCompanyBusinessUnit(SpyCompanyBusinessUnit $spyCompanyBusinessUnit): void
    {
        $this->collSpyCompanyBusinessUnits[]= $spyCompanyBusinessUnit;
        $spyCompanyBusinessUnit->setCompanyBusinessUnitDefaultBillingAddress($this);
    }

    /**
     * @param SpyCompanyBusinessUnit $spyCompanyBusinessUnit The SpyCompanyBusinessUnit object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCompanyBusinessUnit(SpyCompanyBusinessUnit $spyCompanyBusinessUnit)
    {
        if ($this->getSpyCompanyBusinessUnits()->contains($spyCompanyBusinessUnit)) {
            $pos = $this->collSpyCompanyBusinessUnits->search($spyCompanyBusinessUnit);
            $this->collSpyCompanyBusinessUnits->remove($pos);
            if (null === $this->spyCompanyBusinessUnitsScheduledForDeletion) {
                $this->spyCompanyBusinessUnitsScheduledForDeletion = clone $this->collSpyCompanyBusinessUnits;
                $this->spyCompanyBusinessUnitsScheduledForDeletion->clear();
            }
            $this->spyCompanyBusinessUnitsScheduledForDeletion[]= $spyCompanyBusinessUnit;
            $spyCompanyBusinessUnit->setCompanyBusinessUnitDefaultBillingAddress(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompanyUnitAddress is new, it will return
     * an empty collection; or if this SpyCompanyUnitAddress has previously
     * been saved, it will retrieve related SpyCompanyBusinessUnits from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompanyUnitAddress.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCompanyBusinessUnit[] List of SpyCompanyBusinessUnit objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyBusinessUnit}> List of SpyCompanyBusinessUnit objects
     */
    public function getSpyCompanyBusinessUnitsJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCompanyBusinessUnitQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getSpyCompanyBusinessUnits($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompanyUnitAddress is new, it will return
     * an empty collection; or if this SpyCompanyUnitAddress has previously
     * been saved, it will retrieve related SpyCompanyBusinessUnits from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompanyUnitAddress.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCompanyBusinessUnit[] List of SpyCompanyBusinessUnit objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyBusinessUnit}> List of SpyCompanyBusinessUnit objects
     */
    public function getSpyCompanyBusinessUnitsJoinParentCompanyBusinessUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCompanyBusinessUnitQuery::create(null, $criteria);
        $query->joinWith('ParentCompanyBusinessUnit', $joinBehavior);

        return $this->getSpyCompanyBusinessUnits($query, $con);
    }

    /**
     * Clears out the collSpyCompanyUnitAddressToCompanyBusinessUnits collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCompanyUnitAddressToCompanyBusinessUnits()
     */
    public function clearSpyCompanyUnitAddressToCompanyBusinessUnits()
    {
        $this->collSpyCompanyUnitAddressToCompanyBusinessUnits = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCompanyUnitAddressToCompanyBusinessUnits collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCompanyUnitAddressToCompanyBusinessUnits($v = true): void
    {
        $this->collSpyCompanyUnitAddressToCompanyBusinessUnitsPartial = $v;
    }

    /**
     * Initializes the collSpyCompanyUnitAddressToCompanyBusinessUnits collection.
     *
     * By default this just sets the collSpyCompanyUnitAddressToCompanyBusinessUnits collection to an empty array (like clearcollSpyCompanyUnitAddressToCompanyBusinessUnits());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCompanyUnitAddressToCompanyBusinessUnits(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCompanyUnitAddressToCompanyBusinessUnits && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCompanyUnitAddressToCompanyBusinessUnitTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCompanyUnitAddressToCompanyBusinessUnits = new $collectionClassName;
        $this->collSpyCompanyUnitAddressToCompanyBusinessUnits->setModel('\Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressToCompanyBusinessUnit');
    }

    /**
     * Gets an array of ChildSpyCompanyUnitAddressToCompanyBusinessUnit objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCompanyUnitAddress is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyCompanyUnitAddressToCompanyBusinessUnit[] List of ChildSpyCompanyUnitAddressToCompanyBusinessUnit objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCompanyUnitAddressToCompanyBusinessUnit> List of ChildSpyCompanyUnitAddressToCompanyBusinessUnit objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCompanyUnitAddressToCompanyBusinessUnits(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCompanyUnitAddressToCompanyBusinessUnitsPartial && !$this->isNew();
        if (null === $this->collSpyCompanyUnitAddressToCompanyBusinessUnits || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCompanyUnitAddressToCompanyBusinessUnits) {
                    $this->initSpyCompanyUnitAddressToCompanyBusinessUnits();
                } else {
                    $collectionClassName = SpyCompanyUnitAddressToCompanyBusinessUnitTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCompanyUnitAddressToCompanyBusinessUnits = new $collectionClassName;
                    $collSpyCompanyUnitAddressToCompanyBusinessUnits->setModel('\Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressToCompanyBusinessUnit');

                    return $collSpyCompanyUnitAddressToCompanyBusinessUnits;
                }
            } else {
                $collSpyCompanyUnitAddressToCompanyBusinessUnits = ChildSpyCompanyUnitAddressToCompanyBusinessUnitQuery::create(null, $criteria)
                    ->filterByCompanyUnitAddress($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCompanyUnitAddressToCompanyBusinessUnitsPartial && count($collSpyCompanyUnitAddressToCompanyBusinessUnits)) {
                        $this->initSpyCompanyUnitAddressToCompanyBusinessUnits(false);

                        foreach ($collSpyCompanyUnitAddressToCompanyBusinessUnits as $obj) {
                            if (false == $this->collSpyCompanyUnitAddressToCompanyBusinessUnits->contains($obj)) {
                                $this->collSpyCompanyUnitAddressToCompanyBusinessUnits->append($obj);
                            }
                        }

                        $this->collSpyCompanyUnitAddressToCompanyBusinessUnitsPartial = true;
                    }

                    return $collSpyCompanyUnitAddressToCompanyBusinessUnits;
                }

                if ($partial && $this->collSpyCompanyUnitAddressToCompanyBusinessUnits) {
                    foreach ($this->collSpyCompanyUnitAddressToCompanyBusinessUnits as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCompanyUnitAddressToCompanyBusinessUnits[] = $obj;
                        }
                    }
                }

                $this->collSpyCompanyUnitAddressToCompanyBusinessUnits = $collSpyCompanyUnitAddressToCompanyBusinessUnits;
                $this->collSpyCompanyUnitAddressToCompanyBusinessUnitsPartial = false;
            }
        }

        return $this->collSpyCompanyUnitAddressToCompanyBusinessUnits;
    }

    /**
     * Sets a collection of ChildSpyCompanyUnitAddressToCompanyBusinessUnit objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCompanyUnitAddressToCompanyBusinessUnits A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCompanyUnitAddressToCompanyBusinessUnits(Collection $spyCompanyUnitAddressToCompanyBusinessUnits, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyCompanyUnitAddressToCompanyBusinessUnit[] $spyCompanyUnitAddressToCompanyBusinessUnitsToDelete */
        $spyCompanyUnitAddressToCompanyBusinessUnitsToDelete = $this->getSpyCompanyUnitAddressToCompanyBusinessUnits(new Criteria(), $con)->diff($spyCompanyUnitAddressToCompanyBusinessUnits);


        $this->spyCompanyUnitAddressToCompanyBusinessUnitsScheduledForDeletion = $spyCompanyUnitAddressToCompanyBusinessUnitsToDelete;

        foreach ($spyCompanyUnitAddressToCompanyBusinessUnitsToDelete as $spyCompanyUnitAddressToCompanyBusinessUnitRemoved) {
            $spyCompanyUnitAddressToCompanyBusinessUnitRemoved->setCompanyUnitAddress(null);
        }

        $this->collSpyCompanyUnitAddressToCompanyBusinessUnits = null;
        foreach ($spyCompanyUnitAddressToCompanyBusinessUnits as $spyCompanyUnitAddressToCompanyBusinessUnit) {
            $this->addSpyCompanyUnitAddressToCompanyBusinessUnit($spyCompanyUnitAddressToCompanyBusinessUnit);
        }

        $this->collSpyCompanyUnitAddressToCompanyBusinessUnits = $spyCompanyUnitAddressToCompanyBusinessUnits;
        $this->collSpyCompanyUnitAddressToCompanyBusinessUnitsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyCompanyUnitAddressToCompanyBusinessUnit objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyCompanyUnitAddressToCompanyBusinessUnit objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCompanyUnitAddressToCompanyBusinessUnits(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCompanyUnitAddressToCompanyBusinessUnitsPartial && !$this->isNew();
        if (null === $this->collSpyCompanyUnitAddressToCompanyBusinessUnits || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCompanyUnitAddressToCompanyBusinessUnits) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCompanyUnitAddressToCompanyBusinessUnits());
            }

            $query = ChildSpyCompanyUnitAddressToCompanyBusinessUnitQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCompanyUnitAddress($this)
                ->count($con);
        }

        return count($this->collSpyCompanyUnitAddressToCompanyBusinessUnits);
    }

    /**
     * Method called to associate a ChildSpyCompanyUnitAddressToCompanyBusinessUnit object to this object
     * through the ChildSpyCompanyUnitAddressToCompanyBusinessUnit foreign key attribute.
     *
     * @param ChildSpyCompanyUnitAddressToCompanyBusinessUnit $l ChildSpyCompanyUnitAddressToCompanyBusinessUnit
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCompanyUnitAddressToCompanyBusinessUnit(ChildSpyCompanyUnitAddressToCompanyBusinessUnit $l)
    {
        if ($this->collSpyCompanyUnitAddressToCompanyBusinessUnits === null) {
            $this->initSpyCompanyUnitAddressToCompanyBusinessUnits();
            $this->collSpyCompanyUnitAddressToCompanyBusinessUnitsPartial = true;
        }

        if (!$this->collSpyCompanyUnitAddressToCompanyBusinessUnits->contains($l)) {
            $this->doAddSpyCompanyUnitAddressToCompanyBusinessUnit($l);

            if ($this->spyCompanyUnitAddressToCompanyBusinessUnitsScheduledForDeletion and $this->spyCompanyUnitAddressToCompanyBusinessUnitsScheduledForDeletion->contains($l)) {
                $this->spyCompanyUnitAddressToCompanyBusinessUnitsScheduledForDeletion->remove($this->spyCompanyUnitAddressToCompanyBusinessUnitsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyCompanyUnitAddressToCompanyBusinessUnit $spyCompanyUnitAddressToCompanyBusinessUnit The ChildSpyCompanyUnitAddressToCompanyBusinessUnit object to add.
     */
    protected function doAddSpyCompanyUnitAddressToCompanyBusinessUnit(ChildSpyCompanyUnitAddressToCompanyBusinessUnit $spyCompanyUnitAddressToCompanyBusinessUnit): void
    {
        $this->collSpyCompanyUnitAddressToCompanyBusinessUnits[]= $spyCompanyUnitAddressToCompanyBusinessUnit;
        $spyCompanyUnitAddressToCompanyBusinessUnit->setCompanyUnitAddress($this);
    }

    /**
     * @param ChildSpyCompanyUnitAddressToCompanyBusinessUnit $spyCompanyUnitAddressToCompanyBusinessUnit The ChildSpyCompanyUnitAddressToCompanyBusinessUnit object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCompanyUnitAddressToCompanyBusinessUnit(ChildSpyCompanyUnitAddressToCompanyBusinessUnit $spyCompanyUnitAddressToCompanyBusinessUnit)
    {
        if ($this->getSpyCompanyUnitAddressToCompanyBusinessUnits()->contains($spyCompanyUnitAddressToCompanyBusinessUnit)) {
            $pos = $this->collSpyCompanyUnitAddressToCompanyBusinessUnits->search($spyCompanyUnitAddressToCompanyBusinessUnit);
            $this->collSpyCompanyUnitAddressToCompanyBusinessUnits->remove($pos);
            if (null === $this->spyCompanyUnitAddressToCompanyBusinessUnitsScheduledForDeletion) {
                $this->spyCompanyUnitAddressToCompanyBusinessUnitsScheduledForDeletion = clone $this->collSpyCompanyUnitAddressToCompanyBusinessUnits;
                $this->spyCompanyUnitAddressToCompanyBusinessUnitsScheduledForDeletion->clear();
            }
            $this->spyCompanyUnitAddressToCompanyBusinessUnitsScheduledForDeletion[]= clone $spyCompanyUnitAddressToCompanyBusinessUnit;
            $spyCompanyUnitAddressToCompanyBusinessUnit->setCompanyUnitAddress(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompanyUnitAddress is new, it will return
     * an empty collection; or if this SpyCompanyUnitAddress has previously
     * been saved, it will retrieve related SpyCompanyUnitAddressToCompanyBusinessUnits from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompanyUnitAddress.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyCompanyUnitAddressToCompanyBusinessUnit[] List of ChildSpyCompanyUnitAddressToCompanyBusinessUnit objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCompanyUnitAddressToCompanyBusinessUnit}> List of ChildSpyCompanyUnitAddressToCompanyBusinessUnit objects
     */
    public function getSpyCompanyUnitAddressToCompanyBusinessUnitsJoinCompanyBusinessUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyCompanyUnitAddressToCompanyBusinessUnitQuery::create(null, $criteria);
        $query->joinWith('CompanyBusinessUnit', $joinBehavior);

        return $this->getSpyCompanyUnitAddressToCompanyBusinessUnits($query, $con);
    }

    /**
     * Clears out the collSpyCompanyUnitAddressLabelToCompanyUnitAddresses collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCompanyUnitAddressLabelToCompanyUnitAddresses()
     */
    public function clearSpyCompanyUnitAddressLabelToCompanyUnitAddresses()
    {
        $this->collSpyCompanyUnitAddressLabelToCompanyUnitAddresses = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCompanyUnitAddressLabelToCompanyUnitAddresses collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCompanyUnitAddressLabelToCompanyUnitAddresses($v = true): void
    {
        $this->collSpyCompanyUnitAddressLabelToCompanyUnitAddressesPartial = $v;
    }

    /**
     * Initializes the collSpyCompanyUnitAddressLabelToCompanyUnitAddresses collection.
     *
     * By default this just sets the collSpyCompanyUnitAddressLabelToCompanyUnitAddresses collection to an empty array (like clearcollSpyCompanyUnitAddressLabelToCompanyUnitAddresses());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCompanyUnitAddressLabelToCompanyUnitAddresses(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCompanyUnitAddressLabelToCompanyUnitAddresses && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCompanyUnitAddressLabelToCompanyUnitAddressTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCompanyUnitAddressLabelToCompanyUnitAddresses = new $collectionClassName;
        $this->collSpyCompanyUnitAddressLabelToCompanyUnitAddresses->setModel('\Orm\Zed\CompanyUnitAddressLabel\Persistence\SpyCompanyUnitAddressLabelToCompanyUnitAddress');
    }

    /**
     * Gets an array of SpyCompanyUnitAddressLabelToCompanyUnitAddress objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCompanyUnitAddress is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCompanyUnitAddressLabelToCompanyUnitAddress[] List of SpyCompanyUnitAddressLabelToCompanyUnitAddress objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyUnitAddressLabelToCompanyUnitAddress> List of SpyCompanyUnitAddressLabelToCompanyUnitAddress objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCompanyUnitAddressLabelToCompanyUnitAddresses(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCompanyUnitAddressLabelToCompanyUnitAddressesPartial && !$this->isNew();
        if (null === $this->collSpyCompanyUnitAddressLabelToCompanyUnitAddresses || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCompanyUnitAddressLabelToCompanyUnitAddresses) {
                    $this->initSpyCompanyUnitAddressLabelToCompanyUnitAddresses();
                } else {
                    $collectionClassName = SpyCompanyUnitAddressLabelToCompanyUnitAddressTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCompanyUnitAddressLabelToCompanyUnitAddresses = new $collectionClassName;
                    $collSpyCompanyUnitAddressLabelToCompanyUnitAddresses->setModel('\Orm\Zed\CompanyUnitAddressLabel\Persistence\SpyCompanyUnitAddressLabelToCompanyUnitAddress');

                    return $collSpyCompanyUnitAddressLabelToCompanyUnitAddresses;
                }
            } else {
                $collSpyCompanyUnitAddressLabelToCompanyUnitAddresses = SpyCompanyUnitAddressLabelToCompanyUnitAddressQuery::create(null, $criteria)
                    ->filterByCompanyUnitAddress($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCompanyUnitAddressLabelToCompanyUnitAddressesPartial && count($collSpyCompanyUnitAddressLabelToCompanyUnitAddresses)) {
                        $this->initSpyCompanyUnitAddressLabelToCompanyUnitAddresses(false);

                        foreach ($collSpyCompanyUnitAddressLabelToCompanyUnitAddresses as $obj) {
                            if (false == $this->collSpyCompanyUnitAddressLabelToCompanyUnitAddresses->contains($obj)) {
                                $this->collSpyCompanyUnitAddressLabelToCompanyUnitAddresses->append($obj);
                            }
                        }

                        $this->collSpyCompanyUnitAddressLabelToCompanyUnitAddressesPartial = true;
                    }

                    return $collSpyCompanyUnitAddressLabelToCompanyUnitAddresses;
                }

                if ($partial && $this->collSpyCompanyUnitAddressLabelToCompanyUnitAddresses) {
                    foreach ($this->collSpyCompanyUnitAddressLabelToCompanyUnitAddresses as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCompanyUnitAddressLabelToCompanyUnitAddresses[] = $obj;
                        }
                    }
                }

                $this->collSpyCompanyUnitAddressLabelToCompanyUnitAddresses = $collSpyCompanyUnitAddressLabelToCompanyUnitAddresses;
                $this->collSpyCompanyUnitAddressLabelToCompanyUnitAddressesPartial = false;
            }
        }

        return $this->collSpyCompanyUnitAddressLabelToCompanyUnitAddresses;
    }

    /**
     * Sets a collection of SpyCompanyUnitAddressLabelToCompanyUnitAddress objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCompanyUnitAddressLabelToCompanyUnitAddresses A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCompanyUnitAddressLabelToCompanyUnitAddresses(Collection $spyCompanyUnitAddressLabelToCompanyUnitAddresses, ?ConnectionInterface $con = null)
    {
        /** @var SpyCompanyUnitAddressLabelToCompanyUnitAddress[] $spyCompanyUnitAddressLabelToCompanyUnitAddressesToDelete */
        $spyCompanyUnitAddressLabelToCompanyUnitAddressesToDelete = $this->getSpyCompanyUnitAddressLabelToCompanyUnitAddresses(new Criteria(), $con)->diff($spyCompanyUnitAddressLabelToCompanyUnitAddresses);


        $this->spyCompanyUnitAddressLabelToCompanyUnitAddressesScheduledForDeletion = $spyCompanyUnitAddressLabelToCompanyUnitAddressesToDelete;

        foreach ($spyCompanyUnitAddressLabelToCompanyUnitAddressesToDelete as $spyCompanyUnitAddressLabelToCompanyUnitAddressRemoved) {
            $spyCompanyUnitAddressLabelToCompanyUnitAddressRemoved->setCompanyUnitAddress(null);
        }

        $this->collSpyCompanyUnitAddressLabelToCompanyUnitAddresses = null;
        foreach ($spyCompanyUnitAddressLabelToCompanyUnitAddresses as $spyCompanyUnitAddressLabelToCompanyUnitAddress) {
            $this->addSpyCompanyUnitAddressLabelToCompanyUnitAddress($spyCompanyUnitAddressLabelToCompanyUnitAddress);
        }

        $this->collSpyCompanyUnitAddressLabelToCompanyUnitAddresses = $spyCompanyUnitAddressLabelToCompanyUnitAddresses;
        $this->collSpyCompanyUnitAddressLabelToCompanyUnitAddressesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCompanyUnitAddressLabelToCompanyUnitAddress objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCompanyUnitAddressLabelToCompanyUnitAddress objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCompanyUnitAddressLabelToCompanyUnitAddresses(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCompanyUnitAddressLabelToCompanyUnitAddressesPartial && !$this->isNew();
        if (null === $this->collSpyCompanyUnitAddressLabelToCompanyUnitAddresses || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCompanyUnitAddressLabelToCompanyUnitAddresses) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCompanyUnitAddressLabelToCompanyUnitAddresses());
            }

            $query = SpyCompanyUnitAddressLabelToCompanyUnitAddressQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCompanyUnitAddress($this)
                ->count($con);
        }

        return count($this->collSpyCompanyUnitAddressLabelToCompanyUnitAddresses);
    }

    /**
     * Method called to associate a SpyCompanyUnitAddressLabelToCompanyUnitAddress object to this object
     * through the SpyCompanyUnitAddressLabelToCompanyUnitAddress foreign key attribute.
     *
     * @param SpyCompanyUnitAddressLabelToCompanyUnitAddress $l SpyCompanyUnitAddressLabelToCompanyUnitAddress
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCompanyUnitAddressLabelToCompanyUnitAddress(SpyCompanyUnitAddressLabelToCompanyUnitAddress $l)
    {
        if ($this->collSpyCompanyUnitAddressLabelToCompanyUnitAddresses === null) {
            $this->initSpyCompanyUnitAddressLabelToCompanyUnitAddresses();
            $this->collSpyCompanyUnitAddressLabelToCompanyUnitAddressesPartial = true;
        }

        if (!$this->collSpyCompanyUnitAddressLabelToCompanyUnitAddresses->contains($l)) {
            $this->doAddSpyCompanyUnitAddressLabelToCompanyUnitAddress($l);

            if ($this->spyCompanyUnitAddressLabelToCompanyUnitAddressesScheduledForDeletion and $this->spyCompanyUnitAddressLabelToCompanyUnitAddressesScheduledForDeletion->contains($l)) {
                $this->spyCompanyUnitAddressLabelToCompanyUnitAddressesScheduledForDeletion->remove($this->spyCompanyUnitAddressLabelToCompanyUnitAddressesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCompanyUnitAddressLabelToCompanyUnitAddress $spyCompanyUnitAddressLabelToCompanyUnitAddress The SpyCompanyUnitAddressLabelToCompanyUnitAddress object to add.
     */
    protected function doAddSpyCompanyUnitAddressLabelToCompanyUnitAddress(SpyCompanyUnitAddressLabelToCompanyUnitAddress $spyCompanyUnitAddressLabelToCompanyUnitAddress): void
    {
        $this->collSpyCompanyUnitAddressLabelToCompanyUnitAddresses[]= $spyCompanyUnitAddressLabelToCompanyUnitAddress;
        $spyCompanyUnitAddressLabelToCompanyUnitAddress->setCompanyUnitAddress($this);
    }

    /**
     * @param SpyCompanyUnitAddressLabelToCompanyUnitAddress $spyCompanyUnitAddressLabelToCompanyUnitAddress The SpyCompanyUnitAddressLabelToCompanyUnitAddress object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCompanyUnitAddressLabelToCompanyUnitAddress(SpyCompanyUnitAddressLabelToCompanyUnitAddress $spyCompanyUnitAddressLabelToCompanyUnitAddress)
    {
        if ($this->getSpyCompanyUnitAddressLabelToCompanyUnitAddresses()->contains($spyCompanyUnitAddressLabelToCompanyUnitAddress)) {
            $pos = $this->collSpyCompanyUnitAddressLabelToCompanyUnitAddresses->search($spyCompanyUnitAddressLabelToCompanyUnitAddress);
            $this->collSpyCompanyUnitAddressLabelToCompanyUnitAddresses->remove($pos);
            if (null === $this->spyCompanyUnitAddressLabelToCompanyUnitAddressesScheduledForDeletion) {
                $this->spyCompanyUnitAddressLabelToCompanyUnitAddressesScheduledForDeletion = clone $this->collSpyCompanyUnitAddressLabelToCompanyUnitAddresses;
                $this->spyCompanyUnitAddressLabelToCompanyUnitAddressesScheduledForDeletion->clear();
            }
            $this->spyCompanyUnitAddressLabelToCompanyUnitAddressesScheduledForDeletion[]= clone $spyCompanyUnitAddressLabelToCompanyUnitAddress;
            $spyCompanyUnitAddressLabelToCompanyUnitAddress->setCompanyUnitAddress(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCompanyUnitAddress is new, it will return
     * an empty collection; or if this SpyCompanyUnitAddress has previously
     * been saved, it will retrieve related SpyCompanyUnitAddressLabelToCompanyUnitAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCompanyUnitAddress.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCompanyUnitAddressLabelToCompanyUnitAddress[] List of SpyCompanyUnitAddressLabelToCompanyUnitAddress objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyUnitAddressLabelToCompanyUnitAddress}> List of SpyCompanyUnitAddressLabelToCompanyUnitAddress objects
     */
    public function getSpyCompanyUnitAddressLabelToCompanyUnitAddressesJoinCompanyUnitAddressLabel(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCompanyUnitAddressLabelToCompanyUnitAddressQuery::create(null, $criteria);
        $query->joinWith('CompanyUnitAddressLabel', $joinBehavior);

        return $this->getSpyCompanyUnitAddressLabelToCompanyUnitAddresses($query, $con);
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
        if (null !== $this->aCountry) {
            $this->aCountry->removeCompanyUnitAddress($this);
        }
        if (null !== $this->aRegion) {
            $this->aRegion->removeCompanyUnitAddress($this);
        }
        if (null !== $this->aCompany) {
            $this->aCompany->removeCompanyUnitAddress($this);
        }
        $this->id_company_unit_address = null;
        $this->fk_company = null;
        $this->fk_country = null;
        $this->fk_region = null;
        $this->address1 = null;
        $this->address2 = null;
        $this->address3 = null;
        $this->city = null;
        $this->comment = null;
        $this->key = null;
        $this->phone = null;
        $this->uuid = null;
        $this->zip_code = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
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
            if ($this->collSpyCompanyBusinessUnits) {
                foreach ($this->collSpyCompanyBusinessUnits as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyCompanyUnitAddressToCompanyBusinessUnits) {
                foreach ($this->collSpyCompanyUnitAddressToCompanyBusinessUnits as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyCompanyUnitAddressLabelToCompanyUnitAddresses) {
                foreach ($this->collSpyCompanyUnitAddressLabelToCompanyUnitAddresses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyCompanyBusinessUnits = null;
        $this->collSpyCompanyUnitAddressToCompanyBusinessUnits = null;
        $this->collSpyCompanyUnitAddressLabelToCompanyUnitAddresses = null;
        $this->aCountry = null;
        $this->aRegion = null;
        $this->aCompany = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyCompanyUnitAddressTableMap::DEFAULT_STRING_FORMAT);
    }

    // uuid behavior

    /**
     * @return \Spryker\Service\UtilUuidGenerator\UtilUuidGeneratorServiceInterface
     */
    protected function getUuidGeneratorService()
    {
        if (static::$_uuidGeneratorService === null) {
            static::$_uuidGeneratorService = \Spryker\Zed\Kernel\Locator::getInstance()->utilUuidGenerator()->service();
        }

        return static::$_uuidGeneratorService;
    }

    /**
     * @return void
     */
    protected function setGeneratedUuid()
    {
        $uuidGenerateUtilService = $this->getUuidGeneratorService();
        $name = 'spy_company_unit_address' . '.' . $this->getIdCompanyUnitAddress() . '.' . $this->getFkCompany();
        $uuid = $uuidGenerateUtilService->generateUuid5FromObjectId($name);
        $this->setUuid($uuid);
    }

    /**
     * @param ConnectionInterface $con
     *
     * @return void
     */
    protected function updateUuidAfterInsert(ConnectionInterface $con = null)
    {
        if (!$this->getUuid()) {
            $this->setGeneratedUuid();
            $this->doSave($con);
        }
    }

    /**
     * @return void
     */
    protected function updateUuidBeforeUpdate()
    {
        if (!$this->getUuid()) {
            $this->setGeneratedUuid();
        }
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
