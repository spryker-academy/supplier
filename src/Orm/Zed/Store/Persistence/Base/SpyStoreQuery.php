<?php

namespace Orm\Zed\Store\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\Asset\Persistence\SpyAssetStore;
use Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscription;
use Orm\Zed\Availability\Persistence\SpyAvailability;
use Orm\Zed\Availability\Persistence\SpyAvailabilityAbstract;
use Orm\Zed\Category\Persistence\SpyCategoryStore;
use Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStore;
use Orm\Zed\Cms\Persistence\SpyCmsPageStore;
use Orm\Zed\Company\Persistence\SpyCompanyStore;
use Orm\Zed\Country\Persistence\SpyCountryStore;
use Orm\Zed\Currency\Persistence\SpyCurrency;
use Orm\Zed\Currency\Persistence\SpyCurrencyStore;
use Orm\Zed\Discount\Persistence\SpyDiscount;
use Orm\Zed\Discount\Persistence\SpyDiscountStore;
use Orm\Zed\Locale\Persistence\SpyLocale;
use Orm\Zed\Locale\Persistence\SpyLocaleStore;
use Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStore;
use Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequest;
use Orm\Zed\MerchantRelationshipSalesOrderThreshold\Persistence\SpyMerchantRelationshipSalesOrderThreshold;
use Orm\Zed\Merchant\Persistence\SpyMerchantStore;
use Orm\Zed\OmsProductOfferReservation\Persistence\SpyOmsProductOfferReservation;
use Orm\Zed\Oms\Persistence\SpyOmsProductReservation;
use Orm\Zed\Payment\Persistence\SpyPaymentMethodStore;
use Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductSchedule;
use Orm\Zed\PriceProduct\Persistence\SpyPriceProductStore;
use Orm\Zed\ProductLabel\Persistence\SpyProductLabelStore;
use Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStore;
use Orm\Zed\ProductOffer\Persistence\SpyProductOfferStore;
use Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePrice;
use Orm\Zed\ProductRelation\Persistence\SpyProductRelationStore;
use Orm\Zed\Product\Persistence\SpyProductAbstractStore;
use Orm\Zed\Quote\Persistence\SpyQuote;
use Orm\Zed\SalesOrderThreshold\Persistence\SpySalesOrderThreshold;
use Orm\Zed\ServicePoint\Persistence\SpyServicePointStore;
use Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStore;
use Orm\Zed\Shipment\Persistence\SpyShipmentMethodPrice;
use Orm\Zed\Shipment\Persistence\SpyShipmentMethodStore;
use Orm\Zed\Stock\Persistence\SpyStockStore;
use Orm\Zed\StoreContext\Persistence\SpyStoreContext;
use Orm\Zed\Store\Persistence\SpyStore as ChildSpyStore;
use Orm\Zed\Store\Persistence\SpyStoreQuery as ChildSpyStoreQuery;
use Orm\Zed\Store\Persistence\Map\SpyStoreTableMap;
use Orm\Zed\Touch\Persistence\SpyTouchSearch;
use Orm\Zed\Touch\Persistence\SpyTouchStorage;
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
 * Base class that represents a query for the `spy_store` table.
 *
 * @method     ChildSpyStoreQuery orderByIdStore($order = Criteria::ASC) Order by the id_store column
 * @method     ChildSpyStoreQuery orderByFkCurrency($order = Criteria::ASC) Order by the fk_currency column
 * @method     ChildSpyStoreQuery orderByFkLocale($order = Criteria::ASC) Order by the fk_locale column
 * @method     ChildSpyStoreQuery orderByName($order = Criteria::ASC) Order by the name column
 *
 * @method     ChildSpyStoreQuery groupByIdStore() Group by the id_store column
 * @method     ChildSpyStoreQuery groupByFkCurrency() Group by the fk_currency column
 * @method     ChildSpyStoreQuery groupByFkLocale() Group by the fk_locale column
 * @method     ChildSpyStoreQuery groupByName() Group by the name column
 *
 * @method     ChildSpyStoreQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyStoreQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyStoreQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyStoreQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyStoreQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyStoreQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyStoreQuery leftJoinDefaultCurrency($relationAlias = null) Adds a LEFT JOIN clause to the query using the DefaultCurrency relation
 * @method     ChildSpyStoreQuery rightJoinDefaultCurrency($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DefaultCurrency relation
 * @method     ChildSpyStoreQuery innerJoinDefaultCurrency($relationAlias = null) Adds a INNER JOIN clause to the query using the DefaultCurrency relation
 *
 * @method     ChildSpyStoreQuery joinWithDefaultCurrency($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the DefaultCurrency relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithDefaultCurrency() Adds a LEFT JOIN clause and with to the query using the DefaultCurrency relation
 * @method     ChildSpyStoreQuery rightJoinWithDefaultCurrency() Adds a RIGHT JOIN clause and with to the query using the DefaultCurrency relation
 * @method     ChildSpyStoreQuery innerJoinWithDefaultCurrency() Adds a INNER JOIN clause and with to the query using the DefaultCurrency relation
 *
 * @method     ChildSpyStoreQuery leftJoinDefaultLocale($relationAlias = null) Adds a LEFT JOIN clause to the query using the DefaultLocale relation
 * @method     ChildSpyStoreQuery rightJoinDefaultLocale($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DefaultLocale relation
 * @method     ChildSpyStoreQuery innerJoinDefaultLocale($relationAlias = null) Adds a INNER JOIN clause to the query using the DefaultLocale relation
 *
 * @method     ChildSpyStoreQuery joinWithDefaultLocale($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the DefaultLocale relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithDefaultLocale() Adds a LEFT JOIN clause and with to the query using the DefaultLocale relation
 * @method     ChildSpyStoreQuery rightJoinWithDefaultLocale() Adds a RIGHT JOIN clause and with to the query using the DefaultLocale relation
 * @method     ChildSpyStoreQuery innerJoinWithDefaultLocale() Adds a INNER JOIN clause and with to the query using the DefaultLocale relation
 *
 * @method     ChildSpyStoreQuery leftJoinSpyAssetStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyAssetStore relation
 * @method     ChildSpyStoreQuery rightJoinSpyAssetStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyAssetStore relation
 * @method     ChildSpyStoreQuery innerJoinSpyAssetStore($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyAssetStore relation
 *
 * @method     ChildSpyStoreQuery joinWithSpyAssetStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyAssetStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithSpyAssetStore() Adds a LEFT JOIN clause and with to the query using the SpyAssetStore relation
 * @method     ChildSpyStoreQuery rightJoinWithSpyAssetStore() Adds a RIGHT JOIN clause and with to the query using the SpyAssetStore relation
 * @method     ChildSpyStoreQuery innerJoinWithSpyAssetStore() Adds a INNER JOIN clause and with to the query using the SpyAssetStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinAvailabilityAbstract($relationAlias = null) Adds a LEFT JOIN clause to the query using the AvailabilityAbstract relation
 * @method     ChildSpyStoreQuery rightJoinAvailabilityAbstract($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AvailabilityAbstract relation
 * @method     ChildSpyStoreQuery innerJoinAvailabilityAbstract($relationAlias = null) Adds a INNER JOIN clause to the query using the AvailabilityAbstract relation
 *
 * @method     ChildSpyStoreQuery joinWithAvailabilityAbstract($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the AvailabilityAbstract relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithAvailabilityAbstract() Adds a LEFT JOIN clause and with to the query using the AvailabilityAbstract relation
 * @method     ChildSpyStoreQuery rightJoinWithAvailabilityAbstract() Adds a RIGHT JOIN clause and with to the query using the AvailabilityAbstract relation
 * @method     ChildSpyStoreQuery innerJoinWithAvailabilityAbstract() Adds a INNER JOIN clause and with to the query using the AvailabilityAbstract relation
 *
 * @method     ChildSpyStoreQuery leftJoinAvailability($relationAlias = null) Adds a LEFT JOIN clause to the query using the Availability relation
 * @method     ChildSpyStoreQuery rightJoinAvailability($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Availability relation
 * @method     ChildSpyStoreQuery innerJoinAvailability($relationAlias = null) Adds a INNER JOIN clause to the query using the Availability relation
 *
 * @method     ChildSpyStoreQuery joinWithAvailability($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Availability relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithAvailability() Adds a LEFT JOIN clause and with to the query using the Availability relation
 * @method     ChildSpyStoreQuery rightJoinWithAvailability() Adds a RIGHT JOIN clause and with to the query using the Availability relation
 * @method     ChildSpyStoreQuery innerJoinWithAvailability() Adds a INNER JOIN clause and with to the query using the Availability relation
 *
 * @method     ChildSpyStoreQuery leftJoinSpyAvailabilityNotificationSubscription($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyAvailabilityNotificationSubscription relation
 * @method     ChildSpyStoreQuery rightJoinSpyAvailabilityNotificationSubscription($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyAvailabilityNotificationSubscription relation
 * @method     ChildSpyStoreQuery innerJoinSpyAvailabilityNotificationSubscription($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyAvailabilityNotificationSubscription relation
 *
 * @method     ChildSpyStoreQuery joinWithSpyAvailabilityNotificationSubscription($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyAvailabilityNotificationSubscription relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithSpyAvailabilityNotificationSubscription() Adds a LEFT JOIN clause and with to the query using the SpyAvailabilityNotificationSubscription relation
 * @method     ChildSpyStoreQuery rightJoinWithSpyAvailabilityNotificationSubscription() Adds a RIGHT JOIN clause and with to the query using the SpyAvailabilityNotificationSubscription relation
 * @method     ChildSpyStoreQuery innerJoinWithSpyAvailabilityNotificationSubscription() Adds a INNER JOIN clause and with to the query using the SpyAvailabilityNotificationSubscription relation
 *
 * @method     ChildSpyStoreQuery leftJoinSpyCategoryStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCategoryStore relation
 * @method     ChildSpyStoreQuery rightJoinSpyCategoryStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCategoryStore relation
 * @method     ChildSpyStoreQuery innerJoinSpyCategoryStore($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCategoryStore relation
 *
 * @method     ChildSpyStoreQuery joinWithSpyCategoryStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCategoryStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithSpyCategoryStore() Adds a LEFT JOIN clause and with to the query using the SpyCategoryStore relation
 * @method     ChildSpyStoreQuery rightJoinWithSpyCategoryStore() Adds a RIGHT JOIN clause and with to the query using the SpyCategoryStore relation
 * @method     ChildSpyStoreQuery innerJoinWithSpyCategoryStore() Adds a INNER JOIN clause and with to the query using the SpyCategoryStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinSpyCmsPageStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCmsPageStore relation
 * @method     ChildSpyStoreQuery rightJoinSpyCmsPageStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCmsPageStore relation
 * @method     ChildSpyStoreQuery innerJoinSpyCmsPageStore($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCmsPageStore relation
 *
 * @method     ChildSpyStoreQuery joinWithSpyCmsPageStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCmsPageStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithSpyCmsPageStore() Adds a LEFT JOIN clause and with to the query using the SpyCmsPageStore relation
 * @method     ChildSpyStoreQuery rightJoinWithSpyCmsPageStore() Adds a RIGHT JOIN clause and with to the query using the SpyCmsPageStore relation
 * @method     ChildSpyStoreQuery innerJoinWithSpyCmsPageStore() Adds a INNER JOIN clause and with to the query using the SpyCmsPageStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinSpyCmsBlockStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCmsBlockStore relation
 * @method     ChildSpyStoreQuery rightJoinSpyCmsBlockStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCmsBlockStore relation
 * @method     ChildSpyStoreQuery innerJoinSpyCmsBlockStore($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCmsBlockStore relation
 *
 * @method     ChildSpyStoreQuery joinWithSpyCmsBlockStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCmsBlockStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithSpyCmsBlockStore() Adds a LEFT JOIN clause and with to the query using the SpyCmsBlockStore relation
 * @method     ChildSpyStoreQuery rightJoinWithSpyCmsBlockStore() Adds a RIGHT JOIN clause and with to the query using the SpyCmsBlockStore relation
 * @method     ChildSpyStoreQuery innerJoinWithSpyCmsBlockStore() Adds a INNER JOIN clause and with to the query using the SpyCmsBlockStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinSpyCompanyStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCompanyStore relation
 * @method     ChildSpyStoreQuery rightJoinSpyCompanyStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCompanyStore relation
 * @method     ChildSpyStoreQuery innerJoinSpyCompanyStore($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCompanyStore relation
 *
 * @method     ChildSpyStoreQuery joinWithSpyCompanyStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCompanyStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithSpyCompanyStore() Adds a LEFT JOIN clause and with to the query using the SpyCompanyStore relation
 * @method     ChildSpyStoreQuery rightJoinWithSpyCompanyStore() Adds a RIGHT JOIN clause and with to the query using the SpyCompanyStore relation
 * @method     ChildSpyStoreQuery innerJoinWithSpyCompanyStore() Adds a INNER JOIN clause and with to the query using the SpyCompanyStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinCountryStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the CountryStore relation
 * @method     ChildSpyStoreQuery rightJoinCountryStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CountryStore relation
 * @method     ChildSpyStoreQuery innerJoinCountryStore($relationAlias = null) Adds a INNER JOIN clause to the query using the CountryStore relation
 *
 * @method     ChildSpyStoreQuery joinWithCountryStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CountryStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithCountryStore() Adds a LEFT JOIN clause and with to the query using the CountryStore relation
 * @method     ChildSpyStoreQuery rightJoinWithCountryStore() Adds a RIGHT JOIN clause and with to the query using the CountryStore relation
 * @method     ChildSpyStoreQuery innerJoinWithCountryStore() Adds a INNER JOIN clause and with to the query using the CountryStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinCurrencyStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the CurrencyStore relation
 * @method     ChildSpyStoreQuery rightJoinCurrencyStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CurrencyStore relation
 * @method     ChildSpyStoreQuery innerJoinCurrencyStore($relationAlias = null) Adds a INNER JOIN clause to the query using the CurrencyStore relation
 *
 * @method     ChildSpyStoreQuery joinWithCurrencyStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CurrencyStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithCurrencyStore() Adds a LEFT JOIN clause and with to the query using the CurrencyStore relation
 * @method     ChildSpyStoreQuery rightJoinWithCurrencyStore() Adds a RIGHT JOIN clause and with to the query using the CurrencyStore relation
 * @method     ChildSpyStoreQuery innerJoinWithCurrencyStore() Adds a INNER JOIN clause and with to the query using the CurrencyStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinDiscount($relationAlias = null) Adds a LEFT JOIN clause to the query using the Discount relation
 * @method     ChildSpyStoreQuery rightJoinDiscount($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Discount relation
 * @method     ChildSpyStoreQuery innerJoinDiscount($relationAlias = null) Adds a INNER JOIN clause to the query using the Discount relation
 *
 * @method     ChildSpyStoreQuery joinWithDiscount($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Discount relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithDiscount() Adds a LEFT JOIN clause and with to the query using the Discount relation
 * @method     ChildSpyStoreQuery rightJoinWithDiscount() Adds a RIGHT JOIN clause and with to the query using the Discount relation
 * @method     ChildSpyStoreQuery innerJoinWithDiscount() Adds a INNER JOIN clause and with to the query using the Discount relation
 *
 * @method     ChildSpyStoreQuery leftJoinSpyDiscountStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyDiscountStore relation
 * @method     ChildSpyStoreQuery rightJoinSpyDiscountStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyDiscountStore relation
 * @method     ChildSpyStoreQuery innerJoinSpyDiscountStore($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyDiscountStore relation
 *
 * @method     ChildSpyStoreQuery joinWithSpyDiscountStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyDiscountStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithSpyDiscountStore() Adds a LEFT JOIN clause and with to the query using the SpyDiscountStore relation
 * @method     ChildSpyStoreQuery rightJoinWithSpyDiscountStore() Adds a RIGHT JOIN clause and with to the query using the SpyDiscountStore relation
 * @method     ChildSpyStoreQuery innerJoinWithSpyDiscountStore() Adds a INNER JOIN clause and with to the query using the SpyDiscountStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinLocaleStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the LocaleStore relation
 * @method     ChildSpyStoreQuery rightJoinLocaleStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LocaleStore relation
 * @method     ChildSpyStoreQuery innerJoinLocaleStore($relationAlias = null) Adds a INNER JOIN clause to the query using the LocaleStore relation
 *
 * @method     ChildSpyStoreQuery joinWithLocaleStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the LocaleStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithLocaleStore() Adds a LEFT JOIN clause and with to the query using the LocaleStore relation
 * @method     ChildSpyStoreQuery rightJoinWithLocaleStore() Adds a RIGHT JOIN clause and with to the query using the LocaleStore relation
 * @method     ChildSpyStoreQuery innerJoinWithLocaleStore() Adds a INNER JOIN clause and with to the query using the LocaleStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinSpyMerchantStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchantStore relation
 * @method     ChildSpyStoreQuery rightJoinSpyMerchantStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchantStore relation
 * @method     ChildSpyStoreQuery innerJoinSpyMerchantStore($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchantStore relation
 *
 * @method     ChildSpyStoreQuery joinWithSpyMerchantStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchantStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithSpyMerchantStore() Adds a LEFT JOIN clause and with to the query using the SpyMerchantStore relation
 * @method     ChildSpyStoreQuery rightJoinWithSpyMerchantStore() Adds a RIGHT JOIN clause and with to the query using the SpyMerchantStore relation
 * @method     ChildSpyStoreQuery innerJoinWithSpyMerchantStore() Adds a INNER JOIN clause and with to the query using the SpyMerchantStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinMerchantCommission($relationAlias = null) Adds a LEFT JOIN clause to the query using the MerchantCommission relation
 * @method     ChildSpyStoreQuery rightJoinMerchantCommission($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MerchantCommission relation
 * @method     ChildSpyStoreQuery innerJoinMerchantCommission($relationAlias = null) Adds a INNER JOIN clause to the query using the MerchantCommission relation
 *
 * @method     ChildSpyStoreQuery joinWithMerchantCommission($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the MerchantCommission relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithMerchantCommission() Adds a LEFT JOIN clause and with to the query using the MerchantCommission relation
 * @method     ChildSpyStoreQuery rightJoinWithMerchantCommission() Adds a RIGHT JOIN clause and with to the query using the MerchantCommission relation
 * @method     ChildSpyStoreQuery innerJoinWithMerchantCommission() Adds a INNER JOIN clause and with to the query using the MerchantCommission relation
 *
 * @method     ChildSpyStoreQuery leftJoinSpyMerchantRegistrationRequest($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchantRegistrationRequest relation
 * @method     ChildSpyStoreQuery rightJoinSpyMerchantRegistrationRequest($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchantRegistrationRequest relation
 * @method     ChildSpyStoreQuery innerJoinSpyMerchantRegistrationRequest($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchantRegistrationRequest relation
 *
 * @method     ChildSpyStoreQuery joinWithSpyMerchantRegistrationRequest($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchantRegistrationRequest relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithSpyMerchantRegistrationRequest() Adds a LEFT JOIN clause and with to the query using the SpyMerchantRegistrationRequest relation
 * @method     ChildSpyStoreQuery rightJoinWithSpyMerchantRegistrationRequest() Adds a RIGHT JOIN clause and with to the query using the SpyMerchantRegistrationRequest relation
 * @method     ChildSpyStoreQuery innerJoinWithSpyMerchantRegistrationRequest() Adds a INNER JOIN clause and with to the query using the SpyMerchantRegistrationRequest relation
 *
 * @method     ChildSpyStoreQuery leftJoinSpyMerchantRelationshipSalesOrderThreshold($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchantRelationshipSalesOrderThreshold relation
 * @method     ChildSpyStoreQuery rightJoinSpyMerchantRelationshipSalesOrderThreshold($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchantRelationshipSalesOrderThreshold relation
 * @method     ChildSpyStoreQuery innerJoinSpyMerchantRelationshipSalesOrderThreshold($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchantRelationshipSalesOrderThreshold relation
 *
 * @method     ChildSpyStoreQuery joinWithSpyMerchantRelationshipSalesOrderThreshold($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchantRelationshipSalesOrderThreshold relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithSpyMerchantRelationshipSalesOrderThreshold() Adds a LEFT JOIN clause and with to the query using the SpyMerchantRelationshipSalesOrderThreshold relation
 * @method     ChildSpyStoreQuery rightJoinWithSpyMerchantRelationshipSalesOrderThreshold() Adds a RIGHT JOIN clause and with to the query using the SpyMerchantRelationshipSalesOrderThreshold relation
 * @method     ChildSpyStoreQuery innerJoinWithSpyMerchantRelationshipSalesOrderThreshold() Adds a INNER JOIN clause and with to the query using the SpyMerchantRelationshipSalesOrderThreshold relation
 *
 * @method     ChildSpyStoreQuery leftJoinOmsProductReservation($relationAlias = null) Adds a LEFT JOIN clause to the query using the OmsProductReservation relation
 * @method     ChildSpyStoreQuery rightJoinOmsProductReservation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OmsProductReservation relation
 * @method     ChildSpyStoreQuery innerJoinOmsProductReservation($relationAlias = null) Adds a INNER JOIN clause to the query using the OmsProductReservation relation
 *
 * @method     ChildSpyStoreQuery joinWithOmsProductReservation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OmsProductReservation relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithOmsProductReservation() Adds a LEFT JOIN clause and with to the query using the OmsProductReservation relation
 * @method     ChildSpyStoreQuery rightJoinWithOmsProductReservation() Adds a RIGHT JOIN clause and with to the query using the OmsProductReservation relation
 * @method     ChildSpyStoreQuery innerJoinWithOmsProductReservation() Adds a INNER JOIN clause and with to the query using the OmsProductReservation relation
 *
 * @method     ChildSpyStoreQuery leftJoinOmsProductOfferReservation($relationAlias = null) Adds a LEFT JOIN clause to the query using the OmsProductOfferReservation relation
 * @method     ChildSpyStoreQuery rightJoinOmsProductOfferReservation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OmsProductOfferReservation relation
 * @method     ChildSpyStoreQuery innerJoinOmsProductOfferReservation($relationAlias = null) Adds a INNER JOIN clause to the query using the OmsProductOfferReservation relation
 *
 * @method     ChildSpyStoreQuery joinWithOmsProductOfferReservation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OmsProductOfferReservation relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithOmsProductOfferReservation() Adds a LEFT JOIN clause and with to the query using the OmsProductOfferReservation relation
 * @method     ChildSpyStoreQuery rightJoinWithOmsProductOfferReservation() Adds a RIGHT JOIN clause and with to the query using the OmsProductOfferReservation relation
 * @method     ChildSpyStoreQuery innerJoinWithOmsProductOfferReservation() Adds a INNER JOIN clause and with to the query using the OmsProductOfferReservation relation
 *
 * @method     ChildSpyStoreQuery leftJoinSpyPaymentMethodStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyPaymentMethodStore relation
 * @method     ChildSpyStoreQuery rightJoinSpyPaymentMethodStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyPaymentMethodStore relation
 * @method     ChildSpyStoreQuery innerJoinSpyPaymentMethodStore($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyPaymentMethodStore relation
 *
 * @method     ChildSpyStoreQuery joinWithSpyPaymentMethodStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyPaymentMethodStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithSpyPaymentMethodStore() Adds a LEFT JOIN clause and with to the query using the SpyPaymentMethodStore relation
 * @method     ChildSpyStoreQuery rightJoinWithSpyPaymentMethodStore() Adds a RIGHT JOIN clause and with to the query using the SpyPaymentMethodStore relation
 * @method     ChildSpyStoreQuery innerJoinWithSpyPaymentMethodStore() Adds a INNER JOIN clause and with to the query using the SpyPaymentMethodStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinPriceProductStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the PriceProductStore relation
 * @method     ChildSpyStoreQuery rightJoinPriceProductStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PriceProductStore relation
 * @method     ChildSpyStoreQuery innerJoinPriceProductStore($relationAlias = null) Adds a INNER JOIN clause to the query using the PriceProductStore relation
 *
 * @method     ChildSpyStoreQuery joinWithPriceProductStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PriceProductStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithPriceProductStore() Adds a LEFT JOIN clause and with to the query using the PriceProductStore relation
 * @method     ChildSpyStoreQuery rightJoinWithPriceProductStore() Adds a RIGHT JOIN clause and with to the query using the PriceProductStore relation
 * @method     ChildSpyStoreQuery innerJoinWithPriceProductStore() Adds a INNER JOIN clause and with to the query using the PriceProductStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinPriceProductSchedule($relationAlias = null) Adds a LEFT JOIN clause to the query using the PriceProductSchedule relation
 * @method     ChildSpyStoreQuery rightJoinPriceProductSchedule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PriceProductSchedule relation
 * @method     ChildSpyStoreQuery innerJoinPriceProductSchedule($relationAlias = null) Adds a INNER JOIN clause to the query using the PriceProductSchedule relation
 *
 * @method     ChildSpyStoreQuery joinWithPriceProductSchedule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PriceProductSchedule relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithPriceProductSchedule() Adds a LEFT JOIN clause and with to the query using the PriceProductSchedule relation
 * @method     ChildSpyStoreQuery rightJoinWithPriceProductSchedule() Adds a RIGHT JOIN clause and with to the query using the PriceProductSchedule relation
 * @method     ChildSpyStoreQuery innerJoinWithPriceProductSchedule() Adds a INNER JOIN clause and with to the query using the PriceProductSchedule relation
 *
 * @method     ChildSpyStoreQuery leftJoinSpyProductAbstractStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductAbstractStore relation
 * @method     ChildSpyStoreQuery rightJoinSpyProductAbstractStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductAbstractStore relation
 * @method     ChildSpyStoreQuery innerJoinSpyProductAbstractStore($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductAbstractStore relation
 *
 * @method     ChildSpyStoreQuery joinWithSpyProductAbstractStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductAbstractStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithSpyProductAbstractStore() Adds a LEFT JOIN clause and with to the query using the SpyProductAbstractStore relation
 * @method     ChildSpyStoreQuery rightJoinWithSpyProductAbstractStore() Adds a RIGHT JOIN clause and with to the query using the SpyProductAbstractStore relation
 * @method     ChildSpyStoreQuery innerJoinWithSpyProductAbstractStore() Adds a INNER JOIN clause and with to the query using the SpyProductAbstractStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinProductLabelStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductLabelStore relation
 * @method     ChildSpyStoreQuery rightJoinProductLabelStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductLabelStore relation
 * @method     ChildSpyStoreQuery innerJoinProductLabelStore($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductLabelStore relation
 *
 * @method     ChildSpyStoreQuery joinWithProductLabelStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductLabelStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithProductLabelStore() Adds a LEFT JOIN clause and with to the query using the ProductLabelStore relation
 * @method     ChildSpyStoreQuery rightJoinWithProductLabelStore() Adds a RIGHT JOIN clause and with to the query using the ProductLabelStore relation
 * @method     ChildSpyStoreQuery innerJoinWithProductLabelStore() Adds a INNER JOIN clause and with to the query using the ProductLabelStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinSpyProductMeasurementSalesUnitStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductMeasurementSalesUnitStore relation
 * @method     ChildSpyStoreQuery rightJoinSpyProductMeasurementSalesUnitStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductMeasurementSalesUnitStore relation
 * @method     ChildSpyStoreQuery innerJoinSpyProductMeasurementSalesUnitStore($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductMeasurementSalesUnitStore relation
 *
 * @method     ChildSpyStoreQuery joinWithSpyProductMeasurementSalesUnitStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductMeasurementSalesUnitStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithSpyProductMeasurementSalesUnitStore() Adds a LEFT JOIN clause and with to the query using the SpyProductMeasurementSalesUnitStore relation
 * @method     ChildSpyStoreQuery rightJoinWithSpyProductMeasurementSalesUnitStore() Adds a RIGHT JOIN clause and with to the query using the SpyProductMeasurementSalesUnitStore relation
 * @method     ChildSpyStoreQuery innerJoinWithSpyProductMeasurementSalesUnitStore() Adds a INNER JOIN clause and with to the query using the SpyProductMeasurementSalesUnitStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinSpyProductOfferStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductOfferStore relation
 * @method     ChildSpyStoreQuery rightJoinSpyProductOfferStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductOfferStore relation
 * @method     ChildSpyStoreQuery innerJoinSpyProductOfferStore($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductOfferStore relation
 *
 * @method     ChildSpyStoreQuery joinWithSpyProductOfferStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductOfferStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithSpyProductOfferStore() Adds a LEFT JOIN clause and with to the query using the SpyProductOfferStore relation
 * @method     ChildSpyStoreQuery rightJoinWithSpyProductOfferStore() Adds a RIGHT JOIN clause and with to the query using the SpyProductOfferStore relation
 * @method     ChildSpyStoreQuery innerJoinWithSpyProductOfferStore() Adds a INNER JOIN clause and with to the query using the SpyProductOfferStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinProductOptionValuePrice($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductOptionValuePrice relation
 * @method     ChildSpyStoreQuery rightJoinProductOptionValuePrice($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductOptionValuePrice relation
 * @method     ChildSpyStoreQuery innerJoinProductOptionValuePrice($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductOptionValuePrice relation
 *
 * @method     ChildSpyStoreQuery joinWithProductOptionValuePrice($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductOptionValuePrice relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithProductOptionValuePrice() Adds a LEFT JOIN clause and with to the query using the ProductOptionValuePrice relation
 * @method     ChildSpyStoreQuery rightJoinWithProductOptionValuePrice() Adds a RIGHT JOIN clause and with to the query using the ProductOptionValuePrice relation
 * @method     ChildSpyStoreQuery innerJoinWithProductOptionValuePrice() Adds a INNER JOIN clause and with to the query using the ProductOptionValuePrice relation
 *
 * @method     ChildSpyStoreQuery leftJoinProductRelationStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductRelationStore relation
 * @method     ChildSpyStoreQuery rightJoinProductRelationStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductRelationStore relation
 * @method     ChildSpyStoreQuery innerJoinProductRelationStore($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductRelationStore relation
 *
 * @method     ChildSpyStoreQuery joinWithProductRelationStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductRelationStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithProductRelationStore() Adds a LEFT JOIN clause and with to the query using the ProductRelationStore relation
 * @method     ChildSpyStoreQuery rightJoinWithProductRelationStore() Adds a RIGHT JOIN clause and with to the query using the ProductRelationStore relation
 * @method     ChildSpyStoreQuery innerJoinWithProductRelationStore() Adds a INNER JOIN clause and with to the query using the ProductRelationStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinSpyQuote($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyQuote relation
 * @method     ChildSpyStoreQuery rightJoinSpyQuote($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyQuote relation
 * @method     ChildSpyStoreQuery innerJoinSpyQuote($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyQuote relation
 *
 * @method     ChildSpyStoreQuery joinWithSpyQuote($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyQuote relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithSpyQuote() Adds a LEFT JOIN clause and with to the query using the SpyQuote relation
 * @method     ChildSpyStoreQuery rightJoinWithSpyQuote() Adds a RIGHT JOIN clause and with to the query using the SpyQuote relation
 * @method     ChildSpyStoreQuery innerJoinWithSpyQuote() Adds a INNER JOIN clause and with to the query using the SpyQuote relation
 *
 * @method     ChildSpyStoreQuery leftJoinSpySalesOrderThreshold($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpySalesOrderThreshold relation
 * @method     ChildSpyStoreQuery rightJoinSpySalesOrderThreshold($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpySalesOrderThreshold relation
 * @method     ChildSpyStoreQuery innerJoinSpySalesOrderThreshold($relationAlias = null) Adds a INNER JOIN clause to the query using the SpySalesOrderThreshold relation
 *
 * @method     ChildSpyStoreQuery joinWithSpySalesOrderThreshold($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpySalesOrderThreshold relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithSpySalesOrderThreshold() Adds a LEFT JOIN clause and with to the query using the SpySalesOrderThreshold relation
 * @method     ChildSpyStoreQuery rightJoinWithSpySalesOrderThreshold() Adds a RIGHT JOIN clause and with to the query using the SpySalesOrderThreshold relation
 * @method     ChildSpyStoreQuery innerJoinWithSpySalesOrderThreshold() Adds a INNER JOIN clause and with to the query using the SpySalesOrderThreshold relation
 *
 * @method     ChildSpyStoreQuery leftJoinServicePointStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the ServicePointStore relation
 * @method     ChildSpyStoreQuery rightJoinServicePointStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ServicePointStore relation
 * @method     ChildSpyStoreQuery innerJoinServicePointStore($relationAlias = null) Adds a INNER JOIN clause to the query using the ServicePointStore relation
 *
 * @method     ChildSpyStoreQuery joinWithServicePointStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ServicePointStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithServicePointStore() Adds a LEFT JOIN clause and with to the query using the ServicePointStore relation
 * @method     ChildSpyStoreQuery rightJoinWithServicePointStore() Adds a RIGHT JOIN clause and with to the query using the ServicePointStore relation
 * @method     ChildSpyStoreQuery innerJoinWithServicePointStore() Adds a INNER JOIN clause and with to the query using the ServicePointStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinShipmentMethodPrice($relationAlias = null) Adds a LEFT JOIN clause to the query using the ShipmentMethodPrice relation
 * @method     ChildSpyStoreQuery rightJoinShipmentMethodPrice($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ShipmentMethodPrice relation
 * @method     ChildSpyStoreQuery innerJoinShipmentMethodPrice($relationAlias = null) Adds a INNER JOIN clause to the query using the ShipmentMethodPrice relation
 *
 * @method     ChildSpyStoreQuery joinWithShipmentMethodPrice($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ShipmentMethodPrice relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithShipmentMethodPrice() Adds a LEFT JOIN clause and with to the query using the ShipmentMethodPrice relation
 * @method     ChildSpyStoreQuery rightJoinWithShipmentMethodPrice() Adds a RIGHT JOIN clause and with to the query using the ShipmentMethodPrice relation
 * @method     ChildSpyStoreQuery innerJoinWithShipmentMethodPrice() Adds a INNER JOIN clause and with to the query using the ShipmentMethodPrice relation
 *
 * @method     ChildSpyStoreQuery leftJoinShipmentMethodStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the ShipmentMethodStore relation
 * @method     ChildSpyStoreQuery rightJoinShipmentMethodStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ShipmentMethodStore relation
 * @method     ChildSpyStoreQuery innerJoinShipmentMethodStore($relationAlias = null) Adds a INNER JOIN clause to the query using the ShipmentMethodStore relation
 *
 * @method     ChildSpyStoreQuery joinWithShipmentMethodStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ShipmentMethodStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithShipmentMethodStore() Adds a LEFT JOIN clause and with to the query using the ShipmentMethodStore relation
 * @method     ChildSpyStoreQuery rightJoinWithShipmentMethodStore() Adds a RIGHT JOIN clause and with to the query using the ShipmentMethodStore relation
 * @method     ChildSpyStoreQuery innerJoinWithShipmentMethodStore() Adds a INNER JOIN clause and with to the query using the ShipmentMethodStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinShipmentTypeStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the ShipmentTypeStore relation
 * @method     ChildSpyStoreQuery rightJoinShipmentTypeStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ShipmentTypeStore relation
 * @method     ChildSpyStoreQuery innerJoinShipmentTypeStore($relationAlias = null) Adds a INNER JOIN clause to the query using the ShipmentTypeStore relation
 *
 * @method     ChildSpyStoreQuery joinWithShipmentTypeStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ShipmentTypeStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithShipmentTypeStore() Adds a LEFT JOIN clause and with to the query using the ShipmentTypeStore relation
 * @method     ChildSpyStoreQuery rightJoinWithShipmentTypeStore() Adds a RIGHT JOIN clause and with to the query using the ShipmentTypeStore relation
 * @method     ChildSpyStoreQuery innerJoinWithShipmentTypeStore() Adds a INNER JOIN clause and with to the query using the ShipmentTypeStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinStockStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the StockStore relation
 * @method     ChildSpyStoreQuery rightJoinStockStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StockStore relation
 * @method     ChildSpyStoreQuery innerJoinStockStore($relationAlias = null) Adds a INNER JOIN clause to the query using the StockStore relation
 *
 * @method     ChildSpyStoreQuery joinWithStockStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StockStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithStockStore() Adds a LEFT JOIN clause and with to the query using the StockStore relation
 * @method     ChildSpyStoreQuery rightJoinWithStockStore() Adds a RIGHT JOIN clause and with to the query using the StockStore relation
 * @method     ChildSpyStoreQuery innerJoinWithStockStore() Adds a INNER JOIN clause and with to the query using the StockStore relation
 *
 * @method     ChildSpyStoreQuery leftJoinSpyStoreContext($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyStoreContext relation
 * @method     ChildSpyStoreQuery rightJoinSpyStoreContext($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyStoreContext relation
 * @method     ChildSpyStoreQuery innerJoinSpyStoreContext($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyStoreContext relation
 *
 * @method     ChildSpyStoreQuery joinWithSpyStoreContext($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyStoreContext relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithSpyStoreContext() Adds a LEFT JOIN clause and with to the query using the SpyStoreContext relation
 * @method     ChildSpyStoreQuery rightJoinWithSpyStoreContext() Adds a RIGHT JOIN clause and with to the query using the SpyStoreContext relation
 * @method     ChildSpyStoreQuery innerJoinWithSpyStoreContext() Adds a INNER JOIN clause and with to the query using the SpyStoreContext relation
 *
 * @method     ChildSpyStoreQuery leftJoinTouchStorage($relationAlias = null) Adds a LEFT JOIN clause to the query using the TouchStorage relation
 * @method     ChildSpyStoreQuery rightJoinTouchStorage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TouchStorage relation
 * @method     ChildSpyStoreQuery innerJoinTouchStorage($relationAlias = null) Adds a INNER JOIN clause to the query using the TouchStorage relation
 *
 * @method     ChildSpyStoreQuery joinWithTouchStorage($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TouchStorage relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithTouchStorage() Adds a LEFT JOIN clause and with to the query using the TouchStorage relation
 * @method     ChildSpyStoreQuery rightJoinWithTouchStorage() Adds a RIGHT JOIN clause and with to the query using the TouchStorage relation
 * @method     ChildSpyStoreQuery innerJoinWithTouchStorage() Adds a INNER JOIN clause and with to the query using the TouchStorage relation
 *
 * @method     ChildSpyStoreQuery leftJoinTouchSearch($relationAlias = null) Adds a LEFT JOIN clause to the query using the TouchSearch relation
 * @method     ChildSpyStoreQuery rightJoinTouchSearch($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TouchSearch relation
 * @method     ChildSpyStoreQuery innerJoinTouchSearch($relationAlias = null) Adds a INNER JOIN clause to the query using the TouchSearch relation
 *
 * @method     ChildSpyStoreQuery joinWithTouchSearch($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TouchSearch relation
 *
 * @method     ChildSpyStoreQuery leftJoinWithTouchSearch() Adds a LEFT JOIN clause and with to the query using the TouchSearch relation
 * @method     ChildSpyStoreQuery rightJoinWithTouchSearch() Adds a RIGHT JOIN clause and with to the query using the TouchSearch relation
 * @method     ChildSpyStoreQuery innerJoinWithTouchSearch() Adds a INNER JOIN clause and with to the query using the TouchSearch relation
 *
 * @method     \Orm\Zed\Currency\Persistence\SpyCurrencyQuery|\Orm\Zed\Locale\Persistence\SpyLocaleQuery|\Orm\Zed\Asset\Persistence\SpyAssetStoreQuery|\Orm\Zed\Availability\Persistence\SpyAvailabilityAbstractQuery|\Orm\Zed\Availability\Persistence\SpyAvailabilityQuery|\Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscriptionQuery|\Orm\Zed\Category\Persistence\SpyCategoryStoreQuery|\Orm\Zed\Cms\Persistence\SpyCmsPageStoreQuery|\Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStoreQuery|\Orm\Zed\Company\Persistence\SpyCompanyStoreQuery|\Orm\Zed\Country\Persistence\SpyCountryStoreQuery|\Orm\Zed\Currency\Persistence\SpyCurrencyStoreQuery|\Orm\Zed\Discount\Persistence\SpyDiscountQuery|\Orm\Zed\Discount\Persistence\SpyDiscountStoreQuery|\Orm\Zed\Locale\Persistence\SpyLocaleStoreQuery|\Orm\Zed\Merchant\Persistence\SpyMerchantStoreQuery|\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStoreQuery|\Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequestQuery|\Orm\Zed\MerchantRelationshipSalesOrderThreshold\Persistence\SpyMerchantRelationshipSalesOrderThresholdQuery|\Orm\Zed\Oms\Persistence\SpyOmsProductReservationQuery|\Orm\Zed\OmsProductOfferReservation\Persistence\SpyOmsProductOfferReservationQuery|\Orm\Zed\Payment\Persistence\SpyPaymentMethodStoreQuery|\Orm\Zed\PriceProduct\Persistence\SpyPriceProductStoreQuery|\Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleQuery|\Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery|\Orm\Zed\ProductLabel\Persistence\SpyProductLabelStoreQuery|\Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStoreQuery|\Orm\Zed\ProductOffer\Persistence\SpyProductOfferStoreQuery|\Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePriceQuery|\Orm\Zed\ProductRelation\Persistence\SpyProductRelationStoreQuery|\Orm\Zed\Quote\Persistence\SpyQuoteQuery|\Orm\Zed\SalesOrderThreshold\Persistence\SpySalesOrderThresholdQuery|\Orm\Zed\ServicePoint\Persistence\SpyServicePointStoreQuery|\Orm\Zed\Shipment\Persistence\SpyShipmentMethodPriceQuery|\Orm\Zed\Shipment\Persistence\SpyShipmentMethodStoreQuery|\Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStoreQuery|\Orm\Zed\Stock\Persistence\SpyStockStoreQuery|\Orm\Zed\StoreContext\Persistence\SpyStoreContextQuery|\Orm\Zed\Touch\Persistence\SpyTouchStorageQuery|\Orm\Zed\Touch\Persistence\SpyTouchSearchQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyStore|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyStore matching the query
 * @method     ChildSpyStore findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyStore matching the query, or a new ChildSpyStore object populated from the query conditions when no match is found
 *
 * @method     ChildSpyStore|null findOneByIdStore(int $id_store) Return the first ChildSpyStore filtered by the id_store column
 * @method     ChildSpyStore|null findOneByFkCurrency(int $fk_currency) Return the first ChildSpyStore filtered by the fk_currency column
 * @method     ChildSpyStore|null findOneByFkLocale(int $fk_locale) Return the first ChildSpyStore filtered by the fk_locale column
 * @method     ChildSpyStore|null findOneByName(string $name) Return the first ChildSpyStore filtered by the name column
 *
 * @method     ChildSpyStore requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyStore by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyStore requireOne(?ConnectionInterface $con = null) Return the first ChildSpyStore matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyStore requireOneByIdStore(int $id_store) Return the first ChildSpyStore filtered by the id_store column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyStore requireOneByFkCurrency(int $fk_currency) Return the first ChildSpyStore filtered by the fk_currency column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyStore requireOneByFkLocale(int $fk_locale) Return the first ChildSpyStore filtered by the fk_locale column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyStore requireOneByName(string $name) Return the first ChildSpyStore filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyStore[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyStore objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyStore> find(?ConnectionInterface $con = null) Return ChildSpyStore objects based on current ModelCriteria
 *
 * @method     ChildSpyStore[]|Collection findByIdStore(int|array<int> $id_store) Return ChildSpyStore objects filtered by the id_store column
 * @psalm-method Collection&\Traversable<ChildSpyStore> findByIdStore(int|array<int> $id_store) Return ChildSpyStore objects filtered by the id_store column
 * @method     ChildSpyStore[]|Collection findByFkCurrency(int|array<int> $fk_currency) Return ChildSpyStore objects filtered by the fk_currency column
 * @psalm-method Collection&\Traversable<ChildSpyStore> findByFkCurrency(int|array<int> $fk_currency) Return ChildSpyStore objects filtered by the fk_currency column
 * @method     ChildSpyStore[]|Collection findByFkLocale(int|array<int> $fk_locale) Return ChildSpyStore objects filtered by the fk_locale column
 * @psalm-method Collection&\Traversable<ChildSpyStore> findByFkLocale(int|array<int> $fk_locale) Return ChildSpyStore objects filtered by the fk_locale column
 * @method     ChildSpyStore[]|Collection findByName(string|array<string> $name) Return ChildSpyStore objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildSpyStore> findByName(string|array<string> $name) Return ChildSpyStore objects filtered by the name column
 *
 * @method     ChildSpyStore[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyStore> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyStoreQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\Store\Persistence\Base\SpyStoreQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\Store\\Persistence\\SpyStore', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyStoreQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyStoreQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyStoreQuery) {
            return $criteria;
        }
        $query = new ChildSpyStoreQuery();
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
     * @return ChildSpyStore|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyStoreTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyStore A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_store, fk_currency, fk_locale, name FROM spy_store WHERE id_store = :p0';
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
            /** @var ChildSpyStore $obj */
            $obj = new ChildSpyStore();
            $obj->hydrate($row);
            SpyStoreTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyStore|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idStore Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdStore_Between(array $idStore)
    {
        return $this->filterByIdStore($idStore, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idStores Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdStore_In(array $idStores)
    {
        return $this->filterByIdStore($idStores, Criteria::IN);
    }

    /**
     * Filter the query on the id_store column
     *
     * Example usage:
     * <code>
     * $query->filterByIdStore(1234); // WHERE id_store = 1234
     * $query->filterByIdStore(array(12, 34), Criteria::IN); // WHERE id_store IN (12, 34)
     * $query->filterByIdStore(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_store > 12
     * </code>
     *
     * @param     mixed $idStore The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdStore($idStore = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idStore)) {
            $useMinMax = false;
            if (isset($idStore['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $idStore['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idStore['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $idStore['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idStore of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $idStore, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkCurrency Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCurrency_Between(array $fkCurrency)
    {
        return $this->filterByFkCurrency($fkCurrency, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkCurrencys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCurrency_In(array $fkCurrencys)
    {
        return $this->filterByFkCurrency($fkCurrencys, Criteria::IN);
    }

    /**
     * Filter the query on the fk_currency column
     *
     * Example usage:
     * <code>
     * $query->filterByFkCurrency(1234); // WHERE fk_currency = 1234
     * $query->filterByFkCurrency(array(12, 34), Criteria::IN); // WHERE fk_currency IN (12, 34)
     * $query->filterByFkCurrency(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_currency > 12
     * </code>
     *
     * @see       filterByDefaultCurrency()
     *
     * @param     mixed $fkCurrency The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkCurrency($fkCurrency = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkCurrency)) {
            $useMinMax = false;
            if (isset($fkCurrency['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyStoreTableMap::COL_FK_CURRENCY, $fkCurrency['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkCurrency['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyStoreTableMap::COL_FK_CURRENCY, $fkCurrency['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkCurrency of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyStoreTableMap::COL_FK_CURRENCY, $fkCurrency, $comparison);

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
     * @see       filterByDefaultLocale()
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
                $this->addUsingAlias(SpyStoreTableMap::COL_FK_LOCALE, $fkLocale['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkLocale['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyStoreTableMap::COL_FK_LOCALE, $fkLocale['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkLocale of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyStoreTableMap::COL_FK_LOCALE, $fkLocale, $comparison);

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

        $query = $this->addUsingAlias(SpyStoreTableMap::COL_NAME, $name, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Currency\Persistence\SpyCurrency object
     *
     * @param \Orm\Zed\Currency\Persistence\SpyCurrency|ObjectCollection $spyCurrency The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDefaultCurrency($spyCurrency, ?string $comparison = null)
    {
        if ($spyCurrency instanceof \Orm\Zed\Currency\Persistence\SpyCurrency) {
            return $this
                ->addUsingAlias(SpyStoreTableMap::COL_FK_CURRENCY, $spyCurrency->getIdCurrency(), $comparison);
        } elseif ($spyCurrency instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyStoreTableMap::COL_FK_CURRENCY, $spyCurrency->toKeyValue('PrimaryKey', 'IdCurrency'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByDefaultCurrency() only accepts arguments of type \Orm\Zed\Currency\Persistence\SpyCurrency or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the DefaultCurrency relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinDefaultCurrency(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('DefaultCurrency');

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
            $this->addJoinObject($join, 'DefaultCurrency');
        }

        return $this;
    }

    /**
     * Use the DefaultCurrency relation SpyCurrency object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Currency\Persistence\SpyCurrencyQuery A secondary query class using the current class as primary query
     */
    public function useDefaultCurrencyQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinDefaultCurrency($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DefaultCurrency', '\Orm\Zed\Currency\Persistence\SpyCurrencyQuery');
    }

    /**
     * Use the DefaultCurrency relation SpyCurrency object
     *
     * @param callable(\Orm\Zed\Currency\Persistence\SpyCurrencyQuery):\Orm\Zed\Currency\Persistence\SpyCurrencyQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDefaultCurrencyQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useDefaultCurrencyQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the DefaultCurrency relation to the SpyCurrency table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Currency\Persistence\SpyCurrencyQuery The inner query object of the EXISTS statement
     */
    public function useDefaultCurrencyExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Currency\Persistence\SpyCurrencyQuery */
        $q = $this->useExistsQuery('DefaultCurrency', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the DefaultCurrency relation to the SpyCurrency table for a NOT EXISTS query.
     *
     * @see useDefaultCurrencyExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Currency\Persistence\SpyCurrencyQuery The inner query object of the NOT EXISTS statement
     */
    public function useDefaultCurrencyNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Currency\Persistence\SpyCurrencyQuery */
        $q = $this->useExistsQuery('DefaultCurrency', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the DefaultCurrency relation to the SpyCurrency table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Currency\Persistence\SpyCurrencyQuery The inner query object of the IN statement
     */
    public function useInDefaultCurrencyQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Currency\Persistence\SpyCurrencyQuery */
        $q = $this->useInQuery('DefaultCurrency', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the DefaultCurrency relation to the SpyCurrency table for a NOT IN query.
     *
     * @see useDefaultCurrencyInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Currency\Persistence\SpyCurrencyQuery The inner query object of the NOT IN statement
     */
    public function useNotInDefaultCurrencyQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Currency\Persistence\SpyCurrencyQuery */
        $q = $this->useInQuery('DefaultCurrency', $modelAlias, $queryClass, 'NOT IN');
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
    public function filterByDefaultLocale($spyLocale, ?string $comparison = null)
    {
        if ($spyLocale instanceof \Orm\Zed\Locale\Persistence\SpyLocale) {
            return $this
                ->addUsingAlias(SpyStoreTableMap::COL_FK_LOCALE, $spyLocale->getIdLocale(), $comparison);
        } elseif ($spyLocale instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyStoreTableMap::COL_FK_LOCALE, $spyLocale->toKeyValue('PrimaryKey', 'IdLocale'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByDefaultLocale() only accepts arguments of type \Orm\Zed\Locale\Persistence\SpyLocale or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the DefaultLocale relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinDefaultLocale(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('DefaultLocale');

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
            $this->addJoinObject($join, 'DefaultLocale');
        }

        return $this;
    }

    /**
     * Use the DefaultLocale relation SpyLocale object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleQuery A secondary query class using the current class as primary query
     */
    public function useDefaultLocaleQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinDefaultLocale($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DefaultLocale', '\Orm\Zed\Locale\Persistence\SpyLocaleQuery');
    }

    /**
     * Use the DefaultLocale relation SpyLocale object
     *
     * @param callable(\Orm\Zed\Locale\Persistence\SpyLocaleQuery):\Orm\Zed\Locale\Persistence\SpyLocaleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDefaultLocaleQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useDefaultLocaleQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the DefaultLocale relation to the SpyLocale table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleQuery The inner query object of the EXISTS statement
     */
    public function useDefaultLocaleExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Locale\Persistence\SpyLocaleQuery */
        $q = $this->useExistsQuery('DefaultLocale', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the DefaultLocale relation to the SpyLocale table for a NOT EXISTS query.
     *
     * @see useDefaultLocaleExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleQuery The inner query object of the NOT EXISTS statement
     */
    public function useDefaultLocaleNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Locale\Persistence\SpyLocaleQuery */
        $q = $this->useExistsQuery('DefaultLocale', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the DefaultLocale relation to the SpyLocale table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleQuery The inner query object of the IN statement
     */
    public function useInDefaultLocaleQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Locale\Persistence\SpyLocaleQuery */
        $q = $this->useInQuery('DefaultLocale', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the DefaultLocale relation to the SpyLocale table for a NOT IN query.
     *
     * @see useDefaultLocaleInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleQuery The inner query object of the NOT IN statement
     */
    public function useNotInDefaultLocaleQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Locale\Persistence\SpyLocaleQuery */
        $q = $this->useInQuery('DefaultLocale', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Asset\Persistence\SpyAssetStore object
     *
     * @param \Orm\Zed\Asset\Persistence\SpyAssetStore|ObjectCollection $spyAssetStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyAssetStore($spyAssetStore, ?string $comparison = null)
    {
        if ($spyAssetStore instanceof \Orm\Zed\Asset\Persistence\SpyAssetStore) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyAssetStore->getFkStore(), $comparison);

            return $this;
        } elseif ($spyAssetStore instanceof ObjectCollection) {
            $this
                ->useSpyAssetStoreQuery()
                ->filterByPrimaryKeys($spyAssetStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyAssetStore() only accepts arguments of type \Orm\Zed\Asset\Persistence\SpyAssetStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyAssetStore relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyAssetStore(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyAssetStore');

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
            $this->addJoinObject($join, 'SpyAssetStore');
        }

        return $this;
    }

    /**
     * Use the SpyAssetStore relation SpyAssetStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Asset\Persistence\SpyAssetStoreQuery A secondary query class using the current class as primary query
     */
    public function useSpyAssetStoreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyAssetStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyAssetStore', '\Orm\Zed\Asset\Persistence\SpyAssetStoreQuery');
    }

    /**
     * Use the SpyAssetStore relation SpyAssetStore object
     *
     * @param callable(\Orm\Zed\Asset\Persistence\SpyAssetStoreQuery):\Orm\Zed\Asset\Persistence\SpyAssetStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyAssetStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyAssetStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyAssetStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Asset\Persistence\SpyAssetStoreQuery The inner query object of the EXISTS statement
     */
    public function useSpyAssetStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Asset\Persistence\SpyAssetStoreQuery */
        $q = $this->useExistsQuery('SpyAssetStore', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyAssetStore table for a NOT EXISTS query.
     *
     * @see useSpyAssetStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Asset\Persistence\SpyAssetStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyAssetStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Asset\Persistence\SpyAssetStoreQuery */
        $q = $this->useExistsQuery('SpyAssetStore', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyAssetStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Asset\Persistence\SpyAssetStoreQuery The inner query object of the IN statement
     */
    public function useInSpyAssetStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Asset\Persistence\SpyAssetStoreQuery */
        $q = $this->useInQuery('SpyAssetStore', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyAssetStore table for a NOT IN query.
     *
     * @see useSpyAssetStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Asset\Persistence\SpyAssetStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyAssetStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Asset\Persistence\SpyAssetStoreQuery */
        $q = $this->useInQuery('SpyAssetStore', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Availability\Persistence\SpyAvailabilityAbstract object
     *
     * @param \Orm\Zed\Availability\Persistence\SpyAvailabilityAbstract|ObjectCollection $spyAvailabilityAbstract the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAvailabilityAbstract($spyAvailabilityAbstract, ?string $comparison = null)
    {
        if ($spyAvailabilityAbstract instanceof \Orm\Zed\Availability\Persistence\SpyAvailabilityAbstract) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyAvailabilityAbstract->getFkStore(), $comparison);

            return $this;
        } elseif ($spyAvailabilityAbstract instanceof ObjectCollection) {
            $this
                ->useAvailabilityAbstractQuery()
                ->filterByPrimaryKeys($spyAvailabilityAbstract->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByAvailabilityAbstract() only accepts arguments of type \Orm\Zed\Availability\Persistence\SpyAvailabilityAbstract or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AvailabilityAbstract relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinAvailabilityAbstract(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('AvailabilityAbstract');

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
            $this->addJoinObject($join, 'AvailabilityAbstract');
        }

        return $this;
    }

    /**
     * Use the AvailabilityAbstract relation SpyAvailabilityAbstract object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Availability\Persistence\SpyAvailabilityAbstractQuery A secondary query class using the current class as primary query
     */
    public function useAvailabilityAbstractQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinAvailabilityAbstract($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AvailabilityAbstract', '\Orm\Zed\Availability\Persistence\SpyAvailabilityAbstractQuery');
    }

    /**
     * Use the AvailabilityAbstract relation SpyAvailabilityAbstract object
     *
     * @param callable(\Orm\Zed\Availability\Persistence\SpyAvailabilityAbstractQuery):\Orm\Zed\Availability\Persistence\SpyAvailabilityAbstractQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withAvailabilityAbstractQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useAvailabilityAbstractQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the AvailabilityAbstract relation to the SpyAvailabilityAbstract table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Availability\Persistence\SpyAvailabilityAbstractQuery The inner query object of the EXISTS statement
     */
    public function useAvailabilityAbstractExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Availability\Persistence\SpyAvailabilityAbstractQuery */
        $q = $this->useExistsQuery('AvailabilityAbstract', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the AvailabilityAbstract relation to the SpyAvailabilityAbstract table for a NOT EXISTS query.
     *
     * @see useAvailabilityAbstractExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Availability\Persistence\SpyAvailabilityAbstractQuery The inner query object of the NOT EXISTS statement
     */
    public function useAvailabilityAbstractNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Availability\Persistence\SpyAvailabilityAbstractQuery */
        $q = $this->useExistsQuery('AvailabilityAbstract', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the AvailabilityAbstract relation to the SpyAvailabilityAbstract table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Availability\Persistence\SpyAvailabilityAbstractQuery The inner query object of the IN statement
     */
    public function useInAvailabilityAbstractQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Availability\Persistence\SpyAvailabilityAbstractQuery */
        $q = $this->useInQuery('AvailabilityAbstract', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the AvailabilityAbstract relation to the SpyAvailabilityAbstract table for a NOT IN query.
     *
     * @see useAvailabilityAbstractInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Availability\Persistence\SpyAvailabilityAbstractQuery The inner query object of the NOT IN statement
     */
    public function useNotInAvailabilityAbstractQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Availability\Persistence\SpyAvailabilityAbstractQuery */
        $q = $this->useInQuery('AvailabilityAbstract', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Availability\Persistence\SpyAvailability object
     *
     * @param \Orm\Zed\Availability\Persistence\SpyAvailability|ObjectCollection $spyAvailability the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAvailability($spyAvailability, ?string $comparison = null)
    {
        if ($spyAvailability instanceof \Orm\Zed\Availability\Persistence\SpyAvailability) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyAvailability->getFkStore(), $comparison);

            return $this;
        } elseif ($spyAvailability instanceof ObjectCollection) {
            $this
                ->useAvailabilityQuery()
                ->filterByPrimaryKeys($spyAvailability->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByAvailability() only accepts arguments of type \Orm\Zed\Availability\Persistence\SpyAvailability or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Availability relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinAvailability(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Availability');

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
            $this->addJoinObject($join, 'Availability');
        }

        return $this;
    }

    /**
     * Use the Availability relation SpyAvailability object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Availability\Persistence\SpyAvailabilityQuery A secondary query class using the current class as primary query
     */
    public function useAvailabilityQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinAvailability($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Availability', '\Orm\Zed\Availability\Persistence\SpyAvailabilityQuery');
    }

    /**
     * Use the Availability relation SpyAvailability object
     *
     * @param callable(\Orm\Zed\Availability\Persistence\SpyAvailabilityQuery):\Orm\Zed\Availability\Persistence\SpyAvailabilityQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withAvailabilityQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useAvailabilityQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the Availability relation to the SpyAvailability table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Availability\Persistence\SpyAvailabilityQuery The inner query object of the EXISTS statement
     */
    public function useAvailabilityExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Availability\Persistence\SpyAvailabilityQuery */
        $q = $this->useExistsQuery('Availability', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the Availability relation to the SpyAvailability table for a NOT EXISTS query.
     *
     * @see useAvailabilityExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Availability\Persistence\SpyAvailabilityQuery The inner query object of the NOT EXISTS statement
     */
    public function useAvailabilityNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Availability\Persistence\SpyAvailabilityQuery */
        $q = $this->useExistsQuery('Availability', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the Availability relation to the SpyAvailability table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Availability\Persistence\SpyAvailabilityQuery The inner query object of the IN statement
     */
    public function useInAvailabilityQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Availability\Persistence\SpyAvailabilityQuery */
        $q = $this->useInQuery('Availability', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the Availability relation to the SpyAvailability table for a NOT IN query.
     *
     * @see useAvailabilityInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Availability\Persistence\SpyAvailabilityQuery The inner query object of the NOT IN statement
     */
    public function useNotInAvailabilityQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Availability\Persistence\SpyAvailabilityQuery */
        $q = $this->useInQuery('Availability', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscription object
     *
     * @param \Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscription|ObjectCollection $spyAvailabilityNotificationSubscription the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyAvailabilityNotificationSubscription($spyAvailabilityNotificationSubscription, ?string $comparison = null)
    {
        if ($spyAvailabilityNotificationSubscription instanceof \Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscription) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyAvailabilityNotificationSubscription->getFkStore(), $comparison);

            return $this;
        } elseif ($spyAvailabilityNotificationSubscription instanceof ObjectCollection) {
            $this
                ->useSpyAvailabilityNotificationSubscriptionQuery()
                ->filterByPrimaryKeys($spyAvailabilityNotificationSubscription->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyAvailabilityNotificationSubscription() only accepts arguments of type \Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscription or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyAvailabilityNotificationSubscription relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyAvailabilityNotificationSubscription(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyAvailabilityNotificationSubscription');

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
            $this->addJoinObject($join, 'SpyAvailabilityNotificationSubscription');
        }

        return $this;
    }

    /**
     * Use the SpyAvailabilityNotificationSubscription relation SpyAvailabilityNotificationSubscription object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscriptionQuery A secondary query class using the current class as primary query
     */
    public function useSpyAvailabilityNotificationSubscriptionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyAvailabilityNotificationSubscription($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyAvailabilityNotificationSubscription', '\Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscriptionQuery');
    }

    /**
     * Use the SpyAvailabilityNotificationSubscription relation SpyAvailabilityNotificationSubscription object
     *
     * @param callable(\Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscriptionQuery):\Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscriptionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyAvailabilityNotificationSubscriptionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyAvailabilityNotificationSubscriptionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyAvailabilityNotificationSubscription table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscriptionQuery The inner query object of the EXISTS statement
     */
    public function useSpyAvailabilityNotificationSubscriptionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscriptionQuery */
        $q = $this->useExistsQuery('SpyAvailabilityNotificationSubscription', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyAvailabilityNotificationSubscription table for a NOT EXISTS query.
     *
     * @see useSpyAvailabilityNotificationSubscriptionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscriptionQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyAvailabilityNotificationSubscriptionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscriptionQuery */
        $q = $this->useExistsQuery('SpyAvailabilityNotificationSubscription', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyAvailabilityNotificationSubscription table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscriptionQuery The inner query object of the IN statement
     */
    public function useInSpyAvailabilityNotificationSubscriptionQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscriptionQuery */
        $q = $this->useInQuery('SpyAvailabilityNotificationSubscription', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyAvailabilityNotificationSubscription table for a NOT IN query.
     *
     * @see useSpyAvailabilityNotificationSubscriptionInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscriptionQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyAvailabilityNotificationSubscriptionQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscriptionQuery */
        $q = $this->useInQuery('SpyAvailabilityNotificationSubscription', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Category\Persistence\SpyCategoryStore object
     *
     * @param \Orm\Zed\Category\Persistence\SpyCategoryStore|ObjectCollection $spyCategoryStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCategoryStore($spyCategoryStore, ?string $comparison = null)
    {
        if ($spyCategoryStore instanceof \Orm\Zed\Category\Persistence\SpyCategoryStore) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyCategoryStore->getFkStore(), $comparison);

            return $this;
        } elseif ($spyCategoryStore instanceof ObjectCollection) {
            $this
                ->useSpyCategoryStoreQuery()
                ->filterByPrimaryKeys($spyCategoryStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyCategoryStore() only accepts arguments of type \Orm\Zed\Category\Persistence\SpyCategoryStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCategoryStore relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCategoryStore(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCategoryStore');

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
            $this->addJoinObject($join, 'SpyCategoryStore');
        }

        return $this;
    }

    /**
     * Use the SpyCategoryStore relation SpyCategoryStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryStoreQuery A secondary query class using the current class as primary query
     */
    public function useSpyCategoryStoreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyCategoryStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCategoryStore', '\Orm\Zed\Category\Persistence\SpyCategoryStoreQuery');
    }

    /**
     * Use the SpyCategoryStore relation SpyCategoryStore object
     *
     * @param callable(\Orm\Zed\Category\Persistence\SpyCategoryStoreQuery):\Orm\Zed\Category\Persistence\SpyCategoryStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCategoryStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyCategoryStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyCategoryStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryStoreQuery The inner query object of the EXISTS statement
     */
    public function useSpyCategoryStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryStoreQuery */
        $q = $this->useExistsQuery('SpyCategoryStore', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyCategoryStore table for a NOT EXISTS query.
     *
     * @see useSpyCategoryStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCategoryStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryStoreQuery */
        $q = $this->useExistsQuery('SpyCategoryStore', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyCategoryStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryStoreQuery The inner query object of the IN statement
     */
    public function useInSpyCategoryStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryStoreQuery */
        $q = $this->useInQuery('SpyCategoryStore', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyCategoryStore table for a NOT IN query.
     *
     * @see useSpyCategoryStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyCategoryStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryStoreQuery */
        $q = $this->useInQuery('SpyCategoryStore', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Cms\Persistence\SpyCmsPageStore object
     *
     * @param \Orm\Zed\Cms\Persistence\SpyCmsPageStore|ObjectCollection $spyCmsPageStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCmsPageStore($spyCmsPageStore, ?string $comparison = null)
    {
        if ($spyCmsPageStore instanceof \Orm\Zed\Cms\Persistence\SpyCmsPageStore) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyCmsPageStore->getFkStore(), $comparison);

            return $this;
        } elseif ($spyCmsPageStore instanceof ObjectCollection) {
            $this
                ->useSpyCmsPageStoreQuery()
                ->filterByPrimaryKeys($spyCmsPageStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyCmsPageStore() only accepts arguments of type \Orm\Zed\Cms\Persistence\SpyCmsPageStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCmsPageStore relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCmsPageStore(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCmsPageStore');

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
            $this->addJoinObject($join, 'SpyCmsPageStore');
        }

        return $this;
    }

    /**
     * Use the SpyCmsPageStore relation SpyCmsPageStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Cms\Persistence\SpyCmsPageStoreQuery A secondary query class using the current class as primary query
     */
    public function useSpyCmsPageStoreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyCmsPageStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCmsPageStore', '\Orm\Zed\Cms\Persistence\SpyCmsPageStoreQuery');
    }

    /**
     * Use the SpyCmsPageStore relation SpyCmsPageStore object
     *
     * @param callable(\Orm\Zed\Cms\Persistence\SpyCmsPageStoreQuery):\Orm\Zed\Cms\Persistence\SpyCmsPageStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCmsPageStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyCmsPageStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyCmsPageStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Cms\Persistence\SpyCmsPageStoreQuery The inner query object of the EXISTS statement
     */
    public function useSpyCmsPageStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Cms\Persistence\SpyCmsPageStoreQuery */
        $q = $this->useExistsQuery('SpyCmsPageStore', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyCmsPageStore table for a NOT EXISTS query.
     *
     * @see useSpyCmsPageStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Cms\Persistence\SpyCmsPageStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCmsPageStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Cms\Persistence\SpyCmsPageStoreQuery */
        $q = $this->useExistsQuery('SpyCmsPageStore', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyCmsPageStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Cms\Persistence\SpyCmsPageStoreQuery The inner query object of the IN statement
     */
    public function useInSpyCmsPageStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Cms\Persistence\SpyCmsPageStoreQuery */
        $q = $this->useInQuery('SpyCmsPageStore', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyCmsPageStore table for a NOT IN query.
     *
     * @see useSpyCmsPageStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Cms\Persistence\SpyCmsPageStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyCmsPageStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Cms\Persistence\SpyCmsPageStoreQuery */
        $q = $this->useInQuery('SpyCmsPageStore', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStore object
     *
     * @param \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStore|ObjectCollection $spyCmsBlockStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCmsBlockStore($spyCmsBlockStore, ?string $comparison = null)
    {
        if ($spyCmsBlockStore instanceof \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStore) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyCmsBlockStore->getFkStore(), $comparison);

            return $this;
        } elseif ($spyCmsBlockStore instanceof ObjectCollection) {
            $this
                ->useSpyCmsBlockStoreQuery()
                ->filterByPrimaryKeys($spyCmsBlockStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyCmsBlockStore() only accepts arguments of type \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCmsBlockStore relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCmsBlockStore(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCmsBlockStore');

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
            $this->addJoinObject($join, 'SpyCmsBlockStore');
        }

        return $this;
    }

    /**
     * Use the SpyCmsBlockStore relation SpyCmsBlockStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStoreQuery A secondary query class using the current class as primary query
     */
    public function useSpyCmsBlockStoreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyCmsBlockStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCmsBlockStore', '\Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStoreQuery');
    }

    /**
     * Use the SpyCmsBlockStore relation SpyCmsBlockStore object
     *
     * @param callable(\Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStoreQuery):\Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCmsBlockStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyCmsBlockStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyCmsBlockStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStoreQuery The inner query object of the EXISTS statement
     */
    public function useSpyCmsBlockStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStoreQuery */
        $q = $this->useExistsQuery('SpyCmsBlockStore', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyCmsBlockStore table for a NOT EXISTS query.
     *
     * @see useSpyCmsBlockStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCmsBlockStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStoreQuery */
        $q = $this->useExistsQuery('SpyCmsBlockStore', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyCmsBlockStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStoreQuery The inner query object of the IN statement
     */
    public function useInSpyCmsBlockStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStoreQuery */
        $q = $this->useInQuery('SpyCmsBlockStore', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyCmsBlockStore table for a NOT IN query.
     *
     * @see useSpyCmsBlockStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyCmsBlockStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStoreQuery */
        $q = $this->useInQuery('SpyCmsBlockStore', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Company\Persistence\SpyCompanyStore object
     *
     * @param \Orm\Zed\Company\Persistence\SpyCompanyStore|ObjectCollection $spyCompanyStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCompanyStore($spyCompanyStore, ?string $comparison = null)
    {
        if ($spyCompanyStore instanceof \Orm\Zed\Company\Persistence\SpyCompanyStore) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyCompanyStore->getFkStore(), $comparison);

            return $this;
        } elseif ($spyCompanyStore instanceof ObjectCollection) {
            $this
                ->useSpyCompanyStoreQuery()
                ->filterByPrimaryKeys($spyCompanyStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyCompanyStore() only accepts arguments of type \Orm\Zed\Company\Persistence\SpyCompanyStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCompanyStore relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCompanyStore(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCompanyStore');

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
            $this->addJoinObject($join, 'SpyCompanyStore');
        }

        return $this;
    }

    /**
     * Use the SpyCompanyStore relation SpyCompanyStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Company\Persistence\SpyCompanyStoreQuery A secondary query class using the current class as primary query
     */
    public function useSpyCompanyStoreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyCompanyStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCompanyStore', '\Orm\Zed\Company\Persistence\SpyCompanyStoreQuery');
    }

    /**
     * Use the SpyCompanyStore relation SpyCompanyStore object
     *
     * @param callable(\Orm\Zed\Company\Persistence\SpyCompanyStoreQuery):\Orm\Zed\Company\Persistence\SpyCompanyStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCompanyStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyCompanyStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyCompanyStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Company\Persistence\SpyCompanyStoreQuery The inner query object of the EXISTS statement
     */
    public function useSpyCompanyStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Company\Persistence\SpyCompanyStoreQuery */
        $q = $this->useExistsQuery('SpyCompanyStore', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyCompanyStore table for a NOT EXISTS query.
     *
     * @see useSpyCompanyStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Company\Persistence\SpyCompanyStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCompanyStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Company\Persistence\SpyCompanyStoreQuery */
        $q = $this->useExistsQuery('SpyCompanyStore', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyCompanyStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Company\Persistence\SpyCompanyStoreQuery The inner query object of the IN statement
     */
    public function useInSpyCompanyStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Company\Persistence\SpyCompanyStoreQuery */
        $q = $this->useInQuery('SpyCompanyStore', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyCompanyStore table for a NOT IN query.
     *
     * @see useSpyCompanyStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Company\Persistence\SpyCompanyStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyCompanyStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Company\Persistence\SpyCompanyStoreQuery */
        $q = $this->useInQuery('SpyCompanyStore', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Country\Persistence\SpyCountryStore object
     *
     * @param \Orm\Zed\Country\Persistence\SpyCountryStore|ObjectCollection $spyCountryStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCountryStore($spyCountryStore, ?string $comparison = null)
    {
        if ($spyCountryStore instanceof \Orm\Zed\Country\Persistence\SpyCountryStore) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyCountryStore->getFkStore(), $comparison);

            return $this;
        } elseif ($spyCountryStore instanceof ObjectCollection) {
            $this
                ->useCountryStoreQuery()
                ->filterByPrimaryKeys($spyCountryStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByCountryStore() only accepts arguments of type \Orm\Zed\Country\Persistence\SpyCountryStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CountryStore relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCountryStore(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CountryStore');

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
            $this->addJoinObject($join, 'CountryStore');
        }

        return $this;
    }

    /**
     * Use the CountryStore relation SpyCountryStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Country\Persistence\SpyCountryStoreQuery A secondary query class using the current class as primary query
     */
    public function useCountryStoreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCountryStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CountryStore', '\Orm\Zed\Country\Persistence\SpyCountryStoreQuery');
    }

    /**
     * Use the CountryStore relation SpyCountryStore object
     *
     * @param callable(\Orm\Zed\Country\Persistence\SpyCountryStoreQuery):\Orm\Zed\Country\Persistence\SpyCountryStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCountryStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCountryStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the CountryStore relation to the SpyCountryStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Country\Persistence\SpyCountryStoreQuery The inner query object of the EXISTS statement
     */
    public function useCountryStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Country\Persistence\SpyCountryStoreQuery */
        $q = $this->useExistsQuery('CountryStore', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the CountryStore relation to the SpyCountryStore table for a NOT EXISTS query.
     *
     * @see useCountryStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Country\Persistence\SpyCountryStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useCountryStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Country\Persistence\SpyCountryStoreQuery */
        $q = $this->useExistsQuery('CountryStore', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the CountryStore relation to the SpyCountryStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Country\Persistence\SpyCountryStoreQuery The inner query object of the IN statement
     */
    public function useInCountryStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Country\Persistence\SpyCountryStoreQuery */
        $q = $this->useInQuery('CountryStore', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the CountryStore relation to the SpyCountryStore table for a NOT IN query.
     *
     * @see useCountryStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Country\Persistence\SpyCountryStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInCountryStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Country\Persistence\SpyCountryStoreQuery */
        $q = $this->useInQuery('CountryStore', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Currency\Persistence\SpyCurrencyStore object
     *
     * @param \Orm\Zed\Currency\Persistence\SpyCurrencyStore|ObjectCollection $spyCurrencyStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCurrencyStore($spyCurrencyStore, ?string $comparison = null)
    {
        if ($spyCurrencyStore instanceof \Orm\Zed\Currency\Persistence\SpyCurrencyStore) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyCurrencyStore->getFkStore(), $comparison);

            return $this;
        } elseif ($spyCurrencyStore instanceof ObjectCollection) {
            $this
                ->useCurrencyStoreQuery()
                ->filterByPrimaryKeys($spyCurrencyStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByCurrencyStore() only accepts arguments of type \Orm\Zed\Currency\Persistence\SpyCurrencyStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CurrencyStore relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCurrencyStore(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CurrencyStore');

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
            $this->addJoinObject($join, 'CurrencyStore');
        }

        return $this;
    }

    /**
     * Use the CurrencyStore relation SpyCurrencyStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Currency\Persistence\SpyCurrencyStoreQuery A secondary query class using the current class as primary query
     */
    public function useCurrencyStoreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCurrencyStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CurrencyStore', '\Orm\Zed\Currency\Persistence\SpyCurrencyStoreQuery');
    }

    /**
     * Use the CurrencyStore relation SpyCurrencyStore object
     *
     * @param callable(\Orm\Zed\Currency\Persistence\SpyCurrencyStoreQuery):\Orm\Zed\Currency\Persistence\SpyCurrencyStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCurrencyStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCurrencyStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the CurrencyStore relation to the SpyCurrencyStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Currency\Persistence\SpyCurrencyStoreQuery The inner query object of the EXISTS statement
     */
    public function useCurrencyStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Currency\Persistence\SpyCurrencyStoreQuery */
        $q = $this->useExistsQuery('CurrencyStore', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the CurrencyStore relation to the SpyCurrencyStore table for a NOT EXISTS query.
     *
     * @see useCurrencyStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Currency\Persistence\SpyCurrencyStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useCurrencyStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Currency\Persistence\SpyCurrencyStoreQuery */
        $q = $this->useExistsQuery('CurrencyStore', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the CurrencyStore relation to the SpyCurrencyStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Currency\Persistence\SpyCurrencyStoreQuery The inner query object of the IN statement
     */
    public function useInCurrencyStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Currency\Persistence\SpyCurrencyStoreQuery */
        $q = $this->useInQuery('CurrencyStore', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the CurrencyStore relation to the SpyCurrencyStore table for a NOT IN query.
     *
     * @see useCurrencyStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Currency\Persistence\SpyCurrencyStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInCurrencyStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Currency\Persistence\SpyCurrencyStoreQuery */
        $q = $this->useInQuery('CurrencyStore', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Discount\Persistence\SpyDiscount object
     *
     * @param \Orm\Zed\Discount\Persistence\SpyDiscount|ObjectCollection $spyDiscount the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDiscount($spyDiscount, ?string $comparison = null)
    {
        if ($spyDiscount instanceof \Orm\Zed\Discount\Persistence\SpyDiscount) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyDiscount->getFkStore(), $comparison);

            return $this;
        } elseif ($spyDiscount instanceof ObjectCollection) {
            $this
                ->useDiscountQuery()
                ->filterByPrimaryKeys($spyDiscount->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByDiscount() only accepts arguments of type \Orm\Zed\Discount\Persistence\SpyDiscount or Collection');
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
     * Use the Discount relation SpyDiscount object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Discount\Persistence\SpyDiscountQuery A secondary query class using the current class as primary query
     */
    public function useDiscountQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinDiscount($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Discount', '\Orm\Zed\Discount\Persistence\SpyDiscountQuery');
    }

    /**
     * Use the Discount relation SpyDiscount object
     *
     * @param callable(\Orm\Zed\Discount\Persistence\SpyDiscountQuery):\Orm\Zed\Discount\Persistence\SpyDiscountQuery $callable A function working on the related query
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
     * Use the Discount relation to the SpyDiscount table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Discount\Persistence\SpyDiscountQuery The inner query object of the EXISTS statement
     */
    public function useDiscountExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Discount\Persistence\SpyDiscountQuery */
        $q = $this->useExistsQuery('Discount', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the Discount relation to the SpyDiscount table for a NOT EXISTS query.
     *
     * @see useDiscountExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Discount\Persistence\SpyDiscountQuery The inner query object of the NOT EXISTS statement
     */
    public function useDiscountNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Discount\Persistence\SpyDiscountQuery */
        $q = $this->useExistsQuery('Discount', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the Discount relation to the SpyDiscount table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Discount\Persistence\SpyDiscountQuery The inner query object of the IN statement
     */
    public function useInDiscountQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Discount\Persistence\SpyDiscountQuery */
        $q = $this->useInQuery('Discount', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the Discount relation to the SpyDiscount table for a NOT IN query.
     *
     * @see useDiscountInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Discount\Persistence\SpyDiscountQuery The inner query object of the NOT IN statement
     */
    public function useNotInDiscountQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Discount\Persistence\SpyDiscountQuery */
        $q = $this->useInQuery('Discount', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Discount\Persistence\SpyDiscountStore object
     *
     * @param \Orm\Zed\Discount\Persistence\SpyDiscountStore|ObjectCollection $spyDiscountStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyDiscountStore($spyDiscountStore, ?string $comparison = null)
    {
        if ($spyDiscountStore instanceof \Orm\Zed\Discount\Persistence\SpyDiscountStore) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyDiscountStore->getFkStore(), $comparison);

            return $this;
        } elseif ($spyDiscountStore instanceof ObjectCollection) {
            $this
                ->useSpyDiscountStoreQuery()
                ->filterByPrimaryKeys($spyDiscountStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyDiscountStore() only accepts arguments of type \Orm\Zed\Discount\Persistence\SpyDiscountStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyDiscountStore relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyDiscountStore(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyDiscountStore');

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
            $this->addJoinObject($join, 'SpyDiscountStore');
        }

        return $this;
    }

    /**
     * Use the SpyDiscountStore relation SpyDiscountStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Discount\Persistence\SpyDiscountStoreQuery A secondary query class using the current class as primary query
     */
    public function useSpyDiscountStoreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyDiscountStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyDiscountStore', '\Orm\Zed\Discount\Persistence\SpyDiscountStoreQuery');
    }

    /**
     * Use the SpyDiscountStore relation SpyDiscountStore object
     *
     * @param callable(\Orm\Zed\Discount\Persistence\SpyDiscountStoreQuery):\Orm\Zed\Discount\Persistence\SpyDiscountStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyDiscountStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyDiscountStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyDiscountStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Discount\Persistence\SpyDiscountStoreQuery The inner query object of the EXISTS statement
     */
    public function useSpyDiscountStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Discount\Persistence\SpyDiscountStoreQuery */
        $q = $this->useExistsQuery('SpyDiscountStore', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyDiscountStore table for a NOT EXISTS query.
     *
     * @see useSpyDiscountStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Discount\Persistence\SpyDiscountStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyDiscountStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Discount\Persistence\SpyDiscountStoreQuery */
        $q = $this->useExistsQuery('SpyDiscountStore', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyDiscountStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Discount\Persistence\SpyDiscountStoreQuery The inner query object of the IN statement
     */
    public function useInSpyDiscountStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Discount\Persistence\SpyDiscountStoreQuery */
        $q = $this->useInQuery('SpyDiscountStore', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyDiscountStore table for a NOT IN query.
     *
     * @see useSpyDiscountStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Discount\Persistence\SpyDiscountStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyDiscountStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Discount\Persistence\SpyDiscountStoreQuery */
        $q = $this->useInQuery('SpyDiscountStore', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Locale\Persistence\SpyLocaleStore object
     *
     * @param \Orm\Zed\Locale\Persistence\SpyLocaleStore|ObjectCollection $spyLocaleStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLocaleStore($spyLocaleStore, ?string $comparison = null)
    {
        if ($spyLocaleStore instanceof \Orm\Zed\Locale\Persistence\SpyLocaleStore) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyLocaleStore->getFkStore(), $comparison);

            return $this;
        } elseif ($spyLocaleStore instanceof ObjectCollection) {
            $this
                ->useLocaleStoreQuery()
                ->filterByPrimaryKeys($spyLocaleStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByLocaleStore() only accepts arguments of type \Orm\Zed\Locale\Persistence\SpyLocaleStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LocaleStore relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinLocaleStore(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LocaleStore');

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
            $this->addJoinObject($join, 'LocaleStore');
        }

        return $this;
    }

    /**
     * Use the LocaleStore relation SpyLocaleStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleStoreQuery A secondary query class using the current class as primary query
     */
    public function useLocaleStoreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLocaleStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LocaleStore', '\Orm\Zed\Locale\Persistence\SpyLocaleStoreQuery');
    }

    /**
     * Use the LocaleStore relation SpyLocaleStore object
     *
     * @param callable(\Orm\Zed\Locale\Persistence\SpyLocaleStoreQuery):\Orm\Zed\Locale\Persistence\SpyLocaleStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withLocaleStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useLocaleStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the LocaleStore relation to the SpyLocaleStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleStoreQuery The inner query object of the EXISTS statement
     */
    public function useLocaleStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Locale\Persistence\SpyLocaleStoreQuery */
        $q = $this->useExistsQuery('LocaleStore', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the LocaleStore relation to the SpyLocaleStore table for a NOT EXISTS query.
     *
     * @see useLocaleStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useLocaleStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Locale\Persistence\SpyLocaleStoreQuery */
        $q = $this->useExistsQuery('LocaleStore', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the LocaleStore relation to the SpyLocaleStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleStoreQuery The inner query object of the IN statement
     */
    public function useInLocaleStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Locale\Persistence\SpyLocaleStoreQuery */
        $q = $this->useInQuery('LocaleStore', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the LocaleStore relation to the SpyLocaleStore table for a NOT IN query.
     *
     * @see useLocaleStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInLocaleStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Locale\Persistence\SpyLocaleStoreQuery */
        $q = $this->useInQuery('LocaleStore', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Merchant\Persistence\SpyMerchantStore object
     *
     * @param \Orm\Zed\Merchant\Persistence\SpyMerchantStore|ObjectCollection $spyMerchantStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyMerchantStore($spyMerchantStore, ?string $comparison = null)
    {
        if ($spyMerchantStore instanceof \Orm\Zed\Merchant\Persistence\SpyMerchantStore) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyMerchantStore->getFkStore(), $comparison);

            return $this;
        } elseif ($spyMerchantStore instanceof ObjectCollection) {
            $this
                ->useSpyMerchantStoreQuery()
                ->filterByPrimaryKeys($spyMerchantStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyMerchantStore() only accepts arguments of type \Orm\Zed\Merchant\Persistence\SpyMerchantStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyMerchantStore relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyMerchantStore(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyMerchantStore');

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
            $this->addJoinObject($join, 'SpyMerchantStore');
        }

        return $this;
    }

    /**
     * Use the SpyMerchantStore relation SpyMerchantStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchantStoreQuery A secondary query class using the current class as primary query
     */
    public function useSpyMerchantStoreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyMerchantStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyMerchantStore', '\Orm\Zed\Merchant\Persistence\SpyMerchantStoreQuery');
    }

    /**
     * Use the SpyMerchantStore relation SpyMerchantStore object
     *
     * @param callable(\Orm\Zed\Merchant\Persistence\SpyMerchantStoreQuery):\Orm\Zed\Merchant\Persistence\SpyMerchantStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyMerchantStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyMerchantStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyMerchantStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchantStoreQuery The inner query object of the EXISTS statement
     */
    public function useSpyMerchantStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Merchant\Persistence\SpyMerchantStoreQuery */
        $q = $this->useExistsQuery('SpyMerchantStore', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantStore table for a NOT EXISTS query.
     *
     * @see useSpyMerchantStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchantStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyMerchantStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Merchant\Persistence\SpyMerchantStoreQuery */
        $q = $this->useExistsQuery('SpyMerchantStore', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyMerchantStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchantStoreQuery The inner query object of the IN statement
     */
    public function useInSpyMerchantStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Merchant\Persistence\SpyMerchantStoreQuery */
        $q = $this->useInQuery('SpyMerchantStore', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantStore table for a NOT IN query.
     *
     * @see useSpyMerchantStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchantStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyMerchantStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Merchant\Persistence\SpyMerchantStoreQuery */
        $q = $this->useInQuery('SpyMerchantStore', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStore object
     *
     * @param \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStore|ObjectCollection $spyMerchantCommissionStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMerchantCommission($spyMerchantCommissionStore, ?string $comparison = null)
    {
        if ($spyMerchantCommissionStore instanceof \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStore) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyMerchantCommissionStore->getFkStore(), $comparison);

            return $this;
        } elseif ($spyMerchantCommissionStore instanceof ObjectCollection) {
            $this
                ->useMerchantCommissionQuery()
                ->filterByPrimaryKeys($spyMerchantCommissionStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByMerchantCommission() only accepts arguments of type \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MerchantCommission relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinMerchantCommission(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MerchantCommission');

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
            $this->addJoinObject($join, 'MerchantCommission');
        }

        return $this;
    }

    /**
     * Use the MerchantCommission relation SpyMerchantCommissionStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStoreQuery A secondary query class using the current class as primary query
     */
    public function useMerchantCommissionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMerchantCommission($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MerchantCommission', '\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStoreQuery');
    }

    /**
     * Use the MerchantCommission relation SpyMerchantCommissionStore object
     *
     * @param callable(\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStoreQuery):\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withMerchantCommissionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useMerchantCommissionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the MerchantCommission relation to the SpyMerchantCommissionStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStoreQuery The inner query object of the EXISTS statement
     */
    public function useMerchantCommissionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStoreQuery */
        $q = $this->useExistsQuery('MerchantCommission', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the MerchantCommission relation to the SpyMerchantCommissionStore table for a NOT EXISTS query.
     *
     * @see useMerchantCommissionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useMerchantCommissionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStoreQuery */
        $q = $this->useExistsQuery('MerchantCommission', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the MerchantCommission relation to the SpyMerchantCommissionStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStoreQuery The inner query object of the IN statement
     */
    public function useInMerchantCommissionQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStoreQuery */
        $q = $this->useInQuery('MerchantCommission', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the MerchantCommission relation to the SpyMerchantCommissionStore table for a NOT IN query.
     *
     * @see useMerchantCommissionInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInMerchantCommissionQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStoreQuery */
        $q = $this->useInQuery('MerchantCommission', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequest object
     *
     * @param \Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequest|ObjectCollection $spyMerchantRegistrationRequest the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyMerchantRegistrationRequest($spyMerchantRegistrationRequest, ?string $comparison = null)
    {
        if ($spyMerchantRegistrationRequest instanceof \Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequest) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyMerchantRegistrationRequest->getFkStore(), $comparison);

            return $this;
        } elseif ($spyMerchantRegistrationRequest instanceof ObjectCollection) {
            $this
                ->useSpyMerchantRegistrationRequestQuery()
                ->filterByPrimaryKeys($spyMerchantRegistrationRequest->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyMerchantRegistrationRequest() only accepts arguments of type \Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequest or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyMerchantRegistrationRequest relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyMerchantRegistrationRequest(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyMerchantRegistrationRequest');

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
            $this->addJoinObject($join, 'SpyMerchantRegistrationRequest');
        }

        return $this;
    }

    /**
     * Use the SpyMerchantRegistrationRequest relation SpyMerchantRegistrationRequest object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequestQuery A secondary query class using the current class as primary query
     */
    public function useSpyMerchantRegistrationRequestQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyMerchantRegistrationRequest($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyMerchantRegistrationRequest', '\Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequestQuery');
    }

    /**
     * Use the SpyMerchantRegistrationRequest relation SpyMerchantRegistrationRequest object
     *
     * @param callable(\Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequestQuery):\Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequestQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyMerchantRegistrationRequestQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyMerchantRegistrationRequestQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyMerchantRegistrationRequest table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequestQuery The inner query object of the EXISTS statement
     */
    public function useSpyMerchantRegistrationRequestExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequestQuery */
        $q = $this->useExistsQuery('SpyMerchantRegistrationRequest', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantRegistrationRequest table for a NOT EXISTS query.
     *
     * @see useSpyMerchantRegistrationRequestExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequestQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyMerchantRegistrationRequestNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequestQuery */
        $q = $this->useExistsQuery('SpyMerchantRegistrationRequest', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyMerchantRegistrationRequest table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequestQuery The inner query object of the IN statement
     */
    public function useInSpyMerchantRegistrationRequestQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequestQuery */
        $q = $this->useInQuery('SpyMerchantRegistrationRequest', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantRegistrationRequest table for a NOT IN query.
     *
     * @see useSpyMerchantRegistrationRequestInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequestQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyMerchantRegistrationRequestQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequestQuery */
        $q = $this->useInQuery('SpyMerchantRegistrationRequest', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\MerchantRelationshipSalesOrderThreshold\Persistence\SpyMerchantRelationshipSalesOrderThreshold object
     *
     * @param \Orm\Zed\MerchantRelationshipSalesOrderThreshold\Persistence\SpyMerchantRelationshipSalesOrderThreshold|ObjectCollection $spyMerchantRelationshipSalesOrderThreshold the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyMerchantRelationshipSalesOrderThreshold($spyMerchantRelationshipSalesOrderThreshold, ?string $comparison = null)
    {
        if ($spyMerchantRelationshipSalesOrderThreshold instanceof \Orm\Zed\MerchantRelationshipSalesOrderThreshold\Persistence\SpyMerchantRelationshipSalesOrderThreshold) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyMerchantRelationshipSalesOrderThreshold->getFkStore(), $comparison);

            return $this;
        } elseif ($spyMerchantRelationshipSalesOrderThreshold instanceof ObjectCollection) {
            $this
                ->useSpyMerchantRelationshipSalesOrderThresholdQuery()
                ->filterByPrimaryKeys($spyMerchantRelationshipSalesOrderThreshold->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyMerchantRelationshipSalesOrderThreshold() only accepts arguments of type \Orm\Zed\MerchantRelationshipSalesOrderThreshold\Persistence\SpyMerchantRelationshipSalesOrderThreshold or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyMerchantRelationshipSalesOrderThreshold relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyMerchantRelationshipSalesOrderThreshold(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyMerchantRelationshipSalesOrderThreshold');

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
            $this->addJoinObject($join, 'SpyMerchantRelationshipSalesOrderThreshold');
        }

        return $this;
    }

    /**
     * Use the SpyMerchantRelationshipSalesOrderThreshold relation SpyMerchantRelationshipSalesOrderThreshold object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MerchantRelationshipSalesOrderThreshold\Persistence\SpyMerchantRelationshipSalesOrderThresholdQuery A secondary query class using the current class as primary query
     */
    public function useSpyMerchantRelationshipSalesOrderThresholdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyMerchantRelationshipSalesOrderThreshold($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyMerchantRelationshipSalesOrderThreshold', '\Orm\Zed\MerchantRelationshipSalesOrderThreshold\Persistence\SpyMerchantRelationshipSalesOrderThresholdQuery');
    }

    /**
     * Use the SpyMerchantRelationshipSalesOrderThreshold relation SpyMerchantRelationshipSalesOrderThreshold object
     *
     * @param callable(\Orm\Zed\MerchantRelationshipSalesOrderThreshold\Persistence\SpyMerchantRelationshipSalesOrderThresholdQuery):\Orm\Zed\MerchantRelationshipSalesOrderThreshold\Persistence\SpyMerchantRelationshipSalesOrderThresholdQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyMerchantRelationshipSalesOrderThresholdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyMerchantRelationshipSalesOrderThresholdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyMerchantRelationshipSalesOrderThreshold table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MerchantRelationshipSalesOrderThreshold\Persistence\SpyMerchantRelationshipSalesOrderThresholdQuery The inner query object of the EXISTS statement
     */
    public function useSpyMerchantRelationshipSalesOrderThresholdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MerchantRelationshipSalesOrderThreshold\Persistence\SpyMerchantRelationshipSalesOrderThresholdQuery */
        $q = $this->useExistsQuery('SpyMerchantRelationshipSalesOrderThreshold', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantRelationshipSalesOrderThreshold table for a NOT EXISTS query.
     *
     * @see useSpyMerchantRelationshipSalesOrderThresholdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantRelationshipSalesOrderThreshold\Persistence\SpyMerchantRelationshipSalesOrderThresholdQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyMerchantRelationshipSalesOrderThresholdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantRelationshipSalesOrderThreshold\Persistence\SpyMerchantRelationshipSalesOrderThresholdQuery */
        $q = $this->useExistsQuery('SpyMerchantRelationshipSalesOrderThreshold', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyMerchantRelationshipSalesOrderThreshold table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MerchantRelationshipSalesOrderThreshold\Persistence\SpyMerchantRelationshipSalesOrderThresholdQuery The inner query object of the IN statement
     */
    public function useInSpyMerchantRelationshipSalesOrderThresholdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MerchantRelationshipSalesOrderThreshold\Persistence\SpyMerchantRelationshipSalesOrderThresholdQuery */
        $q = $this->useInQuery('SpyMerchantRelationshipSalesOrderThreshold', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantRelationshipSalesOrderThreshold table for a NOT IN query.
     *
     * @see useSpyMerchantRelationshipSalesOrderThresholdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantRelationshipSalesOrderThreshold\Persistence\SpyMerchantRelationshipSalesOrderThresholdQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyMerchantRelationshipSalesOrderThresholdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantRelationshipSalesOrderThreshold\Persistence\SpyMerchantRelationshipSalesOrderThresholdQuery */
        $q = $this->useInQuery('SpyMerchantRelationshipSalesOrderThreshold', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Oms\Persistence\SpyOmsProductReservation object
     *
     * @param \Orm\Zed\Oms\Persistence\SpyOmsProductReservation|ObjectCollection $spyOmsProductReservation the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOmsProductReservation($spyOmsProductReservation, ?string $comparison = null)
    {
        if ($spyOmsProductReservation instanceof \Orm\Zed\Oms\Persistence\SpyOmsProductReservation) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyOmsProductReservation->getFkStore(), $comparison);

            return $this;
        } elseif ($spyOmsProductReservation instanceof ObjectCollection) {
            $this
                ->useOmsProductReservationQuery()
                ->filterByPrimaryKeys($spyOmsProductReservation->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOmsProductReservation() only accepts arguments of type \Orm\Zed\Oms\Persistence\SpyOmsProductReservation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OmsProductReservation relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOmsProductReservation(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OmsProductReservation');

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
            $this->addJoinObject($join, 'OmsProductReservation');
        }

        return $this;
    }

    /**
     * Use the OmsProductReservation relation SpyOmsProductReservation object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Oms\Persistence\SpyOmsProductReservationQuery A secondary query class using the current class as primary query
     */
    public function useOmsProductReservationQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOmsProductReservation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OmsProductReservation', '\Orm\Zed\Oms\Persistence\SpyOmsProductReservationQuery');
    }

    /**
     * Use the OmsProductReservation relation SpyOmsProductReservation object
     *
     * @param callable(\Orm\Zed\Oms\Persistence\SpyOmsProductReservationQuery):\Orm\Zed\Oms\Persistence\SpyOmsProductReservationQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOmsProductReservationQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOmsProductReservationQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the OmsProductReservation relation to the SpyOmsProductReservation table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Oms\Persistence\SpyOmsProductReservationQuery The inner query object of the EXISTS statement
     */
    public function useOmsProductReservationExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Oms\Persistence\SpyOmsProductReservationQuery */
        $q = $this->useExistsQuery('OmsProductReservation', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the OmsProductReservation relation to the SpyOmsProductReservation table for a NOT EXISTS query.
     *
     * @see useOmsProductReservationExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Oms\Persistence\SpyOmsProductReservationQuery The inner query object of the NOT EXISTS statement
     */
    public function useOmsProductReservationNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Oms\Persistence\SpyOmsProductReservationQuery */
        $q = $this->useExistsQuery('OmsProductReservation', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the OmsProductReservation relation to the SpyOmsProductReservation table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Oms\Persistence\SpyOmsProductReservationQuery The inner query object of the IN statement
     */
    public function useInOmsProductReservationQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Oms\Persistence\SpyOmsProductReservationQuery */
        $q = $this->useInQuery('OmsProductReservation', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the OmsProductReservation relation to the SpyOmsProductReservation table for a NOT IN query.
     *
     * @see useOmsProductReservationInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Oms\Persistence\SpyOmsProductReservationQuery The inner query object of the NOT IN statement
     */
    public function useNotInOmsProductReservationQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Oms\Persistence\SpyOmsProductReservationQuery */
        $q = $this->useInQuery('OmsProductReservation', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\OmsProductOfferReservation\Persistence\SpyOmsProductOfferReservation object
     *
     * @param \Orm\Zed\OmsProductOfferReservation\Persistence\SpyOmsProductOfferReservation|ObjectCollection $spyOmsProductOfferReservation the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOmsProductOfferReservation($spyOmsProductOfferReservation, ?string $comparison = null)
    {
        if ($spyOmsProductOfferReservation instanceof \Orm\Zed\OmsProductOfferReservation\Persistence\SpyOmsProductOfferReservation) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyOmsProductOfferReservation->getFkStore(), $comparison);

            return $this;
        } elseif ($spyOmsProductOfferReservation instanceof ObjectCollection) {
            $this
                ->useOmsProductOfferReservationQuery()
                ->filterByPrimaryKeys($spyOmsProductOfferReservation->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOmsProductOfferReservation() only accepts arguments of type \Orm\Zed\OmsProductOfferReservation\Persistence\SpyOmsProductOfferReservation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OmsProductOfferReservation relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOmsProductOfferReservation(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OmsProductOfferReservation');

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
            $this->addJoinObject($join, 'OmsProductOfferReservation');
        }

        return $this;
    }

    /**
     * Use the OmsProductOfferReservation relation SpyOmsProductOfferReservation object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\OmsProductOfferReservation\Persistence\SpyOmsProductOfferReservationQuery A secondary query class using the current class as primary query
     */
    public function useOmsProductOfferReservationQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOmsProductOfferReservation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OmsProductOfferReservation', '\Orm\Zed\OmsProductOfferReservation\Persistence\SpyOmsProductOfferReservationQuery');
    }

    /**
     * Use the OmsProductOfferReservation relation SpyOmsProductOfferReservation object
     *
     * @param callable(\Orm\Zed\OmsProductOfferReservation\Persistence\SpyOmsProductOfferReservationQuery):\Orm\Zed\OmsProductOfferReservation\Persistence\SpyOmsProductOfferReservationQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOmsProductOfferReservationQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOmsProductOfferReservationQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the OmsProductOfferReservation relation to the SpyOmsProductOfferReservation table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\OmsProductOfferReservation\Persistence\SpyOmsProductOfferReservationQuery The inner query object of the EXISTS statement
     */
    public function useOmsProductOfferReservationExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\OmsProductOfferReservation\Persistence\SpyOmsProductOfferReservationQuery */
        $q = $this->useExistsQuery('OmsProductOfferReservation', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the OmsProductOfferReservation relation to the SpyOmsProductOfferReservation table for a NOT EXISTS query.
     *
     * @see useOmsProductOfferReservationExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\OmsProductOfferReservation\Persistence\SpyOmsProductOfferReservationQuery The inner query object of the NOT EXISTS statement
     */
    public function useOmsProductOfferReservationNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\OmsProductOfferReservation\Persistence\SpyOmsProductOfferReservationQuery */
        $q = $this->useExistsQuery('OmsProductOfferReservation', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the OmsProductOfferReservation relation to the SpyOmsProductOfferReservation table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\OmsProductOfferReservation\Persistence\SpyOmsProductOfferReservationQuery The inner query object of the IN statement
     */
    public function useInOmsProductOfferReservationQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\OmsProductOfferReservation\Persistence\SpyOmsProductOfferReservationQuery */
        $q = $this->useInQuery('OmsProductOfferReservation', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the OmsProductOfferReservation relation to the SpyOmsProductOfferReservation table for a NOT IN query.
     *
     * @see useOmsProductOfferReservationInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\OmsProductOfferReservation\Persistence\SpyOmsProductOfferReservationQuery The inner query object of the NOT IN statement
     */
    public function useNotInOmsProductOfferReservationQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\OmsProductOfferReservation\Persistence\SpyOmsProductOfferReservationQuery */
        $q = $this->useInQuery('OmsProductOfferReservation', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Payment\Persistence\SpyPaymentMethodStore object
     *
     * @param \Orm\Zed\Payment\Persistence\SpyPaymentMethodStore|ObjectCollection $spyPaymentMethodStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyPaymentMethodStore($spyPaymentMethodStore, ?string $comparison = null)
    {
        if ($spyPaymentMethodStore instanceof \Orm\Zed\Payment\Persistence\SpyPaymentMethodStore) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyPaymentMethodStore->getFkStore(), $comparison);

            return $this;
        } elseif ($spyPaymentMethodStore instanceof ObjectCollection) {
            $this
                ->useSpyPaymentMethodStoreQuery()
                ->filterByPrimaryKeys($spyPaymentMethodStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyPaymentMethodStore() only accepts arguments of type \Orm\Zed\Payment\Persistence\SpyPaymentMethodStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyPaymentMethodStore relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyPaymentMethodStore(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyPaymentMethodStore');

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
            $this->addJoinObject($join, 'SpyPaymentMethodStore');
        }

        return $this;
    }

    /**
     * Use the SpyPaymentMethodStore relation SpyPaymentMethodStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Payment\Persistence\SpyPaymentMethodStoreQuery A secondary query class using the current class as primary query
     */
    public function useSpyPaymentMethodStoreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyPaymentMethodStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyPaymentMethodStore', '\Orm\Zed\Payment\Persistence\SpyPaymentMethodStoreQuery');
    }

    /**
     * Use the SpyPaymentMethodStore relation SpyPaymentMethodStore object
     *
     * @param callable(\Orm\Zed\Payment\Persistence\SpyPaymentMethodStoreQuery):\Orm\Zed\Payment\Persistence\SpyPaymentMethodStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyPaymentMethodStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyPaymentMethodStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyPaymentMethodStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Payment\Persistence\SpyPaymentMethodStoreQuery The inner query object of the EXISTS statement
     */
    public function useSpyPaymentMethodStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Payment\Persistence\SpyPaymentMethodStoreQuery */
        $q = $this->useExistsQuery('SpyPaymentMethodStore', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyPaymentMethodStore table for a NOT EXISTS query.
     *
     * @see useSpyPaymentMethodStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Payment\Persistence\SpyPaymentMethodStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyPaymentMethodStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Payment\Persistence\SpyPaymentMethodStoreQuery */
        $q = $this->useExistsQuery('SpyPaymentMethodStore', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyPaymentMethodStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Payment\Persistence\SpyPaymentMethodStoreQuery The inner query object of the IN statement
     */
    public function useInSpyPaymentMethodStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Payment\Persistence\SpyPaymentMethodStoreQuery */
        $q = $this->useInQuery('SpyPaymentMethodStore', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyPaymentMethodStore table for a NOT IN query.
     *
     * @see useSpyPaymentMethodStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Payment\Persistence\SpyPaymentMethodStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyPaymentMethodStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Payment\Persistence\SpyPaymentMethodStoreQuery */
        $q = $this->useInQuery('SpyPaymentMethodStore', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\PriceProduct\Persistence\SpyPriceProductStore object
     *
     * @param \Orm\Zed\PriceProduct\Persistence\SpyPriceProductStore|ObjectCollection $spyPriceProductStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPriceProductStore($spyPriceProductStore, ?string $comparison = null)
    {
        if ($spyPriceProductStore instanceof \Orm\Zed\PriceProduct\Persistence\SpyPriceProductStore) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyPriceProductStore->getFkStore(), $comparison);

            return $this;
        } elseif ($spyPriceProductStore instanceof ObjectCollection) {
            $this
                ->usePriceProductStoreQuery()
                ->filterByPrimaryKeys($spyPriceProductStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByPriceProductStore() only accepts arguments of type \Orm\Zed\PriceProduct\Persistence\SpyPriceProductStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PriceProductStore relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPriceProductStore(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PriceProductStore');

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
            $this->addJoinObject($join, 'PriceProductStore');
        }

        return $this;
    }

    /**
     * Use the PriceProductStore relation SpyPriceProductStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\PriceProduct\Persistence\SpyPriceProductStoreQuery A secondary query class using the current class as primary query
     */
    public function usePriceProductStoreQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPriceProductStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PriceProductStore', '\Orm\Zed\PriceProduct\Persistence\SpyPriceProductStoreQuery');
    }

    /**
     * Use the PriceProductStore relation SpyPriceProductStore object
     *
     * @param callable(\Orm\Zed\PriceProduct\Persistence\SpyPriceProductStoreQuery):\Orm\Zed\PriceProduct\Persistence\SpyPriceProductStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPriceProductStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->usePriceProductStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the PriceProductStore relation to the SpyPriceProductStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\PriceProduct\Persistence\SpyPriceProductStoreQuery The inner query object of the EXISTS statement
     */
    public function usePriceProductStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\PriceProduct\Persistence\SpyPriceProductStoreQuery */
        $q = $this->useExistsQuery('PriceProductStore', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the PriceProductStore relation to the SpyPriceProductStore table for a NOT EXISTS query.
     *
     * @see usePriceProductStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\PriceProduct\Persistence\SpyPriceProductStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function usePriceProductStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\PriceProduct\Persistence\SpyPriceProductStoreQuery */
        $q = $this->useExistsQuery('PriceProductStore', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the PriceProductStore relation to the SpyPriceProductStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\PriceProduct\Persistence\SpyPriceProductStoreQuery The inner query object of the IN statement
     */
    public function useInPriceProductStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\PriceProduct\Persistence\SpyPriceProductStoreQuery */
        $q = $this->useInQuery('PriceProductStore', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the PriceProductStore relation to the SpyPriceProductStore table for a NOT IN query.
     *
     * @see usePriceProductStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\PriceProduct\Persistence\SpyPriceProductStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInPriceProductStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\PriceProduct\Persistence\SpyPriceProductStoreQuery */
        $q = $this->useInQuery('PriceProductStore', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductSchedule object
     *
     * @param \Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductSchedule|ObjectCollection $spyPriceProductSchedule the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPriceProductSchedule($spyPriceProductSchedule, ?string $comparison = null)
    {
        if ($spyPriceProductSchedule instanceof \Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductSchedule) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyPriceProductSchedule->getFkStore(), $comparison);

            return $this;
        } elseif ($spyPriceProductSchedule instanceof ObjectCollection) {
            $this
                ->usePriceProductScheduleQuery()
                ->filterByPrimaryKeys($spyPriceProductSchedule->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByPriceProductSchedule() only accepts arguments of type \Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductSchedule or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PriceProductSchedule relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPriceProductSchedule(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PriceProductSchedule');

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
            $this->addJoinObject($join, 'PriceProductSchedule');
        }

        return $this;
    }

    /**
     * Use the PriceProductSchedule relation SpyPriceProductSchedule object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleQuery A secondary query class using the current class as primary query
     */
    public function usePriceProductScheduleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPriceProductSchedule($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PriceProductSchedule', '\Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleQuery');
    }

    /**
     * Use the PriceProductSchedule relation SpyPriceProductSchedule object
     *
     * @param callable(\Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleQuery):\Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPriceProductScheduleQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->usePriceProductScheduleQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the PriceProductSchedule relation to the SpyPriceProductSchedule table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleQuery The inner query object of the EXISTS statement
     */
    public function usePriceProductScheduleExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleQuery */
        $q = $this->useExistsQuery('PriceProductSchedule', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the PriceProductSchedule relation to the SpyPriceProductSchedule table for a NOT EXISTS query.
     *
     * @see usePriceProductScheduleExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleQuery The inner query object of the NOT EXISTS statement
     */
    public function usePriceProductScheduleNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleQuery */
        $q = $this->useExistsQuery('PriceProductSchedule', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the PriceProductSchedule relation to the SpyPriceProductSchedule table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleQuery The inner query object of the IN statement
     */
    public function useInPriceProductScheduleQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleQuery */
        $q = $this->useInQuery('PriceProductSchedule', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the PriceProductSchedule relation to the SpyPriceProductSchedule table for a NOT IN query.
     *
     * @see usePriceProductScheduleInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleQuery The inner query object of the NOT IN statement
     */
    public function useNotInPriceProductScheduleQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleQuery */
        $q = $this->useInQuery('PriceProductSchedule', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Product\Persistence\SpyProductAbstractStore object
     *
     * @param \Orm\Zed\Product\Persistence\SpyProductAbstractStore|ObjectCollection $spyProductAbstractStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductAbstractStore($spyProductAbstractStore, ?string $comparison = null)
    {
        if ($spyProductAbstractStore instanceof \Orm\Zed\Product\Persistence\SpyProductAbstractStore) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyProductAbstractStore->getFkStore(), $comparison);

            return $this;
        } elseif ($spyProductAbstractStore instanceof ObjectCollection) {
            $this
                ->useSpyProductAbstractStoreQuery()
                ->filterByPrimaryKeys($spyProductAbstractStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductAbstractStore() only accepts arguments of type \Orm\Zed\Product\Persistence\SpyProductAbstractStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductAbstractStore relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductAbstractStore(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductAbstractStore');

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
            $this->addJoinObject($join, 'SpyProductAbstractStore');
        }

        return $this;
    }

    /**
     * Use the SpyProductAbstractStore relation SpyProductAbstractStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductAbstractStoreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductAbstractStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductAbstractStore', '\Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery');
    }

    /**
     * Use the SpyProductAbstractStore relation SpyProductAbstractStore object
     *
     * @param callable(\Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery):\Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductAbstractStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductAbstractStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductAbstractStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductAbstractStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery */
        $q = $this->useExistsQuery('SpyProductAbstractStore', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductAbstractStore table for a NOT EXISTS query.
     *
     * @see useSpyProductAbstractStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductAbstractStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery */
        $q = $this->useExistsQuery('SpyProductAbstractStore', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductAbstractStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery The inner query object of the IN statement
     */
    public function useInSpyProductAbstractStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery */
        $q = $this->useInQuery('SpyProductAbstractStore', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductAbstractStore table for a NOT IN query.
     *
     * @see useSpyProductAbstractStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductAbstractStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery */
        $q = $this->useInQuery('SpyProductAbstractStore', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductLabel\Persistence\SpyProductLabelStore object
     *
     * @param \Orm\Zed\ProductLabel\Persistence\SpyProductLabelStore|ObjectCollection $spyProductLabelStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductLabelStore($spyProductLabelStore, ?string $comparison = null)
    {
        if ($spyProductLabelStore instanceof \Orm\Zed\ProductLabel\Persistence\SpyProductLabelStore) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyProductLabelStore->getFkStore(), $comparison);

            return $this;
        } elseif ($spyProductLabelStore instanceof ObjectCollection) {
            $this
                ->useProductLabelStoreQuery()
                ->filterByPrimaryKeys($spyProductLabelStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByProductLabelStore() only accepts arguments of type \Orm\Zed\ProductLabel\Persistence\SpyProductLabelStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductLabelStore relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProductLabelStore(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductLabelStore');

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
            $this->addJoinObject($join, 'ProductLabelStore');
        }

        return $this;
    }

    /**
     * Use the ProductLabelStore relation SpyProductLabelStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductLabel\Persistence\SpyProductLabelStoreQuery A secondary query class using the current class as primary query
     */
    public function useProductLabelStoreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductLabelStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductLabelStore', '\Orm\Zed\ProductLabel\Persistence\SpyProductLabelStoreQuery');
    }

    /**
     * Use the ProductLabelStore relation SpyProductLabelStore object
     *
     * @param callable(\Orm\Zed\ProductLabel\Persistence\SpyProductLabelStoreQuery):\Orm\Zed\ProductLabel\Persistence\SpyProductLabelStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProductLabelStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProductLabelStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ProductLabelStore relation to the SpyProductLabelStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductLabel\Persistence\SpyProductLabelStoreQuery The inner query object of the EXISTS statement
     */
    public function useProductLabelStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductLabel\Persistence\SpyProductLabelStoreQuery */
        $q = $this->useExistsQuery('ProductLabelStore', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ProductLabelStore relation to the SpyProductLabelStore table for a NOT EXISTS query.
     *
     * @see useProductLabelStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductLabel\Persistence\SpyProductLabelStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useProductLabelStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductLabel\Persistence\SpyProductLabelStoreQuery */
        $q = $this->useExistsQuery('ProductLabelStore', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ProductLabelStore relation to the SpyProductLabelStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductLabel\Persistence\SpyProductLabelStoreQuery The inner query object of the IN statement
     */
    public function useInProductLabelStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductLabel\Persistence\SpyProductLabelStoreQuery */
        $q = $this->useInQuery('ProductLabelStore', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ProductLabelStore relation to the SpyProductLabelStore table for a NOT IN query.
     *
     * @see useProductLabelStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductLabel\Persistence\SpyProductLabelStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInProductLabelStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductLabel\Persistence\SpyProductLabelStoreQuery */
        $q = $this->useInQuery('ProductLabelStore', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStore object
     *
     * @param \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStore|ObjectCollection $spyProductMeasurementSalesUnitStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductMeasurementSalesUnitStore($spyProductMeasurementSalesUnitStore, ?string $comparison = null)
    {
        if ($spyProductMeasurementSalesUnitStore instanceof \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStore) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyProductMeasurementSalesUnitStore->getFkStore(), $comparison);

            return $this;
        } elseif ($spyProductMeasurementSalesUnitStore instanceof ObjectCollection) {
            $this
                ->useSpyProductMeasurementSalesUnitStoreQuery()
                ->filterByPrimaryKeys($spyProductMeasurementSalesUnitStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductMeasurementSalesUnitStore() only accepts arguments of type \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductMeasurementSalesUnitStore relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductMeasurementSalesUnitStore(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductMeasurementSalesUnitStore');

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
            $this->addJoinObject($join, 'SpyProductMeasurementSalesUnitStore');
        }

        return $this;
    }

    /**
     * Use the SpyProductMeasurementSalesUnitStore relation SpyProductMeasurementSalesUnitStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStoreQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductMeasurementSalesUnitStoreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductMeasurementSalesUnitStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductMeasurementSalesUnitStore', '\Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStoreQuery');
    }

    /**
     * Use the SpyProductMeasurementSalesUnitStore relation SpyProductMeasurementSalesUnitStore object
     *
     * @param callable(\Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStoreQuery):\Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductMeasurementSalesUnitStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductMeasurementSalesUnitStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductMeasurementSalesUnitStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStoreQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductMeasurementSalesUnitStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStoreQuery */
        $q = $this->useExistsQuery('SpyProductMeasurementSalesUnitStore', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductMeasurementSalesUnitStore table for a NOT EXISTS query.
     *
     * @see useSpyProductMeasurementSalesUnitStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductMeasurementSalesUnitStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStoreQuery */
        $q = $this->useExistsQuery('SpyProductMeasurementSalesUnitStore', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductMeasurementSalesUnitStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStoreQuery The inner query object of the IN statement
     */
    public function useInSpyProductMeasurementSalesUnitStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStoreQuery */
        $q = $this->useInQuery('SpyProductMeasurementSalesUnitStore', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductMeasurementSalesUnitStore table for a NOT IN query.
     *
     * @see useSpyProductMeasurementSalesUnitStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductMeasurementSalesUnitStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStoreQuery */
        $q = $this->useInQuery('SpyProductMeasurementSalesUnitStore', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductOffer\Persistence\SpyProductOfferStore object
     *
     * @param \Orm\Zed\ProductOffer\Persistence\SpyProductOfferStore|ObjectCollection $spyProductOfferStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductOfferStore($spyProductOfferStore, ?string $comparison = null)
    {
        if ($spyProductOfferStore instanceof \Orm\Zed\ProductOffer\Persistence\SpyProductOfferStore) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyProductOfferStore->getFkStore(), $comparison);

            return $this;
        } elseif ($spyProductOfferStore instanceof ObjectCollection) {
            $this
                ->useSpyProductOfferStoreQuery()
                ->filterByPrimaryKeys($spyProductOfferStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductOfferStore() only accepts arguments of type \Orm\Zed\ProductOffer\Persistence\SpyProductOfferStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductOfferStore relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductOfferStore(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductOfferStore');

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
            $this->addJoinObject($join, 'SpyProductOfferStore');
        }

        return $this;
    }

    /**
     * Use the SpyProductOfferStore relation SpyProductOfferStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductOffer\Persistence\SpyProductOfferStoreQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductOfferStoreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductOfferStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductOfferStore', '\Orm\Zed\ProductOffer\Persistence\SpyProductOfferStoreQuery');
    }

    /**
     * Use the SpyProductOfferStore relation SpyProductOfferStore object
     *
     * @param callable(\Orm\Zed\ProductOffer\Persistence\SpyProductOfferStoreQuery):\Orm\Zed\ProductOffer\Persistence\SpyProductOfferStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductOfferStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductOfferStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductOfferStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductOffer\Persistence\SpyProductOfferStoreQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductOfferStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductOffer\Persistence\SpyProductOfferStoreQuery */
        $q = $this->useExistsQuery('SpyProductOfferStore', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductOfferStore table for a NOT EXISTS query.
     *
     * @see useSpyProductOfferStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductOffer\Persistence\SpyProductOfferStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductOfferStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductOffer\Persistence\SpyProductOfferStoreQuery */
        $q = $this->useExistsQuery('SpyProductOfferStore', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductOfferStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductOffer\Persistence\SpyProductOfferStoreQuery The inner query object of the IN statement
     */
    public function useInSpyProductOfferStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductOffer\Persistence\SpyProductOfferStoreQuery */
        $q = $this->useInQuery('SpyProductOfferStore', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductOfferStore table for a NOT IN query.
     *
     * @see useSpyProductOfferStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductOffer\Persistence\SpyProductOfferStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductOfferStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductOffer\Persistence\SpyProductOfferStoreQuery */
        $q = $this->useInQuery('SpyProductOfferStore', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePrice object
     *
     * @param \Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePrice|ObjectCollection $spyProductOptionValuePrice the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductOptionValuePrice($spyProductOptionValuePrice, ?string $comparison = null)
    {
        if ($spyProductOptionValuePrice instanceof \Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePrice) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyProductOptionValuePrice->getFkStore(), $comparison);

            return $this;
        } elseif ($spyProductOptionValuePrice instanceof ObjectCollection) {
            $this
                ->useProductOptionValuePriceQuery()
                ->filterByPrimaryKeys($spyProductOptionValuePrice->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByProductOptionValuePrice() only accepts arguments of type \Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePrice or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductOptionValuePrice relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProductOptionValuePrice(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductOptionValuePrice');

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
            $this->addJoinObject($join, 'ProductOptionValuePrice');
        }

        return $this;
    }

    /**
     * Use the ProductOptionValuePrice relation SpyProductOptionValuePrice object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePriceQuery A secondary query class using the current class as primary query
     */
    public function useProductOptionValuePriceQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinProductOptionValuePrice($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductOptionValuePrice', '\Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePriceQuery');
    }

    /**
     * Use the ProductOptionValuePrice relation SpyProductOptionValuePrice object
     *
     * @param callable(\Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePriceQuery):\Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePriceQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProductOptionValuePriceQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useProductOptionValuePriceQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ProductOptionValuePrice relation to the SpyProductOptionValuePrice table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePriceQuery The inner query object of the EXISTS statement
     */
    public function useProductOptionValuePriceExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePriceQuery */
        $q = $this->useExistsQuery('ProductOptionValuePrice', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ProductOptionValuePrice relation to the SpyProductOptionValuePrice table for a NOT EXISTS query.
     *
     * @see useProductOptionValuePriceExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePriceQuery The inner query object of the NOT EXISTS statement
     */
    public function useProductOptionValuePriceNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePriceQuery */
        $q = $this->useExistsQuery('ProductOptionValuePrice', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ProductOptionValuePrice relation to the SpyProductOptionValuePrice table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePriceQuery The inner query object of the IN statement
     */
    public function useInProductOptionValuePriceQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePriceQuery */
        $q = $this->useInQuery('ProductOptionValuePrice', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ProductOptionValuePrice relation to the SpyProductOptionValuePrice table for a NOT IN query.
     *
     * @see useProductOptionValuePriceInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePriceQuery The inner query object of the NOT IN statement
     */
    public function useNotInProductOptionValuePriceQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePriceQuery */
        $q = $this->useInQuery('ProductOptionValuePrice', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductRelation\Persistence\SpyProductRelationStore object
     *
     * @param \Orm\Zed\ProductRelation\Persistence\SpyProductRelationStore|ObjectCollection $spyProductRelationStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductRelationStore($spyProductRelationStore, ?string $comparison = null)
    {
        if ($spyProductRelationStore instanceof \Orm\Zed\ProductRelation\Persistence\SpyProductRelationStore) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyProductRelationStore->getFkStore(), $comparison);

            return $this;
        } elseif ($spyProductRelationStore instanceof ObjectCollection) {
            $this
                ->useProductRelationStoreQuery()
                ->filterByPrimaryKeys($spyProductRelationStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByProductRelationStore() only accepts arguments of type \Orm\Zed\ProductRelation\Persistence\SpyProductRelationStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductRelationStore relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProductRelationStore(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductRelationStore');

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
            $this->addJoinObject($join, 'ProductRelationStore');
        }

        return $this;
    }

    /**
     * Use the ProductRelationStore relation SpyProductRelationStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductRelation\Persistence\SpyProductRelationStoreQuery A secondary query class using the current class as primary query
     */
    public function useProductRelationStoreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductRelationStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductRelationStore', '\Orm\Zed\ProductRelation\Persistence\SpyProductRelationStoreQuery');
    }

    /**
     * Use the ProductRelationStore relation SpyProductRelationStore object
     *
     * @param callable(\Orm\Zed\ProductRelation\Persistence\SpyProductRelationStoreQuery):\Orm\Zed\ProductRelation\Persistence\SpyProductRelationStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProductRelationStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProductRelationStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ProductRelationStore relation to the SpyProductRelationStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductRelation\Persistence\SpyProductRelationStoreQuery The inner query object of the EXISTS statement
     */
    public function useProductRelationStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductRelation\Persistence\SpyProductRelationStoreQuery */
        $q = $this->useExistsQuery('ProductRelationStore', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ProductRelationStore relation to the SpyProductRelationStore table for a NOT EXISTS query.
     *
     * @see useProductRelationStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductRelation\Persistence\SpyProductRelationStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useProductRelationStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductRelation\Persistence\SpyProductRelationStoreQuery */
        $q = $this->useExistsQuery('ProductRelationStore', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ProductRelationStore relation to the SpyProductRelationStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductRelation\Persistence\SpyProductRelationStoreQuery The inner query object of the IN statement
     */
    public function useInProductRelationStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductRelation\Persistence\SpyProductRelationStoreQuery */
        $q = $this->useInQuery('ProductRelationStore', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ProductRelationStore relation to the SpyProductRelationStore table for a NOT IN query.
     *
     * @see useProductRelationStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductRelation\Persistence\SpyProductRelationStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInProductRelationStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductRelation\Persistence\SpyProductRelationStoreQuery */
        $q = $this->useInQuery('ProductRelationStore', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Quote\Persistence\SpyQuote object
     *
     * @param \Orm\Zed\Quote\Persistence\SpyQuote|ObjectCollection $spyQuote the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyQuote($spyQuote, ?string $comparison = null)
    {
        if ($spyQuote instanceof \Orm\Zed\Quote\Persistence\SpyQuote) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyQuote->getFkStore(), $comparison);

            return $this;
        } elseif ($spyQuote instanceof ObjectCollection) {
            $this
                ->useSpyQuoteQuery()
                ->filterByPrimaryKeys($spyQuote->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyQuote() only accepts arguments of type \Orm\Zed\Quote\Persistence\SpyQuote or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyQuote relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyQuote(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyQuote');

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
            $this->addJoinObject($join, 'SpyQuote');
        }

        return $this;
    }

    /**
     * Use the SpyQuote relation SpyQuote object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Quote\Persistence\SpyQuoteQuery A secondary query class using the current class as primary query
     */
    public function useSpyQuoteQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyQuote($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyQuote', '\Orm\Zed\Quote\Persistence\SpyQuoteQuery');
    }

    /**
     * Use the SpyQuote relation SpyQuote object
     *
     * @param callable(\Orm\Zed\Quote\Persistence\SpyQuoteQuery):\Orm\Zed\Quote\Persistence\SpyQuoteQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyQuoteQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyQuoteQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyQuote table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Quote\Persistence\SpyQuoteQuery The inner query object of the EXISTS statement
     */
    public function useSpyQuoteExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Quote\Persistence\SpyQuoteQuery */
        $q = $this->useExistsQuery('SpyQuote', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyQuote table for a NOT EXISTS query.
     *
     * @see useSpyQuoteExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Quote\Persistence\SpyQuoteQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyQuoteNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Quote\Persistence\SpyQuoteQuery */
        $q = $this->useExistsQuery('SpyQuote', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyQuote table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Quote\Persistence\SpyQuoteQuery The inner query object of the IN statement
     */
    public function useInSpyQuoteQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Quote\Persistence\SpyQuoteQuery */
        $q = $this->useInQuery('SpyQuote', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyQuote table for a NOT IN query.
     *
     * @see useSpyQuoteInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Quote\Persistence\SpyQuoteQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyQuoteQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Quote\Persistence\SpyQuoteQuery */
        $q = $this->useInQuery('SpyQuote', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SalesOrderThreshold\Persistence\SpySalesOrderThreshold object
     *
     * @param \Orm\Zed\SalesOrderThreshold\Persistence\SpySalesOrderThreshold|ObjectCollection $spySalesOrderThreshold the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpySalesOrderThreshold($spySalesOrderThreshold, ?string $comparison = null)
    {
        if ($spySalesOrderThreshold instanceof \Orm\Zed\SalesOrderThreshold\Persistence\SpySalesOrderThreshold) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spySalesOrderThreshold->getFkStore(), $comparison);

            return $this;
        } elseif ($spySalesOrderThreshold instanceof ObjectCollection) {
            $this
                ->useSpySalesOrderThresholdQuery()
                ->filterByPrimaryKeys($spySalesOrderThreshold->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpySalesOrderThreshold() only accepts arguments of type \Orm\Zed\SalesOrderThreshold\Persistence\SpySalesOrderThreshold or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpySalesOrderThreshold relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpySalesOrderThreshold(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpySalesOrderThreshold');

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
            $this->addJoinObject($join, 'SpySalesOrderThreshold');
        }

        return $this;
    }

    /**
     * Use the SpySalesOrderThreshold relation SpySalesOrderThreshold object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SalesOrderThreshold\Persistence\SpySalesOrderThresholdQuery A secondary query class using the current class as primary query
     */
    public function useSpySalesOrderThresholdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpySalesOrderThreshold($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpySalesOrderThreshold', '\Orm\Zed\SalesOrderThreshold\Persistence\SpySalesOrderThresholdQuery');
    }

    /**
     * Use the SpySalesOrderThreshold relation SpySalesOrderThreshold object
     *
     * @param callable(\Orm\Zed\SalesOrderThreshold\Persistence\SpySalesOrderThresholdQuery):\Orm\Zed\SalesOrderThreshold\Persistence\SpySalesOrderThresholdQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpySalesOrderThresholdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpySalesOrderThresholdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpySalesOrderThreshold table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SalesOrderThreshold\Persistence\SpySalesOrderThresholdQuery The inner query object of the EXISTS statement
     */
    public function useSpySalesOrderThresholdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SalesOrderThreshold\Persistence\SpySalesOrderThresholdQuery */
        $q = $this->useExistsQuery('SpySalesOrderThreshold', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpySalesOrderThreshold table for a NOT EXISTS query.
     *
     * @see useSpySalesOrderThresholdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SalesOrderThreshold\Persistence\SpySalesOrderThresholdQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpySalesOrderThresholdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SalesOrderThreshold\Persistence\SpySalesOrderThresholdQuery */
        $q = $this->useExistsQuery('SpySalesOrderThreshold', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpySalesOrderThreshold table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SalesOrderThreshold\Persistence\SpySalesOrderThresholdQuery The inner query object of the IN statement
     */
    public function useInSpySalesOrderThresholdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SalesOrderThreshold\Persistence\SpySalesOrderThresholdQuery */
        $q = $this->useInQuery('SpySalesOrderThreshold', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpySalesOrderThreshold table for a NOT IN query.
     *
     * @see useSpySalesOrderThresholdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SalesOrderThreshold\Persistence\SpySalesOrderThresholdQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpySalesOrderThresholdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SalesOrderThreshold\Persistence\SpySalesOrderThresholdQuery */
        $q = $this->useInQuery('SpySalesOrderThreshold', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ServicePoint\Persistence\SpyServicePointStore object
     *
     * @param \Orm\Zed\ServicePoint\Persistence\SpyServicePointStore|ObjectCollection $spyServicePointStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByServicePointStore($spyServicePointStore, ?string $comparison = null)
    {
        if ($spyServicePointStore instanceof \Orm\Zed\ServicePoint\Persistence\SpyServicePointStore) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyServicePointStore->getFkStore(), $comparison);

            return $this;
        } elseif ($spyServicePointStore instanceof ObjectCollection) {
            $this
                ->useServicePointStoreQuery()
                ->filterByPrimaryKeys($spyServicePointStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByServicePointStore() only accepts arguments of type \Orm\Zed\ServicePoint\Persistence\SpyServicePointStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ServicePointStore relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinServicePointStore(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ServicePointStore');

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
            $this->addJoinObject($join, 'ServicePointStore');
        }

        return $this;
    }

    /**
     * Use the ServicePointStore relation SpyServicePointStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ServicePoint\Persistence\SpyServicePointStoreQuery A secondary query class using the current class as primary query
     */
    public function useServicePointStoreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinServicePointStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ServicePointStore', '\Orm\Zed\ServicePoint\Persistence\SpyServicePointStoreQuery');
    }

    /**
     * Use the ServicePointStore relation SpyServicePointStore object
     *
     * @param callable(\Orm\Zed\ServicePoint\Persistence\SpyServicePointStoreQuery):\Orm\Zed\ServicePoint\Persistence\SpyServicePointStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withServicePointStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useServicePointStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ServicePointStore relation to the SpyServicePointStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ServicePoint\Persistence\SpyServicePointStoreQuery The inner query object of the EXISTS statement
     */
    public function useServicePointStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ServicePoint\Persistence\SpyServicePointStoreQuery */
        $q = $this->useExistsQuery('ServicePointStore', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ServicePointStore relation to the SpyServicePointStore table for a NOT EXISTS query.
     *
     * @see useServicePointStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ServicePoint\Persistence\SpyServicePointStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useServicePointStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ServicePoint\Persistence\SpyServicePointStoreQuery */
        $q = $this->useExistsQuery('ServicePointStore', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ServicePointStore relation to the SpyServicePointStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ServicePoint\Persistence\SpyServicePointStoreQuery The inner query object of the IN statement
     */
    public function useInServicePointStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ServicePoint\Persistence\SpyServicePointStoreQuery */
        $q = $this->useInQuery('ServicePointStore', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ServicePointStore relation to the SpyServicePointStore table for a NOT IN query.
     *
     * @see useServicePointStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ServicePoint\Persistence\SpyServicePointStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInServicePointStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ServicePoint\Persistence\SpyServicePointStoreQuery */
        $q = $this->useInQuery('ServicePointStore', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Shipment\Persistence\SpyShipmentMethodPrice object
     *
     * @param \Orm\Zed\Shipment\Persistence\SpyShipmentMethodPrice|ObjectCollection $spyShipmentMethodPrice the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByShipmentMethodPrice($spyShipmentMethodPrice, ?string $comparison = null)
    {
        if ($spyShipmentMethodPrice instanceof \Orm\Zed\Shipment\Persistence\SpyShipmentMethodPrice) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyShipmentMethodPrice->getFkStore(), $comparison);

            return $this;
        } elseif ($spyShipmentMethodPrice instanceof ObjectCollection) {
            $this
                ->useShipmentMethodPriceQuery()
                ->filterByPrimaryKeys($spyShipmentMethodPrice->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByShipmentMethodPrice() only accepts arguments of type \Orm\Zed\Shipment\Persistence\SpyShipmentMethodPrice or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ShipmentMethodPrice relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinShipmentMethodPrice(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ShipmentMethodPrice');

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
            $this->addJoinObject($join, 'ShipmentMethodPrice');
        }

        return $this;
    }

    /**
     * Use the ShipmentMethodPrice relation SpyShipmentMethodPrice object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Shipment\Persistence\SpyShipmentMethodPriceQuery A secondary query class using the current class as primary query
     */
    public function useShipmentMethodPriceQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinShipmentMethodPrice($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ShipmentMethodPrice', '\Orm\Zed\Shipment\Persistence\SpyShipmentMethodPriceQuery');
    }

    /**
     * Use the ShipmentMethodPrice relation SpyShipmentMethodPrice object
     *
     * @param callable(\Orm\Zed\Shipment\Persistence\SpyShipmentMethodPriceQuery):\Orm\Zed\Shipment\Persistence\SpyShipmentMethodPriceQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withShipmentMethodPriceQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useShipmentMethodPriceQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ShipmentMethodPrice relation to the SpyShipmentMethodPrice table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Shipment\Persistence\SpyShipmentMethodPriceQuery The inner query object of the EXISTS statement
     */
    public function useShipmentMethodPriceExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Shipment\Persistence\SpyShipmentMethodPriceQuery */
        $q = $this->useExistsQuery('ShipmentMethodPrice', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ShipmentMethodPrice relation to the SpyShipmentMethodPrice table for a NOT EXISTS query.
     *
     * @see useShipmentMethodPriceExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Shipment\Persistence\SpyShipmentMethodPriceQuery The inner query object of the NOT EXISTS statement
     */
    public function useShipmentMethodPriceNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Shipment\Persistence\SpyShipmentMethodPriceQuery */
        $q = $this->useExistsQuery('ShipmentMethodPrice', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ShipmentMethodPrice relation to the SpyShipmentMethodPrice table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Shipment\Persistence\SpyShipmentMethodPriceQuery The inner query object of the IN statement
     */
    public function useInShipmentMethodPriceQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Shipment\Persistence\SpyShipmentMethodPriceQuery */
        $q = $this->useInQuery('ShipmentMethodPrice', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ShipmentMethodPrice relation to the SpyShipmentMethodPrice table for a NOT IN query.
     *
     * @see useShipmentMethodPriceInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Shipment\Persistence\SpyShipmentMethodPriceQuery The inner query object of the NOT IN statement
     */
    public function useNotInShipmentMethodPriceQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Shipment\Persistence\SpyShipmentMethodPriceQuery */
        $q = $this->useInQuery('ShipmentMethodPrice', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Shipment\Persistence\SpyShipmentMethodStore object
     *
     * @param \Orm\Zed\Shipment\Persistence\SpyShipmentMethodStore|ObjectCollection $spyShipmentMethodStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByShipmentMethodStore($spyShipmentMethodStore, ?string $comparison = null)
    {
        if ($spyShipmentMethodStore instanceof \Orm\Zed\Shipment\Persistence\SpyShipmentMethodStore) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyShipmentMethodStore->getFkStore(), $comparison);

            return $this;
        } elseif ($spyShipmentMethodStore instanceof ObjectCollection) {
            $this
                ->useShipmentMethodStoreQuery()
                ->filterByPrimaryKeys($spyShipmentMethodStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByShipmentMethodStore() only accepts arguments of type \Orm\Zed\Shipment\Persistence\SpyShipmentMethodStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ShipmentMethodStore relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinShipmentMethodStore(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ShipmentMethodStore');

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
            $this->addJoinObject($join, 'ShipmentMethodStore');
        }

        return $this;
    }

    /**
     * Use the ShipmentMethodStore relation SpyShipmentMethodStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Shipment\Persistence\SpyShipmentMethodStoreQuery A secondary query class using the current class as primary query
     */
    public function useShipmentMethodStoreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinShipmentMethodStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ShipmentMethodStore', '\Orm\Zed\Shipment\Persistence\SpyShipmentMethodStoreQuery');
    }

    /**
     * Use the ShipmentMethodStore relation SpyShipmentMethodStore object
     *
     * @param callable(\Orm\Zed\Shipment\Persistence\SpyShipmentMethodStoreQuery):\Orm\Zed\Shipment\Persistence\SpyShipmentMethodStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withShipmentMethodStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useShipmentMethodStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ShipmentMethodStore relation to the SpyShipmentMethodStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Shipment\Persistence\SpyShipmentMethodStoreQuery The inner query object of the EXISTS statement
     */
    public function useShipmentMethodStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Shipment\Persistence\SpyShipmentMethodStoreQuery */
        $q = $this->useExistsQuery('ShipmentMethodStore', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ShipmentMethodStore relation to the SpyShipmentMethodStore table for a NOT EXISTS query.
     *
     * @see useShipmentMethodStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Shipment\Persistence\SpyShipmentMethodStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useShipmentMethodStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Shipment\Persistence\SpyShipmentMethodStoreQuery */
        $q = $this->useExistsQuery('ShipmentMethodStore', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ShipmentMethodStore relation to the SpyShipmentMethodStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Shipment\Persistence\SpyShipmentMethodStoreQuery The inner query object of the IN statement
     */
    public function useInShipmentMethodStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Shipment\Persistence\SpyShipmentMethodStoreQuery */
        $q = $this->useInQuery('ShipmentMethodStore', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ShipmentMethodStore relation to the SpyShipmentMethodStore table for a NOT IN query.
     *
     * @see useShipmentMethodStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Shipment\Persistence\SpyShipmentMethodStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInShipmentMethodStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Shipment\Persistence\SpyShipmentMethodStoreQuery */
        $q = $this->useInQuery('ShipmentMethodStore', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStore object
     *
     * @param \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStore|ObjectCollection $spyShipmentTypeStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByShipmentTypeStore($spyShipmentTypeStore, ?string $comparison = null)
    {
        if ($spyShipmentTypeStore instanceof \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStore) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyShipmentTypeStore->getFkStore(), $comparison);

            return $this;
        } elseif ($spyShipmentTypeStore instanceof ObjectCollection) {
            $this
                ->useShipmentTypeStoreQuery()
                ->filterByPrimaryKeys($spyShipmentTypeStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByShipmentTypeStore() only accepts arguments of type \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ShipmentTypeStore relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinShipmentTypeStore(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ShipmentTypeStore');

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
            $this->addJoinObject($join, 'ShipmentTypeStore');
        }

        return $this;
    }

    /**
     * Use the ShipmentTypeStore relation SpyShipmentTypeStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStoreQuery A secondary query class using the current class as primary query
     */
    public function useShipmentTypeStoreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinShipmentTypeStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ShipmentTypeStore', '\Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStoreQuery');
    }

    /**
     * Use the ShipmentTypeStore relation SpyShipmentTypeStore object
     *
     * @param callable(\Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStoreQuery):\Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withShipmentTypeStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useShipmentTypeStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ShipmentTypeStore relation to the SpyShipmentTypeStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStoreQuery The inner query object of the EXISTS statement
     */
    public function useShipmentTypeStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStoreQuery */
        $q = $this->useExistsQuery('ShipmentTypeStore', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ShipmentTypeStore relation to the SpyShipmentTypeStore table for a NOT EXISTS query.
     *
     * @see useShipmentTypeStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useShipmentTypeStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStoreQuery */
        $q = $this->useExistsQuery('ShipmentTypeStore', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ShipmentTypeStore relation to the SpyShipmentTypeStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStoreQuery The inner query object of the IN statement
     */
    public function useInShipmentTypeStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStoreQuery */
        $q = $this->useInQuery('ShipmentTypeStore', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ShipmentTypeStore relation to the SpyShipmentTypeStore table for a NOT IN query.
     *
     * @see useShipmentTypeStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInShipmentTypeStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStoreQuery */
        $q = $this->useInQuery('ShipmentTypeStore', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Stock\Persistence\SpyStockStore object
     *
     * @param \Orm\Zed\Stock\Persistence\SpyStockStore|ObjectCollection $spyStockStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStockStore($spyStockStore, ?string $comparison = null)
    {
        if ($spyStockStore instanceof \Orm\Zed\Stock\Persistence\SpyStockStore) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyStockStore->getFkStore(), $comparison);

            return $this;
        } elseif ($spyStockStore instanceof ObjectCollection) {
            $this
                ->useStockStoreQuery()
                ->filterByPrimaryKeys($spyStockStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByStockStore() only accepts arguments of type \Orm\Zed\Stock\Persistence\SpyStockStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the StockStore relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinStockStore(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('StockStore');

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
            $this->addJoinObject($join, 'StockStore');
        }

        return $this;
    }

    /**
     * Use the StockStore relation SpyStockStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Stock\Persistence\SpyStockStoreQuery A secondary query class using the current class as primary query
     */
    public function useStockStoreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStockStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'StockStore', '\Orm\Zed\Stock\Persistence\SpyStockStoreQuery');
    }

    /**
     * Use the StockStore relation SpyStockStore object
     *
     * @param callable(\Orm\Zed\Stock\Persistence\SpyStockStoreQuery):\Orm\Zed\Stock\Persistence\SpyStockStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withStockStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useStockStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the StockStore relation to the SpyStockStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Stock\Persistence\SpyStockStoreQuery The inner query object of the EXISTS statement
     */
    public function useStockStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Stock\Persistence\SpyStockStoreQuery */
        $q = $this->useExistsQuery('StockStore', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the StockStore relation to the SpyStockStore table for a NOT EXISTS query.
     *
     * @see useStockStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Stock\Persistence\SpyStockStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useStockStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Stock\Persistence\SpyStockStoreQuery */
        $q = $this->useExistsQuery('StockStore', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the StockStore relation to the SpyStockStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Stock\Persistence\SpyStockStoreQuery The inner query object of the IN statement
     */
    public function useInStockStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Stock\Persistence\SpyStockStoreQuery */
        $q = $this->useInQuery('StockStore', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the StockStore relation to the SpyStockStore table for a NOT IN query.
     *
     * @see useStockStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Stock\Persistence\SpyStockStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInStockStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Stock\Persistence\SpyStockStoreQuery */
        $q = $this->useInQuery('StockStore', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\StoreContext\Persistence\SpyStoreContext object
     *
     * @param \Orm\Zed\StoreContext\Persistence\SpyStoreContext|ObjectCollection $spyStoreContext the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyStoreContext($spyStoreContext, ?string $comparison = null)
    {
        if ($spyStoreContext instanceof \Orm\Zed\StoreContext\Persistence\SpyStoreContext) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyStoreContext->getFkStore(), $comparison);

            return $this;
        } elseif ($spyStoreContext instanceof ObjectCollection) {
            $this
                ->useSpyStoreContextQuery()
                ->filterByPrimaryKeys($spyStoreContext->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyStoreContext() only accepts arguments of type \Orm\Zed\StoreContext\Persistence\SpyStoreContext or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyStoreContext relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyStoreContext(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyStoreContext');

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
            $this->addJoinObject($join, 'SpyStoreContext');
        }

        return $this;
    }

    /**
     * Use the SpyStoreContext relation SpyStoreContext object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\StoreContext\Persistence\SpyStoreContextQuery A secondary query class using the current class as primary query
     */
    public function useSpyStoreContextQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyStoreContext($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyStoreContext', '\Orm\Zed\StoreContext\Persistence\SpyStoreContextQuery');
    }

    /**
     * Use the SpyStoreContext relation SpyStoreContext object
     *
     * @param callable(\Orm\Zed\StoreContext\Persistence\SpyStoreContextQuery):\Orm\Zed\StoreContext\Persistence\SpyStoreContextQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyStoreContextQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyStoreContextQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyStoreContext table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\StoreContext\Persistence\SpyStoreContextQuery The inner query object of the EXISTS statement
     */
    public function useSpyStoreContextExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\StoreContext\Persistence\SpyStoreContextQuery */
        $q = $this->useExistsQuery('SpyStoreContext', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyStoreContext table for a NOT EXISTS query.
     *
     * @see useSpyStoreContextExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\StoreContext\Persistence\SpyStoreContextQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyStoreContextNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\StoreContext\Persistence\SpyStoreContextQuery */
        $q = $this->useExistsQuery('SpyStoreContext', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyStoreContext table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\StoreContext\Persistence\SpyStoreContextQuery The inner query object of the IN statement
     */
    public function useInSpyStoreContextQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\StoreContext\Persistence\SpyStoreContextQuery */
        $q = $this->useInQuery('SpyStoreContext', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyStoreContext table for a NOT IN query.
     *
     * @see useSpyStoreContextInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\StoreContext\Persistence\SpyStoreContextQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyStoreContextQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\StoreContext\Persistence\SpyStoreContextQuery */
        $q = $this->useInQuery('SpyStoreContext', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Touch\Persistence\SpyTouchStorage object
     *
     * @param \Orm\Zed\Touch\Persistence\SpyTouchStorage|ObjectCollection $spyTouchStorage the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTouchStorage($spyTouchStorage, ?string $comparison = null)
    {
        if ($spyTouchStorage instanceof \Orm\Zed\Touch\Persistence\SpyTouchStorage) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyTouchStorage->getFkStore(), $comparison);

            return $this;
        } elseif ($spyTouchStorage instanceof ObjectCollection) {
            $this
                ->useTouchStorageQuery()
                ->filterByPrimaryKeys($spyTouchStorage->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByTouchStorage() only accepts arguments of type \Orm\Zed\Touch\Persistence\SpyTouchStorage or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TouchStorage relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinTouchStorage(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TouchStorage');

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
            $this->addJoinObject($join, 'TouchStorage');
        }

        return $this;
    }

    /**
     * Use the TouchStorage relation SpyTouchStorage object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Touch\Persistence\SpyTouchStorageQuery A secondary query class using the current class as primary query
     */
    public function useTouchStorageQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTouchStorage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TouchStorage', '\Orm\Zed\Touch\Persistence\SpyTouchStorageQuery');
    }

    /**
     * Use the TouchStorage relation SpyTouchStorage object
     *
     * @param callable(\Orm\Zed\Touch\Persistence\SpyTouchStorageQuery):\Orm\Zed\Touch\Persistence\SpyTouchStorageQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTouchStorageQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useTouchStorageQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the TouchStorage relation to the SpyTouchStorage table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Touch\Persistence\SpyTouchStorageQuery The inner query object of the EXISTS statement
     */
    public function useTouchStorageExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Touch\Persistence\SpyTouchStorageQuery */
        $q = $this->useExistsQuery('TouchStorage', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the TouchStorage relation to the SpyTouchStorage table for a NOT EXISTS query.
     *
     * @see useTouchStorageExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Touch\Persistence\SpyTouchStorageQuery The inner query object of the NOT EXISTS statement
     */
    public function useTouchStorageNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Touch\Persistence\SpyTouchStorageQuery */
        $q = $this->useExistsQuery('TouchStorage', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the TouchStorage relation to the SpyTouchStorage table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Touch\Persistence\SpyTouchStorageQuery The inner query object of the IN statement
     */
    public function useInTouchStorageQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Touch\Persistence\SpyTouchStorageQuery */
        $q = $this->useInQuery('TouchStorage', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the TouchStorage relation to the SpyTouchStorage table for a NOT IN query.
     *
     * @see useTouchStorageInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Touch\Persistence\SpyTouchStorageQuery The inner query object of the NOT IN statement
     */
    public function useNotInTouchStorageQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Touch\Persistence\SpyTouchStorageQuery */
        $q = $this->useInQuery('TouchStorage', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Touch\Persistence\SpyTouchSearch object
     *
     * @param \Orm\Zed\Touch\Persistence\SpyTouchSearch|ObjectCollection $spyTouchSearch the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTouchSearch($spyTouchSearch, ?string $comparison = null)
    {
        if ($spyTouchSearch instanceof \Orm\Zed\Touch\Persistence\SpyTouchSearch) {
            $this
                ->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyTouchSearch->getFkStore(), $comparison);

            return $this;
        } elseif ($spyTouchSearch instanceof ObjectCollection) {
            $this
                ->useTouchSearchQuery()
                ->filterByPrimaryKeys($spyTouchSearch->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByTouchSearch() only accepts arguments of type \Orm\Zed\Touch\Persistence\SpyTouchSearch or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TouchSearch relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinTouchSearch(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TouchSearch');

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
            $this->addJoinObject($join, 'TouchSearch');
        }

        return $this;
    }

    /**
     * Use the TouchSearch relation SpyTouchSearch object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Touch\Persistence\SpyTouchSearchQuery A secondary query class using the current class as primary query
     */
    public function useTouchSearchQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTouchSearch($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TouchSearch', '\Orm\Zed\Touch\Persistence\SpyTouchSearchQuery');
    }

    /**
     * Use the TouchSearch relation SpyTouchSearch object
     *
     * @param callable(\Orm\Zed\Touch\Persistence\SpyTouchSearchQuery):\Orm\Zed\Touch\Persistence\SpyTouchSearchQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTouchSearchQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useTouchSearchQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the TouchSearch relation to the SpyTouchSearch table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Touch\Persistence\SpyTouchSearchQuery The inner query object of the EXISTS statement
     */
    public function useTouchSearchExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Touch\Persistence\SpyTouchSearchQuery */
        $q = $this->useExistsQuery('TouchSearch', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the TouchSearch relation to the SpyTouchSearch table for a NOT EXISTS query.
     *
     * @see useTouchSearchExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Touch\Persistence\SpyTouchSearchQuery The inner query object of the NOT EXISTS statement
     */
    public function useTouchSearchNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Touch\Persistence\SpyTouchSearchQuery */
        $q = $this->useExistsQuery('TouchSearch', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the TouchSearch relation to the SpyTouchSearch table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Touch\Persistence\SpyTouchSearchQuery The inner query object of the IN statement
     */
    public function useInTouchSearchQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Touch\Persistence\SpyTouchSearchQuery */
        $q = $this->useInQuery('TouchSearch', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the TouchSearch relation to the SpyTouchSearch table for a NOT IN query.
     *
     * @see useTouchSearchInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Touch\Persistence\SpyTouchSearchQuery The inner query object of the NOT IN statement
     */
    public function useNotInTouchSearchQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Touch\Persistence\SpyTouchSearchQuery */
        $q = $this->useInQuery('TouchSearch', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related SpyProductOffer object
     * using the spy_product_offer_store table as cross reference
     *
     * @param SpyProductOffer $spyProductOffer the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL and Criteria::IN for queries
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductOffer($spyProductOffer, string $comparison = null)
    {
        $this
            ->useSpyProductOfferStoreQuery()
            ->filterBySpyProductOffer($spyProductOffer, $comparison)
            ->endUse();

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyStore $spyStore Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyStore = null)
    {
        if ($spyStore) {
            $this->addUsingAlias(SpyStoreTableMap::COL_ID_STORE, $spyStore->getIdStore(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_store table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyStoreTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyStoreTableMap::clearInstancePool();
            SpyStoreTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyStoreTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyStoreTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyStoreTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyStoreTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
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
