<?php

namespace Orm\Zed\ProductRelation\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\ProductRelation\Persistence\SpyProductRelation as ChildSpyProductRelation;
use Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstract as ChildSpyProductRelationProductAbstract;
use Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstractQuery as ChildSpyProductRelationProductAbstractQuery;
use Orm\Zed\ProductRelation\Persistence\SpyProductRelationQuery as ChildSpyProductRelationQuery;
use Orm\Zed\ProductRelation\Persistence\SpyProductRelationStore as ChildSpyProductRelationStore;
use Orm\Zed\ProductRelation\Persistence\SpyProductRelationStoreQuery as ChildSpyProductRelationStoreQuery;
use Orm\Zed\ProductRelation\Persistence\SpyProductRelationType as ChildSpyProductRelationType;
use Orm\Zed\ProductRelation\Persistence\SpyProductRelationTypeQuery as ChildSpyProductRelationTypeQuery;
use Orm\Zed\ProductRelation\Persistence\Map\SpyProductRelationProductAbstractTableMap;
use Orm\Zed\ProductRelation\Persistence\Map\SpyProductRelationStoreTableMap;
use Orm\Zed\ProductRelation\Persistence\Map\SpyProductRelationTableMap;
use Orm\Zed\Product\Persistence\SpyProductAbstract;
use Orm\Zed\Product\Persistence\SpyProductAbstractQuery;
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
 * Base class that represents a row from the 'spy_product_relation' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.ProductRelation.Persistence.Base
 */
abstract class SpyProductRelation implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\ProductRelation\\Persistence\\Map\\SpyProductRelationTableMap';


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
     * The value for the id_product_relation field.
     *
     * @var        int
     */
    protected $id_product_relation;

    /**
     * The value for the fk_product_abstract field.
     *
     * @var        int
     */
    protected $fk_product_abstract;

    /**
     * The value for the fk_product_relation_type field.
     *
     * @var        int
     */
    protected $fk_product_relation_type;

    /**
     * The value for the is_active field.
     * A boolean flag indicating if an entity is currently active.
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $is_active;

    /**
     * The value for the is_rebuild_scheduled field.
     * A flag indicating if a rebuild is scheduled for a product relation.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $is_rebuild_scheduled;

    /**
     * The value for the product_relation_key field.
     * A unique key for a product relation.
     * @var        string|null
     */
    protected $product_relation_key;

    /**
     * The value for the query_set_data field.
     * A JSON-encoded string representing the rule set for a product relation.
     * @var        string|null
     */
    protected $query_set_data;

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
     * @var        SpyProductAbstract
     */
    protected $aSpyProductAbstract;

    /**
     * @var        ChildSpyProductRelationType
     */
    protected $aSpyProductRelationType;

    /**
     * @var        ObjectCollection|ChildSpyProductRelationProductAbstract[] Collection to store aggregation of ChildSpyProductRelationProductAbstract objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyProductRelationProductAbstract> Collection to store aggregation of ChildSpyProductRelationProductAbstract objects.
     */
    protected $collSpyProductRelationProductAbstracts;
    protected $collSpyProductRelationProductAbstractsPartial;

    /**
     * @var        ObjectCollection|ChildSpyProductRelationStore[] Collection to store aggregation of ChildSpyProductRelationStore objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyProductRelationStore> Collection to store aggregation of ChildSpyProductRelationStore objects.
     */
    protected $collProductRelationStores;
    protected $collProductRelationStoresPartial;

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
        'spy_product_relation.fk_product_abstract' => 'fk_product_abstract',
        'spy_product_relation.fk_product_relation_type' => 'fk_product_relation_type',
    ];

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyProductRelationProductAbstract[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyProductRelationProductAbstract>
     */
    protected $spyProductRelationProductAbstractsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyProductRelationStore[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyProductRelationStore>
     */
    protected $productRelationStoresScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->is_active = true;
        $this->is_rebuild_scheduled = false;
    }

    /**
     * Initializes internal state of Orm\Zed\ProductRelation\Persistence\Base\SpyProductRelation object.
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
     * Compares this with another <code>SpyProductRelation</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyProductRelation</code>, delegates to
     * <code>equals(SpyProductRelation)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_product_relation] column value.
     *
     * @return int
     */
    public function getIdProductRelation()
    {
        return $this->id_product_relation;
    }

    /**
     * Get the [fk_product_abstract] column value.
     *
     * @return int
     */
    public function getFkProductAbstract()
    {
        return $this->fk_product_abstract;
    }

    /**
     * Get the [fk_product_relation_type] column value.
     *
     * @return int
     */
    public function getFkProductRelationType()
    {
        return $this->fk_product_relation_type;
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
     * Get the [is_rebuild_scheduled] column value.
     * A flag indicating if a rebuild is scheduled for a product relation.
     * @return boolean
     */
    public function getIsRebuildScheduled()
    {
        return $this->is_rebuild_scheduled;
    }

    /**
     * Get the [is_rebuild_scheduled] column value.
     * A flag indicating if a rebuild is scheduled for a product relation.
     * @return boolean
     */
    public function isRebuildScheduled()
    {
        return $this->getIsRebuildScheduled();
    }

    /**
     * Get the [product_relation_key] column value.
     * A unique key for a product relation.
     * @return string|null
     */
    public function getProductRelationKey()
    {
        return $this->product_relation_key;
    }

    /**
     * Get the [query_set_data] column value.
     * A JSON-encoded string representing the rule set for a product relation.
     * @return string|null
     */
    public function getQuerySetData()
    {
        return $this->query_set_data;
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
     * Set the value of [id_product_relation] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdProductRelation($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_product_relation !== $v) {
            $this->id_product_relation = $v;
            $this->modifiedColumns[SpyProductRelationTableMap::COL_ID_PRODUCT_RELATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_product_abstract] column.
     *
     * @param int $v New value
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
            $this->modifiedColumns[SpyProductRelationTableMap::COL_FK_PRODUCT_ABSTRACT] = true;
        }

        if ($this->aSpyProductAbstract !== null && $this->aSpyProductAbstract->getIdProductAbstract() !== $v) {
            $this->aSpyProductAbstract = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_product_relation_type] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkProductRelationType($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_product_relation_type !== $v) {
            $this->fk_product_relation_type = $v;
            $this->modifiedColumns[SpyProductRelationTableMap::COL_FK_PRODUCT_RELATION_TYPE] = true;
        }

        if ($this->aSpyProductRelationType !== null && $this->aSpyProductRelationType->getIdProductRelationType() !== $v) {
            $this->aSpyProductRelationType = null;
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
            $this->modifiedColumns[SpyProductRelationTableMap::COL_IS_ACTIVE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_rebuild_scheduled] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * A flag indicating if a rebuild is scheduled for a product relation.
     * @param bool|integer|string $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsRebuildScheduled($v)
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

        if (($this->isNew() && $hasDefaultValue) || $this->is_rebuild_scheduled !== $v) {
            $this->is_rebuild_scheduled = $v;
            $this->modifiedColumns[SpyProductRelationTableMap::COL_IS_REBUILD_SCHEDULED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [product_relation_key] column.
     * A unique key for a product relation.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProductRelationKey($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->product_relation_key !== $v) {
            $this->product_relation_key = $v;
            $this->modifiedColumns[SpyProductRelationTableMap::COL_PRODUCT_RELATION_KEY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [query_set_data] column.
     * A JSON-encoded string representing the rule set for a product relation.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setQuerySetData($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->query_set_data !== $v) {
            $this->query_set_data = $v;
            $this->modifiedColumns[SpyProductRelationTableMap::COL_QUERY_SET_DATA] = true;
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
                $this->modifiedColumns[SpyProductRelationTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SpyProductRelationTableMap::COL_UPDATED_AT] = true;
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
            if ($this->is_active !== true) {
                return false;
            }

            if ($this->is_rebuild_scheduled !== false) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyProductRelationTableMap::translateFieldName('IdProductRelation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_product_relation = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyProductRelationTableMap::translateFieldName('FkProductAbstract', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_product_abstract = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyProductRelationTableMap::translateFieldName('FkProductRelationType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_product_relation_type = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyProductRelationTableMap::translateFieldName('IsActive', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_active = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyProductRelationTableMap::translateFieldName('IsRebuildScheduled', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_rebuild_scheduled = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyProductRelationTableMap::translateFieldName('ProductRelationKey', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_relation_key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpyProductRelationTableMap::translateFieldName('QuerySetData', TableMap::TYPE_PHPNAME, $indexType)];
            $this->query_set_data = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpyProductRelationTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SpyProductRelationTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 9; // 9 = SpyProductRelationTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\ProductRelation\\Persistence\\SpyProductRelation'), 0, $e);
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
        if ($this->aSpyProductAbstract !== null && $this->fk_product_abstract !== $this->aSpyProductAbstract->getIdProductAbstract()) {
            $this->aSpyProductAbstract = null;
        }
        if ($this->aSpyProductRelationType !== null && $this->fk_product_relation_type !== $this->aSpyProductRelationType->getIdProductRelationType()) {
            $this->aSpyProductRelationType = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyProductRelationTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyProductRelationQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aSpyProductAbstract = null;
            $this->aSpyProductRelationType = null;
            $this->collSpyProductRelationProductAbstracts = null;

            $this->collProductRelationStores = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyProductRelation::setDeleted()
     * @see SpyProductRelation::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductRelationTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyProductRelationQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductRelationTableMap::DATABASE_NAME);
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
                if (!$this->isColumnModified(SpyProductRelationTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpyProductRelationTableMap::COL_UPDATED_AT)) {
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
                if ($this->isModified() && !$this->isColumnModified(SpyProductRelationTableMap::COL_UPDATED_AT)) {
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

                SpyProductRelationTableMap::addInstanceToPool($this);
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

            if ($this->aSpyProductAbstract !== null) {
                if ($this->aSpyProductAbstract->isModified() || $this->aSpyProductAbstract->isNew()) {
                    $affectedRows += $this->aSpyProductAbstract->save($con);
                }
                $this->setSpyProductAbstract($this->aSpyProductAbstract);
            }

            if ($this->aSpyProductRelationType !== null) {
                if ($this->aSpyProductRelationType->isModified() || $this->aSpyProductRelationType->isNew()) {
                    $affectedRows += $this->aSpyProductRelationType->save($con);
                }
                $this->setSpyProductRelationType($this->aSpyProductRelationType);
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

            if ($this->spyProductRelationProductAbstractsScheduledForDeletion !== null) {
                if (!$this->spyProductRelationProductAbstractsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstractQuery::create()
                        ->filterByPrimaryKeys($this->spyProductRelationProductAbstractsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductRelationProductAbstractsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductRelationProductAbstracts !== null) {
                foreach ($this->collSpyProductRelationProductAbstracts as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->productRelationStoresScheduledForDeletion !== null) {
                if (!$this->productRelationStoresScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductRelation\Persistence\SpyProductRelationStoreQuery::create()
                        ->filterByPrimaryKeys($this->productRelationStoresScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->productRelationStoresScheduledForDeletion = null;
                }
            }

            if ($this->collProductRelationStores !== null) {
                foreach ($this->collProductRelationStores as $referrerFK) {
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

        $this->modifiedColumns[SpyProductRelationTableMap::COL_ID_PRODUCT_RELATION] = true;

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyProductRelationTableMap::COL_ID_PRODUCT_RELATION)) {
            $modifiedColumns[':p' . $index++]  = '`id_product_relation`';
        }
        if ($this->isColumnModified(SpyProductRelationTableMap::COL_FK_PRODUCT_ABSTRACT)) {
            $modifiedColumns[':p' . $index++]  = '`fk_product_abstract`';
        }
        if ($this->isColumnModified(SpyProductRelationTableMap::COL_FK_PRODUCT_RELATION_TYPE)) {
            $modifiedColumns[':p' . $index++]  = '`fk_product_relation_type`';
        }
        if ($this->isColumnModified(SpyProductRelationTableMap::COL_IS_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`is_active`';
        }
        if ($this->isColumnModified(SpyProductRelationTableMap::COL_IS_REBUILD_SCHEDULED)) {
            $modifiedColumns[':p' . $index++]  = '`is_rebuild_scheduled`';
        }
        if ($this->isColumnModified(SpyProductRelationTableMap::COL_PRODUCT_RELATION_KEY)) {
            $modifiedColumns[':p' . $index++]  = '`product_relation_key`';
        }
        if ($this->isColumnModified(SpyProductRelationTableMap::COL_QUERY_SET_DATA)) {
            $modifiedColumns[':p' . $index++]  = '`query_set_data`';
        }
        if ($this->isColumnModified(SpyProductRelationTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(SpyProductRelationTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }

        $sql = sprintf(
            'INSERT INTO `spy_product_relation` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id_product_relation`':
                        $stmt->bindValue($identifier, $this->id_product_relation, PDO::PARAM_INT);

                        break;
                    case '`fk_product_abstract`':
                        $stmt->bindValue($identifier, $this->fk_product_abstract, PDO::PARAM_INT);

                        break;
                    case '`fk_product_relation_type`':
                        $stmt->bindValue($identifier, $this->fk_product_relation_type, PDO::PARAM_INT);

                        break;
                    case '`is_active`':
                        $stmt->bindValue($identifier, (int) $this->is_active, PDO::PARAM_INT);

                        break;
                    case '`is_rebuild_scheduled`':
                        $stmt->bindValue($identifier, (int) $this->is_rebuild_scheduled, PDO::PARAM_INT);

                        break;
                    case '`product_relation_key`':
                        $stmt->bindValue($identifier, $this->product_relation_key, PDO::PARAM_STR);

                        break;
                    case '`query_set_data`':
                        $stmt->bindValue($identifier, $this->query_set_data, PDO::PARAM_STR);

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
            $pk = $con->lastInsertId('spy_product_relation_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        if ($pk !== null) {
            $this->setIdProductRelation($pk);
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
        $pos = SpyProductRelationTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdProductRelation();

            case 1:
                return $this->getFkProductAbstract();

            case 2:
                return $this->getFkProductRelationType();

            case 3:
                return $this->getIsActive();

            case 4:
                return $this->getIsRebuildScheduled();

            case 5:
                return $this->getProductRelationKey();

            case 6:
                return $this->getQuerySetData();

            case 7:
                return $this->getCreatedAt();

            case 8:
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
        if (isset($alreadyDumpedObjects['SpyProductRelation'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyProductRelation'][$this->hashCode()] = true;
        $keys = SpyProductRelationTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdProductRelation(),
            $keys[1] => $this->getFkProductAbstract(),
            $keys[2] => $this->getFkProductRelationType(),
            $keys[3] => $this->getIsActive(),
            $keys[4] => $this->getIsRebuildScheduled(),
            $keys[5] => $this->getProductRelationKey(),
            $keys[6] => $this->getQuerySetData(),
            $keys[7] => $this->getCreatedAt(),
            $keys[8] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[7]] instanceof \DateTimeInterface) {
            $result[$keys[7]] = $result[$keys[7]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aSpyProductAbstract) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductAbstract';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_abstract';
                        break;
                    default:
                        $key = 'SpyProductAbstract';
                }

                $result[$key] = $this->aSpyProductAbstract->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aSpyProductRelationType) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductRelationType';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_relation_type';
                        break;
                    default:
                        $key = 'SpyProductRelationType';
                }

                $result[$key] = $this->aSpyProductRelationType->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collSpyProductRelationProductAbstracts) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductRelationProductAbstracts';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_relation_product_abstracts';
                        break;
                    default:
                        $key = 'SpyProductRelationProductAbstracts';
                }

                $result[$key] = $this->collSpyProductRelationProductAbstracts->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProductRelationStores) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductRelationStores';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_relation_stores';
                        break;
                    default:
                        $key = 'ProductRelationStores';
                }

                $result[$key] = $this->collProductRelationStores->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyProductRelationTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdProductRelation($value);
                break;
            case 1:
                $this->setFkProductAbstract($value);
                break;
            case 2:
                $this->setFkProductRelationType($value);
                break;
            case 3:
                $this->setIsActive($value);
                break;
            case 4:
                $this->setIsRebuildScheduled($value);
                break;
            case 5:
                $this->setProductRelationKey($value);
                break;
            case 6:
                $this->setQuerySetData($value);
                break;
            case 7:
                $this->setCreatedAt($value);
                break;
            case 8:
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
        $keys = SpyProductRelationTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdProductRelation($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkProductAbstract($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setFkProductRelationType($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setIsActive($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setIsRebuildScheduled($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setProductRelationKey($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setQuerySetData($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setCreatedAt($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setUpdatedAt($arr[$keys[8]]);
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
        $criteria = new Criteria(SpyProductRelationTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyProductRelationTableMap::COL_ID_PRODUCT_RELATION)) {
            $criteria->add(SpyProductRelationTableMap::COL_ID_PRODUCT_RELATION, $this->id_product_relation);
        }
        if ($this->isColumnModified(SpyProductRelationTableMap::COL_FK_PRODUCT_ABSTRACT)) {
            $criteria->add(SpyProductRelationTableMap::COL_FK_PRODUCT_ABSTRACT, $this->fk_product_abstract);
        }
        if ($this->isColumnModified(SpyProductRelationTableMap::COL_FK_PRODUCT_RELATION_TYPE)) {
            $criteria->add(SpyProductRelationTableMap::COL_FK_PRODUCT_RELATION_TYPE, $this->fk_product_relation_type);
        }
        if ($this->isColumnModified(SpyProductRelationTableMap::COL_IS_ACTIVE)) {
            $criteria->add(SpyProductRelationTableMap::COL_IS_ACTIVE, $this->is_active);
        }
        if ($this->isColumnModified(SpyProductRelationTableMap::COL_IS_REBUILD_SCHEDULED)) {
            $criteria->add(SpyProductRelationTableMap::COL_IS_REBUILD_SCHEDULED, $this->is_rebuild_scheduled);
        }
        if ($this->isColumnModified(SpyProductRelationTableMap::COL_PRODUCT_RELATION_KEY)) {
            $criteria->add(SpyProductRelationTableMap::COL_PRODUCT_RELATION_KEY, $this->product_relation_key);
        }
        if ($this->isColumnModified(SpyProductRelationTableMap::COL_QUERY_SET_DATA)) {
            $criteria->add(SpyProductRelationTableMap::COL_QUERY_SET_DATA, $this->query_set_data);
        }
        if ($this->isColumnModified(SpyProductRelationTableMap::COL_CREATED_AT)) {
            $criteria->add(SpyProductRelationTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpyProductRelationTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpyProductRelationTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildSpyProductRelationQuery::create();
        $criteria->add(SpyProductRelationTableMap::COL_ID_PRODUCT_RELATION, $this->id_product_relation);

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
        $validPk = null !== $this->getIdProductRelation();

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
        return $this->getIdProductRelation();
    }

    /**
     * Generic method to set the primary key (id_product_relation column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdProductRelation($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdProductRelation();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\ProductRelation\Persistence\SpyProductRelation (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkProductAbstract($this->getFkProductAbstract());
        $copyObj->setFkProductRelationType($this->getFkProductRelationType());
        $copyObj->setIsActive($this->getIsActive());
        $copyObj->setIsRebuildScheduled($this->getIsRebuildScheduled());
        $copyObj->setProductRelationKey($this->getProductRelationKey());
        $copyObj->setQuerySetData($this->getQuerySetData());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyProductRelationProductAbstracts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductRelationProductAbstract($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProductRelationStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductRelationStore($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdProductRelation(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\ProductRelation\Persistence\SpyProductRelation Clone of current object.
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
     * Declares an association between this object and a SpyProductAbstract object.
     *
     * @param SpyProductAbstract $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setSpyProductAbstract(SpyProductAbstract $v = null)
    {
        if ($v === null) {
            $this->setFkProductAbstract(NULL);
        } else {
            $this->setFkProductAbstract($v->getIdProductAbstract());
        }

        $this->aSpyProductAbstract = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyProductAbstract object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyProductRelation($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyProductAbstract object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyProductAbstract The associated SpyProductAbstract object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductAbstract(?ConnectionInterface $con = null)
    {
        if ($this->aSpyProductAbstract === null && ($this->fk_product_abstract != 0)) {
            $this->aSpyProductAbstract = SpyProductAbstractQuery::create()->findPk($this->fk_product_abstract, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSpyProductAbstract->addSpyProductRelations($this);
             */
        }

        return $this->aSpyProductAbstract;
    }

    /**
     * Declares an association between this object and a ChildSpyProductRelationType object.
     *
     * @param ChildSpyProductRelationType $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setSpyProductRelationType(ChildSpyProductRelationType $v = null)
    {
        if ($v === null) {
            $this->setFkProductRelationType(NULL);
        } else {
            $this->setFkProductRelationType($v->getIdProductRelationType());
        }

        $this->aSpyProductRelationType = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpyProductRelationType object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyProductRelation($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpyProductRelationType object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSpyProductRelationType The associated ChildSpyProductRelationType object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductRelationType(?ConnectionInterface $con = null)
    {
        if ($this->aSpyProductRelationType === null && ($this->fk_product_relation_type != 0)) {
            $this->aSpyProductRelationType = ChildSpyProductRelationTypeQuery::create()->findPk($this->fk_product_relation_type, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSpyProductRelationType->addSpyProductRelations($this);
             */
        }

        return $this->aSpyProductRelationType;
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
        if ('SpyProductRelationProductAbstract' === $relationName) {
            $this->initSpyProductRelationProductAbstracts();
            return;
        }
        if ('ProductRelationStore' === $relationName) {
            $this->initProductRelationStores();
            return;
        }
    }

    /**
     * Clears out the collSpyProductRelationProductAbstracts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductRelationProductAbstracts()
     */
    public function clearSpyProductRelationProductAbstracts()
    {
        $this->collSpyProductRelationProductAbstracts = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductRelationProductAbstracts collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductRelationProductAbstracts($v = true): void
    {
        $this->collSpyProductRelationProductAbstractsPartial = $v;
    }

    /**
     * Initializes the collSpyProductRelationProductAbstracts collection.
     *
     * By default this just sets the collSpyProductRelationProductAbstracts collection to an empty array (like clearcollSpyProductRelationProductAbstracts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductRelationProductAbstracts(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductRelationProductAbstracts && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductRelationProductAbstractTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductRelationProductAbstracts = new $collectionClassName;
        $this->collSpyProductRelationProductAbstracts->setModel('\Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstract');
    }

    /**
     * Gets an array of ChildSpyProductRelationProductAbstract objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductRelation is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyProductRelationProductAbstract[] List of ChildSpyProductRelationProductAbstract objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyProductRelationProductAbstract> List of ChildSpyProductRelationProductAbstract objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductRelationProductAbstracts(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductRelationProductAbstractsPartial && !$this->isNew();
        if (null === $this->collSpyProductRelationProductAbstracts || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductRelationProductAbstracts) {
                    $this->initSpyProductRelationProductAbstracts();
                } else {
                    $collectionClassName = SpyProductRelationProductAbstractTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductRelationProductAbstracts = new $collectionClassName;
                    $collSpyProductRelationProductAbstracts->setModel('\Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstract');

                    return $collSpyProductRelationProductAbstracts;
                }
            } else {
                $collSpyProductRelationProductAbstracts = ChildSpyProductRelationProductAbstractQuery::create(null, $criteria)
                    ->filterBySpyProductRelation($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductRelationProductAbstractsPartial && count($collSpyProductRelationProductAbstracts)) {
                        $this->initSpyProductRelationProductAbstracts(false);

                        foreach ($collSpyProductRelationProductAbstracts as $obj) {
                            if (false == $this->collSpyProductRelationProductAbstracts->contains($obj)) {
                                $this->collSpyProductRelationProductAbstracts->append($obj);
                            }
                        }

                        $this->collSpyProductRelationProductAbstractsPartial = true;
                    }

                    return $collSpyProductRelationProductAbstracts;
                }

                if ($partial && $this->collSpyProductRelationProductAbstracts) {
                    foreach ($this->collSpyProductRelationProductAbstracts as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductRelationProductAbstracts[] = $obj;
                        }
                    }
                }

                $this->collSpyProductRelationProductAbstracts = $collSpyProductRelationProductAbstracts;
                $this->collSpyProductRelationProductAbstractsPartial = false;
            }
        }

        return $this->collSpyProductRelationProductAbstracts;
    }

    /**
     * Sets a collection of ChildSpyProductRelationProductAbstract objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductRelationProductAbstracts A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductRelationProductAbstracts(Collection $spyProductRelationProductAbstracts, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyProductRelationProductAbstract[] $spyProductRelationProductAbstractsToDelete */
        $spyProductRelationProductAbstractsToDelete = $this->getSpyProductRelationProductAbstracts(new Criteria(), $con)->diff($spyProductRelationProductAbstracts);


        $this->spyProductRelationProductAbstractsScheduledForDeletion = $spyProductRelationProductAbstractsToDelete;

        foreach ($spyProductRelationProductAbstractsToDelete as $spyProductRelationProductAbstractRemoved) {
            $spyProductRelationProductAbstractRemoved->setSpyProductRelation(null);
        }

        $this->collSpyProductRelationProductAbstracts = null;
        foreach ($spyProductRelationProductAbstracts as $spyProductRelationProductAbstract) {
            $this->addSpyProductRelationProductAbstract($spyProductRelationProductAbstract);
        }

        $this->collSpyProductRelationProductAbstracts = $spyProductRelationProductAbstracts;
        $this->collSpyProductRelationProductAbstractsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyProductRelationProductAbstract objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyProductRelationProductAbstract objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductRelationProductAbstracts(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductRelationProductAbstractsPartial && !$this->isNew();
        if (null === $this->collSpyProductRelationProductAbstracts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductRelationProductAbstracts) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductRelationProductAbstracts());
            }

            $query = ChildSpyProductRelationProductAbstractQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductRelation($this)
                ->count($con);
        }

        return count($this->collSpyProductRelationProductAbstracts);
    }

    /**
     * Method called to associate a ChildSpyProductRelationProductAbstract object to this object
     * through the ChildSpyProductRelationProductAbstract foreign key attribute.
     *
     * @param ChildSpyProductRelationProductAbstract $l ChildSpyProductRelationProductAbstract
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductRelationProductAbstract(ChildSpyProductRelationProductAbstract $l)
    {
        if ($this->collSpyProductRelationProductAbstracts === null) {
            $this->initSpyProductRelationProductAbstracts();
            $this->collSpyProductRelationProductAbstractsPartial = true;
        }

        if (!$this->collSpyProductRelationProductAbstracts->contains($l)) {
            $this->doAddSpyProductRelationProductAbstract($l);

            if ($this->spyProductRelationProductAbstractsScheduledForDeletion and $this->spyProductRelationProductAbstractsScheduledForDeletion->contains($l)) {
                $this->spyProductRelationProductAbstractsScheduledForDeletion->remove($this->spyProductRelationProductAbstractsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyProductRelationProductAbstract $spyProductRelationProductAbstract The ChildSpyProductRelationProductAbstract object to add.
     */
    protected function doAddSpyProductRelationProductAbstract(ChildSpyProductRelationProductAbstract $spyProductRelationProductAbstract): void
    {
        $this->collSpyProductRelationProductAbstracts[]= $spyProductRelationProductAbstract;
        $spyProductRelationProductAbstract->setSpyProductRelation($this);
    }

    /**
     * @param ChildSpyProductRelationProductAbstract $spyProductRelationProductAbstract The ChildSpyProductRelationProductAbstract object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductRelationProductAbstract(ChildSpyProductRelationProductAbstract $spyProductRelationProductAbstract)
    {
        if ($this->getSpyProductRelationProductAbstracts()->contains($spyProductRelationProductAbstract)) {
            $pos = $this->collSpyProductRelationProductAbstracts->search($spyProductRelationProductAbstract);
            $this->collSpyProductRelationProductAbstracts->remove($pos);
            if (null === $this->spyProductRelationProductAbstractsScheduledForDeletion) {
                $this->spyProductRelationProductAbstractsScheduledForDeletion = clone $this->collSpyProductRelationProductAbstracts;
                $this->spyProductRelationProductAbstractsScheduledForDeletion->clear();
            }
            $this->spyProductRelationProductAbstractsScheduledForDeletion[]= clone $spyProductRelationProductAbstract;
            $spyProductRelationProductAbstract->setSpyProductRelation(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductRelation is new, it will return
     * an empty collection; or if this SpyProductRelation has previously
     * been saved, it will retrieve related SpyProductRelationProductAbstracts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductRelation.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyProductRelationProductAbstract[] List of ChildSpyProductRelationProductAbstract objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyProductRelationProductAbstract}> List of ChildSpyProductRelationProductAbstract objects
     */
    public function getSpyProductRelationProductAbstractsJoinSpyProductAbstract(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyProductRelationProductAbstractQuery::create(null, $criteria);
        $query->joinWith('SpyProductAbstract', $joinBehavior);

        return $this->getSpyProductRelationProductAbstracts($query, $con);
    }

    /**
     * Clears out the collProductRelationStores collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addProductRelationStores()
     */
    public function clearProductRelationStores()
    {
        $this->collProductRelationStores = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collProductRelationStores collection loaded partially.
     *
     * @return void
     */
    public function resetPartialProductRelationStores($v = true): void
    {
        $this->collProductRelationStoresPartial = $v;
    }

    /**
     * Initializes the collProductRelationStores collection.
     *
     * By default this just sets the collProductRelationStores collection to an empty array (like clearcollProductRelationStores());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProductRelationStores(bool $overrideExisting = true): void
    {
        if (null !== $this->collProductRelationStores && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductRelationStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collProductRelationStores = new $collectionClassName;
        $this->collProductRelationStores->setModel('\Orm\Zed\ProductRelation\Persistence\SpyProductRelationStore');
    }

    /**
     * Gets an array of ChildSpyProductRelationStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductRelation is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyProductRelationStore[] List of ChildSpyProductRelationStore objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyProductRelationStore> List of ChildSpyProductRelationStore objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getProductRelationStores(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collProductRelationStoresPartial && !$this->isNew();
        if (null === $this->collProductRelationStores || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collProductRelationStores) {
                    $this->initProductRelationStores();
                } else {
                    $collectionClassName = SpyProductRelationStoreTableMap::getTableMap()->getCollectionClassName();

                    $collProductRelationStores = new $collectionClassName;
                    $collProductRelationStores->setModel('\Orm\Zed\ProductRelation\Persistence\SpyProductRelationStore');

                    return $collProductRelationStores;
                }
            } else {
                $collProductRelationStores = ChildSpyProductRelationStoreQuery::create(null, $criteria)
                    ->filterByProductRelation($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProductRelationStoresPartial && count($collProductRelationStores)) {
                        $this->initProductRelationStores(false);

                        foreach ($collProductRelationStores as $obj) {
                            if (false == $this->collProductRelationStores->contains($obj)) {
                                $this->collProductRelationStores->append($obj);
                            }
                        }

                        $this->collProductRelationStoresPartial = true;
                    }

                    return $collProductRelationStores;
                }

                if ($partial && $this->collProductRelationStores) {
                    foreach ($this->collProductRelationStores as $obj) {
                        if ($obj->isNew()) {
                            $collProductRelationStores[] = $obj;
                        }
                    }
                }

                $this->collProductRelationStores = $collProductRelationStores;
                $this->collProductRelationStoresPartial = false;
            }
        }

        return $this->collProductRelationStores;
    }

    /**
     * Sets a collection of ChildSpyProductRelationStore objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $productRelationStores A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setProductRelationStores(Collection $productRelationStores, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyProductRelationStore[] $productRelationStoresToDelete */
        $productRelationStoresToDelete = $this->getProductRelationStores(new Criteria(), $con)->diff($productRelationStores);


        $this->productRelationStoresScheduledForDeletion = $productRelationStoresToDelete;

        foreach ($productRelationStoresToDelete as $productRelationStoreRemoved) {
            $productRelationStoreRemoved->setProductRelation(null);
        }

        $this->collProductRelationStores = null;
        foreach ($productRelationStores as $productRelationStore) {
            $this->addProductRelationStore($productRelationStore);
        }

        $this->collProductRelationStores = $productRelationStores;
        $this->collProductRelationStoresPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyProductRelationStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyProductRelationStore objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countProductRelationStores(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collProductRelationStoresPartial && !$this->isNew();
        if (null === $this->collProductRelationStores || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProductRelationStores) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProductRelationStores());
            }

            $query = ChildSpyProductRelationStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProductRelation($this)
                ->count($con);
        }

        return count($this->collProductRelationStores);
    }

    /**
     * Method called to associate a ChildSpyProductRelationStore object to this object
     * through the ChildSpyProductRelationStore foreign key attribute.
     *
     * @param ChildSpyProductRelationStore $l ChildSpyProductRelationStore
     * @return $this The current object (for fluent API support)
     */
    public function addProductRelationStore(ChildSpyProductRelationStore $l)
    {
        if ($this->collProductRelationStores === null) {
            $this->initProductRelationStores();
            $this->collProductRelationStoresPartial = true;
        }

        if (!$this->collProductRelationStores->contains($l)) {
            $this->doAddProductRelationStore($l);

            if ($this->productRelationStoresScheduledForDeletion and $this->productRelationStoresScheduledForDeletion->contains($l)) {
                $this->productRelationStoresScheduledForDeletion->remove($this->productRelationStoresScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyProductRelationStore $productRelationStore The ChildSpyProductRelationStore object to add.
     */
    protected function doAddProductRelationStore(ChildSpyProductRelationStore $productRelationStore): void
    {
        $this->collProductRelationStores[]= $productRelationStore;
        $productRelationStore->setProductRelation($this);
    }

    /**
     * @param ChildSpyProductRelationStore $productRelationStore The ChildSpyProductRelationStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeProductRelationStore(ChildSpyProductRelationStore $productRelationStore)
    {
        if ($this->getProductRelationStores()->contains($productRelationStore)) {
            $pos = $this->collProductRelationStores->search($productRelationStore);
            $this->collProductRelationStores->remove($pos);
            if (null === $this->productRelationStoresScheduledForDeletion) {
                $this->productRelationStoresScheduledForDeletion = clone $this->collProductRelationStores;
                $this->productRelationStoresScheduledForDeletion->clear();
            }
            $this->productRelationStoresScheduledForDeletion[]= clone $productRelationStore;
            $productRelationStore->setProductRelation(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductRelation is new, it will return
     * an empty collection; or if this SpyProductRelation has previously
     * been saved, it will retrieve related ProductRelationStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductRelation.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyProductRelationStore[] List of ChildSpyProductRelationStore objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyProductRelationStore}> List of ChildSpyProductRelationStore objects
     */
    public function getProductRelationStoresJoinStore(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyProductRelationStoreQuery::create(null, $criteria);
        $query->joinWith('Store', $joinBehavior);

        return $this->getProductRelationStores($query, $con);
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
        if (null !== $this->aSpyProductAbstract) {
            $this->aSpyProductAbstract->removeSpyProductRelation($this);
        }
        if (null !== $this->aSpyProductRelationType) {
            $this->aSpyProductRelationType->removeSpyProductRelation($this);
        }
        $this->id_product_relation = null;
        $this->fk_product_abstract = null;
        $this->fk_product_relation_type = null;
        $this->is_active = null;
        $this->is_rebuild_scheduled = null;
        $this->product_relation_key = null;
        $this->query_set_data = null;
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
            if ($this->collSpyProductRelationProductAbstracts) {
                foreach ($this->collSpyProductRelationProductAbstracts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProductRelationStores) {
                foreach ($this->collProductRelationStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyProductRelationProductAbstracts = null;
        $this->collProductRelationStores = null;
        $this->aSpyProductAbstract = null;
        $this->aSpyProductRelationType = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyProductRelationTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return $this The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[SpyProductRelationTableMap::COL_UPDATED_AT] = true;

        return $this;
    }

    // event behavior

    /**
     * @return void
     */
    protected function prepareSaveEventName()
    {
        if ($this->isNew()) {
            $this->_eventName = 'Entity.spy_product_relation.create';
        } else {
            $this->_eventName = 'Entity.spy_product_relation.update';
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

        if ($this->_eventName !== 'Entity.spy_product_relation.create') {
            if (!$this->_isModified) {
                return;
            }

            if (!$this->isEventColumnsModified()) {
                return;
            }
        }

        $data = [
            'name' => 'spy_product_relation',
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
            'name' => 'spy_product_relation',
            'id' => !is_array($this->getPrimaryKey()) ? $this->getPrimaryKey() : null,
            'event' => 'Entity.spy_product_relation.delete',
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
            $field = str_replace('spy_product_relation.', '', $modifiedColumn);
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
            $field = str_replace('spy_product_relation.', '', $additionalValueColumnName);
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
        $columnType = SpyProductRelationTableMap::getTableMap()->getColumn($column)->getType();
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
