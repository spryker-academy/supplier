<?php

namespace Orm\Zed\PriceProductSchedule\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\Currency\Persistence\SpyCurrency;
use Orm\Zed\Currency\Persistence\SpyCurrencyQuery;
use Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleList as ChildSpyPriceProductScheduleList;
use Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleListQuery as ChildSpyPriceProductScheduleListQuery;
use Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleQuery as ChildSpyPriceProductScheduleQuery;
use Orm\Zed\PriceProductSchedule\Persistence\Map\SpyPriceProductScheduleTableMap;
use Orm\Zed\PriceProduct\Persistence\SpyPriceType;
use Orm\Zed\PriceProduct\Persistence\SpyPriceTypeQuery;
use Orm\Zed\Product\Persistence\SpyProduct;
use Orm\Zed\Product\Persistence\SpyProductAbstract;
use Orm\Zed\Product\Persistence\SpyProductAbstractQuery;
use Orm\Zed\Product\Persistence\SpyProductQuery;
use Orm\Zed\Store\Persistence\SpyStore;
use Orm\Zed\Store\Persistence\SpyStoreQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;
use Spryker\Zed\PropelReplicationCache\Business\PropelReplicationCacheFacade;

/**
 * Base class that represents a row from the 'spy_price_product_schedule' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.PriceProductSchedule.Persistence.Base
 */
abstract class SpyPriceProductSchedule implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\PriceProductSchedule\\Persistence\\Map\\SpyPriceProductScheduleTableMap';


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
     * The value for the id_price_product_schedule field.
     *
     * @var        string
     */
    protected $id_price_product_schedule;

    /**
     * The value for the fk_currency field.
     *
     * @var        int
     */
    protected $fk_currency;

    /**
     * The value for the fk_store field.
     *
     * @var        int
     */
    protected $fk_store;

    /**
     * The value for the fk_price_type field.
     *
     * @var        int
     */
    protected $fk_price_type;

    /**
     * The value for the fk_product field.
     *
     * @var        int|null
     */
    protected $fk_product;

    /**
     * The value for the fk_product_abstract field.
     *
     * @var        int|null
     */
    protected $fk_product_abstract;

    /**
     * The value for the fk_price_product_schedule_list field.
     *
     * @var        string
     */
    protected $fk_price_product_schedule_list;

    /**
     * The value for the net_price field.
     * The net price (excluding tax).
     * @var        int|null
     */
    protected $net_price;

    /**
     * The value for the gross_price field.
     * The gross price (including tax).
     * @var        int|null
     */
    protected $gross_price;

    /**
     * The value for the price_data field.
     * Encoded price data, often including volume prices.
     * @var        string|null
     */
    protected $price_data;

    /**
     * The value for the active_from field.
     * The date and time from which a price schedule is active.
     * @var        DateTime
     */
    protected $active_from;

    /**
     * The value for the active_to field.
     * The date and time until which a price schedule is active.
     * @var        DateTime
     */
    protected $active_to;

    /**
     * The value for the is_current field.
     * A flag indicating if a price schedule is the current one.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $is_current;

    /**
     * The value for the created_at field.
     *
     * @var        DateTime|null
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     *
     * @var        DateTime|null
     */
    protected $updated_at;

    /**
     * @var        SpyProduct
     */
    protected $aProduct;

    /**
     * @var        SpyProductAbstract
     */
    protected $aProductAbstract;

    /**
     * @var        SpyCurrency
     */
    protected $aCurrency;

    /**
     * @var        SpyStore
     */
    protected $aStore;

    /**
     * @var        SpyPriceType
     */
    protected $aPriceType;

    /**
     * @var        ChildSpyPriceProductScheduleList
     */
    protected $aPriceProductScheduleList;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->is_current = false;
    }

    /**
     * Initializes internal state of Orm\Zed\PriceProductSchedule\Persistence\Base\SpyPriceProductSchedule object.
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
     * Compares this with another <code>SpyPriceProductSchedule</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyPriceProductSchedule</code>, delegates to
     * <code>equals(SpyPriceProductSchedule)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_price_product_schedule] column value.
     *
     * @return string
     */
    public function getIdPriceProductSchedule()
    {
        return $this->id_price_product_schedule;
    }

    /**
     * Get the [fk_currency] column value.
     *
     * @return int
     */
    public function getFkCurrency()
    {
        return $this->fk_currency;
    }

    /**
     * Get the [fk_store] column value.
     *
     * @return int
     */
    public function getFkStore()
    {
        return $this->fk_store;
    }

    /**
     * Get the [fk_price_type] column value.
     *
     * @return int
     */
    public function getFkPriceType()
    {
        return $this->fk_price_type;
    }

    /**
     * Get the [fk_product] column value.
     *
     * @return int|null
     */
    public function getFkProduct()
    {
        return $this->fk_product;
    }

    /**
     * Get the [fk_product_abstract] column value.
     *
     * @return int|null
     */
    public function getFkProductAbstract()
    {
        return $this->fk_product_abstract;
    }

    /**
     * Get the [fk_price_product_schedule_list] column value.
     *
     * @return string
     */
    public function getFkPriceProductScheduleList()
    {
        return $this->fk_price_product_schedule_list;
    }

    /**
     * Get the [net_price] column value.
     * The net price (excluding tax).
     * @return int|null
     */
    public function getNetPrice()
    {
        return $this->net_price;
    }

    /**
     * Get the [gross_price] column value.
     * The gross price (including tax).
     * @return int|null
     */
    public function getGrossPrice()
    {
        return $this->gross_price;
    }

    /**
     * Get the [price_data] column value.
     * Encoded price data, often including volume prices.
     * @return string|null
     */
    public function getPriceData()
    {
        return $this->price_data;
    }

    /**
     * Get the [optionally formatted] temporal [active_from] column value.
     * The date and time from which a price schedule is active.
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), and 0 if column value is 0000-00-00 00:00:00.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime : string)
     */
    public function getActiveFrom($format = null)
    {
        if ($format === null) {
            return $this->active_from;
        } else {
            return $this->active_from instanceof \DateTimeInterface ? $this->active_from->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [active_to] column value.
     * The date and time until which a price schedule is active.
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), and 0 if column value is 0000-00-00 00:00:00.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime : string)
     */
    public function getActiveTo($format = null)
    {
        if ($format === null) {
            return $this->active_to;
        } else {
            return $this->active_to instanceof \DateTimeInterface ? $this->active_to->format($format) : null;
        }
    }

    /**
     * Get the [is_current] column value.
     * A flag indicating if a price schedule is the current one.
     * @return boolean
     */
    public function getIsCurrent()
    {
        return $this->is_current;
    }

    /**
     * Get the [is_current] column value.
     * A flag indicating if a price schedule is the current one.
     * @return boolean
     */
    public function isCurrent()
    {
        return $this->getIsCurrent();
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getCreatedAt($format = null)
    {
        if ($format === null) {
            return $this->created_at;
        } else {
            return $this->created_at instanceof \DateTimeInterface ? $this->created_at->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getUpdatedAt($format = null)
    {
        if ($format === null) {
            return $this->updated_at;
        } else {
            return $this->updated_at instanceof \DateTimeInterface ? $this->updated_at->format($format) : null;
        }
    }

    /**
     * Set the value of [id_price_product_schedule] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdPriceProductSchedule($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_price_product_schedule !== $v) {
            $this->id_price_product_schedule = $v;
            $this->modifiedColumns[SpyPriceProductScheduleTableMap::COL_ID_PRICE_PRODUCT_SCHEDULE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_currency] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkCurrency($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_currency !== $v) {
            $this->fk_currency = $v;
            $this->modifiedColumns[SpyPriceProductScheduleTableMap::COL_FK_CURRENCY] = true;
        }

        if ($this->aCurrency !== null && $this->aCurrency->getIdCurrency() !== $v) {
            $this->aCurrency = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_store] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkStore($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_store !== $v) {
            $this->fk_store = $v;
            $this->modifiedColumns[SpyPriceProductScheduleTableMap::COL_FK_STORE] = true;
        }

        if ($this->aStore !== null && $this->aStore->getIdStore() !== $v) {
            $this->aStore = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_price_type] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkPriceType($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_price_type !== $v) {
            $this->fk_price_type = $v;
            $this->modifiedColumns[SpyPriceProductScheduleTableMap::COL_FK_PRICE_TYPE] = true;
        }

        if ($this->aPriceType !== null && $this->aPriceType->getIdPriceType() !== $v) {
            $this->aPriceType = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_product] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkProduct($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_product !== $v) {
            $this->fk_product = $v;
            $this->modifiedColumns[SpyPriceProductScheduleTableMap::COL_FK_PRODUCT] = true;
        }

        if ($this->aProduct !== null && $this->aProduct->getIdProduct() !== $v) {
            $this->aProduct = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_product_abstract] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkProductAbstract($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_product_abstract !== $v) {
            $this->fk_product_abstract = $v;
            $this->modifiedColumns[SpyPriceProductScheduleTableMap::COL_FK_PRODUCT_ABSTRACT] = true;
        }

        if ($this->aProductAbstract !== null && $this->aProductAbstract->getIdProductAbstract() !== $v) {
            $this->aProductAbstract = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_price_product_schedule_list] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkPriceProductScheduleList($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_price_product_schedule_list !== $v) {
            $this->fk_price_product_schedule_list = $v;
            $this->modifiedColumns[SpyPriceProductScheduleTableMap::COL_FK_PRICE_PRODUCT_SCHEDULE_LIST] = true;
        }

        if ($this->aPriceProductScheduleList !== null && $this->aPriceProductScheduleList->getIdPriceProductScheduleList() !== $v) {
            $this->aPriceProductScheduleList = null;
        }

        return $this;
    }

    /**
     * Set the value of [net_price] column.
     * The net price (excluding tax).
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setNetPrice($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->net_price !== $v) {
            $this->net_price = $v;
            $this->modifiedColumns[SpyPriceProductScheduleTableMap::COL_NET_PRICE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [gross_price] column.
     * The gross price (including tax).
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setGrossPrice($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->gross_price !== $v) {
            $this->gross_price = $v;
            $this->modifiedColumns[SpyPriceProductScheduleTableMap::COL_GROSS_PRICE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [price_data] column.
     * Encoded price data, often including volume prices.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPriceData($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->price_data !== $v) {
            $this->price_data = $v;
            $this->modifiedColumns[SpyPriceProductScheduleTableMap::COL_PRICE_DATA] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [active_from] column to a normalized version of the date/time value specified.
     * The date and time from which a price schedule is active.
     * @param string|integer|\DateTimeInterface $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setActiveFrom($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->active_from !== null || $dt !== null) {
            if ($this->active_from === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->active_from->format("Y-m-d H:i:s.u")) {
                $this->active_from = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SpyPriceProductScheduleTableMap::COL_ACTIVE_FROM] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [active_to] column to a normalized version of the date/time value specified.
     * The date and time until which a price schedule is active.
     * @param string|integer|\DateTimeInterface $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setActiveTo($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->active_to !== null || $dt !== null) {
            if ($this->active_to === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->active_to->format("Y-m-d H:i:s.u")) {
                $this->active_to = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SpyPriceProductScheduleTableMap::COL_ACTIVE_TO] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of the [is_current] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * A flag indicating if a price schedule is the current one.
     * @param bool|integer|string $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsCurrent($v)
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

        if (($this->isNew() && $hasDefaultValue) || $this->is_current !== $v) {
            $this->is_current = $v;
            $this->modifiedColumns[SpyPriceProductScheduleTableMap::COL_IS_CURRENT] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SpyPriceProductScheduleTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updated_at->format("Y-m-d H:i:s.u")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SpyPriceProductScheduleTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

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
            if ($this->is_current !== false) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyPriceProductScheduleTableMap::translateFieldName('IdPriceProductSchedule', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_price_product_schedule = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyPriceProductScheduleTableMap::translateFieldName('FkCurrency', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_currency = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyPriceProductScheduleTableMap::translateFieldName('FkStore', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_store = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyPriceProductScheduleTableMap::translateFieldName('FkPriceType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_price_type = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyPriceProductScheduleTableMap::translateFieldName('FkProduct', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_product = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyPriceProductScheduleTableMap::translateFieldName('FkProductAbstract', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_product_abstract = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpyPriceProductScheduleTableMap::translateFieldName('FkPriceProductScheduleList', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_price_product_schedule_list = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpyPriceProductScheduleTableMap::translateFieldName('NetPrice', TableMap::TYPE_PHPNAME, $indexType)];
            $this->net_price = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SpyPriceProductScheduleTableMap::translateFieldName('GrossPrice', TableMap::TYPE_PHPNAME, $indexType)];
            $this->gross_price = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SpyPriceProductScheduleTableMap::translateFieldName('PriceData', TableMap::TYPE_PHPNAME, $indexType)];
            $this->price_data = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SpyPriceProductScheduleTableMap::translateFieldName('ActiveFrom', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->active_from = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : SpyPriceProductScheduleTableMap::translateFieldName('ActiveTo', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->active_to = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : SpyPriceProductScheduleTableMap::translateFieldName('IsCurrent', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_current = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : SpyPriceProductScheduleTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : SpyPriceProductScheduleTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 15; // 15 = SpyPriceProductScheduleTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\PriceProductSchedule\\Persistence\\SpyPriceProductSchedule'), 0, $e);
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
        if ($this->aCurrency !== null && $this->fk_currency !== $this->aCurrency->getIdCurrency()) {
            $this->aCurrency = null;
        }
        if ($this->aStore !== null && $this->fk_store !== $this->aStore->getIdStore()) {
            $this->aStore = null;
        }
        if ($this->aPriceType !== null && $this->fk_price_type !== $this->aPriceType->getIdPriceType()) {
            $this->aPriceType = null;
        }
        if ($this->aProduct !== null && $this->fk_product !== $this->aProduct->getIdProduct()) {
            $this->aProduct = null;
        }
        if ($this->aProductAbstract !== null && $this->fk_product_abstract !== $this->aProductAbstract->getIdProductAbstract()) {
            $this->aProductAbstract = null;
        }
        if ($this->aPriceProductScheduleList !== null && $this->fk_price_product_schedule_list !== $this->aPriceProductScheduleList->getIdPriceProductScheduleList()) {
            $this->aPriceProductScheduleList = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyPriceProductScheduleTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyPriceProductScheduleQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aProduct = null;
            $this->aProductAbstract = null;
            $this->aCurrency = null;
            $this->aStore = null;
            $this->aPriceType = null;
            $this->aPriceProductScheduleList = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyPriceProductSchedule::setDeleted()
     * @see SpyPriceProductSchedule::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPriceProductScheduleTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyPriceProductScheduleQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPriceProductScheduleTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                $time = time();
                $highPrecision = \Propel\Runtime\Util\PropelDateTime::createHighPrecision();
                if (!$this->isColumnModified(SpyPriceProductScheduleTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpyPriceProductScheduleTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt($highPrecision);
                }
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
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(SpyPriceProductScheduleTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt(\Propel\Runtime\Util\PropelDateTime::createHighPrecision());
                }
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
                SpyPriceProductScheduleTableMap::addInstanceToPool($this);
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

            if ($this->aProduct !== null) {
                if ($this->aProduct->isModified() || $this->aProduct->isNew()) {
                    $affectedRows += $this->aProduct->save($con);
                }
                $this->setProduct($this->aProduct);
            }

            if ($this->aProductAbstract !== null) {
                if ($this->aProductAbstract->isModified() || $this->aProductAbstract->isNew()) {
                    $affectedRows += $this->aProductAbstract->save($con);
                }
                $this->setProductAbstract($this->aProductAbstract);
            }

            if ($this->aCurrency !== null) {
                if ($this->aCurrency->isModified() || $this->aCurrency->isNew()) {
                    $affectedRows += $this->aCurrency->save($con);
                }
                $this->setCurrency($this->aCurrency);
            }

            if ($this->aStore !== null) {
                if ($this->aStore->isModified() || $this->aStore->isNew()) {
                    $affectedRows += $this->aStore->save($con);
                }
                $this->setStore($this->aStore);
            }

            if ($this->aPriceType !== null) {
                if ($this->aPriceType->isModified() || $this->aPriceType->isNew()) {
                    $affectedRows += $this->aPriceType->save($con);
                }
                $this->setPriceType($this->aPriceType);
            }

            if ($this->aPriceProductScheduleList !== null) {
                if ($this->aPriceProductScheduleList->isModified() || $this->aPriceProductScheduleList->isNew()) {
                    $affectedRows += $this->aPriceProductScheduleList->save($con);
                }
                $this->setPriceProductScheduleList($this->aPriceProductScheduleList);
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

        $this->modifiedColumns[SpyPriceProductScheduleTableMap::COL_ID_PRICE_PRODUCT_SCHEDULE] = true;
        if (null !== $this->id_price_product_schedule) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyPriceProductScheduleTableMap::COL_ID_PRICE_PRODUCT_SCHEDULE . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyPriceProductScheduleTableMap::COL_ID_PRICE_PRODUCT_SCHEDULE)) {
            $modifiedColumns[':p' . $index++]  = 'id_price_product_schedule';
        }
        if ($this->isColumnModified(SpyPriceProductScheduleTableMap::COL_FK_CURRENCY)) {
            $modifiedColumns[':p' . $index++]  = 'fk_currency';
        }
        if ($this->isColumnModified(SpyPriceProductScheduleTableMap::COL_FK_STORE)) {
            $modifiedColumns[':p' . $index++]  = 'fk_store';
        }
        if ($this->isColumnModified(SpyPriceProductScheduleTableMap::COL_FK_PRICE_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'fk_price_type';
        }
        if ($this->isColumnModified(SpyPriceProductScheduleTableMap::COL_FK_PRODUCT)) {
            $modifiedColumns[':p' . $index++]  = 'fk_product';
        }
        if ($this->isColumnModified(SpyPriceProductScheduleTableMap::COL_FK_PRODUCT_ABSTRACT)) {
            $modifiedColumns[':p' . $index++]  = 'fk_product_abstract';
        }
        if ($this->isColumnModified(SpyPriceProductScheduleTableMap::COL_FK_PRICE_PRODUCT_SCHEDULE_LIST)) {
            $modifiedColumns[':p' . $index++]  = 'fk_price_product_schedule_list';
        }
        if ($this->isColumnModified(SpyPriceProductScheduleTableMap::COL_NET_PRICE)) {
            $modifiedColumns[':p' . $index++]  = 'net_price';
        }
        if ($this->isColumnModified(SpyPriceProductScheduleTableMap::COL_GROSS_PRICE)) {
            $modifiedColumns[':p' . $index++]  = 'gross_price';
        }
        if ($this->isColumnModified(SpyPriceProductScheduleTableMap::COL_PRICE_DATA)) {
            $modifiedColumns[':p' . $index++]  = 'price_data';
        }
        if ($this->isColumnModified(SpyPriceProductScheduleTableMap::COL_ACTIVE_FROM)) {
            $modifiedColumns[':p' . $index++]  = 'active_from';
        }
        if ($this->isColumnModified(SpyPriceProductScheduleTableMap::COL_ACTIVE_TO)) {
            $modifiedColumns[':p' . $index++]  = 'active_to';
        }
        if ($this->isColumnModified(SpyPriceProductScheduleTableMap::COL_IS_CURRENT)) {
            $modifiedColumns[':p' . $index++]  = 'is_current';
        }
        if ($this->isColumnModified(SpyPriceProductScheduleTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(SpyPriceProductScheduleTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO spy_price_product_schedule (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_price_product_schedule':
                        $stmt->bindValue($identifier, $this->id_price_product_schedule, PDO::PARAM_INT);

                        break;
                    case 'fk_currency':
                        $stmt->bindValue($identifier, $this->fk_currency, PDO::PARAM_INT);

                        break;
                    case 'fk_store':
                        $stmt->bindValue($identifier, $this->fk_store, PDO::PARAM_INT);

                        break;
                    case 'fk_price_type':
                        $stmt->bindValue($identifier, $this->fk_price_type, PDO::PARAM_INT);

                        break;
                    case 'fk_product':
                        $stmt->bindValue($identifier, $this->fk_product, PDO::PARAM_INT);

                        break;
                    case 'fk_product_abstract':
                        $stmt->bindValue($identifier, $this->fk_product_abstract, PDO::PARAM_INT);

                        break;
                    case 'fk_price_product_schedule_list':
                        $stmt->bindValue($identifier, $this->fk_price_product_schedule_list, PDO::PARAM_INT);

                        break;
                    case 'net_price':
                        $stmt->bindValue($identifier, $this->net_price, PDO::PARAM_INT);

                        break;
                    case 'gross_price':
                        $stmt->bindValue($identifier, $this->gross_price, PDO::PARAM_INT);

                        break;
                    case 'price_data':
                        $stmt->bindValue($identifier, $this->price_data, PDO::PARAM_STR);

                        break;
                    case 'active_from':
                        $stmt->bindValue($identifier, $this->active_from ? $this->active_from->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'active_to':
                        $stmt->bindValue($identifier, $this->active_to ? $this->active_to->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'is_current':
                        $stmt->bindValue($identifier, (int) $this->is_current, PDO::PARAM_INT);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId('spy_price_product_schedule_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdPriceProductSchedule($pk);

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
        $pos = SpyPriceProductScheduleTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdPriceProductSchedule();

            case 1:
                return $this->getFkCurrency();

            case 2:
                return $this->getFkStore();

            case 3:
                return $this->getFkPriceType();

            case 4:
                return $this->getFkProduct();

            case 5:
                return $this->getFkProductAbstract();

            case 6:
                return $this->getFkPriceProductScheduleList();

            case 7:
                return $this->getNetPrice();

            case 8:
                return $this->getGrossPrice();

            case 9:
                return $this->getPriceData();

            case 10:
                return $this->getActiveFrom();

            case 11:
                return $this->getActiveTo();

            case 12:
                return $this->getIsCurrent();

            case 13:
                return $this->getCreatedAt();

            case 14:
                return $this->getUpdatedAt();

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
        if (isset($alreadyDumpedObjects['SpyPriceProductSchedule'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyPriceProductSchedule'][$this->hashCode()] = true;
        $keys = SpyPriceProductScheduleTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdPriceProductSchedule(),
            $keys[1] => $this->getFkCurrency(),
            $keys[2] => $this->getFkStore(),
            $keys[3] => $this->getFkPriceType(),
            $keys[4] => $this->getFkProduct(),
            $keys[5] => $this->getFkProductAbstract(),
            $keys[6] => $this->getFkPriceProductScheduleList(),
            $keys[7] => $this->getNetPrice(),
            $keys[8] => $this->getGrossPrice(),
            $keys[9] => $this->getPriceData(),
            $keys[10] => $this->getActiveFrom(),
            $keys[11] => $this->getActiveTo(),
            $keys[12] => $this->getIsCurrent(),
            $keys[13] => $this->getCreatedAt(),
            $keys[14] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[10]] instanceof \DateTimeInterface) {
            $result[$keys[10]] = $result[$keys[10]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[11]] instanceof \DateTimeInterface) {
            $result[$keys[11]] = $result[$keys[11]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[13]] instanceof \DateTimeInterface) {
            $result[$keys[13]] = $result[$keys[13]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[14]] instanceof \DateTimeInterface) {
            $result[$keys[14]] = $result[$keys[14]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aProduct) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProduct';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product';
                        break;
                    default:
                        $key = 'Product';
                }

                $result[$key] = $this->aProduct->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aProductAbstract) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductAbstract';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_abstract';
                        break;
                    default:
                        $key = 'ProductAbstract';
                }

                $result[$key] = $this->aProductAbstract->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aCurrency) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCurrency';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_currency';
                        break;
                    default:
                        $key = 'Currency';
                }

                $result[$key] = $this->aCurrency->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aStore) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyStore';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_store';
                        break;
                    default:
                        $key = 'Store';
                }

                $result[$key] = $this->aStore->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aPriceType) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyPriceType';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_price_type';
                        break;
                    default:
                        $key = 'PriceType';
                }

                $result[$key] = $this->aPriceType->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aPriceProductScheduleList) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyPriceProductScheduleList';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_price_product_schedule_list';
                        break;
                    default:
                        $key = 'PriceProductScheduleList';
                }

                $result[$key] = $this->aPriceProductScheduleList->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = SpyPriceProductScheduleTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdPriceProductSchedule($value);
                break;
            case 1:
                $this->setFkCurrency($value);
                break;
            case 2:
                $this->setFkStore($value);
                break;
            case 3:
                $this->setFkPriceType($value);
                break;
            case 4:
                $this->setFkProduct($value);
                break;
            case 5:
                $this->setFkProductAbstract($value);
                break;
            case 6:
                $this->setFkPriceProductScheduleList($value);
                break;
            case 7:
                $this->setNetPrice($value);
                break;
            case 8:
                $this->setGrossPrice($value);
                break;
            case 9:
                $this->setPriceData($value);
                break;
            case 10:
                $this->setActiveFrom($value);
                break;
            case 11:
                $this->setActiveTo($value);
                break;
            case 12:
                $this->setIsCurrent($value);
                break;
            case 13:
                $this->setCreatedAt($value);
                break;
            case 14:
                $this->setUpdatedAt($value);
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
        $keys = SpyPriceProductScheduleTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdPriceProductSchedule($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkCurrency($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setFkStore($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setFkPriceType($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setFkProduct($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setFkProductAbstract($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setFkPriceProductScheduleList($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setNetPrice($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setGrossPrice($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setPriceData($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setActiveFrom($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setActiveTo($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setIsCurrent($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setCreatedAt($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setUpdatedAt($arr[$keys[14]]);
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
        $criteria = new Criteria(SpyPriceProductScheduleTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyPriceProductScheduleTableMap::COL_ID_PRICE_PRODUCT_SCHEDULE)) {
            $criteria->add(SpyPriceProductScheduleTableMap::COL_ID_PRICE_PRODUCT_SCHEDULE, $this->id_price_product_schedule);
        }
        if ($this->isColumnModified(SpyPriceProductScheduleTableMap::COL_FK_CURRENCY)) {
            $criteria->add(SpyPriceProductScheduleTableMap::COL_FK_CURRENCY, $this->fk_currency);
        }
        if ($this->isColumnModified(SpyPriceProductScheduleTableMap::COL_FK_STORE)) {
            $criteria->add(SpyPriceProductScheduleTableMap::COL_FK_STORE, $this->fk_store);
        }
        if ($this->isColumnModified(SpyPriceProductScheduleTableMap::COL_FK_PRICE_TYPE)) {
            $criteria->add(SpyPriceProductScheduleTableMap::COL_FK_PRICE_TYPE, $this->fk_price_type);
        }
        if ($this->isColumnModified(SpyPriceProductScheduleTableMap::COL_FK_PRODUCT)) {
            $criteria->add(SpyPriceProductScheduleTableMap::COL_FK_PRODUCT, $this->fk_product);
        }
        if ($this->isColumnModified(SpyPriceProductScheduleTableMap::COL_FK_PRODUCT_ABSTRACT)) {
            $criteria->add(SpyPriceProductScheduleTableMap::COL_FK_PRODUCT_ABSTRACT, $this->fk_product_abstract);
        }
        if ($this->isColumnModified(SpyPriceProductScheduleTableMap::COL_FK_PRICE_PRODUCT_SCHEDULE_LIST)) {
            $criteria->add(SpyPriceProductScheduleTableMap::COL_FK_PRICE_PRODUCT_SCHEDULE_LIST, $this->fk_price_product_schedule_list);
        }
        if ($this->isColumnModified(SpyPriceProductScheduleTableMap::COL_NET_PRICE)) {
            $criteria->add(SpyPriceProductScheduleTableMap::COL_NET_PRICE, $this->net_price);
        }
        if ($this->isColumnModified(SpyPriceProductScheduleTableMap::COL_GROSS_PRICE)) {
            $criteria->add(SpyPriceProductScheduleTableMap::COL_GROSS_PRICE, $this->gross_price);
        }
        if ($this->isColumnModified(SpyPriceProductScheduleTableMap::COL_PRICE_DATA)) {
            $criteria->add(SpyPriceProductScheduleTableMap::COL_PRICE_DATA, $this->price_data);
        }
        if ($this->isColumnModified(SpyPriceProductScheduleTableMap::COL_ACTIVE_FROM)) {
            $criteria->add(SpyPriceProductScheduleTableMap::COL_ACTIVE_FROM, $this->active_from);
        }
        if ($this->isColumnModified(SpyPriceProductScheduleTableMap::COL_ACTIVE_TO)) {
            $criteria->add(SpyPriceProductScheduleTableMap::COL_ACTIVE_TO, $this->active_to);
        }
        if ($this->isColumnModified(SpyPriceProductScheduleTableMap::COL_IS_CURRENT)) {
            $criteria->add(SpyPriceProductScheduleTableMap::COL_IS_CURRENT, $this->is_current);
        }
        if ($this->isColumnModified(SpyPriceProductScheduleTableMap::COL_CREATED_AT)) {
            $criteria->add(SpyPriceProductScheduleTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpyPriceProductScheduleTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpyPriceProductScheduleTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildSpyPriceProductScheduleQuery::create();
        $criteria->add(SpyPriceProductScheduleTableMap::COL_ID_PRICE_PRODUCT_SCHEDULE, $this->id_price_product_schedule);

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
        $validPk = null !== $this->getIdPriceProductSchedule();

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
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->getIdPriceProductSchedule();
    }

    /**
     * Generic method to set the primary key (id_price_product_schedule column).
     *
     * @param string|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?string $key = null): void
    {
        $this->setIdPriceProductSchedule($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdPriceProductSchedule();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductSchedule (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkCurrency($this->getFkCurrency());
        $copyObj->setFkStore($this->getFkStore());
        $copyObj->setFkPriceType($this->getFkPriceType());
        $copyObj->setFkProduct($this->getFkProduct());
        $copyObj->setFkProductAbstract($this->getFkProductAbstract());
        $copyObj->setFkPriceProductScheduleList($this->getFkPriceProductScheduleList());
        $copyObj->setNetPrice($this->getNetPrice());
        $copyObj->setGrossPrice($this->getGrossPrice());
        $copyObj->setPriceData($this->getPriceData());
        $copyObj->setActiveFrom($this->getActiveFrom());
        $copyObj->setActiveTo($this->getActiveTo());
        $copyObj->setIsCurrent($this->getIsCurrent());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdPriceProductSchedule(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductSchedule Clone of current object.
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
     * Declares an association between this object and a SpyProduct object.
     *
     * @param SpyProduct|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setProduct(SpyProduct $v = null)
    {
        if ($v === null) {
            $this->setFkProduct(NULL);
        } else {
            $this->setFkProduct($v->getIdProduct());
        }

        $this->aProduct = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyProduct object, it will not be re-added.
        if ($v !== null) {
            $v->addPriceProductSchedule($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyProduct object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyProduct|null The associated SpyProduct object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getProduct(?ConnectionInterface $con = null)
    {
        if ($this->aProduct === null && ($this->fk_product != 0)) {
            $this->aProduct = SpyProductQuery::create()->findPk($this->fk_product, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aProduct->addPriceProductSchedules($this);
             */
        }

        return $this->aProduct;
    }

    /**
     * Declares an association between this object and a SpyProductAbstract object.
     *
     * @param SpyProductAbstract|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setProductAbstract(SpyProductAbstract $v = null)
    {
        if ($v === null) {
            $this->setFkProductAbstract(NULL);
        } else {
            $this->setFkProductAbstract($v->getIdProductAbstract());
        }

        $this->aProductAbstract = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyProductAbstract object, it will not be re-added.
        if ($v !== null) {
            $v->addPriceProductSchedule($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyProductAbstract object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyProductAbstract|null The associated SpyProductAbstract object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getProductAbstract(?ConnectionInterface $con = null)
    {
        if ($this->aProductAbstract === null && ($this->fk_product_abstract != 0)) {
            $this->aProductAbstract = SpyProductAbstractQuery::create()->findPk($this->fk_product_abstract, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aProductAbstract->addPriceProductSchedules($this);
             */
        }

        return $this->aProductAbstract;
    }

    /**
     * Declares an association between this object and a SpyCurrency object.
     *
     * @param SpyCurrency $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setCurrency(SpyCurrency $v = null)
    {
        if ($v === null) {
            $this->setFkCurrency(NULL);
        } else {
            $this->setFkCurrency($v->getIdCurrency());
        }

        $this->aCurrency = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyCurrency object, it will not be re-added.
        if ($v !== null) {
            $v->addPriceProductSchedule($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyCurrency object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyCurrency The associated SpyCurrency object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCurrency(?ConnectionInterface $con = null)
    {
        if ($this->aCurrency === null && ($this->fk_currency != 0)) {
            $this->aCurrency = SpyCurrencyQuery::create()->findPk($this->fk_currency, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCurrency->addPriceProductSchedules($this);
             */
        }

        return $this->aCurrency;
    }

    /**
     * Declares an association between this object and a SpyStore object.
     *
     * @param SpyStore $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setStore(SpyStore $v = null)
    {
        if ($v === null) {
            $this->setFkStore(NULL);
        } else {
            $this->setFkStore($v->getIdStore());
        }

        $this->aStore = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyStore object, it will not be re-added.
        if ($v !== null) {
            $v->addPriceProductSchedule($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyStore object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyStore The associated SpyStore object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getStore(?ConnectionInterface $con = null)
    {
        if ($this->aStore === null && ($this->fk_store != 0)) {
            $this->aStore = SpyStoreQuery::create()->findPk($this->fk_store, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aStore->addPriceProductSchedules($this);
             */
        }

        return $this->aStore;
    }

    /**
     * Declares an association between this object and a SpyPriceType object.
     *
     * @param SpyPriceType $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setPriceType(SpyPriceType $v = null)
    {
        if ($v === null) {
            $this->setFkPriceType(NULL);
        } else {
            $this->setFkPriceType($v->getIdPriceType());
        }

        $this->aPriceType = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyPriceType object, it will not be re-added.
        if ($v !== null) {
            $v->addPriceProductSchedule($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyPriceType object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyPriceType The associated SpyPriceType object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getPriceType(?ConnectionInterface $con = null)
    {
        if ($this->aPriceType === null && ($this->fk_price_type != 0)) {
            $this->aPriceType = SpyPriceTypeQuery::create()->findPk($this->fk_price_type, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPriceType->addPriceProductSchedules($this);
             */
        }

        return $this->aPriceType;
    }

    /**
     * Declares an association between this object and a ChildSpyPriceProductScheduleList object.
     *
     * @param ChildSpyPriceProductScheduleList $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setPriceProductScheduleList(ChildSpyPriceProductScheduleList $v = null)
    {
        if ($v === null) {
            $this->setFkPriceProductScheduleList(NULL);
        } else {
            $this->setFkPriceProductScheduleList($v->getIdPriceProductScheduleList());
        }

        $this->aPriceProductScheduleList = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpyPriceProductScheduleList object, it will not be re-added.
        if ($v !== null) {
            $v->addPriceProductSchedule($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpyPriceProductScheduleList object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSpyPriceProductScheduleList The associated ChildSpyPriceProductScheduleList object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getPriceProductScheduleList(?ConnectionInterface $con = null)
    {
        if ($this->aPriceProductScheduleList === null && (($this->fk_price_product_schedule_list !== "" && $this->fk_price_product_schedule_list !== null))) {
            $this->aPriceProductScheduleList = ChildSpyPriceProductScheduleListQuery::create()->findPk($this->fk_price_product_schedule_list, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPriceProductScheduleList->addPriceProductSchedules($this);
             */
        }

        return $this->aPriceProductScheduleList;
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
        if (null !== $this->aProduct) {
            $this->aProduct->removePriceProductSchedule($this);
        }
        if (null !== $this->aProductAbstract) {
            $this->aProductAbstract->removePriceProductSchedule($this);
        }
        if (null !== $this->aCurrency) {
            $this->aCurrency->removePriceProductSchedule($this);
        }
        if (null !== $this->aStore) {
            $this->aStore->removePriceProductSchedule($this);
        }
        if (null !== $this->aPriceType) {
            $this->aPriceType->removePriceProductSchedule($this);
        }
        if (null !== $this->aPriceProductScheduleList) {
            $this->aPriceProductScheduleList->removePriceProductSchedule($this);
        }
        $this->id_price_product_schedule = null;
        $this->fk_currency = null;
        $this->fk_store = null;
        $this->fk_price_type = null;
        $this->fk_product = null;
        $this->fk_product_abstract = null;
        $this->fk_price_product_schedule_list = null;
        $this->net_price = null;
        $this->gross_price = null;
        $this->price_data = null;
        $this->active_from = null;
        $this->active_to = null;
        $this->is_current = null;
        $this->created_at = null;
        $this->updated_at = null;
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
        } // if ($deep)

        $this->aProduct = null;
        $this->aProductAbstract = null;
        $this->aCurrency = null;
        $this->aStore = null;
        $this->aPriceType = null;
        $this->aPriceProductScheduleList = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyPriceProductScheduleTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return $this The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[SpyPriceProductScheduleTableMap::COL_UPDATED_AT] = true;

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
