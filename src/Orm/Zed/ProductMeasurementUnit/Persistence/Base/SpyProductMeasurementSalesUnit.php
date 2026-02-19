<?php

namespace Orm\Zed\ProductMeasurementUnit\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnit as ChildSpyProductMeasurementBaseUnit;
use Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnitQuery as ChildSpyProductMeasurementBaseUnitQuery;
use Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnit as ChildSpyProductMeasurementSalesUnit;
use Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitQuery as ChildSpyProductMeasurementSalesUnitQuery;
use Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStore as ChildSpyProductMeasurementSalesUnitStore;
use Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStoreQuery as ChildSpyProductMeasurementSalesUnitStoreQuery;
use Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementUnit as ChildSpyProductMeasurementUnit;
use Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementUnitQuery as ChildSpyProductMeasurementUnitQuery;
use Orm\Zed\ProductMeasurementUnit\Persistence\Map\SpyProductMeasurementSalesUnitStoreTableMap;
use Orm\Zed\ProductMeasurementUnit\Persistence\Map\SpyProductMeasurementSalesUnitTableMap;
use Orm\Zed\Product\Persistence\SpyProduct;
use Orm\Zed\Product\Persistence\SpyProductQuery;
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
 * Base class that represents a row from the 'spy_product_measurement_sales_unit' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.ProductMeasurementUnit.Persistence.Base
 */
abstract class SpyProductMeasurementSalesUnit implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\ProductMeasurementUnit\\Persistence\\Map\\SpyProductMeasurementSalesUnitTableMap';


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
     * The value for the id_product_measurement_sales_unit field.
     *
     * @var        int
     */
    protected $id_product_measurement_sales_unit;

    /**
     * The value for the fk_product field.
     *
     * @var        int
     */
    protected $fk_product;

    /**
     * The value for the fk_product_measurement_base_unit field.
     *
     * @var        int
     */
    protected $fk_product_measurement_base_unit;

    /**
     * The value for the fk_product_measurement_unit field.
     *
     * @var        int
     */
    protected $fk_product_measurement_unit;

    /**
     * The value for the conversion field.
     * The conversion factor between a sales unit and a base unit.
     * @var        double|null
     */
    protected $conversion;

    /**
     * The value for the is_default field.
     * A flag indicating if an entity is the default one.
     * @var        boolean
     */
    protected $is_default;

    /**
     * The value for the is_displayed field.
     * A flag indicating if a sales unit should be displayed to the customer.
     * @var        boolean
     */
    protected $is_displayed;

    /**
     * The value for the key field.
     * A unique key used to identify an entity or a piece of data.
     * @var        string|null
     */
    protected $key;

    /**
     * The value for the precision field.
     * The total number of digits in a decimal value.
     * @var        int|null
     */
    protected $precision;

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
     * @var        ChildSpyProductMeasurementUnit
     */
    protected $aProductMeasurementUnit;

    /**
     * @var        ChildSpyProductMeasurementBaseUnit
     */
    protected $aProductMeasurementBaseUnit;

    /**
     * @var        ObjectCollection|ChildSpyProductMeasurementSalesUnitStore[] Collection to store aggregation of ChildSpyProductMeasurementSalesUnitStore objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyProductMeasurementSalesUnitStore> Collection to store aggregation of ChildSpyProductMeasurementSalesUnitStore objects.
     */
    protected $collSpyProductMeasurementSalesUnitStores;
    protected $collSpyProductMeasurementSalesUnitStoresPartial;

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
        'spy_product_measurement_sales_unit.fk_product' => 'fk_product',
        'spy_product_measurement_sales_unit.fk_product_measurement_unit' => 'fk_product_measurement_unit',
        'spy_product_measurement_sales_unit.fk_product_measurement_base_unit' => 'fk_product_measurement_base_unit',
    ];

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyProductMeasurementSalesUnitStore[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyProductMeasurementSalesUnitStore>
     */
    protected $spyProductMeasurementSalesUnitStoresScheduledForDeletion = null;

    /**
     * Initializes internal state of Orm\Zed\ProductMeasurementUnit\Persistence\Base\SpyProductMeasurementSalesUnit object.
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
     * Compares this with another <code>SpyProductMeasurementSalesUnit</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyProductMeasurementSalesUnit</code>, delegates to
     * <code>equals(SpyProductMeasurementSalesUnit)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_product_measurement_sales_unit] column value.
     *
     * @return int
     */
    public function getIdProductMeasurementSalesUnit()
    {
        return $this->id_product_measurement_sales_unit;
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
     * Get the [fk_product_measurement_base_unit] column value.
     *
     * @return int
     */
    public function getFkProductMeasurementBaseUnit()
    {
        return $this->fk_product_measurement_base_unit;
    }

    /**
     * Get the [fk_product_measurement_unit] column value.
     *
     * @return int
     */
    public function getFkProductMeasurementUnit()
    {
        return $this->fk_product_measurement_unit;
    }

    /**
     * Get the [conversion] column value.
     * The conversion factor between a sales unit and a base unit.
     * @return double|null
     */
    public function getConversion()
    {
        return $this->conversion;
    }

    /**
     * Get the [is_default] column value.
     * A flag indicating if an entity is the default one.
     * @return boolean
     */
    public function getIsDefault()
    {
        return $this->is_default;
    }

    /**
     * Get the [is_default] column value.
     * A flag indicating if an entity is the default one.
     * @return boolean
     */
    public function isDefault()
    {
        return $this->getIsDefault();
    }

    /**
     * Get the [is_displayed] column value.
     * A flag indicating if a sales unit should be displayed to the customer.
     * @return boolean
     */
    public function getIsDisplayed()
    {
        return $this->is_displayed;
    }

    /**
     * Get the [is_displayed] column value.
     * A flag indicating if a sales unit should be displayed to the customer.
     * @return boolean
     */
    public function isDisplayed()
    {
        return $this->getIsDisplayed();
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
     * Get the [precision] column value.
     * The total number of digits in a decimal value.
     * @return int|null
     */
    public function getPrecision()
    {
        return $this->precision;
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
     * Set the value of [id_product_measurement_sales_unit] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdProductMeasurementSalesUnit($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_product_measurement_sales_unit !== $v) {
            $this->id_product_measurement_sales_unit = $v;
            $this->modifiedColumns[SpyProductMeasurementSalesUnitTableMap::COL_ID_PRODUCT_MEASUREMENT_SALES_UNIT] = true;
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
            $this->modifiedColumns[SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT] = true;
        }

        if ($this->aProduct !== null && $this->aProduct->getIdProduct() !== $v) {
            $this->aProduct = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_product_measurement_base_unit] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkProductMeasurementBaseUnit($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_product_measurement_base_unit !== $v) {
            $this->fk_product_measurement_base_unit = $v;
            $this->modifiedColumns[SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_BASE_UNIT] = true;
        }

        if ($this->aProductMeasurementBaseUnit !== null && $this->aProductMeasurementBaseUnit->getIdProductMeasurementBaseUnit() !== $v) {
            $this->aProductMeasurementBaseUnit = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_product_measurement_unit] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkProductMeasurementUnit($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_product_measurement_unit !== $v) {
            $this->fk_product_measurement_unit = $v;
            $this->modifiedColumns[SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_UNIT] = true;
        }

        if ($this->aProductMeasurementUnit !== null && $this->aProductMeasurementUnit->getIdProductMeasurementUnit() !== $v) {
            $this->aProductMeasurementUnit = null;
        }

        return $this;
    }

    /**
     * Set the value of [conversion] column.
     * The conversion factor between a sales unit and a base unit.
     * @param double|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setConversion($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->conversion !== $v) {
            $this->conversion = $v;
            $this->modifiedColumns[SpyProductMeasurementSalesUnitTableMap::COL_CONVERSION] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_default] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * A flag indicating if an entity is the default one.
     * @param bool|integer|string $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsDefault($v)
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

        if (($this->isNew() && $hasDefaultValue) || $this->is_default !== $v) {
            $this->is_default = $v;
            $this->modifiedColumns[SpyProductMeasurementSalesUnitTableMap::COL_IS_DEFAULT] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_displayed] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * A flag indicating if a sales unit should be displayed to the customer.
     * @param bool|integer|string $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsDisplayed($v)
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

        if (($this->isNew() && $hasDefaultValue) || $this->is_displayed !== $v) {
            $this->is_displayed = $v;
            $this->modifiedColumns[SpyProductMeasurementSalesUnitTableMap::COL_IS_DISPLAYED] = true;
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
            $this->modifiedColumns[SpyProductMeasurementSalesUnitTableMap::COL_KEY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [precision] column.
     * The total number of digits in a decimal value.
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPrecision($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->precision !== $v) {
            $this->precision = $v;
            $this->modifiedColumns[SpyProductMeasurementSalesUnitTableMap::COL_PRECISION] = true;
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
                $this->modifiedColumns[SpyProductMeasurementSalesUnitTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SpyProductMeasurementSalesUnitTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyProductMeasurementSalesUnitTableMap::translateFieldName('IdProductMeasurementSalesUnit', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_product_measurement_sales_unit = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyProductMeasurementSalesUnitTableMap::translateFieldName('FkProduct', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_product = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyProductMeasurementSalesUnitTableMap::translateFieldName('FkProductMeasurementBaseUnit', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_product_measurement_base_unit = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyProductMeasurementSalesUnitTableMap::translateFieldName('FkProductMeasurementUnit', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_product_measurement_unit = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyProductMeasurementSalesUnitTableMap::translateFieldName('Conversion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->conversion = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyProductMeasurementSalesUnitTableMap::translateFieldName('IsDefault', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_default = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpyProductMeasurementSalesUnitTableMap::translateFieldName('IsDisplayed', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_displayed = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpyProductMeasurementSalesUnitTableMap::translateFieldName('Key', TableMap::TYPE_PHPNAME, $indexType)];
            $this->key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SpyProductMeasurementSalesUnitTableMap::translateFieldName('Precision', TableMap::TYPE_PHPNAME, $indexType)];
            $this->precision = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SpyProductMeasurementSalesUnitTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SpyProductMeasurementSalesUnitTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 11; // 11 = SpyProductMeasurementSalesUnitTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\ProductMeasurementUnit\\Persistence\\SpyProductMeasurementSalesUnit'), 0, $e);
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
        if ($this->aProduct !== null && $this->fk_product !== $this->aProduct->getIdProduct()) {
            $this->aProduct = null;
        }
        if ($this->aProductMeasurementBaseUnit !== null && $this->fk_product_measurement_base_unit !== $this->aProductMeasurementBaseUnit->getIdProductMeasurementBaseUnit()) {
            $this->aProductMeasurementBaseUnit = null;
        }
        if ($this->aProductMeasurementUnit !== null && $this->fk_product_measurement_unit !== $this->aProductMeasurementUnit->getIdProductMeasurementUnit()) {
            $this->aProductMeasurementUnit = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyProductMeasurementSalesUnitTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyProductMeasurementSalesUnitQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aProduct = null;
            $this->aProductMeasurementUnit = null;
            $this->aProductMeasurementBaseUnit = null;
            $this->collSpyProductMeasurementSalesUnitStores = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyProductMeasurementSalesUnit::setDeleted()
     * @see SpyProductMeasurementSalesUnit::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductMeasurementSalesUnitTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyProductMeasurementSalesUnitQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductMeasurementSalesUnitTableMap::DATABASE_NAME);
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
                if (!$this->isColumnModified(SpyProductMeasurementSalesUnitTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpyProductMeasurementSalesUnitTableMap::COL_UPDATED_AT)) {
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
                if ($this->isModified() && !$this->isColumnModified(SpyProductMeasurementSalesUnitTableMap::COL_UPDATED_AT)) {
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

                SpyProductMeasurementSalesUnitTableMap::addInstanceToPool($this);
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

            if ($this->aProductMeasurementUnit !== null) {
                if ($this->aProductMeasurementUnit->isModified() || $this->aProductMeasurementUnit->isNew()) {
                    $affectedRows += $this->aProductMeasurementUnit->save($con);
                }
                $this->setProductMeasurementUnit($this->aProductMeasurementUnit);
            }

            if ($this->aProductMeasurementBaseUnit !== null) {
                if ($this->aProductMeasurementBaseUnit->isModified() || $this->aProductMeasurementBaseUnit->isNew()) {
                    $affectedRows += $this->aProductMeasurementBaseUnit->save($con);
                }
                $this->setProductMeasurementBaseUnit($this->aProductMeasurementBaseUnit);
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

            if ($this->spyProductMeasurementSalesUnitStoresScheduledForDeletion !== null) {
                if (!$this->spyProductMeasurementSalesUnitStoresScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStoreQuery::create()
                        ->filterByPrimaryKeys($this->spyProductMeasurementSalesUnitStoresScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductMeasurementSalesUnitStoresScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductMeasurementSalesUnitStores !== null) {
                foreach ($this->collSpyProductMeasurementSalesUnitStores as $referrerFK) {
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

        $this->modifiedColumns[SpyProductMeasurementSalesUnitTableMap::COL_ID_PRODUCT_MEASUREMENT_SALES_UNIT] = true;

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyProductMeasurementSalesUnitTableMap::COL_ID_PRODUCT_MEASUREMENT_SALES_UNIT)) {
            $modifiedColumns[':p' . $index++]  = '`id_product_measurement_sales_unit`';
        }
        if ($this->isColumnModified(SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT)) {
            $modifiedColumns[':p' . $index++]  = '`fk_product`';
        }
        if ($this->isColumnModified(SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_BASE_UNIT)) {
            $modifiedColumns[':p' . $index++]  = '`fk_product_measurement_base_unit`';
        }
        if ($this->isColumnModified(SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_UNIT)) {
            $modifiedColumns[':p' . $index++]  = '`fk_product_measurement_unit`';
        }
        if ($this->isColumnModified(SpyProductMeasurementSalesUnitTableMap::COL_CONVERSION)) {
            $modifiedColumns[':p' . $index++]  = '`conversion`';
        }
        if ($this->isColumnModified(SpyProductMeasurementSalesUnitTableMap::COL_IS_DEFAULT)) {
            $modifiedColumns[':p' . $index++]  = '`is_default`';
        }
        if ($this->isColumnModified(SpyProductMeasurementSalesUnitTableMap::COL_IS_DISPLAYED)) {
            $modifiedColumns[':p' . $index++]  = '`is_displayed`';
        }
        if ($this->isColumnModified(SpyProductMeasurementSalesUnitTableMap::COL_KEY)) {
            $modifiedColumns[':p' . $index++]  = '`key`';
        }
        if ($this->isColumnModified(SpyProductMeasurementSalesUnitTableMap::COL_PRECISION)) {
            $modifiedColumns[':p' . $index++]  = '`precision`';
        }
        if ($this->isColumnModified(SpyProductMeasurementSalesUnitTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(SpyProductMeasurementSalesUnitTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }

        $sql = sprintf(
            'INSERT INTO `spy_product_measurement_sales_unit` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id_product_measurement_sales_unit`':
                        $stmt->bindValue($identifier, $this->id_product_measurement_sales_unit, PDO::PARAM_INT);

                        break;
                    case '`fk_product`':
                        $stmt->bindValue($identifier, $this->fk_product, PDO::PARAM_INT);

                        break;
                    case '`fk_product_measurement_base_unit`':
                        $stmt->bindValue($identifier, $this->fk_product_measurement_base_unit, PDO::PARAM_INT);

                        break;
                    case '`fk_product_measurement_unit`':
                        $stmt->bindValue($identifier, $this->fk_product_measurement_unit, PDO::PARAM_INT);

                        break;
                    case '`conversion`':
                        $stmt->bindValue($identifier, $this->conversion, PDO::PARAM_STR);

                        break;
                    case '`is_default`':
                        $stmt->bindValue($identifier, (int) $this->is_default, PDO::PARAM_INT);

                        break;
                    case '`is_displayed`':
                        $stmt->bindValue($identifier, (int) $this->is_displayed, PDO::PARAM_INT);

                        break;
                    case '`key`':
                        $stmt->bindValue($identifier, $this->key, PDO::PARAM_STR);

                        break;
                    case '`precision`':
                        $stmt->bindValue($identifier, $this->precision, PDO::PARAM_INT);

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
            $pk = $con->lastInsertId('id_product_measurement_sales_unit_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        if ($pk !== null) {
            $this->setIdProductMeasurementSalesUnit($pk);
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
        $pos = SpyProductMeasurementSalesUnitTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdProductMeasurementSalesUnit();

            case 1:
                return $this->getFkProduct();

            case 2:
                return $this->getFkProductMeasurementBaseUnit();

            case 3:
                return $this->getFkProductMeasurementUnit();

            case 4:
                return $this->getConversion();

            case 5:
                return $this->getIsDefault();

            case 6:
                return $this->getIsDisplayed();

            case 7:
                return $this->getKey();

            case 8:
                return $this->getPrecision();

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
        if (isset($alreadyDumpedObjects['SpyProductMeasurementSalesUnit'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyProductMeasurementSalesUnit'][$this->hashCode()] = true;
        $keys = SpyProductMeasurementSalesUnitTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdProductMeasurementSalesUnit(),
            $keys[1] => $this->getFkProduct(),
            $keys[2] => $this->getFkProductMeasurementBaseUnit(),
            $keys[3] => $this->getFkProductMeasurementUnit(),
            $keys[4] => $this->getConversion(),
            $keys[5] => $this->getIsDefault(),
            $keys[6] => $this->getIsDisplayed(),
            $keys[7] => $this->getKey(),
            $keys[8] => $this->getPrecision(),
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
            if (null !== $this->aProductMeasurementUnit) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductMeasurementUnit';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_measurement_unit';
                        break;
                    default:
                        $key = 'ProductMeasurementUnit';
                }

                $result[$key] = $this->aProductMeasurementUnit->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aProductMeasurementBaseUnit) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductMeasurementBaseUnit';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_measurement_base_unit';
                        break;
                    default:
                        $key = 'ProductMeasurementBaseUnit';
                }

                $result[$key] = $this->aProductMeasurementBaseUnit->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collSpyProductMeasurementSalesUnitStores) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductMeasurementSalesUnitStores';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_measurement_sales_unit_stores';
                        break;
                    default:
                        $key = 'SpyProductMeasurementSalesUnitStores';
                }

                $result[$key] = $this->collSpyProductMeasurementSalesUnitStores->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyProductMeasurementSalesUnitTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdProductMeasurementSalesUnit($value);
                break;
            case 1:
                $this->setFkProduct($value);
                break;
            case 2:
                $this->setFkProductMeasurementBaseUnit($value);
                break;
            case 3:
                $this->setFkProductMeasurementUnit($value);
                break;
            case 4:
                $this->setConversion($value);
                break;
            case 5:
                $this->setIsDefault($value);
                break;
            case 6:
                $this->setIsDisplayed($value);
                break;
            case 7:
                $this->setKey($value);
                break;
            case 8:
                $this->setPrecision($value);
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
        $keys = SpyProductMeasurementSalesUnitTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdProductMeasurementSalesUnit($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkProduct($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setFkProductMeasurementBaseUnit($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setFkProductMeasurementUnit($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setConversion($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setIsDefault($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setIsDisplayed($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setKey($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setPrecision($arr[$keys[8]]);
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
        $criteria = new Criteria(SpyProductMeasurementSalesUnitTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyProductMeasurementSalesUnitTableMap::COL_ID_PRODUCT_MEASUREMENT_SALES_UNIT)) {
            $criteria->add(SpyProductMeasurementSalesUnitTableMap::COL_ID_PRODUCT_MEASUREMENT_SALES_UNIT, $this->id_product_measurement_sales_unit);
        }
        if ($this->isColumnModified(SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT)) {
            $criteria->add(SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT, $this->fk_product);
        }
        if ($this->isColumnModified(SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_BASE_UNIT)) {
            $criteria->add(SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_BASE_UNIT, $this->fk_product_measurement_base_unit);
        }
        if ($this->isColumnModified(SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_UNIT)) {
            $criteria->add(SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_UNIT, $this->fk_product_measurement_unit);
        }
        if ($this->isColumnModified(SpyProductMeasurementSalesUnitTableMap::COL_CONVERSION)) {
            $criteria->add(SpyProductMeasurementSalesUnitTableMap::COL_CONVERSION, $this->conversion);
        }
        if ($this->isColumnModified(SpyProductMeasurementSalesUnitTableMap::COL_IS_DEFAULT)) {
            $criteria->add(SpyProductMeasurementSalesUnitTableMap::COL_IS_DEFAULT, $this->is_default);
        }
        if ($this->isColumnModified(SpyProductMeasurementSalesUnitTableMap::COL_IS_DISPLAYED)) {
            $criteria->add(SpyProductMeasurementSalesUnitTableMap::COL_IS_DISPLAYED, $this->is_displayed);
        }
        if ($this->isColumnModified(SpyProductMeasurementSalesUnitTableMap::COL_KEY)) {
            $criteria->add(SpyProductMeasurementSalesUnitTableMap::COL_KEY, $this->key);
        }
        if ($this->isColumnModified(SpyProductMeasurementSalesUnitTableMap::COL_PRECISION)) {
            $criteria->add(SpyProductMeasurementSalesUnitTableMap::COL_PRECISION, $this->precision);
        }
        if ($this->isColumnModified(SpyProductMeasurementSalesUnitTableMap::COL_CREATED_AT)) {
            $criteria->add(SpyProductMeasurementSalesUnitTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpyProductMeasurementSalesUnitTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpyProductMeasurementSalesUnitTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildSpyProductMeasurementSalesUnitQuery::create();
        $criteria->add(SpyProductMeasurementSalesUnitTableMap::COL_ID_PRODUCT_MEASUREMENT_SALES_UNIT, $this->id_product_measurement_sales_unit);

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
        $validPk = null !== $this->getIdProductMeasurementSalesUnit();

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
        return $this->getIdProductMeasurementSalesUnit();
    }

    /**
     * Generic method to set the primary key (id_product_measurement_sales_unit column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdProductMeasurementSalesUnit($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdProductMeasurementSalesUnit();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnit (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkProduct($this->getFkProduct());
        $copyObj->setFkProductMeasurementBaseUnit($this->getFkProductMeasurementBaseUnit());
        $copyObj->setFkProductMeasurementUnit($this->getFkProductMeasurementUnit());
        $copyObj->setConversion($this->getConversion());
        $copyObj->setIsDefault($this->getIsDefault());
        $copyObj->setIsDisplayed($this->getIsDisplayed());
        $copyObj->setKey($this->getKey());
        $copyObj->setPrecision($this->getPrecision());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyProductMeasurementSalesUnitStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductMeasurementSalesUnitStore($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdProductMeasurementSalesUnit(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnit Clone of current object.
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
            $v->addSpyProductMeasurementSalesUnit($this);
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
                $this->aProduct->addSpyProductMeasurementSalesUnits($this);
             */
        }

        return $this->aProduct;
    }

    /**
     * Declares an association between this object and a ChildSpyProductMeasurementUnit object.
     *
     * @param ChildSpyProductMeasurementUnit $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setProductMeasurementUnit(ChildSpyProductMeasurementUnit $v = null)
    {
        if ($v === null) {
            $this->setFkProductMeasurementUnit(NULL);
        } else {
            $this->setFkProductMeasurementUnit($v->getIdProductMeasurementUnit());
        }

        $this->aProductMeasurementUnit = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpyProductMeasurementUnit object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyProductMeasurementSalesUnit($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpyProductMeasurementUnit object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSpyProductMeasurementUnit The associated ChildSpyProductMeasurementUnit object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getProductMeasurementUnit(?ConnectionInterface $con = null)
    {
        if ($this->aProductMeasurementUnit === null && ($this->fk_product_measurement_unit != 0)) {
            $this->aProductMeasurementUnit = ChildSpyProductMeasurementUnitQuery::create()->findPk($this->fk_product_measurement_unit, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aProductMeasurementUnit->addSpyProductMeasurementSalesUnits($this);
             */
        }

        return $this->aProductMeasurementUnit;
    }

    /**
     * Declares an association between this object and a ChildSpyProductMeasurementBaseUnit object.
     *
     * @param ChildSpyProductMeasurementBaseUnit $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setProductMeasurementBaseUnit(ChildSpyProductMeasurementBaseUnit $v = null)
    {
        if ($v === null) {
            $this->setFkProductMeasurementBaseUnit(NULL);
        } else {
            $this->setFkProductMeasurementBaseUnit($v->getIdProductMeasurementBaseUnit());
        }

        $this->aProductMeasurementBaseUnit = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpyProductMeasurementBaseUnit object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyProductMeasurementSalesUnit($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpyProductMeasurementBaseUnit object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSpyProductMeasurementBaseUnit The associated ChildSpyProductMeasurementBaseUnit object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getProductMeasurementBaseUnit(?ConnectionInterface $con = null)
    {
        if ($this->aProductMeasurementBaseUnit === null && ($this->fk_product_measurement_base_unit != 0)) {
            $this->aProductMeasurementBaseUnit = ChildSpyProductMeasurementBaseUnitQuery::create()->findPk($this->fk_product_measurement_base_unit, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aProductMeasurementBaseUnit->addSpyProductMeasurementSalesUnits($this);
             */
        }

        return $this->aProductMeasurementBaseUnit;
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
        if ('SpyProductMeasurementSalesUnitStore' === $relationName) {
            $this->initSpyProductMeasurementSalesUnitStores();
            return;
        }
    }

    /**
     * Clears out the collSpyProductMeasurementSalesUnitStores collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductMeasurementSalesUnitStores()
     */
    public function clearSpyProductMeasurementSalesUnitStores()
    {
        $this->collSpyProductMeasurementSalesUnitStores = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductMeasurementSalesUnitStores collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductMeasurementSalesUnitStores($v = true): void
    {
        $this->collSpyProductMeasurementSalesUnitStoresPartial = $v;
    }

    /**
     * Initializes the collSpyProductMeasurementSalesUnitStores collection.
     *
     * By default this just sets the collSpyProductMeasurementSalesUnitStores collection to an empty array (like clearcollSpyProductMeasurementSalesUnitStores());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductMeasurementSalesUnitStores(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductMeasurementSalesUnitStores && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductMeasurementSalesUnitStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductMeasurementSalesUnitStores = new $collectionClassName;
        $this->collSpyProductMeasurementSalesUnitStores->setModel('\Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStore');
    }

    /**
     * Gets an array of ChildSpyProductMeasurementSalesUnitStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductMeasurementSalesUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyProductMeasurementSalesUnitStore[] List of ChildSpyProductMeasurementSalesUnitStore objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyProductMeasurementSalesUnitStore> List of ChildSpyProductMeasurementSalesUnitStore objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductMeasurementSalesUnitStores(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductMeasurementSalesUnitStoresPartial && !$this->isNew();
        if (null === $this->collSpyProductMeasurementSalesUnitStores || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductMeasurementSalesUnitStores) {
                    $this->initSpyProductMeasurementSalesUnitStores();
                } else {
                    $collectionClassName = SpyProductMeasurementSalesUnitStoreTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductMeasurementSalesUnitStores = new $collectionClassName;
                    $collSpyProductMeasurementSalesUnitStores->setModel('\Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStore');

                    return $collSpyProductMeasurementSalesUnitStores;
                }
            } else {
                $collSpyProductMeasurementSalesUnitStores = ChildSpyProductMeasurementSalesUnitStoreQuery::create(null, $criteria)
                    ->filterBySpyProductMeasurementSalesUnit($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductMeasurementSalesUnitStoresPartial && count($collSpyProductMeasurementSalesUnitStores)) {
                        $this->initSpyProductMeasurementSalesUnitStores(false);

                        foreach ($collSpyProductMeasurementSalesUnitStores as $obj) {
                            if (false == $this->collSpyProductMeasurementSalesUnitStores->contains($obj)) {
                                $this->collSpyProductMeasurementSalesUnitStores->append($obj);
                            }
                        }

                        $this->collSpyProductMeasurementSalesUnitStoresPartial = true;
                    }

                    return $collSpyProductMeasurementSalesUnitStores;
                }

                if ($partial && $this->collSpyProductMeasurementSalesUnitStores) {
                    foreach ($this->collSpyProductMeasurementSalesUnitStores as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductMeasurementSalesUnitStores[] = $obj;
                        }
                    }
                }

                $this->collSpyProductMeasurementSalesUnitStores = $collSpyProductMeasurementSalesUnitStores;
                $this->collSpyProductMeasurementSalesUnitStoresPartial = false;
            }
        }

        return $this->collSpyProductMeasurementSalesUnitStores;
    }

    /**
     * Sets a collection of ChildSpyProductMeasurementSalesUnitStore objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductMeasurementSalesUnitStores A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductMeasurementSalesUnitStores(Collection $spyProductMeasurementSalesUnitStores, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyProductMeasurementSalesUnitStore[] $spyProductMeasurementSalesUnitStoresToDelete */
        $spyProductMeasurementSalesUnitStoresToDelete = $this->getSpyProductMeasurementSalesUnitStores(new Criteria(), $con)->diff($spyProductMeasurementSalesUnitStores);


        $this->spyProductMeasurementSalesUnitStoresScheduledForDeletion = $spyProductMeasurementSalesUnitStoresToDelete;

        foreach ($spyProductMeasurementSalesUnitStoresToDelete as $spyProductMeasurementSalesUnitStoreRemoved) {
            $spyProductMeasurementSalesUnitStoreRemoved->setSpyProductMeasurementSalesUnit(null);
        }

        $this->collSpyProductMeasurementSalesUnitStores = null;
        foreach ($spyProductMeasurementSalesUnitStores as $spyProductMeasurementSalesUnitStore) {
            $this->addSpyProductMeasurementSalesUnitStore($spyProductMeasurementSalesUnitStore);
        }

        $this->collSpyProductMeasurementSalesUnitStores = $spyProductMeasurementSalesUnitStores;
        $this->collSpyProductMeasurementSalesUnitStoresPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyProductMeasurementSalesUnitStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyProductMeasurementSalesUnitStore objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductMeasurementSalesUnitStores(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductMeasurementSalesUnitStoresPartial && !$this->isNew();
        if (null === $this->collSpyProductMeasurementSalesUnitStores || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductMeasurementSalesUnitStores) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductMeasurementSalesUnitStores());
            }

            $query = ChildSpyProductMeasurementSalesUnitStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductMeasurementSalesUnit($this)
                ->count($con);
        }

        return count($this->collSpyProductMeasurementSalesUnitStores);
    }

    /**
     * Method called to associate a ChildSpyProductMeasurementSalesUnitStore object to this object
     * through the ChildSpyProductMeasurementSalesUnitStore foreign key attribute.
     *
     * @param ChildSpyProductMeasurementSalesUnitStore $l ChildSpyProductMeasurementSalesUnitStore
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductMeasurementSalesUnitStore(ChildSpyProductMeasurementSalesUnitStore $l)
    {
        if ($this->collSpyProductMeasurementSalesUnitStores === null) {
            $this->initSpyProductMeasurementSalesUnitStores();
            $this->collSpyProductMeasurementSalesUnitStoresPartial = true;
        }

        if (!$this->collSpyProductMeasurementSalesUnitStores->contains($l)) {
            $this->doAddSpyProductMeasurementSalesUnitStore($l);

            if ($this->spyProductMeasurementSalesUnitStoresScheduledForDeletion and $this->spyProductMeasurementSalesUnitStoresScheduledForDeletion->contains($l)) {
                $this->spyProductMeasurementSalesUnitStoresScheduledForDeletion->remove($this->spyProductMeasurementSalesUnitStoresScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyProductMeasurementSalesUnitStore $spyProductMeasurementSalesUnitStore The ChildSpyProductMeasurementSalesUnitStore object to add.
     */
    protected function doAddSpyProductMeasurementSalesUnitStore(ChildSpyProductMeasurementSalesUnitStore $spyProductMeasurementSalesUnitStore): void
    {
        $this->collSpyProductMeasurementSalesUnitStores[]= $spyProductMeasurementSalesUnitStore;
        $spyProductMeasurementSalesUnitStore->setSpyProductMeasurementSalesUnit($this);
    }

    /**
     * @param ChildSpyProductMeasurementSalesUnitStore $spyProductMeasurementSalesUnitStore The ChildSpyProductMeasurementSalesUnitStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductMeasurementSalesUnitStore(ChildSpyProductMeasurementSalesUnitStore $spyProductMeasurementSalesUnitStore)
    {
        if ($this->getSpyProductMeasurementSalesUnitStores()->contains($spyProductMeasurementSalesUnitStore)) {
            $pos = $this->collSpyProductMeasurementSalesUnitStores->search($spyProductMeasurementSalesUnitStore);
            $this->collSpyProductMeasurementSalesUnitStores->remove($pos);
            if (null === $this->spyProductMeasurementSalesUnitStoresScheduledForDeletion) {
                $this->spyProductMeasurementSalesUnitStoresScheduledForDeletion = clone $this->collSpyProductMeasurementSalesUnitStores;
                $this->spyProductMeasurementSalesUnitStoresScheduledForDeletion->clear();
            }
            $this->spyProductMeasurementSalesUnitStoresScheduledForDeletion[]= clone $spyProductMeasurementSalesUnitStore;
            $spyProductMeasurementSalesUnitStore->setSpyProductMeasurementSalesUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductMeasurementSalesUnit is new, it will return
     * an empty collection; or if this SpyProductMeasurementSalesUnit has previously
     * been saved, it will retrieve related SpyProductMeasurementSalesUnitStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductMeasurementSalesUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyProductMeasurementSalesUnitStore[] List of ChildSpyProductMeasurementSalesUnitStore objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyProductMeasurementSalesUnitStore}> List of ChildSpyProductMeasurementSalesUnitStore objects
     */
    public function getSpyProductMeasurementSalesUnitStoresJoinSpyStore(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyProductMeasurementSalesUnitStoreQuery::create(null, $criteria);
        $query->joinWith('SpyStore', $joinBehavior);

        return $this->getSpyProductMeasurementSalesUnitStores($query, $con);
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
            $this->aProduct->removeSpyProductMeasurementSalesUnit($this);
        }
        if (null !== $this->aProductMeasurementUnit) {
            $this->aProductMeasurementUnit->removeSpyProductMeasurementSalesUnit($this);
        }
        if (null !== $this->aProductMeasurementBaseUnit) {
            $this->aProductMeasurementBaseUnit->removeSpyProductMeasurementSalesUnit($this);
        }
        $this->id_product_measurement_sales_unit = null;
        $this->fk_product = null;
        $this->fk_product_measurement_base_unit = null;
        $this->fk_product_measurement_unit = null;
        $this->conversion = null;
        $this->is_default = null;
        $this->is_displayed = null;
        $this->key = null;
        $this->precision = null;
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
            if ($this->collSpyProductMeasurementSalesUnitStores) {
                foreach ($this->collSpyProductMeasurementSalesUnitStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyProductMeasurementSalesUnitStores = null;
        $this->aProduct = null;
        $this->aProductMeasurementUnit = null;
        $this->aProductMeasurementBaseUnit = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyProductMeasurementSalesUnitTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return $this The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[SpyProductMeasurementSalesUnitTableMap::COL_UPDATED_AT] = true;

        return $this;
    }

    // event behavior

    /**
     * @return void
     */
    protected function prepareSaveEventName()
    {
        if ($this->isNew()) {
            $this->_eventName = 'Entity.spy_product_measurement_sales_unit.create';
        } else {
            $this->_eventName = 'Entity.spy_product_measurement_sales_unit.update';
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

        if ($this->_eventName !== 'Entity.spy_product_measurement_sales_unit.create') {
            if (!$this->_isModified) {
                return;
            }

            if (!$this->isEventColumnsModified()) {
                return;
            }
        }

        $data = [
            'name' => 'spy_product_measurement_sales_unit',
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
            'name' => 'spy_product_measurement_sales_unit',
            'id' => !is_array($this->getPrimaryKey()) ? $this->getPrimaryKey() : null,
            'event' => 'Entity.spy_product_measurement_sales_unit.delete',
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
            $field = str_replace('spy_product_measurement_sales_unit.', '', $modifiedColumn);
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
            $field = str_replace('spy_product_measurement_sales_unit.', '', $additionalValueColumnName);
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
        $columnType = SpyProductMeasurementSalesUnitTableMap::getTableMap()->getColumn($column)->getType();
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
