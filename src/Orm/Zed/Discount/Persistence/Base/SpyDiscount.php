<?php

namespace Orm\Zed\Discount\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\CustomerDiscountConnector\Persistence\SpyCustomerDiscount;
use Orm\Zed\CustomerDiscountConnector\Persistence\SpyCustomerDiscountQuery;
use Orm\Zed\CustomerDiscountConnector\Persistence\Base\SpyCustomerDiscount as BaseSpyCustomerDiscount;
use Orm\Zed\CustomerDiscountConnector\Persistence\Map\SpyCustomerDiscountTableMap;
use Orm\Zed\DiscountPromotion\Persistence\SpyDiscountPromotion;
use Orm\Zed\DiscountPromotion\Persistence\SpyDiscountPromotionQuery;
use Orm\Zed\DiscountPromotion\Persistence\Base\SpyDiscountPromotion as BaseSpyDiscountPromotion;
use Orm\Zed\DiscountPromotion\Persistence\Map\SpyDiscountPromotionTableMap;
use Orm\Zed\Discount\Persistence\SpyDiscount as ChildSpyDiscount;
use Orm\Zed\Discount\Persistence\SpyDiscountAmount as ChildSpyDiscountAmount;
use Orm\Zed\Discount\Persistence\SpyDiscountAmountQuery as ChildSpyDiscountAmountQuery;
use Orm\Zed\Discount\Persistence\SpyDiscountQuery as ChildSpyDiscountQuery;
use Orm\Zed\Discount\Persistence\SpyDiscountStore as ChildSpyDiscountStore;
use Orm\Zed\Discount\Persistence\SpyDiscountStoreQuery as ChildSpyDiscountStoreQuery;
use Orm\Zed\Discount\Persistence\SpyDiscountVoucherPool as ChildSpyDiscountVoucherPool;
use Orm\Zed\Discount\Persistence\SpyDiscountVoucherPoolQuery as ChildSpyDiscountVoucherPoolQuery;
use Orm\Zed\Discount\Persistence\Map\SpyDiscountAmountTableMap;
use Orm\Zed\Discount\Persistence\Map\SpyDiscountStoreTableMap;
use Orm\Zed\Discount\Persistence\Map\SpyDiscountTableMap;
use Orm\Zed\Store\Persistence\SpyStore;
use Orm\Zed\Store\Persistence\SpyStoreQuery;
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
 * Base class that represents a row from the 'spy_discount' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.Discount.Persistence.Base
 */
abstract class SpyDiscount implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\Discount\\Persistence\\Map\\SpyDiscountTableMap';


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
     * The value for the id_discount field.
     *
     * @var        int
     */
    protected $id_discount;

    /**
     * The value for the fk_discount_voucher_pool field.
     *
     * @var        int|null
     */
    protected $fk_discount_voucher_pool;

    /**
     * The value for the fk_store field.
     *
     * @var        int|null
     */
    protected $fk_store;

    /**
     * The value for the amount field.
     * A numerical value, often used for price, quantity, or discount.
     * @var        int
     */
    protected $amount;

    /**
     * The value for the calculator_plugin field.
     * The plugin used to calculate a value, such as a discount or price.
     * @var        string|null
     */
    protected $calculator_plugin;

    /**
     * The value for the collector_query_string field.
     * A query string used by a collector to gather applicable items for a discount.
     * @var        string|null
     */
    protected $collector_query_string;

    /**
     * The value for the decision_rule_query_string field.
     * A query string representing the decision rules for a discount.
     * @var        string|null
     */
    protected $decision_rule_query_string;

    /**
     * The value for the description field.
     * A description of an entity.
     * @var        string|null
     */
    protected $description;

    /**
     * The value for the discount_key field.
     *
     * @var        string|null
     */
    protected $discount_key;

    /**
     * The value for the discount_type field.
     * The type of discount (e.g., cart rule, voucher).
     * @var        string|null
     */
    protected $discount_type;

    /**
     * The value for the display_name field.
     * A display name for an entity.
     * @var        string
     */
    protected $display_name;

    /**
     * The value for the is_active field.
     * A boolean flag indicating if an entity is currently active.
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $is_active;

    /**
     * The value for the is_exclusive field.
     * A flag indicating if a discount is exclusive.
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $is_exclusive;

    /**
     * The value for the minimum_item_amount field.
     * The minimum number of items a discount can be applied to.
     * Note: this column has a database default value of: 1
     * @var        int
     */
    protected $minimum_item_amount;

    /**
     * The value for the priority field.
     * A numerical value that determines the order of processing or application, with lower numbers often having higher priority.
     * Note: this column has a database default value of: 9999
     * @var        int|null
     */
    protected $priority;

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
     * @var        ChildSpyDiscountVoucherPool
     */
    protected $aVoucherPool;

    /**
     * @var        SpyStore
     */
    protected $aStore;

    /**
     * @var        ObjectCollection|SpyCustomerDiscount[] Collection to store aggregation of SpyCustomerDiscount objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCustomerDiscount> Collection to store aggregation of SpyCustomerDiscount objects.
     */
    protected $collSpyCustomerDiscounts;
    protected $collSpyCustomerDiscountsPartial;

    /**
     * @var        ObjectCollection|ChildSpyDiscountStore[] Collection to store aggregation of ChildSpyDiscountStore objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyDiscountStore> Collection to store aggregation of ChildSpyDiscountStore objects.
     */
    protected $collSpyDiscountStores;
    protected $collSpyDiscountStoresPartial;

    /**
     * @var        ObjectCollection|ChildSpyDiscountAmount[] Collection to store aggregation of ChildSpyDiscountAmount objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyDiscountAmount> Collection to store aggregation of ChildSpyDiscountAmount objects.
     */
    protected $collDiscountAmounts;
    protected $collDiscountAmountsPartial;

    /**
     * @var        ObjectCollection|SpyDiscountPromotion[] Collection to store aggregation of SpyDiscountPromotion objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyDiscountPromotion> Collection to store aggregation of SpyDiscountPromotion objects.
     */
    protected $collDiscountPromotions;
    protected $collDiscountPromotionsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCustomerDiscount[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCustomerDiscount>
     */
    protected $spyCustomerDiscountsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyDiscountStore[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyDiscountStore>
     */
    protected $spyDiscountStoresScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyDiscountAmount[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyDiscountAmount>
     */
    protected $discountAmountsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyDiscountPromotion[]
     * @phpstan-var ObjectCollection&\Traversable<SpyDiscountPromotion>
     */
    protected $discountPromotionsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->is_active = false;
        $this->is_exclusive = false;
        $this->minimum_item_amount = 1;
        $this->priority = 9999;
    }

    /**
     * Initializes internal state of Orm\Zed\Discount\Persistence\Base\SpyDiscount object.
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
     * Compares this with another <code>SpyDiscount</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyDiscount</code>, delegates to
     * <code>equals(SpyDiscount)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_discount] column value.
     *
     * @return int
     */
    public function getIdDiscount()
    {
        return $this->id_discount;
    }

    /**
     * Get the [fk_discount_voucher_pool] column value.
     *
     * @return int|null
     */
    public function getFkDiscountVoucherPool()
    {
        return $this->fk_discount_voucher_pool;
    }

    /**
     * Get the [fk_store] column value.
     *
     * @return int|null
     */
    public function getFkStore()
    {
        return $this->fk_store;
    }

    /**
     * Get the [amount] column value.
     * A numerical value, often used for price, quantity, or discount.
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Get the [calculator_plugin] column value.
     * The plugin used to calculate a value, such as a discount or price.
     * @return string|null
     */
    public function getCalculatorPlugin()
    {
        return $this->calculator_plugin;
    }

    /**
     * Get the [collector_query_string] column value.
     * A query string used by a collector to gather applicable items for a discount.
     * @return string|null
     */
    public function getCollectorQueryString()
    {
        return $this->collector_query_string;
    }

    /**
     * Get the [decision_rule_query_string] column value.
     * A query string representing the decision rules for a discount.
     * @return string|null
     */
    public function getDecisionRuleQueryString()
    {
        return $this->decision_rule_query_string;
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
     * Get the [discount_key] column value.
     *
     * @return string|null
     */
    public function getDiscountKey()
    {
        return $this->discount_key;
    }

    /**
     * Get the [discount_type] column value.
     * The type of discount (e.g., cart rule, voucher).
     * @return string|null
     */
    public function getDiscountType()
    {
        return $this->discount_type;
    }

    /**
     * Get the [display_name] column value.
     * A display name for an entity.
     * @return string
     */
    public function getDisplayName()
    {
        return $this->display_name;
    }

    /**
     * Get the [is_active] column value.
     * A boolean flag indicating if an entity is currently active.
     * @return boolean|null
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * Get the [is_active] column value.
     * A boolean flag indicating if an entity is currently active.
     * @return boolean|null
     */
    public function isActive()
    {
        return $this->getIsActive();
    }

    /**
     * Get the [is_exclusive] column value.
     * A flag indicating if a discount is exclusive.
     * @return boolean|null
     */
    public function getIsExclusive()
    {
        return $this->is_exclusive;
    }

    /**
     * Get the [is_exclusive] column value.
     * A flag indicating if a discount is exclusive.
     * @return boolean|null
     */
    public function isExclusive()
    {
        return $this->getIsExclusive();
    }

    /**
     * Get the [minimum_item_amount] column value.
     * The minimum number of items a discount can be applied to.
     * @return int
     */
    public function getMinimumItemAmount()
    {
        return $this->minimum_item_amount;
    }

    /**
     * Get the [priority] column value.
     * A numerical value that determines the order of processing or application, with lower numbers often having higher priority.
     * @return int|null
     */
    public function getPriority()
    {
        return $this->priority;
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
     * Set the value of [id_discount] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdDiscount($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_discount !== $v) {
            $this->id_discount = $v;
            $this->modifiedColumns[SpyDiscountTableMap::COL_ID_DISCOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_discount_voucher_pool] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkDiscountVoucherPool($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_discount_voucher_pool !== $v) {
            $this->fk_discount_voucher_pool = $v;
            $this->modifiedColumns[SpyDiscountTableMap::COL_FK_DISCOUNT_VOUCHER_POOL] = true;
        }

        if ($this->aVoucherPool !== null && $this->aVoucherPool->getIdDiscountVoucherPool() !== $v) {
            $this->aVoucherPool = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_store] column.
     *
     * @param int|null $v New value
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
            $this->modifiedColumns[SpyDiscountTableMap::COL_FK_STORE] = true;
        }

        if ($this->aStore !== null && $this->aStore->getIdStore() !== $v) {
            $this->aStore = null;
        }

        return $this;
    }

    /**
     * Set the value of [amount] column.
     * A numerical value, often used for price, quantity, or discount.
     * @param int $v New value
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
            $this->modifiedColumns[SpyDiscountTableMap::COL_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [calculator_plugin] column.
     * The plugin used to calculate a value, such as a discount or price.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCalculatorPlugin($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->calculator_plugin !== $v) {
            $this->calculator_plugin = $v;
            $this->modifiedColumns[SpyDiscountTableMap::COL_CALCULATOR_PLUGIN] = true;
        }

        return $this;
    }

    /**
     * Set the value of [collector_query_string] column.
     * A query string used by a collector to gather applicable items for a discount.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCollectorQueryString($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->collector_query_string !== $v) {
            $this->collector_query_string = $v;
            $this->modifiedColumns[SpyDiscountTableMap::COL_COLLECTOR_QUERY_STRING] = true;
        }

        return $this;
    }

    /**
     * Set the value of [decision_rule_query_string] column.
     * A query string representing the decision rules for a discount.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDecisionRuleQueryString($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->decision_rule_query_string !== $v) {
            $this->decision_rule_query_string = $v;
            $this->modifiedColumns[SpyDiscountTableMap::COL_DECISION_RULE_QUERY_STRING] = true;
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
            $this->modifiedColumns[SpyDiscountTableMap::COL_DESCRIPTION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [discount_key] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDiscountKey($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->discount_key !== $v) {
            $this->discount_key = $v;
            $this->modifiedColumns[SpyDiscountTableMap::COL_DISCOUNT_KEY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [discount_type] column.
     * The type of discount (e.g., cart rule, voucher).
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDiscountType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->discount_type !== $v) {
            $this->discount_type = $v;
            $this->modifiedColumns[SpyDiscountTableMap::COL_DISCOUNT_TYPE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [display_name] column.
     * A display name for an entity.
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDisplayName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->display_name !== $v) {
            $this->display_name = $v;
            $this->modifiedColumns[SpyDiscountTableMap::COL_DISPLAY_NAME] = true;
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
     * @param bool|integer|string|null $v The new value
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
        $hasDefaultValue = true;

        if (($this->isNew() && $hasDefaultValue) || $this->is_active !== $v) {
            $this->is_active = $v;
            $this->modifiedColumns[SpyDiscountTableMap::COL_IS_ACTIVE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_exclusive] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * A flag indicating if a discount is exclusive.
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsExclusive($v)
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

        if (($this->isNew() && $hasDefaultValue) || $this->is_exclusive !== $v) {
            $this->is_exclusive = $v;
            $this->modifiedColumns[SpyDiscountTableMap::COL_IS_EXCLUSIVE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [minimum_item_amount] column.
     * The minimum number of items a discount can be applied to.
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMinimumItemAmount($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = true;

        if (($this->isNew() && $hasDefaultValue) || $this->minimum_item_amount !== $v) {
            $this->minimum_item_amount = $v;
            $this->modifiedColumns[SpyDiscountTableMap::COL_MINIMUM_ITEM_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [priority] column.
     * A numerical value that determines the order of processing or application, with lower numbers often having higher priority.
     * @param int|null $v New value
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
            $this->modifiedColumns[SpyDiscountTableMap::COL_PRIORITY] = true;
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
                $this->modifiedColumns[SpyDiscountTableMap::COL_VALID_FROM] = true;
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
                $this->modifiedColumns[SpyDiscountTableMap::COL_VALID_TO] = true;
            }
        } // if either are not null

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
                $this->modifiedColumns[SpyDiscountTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SpyDiscountTableMap::COL_UPDATED_AT] = true;
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
            if ($this->is_active !== false) {
                return false;
            }

            if ($this->is_exclusive !== false) {
                return false;
            }

            if ($this->minimum_item_amount !== 1) {
                return false;
            }

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyDiscountTableMap::translateFieldName('IdDiscount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_discount = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyDiscountTableMap::translateFieldName('FkDiscountVoucherPool', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_discount_voucher_pool = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyDiscountTableMap::translateFieldName('FkStore', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_store = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyDiscountTableMap::translateFieldName('Amount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->amount = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyDiscountTableMap::translateFieldName('CalculatorPlugin', TableMap::TYPE_PHPNAME, $indexType)];
            $this->calculator_plugin = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyDiscountTableMap::translateFieldName('CollectorQueryString', TableMap::TYPE_PHPNAME, $indexType)];
            $this->collector_query_string = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpyDiscountTableMap::translateFieldName('DecisionRuleQueryString', TableMap::TYPE_PHPNAME, $indexType)];
            $this->decision_rule_query_string = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpyDiscountTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SpyDiscountTableMap::translateFieldName('DiscountKey', TableMap::TYPE_PHPNAME, $indexType)];
            $this->discount_key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SpyDiscountTableMap::translateFieldName('DiscountType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->discount_type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SpyDiscountTableMap::translateFieldName('DisplayName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->display_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : SpyDiscountTableMap::translateFieldName('IsActive', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_active = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : SpyDiscountTableMap::translateFieldName('IsExclusive', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_exclusive = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : SpyDiscountTableMap::translateFieldName('MinimumItemAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->minimum_item_amount = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : SpyDiscountTableMap::translateFieldName('Priority', TableMap::TYPE_PHPNAME, $indexType)];
            $this->priority = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : SpyDiscountTableMap::translateFieldName('ValidFrom', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->valid_from = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : SpyDiscountTableMap::translateFieldName('ValidTo', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->valid_to = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : SpyDiscountTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : SpyDiscountTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 19; // 19 = SpyDiscountTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\Discount\\Persistence\\SpyDiscount'), 0, $e);
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
        if ($this->aVoucherPool !== null && $this->fk_discount_voucher_pool !== $this->aVoucherPool->getIdDiscountVoucherPool()) {
            $this->aVoucherPool = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyDiscountTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyDiscountQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aVoucherPool = null;
            $this->aStore = null;
            $this->collSpyCustomerDiscounts = null;

            $this->collSpyDiscountStores = null;

            $this->collDiscountAmounts = null;

            $this->collDiscountPromotions = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyDiscount::setDeleted()
     * @see SpyDiscount::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyDiscountTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyDiscountQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyDiscountTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                $time = time();
                $highPrecision = \Propel\Runtime\Util\PropelDateTime::createHighPrecision();
                if (!$this->isColumnModified(SpyDiscountTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpyDiscountTableMap::COL_UPDATED_AT)) {
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
                if ($this->isModified() && !$this->isColumnModified(SpyDiscountTableMap::COL_UPDATED_AT)) {
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
                SpyDiscountTableMap::addInstanceToPool($this);
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

            if ($this->aVoucherPool !== null) {
                if ($this->aVoucherPool->isModified() || $this->aVoucherPool->isNew()) {
                    $affectedRows += $this->aVoucherPool->save($con);
                }
                $this->setVoucherPool($this->aVoucherPool);
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

            if ($this->spyCustomerDiscountsScheduledForDeletion !== null) {
                if (!$this->spyCustomerDiscountsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\CustomerDiscountConnector\Persistence\SpyCustomerDiscountQuery::create()
                        ->filterByPrimaryKeys($this->spyCustomerDiscountsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyCustomerDiscountsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCustomerDiscounts !== null) {
                foreach ($this->collSpyCustomerDiscounts as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyDiscountStoresScheduledForDeletion !== null) {
                if (!$this->spyDiscountStoresScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Discount\Persistence\SpyDiscountStoreQuery::create()
                        ->filterByPrimaryKeys($this->spyDiscountStoresScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyDiscountStoresScheduledForDeletion = null;
                }
            }

            if ($this->collSpyDiscountStores !== null) {
                foreach ($this->collSpyDiscountStores as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->discountAmountsScheduledForDeletion !== null) {
                if (!$this->discountAmountsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Discount\Persistence\SpyDiscountAmountQuery::create()
                        ->filterByPrimaryKeys($this->discountAmountsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->discountAmountsScheduledForDeletion = null;
                }
            }

            if ($this->collDiscountAmounts !== null) {
                foreach ($this->collDiscountAmounts as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->discountPromotionsScheduledForDeletion !== null) {
                if (!$this->discountPromotionsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\DiscountPromotion\Persistence\SpyDiscountPromotionQuery::create()
                        ->filterByPrimaryKeys($this->discountPromotionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->discountPromotionsScheduledForDeletion = null;
                }
            }

            if ($this->collDiscountPromotions !== null) {
                foreach ($this->collDiscountPromotions as $referrerFK) {
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

        $this->modifiedColumns[SpyDiscountTableMap::COL_ID_DISCOUNT] = true;
        if (null !== $this->id_discount) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyDiscountTableMap::COL_ID_DISCOUNT . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyDiscountTableMap::COL_ID_DISCOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'id_discount';
        }
        if ($this->isColumnModified(SpyDiscountTableMap::COL_FK_DISCOUNT_VOUCHER_POOL)) {
            $modifiedColumns[':p' . $index++]  = 'fk_discount_voucher_pool';
        }
        if ($this->isColumnModified(SpyDiscountTableMap::COL_FK_STORE)) {
            $modifiedColumns[':p' . $index++]  = 'fk_store';
        }
        if ($this->isColumnModified(SpyDiscountTableMap::COL_AMOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'amount';
        }
        if ($this->isColumnModified(SpyDiscountTableMap::COL_CALCULATOR_PLUGIN)) {
            $modifiedColumns[':p' . $index++]  = 'calculator_plugin';
        }
        if ($this->isColumnModified(SpyDiscountTableMap::COL_COLLECTOR_QUERY_STRING)) {
            $modifiedColumns[':p' . $index++]  = 'collector_query_string';
        }
        if ($this->isColumnModified(SpyDiscountTableMap::COL_DECISION_RULE_QUERY_STRING)) {
            $modifiedColumns[':p' . $index++]  = 'decision_rule_query_string';
        }
        if ($this->isColumnModified(SpyDiscountTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'description';
        }
        if ($this->isColumnModified(SpyDiscountTableMap::COL_DISCOUNT_KEY)) {
            $modifiedColumns[':p' . $index++]  = 'discount_key';
        }
        if ($this->isColumnModified(SpyDiscountTableMap::COL_DISCOUNT_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'discount_type';
        }
        if ($this->isColumnModified(SpyDiscountTableMap::COL_DISPLAY_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'display_name';
        }
        if ($this->isColumnModified(SpyDiscountTableMap::COL_IS_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = 'is_active';
        }
        if ($this->isColumnModified(SpyDiscountTableMap::COL_IS_EXCLUSIVE)) {
            $modifiedColumns[':p' . $index++]  = 'is_exclusive';
        }
        if ($this->isColumnModified(SpyDiscountTableMap::COL_MINIMUM_ITEM_AMOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'minimum_item_amount';
        }
        if ($this->isColumnModified(SpyDiscountTableMap::COL_PRIORITY)) {
            $modifiedColumns[':p' . $index++]  = 'priority';
        }
        if ($this->isColumnModified(SpyDiscountTableMap::COL_VALID_FROM)) {
            $modifiedColumns[':p' . $index++]  = 'valid_from';
        }
        if ($this->isColumnModified(SpyDiscountTableMap::COL_VALID_TO)) {
            $modifiedColumns[':p' . $index++]  = 'valid_to';
        }
        if ($this->isColumnModified(SpyDiscountTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(SpyDiscountTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO spy_discount (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_discount':
                        $stmt->bindValue($identifier, $this->id_discount, PDO::PARAM_INT);

                        break;
                    case 'fk_discount_voucher_pool':
                        $stmt->bindValue($identifier, $this->fk_discount_voucher_pool, PDO::PARAM_INT);

                        break;
                    case 'fk_store':
                        $stmt->bindValue($identifier, $this->fk_store, PDO::PARAM_INT);

                        break;
                    case 'amount':
                        $stmt->bindValue($identifier, $this->amount, PDO::PARAM_INT);

                        break;
                    case 'calculator_plugin':
                        $stmt->bindValue($identifier, $this->calculator_plugin, PDO::PARAM_STR);

                        break;
                    case 'collector_query_string':
                        $stmt->bindValue($identifier, $this->collector_query_string, PDO::PARAM_STR);

                        break;
                    case 'decision_rule_query_string':
                        $stmt->bindValue($identifier, $this->decision_rule_query_string, PDO::PARAM_STR);

                        break;
                    case 'description':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);

                        break;
                    case 'discount_key':
                        $stmt->bindValue($identifier, $this->discount_key, PDO::PARAM_STR);

                        break;
                    case 'discount_type':
                        $stmt->bindValue($identifier, $this->discount_type, PDO::PARAM_STR);

                        break;
                    case 'display_name':
                        $stmt->bindValue($identifier, $this->display_name, PDO::PARAM_STR);

                        break;
                    case 'is_active':
                        $stmt->bindValue($identifier, (int) $this->is_active, PDO::PARAM_INT);

                        break;
                    case 'is_exclusive':
                        $stmt->bindValue($identifier, (int) $this->is_exclusive, PDO::PARAM_INT);

                        break;
                    case 'minimum_item_amount':
                        $stmt->bindValue($identifier, $this->minimum_item_amount, PDO::PARAM_INT);

                        break;
                    case 'priority':
                        $stmt->bindValue($identifier, $this->priority, PDO::PARAM_INT);

                        break;
                    case 'valid_from':
                        $stmt->bindValue($identifier, $this->valid_from ? $this->valid_from->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'valid_to':
                        $stmt->bindValue($identifier, $this->valid_to ? $this->valid_to->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

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
            $pk = $con->lastInsertId('spy_discount_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdDiscount($pk);

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
        $pos = SpyDiscountTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdDiscount();

            case 1:
                return $this->getFkDiscountVoucherPool();

            case 2:
                return $this->getFkStore();

            case 3:
                return $this->getAmount();

            case 4:
                return $this->getCalculatorPlugin();

            case 5:
                return $this->getCollectorQueryString();

            case 6:
                return $this->getDecisionRuleQueryString();

            case 7:
                return $this->getDescription();

            case 8:
                return $this->getDiscountKey();

            case 9:
                return $this->getDiscountType();

            case 10:
                return $this->getDisplayName();

            case 11:
                return $this->getIsActive();

            case 12:
                return $this->getIsExclusive();

            case 13:
                return $this->getMinimumItemAmount();

            case 14:
                return $this->getPriority();

            case 15:
                return $this->getValidFrom();

            case 16:
                return $this->getValidTo();

            case 17:
                return $this->getCreatedAt();

            case 18:
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
        if (isset($alreadyDumpedObjects['SpyDiscount'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyDiscount'][$this->hashCode()] = true;
        $keys = SpyDiscountTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdDiscount(),
            $keys[1] => $this->getFkDiscountVoucherPool(),
            $keys[2] => $this->getFkStore(),
            $keys[3] => $this->getAmount(),
            $keys[4] => $this->getCalculatorPlugin(),
            $keys[5] => $this->getCollectorQueryString(),
            $keys[6] => $this->getDecisionRuleQueryString(),
            $keys[7] => $this->getDescription(),
            $keys[8] => $this->getDiscountKey(),
            $keys[9] => $this->getDiscountType(),
            $keys[10] => $this->getDisplayName(),
            $keys[11] => $this->getIsActive(),
            $keys[12] => $this->getIsExclusive(),
            $keys[13] => $this->getMinimumItemAmount(),
            $keys[14] => $this->getPriority(),
            $keys[15] => $this->getValidFrom(),
            $keys[16] => $this->getValidTo(),
            $keys[17] => $this->getCreatedAt(),
            $keys[18] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[15]] instanceof \DateTimeInterface) {
            $result[$keys[15]] = $result[$keys[15]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[16]] instanceof \DateTimeInterface) {
            $result[$keys[16]] = $result[$keys[16]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[17]] instanceof \DateTimeInterface) {
            $result[$keys[17]] = $result[$keys[17]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[18]] instanceof \DateTimeInterface) {
            $result[$keys[18]] = $result[$keys[18]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aVoucherPool) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyDiscountVoucherPool';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_discount_voucher_pool';
                        break;
                    default:
                        $key = 'VoucherPool';
                }

                $result[$key] = $this->aVoucherPool->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->collSpyCustomerDiscounts) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCustomerDiscounts';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_customer_discounts';
                        break;
                    default:
                        $key = 'SpyCustomerDiscounts';
                }

                $result[$key] = $this->collSpyCustomerDiscounts->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyDiscountStores) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyDiscountStores';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_discount_stores';
                        break;
                    default:
                        $key = 'SpyDiscountStores';
                }

                $result[$key] = $this->collSpyDiscountStores->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collDiscountAmounts) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyDiscountAmounts';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_discount_amounts';
                        break;
                    default:
                        $key = 'DiscountAmounts';
                }

                $result[$key] = $this->collDiscountAmounts->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collDiscountPromotions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyDiscountPromotions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_discount_promotions';
                        break;
                    default:
                        $key = 'DiscountPromotions';
                }

                $result[$key] = $this->collDiscountPromotions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyDiscountTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdDiscount($value);
                break;
            case 1:
                $this->setFkDiscountVoucherPool($value);
                break;
            case 2:
                $this->setFkStore($value);
                break;
            case 3:
                $this->setAmount($value);
                break;
            case 4:
                $this->setCalculatorPlugin($value);
                break;
            case 5:
                $this->setCollectorQueryString($value);
                break;
            case 6:
                $this->setDecisionRuleQueryString($value);
                break;
            case 7:
                $this->setDescription($value);
                break;
            case 8:
                $this->setDiscountKey($value);
                break;
            case 9:
                $this->setDiscountType($value);
                break;
            case 10:
                $this->setDisplayName($value);
                break;
            case 11:
                $this->setIsActive($value);
                break;
            case 12:
                $this->setIsExclusive($value);
                break;
            case 13:
                $this->setMinimumItemAmount($value);
                break;
            case 14:
                $this->setPriority($value);
                break;
            case 15:
                $this->setValidFrom($value);
                break;
            case 16:
                $this->setValidTo($value);
                break;
            case 17:
                $this->setCreatedAt($value);
                break;
            case 18:
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
        $keys = SpyDiscountTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdDiscount($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkDiscountVoucherPool($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setFkStore($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setAmount($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setCalculatorPlugin($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setCollectorQueryString($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setDecisionRuleQueryString($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setDescription($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setDiscountKey($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setDiscountType($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setDisplayName($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setIsActive($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setIsExclusive($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setMinimumItemAmount($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setPriority($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setValidFrom($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setValidTo($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setCreatedAt($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setUpdatedAt($arr[$keys[18]]);
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
        $criteria = new Criteria(SpyDiscountTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyDiscountTableMap::COL_ID_DISCOUNT)) {
            $criteria->add(SpyDiscountTableMap::COL_ID_DISCOUNT, $this->id_discount);
        }
        if ($this->isColumnModified(SpyDiscountTableMap::COL_FK_DISCOUNT_VOUCHER_POOL)) {
            $criteria->add(SpyDiscountTableMap::COL_FK_DISCOUNT_VOUCHER_POOL, $this->fk_discount_voucher_pool);
        }
        if ($this->isColumnModified(SpyDiscountTableMap::COL_FK_STORE)) {
            $criteria->add(SpyDiscountTableMap::COL_FK_STORE, $this->fk_store);
        }
        if ($this->isColumnModified(SpyDiscountTableMap::COL_AMOUNT)) {
            $criteria->add(SpyDiscountTableMap::COL_AMOUNT, $this->amount);
        }
        if ($this->isColumnModified(SpyDiscountTableMap::COL_CALCULATOR_PLUGIN)) {
            $criteria->add(SpyDiscountTableMap::COL_CALCULATOR_PLUGIN, $this->calculator_plugin);
        }
        if ($this->isColumnModified(SpyDiscountTableMap::COL_COLLECTOR_QUERY_STRING)) {
            $criteria->add(SpyDiscountTableMap::COL_COLLECTOR_QUERY_STRING, $this->collector_query_string);
        }
        if ($this->isColumnModified(SpyDiscountTableMap::COL_DECISION_RULE_QUERY_STRING)) {
            $criteria->add(SpyDiscountTableMap::COL_DECISION_RULE_QUERY_STRING, $this->decision_rule_query_string);
        }
        if ($this->isColumnModified(SpyDiscountTableMap::COL_DESCRIPTION)) {
            $criteria->add(SpyDiscountTableMap::COL_DESCRIPTION, $this->description);
        }
        if ($this->isColumnModified(SpyDiscountTableMap::COL_DISCOUNT_KEY)) {
            $criteria->add(SpyDiscountTableMap::COL_DISCOUNT_KEY, $this->discount_key);
        }
        if ($this->isColumnModified(SpyDiscountTableMap::COL_DISCOUNT_TYPE)) {
            $criteria->add(SpyDiscountTableMap::COL_DISCOUNT_TYPE, $this->discount_type);
        }
        if ($this->isColumnModified(SpyDiscountTableMap::COL_DISPLAY_NAME)) {
            $criteria->add(SpyDiscountTableMap::COL_DISPLAY_NAME, $this->display_name);
        }
        if ($this->isColumnModified(SpyDiscountTableMap::COL_IS_ACTIVE)) {
            $criteria->add(SpyDiscountTableMap::COL_IS_ACTIVE, $this->is_active);
        }
        if ($this->isColumnModified(SpyDiscountTableMap::COL_IS_EXCLUSIVE)) {
            $criteria->add(SpyDiscountTableMap::COL_IS_EXCLUSIVE, $this->is_exclusive);
        }
        if ($this->isColumnModified(SpyDiscountTableMap::COL_MINIMUM_ITEM_AMOUNT)) {
            $criteria->add(SpyDiscountTableMap::COL_MINIMUM_ITEM_AMOUNT, $this->minimum_item_amount);
        }
        if ($this->isColumnModified(SpyDiscountTableMap::COL_PRIORITY)) {
            $criteria->add(SpyDiscountTableMap::COL_PRIORITY, $this->priority);
        }
        if ($this->isColumnModified(SpyDiscountTableMap::COL_VALID_FROM)) {
            $criteria->add(SpyDiscountTableMap::COL_VALID_FROM, $this->valid_from);
        }
        if ($this->isColumnModified(SpyDiscountTableMap::COL_VALID_TO)) {
            $criteria->add(SpyDiscountTableMap::COL_VALID_TO, $this->valid_to);
        }
        if ($this->isColumnModified(SpyDiscountTableMap::COL_CREATED_AT)) {
            $criteria->add(SpyDiscountTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpyDiscountTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpyDiscountTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildSpyDiscountQuery::create();
        $criteria->add(SpyDiscountTableMap::COL_ID_DISCOUNT, $this->id_discount);

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
        $validPk = null !== $this->getIdDiscount();

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
        return $this->getIdDiscount();
    }

    /**
     * Generic method to set the primary key (id_discount column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdDiscount($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdDiscount();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\Discount\Persistence\SpyDiscount (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkDiscountVoucherPool($this->getFkDiscountVoucherPool());
        $copyObj->setFkStore($this->getFkStore());
        $copyObj->setAmount($this->getAmount());
        $copyObj->setCalculatorPlugin($this->getCalculatorPlugin());
        $copyObj->setCollectorQueryString($this->getCollectorQueryString());
        $copyObj->setDecisionRuleQueryString($this->getDecisionRuleQueryString());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setDiscountKey($this->getDiscountKey());
        $copyObj->setDiscountType($this->getDiscountType());
        $copyObj->setDisplayName($this->getDisplayName());
        $copyObj->setIsActive($this->getIsActive());
        $copyObj->setIsExclusive($this->getIsExclusive());
        $copyObj->setMinimumItemAmount($this->getMinimumItemAmount());
        $copyObj->setPriority($this->getPriority());
        $copyObj->setValidFrom($this->getValidFrom());
        $copyObj->setValidTo($this->getValidTo());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyCustomerDiscounts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCustomerDiscount($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyDiscountStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyDiscountStore($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getDiscountAmounts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDiscountAmount($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getDiscountPromotions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDiscountPromotion($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdDiscount(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\Discount\Persistence\SpyDiscount Clone of current object.
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
     * Declares an association between this object and a ChildSpyDiscountVoucherPool object.
     *
     * @param ChildSpyDiscountVoucherPool|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setVoucherPool(ChildSpyDiscountVoucherPool $v = null)
    {
        if ($v === null) {
            $this->setFkDiscountVoucherPool(NULL);
        } else {
            $this->setFkDiscountVoucherPool($v->getIdDiscountVoucherPool());
        }

        $this->aVoucherPool = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpyDiscountVoucherPool object, it will not be re-added.
        if ($v !== null) {
            $v->addDiscount($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpyDiscountVoucherPool object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSpyDiscountVoucherPool|null The associated ChildSpyDiscountVoucherPool object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getVoucherPool(?ConnectionInterface $con = null)
    {
        if ($this->aVoucherPool === null && ($this->fk_discount_voucher_pool != 0)) {
            $this->aVoucherPool = ChildSpyDiscountVoucherPoolQuery::create()->findPk($this->fk_discount_voucher_pool, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aVoucherPool->addDiscounts($this);
             */
        }

        return $this->aVoucherPool;
    }

    /**
     * Declares an association between this object and a SpyStore object.
     *
     * @param SpyStore|null $v
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
            $v->addDiscount($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyStore object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyStore|null The associated SpyStore object.
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
                $this->aStore->addDiscounts($this);
             */
        }

        return $this->aStore;
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
        if ('SpyCustomerDiscount' === $relationName) {
            $this->initSpyCustomerDiscounts();
            return;
        }
        if ('SpyDiscountStore' === $relationName) {
            $this->initSpyDiscountStores();
            return;
        }
        if ('DiscountAmount' === $relationName) {
            $this->initDiscountAmounts();
            return;
        }
        if ('DiscountPromotion' === $relationName) {
            $this->initDiscountPromotions();
            return;
        }
    }

    /**
     * Clears out the collSpyCustomerDiscounts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCustomerDiscounts()
     */
    public function clearSpyCustomerDiscounts()
    {
        $this->collSpyCustomerDiscounts = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCustomerDiscounts collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCustomerDiscounts($v = true): void
    {
        $this->collSpyCustomerDiscountsPartial = $v;
    }

    /**
     * Initializes the collSpyCustomerDiscounts collection.
     *
     * By default this just sets the collSpyCustomerDiscounts collection to an empty array (like clearcollSpyCustomerDiscounts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCustomerDiscounts(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCustomerDiscounts && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCustomerDiscountTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCustomerDiscounts = new $collectionClassName;
        $this->collSpyCustomerDiscounts->setModel('\Orm\Zed\CustomerDiscountConnector\Persistence\SpyCustomerDiscount');
    }

    /**
     * Gets an array of SpyCustomerDiscount objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyDiscount is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCustomerDiscount[] List of SpyCustomerDiscount objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCustomerDiscount> List of SpyCustomerDiscount objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCustomerDiscounts(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCustomerDiscountsPartial && !$this->isNew();
        if (null === $this->collSpyCustomerDiscounts || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCustomerDiscounts) {
                    $this->initSpyCustomerDiscounts();
                } else {
                    $collectionClassName = SpyCustomerDiscountTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCustomerDiscounts = new $collectionClassName;
                    $collSpyCustomerDiscounts->setModel('\Orm\Zed\CustomerDiscountConnector\Persistence\SpyCustomerDiscount');

                    return $collSpyCustomerDiscounts;
                }
            } else {
                $collSpyCustomerDiscounts = SpyCustomerDiscountQuery::create(null, $criteria)
                    ->filterByDiscount($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCustomerDiscountsPartial && count($collSpyCustomerDiscounts)) {
                        $this->initSpyCustomerDiscounts(false);

                        foreach ($collSpyCustomerDiscounts as $obj) {
                            if (false == $this->collSpyCustomerDiscounts->contains($obj)) {
                                $this->collSpyCustomerDiscounts->append($obj);
                            }
                        }

                        $this->collSpyCustomerDiscountsPartial = true;
                    }

                    return $collSpyCustomerDiscounts;
                }

                if ($partial && $this->collSpyCustomerDiscounts) {
                    foreach ($this->collSpyCustomerDiscounts as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCustomerDiscounts[] = $obj;
                        }
                    }
                }

                $this->collSpyCustomerDiscounts = $collSpyCustomerDiscounts;
                $this->collSpyCustomerDiscountsPartial = false;
            }
        }

        return $this->collSpyCustomerDiscounts;
    }

    /**
     * Sets a collection of SpyCustomerDiscount objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCustomerDiscounts A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCustomerDiscounts(Collection $spyCustomerDiscounts, ?ConnectionInterface $con = null)
    {
        /** @var SpyCustomerDiscount[] $spyCustomerDiscountsToDelete */
        $spyCustomerDiscountsToDelete = $this->getSpyCustomerDiscounts(new Criteria(), $con)->diff($spyCustomerDiscounts);


        $this->spyCustomerDiscountsScheduledForDeletion = $spyCustomerDiscountsToDelete;

        foreach ($spyCustomerDiscountsToDelete as $spyCustomerDiscountRemoved) {
            $spyCustomerDiscountRemoved->setDiscount(null);
        }

        $this->collSpyCustomerDiscounts = null;
        foreach ($spyCustomerDiscounts as $spyCustomerDiscount) {
            $this->addSpyCustomerDiscount($spyCustomerDiscount);
        }

        $this->collSpyCustomerDiscounts = $spyCustomerDiscounts;
        $this->collSpyCustomerDiscountsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCustomerDiscount objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCustomerDiscount objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCustomerDiscounts(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCustomerDiscountsPartial && !$this->isNew();
        if (null === $this->collSpyCustomerDiscounts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCustomerDiscounts) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCustomerDiscounts());
            }

            $query = SpyCustomerDiscountQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByDiscount($this)
                ->count($con);
        }

        return count($this->collSpyCustomerDiscounts);
    }

    /**
     * Method called to associate a SpyCustomerDiscount object to this object
     * through the SpyCustomerDiscount foreign key attribute.
     *
     * @param SpyCustomerDiscount $l SpyCustomerDiscount
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCustomerDiscount(SpyCustomerDiscount $l)
    {
        if ($this->collSpyCustomerDiscounts === null) {
            $this->initSpyCustomerDiscounts();
            $this->collSpyCustomerDiscountsPartial = true;
        }

        if (!$this->collSpyCustomerDiscounts->contains($l)) {
            $this->doAddSpyCustomerDiscount($l);

            if ($this->spyCustomerDiscountsScheduledForDeletion and $this->spyCustomerDiscountsScheduledForDeletion->contains($l)) {
                $this->spyCustomerDiscountsScheduledForDeletion->remove($this->spyCustomerDiscountsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCustomerDiscount $spyCustomerDiscount The SpyCustomerDiscount object to add.
     */
    protected function doAddSpyCustomerDiscount(SpyCustomerDiscount $spyCustomerDiscount): void
    {
        $this->collSpyCustomerDiscounts[]= $spyCustomerDiscount;
        $spyCustomerDiscount->setDiscount($this);
    }

    /**
     * @param SpyCustomerDiscount $spyCustomerDiscount The SpyCustomerDiscount object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCustomerDiscount(SpyCustomerDiscount $spyCustomerDiscount)
    {
        if ($this->getSpyCustomerDiscounts()->contains($spyCustomerDiscount)) {
            $pos = $this->collSpyCustomerDiscounts->search($spyCustomerDiscount);
            $this->collSpyCustomerDiscounts->remove($pos);
            if (null === $this->spyCustomerDiscountsScheduledForDeletion) {
                $this->spyCustomerDiscountsScheduledForDeletion = clone $this->collSpyCustomerDiscounts;
                $this->spyCustomerDiscountsScheduledForDeletion->clear();
            }
            $this->spyCustomerDiscountsScheduledForDeletion[]= clone $spyCustomerDiscount;
            $spyCustomerDiscount->setDiscount(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyDiscount is new, it will return
     * an empty collection; or if this SpyDiscount has previously
     * been saved, it will retrieve related SpyCustomerDiscounts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyDiscount.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCustomerDiscount[] List of SpyCustomerDiscount objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCustomerDiscount}> List of SpyCustomerDiscount objects
     */
    public function getSpyCustomerDiscountsJoinCustomer(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCustomerDiscountQuery::create(null, $criteria);
        $query->joinWith('Customer', $joinBehavior);

        return $this->getSpyCustomerDiscounts($query, $con);
    }

    /**
     * Clears out the collSpyDiscountStores collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyDiscountStores()
     */
    public function clearSpyDiscountStores()
    {
        $this->collSpyDiscountStores = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyDiscountStores collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyDiscountStores($v = true): void
    {
        $this->collSpyDiscountStoresPartial = $v;
    }

    /**
     * Initializes the collSpyDiscountStores collection.
     *
     * By default this just sets the collSpyDiscountStores collection to an empty array (like clearcollSpyDiscountStores());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyDiscountStores(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyDiscountStores && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyDiscountStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyDiscountStores = new $collectionClassName;
        $this->collSpyDiscountStores->setModel('\Orm\Zed\Discount\Persistence\SpyDiscountStore');
    }

    /**
     * Gets an array of ChildSpyDiscountStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyDiscount is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyDiscountStore[] List of ChildSpyDiscountStore objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyDiscountStore> List of ChildSpyDiscountStore objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyDiscountStores(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyDiscountStoresPartial && !$this->isNew();
        if (null === $this->collSpyDiscountStores || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyDiscountStores) {
                    $this->initSpyDiscountStores();
                } else {
                    $collectionClassName = SpyDiscountStoreTableMap::getTableMap()->getCollectionClassName();

                    $collSpyDiscountStores = new $collectionClassName;
                    $collSpyDiscountStores->setModel('\Orm\Zed\Discount\Persistence\SpyDiscountStore');

                    return $collSpyDiscountStores;
                }
            } else {
                $collSpyDiscountStores = ChildSpyDiscountStoreQuery::create(null, $criteria)
                    ->filterBySpyDiscount($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyDiscountStoresPartial && count($collSpyDiscountStores)) {
                        $this->initSpyDiscountStores(false);

                        foreach ($collSpyDiscountStores as $obj) {
                            if (false == $this->collSpyDiscountStores->contains($obj)) {
                                $this->collSpyDiscountStores->append($obj);
                            }
                        }

                        $this->collSpyDiscountStoresPartial = true;
                    }

                    return $collSpyDiscountStores;
                }

                if ($partial && $this->collSpyDiscountStores) {
                    foreach ($this->collSpyDiscountStores as $obj) {
                        if ($obj->isNew()) {
                            $collSpyDiscountStores[] = $obj;
                        }
                    }
                }

                $this->collSpyDiscountStores = $collSpyDiscountStores;
                $this->collSpyDiscountStoresPartial = false;
            }
        }

        return $this->collSpyDiscountStores;
    }

    /**
     * Sets a collection of ChildSpyDiscountStore objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyDiscountStores A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyDiscountStores(Collection $spyDiscountStores, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyDiscountStore[] $spyDiscountStoresToDelete */
        $spyDiscountStoresToDelete = $this->getSpyDiscountStores(new Criteria(), $con)->diff($spyDiscountStores);


        $this->spyDiscountStoresScheduledForDeletion = $spyDiscountStoresToDelete;

        foreach ($spyDiscountStoresToDelete as $spyDiscountStoreRemoved) {
            $spyDiscountStoreRemoved->setSpyDiscount(null);
        }

        $this->collSpyDiscountStores = null;
        foreach ($spyDiscountStores as $spyDiscountStore) {
            $this->addSpyDiscountStore($spyDiscountStore);
        }

        $this->collSpyDiscountStores = $spyDiscountStores;
        $this->collSpyDiscountStoresPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyDiscountStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyDiscountStore objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyDiscountStores(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyDiscountStoresPartial && !$this->isNew();
        if (null === $this->collSpyDiscountStores || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyDiscountStores) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyDiscountStores());
            }

            $query = ChildSpyDiscountStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyDiscount($this)
                ->count($con);
        }

        return count($this->collSpyDiscountStores);
    }

    /**
     * Method called to associate a ChildSpyDiscountStore object to this object
     * through the ChildSpyDiscountStore foreign key attribute.
     *
     * @param ChildSpyDiscountStore $l ChildSpyDiscountStore
     * @return $this The current object (for fluent API support)
     */
    public function addSpyDiscountStore(ChildSpyDiscountStore $l)
    {
        if ($this->collSpyDiscountStores === null) {
            $this->initSpyDiscountStores();
            $this->collSpyDiscountStoresPartial = true;
        }

        if (!$this->collSpyDiscountStores->contains($l)) {
            $this->doAddSpyDiscountStore($l);

            if ($this->spyDiscountStoresScheduledForDeletion and $this->spyDiscountStoresScheduledForDeletion->contains($l)) {
                $this->spyDiscountStoresScheduledForDeletion->remove($this->spyDiscountStoresScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyDiscountStore $spyDiscountStore The ChildSpyDiscountStore object to add.
     */
    protected function doAddSpyDiscountStore(ChildSpyDiscountStore $spyDiscountStore): void
    {
        $this->collSpyDiscountStores[]= $spyDiscountStore;
        $spyDiscountStore->setSpyDiscount($this);
    }

    /**
     * @param ChildSpyDiscountStore $spyDiscountStore The ChildSpyDiscountStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyDiscountStore(ChildSpyDiscountStore $spyDiscountStore)
    {
        if ($this->getSpyDiscountStores()->contains($spyDiscountStore)) {
            $pos = $this->collSpyDiscountStores->search($spyDiscountStore);
            $this->collSpyDiscountStores->remove($pos);
            if (null === $this->spyDiscountStoresScheduledForDeletion) {
                $this->spyDiscountStoresScheduledForDeletion = clone $this->collSpyDiscountStores;
                $this->spyDiscountStoresScheduledForDeletion->clear();
            }
            $this->spyDiscountStoresScheduledForDeletion[]= clone $spyDiscountStore;
            $spyDiscountStore->setSpyDiscount(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyDiscount is new, it will return
     * an empty collection; or if this SpyDiscount has previously
     * been saved, it will retrieve related SpyDiscountStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyDiscount.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyDiscountStore[] List of ChildSpyDiscountStore objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyDiscountStore}> List of ChildSpyDiscountStore objects
     */
    public function getSpyDiscountStoresJoinSpyStore(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyDiscountStoreQuery::create(null, $criteria);
        $query->joinWith('SpyStore', $joinBehavior);

        return $this->getSpyDiscountStores($query, $con);
    }

    /**
     * Clears out the collDiscountAmounts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addDiscountAmounts()
     */
    public function clearDiscountAmounts()
    {
        $this->collDiscountAmounts = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collDiscountAmounts collection loaded partially.
     *
     * @return void
     */
    public function resetPartialDiscountAmounts($v = true): void
    {
        $this->collDiscountAmountsPartial = $v;
    }

    /**
     * Initializes the collDiscountAmounts collection.
     *
     * By default this just sets the collDiscountAmounts collection to an empty array (like clearcollDiscountAmounts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDiscountAmounts(bool $overrideExisting = true): void
    {
        if (null !== $this->collDiscountAmounts && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyDiscountAmountTableMap::getTableMap()->getCollectionClassName();

        $this->collDiscountAmounts = new $collectionClassName;
        $this->collDiscountAmounts->setModel('\Orm\Zed\Discount\Persistence\SpyDiscountAmount');
    }

    /**
     * Gets an array of ChildSpyDiscountAmount objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyDiscount is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyDiscountAmount[] List of ChildSpyDiscountAmount objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyDiscountAmount> List of ChildSpyDiscountAmount objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getDiscountAmounts(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collDiscountAmountsPartial && !$this->isNew();
        if (null === $this->collDiscountAmounts || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collDiscountAmounts) {
                    $this->initDiscountAmounts();
                } else {
                    $collectionClassName = SpyDiscountAmountTableMap::getTableMap()->getCollectionClassName();

                    $collDiscountAmounts = new $collectionClassName;
                    $collDiscountAmounts->setModel('\Orm\Zed\Discount\Persistence\SpyDiscountAmount');

                    return $collDiscountAmounts;
                }
            } else {
                $collDiscountAmounts = ChildSpyDiscountAmountQuery::create(null, $criteria)
                    ->filterByDiscount($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collDiscountAmountsPartial && count($collDiscountAmounts)) {
                        $this->initDiscountAmounts(false);

                        foreach ($collDiscountAmounts as $obj) {
                            if (false == $this->collDiscountAmounts->contains($obj)) {
                                $this->collDiscountAmounts->append($obj);
                            }
                        }

                        $this->collDiscountAmountsPartial = true;
                    }

                    return $collDiscountAmounts;
                }

                if ($partial && $this->collDiscountAmounts) {
                    foreach ($this->collDiscountAmounts as $obj) {
                        if ($obj->isNew()) {
                            $collDiscountAmounts[] = $obj;
                        }
                    }
                }

                $this->collDiscountAmounts = $collDiscountAmounts;
                $this->collDiscountAmountsPartial = false;
            }
        }

        return $this->collDiscountAmounts;
    }

    /**
     * Sets a collection of ChildSpyDiscountAmount objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $discountAmounts A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setDiscountAmounts(Collection $discountAmounts, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyDiscountAmount[] $discountAmountsToDelete */
        $discountAmountsToDelete = $this->getDiscountAmounts(new Criteria(), $con)->diff($discountAmounts);


        $this->discountAmountsScheduledForDeletion = $discountAmountsToDelete;

        foreach ($discountAmountsToDelete as $discountAmountRemoved) {
            $discountAmountRemoved->setDiscount(null);
        }

        $this->collDiscountAmounts = null;
        foreach ($discountAmounts as $discountAmount) {
            $this->addDiscountAmount($discountAmount);
        }

        $this->collDiscountAmounts = $discountAmounts;
        $this->collDiscountAmountsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyDiscountAmount objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyDiscountAmount objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countDiscountAmounts(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collDiscountAmountsPartial && !$this->isNew();
        if (null === $this->collDiscountAmounts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDiscountAmounts) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getDiscountAmounts());
            }

            $query = ChildSpyDiscountAmountQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByDiscount($this)
                ->count($con);
        }

        return count($this->collDiscountAmounts);
    }

    /**
     * Method called to associate a ChildSpyDiscountAmount object to this object
     * through the ChildSpyDiscountAmount foreign key attribute.
     *
     * @param ChildSpyDiscountAmount $l ChildSpyDiscountAmount
     * @return $this The current object (for fluent API support)
     */
    public function addDiscountAmount(ChildSpyDiscountAmount $l)
    {
        if ($this->collDiscountAmounts === null) {
            $this->initDiscountAmounts();
            $this->collDiscountAmountsPartial = true;
        }

        if (!$this->collDiscountAmounts->contains($l)) {
            $this->doAddDiscountAmount($l);

            if ($this->discountAmountsScheduledForDeletion and $this->discountAmountsScheduledForDeletion->contains($l)) {
                $this->discountAmountsScheduledForDeletion->remove($this->discountAmountsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyDiscountAmount $discountAmount The ChildSpyDiscountAmount object to add.
     */
    protected function doAddDiscountAmount(ChildSpyDiscountAmount $discountAmount): void
    {
        $this->collDiscountAmounts[]= $discountAmount;
        $discountAmount->setDiscount($this);
    }

    /**
     * @param ChildSpyDiscountAmount $discountAmount The ChildSpyDiscountAmount object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeDiscountAmount(ChildSpyDiscountAmount $discountAmount)
    {
        if ($this->getDiscountAmounts()->contains($discountAmount)) {
            $pos = $this->collDiscountAmounts->search($discountAmount);
            $this->collDiscountAmounts->remove($pos);
            if (null === $this->discountAmountsScheduledForDeletion) {
                $this->discountAmountsScheduledForDeletion = clone $this->collDiscountAmounts;
                $this->discountAmountsScheduledForDeletion->clear();
            }
            $this->discountAmountsScheduledForDeletion[]= clone $discountAmount;
            $discountAmount->setDiscount(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyDiscount is new, it will return
     * an empty collection; or if this SpyDiscount has previously
     * been saved, it will retrieve related DiscountAmounts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyDiscount.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyDiscountAmount[] List of ChildSpyDiscountAmount objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyDiscountAmount}> List of ChildSpyDiscountAmount objects
     */
    public function getDiscountAmountsJoinCurrency(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyDiscountAmountQuery::create(null, $criteria);
        $query->joinWith('Currency', $joinBehavior);

        return $this->getDiscountAmounts($query, $con);
    }

    /**
     * Clears out the collDiscountPromotions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addDiscountPromotions()
     */
    public function clearDiscountPromotions()
    {
        $this->collDiscountPromotions = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collDiscountPromotions collection loaded partially.
     *
     * @return void
     */
    public function resetPartialDiscountPromotions($v = true): void
    {
        $this->collDiscountPromotionsPartial = $v;
    }

    /**
     * Initializes the collDiscountPromotions collection.
     *
     * By default this just sets the collDiscountPromotions collection to an empty array (like clearcollDiscountPromotions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDiscountPromotions(bool $overrideExisting = true): void
    {
        if (null !== $this->collDiscountPromotions && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyDiscountPromotionTableMap::getTableMap()->getCollectionClassName();

        $this->collDiscountPromotions = new $collectionClassName;
        $this->collDiscountPromotions->setModel('\Orm\Zed\DiscountPromotion\Persistence\SpyDiscountPromotion');
    }

    /**
     * Gets an array of SpyDiscountPromotion objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyDiscount is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyDiscountPromotion[] List of SpyDiscountPromotion objects
     * @phpstan-return ObjectCollection&\Traversable<SpyDiscountPromotion> List of SpyDiscountPromotion objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getDiscountPromotions(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collDiscountPromotionsPartial && !$this->isNew();
        if (null === $this->collDiscountPromotions || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collDiscountPromotions) {
                    $this->initDiscountPromotions();
                } else {
                    $collectionClassName = SpyDiscountPromotionTableMap::getTableMap()->getCollectionClassName();

                    $collDiscountPromotions = new $collectionClassName;
                    $collDiscountPromotions->setModel('\Orm\Zed\DiscountPromotion\Persistence\SpyDiscountPromotion');

                    return $collDiscountPromotions;
                }
            } else {
                $collDiscountPromotions = SpyDiscountPromotionQuery::create(null, $criteria)
                    ->filterByDiscount($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collDiscountPromotionsPartial && count($collDiscountPromotions)) {
                        $this->initDiscountPromotions(false);

                        foreach ($collDiscountPromotions as $obj) {
                            if (false == $this->collDiscountPromotions->contains($obj)) {
                                $this->collDiscountPromotions->append($obj);
                            }
                        }

                        $this->collDiscountPromotionsPartial = true;
                    }

                    return $collDiscountPromotions;
                }

                if ($partial && $this->collDiscountPromotions) {
                    foreach ($this->collDiscountPromotions as $obj) {
                        if ($obj->isNew()) {
                            $collDiscountPromotions[] = $obj;
                        }
                    }
                }

                $this->collDiscountPromotions = $collDiscountPromotions;
                $this->collDiscountPromotionsPartial = false;
            }
        }

        return $this->collDiscountPromotions;
    }

    /**
     * Sets a collection of SpyDiscountPromotion objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $discountPromotions A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setDiscountPromotions(Collection $discountPromotions, ?ConnectionInterface $con = null)
    {
        /** @var SpyDiscountPromotion[] $discountPromotionsToDelete */
        $discountPromotionsToDelete = $this->getDiscountPromotions(new Criteria(), $con)->diff($discountPromotions);


        $this->discountPromotionsScheduledForDeletion = $discountPromotionsToDelete;

        foreach ($discountPromotionsToDelete as $discountPromotionRemoved) {
            $discountPromotionRemoved->setDiscount(null);
        }

        $this->collDiscountPromotions = null;
        foreach ($discountPromotions as $discountPromotion) {
            $this->addDiscountPromotion($discountPromotion);
        }

        $this->collDiscountPromotions = $discountPromotions;
        $this->collDiscountPromotionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyDiscountPromotion objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyDiscountPromotion objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countDiscountPromotions(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collDiscountPromotionsPartial && !$this->isNew();
        if (null === $this->collDiscountPromotions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDiscountPromotions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getDiscountPromotions());
            }

            $query = SpyDiscountPromotionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByDiscount($this)
                ->count($con);
        }

        return count($this->collDiscountPromotions);
    }

    /**
     * Method called to associate a SpyDiscountPromotion object to this object
     * through the SpyDiscountPromotion foreign key attribute.
     *
     * @param SpyDiscountPromotion $l SpyDiscountPromotion
     * @return $this The current object (for fluent API support)
     */
    public function addDiscountPromotion(SpyDiscountPromotion $l)
    {
        if ($this->collDiscountPromotions === null) {
            $this->initDiscountPromotions();
            $this->collDiscountPromotionsPartial = true;
        }

        if (!$this->collDiscountPromotions->contains($l)) {
            $this->doAddDiscountPromotion($l);

            if ($this->discountPromotionsScheduledForDeletion and $this->discountPromotionsScheduledForDeletion->contains($l)) {
                $this->discountPromotionsScheduledForDeletion->remove($this->discountPromotionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyDiscountPromotion $discountPromotion The SpyDiscountPromotion object to add.
     */
    protected function doAddDiscountPromotion(SpyDiscountPromotion $discountPromotion): void
    {
        $this->collDiscountPromotions[]= $discountPromotion;
        $discountPromotion->setDiscount($this);
    }

    /**
     * @param SpyDiscountPromotion $discountPromotion The SpyDiscountPromotion object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeDiscountPromotion(SpyDiscountPromotion $discountPromotion)
    {
        if ($this->getDiscountPromotions()->contains($discountPromotion)) {
            $pos = $this->collDiscountPromotions->search($discountPromotion);
            $this->collDiscountPromotions->remove($pos);
            if (null === $this->discountPromotionsScheduledForDeletion) {
                $this->discountPromotionsScheduledForDeletion = clone $this->collDiscountPromotions;
                $this->discountPromotionsScheduledForDeletion->clear();
            }
            $this->discountPromotionsScheduledForDeletion[]= clone $discountPromotion;
            $discountPromotion->setDiscount(null);
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
        if (null !== $this->aVoucherPool) {
            $this->aVoucherPool->removeDiscount($this);
        }
        if (null !== $this->aStore) {
            $this->aStore->removeDiscount($this);
        }
        $this->id_discount = null;
        $this->fk_discount_voucher_pool = null;
        $this->fk_store = null;
        $this->amount = null;
        $this->calculator_plugin = null;
        $this->collector_query_string = null;
        $this->decision_rule_query_string = null;
        $this->description = null;
        $this->discount_key = null;
        $this->discount_type = null;
        $this->display_name = null;
        $this->is_active = null;
        $this->is_exclusive = null;
        $this->minimum_item_amount = null;
        $this->priority = null;
        $this->valid_from = null;
        $this->valid_to = null;
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
            if ($this->collSpyCustomerDiscounts) {
                foreach ($this->collSpyCustomerDiscounts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyDiscountStores) {
                foreach ($this->collSpyDiscountStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDiscountAmounts) {
                foreach ($this->collDiscountAmounts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDiscountPromotions) {
                foreach ($this->collDiscountPromotions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyCustomerDiscounts = null;
        $this->collSpyDiscountStores = null;
        $this->collDiscountAmounts = null;
        $this->collDiscountPromotions = null;
        $this->aVoucherPool = null;
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
        return (string) $this->exportTo(SpyDiscountTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return $this The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[SpyDiscountTableMap::COL_UPDATED_AT] = true;

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
