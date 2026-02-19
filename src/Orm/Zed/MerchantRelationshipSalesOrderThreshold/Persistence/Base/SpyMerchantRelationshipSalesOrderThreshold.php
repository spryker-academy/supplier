<?php

namespace Orm\Zed\MerchantRelationshipSalesOrderThreshold\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\Currency\Persistence\SpyCurrency;
use Orm\Zed\Currency\Persistence\SpyCurrencyQuery;
use Orm\Zed\MerchantRelationshipSalesOrderThreshold\Persistence\SpyMerchantRelationshipSalesOrderThresholdQuery as ChildSpyMerchantRelationshipSalesOrderThresholdQuery;
use Orm\Zed\MerchantRelationshipSalesOrderThreshold\Persistence\Map\SpyMerchantRelationshipSalesOrderThresholdTableMap;
use Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationship;
use Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipQuery;
use Orm\Zed\SalesOrderThreshold\Persistence\SpySalesOrderThresholdType;
use Orm\Zed\SalesOrderThreshold\Persistence\SpySalesOrderThresholdTypeQuery;
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
 * Base class that represents a row from the 'spy_merchant_relationship_sales_order_threshold' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.MerchantRelationshipSalesOrderThreshold.Persistence.Base
 */
abstract class SpyMerchantRelationshipSalesOrderThreshold implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\MerchantRelationshipSalesOrderThreshold\\Persistence\\Map\\SpyMerchantRelationshipSalesOrderThresholdTableMap';


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
     * The value for the id_merchant_relationship_sales_order_threshold field.
     *
     * @var        int
     */
    protected $id_merchant_relationship_sales_order_threshold;

    /**
     * The value for the fk_currency field.
     *
     * @var        int
     */
    protected $fk_currency;

    /**
     * The value for the fk_merchant_relationship field.
     *
     * @var        int
     */
    protected $fk_merchant_relationship;

    /**
     * The value for the fk_sales_order_threshold_type field.
     *
     * @var        int
     */
    protected $fk_sales_order_threshold_type;

    /**
     * The value for the fk_store field.
     *
     * @var        int
     */
    protected $fk_store;

    /**
     * The value for the fee field.
     * A fee associated with a sales order threshold.
     * @var        int|null
     */
    protected $fee;

    /**
     * The value for the message_glossary_key field.
     * A glossary key for the message displayed when a sales order threshold is met.
     * @var        string
     */
    protected $message_glossary_key;

    /**
     * The value for the threshold field.
     * The value for a sales order threshold.
     * @var        int
     */
    protected $threshold;

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
     * @var        SpyMerchantRelationship
     */
    protected $aMerchantRelationship;

    /**
     * @var        SpySalesOrderThresholdType
     */
    protected $aSalesOrderThresholdType;

    /**
     * @var        SpyCurrency
     */
    protected $aCurrency;

    /**
     * @var        SpyStore
     */
    protected $aStore;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of Orm\Zed\MerchantRelationshipSalesOrderThreshold\Persistence\Base\SpyMerchantRelationshipSalesOrderThreshold object.
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
     * Compares this with another <code>SpyMerchantRelationshipSalesOrderThreshold</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyMerchantRelationshipSalesOrderThreshold</code>, delegates to
     * <code>equals(SpyMerchantRelationshipSalesOrderThreshold)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_merchant_relationship_sales_order_threshold] column value.
     *
     * @return int
     */
    public function getIdMerchantRelationshipSalesOrderThreshold()
    {
        return $this->id_merchant_relationship_sales_order_threshold;
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
     * Get the [fk_merchant_relationship] column value.
     *
     * @return int
     */
    public function getFkMerchantRelationship()
    {
        return $this->fk_merchant_relationship;
    }

    /**
     * Get the [fk_sales_order_threshold_type] column value.
     *
     * @return int
     */
    public function getFkSalesOrderThresholdType()
    {
        return $this->fk_sales_order_threshold_type;
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
     * Get the [fee] column value.
     * A fee associated with a sales order threshold.
     * @return int|null
     */
    public function getFee()
    {
        return $this->fee;
    }

    /**
     * Get the [message_glossary_key] column value.
     * A glossary key for the message displayed when a sales order threshold is met.
     * @return string
     */
    public function getMessageGlossaryKey()
    {
        return $this->message_glossary_key;
    }

    /**
     * Get the [threshold] column value.
     * The value for a sales order threshold.
     * @return int
     */
    public function getThreshold()
    {
        return $this->threshold;
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
     * Set the value of [id_merchant_relationship_sales_order_threshold] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdMerchantRelationshipSalesOrderThreshold($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_merchant_relationship_sales_order_threshold !== $v) {
            $this->id_merchant_relationship_sales_order_threshold = $v;
            $this->modifiedColumns[SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_ID_MERCHANT_RELATIONSHIP_SALES_ORDER_THRESHOLD] = true;
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
            $this->modifiedColumns[SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FK_CURRENCY] = true;
        }

        if ($this->aCurrency !== null && $this->aCurrency->getIdCurrency() !== $v) {
            $this->aCurrency = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_merchant_relationship] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkMerchantRelationship($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_merchant_relationship !== $v) {
            $this->fk_merchant_relationship = $v;
            $this->modifiedColumns[SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FK_MERCHANT_RELATIONSHIP] = true;
        }

        if ($this->aMerchantRelationship !== null && $this->aMerchantRelationship->getIdMerchantRelationship() !== $v) {
            $this->aMerchantRelationship = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_sales_order_threshold_type] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkSalesOrderThresholdType($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_sales_order_threshold_type !== $v) {
            $this->fk_sales_order_threshold_type = $v;
            $this->modifiedColumns[SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FK_SALES_ORDER_THRESHOLD_TYPE] = true;
        }

        if ($this->aSalesOrderThresholdType !== null && $this->aSalesOrderThresholdType->getIdSalesOrderThresholdType() !== $v) {
            $this->aSalesOrderThresholdType = null;
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
            $this->modifiedColumns[SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FK_STORE] = true;
        }

        if ($this->aStore !== null && $this->aStore->getIdStore() !== $v) {
            $this->aStore = null;
        }

        return $this;
    }

    /**
     * Set the value of [fee] column.
     * A fee associated with a sales order threshold.
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFee($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fee !== $v) {
            $this->fee = $v;
            $this->modifiedColumns[SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FEE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [message_glossary_key] column.
     * A glossary key for the message displayed when a sales order threshold is met.
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMessageGlossaryKey($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->message_glossary_key !== $v) {
            $this->message_glossary_key = $v;
            $this->modifiedColumns[SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_MESSAGE_GLOSSARY_KEY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [threshold] column.
     * The value for a sales order threshold.
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setThreshold($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->threshold !== $v) {
            $this->threshold = $v;
            $this->modifiedColumns[SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_THRESHOLD] = true;
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
                $this->modifiedColumns[SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyMerchantRelationshipSalesOrderThresholdTableMap::translateFieldName('IdMerchantRelationshipSalesOrderThreshold', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_merchant_relationship_sales_order_threshold = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyMerchantRelationshipSalesOrderThresholdTableMap::translateFieldName('FkCurrency', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_currency = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyMerchantRelationshipSalesOrderThresholdTableMap::translateFieldName('FkMerchantRelationship', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_merchant_relationship = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyMerchantRelationshipSalesOrderThresholdTableMap::translateFieldName('FkSalesOrderThresholdType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_sales_order_threshold_type = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyMerchantRelationshipSalesOrderThresholdTableMap::translateFieldName('FkStore', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_store = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyMerchantRelationshipSalesOrderThresholdTableMap::translateFieldName('Fee', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fee = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpyMerchantRelationshipSalesOrderThresholdTableMap::translateFieldName('MessageGlossaryKey', TableMap::TYPE_PHPNAME, $indexType)];
            $this->message_glossary_key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpyMerchantRelationshipSalesOrderThresholdTableMap::translateFieldName('Threshold', TableMap::TYPE_PHPNAME, $indexType)];
            $this->threshold = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SpyMerchantRelationshipSalesOrderThresholdTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SpyMerchantRelationshipSalesOrderThresholdTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = SpyMerchantRelationshipSalesOrderThresholdTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\MerchantRelationshipSalesOrderThreshold\\Persistence\\SpyMerchantRelationshipSalesOrderThreshold'), 0, $e);
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
        if ($this->aMerchantRelationship !== null && $this->fk_merchant_relationship !== $this->aMerchantRelationship->getIdMerchantRelationship()) {
            $this->aMerchantRelationship = null;
        }
        if ($this->aSalesOrderThresholdType !== null && $this->fk_sales_order_threshold_type !== $this->aSalesOrderThresholdType->getIdSalesOrderThresholdType()) {
            $this->aSalesOrderThresholdType = null;
        }
        if ($this->aStore !== null && $this->fk_store !== $this->aStore->getIdStore()) {
            $this->aStore = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyMerchantRelationshipSalesOrderThresholdTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyMerchantRelationshipSalesOrderThresholdQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aMerchantRelationship = null;
            $this->aSalesOrderThresholdType = null;
            $this->aCurrency = null;
            $this->aStore = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyMerchantRelationshipSalesOrderThreshold::setDeleted()
     * @see SpyMerchantRelationshipSalesOrderThreshold::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantRelationshipSalesOrderThresholdTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyMerchantRelationshipSalesOrderThresholdQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantRelationshipSalesOrderThresholdTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                $time = time();
                $highPrecision = \Propel\Runtime\Util\PropelDateTime::createHighPrecision();
                if (!$this->isColumnModified(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_UPDATED_AT)) {
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
                if ($this->isModified() && !$this->isColumnModified(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_UPDATED_AT)) {
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
                SpyMerchantRelationshipSalesOrderThresholdTableMap::addInstanceToPool($this);
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

            if ($this->aMerchantRelationship !== null) {
                if ($this->aMerchantRelationship->isModified() || $this->aMerchantRelationship->isNew()) {
                    $affectedRows += $this->aMerchantRelationship->save($con);
                }
                $this->setMerchantRelationship($this->aMerchantRelationship);
            }

            if ($this->aSalesOrderThresholdType !== null) {
                if ($this->aSalesOrderThresholdType->isModified() || $this->aSalesOrderThresholdType->isNew()) {
                    $affectedRows += $this->aSalesOrderThresholdType->save($con);
                }
                $this->setSalesOrderThresholdType($this->aSalesOrderThresholdType);
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

        $this->modifiedColumns[SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_ID_MERCHANT_RELATIONSHIP_SALES_ORDER_THRESHOLD] = true;

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_ID_MERCHANT_RELATIONSHIP_SALES_ORDER_THRESHOLD)) {
            $modifiedColumns[':p' . $index++]  = '`id_merchant_relationship_sales_order_threshold`';
        }
        if ($this->isColumnModified(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FK_CURRENCY)) {
            $modifiedColumns[':p' . $index++]  = '`fk_currency`';
        }
        if ($this->isColumnModified(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FK_MERCHANT_RELATIONSHIP)) {
            $modifiedColumns[':p' . $index++]  = '`fk_merchant_relationship`';
        }
        if ($this->isColumnModified(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FK_SALES_ORDER_THRESHOLD_TYPE)) {
            $modifiedColumns[':p' . $index++]  = '`fk_sales_order_threshold_type`';
        }
        if ($this->isColumnModified(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FK_STORE)) {
            $modifiedColumns[':p' . $index++]  = '`fk_store`';
        }
        if ($this->isColumnModified(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FEE)) {
            $modifiedColumns[':p' . $index++]  = '`fee`';
        }
        if ($this->isColumnModified(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_MESSAGE_GLOSSARY_KEY)) {
            $modifiedColumns[':p' . $index++]  = '`message_glossary_key`';
        }
        if ($this->isColumnModified(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_THRESHOLD)) {
            $modifiedColumns[':p' . $index++]  = '`threshold`';
        }
        if ($this->isColumnModified(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }

        $sql = sprintf(
            'INSERT INTO `spy_merchant_relationship_sales_order_threshold` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id_merchant_relationship_sales_order_threshold`':
                        $stmt->bindValue($identifier, $this->id_merchant_relationship_sales_order_threshold, PDO::PARAM_INT);

                        break;
                    case '`fk_currency`':
                        $stmt->bindValue($identifier, $this->fk_currency, PDO::PARAM_INT);

                        break;
                    case '`fk_merchant_relationship`':
                        $stmt->bindValue($identifier, $this->fk_merchant_relationship, PDO::PARAM_INT);

                        break;
                    case '`fk_sales_order_threshold_type`':
                        $stmt->bindValue($identifier, $this->fk_sales_order_threshold_type, PDO::PARAM_INT);

                        break;
                    case '`fk_store`':
                        $stmt->bindValue($identifier, $this->fk_store, PDO::PARAM_INT);

                        break;
                    case '`fee`':
                        $stmt->bindValue($identifier, $this->fee, PDO::PARAM_INT);

                        break;
                    case '`message_glossary_key`':
                        $stmt->bindValue($identifier, $this->message_glossary_key, PDO::PARAM_STR);

                        break;
                    case '`threshold`':
                        $stmt->bindValue($identifier, $this->threshold, PDO::PARAM_INT);

                        break;
                    case '`created_at`':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case '`updated_at`':
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
            $pk = $con->lastInsertId('id_merchant_relationship_sales_order_threshold_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        if ($pk !== null) {
            $this->setIdMerchantRelationshipSalesOrderThreshold($pk);
        }

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
        $pos = SpyMerchantRelationshipSalesOrderThresholdTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdMerchantRelationshipSalesOrderThreshold();

            case 1:
                return $this->getFkCurrency();

            case 2:
                return $this->getFkMerchantRelationship();

            case 3:
                return $this->getFkSalesOrderThresholdType();

            case 4:
                return $this->getFkStore();

            case 5:
                return $this->getFee();

            case 6:
                return $this->getMessageGlossaryKey();

            case 7:
                return $this->getThreshold();

            case 8:
                return $this->getCreatedAt();

            case 9:
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
        if (isset($alreadyDumpedObjects['SpyMerchantRelationshipSalesOrderThreshold'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyMerchantRelationshipSalesOrderThreshold'][$this->hashCode()] = true;
        $keys = SpyMerchantRelationshipSalesOrderThresholdTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdMerchantRelationshipSalesOrderThreshold(),
            $keys[1] => $this->getFkCurrency(),
            $keys[2] => $this->getFkMerchantRelationship(),
            $keys[3] => $this->getFkSalesOrderThresholdType(),
            $keys[4] => $this->getFkStore(),
            $keys[5] => $this->getFee(),
            $keys[6] => $this->getMessageGlossaryKey(),
            $keys[7] => $this->getThreshold(),
            $keys[8] => $this->getCreatedAt(),
            $keys[9] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[9]] instanceof \DateTimeInterface) {
            $result[$keys[9]] = $result[$keys[9]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aMerchantRelationship) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchantRelationship';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant_relationship';
                        break;
                    default:
                        $key = 'MerchantRelationship';
                }

                $result[$key] = $this->aMerchantRelationship->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aSalesOrderThresholdType) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesOrderThresholdType';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_order_threshold_type';
                        break;
                    default:
                        $key = 'SalesOrderThresholdType';
                }

                $result[$key] = $this->aSalesOrderThresholdType->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = SpyMerchantRelationshipSalesOrderThresholdTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdMerchantRelationshipSalesOrderThreshold($value);
                break;
            case 1:
                $this->setFkCurrency($value);
                break;
            case 2:
                $this->setFkMerchantRelationship($value);
                break;
            case 3:
                $this->setFkSalesOrderThresholdType($value);
                break;
            case 4:
                $this->setFkStore($value);
                break;
            case 5:
                $this->setFee($value);
                break;
            case 6:
                $this->setMessageGlossaryKey($value);
                break;
            case 7:
                $this->setThreshold($value);
                break;
            case 8:
                $this->setCreatedAt($value);
                break;
            case 9:
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
        $keys = SpyMerchantRelationshipSalesOrderThresholdTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdMerchantRelationshipSalesOrderThreshold($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkCurrency($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setFkMerchantRelationship($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setFkSalesOrderThresholdType($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setFkStore($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setFee($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setMessageGlossaryKey($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setThreshold($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCreatedAt($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setUpdatedAt($arr[$keys[9]]);
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
        $criteria = new Criteria(SpyMerchantRelationshipSalesOrderThresholdTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_ID_MERCHANT_RELATIONSHIP_SALES_ORDER_THRESHOLD)) {
            $criteria->add(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_ID_MERCHANT_RELATIONSHIP_SALES_ORDER_THRESHOLD, $this->id_merchant_relationship_sales_order_threshold);
        }
        if ($this->isColumnModified(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FK_CURRENCY)) {
            $criteria->add(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FK_CURRENCY, $this->fk_currency);
        }
        if ($this->isColumnModified(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FK_MERCHANT_RELATIONSHIP)) {
            $criteria->add(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FK_MERCHANT_RELATIONSHIP, $this->fk_merchant_relationship);
        }
        if ($this->isColumnModified(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FK_SALES_ORDER_THRESHOLD_TYPE)) {
            $criteria->add(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FK_SALES_ORDER_THRESHOLD_TYPE, $this->fk_sales_order_threshold_type);
        }
        if ($this->isColumnModified(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FK_STORE)) {
            $criteria->add(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FK_STORE, $this->fk_store);
        }
        if ($this->isColumnModified(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FEE)) {
            $criteria->add(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FEE, $this->fee);
        }
        if ($this->isColumnModified(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_MESSAGE_GLOSSARY_KEY)) {
            $criteria->add(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_MESSAGE_GLOSSARY_KEY, $this->message_glossary_key);
        }
        if ($this->isColumnModified(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_THRESHOLD)) {
            $criteria->add(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_THRESHOLD, $this->threshold);
        }
        if ($this->isColumnModified(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_CREATED_AT)) {
            $criteria->add(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildSpyMerchantRelationshipSalesOrderThresholdQuery::create();
        $criteria->add(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_ID_MERCHANT_RELATIONSHIP_SALES_ORDER_THRESHOLD, $this->id_merchant_relationship_sales_order_threshold);

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
        $validPk = null !== $this->getIdMerchantRelationshipSalesOrderThreshold();

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
        return $this->getIdMerchantRelationshipSalesOrderThreshold();
    }

    /**
     * Generic method to set the primary key (id_merchant_relationship_sales_order_threshold column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdMerchantRelationshipSalesOrderThreshold($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdMerchantRelationshipSalesOrderThreshold();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\MerchantRelationshipSalesOrderThreshold\Persistence\SpyMerchantRelationshipSalesOrderThreshold (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkCurrency($this->getFkCurrency());
        $copyObj->setFkMerchantRelationship($this->getFkMerchantRelationship());
        $copyObj->setFkSalesOrderThresholdType($this->getFkSalesOrderThresholdType());
        $copyObj->setFkStore($this->getFkStore());
        $copyObj->setFee($this->getFee());
        $copyObj->setMessageGlossaryKey($this->getMessageGlossaryKey());
        $copyObj->setThreshold($this->getThreshold());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdMerchantRelationshipSalesOrderThreshold(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\MerchantRelationshipSalesOrderThreshold\Persistence\SpyMerchantRelationshipSalesOrderThreshold Clone of current object.
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
     * Declares an association between this object and a SpyMerchantRelationship object.
     *
     * @param SpyMerchantRelationship $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setMerchantRelationship(SpyMerchantRelationship $v = null)
    {
        if ($v === null) {
            $this->setFkMerchantRelationship(NULL);
        } else {
            $this->setFkMerchantRelationship($v->getIdMerchantRelationship());
        }

        $this->aMerchantRelationship = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyMerchantRelationship object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyMerchantRelationshipSalesOrderThreshold($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyMerchantRelationship object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyMerchantRelationship The associated SpyMerchantRelationship object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getMerchantRelationship(?ConnectionInterface $con = null)
    {
        if ($this->aMerchantRelationship === null && ($this->fk_merchant_relationship != 0)) {
            $this->aMerchantRelationship = SpyMerchantRelationshipQuery::create()->findPk($this->fk_merchant_relationship, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aMerchantRelationship->addSpyMerchantRelationshipSalesOrderThresholds($this);
             */
        }

        return $this->aMerchantRelationship;
    }

    /**
     * Declares an association between this object and a SpySalesOrderThresholdType object.
     *
     * @param SpySalesOrderThresholdType $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setSalesOrderThresholdType(SpySalesOrderThresholdType $v = null)
    {
        if ($v === null) {
            $this->setFkSalesOrderThresholdType(NULL);
        } else {
            $this->setFkSalesOrderThresholdType($v->getIdSalesOrderThresholdType());
        }

        $this->aSalesOrderThresholdType = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpySalesOrderThresholdType object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyMerchantRelationshipSalesOrderThreshold($this);
        }


        return $this;
    }


    /**
     * Get the associated SpySalesOrderThresholdType object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpySalesOrderThresholdType The associated SpySalesOrderThresholdType object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSalesOrderThresholdType(?ConnectionInterface $con = null)
    {
        if ($this->aSalesOrderThresholdType === null && ($this->fk_sales_order_threshold_type != 0)) {
            $this->aSalesOrderThresholdType = SpySalesOrderThresholdTypeQuery::create()->findPk($this->fk_sales_order_threshold_type, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSalesOrderThresholdType->addSpyMerchantRelationshipSalesOrderThresholds($this);
             */
        }

        return $this->aSalesOrderThresholdType;
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
            $v->addSpyMerchantRelationshipSalesOrderThreshold($this);
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
                $this->aCurrency->addSpyMerchantRelationshipSalesOrderThresholds($this);
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
            $v->addSpyMerchantRelationshipSalesOrderThreshold($this);
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
                $this->aStore->addSpyMerchantRelationshipSalesOrderThresholds($this);
             */
        }

        return $this->aStore;
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
        if (null !== $this->aMerchantRelationship) {
            $this->aMerchantRelationship->removeSpyMerchantRelationshipSalesOrderThreshold($this);
        }
        if (null !== $this->aSalesOrderThresholdType) {
            $this->aSalesOrderThresholdType->removeSpyMerchantRelationshipSalesOrderThreshold($this);
        }
        if (null !== $this->aCurrency) {
            $this->aCurrency->removeSpyMerchantRelationshipSalesOrderThreshold($this);
        }
        if (null !== $this->aStore) {
            $this->aStore->removeSpyMerchantRelationshipSalesOrderThreshold($this);
        }
        $this->id_merchant_relationship_sales_order_threshold = null;
        $this->fk_currency = null;
        $this->fk_merchant_relationship = null;
        $this->fk_sales_order_threshold_type = null;
        $this->fk_store = null;
        $this->fee = null;
        $this->message_glossary_key = null;
        $this->threshold = null;
        $this->created_at = null;
        $this->updated_at = null;
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
        } // if ($deep)

        $this->aMerchantRelationship = null;
        $this->aSalesOrderThresholdType = null;
        $this->aCurrency = null;
        $this->aStore = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyMerchantRelationshipSalesOrderThresholdTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return $this The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_UPDATED_AT] = true;

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
