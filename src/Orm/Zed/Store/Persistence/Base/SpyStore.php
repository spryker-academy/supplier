<?php

namespace Orm\Zed\Store\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\Asset\Persistence\SpyAssetStore;
use Orm\Zed\Asset\Persistence\SpyAssetStoreQuery;
use Orm\Zed\Asset\Persistence\Base\SpyAssetStore as BaseSpyAssetStore;
use Orm\Zed\Asset\Persistence\Map\SpyAssetStoreTableMap;
use Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscription;
use Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscriptionQuery;
use Orm\Zed\AvailabilityNotification\Persistence\Base\SpyAvailabilityNotificationSubscription as BaseSpyAvailabilityNotificationSubscription;
use Orm\Zed\AvailabilityNotification\Persistence\Map\SpyAvailabilityNotificationSubscriptionTableMap;
use Orm\Zed\Availability\Persistence\SpyAvailability;
use Orm\Zed\Availability\Persistence\SpyAvailabilityAbstract;
use Orm\Zed\Availability\Persistence\SpyAvailabilityAbstractQuery;
use Orm\Zed\Availability\Persistence\SpyAvailabilityQuery;
use Orm\Zed\Availability\Persistence\Base\SpyAvailability as BaseSpyAvailability;
use Orm\Zed\Availability\Persistence\Base\SpyAvailabilityAbstract as BaseSpyAvailabilityAbstract;
use Orm\Zed\Availability\Persistence\Map\SpyAvailabilityAbstractTableMap;
use Orm\Zed\Availability\Persistence\Map\SpyAvailabilityTableMap;
use Orm\Zed\Category\Persistence\SpyCategoryStore;
use Orm\Zed\Category\Persistence\SpyCategoryStoreQuery;
use Orm\Zed\Category\Persistence\Base\SpyCategoryStore as BaseSpyCategoryStore;
use Orm\Zed\Category\Persistence\Map\SpyCategoryStoreTableMap;
use Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStore;
use Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStoreQuery;
use Orm\Zed\CmsBlock\Persistence\Base\SpyCmsBlockStore as BaseSpyCmsBlockStore;
use Orm\Zed\CmsBlock\Persistence\Map\SpyCmsBlockStoreTableMap;
use Orm\Zed\Cms\Persistence\SpyCmsPageStore;
use Orm\Zed\Cms\Persistence\SpyCmsPageStoreQuery;
use Orm\Zed\Cms\Persistence\Base\SpyCmsPageStore as BaseSpyCmsPageStore;
use Orm\Zed\Cms\Persistence\Map\SpyCmsPageStoreTableMap;
use Orm\Zed\Company\Persistence\SpyCompanyStore;
use Orm\Zed\Company\Persistence\SpyCompanyStoreQuery;
use Orm\Zed\Company\Persistence\Base\SpyCompanyStore as BaseSpyCompanyStore;
use Orm\Zed\Company\Persistence\Map\SpyCompanyStoreTableMap;
use Orm\Zed\Country\Persistence\SpyCountryStore;
use Orm\Zed\Country\Persistence\SpyCountryStoreQuery;
use Orm\Zed\Country\Persistence\Base\SpyCountryStore as BaseSpyCountryStore;
use Orm\Zed\Country\Persistence\Map\SpyCountryStoreTableMap;
use Orm\Zed\Currency\Persistence\SpyCurrency;
use Orm\Zed\Currency\Persistence\SpyCurrencyQuery;
use Orm\Zed\Currency\Persistence\SpyCurrencyStore;
use Orm\Zed\Currency\Persistence\SpyCurrencyStoreQuery;
use Orm\Zed\Currency\Persistence\Base\SpyCurrencyStore as BaseSpyCurrencyStore;
use Orm\Zed\Currency\Persistence\Map\SpyCurrencyStoreTableMap;
use Orm\Zed\Discount\Persistence\SpyDiscount;
use Orm\Zed\Discount\Persistence\SpyDiscountQuery;
use Orm\Zed\Discount\Persistence\SpyDiscountStore;
use Orm\Zed\Discount\Persistence\SpyDiscountStoreQuery;
use Orm\Zed\Discount\Persistence\Base\SpyDiscount as BaseSpyDiscount;
use Orm\Zed\Discount\Persistence\Base\SpyDiscountStore as BaseSpyDiscountStore;
use Orm\Zed\Discount\Persistence\Map\SpyDiscountStoreTableMap;
use Orm\Zed\Discount\Persistence\Map\SpyDiscountTableMap;
use Orm\Zed\Locale\Persistence\SpyLocale;
use Orm\Zed\Locale\Persistence\SpyLocaleQuery;
use Orm\Zed\Locale\Persistence\SpyLocaleStore;
use Orm\Zed\Locale\Persistence\SpyLocaleStoreQuery;
use Orm\Zed\Locale\Persistence\Base\SpyLocaleStore as BaseSpyLocaleStore;
use Orm\Zed\Locale\Persistence\Map\SpyLocaleStoreTableMap;
use Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStore;
use Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStoreQuery;
use Orm\Zed\MerchantCommission\Persistence\Base\SpyMerchantCommissionStore as BaseSpyMerchantCommissionStore;
use Orm\Zed\MerchantCommission\Persistence\Map\SpyMerchantCommissionStoreTableMap;
use Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequest;
use Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequestQuery;
use Orm\Zed\MerchantRegistrationRequest\Persistence\Base\SpyMerchantRegistrationRequest as BaseSpyMerchantRegistrationRequest;
use Orm\Zed\MerchantRegistrationRequest\Persistence\Map\SpyMerchantRegistrationRequestTableMap;
use Orm\Zed\MerchantRelationshipSalesOrderThreshold\Persistence\SpyMerchantRelationshipSalesOrderThreshold;
use Orm\Zed\MerchantRelationshipSalesOrderThreshold\Persistence\SpyMerchantRelationshipSalesOrderThresholdQuery;
use Orm\Zed\MerchantRelationshipSalesOrderThreshold\Persistence\Base\SpyMerchantRelationshipSalesOrderThreshold as BaseSpyMerchantRelationshipSalesOrderThreshold;
use Orm\Zed\MerchantRelationshipSalesOrderThreshold\Persistence\Map\SpyMerchantRelationshipSalesOrderThresholdTableMap;
use Orm\Zed\Merchant\Persistence\SpyMerchantStore;
use Orm\Zed\Merchant\Persistence\SpyMerchantStoreQuery;
use Orm\Zed\Merchant\Persistence\Base\SpyMerchantStore as BaseSpyMerchantStore;
use Orm\Zed\Merchant\Persistence\Map\SpyMerchantStoreTableMap;
use Orm\Zed\OmsProductOfferReservation\Persistence\SpyOmsProductOfferReservation;
use Orm\Zed\OmsProductOfferReservation\Persistence\SpyOmsProductOfferReservationQuery;
use Orm\Zed\OmsProductOfferReservation\Persistence\Base\SpyOmsProductOfferReservation as BaseSpyOmsProductOfferReservation;
use Orm\Zed\OmsProductOfferReservation\Persistence\Map\SpyOmsProductOfferReservationTableMap;
use Orm\Zed\Oms\Persistence\SpyOmsProductReservation;
use Orm\Zed\Oms\Persistence\SpyOmsProductReservationQuery;
use Orm\Zed\Oms\Persistence\Base\SpyOmsProductReservation as BaseSpyOmsProductReservation;
use Orm\Zed\Oms\Persistence\Map\SpyOmsProductReservationTableMap;
use Orm\Zed\Payment\Persistence\SpyPaymentMethodStore;
use Orm\Zed\Payment\Persistence\SpyPaymentMethodStoreQuery;
use Orm\Zed\Payment\Persistence\Base\SpyPaymentMethodStore as BaseSpyPaymentMethodStore;
use Orm\Zed\Payment\Persistence\Map\SpyPaymentMethodStoreTableMap;
use Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductSchedule;
use Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleQuery;
use Orm\Zed\PriceProductSchedule\Persistence\Base\SpyPriceProductSchedule as BaseSpyPriceProductSchedule;
use Orm\Zed\PriceProductSchedule\Persistence\Map\SpyPriceProductScheduleTableMap;
use Orm\Zed\PriceProduct\Persistence\SpyPriceProductStore;
use Orm\Zed\PriceProduct\Persistence\SpyPriceProductStoreQuery;
use Orm\Zed\PriceProduct\Persistence\Base\SpyPriceProductStore as BaseSpyPriceProductStore;
use Orm\Zed\PriceProduct\Persistence\Map\SpyPriceProductStoreTableMap;
use Orm\Zed\ProductLabel\Persistence\SpyProductLabelStore;
use Orm\Zed\ProductLabel\Persistence\SpyProductLabelStoreQuery;
use Orm\Zed\ProductLabel\Persistence\Base\SpyProductLabelStore as BaseSpyProductLabelStore;
use Orm\Zed\ProductLabel\Persistence\Map\SpyProductLabelStoreTableMap;
use Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStore;
use Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStoreQuery;
use Orm\Zed\ProductMeasurementUnit\Persistence\Base\SpyProductMeasurementSalesUnitStore as BaseSpyProductMeasurementSalesUnitStore;
use Orm\Zed\ProductMeasurementUnit\Persistence\Map\SpyProductMeasurementSalesUnitStoreTableMap;
use Orm\Zed\ProductOffer\Persistence\SpyProductOffer;
use Orm\Zed\ProductOffer\Persistence\SpyProductOfferQuery;
use Orm\Zed\ProductOffer\Persistence\SpyProductOfferStore;
use Orm\Zed\ProductOffer\Persistence\SpyProductOfferStoreQuery;
use Orm\Zed\ProductOffer\Persistence\Base\SpyProductOfferStore as BaseSpyProductOfferStore;
use Orm\Zed\ProductOffer\Persistence\Map\SpyProductOfferStoreTableMap;
use Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePrice;
use Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePriceQuery;
use Orm\Zed\ProductOption\Persistence\Base\SpyProductOptionValuePrice as BaseSpyProductOptionValuePrice;
use Orm\Zed\ProductOption\Persistence\Map\SpyProductOptionValuePriceTableMap;
use Orm\Zed\ProductRelation\Persistence\SpyProductRelationStore;
use Orm\Zed\ProductRelation\Persistence\SpyProductRelationStoreQuery;
use Orm\Zed\ProductRelation\Persistence\Base\SpyProductRelationStore as BaseSpyProductRelationStore;
use Orm\Zed\ProductRelation\Persistence\Map\SpyProductRelationStoreTableMap;
use Orm\Zed\Product\Persistence\SpyProductAbstractStore;
use Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery;
use Orm\Zed\Product\Persistence\Base\SpyProductAbstractStore as BaseSpyProductAbstractStore;
use Orm\Zed\Product\Persistence\Map\SpyProductAbstractStoreTableMap;
use Orm\Zed\Quote\Persistence\SpyQuote;
use Orm\Zed\Quote\Persistence\SpyQuoteQuery;
use Orm\Zed\Quote\Persistence\Base\SpyQuote as BaseSpyQuote;
use Orm\Zed\Quote\Persistence\Map\SpyQuoteTableMap;
use Orm\Zed\SalesOrderThreshold\Persistence\SpySalesOrderThreshold;
use Orm\Zed\SalesOrderThreshold\Persistence\SpySalesOrderThresholdQuery;
use Orm\Zed\SalesOrderThreshold\Persistence\Base\SpySalesOrderThreshold as BaseSpySalesOrderThreshold;
use Orm\Zed\SalesOrderThreshold\Persistence\Map\SpySalesOrderThresholdTableMap;
use Orm\Zed\ServicePoint\Persistence\SpyServicePointStore;
use Orm\Zed\ServicePoint\Persistence\SpyServicePointStoreQuery;
use Orm\Zed\ServicePoint\Persistence\Base\SpyServicePointStore as BaseSpyServicePointStore;
use Orm\Zed\ServicePoint\Persistence\Map\SpyServicePointStoreTableMap;
use Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStore;
use Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStoreQuery;
use Orm\Zed\ShipmentType\Persistence\Base\SpyShipmentTypeStore as BaseSpyShipmentTypeStore;
use Orm\Zed\ShipmentType\Persistence\Map\SpyShipmentTypeStoreTableMap;
use Orm\Zed\Shipment\Persistence\SpyShipmentMethodPrice;
use Orm\Zed\Shipment\Persistence\SpyShipmentMethodPriceQuery;
use Orm\Zed\Shipment\Persistence\SpyShipmentMethodStore;
use Orm\Zed\Shipment\Persistence\SpyShipmentMethodStoreQuery;
use Orm\Zed\Shipment\Persistence\Base\SpyShipmentMethodPrice as BaseSpyShipmentMethodPrice;
use Orm\Zed\Shipment\Persistence\Base\SpyShipmentMethodStore as BaseSpyShipmentMethodStore;
use Orm\Zed\Shipment\Persistence\Map\SpyShipmentMethodPriceTableMap;
use Orm\Zed\Shipment\Persistence\Map\SpyShipmentMethodStoreTableMap;
use Orm\Zed\Stock\Persistence\SpyStockStore;
use Orm\Zed\Stock\Persistence\SpyStockStoreQuery;
use Orm\Zed\Stock\Persistence\Base\SpyStockStore as BaseSpyStockStore;
use Orm\Zed\Stock\Persistence\Map\SpyStockStoreTableMap;
use Orm\Zed\StoreContext\Persistence\SpyStoreContext;
use Orm\Zed\StoreContext\Persistence\SpyStoreContextQuery;
use Orm\Zed\StoreContext\Persistence\Base\SpyStoreContext as BaseSpyStoreContext;
use Orm\Zed\StoreContext\Persistence\Map\SpyStoreContextTableMap;
use Orm\Zed\Store\Persistence\SpyStore as ChildSpyStore;
use Orm\Zed\Store\Persistence\SpyStoreQuery as ChildSpyStoreQuery;
use Orm\Zed\Store\Persistence\Map\SpyStoreTableMap;
use Orm\Zed\Touch\Persistence\SpyTouchSearch;
use Orm\Zed\Touch\Persistence\SpyTouchSearchQuery;
use Orm\Zed\Touch\Persistence\SpyTouchStorage;
use Orm\Zed\Touch\Persistence\SpyTouchStorageQuery;
use Orm\Zed\Touch\Persistence\Base\SpyTouchSearch as BaseSpyTouchSearch;
use Orm\Zed\Touch\Persistence\Base\SpyTouchStorage as BaseSpyTouchStorage;
use Orm\Zed\Touch\Persistence\Map\SpyTouchSearchTableMap;
use Orm\Zed\Touch\Persistence\Map\SpyTouchStorageTableMap;
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
use Spryker\Zed\PropelReplicationCache\Business\PropelReplicationCacheFacade;

/**
 * Base class that represents a row from the 'spy_store' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.Store.Persistence.Base
 */
abstract class SpyStore implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\Store\\Persistence\\Map\\SpyStoreTableMap';


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
     * The value for the id_store field.
     *
     * @var        int
     */
    protected $id_store;

    /**
     * The value for the fk_currency field.
     * Default currency for the store.
     * @var        int|null
     */
    protected $fk_currency;

    /**
     * The value for the fk_locale field.
     * Default locale of the store.
     * @var        int|null
     */
    protected $fk_locale;

    /**
     * The value for the name field.
     * The name of an entity (e.g., user, category, product, role).
     * @var        string|null
     */
    protected $name;

    /**
     * @var        SpyCurrency
     */
    protected $aDefaultCurrency;

    /**
     * @var        SpyLocale
     */
    protected $aDefaultLocale;

    /**
     * @var        ObjectCollection|SpyAssetStore[] Collection to store aggregation of SpyAssetStore objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyAssetStore> Collection to store aggregation of SpyAssetStore objects.
     */
    protected $collSpyAssetStores;
    protected $collSpyAssetStoresPartial;

    /**
     * @var        ObjectCollection|SpyAvailabilityAbstract[] Collection to store aggregation of SpyAvailabilityAbstract objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyAvailabilityAbstract> Collection to store aggregation of SpyAvailabilityAbstract objects.
     */
    protected $collAvailabilityAbstracts;
    protected $collAvailabilityAbstractsPartial;

    /**
     * @var        ObjectCollection|SpyAvailability[] Collection to store aggregation of SpyAvailability objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyAvailability> Collection to store aggregation of SpyAvailability objects.
     */
    protected $collAvailabilities;
    protected $collAvailabilitiesPartial;

    /**
     * @var        ObjectCollection|SpyAvailabilityNotificationSubscription[] Collection to store aggregation of SpyAvailabilityNotificationSubscription objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyAvailabilityNotificationSubscription> Collection to store aggregation of SpyAvailabilityNotificationSubscription objects.
     */
    protected $collSpyAvailabilityNotificationSubscriptions;
    protected $collSpyAvailabilityNotificationSubscriptionsPartial;

    /**
     * @var        ObjectCollection|SpyCategoryStore[] Collection to store aggregation of SpyCategoryStore objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCategoryStore> Collection to store aggregation of SpyCategoryStore objects.
     */
    protected $collSpyCategoryStores;
    protected $collSpyCategoryStoresPartial;

    /**
     * @var        ObjectCollection|SpyCmsPageStore[] Collection to store aggregation of SpyCmsPageStore objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCmsPageStore> Collection to store aggregation of SpyCmsPageStore objects.
     */
    protected $collSpyCmsPageStores;
    protected $collSpyCmsPageStoresPartial;

    /**
     * @var        ObjectCollection|SpyCmsBlockStore[] Collection to store aggregation of SpyCmsBlockStore objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCmsBlockStore> Collection to store aggregation of SpyCmsBlockStore objects.
     */
    protected $collSpyCmsBlockStores;
    protected $collSpyCmsBlockStoresPartial;

    /**
     * @var        ObjectCollection|SpyCompanyStore[] Collection to store aggregation of SpyCompanyStore objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyStore> Collection to store aggregation of SpyCompanyStore objects.
     */
    protected $collSpyCompanyStores;
    protected $collSpyCompanyStoresPartial;

    /**
     * @var        ObjectCollection|SpyCountryStore[] Collection to store aggregation of SpyCountryStore objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCountryStore> Collection to store aggregation of SpyCountryStore objects.
     */
    protected $collCountryStores;
    protected $collCountryStoresPartial;

    /**
     * @var        ObjectCollection|SpyCurrencyStore[] Collection to store aggregation of SpyCurrencyStore objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCurrencyStore> Collection to store aggregation of SpyCurrencyStore objects.
     */
    protected $collCurrencyStores;
    protected $collCurrencyStoresPartial;

    /**
     * @var        ObjectCollection|SpyDiscount[] Collection to store aggregation of SpyDiscount objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyDiscount> Collection to store aggregation of SpyDiscount objects.
     */
    protected $collDiscounts;
    protected $collDiscountsPartial;

    /**
     * @var        ObjectCollection|SpyDiscountStore[] Collection to store aggregation of SpyDiscountStore objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyDiscountStore> Collection to store aggregation of SpyDiscountStore objects.
     */
    protected $collSpyDiscountStores;
    protected $collSpyDiscountStoresPartial;

    /**
     * @var        ObjectCollection|SpyLocaleStore[] Collection to store aggregation of SpyLocaleStore objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyLocaleStore> Collection to store aggregation of SpyLocaleStore objects.
     */
    protected $collLocaleStores;
    protected $collLocaleStoresPartial;

    /**
     * @var        ObjectCollection|SpyMerchantStore[] Collection to store aggregation of SpyMerchantStore objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantStore> Collection to store aggregation of SpyMerchantStore objects.
     */
    protected $collSpyMerchantStores;
    protected $collSpyMerchantStoresPartial;

    /**
     * @var        ObjectCollection|SpyMerchantCommissionStore[] Collection to store aggregation of SpyMerchantCommissionStore objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantCommissionStore> Collection to store aggregation of SpyMerchantCommissionStore objects.
     */
    protected $collMerchantCommissions;
    protected $collMerchantCommissionsPartial;

    /**
     * @var        ObjectCollection|SpyMerchantRegistrationRequest[] Collection to store aggregation of SpyMerchantRegistrationRequest objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantRegistrationRequest> Collection to store aggregation of SpyMerchantRegistrationRequest objects.
     */
    protected $collSpyMerchantRegistrationRequests;
    protected $collSpyMerchantRegistrationRequestsPartial;

    /**
     * @var        ObjectCollection|SpyMerchantRelationshipSalesOrderThreshold[] Collection to store aggregation of SpyMerchantRelationshipSalesOrderThreshold objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantRelationshipSalesOrderThreshold> Collection to store aggregation of SpyMerchantRelationshipSalesOrderThreshold objects.
     */
    protected $collSpyMerchantRelationshipSalesOrderThresholds;
    protected $collSpyMerchantRelationshipSalesOrderThresholdsPartial;

    /**
     * @var        ObjectCollection|SpyOmsProductReservation[] Collection to store aggregation of SpyOmsProductReservation objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyOmsProductReservation> Collection to store aggregation of SpyOmsProductReservation objects.
     */
    protected $collOmsProductReservations;
    protected $collOmsProductReservationsPartial;

    /**
     * @var        ObjectCollection|SpyOmsProductOfferReservation[] Collection to store aggregation of SpyOmsProductOfferReservation objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyOmsProductOfferReservation> Collection to store aggregation of SpyOmsProductOfferReservation objects.
     */
    protected $collOmsProductOfferReservations;
    protected $collOmsProductOfferReservationsPartial;

    /**
     * @var        ObjectCollection|SpyPaymentMethodStore[] Collection to store aggregation of SpyPaymentMethodStore objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyPaymentMethodStore> Collection to store aggregation of SpyPaymentMethodStore objects.
     */
    protected $collSpyPaymentMethodStores;
    protected $collSpyPaymentMethodStoresPartial;

    /**
     * @var        ObjectCollection|SpyPriceProductStore[] Collection to store aggregation of SpyPriceProductStore objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyPriceProductStore> Collection to store aggregation of SpyPriceProductStore objects.
     */
    protected $collPriceProductStores;
    protected $collPriceProductStoresPartial;

    /**
     * @var        ObjectCollection|SpyPriceProductSchedule[] Collection to store aggregation of SpyPriceProductSchedule objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyPriceProductSchedule> Collection to store aggregation of SpyPriceProductSchedule objects.
     */
    protected $collPriceProductSchedules;
    protected $collPriceProductSchedulesPartial;

    /**
     * @var        ObjectCollection|SpyProductAbstractStore[] Collection to store aggregation of SpyProductAbstractStore objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductAbstractStore> Collection to store aggregation of SpyProductAbstractStore objects.
     */
    protected $collSpyProductAbstractStores;
    protected $collSpyProductAbstractStoresPartial;

    /**
     * @var        ObjectCollection|SpyProductLabelStore[] Collection to store aggregation of SpyProductLabelStore objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductLabelStore> Collection to store aggregation of SpyProductLabelStore objects.
     */
    protected $collProductLabelStores;
    protected $collProductLabelStoresPartial;

    /**
     * @var        ObjectCollection|SpyProductMeasurementSalesUnitStore[] Collection to store aggregation of SpyProductMeasurementSalesUnitStore objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductMeasurementSalesUnitStore> Collection to store aggregation of SpyProductMeasurementSalesUnitStore objects.
     */
    protected $collSpyProductMeasurementSalesUnitStores;
    protected $collSpyProductMeasurementSalesUnitStoresPartial;

    /**
     * @var        ObjectCollection|SpyProductOfferStore[] Collection to store aggregation of SpyProductOfferStore objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductOfferStore> Collection to store aggregation of SpyProductOfferStore objects.
     */
    protected $collSpyProductOfferStores;
    protected $collSpyProductOfferStoresPartial;

    /**
     * @var        ObjectCollection|SpyProductOptionValuePrice[] Collection to store aggregation of SpyProductOptionValuePrice objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductOptionValuePrice> Collection to store aggregation of SpyProductOptionValuePrice objects.
     */
    protected $collProductOptionValuePrices;
    protected $collProductOptionValuePricesPartial;

    /**
     * @var        ObjectCollection|SpyProductRelationStore[] Collection to store aggregation of SpyProductRelationStore objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductRelationStore> Collection to store aggregation of SpyProductRelationStore objects.
     */
    protected $collProductRelationStores;
    protected $collProductRelationStoresPartial;

    /**
     * @var        ObjectCollection|SpyQuote[] Collection to store aggregation of SpyQuote objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyQuote> Collection to store aggregation of SpyQuote objects.
     */
    protected $collSpyQuotes;
    protected $collSpyQuotesPartial;

    /**
     * @var        ObjectCollection|SpySalesOrderThreshold[] Collection to store aggregation of SpySalesOrderThreshold objects.
     * @phpstan-var ObjectCollection&\Traversable<SpySalesOrderThreshold> Collection to store aggregation of SpySalesOrderThreshold objects.
     */
    protected $collSpySalesOrderThresholds;
    protected $collSpySalesOrderThresholdsPartial;

    /**
     * @var        ObjectCollection|SpyServicePointStore[] Collection to store aggregation of SpyServicePointStore objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyServicePointStore> Collection to store aggregation of SpyServicePointStore objects.
     */
    protected $collServicePointStores;
    protected $collServicePointStoresPartial;

    /**
     * @var        ObjectCollection|SpyShipmentMethodPrice[] Collection to store aggregation of SpyShipmentMethodPrice objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyShipmentMethodPrice> Collection to store aggregation of SpyShipmentMethodPrice objects.
     */
    protected $collShipmentMethodPrices;
    protected $collShipmentMethodPricesPartial;

    /**
     * @var        ObjectCollection|SpyShipmentMethodStore[] Collection to store aggregation of SpyShipmentMethodStore objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyShipmentMethodStore> Collection to store aggregation of SpyShipmentMethodStore objects.
     */
    protected $collShipmentMethodStores;
    protected $collShipmentMethodStoresPartial;

    /**
     * @var        ObjectCollection|SpyShipmentTypeStore[] Collection to store aggregation of SpyShipmentTypeStore objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyShipmentTypeStore> Collection to store aggregation of SpyShipmentTypeStore objects.
     */
    protected $collShipmentTypeStores;
    protected $collShipmentTypeStoresPartial;

    /**
     * @var        ObjectCollection|SpyStockStore[] Collection to store aggregation of SpyStockStore objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyStockStore> Collection to store aggregation of SpyStockStore objects.
     */
    protected $collStockStores;
    protected $collStockStoresPartial;

    /**
     * @var        ObjectCollection|SpyStoreContext[] Collection to store aggregation of SpyStoreContext objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyStoreContext> Collection to store aggregation of SpyStoreContext objects.
     */
    protected $collSpyStoreContexts;
    protected $collSpyStoreContextsPartial;

    /**
     * @var        ObjectCollection|SpyTouchStorage[] Collection to store aggregation of SpyTouchStorage objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyTouchStorage> Collection to store aggregation of SpyTouchStorage objects.
     */
    protected $collTouchStorages;
    protected $collTouchStoragesPartial;

    /**
     * @var        ObjectCollection|SpyTouchSearch[] Collection to store aggregation of SpyTouchSearch objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyTouchSearch> Collection to store aggregation of SpyTouchSearch objects.
     */
    protected $collTouchSearches;
    protected $collTouchSearchesPartial;

    /**
     * @var        ObjectCollection|SpyProductOffer[] Cross Collection to store aggregation of SpyProductOffer objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductOffer> Cross Collection to store aggregation of SpyProductOffer objects.
     */
    protected $collSpyProductOffers;

    /**
     * @var bool
     */
    protected $collSpyProductOffersPartial;

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
        'spy_store.fk_currency' => 'fk_currency',
        'spy_store.fk_locale' => 'fk_locale',
    ];

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductOffer[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductOffer>
     */
    protected $spyProductOffersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyAssetStore[]
     * @phpstan-var ObjectCollection&\Traversable<SpyAssetStore>
     */
    protected $spyAssetStoresScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyAvailabilityAbstract[]
     * @phpstan-var ObjectCollection&\Traversable<SpyAvailabilityAbstract>
     */
    protected $availabilityAbstractsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyAvailability[]
     * @phpstan-var ObjectCollection&\Traversable<SpyAvailability>
     */
    protected $availabilitiesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyAvailabilityNotificationSubscription[]
     * @phpstan-var ObjectCollection&\Traversable<SpyAvailabilityNotificationSubscription>
     */
    protected $spyAvailabilityNotificationSubscriptionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCategoryStore[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCategoryStore>
     */
    protected $spyCategoryStoresScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCmsPageStore[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCmsPageStore>
     */
    protected $spyCmsPageStoresScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCmsBlockStore[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCmsBlockStore>
     */
    protected $spyCmsBlockStoresScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCompanyStore[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCompanyStore>
     */
    protected $spyCompanyStoresScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCountryStore[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCountryStore>
     */
    protected $countryStoresScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCurrencyStore[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCurrencyStore>
     */
    protected $currencyStoresScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyDiscount[]
     * @phpstan-var ObjectCollection&\Traversable<SpyDiscount>
     */
    protected $discountsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyDiscountStore[]
     * @phpstan-var ObjectCollection&\Traversable<SpyDiscountStore>
     */
    protected $spyDiscountStoresScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyLocaleStore[]
     * @phpstan-var ObjectCollection&\Traversable<SpyLocaleStore>
     */
    protected $localeStoresScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyMerchantStore[]
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantStore>
     */
    protected $spyMerchantStoresScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyMerchantCommissionStore[]
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantCommissionStore>
     */
    protected $merchantCommissionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyMerchantRegistrationRequest[]
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantRegistrationRequest>
     */
    protected $spyMerchantRegistrationRequestsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyMerchantRelationshipSalesOrderThreshold[]
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantRelationshipSalesOrderThreshold>
     */
    protected $spyMerchantRelationshipSalesOrderThresholdsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyOmsProductReservation[]
     * @phpstan-var ObjectCollection&\Traversable<SpyOmsProductReservation>
     */
    protected $omsProductReservationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyOmsProductOfferReservation[]
     * @phpstan-var ObjectCollection&\Traversable<SpyOmsProductOfferReservation>
     */
    protected $omsProductOfferReservationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyPaymentMethodStore[]
     * @phpstan-var ObjectCollection&\Traversable<SpyPaymentMethodStore>
     */
    protected $spyPaymentMethodStoresScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyPriceProductStore[]
     * @phpstan-var ObjectCollection&\Traversable<SpyPriceProductStore>
     */
    protected $priceProductStoresScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyPriceProductSchedule[]
     * @phpstan-var ObjectCollection&\Traversable<SpyPriceProductSchedule>
     */
    protected $priceProductSchedulesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductAbstractStore[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductAbstractStore>
     */
    protected $spyProductAbstractStoresScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductLabelStore[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductLabelStore>
     */
    protected $productLabelStoresScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductMeasurementSalesUnitStore[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductMeasurementSalesUnitStore>
     */
    protected $spyProductMeasurementSalesUnitStoresScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductOfferStore[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductOfferStore>
     */
    protected $spyProductOfferStoresScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductOptionValuePrice[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductOptionValuePrice>
     */
    protected $productOptionValuePricesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductRelationStore[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductRelationStore>
     */
    protected $productRelationStoresScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyQuote[]
     * @phpstan-var ObjectCollection&\Traversable<SpyQuote>
     */
    protected $spyQuotesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpySalesOrderThreshold[]
     * @phpstan-var ObjectCollection&\Traversable<SpySalesOrderThreshold>
     */
    protected $spySalesOrderThresholdsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyServicePointStore[]
     * @phpstan-var ObjectCollection&\Traversable<SpyServicePointStore>
     */
    protected $servicePointStoresScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyShipmentMethodPrice[]
     * @phpstan-var ObjectCollection&\Traversable<SpyShipmentMethodPrice>
     */
    protected $shipmentMethodPricesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyShipmentMethodStore[]
     * @phpstan-var ObjectCollection&\Traversable<SpyShipmentMethodStore>
     */
    protected $shipmentMethodStoresScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyShipmentTypeStore[]
     * @phpstan-var ObjectCollection&\Traversable<SpyShipmentTypeStore>
     */
    protected $shipmentTypeStoresScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyStockStore[]
     * @phpstan-var ObjectCollection&\Traversable<SpyStockStore>
     */
    protected $stockStoresScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyStoreContext[]
     * @phpstan-var ObjectCollection&\Traversable<SpyStoreContext>
     */
    protected $spyStoreContextsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyTouchStorage[]
     * @phpstan-var ObjectCollection&\Traversable<SpyTouchStorage>
     */
    protected $touchStoragesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyTouchSearch[]
     * @phpstan-var ObjectCollection&\Traversable<SpyTouchSearch>
     */
    protected $touchSearchesScheduledForDeletion = null;

    /**
     * Initializes internal state of Orm\Zed\Store\Persistence\Base\SpyStore object.
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
     * Compares this with another <code>SpyStore</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyStore</code>, delegates to
     * <code>equals(SpyStore)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_store] column value.
     *
     * @return int
     */
    public function getIdStore()
    {
        return $this->id_store;
    }

    /**
     * Get the [fk_currency] column value.
     * Default currency for the store.
     * @return int|null
     */
    public function getFkCurrency()
    {
        return $this->fk_currency;
    }

    /**
     * Get the [fk_locale] column value.
     * Default locale of the store.
     * @return int|null
     */
    public function getFkLocale()
    {
        return $this->fk_locale;
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
     * Set the value of [id_store] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdStore($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_store !== $v) {
            $this->id_store = $v;
            $this->modifiedColumns[SpyStoreTableMap::COL_ID_STORE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_currency] column.
     * Default currency for the store.
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkCurrency($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_currency !== $v) {
            $this->fk_currency = $v;
            $this->modifiedColumns[SpyStoreTableMap::COL_FK_CURRENCY] = true;
        }

        if ($this->aDefaultCurrency !== null && $this->aDefaultCurrency->getIdCurrency() !== $v) {
            $this->aDefaultCurrency = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_locale] column.
     * Default locale of the store.
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
            $this->modifiedColumns[SpyStoreTableMap::COL_FK_LOCALE] = true;
        }

        if ($this->aDefaultLocale !== null && $this->aDefaultLocale->getIdLocale() !== $v) {
            $this->aDefaultLocale = null;
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
            $this->modifiedColumns[SpyStoreTableMap::COL_NAME] = true;
        }

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyStoreTableMap::translateFieldName('IdStore', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_store = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyStoreTableMap::translateFieldName('FkCurrency', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_currency = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyStoreTableMap::translateFieldName('FkLocale', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_locale = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyStoreTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 4; // 4 = SpyStoreTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\Store\\Persistence\\SpyStore'), 0, $e);
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
        if ($this->aDefaultCurrency !== null && $this->fk_currency !== $this->aDefaultCurrency->getIdCurrency()) {
            $this->aDefaultCurrency = null;
        }
        if ($this->aDefaultLocale !== null && $this->fk_locale !== $this->aDefaultLocale->getIdLocale()) {
            $this->aDefaultLocale = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyStoreTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyStoreQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aDefaultCurrency = null;
            $this->aDefaultLocale = null;
            $this->collSpyAssetStores = null;

            $this->collAvailabilityAbstracts = null;

            $this->collAvailabilities = null;

            $this->collSpyAvailabilityNotificationSubscriptions = null;

            $this->collSpyCategoryStores = null;

            $this->collSpyCmsPageStores = null;

            $this->collSpyCmsBlockStores = null;

            $this->collSpyCompanyStores = null;

            $this->collCountryStores = null;

            $this->collCurrencyStores = null;

            $this->collDiscounts = null;

            $this->collSpyDiscountStores = null;

            $this->collLocaleStores = null;

            $this->collSpyMerchantStores = null;

            $this->collMerchantCommissions = null;

            $this->collSpyMerchantRegistrationRequests = null;

            $this->collSpyMerchantRelationshipSalesOrderThresholds = null;

            $this->collOmsProductReservations = null;

            $this->collOmsProductOfferReservations = null;

            $this->collSpyPaymentMethodStores = null;

            $this->collPriceProductStores = null;

            $this->collPriceProductSchedules = null;

            $this->collSpyProductAbstractStores = null;

            $this->collProductLabelStores = null;

            $this->collSpyProductMeasurementSalesUnitStores = null;

            $this->collSpyProductOfferStores = null;

            $this->collProductOptionValuePrices = null;

            $this->collProductRelationStores = null;

            $this->collSpyQuotes = null;

            $this->collSpySalesOrderThresholds = null;

            $this->collServicePointStores = null;

            $this->collShipmentMethodPrices = null;

            $this->collShipmentMethodStores = null;

            $this->collShipmentTypeStores = null;

            $this->collStockStores = null;

            $this->collSpyStoreContexts = null;

            $this->collTouchStorages = null;

            $this->collTouchSearches = null;

            $this->collSpyProductOffers = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyStore::setDeleted()
     * @see SpyStore::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyStoreTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyStoreQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyStoreTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            // event behavior

            $this->prepareSaveEventName();

            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
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

                SpyStoreTableMap::addInstanceToPool($this);
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

            if ($this->aDefaultCurrency !== null) {
                if ($this->aDefaultCurrency->isModified() || $this->aDefaultCurrency->isNew()) {
                    $affectedRows += $this->aDefaultCurrency->save($con);
                }
                $this->setDefaultCurrency($this->aDefaultCurrency);
            }

            if ($this->aDefaultLocale !== null) {
                if ($this->aDefaultLocale->isModified() || $this->aDefaultLocale->isNew()) {
                    $affectedRows += $this->aDefaultLocale->save($con);
                }
                $this->setDefaultLocale($this->aDefaultLocale);
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

            if ($this->spyProductOffersScheduledForDeletion !== null) {
                if (!$this->spyProductOffersScheduledForDeletion->isEmpty()) {
                    $pks = [];
                    foreach ($this->spyProductOffersScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[1] = $this->getIdStore();
                        $entryPk[0] = $entry->getIdProductOffer();
                        $pks[] = $entryPk;
                    }

                    \Orm\Zed\ProductOffer\Persistence\SpyProductOfferStoreQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->spyProductOffersScheduledForDeletion = null;
                }

            }

            if ($this->collSpyProductOffers) {
                foreach ($this->collSpyProductOffers as $spyProductOffer) {
                    if (!$spyProductOffer->isDeleted() && ($spyProductOffer->isNew() || $spyProductOffer->isModified())) {
                        $spyProductOffer->save($con);
                    }
                }
            }


            if ($this->spyAssetStoresScheduledForDeletion !== null) {
                if (!$this->spyAssetStoresScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Asset\Persistence\SpyAssetStoreQuery::create()
                        ->filterByPrimaryKeys($this->spyAssetStoresScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyAssetStoresScheduledForDeletion = null;
                }
            }

            if ($this->collSpyAssetStores !== null) {
                foreach ($this->collSpyAssetStores as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->availabilityAbstractsScheduledForDeletion !== null) {
                if (!$this->availabilityAbstractsScheduledForDeletion->isEmpty()) {
                    foreach ($this->availabilityAbstractsScheduledForDeletion as $availabilityAbstract) {
                        // need to save related object because we set the relation to null
                        $availabilityAbstract->save($con);
                    }
                    $this->availabilityAbstractsScheduledForDeletion = null;
                }
            }

            if ($this->collAvailabilityAbstracts !== null) {
                foreach ($this->collAvailabilityAbstracts as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->availabilitiesScheduledForDeletion !== null) {
                if (!$this->availabilitiesScheduledForDeletion->isEmpty()) {
                    foreach ($this->availabilitiesScheduledForDeletion as $availability) {
                        // need to save related object because we set the relation to null
                        $availability->save($con);
                    }
                    $this->availabilitiesScheduledForDeletion = null;
                }
            }

            if ($this->collAvailabilities !== null) {
                foreach ($this->collAvailabilities as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyAvailabilityNotificationSubscriptionsScheduledForDeletion !== null) {
                if (!$this->spyAvailabilityNotificationSubscriptionsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscriptionQuery::create()
                        ->filterByPrimaryKeys($this->spyAvailabilityNotificationSubscriptionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyAvailabilityNotificationSubscriptionsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyAvailabilityNotificationSubscriptions !== null) {
                foreach ($this->collSpyAvailabilityNotificationSubscriptions as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyCategoryStoresScheduledForDeletion !== null) {
                if (!$this->spyCategoryStoresScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Category\Persistence\SpyCategoryStoreQuery::create()
                        ->filterByPrimaryKeys($this->spyCategoryStoresScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyCategoryStoresScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCategoryStores !== null) {
                foreach ($this->collSpyCategoryStores as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyCmsPageStoresScheduledForDeletion !== null) {
                if (!$this->spyCmsPageStoresScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Cms\Persistence\SpyCmsPageStoreQuery::create()
                        ->filterByPrimaryKeys($this->spyCmsPageStoresScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyCmsPageStoresScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCmsPageStores !== null) {
                foreach ($this->collSpyCmsPageStores as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyCmsBlockStoresScheduledForDeletion !== null) {
                if (!$this->spyCmsBlockStoresScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStoreQuery::create()
                        ->filterByPrimaryKeys($this->spyCmsBlockStoresScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyCmsBlockStoresScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCmsBlockStores !== null) {
                foreach ($this->collSpyCmsBlockStores as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyCompanyStoresScheduledForDeletion !== null) {
                if (!$this->spyCompanyStoresScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Company\Persistence\SpyCompanyStoreQuery::create()
                        ->filterByPrimaryKeys($this->spyCompanyStoresScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyCompanyStoresScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCompanyStores !== null) {
                foreach ($this->collSpyCompanyStores as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->countryStoresScheduledForDeletion !== null) {
                if (!$this->countryStoresScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Country\Persistence\SpyCountryStoreQuery::create()
                        ->filterByPrimaryKeys($this->countryStoresScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->countryStoresScheduledForDeletion = null;
                }
            }

            if ($this->collCountryStores !== null) {
                foreach ($this->collCountryStores as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->currencyStoresScheduledForDeletion !== null) {
                if (!$this->currencyStoresScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Currency\Persistence\SpyCurrencyStoreQuery::create()
                        ->filterByPrimaryKeys($this->currencyStoresScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->currencyStoresScheduledForDeletion = null;
                }
            }

            if ($this->collCurrencyStores !== null) {
                foreach ($this->collCurrencyStores as $referrerFK) {
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

            if ($this->spyDiscountStoresScheduledForDeletion !== null) {
                if (!$this->spyDiscountStoresScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Discount\Persistence\SpyDiscountStoreQuery::create()
                        ->filterByPrimaryKeys($this->spyDiscountStoresScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyDiscountStoresScheduledForDeletion = null;
                }
            }

            if ($this->collSpyDiscountStores !== null) {
                foreach ($this->collSpyDiscountStores as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->localeStoresScheduledForDeletion !== null) {
                if (!$this->localeStoresScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Locale\Persistence\SpyLocaleStoreQuery::create()
                        ->filterByPrimaryKeys($this->localeStoresScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->localeStoresScheduledForDeletion = null;
                }
            }

            if ($this->collLocaleStores !== null) {
                foreach ($this->collLocaleStores as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyMerchantStoresScheduledForDeletion !== null) {
                if (!$this->spyMerchantStoresScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Merchant\Persistence\SpyMerchantStoreQuery::create()
                        ->filterByPrimaryKeys($this->spyMerchantStoresScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyMerchantStoresScheduledForDeletion = null;
                }
            }

            if ($this->collSpyMerchantStores !== null) {
                foreach ($this->collSpyMerchantStores as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->merchantCommissionsScheduledForDeletion !== null) {
                if (!$this->merchantCommissionsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStoreQuery::create()
                        ->filterByPrimaryKeys($this->merchantCommissionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->merchantCommissionsScheduledForDeletion = null;
                }
            }

            if ($this->collMerchantCommissions !== null) {
                foreach ($this->collMerchantCommissions as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyMerchantRegistrationRequestsScheduledForDeletion !== null) {
                if (!$this->spyMerchantRegistrationRequestsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequestQuery::create()
                        ->filterByPrimaryKeys($this->spyMerchantRegistrationRequestsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyMerchantRegistrationRequestsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyMerchantRegistrationRequests !== null) {
                foreach ($this->collSpyMerchantRegistrationRequests as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyMerchantRelationshipSalesOrderThresholdsScheduledForDeletion !== null) {
                if (!$this->spyMerchantRelationshipSalesOrderThresholdsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\MerchantRelationshipSalesOrderThreshold\Persistence\SpyMerchantRelationshipSalesOrderThresholdQuery::create()
                        ->filterByPrimaryKeys($this->spyMerchantRelationshipSalesOrderThresholdsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyMerchantRelationshipSalesOrderThresholdsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyMerchantRelationshipSalesOrderThresholds !== null) {
                foreach ($this->collSpyMerchantRelationshipSalesOrderThresholds as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->omsProductReservationsScheduledForDeletion !== null) {
                if (!$this->omsProductReservationsScheduledForDeletion->isEmpty()) {
                    foreach ($this->omsProductReservationsScheduledForDeletion as $omsProductReservation) {
                        // need to save related object because we set the relation to null
                        $omsProductReservation->save($con);
                    }
                    $this->omsProductReservationsScheduledForDeletion = null;
                }
            }

            if ($this->collOmsProductReservations !== null) {
                foreach ($this->collOmsProductReservations as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->omsProductOfferReservationsScheduledForDeletion !== null) {
                if (!$this->omsProductOfferReservationsScheduledForDeletion->isEmpty()) {
                    foreach ($this->omsProductOfferReservationsScheduledForDeletion as $omsProductOfferReservation) {
                        // need to save related object because we set the relation to null
                        $omsProductOfferReservation->save($con);
                    }
                    $this->omsProductOfferReservationsScheduledForDeletion = null;
                }
            }

            if ($this->collOmsProductOfferReservations !== null) {
                foreach ($this->collOmsProductOfferReservations as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyPaymentMethodStoresScheduledForDeletion !== null) {
                if (!$this->spyPaymentMethodStoresScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Payment\Persistence\SpyPaymentMethodStoreQuery::create()
                        ->filterByPrimaryKeys($this->spyPaymentMethodStoresScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyPaymentMethodStoresScheduledForDeletion = null;
                }
            }

            if ($this->collSpyPaymentMethodStores !== null) {
                foreach ($this->collSpyPaymentMethodStores as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->priceProductStoresScheduledForDeletion !== null) {
                if (!$this->priceProductStoresScheduledForDeletion->isEmpty()) {
                    foreach ($this->priceProductStoresScheduledForDeletion as $priceProductStore) {
                        // need to save related object because we set the relation to null
                        $priceProductStore->save($con);
                    }
                    $this->priceProductStoresScheduledForDeletion = null;
                }
            }

            if ($this->collPriceProductStores !== null) {
                foreach ($this->collPriceProductStores as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->priceProductSchedulesScheduledForDeletion !== null) {
                if (!$this->priceProductSchedulesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleQuery::create()
                        ->filterByPrimaryKeys($this->priceProductSchedulesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->priceProductSchedulesScheduledForDeletion = null;
                }
            }

            if ($this->collPriceProductSchedules !== null) {
                foreach ($this->collPriceProductSchedules as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductAbstractStoresScheduledForDeletion !== null) {
                if (!$this->spyProductAbstractStoresScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery::create()
                        ->filterByPrimaryKeys($this->spyProductAbstractStoresScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductAbstractStoresScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductAbstractStores !== null) {
                foreach ($this->collSpyProductAbstractStores as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
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

            if ($this->spyProductOfferStoresScheduledForDeletion !== null) {
                if (!$this->spyProductOfferStoresScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductOffer\Persistence\SpyProductOfferStoreQuery::create()
                        ->filterByPrimaryKeys($this->spyProductOfferStoresScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductOfferStoresScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductOfferStores !== null) {
                foreach ($this->collSpyProductOfferStores as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->productOptionValuePricesScheduledForDeletion !== null) {
                if (!$this->productOptionValuePricesScheduledForDeletion->isEmpty()) {
                    foreach ($this->productOptionValuePricesScheduledForDeletion as $productOptionValuePrice) {
                        // need to save related object because we set the relation to null
                        $productOptionValuePrice->save($con);
                    }
                    $this->productOptionValuePricesScheduledForDeletion = null;
                }
            }

            if ($this->collProductOptionValuePrices !== null) {
                foreach ($this->collProductOptionValuePrices as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->productRelationStoresScheduledForDeletion !== null) {
                if (!$this->productRelationStoresScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductRelation\Persistence\SpyProductRelationStoreQuery::create()
                        ->filterByPrimaryKeys($this->productRelationStoresScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->productRelationStoresScheduledForDeletion = null;
                }
            }

            if ($this->collProductRelationStores !== null) {
                foreach ($this->collProductRelationStores as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyQuotesScheduledForDeletion !== null) {
                if (!$this->spyQuotesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Quote\Persistence\SpyQuoteQuery::create()
                        ->filterByPrimaryKeys($this->spyQuotesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyQuotesScheduledForDeletion = null;
                }
            }

            if ($this->collSpyQuotes !== null) {
                foreach ($this->collSpyQuotes as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spySalesOrderThresholdsScheduledForDeletion !== null) {
                if (!$this->spySalesOrderThresholdsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\SalesOrderThreshold\Persistence\SpySalesOrderThresholdQuery::create()
                        ->filterByPrimaryKeys($this->spySalesOrderThresholdsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spySalesOrderThresholdsScheduledForDeletion = null;
                }
            }

            if ($this->collSpySalesOrderThresholds !== null) {
                foreach ($this->collSpySalesOrderThresholds as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->servicePointStoresScheduledForDeletion !== null) {
                if (!$this->servicePointStoresScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ServicePoint\Persistence\SpyServicePointStoreQuery::create()
                        ->filterByPrimaryKeys($this->servicePointStoresScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->servicePointStoresScheduledForDeletion = null;
                }
            }

            if ($this->collServicePointStores !== null) {
                foreach ($this->collServicePointStores as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->shipmentMethodPricesScheduledForDeletion !== null) {
                if (!$this->shipmentMethodPricesScheduledForDeletion->isEmpty()) {
                    foreach ($this->shipmentMethodPricesScheduledForDeletion as $shipmentMethodPrice) {
                        // need to save related object because we set the relation to null
                        $shipmentMethodPrice->save($con);
                    }
                    $this->shipmentMethodPricesScheduledForDeletion = null;
                }
            }

            if ($this->collShipmentMethodPrices !== null) {
                foreach ($this->collShipmentMethodPrices as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->shipmentMethodStoresScheduledForDeletion !== null) {
                if (!$this->shipmentMethodStoresScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Shipment\Persistence\SpyShipmentMethodStoreQuery::create()
                        ->filterByPrimaryKeys($this->shipmentMethodStoresScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->shipmentMethodStoresScheduledForDeletion = null;
                }
            }

            if ($this->collShipmentMethodStores !== null) {
                foreach ($this->collShipmentMethodStores as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->shipmentTypeStoresScheduledForDeletion !== null) {
                if (!$this->shipmentTypeStoresScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStoreQuery::create()
                        ->filterByPrimaryKeys($this->shipmentTypeStoresScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->shipmentTypeStoresScheduledForDeletion = null;
                }
            }

            if ($this->collShipmentTypeStores !== null) {
                foreach ($this->collShipmentTypeStores as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->stockStoresScheduledForDeletion !== null) {
                if (!$this->stockStoresScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Stock\Persistence\SpyStockStoreQuery::create()
                        ->filterByPrimaryKeys($this->stockStoresScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->stockStoresScheduledForDeletion = null;
                }
            }

            if ($this->collStockStores !== null) {
                foreach ($this->collStockStores as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyStoreContextsScheduledForDeletion !== null) {
                if (!$this->spyStoreContextsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\StoreContext\Persistence\SpyStoreContextQuery::create()
                        ->filterByPrimaryKeys($this->spyStoreContextsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyStoreContextsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyStoreContexts !== null) {
                foreach ($this->collSpyStoreContexts as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->touchStoragesScheduledForDeletion !== null) {
                if (!$this->touchStoragesScheduledForDeletion->isEmpty()) {
                    foreach ($this->touchStoragesScheduledForDeletion as $touchStorage) {
                        // need to save related object because we set the relation to null
                        $touchStorage->save($con);
                    }
                    $this->touchStoragesScheduledForDeletion = null;
                }
            }

            if ($this->collTouchStorages !== null) {
                foreach ($this->collTouchStorages as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->touchSearchesScheduledForDeletion !== null) {
                if (!$this->touchSearchesScheduledForDeletion->isEmpty()) {
                    foreach ($this->touchSearchesScheduledForDeletion as $touchSearch) {
                        // need to save related object because we set the relation to null
                        $touchSearch->save($con);
                    }
                    $this->touchSearchesScheduledForDeletion = null;
                }
            }

            if ($this->collTouchSearches !== null) {
                foreach ($this->collTouchSearches as $referrerFK) {
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

        $this->modifiedColumns[SpyStoreTableMap::COL_ID_STORE] = true;
        if (null !== $this->id_store) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyStoreTableMap::COL_ID_STORE . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyStoreTableMap::COL_ID_STORE)) {
            $modifiedColumns[':p' . $index++]  = 'id_store';
        }
        if ($this->isColumnModified(SpyStoreTableMap::COL_FK_CURRENCY)) {
            $modifiedColumns[':p' . $index++]  = 'fk_currency';
        }
        if ($this->isColumnModified(SpyStoreTableMap::COL_FK_LOCALE)) {
            $modifiedColumns[':p' . $index++]  = 'fk_locale';
        }
        if ($this->isColumnModified(SpyStoreTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }

        $sql = sprintf(
            'INSERT INTO spy_store (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_store':
                        $stmt->bindValue($identifier, $this->id_store, PDO::PARAM_INT);

                        break;
                    case 'fk_currency':
                        $stmt->bindValue($identifier, $this->fk_currency, PDO::PARAM_INT);

                        break;
                    case 'fk_locale':
                        $stmt->bindValue($identifier, $this->fk_locale, PDO::PARAM_INT);

                        break;
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);

                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId('spy_store_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdStore($pk);

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
        $pos = SpyStoreTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdStore();

            case 1:
                return $this->getFkCurrency();

            case 2:
                return $this->getFkLocale();

            case 3:
                return $this->getName();

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
        if (isset($alreadyDumpedObjects['SpyStore'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyStore'][$this->hashCode()] = true;
        $keys = SpyStoreTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdStore(),
            $keys[1] => $this->getFkCurrency(),
            $keys[2] => $this->getFkLocale(),
            $keys[3] => $this->getName(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aDefaultCurrency) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCurrency';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_currency';
                        break;
                    default:
                        $key = 'DefaultCurrency';
                }

                $result[$key] = $this->aDefaultCurrency->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aDefaultLocale) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyLocale';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_locale';
                        break;
                    default:
                        $key = 'DefaultLocale';
                }

                $result[$key] = $this->aDefaultLocale->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collSpyAssetStores) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyAssetStores';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_asset_stores';
                        break;
                    default:
                        $key = 'SpyAssetStores';
                }

                $result[$key] = $this->collSpyAssetStores->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collAvailabilityAbstracts) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyAvailabilityAbstracts';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_availability_abstracts';
                        break;
                    default:
                        $key = 'AvailabilityAbstracts';
                }

                $result[$key] = $this->collAvailabilityAbstracts->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collAvailabilities) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyAvailabilities';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_availabilities';
                        break;
                    default:
                        $key = 'Availabilities';
                }

                $result[$key] = $this->collAvailabilities->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyAvailabilityNotificationSubscriptions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyAvailabilityNotificationSubscriptions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_availability_notification_subscriptions';
                        break;
                    default:
                        $key = 'SpyAvailabilityNotificationSubscriptions';
                }

                $result[$key] = $this->collSpyAvailabilityNotificationSubscriptions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyCategoryStores) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCategoryStores';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_category_stores';
                        break;
                    default:
                        $key = 'SpyCategoryStores';
                }

                $result[$key] = $this->collSpyCategoryStores->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyCmsPageStores) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCmsPageStores';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_cms_page_stores';
                        break;
                    default:
                        $key = 'SpyCmsPageStores';
                }

                $result[$key] = $this->collSpyCmsPageStores->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyCmsBlockStores) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCmsBlockStores';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_cms_block_stores';
                        break;
                    default:
                        $key = 'SpyCmsBlockStores';
                }

                $result[$key] = $this->collSpyCmsBlockStores->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyCompanyStores) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCompanyStores';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_company_stores';
                        break;
                    default:
                        $key = 'SpyCompanyStores';
                }

                $result[$key] = $this->collSpyCompanyStores->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCountryStores) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCountryStores';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_country_stores';
                        break;
                    default:
                        $key = 'CountryStores';
                }

                $result[$key] = $this->collCountryStores->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCurrencyStores) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCurrencyStores';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_currency_stores';
                        break;
                    default:
                        $key = 'CurrencyStores';
                }

                $result[$key] = $this->collCurrencyStores->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collDiscounts) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyDiscounts';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_discounts';
                        break;
                    default:
                        $key = 'Discounts';
                }

                $result[$key] = $this->collDiscounts->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyDiscountStores) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyDiscountStores';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_discount_stores';
                        break;
                    default:
                        $key = 'SpyDiscountStores';
                }

                $result[$key] = $this->collSpyDiscountStores->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLocaleStores) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyLocaleStores';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_locale_stores';
                        break;
                    default:
                        $key = 'LocaleStores';
                }

                $result[$key] = $this->collLocaleStores->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyMerchantStores) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchantStores';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant_stores';
                        break;
                    default:
                        $key = 'SpyMerchantStores';
                }

                $result[$key] = $this->collSpyMerchantStores->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collMerchantCommissions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchantCommissionStores';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant_commission_stores';
                        break;
                    default:
                        $key = 'MerchantCommissions';
                }

                $result[$key] = $this->collMerchantCommissions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyMerchantRegistrationRequests) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchantRegistrationRequests';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant_registration_requests';
                        break;
                    default:
                        $key = 'SpyMerchantRegistrationRequests';
                }

                $result[$key] = $this->collSpyMerchantRegistrationRequests->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyMerchantRelationshipSalesOrderThresholds) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchantRelationshipSalesOrderThresholds';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant_relationship_sales_order_thresholds';
                        break;
                    default:
                        $key = 'SpyMerchantRelationshipSalesOrderThresholds';
                }

                $result[$key] = $this->collSpyMerchantRelationshipSalesOrderThresholds->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOmsProductReservations) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyOmsProductReservations';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_oms_product_reservations';
                        break;
                    default:
                        $key = 'OmsProductReservations';
                }

                $result[$key] = $this->collOmsProductReservations->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOmsProductOfferReservations) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyOmsProductOfferReservations';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_oms_product_offer_reservations';
                        break;
                    default:
                        $key = 'OmsProductOfferReservations';
                }

                $result[$key] = $this->collOmsProductOfferReservations->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyPaymentMethodStores) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyPaymentMethodStores';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_payment_method_stores';
                        break;
                    default:
                        $key = 'SpyPaymentMethodStores';
                }

                $result[$key] = $this->collSpyPaymentMethodStores->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPriceProductStores) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyPriceProductStores';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_price_product_stores';
                        break;
                    default:
                        $key = 'PriceProductStores';
                }

                $result[$key] = $this->collPriceProductStores->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPriceProductSchedules) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyPriceProductSchedules';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_price_product_schedules';
                        break;
                    default:
                        $key = 'PriceProductSchedules';
                }

                $result[$key] = $this->collPriceProductSchedules->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductAbstractStores) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductAbstractStores';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_abstract_stores';
                        break;
                    default:
                        $key = 'SpyProductAbstractStores';
                }

                $result[$key] = $this->collSpyProductAbstractStores->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
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
            if (null !== $this->collSpyProductOfferStores) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductOfferStores';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_offer_stores';
                        break;
                    default:
                        $key = 'SpyProductOfferStores';
                }

                $result[$key] = $this->collSpyProductOfferStores->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProductOptionValuePrices) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductOptionValuePrices';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_option_value_prices';
                        break;
                    default:
                        $key = 'ProductOptionValuePrices';
                }

                $result[$key] = $this->collProductOptionValuePrices->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProductRelationStores) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductRelationStores';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_relation_stores';
                        break;
                    default:
                        $key = 'ProductRelationStores';
                }

                $result[$key] = $this->collProductRelationStores->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyQuotes) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyQuotes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_quotes';
                        break;
                    default:
                        $key = 'SpyQuotes';
                }

                $result[$key] = $this->collSpyQuotes->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpySalesOrderThresholds) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spySalesOrderThresholds';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_sales_order_thresholds';
                        break;
                    default:
                        $key = 'SpySalesOrderThresholds';
                }

                $result[$key] = $this->collSpySalesOrderThresholds->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collServicePointStores) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyServicePointStores';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_service_point_stores';
                        break;
                    default:
                        $key = 'ServicePointStores';
                }

                $result[$key] = $this->collServicePointStores->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collShipmentMethodPrices) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyShipmentMethodPrices';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_shipment_method_prices';
                        break;
                    default:
                        $key = 'ShipmentMethodPrices';
                }

                $result[$key] = $this->collShipmentMethodPrices->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collShipmentMethodStores) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyShipmentMethodStores';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_shipment_method_stores';
                        break;
                    default:
                        $key = 'ShipmentMethodStores';
                }

                $result[$key] = $this->collShipmentMethodStores->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collShipmentTypeStores) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyShipmentTypeStores';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_shipment_type_stores';
                        break;
                    default:
                        $key = 'ShipmentTypeStores';
                }

                $result[$key] = $this->collShipmentTypeStores->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collStockStores) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyStockStores';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_stock_stores';
                        break;
                    default:
                        $key = 'StockStores';
                }

                $result[$key] = $this->collStockStores->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyStoreContexts) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyStoreContexts';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_store_contexts';
                        break;
                    default:
                        $key = 'SpyStoreContexts';
                }

                $result[$key] = $this->collSpyStoreContexts->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTouchStorages) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyTouchStorages';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_touch_storages';
                        break;
                    default:
                        $key = 'TouchStorages';
                }

                $result[$key] = $this->collTouchStorages->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTouchSearches) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyTouchSearches';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_touch_searches';
                        break;
                    default:
                        $key = 'TouchSearches';
                }

                $result[$key] = $this->collTouchSearches->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyStoreTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdStore($value);
                break;
            case 1:
                $this->setFkCurrency($value);
                break;
            case 2:
                $this->setFkLocale($value);
                break;
            case 3:
                $this->setName($value);
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
        $keys = SpyStoreTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdStore($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkCurrency($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setFkLocale($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setName($arr[$keys[3]]);
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
        $criteria = new Criteria(SpyStoreTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyStoreTableMap::COL_ID_STORE)) {
            $criteria->add(SpyStoreTableMap::COL_ID_STORE, $this->id_store);
        }
        if ($this->isColumnModified(SpyStoreTableMap::COL_FK_CURRENCY)) {
            $criteria->add(SpyStoreTableMap::COL_FK_CURRENCY, $this->fk_currency);
        }
        if ($this->isColumnModified(SpyStoreTableMap::COL_FK_LOCALE)) {
            $criteria->add(SpyStoreTableMap::COL_FK_LOCALE, $this->fk_locale);
        }
        if ($this->isColumnModified(SpyStoreTableMap::COL_NAME)) {
            $criteria->add(SpyStoreTableMap::COL_NAME, $this->name);
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
        $criteria = ChildSpyStoreQuery::create();
        $criteria->add(SpyStoreTableMap::COL_ID_STORE, $this->id_store);

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
        $validPk = null !== $this->getIdStore();

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
        return $this->getIdStore();
    }

    /**
     * Generic method to set the primary key (id_store column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdStore($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdStore();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\Store\Persistence\SpyStore (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkCurrency($this->getFkCurrency());
        $copyObj->setFkLocale($this->getFkLocale());
        $copyObj->setName($this->getName());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyAssetStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyAssetStore($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getAvailabilityAbstracts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAvailabilityAbstract($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getAvailabilities() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAvailability($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyAvailabilityNotificationSubscriptions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyAvailabilityNotificationSubscription($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyCategoryStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCategoryStore($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyCmsPageStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCmsPageStore($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyCmsBlockStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCmsBlockStore($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyCompanyStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCompanyStore($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCountryStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCountryStore($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCurrencyStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCurrencyStore($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getDiscounts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDiscount($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyDiscountStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyDiscountStore($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLocaleStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLocaleStore($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyMerchantStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyMerchantStore($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getMerchantCommissions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMerchantCommission($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyMerchantRegistrationRequests() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyMerchantRegistrationRequest($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyMerchantRelationshipSalesOrderThresholds() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyMerchantRelationshipSalesOrderThreshold($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOmsProductReservations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOmsProductReservation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOmsProductOfferReservations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOmsProductOfferReservation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyPaymentMethodStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyPaymentMethodStore($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPriceProductStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPriceProductStore($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPriceProductSchedules() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPriceProductSchedule($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductAbstractStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductAbstractStore($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProductLabelStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductLabelStore($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductMeasurementSalesUnitStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductMeasurementSalesUnitStore($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductOfferStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductOfferStore($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProductOptionValuePrices() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductOptionValuePrice($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProductRelationStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductRelationStore($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyQuotes() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyQuote($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpySalesOrderThresholds() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpySalesOrderThreshold($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getServicePointStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addServicePointStore($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getShipmentMethodPrices() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addShipmentMethodPrice($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getShipmentMethodStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addShipmentMethodStore($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getShipmentTypeStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addShipmentTypeStore($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getStockStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addStockStore($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyStoreContexts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyStoreContext($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTouchStorages() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTouchStorage($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTouchSearches() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTouchSearch($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdStore(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\Store\Persistence\SpyStore Clone of current object.
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
     * Declares an association between this object and a SpyCurrency object.
     *
     * @param SpyCurrency|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setDefaultCurrency(SpyCurrency $v = null)
    {
        if ($v === null) {
            $this->setFkCurrency(NULL);
        } else {
            $this->setFkCurrency($v->getIdCurrency());
        }

        $this->aDefaultCurrency = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyCurrency object, it will not be re-added.
        if ($v !== null) {
            $v->addStoreDefault($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyCurrency object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyCurrency|null The associated SpyCurrency object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getDefaultCurrency(?ConnectionInterface $con = null)
    {
        if ($this->aDefaultCurrency === null && ($this->fk_currency != 0)) {
            $this->aDefaultCurrency = SpyCurrencyQuery::create()->findPk($this->fk_currency, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aDefaultCurrency->addStoreDefaults($this);
             */
        }

        return $this->aDefaultCurrency;
    }

    /**
     * Declares an association between this object and a SpyLocale object.
     *
     * @param SpyLocale|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setDefaultLocale(SpyLocale $v = null)
    {
        if ($v === null) {
            $this->setFkLocale(NULL);
        } else {
            $this->setFkLocale($v->getIdLocale());
        }

        $this->aDefaultLocale = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyLocale object, it will not be re-added.
        if ($v !== null) {
            $v->addStoreDefault($this);
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
    public function getDefaultLocale(?ConnectionInterface $con = null)
    {
        if ($this->aDefaultLocale === null && ($this->fk_locale != 0)) {
            $this->aDefaultLocale = SpyLocaleQuery::create()->findPk($this->fk_locale, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aDefaultLocale->addStoreDefaults($this);
             */
        }

        return $this->aDefaultLocale;
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
        if ('SpyAssetStore' === $relationName) {
            $this->initSpyAssetStores();
            return;
        }
        if ('AvailabilityAbstract' === $relationName) {
            $this->initAvailabilityAbstracts();
            return;
        }
        if ('Availability' === $relationName) {
            $this->initAvailabilities();
            return;
        }
        if ('SpyAvailabilityNotificationSubscription' === $relationName) {
            $this->initSpyAvailabilityNotificationSubscriptions();
            return;
        }
        if ('SpyCategoryStore' === $relationName) {
            $this->initSpyCategoryStores();
            return;
        }
        if ('SpyCmsPageStore' === $relationName) {
            $this->initSpyCmsPageStores();
            return;
        }
        if ('SpyCmsBlockStore' === $relationName) {
            $this->initSpyCmsBlockStores();
            return;
        }
        if ('SpyCompanyStore' === $relationName) {
            $this->initSpyCompanyStores();
            return;
        }
        if ('CountryStore' === $relationName) {
            $this->initCountryStores();
            return;
        }
        if ('CurrencyStore' === $relationName) {
            $this->initCurrencyStores();
            return;
        }
        if ('Discount' === $relationName) {
            $this->initDiscounts();
            return;
        }
        if ('SpyDiscountStore' === $relationName) {
            $this->initSpyDiscountStores();
            return;
        }
        if ('LocaleStore' === $relationName) {
            $this->initLocaleStores();
            return;
        }
        if ('SpyMerchantStore' === $relationName) {
            $this->initSpyMerchantStores();
            return;
        }
        if ('MerchantCommission' === $relationName) {
            $this->initMerchantCommissions();
            return;
        }
        if ('SpyMerchantRegistrationRequest' === $relationName) {
            $this->initSpyMerchantRegistrationRequests();
            return;
        }
        if ('SpyMerchantRelationshipSalesOrderThreshold' === $relationName) {
            $this->initSpyMerchantRelationshipSalesOrderThresholds();
            return;
        }
        if ('OmsProductReservation' === $relationName) {
            $this->initOmsProductReservations();
            return;
        }
        if ('OmsProductOfferReservation' === $relationName) {
            $this->initOmsProductOfferReservations();
            return;
        }
        if ('SpyPaymentMethodStore' === $relationName) {
            $this->initSpyPaymentMethodStores();
            return;
        }
        if ('PriceProductStore' === $relationName) {
            $this->initPriceProductStores();
            return;
        }
        if ('PriceProductSchedule' === $relationName) {
            $this->initPriceProductSchedules();
            return;
        }
        if ('SpyProductAbstractStore' === $relationName) {
            $this->initSpyProductAbstractStores();
            return;
        }
        if ('ProductLabelStore' === $relationName) {
            $this->initProductLabelStores();
            return;
        }
        if ('SpyProductMeasurementSalesUnitStore' === $relationName) {
            $this->initSpyProductMeasurementSalesUnitStores();
            return;
        }
        if ('SpyProductOfferStore' === $relationName) {
            $this->initSpyProductOfferStores();
            return;
        }
        if ('ProductOptionValuePrice' === $relationName) {
            $this->initProductOptionValuePrices();
            return;
        }
        if ('ProductRelationStore' === $relationName) {
            $this->initProductRelationStores();
            return;
        }
        if ('SpyQuote' === $relationName) {
            $this->initSpyQuotes();
            return;
        }
        if ('SpySalesOrderThreshold' === $relationName) {
            $this->initSpySalesOrderThresholds();
            return;
        }
        if ('ServicePointStore' === $relationName) {
            $this->initServicePointStores();
            return;
        }
        if ('ShipmentMethodPrice' === $relationName) {
            $this->initShipmentMethodPrices();
            return;
        }
        if ('ShipmentMethodStore' === $relationName) {
            $this->initShipmentMethodStores();
            return;
        }
        if ('ShipmentTypeStore' === $relationName) {
            $this->initShipmentTypeStores();
            return;
        }
        if ('StockStore' === $relationName) {
            $this->initStockStores();
            return;
        }
        if ('SpyStoreContext' === $relationName) {
            $this->initSpyStoreContexts();
            return;
        }
        if ('TouchStorage' === $relationName) {
            $this->initTouchStorages();
            return;
        }
        if ('TouchSearch' === $relationName) {
            $this->initTouchSearches();
            return;
        }
    }

    /**
     * Clears out the collSpyAssetStores collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyAssetStores()
     */
    public function clearSpyAssetStores()
    {
        $this->collSpyAssetStores = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyAssetStores collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyAssetStores($v = true): void
    {
        $this->collSpyAssetStoresPartial = $v;
    }

    /**
     * Initializes the collSpyAssetStores collection.
     *
     * By default this just sets the collSpyAssetStores collection to an empty array (like clearcollSpyAssetStores());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyAssetStores(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyAssetStores && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyAssetStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyAssetStores = new $collectionClassName;
        $this->collSpyAssetStores->setModel('\Orm\Zed\Asset\Persistence\SpyAssetStore');
    }

    /**
     * Gets an array of SpyAssetStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyAssetStore[] List of SpyAssetStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyAssetStore> List of SpyAssetStore objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyAssetStores(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyAssetStoresPartial && !$this->isNew();
        if (null === $this->collSpyAssetStores || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyAssetStores) {
                    $this->initSpyAssetStores();
                } else {
                    $collectionClassName = SpyAssetStoreTableMap::getTableMap()->getCollectionClassName();

                    $collSpyAssetStores = new $collectionClassName;
                    $collSpyAssetStores->setModel('\Orm\Zed\Asset\Persistence\SpyAssetStore');

                    return $collSpyAssetStores;
                }
            } else {
                $collSpyAssetStores = SpyAssetStoreQuery::create(null, $criteria)
                    ->filterBySpyStore($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyAssetStoresPartial && count($collSpyAssetStores)) {
                        $this->initSpyAssetStores(false);

                        foreach ($collSpyAssetStores as $obj) {
                            if (false == $this->collSpyAssetStores->contains($obj)) {
                                $this->collSpyAssetStores->append($obj);
                            }
                        }

                        $this->collSpyAssetStoresPartial = true;
                    }

                    return $collSpyAssetStores;
                }

                if ($partial && $this->collSpyAssetStores) {
                    foreach ($this->collSpyAssetStores as $obj) {
                        if ($obj->isNew()) {
                            $collSpyAssetStores[] = $obj;
                        }
                    }
                }

                $this->collSpyAssetStores = $collSpyAssetStores;
                $this->collSpyAssetStoresPartial = false;
            }
        }

        return $this->collSpyAssetStores;
    }

    /**
     * Sets a collection of SpyAssetStore objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyAssetStores A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyAssetStores(Collection $spyAssetStores, ?ConnectionInterface $con = null)
    {
        /** @var SpyAssetStore[] $spyAssetStoresToDelete */
        $spyAssetStoresToDelete = $this->getSpyAssetStores(new Criteria(), $con)->diff($spyAssetStores);


        $this->spyAssetStoresScheduledForDeletion = $spyAssetStoresToDelete;

        foreach ($spyAssetStoresToDelete as $spyAssetStoreRemoved) {
            $spyAssetStoreRemoved->setSpyStore(null);
        }

        $this->collSpyAssetStores = null;
        foreach ($spyAssetStores as $spyAssetStore) {
            $this->addSpyAssetStore($spyAssetStore);
        }

        $this->collSpyAssetStores = $spyAssetStores;
        $this->collSpyAssetStoresPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyAssetStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyAssetStore objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyAssetStores(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyAssetStoresPartial && !$this->isNew();
        if (null === $this->collSpyAssetStores || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyAssetStores) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyAssetStores());
            }

            $query = SpyAssetStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyStore($this)
                ->count($con);
        }

        return count($this->collSpyAssetStores);
    }

    /**
     * Method called to associate a SpyAssetStore object to this object
     * through the SpyAssetStore foreign key attribute.
     *
     * @param SpyAssetStore $l SpyAssetStore
     * @return $this The current object (for fluent API support)
     */
    public function addSpyAssetStore(SpyAssetStore $l)
    {
        if ($this->collSpyAssetStores === null) {
            $this->initSpyAssetStores();
            $this->collSpyAssetStoresPartial = true;
        }

        if (!$this->collSpyAssetStores->contains($l)) {
            $this->doAddSpyAssetStore($l);

            if ($this->spyAssetStoresScheduledForDeletion and $this->spyAssetStoresScheduledForDeletion->contains($l)) {
                $this->spyAssetStoresScheduledForDeletion->remove($this->spyAssetStoresScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyAssetStore $spyAssetStore The SpyAssetStore object to add.
     */
    protected function doAddSpyAssetStore(SpyAssetStore $spyAssetStore): void
    {
        $this->collSpyAssetStores[]= $spyAssetStore;
        $spyAssetStore->setSpyStore($this);
    }

    /**
     * @param SpyAssetStore $spyAssetStore The SpyAssetStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyAssetStore(SpyAssetStore $spyAssetStore)
    {
        if ($this->getSpyAssetStores()->contains($spyAssetStore)) {
            $pos = $this->collSpyAssetStores->search($spyAssetStore);
            $this->collSpyAssetStores->remove($pos);
            if (null === $this->spyAssetStoresScheduledForDeletion) {
                $this->spyAssetStoresScheduledForDeletion = clone $this->collSpyAssetStores;
                $this->spyAssetStoresScheduledForDeletion->clear();
            }
            $this->spyAssetStoresScheduledForDeletion[]= clone $spyAssetStore;
            $spyAssetStore->setSpyStore(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related SpyAssetStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyAssetStore[] List of SpyAssetStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyAssetStore}> List of SpyAssetStore objects
     */
    public function getSpyAssetStoresJoinSpyAsset(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyAssetStoreQuery::create(null, $criteria);
        $query->joinWith('SpyAsset', $joinBehavior);

        return $this->getSpyAssetStores($query, $con);
    }

    /**
     * Clears out the collAvailabilityAbstracts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addAvailabilityAbstracts()
     */
    public function clearAvailabilityAbstracts()
    {
        $this->collAvailabilityAbstracts = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collAvailabilityAbstracts collection loaded partially.
     *
     * @return void
     */
    public function resetPartialAvailabilityAbstracts($v = true): void
    {
        $this->collAvailabilityAbstractsPartial = $v;
    }

    /**
     * Initializes the collAvailabilityAbstracts collection.
     *
     * By default this just sets the collAvailabilityAbstracts collection to an empty array (like clearcollAvailabilityAbstracts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAvailabilityAbstracts(bool $overrideExisting = true): void
    {
        if (null !== $this->collAvailabilityAbstracts && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyAvailabilityAbstractTableMap::getTableMap()->getCollectionClassName();

        $this->collAvailabilityAbstracts = new $collectionClassName;
        $this->collAvailabilityAbstracts->setModel('\Orm\Zed\Availability\Persistence\SpyAvailabilityAbstract');
    }

    /**
     * Gets an array of SpyAvailabilityAbstract objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyAvailabilityAbstract[] List of SpyAvailabilityAbstract objects
     * @phpstan-return ObjectCollection&\Traversable<SpyAvailabilityAbstract> List of SpyAvailabilityAbstract objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getAvailabilityAbstracts(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collAvailabilityAbstractsPartial && !$this->isNew();
        if (null === $this->collAvailabilityAbstracts || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collAvailabilityAbstracts) {
                    $this->initAvailabilityAbstracts();
                } else {
                    $collectionClassName = SpyAvailabilityAbstractTableMap::getTableMap()->getCollectionClassName();

                    $collAvailabilityAbstracts = new $collectionClassName;
                    $collAvailabilityAbstracts->setModel('\Orm\Zed\Availability\Persistence\SpyAvailabilityAbstract');

                    return $collAvailabilityAbstracts;
                }
            } else {
                $collAvailabilityAbstracts = SpyAvailabilityAbstractQuery::create(null, $criteria)
                    ->filterByStore($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collAvailabilityAbstractsPartial && count($collAvailabilityAbstracts)) {
                        $this->initAvailabilityAbstracts(false);

                        foreach ($collAvailabilityAbstracts as $obj) {
                            if (false == $this->collAvailabilityAbstracts->contains($obj)) {
                                $this->collAvailabilityAbstracts->append($obj);
                            }
                        }

                        $this->collAvailabilityAbstractsPartial = true;
                    }

                    return $collAvailabilityAbstracts;
                }

                if ($partial && $this->collAvailabilityAbstracts) {
                    foreach ($this->collAvailabilityAbstracts as $obj) {
                        if ($obj->isNew()) {
                            $collAvailabilityAbstracts[] = $obj;
                        }
                    }
                }

                $this->collAvailabilityAbstracts = $collAvailabilityAbstracts;
                $this->collAvailabilityAbstractsPartial = false;
            }
        }

        return $this->collAvailabilityAbstracts;
    }

    /**
     * Sets a collection of SpyAvailabilityAbstract objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $availabilityAbstracts A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setAvailabilityAbstracts(Collection $availabilityAbstracts, ?ConnectionInterface $con = null)
    {
        /** @var SpyAvailabilityAbstract[] $availabilityAbstractsToDelete */
        $availabilityAbstractsToDelete = $this->getAvailabilityAbstracts(new Criteria(), $con)->diff($availabilityAbstracts);


        $this->availabilityAbstractsScheduledForDeletion = $availabilityAbstractsToDelete;

        foreach ($availabilityAbstractsToDelete as $availabilityAbstractRemoved) {
            $availabilityAbstractRemoved->setStore(null);
        }

        $this->collAvailabilityAbstracts = null;
        foreach ($availabilityAbstracts as $availabilityAbstract) {
            $this->addAvailabilityAbstract($availabilityAbstract);
        }

        $this->collAvailabilityAbstracts = $availabilityAbstracts;
        $this->collAvailabilityAbstractsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyAvailabilityAbstract objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyAvailabilityAbstract objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countAvailabilityAbstracts(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collAvailabilityAbstractsPartial && !$this->isNew();
        if (null === $this->collAvailabilityAbstracts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAvailabilityAbstracts) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAvailabilityAbstracts());
            }

            $query = SpyAvailabilityAbstractQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStore($this)
                ->count($con);
        }

        return count($this->collAvailabilityAbstracts);
    }

    /**
     * Method called to associate a SpyAvailabilityAbstract object to this object
     * through the SpyAvailabilityAbstract foreign key attribute.
     *
     * @param SpyAvailabilityAbstract $l SpyAvailabilityAbstract
     * @return $this The current object (for fluent API support)
     */
    public function addAvailabilityAbstract(SpyAvailabilityAbstract $l)
    {
        if ($this->collAvailabilityAbstracts === null) {
            $this->initAvailabilityAbstracts();
            $this->collAvailabilityAbstractsPartial = true;
        }

        if (!$this->collAvailabilityAbstracts->contains($l)) {
            $this->doAddAvailabilityAbstract($l);

            if ($this->availabilityAbstractsScheduledForDeletion and $this->availabilityAbstractsScheduledForDeletion->contains($l)) {
                $this->availabilityAbstractsScheduledForDeletion->remove($this->availabilityAbstractsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyAvailabilityAbstract $availabilityAbstract The SpyAvailabilityAbstract object to add.
     */
    protected function doAddAvailabilityAbstract(SpyAvailabilityAbstract $availabilityAbstract): void
    {
        $this->collAvailabilityAbstracts[]= $availabilityAbstract;
        $availabilityAbstract->setStore($this);
    }

    /**
     * @param SpyAvailabilityAbstract $availabilityAbstract The SpyAvailabilityAbstract object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeAvailabilityAbstract(SpyAvailabilityAbstract $availabilityAbstract)
    {
        if ($this->getAvailabilityAbstracts()->contains($availabilityAbstract)) {
            $pos = $this->collAvailabilityAbstracts->search($availabilityAbstract);
            $this->collAvailabilityAbstracts->remove($pos);
            if (null === $this->availabilityAbstractsScheduledForDeletion) {
                $this->availabilityAbstractsScheduledForDeletion = clone $this->collAvailabilityAbstracts;
                $this->availabilityAbstractsScheduledForDeletion->clear();
            }
            $this->availabilityAbstractsScheduledForDeletion[]= $availabilityAbstract;
            $availabilityAbstract->setStore(null);
        }

        return $this;
    }

    /**
     * Clears out the collAvailabilities collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addAvailabilities()
     */
    public function clearAvailabilities()
    {
        $this->collAvailabilities = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collAvailabilities collection loaded partially.
     *
     * @return void
     */
    public function resetPartialAvailabilities($v = true): void
    {
        $this->collAvailabilitiesPartial = $v;
    }

    /**
     * Initializes the collAvailabilities collection.
     *
     * By default this just sets the collAvailabilities collection to an empty array (like clearcollAvailabilities());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAvailabilities(bool $overrideExisting = true): void
    {
        if (null !== $this->collAvailabilities && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyAvailabilityTableMap::getTableMap()->getCollectionClassName();

        $this->collAvailabilities = new $collectionClassName;
        $this->collAvailabilities->setModel('\Orm\Zed\Availability\Persistence\SpyAvailability');
    }

    /**
     * Gets an array of SpyAvailability objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyAvailability[] List of SpyAvailability objects
     * @phpstan-return ObjectCollection&\Traversable<SpyAvailability> List of SpyAvailability objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getAvailabilities(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collAvailabilitiesPartial && !$this->isNew();
        if (null === $this->collAvailabilities || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collAvailabilities) {
                    $this->initAvailabilities();
                } else {
                    $collectionClassName = SpyAvailabilityTableMap::getTableMap()->getCollectionClassName();

                    $collAvailabilities = new $collectionClassName;
                    $collAvailabilities->setModel('\Orm\Zed\Availability\Persistence\SpyAvailability');

                    return $collAvailabilities;
                }
            } else {
                $collAvailabilities = SpyAvailabilityQuery::create(null, $criteria)
                    ->filterByStore($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collAvailabilitiesPartial && count($collAvailabilities)) {
                        $this->initAvailabilities(false);

                        foreach ($collAvailabilities as $obj) {
                            if (false == $this->collAvailabilities->contains($obj)) {
                                $this->collAvailabilities->append($obj);
                            }
                        }

                        $this->collAvailabilitiesPartial = true;
                    }

                    return $collAvailabilities;
                }

                if ($partial && $this->collAvailabilities) {
                    foreach ($this->collAvailabilities as $obj) {
                        if ($obj->isNew()) {
                            $collAvailabilities[] = $obj;
                        }
                    }
                }

                $this->collAvailabilities = $collAvailabilities;
                $this->collAvailabilitiesPartial = false;
            }
        }

        return $this->collAvailabilities;
    }

    /**
     * Sets a collection of SpyAvailability objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $availabilities A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setAvailabilities(Collection $availabilities, ?ConnectionInterface $con = null)
    {
        /** @var SpyAvailability[] $availabilitiesToDelete */
        $availabilitiesToDelete = $this->getAvailabilities(new Criteria(), $con)->diff($availabilities);


        $this->availabilitiesScheduledForDeletion = $availabilitiesToDelete;

        foreach ($availabilitiesToDelete as $availabilityRemoved) {
            $availabilityRemoved->setStore(null);
        }

        $this->collAvailabilities = null;
        foreach ($availabilities as $availability) {
            $this->addAvailability($availability);
        }

        $this->collAvailabilities = $availabilities;
        $this->collAvailabilitiesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyAvailability objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyAvailability objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countAvailabilities(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collAvailabilitiesPartial && !$this->isNew();
        if (null === $this->collAvailabilities || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAvailabilities) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAvailabilities());
            }

            $query = SpyAvailabilityQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStore($this)
                ->count($con);
        }

        return count($this->collAvailabilities);
    }

    /**
     * Method called to associate a SpyAvailability object to this object
     * through the SpyAvailability foreign key attribute.
     *
     * @param SpyAvailability $l SpyAvailability
     * @return $this The current object (for fluent API support)
     */
    public function addAvailability(SpyAvailability $l)
    {
        if ($this->collAvailabilities === null) {
            $this->initAvailabilities();
            $this->collAvailabilitiesPartial = true;
        }

        if (!$this->collAvailabilities->contains($l)) {
            $this->doAddAvailability($l);

            if ($this->availabilitiesScheduledForDeletion and $this->availabilitiesScheduledForDeletion->contains($l)) {
                $this->availabilitiesScheduledForDeletion->remove($this->availabilitiesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyAvailability $availability The SpyAvailability object to add.
     */
    protected function doAddAvailability(SpyAvailability $availability): void
    {
        $this->collAvailabilities[]= $availability;
        $availability->setStore($this);
    }

    /**
     * @param SpyAvailability $availability The SpyAvailability object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeAvailability(SpyAvailability $availability)
    {
        if ($this->getAvailabilities()->contains($availability)) {
            $pos = $this->collAvailabilities->search($availability);
            $this->collAvailabilities->remove($pos);
            if (null === $this->availabilitiesScheduledForDeletion) {
                $this->availabilitiesScheduledForDeletion = clone $this->collAvailabilities;
                $this->availabilitiesScheduledForDeletion->clear();
            }
            $this->availabilitiesScheduledForDeletion[]= $availability;
            $availability->setStore(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related Availabilities from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyAvailability[] List of SpyAvailability objects
     * @phpstan-return ObjectCollection&\Traversable<SpyAvailability}> List of SpyAvailability objects
     */
    public function getAvailabilitiesJoinSpyAvailabilityAbstract(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyAvailabilityQuery::create(null, $criteria);
        $query->joinWith('SpyAvailabilityAbstract', $joinBehavior);

        return $this->getAvailabilities($query, $con);
    }

    /**
     * Clears out the collSpyAvailabilityNotificationSubscriptions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyAvailabilityNotificationSubscriptions()
     */
    public function clearSpyAvailabilityNotificationSubscriptions()
    {
        $this->collSpyAvailabilityNotificationSubscriptions = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyAvailabilityNotificationSubscriptions collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyAvailabilityNotificationSubscriptions($v = true): void
    {
        $this->collSpyAvailabilityNotificationSubscriptionsPartial = $v;
    }

    /**
     * Initializes the collSpyAvailabilityNotificationSubscriptions collection.
     *
     * By default this just sets the collSpyAvailabilityNotificationSubscriptions collection to an empty array (like clearcollSpyAvailabilityNotificationSubscriptions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyAvailabilityNotificationSubscriptions(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyAvailabilityNotificationSubscriptions && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyAvailabilityNotificationSubscriptionTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyAvailabilityNotificationSubscriptions = new $collectionClassName;
        $this->collSpyAvailabilityNotificationSubscriptions->setModel('\Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscription');
    }

    /**
     * Gets an array of SpyAvailabilityNotificationSubscription objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyAvailabilityNotificationSubscription[] List of SpyAvailabilityNotificationSubscription objects
     * @phpstan-return ObjectCollection&\Traversable<SpyAvailabilityNotificationSubscription> List of SpyAvailabilityNotificationSubscription objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyAvailabilityNotificationSubscriptions(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyAvailabilityNotificationSubscriptionsPartial && !$this->isNew();
        if (null === $this->collSpyAvailabilityNotificationSubscriptions || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyAvailabilityNotificationSubscriptions) {
                    $this->initSpyAvailabilityNotificationSubscriptions();
                } else {
                    $collectionClassName = SpyAvailabilityNotificationSubscriptionTableMap::getTableMap()->getCollectionClassName();

                    $collSpyAvailabilityNotificationSubscriptions = new $collectionClassName;
                    $collSpyAvailabilityNotificationSubscriptions->setModel('\Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscription');

                    return $collSpyAvailabilityNotificationSubscriptions;
                }
            } else {
                $collSpyAvailabilityNotificationSubscriptions = SpyAvailabilityNotificationSubscriptionQuery::create(null, $criteria)
                    ->filterBySpyStore($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyAvailabilityNotificationSubscriptionsPartial && count($collSpyAvailabilityNotificationSubscriptions)) {
                        $this->initSpyAvailabilityNotificationSubscriptions(false);

                        foreach ($collSpyAvailabilityNotificationSubscriptions as $obj) {
                            if (false == $this->collSpyAvailabilityNotificationSubscriptions->contains($obj)) {
                                $this->collSpyAvailabilityNotificationSubscriptions->append($obj);
                            }
                        }

                        $this->collSpyAvailabilityNotificationSubscriptionsPartial = true;
                    }

                    return $collSpyAvailabilityNotificationSubscriptions;
                }

                if ($partial && $this->collSpyAvailabilityNotificationSubscriptions) {
                    foreach ($this->collSpyAvailabilityNotificationSubscriptions as $obj) {
                        if ($obj->isNew()) {
                            $collSpyAvailabilityNotificationSubscriptions[] = $obj;
                        }
                    }
                }

                $this->collSpyAvailabilityNotificationSubscriptions = $collSpyAvailabilityNotificationSubscriptions;
                $this->collSpyAvailabilityNotificationSubscriptionsPartial = false;
            }
        }

        return $this->collSpyAvailabilityNotificationSubscriptions;
    }

    /**
     * Sets a collection of SpyAvailabilityNotificationSubscription objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyAvailabilityNotificationSubscriptions A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyAvailabilityNotificationSubscriptions(Collection $spyAvailabilityNotificationSubscriptions, ?ConnectionInterface $con = null)
    {
        /** @var SpyAvailabilityNotificationSubscription[] $spyAvailabilityNotificationSubscriptionsToDelete */
        $spyAvailabilityNotificationSubscriptionsToDelete = $this->getSpyAvailabilityNotificationSubscriptions(new Criteria(), $con)->diff($spyAvailabilityNotificationSubscriptions);


        $this->spyAvailabilityNotificationSubscriptionsScheduledForDeletion = $spyAvailabilityNotificationSubscriptionsToDelete;

        foreach ($spyAvailabilityNotificationSubscriptionsToDelete as $spyAvailabilityNotificationSubscriptionRemoved) {
            $spyAvailabilityNotificationSubscriptionRemoved->setSpyStore(null);
        }

        $this->collSpyAvailabilityNotificationSubscriptions = null;
        foreach ($spyAvailabilityNotificationSubscriptions as $spyAvailabilityNotificationSubscription) {
            $this->addSpyAvailabilityNotificationSubscription($spyAvailabilityNotificationSubscription);
        }

        $this->collSpyAvailabilityNotificationSubscriptions = $spyAvailabilityNotificationSubscriptions;
        $this->collSpyAvailabilityNotificationSubscriptionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyAvailabilityNotificationSubscription objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyAvailabilityNotificationSubscription objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyAvailabilityNotificationSubscriptions(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyAvailabilityNotificationSubscriptionsPartial && !$this->isNew();
        if (null === $this->collSpyAvailabilityNotificationSubscriptions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyAvailabilityNotificationSubscriptions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyAvailabilityNotificationSubscriptions());
            }

            $query = SpyAvailabilityNotificationSubscriptionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyStore($this)
                ->count($con);
        }

        return count($this->collSpyAvailabilityNotificationSubscriptions);
    }

    /**
     * Method called to associate a SpyAvailabilityNotificationSubscription object to this object
     * through the SpyAvailabilityNotificationSubscription foreign key attribute.
     *
     * @param SpyAvailabilityNotificationSubscription $l SpyAvailabilityNotificationSubscription
     * @return $this The current object (for fluent API support)
     */
    public function addSpyAvailabilityNotificationSubscription(SpyAvailabilityNotificationSubscription $l)
    {
        if ($this->collSpyAvailabilityNotificationSubscriptions === null) {
            $this->initSpyAvailabilityNotificationSubscriptions();
            $this->collSpyAvailabilityNotificationSubscriptionsPartial = true;
        }

        if (!$this->collSpyAvailabilityNotificationSubscriptions->contains($l)) {
            $this->doAddSpyAvailabilityNotificationSubscription($l);

            if ($this->spyAvailabilityNotificationSubscriptionsScheduledForDeletion and $this->spyAvailabilityNotificationSubscriptionsScheduledForDeletion->contains($l)) {
                $this->spyAvailabilityNotificationSubscriptionsScheduledForDeletion->remove($this->spyAvailabilityNotificationSubscriptionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyAvailabilityNotificationSubscription $spyAvailabilityNotificationSubscription The SpyAvailabilityNotificationSubscription object to add.
     */
    protected function doAddSpyAvailabilityNotificationSubscription(SpyAvailabilityNotificationSubscription $spyAvailabilityNotificationSubscription): void
    {
        $this->collSpyAvailabilityNotificationSubscriptions[]= $spyAvailabilityNotificationSubscription;
        $spyAvailabilityNotificationSubscription->setSpyStore($this);
    }

    /**
     * @param SpyAvailabilityNotificationSubscription $spyAvailabilityNotificationSubscription The SpyAvailabilityNotificationSubscription object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyAvailabilityNotificationSubscription(SpyAvailabilityNotificationSubscription $spyAvailabilityNotificationSubscription)
    {
        if ($this->getSpyAvailabilityNotificationSubscriptions()->contains($spyAvailabilityNotificationSubscription)) {
            $pos = $this->collSpyAvailabilityNotificationSubscriptions->search($spyAvailabilityNotificationSubscription);
            $this->collSpyAvailabilityNotificationSubscriptions->remove($pos);
            if (null === $this->spyAvailabilityNotificationSubscriptionsScheduledForDeletion) {
                $this->spyAvailabilityNotificationSubscriptionsScheduledForDeletion = clone $this->collSpyAvailabilityNotificationSubscriptions;
                $this->spyAvailabilityNotificationSubscriptionsScheduledForDeletion->clear();
            }
            $this->spyAvailabilityNotificationSubscriptionsScheduledForDeletion[]= clone $spyAvailabilityNotificationSubscription;
            $spyAvailabilityNotificationSubscription->setSpyStore(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related SpyAvailabilityNotificationSubscriptions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyAvailabilityNotificationSubscription[] List of SpyAvailabilityNotificationSubscription objects
     * @phpstan-return ObjectCollection&\Traversable<SpyAvailabilityNotificationSubscription}> List of SpyAvailabilityNotificationSubscription objects
     */
    public function getSpyAvailabilityNotificationSubscriptionsJoinSpyLocale(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyAvailabilityNotificationSubscriptionQuery::create(null, $criteria);
        $query->joinWith('SpyLocale', $joinBehavior);

        return $this->getSpyAvailabilityNotificationSubscriptions($query, $con);
    }

    /**
     * Clears out the collSpyCategoryStores collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCategoryStores()
     */
    public function clearSpyCategoryStores()
    {
        $this->collSpyCategoryStores = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCategoryStores collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCategoryStores($v = true): void
    {
        $this->collSpyCategoryStoresPartial = $v;
    }

    /**
     * Initializes the collSpyCategoryStores collection.
     *
     * By default this just sets the collSpyCategoryStores collection to an empty array (like clearcollSpyCategoryStores());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCategoryStores(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCategoryStores && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCategoryStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCategoryStores = new $collectionClassName;
        $this->collSpyCategoryStores->setModel('\Orm\Zed\Category\Persistence\SpyCategoryStore');
    }

    /**
     * Gets an array of SpyCategoryStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCategoryStore[] List of SpyCategoryStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCategoryStore> List of SpyCategoryStore objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCategoryStores(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCategoryStoresPartial && !$this->isNew();
        if (null === $this->collSpyCategoryStores || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCategoryStores) {
                    $this->initSpyCategoryStores();
                } else {
                    $collectionClassName = SpyCategoryStoreTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCategoryStores = new $collectionClassName;
                    $collSpyCategoryStores->setModel('\Orm\Zed\Category\Persistence\SpyCategoryStore');

                    return $collSpyCategoryStores;
                }
            } else {
                $collSpyCategoryStores = SpyCategoryStoreQuery::create(null, $criteria)
                    ->filterBySpyStore($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCategoryStoresPartial && count($collSpyCategoryStores)) {
                        $this->initSpyCategoryStores(false);

                        foreach ($collSpyCategoryStores as $obj) {
                            if (false == $this->collSpyCategoryStores->contains($obj)) {
                                $this->collSpyCategoryStores->append($obj);
                            }
                        }

                        $this->collSpyCategoryStoresPartial = true;
                    }

                    return $collSpyCategoryStores;
                }

                if ($partial && $this->collSpyCategoryStores) {
                    foreach ($this->collSpyCategoryStores as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCategoryStores[] = $obj;
                        }
                    }
                }

                $this->collSpyCategoryStores = $collSpyCategoryStores;
                $this->collSpyCategoryStoresPartial = false;
            }
        }

        return $this->collSpyCategoryStores;
    }

    /**
     * Sets a collection of SpyCategoryStore objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCategoryStores A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCategoryStores(Collection $spyCategoryStores, ?ConnectionInterface $con = null)
    {
        /** @var SpyCategoryStore[] $spyCategoryStoresToDelete */
        $spyCategoryStoresToDelete = $this->getSpyCategoryStores(new Criteria(), $con)->diff($spyCategoryStores);


        $this->spyCategoryStoresScheduledForDeletion = $spyCategoryStoresToDelete;

        foreach ($spyCategoryStoresToDelete as $spyCategoryStoreRemoved) {
            $spyCategoryStoreRemoved->setSpyStore(null);
        }

        $this->collSpyCategoryStores = null;
        foreach ($spyCategoryStores as $spyCategoryStore) {
            $this->addSpyCategoryStore($spyCategoryStore);
        }

        $this->collSpyCategoryStores = $spyCategoryStores;
        $this->collSpyCategoryStoresPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCategoryStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCategoryStore objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCategoryStores(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCategoryStoresPartial && !$this->isNew();
        if (null === $this->collSpyCategoryStores || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCategoryStores) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCategoryStores());
            }

            $query = SpyCategoryStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyStore($this)
                ->count($con);
        }

        return count($this->collSpyCategoryStores);
    }

    /**
     * Method called to associate a SpyCategoryStore object to this object
     * through the SpyCategoryStore foreign key attribute.
     *
     * @param SpyCategoryStore $l SpyCategoryStore
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCategoryStore(SpyCategoryStore $l)
    {
        if ($this->collSpyCategoryStores === null) {
            $this->initSpyCategoryStores();
            $this->collSpyCategoryStoresPartial = true;
        }

        if (!$this->collSpyCategoryStores->contains($l)) {
            $this->doAddSpyCategoryStore($l);

            if ($this->spyCategoryStoresScheduledForDeletion and $this->spyCategoryStoresScheduledForDeletion->contains($l)) {
                $this->spyCategoryStoresScheduledForDeletion->remove($this->spyCategoryStoresScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCategoryStore $spyCategoryStore The SpyCategoryStore object to add.
     */
    protected function doAddSpyCategoryStore(SpyCategoryStore $spyCategoryStore): void
    {
        $this->collSpyCategoryStores[]= $spyCategoryStore;
        $spyCategoryStore->setSpyStore($this);
    }

    /**
     * @param SpyCategoryStore $spyCategoryStore The SpyCategoryStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCategoryStore(SpyCategoryStore $spyCategoryStore)
    {
        if ($this->getSpyCategoryStores()->contains($spyCategoryStore)) {
            $pos = $this->collSpyCategoryStores->search($spyCategoryStore);
            $this->collSpyCategoryStores->remove($pos);
            if (null === $this->spyCategoryStoresScheduledForDeletion) {
                $this->spyCategoryStoresScheduledForDeletion = clone $this->collSpyCategoryStores;
                $this->spyCategoryStoresScheduledForDeletion->clear();
            }
            $this->spyCategoryStoresScheduledForDeletion[]= clone $spyCategoryStore;
            $spyCategoryStore->setSpyStore(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related SpyCategoryStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCategoryStore[] List of SpyCategoryStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCategoryStore}> List of SpyCategoryStore objects
     */
    public function getSpyCategoryStoresJoinSpyCategory(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCategoryStoreQuery::create(null, $criteria);
        $query->joinWith('SpyCategory', $joinBehavior);

        return $this->getSpyCategoryStores($query, $con);
    }

    /**
     * Clears out the collSpyCmsPageStores collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCmsPageStores()
     */
    public function clearSpyCmsPageStores()
    {
        $this->collSpyCmsPageStores = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCmsPageStores collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCmsPageStores($v = true): void
    {
        $this->collSpyCmsPageStoresPartial = $v;
    }

    /**
     * Initializes the collSpyCmsPageStores collection.
     *
     * By default this just sets the collSpyCmsPageStores collection to an empty array (like clearcollSpyCmsPageStores());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCmsPageStores(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCmsPageStores && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCmsPageStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCmsPageStores = new $collectionClassName;
        $this->collSpyCmsPageStores->setModel('\Orm\Zed\Cms\Persistence\SpyCmsPageStore');
    }

    /**
     * Gets an array of SpyCmsPageStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCmsPageStore[] List of SpyCmsPageStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCmsPageStore> List of SpyCmsPageStore objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCmsPageStores(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCmsPageStoresPartial && !$this->isNew();
        if (null === $this->collSpyCmsPageStores || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCmsPageStores) {
                    $this->initSpyCmsPageStores();
                } else {
                    $collectionClassName = SpyCmsPageStoreTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCmsPageStores = new $collectionClassName;
                    $collSpyCmsPageStores->setModel('\Orm\Zed\Cms\Persistence\SpyCmsPageStore');

                    return $collSpyCmsPageStores;
                }
            } else {
                $collSpyCmsPageStores = SpyCmsPageStoreQuery::create(null, $criteria)
                    ->filterBySpyStore($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCmsPageStoresPartial && count($collSpyCmsPageStores)) {
                        $this->initSpyCmsPageStores(false);

                        foreach ($collSpyCmsPageStores as $obj) {
                            if (false == $this->collSpyCmsPageStores->contains($obj)) {
                                $this->collSpyCmsPageStores->append($obj);
                            }
                        }

                        $this->collSpyCmsPageStoresPartial = true;
                    }

                    return $collSpyCmsPageStores;
                }

                if ($partial && $this->collSpyCmsPageStores) {
                    foreach ($this->collSpyCmsPageStores as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCmsPageStores[] = $obj;
                        }
                    }
                }

                $this->collSpyCmsPageStores = $collSpyCmsPageStores;
                $this->collSpyCmsPageStoresPartial = false;
            }
        }

        return $this->collSpyCmsPageStores;
    }

    /**
     * Sets a collection of SpyCmsPageStore objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCmsPageStores A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCmsPageStores(Collection $spyCmsPageStores, ?ConnectionInterface $con = null)
    {
        /** @var SpyCmsPageStore[] $spyCmsPageStoresToDelete */
        $spyCmsPageStoresToDelete = $this->getSpyCmsPageStores(new Criteria(), $con)->diff($spyCmsPageStores);


        $this->spyCmsPageStoresScheduledForDeletion = $spyCmsPageStoresToDelete;

        foreach ($spyCmsPageStoresToDelete as $spyCmsPageStoreRemoved) {
            $spyCmsPageStoreRemoved->setSpyStore(null);
        }

        $this->collSpyCmsPageStores = null;
        foreach ($spyCmsPageStores as $spyCmsPageStore) {
            $this->addSpyCmsPageStore($spyCmsPageStore);
        }

        $this->collSpyCmsPageStores = $spyCmsPageStores;
        $this->collSpyCmsPageStoresPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCmsPageStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCmsPageStore objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCmsPageStores(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCmsPageStoresPartial && !$this->isNew();
        if (null === $this->collSpyCmsPageStores || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCmsPageStores) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCmsPageStores());
            }

            $query = SpyCmsPageStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyStore($this)
                ->count($con);
        }

        return count($this->collSpyCmsPageStores);
    }

    /**
     * Method called to associate a SpyCmsPageStore object to this object
     * through the SpyCmsPageStore foreign key attribute.
     *
     * @param SpyCmsPageStore $l SpyCmsPageStore
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCmsPageStore(SpyCmsPageStore $l)
    {
        if ($this->collSpyCmsPageStores === null) {
            $this->initSpyCmsPageStores();
            $this->collSpyCmsPageStoresPartial = true;
        }

        if (!$this->collSpyCmsPageStores->contains($l)) {
            $this->doAddSpyCmsPageStore($l);

            if ($this->spyCmsPageStoresScheduledForDeletion and $this->spyCmsPageStoresScheduledForDeletion->contains($l)) {
                $this->spyCmsPageStoresScheduledForDeletion->remove($this->spyCmsPageStoresScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCmsPageStore $spyCmsPageStore The SpyCmsPageStore object to add.
     */
    protected function doAddSpyCmsPageStore(SpyCmsPageStore $spyCmsPageStore): void
    {
        $this->collSpyCmsPageStores[]= $spyCmsPageStore;
        $spyCmsPageStore->setSpyStore($this);
    }

    /**
     * @param SpyCmsPageStore $spyCmsPageStore The SpyCmsPageStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCmsPageStore(SpyCmsPageStore $spyCmsPageStore)
    {
        if ($this->getSpyCmsPageStores()->contains($spyCmsPageStore)) {
            $pos = $this->collSpyCmsPageStores->search($spyCmsPageStore);
            $this->collSpyCmsPageStores->remove($pos);
            if (null === $this->spyCmsPageStoresScheduledForDeletion) {
                $this->spyCmsPageStoresScheduledForDeletion = clone $this->collSpyCmsPageStores;
                $this->spyCmsPageStoresScheduledForDeletion->clear();
            }
            $this->spyCmsPageStoresScheduledForDeletion[]= clone $spyCmsPageStore;
            $spyCmsPageStore->setSpyStore(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related SpyCmsPageStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCmsPageStore[] List of SpyCmsPageStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCmsPageStore}> List of SpyCmsPageStore objects
     */
    public function getSpyCmsPageStoresJoinSpyCmsPage(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCmsPageStoreQuery::create(null, $criteria);
        $query->joinWith('SpyCmsPage', $joinBehavior);

        return $this->getSpyCmsPageStores($query, $con);
    }

    /**
     * Clears out the collSpyCmsBlockStores collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCmsBlockStores()
     */
    public function clearSpyCmsBlockStores()
    {
        $this->collSpyCmsBlockStores = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCmsBlockStores collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCmsBlockStores($v = true): void
    {
        $this->collSpyCmsBlockStoresPartial = $v;
    }

    /**
     * Initializes the collSpyCmsBlockStores collection.
     *
     * By default this just sets the collSpyCmsBlockStores collection to an empty array (like clearcollSpyCmsBlockStores());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCmsBlockStores(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCmsBlockStores && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCmsBlockStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCmsBlockStores = new $collectionClassName;
        $this->collSpyCmsBlockStores->setModel('\Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStore');
    }

    /**
     * Gets an array of SpyCmsBlockStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCmsBlockStore[] List of SpyCmsBlockStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCmsBlockStore> List of SpyCmsBlockStore objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCmsBlockStores(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCmsBlockStoresPartial && !$this->isNew();
        if (null === $this->collSpyCmsBlockStores || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCmsBlockStores) {
                    $this->initSpyCmsBlockStores();
                } else {
                    $collectionClassName = SpyCmsBlockStoreTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCmsBlockStores = new $collectionClassName;
                    $collSpyCmsBlockStores->setModel('\Orm\Zed\CmsBlock\Persistence\SpyCmsBlockStore');

                    return $collSpyCmsBlockStores;
                }
            } else {
                $collSpyCmsBlockStores = SpyCmsBlockStoreQuery::create(null, $criteria)
                    ->filterBySpyStore($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCmsBlockStoresPartial && count($collSpyCmsBlockStores)) {
                        $this->initSpyCmsBlockStores(false);

                        foreach ($collSpyCmsBlockStores as $obj) {
                            if (false == $this->collSpyCmsBlockStores->contains($obj)) {
                                $this->collSpyCmsBlockStores->append($obj);
                            }
                        }

                        $this->collSpyCmsBlockStoresPartial = true;
                    }

                    return $collSpyCmsBlockStores;
                }

                if ($partial && $this->collSpyCmsBlockStores) {
                    foreach ($this->collSpyCmsBlockStores as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCmsBlockStores[] = $obj;
                        }
                    }
                }

                $this->collSpyCmsBlockStores = $collSpyCmsBlockStores;
                $this->collSpyCmsBlockStoresPartial = false;
            }
        }

        return $this->collSpyCmsBlockStores;
    }

    /**
     * Sets a collection of SpyCmsBlockStore objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCmsBlockStores A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCmsBlockStores(Collection $spyCmsBlockStores, ?ConnectionInterface $con = null)
    {
        /** @var SpyCmsBlockStore[] $spyCmsBlockStoresToDelete */
        $spyCmsBlockStoresToDelete = $this->getSpyCmsBlockStores(new Criteria(), $con)->diff($spyCmsBlockStores);


        $this->spyCmsBlockStoresScheduledForDeletion = $spyCmsBlockStoresToDelete;

        foreach ($spyCmsBlockStoresToDelete as $spyCmsBlockStoreRemoved) {
            $spyCmsBlockStoreRemoved->setSpyStore(null);
        }

        $this->collSpyCmsBlockStores = null;
        foreach ($spyCmsBlockStores as $spyCmsBlockStore) {
            $this->addSpyCmsBlockStore($spyCmsBlockStore);
        }

        $this->collSpyCmsBlockStores = $spyCmsBlockStores;
        $this->collSpyCmsBlockStoresPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCmsBlockStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCmsBlockStore objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCmsBlockStores(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCmsBlockStoresPartial && !$this->isNew();
        if (null === $this->collSpyCmsBlockStores || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCmsBlockStores) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCmsBlockStores());
            }

            $query = SpyCmsBlockStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyStore($this)
                ->count($con);
        }

        return count($this->collSpyCmsBlockStores);
    }

    /**
     * Method called to associate a SpyCmsBlockStore object to this object
     * through the SpyCmsBlockStore foreign key attribute.
     *
     * @param SpyCmsBlockStore $l SpyCmsBlockStore
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCmsBlockStore(SpyCmsBlockStore $l)
    {
        if ($this->collSpyCmsBlockStores === null) {
            $this->initSpyCmsBlockStores();
            $this->collSpyCmsBlockStoresPartial = true;
        }

        if (!$this->collSpyCmsBlockStores->contains($l)) {
            $this->doAddSpyCmsBlockStore($l);

            if ($this->spyCmsBlockStoresScheduledForDeletion and $this->spyCmsBlockStoresScheduledForDeletion->contains($l)) {
                $this->spyCmsBlockStoresScheduledForDeletion->remove($this->spyCmsBlockStoresScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCmsBlockStore $spyCmsBlockStore The SpyCmsBlockStore object to add.
     */
    protected function doAddSpyCmsBlockStore(SpyCmsBlockStore $spyCmsBlockStore): void
    {
        $this->collSpyCmsBlockStores[]= $spyCmsBlockStore;
        $spyCmsBlockStore->setSpyStore($this);
    }

    /**
     * @param SpyCmsBlockStore $spyCmsBlockStore The SpyCmsBlockStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCmsBlockStore(SpyCmsBlockStore $spyCmsBlockStore)
    {
        if ($this->getSpyCmsBlockStores()->contains($spyCmsBlockStore)) {
            $pos = $this->collSpyCmsBlockStores->search($spyCmsBlockStore);
            $this->collSpyCmsBlockStores->remove($pos);
            if (null === $this->spyCmsBlockStoresScheduledForDeletion) {
                $this->spyCmsBlockStoresScheduledForDeletion = clone $this->collSpyCmsBlockStores;
                $this->spyCmsBlockStoresScheduledForDeletion->clear();
            }
            $this->spyCmsBlockStoresScheduledForDeletion[]= clone $spyCmsBlockStore;
            $spyCmsBlockStore->setSpyStore(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related SpyCmsBlockStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCmsBlockStore[] List of SpyCmsBlockStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCmsBlockStore}> List of SpyCmsBlockStore objects
     */
    public function getSpyCmsBlockStoresJoinSpyCmsBlock(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCmsBlockStoreQuery::create(null, $criteria);
        $query->joinWith('SpyCmsBlock', $joinBehavior);

        return $this->getSpyCmsBlockStores($query, $con);
    }

    /**
     * Clears out the collSpyCompanyStores collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCompanyStores()
     */
    public function clearSpyCompanyStores()
    {
        $this->collSpyCompanyStores = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCompanyStores collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCompanyStores($v = true): void
    {
        $this->collSpyCompanyStoresPartial = $v;
    }

    /**
     * Initializes the collSpyCompanyStores collection.
     *
     * By default this just sets the collSpyCompanyStores collection to an empty array (like clearcollSpyCompanyStores());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCompanyStores(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCompanyStores && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCompanyStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCompanyStores = new $collectionClassName;
        $this->collSpyCompanyStores->setModel('\Orm\Zed\Company\Persistence\SpyCompanyStore');
    }

    /**
     * Gets an array of SpyCompanyStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCompanyStore[] List of SpyCompanyStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyStore> List of SpyCompanyStore objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCompanyStores(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCompanyStoresPartial && !$this->isNew();
        if (null === $this->collSpyCompanyStores || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCompanyStores) {
                    $this->initSpyCompanyStores();
                } else {
                    $collectionClassName = SpyCompanyStoreTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCompanyStores = new $collectionClassName;
                    $collSpyCompanyStores->setModel('\Orm\Zed\Company\Persistence\SpyCompanyStore');

                    return $collSpyCompanyStores;
                }
            } else {
                $collSpyCompanyStores = SpyCompanyStoreQuery::create(null, $criteria)
                    ->filterByStore($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCompanyStoresPartial && count($collSpyCompanyStores)) {
                        $this->initSpyCompanyStores(false);

                        foreach ($collSpyCompanyStores as $obj) {
                            if (false == $this->collSpyCompanyStores->contains($obj)) {
                                $this->collSpyCompanyStores->append($obj);
                            }
                        }

                        $this->collSpyCompanyStoresPartial = true;
                    }

                    return $collSpyCompanyStores;
                }

                if ($partial && $this->collSpyCompanyStores) {
                    foreach ($this->collSpyCompanyStores as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCompanyStores[] = $obj;
                        }
                    }
                }

                $this->collSpyCompanyStores = $collSpyCompanyStores;
                $this->collSpyCompanyStoresPartial = false;
            }
        }

        return $this->collSpyCompanyStores;
    }

    /**
     * Sets a collection of SpyCompanyStore objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCompanyStores A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCompanyStores(Collection $spyCompanyStores, ?ConnectionInterface $con = null)
    {
        /** @var SpyCompanyStore[] $spyCompanyStoresToDelete */
        $spyCompanyStoresToDelete = $this->getSpyCompanyStores(new Criteria(), $con)->diff($spyCompanyStores);


        $this->spyCompanyStoresScheduledForDeletion = $spyCompanyStoresToDelete;

        foreach ($spyCompanyStoresToDelete as $spyCompanyStoreRemoved) {
            $spyCompanyStoreRemoved->setStore(null);
        }

        $this->collSpyCompanyStores = null;
        foreach ($spyCompanyStores as $spyCompanyStore) {
            $this->addSpyCompanyStore($spyCompanyStore);
        }

        $this->collSpyCompanyStores = $spyCompanyStores;
        $this->collSpyCompanyStoresPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCompanyStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCompanyStore objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCompanyStores(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCompanyStoresPartial && !$this->isNew();
        if (null === $this->collSpyCompanyStores || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCompanyStores) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCompanyStores());
            }

            $query = SpyCompanyStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStore($this)
                ->count($con);
        }

        return count($this->collSpyCompanyStores);
    }

    /**
     * Method called to associate a SpyCompanyStore object to this object
     * through the SpyCompanyStore foreign key attribute.
     *
     * @param SpyCompanyStore $l SpyCompanyStore
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCompanyStore(SpyCompanyStore $l)
    {
        if ($this->collSpyCompanyStores === null) {
            $this->initSpyCompanyStores();
            $this->collSpyCompanyStoresPartial = true;
        }

        if (!$this->collSpyCompanyStores->contains($l)) {
            $this->doAddSpyCompanyStore($l);

            if ($this->spyCompanyStoresScheduledForDeletion and $this->spyCompanyStoresScheduledForDeletion->contains($l)) {
                $this->spyCompanyStoresScheduledForDeletion->remove($this->spyCompanyStoresScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCompanyStore $spyCompanyStore The SpyCompanyStore object to add.
     */
    protected function doAddSpyCompanyStore(SpyCompanyStore $spyCompanyStore): void
    {
        $this->collSpyCompanyStores[]= $spyCompanyStore;
        $spyCompanyStore->setStore($this);
    }

    /**
     * @param SpyCompanyStore $spyCompanyStore The SpyCompanyStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCompanyStore(SpyCompanyStore $spyCompanyStore)
    {
        if ($this->getSpyCompanyStores()->contains($spyCompanyStore)) {
            $pos = $this->collSpyCompanyStores->search($spyCompanyStore);
            $this->collSpyCompanyStores->remove($pos);
            if (null === $this->spyCompanyStoresScheduledForDeletion) {
                $this->spyCompanyStoresScheduledForDeletion = clone $this->collSpyCompanyStores;
                $this->spyCompanyStoresScheduledForDeletion->clear();
            }
            $this->spyCompanyStoresScheduledForDeletion[]= clone $spyCompanyStore;
            $spyCompanyStore->setStore(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related SpyCompanyStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCompanyStore[] List of SpyCompanyStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCompanyStore}> List of SpyCompanyStore objects
     */
    public function getSpyCompanyStoresJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCompanyStoreQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getSpyCompanyStores($query, $con);
    }

    /**
     * Clears out the collCountryStores collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addCountryStores()
     */
    public function clearCountryStores()
    {
        $this->collCountryStores = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collCountryStores collection loaded partially.
     *
     * @return void
     */
    public function resetPartialCountryStores($v = true): void
    {
        $this->collCountryStoresPartial = $v;
    }

    /**
     * Initializes the collCountryStores collection.
     *
     * By default this just sets the collCountryStores collection to an empty array (like clearcollCountryStores());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCountryStores(bool $overrideExisting = true): void
    {
        if (null !== $this->collCountryStores && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCountryStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collCountryStores = new $collectionClassName;
        $this->collCountryStores->setModel('\Orm\Zed\Country\Persistence\SpyCountryStore');
    }

    /**
     * Gets an array of SpyCountryStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCountryStore[] List of SpyCountryStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCountryStore> List of SpyCountryStore objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCountryStores(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collCountryStoresPartial && !$this->isNew();
        if (null === $this->collCountryStores || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collCountryStores) {
                    $this->initCountryStores();
                } else {
                    $collectionClassName = SpyCountryStoreTableMap::getTableMap()->getCollectionClassName();

                    $collCountryStores = new $collectionClassName;
                    $collCountryStores->setModel('\Orm\Zed\Country\Persistence\SpyCountryStore');

                    return $collCountryStores;
                }
            } else {
                $collCountryStores = SpyCountryStoreQuery::create(null, $criteria)
                    ->filterByStore($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCountryStoresPartial && count($collCountryStores)) {
                        $this->initCountryStores(false);

                        foreach ($collCountryStores as $obj) {
                            if (false == $this->collCountryStores->contains($obj)) {
                                $this->collCountryStores->append($obj);
                            }
                        }

                        $this->collCountryStoresPartial = true;
                    }

                    return $collCountryStores;
                }

                if ($partial && $this->collCountryStores) {
                    foreach ($this->collCountryStores as $obj) {
                        if ($obj->isNew()) {
                            $collCountryStores[] = $obj;
                        }
                    }
                }

                $this->collCountryStores = $collCountryStores;
                $this->collCountryStoresPartial = false;
            }
        }

        return $this->collCountryStores;
    }

    /**
     * Sets a collection of SpyCountryStore objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $countryStores A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setCountryStores(Collection $countryStores, ?ConnectionInterface $con = null)
    {
        /** @var SpyCountryStore[] $countryStoresToDelete */
        $countryStoresToDelete = $this->getCountryStores(new Criteria(), $con)->diff($countryStores);


        $this->countryStoresScheduledForDeletion = $countryStoresToDelete;

        foreach ($countryStoresToDelete as $countryStoreRemoved) {
            $countryStoreRemoved->setStore(null);
        }

        $this->collCountryStores = null;
        foreach ($countryStores as $countryStore) {
            $this->addCountryStore($countryStore);
        }

        $this->collCountryStores = $countryStores;
        $this->collCountryStoresPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCountryStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCountryStore objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countCountryStores(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collCountryStoresPartial && !$this->isNew();
        if (null === $this->collCountryStores || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCountryStores) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCountryStores());
            }

            $query = SpyCountryStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStore($this)
                ->count($con);
        }

        return count($this->collCountryStores);
    }

    /**
     * Method called to associate a SpyCountryStore object to this object
     * through the SpyCountryStore foreign key attribute.
     *
     * @param SpyCountryStore $l SpyCountryStore
     * @return $this The current object (for fluent API support)
     */
    public function addCountryStore(SpyCountryStore $l)
    {
        if ($this->collCountryStores === null) {
            $this->initCountryStores();
            $this->collCountryStoresPartial = true;
        }

        if (!$this->collCountryStores->contains($l)) {
            $this->doAddCountryStore($l);

            if ($this->countryStoresScheduledForDeletion and $this->countryStoresScheduledForDeletion->contains($l)) {
                $this->countryStoresScheduledForDeletion->remove($this->countryStoresScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCountryStore $countryStore The SpyCountryStore object to add.
     */
    protected function doAddCountryStore(SpyCountryStore $countryStore): void
    {
        $this->collCountryStores[]= $countryStore;
        $countryStore->setStore($this);
    }

    /**
     * @param SpyCountryStore $countryStore The SpyCountryStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeCountryStore(SpyCountryStore $countryStore)
    {
        if ($this->getCountryStores()->contains($countryStore)) {
            $pos = $this->collCountryStores->search($countryStore);
            $this->collCountryStores->remove($pos);
            if (null === $this->countryStoresScheduledForDeletion) {
                $this->countryStoresScheduledForDeletion = clone $this->collCountryStores;
                $this->countryStoresScheduledForDeletion->clear();
            }
            $this->countryStoresScheduledForDeletion[]= clone $countryStore;
            $countryStore->setStore(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related CountryStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCountryStore[] List of SpyCountryStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCountryStore}> List of SpyCountryStore objects
     */
    public function getCountryStoresJoinCountry(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCountryStoreQuery::create(null, $criteria);
        $query->joinWith('Country', $joinBehavior);

        return $this->getCountryStores($query, $con);
    }

    /**
     * Clears out the collCurrencyStores collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addCurrencyStores()
     */
    public function clearCurrencyStores()
    {
        $this->collCurrencyStores = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collCurrencyStores collection loaded partially.
     *
     * @return void
     */
    public function resetPartialCurrencyStores($v = true): void
    {
        $this->collCurrencyStoresPartial = $v;
    }

    /**
     * Initializes the collCurrencyStores collection.
     *
     * By default this just sets the collCurrencyStores collection to an empty array (like clearcollCurrencyStores());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCurrencyStores(bool $overrideExisting = true): void
    {
        if (null !== $this->collCurrencyStores && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCurrencyStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collCurrencyStores = new $collectionClassName;
        $this->collCurrencyStores->setModel('\Orm\Zed\Currency\Persistence\SpyCurrencyStore');
    }

    /**
     * Gets an array of SpyCurrencyStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCurrencyStore[] List of SpyCurrencyStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCurrencyStore> List of SpyCurrencyStore objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCurrencyStores(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collCurrencyStoresPartial && !$this->isNew();
        if (null === $this->collCurrencyStores || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collCurrencyStores) {
                    $this->initCurrencyStores();
                } else {
                    $collectionClassName = SpyCurrencyStoreTableMap::getTableMap()->getCollectionClassName();

                    $collCurrencyStores = new $collectionClassName;
                    $collCurrencyStores->setModel('\Orm\Zed\Currency\Persistence\SpyCurrencyStore');

                    return $collCurrencyStores;
                }
            } else {
                $collCurrencyStores = SpyCurrencyStoreQuery::create(null, $criteria)
                    ->filterByStore($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCurrencyStoresPartial && count($collCurrencyStores)) {
                        $this->initCurrencyStores(false);

                        foreach ($collCurrencyStores as $obj) {
                            if (false == $this->collCurrencyStores->contains($obj)) {
                                $this->collCurrencyStores->append($obj);
                            }
                        }

                        $this->collCurrencyStoresPartial = true;
                    }

                    return $collCurrencyStores;
                }

                if ($partial && $this->collCurrencyStores) {
                    foreach ($this->collCurrencyStores as $obj) {
                        if ($obj->isNew()) {
                            $collCurrencyStores[] = $obj;
                        }
                    }
                }

                $this->collCurrencyStores = $collCurrencyStores;
                $this->collCurrencyStoresPartial = false;
            }
        }

        return $this->collCurrencyStores;
    }

    /**
     * Sets a collection of SpyCurrencyStore objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $currencyStores A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setCurrencyStores(Collection $currencyStores, ?ConnectionInterface $con = null)
    {
        /** @var SpyCurrencyStore[] $currencyStoresToDelete */
        $currencyStoresToDelete = $this->getCurrencyStores(new Criteria(), $con)->diff($currencyStores);


        $this->currencyStoresScheduledForDeletion = $currencyStoresToDelete;

        foreach ($currencyStoresToDelete as $currencyStoreRemoved) {
            $currencyStoreRemoved->setStore(null);
        }

        $this->collCurrencyStores = null;
        foreach ($currencyStores as $currencyStore) {
            $this->addCurrencyStore($currencyStore);
        }

        $this->collCurrencyStores = $currencyStores;
        $this->collCurrencyStoresPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCurrencyStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCurrencyStore objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countCurrencyStores(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collCurrencyStoresPartial && !$this->isNew();
        if (null === $this->collCurrencyStores || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCurrencyStores) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCurrencyStores());
            }

            $query = SpyCurrencyStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStore($this)
                ->count($con);
        }

        return count($this->collCurrencyStores);
    }

    /**
     * Method called to associate a SpyCurrencyStore object to this object
     * through the SpyCurrencyStore foreign key attribute.
     *
     * @param SpyCurrencyStore $l SpyCurrencyStore
     * @return $this The current object (for fluent API support)
     */
    public function addCurrencyStore(SpyCurrencyStore $l)
    {
        if ($this->collCurrencyStores === null) {
            $this->initCurrencyStores();
            $this->collCurrencyStoresPartial = true;
        }

        if (!$this->collCurrencyStores->contains($l)) {
            $this->doAddCurrencyStore($l);

            if ($this->currencyStoresScheduledForDeletion and $this->currencyStoresScheduledForDeletion->contains($l)) {
                $this->currencyStoresScheduledForDeletion->remove($this->currencyStoresScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCurrencyStore $currencyStore The SpyCurrencyStore object to add.
     */
    protected function doAddCurrencyStore(SpyCurrencyStore $currencyStore): void
    {
        $this->collCurrencyStores[]= $currencyStore;
        $currencyStore->setStore($this);
    }

    /**
     * @param SpyCurrencyStore $currencyStore The SpyCurrencyStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeCurrencyStore(SpyCurrencyStore $currencyStore)
    {
        if ($this->getCurrencyStores()->contains($currencyStore)) {
            $pos = $this->collCurrencyStores->search($currencyStore);
            $this->collCurrencyStores->remove($pos);
            if (null === $this->currencyStoresScheduledForDeletion) {
                $this->currencyStoresScheduledForDeletion = clone $this->collCurrencyStores;
                $this->currencyStoresScheduledForDeletion->clear();
            }
            $this->currencyStoresScheduledForDeletion[]= clone $currencyStore;
            $currencyStore->setStore(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related CurrencyStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCurrencyStore[] List of SpyCurrencyStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCurrencyStore}> List of SpyCurrencyStore objects
     */
    public function getCurrencyStoresJoinCurrency(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCurrencyStoreQuery::create(null, $criteria);
        $query->joinWith('Currency', $joinBehavior);

        return $this->getCurrencyStores($query, $con);
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

        $collectionClassName = SpyDiscountTableMap::getTableMap()->getCollectionClassName();

        $this->collDiscounts = new $collectionClassName;
        $this->collDiscounts->setModel('\Orm\Zed\Discount\Persistence\SpyDiscount');
    }

    /**
     * Gets an array of SpyDiscount objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyDiscount[] List of SpyDiscount objects
     * @phpstan-return ObjectCollection&\Traversable<SpyDiscount> List of SpyDiscount objects
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
                    $collectionClassName = SpyDiscountTableMap::getTableMap()->getCollectionClassName();

                    $collDiscounts = new $collectionClassName;
                    $collDiscounts->setModel('\Orm\Zed\Discount\Persistence\SpyDiscount');

                    return $collDiscounts;
                }
            } else {
                $collDiscounts = SpyDiscountQuery::create(null, $criteria)
                    ->filterByStore($this)
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
     * Sets a collection of SpyDiscount objects related by a one-to-many relationship
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
        /** @var SpyDiscount[] $discountsToDelete */
        $discountsToDelete = $this->getDiscounts(new Criteria(), $con)->diff($discounts);


        $this->discountsScheduledForDeletion = $discountsToDelete;

        foreach ($discountsToDelete as $discountRemoved) {
            $discountRemoved->setStore(null);
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
     * Returns the number of related BaseSpyDiscount objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyDiscount objects.
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

            $query = SpyDiscountQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStore($this)
                ->count($con);
        }

        return count($this->collDiscounts);
    }

    /**
     * Method called to associate a SpyDiscount object to this object
     * through the SpyDiscount foreign key attribute.
     *
     * @param SpyDiscount $l SpyDiscount
     * @return $this The current object (for fluent API support)
     */
    public function addDiscount(SpyDiscount $l)
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
     * @param SpyDiscount $discount The SpyDiscount object to add.
     */
    protected function doAddDiscount(SpyDiscount $discount): void
    {
        $this->collDiscounts[]= $discount;
        $discount->setStore($this);
    }

    /**
     * @param SpyDiscount $discount The SpyDiscount object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeDiscount(SpyDiscount $discount)
    {
        if ($this->getDiscounts()->contains($discount)) {
            $pos = $this->collDiscounts->search($discount);
            $this->collDiscounts->remove($pos);
            if (null === $this->discountsScheduledForDeletion) {
                $this->discountsScheduledForDeletion = clone $this->collDiscounts;
                $this->discountsScheduledForDeletion->clear();
            }
            $this->discountsScheduledForDeletion[]= $discount;
            $discount->setStore(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related Discounts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyDiscount[] List of SpyDiscount objects
     * @phpstan-return ObjectCollection&\Traversable<SpyDiscount}> List of SpyDiscount objects
     */
    public function getDiscountsJoinVoucherPool(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyDiscountQuery::create(null, $criteria);
        $query->joinWith('VoucherPool', $joinBehavior);

        return $this->getDiscounts($query, $con);
    }

    /**
     * Clears out the collSpyDiscountStores collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyDiscountStores()
     */
    public function clearSpyDiscountStores()
    {
        $this->collSpyDiscountStores = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyDiscountStores collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyDiscountStores($v = true): void
    {
        $this->collSpyDiscountStoresPartial = $v;
    }

    /**
     * Initializes the collSpyDiscountStores collection.
     *
     * By default this just sets the collSpyDiscountStores collection to an empty array (like clearcollSpyDiscountStores());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyDiscountStores(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyDiscountStores && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyDiscountStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyDiscountStores = new $collectionClassName;
        $this->collSpyDiscountStores->setModel('\Orm\Zed\Discount\Persistence\SpyDiscountStore');
    }

    /**
     * Gets an array of SpyDiscountStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyDiscountStore[] List of SpyDiscountStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyDiscountStore> List of SpyDiscountStore objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyDiscountStores(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyDiscountStoresPartial && !$this->isNew();
        if (null === $this->collSpyDiscountStores || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyDiscountStores) {
                    $this->initSpyDiscountStores();
                } else {
                    $collectionClassName = SpyDiscountStoreTableMap::getTableMap()->getCollectionClassName();

                    $collSpyDiscountStores = new $collectionClassName;
                    $collSpyDiscountStores->setModel('\Orm\Zed\Discount\Persistence\SpyDiscountStore');

                    return $collSpyDiscountStores;
                }
            } else {
                $collSpyDiscountStores = SpyDiscountStoreQuery::create(null, $criteria)
                    ->filterBySpyStore($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyDiscountStoresPartial && count($collSpyDiscountStores)) {
                        $this->initSpyDiscountStores(false);

                        foreach ($collSpyDiscountStores as $obj) {
                            if (false == $this->collSpyDiscountStores->contains($obj)) {
                                $this->collSpyDiscountStores->append($obj);
                            }
                        }

                        $this->collSpyDiscountStoresPartial = true;
                    }

                    return $collSpyDiscountStores;
                }

                if ($partial && $this->collSpyDiscountStores) {
                    foreach ($this->collSpyDiscountStores as $obj) {
                        if ($obj->isNew()) {
                            $collSpyDiscountStores[] = $obj;
                        }
                    }
                }

                $this->collSpyDiscountStores = $collSpyDiscountStores;
                $this->collSpyDiscountStoresPartial = false;
            }
        }

        return $this->collSpyDiscountStores;
    }

    /**
     * Sets a collection of SpyDiscountStore objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyDiscountStores A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyDiscountStores(Collection $spyDiscountStores, ?ConnectionInterface $con = null)
    {
        /** @var SpyDiscountStore[] $spyDiscountStoresToDelete */
        $spyDiscountStoresToDelete = $this->getSpyDiscountStores(new Criteria(), $con)->diff($spyDiscountStores);


        $this->spyDiscountStoresScheduledForDeletion = $spyDiscountStoresToDelete;

        foreach ($spyDiscountStoresToDelete as $spyDiscountStoreRemoved) {
            $spyDiscountStoreRemoved->setSpyStore(null);
        }

        $this->collSpyDiscountStores = null;
        foreach ($spyDiscountStores as $spyDiscountStore) {
            $this->addSpyDiscountStore($spyDiscountStore);
        }

        $this->collSpyDiscountStores = $spyDiscountStores;
        $this->collSpyDiscountStoresPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyDiscountStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyDiscountStore objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyDiscountStores(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyDiscountStoresPartial && !$this->isNew();
        if (null === $this->collSpyDiscountStores || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyDiscountStores) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyDiscountStores());
            }

            $query = SpyDiscountStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyStore($this)
                ->count($con);
        }

        return count($this->collSpyDiscountStores);
    }

    /**
     * Method called to associate a SpyDiscountStore object to this object
     * through the SpyDiscountStore foreign key attribute.
     *
     * @param SpyDiscountStore $l SpyDiscountStore
     * @return $this The current object (for fluent API support)
     */
    public function addSpyDiscountStore(SpyDiscountStore $l)
    {
        if ($this->collSpyDiscountStores === null) {
            $this->initSpyDiscountStores();
            $this->collSpyDiscountStoresPartial = true;
        }

        if (!$this->collSpyDiscountStores->contains($l)) {
            $this->doAddSpyDiscountStore($l);

            if ($this->spyDiscountStoresScheduledForDeletion and $this->spyDiscountStoresScheduledForDeletion->contains($l)) {
                $this->spyDiscountStoresScheduledForDeletion->remove($this->spyDiscountStoresScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyDiscountStore $spyDiscountStore The SpyDiscountStore object to add.
     */
    protected function doAddSpyDiscountStore(SpyDiscountStore $spyDiscountStore): void
    {
        $this->collSpyDiscountStores[]= $spyDiscountStore;
        $spyDiscountStore->setSpyStore($this);
    }

    /**
     * @param SpyDiscountStore $spyDiscountStore The SpyDiscountStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyDiscountStore(SpyDiscountStore $spyDiscountStore)
    {
        if ($this->getSpyDiscountStores()->contains($spyDiscountStore)) {
            $pos = $this->collSpyDiscountStores->search($spyDiscountStore);
            $this->collSpyDiscountStores->remove($pos);
            if (null === $this->spyDiscountStoresScheduledForDeletion) {
                $this->spyDiscountStoresScheduledForDeletion = clone $this->collSpyDiscountStores;
                $this->spyDiscountStoresScheduledForDeletion->clear();
            }
            $this->spyDiscountStoresScheduledForDeletion[]= clone $spyDiscountStore;
            $spyDiscountStore->setSpyStore(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related SpyDiscountStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyDiscountStore[] List of SpyDiscountStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyDiscountStore}> List of SpyDiscountStore objects
     */
    public function getSpyDiscountStoresJoinSpyDiscount(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyDiscountStoreQuery::create(null, $criteria);
        $query->joinWith('SpyDiscount', $joinBehavior);

        return $this->getSpyDiscountStores($query, $con);
    }

    /**
     * Clears out the collLocaleStores collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addLocaleStores()
     */
    public function clearLocaleStores()
    {
        $this->collLocaleStores = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collLocaleStores collection loaded partially.
     *
     * @return void
     */
    public function resetPartialLocaleStores($v = true): void
    {
        $this->collLocaleStoresPartial = $v;
    }

    /**
     * Initializes the collLocaleStores collection.
     *
     * By default this just sets the collLocaleStores collection to an empty array (like clearcollLocaleStores());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLocaleStores(bool $overrideExisting = true): void
    {
        if (null !== $this->collLocaleStores && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyLocaleStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collLocaleStores = new $collectionClassName;
        $this->collLocaleStores->setModel('\Orm\Zed\Locale\Persistence\SpyLocaleStore');
    }

    /**
     * Gets an array of SpyLocaleStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyLocaleStore[] List of SpyLocaleStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyLocaleStore> List of SpyLocaleStore objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getLocaleStores(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collLocaleStoresPartial && !$this->isNew();
        if (null === $this->collLocaleStores || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collLocaleStores) {
                    $this->initLocaleStores();
                } else {
                    $collectionClassName = SpyLocaleStoreTableMap::getTableMap()->getCollectionClassName();

                    $collLocaleStores = new $collectionClassName;
                    $collLocaleStores->setModel('\Orm\Zed\Locale\Persistence\SpyLocaleStore');

                    return $collLocaleStores;
                }
            } else {
                $collLocaleStores = SpyLocaleStoreQuery::create(null, $criteria)
                    ->filterByStore($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collLocaleStoresPartial && count($collLocaleStores)) {
                        $this->initLocaleStores(false);

                        foreach ($collLocaleStores as $obj) {
                            if (false == $this->collLocaleStores->contains($obj)) {
                                $this->collLocaleStores->append($obj);
                            }
                        }

                        $this->collLocaleStoresPartial = true;
                    }

                    return $collLocaleStores;
                }

                if ($partial && $this->collLocaleStores) {
                    foreach ($this->collLocaleStores as $obj) {
                        if ($obj->isNew()) {
                            $collLocaleStores[] = $obj;
                        }
                    }
                }

                $this->collLocaleStores = $collLocaleStores;
                $this->collLocaleStoresPartial = false;
            }
        }

        return $this->collLocaleStores;
    }

    /**
     * Sets a collection of SpyLocaleStore objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $localeStores A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setLocaleStores(Collection $localeStores, ?ConnectionInterface $con = null)
    {
        /** @var SpyLocaleStore[] $localeStoresToDelete */
        $localeStoresToDelete = $this->getLocaleStores(new Criteria(), $con)->diff($localeStores);


        $this->localeStoresScheduledForDeletion = $localeStoresToDelete;

        foreach ($localeStoresToDelete as $localeStoreRemoved) {
            $localeStoreRemoved->setStore(null);
        }

        $this->collLocaleStores = null;
        foreach ($localeStores as $localeStore) {
            $this->addLocaleStore($localeStore);
        }

        $this->collLocaleStores = $localeStores;
        $this->collLocaleStoresPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyLocaleStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyLocaleStore objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countLocaleStores(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collLocaleStoresPartial && !$this->isNew();
        if (null === $this->collLocaleStores || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLocaleStores) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLocaleStores());
            }

            $query = SpyLocaleStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStore($this)
                ->count($con);
        }

        return count($this->collLocaleStores);
    }

    /**
     * Method called to associate a SpyLocaleStore object to this object
     * through the SpyLocaleStore foreign key attribute.
     *
     * @param SpyLocaleStore $l SpyLocaleStore
     * @return $this The current object (for fluent API support)
     */
    public function addLocaleStore(SpyLocaleStore $l)
    {
        if ($this->collLocaleStores === null) {
            $this->initLocaleStores();
            $this->collLocaleStoresPartial = true;
        }

        if (!$this->collLocaleStores->contains($l)) {
            $this->doAddLocaleStore($l);

            if ($this->localeStoresScheduledForDeletion and $this->localeStoresScheduledForDeletion->contains($l)) {
                $this->localeStoresScheduledForDeletion->remove($this->localeStoresScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyLocaleStore $localeStore The SpyLocaleStore object to add.
     */
    protected function doAddLocaleStore(SpyLocaleStore $localeStore): void
    {
        $this->collLocaleStores[]= $localeStore;
        $localeStore->setStore($this);
    }

    /**
     * @param SpyLocaleStore $localeStore The SpyLocaleStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeLocaleStore(SpyLocaleStore $localeStore)
    {
        if ($this->getLocaleStores()->contains($localeStore)) {
            $pos = $this->collLocaleStores->search($localeStore);
            $this->collLocaleStores->remove($pos);
            if (null === $this->localeStoresScheduledForDeletion) {
                $this->localeStoresScheduledForDeletion = clone $this->collLocaleStores;
                $this->localeStoresScheduledForDeletion->clear();
            }
            $this->localeStoresScheduledForDeletion[]= clone $localeStore;
            $localeStore->setStore(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related LocaleStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyLocaleStore[] List of SpyLocaleStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyLocaleStore}> List of SpyLocaleStore objects
     */
    public function getLocaleStoresJoinLocale(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyLocaleStoreQuery::create(null, $criteria);
        $query->joinWith('Locale', $joinBehavior);

        return $this->getLocaleStores($query, $con);
    }

    /**
     * Clears out the collSpyMerchantStores collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyMerchantStores()
     */
    public function clearSpyMerchantStores()
    {
        $this->collSpyMerchantStores = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyMerchantStores collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyMerchantStores($v = true): void
    {
        $this->collSpyMerchantStoresPartial = $v;
    }

    /**
     * Initializes the collSpyMerchantStores collection.
     *
     * By default this just sets the collSpyMerchantStores collection to an empty array (like clearcollSpyMerchantStores());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyMerchantStores(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyMerchantStores && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyMerchantStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyMerchantStores = new $collectionClassName;
        $this->collSpyMerchantStores->setModel('\Orm\Zed\Merchant\Persistence\SpyMerchantStore');
    }

    /**
     * Gets an array of SpyMerchantStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyMerchantStore[] List of SpyMerchantStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantStore> List of SpyMerchantStore objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyMerchantStores(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyMerchantStoresPartial && !$this->isNew();
        if (null === $this->collSpyMerchantStores || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyMerchantStores) {
                    $this->initSpyMerchantStores();
                } else {
                    $collectionClassName = SpyMerchantStoreTableMap::getTableMap()->getCollectionClassName();

                    $collSpyMerchantStores = new $collectionClassName;
                    $collSpyMerchantStores->setModel('\Orm\Zed\Merchant\Persistence\SpyMerchantStore');

                    return $collSpyMerchantStores;
                }
            } else {
                $collSpyMerchantStores = SpyMerchantStoreQuery::create(null, $criteria)
                    ->filterBySpyStore($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyMerchantStoresPartial && count($collSpyMerchantStores)) {
                        $this->initSpyMerchantStores(false);

                        foreach ($collSpyMerchantStores as $obj) {
                            if (false == $this->collSpyMerchantStores->contains($obj)) {
                                $this->collSpyMerchantStores->append($obj);
                            }
                        }

                        $this->collSpyMerchantStoresPartial = true;
                    }

                    return $collSpyMerchantStores;
                }

                if ($partial && $this->collSpyMerchantStores) {
                    foreach ($this->collSpyMerchantStores as $obj) {
                        if ($obj->isNew()) {
                            $collSpyMerchantStores[] = $obj;
                        }
                    }
                }

                $this->collSpyMerchantStores = $collSpyMerchantStores;
                $this->collSpyMerchantStoresPartial = false;
            }
        }

        return $this->collSpyMerchantStores;
    }

    /**
     * Sets a collection of SpyMerchantStore objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyMerchantStores A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyMerchantStores(Collection $spyMerchantStores, ?ConnectionInterface $con = null)
    {
        /** @var SpyMerchantStore[] $spyMerchantStoresToDelete */
        $spyMerchantStoresToDelete = $this->getSpyMerchantStores(new Criteria(), $con)->diff($spyMerchantStores);


        $this->spyMerchantStoresScheduledForDeletion = $spyMerchantStoresToDelete;

        foreach ($spyMerchantStoresToDelete as $spyMerchantStoreRemoved) {
            $spyMerchantStoreRemoved->setSpyStore(null);
        }

        $this->collSpyMerchantStores = null;
        foreach ($spyMerchantStores as $spyMerchantStore) {
            $this->addSpyMerchantStore($spyMerchantStore);
        }

        $this->collSpyMerchantStores = $spyMerchantStores;
        $this->collSpyMerchantStoresPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyMerchantStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyMerchantStore objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyMerchantStores(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyMerchantStoresPartial && !$this->isNew();
        if (null === $this->collSpyMerchantStores || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyMerchantStores) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyMerchantStores());
            }

            $query = SpyMerchantStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyStore($this)
                ->count($con);
        }

        return count($this->collSpyMerchantStores);
    }

    /**
     * Method called to associate a SpyMerchantStore object to this object
     * through the SpyMerchantStore foreign key attribute.
     *
     * @param SpyMerchantStore $l SpyMerchantStore
     * @return $this The current object (for fluent API support)
     */
    public function addSpyMerchantStore(SpyMerchantStore $l)
    {
        if ($this->collSpyMerchantStores === null) {
            $this->initSpyMerchantStores();
            $this->collSpyMerchantStoresPartial = true;
        }

        if (!$this->collSpyMerchantStores->contains($l)) {
            $this->doAddSpyMerchantStore($l);

            if ($this->spyMerchantStoresScheduledForDeletion and $this->spyMerchantStoresScheduledForDeletion->contains($l)) {
                $this->spyMerchantStoresScheduledForDeletion->remove($this->spyMerchantStoresScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyMerchantStore $spyMerchantStore The SpyMerchantStore object to add.
     */
    protected function doAddSpyMerchantStore(SpyMerchantStore $spyMerchantStore): void
    {
        $this->collSpyMerchantStores[]= $spyMerchantStore;
        $spyMerchantStore->setSpyStore($this);
    }

    /**
     * @param SpyMerchantStore $spyMerchantStore The SpyMerchantStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyMerchantStore(SpyMerchantStore $spyMerchantStore)
    {
        if ($this->getSpyMerchantStores()->contains($spyMerchantStore)) {
            $pos = $this->collSpyMerchantStores->search($spyMerchantStore);
            $this->collSpyMerchantStores->remove($pos);
            if (null === $this->spyMerchantStoresScheduledForDeletion) {
                $this->spyMerchantStoresScheduledForDeletion = clone $this->collSpyMerchantStores;
                $this->spyMerchantStoresScheduledForDeletion->clear();
            }
            $this->spyMerchantStoresScheduledForDeletion[]= clone $spyMerchantStore;
            $spyMerchantStore->setSpyStore(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related SpyMerchantStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyMerchantStore[] List of SpyMerchantStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantStore}> List of SpyMerchantStore objects
     */
    public function getSpyMerchantStoresJoinSpyMerchant(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyMerchantStoreQuery::create(null, $criteria);
        $query->joinWith('SpyMerchant', $joinBehavior);

        return $this->getSpyMerchantStores($query, $con);
    }

    /**
     * Clears out the collMerchantCommissions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addMerchantCommissions()
     */
    public function clearMerchantCommissions()
    {
        $this->collMerchantCommissions = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collMerchantCommissions collection loaded partially.
     *
     * @return void
     */
    public function resetPartialMerchantCommissions($v = true): void
    {
        $this->collMerchantCommissionsPartial = $v;
    }

    /**
     * Initializes the collMerchantCommissions collection.
     *
     * By default this just sets the collMerchantCommissions collection to an empty array (like clearcollMerchantCommissions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initMerchantCommissions(bool $overrideExisting = true): void
    {
        if (null !== $this->collMerchantCommissions && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyMerchantCommissionStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collMerchantCommissions = new $collectionClassName;
        $this->collMerchantCommissions->setModel('\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStore');
    }

    /**
     * Gets an array of SpyMerchantCommissionStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyMerchantCommissionStore[] List of SpyMerchantCommissionStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantCommissionStore> List of SpyMerchantCommissionStore objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getMerchantCommissions(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collMerchantCommissionsPartial && !$this->isNew();
        if (null === $this->collMerchantCommissions || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collMerchantCommissions) {
                    $this->initMerchantCommissions();
                } else {
                    $collectionClassName = SpyMerchantCommissionStoreTableMap::getTableMap()->getCollectionClassName();

                    $collMerchantCommissions = new $collectionClassName;
                    $collMerchantCommissions->setModel('\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStore');

                    return $collMerchantCommissions;
                }
            } else {
                $collMerchantCommissions = SpyMerchantCommissionStoreQuery::create(null, $criteria)
                    ->filterByStore($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collMerchantCommissionsPartial && count($collMerchantCommissions)) {
                        $this->initMerchantCommissions(false);

                        foreach ($collMerchantCommissions as $obj) {
                            if (false == $this->collMerchantCommissions->contains($obj)) {
                                $this->collMerchantCommissions->append($obj);
                            }
                        }

                        $this->collMerchantCommissionsPartial = true;
                    }

                    return $collMerchantCommissions;
                }

                if ($partial && $this->collMerchantCommissions) {
                    foreach ($this->collMerchantCommissions as $obj) {
                        if ($obj->isNew()) {
                            $collMerchantCommissions[] = $obj;
                        }
                    }
                }

                $this->collMerchantCommissions = $collMerchantCommissions;
                $this->collMerchantCommissionsPartial = false;
            }
        }

        return $this->collMerchantCommissions;
    }

    /**
     * Sets a collection of SpyMerchantCommissionStore objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $merchantCommissions A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setMerchantCommissions(Collection $merchantCommissions, ?ConnectionInterface $con = null)
    {
        /** @var SpyMerchantCommissionStore[] $merchantCommissionsToDelete */
        $merchantCommissionsToDelete = $this->getMerchantCommissions(new Criteria(), $con)->diff($merchantCommissions);


        $this->merchantCommissionsScheduledForDeletion = $merchantCommissionsToDelete;

        foreach ($merchantCommissionsToDelete as $merchantCommissionRemoved) {
            $merchantCommissionRemoved->setStore(null);
        }

        $this->collMerchantCommissions = null;
        foreach ($merchantCommissions as $merchantCommission) {
            $this->addMerchantCommission($merchantCommission);
        }

        $this->collMerchantCommissions = $merchantCommissions;
        $this->collMerchantCommissionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyMerchantCommissionStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyMerchantCommissionStore objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countMerchantCommissions(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collMerchantCommissionsPartial && !$this->isNew();
        if (null === $this->collMerchantCommissions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collMerchantCommissions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getMerchantCommissions());
            }

            $query = SpyMerchantCommissionStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStore($this)
                ->count($con);
        }

        return count($this->collMerchantCommissions);
    }

    /**
     * Method called to associate a SpyMerchantCommissionStore object to this object
     * through the SpyMerchantCommissionStore foreign key attribute.
     *
     * @param SpyMerchantCommissionStore $l SpyMerchantCommissionStore
     * @return $this The current object (for fluent API support)
     */
    public function addMerchantCommission(SpyMerchantCommissionStore $l)
    {
        if ($this->collMerchantCommissions === null) {
            $this->initMerchantCommissions();
            $this->collMerchantCommissionsPartial = true;
        }

        if (!$this->collMerchantCommissions->contains($l)) {
            $this->doAddMerchantCommission($l);

            if ($this->merchantCommissionsScheduledForDeletion and $this->merchantCommissionsScheduledForDeletion->contains($l)) {
                $this->merchantCommissionsScheduledForDeletion->remove($this->merchantCommissionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyMerchantCommissionStore $merchantCommission The SpyMerchantCommissionStore object to add.
     */
    protected function doAddMerchantCommission(SpyMerchantCommissionStore $merchantCommission): void
    {
        $this->collMerchantCommissions[]= $merchantCommission;
        $merchantCommission->setStore($this);
    }

    /**
     * @param SpyMerchantCommissionStore $merchantCommission The SpyMerchantCommissionStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeMerchantCommission(SpyMerchantCommissionStore $merchantCommission)
    {
        if ($this->getMerchantCommissions()->contains($merchantCommission)) {
            $pos = $this->collMerchantCommissions->search($merchantCommission);
            $this->collMerchantCommissions->remove($pos);
            if (null === $this->merchantCommissionsScheduledForDeletion) {
                $this->merchantCommissionsScheduledForDeletion = clone $this->collMerchantCommissions;
                $this->merchantCommissionsScheduledForDeletion->clear();
            }
            $this->merchantCommissionsScheduledForDeletion[]= clone $merchantCommission;
            $merchantCommission->setStore(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related MerchantCommissions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyMerchantCommissionStore[] List of SpyMerchantCommissionStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantCommissionStore}> List of SpyMerchantCommissionStore objects
     */
    public function getMerchantCommissionsJoinMerchantCommission(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyMerchantCommissionStoreQuery::create(null, $criteria);
        $query->joinWith('MerchantCommission', $joinBehavior);

        return $this->getMerchantCommissions($query, $con);
    }

    /**
     * Clears out the collSpyMerchantRegistrationRequests collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyMerchantRegistrationRequests()
     */
    public function clearSpyMerchantRegistrationRequests()
    {
        $this->collSpyMerchantRegistrationRequests = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyMerchantRegistrationRequests collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyMerchantRegistrationRequests($v = true): void
    {
        $this->collSpyMerchantRegistrationRequestsPartial = $v;
    }

    /**
     * Initializes the collSpyMerchantRegistrationRequests collection.
     *
     * By default this just sets the collSpyMerchantRegistrationRequests collection to an empty array (like clearcollSpyMerchantRegistrationRequests());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyMerchantRegistrationRequests(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyMerchantRegistrationRequests && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyMerchantRegistrationRequestTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyMerchantRegistrationRequests = new $collectionClassName;
        $this->collSpyMerchantRegistrationRequests->setModel('\Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequest');
    }

    /**
     * Gets an array of SpyMerchantRegistrationRequest objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyMerchantRegistrationRequest[] List of SpyMerchantRegistrationRequest objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantRegistrationRequest> List of SpyMerchantRegistrationRequest objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyMerchantRegistrationRequests(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyMerchantRegistrationRequestsPartial && !$this->isNew();
        if (null === $this->collSpyMerchantRegistrationRequests || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyMerchantRegistrationRequests) {
                    $this->initSpyMerchantRegistrationRequests();
                } else {
                    $collectionClassName = SpyMerchantRegistrationRequestTableMap::getTableMap()->getCollectionClassName();

                    $collSpyMerchantRegistrationRequests = new $collectionClassName;
                    $collSpyMerchantRegistrationRequests->setModel('\Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequest');

                    return $collSpyMerchantRegistrationRequests;
                }
            } else {
                $collSpyMerchantRegistrationRequests = SpyMerchantRegistrationRequestQuery::create(null, $criteria)
                    ->filterByStore($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyMerchantRegistrationRequestsPartial && count($collSpyMerchantRegistrationRequests)) {
                        $this->initSpyMerchantRegistrationRequests(false);

                        foreach ($collSpyMerchantRegistrationRequests as $obj) {
                            if (false == $this->collSpyMerchantRegistrationRequests->contains($obj)) {
                                $this->collSpyMerchantRegistrationRequests->append($obj);
                            }
                        }

                        $this->collSpyMerchantRegistrationRequestsPartial = true;
                    }

                    return $collSpyMerchantRegistrationRequests;
                }

                if ($partial && $this->collSpyMerchantRegistrationRequests) {
                    foreach ($this->collSpyMerchantRegistrationRequests as $obj) {
                        if ($obj->isNew()) {
                            $collSpyMerchantRegistrationRequests[] = $obj;
                        }
                    }
                }

                $this->collSpyMerchantRegistrationRequests = $collSpyMerchantRegistrationRequests;
                $this->collSpyMerchantRegistrationRequestsPartial = false;
            }
        }

        return $this->collSpyMerchantRegistrationRequests;
    }

    /**
     * Sets a collection of SpyMerchantRegistrationRequest objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyMerchantRegistrationRequests A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyMerchantRegistrationRequests(Collection $spyMerchantRegistrationRequests, ?ConnectionInterface $con = null)
    {
        /** @var SpyMerchantRegistrationRequest[] $spyMerchantRegistrationRequestsToDelete */
        $spyMerchantRegistrationRequestsToDelete = $this->getSpyMerchantRegistrationRequests(new Criteria(), $con)->diff($spyMerchantRegistrationRequests);


        $this->spyMerchantRegistrationRequestsScheduledForDeletion = $spyMerchantRegistrationRequestsToDelete;

        foreach ($spyMerchantRegistrationRequestsToDelete as $spyMerchantRegistrationRequestRemoved) {
            $spyMerchantRegistrationRequestRemoved->setStore(null);
        }

        $this->collSpyMerchantRegistrationRequests = null;
        foreach ($spyMerchantRegistrationRequests as $spyMerchantRegistrationRequest) {
            $this->addSpyMerchantRegistrationRequest($spyMerchantRegistrationRequest);
        }

        $this->collSpyMerchantRegistrationRequests = $spyMerchantRegistrationRequests;
        $this->collSpyMerchantRegistrationRequestsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyMerchantRegistrationRequest objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyMerchantRegistrationRequest objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyMerchantRegistrationRequests(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyMerchantRegistrationRequestsPartial && !$this->isNew();
        if (null === $this->collSpyMerchantRegistrationRequests || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyMerchantRegistrationRequests) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyMerchantRegistrationRequests());
            }

            $query = SpyMerchantRegistrationRequestQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStore($this)
                ->count($con);
        }

        return count($this->collSpyMerchantRegistrationRequests);
    }

    /**
     * Method called to associate a SpyMerchantRegistrationRequest object to this object
     * through the SpyMerchantRegistrationRequest foreign key attribute.
     *
     * @param SpyMerchantRegistrationRequest $l SpyMerchantRegistrationRequest
     * @return $this The current object (for fluent API support)
     */
    public function addSpyMerchantRegistrationRequest(SpyMerchantRegistrationRequest $l)
    {
        if ($this->collSpyMerchantRegistrationRequests === null) {
            $this->initSpyMerchantRegistrationRequests();
            $this->collSpyMerchantRegistrationRequestsPartial = true;
        }

        if (!$this->collSpyMerchantRegistrationRequests->contains($l)) {
            $this->doAddSpyMerchantRegistrationRequest($l);

            if ($this->spyMerchantRegistrationRequestsScheduledForDeletion and $this->spyMerchantRegistrationRequestsScheduledForDeletion->contains($l)) {
                $this->spyMerchantRegistrationRequestsScheduledForDeletion->remove($this->spyMerchantRegistrationRequestsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyMerchantRegistrationRequest $spyMerchantRegistrationRequest The SpyMerchantRegistrationRequest object to add.
     */
    protected function doAddSpyMerchantRegistrationRequest(SpyMerchantRegistrationRequest $spyMerchantRegistrationRequest): void
    {
        $this->collSpyMerchantRegistrationRequests[]= $spyMerchantRegistrationRequest;
        $spyMerchantRegistrationRequest->setStore($this);
    }

    /**
     * @param SpyMerchantRegistrationRequest $spyMerchantRegistrationRequest The SpyMerchantRegistrationRequest object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyMerchantRegistrationRequest(SpyMerchantRegistrationRequest $spyMerchantRegistrationRequest)
    {
        if ($this->getSpyMerchantRegistrationRequests()->contains($spyMerchantRegistrationRequest)) {
            $pos = $this->collSpyMerchantRegistrationRequests->search($spyMerchantRegistrationRequest);
            $this->collSpyMerchantRegistrationRequests->remove($pos);
            if (null === $this->spyMerchantRegistrationRequestsScheduledForDeletion) {
                $this->spyMerchantRegistrationRequestsScheduledForDeletion = clone $this->collSpyMerchantRegistrationRequests;
                $this->spyMerchantRegistrationRequestsScheduledForDeletion->clear();
            }
            $this->spyMerchantRegistrationRequestsScheduledForDeletion[]= clone $spyMerchantRegistrationRequest;
            $spyMerchantRegistrationRequest->setStore(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related SpyMerchantRegistrationRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyMerchantRegistrationRequest[] List of SpyMerchantRegistrationRequest objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantRegistrationRequest}> List of SpyMerchantRegistrationRequest objects
     */
    public function getSpyMerchantRegistrationRequestsJoinCountry(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyMerchantRegistrationRequestQuery::create(null, $criteria);
        $query->joinWith('Country', $joinBehavior);

        return $this->getSpyMerchantRegistrationRequests($query, $con);
    }

    /**
     * Clears out the collSpyMerchantRelationshipSalesOrderThresholds collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyMerchantRelationshipSalesOrderThresholds()
     */
    public function clearSpyMerchantRelationshipSalesOrderThresholds()
    {
        $this->collSpyMerchantRelationshipSalesOrderThresholds = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyMerchantRelationshipSalesOrderThresholds collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyMerchantRelationshipSalesOrderThresholds($v = true): void
    {
        $this->collSpyMerchantRelationshipSalesOrderThresholdsPartial = $v;
    }

    /**
     * Initializes the collSpyMerchantRelationshipSalesOrderThresholds collection.
     *
     * By default this just sets the collSpyMerchantRelationshipSalesOrderThresholds collection to an empty array (like clearcollSpyMerchantRelationshipSalesOrderThresholds());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyMerchantRelationshipSalesOrderThresholds(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyMerchantRelationshipSalesOrderThresholds && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyMerchantRelationshipSalesOrderThresholdTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyMerchantRelationshipSalesOrderThresholds = new $collectionClassName;
        $this->collSpyMerchantRelationshipSalesOrderThresholds->setModel('\Orm\Zed\MerchantRelationshipSalesOrderThreshold\Persistence\SpyMerchantRelationshipSalesOrderThreshold');
    }

    /**
     * Gets an array of SpyMerchantRelationshipSalesOrderThreshold objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyMerchantRelationshipSalesOrderThreshold[] List of SpyMerchantRelationshipSalesOrderThreshold objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantRelationshipSalesOrderThreshold> List of SpyMerchantRelationshipSalesOrderThreshold objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyMerchantRelationshipSalesOrderThresholds(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyMerchantRelationshipSalesOrderThresholdsPartial && !$this->isNew();
        if (null === $this->collSpyMerchantRelationshipSalesOrderThresholds || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyMerchantRelationshipSalesOrderThresholds) {
                    $this->initSpyMerchantRelationshipSalesOrderThresholds();
                } else {
                    $collectionClassName = SpyMerchantRelationshipSalesOrderThresholdTableMap::getTableMap()->getCollectionClassName();

                    $collSpyMerchantRelationshipSalesOrderThresholds = new $collectionClassName;
                    $collSpyMerchantRelationshipSalesOrderThresholds->setModel('\Orm\Zed\MerchantRelationshipSalesOrderThreshold\Persistence\SpyMerchantRelationshipSalesOrderThreshold');

                    return $collSpyMerchantRelationshipSalesOrderThresholds;
                }
            } else {
                $collSpyMerchantRelationshipSalesOrderThresholds = SpyMerchantRelationshipSalesOrderThresholdQuery::create(null, $criteria)
                    ->filterByStore($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyMerchantRelationshipSalesOrderThresholdsPartial && count($collSpyMerchantRelationshipSalesOrderThresholds)) {
                        $this->initSpyMerchantRelationshipSalesOrderThresholds(false);

                        foreach ($collSpyMerchantRelationshipSalesOrderThresholds as $obj) {
                            if (false == $this->collSpyMerchantRelationshipSalesOrderThresholds->contains($obj)) {
                                $this->collSpyMerchantRelationshipSalesOrderThresholds->append($obj);
                            }
                        }

                        $this->collSpyMerchantRelationshipSalesOrderThresholdsPartial = true;
                    }

                    return $collSpyMerchantRelationshipSalesOrderThresholds;
                }

                if ($partial && $this->collSpyMerchantRelationshipSalesOrderThresholds) {
                    foreach ($this->collSpyMerchantRelationshipSalesOrderThresholds as $obj) {
                        if ($obj->isNew()) {
                            $collSpyMerchantRelationshipSalesOrderThresholds[] = $obj;
                        }
                    }
                }

                $this->collSpyMerchantRelationshipSalesOrderThresholds = $collSpyMerchantRelationshipSalesOrderThresholds;
                $this->collSpyMerchantRelationshipSalesOrderThresholdsPartial = false;
            }
        }

        return $this->collSpyMerchantRelationshipSalesOrderThresholds;
    }

    /**
     * Sets a collection of SpyMerchantRelationshipSalesOrderThreshold objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyMerchantRelationshipSalesOrderThresholds A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyMerchantRelationshipSalesOrderThresholds(Collection $spyMerchantRelationshipSalesOrderThresholds, ?ConnectionInterface $con = null)
    {
        /** @var SpyMerchantRelationshipSalesOrderThreshold[] $spyMerchantRelationshipSalesOrderThresholdsToDelete */
        $spyMerchantRelationshipSalesOrderThresholdsToDelete = $this->getSpyMerchantRelationshipSalesOrderThresholds(new Criteria(), $con)->diff($spyMerchantRelationshipSalesOrderThresholds);


        $this->spyMerchantRelationshipSalesOrderThresholdsScheduledForDeletion = $spyMerchantRelationshipSalesOrderThresholdsToDelete;

        foreach ($spyMerchantRelationshipSalesOrderThresholdsToDelete as $spyMerchantRelationshipSalesOrderThresholdRemoved) {
            $spyMerchantRelationshipSalesOrderThresholdRemoved->setStore(null);
        }

        $this->collSpyMerchantRelationshipSalesOrderThresholds = null;
        foreach ($spyMerchantRelationshipSalesOrderThresholds as $spyMerchantRelationshipSalesOrderThreshold) {
            $this->addSpyMerchantRelationshipSalesOrderThreshold($spyMerchantRelationshipSalesOrderThreshold);
        }

        $this->collSpyMerchantRelationshipSalesOrderThresholds = $spyMerchantRelationshipSalesOrderThresholds;
        $this->collSpyMerchantRelationshipSalesOrderThresholdsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyMerchantRelationshipSalesOrderThreshold objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyMerchantRelationshipSalesOrderThreshold objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyMerchantRelationshipSalesOrderThresholds(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyMerchantRelationshipSalesOrderThresholdsPartial && !$this->isNew();
        if (null === $this->collSpyMerchantRelationshipSalesOrderThresholds || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyMerchantRelationshipSalesOrderThresholds) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyMerchantRelationshipSalesOrderThresholds());
            }

            $query = SpyMerchantRelationshipSalesOrderThresholdQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStore($this)
                ->count($con);
        }

        return count($this->collSpyMerchantRelationshipSalesOrderThresholds);
    }

    /**
     * Method called to associate a SpyMerchantRelationshipSalesOrderThreshold object to this object
     * through the SpyMerchantRelationshipSalesOrderThreshold foreign key attribute.
     *
     * @param SpyMerchantRelationshipSalesOrderThreshold $l SpyMerchantRelationshipSalesOrderThreshold
     * @return $this The current object (for fluent API support)
     */
    public function addSpyMerchantRelationshipSalesOrderThreshold(SpyMerchantRelationshipSalesOrderThreshold $l)
    {
        if ($this->collSpyMerchantRelationshipSalesOrderThresholds === null) {
            $this->initSpyMerchantRelationshipSalesOrderThresholds();
            $this->collSpyMerchantRelationshipSalesOrderThresholdsPartial = true;
        }

        if (!$this->collSpyMerchantRelationshipSalesOrderThresholds->contains($l)) {
            $this->doAddSpyMerchantRelationshipSalesOrderThreshold($l);

            if ($this->spyMerchantRelationshipSalesOrderThresholdsScheduledForDeletion and $this->spyMerchantRelationshipSalesOrderThresholdsScheduledForDeletion->contains($l)) {
                $this->spyMerchantRelationshipSalesOrderThresholdsScheduledForDeletion->remove($this->spyMerchantRelationshipSalesOrderThresholdsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyMerchantRelationshipSalesOrderThreshold $spyMerchantRelationshipSalesOrderThreshold The SpyMerchantRelationshipSalesOrderThreshold object to add.
     */
    protected function doAddSpyMerchantRelationshipSalesOrderThreshold(SpyMerchantRelationshipSalesOrderThreshold $spyMerchantRelationshipSalesOrderThreshold): void
    {
        $this->collSpyMerchantRelationshipSalesOrderThresholds[]= $spyMerchantRelationshipSalesOrderThreshold;
        $spyMerchantRelationshipSalesOrderThreshold->setStore($this);
    }

    /**
     * @param SpyMerchantRelationshipSalesOrderThreshold $spyMerchantRelationshipSalesOrderThreshold The SpyMerchantRelationshipSalesOrderThreshold object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyMerchantRelationshipSalesOrderThreshold(SpyMerchantRelationshipSalesOrderThreshold $spyMerchantRelationshipSalesOrderThreshold)
    {
        if ($this->getSpyMerchantRelationshipSalesOrderThresholds()->contains($spyMerchantRelationshipSalesOrderThreshold)) {
            $pos = $this->collSpyMerchantRelationshipSalesOrderThresholds->search($spyMerchantRelationshipSalesOrderThreshold);
            $this->collSpyMerchantRelationshipSalesOrderThresholds->remove($pos);
            if (null === $this->spyMerchantRelationshipSalesOrderThresholdsScheduledForDeletion) {
                $this->spyMerchantRelationshipSalesOrderThresholdsScheduledForDeletion = clone $this->collSpyMerchantRelationshipSalesOrderThresholds;
                $this->spyMerchantRelationshipSalesOrderThresholdsScheduledForDeletion->clear();
            }
            $this->spyMerchantRelationshipSalesOrderThresholdsScheduledForDeletion[]= clone $spyMerchantRelationshipSalesOrderThreshold;
            $spyMerchantRelationshipSalesOrderThreshold->setStore(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related SpyMerchantRelationshipSalesOrderThresholds from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyMerchantRelationshipSalesOrderThreshold[] List of SpyMerchantRelationshipSalesOrderThreshold objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantRelationshipSalesOrderThreshold}> List of SpyMerchantRelationshipSalesOrderThreshold objects
     */
    public function getSpyMerchantRelationshipSalesOrderThresholdsJoinMerchantRelationship(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyMerchantRelationshipSalesOrderThresholdQuery::create(null, $criteria);
        $query->joinWith('MerchantRelationship', $joinBehavior);

        return $this->getSpyMerchantRelationshipSalesOrderThresholds($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related SpyMerchantRelationshipSalesOrderThresholds from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyMerchantRelationshipSalesOrderThreshold[] List of SpyMerchantRelationshipSalesOrderThreshold objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantRelationshipSalesOrderThreshold}> List of SpyMerchantRelationshipSalesOrderThreshold objects
     */
    public function getSpyMerchantRelationshipSalesOrderThresholdsJoinSalesOrderThresholdType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyMerchantRelationshipSalesOrderThresholdQuery::create(null, $criteria);
        $query->joinWith('SalesOrderThresholdType', $joinBehavior);

        return $this->getSpyMerchantRelationshipSalesOrderThresholds($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related SpyMerchantRelationshipSalesOrderThresholds from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyMerchantRelationshipSalesOrderThreshold[] List of SpyMerchantRelationshipSalesOrderThreshold objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantRelationshipSalesOrderThreshold}> List of SpyMerchantRelationshipSalesOrderThreshold objects
     */
    public function getSpyMerchantRelationshipSalesOrderThresholdsJoinCurrency(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyMerchantRelationshipSalesOrderThresholdQuery::create(null, $criteria);
        $query->joinWith('Currency', $joinBehavior);

        return $this->getSpyMerchantRelationshipSalesOrderThresholds($query, $con);
    }

    /**
     * Clears out the collOmsProductReservations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOmsProductReservations()
     */
    public function clearOmsProductReservations()
    {
        $this->collOmsProductReservations = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOmsProductReservations collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOmsProductReservations($v = true): void
    {
        $this->collOmsProductReservationsPartial = $v;
    }

    /**
     * Initializes the collOmsProductReservations collection.
     *
     * By default this just sets the collOmsProductReservations collection to an empty array (like clearcollOmsProductReservations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOmsProductReservations(bool $overrideExisting = true): void
    {
        if (null !== $this->collOmsProductReservations && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyOmsProductReservationTableMap::getTableMap()->getCollectionClassName();

        $this->collOmsProductReservations = new $collectionClassName;
        $this->collOmsProductReservations->setModel('\Orm\Zed\Oms\Persistence\SpyOmsProductReservation');
    }

    /**
     * Gets an array of SpyOmsProductReservation objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyOmsProductReservation[] List of SpyOmsProductReservation objects
     * @phpstan-return ObjectCollection&\Traversable<SpyOmsProductReservation> List of SpyOmsProductReservation objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOmsProductReservations(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOmsProductReservationsPartial && !$this->isNew();
        if (null === $this->collOmsProductReservations || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOmsProductReservations) {
                    $this->initOmsProductReservations();
                } else {
                    $collectionClassName = SpyOmsProductReservationTableMap::getTableMap()->getCollectionClassName();

                    $collOmsProductReservations = new $collectionClassName;
                    $collOmsProductReservations->setModel('\Orm\Zed\Oms\Persistence\SpyOmsProductReservation');

                    return $collOmsProductReservations;
                }
            } else {
                $collOmsProductReservations = SpyOmsProductReservationQuery::create(null, $criteria)
                    ->filterByStore($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOmsProductReservationsPartial && count($collOmsProductReservations)) {
                        $this->initOmsProductReservations(false);

                        foreach ($collOmsProductReservations as $obj) {
                            if (false == $this->collOmsProductReservations->contains($obj)) {
                                $this->collOmsProductReservations->append($obj);
                            }
                        }

                        $this->collOmsProductReservationsPartial = true;
                    }

                    return $collOmsProductReservations;
                }

                if ($partial && $this->collOmsProductReservations) {
                    foreach ($this->collOmsProductReservations as $obj) {
                        if ($obj->isNew()) {
                            $collOmsProductReservations[] = $obj;
                        }
                    }
                }

                $this->collOmsProductReservations = $collOmsProductReservations;
                $this->collOmsProductReservationsPartial = false;
            }
        }

        return $this->collOmsProductReservations;
    }

    /**
     * Sets a collection of SpyOmsProductReservation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $omsProductReservations A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOmsProductReservations(Collection $omsProductReservations, ?ConnectionInterface $con = null)
    {
        /** @var SpyOmsProductReservation[] $omsProductReservationsToDelete */
        $omsProductReservationsToDelete = $this->getOmsProductReservations(new Criteria(), $con)->diff($omsProductReservations);


        $this->omsProductReservationsScheduledForDeletion = $omsProductReservationsToDelete;

        foreach ($omsProductReservationsToDelete as $omsProductReservationRemoved) {
            $omsProductReservationRemoved->setStore(null);
        }

        $this->collOmsProductReservations = null;
        foreach ($omsProductReservations as $omsProductReservation) {
            $this->addOmsProductReservation($omsProductReservation);
        }

        $this->collOmsProductReservations = $omsProductReservations;
        $this->collOmsProductReservationsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyOmsProductReservation objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyOmsProductReservation objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOmsProductReservations(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOmsProductReservationsPartial && !$this->isNew();
        if (null === $this->collOmsProductReservations || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOmsProductReservations) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOmsProductReservations());
            }

            $query = SpyOmsProductReservationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStore($this)
                ->count($con);
        }

        return count($this->collOmsProductReservations);
    }

    /**
     * Method called to associate a SpyOmsProductReservation object to this object
     * through the SpyOmsProductReservation foreign key attribute.
     *
     * @param SpyOmsProductReservation $l SpyOmsProductReservation
     * @return $this The current object (for fluent API support)
     */
    public function addOmsProductReservation(SpyOmsProductReservation $l)
    {
        if ($this->collOmsProductReservations === null) {
            $this->initOmsProductReservations();
            $this->collOmsProductReservationsPartial = true;
        }

        if (!$this->collOmsProductReservations->contains($l)) {
            $this->doAddOmsProductReservation($l);

            if ($this->omsProductReservationsScheduledForDeletion and $this->omsProductReservationsScheduledForDeletion->contains($l)) {
                $this->omsProductReservationsScheduledForDeletion->remove($this->omsProductReservationsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyOmsProductReservation $omsProductReservation The SpyOmsProductReservation object to add.
     */
    protected function doAddOmsProductReservation(SpyOmsProductReservation $omsProductReservation): void
    {
        $this->collOmsProductReservations[]= $omsProductReservation;
        $omsProductReservation->setStore($this);
    }

    /**
     * @param SpyOmsProductReservation $omsProductReservation The SpyOmsProductReservation object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOmsProductReservation(SpyOmsProductReservation $omsProductReservation)
    {
        if ($this->getOmsProductReservations()->contains($omsProductReservation)) {
            $pos = $this->collOmsProductReservations->search($omsProductReservation);
            $this->collOmsProductReservations->remove($pos);
            if (null === $this->omsProductReservationsScheduledForDeletion) {
                $this->omsProductReservationsScheduledForDeletion = clone $this->collOmsProductReservations;
                $this->omsProductReservationsScheduledForDeletion->clear();
            }
            $this->omsProductReservationsScheduledForDeletion[]= $omsProductReservation;
            $omsProductReservation->setStore(null);
        }

        return $this;
    }

    /**
     * Clears out the collOmsProductOfferReservations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOmsProductOfferReservations()
     */
    public function clearOmsProductOfferReservations()
    {
        $this->collOmsProductOfferReservations = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOmsProductOfferReservations collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOmsProductOfferReservations($v = true): void
    {
        $this->collOmsProductOfferReservationsPartial = $v;
    }

    /**
     * Initializes the collOmsProductOfferReservations collection.
     *
     * By default this just sets the collOmsProductOfferReservations collection to an empty array (like clearcollOmsProductOfferReservations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOmsProductOfferReservations(bool $overrideExisting = true): void
    {
        if (null !== $this->collOmsProductOfferReservations && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyOmsProductOfferReservationTableMap::getTableMap()->getCollectionClassName();

        $this->collOmsProductOfferReservations = new $collectionClassName;
        $this->collOmsProductOfferReservations->setModel('\Orm\Zed\OmsProductOfferReservation\Persistence\SpyOmsProductOfferReservation');
    }

    /**
     * Gets an array of SpyOmsProductOfferReservation objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyOmsProductOfferReservation[] List of SpyOmsProductOfferReservation objects
     * @phpstan-return ObjectCollection&\Traversable<SpyOmsProductOfferReservation> List of SpyOmsProductOfferReservation objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOmsProductOfferReservations(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOmsProductOfferReservationsPartial && !$this->isNew();
        if (null === $this->collOmsProductOfferReservations || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOmsProductOfferReservations) {
                    $this->initOmsProductOfferReservations();
                } else {
                    $collectionClassName = SpyOmsProductOfferReservationTableMap::getTableMap()->getCollectionClassName();

                    $collOmsProductOfferReservations = new $collectionClassName;
                    $collOmsProductOfferReservations->setModel('\Orm\Zed\OmsProductOfferReservation\Persistence\SpyOmsProductOfferReservation');

                    return $collOmsProductOfferReservations;
                }
            } else {
                $collOmsProductOfferReservations = SpyOmsProductOfferReservationQuery::create(null, $criteria)
                    ->filterByStore($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOmsProductOfferReservationsPartial && count($collOmsProductOfferReservations)) {
                        $this->initOmsProductOfferReservations(false);

                        foreach ($collOmsProductOfferReservations as $obj) {
                            if (false == $this->collOmsProductOfferReservations->contains($obj)) {
                                $this->collOmsProductOfferReservations->append($obj);
                            }
                        }

                        $this->collOmsProductOfferReservationsPartial = true;
                    }

                    return $collOmsProductOfferReservations;
                }

                if ($partial && $this->collOmsProductOfferReservations) {
                    foreach ($this->collOmsProductOfferReservations as $obj) {
                        if ($obj->isNew()) {
                            $collOmsProductOfferReservations[] = $obj;
                        }
                    }
                }

                $this->collOmsProductOfferReservations = $collOmsProductOfferReservations;
                $this->collOmsProductOfferReservationsPartial = false;
            }
        }

        return $this->collOmsProductOfferReservations;
    }

    /**
     * Sets a collection of SpyOmsProductOfferReservation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $omsProductOfferReservations A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOmsProductOfferReservations(Collection $omsProductOfferReservations, ?ConnectionInterface $con = null)
    {
        /** @var SpyOmsProductOfferReservation[] $omsProductOfferReservationsToDelete */
        $omsProductOfferReservationsToDelete = $this->getOmsProductOfferReservations(new Criteria(), $con)->diff($omsProductOfferReservations);


        $this->omsProductOfferReservationsScheduledForDeletion = $omsProductOfferReservationsToDelete;

        foreach ($omsProductOfferReservationsToDelete as $omsProductOfferReservationRemoved) {
            $omsProductOfferReservationRemoved->setStore(null);
        }

        $this->collOmsProductOfferReservations = null;
        foreach ($omsProductOfferReservations as $omsProductOfferReservation) {
            $this->addOmsProductOfferReservation($omsProductOfferReservation);
        }

        $this->collOmsProductOfferReservations = $omsProductOfferReservations;
        $this->collOmsProductOfferReservationsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyOmsProductOfferReservation objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyOmsProductOfferReservation objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOmsProductOfferReservations(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOmsProductOfferReservationsPartial && !$this->isNew();
        if (null === $this->collOmsProductOfferReservations || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOmsProductOfferReservations) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOmsProductOfferReservations());
            }

            $query = SpyOmsProductOfferReservationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStore($this)
                ->count($con);
        }

        return count($this->collOmsProductOfferReservations);
    }

    /**
     * Method called to associate a SpyOmsProductOfferReservation object to this object
     * through the SpyOmsProductOfferReservation foreign key attribute.
     *
     * @param SpyOmsProductOfferReservation $l SpyOmsProductOfferReservation
     * @return $this The current object (for fluent API support)
     */
    public function addOmsProductOfferReservation(SpyOmsProductOfferReservation $l)
    {
        if ($this->collOmsProductOfferReservations === null) {
            $this->initOmsProductOfferReservations();
            $this->collOmsProductOfferReservationsPartial = true;
        }

        if (!$this->collOmsProductOfferReservations->contains($l)) {
            $this->doAddOmsProductOfferReservation($l);

            if ($this->omsProductOfferReservationsScheduledForDeletion and $this->omsProductOfferReservationsScheduledForDeletion->contains($l)) {
                $this->omsProductOfferReservationsScheduledForDeletion->remove($this->omsProductOfferReservationsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyOmsProductOfferReservation $omsProductOfferReservation The SpyOmsProductOfferReservation object to add.
     */
    protected function doAddOmsProductOfferReservation(SpyOmsProductOfferReservation $omsProductOfferReservation): void
    {
        $this->collOmsProductOfferReservations[]= $omsProductOfferReservation;
        $omsProductOfferReservation->setStore($this);
    }

    /**
     * @param SpyOmsProductOfferReservation $omsProductOfferReservation The SpyOmsProductOfferReservation object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOmsProductOfferReservation(SpyOmsProductOfferReservation $omsProductOfferReservation)
    {
        if ($this->getOmsProductOfferReservations()->contains($omsProductOfferReservation)) {
            $pos = $this->collOmsProductOfferReservations->search($omsProductOfferReservation);
            $this->collOmsProductOfferReservations->remove($pos);
            if (null === $this->omsProductOfferReservationsScheduledForDeletion) {
                $this->omsProductOfferReservationsScheduledForDeletion = clone $this->collOmsProductOfferReservations;
                $this->omsProductOfferReservationsScheduledForDeletion->clear();
            }
            $this->omsProductOfferReservationsScheduledForDeletion[]= $omsProductOfferReservation;
            $omsProductOfferReservation->setStore(null);
        }

        return $this;
    }

    /**
     * Clears out the collSpyPaymentMethodStores collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyPaymentMethodStores()
     */
    public function clearSpyPaymentMethodStores()
    {
        $this->collSpyPaymentMethodStores = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyPaymentMethodStores collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyPaymentMethodStores($v = true): void
    {
        $this->collSpyPaymentMethodStoresPartial = $v;
    }

    /**
     * Initializes the collSpyPaymentMethodStores collection.
     *
     * By default this just sets the collSpyPaymentMethodStores collection to an empty array (like clearcollSpyPaymentMethodStores());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyPaymentMethodStores(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyPaymentMethodStores && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyPaymentMethodStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyPaymentMethodStores = new $collectionClassName;
        $this->collSpyPaymentMethodStores->setModel('\Orm\Zed\Payment\Persistence\SpyPaymentMethodStore');
    }

    /**
     * Gets an array of SpyPaymentMethodStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyPaymentMethodStore[] List of SpyPaymentMethodStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyPaymentMethodStore> List of SpyPaymentMethodStore objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyPaymentMethodStores(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyPaymentMethodStoresPartial && !$this->isNew();
        if (null === $this->collSpyPaymentMethodStores || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyPaymentMethodStores) {
                    $this->initSpyPaymentMethodStores();
                } else {
                    $collectionClassName = SpyPaymentMethodStoreTableMap::getTableMap()->getCollectionClassName();

                    $collSpyPaymentMethodStores = new $collectionClassName;
                    $collSpyPaymentMethodStores->setModel('\Orm\Zed\Payment\Persistence\SpyPaymentMethodStore');

                    return $collSpyPaymentMethodStores;
                }
            } else {
                $collSpyPaymentMethodStores = SpyPaymentMethodStoreQuery::create(null, $criteria)
                    ->filterBySpyStore($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyPaymentMethodStoresPartial && count($collSpyPaymentMethodStores)) {
                        $this->initSpyPaymentMethodStores(false);

                        foreach ($collSpyPaymentMethodStores as $obj) {
                            if (false == $this->collSpyPaymentMethodStores->contains($obj)) {
                                $this->collSpyPaymentMethodStores->append($obj);
                            }
                        }

                        $this->collSpyPaymentMethodStoresPartial = true;
                    }

                    return $collSpyPaymentMethodStores;
                }

                if ($partial && $this->collSpyPaymentMethodStores) {
                    foreach ($this->collSpyPaymentMethodStores as $obj) {
                        if ($obj->isNew()) {
                            $collSpyPaymentMethodStores[] = $obj;
                        }
                    }
                }

                $this->collSpyPaymentMethodStores = $collSpyPaymentMethodStores;
                $this->collSpyPaymentMethodStoresPartial = false;
            }
        }

        return $this->collSpyPaymentMethodStores;
    }

    /**
     * Sets a collection of SpyPaymentMethodStore objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyPaymentMethodStores A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyPaymentMethodStores(Collection $spyPaymentMethodStores, ?ConnectionInterface $con = null)
    {
        /** @var SpyPaymentMethodStore[] $spyPaymentMethodStoresToDelete */
        $spyPaymentMethodStoresToDelete = $this->getSpyPaymentMethodStores(new Criteria(), $con)->diff($spyPaymentMethodStores);


        $this->spyPaymentMethodStoresScheduledForDeletion = $spyPaymentMethodStoresToDelete;

        foreach ($spyPaymentMethodStoresToDelete as $spyPaymentMethodStoreRemoved) {
            $spyPaymentMethodStoreRemoved->setSpyStore(null);
        }

        $this->collSpyPaymentMethodStores = null;
        foreach ($spyPaymentMethodStores as $spyPaymentMethodStore) {
            $this->addSpyPaymentMethodStore($spyPaymentMethodStore);
        }

        $this->collSpyPaymentMethodStores = $spyPaymentMethodStores;
        $this->collSpyPaymentMethodStoresPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyPaymentMethodStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyPaymentMethodStore objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyPaymentMethodStores(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyPaymentMethodStoresPartial && !$this->isNew();
        if (null === $this->collSpyPaymentMethodStores || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyPaymentMethodStores) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyPaymentMethodStores());
            }

            $query = SpyPaymentMethodStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyStore($this)
                ->count($con);
        }

        return count($this->collSpyPaymentMethodStores);
    }

    /**
     * Method called to associate a SpyPaymentMethodStore object to this object
     * through the SpyPaymentMethodStore foreign key attribute.
     *
     * @param SpyPaymentMethodStore $l SpyPaymentMethodStore
     * @return $this The current object (for fluent API support)
     */
    public function addSpyPaymentMethodStore(SpyPaymentMethodStore $l)
    {
        if ($this->collSpyPaymentMethodStores === null) {
            $this->initSpyPaymentMethodStores();
            $this->collSpyPaymentMethodStoresPartial = true;
        }

        if (!$this->collSpyPaymentMethodStores->contains($l)) {
            $this->doAddSpyPaymentMethodStore($l);

            if ($this->spyPaymentMethodStoresScheduledForDeletion and $this->spyPaymentMethodStoresScheduledForDeletion->contains($l)) {
                $this->spyPaymentMethodStoresScheduledForDeletion->remove($this->spyPaymentMethodStoresScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyPaymentMethodStore $spyPaymentMethodStore The SpyPaymentMethodStore object to add.
     */
    protected function doAddSpyPaymentMethodStore(SpyPaymentMethodStore $spyPaymentMethodStore): void
    {
        $this->collSpyPaymentMethodStores[]= $spyPaymentMethodStore;
        $spyPaymentMethodStore->setSpyStore($this);
    }

    /**
     * @param SpyPaymentMethodStore $spyPaymentMethodStore The SpyPaymentMethodStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyPaymentMethodStore(SpyPaymentMethodStore $spyPaymentMethodStore)
    {
        if ($this->getSpyPaymentMethodStores()->contains($spyPaymentMethodStore)) {
            $pos = $this->collSpyPaymentMethodStores->search($spyPaymentMethodStore);
            $this->collSpyPaymentMethodStores->remove($pos);
            if (null === $this->spyPaymentMethodStoresScheduledForDeletion) {
                $this->spyPaymentMethodStoresScheduledForDeletion = clone $this->collSpyPaymentMethodStores;
                $this->spyPaymentMethodStoresScheduledForDeletion->clear();
            }
            $this->spyPaymentMethodStoresScheduledForDeletion[]= clone $spyPaymentMethodStore;
            $spyPaymentMethodStore->setSpyStore(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related SpyPaymentMethodStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyPaymentMethodStore[] List of SpyPaymentMethodStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyPaymentMethodStore}> List of SpyPaymentMethodStore objects
     */
    public function getSpyPaymentMethodStoresJoinSpyPaymentMethod(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyPaymentMethodStoreQuery::create(null, $criteria);
        $query->joinWith('SpyPaymentMethod', $joinBehavior);

        return $this->getSpyPaymentMethodStores($query, $con);
    }

    /**
     * Clears out the collPriceProductStores collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addPriceProductStores()
     */
    public function clearPriceProductStores()
    {
        $this->collPriceProductStores = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collPriceProductStores collection loaded partially.
     *
     * @return void
     */
    public function resetPartialPriceProductStores($v = true): void
    {
        $this->collPriceProductStoresPartial = $v;
    }

    /**
     * Initializes the collPriceProductStores collection.
     *
     * By default this just sets the collPriceProductStores collection to an empty array (like clearcollPriceProductStores());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPriceProductStores(bool $overrideExisting = true): void
    {
        if (null !== $this->collPriceProductStores && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyPriceProductStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collPriceProductStores = new $collectionClassName;
        $this->collPriceProductStores->setModel('\Orm\Zed\PriceProduct\Persistence\SpyPriceProductStore');
    }

    /**
     * Gets an array of SpyPriceProductStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyPriceProductStore[] List of SpyPriceProductStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyPriceProductStore> List of SpyPriceProductStore objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getPriceProductStores(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collPriceProductStoresPartial && !$this->isNew();
        if (null === $this->collPriceProductStores || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collPriceProductStores) {
                    $this->initPriceProductStores();
                } else {
                    $collectionClassName = SpyPriceProductStoreTableMap::getTableMap()->getCollectionClassName();

                    $collPriceProductStores = new $collectionClassName;
                    $collPriceProductStores->setModel('\Orm\Zed\PriceProduct\Persistence\SpyPriceProductStore');

                    return $collPriceProductStores;
                }
            } else {
                $collPriceProductStores = SpyPriceProductStoreQuery::create(null, $criteria)
                    ->filterByStore($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPriceProductStoresPartial && count($collPriceProductStores)) {
                        $this->initPriceProductStores(false);

                        foreach ($collPriceProductStores as $obj) {
                            if (false == $this->collPriceProductStores->contains($obj)) {
                                $this->collPriceProductStores->append($obj);
                            }
                        }

                        $this->collPriceProductStoresPartial = true;
                    }

                    return $collPriceProductStores;
                }

                if ($partial && $this->collPriceProductStores) {
                    foreach ($this->collPriceProductStores as $obj) {
                        if ($obj->isNew()) {
                            $collPriceProductStores[] = $obj;
                        }
                    }
                }

                $this->collPriceProductStores = $collPriceProductStores;
                $this->collPriceProductStoresPartial = false;
            }
        }

        return $this->collPriceProductStores;
    }

    /**
     * Sets a collection of SpyPriceProductStore objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $priceProductStores A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setPriceProductStores(Collection $priceProductStores, ?ConnectionInterface $con = null)
    {
        /** @var SpyPriceProductStore[] $priceProductStoresToDelete */
        $priceProductStoresToDelete = $this->getPriceProductStores(new Criteria(), $con)->diff($priceProductStores);


        $this->priceProductStoresScheduledForDeletion = $priceProductStoresToDelete;

        foreach ($priceProductStoresToDelete as $priceProductStoreRemoved) {
            $priceProductStoreRemoved->setStore(null);
        }

        $this->collPriceProductStores = null;
        foreach ($priceProductStores as $priceProductStore) {
            $this->addPriceProductStore($priceProductStore);
        }

        $this->collPriceProductStores = $priceProductStores;
        $this->collPriceProductStoresPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyPriceProductStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyPriceProductStore objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countPriceProductStores(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collPriceProductStoresPartial && !$this->isNew();
        if (null === $this->collPriceProductStores || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPriceProductStores) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPriceProductStores());
            }

            $query = SpyPriceProductStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStore($this)
                ->count($con);
        }

        return count($this->collPriceProductStores);
    }

    /**
     * Method called to associate a SpyPriceProductStore object to this object
     * through the SpyPriceProductStore foreign key attribute.
     *
     * @param SpyPriceProductStore $l SpyPriceProductStore
     * @return $this The current object (for fluent API support)
     */
    public function addPriceProductStore(SpyPriceProductStore $l)
    {
        if ($this->collPriceProductStores === null) {
            $this->initPriceProductStores();
            $this->collPriceProductStoresPartial = true;
        }

        if (!$this->collPriceProductStores->contains($l)) {
            $this->doAddPriceProductStore($l);

            if ($this->priceProductStoresScheduledForDeletion and $this->priceProductStoresScheduledForDeletion->contains($l)) {
                $this->priceProductStoresScheduledForDeletion->remove($this->priceProductStoresScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyPriceProductStore $priceProductStore The SpyPriceProductStore object to add.
     */
    protected function doAddPriceProductStore(SpyPriceProductStore $priceProductStore): void
    {
        $this->collPriceProductStores[]= $priceProductStore;
        $priceProductStore->setStore($this);
    }

    /**
     * @param SpyPriceProductStore $priceProductStore The SpyPriceProductStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removePriceProductStore(SpyPriceProductStore $priceProductStore)
    {
        if ($this->getPriceProductStores()->contains($priceProductStore)) {
            $pos = $this->collPriceProductStores->search($priceProductStore);
            $this->collPriceProductStores->remove($pos);
            if (null === $this->priceProductStoresScheduledForDeletion) {
                $this->priceProductStoresScheduledForDeletion = clone $this->collPriceProductStores;
                $this->priceProductStoresScheduledForDeletion->clear();
            }
            $this->priceProductStoresScheduledForDeletion[]= $priceProductStore;
            $priceProductStore->setStore(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related PriceProductStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyPriceProductStore[] List of SpyPriceProductStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyPriceProductStore}> List of SpyPriceProductStore objects
     */
    public function getPriceProductStoresJoinCurrency(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyPriceProductStoreQuery::create(null, $criteria);
        $query->joinWith('Currency', $joinBehavior);

        return $this->getPriceProductStores($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related PriceProductStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyPriceProductStore[] List of SpyPriceProductStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyPriceProductStore}> List of SpyPriceProductStore objects
     */
    public function getPriceProductStoresJoinPriceProduct(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyPriceProductStoreQuery::create(null, $criteria);
        $query->joinWith('PriceProduct', $joinBehavior);

        return $this->getPriceProductStores($query, $con);
    }

    /**
     * Clears out the collPriceProductSchedules collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addPriceProductSchedules()
     */
    public function clearPriceProductSchedules()
    {
        $this->collPriceProductSchedules = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collPriceProductSchedules collection loaded partially.
     *
     * @return void
     */
    public function resetPartialPriceProductSchedules($v = true): void
    {
        $this->collPriceProductSchedulesPartial = $v;
    }

    /**
     * Initializes the collPriceProductSchedules collection.
     *
     * By default this just sets the collPriceProductSchedules collection to an empty array (like clearcollPriceProductSchedules());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPriceProductSchedules(bool $overrideExisting = true): void
    {
        if (null !== $this->collPriceProductSchedules && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyPriceProductScheduleTableMap::getTableMap()->getCollectionClassName();

        $this->collPriceProductSchedules = new $collectionClassName;
        $this->collPriceProductSchedules->setModel('\Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductSchedule');
    }

    /**
     * Gets an array of SpyPriceProductSchedule objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyPriceProductSchedule[] List of SpyPriceProductSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<SpyPriceProductSchedule> List of SpyPriceProductSchedule objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getPriceProductSchedules(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collPriceProductSchedulesPartial && !$this->isNew();
        if (null === $this->collPriceProductSchedules || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collPriceProductSchedules) {
                    $this->initPriceProductSchedules();
                } else {
                    $collectionClassName = SpyPriceProductScheduleTableMap::getTableMap()->getCollectionClassName();

                    $collPriceProductSchedules = new $collectionClassName;
                    $collPriceProductSchedules->setModel('\Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductSchedule');

                    return $collPriceProductSchedules;
                }
            } else {
                $collPriceProductSchedules = SpyPriceProductScheduleQuery::create(null, $criteria)
                    ->filterByStore($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPriceProductSchedulesPartial && count($collPriceProductSchedules)) {
                        $this->initPriceProductSchedules(false);

                        foreach ($collPriceProductSchedules as $obj) {
                            if (false == $this->collPriceProductSchedules->contains($obj)) {
                                $this->collPriceProductSchedules->append($obj);
                            }
                        }

                        $this->collPriceProductSchedulesPartial = true;
                    }

                    return $collPriceProductSchedules;
                }

                if ($partial && $this->collPriceProductSchedules) {
                    foreach ($this->collPriceProductSchedules as $obj) {
                        if ($obj->isNew()) {
                            $collPriceProductSchedules[] = $obj;
                        }
                    }
                }

                $this->collPriceProductSchedules = $collPriceProductSchedules;
                $this->collPriceProductSchedulesPartial = false;
            }
        }

        return $this->collPriceProductSchedules;
    }

    /**
     * Sets a collection of SpyPriceProductSchedule objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $priceProductSchedules A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setPriceProductSchedules(Collection $priceProductSchedules, ?ConnectionInterface $con = null)
    {
        /** @var SpyPriceProductSchedule[] $priceProductSchedulesToDelete */
        $priceProductSchedulesToDelete = $this->getPriceProductSchedules(new Criteria(), $con)->diff($priceProductSchedules);


        $this->priceProductSchedulesScheduledForDeletion = $priceProductSchedulesToDelete;

        foreach ($priceProductSchedulesToDelete as $priceProductScheduleRemoved) {
            $priceProductScheduleRemoved->setStore(null);
        }

        $this->collPriceProductSchedules = null;
        foreach ($priceProductSchedules as $priceProductSchedule) {
            $this->addPriceProductSchedule($priceProductSchedule);
        }

        $this->collPriceProductSchedules = $priceProductSchedules;
        $this->collPriceProductSchedulesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyPriceProductSchedule objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyPriceProductSchedule objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countPriceProductSchedules(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collPriceProductSchedulesPartial && !$this->isNew();
        if (null === $this->collPriceProductSchedules || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPriceProductSchedules) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPriceProductSchedules());
            }

            $query = SpyPriceProductScheduleQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStore($this)
                ->count($con);
        }

        return count($this->collPriceProductSchedules);
    }

    /**
     * Method called to associate a SpyPriceProductSchedule object to this object
     * through the SpyPriceProductSchedule foreign key attribute.
     *
     * @param SpyPriceProductSchedule $l SpyPriceProductSchedule
     * @return $this The current object (for fluent API support)
     */
    public function addPriceProductSchedule(SpyPriceProductSchedule $l)
    {
        if ($this->collPriceProductSchedules === null) {
            $this->initPriceProductSchedules();
            $this->collPriceProductSchedulesPartial = true;
        }

        if (!$this->collPriceProductSchedules->contains($l)) {
            $this->doAddPriceProductSchedule($l);

            if ($this->priceProductSchedulesScheduledForDeletion and $this->priceProductSchedulesScheduledForDeletion->contains($l)) {
                $this->priceProductSchedulesScheduledForDeletion->remove($this->priceProductSchedulesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyPriceProductSchedule $priceProductSchedule The SpyPriceProductSchedule object to add.
     */
    protected function doAddPriceProductSchedule(SpyPriceProductSchedule $priceProductSchedule): void
    {
        $this->collPriceProductSchedules[]= $priceProductSchedule;
        $priceProductSchedule->setStore($this);
    }

    /**
     * @param SpyPriceProductSchedule $priceProductSchedule The SpyPriceProductSchedule object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removePriceProductSchedule(SpyPriceProductSchedule $priceProductSchedule)
    {
        if ($this->getPriceProductSchedules()->contains($priceProductSchedule)) {
            $pos = $this->collPriceProductSchedules->search($priceProductSchedule);
            $this->collPriceProductSchedules->remove($pos);
            if (null === $this->priceProductSchedulesScheduledForDeletion) {
                $this->priceProductSchedulesScheduledForDeletion = clone $this->collPriceProductSchedules;
                $this->priceProductSchedulesScheduledForDeletion->clear();
            }
            $this->priceProductSchedulesScheduledForDeletion[]= clone $priceProductSchedule;
            $priceProductSchedule->setStore(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related PriceProductSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyPriceProductSchedule[] List of SpyPriceProductSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<SpyPriceProductSchedule}> List of SpyPriceProductSchedule objects
     */
    public function getPriceProductSchedulesJoinProduct(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyPriceProductScheduleQuery::create(null, $criteria);
        $query->joinWith('Product', $joinBehavior);

        return $this->getPriceProductSchedules($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related PriceProductSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyPriceProductSchedule[] List of SpyPriceProductSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<SpyPriceProductSchedule}> List of SpyPriceProductSchedule objects
     */
    public function getPriceProductSchedulesJoinProductAbstract(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyPriceProductScheduleQuery::create(null, $criteria);
        $query->joinWith('ProductAbstract', $joinBehavior);

        return $this->getPriceProductSchedules($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related PriceProductSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyPriceProductSchedule[] List of SpyPriceProductSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<SpyPriceProductSchedule}> List of SpyPriceProductSchedule objects
     */
    public function getPriceProductSchedulesJoinCurrency(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyPriceProductScheduleQuery::create(null, $criteria);
        $query->joinWith('Currency', $joinBehavior);

        return $this->getPriceProductSchedules($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related PriceProductSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyPriceProductSchedule[] List of SpyPriceProductSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<SpyPriceProductSchedule}> List of SpyPriceProductSchedule objects
     */
    public function getPriceProductSchedulesJoinPriceType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyPriceProductScheduleQuery::create(null, $criteria);
        $query->joinWith('PriceType', $joinBehavior);

        return $this->getPriceProductSchedules($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related PriceProductSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyPriceProductSchedule[] List of SpyPriceProductSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<SpyPriceProductSchedule}> List of SpyPriceProductSchedule objects
     */
    public function getPriceProductSchedulesJoinPriceProductScheduleList(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyPriceProductScheduleQuery::create(null, $criteria);
        $query->joinWith('PriceProductScheduleList', $joinBehavior);

        return $this->getPriceProductSchedules($query, $con);
    }

    /**
     * Clears out the collSpyProductAbstractStores collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductAbstractStores()
     */
    public function clearSpyProductAbstractStores()
    {
        $this->collSpyProductAbstractStores = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductAbstractStores collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductAbstractStores($v = true): void
    {
        $this->collSpyProductAbstractStoresPartial = $v;
    }

    /**
     * Initializes the collSpyProductAbstractStores collection.
     *
     * By default this just sets the collSpyProductAbstractStores collection to an empty array (like clearcollSpyProductAbstractStores());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductAbstractStores(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductAbstractStores && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductAbstractStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductAbstractStores = new $collectionClassName;
        $this->collSpyProductAbstractStores->setModel('\Orm\Zed\Product\Persistence\SpyProductAbstractStore');
    }

    /**
     * Gets an array of SpyProductAbstractStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductAbstractStore[] List of SpyProductAbstractStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductAbstractStore> List of SpyProductAbstractStore objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductAbstractStores(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductAbstractStoresPartial && !$this->isNew();
        if (null === $this->collSpyProductAbstractStores || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductAbstractStores) {
                    $this->initSpyProductAbstractStores();
                } else {
                    $collectionClassName = SpyProductAbstractStoreTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductAbstractStores = new $collectionClassName;
                    $collSpyProductAbstractStores->setModel('\Orm\Zed\Product\Persistence\SpyProductAbstractStore');

                    return $collSpyProductAbstractStores;
                }
            } else {
                $collSpyProductAbstractStores = SpyProductAbstractStoreQuery::create(null, $criteria)
                    ->filterBySpyStore($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductAbstractStoresPartial && count($collSpyProductAbstractStores)) {
                        $this->initSpyProductAbstractStores(false);

                        foreach ($collSpyProductAbstractStores as $obj) {
                            if (false == $this->collSpyProductAbstractStores->contains($obj)) {
                                $this->collSpyProductAbstractStores->append($obj);
                            }
                        }

                        $this->collSpyProductAbstractStoresPartial = true;
                    }

                    return $collSpyProductAbstractStores;
                }

                if ($partial && $this->collSpyProductAbstractStores) {
                    foreach ($this->collSpyProductAbstractStores as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductAbstractStores[] = $obj;
                        }
                    }
                }

                $this->collSpyProductAbstractStores = $collSpyProductAbstractStores;
                $this->collSpyProductAbstractStoresPartial = false;
            }
        }

        return $this->collSpyProductAbstractStores;
    }

    /**
     * Sets a collection of SpyProductAbstractStore objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductAbstractStores A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductAbstractStores(Collection $spyProductAbstractStores, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductAbstractStore[] $spyProductAbstractStoresToDelete */
        $spyProductAbstractStoresToDelete = $this->getSpyProductAbstractStores(new Criteria(), $con)->diff($spyProductAbstractStores);


        $this->spyProductAbstractStoresScheduledForDeletion = $spyProductAbstractStoresToDelete;

        foreach ($spyProductAbstractStoresToDelete as $spyProductAbstractStoreRemoved) {
            $spyProductAbstractStoreRemoved->setSpyStore(null);
        }

        $this->collSpyProductAbstractStores = null;
        foreach ($spyProductAbstractStores as $spyProductAbstractStore) {
            $this->addSpyProductAbstractStore($spyProductAbstractStore);
        }

        $this->collSpyProductAbstractStores = $spyProductAbstractStores;
        $this->collSpyProductAbstractStoresPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductAbstractStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductAbstractStore objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductAbstractStores(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductAbstractStoresPartial && !$this->isNew();
        if (null === $this->collSpyProductAbstractStores || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductAbstractStores) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductAbstractStores());
            }

            $query = SpyProductAbstractStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyStore($this)
                ->count($con);
        }

        return count($this->collSpyProductAbstractStores);
    }

    /**
     * Method called to associate a SpyProductAbstractStore object to this object
     * through the SpyProductAbstractStore foreign key attribute.
     *
     * @param SpyProductAbstractStore $l SpyProductAbstractStore
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductAbstractStore(SpyProductAbstractStore $l)
    {
        if ($this->collSpyProductAbstractStores === null) {
            $this->initSpyProductAbstractStores();
            $this->collSpyProductAbstractStoresPartial = true;
        }

        if (!$this->collSpyProductAbstractStores->contains($l)) {
            $this->doAddSpyProductAbstractStore($l);

            if ($this->spyProductAbstractStoresScheduledForDeletion and $this->spyProductAbstractStoresScheduledForDeletion->contains($l)) {
                $this->spyProductAbstractStoresScheduledForDeletion->remove($this->spyProductAbstractStoresScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductAbstractStore $spyProductAbstractStore The SpyProductAbstractStore object to add.
     */
    protected function doAddSpyProductAbstractStore(SpyProductAbstractStore $spyProductAbstractStore): void
    {
        $this->collSpyProductAbstractStores[]= $spyProductAbstractStore;
        $spyProductAbstractStore->setSpyStore($this);
    }

    /**
     * @param SpyProductAbstractStore $spyProductAbstractStore The SpyProductAbstractStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductAbstractStore(SpyProductAbstractStore $spyProductAbstractStore)
    {
        if ($this->getSpyProductAbstractStores()->contains($spyProductAbstractStore)) {
            $pos = $this->collSpyProductAbstractStores->search($spyProductAbstractStore);
            $this->collSpyProductAbstractStores->remove($pos);
            if (null === $this->spyProductAbstractStoresScheduledForDeletion) {
                $this->spyProductAbstractStoresScheduledForDeletion = clone $this->collSpyProductAbstractStores;
                $this->spyProductAbstractStoresScheduledForDeletion->clear();
            }
            $this->spyProductAbstractStoresScheduledForDeletion[]= clone $spyProductAbstractStore;
            $spyProductAbstractStore->setSpyStore(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related SpyProductAbstractStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductAbstractStore[] List of SpyProductAbstractStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductAbstractStore}> List of SpyProductAbstractStore objects
     */
    public function getSpyProductAbstractStoresJoinSpyProductAbstract(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductAbstractStoreQuery::create(null, $criteria);
        $query->joinWith('SpyProductAbstract', $joinBehavior);

        return $this->getSpyProductAbstractStores($query, $con);
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
     * Gets an array of SpyProductLabelStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductLabelStore[] List of SpyProductLabelStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductLabelStore> List of SpyProductLabelStore objects
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
                $collProductLabelStores = SpyProductLabelStoreQuery::create(null, $criteria)
                    ->filterByStore($this)
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
     * Sets a collection of SpyProductLabelStore objects related by a one-to-many relationship
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
        /** @var SpyProductLabelStore[] $productLabelStoresToDelete */
        $productLabelStoresToDelete = $this->getProductLabelStores(new Criteria(), $con)->diff($productLabelStores);


        $this->productLabelStoresScheduledForDeletion = $productLabelStoresToDelete;

        foreach ($productLabelStoresToDelete as $productLabelStoreRemoved) {
            $productLabelStoreRemoved->setStore(null);
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
     * Returns the number of related BaseSpyProductLabelStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductLabelStore objects.
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

            $query = SpyProductLabelStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStore($this)
                ->count($con);
        }

        return count($this->collProductLabelStores);
    }

    /**
     * Method called to associate a SpyProductLabelStore object to this object
     * through the SpyProductLabelStore foreign key attribute.
     *
     * @param SpyProductLabelStore $l SpyProductLabelStore
     * @return $this The current object (for fluent API support)
     */
    public function addProductLabelStore(SpyProductLabelStore $l)
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
     * @param SpyProductLabelStore $productLabelStore The SpyProductLabelStore object to add.
     */
    protected function doAddProductLabelStore(SpyProductLabelStore $productLabelStore): void
    {
        $this->collProductLabelStores[]= $productLabelStore;
        $productLabelStore->setStore($this);
    }

    /**
     * @param SpyProductLabelStore $productLabelStore The SpyProductLabelStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeProductLabelStore(SpyProductLabelStore $productLabelStore)
    {
        if ($this->getProductLabelStores()->contains($productLabelStore)) {
            $pos = $this->collProductLabelStores->search($productLabelStore);
            $this->collProductLabelStores->remove($pos);
            if (null === $this->productLabelStoresScheduledForDeletion) {
                $this->productLabelStoresScheduledForDeletion = clone $this->collProductLabelStores;
                $this->productLabelStoresScheduledForDeletion->clear();
            }
            $this->productLabelStoresScheduledForDeletion[]= clone $productLabelStore;
            $productLabelStore->setStore(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related ProductLabelStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductLabelStore[] List of SpyProductLabelStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductLabelStore}> List of SpyProductLabelStore objects
     */
    public function getProductLabelStoresJoinProductLabel(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductLabelStoreQuery::create(null, $criteria);
        $query->joinWith('ProductLabel', $joinBehavior);

        return $this->getProductLabelStores($query, $con);
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
     * Gets an array of SpyProductMeasurementSalesUnitStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductMeasurementSalesUnitStore[] List of SpyProductMeasurementSalesUnitStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductMeasurementSalesUnitStore> List of SpyProductMeasurementSalesUnitStore objects
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
                $collSpyProductMeasurementSalesUnitStores = SpyProductMeasurementSalesUnitStoreQuery::create(null, $criteria)
                    ->filterBySpyStore($this)
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
     * Sets a collection of SpyProductMeasurementSalesUnitStore objects related by a one-to-many relationship
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
        /** @var SpyProductMeasurementSalesUnitStore[] $spyProductMeasurementSalesUnitStoresToDelete */
        $spyProductMeasurementSalesUnitStoresToDelete = $this->getSpyProductMeasurementSalesUnitStores(new Criteria(), $con)->diff($spyProductMeasurementSalesUnitStores);


        $this->spyProductMeasurementSalesUnitStoresScheduledForDeletion = $spyProductMeasurementSalesUnitStoresToDelete;

        foreach ($spyProductMeasurementSalesUnitStoresToDelete as $spyProductMeasurementSalesUnitStoreRemoved) {
            $spyProductMeasurementSalesUnitStoreRemoved->setSpyStore(null);
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
     * Returns the number of related BaseSpyProductMeasurementSalesUnitStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductMeasurementSalesUnitStore objects.
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

            $query = SpyProductMeasurementSalesUnitStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyStore($this)
                ->count($con);
        }

        return count($this->collSpyProductMeasurementSalesUnitStores);
    }

    /**
     * Method called to associate a SpyProductMeasurementSalesUnitStore object to this object
     * through the SpyProductMeasurementSalesUnitStore foreign key attribute.
     *
     * @param SpyProductMeasurementSalesUnitStore $l SpyProductMeasurementSalesUnitStore
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductMeasurementSalesUnitStore(SpyProductMeasurementSalesUnitStore $l)
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
     * @param SpyProductMeasurementSalesUnitStore $spyProductMeasurementSalesUnitStore The SpyProductMeasurementSalesUnitStore object to add.
     */
    protected function doAddSpyProductMeasurementSalesUnitStore(SpyProductMeasurementSalesUnitStore $spyProductMeasurementSalesUnitStore): void
    {
        $this->collSpyProductMeasurementSalesUnitStores[]= $spyProductMeasurementSalesUnitStore;
        $spyProductMeasurementSalesUnitStore->setSpyStore($this);
    }

    /**
     * @param SpyProductMeasurementSalesUnitStore $spyProductMeasurementSalesUnitStore The SpyProductMeasurementSalesUnitStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductMeasurementSalesUnitStore(SpyProductMeasurementSalesUnitStore $spyProductMeasurementSalesUnitStore)
    {
        if ($this->getSpyProductMeasurementSalesUnitStores()->contains($spyProductMeasurementSalesUnitStore)) {
            $pos = $this->collSpyProductMeasurementSalesUnitStores->search($spyProductMeasurementSalesUnitStore);
            $this->collSpyProductMeasurementSalesUnitStores->remove($pos);
            if (null === $this->spyProductMeasurementSalesUnitStoresScheduledForDeletion) {
                $this->spyProductMeasurementSalesUnitStoresScheduledForDeletion = clone $this->collSpyProductMeasurementSalesUnitStores;
                $this->spyProductMeasurementSalesUnitStoresScheduledForDeletion->clear();
            }
            $this->spyProductMeasurementSalesUnitStoresScheduledForDeletion[]= clone $spyProductMeasurementSalesUnitStore;
            $spyProductMeasurementSalesUnitStore->setSpyStore(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related SpyProductMeasurementSalesUnitStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductMeasurementSalesUnitStore[] List of SpyProductMeasurementSalesUnitStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductMeasurementSalesUnitStore}> List of SpyProductMeasurementSalesUnitStore objects
     */
    public function getSpyProductMeasurementSalesUnitStoresJoinSpyProductMeasurementSalesUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductMeasurementSalesUnitStoreQuery::create(null, $criteria);
        $query->joinWith('SpyProductMeasurementSalesUnit', $joinBehavior);

        return $this->getSpyProductMeasurementSalesUnitStores($query, $con);
    }

    /**
     * Clears out the collSpyProductOfferStores collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductOfferStores()
     */
    public function clearSpyProductOfferStores()
    {
        $this->collSpyProductOfferStores = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductOfferStores collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductOfferStores($v = true): void
    {
        $this->collSpyProductOfferStoresPartial = $v;
    }

    /**
     * Initializes the collSpyProductOfferStores collection.
     *
     * By default this just sets the collSpyProductOfferStores collection to an empty array (like clearcollSpyProductOfferStores());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductOfferStores(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductOfferStores && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductOfferStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductOfferStores = new $collectionClassName;
        $this->collSpyProductOfferStores->setModel('\Orm\Zed\ProductOffer\Persistence\SpyProductOfferStore');
    }

    /**
     * Gets an array of SpyProductOfferStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductOfferStore[] List of SpyProductOfferStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductOfferStore> List of SpyProductOfferStore objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductOfferStores(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductOfferStoresPartial && !$this->isNew();
        if (null === $this->collSpyProductOfferStores || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductOfferStores) {
                    $this->initSpyProductOfferStores();
                } else {
                    $collectionClassName = SpyProductOfferStoreTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductOfferStores = new $collectionClassName;
                    $collSpyProductOfferStores->setModel('\Orm\Zed\ProductOffer\Persistence\SpyProductOfferStore');

                    return $collSpyProductOfferStores;
                }
            } else {
                $collSpyProductOfferStores = SpyProductOfferStoreQuery::create(null, $criteria)
                    ->filterBySpyStore($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductOfferStoresPartial && count($collSpyProductOfferStores)) {
                        $this->initSpyProductOfferStores(false);

                        foreach ($collSpyProductOfferStores as $obj) {
                            if (false == $this->collSpyProductOfferStores->contains($obj)) {
                                $this->collSpyProductOfferStores->append($obj);
                            }
                        }

                        $this->collSpyProductOfferStoresPartial = true;
                    }

                    return $collSpyProductOfferStores;
                }

                if ($partial && $this->collSpyProductOfferStores) {
                    foreach ($this->collSpyProductOfferStores as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductOfferStores[] = $obj;
                        }
                    }
                }

                $this->collSpyProductOfferStores = $collSpyProductOfferStores;
                $this->collSpyProductOfferStoresPartial = false;
            }
        }

        return $this->collSpyProductOfferStores;
    }

    /**
     * Sets a collection of SpyProductOfferStore objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductOfferStores A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductOfferStores(Collection $spyProductOfferStores, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductOfferStore[] $spyProductOfferStoresToDelete */
        $spyProductOfferStoresToDelete = $this->getSpyProductOfferStores(new Criteria(), $con)->diff($spyProductOfferStores);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->spyProductOfferStoresScheduledForDeletion = clone $spyProductOfferStoresToDelete;

        foreach ($spyProductOfferStoresToDelete as $spyProductOfferStoreRemoved) {
            $spyProductOfferStoreRemoved->setSpyStore(null);
        }

        $this->collSpyProductOfferStores = null;
        foreach ($spyProductOfferStores as $spyProductOfferStore) {
            $this->addSpyProductOfferStore($spyProductOfferStore);
        }

        $this->collSpyProductOfferStores = $spyProductOfferStores;
        $this->collSpyProductOfferStoresPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductOfferStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductOfferStore objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductOfferStores(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductOfferStoresPartial && !$this->isNew();
        if (null === $this->collSpyProductOfferStores || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductOfferStores) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductOfferStores());
            }

            $query = SpyProductOfferStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyStore($this)
                ->count($con);
        }

        return count($this->collSpyProductOfferStores);
    }

    /**
     * Method called to associate a SpyProductOfferStore object to this object
     * through the SpyProductOfferStore foreign key attribute.
     *
     * @param SpyProductOfferStore $l SpyProductOfferStore
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductOfferStore(SpyProductOfferStore $l)
    {
        if ($this->collSpyProductOfferStores === null) {
            $this->initSpyProductOfferStores();
            $this->collSpyProductOfferStoresPartial = true;
        }

        if (!$this->collSpyProductOfferStores->contains($l)) {
            $this->doAddSpyProductOfferStore($l);

            if ($this->spyProductOfferStoresScheduledForDeletion and $this->spyProductOfferStoresScheduledForDeletion->contains($l)) {
                $this->spyProductOfferStoresScheduledForDeletion->remove($this->spyProductOfferStoresScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductOfferStore $spyProductOfferStore The SpyProductOfferStore object to add.
     */
    protected function doAddSpyProductOfferStore(SpyProductOfferStore $spyProductOfferStore): void
    {
        $this->collSpyProductOfferStores[]= $spyProductOfferStore;
        $spyProductOfferStore->setSpyStore($this);
    }

    /**
     * @param SpyProductOfferStore $spyProductOfferStore The SpyProductOfferStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductOfferStore(SpyProductOfferStore $spyProductOfferStore)
    {
        if ($this->getSpyProductOfferStores()->contains($spyProductOfferStore)) {
            $pos = $this->collSpyProductOfferStores->search($spyProductOfferStore);
            $this->collSpyProductOfferStores->remove($pos);
            if (null === $this->spyProductOfferStoresScheduledForDeletion) {
                $this->spyProductOfferStoresScheduledForDeletion = clone $this->collSpyProductOfferStores;
                $this->spyProductOfferStoresScheduledForDeletion->clear();
            }
            $this->spyProductOfferStoresScheduledForDeletion[]= clone $spyProductOfferStore;
            $spyProductOfferStore->setSpyStore(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related SpyProductOfferStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductOfferStore[] List of SpyProductOfferStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductOfferStore}> List of SpyProductOfferStore objects
     */
    public function getSpyProductOfferStoresJoinSpyProductOffer(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductOfferStoreQuery::create(null, $criteria);
        $query->joinWith('SpyProductOffer', $joinBehavior);

        return $this->getSpyProductOfferStores($query, $con);
    }

    /**
     * Clears out the collProductOptionValuePrices collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addProductOptionValuePrices()
     */
    public function clearProductOptionValuePrices()
    {
        $this->collProductOptionValuePrices = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collProductOptionValuePrices collection loaded partially.
     *
     * @return void
     */
    public function resetPartialProductOptionValuePrices($v = true): void
    {
        $this->collProductOptionValuePricesPartial = $v;
    }

    /**
     * Initializes the collProductOptionValuePrices collection.
     *
     * By default this just sets the collProductOptionValuePrices collection to an empty array (like clearcollProductOptionValuePrices());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProductOptionValuePrices(bool $overrideExisting = true): void
    {
        if (null !== $this->collProductOptionValuePrices && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductOptionValuePriceTableMap::getTableMap()->getCollectionClassName();

        $this->collProductOptionValuePrices = new $collectionClassName;
        $this->collProductOptionValuePrices->setModel('\Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePrice');
    }

    /**
     * Gets an array of SpyProductOptionValuePrice objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductOptionValuePrice[] List of SpyProductOptionValuePrice objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductOptionValuePrice> List of SpyProductOptionValuePrice objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getProductOptionValuePrices(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collProductOptionValuePricesPartial && !$this->isNew();
        if (null === $this->collProductOptionValuePrices || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collProductOptionValuePrices) {
                    $this->initProductOptionValuePrices();
                } else {
                    $collectionClassName = SpyProductOptionValuePriceTableMap::getTableMap()->getCollectionClassName();

                    $collProductOptionValuePrices = new $collectionClassName;
                    $collProductOptionValuePrices->setModel('\Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePrice');

                    return $collProductOptionValuePrices;
                }
            } else {
                $collProductOptionValuePrices = SpyProductOptionValuePriceQuery::create(null, $criteria)
                    ->filterByStore($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProductOptionValuePricesPartial && count($collProductOptionValuePrices)) {
                        $this->initProductOptionValuePrices(false);

                        foreach ($collProductOptionValuePrices as $obj) {
                            if (false == $this->collProductOptionValuePrices->contains($obj)) {
                                $this->collProductOptionValuePrices->append($obj);
                            }
                        }

                        $this->collProductOptionValuePricesPartial = true;
                    }

                    return $collProductOptionValuePrices;
                }

                if ($partial && $this->collProductOptionValuePrices) {
                    foreach ($this->collProductOptionValuePrices as $obj) {
                        if ($obj->isNew()) {
                            $collProductOptionValuePrices[] = $obj;
                        }
                    }
                }

                $this->collProductOptionValuePrices = $collProductOptionValuePrices;
                $this->collProductOptionValuePricesPartial = false;
            }
        }

        return $this->collProductOptionValuePrices;
    }

    /**
     * Sets a collection of SpyProductOptionValuePrice objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $productOptionValuePrices A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setProductOptionValuePrices(Collection $productOptionValuePrices, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductOptionValuePrice[] $productOptionValuePricesToDelete */
        $productOptionValuePricesToDelete = $this->getProductOptionValuePrices(new Criteria(), $con)->diff($productOptionValuePrices);


        $this->productOptionValuePricesScheduledForDeletion = $productOptionValuePricesToDelete;

        foreach ($productOptionValuePricesToDelete as $productOptionValuePriceRemoved) {
            $productOptionValuePriceRemoved->setStore(null);
        }

        $this->collProductOptionValuePrices = null;
        foreach ($productOptionValuePrices as $productOptionValuePrice) {
            $this->addProductOptionValuePrice($productOptionValuePrice);
        }

        $this->collProductOptionValuePrices = $productOptionValuePrices;
        $this->collProductOptionValuePricesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductOptionValuePrice objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductOptionValuePrice objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countProductOptionValuePrices(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collProductOptionValuePricesPartial && !$this->isNew();
        if (null === $this->collProductOptionValuePrices || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProductOptionValuePrices) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProductOptionValuePrices());
            }

            $query = SpyProductOptionValuePriceQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStore($this)
                ->count($con);
        }

        return count($this->collProductOptionValuePrices);
    }

    /**
     * Method called to associate a SpyProductOptionValuePrice object to this object
     * through the SpyProductOptionValuePrice foreign key attribute.
     *
     * @param SpyProductOptionValuePrice $l SpyProductOptionValuePrice
     * @return $this The current object (for fluent API support)
     */
    public function addProductOptionValuePrice(SpyProductOptionValuePrice $l)
    {
        if ($this->collProductOptionValuePrices === null) {
            $this->initProductOptionValuePrices();
            $this->collProductOptionValuePricesPartial = true;
        }

        if (!$this->collProductOptionValuePrices->contains($l)) {
            $this->doAddProductOptionValuePrice($l);

            if ($this->productOptionValuePricesScheduledForDeletion and $this->productOptionValuePricesScheduledForDeletion->contains($l)) {
                $this->productOptionValuePricesScheduledForDeletion->remove($this->productOptionValuePricesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductOptionValuePrice $productOptionValuePrice The SpyProductOptionValuePrice object to add.
     */
    protected function doAddProductOptionValuePrice(SpyProductOptionValuePrice $productOptionValuePrice): void
    {
        $this->collProductOptionValuePrices[]= $productOptionValuePrice;
        $productOptionValuePrice->setStore($this);
    }

    /**
     * @param SpyProductOptionValuePrice $productOptionValuePrice The SpyProductOptionValuePrice object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeProductOptionValuePrice(SpyProductOptionValuePrice $productOptionValuePrice)
    {
        if ($this->getProductOptionValuePrices()->contains($productOptionValuePrice)) {
            $pos = $this->collProductOptionValuePrices->search($productOptionValuePrice);
            $this->collProductOptionValuePrices->remove($pos);
            if (null === $this->productOptionValuePricesScheduledForDeletion) {
                $this->productOptionValuePricesScheduledForDeletion = clone $this->collProductOptionValuePrices;
                $this->productOptionValuePricesScheduledForDeletion->clear();
            }
            $this->productOptionValuePricesScheduledForDeletion[]= $productOptionValuePrice;
            $productOptionValuePrice->setStore(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related ProductOptionValuePrices from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductOptionValuePrice[] List of SpyProductOptionValuePrice objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductOptionValuePrice}> List of SpyProductOptionValuePrice objects
     */
    public function getProductOptionValuePricesJoinCurrency(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductOptionValuePriceQuery::create(null, $criteria);
        $query->joinWith('Currency', $joinBehavior);

        return $this->getProductOptionValuePrices($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related ProductOptionValuePrices from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductOptionValuePrice[] List of SpyProductOptionValuePrice objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductOptionValuePrice}> List of SpyProductOptionValuePrice objects
     */
    public function getProductOptionValuePricesJoinProductOptionValue(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductOptionValuePriceQuery::create(null, $criteria);
        $query->joinWith('ProductOptionValue', $joinBehavior);

        return $this->getProductOptionValuePrices($query, $con);
    }

    /**
     * Clears out the collProductRelationStores collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addProductRelationStores()
     */
    public function clearProductRelationStores()
    {
        $this->collProductRelationStores = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collProductRelationStores collection loaded partially.
     *
     * @return void
     */
    public function resetPartialProductRelationStores($v = true): void
    {
        $this->collProductRelationStoresPartial = $v;
    }

    /**
     * Initializes the collProductRelationStores collection.
     *
     * By default this just sets the collProductRelationStores collection to an empty array (like clearcollProductRelationStores());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProductRelationStores(bool $overrideExisting = true): void
    {
        if (null !== $this->collProductRelationStores && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductRelationStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collProductRelationStores = new $collectionClassName;
        $this->collProductRelationStores->setModel('\Orm\Zed\ProductRelation\Persistence\SpyProductRelationStore');
    }

    /**
     * Gets an array of SpyProductRelationStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductRelationStore[] List of SpyProductRelationStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductRelationStore> List of SpyProductRelationStore objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getProductRelationStores(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collProductRelationStoresPartial && !$this->isNew();
        if (null === $this->collProductRelationStores || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collProductRelationStores) {
                    $this->initProductRelationStores();
                } else {
                    $collectionClassName = SpyProductRelationStoreTableMap::getTableMap()->getCollectionClassName();

                    $collProductRelationStores = new $collectionClassName;
                    $collProductRelationStores->setModel('\Orm\Zed\ProductRelation\Persistence\SpyProductRelationStore');

                    return $collProductRelationStores;
                }
            } else {
                $collProductRelationStores = SpyProductRelationStoreQuery::create(null, $criteria)
                    ->filterByStore($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProductRelationStoresPartial && count($collProductRelationStores)) {
                        $this->initProductRelationStores(false);

                        foreach ($collProductRelationStores as $obj) {
                            if (false == $this->collProductRelationStores->contains($obj)) {
                                $this->collProductRelationStores->append($obj);
                            }
                        }

                        $this->collProductRelationStoresPartial = true;
                    }

                    return $collProductRelationStores;
                }

                if ($partial && $this->collProductRelationStores) {
                    foreach ($this->collProductRelationStores as $obj) {
                        if ($obj->isNew()) {
                            $collProductRelationStores[] = $obj;
                        }
                    }
                }

                $this->collProductRelationStores = $collProductRelationStores;
                $this->collProductRelationStoresPartial = false;
            }
        }

        return $this->collProductRelationStores;
    }

    /**
     * Sets a collection of SpyProductRelationStore objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $productRelationStores A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setProductRelationStores(Collection $productRelationStores, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductRelationStore[] $productRelationStoresToDelete */
        $productRelationStoresToDelete = $this->getProductRelationStores(new Criteria(), $con)->diff($productRelationStores);


        $this->productRelationStoresScheduledForDeletion = $productRelationStoresToDelete;

        foreach ($productRelationStoresToDelete as $productRelationStoreRemoved) {
            $productRelationStoreRemoved->setStore(null);
        }

        $this->collProductRelationStores = null;
        foreach ($productRelationStores as $productRelationStore) {
            $this->addProductRelationStore($productRelationStore);
        }

        $this->collProductRelationStores = $productRelationStores;
        $this->collProductRelationStoresPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductRelationStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductRelationStore objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countProductRelationStores(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collProductRelationStoresPartial && !$this->isNew();
        if (null === $this->collProductRelationStores || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProductRelationStores) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProductRelationStores());
            }

            $query = SpyProductRelationStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStore($this)
                ->count($con);
        }

        return count($this->collProductRelationStores);
    }

    /**
     * Method called to associate a SpyProductRelationStore object to this object
     * through the SpyProductRelationStore foreign key attribute.
     *
     * @param SpyProductRelationStore $l SpyProductRelationStore
     * @return $this The current object (for fluent API support)
     */
    public function addProductRelationStore(SpyProductRelationStore $l)
    {
        if ($this->collProductRelationStores === null) {
            $this->initProductRelationStores();
            $this->collProductRelationStoresPartial = true;
        }

        if (!$this->collProductRelationStores->contains($l)) {
            $this->doAddProductRelationStore($l);

            if ($this->productRelationStoresScheduledForDeletion and $this->productRelationStoresScheduledForDeletion->contains($l)) {
                $this->productRelationStoresScheduledForDeletion->remove($this->productRelationStoresScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductRelationStore $productRelationStore The SpyProductRelationStore object to add.
     */
    protected function doAddProductRelationStore(SpyProductRelationStore $productRelationStore): void
    {
        $this->collProductRelationStores[]= $productRelationStore;
        $productRelationStore->setStore($this);
    }

    /**
     * @param SpyProductRelationStore $productRelationStore The SpyProductRelationStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeProductRelationStore(SpyProductRelationStore $productRelationStore)
    {
        if ($this->getProductRelationStores()->contains($productRelationStore)) {
            $pos = $this->collProductRelationStores->search($productRelationStore);
            $this->collProductRelationStores->remove($pos);
            if (null === $this->productRelationStoresScheduledForDeletion) {
                $this->productRelationStoresScheduledForDeletion = clone $this->collProductRelationStores;
                $this->productRelationStoresScheduledForDeletion->clear();
            }
            $this->productRelationStoresScheduledForDeletion[]= clone $productRelationStore;
            $productRelationStore->setStore(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related ProductRelationStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductRelationStore[] List of SpyProductRelationStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductRelationStore}> List of SpyProductRelationStore objects
     */
    public function getProductRelationStoresJoinProductRelation(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductRelationStoreQuery::create(null, $criteria);
        $query->joinWith('ProductRelation', $joinBehavior);

        return $this->getProductRelationStores($query, $con);
    }

    /**
     * Clears out the collSpyQuotes collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyQuotes()
     */
    public function clearSpyQuotes()
    {
        $this->collSpyQuotes = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyQuotes collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyQuotes($v = true): void
    {
        $this->collSpyQuotesPartial = $v;
    }

    /**
     * Initializes the collSpyQuotes collection.
     *
     * By default this just sets the collSpyQuotes collection to an empty array (like clearcollSpyQuotes());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyQuotes(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyQuotes && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyQuoteTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyQuotes = new $collectionClassName;
        $this->collSpyQuotes->setModel('\Orm\Zed\Quote\Persistence\SpyQuote');
    }

    /**
     * Gets an array of SpyQuote objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyQuote[] List of SpyQuote objects
     * @phpstan-return ObjectCollection&\Traversable<SpyQuote> List of SpyQuote objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyQuotes(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyQuotesPartial && !$this->isNew();
        if (null === $this->collSpyQuotes || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyQuotes) {
                    $this->initSpyQuotes();
                } else {
                    $collectionClassName = SpyQuoteTableMap::getTableMap()->getCollectionClassName();

                    $collSpyQuotes = new $collectionClassName;
                    $collSpyQuotes->setModel('\Orm\Zed\Quote\Persistence\SpyQuote');

                    return $collSpyQuotes;
                }
            } else {
                $collSpyQuotes = SpyQuoteQuery::create(null, $criteria)
                    ->filterBySpyStore($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyQuotesPartial && count($collSpyQuotes)) {
                        $this->initSpyQuotes(false);

                        foreach ($collSpyQuotes as $obj) {
                            if (false == $this->collSpyQuotes->contains($obj)) {
                                $this->collSpyQuotes->append($obj);
                            }
                        }

                        $this->collSpyQuotesPartial = true;
                    }

                    return $collSpyQuotes;
                }

                if ($partial && $this->collSpyQuotes) {
                    foreach ($this->collSpyQuotes as $obj) {
                        if ($obj->isNew()) {
                            $collSpyQuotes[] = $obj;
                        }
                    }
                }

                $this->collSpyQuotes = $collSpyQuotes;
                $this->collSpyQuotesPartial = false;
            }
        }

        return $this->collSpyQuotes;
    }

    /**
     * Sets a collection of SpyQuote objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyQuotes A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyQuotes(Collection $spyQuotes, ?ConnectionInterface $con = null)
    {
        /** @var SpyQuote[] $spyQuotesToDelete */
        $spyQuotesToDelete = $this->getSpyQuotes(new Criteria(), $con)->diff($spyQuotes);


        $this->spyQuotesScheduledForDeletion = $spyQuotesToDelete;

        foreach ($spyQuotesToDelete as $spyQuoteRemoved) {
            $spyQuoteRemoved->setSpyStore(null);
        }

        $this->collSpyQuotes = null;
        foreach ($spyQuotes as $spyQuote) {
            $this->addSpyQuote($spyQuote);
        }

        $this->collSpyQuotes = $spyQuotes;
        $this->collSpyQuotesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyQuote objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyQuote objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyQuotes(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyQuotesPartial && !$this->isNew();
        if (null === $this->collSpyQuotes || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyQuotes) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyQuotes());
            }

            $query = SpyQuoteQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyStore($this)
                ->count($con);
        }

        return count($this->collSpyQuotes);
    }

    /**
     * Method called to associate a SpyQuote object to this object
     * through the SpyQuote foreign key attribute.
     *
     * @param SpyQuote $l SpyQuote
     * @return $this The current object (for fluent API support)
     */
    public function addSpyQuote(SpyQuote $l)
    {
        if ($this->collSpyQuotes === null) {
            $this->initSpyQuotes();
            $this->collSpyQuotesPartial = true;
        }

        if (!$this->collSpyQuotes->contains($l)) {
            $this->doAddSpyQuote($l);

            if ($this->spyQuotesScheduledForDeletion and $this->spyQuotesScheduledForDeletion->contains($l)) {
                $this->spyQuotesScheduledForDeletion->remove($this->spyQuotesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyQuote $spyQuote The SpyQuote object to add.
     */
    protected function doAddSpyQuote(SpyQuote $spyQuote): void
    {
        $this->collSpyQuotes[]= $spyQuote;
        $spyQuote->setSpyStore($this);
    }

    /**
     * @param SpyQuote $spyQuote The SpyQuote object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyQuote(SpyQuote $spyQuote)
    {
        if ($this->getSpyQuotes()->contains($spyQuote)) {
            $pos = $this->collSpyQuotes->search($spyQuote);
            $this->collSpyQuotes->remove($pos);
            if (null === $this->spyQuotesScheduledForDeletion) {
                $this->spyQuotesScheduledForDeletion = clone $this->collSpyQuotes;
                $this->spyQuotesScheduledForDeletion->clear();
            }
            $this->spyQuotesScheduledForDeletion[]= clone $spyQuote;
            $spyQuote->setSpyStore(null);
        }

        return $this;
    }

    /**
     * Clears out the collSpySalesOrderThresholds collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpySalesOrderThresholds()
     */
    public function clearSpySalesOrderThresholds()
    {
        $this->collSpySalesOrderThresholds = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpySalesOrderThresholds collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpySalesOrderThresholds($v = true): void
    {
        $this->collSpySalesOrderThresholdsPartial = $v;
    }

    /**
     * Initializes the collSpySalesOrderThresholds collection.
     *
     * By default this just sets the collSpySalesOrderThresholds collection to an empty array (like clearcollSpySalesOrderThresholds());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpySalesOrderThresholds(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpySalesOrderThresholds && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpySalesOrderThresholdTableMap::getTableMap()->getCollectionClassName();

        $this->collSpySalesOrderThresholds = new $collectionClassName;
        $this->collSpySalesOrderThresholds->setModel('\Orm\Zed\SalesOrderThreshold\Persistence\SpySalesOrderThreshold');
    }

    /**
     * Gets an array of SpySalesOrderThreshold objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpySalesOrderThreshold[] List of SpySalesOrderThreshold objects
     * @phpstan-return ObjectCollection&\Traversable<SpySalesOrderThreshold> List of SpySalesOrderThreshold objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpySalesOrderThresholds(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpySalesOrderThresholdsPartial && !$this->isNew();
        if (null === $this->collSpySalesOrderThresholds || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpySalesOrderThresholds) {
                    $this->initSpySalesOrderThresholds();
                } else {
                    $collectionClassName = SpySalesOrderThresholdTableMap::getTableMap()->getCollectionClassName();

                    $collSpySalesOrderThresholds = new $collectionClassName;
                    $collSpySalesOrderThresholds->setModel('\Orm\Zed\SalesOrderThreshold\Persistence\SpySalesOrderThreshold');

                    return $collSpySalesOrderThresholds;
                }
            } else {
                $collSpySalesOrderThresholds = SpySalesOrderThresholdQuery::create(null, $criteria)
                    ->filterByStore($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpySalesOrderThresholdsPartial && count($collSpySalesOrderThresholds)) {
                        $this->initSpySalesOrderThresholds(false);

                        foreach ($collSpySalesOrderThresholds as $obj) {
                            if (false == $this->collSpySalesOrderThresholds->contains($obj)) {
                                $this->collSpySalesOrderThresholds->append($obj);
                            }
                        }

                        $this->collSpySalesOrderThresholdsPartial = true;
                    }

                    return $collSpySalesOrderThresholds;
                }

                if ($partial && $this->collSpySalesOrderThresholds) {
                    foreach ($this->collSpySalesOrderThresholds as $obj) {
                        if ($obj->isNew()) {
                            $collSpySalesOrderThresholds[] = $obj;
                        }
                    }
                }

                $this->collSpySalesOrderThresholds = $collSpySalesOrderThresholds;
                $this->collSpySalesOrderThresholdsPartial = false;
            }
        }

        return $this->collSpySalesOrderThresholds;
    }

    /**
     * Sets a collection of SpySalesOrderThreshold objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spySalesOrderThresholds A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpySalesOrderThresholds(Collection $spySalesOrderThresholds, ?ConnectionInterface $con = null)
    {
        /** @var SpySalesOrderThreshold[] $spySalesOrderThresholdsToDelete */
        $spySalesOrderThresholdsToDelete = $this->getSpySalesOrderThresholds(new Criteria(), $con)->diff($spySalesOrderThresholds);


        $this->spySalesOrderThresholdsScheduledForDeletion = $spySalesOrderThresholdsToDelete;

        foreach ($spySalesOrderThresholdsToDelete as $spySalesOrderThresholdRemoved) {
            $spySalesOrderThresholdRemoved->setStore(null);
        }

        $this->collSpySalesOrderThresholds = null;
        foreach ($spySalesOrderThresholds as $spySalesOrderThreshold) {
            $this->addSpySalesOrderThreshold($spySalesOrderThreshold);
        }

        $this->collSpySalesOrderThresholds = $spySalesOrderThresholds;
        $this->collSpySalesOrderThresholdsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpySalesOrderThreshold objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpySalesOrderThreshold objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpySalesOrderThresholds(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpySalesOrderThresholdsPartial && !$this->isNew();
        if (null === $this->collSpySalesOrderThresholds || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpySalesOrderThresholds) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpySalesOrderThresholds());
            }

            $query = SpySalesOrderThresholdQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStore($this)
                ->count($con);
        }

        return count($this->collSpySalesOrderThresholds);
    }

    /**
     * Method called to associate a SpySalesOrderThreshold object to this object
     * through the SpySalesOrderThreshold foreign key attribute.
     *
     * @param SpySalesOrderThreshold $l SpySalesOrderThreshold
     * @return $this The current object (for fluent API support)
     */
    public function addSpySalesOrderThreshold(SpySalesOrderThreshold $l)
    {
        if ($this->collSpySalesOrderThresholds === null) {
            $this->initSpySalesOrderThresholds();
            $this->collSpySalesOrderThresholdsPartial = true;
        }

        if (!$this->collSpySalesOrderThresholds->contains($l)) {
            $this->doAddSpySalesOrderThreshold($l);

            if ($this->spySalesOrderThresholdsScheduledForDeletion and $this->spySalesOrderThresholdsScheduledForDeletion->contains($l)) {
                $this->spySalesOrderThresholdsScheduledForDeletion->remove($this->spySalesOrderThresholdsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpySalesOrderThreshold $spySalesOrderThreshold The SpySalesOrderThreshold object to add.
     */
    protected function doAddSpySalesOrderThreshold(SpySalesOrderThreshold $spySalesOrderThreshold): void
    {
        $this->collSpySalesOrderThresholds[]= $spySalesOrderThreshold;
        $spySalesOrderThreshold->setStore($this);
    }

    /**
     * @param SpySalesOrderThreshold $spySalesOrderThreshold The SpySalesOrderThreshold object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpySalesOrderThreshold(SpySalesOrderThreshold $spySalesOrderThreshold)
    {
        if ($this->getSpySalesOrderThresholds()->contains($spySalesOrderThreshold)) {
            $pos = $this->collSpySalesOrderThresholds->search($spySalesOrderThreshold);
            $this->collSpySalesOrderThresholds->remove($pos);
            if (null === $this->spySalesOrderThresholdsScheduledForDeletion) {
                $this->spySalesOrderThresholdsScheduledForDeletion = clone $this->collSpySalesOrderThresholds;
                $this->spySalesOrderThresholdsScheduledForDeletion->clear();
            }
            $this->spySalesOrderThresholdsScheduledForDeletion[]= clone $spySalesOrderThreshold;
            $spySalesOrderThreshold->setStore(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related SpySalesOrderThresholds from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpySalesOrderThreshold[] List of SpySalesOrderThreshold objects
     * @phpstan-return ObjectCollection&\Traversable<SpySalesOrderThreshold}> List of SpySalesOrderThreshold objects
     */
    public function getSpySalesOrderThresholdsJoinSalesOrderThresholdType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpySalesOrderThresholdQuery::create(null, $criteria);
        $query->joinWith('SalesOrderThresholdType', $joinBehavior);

        return $this->getSpySalesOrderThresholds($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related SpySalesOrderThresholds from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpySalesOrderThreshold[] List of SpySalesOrderThreshold objects
     * @phpstan-return ObjectCollection&\Traversable<SpySalesOrderThreshold}> List of SpySalesOrderThreshold objects
     */
    public function getSpySalesOrderThresholdsJoinCurrency(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpySalesOrderThresholdQuery::create(null, $criteria);
        $query->joinWith('Currency', $joinBehavior);

        return $this->getSpySalesOrderThresholds($query, $con);
    }

    /**
     * Clears out the collServicePointStores collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addServicePointStores()
     */
    public function clearServicePointStores()
    {
        $this->collServicePointStores = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collServicePointStores collection loaded partially.
     *
     * @return void
     */
    public function resetPartialServicePointStores($v = true): void
    {
        $this->collServicePointStoresPartial = $v;
    }

    /**
     * Initializes the collServicePointStores collection.
     *
     * By default this just sets the collServicePointStores collection to an empty array (like clearcollServicePointStores());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initServicePointStores(bool $overrideExisting = true): void
    {
        if (null !== $this->collServicePointStores && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyServicePointStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collServicePointStores = new $collectionClassName;
        $this->collServicePointStores->setModel('\Orm\Zed\ServicePoint\Persistence\SpyServicePointStore');
    }

    /**
     * Gets an array of SpyServicePointStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyServicePointStore[] List of SpyServicePointStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyServicePointStore> List of SpyServicePointStore objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getServicePointStores(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collServicePointStoresPartial && !$this->isNew();
        if (null === $this->collServicePointStores || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collServicePointStores) {
                    $this->initServicePointStores();
                } else {
                    $collectionClassName = SpyServicePointStoreTableMap::getTableMap()->getCollectionClassName();

                    $collServicePointStores = new $collectionClassName;
                    $collServicePointStores->setModel('\Orm\Zed\ServicePoint\Persistence\SpyServicePointStore');

                    return $collServicePointStores;
                }
            } else {
                $collServicePointStores = SpyServicePointStoreQuery::create(null, $criteria)
                    ->filterByStore($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collServicePointStoresPartial && count($collServicePointStores)) {
                        $this->initServicePointStores(false);

                        foreach ($collServicePointStores as $obj) {
                            if (false == $this->collServicePointStores->contains($obj)) {
                                $this->collServicePointStores->append($obj);
                            }
                        }

                        $this->collServicePointStoresPartial = true;
                    }

                    return $collServicePointStores;
                }

                if ($partial && $this->collServicePointStores) {
                    foreach ($this->collServicePointStores as $obj) {
                        if ($obj->isNew()) {
                            $collServicePointStores[] = $obj;
                        }
                    }
                }

                $this->collServicePointStores = $collServicePointStores;
                $this->collServicePointStoresPartial = false;
            }
        }

        return $this->collServicePointStores;
    }

    /**
     * Sets a collection of SpyServicePointStore objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $servicePointStores A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setServicePointStores(Collection $servicePointStores, ?ConnectionInterface $con = null)
    {
        /** @var SpyServicePointStore[] $servicePointStoresToDelete */
        $servicePointStoresToDelete = $this->getServicePointStores(new Criteria(), $con)->diff($servicePointStores);


        $this->servicePointStoresScheduledForDeletion = $servicePointStoresToDelete;

        foreach ($servicePointStoresToDelete as $servicePointStoreRemoved) {
            $servicePointStoreRemoved->setStore(null);
        }

        $this->collServicePointStores = null;
        foreach ($servicePointStores as $servicePointStore) {
            $this->addServicePointStore($servicePointStore);
        }

        $this->collServicePointStores = $servicePointStores;
        $this->collServicePointStoresPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyServicePointStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyServicePointStore objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countServicePointStores(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collServicePointStoresPartial && !$this->isNew();
        if (null === $this->collServicePointStores || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collServicePointStores) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getServicePointStores());
            }

            $query = SpyServicePointStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStore($this)
                ->count($con);
        }

        return count($this->collServicePointStores);
    }

    /**
     * Method called to associate a SpyServicePointStore object to this object
     * through the SpyServicePointStore foreign key attribute.
     *
     * @param SpyServicePointStore $l SpyServicePointStore
     * @return $this The current object (for fluent API support)
     */
    public function addServicePointStore(SpyServicePointStore $l)
    {
        if ($this->collServicePointStores === null) {
            $this->initServicePointStores();
            $this->collServicePointStoresPartial = true;
        }

        if (!$this->collServicePointStores->contains($l)) {
            $this->doAddServicePointStore($l);

            if ($this->servicePointStoresScheduledForDeletion and $this->servicePointStoresScheduledForDeletion->contains($l)) {
                $this->servicePointStoresScheduledForDeletion->remove($this->servicePointStoresScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyServicePointStore $servicePointStore The SpyServicePointStore object to add.
     */
    protected function doAddServicePointStore(SpyServicePointStore $servicePointStore): void
    {
        $this->collServicePointStores[]= $servicePointStore;
        $servicePointStore->setStore($this);
    }

    /**
     * @param SpyServicePointStore $servicePointStore The SpyServicePointStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeServicePointStore(SpyServicePointStore $servicePointStore)
    {
        if ($this->getServicePointStores()->contains($servicePointStore)) {
            $pos = $this->collServicePointStores->search($servicePointStore);
            $this->collServicePointStores->remove($pos);
            if (null === $this->servicePointStoresScheduledForDeletion) {
                $this->servicePointStoresScheduledForDeletion = clone $this->collServicePointStores;
                $this->servicePointStoresScheduledForDeletion->clear();
            }
            $this->servicePointStoresScheduledForDeletion[]= clone $servicePointStore;
            $servicePointStore->setStore(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related ServicePointStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyServicePointStore[] List of SpyServicePointStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyServicePointStore}> List of SpyServicePointStore objects
     */
    public function getServicePointStoresJoinServicePoint(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyServicePointStoreQuery::create(null, $criteria);
        $query->joinWith('ServicePoint', $joinBehavior);

        return $this->getServicePointStores($query, $con);
    }

    /**
     * Clears out the collShipmentMethodPrices collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addShipmentMethodPrices()
     */
    public function clearShipmentMethodPrices()
    {
        $this->collShipmentMethodPrices = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collShipmentMethodPrices collection loaded partially.
     *
     * @return void
     */
    public function resetPartialShipmentMethodPrices($v = true): void
    {
        $this->collShipmentMethodPricesPartial = $v;
    }

    /**
     * Initializes the collShipmentMethodPrices collection.
     *
     * By default this just sets the collShipmentMethodPrices collection to an empty array (like clearcollShipmentMethodPrices());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initShipmentMethodPrices(bool $overrideExisting = true): void
    {
        if (null !== $this->collShipmentMethodPrices && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyShipmentMethodPriceTableMap::getTableMap()->getCollectionClassName();

        $this->collShipmentMethodPrices = new $collectionClassName;
        $this->collShipmentMethodPrices->setModel('\Orm\Zed\Shipment\Persistence\SpyShipmentMethodPrice');
    }

    /**
     * Gets an array of SpyShipmentMethodPrice objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyShipmentMethodPrice[] List of SpyShipmentMethodPrice objects
     * @phpstan-return ObjectCollection&\Traversable<SpyShipmentMethodPrice> List of SpyShipmentMethodPrice objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getShipmentMethodPrices(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collShipmentMethodPricesPartial && !$this->isNew();
        if (null === $this->collShipmentMethodPrices || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collShipmentMethodPrices) {
                    $this->initShipmentMethodPrices();
                } else {
                    $collectionClassName = SpyShipmentMethodPriceTableMap::getTableMap()->getCollectionClassName();

                    $collShipmentMethodPrices = new $collectionClassName;
                    $collShipmentMethodPrices->setModel('\Orm\Zed\Shipment\Persistence\SpyShipmentMethodPrice');

                    return $collShipmentMethodPrices;
                }
            } else {
                $collShipmentMethodPrices = SpyShipmentMethodPriceQuery::create(null, $criteria)
                    ->filterByStore($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collShipmentMethodPricesPartial && count($collShipmentMethodPrices)) {
                        $this->initShipmentMethodPrices(false);

                        foreach ($collShipmentMethodPrices as $obj) {
                            if (false == $this->collShipmentMethodPrices->contains($obj)) {
                                $this->collShipmentMethodPrices->append($obj);
                            }
                        }

                        $this->collShipmentMethodPricesPartial = true;
                    }

                    return $collShipmentMethodPrices;
                }

                if ($partial && $this->collShipmentMethodPrices) {
                    foreach ($this->collShipmentMethodPrices as $obj) {
                        if ($obj->isNew()) {
                            $collShipmentMethodPrices[] = $obj;
                        }
                    }
                }

                $this->collShipmentMethodPrices = $collShipmentMethodPrices;
                $this->collShipmentMethodPricesPartial = false;
            }
        }

        return $this->collShipmentMethodPrices;
    }

    /**
     * Sets a collection of SpyShipmentMethodPrice objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $shipmentMethodPrices A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setShipmentMethodPrices(Collection $shipmentMethodPrices, ?ConnectionInterface $con = null)
    {
        /** @var SpyShipmentMethodPrice[] $shipmentMethodPricesToDelete */
        $shipmentMethodPricesToDelete = $this->getShipmentMethodPrices(new Criteria(), $con)->diff($shipmentMethodPrices);


        $this->shipmentMethodPricesScheduledForDeletion = $shipmentMethodPricesToDelete;

        foreach ($shipmentMethodPricesToDelete as $shipmentMethodPriceRemoved) {
            $shipmentMethodPriceRemoved->setStore(null);
        }

        $this->collShipmentMethodPrices = null;
        foreach ($shipmentMethodPrices as $shipmentMethodPrice) {
            $this->addShipmentMethodPrice($shipmentMethodPrice);
        }

        $this->collShipmentMethodPrices = $shipmentMethodPrices;
        $this->collShipmentMethodPricesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyShipmentMethodPrice objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyShipmentMethodPrice objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countShipmentMethodPrices(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collShipmentMethodPricesPartial && !$this->isNew();
        if (null === $this->collShipmentMethodPrices || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collShipmentMethodPrices) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getShipmentMethodPrices());
            }

            $query = SpyShipmentMethodPriceQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStore($this)
                ->count($con);
        }

        return count($this->collShipmentMethodPrices);
    }

    /**
     * Method called to associate a SpyShipmentMethodPrice object to this object
     * through the SpyShipmentMethodPrice foreign key attribute.
     *
     * @param SpyShipmentMethodPrice $l SpyShipmentMethodPrice
     * @return $this The current object (for fluent API support)
     */
    public function addShipmentMethodPrice(SpyShipmentMethodPrice $l)
    {
        if ($this->collShipmentMethodPrices === null) {
            $this->initShipmentMethodPrices();
            $this->collShipmentMethodPricesPartial = true;
        }

        if (!$this->collShipmentMethodPrices->contains($l)) {
            $this->doAddShipmentMethodPrice($l);

            if ($this->shipmentMethodPricesScheduledForDeletion and $this->shipmentMethodPricesScheduledForDeletion->contains($l)) {
                $this->shipmentMethodPricesScheduledForDeletion->remove($this->shipmentMethodPricesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyShipmentMethodPrice $shipmentMethodPrice The SpyShipmentMethodPrice object to add.
     */
    protected function doAddShipmentMethodPrice(SpyShipmentMethodPrice $shipmentMethodPrice): void
    {
        $this->collShipmentMethodPrices[]= $shipmentMethodPrice;
        $shipmentMethodPrice->setStore($this);
    }

    /**
     * @param SpyShipmentMethodPrice $shipmentMethodPrice The SpyShipmentMethodPrice object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeShipmentMethodPrice(SpyShipmentMethodPrice $shipmentMethodPrice)
    {
        if ($this->getShipmentMethodPrices()->contains($shipmentMethodPrice)) {
            $pos = $this->collShipmentMethodPrices->search($shipmentMethodPrice);
            $this->collShipmentMethodPrices->remove($pos);
            if (null === $this->shipmentMethodPricesScheduledForDeletion) {
                $this->shipmentMethodPricesScheduledForDeletion = clone $this->collShipmentMethodPrices;
                $this->shipmentMethodPricesScheduledForDeletion->clear();
            }
            $this->shipmentMethodPricesScheduledForDeletion[]= $shipmentMethodPrice;
            $shipmentMethodPrice->setStore(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related ShipmentMethodPrices from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyShipmentMethodPrice[] List of SpyShipmentMethodPrice objects
     * @phpstan-return ObjectCollection&\Traversable<SpyShipmentMethodPrice}> List of SpyShipmentMethodPrice objects
     */
    public function getShipmentMethodPricesJoinCurrency(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyShipmentMethodPriceQuery::create(null, $criteria);
        $query->joinWith('Currency', $joinBehavior);

        return $this->getShipmentMethodPrices($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related ShipmentMethodPrices from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyShipmentMethodPrice[] List of SpyShipmentMethodPrice objects
     * @phpstan-return ObjectCollection&\Traversable<SpyShipmentMethodPrice}> List of SpyShipmentMethodPrice objects
     */
    public function getShipmentMethodPricesJoinShipmentMethod(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyShipmentMethodPriceQuery::create(null, $criteria);
        $query->joinWith('ShipmentMethod', $joinBehavior);

        return $this->getShipmentMethodPrices($query, $con);
    }

    /**
     * Clears out the collShipmentMethodStores collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addShipmentMethodStores()
     */
    public function clearShipmentMethodStores()
    {
        $this->collShipmentMethodStores = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collShipmentMethodStores collection loaded partially.
     *
     * @return void
     */
    public function resetPartialShipmentMethodStores($v = true): void
    {
        $this->collShipmentMethodStoresPartial = $v;
    }

    /**
     * Initializes the collShipmentMethodStores collection.
     *
     * By default this just sets the collShipmentMethodStores collection to an empty array (like clearcollShipmentMethodStores());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initShipmentMethodStores(bool $overrideExisting = true): void
    {
        if (null !== $this->collShipmentMethodStores && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyShipmentMethodStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collShipmentMethodStores = new $collectionClassName;
        $this->collShipmentMethodStores->setModel('\Orm\Zed\Shipment\Persistence\SpyShipmentMethodStore');
    }

    /**
     * Gets an array of SpyShipmentMethodStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyShipmentMethodStore[] List of SpyShipmentMethodStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyShipmentMethodStore> List of SpyShipmentMethodStore objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getShipmentMethodStores(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collShipmentMethodStoresPartial && !$this->isNew();
        if (null === $this->collShipmentMethodStores || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collShipmentMethodStores) {
                    $this->initShipmentMethodStores();
                } else {
                    $collectionClassName = SpyShipmentMethodStoreTableMap::getTableMap()->getCollectionClassName();

                    $collShipmentMethodStores = new $collectionClassName;
                    $collShipmentMethodStores->setModel('\Orm\Zed\Shipment\Persistence\SpyShipmentMethodStore');

                    return $collShipmentMethodStores;
                }
            } else {
                $collShipmentMethodStores = SpyShipmentMethodStoreQuery::create(null, $criteria)
                    ->filterByStore($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collShipmentMethodStoresPartial && count($collShipmentMethodStores)) {
                        $this->initShipmentMethodStores(false);

                        foreach ($collShipmentMethodStores as $obj) {
                            if (false == $this->collShipmentMethodStores->contains($obj)) {
                                $this->collShipmentMethodStores->append($obj);
                            }
                        }

                        $this->collShipmentMethodStoresPartial = true;
                    }

                    return $collShipmentMethodStores;
                }

                if ($partial && $this->collShipmentMethodStores) {
                    foreach ($this->collShipmentMethodStores as $obj) {
                        if ($obj->isNew()) {
                            $collShipmentMethodStores[] = $obj;
                        }
                    }
                }

                $this->collShipmentMethodStores = $collShipmentMethodStores;
                $this->collShipmentMethodStoresPartial = false;
            }
        }

        return $this->collShipmentMethodStores;
    }

    /**
     * Sets a collection of SpyShipmentMethodStore objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $shipmentMethodStores A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setShipmentMethodStores(Collection $shipmentMethodStores, ?ConnectionInterface $con = null)
    {
        /** @var SpyShipmentMethodStore[] $shipmentMethodStoresToDelete */
        $shipmentMethodStoresToDelete = $this->getShipmentMethodStores(new Criteria(), $con)->diff($shipmentMethodStores);


        $this->shipmentMethodStoresScheduledForDeletion = $shipmentMethodStoresToDelete;

        foreach ($shipmentMethodStoresToDelete as $shipmentMethodStoreRemoved) {
            $shipmentMethodStoreRemoved->setStore(null);
        }

        $this->collShipmentMethodStores = null;
        foreach ($shipmentMethodStores as $shipmentMethodStore) {
            $this->addShipmentMethodStore($shipmentMethodStore);
        }

        $this->collShipmentMethodStores = $shipmentMethodStores;
        $this->collShipmentMethodStoresPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyShipmentMethodStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyShipmentMethodStore objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countShipmentMethodStores(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collShipmentMethodStoresPartial && !$this->isNew();
        if (null === $this->collShipmentMethodStores || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collShipmentMethodStores) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getShipmentMethodStores());
            }

            $query = SpyShipmentMethodStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStore($this)
                ->count($con);
        }

        return count($this->collShipmentMethodStores);
    }

    /**
     * Method called to associate a SpyShipmentMethodStore object to this object
     * through the SpyShipmentMethodStore foreign key attribute.
     *
     * @param SpyShipmentMethodStore $l SpyShipmentMethodStore
     * @return $this The current object (for fluent API support)
     */
    public function addShipmentMethodStore(SpyShipmentMethodStore $l)
    {
        if ($this->collShipmentMethodStores === null) {
            $this->initShipmentMethodStores();
            $this->collShipmentMethodStoresPartial = true;
        }

        if (!$this->collShipmentMethodStores->contains($l)) {
            $this->doAddShipmentMethodStore($l);

            if ($this->shipmentMethodStoresScheduledForDeletion and $this->shipmentMethodStoresScheduledForDeletion->contains($l)) {
                $this->shipmentMethodStoresScheduledForDeletion->remove($this->shipmentMethodStoresScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyShipmentMethodStore $shipmentMethodStore The SpyShipmentMethodStore object to add.
     */
    protected function doAddShipmentMethodStore(SpyShipmentMethodStore $shipmentMethodStore): void
    {
        $this->collShipmentMethodStores[]= $shipmentMethodStore;
        $shipmentMethodStore->setStore($this);
    }

    /**
     * @param SpyShipmentMethodStore $shipmentMethodStore The SpyShipmentMethodStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeShipmentMethodStore(SpyShipmentMethodStore $shipmentMethodStore)
    {
        if ($this->getShipmentMethodStores()->contains($shipmentMethodStore)) {
            $pos = $this->collShipmentMethodStores->search($shipmentMethodStore);
            $this->collShipmentMethodStores->remove($pos);
            if (null === $this->shipmentMethodStoresScheduledForDeletion) {
                $this->shipmentMethodStoresScheduledForDeletion = clone $this->collShipmentMethodStores;
                $this->shipmentMethodStoresScheduledForDeletion->clear();
            }
            $this->shipmentMethodStoresScheduledForDeletion[]= clone $shipmentMethodStore;
            $shipmentMethodStore->setStore(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related ShipmentMethodStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyShipmentMethodStore[] List of SpyShipmentMethodStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyShipmentMethodStore}> List of SpyShipmentMethodStore objects
     */
    public function getShipmentMethodStoresJoinShipmentMethod(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyShipmentMethodStoreQuery::create(null, $criteria);
        $query->joinWith('ShipmentMethod', $joinBehavior);

        return $this->getShipmentMethodStores($query, $con);
    }

    /**
     * Clears out the collShipmentTypeStores collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addShipmentTypeStores()
     */
    public function clearShipmentTypeStores()
    {
        $this->collShipmentTypeStores = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collShipmentTypeStores collection loaded partially.
     *
     * @return void
     */
    public function resetPartialShipmentTypeStores($v = true): void
    {
        $this->collShipmentTypeStoresPartial = $v;
    }

    /**
     * Initializes the collShipmentTypeStores collection.
     *
     * By default this just sets the collShipmentTypeStores collection to an empty array (like clearcollShipmentTypeStores());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initShipmentTypeStores(bool $overrideExisting = true): void
    {
        if (null !== $this->collShipmentTypeStores && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyShipmentTypeStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collShipmentTypeStores = new $collectionClassName;
        $this->collShipmentTypeStores->setModel('\Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStore');
    }

    /**
     * Gets an array of SpyShipmentTypeStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyShipmentTypeStore[] List of SpyShipmentTypeStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyShipmentTypeStore> List of SpyShipmentTypeStore objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getShipmentTypeStores(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collShipmentTypeStoresPartial && !$this->isNew();
        if (null === $this->collShipmentTypeStores || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collShipmentTypeStores) {
                    $this->initShipmentTypeStores();
                } else {
                    $collectionClassName = SpyShipmentTypeStoreTableMap::getTableMap()->getCollectionClassName();

                    $collShipmentTypeStores = new $collectionClassName;
                    $collShipmentTypeStores->setModel('\Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeStore');

                    return $collShipmentTypeStores;
                }
            } else {
                $collShipmentTypeStores = SpyShipmentTypeStoreQuery::create(null, $criteria)
                    ->filterByStore($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collShipmentTypeStoresPartial && count($collShipmentTypeStores)) {
                        $this->initShipmentTypeStores(false);

                        foreach ($collShipmentTypeStores as $obj) {
                            if (false == $this->collShipmentTypeStores->contains($obj)) {
                                $this->collShipmentTypeStores->append($obj);
                            }
                        }

                        $this->collShipmentTypeStoresPartial = true;
                    }

                    return $collShipmentTypeStores;
                }

                if ($partial && $this->collShipmentTypeStores) {
                    foreach ($this->collShipmentTypeStores as $obj) {
                        if ($obj->isNew()) {
                            $collShipmentTypeStores[] = $obj;
                        }
                    }
                }

                $this->collShipmentTypeStores = $collShipmentTypeStores;
                $this->collShipmentTypeStoresPartial = false;
            }
        }

        return $this->collShipmentTypeStores;
    }

    /**
     * Sets a collection of SpyShipmentTypeStore objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $shipmentTypeStores A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setShipmentTypeStores(Collection $shipmentTypeStores, ?ConnectionInterface $con = null)
    {
        /** @var SpyShipmentTypeStore[] $shipmentTypeStoresToDelete */
        $shipmentTypeStoresToDelete = $this->getShipmentTypeStores(new Criteria(), $con)->diff($shipmentTypeStores);


        $this->shipmentTypeStoresScheduledForDeletion = $shipmentTypeStoresToDelete;

        foreach ($shipmentTypeStoresToDelete as $shipmentTypeStoreRemoved) {
            $shipmentTypeStoreRemoved->setStore(null);
        }

        $this->collShipmentTypeStores = null;
        foreach ($shipmentTypeStores as $shipmentTypeStore) {
            $this->addShipmentTypeStore($shipmentTypeStore);
        }

        $this->collShipmentTypeStores = $shipmentTypeStores;
        $this->collShipmentTypeStoresPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyShipmentTypeStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyShipmentTypeStore objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countShipmentTypeStores(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collShipmentTypeStoresPartial && !$this->isNew();
        if (null === $this->collShipmentTypeStores || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collShipmentTypeStores) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getShipmentTypeStores());
            }

            $query = SpyShipmentTypeStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStore($this)
                ->count($con);
        }

        return count($this->collShipmentTypeStores);
    }

    /**
     * Method called to associate a SpyShipmentTypeStore object to this object
     * through the SpyShipmentTypeStore foreign key attribute.
     *
     * @param SpyShipmentTypeStore $l SpyShipmentTypeStore
     * @return $this The current object (for fluent API support)
     */
    public function addShipmentTypeStore(SpyShipmentTypeStore $l)
    {
        if ($this->collShipmentTypeStores === null) {
            $this->initShipmentTypeStores();
            $this->collShipmentTypeStoresPartial = true;
        }

        if (!$this->collShipmentTypeStores->contains($l)) {
            $this->doAddShipmentTypeStore($l);

            if ($this->shipmentTypeStoresScheduledForDeletion and $this->shipmentTypeStoresScheduledForDeletion->contains($l)) {
                $this->shipmentTypeStoresScheduledForDeletion->remove($this->shipmentTypeStoresScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyShipmentTypeStore $shipmentTypeStore The SpyShipmentTypeStore object to add.
     */
    protected function doAddShipmentTypeStore(SpyShipmentTypeStore $shipmentTypeStore): void
    {
        $this->collShipmentTypeStores[]= $shipmentTypeStore;
        $shipmentTypeStore->setStore($this);
    }

    /**
     * @param SpyShipmentTypeStore $shipmentTypeStore The SpyShipmentTypeStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeShipmentTypeStore(SpyShipmentTypeStore $shipmentTypeStore)
    {
        if ($this->getShipmentTypeStores()->contains($shipmentTypeStore)) {
            $pos = $this->collShipmentTypeStores->search($shipmentTypeStore);
            $this->collShipmentTypeStores->remove($pos);
            if (null === $this->shipmentTypeStoresScheduledForDeletion) {
                $this->shipmentTypeStoresScheduledForDeletion = clone $this->collShipmentTypeStores;
                $this->shipmentTypeStoresScheduledForDeletion->clear();
            }
            $this->shipmentTypeStoresScheduledForDeletion[]= clone $shipmentTypeStore;
            $shipmentTypeStore->setStore(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related ShipmentTypeStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyShipmentTypeStore[] List of SpyShipmentTypeStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyShipmentTypeStore}> List of SpyShipmentTypeStore objects
     */
    public function getShipmentTypeStoresJoinShipmentType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyShipmentTypeStoreQuery::create(null, $criteria);
        $query->joinWith('ShipmentType', $joinBehavior);

        return $this->getShipmentTypeStores($query, $con);
    }

    /**
     * Clears out the collStockStores collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addStockStores()
     */
    public function clearStockStores()
    {
        $this->collStockStores = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collStockStores collection loaded partially.
     *
     * @return void
     */
    public function resetPartialStockStores($v = true): void
    {
        $this->collStockStoresPartial = $v;
    }

    /**
     * Initializes the collStockStores collection.
     *
     * By default this just sets the collStockStores collection to an empty array (like clearcollStockStores());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initStockStores(bool $overrideExisting = true): void
    {
        if (null !== $this->collStockStores && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyStockStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collStockStores = new $collectionClassName;
        $this->collStockStores->setModel('\Orm\Zed\Stock\Persistence\SpyStockStore');
    }

    /**
     * Gets an array of SpyStockStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyStockStore[] List of SpyStockStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyStockStore> List of SpyStockStore objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getStockStores(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collStockStoresPartial && !$this->isNew();
        if (null === $this->collStockStores || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collStockStores) {
                    $this->initStockStores();
                } else {
                    $collectionClassName = SpyStockStoreTableMap::getTableMap()->getCollectionClassName();

                    $collStockStores = new $collectionClassName;
                    $collStockStores->setModel('\Orm\Zed\Stock\Persistence\SpyStockStore');

                    return $collStockStores;
                }
            } else {
                $collStockStores = SpyStockStoreQuery::create(null, $criteria)
                    ->filterByStore($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collStockStoresPartial && count($collStockStores)) {
                        $this->initStockStores(false);

                        foreach ($collStockStores as $obj) {
                            if (false == $this->collStockStores->contains($obj)) {
                                $this->collStockStores->append($obj);
                            }
                        }

                        $this->collStockStoresPartial = true;
                    }

                    return $collStockStores;
                }

                if ($partial && $this->collStockStores) {
                    foreach ($this->collStockStores as $obj) {
                        if ($obj->isNew()) {
                            $collStockStores[] = $obj;
                        }
                    }
                }

                $this->collStockStores = $collStockStores;
                $this->collStockStoresPartial = false;
            }
        }

        return $this->collStockStores;
    }

    /**
     * Sets a collection of SpyStockStore objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $stockStores A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setStockStores(Collection $stockStores, ?ConnectionInterface $con = null)
    {
        /** @var SpyStockStore[] $stockStoresToDelete */
        $stockStoresToDelete = $this->getStockStores(new Criteria(), $con)->diff($stockStores);


        $this->stockStoresScheduledForDeletion = $stockStoresToDelete;

        foreach ($stockStoresToDelete as $stockStoreRemoved) {
            $stockStoreRemoved->setStore(null);
        }

        $this->collStockStores = null;
        foreach ($stockStores as $stockStore) {
            $this->addStockStore($stockStore);
        }

        $this->collStockStores = $stockStores;
        $this->collStockStoresPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyStockStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyStockStore objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countStockStores(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collStockStoresPartial && !$this->isNew();
        if (null === $this->collStockStores || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collStockStores) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getStockStores());
            }

            $query = SpyStockStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStore($this)
                ->count($con);
        }

        return count($this->collStockStores);
    }

    /**
     * Method called to associate a SpyStockStore object to this object
     * through the SpyStockStore foreign key attribute.
     *
     * @param SpyStockStore $l SpyStockStore
     * @return $this The current object (for fluent API support)
     */
    public function addStockStore(SpyStockStore $l)
    {
        if ($this->collStockStores === null) {
            $this->initStockStores();
            $this->collStockStoresPartial = true;
        }

        if (!$this->collStockStores->contains($l)) {
            $this->doAddStockStore($l);

            if ($this->stockStoresScheduledForDeletion and $this->stockStoresScheduledForDeletion->contains($l)) {
                $this->stockStoresScheduledForDeletion->remove($this->stockStoresScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyStockStore $stockStore The SpyStockStore object to add.
     */
    protected function doAddStockStore(SpyStockStore $stockStore): void
    {
        $this->collStockStores[]= $stockStore;
        $stockStore->setStore($this);
    }

    /**
     * @param SpyStockStore $stockStore The SpyStockStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeStockStore(SpyStockStore $stockStore)
    {
        if ($this->getStockStores()->contains($stockStore)) {
            $pos = $this->collStockStores->search($stockStore);
            $this->collStockStores->remove($pos);
            if (null === $this->stockStoresScheduledForDeletion) {
                $this->stockStoresScheduledForDeletion = clone $this->collStockStores;
                $this->stockStoresScheduledForDeletion->clear();
            }
            $this->stockStoresScheduledForDeletion[]= clone $stockStore;
            $stockStore->setStore(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related StockStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyStockStore[] List of SpyStockStore objects
     * @phpstan-return ObjectCollection&\Traversable<SpyStockStore}> List of SpyStockStore objects
     */
    public function getStockStoresJoinStock(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyStockStoreQuery::create(null, $criteria);
        $query->joinWith('Stock', $joinBehavior);

        return $this->getStockStores($query, $con);
    }

    /**
     * Clears out the collSpyStoreContexts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyStoreContexts()
     */
    public function clearSpyStoreContexts()
    {
        $this->collSpyStoreContexts = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyStoreContexts collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyStoreContexts($v = true): void
    {
        $this->collSpyStoreContextsPartial = $v;
    }

    /**
     * Initializes the collSpyStoreContexts collection.
     *
     * By default this just sets the collSpyStoreContexts collection to an empty array (like clearcollSpyStoreContexts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyStoreContexts(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyStoreContexts && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyStoreContextTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyStoreContexts = new $collectionClassName;
        $this->collSpyStoreContexts->setModel('\Orm\Zed\StoreContext\Persistence\SpyStoreContext');
    }

    /**
     * Gets an array of SpyStoreContext objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyStoreContext[] List of SpyStoreContext objects
     * @phpstan-return ObjectCollection&\Traversable<SpyStoreContext> List of SpyStoreContext objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyStoreContexts(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyStoreContextsPartial && !$this->isNew();
        if (null === $this->collSpyStoreContexts || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyStoreContexts) {
                    $this->initSpyStoreContexts();
                } else {
                    $collectionClassName = SpyStoreContextTableMap::getTableMap()->getCollectionClassName();

                    $collSpyStoreContexts = new $collectionClassName;
                    $collSpyStoreContexts->setModel('\Orm\Zed\StoreContext\Persistence\SpyStoreContext');

                    return $collSpyStoreContexts;
                }
            } else {
                $collSpyStoreContexts = SpyStoreContextQuery::create(null, $criteria)
                    ->filterBySpyStore($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyStoreContextsPartial && count($collSpyStoreContexts)) {
                        $this->initSpyStoreContexts(false);

                        foreach ($collSpyStoreContexts as $obj) {
                            if (false == $this->collSpyStoreContexts->contains($obj)) {
                                $this->collSpyStoreContexts->append($obj);
                            }
                        }

                        $this->collSpyStoreContextsPartial = true;
                    }

                    return $collSpyStoreContexts;
                }

                if ($partial && $this->collSpyStoreContexts) {
                    foreach ($this->collSpyStoreContexts as $obj) {
                        if ($obj->isNew()) {
                            $collSpyStoreContexts[] = $obj;
                        }
                    }
                }

                $this->collSpyStoreContexts = $collSpyStoreContexts;
                $this->collSpyStoreContextsPartial = false;
            }
        }

        return $this->collSpyStoreContexts;
    }

    /**
     * Sets a collection of SpyStoreContext objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyStoreContexts A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyStoreContexts(Collection $spyStoreContexts, ?ConnectionInterface $con = null)
    {
        /** @var SpyStoreContext[] $spyStoreContextsToDelete */
        $spyStoreContextsToDelete = $this->getSpyStoreContexts(new Criteria(), $con)->diff($spyStoreContexts);


        $this->spyStoreContextsScheduledForDeletion = $spyStoreContextsToDelete;

        foreach ($spyStoreContextsToDelete as $spyStoreContextRemoved) {
            $spyStoreContextRemoved->setSpyStore(null);
        }

        $this->collSpyStoreContexts = null;
        foreach ($spyStoreContexts as $spyStoreContext) {
            $this->addSpyStoreContext($spyStoreContext);
        }

        $this->collSpyStoreContexts = $spyStoreContexts;
        $this->collSpyStoreContextsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyStoreContext objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyStoreContext objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyStoreContexts(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyStoreContextsPartial && !$this->isNew();
        if (null === $this->collSpyStoreContexts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyStoreContexts) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyStoreContexts());
            }

            $query = SpyStoreContextQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyStore($this)
                ->count($con);
        }

        return count($this->collSpyStoreContexts);
    }

    /**
     * Method called to associate a SpyStoreContext object to this object
     * through the SpyStoreContext foreign key attribute.
     *
     * @param SpyStoreContext $l SpyStoreContext
     * @return $this The current object (for fluent API support)
     */
    public function addSpyStoreContext(SpyStoreContext $l)
    {
        if ($this->collSpyStoreContexts === null) {
            $this->initSpyStoreContexts();
            $this->collSpyStoreContextsPartial = true;
        }

        if (!$this->collSpyStoreContexts->contains($l)) {
            $this->doAddSpyStoreContext($l);

            if ($this->spyStoreContextsScheduledForDeletion and $this->spyStoreContextsScheduledForDeletion->contains($l)) {
                $this->spyStoreContextsScheduledForDeletion->remove($this->spyStoreContextsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyStoreContext $spyStoreContext The SpyStoreContext object to add.
     */
    protected function doAddSpyStoreContext(SpyStoreContext $spyStoreContext): void
    {
        $this->collSpyStoreContexts[]= $spyStoreContext;
        $spyStoreContext->setSpyStore($this);
    }

    /**
     * @param SpyStoreContext $spyStoreContext The SpyStoreContext object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyStoreContext(SpyStoreContext $spyStoreContext)
    {
        if ($this->getSpyStoreContexts()->contains($spyStoreContext)) {
            $pos = $this->collSpyStoreContexts->search($spyStoreContext);
            $this->collSpyStoreContexts->remove($pos);
            if (null === $this->spyStoreContextsScheduledForDeletion) {
                $this->spyStoreContextsScheduledForDeletion = clone $this->collSpyStoreContexts;
                $this->spyStoreContextsScheduledForDeletion->clear();
            }
            $this->spyStoreContextsScheduledForDeletion[]= clone $spyStoreContext;
            $spyStoreContext->setSpyStore(null);
        }

        return $this;
    }

    /**
     * Clears out the collTouchStorages collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addTouchStorages()
     */
    public function clearTouchStorages()
    {
        $this->collTouchStorages = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collTouchStorages collection loaded partially.
     *
     * @return void
     */
    public function resetPartialTouchStorages($v = true): void
    {
        $this->collTouchStoragesPartial = $v;
    }

    /**
     * Initializes the collTouchStorages collection.
     *
     * By default this just sets the collTouchStorages collection to an empty array (like clearcollTouchStorages());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTouchStorages(bool $overrideExisting = true): void
    {
        if (null !== $this->collTouchStorages && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyTouchStorageTableMap::getTableMap()->getCollectionClassName();

        $this->collTouchStorages = new $collectionClassName;
        $this->collTouchStorages->setModel('\Orm\Zed\Touch\Persistence\SpyTouchStorage');
    }

    /**
     * Gets an array of SpyTouchStorage objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyTouchStorage[] List of SpyTouchStorage objects
     * @phpstan-return ObjectCollection&\Traversable<SpyTouchStorage> List of SpyTouchStorage objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getTouchStorages(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collTouchStoragesPartial && !$this->isNew();
        if (null === $this->collTouchStorages || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collTouchStorages) {
                    $this->initTouchStorages();
                } else {
                    $collectionClassName = SpyTouchStorageTableMap::getTableMap()->getCollectionClassName();

                    $collTouchStorages = new $collectionClassName;
                    $collTouchStorages->setModel('\Orm\Zed\Touch\Persistence\SpyTouchStorage');

                    return $collTouchStorages;
                }
            } else {
                $collTouchStorages = SpyTouchStorageQuery::create(null, $criteria)
                    ->filterByStore($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTouchStoragesPartial && count($collTouchStorages)) {
                        $this->initTouchStorages(false);

                        foreach ($collTouchStorages as $obj) {
                            if (false == $this->collTouchStorages->contains($obj)) {
                                $this->collTouchStorages->append($obj);
                            }
                        }

                        $this->collTouchStoragesPartial = true;
                    }

                    return $collTouchStorages;
                }

                if ($partial && $this->collTouchStorages) {
                    foreach ($this->collTouchStorages as $obj) {
                        if ($obj->isNew()) {
                            $collTouchStorages[] = $obj;
                        }
                    }
                }

                $this->collTouchStorages = $collTouchStorages;
                $this->collTouchStoragesPartial = false;
            }
        }

        return $this->collTouchStorages;
    }

    /**
     * Sets a collection of SpyTouchStorage objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $touchStorages A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setTouchStorages(Collection $touchStorages, ?ConnectionInterface $con = null)
    {
        /** @var SpyTouchStorage[] $touchStoragesToDelete */
        $touchStoragesToDelete = $this->getTouchStorages(new Criteria(), $con)->diff($touchStorages);


        $this->touchStoragesScheduledForDeletion = $touchStoragesToDelete;

        foreach ($touchStoragesToDelete as $touchStorageRemoved) {
            $touchStorageRemoved->setStore(null);
        }

        $this->collTouchStorages = null;
        foreach ($touchStorages as $touchStorage) {
            $this->addTouchStorage($touchStorage);
        }

        $this->collTouchStorages = $touchStorages;
        $this->collTouchStoragesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyTouchStorage objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyTouchStorage objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countTouchStorages(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collTouchStoragesPartial && !$this->isNew();
        if (null === $this->collTouchStorages || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTouchStorages) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTouchStorages());
            }

            $query = SpyTouchStorageQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStore($this)
                ->count($con);
        }

        return count($this->collTouchStorages);
    }

    /**
     * Method called to associate a SpyTouchStorage object to this object
     * through the SpyTouchStorage foreign key attribute.
     *
     * @param SpyTouchStorage $l SpyTouchStorage
     * @return $this The current object (for fluent API support)
     */
    public function addTouchStorage(SpyTouchStorage $l)
    {
        if ($this->collTouchStorages === null) {
            $this->initTouchStorages();
            $this->collTouchStoragesPartial = true;
        }

        if (!$this->collTouchStorages->contains($l)) {
            $this->doAddTouchStorage($l);

            if ($this->touchStoragesScheduledForDeletion and $this->touchStoragesScheduledForDeletion->contains($l)) {
                $this->touchStoragesScheduledForDeletion->remove($this->touchStoragesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyTouchStorage $touchStorage The SpyTouchStorage object to add.
     */
    protected function doAddTouchStorage(SpyTouchStorage $touchStorage): void
    {
        $this->collTouchStorages[]= $touchStorage;
        $touchStorage->setStore($this);
    }

    /**
     * @param SpyTouchStorage $touchStorage The SpyTouchStorage object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeTouchStorage(SpyTouchStorage $touchStorage)
    {
        if ($this->getTouchStorages()->contains($touchStorage)) {
            $pos = $this->collTouchStorages->search($touchStorage);
            $this->collTouchStorages->remove($pos);
            if (null === $this->touchStoragesScheduledForDeletion) {
                $this->touchStoragesScheduledForDeletion = clone $this->collTouchStorages;
                $this->touchStoragesScheduledForDeletion->clear();
            }
            $this->touchStoragesScheduledForDeletion[]= $touchStorage;
            $touchStorage->setStore(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related TouchStorages from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyTouchStorage[] List of SpyTouchStorage objects
     * @phpstan-return ObjectCollection&\Traversable<SpyTouchStorage}> List of SpyTouchStorage objects
     */
    public function getTouchStoragesJoinTouch(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyTouchStorageQuery::create(null, $criteria);
        $query->joinWith('Touch', $joinBehavior);

        return $this->getTouchStorages($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related TouchStorages from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyTouchStorage[] List of SpyTouchStorage objects
     * @phpstan-return ObjectCollection&\Traversable<SpyTouchStorage}> List of SpyTouchStorage objects
     */
    public function getTouchStoragesJoinLocale(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyTouchStorageQuery::create(null, $criteria);
        $query->joinWith('Locale', $joinBehavior);

        return $this->getTouchStorages($query, $con);
    }

    /**
     * Clears out the collTouchSearches collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addTouchSearches()
     */
    public function clearTouchSearches()
    {
        $this->collTouchSearches = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collTouchSearches collection loaded partially.
     *
     * @return void
     */
    public function resetPartialTouchSearches($v = true): void
    {
        $this->collTouchSearchesPartial = $v;
    }

    /**
     * Initializes the collTouchSearches collection.
     *
     * By default this just sets the collTouchSearches collection to an empty array (like clearcollTouchSearches());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTouchSearches(bool $overrideExisting = true): void
    {
        if (null !== $this->collTouchSearches && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyTouchSearchTableMap::getTableMap()->getCollectionClassName();

        $this->collTouchSearches = new $collectionClassName;
        $this->collTouchSearches->setModel('\Orm\Zed\Touch\Persistence\SpyTouchSearch');
    }

    /**
     * Gets an array of SpyTouchSearch objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyTouchSearch[] List of SpyTouchSearch objects
     * @phpstan-return ObjectCollection&\Traversable<SpyTouchSearch> List of SpyTouchSearch objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getTouchSearches(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collTouchSearchesPartial && !$this->isNew();
        if (null === $this->collTouchSearches || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collTouchSearches) {
                    $this->initTouchSearches();
                } else {
                    $collectionClassName = SpyTouchSearchTableMap::getTableMap()->getCollectionClassName();

                    $collTouchSearches = new $collectionClassName;
                    $collTouchSearches->setModel('\Orm\Zed\Touch\Persistence\SpyTouchSearch');

                    return $collTouchSearches;
                }
            } else {
                $collTouchSearches = SpyTouchSearchQuery::create(null, $criteria)
                    ->filterByStore($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTouchSearchesPartial && count($collTouchSearches)) {
                        $this->initTouchSearches(false);

                        foreach ($collTouchSearches as $obj) {
                            if (false == $this->collTouchSearches->contains($obj)) {
                                $this->collTouchSearches->append($obj);
                            }
                        }

                        $this->collTouchSearchesPartial = true;
                    }

                    return $collTouchSearches;
                }

                if ($partial && $this->collTouchSearches) {
                    foreach ($this->collTouchSearches as $obj) {
                        if ($obj->isNew()) {
                            $collTouchSearches[] = $obj;
                        }
                    }
                }

                $this->collTouchSearches = $collTouchSearches;
                $this->collTouchSearchesPartial = false;
            }
        }

        return $this->collTouchSearches;
    }

    /**
     * Sets a collection of SpyTouchSearch objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $touchSearches A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setTouchSearches(Collection $touchSearches, ?ConnectionInterface $con = null)
    {
        /** @var SpyTouchSearch[] $touchSearchesToDelete */
        $touchSearchesToDelete = $this->getTouchSearches(new Criteria(), $con)->diff($touchSearches);


        $this->touchSearchesScheduledForDeletion = $touchSearchesToDelete;

        foreach ($touchSearchesToDelete as $touchSearchRemoved) {
            $touchSearchRemoved->setStore(null);
        }

        $this->collTouchSearches = null;
        foreach ($touchSearches as $touchSearch) {
            $this->addTouchSearch($touchSearch);
        }

        $this->collTouchSearches = $touchSearches;
        $this->collTouchSearchesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyTouchSearch objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyTouchSearch objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countTouchSearches(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collTouchSearchesPartial && !$this->isNew();
        if (null === $this->collTouchSearches || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTouchSearches) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTouchSearches());
            }

            $query = SpyTouchSearchQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStore($this)
                ->count($con);
        }

        return count($this->collTouchSearches);
    }

    /**
     * Method called to associate a SpyTouchSearch object to this object
     * through the SpyTouchSearch foreign key attribute.
     *
     * @param SpyTouchSearch $l SpyTouchSearch
     * @return $this The current object (for fluent API support)
     */
    public function addTouchSearch(SpyTouchSearch $l)
    {
        if ($this->collTouchSearches === null) {
            $this->initTouchSearches();
            $this->collTouchSearchesPartial = true;
        }

        if (!$this->collTouchSearches->contains($l)) {
            $this->doAddTouchSearch($l);

            if ($this->touchSearchesScheduledForDeletion and $this->touchSearchesScheduledForDeletion->contains($l)) {
                $this->touchSearchesScheduledForDeletion->remove($this->touchSearchesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyTouchSearch $touchSearch The SpyTouchSearch object to add.
     */
    protected function doAddTouchSearch(SpyTouchSearch $touchSearch): void
    {
        $this->collTouchSearches[]= $touchSearch;
        $touchSearch->setStore($this);
    }

    /**
     * @param SpyTouchSearch $touchSearch The SpyTouchSearch object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeTouchSearch(SpyTouchSearch $touchSearch)
    {
        if ($this->getTouchSearches()->contains($touchSearch)) {
            $pos = $this->collTouchSearches->search($touchSearch);
            $this->collTouchSearches->remove($pos);
            if (null === $this->touchSearchesScheduledForDeletion) {
                $this->touchSearchesScheduledForDeletion = clone $this->collTouchSearches;
                $this->touchSearchesScheduledForDeletion->clear();
            }
            $this->touchSearchesScheduledForDeletion[]= $touchSearch;
            $touchSearch->setStore(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related TouchSearches from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyTouchSearch[] List of SpyTouchSearch objects
     * @phpstan-return ObjectCollection&\Traversable<SpyTouchSearch}> List of SpyTouchSearch objects
     */
    public function getTouchSearchesJoinTouch(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyTouchSearchQuery::create(null, $criteria);
        $query->joinWith('Touch', $joinBehavior);

        return $this->getTouchSearches($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyStore is new, it will return
     * an empty collection; or if this SpyStore has previously
     * been saved, it will retrieve related TouchSearches from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyStore.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyTouchSearch[] List of SpyTouchSearch objects
     * @phpstan-return ObjectCollection&\Traversable<SpyTouchSearch}> List of SpyTouchSearch objects
     */
    public function getTouchSearchesJoinLocale(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyTouchSearchQuery::create(null, $criteria);
        $query->joinWith('Locale', $joinBehavior);

        return $this->getTouchSearches($query, $con);
    }

    /**
     * Clears out the collSpyProductOffers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSpyProductOffers()
     */
    public function clearSpyProductOffers()
    {
        $this->collSpyProductOffers = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collSpyProductOffers crossRef collection.
     *
     * By default this just sets the collSpyProductOffers collection to an empty collection (like clearSpyProductOffers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initSpyProductOffers()
    {
        $collectionClassName = SpyProductOfferStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductOffers = new $collectionClassName;
        $this->collSpyProductOffersPartial = true;
        $this->collSpyProductOffers->setModel('\Orm\Zed\ProductOffer\Persistence\SpyProductOffer');
    }

    /**
     * Checks if the collSpyProductOffers collection is loaded.
     *
     * @return bool
     */
    public function isSpyProductOffersLoaded(): bool
    {
        return null !== $this->collSpyProductOffers;
    }

    /**
     * Gets a collection of SpyProductOffer objects related by a many-to-many relationship
     * to the current object by way of the spy_product_offer_store cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyStore is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|SpyProductOffer[] List of SpyProductOffer objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductOffer> List of SpyProductOffer objects
     */
    public function getSpyProductOffers(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductOffersPartial && !$this->isNew();
        if (null === $this->collSpyProductOffers || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductOffers) {
                    $this->initSpyProductOffers();
                }
            } else {

                $query = SpyProductOfferQuery::create(null, $criteria)
                    ->filterBySpyStore($this);
                $collSpyProductOffers = $query->find($con);
                if (null !== $criteria) {
                    return $collSpyProductOffers;
                }

                if ($partial && $this->collSpyProductOffers) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collSpyProductOffers as $obj) {
                        if (!$collSpyProductOffers->contains($obj)) {
                            $collSpyProductOffers[] = $obj;
                        }
                    }
                }

                $this->collSpyProductOffers = $collSpyProductOffers;
                $this->collSpyProductOffersPartial = false;
            }
        }

        return $this->collSpyProductOffers;
    }

    /**
     * Sets a collection of SpyProductOffer objects related by a many-to-many relationship
     * to the current object by way of the spy_product_offer_store cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductOffers A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductOffers(Collection $spyProductOffers, ?ConnectionInterface $con = null)
    {
        $this->clearSpyProductOffers();
        $currentSpyProductOffers = $this->getSpyProductOffers();

        $spyProductOffersScheduledForDeletion = $currentSpyProductOffers->diff($spyProductOffers);

        foreach ($spyProductOffersScheduledForDeletion as $toDelete) {
            $this->removeSpyProductOffer($toDelete);
        }

        foreach ($spyProductOffers as $spyProductOffer) {
            if (!$currentSpyProductOffers->contains($spyProductOffer)) {
                $this->doAddSpyProductOffer($spyProductOffer);
            }
        }

        $this->collSpyProductOffersPartial = false;
        $this->collSpyProductOffers = $spyProductOffers;

        return $this;
    }

    /**
     * Gets the number of SpyProductOffer objects related by a many-to-many relationship
     * to the current object by way of the spy_product_offer_store cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param bool $distinct Set to true to force count distinct
     * @param ConnectionInterface $con Optional connection object
     *
     * @return int The number of related SpyProductOffer objects
     */
    public function countSpyProductOffers(?Criteria $criteria = null, $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductOffersPartial && !$this->isNew();
        if (null === $this->collSpyProductOffers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductOffers) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getSpyProductOffers());
                }

                $query = SpyProductOfferQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterBySpyStore($this)
                    ->count($con);
            }
        } else {
            return count($this->collSpyProductOffers);
        }
    }

    /**
     * Associate a SpyProductOffer to this object
     * through the spy_product_offer_store cross reference table.
     *
     * @param SpyProductOffer $spyProductOffer
     * @return ChildSpyStore The current object (for fluent API support)
     */
    public function addSpyProductOffer(SpyProductOffer $spyProductOffer)
    {
        if ($this->collSpyProductOffers === null) {
            $this->initSpyProductOffers();
        }

        if (!$this->getSpyProductOffers()->contains($spyProductOffer)) {
            // only add it if the **same** object is not already associated
            $this->collSpyProductOffers->push($spyProductOffer);
            $this->doAddSpyProductOffer($spyProductOffer);
        }

        return $this;
    }

    /**
     *
     * @param SpyProductOffer $spyProductOffer
     */
    protected function doAddSpyProductOffer(SpyProductOffer $spyProductOffer)
    {
        $spyProductOfferStore = new SpyProductOfferStore();

        $spyProductOfferStore->setSpyProductOffer($spyProductOffer);

        $spyProductOfferStore->setSpyStore($this);

        $this->addSpyProductOfferStore($spyProductOfferStore);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$spyProductOffer->isSpyStoresLoaded()) {
            $spyProductOffer->initSpyStores();
            $spyProductOffer->getSpyStores()->push($this);
        } elseif (!$spyProductOffer->getSpyStores()->contains($this)) {
            $spyProductOffer->getSpyStores()->push($this);
        }

    }

    /**
     * Remove spyProductOffer of this object
     * through the spy_product_offer_store cross reference table.
     *
     * @param SpyProductOffer $spyProductOffer
     * @return ChildSpyStore The current object (for fluent API support)
     */
    public function removeSpyProductOffer(SpyProductOffer $spyProductOffer)
    {
        if ($this->getSpyProductOffers()->contains($spyProductOffer)) {
            $spyProductOfferStore = new SpyProductOfferStore();
            $spyProductOfferStore->setSpyProductOffer($spyProductOffer);
            if ($spyProductOffer->isSpyStoresLoaded()) {
                //remove the back reference if available
                $spyProductOffer->getSpyStores()->removeObject($this);
            }

            $spyProductOfferStore->setSpyStore($this);
            $this->removeSpyProductOfferStore(clone $spyProductOfferStore);
            $spyProductOfferStore->clear();

            $this->collSpyProductOffers->remove($this->collSpyProductOffers->search($spyProductOffer));

            if (null === $this->spyProductOffersScheduledForDeletion) {
                $this->spyProductOffersScheduledForDeletion = clone $this->collSpyProductOffers;
                $this->spyProductOffersScheduledForDeletion->clear();
            }

            $this->spyProductOffersScheduledForDeletion->push($spyProductOffer);
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
        if (null !== $this->aDefaultCurrency) {
            $this->aDefaultCurrency->removeStoreDefault($this);
        }
        if (null !== $this->aDefaultLocale) {
            $this->aDefaultLocale->removeStoreDefault($this);
        }
        $this->id_store = null;
        $this->fk_currency = null;
        $this->fk_locale = null;
        $this->name = null;
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
            if ($this->collSpyAssetStores) {
                foreach ($this->collSpyAssetStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collAvailabilityAbstracts) {
                foreach ($this->collAvailabilityAbstracts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collAvailabilities) {
                foreach ($this->collAvailabilities as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyAvailabilityNotificationSubscriptions) {
                foreach ($this->collSpyAvailabilityNotificationSubscriptions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyCategoryStores) {
                foreach ($this->collSpyCategoryStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyCmsPageStores) {
                foreach ($this->collSpyCmsPageStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyCmsBlockStores) {
                foreach ($this->collSpyCmsBlockStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyCompanyStores) {
                foreach ($this->collSpyCompanyStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCountryStores) {
                foreach ($this->collCountryStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCurrencyStores) {
                foreach ($this->collCurrencyStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDiscounts) {
                foreach ($this->collDiscounts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyDiscountStores) {
                foreach ($this->collSpyDiscountStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLocaleStores) {
                foreach ($this->collLocaleStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyMerchantStores) {
                foreach ($this->collSpyMerchantStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collMerchantCommissions) {
                foreach ($this->collMerchantCommissions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyMerchantRegistrationRequests) {
                foreach ($this->collSpyMerchantRegistrationRequests as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyMerchantRelationshipSalesOrderThresholds) {
                foreach ($this->collSpyMerchantRelationshipSalesOrderThresholds as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOmsProductReservations) {
                foreach ($this->collOmsProductReservations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOmsProductOfferReservations) {
                foreach ($this->collOmsProductOfferReservations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyPaymentMethodStores) {
                foreach ($this->collSpyPaymentMethodStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPriceProductStores) {
                foreach ($this->collPriceProductStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPriceProductSchedules) {
                foreach ($this->collPriceProductSchedules as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductAbstractStores) {
                foreach ($this->collSpyProductAbstractStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProductLabelStores) {
                foreach ($this->collProductLabelStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductMeasurementSalesUnitStores) {
                foreach ($this->collSpyProductMeasurementSalesUnitStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductOfferStores) {
                foreach ($this->collSpyProductOfferStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProductOptionValuePrices) {
                foreach ($this->collProductOptionValuePrices as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProductRelationStores) {
                foreach ($this->collProductRelationStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyQuotes) {
                foreach ($this->collSpyQuotes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpySalesOrderThresholds) {
                foreach ($this->collSpySalesOrderThresholds as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collServicePointStores) {
                foreach ($this->collServicePointStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collShipmentMethodPrices) {
                foreach ($this->collShipmentMethodPrices as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collShipmentMethodStores) {
                foreach ($this->collShipmentMethodStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collShipmentTypeStores) {
                foreach ($this->collShipmentTypeStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collStockStores) {
                foreach ($this->collStockStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyStoreContexts) {
                foreach ($this->collSpyStoreContexts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTouchStorages) {
                foreach ($this->collTouchStorages as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTouchSearches) {
                foreach ($this->collTouchSearches as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductOffers) {
                foreach ($this->collSpyProductOffers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyAssetStores = null;
        $this->collAvailabilityAbstracts = null;
        $this->collAvailabilities = null;
        $this->collSpyAvailabilityNotificationSubscriptions = null;
        $this->collSpyCategoryStores = null;
        $this->collSpyCmsPageStores = null;
        $this->collSpyCmsBlockStores = null;
        $this->collSpyCompanyStores = null;
        $this->collCountryStores = null;
        $this->collCurrencyStores = null;
        $this->collDiscounts = null;
        $this->collSpyDiscountStores = null;
        $this->collLocaleStores = null;
        $this->collSpyMerchantStores = null;
        $this->collMerchantCommissions = null;
        $this->collSpyMerchantRegistrationRequests = null;
        $this->collSpyMerchantRelationshipSalesOrderThresholds = null;
        $this->collOmsProductReservations = null;
        $this->collOmsProductOfferReservations = null;
        $this->collSpyPaymentMethodStores = null;
        $this->collPriceProductStores = null;
        $this->collPriceProductSchedules = null;
        $this->collSpyProductAbstractStores = null;
        $this->collProductLabelStores = null;
        $this->collSpyProductMeasurementSalesUnitStores = null;
        $this->collSpyProductOfferStores = null;
        $this->collProductOptionValuePrices = null;
        $this->collProductRelationStores = null;
        $this->collSpyQuotes = null;
        $this->collSpySalesOrderThresholds = null;
        $this->collServicePointStores = null;
        $this->collShipmentMethodPrices = null;
        $this->collShipmentMethodStores = null;
        $this->collShipmentTypeStores = null;
        $this->collStockStores = null;
        $this->collSpyStoreContexts = null;
        $this->collTouchStorages = null;
        $this->collTouchSearches = null;
        $this->collSpyProductOffers = null;
        $this->aDefaultCurrency = null;
        $this->aDefaultLocale = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyStoreTableMap::DEFAULT_STRING_FORMAT);
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

    // event behavior

    /**
     * @return void
     */
    protected function prepareSaveEventName()
    {
        if ($this->isNew()) {
            $this->_eventName = 'Entity.spy_store.create';
        } else {
            $this->_eventName = 'Entity.spy_store.update';
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

        if ($this->_eventName !== 'Entity.spy_store.create') {
            if (!$this->_isModified) {
                return;
            }

            if (!$this->isEventColumnsModified()) {
                return;
            }
        }

        $data = [
            'name' => 'spy_store',
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
            'name' => 'spy_store',
            'id' => !is_array($this->getPrimaryKey()) ? $this->getPrimaryKey() : null,
            'event' => 'Entity.spy_store.delete',
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
            $field = str_replace('spy_store.', '', $modifiedColumn);
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
            $field = str_replace('spy_store.', '', $additionalValueColumnName);
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
        $columnType = SpyStoreTableMap::getTableMap()->getColumn($column)->getType();
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
