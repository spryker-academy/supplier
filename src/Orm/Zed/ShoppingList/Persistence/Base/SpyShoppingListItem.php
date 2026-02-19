<?php

namespace Orm\Zed\ShoppingList\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\ShoppingListNote\Persistence\SpyShoppingListItemNote;
use Orm\Zed\ShoppingListNote\Persistence\SpyShoppingListItemNoteQuery;
use Orm\Zed\ShoppingListNote\Persistence\Base\SpyShoppingListItemNote as BaseSpyShoppingListItemNote;
use Orm\Zed\ShoppingListNote\Persistence\Map\SpyShoppingListItemNoteTableMap;
use Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOption;
use Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOptionQuery;
use Orm\Zed\ShoppingListProductOptionConnector\Persistence\Base\SpyShoppingListProductOption as BaseSpyShoppingListProductOption;
use Orm\Zed\ShoppingListProductOptionConnector\Persistence\Map\SpyShoppingListProductOptionTableMap;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingList as ChildSpyShoppingList;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingListItem as ChildSpyShoppingListItem;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingListItemQuery as ChildSpyShoppingListItemQuery;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingListQuery as ChildSpyShoppingListQuery;
use Orm\Zed\ShoppingList\Persistence\Map\SpyShoppingListItemTableMap;
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
 * Base class that represents a row from the 'spy_shopping_list_item' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.ShoppingList.Persistence.Base
 */
abstract class SpyShoppingListItem implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\ShoppingList\\Persistence\\Map\\SpyShoppingListItemTableMap';


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
     * The value for the id_shopping_list_item field.
     *
     * @var        int
     */
    protected $id_shopping_list_item;

    /**
     * The value for the fk_shopping_list field.
     *
     * @var        int
     */
    protected $fk_shopping_list;

    /**
     * The value for the key field.
     * A unique key used to identify an entity or a piece of data.
     * @var        string|null
     */
    protected $key;

    /**
     * The value for the product_configuration_instance_data field.
     * The data for a product configuration instance.
     * @var        string|null
     */
    protected $product_configuration_instance_data;

    /**
     * The value for the product_offer_reference field.
     * A unique reference identifier for a specific product offer from a merchant.
     * @var        string|null
     */
    protected $product_offer_reference;

    /**
     * The value for the quantity field.
     * The number of units for an item.
     * Note: this column has a database default value of: 1
     * @var        int
     */
    protected $quantity;

    /**
     * The value for the sku field.
     * The Stock Keeping Unit, a unique identifier for a concrete product.
     * @var        string|null
     */
    protected $sku;

    /**
     * The value for the uuid field.
     * A Universally Unique Identifier for an entity.
     * @var        string|null
     */
    protected $uuid;

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
     * @var        ChildSpyShoppingList
     */
    protected $aSpyShoppingList;

    /**
     * @var        ObjectCollection|SpyShoppingListItemNote[] Collection to store aggregation of SpyShoppingListItemNote objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyShoppingListItemNote> Collection to store aggregation of SpyShoppingListItemNote objects.
     */
    protected $collSpyShoppingListItemNotes;
    protected $collSpyShoppingListItemNotesPartial;

    /**
     * @var        ObjectCollection|SpyShoppingListProductOption[] Collection to store aggregation of SpyShoppingListProductOption objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyShoppingListProductOption> Collection to store aggregation of SpyShoppingListProductOption objects.
     */
    protected $collSpyShoppingListProductOptions;
    protected $collSpyShoppingListProductOptionsPartial;

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

    // event behavior

    /**
     * @var string
     */
    private $_eventName;

    /**
     * @var bool
     */
    private $_isModified;

    /**
     * @var array
     */
    private $_modifiedColumns;

    /**
     * @var array
     */
    private $_initialValues;

    /**
     * @var bool
     */
    private $_isEventDisabled;

    /**
     * @var array
     */
    private $_foreignKeys = [
        'spy_shopping_list_item.fk_shopping_list' => 'fk_shopping_list',
    ];

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyShoppingListItemNote[]
     * @phpstan-var ObjectCollection&\Traversable<SpyShoppingListItemNote>
     */
    protected $spyShoppingListItemNotesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyShoppingListProductOption[]
     * @phpstan-var ObjectCollection&\Traversable<SpyShoppingListProductOption>
     */
    protected $spyShoppingListProductOptionsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->quantity = 1;
    }

    /**
     * Initializes internal state of Orm\Zed\ShoppingList\Persistence\Base\SpyShoppingListItem object.
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
     * Compares this with another <code>SpyShoppingListItem</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyShoppingListItem</code>, delegates to
     * <code>equals(SpyShoppingListItem)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_shopping_list_item] column value.
     *
     * @return int
     */
    public function getIdShoppingListItem()
    {
        return $this->id_shopping_list_item;
    }

    /**
     * Get the [fk_shopping_list] column value.
     *
     * @return int
     */
    public function getFkShoppingList()
    {
        return $this->fk_shopping_list;
    }

    /**
     * Get the [key] column value.
     * A unique key used to identify an entity or a piece of data.
     * @return string|null
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Get the [product_configuration_instance_data] column value.
     * The data for a product configuration instance.
     * @return string|null
     */
    public function getProductConfigurationInstanceData()
    {
        return $this->product_configuration_instance_data;
    }

    /**
     * Get the [product_offer_reference] column value.
     * A unique reference identifier for a specific product offer from a merchant.
     * @return string|null
     */
    public function getProductOfferReference()
    {
        return $this->product_offer_reference;
    }

    /**
     * Get the [quantity] column value.
     * The number of units for an item.
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Get the [sku] column value.
     * The Stock Keeping Unit, a unique identifier for a concrete product.
     * @return string|null
     */
    public function getSku()
    {
        return $this->sku;
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
     * Set the value of [id_shopping_list_item] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdShoppingListItem($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_shopping_list_item !== $v) {
            $this->id_shopping_list_item = $v;
            $this->modifiedColumns[SpyShoppingListItemTableMap::COL_ID_SHOPPING_LIST_ITEM] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_shopping_list] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkShoppingList($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_shopping_list !== $v) {
            $this->fk_shopping_list = $v;
            $this->modifiedColumns[SpyShoppingListItemTableMap::COL_FK_SHOPPING_LIST] = true;
        }

        if ($this->aSpyShoppingList !== null && $this->aSpyShoppingList->getIdShoppingList() !== $v) {
            $this->aSpyShoppingList = null;
        }

        return $this;
    }

    /**
     * Set the value of [key] column.
     * A unique key used to identify an entity or a piece of data.
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
            $this->modifiedColumns[SpyShoppingListItemTableMap::COL_KEY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [product_configuration_instance_data] column.
     * The data for a product configuration instance.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProductConfigurationInstanceData($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->product_configuration_instance_data !== $v) {
            $this->product_configuration_instance_data = $v;
            $this->modifiedColumns[SpyShoppingListItemTableMap::COL_PRODUCT_CONFIGURATION_INSTANCE_DATA] = true;
        }

        return $this;
    }

    /**
     * Set the value of [product_offer_reference] column.
     * A unique reference identifier for a specific product offer from a merchant.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProductOfferReference($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->product_offer_reference !== $v) {
            $this->product_offer_reference = $v;
            $this->modifiedColumns[SpyShoppingListItemTableMap::COL_PRODUCT_OFFER_REFERENCE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [quantity] column.
     * The number of units for an item.
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setQuantity($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = true;

        if (($this->isNew() && $hasDefaultValue) || $this->quantity !== $v) {
            $this->quantity = $v;
            $this->modifiedColumns[SpyShoppingListItemTableMap::COL_QUANTITY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sku] column.
     * The Stock Keeping Unit, a unique identifier for a concrete product.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSku($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->sku !== $v) {
            $this->sku = $v;
            $this->modifiedColumns[SpyShoppingListItemTableMap::COL_SKU] = true;
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
            $this->modifiedColumns[SpyShoppingListItemTableMap::COL_UUID] = true;
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
                $this->modifiedColumns[SpyShoppingListItemTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SpyShoppingListItemTableMap::COL_UPDATED_AT] = true;
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
            if ($this->quantity !== 1) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyShoppingListItemTableMap::translateFieldName('IdShoppingListItem', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_shopping_list_item = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyShoppingListItemTableMap::translateFieldName('FkShoppingList', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_shopping_list = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyShoppingListItemTableMap::translateFieldName('Key', TableMap::TYPE_PHPNAME, $indexType)];
            $this->key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyShoppingListItemTableMap::translateFieldName('ProductConfigurationInstanceData', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_configuration_instance_data = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyShoppingListItemTableMap::translateFieldName('ProductOfferReference', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_offer_reference = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyShoppingListItemTableMap::translateFieldName('Quantity', TableMap::TYPE_PHPNAME, $indexType)];
            $this->quantity = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpyShoppingListItemTableMap::translateFieldName('Sku', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sku = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpyShoppingListItemTableMap::translateFieldName('Uuid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->uuid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SpyShoppingListItemTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SpyShoppingListItemTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = SpyShoppingListItemTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\ShoppingList\\Persistence\\SpyShoppingListItem'), 0, $e);
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
        if ($this->aSpyShoppingList !== null && $this->fk_shopping_list !== $this->aSpyShoppingList->getIdShoppingList()) {
            $this->aSpyShoppingList = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyShoppingListItemTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyShoppingListItemQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aSpyShoppingList = null;
            $this->collSpyShoppingListItemNotes = null;

            $this->collSpyShoppingListProductOptions = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyShoppingListItem::setDeleted()
     * @see SpyShoppingListItem::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyShoppingListItemTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyShoppingListItemQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                // event behavior

                $this->addDeleteEventToMemory();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyShoppingListItemTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            // event behavior

            $this->prepareSaveEventName();

            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                $time = time();
                $highPrecision = \Propel\Runtime\Util\PropelDateTime::createHighPrecision();
                if (!$this->isColumnModified(SpyShoppingListItemTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpyShoppingListItemTableMap::COL_UPDATED_AT)) {
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
                if ($this->isModified() && !$this->isColumnModified(SpyShoppingListItemTableMap::COL_UPDATED_AT)) {
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
                // event behavior

                if ($affectedRows) {
                    $this->addSaveEventToMemory();
                }

                SpyShoppingListItemTableMap::addInstanceToPool($this);
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

            if ($this->aSpyShoppingList !== null) {
                if ($this->aSpyShoppingList->isModified() || $this->aSpyShoppingList->isNew()) {
                    $affectedRows += $this->aSpyShoppingList->save($con);
                }
                $this->setSpyShoppingList($this->aSpyShoppingList);
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

            if ($this->spyShoppingListItemNotesScheduledForDeletion !== null) {
                if (!$this->spyShoppingListItemNotesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ShoppingListNote\Persistence\SpyShoppingListItemNoteQuery::create()
                        ->filterByPrimaryKeys($this->spyShoppingListItemNotesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyShoppingListItemNotesScheduledForDeletion = null;
                }
            }

            if ($this->collSpyShoppingListItemNotes !== null) {
                foreach ($this->collSpyShoppingListItemNotes as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyShoppingListProductOptionsScheduledForDeletion !== null) {
                if (!$this->spyShoppingListProductOptionsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOptionQuery::create()
                        ->filterByPrimaryKeys($this->spyShoppingListProductOptionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyShoppingListProductOptionsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyShoppingListProductOptions !== null) {
                foreach ($this->collSpyShoppingListProductOptions as $referrerFK) {
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

        $this->modifiedColumns[SpyShoppingListItemTableMap::COL_ID_SHOPPING_LIST_ITEM] = true;
        if (null !== $this->id_shopping_list_item) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyShoppingListItemTableMap::COL_ID_SHOPPING_LIST_ITEM . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyShoppingListItemTableMap::COL_ID_SHOPPING_LIST_ITEM)) {
            $modifiedColumns[':p' . $index++]  = '`id_shopping_list_item`';
        }
        if ($this->isColumnModified(SpyShoppingListItemTableMap::COL_FK_SHOPPING_LIST)) {
            $modifiedColumns[':p' . $index++]  = '`fk_shopping_list`';
        }
        if ($this->isColumnModified(SpyShoppingListItemTableMap::COL_KEY)) {
            $modifiedColumns[':p' . $index++]  = '`key`';
        }
        if ($this->isColumnModified(SpyShoppingListItemTableMap::COL_PRODUCT_CONFIGURATION_INSTANCE_DATA)) {
            $modifiedColumns[':p' . $index++]  = '`product_configuration_instance_data`';
        }
        if ($this->isColumnModified(SpyShoppingListItemTableMap::COL_PRODUCT_OFFER_REFERENCE)) {
            $modifiedColumns[':p' . $index++]  = '`product_offer_reference`';
        }
        if ($this->isColumnModified(SpyShoppingListItemTableMap::COL_QUANTITY)) {
            $modifiedColumns[':p' . $index++]  = '`quantity`';
        }
        if ($this->isColumnModified(SpyShoppingListItemTableMap::COL_SKU)) {
            $modifiedColumns[':p' . $index++]  = '`sku`';
        }
        if ($this->isColumnModified(SpyShoppingListItemTableMap::COL_UUID)) {
            $modifiedColumns[':p' . $index++]  = '`uuid`';
        }
        if ($this->isColumnModified(SpyShoppingListItemTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(SpyShoppingListItemTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }

        $sql = sprintf(
            'INSERT INTO `spy_shopping_list_item` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id_shopping_list_item`':
                        $stmt->bindValue($identifier, $this->id_shopping_list_item, PDO::PARAM_INT);

                        break;
                    case '`fk_shopping_list`':
                        $stmt->bindValue($identifier, $this->fk_shopping_list, PDO::PARAM_INT);

                        break;
                    case '`key`':
                        $stmt->bindValue($identifier, $this->key, PDO::PARAM_STR);

                        break;
                    case '`product_configuration_instance_data`':
                        $stmt->bindValue($identifier, $this->product_configuration_instance_data, PDO::PARAM_STR);

                        break;
                    case '`product_offer_reference`':
                        $stmt->bindValue($identifier, $this->product_offer_reference, PDO::PARAM_STR);

                        break;
                    case '`quantity`':
                        $stmt->bindValue($identifier, $this->quantity, PDO::PARAM_INT);

                        break;
                    case '`sku`':
                        $stmt->bindValue($identifier, $this->sku, PDO::PARAM_STR);

                        break;
                    case '`uuid`':
                        $stmt->bindValue($identifier, $this->uuid, PDO::PARAM_STR);

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
            $pk = $con->lastInsertId('spy_shopping_list_item_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdShoppingListItem($pk);

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
        $pos = SpyShoppingListItemTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdShoppingListItem();

            case 1:
                return $this->getFkShoppingList();

            case 2:
                return $this->getKey();

            case 3:
                return $this->getProductConfigurationInstanceData();

            case 4:
                return $this->getProductOfferReference();

            case 5:
                return $this->getQuantity();

            case 6:
                return $this->getSku();

            case 7:
                return $this->getUuid();

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
        if (isset($alreadyDumpedObjects['SpyShoppingListItem'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyShoppingListItem'][$this->hashCode()] = true;
        $keys = SpyShoppingListItemTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdShoppingListItem(),
            $keys[1] => $this->getFkShoppingList(),
            $keys[2] => $this->getKey(),
            $keys[3] => $this->getProductConfigurationInstanceData(),
            $keys[4] => $this->getProductOfferReference(),
            $keys[5] => $this->getQuantity(),
            $keys[6] => $this->getSku(),
            $keys[7] => $this->getUuid(),
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
            if (null !== $this->aSpyShoppingList) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyShoppingList';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_shopping_list';
                        break;
                    default:
                        $key = 'SpyShoppingList';
                }

                $result[$key] = $this->aSpyShoppingList->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collSpyShoppingListItemNotes) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyShoppingListItemNotes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_shopping_list_item_notes';
                        break;
                    default:
                        $key = 'SpyShoppingListItemNotes';
                }

                $result[$key] = $this->collSpyShoppingListItemNotes->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyShoppingListProductOptions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyShoppingListProductOptions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_shopping_list_product_options';
                        break;
                    default:
                        $key = 'SpyShoppingListProductOptions';
                }

                $result[$key] = $this->collSpyShoppingListProductOptions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyShoppingListItemTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdShoppingListItem($value);
                break;
            case 1:
                $this->setFkShoppingList($value);
                break;
            case 2:
                $this->setKey($value);
                break;
            case 3:
                $this->setProductConfigurationInstanceData($value);
                break;
            case 4:
                $this->setProductOfferReference($value);
                break;
            case 5:
                $this->setQuantity($value);
                break;
            case 6:
                $this->setSku($value);
                break;
            case 7:
                $this->setUuid($value);
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
        $keys = SpyShoppingListItemTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdShoppingListItem($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkShoppingList($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setKey($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setProductConfigurationInstanceData($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setProductOfferReference($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setQuantity($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setSku($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setUuid($arr[$keys[7]]);
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
        $criteria = new Criteria(SpyShoppingListItemTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyShoppingListItemTableMap::COL_ID_SHOPPING_LIST_ITEM)) {
            $criteria->add(SpyShoppingListItemTableMap::COL_ID_SHOPPING_LIST_ITEM, $this->id_shopping_list_item);
        }
        if ($this->isColumnModified(SpyShoppingListItemTableMap::COL_FK_SHOPPING_LIST)) {
            $criteria->add(SpyShoppingListItemTableMap::COL_FK_SHOPPING_LIST, $this->fk_shopping_list);
        }
        if ($this->isColumnModified(SpyShoppingListItemTableMap::COL_KEY)) {
            $criteria->add(SpyShoppingListItemTableMap::COL_KEY, $this->key);
        }
        if ($this->isColumnModified(SpyShoppingListItemTableMap::COL_PRODUCT_CONFIGURATION_INSTANCE_DATA)) {
            $criteria->add(SpyShoppingListItemTableMap::COL_PRODUCT_CONFIGURATION_INSTANCE_DATA, $this->product_configuration_instance_data);
        }
        if ($this->isColumnModified(SpyShoppingListItemTableMap::COL_PRODUCT_OFFER_REFERENCE)) {
            $criteria->add(SpyShoppingListItemTableMap::COL_PRODUCT_OFFER_REFERENCE, $this->product_offer_reference);
        }
        if ($this->isColumnModified(SpyShoppingListItemTableMap::COL_QUANTITY)) {
            $criteria->add(SpyShoppingListItemTableMap::COL_QUANTITY, $this->quantity);
        }
        if ($this->isColumnModified(SpyShoppingListItemTableMap::COL_SKU)) {
            $criteria->add(SpyShoppingListItemTableMap::COL_SKU, $this->sku);
        }
        if ($this->isColumnModified(SpyShoppingListItemTableMap::COL_UUID)) {
            $criteria->add(SpyShoppingListItemTableMap::COL_UUID, $this->uuid);
        }
        if ($this->isColumnModified(SpyShoppingListItemTableMap::COL_CREATED_AT)) {
            $criteria->add(SpyShoppingListItemTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpyShoppingListItemTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpyShoppingListItemTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildSpyShoppingListItemQuery::create();
        $criteria->add(SpyShoppingListItemTableMap::COL_ID_SHOPPING_LIST_ITEM, $this->id_shopping_list_item);

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
        $validPk = null !== $this->getIdShoppingListItem();

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
        return $this->getIdShoppingListItem();
    }

    /**
     * Generic method to set the primary key (id_shopping_list_item column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdShoppingListItem($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdShoppingListItem();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\ShoppingList\Persistence\SpyShoppingListItem (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkShoppingList($this->getFkShoppingList());
        $copyObj->setKey($this->getKey());
        $copyObj->setProductConfigurationInstanceData($this->getProductConfigurationInstanceData());
        $copyObj->setProductOfferReference($this->getProductOfferReference());
        $copyObj->setQuantity($this->getQuantity());
        $copyObj->setSku($this->getSku());
        $copyObj->setUuid($this->getUuid());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyShoppingListItemNotes() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyShoppingListItemNote($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyShoppingListProductOptions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyShoppingListProductOption($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdShoppingListItem(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\ShoppingList\Persistence\SpyShoppingListItem Clone of current object.
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
     * Declares an association between this object and a ChildSpyShoppingList object.
     *
     * @param ChildSpyShoppingList $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setSpyShoppingList(ChildSpyShoppingList $v = null)
    {
        if ($v === null) {
            $this->setFkShoppingList(NULL);
        } else {
            $this->setFkShoppingList($v->getIdShoppingList());
        }

        $this->aSpyShoppingList = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpyShoppingList object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyShoppingListItem($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpyShoppingList object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSpyShoppingList The associated ChildSpyShoppingList object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyShoppingList(?ConnectionInterface $con = null)
    {
        if ($this->aSpyShoppingList === null && ($this->fk_shopping_list != 0)) {
            $this->aSpyShoppingList = ChildSpyShoppingListQuery::create()->findPk($this->fk_shopping_list, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSpyShoppingList->addSpyShoppingListItems($this);
             */
        }

        return $this->aSpyShoppingList;
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
        if ('SpyShoppingListItemNote' === $relationName) {
            $this->initSpyShoppingListItemNotes();
            return;
        }
        if ('SpyShoppingListProductOption' === $relationName) {
            $this->initSpyShoppingListProductOptions();
            return;
        }
    }

    /**
     * Clears out the collSpyShoppingListItemNotes collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyShoppingListItemNotes()
     */
    public function clearSpyShoppingListItemNotes()
    {
        $this->collSpyShoppingListItemNotes = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyShoppingListItemNotes collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyShoppingListItemNotes($v = true): void
    {
        $this->collSpyShoppingListItemNotesPartial = $v;
    }

    /**
     * Initializes the collSpyShoppingListItemNotes collection.
     *
     * By default this just sets the collSpyShoppingListItemNotes collection to an empty array (like clearcollSpyShoppingListItemNotes());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyShoppingListItemNotes(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyShoppingListItemNotes && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyShoppingListItemNoteTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyShoppingListItemNotes = new $collectionClassName;
        $this->collSpyShoppingListItemNotes->setModel('\Orm\Zed\ShoppingListNote\Persistence\SpyShoppingListItemNote');
    }

    /**
     * Gets an array of SpyShoppingListItemNote objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyShoppingListItem is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyShoppingListItemNote[] List of SpyShoppingListItemNote objects
     * @phpstan-return ObjectCollection&\Traversable<SpyShoppingListItemNote> List of SpyShoppingListItemNote objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyShoppingListItemNotes(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyShoppingListItemNotesPartial && !$this->isNew();
        if (null === $this->collSpyShoppingListItemNotes || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyShoppingListItemNotes) {
                    $this->initSpyShoppingListItemNotes();
                } else {
                    $collectionClassName = SpyShoppingListItemNoteTableMap::getTableMap()->getCollectionClassName();

                    $collSpyShoppingListItemNotes = new $collectionClassName;
                    $collSpyShoppingListItemNotes->setModel('\Orm\Zed\ShoppingListNote\Persistence\SpyShoppingListItemNote');

                    return $collSpyShoppingListItemNotes;
                }
            } else {
                $collSpyShoppingListItemNotes = SpyShoppingListItemNoteQuery::create(null, $criteria)
                    ->filterBySpyShoppingListItem($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyShoppingListItemNotesPartial && count($collSpyShoppingListItemNotes)) {
                        $this->initSpyShoppingListItemNotes(false);

                        foreach ($collSpyShoppingListItemNotes as $obj) {
                            if (false == $this->collSpyShoppingListItemNotes->contains($obj)) {
                                $this->collSpyShoppingListItemNotes->append($obj);
                            }
                        }

                        $this->collSpyShoppingListItemNotesPartial = true;
                    }

                    return $collSpyShoppingListItemNotes;
                }

                if ($partial && $this->collSpyShoppingListItemNotes) {
                    foreach ($this->collSpyShoppingListItemNotes as $obj) {
                        if ($obj->isNew()) {
                            $collSpyShoppingListItemNotes[] = $obj;
                        }
                    }
                }

                $this->collSpyShoppingListItemNotes = $collSpyShoppingListItemNotes;
                $this->collSpyShoppingListItemNotesPartial = false;
            }
        }

        return $this->collSpyShoppingListItemNotes;
    }

    /**
     * Sets a collection of SpyShoppingListItemNote objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyShoppingListItemNotes A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyShoppingListItemNotes(Collection $spyShoppingListItemNotes, ?ConnectionInterface $con = null)
    {
        /** @var SpyShoppingListItemNote[] $spyShoppingListItemNotesToDelete */
        $spyShoppingListItemNotesToDelete = $this->getSpyShoppingListItemNotes(new Criteria(), $con)->diff($spyShoppingListItemNotes);


        $this->spyShoppingListItemNotesScheduledForDeletion = $spyShoppingListItemNotesToDelete;

        foreach ($spyShoppingListItemNotesToDelete as $spyShoppingListItemNoteRemoved) {
            $spyShoppingListItemNoteRemoved->setSpyShoppingListItem(null);
        }

        $this->collSpyShoppingListItemNotes = null;
        foreach ($spyShoppingListItemNotes as $spyShoppingListItemNote) {
            $this->addSpyShoppingListItemNote($spyShoppingListItemNote);
        }

        $this->collSpyShoppingListItemNotes = $spyShoppingListItemNotes;
        $this->collSpyShoppingListItemNotesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyShoppingListItemNote objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyShoppingListItemNote objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyShoppingListItemNotes(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyShoppingListItemNotesPartial && !$this->isNew();
        if (null === $this->collSpyShoppingListItemNotes || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyShoppingListItemNotes) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyShoppingListItemNotes());
            }

            $query = SpyShoppingListItemNoteQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyShoppingListItem($this)
                ->count($con);
        }

        return count($this->collSpyShoppingListItemNotes);
    }

    /**
     * Method called to associate a SpyShoppingListItemNote object to this object
     * through the SpyShoppingListItemNote foreign key attribute.
     *
     * @param SpyShoppingListItemNote $l SpyShoppingListItemNote
     * @return $this The current object (for fluent API support)
     */
    public function addSpyShoppingListItemNote(SpyShoppingListItemNote $l)
    {
        if ($this->collSpyShoppingListItemNotes === null) {
            $this->initSpyShoppingListItemNotes();
            $this->collSpyShoppingListItemNotesPartial = true;
        }

        if (!$this->collSpyShoppingListItemNotes->contains($l)) {
            $this->doAddSpyShoppingListItemNote($l);

            if ($this->spyShoppingListItemNotesScheduledForDeletion and $this->spyShoppingListItemNotesScheduledForDeletion->contains($l)) {
                $this->spyShoppingListItemNotesScheduledForDeletion->remove($this->spyShoppingListItemNotesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyShoppingListItemNote $spyShoppingListItemNote The SpyShoppingListItemNote object to add.
     */
    protected function doAddSpyShoppingListItemNote(SpyShoppingListItemNote $spyShoppingListItemNote): void
    {
        $this->collSpyShoppingListItemNotes[]= $spyShoppingListItemNote;
        $spyShoppingListItemNote->setSpyShoppingListItem($this);
    }

    /**
     * @param SpyShoppingListItemNote $spyShoppingListItemNote The SpyShoppingListItemNote object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyShoppingListItemNote(SpyShoppingListItemNote $spyShoppingListItemNote)
    {
        if ($this->getSpyShoppingListItemNotes()->contains($spyShoppingListItemNote)) {
            $pos = $this->collSpyShoppingListItemNotes->search($spyShoppingListItemNote);
            $this->collSpyShoppingListItemNotes->remove($pos);
            if (null === $this->spyShoppingListItemNotesScheduledForDeletion) {
                $this->spyShoppingListItemNotesScheduledForDeletion = clone $this->collSpyShoppingListItemNotes;
                $this->spyShoppingListItemNotesScheduledForDeletion->clear();
            }
            $this->spyShoppingListItemNotesScheduledForDeletion[]= clone $spyShoppingListItemNote;
            $spyShoppingListItemNote->setSpyShoppingListItem(null);
        }

        return $this;
    }

    /**
     * Clears out the collSpyShoppingListProductOptions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyShoppingListProductOptions()
     */
    public function clearSpyShoppingListProductOptions()
    {
        $this->collSpyShoppingListProductOptions = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyShoppingListProductOptions collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyShoppingListProductOptions($v = true): void
    {
        $this->collSpyShoppingListProductOptionsPartial = $v;
    }

    /**
     * Initializes the collSpyShoppingListProductOptions collection.
     *
     * By default this just sets the collSpyShoppingListProductOptions collection to an empty array (like clearcollSpyShoppingListProductOptions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyShoppingListProductOptions(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyShoppingListProductOptions && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyShoppingListProductOptionTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyShoppingListProductOptions = new $collectionClassName;
        $this->collSpyShoppingListProductOptions->setModel('\Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOption');
    }

    /**
     * Gets an array of SpyShoppingListProductOption objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyShoppingListItem is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyShoppingListProductOption[] List of SpyShoppingListProductOption objects
     * @phpstan-return ObjectCollection&\Traversable<SpyShoppingListProductOption> List of SpyShoppingListProductOption objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyShoppingListProductOptions(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyShoppingListProductOptionsPartial && !$this->isNew();
        if (null === $this->collSpyShoppingListProductOptions || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyShoppingListProductOptions) {
                    $this->initSpyShoppingListProductOptions();
                } else {
                    $collectionClassName = SpyShoppingListProductOptionTableMap::getTableMap()->getCollectionClassName();

                    $collSpyShoppingListProductOptions = new $collectionClassName;
                    $collSpyShoppingListProductOptions->setModel('\Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOption');

                    return $collSpyShoppingListProductOptions;
                }
            } else {
                $collSpyShoppingListProductOptions = SpyShoppingListProductOptionQuery::create(null, $criteria)
                    ->filterBySpyShoppingListItem($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyShoppingListProductOptionsPartial && count($collSpyShoppingListProductOptions)) {
                        $this->initSpyShoppingListProductOptions(false);

                        foreach ($collSpyShoppingListProductOptions as $obj) {
                            if (false == $this->collSpyShoppingListProductOptions->contains($obj)) {
                                $this->collSpyShoppingListProductOptions->append($obj);
                            }
                        }

                        $this->collSpyShoppingListProductOptionsPartial = true;
                    }

                    return $collSpyShoppingListProductOptions;
                }

                if ($partial && $this->collSpyShoppingListProductOptions) {
                    foreach ($this->collSpyShoppingListProductOptions as $obj) {
                        if ($obj->isNew()) {
                            $collSpyShoppingListProductOptions[] = $obj;
                        }
                    }
                }

                $this->collSpyShoppingListProductOptions = $collSpyShoppingListProductOptions;
                $this->collSpyShoppingListProductOptionsPartial = false;
            }
        }

        return $this->collSpyShoppingListProductOptions;
    }

    /**
     * Sets a collection of SpyShoppingListProductOption objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyShoppingListProductOptions A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyShoppingListProductOptions(Collection $spyShoppingListProductOptions, ?ConnectionInterface $con = null)
    {
        /** @var SpyShoppingListProductOption[] $spyShoppingListProductOptionsToDelete */
        $spyShoppingListProductOptionsToDelete = $this->getSpyShoppingListProductOptions(new Criteria(), $con)->diff($spyShoppingListProductOptions);


        $this->spyShoppingListProductOptionsScheduledForDeletion = $spyShoppingListProductOptionsToDelete;

        foreach ($spyShoppingListProductOptionsToDelete as $spyShoppingListProductOptionRemoved) {
            $spyShoppingListProductOptionRemoved->setSpyShoppingListItem(null);
        }

        $this->collSpyShoppingListProductOptions = null;
        foreach ($spyShoppingListProductOptions as $spyShoppingListProductOption) {
            $this->addSpyShoppingListProductOption($spyShoppingListProductOption);
        }

        $this->collSpyShoppingListProductOptions = $spyShoppingListProductOptions;
        $this->collSpyShoppingListProductOptionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyShoppingListProductOption objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyShoppingListProductOption objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyShoppingListProductOptions(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyShoppingListProductOptionsPartial && !$this->isNew();
        if (null === $this->collSpyShoppingListProductOptions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyShoppingListProductOptions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyShoppingListProductOptions());
            }

            $query = SpyShoppingListProductOptionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyShoppingListItem($this)
                ->count($con);
        }

        return count($this->collSpyShoppingListProductOptions);
    }

    /**
     * Method called to associate a SpyShoppingListProductOption object to this object
     * through the SpyShoppingListProductOption foreign key attribute.
     *
     * @param SpyShoppingListProductOption $l SpyShoppingListProductOption
     * @return $this The current object (for fluent API support)
     */
    public function addSpyShoppingListProductOption(SpyShoppingListProductOption $l)
    {
        if ($this->collSpyShoppingListProductOptions === null) {
            $this->initSpyShoppingListProductOptions();
            $this->collSpyShoppingListProductOptionsPartial = true;
        }

        if (!$this->collSpyShoppingListProductOptions->contains($l)) {
            $this->doAddSpyShoppingListProductOption($l);

            if ($this->spyShoppingListProductOptionsScheduledForDeletion and $this->spyShoppingListProductOptionsScheduledForDeletion->contains($l)) {
                $this->spyShoppingListProductOptionsScheduledForDeletion->remove($this->spyShoppingListProductOptionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyShoppingListProductOption $spyShoppingListProductOption The SpyShoppingListProductOption object to add.
     */
    protected function doAddSpyShoppingListProductOption(SpyShoppingListProductOption $spyShoppingListProductOption): void
    {
        $this->collSpyShoppingListProductOptions[]= $spyShoppingListProductOption;
        $spyShoppingListProductOption->setSpyShoppingListItem($this);
    }

    /**
     * @param SpyShoppingListProductOption $spyShoppingListProductOption The SpyShoppingListProductOption object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyShoppingListProductOption(SpyShoppingListProductOption $spyShoppingListProductOption)
    {
        if ($this->getSpyShoppingListProductOptions()->contains($spyShoppingListProductOption)) {
            $pos = $this->collSpyShoppingListProductOptions->search($spyShoppingListProductOption);
            $this->collSpyShoppingListProductOptions->remove($pos);
            if (null === $this->spyShoppingListProductOptionsScheduledForDeletion) {
                $this->spyShoppingListProductOptionsScheduledForDeletion = clone $this->collSpyShoppingListProductOptions;
                $this->spyShoppingListProductOptionsScheduledForDeletion->clear();
            }
            $this->spyShoppingListProductOptionsScheduledForDeletion[]= clone $spyShoppingListProductOption;
            $spyShoppingListProductOption->setSpyShoppingListItem(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyShoppingListItem is new, it will return
     * an empty collection; or if this SpyShoppingListItem has previously
     * been saved, it will retrieve related SpyShoppingListProductOptions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyShoppingListItem.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyShoppingListProductOption[] List of SpyShoppingListProductOption objects
     * @phpstan-return ObjectCollection&\Traversable<SpyShoppingListProductOption}> List of SpyShoppingListProductOption objects
     */
    public function getSpyShoppingListProductOptionsJoinSpyProductOptionValue(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyShoppingListProductOptionQuery::create(null, $criteria);
        $query->joinWith('SpyProductOptionValue', $joinBehavior);

        return $this->getSpyShoppingListProductOptions($query, $con);
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
        if (null !== $this->aSpyShoppingList) {
            $this->aSpyShoppingList->removeSpyShoppingListItem($this);
        }
        $this->id_shopping_list_item = null;
        $this->fk_shopping_list = null;
        $this->key = null;
        $this->product_configuration_instance_data = null;
        $this->product_offer_reference = null;
        $this->quantity = null;
        $this->sku = null;
        $this->uuid = null;
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
            if ($this->collSpyShoppingListItemNotes) {
                foreach ($this->collSpyShoppingListItemNotes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyShoppingListProductOptions) {
                foreach ($this->collSpyShoppingListProductOptions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyShoppingListItemNotes = null;
        $this->collSpyShoppingListProductOptions = null;
        $this->aSpyShoppingList = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyShoppingListItemTableMap::DEFAULT_STRING_FORMAT);
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
        $name = 'spy_shopping_list_item' . '.' . $this->getIdShoppingListItem() . '.' . $this->getFkShoppingList();
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
        $this->modifiedColumns[SpyShoppingListItemTableMap::COL_UPDATED_AT] = true;

        return $this;
    }

    // event behavior

    /**
     * @return void
     */
    protected function prepareSaveEventName()
    {
        if ($this->isNew()) {
            $this->_eventName = 'Entity.spy_shopping_list_item.create';
        } else {
            $this->_eventName = 'Entity.spy_shopping_list_item.update';
        }

        $this->_modifiedColumns = $this->getModifiedColumns();
        $this->_isModified = $this->isModified();
    }

    /**
     * @return void
     */
    public function disableEvent()
    {
        $this->_isEventDisabled = true;
    }

    /**
     * @return void
     */
    public function enableEvent()
    {
        $this->_isEventDisabled = false;
    }

    /**
     * @return void
     */
    protected function addSaveEventToMemory()
    {
        if ($this->_isEventDisabled) {
            return;
        }

        if ($this->_eventName !== 'Entity.spy_shopping_list_item.create') {
            if (!$this->_isModified) {
                return;
            }

            if (!$this->isEventColumnsModified()) {
                return;
            }
        }

        $data = [
            'name' => 'spy_shopping_list_item',
            'id' => !is_array($this->getPrimaryKey()) ? $this->getPrimaryKey() : null,
            'event' => $this->_eventName,
            'foreignKeys' => $this->getForeignKeys(),
            'modifiedColumns' => $this->_modifiedColumns,
            'originalValues' => $this->getOriginalValues(),
            'additionalValues' => $this->getAdditionalValues(),
        ];

        $this->saveEventBehaviorEntityChange($data);

        unset($this->_eventName);
        unset($this->_modifiedColumns);
        unset($this->_isModified);
    }

    /**
     * @return void
     */
    protected function addDeleteEventToMemory()
    {
        if ($this->_isEventDisabled) {
            return;
        }

        $data = [
            'name' => 'spy_shopping_list_item',
            'id' => !is_array($this->getPrimaryKey()) ? $this->getPrimaryKey() : null,
            'event' => 'Entity.spy_shopping_list_item.delete',
            'foreignKeys' => $this->getForeignKeys(),
            'additionalValues' => $this->getAdditionalValues(),
        ];

        $this->saveEventBehaviorEntityChange($data);
    }

    /**
     * @return array
     */
    protected function getForeignKeys()
    {
        $foreignKeysWithValue = [];
        foreach ($this->_foreignKeys as $key => $value) {
            $foreignKeysWithValue[$key] = $this->getByName($value);
        }

        return $foreignKeysWithValue;
    }

    /**
     * @param array $data
     *
     * @return void
     */
    protected function saveEventBehaviorEntityChange(array $data)
    {
        $encodedData = json_encode($data);
        $dataLength = strlen($encodedData);

        if ($dataLength > 256 * 1024) {
            $warningMessage = sprintf(
                '%s event message data size (%d KB) exceeds the allowable limit of %d KB. Please reduce the event message size or it might disrupt P&S process.',
                ($data['event'] ?? ''),
                $dataLength / 1024,
                256,
            );

            $this->log($warningMessage, \Propel\Runtime\Propel::LOG_WARNING);
        }

        $isInstancePoolingDisabledSuccessfully = \Propel\Runtime\Propel::disableInstancePooling();

        $spyEventBehaviorEntityChange = new \Orm\Zed\EventBehavior\Persistence\SpyEventBehaviorEntityChange();
        $spyEventBehaviorEntityChange->setData($encodedData);
        $spyEventBehaviorEntityChange->setProcessId(\Spryker\Zed\Kernel\RequestIdentifier::getRequestId());
        $spyEventBehaviorEntityChange->save();

        if ($isInstancePoolingDisabledSuccessfully) {
            \Propel\Runtime\Propel::enableInstancePooling();
        }
    }

    /**
     * @return bool
     */
    protected function isEventColumnsModified()
    {
        /* There is a wildcard(*) property for this event */
        return true;
    }

    /**
     * @return array
     */
    protected function getOriginalValueColumnNames(): array
    {
        return [

        ];
    }

    /**
     * @return array
     */
    protected function getOriginalValues(): array
    {
        if ($this->isNew()) {
            return [];
        }

        $originalValues = [];
        foreach ($this->_modifiedColumns as $modifiedColumn) {
            if (!in_array($modifiedColumn, $this->getOriginalValueColumnNames())) {
                continue;
            }

            $before = $this->_initialValues[$modifiedColumn];
            $field = str_replace('spy_shopping_list_item.', '', $modifiedColumn);
            $after = $this->$field;

            if ($before !== $after) {
                $originalValues[$modifiedColumn] = $before;
            }
        }

        return $originalValues;
    }

    /**
     * @return array
     */
    protected function getAdditionalValueColumnNames(): array
    {
        return [

        ];
    }

    /**
     * @return array
     */
    protected function getAdditionalValues(): array
    {
        $additionalValues = [];
        foreach ($this->getAdditionalValueColumnNames() as $additionalValueColumnName) {
            $field = str_replace('spy_shopping_list_item.', '', $additionalValueColumnName);
            $additionalValues[$additionalValueColumnName] = $this->$field;
        }

        return $additionalValues;
    }

    /**
     * @param string $xmlValue
     * @param string $column
     *
     * @return array|bool|\DateTime|float|int|object
     */
    protected function getPhpType($xmlValue, $column)
    {
        $columnType = SpyShoppingListItemTableMap::getTableMap()->getColumn($column)->getType();
        if (in_array(strtoupper($columnType), ['INTEGER', 'TINYINT', 'SMALLINT'])) {
            $xmlValue = (int) $xmlValue;
        } else if (in_array(strtoupper($columnType), ['REAL', 'FLOAT', 'DOUBLE', 'BINARY', 'VARBINARY', 'LONGVARBINARY'])) {
            $xmlValue = (double) $xmlValue;
        } else if (strtoupper($columnType) === 'ARRAY') {
            $xmlValue = (array) $xmlValue;
        } else if (strtoupper($columnType) === 'BOOLEAN') {
            $xmlValue = filter_var($xmlValue,  FILTER_VALIDATE_BOOLEAN);
        } else if (strtoupper($columnType) === 'OBJECT') {
            $xmlValue = (object) $xmlValue;
        } else if (in_array(strtoupper($columnType), ['DATE', 'TIME', 'TIMESTAMP', 'BU_DATE', 'BU_TIMESTAMP'])) {
            $xmlValue = \DateTime::createFromFormat('Y-m-d H:i:s', $xmlValue);
        }

        return $xmlValue;
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
