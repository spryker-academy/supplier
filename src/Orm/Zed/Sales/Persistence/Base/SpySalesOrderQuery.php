<?php

namespace Orm\Zed\Sales\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\Locale\Persistence\SpyLocale;
use Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrder;
use Orm\Zed\Oms\Persistence\SpyOmsTransitionLog;
use Orm\Zed\Payment\Persistence\SpySalesPayment;
use Orm\Zed\Refund\Persistence\SpyRefund;
use Orm\Zed\SalesInvoice\Persistence\SpySalesOrderInvoice;
use Orm\Zed\SalesMerchantCommission\Persistence\SpySalesMerchantCommission;
use Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayout;
use Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversal;
use Orm\Zed\SalesReclamation\Persistence\SpySalesReclamation;
use Orm\Zed\Sales\Persistence\SpySalesOrder as ChildSpySalesOrder;
use Orm\Zed\Sales\Persistence\SpySalesOrderQuery as ChildSpySalesOrderQuery;
use Orm\Zed\Sales\Persistence\Map\SpySalesOrderTableMap;
use Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrder;
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
 * Base class that represents a query for the `spy_sales_order` table.
 *
 * @method     ChildSpySalesOrderQuery orderByIdSalesOrder($order = Criteria::ASC) Order by the id_sales_order column
 * @method     ChildSpySalesOrderQuery orderByFkLocale($order = Criteria::ASC) Order by the fk_locale column
 * @method     ChildSpySalesOrderQuery orderByFkSalesOrderAddressBilling($order = Criteria::ASC) Order by the fk_sales_order_address_billing column
 * @method     ChildSpySalesOrderQuery orderByFkSalesOrderAddressShipping($order = Criteria::ASC) Order by the fk_sales_order_address_shipping column
 * @method     ChildSpySalesOrderQuery orderByAgentEmail($order = Criteria::ASC) Order by the agent_email column
 * @method     ChildSpySalesOrderQuery orderByCartNote($order = Criteria::ASC) Order by the cart_note column
 * @method     ChildSpySalesOrderQuery orderByCompanyBusinessUnitUuid($order = Criteria::ASC) Order by the company_business_unit_uuid column
 * @method     ChildSpySalesOrderQuery orderByCompanyUuid($order = Criteria::ASC) Order by the company_uuid column
 * @method     ChildSpySalesOrderQuery orderByCurrencyIsoCode($order = Criteria::ASC) Order by the currency_iso_code column
 * @method     ChildSpySalesOrderQuery orderByCustomerReference($order = Criteria::ASC) Order by the customer_reference column
 * @method     ChildSpySalesOrderQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildSpySalesOrderQuery orderByFirstName($order = Criteria::ASC) Order by the first_name column
 * @method     ChildSpySalesOrderQuery orderByIsTest($order = Criteria::ASC) Order by the is_test column
 * @method     ChildSpySalesOrderQuery orderByLastName($order = Criteria::ASC) Order by the last_name column
 * @method     ChildSpySalesOrderQuery orderByOmsProcessorIdentifier($order = Criteria::ASC) Order by the oms_processor_identifier column
 * @method     ChildSpySalesOrderQuery orderByOrderCustomReference($order = Criteria::ASC) Order by the order_custom_reference column
 * @method     ChildSpySalesOrderQuery orderByOrderReference($order = Criteria::ASC) Order by the order_reference column
 * @method     ChildSpySalesOrderQuery orderByPriceMode($order = Criteria::ASC) Order by the price_mode column
 * @method     ChildSpySalesOrderQuery orderByQuoteRequestVersionReference($order = Criteria::ASC) Order by the quote_request_version_reference column
 * @method     ChildSpySalesOrderQuery orderBySalutation($order = Criteria::ASC) Order by the salutation column
 * @method     ChildSpySalesOrderQuery orderByStore($order = Criteria::ASC) Order by the store column
 * @method     ChildSpySalesOrderQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpySalesOrderQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpySalesOrderQuery groupByIdSalesOrder() Group by the id_sales_order column
 * @method     ChildSpySalesOrderQuery groupByFkLocale() Group by the fk_locale column
 * @method     ChildSpySalesOrderQuery groupByFkSalesOrderAddressBilling() Group by the fk_sales_order_address_billing column
 * @method     ChildSpySalesOrderQuery groupByFkSalesOrderAddressShipping() Group by the fk_sales_order_address_shipping column
 * @method     ChildSpySalesOrderQuery groupByAgentEmail() Group by the agent_email column
 * @method     ChildSpySalesOrderQuery groupByCartNote() Group by the cart_note column
 * @method     ChildSpySalesOrderQuery groupByCompanyBusinessUnitUuid() Group by the company_business_unit_uuid column
 * @method     ChildSpySalesOrderQuery groupByCompanyUuid() Group by the company_uuid column
 * @method     ChildSpySalesOrderQuery groupByCurrencyIsoCode() Group by the currency_iso_code column
 * @method     ChildSpySalesOrderQuery groupByCustomerReference() Group by the customer_reference column
 * @method     ChildSpySalesOrderQuery groupByEmail() Group by the email column
 * @method     ChildSpySalesOrderQuery groupByFirstName() Group by the first_name column
 * @method     ChildSpySalesOrderQuery groupByIsTest() Group by the is_test column
 * @method     ChildSpySalesOrderQuery groupByLastName() Group by the last_name column
 * @method     ChildSpySalesOrderQuery groupByOmsProcessorIdentifier() Group by the oms_processor_identifier column
 * @method     ChildSpySalesOrderQuery groupByOrderCustomReference() Group by the order_custom_reference column
 * @method     ChildSpySalesOrderQuery groupByOrderReference() Group by the order_reference column
 * @method     ChildSpySalesOrderQuery groupByPriceMode() Group by the price_mode column
 * @method     ChildSpySalesOrderQuery groupByQuoteRequestVersionReference() Group by the quote_request_version_reference column
 * @method     ChildSpySalesOrderQuery groupBySalutation() Group by the salutation column
 * @method     ChildSpySalesOrderQuery groupByStore() Group by the store column
 * @method     ChildSpySalesOrderQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpySalesOrderQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpySalesOrderQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpySalesOrderQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpySalesOrderQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpySalesOrderQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpySalesOrderQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpySalesOrderQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpySalesOrderQuery leftJoinBillingAddress($relationAlias = null) Adds a LEFT JOIN clause to the query using the BillingAddress relation
 * @method     ChildSpySalesOrderQuery rightJoinBillingAddress($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BillingAddress relation
 * @method     ChildSpySalesOrderQuery innerJoinBillingAddress($relationAlias = null) Adds a INNER JOIN clause to the query using the BillingAddress relation
 *
 * @method     ChildSpySalesOrderQuery joinWithBillingAddress($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BillingAddress relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinWithBillingAddress() Adds a LEFT JOIN clause and with to the query using the BillingAddress relation
 * @method     ChildSpySalesOrderQuery rightJoinWithBillingAddress() Adds a RIGHT JOIN clause and with to the query using the BillingAddress relation
 * @method     ChildSpySalesOrderQuery innerJoinWithBillingAddress() Adds a INNER JOIN clause and with to the query using the BillingAddress relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinShippingAddress($relationAlias = null) Adds a LEFT JOIN clause to the query using the ShippingAddress relation
 * @method     ChildSpySalesOrderQuery rightJoinShippingAddress($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ShippingAddress relation
 * @method     ChildSpySalesOrderQuery innerJoinShippingAddress($relationAlias = null) Adds a INNER JOIN clause to the query using the ShippingAddress relation
 *
 * @method     ChildSpySalesOrderQuery joinWithShippingAddress($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ShippingAddress relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinWithShippingAddress() Adds a LEFT JOIN clause and with to the query using the ShippingAddress relation
 * @method     ChildSpySalesOrderQuery rightJoinWithShippingAddress() Adds a RIGHT JOIN clause and with to the query using the ShippingAddress relation
 * @method     ChildSpySalesOrderQuery innerJoinWithShippingAddress() Adds a INNER JOIN clause and with to the query using the ShippingAddress relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinLocale($relationAlias = null) Adds a LEFT JOIN clause to the query using the Locale relation
 * @method     ChildSpySalesOrderQuery rightJoinLocale($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Locale relation
 * @method     ChildSpySalesOrderQuery innerJoinLocale($relationAlias = null) Adds a INNER JOIN clause to the query using the Locale relation
 *
 * @method     ChildSpySalesOrderQuery joinWithLocale($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Locale relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinWithLocale() Adds a LEFT JOIN clause and with to the query using the Locale relation
 * @method     ChildSpySalesOrderQuery rightJoinWithLocale() Adds a RIGHT JOIN clause and with to the query using the Locale relation
 * @method     ChildSpySalesOrderQuery innerJoinWithLocale() Adds a INNER JOIN clause and with to the query using the Locale relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinSpyMerchantSalesOrder($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchantSalesOrder relation
 * @method     ChildSpySalesOrderQuery rightJoinSpyMerchantSalesOrder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchantSalesOrder relation
 * @method     ChildSpySalesOrderQuery innerJoinSpyMerchantSalesOrder($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchantSalesOrder relation
 *
 * @method     ChildSpySalesOrderQuery joinWithSpyMerchantSalesOrder($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchantSalesOrder relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinWithSpyMerchantSalesOrder() Adds a LEFT JOIN clause and with to the query using the SpyMerchantSalesOrder relation
 * @method     ChildSpySalesOrderQuery rightJoinWithSpyMerchantSalesOrder() Adds a RIGHT JOIN clause and with to the query using the SpyMerchantSalesOrder relation
 * @method     ChildSpySalesOrderQuery innerJoinWithSpyMerchantSalesOrder() Adds a INNER JOIN clause and with to the query using the SpyMerchantSalesOrder relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinTransitionLog($relationAlias = null) Adds a LEFT JOIN clause to the query using the TransitionLog relation
 * @method     ChildSpySalesOrderQuery rightJoinTransitionLog($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TransitionLog relation
 * @method     ChildSpySalesOrderQuery innerJoinTransitionLog($relationAlias = null) Adds a INNER JOIN clause to the query using the TransitionLog relation
 *
 * @method     ChildSpySalesOrderQuery joinWithTransitionLog($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TransitionLog relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinWithTransitionLog() Adds a LEFT JOIN clause and with to the query using the TransitionLog relation
 * @method     ChildSpySalesOrderQuery rightJoinWithTransitionLog() Adds a RIGHT JOIN clause and with to the query using the TransitionLog relation
 * @method     ChildSpySalesOrderQuery innerJoinWithTransitionLog() Adds a INNER JOIN clause and with to the query using the TransitionLog relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinSpyRefund($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyRefund relation
 * @method     ChildSpySalesOrderQuery rightJoinSpyRefund($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyRefund relation
 * @method     ChildSpySalesOrderQuery innerJoinSpyRefund($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyRefund relation
 *
 * @method     ChildSpySalesOrderQuery joinWithSpyRefund($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyRefund relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinWithSpyRefund() Adds a LEFT JOIN clause and with to the query using the SpyRefund relation
 * @method     ChildSpySalesOrderQuery rightJoinWithSpyRefund() Adds a RIGHT JOIN clause and with to the query using the SpyRefund relation
 * @method     ChildSpySalesOrderQuery innerJoinWithSpyRefund() Adds a INNER JOIN clause and with to the query using the SpyRefund relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the Item relation
 * @method     ChildSpySalesOrderQuery rightJoinItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Item relation
 * @method     ChildSpySalesOrderQuery innerJoinItem($relationAlias = null) Adds a INNER JOIN clause to the query using the Item relation
 *
 * @method     ChildSpySalesOrderQuery joinWithItem($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Item relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinWithItem() Adds a LEFT JOIN clause and with to the query using the Item relation
 * @method     ChildSpySalesOrderQuery rightJoinWithItem() Adds a RIGHT JOIN clause and with to the query using the Item relation
 * @method     ChildSpySalesOrderQuery innerJoinWithItem() Adds a INNER JOIN clause and with to the query using the Item relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinDiscount($relationAlias = null) Adds a LEFT JOIN clause to the query using the Discount relation
 * @method     ChildSpySalesOrderQuery rightJoinDiscount($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Discount relation
 * @method     ChildSpySalesOrderQuery innerJoinDiscount($relationAlias = null) Adds a INNER JOIN clause to the query using the Discount relation
 *
 * @method     ChildSpySalesOrderQuery joinWithDiscount($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Discount relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinWithDiscount() Adds a LEFT JOIN clause and with to the query using the Discount relation
 * @method     ChildSpySalesOrderQuery rightJoinWithDiscount() Adds a RIGHT JOIN clause and with to the query using the Discount relation
 * @method     ChildSpySalesOrderQuery innerJoinWithDiscount() Adds a INNER JOIN clause and with to the query using the Discount relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinExpense($relationAlias = null) Adds a LEFT JOIN clause to the query using the Expense relation
 * @method     ChildSpySalesOrderQuery rightJoinExpense($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Expense relation
 * @method     ChildSpySalesOrderQuery innerJoinExpense($relationAlias = null) Adds a INNER JOIN clause to the query using the Expense relation
 *
 * @method     ChildSpySalesOrderQuery joinWithExpense($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Expense relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinWithExpense() Adds a LEFT JOIN clause and with to the query using the Expense relation
 * @method     ChildSpySalesOrderQuery rightJoinWithExpense() Adds a RIGHT JOIN clause and with to the query using the Expense relation
 * @method     ChildSpySalesOrderQuery innerJoinWithExpense() Adds a INNER JOIN clause and with to the query using the Expense relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinSpySalesShipment($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpySalesShipment relation
 * @method     ChildSpySalesOrderQuery rightJoinSpySalesShipment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpySalesShipment relation
 * @method     ChildSpySalesOrderQuery innerJoinSpySalesShipment($relationAlias = null) Adds a INNER JOIN clause to the query using the SpySalesShipment relation
 *
 * @method     ChildSpySalesOrderQuery joinWithSpySalesShipment($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpySalesShipment relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinWithSpySalesShipment() Adds a LEFT JOIN clause and with to the query using the SpySalesShipment relation
 * @method     ChildSpySalesOrderQuery rightJoinWithSpySalesShipment() Adds a RIGHT JOIN clause and with to the query using the SpySalesShipment relation
 * @method     ChildSpySalesOrderQuery innerJoinWithSpySalesShipment() Adds a INNER JOIN clause and with to the query using the SpySalesShipment relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinOrderTotal($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrderTotal relation
 * @method     ChildSpySalesOrderQuery rightJoinOrderTotal($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrderTotal relation
 * @method     ChildSpySalesOrderQuery innerJoinOrderTotal($relationAlias = null) Adds a INNER JOIN clause to the query using the OrderTotal relation
 *
 * @method     ChildSpySalesOrderQuery joinWithOrderTotal($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrderTotal relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinWithOrderTotal() Adds a LEFT JOIN clause and with to the query using the OrderTotal relation
 * @method     ChildSpySalesOrderQuery rightJoinWithOrderTotal() Adds a RIGHT JOIN clause and with to the query using the OrderTotal relation
 * @method     ChildSpySalesOrderQuery innerJoinWithOrderTotal() Adds a INNER JOIN clause and with to the query using the OrderTotal relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinNote($relationAlias = null) Adds a LEFT JOIN clause to the query using the Note relation
 * @method     ChildSpySalesOrderQuery rightJoinNote($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Note relation
 * @method     ChildSpySalesOrderQuery innerJoinNote($relationAlias = null) Adds a INNER JOIN clause to the query using the Note relation
 *
 * @method     ChildSpySalesOrderQuery joinWithNote($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Note relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinWithNote() Adds a LEFT JOIN clause and with to the query using the Note relation
 * @method     ChildSpySalesOrderQuery rightJoinWithNote() Adds a RIGHT JOIN clause and with to the query using the Note relation
 * @method     ChildSpySalesOrderQuery innerJoinWithNote() Adds a INNER JOIN clause and with to the query using the Note relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinOrderComment($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrderComment relation
 * @method     ChildSpySalesOrderQuery rightJoinOrderComment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrderComment relation
 * @method     ChildSpySalesOrderQuery innerJoinOrderComment($relationAlias = null) Adds a INNER JOIN clause to the query using the OrderComment relation
 *
 * @method     ChildSpySalesOrderQuery joinWithOrderComment($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrderComment relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinWithOrderComment() Adds a LEFT JOIN clause and with to the query using the OrderComment relation
 * @method     ChildSpySalesOrderQuery rightJoinWithOrderComment() Adds a RIGHT JOIN clause and with to the query using the OrderComment relation
 * @method     ChildSpySalesOrderQuery innerJoinWithOrderComment() Adds a INNER JOIN clause and with to the query using the OrderComment relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinSpySalesOrderInvoice($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpySalesOrderInvoice relation
 * @method     ChildSpySalesOrderQuery rightJoinSpySalesOrderInvoice($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpySalesOrderInvoice relation
 * @method     ChildSpySalesOrderQuery innerJoinSpySalesOrderInvoice($relationAlias = null) Adds a INNER JOIN clause to the query using the SpySalesOrderInvoice relation
 *
 * @method     ChildSpySalesOrderQuery joinWithSpySalesOrderInvoice($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpySalesOrderInvoice relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinWithSpySalesOrderInvoice() Adds a LEFT JOIN clause and with to the query using the SpySalesOrderInvoice relation
 * @method     ChildSpySalesOrderQuery rightJoinWithSpySalesOrderInvoice() Adds a RIGHT JOIN clause and with to the query using the SpySalesOrderInvoice relation
 * @method     ChildSpySalesOrderQuery innerJoinWithSpySalesOrderInvoice() Adds a INNER JOIN clause and with to the query using the SpySalesOrderInvoice relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinSpySalesMerchantCommission($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpySalesMerchantCommission relation
 * @method     ChildSpySalesOrderQuery rightJoinSpySalesMerchantCommission($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpySalesMerchantCommission relation
 * @method     ChildSpySalesOrderQuery innerJoinSpySalesMerchantCommission($relationAlias = null) Adds a INNER JOIN clause to the query using the SpySalesMerchantCommission relation
 *
 * @method     ChildSpySalesOrderQuery joinWithSpySalesMerchantCommission($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpySalesMerchantCommission relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinWithSpySalesMerchantCommission() Adds a LEFT JOIN clause and with to the query using the SpySalesMerchantCommission relation
 * @method     ChildSpySalesOrderQuery rightJoinWithSpySalesMerchantCommission() Adds a RIGHT JOIN clause and with to the query using the SpySalesMerchantCommission relation
 * @method     ChildSpySalesOrderQuery innerJoinWithSpySalesMerchantCommission() Adds a INNER JOIN clause and with to the query using the SpySalesMerchantCommission relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinOrder($relationAlias = null) Adds a LEFT JOIN clause to the query using the Order relation
 * @method     ChildSpySalesOrderQuery rightJoinOrder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Order relation
 * @method     ChildSpySalesOrderQuery innerJoinOrder($relationAlias = null) Adds a INNER JOIN clause to the query using the Order relation
 *
 * @method     ChildSpySalesOrderQuery joinWithOrder($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Order relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinWithOrder() Adds a LEFT JOIN clause and with to the query using the Order relation
 * @method     ChildSpySalesOrderQuery rightJoinWithOrder() Adds a RIGHT JOIN clause and with to the query using the Order relation
 * @method     ChildSpySalesOrderQuery innerJoinWithOrder() Adds a INNER JOIN clause and with to the query using the Order relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinSpySalesPaymentMerchantPayout($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpySalesPaymentMerchantPayout relation
 * @method     ChildSpySalesOrderQuery rightJoinSpySalesPaymentMerchantPayout($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpySalesPaymentMerchantPayout relation
 * @method     ChildSpySalesOrderQuery innerJoinSpySalesPaymentMerchantPayout($relationAlias = null) Adds a INNER JOIN clause to the query using the SpySalesPaymentMerchantPayout relation
 *
 * @method     ChildSpySalesOrderQuery joinWithSpySalesPaymentMerchantPayout($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpySalesPaymentMerchantPayout relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinWithSpySalesPaymentMerchantPayout() Adds a LEFT JOIN clause and with to the query using the SpySalesPaymentMerchantPayout relation
 * @method     ChildSpySalesOrderQuery rightJoinWithSpySalesPaymentMerchantPayout() Adds a RIGHT JOIN clause and with to the query using the SpySalesPaymentMerchantPayout relation
 * @method     ChildSpySalesOrderQuery innerJoinWithSpySalesPaymentMerchantPayout() Adds a INNER JOIN clause and with to the query using the SpySalesPaymentMerchantPayout relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinSpySalesPaymentMerchantPayoutReversal($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpySalesPaymentMerchantPayoutReversal relation
 * @method     ChildSpySalesOrderQuery rightJoinSpySalesPaymentMerchantPayoutReversal($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpySalesPaymentMerchantPayoutReversal relation
 * @method     ChildSpySalesOrderQuery innerJoinSpySalesPaymentMerchantPayoutReversal($relationAlias = null) Adds a INNER JOIN clause to the query using the SpySalesPaymentMerchantPayoutReversal relation
 *
 * @method     ChildSpySalesOrderQuery joinWithSpySalesPaymentMerchantPayoutReversal($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpySalesPaymentMerchantPayoutReversal relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinWithSpySalesPaymentMerchantPayoutReversal() Adds a LEFT JOIN clause and with to the query using the SpySalesPaymentMerchantPayoutReversal relation
 * @method     ChildSpySalesOrderQuery rightJoinWithSpySalesPaymentMerchantPayoutReversal() Adds a RIGHT JOIN clause and with to the query using the SpySalesPaymentMerchantPayoutReversal relation
 * @method     ChildSpySalesOrderQuery innerJoinWithSpySalesPaymentMerchantPayoutReversal() Adds a INNER JOIN clause and with to the query using the SpySalesPaymentMerchantPayoutReversal relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinReclamation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Reclamation relation
 * @method     ChildSpySalesOrderQuery rightJoinReclamation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Reclamation relation
 * @method     ChildSpySalesOrderQuery innerJoinReclamation($relationAlias = null) Adds a INNER JOIN clause to the query using the Reclamation relation
 *
 * @method     ChildSpySalesOrderQuery joinWithReclamation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Reclamation relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinWithReclamation() Adds a LEFT JOIN clause and with to the query using the Reclamation relation
 * @method     ChildSpySalesOrderQuery rightJoinWithReclamation() Adds a RIGHT JOIN clause and with to the query using the Reclamation relation
 * @method     ChildSpySalesOrderQuery innerJoinWithReclamation() Adds a INNER JOIN clause and with to the query using the Reclamation relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinSpySspInquirySalesOrder($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpySspInquirySalesOrder relation
 * @method     ChildSpySalesOrderQuery rightJoinSpySspInquirySalesOrder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpySspInquirySalesOrder relation
 * @method     ChildSpySalesOrderQuery innerJoinSpySspInquirySalesOrder($relationAlias = null) Adds a INNER JOIN clause to the query using the SpySspInquirySalesOrder relation
 *
 * @method     ChildSpySalesOrderQuery joinWithSpySspInquirySalesOrder($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpySspInquirySalesOrder relation
 *
 * @method     ChildSpySalesOrderQuery leftJoinWithSpySspInquirySalesOrder() Adds a LEFT JOIN clause and with to the query using the SpySspInquirySalesOrder relation
 * @method     ChildSpySalesOrderQuery rightJoinWithSpySspInquirySalesOrder() Adds a RIGHT JOIN clause and with to the query using the SpySspInquirySalesOrder relation
 * @method     ChildSpySalesOrderQuery innerJoinWithSpySspInquirySalesOrder() Adds a INNER JOIN clause and with to the query using the SpySspInquirySalesOrder relation
 *
 * @method     \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery|\Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery|\Orm\Zed\Locale\Persistence\SpyLocaleQuery|\Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderQuery|\Orm\Zed\Oms\Persistence\SpyOmsTransitionLogQuery|\Orm\Zed\Refund\Persistence\SpyRefundQuery|\Orm\Zed\Sales\Persistence\SpySalesOrderItemQuery|\Orm\Zed\Sales\Persistence\SpySalesDiscountQuery|\Orm\Zed\Sales\Persistence\SpySalesExpenseQuery|\Orm\Zed\Sales\Persistence\SpySalesShipmentQuery|\Orm\Zed\Sales\Persistence\SpySalesOrderTotalsQuery|\Orm\Zed\Sales\Persistence\SpySalesOrderNoteQuery|\Orm\Zed\Sales\Persistence\SpySalesOrderCommentQuery|\Orm\Zed\SalesInvoice\Persistence\SpySalesOrderInvoiceQuery|\Orm\Zed\SalesMerchantCommission\Persistence\SpySalesMerchantCommissionQuery|\Orm\Zed\Payment\Persistence\SpySalesPaymentQuery|\Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutQuery|\Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversalQuery|\Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationQuery|\Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpySalesOrder|null findOne(?ConnectionInterface $con = null) Return the first ChildSpySalesOrder matching the query
 * @method     ChildSpySalesOrder findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpySalesOrder matching the query, or a new ChildSpySalesOrder object populated from the query conditions when no match is found
 *
 * @method     ChildSpySalesOrder|null findOneByIdSalesOrder(int $id_sales_order) Return the first ChildSpySalesOrder filtered by the id_sales_order column
 * @method     ChildSpySalesOrder|null findOneByFkLocale(int $fk_locale) Return the first ChildSpySalesOrder filtered by the fk_locale column
 * @method     ChildSpySalesOrder|null findOneByFkSalesOrderAddressBilling(int $fk_sales_order_address_billing) Return the first ChildSpySalesOrder filtered by the fk_sales_order_address_billing column
 * @method     ChildSpySalesOrder|null findOneByFkSalesOrderAddressShipping(int $fk_sales_order_address_shipping) Return the first ChildSpySalesOrder filtered by the fk_sales_order_address_shipping column
 * @method     ChildSpySalesOrder|null findOneByAgentEmail(string $agent_email) Return the first ChildSpySalesOrder filtered by the agent_email column
 * @method     ChildSpySalesOrder|null findOneByCartNote(string $cart_note) Return the first ChildSpySalesOrder filtered by the cart_note column
 * @method     ChildSpySalesOrder|null findOneByCompanyBusinessUnitUuid(string $company_business_unit_uuid) Return the first ChildSpySalesOrder filtered by the company_business_unit_uuid column
 * @method     ChildSpySalesOrder|null findOneByCompanyUuid(string $company_uuid) Return the first ChildSpySalesOrder filtered by the company_uuid column
 * @method     ChildSpySalesOrder|null findOneByCurrencyIsoCode(string $currency_iso_code) Return the first ChildSpySalesOrder filtered by the currency_iso_code column
 * @method     ChildSpySalesOrder|null findOneByCustomerReference(string $customer_reference) Return the first ChildSpySalesOrder filtered by the customer_reference column
 * @method     ChildSpySalesOrder|null findOneByEmail(string $email) Return the first ChildSpySalesOrder filtered by the email column
 * @method     ChildSpySalesOrder|null findOneByFirstName(string $first_name) Return the first ChildSpySalesOrder filtered by the first_name column
 * @method     ChildSpySalesOrder|null findOneByIsTest(boolean $is_test) Return the first ChildSpySalesOrder filtered by the is_test column
 * @method     ChildSpySalesOrder|null findOneByLastName(string $last_name) Return the first ChildSpySalesOrder filtered by the last_name column
 * @method     ChildSpySalesOrder|null findOneByOmsProcessorIdentifier(int $oms_processor_identifier) Return the first ChildSpySalesOrder filtered by the oms_processor_identifier column
 * @method     ChildSpySalesOrder|null findOneByOrderCustomReference(string $order_custom_reference) Return the first ChildSpySalesOrder filtered by the order_custom_reference column
 * @method     ChildSpySalesOrder|null findOneByOrderReference(string $order_reference) Return the first ChildSpySalesOrder filtered by the order_reference column
 * @method     ChildSpySalesOrder|null findOneByPriceMode(int $price_mode) Return the first ChildSpySalesOrder filtered by the price_mode column
 * @method     ChildSpySalesOrder|null findOneByQuoteRequestVersionReference(string $quote_request_version_reference) Return the first ChildSpySalesOrder filtered by the quote_request_version_reference column
 * @method     ChildSpySalesOrder|null findOneBySalutation(int $salutation) Return the first ChildSpySalesOrder filtered by the salutation column
 * @method     ChildSpySalesOrder|null findOneByStore(string $store) Return the first ChildSpySalesOrder filtered by the store column
 * @method     ChildSpySalesOrder|null findOneByCreatedAt(string $created_at) Return the first ChildSpySalesOrder filtered by the created_at column
 * @method     ChildSpySalesOrder|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpySalesOrder filtered by the updated_at column
 *
 * @method     ChildSpySalesOrder requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpySalesOrder by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrder requireOne(?ConnectionInterface $con = null) Return the first ChildSpySalesOrder matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpySalesOrder requireOneByIdSalesOrder(int $id_sales_order) Return the first ChildSpySalesOrder filtered by the id_sales_order column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrder requireOneByFkLocale(int $fk_locale) Return the first ChildSpySalesOrder filtered by the fk_locale column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrder requireOneByFkSalesOrderAddressBilling(int $fk_sales_order_address_billing) Return the first ChildSpySalesOrder filtered by the fk_sales_order_address_billing column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrder requireOneByFkSalesOrderAddressShipping(int $fk_sales_order_address_shipping) Return the first ChildSpySalesOrder filtered by the fk_sales_order_address_shipping column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrder requireOneByAgentEmail(string $agent_email) Return the first ChildSpySalesOrder filtered by the agent_email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrder requireOneByCartNote(string $cart_note) Return the first ChildSpySalesOrder filtered by the cart_note column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrder requireOneByCompanyBusinessUnitUuid(string $company_business_unit_uuid) Return the first ChildSpySalesOrder filtered by the company_business_unit_uuid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrder requireOneByCompanyUuid(string $company_uuid) Return the first ChildSpySalesOrder filtered by the company_uuid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrder requireOneByCurrencyIsoCode(string $currency_iso_code) Return the first ChildSpySalesOrder filtered by the currency_iso_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrder requireOneByCustomerReference(string $customer_reference) Return the first ChildSpySalesOrder filtered by the customer_reference column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrder requireOneByEmail(string $email) Return the first ChildSpySalesOrder filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrder requireOneByFirstName(string $first_name) Return the first ChildSpySalesOrder filtered by the first_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrder requireOneByIsTest(boolean $is_test) Return the first ChildSpySalesOrder filtered by the is_test column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrder requireOneByLastName(string $last_name) Return the first ChildSpySalesOrder filtered by the last_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrder requireOneByOmsProcessorIdentifier(int $oms_processor_identifier) Return the first ChildSpySalesOrder filtered by the oms_processor_identifier column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrder requireOneByOrderCustomReference(string $order_custom_reference) Return the first ChildSpySalesOrder filtered by the order_custom_reference column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrder requireOneByOrderReference(string $order_reference) Return the first ChildSpySalesOrder filtered by the order_reference column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrder requireOneByPriceMode(int $price_mode) Return the first ChildSpySalesOrder filtered by the price_mode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrder requireOneByQuoteRequestVersionReference(string $quote_request_version_reference) Return the first ChildSpySalesOrder filtered by the quote_request_version_reference column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrder requireOneBySalutation(int $salutation) Return the first ChildSpySalesOrder filtered by the salutation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrder requireOneByStore(string $store) Return the first ChildSpySalesOrder filtered by the store column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrder requireOneByCreatedAt(string $created_at) Return the first ChildSpySalesOrder filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrder requireOneByUpdatedAt(string $updated_at) Return the first ChildSpySalesOrder filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpySalesOrder[]|Collection find(?ConnectionInterface $con = null) Return ChildSpySalesOrder objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpySalesOrder> find(?ConnectionInterface $con = null) Return ChildSpySalesOrder objects based on current ModelCriteria
 *
 * @method     ChildSpySalesOrder[]|Collection findByIdSalesOrder(int|array<int> $id_sales_order) Return ChildSpySalesOrder objects filtered by the id_sales_order column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrder> findByIdSalesOrder(int|array<int> $id_sales_order) Return ChildSpySalesOrder objects filtered by the id_sales_order column
 * @method     ChildSpySalesOrder[]|Collection findByFkLocale(int|array<int> $fk_locale) Return ChildSpySalesOrder objects filtered by the fk_locale column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrder> findByFkLocale(int|array<int> $fk_locale) Return ChildSpySalesOrder objects filtered by the fk_locale column
 * @method     ChildSpySalesOrder[]|Collection findByFkSalesOrderAddressBilling(int|array<int> $fk_sales_order_address_billing) Return ChildSpySalesOrder objects filtered by the fk_sales_order_address_billing column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrder> findByFkSalesOrderAddressBilling(int|array<int> $fk_sales_order_address_billing) Return ChildSpySalesOrder objects filtered by the fk_sales_order_address_billing column
 * @method     ChildSpySalesOrder[]|Collection findByFkSalesOrderAddressShipping(int|array<int> $fk_sales_order_address_shipping) Return ChildSpySalesOrder objects filtered by the fk_sales_order_address_shipping column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrder> findByFkSalesOrderAddressShipping(int|array<int> $fk_sales_order_address_shipping) Return ChildSpySalesOrder objects filtered by the fk_sales_order_address_shipping column
 * @method     ChildSpySalesOrder[]|Collection findByAgentEmail(string|array<string> $agent_email) Return ChildSpySalesOrder objects filtered by the agent_email column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrder> findByAgentEmail(string|array<string> $agent_email) Return ChildSpySalesOrder objects filtered by the agent_email column
 * @method     ChildSpySalesOrder[]|Collection findByCartNote(string|array<string> $cart_note) Return ChildSpySalesOrder objects filtered by the cart_note column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrder> findByCartNote(string|array<string> $cart_note) Return ChildSpySalesOrder objects filtered by the cart_note column
 * @method     ChildSpySalesOrder[]|Collection findByCompanyBusinessUnitUuid(string|array<string> $company_business_unit_uuid) Return ChildSpySalesOrder objects filtered by the company_business_unit_uuid column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrder> findByCompanyBusinessUnitUuid(string|array<string> $company_business_unit_uuid) Return ChildSpySalesOrder objects filtered by the company_business_unit_uuid column
 * @method     ChildSpySalesOrder[]|Collection findByCompanyUuid(string|array<string> $company_uuid) Return ChildSpySalesOrder objects filtered by the company_uuid column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrder> findByCompanyUuid(string|array<string> $company_uuid) Return ChildSpySalesOrder objects filtered by the company_uuid column
 * @method     ChildSpySalesOrder[]|Collection findByCurrencyIsoCode(string|array<string> $currency_iso_code) Return ChildSpySalesOrder objects filtered by the currency_iso_code column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrder> findByCurrencyIsoCode(string|array<string> $currency_iso_code) Return ChildSpySalesOrder objects filtered by the currency_iso_code column
 * @method     ChildSpySalesOrder[]|Collection findByCustomerReference(string|array<string> $customer_reference) Return ChildSpySalesOrder objects filtered by the customer_reference column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrder> findByCustomerReference(string|array<string> $customer_reference) Return ChildSpySalesOrder objects filtered by the customer_reference column
 * @method     ChildSpySalesOrder[]|Collection findByEmail(string|array<string> $email) Return ChildSpySalesOrder objects filtered by the email column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrder> findByEmail(string|array<string> $email) Return ChildSpySalesOrder objects filtered by the email column
 * @method     ChildSpySalesOrder[]|Collection findByFirstName(string|array<string> $first_name) Return ChildSpySalesOrder objects filtered by the first_name column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrder> findByFirstName(string|array<string> $first_name) Return ChildSpySalesOrder objects filtered by the first_name column
 * @method     ChildSpySalesOrder[]|Collection findByIsTest(boolean|array<boolean> $is_test) Return ChildSpySalesOrder objects filtered by the is_test column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrder> findByIsTest(boolean|array<boolean> $is_test) Return ChildSpySalesOrder objects filtered by the is_test column
 * @method     ChildSpySalesOrder[]|Collection findByLastName(string|array<string> $last_name) Return ChildSpySalesOrder objects filtered by the last_name column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrder> findByLastName(string|array<string> $last_name) Return ChildSpySalesOrder objects filtered by the last_name column
 * @method     ChildSpySalesOrder[]|Collection findByOmsProcessorIdentifier(int|array<int> $oms_processor_identifier) Return ChildSpySalesOrder objects filtered by the oms_processor_identifier column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrder> findByOmsProcessorIdentifier(int|array<int> $oms_processor_identifier) Return ChildSpySalesOrder objects filtered by the oms_processor_identifier column
 * @method     ChildSpySalesOrder[]|Collection findByOrderCustomReference(string|array<string> $order_custom_reference) Return ChildSpySalesOrder objects filtered by the order_custom_reference column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrder> findByOrderCustomReference(string|array<string> $order_custom_reference) Return ChildSpySalesOrder objects filtered by the order_custom_reference column
 * @method     ChildSpySalesOrder[]|Collection findByOrderReference(string|array<string> $order_reference) Return ChildSpySalesOrder objects filtered by the order_reference column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrder> findByOrderReference(string|array<string> $order_reference) Return ChildSpySalesOrder objects filtered by the order_reference column
 * @method     ChildSpySalesOrder[]|Collection findByPriceMode(int|array<int> $price_mode) Return ChildSpySalesOrder objects filtered by the price_mode column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrder> findByPriceMode(int|array<int> $price_mode) Return ChildSpySalesOrder objects filtered by the price_mode column
 * @method     ChildSpySalesOrder[]|Collection findByQuoteRequestVersionReference(string|array<string> $quote_request_version_reference) Return ChildSpySalesOrder objects filtered by the quote_request_version_reference column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrder> findByQuoteRequestVersionReference(string|array<string> $quote_request_version_reference) Return ChildSpySalesOrder objects filtered by the quote_request_version_reference column
 * @method     ChildSpySalesOrder[]|Collection findBySalutation(int|array<int> $salutation) Return ChildSpySalesOrder objects filtered by the salutation column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrder> findBySalutation(int|array<int> $salutation) Return ChildSpySalesOrder objects filtered by the salutation column
 * @method     ChildSpySalesOrder[]|Collection findByStore(string|array<string> $store) Return ChildSpySalesOrder objects filtered by the store column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrder> findByStore(string|array<string> $store) Return ChildSpySalesOrder objects filtered by the store column
 * @method     ChildSpySalesOrder[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpySalesOrder objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrder> findByCreatedAt(string|array<string> $created_at) Return ChildSpySalesOrder objects filtered by the created_at column
 * @method     ChildSpySalesOrder[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpySalesOrder objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrder> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpySalesOrder objects filtered by the updated_at column
 *
 * @method     ChildSpySalesOrder[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpySalesOrder> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpySalesOrderQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\Sales\Persistence\Base\SpySalesOrderQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrder', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpySalesOrderQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpySalesOrderQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpySalesOrderQuery) {
            return $criteria;
        }
        $query = new ChildSpySalesOrderQuery();
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
     * @return ChildSpySalesOrder|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpySalesOrderTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpySalesOrder A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_sales_order, fk_locale, fk_sales_order_address_billing, fk_sales_order_address_shipping, agent_email, cart_note, company_business_unit_uuid, company_uuid, currency_iso_code, customer_reference, email, first_name, is_test, last_name, oms_processor_identifier, order_custom_reference, order_reference, price_mode, quote_request_version_reference, salutation, store, created_at, updated_at FROM spy_sales_order WHERE id_sales_order = :p0';
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
            /** @var ChildSpySalesOrder $obj */
            $obj = new ChildSpySalesOrder();
            $obj->hydrate($row);
            SpySalesOrderTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpySalesOrder|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpySalesOrderTableMap::COL_ID_SALES_ORDER, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpySalesOrderTableMap::COL_ID_SALES_ORDER, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idSalesOrder Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdSalesOrder_Between(array $idSalesOrder)
    {
        return $this->filterByIdSalesOrder($idSalesOrder, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idSalesOrders Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdSalesOrder_In(array $idSalesOrders)
    {
        return $this->filterByIdSalesOrder($idSalesOrders, Criteria::IN);
    }

    /**
     * Filter the query on the id_sales_order column
     *
     * Example usage:
     * <code>
     * $query->filterByIdSalesOrder(1234); // WHERE id_sales_order = 1234
     * $query->filterByIdSalesOrder(array(12, 34), Criteria::IN); // WHERE id_sales_order IN (12, 34)
     * $query->filterByIdSalesOrder(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_sales_order > 12
     * </code>
     *
     * @param     mixed $idSalesOrder The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdSalesOrder($idSalesOrder = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idSalesOrder)) {
            $useMinMax = false;
            if (isset($idSalesOrder['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderTableMap::COL_ID_SALES_ORDER, $idSalesOrder['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idSalesOrder['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderTableMap::COL_ID_SALES_ORDER, $idSalesOrder['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idSalesOrder of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderTableMap::COL_ID_SALES_ORDER, $idSalesOrder, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkLocale Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkLocale_Between(array $fkLocale)
    {
        return $this->filterByFkLocale($fkLocale, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkLocales Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkLocale_In(array $fkLocales)
    {
        return $this->filterByFkLocale($fkLocales, Criteria::IN);
    }

    /**
     * Filter the query on the fk_locale column
     *
     * Example usage:
     * <code>
     * $query->filterByFkLocale(1234); // WHERE fk_locale = 1234
     * $query->filterByFkLocale(array(12, 34), Criteria::IN); // WHERE fk_locale IN (12, 34)
     * $query->filterByFkLocale(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_locale > 12
     * </code>
     *
     * @see       filterByLocale()
     *
     * @param     mixed $fkLocale The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkLocale($fkLocale = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkLocale)) {
            $useMinMax = false;
            if (isset($fkLocale['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderTableMap::COL_FK_LOCALE, $fkLocale['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkLocale['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderTableMap::COL_FK_LOCALE, $fkLocale['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkLocale of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderTableMap::COL_FK_LOCALE, $fkLocale, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkSalesOrderAddressBilling Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkSalesOrderAddressBilling_Between(array $fkSalesOrderAddressBilling)
    {
        return $this->filterByFkSalesOrderAddressBilling($fkSalesOrderAddressBilling, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkSalesOrderAddressBillings Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkSalesOrderAddressBilling_In(array $fkSalesOrderAddressBillings)
    {
        return $this->filterByFkSalesOrderAddressBilling($fkSalesOrderAddressBillings, Criteria::IN);
    }

    /**
     * Filter the query on the fk_sales_order_address_billing column
     *
     * Example usage:
     * <code>
     * $query->filterByFkSalesOrderAddressBilling(1234); // WHERE fk_sales_order_address_billing = 1234
     * $query->filterByFkSalesOrderAddressBilling(array(12, 34), Criteria::IN); // WHERE fk_sales_order_address_billing IN (12, 34)
     * $query->filterByFkSalesOrderAddressBilling(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_sales_order_address_billing > 12
     * </code>
     *
     * @see       filterByBillingAddress()
     *
     * @param     mixed $fkSalesOrderAddressBilling The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkSalesOrderAddressBilling($fkSalesOrderAddressBilling = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkSalesOrderAddressBilling)) {
            $useMinMax = false;
            if (isset($fkSalesOrderAddressBilling['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderTableMap::COL_FK_SALES_ORDER_ADDRESS_BILLING, $fkSalesOrderAddressBilling['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkSalesOrderAddressBilling['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderTableMap::COL_FK_SALES_ORDER_ADDRESS_BILLING, $fkSalesOrderAddressBilling['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkSalesOrderAddressBilling of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderTableMap::COL_FK_SALES_ORDER_ADDRESS_BILLING, $fkSalesOrderAddressBilling, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkSalesOrderAddressShipping Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkSalesOrderAddressShipping_Between(array $fkSalesOrderAddressShipping)
    {
        return $this->filterByFkSalesOrderAddressShipping($fkSalesOrderAddressShipping, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkSalesOrderAddressShippings Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkSalesOrderAddressShipping_In(array $fkSalesOrderAddressShippings)
    {
        return $this->filterByFkSalesOrderAddressShipping($fkSalesOrderAddressShippings, Criteria::IN);
    }

    /**
     * Filter the query on the fk_sales_order_address_shipping column
     *
     * Example usage:
     * <code>
     * $query->filterByFkSalesOrderAddressShipping(1234); // WHERE fk_sales_order_address_shipping = 1234
     * $query->filterByFkSalesOrderAddressShipping(array(12, 34), Criteria::IN); // WHERE fk_sales_order_address_shipping IN (12, 34)
     * $query->filterByFkSalesOrderAddressShipping(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_sales_order_address_shipping > 12
     * </code>
     *
     * @see       filterByShippingAddress()
     *
     * @param     mixed $fkSalesOrderAddressShipping The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkSalesOrderAddressShipping($fkSalesOrderAddressShipping = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkSalesOrderAddressShipping)) {
            $useMinMax = false;
            if (isset($fkSalesOrderAddressShipping['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderTableMap::COL_FK_SALES_ORDER_ADDRESS_SHIPPING, $fkSalesOrderAddressShipping['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkSalesOrderAddressShipping['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderTableMap::COL_FK_SALES_ORDER_ADDRESS_SHIPPING, $fkSalesOrderAddressShipping['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkSalesOrderAddressShipping of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderTableMap::COL_FK_SALES_ORDER_ADDRESS_SHIPPING, $fkSalesOrderAddressShipping, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $agentEmails Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAgentEmail_In(array $agentEmails)
    {
        return $this->filterByAgentEmail($agentEmails, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $agentEmail Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAgentEmail_Like($agentEmail)
    {
        return $this->filterByAgentEmail($agentEmail, Criteria::LIKE);
    }

    /**
     * Filter the query on the agent_email column
     *
     * Example usage:
     * <code>
     * $query->filterByAgentEmail('fooValue');   // WHERE agent_email = 'fooValue'
     * $query->filterByAgentEmail('%fooValue%', Criteria::LIKE); // WHERE agent_email LIKE '%fooValue%'
     * $query->filterByAgentEmail([1, 'foo'], Criteria::IN); // WHERE agent_email IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $agentEmail The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAgentEmail($agentEmail = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $agentEmail = str_replace('*', '%', $agentEmail);
        }

        if (is_array($agentEmail) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$agentEmail of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderTableMap::COL_AGENT_EMAIL, $agentEmail, $comparison);

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

        $query = $this->addUsingAlias(SpySalesOrderTableMap::COL_CART_NOTE, $cartNote, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $companyBusinessUnitUuids Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompanyBusinessUnitUuid_In(array $companyBusinessUnitUuids)
    {
        return $this->filterByCompanyBusinessUnitUuid($companyBusinessUnitUuids, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $companyBusinessUnitUuid Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompanyBusinessUnitUuid_Like($companyBusinessUnitUuid)
    {
        return $this->filterByCompanyBusinessUnitUuid($companyBusinessUnitUuid, Criteria::LIKE);
    }

    /**
     * Filter the query on the company_business_unit_uuid column
     *
     * Example usage:
     * <code>
     * $query->filterByCompanyBusinessUnitUuid('fooValue');   // WHERE company_business_unit_uuid = 'fooValue'
     * $query->filterByCompanyBusinessUnitUuid('%fooValue%', Criteria::LIKE); // WHERE company_business_unit_uuid LIKE '%fooValue%'
     * $query->filterByCompanyBusinessUnitUuid([1, 'foo'], Criteria::IN); // WHERE company_business_unit_uuid IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $companyBusinessUnitUuid The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByCompanyBusinessUnitUuid($companyBusinessUnitUuid = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $companyBusinessUnitUuid = str_replace('*', '%', $companyBusinessUnitUuid);
        }

        if (is_array($companyBusinessUnitUuid) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$companyBusinessUnitUuid of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderTableMap::COL_COMPANY_BUSINESS_UNIT_UUID, $companyBusinessUnitUuid, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $companyUuids Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompanyUuid_In(array $companyUuids)
    {
        return $this->filterByCompanyUuid($companyUuids, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $companyUuid Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompanyUuid_Like($companyUuid)
    {
        return $this->filterByCompanyUuid($companyUuid, Criteria::LIKE);
    }

    /**
     * Filter the query on the company_uuid column
     *
     * Example usage:
     * <code>
     * $query->filterByCompanyUuid('fooValue');   // WHERE company_uuid = 'fooValue'
     * $query->filterByCompanyUuid('%fooValue%', Criteria::LIKE); // WHERE company_uuid LIKE '%fooValue%'
     * $query->filterByCompanyUuid([1, 'foo'], Criteria::IN); // WHERE company_uuid IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $companyUuid The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByCompanyUuid($companyUuid = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $companyUuid = str_replace('*', '%', $companyUuid);
        }

        if (is_array($companyUuid) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$companyUuid of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderTableMap::COL_COMPANY_UUID, $companyUuid, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $currencyIsoCodes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCurrencyIsoCode_In(array $currencyIsoCodes)
    {
        return $this->filterByCurrencyIsoCode($currencyIsoCodes, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $currencyIsoCode Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCurrencyIsoCode_Like($currencyIsoCode)
    {
        return $this->filterByCurrencyIsoCode($currencyIsoCode, Criteria::LIKE);
    }

    /**
     * Filter the query on the currency_iso_code column
     *
     * Example usage:
     * <code>
     * $query->filterByCurrencyIsoCode('fooValue');   // WHERE currency_iso_code = 'fooValue'
     * $query->filterByCurrencyIsoCode('%fooValue%', Criteria::LIKE); // WHERE currency_iso_code LIKE '%fooValue%'
     * $query->filterByCurrencyIsoCode([1, 'foo'], Criteria::IN); // WHERE currency_iso_code IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $currencyIsoCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByCurrencyIsoCode($currencyIsoCode = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $currencyIsoCode = str_replace('*', '%', $currencyIsoCode);
        }

        if (is_array($currencyIsoCode) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$currencyIsoCode of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderTableMap::COL_CURRENCY_ISO_CODE, $currencyIsoCode, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $customerReferences Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCustomerReference_In(array $customerReferences)
    {
        return $this->filterByCustomerReference($customerReferences, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $customerReference Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCustomerReference_Like($customerReference)
    {
        return $this->filterByCustomerReference($customerReference, Criteria::LIKE);
    }

    /**
     * Filter the query on the customer_reference column
     *
     * Example usage:
     * <code>
     * $query->filterByCustomerReference('fooValue');   // WHERE customer_reference = 'fooValue'
     * $query->filterByCustomerReference('%fooValue%', Criteria::LIKE); // WHERE customer_reference LIKE '%fooValue%'
     * $query->filterByCustomerReference([1, 'foo'], Criteria::IN); // WHERE customer_reference IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $customerReference The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByCustomerReference($customerReference = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $customerReference = str_replace('*', '%', $customerReference);
        }

        if (is_array($customerReference) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$customerReference of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderTableMap::COL_CUSTOMER_REFERENCE, $customerReference, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $emails Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmail_In(array $emails)
    {
        return $this->filterByEmail($emails, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $email Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmail_Like($email)
    {
        return $this->filterByEmail($email, Criteria::LIKE);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE email LIKE '%fooValue%'
     * $query->filterByEmail([1, 'foo'], Criteria::IN); // WHERE email IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $email The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByEmail($email = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $email = str_replace('*', '%', $email);
        }

        if (is_array($email) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$email of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderTableMap::COL_EMAIL, $email, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $firstNames Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFirstName_In(array $firstNames)
    {
        return $this->filterByFirstName($firstNames, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $firstName Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFirstName_Like($firstName)
    {
        return $this->filterByFirstName($firstName, Criteria::LIKE);
    }

    /**
     * Filter the query on the first_name column
     *
     * Example usage:
     * <code>
     * $query->filterByFirstName('fooValue');   // WHERE first_name = 'fooValue'
     * $query->filterByFirstName('%fooValue%', Criteria::LIKE); // WHERE first_name LIKE '%fooValue%'
     * $query->filterByFirstName([1, 'foo'], Criteria::IN); // WHERE first_name IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $firstName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFirstName($firstName = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $firstName = str_replace('*', '%', $firstName);
        }

        if (is_array($firstName) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$firstName of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderTableMap::COL_FIRST_NAME, $firstName, $comparison);

        return $query;
    }

    /**
     * Filter the query on the is_test column
     *
     * Example usage:
     * <code>
     * $query->filterByIsTest(true); // WHERE is_test = true
     * $query->filterByIsTest('yes'); // WHERE is_test = true
     * </code>
     *
     * @param     bool|string $isTest The value to use as filter.
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
    public function filterByIsTest($isTest = null, $comparison = Criteria::EQUAL)
    {
        if (is_string($isTest)) {
            $isTest = in_array(strtolower($isTest), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $query = $this->addUsingAlias(SpySalesOrderTableMap::COL_IS_TEST, $isTest, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $lastNames Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLastName_In(array $lastNames)
    {
        return $this->filterByLastName($lastNames, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $lastName Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLastName_Like($lastName)
    {
        return $this->filterByLastName($lastName, Criteria::LIKE);
    }

    /**
     * Filter the query on the last_name column
     *
     * Example usage:
     * <code>
     * $query->filterByLastName('fooValue');   // WHERE last_name = 'fooValue'
     * $query->filterByLastName('%fooValue%', Criteria::LIKE); // WHERE last_name LIKE '%fooValue%'
     * $query->filterByLastName([1, 'foo'], Criteria::IN); // WHERE last_name IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $lastName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByLastName($lastName = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $lastName = str_replace('*', '%', $lastName);
        }

        if (is_array($lastName) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$lastName of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderTableMap::COL_LAST_NAME, $lastName, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $omsProcessorIdentifier Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOmsProcessorIdentifier_Between(array $omsProcessorIdentifier)
    {
        return $this->filterByOmsProcessorIdentifier($omsProcessorIdentifier, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $omsProcessorIdentifiers Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOmsProcessorIdentifier_In(array $omsProcessorIdentifiers)
    {
        return $this->filterByOmsProcessorIdentifier($omsProcessorIdentifiers, Criteria::IN);
    }

    /**
     * Filter the query on the oms_processor_identifier column
     *
     * Example usage:
     * <code>
     * $query->filterByOmsProcessorIdentifier(1234); // WHERE oms_processor_identifier = 1234
     * $query->filterByOmsProcessorIdentifier(array(12, 34), Criteria::IN); // WHERE oms_processor_identifier IN (12, 34)
     * $query->filterByOmsProcessorIdentifier(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE oms_processor_identifier > 12
     * </code>
     *
     * @param     mixed $omsProcessorIdentifier The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByOmsProcessorIdentifier($omsProcessorIdentifier = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($omsProcessorIdentifier)) {
            $useMinMax = false;
            if (isset($omsProcessorIdentifier['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderTableMap::COL_OMS_PROCESSOR_IDENTIFIER, $omsProcessorIdentifier['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($omsProcessorIdentifier['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderTableMap::COL_OMS_PROCESSOR_IDENTIFIER, $omsProcessorIdentifier['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$omsProcessorIdentifier of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderTableMap::COL_OMS_PROCESSOR_IDENTIFIER, $omsProcessorIdentifier, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $orderCustomReferences Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderCustomReference_In(array $orderCustomReferences)
    {
        return $this->filterByOrderCustomReference($orderCustomReferences, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $orderCustomReference Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderCustomReference_Like($orderCustomReference)
    {
        return $this->filterByOrderCustomReference($orderCustomReference, Criteria::LIKE);
    }

    /**
     * Filter the query on the order_custom_reference column
     *
     * Example usage:
     * <code>
     * $query->filterByOrderCustomReference('fooValue');   // WHERE order_custom_reference = 'fooValue'
     * $query->filterByOrderCustomReference('%fooValue%', Criteria::LIKE); // WHERE order_custom_reference LIKE '%fooValue%'
     * $query->filterByOrderCustomReference([1, 'foo'], Criteria::IN); // WHERE order_custom_reference IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $orderCustomReference The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByOrderCustomReference($orderCustomReference = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $orderCustomReference = str_replace('*', '%', $orderCustomReference);
        }

        if (is_array($orderCustomReference) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$orderCustomReference of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderTableMap::COL_ORDER_CUSTOM_REFERENCE, $orderCustomReference, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $orderReferences Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderReference_In(array $orderReferences)
    {
        return $this->filterByOrderReference($orderReferences, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $orderReference Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderReference_Like($orderReference)
    {
        return $this->filterByOrderReference($orderReference, Criteria::LIKE);
    }

    /**
     * Filter the query on the order_reference column
     *
     * Example usage:
     * <code>
     * $query->filterByOrderReference('fooValue');   // WHERE order_reference = 'fooValue'
     * $query->filterByOrderReference('%fooValue%', Criteria::LIKE); // WHERE order_reference LIKE '%fooValue%'
     * $query->filterByOrderReference([1, 'foo'], Criteria::IN); // WHERE order_reference IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $orderReference The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByOrderReference($orderReference = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $orderReference = str_replace('*', '%', $orderReference);
        }

        if (is_array($orderReference) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$orderReference of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderTableMap::COL_ORDER_REFERENCE, $orderReference, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $priceModes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPriceMode_In(array $priceModes)
    {
        return $this->filterByPriceMode($priceModes, Criteria::IN);
    }

    /**
     * Filter the query on the price_mode column
     *
     * @param     mixed $priceMode The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByPriceMode($priceMode = null, $comparison = Criteria::EQUAL)
    {
        $valueSet = SpySalesOrderTableMap::getValueSet(SpySalesOrderTableMap::COL_PRICE_MODE);
        if (is_scalar($priceMode)) {
            if (!in_array($priceMode, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $priceMode));
            }
            $priceMode = array_search($priceMode, $valueSet);
        } elseif (is_array($priceMode)) {
            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
            $convertedValues = array();
            foreach ($priceMode as $value) {
                if (!in_array($value, $valueSet)) {
                    throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $value));
                }
                $convertedValues []= array_search($value, $valueSet);
            }
            $priceMode = $convertedValues;
        }

        $query = $this->addUsingAlias(SpySalesOrderTableMap::COL_PRICE_MODE, $priceMode, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $quoteRequestVersionReferences Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByQuoteRequestVersionReference_In(array $quoteRequestVersionReferences)
    {
        return $this->filterByQuoteRequestVersionReference($quoteRequestVersionReferences, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $quoteRequestVersionReference Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByQuoteRequestVersionReference_Like($quoteRequestVersionReference)
    {
        return $this->filterByQuoteRequestVersionReference($quoteRequestVersionReference, Criteria::LIKE);
    }

    /**
     * Filter the query on the quote_request_version_reference column
     *
     * Example usage:
     * <code>
     * $query->filterByQuoteRequestVersionReference('fooValue');   // WHERE quote_request_version_reference = 'fooValue'
     * $query->filterByQuoteRequestVersionReference('%fooValue%', Criteria::LIKE); // WHERE quote_request_version_reference LIKE '%fooValue%'
     * $query->filterByQuoteRequestVersionReference([1, 'foo'], Criteria::IN); // WHERE quote_request_version_reference IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $quoteRequestVersionReference The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByQuoteRequestVersionReference($quoteRequestVersionReference = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $quoteRequestVersionReference = str_replace('*', '%', $quoteRequestVersionReference);
        }

        if (is_array($quoteRequestVersionReference) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$quoteRequestVersionReference of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderTableMap::COL_QUOTE_REQUEST_VERSION_REFERENCE, $quoteRequestVersionReference, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $salutations Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySalutation_In(array $salutations)
    {
        return $this->filterBySalutation($salutations, Criteria::IN);
    }

    /**
     * Filter the query on the salutation column
     *
     * @param     mixed $salutation The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterBySalutation($salutation = null, $comparison = Criteria::EQUAL)
    {
        $valueSet = SpySalesOrderTableMap::getValueSet(SpySalesOrderTableMap::COL_SALUTATION);
        if (is_scalar($salutation)) {
            if (!in_array($salutation, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $salutation));
            }
            $salutation = array_search($salutation, $valueSet);
        } elseif (is_array($salutation)) {
            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
            $convertedValues = array();
            foreach ($salutation as $value) {
                if (!in_array($value, $valueSet)) {
                    throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $value));
                }
                $convertedValues []= array_search($value, $valueSet);
            }
            $salutation = $convertedValues;
        }

        $query = $this->addUsingAlias(SpySalesOrderTableMap::COL_SALUTATION, $salutation, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $stores Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStore_In(array $stores)
    {
        return $this->filterByStore($stores, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $store Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStore_Like($store)
    {
        return $this->filterByStore($store, Criteria::LIKE);
    }

    /**
     * Filter the query on the store column
     *
     * Example usage:
     * <code>
     * $query->filterByStore('fooValue');   // WHERE store = 'fooValue'
     * $query->filterByStore('%fooValue%', Criteria::LIKE); // WHERE store LIKE '%fooValue%'
     * $query->filterByStore([1, 'foo'], Criteria::IN); // WHERE store IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $store The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByStore($store = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $store = str_replace('*', '%', $store);
        }

        if (is_array($store) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$store of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderTableMap::COL_STORE, $store, $comparison);

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
                $this->addUsingAlias(SpySalesOrderTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SpySalesOrderTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Sales\Persistence\SpySalesOrderAddress object
     *
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderAddress|ObjectCollection $spySalesOrderAddress The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBillingAddress($spySalesOrderAddress, ?string $comparison = null)
    {
        if ($spySalesOrderAddress instanceof \Orm\Zed\Sales\Persistence\SpySalesOrderAddress) {
            return $this
                ->addUsingAlias(SpySalesOrderTableMap::COL_FK_SALES_ORDER_ADDRESS_BILLING, $spySalesOrderAddress->getIdSalesOrderAddress(), $comparison);
        } elseif ($spySalesOrderAddress instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpySalesOrderTableMap::COL_FK_SALES_ORDER_ADDRESS_BILLING, $spySalesOrderAddress->toKeyValue('PrimaryKey', 'IdSalesOrderAddress'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByBillingAddress() only accepts arguments of type \Orm\Zed\Sales\Persistence\SpySalesOrderAddress or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BillingAddress relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBillingAddress(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BillingAddress');

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
            $this->addJoinObject($join, 'BillingAddress');
        }

        return $this;
    }

    /**
     * Use the BillingAddress relation SpySalesOrderAddress object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery A secondary query class using the current class as primary query
     */
    public function useBillingAddressQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBillingAddress($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BillingAddress', '\Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery');
    }

    /**
     * Use the BillingAddress relation SpySalesOrderAddress object
     *
     * @param callable(\Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery):\Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBillingAddressQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useBillingAddressQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the BillingAddress relation to the SpySalesOrderAddress table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery The inner query object of the EXISTS statement
     */
    public function useBillingAddressExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery */
        $q = $this->useExistsQuery('BillingAddress', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the BillingAddress relation to the SpySalesOrderAddress table for a NOT EXISTS query.
     *
     * @see useBillingAddressExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery The inner query object of the NOT EXISTS statement
     */
    public function useBillingAddressNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery */
        $q = $this->useExistsQuery('BillingAddress', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the BillingAddress relation to the SpySalesOrderAddress table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery The inner query object of the IN statement
     */
    public function useInBillingAddressQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery */
        $q = $this->useInQuery('BillingAddress', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the BillingAddress relation to the SpySalesOrderAddress table for a NOT IN query.
     *
     * @see useBillingAddressInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery The inner query object of the NOT IN statement
     */
    public function useNotInBillingAddressQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery */
        $q = $this->useInQuery('BillingAddress', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Sales\Persistence\SpySalesOrderAddress object
     *
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderAddress|ObjectCollection $spySalesOrderAddress The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByShippingAddress($spySalesOrderAddress, ?string $comparison = null)
    {
        if ($spySalesOrderAddress instanceof \Orm\Zed\Sales\Persistence\SpySalesOrderAddress) {
            return $this
                ->addUsingAlias(SpySalesOrderTableMap::COL_FK_SALES_ORDER_ADDRESS_SHIPPING, $spySalesOrderAddress->getIdSalesOrderAddress(), $comparison);
        } elseif ($spySalesOrderAddress instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpySalesOrderTableMap::COL_FK_SALES_ORDER_ADDRESS_SHIPPING, $spySalesOrderAddress->toKeyValue('PrimaryKey', 'IdSalesOrderAddress'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByShippingAddress() only accepts arguments of type \Orm\Zed\Sales\Persistence\SpySalesOrderAddress or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ShippingAddress relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinShippingAddress(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ShippingAddress');

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
            $this->addJoinObject($join, 'ShippingAddress');
        }

        return $this;
    }

    /**
     * Use the ShippingAddress relation SpySalesOrderAddress object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery A secondary query class using the current class as primary query
     */
    public function useShippingAddressQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinShippingAddress($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ShippingAddress', '\Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery');
    }

    /**
     * Use the ShippingAddress relation SpySalesOrderAddress object
     *
     * @param callable(\Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery):\Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withShippingAddressQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useShippingAddressQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ShippingAddress relation to the SpySalesOrderAddress table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery The inner query object of the EXISTS statement
     */
    public function useShippingAddressExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery */
        $q = $this->useExistsQuery('ShippingAddress', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ShippingAddress relation to the SpySalesOrderAddress table for a NOT EXISTS query.
     *
     * @see useShippingAddressExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery The inner query object of the NOT EXISTS statement
     */
    public function useShippingAddressNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery */
        $q = $this->useExistsQuery('ShippingAddress', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ShippingAddress relation to the SpySalesOrderAddress table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery The inner query object of the IN statement
     */
    public function useInShippingAddressQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery */
        $q = $this->useInQuery('ShippingAddress', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ShippingAddress relation to the SpySalesOrderAddress table for a NOT IN query.
     *
     * @see useShippingAddressInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery The inner query object of the NOT IN statement
     */
    public function useNotInShippingAddressQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery */
        $q = $this->useInQuery('ShippingAddress', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Locale\Persistence\SpyLocale object
     *
     * @param \Orm\Zed\Locale\Persistence\SpyLocale|ObjectCollection $spyLocale The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLocale($spyLocale, ?string $comparison = null)
    {
        if ($spyLocale instanceof \Orm\Zed\Locale\Persistence\SpyLocale) {
            return $this
                ->addUsingAlias(SpySalesOrderTableMap::COL_FK_LOCALE, $spyLocale->getIdLocale(), $comparison);
        } elseif ($spyLocale instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpySalesOrderTableMap::COL_FK_LOCALE, $spyLocale->toKeyValue('PrimaryKey', 'IdLocale'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByLocale() only accepts arguments of type \Orm\Zed\Locale\Persistence\SpyLocale or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Locale relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinLocale(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Locale');

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
            $this->addJoinObject($join, 'Locale');
        }

        return $this;
    }

    /**
     * Use the Locale relation SpyLocale object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleQuery A secondary query class using the current class as primary query
     */
    public function useLocaleQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLocale($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Locale', '\Orm\Zed\Locale\Persistence\SpyLocaleQuery');
    }

    /**
     * Use the Locale relation SpyLocale object
     *
     * @param callable(\Orm\Zed\Locale\Persistence\SpyLocaleQuery):\Orm\Zed\Locale\Persistence\SpyLocaleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withLocaleQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useLocaleQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the Locale relation to the SpyLocale table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleQuery The inner query object of the EXISTS statement
     */
    public function useLocaleExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Locale\Persistence\SpyLocaleQuery */
        $q = $this->useExistsQuery('Locale', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the Locale relation to the SpyLocale table for a NOT EXISTS query.
     *
     * @see useLocaleExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleQuery The inner query object of the NOT EXISTS statement
     */
    public function useLocaleNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Locale\Persistence\SpyLocaleQuery */
        $q = $this->useExistsQuery('Locale', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the Locale relation to the SpyLocale table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleQuery The inner query object of the IN statement
     */
    public function useInLocaleQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Locale\Persistence\SpyLocaleQuery */
        $q = $this->useInQuery('Locale', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the Locale relation to the SpyLocale table for a NOT IN query.
     *
     * @see useLocaleInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleQuery The inner query object of the NOT IN statement
     */
    public function useNotInLocaleQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Locale\Persistence\SpyLocaleQuery */
        $q = $this->useInQuery('Locale', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrder object
     *
     * @param \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrder|ObjectCollection $spyMerchantSalesOrder the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyMerchantSalesOrder($spyMerchantSalesOrder, ?string $comparison = null)
    {
        if ($spyMerchantSalesOrder instanceof \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrder) {
            $this
                ->addUsingAlias(SpySalesOrderTableMap::COL_ID_SALES_ORDER, $spyMerchantSalesOrder->getFkSalesOrder(), $comparison);

            return $this;
        } elseif ($spyMerchantSalesOrder instanceof ObjectCollection) {
            $this
                ->useSpyMerchantSalesOrderQuery()
                ->filterByPrimaryKeys($spyMerchantSalesOrder->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyMerchantSalesOrder() only accepts arguments of type \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrder or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyMerchantSalesOrder relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyMerchantSalesOrder(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyMerchantSalesOrder');

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
            $this->addJoinObject($join, 'SpyMerchantSalesOrder');
        }

        return $this;
    }

    /**
     * Use the SpyMerchantSalesOrder relation SpyMerchantSalesOrder object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderQuery A secondary query class using the current class as primary query
     */
    public function useSpyMerchantSalesOrderQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyMerchantSalesOrder($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyMerchantSalesOrder', '\Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderQuery');
    }

    /**
     * Use the SpyMerchantSalesOrder relation SpyMerchantSalesOrder object
     *
     * @param callable(\Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderQuery):\Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyMerchantSalesOrderQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyMerchantSalesOrderQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyMerchantSalesOrder table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderQuery The inner query object of the EXISTS statement
     */
    public function useSpyMerchantSalesOrderExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderQuery */
        $q = $this->useExistsQuery('SpyMerchantSalesOrder', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantSalesOrder table for a NOT EXISTS query.
     *
     * @see useSpyMerchantSalesOrderExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyMerchantSalesOrderNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderQuery */
        $q = $this->useExistsQuery('SpyMerchantSalesOrder', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyMerchantSalesOrder table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderQuery The inner query object of the IN statement
     */
    public function useInSpyMerchantSalesOrderQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderQuery */
        $q = $this->useInQuery('SpyMerchantSalesOrder', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantSalesOrder table for a NOT IN query.
     *
     * @see useSpyMerchantSalesOrderInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyMerchantSalesOrderQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderQuery */
        $q = $this->useInQuery('SpyMerchantSalesOrder', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(SpySalesOrderTableMap::COL_ID_SALES_ORDER, $spyOmsTransitionLog->getFkSalesOrder(), $comparison);

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
     * Filter the query by a related \Orm\Zed\Refund\Persistence\SpyRefund object
     *
     * @param \Orm\Zed\Refund\Persistence\SpyRefund|ObjectCollection $spyRefund the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyRefund($spyRefund, ?string $comparison = null)
    {
        if ($spyRefund instanceof \Orm\Zed\Refund\Persistence\SpyRefund) {
            $this
                ->addUsingAlias(SpySalesOrderTableMap::COL_ID_SALES_ORDER, $spyRefund->getFkSalesOrder(), $comparison);

            return $this;
        } elseif ($spyRefund instanceof ObjectCollection) {
            $this
                ->useSpyRefundQuery()
                ->filterByPrimaryKeys($spyRefund->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyRefund() only accepts arguments of type \Orm\Zed\Refund\Persistence\SpyRefund or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyRefund relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyRefund(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyRefund');

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
            $this->addJoinObject($join, 'SpyRefund');
        }

        return $this;
    }

    /**
     * Use the SpyRefund relation SpyRefund object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Refund\Persistence\SpyRefundQuery A secondary query class using the current class as primary query
     */
    public function useSpyRefundQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyRefund($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyRefund', '\Orm\Zed\Refund\Persistence\SpyRefundQuery');
    }

    /**
     * Use the SpyRefund relation SpyRefund object
     *
     * @param callable(\Orm\Zed\Refund\Persistence\SpyRefundQuery):\Orm\Zed\Refund\Persistence\SpyRefundQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyRefundQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyRefundQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyRefund table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Refund\Persistence\SpyRefundQuery The inner query object of the EXISTS statement
     */
    public function useSpyRefundExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Refund\Persistence\SpyRefundQuery */
        $q = $this->useExistsQuery('SpyRefund', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyRefund table for a NOT EXISTS query.
     *
     * @see useSpyRefundExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Refund\Persistence\SpyRefundQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyRefundNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Refund\Persistence\SpyRefundQuery */
        $q = $this->useExistsQuery('SpyRefund', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyRefund table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Refund\Persistence\SpyRefundQuery The inner query object of the IN statement
     */
    public function useInSpyRefundQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Refund\Persistence\SpyRefundQuery */
        $q = $this->useInQuery('SpyRefund', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyRefund table for a NOT IN query.
     *
     * @see useSpyRefundInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Refund\Persistence\SpyRefundQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyRefundQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Refund\Persistence\SpyRefundQuery */
        $q = $this->useInQuery('SpyRefund', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Sales\Persistence\SpySalesOrderItem object
     *
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem|ObjectCollection $spySalesOrderItem the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByItem($spySalesOrderItem, ?string $comparison = null)
    {
        if ($spySalesOrderItem instanceof \Orm\Zed\Sales\Persistence\SpySalesOrderItem) {
            $this
                ->addUsingAlias(SpySalesOrderTableMap::COL_ID_SALES_ORDER, $spySalesOrderItem->getFkSalesOrder(), $comparison);

            return $this;
        } elseif ($spySalesOrderItem instanceof ObjectCollection) {
            $this
                ->useItemQuery()
                ->filterByPrimaryKeys($spySalesOrderItem->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByItem() only accepts arguments of type \Orm\Zed\Sales\Persistence\SpySalesOrderItem or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Item relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinItem(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Item');

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
            $this->addJoinObject($join, 'Item');
        }

        return $this;
    }

    /**
     * Use the Item relation SpySalesOrderItem object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderItemQuery A secondary query class using the current class as primary query
     */
    public function useItemQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinItem($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Item', '\Orm\Zed\Sales\Persistence\SpySalesOrderItemQuery');
    }

    /**
     * Use the Item relation SpySalesOrderItem object
     *
     * @param callable(\Orm\Zed\Sales\Persistence\SpySalesOrderItemQuery):\Orm\Zed\Sales\Persistence\SpySalesOrderItemQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withItemQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useItemQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the Item relation to the SpySalesOrderItem table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderItemQuery The inner query object of the EXISTS statement
     */
    public function useItemExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderItemQuery */
        $q = $this->useExistsQuery('Item', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the Item relation to the SpySalesOrderItem table for a NOT EXISTS query.
     *
     * @see useItemExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderItemQuery The inner query object of the NOT EXISTS statement
     */
    public function useItemNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderItemQuery */
        $q = $this->useExistsQuery('Item', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the Item relation to the SpySalesOrderItem table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderItemQuery The inner query object of the IN statement
     */
    public function useInItemQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderItemQuery */
        $q = $this->useInQuery('Item', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the Item relation to the SpySalesOrderItem table for a NOT IN query.
     *
     * @see useItemInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderItemQuery The inner query object of the NOT IN statement
     */
    public function useNotInItemQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderItemQuery */
        $q = $this->useInQuery('Item', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(SpySalesOrderTableMap::COL_ID_SALES_ORDER, $spySalesDiscount->getFkSalesOrder(), $comparison);

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
     * Filter the query by a related \Orm\Zed\Sales\Persistence\SpySalesExpense object
     *
     * @param \Orm\Zed\Sales\Persistence\SpySalesExpense|ObjectCollection $spySalesExpense the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpense($spySalesExpense, ?string $comparison = null)
    {
        if ($spySalesExpense instanceof \Orm\Zed\Sales\Persistence\SpySalesExpense) {
            $this
                ->addUsingAlias(SpySalesOrderTableMap::COL_ID_SALES_ORDER, $spySalesExpense->getFkSalesOrder(), $comparison);

            return $this;
        } elseif ($spySalesExpense instanceof ObjectCollection) {
            $this
                ->useExpenseQuery()
                ->filterByPrimaryKeys($spySalesExpense->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByExpense() only accepts arguments of type \Orm\Zed\Sales\Persistence\SpySalesExpense or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Expense relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinExpense(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Expense');

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
            $this->addJoinObject($join, 'Expense');
        }

        return $this;
    }

    /**
     * Use the Expense relation SpySalesExpense object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesExpenseQuery A secondary query class using the current class as primary query
     */
    public function useExpenseQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinExpense($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Expense', '\Orm\Zed\Sales\Persistence\SpySalesExpenseQuery');
    }

    /**
     * Use the Expense relation SpySalesExpense object
     *
     * @param callable(\Orm\Zed\Sales\Persistence\SpySalesExpenseQuery):\Orm\Zed\Sales\Persistence\SpySalesExpenseQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withExpenseQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useExpenseQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the Expense relation to the SpySalesExpense table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesExpenseQuery The inner query object of the EXISTS statement
     */
    public function useExpenseExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesExpenseQuery */
        $q = $this->useExistsQuery('Expense', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the Expense relation to the SpySalesExpense table for a NOT EXISTS query.
     *
     * @see useExpenseExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesExpenseQuery The inner query object of the NOT EXISTS statement
     */
    public function useExpenseNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesExpenseQuery */
        $q = $this->useExistsQuery('Expense', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the Expense relation to the SpySalesExpense table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesExpenseQuery The inner query object of the IN statement
     */
    public function useInExpenseQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesExpenseQuery */
        $q = $this->useInQuery('Expense', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the Expense relation to the SpySalesExpense table for a NOT IN query.
     *
     * @see useExpenseInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesExpenseQuery The inner query object of the NOT IN statement
     */
    public function useNotInExpenseQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesExpenseQuery */
        $q = $this->useInQuery('Expense', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Sales\Persistence\SpySalesShipment object
     *
     * @param \Orm\Zed\Sales\Persistence\SpySalesShipment|ObjectCollection $spySalesShipment the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpySalesShipment($spySalesShipment, ?string $comparison = null)
    {
        if ($spySalesShipment instanceof \Orm\Zed\Sales\Persistence\SpySalesShipment) {
            $this
                ->addUsingAlias(SpySalesOrderTableMap::COL_ID_SALES_ORDER, $spySalesShipment->getFkSalesOrder(), $comparison);

            return $this;
        } elseif ($spySalesShipment instanceof ObjectCollection) {
            $this
                ->useSpySalesShipmentQuery()
                ->filterByPrimaryKeys($spySalesShipment->getPrimaryKeys())
                ->endUse();

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
    public function joinSpySalesShipment(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function useSpySalesShipmentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
     * Filter the query by a related \Orm\Zed\Sales\Persistence\SpySalesOrderTotals object
     *
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderTotals|ObjectCollection $spySalesOrderTotals the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderTotal($spySalesOrderTotals, ?string $comparison = null)
    {
        if ($spySalesOrderTotals instanceof \Orm\Zed\Sales\Persistence\SpySalesOrderTotals) {
            $this
                ->addUsingAlias(SpySalesOrderTableMap::COL_ID_SALES_ORDER, $spySalesOrderTotals->getFkSalesOrder(), $comparison);

            return $this;
        } elseif ($spySalesOrderTotals instanceof ObjectCollection) {
            $this
                ->useOrderTotalQuery()
                ->filterByPrimaryKeys($spySalesOrderTotals->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOrderTotal() only accepts arguments of type \Orm\Zed\Sales\Persistence\SpySalesOrderTotals or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OrderTotal relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOrderTotal(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OrderTotal');

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
            $this->addJoinObject($join, 'OrderTotal');
        }

        return $this;
    }

    /**
     * Use the OrderTotal relation SpySalesOrderTotals object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderTotalsQuery A secondary query class using the current class as primary query
     */
    public function useOrderTotalQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrderTotal($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OrderTotal', '\Orm\Zed\Sales\Persistence\SpySalesOrderTotalsQuery');
    }

    /**
     * Use the OrderTotal relation SpySalesOrderTotals object
     *
     * @param callable(\Orm\Zed\Sales\Persistence\SpySalesOrderTotalsQuery):\Orm\Zed\Sales\Persistence\SpySalesOrderTotalsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrderTotalQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOrderTotalQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the OrderTotal relation to the SpySalesOrderTotals table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderTotalsQuery The inner query object of the EXISTS statement
     */
    public function useOrderTotalExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderTotalsQuery */
        $q = $this->useExistsQuery('OrderTotal', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the OrderTotal relation to the SpySalesOrderTotals table for a NOT EXISTS query.
     *
     * @see useOrderTotalExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderTotalsQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrderTotalNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderTotalsQuery */
        $q = $this->useExistsQuery('OrderTotal', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the OrderTotal relation to the SpySalesOrderTotals table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderTotalsQuery The inner query object of the IN statement
     */
    public function useInOrderTotalQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderTotalsQuery */
        $q = $this->useInQuery('OrderTotal', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the OrderTotal relation to the SpySalesOrderTotals table for a NOT IN query.
     *
     * @see useOrderTotalInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderTotalsQuery The inner query object of the NOT IN statement
     */
    public function useNotInOrderTotalQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderTotalsQuery */
        $q = $this->useInQuery('OrderTotal', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Sales\Persistence\SpySalesOrderNote object
     *
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderNote|ObjectCollection $spySalesOrderNote the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNote($spySalesOrderNote, ?string $comparison = null)
    {
        if ($spySalesOrderNote instanceof \Orm\Zed\Sales\Persistence\SpySalesOrderNote) {
            $this
                ->addUsingAlias(SpySalesOrderTableMap::COL_ID_SALES_ORDER, $spySalesOrderNote->getFkSalesOrder(), $comparison);

            return $this;
        } elseif ($spySalesOrderNote instanceof ObjectCollection) {
            $this
                ->useNoteQuery()
                ->filterByPrimaryKeys($spySalesOrderNote->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByNote() only accepts arguments of type \Orm\Zed\Sales\Persistence\SpySalesOrderNote or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Note relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinNote(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Note');

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
            $this->addJoinObject($join, 'Note');
        }

        return $this;
    }

    /**
     * Use the Note relation SpySalesOrderNote object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderNoteQuery A secondary query class using the current class as primary query
     */
    public function useNoteQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinNote($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Note', '\Orm\Zed\Sales\Persistence\SpySalesOrderNoteQuery');
    }

    /**
     * Use the Note relation SpySalesOrderNote object
     *
     * @param callable(\Orm\Zed\Sales\Persistence\SpySalesOrderNoteQuery):\Orm\Zed\Sales\Persistence\SpySalesOrderNoteQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withNoteQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useNoteQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the Note relation to the SpySalesOrderNote table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderNoteQuery The inner query object of the EXISTS statement
     */
    public function useNoteExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderNoteQuery */
        $q = $this->useExistsQuery('Note', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the Note relation to the SpySalesOrderNote table for a NOT EXISTS query.
     *
     * @see useNoteExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderNoteQuery The inner query object of the NOT EXISTS statement
     */
    public function useNoteNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderNoteQuery */
        $q = $this->useExistsQuery('Note', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the Note relation to the SpySalesOrderNote table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderNoteQuery The inner query object of the IN statement
     */
    public function useInNoteQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderNoteQuery */
        $q = $this->useInQuery('Note', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the Note relation to the SpySalesOrderNote table for a NOT IN query.
     *
     * @see useNoteInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderNoteQuery The inner query object of the NOT IN statement
     */
    public function useNotInNoteQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderNoteQuery */
        $q = $this->useInQuery('Note', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Sales\Persistence\SpySalesOrderComment object
     *
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderComment|ObjectCollection $spySalesOrderComment the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderComment($spySalesOrderComment, ?string $comparison = null)
    {
        if ($spySalesOrderComment instanceof \Orm\Zed\Sales\Persistence\SpySalesOrderComment) {
            $this
                ->addUsingAlias(SpySalesOrderTableMap::COL_ID_SALES_ORDER, $spySalesOrderComment->getFkSalesOrder(), $comparison);

            return $this;
        } elseif ($spySalesOrderComment instanceof ObjectCollection) {
            $this
                ->useOrderCommentQuery()
                ->filterByPrimaryKeys($spySalesOrderComment->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOrderComment() only accepts arguments of type \Orm\Zed\Sales\Persistence\SpySalesOrderComment or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OrderComment relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOrderComment(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OrderComment');

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
            $this->addJoinObject($join, 'OrderComment');
        }

        return $this;
    }

    /**
     * Use the OrderComment relation SpySalesOrderComment object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderCommentQuery A secondary query class using the current class as primary query
     */
    public function useOrderCommentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrderComment($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OrderComment', '\Orm\Zed\Sales\Persistence\SpySalesOrderCommentQuery');
    }

    /**
     * Use the OrderComment relation SpySalesOrderComment object
     *
     * @param callable(\Orm\Zed\Sales\Persistence\SpySalesOrderCommentQuery):\Orm\Zed\Sales\Persistence\SpySalesOrderCommentQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrderCommentQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOrderCommentQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the OrderComment relation to the SpySalesOrderComment table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderCommentQuery The inner query object of the EXISTS statement
     */
    public function useOrderCommentExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderCommentQuery */
        $q = $this->useExistsQuery('OrderComment', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the OrderComment relation to the SpySalesOrderComment table for a NOT EXISTS query.
     *
     * @see useOrderCommentExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderCommentQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrderCommentNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderCommentQuery */
        $q = $this->useExistsQuery('OrderComment', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the OrderComment relation to the SpySalesOrderComment table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderCommentQuery The inner query object of the IN statement
     */
    public function useInOrderCommentQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderCommentQuery */
        $q = $this->useInQuery('OrderComment', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the OrderComment relation to the SpySalesOrderComment table for a NOT IN query.
     *
     * @see useOrderCommentInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderCommentQuery The inner query object of the NOT IN statement
     */
    public function useNotInOrderCommentQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderCommentQuery */
        $q = $this->useInQuery('OrderComment', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SalesInvoice\Persistence\SpySalesOrderInvoice object
     *
     * @param \Orm\Zed\SalesInvoice\Persistence\SpySalesOrderInvoice|ObjectCollection $spySalesOrderInvoice the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpySalesOrderInvoice($spySalesOrderInvoice, ?string $comparison = null)
    {
        if ($spySalesOrderInvoice instanceof \Orm\Zed\SalesInvoice\Persistence\SpySalesOrderInvoice) {
            $this
                ->addUsingAlias(SpySalesOrderTableMap::COL_ID_SALES_ORDER, $spySalesOrderInvoice->getFkSalesOrder(), $comparison);

            return $this;
        } elseif ($spySalesOrderInvoice instanceof ObjectCollection) {
            $this
                ->useSpySalesOrderInvoiceQuery()
                ->filterByPrimaryKeys($spySalesOrderInvoice->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpySalesOrderInvoice() only accepts arguments of type \Orm\Zed\SalesInvoice\Persistence\SpySalesOrderInvoice or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpySalesOrderInvoice relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpySalesOrderInvoice(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpySalesOrderInvoice');

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
            $this->addJoinObject($join, 'SpySalesOrderInvoice');
        }

        return $this;
    }

    /**
     * Use the SpySalesOrderInvoice relation SpySalesOrderInvoice object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SalesInvoice\Persistence\SpySalesOrderInvoiceQuery A secondary query class using the current class as primary query
     */
    public function useSpySalesOrderInvoiceQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpySalesOrderInvoice($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpySalesOrderInvoice', '\Orm\Zed\SalesInvoice\Persistence\SpySalesOrderInvoiceQuery');
    }

    /**
     * Use the SpySalesOrderInvoice relation SpySalesOrderInvoice object
     *
     * @param callable(\Orm\Zed\SalesInvoice\Persistence\SpySalesOrderInvoiceQuery):\Orm\Zed\SalesInvoice\Persistence\SpySalesOrderInvoiceQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpySalesOrderInvoiceQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpySalesOrderInvoiceQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpySalesOrderInvoice table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SalesInvoice\Persistence\SpySalesOrderInvoiceQuery The inner query object of the EXISTS statement
     */
    public function useSpySalesOrderInvoiceExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SalesInvoice\Persistence\SpySalesOrderInvoiceQuery */
        $q = $this->useExistsQuery('SpySalesOrderInvoice', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpySalesOrderInvoice table for a NOT EXISTS query.
     *
     * @see useSpySalesOrderInvoiceExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SalesInvoice\Persistence\SpySalesOrderInvoiceQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpySalesOrderInvoiceNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SalesInvoice\Persistence\SpySalesOrderInvoiceQuery */
        $q = $this->useExistsQuery('SpySalesOrderInvoice', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpySalesOrderInvoice table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SalesInvoice\Persistence\SpySalesOrderInvoiceQuery The inner query object of the IN statement
     */
    public function useInSpySalesOrderInvoiceQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SalesInvoice\Persistence\SpySalesOrderInvoiceQuery */
        $q = $this->useInQuery('SpySalesOrderInvoice', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpySalesOrderInvoice table for a NOT IN query.
     *
     * @see useSpySalesOrderInvoiceInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SalesInvoice\Persistence\SpySalesOrderInvoiceQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpySalesOrderInvoiceQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SalesInvoice\Persistence\SpySalesOrderInvoiceQuery */
        $q = $this->useInQuery('SpySalesOrderInvoice', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(SpySalesOrderTableMap::COL_ID_SALES_ORDER, $spySalesMerchantCommission->getFkSalesOrder(), $comparison);

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
    public function joinSpySalesMerchantCommission(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function useSpySalesMerchantCommissionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
     * Filter the query by a related \Orm\Zed\Payment\Persistence\SpySalesPayment object
     *
     * @param \Orm\Zed\Payment\Persistence\SpySalesPayment|ObjectCollection $spySalesPayment the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrder($spySalesPayment, ?string $comparison = null)
    {
        if ($spySalesPayment instanceof \Orm\Zed\Payment\Persistence\SpySalesPayment) {
            $this
                ->addUsingAlias(SpySalesOrderTableMap::COL_ID_SALES_ORDER, $spySalesPayment->getFkSalesOrder(), $comparison);

            return $this;
        } elseif ($spySalesPayment instanceof ObjectCollection) {
            $this
                ->useOrderQuery()
                ->filterByPrimaryKeys($spySalesPayment->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOrder() only accepts arguments of type \Orm\Zed\Payment\Persistence\SpySalesPayment or Collection');
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
     * Use the Order relation SpySalesPayment object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Payment\Persistence\SpySalesPaymentQuery A secondary query class using the current class as primary query
     */
    public function useOrderQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrder($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Order', '\Orm\Zed\Payment\Persistence\SpySalesPaymentQuery');
    }

    /**
     * Use the Order relation SpySalesPayment object
     *
     * @param callable(\Orm\Zed\Payment\Persistence\SpySalesPaymentQuery):\Orm\Zed\Payment\Persistence\SpySalesPaymentQuery $callable A function working on the related query
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
     * Use the Order relation to the SpySalesPayment table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Payment\Persistence\SpySalesPaymentQuery The inner query object of the EXISTS statement
     */
    public function useOrderExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Payment\Persistence\SpySalesPaymentQuery */
        $q = $this->useExistsQuery('Order', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the Order relation to the SpySalesPayment table for a NOT EXISTS query.
     *
     * @see useOrderExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Payment\Persistence\SpySalesPaymentQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrderNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Payment\Persistence\SpySalesPaymentQuery */
        $q = $this->useExistsQuery('Order', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the Order relation to the SpySalesPayment table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Payment\Persistence\SpySalesPaymentQuery The inner query object of the IN statement
     */
    public function useInOrderQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Payment\Persistence\SpySalesPaymentQuery */
        $q = $this->useInQuery('Order', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the Order relation to the SpySalesPayment table for a NOT IN query.
     *
     * @see useOrderInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Payment\Persistence\SpySalesPaymentQuery The inner query object of the NOT IN statement
     */
    public function useNotInOrderQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Payment\Persistence\SpySalesPaymentQuery */
        $q = $this->useInQuery('Order', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayout object
     *
     * @param \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayout|ObjectCollection $spySalesPaymentMerchantPayout the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpySalesPaymentMerchantPayout($spySalesPaymentMerchantPayout, ?string $comparison = null)
    {
        if ($spySalesPaymentMerchantPayout instanceof \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayout) {
            $this
                ->addUsingAlias(SpySalesOrderTableMap::COL_ORDER_REFERENCE, $spySalesPaymentMerchantPayout->getOrderReference(), $comparison);

            return $this;
        } elseif ($spySalesPaymentMerchantPayout instanceof ObjectCollection) {
            $this
                ->useSpySalesPaymentMerchantPayoutQuery()
                ->filterByPrimaryKeys($spySalesPaymentMerchantPayout->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpySalesPaymentMerchantPayout() only accepts arguments of type \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayout or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpySalesPaymentMerchantPayout relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpySalesPaymentMerchantPayout(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpySalesPaymentMerchantPayout');

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
            $this->addJoinObject($join, 'SpySalesPaymentMerchantPayout');
        }

        return $this;
    }

    /**
     * Use the SpySalesPaymentMerchantPayout relation SpySalesPaymentMerchantPayout object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutQuery A secondary query class using the current class as primary query
     */
    public function useSpySalesPaymentMerchantPayoutQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpySalesPaymentMerchantPayout($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpySalesPaymentMerchantPayout', '\Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutQuery');
    }

    /**
     * Use the SpySalesPaymentMerchantPayout relation SpySalesPaymentMerchantPayout object
     *
     * @param callable(\Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutQuery):\Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpySalesPaymentMerchantPayoutQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpySalesPaymentMerchantPayoutQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpySalesPaymentMerchantPayout table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutQuery The inner query object of the EXISTS statement
     */
    public function useSpySalesPaymentMerchantPayoutExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutQuery */
        $q = $this->useExistsQuery('SpySalesPaymentMerchantPayout', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpySalesPaymentMerchantPayout table for a NOT EXISTS query.
     *
     * @see useSpySalesPaymentMerchantPayoutExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpySalesPaymentMerchantPayoutNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutQuery */
        $q = $this->useExistsQuery('SpySalesPaymentMerchantPayout', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpySalesPaymentMerchantPayout table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutQuery The inner query object of the IN statement
     */
    public function useInSpySalesPaymentMerchantPayoutQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutQuery */
        $q = $this->useInQuery('SpySalesPaymentMerchantPayout', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpySalesPaymentMerchantPayout table for a NOT IN query.
     *
     * @see useSpySalesPaymentMerchantPayoutInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpySalesPaymentMerchantPayoutQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutQuery */
        $q = $this->useInQuery('SpySalesPaymentMerchantPayout', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversal object
     *
     * @param \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversal|ObjectCollection $spySalesPaymentMerchantPayoutReversal the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpySalesPaymentMerchantPayoutReversal($spySalesPaymentMerchantPayoutReversal, ?string $comparison = null)
    {
        if ($spySalesPaymentMerchantPayoutReversal instanceof \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversal) {
            $this
                ->addUsingAlias(SpySalesOrderTableMap::COL_ORDER_REFERENCE, $spySalesPaymentMerchantPayoutReversal->getOrderReference(), $comparison);

            return $this;
        } elseif ($spySalesPaymentMerchantPayoutReversal instanceof ObjectCollection) {
            $this
                ->useSpySalesPaymentMerchantPayoutReversalQuery()
                ->filterByPrimaryKeys($spySalesPaymentMerchantPayoutReversal->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpySalesPaymentMerchantPayoutReversal() only accepts arguments of type \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversal or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpySalesPaymentMerchantPayoutReversal relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpySalesPaymentMerchantPayoutReversal(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpySalesPaymentMerchantPayoutReversal');

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
            $this->addJoinObject($join, 'SpySalesPaymentMerchantPayoutReversal');
        }

        return $this;
    }

    /**
     * Use the SpySalesPaymentMerchantPayoutReversal relation SpySalesPaymentMerchantPayoutReversal object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversalQuery A secondary query class using the current class as primary query
     */
    public function useSpySalesPaymentMerchantPayoutReversalQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpySalesPaymentMerchantPayoutReversal($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpySalesPaymentMerchantPayoutReversal', '\Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversalQuery');
    }

    /**
     * Use the SpySalesPaymentMerchantPayoutReversal relation SpySalesPaymentMerchantPayoutReversal object
     *
     * @param callable(\Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversalQuery):\Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversalQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpySalesPaymentMerchantPayoutReversalQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpySalesPaymentMerchantPayoutReversalQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpySalesPaymentMerchantPayoutReversal table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversalQuery The inner query object of the EXISTS statement
     */
    public function useSpySalesPaymentMerchantPayoutReversalExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversalQuery */
        $q = $this->useExistsQuery('SpySalesPaymentMerchantPayoutReversal', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpySalesPaymentMerchantPayoutReversal table for a NOT EXISTS query.
     *
     * @see useSpySalesPaymentMerchantPayoutReversalExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversalQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpySalesPaymentMerchantPayoutReversalNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversalQuery */
        $q = $this->useExistsQuery('SpySalesPaymentMerchantPayoutReversal', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpySalesPaymentMerchantPayoutReversal table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversalQuery The inner query object of the IN statement
     */
    public function useInSpySalesPaymentMerchantPayoutReversalQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversalQuery */
        $q = $this->useInQuery('SpySalesPaymentMerchantPayoutReversal', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpySalesPaymentMerchantPayoutReversal table for a NOT IN query.
     *
     * @see useSpySalesPaymentMerchantPayoutReversalInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversalQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpySalesPaymentMerchantPayoutReversalQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversalQuery */
        $q = $this->useInQuery('SpySalesPaymentMerchantPayoutReversal', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SalesReclamation\Persistence\SpySalesReclamation object
     *
     * @param \Orm\Zed\SalesReclamation\Persistence\SpySalesReclamation|ObjectCollection $spySalesReclamation the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByReclamation($spySalesReclamation, ?string $comparison = null)
    {
        if ($spySalesReclamation instanceof \Orm\Zed\SalesReclamation\Persistence\SpySalesReclamation) {
            $this
                ->addUsingAlias(SpySalesOrderTableMap::COL_ID_SALES_ORDER, $spySalesReclamation->getFkSalesOrder(), $comparison);

            return $this;
        } elseif ($spySalesReclamation instanceof ObjectCollection) {
            $this
                ->useReclamationQuery()
                ->filterByPrimaryKeys($spySalesReclamation->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByReclamation() only accepts arguments of type \Orm\Zed\SalesReclamation\Persistence\SpySalesReclamation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Reclamation relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinReclamation(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Reclamation');

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
            $this->addJoinObject($join, 'Reclamation');
        }

        return $this;
    }

    /**
     * Use the Reclamation relation SpySalesReclamation object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationQuery A secondary query class using the current class as primary query
     */
    public function useReclamationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinReclamation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Reclamation', '\Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationQuery');
    }

    /**
     * Use the Reclamation relation SpySalesReclamation object
     *
     * @param callable(\Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationQuery):\Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withReclamationQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useReclamationQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the Reclamation relation to the SpySalesReclamation table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationQuery The inner query object of the EXISTS statement
     */
    public function useReclamationExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationQuery */
        $q = $this->useExistsQuery('Reclamation', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the Reclamation relation to the SpySalesReclamation table for a NOT EXISTS query.
     *
     * @see useReclamationExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationQuery The inner query object of the NOT EXISTS statement
     */
    public function useReclamationNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationQuery */
        $q = $this->useExistsQuery('Reclamation', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the Reclamation relation to the SpySalesReclamation table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationQuery The inner query object of the IN statement
     */
    public function useInReclamationQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationQuery */
        $q = $this->useInQuery('Reclamation', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the Reclamation relation to the SpySalesReclamation table for a NOT IN query.
     *
     * @see useReclamationInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationQuery The inner query object of the NOT IN statement
     */
    public function useNotInReclamationQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationQuery */
        $q = $this->useInQuery('Reclamation', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrder object
     *
     * @param \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrder|ObjectCollection $spySspInquirySalesOrder the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpySspInquirySalesOrder($spySspInquirySalesOrder, ?string $comparison = null)
    {
        if ($spySspInquirySalesOrder instanceof \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrder) {
            $this
                ->addUsingAlias(SpySalesOrderTableMap::COL_ID_SALES_ORDER, $spySspInquirySalesOrder->getFkSalesOrder(), $comparison);

            return $this;
        } elseif ($spySspInquirySalesOrder instanceof ObjectCollection) {
            $this
                ->useSpySspInquirySalesOrderQuery()
                ->filterByPrimaryKeys($spySspInquirySalesOrder->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpySspInquirySalesOrder() only accepts arguments of type \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrder or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpySspInquirySalesOrder relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpySspInquirySalesOrder(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpySspInquirySalesOrder');

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
            $this->addJoinObject($join, 'SpySspInquirySalesOrder');
        }

        return $this;
    }

    /**
     * Use the SpySspInquirySalesOrder relation SpySspInquirySalesOrder object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderQuery A secondary query class using the current class as primary query
     */
    public function useSpySspInquirySalesOrderQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpySspInquirySalesOrder($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpySspInquirySalesOrder', '\Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderQuery');
    }

    /**
     * Use the SpySspInquirySalesOrder relation SpySspInquirySalesOrder object
     *
     * @param callable(\Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderQuery):\Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpySspInquirySalesOrderQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpySspInquirySalesOrderQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpySspInquirySalesOrder table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderQuery The inner query object of the EXISTS statement
     */
    public function useSpySspInquirySalesOrderExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderQuery */
        $q = $this->useExistsQuery('SpySspInquirySalesOrder', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpySspInquirySalesOrder table for a NOT EXISTS query.
     *
     * @see useSpySspInquirySalesOrderExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpySspInquirySalesOrderNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderQuery */
        $q = $this->useExistsQuery('SpySspInquirySalesOrder', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpySspInquirySalesOrder table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderQuery The inner query object of the IN statement
     */
    public function useInSpySspInquirySalesOrderQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderQuery */
        $q = $this->useInQuery('SpySspInquirySalesOrder', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpySspInquirySalesOrder table for a NOT IN query.
     *
     * @see useSpySspInquirySalesOrderInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpySspInquirySalesOrderQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderQuery */
        $q = $this->useInQuery('SpySspInquirySalesOrder', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpySalesOrder $spySalesOrder Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spySalesOrder = null)
    {
        if ($spySalesOrder) {
            $this->addUsingAlias(SpySalesOrderTableMap::COL_ID_SALES_ORDER, $spySalesOrder->getIdSalesOrder(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_sales_order table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpySalesOrderTableMap::clearInstancePool();
            SpySalesOrderTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpySalesOrderTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpySalesOrderTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpySalesOrderTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(SpySalesOrderTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpySalesOrderTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpySalesOrderTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpySalesOrderTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpySalesOrderTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpySalesOrderTableMap::COL_CREATED_AT);

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
