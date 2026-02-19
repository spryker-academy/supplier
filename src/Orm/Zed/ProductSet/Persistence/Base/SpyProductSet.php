<?php

namespace Orm\Zed\ProductSet\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\ProductImage\Persistence\SpyProductImageSet;
use Orm\Zed\ProductImage\Persistence\SpyProductImageSetQuery;
use Orm\Zed\ProductImage\Persistence\Base\SpyProductImageSet as BaseSpyProductImageSet;
use Orm\Zed\ProductImage\Persistence\Map\SpyProductImageSetTableMap;
use Orm\Zed\ProductSet\Persistence\SpyProductAbstractSet as ChildSpyProductAbstractSet;
use Orm\Zed\ProductSet\Persistence\SpyProductAbstractSetQuery as ChildSpyProductAbstractSetQuery;
use Orm\Zed\ProductSet\Persistence\SpyProductSet as ChildSpyProductSet;
use Orm\Zed\ProductSet\Persistence\SpyProductSetData as ChildSpyProductSetData;
use Orm\Zed\ProductSet\Persistence\SpyProductSetDataQuery as ChildSpyProductSetDataQuery;
use Orm\Zed\ProductSet\Persistence\SpyProductSetQuery as ChildSpyProductSetQuery;
use Orm\Zed\ProductSet\Persistence\Map\SpyProductAbstractSetTableMap;
use Orm\Zed\ProductSet\Persistence\Map\SpyProductSetDataTableMap;
use Orm\Zed\ProductSet\Persistence\Map\SpyProductSetTableMap;
use Orm\Zed\Url\Persistence\SpyUrl;
use Orm\Zed\Url\Persistence\SpyUrlQuery;
use Orm\Zed\Url\Persistence\Base\SpyUrl as BaseSpyUrl;
use Orm\Zed\Url\Persistence\Map\SpyUrlTableMap;
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
 * Base class that represents a row from the 'spy_product_set' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.ProductSet.Persistence.Base
 */
abstract class SpyProductSet implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\ProductSet\\Persistence\\Map\\SpyProductSetTableMap';


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
     * The value for the id_product_set field.
     *
     * @var        int
     */
    protected $id_product_set;

    /**
     * The value for the is_active field.
     * A boolean flag indicating if an entity is currently active.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $is_active;

    /**
     * The value for the product_set_key field.
     * A unique key for a product set.
     * @var        string
     */
    protected $product_set_key;

    /**
     * The value for the weight field.
     * A numerical weight used for sorting or prioritizing product sets.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $weight;

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
     * @var        ObjectCollection|SpyProductImageSet[] Collection to store aggregation of SpyProductImageSet objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductImageSet> Collection to store aggregation of SpyProductImageSet objects.
     */
    protected $collSpyProductImageSets;
    protected $collSpyProductImageSetsPartial;

    /**
     * @var        ObjectCollection|ChildSpyProductAbstractSet[] Collection to store aggregation of ChildSpyProductAbstractSet objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyProductAbstractSet> Collection to store aggregation of ChildSpyProductAbstractSet objects.
     */
    protected $collSpyProductAbstractSets;
    protected $collSpyProductAbstractSetsPartial;

    /**
     * @var        ObjectCollection|ChildSpyProductSetData[] Collection to store aggregation of ChildSpyProductSetData objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyProductSetData> Collection to store aggregation of ChildSpyProductSetData objects.
     */
    protected $collSpyProductSetDatas;
    protected $collSpyProductSetDatasPartial;

    /**
     * @var        ObjectCollection|SpyUrl[] Collection to store aggregation of SpyUrl objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyUrl> Collection to store aggregation of SpyUrl objects.
     */
    protected $collSpyUrls;
    protected $collSpyUrlsPartial;

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
    ];

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductImageSet[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductImageSet>
     */
    protected $spyProductImageSetsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyProductAbstractSet[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyProductAbstractSet>
     */
    protected $spyProductAbstractSetsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyProductSetData[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyProductSetData>
     */
    protected $spyProductSetDatasScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyUrl[]
     * @phpstan-var ObjectCollection&\Traversable<SpyUrl>
     */
    protected $spyUrlsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->is_active = false;
        $this->weight = 0;
    }

    /**
     * Initializes internal state of Orm\Zed\ProductSet\Persistence\Base\SpyProductSet object.
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
     * Compares this with another <code>SpyProductSet</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyProductSet</code>, delegates to
     * <code>equals(SpyProductSet)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_product_set] column value.
     *
     * @return int
     */
    public function getIdProductSet()
    {
        return $this->id_product_set;
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
     * Get the [product_set_key] column value.
     * A unique key for a product set.
     * @return string
     */
    public function getProductSetKey()
    {
        return $this->product_set_key;
    }

    /**
     * Get the [weight] column value.
     * A numerical weight used for sorting or prioritizing product sets.
     * @return int
     */
    public function getWeight()
    {
        return $this->weight;
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
     * Set the value of [id_product_set] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdProductSet($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_product_set !== $v) {
            $this->id_product_set = $v;
            $this->modifiedColumns[SpyProductSetTableMap::COL_ID_PRODUCT_SET] = true;
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
        $hasDefaultValue = true;

        if (($this->isNew() && $hasDefaultValue) || $this->is_active !== $v) {
            $this->is_active = $v;
            $this->modifiedColumns[SpyProductSetTableMap::COL_IS_ACTIVE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [product_set_key] column.
     * A unique key for a product set.
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProductSetKey($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->product_set_key !== $v) {
            $this->product_set_key = $v;
            $this->modifiedColumns[SpyProductSetTableMap::COL_PRODUCT_SET_KEY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [weight] column.
     * A numerical weight used for sorting or prioritizing product sets.
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setWeight($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = true;

        if (($this->isNew() && $hasDefaultValue) || $this->weight !== $v) {
            $this->weight = $v;
            $this->modifiedColumns[SpyProductSetTableMap::COL_WEIGHT] = true;
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
                $this->modifiedColumns[SpyProductSetTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SpyProductSetTableMap::COL_UPDATED_AT] = true;
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

            if ($this->weight !== 0) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyProductSetTableMap::translateFieldName('IdProductSet', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_product_set = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyProductSetTableMap::translateFieldName('IsActive', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_active = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyProductSetTableMap::translateFieldName('ProductSetKey', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_set_key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyProductSetTableMap::translateFieldName('Weight', TableMap::TYPE_PHPNAME, $indexType)];
            $this->weight = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyProductSetTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyProductSetTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 6; // 6 = SpyProductSetTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\ProductSet\\Persistence\\SpyProductSet'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyProductSetTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyProductSetQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collSpyProductImageSets = null;

            $this->collSpyProductAbstractSets = null;

            $this->collSpyProductSetDatas = null;

            $this->collSpyUrls = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyProductSet::setDeleted()
     * @see SpyProductSet::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductSetTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyProductSetQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductSetTableMap::DATABASE_NAME);
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
                if (!$this->isColumnModified(SpyProductSetTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpyProductSetTableMap::COL_UPDATED_AT)) {
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
                if ($this->isModified() && !$this->isColumnModified(SpyProductSetTableMap::COL_UPDATED_AT)) {
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

                SpyProductSetTableMap::addInstanceToPool($this);
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

            if ($this->spyProductImageSetsScheduledForDeletion !== null) {
                if (!$this->spyProductImageSetsScheduledForDeletion->isEmpty()) {
                    foreach ($this->spyProductImageSetsScheduledForDeletion as $spyProductImageSet) {
                        // need to save related object because we set the relation to null
                        $spyProductImageSet->save($con);
                    }
                    $this->spyProductImageSetsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductImageSets !== null) {
                foreach ($this->collSpyProductImageSets as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductAbstractSetsScheduledForDeletion !== null) {
                if (!$this->spyProductAbstractSetsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductSet\Persistence\SpyProductAbstractSetQuery::create()
                        ->filterByPrimaryKeys($this->spyProductAbstractSetsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductAbstractSetsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductAbstractSets !== null) {
                foreach ($this->collSpyProductAbstractSets as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductSetDatasScheduledForDeletion !== null) {
                if (!$this->spyProductSetDatasScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductSet\Persistence\SpyProductSetDataQuery::create()
                        ->filterByPrimaryKeys($this->spyProductSetDatasScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductSetDatasScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductSetDatas !== null) {
                foreach ($this->collSpyProductSetDatas as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyUrlsScheduledForDeletion !== null) {
                if (!$this->spyUrlsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Url\Persistence\SpyUrlQuery::create()
                        ->filterByPrimaryKeys($this->spyUrlsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyUrlsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyUrls !== null) {
                foreach ($this->collSpyUrls as $referrerFK) {
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

        $this->modifiedColumns[SpyProductSetTableMap::COL_ID_PRODUCT_SET] = true;

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyProductSetTableMap::COL_ID_PRODUCT_SET)) {
            $modifiedColumns[':p' . $index++]  = 'id_product_set';
        }
        if ($this->isColumnModified(SpyProductSetTableMap::COL_IS_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = 'is_active';
        }
        if ($this->isColumnModified(SpyProductSetTableMap::COL_PRODUCT_SET_KEY)) {
            $modifiedColumns[':p' . $index++]  = 'product_set_key';
        }
        if ($this->isColumnModified(SpyProductSetTableMap::COL_WEIGHT)) {
            $modifiedColumns[':p' . $index++]  = 'weight';
        }
        if ($this->isColumnModified(SpyProductSetTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(SpyProductSetTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO spy_product_set (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_product_set':
                        $stmt->bindValue($identifier, $this->id_product_set, PDO::PARAM_INT);

                        break;
                    case 'is_active':
                        $stmt->bindValue($identifier, (int) $this->is_active, PDO::PARAM_INT);

                        break;
                    case 'product_set_key':
                        $stmt->bindValue($identifier, $this->product_set_key, PDO::PARAM_STR);

                        break;
                    case 'weight':
                        $stmt->bindValue($identifier, $this->weight, PDO::PARAM_INT);

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
            $pk = $con->lastInsertId('spy_product_set_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        if ($pk !== null) {
            $this->setIdProductSet($pk);
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
        $pos = SpyProductSetTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdProductSet();

            case 1:
                return $this->getIsActive();

            case 2:
                return $this->getProductSetKey();

            case 3:
                return $this->getWeight();

            case 4:
                return $this->getCreatedAt();

            case 5:
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
        if (isset($alreadyDumpedObjects['SpyProductSet'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyProductSet'][$this->hashCode()] = true;
        $keys = SpyProductSetTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdProductSet(),
            $keys[1] => $this->getIsActive(),
            $keys[2] => $this->getProductSetKey(),
            $keys[3] => $this->getWeight(),
            $keys[4] => $this->getCreatedAt(),
            $keys[5] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[4]] instanceof \DateTimeInterface) {
            $result[$keys[4]] = $result[$keys[4]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[5]] instanceof \DateTimeInterface) {
            $result[$keys[5]] = $result[$keys[5]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collSpyProductImageSets) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductImageSets';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_image_sets';
                        break;
                    default:
                        $key = 'SpyProductImageSets';
                }

                $result[$key] = $this->collSpyProductImageSets->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductAbstractSets) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductAbstractSets';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_abstract_sets';
                        break;
                    default:
                        $key = 'SpyProductAbstractSets';
                }

                $result[$key] = $this->collSpyProductAbstractSets->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductSetDatas) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductSetDatas';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_set_datas';
                        break;
                    default:
                        $key = 'SpyProductSetDatas';
                }

                $result[$key] = $this->collSpyProductSetDatas->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyUrls) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyUrls';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_urls';
                        break;
                    default:
                        $key = 'SpyUrls';
                }

                $result[$key] = $this->collSpyUrls->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyProductSetTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdProductSet($value);
                break;
            case 1:
                $this->setIsActive($value);
                break;
            case 2:
                $this->setProductSetKey($value);
                break;
            case 3:
                $this->setWeight($value);
                break;
            case 4:
                $this->setCreatedAt($value);
                break;
            case 5:
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
        $keys = SpyProductSetTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdProductSet($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setIsActive($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setProductSetKey($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setWeight($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setCreatedAt($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setUpdatedAt($arr[$keys[5]]);
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
        $criteria = new Criteria(SpyProductSetTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyProductSetTableMap::COL_ID_PRODUCT_SET)) {
            $criteria->add(SpyProductSetTableMap::COL_ID_PRODUCT_SET, $this->id_product_set);
        }
        if ($this->isColumnModified(SpyProductSetTableMap::COL_IS_ACTIVE)) {
            $criteria->add(SpyProductSetTableMap::COL_IS_ACTIVE, $this->is_active);
        }
        if ($this->isColumnModified(SpyProductSetTableMap::COL_PRODUCT_SET_KEY)) {
            $criteria->add(SpyProductSetTableMap::COL_PRODUCT_SET_KEY, $this->product_set_key);
        }
        if ($this->isColumnModified(SpyProductSetTableMap::COL_WEIGHT)) {
            $criteria->add(SpyProductSetTableMap::COL_WEIGHT, $this->weight);
        }
        if ($this->isColumnModified(SpyProductSetTableMap::COL_CREATED_AT)) {
            $criteria->add(SpyProductSetTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpyProductSetTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpyProductSetTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildSpyProductSetQuery::create();
        $criteria->add(SpyProductSetTableMap::COL_ID_PRODUCT_SET, $this->id_product_set);

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
        $validPk = null !== $this->getIdProductSet();

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
        return $this->getIdProductSet();
    }

    /**
     * Generic method to set the primary key (id_product_set column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdProductSet($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdProductSet();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\ProductSet\Persistence\SpyProductSet (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setIsActive($this->getIsActive());
        $copyObj->setProductSetKey($this->getProductSetKey());
        $copyObj->setWeight($this->getWeight());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyProductImageSets() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductImageSet($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductAbstractSets() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductAbstractSet($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductSetDatas() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductSetData($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyUrls() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyUrl($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdProductSet(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\ProductSet\Persistence\SpyProductSet Clone of current object.
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
        if ('SpyProductImageSet' === $relationName) {
            $this->initSpyProductImageSets();
            return;
        }
        if ('SpyProductAbstractSet' === $relationName) {
            $this->initSpyProductAbstractSets();
            return;
        }
        if ('SpyProductSetData' === $relationName) {
            $this->initSpyProductSetDatas();
            return;
        }
        if ('SpyUrl' === $relationName) {
            $this->initSpyUrls();
            return;
        }
    }

    /**
     * Clears out the collSpyProductImageSets collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductImageSets()
     */
    public function clearSpyProductImageSets()
    {
        $this->collSpyProductImageSets = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductImageSets collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductImageSets($v = true): void
    {
        $this->collSpyProductImageSetsPartial = $v;
    }

    /**
     * Initializes the collSpyProductImageSets collection.
     *
     * By default this just sets the collSpyProductImageSets collection to an empty array (like clearcollSpyProductImageSets());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductImageSets(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductImageSets && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductImageSetTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductImageSets = new $collectionClassName;
        $this->collSpyProductImageSets->setModel('\Orm\Zed\ProductImage\Persistence\SpyProductImageSet');
    }

    /**
     * Gets an array of SpyProductImageSet objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductSet is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductImageSet[] List of SpyProductImageSet objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductImageSet> List of SpyProductImageSet objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductImageSets(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductImageSetsPartial && !$this->isNew();
        if (null === $this->collSpyProductImageSets || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductImageSets) {
                    $this->initSpyProductImageSets();
                } else {
                    $collectionClassName = SpyProductImageSetTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductImageSets = new $collectionClassName;
                    $collSpyProductImageSets->setModel('\Orm\Zed\ProductImage\Persistence\SpyProductImageSet');

                    return $collSpyProductImageSets;
                }
            } else {
                $collSpyProductImageSets = SpyProductImageSetQuery::create(null, $criteria)
                    ->filterBySpyProductSet($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductImageSetsPartial && count($collSpyProductImageSets)) {
                        $this->initSpyProductImageSets(false);

                        foreach ($collSpyProductImageSets as $obj) {
                            if (false == $this->collSpyProductImageSets->contains($obj)) {
                                $this->collSpyProductImageSets->append($obj);
                            }
                        }

                        $this->collSpyProductImageSetsPartial = true;
                    }

                    return $collSpyProductImageSets;
                }

                if ($partial && $this->collSpyProductImageSets) {
                    foreach ($this->collSpyProductImageSets as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductImageSets[] = $obj;
                        }
                    }
                }

                $this->collSpyProductImageSets = $collSpyProductImageSets;
                $this->collSpyProductImageSetsPartial = false;
            }
        }

        return $this->collSpyProductImageSets;
    }

    /**
     * Sets a collection of SpyProductImageSet objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductImageSets A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductImageSets(Collection $spyProductImageSets, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductImageSet[] $spyProductImageSetsToDelete */
        $spyProductImageSetsToDelete = $this->getSpyProductImageSets(new Criteria(), $con)->diff($spyProductImageSets);


        $this->spyProductImageSetsScheduledForDeletion = $spyProductImageSetsToDelete;

        foreach ($spyProductImageSetsToDelete as $spyProductImageSetRemoved) {
            $spyProductImageSetRemoved->setSpyProductSet(null);
        }

        $this->collSpyProductImageSets = null;
        foreach ($spyProductImageSets as $spyProductImageSet) {
            $this->addSpyProductImageSet($spyProductImageSet);
        }

        $this->collSpyProductImageSets = $spyProductImageSets;
        $this->collSpyProductImageSetsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductImageSet objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductImageSet objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductImageSets(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductImageSetsPartial && !$this->isNew();
        if (null === $this->collSpyProductImageSets || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductImageSets) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductImageSets());
            }

            $query = SpyProductImageSetQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductSet($this)
                ->count($con);
        }

        return count($this->collSpyProductImageSets);
    }

    /**
     * Method called to associate a SpyProductImageSet object to this object
     * through the SpyProductImageSet foreign key attribute.
     *
     * @param SpyProductImageSet $l SpyProductImageSet
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductImageSet(SpyProductImageSet $l)
    {
        if ($this->collSpyProductImageSets === null) {
            $this->initSpyProductImageSets();
            $this->collSpyProductImageSetsPartial = true;
        }

        if (!$this->collSpyProductImageSets->contains($l)) {
            $this->doAddSpyProductImageSet($l);

            if ($this->spyProductImageSetsScheduledForDeletion and $this->spyProductImageSetsScheduledForDeletion->contains($l)) {
                $this->spyProductImageSetsScheduledForDeletion->remove($this->spyProductImageSetsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductImageSet $spyProductImageSet The SpyProductImageSet object to add.
     */
    protected function doAddSpyProductImageSet(SpyProductImageSet $spyProductImageSet): void
    {
        $this->collSpyProductImageSets[]= $spyProductImageSet;
        $spyProductImageSet->setSpyProductSet($this);
    }

    /**
     * @param SpyProductImageSet $spyProductImageSet The SpyProductImageSet object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductImageSet(SpyProductImageSet $spyProductImageSet)
    {
        if ($this->getSpyProductImageSets()->contains($spyProductImageSet)) {
            $pos = $this->collSpyProductImageSets->search($spyProductImageSet);
            $this->collSpyProductImageSets->remove($pos);
            if (null === $this->spyProductImageSetsScheduledForDeletion) {
                $this->spyProductImageSetsScheduledForDeletion = clone $this->collSpyProductImageSets;
                $this->spyProductImageSetsScheduledForDeletion->clear();
            }
            $this->spyProductImageSetsScheduledForDeletion[]= $spyProductImageSet;
            $spyProductImageSet->setSpyProductSet(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductSet is new, it will return
     * an empty collection; or if this SpyProductSet has previously
     * been saved, it will retrieve related SpyProductImageSets from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductSet.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductImageSet[] List of SpyProductImageSet objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductImageSet}> List of SpyProductImageSet objects
     */
    public function getSpyProductImageSetsJoinSpyConfigurableBundleTemplate(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductImageSetQuery::create(null, $criteria);
        $query->joinWith('SpyConfigurableBundleTemplate', $joinBehavior);

        return $this->getSpyProductImageSets($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductSet is new, it will return
     * an empty collection; or if this SpyProductSet has previously
     * been saved, it will retrieve related SpyProductImageSets from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductSet.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductImageSet[] List of SpyProductImageSet objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductImageSet}> List of SpyProductImageSet objects
     */
    public function getSpyProductImageSetsJoinSpyLocale(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductImageSetQuery::create(null, $criteria);
        $query->joinWith('SpyLocale', $joinBehavior);

        return $this->getSpyProductImageSets($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductSet is new, it will return
     * an empty collection; or if this SpyProductSet has previously
     * been saved, it will retrieve related SpyProductImageSets from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductSet.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductImageSet[] List of SpyProductImageSet objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductImageSet}> List of SpyProductImageSet objects
     */
    public function getSpyProductImageSetsJoinSpyProduct(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductImageSetQuery::create(null, $criteria);
        $query->joinWith('SpyProduct', $joinBehavior);

        return $this->getSpyProductImageSets($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductSet is new, it will return
     * an empty collection; or if this SpyProductSet has previously
     * been saved, it will retrieve related SpyProductImageSets from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductSet.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductImageSet[] List of SpyProductImageSet objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductImageSet}> List of SpyProductImageSet objects
     */
    public function getSpyProductImageSetsJoinSpyProductAbstract(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductImageSetQuery::create(null, $criteria);
        $query->joinWith('SpyProductAbstract', $joinBehavior);

        return $this->getSpyProductImageSets($query, $con);
    }

    /**
     * Clears out the collSpyProductAbstractSets collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductAbstractSets()
     */
    public function clearSpyProductAbstractSets()
    {
        $this->collSpyProductAbstractSets = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductAbstractSets collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductAbstractSets($v = true): void
    {
        $this->collSpyProductAbstractSetsPartial = $v;
    }

    /**
     * Initializes the collSpyProductAbstractSets collection.
     *
     * By default this just sets the collSpyProductAbstractSets collection to an empty array (like clearcollSpyProductAbstractSets());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductAbstractSets(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductAbstractSets && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductAbstractSetTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductAbstractSets = new $collectionClassName;
        $this->collSpyProductAbstractSets->setModel('\Orm\Zed\ProductSet\Persistence\SpyProductAbstractSet');
    }

    /**
     * Gets an array of ChildSpyProductAbstractSet objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductSet is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyProductAbstractSet[] List of ChildSpyProductAbstractSet objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyProductAbstractSet> List of ChildSpyProductAbstractSet objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductAbstractSets(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductAbstractSetsPartial && !$this->isNew();
        if (null === $this->collSpyProductAbstractSets || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductAbstractSets) {
                    $this->initSpyProductAbstractSets();
                } else {
                    $collectionClassName = SpyProductAbstractSetTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductAbstractSets = new $collectionClassName;
                    $collSpyProductAbstractSets->setModel('\Orm\Zed\ProductSet\Persistence\SpyProductAbstractSet');

                    return $collSpyProductAbstractSets;
                }
            } else {
                $collSpyProductAbstractSets = ChildSpyProductAbstractSetQuery::create(null, $criteria)
                    ->filterBySpyProductSet($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductAbstractSetsPartial && count($collSpyProductAbstractSets)) {
                        $this->initSpyProductAbstractSets(false);

                        foreach ($collSpyProductAbstractSets as $obj) {
                            if (false == $this->collSpyProductAbstractSets->contains($obj)) {
                                $this->collSpyProductAbstractSets->append($obj);
                            }
                        }

                        $this->collSpyProductAbstractSetsPartial = true;
                    }

                    return $collSpyProductAbstractSets;
                }

                if ($partial && $this->collSpyProductAbstractSets) {
                    foreach ($this->collSpyProductAbstractSets as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductAbstractSets[] = $obj;
                        }
                    }
                }

                $this->collSpyProductAbstractSets = $collSpyProductAbstractSets;
                $this->collSpyProductAbstractSetsPartial = false;
            }
        }

        return $this->collSpyProductAbstractSets;
    }

    /**
     * Sets a collection of ChildSpyProductAbstractSet objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductAbstractSets A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductAbstractSets(Collection $spyProductAbstractSets, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyProductAbstractSet[] $spyProductAbstractSetsToDelete */
        $spyProductAbstractSetsToDelete = $this->getSpyProductAbstractSets(new Criteria(), $con)->diff($spyProductAbstractSets);


        $this->spyProductAbstractSetsScheduledForDeletion = $spyProductAbstractSetsToDelete;

        foreach ($spyProductAbstractSetsToDelete as $spyProductAbstractSetRemoved) {
            $spyProductAbstractSetRemoved->setSpyProductSet(null);
        }

        $this->collSpyProductAbstractSets = null;
        foreach ($spyProductAbstractSets as $spyProductAbstractSet) {
            $this->addSpyProductAbstractSet($spyProductAbstractSet);
        }

        $this->collSpyProductAbstractSets = $spyProductAbstractSets;
        $this->collSpyProductAbstractSetsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyProductAbstractSet objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyProductAbstractSet objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductAbstractSets(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductAbstractSetsPartial && !$this->isNew();
        if (null === $this->collSpyProductAbstractSets || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductAbstractSets) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductAbstractSets());
            }

            $query = ChildSpyProductAbstractSetQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductSet($this)
                ->count($con);
        }

        return count($this->collSpyProductAbstractSets);
    }

    /**
     * Method called to associate a ChildSpyProductAbstractSet object to this object
     * through the ChildSpyProductAbstractSet foreign key attribute.
     *
     * @param ChildSpyProductAbstractSet $l ChildSpyProductAbstractSet
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductAbstractSet(ChildSpyProductAbstractSet $l)
    {
        if ($this->collSpyProductAbstractSets === null) {
            $this->initSpyProductAbstractSets();
            $this->collSpyProductAbstractSetsPartial = true;
        }

        if (!$this->collSpyProductAbstractSets->contains($l)) {
            $this->doAddSpyProductAbstractSet($l);

            if ($this->spyProductAbstractSetsScheduledForDeletion and $this->spyProductAbstractSetsScheduledForDeletion->contains($l)) {
                $this->spyProductAbstractSetsScheduledForDeletion->remove($this->spyProductAbstractSetsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyProductAbstractSet $spyProductAbstractSet The ChildSpyProductAbstractSet object to add.
     */
    protected function doAddSpyProductAbstractSet(ChildSpyProductAbstractSet $spyProductAbstractSet): void
    {
        $this->collSpyProductAbstractSets[]= $spyProductAbstractSet;
        $spyProductAbstractSet->setSpyProductSet($this);
    }

    /**
     * @param ChildSpyProductAbstractSet $spyProductAbstractSet The ChildSpyProductAbstractSet object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductAbstractSet(ChildSpyProductAbstractSet $spyProductAbstractSet)
    {
        if ($this->getSpyProductAbstractSets()->contains($spyProductAbstractSet)) {
            $pos = $this->collSpyProductAbstractSets->search($spyProductAbstractSet);
            $this->collSpyProductAbstractSets->remove($pos);
            if (null === $this->spyProductAbstractSetsScheduledForDeletion) {
                $this->spyProductAbstractSetsScheduledForDeletion = clone $this->collSpyProductAbstractSets;
                $this->spyProductAbstractSetsScheduledForDeletion->clear();
            }
            $this->spyProductAbstractSetsScheduledForDeletion[]= clone $spyProductAbstractSet;
            $spyProductAbstractSet->setSpyProductSet(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductSet is new, it will return
     * an empty collection; or if this SpyProductSet has previously
     * been saved, it will retrieve related SpyProductAbstractSets from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductSet.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyProductAbstractSet[] List of ChildSpyProductAbstractSet objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyProductAbstractSet}> List of ChildSpyProductAbstractSet objects
     */
    public function getSpyProductAbstractSetsJoinSpyProductAbstract(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyProductAbstractSetQuery::create(null, $criteria);
        $query->joinWith('SpyProductAbstract', $joinBehavior);

        return $this->getSpyProductAbstractSets($query, $con);
    }

    /**
     * Clears out the collSpyProductSetDatas collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductSetDatas()
     */
    public function clearSpyProductSetDatas()
    {
        $this->collSpyProductSetDatas = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductSetDatas collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductSetDatas($v = true): void
    {
        $this->collSpyProductSetDatasPartial = $v;
    }

    /**
     * Initializes the collSpyProductSetDatas collection.
     *
     * By default this just sets the collSpyProductSetDatas collection to an empty array (like clearcollSpyProductSetDatas());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductSetDatas(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductSetDatas && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductSetDataTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductSetDatas = new $collectionClassName;
        $this->collSpyProductSetDatas->setModel('\Orm\Zed\ProductSet\Persistence\SpyProductSetData');
    }

    /**
     * Gets an array of ChildSpyProductSetData objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductSet is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyProductSetData[] List of ChildSpyProductSetData objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyProductSetData> List of ChildSpyProductSetData objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductSetDatas(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductSetDatasPartial && !$this->isNew();
        if (null === $this->collSpyProductSetDatas || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductSetDatas) {
                    $this->initSpyProductSetDatas();
                } else {
                    $collectionClassName = SpyProductSetDataTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductSetDatas = new $collectionClassName;
                    $collSpyProductSetDatas->setModel('\Orm\Zed\ProductSet\Persistence\SpyProductSetData');

                    return $collSpyProductSetDatas;
                }
            } else {
                $collSpyProductSetDatas = ChildSpyProductSetDataQuery::create(null, $criteria)
                    ->filterBySpyProductSet($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductSetDatasPartial && count($collSpyProductSetDatas)) {
                        $this->initSpyProductSetDatas(false);

                        foreach ($collSpyProductSetDatas as $obj) {
                            if (false == $this->collSpyProductSetDatas->contains($obj)) {
                                $this->collSpyProductSetDatas->append($obj);
                            }
                        }

                        $this->collSpyProductSetDatasPartial = true;
                    }

                    return $collSpyProductSetDatas;
                }

                if ($partial && $this->collSpyProductSetDatas) {
                    foreach ($this->collSpyProductSetDatas as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductSetDatas[] = $obj;
                        }
                    }
                }

                $this->collSpyProductSetDatas = $collSpyProductSetDatas;
                $this->collSpyProductSetDatasPartial = false;
            }
        }

        return $this->collSpyProductSetDatas;
    }

    /**
     * Sets a collection of ChildSpyProductSetData objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductSetDatas A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductSetDatas(Collection $spyProductSetDatas, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyProductSetData[] $spyProductSetDatasToDelete */
        $spyProductSetDatasToDelete = $this->getSpyProductSetDatas(new Criteria(), $con)->diff($spyProductSetDatas);


        $this->spyProductSetDatasScheduledForDeletion = $spyProductSetDatasToDelete;

        foreach ($spyProductSetDatasToDelete as $spyProductSetDataRemoved) {
            $spyProductSetDataRemoved->setSpyProductSet(null);
        }

        $this->collSpyProductSetDatas = null;
        foreach ($spyProductSetDatas as $spyProductSetData) {
            $this->addSpyProductSetData($spyProductSetData);
        }

        $this->collSpyProductSetDatas = $spyProductSetDatas;
        $this->collSpyProductSetDatasPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyProductSetData objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyProductSetData objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductSetDatas(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductSetDatasPartial && !$this->isNew();
        if (null === $this->collSpyProductSetDatas || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductSetDatas) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductSetDatas());
            }

            $query = ChildSpyProductSetDataQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductSet($this)
                ->count($con);
        }

        return count($this->collSpyProductSetDatas);
    }

    /**
     * Method called to associate a ChildSpyProductSetData object to this object
     * through the ChildSpyProductSetData foreign key attribute.
     *
     * @param ChildSpyProductSetData $l ChildSpyProductSetData
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductSetData(ChildSpyProductSetData $l)
    {
        if ($this->collSpyProductSetDatas === null) {
            $this->initSpyProductSetDatas();
            $this->collSpyProductSetDatasPartial = true;
        }

        if (!$this->collSpyProductSetDatas->contains($l)) {
            $this->doAddSpyProductSetData($l);

            if ($this->spyProductSetDatasScheduledForDeletion and $this->spyProductSetDatasScheduledForDeletion->contains($l)) {
                $this->spyProductSetDatasScheduledForDeletion->remove($this->spyProductSetDatasScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyProductSetData $spyProductSetData The ChildSpyProductSetData object to add.
     */
    protected function doAddSpyProductSetData(ChildSpyProductSetData $spyProductSetData): void
    {
        $this->collSpyProductSetDatas[]= $spyProductSetData;
        $spyProductSetData->setSpyProductSet($this);
    }

    /**
     * @param ChildSpyProductSetData $spyProductSetData The ChildSpyProductSetData object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductSetData(ChildSpyProductSetData $spyProductSetData)
    {
        if ($this->getSpyProductSetDatas()->contains($spyProductSetData)) {
            $pos = $this->collSpyProductSetDatas->search($spyProductSetData);
            $this->collSpyProductSetDatas->remove($pos);
            if (null === $this->spyProductSetDatasScheduledForDeletion) {
                $this->spyProductSetDatasScheduledForDeletion = clone $this->collSpyProductSetDatas;
                $this->spyProductSetDatasScheduledForDeletion->clear();
            }
            $this->spyProductSetDatasScheduledForDeletion[]= clone $spyProductSetData;
            $spyProductSetData->setSpyProductSet(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductSet is new, it will return
     * an empty collection; or if this SpyProductSet has previously
     * been saved, it will retrieve related SpyProductSetDatas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductSet.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyProductSetData[] List of ChildSpyProductSetData objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyProductSetData}> List of ChildSpyProductSetData objects
     */
    public function getSpyProductSetDatasJoinSpyLocale(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyProductSetDataQuery::create(null, $criteria);
        $query->joinWith('SpyLocale', $joinBehavior);

        return $this->getSpyProductSetDatas($query, $con);
    }

    /**
     * Clears out the collSpyUrls collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyUrls()
     */
    public function clearSpyUrls()
    {
        $this->collSpyUrls = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyUrls collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyUrls($v = true): void
    {
        $this->collSpyUrlsPartial = $v;
    }

    /**
     * Initializes the collSpyUrls collection.
     *
     * By default this just sets the collSpyUrls collection to an empty array (like clearcollSpyUrls());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyUrls(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyUrls && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyUrlTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyUrls = new $collectionClassName;
        $this->collSpyUrls->setModel('\Orm\Zed\Url\Persistence\SpyUrl');
    }

    /**
     * Gets an array of SpyUrl objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductSet is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyUrl[] List of SpyUrl objects
     * @phpstan-return ObjectCollection&\Traversable<SpyUrl> List of SpyUrl objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyUrls(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyUrlsPartial && !$this->isNew();
        if (null === $this->collSpyUrls || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyUrls) {
                    $this->initSpyUrls();
                } else {
                    $collectionClassName = SpyUrlTableMap::getTableMap()->getCollectionClassName();

                    $collSpyUrls = new $collectionClassName;
                    $collSpyUrls->setModel('\Orm\Zed\Url\Persistence\SpyUrl');

                    return $collSpyUrls;
                }
            } else {
                $collSpyUrls = SpyUrlQuery::create(null, $criteria)
                    ->filterBySpyProductSet($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyUrlsPartial && count($collSpyUrls)) {
                        $this->initSpyUrls(false);

                        foreach ($collSpyUrls as $obj) {
                            if (false == $this->collSpyUrls->contains($obj)) {
                                $this->collSpyUrls->append($obj);
                            }
                        }

                        $this->collSpyUrlsPartial = true;
                    }

                    return $collSpyUrls;
                }

                if ($partial && $this->collSpyUrls) {
                    foreach ($this->collSpyUrls as $obj) {
                        if ($obj->isNew()) {
                            $collSpyUrls[] = $obj;
                        }
                    }
                }

                $this->collSpyUrls = $collSpyUrls;
                $this->collSpyUrlsPartial = false;
            }
        }

        return $this->collSpyUrls;
    }

    /**
     * Sets a collection of SpyUrl objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyUrls A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyUrls(Collection $spyUrls, ?ConnectionInterface $con = null)
    {
        /** @var SpyUrl[] $spyUrlsToDelete */
        $spyUrlsToDelete = $this->getSpyUrls(new Criteria(), $con)->diff($spyUrls);


        $this->spyUrlsScheduledForDeletion = $spyUrlsToDelete;

        foreach ($spyUrlsToDelete as $spyUrlRemoved) {
            $spyUrlRemoved->setSpyProductSet(null);
        }

        $this->collSpyUrls = null;
        foreach ($spyUrls as $spyUrl) {
            $this->addSpyUrl($spyUrl);
        }

        $this->collSpyUrls = $spyUrls;
        $this->collSpyUrlsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyUrl objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyUrl objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyUrls(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyUrlsPartial && !$this->isNew();
        if (null === $this->collSpyUrls || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyUrls) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyUrls());
            }

            $query = SpyUrlQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductSet($this)
                ->count($con);
        }

        return count($this->collSpyUrls);
    }

    /**
     * Method called to associate a SpyUrl object to this object
     * through the SpyUrl foreign key attribute.
     *
     * @param SpyUrl $l SpyUrl
     * @return $this The current object (for fluent API support)
     */
    public function addSpyUrl(SpyUrl $l)
    {
        if ($this->collSpyUrls === null) {
            $this->initSpyUrls();
            $this->collSpyUrlsPartial = true;
        }

        if (!$this->collSpyUrls->contains($l)) {
            $this->doAddSpyUrl($l);

            if ($this->spyUrlsScheduledForDeletion and $this->spyUrlsScheduledForDeletion->contains($l)) {
                $this->spyUrlsScheduledForDeletion->remove($this->spyUrlsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyUrl $spyUrl The SpyUrl object to add.
     */
    protected function doAddSpyUrl(SpyUrl $spyUrl): void
    {
        $this->collSpyUrls[]= $spyUrl;
        $spyUrl->setSpyProductSet($this);
    }

    /**
     * @param SpyUrl $spyUrl The SpyUrl object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyUrl(SpyUrl $spyUrl)
    {
        if ($this->getSpyUrls()->contains($spyUrl)) {
            $pos = $this->collSpyUrls->search($spyUrl);
            $this->collSpyUrls->remove($pos);
            if (null === $this->spyUrlsScheduledForDeletion) {
                $this->spyUrlsScheduledForDeletion = clone $this->collSpyUrls;
                $this->spyUrlsScheduledForDeletion->clear();
            }
            $this->spyUrlsScheduledForDeletion[]= $spyUrl;
            $spyUrl->setSpyProductSet(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductSet is new, it will return
     * an empty collection; or if this SpyProductSet has previously
     * been saved, it will retrieve related SpyUrls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductSet.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyUrl[] List of SpyUrl objects
     * @phpstan-return ObjectCollection&\Traversable<SpyUrl}> List of SpyUrl objects
     */
    public function getSpyUrlsJoinSpyCategoryNode(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyUrlQuery::create(null, $criteria);
        $query->joinWith('SpyCategoryNode', $joinBehavior);

        return $this->getSpyUrls($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductSet is new, it will return
     * an empty collection; or if this SpyProductSet has previously
     * been saved, it will retrieve related SpyUrls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductSet.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyUrl[] List of SpyUrl objects
     * @phpstan-return ObjectCollection&\Traversable<SpyUrl}> List of SpyUrl objects
     */
    public function getSpyUrlsJoinCmsPage(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyUrlQuery::create(null, $criteria);
        $query->joinWith('CmsPage', $joinBehavior);

        return $this->getSpyUrls($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductSet is new, it will return
     * an empty collection; or if this SpyProductSet has previously
     * been saved, it will retrieve related SpyUrls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductSet.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyUrl[] List of SpyUrl objects
     * @phpstan-return ObjectCollection&\Traversable<SpyUrl}> List of SpyUrl objects
     */
    public function getSpyUrlsJoinSpyMerchant(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyUrlQuery::create(null, $criteria);
        $query->joinWith('SpyMerchant', $joinBehavior);

        return $this->getSpyUrls($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductSet is new, it will return
     * an empty collection; or if this SpyProductSet has previously
     * been saved, it will retrieve related SpyUrls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductSet.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyUrl[] List of SpyUrl objects
     * @phpstan-return ObjectCollection&\Traversable<SpyUrl}> List of SpyUrl objects
     */
    public function getSpyUrlsJoinSpyProduct(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyUrlQuery::create(null, $criteria);
        $query->joinWith('SpyProduct', $joinBehavior);

        return $this->getSpyUrls($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductSet is new, it will return
     * an empty collection; or if this SpyProductSet has previously
     * been saved, it will retrieve related SpyUrls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductSet.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyUrl[] List of SpyUrl objects
     * @phpstan-return ObjectCollection&\Traversable<SpyUrl}> List of SpyUrl objects
     */
    public function getSpyUrlsJoinSpyLocale(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyUrlQuery::create(null, $criteria);
        $query->joinWith('SpyLocale', $joinBehavior);

        return $this->getSpyUrls($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductSet is new, it will return
     * an empty collection; or if this SpyProductSet has previously
     * been saved, it will retrieve related SpyUrls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductSet.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyUrl[] List of SpyUrl objects
     * @phpstan-return ObjectCollection&\Traversable<SpyUrl}> List of SpyUrl objects
     */
    public function getSpyUrlsJoinSpyUrlRedirect(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyUrlQuery::create(null, $criteria);
        $query->joinWith('SpyUrlRedirect', $joinBehavior);

        return $this->getSpyUrls($query, $con);
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
        $this->id_product_set = null;
        $this->is_active = null;
        $this->product_set_key = null;
        $this->weight = null;
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
            if ($this->collSpyProductImageSets) {
                foreach ($this->collSpyProductImageSets as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductAbstractSets) {
                foreach ($this->collSpyProductAbstractSets as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductSetDatas) {
                foreach ($this->collSpyProductSetDatas as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyUrls) {
                foreach ($this->collSpyUrls as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyProductImageSets = null;
        $this->collSpyProductAbstractSets = null;
        $this->collSpyProductSetDatas = null;
        $this->collSpyUrls = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyProductSetTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return $this The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[SpyProductSetTableMap::COL_UPDATED_AT] = true;

        return $this;
    }

    // event behavior

    /**
     * @return void
     */
    protected function prepareSaveEventName()
    {
        if ($this->isNew()) {
            $this->_eventName = 'Entity.spy_product_set.create';
        } else {
            $this->_eventName = 'Entity.spy_product_set.update';
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

        if ($this->_eventName !== 'Entity.spy_product_set.create') {
            if (!$this->_isModified) {
                return;
            }

            if (!$this->isEventColumnsModified()) {
                return;
            }
        }

        $data = [
            'name' => 'spy_product_set',
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
            'name' => 'spy_product_set',
            'id' => !is_array($this->getPrimaryKey()) ? $this->getPrimaryKey() : null,
            'event' => 'Entity.spy_product_set.delete',
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
            $field = str_replace('spy_product_set.', '', $modifiedColumn);
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
            $field = str_replace('spy_product_set.', '', $additionalValueColumnName);
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
        $columnType = SpyProductSetTableMap::getTableMap()->getColumn($column)->getType();
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
