<?php

namespace Orm\Zed\MerchantSalesOrder\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrder as ChildSpyMerchantSalesOrder;
use Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderQuery as ChildSpyMerchantSalesOrderQuery;
use Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderTotalsQuery as ChildSpyMerchantSalesOrderTotalsQuery;
use Orm\Zed\MerchantSalesOrder\Persistence\Map\SpyMerchantSalesOrderTotalsTableMap;
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
 * Base class that represents a row from the 'spy_merchant_sales_order_totals' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.MerchantSalesOrder.Persistence.Base
 */
abstract class SpyMerchantSalesOrderTotals implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\MerchantSalesOrder\\Persistence\\Map\\SpyMerchantSalesOrderTotalsTableMap';


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
     * The value for the id_merchant_sales_order_totals field.
     *
     * @var        int
     */
    protected $id_merchant_sales_order_totals;

    /**
     * The value for the fk_merchant_sales_order field.
     *
     * @var        int
     */
    protected $fk_merchant_sales_order;

    /**
     * The value for the canceled_total field.
     * The total value of canceled items in an order.
     * Note: this column has a database default value of: 0
     * @var        int|null
     */
    protected $canceled_total;

    /**
     * The value for the discount_total field.
     * The total amount of discounts applied to an order.
     * Note: this column has a database default value of: 0
     * @var        int|null
     */
    protected $discount_total;

    /**
     * The value for the grand_total field.
     * The final total of an order, including all costs and discounts.
     * Note: this column has a database default value of: 0
     * @var        int|null
     */
    protected $grand_total;

    /**
     * The value for the merchant_commission_refunded_total field.
     * The total refunded commission amount for all merchants in a sales order.
     * @var        int|null
     */
    protected $merchant_commission_refunded_total;

    /**
     * The value for the merchant_commission_total field.
     * The total commission amount for all merchants in a sales order.
     * @var        int|null
     */
    protected $merchant_commission_total;

    /**
     * The value for the order_expense_total field.
     * The total cost of all expenses in an order.
     * Note: this column has a database default value of: 0
     * @var        int|null
     */
    protected $order_expense_total;

    /**
     * The value for the refund_total field.
     * The total amount to be refunded.
     * Note: this column has a database default value of: 0
     * @var        int|null
     */
    protected $refund_total;

    /**
     * The value for the subtotal field.
     * The total price of all items before discounts, taxes, and shipping are applied.
     * Note: this column has a database default value of: 0
     * @var        int|null
     */
    protected $subtotal;

    /**
     * The value for the tax_total field.
     * The total amount of tax calculated for an order or quote.
     * Note: this column has a database default value of: 0
     * @var        int|null
     */
    protected $tax_total;

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
     * @var        ChildSpyMerchantSalesOrder
     */
    protected $aMerchantSalesOrder;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->canceled_total = 0;
        $this->discount_total = 0;
        $this->grand_total = 0;
        $this->order_expense_total = 0;
        $this->refund_total = 0;
        $this->subtotal = 0;
        $this->tax_total = 0;
    }

    /**
     * Initializes internal state of Orm\Zed\MerchantSalesOrder\Persistence\Base\SpyMerchantSalesOrderTotals object.
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
     * Compares this with another <code>SpyMerchantSalesOrderTotals</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyMerchantSalesOrderTotals</code>, delegates to
     * <code>equals(SpyMerchantSalesOrderTotals)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_merchant_sales_order_totals] column value.
     *
     * @return int
     */
    public function getIdMerchantSalesOrderTotals()
    {
        return $this->id_merchant_sales_order_totals;
    }

    /**
     * Get the [fk_merchant_sales_order] column value.
     *
     * @return int
     */
    public function getFkMerchantSalesOrder()
    {
        return $this->fk_merchant_sales_order;
    }

    /**
     * Get the [canceled_total] column value.
     * The total value of canceled items in an order.
     * @return int|null
     */
    public function getCanceledTotal()
    {
        return $this->canceled_total;
    }

    /**
     * Get the [discount_total] column value.
     * The total amount of discounts applied to an order.
     * @return int|null
     */
    public function getDiscountTotal()
    {
        return $this->discount_total;
    }

    /**
     * Get the [grand_total] column value.
     * The final total of an order, including all costs and discounts.
     * @return int|null
     */
    public function getGrandTotal()
    {
        return $this->grand_total;
    }

    /**
     * Get the [merchant_commission_refunded_total] column value.
     * The total refunded commission amount for all merchants in a sales order.
     * @return int|null
     */
    public function getMerchantCommissionRefundedTotal()
    {
        return $this->merchant_commission_refunded_total;
    }

    /**
     * Get the [merchant_commission_total] column value.
     * The total commission amount for all merchants in a sales order.
     * @return int|null
     */
    public function getMerchantCommissionTotal()
    {
        return $this->merchant_commission_total;
    }

    /**
     * Get the [order_expense_total] column value.
     * The total cost of all expenses in an order.
     * @return int|null
     */
    public function getOrderExpenseTotal()
    {
        return $this->order_expense_total;
    }

    /**
     * Get the [refund_total] column value.
     * The total amount to be refunded.
     * @return int|null
     */
    public function getRefundTotal()
    {
        return $this->refund_total;
    }

    /**
     * Get the [subtotal] column value.
     * The total price of all items before discounts, taxes, and shipping are applied.
     * @return int|null
     */
    public function getSubtotal()
    {
        return $this->subtotal;
    }

    /**
     * Get the [tax_total] column value.
     * The total amount of tax calculated for an order or quote.
     * @return int|null
     */
    public function getTaxTotal()
    {
        return $this->tax_total;
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
     * Set the value of [id_merchant_sales_order_totals] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdMerchantSalesOrderTotals($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_merchant_sales_order_totals !== $v) {
            $this->id_merchant_sales_order_totals = $v;
            $this->modifiedColumns[SpyMerchantSalesOrderTotalsTableMap::COL_ID_MERCHANT_SALES_ORDER_TOTALS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_merchant_sales_order] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkMerchantSalesOrder($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_merchant_sales_order !== $v) {
            $this->fk_merchant_sales_order = $v;
            $this->modifiedColumns[SpyMerchantSalesOrderTotalsTableMap::COL_FK_MERCHANT_SALES_ORDER] = true;
        }

        if ($this->aMerchantSalesOrder !== null && $this->aMerchantSalesOrder->getIdMerchantSalesOrder() !== $v) {
            $this->aMerchantSalesOrder = null;
        }

        return $this;
    }

    /**
     * Set the value of [canceled_total] column.
     * The total value of canceled items in an order.
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCanceledTotal($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = true;

        if (($this->isNew() && $hasDefaultValue) || $this->canceled_total !== $v) {
            $this->canceled_total = $v;
            $this->modifiedColumns[SpyMerchantSalesOrderTotalsTableMap::COL_CANCELED_TOTAL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [discount_total] column.
     * The total amount of discounts applied to an order.
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDiscountTotal($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = true;

        if (($this->isNew() && $hasDefaultValue) || $this->discount_total !== $v) {
            $this->discount_total = $v;
            $this->modifiedColumns[SpyMerchantSalesOrderTotalsTableMap::COL_DISCOUNT_TOTAL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [grand_total] column.
     * The final total of an order, including all costs and discounts.
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setGrandTotal($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = true;

        if (($this->isNew() && $hasDefaultValue) || $this->grand_total !== $v) {
            $this->grand_total = $v;
            $this->modifiedColumns[SpyMerchantSalesOrderTotalsTableMap::COL_GRAND_TOTAL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [merchant_commission_refunded_total] column.
     * The total refunded commission amount for all merchants in a sales order.
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMerchantCommissionRefundedTotal($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->merchant_commission_refunded_total !== $v) {
            $this->merchant_commission_refunded_total = $v;
            $this->modifiedColumns[SpyMerchantSalesOrderTotalsTableMap::COL_MERCHANT_COMMISSION_REFUNDED_TOTAL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [merchant_commission_total] column.
     * The total commission amount for all merchants in a sales order.
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMerchantCommissionTotal($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->merchant_commission_total !== $v) {
            $this->merchant_commission_total = $v;
            $this->modifiedColumns[SpyMerchantSalesOrderTotalsTableMap::COL_MERCHANT_COMMISSION_TOTAL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [order_expense_total] column.
     * The total cost of all expenses in an order.
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrderExpenseTotal($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = true;

        if (($this->isNew() && $hasDefaultValue) || $this->order_expense_total !== $v) {
            $this->order_expense_total = $v;
            $this->modifiedColumns[SpyMerchantSalesOrderTotalsTableMap::COL_ORDER_EXPENSE_TOTAL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [refund_total] column.
     * The total amount to be refunded.
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRefundTotal($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = true;

        if (($this->isNew() && $hasDefaultValue) || $this->refund_total !== $v) {
            $this->refund_total = $v;
            $this->modifiedColumns[SpyMerchantSalesOrderTotalsTableMap::COL_REFUND_TOTAL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [subtotal] column.
     * The total price of all items before discounts, taxes, and shipping are applied.
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSubtotal($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = true;

        if (($this->isNew() && $hasDefaultValue) || $this->subtotal !== $v) {
            $this->subtotal = $v;
            $this->modifiedColumns[SpyMerchantSalesOrderTotalsTableMap::COL_SUBTOTAL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [tax_total] column.
     * The total amount of tax calculated for an order or quote.
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTaxTotal($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = true;

        if (($this->isNew() && $hasDefaultValue) || $this->tax_total !== $v) {
            $this->tax_total = $v;
            $this->modifiedColumns[SpyMerchantSalesOrderTotalsTableMap::COL_TAX_TOTAL] = true;
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
                $this->modifiedColumns[SpyMerchantSalesOrderTotalsTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SpyMerchantSalesOrderTotalsTableMap::COL_UPDATED_AT] = true;
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
            if ($this->canceled_total !== 0) {
                return false;
            }

            if ($this->discount_total !== 0) {
                return false;
            }

            if ($this->grand_total !== 0) {
                return false;
            }

            if ($this->order_expense_total !== 0) {
                return false;
            }

            if ($this->refund_total !== 0) {
                return false;
            }

            if ($this->subtotal !== 0) {
                return false;
            }

            if ($this->tax_total !== 0) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyMerchantSalesOrderTotalsTableMap::translateFieldName('IdMerchantSalesOrderTotals', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_merchant_sales_order_totals = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyMerchantSalesOrderTotalsTableMap::translateFieldName('FkMerchantSalesOrder', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_merchant_sales_order = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyMerchantSalesOrderTotalsTableMap::translateFieldName('CanceledTotal', TableMap::TYPE_PHPNAME, $indexType)];
            $this->canceled_total = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyMerchantSalesOrderTotalsTableMap::translateFieldName('DiscountTotal', TableMap::TYPE_PHPNAME, $indexType)];
            $this->discount_total = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyMerchantSalesOrderTotalsTableMap::translateFieldName('GrandTotal', TableMap::TYPE_PHPNAME, $indexType)];
            $this->grand_total = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyMerchantSalesOrderTotalsTableMap::translateFieldName('MerchantCommissionRefundedTotal', TableMap::TYPE_PHPNAME, $indexType)];
            $this->merchant_commission_refunded_total = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpyMerchantSalesOrderTotalsTableMap::translateFieldName('MerchantCommissionTotal', TableMap::TYPE_PHPNAME, $indexType)];
            $this->merchant_commission_total = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpyMerchantSalesOrderTotalsTableMap::translateFieldName('OrderExpenseTotal', TableMap::TYPE_PHPNAME, $indexType)];
            $this->order_expense_total = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SpyMerchantSalesOrderTotalsTableMap::translateFieldName('RefundTotal', TableMap::TYPE_PHPNAME, $indexType)];
            $this->refund_total = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SpyMerchantSalesOrderTotalsTableMap::translateFieldName('Subtotal', TableMap::TYPE_PHPNAME, $indexType)];
            $this->subtotal = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SpyMerchantSalesOrderTotalsTableMap::translateFieldName('TaxTotal', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tax_total = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : SpyMerchantSalesOrderTotalsTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : SpyMerchantSalesOrderTotalsTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 13; // 13 = SpyMerchantSalesOrderTotalsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\MerchantSalesOrder\\Persistence\\SpyMerchantSalesOrderTotals'), 0, $e);
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
        if ($this->aMerchantSalesOrder !== null && $this->fk_merchant_sales_order !== $this->aMerchantSalesOrder->getIdMerchantSalesOrder()) {
            $this->aMerchantSalesOrder = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyMerchantSalesOrderTotalsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyMerchantSalesOrderTotalsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aMerchantSalesOrder = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyMerchantSalesOrderTotals::setDeleted()
     * @see SpyMerchantSalesOrderTotals::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantSalesOrderTotalsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyMerchantSalesOrderTotalsQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantSalesOrderTotalsTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                $time = time();
                $highPrecision = \Propel\Runtime\Util\PropelDateTime::createHighPrecision();
                if (!$this->isColumnModified(SpyMerchantSalesOrderTotalsTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpyMerchantSalesOrderTotalsTableMap::COL_UPDATED_AT)) {
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
                if ($this->isModified() && !$this->isColumnModified(SpyMerchantSalesOrderTotalsTableMap::COL_UPDATED_AT)) {
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
                SpyMerchantSalesOrderTotalsTableMap::addInstanceToPool($this);
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

            if ($this->aMerchantSalesOrder !== null) {
                if ($this->aMerchantSalesOrder->isModified() || $this->aMerchantSalesOrder->isNew()) {
                    $affectedRows += $this->aMerchantSalesOrder->save($con);
                }
                $this->setMerchantSalesOrder($this->aMerchantSalesOrder);
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

        $this->modifiedColumns[SpyMerchantSalesOrderTotalsTableMap::COL_ID_MERCHANT_SALES_ORDER_TOTALS] = true;
        if (null !== $this->id_merchant_sales_order_totals) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyMerchantSalesOrderTotalsTableMap::COL_ID_MERCHANT_SALES_ORDER_TOTALS . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyMerchantSalesOrderTotalsTableMap::COL_ID_MERCHANT_SALES_ORDER_TOTALS)) {
            $modifiedColumns[':p' . $index++]  = 'id_merchant_sales_order_totals';
        }
        if ($this->isColumnModified(SpyMerchantSalesOrderTotalsTableMap::COL_FK_MERCHANT_SALES_ORDER)) {
            $modifiedColumns[':p' . $index++]  = 'fk_merchant_sales_order';
        }
        if ($this->isColumnModified(SpyMerchantSalesOrderTotalsTableMap::COL_CANCELED_TOTAL)) {
            $modifiedColumns[':p' . $index++]  = 'canceled_total';
        }
        if ($this->isColumnModified(SpyMerchantSalesOrderTotalsTableMap::COL_DISCOUNT_TOTAL)) {
            $modifiedColumns[':p' . $index++]  = 'discount_total';
        }
        if ($this->isColumnModified(SpyMerchantSalesOrderTotalsTableMap::COL_GRAND_TOTAL)) {
            $modifiedColumns[':p' . $index++]  = 'grand_total';
        }
        if ($this->isColumnModified(SpyMerchantSalesOrderTotalsTableMap::COL_MERCHANT_COMMISSION_REFUNDED_TOTAL)) {
            $modifiedColumns[':p' . $index++]  = 'merchant_commission_refunded_total';
        }
        if ($this->isColumnModified(SpyMerchantSalesOrderTotalsTableMap::COL_MERCHANT_COMMISSION_TOTAL)) {
            $modifiedColumns[':p' . $index++]  = 'merchant_commission_total';
        }
        if ($this->isColumnModified(SpyMerchantSalesOrderTotalsTableMap::COL_ORDER_EXPENSE_TOTAL)) {
            $modifiedColumns[':p' . $index++]  = 'order_expense_total';
        }
        if ($this->isColumnModified(SpyMerchantSalesOrderTotalsTableMap::COL_REFUND_TOTAL)) {
            $modifiedColumns[':p' . $index++]  = 'refund_total';
        }
        if ($this->isColumnModified(SpyMerchantSalesOrderTotalsTableMap::COL_SUBTOTAL)) {
            $modifiedColumns[':p' . $index++]  = 'subtotal';
        }
        if ($this->isColumnModified(SpyMerchantSalesOrderTotalsTableMap::COL_TAX_TOTAL)) {
            $modifiedColumns[':p' . $index++]  = 'tax_total';
        }
        if ($this->isColumnModified(SpyMerchantSalesOrderTotalsTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(SpyMerchantSalesOrderTotalsTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO spy_merchant_sales_order_totals (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_merchant_sales_order_totals':
                        $stmt->bindValue($identifier, $this->id_merchant_sales_order_totals, PDO::PARAM_INT);

                        break;
                    case 'fk_merchant_sales_order':
                        $stmt->bindValue($identifier, $this->fk_merchant_sales_order, PDO::PARAM_INT);

                        break;
                    case 'canceled_total':
                        $stmt->bindValue($identifier, $this->canceled_total, PDO::PARAM_INT);

                        break;
                    case 'discount_total':
                        $stmt->bindValue($identifier, $this->discount_total, PDO::PARAM_INT);

                        break;
                    case 'grand_total':
                        $stmt->bindValue($identifier, $this->grand_total, PDO::PARAM_INT);

                        break;
                    case 'merchant_commission_refunded_total':
                        $stmt->bindValue($identifier, $this->merchant_commission_refunded_total, PDO::PARAM_INT);

                        break;
                    case 'merchant_commission_total':
                        $stmt->bindValue($identifier, $this->merchant_commission_total, PDO::PARAM_INT);

                        break;
                    case 'order_expense_total':
                        $stmt->bindValue($identifier, $this->order_expense_total, PDO::PARAM_INT);

                        break;
                    case 'refund_total':
                        $stmt->bindValue($identifier, $this->refund_total, PDO::PARAM_INT);

                        break;
                    case 'subtotal':
                        $stmt->bindValue($identifier, $this->subtotal, PDO::PARAM_INT);

                        break;
                    case 'tax_total':
                        $stmt->bindValue($identifier, $this->tax_total, PDO::PARAM_INT);

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
            $pk = $con->lastInsertId('spy_merchant_sales_order_totals_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdMerchantSalesOrderTotals($pk);

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
        $pos = SpyMerchantSalesOrderTotalsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdMerchantSalesOrderTotals();

            case 1:
                return $this->getFkMerchantSalesOrder();

            case 2:
                return $this->getCanceledTotal();

            case 3:
                return $this->getDiscountTotal();

            case 4:
                return $this->getGrandTotal();

            case 5:
                return $this->getMerchantCommissionRefundedTotal();

            case 6:
                return $this->getMerchantCommissionTotal();

            case 7:
                return $this->getOrderExpenseTotal();

            case 8:
                return $this->getRefundTotal();

            case 9:
                return $this->getSubtotal();

            case 10:
                return $this->getTaxTotal();

            case 11:
                return $this->getCreatedAt();

            case 12:
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
        if (isset($alreadyDumpedObjects['SpyMerchantSalesOrderTotals'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyMerchantSalesOrderTotals'][$this->hashCode()] = true;
        $keys = SpyMerchantSalesOrderTotalsTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdMerchantSalesOrderTotals(),
            $keys[1] => $this->getFkMerchantSalesOrder(),
            $keys[2] => $this->getCanceledTotal(),
            $keys[3] => $this->getDiscountTotal(),
            $keys[4] => $this->getGrandTotal(),
            $keys[5] => $this->getMerchantCommissionRefundedTotal(),
            $keys[6] => $this->getMerchantCommissionTotal(),
            $keys[7] => $this->getOrderExpenseTotal(),
            $keys[8] => $this->getRefundTotal(),
            $keys[9] => $this->getSubtotal(),
            $keys[10] => $this->getTaxTotal(),
            $keys[11] => $this->getCreatedAt(),
            $keys[12] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[11]] instanceof \DateTimeInterface) {
            $result[$keys[11]] = $result[$keys[11]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[12]] instanceof \DateTimeInterface) {
            $result[$keys[12]] = $result[$keys[12]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aMerchantSalesOrder) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchantSalesOrder';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant_sales_order';
                        break;
                    default:
                        $key = 'MerchantSalesOrder';
                }

                $result[$key] = $this->aMerchantSalesOrder->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = SpyMerchantSalesOrderTotalsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdMerchantSalesOrderTotals($value);
                break;
            case 1:
                $this->setFkMerchantSalesOrder($value);
                break;
            case 2:
                $this->setCanceledTotal($value);
                break;
            case 3:
                $this->setDiscountTotal($value);
                break;
            case 4:
                $this->setGrandTotal($value);
                break;
            case 5:
                $this->setMerchantCommissionRefundedTotal($value);
                break;
            case 6:
                $this->setMerchantCommissionTotal($value);
                break;
            case 7:
                $this->setOrderExpenseTotal($value);
                break;
            case 8:
                $this->setRefundTotal($value);
                break;
            case 9:
                $this->setSubtotal($value);
                break;
            case 10:
                $this->setTaxTotal($value);
                break;
            case 11:
                $this->setCreatedAt($value);
                break;
            case 12:
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
        $keys = SpyMerchantSalesOrderTotalsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdMerchantSalesOrderTotals($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkMerchantSalesOrder($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setCanceledTotal($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setDiscountTotal($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setGrandTotal($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setMerchantCommissionRefundedTotal($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setMerchantCommissionTotal($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setOrderExpenseTotal($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setRefundTotal($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setSubtotal($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setTaxTotal($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setCreatedAt($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setUpdatedAt($arr[$keys[12]]);
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
        $criteria = new Criteria(SpyMerchantSalesOrderTotalsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyMerchantSalesOrderTotalsTableMap::COL_ID_MERCHANT_SALES_ORDER_TOTALS)) {
            $criteria->add(SpyMerchantSalesOrderTotalsTableMap::COL_ID_MERCHANT_SALES_ORDER_TOTALS, $this->id_merchant_sales_order_totals);
        }
        if ($this->isColumnModified(SpyMerchantSalesOrderTotalsTableMap::COL_FK_MERCHANT_SALES_ORDER)) {
            $criteria->add(SpyMerchantSalesOrderTotalsTableMap::COL_FK_MERCHANT_SALES_ORDER, $this->fk_merchant_sales_order);
        }
        if ($this->isColumnModified(SpyMerchantSalesOrderTotalsTableMap::COL_CANCELED_TOTAL)) {
            $criteria->add(SpyMerchantSalesOrderTotalsTableMap::COL_CANCELED_TOTAL, $this->canceled_total);
        }
        if ($this->isColumnModified(SpyMerchantSalesOrderTotalsTableMap::COL_DISCOUNT_TOTAL)) {
            $criteria->add(SpyMerchantSalesOrderTotalsTableMap::COL_DISCOUNT_TOTAL, $this->discount_total);
        }
        if ($this->isColumnModified(SpyMerchantSalesOrderTotalsTableMap::COL_GRAND_TOTAL)) {
            $criteria->add(SpyMerchantSalesOrderTotalsTableMap::COL_GRAND_TOTAL, $this->grand_total);
        }
        if ($this->isColumnModified(SpyMerchantSalesOrderTotalsTableMap::COL_MERCHANT_COMMISSION_REFUNDED_TOTAL)) {
            $criteria->add(SpyMerchantSalesOrderTotalsTableMap::COL_MERCHANT_COMMISSION_REFUNDED_TOTAL, $this->merchant_commission_refunded_total);
        }
        if ($this->isColumnModified(SpyMerchantSalesOrderTotalsTableMap::COL_MERCHANT_COMMISSION_TOTAL)) {
            $criteria->add(SpyMerchantSalesOrderTotalsTableMap::COL_MERCHANT_COMMISSION_TOTAL, $this->merchant_commission_total);
        }
        if ($this->isColumnModified(SpyMerchantSalesOrderTotalsTableMap::COL_ORDER_EXPENSE_TOTAL)) {
            $criteria->add(SpyMerchantSalesOrderTotalsTableMap::COL_ORDER_EXPENSE_TOTAL, $this->order_expense_total);
        }
        if ($this->isColumnModified(SpyMerchantSalesOrderTotalsTableMap::COL_REFUND_TOTAL)) {
            $criteria->add(SpyMerchantSalesOrderTotalsTableMap::COL_REFUND_TOTAL, $this->refund_total);
        }
        if ($this->isColumnModified(SpyMerchantSalesOrderTotalsTableMap::COL_SUBTOTAL)) {
            $criteria->add(SpyMerchantSalesOrderTotalsTableMap::COL_SUBTOTAL, $this->subtotal);
        }
        if ($this->isColumnModified(SpyMerchantSalesOrderTotalsTableMap::COL_TAX_TOTAL)) {
            $criteria->add(SpyMerchantSalesOrderTotalsTableMap::COL_TAX_TOTAL, $this->tax_total);
        }
        if ($this->isColumnModified(SpyMerchantSalesOrderTotalsTableMap::COL_CREATED_AT)) {
            $criteria->add(SpyMerchantSalesOrderTotalsTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpyMerchantSalesOrderTotalsTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpyMerchantSalesOrderTotalsTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildSpyMerchantSalesOrderTotalsQuery::create();
        $criteria->add(SpyMerchantSalesOrderTotalsTableMap::COL_ID_MERCHANT_SALES_ORDER_TOTALS, $this->id_merchant_sales_order_totals);

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
        $validPk = null !== $this->getIdMerchantSalesOrderTotals();

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
        return $this->getIdMerchantSalesOrderTotals();
    }

    /**
     * Generic method to set the primary key (id_merchant_sales_order_totals column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdMerchantSalesOrderTotals($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdMerchantSalesOrderTotals();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderTotals (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkMerchantSalesOrder($this->getFkMerchantSalesOrder());
        $copyObj->setCanceledTotal($this->getCanceledTotal());
        $copyObj->setDiscountTotal($this->getDiscountTotal());
        $copyObj->setGrandTotal($this->getGrandTotal());
        $copyObj->setMerchantCommissionRefundedTotal($this->getMerchantCommissionRefundedTotal());
        $copyObj->setMerchantCommissionTotal($this->getMerchantCommissionTotal());
        $copyObj->setOrderExpenseTotal($this->getOrderExpenseTotal());
        $copyObj->setRefundTotal($this->getRefundTotal());
        $copyObj->setSubtotal($this->getSubtotal());
        $copyObj->setTaxTotal($this->getTaxTotal());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdMerchantSalesOrderTotals(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderTotals Clone of current object.
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
     * Declares an association between this object and a ChildSpyMerchantSalesOrder object.
     *
     * @param ChildSpyMerchantSalesOrder $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setMerchantSalesOrder(ChildSpyMerchantSalesOrder $v = null)
    {
        if ($v === null) {
            $this->setFkMerchantSalesOrder(NULL);
        } else {
            $this->setFkMerchantSalesOrder($v->getIdMerchantSalesOrder());
        }

        $this->aMerchantSalesOrder = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpyMerchantSalesOrder object, it will not be re-added.
        if ($v !== null) {
            $v->addMerchantSalesOrderTotal($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpyMerchantSalesOrder object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSpyMerchantSalesOrder The associated ChildSpyMerchantSalesOrder object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getMerchantSalesOrder(?ConnectionInterface $con = null)
    {
        if ($this->aMerchantSalesOrder === null && ($this->fk_merchant_sales_order != 0)) {
            $this->aMerchantSalesOrder = ChildSpyMerchantSalesOrderQuery::create()->findPk($this->fk_merchant_sales_order, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aMerchantSalesOrder->addMerchantSalesOrderTotals($this);
             */
        }

        return $this->aMerchantSalesOrder;
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
        if (null !== $this->aMerchantSalesOrder) {
            $this->aMerchantSalesOrder->removeMerchantSalesOrderTotal($this);
        }
        $this->id_merchant_sales_order_totals = null;
        $this->fk_merchant_sales_order = null;
        $this->canceled_total = null;
        $this->discount_total = null;
        $this->grand_total = null;
        $this->merchant_commission_refunded_total = null;
        $this->merchant_commission_total = null;
        $this->order_expense_total = null;
        $this->refund_total = null;
        $this->subtotal = null;
        $this->tax_total = null;
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
        } // if ($deep)

        $this->aMerchantSalesOrder = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyMerchantSalesOrderTotalsTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return $this The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[SpyMerchantSalesOrderTotalsTableMap::COL_UPDATED_AT] = true;

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
