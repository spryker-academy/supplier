<?php

namespace Orm\Zed\ProductOption\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\MerchantProductOption\Persistence\SpyMerchantProductOptionGroup;
use Orm\Zed\MerchantProductOption\Persistence\SpyMerchantProductOptionGroupQuery;
use Orm\Zed\MerchantProductOption\Persistence\Base\SpyMerchantProductOptionGroup as BaseSpyMerchantProductOptionGroup;
use Orm\Zed\MerchantProductOption\Persistence\Map\SpyMerchantProductOptionGroupTableMap;
use Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroup as ChildSpyProductAbstractProductOptionGroup;
use Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroupQuery as ChildSpyProductAbstractProductOptionGroupQuery;
use Orm\Zed\ProductOption\Persistence\SpyProductOptionGroup as ChildSpyProductOptionGroup;
use Orm\Zed\ProductOption\Persistence\SpyProductOptionGroupQuery as ChildSpyProductOptionGroupQuery;
use Orm\Zed\ProductOption\Persistence\SpyProductOptionValue as ChildSpyProductOptionValue;
use Orm\Zed\ProductOption\Persistence\SpyProductOptionValueQuery as ChildSpyProductOptionValueQuery;
use Orm\Zed\ProductOption\Persistence\Map\SpyProductAbstractProductOptionGroupTableMap;
use Orm\Zed\ProductOption\Persistence\Map\SpyProductOptionGroupTableMap;
use Orm\Zed\ProductOption\Persistence\Map\SpyProductOptionValueTableMap;
use Orm\Zed\Product\Persistence\SpyProductAbstract;
use Orm\Zed\Product\Persistence\SpyProductAbstractQuery;
use Orm\Zed\Tax\Persistence\SpyTaxSet;
use Orm\Zed\Tax\Persistence\SpyTaxSetQuery;
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
 * Base class that represents a row from the 'spy_product_option_group' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.ProductOption.Persistence.Base
 */
abstract class SpyProductOptionGroup implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\ProductOption\\Persistence\\Map\\SpyProductOptionGroupTableMap';


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
     * The value for the id_product_option_group field.
     *
     * @var        int
     */
    protected $id_product_option_group;

    /**
     * The value for the fk_tax_set field.
     *
     * @var        int|null
     */
    protected $fk_tax_set;

    /**
     * The value for the active field.
     * A boolean flag indicating if an entity is active.
     * @var        boolean|null
     */
    protected $active;

    /**
     * The value for the key field.
     * Key is an identifier for existing entities. This should never be changed.
     * @var        string|null
     */
    protected $key;

    /**
     * The value for the name field.
     * The name of an entity (e.g., user, category, product, role).
     * @var        string|null
     */
    protected $name;

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
     * @var        SpyTaxSet
     */
    protected $aSpyTaxSet;

    /**
     * @var        ObjectCollection|SpyMerchantProductOptionGroup[] Collection to store aggregation of SpyMerchantProductOptionGroup objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantProductOptionGroup> Collection to store aggregation of SpyMerchantProductOptionGroup objects.
     */
    protected $collSpyMerchantProductOptionGroups;
    protected $collSpyMerchantProductOptionGroupsPartial;

    /**
     * @var        ObjectCollection|ChildSpyProductAbstractProductOptionGroup[] Collection to store aggregation of ChildSpyProductAbstractProductOptionGroup objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyProductAbstractProductOptionGroup> Collection to store aggregation of ChildSpyProductAbstractProductOptionGroup objects.
     */
    protected $collSpyProductAbstractProductOptionGroups;
    protected $collSpyProductAbstractProductOptionGroupsPartial;

    /**
     * @var        ObjectCollection|ChildSpyProductOptionValue[] Collection to store aggregation of ChildSpyProductOptionValue objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyProductOptionValue> Collection to store aggregation of ChildSpyProductOptionValue objects.
     */
    protected $collSpyProductOptionValues;
    protected $collSpyProductOptionValuesPartial;

    /**
     * @var        ObjectCollection|SpyProductAbstract[] Cross Collection to store aggregation of SpyProductAbstract objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductAbstract> Cross Collection to store aggregation of SpyProductAbstract objects.
     */
    protected $collSpyProductAbstracts;

    /**
     * @var bool
     */
    protected $collSpyProductAbstractsPartial;

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
        'spy_product_option_group.fk_tax_set' => 'fk_tax_set',
    ];

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductAbstract[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductAbstract>
     */
    protected $spyProductAbstractsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyMerchantProductOptionGroup[]
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantProductOptionGroup>
     */
    protected $spyMerchantProductOptionGroupsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyProductAbstractProductOptionGroup[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyProductAbstractProductOptionGroup>
     */
    protected $spyProductAbstractProductOptionGroupsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyProductOptionValue[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyProductOptionValue>
     */
    protected $spyProductOptionValuesScheduledForDeletion = null;

    /**
     * Initializes internal state of Orm\Zed\ProductOption\Persistence\Base\SpyProductOptionGroup object.
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
     * Compares this with another <code>SpyProductOptionGroup</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyProductOptionGroup</code>, delegates to
     * <code>equals(SpyProductOptionGroup)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_product_option_group] column value.
     *
     * @return int
     */
    public function getIdProductOptionGroup()
    {
        return $this->id_product_option_group;
    }

    /**
     * Get the [fk_tax_set] column value.
     *
     * @return int|null
     */
    public function getFkTaxSet()
    {
        return $this->fk_tax_set;
    }

    /**
     * Get the [active] column value.
     * A boolean flag indicating if an entity is active.
     * @return boolean|null
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Get the [active] column value.
     * A boolean flag indicating if an entity is active.
     * @return boolean|null
     */
    public function isActive()
    {
        return $this->getActive();
    }

    /**
     * Get the [key] column value.
     * Key is an identifier for existing entities. This should never be changed.
     * @return string|null
     */
    public function getKey()
    {
        return $this->key;
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
     * Set the value of [id_product_option_group] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdProductOptionGroup($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_product_option_group !== $v) {
            $this->id_product_option_group = $v;
            $this->modifiedColumns[SpyProductOptionGroupTableMap::COL_ID_PRODUCT_OPTION_GROUP] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_tax_set] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkTaxSet($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_tax_set !== $v) {
            $this->fk_tax_set = $v;
            $this->modifiedColumns[SpyProductOptionGroupTableMap::COL_FK_TAX_SET] = true;
        }

        if ($this->aSpyTaxSet !== null && $this->aSpyTaxSet->getIdTaxSet() !== $v) {
            $this->aSpyTaxSet = null;
        }

        return $this;
    }

    /**
     * Sets the value of the [active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * A boolean flag indicating if an entity is active.
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setActive($v)
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

        if (($this->isNew() && $hasDefaultValue) || $this->active !== $v) {
            $this->active = $v;
            $this->modifiedColumns[SpyProductOptionGroupTableMap::COL_ACTIVE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [key] column.
     * Key is an identifier for existing entities. This should never be changed.
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
            $this->modifiedColumns[SpyProductOptionGroupTableMap::COL_KEY] = true;
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
            $this->modifiedColumns[SpyProductOptionGroupTableMap::COL_NAME] = true;
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
                $this->modifiedColumns[SpyProductOptionGroupTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SpyProductOptionGroupTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyProductOptionGroupTableMap::translateFieldName('IdProductOptionGroup', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_product_option_group = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyProductOptionGroupTableMap::translateFieldName('FkTaxSet', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_tax_set = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyProductOptionGroupTableMap::translateFieldName('Active', TableMap::TYPE_PHPNAME, $indexType)];
            $this->active = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyProductOptionGroupTableMap::translateFieldName('Key', TableMap::TYPE_PHPNAME, $indexType)];
            $this->key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyProductOptionGroupTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyProductOptionGroupTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpyProductOptionGroupTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 7; // 7 = SpyProductOptionGroupTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\ProductOption\\Persistence\\SpyProductOptionGroup'), 0, $e);
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
        if ($this->aSpyTaxSet !== null && $this->fk_tax_set !== $this->aSpyTaxSet->getIdTaxSet()) {
            $this->aSpyTaxSet = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyProductOptionGroupTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyProductOptionGroupQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aSpyTaxSet = null;
            $this->collSpyMerchantProductOptionGroups = null;

            $this->collSpyProductAbstractProductOptionGroups = null;

            $this->collSpyProductOptionValues = null;

            $this->collSpyProductAbstracts = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyProductOptionGroup::setDeleted()
     * @see SpyProductOptionGroup::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductOptionGroupTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyProductOptionGroupQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductOptionGroupTableMap::DATABASE_NAME);
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
                if (!$this->isColumnModified(SpyProductOptionGroupTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpyProductOptionGroupTableMap::COL_UPDATED_AT)) {
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
                if ($this->isModified() && !$this->isColumnModified(SpyProductOptionGroupTableMap::COL_UPDATED_AT)) {
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

                SpyProductOptionGroupTableMap::addInstanceToPool($this);
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

            if ($this->aSpyTaxSet !== null) {
                if ($this->aSpyTaxSet->isModified() || $this->aSpyTaxSet->isNew()) {
                    $affectedRows += $this->aSpyTaxSet->save($con);
                }
                $this->setSpyTaxSet($this->aSpyTaxSet);
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

            if ($this->spyProductAbstractsScheduledForDeletion !== null) {
                if (!$this->spyProductAbstractsScheduledForDeletion->isEmpty()) {
                    $pks = [];
                    foreach ($this->spyProductAbstractsScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[1] = $this->getIdProductOptionGroup();
                        $entryPk[0] = $entry->getIdProductAbstract();
                        $pks[] = $entryPk;
                    }

                    \Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroupQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->spyProductAbstractsScheduledForDeletion = null;
                }

            }

            if ($this->collSpyProductAbstracts) {
                foreach ($this->collSpyProductAbstracts as $spyProductAbstract) {
                    if (!$spyProductAbstract->isDeleted() && ($spyProductAbstract->isNew() || $spyProductAbstract->isModified())) {
                        $spyProductAbstract->save($con);
                    }
                }
            }


            if ($this->spyMerchantProductOptionGroupsScheduledForDeletion !== null) {
                if (!$this->spyMerchantProductOptionGroupsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\MerchantProductOption\Persistence\SpyMerchantProductOptionGroupQuery::create()
                        ->filterByPrimaryKeys($this->spyMerchantProductOptionGroupsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyMerchantProductOptionGroupsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyMerchantProductOptionGroups !== null) {
                foreach ($this->collSpyMerchantProductOptionGroups as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductAbstractProductOptionGroupsScheduledForDeletion !== null) {
                if (!$this->spyProductAbstractProductOptionGroupsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroupQuery::create()
                        ->filterByPrimaryKeys($this->spyProductAbstractProductOptionGroupsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductAbstractProductOptionGroupsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductAbstractProductOptionGroups !== null) {
                foreach ($this->collSpyProductAbstractProductOptionGroups as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductOptionValuesScheduledForDeletion !== null) {
                if (!$this->spyProductOptionValuesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductOption\Persistence\SpyProductOptionValueQuery::create()
                        ->filterByPrimaryKeys($this->spyProductOptionValuesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductOptionValuesScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductOptionValues !== null) {
                foreach ($this->collSpyProductOptionValues as $referrerFK) {
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

        $this->modifiedColumns[SpyProductOptionGroupTableMap::COL_ID_PRODUCT_OPTION_GROUP] = true;

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyProductOptionGroupTableMap::COL_ID_PRODUCT_OPTION_GROUP)) {
            $modifiedColumns[':p' . $index++]  = '`id_product_option_group`';
        }
        if ($this->isColumnModified(SpyProductOptionGroupTableMap::COL_FK_TAX_SET)) {
            $modifiedColumns[':p' . $index++]  = '`fk_tax_set`';
        }
        if ($this->isColumnModified(SpyProductOptionGroupTableMap::COL_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`active`';
        }
        if ($this->isColumnModified(SpyProductOptionGroupTableMap::COL_KEY)) {
            $modifiedColumns[':p' . $index++]  = '`key`';
        }
        if ($this->isColumnModified(SpyProductOptionGroupTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(SpyProductOptionGroupTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(SpyProductOptionGroupTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }

        $sql = sprintf(
            'INSERT INTO `spy_product_option_group` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id_product_option_group`':
                        $stmt->bindValue($identifier, $this->id_product_option_group, PDO::PARAM_INT);

                        break;
                    case '`fk_tax_set`':
                        $stmt->bindValue($identifier, $this->fk_tax_set, PDO::PARAM_INT);

                        break;
                    case '`active`':
                        $stmt->bindValue($identifier, (int) $this->active, PDO::PARAM_INT);

                        break;
                    case '`key`':
                        $stmt->bindValue($identifier, $this->key, PDO::PARAM_STR);

                        break;
                    case '`name`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);

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
            $pk = $con->lastInsertId('spy_product_option_group_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        if ($pk !== null) {
            $this->setIdProductOptionGroup($pk);
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
        $pos = SpyProductOptionGroupTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdProductOptionGroup();

            case 1:
                return $this->getFkTaxSet();

            case 2:
                return $this->getActive();

            case 3:
                return $this->getKey();

            case 4:
                return $this->getName();

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
        if (isset($alreadyDumpedObjects['SpyProductOptionGroup'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyProductOptionGroup'][$this->hashCode()] = true;
        $keys = SpyProductOptionGroupTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdProductOptionGroup(),
            $keys[1] => $this->getFkTaxSet(),
            $keys[2] => $this->getActive(),
            $keys[3] => $this->getKey(),
            $keys[4] => $this->getName(),
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
            if (null !== $this->aSpyTaxSet) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyTaxSet';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_tax_set';
                        break;
                    default:
                        $key = 'SpyTaxSet';
                }

                $result[$key] = $this->aSpyTaxSet->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collSpyMerchantProductOptionGroups) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchantProductOptionGroups';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant_product_option_groups';
                        break;
                    default:
                        $key = 'SpyMerchantProductOptionGroups';
                }

                $result[$key] = $this->collSpyMerchantProductOptionGroups->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductAbstractProductOptionGroups) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductAbstractProductOptionGroups';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_abstract_product_option_groups';
                        break;
                    default:
                        $key = 'SpyProductAbstractProductOptionGroups';
                }

                $result[$key] = $this->collSpyProductAbstractProductOptionGroups->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductOptionValues) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductOptionValues';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_option_values';
                        break;
                    default:
                        $key = 'SpyProductOptionValues';
                }

                $result[$key] = $this->collSpyProductOptionValues->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyProductOptionGroupTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdProductOptionGroup($value);
                break;
            case 1:
                $this->setFkTaxSet($value);
                break;
            case 2:
                $this->setActive($value);
                break;
            case 3:
                $this->setKey($value);
                break;
            case 4:
                $this->setName($value);
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
        $keys = SpyProductOptionGroupTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdProductOptionGroup($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkTaxSet($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setActive($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setKey($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setName($arr[$keys[4]]);
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
        $criteria = new Criteria(SpyProductOptionGroupTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyProductOptionGroupTableMap::COL_ID_PRODUCT_OPTION_GROUP)) {
            $criteria->add(SpyProductOptionGroupTableMap::COL_ID_PRODUCT_OPTION_GROUP, $this->id_product_option_group);
        }
        if ($this->isColumnModified(SpyProductOptionGroupTableMap::COL_FK_TAX_SET)) {
            $criteria->add(SpyProductOptionGroupTableMap::COL_FK_TAX_SET, $this->fk_tax_set);
        }
        if ($this->isColumnModified(SpyProductOptionGroupTableMap::COL_ACTIVE)) {
            $criteria->add(SpyProductOptionGroupTableMap::COL_ACTIVE, $this->active);
        }
        if ($this->isColumnModified(SpyProductOptionGroupTableMap::COL_KEY)) {
            $criteria->add(SpyProductOptionGroupTableMap::COL_KEY, $this->key);
        }
        if ($this->isColumnModified(SpyProductOptionGroupTableMap::COL_NAME)) {
            $criteria->add(SpyProductOptionGroupTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(SpyProductOptionGroupTableMap::COL_CREATED_AT)) {
            $criteria->add(SpyProductOptionGroupTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpyProductOptionGroupTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpyProductOptionGroupTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildSpyProductOptionGroupQuery::create();
        $criteria->add(SpyProductOptionGroupTableMap::COL_ID_PRODUCT_OPTION_GROUP, $this->id_product_option_group);

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
        $validPk = null !== $this->getIdProductOptionGroup();

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
        return $this->getIdProductOptionGroup();
    }

    /**
     * Generic method to set the primary key (id_product_option_group column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdProductOptionGroup($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdProductOptionGroup();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\ProductOption\Persistence\SpyProductOptionGroup (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkTaxSet($this->getFkTaxSet());
        $copyObj->setActive($this->getActive());
        $copyObj->setKey($this->getKey());
        $copyObj->setName($this->getName());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyMerchantProductOptionGroups() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyMerchantProductOptionGroup($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductAbstractProductOptionGroups() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductAbstractProductOptionGroup($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductOptionValues() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductOptionValue($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdProductOptionGroup(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\ProductOption\Persistence\SpyProductOptionGroup Clone of current object.
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
     * Declares an association between this object and a SpyTaxSet object.
     *
     * @param SpyTaxSet|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setSpyTaxSet(SpyTaxSet $v = null)
    {
        if ($v === null) {
            $this->setFkTaxSet(NULL);
        } else {
            $this->setFkTaxSet($v->getIdTaxSet());
        }

        $this->aSpyTaxSet = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyTaxSet object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyProductOptionGroup($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyTaxSet object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyTaxSet|null The associated SpyTaxSet object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyTaxSet(?ConnectionInterface $con = null)
    {
        if ($this->aSpyTaxSet === null && ($this->fk_tax_set != 0)) {
            $this->aSpyTaxSet = SpyTaxSetQuery::create()->findPk($this->fk_tax_set, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSpyTaxSet->addSpyProductOptionGroups($this);
             */
        }

        return $this->aSpyTaxSet;
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
        if ('SpyMerchantProductOptionGroup' === $relationName) {
            $this->initSpyMerchantProductOptionGroups();
            return;
        }
        if ('SpyProductAbstractProductOptionGroup' === $relationName) {
            $this->initSpyProductAbstractProductOptionGroups();
            return;
        }
        if ('SpyProductOptionValue' === $relationName) {
            $this->initSpyProductOptionValues();
            return;
        }
    }

    /**
     * Clears out the collSpyMerchantProductOptionGroups collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyMerchantProductOptionGroups()
     */
    public function clearSpyMerchantProductOptionGroups()
    {
        $this->collSpyMerchantProductOptionGroups = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyMerchantProductOptionGroups collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyMerchantProductOptionGroups($v = true): void
    {
        $this->collSpyMerchantProductOptionGroupsPartial = $v;
    }

    /**
     * Initializes the collSpyMerchantProductOptionGroups collection.
     *
     * By default this just sets the collSpyMerchantProductOptionGroups collection to an empty array (like clearcollSpyMerchantProductOptionGroups());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyMerchantProductOptionGroups(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyMerchantProductOptionGroups && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyMerchantProductOptionGroupTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyMerchantProductOptionGroups = new $collectionClassName;
        $this->collSpyMerchantProductOptionGroups->setModel('\Orm\Zed\MerchantProductOption\Persistence\SpyMerchantProductOptionGroup');
    }

    /**
     * Gets an array of SpyMerchantProductOptionGroup objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductOptionGroup is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyMerchantProductOptionGroup[] List of SpyMerchantProductOptionGroup objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantProductOptionGroup> List of SpyMerchantProductOptionGroup objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyMerchantProductOptionGroups(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyMerchantProductOptionGroupsPartial && !$this->isNew();
        if (null === $this->collSpyMerchantProductOptionGroups || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyMerchantProductOptionGroups) {
                    $this->initSpyMerchantProductOptionGroups();
                } else {
                    $collectionClassName = SpyMerchantProductOptionGroupTableMap::getTableMap()->getCollectionClassName();

                    $collSpyMerchantProductOptionGroups = new $collectionClassName;
                    $collSpyMerchantProductOptionGroups->setModel('\Orm\Zed\MerchantProductOption\Persistence\SpyMerchantProductOptionGroup');

                    return $collSpyMerchantProductOptionGroups;
                }
            } else {
                $collSpyMerchantProductOptionGroups = SpyMerchantProductOptionGroupQuery::create(null, $criteria)
                    ->filterBySpyProductOptionGroup($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyMerchantProductOptionGroupsPartial && count($collSpyMerchantProductOptionGroups)) {
                        $this->initSpyMerchantProductOptionGroups(false);

                        foreach ($collSpyMerchantProductOptionGroups as $obj) {
                            if (false == $this->collSpyMerchantProductOptionGroups->contains($obj)) {
                                $this->collSpyMerchantProductOptionGroups->append($obj);
                            }
                        }

                        $this->collSpyMerchantProductOptionGroupsPartial = true;
                    }

                    return $collSpyMerchantProductOptionGroups;
                }

                if ($partial && $this->collSpyMerchantProductOptionGroups) {
                    foreach ($this->collSpyMerchantProductOptionGroups as $obj) {
                        if ($obj->isNew()) {
                            $collSpyMerchantProductOptionGroups[] = $obj;
                        }
                    }
                }

                $this->collSpyMerchantProductOptionGroups = $collSpyMerchantProductOptionGroups;
                $this->collSpyMerchantProductOptionGroupsPartial = false;
            }
        }

        return $this->collSpyMerchantProductOptionGroups;
    }

    /**
     * Sets a collection of SpyMerchantProductOptionGroup objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyMerchantProductOptionGroups A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyMerchantProductOptionGroups(Collection $spyMerchantProductOptionGroups, ?ConnectionInterface $con = null)
    {
        /** @var SpyMerchantProductOptionGroup[] $spyMerchantProductOptionGroupsToDelete */
        $spyMerchantProductOptionGroupsToDelete = $this->getSpyMerchantProductOptionGroups(new Criteria(), $con)->diff($spyMerchantProductOptionGroups);


        $this->spyMerchantProductOptionGroupsScheduledForDeletion = $spyMerchantProductOptionGroupsToDelete;

        foreach ($spyMerchantProductOptionGroupsToDelete as $spyMerchantProductOptionGroupRemoved) {
            $spyMerchantProductOptionGroupRemoved->setSpyProductOptionGroup(null);
        }

        $this->collSpyMerchantProductOptionGroups = null;
        foreach ($spyMerchantProductOptionGroups as $spyMerchantProductOptionGroup) {
            $this->addSpyMerchantProductOptionGroup($spyMerchantProductOptionGroup);
        }

        $this->collSpyMerchantProductOptionGroups = $spyMerchantProductOptionGroups;
        $this->collSpyMerchantProductOptionGroupsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyMerchantProductOptionGroup objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyMerchantProductOptionGroup objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyMerchantProductOptionGroups(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyMerchantProductOptionGroupsPartial && !$this->isNew();
        if (null === $this->collSpyMerchantProductOptionGroups || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyMerchantProductOptionGroups) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyMerchantProductOptionGroups());
            }

            $query = SpyMerchantProductOptionGroupQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductOptionGroup($this)
                ->count($con);
        }

        return count($this->collSpyMerchantProductOptionGroups);
    }

    /**
     * Method called to associate a SpyMerchantProductOptionGroup object to this object
     * through the SpyMerchantProductOptionGroup foreign key attribute.
     *
     * @param SpyMerchantProductOptionGroup $l SpyMerchantProductOptionGroup
     * @return $this The current object (for fluent API support)
     */
    public function addSpyMerchantProductOptionGroup(SpyMerchantProductOptionGroup $l)
    {
        if ($this->collSpyMerchantProductOptionGroups === null) {
            $this->initSpyMerchantProductOptionGroups();
            $this->collSpyMerchantProductOptionGroupsPartial = true;
        }

        if (!$this->collSpyMerchantProductOptionGroups->contains($l)) {
            $this->doAddSpyMerchantProductOptionGroup($l);

            if ($this->spyMerchantProductOptionGroupsScheduledForDeletion and $this->spyMerchantProductOptionGroupsScheduledForDeletion->contains($l)) {
                $this->spyMerchantProductOptionGroupsScheduledForDeletion->remove($this->spyMerchantProductOptionGroupsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyMerchantProductOptionGroup $spyMerchantProductOptionGroup The SpyMerchantProductOptionGroup object to add.
     */
    protected function doAddSpyMerchantProductOptionGroup(SpyMerchantProductOptionGroup $spyMerchantProductOptionGroup): void
    {
        $this->collSpyMerchantProductOptionGroups[]= $spyMerchantProductOptionGroup;
        $spyMerchantProductOptionGroup->setSpyProductOptionGroup($this);
    }

    /**
     * @param SpyMerchantProductOptionGroup $spyMerchantProductOptionGroup The SpyMerchantProductOptionGroup object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyMerchantProductOptionGroup(SpyMerchantProductOptionGroup $spyMerchantProductOptionGroup)
    {
        if ($this->getSpyMerchantProductOptionGroups()->contains($spyMerchantProductOptionGroup)) {
            $pos = $this->collSpyMerchantProductOptionGroups->search($spyMerchantProductOptionGroup);
            $this->collSpyMerchantProductOptionGroups->remove($pos);
            if (null === $this->spyMerchantProductOptionGroupsScheduledForDeletion) {
                $this->spyMerchantProductOptionGroupsScheduledForDeletion = clone $this->collSpyMerchantProductOptionGroups;
                $this->spyMerchantProductOptionGroupsScheduledForDeletion->clear();
            }
            $this->spyMerchantProductOptionGroupsScheduledForDeletion[]= clone $spyMerchantProductOptionGroup;
            $spyMerchantProductOptionGroup->setSpyProductOptionGroup(null);
        }

        return $this;
    }

    /**
     * Clears out the collSpyProductAbstractProductOptionGroups collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductAbstractProductOptionGroups()
     */
    public function clearSpyProductAbstractProductOptionGroups()
    {
        $this->collSpyProductAbstractProductOptionGroups = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductAbstractProductOptionGroups collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductAbstractProductOptionGroups($v = true): void
    {
        $this->collSpyProductAbstractProductOptionGroupsPartial = $v;
    }

    /**
     * Initializes the collSpyProductAbstractProductOptionGroups collection.
     *
     * By default this just sets the collSpyProductAbstractProductOptionGroups collection to an empty array (like clearcollSpyProductAbstractProductOptionGroups());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductAbstractProductOptionGroups(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductAbstractProductOptionGroups && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductAbstractProductOptionGroupTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductAbstractProductOptionGroups = new $collectionClassName;
        $this->collSpyProductAbstractProductOptionGroups->setModel('\Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroup');
    }

    /**
     * Gets an array of ChildSpyProductAbstractProductOptionGroup objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductOptionGroup is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyProductAbstractProductOptionGroup[] List of ChildSpyProductAbstractProductOptionGroup objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyProductAbstractProductOptionGroup> List of ChildSpyProductAbstractProductOptionGroup objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductAbstractProductOptionGroups(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductAbstractProductOptionGroupsPartial && !$this->isNew();
        if (null === $this->collSpyProductAbstractProductOptionGroups || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductAbstractProductOptionGroups) {
                    $this->initSpyProductAbstractProductOptionGroups();
                } else {
                    $collectionClassName = SpyProductAbstractProductOptionGroupTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductAbstractProductOptionGroups = new $collectionClassName;
                    $collSpyProductAbstractProductOptionGroups->setModel('\Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroup');

                    return $collSpyProductAbstractProductOptionGroups;
                }
            } else {
                $collSpyProductAbstractProductOptionGroups = ChildSpyProductAbstractProductOptionGroupQuery::create(null, $criteria)
                    ->filterBySpyProductOptionGroup($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductAbstractProductOptionGroupsPartial && count($collSpyProductAbstractProductOptionGroups)) {
                        $this->initSpyProductAbstractProductOptionGroups(false);

                        foreach ($collSpyProductAbstractProductOptionGroups as $obj) {
                            if (false == $this->collSpyProductAbstractProductOptionGroups->contains($obj)) {
                                $this->collSpyProductAbstractProductOptionGroups->append($obj);
                            }
                        }

                        $this->collSpyProductAbstractProductOptionGroupsPartial = true;
                    }

                    return $collSpyProductAbstractProductOptionGroups;
                }

                if ($partial && $this->collSpyProductAbstractProductOptionGroups) {
                    foreach ($this->collSpyProductAbstractProductOptionGroups as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductAbstractProductOptionGroups[] = $obj;
                        }
                    }
                }

                $this->collSpyProductAbstractProductOptionGroups = $collSpyProductAbstractProductOptionGroups;
                $this->collSpyProductAbstractProductOptionGroupsPartial = false;
            }
        }

        return $this->collSpyProductAbstractProductOptionGroups;
    }

    /**
     * Sets a collection of ChildSpyProductAbstractProductOptionGroup objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductAbstractProductOptionGroups A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductAbstractProductOptionGroups(Collection $spyProductAbstractProductOptionGroups, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyProductAbstractProductOptionGroup[] $spyProductAbstractProductOptionGroupsToDelete */
        $spyProductAbstractProductOptionGroupsToDelete = $this->getSpyProductAbstractProductOptionGroups(new Criteria(), $con)->diff($spyProductAbstractProductOptionGroups);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->spyProductAbstractProductOptionGroupsScheduledForDeletion = clone $spyProductAbstractProductOptionGroupsToDelete;

        foreach ($spyProductAbstractProductOptionGroupsToDelete as $spyProductAbstractProductOptionGroupRemoved) {
            $spyProductAbstractProductOptionGroupRemoved->setSpyProductOptionGroup(null);
        }

        $this->collSpyProductAbstractProductOptionGroups = null;
        foreach ($spyProductAbstractProductOptionGroups as $spyProductAbstractProductOptionGroup) {
            $this->addSpyProductAbstractProductOptionGroup($spyProductAbstractProductOptionGroup);
        }

        $this->collSpyProductAbstractProductOptionGroups = $spyProductAbstractProductOptionGroups;
        $this->collSpyProductAbstractProductOptionGroupsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyProductAbstractProductOptionGroup objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyProductAbstractProductOptionGroup objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductAbstractProductOptionGroups(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductAbstractProductOptionGroupsPartial && !$this->isNew();
        if (null === $this->collSpyProductAbstractProductOptionGroups || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductAbstractProductOptionGroups) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductAbstractProductOptionGroups());
            }

            $query = ChildSpyProductAbstractProductOptionGroupQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductOptionGroup($this)
                ->count($con);
        }

        return count($this->collSpyProductAbstractProductOptionGroups);
    }

    /**
     * Method called to associate a ChildSpyProductAbstractProductOptionGroup object to this object
     * through the ChildSpyProductAbstractProductOptionGroup foreign key attribute.
     *
     * @param ChildSpyProductAbstractProductOptionGroup $l ChildSpyProductAbstractProductOptionGroup
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductAbstractProductOptionGroup(ChildSpyProductAbstractProductOptionGroup $l)
    {
        if ($this->collSpyProductAbstractProductOptionGroups === null) {
            $this->initSpyProductAbstractProductOptionGroups();
            $this->collSpyProductAbstractProductOptionGroupsPartial = true;
        }

        if (!$this->collSpyProductAbstractProductOptionGroups->contains($l)) {
            $this->doAddSpyProductAbstractProductOptionGroup($l);

            if ($this->spyProductAbstractProductOptionGroupsScheduledForDeletion and $this->spyProductAbstractProductOptionGroupsScheduledForDeletion->contains($l)) {
                $this->spyProductAbstractProductOptionGroupsScheduledForDeletion->remove($this->spyProductAbstractProductOptionGroupsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyProductAbstractProductOptionGroup $spyProductAbstractProductOptionGroup The ChildSpyProductAbstractProductOptionGroup object to add.
     */
    protected function doAddSpyProductAbstractProductOptionGroup(ChildSpyProductAbstractProductOptionGroup $spyProductAbstractProductOptionGroup): void
    {
        $this->collSpyProductAbstractProductOptionGroups[]= $spyProductAbstractProductOptionGroup;
        $spyProductAbstractProductOptionGroup->setSpyProductOptionGroup($this);
    }

    /**
     * @param ChildSpyProductAbstractProductOptionGroup $spyProductAbstractProductOptionGroup The ChildSpyProductAbstractProductOptionGroup object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductAbstractProductOptionGroup(ChildSpyProductAbstractProductOptionGroup $spyProductAbstractProductOptionGroup)
    {
        if ($this->getSpyProductAbstractProductOptionGroups()->contains($spyProductAbstractProductOptionGroup)) {
            $pos = $this->collSpyProductAbstractProductOptionGroups->search($spyProductAbstractProductOptionGroup);
            $this->collSpyProductAbstractProductOptionGroups->remove($pos);
            if (null === $this->spyProductAbstractProductOptionGroupsScheduledForDeletion) {
                $this->spyProductAbstractProductOptionGroupsScheduledForDeletion = clone $this->collSpyProductAbstractProductOptionGroups;
                $this->spyProductAbstractProductOptionGroupsScheduledForDeletion->clear();
            }
            $this->spyProductAbstractProductOptionGroupsScheduledForDeletion[]= clone $spyProductAbstractProductOptionGroup;
            $spyProductAbstractProductOptionGroup->setSpyProductOptionGroup(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductOptionGroup is new, it will return
     * an empty collection; or if this SpyProductOptionGroup has previously
     * been saved, it will retrieve related SpyProductAbstractProductOptionGroups from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductOptionGroup.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyProductAbstractProductOptionGroup[] List of ChildSpyProductAbstractProductOptionGroup objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyProductAbstractProductOptionGroup}> List of ChildSpyProductAbstractProductOptionGroup objects
     */
    public function getSpyProductAbstractProductOptionGroupsJoinSpyProductAbstract(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyProductAbstractProductOptionGroupQuery::create(null, $criteria);
        $query->joinWith('SpyProductAbstract', $joinBehavior);

        return $this->getSpyProductAbstractProductOptionGroups($query, $con);
    }

    /**
     * Clears out the collSpyProductOptionValues collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductOptionValues()
     */
    public function clearSpyProductOptionValues()
    {
        $this->collSpyProductOptionValues = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductOptionValues collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductOptionValues($v = true): void
    {
        $this->collSpyProductOptionValuesPartial = $v;
    }

    /**
     * Initializes the collSpyProductOptionValues collection.
     *
     * By default this just sets the collSpyProductOptionValues collection to an empty array (like clearcollSpyProductOptionValues());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductOptionValues(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductOptionValues && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductOptionValueTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductOptionValues = new $collectionClassName;
        $this->collSpyProductOptionValues->setModel('\Orm\Zed\ProductOption\Persistence\SpyProductOptionValue');
    }

    /**
     * Gets an array of ChildSpyProductOptionValue objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductOptionGroup is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyProductOptionValue[] List of ChildSpyProductOptionValue objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyProductOptionValue> List of ChildSpyProductOptionValue objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductOptionValues(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductOptionValuesPartial && !$this->isNew();
        if (null === $this->collSpyProductOptionValues || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductOptionValues) {
                    $this->initSpyProductOptionValues();
                } else {
                    $collectionClassName = SpyProductOptionValueTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductOptionValues = new $collectionClassName;
                    $collSpyProductOptionValues->setModel('\Orm\Zed\ProductOption\Persistence\SpyProductOptionValue');

                    return $collSpyProductOptionValues;
                }
            } else {
                $collSpyProductOptionValues = ChildSpyProductOptionValueQuery::create(null, $criteria)
                    ->filterBySpyProductOptionGroup($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductOptionValuesPartial && count($collSpyProductOptionValues)) {
                        $this->initSpyProductOptionValues(false);

                        foreach ($collSpyProductOptionValues as $obj) {
                            if (false == $this->collSpyProductOptionValues->contains($obj)) {
                                $this->collSpyProductOptionValues->append($obj);
                            }
                        }

                        $this->collSpyProductOptionValuesPartial = true;
                    }

                    return $collSpyProductOptionValues;
                }

                if ($partial && $this->collSpyProductOptionValues) {
                    foreach ($this->collSpyProductOptionValues as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductOptionValues[] = $obj;
                        }
                    }
                }

                $this->collSpyProductOptionValues = $collSpyProductOptionValues;
                $this->collSpyProductOptionValuesPartial = false;
            }
        }

        return $this->collSpyProductOptionValues;
    }

    /**
     * Sets a collection of ChildSpyProductOptionValue objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductOptionValues A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductOptionValues(Collection $spyProductOptionValues, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyProductOptionValue[] $spyProductOptionValuesToDelete */
        $spyProductOptionValuesToDelete = $this->getSpyProductOptionValues(new Criteria(), $con)->diff($spyProductOptionValues);


        $this->spyProductOptionValuesScheduledForDeletion = $spyProductOptionValuesToDelete;

        foreach ($spyProductOptionValuesToDelete as $spyProductOptionValueRemoved) {
            $spyProductOptionValueRemoved->setSpyProductOptionGroup(null);
        }

        $this->collSpyProductOptionValues = null;
        foreach ($spyProductOptionValues as $spyProductOptionValue) {
            $this->addSpyProductOptionValue($spyProductOptionValue);
        }

        $this->collSpyProductOptionValues = $spyProductOptionValues;
        $this->collSpyProductOptionValuesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyProductOptionValue objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyProductOptionValue objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductOptionValues(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductOptionValuesPartial && !$this->isNew();
        if (null === $this->collSpyProductOptionValues || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductOptionValues) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductOptionValues());
            }

            $query = ChildSpyProductOptionValueQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductOptionGroup($this)
                ->count($con);
        }

        return count($this->collSpyProductOptionValues);
    }

    /**
     * Method called to associate a ChildSpyProductOptionValue object to this object
     * through the ChildSpyProductOptionValue foreign key attribute.
     *
     * @param ChildSpyProductOptionValue $l ChildSpyProductOptionValue
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductOptionValue(ChildSpyProductOptionValue $l)
    {
        if ($this->collSpyProductOptionValues === null) {
            $this->initSpyProductOptionValues();
            $this->collSpyProductOptionValuesPartial = true;
        }

        if (!$this->collSpyProductOptionValues->contains($l)) {
            $this->doAddSpyProductOptionValue($l);

            if ($this->spyProductOptionValuesScheduledForDeletion and $this->spyProductOptionValuesScheduledForDeletion->contains($l)) {
                $this->spyProductOptionValuesScheduledForDeletion->remove($this->spyProductOptionValuesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyProductOptionValue $spyProductOptionValue The ChildSpyProductOptionValue object to add.
     */
    protected function doAddSpyProductOptionValue(ChildSpyProductOptionValue $spyProductOptionValue): void
    {
        $this->collSpyProductOptionValues[]= $spyProductOptionValue;
        $spyProductOptionValue->setSpyProductOptionGroup($this);
    }

    /**
     * @param ChildSpyProductOptionValue $spyProductOptionValue The ChildSpyProductOptionValue object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductOptionValue(ChildSpyProductOptionValue $spyProductOptionValue)
    {
        if ($this->getSpyProductOptionValues()->contains($spyProductOptionValue)) {
            $pos = $this->collSpyProductOptionValues->search($spyProductOptionValue);
            $this->collSpyProductOptionValues->remove($pos);
            if (null === $this->spyProductOptionValuesScheduledForDeletion) {
                $this->spyProductOptionValuesScheduledForDeletion = clone $this->collSpyProductOptionValues;
                $this->spyProductOptionValuesScheduledForDeletion->clear();
            }
            $this->spyProductOptionValuesScheduledForDeletion[]= clone $spyProductOptionValue;
            $spyProductOptionValue->setSpyProductOptionGroup(null);
        }

        return $this;
    }

    /**
     * Clears out the collSpyProductAbstracts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSpyProductAbstracts()
     */
    public function clearSpyProductAbstracts()
    {
        $this->collSpyProductAbstracts = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collSpyProductAbstracts crossRef collection.
     *
     * By default this just sets the collSpyProductAbstracts collection to an empty collection (like clearSpyProductAbstracts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initSpyProductAbstracts()
    {
        $collectionClassName = SpyProductAbstractProductOptionGroupTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductAbstracts = new $collectionClassName;
        $this->collSpyProductAbstractsPartial = true;
        $this->collSpyProductAbstracts->setModel('\Orm\Zed\Product\Persistence\SpyProductAbstract');
    }

    /**
     * Checks if the collSpyProductAbstracts collection is loaded.
     *
     * @return bool
     */
    public function isSpyProductAbstractsLoaded(): bool
    {
        return null !== $this->collSpyProductAbstracts;
    }

    /**
     * Gets a collection of SpyProductAbstract objects related by a many-to-many relationship
     * to the current object by way of the spy_product_abstract_product_option_group cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductOptionGroup is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|SpyProductAbstract[] List of SpyProductAbstract objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductAbstract> List of SpyProductAbstract objects
     */
    public function getSpyProductAbstracts(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductAbstractsPartial && !$this->isNew();
        if (null === $this->collSpyProductAbstracts || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductAbstracts) {
                    $this->initSpyProductAbstracts();
                }
            } else {

                $query = SpyProductAbstractQuery::create(null, $criteria)
                    ->filterBySpyProductOptionGroup($this);
                $collSpyProductAbstracts = $query->find($con);
                if (null !== $criteria) {
                    return $collSpyProductAbstracts;
                }

                if ($partial && $this->collSpyProductAbstracts) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collSpyProductAbstracts as $obj) {
                        if (!$collSpyProductAbstracts->contains($obj)) {
                            $collSpyProductAbstracts[] = $obj;
                        }
                    }
                }

                $this->collSpyProductAbstracts = $collSpyProductAbstracts;
                $this->collSpyProductAbstractsPartial = false;
            }
        }

        return $this->collSpyProductAbstracts;
    }

    /**
     * Sets a collection of SpyProductAbstract objects related by a many-to-many relationship
     * to the current object by way of the spy_product_abstract_product_option_group cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductAbstracts A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductAbstracts(Collection $spyProductAbstracts, ?ConnectionInterface $con = null)
    {
        $this->clearSpyProductAbstracts();
        $currentSpyProductAbstracts = $this->getSpyProductAbstracts();

        $spyProductAbstractsScheduledForDeletion = $currentSpyProductAbstracts->diff($spyProductAbstracts);

        foreach ($spyProductAbstractsScheduledForDeletion as $toDelete) {
            $this->removeSpyProductAbstract($toDelete);
        }

        foreach ($spyProductAbstracts as $spyProductAbstract) {
            if (!$currentSpyProductAbstracts->contains($spyProductAbstract)) {
                $this->doAddSpyProductAbstract($spyProductAbstract);
            }
        }

        $this->collSpyProductAbstractsPartial = false;
        $this->collSpyProductAbstracts = $spyProductAbstracts;

        return $this;
    }

    /**
     * Gets the number of SpyProductAbstract objects related by a many-to-many relationship
     * to the current object by way of the spy_product_abstract_product_option_group cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param bool $distinct Set to true to force count distinct
     * @param ConnectionInterface $con Optional connection object
     *
     * @return int The number of related SpyProductAbstract objects
     */
    public function countSpyProductAbstracts(?Criteria $criteria = null, $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductAbstractsPartial && !$this->isNew();
        if (null === $this->collSpyProductAbstracts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductAbstracts) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getSpyProductAbstracts());
                }

                $query = SpyProductAbstractQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterBySpyProductOptionGroup($this)
                    ->count($con);
            }
        } else {
            return count($this->collSpyProductAbstracts);
        }
    }

    /**
     * Associate a SpyProductAbstract to this object
     * through the spy_product_abstract_product_option_group cross reference table.
     *
     * @param SpyProductAbstract $spyProductAbstract
     * @return ChildSpyProductOptionGroup The current object (for fluent API support)
     */
    public function addSpyProductAbstract(SpyProductAbstract $spyProductAbstract)
    {
        if ($this->collSpyProductAbstracts === null) {
            $this->initSpyProductAbstracts();
        }

        if (!$this->getSpyProductAbstracts()->contains($spyProductAbstract)) {
            // only add it if the **same** object is not already associated
            $this->collSpyProductAbstracts->push($spyProductAbstract);
            $this->doAddSpyProductAbstract($spyProductAbstract);
        }

        return $this;
    }

    /**
     *
     * @param SpyProductAbstract $spyProductAbstract
     */
    protected function doAddSpyProductAbstract(SpyProductAbstract $spyProductAbstract)
    {
        $spyProductAbstractProductOptionGroup = new ChildSpyProductAbstractProductOptionGroup();

        $spyProductAbstractProductOptionGroup->setSpyProductAbstract($spyProductAbstract);

        $spyProductAbstractProductOptionGroup->setSpyProductOptionGroup($this);

        $this->addSpyProductAbstractProductOptionGroup($spyProductAbstractProductOptionGroup);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$spyProductAbstract->isSpyProductOptionGroupsLoaded()) {
            $spyProductAbstract->initSpyProductOptionGroups();
            $spyProductAbstract->getSpyProductOptionGroups()->push($this);
        } elseif (!$spyProductAbstract->getSpyProductOptionGroups()->contains($this)) {
            $spyProductAbstract->getSpyProductOptionGroups()->push($this);
        }

    }

    /**
     * Remove spyProductAbstract of this object
     * through the spy_product_abstract_product_option_group cross reference table.
     *
     * @param SpyProductAbstract $spyProductAbstract
     * @return ChildSpyProductOptionGroup The current object (for fluent API support)
     */
    public function removeSpyProductAbstract(SpyProductAbstract $spyProductAbstract)
    {
        if ($this->getSpyProductAbstracts()->contains($spyProductAbstract)) {
            $spyProductAbstractProductOptionGroup = new ChildSpyProductAbstractProductOptionGroup();
            $spyProductAbstractProductOptionGroup->setSpyProductAbstract($spyProductAbstract);
            if ($spyProductAbstract->isSpyProductOptionGroupsLoaded()) {
                //remove the back reference if available
                $spyProductAbstract->getSpyProductOptionGroups()->removeObject($this);
            }

            $spyProductAbstractProductOptionGroup->setSpyProductOptionGroup($this);
            $this->removeSpyProductAbstractProductOptionGroup(clone $spyProductAbstractProductOptionGroup);
            $spyProductAbstractProductOptionGroup->clear();

            $this->collSpyProductAbstracts->remove($this->collSpyProductAbstracts->search($spyProductAbstract));

            if (null === $this->spyProductAbstractsScheduledForDeletion) {
                $this->spyProductAbstractsScheduledForDeletion = clone $this->collSpyProductAbstracts;
                $this->spyProductAbstractsScheduledForDeletion->clear();
            }

            $this->spyProductAbstractsScheduledForDeletion->push($spyProductAbstract);
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
        if (null !== $this->aSpyTaxSet) {
            $this->aSpyTaxSet->removeSpyProductOptionGroup($this);
        }
        $this->id_product_option_group = null;
        $this->fk_tax_set = null;
        $this->active = null;
        $this->key = null;
        $this->name = null;
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
            if ($this->collSpyMerchantProductOptionGroups) {
                foreach ($this->collSpyMerchantProductOptionGroups as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductAbstractProductOptionGroups) {
                foreach ($this->collSpyProductAbstractProductOptionGroups as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductOptionValues) {
                foreach ($this->collSpyProductOptionValues as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductAbstracts) {
                foreach ($this->collSpyProductAbstracts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyMerchantProductOptionGroups = null;
        $this->collSpyProductAbstractProductOptionGroups = null;
        $this->collSpyProductOptionValues = null;
        $this->collSpyProductAbstracts = null;
        $this->aSpyTaxSet = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyProductOptionGroupTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return $this The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[SpyProductOptionGroupTableMap::COL_UPDATED_AT] = true;

        return $this;
    }

    // event behavior

    /**
     * @return void
     */
    protected function prepareSaveEventName()
    {
        if ($this->isNew()) {
            $this->_eventName = 'Entity.spy_product_option_group.create';
        } else {
            $this->_eventName = 'Entity.spy_product_option_group.update';
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

        if ($this->_eventName !== 'Entity.spy_product_option_group.create') {
            if (!$this->_isModified) {
                return;
            }

            if (!$this->isEventColumnsModified()) {
                return;
            }
        }

        $data = [
            'name' => 'spy_product_option_group',
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
            'name' => 'spy_product_option_group',
            'id' => !is_array($this->getPrimaryKey()) ? $this->getPrimaryKey() : null,
            'event' => 'Entity.spy_product_option_group.delete',
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
            $field = str_replace('spy_product_option_group.', '', $modifiedColumn);
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
            $field = str_replace('spy_product_option_group.', '', $additionalValueColumnName);
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
        $columnType = SpyProductOptionGroupTableMap::getTableMap()->getColumn($column)->getType();
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
