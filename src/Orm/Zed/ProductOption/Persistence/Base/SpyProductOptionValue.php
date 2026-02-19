<?php

namespace Orm\Zed\ProductOption\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\ProductOption\Persistence\SpyProductOptionGroup as ChildSpyProductOptionGroup;
use Orm\Zed\ProductOption\Persistence\SpyProductOptionGroupQuery as ChildSpyProductOptionGroupQuery;
use Orm\Zed\ProductOption\Persistence\SpyProductOptionValue as ChildSpyProductOptionValue;
use Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePrice as ChildSpyProductOptionValuePrice;
use Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePriceQuery as ChildSpyProductOptionValuePriceQuery;
use Orm\Zed\ProductOption\Persistence\SpyProductOptionValueQuery as ChildSpyProductOptionValueQuery;
use Orm\Zed\ProductOption\Persistence\Map\SpyProductOptionValuePriceTableMap;
use Orm\Zed\ProductOption\Persistence\Map\SpyProductOptionValueTableMap;
use Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOption;
use Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOptionQuery;
use Orm\Zed\ShoppingListProductOptionConnector\Persistence\Base\SpyShoppingListProductOption as BaseSpyShoppingListProductOption;
use Orm\Zed\ShoppingListProductOptionConnector\Persistence\Map\SpyShoppingListProductOptionTableMap;
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
 * Base class that represents a row from the 'spy_product_option_value' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.ProductOption.Persistence.Base
 */
abstract class SpyProductOptionValue implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\ProductOption\\Persistence\\Map\\SpyProductOptionValueTableMap';


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
     * The value for the id_product_option_value field.
     *
     * @var        int
     */
    protected $id_product_option_value;

    /**
     * The value for the fk_product_option_group field.
     *
     * @var        int
     */
    protected $fk_product_option_group;

    /**
     * The value for the price field.
     * Deprecated
     * @var        int|null
     */
    protected $price;

    /**
     * The value for the sku field.
     * The Stock Keeping Unit, a unique identifier for a concrete product.
     * @var        string
     */
    protected $sku;

    /**
     * The value for the value field.
     * A generic value for a property, often used in key-value pairs or translations.
     * @var        string
     */
    protected $value;

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
     * @var        ChildSpyProductOptionGroup
     */
    protected $aSpyProductOptionGroup;

    /**
     * @var        ObjectCollection|ChildSpyProductOptionValuePrice[] Collection to store aggregation of ChildSpyProductOptionValuePrice objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyProductOptionValuePrice> Collection to store aggregation of ChildSpyProductOptionValuePrice objects.
     */
    protected $collProductOptionValuePrices;
    protected $collProductOptionValuePricesPartial;

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
        'spy_product_option_value.fk_product_option_group' => 'fk_product_option_group',
    ];

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyProductOptionValuePrice[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyProductOptionValuePrice>
     */
    protected $productOptionValuePricesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyShoppingListProductOption[]
     * @phpstan-var ObjectCollection&\Traversable<SpyShoppingListProductOption>
     */
    protected $spyShoppingListProductOptionsScheduledForDeletion = null;

    /**
     * Initializes internal state of Orm\Zed\ProductOption\Persistence\Base\SpyProductOptionValue object.
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
     * Compares this with another <code>SpyProductOptionValue</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyProductOptionValue</code>, delegates to
     * <code>equals(SpyProductOptionValue)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_product_option_value] column value.
     *
     * @return int
     */
    public function getIdProductOptionValue()
    {
        return $this->id_product_option_value;
    }

    /**
     * Get the [fk_product_option_group] column value.
     *
     * @return int
     */
    public function getFkProductOptionGroup()
    {
        return $this->fk_product_option_group;
    }

    /**
     * Get the [price] column value.
     * Deprecated
     * @return int|null
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Get the [sku] column value.
     * The Stock Keeping Unit, a unique identifier for a concrete product.
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * Get the [value] column value.
     * A generic value for a property, often used in key-value pairs or translations.
     * @return string
     */
    public function getValue()
    {
        return $this->value;
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
     * Set the value of [id_product_option_value] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdProductOptionValue($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_product_option_value !== $v) {
            $this->id_product_option_value = $v;
            $this->modifiedColumns[SpyProductOptionValueTableMap::COL_ID_PRODUCT_OPTION_VALUE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_product_option_group] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkProductOptionGroup($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_product_option_group !== $v) {
            $this->fk_product_option_group = $v;
            $this->modifiedColumns[SpyProductOptionValueTableMap::COL_FK_PRODUCT_OPTION_GROUP] = true;
        }

        if ($this->aSpyProductOptionGroup !== null && $this->aSpyProductOptionGroup->getIdProductOptionGroup() !== $v) {
            $this->aSpyProductOptionGroup = null;
        }

        return $this;
    }

    /**
     * Set the value of [price] column.
     * Deprecated
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPrice($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->price !== $v) {
            $this->price = $v;
            $this->modifiedColumns[SpyProductOptionValueTableMap::COL_PRICE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sku] column.
     * The Stock Keeping Unit, a unique identifier for a concrete product.
     * @param string $v New value
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
            $this->modifiedColumns[SpyProductOptionValueTableMap::COL_SKU] = true;
        }

        return $this;
    }

    /**
     * Set the value of [value] column.
     * A generic value for a property, often used in key-value pairs or translations.
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setValue($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->value !== $v) {
            $this->value = $v;
            $this->modifiedColumns[SpyProductOptionValueTableMap::COL_VALUE] = true;
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
                $this->modifiedColumns[SpyProductOptionValueTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SpyProductOptionValueTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyProductOptionValueTableMap::translateFieldName('IdProductOptionValue', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_product_option_value = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyProductOptionValueTableMap::translateFieldName('FkProductOptionGroup', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_product_option_group = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyProductOptionValueTableMap::translateFieldName('Price', TableMap::TYPE_PHPNAME, $indexType)];
            $this->price = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyProductOptionValueTableMap::translateFieldName('Sku', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sku = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyProductOptionValueTableMap::translateFieldName('Value', TableMap::TYPE_PHPNAME, $indexType)];
            $this->value = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyProductOptionValueTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpyProductOptionValueTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 7; // 7 = SpyProductOptionValueTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\ProductOption\\Persistence\\SpyProductOptionValue'), 0, $e);
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
        if ($this->aSpyProductOptionGroup !== null && $this->fk_product_option_group !== $this->aSpyProductOptionGroup->getIdProductOptionGroup()) {
            $this->aSpyProductOptionGroup = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyProductOptionValueTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyProductOptionValueQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aSpyProductOptionGroup = null;
            $this->collProductOptionValuePrices = null;

            $this->collSpyShoppingListProductOptions = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyProductOptionValue::setDeleted()
     * @see SpyProductOptionValue::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductOptionValueTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyProductOptionValueQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductOptionValueTableMap::DATABASE_NAME);
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
                if (!$this->isColumnModified(SpyProductOptionValueTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpyProductOptionValueTableMap::COL_UPDATED_AT)) {
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
                if ($this->isModified() && !$this->isColumnModified(SpyProductOptionValueTableMap::COL_UPDATED_AT)) {
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
                // event behavior

                if ($affectedRows) {
                    $this->addSaveEventToMemory();
                }

                SpyProductOptionValueTableMap::addInstanceToPool($this);
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

            if ($this->aSpyProductOptionGroup !== null) {
                if ($this->aSpyProductOptionGroup->isModified() || $this->aSpyProductOptionGroup->isNew()) {
                    $affectedRows += $this->aSpyProductOptionGroup->save($con);
                }
                $this->setSpyProductOptionGroup($this->aSpyProductOptionGroup);
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

            if ($this->productOptionValuePricesScheduledForDeletion !== null) {
                if (!$this->productOptionValuePricesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePriceQuery::create()
                        ->filterByPrimaryKeys($this->productOptionValuePricesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->productOptionValuePricesScheduledForDeletion = null;
                }
            }

            if ($this->collProductOptionValuePrices !== null) {
                foreach ($this->collProductOptionValuePrices as $referrerFK) {
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

        $this->modifiedColumns[SpyProductOptionValueTableMap::COL_ID_PRODUCT_OPTION_VALUE] = true;

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyProductOptionValueTableMap::COL_ID_PRODUCT_OPTION_VALUE)) {
            $modifiedColumns[':p' . $index++]  = 'id_product_option_value';
        }
        if ($this->isColumnModified(SpyProductOptionValueTableMap::COL_FK_PRODUCT_OPTION_GROUP)) {
            $modifiedColumns[':p' . $index++]  = 'fk_product_option_group';
        }
        if ($this->isColumnModified(SpyProductOptionValueTableMap::COL_PRICE)) {
            $modifiedColumns[':p' . $index++]  = 'price';
        }
        if ($this->isColumnModified(SpyProductOptionValueTableMap::COL_SKU)) {
            $modifiedColumns[':p' . $index++]  = 'sku';
        }
        if ($this->isColumnModified(SpyProductOptionValueTableMap::COL_VALUE)) {
            $modifiedColumns[':p' . $index++]  = 'value';
        }
        if ($this->isColumnModified(SpyProductOptionValueTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(SpyProductOptionValueTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO spy_product_option_value (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_product_option_value':
                        $stmt->bindValue($identifier, $this->id_product_option_value, PDO::PARAM_INT);

                        break;
                    case 'fk_product_option_group':
                        $stmt->bindValue($identifier, $this->fk_product_option_group, PDO::PARAM_INT);

                        break;
                    case 'price':
                        $stmt->bindValue($identifier, $this->price, PDO::PARAM_INT);

                        break;
                    case 'sku':
                        $stmt->bindValue($identifier, $this->sku, PDO::PARAM_STR);

                        break;
                    case 'value':
                        $stmt->bindValue($identifier, $this->value, PDO::PARAM_STR);

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
            $pk = $con->lastInsertId('spy_product_option_value_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        if ($pk !== null) {
            $this->setIdProductOptionValue($pk);
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
        $pos = SpyProductOptionValueTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdProductOptionValue();

            case 1:
                return $this->getFkProductOptionGroup();

            case 2:
                return $this->getPrice();

            case 3:
                return $this->getSku();

            case 4:
                return $this->getValue();

            case 5:
                return $this->getCreatedAt();

            case 6:
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
        if (isset($alreadyDumpedObjects['SpyProductOptionValue'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyProductOptionValue'][$this->hashCode()] = true;
        $keys = SpyProductOptionValueTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdProductOptionValue(),
            $keys[1] => $this->getFkProductOptionGroup(),
            $keys[2] => $this->getPrice(),
            $keys[3] => $this->getSku(),
            $keys[4] => $this->getValue(),
            $keys[5] => $this->getCreatedAt(),
            $keys[6] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[5]] instanceof \DateTimeInterface) {
            $result[$keys[5]] = $result[$keys[5]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[6]] instanceof \DateTimeInterface) {
            $result[$keys[6]] = $result[$keys[6]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aSpyProductOptionGroup) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductOptionGroup';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_option_group';
                        break;
                    default:
                        $key = 'SpyProductOptionGroup';
                }

                $result[$key] = $this->aSpyProductOptionGroup->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collProductOptionValuePrices) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductOptionValuePrices';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_option_value_prices';
                        break;
                    default:
                        $key = 'ProductOptionValuePrices';
                }

                $result[$key] = $this->collProductOptionValuePrices->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyProductOptionValueTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdProductOptionValue($value);
                break;
            case 1:
                $this->setFkProductOptionGroup($value);
                break;
            case 2:
                $this->setPrice($value);
                break;
            case 3:
                $this->setSku($value);
                break;
            case 4:
                $this->setValue($value);
                break;
            case 5:
                $this->setCreatedAt($value);
                break;
            case 6:
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
        $keys = SpyProductOptionValueTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdProductOptionValue($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkProductOptionGroup($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setPrice($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setSku($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setValue($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setCreatedAt($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setUpdatedAt($arr[$keys[6]]);
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
        $criteria = new Criteria(SpyProductOptionValueTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyProductOptionValueTableMap::COL_ID_PRODUCT_OPTION_VALUE)) {
            $criteria->add(SpyProductOptionValueTableMap::COL_ID_PRODUCT_OPTION_VALUE, $this->id_product_option_value);
        }
        if ($this->isColumnModified(SpyProductOptionValueTableMap::COL_FK_PRODUCT_OPTION_GROUP)) {
            $criteria->add(SpyProductOptionValueTableMap::COL_FK_PRODUCT_OPTION_GROUP, $this->fk_product_option_group);
        }
        if ($this->isColumnModified(SpyProductOptionValueTableMap::COL_PRICE)) {
            $criteria->add(SpyProductOptionValueTableMap::COL_PRICE, $this->price);
        }
        if ($this->isColumnModified(SpyProductOptionValueTableMap::COL_SKU)) {
            $criteria->add(SpyProductOptionValueTableMap::COL_SKU, $this->sku);
        }
        if ($this->isColumnModified(SpyProductOptionValueTableMap::COL_VALUE)) {
            $criteria->add(SpyProductOptionValueTableMap::COL_VALUE, $this->value);
        }
        if ($this->isColumnModified(SpyProductOptionValueTableMap::COL_CREATED_AT)) {
            $criteria->add(SpyProductOptionValueTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpyProductOptionValueTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpyProductOptionValueTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildSpyProductOptionValueQuery::create();
        $criteria->add(SpyProductOptionValueTableMap::COL_ID_PRODUCT_OPTION_VALUE, $this->id_product_option_value);

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
        $validPk = null !== $this->getIdProductOptionValue();

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
        return $this->getIdProductOptionValue();
    }

    /**
     * Generic method to set the primary key (id_product_option_value column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdProductOptionValue($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdProductOptionValue();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\ProductOption\Persistence\SpyProductOptionValue (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkProductOptionGroup($this->getFkProductOptionGroup());
        $copyObj->setPrice($this->getPrice());
        $copyObj->setSku($this->getSku());
        $copyObj->setValue($this->getValue());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getProductOptionValuePrices() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductOptionValuePrice($relObj->copy($deepCopy));
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
            $copyObj->setIdProductOptionValue(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\ProductOption\Persistence\SpyProductOptionValue Clone of current object.
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
     * Declares an association between this object and a ChildSpyProductOptionGroup object.
     *
     * @param ChildSpyProductOptionGroup $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setSpyProductOptionGroup(ChildSpyProductOptionGroup $v = null)
    {
        if ($v === null) {
            $this->setFkProductOptionGroup(NULL);
        } else {
            $this->setFkProductOptionGroup($v->getIdProductOptionGroup());
        }

        $this->aSpyProductOptionGroup = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpyProductOptionGroup object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyProductOptionValue($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpyProductOptionGroup object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSpyProductOptionGroup The associated ChildSpyProductOptionGroup object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductOptionGroup(?ConnectionInterface $con = null)
    {
        if ($this->aSpyProductOptionGroup === null && ($this->fk_product_option_group != 0)) {
            $this->aSpyProductOptionGroup = ChildSpyProductOptionGroupQuery::create()->findPk($this->fk_product_option_group, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSpyProductOptionGroup->addSpyProductOptionValues($this);
             */
        }

        return $this->aSpyProductOptionGroup;
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
        if ('ProductOptionValuePrice' === $relationName) {
            $this->initProductOptionValuePrices();
            return;
        }
        if ('SpyShoppingListProductOption' === $relationName) {
            $this->initSpyShoppingListProductOptions();
            return;
        }
    }

    /**
     * Clears out the collProductOptionValuePrices collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addProductOptionValuePrices()
     */
    public function clearProductOptionValuePrices()
    {
        $this->collProductOptionValuePrices = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collProductOptionValuePrices collection loaded partially.
     *
     * @return void
     */
    public function resetPartialProductOptionValuePrices($v = true): void
    {
        $this->collProductOptionValuePricesPartial = $v;
    }

    /**
     * Initializes the collProductOptionValuePrices collection.
     *
     * By default this just sets the collProductOptionValuePrices collection to an empty array (like clearcollProductOptionValuePrices());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProductOptionValuePrices(bool $overrideExisting = true): void
    {
        if (null !== $this->collProductOptionValuePrices && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductOptionValuePriceTableMap::getTableMap()->getCollectionClassName();

        $this->collProductOptionValuePrices = new $collectionClassName;
        $this->collProductOptionValuePrices->setModel('\Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePrice');
    }

    /**
     * Gets an array of ChildSpyProductOptionValuePrice objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductOptionValue is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyProductOptionValuePrice[] List of ChildSpyProductOptionValuePrice objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyProductOptionValuePrice> List of ChildSpyProductOptionValuePrice objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getProductOptionValuePrices(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collProductOptionValuePricesPartial && !$this->isNew();
        if (null === $this->collProductOptionValuePrices || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collProductOptionValuePrices) {
                    $this->initProductOptionValuePrices();
                } else {
                    $collectionClassName = SpyProductOptionValuePriceTableMap::getTableMap()->getCollectionClassName();

                    $collProductOptionValuePrices = new $collectionClassName;
                    $collProductOptionValuePrices->setModel('\Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePrice');

                    return $collProductOptionValuePrices;
                }
            } else {
                $collProductOptionValuePrices = ChildSpyProductOptionValuePriceQuery::create(null, $criteria)
                    ->filterByProductOptionValue($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProductOptionValuePricesPartial && count($collProductOptionValuePrices)) {
                        $this->initProductOptionValuePrices(false);

                        foreach ($collProductOptionValuePrices as $obj) {
                            if (false == $this->collProductOptionValuePrices->contains($obj)) {
                                $this->collProductOptionValuePrices->append($obj);
                            }
                        }

                        $this->collProductOptionValuePricesPartial = true;
                    }

                    return $collProductOptionValuePrices;
                }

                if ($partial && $this->collProductOptionValuePrices) {
                    foreach ($this->collProductOptionValuePrices as $obj) {
                        if ($obj->isNew()) {
                            $collProductOptionValuePrices[] = $obj;
                        }
                    }
                }

                $this->collProductOptionValuePrices = $collProductOptionValuePrices;
                $this->collProductOptionValuePricesPartial = false;
            }
        }

        return $this->collProductOptionValuePrices;
    }

    /**
     * Sets a collection of ChildSpyProductOptionValuePrice objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $productOptionValuePrices A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setProductOptionValuePrices(Collection $productOptionValuePrices, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyProductOptionValuePrice[] $productOptionValuePricesToDelete */
        $productOptionValuePricesToDelete = $this->getProductOptionValuePrices(new Criteria(), $con)->diff($productOptionValuePrices);


        $this->productOptionValuePricesScheduledForDeletion = $productOptionValuePricesToDelete;

        foreach ($productOptionValuePricesToDelete as $productOptionValuePriceRemoved) {
            $productOptionValuePriceRemoved->setProductOptionValue(null);
        }

        $this->collProductOptionValuePrices = null;
        foreach ($productOptionValuePrices as $productOptionValuePrice) {
            $this->addProductOptionValuePrice($productOptionValuePrice);
        }

        $this->collProductOptionValuePrices = $productOptionValuePrices;
        $this->collProductOptionValuePricesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyProductOptionValuePrice objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyProductOptionValuePrice objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countProductOptionValuePrices(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collProductOptionValuePricesPartial && !$this->isNew();
        if (null === $this->collProductOptionValuePrices || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProductOptionValuePrices) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProductOptionValuePrices());
            }

            $query = ChildSpyProductOptionValuePriceQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProductOptionValue($this)
                ->count($con);
        }

        return count($this->collProductOptionValuePrices);
    }

    /**
     * Method called to associate a ChildSpyProductOptionValuePrice object to this object
     * through the ChildSpyProductOptionValuePrice foreign key attribute.
     *
     * @param ChildSpyProductOptionValuePrice $l ChildSpyProductOptionValuePrice
     * @return $this The current object (for fluent API support)
     */
    public function addProductOptionValuePrice(ChildSpyProductOptionValuePrice $l)
    {
        if ($this->collProductOptionValuePrices === null) {
            $this->initProductOptionValuePrices();
            $this->collProductOptionValuePricesPartial = true;
        }

        if (!$this->collProductOptionValuePrices->contains($l)) {
            $this->doAddProductOptionValuePrice($l);

            if ($this->productOptionValuePricesScheduledForDeletion and $this->productOptionValuePricesScheduledForDeletion->contains($l)) {
                $this->productOptionValuePricesScheduledForDeletion->remove($this->productOptionValuePricesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyProductOptionValuePrice $productOptionValuePrice The ChildSpyProductOptionValuePrice object to add.
     */
    protected function doAddProductOptionValuePrice(ChildSpyProductOptionValuePrice $productOptionValuePrice): void
    {
        $this->collProductOptionValuePrices[]= $productOptionValuePrice;
        $productOptionValuePrice->setProductOptionValue($this);
    }

    /**
     * @param ChildSpyProductOptionValuePrice $productOptionValuePrice The ChildSpyProductOptionValuePrice object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeProductOptionValuePrice(ChildSpyProductOptionValuePrice $productOptionValuePrice)
    {
        if ($this->getProductOptionValuePrices()->contains($productOptionValuePrice)) {
            $pos = $this->collProductOptionValuePrices->search($productOptionValuePrice);
            $this->collProductOptionValuePrices->remove($pos);
            if (null === $this->productOptionValuePricesScheduledForDeletion) {
                $this->productOptionValuePricesScheduledForDeletion = clone $this->collProductOptionValuePrices;
                $this->productOptionValuePricesScheduledForDeletion->clear();
            }
            $this->productOptionValuePricesScheduledForDeletion[]= clone $productOptionValuePrice;
            $productOptionValuePrice->setProductOptionValue(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductOptionValue is new, it will return
     * an empty collection; or if this SpyProductOptionValue has previously
     * been saved, it will retrieve related ProductOptionValuePrices from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductOptionValue.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyProductOptionValuePrice[] List of ChildSpyProductOptionValuePrice objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyProductOptionValuePrice}> List of ChildSpyProductOptionValuePrice objects
     */
    public function getProductOptionValuePricesJoinCurrency(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyProductOptionValuePriceQuery::create(null, $criteria);
        $query->joinWith('Currency', $joinBehavior);

        return $this->getProductOptionValuePrices($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductOptionValue is new, it will return
     * an empty collection; or if this SpyProductOptionValue has previously
     * been saved, it will retrieve related ProductOptionValuePrices from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductOptionValue.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyProductOptionValuePrice[] List of ChildSpyProductOptionValuePrice objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyProductOptionValuePrice}> List of ChildSpyProductOptionValuePrice objects
     */
    public function getProductOptionValuePricesJoinStore(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyProductOptionValuePriceQuery::create(null, $criteria);
        $query->joinWith('Store', $joinBehavior);

        return $this->getProductOptionValuePrices($query, $con);
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
     * If this ChildSpyProductOptionValue is new, it will return
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
                    ->filterBySpyProductOptionValue($this)
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
            $spyShoppingListProductOptionRemoved->setSpyProductOptionValue(null);
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
                ->filterBySpyProductOptionValue($this)
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
        $spyShoppingListProductOption->setSpyProductOptionValue($this);
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
            $spyShoppingListProductOption->setSpyProductOptionValue(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductOptionValue is new, it will return
     * an empty collection; or if this SpyProductOptionValue has previously
     * been saved, it will retrieve related SpyShoppingListProductOptions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductOptionValue.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyShoppingListProductOption[] List of SpyShoppingListProductOption objects
     * @phpstan-return ObjectCollection&\Traversable<SpyShoppingListProductOption}> List of SpyShoppingListProductOption objects
     */
    public function getSpyShoppingListProductOptionsJoinSpyShoppingListItem(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyShoppingListProductOptionQuery::create(null, $criteria);
        $query->joinWith('SpyShoppingListItem', $joinBehavior);

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
        if (null !== $this->aSpyProductOptionGroup) {
            $this->aSpyProductOptionGroup->removeSpyProductOptionValue($this);
        }
        $this->id_product_option_value = null;
        $this->fk_product_option_group = null;
        $this->price = null;
        $this->sku = null;
        $this->value = null;
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
            if ($this->collProductOptionValuePrices) {
                foreach ($this->collProductOptionValuePrices as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyShoppingListProductOptions) {
                foreach ($this->collSpyShoppingListProductOptions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collProductOptionValuePrices = null;
        $this->collSpyShoppingListProductOptions = null;
        $this->aSpyProductOptionGroup = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyProductOptionValueTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return $this The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[SpyProductOptionValueTableMap::COL_UPDATED_AT] = true;

        return $this;
    }

    // event behavior

    /**
     * @return void
     */
    protected function prepareSaveEventName()
    {
        if ($this->isNew()) {
            $this->_eventName = 'Entity.spy_product_option_value.create';
        } else {
            $this->_eventName = 'Entity.spy_product_option_value.update';
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

        if ($this->_eventName !== 'Entity.spy_product_option_value.create') {
            if (!$this->_isModified) {
                return;
            }

            if (!$this->isEventColumnsModified()) {
                return;
            }
        }

        $data = [
            'name' => 'spy_product_option_value',
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
            'name' => 'spy_product_option_value',
            'id' => !is_array($this->getPrimaryKey()) ? $this->getPrimaryKey() : null,
            'event' => 'Entity.spy_product_option_value.delete',
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
            $field = str_replace('spy_product_option_value.', '', $modifiedColumn);
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
            $field = str_replace('spy_product_option_value.', '', $additionalValueColumnName);
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
        $columnType = SpyProductOptionValueTableMap::getTableMap()->getColumn($column)->getType();
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
