<?php

namespace Orm\Zed\ProductPackagingUnit\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitQuery as ChildSpyProductPackagingUnitQuery;
use Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitType as ChildSpyProductPackagingUnitType;
use Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitTypeQuery as ChildSpyProductPackagingUnitTypeQuery;
use Orm\Zed\ProductPackagingUnit\Persistence\Map\SpyProductPackagingUnitTableMap;
use Orm\Zed\Product\Persistence\SpyProduct;
use Orm\Zed\Product\Persistence\SpyProductQuery;
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
 * Base class that represents a row from the 'spy_product_packaging_unit' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.ProductPackagingUnit.Persistence.Base
 */
abstract class SpyProductPackagingUnit implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\ProductPackagingUnit\\Persistence\\Map\\SpyProductPackagingUnitTableMap';


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
     * The value for the id_product_packaging_unit field.
     *
     * @var        int
     */
    protected $id_product_packaging_unit;

    /**
     * The value for the fk_lead_product field.
     *
     * @var        int
     */
    protected $fk_lead_product;

    /**
     * The value for the fk_product field.
     *
     * @var        int
     */
    protected $fk_product;

    /**
     * The value for the fk_product_packaging_unit_type field.
     *
     * @var        int
     */
    protected $fk_product_packaging_unit_type;

    /**
     * The value for the amount_interval field.
     * The interval by which the amount of a product can be increased or decreased.
     * @var        string|null
     */
    protected $amount_interval;

    /**
     * The value for the amount_max field.
     * The maximum allowable amount for a product packaging unit.
     * @var        string|null
     */
    protected $amount_max;

    /**
     * The value for the amount_min field.
     * The minimum allowable amount for a product packaging unit.
     * @var        string|null
     */
    protected $amount_min;

    /**
     * The value for the default_amount field.
     * The default amount for a product packaging unit.
     * @var        string
     */
    protected $default_amount;

    /**
     * The value for the is_amount_variable field.
     * Indicates if the amount for a packaging unit can be varied.
     * @var        boolean
     */
    protected $is_amount_variable;

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
     * @var        SpyProduct
     */
    protected $aLeadProduct;

    /**
     * @var        ChildSpyProductPackagingUnitType
     */
    protected $aProductPackagingUnitType;

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
        'spy_product_packaging_unit.fk_product' => 'fk_product',
        'spy_product_packaging_unit.fk_lead_product' => 'fk_lead_product',
        'spy_product_packaging_unit.fk_product_packaging_unit_type' => 'fk_product_packaging_unit_type',
    ];

    /**
     * Initializes internal state of Orm\Zed\ProductPackagingUnit\Persistence\Base\SpyProductPackagingUnit object.
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
     * Compares this with another <code>SpyProductPackagingUnit</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyProductPackagingUnit</code>, delegates to
     * <code>equals(SpyProductPackagingUnit)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_product_packaging_unit] column value.
     *
     * @return int
     */
    public function getIdProductPackagingUnit()
    {
        return $this->id_product_packaging_unit;
    }

    /**
     * Get the [fk_lead_product] column value.
     *
     * @return int
     */
    public function getFkLeadProduct()
    {
        return $this->fk_lead_product;
    }

    /**
     * Get the [fk_product] column value.
     *
     * @return int
     */
    public function getFkProduct()
    {
        return $this->fk_product;
    }

    /**
     * Get the [fk_product_packaging_unit_type] column value.
     *
     * @return int
     */
    public function getFkProductPackagingUnitType()
    {
        return $this->fk_product_packaging_unit_type;
    }

    /**
     * Get the [amount_interval] column value.
     * The interval by which the amount of a product can be increased or decreased.
     * @return string|null
     */
    public function getAmountInterval()
    {
        return $this->amount_interval;
    }

    /**
     * Get the [amount_max] column value.
     * The maximum allowable amount for a product packaging unit.
     * @return string|null
     */
    public function getAmountMax()
    {
        return $this->amount_max;
    }

    /**
     * Get the [amount_min] column value.
     * The minimum allowable amount for a product packaging unit.
     * @return string|null
     */
    public function getAmountMin()
    {
        return $this->amount_min;
    }

    /**
     * Get the [default_amount] column value.
     * The default amount for a product packaging unit.
     * @return string
     */
    public function getDefaultAmount()
    {
        return $this->default_amount;
    }

    /**
     * Get the [is_amount_variable] column value.
     * Indicates if the amount for a packaging unit can be varied.
     * @return boolean
     */
    public function getIsAmountVariable()
    {
        return $this->is_amount_variable;
    }

    /**
     * Get the [is_amount_variable] column value.
     * Indicates if the amount for a packaging unit can be varied.
     * @return boolean
     */
    public function isAmountVariable()
    {
        return $this->getIsAmountVariable();
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
     * Set the value of [id_product_packaging_unit] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdProductPackagingUnit($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_product_packaging_unit !== $v) {
            $this->id_product_packaging_unit = $v;
            $this->modifiedColumns[SpyProductPackagingUnitTableMap::COL_ID_PRODUCT_PACKAGING_UNIT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_lead_product] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkLeadProduct($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_lead_product !== $v) {
            $this->fk_lead_product = $v;
            $this->modifiedColumns[SpyProductPackagingUnitTableMap::COL_FK_LEAD_PRODUCT] = true;
        }

        if ($this->aLeadProduct !== null && $this->aLeadProduct->getIdProduct() !== $v) {
            $this->aLeadProduct = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_product] column.
     *
     * @param int $v New value
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
            $this->modifiedColumns[SpyProductPackagingUnitTableMap::COL_FK_PRODUCT] = true;
        }

        if ($this->aProduct !== null && $this->aProduct->getIdProduct() !== $v) {
            $this->aProduct = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_product_packaging_unit_type] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkProductPackagingUnitType($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_product_packaging_unit_type !== $v) {
            $this->fk_product_packaging_unit_type = $v;
            $this->modifiedColumns[SpyProductPackagingUnitTableMap::COL_FK_PRODUCT_PACKAGING_UNIT_TYPE] = true;
        }

        if ($this->aProductPackagingUnitType !== null && $this->aProductPackagingUnitType->getIdProductPackagingUnitType() !== $v) {
            $this->aProductPackagingUnitType = null;
        }

        return $this;
    }

    /**
     * Set the value of [amount_interval] column.
     * The interval by which the amount of a product can be increased or decreased.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAmountInterval($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->amount_interval !== $v) {
            $this->amount_interval = $v;
            $this->modifiedColumns[SpyProductPackagingUnitTableMap::COL_AMOUNT_INTERVAL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [amount_max] column.
     * The maximum allowable amount for a product packaging unit.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAmountMax($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->amount_max !== $v) {
            $this->amount_max = $v;
            $this->modifiedColumns[SpyProductPackagingUnitTableMap::COL_AMOUNT_MAX] = true;
        }

        return $this;
    }

    /**
     * Set the value of [amount_min] column.
     * The minimum allowable amount for a product packaging unit.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAmountMin($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->amount_min !== $v) {
            $this->amount_min = $v;
            $this->modifiedColumns[SpyProductPackagingUnitTableMap::COL_AMOUNT_MIN] = true;
        }

        return $this;
    }

    /**
     * Set the value of [default_amount] column.
     * The default amount for a product packaging unit.
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDefaultAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->default_amount !== $v) {
            $this->default_amount = $v;
            $this->modifiedColumns[SpyProductPackagingUnitTableMap::COL_DEFAULT_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_amount_variable] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * Indicates if the amount for a packaging unit can be varied.
     * @param bool|integer|string $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsAmountVariable($v)
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

        if (($this->isNew() && $hasDefaultValue) || $this->is_amount_variable !== $v) {
            $this->is_amount_variable = $v;
            $this->modifiedColumns[SpyProductPackagingUnitTableMap::COL_IS_AMOUNT_VARIABLE] = true;
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
                $this->modifiedColumns[SpyProductPackagingUnitTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SpyProductPackagingUnitTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyProductPackagingUnitTableMap::translateFieldName('IdProductPackagingUnit', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_product_packaging_unit = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyProductPackagingUnitTableMap::translateFieldName('FkLeadProduct', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_lead_product = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyProductPackagingUnitTableMap::translateFieldName('FkProduct', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_product = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyProductPackagingUnitTableMap::translateFieldName('FkProductPackagingUnitType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_product_packaging_unit_type = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyProductPackagingUnitTableMap::translateFieldName('AmountInterval', TableMap::TYPE_PHPNAME, $indexType)];
            $this->amount_interval = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyProductPackagingUnitTableMap::translateFieldName('AmountMax', TableMap::TYPE_PHPNAME, $indexType)];
            $this->amount_max = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpyProductPackagingUnitTableMap::translateFieldName('AmountMin', TableMap::TYPE_PHPNAME, $indexType)];
            $this->amount_min = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpyProductPackagingUnitTableMap::translateFieldName('DefaultAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->default_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SpyProductPackagingUnitTableMap::translateFieldName('IsAmountVariable', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_amount_variable = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SpyProductPackagingUnitTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SpyProductPackagingUnitTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 11; // 11 = SpyProductPackagingUnitTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\ProductPackagingUnit\\Persistence\\SpyProductPackagingUnit'), 0, $e);
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
        if ($this->aLeadProduct !== null && $this->fk_lead_product !== $this->aLeadProduct->getIdProduct()) {
            $this->aLeadProduct = null;
        }
        if ($this->aProduct !== null && $this->fk_product !== $this->aProduct->getIdProduct()) {
            $this->aProduct = null;
        }
        if ($this->aProductPackagingUnitType !== null && $this->fk_product_packaging_unit_type !== $this->aProductPackagingUnitType->getIdProductPackagingUnitType()) {
            $this->aProductPackagingUnitType = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyProductPackagingUnitTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyProductPackagingUnitQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aProduct = null;
            $this->aLeadProduct = null;
            $this->aProductPackagingUnitType = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyProductPackagingUnit::setDeleted()
     * @see SpyProductPackagingUnit::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductPackagingUnitTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyProductPackagingUnitQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductPackagingUnitTableMap::DATABASE_NAME);
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
                if (!$this->isColumnModified(SpyProductPackagingUnitTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpyProductPackagingUnitTableMap::COL_UPDATED_AT)) {
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
                if ($this->isModified() && !$this->isColumnModified(SpyProductPackagingUnitTableMap::COL_UPDATED_AT)) {
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

                SpyProductPackagingUnitTableMap::addInstanceToPool($this);
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

            if ($this->aLeadProduct !== null) {
                if ($this->aLeadProduct->isModified() || $this->aLeadProduct->isNew()) {
                    $affectedRows += $this->aLeadProduct->save($con);
                }
                $this->setLeadProduct($this->aLeadProduct);
            }

            if ($this->aProductPackagingUnitType !== null) {
                if ($this->aProductPackagingUnitType->isModified() || $this->aProductPackagingUnitType->isNew()) {
                    $affectedRows += $this->aProductPackagingUnitType->save($con);
                }
                $this->setProductPackagingUnitType($this->aProductPackagingUnitType);
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

        $this->modifiedColumns[SpyProductPackagingUnitTableMap::COL_ID_PRODUCT_PACKAGING_UNIT] = true;
        if (null !== $this->id_product_packaging_unit) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyProductPackagingUnitTableMap::COL_ID_PRODUCT_PACKAGING_UNIT . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyProductPackagingUnitTableMap::COL_ID_PRODUCT_PACKAGING_UNIT)) {
            $modifiedColumns[':p' . $index++]  = 'id_product_packaging_unit';
        }
        if ($this->isColumnModified(SpyProductPackagingUnitTableMap::COL_FK_LEAD_PRODUCT)) {
            $modifiedColumns[':p' . $index++]  = 'fk_lead_product';
        }
        if ($this->isColumnModified(SpyProductPackagingUnitTableMap::COL_FK_PRODUCT)) {
            $modifiedColumns[':p' . $index++]  = 'fk_product';
        }
        if ($this->isColumnModified(SpyProductPackagingUnitTableMap::COL_FK_PRODUCT_PACKAGING_UNIT_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'fk_product_packaging_unit_type';
        }
        if ($this->isColumnModified(SpyProductPackagingUnitTableMap::COL_AMOUNT_INTERVAL)) {
            $modifiedColumns[':p' . $index++]  = 'amount_interval';
        }
        if ($this->isColumnModified(SpyProductPackagingUnitTableMap::COL_AMOUNT_MAX)) {
            $modifiedColumns[':p' . $index++]  = 'amount_max';
        }
        if ($this->isColumnModified(SpyProductPackagingUnitTableMap::COL_AMOUNT_MIN)) {
            $modifiedColumns[':p' . $index++]  = 'amount_min';
        }
        if ($this->isColumnModified(SpyProductPackagingUnitTableMap::COL_DEFAULT_AMOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'default_amount';
        }
        if ($this->isColumnModified(SpyProductPackagingUnitTableMap::COL_IS_AMOUNT_VARIABLE)) {
            $modifiedColumns[':p' . $index++]  = 'is_amount_variable';
        }
        if ($this->isColumnModified(SpyProductPackagingUnitTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(SpyProductPackagingUnitTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO spy_product_packaging_unit (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_product_packaging_unit':
                        $stmt->bindValue($identifier, $this->id_product_packaging_unit, PDO::PARAM_INT);

                        break;
                    case 'fk_lead_product':
                        $stmt->bindValue($identifier, $this->fk_lead_product, PDO::PARAM_INT);

                        break;
                    case 'fk_product':
                        $stmt->bindValue($identifier, $this->fk_product, PDO::PARAM_INT);

                        break;
                    case 'fk_product_packaging_unit_type':
                        $stmt->bindValue($identifier, $this->fk_product_packaging_unit_type, PDO::PARAM_INT);

                        break;
                    case 'amount_interval':
                        $stmt->bindValue($identifier, $this->amount_interval, PDO::PARAM_STR);

                        break;
                    case 'amount_max':
                        $stmt->bindValue($identifier, $this->amount_max, PDO::PARAM_STR);

                        break;
                    case 'amount_min':
                        $stmt->bindValue($identifier, $this->amount_min, PDO::PARAM_STR);

                        break;
                    case 'default_amount':
                        $stmt->bindValue($identifier, $this->default_amount, PDO::PARAM_STR);

                        break;
                    case 'is_amount_variable':
                        $stmt->bindValue($identifier, (int) $this->is_amount_variable, PDO::PARAM_INT);

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
            $pk = $con->lastInsertId('spy_product_packaging_unit_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdProductPackagingUnit($pk);

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
        $pos = SpyProductPackagingUnitTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdProductPackagingUnit();

            case 1:
                return $this->getFkLeadProduct();

            case 2:
                return $this->getFkProduct();

            case 3:
                return $this->getFkProductPackagingUnitType();

            case 4:
                return $this->getAmountInterval();

            case 5:
                return $this->getAmountMax();

            case 6:
                return $this->getAmountMin();

            case 7:
                return $this->getDefaultAmount();

            case 8:
                return $this->getIsAmountVariable();

            case 9:
                return $this->getCreatedAt();

            case 10:
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
        if (isset($alreadyDumpedObjects['SpyProductPackagingUnit'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyProductPackagingUnit'][$this->hashCode()] = true;
        $keys = SpyProductPackagingUnitTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdProductPackagingUnit(),
            $keys[1] => $this->getFkLeadProduct(),
            $keys[2] => $this->getFkProduct(),
            $keys[3] => $this->getFkProductPackagingUnitType(),
            $keys[4] => $this->getAmountInterval(),
            $keys[5] => $this->getAmountMax(),
            $keys[6] => $this->getAmountMin(),
            $keys[7] => $this->getDefaultAmount(),
            $keys[8] => $this->getIsAmountVariable(),
            $keys[9] => $this->getCreatedAt(),
            $keys[10] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[9]] instanceof \DateTimeInterface) {
            $result[$keys[9]] = $result[$keys[9]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[10]] instanceof \DateTimeInterface) {
            $result[$keys[10]] = $result[$keys[10]]->format('Y-m-d H:i:s.u');
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
            if (null !== $this->aLeadProduct) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProduct';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product';
                        break;
                    default:
                        $key = 'LeadProduct';
                }

                $result[$key] = $this->aLeadProduct->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aProductPackagingUnitType) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductPackagingUnitType';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_packaging_unit_type';
                        break;
                    default:
                        $key = 'ProductPackagingUnitType';
                }

                $result[$key] = $this->aProductPackagingUnitType->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = SpyProductPackagingUnitTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdProductPackagingUnit($value);
                break;
            case 1:
                $this->setFkLeadProduct($value);
                break;
            case 2:
                $this->setFkProduct($value);
                break;
            case 3:
                $this->setFkProductPackagingUnitType($value);
                break;
            case 4:
                $this->setAmountInterval($value);
                break;
            case 5:
                $this->setAmountMax($value);
                break;
            case 6:
                $this->setAmountMin($value);
                break;
            case 7:
                $this->setDefaultAmount($value);
                break;
            case 8:
                $this->setIsAmountVariable($value);
                break;
            case 9:
                $this->setCreatedAt($value);
                break;
            case 10:
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
        $keys = SpyProductPackagingUnitTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdProductPackagingUnit($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkLeadProduct($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setFkProduct($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setFkProductPackagingUnitType($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setAmountInterval($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setAmountMax($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setAmountMin($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setDefaultAmount($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setIsAmountVariable($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setCreatedAt($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setUpdatedAt($arr[$keys[10]]);
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
        $criteria = new Criteria(SpyProductPackagingUnitTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyProductPackagingUnitTableMap::COL_ID_PRODUCT_PACKAGING_UNIT)) {
            $criteria->add(SpyProductPackagingUnitTableMap::COL_ID_PRODUCT_PACKAGING_UNIT, $this->id_product_packaging_unit);
        }
        if ($this->isColumnModified(SpyProductPackagingUnitTableMap::COL_FK_LEAD_PRODUCT)) {
            $criteria->add(SpyProductPackagingUnitTableMap::COL_FK_LEAD_PRODUCT, $this->fk_lead_product);
        }
        if ($this->isColumnModified(SpyProductPackagingUnitTableMap::COL_FK_PRODUCT)) {
            $criteria->add(SpyProductPackagingUnitTableMap::COL_FK_PRODUCT, $this->fk_product);
        }
        if ($this->isColumnModified(SpyProductPackagingUnitTableMap::COL_FK_PRODUCT_PACKAGING_UNIT_TYPE)) {
            $criteria->add(SpyProductPackagingUnitTableMap::COL_FK_PRODUCT_PACKAGING_UNIT_TYPE, $this->fk_product_packaging_unit_type);
        }
        if ($this->isColumnModified(SpyProductPackagingUnitTableMap::COL_AMOUNT_INTERVAL)) {
            $criteria->add(SpyProductPackagingUnitTableMap::COL_AMOUNT_INTERVAL, $this->amount_interval);
        }
        if ($this->isColumnModified(SpyProductPackagingUnitTableMap::COL_AMOUNT_MAX)) {
            $criteria->add(SpyProductPackagingUnitTableMap::COL_AMOUNT_MAX, $this->amount_max);
        }
        if ($this->isColumnModified(SpyProductPackagingUnitTableMap::COL_AMOUNT_MIN)) {
            $criteria->add(SpyProductPackagingUnitTableMap::COL_AMOUNT_MIN, $this->amount_min);
        }
        if ($this->isColumnModified(SpyProductPackagingUnitTableMap::COL_DEFAULT_AMOUNT)) {
            $criteria->add(SpyProductPackagingUnitTableMap::COL_DEFAULT_AMOUNT, $this->default_amount);
        }
        if ($this->isColumnModified(SpyProductPackagingUnitTableMap::COL_IS_AMOUNT_VARIABLE)) {
            $criteria->add(SpyProductPackagingUnitTableMap::COL_IS_AMOUNT_VARIABLE, $this->is_amount_variable);
        }
        if ($this->isColumnModified(SpyProductPackagingUnitTableMap::COL_CREATED_AT)) {
            $criteria->add(SpyProductPackagingUnitTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpyProductPackagingUnitTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpyProductPackagingUnitTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildSpyProductPackagingUnitQuery::create();
        $criteria->add(SpyProductPackagingUnitTableMap::COL_ID_PRODUCT_PACKAGING_UNIT, $this->id_product_packaging_unit);

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
        $validPk = null !== $this->getIdProductPackagingUnit();

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
        return $this->getIdProductPackagingUnit();
    }

    /**
     * Generic method to set the primary key (id_product_packaging_unit column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdProductPackagingUnit($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdProductPackagingUnit();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnit (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkLeadProduct($this->getFkLeadProduct());
        $copyObj->setFkProduct($this->getFkProduct());
        $copyObj->setFkProductPackagingUnitType($this->getFkProductPackagingUnitType());
        $copyObj->setAmountInterval($this->getAmountInterval());
        $copyObj->setAmountMax($this->getAmountMax());
        $copyObj->setAmountMin($this->getAmountMin());
        $copyObj->setDefaultAmount($this->getDefaultAmount());
        $copyObj->setIsAmountVariable($this->getIsAmountVariable());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdProductPackagingUnit(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnit Clone of current object.
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
     * @param SpyProduct $v
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
            $v->addSpyProductPackagingUnitRelatedByFkProduct($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyProduct object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyProduct The associated SpyProduct object.
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
                $this->aProduct->addSpyProductPackagingUnitsRelatedByFkProduct($this);
             */
        }

        return $this->aProduct;
    }

    /**
     * Declares an association between this object and a SpyProduct object.
     *
     * @param SpyProduct $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setLeadProduct(SpyProduct $v = null)
    {
        if ($v === null) {
            $this->setFkLeadProduct(NULL);
        } else {
            $this->setFkLeadProduct($v->getIdProduct());
        }

        $this->aLeadProduct = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyProduct object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyProductPackagingUnitRelatedByFkLeadProduct($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyProduct object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyProduct The associated SpyProduct object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getLeadProduct(?ConnectionInterface $con = null)
    {
        if ($this->aLeadProduct === null && ($this->fk_lead_product != 0)) {
            $this->aLeadProduct = SpyProductQuery::create()->findPk($this->fk_lead_product, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLeadProduct->addSpyProductPackagingUnitsRelatedByFkLeadProduct($this);
             */
        }

        return $this->aLeadProduct;
    }

    /**
     * Declares an association between this object and a ChildSpyProductPackagingUnitType object.
     *
     * @param ChildSpyProductPackagingUnitType $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setProductPackagingUnitType(ChildSpyProductPackagingUnitType $v = null)
    {
        if ($v === null) {
            $this->setFkProductPackagingUnitType(NULL);
        } else {
            $this->setFkProductPackagingUnitType($v->getIdProductPackagingUnitType());
        }

        $this->aProductPackagingUnitType = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpyProductPackagingUnitType object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyProductPackagingUnit($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpyProductPackagingUnitType object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSpyProductPackagingUnitType The associated ChildSpyProductPackagingUnitType object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getProductPackagingUnitType(?ConnectionInterface $con = null)
    {
        if ($this->aProductPackagingUnitType === null && ($this->fk_product_packaging_unit_type != 0)) {
            $this->aProductPackagingUnitType = ChildSpyProductPackagingUnitTypeQuery::create()->findPk($this->fk_product_packaging_unit_type, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aProductPackagingUnitType->addSpyProductPackagingUnits($this);
             */
        }

        return $this->aProductPackagingUnitType;
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
            $this->aProduct->removeSpyProductPackagingUnitRelatedByFkProduct($this);
        }
        if (null !== $this->aLeadProduct) {
            $this->aLeadProduct->removeSpyProductPackagingUnitRelatedByFkLeadProduct($this);
        }
        if (null !== $this->aProductPackagingUnitType) {
            $this->aProductPackagingUnitType->removeSpyProductPackagingUnit($this);
        }
        $this->id_product_packaging_unit = null;
        $this->fk_lead_product = null;
        $this->fk_product = null;
        $this->fk_product_packaging_unit_type = null;
        $this->amount_interval = null;
        $this->amount_max = null;
        $this->amount_min = null;
        $this->default_amount = null;
        $this->is_amount_variable = null;
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

        $this->aProduct = null;
        $this->aLeadProduct = null;
        $this->aProductPackagingUnitType = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyProductPackagingUnitTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return $this The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[SpyProductPackagingUnitTableMap::COL_UPDATED_AT] = true;

        return $this;
    }

    // event behavior

    /**
     * @return void
     */
    protected function prepareSaveEventName()
    {
        if ($this->isNew()) {
            $this->_eventName = 'Entity.spy_product_packaging_unit.create';
        } else {
            $this->_eventName = 'Entity.spy_product_packaging_unit.update';
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

        if ($this->_eventName !== 'Entity.spy_product_packaging_unit.create') {
            if (!$this->_isModified) {
                return;
            }

            if (!$this->isEventColumnsModified()) {
                return;
            }
        }

        $data = [
            'name' => 'spy_product_packaging_unit',
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
            'name' => 'spy_product_packaging_unit',
            'id' => !is_array($this->getPrimaryKey()) ? $this->getPrimaryKey() : null,
            'event' => 'Entity.spy_product_packaging_unit.delete',
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
            $field = str_replace('spy_product_packaging_unit.', '', $modifiedColumn);
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
            $field = str_replace('spy_product_packaging_unit.', '', $additionalValueColumnName);
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
        $columnType = SpyProductPackagingUnitTableMap::getTableMap()->getColumn($column)->getType();
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
