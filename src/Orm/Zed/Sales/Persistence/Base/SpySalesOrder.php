<?php

namespace Orm\Zed\Sales\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\Locale\Persistence\SpyLocale;
use Orm\Zed\Locale\Persistence\SpyLocaleQuery;
use Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrder;
use Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderQuery;
use Orm\Zed\MerchantSalesOrder\Persistence\Base\SpyMerchantSalesOrder as BaseSpyMerchantSalesOrder;
use Orm\Zed\MerchantSalesOrder\Persistence\Map\SpyMerchantSalesOrderTableMap;
use Orm\Zed\Oms\Persistence\SpyOmsTransitionLog;
use Orm\Zed\Oms\Persistence\SpyOmsTransitionLogQuery;
use Orm\Zed\Oms\Persistence\Base\SpyOmsTransitionLog as BaseSpyOmsTransitionLog;
use Orm\Zed\Oms\Persistence\Map\SpyOmsTransitionLogTableMap;
use Orm\Zed\Payment\Persistence\SpySalesPayment;
use Orm\Zed\Payment\Persistence\SpySalesPaymentQuery;
use Orm\Zed\Payment\Persistence\Base\SpySalesPayment as BaseSpySalesPayment;
use Orm\Zed\Payment\Persistence\Map\SpySalesPaymentTableMap;
use Orm\Zed\Refund\Persistence\SpyRefund;
use Orm\Zed\Refund\Persistence\SpyRefundQuery;
use Orm\Zed\Refund\Persistence\Base\SpyRefund as BaseSpyRefund;
use Orm\Zed\Refund\Persistence\Map\SpyRefundTableMap;
use Orm\Zed\SalesInvoice\Persistence\SpySalesOrderInvoice;
use Orm\Zed\SalesInvoice\Persistence\SpySalesOrderInvoiceQuery;
use Orm\Zed\SalesInvoice\Persistence\Base\SpySalesOrderInvoice as BaseSpySalesOrderInvoice;
use Orm\Zed\SalesInvoice\Persistence\Map\SpySalesOrderInvoiceTableMap;
use Orm\Zed\SalesMerchantCommission\Persistence\SpySalesMerchantCommission;
use Orm\Zed\SalesMerchantCommission\Persistence\SpySalesMerchantCommissionQuery;
use Orm\Zed\SalesMerchantCommission\Persistence\Base\SpySalesMerchantCommission as BaseSpySalesMerchantCommission;
use Orm\Zed\SalesMerchantCommission\Persistence\Map\SpySalesMerchantCommissionTableMap;
use Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayout;
use Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutQuery;
use Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversal;
use Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversalQuery;
use Orm\Zed\SalesPaymentMerchant\Persistence\Base\SpySalesPaymentMerchantPayout as BaseSpySalesPaymentMerchantPayout;
use Orm\Zed\SalesPaymentMerchant\Persistence\Base\SpySalesPaymentMerchantPayoutReversal as BaseSpySalesPaymentMerchantPayoutReversal;
use Orm\Zed\SalesPaymentMerchant\Persistence\Map\SpySalesPaymentMerchantPayoutReversalTableMap;
use Orm\Zed\SalesPaymentMerchant\Persistence\Map\SpySalesPaymentMerchantPayoutTableMap;
use Orm\Zed\SalesReclamation\Persistence\SpySalesReclamation;
use Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationQuery;
use Orm\Zed\SalesReclamation\Persistence\Base\SpySalesReclamation as BaseSpySalesReclamation;
use Orm\Zed\SalesReclamation\Persistence\Map\SpySalesReclamationTableMap;
use Orm\Zed\Sales\Persistence\SpySalesDiscount as ChildSpySalesDiscount;
use Orm\Zed\Sales\Persistence\SpySalesDiscountQuery as ChildSpySalesDiscountQuery;
use Orm\Zed\Sales\Persistence\SpySalesExpense as ChildSpySalesExpense;
use Orm\Zed\Sales\Persistence\SpySalesExpenseQuery as ChildSpySalesExpenseQuery;
use Orm\Zed\Sales\Persistence\SpySalesOrder as ChildSpySalesOrder;
use Orm\Zed\Sales\Persistence\SpySalesOrderAddress as ChildSpySalesOrderAddress;
use Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery as ChildSpySalesOrderAddressQuery;
use Orm\Zed\Sales\Persistence\SpySalesOrderComment as ChildSpySalesOrderComment;
use Orm\Zed\Sales\Persistence\SpySalesOrderCommentQuery as ChildSpySalesOrderCommentQuery;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem as ChildSpySalesOrderItem;
use Orm\Zed\Sales\Persistence\SpySalesOrderItemQuery as ChildSpySalesOrderItemQuery;
use Orm\Zed\Sales\Persistence\SpySalesOrderNote as ChildSpySalesOrderNote;
use Orm\Zed\Sales\Persistence\SpySalesOrderNoteQuery as ChildSpySalesOrderNoteQuery;
use Orm\Zed\Sales\Persistence\SpySalesOrderQuery as ChildSpySalesOrderQuery;
use Orm\Zed\Sales\Persistence\SpySalesOrderTotals as ChildSpySalesOrderTotals;
use Orm\Zed\Sales\Persistence\SpySalesOrderTotalsQuery as ChildSpySalesOrderTotalsQuery;
use Orm\Zed\Sales\Persistence\SpySalesShipment as ChildSpySalesShipment;
use Orm\Zed\Sales\Persistence\SpySalesShipmentQuery as ChildSpySalesShipmentQuery;
use Orm\Zed\Sales\Persistence\Map\SpySalesDiscountTableMap;
use Orm\Zed\Sales\Persistence\Map\SpySalesExpenseTableMap;
use Orm\Zed\Sales\Persistence\Map\SpySalesOrderCommentTableMap;
use Orm\Zed\Sales\Persistence\Map\SpySalesOrderItemTableMap;
use Orm\Zed\Sales\Persistence\Map\SpySalesOrderNoteTableMap;
use Orm\Zed\Sales\Persistence\Map\SpySalesOrderTableMap;
use Orm\Zed\Sales\Persistence\Map\SpySalesOrderTotalsTableMap;
use Orm\Zed\Sales\Persistence\Map\SpySalesShipmentTableMap;
use Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrder;
use Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderQuery;
use Orm\Zed\SelfServicePortal\Persistence\Base\SpySspInquirySalesOrder as BaseSpySspInquirySalesOrder;
use Orm\Zed\SelfServicePortal\Persistence\Map\SpySspInquirySalesOrderTableMap;
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
 * Base class that represents a row from the 'spy_sales_order' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.Sales.Persistence.Base
 */
abstract class SpySalesOrder implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\Sales\\Persistence\\Map\\SpySalesOrderTableMap';


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
     * The value for the id_sales_order field.
     *
     * @var        int
     */
    protected $id_sales_order;

    /**
     * The value for the fk_locale field.
     *
     * @var        int|null
     */
    protected $fk_locale;

    /**
     * The value for the fk_sales_order_address_billing field.
     *
     * @var        int
     */
    protected $fk_sales_order_address_billing;

    /**
     * The value for the fk_sales_order_address_shipping field.
     *
     * @var        int|null
     */
    protected $fk_sales_order_address_shipping;

    /**
     * The value for the agent_email field.
     * The email of the agent associated with the sales order.
     * @var        string|null
     */
    protected $agent_email;

    /**
     * The value for the cart_note field.
     * A note attached to the shopping cart.
     * @var        string|null
     */
    protected $cart_note;

    /**
     * The value for the company_business_unit_uuid field.
     * A universally unique identifier for a company business unit.
     * @var        string|null
     */
    protected $company_business_unit_uuid;

    /**
     * The value for the company_uuid field.
     * A universally unique identifier for a company.
     * @var        string|null
     */
    protected $company_uuid;

    /**
     * The value for the currency_iso_code field.
     * The ISO code for a currency.
     * @var        string|null
     */
    protected $currency_iso_code;

    /**
     * The value for the customer_reference field.
     * A unique reference for a customer.
     * @var        string|null
     */
    protected $customer_reference;

    /**
     * The value for the email field.
     * The email address of a user or contact.
     * @var        string|null
     */
    protected $email;

    /**
     * The value for the first_name field.
     * The first name of a person.
     * @var        string|null
     */
    protected $first_name;

    /**
     * The value for the is_test field.
     * A flag indicating if an order is a test order.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $is_test;

    /**
     * The value for the last_name field.
     * The last name of a user or customer.
     * @var        string|null
     */
    protected $last_name;

    /**
     * The value for the oms_processor_identifier field.
     * Defines the processor id for OMS multi-thread order processing
     * @var        int|null
     */
    protected $oms_processor_identifier;

    /**
     * The value for the order_custom_reference field.
     * A custom reference for a sales order, often provided by the customer.
     * @var        string|null
     */
    protected $order_custom_reference;

    /**
     * The value for the order_reference field.
     * A unique reference identifier for a sales order.
     * @var        string
     */
    protected $order_reference;

    /**
     * The value for the price_mode field.
     * The mode for price calculation, typically "GROSS_MODE" or "NET_MODE".
     * @var        int|null
     */
    protected $price_mode;

    /**
     * The value for the quote_request_version_reference field.
     * A reference to the specific quote request version that this sales order was created from.
     * @var        string|null
     */
    protected $quote_request_version_reference;

    /**
     * The value for the salutation field.
     * The salutation of a person (e.g., Mr., Mrs., Dr.).
     * @var        int|null
     */
    protected $salutation;

    /**
     * The value for the store field.
     * The store context for an operation, determining which store's data is used.
     * @var        string|null
     */
    protected $store;

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
     * @var        ChildSpySalesOrderAddress
     */
    protected $aBillingAddress;

    /**
     * @var        ChildSpySalesOrderAddress
     */
    protected $aShippingAddress;

    /**
     * @var        SpyLocale
     */
    protected $aLocale;

    /**
     * @var        ObjectCollection|SpyMerchantSalesOrder[] Collection to store aggregation of SpyMerchantSalesOrder objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantSalesOrder> Collection to store aggregation of SpyMerchantSalesOrder objects.
     */
    protected $collSpyMerchantSalesOrders;
    protected $collSpyMerchantSalesOrdersPartial;

    /**
     * @var        ObjectCollection|SpyOmsTransitionLog[] Collection to store aggregation of SpyOmsTransitionLog objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyOmsTransitionLog> Collection to store aggregation of SpyOmsTransitionLog objects.
     */
    protected $collTransitionLogs;
    protected $collTransitionLogsPartial;

    /**
     * @var        ObjectCollection|SpyRefund[] Collection to store aggregation of SpyRefund objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyRefund> Collection to store aggregation of SpyRefund objects.
     */
    protected $collSpyRefunds;
    protected $collSpyRefundsPartial;

    /**
     * @var        ObjectCollection|ChildSpySalesOrderItem[] Collection to store aggregation of ChildSpySalesOrderItem objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpySalesOrderItem> Collection to store aggregation of ChildSpySalesOrderItem objects.
     */
    protected $collItems;
    protected $collItemsPartial;

    /**
     * @var        ObjectCollection|ChildSpySalesDiscount[] Collection to store aggregation of ChildSpySalesDiscount objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpySalesDiscount> Collection to store aggregation of ChildSpySalesDiscount objects.
     */
    protected $collDiscounts;
    protected $collDiscountsPartial;

    /**
     * @var        ObjectCollection|ChildSpySalesExpense[] Collection to store aggregation of ChildSpySalesExpense objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpySalesExpense> Collection to store aggregation of ChildSpySalesExpense objects.
     */
    protected $collExpenses;
    protected $collExpensesPartial;

    /**
     * @var        ObjectCollection|ChildSpySalesShipment[] Collection to store aggregation of ChildSpySalesShipment objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpySalesShipment> Collection to store aggregation of ChildSpySalesShipment objects.
     */
    protected $collSpySalesShipments;
    protected $collSpySalesShipmentsPartial;

    /**
     * @var        ObjectCollection|ChildSpySalesOrderTotals[] Collection to store aggregation of ChildSpySalesOrderTotals objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpySalesOrderTotals> Collection to store aggregation of ChildSpySalesOrderTotals objects.
     */
    protected $collOrderTotals;
    protected $collOrderTotalsPartial;

    /**
     * @var        ObjectCollection|ChildSpySalesOrderNote[] Collection to store aggregation of ChildSpySalesOrderNote objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpySalesOrderNote> Collection to store aggregation of ChildSpySalesOrderNote objects.
     */
    protected $collNotes;
    protected $collNotesPartial;

    /**
     * @var        ObjectCollection|ChildSpySalesOrderComment[] Collection to store aggregation of ChildSpySalesOrderComment objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpySalesOrderComment> Collection to store aggregation of ChildSpySalesOrderComment objects.
     */
    protected $collOrderComments;
    protected $collOrderCommentsPartial;

    /**
     * @var        ObjectCollection|SpySalesOrderInvoice[] Collection to store aggregation of SpySalesOrderInvoice objects.
     * @phpstan-var ObjectCollection&\Traversable<SpySalesOrderInvoice> Collection to store aggregation of SpySalesOrderInvoice objects.
     */
    protected $collSpySalesOrderInvoices;
    protected $collSpySalesOrderInvoicesPartial;

    /**
     * @var        ObjectCollection|SpySalesMerchantCommission[] Collection to store aggregation of SpySalesMerchantCommission objects.
     * @phpstan-var ObjectCollection&\Traversable<SpySalesMerchantCommission> Collection to store aggregation of SpySalesMerchantCommission objects.
     */
    protected $collSpySalesMerchantCommissions;
    protected $collSpySalesMerchantCommissionsPartial;

    /**
     * @var        ObjectCollection|SpySalesPayment[] Collection to store aggregation of SpySalesPayment objects.
     * @phpstan-var ObjectCollection&\Traversable<SpySalesPayment> Collection to store aggregation of SpySalesPayment objects.
     */
    protected $collOrders;
    protected $collOrdersPartial;

    /**
     * @var        ObjectCollection|SpySalesPaymentMerchantPayout[] Collection to store aggregation of SpySalesPaymentMerchantPayout objects.
     * @phpstan-var ObjectCollection&\Traversable<SpySalesPaymentMerchantPayout> Collection to store aggregation of SpySalesPaymentMerchantPayout objects.
     */
    protected $collSpySalesPaymentMerchantPayouts;
    protected $collSpySalesPaymentMerchantPayoutsPartial;

    /**
     * @var        ObjectCollection|SpySalesPaymentMerchantPayoutReversal[] Collection to store aggregation of SpySalesPaymentMerchantPayoutReversal objects.
     * @phpstan-var ObjectCollection&\Traversable<SpySalesPaymentMerchantPayoutReversal> Collection to store aggregation of SpySalesPaymentMerchantPayoutReversal objects.
     */
    protected $collSpySalesPaymentMerchantPayoutReversals;
    protected $collSpySalesPaymentMerchantPayoutReversalsPartial;

    /**
     * @var        ObjectCollection|SpySalesReclamation[] Collection to store aggregation of SpySalesReclamation objects.
     * @phpstan-var ObjectCollection&\Traversable<SpySalesReclamation> Collection to store aggregation of SpySalesReclamation objects.
     */
    protected $collReclamations;
    protected $collReclamationsPartial;

    /**
     * @var        ObjectCollection|SpySspInquirySalesOrder[] Collection to store aggregation of SpySspInquirySalesOrder objects.
     * @phpstan-var ObjectCollection&\Traversable<SpySspInquirySalesOrder> Collection to store aggregation of SpySspInquirySalesOrder objects.
     */
    protected $collSpySspInquirySalesOrders;
    protected $collSpySspInquirySalesOrdersPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyMerchantSalesOrder[]
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantSalesOrder>
     */
    protected $spyMerchantSalesOrdersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyOmsTransitionLog[]
     * @phpstan-var ObjectCollection&\Traversable<SpyOmsTransitionLog>
     */
    protected $transitionLogsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyRefund[]
     * @phpstan-var ObjectCollection&\Traversable<SpyRefund>
     */
    protected $spyRefundsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpySalesOrderItem[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpySalesOrderItem>
     */
    protected $itemsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpySalesDiscount[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpySalesDiscount>
     */
    protected $discountsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpySalesExpense[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpySalesExpense>
     */
    protected $expensesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpySalesShipment[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpySalesShipment>
     */
    protected $spySalesShipmentsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpySalesOrderTotals[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpySalesOrderTotals>
     */
    protected $orderTotalsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpySalesOrderNote[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpySalesOrderNote>
     */
    protected $notesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpySalesOrderComment[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpySalesOrderComment>
     */
    protected $orderCommentsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpySalesOrderInvoice[]
     * @phpstan-var ObjectCollection&\Traversable<SpySalesOrderInvoice>
     */
    protected $spySalesOrderInvoicesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpySalesMerchantCommission[]
     * @phpstan-var ObjectCollection&\Traversable<SpySalesMerchantCommission>
     */
    protected $spySalesMerchantCommissionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpySalesPayment[]
     * @phpstan-var ObjectCollection&\Traversable<SpySalesPayment>
     */
    protected $ordersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpySalesPaymentMerchantPayout[]
     * @phpstan-var ObjectCollection&\Traversable<SpySalesPaymentMerchantPayout>
     */
    protected $spySalesPaymentMerchantPayoutsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpySalesPaymentMerchantPayoutReversal[]
     * @phpstan-var ObjectCollection&\Traversable<SpySalesPaymentMerchantPayoutReversal>
     */
    protected $spySalesPaymentMerchantPayoutReversalsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpySalesReclamation[]
     * @phpstan-var ObjectCollection&\Traversable<SpySalesReclamation>
     */
    protected $reclamationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpySspInquirySalesOrder[]
     * @phpstan-var ObjectCollection&\Traversable<SpySspInquirySalesOrder>
     */
    protected $spySspInquirySalesOrdersScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->is_test = false;
    }

    /**
     * Initializes internal state of Orm\Zed\Sales\Persistence\Base\SpySalesOrder object.
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
     * Compares this with another <code>SpySalesOrder</code> instance.  If
     * <code>obj</code> is an instance of <code>SpySalesOrder</code>, delegates to
     * <code>equals(SpySalesOrder)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_sales_order] column value.
     *
     * @return int
     */
    public function getIdSalesOrder()
    {
        return $this->id_sales_order;
    }

    /**
     * Get the [fk_locale] column value.
     *
     * @return int|null
     */
    public function getFkLocale()
    {
        return $this->fk_locale;
    }

    /**
     * Get the [fk_sales_order_address_billing] column value.
     *
     * @return int
     */
    public function getFkSalesOrderAddressBilling()
    {
        return $this->fk_sales_order_address_billing;
    }

    /**
     * Get the [fk_sales_order_address_shipping] column value.
     *
     * @return int|null
     */
    public function getFkSalesOrderAddressShipping()
    {
        return $this->fk_sales_order_address_shipping;
    }

    /**
     * Get the [agent_email] column value.
     * The email of the agent associated with the sales order.
     * @return string|null
     */
    public function getAgentEmail()
    {
        return $this->agent_email;
    }

    /**
     * Get the [cart_note] column value.
     * A note attached to the shopping cart.
     * @return string|null
     */
    public function getCartNote()
    {
        return $this->cart_note;
    }

    /**
     * Get the [company_business_unit_uuid] column value.
     * A universally unique identifier for a company business unit.
     * @return string|null
     */
    public function getCompanyBusinessUnitUuid()
    {
        return $this->company_business_unit_uuid;
    }

    /**
     * Get the [company_uuid] column value.
     * A universally unique identifier for a company.
     * @return string|null
     */
    public function getCompanyUuid()
    {
        return $this->company_uuid;
    }

    /**
     * Get the [currency_iso_code] column value.
     * The ISO code for a currency.
     * @return string|null
     */
    public function getCurrencyIsoCode()
    {
        return $this->currency_iso_code;
    }

    /**
     * Get the [customer_reference] column value.
     * A unique reference for a customer.
     * @return string|null
     */
    public function getCustomerReference()
    {
        return $this->customer_reference;
    }

    /**
     * Get the [email] column value.
     * The email address of a user or contact.
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [first_name] column value.
     * The first name of a person.
     * @return string|null
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Get the [is_test] column value.
     * A flag indicating if an order is a test order.
     * @return boolean
     */
    public function getIsTest()
    {
        return $this->is_test;
    }

    /**
     * Get the [is_test] column value.
     * A flag indicating if an order is a test order.
     * @return boolean
     */
    public function isTest()
    {
        return $this->getIsTest();
    }

    /**
     * Get the [last_name] column value.
     * The last name of a user or customer.
     * @return string|null
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Get the [oms_processor_identifier] column value.
     * Defines the processor id for OMS multi-thread order processing
     * @return int|null
     */
    public function getOmsProcessorIdentifier()
    {
        return $this->oms_processor_identifier;
    }

    /**
     * Get the [order_custom_reference] column value.
     * A custom reference for a sales order, often provided by the customer.
     * @return string|null
     */
    public function getOrderCustomReference()
    {
        return $this->order_custom_reference;
    }

    /**
     * Get the [order_reference] column value.
     * A unique reference identifier for a sales order.
     * @return string
     */
    public function getOrderReference()
    {
        return $this->order_reference;
    }

    /**
     * Get the [price_mode] column value.
     * The mode for price calculation, typically "GROSS_MODE" or "NET_MODE".
     * @return string|null
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getPriceMode()
    {
        if (null === $this->price_mode) {
            return null;
        }
        $valueSet = SpySalesOrderTableMap::getValueSet(SpySalesOrderTableMap::COL_PRICE_MODE);
        if (!isset($valueSet[$this->price_mode])) {
            throw new PropelException('Unknown stored enum key: ' . $this->price_mode);
        }

        return $valueSet[$this->price_mode];
    }

    /**
     * Get the [quote_request_version_reference] column value.
     * A reference to the specific quote request version that this sales order was created from.
     * @return string|null
     */
    public function getQuoteRequestVersionReference()
    {
        return $this->quote_request_version_reference;
    }

    /**
     * Get the [salutation] column value.
     * The salutation of a person (e.g., Mr., Mrs., Dr.).
     * @return string|null
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSalutation()
    {
        if (null === $this->salutation) {
            return null;
        }
        $valueSet = SpySalesOrderTableMap::getValueSet(SpySalesOrderTableMap::COL_SALUTATION);
        if (!isset($valueSet[$this->salutation])) {
            throw new PropelException('Unknown stored enum key: ' . $this->salutation);
        }

        return $valueSet[$this->salutation];
    }

    /**
     * Get the [store] column value.
     * The store context for an operation, determining which store's data is used.
     * @return string|null
     */
    public function getStore()
    {
        return $this->store;
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
     * Set the value of [id_sales_order] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdSalesOrder($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_sales_order !== $v) {
            $this->id_sales_order = $v;
            $this->modifiedColumns[SpySalesOrderTableMap::COL_ID_SALES_ORDER] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_locale] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkLocale($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_locale !== $v) {
            $this->fk_locale = $v;
            $this->modifiedColumns[SpySalesOrderTableMap::COL_FK_LOCALE] = true;
        }

        if ($this->aLocale !== null && $this->aLocale->getIdLocale() !== $v) {
            $this->aLocale = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_sales_order_address_billing] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkSalesOrderAddressBilling($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_sales_order_address_billing !== $v) {
            $this->fk_sales_order_address_billing = $v;
            $this->modifiedColumns[SpySalesOrderTableMap::COL_FK_SALES_ORDER_ADDRESS_BILLING] = true;
        }

        if ($this->aBillingAddress !== null && $this->aBillingAddress->getIdSalesOrderAddress() !== $v) {
            $this->aBillingAddress = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_sales_order_address_shipping] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkSalesOrderAddressShipping($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_sales_order_address_shipping !== $v) {
            $this->fk_sales_order_address_shipping = $v;
            $this->modifiedColumns[SpySalesOrderTableMap::COL_FK_SALES_ORDER_ADDRESS_SHIPPING] = true;
        }

        if ($this->aShippingAddress !== null && $this->aShippingAddress->getIdSalesOrderAddress() !== $v) {
            $this->aShippingAddress = null;
        }

        return $this;
    }

    /**
     * Set the value of [agent_email] column.
     * The email of the agent associated with the sales order.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAgentEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->agent_email !== $v) {
            $this->agent_email = $v;
            $this->modifiedColumns[SpySalesOrderTableMap::COL_AGENT_EMAIL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [cart_note] column.
     * A note attached to the shopping cart.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCartNote($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->cart_note !== $v) {
            $this->cart_note = $v;
            $this->modifiedColumns[SpySalesOrderTableMap::COL_CART_NOTE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [company_business_unit_uuid] column.
     * A universally unique identifier for a company business unit.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCompanyBusinessUnitUuid($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->company_business_unit_uuid !== $v) {
            $this->company_business_unit_uuid = $v;
            $this->modifiedColumns[SpySalesOrderTableMap::COL_COMPANY_BUSINESS_UNIT_UUID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [company_uuid] column.
     * A universally unique identifier for a company.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCompanyUuid($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->company_uuid !== $v) {
            $this->company_uuid = $v;
            $this->modifiedColumns[SpySalesOrderTableMap::COL_COMPANY_UUID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [currency_iso_code] column.
     * The ISO code for a currency.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCurrencyIsoCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->currency_iso_code !== $v) {
            $this->currency_iso_code = $v;
            $this->modifiedColumns[SpySalesOrderTableMap::COL_CURRENCY_ISO_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [customer_reference] column.
     * A unique reference for a customer.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCustomerReference($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->customer_reference !== $v) {
            $this->customer_reference = $v;
            $this->modifiedColumns[SpySalesOrderTableMap::COL_CUSTOMER_REFERENCE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [email] column.
     * The email address of a user or contact.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[SpySalesOrderTableMap::COL_EMAIL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [first_name] column.
     * The first name of a person.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFirstName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->first_name !== $v) {
            $this->first_name = $v;
            $this->modifiedColumns[SpySalesOrderTableMap::COL_FIRST_NAME] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_test] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * A flag indicating if an order is a test order.
     * @param bool|integer|string $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsTest($v)
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

        if (($this->isNew() && $hasDefaultValue) || $this->is_test !== $v) {
            $this->is_test = $v;
            $this->modifiedColumns[SpySalesOrderTableMap::COL_IS_TEST] = true;
        }

        return $this;
    }

    /**
     * Set the value of [last_name] column.
     * The last name of a user or customer.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLastName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->last_name !== $v) {
            $this->last_name = $v;
            $this->modifiedColumns[SpySalesOrderTableMap::COL_LAST_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [oms_processor_identifier] column.
     * Defines the processor id for OMS multi-thread order processing
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOmsProcessorIdentifier($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->oms_processor_identifier !== $v) {
            $this->oms_processor_identifier = $v;
            $this->modifiedColumns[SpySalesOrderTableMap::COL_OMS_PROCESSOR_IDENTIFIER] = true;
        }

        return $this;
    }

    /**
     * Set the value of [order_custom_reference] column.
     * A custom reference for a sales order, often provided by the customer.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrderCustomReference($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->order_custom_reference !== $v) {
            $this->order_custom_reference = $v;
            $this->modifiedColumns[SpySalesOrderTableMap::COL_ORDER_CUSTOM_REFERENCE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [order_reference] column.
     * A unique reference identifier for a sales order.
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrderReference($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->order_reference !== $v) {
            $this->order_reference = $v;
            $this->modifiedColumns[SpySalesOrderTableMap::COL_ORDER_REFERENCE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [price_mode] column.
     * The mode for price calculation, typically "GROSS_MODE" or "NET_MODE".
     * @param string|null $v new value
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setPriceMode($v)
    {
        if ($v !== null) {
            $valueSet = SpySalesOrderTableMap::getValueSet(SpySalesOrderTableMap::COL_PRICE_MODE);
            if (!in_array($v, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $v));
            }
            $v = array_search($v, $valueSet);
        }

        if ($this->price_mode !== $v) {
            $this->price_mode = $v;
            $this->modifiedColumns[SpySalesOrderTableMap::COL_PRICE_MODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [quote_request_version_reference] column.
     * A reference to the specific quote request version that this sales order was created from.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setQuoteRequestVersionReference($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->quote_request_version_reference !== $v) {
            $this->quote_request_version_reference = $v;
            $this->modifiedColumns[SpySalesOrderTableMap::COL_QUOTE_REQUEST_VERSION_REFERENCE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [salutation] column.
     * The salutation of a person (e.g., Mr., Mrs., Dr.).
     * @param string|null $v new value
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setSalutation($v)
    {
        if ($v !== null) {
            $valueSet = SpySalesOrderTableMap::getValueSet(SpySalesOrderTableMap::COL_SALUTATION);
            if (!in_array($v, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $v));
            }
            $v = array_search($v, $valueSet);
        }

        if ($this->salutation !== $v) {
            $this->salutation = $v;
            $this->modifiedColumns[SpySalesOrderTableMap::COL_SALUTATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [store] column.
     * The store context for an operation, determining which store's data is used.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setStore($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->store !== $v) {
            $this->store = $v;
            $this->modifiedColumns[SpySalesOrderTableMap::COL_STORE] = true;
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
                $this->modifiedColumns[SpySalesOrderTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SpySalesOrderTableMap::COL_UPDATED_AT] = true;
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
            if ($this->is_test !== false) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpySalesOrderTableMap::translateFieldName('IdSalesOrder', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_sales_order = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpySalesOrderTableMap::translateFieldName('FkLocale', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_locale = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpySalesOrderTableMap::translateFieldName('FkSalesOrderAddressBilling', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_sales_order_address_billing = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpySalesOrderTableMap::translateFieldName('FkSalesOrderAddressShipping', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_sales_order_address_shipping = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpySalesOrderTableMap::translateFieldName('AgentEmail', TableMap::TYPE_PHPNAME, $indexType)];
            $this->agent_email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpySalesOrderTableMap::translateFieldName('CartNote', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cart_note = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpySalesOrderTableMap::translateFieldName('CompanyBusinessUnitUuid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_business_unit_uuid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpySalesOrderTableMap::translateFieldName('CompanyUuid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_uuid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SpySalesOrderTableMap::translateFieldName('CurrencyIsoCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->currency_iso_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SpySalesOrderTableMap::translateFieldName('CustomerReference', TableMap::TYPE_PHPNAME, $indexType)];
            $this->customer_reference = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SpySalesOrderTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : SpySalesOrderTableMap::translateFieldName('FirstName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->first_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : SpySalesOrderTableMap::translateFieldName('IsTest', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_test = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : SpySalesOrderTableMap::translateFieldName('LastName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : SpySalesOrderTableMap::translateFieldName('OmsProcessorIdentifier', TableMap::TYPE_PHPNAME, $indexType)];
            $this->oms_processor_identifier = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : SpySalesOrderTableMap::translateFieldName('OrderCustomReference', TableMap::TYPE_PHPNAME, $indexType)];
            $this->order_custom_reference = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : SpySalesOrderTableMap::translateFieldName('OrderReference', TableMap::TYPE_PHPNAME, $indexType)];
            $this->order_reference = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : SpySalesOrderTableMap::translateFieldName('PriceMode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->price_mode = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : SpySalesOrderTableMap::translateFieldName('QuoteRequestVersionReference', TableMap::TYPE_PHPNAME, $indexType)];
            $this->quote_request_version_reference = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : SpySalesOrderTableMap::translateFieldName('Salutation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->salutation = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : SpySalesOrderTableMap::translateFieldName('Store', TableMap::TYPE_PHPNAME, $indexType)];
            $this->store = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : SpySalesOrderTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : SpySalesOrderTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 23; // 23 = SpySalesOrderTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrder'), 0, $e);
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
        if ($this->aLocale !== null && $this->fk_locale !== $this->aLocale->getIdLocale()) {
            $this->aLocale = null;
        }
        if ($this->aBillingAddress !== null && $this->fk_sales_order_address_billing !== $this->aBillingAddress->getIdSalesOrderAddress()) {
            $this->aBillingAddress = null;
        }
        if ($this->aShippingAddress !== null && $this->fk_sales_order_address_shipping !== $this->aShippingAddress->getIdSalesOrderAddress()) {
            $this->aShippingAddress = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpySalesOrderTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpySalesOrderQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aBillingAddress = null;
            $this->aShippingAddress = null;
            $this->aLocale = null;
            $this->collSpyMerchantSalesOrders = null;

            $this->collTransitionLogs = null;

            $this->collSpyRefunds = null;

            $this->collItems = null;

            $this->collDiscounts = null;

            $this->collExpenses = null;

            $this->collSpySalesShipments = null;

            $this->collOrderTotals = null;

            $this->collNotes = null;

            $this->collOrderComments = null;

            $this->collSpySalesOrderInvoices = null;

            $this->collSpySalesMerchantCommissions = null;

            $this->collOrders = null;

            $this->collSpySalesPaymentMerchantPayouts = null;

            $this->collSpySalesPaymentMerchantPayoutReversals = null;

            $this->collReclamations = null;

            $this->collSpySspInquirySalesOrders = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpySalesOrder::setDeleted()
     * @see SpySalesOrder::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpySalesOrderQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                $time = time();
                $highPrecision = \Propel\Runtime\Util\PropelDateTime::createHighPrecision();
                if (!$this->isColumnModified(SpySalesOrderTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpySalesOrderTableMap::COL_UPDATED_AT)) {
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
                if ($this->isModified() && !$this->isColumnModified(SpySalesOrderTableMap::COL_UPDATED_AT)) {
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
                SpySalesOrderTableMap::addInstanceToPool($this);
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

            if ($this->aBillingAddress !== null) {
                if ($this->aBillingAddress->isModified() || $this->aBillingAddress->isNew()) {
                    $affectedRows += $this->aBillingAddress->save($con);
                }
                $this->setBillingAddress($this->aBillingAddress);
            }

            if ($this->aShippingAddress !== null) {
                if ($this->aShippingAddress->isModified() || $this->aShippingAddress->isNew()) {
                    $affectedRows += $this->aShippingAddress->save($con);
                }
                $this->setShippingAddress($this->aShippingAddress);
            }

            if ($this->aLocale !== null) {
                if ($this->aLocale->isModified() || $this->aLocale->isNew()) {
                    $affectedRows += $this->aLocale->save($con);
                }
                $this->setLocale($this->aLocale);
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

            if ($this->spyMerchantSalesOrdersScheduledForDeletion !== null) {
                if (!$this->spyMerchantSalesOrdersScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderQuery::create()
                        ->filterByPrimaryKeys($this->spyMerchantSalesOrdersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyMerchantSalesOrdersScheduledForDeletion = null;
                }
            }

            if ($this->collSpyMerchantSalesOrders !== null) {
                foreach ($this->collSpyMerchantSalesOrders as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->transitionLogsScheduledForDeletion !== null) {
                if (!$this->transitionLogsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Oms\Persistence\SpyOmsTransitionLogQuery::create()
                        ->filterByPrimaryKeys($this->transitionLogsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->transitionLogsScheduledForDeletion = null;
                }
            }

            if ($this->collTransitionLogs !== null) {
                foreach ($this->collTransitionLogs as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyRefundsScheduledForDeletion !== null) {
                if (!$this->spyRefundsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Refund\Persistence\SpyRefundQuery::create()
                        ->filterByPrimaryKeys($this->spyRefundsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyRefundsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyRefunds !== null) {
                foreach ($this->collSpyRefunds as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->itemsScheduledForDeletion !== null) {
                if (!$this->itemsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Sales\Persistence\SpySalesOrderItemQuery::create()
                        ->filterByPrimaryKeys($this->itemsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->itemsScheduledForDeletion = null;
                }
            }

            if ($this->collItems !== null) {
                foreach ($this->collItems as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->discountsScheduledForDeletion !== null) {
                if (!$this->discountsScheduledForDeletion->isEmpty()) {
                    foreach ($this->discountsScheduledForDeletion as $discount) {
                        // need to save related object because we set the relation to null
                        $discount->save($con);
                    }
                    $this->discountsScheduledForDeletion = null;
                }
            }

            if ($this->collDiscounts !== null) {
                foreach ($this->collDiscounts as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->expensesScheduledForDeletion !== null) {
                if (!$this->expensesScheduledForDeletion->isEmpty()) {
                    foreach ($this->expensesScheduledForDeletion as $expense) {
                        // need to save related object because we set the relation to null
                        $expense->save($con);
                    }
                    $this->expensesScheduledForDeletion = null;
                }
            }

            if ($this->collExpenses !== null) {
                foreach ($this->collExpenses as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spySalesShipmentsScheduledForDeletion !== null) {
                if (!$this->spySalesShipmentsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Sales\Persistence\SpySalesShipmentQuery::create()
                        ->filterByPrimaryKeys($this->spySalesShipmentsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spySalesShipmentsScheduledForDeletion = null;
                }
            }

            if ($this->collSpySalesShipments !== null) {
                foreach ($this->collSpySalesShipments as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->orderTotalsScheduledForDeletion !== null) {
                if (!$this->orderTotalsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Sales\Persistence\SpySalesOrderTotalsQuery::create()
                        ->filterByPrimaryKeys($this->orderTotalsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->orderTotalsScheduledForDeletion = null;
                }
            }

            if ($this->collOrderTotals !== null) {
                foreach ($this->collOrderTotals as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->notesScheduledForDeletion !== null) {
                if (!$this->notesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Sales\Persistence\SpySalesOrderNoteQuery::create()
                        ->filterByPrimaryKeys($this->notesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->notesScheduledForDeletion = null;
                }
            }

            if ($this->collNotes !== null) {
                foreach ($this->collNotes as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->orderCommentsScheduledForDeletion !== null) {
                if (!$this->orderCommentsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Sales\Persistence\SpySalesOrderCommentQuery::create()
                        ->filterByPrimaryKeys($this->orderCommentsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->orderCommentsScheduledForDeletion = null;
                }
            }

            if ($this->collOrderComments !== null) {
                foreach ($this->collOrderComments as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spySalesOrderInvoicesScheduledForDeletion !== null) {
                if (!$this->spySalesOrderInvoicesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\SalesInvoice\Persistence\SpySalesOrderInvoiceQuery::create()
                        ->filterByPrimaryKeys($this->spySalesOrderInvoicesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spySalesOrderInvoicesScheduledForDeletion = null;
                }
            }

            if ($this->collSpySalesOrderInvoices !== null) {
                foreach ($this->collSpySalesOrderInvoices as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spySalesMerchantCommissionsScheduledForDeletion !== null) {
                if (!$this->spySalesMerchantCommissionsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\SalesMerchantCommission\Persistence\SpySalesMerchantCommissionQuery::create()
                        ->filterByPrimaryKeys($this->spySalesMerchantCommissionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spySalesMerchantCommissionsScheduledForDeletion = null;
                }
            }

            if ($this->collSpySalesMerchantCommissions !== null) {
                foreach ($this->collSpySalesMerchantCommissions as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->ordersScheduledForDeletion !== null) {
                if (!$this->ordersScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Payment\Persistence\SpySalesPaymentQuery::create()
                        ->filterByPrimaryKeys($this->ordersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->ordersScheduledForDeletion = null;
                }
            }

            if ($this->collOrders !== null) {
                foreach ($this->collOrders as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spySalesPaymentMerchantPayoutsScheduledForDeletion !== null) {
                if (!$this->spySalesPaymentMerchantPayoutsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutQuery::create()
                        ->filterByPrimaryKeys($this->spySalesPaymentMerchantPayoutsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spySalesPaymentMerchantPayoutsScheduledForDeletion = null;
                }
            }

            if ($this->collSpySalesPaymentMerchantPayouts !== null) {
                foreach ($this->collSpySalesPaymentMerchantPayouts as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spySalesPaymentMerchantPayoutReversalsScheduledForDeletion !== null) {
                if (!$this->spySalesPaymentMerchantPayoutReversalsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversalQuery::create()
                        ->filterByPrimaryKeys($this->spySalesPaymentMerchantPayoutReversalsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spySalesPaymentMerchantPayoutReversalsScheduledForDeletion = null;
                }
            }

            if ($this->collSpySalesPaymentMerchantPayoutReversals !== null) {
                foreach ($this->collSpySalesPaymentMerchantPayoutReversals as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->reclamationsScheduledForDeletion !== null) {
                if (!$this->reclamationsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationQuery::create()
                        ->filterByPrimaryKeys($this->reclamationsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->reclamationsScheduledForDeletion = null;
                }
            }

            if ($this->collReclamations !== null) {
                foreach ($this->collReclamations as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spySspInquirySalesOrdersScheduledForDeletion !== null) {
                if (!$this->spySspInquirySalesOrdersScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderQuery::create()
                        ->filterByPrimaryKeys($this->spySspInquirySalesOrdersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spySspInquirySalesOrdersScheduledForDeletion = null;
                }
            }

            if ($this->collSpySspInquirySalesOrders !== null) {
                foreach ($this->collSpySspInquirySalesOrders as $referrerFK) {
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

        $this->modifiedColumns[SpySalesOrderTableMap::COL_ID_SALES_ORDER] = true;
        if (null !== $this->id_sales_order) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpySalesOrderTableMap::COL_ID_SALES_ORDER . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_ID_SALES_ORDER)) {
            $modifiedColumns[':p' . $index++]  = 'id_sales_order';
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_FK_LOCALE)) {
            $modifiedColumns[':p' . $index++]  = 'fk_locale';
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_FK_SALES_ORDER_ADDRESS_BILLING)) {
            $modifiedColumns[':p' . $index++]  = 'fk_sales_order_address_billing';
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_FK_SALES_ORDER_ADDRESS_SHIPPING)) {
            $modifiedColumns[':p' . $index++]  = 'fk_sales_order_address_shipping';
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_AGENT_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'agent_email';
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_CART_NOTE)) {
            $modifiedColumns[':p' . $index++]  = 'cart_note';
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_COMPANY_BUSINESS_UNIT_UUID)) {
            $modifiedColumns[':p' . $index++]  = 'company_business_unit_uuid';
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_COMPANY_UUID)) {
            $modifiedColumns[':p' . $index++]  = 'company_uuid';
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_CURRENCY_ISO_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'currency_iso_code';
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_CUSTOMER_REFERENCE)) {
            $modifiedColumns[':p' . $index++]  = 'customer_reference';
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'email';
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_FIRST_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'first_name';
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_IS_TEST)) {
            $modifiedColumns[':p' . $index++]  = 'is_test';
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_LAST_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'last_name';
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_OMS_PROCESSOR_IDENTIFIER)) {
            $modifiedColumns[':p' . $index++]  = 'oms_processor_identifier';
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_ORDER_CUSTOM_REFERENCE)) {
            $modifiedColumns[':p' . $index++]  = 'order_custom_reference';
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_ORDER_REFERENCE)) {
            $modifiedColumns[':p' . $index++]  = 'order_reference';
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_PRICE_MODE)) {
            $modifiedColumns[':p' . $index++]  = 'price_mode';
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_QUOTE_REQUEST_VERSION_REFERENCE)) {
            $modifiedColumns[':p' . $index++]  = 'quote_request_version_reference';
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_SALUTATION)) {
            $modifiedColumns[':p' . $index++]  = 'salutation';
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_STORE)) {
            $modifiedColumns[':p' . $index++]  = 'store';
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO spy_sales_order (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_sales_order':
                        $stmt->bindValue($identifier, $this->id_sales_order, PDO::PARAM_INT);

                        break;
                    case 'fk_locale':
                        $stmt->bindValue($identifier, $this->fk_locale, PDO::PARAM_INT);

                        break;
                    case 'fk_sales_order_address_billing':
                        $stmt->bindValue($identifier, $this->fk_sales_order_address_billing, PDO::PARAM_INT);

                        break;
                    case 'fk_sales_order_address_shipping':
                        $stmt->bindValue($identifier, $this->fk_sales_order_address_shipping, PDO::PARAM_INT);

                        break;
                    case 'agent_email':
                        $stmt->bindValue($identifier, $this->agent_email, PDO::PARAM_STR);

                        break;
                    case 'cart_note':
                        $stmt->bindValue($identifier, $this->cart_note, PDO::PARAM_STR);

                        break;
                    case 'company_business_unit_uuid':
                        $stmt->bindValue($identifier, $this->company_business_unit_uuid, PDO::PARAM_STR);

                        break;
                    case 'company_uuid':
                        $stmt->bindValue($identifier, $this->company_uuid, PDO::PARAM_STR);

                        break;
                    case 'currency_iso_code':
                        $stmt->bindValue($identifier, $this->currency_iso_code, PDO::PARAM_STR);

                        break;
                    case 'customer_reference':
                        $stmt->bindValue($identifier, $this->customer_reference, PDO::PARAM_STR);

                        break;
                    case 'email':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);

                        break;
                    case 'first_name':
                        $stmt->bindValue($identifier, $this->first_name, PDO::PARAM_STR);

                        break;
                    case 'is_test':
                        $stmt->bindValue($identifier, (int) $this->is_test, PDO::PARAM_INT);

                        break;
                    case 'last_name':
                        $stmt->bindValue($identifier, $this->last_name, PDO::PARAM_STR);

                        break;
                    case 'oms_processor_identifier':
                        $stmt->bindValue($identifier, $this->oms_processor_identifier, PDO::PARAM_INT);

                        break;
                    case 'order_custom_reference':
                        $stmt->bindValue($identifier, $this->order_custom_reference, PDO::PARAM_STR);

                        break;
                    case 'order_reference':
                        $stmt->bindValue($identifier, $this->order_reference, PDO::PARAM_STR);

                        break;
                    case 'price_mode':
                        $stmt->bindValue($identifier, $this->price_mode, PDO::PARAM_INT);

                        break;
                    case 'quote_request_version_reference':
                        $stmt->bindValue($identifier, $this->quote_request_version_reference, PDO::PARAM_STR);

                        break;
                    case 'salutation':
                        $stmt->bindValue($identifier, $this->salutation, PDO::PARAM_INT);

                        break;
                    case 'store':
                        $stmt->bindValue($identifier, $this->store, PDO::PARAM_STR);

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
            $pk = $con->lastInsertId('spy_sales_order_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdSalesOrder($pk);

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
        $pos = SpySalesOrderTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdSalesOrder();

            case 1:
                return $this->getFkLocale();

            case 2:
                return $this->getFkSalesOrderAddressBilling();

            case 3:
                return $this->getFkSalesOrderAddressShipping();

            case 4:
                return $this->getAgentEmail();

            case 5:
                return $this->getCartNote();

            case 6:
                return $this->getCompanyBusinessUnitUuid();

            case 7:
                return $this->getCompanyUuid();

            case 8:
                return $this->getCurrencyIsoCode();

            case 9:
                return $this->getCustomerReference();

            case 10:
                return $this->getEmail();

            case 11:
                return $this->getFirstName();

            case 12:
                return $this->getIsTest();

            case 13:
                return $this->getLastName();

            case 14:
                return $this->getOmsProcessorIdentifier();

            case 15:
                return $this->getOrderCustomReference();

            case 16:
                return $this->getOrderReference();

            case 17:
                return $this->getPriceMode();

            case 18:
                return $this->getQuoteRequestVersionReference();

            case 19:
                return $this->getSalutation();

            case 20:
                return $this->getStore();

            case 21:
                return $this->getCreatedAt();

            case 22:
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
        if (isset($alreadyDumpedObjects['SpySalesOrder'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpySalesOrder'][$this->hashCode()] = true;
        $keys = SpySalesOrderTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdSalesOrder(),
            $keys[1] => $this->getFkLocale(),
            $keys[2] => $this->getFkSalesOrderAddressBilling(),
            $keys[3] => $this->getFkSalesOrderAddressShipping(),
            $keys[4] => $this->getAgentEmail(),
            $keys[5] => $this->getCartNote(),
            $keys[6] => $this->getCompanyBusinessUnitUuid(),
            $keys[7] => $this->getCompanyUuid(),
            $keys[8] => $this->getCurrencyIsoCode(),
            $keys[9] => $this->getCustomerReference(),
            $keys[10] => $this->getEmail(),
            $keys[11] => $this->getFirstName(),
            $keys[12] => $this->getIsTest(),
            $keys[13] => $this->getLastName(),
            $keys[14] => $this->getOmsProcessorIdentifier(),
            $keys[15] => $this->getOrderCustomReference(),
            $keys[16] => $this->getOrderReference(),
            $keys[17] => $this->getPriceMode(),
            $keys[18] => $this->getQuoteRequestVersionReference(),
            $keys[19] => $this->getSalutation(),
            $keys[20] => $this->getStore(),
            $keys[21] => $this->getCreatedAt(),
            $keys[22] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[21]] instanceof \DateTimeInterface) {
            $result[$keys[21]] = $result[$keys[21]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[22]] instanceof \DateTimeInterface) {
            $result[$keys[22]] = $result[$keys[22]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aBillingAddress) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesOrderAddress';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_order_address';
                        break;
                    default:
                        $key = 'BillingAddress';
                }

                $result[$key] = $this->aBillingAddress->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aShippingAddress) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesOrderAddress';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_order_address';
                        break;
                    default:
                        $key = 'ShippingAddress';
                }

                $result[$key] = $this->aShippingAddress->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aLocale) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyLocale';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_locale';
                        break;
                    default:
                        $key = 'Locale';
                }

                $result[$key] = $this->aLocale->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collSpyMerchantSalesOrders) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchantSalesOrders';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant_sales_orders';
                        break;
                    default:
                        $key = 'SpyMerchantSalesOrders';
                }

                $result[$key] = $this->collSpyMerchantSalesOrders->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTransitionLogs) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyOmsTransitionLogs';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_oms_transition_logs';
                        break;
                    default:
                        $key = 'TransitionLogs';
                }

                $result[$key] = $this->collTransitionLogs->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyRefunds) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyRefunds';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_refunds';
                        break;
                    default:
                        $key = 'SpyRefunds';
                }

                $result[$key] = $this->collSpyRefunds->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collItems) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesOrderItems';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_order_items';
                        break;
                    default:
                        $key = 'Items';
                }

                $result[$key] = $this->collItems->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collDiscounts) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesDiscounts';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_discounts';
                        break;
                    default:
                        $key = 'Discounts';
                }

                $result[$key] = $this->collDiscounts->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collExpenses) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesExpenses';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_expenses';
                        break;
                    default:
                        $key = 'Expenses';
                }

                $result[$key] = $this->collExpenses->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpySalesShipments) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesShipments';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_shipments';
                        break;
                    default:
                        $key = 'SpySalesShipments';
                }

                $result[$key] = $this->collSpySalesShipments->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOrderTotals) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesOrderTotalss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_order_totalss';
                        break;
                    default:
                        $key = 'OrderTotals';
                }

                $result[$key] = $this->collOrderTotals->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collNotes) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesOrderNotes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_order_notes';
                        break;
                    default:
                        $key = 'Notes';
                }

                $result[$key] = $this->collNotes->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOrderComments) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesOrderComments';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_order_comments';
                        break;
                    default:
                        $key = 'OrderComments';
                }

                $result[$key] = $this->collOrderComments->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpySalesOrderInvoices) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesOrderInvoices';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_order_invoices';
                        break;
                    default:
                        $key = 'SpySalesOrderInvoices';
                }

                $result[$key] = $this->collSpySalesOrderInvoices->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpySalesMerchantCommissions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesMerchantCommissions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_merchant_commissions';
                        break;
                    default:
                        $key = 'SpySalesMerchantCommissions';
                }

                $result[$key] = $this->collSpySalesMerchantCommissions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOrders) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesPayments';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_payments';
                        break;
                    default:
                        $key = 'Orders';
                }

                $result[$key] = $this->collOrders->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpySalesPaymentMerchantPayouts) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesPaymentMerchantPayouts';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_payment_merchant_payouts';
                        break;
                    default:
                        $key = 'SpySalesPaymentMerchantPayouts';
                }

                $result[$key] = $this->collSpySalesPaymentMerchantPayouts->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpySalesPaymentMerchantPayoutReversals) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesPaymentMerchantPayoutReversals';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_payment_merchant_payout_reversals';
                        break;
                    default:
                        $key = 'SpySalesPaymentMerchantPayoutReversals';
                }

                $result[$key] = $this->collSpySalesPaymentMerchantPayoutReversals->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collReclamations) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesReclamations';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_reclamations';
                        break;
                    default:
                        $key = 'Reclamations';
                }

                $result[$key] = $this->collReclamations->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpySspInquirySalesOrders) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySspInquirySalesOrders';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_ssp_inquiry_sales_orders';
                        break;
                    default:
                        $key = 'SpySspInquirySalesOrders';
                }

                $result[$key] = $this->collSpySspInquirySalesOrders->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpySalesOrderTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdSalesOrder($value);
                break;
            case 1:
                $this->setFkLocale($value);
                break;
            case 2:
                $this->setFkSalesOrderAddressBilling($value);
                break;
            case 3:
                $this->setFkSalesOrderAddressShipping($value);
                break;
            case 4:
                $this->setAgentEmail($value);
                break;
            case 5:
                $this->setCartNote($value);
                break;
            case 6:
                $this->setCompanyBusinessUnitUuid($value);
                break;
            case 7:
                $this->setCompanyUuid($value);
                break;
            case 8:
                $this->setCurrencyIsoCode($value);
                break;
            case 9:
                $this->setCustomerReference($value);
                break;
            case 10:
                $this->setEmail($value);
                break;
            case 11:
                $this->setFirstName($value);
                break;
            case 12:
                $this->setIsTest($value);
                break;
            case 13:
                $this->setLastName($value);
                break;
            case 14:
                $this->setOmsProcessorIdentifier($value);
                break;
            case 15:
                $this->setOrderCustomReference($value);
                break;
            case 16:
                $this->setOrderReference($value);
                break;
            case 17:
                $valueSet = SpySalesOrderTableMap::getValueSet(SpySalesOrderTableMap::COL_PRICE_MODE);
                if (isset($valueSet[$value])) {
                    $value = $valueSet[$value];
                }
                $this->setPriceMode($value);
                break;
            case 18:
                $this->setQuoteRequestVersionReference($value);
                break;
            case 19:
                $valueSet = SpySalesOrderTableMap::getValueSet(SpySalesOrderTableMap::COL_SALUTATION);
                if (isset($valueSet[$value])) {
                    $value = $valueSet[$value];
                }
                $this->setSalutation($value);
                break;
            case 20:
                $this->setStore($value);
                break;
            case 21:
                $this->setCreatedAt($value);
                break;
            case 22:
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
        $keys = SpySalesOrderTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdSalesOrder($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkLocale($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setFkSalesOrderAddressBilling($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setFkSalesOrderAddressShipping($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setAgentEmail($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setCartNote($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setCompanyBusinessUnitUuid($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setCompanyUuid($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCurrencyIsoCode($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setCustomerReference($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setEmail($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setFirstName($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setIsTest($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setLastName($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setOmsProcessorIdentifier($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setOrderCustomReference($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setOrderReference($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setPriceMode($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setQuoteRequestVersionReference($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setSalutation($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setStore($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setCreatedAt($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setUpdatedAt($arr[$keys[22]]);
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
        $criteria = new Criteria(SpySalesOrderTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpySalesOrderTableMap::COL_ID_SALES_ORDER)) {
            $criteria->add(SpySalesOrderTableMap::COL_ID_SALES_ORDER, $this->id_sales_order);
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_FK_LOCALE)) {
            $criteria->add(SpySalesOrderTableMap::COL_FK_LOCALE, $this->fk_locale);
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_FK_SALES_ORDER_ADDRESS_BILLING)) {
            $criteria->add(SpySalesOrderTableMap::COL_FK_SALES_ORDER_ADDRESS_BILLING, $this->fk_sales_order_address_billing);
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_FK_SALES_ORDER_ADDRESS_SHIPPING)) {
            $criteria->add(SpySalesOrderTableMap::COL_FK_SALES_ORDER_ADDRESS_SHIPPING, $this->fk_sales_order_address_shipping);
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_AGENT_EMAIL)) {
            $criteria->add(SpySalesOrderTableMap::COL_AGENT_EMAIL, $this->agent_email);
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_CART_NOTE)) {
            $criteria->add(SpySalesOrderTableMap::COL_CART_NOTE, $this->cart_note);
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_COMPANY_BUSINESS_UNIT_UUID)) {
            $criteria->add(SpySalesOrderTableMap::COL_COMPANY_BUSINESS_UNIT_UUID, $this->company_business_unit_uuid);
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_COMPANY_UUID)) {
            $criteria->add(SpySalesOrderTableMap::COL_COMPANY_UUID, $this->company_uuid);
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_CURRENCY_ISO_CODE)) {
            $criteria->add(SpySalesOrderTableMap::COL_CURRENCY_ISO_CODE, $this->currency_iso_code);
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_CUSTOMER_REFERENCE)) {
            $criteria->add(SpySalesOrderTableMap::COL_CUSTOMER_REFERENCE, $this->customer_reference);
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_EMAIL)) {
            $criteria->add(SpySalesOrderTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_FIRST_NAME)) {
            $criteria->add(SpySalesOrderTableMap::COL_FIRST_NAME, $this->first_name);
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_IS_TEST)) {
            $criteria->add(SpySalesOrderTableMap::COL_IS_TEST, $this->is_test);
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_LAST_NAME)) {
            $criteria->add(SpySalesOrderTableMap::COL_LAST_NAME, $this->last_name);
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_OMS_PROCESSOR_IDENTIFIER)) {
            $criteria->add(SpySalesOrderTableMap::COL_OMS_PROCESSOR_IDENTIFIER, $this->oms_processor_identifier);
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_ORDER_CUSTOM_REFERENCE)) {
            $criteria->add(SpySalesOrderTableMap::COL_ORDER_CUSTOM_REFERENCE, $this->order_custom_reference);
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_ORDER_REFERENCE)) {
            $criteria->add(SpySalesOrderTableMap::COL_ORDER_REFERENCE, $this->order_reference);
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_PRICE_MODE)) {
            $criteria->add(SpySalesOrderTableMap::COL_PRICE_MODE, $this->price_mode);
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_QUOTE_REQUEST_VERSION_REFERENCE)) {
            $criteria->add(SpySalesOrderTableMap::COL_QUOTE_REQUEST_VERSION_REFERENCE, $this->quote_request_version_reference);
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_SALUTATION)) {
            $criteria->add(SpySalesOrderTableMap::COL_SALUTATION, $this->salutation);
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_STORE)) {
            $criteria->add(SpySalesOrderTableMap::COL_STORE, $this->store);
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_CREATED_AT)) {
            $criteria->add(SpySalesOrderTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpySalesOrderTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpySalesOrderTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildSpySalesOrderQuery::create();
        $criteria->add(SpySalesOrderTableMap::COL_ID_SALES_ORDER, $this->id_sales_order);

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
        $validPk = null !== $this->getIdSalesOrder();

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
        return $this->getIdSalesOrder();
    }

    /**
     * Generic method to set the primary key (id_sales_order column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdSalesOrder($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdSalesOrder();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\Sales\Persistence\SpySalesOrder (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkLocale($this->getFkLocale());
        $copyObj->setFkSalesOrderAddressBilling($this->getFkSalesOrderAddressBilling());
        $copyObj->setFkSalesOrderAddressShipping($this->getFkSalesOrderAddressShipping());
        $copyObj->setAgentEmail($this->getAgentEmail());
        $copyObj->setCartNote($this->getCartNote());
        $copyObj->setCompanyBusinessUnitUuid($this->getCompanyBusinessUnitUuid());
        $copyObj->setCompanyUuid($this->getCompanyUuid());
        $copyObj->setCurrencyIsoCode($this->getCurrencyIsoCode());
        $copyObj->setCustomerReference($this->getCustomerReference());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setFirstName($this->getFirstName());
        $copyObj->setIsTest($this->getIsTest());
        $copyObj->setLastName($this->getLastName());
        $copyObj->setOmsProcessorIdentifier($this->getOmsProcessorIdentifier());
        $copyObj->setOrderCustomReference($this->getOrderCustomReference());
        $copyObj->setOrderReference($this->getOrderReference());
        $copyObj->setPriceMode($this->getPriceMode());
        $copyObj->setQuoteRequestVersionReference($this->getQuoteRequestVersionReference());
        $copyObj->setSalutation($this->getSalutation());
        $copyObj->setStore($this->getStore());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyMerchantSalesOrders() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyMerchantSalesOrder($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTransitionLogs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTransitionLog($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyRefunds() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyRefund($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getItems() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addItem($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getDiscounts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDiscount($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getExpenses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addExpense($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpySalesShipments() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpySalesShipment($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOrderTotals() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrderTotal($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getNotes() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addNote($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOrderComments() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrderComment($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpySalesOrderInvoices() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpySalesOrderInvoice($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpySalesMerchantCommissions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpySalesMerchantCommission($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOrders() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrder($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpySalesPaymentMerchantPayouts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpySalesPaymentMerchantPayout($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpySalesPaymentMerchantPayoutReversals() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpySalesPaymentMerchantPayoutReversal($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getReclamations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addReclamation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpySspInquirySalesOrders() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpySspInquirySalesOrder($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdSalesOrder(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrder Clone of current object.
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
     * Declares an association between this object and a ChildSpySalesOrderAddress object.
     *
     * @param ChildSpySalesOrderAddress $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setBillingAddress(ChildSpySalesOrderAddress $v = null)
    {
        if ($v === null) {
            $this->setFkSalesOrderAddressBilling(NULL);
        } else {
            $this->setFkSalesOrderAddressBilling($v->getIdSalesOrderAddress());
        }

        $this->aBillingAddress = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpySalesOrderAddress object, it will not be re-added.
        if ($v !== null) {
            $v->addSpySalesOrderRelatedByFkSalesOrderAddressBilling($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpySalesOrderAddress object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSpySalesOrderAddress The associated ChildSpySalesOrderAddress object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBillingAddress(?ConnectionInterface $con = null)
    {
        if ($this->aBillingAddress === null && ($this->fk_sales_order_address_billing != 0)) {
            $this->aBillingAddress = ChildSpySalesOrderAddressQuery::create()->findPk($this->fk_sales_order_address_billing, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBillingAddress->addSpySalesOrdersRelatedByFkSalesOrderAddressBilling($this);
             */
        }

        return $this->aBillingAddress;
    }

    /**
     * Declares an association between this object and a ChildSpySalesOrderAddress object.
     *
     * @param ChildSpySalesOrderAddress|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setShippingAddress(ChildSpySalesOrderAddress $v = null)
    {
        if ($v === null) {
            $this->setFkSalesOrderAddressShipping(NULL);
        } else {
            $this->setFkSalesOrderAddressShipping($v->getIdSalesOrderAddress());
        }

        $this->aShippingAddress = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpySalesOrderAddress object, it will not be re-added.
        if ($v !== null) {
            $v->addSpySalesOrderRelatedByFkSalesOrderAddressShipping($this);
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
    public function getShippingAddress(?ConnectionInterface $con = null)
    {
        if ($this->aShippingAddress === null && ($this->fk_sales_order_address_shipping != 0)) {
            $this->aShippingAddress = ChildSpySalesOrderAddressQuery::create()->findPk($this->fk_sales_order_address_shipping, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aShippingAddress->addSpySalesOrdersRelatedByFkSalesOrderAddressShipping($this);
             */
        }

        return $this->aShippingAddress;
    }

    /**
     * Declares an association between this object and a SpyLocale object.
     *
     * @param SpyLocale|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setLocale(SpyLocale $v = null)
    {
        if ($v === null) {
            $this->setFkLocale(NULL);
        } else {
            $this->setFkLocale($v->getIdLocale());
        }

        $this->aLocale = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyLocale object, it will not be re-added.
        if ($v !== null) {
            $v->addSpySalesOrder($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyLocale object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyLocale|null The associated SpyLocale object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getLocale(?ConnectionInterface $con = null)
    {
        if ($this->aLocale === null && ($this->fk_locale != 0)) {
            $this->aLocale = SpyLocaleQuery::create()->findPk($this->fk_locale, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLocale->addSpySalesOrders($this);
             */
        }

        return $this->aLocale;
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
        if ('SpyMerchantSalesOrder' === $relationName) {
            $this->initSpyMerchantSalesOrders();
            return;
        }
        if ('TransitionLog' === $relationName) {
            $this->initTransitionLogs();
            return;
        }
        if ('SpyRefund' === $relationName) {
            $this->initSpyRefunds();
            return;
        }
        if ('Item' === $relationName) {
            $this->initItems();
            return;
        }
        if ('Discount' === $relationName) {
            $this->initDiscounts();
            return;
        }
        if ('Expense' === $relationName) {
            $this->initExpenses();
            return;
        }
        if ('SpySalesShipment' === $relationName) {
            $this->initSpySalesShipments();
            return;
        }
        if ('OrderTotal' === $relationName) {
            $this->initOrderTotals();
            return;
        }
        if ('Note' === $relationName) {
            $this->initNotes();
            return;
        }
        if ('OrderComment' === $relationName) {
            $this->initOrderComments();
            return;
        }
        if ('SpySalesOrderInvoice' === $relationName) {
            $this->initSpySalesOrderInvoices();
            return;
        }
        if ('SpySalesMerchantCommission' === $relationName) {
            $this->initSpySalesMerchantCommissions();
            return;
        }
        if ('Order' === $relationName) {
            $this->initOrders();
            return;
        }
        if ('SpySalesPaymentMerchantPayout' === $relationName) {
            $this->initSpySalesPaymentMerchantPayouts();
            return;
        }
        if ('SpySalesPaymentMerchantPayoutReversal' === $relationName) {
            $this->initSpySalesPaymentMerchantPayoutReversals();
            return;
        }
        if ('Reclamation' === $relationName) {
            $this->initReclamations();
            return;
        }
        if ('SpySspInquirySalesOrder' === $relationName) {
            $this->initSpySspInquirySalesOrders();
            return;
        }
    }

    /**
     * Clears out the collSpyMerchantSalesOrders collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyMerchantSalesOrders()
     */
    public function clearSpyMerchantSalesOrders()
    {
        $this->collSpyMerchantSalesOrders = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyMerchantSalesOrders collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyMerchantSalesOrders($v = true): void
    {
        $this->collSpyMerchantSalesOrdersPartial = $v;
    }

    /**
     * Initializes the collSpyMerchantSalesOrders collection.
     *
     * By default this just sets the collSpyMerchantSalesOrders collection to an empty array (like clearcollSpyMerchantSalesOrders());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyMerchantSalesOrders(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyMerchantSalesOrders && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyMerchantSalesOrderTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyMerchantSalesOrders = new $collectionClassName;
        $this->collSpyMerchantSalesOrders->setModel('\Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrder');
    }

    /**
     * Gets an array of SpyMerchantSalesOrder objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySalesOrder is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyMerchantSalesOrder[] List of SpyMerchantSalesOrder objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantSalesOrder> List of SpyMerchantSalesOrder objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyMerchantSalesOrders(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyMerchantSalesOrdersPartial && !$this->isNew();
        if (null === $this->collSpyMerchantSalesOrders || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyMerchantSalesOrders) {
                    $this->initSpyMerchantSalesOrders();
                } else {
                    $collectionClassName = SpyMerchantSalesOrderTableMap::getTableMap()->getCollectionClassName();

                    $collSpyMerchantSalesOrders = new $collectionClassName;
                    $collSpyMerchantSalesOrders->setModel('\Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrder');

                    return $collSpyMerchantSalesOrders;
                }
            } else {
                $collSpyMerchantSalesOrders = SpyMerchantSalesOrderQuery::create(null, $criteria)
                    ->filterByOrder($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyMerchantSalesOrdersPartial && count($collSpyMerchantSalesOrders)) {
                        $this->initSpyMerchantSalesOrders(false);

                        foreach ($collSpyMerchantSalesOrders as $obj) {
                            if (false == $this->collSpyMerchantSalesOrders->contains($obj)) {
                                $this->collSpyMerchantSalesOrders->append($obj);
                            }
                        }

                        $this->collSpyMerchantSalesOrdersPartial = true;
                    }

                    return $collSpyMerchantSalesOrders;
                }

                if ($partial && $this->collSpyMerchantSalesOrders) {
                    foreach ($this->collSpyMerchantSalesOrders as $obj) {
                        if ($obj->isNew()) {
                            $collSpyMerchantSalesOrders[] = $obj;
                        }
                    }
                }

                $this->collSpyMerchantSalesOrders = $collSpyMerchantSalesOrders;
                $this->collSpyMerchantSalesOrdersPartial = false;
            }
        }

        return $this->collSpyMerchantSalesOrders;
    }

    /**
     * Sets a collection of SpyMerchantSalesOrder objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyMerchantSalesOrders A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyMerchantSalesOrders(Collection $spyMerchantSalesOrders, ?ConnectionInterface $con = null)
    {
        /** @var SpyMerchantSalesOrder[] $spyMerchantSalesOrdersToDelete */
        $spyMerchantSalesOrdersToDelete = $this->getSpyMerchantSalesOrders(new Criteria(), $con)->diff($spyMerchantSalesOrders);


        $this->spyMerchantSalesOrdersScheduledForDeletion = $spyMerchantSalesOrdersToDelete;

        foreach ($spyMerchantSalesOrdersToDelete as $spyMerchantSalesOrderRemoved) {
            $spyMerchantSalesOrderRemoved->setOrder(null);
        }

        $this->collSpyMerchantSalesOrders = null;
        foreach ($spyMerchantSalesOrders as $spyMerchantSalesOrder) {
            $this->addSpyMerchantSalesOrder($spyMerchantSalesOrder);
        }

        $this->collSpyMerchantSalesOrders = $spyMerchantSalesOrders;
        $this->collSpyMerchantSalesOrdersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyMerchantSalesOrder objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyMerchantSalesOrder objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyMerchantSalesOrders(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyMerchantSalesOrdersPartial && !$this->isNew();
        if (null === $this->collSpyMerchantSalesOrders || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyMerchantSalesOrders) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyMerchantSalesOrders());
            }

            $query = SpyMerchantSalesOrderQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrder($this)
                ->count($con);
        }

        return count($this->collSpyMerchantSalesOrders);
    }

    /**
     * Method called to associate a SpyMerchantSalesOrder object to this object
     * through the SpyMerchantSalesOrder foreign key attribute.
     *
     * @param SpyMerchantSalesOrder $l SpyMerchantSalesOrder
     * @return $this The current object (for fluent API support)
     */
    public function addSpyMerchantSalesOrder(SpyMerchantSalesOrder $l)
    {
        if ($this->collSpyMerchantSalesOrders === null) {
            $this->initSpyMerchantSalesOrders();
            $this->collSpyMerchantSalesOrdersPartial = true;
        }

        if (!$this->collSpyMerchantSalesOrders->contains($l)) {
            $this->doAddSpyMerchantSalesOrder($l);

            if ($this->spyMerchantSalesOrdersScheduledForDeletion and $this->spyMerchantSalesOrdersScheduledForDeletion->contains($l)) {
                $this->spyMerchantSalesOrdersScheduledForDeletion->remove($this->spyMerchantSalesOrdersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyMerchantSalesOrder $spyMerchantSalesOrder The SpyMerchantSalesOrder object to add.
     */
    protected function doAddSpyMerchantSalesOrder(SpyMerchantSalesOrder $spyMerchantSalesOrder): void
    {
        $this->collSpyMerchantSalesOrders[]= $spyMerchantSalesOrder;
        $spyMerchantSalesOrder->setOrder($this);
    }

    /**
     * @param SpyMerchantSalesOrder $spyMerchantSalesOrder The SpyMerchantSalesOrder object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyMerchantSalesOrder(SpyMerchantSalesOrder $spyMerchantSalesOrder)
    {
        if ($this->getSpyMerchantSalesOrders()->contains($spyMerchantSalesOrder)) {
            $pos = $this->collSpyMerchantSalesOrders->search($spyMerchantSalesOrder);
            $this->collSpyMerchantSalesOrders->remove($pos);
            if (null === $this->spyMerchantSalesOrdersScheduledForDeletion) {
                $this->spyMerchantSalesOrdersScheduledForDeletion = clone $this->collSpyMerchantSalesOrders;
                $this->spyMerchantSalesOrdersScheduledForDeletion->clear();
            }
            $this->spyMerchantSalesOrdersScheduledForDeletion[]= clone $spyMerchantSalesOrder;
            $spyMerchantSalesOrder->setOrder(null);
        }

        return $this;
    }

    /**
     * Clears out the collTransitionLogs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addTransitionLogs()
     */
    public function clearTransitionLogs()
    {
        $this->collTransitionLogs = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collTransitionLogs collection loaded partially.
     *
     * @return void
     */
    public function resetPartialTransitionLogs($v = true): void
    {
        $this->collTransitionLogsPartial = $v;
    }

    /**
     * Initializes the collTransitionLogs collection.
     *
     * By default this just sets the collTransitionLogs collection to an empty array (like clearcollTransitionLogs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTransitionLogs(bool $overrideExisting = true): void
    {
        if (null !== $this->collTransitionLogs && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyOmsTransitionLogTableMap::getTableMap()->getCollectionClassName();

        $this->collTransitionLogs = new $collectionClassName;
        $this->collTransitionLogs->setModel('\Orm\Zed\Oms\Persistence\SpyOmsTransitionLog');
    }

    /**
     * Gets an array of SpyOmsTransitionLog objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySalesOrder is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyOmsTransitionLog[] List of SpyOmsTransitionLog objects
     * @phpstan-return ObjectCollection&\Traversable<SpyOmsTransitionLog> List of SpyOmsTransitionLog objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getTransitionLogs(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collTransitionLogsPartial && !$this->isNew();
        if (null === $this->collTransitionLogs || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collTransitionLogs) {
                    $this->initTransitionLogs();
                } else {
                    $collectionClassName = SpyOmsTransitionLogTableMap::getTableMap()->getCollectionClassName();

                    $collTransitionLogs = new $collectionClassName;
                    $collTransitionLogs->setModel('\Orm\Zed\Oms\Persistence\SpyOmsTransitionLog');

                    return $collTransitionLogs;
                }
            } else {
                $collTransitionLogs = SpyOmsTransitionLogQuery::create(null, $criteria)
                    ->filterByOrder($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTransitionLogsPartial && count($collTransitionLogs)) {
                        $this->initTransitionLogs(false);

                        foreach ($collTransitionLogs as $obj) {
                            if (false == $this->collTransitionLogs->contains($obj)) {
                                $this->collTransitionLogs->append($obj);
                            }
                        }

                        $this->collTransitionLogsPartial = true;
                    }

                    return $collTransitionLogs;
                }

                if ($partial && $this->collTransitionLogs) {
                    foreach ($this->collTransitionLogs as $obj) {
                        if ($obj->isNew()) {
                            $collTransitionLogs[] = $obj;
                        }
                    }
                }

                $this->collTransitionLogs = $collTransitionLogs;
                $this->collTransitionLogsPartial = false;
            }
        }

        return $this->collTransitionLogs;
    }

    /**
     * Sets a collection of SpyOmsTransitionLog objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $transitionLogs A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setTransitionLogs(Collection $transitionLogs, ?ConnectionInterface $con = null)
    {
        /** @var SpyOmsTransitionLog[] $transitionLogsToDelete */
        $transitionLogsToDelete = $this->getTransitionLogs(new Criteria(), $con)->diff($transitionLogs);


        $this->transitionLogsScheduledForDeletion = $transitionLogsToDelete;

        foreach ($transitionLogsToDelete as $transitionLogRemoved) {
            $transitionLogRemoved->setOrder(null);
        }

        $this->collTransitionLogs = null;
        foreach ($transitionLogs as $transitionLog) {
            $this->addTransitionLog($transitionLog);
        }

        $this->collTransitionLogs = $transitionLogs;
        $this->collTransitionLogsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyOmsTransitionLog objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyOmsTransitionLog objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countTransitionLogs(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collTransitionLogsPartial && !$this->isNew();
        if (null === $this->collTransitionLogs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTransitionLogs) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTransitionLogs());
            }

            $query = SpyOmsTransitionLogQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrder($this)
                ->count($con);
        }

        return count($this->collTransitionLogs);
    }

    /**
     * Method called to associate a SpyOmsTransitionLog object to this object
     * through the SpyOmsTransitionLog foreign key attribute.
     *
     * @param SpyOmsTransitionLog $l SpyOmsTransitionLog
     * @return $this The current object (for fluent API support)
     */
    public function addTransitionLog(SpyOmsTransitionLog $l)
    {
        if ($this->collTransitionLogs === null) {
            $this->initTransitionLogs();
            $this->collTransitionLogsPartial = true;
        }

        if (!$this->collTransitionLogs->contains($l)) {
            $this->doAddTransitionLog($l);

            if ($this->transitionLogsScheduledForDeletion and $this->transitionLogsScheduledForDeletion->contains($l)) {
                $this->transitionLogsScheduledForDeletion->remove($this->transitionLogsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyOmsTransitionLog $transitionLog The SpyOmsTransitionLog object to add.
     */
    protected function doAddTransitionLog(SpyOmsTransitionLog $transitionLog): void
    {
        $this->collTransitionLogs[]= $transitionLog;
        $transitionLog->setOrder($this);
    }

    /**
     * @param SpyOmsTransitionLog $transitionLog The SpyOmsTransitionLog object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeTransitionLog(SpyOmsTransitionLog $transitionLog)
    {
        if ($this->getTransitionLogs()->contains($transitionLog)) {
            $pos = $this->collTransitionLogs->search($transitionLog);
            $this->collTransitionLogs->remove($pos);
            if (null === $this->transitionLogsScheduledForDeletion) {
                $this->transitionLogsScheduledForDeletion = clone $this->collTransitionLogs;
                $this->transitionLogsScheduledForDeletion->clear();
            }
            $this->transitionLogsScheduledForDeletion[]= clone $transitionLog;
            $transitionLog->setOrder(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySalesOrder is new, it will return
     * an empty collection; or if this SpySalesOrder has previously
     * been saved, it will retrieve related TransitionLogs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySalesOrder.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyOmsTransitionLog[] List of SpyOmsTransitionLog objects
     * @phpstan-return ObjectCollection&\Traversable<SpyOmsTransitionLog}> List of SpyOmsTransitionLog objects
     */
    public function getTransitionLogsJoinOrderItem(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyOmsTransitionLogQuery::create(null, $criteria);
        $query->joinWith('OrderItem', $joinBehavior);

        return $this->getTransitionLogs($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySalesOrder is new, it will return
     * an empty collection; or if this SpySalesOrder has previously
     * been saved, it will retrieve related TransitionLogs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySalesOrder.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyOmsTransitionLog[] List of SpyOmsTransitionLog objects
     * @phpstan-return ObjectCollection&\Traversable<SpyOmsTransitionLog}> List of SpyOmsTransitionLog objects
     */
    public function getTransitionLogsJoinProcess(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyOmsTransitionLogQuery::create(null, $criteria);
        $query->joinWith('Process', $joinBehavior);

        return $this->getTransitionLogs($query, $con);
    }

    /**
     * Clears out the collSpyRefunds collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyRefunds()
     */
    public function clearSpyRefunds()
    {
        $this->collSpyRefunds = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyRefunds collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyRefunds($v = true): void
    {
        $this->collSpyRefundsPartial = $v;
    }

    /**
     * Initializes the collSpyRefunds collection.
     *
     * By default this just sets the collSpyRefunds collection to an empty array (like clearcollSpyRefunds());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyRefunds(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyRefunds && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyRefundTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyRefunds = new $collectionClassName;
        $this->collSpyRefunds->setModel('\Orm\Zed\Refund\Persistence\SpyRefund');
    }

    /**
     * Gets an array of SpyRefund objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySalesOrder is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyRefund[] List of SpyRefund objects
     * @phpstan-return ObjectCollection&\Traversable<SpyRefund> List of SpyRefund objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyRefunds(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyRefundsPartial && !$this->isNew();
        if (null === $this->collSpyRefunds || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyRefunds) {
                    $this->initSpyRefunds();
                } else {
                    $collectionClassName = SpyRefundTableMap::getTableMap()->getCollectionClassName();

                    $collSpyRefunds = new $collectionClassName;
                    $collSpyRefunds->setModel('\Orm\Zed\Refund\Persistence\SpyRefund');

                    return $collSpyRefunds;
                }
            } else {
                $collSpyRefunds = SpyRefundQuery::create(null, $criteria)
                    ->filterBySpySalesOrder($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyRefundsPartial && count($collSpyRefunds)) {
                        $this->initSpyRefunds(false);

                        foreach ($collSpyRefunds as $obj) {
                            if (false == $this->collSpyRefunds->contains($obj)) {
                                $this->collSpyRefunds->append($obj);
                            }
                        }

                        $this->collSpyRefundsPartial = true;
                    }

                    return $collSpyRefunds;
                }

                if ($partial && $this->collSpyRefunds) {
                    foreach ($this->collSpyRefunds as $obj) {
                        if ($obj->isNew()) {
                            $collSpyRefunds[] = $obj;
                        }
                    }
                }

                $this->collSpyRefunds = $collSpyRefunds;
                $this->collSpyRefundsPartial = false;
            }
        }

        return $this->collSpyRefunds;
    }

    /**
     * Sets a collection of SpyRefund objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyRefunds A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyRefunds(Collection $spyRefunds, ?ConnectionInterface $con = null)
    {
        /** @var SpyRefund[] $spyRefundsToDelete */
        $spyRefundsToDelete = $this->getSpyRefunds(new Criteria(), $con)->diff($spyRefunds);


        $this->spyRefundsScheduledForDeletion = $spyRefundsToDelete;

        foreach ($spyRefundsToDelete as $spyRefundRemoved) {
            $spyRefundRemoved->setSpySalesOrder(null);
        }

        $this->collSpyRefunds = null;
        foreach ($spyRefunds as $spyRefund) {
            $this->addSpyRefund($spyRefund);
        }

        $this->collSpyRefunds = $spyRefunds;
        $this->collSpyRefundsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyRefund objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyRefund objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyRefunds(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyRefundsPartial && !$this->isNew();
        if (null === $this->collSpyRefunds || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyRefunds) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyRefunds());
            }

            $query = SpyRefundQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpySalesOrder($this)
                ->count($con);
        }

        return count($this->collSpyRefunds);
    }

    /**
     * Method called to associate a SpyRefund object to this object
     * through the SpyRefund foreign key attribute.
     *
     * @param SpyRefund $l SpyRefund
     * @return $this The current object (for fluent API support)
     */
    public function addSpyRefund(SpyRefund $l)
    {
        if ($this->collSpyRefunds === null) {
            $this->initSpyRefunds();
            $this->collSpyRefundsPartial = true;
        }

        if (!$this->collSpyRefunds->contains($l)) {
            $this->doAddSpyRefund($l);

            if ($this->spyRefundsScheduledForDeletion and $this->spyRefundsScheduledForDeletion->contains($l)) {
                $this->spyRefundsScheduledForDeletion->remove($this->spyRefundsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyRefund $spyRefund The SpyRefund object to add.
     */
    protected function doAddSpyRefund(SpyRefund $spyRefund): void
    {
        $this->collSpyRefunds[]= $spyRefund;
        $spyRefund->setSpySalesOrder($this);
    }

    /**
     * @param SpyRefund $spyRefund The SpyRefund object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyRefund(SpyRefund $spyRefund)
    {
        if ($this->getSpyRefunds()->contains($spyRefund)) {
            $pos = $this->collSpyRefunds->search($spyRefund);
            $this->collSpyRefunds->remove($pos);
            if (null === $this->spyRefundsScheduledForDeletion) {
                $this->spyRefundsScheduledForDeletion = clone $this->collSpyRefunds;
                $this->spyRefundsScheduledForDeletion->clear();
            }
            $this->spyRefundsScheduledForDeletion[]= clone $spyRefund;
            $spyRefund->setSpySalesOrder(null);
        }

        return $this;
    }

    /**
     * Clears out the collItems collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addItems()
     */
    public function clearItems()
    {
        $this->collItems = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collItems collection loaded partially.
     *
     * @return void
     */
    public function resetPartialItems($v = true): void
    {
        $this->collItemsPartial = $v;
    }

    /**
     * Initializes the collItems collection.
     *
     * By default this just sets the collItems collection to an empty array (like clearcollItems());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initItems(bool $overrideExisting = true): void
    {
        if (null !== $this->collItems && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySalesOrderItemTableMap::getTableMap()->getCollectionClassName();

        $this->collItems = new $collectionClassName;
        $this->collItems->setModel('\Orm\Zed\Sales\Persistence\SpySalesOrderItem');
    }

    /**
     * Gets an array of ChildSpySalesOrderItem objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySalesOrder is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpySalesOrderItem[] List of ChildSpySalesOrderItem objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySalesOrderItem> List of ChildSpySalesOrderItem objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getItems(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collItemsPartial && !$this->isNew();
        if (null === $this->collItems || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collItems) {
                    $this->initItems();
                } else {
                    $collectionClassName = SpySalesOrderItemTableMap::getTableMap()->getCollectionClassName();

                    $collItems = new $collectionClassName;
                    $collItems->setModel('\Orm\Zed\Sales\Persistence\SpySalesOrderItem');

                    return $collItems;
                }
            } else {
                $collItems = ChildSpySalesOrderItemQuery::create(null, $criteria)
                    ->filterByOrder($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collItemsPartial && count($collItems)) {
                        $this->initItems(false);

                        foreach ($collItems as $obj) {
                            if (false == $this->collItems->contains($obj)) {
                                $this->collItems->append($obj);
                            }
                        }

                        $this->collItemsPartial = true;
                    }

                    return $collItems;
                }

                if ($partial && $this->collItems) {
                    foreach ($this->collItems as $obj) {
                        if ($obj->isNew()) {
                            $collItems[] = $obj;
                        }
                    }
                }

                $this->collItems = $collItems;
                $this->collItemsPartial = false;
            }
        }

        return $this->collItems;
    }

    /**
     * Sets a collection of ChildSpySalesOrderItem objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $items A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setItems(Collection $items, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpySalesOrderItem[] $itemsToDelete */
        $itemsToDelete = $this->getItems(new Criteria(), $con)->diff($items);


        $this->itemsScheduledForDeletion = $itemsToDelete;

        foreach ($itemsToDelete as $itemRemoved) {
            $itemRemoved->setOrder(null);
        }

        $this->collItems = null;
        foreach ($items as $item) {
            $this->addItem($item);
        }

        $this->collItems = $items;
        $this->collItemsPartial = false;

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
    public function countItems(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collItemsPartial && !$this->isNew();
        if (null === $this->collItems || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collItems) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getItems());
            }

            $query = ChildSpySalesOrderItemQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrder($this)
                ->count($con);
        }

        return count($this->collItems);
    }

    /**
     * Method called to associate a ChildSpySalesOrderItem object to this object
     * through the ChildSpySalesOrderItem foreign key attribute.
     *
     * @param ChildSpySalesOrderItem $l ChildSpySalesOrderItem
     * @return $this The current object (for fluent API support)
     */
    public function addItem(ChildSpySalesOrderItem $l)
    {
        if ($this->collItems === null) {
            $this->initItems();
            $this->collItemsPartial = true;
        }

        if (!$this->collItems->contains($l)) {
            $this->doAddItem($l);

            if ($this->itemsScheduledForDeletion and $this->itemsScheduledForDeletion->contains($l)) {
                $this->itemsScheduledForDeletion->remove($this->itemsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpySalesOrderItem $item The ChildSpySalesOrderItem object to add.
     */
    protected function doAddItem(ChildSpySalesOrderItem $item): void
    {
        $this->collItems[]= $item;
        $item->setOrder($this);
    }

    /**
     * @param ChildSpySalesOrderItem $item The ChildSpySalesOrderItem object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeItem(ChildSpySalesOrderItem $item)
    {
        if ($this->getItems()->contains($item)) {
            $pos = $this->collItems->search($item);
            $this->collItems->remove($pos);
            if (null === $this->itemsScheduledForDeletion) {
                $this->itemsScheduledForDeletion = clone $this->collItems;
                $this->itemsScheduledForDeletion->clear();
            }
            $this->itemsScheduledForDeletion[]= clone $item;
            $item->setOrder(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySalesOrder is new, it will return
     * an empty collection; or if this SpySalesOrder has previously
     * been saved, it will retrieve related Items from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySalesOrder.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpySalesOrderItem[] List of ChildSpySalesOrderItem objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySalesOrderItem}> List of ChildSpySalesOrderItem objects
     */
    public function getItemsJoinSalesOrderItemBundle(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpySalesOrderItemQuery::create(null, $criteria);
        $query->joinWith('SalesOrderItemBundle', $joinBehavior);

        return $this->getItems($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySalesOrder is new, it will return
     * an empty collection; or if this SpySalesOrder has previously
     * been saved, it will retrieve related Items from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySalesOrder.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpySalesOrderItem[] List of ChildSpySalesOrderItem objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySalesOrderItem}> List of ChildSpySalesOrderItem objects
     */
    public function getItemsJoinState(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpySalesOrderItemQuery::create(null, $criteria);
        $query->joinWith('State', $joinBehavior);

        return $this->getItems($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySalesOrder is new, it will return
     * an empty collection; or if this SpySalesOrder has previously
     * been saved, it will retrieve related Items from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySalesOrder.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpySalesOrderItem[] List of ChildSpySalesOrderItem objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySalesOrderItem}> List of ChildSpySalesOrderItem objects
     */
    public function getItemsJoinProcess(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpySalesOrderItemQuery::create(null, $criteria);
        $query->joinWith('Process', $joinBehavior);

        return $this->getItems($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySalesOrder is new, it will return
     * an empty collection; or if this SpySalesOrder has previously
     * been saved, it will retrieve related Items from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySalesOrder.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpySalesOrderItem[] List of ChildSpySalesOrderItem objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySalesOrderItem}> List of ChildSpySalesOrderItem objects
     */
    public function getItemsJoinSpySalesShipment(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpySalesOrderItemQuery::create(null, $criteria);
        $query->joinWith('SpySalesShipment', $joinBehavior);

        return $this->getItems($query, $con);
    }

    /**
     * Clears out the collDiscounts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addDiscounts()
     */
    public function clearDiscounts()
    {
        $this->collDiscounts = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collDiscounts collection loaded partially.
     *
     * @return void
     */
    public function resetPartialDiscounts($v = true): void
    {
        $this->collDiscountsPartial = $v;
    }

    /**
     * Initializes the collDiscounts collection.
     *
     * By default this just sets the collDiscounts collection to an empty array (like clearcollDiscounts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDiscounts(bool $overrideExisting = true): void
    {
        if (null !== $this->collDiscounts && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySalesDiscountTableMap::getTableMap()->getCollectionClassName();

        $this->collDiscounts = new $collectionClassName;
        $this->collDiscounts->setModel('\Orm\Zed\Sales\Persistence\SpySalesDiscount');
    }

    /**
     * Gets an array of ChildSpySalesDiscount objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySalesOrder is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpySalesDiscount[] List of ChildSpySalesDiscount objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySalesDiscount> List of ChildSpySalesDiscount objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getDiscounts(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collDiscountsPartial && !$this->isNew();
        if (null === $this->collDiscounts || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collDiscounts) {
                    $this->initDiscounts();
                } else {
                    $collectionClassName = SpySalesDiscountTableMap::getTableMap()->getCollectionClassName();

                    $collDiscounts = new $collectionClassName;
                    $collDiscounts->setModel('\Orm\Zed\Sales\Persistence\SpySalesDiscount');

                    return $collDiscounts;
                }
            } else {
                $collDiscounts = ChildSpySalesDiscountQuery::create(null, $criteria)
                    ->filterByOrder($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collDiscountsPartial && count($collDiscounts)) {
                        $this->initDiscounts(false);

                        foreach ($collDiscounts as $obj) {
                            if (false == $this->collDiscounts->contains($obj)) {
                                $this->collDiscounts->append($obj);
                            }
                        }

                        $this->collDiscountsPartial = true;
                    }

                    return $collDiscounts;
                }

                if ($partial && $this->collDiscounts) {
                    foreach ($this->collDiscounts as $obj) {
                        if ($obj->isNew()) {
                            $collDiscounts[] = $obj;
                        }
                    }
                }

                $this->collDiscounts = $collDiscounts;
                $this->collDiscountsPartial = false;
            }
        }

        return $this->collDiscounts;
    }

    /**
     * Sets a collection of ChildSpySalesDiscount objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $discounts A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setDiscounts(Collection $discounts, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpySalesDiscount[] $discountsToDelete */
        $discountsToDelete = $this->getDiscounts(new Criteria(), $con)->diff($discounts);


        $this->discountsScheduledForDeletion = $discountsToDelete;

        foreach ($discountsToDelete as $discountRemoved) {
            $discountRemoved->setOrder(null);
        }

        $this->collDiscounts = null;
        foreach ($discounts as $discount) {
            $this->addDiscount($discount);
        }

        $this->collDiscounts = $discounts;
        $this->collDiscountsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpySalesDiscount objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpySalesDiscount objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countDiscounts(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collDiscountsPartial && !$this->isNew();
        if (null === $this->collDiscounts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDiscounts) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getDiscounts());
            }

            $query = ChildSpySalesDiscountQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrder($this)
                ->count($con);
        }

        return count($this->collDiscounts);
    }

    /**
     * Method called to associate a ChildSpySalesDiscount object to this object
     * through the ChildSpySalesDiscount foreign key attribute.
     *
     * @param ChildSpySalesDiscount $l ChildSpySalesDiscount
     * @return $this The current object (for fluent API support)
     */
    public function addDiscount(ChildSpySalesDiscount $l)
    {
        if ($this->collDiscounts === null) {
            $this->initDiscounts();
            $this->collDiscountsPartial = true;
        }

        if (!$this->collDiscounts->contains($l)) {
            $this->doAddDiscount($l);

            if ($this->discountsScheduledForDeletion and $this->discountsScheduledForDeletion->contains($l)) {
                $this->discountsScheduledForDeletion->remove($this->discountsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpySalesDiscount $discount The ChildSpySalesDiscount object to add.
     */
    protected function doAddDiscount(ChildSpySalesDiscount $discount): void
    {
        $this->collDiscounts[]= $discount;
        $discount->setOrder($this);
    }

    /**
     * @param ChildSpySalesDiscount $discount The ChildSpySalesDiscount object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeDiscount(ChildSpySalesDiscount $discount)
    {
        if ($this->getDiscounts()->contains($discount)) {
            $pos = $this->collDiscounts->search($discount);
            $this->collDiscounts->remove($pos);
            if (null === $this->discountsScheduledForDeletion) {
                $this->discountsScheduledForDeletion = clone $this->collDiscounts;
                $this->discountsScheduledForDeletion->clear();
            }
            $this->discountsScheduledForDeletion[]= $discount;
            $discount->setOrder(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySalesOrder is new, it will return
     * an empty collection; or if this SpySalesOrder has previously
     * been saved, it will retrieve related Discounts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySalesOrder.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpySalesDiscount[] List of ChildSpySalesDiscount objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySalesDiscount}> List of ChildSpySalesDiscount objects
     */
    public function getDiscountsJoinOrderItem(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpySalesDiscountQuery::create(null, $criteria);
        $query->joinWith('OrderItem', $joinBehavior);

        return $this->getDiscounts($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySalesOrder is new, it will return
     * an empty collection; or if this SpySalesOrder has previously
     * been saved, it will retrieve related Discounts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySalesOrder.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpySalesDiscount[] List of ChildSpySalesDiscount objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySalesDiscount}> List of ChildSpySalesDiscount objects
     */
    public function getDiscountsJoinExpense(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpySalesDiscountQuery::create(null, $criteria);
        $query->joinWith('Expense', $joinBehavior);

        return $this->getDiscounts($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySalesOrder is new, it will return
     * an empty collection; or if this SpySalesOrder has previously
     * been saved, it will retrieve related Discounts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySalesOrder.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpySalesDiscount[] List of ChildSpySalesDiscount objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySalesDiscount}> List of ChildSpySalesDiscount objects
     */
    public function getDiscountsJoinOption(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpySalesDiscountQuery::create(null, $criteria);
        $query->joinWith('Option', $joinBehavior);

        return $this->getDiscounts($query, $con);
    }

    /**
     * Clears out the collExpenses collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addExpenses()
     */
    public function clearExpenses()
    {
        $this->collExpenses = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collExpenses collection loaded partially.
     *
     * @return void
     */
    public function resetPartialExpenses($v = true): void
    {
        $this->collExpensesPartial = $v;
    }

    /**
     * Initializes the collExpenses collection.
     *
     * By default this just sets the collExpenses collection to an empty array (like clearcollExpenses());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initExpenses(bool $overrideExisting = true): void
    {
        if (null !== $this->collExpenses && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySalesExpenseTableMap::getTableMap()->getCollectionClassName();

        $this->collExpenses = new $collectionClassName;
        $this->collExpenses->setModel('\Orm\Zed\Sales\Persistence\SpySalesExpense');
    }

    /**
     * Gets an array of ChildSpySalesExpense objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySalesOrder is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpySalesExpense[] List of ChildSpySalesExpense objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySalesExpense> List of ChildSpySalesExpense objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getExpenses(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collExpensesPartial && !$this->isNew();
        if (null === $this->collExpenses || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collExpenses) {
                    $this->initExpenses();
                } else {
                    $collectionClassName = SpySalesExpenseTableMap::getTableMap()->getCollectionClassName();

                    $collExpenses = new $collectionClassName;
                    $collExpenses->setModel('\Orm\Zed\Sales\Persistence\SpySalesExpense');

                    return $collExpenses;
                }
            } else {
                $collExpenses = ChildSpySalesExpenseQuery::create(null, $criteria)
                    ->filterByOrder($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collExpensesPartial && count($collExpenses)) {
                        $this->initExpenses(false);

                        foreach ($collExpenses as $obj) {
                            if (false == $this->collExpenses->contains($obj)) {
                                $this->collExpenses->append($obj);
                            }
                        }

                        $this->collExpensesPartial = true;
                    }

                    return $collExpenses;
                }

                if ($partial && $this->collExpenses) {
                    foreach ($this->collExpenses as $obj) {
                        if ($obj->isNew()) {
                            $collExpenses[] = $obj;
                        }
                    }
                }

                $this->collExpenses = $collExpenses;
                $this->collExpensesPartial = false;
            }
        }

        return $this->collExpenses;
    }

    /**
     * Sets a collection of ChildSpySalesExpense objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $expenses A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setExpenses(Collection $expenses, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpySalesExpense[] $expensesToDelete */
        $expensesToDelete = $this->getExpenses(new Criteria(), $con)->diff($expenses);


        $this->expensesScheduledForDeletion = $expensesToDelete;

        foreach ($expensesToDelete as $expenseRemoved) {
            $expenseRemoved->setOrder(null);
        }

        $this->collExpenses = null;
        foreach ($expenses as $expense) {
            $this->addExpense($expense);
        }

        $this->collExpenses = $expenses;
        $this->collExpensesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpySalesExpense objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpySalesExpense objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countExpenses(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collExpensesPartial && !$this->isNew();
        if (null === $this->collExpenses || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collExpenses) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getExpenses());
            }

            $query = ChildSpySalesExpenseQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrder($this)
                ->count($con);
        }

        return count($this->collExpenses);
    }

    /**
     * Method called to associate a ChildSpySalesExpense object to this object
     * through the ChildSpySalesExpense foreign key attribute.
     *
     * @param ChildSpySalesExpense $l ChildSpySalesExpense
     * @return $this The current object (for fluent API support)
     */
    public function addExpense(ChildSpySalesExpense $l)
    {
        if ($this->collExpenses === null) {
            $this->initExpenses();
            $this->collExpensesPartial = true;
        }

        if (!$this->collExpenses->contains($l)) {
            $this->doAddExpense($l);

            if ($this->expensesScheduledForDeletion and $this->expensesScheduledForDeletion->contains($l)) {
                $this->expensesScheduledForDeletion->remove($this->expensesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpySalesExpense $expense The ChildSpySalesExpense object to add.
     */
    protected function doAddExpense(ChildSpySalesExpense $expense): void
    {
        $this->collExpenses[]= $expense;
        $expense->setOrder($this);
    }

    /**
     * @param ChildSpySalesExpense $expense The ChildSpySalesExpense object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeExpense(ChildSpySalesExpense $expense)
    {
        if ($this->getExpenses()->contains($expense)) {
            $pos = $this->collExpenses->search($expense);
            $this->collExpenses->remove($pos);
            if (null === $this->expensesScheduledForDeletion) {
                $this->expensesScheduledForDeletion = clone $this->collExpenses;
                $this->expensesScheduledForDeletion->clear();
            }
            $this->expensesScheduledForDeletion[]= $expense;
            $expense->setOrder(null);
        }

        return $this;
    }

    /**
     * Clears out the collSpySalesShipments collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpySalesShipments()
     */
    public function clearSpySalesShipments()
    {
        $this->collSpySalesShipments = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpySalesShipments collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpySalesShipments($v = true): void
    {
        $this->collSpySalesShipmentsPartial = $v;
    }

    /**
     * Initializes the collSpySalesShipments collection.
     *
     * By default this just sets the collSpySalesShipments collection to an empty array (like clearcollSpySalesShipments());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpySalesShipments(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpySalesShipments && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySalesShipmentTableMap::getTableMap()->getCollectionClassName();

        $this->collSpySalesShipments = new $collectionClassName;
        $this->collSpySalesShipments->setModel('\Orm\Zed\Sales\Persistence\SpySalesShipment');
    }

    /**
     * Gets an array of ChildSpySalesShipment objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySalesOrder is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpySalesShipment[] List of ChildSpySalesShipment objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySalesShipment> List of ChildSpySalesShipment objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpySalesShipments(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpySalesShipmentsPartial && !$this->isNew();
        if (null === $this->collSpySalesShipments || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpySalesShipments) {
                    $this->initSpySalesShipments();
                } else {
                    $collectionClassName = SpySalesShipmentTableMap::getTableMap()->getCollectionClassName();

                    $collSpySalesShipments = new $collectionClassName;
                    $collSpySalesShipments->setModel('\Orm\Zed\Sales\Persistence\SpySalesShipment');

                    return $collSpySalesShipments;
                }
            } else {
                $collSpySalesShipments = ChildSpySalesShipmentQuery::create(null, $criteria)
                    ->filterByOrder($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpySalesShipmentsPartial && count($collSpySalesShipments)) {
                        $this->initSpySalesShipments(false);

                        foreach ($collSpySalesShipments as $obj) {
                            if (false == $this->collSpySalesShipments->contains($obj)) {
                                $this->collSpySalesShipments->append($obj);
                            }
                        }

                        $this->collSpySalesShipmentsPartial = true;
                    }

                    return $collSpySalesShipments;
                }

                if ($partial && $this->collSpySalesShipments) {
                    foreach ($this->collSpySalesShipments as $obj) {
                        if ($obj->isNew()) {
                            $collSpySalesShipments[] = $obj;
                        }
                    }
                }

                $this->collSpySalesShipments = $collSpySalesShipments;
                $this->collSpySalesShipmentsPartial = false;
            }
        }

        return $this->collSpySalesShipments;
    }

    /**
     * Sets a collection of ChildSpySalesShipment objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spySalesShipments A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpySalesShipments(Collection $spySalesShipments, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpySalesShipment[] $spySalesShipmentsToDelete */
        $spySalesShipmentsToDelete = $this->getSpySalesShipments(new Criteria(), $con)->diff($spySalesShipments);


        $this->spySalesShipmentsScheduledForDeletion = $spySalesShipmentsToDelete;

        foreach ($spySalesShipmentsToDelete as $spySalesShipmentRemoved) {
            $spySalesShipmentRemoved->setOrder(null);
        }

        $this->collSpySalesShipments = null;
        foreach ($spySalesShipments as $spySalesShipment) {
            $this->addSpySalesShipment($spySalesShipment);
        }

        $this->collSpySalesShipments = $spySalesShipments;
        $this->collSpySalesShipmentsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpySalesShipment objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpySalesShipment objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpySalesShipments(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpySalesShipmentsPartial && !$this->isNew();
        if (null === $this->collSpySalesShipments || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpySalesShipments) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpySalesShipments());
            }

            $query = ChildSpySalesShipmentQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrder($this)
                ->count($con);
        }

        return count($this->collSpySalesShipments);
    }

    /**
     * Method called to associate a ChildSpySalesShipment object to this object
     * through the ChildSpySalesShipment foreign key attribute.
     *
     * @param ChildSpySalesShipment $l ChildSpySalesShipment
     * @return $this The current object (for fluent API support)
     */
    public function addSpySalesShipment(ChildSpySalesShipment $l)
    {
        if ($this->collSpySalesShipments === null) {
            $this->initSpySalesShipments();
            $this->collSpySalesShipmentsPartial = true;
        }

        if (!$this->collSpySalesShipments->contains($l)) {
            $this->doAddSpySalesShipment($l);

            if ($this->spySalesShipmentsScheduledForDeletion and $this->spySalesShipmentsScheduledForDeletion->contains($l)) {
                $this->spySalesShipmentsScheduledForDeletion->remove($this->spySalesShipmentsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpySalesShipment $spySalesShipment The ChildSpySalesShipment object to add.
     */
    protected function doAddSpySalesShipment(ChildSpySalesShipment $spySalesShipment): void
    {
        $this->collSpySalesShipments[]= $spySalesShipment;
        $spySalesShipment->setOrder($this);
    }

    /**
     * @param ChildSpySalesShipment $spySalesShipment The ChildSpySalesShipment object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpySalesShipment(ChildSpySalesShipment $spySalesShipment)
    {
        if ($this->getSpySalesShipments()->contains($spySalesShipment)) {
            $pos = $this->collSpySalesShipments->search($spySalesShipment);
            $this->collSpySalesShipments->remove($pos);
            if (null === $this->spySalesShipmentsScheduledForDeletion) {
                $this->spySalesShipmentsScheduledForDeletion = clone $this->collSpySalesShipments;
                $this->spySalesShipmentsScheduledForDeletion->clear();
            }
            $this->spySalesShipmentsScheduledForDeletion[]= clone $spySalesShipment;
            $spySalesShipment->setOrder(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySalesOrder is new, it will return
     * an empty collection; or if this SpySalesOrder has previously
     * been saved, it will retrieve related SpySalesShipments from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySalesOrder.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpySalesShipment[] List of ChildSpySalesShipment objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySalesShipment}> List of ChildSpySalesShipment objects
     */
    public function getSpySalesShipmentsJoinSalesShipmentType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpySalesShipmentQuery::create(null, $criteria);
        $query->joinWith('SalesShipmentType', $joinBehavior);

        return $this->getSpySalesShipments($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySalesOrder is new, it will return
     * an empty collection; or if this SpySalesOrder has previously
     * been saved, it will retrieve related SpySalesShipments from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySalesOrder.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpySalesShipment[] List of ChildSpySalesShipment objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySalesShipment}> List of ChildSpySalesShipment objects
     */
    public function getSpySalesShipmentsJoinExpense(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpySalesShipmentQuery::create(null, $criteria);
        $query->joinWith('Expense', $joinBehavior);

        return $this->getSpySalesShipments($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySalesOrder is new, it will return
     * an empty collection; or if this SpySalesOrder has previously
     * been saved, it will retrieve related SpySalesShipments from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySalesOrder.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpySalesShipment[] List of ChildSpySalesShipment objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySalesShipment}> List of ChildSpySalesShipment objects
     */
    public function getSpySalesShipmentsJoinSpySalesOrderAddress(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpySalesShipmentQuery::create(null, $criteria);
        $query->joinWith('SpySalesOrderAddress', $joinBehavior);

        return $this->getSpySalesShipments($query, $con);
    }

    /**
     * Clears out the collOrderTotals collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOrderTotals()
     */
    public function clearOrderTotals()
    {
        $this->collOrderTotals = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOrderTotals collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOrderTotals($v = true): void
    {
        $this->collOrderTotalsPartial = $v;
    }

    /**
     * Initializes the collOrderTotals collection.
     *
     * By default this just sets the collOrderTotals collection to an empty array (like clearcollOrderTotals());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOrderTotals(bool $overrideExisting = true): void
    {
        if (null !== $this->collOrderTotals && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySalesOrderTotalsTableMap::getTableMap()->getCollectionClassName();

        $this->collOrderTotals = new $collectionClassName;
        $this->collOrderTotals->setModel('\Orm\Zed\Sales\Persistence\SpySalesOrderTotals');
    }

    /**
     * Gets an array of ChildSpySalesOrderTotals objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySalesOrder is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpySalesOrderTotals[] List of ChildSpySalesOrderTotals objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySalesOrderTotals> List of ChildSpySalesOrderTotals objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOrderTotals(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOrderTotalsPartial && !$this->isNew();
        if (null === $this->collOrderTotals || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOrderTotals) {
                    $this->initOrderTotals();
                } else {
                    $collectionClassName = SpySalesOrderTotalsTableMap::getTableMap()->getCollectionClassName();

                    $collOrderTotals = new $collectionClassName;
                    $collOrderTotals->setModel('\Orm\Zed\Sales\Persistence\SpySalesOrderTotals');

                    return $collOrderTotals;
                }
            } else {
                $collOrderTotals = ChildSpySalesOrderTotalsQuery::create(null, $criteria)
                    ->filterByOrder($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOrderTotalsPartial && count($collOrderTotals)) {
                        $this->initOrderTotals(false);

                        foreach ($collOrderTotals as $obj) {
                            if (false == $this->collOrderTotals->contains($obj)) {
                                $this->collOrderTotals->append($obj);
                            }
                        }

                        $this->collOrderTotalsPartial = true;
                    }

                    return $collOrderTotals;
                }

                if ($partial && $this->collOrderTotals) {
                    foreach ($this->collOrderTotals as $obj) {
                        if ($obj->isNew()) {
                            $collOrderTotals[] = $obj;
                        }
                    }
                }

                $this->collOrderTotals = $collOrderTotals;
                $this->collOrderTotalsPartial = false;
            }
        }

        return $this->collOrderTotals;
    }

    /**
     * Sets a collection of ChildSpySalesOrderTotals objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $orderTotals A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOrderTotals(Collection $orderTotals, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpySalesOrderTotals[] $orderTotalsToDelete */
        $orderTotalsToDelete = $this->getOrderTotals(new Criteria(), $con)->diff($orderTotals);


        $this->orderTotalsScheduledForDeletion = $orderTotalsToDelete;

        foreach ($orderTotalsToDelete as $orderTotalRemoved) {
            $orderTotalRemoved->setOrder(null);
        }

        $this->collOrderTotals = null;
        foreach ($orderTotals as $orderTotal) {
            $this->addOrderTotal($orderTotal);
        }

        $this->collOrderTotals = $orderTotals;
        $this->collOrderTotalsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpySalesOrderTotals objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpySalesOrderTotals objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOrderTotals(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOrderTotalsPartial && !$this->isNew();
        if (null === $this->collOrderTotals || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOrderTotals) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOrderTotals());
            }

            $query = ChildSpySalesOrderTotalsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrder($this)
                ->count($con);
        }

        return count($this->collOrderTotals);
    }

    /**
     * Method called to associate a ChildSpySalesOrderTotals object to this object
     * through the ChildSpySalesOrderTotals foreign key attribute.
     *
     * @param ChildSpySalesOrderTotals $l ChildSpySalesOrderTotals
     * @return $this The current object (for fluent API support)
     */
    public function addOrderTotal(ChildSpySalesOrderTotals $l)
    {
        if ($this->collOrderTotals === null) {
            $this->initOrderTotals();
            $this->collOrderTotalsPartial = true;
        }

        if (!$this->collOrderTotals->contains($l)) {
            $this->doAddOrderTotal($l);

            if ($this->orderTotalsScheduledForDeletion and $this->orderTotalsScheduledForDeletion->contains($l)) {
                $this->orderTotalsScheduledForDeletion->remove($this->orderTotalsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpySalesOrderTotals $orderTotal The ChildSpySalesOrderTotals object to add.
     */
    protected function doAddOrderTotal(ChildSpySalesOrderTotals $orderTotal): void
    {
        $this->collOrderTotals[]= $orderTotal;
        $orderTotal->setOrder($this);
    }

    /**
     * @param ChildSpySalesOrderTotals $orderTotal The ChildSpySalesOrderTotals object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOrderTotal(ChildSpySalesOrderTotals $orderTotal)
    {
        if ($this->getOrderTotals()->contains($orderTotal)) {
            $pos = $this->collOrderTotals->search($orderTotal);
            $this->collOrderTotals->remove($pos);
            if (null === $this->orderTotalsScheduledForDeletion) {
                $this->orderTotalsScheduledForDeletion = clone $this->collOrderTotals;
                $this->orderTotalsScheduledForDeletion->clear();
            }
            $this->orderTotalsScheduledForDeletion[]= clone $orderTotal;
            $orderTotal->setOrder(null);
        }

        return $this;
    }

    /**
     * Clears out the collNotes collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addNotes()
     */
    public function clearNotes()
    {
        $this->collNotes = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collNotes collection loaded partially.
     *
     * @return void
     */
    public function resetPartialNotes($v = true): void
    {
        $this->collNotesPartial = $v;
    }

    /**
     * Initializes the collNotes collection.
     *
     * By default this just sets the collNotes collection to an empty array (like clearcollNotes());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initNotes(bool $overrideExisting = true): void
    {
        if (null !== $this->collNotes && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySalesOrderNoteTableMap::getTableMap()->getCollectionClassName();

        $this->collNotes = new $collectionClassName;
        $this->collNotes->setModel('\Orm\Zed\Sales\Persistence\SpySalesOrderNote');
    }

    /**
     * Gets an array of ChildSpySalesOrderNote objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySalesOrder is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpySalesOrderNote[] List of ChildSpySalesOrderNote objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySalesOrderNote> List of ChildSpySalesOrderNote objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getNotes(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collNotesPartial && !$this->isNew();
        if (null === $this->collNotes || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collNotes) {
                    $this->initNotes();
                } else {
                    $collectionClassName = SpySalesOrderNoteTableMap::getTableMap()->getCollectionClassName();

                    $collNotes = new $collectionClassName;
                    $collNotes->setModel('\Orm\Zed\Sales\Persistence\SpySalesOrderNote');

                    return $collNotes;
                }
            } else {
                $collNotes = ChildSpySalesOrderNoteQuery::create(null, $criteria)
                    ->filterByOrder($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collNotesPartial && count($collNotes)) {
                        $this->initNotes(false);

                        foreach ($collNotes as $obj) {
                            if (false == $this->collNotes->contains($obj)) {
                                $this->collNotes->append($obj);
                            }
                        }

                        $this->collNotesPartial = true;
                    }

                    return $collNotes;
                }

                if ($partial && $this->collNotes) {
                    foreach ($this->collNotes as $obj) {
                        if ($obj->isNew()) {
                            $collNotes[] = $obj;
                        }
                    }
                }

                $this->collNotes = $collNotes;
                $this->collNotesPartial = false;
            }
        }

        return $this->collNotes;
    }

    /**
     * Sets a collection of ChildSpySalesOrderNote objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $notes A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setNotes(Collection $notes, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpySalesOrderNote[] $notesToDelete */
        $notesToDelete = $this->getNotes(new Criteria(), $con)->diff($notes);


        $this->notesScheduledForDeletion = $notesToDelete;

        foreach ($notesToDelete as $noteRemoved) {
            $noteRemoved->setOrder(null);
        }

        $this->collNotes = null;
        foreach ($notes as $note) {
            $this->addNote($note);
        }

        $this->collNotes = $notes;
        $this->collNotesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpySalesOrderNote objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpySalesOrderNote objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countNotes(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collNotesPartial && !$this->isNew();
        if (null === $this->collNotes || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collNotes) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getNotes());
            }

            $query = ChildSpySalesOrderNoteQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrder($this)
                ->count($con);
        }

        return count($this->collNotes);
    }

    /**
     * Method called to associate a ChildSpySalesOrderNote object to this object
     * through the ChildSpySalesOrderNote foreign key attribute.
     *
     * @param ChildSpySalesOrderNote $l ChildSpySalesOrderNote
     * @return $this The current object (for fluent API support)
     */
    public function addNote(ChildSpySalesOrderNote $l)
    {
        if ($this->collNotes === null) {
            $this->initNotes();
            $this->collNotesPartial = true;
        }

        if (!$this->collNotes->contains($l)) {
            $this->doAddNote($l);

            if ($this->notesScheduledForDeletion and $this->notesScheduledForDeletion->contains($l)) {
                $this->notesScheduledForDeletion->remove($this->notesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpySalesOrderNote $note The ChildSpySalesOrderNote object to add.
     */
    protected function doAddNote(ChildSpySalesOrderNote $note): void
    {
        $this->collNotes[]= $note;
        $note->setOrder($this);
    }

    /**
     * @param ChildSpySalesOrderNote $note The ChildSpySalesOrderNote object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeNote(ChildSpySalesOrderNote $note)
    {
        if ($this->getNotes()->contains($note)) {
            $pos = $this->collNotes->search($note);
            $this->collNotes->remove($pos);
            if (null === $this->notesScheduledForDeletion) {
                $this->notesScheduledForDeletion = clone $this->collNotes;
                $this->notesScheduledForDeletion->clear();
            }
            $this->notesScheduledForDeletion[]= clone $note;
            $note->setOrder(null);
        }

        return $this;
    }

    /**
     * Clears out the collOrderComments collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOrderComments()
     */
    public function clearOrderComments()
    {
        $this->collOrderComments = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOrderComments collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOrderComments($v = true): void
    {
        $this->collOrderCommentsPartial = $v;
    }

    /**
     * Initializes the collOrderComments collection.
     *
     * By default this just sets the collOrderComments collection to an empty array (like clearcollOrderComments());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOrderComments(bool $overrideExisting = true): void
    {
        if (null !== $this->collOrderComments && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySalesOrderCommentTableMap::getTableMap()->getCollectionClassName();

        $this->collOrderComments = new $collectionClassName;
        $this->collOrderComments->setModel('\Orm\Zed\Sales\Persistence\SpySalesOrderComment');
    }

    /**
     * Gets an array of ChildSpySalesOrderComment objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySalesOrder is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpySalesOrderComment[] List of ChildSpySalesOrderComment objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySalesOrderComment> List of ChildSpySalesOrderComment objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOrderComments(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOrderCommentsPartial && !$this->isNew();
        if (null === $this->collOrderComments || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOrderComments) {
                    $this->initOrderComments();
                } else {
                    $collectionClassName = SpySalesOrderCommentTableMap::getTableMap()->getCollectionClassName();

                    $collOrderComments = new $collectionClassName;
                    $collOrderComments->setModel('\Orm\Zed\Sales\Persistence\SpySalesOrderComment');

                    return $collOrderComments;
                }
            } else {
                $collOrderComments = ChildSpySalesOrderCommentQuery::create(null, $criteria)
                    ->filterByOrder($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOrderCommentsPartial && count($collOrderComments)) {
                        $this->initOrderComments(false);

                        foreach ($collOrderComments as $obj) {
                            if (false == $this->collOrderComments->contains($obj)) {
                                $this->collOrderComments->append($obj);
                            }
                        }

                        $this->collOrderCommentsPartial = true;
                    }

                    return $collOrderComments;
                }

                if ($partial && $this->collOrderComments) {
                    foreach ($this->collOrderComments as $obj) {
                        if ($obj->isNew()) {
                            $collOrderComments[] = $obj;
                        }
                    }
                }

                $this->collOrderComments = $collOrderComments;
                $this->collOrderCommentsPartial = false;
            }
        }

        return $this->collOrderComments;
    }

    /**
     * Sets a collection of ChildSpySalesOrderComment objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $orderComments A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOrderComments(Collection $orderComments, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpySalesOrderComment[] $orderCommentsToDelete */
        $orderCommentsToDelete = $this->getOrderComments(new Criteria(), $con)->diff($orderComments);


        $this->orderCommentsScheduledForDeletion = $orderCommentsToDelete;

        foreach ($orderCommentsToDelete as $orderCommentRemoved) {
            $orderCommentRemoved->setOrder(null);
        }

        $this->collOrderComments = null;
        foreach ($orderComments as $orderComment) {
            $this->addOrderComment($orderComment);
        }

        $this->collOrderComments = $orderComments;
        $this->collOrderCommentsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpySalesOrderComment objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpySalesOrderComment objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOrderComments(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOrderCommentsPartial && !$this->isNew();
        if (null === $this->collOrderComments || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOrderComments) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOrderComments());
            }

            $query = ChildSpySalesOrderCommentQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrder($this)
                ->count($con);
        }

        return count($this->collOrderComments);
    }

    /**
     * Method called to associate a ChildSpySalesOrderComment object to this object
     * through the ChildSpySalesOrderComment foreign key attribute.
     *
     * @param ChildSpySalesOrderComment $l ChildSpySalesOrderComment
     * @return $this The current object (for fluent API support)
     */
    public function addOrderComment(ChildSpySalesOrderComment $l)
    {
        if ($this->collOrderComments === null) {
            $this->initOrderComments();
            $this->collOrderCommentsPartial = true;
        }

        if (!$this->collOrderComments->contains($l)) {
            $this->doAddOrderComment($l);

            if ($this->orderCommentsScheduledForDeletion and $this->orderCommentsScheduledForDeletion->contains($l)) {
                $this->orderCommentsScheduledForDeletion->remove($this->orderCommentsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpySalesOrderComment $orderComment The ChildSpySalesOrderComment object to add.
     */
    protected function doAddOrderComment(ChildSpySalesOrderComment $orderComment): void
    {
        $this->collOrderComments[]= $orderComment;
        $orderComment->setOrder($this);
    }

    /**
     * @param ChildSpySalesOrderComment $orderComment The ChildSpySalesOrderComment object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOrderComment(ChildSpySalesOrderComment $orderComment)
    {
        if ($this->getOrderComments()->contains($orderComment)) {
            $pos = $this->collOrderComments->search($orderComment);
            $this->collOrderComments->remove($pos);
            if (null === $this->orderCommentsScheduledForDeletion) {
                $this->orderCommentsScheduledForDeletion = clone $this->collOrderComments;
                $this->orderCommentsScheduledForDeletion->clear();
            }
            $this->orderCommentsScheduledForDeletion[]= clone $orderComment;
            $orderComment->setOrder(null);
        }

        return $this;
    }

    /**
     * Clears out the collSpySalesOrderInvoices collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpySalesOrderInvoices()
     */
    public function clearSpySalesOrderInvoices()
    {
        $this->collSpySalesOrderInvoices = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpySalesOrderInvoices collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpySalesOrderInvoices($v = true): void
    {
        $this->collSpySalesOrderInvoicesPartial = $v;
    }

    /**
     * Initializes the collSpySalesOrderInvoices collection.
     *
     * By default this just sets the collSpySalesOrderInvoices collection to an empty array (like clearcollSpySalesOrderInvoices());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpySalesOrderInvoices(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpySalesOrderInvoices && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySalesOrderInvoiceTableMap::getTableMap()->getCollectionClassName();

        $this->collSpySalesOrderInvoices = new $collectionClassName;
        $this->collSpySalesOrderInvoices->setModel('\Orm\Zed\SalesInvoice\Persistence\SpySalesOrderInvoice');
    }

    /**
     * Gets an array of SpySalesOrderInvoice objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySalesOrder is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpySalesOrderInvoice[] List of SpySalesOrderInvoice objects
     * @phpstan-return ObjectCollection&\Traversable<SpySalesOrderInvoice> List of SpySalesOrderInvoice objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpySalesOrderInvoices(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpySalesOrderInvoicesPartial && !$this->isNew();
        if (null === $this->collSpySalesOrderInvoices || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpySalesOrderInvoices) {
                    $this->initSpySalesOrderInvoices();
                } else {
                    $collectionClassName = SpySalesOrderInvoiceTableMap::getTableMap()->getCollectionClassName();

                    $collSpySalesOrderInvoices = new $collectionClassName;
                    $collSpySalesOrderInvoices->setModel('\Orm\Zed\SalesInvoice\Persistence\SpySalesOrderInvoice');

                    return $collSpySalesOrderInvoices;
                }
            } else {
                $collSpySalesOrderInvoices = SpySalesOrderInvoiceQuery::create(null, $criteria)
                    ->filterBySpySalesOrder($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpySalesOrderInvoicesPartial && count($collSpySalesOrderInvoices)) {
                        $this->initSpySalesOrderInvoices(false);

                        foreach ($collSpySalesOrderInvoices as $obj) {
                            if (false == $this->collSpySalesOrderInvoices->contains($obj)) {
                                $this->collSpySalesOrderInvoices->append($obj);
                            }
                        }

                        $this->collSpySalesOrderInvoicesPartial = true;
                    }

                    return $collSpySalesOrderInvoices;
                }

                if ($partial && $this->collSpySalesOrderInvoices) {
                    foreach ($this->collSpySalesOrderInvoices as $obj) {
                        if ($obj->isNew()) {
                            $collSpySalesOrderInvoices[] = $obj;
                        }
                    }
                }

                $this->collSpySalesOrderInvoices = $collSpySalesOrderInvoices;
                $this->collSpySalesOrderInvoicesPartial = false;
            }
        }

        return $this->collSpySalesOrderInvoices;
    }

    /**
     * Sets a collection of SpySalesOrderInvoice objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spySalesOrderInvoices A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpySalesOrderInvoices(Collection $spySalesOrderInvoices, ?ConnectionInterface $con = null)
    {
        /** @var SpySalesOrderInvoice[] $spySalesOrderInvoicesToDelete */
        $spySalesOrderInvoicesToDelete = $this->getSpySalesOrderInvoices(new Criteria(), $con)->diff($spySalesOrderInvoices);


        $this->spySalesOrderInvoicesScheduledForDeletion = $spySalesOrderInvoicesToDelete;

        foreach ($spySalesOrderInvoicesToDelete as $spySalesOrderInvoiceRemoved) {
            $spySalesOrderInvoiceRemoved->setSpySalesOrder(null);
        }

        $this->collSpySalesOrderInvoices = null;
        foreach ($spySalesOrderInvoices as $spySalesOrderInvoice) {
            $this->addSpySalesOrderInvoice($spySalesOrderInvoice);
        }

        $this->collSpySalesOrderInvoices = $spySalesOrderInvoices;
        $this->collSpySalesOrderInvoicesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpySalesOrderInvoice objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpySalesOrderInvoice objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpySalesOrderInvoices(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpySalesOrderInvoicesPartial && !$this->isNew();
        if (null === $this->collSpySalesOrderInvoices || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpySalesOrderInvoices) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpySalesOrderInvoices());
            }

            $query = SpySalesOrderInvoiceQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpySalesOrder($this)
                ->count($con);
        }

        return count($this->collSpySalesOrderInvoices);
    }

    /**
     * Method called to associate a SpySalesOrderInvoice object to this object
     * through the SpySalesOrderInvoice foreign key attribute.
     *
     * @param SpySalesOrderInvoice $l SpySalesOrderInvoice
     * @return $this The current object (for fluent API support)
     */
    public function addSpySalesOrderInvoice(SpySalesOrderInvoice $l)
    {
        if ($this->collSpySalesOrderInvoices === null) {
            $this->initSpySalesOrderInvoices();
            $this->collSpySalesOrderInvoicesPartial = true;
        }

        if (!$this->collSpySalesOrderInvoices->contains($l)) {
            $this->doAddSpySalesOrderInvoice($l);

            if ($this->spySalesOrderInvoicesScheduledForDeletion and $this->spySalesOrderInvoicesScheduledForDeletion->contains($l)) {
                $this->spySalesOrderInvoicesScheduledForDeletion->remove($this->spySalesOrderInvoicesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpySalesOrderInvoice $spySalesOrderInvoice The SpySalesOrderInvoice object to add.
     */
    protected function doAddSpySalesOrderInvoice(SpySalesOrderInvoice $spySalesOrderInvoice): void
    {
        $this->collSpySalesOrderInvoices[]= $spySalesOrderInvoice;
        $spySalesOrderInvoice->setSpySalesOrder($this);
    }

    /**
     * @param SpySalesOrderInvoice $spySalesOrderInvoice The SpySalesOrderInvoice object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpySalesOrderInvoice(SpySalesOrderInvoice $spySalesOrderInvoice)
    {
        if ($this->getSpySalesOrderInvoices()->contains($spySalesOrderInvoice)) {
            $pos = $this->collSpySalesOrderInvoices->search($spySalesOrderInvoice);
            $this->collSpySalesOrderInvoices->remove($pos);
            if (null === $this->spySalesOrderInvoicesScheduledForDeletion) {
                $this->spySalesOrderInvoicesScheduledForDeletion = clone $this->collSpySalesOrderInvoices;
                $this->spySalesOrderInvoicesScheduledForDeletion->clear();
            }
            $this->spySalesOrderInvoicesScheduledForDeletion[]= clone $spySalesOrderInvoice;
            $spySalesOrderInvoice->setSpySalesOrder(null);
        }

        return $this;
    }

    /**
     * Clears out the collSpySalesMerchantCommissions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpySalesMerchantCommissions()
     */
    public function clearSpySalesMerchantCommissions()
    {
        $this->collSpySalesMerchantCommissions = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpySalesMerchantCommissions collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpySalesMerchantCommissions($v = true): void
    {
        $this->collSpySalesMerchantCommissionsPartial = $v;
    }

    /**
     * Initializes the collSpySalesMerchantCommissions collection.
     *
     * By default this just sets the collSpySalesMerchantCommissions collection to an empty array (like clearcollSpySalesMerchantCommissions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpySalesMerchantCommissions(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpySalesMerchantCommissions && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySalesMerchantCommissionTableMap::getTableMap()->getCollectionClassName();

        $this->collSpySalesMerchantCommissions = new $collectionClassName;
        $this->collSpySalesMerchantCommissions->setModel('\Orm\Zed\SalesMerchantCommission\Persistence\SpySalesMerchantCommission');
    }

    /**
     * Gets an array of SpySalesMerchantCommission objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySalesOrder is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpySalesMerchantCommission[] List of SpySalesMerchantCommission objects
     * @phpstan-return ObjectCollection&\Traversable<SpySalesMerchantCommission> List of SpySalesMerchantCommission objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpySalesMerchantCommissions(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpySalesMerchantCommissionsPartial && !$this->isNew();
        if (null === $this->collSpySalesMerchantCommissions || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpySalesMerchantCommissions) {
                    $this->initSpySalesMerchantCommissions();
                } else {
                    $collectionClassName = SpySalesMerchantCommissionTableMap::getTableMap()->getCollectionClassName();

                    $collSpySalesMerchantCommissions = new $collectionClassName;
                    $collSpySalesMerchantCommissions->setModel('\Orm\Zed\SalesMerchantCommission\Persistence\SpySalesMerchantCommission');

                    return $collSpySalesMerchantCommissions;
                }
            } else {
                $collSpySalesMerchantCommissions = SpySalesMerchantCommissionQuery::create(null, $criteria)
                    ->filterBySpySalesOrder($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpySalesMerchantCommissionsPartial && count($collSpySalesMerchantCommissions)) {
                        $this->initSpySalesMerchantCommissions(false);

                        foreach ($collSpySalesMerchantCommissions as $obj) {
                            if (false == $this->collSpySalesMerchantCommissions->contains($obj)) {
                                $this->collSpySalesMerchantCommissions->append($obj);
                            }
                        }

                        $this->collSpySalesMerchantCommissionsPartial = true;
                    }

                    return $collSpySalesMerchantCommissions;
                }

                if ($partial && $this->collSpySalesMerchantCommissions) {
                    foreach ($this->collSpySalesMerchantCommissions as $obj) {
                        if ($obj->isNew()) {
                            $collSpySalesMerchantCommissions[] = $obj;
                        }
                    }
                }

                $this->collSpySalesMerchantCommissions = $collSpySalesMerchantCommissions;
                $this->collSpySalesMerchantCommissionsPartial = false;
            }
        }

        return $this->collSpySalesMerchantCommissions;
    }

    /**
     * Sets a collection of SpySalesMerchantCommission objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spySalesMerchantCommissions A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpySalesMerchantCommissions(Collection $spySalesMerchantCommissions, ?ConnectionInterface $con = null)
    {
        /** @var SpySalesMerchantCommission[] $spySalesMerchantCommissionsToDelete */
        $spySalesMerchantCommissionsToDelete = $this->getSpySalesMerchantCommissions(new Criteria(), $con)->diff($spySalesMerchantCommissions);


        $this->spySalesMerchantCommissionsScheduledForDeletion = $spySalesMerchantCommissionsToDelete;

        foreach ($spySalesMerchantCommissionsToDelete as $spySalesMerchantCommissionRemoved) {
            $spySalesMerchantCommissionRemoved->setSpySalesOrder(null);
        }

        $this->collSpySalesMerchantCommissions = null;
        foreach ($spySalesMerchantCommissions as $spySalesMerchantCommission) {
            $this->addSpySalesMerchantCommission($spySalesMerchantCommission);
        }

        $this->collSpySalesMerchantCommissions = $spySalesMerchantCommissions;
        $this->collSpySalesMerchantCommissionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpySalesMerchantCommission objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpySalesMerchantCommission objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpySalesMerchantCommissions(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpySalesMerchantCommissionsPartial && !$this->isNew();
        if (null === $this->collSpySalesMerchantCommissions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpySalesMerchantCommissions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpySalesMerchantCommissions());
            }

            $query = SpySalesMerchantCommissionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpySalesOrder($this)
                ->count($con);
        }

        return count($this->collSpySalesMerchantCommissions);
    }

    /**
     * Method called to associate a SpySalesMerchantCommission object to this object
     * through the SpySalesMerchantCommission foreign key attribute.
     *
     * @param SpySalesMerchantCommission $l SpySalesMerchantCommission
     * @return $this The current object (for fluent API support)
     */
    public function addSpySalesMerchantCommission(SpySalesMerchantCommission $l)
    {
        if ($this->collSpySalesMerchantCommissions === null) {
            $this->initSpySalesMerchantCommissions();
            $this->collSpySalesMerchantCommissionsPartial = true;
        }

        if (!$this->collSpySalesMerchantCommissions->contains($l)) {
            $this->doAddSpySalesMerchantCommission($l);

            if ($this->spySalesMerchantCommissionsScheduledForDeletion and $this->spySalesMerchantCommissionsScheduledForDeletion->contains($l)) {
                $this->spySalesMerchantCommissionsScheduledForDeletion->remove($this->spySalesMerchantCommissionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpySalesMerchantCommission $spySalesMerchantCommission The SpySalesMerchantCommission object to add.
     */
    protected function doAddSpySalesMerchantCommission(SpySalesMerchantCommission $spySalesMerchantCommission): void
    {
        $this->collSpySalesMerchantCommissions[]= $spySalesMerchantCommission;
        $spySalesMerchantCommission->setSpySalesOrder($this);
    }

    /**
     * @param SpySalesMerchantCommission $spySalesMerchantCommission The SpySalesMerchantCommission object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpySalesMerchantCommission(SpySalesMerchantCommission $spySalesMerchantCommission)
    {
        if ($this->getSpySalesMerchantCommissions()->contains($spySalesMerchantCommission)) {
            $pos = $this->collSpySalesMerchantCommissions->search($spySalesMerchantCommission);
            $this->collSpySalesMerchantCommissions->remove($pos);
            if (null === $this->spySalesMerchantCommissionsScheduledForDeletion) {
                $this->spySalesMerchantCommissionsScheduledForDeletion = clone $this->collSpySalesMerchantCommissions;
                $this->spySalesMerchantCommissionsScheduledForDeletion->clear();
            }
            $this->spySalesMerchantCommissionsScheduledForDeletion[]= clone $spySalesMerchantCommission;
            $spySalesMerchantCommission->setSpySalesOrder(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySalesOrder is new, it will return
     * an empty collection; or if this SpySalesOrder has previously
     * been saved, it will retrieve related SpySalesMerchantCommissions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySalesOrder.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpySalesMerchantCommission[] List of SpySalesMerchantCommission objects
     * @phpstan-return ObjectCollection&\Traversable<SpySalesMerchantCommission}> List of SpySalesMerchantCommission objects
     */
    public function getSpySalesMerchantCommissionsJoinSpySalesOrderItem(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpySalesMerchantCommissionQuery::create(null, $criteria);
        $query->joinWith('SpySalesOrderItem', $joinBehavior);

        return $this->getSpySalesMerchantCommissions($query, $con);
    }

    /**
     * Clears out the collOrders collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOrders()
     */
    public function clearOrders()
    {
        $this->collOrders = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOrders collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOrders($v = true): void
    {
        $this->collOrdersPartial = $v;
    }

    /**
     * Initializes the collOrders collection.
     *
     * By default this just sets the collOrders collection to an empty array (like clearcollOrders());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOrders(bool $overrideExisting = true): void
    {
        if (null !== $this->collOrders && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySalesPaymentTableMap::getTableMap()->getCollectionClassName();

        $this->collOrders = new $collectionClassName;
        $this->collOrders->setModel('\Orm\Zed\Payment\Persistence\SpySalesPayment');
    }

    /**
     * Gets an array of SpySalesPayment objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySalesOrder is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpySalesPayment[] List of SpySalesPayment objects
     * @phpstan-return ObjectCollection&\Traversable<SpySalesPayment> List of SpySalesPayment objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOrders(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOrdersPartial && !$this->isNew();
        if (null === $this->collOrders || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOrders) {
                    $this->initOrders();
                } else {
                    $collectionClassName = SpySalesPaymentTableMap::getTableMap()->getCollectionClassName();

                    $collOrders = new $collectionClassName;
                    $collOrders->setModel('\Orm\Zed\Payment\Persistence\SpySalesPayment');

                    return $collOrders;
                }
            } else {
                $collOrders = SpySalesPaymentQuery::create(null, $criteria)
                    ->filterBySalesOrder($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOrdersPartial && count($collOrders)) {
                        $this->initOrders(false);

                        foreach ($collOrders as $obj) {
                            if (false == $this->collOrders->contains($obj)) {
                                $this->collOrders->append($obj);
                            }
                        }

                        $this->collOrdersPartial = true;
                    }

                    return $collOrders;
                }

                if ($partial && $this->collOrders) {
                    foreach ($this->collOrders as $obj) {
                        if ($obj->isNew()) {
                            $collOrders[] = $obj;
                        }
                    }
                }

                $this->collOrders = $collOrders;
                $this->collOrdersPartial = false;
            }
        }

        return $this->collOrders;
    }

    /**
     * Sets a collection of SpySalesPayment objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $orders A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOrders(Collection $orders, ?ConnectionInterface $con = null)
    {
        /** @var SpySalesPayment[] $ordersToDelete */
        $ordersToDelete = $this->getOrders(new Criteria(), $con)->diff($orders);


        $this->ordersScheduledForDeletion = $ordersToDelete;

        foreach ($ordersToDelete as $orderRemoved) {
            $orderRemoved->setSalesOrder(null);
        }

        $this->collOrders = null;
        foreach ($orders as $order) {
            $this->addOrder($order);
        }

        $this->collOrders = $orders;
        $this->collOrdersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpySalesPayment objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpySalesPayment objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOrders(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOrdersPartial && !$this->isNew();
        if (null === $this->collOrders || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOrders) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOrders());
            }

            $query = SpySalesPaymentQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySalesOrder($this)
                ->count($con);
        }

        return count($this->collOrders);
    }

    /**
     * Method called to associate a SpySalesPayment object to this object
     * through the SpySalesPayment foreign key attribute.
     *
     * @param SpySalesPayment $l SpySalesPayment
     * @return $this The current object (for fluent API support)
     */
    public function addOrder(SpySalesPayment $l)
    {
        if ($this->collOrders === null) {
            $this->initOrders();
            $this->collOrdersPartial = true;
        }

        if (!$this->collOrders->contains($l)) {
            $this->doAddOrder($l);

            if ($this->ordersScheduledForDeletion and $this->ordersScheduledForDeletion->contains($l)) {
                $this->ordersScheduledForDeletion->remove($this->ordersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpySalesPayment $order The SpySalesPayment object to add.
     */
    protected function doAddOrder(SpySalesPayment $order): void
    {
        $this->collOrders[]= $order;
        $order->setSalesOrder($this);
    }

    /**
     * @param SpySalesPayment $order The SpySalesPayment object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOrder(SpySalesPayment $order)
    {
        if ($this->getOrders()->contains($order)) {
            $pos = $this->collOrders->search($order);
            $this->collOrders->remove($pos);
            if (null === $this->ordersScheduledForDeletion) {
                $this->ordersScheduledForDeletion = clone $this->collOrders;
                $this->ordersScheduledForDeletion->clear();
            }
            $this->ordersScheduledForDeletion[]= clone $order;
            $order->setSalesOrder(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySalesOrder is new, it will return
     * an empty collection; or if this SpySalesOrder has previously
     * been saved, it will retrieve related Orders from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySalesOrder.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpySalesPayment[] List of SpySalesPayment objects
     * @phpstan-return ObjectCollection&\Traversable<SpySalesPayment}> List of SpySalesPayment objects
     */
    public function getOrdersJoinSalesPaymentMethodType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpySalesPaymentQuery::create(null, $criteria);
        $query->joinWith('SalesPaymentMethodType', $joinBehavior);

        return $this->getOrders($query, $con);
    }

    /**
     * Clears out the collSpySalesPaymentMerchantPayouts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpySalesPaymentMerchantPayouts()
     */
    public function clearSpySalesPaymentMerchantPayouts()
    {
        $this->collSpySalesPaymentMerchantPayouts = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpySalesPaymentMerchantPayouts collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpySalesPaymentMerchantPayouts($v = true): void
    {
        $this->collSpySalesPaymentMerchantPayoutsPartial = $v;
    }

    /**
     * Initializes the collSpySalesPaymentMerchantPayouts collection.
     *
     * By default this just sets the collSpySalesPaymentMerchantPayouts collection to an empty array (like clearcollSpySalesPaymentMerchantPayouts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpySalesPaymentMerchantPayouts(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpySalesPaymentMerchantPayouts && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySalesPaymentMerchantPayoutTableMap::getTableMap()->getCollectionClassName();

        $this->collSpySalesPaymentMerchantPayouts = new $collectionClassName;
        $this->collSpySalesPaymentMerchantPayouts->setModel('\Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayout');
    }

    /**
     * Gets an array of SpySalesPaymentMerchantPayout objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySalesOrder is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpySalesPaymentMerchantPayout[] List of SpySalesPaymentMerchantPayout objects
     * @phpstan-return ObjectCollection&\Traversable<SpySalesPaymentMerchantPayout> List of SpySalesPaymentMerchantPayout objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpySalesPaymentMerchantPayouts(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpySalesPaymentMerchantPayoutsPartial && !$this->isNew();
        if (null === $this->collSpySalesPaymentMerchantPayouts || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpySalesPaymentMerchantPayouts) {
                    $this->initSpySalesPaymentMerchantPayouts();
                } else {
                    $collectionClassName = SpySalesPaymentMerchantPayoutTableMap::getTableMap()->getCollectionClassName();

                    $collSpySalesPaymentMerchantPayouts = new $collectionClassName;
                    $collSpySalesPaymentMerchantPayouts->setModel('\Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayout');

                    return $collSpySalesPaymentMerchantPayouts;
                }
            } else {
                $collSpySalesPaymentMerchantPayouts = SpySalesPaymentMerchantPayoutQuery::create(null, $criteria)
                    ->filterBySpySalesOrder($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpySalesPaymentMerchantPayoutsPartial && count($collSpySalesPaymentMerchantPayouts)) {
                        $this->initSpySalesPaymentMerchantPayouts(false);

                        foreach ($collSpySalesPaymentMerchantPayouts as $obj) {
                            if (false == $this->collSpySalesPaymentMerchantPayouts->contains($obj)) {
                                $this->collSpySalesPaymentMerchantPayouts->append($obj);
                            }
                        }

                        $this->collSpySalesPaymentMerchantPayoutsPartial = true;
                    }

                    return $collSpySalesPaymentMerchantPayouts;
                }

                if ($partial && $this->collSpySalesPaymentMerchantPayouts) {
                    foreach ($this->collSpySalesPaymentMerchantPayouts as $obj) {
                        if ($obj->isNew()) {
                            $collSpySalesPaymentMerchantPayouts[] = $obj;
                        }
                    }
                }

                $this->collSpySalesPaymentMerchantPayouts = $collSpySalesPaymentMerchantPayouts;
                $this->collSpySalesPaymentMerchantPayoutsPartial = false;
            }
        }

        return $this->collSpySalesPaymentMerchantPayouts;
    }

    /**
     * Sets a collection of SpySalesPaymentMerchantPayout objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spySalesPaymentMerchantPayouts A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpySalesPaymentMerchantPayouts(Collection $spySalesPaymentMerchantPayouts, ?ConnectionInterface $con = null)
    {
        /** @var SpySalesPaymentMerchantPayout[] $spySalesPaymentMerchantPayoutsToDelete */
        $spySalesPaymentMerchantPayoutsToDelete = $this->getSpySalesPaymentMerchantPayouts(new Criteria(), $con)->diff($spySalesPaymentMerchantPayouts);


        $this->spySalesPaymentMerchantPayoutsScheduledForDeletion = $spySalesPaymentMerchantPayoutsToDelete;

        foreach ($spySalesPaymentMerchantPayoutsToDelete as $spySalesPaymentMerchantPayoutRemoved) {
            $spySalesPaymentMerchantPayoutRemoved->setSpySalesOrder(null);
        }

        $this->collSpySalesPaymentMerchantPayouts = null;
        foreach ($spySalesPaymentMerchantPayouts as $spySalesPaymentMerchantPayout) {
            $this->addSpySalesPaymentMerchantPayout($spySalesPaymentMerchantPayout);
        }

        $this->collSpySalesPaymentMerchantPayouts = $spySalesPaymentMerchantPayouts;
        $this->collSpySalesPaymentMerchantPayoutsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpySalesPaymentMerchantPayout objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpySalesPaymentMerchantPayout objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpySalesPaymentMerchantPayouts(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpySalesPaymentMerchantPayoutsPartial && !$this->isNew();
        if (null === $this->collSpySalesPaymentMerchantPayouts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpySalesPaymentMerchantPayouts) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpySalesPaymentMerchantPayouts());
            }

            $query = SpySalesPaymentMerchantPayoutQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpySalesOrder($this)
                ->count($con);
        }

        return count($this->collSpySalesPaymentMerchantPayouts);
    }

    /**
     * Method called to associate a SpySalesPaymentMerchantPayout object to this object
     * through the SpySalesPaymentMerchantPayout foreign key attribute.
     *
     * @param SpySalesPaymentMerchantPayout $l SpySalesPaymentMerchantPayout
     * @return $this The current object (for fluent API support)
     */
    public function addSpySalesPaymentMerchantPayout(SpySalesPaymentMerchantPayout $l)
    {
        if ($this->collSpySalesPaymentMerchantPayouts === null) {
            $this->initSpySalesPaymentMerchantPayouts();
            $this->collSpySalesPaymentMerchantPayoutsPartial = true;
        }

        if (!$this->collSpySalesPaymentMerchantPayouts->contains($l)) {
            $this->doAddSpySalesPaymentMerchantPayout($l);

            if ($this->spySalesPaymentMerchantPayoutsScheduledForDeletion and $this->spySalesPaymentMerchantPayoutsScheduledForDeletion->contains($l)) {
                $this->spySalesPaymentMerchantPayoutsScheduledForDeletion->remove($this->spySalesPaymentMerchantPayoutsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpySalesPaymentMerchantPayout $spySalesPaymentMerchantPayout The SpySalesPaymentMerchantPayout object to add.
     */
    protected function doAddSpySalesPaymentMerchantPayout(SpySalesPaymentMerchantPayout $spySalesPaymentMerchantPayout): void
    {
        $this->collSpySalesPaymentMerchantPayouts[]= $spySalesPaymentMerchantPayout;
        $spySalesPaymentMerchantPayout->setSpySalesOrder($this);
    }

    /**
     * @param SpySalesPaymentMerchantPayout $spySalesPaymentMerchantPayout The SpySalesPaymentMerchantPayout object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpySalesPaymentMerchantPayout(SpySalesPaymentMerchantPayout $spySalesPaymentMerchantPayout)
    {
        if ($this->getSpySalesPaymentMerchantPayouts()->contains($spySalesPaymentMerchantPayout)) {
            $pos = $this->collSpySalesPaymentMerchantPayouts->search($spySalesPaymentMerchantPayout);
            $this->collSpySalesPaymentMerchantPayouts->remove($pos);
            if (null === $this->spySalesPaymentMerchantPayoutsScheduledForDeletion) {
                $this->spySalesPaymentMerchantPayoutsScheduledForDeletion = clone $this->collSpySalesPaymentMerchantPayouts;
                $this->spySalesPaymentMerchantPayoutsScheduledForDeletion->clear();
            }
            $this->spySalesPaymentMerchantPayoutsScheduledForDeletion[]= clone $spySalesPaymentMerchantPayout;
            $spySalesPaymentMerchantPayout->setSpySalesOrder(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySalesOrder is new, it will return
     * an empty collection; or if this SpySalesOrder has previously
     * been saved, it will retrieve related SpySalesPaymentMerchantPayouts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySalesOrder.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpySalesPaymentMerchantPayout[] List of SpySalesPaymentMerchantPayout objects
     * @phpstan-return ObjectCollection&\Traversable<SpySalesPaymentMerchantPayout}> List of SpySalesPaymentMerchantPayout objects
     */
    public function getSpySalesPaymentMerchantPayoutsJoinSpyMerchant(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpySalesPaymentMerchantPayoutQuery::create(null, $criteria);
        $query->joinWith('SpyMerchant', $joinBehavior);

        return $this->getSpySalesPaymentMerchantPayouts($query, $con);
    }

    /**
     * Clears out the collSpySalesPaymentMerchantPayoutReversals collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpySalesPaymentMerchantPayoutReversals()
     */
    public function clearSpySalesPaymentMerchantPayoutReversals()
    {
        $this->collSpySalesPaymentMerchantPayoutReversals = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpySalesPaymentMerchantPayoutReversals collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpySalesPaymentMerchantPayoutReversals($v = true): void
    {
        $this->collSpySalesPaymentMerchantPayoutReversalsPartial = $v;
    }

    /**
     * Initializes the collSpySalesPaymentMerchantPayoutReversals collection.
     *
     * By default this just sets the collSpySalesPaymentMerchantPayoutReversals collection to an empty array (like clearcollSpySalesPaymentMerchantPayoutReversals());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpySalesPaymentMerchantPayoutReversals(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpySalesPaymentMerchantPayoutReversals && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySalesPaymentMerchantPayoutReversalTableMap::getTableMap()->getCollectionClassName();

        $this->collSpySalesPaymentMerchantPayoutReversals = new $collectionClassName;
        $this->collSpySalesPaymentMerchantPayoutReversals->setModel('\Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversal');
    }

    /**
     * Gets an array of SpySalesPaymentMerchantPayoutReversal objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySalesOrder is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpySalesPaymentMerchantPayoutReversal[] List of SpySalesPaymentMerchantPayoutReversal objects
     * @phpstan-return ObjectCollection&\Traversable<SpySalesPaymentMerchantPayoutReversal> List of SpySalesPaymentMerchantPayoutReversal objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpySalesPaymentMerchantPayoutReversals(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpySalesPaymentMerchantPayoutReversalsPartial && !$this->isNew();
        if (null === $this->collSpySalesPaymentMerchantPayoutReversals || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpySalesPaymentMerchantPayoutReversals) {
                    $this->initSpySalesPaymentMerchantPayoutReversals();
                } else {
                    $collectionClassName = SpySalesPaymentMerchantPayoutReversalTableMap::getTableMap()->getCollectionClassName();

                    $collSpySalesPaymentMerchantPayoutReversals = new $collectionClassName;
                    $collSpySalesPaymentMerchantPayoutReversals->setModel('\Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversal');

                    return $collSpySalesPaymentMerchantPayoutReversals;
                }
            } else {
                $collSpySalesPaymentMerchantPayoutReversals = SpySalesPaymentMerchantPayoutReversalQuery::create(null, $criteria)
                    ->filterBySpySalesOrder($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpySalesPaymentMerchantPayoutReversalsPartial && count($collSpySalesPaymentMerchantPayoutReversals)) {
                        $this->initSpySalesPaymentMerchantPayoutReversals(false);

                        foreach ($collSpySalesPaymentMerchantPayoutReversals as $obj) {
                            if (false == $this->collSpySalesPaymentMerchantPayoutReversals->contains($obj)) {
                                $this->collSpySalesPaymentMerchantPayoutReversals->append($obj);
                            }
                        }

                        $this->collSpySalesPaymentMerchantPayoutReversalsPartial = true;
                    }

                    return $collSpySalesPaymentMerchantPayoutReversals;
                }

                if ($partial && $this->collSpySalesPaymentMerchantPayoutReversals) {
                    foreach ($this->collSpySalesPaymentMerchantPayoutReversals as $obj) {
                        if ($obj->isNew()) {
                            $collSpySalesPaymentMerchantPayoutReversals[] = $obj;
                        }
                    }
                }

                $this->collSpySalesPaymentMerchantPayoutReversals = $collSpySalesPaymentMerchantPayoutReversals;
                $this->collSpySalesPaymentMerchantPayoutReversalsPartial = false;
            }
        }

        return $this->collSpySalesPaymentMerchantPayoutReversals;
    }

    /**
     * Sets a collection of SpySalesPaymentMerchantPayoutReversal objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spySalesPaymentMerchantPayoutReversals A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpySalesPaymentMerchantPayoutReversals(Collection $spySalesPaymentMerchantPayoutReversals, ?ConnectionInterface $con = null)
    {
        /** @var SpySalesPaymentMerchantPayoutReversal[] $spySalesPaymentMerchantPayoutReversalsToDelete */
        $spySalesPaymentMerchantPayoutReversalsToDelete = $this->getSpySalesPaymentMerchantPayoutReversals(new Criteria(), $con)->diff($spySalesPaymentMerchantPayoutReversals);


        $this->spySalesPaymentMerchantPayoutReversalsScheduledForDeletion = $spySalesPaymentMerchantPayoutReversalsToDelete;

        foreach ($spySalesPaymentMerchantPayoutReversalsToDelete as $spySalesPaymentMerchantPayoutReversalRemoved) {
            $spySalesPaymentMerchantPayoutReversalRemoved->setSpySalesOrder(null);
        }

        $this->collSpySalesPaymentMerchantPayoutReversals = null;
        foreach ($spySalesPaymentMerchantPayoutReversals as $spySalesPaymentMerchantPayoutReversal) {
            $this->addSpySalesPaymentMerchantPayoutReversal($spySalesPaymentMerchantPayoutReversal);
        }

        $this->collSpySalesPaymentMerchantPayoutReversals = $spySalesPaymentMerchantPayoutReversals;
        $this->collSpySalesPaymentMerchantPayoutReversalsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpySalesPaymentMerchantPayoutReversal objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpySalesPaymentMerchantPayoutReversal objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpySalesPaymentMerchantPayoutReversals(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpySalesPaymentMerchantPayoutReversalsPartial && !$this->isNew();
        if (null === $this->collSpySalesPaymentMerchantPayoutReversals || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpySalesPaymentMerchantPayoutReversals) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpySalesPaymentMerchantPayoutReversals());
            }

            $query = SpySalesPaymentMerchantPayoutReversalQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpySalesOrder($this)
                ->count($con);
        }

        return count($this->collSpySalesPaymentMerchantPayoutReversals);
    }

    /**
     * Method called to associate a SpySalesPaymentMerchantPayoutReversal object to this object
     * through the SpySalesPaymentMerchantPayoutReversal foreign key attribute.
     *
     * @param SpySalesPaymentMerchantPayoutReversal $l SpySalesPaymentMerchantPayoutReversal
     * @return $this The current object (for fluent API support)
     */
    public function addSpySalesPaymentMerchantPayoutReversal(SpySalesPaymentMerchantPayoutReversal $l)
    {
        if ($this->collSpySalesPaymentMerchantPayoutReversals === null) {
            $this->initSpySalesPaymentMerchantPayoutReversals();
            $this->collSpySalesPaymentMerchantPayoutReversalsPartial = true;
        }

        if (!$this->collSpySalesPaymentMerchantPayoutReversals->contains($l)) {
            $this->doAddSpySalesPaymentMerchantPayoutReversal($l);

            if ($this->spySalesPaymentMerchantPayoutReversalsScheduledForDeletion and $this->spySalesPaymentMerchantPayoutReversalsScheduledForDeletion->contains($l)) {
                $this->spySalesPaymentMerchantPayoutReversalsScheduledForDeletion->remove($this->spySalesPaymentMerchantPayoutReversalsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpySalesPaymentMerchantPayoutReversal $spySalesPaymentMerchantPayoutReversal The SpySalesPaymentMerchantPayoutReversal object to add.
     */
    protected function doAddSpySalesPaymentMerchantPayoutReversal(SpySalesPaymentMerchantPayoutReversal $spySalesPaymentMerchantPayoutReversal): void
    {
        $this->collSpySalesPaymentMerchantPayoutReversals[]= $spySalesPaymentMerchantPayoutReversal;
        $spySalesPaymentMerchantPayoutReversal->setSpySalesOrder($this);
    }

    /**
     * @param SpySalesPaymentMerchantPayoutReversal $spySalesPaymentMerchantPayoutReversal The SpySalesPaymentMerchantPayoutReversal object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpySalesPaymentMerchantPayoutReversal(SpySalesPaymentMerchantPayoutReversal $spySalesPaymentMerchantPayoutReversal)
    {
        if ($this->getSpySalesPaymentMerchantPayoutReversals()->contains($spySalesPaymentMerchantPayoutReversal)) {
            $pos = $this->collSpySalesPaymentMerchantPayoutReversals->search($spySalesPaymentMerchantPayoutReversal);
            $this->collSpySalesPaymentMerchantPayoutReversals->remove($pos);
            if (null === $this->spySalesPaymentMerchantPayoutReversalsScheduledForDeletion) {
                $this->spySalesPaymentMerchantPayoutReversalsScheduledForDeletion = clone $this->collSpySalesPaymentMerchantPayoutReversals;
                $this->spySalesPaymentMerchantPayoutReversalsScheduledForDeletion->clear();
            }
            $this->spySalesPaymentMerchantPayoutReversalsScheduledForDeletion[]= clone $spySalesPaymentMerchantPayoutReversal;
            $spySalesPaymentMerchantPayoutReversal->setSpySalesOrder(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySalesOrder is new, it will return
     * an empty collection; or if this SpySalesOrder has previously
     * been saved, it will retrieve related SpySalesPaymentMerchantPayoutReversals from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySalesOrder.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpySalesPaymentMerchantPayoutReversal[] List of SpySalesPaymentMerchantPayoutReversal objects
     * @phpstan-return ObjectCollection&\Traversable<SpySalesPaymentMerchantPayoutReversal}> List of SpySalesPaymentMerchantPayoutReversal objects
     */
    public function getSpySalesPaymentMerchantPayoutReversalsJoinSpyMerchant(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpySalesPaymentMerchantPayoutReversalQuery::create(null, $criteria);
        $query->joinWith('SpyMerchant', $joinBehavior);

        return $this->getSpySalesPaymentMerchantPayoutReversals($query, $con);
    }

    /**
     * Clears out the collReclamations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addReclamations()
     */
    public function clearReclamations()
    {
        $this->collReclamations = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collReclamations collection loaded partially.
     *
     * @return void
     */
    public function resetPartialReclamations($v = true): void
    {
        $this->collReclamationsPartial = $v;
    }

    /**
     * Initializes the collReclamations collection.
     *
     * By default this just sets the collReclamations collection to an empty array (like clearcollReclamations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initReclamations(bool $overrideExisting = true): void
    {
        if (null !== $this->collReclamations && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySalesReclamationTableMap::getTableMap()->getCollectionClassName();

        $this->collReclamations = new $collectionClassName;
        $this->collReclamations->setModel('\Orm\Zed\SalesReclamation\Persistence\SpySalesReclamation');
    }

    /**
     * Gets an array of SpySalesReclamation objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySalesOrder is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpySalesReclamation[] List of SpySalesReclamation objects
     * @phpstan-return ObjectCollection&\Traversable<SpySalesReclamation> List of SpySalesReclamation objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getReclamations(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collReclamationsPartial && !$this->isNew();
        if (null === $this->collReclamations || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collReclamations) {
                    $this->initReclamations();
                } else {
                    $collectionClassName = SpySalesReclamationTableMap::getTableMap()->getCollectionClassName();

                    $collReclamations = new $collectionClassName;
                    $collReclamations->setModel('\Orm\Zed\SalesReclamation\Persistence\SpySalesReclamation');

                    return $collReclamations;
                }
            } else {
                $collReclamations = SpySalesReclamationQuery::create(null, $criteria)
                    ->filterByOrder($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collReclamationsPartial && count($collReclamations)) {
                        $this->initReclamations(false);

                        foreach ($collReclamations as $obj) {
                            if (false == $this->collReclamations->contains($obj)) {
                                $this->collReclamations->append($obj);
                            }
                        }

                        $this->collReclamationsPartial = true;
                    }

                    return $collReclamations;
                }

                if ($partial && $this->collReclamations) {
                    foreach ($this->collReclamations as $obj) {
                        if ($obj->isNew()) {
                            $collReclamations[] = $obj;
                        }
                    }
                }

                $this->collReclamations = $collReclamations;
                $this->collReclamationsPartial = false;
            }
        }

        return $this->collReclamations;
    }

    /**
     * Sets a collection of SpySalesReclamation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $reclamations A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setReclamations(Collection $reclamations, ?ConnectionInterface $con = null)
    {
        /** @var SpySalesReclamation[] $reclamationsToDelete */
        $reclamationsToDelete = $this->getReclamations(new Criteria(), $con)->diff($reclamations);


        $this->reclamationsScheduledForDeletion = $reclamationsToDelete;

        foreach ($reclamationsToDelete as $reclamationRemoved) {
            $reclamationRemoved->setOrder(null);
        }

        $this->collReclamations = null;
        foreach ($reclamations as $reclamation) {
            $this->addReclamation($reclamation);
        }

        $this->collReclamations = $reclamations;
        $this->collReclamationsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpySalesReclamation objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpySalesReclamation objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countReclamations(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collReclamationsPartial && !$this->isNew();
        if (null === $this->collReclamations || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collReclamations) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getReclamations());
            }

            $query = SpySalesReclamationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrder($this)
                ->count($con);
        }

        return count($this->collReclamations);
    }

    /**
     * Method called to associate a SpySalesReclamation object to this object
     * through the SpySalesReclamation foreign key attribute.
     *
     * @param SpySalesReclamation $l SpySalesReclamation
     * @return $this The current object (for fluent API support)
     */
    public function addReclamation(SpySalesReclamation $l)
    {
        if ($this->collReclamations === null) {
            $this->initReclamations();
            $this->collReclamationsPartial = true;
        }

        if (!$this->collReclamations->contains($l)) {
            $this->doAddReclamation($l);

            if ($this->reclamationsScheduledForDeletion and $this->reclamationsScheduledForDeletion->contains($l)) {
                $this->reclamationsScheduledForDeletion->remove($this->reclamationsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpySalesReclamation $reclamation The SpySalesReclamation object to add.
     */
    protected function doAddReclamation(SpySalesReclamation $reclamation): void
    {
        $this->collReclamations[]= $reclamation;
        $reclamation->setOrder($this);
    }

    /**
     * @param SpySalesReclamation $reclamation The SpySalesReclamation object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeReclamation(SpySalesReclamation $reclamation)
    {
        if ($this->getReclamations()->contains($reclamation)) {
            $pos = $this->collReclamations->search($reclamation);
            $this->collReclamations->remove($pos);
            if (null === $this->reclamationsScheduledForDeletion) {
                $this->reclamationsScheduledForDeletion = clone $this->collReclamations;
                $this->reclamationsScheduledForDeletion->clear();
            }
            $this->reclamationsScheduledForDeletion[]= clone $reclamation;
            $reclamation->setOrder(null);
        }

        return $this;
    }

    /**
     * Clears out the collSpySspInquirySalesOrders collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpySspInquirySalesOrders()
     */
    public function clearSpySspInquirySalesOrders()
    {
        $this->collSpySspInquirySalesOrders = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpySspInquirySalesOrders collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpySspInquirySalesOrders($v = true): void
    {
        $this->collSpySspInquirySalesOrdersPartial = $v;
    }

    /**
     * Initializes the collSpySspInquirySalesOrders collection.
     *
     * By default this just sets the collSpySspInquirySalesOrders collection to an empty array (like clearcollSpySspInquirySalesOrders());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpySspInquirySalesOrders(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpySspInquirySalesOrders && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySspInquirySalesOrderTableMap::getTableMap()->getCollectionClassName();

        $this->collSpySspInquirySalesOrders = new $collectionClassName;
        $this->collSpySspInquirySalesOrders->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrder');
    }

    /**
     * Gets an array of SpySspInquirySalesOrder objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySalesOrder is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpySspInquirySalesOrder[] List of SpySspInquirySalesOrder objects
     * @phpstan-return ObjectCollection&\Traversable<SpySspInquirySalesOrder> List of SpySspInquirySalesOrder objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpySspInquirySalesOrders(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpySspInquirySalesOrdersPartial && !$this->isNew();
        if (null === $this->collSpySspInquirySalesOrders || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpySspInquirySalesOrders) {
                    $this->initSpySspInquirySalesOrders();
                } else {
                    $collectionClassName = SpySspInquirySalesOrderTableMap::getTableMap()->getCollectionClassName();

                    $collSpySspInquirySalesOrders = new $collectionClassName;
                    $collSpySspInquirySalesOrders->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrder');

                    return $collSpySspInquirySalesOrders;
                }
            } else {
                $collSpySspInquirySalesOrders = SpySspInquirySalesOrderQuery::create(null, $criteria)
                    ->filterBySpySalesOrder($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpySspInquirySalesOrdersPartial && count($collSpySspInquirySalesOrders)) {
                        $this->initSpySspInquirySalesOrders(false);

                        foreach ($collSpySspInquirySalesOrders as $obj) {
                            if (false == $this->collSpySspInquirySalesOrders->contains($obj)) {
                                $this->collSpySspInquirySalesOrders->append($obj);
                            }
                        }

                        $this->collSpySspInquirySalesOrdersPartial = true;
                    }

                    return $collSpySspInquirySalesOrders;
                }

                if ($partial && $this->collSpySspInquirySalesOrders) {
                    foreach ($this->collSpySspInquirySalesOrders as $obj) {
                        if ($obj->isNew()) {
                            $collSpySspInquirySalesOrders[] = $obj;
                        }
                    }
                }

                $this->collSpySspInquirySalesOrders = $collSpySspInquirySalesOrders;
                $this->collSpySspInquirySalesOrdersPartial = false;
            }
        }

        return $this->collSpySspInquirySalesOrders;
    }

    /**
     * Sets a collection of SpySspInquirySalesOrder objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spySspInquirySalesOrders A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpySspInquirySalesOrders(Collection $spySspInquirySalesOrders, ?ConnectionInterface $con = null)
    {
        /** @var SpySspInquirySalesOrder[] $spySspInquirySalesOrdersToDelete */
        $spySspInquirySalesOrdersToDelete = $this->getSpySspInquirySalesOrders(new Criteria(), $con)->diff($spySspInquirySalesOrders);


        $this->spySspInquirySalesOrdersScheduledForDeletion = $spySspInquirySalesOrdersToDelete;

        foreach ($spySspInquirySalesOrdersToDelete as $spySspInquirySalesOrderRemoved) {
            $spySspInquirySalesOrderRemoved->setSpySalesOrder(null);
        }

        $this->collSpySspInquirySalesOrders = null;
        foreach ($spySspInquirySalesOrders as $spySspInquirySalesOrder) {
            $this->addSpySspInquirySalesOrder($spySspInquirySalesOrder);
        }

        $this->collSpySspInquirySalesOrders = $spySspInquirySalesOrders;
        $this->collSpySspInquirySalesOrdersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpySspInquirySalesOrder objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpySspInquirySalesOrder objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpySspInquirySalesOrders(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpySspInquirySalesOrdersPartial && !$this->isNew();
        if (null === $this->collSpySspInquirySalesOrders || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpySspInquirySalesOrders) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpySspInquirySalesOrders());
            }

            $query = SpySspInquirySalesOrderQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpySalesOrder($this)
                ->count($con);
        }

        return count($this->collSpySspInquirySalesOrders);
    }

    /**
     * Method called to associate a SpySspInquirySalesOrder object to this object
     * through the SpySspInquirySalesOrder foreign key attribute.
     *
     * @param SpySspInquirySalesOrder $l SpySspInquirySalesOrder
     * @return $this The current object (for fluent API support)
     */
    public function addSpySspInquirySalesOrder(SpySspInquirySalesOrder $l)
    {
        if ($this->collSpySspInquirySalesOrders === null) {
            $this->initSpySspInquirySalesOrders();
            $this->collSpySspInquirySalesOrdersPartial = true;
        }

        if (!$this->collSpySspInquirySalesOrders->contains($l)) {
            $this->doAddSpySspInquirySalesOrder($l);

            if ($this->spySspInquirySalesOrdersScheduledForDeletion and $this->spySspInquirySalesOrdersScheduledForDeletion->contains($l)) {
                $this->spySspInquirySalesOrdersScheduledForDeletion->remove($this->spySspInquirySalesOrdersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpySspInquirySalesOrder $spySspInquirySalesOrder The SpySspInquirySalesOrder object to add.
     */
    protected function doAddSpySspInquirySalesOrder(SpySspInquirySalesOrder $spySspInquirySalesOrder): void
    {
        $this->collSpySspInquirySalesOrders[]= $spySspInquirySalesOrder;
        $spySspInquirySalesOrder->setSpySalesOrder($this);
    }

    /**
     * @param SpySspInquirySalesOrder $spySspInquirySalesOrder The SpySspInquirySalesOrder object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpySspInquirySalesOrder(SpySspInquirySalesOrder $spySspInquirySalesOrder)
    {
        if ($this->getSpySspInquirySalesOrders()->contains($spySspInquirySalesOrder)) {
            $pos = $this->collSpySspInquirySalesOrders->search($spySspInquirySalesOrder);
            $this->collSpySspInquirySalesOrders->remove($pos);
            if (null === $this->spySspInquirySalesOrdersScheduledForDeletion) {
                $this->spySspInquirySalesOrdersScheduledForDeletion = clone $this->collSpySspInquirySalesOrders;
                $this->spySspInquirySalesOrdersScheduledForDeletion->clear();
            }
            $this->spySspInquirySalesOrdersScheduledForDeletion[]= clone $spySspInquirySalesOrder;
            $spySspInquirySalesOrder->setSpySalesOrder(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySalesOrder is new, it will return
     * an empty collection; or if this SpySalesOrder has previously
     * been saved, it will retrieve related SpySspInquirySalesOrders from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySalesOrder.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpySspInquirySalesOrder[] List of SpySspInquirySalesOrder objects
     * @phpstan-return ObjectCollection&\Traversable<SpySspInquirySalesOrder}> List of SpySspInquirySalesOrder objects
     */
    public function getSpySspInquirySalesOrdersJoinSpySspInquiry(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpySspInquirySalesOrderQuery::create(null, $criteria);
        $query->joinWith('SpySspInquiry', $joinBehavior);

        return $this->getSpySspInquirySalesOrders($query, $con);
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
        if (null !== $this->aBillingAddress) {
            $this->aBillingAddress->removeSpySalesOrderRelatedByFkSalesOrderAddressBilling($this);
        }
        if (null !== $this->aShippingAddress) {
            $this->aShippingAddress->removeSpySalesOrderRelatedByFkSalesOrderAddressShipping($this);
        }
        if (null !== $this->aLocale) {
            $this->aLocale->removeSpySalesOrder($this);
        }
        $this->id_sales_order = null;
        $this->fk_locale = null;
        $this->fk_sales_order_address_billing = null;
        $this->fk_sales_order_address_shipping = null;
        $this->agent_email = null;
        $this->cart_note = null;
        $this->company_business_unit_uuid = null;
        $this->company_uuid = null;
        $this->currency_iso_code = null;
        $this->customer_reference = null;
        $this->email = null;
        $this->first_name = null;
        $this->is_test = null;
        $this->last_name = null;
        $this->oms_processor_identifier = null;
        $this->order_custom_reference = null;
        $this->order_reference = null;
        $this->price_mode = null;
        $this->quote_request_version_reference = null;
        $this->salutation = null;
        $this->store = null;
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
            if ($this->collSpyMerchantSalesOrders) {
                foreach ($this->collSpyMerchantSalesOrders as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTransitionLogs) {
                foreach ($this->collTransitionLogs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyRefunds) {
                foreach ($this->collSpyRefunds as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collItems) {
                foreach ($this->collItems as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDiscounts) {
                foreach ($this->collDiscounts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collExpenses) {
                foreach ($this->collExpenses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpySalesShipments) {
                foreach ($this->collSpySalesShipments as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOrderTotals) {
                foreach ($this->collOrderTotals as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collNotes) {
                foreach ($this->collNotes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOrderComments) {
                foreach ($this->collOrderComments as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpySalesOrderInvoices) {
                foreach ($this->collSpySalesOrderInvoices as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpySalesMerchantCommissions) {
                foreach ($this->collSpySalesMerchantCommissions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOrders) {
                foreach ($this->collOrders as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpySalesPaymentMerchantPayouts) {
                foreach ($this->collSpySalesPaymentMerchantPayouts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpySalesPaymentMerchantPayoutReversals) {
                foreach ($this->collSpySalesPaymentMerchantPayoutReversals as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collReclamations) {
                foreach ($this->collReclamations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpySspInquirySalesOrders) {
                foreach ($this->collSpySspInquirySalesOrders as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyMerchantSalesOrders = null;
        $this->collTransitionLogs = null;
        $this->collSpyRefunds = null;
        $this->collItems = null;
        $this->collDiscounts = null;
        $this->collExpenses = null;
        $this->collSpySalesShipments = null;
        $this->collOrderTotals = null;
        $this->collNotes = null;
        $this->collOrderComments = null;
        $this->collSpySalesOrderInvoices = null;
        $this->collSpySalesMerchantCommissions = null;
        $this->collOrders = null;
        $this->collSpySalesPaymentMerchantPayouts = null;
        $this->collSpySalesPaymentMerchantPayoutReversals = null;
        $this->collReclamations = null;
        $this->collSpySspInquirySalesOrders = null;
        $this->aBillingAddress = null;
        $this->aShippingAddress = null;
        $this->aLocale = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpySalesOrderTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return $this The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[SpySalesOrderTableMap::COL_UPDATED_AT] = true;

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
