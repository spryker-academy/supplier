<?php

namespace Orm\Zed\Sales\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderItem;
use Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderItemQuery;
use Orm\Zed\MerchantSalesOrder\Persistence\Base\SpyMerchantSalesOrderItem as BaseSpyMerchantSalesOrderItem;
use Orm\Zed\MerchantSalesOrder\Persistence\Map\SpyMerchantSalesOrderItemTableMap;
use Orm\Zed\Nopayment\Persistence\SpyNopaymentPaid;
use Orm\Zed\Nopayment\Persistence\SpyNopaymentPaidQuery;
use Orm\Zed\Nopayment\Persistence\Base\SpyNopaymentPaid as BaseSpyNopaymentPaid;
use Orm\Zed\Nopayment\Persistence\Map\SpyNopaymentPaidTableMap;
use Orm\Zed\Oms\Persistence\SpyOmsEventTimeout;
use Orm\Zed\Oms\Persistence\SpyOmsEventTimeoutQuery;
use Orm\Zed\Oms\Persistence\SpyOmsOrderItemState;
use Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateHistory;
use Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateHistoryQuery;
use Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateQuery;
use Orm\Zed\Oms\Persistence\SpyOmsOrderProcess;
use Orm\Zed\Oms\Persistence\SpyOmsOrderProcessQuery;
use Orm\Zed\Oms\Persistence\SpyOmsTransitionLog;
use Orm\Zed\Oms\Persistence\SpyOmsTransitionLogQuery;
use Orm\Zed\Oms\Persistence\Base\SpyOmsEventTimeout as BaseSpyOmsEventTimeout;
use Orm\Zed\Oms\Persistence\Base\SpyOmsOrderItemStateHistory as BaseSpyOmsOrderItemStateHistory;
use Orm\Zed\Oms\Persistence\Base\SpyOmsTransitionLog as BaseSpyOmsTransitionLog;
use Orm\Zed\Oms\Persistence\Map\SpyOmsEventTimeoutTableMap;
use Orm\Zed\Oms\Persistence\Map\SpyOmsOrderItemStateHistoryTableMap;
use Orm\Zed\Oms\Persistence\Map\SpyOmsTransitionLogTableMap;
use Orm\Zed\ProductBundle\Persistence\SpySalesOrderItemBundle;
use Orm\Zed\ProductBundle\Persistence\SpySalesOrderItemBundleQuery;
use Orm\Zed\SalesConfigurableBundle\Persistence\SpySalesOrderConfiguredBundleItem;
use Orm\Zed\SalesConfigurableBundle\Persistence\SpySalesOrderConfiguredBundleItemQuery;
use Orm\Zed\SalesConfigurableBundle\Persistence\Base\SpySalesOrderConfiguredBundleItem as BaseSpySalesOrderConfiguredBundleItem;
use Orm\Zed\SalesConfigurableBundle\Persistence\Map\SpySalesOrderConfiguredBundleItemTableMap;
use Orm\Zed\SalesMerchantCommission\Persistence\SpySalesMerchantCommission;
use Orm\Zed\SalesMerchantCommission\Persistence\SpySalesMerchantCommissionQuery;
use Orm\Zed\SalesMerchantCommission\Persistence\Base\SpySalesMerchantCommission as BaseSpySalesMerchantCommission;
use Orm\Zed\SalesMerchantCommission\Persistence\Map\SpySalesMerchantCommissionTableMap;
use Orm\Zed\SalesProductConfiguration\Persistence\SpySalesOrderItemConfiguration;
use Orm\Zed\SalesProductConfiguration\Persistence\SpySalesOrderItemConfigurationQuery;
use Orm\Zed\SalesProductConfiguration\Persistence\Base\SpySalesOrderItemConfiguration as BaseSpySalesOrderItemConfiguration;
use Orm\Zed\SalesProductConfiguration\Persistence\Map\SpySalesOrderItemConfigurationTableMap;
use Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationItem;
use Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationItemQuery;
use Orm\Zed\SalesReclamation\Persistence\Base\SpySalesReclamationItem as BaseSpySalesReclamationItem;
use Orm\Zed\SalesReclamation\Persistence\Map\SpySalesReclamationItemTableMap;
use Orm\Zed\SalesReturn\Persistence\SpySalesReturnItem;
use Orm\Zed\SalesReturn\Persistence\SpySalesReturnItemQuery;
use Orm\Zed\SalesReturn\Persistence\Base\SpySalesReturnItem as BaseSpySalesReturnItem;
use Orm\Zed\SalesReturn\Persistence\Map\SpySalesReturnItemTableMap;
use Orm\Zed\SalesServicePoint\Persistence\SpySalesOrderItemServicePoint;
use Orm\Zed\SalesServicePoint\Persistence\SpySalesOrderItemServicePointQuery;
use Orm\Zed\SalesServicePoint\Persistence\Base\SpySalesOrderItemServicePoint as BaseSpySalesOrderItemServicePoint;
use Orm\Zed\SalesServicePoint\Persistence\Map\SpySalesOrderItemServicePointTableMap;
use Orm\Zed\Sales\Persistence\SpySalesDiscount as ChildSpySalesDiscount;
use Orm\Zed\Sales\Persistence\SpySalesDiscountQuery as ChildSpySalesDiscountQuery;
use Orm\Zed\Sales\Persistence\SpySalesOrder as ChildSpySalesOrder;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem as ChildSpySalesOrderItem;
use Orm\Zed\Sales\Persistence\SpySalesOrderItemMetadata as ChildSpySalesOrderItemMetadata;
use Orm\Zed\Sales\Persistence\SpySalesOrderItemMetadataQuery as ChildSpySalesOrderItemMetadataQuery;
use Orm\Zed\Sales\Persistence\SpySalesOrderItemOption as ChildSpySalesOrderItemOption;
use Orm\Zed\Sales\Persistence\SpySalesOrderItemOptionQuery as ChildSpySalesOrderItemOptionQuery;
use Orm\Zed\Sales\Persistence\SpySalesOrderItemQuery as ChildSpySalesOrderItemQuery;
use Orm\Zed\Sales\Persistence\SpySalesOrderQuery as ChildSpySalesOrderQuery;
use Orm\Zed\Sales\Persistence\SpySalesShipment as ChildSpySalesShipment;
use Orm\Zed\Sales\Persistence\SpySalesShipmentQuery as ChildSpySalesShipmentQuery;
use Orm\Zed\Sales\Persistence\Map\SpySalesDiscountTableMap;
use Orm\Zed\Sales\Persistence\Map\SpySalesOrderItemMetadataTableMap;
use Orm\Zed\Sales\Persistence\Map\SpySalesOrderItemOptionTableMap;
use Orm\Zed\Sales\Persistence\Map\SpySalesOrderItemTableMap;
use Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemProductClass;
use Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemProductClassQuery;
use Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemSspAsset;
use Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemSspAssetQuery;
use Orm\Zed\SelfServicePortal\Persistence\SpySalesProductClass;
use Orm\Zed\SelfServicePortal\Persistence\SpySalesProductClassQuery;
use Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderItem;
use Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderItemQuery;
use Orm\Zed\SelfServicePortal\Persistence\Base\SpySalesOrderItemProductClass as BaseSpySalesOrderItemProductClass;
use Orm\Zed\SelfServicePortal\Persistence\Base\SpySalesOrderItemSspAsset as BaseSpySalesOrderItemSspAsset;
use Orm\Zed\SelfServicePortal\Persistence\Base\SpySspInquirySalesOrderItem as BaseSpySspInquirySalesOrderItem;
use Orm\Zed\SelfServicePortal\Persistence\Map\SpySalesOrderItemProductClassTableMap;
use Orm\Zed\SelfServicePortal\Persistence\Map\SpySalesOrderItemSspAssetTableMap;
use Orm\Zed\SelfServicePortal\Persistence\Map\SpySspInquirySalesOrderItemTableMap;
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
 * Base class that represents a row from the 'spy_sales_order_item' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.Sales.Persistence.Base
 */
abstract class SpySalesOrderItem implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\Sales\\Persistence\\Map\\SpySalesOrderItemTableMap';


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
     * The value for the id_sales_order_item field.
     *
     * @var        int
     */
    protected $id_sales_order_item;

    /**
     * The value for the fk_oms_order_item_state field.
     *
     * @var        int
     */
    protected $fk_oms_order_item_state;

    /**
     * The value for the fk_oms_order_process field.
     *
     * @var        int|null
     */
    protected $fk_oms_order_process;

    /**
     * The value for the fk_sales_order field.
     *
     * @var        int
     */
    protected $fk_sales_order;

    /**
     * The value for the fk_sales_order_item_bundle field.
     *
     * @var        int|null
     */
    protected $fk_sales_order_item_bundle;

    /**
     * The value for the fk_sales_shipment field.
     *
     * @var        int|null
     */
    protected $fk_sales_shipment;

    /**
     * The value for the amount field.
     * A numerical value, often used for price, quantity, or discount.
     * @var        string|null
     */
    protected $amount;

    /**
     * The value for the amount_base_measurement_unit_name field.
     * The name of the base measurement unit for the amount of a sales order item.
     * @var        string|null
     */
    protected $amount_base_measurement_unit_name;

    /**
     * The value for the amount_measurement_unit_code field.
     * The code of the measurement unit for the amount of a sales order item.
     * @var        string|null
     */
    protected $amount_measurement_unit_code;

    /**
     * The value for the amount_measurement_unit_conversion field.
     * The conversion factor for the measurement unit of a sales order item's amount.
     * @var        double|null
     */
    protected $amount_measurement_unit_conversion;

    /**
     * The value for the amount_measurement_unit_name field.
     * The name of the measurement unit for the amount of a sales order item.
     * @var        string|null
     */
    protected $amount_measurement_unit_name;

    /**
     * The value for the amount_measurement_unit_precision field.
     * The precision of the measurement unit for the amount of a sales order item.
     * @var        int|null
     */
    protected $amount_measurement_unit_precision;

    /**
     * The value for the amount_sku field.
     * The SKU of the product representing the amount for a packaging unit.
     * @var        string|null
     */
    protected $amount_sku;

    /**
     * The value for the canceled_amount field.
     * The amount that has been canceled from an order item.
     * Note: this column has a database default value of: 0
     * @var        int|null
     */
    protected $canceled_amount;

    /**
     * The value for the cart_note field.
     * A note attached to the shopping cart.
     * @var        string|null
     */
    protected $cart_note;

    /**
     * The value for the discount_amount_aggregation field.
     * /Total discount amount for item/
     * Note: this column has a database default value of: 0
     * @var        int|null
     */
    protected $discount_amount_aggregation;

    /**
     * The value for the discount_amount_full_aggregation field.
     * /Total discount amount for item with options or item expenses/
     * Note: this column has a database default value of: 0
     * @var        int|null
     */
    protected $discount_amount_full_aggregation;

    /**
     * The value for the expense_price_aggregation field.
     * /Total price amount for item from item expenses/
     * Note: this column has a database default value of: 0
     * @var        int|null
     */
    protected $expense_price_aggregation;

    /**
     * The value for the gross_price field.
     * /price for one unit including tax, without shipping, coupons/
     * @var        int
     */
    protected $gross_price;

    /**
     * The value for the group_key field.
     *
     * @var        string|null
     */
    protected $group_key;

    /**
     * The value for the is_quantity_splittable field.
     * Indicates if the quantity of an order item can be split across multiple shipments.
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $is_quantity_splittable;

    /**
     * The value for the last_state_change field.
     * The timestamp of the last state change for an order item.
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime
     */
    protected $last_state_change;

    /**
     * The value for the merchant_commission_amount_aggregation field.
     * The aggregated net amount of merchant commissions for a sales order.
     * @var        int|null
     */
    protected $merchant_commission_amount_aggregation;

    /**
     * The value for the merchant_commission_amount_full_aggregation field.
     * The aggregated gross amount of merchant commissions for a sales order.
     * @var        int|null
     */
    protected $merchant_commission_amount_full_aggregation;

    /**
     * The value for the merchant_commission_refunded_amount field.
     * The total refunded commission amount for a sales order.
     * @var        int|null
     */
    protected $merchant_commission_refunded_amount;

    /**
     * The value for the merchant_reference field.
     * A unique reference identifier for a merchant.
     * @var        string|null
     */
    protected $merchant_reference;

    /**
     * The value for the name field.
     * The name of an entity (e.g., user, category, product, role).
     * @var        string
     */
    protected $name;

    /**
     * The value for the net_price field.
     * /Price for one unit not including tax, without shipping, coupons/
     * Note: this column has a database default value of: 0
     * @var        int|null
     */
    protected $net_price;

    /**
     * The value for the order_item_reference field.
     * A unique reference for a sales order item.
     * @var        string|null
     */
    protected $order_item_reference;

    /**
     * The value for the price field.
     * /Price for item, can be gross or net price depending on tax mode/
     * Note: this column has a database default value of: 0
     * @var        int|null
     */
    protected $price;

    /**
     * The value for the price_to_pay_aggregation field.
     * /Total item price to pay after discounts including options or item expenses/
     * Note: this column has a database default value of: 0
     * @var        int|null
     */
    protected $price_to_pay_aggregation;

    /**
     * The value for the product_offer_reference field.
     * A unique reference identifier for a specific product offer from a merchant.
     * @var        string|null
     */
    protected $product_offer_reference;

    /**
     * The value for the product_option_price_aggregation field.
     * /Total price amount for item from options/
     * Note: this column has a database default value of: 0
     * @var        int|null
     */
    protected $product_option_price_aggregation;

    /**
     * The value for the quantity field.
     * /Quantity ordered for item/
     * Note: this column has a database default value of: 1
     * @var        int
     */
    protected $quantity;

    /**
     * The value for the quantity_base_measurement_unit_name field.
     * The name of the base measurement unit for the quantity of a sales order item.
     * @var        string|null
     */
    protected $quantity_base_measurement_unit_name;

    /**
     * The value for the quantity_measurement_unit_code field.
     * The code of the measurement unit for the quantity of a sales order item.
     * @var        string|null
     */
    protected $quantity_measurement_unit_code;

    /**
     * The value for the quantity_measurement_unit_conversion field.
     * The conversion factor for the measurement unit of a sales order item's quantity.
     * @var        double|null
     */
    protected $quantity_measurement_unit_conversion;

    /**
     * The value for the quantity_measurement_unit_name field.
     * The name of the measurement unit for the quantity of a sales order item.
     * @var        string|null
     */
    protected $quantity_measurement_unit_name;

    /**
     * The value for the quantity_measurement_unit_precision field.
     * The precision of the measurement unit for the quantity of a sales order item.
     * @var        int|null
     */
    protected $quantity_measurement_unit_precision;

    /**
     * The value for the refundable_amount field.
     * /Total item refundable amount/
     * Note: this column has a database default value of: 0
     * @var        int|null
     */
    protected $refundable_amount;

    /**
     * The value for the remuneration_amount field.
     * The amount of remuneration (compensation) associated with a sales return.
     * @var        int|null
     */
    protected $remuneration_amount;

    /**
     * The value for the sku field.
     * The Stock Keeping Unit, a unique identifier for a concrete product.
     * @var        string
     */
    protected $sku;

    /**
     * The value for the subtotal_aggregation field.
     * /Subtotal price amount (item + options + item expenses) before discounts/
     * @var        int|null
     */
    protected $subtotal_aggregation;

    /**
     * The value for the tax_amount field.
     * /Calculated tax amount based on tax mode/
     * Note: this column has a database default value of: 0
     * @var        int|null
     */
    protected $tax_amount;

    /**
     * The value for the tax_amount_after_cancellation field.
     * /Calculated tax full amount based on tax mode, includes options, item expenses, /
     * Note: this column has a database default value of: 0
     * @var        int|null
     */
    protected $tax_amount_after_cancellation;

    /**
     * The value for the tax_amount_full_aggregation field.
     * /Calculated tax full amount based on tax mode, includes options, item expenses/
     * Note: this column has a database default value of: 0
     * @var        int|null
     */
    protected $tax_amount_full_aggregation;

    /**
     * The value for the tax_rate field.
     * The tax rate applied to an item.
     * @var        string|null
     */
    protected $tax_rate;

    /**
     * The value for the tax_rate_average_aggregation field.
     * /Calculated tax rate, includes options, item expenses, /
     * @var        string|null
     */
    protected $tax_rate_average_aggregation;

    /**
     * The value for the uuid field.
     * A Universally Unique Identifier for an entity.
     * @var        string|null
     */
    protected $uuid;

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
     * @var        SpySalesOrderItemBundle
     */
    protected $aSalesOrderItemBundle;

    /**
     * @var        ChildSpySalesOrder
     */
    protected $aOrder;

    /**
     * @var        SpyOmsOrderItemState
     */
    protected $aState;

    /**
     * @var        SpyOmsOrderProcess
     */
    protected $aProcess;

    /**
     * @var        ChildSpySalesShipment
     */
    protected $aSpySalesShipment;

    /**
     * @var        ObjectCollection|SpyMerchantSalesOrderItem[] Collection to store aggregation of SpyMerchantSalesOrderItem objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantSalesOrderItem> Collection to store aggregation of SpyMerchantSalesOrderItem objects.
     */
    protected $collMerchantSalesOrderItems;
    protected $collMerchantSalesOrderItemsPartial;

    /**
     * @var        ObjectCollection|SpyNopaymentPaid[] Collection to store aggregation of SpyNopaymentPaid objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyNopaymentPaid> Collection to store aggregation of SpyNopaymentPaid objects.
     */
    protected $collNopayments;
    protected $collNopaymentsPartial;

    /**
     * @var        ObjectCollection|SpyOmsTransitionLog[] Collection to store aggregation of SpyOmsTransitionLog objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyOmsTransitionLog> Collection to store aggregation of SpyOmsTransitionLog objects.
     */
    protected $collTransitionLogs;
    protected $collTransitionLogsPartial;

    /**
     * @var        ObjectCollection|SpyOmsOrderItemStateHistory[] Collection to store aggregation of SpyOmsOrderItemStateHistory objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyOmsOrderItemStateHistory> Collection to store aggregation of SpyOmsOrderItemStateHistory objects.
     */
    protected $collStateHistories;
    protected $collStateHistoriesPartial;

    /**
     * @var        ObjectCollection|SpyOmsEventTimeout[] Collection to store aggregation of SpyOmsEventTimeout objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyOmsEventTimeout> Collection to store aggregation of SpyOmsEventTimeout objects.
     */
    protected $collEventTimeouts;
    protected $collEventTimeoutsPartial;

    /**
     * @var        ObjectCollection|ChildSpySalesOrderItemMetadata[] Collection to store aggregation of ChildSpySalesOrderItemMetadata objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpySalesOrderItemMetadata> Collection to store aggregation of ChildSpySalesOrderItemMetadata objects.
     */
    protected $collMetadatas;
    protected $collMetadatasPartial;

    /**
     * @var        ObjectCollection|ChildSpySalesDiscount[] Collection to store aggregation of ChildSpySalesDiscount objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpySalesDiscount> Collection to store aggregation of ChildSpySalesDiscount objects.
     */
    protected $collDiscounts;
    protected $collDiscountsPartial;

    /**
     * @var        ObjectCollection|ChildSpySalesOrderItemOption[] Collection to store aggregation of ChildSpySalesOrderItemOption objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpySalesOrderItemOption> Collection to store aggregation of ChildSpySalesOrderItemOption objects.
     */
    protected $collOptions;
    protected $collOptionsPartial;

    /**
     * @var        ObjectCollection|SpySalesOrderConfiguredBundleItem[] Collection to store aggregation of SpySalesOrderConfiguredBundleItem objects.
     * @phpstan-var ObjectCollection&\Traversable<SpySalesOrderConfiguredBundleItem> Collection to store aggregation of SpySalesOrderConfiguredBundleItem objects.
     */
    protected $collSpySalesOrderConfiguredBundleItems;
    protected $collSpySalesOrderConfiguredBundleItemsPartial;

    /**
     * @var        ObjectCollection|SpySalesMerchantCommission[] Collection to store aggregation of SpySalesMerchantCommission objects.
     * @phpstan-var ObjectCollection&\Traversable<SpySalesMerchantCommission> Collection to store aggregation of SpySalesMerchantCommission objects.
     */
    protected $collSpySalesMerchantCommissions;
    protected $collSpySalesMerchantCommissionsPartial;

    /**
     * @var        ObjectCollection|SpySalesOrderItemConfiguration[] Collection to store aggregation of SpySalesOrderItemConfiguration objects.
     * @phpstan-var ObjectCollection&\Traversable<SpySalesOrderItemConfiguration> Collection to store aggregation of SpySalesOrderItemConfiguration objects.
     */
    protected $collSpySalesOrderItemConfigurations;
    protected $collSpySalesOrderItemConfigurationsPartial;

    /**
     * @var        ObjectCollection|SpySalesReclamationItem[] Collection to store aggregation of SpySalesReclamationItem objects.
     * @phpstan-var ObjectCollection&\Traversable<SpySalesReclamationItem> Collection to store aggregation of SpySalesReclamationItem objects.
     */
    protected $collReclamationItems;
    protected $collReclamationItemsPartial;

    /**
     * @var        ObjectCollection|SpySalesReturnItem[] Collection to store aggregation of SpySalesReturnItem objects.
     * @phpstan-var ObjectCollection&\Traversable<SpySalesReturnItem> Collection to store aggregation of SpySalesReturnItem objects.
     */
    protected $collSpySalesReturnItems;
    protected $collSpySalesReturnItemsPartial;

    /**
     * @var        ObjectCollection|SpySalesOrderItemServicePoint[] Collection to store aggregation of SpySalesOrderItemServicePoint objects.
     * @phpstan-var ObjectCollection&\Traversable<SpySalesOrderItemServicePoint> Collection to store aggregation of SpySalesOrderItemServicePoint objects.
     */
    protected $collSalesOrderItemServicePoints;
    protected $collSalesOrderItemServicePointsPartial;

    /**
     * @var        ObjectCollection|SpySalesOrderItemProductClass[] Collection to store aggregation of SpySalesOrderItemProductClass objects.
     * @phpstan-var ObjectCollection&\Traversable<SpySalesOrderItemProductClass> Collection to store aggregation of SpySalesOrderItemProductClass objects.
     */
    protected $collSpySalesOrderItemProductClasses;
    protected $collSpySalesOrderItemProductClassesPartial;

    /**
     * @var        ObjectCollection|SpySspInquirySalesOrderItem[] Collection to store aggregation of SpySspInquirySalesOrderItem objects.
     * @phpstan-var ObjectCollection&\Traversable<SpySspInquirySalesOrderItem> Collection to store aggregation of SpySspInquirySalesOrderItem objects.
     */
    protected $collSpySspInquirySalesOrderItems;
    protected $collSpySspInquirySalesOrderItemsPartial;

    /**
     * @var        ObjectCollection|SpySalesOrderItemSspAsset[] Collection to store aggregation of SpySalesOrderItemSspAsset objects.
     * @phpstan-var ObjectCollection&\Traversable<SpySalesOrderItemSspAsset> Collection to store aggregation of SpySalesOrderItemSspAsset objects.
     */
    protected $collSalesOrderItemSspAssets;
    protected $collSalesOrderItemSspAssetsPartial;

    /**
     * @var        ObjectCollection|SpySalesProductClass[] Cross Collection to store aggregation of SpySalesProductClass objects.
     * @phpstan-var ObjectCollection&\Traversable<SpySalesProductClass> Cross Collection to store aggregation of SpySalesProductClass objects.
     */
    protected $collSpySalesProductClasses;

    /**
     * @var bool
     */
    protected $collSpySalesProductClassesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    // uuid behavior
    /**
     * @var \Spryker\Service\UtilUuidGenerator\UtilUuidGeneratorServiceInterface
     */
    protected static $_uuidGeneratorService;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpySalesProductClass[]
     * @phpstan-var ObjectCollection&\Traversable<SpySalesProductClass>
     */
    protected $spySalesProductClassesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyMerchantSalesOrderItem[]
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantSalesOrderItem>
     */
    protected $merchantSalesOrderItemsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyNopaymentPaid[]
     * @phpstan-var ObjectCollection&\Traversable<SpyNopaymentPaid>
     */
    protected $nopaymentsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyOmsTransitionLog[]
     * @phpstan-var ObjectCollection&\Traversable<SpyOmsTransitionLog>
     */
    protected $transitionLogsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyOmsOrderItemStateHistory[]
     * @phpstan-var ObjectCollection&\Traversable<SpyOmsOrderItemStateHistory>
     */
    protected $stateHistoriesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyOmsEventTimeout[]
     * @phpstan-var ObjectCollection&\Traversable<SpyOmsEventTimeout>
     */
    protected $eventTimeoutsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpySalesOrderItemMetadata[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpySalesOrderItemMetadata>
     */
    protected $metadatasScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpySalesDiscount[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpySalesDiscount>
     */
    protected $discountsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpySalesOrderItemOption[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpySalesOrderItemOption>
     */
    protected $optionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpySalesOrderConfiguredBundleItem[]
     * @phpstan-var ObjectCollection&\Traversable<SpySalesOrderConfiguredBundleItem>
     */
    protected $spySalesOrderConfiguredBundleItemsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpySalesMerchantCommission[]
     * @phpstan-var ObjectCollection&\Traversable<SpySalesMerchantCommission>
     */
    protected $spySalesMerchantCommissionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpySalesOrderItemConfiguration[]
     * @phpstan-var ObjectCollection&\Traversable<SpySalesOrderItemConfiguration>
     */
    protected $spySalesOrderItemConfigurationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpySalesReclamationItem[]
     * @phpstan-var ObjectCollection&\Traversable<SpySalesReclamationItem>
     */
    protected $reclamationItemsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpySalesReturnItem[]
     * @phpstan-var ObjectCollection&\Traversable<SpySalesReturnItem>
     */
    protected $spySalesReturnItemsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpySalesOrderItemServicePoint[]
     * @phpstan-var ObjectCollection&\Traversable<SpySalesOrderItemServicePoint>
     */
    protected $salesOrderItemServicePointsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpySalesOrderItemProductClass[]
     * @phpstan-var ObjectCollection&\Traversable<SpySalesOrderItemProductClass>
     */
    protected $spySalesOrderItemProductClassesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpySspInquirySalesOrderItem[]
     * @phpstan-var ObjectCollection&\Traversable<SpySspInquirySalesOrderItem>
     */
    protected $spySspInquirySalesOrderItemsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpySalesOrderItemSspAsset[]
     * @phpstan-var ObjectCollection&\Traversable<SpySalesOrderItemSspAsset>
     */
    protected $salesOrderItemSspAssetsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->canceled_amount = 0;
        $this->discount_amount_aggregation = 0;
        $this->discount_amount_full_aggregation = 0;
        $this->expense_price_aggregation = 0;
        $this->is_quantity_splittable = true;
        $this->net_price = 0;
        $this->price = 0;
        $this->price_to_pay_aggregation = 0;
        $this->product_option_price_aggregation = 0;
        $this->quantity = 1;
        $this->refundable_amount = 0;
        $this->tax_amount = 0;
        $this->tax_amount_after_cancellation = 0;
        $this->tax_amount_full_aggregation = 0;
    }

    /**
     * Initializes internal state of Orm\Zed\Sales\Persistence\Base\SpySalesOrderItem object.
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
     * Compares this with another <code>SpySalesOrderItem</code> instance.  If
     * <code>obj</code> is an instance of <code>SpySalesOrderItem</code>, delegates to
     * <code>equals(SpySalesOrderItem)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_sales_order_item] column value.
     *
     * @return int
     */
    public function getIdSalesOrderItem()
    {
        return $this->id_sales_order_item;
    }

    /**
     * Get the [fk_oms_order_item_state] column value.
     *
     * @return int
     */
    public function getFkOmsOrderItemState()
    {
        return $this->fk_oms_order_item_state;
    }

    /**
     * Get the [fk_oms_order_process] column value.
     *
     * @return int|null
     */
    public function getFkOmsOrderProcess()
    {
        return $this->fk_oms_order_process;
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
     * Get the [fk_sales_order_item_bundle] column value.
     *
     * @return int|null
     */
    public function getFkSalesOrderItemBundle()
    {
        return $this->fk_sales_order_item_bundle;
    }

    /**
     * Get the [fk_sales_shipment] column value.
     *
     * @return int|null
     */
    public function getFkSalesShipment()
    {
        return $this->fk_sales_shipment;
    }

    /**
     * Get the [amount] column value.
     * A numerical value, often used for price, quantity, or discount.
     * @return string|null
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Get the [amount_base_measurement_unit_name] column value.
     * The name of the base measurement unit for the amount of a sales order item.
     * @return string|null
     */
    public function getAmountBaseMeasurementUnitName()
    {
        return $this->amount_base_measurement_unit_name;
    }

    /**
     * Get the [amount_measurement_unit_code] column value.
     * The code of the measurement unit for the amount of a sales order item.
     * @return string|null
     */
    public function getAmountMeasurementUnitCode()
    {
        return $this->amount_measurement_unit_code;
    }

    /**
     * Get the [amount_measurement_unit_conversion] column value.
     * The conversion factor for the measurement unit of a sales order item's amount.
     * @return double|null
     */
    public function getAmountMeasurementUnitConversion()
    {
        return $this->amount_measurement_unit_conversion;
    }

    /**
     * Get the [amount_measurement_unit_name] column value.
     * The name of the measurement unit for the amount of a sales order item.
     * @return string|null
     */
    public function getAmountMeasurementUnitName()
    {
        return $this->amount_measurement_unit_name;
    }

    /**
     * Get the [amount_measurement_unit_precision] column value.
     * The precision of the measurement unit for the amount of a sales order item.
     * @return int|null
     */
    public function getAmountMeasurementUnitPrecision()
    {
        return $this->amount_measurement_unit_precision;
    }

    /**
     * Get the [amount_sku] column value.
     * The SKU of the product representing the amount for a packaging unit.
     * @return string|null
     */
    public function getAmountSku()
    {
        return $this->amount_sku;
    }

    /**
     * Get the [canceled_amount] column value.
     * The amount that has been canceled from an order item.
     * @return int|null
     */
    public function getCanceledAmount()
    {
        return $this->canceled_amount;
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
     * Get the [discount_amount_aggregation] column value.
     * /Total discount amount for item/
     * @return int|null
     */
    public function getDiscountAmountAggregation()
    {
        return $this->discount_amount_aggregation;
    }

    /**
     * Get the [discount_amount_full_aggregation] column value.
     * /Total discount amount for item with options or item expenses/
     * @return int|null
     */
    public function getDiscountAmountFullAggregation()
    {
        return $this->discount_amount_full_aggregation;
    }

    /**
     * Get the [expense_price_aggregation] column value.
     * /Total price amount for item from item expenses/
     * @return int|null
     */
    public function getExpensePriceAggregation()
    {
        return $this->expense_price_aggregation;
    }

    /**
     * Get the [gross_price] column value.
     * /price for one unit including tax, without shipping, coupons/
     * @return int
     */
    public function getGrossPrice()
    {
        return $this->gross_price;
    }

    /**
     * Get the [group_key] column value.
     *
     * @return string|null
     */
    public function getGroupKey()
    {
        return $this->group_key;
    }

    /**
     * Get the [is_quantity_splittable] column value.
     * Indicates if the quantity of an order item can be split across multiple shipments.
     * @return boolean
     */
    public function getIsQuantitySplittable()
    {
        return $this->is_quantity_splittable;
    }

    /**
     * Get the [is_quantity_splittable] column value.
     * Indicates if the quantity of an order item can be split across multiple shipments.
     * @return boolean
     */
    public function isQuantitySplittable()
    {
        return $this->getIsQuantitySplittable();
    }

    /**
     * Get the [optionally formatted] temporal [last_state_change] column value.
     * The timestamp of the last state change for an order item.
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), and 0 if column value is 0000-00-00 00:00:00.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime : string)
     */
    public function getLastStateChange($format = null)
    {
        if ($format === null) {
            return $this->last_state_change;
        } else {
            return $this->last_state_change instanceof \DateTimeInterface ? $this->last_state_change->format($format) : null;
        }
    }

    /**
     * Get the [merchant_commission_amount_aggregation] column value.
     * The aggregated net amount of merchant commissions for a sales order.
     * @return int|null
     */
    public function getMerchantCommissionAmountAggregation()
    {
        return $this->merchant_commission_amount_aggregation;
    }

    /**
     * Get the [merchant_commission_amount_full_aggregation] column value.
     * The aggregated gross amount of merchant commissions for a sales order.
     * @return int|null
     */
    public function getMerchantCommissionAmountFullAggregation()
    {
        return $this->merchant_commission_amount_full_aggregation;
    }

    /**
     * Get the [merchant_commission_refunded_amount] column value.
     * The total refunded commission amount for a sales order.
     * @return int|null
     */
    public function getMerchantCommissionRefundedAmount()
    {
        return $this->merchant_commission_refunded_amount;
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [net_price] column value.
     * /Price for one unit not including tax, without shipping, coupons/
     * @return int|null
     */
    public function getNetPrice()
    {
        return $this->net_price;
    }

    /**
     * Get the [order_item_reference] column value.
     * A unique reference for a sales order item.
     * @return string|null
     */
    public function getOrderItemReference()
    {
        return $this->order_item_reference;
    }

    /**
     * Get the [price] column value.
     * /Price for item, can be gross or net price depending on tax mode/
     * @return int|null
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Get the [price_to_pay_aggregation] column value.
     * /Total item price to pay after discounts including options or item expenses/
     * @return int|null
     */
    public function getPriceToPayAggregation()
    {
        return $this->price_to_pay_aggregation;
    }

    /**
     * Get the [product_offer_reference] column value.
     * A unique reference identifier for a specific product offer from a merchant.
     * @return string|null
     */
    public function getProductOfferReference()
    {
        return $this->product_offer_reference;
    }

    /**
     * Get the [product_option_price_aggregation] column value.
     * /Total price amount for item from options/
     * @return int|null
     */
    public function getProductOptionPriceAggregation()
    {
        return $this->product_option_price_aggregation;
    }

    /**
     * Get the [quantity] column value.
     * /Quantity ordered for item/
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Get the [quantity_base_measurement_unit_name] column value.
     * The name of the base measurement unit for the quantity of a sales order item.
     * @return string|null
     */
    public function getQuantityBaseMeasurementUnitName()
    {
        return $this->quantity_base_measurement_unit_name;
    }

    /**
     * Get the [quantity_measurement_unit_code] column value.
     * The code of the measurement unit for the quantity of a sales order item.
     * @return string|null
     */
    public function getQuantityMeasurementUnitCode()
    {
        return $this->quantity_measurement_unit_code;
    }

    /**
     * Get the [quantity_measurement_unit_conversion] column value.
     * The conversion factor for the measurement unit of a sales order item's quantity.
     * @return double|null
     */
    public function getQuantityMeasurementUnitConversion()
    {
        return $this->quantity_measurement_unit_conversion;
    }

    /**
     * Get the [quantity_measurement_unit_name] column value.
     * The name of the measurement unit for the quantity of a sales order item.
     * @return string|null
     */
    public function getQuantityMeasurementUnitName()
    {
        return $this->quantity_measurement_unit_name;
    }

    /**
     * Get the [quantity_measurement_unit_precision] column value.
     * The precision of the measurement unit for the quantity of a sales order item.
     * @return int|null
     */
    public function getQuantityMeasurementUnitPrecision()
    {
        return $this->quantity_measurement_unit_precision;
    }

    /**
     * Get the [refundable_amount] column value.
     * /Total item refundable amount/
     * @return int|null
     */
    public function getRefundableAmount()
    {
        return $this->refundable_amount;
    }

    /**
     * Get the [remuneration_amount] column value.
     * The amount of remuneration (compensation) associated with a sales return.
     * @return int|null
     */
    public function getRemunerationAmount()
    {
        return $this->remuneration_amount;
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
     * Get the [subtotal_aggregation] column value.
     * /Subtotal price amount (item + options + item expenses) before discounts/
     * @return int|null
     */
    public function getSubtotalAggregation()
    {
        return $this->subtotal_aggregation;
    }

    /**
     * Get the [tax_amount] column value.
     * /Calculated tax amount based on tax mode/
     * @return int|null
     */
    public function getTaxAmount()
    {
        return $this->tax_amount;
    }

    /**
     * Get the [tax_amount_after_cancellation] column value.
     * /Calculated tax full amount based on tax mode, includes options, item expenses, /
     * @return int|null
     */
    public function getTaxAmountAfterCancellation()
    {
        return $this->tax_amount_after_cancellation;
    }

    /**
     * Get the [tax_amount_full_aggregation] column value.
     * /Calculated tax full amount based on tax mode, includes options, item expenses/
     * @return int|null
     */
    public function getTaxAmountFullAggregation()
    {
        return $this->tax_amount_full_aggregation;
    }

    /**
     * Get the [tax_rate] column value.
     * The tax rate applied to an item.
     * @return string|null
     */
    public function getTaxRate()
    {
        return $this->tax_rate;
    }

    /**
     * Get the [tax_rate_average_aggregation] column value.
     * /Calculated tax rate, includes options, item expenses, /
     * @return string|null
     */
    public function getTaxRateAverageAggregation()
    {
        return $this->tax_rate_average_aggregation;
    }

    /**
     * Get the [uuid] column value.
     * A Universally Unique Identifier for an entity.
     * @return string|null
     */
    public function getUuid()
    {
        return $this->uuid;
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
     * Set the value of [id_sales_order_item] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdSalesOrderItem($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_sales_order_item !== $v) {
            $this->id_sales_order_item = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_ID_SALES_ORDER_ITEM] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_oms_order_item_state] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkOmsOrderItemState($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_oms_order_item_state !== $v) {
            $this->fk_oms_order_item_state = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_FK_OMS_ORDER_ITEM_STATE] = true;
        }

        if ($this->aState !== null && $this->aState->getIdOmsOrderItemState() !== $v) {
            $this->aState = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_oms_order_process] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkOmsOrderProcess($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_oms_order_process !== $v) {
            $this->fk_oms_order_process = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_FK_OMS_ORDER_PROCESS] = true;
        }

        if ($this->aProcess !== null && $this->aProcess->getIdOmsOrderProcess() !== $v) {
            $this->aProcess = null;
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
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_FK_SALES_ORDER] = true;
        }

        if ($this->aOrder !== null && $this->aOrder->getIdSalesOrder() !== $v) {
            $this->aOrder = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_sales_order_item_bundle] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkSalesOrderItemBundle($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_sales_order_item_bundle !== $v) {
            $this->fk_sales_order_item_bundle = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_FK_SALES_ORDER_ITEM_BUNDLE] = true;
        }

        if ($this->aSalesOrderItemBundle !== null && $this->aSalesOrderItemBundle->getIdSalesOrderItemBundle() !== $v) {
            $this->aSalesOrderItemBundle = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_sales_shipment] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkSalesShipment($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_sales_shipment !== $v) {
            $this->fk_sales_shipment = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_FK_SALES_SHIPMENT] = true;
        }

        if ($this->aSpySalesShipment !== null && $this->aSpySalesShipment->getIdSalesShipment() !== $v) {
            $this->aSpySalesShipment = null;
        }

        return $this;
    }

    /**
     * Set the value of [amount] column.
     * A numerical value, often used for price, quantity, or discount.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->amount !== $v) {
            $this->amount = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [amount_base_measurement_unit_name] column.
     * The name of the base measurement unit for the amount of a sales order item.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAmountBaseMeasurementUnitName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->amount_base_measurement_unit_name !== $v) {
            $this->amount_base_measurement_unit_name = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_AMOUNT_BASE_MEASUREMENT_UNIT_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [amount_measurement_unit_code] column.
     * The code of the measurement unit for the amount of a sales order item.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAmountMeasurementUnitCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->amount_measurement_unit_code !== $v) {
            $this->amount_measurement_unit_code = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_AMOUNT_MEASUREMENT_UNIT_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [amount_measurement_unit_conversion] column.
     * The conversion factor for the measurement unit of a sales order item's amount.
     * @param double|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAmountMeasurementUnitConversion($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->amount_measurement_unit_conversion !== $v) {
            $this->amount_measurement_unit_conversion = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_AMOUNT_MEASUREMENT_UNIT_CONVERSION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [amount_measurement_unit_name] column.
     * The name of the measurement unit for the amount of a sales order item.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAmountMeasurementUnitName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->amount_measurement_unit_name !== $v) {
            $this->amount_measurement_unit_name = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_AMOUNT_MEASUREMENT_UNIT_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [amount_measurement_unit_precision] column.
     * The precision of the measurement unit for the amount of a sales order item.
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAmountMeasurementUnitPrecision($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->amount_measurement_unit_precision !== $v) {
            $this->amount_measurement_unit_precision = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_AMOUNT_MEASUREMENT_UNIT_PRECISION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [amount_sku] column.
     * The SKU of the product representing the amount for a packaging unit.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAmountSku($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->amount_sku !== $v) {
            $this->amount_sku = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_AMOUNT_SKU] = true;
        }

        return $this;
    }

    /**
     * Set the value of [canceled_amount] column.
     * The amount that has been canceled from an order item.
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCanceledAmount($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = true;

        if (($this->isNew() && $hasDefaultValue) || $this->canceled_amount !== $v) {
            $this->canceled_amount = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_CANCELED_AMOUNT] = true;
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
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_CART_NOTE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [discount_amount_aggregation] column.
     * /Total discount amount for item/
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDiscountAmountAggregation($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = true;

        if (($this->isNew() && $hasDefaultValue) || $this->discount_amount_aggregation !== $v) {
            $this->discount_amount_aggregation = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_DISCOUNT_AMOUNT_AGGREGATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [discount_amount_full_aggregation] column.
     * /Total discount amount for item with options or item expenses/
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDiscountAmountFullAggregation($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = true;

        if (($this->isNew() && $hasDefaultValue) || $this->discount_amount_full_aggregation !== $v) {
            $this->discount_amount_full_aggregation = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_DISCOUNT_AMOUNT_FULL_AGGREGATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [expense_price_aggregation] column.
     * /Total price amount for item from item expenses/
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExpensePriceAggregation($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = true;

        if (($this->isNew() && $hasDefaultValue) || $this->expense_price_aggregation !== $v) {
            $this->expense_price_aggregation = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_EXPENSE_PRICE_AGGREGATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [gross_price] column.
     * /price for one unit including tax, without shipping, coupons/
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setGrossPrice($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->gross_price !== $v) {
            $this->gross_price = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_GROSS_PRICE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [group_key] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setGroupKey($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->group_key !== $v) {
            $this->group_key = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_GROUP_KEY] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_quantity_splittable] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * Indicates if the quantity of an order item can be split across multiple shipments.
     * @param bool|integer|string $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsQuantitySplittable($v)
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

        if (($this->isNew() && $hasDefaultValue) || $this->is_quantity_splittable !== $v) {
            $this->is_quantity_splittable = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_IS_QUANTITY_SPLITTABLE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [last_state_change] column to a normalized version of the date/time value specified.
     * The timestamp of the last state change for an order item.
     * @param string|integer|\DateTimeInterface $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setLastStateChange($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->last_state_change !== null || $dt !== null) {
            if ($this->last_state_change === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->last_state_change->format("Y-m-d H:i:s.u")) {
                $this->last_state_change = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SpySalesOrderItemTableMap::COL_LAST_STATE_CHANGE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [merchant_commission_amount_aggregation] column.
     * The aggregated net amount of merchant commissions for a sales order.
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMerchantCommissionAmountAggregation($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->merchant_commission_amount_aggregation !== $v) {
            $this->merchant_commission_amount_aggregation = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_MERCHANT_COMMISSION_AMOUNT_AGGREGATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [merchant_commission_amount_full_aggregation] column.
     * The aggregated gross amount of merchant commissions for a sales order.
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMerchantCommissionAmountFullAggregation($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->merchant_commission_amount_full_aggregation !== $v) {
            $this->merchant_commission_amount_full_aggregation = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_MERCHANT_COMMISSION_AMOUNT_FULL_AGGREGATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [merchant_commission_refunded_amount] column.
     * The total refunded commission amount for a sales order.
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMerchantCommissionRefundedAmount($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->merchant_commission_refunded_amount !== $v) {
            $this->merchant_commission_refunded_amount = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_MERCHANT_COMMISSION_REFUNDED_AMOUNT] = true;
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
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_MERCHANT_REFERENCE] = true;
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
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [net_price] column.
     * /Price for one unit not including tax, without shipping, coupons/
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setNetPrice($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = true;

        if (($this->isNew() && $hasDefaultValue) || $this->net_price !== $v) {
            $this->net_price = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_NET_PRICE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [order_item_reference] column.
     * A unique reference for a sales order item.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrderItemReference($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->order_item_reference !== $v) {
            $this->order_item_reference = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_ORDER_ITEM_REFERENCE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [price] column.
     * /Price for item, can be gross or net price depending on tax mode/
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
        $hasDefaultValue = true;

        if (($this->isNew() && $hasDefaultValue) || $this->price !== $v) {
            $this->price = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_PRICE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [price_to_pay_aggregation] column.
     * /Total item price to pay after discounts including options or item expenses/
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPriceToPayAggregation($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = true;

        if (($this->isNew() && $hasDefaultValue) || $this->price_to_pay_aggregation !== $v) {
            $this->price_to_pay_aggregation = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_PRICE_TO_PAY_AGGREGATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [product_offer_reference] column.
     * A unique reference identifier for a specific product offer from a merchant.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProductOfferReference($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->product_offer_reference !== $v) {
            $this->product_offer_reference = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_PRODUCT_OFFER_REFERENCE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [product_option_price_aggregation] column.
     * /Total price amount for item from options/
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProductOptionPriceAggregation($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = true;

        if (($this->isNew() && $hasDefaultValue) || $this->product_option_price_aggregation !== $v) {
            $this->product_option_price_aggregation = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_PRODUCT_OPTION_PRICE_AGGREGATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [quantity] column.
     * /Quantity ordered for item/
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setQuantity($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = true;

        if (($this->isNew() && $hasDefaultValue) || $this->quantity !== $v) {
            $this->quantity = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_QUANTITY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [quantity_base_measurement_unit_name] column.
     * The name of the base measurement unit for the quantity of a sales order item.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setQuantityBaseMeasurementUnitName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->quantity_base_measurement_unit_name !== $v) {
            $this->quantity_base_measurement_unit_name = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_QUANTITY_BASE_MEASUREMENT_UNIT_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [quantity_measurement_unit_code] column.
     * The code of the measurement unit for the quantity of a sales order item.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setQuantityMeasurementUnitCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->quantity_measurement_unit_code !== $v) {
            $this->quantity_measurement_unit_code = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_QUANTITY_MEASUREMENT_UNIT_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [quantity_measurement_unit_conversion] column.
     * The conversion factor for the measurement unit of a sales order item's quantity.
     * @param double|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setQuantityMeasurementUnitConversion($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->quantity_measurement_unit_conversion !== $v) {
            $this->quantity_measurement_unit_conversion = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_QUANTITY_MEASUREMENT_UNIT_CONVERSION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [quantity_measurement_unit_name] column.
     * The name of the measurement unit for the quantity of a sales order item.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setQuantityMeasurementUnitName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->quantity_measurement_unit_name !== $v) {
            $this->quantity_measurement_unit_name = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_QUANTITY_MEASUREMENT_UNIT_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [quantity_measurement_unit_precision] column.
     * The precision of the measurement unit for the quantity of a sales order item.
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setQuantityMeasurementUnitPrecision($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->quantity_measurement_unit_precision !== $v) {
            $this->quantity_measurement_unit_precision = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_QUANTITY_MEASUREMENT_UNIT_PRECISION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [refundable_amount] column.
     * /Total item refundable amount/
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRefundableAmount($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = true;

        if (($this->isNew() && $hasDefaultValue) || $this->refundable_amount !== $v) {
            $this->refundable_amount = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_REFUNDABLE_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [remuneration_amount] column.
     * The amount of remuneration (compensation) associated with a sales return.
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRemunerationAmount($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->remuneration_amount !== $v) {
            $this->remuneration_amount = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_REMUNERATION_AMOUNT] = true;
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
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_SKU] = true;
        }

        return $this;
    }

    /**
     * Set the value of [subtotal_aggregation] column.
     * /Subtotal price amount (item + options + item expenses) before discounts/
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSubtotalAggregation($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->subtotal_aggregation !== $v) {
            $this->subtotal_aggregation = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_SUBTOTAL_AGGREGATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [tax_amount] column.
     * /Calculated tax amount based on tax mode/
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTaxAmount($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = true;

        if (($this->isNew() && $hasDefaultValue) || $this->tax_amount !== $v) {
            $this->tax_amount = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_TAX_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [tax_amount_after_cancellation] column.
     * /Calculated tax full amount based on tax mode, includes options, item expenses, /
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTaxAmountAfterCancellation($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = true;

        if (($this->isNew() && $hasDefaultValue) || $this->tax_amount_after_cancellation !== $v) {
            $this->tax_amount_after_cancellation = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_TAX_AMOUNT_AFTER_CANCELLATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [tax_amount_full_aggregation] column.
     * /Calculated tax full amount based on tax mode, includes options, item expenses/
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTaxAmountFullAggregation($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = true;

        if (($this->isNew() && $hasDefaultValue) || $this->tax_amount_full_aggregation !== $v) {
            $this->tax_amount_full_aggregation = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_TAX_AMOUNT_FULL_AGGREGATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [tax_rate] column.
     * The tax rate applied to an item.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTaxRate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->tax_rate !== $v) {
            $this->tax_rate = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_TAX_RATE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [tax_rate_average_aggregation] column.
     * /Calculated tax rate, includes options, item expenses, /
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTaxRateAverageAggregation($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->tax_rate_average_aggregation !== $v) {
            $this->tax_rate_average_aggregation = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_TAX_RATE_AVERAGE_AGGREGATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [uuid] column.
     * A Universally Unique Identifier for an entity.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setUuid($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->uuid !== $v) {
            $this->uuid = $v;
            $this->modifiedColumns[SpySalesOrderItemTableMap::COL_UUID] = true;
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
                $this->modifiedColumns[SpySalesOrderItemTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SpySalesOrderItemTableMap::COL_UPDATED_AT] = true;
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
            if ($this->canceled_amount !== 0) {
                return false;
            }

            if ($this->discount_amount_aggregation !== 0) {
                return false;
            }

            if ($this->discount_amount_full_aggregation !== 0) {
                return false;
            }

            if ($this->expense_price_aggregation !== 0) {
                return false;
            }

            if ($this->is_quantity_splittable !== true) {
                return false;
            }

            if ($this->net_price !== 0) {
                return false;
            }

            if ($this->price !== 0) {
                return false;
            }

            if ($this->price_to_pay_aggregation !== 0) {
                return false;
            }

            if ($this->product_option_price_aggregation !== 0) {
                return false;
            }

            if ($this->quantity !== 1) {
                return false;
            }

            if ($this->refundable_amount !== 0) {
                return false;
            }

            if ($this->tax_amount !== 0) {
                return false;
            }

            if ($this->tax_amount_after_cancellation !== 0) {
                return false;
            }

            if ($this->tax_amount_full_aggregation !== 0) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpySalesOrderItemTableMap::translateFieldName('IdSalesOrderItem', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_sales_order_item = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpySalesOrderItemTableMap::translateFieldName('FkOmsOrderItemState', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_oms_order_item_state = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpySalesOrderItemTableMap::translateFieldName('FkOmsOrderProcess', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_oms_order_process = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpySalesOrderItemTableMap::translateFieldName('FkSalesOrder', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_sales_order = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpySalesOrderItemTableMap::translateFieldName('FkSalesOrderItemBundle', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_sales_order_item_bundle = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpySalesOrderItemTableMap::translateFieldName('FkSalesShipment', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_sales_shipment = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpySalesOrderItemTableMap::translateFieldName('Amount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpySalesOrderItemTableMap::translateFieldName('AmountBaseMeasurementUnitName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->amount_base_measurement_unit_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SpySalesOrderItemTableMap::translateFieldName('AmountMeasurementUnitCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->amount_measurement_unit_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SpySalesOrderItemTableMap::translateFieldName('AmountMeasurementUnitConversion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->amount_measurement_unit_conversion = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SpySalesOrderItemTableMap::translateFieldName('AmountMeasurementUnitName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->amount_measurement_unit_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : SpySalesOrderItemTableMap::translateFieldName('AmountMeasurementUnitPrecision', TableMap::TYPE_PHPNAME, $indexType)];
            $this->amount_measurement_unit_precision = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : SpySalesOrderItemTableMap::translateFieldName('AmountSku', TableMap::TYPE_PHPNAME, $indexType)];
            $this->amount_sku = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : SpySalesOrderItemTableMap::translateFieldName('CanceledAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->canceled_amount = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : SpySalesOrderItemTableMap::translateFieldName('CartNote', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cart_note = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : SpySalesOrderItemTableMap::translateFieldName('DiscountAmountAggregation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->discount_amount_aggregation = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : SpySalesOrderItemTableMap::translateFieldName('DiscountAmountFullAggregation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->discount_amount_full_aggregation = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : SpySalesOrderItemTableMap::translateFieldName('ExpensePriceAggregation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->expense_price_aggregation = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : SpySalesOrderItemTableMap::translateFieldName('GrossPrice', TableMap::TYPE_PHPNAME, $indexType)];
            $this->gross_price = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : SpySalesOrderItemTableMap::translateFieldName('GroupKey', TableMap::TYPE_PHPNAME, $indexType)];
            $this->group_key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : SpySalesOrderItemTableMap::translateFieldName('IsQuantitySplittable', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_quantity_splittable = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : SpySalesOrderItemTableMap::translateFieldName('LastStateChange', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->last_state_change = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : SpySalesOrderItemTableMap::translateFieldName('MerchantCommissionAmountAggregation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->merchant_commission_amount_aggregation = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : SpySalesOrderItemTableMap::translateFieldName('MerchantCommissionAmountFullAggregation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->merchant_commission_amount_full_aggregation = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : SpySalesOrderItemTableMap::translateFieldName('MerchantCommissionRefundedAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->merchant_commission_refunded_amount = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : SpySalesOrderItemTableMap::translateFieldName('MerchantReference', TableMap::TYPE_PHPNAME, $indexType)];
            $this->merchant_reference = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : SpySalesOrderItemTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : SpySalesOrderItemTableMap::translateFieldName('NetPrice', TableMap::TYPE_PHPNAME, $indexType)];
            $this->net_price = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 28 + $startcol : SpySalesOrderItemTableMap::translateFieldName('OrderItemReference', TableMap::TYPE_PHPNAME, $indexType)];
            $this->order_item_reference = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 29 + $startcol : SpySalesOrderItemTableMap::translateFieldName('Price', TableMap::TYPE_PHPNAME, $indexType)];
            $this->price = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 30 + $startcol : SpySalesOrderItemTableMap::translateFieldName('PriceToPayAggregation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->price_to_pay_aggregation = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 31 + $startcol : SpySalesOrderItemTableMap::translateFieldName('ProductOfferReference', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_offer_reference = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 32 + $startcol : SpySalesOrderItemTableMap::translateFieldName('ProductOptionPriceAggregation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_option_price_aggregation = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 33 + $startcol : SpySalesOrderItemTableMap::translateFieldName('Quantity', TableMap::TYPE_PHPNAME, $indexType)];
            $this->quantity = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 34 + $startcol : SpySalesOrderItemTableMap::translateFieldName('QuantityBaseMeasurementUnitName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->quantity_base_measurement_unit_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 35 + $startcol : SpySalesOrderItemTableMap::translateFieldName('QuantityMeasurementUnitCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->quantity_measurement_unit_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 36 + $startcol : SpySalesOrderItemTableMap::translateFieldName('QuantityMeasurementUnitConversion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->quantity_measurement_unit_conversion = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 37 + $startcol : SpySalesOrderItemTableMap::translateFieldName('QuantityMeasurementUnitName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->quantity_measurement_unit_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 38 + $startcol : SpySalesOrderItemTableMap::translateFieldName('QuantityMeasurementUnitPrecision', TableMap::TYPE_PHPNAME, $indexType)];
            $this->quantity_measurement_unit_precision = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 39 + $startcol : SpySalesOrderItemTableMap::translateFieldName('RefundableAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->refundable_amount = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 40 + $startcol : SpySalesOrderItemTableMap::translateFieldName('RemunerationAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->remuneration_amount = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 41 + $startcol : SpySalesOrderItemTableMap::translateFieldName('Sku', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sku = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 42 + $startcol : SpySalesOrderItemTableMap::translateFieldName('SubtotalAggregation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->subtotal_aggregation = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 43 + $startcol : SpySalesOrderItemTableMap::translateFieldName('TaxAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tax_amount = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 44 + $startcol : SpySalesOrderItemTableMap::translateFieldName('TaxAmountAfterCancellation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tax_amount_after_cancellation = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 45 + $startcol : SpySalesOrderItemTableMap::translateFieldName('TaxAmountFullAggregation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tax_amount_full_aggregation = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 46 + $startcol : SpySalesOrderItemTableMap::translateFieldName('TaxRate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tax_rate = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 47 + $startcol : SpySalesOrderItemTableMap::translateFieldName('TaxRateAverageAggregation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tax_rate_average_aggregation = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 48 + $startcol : SpySalesOrderItemTableMap::translateFieldName('Uuid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->uuid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 49 + $startcol : SpySalesOrderItemTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 50 + $startcol : SpySalesOrderItemTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 51; // 51 = SpySalesOrderItemTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrderItem'), 0, $e);
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
        if ($this->aState !== null && $this->fk_oms_order_item_state !== $this->aState->getIdOmsOrderItemState()) {
            $this->aState = null;
        }
        if ($this->aProcess !== null && $this->fk_oms_order_process !== $this->aProcess->getIdOmsOrderProcess()) {
            $this->aProcess = null;
        }
        if ($this->aOrder !== null && $this->fk_sales_order !== $this->aOrder->getIdSalesOrder()) {
            $this->aOrder = null;
        }
        if ($this->aSalesOrderItemBundle !== null && $this->fk_sales_order_item_bundle !== $this->aSalesOrderItemBundle->getIdSalesOrderItemBundle()) {
            $this->aSalesOrderItemBundle = null;
        }
        if ($this->aSpySalesShipment !== null && $this->fk_sales_shipment !== $this->aSpySalesShipment->getIdSalesShipment()) {
            $this->aSpySalesShipment = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpySalesOrderItemTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpySalesOrderItemQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aSalesOrderItemBundle = null;
            $this->aOrder = null;
            $this->aState = null;
            $this->aProcess = null;
            $this->aSpySalesShipment = null;
            $this->collMerchantSalesOrderItems = null;

            $this->collNopayments = null;

            $this->collTransitionLogs = null;

            $this->collStateHistories = null;

            $this->collEventTimeouts = null;

            $this->collMetadatas = null;

            $this->collDiscounts = null;

            $this->collOptions = null;

            $this->collSpySalesOrderConfiguredBundleItems = null;

            $this->collSpySalesMerchantCommissions = null;

            $this->collSpySalesOrderItemConfigurations = null;

            $this->collReclamationItems = null;

            $this->collSpySalesReturnItems = null;

            $this->collSalesOrderItemServicePoints = null;

            $this->collSpySalesOrderItemProductClasses = null;

            $this->collSpySspInquirySalesOrderItems = null;

            $this->collSalesOrderItemSspAssets = null;

            $this->collSpySalesProductClasses = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpySalesOrderItem::setDeleted()
     * @see SpySalesOrderItem::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderItemTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpySalesOrderItemQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderItemTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                $time = time();
                $highPrecision = \Propel\Runtime\Util\PropelDateTime::createHighPrecision();
                if (!$this->isColumnModified(SpySalesOrderItemTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpySalesOrderItemTableMap::COL_UPDATED_AT)) {
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
                // uuid behavior
                $this->updateUuidBeforeUpdate();
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(SpySalesOrderItemTableMap::COL_UPDATED_AT)) {
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
                    // uuid behavior
                    $this->updateUuidAfterInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                SpySalesOrderItemTableMap::addInstanceToPool($this);
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

            if ($this->aSalesOrderItemBundle !== null) {
                if ($this->aSalesOrderItemBundle->isModified() || $this->aSalesOrderItemBundle->isNew()) {
                    $affectedRows += $this->aSalesOrderItemBundle->save($con);
                }
                $this->setSalesOrderItemBundle($this->aSalesOrderItemBundle);
            }

            if ($this->aOrder !== null) {
                if ($this->aOrder->isModified() || $this->aOrder->isNew()) {
                    $affectedRows += $this->aOrder->save($con);
                }
                $this->setOrder($this->aOrder);
            }

            if ($this->aState !== null) {
                if ($this->aState->isModified() || $this->aState->isNew()) {
                    $affectedRows += $this->aState->save($con);
                }
                $this->setState($this->aState);
            }

            if ($this->aProcess !== null) {
                if ($this->aProcess->isModified() || $this->aProcess->isNew()) {
                    $affectedRows += $this->aProcess->save($con);
                }
                $this->setProcess($this->aProcess);
            }

            if ($this->aSpySalesShipment !== null) {
                if ($this->aSpySalesShipment->isModified() || $this->aSpySalesShipment->isNew()) {
                    $affectedRows += $this->aSpySalesShipment->save($con);
                }
                $this->setSpySalesShipment($this->aSpySalesShipment);
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

            if ($this->spySalesProductClassesScheduledForDeletion !== null) {
                if (!$this->spySalesProductClassesScheduledForDeletion->isEmpty()) {
                    $pks = [];
                    foreach ($this->spySalesProductClassesScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[0] = $this->getIdSalesOrderItem();
                        $entryPk[1] = $entry->getIdSalesProductClass();
                        $pks[] = $entryPk;
                    }

                    \Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemProductClassQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->spySalesProductClassesScheduledForDeletion = null;
                }

            }

            if ($this->collSpySalesProductClasses) {
                foreach ($this->collSpySalesProductClasses as $spySalesProductClass) {
                    if (!$spySalesProductClass->isDeleted() && ($spySalesProductClass->isNew() || $spySalesProductClass->isModified())) {
                        $spySalesProductClass->save($con);
                    }
                }
            }


            if ($this->merchantSalesOrderItemsScheduledForDeletion !== null) {
                if (!$this->merchantSalesOrderItemsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderItemQuery::create()
                        ->filterByPrimaryKeys($this->merchantSalesOrderItemsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->merchantSalesOrderItemsScheduledForDeletion = null;
                }
            }

            if ($this->collMerchantSalesOrderItems !== null) {
                foreach ($this->collMerchantSalesOrderItems as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->nopaymentsScheduledForDeletion !== null) {
                if (!$this->nopaymentsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Nopayment\Persistence\SpyNopaymentPaidQuery::create()
                        ->filterByPrimaryKeys($this->nopaymentsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->nopaymentsScheduledForDeletion = null;
                }
            }

            if ($this->collNopayments !== null) {
                foreach ($this->collNopayments as $referrerFK) {
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

            if ($this->stateHistoriesScheduledForDeletion !== null) {
                if (!$this->stateHistoriesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateHistoryQuery::create()
                        ->filterByPrimaryKeys($this->stateHistoriesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->stateHistoriesScheduledForDeletion = null;
                }
            }

            if ($this->collStateHistories !== null) {
                foreach ($this->collStateHistories as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->eventTimeoutsScheduledForDeletion !== null) {
                if (!$this->eventTimeoutsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Oms\Persistence\SpyOmsEventTimeoutQuery::create()
                        ->filterByPrimaryKeys($this->eventTimeoutsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->eventTimeoutsScheduledForDeletion = null;
                }
            }

            if ($this->collEventTimeouts !== null) {
                foreach ($this->collEventTimeouts as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->metadatasScheduledForDeletion !== null) {
                if (!$this->metadatasScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Sales\Persistence\SpySalesOrderItemMetadataQuery::create()
                        ->filterByPrimaryKeys($this->metadatasScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->metadatasScheduledForDeletion = null;
                }
            }

            if ($this->collMetadatas !== null) {
                foreach ($this->collMetadatas as $referrerFK) {
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

            if ($this->optionsScheduledForDeletion !== null) {
                if (!$this->optionsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Sales\Persistence\SpySalesOrderItemOptionQuery::create()
                        ->filterByPrimaryKeys($this->optionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->optionsScheduledForDeletion = null;
                }
            }

            if ($this->collOptions !== null) {
                foreach ($this->collOptions as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spySalesOrderConfiguredBundleItemsScheduledForDeletion !== null) {
                if (!$this->spySalesOrderConfiguredBundleItemsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\SalesConfigurableBundle\Persistence\SpySalesOrderConfiguredBundleItemQuery::create()
                        ->filterByPrimaryKeys($this->spySalesOrderConfiguredBundleItemsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spySalesOrderConfiguredBundleItemsScheduledForDeletion = null;
                }
            }

            if ($this->collSpySalesOrderConfiguredBundleItems !== null) {
                foreach ($this->collSpySalesOrderConfiguredBundleItems as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spySalesMerchantCommissionsScheduledForDeletion !== null) {
                if (!$this->spySalesMerchantCommissionsScheduledForDeletion->isEmpty()) {
                    foreach ($this->spySalesMerchantCommissionsScheduledForDeletion as $spySalesMerchantCommission) {
                        // need to save related object because we set the relation to null
                        $spySalesMerchantCommission->save($con);
                    }
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

            if ($this->spySalesOrderItemConfigurationsScheduledForDeletion !== null) {
                if (!$this->spySalesOrderItemConfigurationsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\SalesProductConfiguration\Persistence\SpySalesOrderItemConfigurationQuery::create()
                        ->filterByPrimaryKeys($this->spySalesOrderItemConfigurationsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spySalesOrderItemConfigurationsScheduledForDeletion = null;
                }
            }

            if ($this->collSpySalesOrderItemConfigurations !== null) {
                foreach ($this->collSpySalesOrderItemConfigurations as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->reclamationItemsScheduledForDeletion !== null) {
                if (!$this->reclamationItemsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationItemQuery::create()
                        ->filterByPrimaryKeys($this->reclamationItemsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->reclamationItemsScheduledForDeletion = null;
                }
            }

            if ($this->collReclamationItems !== null) {
                foreach ($this->collReclamationItems as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spySalesReturnItemsScheduledForDeletion !== null) {
                if (!$this->spySalesReturnItemsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\SalesReturn\Persistence\SpySalesReturnItemQuery::create()
                        ->filterByPrimaryKeys($this->spySalesReturnItemsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spySalesReturnItemsScheduledForDeletion = null;
                }
            }

            if ($this->collSpySalesReturnItems !== null) {
                foreach ($this->collSpySalesReturnItems as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->salesOrderItemServicePointsScheduledForDeletion !== null) {
                if (!$this->salesOrderItemServicePointsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\SalesServicePoint\Persistence\SpySalesOrderItemServicePointQuery::create()
                        ->filterByPrimaryKeys($this->salesOrderItemServicePointsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->salesOrderItemServicePointsScheduledForDeletion = null;
                }
            }

            if ($this->collSalesOrderItemServicePoints !== null) {
                foreach ($this->collSalesOrderItemServicePoints as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spySalesOrderItemProductClassesScheduledForDeletion !== null) {
                if (!$this->spySalesOrderItemProductClassesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemProductClassQuery::create()
                        ->filterByPrimaryKeys($this->spySalesOrderItemProductClassesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spySalesOrderItemProductClassesScheduledForDeletion = null;
                }
            }

            if ($this->collSpySalesOrderItemProductClasses !== null) {
                foreach ($this->collSpySalesOrderItemProductClasses as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spySspInquirySalesOrderItemsScheduledForDeletion !== null) {
                if (!$this->spySspInquirySalesOrderItemsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderItemQuery::create()
                        ->filterByPrimaryKeys($this->spySspInquirySalesOrderItemsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spySspInquirySalesOrderItemsScheduledForDeletion = null;
                }
            }

            if ($this->collSpySspInquirySalesOrderItems !== null) {
                foreach ($this->collSpySspInquirySalesOrderItems as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->salesOrderItemSspAssetsScheduledForDeletion !== null) {
                if (!$this->salesOrderItemSspAssetsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemSspAssetQuery::create()
                        ->filterByPrimaryKeys($this->salesOrderItemSspAssetsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->salesOrderItemSspAssetsScheduledForDeletion = null;
                }
            }

            if ($this->collSalesOrderItemSspAssets !== null) {
                foreach ($this->collSalesOrderItemSspAssets as $referrerFK) {
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

        $this->modifiedColumns[SpySalesOrderItemTableMap::COL_ID_SALES_ORDER_ITEM] = true;

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_ID_SALES_ORDER_ITEM)) {
            $modifiedColumns[':p' . $index++]  = 'id_sales_order_item';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_FK_OMS_ORDER_ITEM_STATE)) {
            $modifiedColumns[':p' . $index++]  = 'fk_oms_order_item_state';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_FK_OMS_ORDER_PROCESS)) {
            $modifiedColumns[':p' . $index++]  = 'fk_oms_order_process';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_FK_SALES_ORDER)) {
            $modifiedColumns[':p' . $index++]  = 'fk_sales_order';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_FK_SALES_ORDER_ITEM_BUNDLE)) {
            $modifiedColumns[':p' . $index++]  = 'fk_sales_order_item_bundle';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_FK_SALES_SHIPMENT)) {
            $modifiedColumns[':p' . $index++]  = 'fk_sales_shipment';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_AMOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'amount';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_AMOUNT_BASE_MEASUREMENT_UNIT_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'amount_base_measurement_unit_name';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_AMOUNT_MEASUREMENT_UNIT_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'amount_measurement_unit_code';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_AMOUNT_MEASUREMENT_UNIT_CONVERSION)) {
            $modifiedColumns[':p' . $index++]  = 'amount_measurement_unit_conversion';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_AMOUNT_MEASUREMENT_UNIT_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'amount_measurement_unit_name';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_AMOUNT_MEASUREMENT_UNIT_PRECISION)) {
            $modifiedColumns[':p' . $index++]  = 'amount_measurement_unit_precision';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_AMOUNT_SKU)) {
            $modifiedColumns[':p' . $index++]  = 'amount_sku';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_CANCELED_AMOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'canceled_amount';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_CART_NOTE)) {
            $modifiedColumns[':p' . $index++]  = 'cart_note';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_DISCOUNT_AMOUNT_AGGREGATION)) {
            $modifiedColumns[':p' . $index++]  = 'discount_amount_aggregation';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_DISCOUNT_AMOUNT_FULL_AGGREGATION)) {
            $modifiedColumns[':p' . $index++]  = 'discount_amount_full_aggregation';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_EXPENSE_PRICE_AGGREGATION)) {
            $modifiedColumns[':p' . $index++]  = 'expense_price_aggregation';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_GROSS_PRICE)) {
            $modifiedColumns[':p' . $index++]  = 'gross_price';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_GROUP_KEY)) {
            $modifiedColumns[':p' . $index++]  = 'group_key';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_IS_QUANTITY_SPLITTABLE)) {
            $modifiedColumns[':p' . $index++]  = 'is_quantity_splittable';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_LAST_STATE_CHANGE)) {
            $modifiedColumns[':p' . $index++]  = 'last_state_change';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_MERCHANT_COMMISSION_AMOUNT_AGGREGATION)) {
            $modifiedColumns[':p' . $index++]  = 'merchant_commission_amount_aggregation';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_MERCHANT_COMMISSION_AMOUNT_FULL_AGGREGATION)) {
            $modifiedColumns[':p' . $index++]  = 'merchant_commission_amount_full_aggregation';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_MERCHANT_COMMISSION_REFUNDED_AMOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'merchant_commission_refunded_amount';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_MERCHANT_REFERENCE)) {
            $modifiedColumns[':p' . $index++]  = 'merchant_reference';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_NET_PRICE)) {
            $modifiedColumns[':p' . $index++]  = 'net_price';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_ORDER_ITEM_REFERENCE)) {
            $modifiedColumns[':p' . $index++]  = 'order_item_reference';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_PRICE)) {
            $modifiedColumns[':p' . $index++]  = 'price';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_PRICE_TO_PAY_AGGREGATION)) {
            $modifiedColumns[':p' . $index++]  = 'price_to_pay_aggregation';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_PRODUCT_OFFER_REFERENCE)) {
            $modifiedColumns[':p' . $index++]  = 'product_offer_reference';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_PRODUCT_OPTION_PRICE_AGGREGATION)) {
            $modifiedColumns[':p' . $index++]  = 'product_option_price_aggregation';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_QUANTITY)) {
            $modifiedColumns[':p' . $index++]  = 'quantity';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_QUANTITY_BASE_MEASUREMENT_UNIT_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'quantity_base_measurement_unit_name';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_QUANTITY_MEASUREMENT_UNIT_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'quantity_measurement_unit_code';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_QUANTITY_MEASUREMENT_UNIT_CONVERSION)) {
            $modifiedColumns[':p' . $index++]  = 'quantity_measurement_unit_conversion';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_QUANTITY_MEASUREMENT_UNIT_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'quantity_measurement_unit_name';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_QUANTITY_MEASUREMENT_UNIT_PRECISION)) {
            $modifiedColumns[':p' . $index++]  = 'quantity_measurement_unit_precision';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_REFUNDABLE_AMOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'refundable_amount';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_REMUNERATION_AMOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'remuneration_amount';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_SKU)) {
            $modifiedColumns[':p' . $index++]  = 'sku';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_SUBTOTAL_AGGREGATION)) {
            $modifiedColumns[':p' . $index++]  = 'subtotal_aggregation';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_TAX_AMOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'tax_amount';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_TAX_AMOUNT_AFTER_CANCELLATION)) {
            $modifiedColumns[':p' . $index++]  = 'tax_amount_after_cancellation';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_TAX_AMOUNT_FULL_AGGREGATION)) {
            $modifiedColumns[':p' . $index++]  = 'tax_amount_full_aggregation';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_TAX_RATE)) {
            $modifiedColumns[':p' . $index++]  = 'tax_rate';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_TAX_RATE_AVERAGE_AGGREGATION)) {
            $modifiedColumns[':p' . $index++]  = 'tax_rate_average_aggregation';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_UUID)) {
            $modifiedColumns[':p' . $index++]  = 'uuid';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO spy_sales_order_item (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_sales_order_item':
                        $stmt->bindValue($identifier, $this->id_sales_order_item, PDO::PARAM_INT);

                        break;
                    case 'fk_oms_order_item_state':
                        $stmt->bindValue($identifier, $this->fk_oms_order_item_state, PDO::PARAM_INT);

                        break;
                    case 'fk_oms_order_process':
                        $stmt->bindValue($identifier, $this->fk_oms_order_process, PDO::PARAM_INT);

                        break;
                    case 'fk_sales_order':
                        $stmt->bindValue($identifier, $this->fk_sales_order, PDO::PARAM_INT);

                        break;
                    case 'fk_sales_order_item_bundle':
                        $stmt->bindValue($identifier, $this->fk_sales_order_item_bundle, PDO::PARAM_INT);

                        break;
                    case 'fk_sales_shipment':
                        $stmt->bindValue($identifier, $this->fk_sales_shipment, PDO::PARAM_INT);

                        break;
                    case 'amount':
                        $stmt->bindValue($identifier, $this->amount, PDO::PARAM_STR);

                        break;
                    case 'amount_base_measurement_unit_name':
                        $stmt->bindValue($identifier, $this->amount_base_measurement_unit_name, PDO::PARAM_STR);

                        break;
                    case 'amount_measurement_unit_code':
                        $stmt->bindValue($identifier, $this->amount_measurement_unit_code, PDO::PARAM_STR);

                        break;
                    case 'amount_measurement_unit_conversion':
                        $stmt->bindValue($identifier, $this->amount_measurement_unit_conversion, PDO::PARAM_STR);

                        break;
                    case 'amount_measurement_unit_name':
                        $stmt->bindValue($identifier, $this->amount_measurement_unit_name, PDO::PARAM_STR);

                        break;
                    case 'amount_measurement_unit_precision':
                        $stmt->bindValue($identifier, $this->amount_measurement_unit_precision, PDO::PARAM_INT);

                        break;
                    case 'amount_sku':
                        $stmt->bindValue($identifier, $this->amount_sku, PDO::PARAM_STR);

                        break;
                    case 'canceled_amount':
                        $stmt->bindValue($identifier, $this->canceled_amount, PDO::PARAM_INT);

                        break;
                    case 'cart_note':
                        $stmt->bindValue($identifier, $this->cart_note, PDO::PARAM_STR);

                        break;
                    case 'discount_amount_aggregation':
                        $stmt->bindValue($identifier, $this->discount_amount_aggregation, PDO::PARAM_INT);

                        break;
                    case 'discount_amount_full_aggregation':
                        $stmt->bindValue($identifier, $this->discount_amount_full_aggregation, PDO::PARAM_INT);

                        break;
                    case 'expense_price_aggregation':
                        $stmt->bindValue($identifier, $this->expense_price_aggregation, PDO::PARAM_INT);

                        break;
                    case 'gross_price':
                        $stmt->bindValue($identifier, $this->gross_price, PDO::PARAM_INT);

                        break;
                    case 'group_key':
                        $stmt->bindValue($identifier, $this->group_key, PDO::PARAM_STR);

                        break;
                    case 'is_quantity_splittable':
                        $stmt->bindValue($identifier, (int) $this->is_quantity_splittable, PDO::PARAM_INT);

                        break;
                    case 'last_state_change':
                        $stmt->bindValue($identifier, $this->last_state_change ? $this->last_state_change->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'merchant_commission_amount_aggregation':
                        $stmt->bindValue($identifier, $this->merchant_commission_amount_aggregation, PDO::PARAM_INT);

                        break;
                    case 'merchant_commission_amount_full_aggregation':
                        $stmt->bindValue($identifier, $this->merchant_commission_amount_full_aggregation, PDO::PARAM_INT);

                        break;
                    case 'merchant_commission_refunded_amount':
                        $stmt->bindValue($identifier, $this->merchant_commission_refunded_amount, PDO::PARAM_INT);

                        break;
                    case 'merchant_reference':
                        $stmt->bindValue($identifier, $this->merchant_reference, PDO::PARAM_STR);

                        break;
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);

                        break;
                    case 'net_price':
                        $stmt->bindValue($identifier, $this->net_price, PDO::PARAM_INT);

                        break;
                    case 'order_item_reference':
                        $stmt->bindValue($identifier, $this->order_item_reference, PDO::PARAM_STR);

                        break;
                    case 'price':
                        $stmt->bindValue($identifier, $this->price, PDO::PARAM_INT);

                        break;
                    case 'price_to_pay_aggregation':
                        $stmt->bindValue($identifier, $this->price_to_pay_aggregation, PDO::PARAM_INT);

                        break;
                    case 'product_offer_reference':
                        $stmt->bindValue($identifier, $this->product_offer_reference, PDO::PARAM_STR);

                        break;
                    case 'product_option_price_aggregation':
                        $stmt->bindValue($identifier, $this->product_option_price_aggregation, PDO::PARAM_INT);

                        break;
                    case 'quantity':
                        $stmt->bindValue($identifier, $this->quantity, PDO::PARAM_INT);

                        break;
                    case 'quantity_base_measurement_unit_name':
                        $stmt->bindValue($identifier, $this->quantity_base_measurement_unit_name, PDO::PARAM_STR);

                        break;
                    case 'quantity_measurement_unit_code':
                        $stmt->bindValue($identifier, $this->quantity_measurement_unit_code, PDO::PARAM_STR);

                        break;
                    case 'quantity_measurement_unit_conversion':
                        $stmt->bindValue($identifier, $this->quantity_measurement_unit_conversion, PDO::PARAM_STR);

                        break;
                    case 'quantity_measurement_unit_name':
                        $stmt->bindValue($identifier, $this->quantity_measurement_unit_name, PDO::PARAM_STR);

                        break;
                    case 'quantity_measurement_unit_precision':
                        $stmt->bindValue($identifier, $this->quantity_measurement_unit_precision, PDO::PARAM_INT);

                        break;
                    case 'refundable_amount':
                        $stmt->bindValue($identifier, $this->refundable_amount, PDO::PARAM_INT);

                        break;
                    case 'remuneration_amount':
                        $stmt->bindValue($identifier, $this->remuneration_amount, PDO::PARAM_INT);

                        break;
                    case 'sku':
                        $stmt->bindValue($identifier, $this->sku, PDO::PARAM_STR);

                        break;
                    case 'subtotal_aggregation':
                        $stmt->bindValue($identifier, $this->subtotal_aggregation, PDO::PARAM_INT);

                        break;
                    case 'tax_amount':
                        $stmt->bindValue($identifier, $this->tax_amount, PDO::PARAM_INT);

                        break;
                    case 'tax_amount_after_cancellation':
                        $stmt->bindValue($identifier, $this->tax_amount_after_cancellation, PDO::PARAM_INT);

                        break;
                    case 'tax_amount_full_aggregation':
                        $stmt->bindValue($identifier, $this->tax_amount_full_aggregation, PDO::PARAM_INT);

                        break;
                    case 'tax_rate':
                        $stmt->bindValue($identifier, $this->tax_rate, PDO::PARAM_STR);

                        break;
                    case 'tax_rate_average_aggregation':
                        $stmt->bindValue($identifier, $this->tax_rate_average_aggregation, PDO::PARAM_STR);

                        break;
                    case 'uuid':
                        $stmt->bindValue($identifier, $this->uuid, PDO::PARAM_STR);

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
            $pk = $con->lastInsertId('spy_sales_order_item_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        if ($pk !== null) {
            $this->setIdSalesOrderItem($pk);
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
        $pos = SpySalesOrderItemTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdSalesOrderItem();

            case 1:
                return $this->getFkOmsOrderItemState();

            case 2:
                return $this->getFkOmsOrderProcess();

            case 3:
                return $this->getFkSalesOrder();

            case 4:
                return $this->getFkSalesOrderItemBundle();

            case 5:
                return $this->getFkSalesShipment();

            case 6:
                return $this->getAmount();

            case 7:
                return $this->getAmountBaseMeasurementUnitName();

            case 8:
                return $this->getAmountMeasurementUnitCode();

            case 9:
                return $this->getAmountMeasurementUnitConversion();

            case 10:
                return $this->getAmountMeasurementUnitName();

            case 11:
                return $this->getAmountMeasurementUnitPrecision();

            case 12:
                return $this->getAmountSku();

            case 13:
                return $this->getCanceledAmount();

            case 14:
                return $this->getCartNote();

            case 15:
                return $this->getDiscountAmountAggregation();

            case 16:
                return $this->getDiscountAmountFullAggregation();

            case 17:
                return $this->getExpensePriceAggregation();

            case 18:
                return $this->getGrossPrice();

            case 19:
                return $this->getGroupKey();

            case 20:
                return $this->getIsQuantitySplittable();

            case 21:
                return $this->getLastStateChange();

            case 22:
                return $this->getMerchantCommissionAmountAggregation();

            case 23:
                return $this->getMerchantCommissionAmountFullAggregation();

            case 24:
                return $this->getMerchantCommissionRefundedAmount();

            case 25:
                return $this->getMerchantReference();

            case 26:
                return $this->getName();

            case 27:
                return $this->getNetPrice();

            case 28:
                return $this->getOrderItemReference();

            case 29:
                return $this->getPrice();

            case 30:
                return $this->getPriceToPayAggregation();

            case 31:
                return $this->getProductOfferReference();

            case 32:
                return $this->getProductOptionPriceAggregation();

            case 33:
                return $this->getQuantity();

            case 34:
                return $this->getQuantityBaseMeasurementUnitName();

            case 35:
                return $this->getQuantityMeasurementUnitCode();

            case 36:
                return $this->getQuantityMeasurementUnitConversion();

            case 37:
                return $this->getQuantityMeasurementUnitName();

            case 38:
                return $this->getQuantityMeasurementUnitPrecision();

            case 39:
                return $this->getRefundableAmount();

            case 40:
                return $this->getRemunerationAmount();

            case 41:
                return $this->getSku();

            case 42:
                return $this->getSubtotalAggregation();

            case 43:
                return $this->getTaxAmount();

            case 44:
                return $this->getTaxAmountAfterCancellation();

            case 45:
                return $this->getTaxAmountFullAggregation();

            case 46:
                return $this->getTaxRate();

            case 47:
                return $this->getTaxRateAverageAggregation();

            case 48:
                return $this->getUuid();

            case 49:
                return $this->getCreatedAt();

            case 50:
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
        if (isset($alreadyDumpedObjects['SpySalesOrderItem'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpySalesOrderItem'][$this->hashCode()] = true;
        $keys = SpySalesOrderItemTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdSalesOrderItem(),
            $keys[1] => $this->getFkOmsOrderItemState(),
            $keys[2] => $this->getFkOmsOrderProcess(),
            $keys[3] => $this->getFkSalesOrder(),
            $keys[4] => $this->getFkSalesOrderItemBundle(),
            $keys[5] => $this->getFkSalesShipment(),
            $keys[6] => $this->getAmount(),
            $keys[7] => $this->getAmountBaseMeasurementUnitName(),
            $keys[8] => $this->getAmountMeasurementUnitCode(),
            $keys[9] => $this->getAmountMeasurementUnitConversion(),
            $keys[10] => $this->getAmountMeasurementUnitName(),
            $keys[11] => $this->getAmountMeasurementUnitPrecision(),
            $keys[12] => $this->getAmountSku(),
            $keys[13] => $this->getCanceledAmount(),
            $keys[14] => $this->getCartNote(),
            $keys[15] => $this->getDiscountAmountAggregation(),
            $keys[16] => $this->getDiscountAmountFullAggregation(),
            $keys[17] => $this->getExpensePriceAggregation(),
            $keys[18] => $this->getGrossPrice(),
            $keys[19] => $this->getGroupKey(),
            $keys[20] => $this->getIsQuantitySplittable(),
            $keys[21] => $this->getLastStateChange(),
            $keys[22] => $this->getMerchantCommissionAmountAggregation(),
            $keys[23] => $this->getMerchantCommissionAmountFullAggregation(),
            $keys[24] => $this->getMerchantCommissionRefundedAmount(),
            $keys[25] => $this->getMerchantReference(),
            $keys[26] => $this->getName(),
            $keys[27] => $this->getNetPrice(),
            $keys[28] => $this->getOrderItemReference(),
            $keys[29] => $this->getPrice(),
            $keys[30] => $this->getPriceToPayAggregation(),
            $keys[31] => $this->getProductOfferReference(),
            $keys[32] => $this->getProductOptionPriceAggregation(),
            $keys[33] => $this->getQuantity(),
            $keys[34] => $this->getQuantityBaseMeasurementUnitName(),
            $keys[35] => $this->getQuantityMeasurementUnitCode(),
            $keys[36] => $this->getQuantityMeasurementUnitConversion(),
            $keys[37] => $this->getQuantityMeasurementUnitName(),
            $keys[38] => $this->getQuantityMeasurementUnitPrecision(),
            $keys[39] => $this->getRefundableAmount(),
            $keys[40] => $this->getRemunerationAmount(),
            $keys[41] => $this->getSku(),
            $keys[42] => $this->getSubtotalAggregation(),
            $keys[43] => $this->getTaxAmount(),
            $keys[44] => $this->getTaxAmountAfterCancellation(),
            $keys[45] => $this->getTaxAmountFullAggregation(),
            $keys[46] => $this->getTaxRate(),
            $keys[47] => $this->getTaxRateAverageAggregation(),
            $keys[48] => $this->getUuid(),
            $keys[49] => $this->getCreatedAt(),
            $keys[50] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[21]] instanceof \DateTimeInterface) {
            $result[$keys[21]] = $result[$keys[21]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[49]] instanceof \DateTimeInterface) {
            $result[$keys[49]] = $result[$keys[49]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[50]] instanceof \DateTimeInterface) {
            $result[$keys[50]] = $result[$keys[50]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aSalesOrderItemBundle) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesOrderItemBundle';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_order_item_bundle';
                        break;
                    default:
                        $key = 'SalesOrderItemBundle';
                }

                $result[$key] = $this->aSalesOrderItemBundle->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->aState) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyOmsOrderItemState';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_oms_order_item_state';
                        break;
                    default:
                        $key = 'State';
                }

                $result[$key] = $this->aState->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aProcess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyOmsOrderProcess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_oms_order_process';
                        break;
                    default:
                        $key = 'Process';
                }

                $result[$key] = $this->aProcess->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aSpySalesShipment) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesShipment';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_shipment';
                        break;
                    default:
                        $key = 'SpySalesShipment';
                }

                $result[$key] = $this->aSpySalesShipment->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collMerchantSalesOrderItems) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchantSalesOrderItems';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant_sales_order_items';
                        break;
                    default:
                        $key = 'MerchantSalesOrderItems';
                }

                $result[$key] = $this->collMerchantSalesOrderItems->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collNopayments) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyNopaymentPaids';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_nopayment_paids';
                        break;
                    default:
                        $key = 'Nopayments';
                }

                $result[$key] = $this->collNopayments->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collStateHistories) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyOmsOrderItemStateHistories';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_oms_order_item_state_histories';
                        break;
                    default:
                        $key = 'StateHistories';
                }

                $result[$key] = $this->collStateHistories->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEventTimeouts) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyOmsEventTimeouts';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_oms_event_timeouts';
                        break;
                    default:
                        $key = 'EventTimeouts';
                }

                $result[$key] = $this->collEventTimeouts->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collMetadatas) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesOrderItemMetadatas';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_order_item_metadatas';
                        break;
                    default:
                        $key = 'Metadatas';
                }

                $result[$key] = $this->collMetadatas->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collOptions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesOrderItemOptions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_order_item_options';
                        break;
                    default:
                        $key = 'Options';
                }

                $result[$key] = $this->collOptions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpySalesOrderConfiguredBundleItems) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesOrderConfiguredBundleItems';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_order_configured_bundle_items';
                        break;
                    default:
                        $key = 'SpySalesOrderConfiguredBundleItems';
                }

                $result[$key] = $this->collSpySalesOrderConfiguredBundleItems->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collSpySalesOrderItemConfigurations) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesOrderItemConfigurations';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_order_item_configurations';
                        break;
                    default:
                        $key = 'SpySalesOrderItemConfigurations';
                }

                $result[$key] = $this->collSpySalesOrderItemConfigurations->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collReclamationItems) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesReclamationItems';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_reclamation_items';
                        break;
                    default:
                        $key = 'ReclamationItems';
                }

                $result[$key] = $this->collReclamationItems->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpySalesReturnItems) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesReturnItems';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_return_items';
                        break;
                    default:
                        $key = 'SpySalesReturnItems';
                }

                $result[$key] = $this->collSpySalesReturnItems->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSalesOrderItemServicePoints) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesOrderItemServicePoints';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_order_item_service_points';
                        break;
                    default:
                        $key = 'SalesOrderItemServicePoints';
                }

                $result[$key] = $this->collSalesOrderItemServicePoints->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpySalesOrderItemProductClasses) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesOrderItemProductClasses';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_order_item_product_classes';
                        break;
                    default:
                        $key = 'SpySalesOrderItemProductClasses';
                }

                $result[$key] = $this->collSpySalesOrderItemProductClasses->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpySspInquirySalesOrderItems) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySspInquirySalesOrderItems';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_ssp_inquiry_sales_order_items';
                        break;
                    default:
                        $key = 'SpySspInquirySalesOrderItems';
                }

                $result[$key] = $this->collSpySspInquirySalesOrderItems->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSalesOrderItemSspAssets) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesOrderItemSspAssets';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_order_item_ssp_assets';
                        break;
                    default:
                        $key = 'SalesOrderItemSspAssets';
                }

                $result[$key] = $this->collSalesOrderItemSspAssets->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpySalesOrderItemTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdSalesOrderItem($value);
                break;
            case 1:
                $this->setFkOmsOrderItemState($value);
                break;
            case 2:
                $this->setFkOmsOrderProcess($value);
                break;
            case 3:
                $this->setFkSalesOrder($value);
                break;
            case 4:
                $this->setFkSalesOrderItemBundle($value);
                break;
            case 5:
                $this->setFkSalesShipment($value);
                break;
            case 6:
                $this->setAmount($value);
                break;
            case 7:
                $this->setAmountBaseMeasurementUnitName($value);
                break;
            case 8:
                $this->setAmountMeasurementUnitCode($value);
                break;
            case 9:
                $this->setAmountMeasurementUnitConversion($value);
                break;
            case 10:
                $this->setAmountMeasurementUnitName($value);
                break;
            case 11:
                $this->setAmountMeasurementUnitPrecision($value);
                break;
            case 12:
                $this->setAmountSku($value);
                break;
            case 13:
                $this->setCanceledAmount($value);
                break;
            case 14:
                $this->setCartNote($value);
                break;
            case 15:
                $this->setDiscountAmountAggregation($value);
                break;
            case 16:
                $this->setDiscountAmountFullAggregation($value);
                break;
            case 17:
                $this->setExpensePriceAggregation($value);
                break;
            case 18:
                $this->setGrossPrice($value);
                break;
            case 19:
                $this->setGroupKey($value);
                break;
            case 20:
                $this->setIsQuantitySplittable($value);
                break;
            case 21:
                $this->setLastStateChange($value);
                break;
            case 22:
                $this->setMerchantCommissionAmountAggregation($value);
                break;
            case 23:
                $this->setMerchantCommissionAmountFullAggregation($value);
                break;
            case 24:
                $this->setMerchantCommissionRefundedAmount($value);
                break;
            case 25:
                $this->setMerchantReference($value);
                break;
            case 26:
                $this->setName($value);
                break;
            case 27:
                $this->setNetPrice($value);
                break;
            case 28:
                $this->setOrderItemReference($value);
                break;
            case 29:
                $this->setPrice($value);
                break;
            case 30:
                $this->setPriceToPayAggregation($value);
                break;
            case 31:
                $this->setProductOfferReference($value);
                break;
            case 32:
                $this->setProductOptionPriceAggregation($value);
                break;
            case 33:
                $this->setQuantity($value);
                break;
            case 34:
                $this->setQuantityBaseMeasurementUnitName($value);
                break;
            case 35:
                $this->setQuantityMeasurementUnitCode($value);
                break;
            case 36:
                $this->setQuantityMeasurementUnitConversion($value);
                break;
            case 37:
                $this->setQuantityMeasurementUnitName($value);
                break;
            case 38:
                $this->setQuantityMeasurementUnitPrecision($value);
                break;
            case 39:
                $this->setRefundableAmount($value);
                break;
            case 40:
                $this->setRemunerationAmount($value);
                break;
            case 41:
                $this->setSku($value);
                break;
            case 42:
                $this->setSubtotalAggregation($value);
                break;
            case 43:
                $this->setTaxAmount($value);
                break;
            case 44:
                $this->setTaxAmountAfterCancellation($value);
                break;
            case 45:
                $this->setTaxAmountFullAggregation($value);
                break;
            case 46:
                $this->setTaxRate($value);
                break;
            case 47:
                $this->setTaxRateAverageAggregation($value);
                break;
            case 48:
                $this->setUuid($value);
                break;
            case 49:
                $this->setCreatedAt($value);
                break;
            case 50:
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
        $keys = SpySalesOrderItemTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdSalesOrderItem($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkOmsOrderItemState($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setFkOmsOrderProcess($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setFkSalesOrder($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setFkSalesOrderItemBundle($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setFkSalesShipment($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setAmount($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setAmountBaseMeasurementUnitName($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setAmountMeasurementUnitCode($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setAmountMeasurementUnitConversion($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setAmountMeasurementUnitName($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setAmountMeasurementUnitPrecision($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setAmountSku($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setCanceledAmount($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setCartNote($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setDiscountAmountAggregation($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setDiscountAmountFullAggregation($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setExpensePriceAggregation($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setGrossPrice($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setGroupKey($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setIsQuantitySplittable($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setLastStateChange($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setMerchantCommissionAmountAggregation($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setMerchantCommissionAmountFullAggregation($arr[$keys[23]]);
        }
        if (array_key_exists($keys[24], $arr)) {
            $this->setMerchantCommissionRefundedAmount($arr[$keys[24]]);
        }
        if (array_key_exists($keys[25], $arr)) {
            $this->setMerchantReference($arr[$keys[25]]);
        }
        if (array_key_exists($keys[26], $arr)) {
            $this->setName($arr[$keys[26]]);
        }
        if (array_key_exists($keys[27], $arr)) {
            $this->setNetPrice($arr[$keys[27]]);
        }
        if (array_key_exists($keys[28], $arr)) {
            $this->setOrderItemReference($arr[$keys[28]]);
        }
        if (array_key_exists($keys[29], $arr)) {
            $this->setPrice($arr[$keys[29]]);
        }
        if (array_key_exists($keys[30], $arr)) {
            $this->setPriceToPayAggregation($arr[$keys[30]]);
        }
        if (array_key_exists($keys[31], $arr)) {
            $this->setProductOfferReference($arr[$keys[31]]);
        }
        if (array_key_exists($keys[32], $arr)) {
            $this->setProductOptionPriceAggregation($arr[$keys[32]]);
        }
        if (array_key_exists($keys[33], $arr)) {
            $this->setQuantity($arr[$keys[33]]);
        }
        if (array_key_exists($keys[34], $arr)) {
            $this->setQuantityBaseMeasurementUnitName($arr[$keys[34]]);
        }
        if (array_key_exists($keys[35], $arr)) {
            $this->setQuantityMeasurementUnitCode($arr[$keys[35]]);
        }
        if (array_key_exists($keys[36], $arr)) {
            $this->setQuantityMeasurementUnitConversion($arr[$keys[36]]);
        }
        if (array_key_exists($keys[37], $arr)) {
            $this->setQuantityMeasurementUnitName($arr[$keys[37]]);
        }
        if (array_key_exists($keys[38], $arr)) {
            $this->setQuantityMeasurementUnitPrecision($arr[$keys[38]]);
        }
        if (array_key_exists($keys[39], $arr)) {
            $this->setRefundableAmount($arr[$keys[39]]);
        }
        if (array_key_exists($keys[40], $arr)) {
            $this->setRemunerationAmount($arr[$keys[40]]);
        }
        if (array_key_exists($keys[41], $arr)) {
            $this->setSku($arr[$keys[41]]);
        }
        if (array_key_exists($keys[42], $arr)) {
            $this->setSubtotalAggregation($arr[$keys[42]]);
        }
        if (array_key_exists($keys[43], $arr)) {
            $this->setTaxAmount($arr[$keys[43]]);
        }
        if (array_key_exists($keys[44], $arr)) {
            $this->setTaxAmountAfterCancellation($arr[$keys[44]]);
        }
        if (array_key_exists($keys[45], $arr)) {
            $this->setTaxAmountFullAggregation($arr[$keys[45]]);
        }
        if (array_key_exists($keys[46], $arr)) {
            $this->setTaxRate($arr[$keys[46]]);
        }
        if (array_key_exists($keys[47], $arr)) {
            $this->setTaxRateAverageAggregation($arr[$keys[47]]);
        }
        if (array_key_exists($keys[48], $arr)) {
            $this->setUuid($arr[$keys[48]]);
        }
        if (array_key_exists($keys[49], $arr)) {
            $this->setCreatedAt($arr[$keys[49]]);
        }
        if (array_key_exists($keys[50], $arr)) {
            $this->setUpdatedAt($arr[$keys[50]]);
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
        $criteria = new Criteria(SpySalesOrderItemTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_ID_SALES_ORDER_ITEM)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_ID_SALES_ORDER_ITEM, $this->id_sales_order_item);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_FK_OMS_ORDER_ITEM_STATE)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_FK_OMS_ORDER_ITEM_STATE, $this->fk_oms_order_item_state);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_FK_OMS_ORDER_PROCESS)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_FK_OMS_ORDER_PROCESS, $this->fk_oms_order_process);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_FK_SALES_ORDER)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_FK_SALES_ORDER, $this->fk_sales_order);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_FK_SALES_ORDER_ITEM_BUNDLE)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_FK_SALES_ORDER_ITEM_BUNDLE, $this->fk_sales_order_item_bundle);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_FK_SALES_SHIPMENT)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_FK_SALES_SHIPMENT, $this->fk_sales_shipment);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_AMOUNT)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_AMOUNT, $this->amount);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_AMOUNT_BASE_MEASUREMENT_UNIT_NAME)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_AMOUNT_BASE_MEASUREMENT_UNIT_NAME, $this->amount_base_measurement_unit_name);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_AMOUNT_MEASUREMENT_UNIT_CODE)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_AMOUNT_MEASUREMENT_UNIT_CODE, $this->amount_measurement_unit_code);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_AMOUNT_MEASUREMENT_UNIT_CONVERSION)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_AMOUNT_MEASUREMENT_UNIT_CONVERSION, $this->amount_measurement_unit_conversion);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_AMOUNT_MEASUREMENT_UNIT_NAME)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_AMOUNT_MEASUREMENT_UNIT_NAME, $this->amount_measurement_unit_name);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_AMOUNT_MEASUREMENT_UNIT_PRECISION)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_AMOUNT_MEASUREMENT_UNIT_PRECISION, $this->amount_measurement_unit_precision);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_AMOUNT_SKU)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_AMOUNT_SKU, $this->amount_sku);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_CANCELED_AMOUNT)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_CANCELED_AMOUNT, $this->canceled_amount);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_CART_NOTE)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_CART_NOTE, $this->cart_note);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_DISCOUNT_AMOUNT_AGGREGATION)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_DISCOUNT_AMOUNT_AGGREGATION, $this->discount_amount_aggregation);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_DISCOUNT_AMOUNT_FULL_AGGREGATION)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_DISCOUNT_AMOUNT_FULL_AGGREGATION, $this->discount_amount_full_aggregation);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_EXPENSE_PRICE_AGGREGATION)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_EXPENSE_PRICE_AGGREGATION, $this->expense_price_aggregation);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_GROSS_PRICE)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_GROSS_PRICE, $this->gross_price);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_GROUP_KEY)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_GROUP_KEY, $this->group_key);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_IS_QUANTITY_SPLITTABLE)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_IS_QUANTITY_SPLITTABLE, $this->is_quantity_splittable);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_LAST_STATE_CHANGE)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_LAST_STATE_CHANGE, $this->last_state_change);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_MERCHANT_COMMISSION_AMOUNT_AGGREGATION)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_MERCHANT_COMMISSION_AMOUNT_AGGREGATION, $this->merchant_commission_amount_aggregation);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_MERCHANT_COMMISSION_AMOUNT_FULL_AGGREGATION)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_MERCHANT_COMMISSION_AMOUNT_FULL_AGGREGATION, $this->merchant_commission_amount_full_aggregation);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_MERCHANT_COMMISSION_REFUNDED_AMOUNT)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_MERCHANT_COMMISSION_REFUNDED_AMOUNT, $this->merchant_commission_refunded_amount);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_MERCHANT_REFERENCE)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_MERCHANT_REFERENCE, $this->merchant_reference);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_NAME)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_NET_PRICE)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_NET_PRICE, $this->net_price);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_ORDER_ITEM_REFERENCE)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_ORDER_ITEM_REFERENCE, $this->order_item_reference);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_PRICE)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_PRICE, $this->price);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_PRICE_TO_PAY_AGGREGATION)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_PRICE_TO_PAY_AGGREGATION, $this->price_to_pay_aggregation);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_PRODUCT_OFFER_REFERENCE)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_PRODUCT_OFFER_REFERENCE, $this->product_offer_reference);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_PRODUCT_OPTION_PRICE_AGGREGATION)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_PRODUCT_OPTION_PRICE_AGGREGATION, $this->product_option_price_aggregation);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_QUANTITY)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_QUANTITY, $this->quantity);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_QUANTITY_BASE_MEASUREMENT_UNIT_NAME)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_QUANTITY_BASE_MEASUREMENT_UNIT_NAME, $this->quantity_base_measurement_unit_name);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_QUANTITY_MEASUREMENT_UNIT_CODE)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_QUANTITY_MEASUREMENT_UNIT_CODE, $this->quantity_measurement_unit_code);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_QUANTITY_MEASUREMENT_UNIT_CONVERSION)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_QUANTITY_MEASUREMENT_UNIT_CONVERSION, $this->quantity_measurement_unit_conversion);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_QUANTITY_MEASUREMENT_UNIT_NAME)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_QUANTITY_MEASUREMENT_UNIT_NAME, $this->quantity_measurement_unit_name);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_QUANTITY_MEASUREMENT_UNIT_PRECISION)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_QUANTITY_MEASUREMENT_UNIT_PRECISION, $this->quantity_measurement_unit_precision);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_REFUNDABLE_AMOUNT)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_REFUNDABLE_AMOUNT, $this->refundable_amount);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_REMUNERATION_AMOUNT)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_REMUNERATION_AMOUNT, $this->remuneration_amount);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_SKU)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_SKU, $this->sku);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_SUBTOTAL_AGGREGATION)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_SUBTOTAL_AGGREGATION, $this->subtotal_aggregation);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_TAX_AMOUNT)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_TAX_AMOUNT, $this->tax_amount);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_TAX_AMOUNT_AFTER_CANCELLATION)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_TAX_AMOUNT_AFTER_CANCELLATION, $this->tax_amount_after_cancellation);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_TAX_AMOUNT_FULL_AGGREGATION)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_TAX_AMOUNT_FULL_AGGREGATION, $this->tax_amount_full_aggregation);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_TAX_RATE)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_TAX_RATE, $this->tax_rate);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_TAX_RATE_AVERAGE_AGGREGATION)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_TAX_RATE_AVERAGE_AGGREGATION, $this->tax_rate_average_aggregation);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_UUID)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_UUID, $this->uuid);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_CREATED_AT)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpySalesOrderItemTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpySalesOrderItemTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildSpySalesOrderItemQuery::create();
        $criteria->add(SpySalesOrderItemTableMap::COL_ID_SALES_ORDER_ITEM, $this->id_sales_order_item);

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
        $validPk = null !== $this->getIdSalesOrderItem();

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
        return $this->getIdSalesOrderItem();
    }

    /**
     * Generic method to set the primary key (id_sales_order_item column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdSalesOrderItem($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdSalesOrderItem();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\Sales\Persistence\SpySalesOrderItem (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkOmsOrderItemState($this->getFkOmsOrderItemState());
        $copyObj->setFkOmsOrderProcess($this->getFkOmsOrderProcess());
        $copyObj->setFkSalesOrder($this->getFkSalesOrder());
        $copyObj->setFkSalesOrderItemBundle($this->getFkSalesOrderItemBundle());
        $copyObj->setFkSalesShipment($this->getFkSalesShipment());
        $copyObj->setAmount($this->getAmount());
        $copyObj->setAmountBaseMeasurementUnitName($this->getAmountBaseMeasurementUnitName());
        $copyObj->setAmountMeasurementUnitCode($this->getAmountMeasurementUnitCode());
        $copyObj->setAmountMeasurementUnitConversion($this->getAmountMeasurementUnitConversion());
        $copyObj->setAmountMeasurementUnitName($this->getAmountMeasurementUnitName());
        $copyObj->setAmountMeasurementUnitPrecision($this->getAmountMeasurementUnitPrecision());
        $copyObj->setAmountSku($this->getAmountSku());
        $copyObj->setCanceledAmount($this->getCanceledAmount());
        $copyObj->setCartNote($this->getCartNote());
        $copyObj->setDiscountAmountAggregation($this->getDiscountAmountAggregation());
        $copyObj->setDiscountAmountFullAggregation($this->getDiscountAmountFullAggregation());
        $copyObj->setExpensePriceAggregation($this->getExpensePriceAggregation());
        $copyObj->setGrossPrice($this->getGrossPrice());
        $copyObj->setGroupKey($this->getGroupKey());
        $copyObj->setIsQuantitySplittable($this->getIsQuantitySplittable());
        $copyObj->setLastStateChange($this->getLastStateChange());
        $copyObj->setMerchantCommissionAmountAggregation($this->getMerchantCommissionAmountAggregation());
        $copyObj->setMerchantCommissionAmountFullAggregation($this->getMerchantCommissionAmountFullAggregation());
        $copyObj->setMerchantCommissionRefundedAmount($this->getMerchantCommissionRefundedAmount());
        $copyObj->setMerchantReference($this->getMerchantReference());
        $copyObj->setName($this->getName());
        $copyObj->setNetPrice($this->getNetPrice());
        $copyObj->setOrderItemReference($this->getOrderItemReference());
        $copyObj->setPrice($this->getPrice());
        $copyObj->setPriceToPayAggregation($this->getPriceToPayAggregation());
        $copyObj->setProductOfferReference($this->getProductOfferReference());
        $copyObj->setProductOptionPriceAggregation($this->getProductOptionPriceAggregation());
        $copyObj->setQuantity($this->getQuantity());
        $copyObj->setQuantityBaseMeasurementUnitName($this->getQuantityBaseMeasurementUnitName());
        $copyObj->setQuantityMeasurementUnitCode($this->getQuantityMeasurementUnitCode());
        $copyObj->setQuantityMeasurementUnitConversion($this->getQuantityMeasurementUnitConversion());
        $copyObj->setQuantityMeasurementUnitName($this->getQuantityMeasurementUnitName());
        $copyObj->setQuantityMeasurementUnitPrecision($this->getQuantityMeasurementUnitPrecision());
        $copyObj->setRefundableAmount($this->getRefundableAmount());
        $copyObj->setRemunerationAmount($this->getRemunerationAmount());
        $copyObj->setSku($this->getSku());
        $copyObj->setSubtotalAggregation($this->getSubtotalAggregation());
        $copyObj->setTaxAmount($this->getTaxAmount());
        $copyObj->setTaxAmountAfterCancellation($this->getTaxAmountAfterCancellation());
        $copyObj->setTaxAmountFullAggregation($this->getTaxAmountFullAggregation());
        $copyObj->setTaxRate($this->getTaxRate());
        $copyObj->setTaxRateAverageAggregation($this->getTaxRateAverageAggregation());
        $copyObj->setUuid($this->getUuid());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getMerchantSalesOrderItems() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMerchantSalesOrderItem($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getNopayments() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addNopayment($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTransitionLogs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTransitionLog($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getStateHistories() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addStateHistory($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEventTimeouts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEventTimeout($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getMetadatas() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMetadata($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getDiscounts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDiscount($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOptions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOption($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpySalesOrderConfiguredBundleItems() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpySalesOrderConfiguredBundleItem($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpySalesMerchantCommissions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpySalesMerchantCommission($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpySalesOrderItemConfigurations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpySalesOrderItemConfiguration($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getReclamationItems() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addReclamationItem($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpySalesReturnItems() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpySalesReturnItem($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSalesOrderItemServicePoints() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSalesOrderItemServicePoint($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpySalesOrderItemProductClasses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpySalesOrderItemProductClass($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpySspInquirySalesOrderItems() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpySspInquirySalesOrderItem($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSalesOrderItemSspAssets() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSalesOrderItemSspAsset($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdSalesOrderItem(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderItem Clone of current object.
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
     * Declares an association between this object and a SpySalesOrderItemBundle object.
     *
     * @param SpySalesOrderItemBundle|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setSalesOrderItemBundle(SpySalesOrderItemBundle $v = null)
    {
        if ($v === null) {
            $this->setFkSalesOrderItemBundle(NULL);
        } else {
            $this->setFkSalesOrderItemBundle($v->getIdSalesOrderItemBundle());
        }

        $this->aSalesOrderItemBundle = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpySalesOrderItemBundle object, it will not be re-added.
        if ($v !== null) {
            $v->addSalesOrderItem($this);
        }


        return $this;
    }


    /**
     * Get the associated SpySalesOrderItemBundle object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpySalesOrderItemBundle|null The associated SpySalesOrderItemBundle object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSalesOrderItemBundle(?ConnectionInterface $con = null)
    {
        if ($this->aSalesOrderItemBundle === null && ($this->fk_sales_order_item_bundle != 0)) {
            $this->aSalesOrderItemBundle = SpySalesOrderItemBundleQuery::create()->findPk($this->fk_sales_order_item_bundle, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSalesOrderItemBundle->addSalesOrderItems($this);
             */
        }

        return $this->aSalesOrderItemBundle;
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
            $v->addItem($this);
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
                $this->aOrder->addItems($this);
             */
        }

        return $this->aOrder;
    }

    /**
     * Declares an association between this object and a SpyOmsOrderItemState object.
     *
     * @param SpyOmsOrderItemState $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setState(SpyOmsOrderItemState $v = null)
    {
        if ($v === null) {
            $this->setFkOmsOrderItemState(NULL);
        } else {
            $this->setFkOmsOrderItemState($v->getIdOmsOrderItemState());
        }

        $this->aState = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyOmsOrderItemState object, it will not be re-added.
        if ($v !== null) {
            $v->addOrder($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyOmsOrderItemState object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyOmsOrderItemState The associated SpyOmsOrderItemState object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getState(?ConnectionInterface $con = null)
    {
        if ($this->aState === null && ($this->fk_oms_order_item_state != 0)) {
            $this->aState = SpyOmsOrderItemStateQuery::create()->findPk($this->fk_oms_order_item_state, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aState->addOrders($this);
             */
        }

        return $this->aState;
    }

    /**
     * Declares an association between this object and a SpyOmsOrderProcess object.
     *
     * @param SpyOmsOrderProcess|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setProcess(SpyOmsOrderProcess $v = null)
    {
        if ($v === null) {
            $this->setFkOmsOrderProcess(NULL);
        } else {
            $this->setFkOmsOrderProcess($v->getIdOmsOrderProcess());
        }

        $this->aProcess = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyOmsOrderProcess object, it will not be re-added.
        if ($v !== null) {
            $v->addItem($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyOmsOrderProcess object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyOmsOrderProcess|null The associated SpyOmsOrderProcess object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getProcess(?ConnectionInterface $con = null)
    {
        if ($this->aProcess === null && ($this->fk_oms_order_process != 0)) {
            $this->aProcess = SpyOmsOrderProcessQuery::create()->findPk($this->fk_oms_order_process, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aProcess->addItems($this);
             */
        }

        return $this->aProcess;
    }

    /**
     * Declares an association between this object and a ChildSpySalesShipment object.
     *
     * @param ChildSpySalesShipment|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setSpySalesShipment(ChildSpySalesShipment $v = null)
    {
        if ($v === null) {
            $this->setFkSalesShipment(NULL);
        } else {
            $this->setFkSalesShipment($v->getIdSalesShipment());
        }

        $this->aSpySalesShipment = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpySalesShipment object, it will not be re-added.
        if ($v !== null) {
            $v->addSpySalesOrderItem($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpySalesShipment object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSpySalesShipment|null The associated ChildSpySalesShipment object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpySalesShipment(?ConnectionInterface $con = null)
    {
        if ($this->aSpySalesShipment === null && ($this->fk_sales_shipment != 0)) {
            $this->aSpySalesShipment = ChildSpySalesShipmentQuery::create()->findPk($this->fk_sales_shipment, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSpySalesShipment->addSpySalesOrderItems($this);
             */
        }

        return $this->aSpySalesShipment;
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
        if ('MerchantSalesOrderItem' === $relationName) {
            $this->initMerchantSalesOrderItems();
            return;
        }
        if ('Nopayment' === $relationName) {
            $this->initNopayments();
            return;
        }
        if ('TransitionLog' === $relationName) {
            $this->initTransitionLogs();
            return;
        }
        if ('StateHistory' === $relationName) {
            $this->initStateHistories();
            return;
        }
        if ('EventTimeout' === $relationName) {
            $this->initEventTimeouts();
            return;
        }
        if ('Metadata' === $relationName) {
            $this->initMetadatas();
            return;
        }
        if ('Discount' === $relationName) {
            $this->initDiscounts();
            return;
        }
        if ('Option' === $relationName) {
            $this->initOptions();
            return;
        }
        if ('SpySalesOrderConfiguredBundleItem' === $relationName) {
            $this->initSpySalesOrderConfiguredBundleItems();
            return;
        }
        if ('SpySalesMerchantCommission' === $relationName) {
            $this->initSpySalesMerchantCommissions();
            return;
        }
        if ('SpySalesOrderItemConfiguration' === $relationName) {
            $this->initSpySalesOrderItemConfigurations();
            return;
        }
        if ('ReclamationItem' === $relationName) {
            $this->initReclamationItems();
            return;
        }
        if ('SpySalesReturnItem' === $relationName) {
            $this->initSpySalesReturnItems();
            return;
        }
        if ('SalesOrderItemServicePoint' === $relationName) {
            $this->initSalesOrderItemServicePoints();
            return;
        }
        if ('SpySalesOrderItemProductClass' === $relationName) {
            $this->initSpySalesOrderItemProductClasses();
            return;
        }
        if ('SpySspInquirySalesOrderItem' === $relationName) {
            $this->initSpySspInquirySalesOrderItems();
            return;
        }
        if ('SalesOrderItemSspAsset' === $relationName) {
            $this->initSalesOrderItemSspAssets();
            return;
        }
    }

    /**
     * Clears out the collMerchantSalesOrderItems collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addMerchantSalesOrderItems()
     */
    public function clearMerchantSalesOrderItems()
    {
        $this->collMerchantSalesOrderItems = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collMerchantSalesOrderItems collection loaded partially.
     *
     * @return void
     */
    public function resetPartialMerchantSalesOrderItems($v = true): void
    {
        $this->collMerchantSalesOrderItemsPartial = $v;
    }

    /**
     * Initializes the collMerchantSalesOrderItems collection.
     *
     * By default this just sets the collMerchantSalesOrderItems collection to an empty array (like clearcollMerchantSalesOrderItems());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initMerchantSalesOrderItems(bool $overrideExisting = true): void
    {
        if (null !== $this->collMerchantSalesOrderItems && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyMerchantSalesOrderItemTableMap::getTableMap()->getCollectionClassName();

        $this->collMerchantSalesOrderItems = new $collectionClassName;
        $this->collMerchantSalesOrderItems->setModel('\Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderItem');
    }

    /**
     * Gets an array of SpyMerchantSalesOrderItem objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySalesOrderItem is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyMerchantSalesOrderItem[] List of SpyMerchantSalesOrderItem objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantSalesOrderItem> List of SpyMerchantSalesOrderItem objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getMerchantSalesOrderItems(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collMerchantSalesOrderItemsPartial && !$this->isNew();
        if (null === $this->collMerchantSalesOrderItems || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collMerchantSalesOrderItems) {
                    $this->initMerchantSalesOrderItems();
                } else {
                    $collectionClassName = SpyMerchantSalesOrderItemTableMap::getTableMap()->getCollectionClassName();

                    $collMerchantSalesOrderItems = new $collectionClassName;
                    $collMerchantSalesOrderItems->setModel('\Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderItem');

                    return $collMerchantSalesOrderItems;
                }
            } else {
                $collMerchantSalesOrderItems = SpyMerchantSalesOrderItemQuery::create(null, $criteria)
                    ->filterBySalesOrderItem($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collMerchantSalesOrderItemsPartial && count($collMerchantSalesOrderItems)) {
                        $this->initMerchantSalesOrderItems(false);

                        foreach ($collMerchantSalesOrderItems as $obj) {
                            if (false == $this->collMerchantSalesOrderItems->contains($obj)) {
                                $this->collMerchantSalesOrderItems->append($obj);
                            }
                        }

                        $this->collMerchantSalesOrderItemsPartial = true;
                    }

                    return $collMerchantSalesOrderItems;
                }

                if ($partial && $this->collMerchantSalesOrderItems) {
                    foreach ($this->collMerchantSalesOrderItems as $obj) {
                        if ($obj->isNew()) {
                            $collMerchantSalesOrderItems[] = $obj;
                        }
                    }
                }

                $this->collMerchantSalesOrderItems = $collMerchantSalesOrderItems;
                $this->collMerchantSalesOrderItemsPartial = false;
            }
        }

        return $this->collMerchantSalesOrderItems;
    }

    /**
     * Sets a collection of SpyMerchantSalesOrderItem objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $merchantSalesOrderItems A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setMerchantSalesOrderItems(Collection $merchantSalesOrderItems, ?ConnectionInterface $con = null)
    {
        /** @var SpyMerchantSalesOrderItem[] $merchantSalesOrderItemsToDelete */
        $merchantSalesOrderItemsToDelete = $this->getMerchantSalesOrderItems(new Criteria(), $con)->diff($merchantSalesOrderItems);


        $this->merchantSalesOrderItemsScheduledForDeletion = $merchantSalesOrderItemsToDelete;

        foreach ($merchantSalesOrderItemsToDelete as $merchantSalesOrderItemRemoved) {
            $merchantSalesOrderItemRemoved->setSalesOrderItem(null);
        }

        $this->collMerchantSalesOrderItems = null;
        foreach ($merchantSalesOrderItems as $merchantSalesOrderItem) {
            $this->addMerchantSalesOrderItem($merchantSalesOrderItem);
        }

        $this->collMerchantSalesOrderItems = $merchantSalesOrderItems;
        $this->collMerchantSalesOrderItemsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyMerchantSalesOrderItem objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyMerchantSalesOrderItem objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countMerchantSalesOrderItems(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collMerchantSalesOrderItemsPartial && !$this->isNew();
        if (null === $this->collMerchantSalesOrderItems || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collMerchantSalesOrderItems) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getMerchantSalesOrderItems());
            }

            $query = SpyMerchantSalesOrderItemQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySalesOrderItem($this)
                ->count($con);
        }

        return count($this->collMerchantSalesOrderItems);
    }

    /**
     * Method called to associate a SpyMerchantSalesOrderItem object to this object
     * through the SpyMerchantSalesOrderItem foreign key attribute.
     *
     * @param SpyMerchantSalesOrderItem $l SpyMerchantSalesOrderItem
     * @return $this The current object (for fluent API support)
     */
    public function addMerchantSalesOrderItem(SpyMerchantSalesOrderItem $l)
    {
        if ($this->collMerchantSalesOrderItems === null) {
            $this->initMerchantSalesOrderItems();
            $this->collMerchantSalesOrderItemsPartial = true;
        }

        if (!$this->collMerchantSalesOrderItems->contains($l)) {
            $this->doAddMerchantSalesOrderItem($l);

            if ($this->merchantSalesOrderItemsScheduledForDeletion and $this->merchantSalesOrderItemsScheduledForDeletion->contains($l)) {
                $this->merchantSalesOrderItemsScheduledForDeletion->remove($this->merchantSalesOrderItemsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyMerchantSalesOrderItem $merchantSalesOrderItem The SpyMerchantSalesOrderItem object to add.
     */
    protected function doAddMerchantSalesOrderItem(SpyMerchantSalesOrderItem $merchantSalesOrderItem): void
    {
        $this->collMerchantSalesOrderItems[]= $merchantSalesOrderItem;
        $merchantSalesOrderItem->setSalesOrderItem($this);
    }

    /**
     * @param SpyMerchantSalesOrderItem $merchantSalesOrderItem The SpyMerchantSalesOrderItem object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeMerchantSalesOrderItem(SpyMerchantSalesOrderItem $merchantSalesOrderItem)
    {
        if ($this->getMerchantSalesOrderItems()->contains($merchantSalesOrderItem)) {
            $pos = $this->collMerchantSalesOrderItems->search($merchantSalesOrderItem);
            $this->collMerchantSalesOrderItems->remove($pos);
            if (null === $this->merchantSalesOrderItemsScheduledForDeletion) {
                $this->merchantSalesOrderItemsScheduledForDeletion = clone $this->collMerchantSalesOrderItems;
                $this->merchantSalesOrderItemsScheduledForDeletion->clear();
            }
            $this->merchantSalesOrderItemsScheduledForDeletion[]= clone $merchantSalesOrderItem;
            $merchantSalesOrderItem->setSalesOrderItem(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySalesOrderItem is new, it will return
     * an empty collection; or if this SpySalesOrderItem has previously
     * been saved, it will retrieve related MerchantSalesOrderItems from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySalesOrderItem.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyMerchantSalesOrderItem[] List of SpyMerchantSalesOrderItem objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantSalesOrderItem}> List of SpyMerchantSalesOrderItem objects
     */
    public function getMerchantSalesOrderItemsJoinStateMachineItemState(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyMerchantSalesOrderItemQuery::create(null, $criteria);
        $query->joinWith('StateMachineItemState', $joinBehavior);

        return $this->getMerchantSalesOrderItems($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySalesOrderItem is new, it will return
     * an empty collection; or if this SpySalesOrderItem has previously
     * been saved, it will retrieve related MerchantSalesOrderItems from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySalesOrderItem.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyMerchantSalesOrderItem[] List of SpyMerchantSalesOrderItem objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantSalesOrderItem}> List of SpyMerchantSalesOrderItem objects
     */
    public function getMerchantSalesOrderItemsJoinMerchantSalesOrder(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyMerchantSalesOrderItemQuery::create(null, $criteria);
        $query->joinWith('MerchantSalesOrder', $joinBehavior);

        return $this->getMerchantSalesOrderItems($query, $con);
    }

    /**
     * Clears out the collNopayments collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addNopayments()
     */
    public function clearNopayments()
    {
        $this->collNopayments = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collNopayments collection loaded partially.
     *
     * @return void
     */
    public function resetPartialNopayments($v = true): void
    {
        $this->collNopaymentsPartial = $v;
    }

    /**
     * Initializes the collNopayments collection.
     *
     * By default this just sets the collNopayments collection to an empty array (like clearcollNopayments());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initNopayments(bool $overrideExisting = true): void
    {
        if (null !== $this->collNopayments && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyNopaymentPaidTableMap::getTableMap()->getCollectionClassName();

        $this->collNopayments = new $collectionClassName;
        $this->collNopayments->setModel('\Orm\Zed\Nopayment\Persistence\SpyNopaymentPaid');
    }

    /**
     * Gets an array of SpyNopaymentPaid objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySalesOrderItem is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyNopaymentPaid[] List of SpyNopaymentPaid objects
     * @phpstan-return ObjectCollection&\Traversable<SpyNopaymentPaid> List of SpyNopaymentPaid objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getNopayments(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collNopaymentsPartial && !$this->isNew();
        if (null === $this->collNopayments || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collNopayments) {
                    $this->initNopayments();
                } else {
                    $collectionClassName = SpyNopaymentPaidTableMap::getTableMap()->getCollectionClassName();

                    $collNopayments = new $collectionClassName;
                    $collNopayments->setModel('\Orm\Zed\Nopayment\Persistence\SpyNopaymentPaid');

                    return $collNopayments;
                }
            } else {
                $collNopayments = SpyNopaymentPaidQuery::create(null, $criteria)
                    ->filterByOrderItem($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collNopaymentsPartial && count($collNopayments)) {
                        $this->initNopayments(false);

                        foreach ($collNopayments as $obj) {
                            if (false == $this->collNopayments->contains($obj)) {
                                $this->collNopayments->append($obj);
                            }
                        }

                        $this->collNopaymentsPartial = true;
                    }

                    return $collNopayments;
                }

                if ($partial && $this->collNopayments) {
                    foreach ($this->collNopayments as $obj) {
                        if ($obj->isNew()) {
                            $collNopayments[] = $obj;
                        }
                    }
                }

                $this->collNopayments = $collNopayments;
                $this->collNopaymentsPartial = false;
            }
        }

        return $this->collNopayments;
    }

    /**
     * Sets a collection of SpyNopaymentPaid objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $nopayments A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setNopayments(Collection $nopayments, ?ConnectionInterface $con = null)
    {
        /** @var SpyNopaymentPaid[] $nopaymentsToDelete */
        $nopaymentsToDelete = $this->getNopayments(new Criteria(), $con)->diff($nopayments);


        $this->nopaymentsScheduledForDeletion = $nopaymentsToDelete;

        foreach ($nopaymentsToDelete as $nopaymentRemoved) {
            $nopaymentRemoved->setOrderItem(null);
        }

        $this->collNopayments = null;
        foreach ($nopayments as $nopayment) {
            $this->addNopayment($nopayment);
        }

        $this->collNopayments = $nopayments;
        $this->collNopaymentsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyNopaymentPaid objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyNopaymentPaid objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countNopayments(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collNopaymentsPartial && !$this->isNew();
        if (null === $this->collNopayments || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collNopayments) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getNopayments());
            }

            $query = SpyNopaymentPaidQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrderItem($this)
                ->count($con);
        }

        return count($this->collNopayments);
    }

    /**
     * Method called to associate a SpyNopaymentPaid object to this object
     * through the SpyNopaymentPaid foreign key attribute.
     *
     * @param SpyNopaymentPaid $l SpyNopaymentPaid
     * @return $this The current object (for fluent API support)
     */
    public function addNopayment(SpyNopaymentPaid $l)
    {
        if ($this->collNopayments === null) {
            $this->initNopayments();
            $this->collNopaymentsPartial = true;
        }

        if (!$this->collNopayments->contains($l)) {
            $this->doAddNopayment($l);

            if ($this->nopaymentsScheduledForDeletion and $this->nopaymentsScheduledForDeletion->contains($l)) {
                $this->nopaymentsScheduledForDeletion->remove($this->nopaymentsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyNopaymentPaid $nopayment The SpyNopaymentPaid object to add.
     */
    protected function doAddNopayment(SpyNopaymentPaid $nopayment): void
    {
        $this->collNopayments[]= $nopayment;
        $nopayment->setOrderItem($this);
    }

    /**
     * @param SpyNopaymentPaid $nopayment The SpyNopaymentPaid object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeNopayment(SpyNopaymentPaid $nopayment)
    {
        if ($this->getNopayments()->contains($nopayment)) {
            $pos = $this->collNopayments->search($nopayment);
            $this->collNopayments->remove($pos);
            if (null === $this->nopaymentsScheduledForDeletion) {
                $this->nopaymentsScheduledForDeletion = clone $this->collNopayments;
                $this->nopaymentsScheduledForDeletion->clear();
            }
            $this->nopaymentsScheduledForDeletion[]= clone $nopayment;
            $nopayment->setOrderItem(null);
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
     * If this ChildSpySalesOrderItem is new, it will return
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
                    ->filterByOrderItem($this)
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
            $transitionLogRemoved->setOrderItem(null);
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
                ->filterByOrderItem($this)
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
        $transitionLog->setOrderItem($this);
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
            $transitionLog->setOrderItem(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySalesOrderItem is new, it will return
     * an empty collection; or if this SpySalesOrderItem has previously
     * been saved, it will retrieve related TransitionLogs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySalesOrderItem.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyOmsTransitionLog[] List of SpyOmsTransitionLog objects
     * @phpstan-return ObjectCollection&\Traversable<SpyOmsTransitionLog}> List of SpyOmsTransitionLog objects
     */
    public function getTransitionLogsJoinOrder(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyOmsTransitionLogQuery::create(null, $criteria);
        $query->joinWith('Order', $joinBehavior);

        return $this->getTransitionLogs($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySalesOrderItem is new, it will return
     * an empty collection; or if this SpySalesOrderItem has previously
     * been saved, it will retrieve related TransitionLogs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySalesOrderItem.
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
     * Clears out the collStateHistories collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addStateHistories()
     */
    public function clearStateHistories()
    {
        $this->collStateHistories = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collStateHistories collection loaded partially.
     *
     * @return void
     */
    public function resetPartialStateHistories($v = true): void
    {
        $this->collStateHistoriesPartial = $v;
    }

    /**
     * Initializes the collStateHistories collection.
     *
     * By default this just sets the collStateHistories collection to an empty array (like clearcollStateHistories());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initStateHistories(bool $overrideExisting = true): void
    {
        if (null !== $this->collStateHistories && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyOmsOrderItemStateHistoryTableMap::getTableMap()->getCollectionClassName();

        $this->collStateHistories = new $collectionClassName;
        $this->collStateHistories->setModel('\Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateHistory');
    }

    /**
     * Gets an array of SpyOmsOrderItemStateHistory objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySalesOrderItem is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyOmsOrderItemStateHistory[] List of SpyOmsOrderItemStateHistory objects
     * @phpstan-return ObjectCollection&\Traversable<SpyOmsOrderItemStateHistory> List of SpyOmsOrderItemStateHistory objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getStateHistories(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collStateHistoriesPartial && !$this->isNew();
        if (null === $this->collStateHistories || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collStateHistories) {
                    $this->initStateHistories();
                } else {
                    $collectionClassName = SpyOmsOrderItemStateHistoryTableMap::getTableMap()->getCollectionClassName();

                    $collStateHistories = new $collectionClassName;
                    $collStateHistories->setModel('\Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateHistory');

                    return $collStateHistories;
                }
            } else {
                $collStateHistories = SpyOmsOrderItemStateHistoryQuery::create(null, $criteria)
                    ->filterByOrderItem($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collStateHistoriesPartial && count($collStateHistories)) {
                        $this->initStateHistories(false);

                        foreach ($collStateHistories as $obj) {
                            if (false == $this->collStateHistories->contains($obj)) {
                                $this->collStateHistories->append($obj);
                            }
                        }

                        $this->collStateHistoriesPartial = true;
                    }

                    return $collStateHistories;
                }

                if ($partial && $this->collStateHistories) {
                    foreach ($this->collStateHistories as $obj) {
                        if ($obj->isNew()) {
                            $collStateHistories[] = $obj;
                        }
                    }
                }

                $this->collStateHistories = $collStateHistories;
                $this->collStateHistoriesPartial = false;
            }
        }

        return $this->collStateHistories;
    }

    /**
     * Sets a collection of SpyOmsOrderItemStateHistory objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $stateHistories A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setStateHistories(Collection $stateHistories, ?ConnectionInterface $con = null)
    {
        /** @var SpyOmsOrderItemStateHistory[] $stateHistoriesToDelete */
        $stateHistoriesToDelete = $this->getStateHistories(new Criteria(), $con)->diff($stateHistories);


        $this->stateHistoriesScheduledForDeletion = $stateHistoriesToDelete;

        foreach ($stateHistoriesToDelete as $stateHistoryRemoved) {
            $stateHistoryRemoved->setOrderItem(null);
        }

        $this->collStateHistories = null;
        foreach ($stateHistories as $stateHistory) {
            $this->addStateHistory($stateHistory);
        }

        $this->collStateHistories = $stateHistories;
        $this->collStateHistoriesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyOmsOrderItemStateHistory objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyOmsOrderItemStateHistory objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countStateHistories(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collStateHistoriesPartial && !$this->isNew();
        if (null === $this->collStateHistories || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collStateHistories) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getStateHistories());
            }

            $query = SpyOmsOrderItemStateHistoryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrderItem($this)
                ->count($con);
        }

        return count($this->collStateHistories);
    }

    /**
     * Method called to associate a SpyOmsOrderItemStateHistory object to this object
     * through the SpyOmsOrderItemStateHistory foreign key attribute.
     *
     * @param SpyOmsOrderItemStateHistory $l SpyOmsOrderItemStateHistory
     * @return $this The current object (for fluent API support)
     */
    public function addStateHistory(SpyOmsOrderItemStateHistory $l)
    {
        if ($this->collStateHistories === null) {
            $this->initStateHistories();
            $this->collStateHistoriesPartial = true;
        }

        if (!$this->collStateHistories->contains($l)) {
            $this->doAddStateHistory($l);

            if ($this->stateHistoriesScheduledForDeletion and $this->stateHistoriesScheduledForDeletion->contains($l)) {
                $this->stateHistoriesScheduledForDeletion->remove($this->stateHistoriesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyOmsOrderItemStateHistory $stateHistory The SpyOmsOrderItemStateHistory object to add.
     */
    protected function doAddStateHistory(SpyOmsOrderItemStateHistory $stateHistory): void
    {
        $this->collStateHistories[]= $stateHistory;
        $stateHistory->setOrderItem($this);
    }

    /**
     * @param SpyOmsOrderItemStateHistory $stateHistory The SpyOmsOrderItemStateHistory object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeStateHistory(SpyOmsOrderItemStateHistory $stateHistory)
    {
        if ($this->getStateHistories()->contains($stateHistory)) {
            $pos = $this->collStateHistories->search($stateHistory);
            $this->collStateHistories->remove($pos);
            if (null === $this->stateHistoriesScheduledForDeletion) {
                $this->stateHistoriesScheduledForDeletion = clone $this->collStateHistories;
                $this->stateHistoriesScheduledForDeletion->clear();
            }
            $this->stateHistoriesScheduledForDeletion[]= clone $stateHistory;
            $stateHistory->setOrderItem(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySalesOrderItem is new, it will return
     * an empty collection; or if this SpySalesOrderItem has previously
     * been saved, it will retrieve related StateHistories from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySalesOrderItem.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyOmsOrderItemStateHistory[] List of SpyOmsOrderItemStateHistory objects
     * @phpstan-return ObjectCollection&\Traversable<SpyOmsOrderItemStateHistory}> List of SpyOmsOrderItemStateHistory objects
     */
    public function getStateHistoriesJoinState(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyOmsOrderItemStateHistoryQuery::create(null, $criteria);
        $query->joinWith('State', $joinBehavior);

        return $this->getStateHistories($query, $con);
    }

    /**
     * Clears out the collEventTimeouts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addEventTimeouts()
     */
    public function clearEventTimeouts()
    {
        $this->collEventTimeouts = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collEventTimeouts collection loaded partially.
     *
     * @return void
     */
    public function resetPartialEventTimeouts($v = true): void
    {
        $this->collEventTimeoutsPartial = $v;
    }

    /**
     * Initializes the collEventTimeouts collection.
     *
     * By default this just sets the collEventTimeouts collection to an empty array (like clearcollEventTimeouts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEventTimeouts(bool $overrideExisting = true): void
    {
        if (null !== $this->collEventTimeouts && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyOmsEventTimeoutTableMap::getTableMap()->getCollectionClassName();

        $this->collEventTimeouts = new $collectionClassName;
        $this->collEventTimeouts->setModel('\Orm\Zed\Oms\Persistence\SpyOmsEventTimeout');
    }

    /**
     * Gets an array of SpyOmsEventTimeout objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySalesOrderItem is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyOmsEventTimeout[] List of SpyOmsEventTimeout objects
     * @phpstan-return ObjectCollection&\Traversable<SpyOmsEventTimeout> List of SpyOmsEventTimeout objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getEventTimeouts(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collEventTimeoutsPartial && !$this->isNew();
        if (null === $this->collEventTimeouts || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collEventTimeouts) {
                    $this->initEventTimeouts();
                } else {
                    $collectionClassName = SpyOmsEventTimeoutTableMap::getTableMap()->getCollectionClassName();

                    $collEventTimeouts = new $collectionClassName;
                    $collEventTimeouts->setModel('\Orm\Zed\Oms\Persistence\SpyOmsEventTimeout');

                    return $collEventTimeouts;
                }
            } else {
                $collEventTimeouts = SpyOmsEventTimeoutQuery::create(null, $criteria)
                    ->filterByOrderItem($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEventTimeoutsPartial && count($collEventTimeouts)) {
                        $this->initEventTimeouts(false);

                        foreach ($collEventTimeouts as $obj) {
                            if (false == $this->collEventTimeouts->contains($obj)) {
                                $this->collEventTimeouts->append($obj);
                            }
                        }

                        $this->collEventTimeoutsPartial = true;
                    }

                    return $collEventTimeouts;
                }

                if ($partial && $this->collEventTimeouts) {
                    foreach ($this->collEventTimeouts as $obj) {
                        if ($obj->isNew()) {
                            $collEventTimeouts[] = $obj;
                        }
                    }
                }

                $this->collEventTimeouts = $collEventTimeouts;
                $this->collEventTimeoutsPartial = false;
            }
        }

        return $this->collEventTimeouts;
    }

    /**
     * Sets a collection of SpyOmsEventTimeout objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $eventTimeouts A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setEventTimeouts(Collection $eventTimeouts, ?ConnectionInterface $con = null)
    {
        /** @var SpyOmsEventTimeout[] $eventTimeoutsToDelete */
        $eventTimeoutsToDelete = $this->getEventTimeouts(new Criteria(), $con)->diff($eventTimeouts);


        $this->eventTimeoutsScheduledForDeletion = $eventTimeoutsToDelete;

        foreach ($eventTimeoutsToDelete as $eventTimeoutRemoved) {
            $eventTimeoutRemoved->setOrderItem(null);
        }

        $this->collEventTimeouts = null;
        foreach ($eventTimeouts as $eventTimeout) {
            $this->addEventTimeout($eventTimeout);
        }

        $this->collEventTimeouts = $eventTimeouts;
        $this->collEventTimeoutsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyOmsEventTimeout objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyOmsEventTimeout objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countEventTimeouts(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collEventTimeoutsPartial && !$this->isNew();
        if (null === $this->collEventTimeouts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEventTimeouts) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEventTimeouts());
            }

            $query = SpyOmsEventTimeoutQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrderItem($this)
                ->count($con);
        }

        return count($this->collEventTimeouts);
    }

    /**
     * Method called to associate a SpyOmsEventTimeout object to this object
     * through the SpyOmsEventTimeout foreign key attribute.
     *
     * @param SpyOmsEventTimeout $l SpyOmsEventTimeout
     * @return $this The current object (for fluent API support)
     */
    public function addEventTimeout(SpyOmsEventTimeout $l)
    {
        if ($this->collEventTimeouts === null) {
            $this->initEventTimeouts();
            $this->collEventTimeoutsPartial = true;
        }

        if (!$this->collEventTimeouts->contains($l)) {
            $this->doAddEventTimeout($l);

            if ($this->eventTimeoutsScheduledForDeletion and $this->eventTimeoutsScheduledForDeletion->contains($l)) {
                $this->eventTimeoutsScheduledForDeletion->remove($this->eventTimeoutsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyOmsEventTimeout $eventTimeout The SpyOmsEventTimeout object to add.
     */
    protected function doAddEventTimeout(SpyOmsEventTimeout $eventTimeout): void
    {
        $this->collEventTimeouts[]= $eventTimeout;
        $eventTimeout->setOrderItem($this);
    }

    /**
     * @param SpyOmsEventTimeout $eventTimeout The SpyOmsEventTimeout object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeEventTimeout(SpyOmsEventTimeout $eventTimeout)
    {
        if ($this->getEventTimeouts()->contains($eventTimeout)) {
            $pos = $this->collEventTimeouts->search($eventTimeout);
            $this->collEventTimeouts->remove($pos);
            if (null === $this->eventTimeoutsScheduledForDeletion) {
                $this->eventTimeoutsScheduledForDeletion = clone $this->collEventTimeouts;
                $this->eventTimeoutsScheduledForDeletion->clear();
            }
            $this->eventTimeoutsScheduledForDeletion[]= clone $eventTimeout;
            $eventTimeout->setOrderItem(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySalesOrderItem is new, it will return
     * an empty collection; or if this SpySalesOrderItem has previously
     * been saved, it will retrieve related EventTimeouts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySalesOrderItem.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyOmsEventTimeout[] List of SpyOmsEventTimeout objects
     * @phpstan-return ObjectCollection&\Traversable<SpyOmsEventTimeout}> List of SpyOmsEventTimeout objects
     */
    public function getEventTimeoutsJoinState(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyOmsEventTimeoutQuery::create(null, $criteria);
        $query->joinWith('State', $joinBehavior);

        return $this->getEventTimeouts($query, $con);
    }

    /**
     * Clears out the collMetadatas collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addMetadatas()
     */
    public function clearMetadatas()
    {
        $this->collMetadatas = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collMetadatas collection loaded partially.
     *
     * @return void
     */
    public function resetPartialMetadatas($v = true): void
    {
        $this->collMetadatasPartial = $v;
    }

    /**
     * Initializes the collMetadatas collection.
     *
     * By default this just sets the collMetadatas collection to an empty array (like clearcollMetadatas());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initMetadatas(bool $overrideExisting = true): void
    {
        if (null !== $this->collMetadatas && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySalesOrderItemMetadataTableMap::getTableMap()->getCollectionClassName();

        $this->collMetadatas = new $collectionClassName;
        $this->collMetadatas->setModel('\Orm\Zed\Sales\Persistence\SpySalesOrderItemMetadata');
    }

    /**
     * Gets an array of ChildSpySalesOrderItemMetadata objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySalesOrderItem is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpySalesOrderItemMetadata[] List of ChildSpySalesOrderItemMetadata objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySalesOrderItemMetadata> List of ChildSpySalesOrderItemMetadata objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getMetadatas(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collMetadatasPartial && !$this->isNew();
        if (null === $this->collMetadatas || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collMetadatas) {
                    $this->initMetadatas();
                } else {
                    $collectionClassName = SpySalesOrderItemMetadataTableMap::getTableMap()->getCollectionClassName();

                    $collMetadatas = new $collectionClassName;
                    $collMetadatas->setModel('\Orm\Zed\Sales\Persistence\SpySalesOrderItemMetadata');

                    return $collMetadatas;
                }
            } else {
                $collMetadatas = ChildSpySalesOrderItemMetadataQuery::create(null, $criteria)
                    ->filterByOrderItem($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collMetadatasPartial && count($collMetadatas)) {
                        $this->initMetadatas(false);

                        foreach ($collMetadatas as $obj) {
                            if (false == $this->collMetadatas->contains($obj)) {
                                $this->collMetadatas->append($obj);
                            }
                        }

                        $this->collMetadatasPartial = true;
                    }

                    return $collMetadatas;
                }

                if ($partial && $this->collMetadatas) {
                    foreach ($this->collMetadatas as $obj) {
                        if ($obj->isNew()) {
                            $collMetadatas[] = $obj;
                        }
                    }
                }

                $this->collMetadatas = $collMetadatas;
                $this->collMetadatasPartial = false;
            }
        }

        return $this->collMetadatas;
    }

    /**
     * Sets a collection of ChildSpySalesOrderItemMetadata objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $metadatas A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setMetadatas(Collection $metadatas, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpySalesOrderItemMetadata[] $metadatasToDelete */
        $metadatasToDelete = $this->getMetadatas(new Criteria(), $con)->diff($metadatas);


        $this->metadatasScheduledForDeletion = $metadatasToDelete;

        foreach ($metadatasToDelete as $metadataRemoved) {
            $metadataRemoved->setOrderItem(null);
        }

        $this->collMetadatas = null;
        foreach ($metadatas as $metadata) {
            $this->addMetadata($metadata);
        }

        $this->collMetadatas = $metadatas;
        $this->collMetadatasPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpySalesOrderItemMetadata objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpySalesOrderItemMetadata objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countMetadatas(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collMetadatasPartial && !$this->isNew();
        if (null === $this->collMetadatas || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collMetadatas) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getMetadatas());
            }

            $query = ChildSpySalesOrderItemMetadataQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrderItem($this)
                ->count($con);
        }

        return count($this->collMetadatas);
    }

    /**
     * Method called to associate a ChildSpySalesOrderItemMetadata object to this object
     * through the ChildSpySalesOrderItemMetadata foreign key attribute.
     *
     * @param ChildSpySalesOrderItemMetadata $l ChildSpySalesOrderItemMetadata
     * @return $this The current object (for fluent API support)
     */
    public function addMetadata(ChildSpySalesOrderItemMetadata $l)
    {
        if ($this->collMetadatas === null) {
            $this->initMetadatas();
            $this->collMetadatasPartial = true;
        }

        if (!$this->collMetadatas->contains($l)) {
            $this->doAddMetadata($l);

            if ($this->metadatasScheduledForDeletion and $this->metadatasScheduledForDeletion->contains($l)) {
                $this->metadatasScheduledForDeletion->remove($this->metadatasScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpySalesOrderItemMetadata $metadata The ChildSpySalesOrderItemMetadata object to add.
     */
    protected function doAddMetadata(ChildSpySalesOrderItemMetadata $metadata): void
    {
        $this->collMetadatas[]= $metadata;
        $metadata->setOrderItem($this);
    }

    /**
     * @param ChildSpySalesOrderItemMetadata $metadata The ChildSpySalesOrderItemMetadata object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeMetadata(ChildSpySalesOrderItemMetadata $metadata)
    {
        if ($this->getMetadatas()->contains($metadata)) {
            $pos = $this->collMetadatas->search($metadata);
            $this->collMetadatas->remove($pos);
            if (null === $this->metadatasScheduledForDeletion) {
                $this->metadatasScheduledForDeletion = clone $this->collMetadatas;
                $this->metadatasScheduledForDeletion->clear();
            }
            $this->metadatasScheduledForDeletion[]= clone $metadata;
            $metadata->setOrderItem(null);
        }

        return $this;
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
     * If this ChildSpySalesOrderItem is new, it will return
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
                    ->filterByOrderItem($this)
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
            $discountRemoved->setOrderItem(null);
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
                ->filterByOrderItem($this)
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
        $discount->setOrderItem($this);
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
            $discount->setOrderItem(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySalesOrderItem is new, it will return
     * an empty collection; or if this SpySalesOrderItem has previously
     * been saved, it will retrieve related Discounts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySalesOrderItem.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpySalesDiscount[] List of ChildSpySalesDiscount objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySalesDiscount}> List of ChildSpySalesDiscount objects
     */
    public function getDiscountsJoinOrder(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpySalesDiscountQuery::create(null, $criteria);
        $query->joinWith('Order', $joinBehavior);

        return $this->getDiscounts($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySalesOrderItem is new, it will return
     * an empty collection; or if this SpySalesOrderItem has previously
     * been saved, it will retrieve related Discounts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySalesOrderItem.
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
     * Otherwise if this SpySalesOrderItem is new, it will return
     * an empty collection; or if this SpySalesOrderItem has previously
     * been saved, it will retrieve related Discounts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySalesOrderItem.
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
     * Clears out the collOptions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOptions()
     */
    public function clearOptions()
    {
        $this->collOptions = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOptions collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOptions($v = true): void
    {
        $this->collOptionsPartial = $v;
    }

    /**
     * Initializes the collOptions collection.
     *
     * By default this just sets the collOptions collection to an empty array (like clearcollOptions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOptions(bool $overrideExisting = true): void
    {
        if (null !== $this->collOptions && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySalesOrderItemOptionTableMap::getTableMap()->getCollectionClassName();

        $this->collOptions = new $collectionClassName;
        $this->collOptions->setModel('\Orm\Zed\Sales\Persistence\SpySalesOrderItemOption');
    }

    /**
     * Gets an array of ChildSpySalesOrderItemOption objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySalesOrderItem is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpySalesOrderItemOption[] List of ChildSpySalesOrderItemOption objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpySalesOrderItemOption> List of ChildSpySalesOrderItemOption objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOptions(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOptionsPartial && !$this->isNew();
        if (null === $this->collOptions || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOptions) {
                    $this->initOptions();
                } else {
                    $collectionClassName = SpySalesOrderItemOptionTableMap::getTableMap()->getCollectionClassName();

                    $collOptions = new $collectionClassName;
                    $collOptions->setModel('\Orm\Zed\Sales\Persistence\SpySalesOrderItemOption');

                    return $collOptions;
                }
            } else {
                $collOptions = ChildSpySalesOrderItemOptionQuery::create(null, $criteria)
                    ->filterByOrderItem($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOptionsPartial && count($collOptions)) {
                        $this->initOptions(false);

                        foreach ($collOptions as $obj) {
                            if (false == $this->collOptions->contains($obj)) {
                                $this->collOptions->append($obj);
                            }
                        }

                        $this->collOptionsPartial = true;
                    }

                    return $collOptions;
                }

                if ($partial && $this->collOptions) {
                    foreach ($this->collOptions as $obj) {
                        if ($obj->isNew()) {
                            $collOptions[] = $obj;
                        }
                    }
                }

                $this->collOptions = $collOptions;
                $this->collOptionsPartial = false;
            }
        }

        return $this->collOptions;
    }

    /**
     * Sets a collection of ChildSpySalesOrderItemOption objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $options A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOptions(Collection $options, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpySalesOrderItemOption[] $optionsToDelete */
        $optionsToDelete = $this->getOptions(new Criteria(), $con)->diff($options);


        $this->optionsScheduledForDeletion = $optionsToDelete;

        foreach ($optionsToDelete as $optionRemoved) {
            $optionRemoved->setOrderItem(null);
        }

        $this->collOptions = null;
        foreach ($options as $option) {
            $this->addOption($option);
        }

        $this->collOptions = $options;
        $this->collOptionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpySalesOrderItemOption objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpySalesOrderItemOption objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOptions(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOptionsPartial && !$this->isNew();
        if (null === $this->collOptions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOptions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOptions());
            }

            $query = ChildSpySalesOrderItemOptionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrderItem($this)
                ->count($con);
        }

        return count($this->collOptions);
    }

    /**
     * Method called to associate a ChildSpySalesOrderItemOption object to this object
     * through the ChildSpySalesOrderItemOption foreign key attribute.
     *
     * @param ChildSpySalesOrderItemOption $l ChildSpySalesOrderItemOption
     * @return $this The current object (for fluent API support)
     */
    public function addOption(ChildSpySalesOrderItemOption $l)
    {
        if ($this->collOptions === null) {
            $this->initOptions();
            $this->collOptionsPartial = true;
        }

        if (!$this->collOptions->contains($l)) {
            $this->doAddOption($l);

            if ($this->optionsScheduledForDeletion and $this->optionsScheduledForDeletion->contains($l)) {
                $this->optionsScheduledForDeletion->remove($this->optionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpySalesOrderItemOption $option The ChildSpySalesOrderItemOption object to add.
     */
    protected function doAddOption(ChildSpySalesOrderItemOption $option): void
    {
        $this->collOptions[]= $option;
        $option->setOrderItem($this);
    }

    /**
     * @param ChildSpySalesOrderItemOption $option The ChildSpySalesOrderItemOption object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOption(ChildSpySalesOrderItemOption $option)
    {
        if ($this->getOptions()->contains($option)) {
            $pos = $this->collOptions->search($option);
            $this->collOptions->remove($pos);
            if (null === $this->optionsScheduledForDeletion) {
                $this->optionsScheduledForDeletion = clone $this->collOptions;
                $this->optionsScheduledForDeletion->clear();
            }
            $this->optionsScheduledForDeletion[]= clone $option;
            $option->setOrderItem(null);
        }

        return $this;
    }

    /**
     * Clears out the collSpySalesOrderConfiguredBundleItems collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpySalesOrderConfiguredBundleItems()
     */
    public function clearSpySalesOrderConfiguredBundleItems()
    {
        $this->collSpySalesOrderConfiguredBundleItems = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpySalesOrderConfiguredBundleItems collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpySalesOrderConfiguredBundleItems($v = true): void
    {
        $this->collSpySalesOrderConfiguredBundleItemsPartial = $v;
    }

    /**
     * Initializes the collSpySalesOrderConfiguredBundleItems collection.
     *
     * By default this just sets the collSpySalesOrderConfiguredBundleItems collection to an empty array (like clearcollSpySalesOrderConfiguredBundleItems());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpySalesOrderConfiguredBundleItems(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpySalesOrderConfiguredBundleItems && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySalesOrderConfiguredBundleItemTableMap::getTableMap()->getCollectionClassName();

        $this->collSpySalesOrderConfiguredBundleItems = new $collectionClassName;
        $this->collSpySalesOrderConfiguredBundleItems->setModel('\Orm\Zed\SalesConfigurableBundle\Persistence\SpySalesOrderConfiguredBundleItem');
    }

    /**
     * Gets an array of SpySalesOrderConfiguredBundleItem objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySalesOrderItem is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpySalesOrderConfiguredBundleItem[] List of SpySalesOrderConfiguredBundleItem objects
     * @phpstan-return ObjectCollection&\Traversable<SpySalesOrderConfiguredBundleItem> List of SpySalesOrderConfiguredBundleItem objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpySalesOrderConfiguredBundleItems(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpySalesOrderConfiguredBundleItemsPartial && !$this->isNew();
        if (null === $this->collSpySalesOrderConfiguredBundleItems || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpySalesOrderConfiguredBundleItems) {
                    $this->initSpySalesOrderConfiguredBundleItems();
                } else {
                    $collectionClassName = SpySalesOrderConfiguredBundleItemTableMap::getTableMap()->getCollectionClassName();

                    $collSpySalesOrderConfiguredBundleItems = new $collectionClassName;
                    $collSpySalesOrderConfiguredBundleItems->setModel('\Orm\Zed\SalesConfigurableBundle\Persistence\SpySalesOrderConfiguredBundleItem');

                    return $collSpySalesOrderConfiguredBundleItems;
                }
            } else {
                $collSpySalesOrderConfiguredBundleItems = SpySalesOrderConfiguredBundleItemQuery::create(null, $criteria)
                    ->filterBySpySalesOrderItem($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpySalesOrderConfiguredBundleItemsPartial && count($collSpySalesOrderConfiguredBundleItems)) {
                        $this->initSpySalesOrderConfiguredBundleItems(false);

                        foreach ($collSpySalesOrderConfiguredBundleItems as $obj) {
                            if (false == $this->collSpySalesOrderConfiguredBundleItems->contains($obj)) {
                                $this->collSpySalesOrderConfiguredBundleItems->append($obj);
                            }
                        }

                        $this->collSpySalesOrderConfiguredBundleItemsPartial = true;
                    }

                    return $collSpySalesOrderConfiguredBundleItems;
                }

                if ($partial && $this->collSpySalesOrderConfiguredBundleItems) {
                    foreach ($this->collSpySalesOrderConfiguredBundleItems as $obj) {
                        if ($obj->isNew()) {
                            $collSpySalesOrderConfiguredBundleItems[] = $obj;
                        }
                    }
                }

                $this->collSpySalesOrderConfiguredBundleItems = $collSpySalesOrderConfiguredBundleItems;
                $this->collSpySalesOrderConfiguredBundleItemsPartial = false;
            }
        }

        return $this->collSpySalesOrderConfiguredBundleItems;
    }

    /**
     * Sets a collection of SpySalesOrderConfiguredBundleItem objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spySalesOrderConfiguredBundleItems A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpySalesOrderConfiguredBundleItems(Collection $spySalesOrderConfiguredBundleItems, ?ConnectionInterface $con = null)
    {
        /** @var SpySalesOrderConfiguredBundleItem[] $spySalesOrderConfiguredBundleItemsToDelete */
        $spySalesOrderConfiguredBundleItemsToDelete = $this->getSpySalesOrderConfiguredBundleItems(new Criteria(), $con)->diff($spySalesOrderConfiguredBundleItems);


        $this->spySalesOrderConfiguredBundleItemsScheduledForDeletion = $spySalesOrderConfiguredBundleItemsToDelete;

        foreach ($spySalesOrderConfiguredBundleItemsToDelete as $spySalesOrderConfiguredBundleItemRemoved) {
            $spySalesOrderConfiguredBundleItemRemoved->setSpySalesOrderItem(null);
        }

        $this->collSpySalesOrderConfiguredBundleItems = null;
        foreach ($spySalesOrderConfiguredBundleItems as $spySalesOrderConfiguredBundleItem) {
            $this->addSpySalesOrderConfiguredBundleItem($spySalesOrderConfiguredBundleItem);
        }

        $this->collSpySalesOrderConfiguredBundleItems = $spySalesOrderConfiguredBundleItems;
        $this->collSpySalesOrderConfiguredBundleItemsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpySalesOrderConfiguredBundleItem objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpySalesOrderConfiguredBundleItem objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpySalesOrderConfiguredBundleItems(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpySalesOrderConfiguredBundleItemsPartial && !$this->isNew();
        if (null === $this->collSpySalesOrderConfiguredBundleItems || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpySalesOrderConfiguredBundleItems) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpySalesOrderConfiguredBundleItems());
            }

            $query = SpySalesOrderConfiguredBundleItemQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpySalesOrderItem($this)
                ->count($con);
        }

        return count($this->collSpySalesOrderConfiguredBundleItems);
    }

    /**
     * Method called to associate a SpySalesOrderConfiguredBundleItem object to this object
     * through the SpySalesOrderConfiguredBundleItem foreign key attribute.
     *
     * @param SpySalesOrderConfiguredBundleItem $l SpySalesOrderConfiguredBundleItem
     * @return $this The current object (for fluent API support)
     */
    public function addSpySalesOrderConfiguredBundleItem(SpySalesOrderConfiguredBundleItem $l)
    {
        if ($this->collSpySalesOrderConfiguredBundleItems === null) {
            $this->initSpySalesOrderConfiguredBundleItems();
            $this->collSpySalesOrderConfiguredBundleItemsPartial = true;
        }

        if (!$this->collSpySalesOrderConfiguredBundleItems->contains($l)) {
            $this->doAddSpySalesOrderConfiguredBundleItem($l);

            if ($this->spySalesOrderConfiguredBundleItemsScheduledForDeletion and $this->spySalesOrderConfiguredBundleItemsScheduledForDeletion->contains($l)) {
                $this->spySalesOrderConfiguredBundleItemsScheduledForDeletion->remove($this->spySalesOrderConfiguredBundleItemsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpySalesOrderConfiguredBundleItem $spySalesOrderConfiguredBundleItem The SpySalesOrderConfiguredBundleItem object to add.
     */
    protected function doAddSpySalesOrderConfiguredBundleItem(SpySalesOrderConfiguredBundleItem $spySalesOrderConfiguredBundleItem): void
    {
        $this->collSpySalesOrderConfiguredBundleItems[]= $spySalesOrderConfiguredBundleItem;
        $spySalesOrderConfiguredBundleItem->setSpySalesOrderItem($this);
    }

    /**
     * @param SpySalesOrderConfiguredBundleItem $spySalesOrderConfiguredBundleItem The SpySalesOrderConfiguredBundleItem object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpySalesOrderConfiguredBundleItem(SpySalesOrderConfiguredBundleItem $spySalesOrderConfiguredBundleItem)
    {
        if ($this->getSpySalesOrderConfiguredBundleItems()->contains($spySalesOrderConfiguredBundleItem)) {
            $pos = $this->collSpySalesOrderConfiguredBundleItems->search($spySalesOrderConfiguredBundleItem);
            $this->collSpySalesOrderConfiguredBundleItems->remove($pos);
            if (null === $this->spySalesOrderConfiguredBundleItemsScheduledForDeletion) {
                $this->spySalesOrderConfiguredBundleItemsScheduledForDeletion = clone $this->collSpySalesOrderConfiguredBundleItems;
                $this->spySalesOrderConfiguredBundleItemsScheduledForDeletion->clear();
            }
            $this->spySalesOrderConfiguredBundleItemsScheduledForDeletion[]= clone $spySalesOrderConfiguredBundleItem;
            $spySalesOrderConfiguredBundleItem->setSpySalesOrderItem(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySalesOrderItem is new, it will return
     * an empty collection; or if this SpySalesOrderItem has previously
     * been saved, it will retrieve related SpySalesOrderConfiguredBundleItems from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySalesOrderItem.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpySalesOrderConfiguredBundleItem[] List of SpySalesOrderConfiguredBundleItem objects
     * @phpstan-return ObjectCollection&\Traversable<SpySalesOrderConfiguredBundleItem}> List of SpySalesOrderConfiguredBundleItem objects
     */
    public function getSpySalesOrderConfiguredBundleItemsJoinSpySalesOrderConfiguredBundle(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpySalesOrderConfiguredBundleItemQuery::create(null, $criteria);
        $query->joinWith('SpySalesOrderConfiguredBundle', $joinBehavior);

        return $this->getSpySalesOrderConfiguredBundleItems($query, $con);
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
     * If this ChildSpySalesOrderItem is new, it will return
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
                    ->filterBySpySalesOrderItem($this)
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
            $spySalesMerchantCommissionRemoved->setSpySalesOrderItem(null);
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
                ->filterBySpySalesOrderItem($this)
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
        $spySalesMerchantCommission->setSpySalesOrderItem($this);
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
            $this->spySalesMerchantCommissionsScheduledForDeletion[]= $spySalesMerchantCommission;
            $spySalesMerchantCommission->setSpySalesOrderItem(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySalesOrderItem is new, it will return
     * an empty collection; or if this SpySalesOrderItem has previously
     * been saved, it will retrieve related SpySalesMerchantCommissions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySalesOrderItem.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpySalesMerchantCommission[] List of SpySalesMerchantCommission objects
     * @phpstan-return ObjectCollection&\Traversable<SpySalesMerchantCommission}> List of SpySalesMerchantCommission objects
     */
    public function getSpySalesMerchantCommissionsJoinSpySalesOrder(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpySalesMerchantCommissionQuery::create(null, $criteria);
        $query->joinWith('SpySalesOrder', $joinBehavior);

        return $this->getSpySalesMerchantCommissions($query, $con);
    }

    /**
     * Clears out the collSpySalesOrderItemConfigurations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpySalesOrderItemConfigurations()
     */
    public function clearSpySalesOrderItemConfigurations()
    {
        $this->collSpySalesOrderItemConfigurations = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpySalesOrderItemConfigurations collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpySalesOrderItemConfigurations($v = true): void
    {
        $this->collSpySalesOrderItemConfigurationsPartial = $v;
    }

    /**
     * Initializes the collSpySalesOrderItemConfigurations collection.
     *
     * By default this just sets the collSpySalesOrderItemConfigurations collection to an empty array (like clearcollSpySalesOrderItemConfigurations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpySalesOrderItemConfigurations(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpySalesOrderItemConfigurations && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySalesOrderItemConfigurationTableMap::getTableMap()->getCollectionClassName();

        $this->collSpySalesOrderItemConfigurations = new $collectionClassName;
        $this->collSpySalesOrderItemConfigurations->setModel('\Orm\Zed\SalesProductConfiguration\Persistence\SpySalesOrderItemConfiguration');
    }

    /**
     * Gets an array of SpySalesOrderItemConfiguration objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySalesOrderItem is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpySalesOrderItemConfiguration[] List of SpySalesOrderItemConfiguration objects
     * @phpstan-return ObjectCollection&\Traversable<SpySalesOrderItemConfiguration> List of SpySalesOrderItemConfiguration objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpySalesOrderItemConfigurations(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpySalesOrderItemConfigurationsPartial && !$this->isNew();
        if (null === $this->collSpySalesOrderItemConfigurations || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpySalesOrderItemConfigurations) {
                    $this->initSpySalesOrderItemConfigurations();
                } else {
                    $collectionClassName = SpySalesOrderItemConfigurationTableMap::getTableMap()->getCollectionClassName();

                    $collSpySalesOrderItemConfigurations = new $collectionClassName;
                    $collSpySalesOrderItemConfigurations->setModel('\Orm\Zed\SalesProductConfiguration\Persistence\SpySalesOrderItemConfiguration');

                    return $collSpySalesOrderItemConfigurations;
                }
            } else {
                $collSpySalesOrderItemConfigurations = SpySalesOrderItemConfigurationQuery::create(null, $criteria)
                    ->filterBySpySalesOrderItem($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpySalesOrderItemConfigurationsPartial && count($collSpySalesOrderItemConfigurations)) {
                        $this->initSpySalesOrderItemConfigurations(false);

                        foreach ($collSpySalesOrderItemConfigurations as $obj) {
                            if (false == $this->collSpySalesOrderItemConfigurations->contains($obj)) {
                                $this->collSpySalesOrderItemConfigurations->append($obj);
                            }
                        }

                        $this->collSpySalesOrderItemConfigurationsPartial = true;
                    }

                    return $collSpySalesOrderItemConfigurations;
                }

                if ($partial && $this->collSpySalesOrderItemConfigurations) {
                    foreach ($this->collSpySalesOrderItemConfigurations as $obj) {
                        if ($obj->isNew()) {
                            $collSpySalesOrderItemConfigurations[] = $obj;
                        }
                    }
                }

                $this->collSpySalesOrderItemConfigurations = $collSpySalesOrderItemConfigurations;
                $this->collSpySalesOrderItemConfigurationsPartial = false;
            }
        }

        return $this->collSpySalesOrderItemConfigurations;
    }

    /**
     * Sets a collection of SpySalesOrderItemConfiguration objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spySalesOrderItemConfigurations A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpySalesOrderItemConfigurations(Collection $spySalesOrderItemConfigurations, ?ConnectionInterface $con = null)
    {
        /** @var SpySalesOrderItemConfiguration[] $spySalesOrderItemConfigurationsToDelete */
        $spySalesOrderItemConfigurationsToDelete = $this->getSpySalesOrderItemConfigurations(new Criteria(), $con)->diff($spySalesOrderItemConfigurations);


        $this->spySalesOrderItemConfigurationsScheduledForDeletion = $spySalesOrderItemConfigurationsToDelete;

        foreach ($spySalesOrderItemConfigurationsToDelete as $spySalesOrderItemConfigurationRemoved) {
            $spySalesOrderItemConfigurationRemoved->setSpySalesOrderItem(null);
        }

        $this->collSpySalesOrderItemConfigurations = null;
        foreach ($spySalesOrderItemConfigurations as $spySalesOrderItemConfiguration) {
            $this->addSpySalesOrderItemConfiguration($spySalesOrderItemConfiguration);
        }

        $this->collSpySalesOrderItemConfigurations = $spySalesOrderItemConfigurations;
        $this->collSpySalesOrderItemConfigurationsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpySalesOrderItemConfiguration objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpySalesOrderItemConfiguration objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpySalesOrderItemConfigurations(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpySalesOrderItemConfigurationsPartial && !$this->isNew();
        if (null === $this->collSpySalesOrderItemConfigurations || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpySalesOrderItemConfigurations) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpySalesOrderItemConfigurations());
            }

            $query = SpySalesOrderItemConfigurationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpySalesOrderItem($this)
                ->count($con);
        }

        return count($this->collSpySalesOrderItemConfigurations);
    }

    /**
     * Method called to associate a SpySalesOrderItemConfiguration object to this object
     * through the SpySalesOrderItemConfiguration foreign key attribute.
     *
     * @param SpySalesOrderItemConfiguration $l SpySalesOrderItemConfiguration
     * @return $this The current object (for fluent API support)
     */
    public function addSpySalesOrderItemConfiguration(SpySalesOrderItemConfiguration $l)
    {
        if ($this->collSpySalesOrderItemConfigurations === null) {
            $this->initSpySalesOrderItemConfigurations();
            $this->collSpySalesOrderItemConfigurationsPartial = true;
        }

        if (!$this->collSpySalesOrderItemConfigurations->contains($l)) {
            $this->doAddSpySalesOrderItemConfiguration($l);

            if ($this->spySalesOrderItemConfigurationsScheduledForDeletion and $this->spySalesOrderItemConfigurationsScheduledForDeletion->contains($l)) {
                $this->spySalesOrderItemConfigurationsScheduledForDeletion->remove($this->spySalesOrderItemConfigurationsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpySalesOrderItemConfiguration $spySalesOrderItemConfiguration The SpySalesOrderItemConfiguration object to add.
     */
    protected function doAddSpySalesOrderItemConfiguration(SpySalesOrderItemConfiguration $spySalesOrderItemConfiguration): void
    {
        $this->collSpySalesOrderItemConfigurations[]= $spySalesOrderItemConfiguration;
        $spySalesOrderItemConfiguration->setSpySalesOrderItem($this);
    }

    /**
     * @param SpySalesOrderItemConfiguration $spySalesOrderItemConfiguration The SpySalesOrderItemConfiguration object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpySalesOrderItemConfiguration(SpySalesOrderItemConfiguration $spySalesOrderItemConfiguration)
    {
        if ($this->getSpySalesOrderItemConfigurations()->contains($spySalesOrderItemConfiguration)) {
            $pos = $this->collSpySalesOrderItemConfigurations->search($spySalesOrderItemConfiguration);
            $this->collSpySalesOrderItemConfigurations->remove($pos);
            if (null === $this->spySalesOrderItemConfigurationsScheduledForDeletion) {
                $this->spySalesOrderItemConfigurationsScheduledForDeletion = clone $this->collSpySalesOrderItemConfigurations;
                $this->spySalesOrderItemConfigurationsScheduledForDeletion->clear();
            }
            $this->spySalesOrderItemConfigurationsScheduledForDeletion[]= clone $spySalesOrderItemConfiguration;
            $spySalesOrderItemConfiguration->setSpySalesOrderItem(null);
        }

        return $this;
    }

    /**
     * Clears out the collReclamationItems collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addReclamationItems()
     */
    public function clearReclamationItems()
    {
        $this->collReclamationItems = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collReclamationItems collection loaded partially.
     *
     * @return void
     */
    public function resetPartialReclamationItems($v = true): void
    {
        $this->collReclamationItemsPartial = $v;
    }

    /**
     * Initializes the collReclamationItems collection.
     *
     * By default this just sets the collReclamationItems collection to an empty array (like clearcollReclamationItems());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initReclamationItems(bool $overrideExisting = true): void
    {
        if (null !== $this->collReclamationItems && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySalesReclamationItemTableMap::getTableMap()->getCollectionClassName();

        $this->collReclamationItems = new $collectionClassName;
        $this->collReclamationItems->setModel('\Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationItem');
    }

    /**
     * Gets an array of SpySalesReclamationItem objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySalesOrderItem is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpySalesReclamationItem[] List of SpySalesReclamationItem objects
     * @phpstan-return ObjectCollection&\Traversable<SpySalesReclamationItem> List of SpySalesReclamationItem objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getReclamationItems(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collReclamationItemsPartial && !$this->isNew();
        if (null === $this->collReclamationItems || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collReclamationItems) {
                    $this->initReclamationItems();
                } else {
                    $collectionClassName = SpySalesReclamationItemTableMap::getTableMap()->getCollectionClassName();

                    $collReclamationItems = new $collectionClassName;
                    $collReclamationItems->setModel('\Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationItem');

                    return $collReclamationItems;
                }
            } else {
                $collReclamationItems = SpySalesReclamationItemQuery::create(null, $criteria)
                    ->filterByOrderItem($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collReclamationItemsPartial && count($collReclamationItems)) {
                        $this->initReclamationItems(false);

                        foreach ($collReclamationItems as $obj) {
                            if (false == $this->collReclamationItems->contains($obj)) {
                                $this->collReclamationItems->append($obj);
                            }
                        }

                        $this->collReclamationItemsPartial = true;
                    }

                    return $collReclamationItems;
                }

                if ($partial && $this->collReclamationItems) {
                    foreach ($this->collReclamationItems as $obj) {
                        if ($obj->isNew()) {
                            $collReclamationItems[] = $obj;
                        }
                    }
                }

                $this->collReclamationItems = $collReclamationItems;
                $this->collReclamationItemsPartial = false;
            }
        }

        return $this->collReclamationItems;
    }

    /**
     * Sets a collection of SpySalesReclamationItem objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $reclamationItems A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setReclamationItems(Collection $reclamationItems, ?ConnectionInterface $con = null)
    {
        /** @var SpySalesReclamationItem[] $reclamationItemsToDelete */
        $reclamationItemsToDelete = $this->getReclamationItems(new Criteria(), $con)->diff($reclamationItems);


        $this->reclamationItemsScheduledForDeletion = $reclamationItemsToDelete;

        foreach ($reclamationItemsToDelete as $reclamationItemRemoved) {
            $reclamationItemRemoved->setOrderItem(null);
        }

        $this->collReclamationItems = null;
        foreach ($reclamationItems as $reclamationItem) {
            $this->addReclamationItem($reclamationItem);
        }

        $this->collReclamationItems = $reclamationItems;
        $this->collReclamationItemsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpySalesReclamationItem objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpySalesReclamationItem objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countReclamationItems(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collReclamationItemsPartial && !$this->isNew();
        if (null === $this->collReclamationItems || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collReclamationItems) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getReclamationItems());
            }

            $query = SpySalesReclamationItemQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrderItem($this)
                ->count($con);
        }

        return count($this->collReclamationItems);
    }

    /**
     * Method called to associate a SpySalesReclamationItem object to this object
     * through the SpySalesReclamationItem foreign key attribute.
     *
     * @param SpySalesReclamationItem $l SpySalesReclamationItem
     * @return $this The current object (for fluent API support)
     */
    public function addReclamationItem(SpySalesReclamationItem $l)
    {
        if ($this->collReclamationItems === null) {
            $this->initReclamationItems();
            $this->collReclamationItemsPartial = true;
        }

        if (!$this->collReclamationItems->contains($l)) {
            $this->doAddReclamationItem($l);

            if ($this->reclamationItemsScheduledForDeletion and $this->reclamationItemsScheduledForDeletion->contains($l)) {
                $this->reclamationItemsScheduledForDeletion->remove($this->reclamationItemsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpySalesReclamationItem $reclamationItem The SpySalesReclamationItem object to add.
     */
    protected function doAddReclamationItem(SpySalesReclamationItem $reclamationItem): void
    {
        $this->collReclamationItems[]= $reclamationItem;
        $reclamationItem->setOrderItem($this);
    }

    /**
     * @param SpySalesReclamationItem $reclamationItem The SpySalesReclamationItem object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeReclamationItem(SpySalesReclamationItem $reclamationItem)
    {
        if ($this->getReclamationItems()->contains($reclamationItem)) {
            $pos = $this->collReclamationItems->search($reclamationItem);
            $this->collReclamationItems->remove($pos);
            if (null === $this->reclamationItemsScheduledForDeletion) {
                $this->reclamationItemsScheduledForDeletion = clone $this->collReclamationItems;
                $this->reclamationItemsScheduledForDeletion->clear();
            }
            $this->reclamationItemsScheduledForDeletion[]= clone $reclamationItem;
            $reclamationItem->setOrderItem(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySalesOrderItem is new, it will return
     * an empty collection; or if this SpySalesOrderItem has previously
     * been saved, it will retrieve related ReclamationItems from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySalesOrderItem.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpySalesReclamationItem[] List of SpySalesReclamationItem objects
     * @phpstan-return ObjectCollection&\Traversable<SpySalesReclamationItem}> List of SpySalesReclamationItem objects
     */
    public function getReclamationItemsJoinSpySalesReclamation(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpySalesReclamationItemQuery::create(null, $criteria);
        $query->joinWith('SpySalesReclamation', $joinBehavior);

        return $this->getReclamationItems($query, $con);
    }

    /**
     * Clears out the collSpySalesReturnItems collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpySalesReturnItems()
     */
    public function clearSpySalesReturnItems()
    {
        $this->collSpySalesReturnItems = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpySalesReturnItems collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpySalesReturnItems($v = true): void
    {
        $this->collSpySalesReturnItemsPartial = $v;
    }

    /**
     * Initializes the collSpySalesReturnItems collection.
     *
     * By default this just sets the collSpySalesReturnItems collection to an empty array (like clearcollSpySalesReturnItems());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpySalesReturnItems(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpySalesReturnItems && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySalesReturnItemTableMap::getTableMap()->getCollectionClassName();

        $this->collSpySalesReturnItems = new $collectionClassName;
        $this->collSpySalesReturnItems->setModel('\Orm\Zed\SalesReturn\Persistence\SpySalesReturnItem');
    }

    /**
     * Gets an array of SpySalesReturnItem objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySalesOrderItem is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpySalesReturnItem[] List of SpySalesReturnItem objects
     * @phpstan-return ObjectCollection&\Traversable<SpySalesReturnItem> List of SpySalesReturnItem objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpySalesReturnItems(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpySalesReturnItemsPartial && !$this->isNew();
        if (null === $this->collSpySalesReturnItems || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpySalesReturnItems) {
                    $this->initSpySalesReturnItems();
                } else {
                    $collectionClassName = SpySalesReturnItemTableMap::getTableMap()->getCollectionClassName();

                    $collSpySalesReturnItems = new $collectionClassName;
                    $collSpySalesReturnItems->setModel('\Orm\Zed\SalesReturn\Persistence\SpySalesReturnItem');

                    return $collSpySalesReturnItems;
                }
            } else {
                $collSpySalesReturnItems = SpySalesReturnItemQuery::create(null, $criteria)
                    ->filterBySpySalesOrderItem($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpySalesReturnItemsPartial && count($collSpySalesReturnItems)) {
                        $this->initSpySalesReturnItems(false);

                        foreach ($collSpySalesReturnItems as $obj) {
                            if (false == $this->collSpySalesReturnItems->contains($obj)) {
                                $this->collSpySalesReturnItems->append($obj);
                            }
                        }

                        $this->collSpySalesReturnItemsPartial = true;
                    }

                    return $collSpySalesReturnItems;
                }

                if ($partial && $this->collSpySalesReturnItems) {
                    foreach ($this->collSpySalesReturnItems as $obj) {
                        if ($obj->isNew()) {
                            $collSpySalesReturnItems[] = $obj;
                        }
                    }
                }

                $this->collSpySalesReturnItems = $collSpySalesReturnItems;
                $this->collSpySalesReturnItemsPartial = false;
            }
        }

        return $this->collSpySalesReturnItems;
    }

    /**
     * Sets a collection of SpySalesReturnItem objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spySalesReturnItems A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpySalesReturnItems(Collection $spySalesReturnItems, ?ConnectionInterface $con = null)
    {
        /** @var SpySalesReturnItem[] $spySalesReturnItemsToDelete */
        $spySalesReturnItemsToDelete = $this->getSpySalesReturnItems(new Criteria(), $con)->diff($spySalesReturnItems);


        $this->spySalesReturnItemsScheduledForDeletion = $spySalesReturnItemsToDelete;

        foreach ($spySalesReturnItemsToDelete as $spySalesReturnItemRemoved) {
            $spySalesReturnItemRemoved->setSpySalesOrderItem(null);
        }

        $this->collSpySalesReturnItems = null;
        foreach ($spySalesReturnItems as $spySalesReturnItem) {
            $this->addSpySalesReturnItem($spySalesReturnItem);
        }

        $this->collSpySalesReturnItems = $spySalesReturnItems;
        $this->collSpySalesReturnItemsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpySalesReturnItem objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpySalesReturnItem objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpySalesReturnItems(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpySalesReturnItemsPartial && !$this->isNew();
        if (null === $this->collSpySalesReturnItems || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpySalesReturnItems) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpySalesReturnItems());
            }

            $query = SpySalesReturnItemQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpySalesOrderItem($this)
                ->count($con);
        }

        return count($this->collSpySalesReturnItems);
    }

    /**
     * Method called to associate a SpySalesReturnItem object to this object
     * through the SpySalesReturnItem foreign key attribute.
     *
     * @param SpySalesReturnItem $l SpySalesReturnItem
     * @return $this The current object (for fluent API support)
     */
    public function addSpySalesReturnItem(SpySalesReturnItem $l)
    {
        if ($this->collSpySalesReturnItems === null) {
            $this->initSpySalesReturnItems();
            $this->collSpySalesReturnItemsPartial = true;
        }

        if (!$this->collSpySalesReturnItems->contains($l)) {
            $this->doAddSpySalesReturnItem($l);

            if ($this->spySalesReturnItemsScheduledForDeletion and $this->spySalesReturnItemsScheduledForDeletion->contains($l)) {
                $this->spySalesReturnItemsScheduledForDeletion->remove($this->spySalesReturnItemsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpySalesReturnItem $spySalesReturnItem The SpySalesReturnItem object to add.
     */
    protected function doAddSpySalesReturnItem(SpySalesReturnItem $spySalesReturnItem): void
    {
        $this->collSpySalesReturnItems[]= $spySalesReturnItem;
        $spySalesReturnItem->setSpySalesOrderItem($this);
    }

    /**
     * @param SpySalesReturnItem $spySalesReturnItem The SpySalesReturnItem object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpySalesReturnItem(SpySalesReturnItem $spySalesReturnItem)
    {
        if ($this->getSpySalesReturnItems()->contains($spySalesReturnItem)) {
            $pos = $this->collSpySalesReturnItems->search($spySalesReturnItem);
            $this->collSpySalesReturnItems->remove($pos);
            if (null === $this->spySalesReturnItemsScheduledForDeletion) {
                $this->spySalesReturnItemsScheduledForDeletion = clone $this->collSpySalesReturnItems;
                $this->spySalesReturnItemsScheduledForDeletion->clear();
            }
            $this->spySalesReturnItemsScheduledForDeletion[]= clone $spySalesReturnItem;
            $spySalesReturnItem->setSpySalesOrderItem(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySalesOrderItem is new, it will return
     * an empty collection; or if this SpySalesOrderItem has previously
     * been saved, it will retrieve related SpySalesReturnItems from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySalesOrderItem.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpySalesReturnItem[] List of SpySalesReturnItem objects
     * @phpstan-return ObjectCollection&\Traversable<SpySalesReturnItem}> List of SpySalesReturnItem objects
     */
    public function getSpySalesReturnItemsJoinSpySalesReturn(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpySalesReturnItemQuery::create(null, $criteria);
        $query->joinWith('SpySalesReturn', $joinBehavior);

        return $this->getSpySalesReturnItems($query, $con);
    }

    /**
     * Clears out the collSalesOrderItemServicePoints collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSalesOrderItemServicePoints()
     */
    public function clearSalesOrderItemServicePoints()
    {
        $this->collSalesOrderItemServicePoints = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSalesOrderItemServicePoints collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSalesOrderItemServicePoints($v = true): void
    {
        $this->collSalesOrderItemServicePointsPartial = $v;
    }

    /**
     * Initializes the collSalesOrderItemServicePoints collection.
     *
     * By default this just sets the collSalesOrderItemServicePoints collection to an empty array (like clearcollSalesOrderItemServicePoints());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSalesOrderItemServicePoints(bool $overrideExisting = true): void
    {
        if (null !== $this->collSalesOrderItemServicePoints && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySalesOrderItemServicePointTableMap::getTableMap()->getCollectionClassName();

        $this->collSalesOrderItemServicePoints = new $collectionClassName;
        $this->collSalesOrderItemServicePoints->setModel('\Orm\Zed\SalesServicePoint\Persistence\SpySalesOrderItemServicePoint');
    }

    /**
     * Gets an array of SpySalesOrderItemServicePoint objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySalesOrderItem is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpySalesOrderItemServicePoint[] List of SpySalesOrderItemServicePoint objects
     * @phpstan-return ObjectCollection&\Traversable<SpySalesOrderItemServicePoint> List of SpySalesOrderItemServicePoint objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSalesOrderItemServicePoints(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSalesOrderItemServicePointsPartial && !$this->isNew();
        if (null === $this->collSalesOrderItemServicePoints || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSalesOrderItemServicePoints) {
                    $this->initSalesOrderItemServicePoints();
                } else {
                    $collectionClassName = SpySalesOrderItemServicePointTableMap::getTableMap()->getCollectionClassName();

                    $collSalesOrderItemServicePoints = new $collectionClassName;
                    $collSalesOrderItemServicePoints->setModel('\Orm\Zed\SalesServicePoint\Persistence\SpySalesOrderItemServicePoint');

                    return $collSalesOrderItemServicePoints;
                }
            } else {
                $collSalesOrderItemServicePoints = SpySalesOrderItemServicePointQuery::create(null, $criteria)
                    ->filterBySalesOrderItem($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSalesOrderItemServicePointsPartial && count($collSalesOrderItemServicePoints)) {
                        $this->initSalesOrderItemServicePoints(false);

                        foreach ($collSalesOrderItemServicePoints as $obj) {
                            if (false == $this->collSalesOrderItemServicePoints->contains($obj)) {
                                $this->collSalesOrderItemServicePoints->append($obj);
                            }
                        }

                        $this->collSalesOrderItemServicePointsPartial = true;
                    }

                    return $collSalesOrderItemServicePoints;
                }

                if ($partial && $this->collSalesOrderItemServicePoints) {
                    foreach ($this->collSalesOrderItemServicePoints as $obj) {
                        if ($obj->isNew()) {
                            $collSalesOrderItemServicePoints[] = $obj;
                        }
                    }
                }

                $this->collSalesOrderItemServicePoints = $collSalesOrderItemServicePoints;
                $this->collSalesOrderItemServicePointsPartial = false;
            }
        }

        return $this->collSalesOrderItemServicePoints;
    }

    /**
     * Sets a collection of SpySalesOrderItemServicePoint objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $salesOrderItemServicePoints A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSalesOrderItemServicePoints(Collection $salesOrderItemServicePoints, ?ConnectionInterface $con = null)
    {
        /** @var SpySalesOrderItemServicePoint[] $salesOrderItemServicePointsToDelete */
        $salesOrderItemServicePointsToDelete = $this->getSalesOrderItemServicePoints(new Criteria(), $con)->diff($salesOrderItemServicePoints);


        $this->salesOrderItemServicePointsScheduledForDeletion = $salesOrderItemServicePointsToDelete;

        foreach ($salesOrderItemServicePointsToDelete as $salesOrderItemServicePointRemoved) {
            $salesOrderItemServicePointRemoved->setSalesOrderItem(null);
        }

        $this->collSalesOrderItemServicePoints = null;
        foreach ($salesOrderItemServicePoints as $salesOrderItemServicePoint) {
            $this->addSalesOrderItemServicePoint($salesOrderItemServicePoint);
        }

        $this->collSalesOrderItemServicePoints = $salesOrderItemServicePoints;
        $this->collSalesOrderItemServicePointsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpySalesOrderItemServicePoint objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpySalesOrderItemServicePoint objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSalesOrderItemServicePoints(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSalesOrderItemServicePointsPartial && !$this->isNew();
        if (null === $this->collSalesOrderItemServicePoints || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSalesOrderItemServicePoints) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSalesOrderItemServicePoints());
            }

            $query = SpySalesOrderItemServicePointQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySalesOrderItem($this)
                ->count($con);
        }

        return count($this->collSalesOrderItemServicePoints);
    }

    /**
     * Method called to associate a SpySalesOrderItemServicePoint object to this object
     * through the SpySalesOrderItemServicePoint foreign key attribute.
     *
     * @param SpySalesOrderItemServicePoint $l SpySalesOrderItemServicePoint
     * @return $this The current object (for fluent API support)
     */
    public function addSalesOrderItemServicePoint(SpySalesOrderItemServicePoint $l)
    {
        if ($this->collSalesOrderItemServicePoints === null) {
            $this->initSalesOrderItemServicePoints();
            $this->collSalesOrderItemServicePointsPartial = true;
        }

        if (!$this->collSalesOrderItemServicePoints->contains($l)) {
            $this->doAddSalesOrderItemServicePoint($l);

            if ($this->salesOrderItemServicePointsScheduledForDeletion and $this->salesOrderItemServicePointsScheduledForDeletion->contains($l)) {
                $this->salesOrderItemServicePointsScheduledForDeletion->remove($this->salesOrderItemServicePointsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpySalesOrderItemServicePoint $salesOrderItemServicePoint The SpySalesOrderItemServicePoint object to add.
     */
    protected function doAddSalesOrderItemServicePoint(SpySalesOrderItemServicePoint $salesOrderItemServicePoint): void
    {
        $this->collSalesOrderItemServicePoints[]= $salesOrderItemServicePoint;
        $salesOrderItemServicePoint->setSalesOrderItem($this);
    }

    /**
     * @param SpySalesOrderItemServicePoint $salesOrderItemServicePoint The SpySalesOrderItemServicePoint object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSalesOrderItemServicePoint(SpySalesOrderItemServicePoint $salesOrderItemServicePoint)
    {
        if ($this->getSalesOrderItemServicePoints()->contains($salesOrderItemServicePoint)) {
            $pos = $this->collSalesOrderItemServicePoints->search($salesOrderItemServicePoint);
            $this->collSalesOrderItemServicePoints->remove($pos);
            if (null === $this->salesOrderItemServicePointsScheduledForDeletion) {
                $this->salesOrderItemServicePointsScheduledForDeletion = clone $this->collSalesOrderItemServicePoints;
                $this->salesOrderItemServicePointsScheduledForDeletion->clear();
            }
            $this->salesOrderItemServicePointsScheduledForDeletion[]= clone $salesOrderItemServicePoint;
            $salesOrderItemServicePoint->setSalesOrderItem(null);
        }

        return $this;
    }

    /**
     * Clears out the collSpySalesOrderItemProductClasses collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpySalesOrderItemProductClasses()
     */
    public function clearSpySalesOrderItemProductClasses()
    {
        $this->collSpySalesOrderItemProductClasses = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpySalesOrderItemProductClasses collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpySalesOrderItemProductClasses($v = true): void
    {
        $this->collSpySalesOrderItemProductClassesPartial = $v;
    }

    /**
     * Initializes the collSpySalesOrderItemProductClasses collection.
     *
     * By default this just sets the collSpySalesOrderItemProductClasses collection to an empty array (like clearcollSpySalesOrderItemProductClasses());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpySalesOrderItemProductClasses(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpySalesOrderItemProductClasses && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySalesOrderItemProductClassTableMap::getTableMap()->getCollectionClassName();

        $this->collSpySalesOrderItemProductClasses = new $collectionClassName;
        $this->collSpySalesOrderItemProductClasses->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemProductClass');
    }

    /**
     * Gets an array of SpySalesOrderItemProductClass objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySalesOrderItem is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpySalesOrderItemProductClass[] List of SpySalesOrderItemProductClass objects
     * @phpstan-return ObjectCollection&\Traversable<SpySalesOrderItemProductClass> List of SpySalesOrderItemProductClass objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpySalesOrderItemProductClasses(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpySalesOrderItemProductClassesPartial && !$this->isNew();
        if (null === $this->collSpySalesOrderItemProductClasses || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpySalesOrderItemProductClasses) {
                    $this->initSpySalesOrderItemProductClasses();
                } else {
                    $collectionClassName = SpySalesOrderItemProductClassTableMap::getTableMap()->getCollectionClassName();

                    $collSpySalesOrderItemProductClasses = new $collectionClassName;
                    $collSpySalesOrderItemProductClasses->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemProductClass');

                    return $collSpySalesOrderItemProductClasses;
                }
            } else {
                $collSpySalesOrderItemProductClasses = SpySalesOrderItemProductClassQuery::create(null, $criteria)
                    ->filterBySpySalesOrderItem($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpySalesOrderItemProductClassesPartial && count($collSpySalesOrderItemProductClasses)) {
                        $this->initSpySalesOrderItemProductClasses(false);

                        foreach ($collSpySalesOrderItemProductClasses as $obj) {
                            if (false == $this->collSpySalesOrderItemProductClasses->contains($obj)) {
                                $this->collSpySalesOrderItemProductClasses->append($obj);
                            }
                        }

                        $this->collSpySalesOrderItemProductClassesPartial = true;
                    }

                    return $collSpySalesOrderItemProductClasses;
                }

                if ($partial && $this->collSpySalesOrderItemProductClasses) {
                    foreach ($this->collSpySalesOrderItemProductClasses as $obj) {
                        if ($obj->isNew()) {
                            $collSpySalesOrderItemProductClasses[] = $obj;
                        }
                    }
                }

                $this->collSpySalesOrderItemProductClasses = $collSpySalesOrderItemProductClasses;
                $this->collSpySalesOrderItemProductClassesPartial = false;
            }
        }

        return $this->collSpySalesOrderItemProductClasses;
    }

    /**
     * Sets a collection of SpySalesOrderItemProductClass objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spySalesOrderItemProductClasses A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpySalesOrderItemProductClasses(Collection $spySalesOrderItemProductClasses, ?ConnectionInterface $con = null)
    {
        /** @var SpySalesOrderItemProductClass[] $spySalesOrderItemProductClassesToDelete */
        $spySalesOrderItemProductClassesToDelete = $this->getSpySalesOrderItemProductClasses(new Criteria(), $con)->diff($spySalesOrderItemProductClasses);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->spySalesOrderItemProductClassesScheduledForDeletion = clone $spySalesOrderItemProductClassesToDelete;

        foreach ($spySalesOrderItemProductClassesToDelete as $spySalesOrderItemProductClassRemoved) {
            $spySalesOrderItemProductClassRemoved->setSpySalesOrderItem(null);
        }

        $this->collSpySalesOrderItemProductClasses = null;
        foreach ($spySalesOrderItemProductClasses as $spySalesOrderItemProductClass) {
            $this->addSpySalesOrderItemProductClass($spySalesOrderItemProductClass);
        }

        $this->collSpySalesOrderItemProductClasses = $spySalesOrderItemProductClasses;
        $this->collSpySalesOrderItemProductClassesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpySalesOrderItemProductClass objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpySalesOrderItemProductClass objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpySalesOrderItemProductClasses(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpySalesOrderItemProductClassesPartial && !$this->isNew();
        if (null === $this->collSpySalesOrderItemProductClasses || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpySalesOrderItemProductClasses) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpySalesOrderItemProductClasses());
            }

            $query = SpySalesOrderItemProductClassQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpySalesOrderItem($this)
                ->count($con);
        }

        return count($this->collSpySalesOrderItemProductClasses);
    }

    /**
     * Method called to associate a SpySalesOrderItemProductClass object to this object
     * through the SpySalesOrderItemProductClass foreign key attribute.
     *
     * @param SpySalesOrderItemProductClass $l SpySalesOrderItemProductClass
     * @return $this The current object (for fluent API support)
     */
    public function addSpySalesOrderItemProductClass(SpySalesOrderItemProductClass $l)
    {
        if ($this->collSpySalesOrderItemProductClasses === null) {
            $this->initSpySalesOrderItemProductClasses();
            $this->collSpySalesOrderItemProductClassesPartial = true;
        }

        if (!$this->collSpySalesOrderItemProductClasses->contains($l)) {
            $this->doAddSpySalesOrderItemProductClass($l);

            if ($this->spySalesOrderItemProductClassesScheduledForDeletion and $this->spySalesOrderItemProductClassesScheduledForDeletion->contains($l)) {
                $this->spySalesOrderItemProductClassesScheduledForDeletion->remove($this->spySalesOrderItemProductClassesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpySalesOrderItemProductClass $spySalesOrderItemProductClass The SpySalesOrderItemProductClass object to add.
     */
    protected function doAddSpySalesOrderItemProductClass(SpySalesOrderItemProductClass $spySalesOrderItemProductClass): void
    {
        $this->collSpySalesOrderItemProductClasses[]= $spySalesOrderItemProductClass;
        $spySalesOrderItemProductClass->setSpySalesOrderItem($this);
    }

    /**
     * @param SpySalesOrderItemProductClass $spySalesOrderItemProductClass The SpySalesOrderItemProductClass object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpySalesOrderItemProductClass(SpySalesOrderItemProductClass $spySalesOrderItemProductClass)
    {
        if ($this->getSpySalesOrderItemProductClasses()->contains($spySalesOrderItemProductClass)) {
            $pos = $this->collSpySalesOrderItemProductClasses->search($spySalesOrderItemProductClass);
            $this->collSpySalesOrderItemProductClasses->remove($pos);
            if (null === $this->spySalesOrderItemProductClassesScheduledForDeletion) {
                $this->spySalesOrderItemProductClassesScheduledForDeletion = clone $this->collSpySalesOrderItemProductClasses;
                $this->spySalesOrderItemProductClassesScheduledForDeletion->clear();
            }
            $this->spySalesOrderItemProductClassesScheduledForDeletion[]= clone $spySalesOrderItemProductClass;
            $spySalesOrderItemProductClass->setSpySalesOrderItem(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySalesOrderItem is new, it will return
     * an empty collection; or if this SpySalesOrderItem has previously
     * been saved, it will retrieve related SpySalesOrderItemProductClasses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySalesOrderItem.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpySalesOrderItemProductClass[] List of SpySalesOrderItemProductClass objects
     * @phpstan-return ObjectCollection&\Traversable<SpySalesOrderItemProductClass}> List of SpySalesOrderItemProductClass objects
     */
    public function getSpySalesOrderItemProductClassesJoinSpySalesProductClass(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpySalesOrderItemProductClassQuery::create(null, $criteria);
        $query->joinWith('SpySalesProductClass', $joinBehavior);

        return $this->getSpySalesOrderItemProductClasses($query, $con);
    }

    /**
     * Clears out the collSpySspInquirySalesOrderItems collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpySspInquirySalesOrderItems()
     */
    public function clearSpySspInquirySalesOrderItems()
    {
        $this->collSpySspInquirySalesOrderItems = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpySspInquirySalesOrderItems collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpySspInquirySalesOrderItems($v = true): void
    {
        $this->collSpySspInquirySalesOrderItemsPartial = $v;
    }

    /**
     * Initializes the collSpySspInquirySalesOrderItems collection.
     *
     * By default this just sets the collSpySspInquirySalesOrderItems collection to an empty array (like clearcollSpySspInquirySalesOrderItems());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpySspInquirySalesOrderItems(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpySspInquirySalesOrderItems && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySspInquirySalesOrderItemTableMap::getTableMap()->getCollectionClassName();

        $this->collSpySspInquirySalesOrderItems = new $collectionClassName;
        $this->collSpySspInquirySalesOrderItems->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderItem');
    }

    /**
     * Gets an array of SpySspInquirySalesOrderItem objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySalesOrderItem is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpySspInquirySalesOrderItem[] List of SpySspInquirySalesOrderItem objects
     * @phpstan-return ObjectCollection&\Traversable<SpySspInquirySalesOrderItem> List of SpySspInquirySalesOrderItem objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpySspInquirySalesOrderItems(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpySspInquirySalesOrderItemsPartial && !$this->isNew();
        if (null === $this->collSpySspInquirySalesOrderItems || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpySspInquirySalesOrderItems) {
                    $this->initSpySspInquirySalesOrderItems();
                } else {
                    $collectionClassName = SpySspInquirySalesOrderItemTableMap::getTableMap()->getCollectionClassName();

                    $collSpySspInquirySalesOrderItems = new $collectionClassName;
                    $collSpySspInquirySalesOrderItems->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderItem');

                    return $collSpySspInquirySalesOrderItems;
                }
            } else {
                $collSpySspInquirySalesOrderItems = SpySspInquirySalesOrderItemQuery::create(null, $criteria)
                    ->filterBySpySalesOrderItem($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpySspInquirySalesOrderItemsPartial && count($collSpySspInquirySalesOrderItems)) {
                        $this->initSpySspInquirySalesOrderItems(false);

                        foreach ($collSpySspInquirySalesOrderItems as $obj) {
                            if (false == $this->collSpySspInquirySalesOrderItems->contains($obj)) {
                                $this->collSpySspInquirySalesOrderItems->append($obj);
                            }
                        }

                        $this->collSpySspInquirySalesOrderItemsPartial = true;
                    }

                    return $collSpySspInquirySalesOrderItems;
                }

                if ($partial && $this->collSpySspInquirySalesOrderItems) {
                    foreach ($this->collSpySspInquirySalesOrderItems as $obj) {
                        if ($obj->isNew()) {
                            $collSpySspInquirySalesOrderItems[] = $obj;
                        }
                    }
                }

                $this->collSpySspInquirySalesOrderItems = $collSpySspInquirySalesOrderItems;
                $this->collSpySspInquirySalesOrderItemsPartial = false;
            }
        }

        return $this->collSpySspInquirySalesOrderItems;
    }

    /**
     * Sets a collection of SpySspInquirySalesOrderItem objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spySspInquirySalesOrderItems A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpySspInquirySalesOrderItems(Collection $spySspInquirySalesOrderItems, ?ConnectionInterface $con = null)
    {
        /** @var SpySspInquirySalesOrderItem[] $spySspInquirySalesOrderItemsToDelete */
        $spySspInquirySalesOrderItemsToDelete = $this->getSpySspInquirySalesOrderItems(new Criteria(), $con)->diff($spySspInquirySalesOrderItems);


        $this->spySspInquirySalesOrderItemsScheduledForDeletion = $spySspInquirySalesOrderItemsToDelete;

        foreach ($spySspInquirySalesOrderItemsToDelete as $spySspInquirySalesOrderItemRemoved) {
            $spySspInquirySalesOrderItemRemoved->setSpySalesOrderItem(null);
        }

        $this->collSpySspInquirySalesOrderItems = null;
        foreach ($spySspInquirySalesOrderItems as $spySspInquirySalesOrderItem) {
            $this->addSpySspInquirySalesOrderItem($spySspInquirySalesOrderItem);
        }

        $this->collSpySspInquirySalesOrderItems = $spySspInquirySalesOrderItems;
        $this->collSpySspInquirySalesOrderItemsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpySspInquirySalesOrderItem objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpySspInquirySalesOrderItem objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpySspInquirySalesOrderItems(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpySspInquirySalesOrderItemsPartial && !$this->isNew();
        if (null === $this->collSpySspInquirySalesOrderItems || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpySspInquirySalesOrderItems) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpySspInquirySalesOrderItems());
            }

            $query = SpySspInquirySalesOrderItemQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpySalesOrderItem($this)
                ->count($con);
        }

        return count($this->collSpySspInquirySalesOrderItems);
    }

    /**
     * Method called to associate a SpySspInquirySalesOrderItem object to this object
     * through the SpySspInquirySalesOrderItem foreign key attribute.
     *
     * @param SpySspInquirySalesOrderItem $l SpySspInquirySalesOrderItem
     * @return $this The current object (for fluent API support)
     */
    public function addSpySspInquirySalesOrderItem(SpySspInquirySalesOrderItem $l)
    {
        if ($this->collSpySspInquirySalesOrderItems === null) {
            $this->initSpySspInquirySalesOrderItems();
            $this->collSpySspInquirySalesOrderItemsPartial = true;
        }

        if (!$this->collSpySspInquirySalesOrderItems->contains($l)) {
            $this->doAddSpySspInquirySalesOrderItem($l);

            if ($this->spySspInquirySalesOrderItemsScheduledForDeletion and $this->spySspInquirySalesOrderItemsScheduledForDeletion->contains($l)) {
                $this->spySspInquirySalesOrderItemsScheduledForDeletion->remove($this->spySspInquirySalesOrderItemsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpySspInquirySalesOrderItem $spySspInquirySalesOrderItem The SpySspInquirySalesOrderItem object to add.
     */
    protected function doAddSpySspInquirySalesOrderItem(SpySspInquirySalesOrderItem $spySspInquirySalesOrderItem): void
    {
        $this->collSpySspInquirySalesOrderItems[]= $spySspInquirySalesOrderItem;
        $spySspInquirySalesOrderItem->setSpySalesOrderItem($this);
    }

    /**
     * @param SpySspInquirySalesOrderItem $spySspInquirySalesOrderItem The SpySspInquirySalesOrderItem object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpySspInquirySalesOrderItem(SpySspInquirySalesOrderItem $spySspInquirySalesOrderItem)
    {
        if ($this->getSpySspInquirySalesOrderItems()->contains($spySspInquirySalesOrderItem)) {
            $pos = $this->collSpySspInquirySalesOrderItems->search($spySspInquirySalesOrderItem);
            $this->collSpySspInquirySalesOrderItems->remove($pos);
            if (null === $this->spySspInquirySalesOrderItemsScheduledForDeletion) {
                $this->spySspInquirySalesOrderItemsScheduledForDeletion = clone $this->collSpySspInquirySalesOrderItems;
                $this->spySspInquirySalesOrderItemsScheduledForDeletion->clear();
            }
            $this->spySspInquirySalesOrderItemsScheduledForDeletion[]= clone $spySspInquirySalesOrderItem;
            $spySspInquirySalesOrderItem->setSpySalesOrderItem(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpySalesOrderItem is new, it will return
     * an empty collection; or if this SpySalesOrderItem has previously
     * been saved, it will retrieve related SpySspInquirySalesOrderItems from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpySalesOrderItem.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpySspInquirySalesOrderItem[] List of SpySspInquirySalesOrderItem objects
     * @phpstan-return ObjectCollection&\Traversable<SpySspInquirySalesOrderItem}> List of SpySspInquirySalesOrderItem objects
     */
    public function getSpySspInquirySalesOrderItemsJoinSpySspInquirySalesOrder(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpySspInquirySalesOrderItemQuery::create(null, $criteria);
        $query->joinWith('SpySspInquirySalesOrder', $joinBehavior);

        return $this->getSpySspInquirySalesOrderItems($query, $con);
    }

    /**
     * Clears out the collSalesOrderItemSspAssets collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSalesOrderItemSspAssets()
     */
    public function clearSalesOrderItemSspAssets()
    {
        $this->collSalesOrderItemSspAssets = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSalesOrderItemSspAssets collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSalesOrderItemSspAssets($v = true): void
    {
        $this->collSalesOrderItemSspAssetsPartial = $v;
    }

    /**
     * Initializes the collSalesOrderItemSspAssets collection.
     *
     * By default this just sets the collSalesOrderItemSspAssets collection to an empty array (like clearcollSalesOrderItemSspAssets());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSalesOrderItemSspAssets(bool $overrideExisting = true): void
    {
        if (null !== $this->collSalesOrderItemSspAssets && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySalesOrderItemSspAssetTableMap::getTableMap()->getCollectionClassName();

        $this->collSalesOrderItemSspAssets = new $collectionClassName;
        $this->collSalesOrderItemSspAssets->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemSspAsset');
    }

    /**
     * Gets an array of SpySalesOrderItemSspAsset objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySalesOrderItem is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpySalesOrderItemSspAsset[] List of SpySalesOrderItemSspAsset objects
     * @phpstan-return ObjectCollection&\Traversable<SpySalesOrderItemSspAsset> List of SpySalesOrderItemSspAsset objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSalesOrderItemSspAssets(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSalesOrderItemSspAssetsPartial && !$this->isNew();
        if (null === $this->collSalesOrderItemSspAssets || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSalesOrderItemSspAssets) {
                    $this->initSalesOrderItemSspAssets();
                } else {
                    $collectionClassName = SpySalesOrderItemSspAssetTableMap::getTableMap()->getCollectionClassName();

                    $collSalesOrderItemSspAssets = new $collectionClassName;
                    $collSalesOrderItemSspAssets->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemSspAsset');

                    return $collSalesOrderItemSspAssets;
                }
            } else {
                $collSalesOrderItemSspAssets = SpySalesOrderItemSspAssetQuery::create(null, $criteria)
                    ->filterBySalesOrderItem($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSalesOrderItemSspAssetsPartial && count($collSalesOrderItemSspAssets)) {
                        $this->initSalesOrderItemSspAssets(false);

                        foreach ($collSalesOrderItemSspAssets as $obj) {
                            if (false == $this->collSalesOrderItemSspAssets->contains($obj)) {
                                $this->collSalesOrderItemSspAssets->append($obj);
                            }
                        }

                        $this->collSalesOrderItemSspAssetsPartial = true;
                    }

                    return $collSalesOrderItemSspAssets;
                }

                if ($partial && $this->collSalesOrderItemSspAssets) {
                    foreach ($this->collSalesOrderItemSspAssets as $obj) {
                        if ($obj->isNew()) {
                            $collSalesOrderItemSspAssets[] = $obj;
                        }
                    }
                }

                $this->collSalesOrderItemSspAssets = $collSalesOrderItemSspAssets;
                $this->collSalesOrderItemSspAssetsPartial = false;
            }
        }

        return $this->collSalesOrderItemSspAssets;
    }

    /**
     * Sets a collection of SpySalesOrderItemSspAsset objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $salesOrderItemSspAssets A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSalesOrderItemSspAssets(Collection $salesOrderItemSspAssets, ?ConnectionInterface $con = null)
    {
        /** @var SpySalesOrderItemSspAsset[] $salesOrderItemSspAssetsToDelete */
        $salesOrderItemSspAssetsToDelete = $this->getSalesOrderItemSspAssets(new Criteria(), $con)->diff($salesOrderItemSspAssets);


        $this->salesOrderItemSspAssetsScheduledForDeletion = $salesOrderItemSspAssetsToDelete;

        foreach ($salesOrderItemSspAssetsToDelete as $salesOrderItemSspAssetRemoved) {
            $salesOrderItemSspAssetRemoved->setSalesOrderItem(null);
        }

        $this->collSalesOrderItemSspAssets = null;
        foreach ($salesOrderItemSspAssets as $salesOrderItemSspAsset) {
            $this->addSalesOrderItemSspAsset($salesOrderItemSspAsset);
        }

        $this->collSalesOrderItemSspAssets = $salesOrderItemSspAssets;
        $this->collSalesOrderItemSspAssetsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpySalesOrderItemSspAsset objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpySalesOrderItemSspAsset objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSalesOrderItemSspAssets(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSalesOrderItemSspAssetsPartial && !$this->isNew();
        if (null === $this->collSalesOrderItemSspAssets || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSalesOrderItemSspAssets) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSalesOrderItemSspAssets());
            }

            $query = SpySalesOrderItemSspAssetQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySalesOrderItem($this)
                ->count($con);
        }

        return count($this->collSalesOrderItemSspAssets);
    }

    /**
     * Method called to associate a SpySalesOrderItemSspAsset object to this object
     * through the SpySalesOrderItemSspAsset foreign key attribute.
     *
     * @param SpySalesOrderItemSspAsset $l SpySalesOrderItemSspAsset
     * @return $this The current object (for fluent API support)
     */
    public function addSalesOrderItemSspAsset(SpySalesOrderItemSspAsset $l)
    {
        if ($this->collSalesOrderItemSspAssets === null) {
            $this->initSalesOrderItemSspAssets();
            $this->collSalesOrderItemSspAssetsPartial = true;
        }

        if (!$this->collSalesOrderItemSspAssets->contains($l)) {
            $this->doAddSalesOrderItemSspAsset($l);

            if ($this->salesOrderItemSspAssetsScheduledForDeletion and $this->salesOrderItemSspAssetsScheduledForDeletion->contains($l)) {
                $this->salesOrderItemSspAssetsScheduledForDeletion->remove($this->salesOrderItemSspAssetsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpySalesOrderItemSspAsset $salesOrderItemSspAsset The SpySalesOrderItemSspAsset object to add.
     */
    protected function doAddSalesOrderItemSspAsset(SpySalesOrderItemSspAsset $salesOrderItemSspAsset): void
    {
        $this->collSalesOrderItemSspAssets[]= $salesOrderItemSspAsset;
        $salesOrderItemSspAsset->setSalesOrderItem($this);
    }

    /**
     * @param SpySalesOrderItemSspAsset $salesOrderItemSspAsset The SpySalesOrderItemSspAsset object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSalesOrderItemSspAsset(SpySalesOrderItemSspAsset $salesOrderItemSspAsset)
    {
        if ($this->getSalesOrderItemSspAssets()->contains($salesOrderItemSspAsset)) {
            $pos = $this->collSalesOrderItemSspAssets->search($salesOrderItemSspAsset);
            $this->collSalesOrderItemSspAssets->remove($pos);
            if (null === $this->salesOrderItemSspAssetsScheduledForDeletion) {
                $this->salesOrderItemSspAssetsScheduledForDeletion = clone $this->collSalesOrderItemSspAssets;
                $this->salesOrderItemSspAssetsScheduledForDeletion->clear();
            }
            $this->salesOrderItemSspAssetsScheduledForDeletion[]= clone $salesOrderItemSspAsset;
            $salesOrderItemSspAsset->setSalesOrderItem(null);
        }

        return $this;
    }

    /**
     * Clears out the collSpySalesProductClasses collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSpySalesProductClasses()
     */
    public function clearSpySalesProductClasses()
    {
        $this->collSpySalesProductClasses = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collSpySalesProductClasses crossRef collection.
     *
     * By default this just sets the collSpySalesProductClasses collection to an empty collection (like clearSpySalesProductClasses());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initSpySalesProductClasses()
    {
        $collectionClassName = SpySalesOrderItemProductClassTableMap::getTableMap()->getCollectionClassName();

        $this->collSpySalesProductClasses = new $collectionClassName;
        $this->collSpySalesProductClassesPartial = true;
        $this->collSpySalesProductClasses->setModel('\Orm\Zed\SelfServicePortal\Persistence\SpySalesProductClass');
    }

    /**
     * Checks if the collSpySalesProductClasses collection is loaded.
     *
     * @return bool
     */
    public function isSpySalesProductClassesLoaded(): bool
    {
        return null !== $this->collSpySalesProductClasses;
    }

    /**
     * Gets a collection of SpySalesProductClass objects related by a many-to-many relationship
     * to the current object by way of the spy_sales_order_item_product_class cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpySalesOrderItem is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|SpySalesProductClass[] List of SpySalesProductClass objects
     * @phpstan-return ObjectCollection&\Traversable<SpySalesProductClass> List of SpySalesProductClass objects
     */
    public function getSpySalesProductClasses(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpySalesProductClassesPartial && !$this->isNew();
        if (null === $this->collSpySalesProductClasses || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpySalesProductClasses) {
                    $this->initSpySalesProductClasses();
                }
            } else {

                $query = SpySalesProductClassQuery::create(null, $criteria)
                    ->filterBySpySalesOrderItem($this);
                $collSpySalesProductClasses = $query->find($con);
                if (null !== $criteria) {
                    return $collSpySalesProductClasses;
                }

                if ($partial && $this->collSpySalesProductClasses) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collSpySalesProductClasses as $obj) {
                        if (!$collSpySalesProductClasses->contains($obj)) {
                            $collSpySalesProductClasses[] = $obj;
                        }
                    }
                }

                $this->collSpySalesProductClasses = $collSpySalesProductClasses;
                $this->collSpySalesProductClassesPartial = false;
            }
        }

        return $this->collSpySalesProductClasses;
    }

    /**
     * Sets a collection of SpySalesProductClass objects related by a many-to-many relationship
     * to the current object by way of the spy_sales_order_item_product_class cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spySalesProductClasses A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpySalesProductClasses(Collection $spySalesProductClasses, ?ConnectionInterface $con = null)
    {
        $this->clearSpySalesProductClasses();
        $currentSpySalesProductClasses = $this->getSpySalesProductClasses();

        $spySalesProductClassesScheduledForDeletion = $currentSpySalesProductClasses->diff($spySalesProductClasses);

        foreach ($spySalesProductClassesScheduledForDeletion as $toDelete) {
            $this->removeSpySalesProductClass($toDelete);
        }

        foreach ($spySalesProductClasses as $spySalesProductClass) {
            if (!$currentSpySalesProductClasses->contains($spySalesProductClass)) {
                $this->doAddSpySalesProductClass($spySalesProductClass);
            }
        }

        $this->collSpySalesProductClassesPartial = false;
        $this->collSpySalesProductClasses = $spySalesProductClasses;

        return $this;
    }

    /**
     * Gets the number of SpySalesProductClass objects related by a many-to-many relationship
     * to the current object by way of the spy_sales_order_item_product_class cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param bool $distinct Set to true to force count distinct
     * @param ConnectionInterface $con Optional connection object
     *
     * @return int The number of related SpySalesProductClass objects
     */
    public function countSpySalesProductClasses(?Criteria $criteria = null, $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpySalesProductClassesPartial && !$this->isNew();
        if (null === $this->collSpySalesProductClasses || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpySalesProductClasses) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getSpySalesProductClasses());
                }

                $query = SpySalesProductClassQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterBySpySalesOrderItem($this)
                    ->count($con);
            }
        } else {
            return count($this->collSpySalesProductClasses);
        }
    }

    /**
     * Associate a SpySalesProductClass to this object
     * through the spy_sales_order_item_product_class cross reference table.
     *
     * @param SpySalesProductClass $spySalesProductClass
     * @return ChildSpySalesOrderItem The current object (for fluent API support)
     */
    public function addSpySalesProductClass(SpySalesProductClass $spySalesProductClass)
    {
        if ($this->collSpySalesProductClasses === null) {
            $this->initSpySalesProductClasses();
        }

        if (!$this->getSpySalesProductClasses()->contains($spySalesProductClass)) {
            // only add it if the **same** object is not already associated
            $this->collSpySalesProductClasses->push($spySalesProductClass);
            $this->doAddSpySalesProductClass($spySalesProductClass);
        }

        return $this;
    }

    /**
     *
     * @param SpySalesProductClass $spySalesProductClass
     */
    protected function doAddSpySalesProductClass(SpySalesProductClass $spySalesProductClass)
    {
        $spySalesOrderItemProductClass = new SpySalesOrderItemProductClass();

        $spySalesOrderItemProductClass->setSpySalesProductClass($spySalesProductClass);

        $spySalesOrderItemProductClass->setSpySalesOrderItem($this);

        $this->addSpySalesOrderItemProductClass($spySalesOrderItemProductClass);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$spySalesProductClass->isSpySalesOrderItemsLoaded()) {
            $spySalesProductClass->initSpySalesOrderItems();
            $spySalesProductClass->getSpySalesOrderItems()->push($this);
        } elseif (!$spySalesProductClass->getSpySalesOrderItems()->contains($this)) {
            $spySalesProductClass->getSpySalesOrderItems()->push($this);
        }

    }

    /**
     * Remove spySalesProductClass of this object
     * through the spy_sales_order_item_product_class cross reference table.
     *
     * @param SpySalesProductClass $spySalesProductClass
     * @return ChildSpySalesOrderItem The current object (for fluent API support)
     */
    public function removeSpySalesProductClass(SpySalesProductClass $spySalesProductClass)
    {
        if ($this->getSpySalesProductClasses()->contains($spySalesProductClass)) {
            $spySalesOrderItemProductClass = new SpySalesOrderItemProductClass();
            $spySalesOrderItemProductClass->setSpySalesProductClass($spySalesProductClass);
            if ($spySalesProductClass->isSpySalesOrderItemsLoaded()) {
                //remove the back reference if available
                $spySalesProductClass->getSpySalesOrderItems()->removeObject($this);
            }

            $spySalesOrderItemProductClass->setSpySalesOrderItem($this);
            $this->removeSpySalesOrderItemProductClass(clone $spySalesOrderItemProductClass);
            $spySalesOrderItemProductClass->clear();

            $this->collSpySalesProductClasses->remove($this->collSpySalesProductClasses->search($spySalesProductClass));

            if (null === $this->spySalesProductClassesScheduledForDeletion) {
                $this->spySalesProductClassesScheduledForDeletion = clone $this->collSpySalesProductClasses;
                $this->spySalesProductClassesScheduledForDeletion->clear();
            }

            $this->spySalesProductClassesScheduledForDeletion->push($spySalesProductClass);
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
        if (null !== $this->aSalesOrderItemBundle) {
            $this->aSalesOrderItemBundle->removeSalesOrderItem($this);
        }
        if (null !== $this->aOrder) {
            $this->aOrder->removeItem($this);
        }
        if (null !== $this->aState) {
            $this->aState->removeOrder($this);
        }
        if (null !== $this->aProcess) {
            $this->aProcess->removeItem($this);
        }
        if (null !== $this->aSpySalesShipment) {
            $this->aSpySalesShipment->removeSpySalesOrderItem($this);
        }
        $this->id_sales_order_item = null;
        $this->fk_oms_order_item_state = null;
        $this->fk_oms_order_process = null;
        $this->fk_sales_order = null;
        $this->fk_sales_order_item_bundle = null;
        $this->fk_sales_shipment = null;
        $this->amount = null;
        $this->amount_base_measurement_unit_name = null;
        $this->amount_measurement_unit_code = null;
        $this->amount_measurement_unit_conversion = null;
        $this->amount_measurement_unit_name = null;
        $this->amount_measurement_unit_precision = null;
        $this->amount_sku = null;
        $this->canceled_amount = null;
        $this->cart_note = null;
        $this->discount_amount_aggregation = null;
        $this->discount_amount_full_aggregation = null;
        $this->expense_price_aggregation = null;
        $this->gross_price = null;
        $this->group_key = null;
        $this->is_quantity_splittable = null;
        $this->last_state_change = null;
        $this->merchant_commission_amount_aggregation = null;
        $this->merchant_commission_amount_full_aggregation = null;
        $this->merchant_commission_refunded_amount = null;
        $this->merchant_reference = null;
        $this->name = null;
        $this->net_price = null;
        $this->order_item_reference = null;
        $this->price = null;
        $this->price_to_pay_aggregation = null;
        $this->product_offer_reference = null;
        $this->product_option_price_aggregation = null;
        $this->quantity = null;
        $this->quantity_base_measurement_unit_name = null;
        $this->quantity_measurement_unit_code = null;
        $this->quantity_measurement_unit_conversion = null;
        $this->quantity_measurement_unit_name = null;
        $this->quantity_measurement_unit_precision = null;
        $this->refundable_amount = null;
        $this->remuneration_amount = null;
        $this->sku = null;
        $this->subtotal_aggregation = null;
        $this->tax_amount = null;
        $this->tax_amount_after_cancellation = null;
        $this->tax_amount_full_aggregation = null;
        $this->tax_rate = null;
        $this->tax_rate_average_aggregation = null;
        $this->uuid = null;
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
            if ($this->collMerchantSalesOrderItems) {
                foreach ($this->collMerchantSalesOrderItems as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collNopayments) {
                foreach ($this->collNopayments as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTransitionLogs) {
                foreach ($this->collTransitionLogs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collStateHistories) {
                foreach ($this->collStateHistories as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEventTimeouts) {
                foreach ($this->collEventTimeouts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collMetadatas) {
                foreach ($this->collMetadatas as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDiscounts) {
                foreach ($this->collDiscounts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOptions) {
                foreach ($this->collOptions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpySalesOrderConfiguredBundleItems) {
                foreach ($this->collSpySalesOrderConfiguredBundleItems as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpySalesMerchantCommissions) {
                foreach ($this->collSpySalesMerchantCommissions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpySalesOrderItemConfigurations) {
                foreach ($this->collSpySalesOrderItemConfigurations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collReclamationItems) {
                foreach ($this->collReclamationItems as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpySalesReturnItems) {
                foreach ($this->collSpySalesReturnItems as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSalesOrderItemServicePoints) {
                foreach ($this->collSalesOrderItemServicePoints as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpySalesOrderItemProductClasses) {
                foreach ($this->collSpySalesOrderItemProductClasses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpySspInquirySalesOrderItems) {
                foreach ($this->collSpySspInquirySalesOrderItems as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSalesOrderItemSspAssets) {
                foreach ($this->collSalesOrderItemSspAssets as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpySalesProductClasses) {
                foreach ($this->collSpySalesProductClasses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collMerchantSalesOrderItems = null;
        $this->collNopayments = null;
        $this->collTransitionLogs = null;
        $this->collStateHistories = null;
        $this->collEventTimeouts = null;
        $this->collMetadatas = null;
        $this->collDiscounts = null;
        $this->collOptions = null;
        $this->collSpySalesOrderConfiguredBundleItems = null;
        $this->collSpySalesMerchantCommissions = null;
        $this->collSpySalesOrderItemConfigurations = null;
        $this->collReclamationItems = null;
        $this->collSpySalesReturnItems = null;
        $this->collSalesOrderItemServicePoints = null;
        $this->collSpySalesOrderItemProductClasses = null;
        $this->collSpySspInquirySalesOrderItems = null;
        $this->collSalesOrderItemSspAssets = null;
        $this->collSpySalesProductClasses = null;
        $this->aSalesOrderItemBundle = null;
        $this->aOrder = null;
        $this->aState = null;
        $this->aProcess = null;
        $this->aSpySalesShipment = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpySalesOrderItemTableMap::DEFAULT_STRING_FORMAT);
    }

    // uuid behavior

    /**
     * @return \Spryker\Service\UtilUuidGenerator\UtilUuidGeneratorServiceInterface
     */
    protected function getUuidGeneratorService()
    {
        if (static::$_uuidGeneratorService === null) {
            static::$_uuidGeneratorService = \Spryker\Zed\Kernel\Locator::getInstance()->utilUuidGenerator()->service();
        }

        return static::$_uuidGeneratorService;
    }

    /**
     * @return void
     */
    protected function setGeneratedUuid()
    {
        $uuidGenerateUtilService = $this->getUuidGeneratorService();
        $name = 'spy_sales_order_item' . '.' . $this->getIdSalesOrderItem();
        $uuid = $uuidGenerateUtilService->generateUuid5FromObjectId($name);
        $this->setUuid($uuid);
    }

    /**
     * @param ConnectionInterface $con
     *
     * @return void
     */
    protected function updateUuidAfterInsert(ConnectionInterface $con = null)
    {
        if (!$this->getUuid()) {
            $this->setGeneratedUuid();
            $this->doSave($con);
        }
    }

    /**
     * @return void
     */
    protected function updateUuidBeforeUpdate()
    {
        if (!$this->getUuid()) {
            $this->setGeneratedUuid();
        }
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return $this The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[SpySalesOrderItemTableMap::COL_UPDATED_AT] = true;

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
