<?php

namespace Orm\Zed\MerchantCommission\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommission as ChildSpyMerchantCommission;
use Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionAmount as ChildSpyMerchantCommissionAmount;
use Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionAmountQuery as ChildSpyMerchantCommissionAmountQuery;
use Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionGroup as ChildSpyMerchantCommissionGroup;
use Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionGroupQuery as ChildSpyMerchantCommissionGroupQuery;
use Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchant as ChildSpyMerchantCommissionMerchant;
use Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchantQuery as ChildSpyMerchantCommissionMerchantQuery;
use Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionQuery as ChildSpyMerchantCommissionQuery;
use Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStore as ChildSpyMerchantCommissionStore;
use Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStoreQuery as ChildSpyMerchantCommissionStoreQuery;
use Orm\Zed\MerchantCommission\Persistence\Map\SpyMerchantCommissionAmountTableMap;
use Orm\Zed\MerchantCommission\Persistence\Map\SpyMerchantCommissionMerchantTableMap;
use Orm\Zed\MerchantCommission\Persistence\Map\SpyMerchantCommissionStoreTableMap;
use Orm\Zed\MerchantCommission\Persistence\Map\SpyMerchantCommissionTableMap;
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
use Propel\Runtime\Util\PropelDateTime;
use Spryker\Zed\PropelReplicationCache\Business\PropelReplicationCacheFacade;

/**
 * Base class that represents a row from the 'spy_merchant_commission' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.MerchantCommission.Persistence.Base
 */
abstract class SpyMerchantCommission implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\MerchantCommission\\Persistence\\Map\\SpyMerchantCommissionTableMap';


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
     * The value for the id_merchant_commission field.
     *
     * @var        int
     */
    protected $id_merchant_commission;

    /**
     * The value for the fk_merchant_commission_group field.
     *
     * @var        int
     */
    protected $fk_merchant_commission_group;

    /**
     * The value for the uuid field.
     * A Universally Unique Identifier for an entity.
     * @var        string|null
     */
    protected $uuid;

    /**
     * The value for the name field.
     * The name of an entity (e.g., user, category, product, role).
     * @var        string
     */
    protected $name;

    /**
     * The value for the description field.
     * A description of an entity.
     * @var        string|null
     */
    protected $description;

    /**
     * The value for the key field.
     * A unique key used to identify an entity or a piece of data.
     * @var        string
     */
    protected $key;

    /**
     * The value for the amount field.
     * A numerical value, often used for price, quantity, or discount.
     * @var        int|null
     */
    protected $amount;

    /**
     * The value for the is_active field.
     * A boolean flag indicating if an entity is currently active.
     * @var        boolean
     */
    protected $is_active;

    /**
     * The value for the valid_from field.
     * The date and time from which an entity is valid.
     * @var        DateTime|null
     */
    protected $valid_from;

    /**
     * The value for the valid_to field.
     * The date and time until which an entity is valid.
     * @var        DateTime|null
     */
    protected $valid_to;

    /**
     * The value for the priority field.
     * A numerical value that determines the order of processing or application, with lower numbers often having higher priority.
     * Note: this column has a database default value of: 9999
     * @var        int
     */
    protected $priority;

    /**
     * The value for the item_condition field.
     * A condition that applies to individual items for a merchant commission.
     * @var        string|null
     */
    protected $item_condition;

    /**
     * The value for the order_condition field.
     * A query string defining the conditions the entire order must meet for a merchant commission to apply.
     * @var        string|null
     */
    protected $order_condition;

    /**
     * The value for the calculator_type_plugin field.
     * The plugin used for a specific type of calculation.
     * @var        string
     */
    protected $calculator_type_plugin;

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
     * @var        ChildSpyMerchantCommissionGroup
     */
    protected $aMerchantCommissionGroup;

    /**
     * @var        ObjectCollection|ChildSpyMerchantCommissionAmount[] Collection to store aggregation of ChildSpyMerchantCommissionAmount objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyMerchantCommissionAmount> Collection to store aggregation of ChildSpyMerchantCommissionAmount objects.
     */
    protected $collMerchantCommissionAmounts;
    protected $collMerchantCommissionAmountsPartial;

    /**
     * @var        ObjectCollection|ChildSpyMerchantCommissionStore[] Collection to store aggregation of ChildSpyMerchantCommissionStore objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyMerchantCommissionStore> Collection to store aggregation of ChildSpyMerchantCommissionStore objects.
     */
    protected $collMerchantCommissionStores;
    protected $collMerchantCommissionStoresPartial;

    /**
     * @var        ObjectCollection|ChildSpyMerchantCommissionMerchant[] Collection to store aggregation of ChildSpyMerchantCommissionMerchant objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyMerchantCommissionMerchant> Collection to store aggregation of ChildSpyMerchantCommissionMerchant objects.
     */
    protected $collMerchantCommissionMerchants;
    protected $collMerchantCommissionMerchantsPartial;

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
     * @var ObjectCollection|ChildSpyMerchantCommissionAmount[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyMerchantCommissionAmount>
     */
    protected $merchantCommissionAmountsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyMerchantCommissionStore[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyMerchantCommissionStore>
     */
    protected $merchantCommissionStoresScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyMerchantCommissionMerchant[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyMerchantCommissionMerchant>
     */
    protected $merchantCommissionMerchantsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->priority = 9999;
    }

    /**
     * Initializes internal state of Orm\Zed\MerchantCommission\Persistence\Base\SpyMerchantCommission object.
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
     * Compares this with another <code>SpyMerchantCommission</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyMerchantCommission</code>, delegates to
     * <code>equals(SpyMerchantCommission)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_merchant_commission] column value.
     *
     * @return int
     */
    public function getIdMerchantCommission()
    {
        return $this->id_merchant_commission;
    }

    /**
     * Get the [fk_merchant_commission_group] column value.
     *
     * @return int
     */
    public function getFkMerchantCommissionGroup()
    {
        return $this->fk_merchant_commission_group;
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
     * Get the [name] column value.
     * The name of an entity (e.g., user, category, product, role).
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [description] column value.
     * A description of an entity.
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the [key] column value.
     * A unique key used to identify an entity or a piece of data.
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Get the [amount] column value.
     * A numerical value, often used for price, quantity, or discount.
     * @return int|null
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Get the [is_active] column value.
     * A boolean flag indicating if an entity is currently active.
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * Get the [is_active] column value.
     * A boolean flag indicating if an entity is currently active.
     * @return boolean
     */
    public function isActive()
    {
        return $this->getIsActive();
    }

    /**
     * Get the [optionally formatted] temporal [valid_from] column value.
     * The date and time from which an entity is valid.
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
    public function getValidFrom($format = null)
    {
        if ($format === null) {
            return $this->valid_from;
        } else {
            return $this->valid_from instanceof \DateTimeInterface ? $this->valid_from->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [valid_to] column value.
     * The date and time until which an entity is valid.
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
    public function getValidTo($format = null)
    {
        if ($format === null) {
            return $this->valid_to;
        } else {
            return $this->valid_to instanceof \DateTimeInterface ? $this->valid_to->format($format) : null;
        }
    }

    /**
     * Get the [priority] column value.
     * A numerical value that determines the order of processing or application, with lower numbers often having higher priority.
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Get the [item_condition] column value.
     * A condition that applies to individual items for a merchant commission.
     * @return string|null
     */
    public function getItemCondition()
    {
        return $this->item_condition;
    }

    /**
     * Get the [order_condition] column value.
     * A query string defining the conditions the entire order must meet for a merchant commission to apply.
     * @return string|null
     */
    public function getOrderCondition()
    {
        return $this->order_condition;
    }

    /**
     * Get the [calculator_type_plugin] column value.
     * The plugin used for a specific type of calculation.
     * @return string
     */
    public function getCalculatorTypePlugin()
    {
        return $this->calculator_type_plugin;
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
     * Set the value of [id_merchant_commission] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdMerchantCommission($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_merchant_commission !== $v) {
            $this->id_merchant_commission = $v;
            $this->modifiedColumns[SpyMerchantCommissionTableMap::COL_ID_MERCHANT_COMMISSION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_merchant_commission_group] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkMerchantCommissionGroup($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_merchant_commission_group !== $v) {
            $this->fk_merchant_commission_group = $v;
            $this->modifiedColumns[SpyMerchantCommissionTableMap::COL_FK_MERCHANT_COMMISSION_GROUP] = true;
        }

        if ($this->aMerchantCommissionGroup !== null && $this->aMerchantCommissionGroup->getIdMerchantCommissionGroup() !== $v) {
            $this->aMerchantCommissionGroup = null;
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
            $this->modifiedColumns[SpyMerchantCommissionTableMap::COL_UUID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [name] column.
     * The name of an entity (e.g., user, category, product, role).
     * @param string $v New value
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
            $this->modifiedColumns[SpyMerchantCommissionTableMap::COL_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [description] column.
     * A description of an entity.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[SpyMerchantCommissionTableMap::COL_DESCRIPTION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [key] column.
     * A unique key used to identify an entity or a piece of data.
     * @param string $v New value
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
            $this->modifiedColumns[SpyMerchantCommissionTableMap::COL_KEY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [amount] column.
     * A numerical value, often used for price, quantity, or discount.
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAmount($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->amount !== $v) {
            $this->amount = $v;
            $this->modifiedColumns[SpyMerchantCommissionTableMap::COL_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * A boolean flag indicating if an entity is currently active.
     * @param bool|integer|string $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsActive($v)
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
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->is_active !== $v) {
            $this->is_active = $v;
            $this->modifiedColumns[SpyMerchantCommissionTableMap::COL_IS_ACTIVE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [valid_from] column to a normalized version of the date/time value specified.
     * The date and time from which an entity is valid.
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setValidFrom($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->valid_from !== null || $dt !== null) {
            if ($this->valid_from === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->valid_from->format("Y-m-d H:i:s.u")) {
                $this->valid_from = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SpyMerchantCommissionTableMap::COL_VALID_FROM] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [valid_to] column to a normalized version of the date/time value specified.
     * The date and time until which an entity is valid.
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setValidTo($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->valid_to !== null || $dt !== null) {
            if ($this->valid_to === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->valid_to->format("Y-m-d H:i:s.u")) {
                $this->valid_to = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SpyMerchantCommissionTableMap::COL_VALID_TO] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [priority] column.
     * A numerical value that determines the order of processing or application, with lower numbers often having higher priority.
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPriority($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = true;

        if (($this->isNew() && $hasDefaultValue) || $this->priority !== $v) {
            $this->priority = $v;
            $this->modifiedColumns[SpyMerchantCommissionTableMap::COL_PRIORITY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [item_condition] column.
     * A condition that applies to individual items for a merchant commission.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setItemCondition($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->item_condition !== $v) {
            $this->item_condition = $v;
            $this->modifiedColumns[SpyMerchantCommissionTableMap::COL_ITEM_CONDITION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [order_condition] column.
     * A query string defining the conditions the entire order must meet for a merchant commission to apply.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrderCondition($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->order_condition !== $v) {
            $this->order_condition = $v;
            $this->modifiedColumns[SpyMerchantCommissionTableMap::COL_ORDER_CONDITION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [calculator_type_plugin] column.
     * The plugin used for a specific type of calculation.
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCalculatorTypePlugin($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->calculator_type_plugin !== $v) {
            $this->calculator_type_plugin = $v;
            $this->modifiedColumns[SpyMerchantCommissionTableMap::COL_CALCULATOR_TYPE_PLUGIN] = true;
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
                $this->modifiedColumns[SpyMerchantCommissionTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SpyMerchantCommissionTableMap::COL_UPDATED_AT] = true;
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
            if ($this->priority !== 9999) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyMerchantCommissionTableMap::translateFieldName('IdMerchantCommission', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_merchant_commission = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyMerchantCommissionTableMap::translateFieldName('FkMerchantCommissionGroup', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_merchant_commission_group = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyMerchantCommissionTableMap::translateFieldName('Uuid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->uuid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyMerchantCommissionTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyMerchantCommissionTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyMerchantCommissionTableMap::translateFieldName('Key', TableMap::TYPE_PHPNAME, $indexType)];
            $this->key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpyMerchantCommissionTableMap::translateFieldName('Amount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->amount = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpyMerchantCommissionTableMap::translateFieldName('IsActive', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_active = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SpyMerchantCommissionTableMap::translateFieldName('ValidFrom', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->valid_from = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SpyMerchantCommissionTableMap::translateFieldName('ValidTo', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->valid_to = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SpyMerchantCommissionTableMap::translateFieldName('Priority', TableMap::TYPE_PHPNAME, $indexType)];
            $this->priority = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : SpyMerchantCommissionTableMap::translateFieldName('ItemCondition', TableMap::TYPE_PHPNAME, $indexType)];
            $this->item_condition = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : SpyMerchantCommissionTableMap::translateFieldName('OrderCondition', TableMap::TYPE_PHPNAME, $indexType)];
            $this->order_condition = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : SpyMerchantCommissionTableMap::translateFieldName('CalculatorTypePlugin', TableMap::TYPE_PHPNAME, $indexType)];
            $this->calculator_type_plugin = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : SpyMerchantCommissionTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : SpyMerchantCommissionTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 16; // 16 = SpyMerchantCommissionTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\MerchantCommission\\Persistence\\SpyMerchantCommission'), 0, $e);
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
        if ($this->aMerchantCommissionGroup !== null && $this->fk_merchant_commission_group !== $this->aMerchantCommissionGroup->getIdMerchantCommissionGroup()) {
            $this->aMerchantCommissionGroup = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyMerchantCommissionTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyMerchantCommissionQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aMerchantCommissionGroup = null;
            $this->collMerchantCommissionAmounts = null;

            $this->collMerchantCommissionStores = null;

            $this->collMerchantCommissionMerchants = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyMerchantCommission::setDeleted()
     * @see SpyMerchantCommission::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantCommissionTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyMerchantCommissionQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantCommissionTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                $time = time();
                $highPrecision = \Propel\Runtime\Util\PropelDateTime::createHighPrecision();
                if (!$this->isColumnModified(SpyMerchantCommissionTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpyMerchantCommissionTableMap::COL_UPDATED_AT)) {
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
                // uuid behavior
                $this->updateUuidBeforeUpdate();
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(SpyMerchantCommissionTableMap::COL_UPDATED_AT)) {
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
                    // uuid behavior
                    $this->updateUuidAfterInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                SpyMerchantCommissionTableMap::addInstanceToPool($this);
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

            if ($this->aMerchantCommissionGroup !== null) {
                if ($this->aMerchantCommissionGroup->isModified() || $this->aMerchantCommissionGroup->isNew()) {
                    $affectedRows += $this->aMerchantCommissionGroup->save($con);
                }
                $this->setMerchantCommissionGroup($this->aMerchantCommissionGroup);
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

            if ($this->merchantCommissionAmountsScheduledForDeletion !== null) {
                if (!$this->merchantCommissionAmountsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionAmountQuery::create()
                        ->filterByPrimaryKeys($this->merchantCommissionAmountsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->merchantCommissionAmountsScheduledForDeletion = null;
                }
            }

            if ($this->collMerchantCommissionAmounts !== null) {
                foreach ($this->collMerchantCommissionAmounts as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->merchantCommissionStoresScheduledForDeletion !== null) {
                if (!$this->merchantCommissionStoresScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStoreQuery::create()
                        ->filterByPrimaryKeys($this->merchantCommissionStoresScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->merchantCommissionStoresScheduledForDeletion = null;
                }
            }

            if ($this->collMerchantCommissionStores !== null) {
                foreach ($this->collMerchantCommissionStores as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->merchantCommissionMerchantsScheduledForDeletion !== null) {
                if (!$this->merchantCommissionMerchantsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchantQuery::create()
                        ->filterByPrimaryKeys($this->merchantCommissionMerchantsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->merchantCommissionMerchantsScheduledForDeletion = null;
                }
            }

            if ($this->collMerchantCommissionMerchants !== null) {
                foreach ($this->collMerchantCommissionMerchants as $referrerFK) {
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

        $this->modifiedColumns[SpyMerchantCommissionTableMap::COL_ID_MERCHANT_COMMISSION] = true;
        if (null !== $this->id_merchant_commission) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyMerchantCommissionTableMap::COL_ID_MERCHANT_COMMISSION . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyMerchantCommissionTableMap::COL_ID_MERCHANT_COMMISSION)) {
            $modifiedColumns[':p' . $index++]  = '`id_merchant_commission`';
        }
        if ($this->isColumnModified(SpyMerchantCommissionTableMap::COL_FK_MERCHANT_COMMISSION_GROUP)) {
            $modifiedColumns[':p' . $index++]  = '`fk_merchant_commission_group`';
        }
        if ($this->isColumnModified(SpyMerchantCommissionTableMap::COL_UUID)) {
            $modifiedColumns[':p' . $index++]  = '`uuid`';
        }
        if ($this->isColumnModified(SpyMerchantCommissionTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(SpyMerchantCommissionTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = '`description`';
        }
        if ($this->isColumnModified(SpyMerchantCommissionTableMap::COL_KEY)) {
            $modifiedColumns[':p' . $index++]  = '`key`';
        }
        if ($this->isColumnModified(SpyMerchantCommissionTableMap::COL_AMOUNT)) {
            $modifiedColumns[':p' . $index++]  = '`amount`';
        }
        if ($this->isColumnModified(SpyMerchantCommissionTableMap::COL_IS_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`is_active`';
        }
        if ($this->isColumnModified(SpyMerchantCommissionTableMap::COL_VALID_FROM)) {
            $modifiedColumns[':p' . $index++]  = '`valid_from`';
        }
        if ($this->isColumnModified(SpyMerchantCommissionTableMap::COL_VALID_TO)) {
            $modifiedColumns[':p' . $index++]  = '`valid_to`';
        }
        if ($this->isColumnModified(SpyMerchantCommissionTableMap::COL_PRIORITY)) {
            $modifiedColumns[':p' . $index++]  = '`priority`';
        }
        if ($this->isColumnModified(SpyMerchantCommissionTableMap::COL_ITEM_CONDITION)) {
            $modifiedColumns[':p' . $index++]  = '`item_condition`';
        }
        if ($this->isColumnModified(SpyMerchantCommissionTableMap::COL_ORDER_CONDITION)) {
            $modifiedColumns[':p' . $index++]  = '`order_condition`';
        }
        if ($this->isColumnModified(SpyMerchantCommissionTableMap::COL_CALCULATOR_TYPE_PLUGIN)) {
            $modifiedColumns[':p' . $index++]  = '`calculator_type_plugin`';
        }
        if ($this->isColumnModified(SpyMerchantCommissionTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(SpyMerchantCommissionTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }

        $sql = sprintf(
            'INSERT INTO `spy_merchant_commission` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id_merchant_commission`':
                        $stmt->bindValue($identifier, $this->id_merchant_commission, PDO::PARAM_INT);

                        break;
                    case '`fk_merchant_commission_group`':
                        $stmt->bindValue($identifier, $this->fk_merchant_commission_group, PDO::PARAM_INT);

                        break;
                    case '`uuid`':
                        $stmt->bindValue($identifier, $this->uuid, PDO::PARAM_STR);

                        break;
                    case '`name`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);

                        break;
                    case '`description`':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);

                        break;
                    case '`key`':
                        $stmt->bindValue($identifier, $this->key, PDO::PARAM_STR);

                        break;
                    case '`amount`':
                        $stmt->bindValue($identifier, $this->amount, PDO::PARAM_INT);

                        break;
                    case '`is_active`':
                        $stmt->bindValue($identifier, (int) $this->is_active, PDO::PARAM_INT);

                        break;
                    case '`valid_from`':
                        $stmt->bindValue($identifier, $this->valid_from ? $this->valid_from->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case '`valid_to`':
                        $stmt->bindValue($identifier, $this->valid_to ? $this->valid_to->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case '`priority`':
                        $stmt->bindValue($identifier, $this->priority, PDO::PARAM_INT);

                        break;
                    case '`item_condition`':
                        $stmt->bindValue($identifier, $this->item_condition, PDO::PARAM_STR);

                        break;
                    case '`order_condition`':
                        $stmt->bindValue($identifier, $this->order_condition, PDO::PARAM_STR);

                        break;
                    case '`calculator_type_plugin`':
                        $stmt->bindValue($identifier, $this->calculator_type_plugin, PDO::PARAM_STR);

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
            $pk = $con->lastInsertId('spy_merchant_commission_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdMerchantCommission($pk);

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
        $pos = SpyMerchantCommissionTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdMerchantCommission();

            case 1:
                return $this->getFkMerchantCommissionGroup();

            case 2:
                return $this->getUuid();

            case 3:
                return $this->getName();

            case 4:
                return $this->getDescription();

            case 5:
                return $this->getKey();

            case 6:
                return $this->getAmount();

            case 7:
                return $this->getIsActive();

            case 8:
                return $this->getValidFrom();

            case 9:
                return $this->getValidTo();

            case 10:
                return $this->getPriority();

            case 11:
                return $this->getItemCondition();

            case 12:
                return $this->getOrderCondition();

            case 13:
                return $this->getCalculatorTypePlugin();

            case 14:
                return $this->getCreatedAt();

            case 15:
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
        if (isset($alreadyDumpedObjects['SpyMerchantCommission'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyMerchantCommission'][$this->hashCode()] = true;
        $keys = SpyMerchantCommissionTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdMerchantCommission(),
            $keys[1] => $this->getFkMerchantCommissionGroup(),
            $keys[2] => $this->getUuid(),
            $keys[3] => $this->getName(),
            $keys[4] => $this->getDescription(),
            $keys[5] => $this->getKey(),
            $keys[6] => $this->getAmount(),
            $keys[7] => $this->getIsActive(),
            $keys[8] => $this->getValidFrom(),
            $keys[9] => $this->getValidTo(),
            $keys[10] => $this->getPriority(),
            $keys[11] => $this->getItemCondition(),
            $keys[12] => $this->getOrderCondition(),
            $keys[13] => $this->getCalculatorTypePlugin(),
            $keys[14] => $this->getCreatedAt(),
            $keys[15] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[9]] instanceof \DateTimeInterface) {
            $result[$keys[9]] = $result[$keys[9]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[14]] instanceof \DateTimeInterface) {
            $result[$keys[14]] = $result[$keys[14]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[15]] instanceof \DateTimeInterface) {
            $result[$keys[15]] = $result[$keys[15]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aMerchantCommissionGroup) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchantCommissionGroup';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant_commission_group';
                        break;
                    default:
                        $key = 'MerchantCommissionGroup';
                }

                $result[$key] = $this->aMerchantCommissionGroup->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collMerchantCommissionAmounts) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchantCommissionAmounts';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant_commission_amounts';
                        break;
                    default:
                        $key = 'MerchantCommissionAmounts';
                }

                $result[$key] = $this->collMerchantCommissionAmounts->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collMerchantCommissionStores) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchantCommissionStores';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant_commission_stores';
                        break;
                    default:
                        $key = 'MerchantCommissionStores';
                }

                $result[$key] = $this->collMerchantCommissionStores->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collMerchantCommissionMerchants) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchantCommissionMerchants';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant_commission_merchants';
                        break;
                    default:
                        $key = 'MerchantCommissionMerchants';
                }

                $result[$key] = $this->collMerchantCommissionMerchants->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyMerchantCommissionTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdMerchantCommission($value);
                break;
            case 1:
                $this->setFkMerchantCommissionGroup($value);
                break;
            case 2:
                $this->setUuid($value);
                break;
            case 3:
                $this->setName($value);
                break;
            case 4:
                $this->setDescription($value);
                break;
            case 5:
                $this->setKey($value);
                break;
            case 6:
                $this->setAmount($value);
                break;
            case 7:
                $this->setIsActive($value);
                break;
            case 8:
                $this->setValidFrom($value);
                break;
            case 9:
                $this->setValidTo($value);
                break;
            case 10:
                $this->setPriority($value);
                break;
            case 11:
                $this->setItemCondition($value);
                break;
            case 12:
                $this->setOrderCondition($value);
                break;
            case 13:
                $this->setCalculatorTypePlugin($value);
                break;
            case 14:
                $this->setCreatedAt($value);
                break;
            case 15:
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
        $keys = SpyMerchantCommissionTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdMerchantCommission($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkMerchantCommissionGroup($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setUuid($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setName($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setDescription($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setKey($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setAmount($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setIsActive($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setValidFrom($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setValidTo($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setPriority($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setItemCondition($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setOrderCondition($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setCalculatorTypePlugin($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setCreatedAt($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setUpdatedAt($arr[$keys[15]]);
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
        $criteria = new Criteria(SpyMerchantCommissionTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyMerchantCommissionTableMap::COL_ID_MERCHANT_COMMISSION)) {
            $criteria->add(SpyMerchantCommissionTableMap::COL_ID_MERCHANT_COMMISSION, $this->id_merchant_commission);
        }
        if ($this->isColumnModified(SpyMerchantCommissionTableMap::COL_FK_MERCHANT_COMMISSION_GROUP)) {
            $criteria->add(SpyMerchantCommissionTableMap::COL_FK_MERCHANT_COMMISSION_GROUP, $this->fk_merchant_commission_group);
        }
        if ($this->isColumnModified(SpyMerchantCommissionTableMap::COL_UUID)) {
            $criteria->add(SpyMerchantCommissionTableMap::COL_UUID, $this->uuid);
        }
        if ($this->isColumnModified(SpyMerchantCommissionTableMap::COL_NAME)) {
            $criteria->add(SpyMerchantCommissionTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(SpyMerchantCommissionTableMap::COL_DESCRIPTION)) {
            $criteria->add(SpyMerchantCommissionTableMap::COL_DESCRIPTION, $this->description);
        }
        if ($this->isColumnModified(SpyMerchantCommissionTableMap::COL_KEY)) {
            $criteria->add(SpyMerchantCommissionTableMap::COL_KEY, $this->key);
        }
        if ($this->isColumnModified(SpyMerchantCommissionTableMap::COL_AMOUNT)) {
            $criteria->add(SpyMerchantCommissionTableMap::COL_AMOUNT, $this->amount);
        }
        if ($this->isColumnModified(SpyMerchantCommissionTableMap::COL_IS_ACTIVE)) {
            $criteria->add(SpyMerchantCommissionTableMap::COL_IS_ACTIVE, $this->is_active);
        }
        if ($this->isColumnModified(SpyMerchantCommissionTableMap::COL_VALID_FROM)) {
            $criteria->add(SpyMerchantCommissionTableMap::COL_VALID_FROM, $this->valid_from);
        }
        if ($this->isColumnModified(SpyMerchantCommissionTableMap::COL_VALID_TO)) {
            $criteria->add(SpyMerchantCommissionTableMap::COL_VALID_TO, $this->valid_to);
        }
        if ($this->isColumnModified(SpyMerchantCommissionTableMap::COL_PRIORITY)) {
            $criteria->add(SpyMerchantCommissionTableMap::COL_PRIORITY, $this->priority);
        }
        if ($this->isColumnModified(SpyMerchantCommissionTableMap::COL_ITEM_CONDITION)) {
            $criteria->add(SpyMerchantCommissionTableMap::COL_ITEM_CONDITION, $this->item_condition);
        }
        if ($this->isColumnModified(SpyMerchantCommissionTableMap::COL_ORDER_CONDITION)) {
            $criteria->add(SpyMerchantCommissionTableMap::COL_ORDER_CONDITION, $this->order_condition);
        }
        if ($this->isColumnModified(SpyMerchantCommissionTableMap::COL_CALCULATOR_TYPE_PLUGIN)) {
            $criteria->add(SpyMerchantCommissionTableMap::COL_CALCULATOR_TYPE_PLUGIN, $this->calculator_type_plugin);
        }
        if ($this->isColumnModified(SpyMerchantCommissionTableMap::COL_CREATED_AT)) {
            $criteria->add(SpyMerchantCommissionTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpyMerchantCommissionTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpyMerchantCommissionTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildSpyMerchantCommissionQuery::create();
        $criteria->add(SpyMerchantCommissionTableMap::COL_ID_MERCHANT_COMMISSION, $this->id_merchant_commission);

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
        $validPk = null !== $this->getIdMerchantCommission();

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
        return $this->getIdMerchantCommission();
    }

    /**
     * Generic method to set the primary key (id_merchant_commission column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdMerchantCommission($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdMerchantCommission();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommission (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkMerchantCommissionGroup($this->getFkMerchantCommissionGroup());
        $copyObj->setUuid($this->getUuid());
        $copyObj->setName($this->getName());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setKey($this->getKey());
        $copyObj->setAmount($this->getAmount());
        $copyObj->setIsActive($this->getIsActive());
        $copyObj->setValidFrom($this->getValidFrom());
        $copyObj->setValidTo($this->getValidTo());
        $copyObj->setPriority($this->getPriority());
        $copyObj->setItemCondition($this->getItemCondition());
        $copyObj->setOrderCondition($this->getOrderCondition());
        $copyObj->setCalculatorTypePlugin($this->getCalculatorTypePlugin());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getMerchantCommissionAmounts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMerchantCommissionAmount($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getMerchantCommissionStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMerchantCommissionStore($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getMerchantCommissionMerchants() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMerchantCommissionMerchant($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdMerchantCommission(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommission Clone of current object.
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
     * Declares an association between this object and a ChildSpyMerchantCommissionGroup object.
     *
     * @param ChildSpyMerchantCommissionGroup $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setMerchantCommissionGroup(ChildSpyMerchantCommissionGroup $v = null)
    {
        if ($v === null) {
            $this->setFkMerchantCommissionGroup(NULL);
        } else {
            $this->setFkMerchantCommissionGroup($v->getIdMerchantCommissionGroup());
        }

        $this->aMerchantCommissionGroup = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpyMerchantCommissionGroup object, it will not be re-added.
        if ($v !== null) {
            $v->addMerchantCommission($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpyMerchantCommissionGroup object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSpyMerchantCommissionGroup The associated ChildSpyMerchantCommissionGroup object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getMerchantCommissionGroup(?ConnectionInterface $con = null)
    {
        if ($this->aMerchantCommissionGroup === null && ($this->fk_merchant_commission_group != 0)) {
            $this->aMerchantCommissionGroup = ChildSpyMerchantCommissionGroupQuery::create()->findPk($this->fk_merchant_commission_group, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aMerchantCommissionGroup->addMerchantCommissions($this);
             */
        }

        return $this->aMerchantCommissionGroup;
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
        if ('MerchantCommissionAmount' === $relationName) {
            $this->initMerchantCommissionAmounts();
            return;
        }
        if ('MerchantCommissionStore' === $relationName) {
            $this->initMerchantCommissionStores();
            return;
        }
        if ('MerchantCommissionMerchant' === $relationName) {
            $this->initMerchantCommissionMerchants();
            return;
        }
    }

    /**
     * Clears out the collMerchantCommissionAmounts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addMerchantCommissionAmounts()
     */
    public function clearMerchantCommissionAmounts()
    {
        $this->collMerchantCommissionAmounts = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collMerchantCommissionAmounts collection loaded partially.
     *
     * @return void
     */
    public function resetPartialMerchantCommissionAmounts($v = true): void
    {
        $this->collMerchantCommissionAmountsPartial = $v;
    }

    /**
     * Initializes the collMerchantCommissionAmounts collection.
     *
     * By default this just sets the collMerchantCommissionAmounts collection to an empty array (like clearcollMerchantCommissionAmounts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initMerchantCommissionAmounts(bool $overrideExisting = true): void
    {
        if (null !== $this->collMerchantCommissionAmounts && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyMerchantCommissionAmountTableMap::getTableMap()->getCollectionClassName();

        $this->collMerchantCommissionAmounts = new $collectionClassName;
        $this->collMerchantCommissionAmounts->setModel('\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionAmount');
    }

    /**
     * Gets an array of ChildSpyMerchantCommissionAmount objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyMerchantCommission is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyMerchantCommissionAmount[] List of ChildSpyMerchantCommissionAmount objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyMerchantCommissionAmount> List of ChildSpyMerchantCommissionAmount objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getMerchantCommissionAmounts(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collMerchantCommissionAmountsPartial && !$this->isNew();
        if (null === $this->collMerchantCommissionAmounts || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collMerchantCommissionAmounts) {
                    $this->initMerchantCommissionAmounts();
                } else {
                    $collectionClassName = SpyMerchantCommissionAmountTableMap::getTableMap()->getCollectionClassName();

                    $collMerchantCommissionAmounts = new $collectionClassName;
                    $collMerchantCommissionAmounts->setModel('\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionAmount');

                    return $collMerchantCommissionAmounts;
                }
            } else {
                $collMerchantCommissionAmounts = ChildSpyMerchantCommissionAmountQuery::create(null, $criteria)
                    ->filterByMerchantCommission($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collMerchantCommissionAmountsPartial && count($collMerchantCommissionAmounts)) {
                        $this->initMerchantCommissionAmounts(false);

                        foreach ($collMerchantCommissionAmounts as $obj) {
                            if (false == $this->collMerchantCommissionAmounts->contains($obj)) {
                                $this->collMerchantCommissionAmounts->append($obj);
                            }
                        }

                        $this->collMerchantCommissionAmountsPartial = true;
                    }

                    return $collMerchantCommissionAmounts;
                }

                if ($partial && $this->collMerchantCommissionAmounts) {
                    foreach ($this->collMerchantCommissionAmounts as $obj) {
                        if ($obj->isNew()) {
                            $collMerchantCommissionAmounts[] = $obj;
                        }
                    }
                }

                $this->collMerchantCommissionAmounts = $collMerchantCommissionAmounts;
                $this->collMerchantCommissionAmountsPartial = false;
            }
        }

        return $this->collMerchantCommissionAmounts;
    }

    /**
     * Sets a collection of ChildSpyMerchantCommissionAmount objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $merchantCommissionAmounts A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setMerchantCommissionAmounts(Collection $merchantCommissionAmounts, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyMerchantCommissionAmount[] $merchantCommissionAmountsToDelete */
        $merchantCommissionAmountsToDelete = $this->getMerchantCommissionAmounts(new Criteria(), $con)->diff($merchantCommissionAmounts);


        $this->merchantCommissionAmountsScheduledForDeletion = $merchantCommissionAmountsToDelete;

        foreach ($merchantCommissionAmountsToDelete as $merchantCommissionAmountRemoved) {
            $merchantCommissionAmountRemoved->setMerchantCommission(null);
        }

        $this->collMerchantCommissionAmounts = null;
        foreach ($merchantCommissionAmounts as $merchantCommissionAmount) {
            $this->addMerchantCommissionAmount($merchantCommissionAmount);
        }

        $this->collMerchantCommissionAmounts = $merchantCommissionAmounts;
        $this->collMerchantCommissionAmountsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyMerchantCommissionAmount objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyMerchantCommissionAmount objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countMerchantCommissionAmounts(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collMerchantCommissionAmountsPartial && !$this->isNew();
        if (null === $this->collMerchantCommissionAmounts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collMerchantCommissionAmounts) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getMerchantCommissionAmounts());
            }

            $query = ChildSpyMerchantCommissionAmountQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByMerchantCommission($this)
                ->count($con);
        }

        return count($this->collMerchantCommissionAmounts);
    }

    /**
     * Method called to associate a ChildSpyMerchantCommissionAmount object to this object
     * through the ChildSpyMerchantCommissionAmount foreign key attribute.
     *
     * @param ChildSpyMerchantCommissionAmount $l ChildSpyMerchantCommissionAmount
     * @return $this The current object (for fluent API support)
     */
    public function addMerchantCommissionAmount(ChildSpyMerchantCommissionAmount $l)
    {
        if ($this->collMerchantCommissionAmounts === null) {
            $this->initMerchantCommissionAmounts();
            $this->collMerchantCommissionAmountsPartial = true;
        }

        if (!$this->collMerchantCommissionAmounts->contains($l)) {
            $this->doAddMerchantCommissionAmount($l);

            if ($this->merchantCommissionAmountsScheduledForDeletion and $this->merchantCommissionAmountsScheduledForDeletion->contains($l)) {
                $this->merchantCommissionAmountsScheduledForDeletion->remove($this->merchantCommissionAmountsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyMerchantCommissionAmount $merchantCommissionAmount The ChildSpyMerchantCommissionAmount object to add.
     */
    protected function doAddMerchantCommissionAmount(ChildSpyMerchantCommissionAmount $merchantCommissionAmount): void
    {
        $this->collMerchantCommissionAmounts[]= $merchantCommissionAmount;
        $merchantCommissionAmount->setMerchantCommission($this);
    }

    /**
     * @param ChildSpyMerchantCommissionAmount $merchantCommissionAmount The ChildSpyMerchantCommissionAmount object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeMerchantCommissionAmount(ChildSpyMerchantCommissionAmount $merchantCommissionAmount)
    {
        if ($this->getMerchantCommissionAmounts()->contains($merchantCommissionAmount)) {
            $pos = $this->collMerchantCommissionAmounts->search($merchantCommissionAmount);
            $this->collMerchantCommissionAmounts->remove($pos);
            if (null === $this->merchantCommissionAmountsScheduledForDeletion) {
                $this->merchantCommissionAmountsScheduledForDeletion = clone $this->collMerchantCommissionAmounts;
                $this->merchantCommissionAmountsScheduledForDeletion->clear();
            }
            $this->merchantCommissionAmountsScheduledForDeletion[]= clone $merchantCommissionAmount;
            $merchantCommissionAmount->setMerchantCommission(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyMerchantCommission is new, it will return
     * an empty collection; or if this SpyMerchantCommission has previously
     * been saved, it will retrieve related MerchantCommissionAmounts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyMerchantCommission.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyMerchantCommissionAmount[] List of ChildSpyMerchantCommissionAmount objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyMerchantCommissionAmount}> List of ChildSpyMerchantCommissionAmount objects
     */
    public function getMerchantCommissionAmountsJoinCurrency(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyMerchantCommissionAmountQuery::create(null, $criteria);
        $query->joinWith('Currency', $joinBehavior);

        return $this->getMerchantCommissionAmounts($query, $con);
    }

    /**
     * Clears out the collMerchantCommissionStores collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addMerchantCommissionStores()
     */
    public function clearMerchantCommissionStores()
    {
        $this->collMerchantCommissionStores = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collMerchantCommissionStores collection loaded partially.
     *
     * @return void
     */
    public function resetPartialMerchantCommissionStores($v = true): void
    {
        $this->collMerchantCommissionStoresPartial = $v;
    }

    /**
     * Initializes the collMerchantCommissionStores collection.
     *
     * By default this just sets the collMerchantCommissionStores collection to an empty array (like clearcollMerchantCommissionStores());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initMerchantCommissionStores(bool $overrideExisting = true): void
    {
        if (null !== $this->collMerchantCommissionStores && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyMerchantCommissionStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collMerchantCommissionStores = new $collectionClassName;
        $this->collMerchantCommissionStores->setModel('\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStore');
    }

    /**
     * Gets an array of ChildSpyMerchantCommissionStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyMerchantCommission is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyMerchantCommissionStore[] List of ChildSpyMerchantCommissionStore objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyMerchantCommissionStore> List of ChildSpyMerchantCommissionStore objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getMerchantCommissionStores(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collMerchantCommissionStoresPartial && !$this->isNew();
        if (null === $this->collMerchantCommissionStores || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collMerchantCommissionStores) {
                    $this->initMerchantCommissionStores();
                } else {
                    $collectionClassName = SpyMerchantCommissionStoreTableMap::getTableMap()->getCollectionClassName();

                    $collMerchantCommissionStores = new $collectionClassName;
                    $collMerchantCommissionStores->setModel('\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStore');

                    return $collMerchantCommissionStores;
                }
            } else {
                $collMerchantCommissionStores = ChildSpyMerchantCommissionStoreQuery::create(null, $criteria)
                    ->filterByMerchantCommission($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collMerchantCommissionStoresPartial && count($collMerchantCommissionStores)) {
                        $this->initMerchantCommissionStores(false);

                        foreach ($collMerchantCommissionStores as $obj) {
                            if (false == $this->collMerchantCommissionStores->contains($obj)) {
                                $this->collMerchantCommissionStores->append($obj);
                            }
                        }

                        $this->collMerchantCommissionStoresPartial = true;
                    }

                    return $collMerchantCommissionStores;
                }

                if ($partial && $this->collMerchantCommissionStores) {
                    foreach ($this->collMerchantCommissionStores as $obj) {
                        if ($obj->isNew()) {
                            $collMerchantCommissionStores[] = $obj;
                        }
                    }
                }

                $this->collMerchantCommissionStores = $collMerchantCommissionStores;
                $this->collMerchantCommissionStoresPartial = false;
            }
        }

        return $this->collMerchantCommissionStores;
    }

    /**
     * Sets a collection of ChildSpyMerchantCommissionStore objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $merchantCommissionStores A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setMerchantCommissionStores(Collection $merchantCommissionStores, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyMerchantCommissionStore[] $merchantCommissionStoresToDelete */
        $merchantCommissionStoresToDelete = $this->getMerchantCommissionStores(new Criteria(), $con)->diff($merchantCommissionStores);


        $this->merchantCommissionStoresScheduledForDeletion = $merchantCommissionStoresToDelete;

        foreach ($merchantCommissionStoresToDelete as $merchantCommissionStoreRemoved) {
            $merchantCommissionStoreRemoved->setMerchantCommission(null);
        }

        $this->collMerchantCommissionStores = null;
        foreach ($merchantCommissionStores as $merchantCommissionStore) {
            $this->addMerchantCommissionStore($merchantCommissionStore);
        }

        $this->collMerchantCommissionStores = $merchantCommissionStores;
        $this->collMerchantCommissionStoresPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyMerchantCommissionStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyMerchantCommissionStore objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countMerchantCommissionStores(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collMerchantCommissionStoresPartial && !$this->isNew();
        if (null === $this->collMerchantCommissionStores || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collMerchantCommissionStores) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getMerchantCommissionStores());
            }

            $query = ChildSpyMerchantCommissionStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByMerchantCommission($this)
                ->count($con);
        }

        return count($this->collMerchantCommissionStores);
    }

    /**
     * Method called to associate a ChildSpyMerchantCommissionStore object to this object
     * through the ChildSpyMerchantCommissionStore foreign key attribute.
     *
     * @param ChildSpyMerchantCommissionStore $l ChildSpyMerchantCommissionStore
     * @return $this The current object (for fluent API support)
     */
    public function addMerchantCommissionStore(ChildSpyMerchantCommissionStore $l)
    {
        if ($this->collMerchantCommissionStores === null) {
            $this->initMerchantCommissionStores();
            $this->collMerchantCommissionStoresPartial = true;
        }

        if (!$this->collMerchantCommissionStores->contains($l)) {
            $this->doAddMerchantCommissionStore($l);

            if ($this->merchantCommissionStoresScheduledForDeletion and $this->merchantCommissionStoresScheduledForDeletion->contains($l)) {
                $this->merchantCommissionStoresScheduledForDeletion->remove($this->merchantCommissionStoresScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyMerchantCommissionStore $merchantCommissionStore The ChildSpyMerchantCommissionStore object to add.
     */
    protected function doAddMerchantCommissionStore(ChildSpyMerchantCommissionStore $merchantCommissionStore): void
    {
        $this->collMerchantCommissionStores[]= $merchantCommissionStore;
        $merchantCommissionStore->setMerchantCommission($this);
    }

    /**
     * @param ChildSpyMerchantCommissionStore $merchantCommissionStore The ChildSpyMerchantCommissionStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeMerchantCommissionStore(ChildSpyMerchantCommissionStore $merchantCommissionStore)
    {
        if ($this->getMerchantCommissionStores()->contains($merchantCommissionStore)) {
            $pos = $this->collMerchantCommissionStores->search($merchantCommissionStore);
            $this->collMerchantCommissionStores->remove($pos);
            if (null === $this->merchantCommissionStoresScheduledForDeletion) {
                $this->merchantCommissionStoresScheduledForDeletion = clone $this->collMerchantCommissionStores;
                $this->merchantCommissionStoresScheduledForDeletion->clear();
            }
            $this->merchantCommissionStoresScheduledForDeletion[]= clone $merchantCommissionStore;
            $merchantCommissionStore->setMerchantCommission(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyMerchantCommission is new, it will return
     * an empty collection; or if this SpyMerchantCommission has previously
     * been saved, it will retrieve related MerchantCommissionStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyMerchantCommission.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyMerchantCommissionStore[] List of ChildSpyMerchantCommissionStore objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyMerchantCommissionStore}> List of ChildSpyMerchantCommissionStore objects
     */
    public function getMerchantCommissionStoresJoinStore(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyMerchantCommissionStoreQuery::create(null, $criteria);
        $query->joinWith('Store', $joinBehavior);

        return $this->getMerchantCommissionStores($query, $con);
    }

    /**
     * Clears out the collMerchantCommissionMerchants collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addMerchantCommissionMerchants()
     */
    public function clearMerchantCommissionMerchants()
    {
        $this->collMerchantCommissionMerchants = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collMerchantCommissionMerchants collection loaded partially.
     *
     * @return void
     */
    public function resetPartialMerchantCommissionMerchants($v = true): void
    {
        $this->collMerchantCommissionMerchantsPartial = $v;
    }

    /**
     * Initializes the collMerchantCommissionMerchants collection.
     *
     * By default this just sets the collMerchantCommissionMerchants collection to an empty array (like clearcollMerchantCommissionMerchants());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initMerchantCommissionMerchants(bool $overrideExisting = true): void
    {
        if (null !== $this->collMerchantCommissionMerchants && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyMerchantCommissionMerchantTableMap::getTableMap()->getCollectionClassName();

        $this->collMerchantCommissionMerchants = new $collectionClassName;
        $this->collMerchantCommissionMerchants->setModel('\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchant');
    }

    /**
     * Gets an array of ChildSpyMerchantCommissionMerchant objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyMerchantCommission is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyMerchantCommissionMerchant[] List of ChildSpyMerchantCommissionMerchant objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyMerchantCommissionMerchant> List of ChildSpyMerchantCommissionMerchant objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getMerchantCommissionMerchants(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collMerchantCommissionMerchantsPartial && !$this->isNew();
        if (null === $this->collMerchantCommissionMerchants || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collMerchantCommissionMerchants) {
                    $this->initMerchantCommissionMerchants();
                } else {
                    $collectionClassName = SpyMerchantCommissionMerchantTableMap::getTableMap()->getCollectionClassName();

                    $collMerchantCommissionMerchants = new $collectionClassName;
                    $collMerchantCommissionMerchants->setModel('\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchant');

                    return $collMerchantCommissionMerchants;
                }
            } else {
                $collMerchantCommissionMerchants = ChildSpyMerchantCommissionMerchantQuery::create(null, $criteria)
                    ->filterByMerchantCommission($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collMerchantCommissionMerchantsPartial && count($collMerchantCommissionMerchants)) {
                        $this->initMerchantCommissionMerchants(false);

                        foreach ($collMerchantCommissionMerchants as $obj) {
                            if (false == $this->collMerchantCommissionMerchants->contains($obj)) {
                                $this->collMerchantCommissionMerchants->append($obj);
                            }
                        }

                        $this->collMerchantCommissionMerchantsPartial = true;
                    }

                    return $collMerchantCommissionMerchants;
                }

                if ($partial && $this->collMerchantCommissionMerchants) {
                    foreach ($this->collMerchantCommissionMerchants as $obj) {
                        if ($obj->isNew()) {
                            $collMerchantCommissionMerchants[] = $obj;
                        }
                    }
                }

                $this->collMerchantCommissionMerchants = $collMerchantCommissionMerchants;
                $this->collMerchantCommissionMerchantsPartial = false;
            }
        }

        return $this->collMerchantCommissionMerchants;
    }

    /**
     * Sets a collection of ChildSpyMerchantCommissionMerchant objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $merchantCommissionMerchants A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setMerchantCommissionMerchants(Collection $merchantCommissionMerchants, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyMerchantCommissionMerchant[] $merchantCommissionMerchantsToDelete */
        $merchantCommissionMerchantsToDelete = $this->getMerchantCommissionMerchants(new Criteria(), $con)->diff($merchantCommissionMerchants);


        $this->merchantCommissionMerchantsScheduledForDeletion = $merchantCommissionMerchantsToDelete;

        foreach ($merchantCommissionMerchantsToDelete as $merchantCommissionMerchantRemoved) {
            $merchantCommissionMerchantRemoved->setMerchantCommission(null);
        }

        $this->collMerchantCommissionMerchants = null;
        foreach ($merchantCommissionMerchants as $merchantCommissionMerchant) {
            $this->addMerchantCommissionMerchant($merchantCommissionMerchant);
        }

        $this->collMerchantCommissionMerchants = $merchantCommissionMerchants;
        $this->collMerchantCommissionMerchantsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyMerchantCommissionMerchant objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyMerchantCommissionMerchant objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countMerchantCommissionMerchants(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collMerchantCommissionMerchantsPartial && !$this->isNew();
        if (null === $this->collMerchantCommissionMerchants || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collMerchantCommissionMerchants) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getMerchantCommissionMerchants());
            }

            $query = ChildSpyMerchantCommissionMerchantQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByMerchantCommission($this)
                ->count($con);
        }

        return count($this->collMerchantCommissionMerchants);
    }

    /**
     * Method called to associate a ChildSpyMerchantCommissionMerchant object to this object
     * through the ChildSpyMerchantCommissionMerchant foreign key attribute.
     *
     * @param ChildSpyMerchantCommissionMerchant $l ChildSpyMerchantCommissionMerchant
     * @return $this The current object (for fluent API support)
     */
    public function addMerchantCommissionMerchant(ChildSpyMerchantCommissionMerchant $l)
    {
        if ($this->collMerchantCommissionMerchants === null) {
            $this->initMerchantCommissionMerchants();
            $this->collMerchantCommissionMerchantsPartial = true;
        }

        if (!$this->collMerchantCommissionMerchants->contains($l)) {
            $this->doAddMerchantCommissionMerchant($l);

            if ($this->merchantCommissionMerchantsScheduledForDeletion and $this->merchantCommissionMerchantsScheduledForDeletion->contains($l)) {
                $this->merchantCommissionMerchantsScheduledForDeletion->remove($this->merchantCommissionMerchantsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyMerchantCommissionMerchant $merchantCommissionMerchant The ChildSpyMerchantCommissionMerchant object to add.
     */
    protected function doAddMerchantCommissionMerchant(ChildSpyMerchantCommissionMerchant $merchantCommissionMerchant): void
    {
        $this->collMerchantCommissionMerchants[]= $merchantCommissionMerchant;
        $merchantCommissionMerchant->setMerchantCommission($this);
    }

    /**
     * @param ChildSpyMerchantCommissionMerchant $merchantCommissionMerchant The ChildSpyMerchantCommissionMerchant object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeMerchantCommissionMerchant(ChildSpyMerchantCommissionMerchant $merchantCommissionMerchant)
    {
        if ($this->getMerchantCommissionMerchants()->contains($merchantCommissionMerchant)) {
            $pos = $this->collMerchantCommissionMerchants->search($merchantCommissionMerchant);
            $this->collMerchantCommissionMerchants->remove($pos);
            if (null === $this->merchantCommissionMerchantsScheduledForDeletion) {
                $this->merchantCommissionMerchantsScheduledForDeletion = clone $this->collMerchantCommissionMerchants;
                $this->merchantCommissionMerchantsScheduledForDeletion->clear();
            }
            $this->merchantCommissionMerchantsScheduledForDeletion[]= clone $merchantCommissionMerchant;
            $merchantCommissionMerchant->setMerchantCommission(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyMerchantCommission is new, it will return
     * an empty collection; or if this SpyMerchantCommission has previously
     * been saved, it will retrieve related MerchantCommissionMerchants from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyMerchantCommission.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyMerchantCommissionMerchant[] List of ChildSpyMerchantCommissionMerchant objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyMerchantCommissionMerchant}> List of ChildSpyMerchantCommissionMerchant objects
     */
    public function getMerchantCommissionMerchantsJoinMerchant(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyMerchantCommissionMerchantQuery::create(null, $criteria);
        $query->joinWith('Merchant', $joinBehavior);

        return $this->getMerchantCommissionMerchants($query, $con);
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
        if (null !== $this->aMerchantCommissionGroup) {
            $this->aMerchantCommissionGroup->removeMerchantCommission($this);
        }
        $this->id_merchant_commission = null;
        $this->fk_merchant_commission_group = null;
        $this->uuid = null;
        $this->name = null;
        $this->description = null;
        $this->key = null;
        $this->amount = null;
        $this->is_active = null;
        $this->valid_from = null;
        $this->valid_to = null;
        $this->priority = null;
        $this->item_condition = null;
        $this->order_condition = null;
        $this->calculator_type_plugin = null;
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
            if ($this->collMerchantCommissionAmounts) {
                foreach ($this->collMerchantCommissionAmounts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collMerchantCommissionStores) {
                foreach ($this->collMerchantCommissionStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collMerchantCommissionMerchants) {
                foreach ($this->collMerchantCommissionMerchants as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collMerchantCommissionAmounts = null;
        $this->collMerchantCommissionStores = null;
        $this->collMerchantCommissionMerchants = null;
        $this->aMerchantCommissionGroup = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyMerchantCommissionTableMap::DEFAULT_STRING_FORMAT);
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
        $name = 'spy_merchant_commission' . '.' . $this->getIdMerchantCommission();
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

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return $this The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[SpyMerchantCommissionTableMap::COL_UPDATED_AT] = true;

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
