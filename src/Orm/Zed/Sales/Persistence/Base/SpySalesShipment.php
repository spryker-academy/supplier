<?php

namespace Orm\Zed\Sales\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\SalesShipmentType\Persistence\SpySalesShipmentType;
use Orm\Zed\SalesShipmentType\Persistence\SpySalesShipmentTypeQuery;
use Orm\Zed\Sales\Persistence\SpySalesExpense as ChildSpySalesExpense;
use Orm\Zed\Sales\Persistence\SpySalesExpenseQuery as ChildSpySalesExpenseQuery;
use Orm\Zed\Sales\Persistence\SpySalesOrder as ChildSpySalesOrder;
use Orm\Zed\Sales\Persistence\SpySalesOrderAddress as ChildSpySalesOrderAddress;
use Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery as ChildSpySalesOrderAddressQuery;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem as ChildSpySalesOrderItem;
use Orm\Zed\Sales\Persistence\SpySalesOrderItemQuery as ChildSpySalesOrderItemQuery;
use Orm\Zed\Sales\Persistence\SpySalesOrderQuery as ChildSpySalesOrderQuery;
use Orm\Zed\Sales\Persistence\SpySalesShipment as ChildSpySalesShipment;
use Orm\Zed\Sales\Persistence\SpySalesShipmentQuery as ChildSpySalesShipmentQuery;
use Orm\Zed\Sales\Persistence\Map\SpySalesOrderItemTableMap;
use Orm\Zed\Sales\Persistence\Map\SpySalesShipmentTableMap;
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
 * Base class that represents a row from the 'spy_sales_shipment' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.Sales.Persistence.Base
 */
abstract class SpySalesShipment implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\Sales\\Persistence\\Map\\SpySalesShipmentTableMap';


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
     * The value for the id_sales_shipment field.
     *
     * @var        int
     */
    protected $id_sales_shipment;

    /**
     * The value for the fk_sales_expense field.
     *
     * @var        int|null
     */
    protected $fk_sales_expense;

    /**
     * The value for the fk_sales_order field.
     *
     * @var        int
     */
    protected $fk_sales_order;

    /**
     * The value for the fk_sales_order_address field.
     *
     * @var        int|null
     */
    protected $fk_sales_order_address;

    /**
     * The value for the fk_sales_shipment_type field.
     *
     * @var        int|null
     */
    protected $fk_sales_shipment_type;

    /**
     * The value for the carrier_name field.
     * The name of the shipping carrier.
     * @var        string|null
     */
    protected $carrier_name;

    /**
     * The value for the delivery_time field.
     * The estimated delivery time for a shipment.
     * @var        string|null
     */
    protected $delivery_time;

    /**
     * The value for the merchant_reference field.
     * A unique reference identifier for a merchant.
     * @var        string|null
     */
    protected $merchant_reference;

    /**
     * The value for the name field.
     * The name of an entity (e.g., user, category, product, role).
     * @var        string|null
     */
    protected $name;

    /**
     * The value for the requested_delivery_date field.
     * The delivery date requested by the customer.
     * @var        string|null
     */
    protected $requested_delivery_date;

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
     * @var        SpySalesShipmentType
     */
    protected $aSalesShipmentType;

    /**
     * @var        ChildSpySalesOrder
     */
    protected $aOrder;

    /**
     * @var        ChildSpySalesExpense
     */
    protected $aExpense;

    /**
     * @var        ChildSpySalesOrderAddress
     */
    protected $aSpySalesOrderAddress;

    /**
     * @var        ObjectCollection|ChildSpySalesOrderItem[] Collection to store aggregation of ChildSpySalesOrderItem objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpySalesOrderItem> Collection to store aggregation of ChildSpySalesOrderItem objects.
     */
    protected $collSpySalesOrderItems;
    protected $collSpySalesOrderItemsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpySalesOrderItem[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpySalesOrderItem>
     */
    protected $spySalesOrderItemsScheduledForDeletion = null;

    /**
     * Initializes internal state of Orm\Zed\Sales\Persistence\Base\SpySalesShipment object.
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
     * Compares this with another <code>SpySalesShipment</code> instance.  If
     * <code>obj</code> is an instance of <code>SpySalesShipment</code>, delegates to
     * <code>equals(SpySalesShipment)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_sales_shipment] column value.
     *
     * @return int
     */
    public function getIdSalesShipment()
    {
        return $this->id_sales_shipment;
    }

    /**
     * Get the [fk_sales_expense] column value.
     *
     * @return int|null
     */
    public function getFkSalesExpense()
    {
        return $this->fk_sales_expense;
    }

    /**
     * Get the [fk_sales_order] column value.
     *
     * @return int
     */
    public function getFkSalesOrder()
    {
        return $this->fk_sales_order;
    }

    /**
     * Get the [fk_sales_order_address] column value.
     *
     * @return int|null
     */
    public function getFkSalesOrderAddress()
    {
        return $this->fk_sales_order_address;
    }

    /**
     * Get the [fk_sales_shipment_type] column value.
     *
     * @return int|null
     */
    public function getFkSalesShipmentType()
    {
        return $this->fk_sales_shipment_type;
    }

    /**
     * Get the [carrier_name] column value.
     * The name of the shipping carrier.
     * @return string|null
     */
    public function getCarrierName()
    {
        return $this->carrier_name;
    }

    /**
     * Get the [delivery_time] column value.
     * The estimated delivery time for a shipment.
     * @return string|null
     */
    public function getDeliveryTime()
    {
        return $this->delivery_time;
    }

    /**
     * Get the [merchant_reference] column value.
     * A unique reference identifier for a merchant.
     * @return string|null
     */
    public function getMerchantReference()
    {
        return $this->merchant_reference;
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
     * Get the [requested_delivery_date] column value.
     * The delivery date requested by the customer.
     * @return string|null
     */
    public function getRequestedDeliveryDate()
    {
        return $this->requested_delivery_date;
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
     * Set the value of [id_sales_shipment] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdSalesShipment($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_sales_shipment !== $v) {
            $this->id_sales_shipment = $v;
            $this->modifiedColumns[SpySalesShipmentTableMap::COL_ID_SALES_SHIPMENT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_sales_expense] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkSalesExpense($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_sales_expense !== $v) {
            $this->fk_sales_expense = $v;
            $this->modifiedColumns[SpySalesShipmentTableMap::COL_FK_SALES_EXPENSE] = true;
        }

        if ($this->aExpense !== null && $this->aExpense->getIdSalesExpense() !== $v) {
            $this->aExpense = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_sales_order] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkSalesOrder($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_sales_order !== $v) {
            $this->fk_sales_order = $v;
            $this->modifiedColumns[SpySalesShipmentTableMap::COL_FK_SALES_ORDER] = true;
        }

        if ($this->aOrder !== null && $this->aOrder->getIdSalesOrder() !== $v) {
            $this->aOrder = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_sales_order_address] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkSalesOrderAddress($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_sales_order_address !== $v) {
            $this->fk_sales_order_address = $v;
            $this->modifiedColumns[SpySalesShipmentTableMap::COL_FK_SALES_ORDER_ADDRESS] = true;
        }

        if ($this->aSpySalesOrderAddress !== null && $this->aSpySalesOrderAddress->getIdSalesOrderAddress() !== $v) {
            $this->aSpySalesOrderAddress = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_sales_shipment_type] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkSalesShipmentType($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_sales_shipment_type !== $v) {
            $this->fk_sales_shipment_type = $v;
            $this->modifiedColumns[SpySalesShipmentTableMap::COL_FK_SALES_SHIPMENT_TYPE] = true;
        }

        if ($this->aSalesShipmentType !== null && $this->aSalesShipmentType->getIdSalesShipmentType() !== $v) {
            $this->aSalesShipmentType = null;
        }

        return $this;
    }

    /**
     * Set the value of [carrier_name] column.
     * The name of the shipping carrier.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCarrierName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->carrier_name !== $v) {
            $this->carrier_name = $v;
            $this->modifiedColumns[SpySalesShipmentTableMap::COL_CARRIER_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [delivery_time] column.
     * The estimated delivery time for a shipment.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDeliveryTime($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->delivery_time !== $v) {
            $this->delivery_time = $v;
            $this->modifiedColumns[SpySalesShipmentTableMap::COL_DELIVERY_TIME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [merchant_reference] column.
     * A unique reference identifier for a merchant.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMerchantReference($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->merchant_reference !== $v) {
            $this->merchant_reference = $v;
            $this->modifiedColumns[SpySalesShipmentTableMap::COL_MERCHANT_REFERENCE] = true;
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
            $this->modifiedColumns[SpySalesShipmentTableMap::COL_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [requested_delivery_date] column.
     * The delivery date requested by the customer.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRequestedDeliveryDate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->requested_delivery_date !== $v) {
            $this->requested_delivery_date = $v;
            $this->modifiedColumns[SpySalesShipmentTableMap::COL_REQUESTED_DELIVERY_DATE] = true;
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
                $this->modifiedColumns[SpySalesShipmentTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SpySalesShipmentTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpySalesShipmentTableMap::translateFieldName('IdSalesShipment', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_sales_shipment = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpySalesShipmentTableMap::translateFieldName('FkSalesExpense', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_sales_expense = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpySalesShipmentTableMap::translateFieldName('FkSalesOrder', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_sales_order = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpySalesShipmentTableMap::translateFieldName('FkSalesOrderAddress', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_sales_order_address = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpySalesShipmentTableMap::translateFieldName('FkSalesShipmentType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_sales_shipment_type = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpySalesShipmentTableMap::translateFieldName('CarrierName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->carrier_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpySalesShipmentTableMap::translateFieldName('DeliveryTime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->delivery_time = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpySalesShipmentTableMap::translateFieldName('MerchantReference', TableMap::TYPE_PHPNAME, $indexType)];
            $this->merchant_reference = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SpySalesShipmentTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SpySalesShipmentTableMap::translateFieldName('RequestedDeliveryDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->requested_delivery_date = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SpySalesShipmentTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : SpySalesShipmentTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 12; // 12 = SpySalesShipmentTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\Sales\\Persistence\\SpySalesShipment'), 0, $e);
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
        if ($this->aExpense !== null && $this->fk_sales_expense !== $this->aExpense->getIdSalesExpense()) {
            $this->aExpense = null;
        }
        if ($this->aOrder !== null && $this->fk_sales_order !== $this->aOrder->getIdSalesOrder()) {
            $this->aOrder = null;
        }
        if ($this->aSpySalesOrderAddress !== null && $this->fk_sales_order_address !== $this->aSpySalesOrderAddress->getIdSalesOrderAddress()) {
            $this->aSpySalesOrderAddress = null;
        }
        if ($this->aSalesShipmentType !== null && $this->fk_sales_shipment_type !== $this->aSalesShipmentType->getIdSalesShipmentType()) {
            $this->aSalesShipmentType = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpySalesShipmentTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpySalesShipmentQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aSalesShipmentType = null;
            $this->aOrder = null;
            $this->aExpense = null;
            $this->aSpySalesOrderAddress = null;
            $this->collSpySalesOrderItems = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpySalesShipment::setDeleted()
     * @see SpySalesShipment::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesShipmentTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpySalesShipmentQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesShipmentTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                $time = time();
                $highPrecision = \Propel\Runtime\Util\PropelDateTime::createHighPrecision();
                if (!$this->isColumnModified(SpySalesShipmentTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpySalesShipmentTableMap::COL_UPDATED_AT)) {
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
                if ($this->isModified() && !$this->isColumnModified(SpySalesShipmentTableMap::COL_UPDATED_AT)) {
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
                SpySalesShipmentTableMap::addInstanceToPool($this);
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

            if ($this->aSalesShipmentType !== null) {
                if ($this->aSalesShipmentType->isModified() || $this->aSalesShipmentType->isNew()) {
                    $affectedRows += $this->aSalesShipmentType->save($con);
                }
                $this->setSalesShipmentType($this->aSalesShipmentType);
            }

            if ($this->aOrder !== null) {
                if ($this->aOrder->isModified() || $this->aOrder->isNew()) {
                    $affectedRows += $this->aOrder->save($con);
                }
                $this->setOrder($this->aOrder);
            }

            if ($this->aExpense !== null) {
                if ($this->aExpense->isModified() || $this->aExpense->isNew()) {
                    $affectedRows += $this->aExpense->save($con);
                }
                $this->setExpense($this->aExpense);
            }

            if ($this->aSpySalesOrderAddress !== null) {
                if ($this->aSpySalesOrderAddress->isModified() || $this->aSpySalesOrderAddress->isNew()) {
                    $affectedRows += $this->aSpySalesOrderAddress->save($con);
                }
                $this->setSpySalesOrderAddress($this->aSpySalesOrderAddress);
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

            if ($this->spySalesOrderItemsScheduledForDeletion !== null) {
                if (!$this->spySalesOrderItemsScheduledForDeletion->isEmpty()) {
                    foreach ($this->spySalesOrderItemsScheduledForDeletion as $spySalesOrderItem) {
                        // need to save related object because we set the relation to null
                        $spySalesOrderItem->save($con);
                    }
                    $this->spySalesOrderItemsScheduledForDeletion = null;
                }
            }

            if ($this->collSpySalesOrderItems !== null) {
                foreach ($this->collSpySalesOrderItems as $referrerFK) {
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

        $this->modifiedColumns[SpySalesShipmentTableMap::COL_ID_SALES_SHIPMENT] = true;
        if (null !== $this->id_sales_shipment) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpySalesShipmentTableMap::COL_ID_SALES_SHIPMENT . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpySalesShipmentTableMap::COL_ID_SALES_SHIPMENT)) {
            $modifiedColumns[':p' . $index++]  = 'id_sales_shipment';
        }
        if ($this->isColumnModified(SpySalesShipmentTableMap::COL_FK_SALES_EXPENSE)) {
            $modifiedColumns[':p' . $index++]  = 'fk_sales_expense';
        }
        if ($this->isColumnModified(SpySalesShipmentTableMap::COL_FK_SALES_ORDER)) {
            $modifiedColumns[':p' . $index++]  = 'fk_sales_order';
        }
        if ($this->isColumnModified(SpySalesShipmentTableMap::COL_FK_SALES_ORDER_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = 'fk_sales_order_address';
        }
        if ($this->isColumnModified(SpySalesShipmentTableMap::COL_FK_SALES_SHIPMENT_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'fk_sales_shipment_type';
        }
        if ($this->isColumnModified(SpySalesShipmentTableMap::COL_CARRIER_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'carrier_name';
        }
        if ($this->isColumnModified(SpySalesShipmentTableMap::COL_DELIVERY_TIME)) {
            $modifiedColumns[':p' . $index++]  = 'delivery_time';
        }
        if ($this->isColumnModified(SpySalesShipmentTableMap::COL_MERCHANT_REFERENCE)) {
            $modifiedColumns[':p' . $index++]  = 'merchant_reference';
        }
        if ($this->isColumnModified(SpySalesShipmentTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(SpySalesShipmentTableMap::COL_REQUESTED_DELIVERY_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'requested_delivery_date';
        }
        if ($this->isColumnModified(SpySalesShipmentTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(SpySalesShipmentTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO spy_sales_shipment (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_sales_shipment':
                        $stmt->bindValue($identifier, $this->id_sales_shipment, PDO::PARAM_INT);

                        break;
                    case 'fk_sales_expense':
                        $stmt->bindValue($identifier, $this->fk_sales_expense, PDO::PARAM_INT);

                        break;
                    case 'fk_sales_order':
                        $stmt->bindValue($identifier, $this->fk_sales_order, PDO::PARAM_INT);

                        break;
                    case 'fk_sales_order_address':
                        $stmt->bindValue($identifier, $this->fk_sales_order_address, PDO::PARAM_INT);

                        break;
                    case 'fk_sales_shipment_type':
                        $stmt->bindValue($identifier, $this->fk_sales_shipment_type, PDO::PARAM_INT);

                        break;
                    case 'carrier_name':
                        $stmt->bindValue($identifier, $this->carrier_name, PDO::PARAM_STR);

                        break;
                    case 'delivery_time':
                        $stmt->bindValue($identifier, $this->delivery_time, PDO::PARAM_STR);

                        break;
                    case 'merchant_reference':
                        $stmt->bindValue($identifier, $this->merchant_reference, PDO::PARAM_STR);

                        break;
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);

                        break;
                    case 'requested_delivery_date':
                        $stmt->bindValue($identifier, $this->requested_delivery_date, PDO::PARAM_STR);

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
            $pk = $con->lastInsertId('spy_sales_shipment_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdSalesShipment($pk);

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
        $pos = SpySalesShipmentTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdSalesShipment();

            case 1:
                return $this->getFkSalesExpense();

            case 2:
                return $this->getFkSalesOrder();

            case 3:
                return $this->getFkSalesOrderAddress();

            case 4:
                return $this->getFkSalesShipmentType();

            case 5:
                return $this->getCarrierName();

            case 6:
                return $this->getDeliveryTime();

            case 7:
                return $this->getMerchantReference();

            case 8:
                return $this->getName();

            case 9:
                return $this->getRequestedDeliveryDate();

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
        if (isset($alreadyDumpedObjects['SpySalesShipment'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpySalesShipment'][$this->hashCode()] = true;
        $keys = SpySalesShipmentTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdSalesShipment(),
            $keys[1] => $this->getFkSalesExpense(),
            $keys[2] => $this->getFkSalesOrder(),
            $keys[3] => $this->getFkSalesOrderAddress(),
            $keys[4] => $this->getFkSalesShipmentType(),
            $keys[5] => $this->getCarrierName(),
            $keys[6] => $this->getDeliveryTime(),
            $keys[7] => $this->getMerchantReference(),
            $keys[8] => $this->getName(),
            $keys[9] => $this->getRequestedDeliveryDate(),
            $keys[10] => $this->getCreatedAt(),
            $keys[11] => $this->getUpdatedAt(),
        ];
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
            if (null !== $this->aSalesShipmentType) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesShipmentType';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_shipment_type';
                        break;
                    default:
                        $key = 'SalesShipmentType';
                }

                $result[$key] = $this->aSalesShipmentType->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aOrder) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesOrder';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_order';
                        break;
                    default:
                        $key = 'Order';
                }

                $result[$key] = $this->aOrder->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aExpense) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesExpense';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_expense';
                        break;
                    default:
                        $key = 'Expense';
                }

                $result[$key] = $this->aExpense->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aSpySalesOrderAddress) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesOrderAddress';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_order_address';
                        break;
                    default:
                        $key = 'SpySalesOrderAddress';
                }

                $result[$key] = $this->aSpySalesOrderAddress->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collSpySalesOrderItems) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesOrderItems';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_order_items';
                        break;
                    default:
                        $key = 'SpySalesOrderItems';
                }

                $result[$key] = $this->collSpySalesOrderItems->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpySalesShipmentTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdSalesShipment($value);
                break;
            case 1:
                $this->setFkSalesExpense($value);
                break;
            case 2:
                $this->setFkSalesOrder($value);
                break;
            case 3:
                $this->setFkSalesOrderAddress($value);
                break;
            case 4:
                $this->setFkSalesShipmentType($value);
                break;
            case 5:
                $this->setCarrierName($value);
                break;
            case 6:
                $this->setDeliveryTime($value);
                break;
            case 7:
                $this->setMerchantReference($value);
                break;
            case 8:
                $this->setName($value);
                break;
            case 9:
                $this->setRequestedDeliveryDate($value);
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
        $keys = SpySalesShipmentTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdSalesShipment($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkSalesExpense($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setFkSalesOrder($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setFkSalesOrderAddress($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setFkSalesShipmentType($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setCarrierName($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setDeliveryTime($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setMerchantReference($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setName($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setRequestedDeliveryDate($arr[$keys[9]]);
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
        $criteria = new Criteria(SpySalesShipmentTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpySalesShipmentTableMap::COL_ID_SALES_SHIPMENT)) {
            $criteria->add(SpySalesShipmentTableMap::COL_ID_SALES_SHIPMENT, $this->id_sales_shipment);
        }
        if ($this->isColumnModified(SpySalesShipmentTableMap::COL_FK_SALES_EXPENSE)) {
            $criteria->add(SpySalesShipmentTableMap::COL_FK_SALES_EXPENSE, $this->fk_sales_expense);
        }
        if ($this->isColumnModified(SpySalesShipmentTableMap::COL_FK_SALES_ORDER)) {
            $criteria->add(SpySalesShipmentTableMap::COL_FK_SALES_ORDER, $this->fk_sales_order);
        }
        if ($this->isColumnModified(SpySalesShipmentTableMap::COL_FK_SALES_ORDER_ADDRESS)) {
            $criteria->add(SpySalesShipmentTableMap::COL_FK_SALES_ORDER_ADDRESS, $this->fk_sales_order_address);
        }
        if ($this->isColumnModified(SpySalesShipmentTableMap::COL_FK_SALES_SHIPMENT_TYPE)) {
            $criteria->add(SpySalesShipmentTableMap::COL_FK_SALES_SHIPMENT_TYPE, $this->fk_sales_shipment_type);
        }
        if ($this->isColumnModified(SpySalesShipmentTableMap::COL_CARRIER_NAME)) {
            $criteria->add(SpySalesShipmentTableMap::COL_CARRIER_NAME, $this->carrier_name);
        }
        if ($this->isColumnModified(SpySalesShipmentTableMap::COL_DELIVERY_TIME)) {
            $criteria->add(SpySalesShipmentTableMap::COL_DELIVERY_TIME, $this->delivery_time);
        }
        if ($this->isColumnModified(SpySalesShipmentTableMap::COL_MERCHANT_REFERENCE)) {
            $criteria->add(SpySalesShipmentTableMap::COL_MERCHANT_REFERENCE, $this->merchant_reference);
        }
        if ($this->isColumnModified(SpySalesShipmentTableMap::COL_NAME)) {
            $criteria->add(SpySalesShipmentTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(SpySalesShipmentTableMap::COL_REQUESTED_DELIVERY_DATE)) {
            $criteria->add(SpySalesShipmentTableMap::COL_REQUESTED_DELIVERY_DATE, $this->requested_delivery_date);
        }
        if ($this->isColumnModified(SpySalesShipmentTableMap::COL_CREATED_AT)) {
            $criteria->add(SpySalesShipmentTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpySalesShipmentTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpySalesShipmentTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildSpySalesShipmentQuery::create();
        $criteria->add(SpySalesShipmentTableMap::COL_ID_SALES_SHIPMENT, $this->id_sales_shipment);

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
        $validPk = null !== $this->getIdSalesShipment();

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
        return $this->getIdSalesShipment();
    }

    /**
     * Generic method to set the primary key (id_sales_shipment column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdSalesShipment($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdSalesShipment();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\Sales\Persistence\SpySalesShipment (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkSalesExpense($this->getFkSalesExpense());
        $copyObj->setFkSalesOrder($this->getFkSalesOrder());
        $copyObj->setFkSalesOrderAddress($this->getFkSalesOrderAddress());
        $copyObj->setFkSalesShipmentType($this->getFkSalesShipmentType());
        $copyObj->setCarrierName($this->getCarrierName());
        $copyObj->setDeliveryTime($this->getDeliveryTime());
        $copyObj->setMerchantReference($this->getMerchantReference());
        $copyObj->setName($this->getName());
        $copyObj->setRequestedDeliveryDate($this->getRequestedDeliveryDate());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpySalesOrderItems() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpySalesOrderItem($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdSalesShipment(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\Sales\Persistence\SpySalesShipment Clone of current object.
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
     * Declares an association between this object and a SpySalesShipmentType object.
     *
     * @param SpySalesShipmentType|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setSalesShipmentType(SpySalesShipmentType $v = null)
    {
        if ($v === null) {
            $this->setFkSalesShipmentType(NULL);
        } else {
            $this->setFkSalesShipmentType($v->getIdSalesShipmentType());
        }

        $this->aSalesShipmentType = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpySalesShipmentType object, it will not be re-added.
        if ($v !== null) {
            $v->addSalesShipment($this);
        }


        return $this;
    }


    /**
     * Get the associated SpySalesShipmentType object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpySalesShipmentType|null The associated SpySalesShipmentType object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSalesShipmentType(?ConnectionInterface $con = null)
    {
        if ($this->aSalesShipmentType === null && ($this->fk_sales_shipment_type != 0)) {
            $this->aSalesShipmentType = SpySalesShipmentTypeQuery::create()->findPk($this->fk_sales_shipment_type, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSalesShipmentType->addSalesShipments($this);
             */
        }

        return $this->aSalesShipmentType;
    }

    /**
     * Declares an association between this object and a ChildSpySalesOrder object.
     *
     * @param ChildSpySalesOrder $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setOrder(ChildSpySalesOrder $v = null)
    {
        if ($v === null) {
            $this->setFkSalesOrder(NULL);
        } else {
            $this->setFkSalesOrder($v->getIdSalesOrder());
        }

        $this->aOrder = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpySalesOrder object, it will not be re-added.
        if ($v !== null) {
            $v->addSpySalesShipment($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpySalesOrder object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSpySalesOrder The associated ChildSpySalesOrder object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOrder(?ConnectionInterface $con = null)
    {
        if ($this->aOrder === null && ($this->fk_sales_order != 0)) {
            $this->aOrder = ChildSpySalesOrderQuery::create()->findPk($this->fk_sales_order, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOrder->addSpySalesShipments($this);
             */
        }

        return $this->aOrder;
    }

    /**
     * Declares an association between this object and a ChildSpySalesExpense object.
     *
     * @param ChildSpySalesExpense|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setExpense(ChildSpySalesExpense $v = null)
    {
        if ($v === null) {
            $this->setFkSalesExpense(NULL);
        } else {
            $this->setFkSalesExpense($v->getIdSalesExpense());
        }

        $this->aExpense = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpySalesExpense object, it will not be re-added.
        if ($v !== null) {
            $v->addSpySalesShipment($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpySalesExpense object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSpySalesExpense|null The associated ChildSpySalesExpense object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getExpense(?ConnectionInterface $con = null)
    {
        if ($this->aExpense === null && ($this->fk_sales_expense != 0)) {
            $this->aExpense = ChildSpySalesExpenseQuery::create()->findPk($this->fk_sales_expense, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aExpense->addSpySalesShipments($this);
             */
        }

        return $this->aExpense;
    }

    /**
     * Declares an association between this object and a ChildSpySalesOrderAddress object.
     *
     * @param ChildSpySalesOrderAddress|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setSpySalesOrderAddress(ChildSpySalesOrderAddress $v = null)
    {
        if ($v === null) {
            $this->setFkSalesOrderAddress(NULL);
        } else {
            $this->setFkSalesOrderAddress($v->getIdSalesOrderAddress());
        }

        $this->aSpySalesOrderAddress = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpySalesOrderAddress object, it will not be re-added.
        if ($v !== null) {
            $v->addSpySalesShipment($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpySalesOrderAddress object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSpySalesOrderAddress|null The associated ChildSpySalesOrderAddress object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpySalesOrderAddress(?ConnectionInterface $con = null)
    {
        if ($this->aSpySalesOrderAddress === null && ($this->fk_sales_order_address != 0)) {
            $this->aSpySalesOrderAddress = ChildSpySalesOrderAddressQuery::create()->findPk($this->fk_sales_order_address, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSpySalesOrderAddress->addSpySalesShipments($this);
             */
        }

        return $this->aSpySalesOrderAddress;
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
        if ('SpySalesOrderItem' === $relationName) {
            $this->initSpySalesOrderItems();
            return;
        }
    }

    /**
     * Clears out the collSpySalesOrderItems collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpySalesOrderItems()
     */
    public function clearSpySalesOrderItems()
    {
        $this->collSpySalesOrderItems = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpySalesOrderItems collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpySalesOrderItems($v = true): void
    {
        $this->collSpySalesOrderItemsPartial = $v;
    }

    /**
     * Initializes the collSpySalesOrderItems collection.
     *
     * By default this just sets the collSpySalesOrderItems collection to an empty array (like clearcollSpySalesOrderItems());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpySalesOrderItems(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpySalesOrderItems && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySalesOrderItemTableMap::getTableMap()->getCollectionClassName();

        $this->collSpySalesOrderItems = new $collectionClassName;
        $this->collSpySalesOrderItems->setModel('\Orm\Zed\Sales\Persistence\SpySalesOrderItem');
    }

    /**
     * Gets an array of ChildSpySalesOrderItem objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySalesShipment is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpySalesOrderItem[] List of ChildSpySalesOrderItem objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySalesOrderItem> List of ChildSpySalesOrderItem objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpySalesOrderItems(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpySalesOrderItemsPartial && !$this->isNew();
        if (null === $this->collSpySalesOrderItems || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpySalesOrderItems) {
                    $this->initSpySalesOrderItems();
                } else {
                    $collectionClassName = SpySalesOrderItemTableMap::getTableMap()->getCollectionClassName();

                    $collSpySalesOrderItems = new $collectionClassName;
                    $collSpySalesOrderItems->setModel('\Orm\Zed\Sales\Persistence\SpySalesOrderItem');

                    return $collSpySalesOrderItems;
                }
            } else {
                $collSpySalesOrderItems = ChildSpySalesOrderItemQuery::create(null, $criteria)
                    ->filterBySpySalesShipment($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpySalesOrderItemsPartial && count($collSpySalesOrderItems)) {
                        $this->initSpySalesOrderItems(false);

                        foreach ($collSpySalesOrderItems as $obj) {
                            if (false == $this->collSpySalesOrderItems->contains($obj)) {
                                $this->collSpySalesOrderItems->append($obj);
                            }
                        }

                        $this->collSpySalesOrderItemsPartial = true;
                    }

                    return $collSpySalesOrderItems;
                }

                if ($partial && $this->collSpySalesOrderItems) {
                    foreach ($this->collSpySalesOrderItems as $obj) {
                        if ($obj->isNew()) {
                            $collSpySalesOrderItems[] = $obj;
                        }
                    }
                }

                $this->collSpySalesOrderItems = $collSpySalesOrderItems;
                $this->collSpySalesOrderItemsPartial = false;
            }
        }

        return $this->collSpySalesOrderItems;
    }

    /**
     * Sets a collection of ChildSpySalesOrderItem objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spySalesOrderItems A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpySalesOrderItems(Collection $spySalesOrderItems, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpySalesOrderItem[] $spySalesOrderItemsToDelete */
        $spySalesOrderItemsToDelete = $this->getSpySalesOrderItems(new Criteria(), $con)->diff($spySalesOrderItems);


        $this->spySalesOrderItemsScheduledForDeletion = $spySalesOrderItemsToDelete;

        foreach ($spySalesOrderItemsToDelete as $spySalesOrderItemRemoved) {
            $spySalesOrderItemRemoved->setSpySalesShipment(null);
        }

        $this->collSpySalesOrderItems = null;
        foreach ($spySalesOrderItems as $spySalesOrderItem) {
            $this->addSpySalesOrderItem($spySalesOrderItem);
        }

        $this->collSpySalesOrderItems = $spySalesOrderItems;
        $this->collSpySalesOrderItemsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpySalesOrderItem objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpySalesOrderItem objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpySalesOrderItems(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpySalesOrderItemsPartial && !$this->isNew();
        if (null === $this->collSpySalesOrderItems || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpySalesOrderItems) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpySalesOrderItems());
            }

            $query = ChildSpySalesOrderItemQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpySalesShipment($this)
                ->count($con);
        }

        return count($this->collSpySalesOrderItems);
    }

    /**
     * Method called to associate a ChildSpySalesOrderItem object to this object
     * through the ChildSpySalesOrderItem foreign key attribute.
     *
     * @param ChildSpySalesOrderItem $l ChildSpySalesOrderItem
     * @return $this The current object (for fluent API support)
     */
    public function addSpySalesOrderItem(ChildSpySalesOrderItem $l)
    {
        if ($this->collSpySalesOrderItems === null) {
            $this->initSpySalesOrderItems();
            $this->collSpySalesOrderItemsPartial = true;
        }

        if (!$this->collSpySalesOrderItems->contains($l)) {
            $this->doAddSpySalesOrderItem($l);

            if ($this->spySalesOrderItemsScheduledForDeletion and $this->spySalesOrderItemsScheduledForDeletion->contains($l)) {
                $this->spySalesOrderItemsScheduledForDeletion->remove($this->spySalesOrderItemsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpySalesOrderItem $spySalesOrderItem The ChildSpySalesOrderItem object to add.
     */
    protected function doAddSpySalesOrderItem(ChildSpySalesOrderItem $spySalesOrderItem): void
    {
        $this->collSpySalesOrderItems[]= $spySalesOrderItem;
        $spySalesOrderItem->setSpySalesShipment($this);
    }

    /**
     * @param ChildSpySalesOrderItem $spySalesOrderItem The ChildSpySalesOrderItem object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpySalesOrderItem(ChildSpySalesOrderItem $spySalesOrderItem)
    {
        if ($this->getSpySalesOrderItems()->contains($spySalesOrderItem)) {
            $pos = $this->collSpySalesOrderItems->search($spySalesOrderItem);
            $this->collSpySalesOrderItems->remove($pos);
            if (null === $this->spySalesOrderItemsScheduledForDeletion) {
                $this->spySalesOrderItemsScheduledForDeletion = clone $this->collSpySalesOrderItems;
                $this->spySalesOrderItemsScheduledForDeletion->clear();
            }
            $this->spySalesOrderItemsScheduledForDeletion[]= $spySalesOrderItem;
            $spySalesOrderItem->setSpySalesShipment(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySalesShipment is new, it will return
     * an empty collection; or if this SpySalesShipment has previously
     * been saved, it will retrieve related SpySalesOrderItems from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySalesShipment.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpySalesOrderItem[] List of ChildSpySalesOrderItem objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySalesOrderItem}> List of ChildSpySalesOrderItem objects
     */
    public function getSpySalesOrderItemsJoinSalesOrderItemBundle(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpySalesOrderItemQuery::create(null, $criteria);
        $query->joinWith('SalesOrderItemBundle', $joinBehavior);

        return $this->getSpySalesOrderItems($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySalesShipment is new, it will return
     * an empty collection; or if this SpySalesShipment has previously
     * been saved, it will retrieve related SpySalesOrderItems from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySalesShipment.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpySalesOrderItem[] List of ChildSpySalesOrderItem objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySalesOrderItem}> List of ChildSpySalesOrderItem objects
     */
    public function getSpySalesOrderItemsJoinOrder(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpySalesOrderItemQuery::create(null, $criteria);
        $query->joinWith('Order', $joinBehavior);

        return $this->getSpySalesOrderItems($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySalesShipment is new, it will return
     * an empty collection; or if this SpySalesShipment has previously
     * been saved, it will retrieve related SpySalesOrderItems from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySalesShipment.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpySalesOrderItem[] List of ChildSpySalesOrderItem objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySalesOrderItem}> List of ChildSpySalesOrderItem objects
     */
    public function getSpySalesOrderItemsJoinState(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpySalesOrderItemQuery::create(null, $criteria);
        $query->joinWith('State', $joinBehavior);

        return $this->getSpySalesOrderItems($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySalesShipment is new, it will return
     * an empty collection; or if this SpySalesShipment has previously
     * been saved, it will retrieve related SpySalesOrderItems from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySalesShipment.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpySalesOrderItem[] List of ChildSpySalesOrderItem objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySalesOrderItem}> List of ChildSpySalesOrderItem objects
     */
    public function getSpySalesOrderItemsJoinProcess(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpySalesOrderItemQuery::create(null, $criteria);
        $query->joinWith('Process', $joinBehavior);

        return $this->getSpySalesOrderItems($query, $con);
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
        if (null !== $this->aSalesShipmentType) {
            $this->aSalesShipmentType->removeSalesShipment($this);
        }
        if (null !== $this->aOrder) {
            $this->aOrder->removeSpySalesShipment($this);
        }
        if (null !== $this->aExpense) {
            $this->aExpense->removeSpySalesShipment($this);
        }
        if (null !== $this->aSpySalesOrderAddress) {
            $this->aSpySalesOrderAddress->removeSpySalesShipment($this);
        }
        $this->id_sales_shipment = null;
        $this->fk_sales_expense = null;
        $this->fk_sales_order = null;
        $this->fk_sales_order_address = null;
        $this->fk_sales_shipment_type = null;
        $this->carrier_name = null;
        $this->delivery_time = null;
        $this->merchant_reference = null;
        $this->name = null;
        $this->requested_delivery_date = null;
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
            if ($this->collSpySalesOrderItems) {
                foreach ($this->collSpySalesOrderItems as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpySalesOrderItems = null;
        $this->aSalesShipmentType = null;
        $this->aOrder = null;
        $this->aExpense = null;
        $this->aSpySalesOrderAddress = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpySalesShipmentTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return $this The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[SpySalesShipmentTableMap::COL_UPDATED_AT] = true;

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
