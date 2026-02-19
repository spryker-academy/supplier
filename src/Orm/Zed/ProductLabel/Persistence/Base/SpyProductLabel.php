<?php

namespace Orm\Zed\ProductLabel\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\ProductLabel\Persistence\SpyProductLabel as ChildSpyProductLabel;
use Orm\Zed\ProductLabel\Persistence\SpyProductLabelLocalizedAttributes as ChildSpyProductLabelLocalizedAttributes;
use Orm\Zed\ProductLabel\Persistence\SpyProductLabelLocalizedAttributesQuery as ChildSpyProductLabelLocalizedAttributesQuery;
use Orm\Zed\ProductLabel\Persistence\SpyProductLabelProductAbstract as ChildSpyProductLabelProductAbstract;
use Orm\Zed\ProductLabel\Persistence\SpyProductLabelProductAbstractQuery as ChildSpyProductLabelProductAbstractQuery;
use Orm\Zed\ProductLabel\Persistence\SpyProductLabelQuery as ChildSpyProductLabelQuery;
use Orm\Zed\ProductLabel\Persistence\SpyProductLabelStore as ChildSpyProductLabelStore;
use Orm\Zed\ProductLabel\Persistence\SpyProductLabelStoreQuery as ChildSpyProductLabelStoreQuery;
use Orm\Zed\ProductLabel\Persistence\Map\SpyProductLabelLocalizedAttributesTableMap;
use Orm\Zed\ProductLabel\Persistence\Map\SpyProductLabelProductAbstractTableMap;
use Orm\Zed\ProductLabel\Persistence\Map\SpyProductLabelStoreTableMap;
use Orm\Zed\ProductLabel\Persistence\Map\SpyProductLabelTableMap;
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
 * Base class that represents a row from the 'spy_product_label' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.ProductLabel.Persistence.Base
 */
abstract class SpyProductLabel implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\ProductLabel\\Persistence\\Map\\SpyProductLabelTableMap';


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
     * The value for the id_product_label field.
     *
     * @var        int
     */
    protected $id_product_label;

    /**
     * The value for the front_end_reference field.
     * A reference used on the front end, often for product labels.
     * @var        string|null
     */
    protected $front_end_reference;

    /**
     * The value for the is_active field.
     * A boolean flag indicating if an entity is currently active.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $is_active;

    /**
     * The value for the is_dynamic field.
     * A flag indicating if a product label is dynamic.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $is_dynamic;

    /**
     * The value for the is_exclusive field.
     * A flag indicating if a discount is exclusive.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $is_exclusive;

    /**
     * The value for the is_published field.
     * A flag indicating if a product label is published and visible.
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $is_published;

    /**
     * The value for the name field.
     * The name of an entity (e.g., user, category, product, role).
     * @var        string
     */
    protected $name;

    /**
     * The value for the position field.
     * The position or order of an item in a list.
     * @var        int
     */
    protected $position;

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
     * @var        ObjectCollection|ChildSpyProductLabelStore[] Collection to store aggregation of ChildSpyProductLabelStore objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyProductLabelStore> Collection to store aggregation of ChildSpyProductLabelStore objects.
     */
    protected $collProductLabelStores;
    protected $collProductLabelStoresPartial;

    /**
     * @var        ObjectCollection|ChildSpyProductLabelLocalizedAttributes[] Collection to store aggregation of ChildSpyProductLabelLocalizedAttributes objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyProductLabelLocalizedAttributes> Collection to store aggregation of ChildSpyProductLabelLocalizedAttributes objects.
     */
    protected $collSpyProductLabelLocalizedAttributess;
    protected $collSpyProductLabelLocalizedAttributessPartial;

    /**
     * @var        ObjectCollection|ChildSpyProductLabelProductAbstract[] Collection to store aggregation of ChildSpyProductLabelProductAbstract objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyProductLabelProductAbstract> Collection to store aggregation of ChildSpyProductLabelProductAbstract objects.
     */
    protected $collSpyProductLabelProductAbstracts;
    protected $collSpyProductLabelProductAbstractsPartial;

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
     * @var ObjectCollection|ChildSpyProductLabelStore[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyProductLabelStore>
     */
    protected $productLabelStoresScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyProductLabelLocalizedAttributes[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyProductLabelLocalizedAttributes>
     */
    protected $spyProductLabelLocalizedAttributessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyProductLabelProductAbstract[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyProductLabelProductAbstract>
     */
    protected $spyProductLabelProductAbstractsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->is_active = false;
        $this->is_dynamic = false;
        $this->is_exclusive = false;
        $this->is_published = false;
    }

    /**
     * Initializes internal state of Orm\Zed\ProductLabel\Persistence\Base\SpyProductLabel object.
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
     * Compares this with another <code>SpyProductLabel</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyProductLabel</code>, delegates to
     * <code>equals(SpyProductLabel)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_product_label] column value.
     *
     * @return int
     */
    public function getIdProductLabel()
    {
        return $this->id_product_label;
    }

    /**
     * Get the [front_end_reference] column value.
     * A reference used on the front end, often for product labels.
     * @return string|null
     */
    public function getFrontEndReference()
    {
        return $this->front_end_reference;
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
     * Get the [is_dynamic] column value.
     * A flag indicating if a product label is dynamic.
     * @return boolean
     */
    public function getIsDynamic()
    {
        return $this->is_dynamic;
    }

    /**
     * Get the [is_dynamic] column value.
     * A flag indicating if a product label is dynamic.
     * @return boolean
     */
    public function isDynamic()
    {
        return $this->getIsDynamic();
    }

    /**
     * Get the [is_exclusive] column value.
     * A flag indicating if a discount is exclusive.
     * @return boolean
     */
    public function getIsExclusive()
    {
        return $this->is_exclusive;
    }

    /**
     * Get the [is_exclusive] column value.
     * A flag indicating if a discount is exclusive.
     * @return boolean
     */
    public function isExclusive()
    {
        return $this->getIsExclusive();
    }

    /**
     * Get the [is_published] column value.
     * A flag indicating if a product label is published and visible.
     * @return boolean|null
     */
    public function getIsPublished()
    {
        return $this->is_published;
    }

    /**
     * Get the [is_published] column value.
     * A flag indicating if a product label is published and visible.
     * @return boolean|null
     */
    public function isPublished()
    {
        return $this->getIsPublished();
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
     * Get the [position] column value.
     * The position or order of an item in a list.
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
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
     * Set the value of [id_product_label] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdProductLabel($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_product_label !== $v) {
            $this->id_product_label = $v;
            $this->modifiedColumns[SpyProductLabelTableMap::COL_ID_PRODUCT_LABEL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [front_end_reference] column.
     * A reference used on the front end, often for product labels.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFrontEndReference($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->front_end_reference !== $v) {
            $this->front_end_reference = $v;
            $this->modifiedColumns[SpyProductLabelTableMap::COL_FRONT_END_REFERENCE] = true;
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
            $this->modifiedColumns[SpyProductLabelTableMap::COL_IS_ACTIVE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_dynamic] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * A flag indicating if a product label is dynamic.
     * @param bool|integer|string $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsDynamic($v)
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

        if (($this->isNew() && $hasDefaultValue) || $this->is_dynamic !== $v) {
            $this->is_dynamic = $v;
            $this->modifiedColumns[SpyProductLabelTableMap::COL_IS_DYNAMIC] = true;
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
     * @param bool|integer|string $v The new value
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
            $this->modifiedColumns[SpyProductLabelTableMap::COL_IS_EXCLUSIVE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_published] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * A flag indicating if a product label is published and visible.
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsPublished($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (bool) $v;
            }
        }

        $allowNullValues = true;

        if ($v === null && !$allowNullValues) {
            return $this;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = true;

        if (($this->isNew() && $hasDefaultValue) || $this->is_published !== $v) {
            $this->is_published = $v;
            $this->modifiedColumns[SpyProductLabelTableMap::COL_IS_PUBLISHED] = true;
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
            $this->modifiedColumns[SpyProductLabelTableMap::COL_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [position] column.
     * The position or order of an item in a list.
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPosition($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->position !== $v) {
            $this->position = $v;
            $this->modifiedColumns[SpyProductLabelTableMap::COL_POSITION] = true;
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
                $this->modifiedColumns[SpyProductLabelTableMap::COL_VALID_FROM] = true;
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
                $this->modifiedColumns[SpyProductLabelTableMap::COL_VALID_TO] = true;
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
                $this->modifiedColumns[SpyProductLabelTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SpyProductLabelTableMap::COL_UPDATED_AT] = true;
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

            if ($this->is_dynamic !== false) {
                return false;
            }

            if ($this->is_exclusive !== false) {
                return false;
            }

            if ($this->is_published !== false) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyProductLabelTableMap::translateFieldName('IdProductLabel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_product_label = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyProductLabelTableMap::translateFieldName('FrontEndReference', TableMap::TYPE_PHPNAME, $indexType)];
            $this->front_end_reference = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyProductLabelTableMap::translateFieldName('IsActive', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_active = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyProductLabelTableMap::translateFieldName('IsDynamic', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_dynamic = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyProductLabelTableMap::translateFieldName('IsExclusive', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_exclusive = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyProductLabelTableMap::translateFieldName('IsPublished', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_published = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpyProductLabelTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpyProductLabelTableMap::translateFieldName('Position', TableMap::TYPE_PHPNAME, $indexType)];
            $this->position = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SpyProductLabelTableMap::translateFieldName('ValidFrom', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->valid_from = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SpyProductLabelTableMap::translateFieldName('ValidTo', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->valid_to = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SpyProductLabelTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : SpyProductLabelTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 12; // 12 = SpyProductLabelTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\ProductLabel\\Persistence\\SpyProductLabel'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyProductLabelTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyProductLabelQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collProductLabelStores = null;

            $this->collSpyProductLabelLocalizedAttributess = null;

            $this->collSpyProductLabelProductAbstracts = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyProductLabel::setDeleted()
     * @see SpyProductLabel::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductLabelTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyProductLabelQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductLabelTableMap::DATABASE_NAME);
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
                if (!$this->isColumnModified(SpyProductLabelTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpyProductLabelTableMap::COL_UPDATED_AT)) {
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
                if ($this->isModified() && !$this->isColumnModified(SpyProductLabelTableMap::COL_UPDATED_AT)) {
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

                SpyProductLabelTableMap::addInstanceToPool($this);
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

            if ($this->productLabelStoresScheduledForDeletion !== null) {
                if (!$this->productLabelStoresScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductLabel\Persistence\SpyProductLabelStoreQuery::create()
                        ->filterByPrimaryKeys($this->productLabelStoresScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->productLabelStoresScheduledForDeletion = null;
                }
            }

            if ($this->collProductLabelStores !== null) {
                foreach ($this->collProductLabelStores as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductLabelLocalizedAttributessScheduledForDeletion !== null) {
                if (!$this->spyProductLabelLocalizedAttributessScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductLabel\Persistence\SpyProductLabelLocalizedAttributesQuery::create()
                        ->filterByPrimaryKeys($this->spyProductLabelLocalizedAttributessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductLabelLocalizedAttributessScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductLabelLocalizedAttributess !== null) {
                foreach ($this->collSpyProductLabelLocalizedAttributess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductLabelProductAbstractsScheduledForDeletion !== null) {
                if (!$this->spyProductLabelProductAbstractsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductLabel\Persistence\SpyProductLabelProductAbstractQuery::create()
                        ->filterByPrimaryKeys($this->spyProductLabelProductAbstractsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductLabelProductAbstractsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductLabelProductAbstracts !== null) {
                foreach ($this->collSpyProductLabelProductAbstracts as $referrerFK) {
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

        $this->modifiedColumns[SpyProductLabelTableMap::COL_ID_PRODUCT_LABEL] = true;
        if (null !== $this->id_product_label) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyProductLabelTableMap::COL_ID_PRODUCT_LABEL . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyProductLabelTableMap::COL_ID_PRODUCT_LABEL)) {
            $modifiedColumns[':p' . $index++]  = '`id_product_label`';
        }
        if ($this->isColumnModified(SpyProductLabelTableMap::COL_FRONT_END_REFERENCE)) {
            $modifiedColumns[':p' . $index++]  = '`front_end_reference`';
        }
        if ($this->isColumnModified(SpyProductLabelTableMap::COL_IS_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`is_active`';
        }
        if ($this->isColumnModified(SpyProductLabelTableMap::COL_IS_DYNAMIC)) {
            $modifiedColumns[':p' . $index++]  = '`is_dynamic`';
        }
        if ($this->isColumnModified(SpyProductLabelTableMap::COL_IS_EXCLUSIVE)) {
            $modifiedColumns[':p' . $index++]  = '`is_exclusive`';
        }
        if ($this->isColumnModified(SpyProductLabelTableMap::COL_IS_PUBLISHED)) {
            $modifiedColumns[':p' . $index++]  = '`is_published`';
        }
        if ($this->isColumnModified(SpyProductLabelTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(SpyProductLabelTableMap::COL_POSITION)) {
            $modifiedColumns[':p' . $index++]  = '`position`';
        }
        if ($this->isColumnModified(SpyProductLabelTableMap::COL_VALID_FROM)) {
            $modifiedColumns[':p' . $index++]  = '`valid_from`';
        }
        if ($this->isColumnModified(SpyProductLabelTableMap::COL_VALID_TO)) {
            $modifiedColumns[':p' . $index++]  = '`valid_to`';
        }
        if ($this->isColumnModified(SpyProductLabelTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(SpyProductLabelTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }

        $sql = sprintf(
            'INSERT INTO `spy_product_label` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id_product_label`':
                        $stmt->bindValue($identifier, $this->id_product_label, PDO::PARAM_INT);

                        break;
                    case '`front_end_reference`':
                        $stmt->bindValue($identifier, $this->front_end_reference, PDO::PARAM_STR);

                        break;
                    case '`is_active`':
                        $stmt->bindValue($identifier, (int) $this->is_active, PDO::PARAM_INT);

                        break;
                    case '`is_dynamic`':
                        $stmt->bindValue($identifier, (int) $this->is_dynamic, PDO::PARAM_INT);

                        break;
                    case '`is_exclusive`':
                        $stmt->bindValue($identifier, (int) $this->is_exclusive, PDO::PARAM_INT);

                        break;
                    case '`is_published`':
                        $stmt->bindValue($identifier, (int) $this->is_published, PDO::PARAM_INT);

                        break;
                    case '`name`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);

                        break;
                    case '`position`':
                        $stmt->bindValue($identifier, $this->position, PDO::PARAM_INT);

                        break;
                    case '`valid_from`':
                        $stmt->bindValue($identifier, $this->valid_from ? $this->valid_from->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case '`valid_to`':
                        $stmt->bindValue($identifier, $this->valid_to ? $this->valid_to->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

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
            $pk = $con->lastInsertId('spy_product_label_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdProductLabel($pk);

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
        $pos = SpyProductLabelTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdProductLabel();

            case 1:
                return $this->getFrontEndReference();

            case 2:
                return $this->getIsActive();

            case 3:
                return $this->getIsDynamic();

            case 4:
                return $this->getIsExclusive();

            case 5:
                return $this->getIsPublished();

            case 6:
                return $this->getName();

            case 7:
                return $this->getPosition();

            case 8:
                return $this->getValidFrom();

            case 9:
                return $this->getValidTo();

            case 10:
                return $this->getCreatedAt();

            case 11:
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
        if (isset($alreadyDumpedObjects['SpyProductLabel'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyProductLabel'][$this->hashCode()] = true;
        $keys = SpyProductLabelTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdProductLabel(),
            $keys[1] => $this->getFrontEndReference(),
            $keys[2] => $this->getIsActive(),
            $keys[3] => $this->getIsDynamic(),
            $keys[4] => $this->getIsExclusive(),
            $keys[5] => $this->getIsPublished(),
            $keys[6] => $this->getName(),
            $keys[7] => $this->getPosition(),
            $keys[8] => $this->getValidFrom(),
            $keys[9] => $this->getValidTo(),
            $keys[10] => $this->getCreatedAt(),
            $keys[11] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[9]] instanceof \DateTimeInterface) {
            $result[$keys[9]] = $result[$keys[9]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[10]] instanceof \DateTimeInterface) {
            $result[$keys[10]] = $result[$keys[10]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[11]] instanceof \DateTimeInterface) {
            $result[$keys[11]] = $result[$keys[11]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collProductLabelStores) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductLabelStores';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_label_stores';
                        break;
                    default:
                        $key = 'ProductLabelStores';
                }

                $result[$key] = $this->collProductLabelStores->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductLabelLocalizedAttributess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductLabelLocalizedAttributess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_label_localized_attributess';
                        break;
                    default:
                        $key = 'SpyProductLabelLocalizedAttributess';
                }

                $result[$key] = $this->collSpyProductLabelLocalizedAttributess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductLabelProductAbstracts) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductLabelProductAbstracts';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_label_product_abstracts';
                        break;
                    default:
                        $key = 'SpyProductLabelProductAbstracts';
                }

                $result[$key] = $this->collSpyProductLabelProductAbstracts->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyProductLabelTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdProductLabel($value);
                break;
            case 1:
                $this->setFrontEndReference($value);
                break;
            case 2:
                $this->setIsActive($value);
                break;
            case 3:
                $this->setIsDynamic($value);
                break;
            case 4:
                $this->setIsExclusive($value);
                break;
            case 5:
                $this->setIsPublished($value);
                break;
            case 6:
                $this->setName($value);
                break;
            case 7:
                $this->setPosition($value);
                break;
            case 8:
                $this->setValidFrom($value);
                break;
            case 9:
                $this->setValidTo($value);
                break;
            case 10:
                $this->setCreatedAt($value);
                break;
            case 11:
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
        $keys = SpyProductLabelTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdProductLabel($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFrontEndReference($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setIsActive($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setIsDynamic($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setIsExclusive($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setIsPublished($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setName($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setPosition($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setValidFrom($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setValidTo($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setCreatedAt($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setUpdatedAt($arr[$keys[11]]);
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
        $criteria = new Criteria(SpyProductLabelTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyProductLabelTableMap::COL_ID_PRODUCT_LABEL)) {
            $criteria->add(SpyProductLabelTableMap::COL_ID_PRODUCT_LABEL, $this->id_product_label);
        }
        if ($this->isColumnModified(SpyProductLabelTableMap::COL_FRONT_END_REFERENCE)) {
            $criteria->add(SpyProductLabelTableMap::COL_FRONT_END_REFERENCE, $this->front_end_reference);
        }
        if ($this->isColumnModified(SpyProductLabelTableMap::COL_IS_ACTIVE)) {
            $criteria->add(SpyProductLabelTableMap::COL_IS_ACTIVE, $this->is_active);
        }
        if ($this->isColumnModified(SpyProductLabelTableMap::COL_IS_DYNAMIC)) {
            $criteria->add(SpyProductLabelTableMap::COL_IS_DYNAMIC, $this->is_dynamic);
        }
        if ($this->isColumnModified(SpyProductLabelTableMap::COL_IS_EXCLUSIVE)) {
            $criteria->add(SpyProductLabelTableMap::COL_IS_EXCLUSIVE, $this->is_exclusive);
        }
        if ($this->isColumnModified(SpyProductLabelTableMap::COL_IS_PUBLISHED)) {
            $criteria->add(SpyProductLabelTableMap::COL_IS_PUBLISHED, $this->is_published);
        }
        if ($this->isColumnModified(SpyProductLabelTableMap::COL_NAME)) {
            $criteria->add(SpyProductLabelTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(SpyProductLabelTableMap::COL_POSITION)) {
            $criteria->add(SpyProductLabelTableMap::COL_POSITION, $this->position);
        }
        if ($this->isColumnModified(SpyProductLabelTableMap::COL_VALID_FROM)) {
            $criteria->add(SpyProductLabelTableMap::COL_VALID_FROM, $this->valid_from);
        }
        if ($this->isColumnModified(SpyProductLabelTableMap::COL_VALID_TO)) {
            $criteria->add(SpyProductLabelTableMap::COL_VALID_TO, $this->valid_to);
        }
        if ($this->isColumnModified(SpyProductLabelTableMap::COL_CREATED_AT)) {
            $criteria->add(SpyProductLabelTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpyProductLabelTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpyProductLabelTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildSpyProductLabelQuery::create();
        $criteria->add(SpyProductLabelTableMap::COL_ID_PRODUCT_LABEL, $this->id_product_label);

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
        $validPk = null !== $this->getIdProductLabel();

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
        return $this->getIdProductLabel();
    }

    /**
     * Generic method to set the primary key (id_product_label column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdProductLabel($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdProductLabel();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\ProductLabel\Persistence\SpyProductLabel (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFrontEndReference($this->getFrontEndReference());
        $copyObj->setIsActive($this->getIsActive());
        $copyObj->setIsDynamic($this->getIsDynamic());
        $copyObj->setIsExclusive($this->getIsExclusive());
        $copyObj->setIsPublished($this->getIsPublished());
        $copyObj->setName($this->getName());
        $copyObj->setPosition($this->getPosition());
        $copyObj->setValidFrom($this->getValidFrom());
        $copyObj->setValidTo($this->getValidTo());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getProductLabelStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductLabelStore($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductLabelLocalizedAttributess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductLabelLocalizedAttributes($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductLabelProductAbstracts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductLabelProductAbstract($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdProductLabel(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\ProductLabel\Persistence\SpyProductLabel Clone of current object.
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
        if ('ProductLabelStore' === $relationName) {
            $this->initProductLabelStores();
            return;
        }
        if ('SpyProductLabelLocalizedAttributes' === $relationName) {
            $this->initSpyProductLabelLocalizedAttributess();
            return;
        }
        if ('SpyProductLabelProductAbstract' === $relationName) {
            $this->initSpyProductLabelProductAbstracts();
            return;
        }
    }

    /**
     * Clears out the collProductLabelStores collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addProductLabelStores()
     */
    public function clearProductLabelStores()
    {
        $this->collProductLabelStores = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collProductLabelStores collection loaded partially.
     *
     * @return void
     */
    public function resetPartialProductLabelStores($v = true): void
    {
        $this->collProductLabelStoresPartial = $v;
    }

    /**
     * Initializes the collProductLabelStores collection.
     *
     * By default this just sets the collProductLabelStores collection to an empty array (like clearcollProductLabelStores());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProductLabelStores(bool $overrideExisting = true): void
    {
        if (null !== $this->collProductLabelStores && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductLabelStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collProductLabelStores = new $collectionClassName;
        $this->collProductLabelStores->setModel('\Orm\Zed\ProductLabel\Persistence\SpyProductLabelStore');
    }

    /**
     * Gets an array of ChildSpyProductLabelStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductLabel is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyProductLabelStore[] List of ChildSpyProductLabelStore objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyProductLabelStore> List of ChildSpyProductLabelStore objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getProductLabelStores(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collProductLabelStoresPartial && !$this->isNew();
        if (null === $this->collProductLabelStores || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collProductLabelStores) {
                    $this->initProductLabelStores();
                } else {
                    $collectionClassName = SpyProductLabelStoreTableMap::getTableMap()->getCollectionClassName();

                    $collProductLabelStores = new $collectionClassName;
                    $collProductLabelStores->setModel('\Orm\Zed\ProductLabel\Persistence\SpyProductLabelStore');

                    return $collProductLabelStores;
                }
            } else {
                $collProductLabelStores = ChildSpyProductLabelStoreQuery::create(null, $criteria)
                    ->filterByProductLabel($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProductLabelStoresPartial && count($collProductLabelStores)) {
                        $this->initProductLabelStores(false);

                        foreach ($collProductLabelStores as $obj) {
                            if (false == $this->collProductLabelStores->contains($obj)) {
                                $this->collProductLabelStores->append($obj);
                            }
                        }

                        $this->collProductLabelStoresPartial = true;
                    }

                    return $collProductLabelStores;
                }

                if ($partial && $this->collProductLabelStores) {
                    foreach ($this->collProductLabelStores as $obj) {
                        if ($obj->isNew()) {
                            $collProductLabelStores[] = $obj;
                        }
                    }
                }

                $this->collProductLabelStores = $collProductLabelStores;
                $this->collProductLabelStoresPartial = false;
            }
        }

        return $this->collProductLabelStores;
    }

    /**
     * Sets a collection of ChildSpyProductLabelStore objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $productLabelStores A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setProductLabelStores(Collection $productLabelStores, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyProductLabelStore[] $productLabelStoresToDelete */
        $productLabelStoresToDelete = $this->getProductLabelStores(new Criteria(), $con)->diff($productLabelStores);


        $this->productLabelStoresScheduledForDeletion = $productLabelStoresToDelete;

        foreach ($productLabelStoresToDelete as $productLabelStoreRemoved) {
            $productLabelStoreRemoved->setProductLabel(null);
        }

        $this->collProductLabelStores = null;
        foreach ($productLabelStores as $productLabelStore) {
            $this->addProductLabelStore($productLabelStore);
        }

        $this->collProductLabelStores = $productLabelStores;
        $this->collProductLabelStoresPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyProductLabelStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyProductLabelStore objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countProductLabelStores(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collProductLabelStoresPartial && !$this->isNew();
        if (null === $this->collProductLabelStores || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProductLabelStores) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProductLabelStores());
            }

            $query = ChildSpyProductLabelStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProductLabel($this)
                ->count($con);
        }

        return count($this->collProductLabelStores);
    }

    /**
     * Method called to associate a ChildSpyProductLabelStore object to this object
     * through the ChildSpyProductLabelStore foreign key attribute.
     *
     * @param ChildSpyProductLabelStore $l ChildSpyProductLabelStore
     * @return $this The current object (for fluent API support)
     */
    public function addProductLabelStore(ChildSpyProductLabelStore $l)
    {
        if ($this->collProductLabelStores === null) {
            $this->initProductLabelStores();
            $this->collProductLabelStoresPartial = true;
        }

        if (!$this->collProductLabelStores->contains($l)) {
            $this->doAddProductLabelStore($l);

            if ($this->productLabelStoresScheduledForDeletion and $this->productLabelStoresScheduledForDeletion->contains($l)) {
                $this->productLabelStoresScheduledForDeletion->remove($this->productLabelStoresScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyProductLabelStore $productLabelStore The ChildSpyProductLabelStore object to add.
     */
    protected function doAddProductLabelStore(ChildSpyProductLabelStore $productLabelStore): void
    {
        $this->collProductLabelStores[]= $productLabelStore;
        $productLabelStore->setProductLabel($this);
    }

    /**
     * @param ChildSpyProductLabelStore $productLabelStore The ChildSpyProductLabelStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeProductLabelStore(ChildSpyProductLabelStore $productLabelStore)
    {
        if ($this->getProductLabelStores()->contains($productLabelStore)) {
            $pos = $this->collProductLabelStores->search($productLabelStore);
            $this->collProductLabelStores->remove($pos);
            if (null === $this->productLabelStoresScheduledForDeletion) {
                $this->productLabelStoresScheduledForDeletion = clone $this->collProductLabelStores;
                $this->productLabelStoresScheduledForDeletion->clear();
            }
            $this->productLabelStoresScheduledForDeletion[]= clone $productLabelStore;
            $productLabelStore->setProductLabel(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductLabel is new, it will return
     * an empty collection; or if this SpyProductLabel has previously
     * been saved, it will retrieve related ProductLabelStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductLabel.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyProductLabelStore[] List of ChildSpyProductLabelStore objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyProductLabelStore}> List of ChildSpyProductLabelStore objects
     */
    public function getProductLabelStoresJoinStore(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyProductLabelStoreQuery::create(null, $criteria);
        $query->joinWith('Store', $joinBehavior);

        return $this->getProductLabelStores($query, $con);
    }

    /**
     * Clears out the collSpyProductLabelLocalizedAttributess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductLabelLocalizedAttributess()
     */
    public function clearSpyProductLabelLocalizedAttributess()
    {
        $this->collSpyProductLabelLocalizedAttributess = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductLabelLocalizedAttributess collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductLabelLocalizedAttributess($v = true): void
    {
        $this->collSpyProductLabelLocalizedAttributessPartial = $v;
    }

    /**
     * Initializes the collSpyProductLabelLocalizedAttributess collection.
     *
     * By default this just sets the collSpyProductLabelLocalizedAttributess collection to an empty array (like clearcollSpyProductLabelLocalizedAttributess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductLabelLocalizedAttributess(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductLabelLocalizedAttributess && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductLabelLocalizedAttributesTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductLabelLocalizedAttributess = new $collectionClassName;
        $this->collSpyProductLabelLocalizedAttributess->setModel('\Orm\Zed\ProductLabel\Persistence\SpyProductLabelLocalizedAttributes');
    }

    /**
     * Gets an array of ChildSpyProductLabelLocalizedAttributes objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductLabel is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyProductLabelLocalizedAttributes[] List of ChildSpyProductLabelLocalizedAttributes objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyProductLabelLocalizedAttributes> List of ChildSpyProductLabelLocalizedAttributes objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductLabelLocalizedAttributess(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductLabelLocalizedAttributessPartial && !$this->isNew();
        if (null === $this->collSpyProductLabelLocalizedAttributess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductLabelLocalizedAttributess) {
                    $this->initSpyProductLabelLocalizedAttributess();
                } else {
                    $collectionClassName = SpyProductLabelLocalizedAttributesTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductLabelLocalizedAttributess = new $collectionClassName;
                    $collSpyProductLabelLocalizedAttributess->setModel('\Orm\Zed\ProductLabel\Persistence\SpyProductLabelLocalizedAttributes');

                    return $collSpyProductLabelLocalizedAttributess;
                }
            } else {
                $collSpyProductLabelLocalizedAttributess = ChildSpyProductLabelLocalizedAttributesQuery::create(null, $criteria)
                    ->filterBySpyProductLabel($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductLabelLocalizedAttributessPartial && count($collSpyProductLabelLocalizedAttributess)) {
                        $this->initSpyProductLabelLocalizedAttributess(false);

                        foreach ($collSpyProductLabelLocalizedAttributess as $obj) {
                            if (false == $this->collSpyProductLabelLocalizedAttributess->contains($obj)) {
                                $this->collSpyProductLabelLocalizedAttributess->append($obj);
                            }
                        }

                        $this->collSpyProductLabelLocalizedAttributessPartial = true;
                    }

                    return $collSpyProductLabelLocalizedAttributess;
                }

                if ($partial && $this->collSpyProductLabelLocalizedAttributess) {
                    foreach ($this->collSpyProductLabelLocalizedAttributess as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductLabelLocalizedAttributess[] = $obj;
                        }
                    }
                }

                $this->collSpyProductLabelLocalizedAttributess = $collSpyProductLabelLocalizedAttributess;
                $this->collSpyProductLabelLocalizedAttributessPartial = false;
            }
        }

        return $this->collSpyProductLabelLocalizedAttributess;
    }

    /**
     * Sets a collection of ChildSpyProductLabelLocalizedAttributes objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductLabelLocalizedAttributess A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductLabelLocalizedAttributess(Collection $spyProductLabelLocalizedAttributess, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyProductLabelLocalizedAttributes[] $spyProductLabelLocalizedAttributessToDelete */
        $spyProductLabelLocalizedAttributessToDelete = $this->getSpyProductLabelLocalizedAttributess(new Criteria(), $con)->diff($spyProductLabelLocalizedAttributess);


        $this->spyProductLabelLocalizedAttributessScheduledForDeletion = $spyProductLabelLocalizedAttributessToDelete;

        foreach ($spyProductLabelLocalizedAttributessToDelete as $spyProductLabelLocalizedAttributesRemoved) {
            $spyProductLabelLocalizedAttributesRemoved->setSpyProductLabel(null);
        }

        $this->collSpyProductLabelLocalizedAttributess = null;
        foreach ($spyProductLabelLocalizedAttributess as $spyProductLabelLocalizedAttributes) {
            $this->addSpyProductLabelLocalizedAttributes($spyProductLabelLocalizedAttributes);
        }

        $this->collSpyProductLabelLocalizedAttributess = $spyProductLabelLocalizedAttributess;
        $this->collSpyProductLabelLocalizedAttributessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyProductLabelLocalizedAttributes objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyProductLabelLocalizedAttributes objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductLabelLocalizedAttributess(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductLabelLocalizedAttributessPartial && !$this->isNew();
        if (null === $this->collSpyProductLabelLocalizedAttributess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductLabelLocalizedAttributess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductLabelLocalizedAttributess());
            }

            $query = ChildSpyProductLabelLocalizedAttributesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductLabel($this)
                ->count($con);
        }

        return count($this->collSpyProductLabelLocalizedAttributess);
    }

    /**
     * Method called to associate a ChildSpyProductLabelLocalizedAttributes object to this object
     * through the ChildSpyProductLabelLocalizedAttributes foreign key attribute.
     *
     * @param ChildSpyProductLabelLocalizedAttributes $l ChildSpyProductLabelLocalizedAttributes
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductLabelLocalizedAttributes(ChildSpyProductLabelLocalizedAttributes $l)
    {
        if ($this->collSpyProductLabelLocalizedAttributess === null) {
            $this->initSpyProductLabelLocalizedAttributess();
            $this->collSpyProductLabelLocalizedAttributessPartial = true;
        }

        if (!$this->collSpyProductLabelLocalizedAttributess->contains($l)) {
            $this->doAddSpyProductLabelLocalizedAttributes($l);

            if ($this->spyProductLabelLocalizedAttributessScheduledForDeletion and $this->spyProductLabelLocalizedAttributessScheduledForDeletion->contains($l)) {
                $this->spyProductLabelLocalizedAttributessScheduledForDeletion->remove($this->spyProductLabelLocalizedAttributessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyProductLabelLocalizedAttributes $spyProductLabelLocalizedAttributes The ChildSpyProductLabelLocalizedAttributes object to add.
     */
    protected function doAddSpyProductLabelLocalizedAttributes(ChildSpyProductLabelLocalizedAttributes $spyProductLabelLocalizedAttributes): void
    {
        $this->collSpyProductLabelLocalizedAttributess[]= $spyProductLabelLocalizedAttributes;
        $spyProductLabelLocalizedAttributes->setSpyProductLabel($this);
    }

    /**
     * @param ChildSpyProductLabelLocalizedAttributes $spyProductLabelLocalizedAttributes The ChildSpyProductLabelLocalizedAttributes object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductLabelLocalizedAttributes(ChildSpyProductLabelLocalizedAttributes $spyProductLabelLocalizedAttributes)
    {
        if ($this->getSpyProductLabelLocalizedAttributess()->contains($spyProductLabelLocalizedAttributes)) {
            $pos = $this->collSpyProductLabelLocalizedAttributess->search($spyProductLabelLocalizedAttributes);
            $this->collSpyProductLabelLocalizedAttributess->remove($pos);
            if (null === $this->spyProductLabelLocalizedAttributessScheduledForDeletion) {
                $this->spyProductLabelLocalizedAttributessScheduledForDeletion = clone $this->collSpyProductLabelLocalizedAttributess;
                $this->spyProductLabelLocalizedAttributessScheduledForDeletion->clear();
            }
            $this->spyProductLabelLocalizedAttributessScheduledForDeletion[]= clone $spyProductLabelLocalizedAttributes;
            $spyProductLabelLocalizedAttributes->setSpyProductLabel(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductLabel is new, it will return
     * an empty collection; or if this SpyProductLabel has previously
     * been saved, it will retrieve related SpyProductLabelLocalizedAttributess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductLabel.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyProductLabelLocalizedAttributes[] List of ChildSpyProductLabelLocalizedAttributes objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyProductLabelLocalizedAttributes}> List of ChildSpyProductLabelLocalizedAttributes objects
     */
    public function getSpyProductLabelLocalizedAttributessJoinSpyLocale(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyProductLabelLocalizedAttributesQuery::create(null, $criteria);
        $query->joinWith('SpyLocale', $joinBehavior);

        return $this->getSpyProductLabelLocalizedAttributess($query, $con);
    }

    /**
     * Clears out the collSpyProductLabelProductAbstracts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductLabelProductAbstracts()
     */
    public function clearSpyProductLabelProductAbstracts()
    {
        $this->collSpyProductLabelProductAbstracts = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductLabelProductAbstracts collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductLabelProductAbstracts($v = true): void
    {
        $this->collSpyProductLabelProductAbstractsPartial = $v;
    }

    /**
     * Initializes the collSpyProductLabelProductAbstracts collection.
     *
     * By default this just sets the collSpyProductLabelProductAbstracts collection to an empty array (like clearcollSpyProductLabelProductAbstracts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductLabelProductAbstracts(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductLabelProductAbstracts && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductLabelProductAbstractTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductLabelProductAbstracts = new $collectionClassName;
        $this->collSpyProductLabelProductAbstracts->setModel('\Orm\Zed\ProductLabel\Persistence\SpyProductLabelProductAbstract');
    }

    /**
     * Gets an array of ChildSpyProductLabelProductAbstract objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductLabel is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyProductLabelProductAbstract[] List of ChildSpyProductLabelProductAbstract objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyProductLabelProductAbstract> List of ChildSpyProductLabelProductAbstract objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductLabelProductAbstracts(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductLabelProductAbstractsPartial && !$this->isNew();
        if (null === $this->collSpyProductLabelProductAbstracts || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductLabelProductAbstracts) {
                    $this->initSpyProductLabelProductAbstracts();
                } else {
                    $collectionClassName = SpyProductLabelProductAbstractTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductLabelProductAbstracts = new $collectionClassName;
                    $collSpyProductLabelProductAbstracts->setModel('\Orm\Zed\ProductLabel\Persistence\SpyProductLabelProductAbstract');

                    return $collSpyProductLabelProductAbstracts;
                }
            } else {
                $collSpyProductLabelProductAbstracts = ChildSpyProductLabelProductAbstractQuery::create(null, $criteria)
                    ->filterBySpyProductLabel($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductLabelProductAbstractsPartial && count($collSpyProductLabelProductAbstracts)) {
                        $this->initSpyProductLabelProductAbstracts(false);

                        foreach ($collSpyProductLabelProductAbstracts as $obj) {
                            if (false == $this->collSpyProductLabelProductAbstracts->contains($obj)) {
                                $this->collSpyProductLabelProductAbstracts->append($obj);
                            }
                        }

                        $this->collSpyProductLabelProductAbstractsPartial = true;
                    }

                    return $collSpyProductLabelProductAbstracts;
                }

                if ($partial && $this->collSpyProductLabelProductAbstracts) {
                    foreach ($this->collSpyProductLabelProductAbstracts as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductLabelProductAbstracts[] = $obj;
                        }
                    }
                }

                $this->collSpyProductLabelProductAbstracts = $collSpyProductLabelProductAbstracts;
                $this->collSpyProductLabelProductAbstractsPartial = false;
            }
        }

        return $this->collSpyProductLabelProductAbstracts;
    }

    /**
     * Sets a collection of ChildSpyProductLabelProductAbstract objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductLabelProductAbstracts A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductLabelProductAbstracts(Collection $spyProductLabelProductAbstracts, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyProductLabelProductAbstract[] $spyProductLabelProductAbstractsToDelete */
        $spyProductLabelProductAbstractsToDelete = $this->getSpyProductLabelProductAbstracts(new Criteria(), $con)->diff($spyProductLabelProductAbstracts);


        $this->spyProductLabelProductAbstractsScheduledForDeletion = $spyProductLabelProductAbstractsToDelete;

        foreach ($spyProductLabelProductAbstractsToDelete as $spyProductLabelProductAbstractRemoved) {
            $spyProductLabelProductAbstractRemoved->setSpyProductLabel(null);
        }

        $this->collSpyProductLabelProductAbstracts = null;
        foreach ($spyProductLabelProductAbstracts as $spyProductLabelProductAbstract) {
            $this->addSpyProductLabelProductAbstract($spyProductLabelProductAbstract);
        }

        $this->collSpyProductLabelProductAbstracts = $spyProductLabelProductAbstracts;
        $this->collSpyProductLabelProductAbstractsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyProductLabelProductAbstract objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyProductLabelProductAbstract objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductLabelProductAbstracts(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductLabelProductAbstractsPartial && !$this->isNew();
        if (null === $this->collSpyProductLabelProductAbstracts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductLabelProductAbstracts) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductLabelProductAbstracts());
            }

            $query = ChildSpyProductLabelProductAbstractQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductLabel($this)
                ->count($con);
        }

        return count($this->collSpyProductLabelProductAbstracts);
    }

    /**
     * Method called to associate a ChildSpyProductLabelProductAbstract object to this object
     * through the ChildSpyProductLabelProductAbstract foreign key attribute.
     *
     * @param ChildSpyProductLabelProductAbstract $l ChildSpyProductLabelProductAbstract
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductLabelProductAbstract(ChildSpyProductLabelProductAbstract $l)
    {
        if ($this->collSpyProductLabelProductAbstracts === null) {
            $this->initSpyProductLabelProductAbstracts();
            $this->collSpyProductLabelProductAbstractsPartial = true;
        }

        if (!$this->collSpyProductLabelProductAbstracts->contains($l)) {
            $this->doAddSpyProductLabelProductAbstract($l);

            if ($this->spyProductLabelProductAbstractsScheduledForDeletion and $this->spyProductLabelProductAbstractsScheduledForDeletion->contains($l)) {
                $this->spyProductLabelProductAbstractsScheduledForDeletion->remove($this->spyProductLabelProductAbstractsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyProductLabelProductAbstract $spyProductLabelProductAbstract The ChildSpyProductLabelProductAbstract object to add.
     */
    protected function doAddSpyProductLabelProductAbstract(ChildSpyProductLabelProductAbstract $spyProductLabelProductAbstract): void
    {
        $this->collSpyProductLabelProductAbstracts[]= $spyProductLabelProductAbstract;
        $spyProductLabelProductAbstract->setSpyProductLabel($this);
    }

    /**
     * @param ChildSpyProductLabelProductAbstract $spyProductLabelProductAbstract The ChildSpyProductLabelProductAbstract object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductLabelProductAbstract(ChildSpyProductLabelProductAbstract $spyProductLabelProductAbstract)
    {
        if ($this->getSpyProductLabelProductAbstracts()->contains($spyProductLabelProductAbstract)) {
            $pos = $this->collSpyProductLabelProductAbstracts->search($spyProductLabelProductAbstract);
            $this->collSpyProductLabelProductAbstracts->remove($pos);
            if (null === $this->spyProductLabelProductAbstractsScheduledForDeletion) {
                $this->spyProductLabelProductAbstractsScheduledForDeletion = clone $this->collSpyProductLabelProductAbstracts;
                $this->spyProductLabelProductAbstractsScheduledForDeletion->clear();
            }
            $this->spyProductLabelProductAbstractsScheduledForDeletion[]= clone $spyProductLabelProductAbstract;
            $spyProductLabelProductAbstract->setSpyProductLabel(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductLabel is new, it will return
     * an empty collection; or if this SpyProductLabel has previously
     * been saved, it will retrieve related SpyProductLabelProductAbstracts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductLabel.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyProductLabelProductAbstract[] List of ChildSpyProductLabelProductAbstract objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyProductLabelProductAbstract}> List of ChildSpyProductLabelProductAbstract objects
     */
    public function getSpyProductLabelProductAbstractsJoinSpyProductAbstract(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyProductLabelProductAbstractQuery::create(null, $criteria);
        $query->joinWith('SpyProductAbstract', $joinBehavior);

        return $this->getSpyProductLabelProductAbstracts($query, $con);
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
        $this->id_product_label = null;
        $this->front_end_reference = null;
        $this->is_active = null;
        $this->is_dynamic = null;
        $this->is_exclusive = null;
        $this->is_published = null;
        $this->name = null;
        $this->position = null;
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
            if ($this->collProductLabelStores) {
                foreach ($this->collProductLabelStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductLabelLocalizedAttributess) {
                foreach ($this->collSpyProductLabelLocalizedAttributess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductLabelProductAbstracts) {
                foreach ($this->collSpyProductLabelProductAbstracts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collProductLabelStores = null;
        $this->collSpyProductLabelLocalizedAttributess = null;
        $this->collSpyProductLabelProductAbstracts = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyProductLabelTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return $this The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[SpyProductLabelTableMap::COL_UPDATED_AT] = true;

        return $this;
    }

    // event behavior

    /**
     * @return void
     */
    protected function prepareSaveEventName()
    {
        if ($this->isNew()) {
            $this->_eventName = 'Entity.spy_product_label.create';
        } else {
            $this->_eventName = 'Entity.spy_product_label.update';
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

        if ($this->_eventName !== 'Entity.spy_product_label.create') {
            if (!$this->_isModified) {
                return;
            }

            if (!$this->isEventColumnsModified()) {
                return;
            }
        }

        $data = [
            'name' => 'spy_product_label',
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
            'name' => 'spy_product_label',
            'id' => !is_array($this->getPrimaryKey()) ? $this->getPrimaryKey() : null,
            'event' => 'Entity.spy_product_label.delete',
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
            $field = str_replace('spy_product_label.', '', $modifiedColumn);
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
            $field = str_replace('spy_product_label.', '', $additionalValueColumnName);
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
        $columnType = SpyProductLabelTableMap::getTableMap()->getColumn($column)->getType();
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
