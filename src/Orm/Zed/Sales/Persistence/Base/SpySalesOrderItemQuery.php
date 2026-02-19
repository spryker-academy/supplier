<?php

namespace Orm\Zed\Sales\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderItem;
use Orm\Zed\Nopayment\Persistence\SpyNopaymentPaid;
use Orm\Zed\Oms\Persistence\SpyOmsEventTimeout;
use Orm\Zed\Oms\Persistence\SpyOmsOrderItemState;
use Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateHistory;
use Orm\Zed\Oms\Persistence\SpyOmsOrderProcess;
use Orm\Zed\Oms\Persistence\SpyOmsTransitionLog;
use Orm\Zed\ProductBundle\Persistence\SpySalesOrderItemBundle;
use Orm\Zed\SalesConfigurableBundle\Persistence\SpySalesOrderConfiguredBundleItem;
use Orm\Zed\SalesMerchantCommission\Persistence\SpySalesMerchantCommission;
use Orm\Zed\SalesProductConfiguration\Persistence\SpySalesOrderItemConfiguration;
use Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationItem;
use Orm\Zed\SalesReturn\Persistence\SpySalesReturnItem;
use Orm\Zed\SalesServicePoint\Persistence\SpySalesOrderItemServicePoint;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem as ChildSpySalesOrderItem;
use Orm\Zed\Sales\Persistence\SpySalesOrderItemQuery as ChildSpySalesOrderItemQuery;
use Orm\Zed\Sales\Persistence\Map\SpySalesOrderItemTableMap;
use Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemProductClass;
use Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemSspAsset;
use Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderItem;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Spryker\Zed\PropelOrm\Business\Model\Formatter\TypeAwareSimpleArrayFormatter;
use Spryker\Zed\PropelOrm\Business\Runtime\ActiveQuery\Criteria as SprykerCriteria;
use Spryker\Zed\PropelReplicationCache\Business\PropelReplicationCacheFacade;
use Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException;

/**
 * Base class that represents a query for the `spy_sales_order_item` table.
 *
 * @method     ChildSpySalesOrderItemQuery orderByIdSalesOrderItem($order = Criteria::ASC) Order by the id_sales_order_item column
 * @method     ChildSpySalesOrderItemQuery orderByFkOmsOrderItemState($order = Criteria::ASC) Order by the fk_oms_order_item_state column
 * @method     ChildSpySalesOrderItemQuery orderByFkOmsOrderProcess($order = Criteria::ASC) Order by the fk_oms_order_process column
 * @method     ChildSpySalesOrderItemQuery orderByFkSalesOrder($order = Criteria::ASC) Order by the fk_sales_order column
 * @method     ChildSpySalesOrderItemQuery orderByFkSalesOrderItemBundle($order = Criteria::ASC) Order by the fk_sales_order_item_bundle column
 * @method     ChildSpySalesOrderItemQuery orderByFkSalesShipment($order = Criteria::ASC) Order by the fk_sales_shipment column
 * @method     ChildSpySalesOrderItemQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     ChildSpySalesOrderItemQuery orderByAmountBaseMeasurementUnitName($order = Criteria::ASC) Order by the amount_base_measurement_unit_name column
 * @method     ChildSpySalesOrderItemQuery orderByAmountMeasurementUnitCode($order = Criteria::ASC) Order by the amount_measurement_unit_code column
 * @method     ChildSpySalesOrderItemQuery orderByAmountMeasurementUnitConversion($order = Criteria::ASC) Order by the amount_measurement_unit_conversion column
 * @method     ChildSpySalesOrderItemQuery orderByAmountMeasurementUnitName($order = Criteria::ASC) Order by the amount_measurement_unit_name column
 * @method     ChildSpySalesOrderItemQuery orderByAmountMeasurementUnitPrecision($order = Criteria::ASC) Order by the amount_measurement_unit_precision column
 * @method     ChildSpySalesOrderItemQuery orderByAmountSku($order = Criteria::ASC) Order by the amount_sku column
 * @method     ChildSpySalesOrderItemQuery orderByCanceledAmount($order = Criteria::ASC) Order by the canceled_amount column
 * @method     ChildSpySalesOrderItemQuery orderByCartNote($order = Criteria::ASC) Order by the cart_note column
 * @method     ChildSpySalesOrderItemQuery orderByDiscountAmountAggregation($order = Criteria::ASC) Order by the discount_amount_aggregation column
 * @method     ChildSpySalesOrderItemQuery orderByDiscountAmountFullAggregation($order = Criteria::ASC) Order by the discount_amount_full_aggregation column
 * @method     ChildSpySalesOrderItemQuery orderByExpensePriceAggregation($order = Criteria::ASC) Order by the expense_price_aggregation column
 * @method     ChildSpySalesOrderItemQuery orderByGrossPrice($order = Criteria::ASC) Order by the gross_price column
 * @method     ChildSpySalesOrderItemQuery orderByGroupKey($order = Criteria::ASC) Order by the group_key column
 * @method     ChildSpySalesOrderItemQuery orderByIsQuantitySplittable($order = Criteria::ASC) Order by the is_quantity_splittable column
 * @method     ChildSpySalesOrderItemQuery orderByLastStateChange($order = Criteria::ASC) Order by the last_state_change column
 * @method     ChildSpySalesOrderItemQuery orderByMerchantCommissionAmountAggregation($order = Criteria::ASC) Order by the merchant_commission_amount_aggregation column
 * @method     ChildSpySalesOrderItemQuery orderByMerchantCommissionAmountFullAggregation($order = Criteria::ASC) Order by the merchant_commission_amount_full_aggregation column
 * @method     ChildSpySalesOrderItemQuery orderByMerchantCommissionRefundedAmount($order = Criteria::ASC) Order by the merchant_commission_refunded_amount column
 * @method     ChildSpySalesOrderItemQuery orderByMerchantReference($order = Criteria::ASC) Order by the merchant_reference column
 * @method     ChildSpySalesOrderItemQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildSpySalesOrderItemQuery orderByNetPrice($order = Criteria::ASC) Order by the net_price column
 * @method     ChildSpySalesOrderItemQuery orderByOrderItemReference($order = Criteria::ASC) Order by the order_item_reference column
 * @method     ChildSpySalesOrderItemQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     ChildSpySalesOrderItemQuery orderByPriceToPayAggregation($order = Criteria::ASC) Order by the price_to_pay_aggregation column
 * @method     ChildSpySalesOrderItemQuery orderByProductOfferReference($order = Criteria::ASC) Order by the product_offer_reference column
 * @method     ChildSpySalesOrderItemQuery orderByProductOptionPriceAggregation($order = Criteria::ASC) Order by the product_option_price_aggregation column
 * @method     ChildSpySalesOrderItemQuery orderByQuantity($order = Criteria::ASC) Order by the quantity column
 * @method     ChildSpySalesOrderItemQuery orderByQuantityBaseMeasurementUnitName($order = Criteria::ASC) Order by the quantity_base_measurement_unit_name column
 * @method     ChildSpySalesOrderItemQuery orderByQuantityMeasurementUnitCode($order = Criteria::ASC) Order by the quantity_measurement_unit_code column
 * @method     ChildSpySalesOrderItemQuery orderByQuantityMeasurementUnitConversion($order = Criteria::ASC) Order by the quantity_measurement_unit_conversion column
 * @method     ChildSpySalesOrderItemQuery orderByQuantityMeasurementUnitName($order = Criteria::ASC) Order by the quantity_measurement_unit_name column
 * @method     ChildSpySalesOrderItemQuery orderByQuantityMeasurementUnitPrecision($order = Criteria::ASC) Order by the quantity_measurement_unit_precision column
 * @method     ChildSpySalesOrderItemQuery orderByRefundableAmount($order = Criteria::ASC) Order by the refundable_amount column
 * @method     ChildSpySalesOrderItemQuery orderByRemunerationAmount($order = Criteria::ASC) Order by the remuneration_amount column
 * @method     ChildSpySalesOrderItemQuery orderBySku($order = Criteria::ASC) Order by the sku column
 * @method     ChildSpySalesOrderItemQuery orderBySubtotalAggregation($order = Criteria::ASC) Order by the subtotal_aggregation column
 * @method     ChildSpySalesOrderItemQuery orderByTaxAmount($order = Criteria::ASC) Order by the tax_amount column
 * @method     ChildSpySalesOrderItemQuery orderByTaxAmountAfterCancellation($order = Criteria::ASC) Order by the tax_amount_after_cancellation column
 * @method     ChildSpySalesOrderItemQuery orderByTaxAmountFullAggregation($order = Criteria::ASC) Order by the tax_amount_full_aggregation column
 * @method     ChildSpySalesOrderItemQuery orderByTaxRate($order = Criteria::ASC) Order by the tax_rate column
 * @method     ChildSpySalesOrderItemQuery orderByTaxRateAverageAggregation($order = Criteria::ASC) Order by the tax_rate_average_aggregation column
 * @method     ChildSpySalesOrderItemQuery orderByUuid($order = Criteria::ASC) Order by the uuid column
 * @method     ChildSpySalesOrderItemQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpySalesOrderItemQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpySalesOrderItemQuery groupByIdSalesOrderItem() Group by the id_sales_order_item column
 * @method     ChildSpySalesOrderItemQuery groupByFkOmsOrderItemState() Group by the fk_oms_order_item_state column
 * @method     ChildSpySalesOrderItemQuery groupByFkOmsOrderProcess() Group by the fk_oms_order_process column
 * @method     ChildSpySalesOrderItemQuery groupByFkSalesOrder() Group by the fk_sales_order column
 * @method     ChildSpySalesOrderItemQuery groupByFkSalesOrderItemBundle() Group by the fk_sales_order_item_bundle column
 * @method     ChildSpySalesOrderItemQuery groupByFkSalesShipment() Group by the fk_sales_shipment column
 * @method     ChildSpySalesOrderItemQuery groupByAmount() Group by the amount column
 * @method     ChildSpySalesOrderItemQuery groupByAmountBaseMeasurementUnitName() Group by the amount_base_measurement_unit_name column
 * @method     ChildSpySalesOrderItemQuery groupByAmountMeasurementUnitCode() Group by the amount_measurement_unit_code column
 * @method     ChildSpySalesOrderItemQuery groupByAmountMeasurementUnitConversion() Group by the amount_measurement_unit_conversion column
 * @method     ChildSpySalesOrderItemQuery groupByAmountMeasurementUnitName() Group by the amount_measurement_unit_name column
 * @method     ChildSpySalesOrderItemQuery groupByAmountMeasurementUnitPrecision() Group by the amount_measurement_unit_precision column
 * @method     ChildSpySalesOrderItemQuery groupByAmountSku() Group by the amount_sku column
 * @method     ChildSpySalesOrderItemQuery groupByCanceledAmount() Group by the canceled_amount column
 * @method     ChildSpySalesOrderItemQuery groupByCartNote() Group by the cart_note column
 * @method     ChildSpySalesOrderItemQuery groupByDiscountAmountAggregation() Group by the discount_amount_aggregation column
 * @method     ChildSpySalesOrderItemQuery groupByDiscountAmountFullAggregation() Group by the discount_amount_full_aggregation column
 * @method     ChildSpySalesOrderItemQuery groupByExpensePriceAggregation() Group by the expense_price_aggregation column
 * @method     ChildSpySalesOrderItemQuery groupByGrossPrice() Group by the gross_price column
 * @method     ChildSpySalesOrderItemQuery groupByGroupKey() Group by the group_key column
 * @method     ChildSpySalesOrderItemQuery groupByIsQuantitySplittable() Group by the is_quantity_splittable column
 * @method     ChildSpySalesOrderItemQuery groupByLastStateChange() Group by the last_state_change column
 * @method     ChildSpySalesOrderItemQuery groupByMerchantCommissionAmountAggregation() Group by the merchant_commission_amount_aggregation column
 * @method     ChildSpySalesOrderItemQuery groupByMerchantCommissionAmountFullAggregation() Group by the merchant_commission_amount_full_aggregation column
 * @method     ChildSpySalesOrderItemQuery groupByMerchantCommissionRefundedAmount() Group by the merchant_commission_refunded_amount column
 * @method     ChildSpySalesOrderItemQuery groupByMerchantReference() Group by the merchant_reference column
 * @method     ChildSpySalesOrderItemQuery groupByName() Group by the name column
 * @method     ChildSpySalesOrderItemQuery groupByNetPrice() Group by the net_price column
 * @method     ChildSpySalesOrderItemQuery groupByOrderItemReference() Group by the order_item_reference column
 * @method     ChildSpySalesOrderItemQuery groupByPrice() Group by the price column
 * @method     ChildSpySalesOrderItemQuery groupByPriceToPayAggregation() Group by the price_to_pay_aggregation column
 * @method     ChildSpySalesOrderItemQuery groupByProductOfferReference() Group by the product_offer_reference column
 * @method     ChildSpySalesOrderItemQuery groupByProductOptionPriceAggregation() Group by the product_option_price_aggregation column
 * @method     ChildSpySalesOrderItemQuery groupByQuantity() Group by the quantity column
 * @method     ChildSpySalesOrderItemQuery groupByQuantityBaseMeasurementUnitName() Group by the quantity_base_measurement_unit_name column
 * @method     ChildSpySalesOrderItemQuery groupByQuantityMeasurementUnitCode() Group by the quantity_measurement_unit_code column
 * @method     ChildSpySalesOrderItemQuery groupByQuantityMeasurementUnitConversion() Group by the quantity_measurement_unit_conversion column
 * @method     ChildSpySalesOrderItemQuery groupByQuantityMeasurementUnitName() Group by the quantity_measurement_unit_name column
 * @method     ChildSpySalesOrderItemQuery groupByQuantityMeasurementUnitPrecision() Group by the quantity_measurement_unit_precision column
 * @method     ChildSpySalesOrderItemQuery groupByRefundableAmount() Group by the refundable_amount column
 * @method     ChildSpySalesOrderItemQuery groupByRemunerationAmount() Group by the remuneration_amount column
 * @method     ChildSpySalesOrderItemQuery groupBySku() Group by the sku column
 * @method     ChildSpySalesOrderItemQuery groupBySubtotalAggregation() Group by the subtotal_aggregation column
 * @method     ChildSpySalesOrderItemQuery groupByTaxAmount() Group by the tax_amount column
 * @method     ChildSpySalesOrderItemQuery groupByTaxAmountAfterCancellation() Group by the tax_amount_after_cancellation column
 * @method     ChildSpySalesOrderItemQuery groupByTaxAmountFullAggregation() Group by the tax_amount_full_aggregation column
 * @method     ChildSpySalesOrderItemQuery groupByTaxRate() Group by the tax_rate column
 * @method     ChildSpySalesOrderItemQuery groupByTaxRateAverageAggregation() Group by the tax_rate_average_aggregation column
 * @method     ChildSpySalesOrderItemQuery groupByUuid() Group by the uuid column
 * @method     ChildSpySalesOrderItemQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpySalesOrderItemQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpySalesOrderItemQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpySalesOrderItemQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpySalesOrderItemQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpySalesOrderItemQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpySalesOrderItemQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinSalesOrderItemBundle($relationAlias = null) Adds a LEFT JOIN clause to the query using the SalesOrderItemBundle relation
 * @method     ChildSpySalesOrderItemQuery rightJoinSalesOrderItemBundle($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SalesOrderItemBundle relation
 * @method     ChildSpySalesOrderItemQuery innerJoinSalesOrderItemBundle($relationAlias = null) Adds a INNER JOIN clause to the query using the SalesOrderItemBundle relation
 *
 * @method     ChildSpySalesOrderItemQuery joinWithSalesOrderItemBundle($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SalesOrderItemBundle relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinWithSalesOrderItemBundle() Adds a LEFT JOIN clause and with to the query using the SalesOrderItemBundle relation
 * @method     ChildSpySalesOrderItemQuery rightJoinWithSalesOrderItemBundle() Adds a RIGHT JOIN clause and with to the query using the SalesOrderItemBundle relation
 * @method     ChildSpySalesOrderItemQuery innerJoinWithSalesOrderItemBundle() Adds a INNER JOIN clause and with to the query using the SalesOrderItemBundle relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinOrder($relationAlias = null) Adds a LEFT JOIN clause to the query using the Order relation
 * @method     ChildSpySalesOrderItemQuery rightJoinOrder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Order relation
 * @method     ChildSpySalesOrderItemQuery innerJoinOrder($relationAlias = null) Adds a INNER JOIN clause to the query using the Order relation
 *
 * @method     ChildSpySalesOrderItemQuery joinWithOrder($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Order relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinWithOrder() Adds a LEFT JOIN clause and with to the query using the Order relation
 * @method     ChildSpySalesOrderItemQuery rightJoinWithOrder() Adds a RIGHT JOIN clause and with to the query using the Order relation
 * @method     ChildSpySalesOrderItemQuery innerJoinWithOrder() Adds a INNER JOIN clause and with to the query using the Order relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinState($relationAlias = null) Adds a LEFT JOIN clause to the query using the State relation
 * @method     ChildSpySalesOrderItemQuery rightJoinState($relationAlias = null) Adds a RIGHT JOIN clause to the query using the State relation
 * @method     ChildSpySalesOrderItemQuery innerJoinState($relationAlias = null) Adds a INNER JOIN clause to the query using the State relation
 *
 * @method     ChildSpySalesOrderItemQuery joinWithState($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the State relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinWithState() Adds a LEFT JOIN clause and with to the query using the State relation
 * @method     ChildSpySalesOrderItemQuery rightJoinWithState() Adds a RIGHT JOIN clause and with to the query using the State relation
 * @method     ChildSpySalesOrderItemQuery innerJoinWithState() Adds a INNER JOIN clause and with to the query using the State relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinProcess($relationAlias = null) Adds a LEFT JOIN clause to the query using the Process relation
 * @method     ChildSpySalesOrderItemQuery rightJoinProcess($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Process relation
 * @method     ChildSpySalesOrderItemQuery innerJoinProcess($relationAlias = null) Adds a INNER JOIN clause to the query using the Process relation
 *
 * @method     ChildSpySalesOrderItemQuery joinWithProcess($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Process relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinWithProcess() Adds a LEFT JOIN clause and with to the query using the Process relation
 * @method     ChildSpySalesOrderItemQuery rightJoinWithProcess() Adds a RIGHT JOIN clause and with to the query using the Process relation
 * @method     ChildSpySalesOrderItemQuery innerJoinWithProcess() Adds a INNER JOIN clause and with to the query using the Process relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinSpySalesShipment($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpySalesShipment relation
 * @method     ChildSpySalesOrderItemQuery rightJoinSpySalesShipment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpySalesShipment relation
 * @method     ChildSpySalesOrderItemQuery innerJoinSpySalesShipment($relationAlias = null) Adds a INNER JOIN clause to the query using the SpySalesShipment relation
 *
 * @method     ChildSpySalesOrderItemQuery joinWithSpySalesShipment($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpySalesShipment relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinWithSpySalesShipment() Adds a LEFT JOIN clause and with to the query using the SpySalesShipment relation
 * @method     ChildSpySalesOrderItemQuery rightJoinWithSpySalesShipment() Adds a RIGHT JOIN clause and with to the query using the SpySalesShipment relation
 * @method     ChildSpySalesOrderItemQuery innerJoinWithSpySalesShipment() Adds a INNER JOIN clause and with to the query using the SpySalesShipment relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinMerchantSalesOrderItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the MerchantSalesOrderItem relation
 * @method     ChildSpySalesOrderItemQuery rightJoinMerchantSalesOrderItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MerchantSalesOrderItem relation
 * @method     ChildSpySalesOrderItemQuery innerJoinMerchantSalesOrderItem($relationAlias = null) Adds a INNER JOIN clause to the query using the MerchantSalesOrderItem relation
 *
 * @method     ChildSpySalesOrderItemQuery joinWithMerchantSalesOrderItem($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the MerchantSalesOrderItem relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinWithMerchantSalesOrderItem() Adds a LEFT JOIN clause and with to the query using the MerchantSalesOrderItem relation
 * @method     ChildSpySalesOrderItemQuery rightJoinWithMerchantSalesOrderItem() Adds a RIGHT JOIN clause and with to the query using the MerchantSalesOrderItem relation
 * @method     ChildSpySalesOrderItemQuery innerJoinWithMerchantSalesOrderItem() Adds a INNER JOIN clause and with to the query using the MerchantSalesOrderItem relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinNopayment($relationAlias = null) Adds a LEFT JOIN clause to the query using the Nopayment relation
 * @method     ChildSpySalesOrderItemQuery rightJoinNopayment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Nopayment relation
 * @method     ChildSpySalesOrderItemQuery innerJoinNopayment($relationAlias = null) Adds a INNER JOIN clause to the query using the Nopayment relation
 *
 * @method     ChildSpySalesOrderItemQuery joinWithNopayment($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Nopayment relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinWithNopayment() Adds a LEFT JOIN clause and with to the query using the Nopayment relation
 * @method     ChildSpySalesOrderItemQuery rightJoinWithNopayment() Adds a RIGHT JOIN clause and with to the query using the Nopayment relation
 * @method     ChildSpySalesOrderItemQuery innerJoinWithNopayment() Adds a INNER JOIN clause and with to the query using the Nopayment relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinTransitionLog($relationAlias = null) Adds a LEFT JOIN clause to the query using the TransitionLog relation
 * @method     ChildSpySalesOrderItemQuery rightJoinTransitionLog($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TransitionLog relation
 * @method     ChildSpySalesOrderItemQuery innerJoinTransitionLog($relationAlias = null) Adds a INNER JOIN clause to the query using the TransitionLog relation
 *
 * @method     ChildSpySalesOrderItemQuery joinWithTransitionLog($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TransitionLog relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinWithTransitionLog() Adds a LEFT JOIN clause and with to the query using the TransitionLog relation
 * @method     ChildSpySalesOrderItemQuery rightJoinWithTransitionLog() Adds a RIGHT JOIN clause and with to the query using the TransitionLog relation
 * @method     ChildSpySalesOrderItemQuery innerJoinWithTransitionLog() Adds a INNER JOIN clause and with to the query using the TransitionLog relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinStateHistory($relationAlias = null) Adds a LEFT JOIN clause to the query using the StateHistory relation
 * @method     ChildSpySalesOrderItemQuery rightJoinStateHistory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StateHistory relation
 * @method     ChildSpySalesOrderItemQuery innerJoinStateHistory($relationAlias = null) Adds a INNER JOIN clause to the query using the StateHistory relation
 *
 * @method     ChildSpySalesOrderItemQuery joinWithStateHistory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StateHistory relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinWithStateHistory() Adds a LEFT JOIN clause and with to the query using the StateHistory relation
 * @method     ChildSpySalesOrderItemQuery rightJoinWithStateHistory() Adds a RIGHT JOIN clause and with to the query using the StateHistory relation
 * @method     ChildSpySalesOrderItemQuery innerJoinWithStateHistory() Adds a INNER JOIN clause and with to the query using the StateHistory relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinEventTimeout($relationAlias = null) Adds a LEFT JOIN clause to the query using the EventTimeout relation
 * @method     ChildSpySalesOrderItemQuery rightJoinEventTimeout($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EventTimeout relation
 * @method     ChildSpySalesOrderItemQuery innerJoinEventTimeout($relationAlias = null) Adds a INNER JOIN clause to the query using the EventTimeout relation
 *
 * @method     ChildSpySalesOrderItemQuery joinWithEventTimeout($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EventTimeout relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinWithEventTimeout() Adds a LEFT JOIN clause and with to the query using the EventTimeout relation
 * @method     ChildSpySalesOrderItemQuery rightJoinWithEventTimeout() Adds a RIGHT JOIN clause and with to the query using the EventTimeout relation
 * @method     ChildSpySalesOrderItemQuery innerJoinWithEventTimeout() Adds a INNER JOIN clause and with to the query using the EventTimeout relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinMetadata($relationAlias = null) Adds a LEFT JOIN clause to the query using the Metadata relation
 * @method     ChildSpySalesOrderItemQuery rightJoinMetadata($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Metadata relation
 * @method     ChildSpySalesOrderItemQuery innerJoinMetadata($relationAlias = null) Adds a INNER JOIN clause to the query using the Metadata relation
 *
 * @method     ChildSpySalesOrderItemQuery joinWithMetadata($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Metadata relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinWithMetadata() Adds a LEFT JOIN clause and with to the query using the Metadata relation
 * @method     ChildSpySalesOrderItemQuery rightJoinWithMetadata() Adds a RIGHT JOIN clause and with to the query using the Metadata relation
 * @method     ChildSpySalesOrderItemQuery innerJoinWithMetadata() Adds a INNER JOIN clause and with to the query using the Metadata relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinDiscount($relationAlias = null) Adds a LEFT JOIN clause to the query using the Discount relation
 * @method     ChildSpySalesOrderItemQuery rightJoinDiscount($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Discount relation
 * @method     ChildSpySalesOrderItemQuery innerJoinDiscount($relationAlias = null) Adds a INNER JOIN clause to the query using the Discount relation
 *
 * @method     ChildSpySalesOrderItemQuery joinWithDiscount($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Discount relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinWithDiscount() Adds a LEFT JOIN clause and with to the query using the Discount relation
 * @method     ChildSpySalesOrderItemQuery rightJoinWithDiscount() Adds a RIGHT JOIN clause and with to the query using the Discount relation
 * @method     ChildSpySalesOrderItemQuery innerJoinWithDiscount() Adds a INNER JOIN clause and with to the query using the Discount relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinOption($relationAlias = null) Adds a LEFT JOIN clause to the query using the Option relation
 * @method     ChildSpySalesOrderItemQuery rightJoinOption($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Option relation
 * @method     ChildSpySalesOrderItemQuery innerJoinOption($relationAlias = null) Adds a INNER JOIN clause to the query using the Option relation
 *
 * @method     ChildSpySalesOrderItemQuery joinWithOption($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Option relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinWithOption() Adds a LEFT JOIN clause and with to the query using the Option relation
 * @method     ChildSpySalesOrderItemQuery rightJoinWithOption() Adds a RIGHT JOIN clause and with to the query using the Option relation
 * @method     ChildSpySalesOrderItemQuery innerJoinWithOption() Adds a INNER JOIN clause and with to the query using the Option relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinSpySalesOrderConfiguredBundleItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpySalesOrderConfiguredBundleItem relation
 * @method     ChildSpySalesOrderItemQuery rightJoinSpySalesOrderConfiguredBundleItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpySalesOrderConfiguredBundleItem relation
 * @method     ChildSpySalesOrderItemQuery innerJoinSpySalesOrderConfiguredBundleItem($relationAlias = null) Adds a INNER JOIN clause to the query using the SpySalesOrderConfiguredBundleItem relation
 *
 * @method     ChildSpySalesOrderItemQuery joinWithSpySalesOrderConfiguredBundleItem($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpySalesOrderConfiguredBundleItem relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinWithSpySalesOrderConfiguredBundleItem() Adds a LEFT JOIN clause and with to the query using the SpySalesOrderConfiguredBundleItem relation
 * @method     ChildSpySalesOrderItemQuery rightJoinWithSpySalesOrderConfiguredBundleItem() Adds a RIGHT JOIN clause and with to the query using the SpySalesOrderConfiguredBundleItem relation
 * @method     ChildSpySalesOrderItemQuery innerJoinWithSpySalesOrderConfiguredBundleItem() Adds a INNER JOIN clause and with to the query using the SpySalesOrderConfiguredBundleItem relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinSpySalesMerchantCommission($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpySalesMerchantCommission relation
 * @method     ChildSpySalesOrderItemQuery rightJoinSpySalesMerchantCommission($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpySalesMerchantCommission relation
 * @method     ChildSpySalesOrderItemQuery innerJoinSpySalesMerchantCommission($relationAlias = null) Adds a INNER JOIN clause to the query using the SpySalesMerchantCommission relation
 *
 * @method     ChildSpySalesOrderItemQuery joinWithSpySalesMerchantCommission($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpySalesMerchantCommission relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinWithSpySalesMerchantCommission() Adds a LEFT JOIN clause and with to the query using the SpySalesMerchantCommission relation
 * @method     ChildSpySalesOrderItemQuery rightJoinWithSpySalesMerchantCommission() Adds a RIGHT JOIN clause and with to the query using the SpySalesMerchantCommission relation
 * @method     ChildSpySalesOrderItemQuery innerJoinWithSpySalesMerchantCommission() Adds a INNER JOIN clause and with to the query using the SpySalesMerchantCommission relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinSpySalesOrderItemConfiguration($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpySalesOrderItemConfiguration relation
 * @method     ChildSpySalesOrderItemQuery rightJoinSpySalesOrderItemConfiguration($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpySalesOrderItemConfiguration relation
 * @method     ChildSpySalesOrderItemQuery innerJoinSpySalesOrderItemConfiguration($relationAlias = null) Adds a INNER JOIN clause to the query using the SpySalesOrderItemConfiguration relation
 *
 * @method     ChildSpySalesOrderItemQuery joinWithSpySalesOrderItemConfiguration($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpySalesOrderItemConfiguration relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinWithSpySalesOrderItemConfiguration() Adds a LEFT JOIN clause and with to the query using the SpySalesOrderItemConfiguration relation
 * @method     ChildSpySalesOrderItemQuery rightJoinWithSpySalesOrderItemConfiguration() Adds a RIGHT JOIN clause and with to the query using the SpySalesOrderItemConfiguration relation
 * @method     ChildSpySalesOrderItemQuery innerJoinWithSpySalesOrderItemConfiguration() Adds a INNER JOIN clause and with to the query using the SpySalesOrderItemConfiguration relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinReclamationItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the ReclamationItem relation
 * @method     ChildSpySalesOrderItemQuery rightJoinReclamationItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ReclamationItem relation
 * @method     ChildSpySalesOrderItemQuery innerJoinReclamationItem($relationAlias = null) Adds a INNER JOIN clause to the query using the ReclamationItem relation
 *
 * @method     ChildSpySalesOrderItemQuery joinWithReclamationItem($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ReclamationItem relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinWithReclamationItem() Adds a LEFT JOIN clause and with to the query using the ReclamationItem relation
 * @method     ChildSpySalesOrderItemQuery rightJoinWithReclamationItem() Adds a RIGHT JOIN clause and with to the query using the ReclamationItem relation
 * @method     ChildSpySalesOrderItemQuery innerJoinWithReclamationItem() Adds a INNER JOIN clause and with to the query using the ReclamationItem relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinSpySalesReturnItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpySalesReturnItem relation
 * @method     ChildSpySalesOrderItemQuery rightJoinSpySalesReturnItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpySalesReturnItem relation
 * @method     ChildSpySalesOrderItemQuery innerJoinSpySalesReturnItem($relationAlias = null) Adds a INNER JOIN clause to the query using the SpySalesReturnItem relation
 *
 * @method     ChildSpySalesOrderItemQuery joinWithSpySalesReturnItem($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpySalesReturnItem relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinWithSpySalesReturnItem() Adds a LEFT JOIN clause and with to the query using the SpySalesReturnItem relation
 * @method     ChildSpySalesOrderItemQuery rightJoinWithSpySalesReturnItem() Adds a RIGHT JOIN clause and with to the query using the SpySalesReturnItem relation
 * @method     ChildSpySalesOrderItemQuery innerJoinWithSpySalesReturnItem() Adds a INNER JOIN clause and with to the query using the SpySalesReturnItem relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinSalesOrderItemServicePoint($relationAlias = null) Adds a LEFT JOIN clause to the query using the SalesOrderItemServicePoint relation
 * @method     ChildSpySalesOrderItemQuery rightJoinSalesOrderItemServicePoint($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SalesOrderItemServicePoint relation
 * @method     ChildSpySalesOrderItemQuery innerJoinSalesOrderItemServicePoint($relationAlias = null) Adds a INNER JOIN clause to the query using the SalesOrderItemServicePoint relation
 *
 * @method     ChildSpySalesOrderItemQuery joinWithSalesOrderItemServicePoint($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SalesOrderItemServicePoint relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinWithSalesOrderItemServicePoint() Adds a LEFT JOIN clause and with to the query using the SalesOrderItemServicePoint relation
 * @method     ChildSpySalesOrderItemQuery rightJoinWithSalesOrderItemServicePoint() Adds a RIGHT JOIN clause and with to the query using the SalesOrderItemServicePoint relation
 * @method     ChildSpySalesOrderItemQuery innerJoinWithSalesOrderItemServicePoint() Adds a INNER JOIN clause and with to the query using the SalesOrderItemServicePoint relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinSpySalesOrderItemProductClass($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpySalesOrderItemProductClass relation
 * @method     ChildSpySalesOrderItemQuery rightJoinSpySalesOrderItemProductClass($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpySalesOrderItemProductClass relation
 * @method     ChildSpySalesOrderItemQuery innerJoinSpySalesOrderItemProductClass($relationAlias = null) Adds a INNER JOIN clause to the query using the SpySalesOrderItemProductClass relation
 *
 * @method     ChildSpySalesOrderItemQuery joinWithSpySalesOrderItemProductClass($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpySalesOrderItemProductClass relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinWithSpySalesOrderItemProductClass() Adds a LEFT JOIN clause and with to the query using the SpySalesOrderItemProductClass relation
 * @method     ChildSpySalesOrderItemQuery rightJoinWithSpySalesOrderItemProductClass() Adds a RIGHT JOIN clause and with to the query using the SpySalesOrderItemProductClass relation
 * @method     ChildSpySalesOrderItemQuery innerJoinWithSpySalesOrderItemProductClass() Adds a INNER JOIN clause and with to the query using the SpySalesOrderItemProductClass relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinSpySspInquirySalesOrderItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpySspInquirySalesOrderItem relation
 * @method     ChildSpySalesOrderItemQuery rightJoinSpySspInquirySalesOrderItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpySspInquirySalesOrderItem relation
 * @method     ChildSpySalesOrderItemQuery innerJoinSpySspInquirySalesOrderItem($relationAlias = null) Adds a INNER JOIN clause to the query using the SpySspInquirySalesOrderItem relation
 *
 * @method     ChildSpySalesOrderItemQuery joinWithSpySspInquirySalesOrderItem($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpySspInquirySalesOrderItem relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinWithSpySspInquirySalesOrderItem() Adds a LEFT JOIN clause and with to the query using the SpySspInquirySalesOrderItem relation
 * @method     ChildSpySalesOrderItemQuery rightJoinWithSpySspInquirySalesOrderItem() Adds a RIGHT JOIN clause and with to the query using the SpySspInquirySalesOrderItem relation
 * @method     ChildSpySalesOrderItemQuery innerJoinWithSpySspInquirySalesOrderItem() Adds a INNER JOIN clause and with to the query using the SpySspInquirySalesOrderItem relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinSalesOrderItemSspAsset($relationAlias = null) Adds a LEFT JOIN clause to the query using the SalesOrderItemSspAsset relation
 * @method     ChildSpySalesOrderItemQuery rightJoinSalesOrderItemSspAsset($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SalesOrderItemSspAsset relation
 * @method     ChildSpySalesOrderItemQuery innerJoinSalesOrderItemSspAsset($relationAlias = null) Adds a INNER JOIN clause to the query using the SalesOrderItemSspAsset relation
 *
 * @method     ChildSpySalesOrderItemQuery joinWithSalesOrderItemSspAsset($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SalesOrderItemSspAsset relation
 *
 * @method     ChildSpySalesOrderItemQuery leftJoinWithSalesOrderItemSspAsset() Adds a LEFT JOIN clause and with to the query using the SalesOrderItemSspAsset relation
 * @method     ChildSpySalesOrderItemQuery rightJoinWithSalesOrderItemSspAsset() Adds a RIGHT JOIN clause and with to the query using the SalesOrderItemSspAsset relation
 * @method     ChildSpySalesOrderItemQuery innerJoinWithSalesOrderItemSspAsset() Adds a INNER JOIN clause and with to the query using the SalesOrderItemSspAsset relation
 *
 * @method     \Orm\Zed\ProductBundle\Persistence\SpySalesOrderItemBundleQuery|\Orm\Zed\Sales\Persistence\SpySalesOrderQuery|\Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateQuery|\Orm\Zed\Oms\Persistence\SpyOmsOrderProcessQuery|\Orm\Zed\Sales\Persistence\SpySalesShipmentQuery|\Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderItemQuery|\Orm\Zed\Nopayment\Persistence\SpyNopaymentPaidQuery|\Orm\Zed\Oms\Persistence\SpyOmsTransitionLogQuery|\Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateHistoryQuery|\Orm\Zed\Oms\Persistence\SpyOmsEventTimeoutQuery|\Orm\Zed\Sales\Persistence\SpySalesOrderItemMetadataQuery|\Orm\Zed\Sales\Persistence\SpySalesDiscountQuery|\Orm\Zed\Sales\Persistence\SpySalesOrderItemOptionQuery|\Orm\Zed\SalesConfigurableBundle\Persistence\SpySalesOrderConfiguredBundleItemQuery|\Orm\Zed\SalesMerchantCommission\Persistence\SpySalesMerchantCommissionQuery|\Orm\Zed\SalesProductConfiguration\Persistence\SpySalesOrderItemConfigurationQuery|\Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationItemQuery|\Orm\Zed\SalesReturn\Persistence\SpySalesReturnItemQuery|\Orm\Zed\SalesServicePoint\Persistence\SpySalesOrderItemServicePointQuery|\Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemProductClassQuery|\Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderItemQuery|\Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemSspAssetQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpySalesOrderItem|null findOne(?ConnectionInterface $con = null) Return the first ChildSpySalesOrderItem matching the query
 * @method     ChildSpySalesOrderItem findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpySalesOrderItem matching the query, or a new ChildSpySalesOrderItem object populated from the query conditions when no match is found
 *
 * @method     ChildSpySalesOrderItem|null findOneByIdSalesOrderItem(int $id_sales_order_item) Return the first ChildSpySalesOrderItem filtered by the id_sales_order_item column
 * @method     ChildSpySalesOrderItem|null findOneByFkOmsOrderItemState(int $fk_oms_order_item_state) Return the first ChildSpySalesOrderItem filtered by the fk_oms_order_item_state column
 * @method     ChildSpySalesOrderItem|null findOneByFkOmsOrderProcess(int $fk_oms_order_process) Return the first ChildSpySalesOrderItem filtered by the fk_oms_order_process column
 * @method     ChildSpySalesOrderItem|null findOneByFkSalesOrder(int $fk_sales_order) Return the first ChildSpySalesOrderItem filtered by the fk_sales_order column
 * @method     ChildSpySalesOrderItem|null findOneByFkSalesOrderItemBundle(int $fk_sales_order_item_bundle) Return the first ChildSpySalesOrderItem filtered by the fk_sales_order_item_bundle column
 * @method     ChildSpySalesOrderItem|null findOneByFkSalesShipment(int $fk_sales_shipment) Return the first ChildSpySalesOrderItem filtered by the fk_sales_shipment column
 * @method     ChildSpySalesOrderItem|null findOneByAmount(string $amount) Return the first ChildSpySalesOrderItem filtered by the amount column
 * @method     ChildSpySalesOrderItem|null findOneByAmountBaseMeasurementUnitName(string $amount_base_measurement_unit_name) Return the first ChildSpySalesOrderItem filtered by the amount_base_measurement_unit_name column
 * @method     ChildSpySalesOrderItem|null findOneByAmountMeasurementUnitCode(string $amount_measurement_unit_code) Return the first ChildSpySalesOrderItem filtered by the amount_measurement_unit_code column
 * @method     ChildSpySalesOrderItem|null findOneByAmountMeasurementUnitConversion(double $amount_measurement_unit_conversion) Return the first ChildSpySalesOrderItem filtered by the amount_measurement_unit_conversion column
 * @method     ChildSpySalesOrderItem|null findOneByAmountMeasurementUnitName(string $amount_measurement_unit_name) Return the first ChildSpySalesOrderItem filtered by the amount_measurement_unit_name column
 * @method     ChildSpySalesOrderItem|null findOneByAmountMeasurementUnitPrecision(int $amount_measurement_unit_precision) Return the first ChildSpySalesOrderItem filtered by the amount_measurement_unit_precision column
 * @method     ChildSpySalesOrderItem|null findOneByAmountSku(string $amount_sku) Return the first ChildSpySalesOrderItem filtered by the amount_sku column
 * @method     ChildSpySalesOrderItem|null findOneByCanceledAmount(int $canceled_amount) Return the first ChildSpySalesOrderItem filtered by the canceled_amount column
 * @method     ChildSpySalesOrderItem|null findOneByCartNote(string $cart_note) Return the first ChildSpySalesOrderItem filtered by the cart_note column
 * @method     ChildSpySalesOrderItem|null findOneByDiscountAmountAggregation(int $discount_amount_aggregation) Return the first ChildSpySalesOrderItem filtered by the discount_amount_aggregation column
 * @method     ChildSpySalesOrderItem|null findOneByDiscountAmountFullAggregation(int $discount_amount_full_aggregation) Return the first ChildSpySalesOrderItem filtered by the discount_amount_full_aggregation column
 * @method     ChildSpySalesOrderItem|null findOneByExpensePriceAggregation(int $expense_price_aggregation) Return the first ChildSpySalesOrderItem filtered by the expense_price_aggregation column
 * @method     ChildSpySalesOrderItem|null findOneByGrossPrice(int $gross_price) Return the first ChildSpySalesOrderItem filtered by the gross_price column
 * @method     ChildSpySalesOrderItem|null findOneByGroupKey(string $group_key) Return the first ChildSpySalesOrderItem filtered by the group_key column
 * @method     ChildSpySalesOrderItem|null findOneByIsQuantitySplittable(boolean $is_quantity_splittable) Return the first ChildSpySalesOrderItem filtered by the is_quantity_splittable column
 * @method     ChildSpySalesOrderItem|null findOneByLastStateChange(string $last_state_change) Return the first ChildSpySalesOrderItem filtered by the last_state_change column
 * @method     ChildSpySalesOrderItem|null findOneByMerchantCommissionAmountAggregation(int $merchant_commission_amount_aggregation) Return the first ChildSpySalesOrderItem filtered by the merchant_commission_amount_aggregation column
 * @method     ChildSpySalesOrderItem|null findOneByMerchantCommissionAmountFullAggregation(int $merchant_commission_amount_full_aggregation) Return the first ChildSpySalesOrderItem filtered by the merchant_commission_amount_full_aggregation column
 * @method     ChildSpySalesOrderItem|null findOneByMerchantCommissionRefundedAmount(int $merchant_commission_refunded_amount) Return the first ChildSpySalesOrderItem filtered by the merchant_commission_refunded_amount column
 * @method     ChildSpySalesOrderItem|null findOneByMerchantReference(string $merchant_reference) Return the first ChildSpySalesOrderItem filtered by the merchant_reference column
 * @method     ChildSpySalesOrderItem|null findOneByName(string $name) Return the first ChildSpySalesOrderItem filtered by the name column
 * @method     ChildSpySalesOrderItem|null findOneByNetPrice(int $net_price) Return the first ChildSpySalesOrderItem filtered by the net_price column
 * @method     ChildSpySalesOrderItem|null findOneByOrderItemReference(string $order_item_reference) Return the first ChildSpySalesOrderItem filtered by the order_item_reference column
 * @method     ChildSpySalesOrderItem|null findOneByPrice(int $price) Return the first ChildSpySalesOrderItem filtered by the price column
 * @method     ChildSpySalesOrderItem|null findOneByPriceToPayAggregation(int $price_to_pay_aggregation) Return the first ChildSpySalesOrderItem filtered by the price_to_pay_aggregation column
 * @method     ChildSpySalesOrderItem|null findOneByProductOfferReference(string $product_offer_reference) Return the first ChildSpySalesOrderItem filtered by the product_offer_reference column
 * @method     ChildSpySalesOrderItem|null findOneByProductOptionPriceAggregation(int $product_option_price_aggregation) Return the first ChildSpySalesOrderItem filtered by the product_option_price_aggregation column
 * @method     ChildSpySalesOrderItem|null findOneByQuantity(int $quantity) Return the first ChildSpySalesOrderItem filtered by the quantity column
 * @method     ChildSpySalesOrderItem|null findOneByQuantityBaseMeasurementUnitName(string $quantity_base_measurement_unit_name) Return the first ChildSpySalesOrderItem filtered by the quantity_base_measurement_unit_name column
 * @method     ChildSpySalesOrderItem|null findOneByQuantityMeasurementUnitCode(string $quantity_measurement_unit_code) Return the first ChildSpySalesOrderItem filtered by the quantity_measurement_unit_code column
 * @method     ChildSpySalesOrderItem|null findOneByQuantityMeasurementUnitConversion(double $quantity_measurement_unit_conversion) Return the first ChildSpySalesOrderItem filtered by the quantity_measurement_unit_conversion column
 * @method     ChildSpySalesOrderItem|null findOneByQuantityMeasurementUnitName(string $quantity_measurement_unit_name) Return the first ChildSpySalesOrderItem filtered by the quantity_measurement_unit_name column
 * @method     ChildSpySalesOrderItem|null findOneByQuantityMeasurementUnitPrecision(int $quantity_measurement_unit_precision) Return the first ChildSpySalesOrderItem filtered by the quantity_measurement_unit_precision column
 * @method     ChildSpySalesOrderItem|null findOneByRefundableAmount(int $refundable_amount) Return the first ChildSpySalesOrderItem filtered by the refundable_amount column
 * @method     ChildSpySalesOrderItem|null findOneByRemunerationAmount(int $remuneration_amount) Return the first ChildSpySalesOrderItem filtered by the remuneration_amount column
 * @method     ChildSpySalesOrderItem|null findOneBySku(string $sku) Return the first ChildSpySalesOrderItem filtered by the sku column
 * @method     ChildSpySalesOrderItem|null findOneBySubtotalAggregation(int $subtotal_aggregation) Return the first ChildSpySalesOrderItem filtered by the subtotal_aggregation column
 * @method     ChildSpySalesOrderItem|null findOneByTaxAmount(int $tax_amount) Return the first ChildSpySalesOrderItem filtered by the tax_amount column
 * @method     ChildSpySalesOrderItem|null findOneByTaxAmountAfterCancellation(int $tax_amount_after_cancellation) Return the first ChildSpySalesOrderItem filtered by the tax_amount_after_cancellation column
 * @method     ChildSpySalesOrderItem|null findOneByTaxAmountFullAggregation(int $tax_amount_full_aggregation) Return the first ChildSpySalesOrderItem filtered by the tax_amount_full_aggregation column
 * @method     ChildSpySalesOrderItem|null findOneByTaxRate(string $tax_rate) Return the first ChildSpySalesOrderItem filtered by the tax_rate column
 * @method     ChildSpySalesOrderItem|null findOneByTaxRateAverageAggregation(string $tax_rate_average_aggregation) Return the first ChildSpySalesOrderItem filtered by the tax_rate_average_aggregation column
 * @method     ChildSpySalesOrderItem|null findOneByUuid(string $uuid) Return the first ChildSpySalesOrderItem filtered by the uuid column
 * @method     ChildSpySalesOrderItem|null findOneByCreatedAt(string $created_at) Return the first ChildSpySalesOrderItem filtered by the created_at column
 * @method     ChildSpySalesOrderItem|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpySalesOrderItem filtered by the updated_at column
 *
 * @method     ChildSpySalesOrderItem requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpySalesOrderItem by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOne(?ConnectionInterface $con = null) Return the first ChildSpySalesOrderItem matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpySalesOrderItem requireOneByIdSalesOrderItem(int $id_sales_order_item) Return the first ChildSpySalesOrderItem filtered by the id_sales_order_item column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByFkOmsOrderItemState(int $fk_oms_order_item_state) Return the first ChildSpySalesOrderItem filtered by the fk_oms_order_item_state column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByFkOmsOrderProcess(int $fk_oms_order_process) Return the first ChildSpySalesOrderItem filtered by the fk_oms_order_process column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByFkSalesOrder(int $fk_sales_order) Return the first ChildSpySalesOrderItem filtered by the fk_sales_order column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByFkSalesOrderItemBundle(int $fk_sales_order_item_bundle) Return the first ChildSpySalesOrderItem filtered by the fk_sales_order_item_bundle column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByFkSalesShipment(int $fk_sales_shipment) Return the first ChildSpySalesOrderItem filtered by the fk_sales_shipment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByAmount(string $amount) Return the first ChildSpySalesOrderItem filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByAmountBaseMeasurementUnitName(string $amount_base_measurement_unit_name) Return the first ChildSpySalesOrderItem filtered by the amount_base_measurement_unit_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByAmountMeasurementUnitCode(string $amount_measurement_unit_code) Return the first ChildSpySalesOrderItem filtered by the amount_measurement_unit_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByAmountMeasurementUnitConversion(double $amount_measurement_unit_conversion) Return the first ChildSpySalesOrderItem filtered by the amount_measurement_unit_conversion column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByAmountMeasurementUnitName(string $amount_measurement_unit_name) Return the first ChildSpySalesOrderItem filtered by the amount_measurement_unit_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByAmountMeasurementUnitPrecision(int $amount_measurement_unit_precision) Return the first ChildSpySalesOrderItem filtered by the amount_measurement_unit_precision column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByAmountSku(string $amount_sku) Return the first ChildSpySalesOrderItem filtered by the amount_sku column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByCanceledAmount(int $canceled_amount) Return the first ChildSpySalesOrderItem filtered by the canceled_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByCartNote(string $cart_note) Return the first ChildSpySalesOrderItem filtered by the cart_note column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByDiscountAmountAggregation(int $discount_amount_aggregation) Return the first ChildSpySalesOrderItem filtered by the discount_amount_aggregation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByDiscountAmountFullAggregation(int $discount_amount_full_aggregation) Return the first ChildSpySalesOrderItem filtered by the discount_amount_full_aggregation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByExpensePriceAggregation(int $expense_price_aggregation) Return the first ChildSpySalesOrderItem filtered by the expense_price_aggregation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByGrossPrice(int $gross_price) Return the first ChildSpySalesOrderItem filtered by the gross_price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByGroupKey(string $group_key) Return the first ChildSpySalesOrderItem filtered by the group_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByIsQuantitySplittable(boolean $is_quantity_splittable) Return the first ChildSpySalesOrderItem filtered by the is_quantity_splittable column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByLastStateChange(string $last_state_change) Return the first ChildSpySalesOrderItem filtered by the last_state_change column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByMerchantCommissionAmountAggregation(int $merchant_commission_amount_aggregation) Return the first ChildSpySalesOrderItem filtered by the merchant_commission_amount_aggregation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByMerchantCommissionAmountFullAggregation(int $merchant_commission_amount_full_aggregation) Return the first ChildSpySalesOrderItem filtered by the merchant_commission_amount_full_aggregation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByMerchantCommissionRefundedAmount(int $merchant_commission_refunded_amount) Return the first ChildSpySalesOrderItem filtered by the merchant_commission_refunded_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByMerchantReference(string $merchant_reference) Return the first ChildSpySalesOrderItem filtered by the merchant_reference column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByName(string $name) Return the first ChildSpySalesOrderItem filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByNetPrice(int $net_price) Return the first ChildSpySalesOrderItem filtered by the net_price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByOrderItemReference(string $order_item_reference) Return the first ChildSpySalesOrderItem filtered by the order_item_reference column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByPrice(int $price) Return the first ChildSpySalesOrderItem filtered by the price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByPriceToPayAggregation(int $price_to_pay_aggregation) Return the first ChildSpySalesOrderItem filtered by the price_to_pay_aggregation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByProductOfferReference(string $product_offer_reference) Return the first ChildSpySalesOrderItem filtered by the product_offer_reference column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByProductOptionPriceAggregation(int $product_option_price_aggregation) Return the first ChildSpySalesOrderItem filtered by the product_option_price_aggregation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByQuantity(int $quantity) Return the first ChildSpySalesOrderItem filtered by the quantity column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByQuantityBaseMeasurementUnitName(string $quantity_base_measurement_unit_name) Return the first ChildSpySalesOrderItem filtered by the quantity_base_measurement_unit_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByQuantityMeasurementUnitCode(string $quantity_measurement_unit_code) Return the first ChildSpySalesOrderItem filtered by the quantity_measurement_unit_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByQuantityMeasurementUnitConversion(double $quantity_measurement_unit_conversion) Return the first ChildSpySalesOrderItem filtered by the quantity_measurement_unit_conversion column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByQuantityMeasurementUnitName(string $quantity_measurement_unit_name) Return the first ChildSpySalesOrderItem filtered by the quantity_measurement_unit_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByQuantityMeasurementUnitPrecision(int $quantity_measurement_unit_precision) Return the first ChildSpySalesOrderItem filtered by the quantity_measurement_unit_precision column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByRefundableAmount(int $refundable_amount) Return the first ChildSpySalesOrderItem filtered by the refundable_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByRemunerationAmount(int $remuneration_amount) Return the first ChildSpySalesOrderItem filtered by the remuneration_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneBySku(string $sku) Return the first ChildSpySalesOrderItem filtered by the sku column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneBySubtotalAggregation(int $subtotal_aggregation) Return the first ChildSpySalesOrderItem filtered by the subtotal_aggregation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByTaxAmount(int $tax_amount) Return the first ChildSpySalesOrderItem filtered by the tax_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByTaxAmountAfterCancellation(int $tax_amount_after_cancellation) Return the first ChildSpySalesOrderItem filtered by the tax_amount_after_cancellation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByTaxAmountFullAggregation(int $tax_amount_full_aggregation) Return the first ChildSpySalesOrderItem filtered by the tax_amount_full_aggregation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByTaxRate(string $tax_rate) Return the first ChildSpySalesOrderItem filtered by the tax_rate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByTaxRateAverageAggregation(string $tax_rate_average_aggregation) Return the first ChildSpySalesOrderItem filtered by the tax_rate_average_aggregation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByUuid(string $uuid) Return the first ChildSpySalesOrderItem filtered by the uuid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByCreatedAt(string $created_at) Return the first ChildSpySalesOrderItem filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderItem requireOneByUpdatedAt(string $updated_at) Return the first ChildSpySalesOrderItem filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpySalesOrderItem[]|Collection find(?ConnectionInterface $con = null) Return ChildSpySalesOrderItem objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> find(?ConnectionInterface $con = null) Return ChildSpySalesOrderItem objects based on current ModelCriteria
 *
 * @method     ChildSpySalesOrderItem[]|Collection findByIdSalesOrderItem(int|array<int> $id_sales_order_item) Return ChildSpySalesOrderItem objects filtered by the id_sales_order_item column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByIdSalesOrderItem(int|array<int> $id_sales_order_item) Return ChildSpySalesOrderItem objects filtered by the id_sales_order_item column
 * @method     ChildSpySalesOrderItem[]|Collection findByFkOmsOrderItemState(int|array<int> $fk_oms_order_item_state) Return ChildSpySalesOrderItem objects filtered by the fk_oms_order_item_state column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByFkOmsOrderItemState(int|array<int> $fk_oms_order_item_state) Return ChildSpySalesOrderItem objects filtered by the fk_oms_order_item_state column
 * @method     ChildSpySalesOrderItem[]|Collection findByFkOmsOrderProcess(int|array<int> $fk_oms_order_process) Return ChildSpySalesOrderItem objects filtered by the fk_oms_order_process column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByFkOmsOrderProcess(int|array<int> $fk_oms_order_process) Return ChildSpySalesOrderItem objects filtered by the fk_oms_order_process column
 * @method     ChildSpySalesOrderItem[]|Collection findByFkSalesOrder(int|array<int> $fk_sales_order) Return ChildSpySalesOrderItem objects filtered by the fk_sales_order column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByFkSalesOrder(int|array<int> $fk_sales_order) Return ChildSpySalesOrderItem objects filtered by the fk_sales_order column
 * @method     ChildSpySalesOrderItem[]|Collection findByFkSalesOrderItemBundle(int|array<int> $fk_sales_order_item_bundle) Return ChildSpySalesOrderItem objects filtered by the fk_sales_order_item_bundle column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByFkSalesOrderItemBundle(int|array<int> $fk_sales_order_item_bundle) Return ChildSpySalesOrderItem objects filtered by the fk_sales_order_item_bundle column
 * @method     ChildSpySalesOrderItem[]|Collection findByFkSalesShipment(int|array<int> $fk_sales_shipment) Return ChildSpySalesOrderItem objects filtered by the fk_sales_shipment column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByFkSalesShipment(int|array<int> $fk_sales_shipment) Return ChildSpySalesOrderItem objects filtered by the fk_sales_shipment column
 * @method     ChildSpySalesOrderItem[]|Collection findByAmount(string|array<string> $amount) Return ChildSpySalesOrderItem objects filtered by the amount column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByAmount(string|array<string> $amount) Return ChildSpySalesOrderItem objects filtered by the amount column
 * @method     ChildSpySalesOrderItem[]|Collection findByAmountBaseMeasurementUnitName(string|array<string> $amount_base_measurement_unit_name) Return ChildSpySalesOrderItem objects filtered by the amount_base_measurement_unit_name column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByAmountBaseMeasurementUnitName(string|array<string> $amount_base_measurement_unit_name) Return ChildSpySalesOrderItem objects filtered by the amount_base_measurement_unit_name column
 * @method     ChildSpySalesOrderItem[]|Collection findByAmountMeasurementUnitCode(string|array<string> $amount_measurement_unit_code) Return ChildSpySalesOrderItem objects filtered by the amount_measurement_unit_code column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByAmountMeasurementUnitCode(string|array<string> $amount_measurement_unit_code) Return ChildSpySalesOrderItem objects filtered by the amount_measurement_unit_code column
 * @method     ChildSpySalesOrderItem[]|Collection findByAmountMeasurementUnitConversion(double|array<double> $amount_measurement_unit_conversion) Return ChildSpySalesOrderItem objects filtered by the amount_measurement_unit_conversion column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByAmountMeasurementUnitConversion(double|array<double> $amount_measurement_unit_conversion) Return ChildSpySalesOrderItem objects filtered by the amount_measurement_unit_conversion column
 * @method     ChildSpySalesOrderItem[]|Collection findByAmountMeasurementUnitName(string|array<string> $amount_measurement_unit_name) Return ChildSpySalesOrderItem objects filtered by the amount_measurement_unit_name column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByAmountMeasurementUnitName(string|array<string> $amount_measurement_unit_name) Return ChildSpySalesOrderItem objects filtered by the amount_measurement_unit_name column
 * @method     ChildSpySalesOrderItem[]|Collection findByAmountMeasurementUnitPrecision(int|array<int> $amount_measurement_unit_precision) Return ChildSpySalesOrderItem objects filtered by the amount_measurement_unit_precision column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByAmountMeasurementUnitPrecision(int|array<int> $amount_measurement_unit_precision) Return ChildSpySalesOrderItem objects filtered by the amount_measurement_unit_precision column
 * @method     ChildSpySalesOrderItem[]|Collection findByAmountSku(string|array<string> $amount_sku) Return ChildSpySalesOrderItem objects filtered by the amount_sku column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByAmountSku(string|array<string> $amount_sku) Return ChildSpySalesOrderItem objects filtered by the amount_sku column
 * @method     ChildSpySalesOrderItem[]|Collection findByCanceledAmount(int|array<int> $canceled_amount) Return ChildSpySalesOrderItem objects filtered by the canceled_amount column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByCanceledAmount(int|array<int> $canceled_amount) Return ChildSpySalesOrderItem objects filtered by the canceled_amount column
 * @method     ChildSpySalesOrderItem[]|Collection findByCartNote(string|array<string> $cart_note) Return ChildSpySalesOrderItem objects filtered by the cart_note column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByCartNote(string|array<string> $cart_note) Return ChildSpySalesOrderItem objects filtered by the cart_note column
 * @method     ChildSpySalesOrderItem[]|Collection findByDiscountAmountAggregation(int|array<int> $discount_amount_aggregation) Return ChildSpySalesOrderItem objects filtered by the discount_amount_aggregation column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByDiscountAmountAggregation(int|array<int> $discount_amount_aggregation) Return ChildSpySalesOrderItem objects filtered by the discount_amount_aggregation column
 * @method     ChildSpySalesOrderItem[]|Collection findByDiscountAmountFullAggregation(int|array<int> $discount_amount_full_aggregation) Return ChildSpySalesOrderItem objects filtered by the discount_amount_full_aggregation column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByDiscountAmountFullAggregation(int|array<int> $discount_amount_full_aggregation) Return ChildSpySalesOrderItem objects filtered by the discount_amount_full_aggregation column
 * @method     ChildSpySalesOrderItem[]|Collection findByExpensePriceAggregation(int|array<int> $expense_price_aggregation) Return ChildSpySalesOrderItem objects filtered by the expense_price_aggregation column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByExpensePriceAggregation(int|array<int> $expense_price_aggregation) Return ChildSpySalesOrderItem objects filtered by the expense_price_aggregation column
 * @method     ChildSpySalesOrderItem[]|Collection findByGrossPrice(int|array<int> $gross_price) Return ChildSpySalesOrderItem objects filtered by the gross_price column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByGrossPrice(int|array<int> $gross_price) Return ChildSpySalesOrderItem objects filtered by the gross_price column
 * @method     ChildSpySalesOrderItem[]|Collection findByGroupKey(string|array<string> $group_key) Return ChildSpySalesOrderItem objects filtered by the group_key column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByGroupKey(string|array<string> $group_key) Return ChildSpySalesOrderItem objects filtered by the group_key column
 * @method     ChildSpySalesOrderItem[]|Collection findByIsQuantitySplittable(boolean|array<boolean> $is_quantity_splittable) Return ChildSpySalesOrderItem objects filtered by the is_quantity_splittable column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByIsQuantitySplittable(boolean|array<boolean> $is_quantity_splittable) Return ChildSpySalesOrderItem objects filtered by the is_quantity_splittable column
 * @method     ChildSpySalesOrderItem[]|Collection findByLastStateChange(string|array<string> $last_state_change) Return ChildSpySalesOrderItem objects filtered by the last_state_change column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByLastStateChange(string|array<string> $last_state_change) Return ChildSpySalesOrderItem objects filtered by the last_state_change column
 * @method     ChildSpySalesOrderItem[]|Collection findByMerchantCommissionAmountAggregation(int|array<int> $merchant_commission_amount_aggregation) Return ChildSpySalesOrderItem objects filtered by the merchant_commission_amount_aggregation column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByMerchantCommissionAmountAggregation(int|array<int> $merchant_commission_amount_aggregation) Return ChildSpySalesOrderItem objects filtered by the merchant_commission_amount_aggregation column
 * @method     ChildSpySalesOrderItem[]|Collection findByMerchantCommissionAmountFullAggregation(int|array<int> $merchant_commission_amount_full_aggregation) Return ChildSpySalesOrderItem objects filtered by the merchant_commission_amount_full_aggregation column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByMerchantCommissionAmountFullAggregation(int|array<int> $merchant_commission_amount_full_aggregation) Return ChildSpySalesOrderItem objects filtered by the merchant_commission_amount_full_aggregation column
 * @method     ChildSpySalesOrderItem[]|Collection findByMerchantCommissionRefundedAmount(int|array<int> $merchant_commission_refunded_amount) Return ChildSpySalesOrderItem objects filtered by the merchant_commission_refunded_amount column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByMerchantCommissionRefundedAmount(int|array<int> $merchant_commission_refunded_amount) Return ChildSpySalesOrderItem objects filtered by the merchant_commission_refunded_amount column
 * @method     ChildSpySalesOrderItem[]|Collection findByMerchantReference(string|array<string> $merchant_reference) Return ChildSpySalesOrderItem objects filtered by the merchant_reference column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByMerchantReference(string|array<string> $merchant_reference) Return ChildSpySalesOrderItem objects filtered by the merchant_reference column
 * @method     ChildSpySalesOrderItem[]|Collection findByName(string|array<string> $name) Return ChildSpySalesOrderItem objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByName(string|array<string> $name) Return ChildSpySalesOrderItem objects filtered by the name column
 * @method     ChildSpySalesOrderItem[]|Collection findByNetPrice(int|array<int> $net_price) Return ChildSpySalesOrderItem objects filtered by the net_price column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByNetPrice(int|array<int> $net_price) Return ChildSpySalesOrderItem objects filtered by the net_price column
 * @method     ChildSpySalesOrderItem[]|Collection findByOrderItemReference(string|array<string> $order_item_reference) Return ChildSpySalesOrderItem objects filtered by the order_item_reference column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByOrderItemReference(string|array<string> $order_item_reference) Return ChildSpySalesOrderItem objects filtered by the order_item_reference column
 * @method     ChildSpySalesOrderItem[]|Collection findByPrice(int|array<int> $price) Return ChildSpySalesOrderItem objects filtered by the price column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByPrice(int|array<int> $price) Return ChildSpySalesOrderItem objects filtered by the price column
 * @method     ChildSpySalesOrderItem[]|Collection findByPriceToPayAggregation(int|array<int> $price_to_pay_aggregation) Return ChildSpySalesOrderItem objects filtered by the price_to_pay_aggregation column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByPriceToPayAggregation(int|array<int> $price_to_pay_aggregation) Return ChildSpySalesOrderItem objects filtered by the price_to_pay_aggregation column
 * @method     ChildSpySalesOrderItem[]|Collection findByProductOfferReference(string|array<string> $product_offer_reference) Return ChildSpySalesOrderItem objects filtered by the product_offer_reference column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByProductOfferReference(string|array<string> $product_offer_reference) Return ChildSpySalesOrderItem objects filtered by the product_offer_reference column
 * @method     ChildSpySalesOrderItem[]|Collection findByProductOptionPriceAggregation(int|array<int> $product_option_price_aggregation) Return ChildSpySalesOrderItem objects filtered by the product_option_price_aggregation column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByProductOptionPriceAggregation(int|array<int> $product_option_price_aggregation) Return ChildSpySalesOrderItem objects filtered by the product_option_price_aggregation column
 * @method     ChildSpySalesOrderItem[]|Collection findByQuantity(int|array<int> $quantity) Return ChildSpySalesOrderItem objects filtered by the quantity column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByQuantity(int|array<int> $quantity) Return ChildSpySalesOrderItem objects filtered by the quantity column
 * @method     ChildSpySalesOrderItem[]|Collection findByQuantityBaseMeasurementUnitName(string|array<string> $quantity_base_measurement_unit_name) Return ChildSpySalesOrderItem objects filtered by the quantity_base_measurement_unit_name column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByQuantityBaseMeasurementUnitName(string|array<string> $quantity_base_measurement_unit_name) Return ChildSpySalesOrderItem objects filtered by the quantity_base_measurement_unit_name column
 * @method     ChildSpySalesOrderItem[]|Collection findByQuantityMeasurementUnitCode(string|array<string> $quantity_measurement_unit_code) Return ChildSpySalesOrderItem objects filtered by the quantity_measurement_unit_code column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByQuantityMeasurementUnitCode(string|array<string> $quantity_measurement_unit_code) Return ChildSpySalesOrderItem objects filtered by the quantity_measurement_unit_code column
 * @method     ChildSpySalesOrderItem[]|Collection findByQuantityMeasurementUnitConversion(double|array<double> $quantity_measurement_unit_conversion) Return ChildSpySalesOrderItem objects filtered by the quantity_measurement_unit_conversion column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByQuantityMeasurementUnitConversion(double|array<double> $quantity_measurement_unit_conversion) Return ChildSpySalesOrderItem objects filtered by the quantity_measurement_unit_conversion column
 * @method     ChildSpySalesOrderItem[]|Collection findByQuantityMeasurementUnitName(string|array<string> $quantity_measurement_unit_name) Return ChildSpySalesOrderItem objects filtered by the quantity_measurement_unit_name column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByQuantityMeasurementUnitName(string|array<string> $quantity_measurement_unit_name) Return ChildSpySalesOrderItem objects filtered by the quantity_measurement_unit_name column
 * @method     ChildSpySalesOrderItem[]|Collection findByQuantityMeasurementUnitPrecision(int|array<int> $quantity_measurement_unit_precision) Return ChildSpySalesOrderItem objects filtered by the quantity_measurement_unit_precision column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByQuantityMeasurementUnitPrecision(int|array<int> $quantity_measurement_unit_precision) Return ChildSpySalesOrderItem objects filtered by the quantity_measurement_unit_precision column
 * @method     ChildSpySalesOrderItem[]|Collection findByRefundableAmount(int|array<int> $refundable_amount) Return ChildSpySalesOrderItem objects filtered by the refundable_amount column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByRefundableAmount(int|array<int> $refundable_amount) Return ChildSpySalesOrderItem objects filtered by the refundable_amount column
 * @method     ChildSpySalesOrderItem[]|Collection findByRemunerationAmount(int|array<int> $remuneration_amount) Return ChildSpySalesOrderItem objects filtered by the remuneration_amount column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByRemunerationAmount(int|array<int> $remuneration_amount) Return ChildSpySalesOrderItem objects filtered by the remuneration_amount column
 * @method     ChildSpySalesOrderItem[]|Collection findBySku(string|array<string> $sku) Return ChildSpySalesOrderItem objects filtered by the sku column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findBySku(string|array<string> $sku) Return ChildSpySalesOrderItem objects filtered by the sku column
 * @method     ChildSpySalesOrderItem[]|Collection findBySubtotalAggregation(int|array<int> $subtotal_aggregation) Return ChildSpySalesOrderItem objects filtered by the subtotal_aggregation column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findBySubtotalAggregation(int|array<int> $subtotal_aggregation) Return ChildSpySalesOrderItem objects filtered by the subtotal_aggregation column
 * @method     ChildSpySalesOrderItem[]|Collection findByTaxAmount(int|array<int> $tax_amount) Return ChildSpySalesOrderItem objects filtered by the tax_amount column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByTaxAmount(int|array<int> $tax_amount) Return ChildSpySalesOrderItem objects filtered by the tax_amount column
 * @method     ChildSpySalesOrderItem[]|Collection findByTaxAmountAfterCancellation(int|array<int> $tax_amount_after_cancellation) Return ChildSpySalesOrderItem objects filtered by the tax_amount_after_cancellation column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByTaxAmountAfterCancellation(int|array<int> $tax_amount_after_cancellation) Return ChildSpySalesOrderItem objects filtered by the tax_amount_after_cancellation column
 * @method     ChildSpySalesOrderItem[]|Collection findByTaxAmountFullAggregation(int|array<int> $tax_amount_full_aggregation) Return ChildSpySalesOrderItem objects filtered by the tax_amount_full_aggregation column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByTaxAmountFullAggregation(int|array<int> $tax_amount_full_aggregation) Return ChildSpySalesOrderItem objects filtered by the tax_amount_full_aggregation column
 * @method     ChildSpySalesOrderItem[]|Collection findByTaxRate(string|array<string> $tax_rate) Return ChildSpySalesOrderItem objects filtered by the tax_rate column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByTaxRate(string|array<string> $tax_rate) Return ChildSpySalesOrderItem objects filtered by the tax_rate column
 * @method     ChildSpySalesOrderItem[]|Collection findByTaxRateAverageAggregation(string|array<string> $tax_rate_average_aggregation) Return ChildSpySalesOrderItem objects filtered by the tax_rate_average_aggregation column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByTaxRateAverageAggregation(string|array<string> $tax_rate_average_aggregation) Return ChildSpySalesOrderItem objects filtered by the tax_rate_average_aggregation column
 * @method     ChildSpySalesOrderItem[]|Collection findByUuid(string|array<string> $uuid) Return ChildSpySalesOrderItem objects filtered by the uuid column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByUuid(string|array<string> $uuid) Return ChildSpySalesOrderItem objects filtered by the uuid column
 * @method     ChildSpySalesOrderItem[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpySalesOrderItem objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByCreatedAt(string|array<string> $created_at) Return ChildSpySalesOrderItem objects filtered by the created_at column
 * @method     ChildSpySalesOrderItem[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpySalesOrderItem objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderItem> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpySalesOrderItem objects filtered by the updated_at column
 *
 * @method     ChildSpySalesOrderItem[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpySalesOrderItem> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpySalesOrderItemQuery extends ModelCriteria
{

    /**
     * @var bool
     */
    protected $isForUpdateEnabled = false;

    /**
     * @deprecated Use {@link \Propel\Runtime\ActiveQuery\Criteria::lockForUpdate()} instead.
     *
     * @param bool $isForUpdateEnabled
     *
     * @return $this The primary criteria object
     */
    public function forUpdate($isForUpdateEnabled)
    {
        $this->isForUpdateEnabled = $isForUpdateEnabled;

        return $this;
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function createSelectSql(&$params): string
    {
        $sql = parent::createSelectSql($params);
        if ($this->isForUpdateEnabled) {
            $sql .= ' FOR UPDATE';
        }

        return $sql;
    }

    /**
     * Clear the conditions to allow the reuse of the query object.
     * The ModelCriteria's Model and alias 'all the properties set by construct) will remain.
     *
     * @return $this The primary criteria object
     */
    public function clear()
    {
        parent::clear();

        $this->isSelfSelected = false;
        $this->forUpdate(false);

        return $this;
    }


    /**
     * @param int $affectedRows
     * @param \Propel\Runtime\Connection\ConnectionInterface $con
     *
     * @return int|null
     */
    protected function postUpdate(int $affectedRows, ConnectionInterface $con): ?int
    {
        $class = get_class($this);
        PropelReplicationCacheFacade::getInstance()->setKey($class);

        return null;
    }

    /**
     * @param int $affectedRows
     * @param \Propel\Runtime\Connection\ConnectionInterface $con
     *
     * @return int|null
     */
    protected function postDelete(int $affectedRows, ConnectionInterface $con): ?int
    {
        $class = get_class($this);
        PropelReplicationCacheFacade::getInstance()->setKey($class);

        return null;
    }

    /**
     * Issue a SELECT query based on the current ModelCriteria
     * and format the list of results with the current formatter
     * By default, returns an array of model objects
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con an optional connection object
     *
     * @return \Propel\Runtime\Collection\ObjectCollection|\Propel\Runtime\ActiveRecord\ActiveRecordInterface[]|mixed the list of results, formatted by the current formatter
     */
    public function find(?ConnectionInterface $con = null)
    {
        $class = get_class($this);
        $mustUseWriteContext = PropelReplicationCacheFacade::getInstance()->hasKey($class);

        if ($mustUseWriteContext) {
            $con = Propel::getWriteConnection($this->getDbName());
        } elseif ($con === null) {
            $con = Propel::getReadConnection($this->getDbName());
        }

        return parent::find($con);
    }

    /**
     * Issue a SELECT ... LIMIT 1 query based on the current ModelCriteria
     * and format the result with the current formatter
     * By default, returns a model object.
     *
     * Does not work with ->with()s containing one-to-many relations.
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con an optional connection object
     *
     * @return mixed the result, formatted by the current formatter
     */
    public function findOne(?ConnectionInterface $con = null)
    {
        $class = get_class($this);
        $mustUseWriteContext = PropelReplicationCacheFacade::getInstance()->hasKey($class);

        if ($mustUseWriteContext) {
            $con = Propel::getWriteConnection($this->getDbName());
        } elseif ($con === null) {
            $con = Propel::getReadConnection($this->getDbName());
        }

        return parent::findOne($con);
    }

    /**
     * Issue an existence check on the current ModelCriteria
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con an optional connection object
     *
     * @return bool column existence
     */
    public function exists(?ConnectionInterface $con = null): bool
    {
        $class = get_class($this);
        $mustUseWriteContext = PropelReplicationCacheFacade::getInstance()->hasKey($class);

        if ($mustUseWriteContext) {
            $con = Propel::getWriteConnection($this->getDbName());
        } elseif ($con === null) {
            $con = Propel::getReadConnection($this->getDbName());
        }

        return parent::exists($con);
    }

    /**
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return void
     */
    public function configureSelectColumns(): void
    {
        if (!$this->select) {
            return;
        }

        if ($this->formatter === null) {
            $this->setFormatter(new TypeAwareSimpleArrayFormatter());
        }

        parent::configureSelectColumns();
     }
        protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Orm\Zed\Sales\Persistence\Base\SpySalesOrderItemQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrderItem', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpySalesOrderItemQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpySalesOrderItemQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpySalesOrderItemQuery) {
            return $criteria;
        }
        $query = new ChildSpySalesOrderItemQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildSpySalesOrderItem|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        $class = get_class($this);
        $mustUseWriteContext = PropelReplicationCacheFacade::getInstance()->hasKey($class);

        if ($mustUseWriteContext) {
            $con = Propel::getWriteConnection($this->getDbName());
        } elseif ($con === null) {
            $con = Propel::getReadConnection($this->getDbName());
        }


        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SpySalesOrderItemTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSpySalesOrderItem A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_sales_order_item, fk_oms_order_item_state, fk_oms_order_process, fk_sales_order, fk_sales_order_item_bundle, fk_sales_shipment, amount, amount_base_measurement_unit_name, amount_measurement_unit_code, amount_measurement_unit_conversion, amount_measurement_unit_name, amount_measurement_unit_precision, amount_sku, canceled_amount, cart_note, discount_amount_aggregation, discount_amount_full_aggregation, expense_price_aggregation, gross_price, group_key, is_quantity_splittable, last_state_change, merchant_commission_amount_aggregation, merchant_commission_amount_full_aggregation, merchant_commission_refunded_amount, merchant_reference, name, net_price, order_item_reference, price, price_to_pay_aggregation, product_offer_reference, product_option_price_aggregation, quantity, quantity_base_measurement_unit_name, quantity_measurement_unit_code, quantity_measurement_unit_conversion, quantity_measurement_unit_name, quantity_measurement_unit_precision, refundable_amount, remuneration_amount, sku, subtotal_aggregation, tax_amount, tax_amount_after_cancellation, tax_amount_full_aggregation, tax_rate, tax_rate_average_aggregation, uuid, created_at, updated_at FROM spy_sales_order_item WHERE id_sales_order_item = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildSpySalesOrderItem $obj */
            $obj = new ChildSpySalesOrderItem();
            $obj->hydrate($row);
            SpySalesOrderItemTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @return ChildSpySalesOrderItem|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return    Collection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        $class = get_class($this);
        $mustUseWriteContext = PropelReplicationCacheFacade::getInstance()->hasKey($class);

        if ($mustUseWriteContext) {
            $con = Propel::getWriteConnection($this->getDbName());
        } elseif ($con === null) {
            $con = Propel::getReadConnection($this->getDbName());
        }


        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }

        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param mixed $key Primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        $this->addUsingAlias(SpySalesOrderItemTableMap::COL_ID_SALES_ORDER_ITEM, $key, Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param array|int $keys The list of primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        $this->addUsingAlias(SpySalesOrderItemTableMap::COL_ID_SALES_ORDER_ITEM, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idSalesOrderItem Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdSalesOrderItem_Between(array $idSalesOrderItem)
    {
        return $this->filterByIdSalesOrderItem($idSalesOrderItem, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idSalesOrderItems Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdSalesOrderItem_In(array $idSalesOrderItems)
    {
        return $this->filterByIdSalesOrderItem($idSalesOrderItems, Criteria::IN);
    }

    /**
     * Filter the query on the id_sales_order_item column
     *
     * Example usage:
     * <code>
     * $query->filterByIdSalesOrderItem(1234); // WHERE id_sales_order_item = 1234
     * $query->filterByIdSalesOrderItem(array(12, 34), Criteria::IN); // WHERE id_sales_order_item IN (12, 34)
     * $query->filterByIdSalesOrderItem(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_sales_order_item > 12
     * </code>
     *
     * @param     mixed $idSalesOrderItem The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdSalesOrderItem($idSalesOrderItem = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idSalesOrderItem)) {
            $useMinMax = false;
            if (isset($idSalesOrderItem['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_ID_SALES_ORDER_ITEM, $idSalesOrderItem['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idSalesOrderItem['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_ID_SALES_ORDER_ITEM, $idSalesOrderItem['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idSalesOrderItem of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_ID_SALES_ORDER_ITEM, $idSalesOrderItem, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkOmsOrderItemState Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkOmsOrderItemState_Between(array $fkOmsOrderItemState)
    {
        return $this->filterByFkOmsOrderItemState($fkOmsOrderItemState, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkOmsOrderItemStates Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkOmsOrderItemState_In(array $fkOmsOrderItemStates)
    {
        return $this->filterByFkOmsOrderItemState($fkOmsOrderItemStates, Criteria::IN);
    }

    /**
     * Filter the query on the fk_oms_order_item_state column
     *
     * Example usage:
     * <code>
     * $query->filterByFkOmsOrderItemState(1234); // WHERE fk_oms_order_item_state = 1234
     * $query->filterByFkOmsOrderItemState(array(12, 34), Criteria::IN); // WHERE fk_oms_order_item_state IN (12, 34)
     * $query->filterByFkOmsOrderItemState(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_oms_order_item_state > 12
     * </code>
     *
     * @see       filterByState()
     *
     * @param     mixed $fkOmsOrderItemState The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkOmsOrderItemState($fkOmsOrderItemState = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkOmsOrderItemState)) {
            $useMinMax = false;
            if (isset($fkOmsOrderItemState['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_FK_OMS_ORDER_ITEM_STATE, $fkOmsOrderItemState['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkOmsOrderItemState['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_FK_OMS_ORDER_ITEM_STATE, $fkOmsOrderItemState['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkOmsOrderItemState of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_FK_OMS_ORDER_ITEM_STATE, $fkOmsOrderItemState, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkOmsOrderProcess Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkOmsOrderProcess_Between(array $fkOmsOrderProcess)
    {
        return $this->filterByFkOmsOrderProcess($fkOmsOrderProcess, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkOmsOrderProcesss Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkOmsOrderProcess_In(array $fkOmsOrderProcesss)
    {
        return $this->filterByFkOmsOrderProcess($fkOmsOrderProcesss, Criteria::IN);
    }

    /**
     * Filter the query on the fk_oms_order_process column
     *
     * Example usage:
     * <code>
     * $query->filterByFkOmsOrderProcess(1234); // WHERE fk_oms_order_process = 1234
     * $query->filterByFkOmsOrderProcess(array(12, 34), Criteria::IN); // WHERE fk_oms_order_process IN (12, 34)
     * $query->filterByFkOmsOrderProcess(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_oms_order_process > 12
     * </code>
     *
     * @see       filterByProcess()
     *
     * @param     mixed $fkOmsOrderProcess The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkOmsOrderProcess($fkOmsOrderProcess = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkOmsOrderProcess)) {
            $useMinMax = false;
            if (isset($fkOmsOrderProcess['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_FK_OMS_ORDER_PROCESS, $fkOmsOrderProcess['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkOmsOrderProcess['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_FK_OMS_ORDER_PROCESS, $fkOmsOrderProcess['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkOmsOrderProcess of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_FK_OMS_ORDER_PROCESS, $fkOmsOrderProcess, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkSalesOrder Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkSalesOrder_Between(array $fkSalesOrder)
    {
        return $this->filterByFkSalesOrder($fkSalesOrder, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkSalesOrders Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkSalesOrder_In(array $fkSalesOrders)
    {
        return $this->filterByFkSalesOrder($fkSalesOrders, Criteria::IN);
    }

    /**
     * Filter the query on the fk_sales_order column
     *
     * Example usage:
     * <code>
     * $query->filterByFkSalesOrder(1234); // WHERE fk_sales_order = 1234
     * $query->filterByFkSalesOrder(array(12, 34), Criteria::IN); // WHERE fk_sales_order IN (12, 34)
     * $query->filterByFkSalesOrder(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_sales_order > 12
     * </code>
     *
     * @see       filterByOrder()
     *
     * @param     mixed $fkSalesOrder The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkSalesOrder($fkSalesOrder = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkSalesOrder)) {
            $useMinMax = false;
            if (isset($fkSalesOrder['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_FK_SALES_ORDER, $fkSalesOrder['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkSalesOrder['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_FK_SALES_ORDER, $fkSalesOrder['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkSalesOrder of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_FK_SALES_ORDER, $fkSalesOrder, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkSalesOrderItemBundle Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkSalesOrderItemBundle_Between(array $fkSalesOrderItemBundle)
    {
        return $this->filterByFkSalesOrderItemBundle($fkSalesOrderItemBundle, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkSalesOrderItemBundles Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkSalesOrderItemBundle_In(array $fkSalesOrderItemBundles)
    {
        return $this->filterByFkSalesOrderItemBundle($fkSalesOrderItemBundles, Criteria::IN);
    }

    /**
     * Filter the query on the fk_sales_order_item_bundle column
     *
     * Example usage:
     * <code>
     * $query->filterByFkSalesOrderItemBundle(1234); // WHERE fk_sales_order_item_bundle = 1234
     * $query->filterByFkSalesOrderItemBundle(array(12, 34), Criteria::IN); // WHERE fk_sales_order_item_bundle IN (12, 34)
     * $query->filterByFkSalesOrderItemBundle(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_sales_order_item_bundle > 12
     * </code>
     *
     * @see       filterBySalesOrderItemBundle()
     *
     * @param     mixed $fkSalesOrderItemBundle The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkSalesOrderItemBundle($fkSalesOrderItemBundle = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkSalesOrderItemBundle)) {
            $useMinMax = false;
            if (isset($fkSalesOrderItemBundle['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_FK_SALES_ORDER_ITEM_BUNDLE, $fkSalesOrderItemBundle['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkSalesOrderItemBundle['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_FK_SALES_ORDER_ITEM_BUNDLE, $fkSalesOrderItemBundle['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkSalesOrderItemBundle of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_FK_SALES_ORDER_ITEM_BUNDLE, $fkSalesOrderItemBundle, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkSalesShipment Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkSalesShipment_Between(array $fkSalesShipment)
    {
        return $this->filterByFkSalesShipment($fkSalesShipment, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkSalesShipments Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkSalesShipment_In(array $fkSalesShipments)
    {
        return $this->filterByFkSalesShipment($fkSalesShipments, Criteria::IN);
    }

    /**
     * Filter the query on the fk_sales_shipment column
     *
     * Example usage:
     * <code>
     * $query->filterByFkSalesShipment(1234); // WHERE fk_sales_shipment = 1234
     * $query->filterByFkSalesShipment(array(12, 34), Criteria::IN); // WHERE fk_sales_shipment IN (12, 34)
     * $query->filterByFkSalesShipment(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_sales_shipment > 12
     * </code>
     *
     * @see       filterBySpySalesShipment()
     *
     * @param     mixed $fkSalesShipment The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkSalesShipment($fkSalesShipment = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkSalesShipment)) {
            $useMinMax = false;
            if (isset($fkSalesShipment['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_FK_SALES_SHIPMENT, $fkSalesShipment['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkSalesShipment['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_FK_SALES_SHIPMENT, $fkSalesShipment['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkSalesShipment of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_FK_SALES_SHIPMENT, $fkSalesShipment, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $amount Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmount_Between(array $amount)
    {
        return $this->filterByAmount($amount, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $amounts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmount_In(array $amounts)
    {
        return $this->filterByAmount($amounts, Criteria::IN);
    }

    /**
     * Filter the query on the amount column
     *
     * Example usage:
     * <code>
     * $query->filterByAmount(1234); // WHERE amount = 1234
     * $query->filterByAmount(array(12, 34), Criteria::IN); // WHERE amount IN (12, 34)
     * $query->filterByAmount(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE amount > 12
     * </code>
     *
     * @param     mixed $amount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAmount($amount = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($amount)) {
            $useMinMax = false;
            if (isset($amount['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$amount of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_AMOUNT, $amount, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $amountBaseMeasurementUnitNames Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmountBaseMeasurementUnitName_In(array $amountBaseMeasurementUnitNames)
    {
        return $this->filterByAmountBaseMeasurementUnitName($amountBaseMeasurementUnitNames, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $amountBaseMeasurementUnitName Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmountBaseMeasurementUnitName_Like($amountBaseMeasurementUnitName)
    {
        return $this->filterByAmountBaseMeasurementUnitName($amountBaseMeasurementUnitName, Criteria::LIKE);
    }

    /**
     * Filter the query on the amount_base_measurement_unit_name column
     *
     * Example usage:
     * <code>
     * $query->filterByAmountBaseMeasurementUnitName('fooValue');   // WHERE amount_base_measurement_unit_name = 'fooValue'
     * $query->filterByAmountBaseMeasurementUnitName('%fooValue%', Criteria::LIKE); // WHERE amount_base_measurement_unit_name LIKE '%fooValue%'
     * $query->filterByAmountBaseMeasurementUnitName([1, 'foo'], Criteria::IN); // WHERE amount_base_measurement_unit_name IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $amountBaseMeasurementUnitName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAmountBaseMeasurementUnitName($amountBaseMeasurementUnitName = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $amountBaseMeasurementUnitName = str_replace('*', '%', $amountBaseMeasurementUnitName);
        }

        if (is_array($amountBaseMeasurementUnitName) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$amountBaseMeasurementUnitName of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_AMOUNT_BASE_MEASUREMENT_UNIT_NAME, $amountBaseMeasurementUnitName, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $amountMeasurementUnitCodes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmountMeasurementUnitCode_In(array $amountMeasurementUnitCodes)
    {
        return $this->filterByAmountMeasurementUnitCode($amountMeasurementUnitCodes, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $amountMeasurementUnitCode Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmountMeasurementUnitCode_Like($amountMeasurementUnitCode)
    {
        return $this->filterByAmountMeasurementUnitCode($amountMeasurementUnitCode, Criteria::LIKE);
    }

    /**
     * Filter the query on the amount_measurement_unit_code column
     *
     * Example usage:
     * <code>
     * $query->filterByAmountMeasurementUnitCode('fooValue');   // WHERE amount_measurement_unit_code = 'fooValue'
     * $query->filterByAmountMeasurementUnitCode('%fooValue%', Criteria::LIKE); // WHERE amount_measurement_unit_code LIKE '%fooValue%'
     * $query->filterByAmountMeasurementUnitCode([1, 'foo'], Criteria::IN); // WHERE amount_measurement_unit_code IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $amountMeasurementUnitCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAmountMeasurementUnitCode($amountMeasurementUnitCode = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $amountMeasurementUnitCode = str_replace('*', '%', $amountMeasurementUnitCode);
        }

        if (is_array($amountMeasurementUnitCode) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$amountMeasurementUnitCode of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_AMOUNT_MEASUREMENT_UNIT_CODE, $amountMeasurementUnitCode, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $amountMeasurementUnitConversion Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmountMeasurementUnitConversion_Between(array $amountMeasurementUnitConversion)
    {
        return $this->filterByAmountMeasurementUnitConversion($amountMeasurementUnitConversion, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $amountMeasurementUnitConversions Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmountMeasurementUnitConversion_In(array $amountMeasurementUnitConversions)
    {
        return $this->filterByAmountMeasurementUnitConversion($amountMeasurementUnitConversions, Criteria::IN);
    }

    /**
     * Filter the query on the amount_measurement_unit_conversion column
     *
     * Example usage:
     * <code>
     * $query->filterByAmountMeasurementUnitConversion(1234); // WHERE amount_measurement_unit_conversion = 1234
     * $query->filterByAmountMeasurementUnitConversion(array(12, 34), Criteria::IN); // WHERE amount_measurement_unit_conversion IN (12, 34)
     * $query->filterByAmountMeasurementUnitConversion(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE amount_measurement_unit_conversion > 12
     * </code>
     *
     * @param     mixed $amountMeasurementUnitConversion The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAmountMeasurementUnitConversion($amountMeasurementUnitConversion = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($amountMeasurementUnitConversion)) {
            $useMinMax = false;
            if (isset($amountMeasurementUnitConversion['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_AMOUNT_MEASUREMENT_UNIT_CONVERSION, $amountMeasurementUnitConversion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amountMeasurementUnitConversion['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_AMOUNT_MEASUREMENT_UNIT_CONVERSION, $amountMeasurementUnitConversion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$amountMeasurementUnitConversion of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_AMOUNT_MEASUREMENT_UNIT_CONVERSION, $amountMeasurementUnitConversion, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $amountMeasurementUnitNames Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmountMeasurementUnitName_In(array $amountMeasurementUnitNames)
    {
        return $this->filterByAmountMeasurementUnitName($amountMeasurementUnitNames, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $amountMeasurementUnitName Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmountMeasurementUnitName_Like($amountMeasurementUnitName)
    {
        return $this->filterByAmountMeasurementUnitName($amountMeasurementUnitName, Criteria::LIKE);
    }

    /**
     * Filter the query on the amount_measurement_unit_name column
     *
     * Example usage:
     * <code>
     * $query->filterByAmountMeasurementUnitName('fooValue');   // WHERE amount_measurement_unit_name = 'fooValue'
     * $query->filterByAmountMeasurementUnitName('%fooValue%', Criteria::LIKE); // WHERE amount_measurement_unit_name LIKE '%fooValue%'
     * $query->filterByAmountMeasurementUnitName([1, 'foo'], Criteria::IN); // WHERE amount_measurement_unit_name IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $amountMeasurementUnitName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAmountMeasurementUnitName($amountMeasurementUnitName = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $amountMeasurementUnitName = str_replace('*', '%', $amountMeasurementUnitName);
        }

        if (is_array($amountMeasurementUnitName) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$amountMeasurementUnitName of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_AMOUNT_MEASUREMENT_UNIT_NAME, $amountMeasurementUnitName, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $amountMeasurementUnitPrecision Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmountMeasurementUnitPrecision_Between(array $amountMeasurementUnitPrecision)
    {
        return $this->filterByAmountMeasurementUnitPrecision($amountMeasurementUnitPrecision, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $amountMeasurementUnitPrecisions Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmountMeasurementUnitPrecision_In(array $amountMeasurementUnitPrecisions)
    {
        return $this->filterByAmountMeasurementUnitPrecision($amountMeasurementUnitPrecisions, Criteria::IN);
    }

    /**
     * Filter the query on the amount_measurement_unit_precision column
     *
     * Example usage:
     * <code>
     * $query->filterByAmountMeasurementUnitPrecision(1234); // WHERE amount_measurement_unit_precision = 1234
     * $query->filterByAmountMeasurementUnitPrecision(array(12, 34), Criteria::IN); // WHERE amount_measurement_unit_precision IN (12, 34)
     * $query->filterByAmountMeasurementUnitPrecision(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE amount_measurement_unit_precision > 12
     * </code>
     *
     * @param     mixed $amountMeasurementUnitPrecision The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAmountMeasurementUnitPrecision($amountMeasurementUnitPrecision = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($amountMeasurementUnitPrecision)) {
            $useMinMax = false;
            if (isset($amountMeasurementUnitPrecision['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_AMOUNT_MEASUREMENT_UNIT_PRECISION, $amountMeasurementUnitPrecision['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amountMeasurementUnitPrecision['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_AMOUNT_MEASUREMENT_UNIT_PRECISION, $amountMeasurementUnitPrecision['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$amountMeasurementUnitPrecision of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_AMOUNT_MEASUREMENT_UNIT_PRECISION, $amountMeasurementUnitPrecision, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $amountSkus Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmountSku_In(array $amountSkus)
    {
        return $this->filterByAmountSku($amountSkus, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $amountSku Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmountSku_Like($amountSku)
    {
        return $this->filterByAmountSku($amountSku, Criteria::LIKE);
    }

    /**
     * Filter the query on the amount_sku column
     *
     * Example usage:
     * <code>
     * $query->filterByAmountSku('fooValue');   // WHERE amount_sku = 'fooValue'
     * $query->filterByAmountSku('%fooValue%', Criteria::LIKE); // WHERE amount_sku LIKE '%fooValue%'
     * $query->filterByAmountSku([1, 'foo'], Criteria::IN); // WHERE amount_sku IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $amountSku The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAmountSku($amountSku = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $amountSku = str_replace('*', '%', $amountSku);
        }

        if (is_array($amountSku) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$amountSku of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_AMOUNT_SKU, $amountSku, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $canceledAmount Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCanceledAmount_Between(array $canceledAmount)
    {
        return $this->filterByCanceledAmount($canceledAmount, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $canceledAmounts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCanceledAmount_In(array $canceledAmounts)
    {
        return $this->filterByCanceledAmount($canceledAmounts, Criteria::IN);
    }

    /**
     * Filter the query on the canceled_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByCanceledAmount(1234); // WHERE canceled_amount = 1234
     * $query->filterByCanceledAmount(array(12, 34), Criteria::IN); // WHERE canceled_amount IN (12, 34)
     * $query->filterByCanceledAmount(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE canceled_amount > 12
     * </code>
     *
     * @param     mixed $canceledAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByCanceledAmount($canceledAmount = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($canceledAmount)) {
            $useMinMax = false;
            if (isset($canceledAmount['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_CANCELED_AMOUNT, $canceledAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($canceledAmount['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_CANCELED_AMOUNT, $canceledAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$canceledAmount of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_CANCELED_AMOUNT, $canceledAmount, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $cartNotes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCartNote_In(array $cartNotes)
    {
        return $this->filterByCartNote($cartNotes, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $cartNote Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCartNote_Like($cartNote)
    {
        return $this->filterByCartNote($cartNote, Criteria::LIKE);
    }

    /**
     * Filter the query on the cart_note column
     *
     * Example usage:
     * <code>
     * $query->filterByCartNote('fooValue');   // WHERE cart_note = 'fooValue'
     * $query->filterByCartNote('%fooValue%', Criteria::LIKE); // WHERE cart_note LIKE '%fooValue%'
     * $query->filterByCartNote([1, 'foo'], Criteria::IN); // WHERE cart_note IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $cartNote The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByCartNote($cartNote = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $cartNote = str_replace('*', '%', $cartNote);
        }

        if (is_array($cartNote) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$cartNote of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_CART_NOTE, $cartNote, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $discountAmountAggregation Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDiscountAmountAggregation_Between(array $discountAmountAggregation)
    {
        return $this->filterByDiscountAmountAggregation($discountAmountAggregation, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $discountAmountAggregations Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDiscountAmountAggregation_In(array $discountAmountAggregations)
    {
        return $this->filterByDiscountAmountAggregation($discountAmountAggregations, Criteria::IN);
    }

    /**
     * Filter the query on the discount_amount_aggregation column
     *
     * Example usage:
     * <code>
     * $query->filterByDiscountAmountAggregation(1234); // WHERE discount_amount_aggregation = 1234
     * $query->filterByDiscountAmountAggregation(array(12, 34), Criteria::IN); // WHERE discount_amount_aggregation IN (12, 34)
     * $query->filterByDiscountAmountAggregation(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE discount_amount_aggregation > 12
     * </code>
     *
     * @param     mixed $discountAmountAggregation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByDiscountAmountAggregation($discountAmountAggregation = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($discountAmountAggregation)) {
            $useMinMax = false;
            if (isset($discountAmountAggregation['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_DISCOUNT_AMOUNT_AGGREGATION, $discountAmountAggregation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($discountAmountAggregation['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_DISCOUNT_AMOUNT_AGGREGATION, $discountAmountAggregation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$discountAmountAggregation of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_DISCOUNT_AMOUNT_AGGREGATION, $discountAmountAggregation, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $discountAmountFullAggregation Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDiscountAmountFullAggregation_Between(array $discountAmountFullAggregation)
    {
        return $this->filterByDiscountAmountFullAggregation($discountAmountFullAggregation, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $discountAmountFullAggregations Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDiscountAmountFullAggregation_In(array $discountAmountFullAggregations)
    {
        return $this->filterByDiscountAmountFullAggregation($discountAmountFullAggregations, Criteria::IN);
    }

    /**
     * Filter the query on the discount_amount_full_aggregation column
     *
     * Example usage:
     * <code>
     * $query->filterByDiscountAmountFullAggregation(1234); // WHERE discount_amount_full_aggregation = 1234
     * $query->filterByDiscountAmountFullAggregation(array(12, 34), Criteria::IN); // WHERE discount_amount_full_aggregation IN (12, 34)
     * $query->filterByDiscountAmountFullAggregation(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE discount_amount_full_aggregation > 12
     * </code>
     *
     * @param     mixed $discountAmountFullAggregation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByDiscountAmountFullAggregation($discountAmountFullAggregation = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($discountAmountFullAggregation)) {
            $useMinMax = false;
            if (isset($discountAmountFullAggregation['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_DISCOUNT_AMOUNT_FULL_AGGREGATION, $discountAmountFullAggregation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($discountAmountFullAggregation['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_DISCOUNT_AMOUNT_FULL_AGGREGATION, $discountAmountFullAggregation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$discountAmountFullAggregation of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_DISCOUNT_AMOUNT_FULL_AGGREGATION, $discountAmountFullAggregation, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $expensePriceAggregation Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpensePriceAggregation_Between(array $expensePriceAggregation)
    {
        return $this->filterByExpensePriceAggregation($expensePriceAggregation, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $expensePriceAggregations Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpensePriceAggregation_In(array $expensePriceAggregations)
    {
        return $this->filterByExpensePriceAggregation($expensePriceAggregations, Criteria::IN);
    }

    /**
     * Filter the query on the expense_price_aggregation column
     *
     * Example usage:
     * <code>
     * $query->filterByExpensePriceAggregation(1234); // WHERE expense_price_aggregation = 1234
     * $query->filterByExpensePriceAggregation(array(12, 34), Criteria::IN); // WHERE expense_price_aggregation IN (12, 34)
     * $query->filterByExpensePriceAggregation(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE expense_price_aggregation > 12
     * </code>
     *
     * @param     mixed $expensePriceAggregation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByExpensePriceAggregation($expensePriceAggregation = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($expensePriceAggregation)) {
            $useMinMax = false;
            if (isset($expensePriceAggregation['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_EXPENSE_PRICE_AGGREGATION, $expensePriceAggregation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expensePriceAggregation['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_EXPENSE_PRICE_AGGREGATION, $expensePriceAggregation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$expensePriceAggregation of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_EXPENSE_PRICE_AGGREGATION, $expensePriceAggregation, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $grossPrice Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGrossPrice_Between(array $grossPrice)
    {
        return $this->filterByGrossPrice($grossPrice, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $grossPrices Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGrossPrice_In(array $grossPrices)
    {
        return $this->filterByGrossPrice($grossPrices, Criteria::IN);
    }

    /**
     * Filter the query on the gross_price column
     *
     * Example usage:
     * <code>
     * $query->filterByGrossPrice(1234); // WHERE gross_price = 1234
     * $query->filterByGrossPrice(array(12, 34), Criteria::IN); // WHERE gross_price IN (12, 34)
     * $query->filterByGrossPrice(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE gross_price > 12
     * </code>
     *
     * @param     mixed $grossPrice The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByGrossPrice($grossPrice = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($grossPrice)) {
            $useMinMax = false;
            if (isset($grossPrice['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_GROSS_PRICE, $grossPrice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($grossPrice['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_GROSS_PRICE, $grossPrice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$grossPrice of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_GROSS_PRICE, $grossPrice, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $groupKeys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGroupKey_In(array $groupKeys)
    {
        return $this->filterByGroupKey($groupKeys, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $groupKey Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGroupKey_Like($groupKey)
    {
        return $this->filterByGroupKey($groupKey, Criteria::LIKE);
    }

    /**
     * Filter the query on the group_key column
     *
     * Example usage:
     * <code>
     * $query->filterByGroupKey('fooValue');   // WHERE group_key = 'fooValue'
     * $query->filterByGroupKey('%fooValue%', Criteria::LIKE); // WHERE group_key LIKE '%fooValue%'
     * $query->filterByGroupKey([1, 'foo'], Criteria::IN); // WHERE group_key IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $groupKey The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByGroupKey($groupKey = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $groupKey = str_replace('*', '%', $groupKey);
        }

        if (is_array($groupKey) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$groupKey of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_GROUP_KEY, $groupKey, $comparison);

        return $query;
    }

    /**
     * Filter the query on the is_quantity_splittable column
     *
     * Example usage:
     * <code>
     * $query->filterByIsQuantitySplittable(true); // WHERE is_quantity_splittable = true
     * $query->filterByIsQuantitySplittable('yes'); // WHERE is_quantity_splittable = true
     * </code>
     *
     * @param     bool|string $isQuantitySplittable The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIsQuantitySplittable($isQuantitySplittable = null, $comparison = Criteria::EQUAL)
    {
        if (is_string($isQuantitySplittable)) {
            $isQuantitySplittable = in_array(strtolower($isQuantitySplittable), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_IS_QUANTITY_SPLITTABLE, $isQuantitySplittable, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $lastStateChange Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLastStateChange_Between(array $lastStateChange)
    {
        return $this->filterByLastStateChange($lastStateChange, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $lastStateChanges Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLastStateChange_In(array $lastStateChanges)
    {
        return $this->filterByLastStateChange($lastStateChanges, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $lastStateChange Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLastStateChange_Like($lastStateChange)
    {
        return $this->filterByLastStateChange($lastStateChange, Criteria::LIKE);
    }

    /**
     * Filter the query on the last_state_change column
     *
     * Example usage:
     * <code>
     * $query->filterByLastStateChange('2011-03-14'); // WHERE last_state_change = '2011-03-14'
     * $query->filterByLastStateChange('now'); // WHERE last_state_change = '2011-03-14'
     * $query->filterByLastStateChange(array('max' => 'yesterday'), SprykerCriteria::BETWEEN); // WHERE last_state_change > '2011-03-13'
     * </code>
     *
     * @param     mixed $lastStateChange The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByLastStateChange($lastStateChange = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($lastStateChange)) {
            $useMinMax = false;
            if (isset($lastStateChange['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_LAST_STATE_CHANGE, $lastStateChange['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastStateChange['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_LAST_STATE_CHANGE, $lastStateChange['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$lastStateChange of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_LAST_STATE_CHANGE, $lastStateChange, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $merchantCommissionAmountAggregation Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMerchantCommissionAmountAggregation_Between(array $merchantCommissionAmountAggregation)
    {
        return $this->filterByMerchantCommissionAmountAggregation($merchantCommissionAmountAggregation, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $merchantCommissionAmountAggregations Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMerchantCommissionAmountAggregation_In(array $merchantCommissionAmountAggregations)
    {
        return $this->filterByMerchantCommissionAmountAggregation($merchantCommissionAmountAggregations, Criteria::IN);
    }

    /**
     * Filter the query on the merchant_commission_amount_aggregation column
     *
     * Example usage:
     * <code>
     * $query->filterByMerchantCommissionAmountAggregation(1234); // WHERE merchant_commission_amount_aggregation = 1234
     * $query->filterByMerchantCommissionAmountAggregation(array(12, 34), Criteria::IN); // WHERE merchant_commission_amount_aggregation IN (12, 34)
     * $query->filterByMerchantCommissionAmountAggregation(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE merchant_commission_amount_aggregation > 12
     * </code>
     *
     * @param     mixed $merchantCommissionAmountAggregation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByMerchantCommissionAmountAggregation($merchantCommissionAmountAggregation = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($merchantCommissionAmountAggregation)) {
            $useMinMax = false;
            if (isset($merchantCommissionAmountAggregation['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_MERCHANT_COMMISSION_AMOUNT_AGGREGATION, $merchantCommissionAmountAggregation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($merchantCommissionAmountAggregation['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_MERCHANT_COMMISSION_AMOUNT_AGGREGATION, $merchantCommissionAmountAggregation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$merchantCommissionAmountAggregation of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_MERCHANT_COMMISSION_AMOUNT_AGGREGATION, $merchantCommissionAmountAggregation, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $merchantCommissionAmountFullAggregation Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMerchantCommissionAmountFullAggregation_Between(array $merchantCommissionAmountFullAggregation)
    {
        return $this->filterByMerchantCommissionAmountFullAggregation($merchantCommissionAmountFullAggregation, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $merchantCommissionAmountFullAggregations Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMerchantCommissionAmountFullAggregation_In(array $merchantCommissionAmountFullAggregations)
    {
        return $this->filterByMerchantCommissionAmountFullAggregation($merchantCommissionAmountFullAggregations, Criteria::IN);
    }

    /**
     * Filter the query on the merchant_commission_amount_full_aggregation column
     *
     * Example usage:
     * <code>
     * $query->filterByMerchantCommissionAmountFullAggregation(1234); // WHERE merchant_commission_amount_full_aggregation = 1234
     * $query->filterByMerchantCommissionAmountFullAggregation(array(12, 34), Criteria::IN); // WHERE merchant_commission_amount_full_aggregation IN (12, 34)
     * $query->filterByMerchantCommissionAmountFullAggregation(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE merchant_commission_amount_full_aggregation > 12
     * </code>
     *
     * @param     mixed $merchantCommissionAmountFullAggregation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByMerchantCommissionAmountFullAggregation($merchantCommissionAmountFullAggregation = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($merchantCommissionAmountFullAggregation)) {
            $useMinMax = false;
            if (isset($merchantCommissionAmountFullAggregation['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_MERCHANT_COMMISSION_AMOUNT_FULL_AGGREGATION, $merchantCommissionAmountFullAggregation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($merchantCommissionAmountFullAggregation['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_MERCHANT_COMMISSION_AMOUNT_FULL_AGGREGATION, $merchantCommissionAmountFullAggregation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$merchantCommissionAmountFullAggregation of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_MERCHANT_COMMISSION_AMOUNT_FULL_AGGREGATION, $merchantCommissionAmountFullAggregation, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $merchantCommissionRefundedAmount Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMerchantCommissionRefundedAmount_Between(array $merchantCommissionRefundedAmount)
    {
        return $this->filterByMerchantCommissionRefundedAmount($merchantCommissionRefundedAmount, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $merchantCommissionRefundedAmounts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMerchantCommissionRefundedAmount_In(array $merchantCommissionRefundedAmounts)
    {
        return $this->filterByMerchantCommissionRefundedAmount($merchantCommissionRefundedAmounts, Criteria::IN);
    }

    /**
     * Filter the query on the merchant_commission_refunded_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByMerchantCommissionRefundedAmount(1234); // WHERE merchant_commission_refunded_amount = 1234
     * $query->filterByMerchantCommissionRefundedAmount(array(12, 34), Criteria::IN); // WHERE merchant_commission_refunded_amount IN (12, 34)
     * $query->filterByMerchantCommissionRefundedAmount(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE merchant_commission_refunded_amount > 12
     * </code>
     *
     * @param     mixed $merchantCommissionRefundedAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByMerchantCommissionRefundedAmount($merchantCommissionRefundedAmount = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($merchantCommissionRefundedAmount)) {
            $useMinMax = false;
            if (isset($merchantCommissionRefundedAmount['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_MERCHANT_COMMISSION_REFUNDED_AMOUNT, $merchantCommissionRefundedAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($merchantCommissionRefundedAmount['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_MERCHANT_COMMISSION_REFUNDED_AMOUNT, $merchantCommissionRefundedAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$merchantCommissionRefundedAmount of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_MERCHANT_COMMISSION_REFUNDED_AMOUNT, $merchantCommissionRefundedAmount, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $merchantReferences Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMerchantReference_In(array $merchantReferences)
    {
        return $this->filterByMerchantReference($merchantReferences, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $merchantReference Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMerchantReference_Like($merchantReference)
    {
        return $this->filterByMerchantReference($merchantReference, Criteria::LIKE);
    }

    /**
     * Filter the query on the merchant_reference column
     *
     * Example usage:
     * <code>
     * $query->filterByMerchantReference('fooValue');   // WHERE merchant_reference = 'fooValue'
     * $query->filterByMerchantReference('%fooValue%', Criteria::LIKE); // WHERE merchant_reference LIKE '%fooValue%'
     * $query->filterByMerchantReference([1, 'foo'], Criteria::IN); // WHERE merchant_reference IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $merchantReference The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByMerchantReference($merchantReference = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $merchantReference = str_replace('*', '%', $merchantReference);
        }

        if (is_array($merchantReference) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$merchantReference of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_MERCHANT_REFERENCE, $merchantReference, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $names Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByName_In(array $names)
    {
        return $this->filterByName($names, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $name Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByName_Like($name)
    {
        return $this->filterByName($name, Criteria::LIKE);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * $query->filterByName([1, 'foo'], Criteria::IN); // WHERE name IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByName($name = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $name = str_replace('*', '%', $name);
        }

        if (is_array($name) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$name of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_NAME, $name, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $netPrice Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNetPrice_Between(array $netPrice)
    {
        return $this->filterByNetPrice($netPrice, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $netPrices Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNetPrice_In(array $netPrices)
    {
        return $this->filterByNetPrice($netPrices, Criteria::IN);
    }

    /**
     * Filter the query on the net_price column
     *
     * Example usage:
     * <code>
     * $query->filterByNetPrice(1234); // WHERE net_price = 1234
     * $query->filterByNetPrice(array(12, 34), Criteria::IN); // WHERE net_price IN (12, 34)
     * $query->filterByNetPrice(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE net_price > 12
     * </code>
     *
     * @param     mixed $netPrice The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByNetPrice($netPrice = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($netPrice)) {
            $useMinMax = false;
            if (isset($netPrice['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_NET_PRICE, $netPrice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($netPrice['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_NET_PRICE, $netPrice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$netPrice of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_NET_PRICE, $netPrice, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $orderItemReferences Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderItemReference_In(array $orderItemReferences)
    {
        return $this->filterByOrderItemReference($orderItemReferences, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $orderItemReference Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderItemReference_Like($orderItemReference)
    {
        return $this->filterByOrderItemReference($orderItemReference, Criteria::LIKE);
    }

    /**
     * Filter the query on the order_item_reference column
     *
     * Example usage:
     * <code>
     * $query->filterByOrderItemReference('fooValue');   // WHERE order_item_reference = 'fooValue'
     * $query->filterByOrderItemReference('%fooValue%', Criteria::LIKE); // WHERE order_item_reference LIKE '%fooValue%'
     * $query->filterByOrderItemReference([1, 'foo'], Criteria::IN); // WHERE order_item_reference IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $orderItemReference The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByOrderItemReference($orderItemReference = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $orderItemReference = str_replace('*', '%', $orderItemReference);
        }

        if (is_array($orderItemReference) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$orderItemReference of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_ORDER_ITEM_REFERENCE, $orderItemReference, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $price Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrice_Between(array $price)
    {
        return $this->filterByPrice($price, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $prices Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrice_In(array $prices)
    {
        return $this->filterByPrice($prices, Criteria::IN);
    }

    /**
     * Filter the query on the price column
     *
     * Example usage:
     * <code>
     * $query->filterByPrice(1234); // WHERE price = 1234
     * $query->filterByPrice(array(12, 34), Criteria::IN); // WHERE price IN (12, 34)
     * $query->filterByPrice(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE price > 12
     * </code>
     *
     * @param     mixed $price The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByPrice($price = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($price)) {
            $useMinMax = false;
            if (isset($price['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$price of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_PRICE, $price, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $priceToPayAggregation Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPriceToPayAggregation_Between(array $priceToPayAggregation)
    {
        return $this->filterByPriceToPayAggregation($priceToPayAggregation, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $priceToPayAggregations Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPriceToPayAggregation_In(array $priceToPayAggregations)
    {
        return $this->filterByPriceToPayAggregation($priceToPayAggregations, Criteria::IN);
    }

    /**
     * Filter the query on the price_to_pay_aggregation column
     *
     * Example usage:
     * <code>
     * $query->filterByPriceToPayAggregation(1234); // WHERE price_to_pay_aggregation = 1234
     * $query->filterByPriceToPayAggregation(array(12, 34), Criteria::IN); // WHERE price_to_pay_aggregation IN (12, 34)
     * $query->filterByPriceToPayAggregation(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE price_to_pay_aggregation > 12
     * </code>
     *
     * @param     mixed $priceToPayAggregation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByPriceToPayAggregation($priceToPayAggregation = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($priceToPayAggregation)) {
            $useMinMax = false;
            if (isset($priceToPayAggregation['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_PRICE_TO_PAY_AGGREGATION, $priceToPayAggregation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($priceToPayAggregation['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_PRICE_TO_PAY_AGGREGATION, $priceToPayAggregation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$priceToPayAggregation of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_PRICE_TO_PAY_AGGREGATION, $priceToPayAggregation, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $productOfferReferences Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductOfferReference_In(array $productOfferReferences)
    {
        return $this->filterByProductOfferReference($productOfferReferences, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $productOfferReference Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductOfferReference_Like($productOfferReference)
    {
        return $this->filterByProductOfferReference($productOfferReference, Criteria::LIKE);
    }

    /**
     * Filter the query on the product_offer_reference column
     *
     * Example usage:
     * <code>
     * $query->filterByProductOfferReference('fooValue');   // WHERE product_offer_reference = 'fooValue'
     * $query->filterByProductOfferReference('%fooValue%', Criteria::LIKE); // WHERE product_offer_reference LIKE '%fooValue%'
     * $query->filterByProductOfferReference([1, 'foo'], Criteria::IN); // WHERE product_offer_reference IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $productOfferReference The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByProductOfferReference($productOfferReference = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $productOfferReference = str_replace('*', '%', $productOfferReference);
        }

        if (is_array($productOfferReference) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$productOfferReference of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_PRODUCT_OFFER_REFERENCE, $productOfferReference, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $productOptionPriceAggregation Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductOptionPriceAggregation_Between(array $productOptionPriceAggregation)
    {
        return $this->filterByProductOptionPriceAggregation($productOptionPriceAggregation, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $productOptionPriceAggregations Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductOptionPriceAggregation_In(array $productOptionPriceAggregations)
    {
        return $this->filterByProductOptionPriceAggregation($productOptionPriceAggregations, Criteria::IN);
    }

    /**
     * Filter the query on the product_option_price_aggregation column
     *
     * Example usage:
     * <code>
     * $query->filterByProductOptionPriceAggregation(1234); // WHERE product_option_price_aggregation = 1234
     * $query->filterByProductOptionPriceAggregation(array(12, 34), Criteria::IN); // WHERE product_option_price_aggregation IN (12, 34)
     * $query->filterByProductOptionPriceAggregation(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE product_option_price_aggregation > 12
     * </code>
     *
     * @param     mixed $productOptionPriceAggregation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByProductOptionPriceAggregation($productOptionPriceAggregation = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($productOptionPriceAggregation)) {
            $useMinMax = false;
            if (isset($productOptionPriceAggregation['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_PRODUCT_OPTION_PRICE_AGGREGATION, $productOptionPriceAggregation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productOptionPriceAggregation['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_PRODUCT_OPTION_PRICE_AGGREGATION, $productOptionPriceAggregation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$productOptionPriceAggregation of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_PRODUCT_OPTION_PRICE_AGGREGATION, $productOptionPriceAggregation, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $quantity Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByQuantity_Between(array $quantity)
    {
        return $this->filterByQuantity($quantity, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $quantitys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByQuantity_In(array $quantitys)
    {
        return $this->filterByQuantity($quantitys, Criteria::IN);
    }

    /**
     * Filter the query on the quantity column
     *
     * Example usage:
     * <code>
     * $query->filterByQuantity(1234); // WHERE quantity = 1234
     * $query->filterByQuantity(array(12, 34), Criteria::IN); // WHERE quantity IN (12, 34)
     * $query->filterByQuantity(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE quantity > 12
     * </code>
     *
     * @param     mixed $quantity The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByQuantity($quantity = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($quantity)) {
            $useMinMax = false;
            if (isset($quantity['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_QUANTITY, $quantity['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($quantity['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_QUANTITY, $quantity['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$quantity of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_QUANTITY, $quantity, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $quantityBaseMeasurementUnitNames Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByQuantityBaseMeasurementUnitName_In(array $quantityBaseMeasurementUnitNames)
    {
        return $this->filterByQuantityBaseMeasurementUnitName($quantityBaseMeasurementUnitNames, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $quantityBaseMeasurementUnitName Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByQuantityBaseMeasurementUnitName_Like($quantityBaseMeasurementUnitName)
    {
        return $this->filterByQuantityBaseMeasurementUnitName($quantityBaseMeasurementUnitName, Criteria::LIKE);
    }

    /**
     * Filter the query on the quantity_base_measurement_unit_name column
     *
     * Example usage:
     * <code>
     * $query->filterByQuantityBaseMeasurementUnitName('fooValue');   // WHERE quantity_base_measurement_unit_name = 'fooValue'
     * $query->filterByQuantityBaseMeasurementUnitName('%fooValue%', Criteria::LIKE); // WHERE quantity_base_measurement_unit_name LIKE '%fooValue%'
     * $query->filterByQuantityBaseMeasurementUnitName([1, 'foo'], Criteria::IN); // WHERE quantity_base_measurement_unit_name IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $quantityBaseMeasurementUnitName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByQuantityBaseMeasurementUnitName($quantityBaseMeasurementUnitName = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $quantityBaseMeasurementUnitName = str_replace('*', '%', $quantityBaseMeasurementUnitName);
        }

        if (is_array($quantityBaseMeasurementUnitName) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$quantityBaseMeasurementUnitName of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_QUANTITY_BASE_MEASUREMENT_UNIT_NAME, $quantityBaseMeasurementUnitName, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $quantityMeasurementUnitCodes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByQuantityMeasurementUnitCode_In(array $quantityMeasurementUnitCodes)
    {
        return $this->filterByQuantityMeasurementUnitCode($quantityMeasurementUnitCodes, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $quantityMeasurementUnitCode Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByQuantityMeasurementUnitCode_Like($quantityMeasurementUnitCode)
    {
        return $this->filterByQuantityMeasurementUnitCode($quantityMeasurementUnitCode, Criteria::LIKE);
    }

    /**
     * Filter the query on the quantity_measurement_unit_code column
     *
     * Example usage:
     * <code>
     * $query->filterByQuantityMeasurementUnitCode('fooValue');   // WHERE quantity_measurement_unit_code = 'fooValue'
     * $query->filterByQuantityMeasurementUnitCode('%fooValue%', Criteria::LIKE); // WHERE quantity_measurement_unit_code LIKE '%fooValue%'
     * $query->filterByQuantityMeasurementUnitCode([1, 'foo'], Criteria::IN); // WHERE quantity_measurement_unit_code IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $quantityMeasurementUnitCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByQuantityMeasurementUnitCode($quantityMeasurementUnitCode = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $quantityMeasurementUnitCode = str_replace('*', '%', $quantityMeasurementUnitCode);
        }

        if (is_array($quantityMeasurementUnitCode) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$quantityMeasurementUnitCode of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_QUANTITY_MEASUREMENT_UNIT_CODE, $quantityMeasurementUnitCode, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $quantityMeasurementUnitConversion Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByQuantityMeasurementUnitConversion_Between(array $quantityMeasurementUnitConversion)
    {
        return $this->filterByQuantityMeasurementUnitConversion($quantityMeasurementUnitConversion, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $quantityMeasurementUnitConversions Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByQuantityMeasurementUnitConversion_In(array $quantityMeasurementUnitConversions)
    {
        return $this->filterByQuantityMeasurementUnitConversion($quantityMeasurementUnitConversions, Criteria::IN);
    }

    /**
     * Filter the query on the quantity_measurement_unit_conversion column
     *
     * Example usage:
     * <code>
     * $query->filterByQuantityMeasurementUnitConversion(1234); // WHERE quantity_measurement_unit_conversion = 1234
     * $query->filterByQuantityMeasurementUnitConversion(array(12, 34), Criteria::IN); // WHERE quantity_measurement_unit_conversion IN (12, 34)
     * $query->filterByQuantityMeasurementUnitConversion(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE quantity_measurement_unit_conversion > 12
     * </code>
     *
     * @param     mixed $quantityMeasurementUnitConversion The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByQuantityMeasurementUnitConversion($quantityMeasurementUnitConversion = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($quantityMeasurementUnitConversion)) {
            $useMinMax = false;
            if (isset($quantityMeasurementUnitConversion['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_QUANTITY_MEASUREMENT_UNIT_CONVERSION, $quantityMeasurementUnitConversion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($quantityMeasurementUnitConversion['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_QUANTITY_MEASUREMENT_UNIT_CONVERSION, $quantityMeasurementUnitConversion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$quantityMeasurementUnitConversion of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_QUANTITY_MEASUREMENT_UNIT_CONVERSION, $quantityMeasurementUnitConversion, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $quantityMeasurementUnitNames Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByQuantityMeasurementUnitName_In(array $quantityMeasurementUnitNames)
    {
        return $this->filterByQuantityMeasurementUnitName($quantityMeasurementUnitNames, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $quantityMeasurementUnitName Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByQuantityMeasurementUnitName_Like($quantityMeasurementUnitName)
    {
        return $this->filterByQuantityMeasurementUnitName($quantityMeasurementUnitName, Criteria::LIKE);
    }

    /**
     * Filter the query on the quantity_measurement_unit_name column
     *
     * Example usage:
     * <code>
     * $query->filterByQuantityMeasurementUnitName('fooValue');   // WHERE quantity_measurement_unit_name = 'fooValue'
     * $query->filterByQuantityMeasurementUnitName('%fooValue%', Criteria::LIKE); // WHERE quantity_measurement_unit_name LIKE '%fooValue%'
     * $query->filterByQuantityMeasurementUnitName([1, 'foo'], Criteria::IN); // WHERE quantity_measurement_unit_name IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $quantityMeasurementUnitName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByQuantityMeasurementUnitName($quantityMeasurementUnitName = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $quantityMeasurementUnitName = str_replace('*', '%', $quantityMeasurementUnitName);
        }

        if (is_array($quantityMeasurementUnitName) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$quantityMeasurementUnitName of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_QUANTITY_MEASUREMENT_UNIT_NAME, $quantityMeasurementUnitName, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $quantityMeasurementUnitPrecision Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByQuantityMeasurementUnitPrecision_Between(array $quantityMeasurementUnitPrecision)
    {
        return $this->filterByQuantityMeasurementUnitPrecision($quantityMeasurementUnitPrecision, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $quantityMeasurementUnitPrecisions Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByQuantityMeasurementUnitPrecision_In(array $quantityMeasurementUnitPrecisions)
    {
        return $this->filterByQuantityMeasurementUnitPrecision($quantityMeasurementUnitPrecisions, Criteria::IN);
    }

    /**
     * Filter the query on the quantity_measurement_unit_precision column
     *
     * Example usage:
     * <code>
     * $query->filterByQuantityMeasurementUnitPrecision(1234); // WHERE quantity_measurement_unit_precision = 1234
     * $query->filterByQuantityMeasurementUnitPrecision(array(12, 34), Criteria::IN); // WHERE quantity_measurement_unit_precision IN (12, 34)
     * $query->filterByQuantityMeasurementUnitPrecision(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE quantity_measurement_unit_precision > 12
     * </code>
     *
     * @param     mixed $quantityMeasurementUnitPrecision The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByQuantityMeasurementUnitPrecision($quantityMeasurementUnitPrecision = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($quantityMeasurementUnitPrecision)) {
            $useMinMax = false;
            if (isset($quantityMeasurementUnitPrecision['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_QUANTITY_MEASUREMENT_UNIT_PRECISION, $quantityMeasurementUnitPrecision['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($quantityMeasurementUnitPrecision['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_QUANTITY_MEASUREMENT_UNIT_PRECISION, $quantityMeasurementUnitPrecision['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$quantityMeasurementUnitPrecision of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_QUANTITY_MEASUREMENT_UNIT_PRECISION, $quantityMeasurementUnitPrecision, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $refundableAmount Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRefundableAmount_Between(array $refundableAmount)
    {
        return $this->filterByRefundableAmount($refundableAmount, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $refundableAmounts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRefundableAmount_In(array $refundableAmounts)
    {
        return $this->filterByRefundableAmount($refundableAmounts, Criteria::IN);
    }

    /**
     * Filter the query on the refundable_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByRefundableAmount(1234); // WHERE refundable_amount = 1234
     * $query->filterByRefundableAmount(array(12, 34), Criteria::IN); // WHERE refundable_amount IN (12, 34)
     * $query->filterByRefundableAmount(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE refundable_amount > 12
     * </code>
     *
     * @param     mixed $refundableAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByRefundableAmount($refundableAmount = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($refundableAmount)) {
            $useMinMax = false;
            if (isset($refundableAmount['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_REFUNDABLE_AMOUNT, $refundableAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($refundableAmount['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_REFUNDABLE_AMOUNT, $refundableAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$refundableAmount of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_REFUNDABLE_AMOUNT, $refundableAmount, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $remunerationAmount Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRemunerationAmount_Between(array $remunerationAmount)
    {
        return $this->filterByRemunerationAmount($remunerationAmount, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $remunerationAmounts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRemunerationAmount_In(array $remunerationAmounts)
    {
        return $this->filterByRemunerationAmount($remunerationAmounts, Criteria::IN);
    }

    /**
     * Filter the query on the remuneration_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByRemunerationAmount(1234); // WHERE remuneration_amount = 1234
     * $query->filterByRemunerationAmount(array(12, 34), Criteria::IN); // WHERE remuneration_amount IN (12, 34)
     * $query->filterByRemunerationAmount(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE remuneration_amount > 12
     * </code>
     *
     * @param     mixed $remunerationAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByRemunerationAmount($remunerationAmount = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($remunerationAmount)) {
            $useMinMax = false;
            if (isset($remunerationAmount['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_REMUNERATION_AMOUNT, $remunerationAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($remunerationAmount['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_REMUNERATION_AMOUNT, $remunerationAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$remunerationAmount of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_REMUNERATION_AMOUNT, $remunerationAmount, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $skus Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySku_In(array $skus)
    {
        return $this->filterBySku($skus, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $sku Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySku_Like($sku)
    {
        return $this->filterBySku($sku, Criteria::LIKE);
    }

    /**
     * Filter the query on the sku column
     *
     * Example usage:
     * <code>
     * $query->filterBySku('fooValue');   // WHERE sku = 'fooValue'
     * $query->filterBySku('%fooValue%', Criteria::LIKE); // WHERE sku LIKE '%fooValue%'
     * $query->filterBySku([1, 'foo'], Criteria::IN); // WHERE sku IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $sku The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterBySku($sku = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $sku = str_replace('*', '%', $sku);
        }

        if (is_array($sku) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$sku of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_SKU, $sku, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $subtotalAggregation Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySubtotalAggregation_Between(array $subtotalAggregation)
    {
        return $this->filterBySubtotalAggregation($subtotalAggregation, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $subtotalAggregations Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySubtotalAggregation_In(array $subtotalAggregations)
    {
        return $this->filterBySubtotalAggregation($subtotalAggregations, Criteria::IN);
    }

    /**
     * Filter the query on the subtotal_aggregation column
     *
     * Example usage:
     * <code>
     * $query->filterBySubtotalAggregation(1234); // WHERE subtotal_aggregation = 1234
     * $query->filterBySubtotalAggregation(array(12, 34), Criteria::IN); // WHERE subtotal_aggregation IN (12, 34)
     * $query->filterBySubtotalAggregation(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE subtotal_aggregation > 12
     * </code>
     *
     * @param     mixed $subtotalAggregation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterBySubtotalAggregation($subtotalAggregation = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($subtotalAggregation)) {
            $useMinMax = false;
            if (isset($subtotalAggregation['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_SUBTOTAL_AGGREGATION, $subtotalAggregation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($subtotalAggregation['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_SUBTOTAL_AGGREGATION, $subtotalAggregation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$subtotalAggregation of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_SUBTOTAL_AGGREGATION, $subtotalAggregation, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $taxAmount Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTaxAmount_Between(array $taxAmount)
    {
        return $this->filterByTaxAmount($taxAmount, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $taxAmounts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTaxAmount_In(array $taxAmounts)
    {
        return $this->filterByTaxAmount($taxAmounts, Criteria::IN);
    }

    /**
     * Filter the query on the tax_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByTaxAmount(1234); // WHERE tax_amount = 1234
     * $query->filterByTaxAmount(array(12, 34), Criteria::IN); // WHERE tax_amount IN (12, 34)
     * $query->filterByTaxAmount(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE tax_amount > 12
     * </code>
     *
     * @param     mixed $taxAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByTaxAmount($taxAmount = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($taxAmount)) {
            $useMinMax = false;
            if (isset($taxAmount['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_TAX_AMOUNT, $taxAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($taxAmount['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_TAX_AMOUNT, $taxAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$taxAmount of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_TAX_AMOUNT, $taxAmount, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $taxAmountAfterCancellation Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTaxAmountAfterCancellation_Between(array $taxAmountAfterCancellation)
    {
        return $this->filterByTaxAmountAfterCancellation($taxAmountAfterCancellation, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $taxAmountAfterCancellations Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTaxAmountAfterCancellation_In(array $taxAmountAfterCancellations)
    {
        return $this->filterByTaxAmountAfterCancellation($taxAmountAfterCancellations, Criteria::IN);
    }

    /**
     * Filter the query on the tax_amount_after_cancellation column
     *
     * Example usage:
     * <code>
     * $query->filterByTaxAmountAfterCancellation(1234); // WHERE tax_amount_after_cancellation = 1234
     * $query->filterByTaxAmountAfterCancellation(array(12, 34), Criteria::IN); // WHERE tax_amount_after_cancellation IN (12, 34)
     * $query->filterByTaxAmountAfterCancellation(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE tax_amount_after_cancellation > 12
     * </code>
     *
     * @param     mixed $taxAmountAfterCancellation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByTaxAmountAfterCancellation($taxAmountAfterCancellation = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($taxAmountAfterCancellation)) {
            $useMinMax = false;
            if (isset($taxAmountAfterCancellation['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_TAX_AMOUNT_AFTER_CANCELLATION, $taxAmountAfterCancellation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($taxAmountAfterCancellation['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_TAX_AMOUNT_AFTER_CANCELLATION, $taxAmountAfterCancellation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$taxAmountAfterCancellation of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_TAX_AMOUNT_AFTER_CANCELLATION, $taxAmountAfterCancellation, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $taxAmountFullAggregation Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTaxAmountFullAggregation_Between(array $taxAmountFullAggregation)
    {
        return $this->filterByTaxAmountFullAggregation($taxAmountFullAggregation, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $taxAmountFullAggregations Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTaxAmountFullAggregation_In(array $taxAmountFullAggregations)
    {
        return $this->filterByTaxAmountFullAggregation($taxAmountFullAggregations, Criteria::IN);
    }

    /**
     * Filter the query on the tax_amount_full_aggregation column
     *
     * Example usage:
     * <code>
     * $query->filterByTaxAmountFullAggregation(1234); // WHERE tax_amount_full_aggregation = 1234
     * $query->filterByTaxAmountFullAggregation(array(12, 34), Criteria::IN); // WHERE tax_amount_full_aggregation IN (12, 34)
     * $query->filterByTaxAmountFullAggregation(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE tax_amount_full_aggregation > 12
     * </code>
     *
     * @param     mixed $taxAmountFullAggregation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByTaxAmountFullAggregation($taxAmountFullAggregation = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($taxAmountFullAggregation)) {
            $useMinMax = false;
            if (isset($taxAmountFullAggregation['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_TAX_AMOUNT_FULL_AGGREGATION, $taxAmountFullAggregation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($taxAmountFullAggregation['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_TAX_AMOUNT_FULL_AGGREGATION, $taxAmountFullAggregation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$taxAmountFullAggregation of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_TAX_AMOUNT_FULL_AGGREGATION, $taxAmountFullAggregation, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $taxRate Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTaxRate_Between(array $taxRate)
    {
        return $this->filterByTaxRate($taxRate, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $taxRates Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTaxRate_In(array $taxRates)
    {
        return $this->filterByTaxRate($taxRates, Criteria::IN);
    }

    /**
     * Filter the query on the tax_rate column
     *
     * Example usage:
     * <code>
     * $query->filterByTaxRate(1234); // WHERE tax_rate = 1234
     * $query->filterByTaxRate(array(12, 34), Criteria::IN); // WHERE tax_rate IN (12, 34)
     * $query->filterByTaxRate(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE tax_rate > 12
     * </code>
     *
     * @param     mixed $taxRate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByTaxRate($taxRate = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($taxRate)) {
            $useMinMax = false;
            if (isset($taxRate['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_TAX_RATE, $taxRate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($taxRate['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_TAX_RATE, $taxRate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$taxRate of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_TAX_RATE, $taxRate, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $taxRateAverageAggregation Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTaxRateAverageAggregation_Between(array $taxRateAverageAggregation)
    {
        return $this->filterByTaxRateAverageAggregation($taxRateAverageAggregation, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $taxRateAverageAggregations Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTaxRateAverageAggregation_In(array $taxRateAverageAggregations)
    {
        return $this->filterByTaxRateAverageAggregation($taxRateAverageAggregations, Criteria::IN);
    }

    /**
     * Filter the query on the tax_rate_average_aggregation column
     *
     * Example usage:
     * <code>
     * $query->filterByTaxRateAverageAggregation(1234); // WHERE tax_rate_average_aggregation = 1234
     * $query->filterByTaxRateAverageAggregation(array(12, 34), Criteria::IN); // WHERE tax_rate_average_aggregation IN (12, 34)
     * $query->filterByTaxRateAverageAggregation(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE tax_rate_average_aggregation > 12
     * </code>
     *
     * @param     mixed $taxRateAverageAggregation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByTaxRateAverageAggregation($taxRateAverageAggregation = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($taxRateAverageAggregation)) {
            $useMinMax = false;
            if (isset($taxRateAverageAggregation['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_TAX_RATE_AVERAGE_AGGREGATION, $taxRateAverageAggregation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($taxRateAverageAggregation['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_TAX_RATE_AVERAGE_AGGREGATION, $taxRateAverageAggregation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$taxRateAverageAggregation of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_TAX_RATE_AVERAGE_AGGREGATION, $taxRateAverageAggregation, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $uuids Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUuid_In(array $uuids)
    {
        return $this->filterByUuid($uuids, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $uuid Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUuid_Like($uuid)
    {
        return $this->filterByUuid($uuid, Criteria::LIKE);
    }

    /**
     * Filter the query on the uuid column
     *
     * Example usage:
     * <code>
     * $query->filterByUuid('fooValue');   // WHERE uuid = 'fooValue'
     * $query->filterByUuid('%fooValue%', Criteria::LIKE); // WHERE uuid LIKE '%fooValue%'
     * $query->filterByUuid([1, 'foo'], Criteria::IN); // WHERE uuid IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $uuid The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByUuid($uuid = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $uuid = str_replace('*', '%', $uuid);
        }

        if (is_array($uuid) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$uuid of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_UUID, $uuid, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $createdAt Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCreatedAt_Between(array $createdAt)
    {
        return $this->filterByCreatedAt($createdAt, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $createdAts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCreatedAt_In(array $createdAts)
    {
        return $this->filterByCreatedAt($createdAts, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $createdAt Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCreatedAt_Like($createdAt)
    {
        return $this->filterByCreatedAt($createdAt, Criteria::LIKE);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday'), SprykerCriteria::BETWEEN); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByCreatedAt($createdAt = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_CREATED_AT, $createdAt, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $updatedAt Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUpdatedAt_Between(array $updatedAt)
    {
        return $this->filterByUpdatedAt($updatedAt, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $updatedAts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUpdatedAt_In(array $updatedAts)
    {
        return $this->filterByUpdatedAt($updatedAts, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $updatedAt Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUpdatedAt_Like($updatedAt)
    {
        return $this->filterByUpdatedAt($updatedAt, Criteria::LIKE);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday'), SprykerCriteria::BETWEEN); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderItemTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderItemTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductBundle\Persistence\SpySalesOrderItemBundle object
     *
     * @param \Orm\Zed\ProductBundle\Persistence\SpySalesOrderItemBundle|ObjectCollection $spySalesOrderItemBundle The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySalesOrderItemBundle($spySalesOrderItemBundle, ?string $comparison = null)
    {
        if ($spySalesOrderItemBundle instanceof \Orm\Zed\ProductBundle\Persistence\SpySalesOrderItemBundle) {
            return $this
                ->addUsingAlias(SpySalesOrderItemTableMap::COL_FK_SALES_ORDER_ITEM_BUNDLE, $spySalesOrderItemBundle->getIdSalesOrderItemBundle(), $comparison);
        } elseif ($spySalesOrderItemBundle instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpySalesOrderItemTableMap::COL_FK_SALES_ORDER_ITEM_BUNDLE, $spySalesOrderItemBundle->toKeyValue('PrimaryKey', 'IdSalesOrderItemBundle'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySalesOrderItemBundle() only accepts arguments of type \Orm\Zed\ProductBundle\Persistence\SpySalesOrderItemBundle or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SalesOrderItemBundle relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSalesOrderItemBundle(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SalesOrderItemBundle');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SalesOrderItemBundle');
        }

        return $this;
    }

    /**
     * Use the SalesOrderItemBundle relation SpySalesOrderItemBundle object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductBundle\Persistence\SpySalesOrderItemBundleQuery A secondary query class using the current class as primary query
     */
    public function useSalesOrderItemBundleQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSalesOrderItemBundle($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SalesOrderItemBundle', '\Orm\Zed\ProductBundle\Persistence\SpySalesOrderItemBundleQuery');
    }

    /**
     * Use the SalesOrderItemBundle relation SpySalesOrderItemBundle object
     *
     * @param callable(\Orm\Zed\ProductBundle\Persistence\SpySalesOrderItemBundleQuery):\Orm\Zed\ProductBundle\Persistence\SpySalesOrderItemBundleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSalesOrderItemBundleQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSalesOrderItemBundleQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the SalesOrderItemBundle relation to the SpySalesOrderItemBundle table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductBundle\Persistence\SpySalesOrderItemBundleQuery The inner query object of the EXISTS statement
     */
    public function useSalesOrderItemBundleExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductBundle\Persistence\SpySalesOrderItemBundleQuery */
        $q = $this->useExistsQuery('SalesOrderItemBundle', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the SalesOrderItemBundle relation to the SpySalesOrderItemBundle table for a NOT EXISTS query.
     *
     * @see useSalesOrderItemBundleExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductBundle\Persistence\SpySalesOrderItemBundleQuery The inner query object of the NOT EXISTS statement
     */
    public function useSalesOrderItemBundleNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductBundle\Persistence\SpySalesOrderItemBundleQuery */
        $q = $this->useExistsQuery('SalesOrderItemBundle', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the SalesOrderItemBundle relation to the SpySalesOrderItemBundle table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductBundle\Persistence\SpySalesOrderItemBundleQuery The inner query object of the IN statement
     */
    public function useInSalesOrderItemBundleQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductBundle\Persistence\SpySalesOrderItemBundleQuery */
        $q = $this->useInQuery('SalesOrderItemBundle', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the SalesOrderItemBundle relation to the SpySalesOrderItemBundle table for a NOT IN query.
     *
     * @see useSalesOrderItemBundleInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductBundle\Persistence\SpySalesOrderItemBundleQuery The inner query object of the NOT IN statement
     */
    public function useNotInSalesOrderItemBundleQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductBundle\Persistence\SpySalesOrderItemBundleQuery */
        $q = $this->useInQuery('SalesOrderItemBundle', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Sales\Persistence\SpySalesOrder object
     *
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder|ObjectCollection $spySalesOrder The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrder($spySalesOrder, ?string $comparison = null)
    {
        if ($spySalesOrder instanceof \Orm\Zed\Sales\Persistence\SpySalesOrder) {
            return $this
                ->addUsingAlias(SpySalesOrderItemTableMap::COL_FK_SALES_ORDER, $spySalesOrder->getIdSalesOrder(), $comparison);
        } elseif ($spySalesOrder instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpySalesOrderItemTableMap::COL_FK_SALES_ORDER, $spySalesOrder->toKeyValue('PrimaryKey', 'IdSalesOrder'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByOrder() only accepts arguments of type \Orm\Zed\Sales\Persistence\SpySalesOrder or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Order relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOrder(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Order');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Order');
        }

        return $this;
    }

    /**
     * Use the Order relation SpySalesOrder object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderQuery A secondary query class using the current class as primary query
     */
    public function useOrderQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrder($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Order', '\Orm\Zed\Sales\Persistence\SpySalesOrderQuery');
    }

    /**
     * Use the Order relation SpySalesOrder object
     *
     * @param callable(\Orm\Zed\Sales\Persistence\SpySalesOrderQuery):\Orm\Zed\Sales\Persistence\SpySalesOrderQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrderQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOrderQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the Order relation to the SpySalesOrder table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderQuery The inner query object of the EXISTS statement
     */
    public function useOrderExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderQuery */
        $q = $this->useExistsQuery('Order', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the Order relation to the SpySalesOrder table for a NOT EXISTS query.
     *
     * @see useOrderExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrderNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderQuery */
        $q = $this->useExistsQuery('Order', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the Order relation to the SpySalesOrder table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderQuery The inner query object of the IN statement
     */
    public function useInOrderQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderQuery */
        $q = $this->useInQuery('Order', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the Order relation to the SpySalesOrder table for a NOT IN query.
     *
     * @see useOrderInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderQuery The inner query object of the NOT IN statement
     */
    public function useNotInOrderQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderQuery */
        $q = $this->useInQuery('Order', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Oms\Persistence\SpyOmsOrderItemState object
     *
     * @param \Orm\Zed\Oms\Persistence\SpyOmsOrderItemState|ObjectCollection $spyOmsOrderItemState The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByState($spyOmsOrderItemState, ?string $comparison = null)
    {
        if ($spyOmsOrderItemState instanceof \Orm\Zed\Oms\Persistence\SpyOmsOrderItemState) {
            return $this
                ->addUsingAlias(SpySalesOrderItemTableMap::COL_FK_OMS_ORDER_ITEM_STATE, $spyOmsOrderItemState->getIdOmsOrderItemState(), $comparison);
        } elseif ($spyOmsOrderItemState instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpySalesOrderItemTableMap::COL_FK_OMS_ORDER_ITEM_STATE, $spyOmsOrderItemState->toKeyValue('PrimaryKey', 'IdOmsOrderItemState'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByState() only accepts arguments of type \Orm\Zed\Oms\Persistence\SpyOmsOrderItemState or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the State relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinState(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('State');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'State');
        }

        return $this;
    }

    /**
     * Use the State relation SpyOmsOrderItemState object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateQuery A secondary query class using the current class as primary query
     */
    public function useStateQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinState($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'State', '\Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateQuery');
    }

    /**
     * Use the State relation SpyOmsOrderItemState object
     *
     * @param callable(\Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateQuery):\Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withStateQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useStateQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the State relation to the SpyOmsOrderItemState table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateQuery The inner query object of the EXISTS statement
     */
    public function useStateExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateQuery */
        $q = $this->useExistsQuery('State', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the State relation to the SpyOmsOrderItemState table for a NOT EXISTS query.
     *
     * @see useStateExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateQuery The inner query object of the NOT EXISTS statement
     */
    public function useStateNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateQuery */
        $q = $this->useExistsQuery('State', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the State relation to the SpyOmsOrderItemState table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateQuery The inner query object of the IN statement
     */
    public function useInStateQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateQuery */
        $q = $this->useInQuery('State', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the State relation to the SpyOmsOrderItemState table for a NOT IN query.
     *
     * @see useStateInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateQuery The inner query object of the NOT IN statement
     */
    public function useNotInStateQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateQuery */
        $q = $this->useInQuery('State', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Oms\Persistence\SpyOmsOrderProcess object
     *
     * @param \Orm\Zed\Oms\Persistence\SpyOmsOrderProcess|ObjectCollection $spyOmsOrderProcess The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProcess($spyOmsOrderProcess, ?string $comparison = null)
    {
        if ($spyOmsOrderProcess instanceof \Orm\Zed\Oms\Persistence\SpyOmsOrderProcess) {
            return $this
                ->addUsingAlias(SpySalesOrderItemTableMap::COL_FK_OMS_ORDER_PROCESS, $spyOmsOrderProcess->getIdOmsOrderProcess(), $comparison);
        } elseif ($spyOmsOrderProcess instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpySalesOrderItemTableMap::COL_FK_OMS_ORDER_PROCESS, $spyOmsOrderProcess->toKeyValue('PrimaryKey', 'IdOmsOrderProcess'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByProcess() only accepts arguments of type \Orm\Zed\Oms\Persistence\SpyOmsOrderProcess or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Process relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProcess(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Process');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Process');
        }

        return $this;
    }

    /**
     * Use the Process relation SpyOmsOrderProcess object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Oms\Persistence\SpyOmsOrderProcessQuery A secondary query class using the current class as primary query
     */
    public function useProcessQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinProcess($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Process', '\Orm\Zed\Oms\Persistence\SpyOmsOrderProcessQuery');
    }

    /**
     * Use the Process relation SpyOmsOrderProcess object
     *
     * @param callable(\Orm\Zed\Oms\Persistence\SpyOmsOrderProcessQuery):\Orm\Zed\Oms\Persistence\SpyOmsOrderProcessQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProcessQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useProcessQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the Process relation to the SpyOmsOrderProcess table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Oms\Persistence\SpyOmsOrderProcessQuery The inner query object of the EXISTS statement
     */
    public function useProcessExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Oms\Persistence\SpyOmsOrderProcessQuery */
        $q = $this->useExistsQuery('Process', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the Process relation to the SpyOmsOrderProcess table for a NOT EXISTS query.
     *
     * @see useProcessExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Oms\Persistence\SpyOmsOrderProcessQuery The inner query object of the NOT EXISTS statement
     */
    public function useProcessNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Oms\Persistence\SpyOmsOrderProcessQuery */
        $q = $this->useExistsQuery('Process', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the Process relation to the SpyOmsOrderProcess table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Oms\Persistence\SpyOmsOrderProcessQuery The inner query object of the IN statement
     */
    public function useInProcessQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Oms\Persistence\SpyOmsOrderProcessQuery */
        $q = $this->useInQuery('Process', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the Process relation to the SpyOmsOrderProcess table for a NOT IN query.
     *
     * @see useProcessInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Oms\Persistence\SpyOmsOrderProcessQuery The inner query object of the NOT IN statement
     */
    public function useNotInProcessQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Oms\Persistence\SpyOmsOrderProcessQuery */
        $q = $this->useInQuery('Process', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Sales\Persistence\SpySalesShipment object
     *
     * @param \Orm\Zed\Sales\Persistence\SpySalesShipment|ObjectCollection $spySalesShipment The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpySalesShipment($spySalesShipment, ?string $comparison = null)
    {
        if ($spySalesShipment instanceof \Orm\Zed\Sales\Persistence\SpySalesShipment) {
            return $this
                ->addUsingAlias(SpySalesOrderItemTableMap::COL_FK_SALES_SHIPMENT, $spySalesShipment->getIdSalesShipment(), $comparison);
        } elseif ($spySalesShipment instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpySalesOrderItemTableMap::COL_FK_SALES_SHIPMENT, $spySalesShipment->toKeyValue('PrimaryKey', 'IdSalesShipment'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpySalesShipment() only accepts arguments of type \Orm\Zed\Sales\Persistence\SpySalesShipment or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpySalesShipment relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpySalesShipment(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpySalesShipment');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SpySalesShipment');
        }

        return $this;
    }

    /**
     * Use the SpySalesShipment relation SpySalesShipment object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesShipmentQuery A secondary query class using the current class as primary query
     */
    public function useSpySalesShipmentQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpySalesShipment($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpySalesShipment', '\Orm\Zed\Sales\Persistence\SpySalesShipmentQuery');
    }

    /**
     * Use the SpySalesShipment relation SpySalesShipment object
     *
     * @param callable(\Orm\Zed\Sales\Persistence\SpySalesShipmentQuery):\Orm\Zed\Sales\Persistence\SpySalesShipmentQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpySalesShipmentQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpySalesShipmentQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpySalesShipment table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesShipmentQuery The inner query object of the EXISTS statement
     */
    public function useSpySalesShipmentExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesShipmentQuery */
        $q = $this->useExistsQuery('SpySalesShipment', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpySalesShipment table for a NOT EXISTS query.
     *
     * @see useSpySalesShipmentExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesShipmentQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpySalesShipmentNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesShipmentQuery */
        $q = $this->useExistsQuery('SpySalesShipment', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpySalesShipment table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesShipmentQuery The inner query object of the IN statement
     */
    public function useInSpySalesShipmentQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesShipmentQuery */
        $q = $this->useInQuery('SpySalesShipment', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpySalesShipment table for a NOT IN query.
     *
     * @see useSpySalesShipmentInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesShipmentQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpySalesShipmentQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesShipmentQuery */
        $q = $this->useInQuery('SpySalesShipment', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderItem object
     *
     * @param \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderItem|ObjectCollection $spyMerchantSalesOrderItem the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMerchantSalesOrderItem($spyMerchantSalesOrderItem, ?string $comparison = null)
    {
        if ($spyMerchantSalesOrderItem instanceof \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderItem) {
            $this
                ->addUsingAlias(SpySalesOrderItemTableMap::COL_ID_SALES_ORDER_ITEM, $spyMerchantSalesOrderItem->getFkSalesOrderItem(), $comparison);

            return $this;
        } elseif ($spyMerchantSalesOrderItem instanceof ObjectCollection) {
            $this
                ->useMerchantSalesOrderItemQuery()
                ->filterByPrimaryKeys($spyMerchantSalesOrderItem->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByMerchantSalesOrderItem() only accepts arguments of type \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderItem or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MerchantSalesOrderItem relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinMerchantSalesOrderItem(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MerchantSalesOrderItem');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'MerchantSalesOrderItem');
        }

        return $this;
    }

    /**
     * Use the MerchantSalesOrderItem relation SpyMerchantSalesOrderItem object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderItemQuery A secondary query class using the current class as primary query
     */
    public function useMerchantSalesOrderItemQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMerchantSalesOrderItem($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MerchantSalesOrderItem', '\Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderItemQuery');
    }

    /**
     * Use the MerchantSalesOrderItem relation SpyMerchantSalesOrderItem object
     *
     * @param callable(\Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderItemQuery):\Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderItemQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withMerchantSalesOrderItemQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useMerchantSalesOrderItemQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the MerchantSalesOrderItem relation to the SpyMerchantSalesOrderItem table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderItemQuery The inner query object of the EXISTS statement
     */
    public function useMerchantSalesOrderItemExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderItemQuery */
        $q = $this->useExistsQuery('MerchantSalesOrderItem', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the MerchantSalesOrderItem relation to the SpyMerchantSalesOrderItem table for a NOT EXISTS query.
     *
     * @see useMerchantSalesOrderItemExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderItemQuery The inner query object of the NOT EXISTS statement
     */
    public function useMerchantSalesOrderItemNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderItemQuery */
        $q = $this->useExistsQuery('MerchantSalesOrderItem', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the MerchantSalesOrderItem relation to the SpyMerchantSalesOrderItem table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderItemQuery The inner query object of the IN statement
     */
    public function useInMerchantSalesOrderItemQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderItemQuery */
        $q = $this->useInQuery('MerchantSalesOrderItem', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the MerchantSalesOrderItem relation to the SpyMerchantSalesOrderItem table for a NOT IN query.
     *
     * @see useMerchantSalesOrderItemInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderItemQuery The inner query object of the NOT IN statement
     */
    public function useNotInMerchantSalesOrderItemQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderItemQuery */
        $q = $this->useInQuery('MerchantSalesOrderItem', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Nopayment\Persistence\SpyNopaymentPaid object
     *
     * @param \Orm\Zed\Nopayment\Persistence\SpyNopaymentPaid|ObjectCollection $spyNopaymentPaid the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNopayment($spyNopaymentPaid, ?string $comparison = null)
    {
        if ($spyNopaymentPaid instanceof \Orm\Zed\Nopayment\Persistence\SpyNopaymentPaid) {
            $this
                ->addUsingAlias(SpySalesOrderItemTableMap::COL_ID_SALES_ORDER_ITEM, $spyNopaymentPaid->getFkSalesOrderItem(), $comparison);

            return $this;
        } elseif ($spyNopaymentPaid instanceof ObjectCollection) {
            $this
                ->useNopaymentQuery()
                ->filterByPrimaryKeys($spyNopaymentPaid->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByNopayment() only accepts arguments of type \Orm\Zed\Nopayment\Persistence\SpyNopaymentPaid or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Nopayment relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinNopayment(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Nopayment');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Nopayment');
        }

        return $this;
    }

    /**
     * Use the Nopayment relation SpyNopaymentPaid object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Nopayment\Persistence\SpyNopaymentPaidQuery A secondary query class using the current class as primary query
     */
    public function useNopaymentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinNopayment($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Nopayment', '\Orm\Zed\Nopayment\Persistence\SpyNopaymentPaidQuery');
    }

    /**
     * Use the Nopayment relation SpyNopaymentPaid object
     *
     * @param callable(\Orm\Zed\Nopayment\Persistence\SpyNopaymentPaidQuery):\Orm\Zed\Nopayment\Persistence\SpyNopaymentPaidQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withNopaymentQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useNopaymentQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the Nopayment relation to the SpyNopaymentPaid table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Nopayment\Persistence\SpyNopaymentPaidQuery The inner query object of the EXISTS statement
     */
    public function useNopaymentExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Nopayment\Persistence\SpyNopaymentPaidQuery */
        $q = $this->useExistsQuery('Nopayment', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the Nopayment relation to the SpyNopaymentPaid table for a NOT EXISTS query.
     *
     * @see useNopaymentExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Nopayment\Persistence\SpyNopaymentPaidQuery The inner query object of the NOT EXISTS statement
     */
    public function useNopaymentNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Nopayment\Persistence\SpyNopaymentPaidQuery */
        $q = $this->useExistsQuery('Nopayment', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the Nopayment relation to the SpyNopaymentPaid table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Nopayment\Persistence\SpyNopaymentPaidQuery The inner query object of the IN statement
     */
    public function useInNopaymentQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Nopayment\Persistence\SpyNopaymentPaidQuery */
        $q = $this->useInQuery('Nopayment', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the Nopayment relation to the SpyNopaymentPaid table for a NOT IN query.
     *
     * @see useNopaymentInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Nopayment\Persistence\SpyNopaymentPaidQuery The inner query object of the NOT IN statement
     */
    public function useNotInNopaymentQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Nopayment\Persistence\SpyNopaymentPaidQuery */
        $q = $this->useInQuery('Nopayment', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Oms\Persistence\SpyOmsTransitionLog object
     *
     * @param \Orm\Zed\Oms\Persistence\SpyOmsTransitionLog|ObjectCollection $spyOmsTransitionLog the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTransitionLog($spyOmsTransitionLog, ?string $comparison = null)
    {
        if ($spyOmsTransitionLog instanceof \Orm\Zed\Oms\Persistence\SpyOmsTransitionLog) {
            $this
                ->addUsingAlias(SpySalesOrderItemTableMap::COL_ID_SALES_ORDER_ITEM, $spyOmsTransitionLog->getFkSalesOrderItem(), $comparison);

            return $this;
        } elseif ($spyOmsTransitionLog instanceof ObjectCollection) {
            $this
                ->useTransitionLogQuery()
                ->filterByPrimaryKeys($spyOmsTransitionLog->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByTransitionLog() only accepts arguments of type \Orm\Zed\Oms\Persistence\SpyOmsTransitionLog or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TransitionLog relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinTransitionLog(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TransitionLog');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'TransitionLog');
        }

        return $this;
    }

    /**
     * Use the TransitionLog relation SpyOmsTransitionLog object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Oms\Persistence\SpyOmsTransitionLogQuery A secondary query class using the current class as primary query
     */
    public function useTransitionLogQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTransitionLog($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TransitionLog', '\Orm\Zed\Oms\Persistence\SpyOmsTransitionLogQuery');
    }

    /**
     * Use the TransitionLog relation SpyOmsTransitionLog object
     *
     * @param callable(\Orm\Zed\Oms\Persistence\SpyOmsTransitionLogQuery):\Orm\Zed\Oms\Persistence\SpyOmsTransitionLogQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTransitionLogQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useTransitionLogQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the TransitionLog relation to the SpyOmsTransitionLog table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Oms\Persistence\SpyOmsTransitionLogQuery The inner query object of the EXISTS statement
     */
    public function useTransitionLogExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Oms\Persistence\SpyOmsTransitionLogQuery */
        $q = $this->useExistsQuery('TransitionLog', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the TransitionLog relation to the SpyOmsTransitionLog table for a NOT EXISTS query.
     *
     * @see useTransitionLogExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Oms\Persistence\SpyOmsTransitionLogQuery The inner query object of the NOT EXISTS statement
     */
    public function useTransitionLogNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Oms\Persistence\SpyOmsTransitionLogQuery */
        $q = $this->useExistsQuery('TransitionLog', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the TransitionLog relation to the SpyOmsTransitionLog table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Oms\Persistence\SpyOmsTransitionLogQuery The inner query object of the IN statement
     */
    public function useInTransitionLogQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Oms\Persistence\SpyOmsTransitionLogQuery */
        $q = $this->useInQuery('TransitionLog', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the TransitionLog relation to the SpyOmsTransitionLog table for a NOT IN query.
     *
     * @see useTransitionLogInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Oms\Persistence\SpyOmsTransitionLogQuery The inner query object of the NOT IN statement
     */
    public function useNotInTransitionLogQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Oms\Persistence\SpyOmsTransitionLogQuery */
        $q = $this->useInQuery('TransitionLog', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateHistory object
     *
     * @param \Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateHistory|ObjectCollection $spyOmsOrderItemStateHistory the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStateHistory($spyOmsOrderItemStateHistory, ?string $comparison = null)
    {
        if ($spyOmsOrderItemStateHistory instanceof \Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateHistory) {
            $this
                ->addUsingAlias(SpySalesOrderItemTableMap::COL_ID_SALES_ORDER_ITEM, $spyOmsOrderItemStateHistory->getFkSalesOrderItem(), $comparison);

            return $this;
        } elseif ($spyOmsOrderItemStateHistory instanceof ObjectCollection) {
            $this
                ->useStateHistoryQuery()
                ->filterByPrimaryKeys($spyOmsOrderItemStateHistory->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByStateHistory() only accepts arguments of type \Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateHistory or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the StateHistory relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinStateHistory(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('StateHistory');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'StateHistory');
        }

        return $this;
    }

    /**
     * Use the StateHistory relation SpyOmsOrderItemStateHistory object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateHistoryQuery A secondary query class using the current class as primary query
     */
    public function useStateHistoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStateHistory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'StateHistory', '\Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateHistoryQuery');
    }

    /**
     * Use the StateHistory relation SpyOmsOrderItemStateHistory object
     *
     * @param callable(\Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateHistoryQuery):\Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateHistoryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withStateHistoryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useStateHistoryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the StateHistory relation to the SpyOmsOrderItemStateHistory table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateHistoryQuery The inner query object of the EXISTS statement
     */
    public function useStateHistoryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateHistoryQuery */
        $q = $this->useExistsQuery('StateHistory', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the StateHistory relation to the SpyOmsOrderItemStateHistory table for a NOT EXISTS query.
     *
     * @see useStateHistoryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateHistoryQuery The inner query object of the NOT EXISTS statement
     */
    public function useStateHistoryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateHistoryQuery */
        $q = $this->useExistsQuery('StateHistory', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the StateHistory relation to the SpyOmsOrderItemStateHistory table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateHistoryQuery The inner query object of the IN statement
     */
    public function useInStateHistoryQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateHistoryQuery */
        $q = $this->useInQuery('StateHistory', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the StateHistory relation to the SpyOmsOrderItemStateHistory table for a NOT IN query.
     *
     * @see useStateHistoryInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateHistoryQuery The inner query object of the NOT IN statement
     */
    public function useNotInStateHistoryQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateHistoryQuery */
        $q = $this->useInQuery('StateHistory', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Oms\Persistence\SpyOmsEventTimeout object
     *
     * @param \Orm\Zed\Oms\Persistence\SpyOmsEventTimeout|ObjectCollection $spyOmsEventTimeout the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEventTimeout($spyOmsEventTimeout, ?string $comparison = null)
    {
        if ($spyOmsEventTimeout instanceof \Orm\Zed\Oms\Persistence\SpyOmsEventTimeout) {
            $this
                ->addUsingAlias(SpySalesOrderItemTableMap::COL_ID_SALES_ORDER_ITEM, $spyOmsEventTimeout->getFkSalesOrderItem(), $comparison);

            return $this;
        } elseif ($spyOmsEventTimeout instanceof ObjectCollection) {
            $this
                ->useEventTimeoutQuery()
                ->filterByPrimaryKeys($spyOmsEventTimeout->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByEventTimeout() only accepts arguments of type \Orm\Zed\Oms\Persistence\SpyOmsEventTimeout or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EventTimeout relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEventTimeout(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EventTimeout');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'EventTimeout');
        }

        return $this;
    }

    /**
     * Use the EventTimeout relation SpyOmsEventTimeout object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Oms\Persistence\SpyOmsEventTimeoutQuery A secondary query class using the current class as primary query
     */
    public function useEventTimeoutQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEventTimeout($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EventTimeout', '\Orm\Zed\Oms\Persistence\SpyOmsEventTimeoutQuery');
    }

    /**
     * Use the EventTimeout relation SpyOmsEventTimeout object
     *
     * @param callable(\Orm\Zed\Oms\Persistence\SpyOmsEventTimeoutQuery):\Orm\Zed\Oms\Persistence\SpyOmsEventTimeoutQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEventTimeoutQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useEventTimeoutQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the EventTimeout relation to the SpyOmsEventTimeout table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Oms\Persistence\SpyOmsEventTimeoutQuery The inner query object of the EXISTS statement
     */
    public function useEventTimeoutExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Oms\Persistence\SpyOmsEventTimeoutQuery */
        $q = $this->useExistsQuery('EventTimeout', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the EventTimeout relation to the SpyOmsEventTimeout table for a NOT EXISTS query.
     *
     * @see useEventTimeoutExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Oms\Persistence\SpyOmsEventTimeoutQuery The inner query object of the NOT EXISTS statement
     */
    public function useEventTimeoutNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Oms\Persistence\SpyOmsEventTimeoutQuery */
        $q = $this->useExistsQuery('EventTimeout', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the EventTimeout relation to the SpyOmsEventTimeout table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Oms\Persistence\SpyOmsEventTimeoutQuery The inner query object of the IN statement
     */
    public function useInEventTimeoutQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Oms\Persistence\SpyOmsEventTimeoutQuery */
        $q = $this->useInQuery('EventTimeout', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the EventTimeout relation to the SpyOmsEventTimeout table for a NOT IN query.
     *
     * @see useEventTimeoutInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Oms\Persistence\SpyOmsEventTimeoutQuery The inner query object of the NOT IN statement
     */
    public function useNotInEventTimeoutQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Oms\Persistence\SpyOmsEventTimeoutQuery */
        $q = $this->useInQuery('EventTimeout', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Sales\Persistence\SpySalesOrderItemMetadata object
     *
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItemMetadata|ObjectCollection $spySalesOrderItemMetadata the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMetadata($spySalesOrderItemMetadata, ?string $comparison = null)
    {
        if ($spySalesOrderItemMetadata instanceof \Orm\Zed\Sales\Persistence\SpySalesOrderItemMetadata) {
            $this
                ->addUsingAlias(SpySalesOrderItemTableMap::COL_ID_SALES_ORDER_ITEM, $spySalesOrderItemMetadata->getFkSalesOrderItem(), $comparison);

            return $this;
        } elseif ($spySalesOrderItemMetadata instanceof ObjectCollection) {
            $this
                ->useMetadataQuery()
                ->filterByPrimaryKeys($spySalesOrderItemMetadata->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByMetadata() only accepts arguments of type \Orm\Zed\Sales\Persistence\SpySalesOrderItemMetadata or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Metadata relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinMetadata(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Metadata');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Metadata');
        }

        return $this;
    }

    /**
     * Use the Metadata relation SpySalesOrderItemMetadata object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderItemMetadataQuery A secondary query class using the current class as primary query
     */
    public function useMetadataQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMetadata($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Metadata', '\Orm\Zed\Sales\Persistence\SpySalesOrderItemMetadataQuery');
    }

    /**
     * Use the Metadata relation SpySalesOrderItemMetadata object
     *
     * @param callable(\Orm\Zed\Sales\Persistence\SpySalesOrderItemMetadataQuery):\Orm\Zed\Sales\Persistence\SpySalesOrderItemMetadataQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withMetadataQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useMetadataQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the Metadata relation to the SpySalesOrderItemMetadata table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderItemMetadataQuery The inner query object of the EXISTS statement
     */
    public function useMetadataExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderItemMetadataQuery */
        $q = $this->useExistsQuery('Metadata', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the Metadata relation to the SpySalesOrderItemMetadata table for a NOT EXISTS query.
     *
     * @see useMetadataExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderItemMetadataQuery The inner query object of the NOT EXISTS statement
     */
    public function useMetadataNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderItemMetadataQuery */
        $q = $this->useExistsQuery('Metadata', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the Metadata relation to the SpySalesOrderItemMetadata table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderItemMetadataQuery The inner query object of the IN statement
     */
    public function useInMetadataQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderItemMetadataQuery */
        $q = $this->useInQuery('Metadata', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the Metadata relation to the SpySalesOrderItemMetadata table for a NOT IN query.
     *
     * @see useMetadataInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderItemMetadataQuery The inner query object of the NOT IN statement
     */
    public function useNotInMetadataQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderItemMetadataQuery */
        $q = $this->useInQuery('Metadata', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Sales\Persistence\SpySalesDiscount object
     *
     * @param \Orm\Zed\Sales\Persistence\SpySalesDiscount|ObjectCollection $spySalesDiscount the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDiscount($spySalesDiscount, ?string $comparison = null)
    {
        if ($spySalesDiscount instanceof \Orm\Zed\Sales\Persistence\SpySalesDiscount) {
            $this
                ->addUsingAlias(SpySalesOrderItemTableMap::COL_ID_SALES_ORDER_ITEM, $spySalesDiscount->getFkSalesOrderItem(), $comparison);

            return $this;
        } elseif ($spySalesDiscount instanceof ObjectCollection) {
            $this
                ->useDiscountQuery()
                ->filterByPrimaryKeys($spySalesDiscount->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByDiscount() only accepts arguments of type \Orm\Zed\Sales\Persistence\SpySalesDiscount or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Discount relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinDiscount(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Discount');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Discount');
        }

        return $this;
    }

    /**
     * Use the Discount relation SpySalesDiscount object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesDiscountQuery A secondary query class using the current class as primary query
     */
    public function useDiscountQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinDiscount($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Discount', '\Orm\Zed\Sales\Persistence\SpySalesDiscountQuery');
    }

    /**
     * Use the Discount relation SpySalesDiscount object
     *
     * @param callable(\Orm\Zed\Sales\Persistence\SpySalesDiscountQuery):\Orm\Zed\Sales\Persistence\SpySalesDiscountQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDiscountQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useDiscountQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the Discount relation to the SpySalesDiscount table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesDiscountQuery The inner query object of the EXISTS statement
     */
    public function useDiscountExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesDiscountQuery */
        $q = $this->useExistsQuery('Discount', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the Discount relation to the SpySalesDiscount table for a NOT EXISTS query.
     *
     * @see useDiscountExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesDiscountQuery The inner query object of the NOT EXISTS statement
     */
    public function useDiscountNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesDiscountQuery */
        $q = $this->useExistsQuery('Discount', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the Discount relation to the SpySalesDiscount table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesDiscountQuery The inner query object of the IN statement
     */
    public function useInDiscountQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesDiscountQuery */
        $q = $this->useInQuery('Discount', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the Discount relation to the SpySalesDiscount table for a NOT IN query.
     *
     * @see useDiscountInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesDiscountQuery The inner query object of the NOT IN statement
     */
    public function useNotInDiscountQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesDiscountQuery */
        $q = $this->useInQuery('Discount', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Sales\Persistence\SpySalesOrderItemOption object
     *
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItemOption|ObjectCollection $spySalesOrderItemOption the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOption($spySalesOrderItemOption, ?string $comparison = null)
    {
        if ($spySalesOrderItemOption instanceof \Orm\Zed\Sales\Persistence\SpySalesOrderItemOption) {
            $this
                ->addUsingAlias(SpySalesOrderItemTableMap::COL_ID_SALES_ORDER_ITEM, $spySalesOrderItemOption->getFkSalesOrderItem(), $comparison);

            return $this;
        } elseif ($spySalesOrderItemOption instanceof ObjectCollection) {
            $this
                ->useOptionQuery()
                ->filterByPrimaryKeys($spySalesOrderItemOption->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOption() only accepts arguments of type \Orm\Zed\Sales\Persistence\SpySalesOrderItemOption or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Option relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOption(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Option');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Option');
        }

        return $this;
    }

    /**
     * Use the Option relation SpySalesOrderItemOption object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderItemOptionQuery A secondary query class using the current class as primary query
     */
    public function useOptionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOption($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Option', '\Orm\Zed\Sales\Persistence\SpySalesOrderItemOptionQuery');
    }

    /**
     * Use the Option relation SpySalesOrderItemOption object
     *
     * @param callable(\Orm\Zed\Sales\Persistence\SpySalesOrderItemOptionQuery):\Orm\Zed\Sales\Persistence\SpySalesOrderItemOptionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOptionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOptionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the Option relation to the SpySalesOrderItemOption table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderItemOptionQuery The inner query object of the EXISTS statement
     */
    public function useOptionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderItemOptionQuery */
        $q = $this->useExistsQuery('Option', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the Option relation to the SpySalesOrderItemOption table for a NOT EXISTS query.
     *
     * @see useOptionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderItemOptionQuery The inner query object of the NOT EXISTS statement
     */
    public function useOptionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderItemOptionQuery */
        $q = $this->useExistsQuery('Option', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the Option relation to the SpySalesOrderItemOption table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderItemOptionQuery The inner query object of the IN statement
     */
    public function useInOptionQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderItemOptionQuery */
        $q = $this->useInQuery('Option', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the Option relation to the SpySalesOrderItemOption table for a NOT IN query.
     *
     * @see useOptionInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderItemOptionQuery The inner query object of the NOT IN statement
     */
    public function useNotInOptionQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderItemOptionQuery */
        $q = $this->useInQuery('Option', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SalesConfigurableBundle\Persistence\SpySalesOrderConfiguredBundleItem object
     *
     * @param \Orm\Zed\SalesConfigurableBundle\Persistence\SpySalesOrderConfiguredBundleItem|ObjectCollection $spySalesOrderConfiguredBundleItem the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpySalesOrderConfiguredBundleItem($spySalesOrderConfiguredBundleItem, ?string $comparison = null)
    {
        if ($spySalesOrderConfiguredBundleItem instanceof \Orm\Zed\SalesConfigurableBundle\Persistence\SpySalesOrderConfiguredBundleItem) {
            $this
                ->addUsingAlias(SpySalesOrderItemTableMap::COL_ID_SALES_ORDER_ITEM, $spySalesOrderConfiguredBundleItem->getFkSalesOrderItem(), $comparison);

            return $this;
        } elseif ($spySalesOrderConfiguredBundleItem instanceof ObjectCollection) {
            $this
                ->useSpySalesOrderConfiguredBundleItemQuery()
                ->filterByPrimaryKeys($spySalesOrderConfiguredBundleItem->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpySalesOrderConfiguredBundleItem() only accepts arguments of type \Orm\Zed\SalesConfigurableBundle\Persistence\SpySalesOrderConfiguredBundleItem or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpySalesOrderConfiguredBundleItem relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpySalesOrderConfiguredBundleItem(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpySalesOrderConfiguredBundleItem');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SpySalesOrderConfiguredBundleItem');
        }

        return $this;
    }

    /**
     * Use the SpySalesOrderConfiguredBundleItem relation SpySalesOrderConfiguredBundleItem object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SalesConfigurableBundle\Persistence\SpySalesOrderConfiguredBundleItemQuery A secondary query class using the current class as primary query
     */
    public function useSpySalesOrderConfiguredBundleItemQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpySalesOrderConfiguredBundleItem($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpySalesOrderConfiguredBundleItem', '\Orm\Zed\SalesConfigurableBundle\Persistence\SpySalesOrderConfiguredBundleItemQuery');
    }

    /**
     * Use the SpySalesOrderConfiguredBundleItem relation SpySalesOrderConfiguredBundleItem object
     *
     * @param callable(\Orm\Zed\SalesConfigurableBundle\Persistence\SpySalesOrderConfiguredBundleItemQuery):\Orm\Zed\SalesConfigurableBundle\Persistence\SpySalesOrderConfiguredBundleItemQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpySalesOrderConfiguredBundleItemQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpySalesOrderConfiguredBundleItemQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpySalesOrderConfiguredBundleItem table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SalesConfigurableBundle\Persistence\SpySalesOrderConfiguredBundleItemQuery The inner query object of the EXISTS statement
     */
    public function useSpySalesOrderConfiguredBundleItemExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SalesConfigurableBundle\Persistence\SpySalesOrderConfiguredBundleItemQuery */
        $q = $this->useExistsQuery('SpySalesOrderConfiguredBundleItem', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpySalesOrderConfiguredBundleItem table for a NOT EXISTS query.
     *
     * @see useSpySalesOrderConfiguredBundleItemExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SalesConfigurableBundle\Persistence\SpySalesOrderConfiguredBundleItemQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpySalesOrderConfiguredBundleItemNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SalesConfigurableBundle\Persistence\SpySalesOrderConfiguredBundleItemQuery */
        $q = $this->useExistsQuery('SpySalesOrderConfiguredBundleItem', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpySalesOrderConfiguredBundleItem table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SalesConfigurableBundle\Persistence\SpySalesOrderConfiguredBundleItemQuery The inner query object of the IN statement
     */
    public function useInSpySalesOrderConfiguredBundleItemQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SalesConfigurableBundle\Persistence\SpySalesOrderConfiguredBundleItemQuery */
        $q = $this->useInQuery('SpySalesOrderConfiguredBundleItem', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpySalesOrderConfiguredBundleItem table for a NOT IN query.
     *
     * @see useSpySalesOrderConfiguredBundleItemInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SalesConfigurableBundle\Persistence\SpySalesOrderConfiguredBundleItemQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpySalesOrderConfiguredBundleItemQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SalesConfigurableBundle\Persistence\SpySalesOrderConfiguredBundleItemQuery */
        $q = $this->useInQuery('SpySalesOrderConfiguredBundleItem', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SalesMerchantCommission\Persistence\SpySalesMerchantCommission object
     *
     * @param \Orm\Zed\SalesMerchantCommission\Persistence\SpySalesMerchantCommission|ObjectCollection $spySalesMerchantCommission the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpySalesMerchantCommission($spySalesMerchantCommission, ?string $comparison = null)
    {
        if ($spySalesMerchantCommission instanceof \Orm\Zed\SalesMerchantCommission\Persistence\SpySalesMerchantCommission) {
            $this
                ->addUsingAlias(SpySalesOrderItemTableMap::COL_ID_SALES_ORDER_ITEM, $spySalesMerchantCommission->getFkSalesOrderItem(), $comparison);

            return $this;
        } elseif ($spySalesMerchantCommission instanceof ObjectCollection) {
            $this
                ->useSpySalesMerchantCommissionQuery()
                ->filterByPrimaryKeys($spySalesMerchantCommission->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpySalesMerchantCommission() only accepts arguments of type \Orm\Zed\SalesMerchantCommission\Persistence\SpySalesMerchantCommission or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpySalesMerchantCommission relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpySalesMerchantCommission(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpySalesMerchantCommission');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SpySalesMerchantCommission');
        }

        return $this;
    }

    /**
     * Use the SpySalesMerchantCommission relation SpySalesMerchantCommission object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SalesMerchantCommission\Persistence\SpySalesMerchantCommissionQuery A secondary query class using the current class as primary query
     */
    public function useSpySalesMerchantCommissionQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpySalesMerchantCommission($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpySalesMerchantCommission', '\Orm\Zed\SalesMerchantCommission\Persistence\SpySalesMerchantCommissionQuery');
    }

    /**
     * Use the SpySalesMerchantCommission relation SpySalesMerchantCommission object
     *
     * @param callable(\Orm\Zed\SalesMerchantCommission\Persistence\SpySalesMerchantCommissionQuery):\Orm\Zed\SalesMerchantCommission\Persistence\SpySalesMerchantCommissionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpySalesMerchantCommissionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpySalesMerchantCommissionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpySalesMerchantCommission table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SalesMerchantCommission\Persistence\SpySalesMerchantCommissionQuery The inner query object of the EXISTS statement
     */
    public function useSpySalesMerchantCommissionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SalesMerchantCommission\Persistence\SpySalesMerchantCommissionQuery */
        $q = $this->useExistsQuery('SpySalesMerchantCommission', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpySalesMerchantCommission table for a NOT EXISTS query.
     *
     * @see useSpySalesMerchantCommissionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SalesMerchantCommission\Persistence\SpySalesMerchantCommissionQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpySalesMerchantCommissionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SalesMerchantCommission\Persistence\SpySalesMerchantCommissionQuery */
        $q = $this->useExistsQuery('SpySalesMerchantCommission', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpySalesMerchantCommission table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SalesMerchantCommission\Persistence\SpySalesMerchantCommissionQuery The inner query object of the IN statement
     */
    public function useInSpySalesMerchantCommissionQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SalesMerchantCommission\Persistence\SpySalesMerchantCommissionQuery */
        $q = $this->useInQuery('SpySalesMerchantCommission', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpySalesMerchantCommission table for a NOT IN query.
     *
     * @see useSpySalesMerchantCommissionInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SalesMerchantCommission\Persistence\SpySalesMerchantCommissionQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpySalesMerchantCommissionQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SalesMerchantCommission\Persistence\SpySalesMerchantCommissionQuery */
        $q = $this->useInQuery('SpySalesMerchantCommission', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SalesProductConfiguration\Persistence\SpySalesOrderItemConfiguration object
     *
     * @param \Orm\Zed\SalesProductConfiguration\Persistence\SpySalesOrderItemConfiguration|ObjectCollection $spySalesOrderItemConfiguration the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpySalesOrderItemConfiguration($spySalesOrderItemConfiguration, ?string $comparison = null)
    {
        if ($spySalesOrderItemConfiguration instanceof \Orm\Zed\SalesProductConfiguration\Persistence\SpySalesOrderItemConfiguration) {
            $this
                ->addUsingAlias(SpySalesOrderItemTableMap::COL_ID_SALES_ORDER_ITEM, $spySalesOrderItemConfiguration->getFkSalesOrderItem(), $comparison);

            return $this;
        } elseif ($spySalesOrderItemConfiguration instanceof ObjectCollection) {
            $this
                ->useSpySalesOrderItemConfigurationQuery()
                ->filterByPrimaryKeys($spySalesOrderItemConfiguration->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpySalesOrderItemConfiguration() only accepts arguments of type \Orm\Zed\SalesProductConfiguration\Persistence\SpySalesOrderItemConfiguration or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpySalesOrderItemConfiguration relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpySalesOrderItemConfiguration(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpySalesOrderItemConfiguration');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SpySalesOrderItemConfiguration');
        }

        return $this;
    }

    /**
     * Use the SpySalesOrderItemConfiguration relation SpySalesOrderItemConfiguration object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SalesProductConfiguration\Persistence\SpySalesOrderItemConfigurationQuery A secondary query class using the current class as primary query
     */
    public function useSpySalesOrderItemConfigurationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpySalesOrderItemConfiguration($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpySalesOrderItemConfiguration', '\Orm\Zed\SalesProductConfiguration\Persistence\SpySalesOrderItemConfigurationQuery');
    }

    /**
     * Use the SpySalesOrderItemConfiguration relation SpySalesOrderItemConfiguration object
     *
     * @param callable(\Orm\Zed\SalesProductConfiguration\Persistence\SpySalesOrderItemConfigurationQuery):\Orm\Zed\SalesProductConfiguration\Persistence\SpySalesOrderItemConfigurationQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpySalesOrderItemConfigurationQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpySalesOrderItemConfigurationQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpySalesOrderItemConfiguration table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SalesProductConfiguration\Persistence\SpySalesOrderItemConfigurationQuery The inner query object of the EXISTS statement
     */
    public function useSpySalesOrderItemConfigurationExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SalesProductConfiguration\Persistence\SpySalesOrderItemConfigurationQuery */
        $q = $this->useExistsQuery('SpySalesOrderItemConfiguration', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpySalesOrderItemConfiguration table for a NOT EXISTS query.
     *
     * @see useSpySalesOrderItemConfigurationExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SalesProductConfiguration\Persistence\SpySalesOrderItemConfigurationQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpySalesOrderItemConfigurationNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SalesProductConfiguration\Persistence\SpySalesOrderItemConfigurationQuery */
        $q = $this->useExistsQuery('SpySalesOrderItemConfiguration', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpySalesOrderItemConfiguration table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SalesProductConfiguration\Persistence\SpySalesOrderItemConfigurationQuery The inner query object of the IN statement
     */
    public function useInSpySalesOrderItemConfigurationQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SalesProductConfiguration\Persistence\SpySalesOrderItemConfigurationQuery */
        $q = $this->useInQuery('SpySalesOrderItemConfiguration', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpySalesOrderItemConfiguration table for a NOT IN query.
     *
     * @see useSpySalesOrderItemConfigurationInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SalesProductConfiguration\Persistence\SpySalesOrderItemConfigurationQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpySalesOrderItemConfigurationQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SalesProductConfiguration\Persistence\SpySalesOrderItemConfigurationQuery */
        $q = $this->useInQuery('SpySalesOrderItemConfiguration', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationItem object
     *
     * @param \Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationItem|ObjectCollection $spySalesReclamationItem the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByReclamationItem($spySalesReclamationItem, ?string $comparison = null)
    {
        if ($spySalesReclamationItem instanceof \Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationItem) {
            $this
                ->addUsingAlias(SpySalesOrderItemTableMap::COL_ID_SALES_ORDER_ITEM, $spySalesReclamationItem->getFkSalesOrderItem(), $comparison);

            return $this;
        } elseif ($spySalesReclamationItem instanceof ObjectCollection) {
            $this
                ->useReclamationItemQuery()
                ->filterByPrimaryKeys($spySalesReclamationItem->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByReclamationItem() only accepts arguments of type \Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationItem or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ReclamationItem relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinReclamationItem(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ReclamationItem');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ReclamationItem');
        }

        return $this;
    }

    /**
     * Use the ReclamationItem relation SpySalesReclamationItem object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationItemQuery A secondary query class using the current class as primary query
     */
    public function useReclamationItemQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinReclamationItem($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ReclamationItem', '\Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationItemQuery');
    }

    /**
     * Use the ReclamationItem relation SpySalesReclamationItem object
     *
     * @param callable(\Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationItemQuery):\Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationItemQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withReclamationItemQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useReclamationItemQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ReclamationItem relation to the SpySalesReclamationItem table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationItemQuery The inner query object of the EXISTS statement
     */
    public function useReclamationItemExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationItemQuery */
        $q = $this->useExistsQuery('ReclamationItem', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ReclamationItem relation to the SpySalesReclamationItem table for a NOT EXISTS query.
     *
     * @see useReclamationItemExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationItemQuery The inner query object of the NOT EXISTS statement
     */
    public function useReclamationItemNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationItemQuery */
        $q = $this->useExistsQuery('ReclamationItem', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ReclamationItem relation to the SpySalesReclamationItem table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationItemQuery The inner query object of the IN statement
     */
    public function useInReclamationItemQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationItemQuery */
        $q = $this->useInQuery('ReclamationItem', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ReclamationItem relation to the SpySalesReclamationItem table for a NOT IN query.
     *
     * @see useReclamationItemInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationItemQuery The inner query object of the NOT IN statement
     */
    public function useNotInReclamationItemQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationItemQuery */
        $q = $this->useInQuery('ReclamationItem', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SalesReturn\Persistence\SpySalesReturnItem object
     *
     * @param \Orm\Zed\SalesReturn\Persistence\SpySalesReturnItem|ObjectCollection $spySalesReturnItem the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpySalesReturnItem($spySalesReturnItem, ?string $comparison = null)
    {
        if ($spySalesReturnItem instanceof \Orm\Zed\SalesReturn\Persistence\SpySalesReturnItem) {
            $this
                ->addUsingAlias(SpySalesOrderItemTableMap::COL_ID_SALES_ORDER_ITEM, $spySalesReturnItem->getFkSalesOrderItem(), $comparison);

            return $this;
        } elseif ($spySalesReturnItem instanceof ObjectCollection) {
            $this
                ->useSpySalesReturnItemQuery()
                ->filterByPrimaryKeys($spySalesReturnItem->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpySalesReturnItem() only accepts arguments of type \Orm\Zed\SalesReturn\Persistence\SpySalesReturnItem or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpySalesReturnItem relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpySalesReturnItem(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpySalesReturnItem');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SpySalesReturnItem');
        }

        return $this;
    }

    /**
     * Use the SpySalesReturnItem relation SpySalesReturnItem object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SalesReturn\Persistence\SpySalesReturnItemQuery A secondary query class using the current class as primary query
     */
    public function useSpySalesReturnItemQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpySalesReturnItem($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpySalesReturnItem', '\Orm\Zed\SalesReturn\Persistence\SpySalesReturnItemQuery');
    }

    /**
     * Use the SpySalesReturnItem relation SpySalesReturnItem object
     *
     * @param callable(\Orm\Zed\SalesReturn\Persistence\SpySalesReturnItemQuery):\Orm\Zed\SalesReturn\Persistence\SpySalesReturnItemQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpySalesReturnItemQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpySalesReturnItemQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpySalesReturnItem table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SalesReturn\Persistence\SpySalesReturnItemQuery The inner query object of the EXISTS statement
     */
    public function useSpySalesReturnItemExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SalesReturn\Persistence\SpySalesReturnItemQuery */
        $q = $this->useExistsQuery('SpySalesReturnItem', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpySalesReturnItem table for a NOT EXISTS query.
     *
     * @see useSpySalesReturnItemExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SalesReturn\Persistence\SpySalesReturnItemQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpySalesReturnItemNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SalesReturn\Persistence\SpySalesReturnItemQuery */
        $q = $this->useExistsQuery('SpySalesReturnItem', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpySalesReturnItem table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SalesReturn\Persistence\SpySalesReturnItemQuery The inner query object of the IN statement
     */
    public function useInSpySalesReturnItemQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SalesReturn\Persistence\SpySalesReturnItemQuery */
        $q = $this->useInQuery('SpySalesReturnItem', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpySalesReturnItem table for a NOT IN query.
     *
     * @see useSpySalesReturnItemInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SalesReturn\Persistence\SpySalesReturnItemQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpySalesReturnItemQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SalesReturn\Persistence\SpySalesReturnItemQuery */
        $q = $this->useInQuery('SpySalesReturnItem', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SalesServicePoint\Persistence\SpySalesOrderItemServicePoint object
     *
     * @param \Orm\Zed\SalesServicePoint\Persistence\SpySalesOrderItemServicePoint|ObjectCollection $spySalesOrderItemServicePoint the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySalesOrderItemServicePoint($spySalesOrderItemServicePoint, ?string $comparison = null)
    {
        if ($spySalesOrderItemServicePoint instanceof \Orm\Zed\SalesServicePoint\Persistence\SpySalesOrderItemServicePoint) {
            $this
                ->addUsingAlias(SpySalesOrderItemTableMap::COL_ID_SALES_ORDER_ITEM, $spySalesOrderItemServicePoint->getFkSalesOrderItem(), $comparison);

            return $this;
        } elseif ($spySalesOrderItemServicePoint instanceof ObjectCollection) {
            $this
                ->useSalesOrderItemServicePointQuery()
                ->filterByPrimaryKeys($spySalesOrderItemServicePoint->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySalesOrderItemServicePoint() only accepts arguments of type \Orm\Zed\SalesServicePoint\Persistence\SpySalesOrderItemServicePoint or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SalesOrderItemServicePoint relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSalesOrderItemServicePoint(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SalesOrderItemServicePoint');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SalesOrderItemServicePoint');
        }

        return $this;
    }

    /**
     * Use the SalesOrderItemServicePoint relation SpySalesOrderItemServicePoint object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SalesServicePoint\Persistence\SpySalesOrderItemServicePointQuery A secondary query class using the current class as primary query
     */
    public function useSalesOrderItemServicePointQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSalesOrderItemServicePoint($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SalesOrderItemServicePoint', '\Orm\Zed\SalesServicePoint\Persistence\SpySalesOrderItemServicePointQuery');
    }

    /**
     * Use the SalesOrderItemServicePoint relation SpySalesOrderItemServicePoint object
     *
     * @param callable(\Orm\Zed\SalesServicePoint\Persistence\SpySalesOrderItemServicePointQuery):\Orm\Zed\SalesServicePoint\Persistence\SpySalesOrderItemServicePointQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSalesOrderItemServicePointQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSalesOrderItemServicePointQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the SalesOrderItemServicePoint relation to the SpySalesOrderItemServicePoint table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SalesServicePoint\Persistence\SpySalesOrderItemServicePointQuery The inner query object of the EXISTS statement
     */
    public function useSalesOrderItemServicePointExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SalesServicePoint\Persistence\SpySalesOrderItemServicePointQuery */
        $q = $this->useExistsQuery('SalesOrderItemServicePoint', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the SalesOrderItemServicePoint relation to the SpySalesOrderItemServicePoint table for a NOT EXISTS query.
     *
     * @see useSalesOrderItemServicePointExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SalesServicePoint\Persistence\SpySalesOrderItemServicePointQuery The inner query object of the NOT EXISTS statement
     */
    public function useSalesOrderItemServicePointNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SalesServicePoint\Persistence\SpySalesOrderItemServicePointQuery */
        $q = $this->useExistsQuery('SalesOrderItemServicePoint', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the SalesOrderItemServicePoint relation to the SpySalesOrderItemServicePoint table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SalesServicePoint\Persistence\SpySalesOrderItemServicePointQuery The inner query object of the IN statement
     */
    public function useInSalesOrderItemServicePointQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SalesServicePoint\Persistence\SpySalesOrderItemServicePointQuery */
        $q = $this->useInQuery('SalesOrderItemServicePoint', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the SalesOrderItemServicePoint relation to the SpySalesOrderItemServicePoint table for a NOT IN query.
     *
     * @see useSalesOrderItemServicePointInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SalesServicePoint\Persistence\SpySalesOrderItemServicePointQuery The inner query object of the NOT IN statement
     */
    public function useNotInSalesOrderItemServicePointQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SalesServicePoint\Persistence\SpySalesOrderItemServicePointQuery */
        $q = $this->useInQuery('SalesOrderItemServicePoint', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemProductClass object
     *
     * @param \Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemProductClass|ObjectCollection $spySalesOrderItemProductClass the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpySalesOrderItemProductClass($spySalesOrderItemProductClass, ?string $comparison = null)
    {
        if ($spySalesOrderItemProductClass instanceof \Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemProductClass) {
            $this
                ->addUsingAlias(SpySalesOrderItemTableMap::COL_ID_SALES_ORDER_ITEM, $spySalesOrderItemProductClass->getFkSalesOrderItem(), $comparison);

            return $this;
        } elseif ($spySalesOrderItemProductClass instanceof ObjectCollection) {
            $this
                ->useSpySalesOrderItemProductClassQuery()
                ->filterByPrimaryKeys($spySalesOrderItemProductClass->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpySalesOrderItemProductClass() only accepts arguments of type \Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemProductClass or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpySalesOrderItemProductClass relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpySalesOrderItemProductClass(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpySalesOrderItemProductClass');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SpySalesOrderItemProductClass');
        }

        return $this;
    }

    /**
     * Use the SpySalesOrderItemProductClass relation SpySalesOrderItemProductClass object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemProductClassQuery A secondary query class using the current class as primary query
     */
    public function useSpySalesOrderItemProductClassQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpySalesOrderItemProductClass($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpySalesOrderItemProductClass', '\Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemProductClassQuery');
    }

    /**
     * Use the SpySalesOrderItemProductClass relation SpySalesOrderItemProductClass object
     *
     * @param callable(\Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemProductClassQuery):\Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemProductClassQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpySalesOrderItemProductClassQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpySalesOrderItemProductClassQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpySalesOrderItemProductClass table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemProductClassQuery The inner query object of the EXISTS statement
     */
    public function useSpySalesOrderItemProductClassExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemProductClassQuery */
        $q = $this->useExistsQuery('SpySalesOrderItemProductClass', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpySalesOrderItemProductClass table for a NOT EXISTS query.
     *
     * @see useSpySalesOrderItemProductClassExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemProductClassQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpySalesOrderItemProductClassNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemProductClassQuery */
        $q = $this->useExistsQuery('SpySalesOrderItemProductClass', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpySalesOrderItemProductClass table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemProductClassQuery The inner query object of the IN statement
     */
    public function useInSpySalesOrderItemProductClassQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemProductClassQuery */
        $q = $this->useInQuery('SpySalesOrderItemProductClass', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpySalesOrderItemProductClass table for a NOT IN query.
     *
     * @see useSpySalesOrderItemProductClassInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemProductClassQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpySalesOrderItemProductClassQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemProductClassQuery */
        $q = $this->useInQuery('SpySalesOrderItemProductClass', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderItem object
     *
     * @param \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderItem|ObjectCollection $spySspInquirySalesOrderItem the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpySspInquirySalesOrderItem($spySspInquirySalesOrderItem, ?string $comparison = null)
    {
        if ($spySspInquirySalesOrderItem instanceof \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderItem) {
            $this
                ->addUsingAlias(SpySalesOrderItemTableMap::COL_ID_SALES_ORDER_ITEM, $spySspInquirySalesOrderItem->getFkSalesOrderItem(), $comparison);

            return $this;
        } elseif ($spySspInquirySalesOrderItem instanceof ObjectCollection) {
            $this
                ->useSpySspInquirySalesOrderItemQuery()
                ->filterByPrimaryKeys($spySspInquirySalesOrderItem->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpySspInquirySalesOrderItem() only accepts arguments of type \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderItem or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpySspInquirySalesOrderItem relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpySspInquirySalesOrderItem(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpySspInquirySalesOrderItem');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SpySspInquirySalesOrderItem');
        }

        return $this;
    }

    /**
     * Use the SpySspInquirySalesOrderItem relation SpySspInquirySalesOrderItem object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderItemQuery A secondary query class using the current class as primary query
     */
    public function useSpySspInquirySalesOrderItemQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpySspInquirySalesOrderItem($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpySspInquirySalesOrderItem', '\Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderItemQuery');
    }

    /**
     * Use the SpySspInquirySalesOrderItem relation SpySspInquirySalesOrderItem object
     *
     * @param callable(\Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderItemQuery):\Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderItemQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpySspInquirySalesOrderItemQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpySspInquirySalesOrderItemQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpySspInquirySalesOrderItem table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderItemQuery The inner query object of the EXISTS statement
     */
    public function useSpySspInquirySalesOrderItemExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderItemQuery */
        $q = $this->useExistsQuery('SpySspInquirySalesOrderItem', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpySspInquirySalesOrderItem table for a NOT EXISTS query.
     *
     * @see useSpySspInquirySalesOrderItemExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderItemQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpySspInquirySalesOrderItemNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderItemQuery */
        $q = $this->useExistsQuery('SpySspInquirySalesOrderItem', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpySspInquirySalesOrderItem table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderItemQuery The inner query object of the IN statement
     */
    public function useInSpySspInquirySalesOrderItemQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderItemQuery */
        $q = $this->useInQuery('SpySspInquirySalesOrderItem', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpySspInquirySalesOrderItem table for a NOT IN query.
     *
     * @see useSpySspInquirySalesOrderItemInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderItemQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpySspInquirySalesOrderItemQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderItemQuery */
        $q = $this->useInQuery('SpySspInquirySalesOrderItem', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemSspAsset object
     *
     * @param \Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemSspAsset|ObjectCollection $spySalesOrderItemSspAsset the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySalesOrderItemSspAsset($spySalesOrderItemSspAsset, ?string $comparison = null)
    {
        if ($spySalesOrderItemSspAsset instanceof \Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemSspAsset) {
            $this
                ->addUsingAlias(SpySalesOrderItemTableMap::COL_ID_SALES_ORDER_ITEM, $spySalesOrderItemSspAsset->getFkSalesOrderItem(), $comparison);

            return $this;
        } elseif ($spySalesOrderItemSspAsset instanceof ObjectCollection) {
            $this
                ->useSalesOrderItemSspAssetQuery()
                ->filterByPrimaryKeys($spySalesOrderItemSspAsset->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySalesOrderItemSspAsset() only accepts arguments of type \Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemSspAsset or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SalesOrderItemSspAsset relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSalesOrderItemSspAsset(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SalesOrderItemSspAsset');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SalesOrderItemSspAsset');
        }

        return $this;
    }

    /**
     * Use the SalesOrderItemSspAsset relation SpySalesOrderItemSspAsset object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemSspAssetQuery A secondary query class using the current class as primary query
     */
    public function useSalesOrderItemSspAssetQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSalesOrderItemSspAsset($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SalesOrderItemSspAsset', '\Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemSspAssetQuery');
    }

    /**
     * Use the SalesOrderItemSspAsset relation SpySalesOrderItemSspAsset object
     *
     * @param callable(\Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemSspAssetQuery):\Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemSspAssetQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSalesOrderItemSspAssetQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSalesOrderItemSspAssetQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the SalesOrderItemSspAsset relation to the SpySalesOrderItemSspAsset table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemSspAssetQuery The inner query object of the EXISTS statement
     */
    public function useSalesOrderItemSspAssetExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemSspAssetQuery */
        $q = $this->useExistsQuery('SalesOrderItemSspAsset', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the SalesOrderItemSspAsset relation to the SpySalesOrderItemSspAsset table for a NOT EXISTS query.
     *
     * @see useSalesOrderItemSspAssetExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemSspAssetQuery The inner query object of the NOT EXISTS statement
     */
    public function useSalesOrderItemSspAssetNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemSspAssetQuery */
        $q = $this->useExistsQuery('SalesOrderItemSspAsset', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the SalesOrderItemSspAsset relation to the SpySalesOrderItemSspAsset table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemSspAssetQuery The inner query object of the IN statement
     */
    public function useInSalesOrderItemSspAssetQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemSspAssetQuery */
        $q = $this->useInQuery('SalesOrderItemSspAsset', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the SalesOrderItemSspAsset relation to the SpySalesOrderItemSspAsset table for a NOT IN query.
     *
     * @see useSalesOrderItemSspAssetInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemSspAssetQuery The inner query object of the NOT IN statement
     */
    public function useNotInSalesOrderItemSspAssetQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemSspAssetQuery */
        $q = $this->useInQuery('SalesOrderItemSspAsset', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related SpySalesProductClass object
     * using the spy_sales_order_item_product_class table as cross reference
     *
     * @param SpySalesProductClass $spySalesProductClass the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL and Criteria::IN for queries
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpySalesProductClass($spySalesProductClass, string $comparison = null)
    {
        $this
            ->useSpySalesOrderItemProductClassQuery()
            ->filterBySpySalesProductClass($spySalesProductClass, $comparison)
            ->endUse();

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpySalesOrderItem $spySalesOrderItem Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spySalesOrderItem = null)
    {
        if ($spySalesOrderItem) {
            $this->addUsingAlias(SpySalesOrderItemTableMap::COL_ID_SALES_ORDER_ITEM, $spySalesOrderItem->getIdSalesOrderItem(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Code to execute before every SELECT statement
     *
     * @param ConnectionInterface $con The connection object used by the query
     */
    protected function basePreSelect(ConnectionInterface $con): void
    {
        // \Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior behavior
        // phpcs:ignoreFile
        /**
         * @var string|null $action
         */
        /** @var \Spryker\Zed\AclEntity\Business\AclEntityFacadeInterface $aclEntityFacade */
        $aclEntityFacade = \Spryker\Zed\Kernel\Locator::getInstance()->aclEntity()->facade();
        if ($aclEntityFacade->isActive() && !$this->isSegmentQuery()) {
            $aclEntityMetadataConfigRequestTransfer = new \Generated\Shared\Transfer\AclEntityMetadataConfigRequestTransfer();
            $aclEntityMetadataConfigRequestTransfer->setModelName($this->getModelName());
            $aclEntityConfigTransfer = $aclEntityFacade->getAclEntityMetadataConfig(true, $aclEntityMetadataConfigRequestTransfer);
            if (!in_array($this->getModelName(), $aclEntityConfigTransfer->getAclEntityAllowList())) {
                $this->getPersistenceFactory()
                    ->createAclQueryDirector($aclEntityConfigTransfer)
                    ->applyAclRuleOnSelectQuery($this);
            }
        }


        $this->preSelect($con);
    }

    /**
     * Code to execute before every DELETE statement
     *
     * @param ConnectionInterface $con The connection object used by the query
     * @return int|null
     */
    protected function basePreDelete(ConnectionInterface $con): ?int
    {
        // \Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior behavior
        // phpcs:ignoreFile
        /**
         * @var string|null $action
         */
        /** @var \Spryker\Zed\AclEntity\Business\AclEntityFacadeInterface $aclEntityFacade */
        $aclEntityFacade = \Spryker\Zed\Kernel\Locator::getInstance()->aclEntity()->facade();
        if ($aclEntityFacade->isActive() && !$this->isSegmentQuery()) {
            $aclEntityMetadataConfigRequestTransfer = new \Generated\Shared\Transfer\AclEntityMetadataConfigRequestTransfer();
            $aclEntityMetadataConfigRequestTransfer->setModelName($this->getModelName());
            $aclEntityConfigTransfer = $aclEntityFacade->getAclEntityMetadataConfig(true, $aclEntityMetadataConfigRequestTransfer);
            if (!in_array($this->getModelName(), $aclEntityConfigTransfer->getAclEntityAllowList())) {
                $this->getPersistenceFactory()
                    ->createAclQueryDirector($aclEntityConfigTransfer)
                    ->applyAclRuleOnDeleteQuery($this);
            }
        }


        return $this->preDelete($con);
    }

    /**
     * Code to execute before every UPDATE statement
     *
     * @param array $values The associative array of columns and values for the update
     * @param ConnectionInterface $con The connection object used by the query
     * @param bool $forceIndividualSaves If false (default), the resulting call is a Criteria::doUpdate(), otherwise it is a series of save() calls on all the found objects
     *
     * @return int|null
     */
    protected function basePreUpdate(&$values, ConnectionInterface $con, $forceIndividualSaves = false): ?int
    {
        // \Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior behavior
        // phpcs:ignoreFile
        /**
         * @var string|null $action
         */
        /** @var \Spryker\Zed\AclEntity\Business\AclEntityFacadeInterface $aclEntityFacade */
        $aclEntityFacade = \Spryker\Zed\Kernel\Locator::getInstance()->aclEntity()->facade();
        if ($aclEntityFacade->isActive() && !$this->isSegmentQuery()) {
            $aclEntityMetadataConfigRequestTransfer = new \Generated\Shared\Transfer\AclEntityMetadataConfigRequestTransfer();
            $aclEntityMetadataConfigRequestTransfer->setModelName($this->getModelName());
            $aclEntityConfigTransfer = $aclEntityFacade->getAclEntityMetadataConfig(true, $aclEntityMetadataConfigRequestTransfer);
            if (!in_array($this->getModelName(), $aclEntityConfigTransfer->getAclEntityAllowList())) {
                $this->getPersistenceFactory()
                    ->createAclQueryDirector($aclEntityConfigTransfer)
                    ->applyAclRuleOnUpdateQuery($this);
            }
        }


        return $this->preUpdate($values, $con, $forceIndividualSaves);
    }

    /**
     * Deletes all rows from the spy_sales_order_item table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderItemTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpySalesOrderItemTableMap::clearInstancePool();
            SpySalesOrderItemTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderItemTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpySalesOrderItemTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpySalesOrderItemTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpySalesOrderItemTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param int $nbDays Maximum age of the latest update in days
     *
     * @return $this The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        $this->addUsingAlias(SpySalesOrderItemTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpySalesOrderItemTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpySalesOrderItemTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpySalesOrderItemTableMap::COL_CREATED_AT);

        return $this;
    }

    /**
     * Filter by the latest created
     *
     * @param int $nbDays Maximum age of in days
     *
     * @return $this The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        $this->addUsingAlias(SpySalesOrderItemTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpySalesOrderItemTableMap::COL_CREATED_AT);

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
    // phpcs:ignoreFile
    /**
     * @return bool
     */
    protected function isSegmentQuery(): bool
    {
        $segmentTableTemplate = sprintf(
            \Spryker\Service\AclEntity\SegmentConnectorGenerator\SegmentConnectorGenerator::CONNECTOR_CLASS_TEMPLATE,
            \Spryker\Service\AclEntity\SegmentConnectorGenerator\SegmentConnectorGenerator::ENTITY_PREFIX_DEFAULT,
            ''
        );

        return strpos($this->getModelShortName(), $segmentTableTemplate) === 0;
    }

}
